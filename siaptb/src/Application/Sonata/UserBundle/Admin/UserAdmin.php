<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\UserBundle\Admin\Model\UserAdmin as BaseUserAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Minsal\SiapsBundle\Entity\MntEmpleado;
use Minsal\SiapsBundle\Entity\MntEmpleadoEspecialidadEstab as EspecialidadEstab;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Doctrine\ORM\EntityRepository;

class UserAdmin extends BaseUserAdmin {

    protected $datagridValues = array(
        '_page' => 1, // Display the first page (default = 1)
        '_sort_order' => 'ASC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'groups.name' // name of the ordered field (default = the model id field, if any)
    );

    public function configureFormFields(FormMapper $formMapper) {
        $usuario = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $modulo = $this->getRequest()->getSession()->get('_moduleSelection');
        if ($usuario->getId() != 1) {
            switch ($modulo) {
                case 1:
                    $establecimiento = $this->getModelManager()
                            ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => true));
                    if (in_array($establecimiento->getIdTipoEstablecimiento()->getId(), array(1, 30, 31, 14)))
                        $nombre = 'Hos';
                    else
                        $nombre = 'Us';

                    $restriccion='';
                    if($usuario->hasGroup("Modulo2CitasAdministracion")){
                        $restriccion="OR g.name LIKE 'Modulo2%'";
                    }
                    $query = $this
                            ->modelManager
                            ->getEntityManager('ApplicationSonataUserBundle:Group')
                            ->createQuery("
                            SELECT g
                            FROM ApplicationSonataUserBundle:Group g
                            WHERE g.name LIKE 'Modulo1$nombre%' $restriccion");
                    break;
                case 2:
                        $establecimiento = $this->getModelManager()
                                ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => true));
                        if (in_array($establecimiento->getIdTipoEstablecimiento()->getId(), array(1, 30, 31, 14)))
                            $nombre = 'Hos';
                        else
                            $nombre = 'Us';

                        $restriccion='';
                        if($usuario->hasGroup("Modulo1".$nombre."Admin")){
                            $restriccion="OR g.name LIKE 'Modulo1$nombre%'";
                        }

                        $query = $this
                                ->modelManager
                                ->getEntityManager('ApplicationSonataUserBundle:Group')
                                ->createQuery("
                                SELECT g
                                FROM ApplicationSonataUserBundle:Group g
                                WHERE g.name LIKE 'Modulo2%' $restriccion");
                        break;
                default:
                    $query = $this
                            ->modelManager
                            ->getEntityManager('ApplicationSonataUserBundle:Group')
                            ->createQuery("
                            SELECT g
                            FROM ApplicationSonataUserBundle:Group g
                            WHERE g.name LIKE 'Modulo$modulo%'");
                    break;
            }
        } else {
            $query = $this
                    ->modelManager
                    ->getEntityManager('ApplicationSonataUserBundle:Group')
                    ->createQuery("
                            SELECT g
                            FROM ApplicationSonataUserBundle:Group g");
        }
        $formMapper
                ->add('firstname', null, array('required' => true,'attr'=>array('class'=>'limpiar')))
                ->add('lastname', null, array('required' => true,'attr'=>array('class'=>'limpiar')))
                ->add('username')
                ->add('email', null, array('required' => true))
                ->add('plainPassword', 'repeated', array(
                    'required' => false,
                    'type' => 'password',
                    'label' => 'Contraseña del usuario',
                    'second_options' => array('label' => 'Confirmación de contraseña'),
                    'invalid_message' => 'Las contraseñas deben coincidir, vuelva a digitarla',
                ))
                ->add('enabled', null, array('required' => false))
                ->add('groups', 'sonata_type_model', array('required' => true, 'expanded' => false,
                    'multiple' => true,
                    'by_reference' => true,
                    'query' => $query));
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        if($user->hasRole('ROLE_SUPER_ADMIN') === true) {
            $formMapper
            ->add('idAreaModEstab', 'entity', array('required' => true,
                    'label'=>'Area Atención',
                    'mapped'=>false,
                    'class' => 'MinsalSiapsBundle:MntAreaModEstab'
                ));
        }
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('username')
                ->add('groups')
                ->add('idEmpleado', null, array('label' => 'Empleado Asociado'))
                ->add('idEmpleado.idTipoEmpleado', null, array('label' => 'Tipo Empleado'))
                ->add('enabled', null, array('editable' => true))
                ->add('createdAt')
        ;
    }

