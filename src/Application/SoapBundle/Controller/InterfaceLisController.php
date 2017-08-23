<?php
namespace Application\SoapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL as DBAL;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Minsal\LaboratorioBundle\Entity\LabResultados as LabResultados;
use Minsal\LaboratorioBundle\Entity\LabDetalleresultado;
use Minsal\LaboratorioBundle\Entity\LabResultadosportarjeta;
use Minsal\SeguimientoBundle\Entity\SecDetallesolicitudestudios;

class InterfaceLisController extends Controller {
    protected $requestScheme;
    protected $codeEnvironment;
    protected $environment;
    protected $domain;
    protected $host;
    protected $eusuario;
    protected $epassword;
    private   $method = null;

    public function setContainer(ContainerInterface $container = null) {
        parent::setContainer($container);

        $this->method          = $this->container->getParameter('ws_method');
        $this->requestScheme   = $this->container->get('request')->server->get('REQUEST_SCHEME');
        $this->codeEnvironment = $this->container->getParameter("kernel.environment");
        $this->eusuario  = $this->container->hasParameter('user_automatizado') ? $this->container->getParameter('user_automatizado') : null;
        $this->epassword = $this->container->hasParameter('password_automatizado') ? $this->container->getParameter('password_automatizado') : null;
        if($this->codeEnvironment === 'dev') {
            $this->environment = '/app_dev.php';
        } else {
            $this->environment = '/app.php';
        }
        $this->domain = $this->host = $this->container->get('request')->server->get('HTTP_HOST');
    }


    /**
     * @Route("/ws_acceptmessage", name="ws_acceptmessage", options={"expose"=true})
     * @Method("GET")
     */
    public function ws_acceptMessageAction() {
        // instanciar parametros para la autenticacion
        $array = array('AppUser'=>$this->eusuario,'Password'=>$this->epassword);
        $json_array = json_encode($array);
        $array_param = array('json_array' => $json_array);

        //define la ejecucion ws
        $soapClient = $this->container->get('soapClient');
        $location   = $this->requestScheme."://".$this->host.$this->environment."/soap/interfaceliswebservice";
        $soapClient->setUrl($location."?wsdl");

        $result = array('success' => '', 'errorMsg' => '');

        //autenticando ws
        try {
            $soapClient->setLocation($location);
            $soapClient->createSoapClient();
            $data = $soapClient->soapCall('checkin', $array_param); //enviar parametros en json y retornar json
        } catch(\Exception $ex) { //si hubiere algun error a la hora de comunicarse con WS
            $result['success'] = false;
            $result['errorMsg'] = $ex->getMessage();
            $data = array('token'=>false);
            $data = json_encode($data);
        }


        $data = json_decode($data, true);
        $array = array('token'=>$data['token'], 'Mensaje'=>'mensajesmesnsaje');

        $json_array = json_encode($array);
        $array_param = array('json_array' => $json_array);

        //invocando ws
        try {
            $soapClient->setLocation($location);
            $soapClient->createSoapClient();
            $data = $soapClient->soapCall('acceptMessage', $array_param); //enviar parametros en json y retornar json
        } catch(\Exception $ex) { //si hubiere algun error a la hora de comunicarse con WS
            $result['success'] = false;
            $result['errorMsg'] = $ex->getMessage();
        }

        return new Response($data);
    }

