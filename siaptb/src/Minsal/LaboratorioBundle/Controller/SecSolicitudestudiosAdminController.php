<?php

namespace Minsal\LaboratorioBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Minsal\Metodos\Funciones;
use Doctrine\DBAL as DBAL;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Util\TokenGenerator;
use Minsal\SeguimientoBundle\Controller\ClienteController as Cliente;
use Minsal\SeguimientoBundle\Entity\SecHistorialClinico;
use Minsal\LaboratorioBundle\Entity\MntDatoReferencia;
use Minsal\SiapsBundle\Entity\MntPacienteReferido;
use Minsal\LaboratorioBundle\Entity\MntExpedienteReferido;
use Minsal\SeguimientoBundle\Entity\SecDiagnosticoPaciente;

class SecSolicitudestudiosAdminController extends CRUDController
{

    protected $idprogramas = '{125}';

    /**
     * return the Response object associated to the list action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @return Response
     */
    public function listAction()
    {
        if (false === $this->admin->isGranted('LIST') && false === $this->admin->isGranted('HISTORY')) {
            throw new AccessDeniedException();
        }

        $request = $this->get('request');

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        $params['external']     = $request->get('_external') ? $request->get('_external') : false;
        $params['useProxy']     = $request->get('useProxy') ? $request->get('useProxy') : null;
        $params['idExpediente'] = $request->get('idExpediente') ? $request->get('idExpediente') : null;
        $params['idEspecialidadHclinica'] = $request->get('idEspecialidadHclinica') ? $request->get('idEspecialidadHclinica') : null;

        return $this->render($this->admin->getTemplate('list'), array(
            'action'     => 'list',
            'form'       => $formView,
            'datagrid'   => $datagrid,
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
            'params'     => $params,
        ));
    }

