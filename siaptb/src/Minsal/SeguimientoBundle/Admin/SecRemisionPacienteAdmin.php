<?php

namespace Minsal\SeguimientoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class SecRemisionPacienteAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper

            ->addIdentifier('codigo')
            ->add('fechaRemision')
            ->add('numeroExpediente')
            ->add('impresionDiagnostica')
            ->add('justificacionRemision')
            ->add('datosExamen')
            ->add('observacionResultado')
            ->add('tratamiento')
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
            ->add('idTipoRemision', 'entity', array('label'=>'Tipo de Remision', 'expanded'=>true, 'multiple'=>false, 'class'=>'MinsalSeguimientoBundle:CtlTipoRemision'))
            ->add('idMotivoRemision', 'entity', array('label'=>'Motivo de Remision', 'expanded'=>true, 'multiple'=>false, 'class'=>'MinsalSeguimientoBundle:CtlMotivoRemision'))
            ->add('numeroExpediente',null, array('read_only'=>true))
            ->add('impresionDiagnostica')
            ->add('justificacionRemision',null, array('label'=>'Justificación o motivo de referencia/interconsulta'))
            ->add('datosExamen',null, array('label'=>'Datos positivos al interrogatorio de examen fisico'))
            ->add('observacionResultado',null, array('label'=>'Informacion relevante sobre observacione, resultado examenes realizados y resultados'))
            ->add('tratamiento')
            ->add('idAtendAreaModEstabDestino')
            ->add('idAtencionDestino',null, array('label'=>'Especialidad a la que se refiere'))
            ->add('idAtencionOrigen',null, array('label'=>'Especialidad que refiere'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('codigo')
            ->add('fechaRemision')
            ->add('numeroExpediente')
            //->add('idEstablecimientoOrigen')
            //->add('idEstablecimientoDestino')
            //->add('idEspecialidadDestino')
            ->add('impresionDiagnostica')
            ->add('justificacionRemision')
            ->add('datosExamen')
            ->add('observacionResultado')
            ->add('tratamiento')
            //->add('idRemisionPacienteOrigen')
        ;
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
            case 'create':
                return 'MinsalSeguimientoBundle:SecRemisionPacienteAdmin:edit.html.twig';
                break;
             case 'referencia_reporte':
                return 'MinsalSeguimientoBundle:SecRemisionPacienteAdmin:referencia_reporte.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    protected function configureRoutes(RouteCollection $collection) {
            $collection->add('createespe','createespe/{idhistoria}/{idespe}/{idestable}');
            $collection->add('createsolo','createsolo/{idhistoria}/{estadoEnviar}/{idespe}/{idestable}');
            $collection->add('referencia_reporte');
    }
}
