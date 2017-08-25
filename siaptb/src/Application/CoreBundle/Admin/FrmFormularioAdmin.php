<?php

namespace Application\CoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class FrmFormularioAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nombre', null, array('label'=>'Nombre del Formulario'))
            ->add('codigo', null, array('label'=>'Código de Formulario'))
            ->add('publicado', null, array('label'=>'Publicado'))
            ->add('activo', null, array('label'=>'Activo'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nombre', null, array('label'=>'Nombre del Formulario', 'route'=>array('name'=>'generateformtest')))
            ->add('codigo', null, array('label'=>'Código de Formulario'))
            ->add('descripcion', null, array('label'=>'Descripción', 'required'=>true))
            ->add('fechaInicio', null, array('label'=>'Fecha Creación'))
            ->add('activo', null, array('label'=>'Activo'))
            ->add('publicado', null, array('label'=>'Publicado'))
            //->add('fechaPublicacion', null, array('label'=>'Fecha de Publicación'))
        ;
    }
    
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nombre', null, array('label'=>'Nombre del Formulario'))
            ->add('codigo', null, array('label'=>'Código de Formulario'))
            ->add('descripcion', null, array('label'=>'Descripción', 'required'=>true))
            ->add('fechaInicio', null, array('label'=>'Fecha de Creación'))
            ->add('publicado', null, array('label'=>'Publicado'))
            ->add('fechaPublicacion', null, array('label'=>'Fecha de Publicación'))
            ->add('activo', null, array('label'=>'Activo'))
            ->add('fechaFin', null, array('label'=>'Fecha de Inactivación'))
        ;
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('nombre')
                ->assertNotNull(array('message' => 'Introduzca un Nombre valido.'))
            ->end()
        ;
    }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('generateformtest',$this->getRouterIdParameter().'/generateformtest');
    }

}