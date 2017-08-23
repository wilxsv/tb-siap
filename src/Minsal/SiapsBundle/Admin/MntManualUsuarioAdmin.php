<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Validator\ErrorElement;

class MntManualUsuarioAdmin extends Admin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('fechaHoraRegistro')
                ->add('fechaHoraModifica')
                ->add('activo')
                ->add('idModulo')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('fechaHoraRegistro')
                ->add('fechaHoraModifica')
                ->add('activo', null, array('editable' => true))
                ->add('idModulo')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'show' => array(),
                        'edit' => array())
                ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $entity = $this->getSubject();
        $pdfOptions['label'] = 'Seleccione archivo en formato pdf';
        $pdfOptions['required'] = true;
        $pdfOptions['img_width'] = 0;
        $pdfOptions['img_height'] = 0;
        $pdfOptions['display_name'] = '';
        $pdfOptions['file_type'] = '';
        $pdfOptions['directory'] = '';
        $pdfOptions['thumbnail'] = false;

        if ($entity->getId()) {
            if ($entity->getIdRutaManual()) {
                $pdfOptions['img_width'] = 10;
                $pdfOptions['display_name'] = $entity->getIdRutaManual();
                $pdfOptions['thumbnail'] = true; //SI QUIERO EL ICONO DE DESCARGA DEBE SER TRUE
                $pdfOptions['file_type'] = 'document/pdf';
                $pdfOptions['directory'] = 'manualUsuario';
            }
        }

        $formMapper
                ->add('file', 'file', $pdfOptions)
                ->add('idModulo', null, array('label' => 'Módulo', 'empty_value' => 'Seleccione..'))
                ->add('activo')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->add('idRutaManual', 'file', array('label' => 'Nombre Manual',
                    'file_type' => 'document/pdf', 'thumbnail' => true, 'directory' => 'manualUsuario'))
                ->add('fechaHoraRegistro')
                ->add('fechaHoraModifica')
                ->add('idModulo')
                ->add('activo')
        ;
    }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('delete');
    }

    /*
     * Método que se ejecuta antes de realizar una inserción.
     * 
     */

    public function prePersist($manual) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $manual->setUsuarioRegistra($user);
        $manual->setFechaHoraRegistro(new \DateTime());
    }

    public function postPersist($manual) {
        parent::postPersist($manual);
        $this->saveFile($manual);
    }

    /*
     * Método que se ejecuta antes de realizar una actualización.
     *      
     */

    public function preUpdate($manual) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $manual->setUsuarioModifica($user);
        $manual->setFechaHoraModifica(new \DateTime());
        $this->saveFile($manual);
    }

    public function saveFile($object) {
        if ($object->getFile()) {
            $object->upload();
        }
    }

    public function validate(ErrorElement $errorElement, $manual) {

        if (is_null($manual->getId())) {
            $repetido = $this->getModelManager()
                    ->findBy('MinsalSiapsBundle:MntManualUsuario', array('activo' => true, 'idModulo' => $manual->getIdModulo()->getId()));

            if (count($repetido) > 0) {
                $errorElement->with('idModulo')
                        ->addViolation('Ya existe un manual de usuario activo para este módulo. Primero desactivar el otro manual y luego introducir este')
                        ->end();
            }
        }

        if ($manual->getFile()->guessExtension() <> 'pdf') {
            $errorElement->with('idRutaArchivo')
                    ->addViolation('La extensión no es valida. Debe ser archivo pdf')
                    ->end();
        }
    }

}