     /**
     * @Route("/ws_checkin", name="ws_checkin", options={"expose"=true})
     * @Method("GET")
     */
    public function checkinAction() {
        // Para consumir API seguria de SIAP
        $array = array('AppUser'=>$this->eusuario,'Password'=>$this->epassword);
        $json_array = json_encode($array);
        $array_param = array('json_array' => $json_array);
        $result = array('success' => '', 'errorMsg' => '');

        //define la ejecucion ws
        $soapClient = $this->container->get('soapClient');
        $location   = $this->requestScheme."://".$this->host.$this->environment."/soap/interfaceliswebservice";
        $soapClient->setUrl($location."?wsdl");

        //invocando ws
        try {
            $soapClient->setLocation($location);
            $soapClient->createSoapClient();
            $result = $soapClient->soapCall('checkin', $array_param); //enviar parametros en json y retornar json
        } catch(\Exception $ex) { //si hubiere algÃºn error a la hora de comunicarse con WS
            $result['success'] = false;
            $result['errorMsg'] = $ex->getMessage();
            $result = json_encode($result);
        }

        $result_array = json_decode($result, TRUE);
        $token = $result_array['token'];

        $array = array('token'=>$token);
        $json_array = json_encode($array);
        $array_param = array('json_array' => $json_array);

        try {
            $soapClient->setLocation($location);
            $soapClient->createSoapClient();
            $result = $soapClient->soapCall('checkout', $array_param); //enviar parametros
        } catch(\Exception $ex) { //si hubiere algÃºn error a la hora de comunicarse con WS
            var_dump($ex);
            var_dump($result);exit();
            $result['success'] = false;
            $result['errorMsg'] = $ex->getMessage();
            $result = json_encode($result);
        }

        return new Response($result);
    }


     /**
     * @Route("/api/laboratorio/generarHl7/{id}/create", name="api_laboratorio_generarHl7_create", options={"expose"=true})
     * @Method("GET")
     */

    /*
     * metodo que se invoca para generar Hl7 por REST
     */
    public function apiLaboratorioGenerarHl7CreateAction($id = null) {
        $request = $this->get('request');

        $array = array('token'=>$request->get('token'), 'idSolicitud'=>$id);

        $json_array = json_encode($array);
        $array_param = array('json_array' => $json_array);

        $InterfaceLisWebService = $this->container->get('interfaceliswebservice');
        var_dump($InterfaceLisWebService->generarMensajeSolicitud($json_array)); exit();
        //invocando ws
        $soapClient = $this->container->get('soapClient');
        $location   = $this->requestScheme."://".$this->host.$this->environment."/soap/interfaceliswebservice";
        $soapClient->setUrl($location."?wsdl");

        $result = array('success' => '', 'errorMsg' => '');
        try {
            $soapClient->setLocation($location);
            $soapClient->createSoapClient();
            $mensaje = $soapClient->soapCall('generarMensajeSolicitud', $array_param); //enviar parametros en json y retornar json
            $result['Mensaje'] = $mensaje;
        } catch(\Exception $ex) { //si hubiere algun error a la hora de comunicarse con WS
            $result['success'] = false;
            $result['errorMsg'] = $ex->__toString();
            $result['Mensaje'] = "";
        }

        if ($result['Mensaje'] = "" || $result['errorMsg'] != ""){  // el mensaje fue generado y no hay mensaje de error
           return new Response('No se pudo codificar la solicitud'.$result['errorMsg']);
       } else {
           return new Response('OK');
       }
    }


