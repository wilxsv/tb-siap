<?php

namespace Minsal\LaboratorioBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Minsal\SeguimientoBundle\Entity\SecSolicitudestudios;

class SecSolicitudestudiosAdmin extends Admin
{
    protected $baseRouteName = 'admin_minsal_laboratorio_secsolicitudestudios';
    protected $baseRoutePattern = 'minsal/laboratorio/secsolicitudestudios';

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $request = $this->getConfigurationPool()->getContainer()->get('request');
        $now = new \DateTime();
        $datagridMapper
            ->add('fechaSolicitud',
                'doctrine_orm_date_range', array(
                    'label' => 'Fecha de Consulta médica',
                ),
                'sonata_type_date_range', array(
                   'format' => 'dd/MM/yyyy',
                   'widget' => 'single_text',
                   'attr' => array(
                       'class' => 'bootstrap-datepicker now',
                       'label_start' => 'Desde',
                       'label_end' => 'Hasta'
                    )
                )
            )
            ->add('nombreEspecialidad',
                'doctrine_orm_callback',array(
                    'label'         => 'Especialidad',
                    'callback'      => array($this, 'getNombreEspecialidadFilter')
                ),
                'sonata_type_filter_default', array(
                    'field_options' => array(
                        'label_attr'    => array('class' => 'hidden')
                    )
                )
            )
            ->add('nombreEmpleado',
                'doctrine_orm_callback',array(
                    'label'         => 'Médico',
                    'callback'      => array($this, 'getNombreEmpleadoFilter')
                ),
                'sonata_type_filter_default', array(
                    'field_options' => array(
                        'label_attr'    => array('class' => 'hidden')
                    )
                )
            )
        ;
        if($request->get('_external') === 'false' || $request->get('_external') === null) {
            $datagridMapper
                ->add('numeroExpediente',
                        'doctrine_orm_callback',array(
                            'label'         => 'Numero de Expediente',
                            'callback'      => array($this, 'getNumeroExpedienteFilter')
                        ),
                        'sonata_type_filter_default', array(
                            'field_options' => array(
                                'label_attr'    => array('class' => 'hidden')
                            )
                        )
                    )
                ->add('nombrePaciente',
                        'doctrine_orm_callback',array(
                            'label'         => 'Nombre del Paciente',
                            'callback'      => array($this, 'getNombrePacienteFilter')
                        ),
                        'sonata_type_filter_default', array(
                            'field_options' => array(
                                'label_attr'    => array('class' => 'hidden')
                            )
                        )
                    )
            ;
        }
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $request = $this->getConfigurationPool()->getContainer()->get('request');

        $listMapper
            ->add('fechaSolicitud','date',array('label' => 'Fecha consulta médica', 'date_format' => 'dd/MM/yyyy'))
            ->add('nombreEspecialidad',null,array('label' => 'Especialidad'))
            ->add('nombreEmpleado',null,array('label' => 'Médico'))
        ;
        if($request->get('_external') === 'false' || $request->get('_external') === null) {
            $listMapper
                ->add('numeroExpediente',null,array('label' => 'Número de Expediente'))
                ->add('nombrePaciente',null,array('label' => 'Nombre del Paciente'))
            ;
        }
        $listMapper
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(
                        'template' => 'MinsalLaboratorioBundle:CRUD:SecSolicitudestudios/list__action_show.html.twig'
                    ),
                    'edit' => array(
                        'template' => 'MinsalLaboratorioBundle:CRUD:SecSolicitudestudios/edit__action_show.html.twig'
                    )
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
            ->with('Búsqueda', array('class' => 'col-md-6'))->end()
            ->with('Paciente', array('class' => 'col-md-6'))->end()
            ->with('Solicitud', array('class' => 'col-md-12'))->end()
            ->end()

