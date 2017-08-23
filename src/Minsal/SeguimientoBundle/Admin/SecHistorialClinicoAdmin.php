<?php

namespace Minsal\SeguimientoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Range;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SecHistorialClinicoAdmin extends Admin {

    protected $datagridValues = array(
        '_page' => 1, // Display the first page (default = 1)
        '_sort_order' => 'DESC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'fechaconsulta' // name of the ordered field (default = the model id field, if any)
    );

    protected function configureFormFields(FormMapper $formMapper) {

        $request = $this->getConfigurationPool()->getContainer()->get('request');
        $routeName = $request->get('_route');

        if( $routeName == 'admin_minsal_seguimiento_sechistorialclinico_retroactive'){
            $formMapper
                ->add('idRetroactiva', 'hidden', array('label' => 'Id', 'required' => false, 'mapped' => false))
                ->add('fechaconsulta', 'date', array( 'label' => 'Fecha de Realización de Consulta', 'required' => true, 'widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'input' => 'string', 'attr' => array( 'class' => 'fd_date bootstrap-datepicker now', 'data-mask'=>'99/99/9999', 'placeholder'=>"dd/mm/aaaa" ) ) )
                ->add('idEmpleado', null, array( 'label' => 'Medico que Brindo Atención', 'required' => true,
                                                 'query_builder' => function(){
                                                    $qb = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager()->createQueryBuilder();
                                                    $qb ->select('e')
                                                        ->from('MinsalSiapsBundle:MntEmpleado', 'e')
                                                        ->innerJoin('e.idTipoEmpleado', 't')
                                                        ->where('t.codigo = :codigo')
                                                        ->setParameters( array(':codigo' => 'MED' ) );
                                                    return $qb;
                                                 }
                                            ))
                ->add('idAtenAreaModEstab', null, array( 'label' => 'Especialidad', 'required' => true, 'property' => 'nombreConsulta' ) )
                ->add('idCitaDia', 'hidden', array( 'label' => 'Id Cita', 'required' => false ) )
                ->add('idMotivoRetroactivo', null, array( 'label' => 'Motivo por el cual no se realizo la consulta', 'required' => true))
                ->add('historialLugar', 'sonata_type_admin', array('label'=>'Lugar de Realizacion', 'label_attr' => array( 'style' => 'display: none;' ) ), array('edit' => 'inline'))
            ;
        }else{

            $formMapper
                ->add('idMotivoConsulta', 'sonata_type_admin', array('label_attr' => array('style' => 'background-color: #D7F0FF; font-size: 18px; color: #0088CC; width:100%; padding: 7px; text-align: center;'), 'label' => 'Motivo de Consulta', 'delete' => false, 'required' => true), array('edit' => 'inline'))
                ->add('entregaResultados', 'checkbox', array('label' => 'Consulta de Entrega de Resultados', 'mapped' => false, 'required' => false, 'attr' => array('data-switch-enabled' => 'true', 'data-switch-float' => 'right')))
                ->add('embarazada', 'checkbox', array('label' => 'La paciente esta embarazada', 'mapped' => false, 'required' => false, 'attr' => array('data-switch-enabled' => 'true', 'data-switch-float' => 'right')))
                ->add('idDatoEmbarazo', 'sonata_type_admin', array('label_attr' => array('style' => 'background-color: #D7F0FF; font-size: 18px; color: #0088CC; width:100%; padding: 7px; text-align: center;'),
                        'label' => 'Datos Embarazo',
                        'delete' => true,
                        'required' => false), array('edit' => 'inline',
                        'inline' => 'table'))
                ->add('idMotivoRetroactivo', null, array('label'=>'Motivo por el cual no se realizo la consulta', 'attr'=>array( 'style' => 'display: none;'), 'label_attr'=>array( 'style' => 'display: none;') ))
                ->add('idSolicitudQuirurgica', null, array('label'=>'Solicitud Quirurgica a Evaluar', 'attr'=>array( 'style' => 'display: none;'), 'label_attr'=>array( 'style' => 'display: none;') ))
            ;

            if( $request->get('idTipoLugar')  ){
                $formMapper
                    ->add('historialLugar', 'sonata_type_admin', array('label'=>'Lugar de Realizacion', 'label_attr' => array( 'style' => 'display: none;' ), 'required' => false ), array('edit' => 'inline'))
                ;
            }

             $formMapper->getFormBuilder()->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($formMapper) {
                if (!isset($event->getData()['embarazada'])) {
                    $form = $event->getForm();
                    $form->remove('idDatoEmbarazo');

                    $eventData = $event->getData();
                    unset($eventData['idDatoEmbarazo']);

                    $event->setData($eventData);
                }

            });
        }

    }

    protected function configureListFields(ListMapper $listMapper) {

        $request    = $this->getConfigurationPool()->getContainer()->get('request');
        $routeName  = $request->get('_route');
        $preroute   = $request->server->get('HTTP_REFERER');
        $external   = $request->get('external') ? ( $request->get('external') == 'true' ? true : false ) : false;
        $selectable = $request->get('selectable') ? ( $request->get('selectable') == 'true' ? true : false ) : false;
        //if ($routeName == 'admin_minsal_seguimiento_sechistorialclinico_historias_clinicas_pre_show') {//Routa de Consulta de Historias Clinicas de Paciente por Especialidad
        if ( $external ) {
            if( $selectable ){
                $actionsArray = array('show'        => array(),
                                      'seleccionar' => array(
                                                        'label'    => 'Seleccionar',
                                                        'template' => 'MinsalSeguimientoBundle:SecHistorialClinico:list__action_select.html.twig'
                                                        )
                                    );
            }
            else{
                $actionsArray = array( 'show' => array() );
            }

            $listMapper
                    ->add('idExpediente.numero', null, array('label' => 'N° Expediente'))
                    ->add('idAtenAreaModEstab.nombreConsulta', null, array('label' => 'Especialidad'))
                    ->add('fechaconsulta', null, array('label' => 'Fecha de Consulta'))
                    ->add('idMotivoConsulta', null, array('label' => 'Motivo de Consulta'))
                    ->add('idEmpleado', null, array('label' => 'Médico'))
                    ->add('idEstadoHistoriaClinica', null, array('label' => 'Estado'))
                    ->add('_action', 'actions', array(
                        'actions' => $actionsArray
                    ))
            //->addIdentifier('id', null , array('label'=>'Id', 'route' => array('name' => 'show')))
            ;

        } else { //List Normal agregar campos aqui
            $listMapper
                    ->addIdentifier('id', null, array('label' => 'Id'))
            ;
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $request = $this->getConfigurationPool()->getContainer()->get('request');
        $routeName = $request->get('_route');
        $external = $request->get('external') ? ( $request->get('external') == 'true' ? true : false ) : false;

        //if ($routeName == 'admin_minsal_seguimiento_sechistorialclinico_historias_clinicas_pre_show') {//Routa de Consulta de Historias Clinicas de Paciente por Especialidad
        if ( $external ) {
            $datagridMapper
                ->add('fechaconsulta', null, array( 'label' => 'Fecha Consulta' ), null, array('attr' => array( 'class' => 'bootstrap-datepicker now')) )
                ->add('idEmpleado', null, array( 'label' => 'Médico' ) )
            ;
            if( ! $request->get('idEspecialidadHclinica') ){
                $datagridMapper->add('idAtenAreaModEstab.idAtencion', null, array( 'label' => 'Especialidad') );
            }
        } else { // Filtros para List Normal agregar campos aqui
            $datagridMapper

            ;
        }
    }

    public function validate(ErrorElement $errorElement, $historialClinico) {

        $idDatoEmbarazo = $this->getForm()->get('embarazada')->getData();
        if ($this->getForm()->get('embarazada')->getData()) {
            if (is_null($historialClinico->getIdDatoEmbarazo()->getFechaUltimaMestruacion())) {
                $errorElement->with('idDatoEmbarazo')
                        ->addViolation('La fecha de ultima mestruación (FUM) es obligatoria')
                        ->end();
            } else {
                if (is_null($historialClinico->getIdDatoEmbarazo()->getFechaProblableParto())) {
                    $errorElement->with('idDatoEmbarazo')
                            ->addViolation('La fecha probable de parto (FPP) es obligatoria')
                            ->end();
                } else {
                    $fechaUltimaMestruacion = date('d-m-Y', strtotime('+7 month', strtotime($historialClinico->getIdDatoEmbarazo()->getFechaUltimaMestruacion()->format('d-m-Y'))));
                    $fechaUltimaMestruacion = new \DateTime($fechaUltimaMestruacion);
                    if ($historialClinico->getIdDatoEmbarazo()->getFechaProblableParto() <= $fechaUltimaMestruacion) {
                        $errorElement->with('idDatoEmbarazo')
                                ->addViolation('La fecha probable de parto debe de ser mayor por lo menos 7 meses a la fecha de ultima mestruación')
                                ->end();
                    }
                }
            }

            if (is_null($this->getForm()->get('idDatoEmbarazo')->get('gravidez')->getData())) {
                $errorElement->with('idDatoEmbarazo')
                        ->addViolation('La Gravidez (G) es obligatoria')
                        ->end();
            }

            if (is_null($this->getForm()->get('idDatoEmbarazo')->get('partos')->getData())) {
                $errorElement->with('idDatoEmbarazo')
                        ->addViolation('La cantidad de partos (P) es obligatoria')
                        ->end();
            }

            if (is_null($this->getForm()->get('idDatoEmbarazo')->get('prematuros')->getData())) {
                $errorElement->with('idDatoEmbarazo')
                        ->addViolation('La cantidad de partos prematuros (P) es obligatoria')
                        ->end();
            }

            if (is_null($this->getForm()->get('idDatoEmbarazo')->get('abortos')->getData())) {
                $errorElement->with('idDatoEmbarazo')
                        ->addViolation('La cantidad de abortos (A) es obligatoria')
                        ->end();
            }

            if (is_null($this->getForm()->get('idDatoEmbarazo')->get('vivos')->getData())) {
                $errorElement->with('idDatoEmbarazo')
                        ->addViolation('La cantidad de nacidos vivos (V) es obligatoria')
                        ->end();
            }

            // if( $this->getForm()->get('idDatoEmbarazo')->get('controlPrenatal')->getData() ){
            //     if( ! $this->getForm()->get('idDatoEmbarazo')->get('idEstablecimientoControl')->getData() ){
            //         $errorElement->with('idDatoEmbarazo.idEstablecimientoControl')
            //             ->addViolation('La cantidad de nacidos vivos (V) es obligatoria')
            //         ->end();
            //     }
            // }
        }
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'edit':
                return 'MinsalSeguimientoBundle:SecHistorialClinico:edit.html.twig';
                break;
            case 'show':
                return 'MinsalSeguimientoBundle:SecHistorialClinico:show.html.twig';
                break;
            case 'finalizar_consulta':
                return 'MinsalSeguimientoBundle:SecHistorialClinico:finalizar_consulta.html.twig';
                break;
            case 'historias_clinicas_pre_show':
                return 'MinsalSeguimientoBundle:SecHistorialClinico:historias_clinicas_pre_show.html.twig';
                break;
            case 'imprimir_historia_clinica':
                return 'MinsalSeguimientoBundle:Reportes:imprimir_historia_clinica.html.twig';
                break;
            case 'list':
                return 'MinsalSeguimientoBundle:SecHistorialClinico:list.html.twig';
                break;
            case 'retroactive':
                return 'MinsalSeguimientoBundle:SecHistorialClinico:Retroactive/retroactive.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }

    public function prePersist($historialClinico) {
        $mc = $historialClinico->getIdMotivoConsulta();
        $mc->setIdHistorialClinico($historialClinico);

        if ($this->getForm()->get('embarazada')->getData()) {
            $de = $historialClinico->getIdDatoEmbarazo();
            $de->setIdHistorialClinico($historialClinico);
        }

        if( $historialClinico->getHistorialLugar() ){
            $lugar = $historialClinico->getHistorialLugar();
            $lugar->setIdHistorialClinico($historialClinico);
        }
    }

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('finalizar_consulta', 'finalizar/consulta/{idHistorialClinico}');
        $collection->add('seguimiento_consulta', 'seguimiento/consulta/{idHistorialClinico}');
        $collection->add('cerrar_consulta', 'cerrar/consulta/{idHistorialClinico}');
        $collection->add('historias_clinicas_pre_show', 'historiasclinicas/preshow');
        $collection->add('imprimir_historia_clinica', 'imprimir/historia/clinica/{id}');
        $collection->add('change_status_form', 'change/status/form/{id}/{status}');
        $collection->add('remove_form', 'remove/form/{id}');
        $collection->add('retroactive', 'retroactive/consulta');
        $collection->add('pacientes_atendidos', 'detalle/pacientes/atendidos');
        $collection->add('historias_clinicas_medicos', 'detalle/historias/clinicas/medicos');
    }

    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);
        $CurrentUser = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        $request = $this->getConfigurationPool()->getContainer()->get('request');
        $routeName = $request->get('_route');
        $external = $request->get('external') ? ( $request->get('external') == 'true' ? true : false ) : false;

        //if ($routeName == 'admin_minsal_seguimiento_sechistorialclinico_historias_clinicas_pre_show') {//Routa de Consulta de Historias Clinicas de Paciente por Especialidad
        if ( $external ) {
            if( $request->get('idEspecialidadHclinica') ){
                return new ProxyQuery(
                        $query
                                ->where($query->getRootAlias() . '.idExpediente = ' . $request->get('idExpedienteHclinica'))
                                ->andWhere($query->getRootAlias() . '.idAtenAreaModEstab = ' . $request->get('idEspecialidadHclinica'))
                                ->andWhere($query->getRootAlias() . '.idEstadoHistoriaClinica IN (4,5)')
                );
            }
            else{
                return new ProxyQuery(
                        $query
                                ->where($query->getRootAlias() . '.idExpediente = ' . $request->get('idExpedienteHclinica'))
                                ->andWhere($query->getRootAlias() . '.idEstadoHistoriaClinica IN (4,5)')
                );
            }
        } else {
            return new ProxyQuery(
                    $query
                            ->where($query->getRootAlias() . '.id > 0')
            );
        }
    }

}

?>
