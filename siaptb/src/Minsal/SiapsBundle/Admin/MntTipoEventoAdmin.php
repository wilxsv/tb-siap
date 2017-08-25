<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

class MntTipoEventoAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nombre')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nombre','text', array('label' => 'Nombre de evento'))
            ->add('_action', 'actions', array(
                    'label' => $this->getTranslator()->trans('Action'),
                    'actions'=> array(
                    'show'=> array()
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
            ->add('nombre','text', array('label' => 'Nombre de evento'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nombre')
        ;
    }

    //Quitar opción de borrar al final de la lista
    public function getBatchActions() {
        $actions = parent::getBatchActions();
        $actions['delete'] = null;
    }


    public function validate(ErrorElement $errorElement, $object) {
        $em = $this->getModelManager()->getEntityManager('MinsalSiapsBundle:MntTipoEvento');
        $entity = $this->getSubject();

        $newName=  preg_replace('/\s\s+/',' ', (trim($object->getNombre())));

    	if (is_null($object->getId())) {
            $dql = "SELECT A
                  FROM MinsalSiapsBundle:MntTipoEvento A
                  WHERE unaccent(lower(A.nombre)) = unaccent(lower('$newName'))";
            $repetido = $this->getModelManager()
                    ->getEntityManager('MinsalSiapsBundle:MntTipoEvento')
                    ->createQuery($dql)
                    ->getArrayResult();

            if (count($repetido) > 0) {
                $errorElement->with('Nombre')
                        ->addViolation('Este nombre de tipo de evento ya existe. Escribir otro nombre')
                        ->end();
            }
        } else {
            $dql = "SELECT A
                  FROM MinsalSiapsBundle:MntTipoEvento A
                  WHERE unaccent(lower(A.nombre)) = unaccent(lower('$newName')) and A.id<>" . $object->getId();
            $repetido = $this->getModelManager()
                    ->getEntityManager('MinsalSiapsBundle:MntTipoEvento')
                    ->createQuery($dql)
                    ->getArrayResult();

            if (count($repetido) > 0) {
                $errorElement->with('Nombre')
                        ->addViolation('Este nombre de tipo de evento ya existe. Escribir otro nombre')
                        ->end();
            }
        }
    }

    public function preUpdate($tipo_evento) {
        $nombre=  preg_replace('/\s\s+/',' ', $tipo_evento->getNombre());
        $nombre= preg_replace('/$\s+/','', $tipo_evento->getNombre());
        $nombre= preg_replace('/^\s+/','', $tipo_evento->getNombre());

        $tipo_evento->setNombre($nombre);
    }

    public function prePersist($tipo_evento) {
        $nombre=  preg_replace('/\s\s+/',' ', $tipo_evento->getNombre());
        $nombre= preg_replace('/$\s+/','', $tipo_evento->getNombre());
        $nombre= preg_replace('/^\s+/','', $tipo_evento->getNombre());

        $tipo_evento->setNombre($nombre);
    }
}
