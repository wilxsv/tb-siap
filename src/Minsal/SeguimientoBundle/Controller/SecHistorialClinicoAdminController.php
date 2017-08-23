<?php

namespace Minsal\SeguimientoBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\Metodos\Funciones;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraints;
//ENTIDADES UTILIZADAS
use Minsal\SeguimientoBundle\Entity\SecFormulariosPorConsulta as Temporal;
use Minsal\SeguimientoBundle\Entity\TarPaciente as PacienteTar;
use Minsal\SeguimientoBundle\Entity\SecOtrasObservaciones as SecOtrasObservaciones;
use Minsal\SeguimientoBundle\Entity\SecConsejeria;
use Minsal\SeguimientoBundle\Entity\SecAntecedentesEspecialidadForm;
use Minsal\SiapsBundle\Entity\MntAuditoriaGrupoDispensarial as AuditoriaGrupo;
use Minsal\SeguimientoBundle\Controller\ClienteController as Cliente;
use Minsal\SeguimientoBundle\Entity\SecAntecedentes as Antecedente;
use Minsal\SeguimientoBundle\Entity\SecAntecedentesObstetricos as Obstetricos;
use Minsal\SeguimientoBundle\Entity\MntAuditoriaSeguimiento;
use Minsal\SeguimientoBundle\Entity\SecHistorialSeguimiento;
use Minsal\SeguimientoBundle\Entity\SecMotivoConsulta;
use Minsal\SeguimientoBundle\Entity\SecHistorialLugar;
use Minsal\SeguimientoBundle\Entity\SecDiagnosticoPaciente;

class SecHistorialClinicoAdminController extends Controller {
    /*
     * DESCRIPCIÓN: Método que se utiliza para la creación del historial clínico.
     * PARÁMETROS DE ENTRADA:
     *                  -id_expediente: id del expediente que pasará la consulta
     *                  -id_empleado: id del médico que realiza la consulta.
     *                  -id_aten_area_mod_estab: la especialidad con la que trabaja el médico
     * PARAMETROS DE ENVIO:
     *                  -action: create para saber que es de tipo inserción
     *                  -form: renderizado del formulario
     *                  -object: objeto tipo historial clinico
     *                  -edad: edad del paciente
     *                  -expediente: objeto expediente según el id_expediente que se recibe.
     * ANALISTA PROGRAMADOR: Karen Peñate, Aaron Romero, Wilber Romero, Orlando Martínez, Caleb Rodríguez
     */

    protected $requestScheme;
    protected $codeEnviroment;
    protected $environment;
    protected $domain;

    public function setContainer(ContainerInterface $container = null) {
        parent::setContainer($container);

        $this->requestScheme = $this->container->get('request')->server->get('REQUEST_SCHEME');
        $this->codeEnvironment = $this->container->getParameter("kernel.environment");
        if ($this->codeEnvironment === 'dev') {
            $this->environment = '/app_dev.php';
        } else {
            $this->environment = '/app.php';
        }
        $this->domain = $this->container->get('request')->server->get('HTTP_HOST');
    }