    /**
     * @Route("/api/laboratorio/resultados/equipoautomatizado/save", name="api_laboratorio_resultados_equipoautomatizado_save", options={"expose"=true})
     * @Method("GET")
     */
    public function apiLaboratorioResultadosEquipoAutomatizadoSaveAction() {
        $request = $this->getRequest();

        $token = $request->get('token');
        $authenticator = $this->container->get('api.authenticator');

        $result = array( 'estado' => false, 'mensaje' => '' );

        try {
            $isGranted = $authenticator->isGranted($token, 'ROLE_API_LABORATORIO_ENVIAR_SOLICITUD_EQUIPOAUTOMATIZADO');
        } catch (\Exception $e) {
            if($this->codeEnvironment === 'dev') {
                throw $e;
            } else {
                $result['mensaje'] = 'Error al procesar el envio';

                return $result;
            }
        }

        if( $isGranted ) {
            $em = $this->container->get('doctrine')->getManager();

            /* seleccionar los registros no procesados y no trasmitidos */
            $sql = "select * from lab_control_interface WHERE via=2 and fecha_proceso is null and estado = 1";
            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();  //convertir el dset en array

            $i=0;
            foreach($result as $r) // Revisando los registros pendientes de procesar
            {
                // decodificar el mensaje Hl7
                $hl7Service = $this->container->get('hl7.service');
                $result_json = $hl7Service->decodeHl7ObservationMsg($r['mensaje']);

                /*
                 * obtener arreglo a partir del json devuelto
                 */
                $result_array = json_decode($result_json, true);

                /*
                 * declarar los objetos deacuerdo a los valores encontrados al
                 * momento de la decodificacion
                 */
                $ControlInterface = $em->getRepository('MinsalLaboratorioBundle:LabControlInterface')->find($r['id']); //para poder modificarla
                $detallesolicitud = $em->getRepository('MinsalSeguimientoBundle:SecDetallesolicitudestudios')->findOneById($result_array['iddetallesolicitud']);

                /*
                 * saltar a la siguiente trama si el detalle solicitud no existe
                 */

                if ($detallesolicitud)
                {
                    $solicitud        = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->findOneById($detallesolicitud->getIdsolicitudestudio());
                    $recepcionmuestra = $em->getRepository('MinsalLaboratorioBundle:LabRecepcionmuestra')->findOneBy(array('idsolicitudestudio' => $detallesolicitud->getIdsolicitudestudio()));
                    $empleado         = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneByIdempleado(array('idempleado' => $result_array['codigo_empleado']));
                    $user             = $this->getUser();
                    $now              = new \DateTime();
                    $fechaResultado   = \DateTime::createFromFormat('YmdHi', $result_array['fecha_resultado']);
                    $estadoResultadoCompleto = $em->getRepository('MinsalLaboratorioBundle:CtlEstadoServicioDiagnostico')->findOneById(7);

                    /*
                     * comenzar el guardado de los resultados obtenidos
                     */
                    $em->getConnection()->beginTransaction();

                    try {
                        /* guardar los resultados en lab_resultados */
                        $LabResultados = new LabResultados();

                        $LabResultados->setIdsolicitudestudio($solicitud);
                        $LabResultados->setResultado($result_array['resultado']);
                        $LabResultados->setIddetallesolicitud($detallesolicitud);
                        $LabResultados->setIdrecepcionmuestra($recepcionmuestra);
                        $LabResultados->setIdestablecimiento($solicitud->getIdEstablecimiento());
                        $LabResultados->setIdusuarioreg($user);
                        $LabResultados->setFechahorareg($now);
                        $LabResultados->setIdexamen($detallesolicitud->getIdConfExamenEstab());
                        $LabResultados->setFechaResultado($fechaResultado);
                        $LabResultados->setIdempleado($empleado);

                        $em->persist($LabResultados);
                        $em->flush();

                        $qb = $em->createQueryBuilder();

                        $result = $qb->select('t01') // consulta que devuelve el codigo del ANTIBIOGRAMA con el ID configurado en el establecimiento
                                    ->from('MinsalLaboratorioBundle:LabConfExamenEstab', 't01')
                                    ->innerJoin('t01.idexamen','t02')
                                    ->innerJoin('t02.idExamenServicioDiagnostico','t03')
                                    ->where("t03.idestandar = 'M24'")
                                    ->andWhere("t01.condicion = 'H'")
                                    ->getQuery()
                                    ->getResult();

                        if( count($result) > 0 ) { //revision de antibiograma ya configurado para obtener codigo
                            $antibiograma = $result[0];
                            /*
                             * decodificar la cadena y guardarla en las tablas respetivas
                             */
                            try {
                                foreach ($result_array['lab_detalleresultado'] as $detalleresultado) {
                                    // var_dump('--------------------- Detalle Resultado ---------------------');
                                    // var_dump($detalleresultado);
                                    /* Generando el nuevo id del SecDetallesolicitudestudios para el nuevo examen de antibiograma */
                                    $detallesolicitudAntiBio = new SecDetallesolicitudestudios();

                                    $detallesolicitudAntiBio->setIdsolicitudestudio($solicitud);
                                    $detallesolicitudAntiBio->setIndicacion($detallesolicitud->getIndicacion());
                                    $detallesolicitudAntiBio->setIdtipomuestra($detallesolicitud->getIdtipomuestra());
                                    $detallesolicitudAntiBio->setIdorigenmuestra($detallesolicitud->getIdorigenmuestra());
                                    $detallesolicitudAntiBio->setObservacion($detallesolicitud->getObservacion());
                                    $detallesolicitudAntiBio->setIdexamen($antibiograma->getIdexamen());
                                    $detallesolicitudAntiBio->setIdestablecimiento($detallesolicitud->getIdestablecimiento());
                                    $detallesolicitudAntiBio->setIdestablecimientoexterno($detallesolicitud->getIdestablecimientoexterno());
                                    $detallesolicitudAntiBio->setIdempleado($detallesolicitud->getIdempleado());
                                    $detallesolicitudAntiBio->setIdusuarioreg($user);
                                    $detallesolicitudAntiBio->setFechahorareg($now);
                                    $detallesolicitudAntiBio->setEstadodetalle($estadoResultadoCompleto);
                                    // $detallesolicitudAntiBio->setIdConfExamenEstab($detallesolicitud->getIdConfExamenEstab());
                                    $detallesolicitudAntiBio->setIdConfExamenEstab($antibiograma);

                                    $em->persist($detallesolicitudAntiBio);
                                    $em->flush();

                                    /*  Guardando segunda tupla de LabResultados */
                                    $resultadoAntiBiograma = new LabResultados();

                                    $resultadoAntiBiograma->setIdsolicitudestudio($solicitud);
                                    $resultadoAntiBiograma->setIddetallesolicitud($detallesolicitudAntiBio);
                                    $resultadoAntiBiograma->setIdrecepcionmuestra($recepcionmuestra);
                                    $resultadoAntiBiograma->setIdestablecimiento($solicitud->getIdEstablecimiento());
                                    $resultadoAntiBiograma->setIdusuarioreg($user);
                                    $resultadoAntiBiograma->setFechahorareg($now);
                                    $resultadoAntiBiograma->setIdexamen($detallesolicitudAntiBio->getIdConfExamenEstab());
                                    $resultadoAntiBiograma->setFechaResultado($fechaResultado);
                                    $resultadoAntiBiograma->setIdempleado($empleado);
                                    $resultadoAntiBiograma->setIdResultadoPadre($LabResultados->getId());

                                    $em->persist($resultadoAntiBiograma);
                                    $em->flush();

                                    // buscar la bacteria
                                    if ($detalleresultado['id_microorganismo'] != $detalleresultado['codigo_microorganismo']){ // la bacteria esta en catalogo
                                        $bacteria = $em->getRepository('MinsalLaboratorioBundle:LabBacterias')->findOneById($detalleresultado['id_microorganismo']);
                                    } else { //el microorganismo es nuevo y hay que agergarlo en a tabla LabBacterias
                                        //enviar un mensaje al correo electronico
                                        // de nuevo microorganismo encontrado para agregar a SIAP
                                        var_dump('Bacteria no encontrada, La trama no se proceso');
                                    }

                                    // buscar la tarjeta
                                    // GP = Gram positivo identificacion
                                    // GN = Gram Negativo identificacion
                                    // AST-GP = Gram Positivo Sensibilidad
                                    // AST-GN = Gram Negativo Sensibilidad
                                    /* XXX = Metodologia manual */



                                    if ($detalleresultado['codigo_tarjeta'] == 'GP' || $detalleresultado['codigo_tarjeta'] == 'AST-GP'){
                                        $tarjeta  = $em->getRepository('MinsalLaboratorioBundle:LabTarjetasvitek')->findOneById(1);
                                    } elseif ($detalleresultado['codigo_tarjeta'] == 'GN' || $detalleresultado['codigo_tarjeta'] == 'AST-GN'){
                                        $tarjeta  = $em->getRepository('MinsalLaboratorioBundle:LabTarjetasvitek')->findOneById(2);
                                    } else {
                                        $tarjeta  = $em->getRepository('MinsalLaboratorioBundle:LabTarjetasvitek')->findOneById(3);
                                    }

                                    /*
                                     * guardar en lab_detalleresultados
                                     * aca se guarda la cantidad de colonias y bacteria encontrada
                                     * como llave foranea ID de lab_resultados
                                     */
                                    $LabDetalleresultado = new LabDetalleresultado();
                                    $LabDetalleresultado->setIdresultado($resultadoAntiBiograma);
                                    $LabDetalleresultado->setIdbacteria($bacteria);
                                    $LabDetalleresultado->setIdtarjeta($tarjeta);
                                    $LabDetalleresultado->setCantidad($result_array['conteo_colonias']);
                                    $LabDetalleresultado->setIdestablecimiento($solicitud->getIdEstablecimiento());
                                    $LabDetalleresultado->setBReferido(false);

                                    $em->persist($LabDetalleresultado);
                                    $em->flush();

                                    /*
                                     * guardar lab_resultadosportarjeta donde se guarda el antibiograma
                                     * como llave foranea ID de lab_detalleresultado.
                                     */
                                    foreach ($detalleresultado['lab_resultadoportarjeta'] as $resultadoportarjeta)
                                    {
                                        // var_dump('--------------------- Resultado por Tarjeta ---------------------');
                                        // var_dump($resultadoportarjeta);
                                        // buscar la bacteria
                                        if ($resultadoportarjeta['id_antibiotico'] != $resultadoportarjeta['codigo_antibiotico']){
                                            $antibiotico = $em->getRepository('MinsalLaboratorioBundle:LabAntibioticos')->findOneById($resultadoportarjeta['id_antibiotico']);
                                        } else { //el microorganismo es nuevo y hay que agergarlo en a tabla LabBacterias
                                            $antibiotico = $em->getRepository('MinsalLaboratorioBundle:LabAntibioticos')->findOneById(29);
                                        }

                                        $LabResultadosportarjeta = new LabResultadosportarjeta();

                                        //interpretacion del resultado en texto enviado por el equipo
                                        if ($resultadoportarjeta['interpretacion'] == 'R'){
                                            $interpretacion = 'Resistente';
                                            $id_posibleresultado = 10;
                                            $posibleresultado = $em->getRepository('MinsalLaboratorioBundle:LabPosibleResultado')->find($id_posibleresultado);
                                            $LabResultadosportarjeta->setIdPosibleResultado($posibleresultado);
                                        } elseif ($resultadoportarjeta['interpretacion'] == 'I'){
                                            $interpretacion = 'Intermedio';
                                            $id_posibleresultado = 11;
                                            $posibleresultado = $em->getRepository('MinsalLaboratorioBundle:LabPosibleResultado')->findOneById($id_posibleresultado);
                                            $LabResultadosportarjeta->setIdPosibleResultado($posibleresultado);
                                        } elseif ($resultadoportarjeta['interpretacion'] == 'S'){
                                            $interpretacion = 'Sensible';
                                            $id_posibleresultado = 12;
                                            $posibleresultado = $em->getRepository('MinsalLaboratorioBundle:LabPosibleResultado')->findOneById($id_posibleresultado);
                                            $LabResultadosportarjeta->setIdPosibleResultado($posibleresultado);
                                        } else {
                                            $interpretacion = $resultadoportarjeta['interpretacion'];
                                        }

                                        $LabResultadosportarjeta->setIddetalleresultado($LabDetalleresultado);
                                        $LabResultadosportarjeta->setIdantibiotico($antibiotico);
                                        $LabResultadosportarjeta->setResultado($resultadoportarjeta['resultado']);
                                        $LabResultadosportarjeta->setValor($interpretacion);
                                        $LabResultadosportarjeta->setIdestablecimiento($solicitud->getIdEstablecimiento());

                                        $em->persist($LabResultadosportarjeta);
                                        $em->flush();
                                    }
                                    /*
                                     * guardar los resultados segun SEPS lab_resultadosmetadologia
                                     * como llave foranea ID lab_detalleresultado
                                     */
                                }
                            } catch(\Exception $e) {
                                throw $e;
                            }
                        } else {
                            // hacer algo
                        }
                        // cambiar el estado del detalle solicitud
                        $detallesolicitud->setEstadodetalle($estadoResultadoCompleto);
                        $em->persist($detallesolicitud);
                        $em->flush();

                        // cambiar el estado del lab_control_interface
                        $ControlInterface->setEstado(2); //procesado
                        $ControlInterface->setFechaProceso(new \Datetime());
                        $ControlInterface->setIdSolicitudestudios($solicitud->getId());
                        $em->persist($ControlInterface);
                        $em->flush();

                        $em->getConnection()->commit();

                    } catch (\Exception $e) {
                        $em->getConnection()->rollback();
                        // cambiar el estado del lab_control_interface
                        $ControlInterface->setEstado(3); //error no encontro bacteria en SIAP
                        $ControlInterface->setMensajeExcepcion($e); //error no encontro bacteria en SIAP
                        $em->persist($ControlInterface);
                        $em->flush();

                        return new Response ( $e );
                    }

                    $i++;  // numero de detallesolicitud procesados
                }  // final de la evaluacion si existe detallesolicitud
                else {
                    $ControlInterface->setEstado(3); //error no encontro bacteria en SIAP
                    $ControlInterface->setMensajeExcepcion('No hay id detalle asociado'); //error no encontro bacteria en SIAP
                    $em->persist($ControlInterface);
                    $em->flush();

                    $result['mensaje'] = "No hay id detalle asociado";
                    return new Response (json_encode($result));
                }
            } // final de for each para los registros penientes a guardar

            $result['estado']  = true;
            $result['mensaje'] = $i.' Detalles de solicitud han sido procesados';
        } // final de verificacion de logeo
        else {
            $result['mensaje'] = "Error Acceso no autorizado.";
        } //fin de if else para verificacion de logueo

        return new Response( json_encode( $result ) );
    }


