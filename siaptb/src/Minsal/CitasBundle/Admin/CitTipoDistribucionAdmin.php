<?php

namespace Minsal\CitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Route\RouteCollection;

class CitTipoDistribucionAdmin extends Admin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('nombre')
                ->add('descripcion')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('nombre')
                ->add('descripcion')
                ->add('idUsuarioRegistra', null, array('label' => 'Usuario que registra'))
                ->add('fechaHoraRegistra', null, array('label' => 'Fecha y Hora del Registro'))
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array()
                    )
                ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('nombre')
                ->add('descripcion')
        ;
    }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('delete');
        $collection->remove('show');
    }

    public function validate(ErrorElement $errorElement, $object) {
        $nombre = $object->getNombre();

        if (is_null($object->getId())) {
            $dql = "SELECT A 
                  FROM MinsalCitasBundle:CitTipoDistribucion A
                  WHERE unaccent(lower(A.nombre)) = unaccent(lower('$nombre'))";
            $repetido = $this->getModelManager()
                    ->getEntityManager('MinsalCitasBundle:CitTipoDistribucion')
                    ->createQuery($dql)
                    ->getArrayResult();

            if (count($repetido) > 0) {
                $errorElement->with('Nombre')
                        ->addViolation('Este tipo de distribución ya existe. Escribir otro nombre')
                        ->end();
            }
        } else {
            $dql = "SELECT A 
                  FROM MinsalCitasBundle:CitTipoDistribucion A
                  WHERE unaccent(lower(A.nombre)) = unaccent(lower('$nombre')) and A.id <>" . $object->getId();
            $repetido = $this->getModelManager()
                    ->getEntityManager('MinsalCitasBundle:CitTipoDistribucion')
                    ->createQuery($dql)
                    ->getArrayResult();

            if (count($repetido) > 0) {
                $errorElement->with('Nombre')
                        ->addViolation('Este tipo de distribución ya existe. Escribir otro nombre')
                        ->end();
            }
        }
    }

    public function prePersist($object) {
        $nombre = preg_replace('/\s\s+/', ' ', $object->getNombre());
        $nombre = preg_replace('/$\s+/', '', $object->getNombre());
        $nombre = preg_replace('/^\s+/', '', $object->getNombre());
        $nombre = ucwords($nombre);
        $object->setNombre($nombre);

        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $object->setIdUsuarioRegistra($user);
        $object->setFechaHoraRegistra(new \DateTime());
    }

    public function preUpdate($object) {
        $nombre = preg_replace('/\s\s+/', ' ', $object->getNombre());
        $nombre = preg_replace('/$\s+/', '', $object->getNombre());
        $nombre = preg_replace('/^\s+/', '', $object->getNombre());
        $nombre = ucwords($nombre);
        $object->setNombre($nombre);
        
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $object->setIdUsuarioModifica($user);
        $object->setFechaHoraModifica(new \DateTime());
    }

}
