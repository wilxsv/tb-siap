<?php

namespace Minsal\CitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

class CitEstadoCitaAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('estado')
            ->add('descripcion',null,array('label'=>'Descripción'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('estado')
            ->add('descripcion',null,array('label'=>'Descripción'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('estado')
            ->add('descripcion',null,array('label'=>'Descripción'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('estado')
            ->add('descripcion',null,array('label'=>'Descripción'))
            ->add('fechahorareg',null,array('label'=>'Fecha y Hora de Registro'))
            ->add('idusuarioreg',null,array('label'=>'Usuario que registró'))
        ;
    }

    public function validate(ErrorElement $errorElement, $object) {
        $action = $object->getId() ? 'edit' : 'create';
        $em     = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();

        $newNombre = preg_replace( '/\s\s+/',' ', ( trim( $object->getEstado() ) ) );

        $dql = "SELECT t01
                FROM MinsalCitasBundle:CitEstadoCita t01
                WHERE LOWER(UNACCENT(t01.estado)) = LOWER(UNACCENT(:estado))";

        if($action === 'edit') {
            $dql .= ' AND t01.id != :id';
        }

        $query = $em->createQuery($dql)
                    ->setParameter('estado', $newNombre);

        if($action === 'edit') {
            $query->setParameter('id', $object->getId());
        }

        $result = $query->getResult();

        if ($result) {
            $errorElement
                ->with('estado')
                    ->addViolation('El nombre del Estado digitado ya ha sido registrado.')
                ->end()
            ;
        }
    }

    public function prePersist($object) {
        $user            = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $currentDateTime = new \DateTime();
        $estado          = preg_replace( '/\s\s+/',' ', ( trim( $object->getEstado() ) ) );

        $object->setEstado($estado);
        $object->setIdusuarioreg($user);
        $object->setFechahorareg($currentDateTime);
    }

    public function preUpdate($object) {
        $estado = preg_replace( '/\s\s+/',' ', ( trim( $object->getEstado() ) ) );

        $object->setEstado($estado);
    }

    public function getBatchActions() {
        $actions = parent::getBatchActions();
        $actions['delete'] = null;
    }
}
