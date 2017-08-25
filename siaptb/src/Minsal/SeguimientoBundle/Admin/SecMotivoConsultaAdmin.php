<?php

namespace Minsal\SeguimientoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Route\RouteCollection;
use Minsal\Metodos\Funciones;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Range;

class SecMotivoConsultaAdmin extends Admin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                // ->add('referido', 'choice', array('label'=>'Consulta es un:', 'required' => false,'mapped'=>false,'multiple'=>true,'expanded'=>true, 'empty_value'  => false,
                //  'choices' => array('1'=>'Retorno','2'=>'Interconsulta','3'=>'Referido')))
                ->add('consultaPor', 'textarea', array('required' => true, 'label' => 'Consulta por:'))
                ->add('presentaEnfermedad', 'textarea', array('required' => true, 'label' => 'Presenta Enfermedad:'))
        ;
    }

    public function validate(ErrorElement $errorElement, $examenFisico) {

    }



    public function preUpdate($examenFisico) {

    }

    public function prePersist($examenFisico) {

    }

    protected function configureRoutes(RouteCollection $collection) {
        //$collection->clear();
    }

}

?>