    /*
     * DESCRIPCIÓN: Función que se realiza despues de ingresar el usuario. Si es
     * un usuario del módulo 1 creara un empleado y se lo agregara al usuario.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    public function postPersist($usuario) {
        $modulo = $this->getRequest()->getSession()->get('_moduleSelection');
        $idEstablecimientoConfigurado = $this->getModelManager()
          ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => 'true'));
        $usuario->setIdEstablecimiento($idEstablecimientoConfigurado);

        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        switch ($modulo) {
            case 1:
            case 2:
                $empleado = new MntEmpleado();
                $empleado->setApellido($usuario->getLastName());
                $empleado->setNombre($usuario->getFirstName());
                $empleado->setNombreempleado($usuario->getFirstName() . ' ' . $usuario->getLastName());
                $idTipoEmpleado = $this->getModelManager()
                        ->findOneBy('MinsalSiapsBundle:MntTipoEmpleado', array('codigo' => 'ARC'));
                $empleado->setIdTipoEmpleado($idTipoEmpleado);
                $empleado->setIdEstablecimiento($usuario->getIdEstablecimiento());
                $empleado->setHabilitado($usuario->isEnabled());
                $this->getModelManager()->create($empleado);
                $usuario->setIdEmpleado($empleado);
                $this->getModelManager()->update($usuario);
                $especialidadEstab= new EspecialidadEstab();
                $especialidadEstab->setIdEmpleado($empleado);
                if($user->hasRole('ROLE_SUPER_ADMIN') === true) {
                    $especialidadEstab->setIdAreaModEstab($this->getForm()->get('idAreaModEstab')->getData());
                }else{
                    $empleadoEspecialidadEstab = $this->getModelManager()
                            ->findOneBy('MinsalSiapsBundle:MntEmpleadoEspecialidadEstab', array('idEmpleado' => $user->getIdEmpleado()));
                    $especialidadEstab->setIdAreaModEstab($empleadoEspecialidadEstab->getIdAreaModEstab());
                }

                $this->getModelManager()->create($especialidadEstab);
                break;
        }
    }

    public function postUpdate($usuario) {
        $modulo = $this->getRequest()->getSession()->get('_moduleSelection');
        $idEstablecimientoConfigurado = $this->getModelManager()
          ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => 'true'));
        $usuario->setIdEstablecimiento($idEstablecimientoConfigurado);

        switch ($modulo) {
            case 1:
            case 2:
                $empleado = $this->getModelManager()
                        ->find('MinsalSiapsBundle:MntEmpleado', $usuario->getIdEmpleado()->getId());
                $empleado->setApellido($usuario->getLastName());
                $empleado->setNombre($usuario->getFirstName());
                $empleado->setNombreempleado($usuario->getFirstName() . ' ' . $usuario->getLastName());
                $empleado->setHabilitado($usuario->isEnabled());
                $this->getModelManager()->update($empleado);
                break;
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('username', null, array('label' => 'Nombre Usuario'))
                ->add('enabled',null,array('label'=>'Habilitado'))
                ->add('idEmpleado', null, array('label' => 'Empleado Asociado'))
                ->add('idEmpleado.idTipoEmpleado', null, array('label' => 'Tipo Empleado'))
                ->add('groups')
        ;
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'edit':
                return 'MinsalSiapsBundle:UserAdmin:edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    /**
     * @return \Sonata\AdminBundle\Datagrid\ProxyQueryInterface
     */
    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);
        $usuario = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $modulo = $this->getRequest()->getSession()->get('_moduleSelection');
        if ($usuario->getId() != 1) {
            $establecimiento = $this->getModelManager()
                    ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado' => true));
            $areaAtencion=  $this->getModelManager()
                ->findOneBy('MinsalSiapsBundle:MntEmpleadoEspecialidadEstab', array('idEmpleado' => $usuario->getIdEmpleado()));

            $dql = "SELECT B.id as id
            FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab A
            JOIN A.idEmpleado B
            WHERE B.idTipoEmpleado=7 AND A.idAreaModEstab=" . $areaAtencion->getIdAreaModEstab()->getId();

            $empleadoAsociados = $this->getModelManager()
            ->getEntityManager('MinsalSiapsBundle:MntEmpleado')
            ->createQuery($dql)
            ->getArrayResult();
            $ids='';
            foreach ($empleadoAsociados as $value) {
                $ids.=$value['id'].',';
            }
            $ids=rtrim($ids, ",");


            switch ($modulo) {
                case 1:
                    if (!is_null($establecimiento)) {
                        if (in_array($establecimiento->getIdTipoEstablecimiento()->getId(), array(1, 30, 31, 14)))
                            $nombre = 'Hos';
                        else
                            $nombre = 'Us';

                        $restriccion='';
                        if($usuario->hasGroup("Modulo2CitasAdministracion")){
                            $restriccion="OR s_groups.name LIKE 'Modulo2%'";
                        }
                        return new ProxyQuery(
                                $query
                                        ->where("s_groups.name LIKE 'Modulo1$nombre%' $restriccion")
                                        ->andWhere($query->getRootAlias().".idEmpleado IN ($ids)")
                        );
                    }
                break;
                case 2:
                    if (!is_null($establecimiento)) {
                        if (in_array($establecimiento->getIdTipoEstablecimiento()->getId(), array(1, 30, 31, 14)))
                            $nombre = 'Hos';
                        else
                            $nombre = 'Us';

                        $restriccion='';
                        if($usuario->hasGroup("Modulo1".$nombre."Admin")){
                            $restriccion="OR s_groups.name LIKE 'Modulo1$nombre%'";
                        }
                        return new ProxyQuery(
                                $query
                                        ->where("s_groups.name LIKE 'Modulo2%' $restriccion")
                                        ->andWhere($query->getRootAlias().".idEmpleado IN ($ids)")

                        );
                    }
                    break;
                case 3:
                case 6:
                    return new ProxyQuery(
                            $query
                                    ->where("s_groups.name LIKE 'Modulo6%' OR 'Modulo3%'")
                    );
                    break;

            }
        } else {
            return $query;
        }
    }
}
