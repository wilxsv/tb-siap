<?php

namespace Minsal\SeguimientoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;


class SecDatoEmbarazoAdmin extends Admin {
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $now = new \DateTime();

        $formMapper
                ->add('fechaUltimaMestruacion', null, array('label' => 'Fecha Ultima Mestruación (FUM):', 'widget' => 'single_text', 'format' => 'dd-MM-yyyy',
                    'attr'=>array('class'=>'bootstrap-datepicker now form-control', 'data-mask'=>'99/99/9999','placeholder'=>"dd/mm/aaaa")))
                ->add('semanaAmenorrea', null, array('label' => 'Semanas de Amenorrea:'))
                ->add('fechaProblableParto', null, array('label' => 'Fecha Problable de Parto (FPP):', 'widget' => 'single_text', 'format' => 'dd-MM-yyyy',
                            'attr'=>array('class'=>'bootstrap-datepicker form-control', 'data-date-start-date'=> $now->format('d/m/Y'),'data-mask'=>'99/99/9999','placeholder'=>"dd/mm/aaaa")))
                ->add('controlPrenatal', 'checkbox', array( 'label' => 'En Control Prenatal', 'mapped' => false, 'attr' => array('data-switch-enabled' => 'true', 'data-switch-float' => 'none') ) )
                ->add('idEstablecimientoControl', null, array( 'label' => 'Establecimiento de Control', 'empty_value' => false, 'empty_data'  => null) )
                ->add('gravidez', 'integer', array('label' => 'Gravidez(G):', 'mapped' => false, 'required' => true))
                ->add('partos', 'integer', array('label' => 'Partos(P):', 'mapped' => false, 'required' => true))
                ->add('prematuros', 'integer', array('label' => 'Partos Prematuros(PP):', 'mapped' => false, 'required' => true))
                ->add('abortos', 'integer', array('label' => 'Abortos(A):', 'mapped' => false, 'required' => true))
                ->add('vivos', 'integer', array('label' => 'Nacidos Vivos(V):', 'mapped' => false, 'required' => true))
        ;
    }

}
