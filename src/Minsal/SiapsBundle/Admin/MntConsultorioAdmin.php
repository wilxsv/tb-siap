<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;

class MntConsultorioAdmin extends Admin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('nombre');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        $listMapper
                ->add('nombre', null, array('label' => 'Nombre'))
                ->add('descripcion', null, array('label' => 'Descripción'))
                ->add('idusuarioreg', null, array('label' => 'Usuario que registra'))
                ->add('fechahorareg', null, array('label' => 'Fecha y Hora del registro'));
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            $listMapper
                    ->add('idAreaModEstab', null, array('label' => 'Area asociada al consultorio'));
        }
        $listMapper
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array()
                    )
        ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('nombre', null, array('label' => 'Nombre', 'attr' => array('class' => 'limpiar')))
                ->add('descripcion', 'textarea', array('label' => 'Descripción', 'required' => false))
                ->add('idAreaModEstab', 'entity', array(
                        'label' => 'Area a la que pertenece el consultorio',
                        'required' => true,
                        'empty_value' => 'Selecione.. ',
                        'class' => 'MinsalSiapsBundle:MntAreaModEstab',
                        'query_builder' => function(EntityRepository $repositorio) {
                            return $repositorio
                                    ->createQueryBuilder('areamodestab')
                                    ->where('areamodestab.idAreaAtencion=1')
                                    ->orderBy('areamodestab.id');
                        }
            ));
        }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('delete');
        $collection->remove('show');
    }

    public function prePersist($object) {
        $nombre = preg_replace('/\s\s+/', ' ', $object->getNombre());
        $nombre = preg_replace('/$\s+/', '', $object->getNombre());
        $nombre = preg_replace('/^\s+/', '', $object->getNombre());
        $nombre = ucwords($nombre);
        $object->setNombre($nombre);

        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $object->setIdusuarioreg($user);
        $object->setFechahorareg(new \DateTime());
    }

    public function preUpdate($object) {
        $nombre = preg_replace('/\s\s+/', ' ', $object->getNombre());
        $nombre = preg_replace('/$\s+/', '', $object->getNombre());
        $nombre = preg_replace('/^\s+/', '', $object->getNombre());
        $nombre = ucwords($nombre);
        $object->setNombre($nombre);

        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $object->setIdusuariomod($user);
        $object->setFechahoramod(new \DateTime());
    }

    public function validate(ErrorElement $errorElement, $object) {
        $nombre = $object->getNombre();

        if (is_null($object->getId())) {
            $dql = "SELECT A
                  FROM MinsalSiapsBundle:MntConsultorio A
                  WHERE unaccent(lower(A.nombre)) = unaccent(lower('$nombre'))";
            $repetido = $this->getModelManager()
                    ->getEntityManager('MinsalSiapsBundle:MntConsultorio')
                    ->createQuery($dql)
                    ->getArrayResult();

            if (count($repetido) > 0) {
                $errorElement->with('Nombre')
                        ->addViolation('Este consultorio ya existe. Escribir otro nombre')
                        ->end();
            }
        } else {
            $dql = "SELECT A
                  FROM MinsalSiapsBundle:MntConsultorio A
                  WHERE unaccent(lower(A.nombre)) = unaccent(lower('$nombre')) and A.id<>" . $object->getId();
            $repetido = $this->getModelManager()
                    ->getEntityManager('MinsalSiapsBundle:MntConsultorio')
                    ->createQuery($dql)
                    ->getArrayResult();

            if (count($repetido) > 0) {
                $errorElement->with('Nombre')
                        ->addViolation('Este consultorio ya existe. Escribir otro nombre')
                        ->end();
            }
        }
    }

    /**
     * @return \Sonata\AdminBundle\Datagrid\ProxyQueryInterface
     */
    public function createQuery($context = 'list') {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $query = parent::createQuery($context);
        if ($user->hasRole('ROLE_SUPER_ADMIN')) {
            return $query;
        } else {
            $idEmpleado = $user->getIdEmpleado()->getId();
            $dql = "SELECT A
                  FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab A
                  JOIN A.idEmpleado B
                  WHERE B.id=$idEmpleado";
            $idAreaModEstab = $this->getModelManager()
                    ->getEntityManager('MinsalSiapsBundle:MntEmpleadoEspecialidadEstab')
                    ->createQuery($dql)
                    ->getResult();
            return new ProxyQuery(
                    $query
                            ->join($query->getRootAlias() . '.idAreaModEstab', 'MinsalSiapsBundle:MntAreaModEstab')
                            ->where('MinsalSiapsBundle:MntAreaModEstab=' . $idAreaModEstab[0]->getIdAreaModEstab()->getId())
                    )

            ;
        }
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'edit':
                return 'MinsalSiapsBundle:CRUD:MntConsultorio\edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

}