    public function createAction() {
        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $em = $this->getDoctrine()->getManager();
        /* OBTENIENDO EL ID EXPEDIENTE ENVIADO POR LA URL */
        $request                = $this->get('request');
        $id_expediente          = $request->get('id_expediente');
        $id_empleado            = $request->get('id_empleado');
        $idEmpleado             = $em->getRepository("MinsalSiapsBundle:MntEmpleado")->find($id_empleado);
        $id_aten_area_mod_estab = $request->get('id_aten_area_mod_estab');
        $expediente             = $em->getRepository("MinsalSiapsBundle:MntExpediente")->find($id_expediente);
        $idCitaDia              = $request->get('id_cita');
        $establecimiento        = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));

        $typeCreate = $request->get('typeCreate') ? $request->get('typeCreate') : 'normal-mode';

        $displayResultsHistory = $this->getAllowResultsHistory($id_expediente, $id_aten_area_mod_estab);

        if ($typeCreate == 'normal-mode') {

            $dql = "SELECT DISTINCT B
                    FROM MinsalSeguimientoBundle:SecHistorialClinico A
                    JOIN MinsalSiapsBundle:MntAtenAreaModEstab B WITH (A.idAtenAreaModEstab = B.id)
                    WHERE A.idExpediente = " . $id_expediente . "
                    AND A.piloto = 'F'
                    AND A.idEstadoHistoriaClinica IN (4,5)
                    ORDER BY B.id ASC";
            $idEspecialidad = $em->createQuery($dql)->getResult();

            $citCitaDia = $em->getRepository("MinsalCitasBundle:CitCitasDia")->find($idCitaDia);
            if ($citCitaDia->getIdEstado()->getId() == 5) {
                $idHistorialClinico = $em->getRepository("MinsalSeguimientoBundle:SecHistorialClinico")->findOneBy(array('idCitaDia' => $idCitaDia));
                return $this->finalizarConsultaAction($idHistorialClinico);
            } elseif ($citCitaDia->getIdEstado()->getId() == 8) {
                $idHistorialClinico = $em->getRepository("MinsalSeguimientoBundle:SecHistorialClinico")->findOneBy(array('idCitaDia' => $idCitaDia));
                return $this->redirect($this->admin->generateUrl('seguimiento_consulta', array('idHistorialClinico' => $idHistorialClinico->getId())));
            }

            $conn = $em->getConnection();
            $calcular = new Funciones();

            $edad = $calcular->calcularEdad($conn, $expediente->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $expediente->getIdPaciente()->getHoraNacimiento() ? $expediente->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );
            $object = $this->admin->getNewInstance();

            /* Evalua si la consulta se creara de forma Retroactiva, y setea el Motivo al Objeto, esto permite que vaya seteado desde un principio */
            $idMotivoRetroactivo = $request->get('idMotivoRta') ? $request->get('idMotivoRta') : null;
            $retroactiva = $request->get('rta') ? ( $request->get('rta') == 'true' ? true : false ) : false;
            if ($idMotivoRetroactivo && $retroactiva) {
                $object->setIdMotivoRetroactivo($em->getRepository("MinsalSeguimientoBundle:CtlMotivoRetroactivo")->findOneBy(array('id' => $idMotivoRetroactivo)));
            }

            /* Evalua si la consulta se ha realizado fuera del establecimiento */
            $idTipoLugar = $request->get('idTipoLugar') ? $request->get('idTipoLugar') : null;
            $nombreLugar = $request->get('nombreLugar') ? $request->get('nombreLugar') : null;

            if( $idTipoLugar ){
                $historialLugar = new SecHistorialLugar();
                $historialLugar->setIdTipoLugarTrabajo($em->getRepository("MinsalSeguimientoBundle:CtlTipoLugarTrabajo")->findOneBy(array('id' => $idTipoLugar)));
                $historialLugar->setNombre($nombreLugar);

                $object->setHistorialLugar($historialLugar);
            }

            $this->admin->setSubject($object);

            /* Setear la Hora de Inicio de la consulta desde el momento en que el formulario es desplegado */
            if (!$object->getHoraInicio()) {
                $object->setHoraInicio(new \DateTime());
            }

            $form = $this->admin->getForm();
            $form->setData($object);
            /* COMPARAR LA VARIABLE RANGO EDAD */
            $funciones = new Funciones();
            $resultado = $funciones->calcularAniosMesesDiasEdad($edad);
            $anios = $resultado['anios'];
            $meses = $resultado['meses'];
            $dias = $resultado['dias'];

            $sql = "SELECT id
                   FROM ctl_rango_edad
                   WHERE fn_convertir_anio_a_dias($anios,$meses,$dias)
                   BETWEEN fn_convertir_anio_a_dias(edad_minima_anios,edad_minima_meses,edad_minima_dias)
                          AND  fn_convertir_anio_a_dias(edad_maxima_anios,edad_maxima_meses,edad_maxima_dias)
                          AND cod_modulo = 'SEC'";
            $query_edad = $conn->query($sql);
            $query_edad = $query_edad->fetchAll();

            if ($this->getRestMethod() == 'POST') {

                $form->bind($request);

                $isFormValid = $form->isValid();

                if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {

                    if ($object->getIdMotivoRetroactivo()) {
                        $object->setFechaconsulta($citCitaDia->getFecha());
                    } else {
                        $object->setFechaconsulta(new \DateTime());
                    }

                    $object->setIdUsuarioRegistra();
                    $object->setFechaRegistra(new \DateTime());
                    $object->setIpaddress($request->server->get('REMOTE_ADDR'));
                    $object->setIdEstablecimiento($establecimiento);
                    $object->setIdEmpleado($idEmpleado);
                    $object->setIdAtenAreaModEstab($em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($id_aten_area_mod_estab));
                    $object->setIdExpediente($em->getRepository('MinsalSiapsBundle:MntExpediente')->find($id_expediente));
                    $object->setIdModalidad($em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($id_aten_area_mod_estab)->getIdAreaModEstab()->getIdAreaAtencion()->getId());
                    $object->setIdEstadoHistoriaClinica($em->getRepository('MinsalSeguimientoBundle:CtlEstadoHistoriaClinica')->findOneBy(array('codigo' => 'I'))); //<-- se repite abajo
                    $object->setIdCitaDia($em->getRepository('MinsalCitasBundle:CitCitasDia')->find($idCitaDia)); //<-- Esta Cita ya esta arriba como CitCitasDia
                    $object->setIdUsuarioRegistra($this->container->get('security.context')->getToken()->getUser());
                    $object->setIdEstadoHistoriaClinica($em->getRepository('MinsalSeguimientoBundle:CtlEstadoHistoriaClinica')->findOneBy(array('codigo' => 'EP'))); //<-- ?

                    if( $form->get('embarazada') ){
                        if( $form->get('embarazada')->getData() && $object->getIdDatoEmbarazo() ){

                            $formulaObstetrica = '{G:'.$form->get('idDatoEmbarazo')->get('gravidez')->getData().', '.
                                                  'P:'.$form->get('idDatoEmbarazo')->get('partos')->getData().', '.
                                                  'PP:'.$form->get('idDatoEmbarazo')->get('prematuros')->getData().', '.
                                                  'A:'.$form->get('idDatoEmbarazo')->get('abortos')->getData().', '.
                                                  'V:'.$form->get('idDatoEmbarazo')->get('vivos')->getData().'}';
                            $object->getIdDatoEmbarazo()->setFormulaObstetricaConsulta($formulaObstetrica);
                        }
                    }

                    $this->admin->create($object);

                    $citCitaDia->setIdEstado($this->findObject('MinsalCitasBundle', 'CitEstadoCita', 8));
                    $em->persist($citCitaDia);

                    $solicitudQuirurgica = $object->getIdSolicitudQuirurgica();
                    if( $solicitudQuirurgica ){
                        if( $solicitudQuirurgica->getIdEstadoSolicitudQuirurgica()->getId() == 1 ){
                            $solicitudQuirurgica->setIdEstadoSolicitudQuirurgica( $this->findObject('MinsalSeguimientoBundle', 'CtlEstadoSolicitudQuirurgica', 2) );
                            $em->persist($solicitudQuirurgica);
                        }
                    }

                    $em->flush();

                    if (($query_edad)) {
                        if ($query_edad[0]['id'] == 8 AND $expediente->getIdPaciente()->getIdSexo()->getId() == 2) {
                            if ($form->get('embarazada')->getData()) {
                                $paciente = $expediente->getIdPaciente();
                                $paciente->setIdCondicionPersona($this->findObject('MinsalSeguimientoBundle', 'CtlCondicionPersona', 1));
                                $em->persist($paciente);
                                $em->flush();
                                $antecedente = $em->getRepository('MinsalSeguimientoBundle:SecAntecedentes')->findOneBy(array('idPaciente' => $paciente));
                                if (!$antecedente) {
                                    $antecedente = new Antecedente();
                                    $antecedente->setIdEmpleado($idEmpleado);
                                    $antecedente->setIdPaciente($paciente);
                                    $antecedente->setFechaHoraRegistro(new \DateTime());
                                    $em->persist($antecedente);
                                    $em->flush();
                                }

                                $antecedentesObstetricos = $em->getRepository('MinsalSeguimientoBundle:SecAntecedentesObstetricos')->findOneBy(array('idAntecedentes' => $antecedente));
                                if (!$antecedentesObstetricos) {
                                    $antecedentesObstetricos = new Obstetricos();
                                }

                                $antecedentesObstetricos->setIdAntecedentes($antecedente);
                                $antecedentesObstetricos->setGestaciones($form->get('idDatoEmbarazo')->get('gravidez')->getData());
                                $antecedentesObstetricos->setPartosTermino($form->get('idDatoEmbarazo')->get('partos')->getData());
                                $antecedentesObstetricos->setPartoPrematuro($form->get('idDatoEmbarazo')->get('prematuros')->getData());
                                $antecedentesObstetricos->setAbortos($form->get('idDatoEmbarazo')->get('abortos')->getData());
                                $antecedentesObstetricos->setNacidosVivos($form->get('idDatoEmbarazo')->get('vivos')->getData());
                                $em->persist($antecedentesObstetricos);
                                $em->flush();
                            } else {
                                $paciente = $expediente->getIdPaciente();
                                $paciente->setIdCondicionPersona($this->findObject('MinsalSeguimientoBundle', 'CtlCondicionPersona', 4));
                                $em->persist($paciente);
                                $em->flush();
                            }
                        }
                    }

                    if ($this->isXmlHttpRequest()) {
                        return $this->renderJson(array(
                                    'result' => 'ok',
                                    'objectId' => $this->admin->getNormalizedIdentifier($object)
                        ));
                    }

                    $this->addFlash('sonata_flash_success', 'La consulta se ha iniciado satisfactoriamente.');

                    /*                     * ***************      Método de Selección de Formularios      *********************************** */

                    if ($form->get('entregaResultados')->getData()) { //Si es Consulta de Entrega de Resultados
                        /* Se llenara el Formulario de Entrega de Resultados */
                        $form_temp = new Temporal();
                        $form_temp->setIdFormulario($this->findObject('ApplicationCoreBundle', 'FrmFormulario', 26));
                        $form_temp->setIdHistorialClinico($object);
                        $em->persist($form_temp);
                        $em->flush();

                        /* Establece como Consulta de Entrega de Resultados */
                        $object->setIdTipoHistoriaClinica($em->getRepository('MinsalSeguimientoBundle:CtlTipoHistoriaClinica')->findOneBy(array('id' => 1)));
                        $em->persist($object);
                        $em->flush();
                    } else {
                        $formularios = $this->seleccionarFormulario($id_expediente, $id_empleado, $id_aten_area_mod_estab);

                        foreach ($formularios as $aux) {
                            $form_temp = new Temporal();
                            $form_temp->setIdFormulario($this->findObject('ApplicationCoreBundle', 'FrmFormulario', $aux['id_formulario']));
                            $form_temp->setIdHistorialClinico($object);
                            $em->persist($form_temp);
                            $em->flush();
                        }
                    }

                    /*                     * ** Fin Metodo de Seleccion de Formularios *** */
                    return $this->redirect( $this->admin->generateUrl('seguimiento_consulta', array('idHistorialClinico' => $object->getId()) ) );
                }

                // show an error message if the form failed validation
                if (!$isFormValid) {
                    if (!$this->isXmlHttpRequest()) {
                        $this->addFlash('sonata_flash_error', $this->admin->trans('flash_create_error', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
                    }
                }
            }

            $view = $form->createView();

            // set the theme for the current Admin Form
            $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

            /* OBTENER DATOS DE PACIENTE PARA MOSTRAR EN LA VISTA */
            $edadFertil = false;
            if (($query_edad)) {
                if ($query_edad[0]['id'] == 8 AND $expediente->getIdPaciente()->getIdSexo()->getId() == 2) {
                    $edadFertil = true;
                }
            }

            $dql = "SELECT s FROM MinsalSeguimientoBundle:SecSolicitudQuirurgica s
                    INNER JOIN MinsalSeguimientoBundle:SecHistorialClinico h WITH ( h.id = s.idHistorialClinico )
                    WHERE h.idExpediente = :idExpediente
                    AND s.idEstadoSolicitudQuirurgica IN (1,2)";

            $solicitudQuirurgica = $em->createQuery($dql)->setParameters( array( 'idExpediente' => $expediente->getId() ) )->getResult();

            return $this->render($this->admin->getTemplate($templateKey), array(
                        'action' => 'create',
                        'form' => $view,
                        'object' => $object,
                        'expediente' => $expediente,
                        'edad' => $edad,
                        'id_aten_area_mod_estab' => $id_aten_area_mod_estab,
                        'id_empleado' => $id_empleado,
                        'id_cita' => $idCitaDia,
                        'idEspecialidad' => $idEspecialidad,
                        'edadFertil' => $edadFertil,
                        'displayResultsHistory' => $displayResultsHistory,
                        'idTipoLugar' => $idTipoLugar,
                        'nombreLugar' => $nombreLugar,
                        'establecimiento' => $establecimiento,
                        'solicitudQuirurgica' => $solicitudQuirurgica
            ));
        } elseif ($typeCreate == 'farmrecetas-complement') {
            $history = array();
            $recetaComplementaria = $request->get('rrc') ? ( $request->get('rrc') == 'true' ? true : false ) : false;
            if ($recetaComplementaria) {
                $consultaPor = $request->get('consultaPor');
                try {
                    $object = $this->admin->getNewInstance();
                    $this->admin->setSubject($object);

                    $object->setFechaconsulta(new \DateTime());
                    $object->setIdUsuarioRegistra($this->getUser());
                    $object->setFechaRegistra(new \DateTime());
                    $object->setIpaddress($request->server->get('REMOTE_ADDR'));
                    $object->setIdEstablecimiento($establecimiento);
                    $object->setIdEmpleado($idEmpleado);
                    $object->setIdAtenAreaModEstab($em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($id_aten_area_mod_estab));
                    $object->setIdExpediente($em->getRepository('MinsalSiapsBundle:MntExpediente')->find($id_expediente));
                    $object->setIdModalidad($em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($id_aten_area_mod_estab)->getIdAreaModEstab()->getIdAreaAtencion()->getId());
                    $object->setIdEstadoHistoriaClinica($em->getRepository('MinsalSeguimientoBundle:CtlEstadoHistoriaClinica')->findOneBy(array('codigo' => 'EP')));
                    $object->setIdCitaDia($idCitaDia ? $em->getRepository('MinsalCitasBundle:CitCitasDia')->find($idCitaDia) : null);
                    $object->setPiloto('V');
                    $object->setIdTipoHistoriaClinica($em->getRepository('MinsalSeguimientoBundle:CtlTipoHistoriaClinica')->findOneBy(array('id' => 5)));
                    $object->setIdFormulario($this->findObject('ApplicationCoreBundle', 'FrmFormulario', 7));

                    $em->persist($object);

                    $motivoConsulta = new SecMotivoConsulta();
                    $motivoConsulta->setConsultaPor($consultaPor);
                    $motivoConsulta->setIdHistorialClinico($object);
                    $motivoConsulta->setPresentaEnfermedad('');

                    $em->persist($motivoConsulta);

                    $historialSeguimiento = new SecHistorialSeguimiento();
                    $historialClinicoOrigen = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->findOneBy(array('id' => $request->get('idSeguimientoHistoriaClinica')));
                    $historialSeguimiento->setIdHistorialClinicoSubsiguiente($object);
                    $historialSeguimiento->setIdHistorialClinicoOrigen($historialClinicoOrigen);

                    $em->persist($historialSeguimiento);

                    $dql = "SELECT d
                            FROM MinsalSeguimientoBundle:SecDiagnosticoPaciente d
                            WHERE d.idHistorialClinico = :idHistorial";

                    $diagnosticosOrigen = $em->createQuery($dql)->setParameters( array('idHistorial' => $historialClinicoOrigen->getId() ) )->getResult();

                    foreach ( $diagnosticosOrigen as $diag ) {
                        $diagnostico = new SecDiagnosticoPaciente();
                        $diagnostico->setIdHistorialClinico($object);
                        $diagnostico->setIdSnomed($diag->getIdSnomed());
                        $diagnostico->setIdCie10Estadista($diag->getIdCie10Estadista());
                        $diagnostico->setEspecificacion($diag->getEspecificacion());
                        $diagnostico->setIdTipoDiagnostico($diag->getIdTipoDiagnostico());
                        $diagnostico->setConfirmado($diag->getConfirmado());
                        $diagnostico->setIdCie10Medico($diag->getIdCie10Medico());
                        $diagnostico->setIdTipoConsulta($diag->getIdTipoConsulta());

                        $em->persist($diagnostico);
                    }


                    $em->flush();

                    $history['id'] = $object->getId();
                    $history['success'] = true;
                } catch (\Exception $e) {
                    $history['id'] = null;
                    $history['success'] = false;
                    $history['error'] = '' . $e;
                    return new Response(json_encode($history));
                }
            }

            return new Response(json_encode($history));
        }
    }

    /*
     * DESCRIPCIÓN: Método se utiliza para llevar el control de los formularios
     *              a utilizar en el seguimiento clínico.
     * PARÁMETROS DE ENTRADA:
     *                  -idHistorialClinico: id del historial clinico a utilizar.
     * PARAMETROS DE ENVIO:
     *                  - SEGUN REQUERIMIENTOS DE LOS FORMULARIOS A PASAR
     * ANALISTA PROGRAMADOR: Karen Peñate, Aaron Romero, Wilber Romero, Orlando Martínez
     */

    public function seguimientoConsultaAction($idHistorialClinico) {

        $reload = $this->get('request')->get('reload') ? $this->get('request')->get('reload') : 'false';
        $em = $this->getDoctrine()->getManager();
        $object = $this->admin->getObject($idHistorialClinico);
        $msj = '';
        $msjType = '';
        $expediente = $object->getIdExpediente();

        $conn = $em->getConnection();
        $calcular = new Funciones();
        $edad = $calcular->calcularEdad($conn, $expediente->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $expediente->getIdPaciente()->getHoraNacimiento() ? $expediente->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );

        $dql = "SELECT DISTINCT B
                FROM MinsalSeguimientoBundle:SecHistorialClinico A
                JOIN MinsalSiapsBundle:MntAtenAreaModEstab B WITH (A.idAtenAreaModEstab = B.id)
                WHERE A.idExpediente = " . $expediente->getId() . "
                AND A.piloto = 'F'
                AND A.idEstadoHistoriaClinica IN (4,5)
                ORDER BY B.id ASC";
        $idEspecialidad = $em->createQuery($dql)->getResult();

        $defaultView = 'MinsalSeguimientoBundle:GenerateFormTest:generateFormAdminTest.html.twig'; //Vista por defecto de los Formularios

        $viewParameters = array('action' => 'seguimiento_consulta', //Parametros por defecto de toda Vista
            'expediente' => $expediente,
            'edad' => $edad,
            'idEspecialidad' => $idEspecialidad,
            'idHistorialClinico' => $idHistorialClinico,
            'paciente' => $expediente->getIdPaciente()
        );

        $parameters = array();
        $mainIds = array();

        $formulariosConsulta = $em->getRepository('MinsalSeguimientoBundle:SecFormulariosPorConsulta')
                ->findOneBy(array('idHistorialClinico' => $idHistorialClinico, 'estado' => false));  //Buscar Formularios Pendientes de la Consulta

        if ($formulariosConsulta) {
            $nextForm = $formulariosConsulta->getIdFormulario();  //nextForm es el Formulario siguiente a realizar
            $viewParameters['idFormulario'] = $nextForm->getId();
        } else {
            return $this->finalizarConsultaAction($object);       //Si no hay Formularios pendientes redireccionar a Finalizar Consulta
        }


        /*   Configuracion de Botones a Agregar por cada Formulario segun Id  */
        $btnArray = array(
            10 => array(
                'check' => array(
                    'label' => 'Verificar Datos', // Label del Nuevo Boton - DEFAULT: Nombre asignado
                    'type' => 'button', // Tipo de Boton (submit, reset o button) - DEFAULT: button
                    'class' => 'btn-primary', // Estilo de Boton (btn-primary, btn-default, btn-success, btn-info, btn-warning, btn-danger o btn-link) - DEFAULT: btn-default
                    'icon' => '<span class="glyphicon glyphicon-floppy-open"></span>', // Icono dentro de boton
                    'style' => 'display:none;'
                ),
                'cancel' => array(
                    'label' => 'Cancelar', // Label del Nuevo Boton - DEFAULT: Nombre asignado
                    'type' => 'button', // Tipo de Boton (submit, reset o button) - DEFAULT: button
                    'class' => 'btn-default', // Estilo de Boton (btn-primary, btn-default, btn-success, btn-info, btn-warning, btn-danger o btn-link) - DEFAULT: btn-default
                    'icon' => '<span class="fa fa-ban"></span>', // Icono dentro de boton
                )
            ),
            27 => array(
                'check' => array(
                    'label' => 'Verificar Datos',
                    'type' => 'button',
                    'class' => 'btn-primary',
                    'icon' => '<span class="glyphicon glyphicon-floppy-open"></span>',
                    'style' => 'display:none;'
                ),
                'cancel' => array(
                    'label' => 'Cancelar',
                    'type' => 'button',
                    'class' => 'btn-default',
                    'icon' => '<span class="fa fa-ban"></span>',
                )
            )
        );

        $formGenerator = $this->container->get('form.generator.service'); // Servicio de Generacion de Formularios
        // Generamos el Formulario $nextForm
        $formBuilder = $formGenerator->generateForm($nextForm, array(
            //'action' => $this->generateUrl('url'),        // Action del Formulario    - DEFAULT: Ninguna
            //'method' => 'POST',                           // Metodo POST o GET        - DEFAULT: POST
            'submit_button' => true, // Boton Submit Por Defecto - DEFAULT: true
            'submit_button_name' => 'Guardar y Continuar', // Nombre de Boton Submit   - DEFAULT: Guardar
            'add_button' => isset($btnArray[$nextForm->getId()]) ? $btnArray[$nextForm->getId()] : array()
                )
        );

        /* Si es un Formulario de Tipo Antecedentes, verificar si el Paciente ya posee Antecedentes */
        if ($nextForm->getIdTipoFormulario()->getId() == 1) {
            $antecedentes = $em->getRepository('MinsalSeguimientoBundle:SecAntecedentes')
                    ->findOneBy(array('idPaciente' => $expediente->getIdPaciente()));
            if ($antecedentes) {  //Si posee antecedentes se trata de una edicion de dicho antecedente
                $mainIds['sec_antecedentes'] = $antecedentes->getId();

                /** Llamamos al metodo setFormData, el cual setea la Data de la BD al formBuilder, especificando el array con los ID's principales. */
                $formGenerator->setFormData($mainIds);
            }
        }

        $form = $formGenerator->getGeneratedForm(); //Obtenemos la instancia de Form, generado de forma dinamica

        /* Para el Formulario FVIH01 se debe configurar otras variables */
        if ( in_array( $nextForm->getId(), array(10,27) ) ) {
            /* Se agrega el campo escondido para id paciente en sumeve */
            $form->add('idp', 'hidden', array('label' => 'My label', 'required' => false));
            $form->add('verificarSumeve', 'hidden', array('label' => 'Verificacion a BD SUMEVE', 'required' => false, 'data' => 'true'));

            /* Sobreescribiendo el botÃ³n Cancelar para aÃ±adirle un enlace al hacer onClick */
            $tempOptions = $form->get('cancel')->getConfig()->getOptions();
            $tempOptions['attr']['onclick'] = 'window.location="' . $this->generateUrl(
                            'admin_minsal_seguimiento_sechistorialclinico_remove_form', array(
                        'id' => $em->getRepository('MinsalSeguimientoBundle:SecFormulariosPorConsulta')
                                ->findOneBy(array('idHistorialClinico' => $idHistorialClinico, 'idFormulario' => $nextForm->getId()))->getId(),
                        'parameters' => array(
                            'action' => 'delete',
                            'idHistorialClinico' => $idHistorialClinico,
                            'idEstablecimiento' => $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')
                                    ->findOneBy(array('configurado' => true))->getId()
                        )
                            )
                    ) . '"';
            $form->add('cancel', 'button', $tempOptions);

            /* Buscar existencia de Datos Sobre Sexualidad */
            if (!isset($antecedentes)) {
                $antecedentes = $em->getRepository('MinsalSeguimientoBundle:SecAntecedentes')->findOneBy(array('idPaciente' => $expediente->getIdPaciente()));
            }

            if ($antecedentes) {
                $dqlSx = "SELECT S FROM MinsalSeguimientoBundle:SecAntecedentesOrientacionIdentidadSexual S WHERE S.idAntecedentes = " . $antecedentes->getId();
                $sexualidad = $em->createQuery($dqlSx)->getResult();
                $viewParameters['sexualidad'] = ( $sexualidad ) ? $sexualidad[0] : null;

                $dqlTS = "SELECT TS FROM MinsalSeguimientoBundle:SecAntecedentesOtro TS WHERE TS.idAntecedentes = " . $antecedentes->getId() . " AND TS.idOtrosAntecedentes = 15";
                $trabajoSexual = $em->createQuery($dqlTS)->getResult();
                $viewParameters['trabajoSexual'] = ( $trabajoSexual ) ? $trabajoSexual[0] : null;
            } else {
                $viewParameters['sexualidad'] = null;
                $viewParameters['trabajoSexual'] = null;
            }
        }/* Fin Configuracion Formulario FVIH01 */

        /* Para el Formulartio de Solicitud de Intervención Quirurgica y Formulario de Consulta de Anestesia se debe configurar otras variables */
        if ( in_array( $nextForm->getId(), array(29) ) || ( $object->getIdSolicitudQuirurgica() && in_array( $nextForm->getId(), array(7, 28, 33) ) ) ) {

            $aptitudQuirurgica = array();
            $dql = "SELECT AQ.id, AQ.nombre FROM MinsalSeguimientoBundle:CtlAptitudQuirurgica AQ";
            $aptitudQuirurgicaResult = $em->createQuery($dql)->getArrayResult();

            foreach ($aptitudQuirurgicaResult as $row) {
                $aptitudQuirurgica[$row['id']] = $row['nombre'];
            }

            $form->add('aptitudQuirurgica', 'choice', array('label' => 'Preparación Pre-operatoria', 'required' => true, 'multiple' => false, 'expanded' => true, 'empty_value' => 'No seleccionado...',
                                                             'empty_data' => null, 'choices' => array($aptitudQuirurgica),
                                                             'constraints' => array( new Constraints\NotBlank() ),
                                                             'position' => array( 'before' => 'save' )
                                                        ));
        }

        /* Si se ha realizado un Envio de Formulario (POST) */
        if ($this->getRestMethod() == 'POST') {

            $form->handleRequest($this->get('request'));    // Vea: http://symfony.com/doc/master/book/forms.html#handling-form-submissions

            if ($form->isValid()) { //Verifica que el Formulario sea valido (Aplica todas la validaciones de cada item: Constranints)
                switch ($nextForm->getId()) { //Configurar Parametros Necesarios segun cada Formulario Dinamico para guardar o actualizar la Data.

                    /* Por el momento esta misma configuracion Aplica para los Formularios de Antecedentes */
                    case 6:     // Formulario Antecedentes Generales Mujer Edad Fertil
                    case 20:    // Formulario Antecedentes Generales Sin Antecedentes Obstetricos
                    case 23:    // Formulario Antecedentes VICITS
                    case 31:    // Formulario Antecedentes Evaluación Anestésica Pre-Operatoria
                    case 32:    // Formulario Antecedentes Evaluación Anestésica Pre-Operatoria con Antecedentes Obstétricos

                        $parameters['fecha'] = new \DateTime();
                        $parameters['fecha_registro'] = new \DateTime();
                        $parameters['id_empleado'] = $this->getUser()->getIdEmpleado()->getId();
                        $parameters['id_paciente'] = $expediente->getIdPaciente()->getId();
                        $parameters['id_formulario'] = $nextForm->getId();
                        $parameters['id_aten_area_mod_estab'] = $object->getIdAtenAreaModEstab()->getId();
                        break;

                    case 7:     // Formulario Consulta General
                    case 22:    // Formulario Consulta Clinica TAR
                    case 24:    // Formulario Consulta VICITS Mujeres
                    case 25:    // Formulario Consulta VICITS Hombres
                    case 26:    // Formulario Consulta Entrega de Resultados de Examenes
                    case 28:    // Formulario Consulta Cirugía
                    case 33:    // Formulario Consulta Evaluación Anestésica Pre-Operatoria
                        $mainIds['sec_historial_clinico'] = $idHistorialClinico;
                        $object->setIdFormulario($nextForm);
                        $this->admin->update($object);
                        break;

                    case 10:    //Formulario FVIH01
                    case 27:    //Formulario FVIH01 v2
                        $parameters['id_historial_clinico'] = $idHistorialClinico;
                        $parameters['id_formulario'] = $nextForm->getId();
                        break;
                    case 29:
                        $parameters['id_historial_clinico'] = $idHistorialClinico;
                        $parameters['id_estado_solicitud_quirurgica'] = 1;
                        $parameters['id_empleado'] = $this->getUser()->getIdEmpleado()->getId();
                        $parameters['id_usuario'] = $this->getUser()->getId();
                }

                if( ! $object->getIdTipoHistoriaClinica() ){
                    $object->setIdTipoHistoriaClinica( $this->findTipoHistoriaClinica($nextForm, (isset($antecedentes) ? $antecedentes : null), $object->getIdAtenAreaModEstab()) );
                    $this->admin->update( $object );
                }

                /* Si es un Formulario de Tipo Antecedentes */
                if ($nextForm->getIdTipoFormulario()->getId() == 1) {

                    if (!isset($antecedentes)) {
                        $antecedentes = $em->getRepository('MinsalSeguimientoBundle:SecAntecedentes')->findOneBy(array('idPaciente' => $expediente->getIdPaciente()));
                    }

                    if ($antecedentes) { //Si posee antecedentes se trata de una edicion de dicho antecedente, por tanto es una actualizacion
                        $mainIds['sec_antecedentes'] = $antecedentes->getId();

                        $connSnapshot = $this->container->get('database_connection');
                        $connSnapshot->beginTransaction();

                        $stmSnapshot = $connSnapshot->prepare('SELECT fn_antecedentes_snapshot(:idAntecedentes)');
                        $stmSnapshot->bindValue(':idAntecedentes', $antecedentes->getId());
                        $stmSnapshot->execute();

                        $resultSnapshot = $stmSnapshot->fetch();

                        if ($resultSnapshot['fn_antecedentes_snapshot'] == true || $resultSnapshot['fn_antecedentes_snapshot'] == null) {

                            /* Se Actualiza la Data en la BD por medio del metodo updateDataToDB( $parameters, $mainIds) y segun la Configuracion de Guardado del Formulario en cuestion.
                             * En caso de no poder actualizar la Data o producirse un error retorna false, y automaticamente agrega el error al FlashBag y sera renderizando */
                            $success = $formGenerator->updateDataToDb($parameters, $mainIds);
                        } else {
                            $success = false;
                            $connSnapshot->rollback();
                            $this->addFlash('sonata_flash_error', '<i class="fa fa-ban"></i>Se ha producido un <b>error</b> al realizar ' . ( $this->codeEnvironment === 'dev' ? 'el <b>Snapshot</b> de los Antecedentes del Paciente.' : 'la verificacion de los Antecedentes del Paciente. <b>Por favor</b> intente nuevamente. Si problema persiste contacte al Administrador'));
                        }
                    } else { //Si NO se poseen antecedentes se trata de una creacion
                        $success = $formGenerator->saveDataToDB($parameters);
                    }

                    if ($success) {
                        if (isset($connSnapshot))
                            $connSnapshot->commit();
                        $SecAntEspForm = new SecAntecedentesEspecialidadForm();
                        $SecAntEspForm->setIdAntecedentes($antecedentes ? $antecedentes : $em->getRepository('MinsalSeguimientoBundle:SecAntecedentes')->findOneById($success) );
                        $SecAntEspForm->setIdFormulario($nextForm);
                        $SecAntEspForm->setIdAtenAreaModEstab($object->getIdAtenAreaModEstab());
                        $SecAntEspForm->setFecha(new \DateTime());
                        $SecAntEspForm->setIdEmpleado($this->getUser()->getIdEmpleado());
                        $em->persist($SecAntEspForm);
                        $em->flush();
                    }
                }
                else { /* Si No es un Formulario de Tipo Antecedentes */
                    $success = $formGenerator->saveDataToDB($parameters, $mainIds);
                }

                /* Si se ha Registrado o Actualizado la Data Correctamente */
                if ($success) {

                    $mainIdInserted = $success;
                    $msj = '';

                    /* Para Formulartio FVIH01 se deben completar otras acciones */
                    if ( in_array($nextForm->getId(), array(10,27)) ) {
                        $idp = null;
                        $idp = $form->get('idp')->getData();

                        try {
                            //var_dump('Solicitud Guardada Localmente...<br/>Intentando Envio...<br/>');
                            $result = $this->enviarSolicitud($idp, $expediente->getIdPaciente(), $mainIdInserted, $expediente);
                            //var_dump('Estatus de envio: <b>'.$result['status'].'</b> ...');
                        } catch (\Exception $ex) {
                            $result = null;
                            $msj = $ex->getMessage();
                        }

                        if ($result['status']) {
                            $elresult = json_decode($result['result']);

                            if (isset($elresult->codigo) && $elresult->codigo == 1) {

                                $idSumeve = $idp ? $idp : $elresult->idp;

                                $datospacientetar = $em->getRepository('MinsalSeguimientoBundle:TarPaciente')
                                        ->findOneBy(array('idSumeve' => $idSumeve));

                                if (!$datospacientetar) {
                                    $datospacientetar = $em->getRepository('MinsalSeguimientoBundle:TarPaciente')
                                            ->findOneBy(array('idPaciente' => $expediente->getIdPaciente()->getId()));
                                    if (!$datospacientetar) {
                                        $datospacientetar = new PacienteTar();
                                        $datospacientetar->setIdPaciente($expediente->getIdPaciente());
                                        $datospacientetar->setIdSumeve($idSumeve);
                                    } else {
                                        $datospacientetar->setIdSumeve($idSumeve);
                                    }

                                    $em->persist($datospacientetar);
                                    $em->flush();
                                }

                                $solFvih = $em->getRepository('MinsalSeguimientoBundle:TarSolicitudFvih')
                                        ->findOneBy(array('id' => $mainIdInserted));

                                if ($solFvih) {
                                    $solFvih->setIdGrupoEstadoDetalle($em->getRepository('MinsalSeguimientoBundle:CtlGrupoEstadoDetalle')
                                                    ->findOneBy(array('id' => 2))); //Enviada
                                    if (isset($elresult->idpr)) {
                                        $solFvih->setIdSolicitudSumeve($elresult->idpr);
                                    }

                                    $em->persist($solFvih);
                                    $em->flush();
                                }
                            }
                        } else {
                            // Manejar esta situacion
                            if (!$msj)
                                $msj = $result['errorMessage'];
                            $this->addFlash('sonata_flash_warning', '<i class="fa fa-warning"></i>Se ha guardado el Formulario para Solicitud y Confirmación de VIH (FVIH01). Sin embargo, este no ha sido enviado a SUMEVE posiblemente por problemas de conexión.<br/>
                                                                     <!--Para reintentar su envío, de click en el siguiente enlace: <a href="#">Renviar Solicitud ' . $mainIdInserted . '</a><br/>-->
                                                                     Si el problema persiste contacte al Administrador. ' . ( $this->codeEnvironment === 'dev' ? '<a onclick="jQuery(\'#errorDetails' . $mainIdInserted . '\').show();">Ver Detalles de Error</a><br>' : '') . '
                                                                     <span style="display: none;" id="errorDetails' . $mainIdInserted . '">' . $msj . '</span>');
                        }
                    } // Fin Otras acciones para FVIH01

                    /* Para Formulario Consulta Cirugia se deben completar otras acciones */
                    if ( in_array($nextForm->getId(), array(28)) ) {

                        // Si se marco que necesita operación se debe insertar Formulario para Solicitud de Intervención Quirurgica
                        if ( $form->get('i580_s173') ){
                            if( $form->get('i580_s173')->getData() == 1 ){

                                $formSolicitudQuirurgica = new Temporal();
                                $formSolicitudQuirurgica->setIdFormulario($this->findObject('ApplicationCoreBundle', 'FrmFormulario', 29));
                                $formSolicitudQuirurgica->setIdHistorialClinico($object);
                                $em->persist($formSolicitudQuirurgica);
                                $em->flush();
                            }
                        }
                    }

                    /* Para Formulartio de Solicitud de Intervención Quirurgica */
                    if ( in_array( $nextForm->getId(), array(29) ) || ( $object->getIdSolicitudQuirurgica() && in_array( $nextForm->getId(), array(7, 28, 33) ) ) ) {

                        $aptitudQuirurgica = $form->get('aptitudQuirurgica')->getData();

                        $idSolicitudQuirurgica = $nextForm->getId() == 29 ? $mainIdInserted : $object->getIdSolicitudQuirurgica()->getId();

                        $sql = "INSERT INTO sec_solicitud_quirurgica_aptitud (id_solicitud_quirurgica, id_aptitud_quirurgica, id_empleado, id_historial_clinico) VALUES ($idSolicitudQuirurgica, $aptitudQuirurgica, ".$this->getUser()->getIdEmpleado()->getId().", $idHistorialClinico)";
                        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll();

                        $solicitudQuirurgica = $object->getIdSolicitudQuirurgica();
                        if( $solicitudQuirurgica ){
                            if( $solicitudQuirurgica->getIdEstadoSolicitudQuirurgica()->getId() < 3 && in_array( $nextForm->getId(), array(33) ) ){
                                if( $aptitudQuirurgica == 1 ){
                                    $solicitudQuirurgica->setIdEstadoSolicitudQuirurgica( $this->findObject('MinsalSeguimientoBundle', 'CtlEstadoSolicitudQuirurgica', 3) );
                                    $em->persist($solicitudQuirurgica);
                                    $em->flush();
                                }
                                elseif( $aptitudQuirurgica == 2 ){
                                    $solicitudQuirurgica->setIdEstadoSolicitudQuirurgica( $this->findObject('MinsalSeguimientoBundle', 'CtlEstadoSolicitudQuirurgica', 4) );
                                    $em->persist($solicitudQuirurgica);
                                    $em->flush();
                                }
                            }
                        }
                    }

                    $this->addFlash('sonata_flash_success', '<i class="fa fa-check"></i>Los datos se han guardado exitosamente!');

                    $formulariosConsulta->setEstado(true); //Indicamos que el Formulario se ha llenado o realizado y guardado
                    $em->persist($formulariosConsulta);
                    $em->flush();

                    //Buscar Formularios Pendientes de la Consulta
                    $formulariosConsultaSiguiente = $em->getRepository('MinsalSeguimientoBundle:SecFormulariosPorConsulta')
                            ->findOneBy(array('idHistorialClinico' => $idHistorialClinico, 'estado' => false));

                    if ($formulariosConsultaSiguiente) {
                        $nextFormSiguiente = $formulariosConsultaSiguiente->getIdFormulario();

                        /* Obtener una nueva instancia del Service de Generacion de Formularios */
                        $formGeneratorSiguiente = $this->container->get('form.generator.service');

                        /* Generar el Proximo Formulario de los Pendientes */
                        $formBuilderSiguiente = $formGeneratorSiguiente->generateForm($nextFormSiguiente, array(
                            'submit_button' => true,
                            'submit_button_name' => 'Guardar y Continuar',
                            'add_button' => isset($btnArray[$nextForm->getId()]) ? $btnArray[$nextForm->getId()] : array()
                                )
                        );

                        $formSiguiente = $formGeneratorSiguiente->getGeneratedForm();

                        /* Para el Formulario Consulta de Cirugia y Anestesia se debe configurar otras variables */
                        if ( in_array( $nextFormSiguiente->getId(), array(29) ) || ( $object->getIdSolicitudQuirurgica() && in_array( $nextFormSiguiente->getId(), array(7, 28, 33) ) ) ) {

                            $aptitudQuirurgica = array();
                            $dql = "SELECT AQ.id, AQ.nombre FROM MinsalSeguimientoBundle:CtlAptitudQuirurgica AQ";
                            $aptitudQuirurgicaResult = $em->createQuery($dql)->getArrayResult();

                            foreach ($aptitudQuirurgicaResult as $row) {
                                $aptitudQuirurgica[$row['id']] = $row['nombre'];
                            }

                            $formSiguiente->add('aptitudQuirurgica', 'choice', array('label' => 'Preparación Pre-operatoria', 'required' => true, 'multiple' => false, 'expanded' => true, 'empty_value' => 'No seleccionado...',
                                                                             'empty_data' => null, 'choices' => array($aptitudQuirurgica),
                                                                             'constraints' => array( new Constraints\NotBlank() ),
                                                                             'position' => array( 'before' => 'save' )
                                                                        ));
                        }

                        $viewSiguiente = $formGeneratorSiguiente->getFormView();
                        $itemsActionJsSiguiente = $formGeneratorSiguiente->getItemsActionJs(array('accordion' => true));

                        $viewParameters['form'] = $viewSiguiente;
                        $viewParameters['object'] = $object;
                        $viewParameters['itemsActionJs'] = $itemsActionJsSiguiente;

                        return $this->render($nextFormSiguiente->getVistaEdit() ? $nextFormSiguiente->getVistaEdit() : $defaultView, $viewParameters);
                    } else { // Si no hay Formularios pendientes

                        /* Cambiar Estado de Historia a Espera de Cierre */
                        $object->setIdEstadoHistoriaClinica($em->getRepository('MinsalSeguimientoBundle:CtlEstadoHistoriaClinica')->findOneBy(array('codigo' => 'EC')));
                        $em->persist($object);
                        $em->flush();

                        /* Redirigir a Finalizar Consulta */
                        return $this->finalizarConsultaAction($object);
                    }
                }
            } else {
                if ($reload === 'true') {
                    $this->get('session')->getFlashBag()->clear();
                    $this->get('request')->request->set('reload', 'false');
                } else
                    $this->addFlash('sonata_flash_error', '<i class="fa fa-ban"></i>Se ha encontrado un <b>error</b> en el Formulario!');
            }
        }// FIN Si se ha realizado un Envio de Formulario (POST)

        $view = $formGenerator->getFormView();
        $itemsActionJs = $formGenerator->getItemsActionJs(array('accordion' => true));

        $viewParameters['form'] = $view;
        $viewParameters['object'] = $object;
        $viewParameters['itemsActionJs'] = $itemsActionJs;

        return $this->render($nextForm->getVistaEdit() ? $nextForm->getVistaEdit() : $defaultView, $viewParameters);
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza para hacer el llamado de la finalización de la consulta
     * PARÁMETROS DE ENTRADA:
     *                  -idHistorialClinico: objeto del historial clinico que se esta utilizando
     * PARAMETROS DE ENVIO:
     *                  -idEmpleado: id del médico que realiza la consulta
     *                  -idEspecialidad: la especialidad con la que trabaja el médico
     *                  -idHistorialClinico: id del historial clinico que se esta utilizando
     *                  -edad: edad del paciente
     *                  -expediente: objeto expediente según el id_expediente que se recibe.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    public function finalizarConsultaAction($idHistorialClinico) {
        $flashMsj = '';
        $errorMsj = '';

        $em = $this->getDoctrine()->getManager();
        $hayreferencias = false;
        $referenciasid = 0;


        //$sololocal = 0;

        $SecOtrasObservaciones = $em->getRepository('MinsalSeguimientoBundle:SecOtrasObservaciones')->findOneBy(array('idHistorialClinico' => $idHistorialClinico));

        $formulariosConsulta = $em->getRepository('MinsalSeguimientoBundle:SecFormulariosPorConsulta')
                ->findOneBy(array('idHistorialClinico' => $idHistorialClinico, 'estado' => false));
        if ($formulariosConsulta) {
            return $this->seguimientoConsultaAction($idHistorialClinico->getId());
        }
        $expediente = $idHistorialClinico->getIdExpediente();
        $conn = $em->getConnection();
        $calcular = new Funciones();

        /* Especialidades en las que ha pasado consulta, diferente a la especialidad actual que va en paramters.idEspecialdad */
        $dql = "SELECT DISTINCT B
                FROM MinsalSeguimientoBundle:SecHistorialClinico A
                JOIN MinsalSiapsBundle:MntAtenAreaModEstab B WITH (A.idAtenAreaModEstab = B.id)
                WHERE A.idExpediente = " . $expediente->getId() . "
                AND A.piloto = 'F'
                ORDER BY B.id ASC";
        $idEspecialidad = $em->createQuery($dql)->getResult();

        $grupoDispensarial = $em->getRepository('MinsalSiapsBundle:CtlGrupoDispensarial')->findAll();

        $SecHistorialCitaDiaSubsec = $em->getRepository('MinsalSeguimientoBundle:SecHistorialCitaDiaSubsec')->findBy(array('idHistorialClinico' => $idHistorialClinico->getId()));
        $FarmRecetas = $em->getRepository('MinsalFarmaciaBundle:FarmRecetas')->findBy(array('idhistorialclinico' => $idHistorialClinico->getId()));

        $secSolicitudEstudios = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->findOneBy(array('idHistorialClinico' => $idHistorialClinico));

        $params = array( 'solicitudEstudio' => array( 'laboratorio' => array() ) );
        $params['solicitudEstudio']['setFalseHistoryId'] = false;
        $params['solicitudEstudio']['falseHistory'] = null;

        /* Determinar si existe una solicitud ingresada desde laboratorio que pueda corresponder a esta historia clínica */
        if( ! $secSolicitudEstudios ){

            $dql = "SELECT S
                    FROM MinsalSeguimientoBundle:SecSolicitudestudios S
                    INNER JOIN MinsalSeguimientoBundle:SecHistorialClinico H WITH (S.idHistorialClinico = H.id)
                    WHERE S.idHistorialClinico IS NOT NULL
                    AND S.idExpediente = :idExpediente
                    AND S.fechaSolicitud = :fechaConsulta
                    AND H.idAtenAreaModEstab = :idEspecialidad
                    AND H.idEmpleado = :idEmpleado";

            $secSolicitudMatch = $em->createQuery($dql)
                                    ->setParameters( array( 'idExpediente'   => $expediente->getId(),
                                                            'fechaConsulta'  => $idHistorialClinico->getFechaconsulta()->format('Y-m-d'),
                                                            'idEspecialidad' => $idHistorialClinico->getIdAtenAreaModEstab()->getId(),
                                                            'idEmpleado'     => $idHistorialClinico->getIdEmpleado()->getId()
                                                          )
                                                    )
                                    ->getResult();

            if ( count( $secSolicitudMatch ) > 0 ){

                $user = $this->getUser();
                $CtlEstablecimientoLocal = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
                $idEstablecimiento = isset($request) ? $request->get('idEstablecimiento') ? $request->get('idEstablecimiento') : $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimientoLocal->getId() : $CtlEstablecimientoLocal->getId();

                if (intval($idEstablecimiento) !== $CtlEstablecimientoLocal->getId()) {
                    $idDatoReferencia = $id;
                } else {
                    $idDatoReferencia = null;
                }

                $solicitudEstudio = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->obtenerSolicitudEstudios($secSolicitudMatch[0]->getIdHistorialClinico()->getId(), $idDatoReferencia, $idEstablecimiento);

                $params['solicitudEstudio']['laboratorio'] = $solicitudEstudio;
                $params['solicitudEstudio']['setFalseHistoryId'] = true;
                $params['solicitudEstudio']['falseHistory'] = $secSolicitudMatch[0]->getIdHistorialClinico();

            }
            //exit();
        }
        /* fin busqueda de posibles solicitudes asociadas */

        $RemisionPaciente = $em->getRepository('MinsalSeguimientoBundle:SecRemisionPaciente')->findBy(array('idHistorialClinico' => $idHistorialClinico->getId()));

        $cliente = new Cliente();
        $cliente->setContainer($this->container);
        $labase = $this->container->getParameter('global_host');
        $method = $this->container->getParameter('ws_method');
        $referencias = $em->getRepository('MinsalSeguimientoBundle:SecRemisionPaciente')
                ->findBy(array('idHistorialClinico' => $idHistorialClinico));
        $dqlEstablecimientos = "SELECT C FROM MinsalSiapsBundle:CtlEstablecimiento C WHERE C.idTipoEstablecimiento NOT IN (12,13) ORDER BY C.nombre";
        $losestablecimientos = $em->createQuery($dqlEstablecimientos)->getResult();

        $labase = $this->container->getParameter('global_host');
        $method = $this->container->getParameter('ws_method');

        /*
          $cliente = new Cliente();
          $cliente->setContainer($this->container);
          try {
          $establecimientos = $cliente->obtenerEstablecimientosAction($labase);
          } catch (\Exception $ex) {
          $establecimientos = null;
          $errorMsj = $ex->getMessage();
          }

          if ($establecimientos) {
          $losestablecimientos = json_decode($establecimientos);
          $sololocal = 0;
          } else {
          $sololocal = 1;
          } */

        $dqlTipoConsejeria = "SELECT C FROM MinsalSeguimientoBundle:CtlTipoConsejeria C";
        $dqlConsejeriaBrindada = "SELECT C FROM MinsalSeguimientoBundle:SecConsejeria C WHERE C.idHistorialClinico = " . $idHistorialClinico->getId() . " ORDER BY C.id DESC";

        $parameters = array('idEmpleado' => $idHistorialClinico->getIdEmpleado()->getId(),
            'idEstablecimiento' => $idHistorialClinico->getIdEmpleado()->getIdEstablecimiento()->getId(),
            'idEspecialidad' => $idHistorialClinico->getIdAtenAreaModEstab()->getId(),
            'idHistorialClinico' => $idHistorialClinico->getId(),
            'tipoConsejeria' => $em->createQuery($dqlTipoConsejeria)->getResult(),
            'consejeriaBrindada' => $em->createQuery($dqlConsejeriaBrindada)->getResult()
        );


        $edad = $calcular->calcularEdad($conn, $expediente->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $expediente->getIdPaciente()->getHoraNacimiento() ? $expediente->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );

        if ($errorMsj !== '') {
            $flashMsj = '<h4><strong>No se pudo establecer Conexión con el Servidor Central!</strong></h4> Motivo por el cual todo lo relacionado con las referencias se almacenarán de manera local.';
            if ($this->codeEnvironment === 'dev') {
                $flashMsj .= ' <br /><br /><b>Detalle del Error:</b><br /> ' . $errorMsj;
            }
            $this->get('session')->getFlashBag()->add('sonata_flash_warning', $flashMsj);
        }

        $idSolFVIH = $em->getRepository('MinsalSeguimientoBundle:TarSolicitudFvih')->findOneBy(array('idHistorialClinico' => $idHistorialClinico->getId()));
        return $this->render($this->admin->getTemplate('finalizar_consulta'), array(
                    'action' => 'finalizar_consulta',
                    'expediente' => $expediente,
                    'edad' => $edad,
                    'parameters' => $parameters,
                    'idEspecialidad' => $idEspecialidad,
                    'grupoDispensarial' => $grupoDispensarial,
                    'SecHistorialCitaDiaSubsec' => $SecHistorialCitaDiaSubsec,
                    'establecimientos' => $losestablecimientos,
                    'global_host' => $labase,
                    'hayreferencias' => $hayreferencias,
                    'method' => $method,
                    'referencias' => $referencias,
                    'objreceta' => $FarmRecetas,
                    'objremision' => $RemisionPaciente,
                    'object' => $idHistorialClinico,
                    'SecSolicitudestudios' => $secSolicitudEstudios,
                    'SecOtrasObservaciones' => $SecOtrasObservaciones,
                    'idSolFVIH' => $idSolFVIH,
                    'params' => $params
        ));
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza para hacer la selección del formulario adecuado.
     * PARÁMETROS DE ENTRADA:
     *                  -idExpedinte: es el id del expediente que se esta utilizando en la consulta.
     *                  -idEmpleado: id del médico que realiza la consulta
     *                  -idEspecialidad: la especialidad con la que trabaja el médico
     * RETORNA:
     *                  -formularios: array con todos los formularios que le aplican a una determinada consulta
     * ANALISTA PROGRAMADOR: Karen Peñate, Aaron Romero, Wilber Romero, Orlando Martínez
     */

    public function seleccionarFormulario($idExpediente, $idEmpleado, $idEspecialidad) {
        $em = $this->getDoctrine()->getManager();
        //OBTENER LOS OBJETOS QUE SE NECESITAN
        $expediente = $em->getRepository("MinsalSiapsBundle:MntExpediente")->find($idExpediente);
        $especialidad = $em->getRepository("MinsalSiapsBundle:MntAtenAreaModEstab")->find($idEspecialidad);

        $conn = $em->getConnection();
        $calcular = new Funciones();
        $edad = $calcular->calcularEdad($conn, $expediente->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $expediente->getIdPaciente()->getHoraNacimiento() ? $expediente->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );

        $historialClinico = $em->getRepository("MinsalSeguimientoBundle:SecHistorialClinico")
                ->obtenerHistorialClinico($idEmpleado, $idExpediente, $idEspecialidad);

        if (count($historialClinico) > 0) {
            /* VERIFICAR QUE HAYA PASADO UN AÑO DESDE SU ULTIMA ACTUALIZACIÓN */
            $paciente = $expediente->getIdPaciente()->getId();
            $dql = "SELECT B.id,DATE_DIFF(CURRENT_DATE(),A.fecha) diferencia
                  FROM MinsalSeguimientoBundle:SecAntecedentesEspecialidadForm A
                  JOIN MinsalSeguimientoBundle:SecAntecedentes B WITH (A.idAntecedentes = B.id)
                  JOIN B.idPaciente C
                  JOIN A.idAtenAreaModEstab D
                  WHERE C.id=$paciente AND D.id=$idEspecialidad
                  ORDER BY A.fecha DESC";
            $resultado = $em->createQuery($dql)->getResult();

            if (empty($resultado)) {
                $primeraVez = 'TRUE';
            } else if ($resultado[0]['diferencia'] < 365) {
                $primeraVez = 'FALSE';
            } else {
                $primeraVez = 'TRUE';
            }
        } else {
            $primeraVez = 'TRUE';
        }
        return $formularios = $em->getRepository("MinsalSeguimientoBundle:FrmGrupoFormulario")->obtenerFormulario($expediente->getIdPaciente()->getIdSexo() ? $expediente->getIdPaciente()->getIdSexo()->getId() : null, $edad, $especialidad->getIdAtencion()->getId(), $primeraVez, $expediente->getIdPaciente()->getIdCondicionPersona() ? $expediente->getIdPaciente()->getIdCondicionPersona()->getId() : null );
    }

    /*
     * DESCRIPCIÓN: Método se utiliza para obtener un objeto determinado por id.
     * PARÁMETROS DE ENTRADA:
     *                  -bundle: nombre del bundle donde se encuentra la entidad
     *                  -entity: nombre de la entidad a obtener.
     *                  -id: id a buscar
     * PARAMETROS DE ENVIO:
     *                  -foundObject: objeto encontrado.
     * ANALISTA PROGRAMADOR: Aaron Romero, Wilber Romero, Orlando Martínez
     */

    private function findObject($bundle, $entity, $id) {
        $em = $this->getDoctrine()->getManager();
        $foundObject = $em->getRepository($bundle . ':' . $entity)->findOneById($id);
        return $foundObject;
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza para terminar la consulta, cambiarle
     *              el estado a historial clinico a finalizado y redirige a
     *              la agenda del médico.
     * PARÁMETROS DE ENTRADA:
     *                  -idHistorialClinico: id del historial clinico que se esta
     *                  realizando en el momento.
     * PARAMETROS DE ENVIO:
     *                 NINGUNO.
     * ANALISTA PROGRAMADOR: Karen Peñate, Aaron Romero, Wilber Romero, Orlando Martínez
     */

    public function cerrarConsultaAction($idHistorialClinico) {
        $em = $this->getDoctrine()->getManager();
        $historialClinico = $this->admin->getObject($idHistorialClinico);

        $formulariosConsulta = $em->getRepository('MinsalSeguimientoBundle:SecFormulariosPorConsulta')
                ->findBy(array('idHistorialClinico' => $idHistorialClinico));

        foreach ($formulariosConsulta as $formularioCons) {
            $em->remove($formularioCons);
            $em->flush();
        }

        if ($this->getRestMethod() == 'POST') {
            //--Registra datos de dispensarización
            $dispensarizacion = $this->get('request')->get('grupo_dispensarial');
            if (!empty($dispensarizacion)) {
                $paciente = $historialClinico->getIdExpediente()->getIdPaciente();
                if ($dispensarizacion != $paciente->getIdGrupoDispensarial()->getId()) {

                    $auditoriaGrupo = new AuditoriaGrupo();
                    $auditoriaGrupo->setIdPaciente($paciente);
                    $auditoriaGrupo->setIdGrupoDispensarialAnterior($paciente->getIdGrupoDispensarial());
                    $auditoriaGrupo->setIdHistorialClinico($historialClinico);
                    $auditoriaGrupo->setIdUsuarioCambio($this->container->get('security.context')->getToken()->getUser());
                    $auditoriaGrupo->setFechaHoraCambio(new \DateTime());
                    $em->persist($auditoriaGrupo);
                    $em->flush();
                    $paciente->setIdGrupoDispensarial($em->getRepository('MinsalSiapsBundle:CtlGrupoDispensarial')->find($dispensarizacion));
                    $em->persist($paciente);
                    $em->flush();
                }
            }
        }
        $historialClinico->setIdEstadoHistoriaClinica($em->getRepository('MinsalSeguimientoBundle:CtlEstadoHistoriaClinica')->findOneBy(array('codigo' => 'EC')));

        if (!$historialClinico->getHoraFin()) {
            $historialClinico->setHoraFin(new \DateTime());
        }

        $em->persist($historialClinico);
        $em->flush();
        $citCitaDia = $historialClinico->getIdCitaDia();
        $citCitaDia->setIdEstado($em->getRepository('MinsalCitasBundle:CitEstadoCita')->find(5));
        $em->persist($citCitaDia);
        $em->flush();


        //Desplegar nuevamente  la vista de agenda del día.
        $url = $this->generateUrl('admin_minsal_citas_citcitasdia_agenda_dia');
        return $this->redirect($url);
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza para cargar una pantalla adicional al
     *              momento de llamar al show.
     * PARÁMETROS DE ENTRADA:
     *                  NINGUNO
     * PARAMETROS DE ENVIO:
     *                 NINGUNO.
     * ANALISTA PROGRAMADOR: Aaron Romero
     */

    public function listAction() {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $request = $this->container->get('request');

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        $external = $request->get('external') ? ( $request->get('external') == 'true' ? true : false ) : false;
        $selectable = $request->get('selectable') ? ( $request->get('selectable') == 'true' ? true : false ) : false;
        $template = $external ? 'historias_clinicas_pre_show' : 'list';

        return $this->render($this->admin->getTemplate($template), array(
                    'action' => 'list',
                    'form' => $formView,
                    'datagrid' => $datagrid,
                    'csrf_token' => $this->getCsrfToken('sonata.batch'),
                    'params' => array('external' => $external,
                        'selectable' => $selectable,
                        'idExpedienteHclinica' => $request->get('idExpedienteHclinica'),
                        'idEspecialidadHclinica' => $request->get('idEspecialidadHclinica') ? $request->get('idEspecialidadHclinica') : ''
                    )
        ));
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza para obtener la vista de mostrar un elemento en especifico
     *              según su id.
     * PARÁMETROS DE ENTRADA:
     *                  -id: id del elemento historial clinico a mostrar
     * PARAMETROS DE ENVIO:
     *                  -params:array que posee algunos parametros necesarios para cargar la vista.
     *                  -action: acción que se realiza, en este caso show
     *                  -object: objeto historial clinico obtenido.
     *                  -elements:
     *                  -savedData: arreglo de elementos que contiene el formulario dinamico.
     *                  -medicinaRecetada: arreglo de objetos medicina receta obtenido.
     * ANALISTA PROGRAMADOR: Karen Peñate, Aaron Romero, Wilber Romero, Orlando Martínez
     */

    /**
     * return the Response object associated to the view action
     *
     * @param null $id
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return Response
     */
    public function showAction($id = null) {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $request = $this->get('request');

        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('VIEW', $object)) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $this->admin->setSubject($object); /* object debe substituirse por la instancia de la Entity FrmFormulario que desea generarse */

        /** Obtenemos una instancia del Servicio form.generator.service que servira para generar formularios * */
        $formGenerator = $this->container->get('form.generator.service');

        /** Definir un array con los Id de las tablas principales (o padres). * */
        $mainIds = array('sec_historial_clinico' => $object->getId());

        /** Llamamos al metodo getFormSavedData, especificando el form del cual se generara un show y el array con los ID's principales * */
        $savedData = $formGenerator->getFormSavedData($object->getIdFormulario(), $mainIds);

        //Transformar el ID de los Diagnosticos SNOMED a Texto
        $lastDiagnosticType = null; // Elimiar al migrar cie10
        foreach ($savedData as $key1 => $data) {
            if (isset($data['name'])) {
                if ($data['name'] == 'Diagnóstico') {
                    if (isset($data['items'])) {
                        foreach ($data['items'] as $key2 => $item) {
                            if ($item['name'] == 'Diagnóstico:') {
                                if( $item['value'] ){
                                    $savedData[$key1]['items'][$key2]['value'] = $this->getRegDescriptor($item['value'], 'mnt_cie10', 'diagnostico'); // original instruction
                                }
                                else{

                                    $savedData[$key1]['items'][$key2]['value'] = $this->getSnomedDescriptor($object->getId(), $lastDiagnosticType);
                                }
                            }
                            else{
                                if($item['name'] == 'Tipo de Diagnostico')
                                    $lastDiagnosticType = $item['value'] == 'Principal' ? 1 : ( $item['value'] == 'Secundario' ? 2 : 3 );
                            }
                        }
                    }
                }
            }
        }

        //$lastRoute = $this->getLastRoute($this->get('request'));
        $external = $request->get('external') ? ( $request->get('external') == 'true' ? true : false ) : false;

        if ($external) {
            $params = array('external' => true);
        } else {
            $params = array('external' => false);
        }
        /* Obteniendo recetas si posee este historial clinico */
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT A
                  FROM MinsalFarmaciaBundle:FarmMedicinarecetada A
                  JOIN A.idreceta B
                  JOIN B.idhistorialclinico C
                  WHERE C.id=$id
                  ORDER BY A.idmedicina ASC, B.fecha ASC
                  ";
        $medicinaRecetada = $em->createQuery($dql)->getResult();
        /* Obteniendo las citas posteriores que posee el paciente */
        $dql = "SELECT A
                  FROM MinsalSeguimientoBundle:SecHistorialCitaDiaSubsec A
                  JOIN A.idHistorialClinico B
                  WHERE B.id=$id
                  ORDER BY A.id ASC
                  ";
        $citasAsignadas = $em->createQuery($dql)->getResult();

        $user = $this->getUser();
        $CtlEstablecimientoLocal = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $idEstablecimiento = $request->get('idEstablecimiento') ? $request->get('idEstablecimiento') : $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimientoLocal->getId();

        //$idEstablecimiento  = $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId();

        if (intval($idEstablecimiento) !== $CtlEstablecimientoLocal->getId()) {
            $idDatoReferencia = $id;
        } else {
            $idDatoReferencia = null;
        }

        $solicitudEstudio = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->obtenerSolicitudEstudios($id, $idDatoReferencia, $idEstablecimiento);

        $params['solicitudEstudio'] = array('laboratorio' => $solicitudEstudio);

        /* Consejeria Brindada */
        $dqlConsejeriaBrindada = "SELECT C FROM MinsalSeguimientoBundle:SecConsejeria C WHERE C.idHistorialClinico = " . $object->getId() . " ORDER BY C.id DESC";
        $params['consejeriaBrindada'] = $em->createQuery($dqlConsejeriaBrindada)->getResult();

        /*DATOS EMBARAZO*/
        $datoEmbarazo=$em->getRepository('MinsalSeguimientoBundle:SecDatoEmbarazo')->findOneBy(array('idHistorialClinico'=>$id));

        /*Otras Observaciones*/
        $secOtrasObservaciones=$em->getRepository('MinsalSeguimientoBundle:SecOtrasObservaciones')->findOneBy(array('idHistorialClinico'=>$id));

        /* CALCULAR IMC */
        $sql = "SELECT CASE WHEN talla=0 THEN 0 ELSE round(peso/pow((talla/100),2),2) END as imc from sec_signos_vitales where id_historial_clinico=$id";
        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        $imc['valor'] = $result[0]['imc'];
        /* CUANDO SE TENGA LA FORMA DE CLASIFICAR APARECERÁ LA CLASIFICACIÓN */
        $imc['clasificacion'] = null;

        /*         * * Registrar en Auditoria Seguimiento la Accion actual ** */
        $auditSec = new MntAuditoriaSeguimiento();
        $auditSec->setIdTipoAccionBitacora('R');
        $auditSec->setTablaAfectada('sec_historial_clinico');
        $auditSec->setIdRegistroAfectado($id);
        $auditSec->setIdUsuario($user);
        $auditSec->setFechaHoraRegistro(new \DateTime());

        $em->persist($auditSec);
        $em->flush();

        /**
         * La plantilla show estandar para Formularios Dinamicos es: ApplicationCoreBundle:FormDinamico:base_show.html.twig
         * en la cual se puede basar para realizar su propio show. Ver el archivo para mayor detalle.
         */
        return $this->render($this->admin->getTemplate('show'), array(
                    'action' => 'show',
                    'object' => $object,
                    'elements' => $this->admin->getShow(),
                    'savedData' => $savedData,
                    'params' => $params,
                    'medicinaRecetada' => $medicinaRecetada,
                    'citasAsignadas' => $citasAsignadas,
                    'impresion' => false,
                    'imc' => $imc,
                    'datosEmbarazo'=>$datoEmbarazo,
                    'secOtrasObservaciones'=>$secOtrasObservaciones

        ));
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza cambiar el estado del formulario al momento de la consulta.
     * PARÁMETROS DE ENTRADA:
     *                  -id: id del formulari a actualizar
     * PARAMETROS DE ENVIO:
     *                 NINGUNO
     * ANALISTA PROGRAMADOR: Aaron Romero
     */

    /**
     * return the Response object associated to the edit action
     *
     *
     * @param mixed $id
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return Response
     */
    public function changeStatusFormAction() {
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $em = $this->getDoctrine()->getManager();
        $object = $em->getRepository('MinsalSeguimientoBundle:SecFormulariosPorConsulta')->findOneById($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object->setEstado($this->get('request')->get($this->admin->getStatusParameter()));

        $this->admin->update($object);
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza eliminar un formulario de la consulta.
     * PARÁMETROS DE ENTRADA:
     *                  -id: id del formulario a eliminar
     * PARAMETROS DE ENVIO:
     *                 NINGUNO
     * ANALISTA PROGRAMADOR: Aaron Romero
     */

    /**
     * return the Response object associated to the edit action
     *
     *
     * @param mixed $id
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return Response
     */
    public function removeFormAction() {
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $em = $this->getDoctrine()->getManager();
        $object = $em->getRepository('MinsalSeguimientoBundle:SecFormulariosPorConsulta')->findOneById($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $remove = true;
        $msjType = "";
        $msjContent = "";
        $parameters = $this->get('request')->get('parameters');

        if ($parameters !== null && isset($parameters['action'])) {
            switch ($parameters['action']) {
                case 'delete':
                    $result = $this->deleteExamenDeSolicitudAction($parameters['idHistorialClinico'], $parameters['idEstablecimiento']);
                    if (!$result['status']) {
                        $remove = false;
                        $msjType = 'sonata_flash_error';
                        $msjContent .= 'Error al Eliminar el Formulario, Detalle del Error:<br /><br /><ul>';
                        foreach ($result['msj'] as $value) {
                            $msjContent .= '<li>' . $value . '</li>';
                        }
                        $msjContent .= '</ul>';
                    }
                    $this->addFlash($msjType, $msjContent);
                    break;

                default:
                    # code...
                    break;
            }
        }

        if ($remove) {
            $this->admin->delete($object);
        }

        $route = 'seguimiento_consulta';
        return new RedirectResponse($this->admin->generateUrl($route, array('idHistorialClinico' => $parameters['idHistorialClinico'])));
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza para eliminar un examen entidad
     *              solicitud estudios.
     * PARÁMETROS DE ENTRADA:
     *                  NINGUNO
     * PARAMETROS DE ENVIO:
     *                 NINGUNO
     * ANALISTA PROGRAMADOR: Caleb Rodriguez
     */

    private function deleteExamenDeSolicitudAction($idHistorialClinico, $idEstablecimiento) {
        $em = $this->getDoctrine()->getManager();
        $error = array();

        $CtlEstablecimientoLocal = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));

        if (intval($idEstablecimiento) !== $CtlEstablecimientoLocal->getId()) {
            $idDatoReferencia = $idHistorialClinico;
        } else {
            $idDatoReferencia = NULL;
        }

        $sql = "SELECT searchsolicitudestudios(:idHistorialClinico, :lugar, :tipoSolicitud, :idDatoReferencia, :idEstablecimiento)";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idHistorialClinico', $idHistorialClinico);
        $stm->bindValue(':lugar', $CtlEstablecimientoLocal->getId());
        $stm->bindValue(':tipoSolicitud', '1');
        $stm->bindValue(':idDatoReferencia', $idDatoReferencia);
        $stm->bindValue(':idEstablecimiento', $idEstablecimiento);
        $stm->execute();
        $result = $stm->fetchAll();

        $idSolicitudUrgente = $result[0]['searchsolicitudestudios'];

        $sql = "SELECT searchsolicitudestudios(:idHistorialClinico, :lugar, :tipoSolicitud, :idDatoReferencia, :idEstablecimiento)";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idHistorialClinico', $idHistorialClinico);
        $stm->bindValue(':lugar', $CtlEstablecimientoLocal->getId());
        $stm->bindValue(':tipoSolicitud', '2');
        $stm->bindValue(':idDatoReferencia', $idDatoReferencia);
        $stm->bindValue(':idEstablecimiento', $idEstablecimiento);
        $stm->execute();
        $result = $stm->fetchAll();

        $idSolicitudNormal = $result[0]['searchsolicitudestudios'];

        if ($idSolicitudUrgente === null && $idSolicitudNormal === null) {
            $error[] = 'No se ha encontrado ninguna solicitud de tipo Urgente, motivo por el cual el/los exámen/es no ha/n sido eliminado/s';
        } else {

            $sql = "SELECT id
                    FROM lab_recepcionmuestra
                    WHERE idsolicitudestudio IN (:idSolicitudUrgente, :idSolicitudNormal )";

            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->bindValue(':idSolicitudUrgente', $idSolicitudUrgente);
            $stm->bindValue(':idSolicitudNormal', $idSolicitudNormal);
            $stm->execute();
            $result = $stm->fetchAll();

            if (count($result) <= 0) {
                $em->getConnection()->beginTransaction();
                try {
                    $sql = "SELECT t02.idexamen AS id_examen
                            FROM sec_solicitudestudios		        t01
                            INNER JOIN sec_detallesolicitudestudios t02 ON (t01.id = t02.idsolicitudestudio)
                            WHERE t02.id_conf_examen_estab IN (
                            		SELECT ti01.id
                            		FROM lab_conf_examen_estab ti01
                            		INNER JOIN mnt_formulariosxestablecimiento ti02 ON (ti02.id = ti01.idformulario)
                            		WHERE ti02.id_atencion = 125
                            	)
                            	AND t01.id IN (:idSolicitudUrgente, :idSolicitudNormal)";

                    $stm = $this->container->get('database_connection')->prepare($sql);
                    $stm->bindValue(':idSolicitudUrgente', $idSolicitudUrgente);
                    $stm->bindValue(':idSolicitudNormal', $idSolicitudNormal);
                    $stm->execute();
                    $examenes = $stm->fetchAll();

                    $id = array();
                    foreach ($examenes as $row) {
                        $id[] = $row['id_examen'];
                    }
                    if (count($id) === 0) {
                        $error[] = 'No existe ningun Examen a Eliminar';
                    } else {
                        $ids = implode(',', $id);

                        $sql = "DELETE FROM sec_detallesolicitudestudios WHERE idexamen IN ($ids) AND idsolicitudestudio IN (:idSolicitudUrgente, :idSolicitudNormal)";

                        $stm = $this->container->get('database_connection')->prepare($sql);
                        $stm->bindValue(':idSolicitudUrgente', $idSolicitudUrgente);
                        $stm->bindValue(':idSolicitudNormal', $idSolicitudNormal);
                        $stm->execute();
                        $result = $stm->fetchAll();

                        if ($stm->errorCode() !== '00000') {
                            $error[] = 'No se pudo eliminar el/los examen/es de laboratorio referentes a las solicitudes NÂ°: ' . $idSolicitudUrgente . ', ' . $idSolicitudNormal;
                        } else {
                            if ($idSolicitudUrgente !== null) {
                                $sql = "SELECT deletesolicitudestudio(:idHistorialClinico, :lugar, :tipoSolicitud, :idDatoReferencia, :idEstablecimiento)";

                                $stm = $this->container->get('database_connection')->prepare($sql);
                                $stm->bindValue(':idHistorialClinico', $idHistorialClinico);
                                $stm->bindValue(':lugar', $CtlEstablecimientoLocal->getId());
                                $stm->bindValue(':tipoSolicitud', '1');
                                $stm->bindValue(':idDatoReferencia', $idDatoReferencia);
                                $stm->bindValue(':idEstablecimiento', $idEstablecimiento);
                                $stm->execute();
                                $result = $stm->fetchAll();

                                if ($result[0]['deletesolicitudestudio'] === null) {
                                    $error[] = 'Error al proceder con la eliminacion de la solicitud NÂ°: ' . $idSolicitudUrgente;
                                }
                            }

                            if ($idSolicitudNormal !== null) {
                                $sql = "SELECT deletesolicitudestudio(:idHistorialClinico, :lugar, :tipoSolicitud, :idDatoReferencia, :idEstablecimiento)";

                                $stm = $this->container->get('database_connection')->prepare($sql);
                                $stm->bindValue(':idHistorialClinico', $idHistorialClinico);
                                $stm->bindValue(':lugar', $CtlEstablecimientoLocal->getId());
                                $stm->bindValue(':tipoSolicitud', '2');
                                $stm->bindValue(':idDatoReferencia', $idDatoReferencia);
                                $stm->bindValue(':idEstablecimiento', $idEstablecimiento);
                                $stm->execute();
                                $result = $stm->fetchAll();

                                if ($result[0]['deletesolicitudestudio'] === null) {
                                    $error[] = 'Error al proceder con la eliminacion de la solicitud NÂ°: ' . $idSolicitudNormal;
                                }
                            }
                        }
                    }

                    if (count($error) > 0) {
                        $em->getConnection()->rollback();
                    } else {
                        $em->getConnection()->commit();
                    }
                } catch (\Exception $e) {
                    $erro[] = 'Error en el proceso de eliminacion de la solicitud, Detalle del error: <br>' . $e;

                    $em->getConnection()->rollback();
                }
            } else {
                $error[] = 'Error... La solicitud de estudio de laboratorio <b>no puede ser eliminada, debido a que actualmente se encuentra en proceso dentro del Laboratorio.</b>';
            }
        }

        if (count($error) > 0) {
            $data['status'] = false;
            $data['msj'] = $error;
        } else {
            $data['status'] = true;
            $data['ms'] = 'El examen fue eliminado exitosamente';
        }

        return $data;
    }

    public function getLastRoute($request) {
        $referer = $request->headers->get('referer');

        //Probar $request->server->get('HTTP_REFERER');
        if (isset($referer)) {
            $baseUrl = ($request->getBaseUrl()) ? $request->headers->get('host') . $request->getBaseUrl() : $request->headers->get('host');

            $lastPath = substr($referer, strpos($referer, $baseUrl));
            $lastPath = str_replace($baseUrl, '', $lastPath);
            $matcher = $this->get('router')->getMatcher();
            $parameters = $matcher->match($lastPath);
            $route = $parameters['_route'];
        } else {
            $route = 'unknow';
        }
        return $route;
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza para obtener el descriptor de un
     *              determinado catalogo.
     * PARÁMETROS DE ENTRADA:
     *                  -id: id del formulario a eliminar
     * PARAMETROS DE ENVIO:
     *                 NINGUNO
     * ANALISTA PROGRAMADOR: Aaron Romero
     */

    public function getRegDescriptor($id, $catalog, $field) {

        $sql = "SELECT c." . $field . " as desc
                FROM " . $catalog . " c " .
                "WHERE c.id = " . $id . "";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]['desc'];
    }

    public  function getSnomedDescriptor($historyId, $diagTypeId){
        $sql = "SELECT c.sct_name_es as desc
                FROM sec_historial_clinico h
                INNER JOIN sec_diagnostico_paciente d ON (h.id = d.id_historial_clinico)
                INNER JOIN mnt_snomed_cie10 c ON (d.id_snomed = c.id)
                WHERE h.id = " . $historyId .
                "AND d.id_tipo_diagnostico = " . $diagTypeId;

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]['desc'];
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza para llamar a la vista y generar pdf de la historia clinica
     * PARÁMETROS DE ENTRADA:
     *                  -action: la acción a realiza, si es nulo se le asignara crear
     *                  -external: se utiliza para saber de donde es llamada. true si
     *                             es llamada del formulario de la consulta.
     *                  -idHistorialClinico: el id historial clinico que le corresponde
     *                                       a esa receta.
     * PARAMETROS DE ENVIO:
     *                    -expediente: Objeto expediente
     *                    -edad: edad del paciente
     *                    -object: objeto del historial clinico
     *                    -impresion: varible que determina si es una impresión o no. En este caso
      el valor sera TRUE
     *                    -savedData: valores del formulario dinamico.
     *                    -params: parametros necesarios para la parte de solicitud estudios.
     *                    -medicinaRecetada: los medicamentos recetados
     *                    -citasAsignadas: objetos de las citas asignadas al paciente en la historia
     *                    -imc: Array del IMC donde guarda el valor y la clasificación
     * ANALISTA PROGRAMADOR: Ing. Karen Peñate
     */

    /**
     * return the Response object associated to the action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function imprimirHistoriaClinicaAction($id) {

        if (false === $this->admin->isGranted('LIST')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $request = $this->get('request'); //obtengo todo lo que sen envia a travez de get y post
        $em = $this->getDoctrine()->getManager();

        $params['external'] = true;
        $formGenerator = $this->container->get('form.generator.service');


        /** Definir un array con los Id de las tablas principales (o padres). * */
        $mainIds = array('sec_historial_clinico' => $id);
        $historialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($id);
        /** Llamamos al metodo getFormSavedData, especificando el form del cual se generara un show y el array con los ID's principales * */
        $savedData = $formGenerator->getFormSavedData($historialClinico->getIdFormulario(), $mainIds);

        //Transformar el ID de los Diagnosticos SNOMED a Texto
        $lastDiagnosticType = null; // Elimiar al migrar cie10
        foreach ($savedData as $key1 => $data) {
            if (isset($data['name'])) {
                if ($data['name'] == 'Diagnóstico') {
                    if (isset($data['items'])) {
                        foreach ($data['items'] as $key2 => $item) {
                            if ($item['name'] == 'Diagnóstico:') {
                                if( $item['value'] ){
                                    $savedData[$key1]['items'][$key2]['value'] = $this->getRegDescriptor($item['value'], 'mnt_cie10', 'diagnostico'); // original instruction
                                }
                                else{
                                    $savedData[$key1]['items'][$key2]['value'] = $this->getSnomedDescriptor($id, $lastDiagnosticType);
                                }
                            }
                            else{
                                if($item['name'] == 'Tipo de Diagnostico')
                                    $lastDiagnosticType = $item['value'] == 'Principal' ? 1 : ( $item['value'] == 'Secundario' ? 2 : 3 );
                            }
                        }
                    }
                }
            }
        }
        /* Obteniendo recetas si posee este historial clinico */

        $dql = "SELECT D as medicina,A.dosis, count(D.id) as cuantas,A.cantidad
     FROM MinsalFarmaciaBundle:FarmMedicinarecetada A
     JOIN MinsalFarmaciaBundle:FarmCatalogoproductos D WITH (A.idmedicina = D.id)
     JOIN MinsalFarmaciaBundle:FarmRecetas B WITH (A.idreceta = B.id)
     JOIN MinsalSeguimientoBundle:SecHistorialClinico C WITH (B.idhistorialclinico = C.id AND C.id=$id)
     GROUP BY D.id,A.dosis,A.cantidad
     ORDER BY D.id ASC";
        $medicinaRecetada = $em->createQuery($dql)->getResult();

        /* Obteniendo las citas posteriores que posee el paciente */
        $dql = "SELECT A
     FROM MinsalSeguimientoBundle:SecHistorialCitaDiaSubsec A
     JOIN A.idHistorialClinico B
     WHERE B.id=$id
     ORDER BY A.id ASC
     ";
        $citasAsignadas = $em->createQuery($dql)->getResult();

        $user = $this->getUser();
        $CtlEstablecimientoLocal = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $idEstablecimiento = $request->get('idEstablecimiento') ? $request->get('idEstablecimiento') : $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimientoLocal->getId();


        if (intval($idEstablecimiento) !== $CtlEstablecimientoLocal->getId()) {
            $idDatoReferencia = $id;
        } else {
            $idDatoReferencia = null;
        }

        $solicitudEstudio = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->obtenerSolicitudEstudios($id, $idDatoReferencia, $idEstablecimiento);

        $params['solicitudEstudio'] = array('laboratorio' => $solicitudEstudio);


        $conn = $em->getConnection();
        $calcular = new Funciones();
        $expediente = $historialClinico->getIdExpediente();
        $edad = $calcular->calcularEdad($conn, $expediente->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $expediente->getIdPaciente()->getHoraNacimiento() ? $expediente->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );
        /* CALCULAR IMC */
        $sql = "SELECT CASE WHEN talla=0 THEN 0 ELSE round(peso/pow((talla/100),2),2) END as imc from sec_signos_vitales where id_historial_clinico=$id";
        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        $imc['valor'] = $result[0]['imc'];
        /* CUANDO SE TENGA LA FORMA DE CLASIFICAR APARECERÃ LA CLASIFICACIÃ“N */
        $imc['clasificacion'] = null;

        /* Consejeria Brindada */
        $dqlConsejeriaBrindada = "SELECT C FROM MinsalSeguimientoBundle:SecConsejeria C WHERE C.idHistorialClinico = " . $historialClinico->getId() . " ORDER BY C.id DESC";
        $params['consejeriaBrindada'] = $em->createQuery($dqlConsejeriaBrindada)->getResult();

        /*DATOS EMBARAZO*/
        $datoEmbarazo=$em->getRepository('MinsalSeguimientoBundle:SecDatoEmbarazo')->findOneBy(array('idHistorialClinico'=>$historialClinico->getId()));

        /*Otras Observaciones*/
        $secOtrasObservaciones=$em->getRepository('MinsalSeguimientoBundle:SecOtrasObservaciones')->findOneBy(array('idHistorialClinico'=>$historialClinico->getId()));

        $plantilla_imprimir = $historialClinico->getIdFormulario()->getVistaToPrint()? : $this->admin->getTemplate('imprimir_historia_clinica');

        $impresion = $this->renderView($plantilla_imprimir, array('impresion' => true,
            'expediente' => $expediente,
            'edad' => $edad,
            'savedData' => $savedData,
            'params' => $params,
            'medicinaRecetada' => $medicinaRecetada,
            'citasAsignadas' => $citasAsignadas,
            'object' => $historialClinico,
            'imc' => $imc,
            'datosEmbarazo'=>$datoEmbarazo,
            'secOtrasObservaciones'=>$secOtrasObservaciones
            )
        );

        /*         * * Registrar en Auditoria Seguimiento la Accion actual ** */
        $auditSec = new MntAuditoriaSeguimiento();
        $auditSec->setIdTipoAccionBitacora('P');
        $auditSec->setTablaAfectada('sec_historial_clinico');
        $auditSec->setIdRegistroAfectado($id);
        $auditSec->setIdUsuario($user);
        $auditSec->setFechaHoraRegistro(new \DateTime());

        $em->persist($auditSec);
        $em->flush();

        return new Response(
                $this->get('knp_snappy.pdf')
                        ->getOutputFromHtml($impresion, array(
                            'page-size' => 'Letter',
                            'encoding' => 'UTF-8',
                            'margin-top' => '40',
                            'margin-right' => '6',
                            'margin-left' => '8',
                            'margin-bottom' => '20',
                            'title' => 'Historia Clinica',
                            'header-spacing'=> '3',
                            'header-html'=>$this->renderView('MinsalSeguimientoBundle:Reportes:encabezado_impresion.html.twig',array('expediente'=>$expediente,'edad'=>$edad)),
                            'header-line'=>true,
                            'footer-right' => '[page] de [topage]',
                            'footer-spacing' => '10',
                            'footer-left'=>'[date]'
                            ))
                , 200, array('Content-Type' => 'application/pdf','Content-Disposition' => 'inline')
        );
    }

    public function retroactiveAction() {

        $templateKey = 'retroactive';
        $user = $this->getUser();

        //$user->hasRole('ROLE_SONATA_ADMIN_SECHISTORIALCLINICO_RETROACTIVE');
        if (!( $this->admin->isGranted('RETROACTIVE') || $user->hasRole('ROLE_SUPER_ADMIN') )) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->getRestMethod() == 'POST') {
            $form->submit($this->get('request'));

            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {

                $this->admin->create($object);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                                'result' => 'ok',
                                'objectId' => $this->admin->getNormalizedIdentifier($object)
                    ));
                }

                $this->addFlash('sonata_flash_success', $this->admin->trans('flash_create_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));

                // redirect to edit mode
                return $this->redirectTo($object);
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash('sonata_flash_error', $this->admin->trans('flash_create_error', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
                }
            } elseif ($this->isPreviewRequested()) {
                // pick the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'retroactive',
                    'form' => $view,
                    'object' => $object,
        ));
    }

    public function getAllowResultsHistory($idExpediente, $idAtenAreaModEstab) {
        $em        = $this->getDoctrine()->getManager();
        $today     = new \DateTime();

        $limitHistoryDate = date(' d/m/Y', strtotime('-3 month', strtotime($today->format('Y-m-d'))));
        $limitResultDate  = date(' d/m/Y', strtotime('-3 month', strtotime($today->format('Y-m-d'))));

        $dql = "SELECT d
                FROM MinsalSeguimientoBundle:SecDetallesolicitudestudios d
                LEFT JOIN MinsalLaboratorioBundle:LabResultados r WITH (r.iddetallesolicitud = d.id)
                INNER JOIN MinsalSeguimientoBundle:SecSolicitudestudios s WITH (d.idsolicitudestudio = s.id)
                INNER JOIN MinsalLaboratorioBundle:CtlEstadoServicioDiagnostico e WITH (d.estadodetalle = e.id)
                INNER JOIN MinsalSeguimientoBundle:SecHistorialClinico h WITH (s.idHistorialClinico = h.id)
                WHERE h.idExpediente = :idExpediente
                AND   h.idAtenAreaModEstab = :idAtenAreaModEstab
                AND   h.fechaconsulta > :limitHistoryDate
                AND   (r.fechaResultado > :limitResultDate OR r.fechaResultado IS NULL)
                AND   e.id NOT IN (6,8,10,11)
                ORDER BY h.fechaconsulta DESC";

        $results = $em->createQuery($dql)
                      ->setParameter('idExpediente', $idExpediente)
                      ->setParameter('idAtenAreaModEstab', $idAtenAreaModEstab)
                      ->setParameter('limitHistoryDate', $limitHistoryDate)
                      ->setParameter('limitResultDate', $limitResultDate)
                      ->getArrayResult();

        if ($results) {
            return true;
        } else {
            return false;
        }
    }

    public function findTipoHistoriaClinica( $formulario, $antecedentes, $especialidad ){
        $id = null;
        if ( $formulario->getId() == 26){
            $id = 1; //Consulta de Entrega de resultados
        }
        else{
            if( $formulario->getIdTipoFormulario()->getId() == 1 ){ //Formulario de Antecedentes
                if( $antecedentes ){
                    $em = $this->getDoctrine()->getManager();
                    $dql = "SELECT A
                            FROM MinsalSeguimientoBundle:SecAntecedentesEspecialidadForm A
                            JOIN MinsalSeguimientoBundle:SecAntecedentes B WITH (A.idAntecedentes = B.id)
                            WHERE A.idAntecedentes= :idAntecedentes AND A.idAtenAreaModEstab= :idEspecialidad
                            ORDER BY A.fecha DESC";

                    $resultado = $em->createQuery($dql)
                                 ->setParameters( array( 'idAntecedentes' => $antecedentes->getId(), 'idEspecialidad' => $especialidad->getId() ) )
                                 ->getResult();

                    if( $resultado ){
                        $id = 7; //Inscripcion Subsecuente
                    }
                    else {
                        switch ( $formulario->getId() ) {
                            case 23: //Antecedentes VICITS
                                $id = 2; //Inscripción
                                break;
                            default:
                                $id = 6; //Primera Vez
                                break;
                        }
                    }
                }
                else{
                    switch ( $formulario->getId() ) {
                        case 23: //Antecedentes VICITS
                            $id = 2; //Inscripción
                            break;
                        default:
                            $id = 6; //Primera Vez
                            break;
                    }
                }
            }
            else{
                switch ( $formulario->getId() ) {
                    case 24: // Consulta VICITS Mujeres
                    case 25: // Consulta VICITS Hombres
                        $id = 3; // Control
                        break;
                    default:
                        $id = 4; // Subsecuente/Seguimiento
                        break;
                }
            }
        }

        return $this->findObject('MinsalSeguimientoBundle', 'CtlTipoHistoriaClinica', $id);
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza para mostrar cuantos pacientes ha atendido un
                    médicos de una determinada especialidad.
     * PARÁMETROS DE ENTRADA: NINGUNO
     * PARAMETROS DE ENVIO:
     *                  -action: list, para saber que es de tipo listar
     *                  -expediente: objeto expediente según el id_expediente que se recibe.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */
     public function pacientesAtendidosAction() {
         $user = $this->container->get('security.context')->getToken()->getUser();
         if ($user->hasRole('ROLE_SONATA_ADMIN_CONSULTAS_ATENDIDAS') === false && $user->hasRole('ROLE_SUPER_ADMIN') === false) {
             return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                         'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
             ));
         }

         $em = $this->getDoctrine()->getManager();
         $dql = "SELECT atenAreaModEstab
                   FROM MinsalSiapsBundle:MntAtenAreaModEstab atenAreaModEstab
                   JOIN atenAreaModEstab.idAreaModEstab idArea
                   JOIN atenAreaModEstab.idAtencion idAtencion
                   WHERE idArea.idAreaAtencion=1 and atenAreaModEstab.nombreAmbiente is NULL
                   ORDER BY idAtencion.nombre ASC";

         $resultados = $em->createQuery($dql)
                 ->getResult();

         return $this->render('MinsalSeguimientoBundle:SecHistorialClinico:listaPacientesAtendidos.html.twig', array(
                     'action' => 'list',
                     'especialidades'=>$resultados

         ));
     }

     /*
      * DESCRIPCIÓN: Método que se utiliza para mostrar cuantos pacientes ha atendido un
                     médicos de una determinada especialidad.
      * PARÁMETROS DE ENTRADA: NINGUNO
      * PARAMETROS DE ENVIO:
      *                  -action: list, para saber que es de tipo listar
      *                  -expediente: objeto expediente según el id_expediente que se recibe.
      * ANALISTA PROGRAMADOR: Karen Peñate
      */
      public function historiasClinicasMedicosAction() {
          $user = $this->container->get('security.context')->getToken()->getUser();
          if ($user->hasRole('ROLE_SONATA_ADMIN_CONSULTAS_ATENDIDAS') === false && $user->hasRole('ROLE_SUPER_ADMIN') === false) {
              return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                          'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
              ));
          }

          return $this->render('MinsalSeguimientoBundle:SecHistorialClinico:historiasClinicasMedicos.html.twig', array(
                      'action' => 'list'
          ));
      }




    public function enviarSolicitud($idp, $paciente, $idsolicitud, $expe) {
        //var_dump('Entrando al metodo enviar solicitud...<br/>');
        try {
            //var_dump('Definiendo variables de la Solicitud...<br/>');
            $solic = $this->findObject('MinsalSeguimientoBundle', 'TarSolicitudFvih', $idsolicitud);
            $estable = $solic->getIdHistorialClinico()->getIdEstablecimiento()->getId();
            $numexp = $expe->getNumero();
            //$fecha = new \DateTime();
            $fecha = $solic->getIdHistorialClinico()->getFechaconsulta();
            $fecha = date('Y-m-d H:i:s', $fecha->getTimestamp());
            $motivo = $solic->getIdMotivoSolicitud()->getId();
            $orientacions = $solic->getIdOrientacionSexual()->getId();
            $identidadg = $solic->getIdentidadGenero()->getId();
            $formast = $solic->getIdFormasTransmision() ? $solic->getIdFormasTransmision()->getId() : 'NULL';
            $indicacion = $solic->getIdIndicacionExamen() ? $solic->getIdIndicacionExamen()->getId() : 'NULL';
            $tipoRelacionSexualSinProteccion = $solic->getIdTipoRelacionSexualSinProteccion() ? $solic->getIdTipoRelacionSexualSinProteccion()->getId() : 'NULL';
            $poblacionMeta = $solic->getIdPoblacionMeta() ? $solic->getIdPoblacionMeta()->getId() : 'NULL';
            $datosc = $solic->getIdDatosClinicos() ? $solic->getIdDatosClinicos()->getId() : 0;
            $datosm = $solic->getIdDatosManejo() ? $solic->getIdDatosManejo()->getId() : 0;
            $embarazada = ( $paciente->getIdCondicionPersona()->getAbreviatura() == 'E' ) ? 1 : 2;
            $consejeria = $solic->getEsConsejeria() ? 1 : 2;
            $idpsiap = $paciente->getId();
            $paisOrigen = $paciente->getIdPaisNacimiento() ? $paciente->getIdPaisNacimiento()->getId() : 'NULL';
            $areaGeografica = $paciente->getAreaGeograficaDomicilio() ? $paciente->getAreaGeograficaDomicilio()->getId() : 'NULL';
            $pnombre = $paciente->getPrimerNombre();
            $snombre = $paciente->getSegundoNombre();
            $tnombre = $paciente->getTercerNombre();
            $nombref = $pnombre . ' ' . $snombre . ' ' . $tnombre;
            $papellido = $paciente->getPrimerApellido();
            $sapellido = $paciente->getSegundoApellido();
            $apellidoc = $paciente->getApellidoCasada();
            $apellidof = $papellido . ' ' . $sapellido . ' ' . $apellidoc;
            $dui = $paciente->getIdDocPaciente() ? ( $paciente->getIdDocPaciente()->getId() == 1 ? ( $paciente->getNumeroDocIdePaciente() ? $paciente->getNumeroDocIdePaciente() : '??' ) : '??' ) : '??';
            $responsable = $paciente->getNombreResponsable() ? $paciente->getNombreResponsable() : '??';
            $fechanac = date('Y-m-d H:i:s', $paciente->getFechaNacimiento()->getTimestamp());
            $sexo = $paciente->getIdSexo()->getId();
            $estadocivil = $paciente->getIdEstadoCivil() ? $paciente->getIdEstadoCivil()->getId() : 'NULL';
            $depto = $paciente->getIdDepartamentoNacimiento() ? $paciente->getIdDepartamentoNacimiento()->getId() : '1';
            $muni = $paciente->getIdMunicipioNacimiento() ? $paciente->getIdMunicipioNacimiento()->getId() : '1';
            $direccion = $paciente->getDireccion() ? $paciente->getDireccion() : '??';
            $em = $this->getDoctrine()->getManager();
            //var_dump('Obteniendo Factores...<br/>');
            $factores = $em->getRepository('MinsalSeguimientoBundle:TarSolicitudFvih')->obtenerFactoresRiesgo($idsolicitud);

            $losfactores = "";
            foreach ($factores as $factor) {
                if ($losfactores != "") {
                    $losfactores.="|";
                }
                $losfactores.=$factor['codigo'];
            }

            if ($losfactores == "") {
                $losfactores = "??";
            }
            //var_dump('Definiendo XMLs... <br/>');
            $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<solicitud>
<idp>$idp</idp>
<idpsiap>$idpsiap</idpsiap>
<estable>$estable</estable>
<expe>$numexp</expe>
<fecha>$fecha</fecha>
<motivo>$motivo</motivo>
<psexual>$orientacions</psexual>
<idsexual>$identidadg</idsexual>
<ptransmision>$formast</ptransmision>
<consejeria>$consejeria</consejeria>
<factores>$losfactores</factores>
<descartar>$indicacion</descartar>
<embarazada>$embarazada</embarazada>
<clinica>$datosc</clinica>
<manejo>$datosm</manejo>
</solicitud>
XML;

            $xml2 = <<<XML
<paciente>
<nombre1>$pnombre</nombre1>
<nombre2>$snombre</nombre2>
<nombre3>$tnombre</nombre3>
<idpsiap>$idpsiap</idpsiap>
<estable>$estable</estable>
<nombres>$nombref</nombres>
<apellido1>$papellido</apellido1>
<apellido2>$sapellido</apellido2>
<apellido3>$apellidoc</apellido3>
<apellidos>$apellidof</apellidos>
<dui>$dui</dui>
<responsable>$responsable</responsable>
<fechanac>$fechanac</fechanac>
<sexo>$sexo</sexo>
<departamento>$depto</departamento>
<municipio>$muni</municipio>
<direccion>$direccion</direccion>
<estadocivil>$estadocivil</estadocivil>
<paisorigen>$paisOrigen</paisorigen>
<areageografica>$areaGeografica</areageografica>
</paciente>
XML;


            $cliente = new Cliente();
            $cliente->setContainer($this->container);
            $labase = $this->container->getParameter('global_host');
            //var_dump('Se establecera conexion a la base global: '.$labase.' ...<br/>');
            //var_dump('Llamando al metodo <b>cliente->registrarSolicitudAction</b> ...<br/>');
            $resultSolicitud = $cliente->registrarSolicitudAction($labase, $xml, $xml2);
        } catch (\Exception $ex) {
            $resultSolicitud['status'] = false;
            throw $ex;
        }
        return $resultSolicitud;
    }

}
