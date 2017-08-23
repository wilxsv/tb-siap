<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;
Use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

class CtlEstablecimientoAdmin extends Admin {

    protected $datagridValues = array(
        '_page' => 1, // Display the first page (default = 1)
        '_sort_order' => 'ASC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'configurado' // name of the ordered field (default = the model id field, if any)
    );

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('nombre', null, array('read_only' => true))
                ->add('tipoExpediente', 'choice', array('choices' => array('G' => 'Utiliza guión (xxx-xx)', 'I' => 'Infinito'),
                    'empty_value' => 'Seleccione una opción', 'required' => true))
                ->add('serviciosExternos', null, array(
                    'required' => false,
                    'multiple' => true,
                    'expanded' => true
                ))
                ->add('citasSinExpediente', null, array('label' => '¿Este establecimiento dará citas por telefono?'))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('nombre')
                ->add('idMunicipio')
                ->add('idTipoEstablecimiento')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('nombre')
                ->add('idMunicipio')
                ->add('idTipoEstablecimiento')
                ->add('configurado')
                ->add('serviciosExterno')
                ->add('_action', 'actions', array(
                    'label' => $this->getTranslator()->trans('Action'),
                    'actions' => array(
                        'edit' => array()
                    )
                ))
        ;
    }

    public function getBatchActions() {
        $actions = parent::getBatchActions();
        $actions['delete'] = null;
    }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('create');
        $collection->remove('delete');
    }

    public function preUpdate($establecimiento) {
        $establecimiento->setConfigurado(true);
        $usuariosAdministradores = $this->getModelManager()
                ->getEntityManager('ApplicationSonataUserBundle:User')
                ->createQuery("
                    SELECT u,G
                    FROM ApplicationSonataUserBundle:User u
                    LEFT JOIN u.groups G
                    WHERE u.username LIKE '%admin%'
                            OR G.name LIKE '%Admin'")
                ->getResult();

        foreach ($usuariosAdministradores as $usuario) {
            $usuario->setIdEstablecimiento($establecimiento);
            $usuario->setEnabled(true);
            $this->getModelManager()->update($usuario);

            if ($usuario->getIdEmpleado()) {
                $empleado=$usuario->getIdEmpleado();
                $empleado->setIdEstablecimiento($establecimiento);
                $this->getModelManager()->update($empleado);
            }

            if (in_array($establecimiento->getIdTipoEstablecimiento()->getId(), array(1,30,31,14))) {
                $grupo = $this->getModelManager()
                        ->getEntityManager('ApplicationSonataUserBundle:Group')
                        ->createQuery("
                    SELECT g
                    FROM ApplicationSonataUserBundle:Group g
                    WHERE g.name = 'Modulo1HosAdmin'")
                        ->getSingleResult();
            } else {
                $grupo = $this->getModelManager()
                        ->getEntityManager('ApplicationSonataUserBundle:Group')
                        ->createQuery("
                    SELECT g
                    FROM ApplicationSonataUserBundle:Group g
                    WHERE g.name = 'Modulo1UsAdmin'")
                        ->getSingleResult();
            }

            if ($usuario->getId() == 3) {
                $grupos = $usuario->getGroups();
                if (count($grupos)>0){
                    foreach ($grupos as $key => $value) {
                        $usuario->removeGroup($value);
                        $this->getModelManager()->update($usuario);
                    }
                }
                $usuario->addGroup($grupo);
                $this->getModelManager()->update($usuario);
            }
        }

    }

    /**
     * @return \Sonata\AdminBundle\Datagrid\ProxyQueryInterface
     */
    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);

        return new ProxyQuery(
                $query
                        ->where($query->getRootAlias() . '.idTipoEstablecimiento NOT IN (12,13)')
        );
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'edit':
                return 'MinsalSiapsBundle:CRUD:CtlEstablecimiento_edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    public function validate(ErrorElement $errorElement, $establecimiento) {

        $configurado = $this->getModelManager()
          ->findOneBy('MinsalSiapsBundle:CtlEstablecimiento', array('configurado'=>TRUE));

        if($configurado){
            if($configurado->getId() != $establecimiento->getId())
            $errorElement
                ->with('error')
                    ->addViolation('YA HAY UN ESTABLECIMIENTO CONFIGURADO SI DESEA ACTUALIZARLO BUSCAR EL ESTABLECIMIENTO: '.$configurado->getNombre())
                ->end();
        }

    }


}

?>