    /**
     * return the Response object associated to the action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException|\Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return Response
     */
    public function assignExamAction() {
        if (false === $this->admin->isGranted('ASSIGNEXAM')) {
            throw new AccessDeniedException();
        }

        $request = $this->get('request');
        $session = $this->container->get('session');

        $action = $request->get('action') ? $request->get('action') : 'create';

        $form = $this->admin->getForm();
        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        $em = $this->getDoctrine()->getManager();

        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));

        $user               = $this->getUser();
        $idEstablecimiento  = $request->get('idEstablecimiento') ? $request->get('idEstablecimiento') : ( $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : ( $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId() ) );
        $idHistorialClinico = $request->get('idHistorialClinico');
        $tipoPacPertenencia = $request->get('tipoPacPertenencia') ? $request->get('tipoPacPertenencia') : ( $CtlEstablecimiento->getId() === intval($idEstablecimiento) ? 'local' : 'referido' );
        $local              = $CtlEstablecimiento->getId() === intval($idEstablecimiento) ? true : false;

        if( $local ) {
            $SecHistorialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->findOneById($idHistorialClinico);
            $idDatoReferencia    = null;
            $expediente          = $SecHistorialClinico->getIdExpediente();
            $paciente            = $expediente->getIdPaciente();
        } else {
            $SecHistorialClinico = $em->getRepository('MinsalLaboratorioBundle:MntDatoReferencia')->findOneById($idHistorialClinico);
            $idDatoReferencia    = $SecHistorialClinico->getId();
            $idHistorialClinico  = null;
            $expediente          = $SecHistorialClinico->getIdExpedienteReferido();
            $paciente            = $expediente->getIdReferido();
        }

        $result = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->obtenerSolicitudEstudios($idHistorialClinico, $idDatoReferencia, $idEstablecimiento, 6);
        $detalle = array();
        $impresiones = 0;

        if( $action === 'edit' && count($result) === 0 ) {
            throw new NotFoundHttpException(sprintf('La solicitud de estudios con idHistorialClinico: %s, idDatoReferencia: %s, idEstablecimiento: %s, no ha sido encontrada', $idHistorialClinico, $idDatoReferencia, $idEstablecimiento));
        }

        foreach ($result as $value) {
            $id = $value['idarea'].'_'.$value['idexamen'];
            if($value['urgente'] === 'true' && $value['idtiposolicitud'] === 2) {
                $value['urgente'] = 'false';
            }
            $detalle[$id] = $value;
            $impresiones = $value['impresiones'];
        }

        $params['external']                 = $request->get('_external') ? true : false;
        $params['paciente']                 = $paciente;
        $params['expediente']               = $expediente;
        $params['fechaSolicitud']           = $request->get('fechaSolicitud');
        $params['idEstablecimiento']        = $idEstablecimiento;
        $params['tipoPacPertenencia']       = $tipoPacPertenencia ? $tipoPacPertenencia : null;
        $params['SecHistorialClinico']      = $SecHistorialClinico ? $SecHistorialClinico : null;
        $params['detalleSolicitudEstudios'] = $detalle;

        $params['impresiones'] = $impresiones === 1 ? 'checked' : '';

        $mntEmpleado = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneById($request->get('idEmpleado'));
        $mntAtenAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($request->get('idEspecialidad'));

        $params['modulo']              = $request->get('_modulo') ? $request->get('_modulo') : null;
        $params['mntEmpleado']         = $request->get('idEmpleado') ? $mntEmpleado : null;
        $params['mntAtenAreaModEstab'] = $request->get('idEspecialidad') ? $mntAtenAreaModEstab : null;

        $tokenGenerator = new TokenGenerator();
        $token1 = $tokenGenerator->generateToken();
        $token2 = $tokenGenerator->generateToken();

        $session->set('_secured_token', $token1);
        $session->set('_value_token', $token2);

        return $this->render($this->admin->getTemplate('assign_exam'), array(
            'action'   => $action === 'create' ? count($detalle) > 0 ? 'edit' : 'create' : $action,
            'form'     => $view,
            'params'   => $params,
            'tokens'   => array('token1' => $token1, 'token2' => $token2),
        ));
    }

    /**
     * Create action
     *
     * @return Response
     *
     * @throws AccessDeniedException If access is not granted
     */
    public function createAction() {
        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        $em   = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));

        if ($this->getRestMethod()== 'POST') {
            $request = $this->get('request');
            $session = $this->container->get('session');

            $modulo             = $request->get('external_modulo');
            $external           = $request->get('external');
            $idPaciente         = $request->get('idPaciente');
            $idEmpleado         = $request->get('idEmpleado');
            $impresiones        = $request->get('impresiones') ? 1 : 0;
            $idExpediente       = $request->get('idExpediente');
            $idEspecialidad     = $request->get('idEmpleadoEspecialidadEstab');
            $fechaSolicitud     = $request->get('fechaSolicitud');
            $numeroExpediente   = $request->get('numeroExpediente');
            $idEstablecimiento  = $request->get('idEstablecimiento');
            $idHistorialClinico = $request->get('idHistorialClinico');
            $tipoPacPertenencia = $request->get('tipoPacPertenencia');

            $local = $CtlEstablecimiento->getId() === intval($idEstablecimiento) ? true : false;

            $MntAtenAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($idEspecialidad);
            $services            = $this->container->hasParameter('servicio_generar_cita') ? $this->container->getParameter('servicio_generar_cita') : array();
            $currentService      = $MntAtenAreaModEstab ? $MntAtenAreaModEstab->getIdAtencion()->getId() : null;

            $array    = array();
            $elements = array();
            foreach ($request->request as $key => $value) {
                if(substr($key,0,5) === 'exam_') {
                    $explode = explode('_', $value);
                    $array[] = array('idArea' => $explode[0], 'idExamen' => $explode[1]);
                }
            }

            foreach ($array as $value) {
                $elements[] = array(
                                'idArea'        => $value['idArea'],
                                'idExamen'      => $value['idExamen'],
                                'idOrigen'      => $request->get('origen_'.$value['idArea'].'_'.$value['idExamen']) !== '' ? $request->get('origen_'.$value['idArea'].'_'.$value['idExamen']) : null,
                                'indicacion'    => $request->get('indicacion_'.$value['idArea'].'_'.$value['idExamen']),
                                'idTipoMuestra' => $request->get('muestra_'.$value['idArea'].'_'.$value['idExamen']) !== '' ? $request->get('muestra_'.$value['idArea'].'_'.$value['idExamen']) : null,
                                'urgente'       => $request->get('urgente_'.$value['idArea'].'_'.$value['idExamen']) !== NULL ? 'true' : $MntAtenAreaModEstab->getIdAtencion()->getId() === 123 ? 'true' : 'false',
                            );
            }

            if( $local ) {
                $idExpedienteReferido = NULL;
                $idDatoReferencia     = NULL;
            } else {
                $idExpedienteReferido = $idExpediente;
                $idDatoReferencia     = $idHistorialClinico;
                $idExpediente         = NULL;
                $idHistorialClinico   = NULL;
            }

            $parameters = array(
                'elements'               => $elements,
                'impresiones'            => $impresiones,
                'idExpediente'           => $idExpediente,
                'idUsuarioReg'           => $user->getId(),
                'fechaSolicitud'         => $fechaSolicitud,
                'numeroExpediente'       => $numeroExpediente,
                'idDatoReferencia'       => $idDatoReferencia,
                'idEstablecimiento'      => $idEstablecimiento,
                'idHistorialClinico'     => $idHistorialClinico,
                'idExpedienteReferido'   => $idExpedienteReferido,
                'idEstablecimientoLocal' => $CtlEstablecimiento->getId(),
                'idprogramas'            => $this->idprogramas,
                'crearCitaServicio'      => in_array($currentService, $services) ? 'true' : 'false'
            );

            $em->getConnection()->beginTransaction();
            try {
                $createdElement = null;
                if($request->get('action') === 'create') {
                    $result = $this->createSolicitudEstudio($parameters);

                    if($result === true) {
                        $msjtype        = 'sonata_flash_success';
                        $msjcontent     = 'Solicitud de Estudios Creada Exitosamente';
                        $createdElement = 'true';
                        $action         = 'edit';
                    } else {
                        $msjtype    = 'sonata_flash_error';
                        $msjcontent = 'Error en la creación de la solicitud de estudio de laboratorio clinico, por favor intente nuevamente, si el problema persiste contacte con el administrador.<br /><b>Detalle del Error</b><br />'. $result;
                        $action     = 'create';
                    }
                } else {
                    $sql = "SELECT searchallsolicitudestudios(:idHistorialClinico, :lugar, :tipoSolicitud, :idDatoReferencia, :idEstablecimiento, ARRAY[6])";

                    $stm = $this->container->get('database_connection')->prepare($sql);
                    $stm->bindValue(':idHistorialClinico', $idHistorialClinico);
                    $stm->bindValue(':lugar', $CtlEstablecimiento->getId());
                    $stm->bindValue(':tipoSolicitud', '1');
                    $stm->bindValue(':idDatoReferencia', $idDatoReferencia);
                    $stm->bindValue(':idEstablecimiento', $idEstablecimiento);
                    $stm->execute();
                    $result = $stm->fetchAll();

                    $idSolicitudUrgente = array();
                    foreach ($result as $key => $value) {
                        $idSolicitudUrgente[] = $value['searchallsolicitudestudios'];
                    }

                    if(count($idSolicitudUrgente) > 0) {
                        $idSolicitudUrgente = implode(',',$idSolicitudUrgente);
                    } else {
                        $idSolicitudUrgente = '0';
                    }

                    $sql = "SELECT searchallsolicitudestudios(:idHistorialClinico, :lugar, :tipoSolicitud, :idDatoReferencia, :idEstablecimiento, ARRAY[6])";

                    $stm = $this->container->get('database_connection')->prepare($sql);
                    $stm->bindValue(':idHistorialClinico', $idHistorialClinico);
                    $stm->bindValue(':lugar', $CtlEstablecimiento->getId());
                    $stm->bindValue(':tipoSolicitud', '2');
                    $stm->bindValue(':idDatoReferencia', $idDatoReferencia);
                    $stm->bindValue(':idEstablecimiento', $idEstablecimiento);
                    $stm->execute();
                    $result = $stm->fetchAll();

                    $idSolicitudNormal = array();
                    foreach ($result as $key => $value) {
                        $idSolicitudNormal[] = $value['searchallsolicitudestudios'];
                    }

                    if(count($idSolicitudNormal) > 0) {
                        $idSolicitudNormal = implode(',',$idSolicitudNormal);
                    } else {
                        $idSolicitudNormal = '0';
                    }

                    $sql = "SELECT id
                    FROM lab_recepcionmuestra
                    WHERE idsolicitudestudio IN ($idSolicitudUrgente,$idSolicitudNormal)";

                    $stm = $this->container->get('database_connection')->prepare($sql);
                    $stm->execute();
                    $result = $stm->fetchAll();

                    if(count($result) <= 0) {
                        $result = $this->updateSolicitudEstudio($parameters, $request);
                        if($result['status'] === true) {
                            $msjtype = 'sonata_flash_success';
                            $msjcontent = 'Solicitud de Estudios Actualizada Exitosamente';
                            $createdElement = 'true';

                            if($result['pruebaFVIH']) {
                                //var_dump('Obteniendo Solicitudes FVIH asociadas...<br/>');
                                $solicitudFvih = $this->getFvihAsociada($idHistorialClinico);

                                if( $solicitudFvih ){
                                    //var_dump('Eliminado '.count($solicitudFvih).' Solicitudes FVIH asociadas...<br/>');
                                    $this->deleteSolicitudFvih( $solicitudFvih, $idPaciente);
                                }

                            }
                        } else {
                            $msjtype = 'sonata_flash_error';
                            $msjcontent = 'Error en la actualizacion de la solicitud de estudio de laboratorio clinico, por favor intente nuevamente, si el problema persiste contacte con el administrador. <br /><br /><b>Detalle del Error:</b><br /><br />'. $result;
                        }
                    } else {
                        $msjtype = 'sonata_flash_error';
                        $msjcontent = 'Error... La solicitud de estudio de laboratorio <b>no puede ser actualizada, debido a que actualmente se encuentra en proceso dentro del Laboratorio.</b>';
                    }

                    $action = 'edit';
                }

                $this->addFlash($msjtype, $msjcontent);

                if( $msjtype === 'sonata_flash_success' ) {
                    $em->getConnection()->commit();
                } else {
                    $em->getConnection()->rollback();
                }

                $urlParameters = array('_external' => $external, '_modulo' => $modulo, 'tipoPacPertenencia' => $tipoPacPertenencia, 'idEmpleado' => $idEmpleado, 'idEspecialidad' => $idEspecialidad, 'idHistorialClinico' => ( $local ? $idHistorialClinico : $idDatoReferencia ), 'fechaSolicitud' => $fechaSolicitud, 'action' => $action, 'createdElement' => $createdElement, 'idEstablecimiento' => $idEstablecimiento );

                return new RedirectResponse($this->admin->generateUrl('assign_exam', $urlParameters));
            } catch (\Exception $e) {
                $em->getConnection()->rollback();

                $this->addFlash('sonata_flash_error', $e);
                throw $e;
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        /* busqueda de establecimientos y el establecimiento del usuario */
        $establecimientos = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findAll();
        $session = $this->container->get('session');
        $id = $session->get('_idEmpEspecialidadEstab');

        $usuario = $em->getRepository('ApplicationSonataUserBundle:User')->findOneById(array('id'=>$id));
	    $idEstablecimiento = $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : ( $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId() );

        return $this->render($this->admin->getTemplate('edit'), array(
            'action'                    => 'create',
            'form'                      => $view,
            'object'                    => $object,
            'idestablecimiento_local'   => $idEstablecimiento,
            'establecimientos'          => $establecimientos,
        ));


    }

    public function agregarSolicitudAction() {
        $em 				= $this->getDoctrine()->getManager();
        /* capturar variables enviadas por GET */
        $request	    	= $this->getRequest();

        $idestablecimiento  = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneById($request->get('id_establecimiento_text'));
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $fechaconsulta		= \DateTime::createFromFormat('d/m/Y', $request->get('fecha_solicitud'));
        $idsubservicio		= $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($request->get('id_subservicio'));
        $idusuarioreg		= $this->getUser();
        $fechahorareg		= new \DateTime();
        $piloto				= 'V';
        $ipaddress			= $request->server->get('REMOTE_ADDR');
        $idEmpleado		    = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneById($request->get('id_medico'));
        $local              = ( $idestablecimiento->getId() === $CtlEstablecimiento->getId() ) ? true : false;
        $idNumeroExpediente = $local ? $em->getRepository('MinsalSiapsBundle:MntExpediente')->findOneById($request->get('id_numero_expediente_text')) : $em->getRepository('MinsalLaboratorioBundle:MntExpedienteReferido')->findOneById($request->get('id_numero_expediente_text'));
        $idDiagnosticoCie10 = $request->get('id_cie10') ? $em->getRepository('MinsalSiapsBundle:MntCie10')->findOneById( $request->get('id_cie10') ) : null;
        $idTipoDiagnostico  = $em->getRepository('MinsalSeguimientoBundle:CtlTipoDiagnostico')->findOneById( $request->get('id_tipo_diagnostico') ? $request->get('id_tipo_diagnostico') : 1 ); // Default 1: Principal
        $especDiagnostico   = $request->get('espec_diagnostico') ? $request->get('espec_diagnostico') : null;

        /* evalua si el expediente es del mismo establecimiento */
        if( $local ) {
            $SecHistorialClinico = new SecHistorialClinico();
            $SecHistorialClinico->setFechaconsulta($fechaconsulta);
            $SecHistorialClinico->setIdAtenAreaModEstab($idsubservicio);
            $SecHistorialClinico->setIdUsuarioRegistra($idusuarioreg);
            $SecHistorialClinico->setFechaRegistra($fechahorareg);
            $SecHistorialClinico->setPiloto($piloto);
            $SecHistorialClinico->setIpaddress($ipaddress);
            $SecHistorialClinico->setIdEstablecimiento($idestablecimiento);
            $SecHistorialClinico->setIdExpediente($idNumeroExpediente);
            $SecHistorialClinico->setIdEmpleado($idEmpleado);
            $em->persist( $SecHistorialClinico );
            $em->flush();

            $diagnostico = new SecDiagnosticoPaciente();
            $diagnostico->setIdHistorialClinico($SecHistorialClinico);
            $diagnostico->setIdTipoDiagnostico($idTipoDiagnostico);
            $diagnostico->setIdCie10Medico($idDiagnosticoCie10);
            $diagnostico->setEspecificacion($especDiagnostico);
            $diagnostico->setConfirmado(false);
            $diagnostico->setIdTipoConsulta(null);
            $diagnostico->setIdSnomed(null);
            $diagnostico->setIdCie10Estadista(null);

            $em->persist( $diagnostico );
            $em->flush();

            $idHistorialClinico = $SecHistorialClinico->getId();
        } else { // en caso que sea paciente de otro establecimiento
            $MntDatoReferencia = new MntDatoReferencia();
            $MntDatoReferencia->setIdExpedienteReferido($idNumeroExpediente);
            $MntDatoReferencia->setIdEmpleado($idEmpleado);
            $MntDatoReferencia->setIdAtenAreaModEstab($idsubservicio);
            $MntDatoReferencia->setFechaHorareg($fechahorareg);
            $MntDatoReferencia->setIdusuarioreg($idusuarioreg);
            $MntDatoReferencia->setIdEstablecimiento($idestablecimiento);
            $MntDatoReferencia->setIdCie10($idDiagnosticoCie10);
            $MntDatoReferencia->setIdTipoDiagnostico($idTipoDiagnostico);
            $MntDatoReferencia->setEspecificacionDiagnostico($especDiagnostico);
            $em->persist( $MntDatoReferencia );
            $em->flush();
            $idHistorialClinico = $MntDatoReferencia->getId();
        }

        if ($idHistorialClinico) {
            $urlParameters = array('_external' => false, '_modulo' => 'seguimientoclinico', 'idEmpleado' => $idEmpleado->getId(), 'idEspecialidad' => $idsubservicio->getId(), 'idHistorialClinico' => $idHistorialClinico, 'fechaSolicitud' => $fechaconsulta->format('Y-m-d'), 'action' => 'create', 'idEstablecimiento' => $idestablecimiento->getId());
            return new RedirectResponse($this->admin->generateUrl('assign_exam', $urlParameters));
        } else {
            $this->addFlash('sonata_flash_error', 'Error, hubo un problema a la hora de guardar, intentelo nuevamente, si el error persiste comuniquese con el administrador');
            return new RedirectResponse($this->admin->generateUrl('create'));
        }

    }


    public function agregarPacienteReferidoAction() {
        $em 				= $this->getDoctrine()->getManager();
        /* capturar variables enviadas por GET */
        $request	    	= $this->getRequest();
        $sexo               = $em->getRepository('MinsalSiapsBundle:CtlSexo')->findOneById($request->get('id_sexo'));
        $idCreacionExpediente = $em->getRepository('MinsalSiapsBundle:CtlCreacionExpediente')->findOneById(1);
        $idusuarioreg		= $this->getUser();
        $fechahorareg		= new \DateTime();
        $fecha_nacimiento	= \DateTime::createFromFormat('d/m/Y', $request->get('fecha_nacimiento'));
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $idestablecimiento  = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneById($request->get('idestablecimiento'));

        $result = array('status' => false);

        $em->getConnection()->beginTransaction();
        try {
            $MntPacienteReferido = new MntPacienteReferido();
            $MntPacienteReferido->setPrimerNombre($request->get('primer_nombre'));
            $MntPacienteReferido->setSegundoNombre($request->get('segundo_nombre'));
            $MntPacienteReferido->setTercerNombre($request->get('tercer_nombre'));
            $MntPacienteReferido->setPrimerApellido($request->get('primer_apellido'));
            $MntPacienteReferido->setSegundoApellido($request->get('segundo_apellido'));
            $MntPacienteReferido->setApellidoCasada($request->get('apellido_casada'));
            $MntPacienteReferido->setFechaNacimiento($fecha_nacimiento);
            $MntPacienteReferido->setNombreResponsable($request->get('nombre_responsable'));
            $MntPacienteReferido->setNombreMadre($request->get('nombre_madre'));
            $MntPacienteReferido->setNombrePadre($request->get('nombre_padre'));
            $MntPacienteReferido->setIdSexo($sexo);
            $MntPacienteReferido->setIdUser($idusuarioreg);
            $MntPacienteReferido->setFechaRegistro($fechahorareg);
            $MntPacienteReferido->setAsegurado(false);
            $em->persist( $MntPacienteReferido );
            $em->flush();

            /* ingresar el expediente referido */
            $MntExpedienteReferido = new MntExpedienteReferido();
            $MntExpedienteReferido->setNumero($request->get('expediente'));
            $MntExpedienteReferido->setIdReferido($MntPacienteReferido);
            $MntExpedienteReferido->setIdEstablecimiento($CtlEstablecimiento); // establecimiento local configurado
            $MntExpedienteReferido->setIdEstablecimientoOrigen($idestablecimiento); //origen del expediente
            $MntExpedienteReferido->setFechaCreacion($fechahorareg);
            $MntExpedienteReferido->setHoraCreacion($fechahorareg);
            $MntExpedienteReferido->setIdCreacionExpediente($idCreacionExpediente);

            $em->persist( $MntExpedienteReferido );
            $em->flush();

            $idMntExpedienteReferido = $MntExpedienteReferido->getId();

            $em->getConnection()->commit();
            $result['status']       = true;
            $result['idPaciente']   = $MntPacienteReferido->getId();
            $result['idExpediente'] = $MntExpedienteReferido->getId();
        } catch (\Exception $e) {
            $em->getConnection()->rollback();

            $result['msjError'] = $e->__toString();
        }

        return new Response(json_encode($result));
    }




    public function createSolicitudEstudio($parameters) {
        try {
            foreach ($parameters['elements'] as $value) {
                $sql = "SELECT solicitudestudiosexternos(:idHistorialClinico, :idExpediente, :fechaSolicitud, :idUsuarioReg, :idExamen, :indicacion, :idTipoMuestra, :idOrigen, :idEstablecimiento, :lugar, :idDatoReferencia, :urgente, :impresiones, :accion, :idprogramas, :crearCitaServicio)";
                $stm = $this->container->get('database_connection')->prepare($sql);
                $stm->bindValue(':idHistorialClinico', $parameters['idHistorialClinico']);
                $stm->bindValue(':idExpediente', $parameters['idExpediente']);
                $stm->bindValue(':fechaSolicitud', $parameters['fechaSolicitud']);
                $stm->bindValue(':idUsuarioReg', strval($parameters['idUsuarioReg']));
                $stm->bindValue(':idExamen', $value['idExamen']);
                $stm->bindValue(':indicacion', $value['indicacion']);
                $stm->bindValue(':idTipoMuestra', $value['idTipoMuestra']);
                $stm->bindValue(':idOrigen', $value['idOrigen']);
                $stm->bindValue(':idEstablecimiento', $parameters['idEstablecimiento']);
                $stm->bindValue(':lugar', strval($parameters['idEstablecimientoLocal']));
                $stm->bindValue(':idDatoReferencia', $parameters['idDatoReferencia']);
                $stm->bindValue(':urgente', $value['urgente']);
                $stm->bindValue(':impresiones', $parameters['impresiones']);
                $stm->bindValue(':accion', 'create');
                $stm->bindValue(':idprogramas', $parameters['idprogramas']);
                $stm->bindValue(':crearCitaServicio', $parameters['crearCitaServicio']);
                $stm->execute();
                $result = $stm->fetchAll();
            }

            return $result[0]['solicitudestudiosexternos'];
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function updateSolicitudEstudio($parameters, $request) {
        $remove = array('solicitud' => array(), 'detalle' => array());
        $pruebaFVIH = false;

        foreach ($request->request as $key => $value) {
            if(substr($key,0,7) === 'delete_') {
                $explode = explode('_', $value);
                if (!in_array($explode[0], $remove['solicitud'])) {
                    $remove['solicitud'][] = $explode[0];
                }

                if (!in_array($explode[1], $remove['detalle'])) {
                    $remove['detalle'][] = $explode[1];

                    if($explode[2] === '125') {
                        $pruebaFVIH = true;
                    }
                }
            }
        }

        try {
            if($remove['detalle'] !== null && count($remove['detalle']) > 0) {
                $iddetalle = implode(',',$remove['detalle']);

                $sql = "DELETE FROM sec_detallesolicitudestudios WHERE id IN ($iddetalle)";

                $stm = $this->container->get('database_connection')->prepare($sql);
                $stm->execute();
                $result = $stm->fetchAll();

                foreach ($remove['solicitud'] as $idSolicitud) {
                    $sql = "SELECT COUNT(id) FROM sec_detallesolicitudestudios WHERE idsolicitudestudio = :idSolicitud";

                    $stm = $this->container->get('database_connection')->prepare($sql);
                    $stm->bindValue(':idSolicitud', $idSolicitud);
                    $stm->execute();
                    $result = $stm->fetchAll();

                    if(count($result) === 0) {
                        $sql = "DELETE FROM cit_citas_serviciodeapoyo WHERE id_solicitudestudios = :idSolicitud;
                                DELETE FROM sec_solicitudestudios WHERE id = :idSolicitud";

                        $stm = $this->container->get('database_connection')->prepare($sql);
                        $stm->bindValue(':idSolicitud', $idSolicitud);
                        $stm->execute();
                        $result = $stm->fetchAll();
                    }
                }
            }

            foreach ($parameters['elements'] as $value) {
                $sql = "SELECT solicitudestudiosexternos(:idHistorialClinico, :idExpediente, :fechaSolicitud, :idUsuarioReg, :idExamen, :indicacion, :idTipoMuestra, :idOrigen, :idEstablecimiento, :lugar, :idDatoReferencia, :urgente, :impresiones, :accion, :idprogramas, :crearCitaServicio)";
                $stm = $this->container->get('database_connection')->prepare($sql);
                $stm->bindValue(':idHistorialClinico', $parameters['idHistorialClinico']);
                $stm->bindValue(':idExpediente', $parameters['idExpediente']);
                $stm->bindValue(':fechaSolicitud', $parameters['fechaSolicitud']);
                $stm->bindValue(':idUsuarioReg', strval($parameters['idUsuarioReg']));
                $stm->bindValue(':idExamen', $value['idExamen']);
                $stm->bindValue(':indicacion', $value['indicacion']);
                $stm->bindValue(':idTipoMuestra', $value['idTipoMuestra']);
                $stm->bindValue(':idOrigen', $value['idOrigen']);
                $stm->bindValue(':idEstablecimiento', $parameters['idEstablecimiento']);
                $stm->bindValue(':lugar', strval($parameters['idEstablecimientoLocal']));
                $stm->bindValue(':idDatoReferencia', $parameters['idDatoReferencia']);
                $stm->bindValue(':urgente', $value['urgente']);
                $stm->bindValue(':impresiones', $parameters['impresiones']);
                $stm->bindValue(':accion', 'edit');
                $stm->bindValue(':idprogramas', $parameters['idprogramas']);
                $stm->bindValue(':crearCitaServicio', $parameters['crearCitaServicio']);
                $stm->execute();
                $result = $stm->fetchAll();
            }

            $data['status'] = $result[0]['solicitudestudiosexternos'];
            $data['pruebaFVIH'] = $pruebaFVIH;

            return $data;
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException|\Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @param mixed $id
     *
     * @return Response|RedirectResponse
     */
    public function deleteAction($id) {
        $session = $this->container->get('session');
        $request = $this->get('request');

        if($request->get('_token'.$session->get('_secured_token')) === $session->get('_value_token')) {
            $em = $this->getDoctrine()->getManager();

            $idHistorialClinico = $request->get($this->admin->getIdParameter());
            $idEstablecimiento  = $request->get('idEstablecimiento');
            $external           = $request->get('external');
            $modulo             = $request->get('modulo');
            $tipoPacPertenencia = $request->get('tipoPacPertenencia');
            $idEmpleado         = $request->get('idEmpleado');
            $idEspecialidad     = $request->get('idEspecialidad');
            $fechaSolicitud     = $request->get('fechaSolicitud');
            $idPaciente         = $request->get('idPaciente');
            $action             = 'create';

            $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
            $local = $CtlEstablecimiento->getId() === intval($idEstablecimiento) ? true : false;

            if($local) {
                $idDatoReferencia = NULL;
            } else {
                $idDatoReferencia = $idHistorialClinico;
                $idHistorialClinico = NULL;
            }

            $sql = "SELECT searchallsolicitudestudios(:idHistorialClinico, :lugar, :tipoSolicitud, :idDatoReferencia, :idEstablecimiento, ARRAY[6])";
            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->bindValue(':idHistorialClinico', $idHistorialClinico);
            $stm->bindValue(':lugar', $CtlEstablecimiento->getId());
            $stm->bindValue(':tipoSolicitud', '1');
            $stm->bindValue(':idDatoReferencia', $idDatoReferencia);
            $stm->bindValue(':idEstablecimiento', $idEstablecimiento);
            $stm->execute();
            $result = $stm->fetchAll();

            $idSolicitudUrgente = array();
            foreach ($result as $key => $value) {
                $idSolicitudUrgente[] = $value['searchallsolicitudestudios'];
            }

            if(count($idSolicitudUrgente) > 0) {
                $idSolicitudUrgente = implode(',',$idSolicitudUrgente);
            } else {
                $idSolicitudUrgente = '0';
            }

            $sql = "SELECT searchallsolicitudestudios(:idHistorialClinico, :lugar, :tipoSolicitud, :idDatoReferencia, :idEstablecimiento, ARRAY[6])";
            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->bindValue(':idHistorialClinico', $idHistorialClinico);
            $stm->bindValue(':lugar', $CtlEstablecimiento->getId());
            $stm->bindValue(':tipoSolicitud', '2');
            $stm->bindValue(':idDatoReferencia', $idDatoReferencia);
            $stm->bindValue(':idEstablecimiento', $idEstablecimiento);
            $stm->execute();
            $result = $stm->fetchAll();

            $idSolicitudNormal = array();
            foreach ($result as $key => $value) {
                $idSolicitudNormal[] = $value['searchallsolicitudestudios'];
            }

            if(count($idSolicitudNormal) > 0) {
                $idSolicitudNormal = implode(',',$idSolicitudNormal);
            } else {
                $idSolicitudNormal = '0';
            }

            $sql = "SELECT id
                    FROM lab_recepcionmuestra
                    WHERE idsolicitudestudio IN ($idSolicitudUrgente,$idSolicitudNormal)";

            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

            if(count($result) <= 0) {
                $em->getConnection()->beginTransaction();
                try {

                    $solicitudFvih = $this->getFvihAsociada($idHistorialClinico);

                    if( $solicitudFvih ){
                        //var_dump('Eliminado '.count($solicitudFvih).' Solicitudes FVIH asociadas...<br/>');
                        $this->deleteSolicitudFvih( $solicitudFvih, $idPaciente);
                    }

                    $sql = "SELECT completeforcedeletesolicitudestudio(:idHistorialClinico, :lugar, :tipoSolicitud, :idDatoReferencia, :idEstablecimiento)";

                    $stm = $this->container->get('database_connection')->prepare($sql);
                    $stm->bindValue(':idHistorialClinico', $idHistorialClinico);
                    $stm->bindValue(':lugar', $CtlEstablecimiento->getId());
                    $stm->bindValue(':tipoSolicitud', '1');
                    $stm->bindValue(':idDatoReferencia', $idDatoReferencia);
                    $stm->bindValue(':idEstablecimiento', $idEstablecimiento);
                    $stm->execute();
                    $result = $stm->fetchAll();

                    $var1 = $result[0]['completeforcedeletesolicitudestudio'];

                    $sql = "SELECT completeforcedeletesolicitudestudio(:idHistorialClinico, :lugar, :tipoSolicitud, :idDatoReferencia, :idEstablecimiento)";

                    $stm = $this->container->get('database_connection')->prepare($sql);
                    $stm->bindValue(':idHistorialClinico', $idHistorialClinico);
                    $stm->bindValue(':lugar', $CtlEstablecimiento->getId());
                    $stm->bindValue(':tipoSolicitud', '2');
                    $stm->bindValue(':idDatoReferencia', $idDatoReferencia);
                    $stm->bindValue(':idEstablecimiento', $idEstablecimiento);
                    $stm->execute();
                    $result = $stm->fetchAll();

                    $var2 = $result[0]['completeforcedeletesolicitudestudio'];

                    if ($var1 === false && $var2 === false) {
                        $msjtype    = 'sonata_flash_error';
                        $msjcontent = 'Error al eliminar la solicitud de estudio. Por favor intente nuevamente, si el problema persiste contacte con el administrador';
                        $action     = 'edit';
                    } else {

                        $sql = "SELECT deleteexamenformularioconsulta(:idHistorialClinico, :idprogramas)";

                        $stm = $this->container->get('database_connection')->prepare($sql);
                        $stm->bindValue(':idHistorialClinico', $idHistorialClinico);
                        $stm->bindValue(':idprogramas', $this->idprogramas);
                        $stm->execute();
                        $result = $stm->fetchAll();

                        $var3 = $result[0]['deleteexamenformularioconsulta'];

                        if($var3) {
                            $msjtype    = 'sonata_flash_success';
                            $msjcontent = 'Solicitud eliminada exitosamente';
                        } else {
                            $msjtype    = 'sonata_flash_error';
                            $msjcontent = 'Error al eliminar el formulario por consulta de la solicitud de estudio. Por favor intente nuevamente, si el problema persiste contacte con el administrador';
                            $action     = 'edit';
                        }
                    }

                    $this->addFlash($msjtype, $msjcontent);

                    $em->getConnection()->commit();
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $action = 'edit';

                    $this->addFlash('sonata_flash_error', $e);
                    throw $e;
                }
            } else {
                $this->addFlash('sonata_flash_error', 'Error... La solicitud de estudio de laboratorio <b>no puede ser eliminada, debido a que actualmente se encuentra en proceso dentro del Laboratorio.</b>');
            }

            $urlParameters = array('_external' => $external, '_modulo' => $modulo, 'tipoPacPertenencia' => $tipoPacPertenencia, 'idEmpleado' => $idEmpleado, 'idEspecialidad' => $idEspecialidad, 'idHistorialClinico' => ( $local ? $idHistorialClinico : $idDatoReferencia), 'fechaSolicitud' => $fechaSolicitud, 'action' => $action, 'idEstablecimiento' => $idEstablecimiento);
            return new RedirectResponse($this->admin->generateUrl('assign_exam', $urlParameters));
        } else {
            throw new AccessDeniedException();
        }
    }

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
    public function showAction($id = null)
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());

        if (false === $this->admin->isGranted('VIEW')) {
            throw new AccessDeniedException();
        }

        $request = $this->get('request');
        $external = $request->get('external') === 'true'? $request->get('external') : 'false';

        if($request->get('idSolicitudEstudio') !== null) {
            $object = $this->admin->getObject($id);
            if($object->getIdHistorialClinico() !== null) {
                $id = $object->getIdHistorialClinico()->getId();
                $idDatoReferencia = '0';
            } else {
                $id = '0';
                $idDatoReferencia = (string) $object->getIdDatoReferencia()->getId();
            }
        } else {
            $idDatoReferencia = '0';
        }

        $em = $this->getDoctrine()->getManager();
        $idEstablecimiento = $request->get('idEstablecimiento');

        $user = $this->getUser();

        $CtlEstablecimientoLocal = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));

        $ExamnResult = $this->container->get('lab_examnresult');

        $datosGenerales = $ExamnResult->getDatosGenerales($id, $idDatoReferencia, $idEstablecimiento);
        $resultados     = $ExamnResult->getExamnResult($id, $idDatoReferencia, $idEstablecimiento);

        if (count($datosGenerales) === 0) {
            throw new NotFoundHttpException(sprintf('unable to find the object with idHistorialClinico : %s and idDatoReferencia: %s', $id, $idDatoReferencia));
        }

        $params['external']       = $external;
        $params['datosGenerales'] = $datosGenerales;
        $params['result']         = $resultados;

        return $this->render($this->admin->getTemplate('show'), array(
            'action'   => 'show',
            'params' => $params,
        ));
    }

    /**
     * return the Response object associated to the list action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @return Response
     */
    public function imprimirSolicitudestudiosAction($idHistorialClinico){
        if (false === $this->admin->isGranted('LIST')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $request     = $this->get('request');
        $em          = $this->getDoctrine()->getManager();
        $singlePrint = $this->container->hasParameter('solicitud_lab_print_single') ? $this->container->getParameter('solicitud_lab_print_single') : true;

        //ENCABEZADO PACIENTE
        $historialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($idHistorialClinico);
        $conn             = $em->getConnection();
        $calcular         = new Funciones();
        $expediente       = $historialClinico->getIdExpediente();
        $edad             = $calcular->calcularEdad($conn, $expediente->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $expediente->getIdPaciente()->getHoraNacimiento() ? $expediente->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );

        //SOLICITUD ESTUDIOS
        $user                    = $this->getUser();
        $CtlEstablecimientoLocal = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $idEstablecimiento       = $request->get('idEstablecimiento') ? $request->get('idEstablecimiento') : $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimientoLocal->getId();


        if (intval($idEstablecimiento) !== $CtlEstablecimientoLocal->getId()) {
             $idDatoReferencia = $idHistorialClinico;
        } else {
             $idDatoReferencia = null;
        }

        $ExamnResult = $this->container->get('lab_examnresult');

        $datosGenerales   = $ExamnResult->getDatosGenerales($idHistorialClinico, $idDatoReferencia, $idEstablecimiento);
        if($singlePrint) {
            $solicitudEstudio = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->obtenerSolicitudEstudios($idHistorialClinico, $idDatoReferencia, $idEstablecimiento);
        } else {
            $solicitudEstudio = $ExamnResult->getExamenSolicitudPorArea($idHistorialClinico, $idDatoReferencia, $idEstablecimiento);
        }
        $params = array('solicitudEstudio' => array( 'laboratorio' => $solicitudEstudio ), 'datosGenerales' => $datosGenerales, 'singlePrint' => $singlePrint);

        $impresion = $this->renderView($this->admin->getTemplate('imprimir_solicitudestudios'),
            array(  'params' => $params,
                    'impresion' => true,
                    'expediente'=>$expediente,
                    'edad'=>$edad,
                    'object'=>$historialClinico)
        );

        return new Response(
            $this->get('knp_snappy.pdf')
                ->getOutputFromHtml($impresion,
                    array(
                        'enable-javascript' => true,
                        'javascript-delay' => 500,
                        'page-size'=>'Letter',
                        'margin-top'=>'10',
                        'margin-right'=>'10',
                        'margin-left'=>'10',
                        'margin-bottom'=>'10')),
                    200,
                    array('Content-Type' => 'application/pdf',
                          'Content-Disposition'  => 'inline')
        );
    }

    public function getFvihAsociada($idHistorialClinico){
        $em = $this->getDoctrine()->getManager();
        $solicitudFvih = $em->getRepository('MinsalSeguimientoBundle:TarSolicitudFvih')->findBy(array('idHistorialClinico' => $idHistorialClinico));
        return $solicitudFvih;

    }

    public function deleteSolicitudFvih($solicitudFvih, $idPaciente){
        $em          = $this->getDoctrine()->getManager();
        $connection  = $this->container->get('database_connection');
        $solicitud   = $solicitudFvih;
        $sumeveIdsToDelete = array();
        $localIdsToDelete = array();

        foreach( $solicitudFvih as $solicitud){
                //var_dump('Eliminado solicitud: '.$solicitud->getId().' ...<br/>');
            if( $solicitud->getIdGrupoEstadoDetalle()->getId() == 1 ){

                // Se cambio a ON DELETE CASCADE
                // $sqlStatement = "DELETE FROM tar_sol_factores WHERE id_solicitud_fvih = :idSol";
                // $stm = $connection->prepare($sqlStatement);
                // $stm->bindValue(':idSol', $solicitud->getId());
                // $stm->execute();
                //
                // $sqlStatement = "DELETE FROM tar_datos_embarazada WHERE id_solicitud = :idSol";
                // $stm = $connection->prepare($sqlStatement);
                // $stm->bindValue(':idSol', $solicitud->getId());
                // $stm->execute();

                $em->remove( $solicitud );
                $em->flush();
            }
            elseif( $solicitud->getIdGrupoEstadoDetalle()->getId() == 2 ) {
                $sumeveIdsToDelete[] = $solicitud->getIdSolicitudSumeve();
                $localIdsToDelete[]  = $solicitud;
            }
        }

        if( count( $sumeveIdsToDelete ) > 0 ){
            $ids = json_encode( $sumeveIdsToDelete );
            $result = null;
            $pacienteTar = $em->getRepository('MinsalSeguimientoBundle:TarPaciente')->findOneBy( array( 'idPaciente' => $idPaciente ) );
            $idpSumeve   = $pacienteTar ? ( $pacienteTar->getIdSumeve() ? $pacienteTar->getIdSumeve() : 'null' ) : 'null';
                //var_dump('<br/>Solicitando Eliminacion en Sumeve de: '.$ids.' ...<br/>');
            $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<solicitud>
<ids>$ids</ids>
<idp>$idpSumeve</idp>
</solicitud>
XML;

            try{
                $cliente = new Cliente();
                $cliente->setContainer( $this->container );
                $labase  = $this->container->getParameter('global_host');
                    //var_dump('Se establecera conexion a la base global: '.$labase.' ...<br/>');
                    //var_dump('Llamando al metodo <b>cliente->eliminarSolicitudAction</b> ...<br/>');
                $result = $cliente->eliminarSolicitudAction($labase, $xml);
                    //var_dump($result);
            } catch(\Exception $ex) {
                    //var_dump(''.$ex);
                $result = null;
            }

            if( $result ){
                if( $result['status'] ){
                        //var_dump('Realizado Correctamente...<br/>');
                    $resultWS =  json_decode( $result['result'] );
                    foreach ($localIdsToDelete as $solicitud){
                        if( in_array( $solicitud->getIdSolicitudSumeve() , $resultWS->deletedIds )  ){
                                //var_dump('Confirmando Eliminacion Local de Solicitud: '.$solicitud->getId().' ...<br/>');
                            $em->remove( $solicitud );
                            $em->flush();
                        }
                        else{
                                //var_dump('Cambiando Estado Local de Solicitud: '.$solicitud->getId().' ...<br/>');
                            $solicitud->setIdGrupoEstadoDetalle( $em->getRepository('MinsalSeguimientoBundle:CtlGrupoEstadoDetalle')->findOneById( 3 ));
                            $em->persist( $solicitud );
                            $em->flush();
                        }
                    }

                    if( $resultWS->deletedIdp ){
                        //var_dump('Confirmando Eliminacion de Paciente TAR --'.$resultWS->deletedIdp.'--'.$pacienteTar->getIdSumeve().'-- ...<br/>');
                        $em->remove( $pacienteTar );
                        $em->flush();
                    }
                    elseif( $idpSumeve == 'null' ){
                        $em->remove( $pacienteTar );
                        $em->flush();
                    }
                }
                else{
                    //var_dump('Error...<br/>');
                    foreach ( $localIdsToDelete as $solicitud ){
                        $solicitud->setIdGrupoEstadoDetalle( $em->getRepository('MinsalSeguimientoBundle:CtlGrupoEstadoDetalle')->findOneById( 3 ));
                        $em->persist( $solicitud );
                        $em->flush();
                    }
                }
            }
            else{
                foreach ($localIdsToDelete as $solicitud){
                    $solicitud->setIdGrupoEstadoDetalle( $em->getRepository('MinsalSeguimientoBundle:CtlGrupoEstadoDetalle')->findOneById( 3 ));
                    $em->persist( $solicitud );
                    $em->flush();
                }
            }
        }
        return $sumeveIdsToDelete;
    }
}
