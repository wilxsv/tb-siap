<?php

namespace Minsal\SeguimientoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class SecAntecedentesAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

    }
    protected $maxPerPage = 8;
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->addIdentifier('id', null, array('label'=>'Id'))
            ->addIdentifier('fechaHoraRegistro', 'date', array('label'=>'Fecha de registro','route' => array('name' => 'editespe')))
            ->add('nombre', null, array('label'=>'Nombre del paciente'))
            ->add('dui', null, array('label'=>'Documento del paciente'))
//            ->add('esEmbarazada', null, array('label'=>'Esta embarazada', 'required'=>true))
//            ->add('idMotivoSolicitud', null, array('label'=>'Motivo Solicitud'))
            //->add('idHistorialClinico', null, array('label'=>'Historial Clinico'))
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {

    }

    public function validate(ErrorElement $errorElement, $object)
    {

    }
    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
            case 'create':
                return 'MinsalSeguimientoBundle:SecAntecedentes:edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    protected function configureRoutes(RouteCollection $collection) {
        //$collection->add('generateformtest',$this->getRouterIdParameter().'/generateformtest');
        //
        $collection->add('showespe','{id}/{idatenareamodestab}/showespe');
        $collection->add('editespe','{id}/{idatenareamodestab}/editespe');
        // $collection->remove('create');
    //$collection->add('create',  $this->getRouterIdParameter().'/create');
    }

}