    /**
     * @Route("/ws_codificar_solicitud_pendiente", name="ws_codificar_solicitudes_pendiente", options={"expose"=true})
     * @Method("GET")
     */
    public function codificarSolicitudPendienteAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $array = array('AppUser'=>$this->eusuario,'Password'=>$this->epassword);;
        $json_array = json_encode($array);
        $array_param = array('json_array' => $json_array);

        //define la ejecucion ws
        $soapClient = $this->container->get('soapClient');
        $location   = $this->requestScheme."://".$this->host.$this->environment."/soap/interfaceliswebservice";
        $soapClient->setUrl($location."?wsdl");

        $result = array('success' => '', 'errorMsg' => '');

        //autenticando ws
        try {
           $soapClient->setLocation($location);
           $soapClient->createSoapClient();
           $data = $soapClient->soapCall('checkin', $array_param); //enviar parametros en json y retornar json
        } catch(\Exception $ex) { //si hubiere algun error a la hora de comunicarse con WS
           $result['success'] = false;
           $result['errorMsg'] = $ex->getMessage();
           $data = array('token'=>false);
           $data = json_encode($data);
        }

        $data = json_decode($data, true);

        // consultar todas las solicitudes pendientes de
        // procesar y convertir al HL7;
        $solicitudes = $em->getRepository('MinsalSeguimientoBundle:SecSolicitudestudios')->findBy(array('fechaMensajeCodificado' => NULL));