            ->with('Búsqueda')
                ->add('idEstablecimiento')
            ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('fechaSolicitud')
            ->add('fechahorareg')
            ->add('impresiones')
            ->add('cama')
        ;
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'MinsalLaboratorioBundle:CRUD:SecSolicitudestudios/list.html.twig';
                break;
            case 'edit':
                return 'MinsalLaboratorioBundle:CRUD:SecSolicitudestudios/edit.html.twig';
                break;
            case 'assign_exam':
                return 'MinsalLaboratorioBundle:Custom:SecSolicitudestudios/assign_exam.html.twig';
                break;
            case 'show':
                return 'MinsalLaboratorioBundle:Custom:SecSolicitudestudios/examnResult.html.twig';
                break;
            case 'imprimir_solicitudestudios':
                    return 'MinsalLaboratorioBundle:Custom:SecSolicitudestudios/reporte_solicitudestudios.html.twig';
                    break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('batch');
        $collection->remove('export');
        $collection->add('assign_exam');
        $collection->add('agregar_solicitud');
        $collection->add('agregar_paciente_referido');
        $collection->add('imprimir_solicitudestudios','imprimir/solicitudestudios/{idHistorialClinico}');
    }

    public function createQuery($context='list'){
        $query   = parent::createQuery($context);
        $em      = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $qb      = $em->createQueryBuilder();
        $request = $this->getConfigurationPool()->getContainer()->get('request');
        $session = $this->getConfigurationPool()->getContainer()->get('session');
        $idExpediente = $request->get('idExpediente');

        $arrayIds = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->obtenerIdsSolicitudEstudiosLaboratorio($idExpediente);

        $ids = [];
        foreach ($arrayIds as $key => $value) {
	    	$ids[] = $value['id'];
	    }

        if(count($ids) > 0) {
            $ids = implode(',', $ids);
        } else {
            $ids = 0;
        }

        if($session->get('_idEmpEspecialidadEstab') !== null) {
            $query
                ->where($query->getRootAlias().'.id IN ('.$ids.')');
        }

        if($request->get('idEspecialidadHclinica') !== null && $request->get('idEspecialidadHclinica') !== '' && $request->get('useProxy') === 'true') {
            $query
                ->leftJoin($query->getRootAlias().'.idHistorialClinico', 'ti01')
                ->leftJoin('ti01.idAtenAreaModEstab', 'ti02')
                ->leftJoin('ti02.idAtencion', 'ti03')
                ->leftJoin($query->getRootAlias().'.idDatoReferencia', 'ti04')
                ->leftJoin('ti04.idAtenAreaModEstab', 'ti05')
                ->leftJoin('ti05.idAtencion', 'ti06')
                ->andWhere($qb->expr()->orX(
                        $qb->expr()->like($qb->expr()->lower('ti03.nombre'), ':nombreEspecialidad'),
                        $qb->expr()->like($qb->expr()->lower('ti06.nombre'), ':nombreEspecialidad')
                    )
                )
                ->setParameter(':nombreEspecialidad', '%' . strtolower($request->get('nombreEspecialidad')) . '%')
            ;
        }

        return $query;
    }

    public function getNombreEspecialidadFilter($queryBuilder, $alias, $field, $value) {
        if(!$value['value']['value']) {
            return;
        }

        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $qb = $em->createQueryBuilder();

        $queryBuilder
           ->leftJoin($alias.'.idHistorialClinico', 'ti01')
           ->leftJoin('ti01.idAtenAreaModEstab', 'ti02')
           ->leftJoin('ti02.idAtencion', 'ti03')
           ->leftJoin($alias.'.idDatoReferencia', 'ti04')
           ->leftJoin('ti04.idAtenAreaModEstab', 'ti05')
           ->leftJoin('ti05.idAtencion', 'ti06')
           ->andWhere($qb->expr()->orX(
                   $qb->expr()->like($qb->expr()->lower('ti03.nombre'), ':nombreEspecialidad'),
                   $qb->expr()->like($qb->expr()->lower('ti06.nombre'), ':nombreEspecialidad')
               )
           )
           ->setParameter(':nombreEspecialidad', '%' . strtolower($value['value']['value']) . '%')
        ;
    }

    public function getNombreEmpleadoFilter($queryBuilder, $alias, $field, $value) {
        if(!$value['value']['value']) {
            return;
        }

        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $qb = $em->createQueryBuilder();

        $queryBuilder
           ->leftJoin($alias.'.idHistorialClinico', 'ti07')
           ->leftJoin('ti07.idEmpleado', 'ti08')
           ->leftJoin($alias.'.idDatoReferencia', 'ti09')
           ->leftJoin('ti09.idEmpleado', 'ti10')
           ->andWhere($qb->expr()->orX(
                   $qb->expr()->like($qb->expr()->lower('ti08.nombreempleado'), ':nombreEmpleado'),
                   $qb->expr()->like($qb->expr()->lower('ti10.nombreempleado'), ':nombreEmpleado')
               )
           )
           ->setParameter(':nombreEmpleado', '%' . strtolower($value['value']['value']) . '%')
        ;
    }

    public function getNumeroExpedienteFilter($queryBuilder, $alias, $field, $value) {
        if(!$value['value']['value']) {
            return;
        }

        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $qb = $em->createQueryBuilder();

        $queryBuilder
           ->leftJoin($alias.'.idHistorialClinico', 'ti11')
           ->leftJoin('ti11.idExpediente', 'ti12')
           ->leftJoin($alias.'.idDatoReferencia', 'ti13')
           ->leftJoin('ti13.idExpedienteReferido', 'ti14')
           ->andWhere($qb->expr()->orX(
                   $qb->expr()->like($qb->expr()->lower('ti12.numero'), ':numeroExpediente'),
                   $qb->expr()->like($qb->expr()->lower('ti14.numero'), ':numeroExpediente')
               )
           )
           ->setParameter(':numeroExpediente', '%' . strtolower($value['value']['value']) . '%')
        ;
    }

    public function getNombrePacienteFilter($queryBuilder, $alias, $field, $value) {
        if(!$value['value']['value']) {
            return;
        }

        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        $qb = $em->createQueryBuilder();

        $queryBuilder
            ->leftJoin($alias.'.idHistorialClinico', 'ti15')
            ->leftJoin('ti15.idExpediente', 'ti16')
            ->leftJoin('ti16.idPaciente', 'ti17')
            ->leftJoin($alias.'.idDatoReferencia', 'ti18')
            ->leftJoin('ti18.idExpedienteReferido', 'ti19')
            ->leftJoin('ti19.idReferido', 'ti20')
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->like(
                        $qb->expr()->lower("
                            CONCAT(
                                COALESCE(CONCAT(ti17.primerNombre, ' '), ''),
                                CONCAT(
                                    COALESCE(CONCAT(ti17.segundoNombre, ' '), ''),
                                    CONCAT(
                                        COALESCE(CONCAT(ti17.tercerNombre, ' '), ''),
                                        CONCAT(
                                            COALESCE(CONCAT(ti17.primerApellido, ' '), ''),
                                            CONCAT(
                                                COALESCE(CONCAT(ti17.segundoApellido, ' '), ''),
                                                COALESCE(ti17.apellidoCasada, '')
                                            )
                                        )
                                    )
                                )
                            )"
                        ),
                        ':nombrePaciente'
                    ),
                    $qb->expr()->like(
                        $qb->expr()->lower("
                            CONCAT(
                                COALESCE(CONCAT(ti20.primerNombre, ' '), ''),
                                CONCAT(
                                    COALESCE(CONCAT(ti20.segundoNombre, ' '), ''),
                                    CONCAT(
                                        COALESCE(CONCAT(ti20.tercerNombre, ' '), ''),
                                        CONCAT(
                                            COALESCE(CONCAT(ti20.primerApellido, ' '), ''),
                                            CONCAT(
                                                COALESCE(CONCAT(ti20.segundoApellido, ' '), ''),
                                                COALESCE(ti20.apellidoCasada, '')
                                            )
                                        )
                                    )
                                )
                            )"
                        ),
                        ':nombrePaciente'
                    )
                )
            )
           ->setParameter(':nombrePaciente', '%' . strtolower($value['value']['value']) . '%')
        ;
    }
}
