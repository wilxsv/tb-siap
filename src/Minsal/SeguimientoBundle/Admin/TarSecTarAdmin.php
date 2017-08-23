<?php

namespace Minsal\SeguimientoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class TarSecTarAdmin extends Admin
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
            ->addIdentifier('id', null, array('label'=>'Id'))
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
                return 'MinsalSeguimientoBundle:TarSecTar:edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    protected function configureRoutes(RouteCollection $collection) {
            $collection->add('createespe','{idhistoria}/createespe');
    }

}