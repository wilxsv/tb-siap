<?php

namespace Minsal\SiapsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class MntExpedienteAdmin extends Admin {

    protected function configureFormFields(FormMapper $formMapper) {
        $esdomed = $this->getModelManager()
                ->findOneBy('MinsalSiapsBundle:CtlCreacionExpediente', array('id' => 3));

        $ruta_accion = explode('/', $this->getRequest()->getUri());
        $accion = array_pop($ruta_accion);
        $accion = array_pop($ruta_accion);
        $accion = array_pop($ruta_accion);
        $numero = $this->getConfigurationPool()->getContainer()
                ->get('doctrine')
                ->getRepository('MinsalSiapsBundle:MntExpediente')
                ->obtenerExpedienteSugerido();
        if ($accion == 'admin') {
            $formMapper
                    ->add('numero', null, array('required' => true,
                        'label' => $this->getTranslator()->trans('numero'),
                        'attr' => array('value' => $numero)))
                    ->add('idCreacionExpediente', null, array('required' => true,
                        'preferred_choices' => array($esdomed),
                        'label' => $this->getTranslator()->trans('idCreacionExpediente')))
            ;
        } else {
             if ($this->getRequest()->get('id')) {
                 $expediente = $this->getModelManager()
                         ->getEntityManager('MinsalSiapsBundle:MntExpediente')
                         ->createQuery("
                     SELECT e
                     FROM MinsalSiapsBundle:MntExpediente e
                     JOIN e.idPaciente p
                    WHERE p.id=" . $this->getRequest()->get('id') . ' AND e.habilitado = TRUE')
                        ->getResult();
                if($expediente){
                    $expediente=$expediente[0];
                    if ($expediente->getNumeroTemporal()) {
                        $formMapper
                                ->add('numero', null, array('required' => true,
                                    'label' => $this->getTranslator()->trans('numero'),
                                    'attr' => array('value' => $numero, 'data-toggle' => 'tooltip',
                                        'title' => "Este valor es el ultimo expediente no el valor provisional que tenia")))
                                ->add('idCreacionExpediente', null, array('required' => true,
                                    'preferred_choices' => array($esdomed),
                                    'label' => $this->getTranslator()->trans('idCreacionExpediente')))
                        ;
                    }else{
                        $formMapper
                            ->add('numero', null, array('required' => true,
                                'label' => $this->getTranslator()->trans('numero')))
                            ->add('idCreacionExpediente', null, array('required' => true,
                                'preferred_choices' => array($esdomed),
                                'label' => $this->getTranslator()->trans('idCreacionExpediente')))
                    ;
                    }
                }else {
                    $formMapper
                            ->add('numero', null, array('required' => true,
                                'label' => $this->getTranslator()->trans('numero')))
                            ->add('idCreacionExpediente', null, array('required' => true,
                                'preferred_choices' => array($esdomed),
                                'label' => $this->getTranslator()->trans('idCreacionExpediente')))
                    ;
                }

            } else {
                $formMapper
                        ->add('numero', null, array('required' => true,
                            'label' => $this->getTranslator()->trans('numero')))
                        ->add('idCreacionExpediente', null, array('required' => true,
                            'preferred_choices' => array($esdomed),
                            'label' => $this->getTranslator()->trans('idCreacionExpediente')))
                ;
            }
        }
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'MinsalSiapsBundle:MntExpedienteAdmin:list.html.twig';
                break;
            case 'listarexpedientes':
                return 'MinsalSiapsBundle:MntExpedienteAdmin:listarexpedientes.html.twig';
                break;
             case 'listarexpedientes_por_anio':
                return 'MinsalSiapsBundle:MntExpedienteAdmin:listarexpedientes_por_anio.html.twig';
                break;
             case 'listarexpedientes_por_correlativo':
                return 'MinsalSiapsBundle:MntExpedienteAdmin:listarexpedientes_por_correlativo.html.twig';
                break;
            case 'depuracion':
                return 'MinsalSiapsBundle:MntExpedienteAdmin:depuracion.html.twig';
                break;
            case 'reporteDepuracion':
                return 'MinsalSiapsBundle:MntExpedienteAdmin:reporte_depuracion.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('delete');
        $collection->add('listarexpedientes');
        $collection->add('listarexpedientes_por_anio','listarexpedientes/por/anio');
        $collection->add('listarexpedientes_por_correlativo','listarexpedientes/por/correlativo');
        $collection->add('depuracion','depuracion/expediente/fisico');
        $collection->add('reporte_depuracion','reporte/depuracion/expediente/fisico');

    }

    public function getBatchActions() {
        $actions = parent::getBatchActions();
        $actions['delete'] = null;
    }

}

?>
