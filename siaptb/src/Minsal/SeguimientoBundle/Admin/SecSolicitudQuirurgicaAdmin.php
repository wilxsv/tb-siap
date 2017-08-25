<?php

namespace Minsal\SeguimientoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SecSolicitudQuirurgicaAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fecha', null, array('label' => 'Fecha Solicitud'), null, array('attr' => array( 'class' => 'bootstrap-datepicker now')))
            ->add('idHistorialClinico.idExpediente.numero', null, array('label' => 'N° Expediente'))
            ->add('idEmpleado', null, array( 'label' => 'Médico Solicitante'))
            ->add('idManejoCirugia', null , array( 'label' => 'Manejo de Cirugía'))
            ->add('idPrioridadCirugia', null, array( 'label' => 'Prioridad de Cirugía'))
            ->add('idGradoComplejidadQuirurgica', null, array( 'label' => 'Grado de Complejidad' ))
            ->add('idRiesgoAnestesico', null, array( 'label' => 'Riesgo Anestésico' ))
            ->add('tiempoQuirurgicoEstimado', null, array( 'label' => 'Tiempo Quirurgico Estimado' ))
            ->add('idEstadoSolicitudQuirurgica', null, array( 'label' => 'Estado de Solicitud' ))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('fecha', null, array('label' => 'Fecha Solicitud'))
            ->add('idHistorialClinico.idExpediente', null, array('label' => 'N° Expediente'))
            ->add('idHistorialClinico.idExpediente.idPaciente', null, array('label' => 'Nombre del Paciente'))
            ->add('idEmpleado', null, array( 'label' => 'Médico Solicitante'))
            ->add('procedimientoQuirurgico', 'sonata_type_collection', array('label' =>'Procedimientos Quirurgicos Solicitados'),
                                                                       array('edit' => 'inline', 'inline' => 'table'))
            ->add('idManejoCirugia', null , array( 'label' => 'Manejo de Cirugía'))
            ->add('idPrioridadCirugia', null, array( 'label' => 'Prioridad de Cirugía', 'template' => 'MinsalSeguimientoBundle:SecSolicitudQuirurgica:list_idPrioridadCirugia.html.twig'))
            ->add('idGradoComplejidadQuirurgica', null, array( 'label' => 'Grado de Complejidad' ))
            ->add('idRiesgoAnestesico', null, array( 'label' => 'Riesgo Anestésico' ))
            ->add('tipoAnestesia', null, array( 'label' => 'Anestesia', 'template' => 'MinsalSeguimientoBundle:SecSolicitudQuirurgica:list_tipoAnestesia.html.twig'))
            // ->add('tipoAnestesia', 'sonata_type_collection', array('label' =>'Anestesia Solicitada'),
            //                                                  array('edit' => 'inline', 'inline' => 'table'))
		    ->add('tiempoQuirurgicoEstimado', null, array( 'label' => 'Tiempo Quirurgico Estimado' ))
		    ->add('idEstadoSolicitudQuirurgica', null, array( 'label' => 'Estado de Solicitud', 'template' => 'MinsalSeguimientoBundle:SecSolicitudQuirurgica:list_idEstadoSolicitudQuirurgica.html.twig' ))
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
            ->add('tiempoQuirurgicoEstimado')
            ->add('observaciones')
            ->add('solicitudMateriales')
            ->add('fecha')
            ->add('fechaHoraRegistro')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('fecha', null, array('label' => 'Fecha Solicitud'))
            ->add('idHistorialClinico.idExpediente', null, array('label' => 'N° Expediente'))
            ->add('idHistorialClinico.idExpediente.idPaciente', null, array('label' => 'Nombre del Paciente'))
            ->add('idEmpleado', null, array( 'label' => 'Médico Solicitante'))
            ->add('procedimientoQuirurgico', 'sonata_type_collection', array('label' =>'Procedimientos Quirurgicos Solicitados'),
                                                                       array('edit' => 'inline', 'inline' => 'table'))
            ->add('idManejoCirugia', null , array( 'label' => 'Manejo de Cirugía'))
            ->add('idPrioridadCirugia', null, array( 'label' => 'Prioridad de Cirugía'))
            ->add('idGradoComplejidadQuirurgica', null, array( 'label' => 'Grado de Complejidad' ))
            ->add('idRiesgoAnestesico', null, array( 'label' => 'Riesgo Anestésico' ))
            ->add('tipoAnestesia', 'sonata_type_collection', array('label' =>'Anestesia Solicitada'),
                                                             array('edit' => 'inline', 'inline' => 'table'))
            ->add('tiempoQuirurgicoEstimado', null, array( 'label' => 'Tiempo Quirurgico Estimado (min)' ))
            ->add('idEstadoSolicitudQuirurgica', null, array( 'label' => 'Estado de Solicitud' ))
            ->add('observaciones', 'html')
            ->add('solicitudMateriales', 'html', array('label' => 'Materiales Solicitados'))
        ;
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'show':
                return 'MinsalSeguimientoBundle:SecSolicitudQuirurgica:show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    public function prePersist($solicitudQuirurgica) {

        foreach ($solicitudQuirurgica->getProcedimientoQuirurgico() as $procedimiento) {
            $procedimiento->setIdSolicitudQuirurgica($solicitudQuirurgica);
        }

        foreach ($solicitudQuirurgica->getTipoAnestesia() as $anestesia) {
            $anestesia->setIdSolicitudQuirurgica($solicitudQuirurgica);
        }

        foreach ($solicitudQuirurgica->getAptitudQuirurgica() as $aptitud) {
            $aptitud->setIdSolicitudQuirurgica($solicitudQuirurgica);
            $aptitud->setFechaHoraRegistro(new \DateTime());
        }
    }

    public function preUpdate($solicitudQuirurgica) {

        foreach ($solicitudQuirurgica->getProcedimientoQuirurgico() as $procedimiento) {
            $procedimiento->setIdSolicitudQuirurgica($solicitudQuirurgica);
        }

        foreach ($solicitudQuirurgica->getTipoAnestesia() as $anestesia) {
            $anestesia->setIdSolicitudQuirurgica($solicitudQuirurgica);
        }

        foreach ($solicitudQuirurgica->getAptitudQuirurgica() as $aptitud) {
            $aptitud->setIdSolicitudQuirurgica($solicitudQuirurgica);
            $aptitud->setFechaHoraRegistro(new \DateTime());
        }
    }
}
