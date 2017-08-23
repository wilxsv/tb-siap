<?php

namespace Minsal\FarmaciaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FarmMedicinarecetadaAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('cantidad')
            ->add('dosis')
            ->add('fechaentrega')
            ->add('idestado')
            ->add('frecuencia')
            ->add('tiempoFrecuencia')
            ->add('durante')
            ->add('tiempoDurante')
            ->add('totalMedicamento')
            ->add('recomendacion')
            ->add('cantidadMedicamento')
            ->add('distribucionEspecial')
            ->add('sincronizadofc')
            ->add('justificacionPrescripcion')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('cantidad')
            ->add('dosis')
            ->add('fechaentrega')
            ->add('idestado')
            ->add('frecuencia')
            ->add('tiempoFrecuencia')
            ->add('durante')
            ->add('tiempoDurante')
            ->add('totalMedicamento')
            ->add('recomendacion')
            ->add('cantidadMedicamento')
            ->add('distribucionEspecial')
            ->add('sincronizadofc')
            ->add('justificacionPrescripcion')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
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
            ->add('id')
            ->add('cantidad')
            ->add('dosis')
            ->add('fechaentrega')
            ->add('idestado')
            ->add('frecuencia')
            ->add('tiempoFrecuencia')
            ->add('durante')
            ->add('tiempoDurante')
            ->add('totalMedicamento')
            ->add('recomendacion')
            ->add('cantidadMedicamento')
            ->add('distribucionEspecial')
            ->add('sincronizadofc')
            ->add('justificacionPrescripcion')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('cantidad')
            ->add('dosis')
            ->add('fechaentrega')
            ->add('idestado')
            ->add('frecuencia')
            ->add('tiempoFrecuencia')
            ->add('durante')
            ->add('tiempoDurante')
            ->add('totalMedicamento')
            ->add('recomendacion')
            ->add('cantidadMedicamento')
            ->add('distribucionEspecial')
            ->add('sincronizadofc')
            ->add('justificacionPrescripcion')
        ;
    }
}
