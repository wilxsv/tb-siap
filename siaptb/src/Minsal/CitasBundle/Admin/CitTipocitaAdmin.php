<?php

namespace Minsal\CitasBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

class CitTipocitaAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('tipocita',null,array('label'=>'Nombre'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('tipocita',null,array('label'=>'Nombre'))
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
            ->add('tipocita',null,array('label'=>'Nombre'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('tipocita',null,array('label'=>'Nombre'))
            ->add('fechahorareg',null,array('label'=>'Fecha y Hora de Registro'))
            ->add('idchahorareg',null,array('label'=>'Usuario que Registró'))
        ;
    }

    public function validate(ErrorElement $errorElement, $object) {
        $action = $object->getId() ? 'edit' : 'create';
        $em     = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();

        $newNombre = preg_replace( '/\s\s+/',' ', ( trim( $object->getTipocita() ) ) );

        $dql = "SELECT t01
                FROM MinsalCitasBundle:CitTipocita t01
                WHERE LOWER(UNACCENT(t01.tipocita)) = LOWER(UNACCENT(:tipocita))";

        if($action === 'edit') {
            $dql .= ' AND t01.id != :id';
        }

        $query = $em->createQuery($dql)
                    ->setParameter('tipocita', $newNombre);

        if($action === 'edit') {
            $query->setParameter('id', $object->getId());
        }

        $result = $query->getResult();

        if ($result) {
            $errorElement
                ->with('tipocita')
                    ->addViolation('El nombre del Tipo de Cita digitado ya ha sido registrado.')
                ->end()
            ;
        }
    }

    public function prePersist($object) {
        $user            = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $currentDateTime = new \DateTime();
        $tipocita         = preg_replace( '/\s\s+/',' ', ( trim( $object->getTipocita() ) ) );

        $object->setTipocita($tipocita);
        $object->setIdusuarioreg($user);
        $object->setFechahorareg($currentDateTime);
    }

    public function preUpdate($object) {
        $tipocita = preg_replace( '/\s\s+/',' ', ( trim( $object->getTipocita() ) ) );

        $object->setTipocita($tipocita);
    }

    public function getBatchActions() {
        $actions = parent::getBatchActions();
        $actions['delete'] = null;
    }
}