        $i=1;
        foreach ($solicitudes as $solicitud) {
            // enviar Token y numero de solicitud a procesar en HL7
            $array = array('token'=>$data['token'], 'idSolicitud'=>$solicitud->getId());
            $json_array = json_encode($array);
            $array_param = array('json_array' => $json_array);

            //infvocando ws
            try {
               $soapClient->setLocation($location);
               $soapClient->createSoapClient();
               $mensaje = $soapClient->soapCall('generarMensajeSolicitud', $array_param); //enviar parametros en json y retornar json
               $result['Mensaje'] = $mensaje;
            } catch(\Exception $ex) { //si hubiere algun error a la hora de comunicarse con WS
               $result['success'] = false;
               $result['errorMsg'] = $ex->getMessage();
               $result['Mensaje'] = "";
            }
            var_dump($result['Mensaje']); exit();
            if ($i == 1){
                return new Response($result['Mensaje']);
            }
            $i++;
        }
    }

    /**
     * @Route("/api/laboratorio/solicitud/equipoautomatizado/send", name="api_laboratorio_solicitud_equipoautomatizado_send", options={"expose"=true})
     * @Method("GET")
     */
    public function apiLaboratorioSolicitudEquipoAutomatizadoSendAction() {
        $request = $this->getRequest();

        $token = $request->get('token');
        $authenticator = $this->container->get('api.authenticator');

        $result = array( 'estado' => false, 'mensaje' => '' );

        try {
            $isGranted = $authenticator->isGranted($token, 'ROLE_API_LABORATORIO_ENVIAR_SOLICITUD_EQUIPOAUTOMATIZADO');
        } catch (\Exception $e) {
            if($this->codeEnvironment === 'dev') {
                throw $e;
            } else {
                $result['mensaje'] = 'Error al procesar el envio';

                return $result;
            }
        }

        if( $isGranted ) {
            $em = $this->getDoctrine()->getEntityManager();
            /*
             * determinar solicitudes pendientes
             */
            $solicitudes = $em->getRepository('MinsalLaboratorioBundle:LabControlInterfaceEnvio')
                              ->findBy(array(
                                        'fechaProceso'    => NULL,
                                        'via'             => 1,
                                        'estado'          => 1,
                                    ));
            if (! $solicitudes)
            {
                $result['mensaje'] = "No se encontraron solicitudes pendientes de enviar";
                return new Response( json_encode( $result ) );
            }
            /*
             * determinar suministrante activos con conexion a WS.
             */
            $suministrantes = $em->getRepository('MinsalLaboratorioBundle:LabSuministrante')
                                 ->findBy(array('activo'=>TRUE, 'idTipoConexion'=> 2));

            /*
             * Obtener solicitudes por suministrante.
             */
            $mensajeError = ""; // para mensaje de error de conexion

            foreach ($suministrantes as $suministrante) {
                $solicitudes = $em->getRepository('MinsalLaboratorioBundle:LabControlInterfaceEnvio')
                                  ->findBy(array(
                                            'fechaProceso'    => NULL,
                                            'via'             => 1,
                                            'estado'          => 1,
                                            'idSuministrante' => $suministrante->getId()
                                        ));
                /*
                 * Verificar el numero de solicitudes para invocar el web service del suministrante
                 */

                if ($solicitudes) { // si hay solicitues que enviar.
                    /*
                     * Verificar que este disponible el servidor
                     * de la API del suministrante
                     */
                    $hl7Service = $this->container->get('hl7.service');
                    $baseUrl    = $suministrante->getBaseUrl();
                    $complementUrl = $suministrante->getComplementoUrl() ? : '';
                    $url        = $baseUrl.$complementUrl."/checkin";

                    //comprobar que exista el web la ruta.
                    $urlexists  = $hl7Service->testConexion( $baseUrl );
                    $tipoWS     = $suministrante->getTipoWebService();
                    if ($urlexists) {  //ejecutar envio
                        /* procesando las solicitudes encontradas */
                        foreach ($solicitudes as $solicitud) {
                            /*
                             * determinr el tipo de web service a consumir
                             */
                             if ($tipoWS == 1) { //metodo sin wsdl
                                /*
                                * ejecutar API de proveedor especificamente al metodo de autenticacion por REST
                                * cuyo nombre debe ser ----------checkin-------------
                                */
                                $data_string = '{"AppUser":"'.$suministrante->getUsername().'","Password":"'.$suministrante->getPassword().'"}';
                                $ch = curl_init($url);
                                //Establecer un tiempo de espera
                                curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );
                                curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                  'Content-Type: application/json',
                                  'Content-Length: ' . strlen($data_string))
                                );
                                try { // ejecucion de web serice traer Token
                                    $response = curl_exec($ch);
                                    $response = str_replace('"','', $response); // quitar las comillas
                                    /*
                                    * preparar la cadena del mensaje a enviar
                                    */
                                    $mensaje_Hl7 = $solicitud->getMensaje();
                                    $mensaje = str_replace('"','', $mensaje_Hl7); // quitar las comillas
                                    $mensaje = str_replace("'",'', $mensaje_Hl7); // quitar las comillas
                                    $mensaje = str_replace("<CR>",'', $mensaje_Hl7); // quitar las final de segmento
                                    $array = array(
                                        'Token'=>$response,
                                        'Mensaje'=>$mensaje,
                                        'Checksum'=>strlen($mensaje)
                                    );
                                    $cadena = json_encode($array);
                                    /*
                                    * Ejucutar API del equipo automatizado
                                    * especificamente el método -----------acceptMessage-------------------
                                    * para enviar el mensaje
                                    */
                                    $ch = curl_init($baseUrl.$complementUrl.'/acceptMessage');
                                    $data_string = $cadena;
                                    //Establecer un tiempo de espera
                                    curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );
                                    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );
                                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                        'Content-Type: application/json',
                                        'Content-Length: ' . strlen($data_string))
                                    );
                                    try {
                                        $result['mensaje'] = curl_exec($ch);
                                        // guardar estado fecha de proceso y envio de mensaje
                                        $solicitud->setFechaProceso(new \Datetime());
                                        $solicitud->setEstado(2);  // estado procesado
                                        $em->persist($solicitud);
                                        $em->flush();
                                    } catch (\Exception $e) {
                                        throw $e;
                                    } //fin del envio del mensaje acceptMessage,
                                } catch (\Exception $e) {
                                    throw $e;
                                } // fin de traer Token
                            } // fin de revision tipo WS 1
                            else { // metodo usando WSDL

                                /* inicializando variables soap*/
                                ini_set('soap.wsdl_cache_enabl ed', '0');
                                ini_set('soap.wsdl_cache_ttl', '0');
                                $url = $baseUrl.$complementUrl.'?wsdl';

                                /*
                                * ejecutar API de proveedor especificamente al metodo de autenticacion por REST
                                * cuyo nombre debe ser ----------checkin-------------
                                */
                                $action = 'checkin';
                                $soapParameters = array('trace' => true, 'exceptions' => true);
                                $parameters = array(
                                    'json_array' => json_encode(
                                        array(
                                            'AppUser' => $suministrante->getUsername(),
                                            'Password' => $suministrante->getPassword()
                                        )
                                    )
                                );
                                try {
                                    $soapClient = new \Soapclient($url, $soapParameters);
                                    $soapClient->__setLocation($baseUrl.$complementUrl);
                                    $response = $soapClient->__soapCall($action, $parameters);
                                    $data = json_decode($response, true);

                                    /*
                                    * preparar el mensaje a enviar
                                    */
                                    $action = 'acceptMessage';
                                    $response = str_replace('"','', $response); // quitar las comillas
                                    $mensaje_Hl7 = $solicitud->getMensaje();
                                    $mensaje = str_replace('"','', $mensaje_Hl7); // quitar las comillas
                                    $mensaje = str_replace("'",'', $mensaje_Hl7); // quitar las comillas
                                    $mensaje = str_replace("<CR>","\r", $mensaje_Hl7); // quitar las final de segmento
                                    $array = array(
                                        'Token'=>$data['token'],
                                        'Mensaje'=>$mensaje,
                                        'Checksum'=>md5($mensaje)
                                    );
                                    $parameters = json_encode($array);
                                    try {
                                        /*
                                        * Ejucutar API del equipo automatizado
                                        * especificamente el método -----------acceptMessage-------------------
                                        * para enviar el mensaje
                                        */
                                        $result['mensaje'] = $soapClient->__soapCall($action, array('json_array' => $parameters));
                                        // guardar estado fecha de proceso y envio de mensaje
                                        $solicitud->setFechaProceso(new \Datetime());
                                        $solicitud->setEstado(2);  // estado procesado
                                        $em->persist($solicitud);
                                        $em->flush();
                                    } catch (\Exception $e) {
                                        throw $e;
                                    } // fin de ejecucion del acceptMessage para SOAP
                                } catch (\Exception $e) {
                                    throw $e;
                                } // fin del intento de ejecución de WS
                            } //fin del metodo de Web service usando WSDL
                        } // fin del foreach envio de las Solicitudes
                        $result['estado'] = true;
                    } else { //si la ruta no existe.
                        $mensajeError .= 'ER01 => suministrante '.$suministrante->getId().', ';
                    } // fin de veririfacion de la ruta
                } // fin de la verificacion de existencia e solicitudes por suministrantes
            } // fin de recorrio de los suministrantes
            $result['mensaje'] .= $mensajeError;
        } else { // si no tiene privilegios para ejecutar el web service
            $result['mensaje'] = "Error Acceso no autorizado.";
        } //fin de verificacion de privilegios
        return new Response( json_encode( $result ) );
   } // fin de la funcion

}
