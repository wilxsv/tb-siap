<?php

namespace Minsal\SeguimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Minsal\Metodos\Funciones;
use Minsal\SeguimientoBundle\Entity\SecConsejeria;
use Minsal\SeguimientoBundle\Entity\SecOtrasObservaciones;

class SecHistorialClinicoController extends Controller {

    protected $requestScheme;
    protected $codeEnvironment;
    protected $environment;
    protected $domain;
    protected $global_host;
    private   $method;

    public function setContainer(ContainerInterface $container = null) {
        parent::setContainer($container);

        $this->method          = $this->container->getParameter('ws_method');
        $this->requestScheme   = $this->container->get('request')->server->get('REQUEST_SCHEME');
        $this->codeEnvironment = $this->container->getParameter("kernel.environment");
        if($this->codeEnvironment === 'dev') {
            $this->environment = '/app_dev.php';
        } else {
            $this->environment = '/app.php';
        }
        $this->domain          = $this->container->get('request')->server->get('HTTP_HOST');
        $this->global_host     = $this->container->getParameter('global_host');
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un json con la información SNOMED según
     *              los parametros de busqueda
     * ANALISTA PROGRAMADOR: Ing. Aaron Romero
     * PARAMETROS ENTRADA:
     *          id        =>  Id SNOMED a buscar
     *          clue      =>  palabra a buscar en el campo descriptivo del snomed
     *  PARAMETROS Salida:
     *          snomed   =>  Valores que cumplen con las condiciones del id o del
     *                       clue según sea el caso.
     */

    /**
     * @Route("/diagnostico/get", name="diagnostico", options={"expose"=true})
     * @Method("GET")
     */
    public function getDiagnosticoAction() {
        $em = $this->getDoctrine()->getManager();
        $funcionesGenerales= new Funciones();
        $request = $this->getRequest();

        $id = $request->get('id');

        if (isset($id)) {

            $sql = "SELECT t01.id,
                            concat_ws(' - ',t01.codigo,t01.diagnostico) AS text,
                           count(*) OVER() AS total
                    FROM mnt_cie10     t01
                    WHERE t01.id = $id
                    ORDER BY text";
        } else {
            $clue = ltrim(strtolower($request->get('clue')), '0');
            $limit = $request->get('page_limit');
            $page = ($request->get('page') - 1) * 10;

            $clue=$funcionesGenerales->eliminarArticulosPreposiciones($clue);
            $clue=  str_replace(' ','%', $clue);

            $sql = "SELECT  id, text, count(*) OVER() as total
                    FROM(
                        SELECT t01.id , concat_ws(' - ',t01.codigo,t01.diagnostico) AS text
                        FROM mnt_cie10 t01
                        WHERE t01.unaccent_diagnostico ILIKE '%$clue%' OR t01.codigo ILIKE '%$clue%'
                    ) AS cie10Diag
                    ORDER BY length(text) ASC
                    LIMIT $limit OFFSET $page";
        }

        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        $snomed['data1'] = $result;
        $snomed['data2'] = count($result) > 0 ? $result[0]['total'] : 0;

        return new Response(json_encode($snomed));
    }

    /**
     * @Route("/procedimiento/quirurgico/get", name="procquirurgico", options={"expose"=true})
     * @Method("GET")
     */
    public function getProcedimientoQuirurgicoAction() {
        $em = $this->getDoctrine()->getManager();
        $funcionesGenerales= new Funciones();
        $request = $this->getRequest();

        $id = $request->get('id');

        if (isset($id)) {

            $sql = "SELECT t01.id,
                           t01.procedimiento AS text,
                           count(*) OVER() AS total
                    FROM mnt_ciq t01
                    WHERE t01.id = $id
                    ORDER BY text";
        } else {

            $clue = ltrim(strtolower($request->get('clue')), '0');
            $limit = $request->get('page_limit');
            $page = ($request->get('page') - 1) * 10;

            $clue=$funcionesGenerales->eliminarArticulosPreposiciones($clue);
            $clue=  str_replace(' ','%', $clue);

            $sql = "SELECT  id, text, count(*) OVER() as total
                    FROM(
                    	SELECT t01.id , t01.procedimiento AS text
                    	FROM mnt_ciq t01
                    	WHERE unaccent(t01.procedimiento) ILIKE '%$clue%'
                    ) AS cie10Diag
                    ORDER BY length(text) ASC
                    LIMIT $limit OFFSET $page";
        }

        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        $snomed['data1'] = $result;
        $snomed['data2'] = count($result) > 0 ? $result[0]['total'] : 0;

        return new Response(json_encode($snomed));
    }

    /**
     * @Route("/datos/paciente/sumeve/{idpac}/verify", name="verify_datos_pacientes_sumeve", options={"expose"=true})
     * @Method("GET")
     */
    public function getDatosPacienteSumeve($idpac) {
        $codeEnvironment = $this->container->getParameter("kernel.environment");
        return $this->render('MinsalSeguimientoBundle:SecHistorialClinico:listadoPacientesSumeve.html.twig',
                                array(
                                    'idPaciente'      => $idpac,
                                    'codeEnvironment' => $codeEnvironment
                                )
                            );
    }

    /**
     * @Route("/get/listado/pacientes/sumeve/{idPaciente}", name="get_listado_pacientes_sumeve", options={"expose"=true})
     * @Method("GET")
     */
    public function getListadoPacientesSumeve($idPaciente) {
        $em     = $this->getDoctrine()->getManager();

        $paciente          = $em->getRepository("MinsalSiapsBundle:MntPaciente")->findOneById($idPaciente);
        $nombre_completo   = $paciente->getPrimerNombre() . ' ' . $paciente->getSegundoNombre() . ' ' . $paciente->getTercerNombre() . ' ' . $paciente->getPrimerApellido() . ' ' . $paciente->getSegundoApellido() . ' ' . $paciente->getApellidoCasada();
        $fecha_nacimiento  = $paciente->getFechaNacimiento()->format('Y-m-d');
        $dui               = $paciente->getIdDocPaciente() ? ( $paciente->getIdDocPaciente()->getId() == 1 ? ( $paciente->getNumeroDocIdePaciente() ? $paciente->getNumeroDocIdePaciente() : '' ) : '' ) : '';
        $sexo              = $paciente->getIdSexo()->getId();
        $nombre_fonetico   = $paciente->getNombreCompletoFonetico();
        $apellido_fonetico = $paciente->getApellidoCompletoFonetico();

        $soapClient = $this->container->get('soapClient');
        $soapClient->setUrl($this->requestScheme.'://'.$this->global_host.$this->environment.'/soap/webservices/proveedor_servicios?wsdl');
        $soapClient->setTimeOut(600);

        $result = array();
        try {
            $soapClient->createSoapClient();
            $resultado = $soapClient->soapCall('obtenerPacientes', array('nombre_completo' => $nombre_completo, 'fecha_nacimiento' => $fecha_nacimiento, 'sexo' => $sexo, 'dui' => $dui, 'nombre_fonetico' => $nombre_fonetico, 'apellido_fonetico' => $apellido_fonetico));
            $result['status'] = true;
        } catch(\Exception $ex) {
            $resultado = null;
            $result['status'] = false;
            $result['errorCode'] = $soapClient->getCodeInfo();
            $result['errorMessage'] = $ex->getMessage();
        }

        $result['data'] = $resultado;
        return new Response(json_encode($result));
    }

    /*
    * DESCRIPCIÓN: Método que devuelve un json con la información SNOMED según
    *              los parametros de busqueda
    * ANALISTA PROGRAMADOR: Ing. Aaron Romero
    * PARAMETROS ENTRADA:
    *          idPaciente        =>  El Id Paciente a buscarle historias clinicas
    *  PARAMETROS Salida:
    *          idEspecialidades   =>  Json que devuelve las especialidades en las
    *                                 que ha pasado consulta el paciente.
    */

    /**
    * @Route("/obtener/especialidades/historia/{idPaciente}", name="especialidades_historia", options={"expose"=true})
    * @Method("GET")
    */
    public function obtenerEspecialidadesHistoria($idPaciente){
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT DISTINCT B
        FROM MinsalSeguimientoBundle:SecHistorialClinico A
        JOIN MinsalSiapsBundle:MntAtenAreaModEstab B WITH (A.idAtenAreaModEstab = B.id)
        JOIN MinsalSiapsBundle:MntExpediente C WITH (A.idExpediente=C.id AND C.id=".$idPaciente.")
        WHERE A.piloto = 'F'
        ORDER BY B.id ASC";
        $idEspecialidad= $em->createQuery($dql)->getResult();
        $idExpediente=$em->getRepository('MinsalSiapsBundle:MntExpediente')->find($idPaciente);
        $resultado=array();
        $i=0;
        if(empty($idEspecialidad)){
            $resultado[$i]['id']='';
            $resultado[$i]['nombre']='No posee historial clinico en ninguna especialidad';
        }else{
            foreach ($idEspecialidad as $detalle) {
                $resultado[$i]['id']=$detalle->getId();
                $resultado[$i]['nombre']=$detalle->getNombreConsulta();
                $resultado[$i]['idexpediente']=$idExpediente->getId();
                $i++;
            }
        }
        $respuesta['idEspecialidad']=$resultado;
        return new Response(json_encode($respuesta));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un knp_snappy dependiendo del formato que
                    se necesite.
     * ANALISTA PROGRAMADOR: Ing. Karen Peñate
     * PARAMETROS ENTRADA:
     *          idHistorialClinico        =>  id del historial clinico
     *  PARAMETROS Salida:
            NINGUNO
     */

    /**
     * @Route("/impresion/fvih01/{idHistorialClinico}", name="imprimir_fvih01", options={"expose"=true})
     * @Method("GET")
     */
    public function imprimirFvih01dAction($idHistorialClinico) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $historialClinico=$em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($idHistorialClinico);

        $expediente = $historialClinico->getIdExpediente();
        $conn = $em->getConnection();
        $calcular = new Funciones();
        $edad = $calcular->calcularEdad($conn, $expediente->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $expediente->getIdPaciente()->getHoraNacimiento() ? $expediente->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );

        $solicitudVih=$em->getRepository('MinsalSeguimientoBundle:TarSolicitudFvih')->findOneBy(array('idHistorialClinico'=>$idHistorialClinico));
        $datoEmbarazo=$em->getRepository('MinsalSeguimientoBundle:SecDatoEmbarazo')->findOneBy(array('idHistorialClinico'=>$idHistorialClinico));

        $impresion = $this->renderView($solicitudVih->getIdFormulario()->getVistaToPrint(),
            array('object'=>$historialClinico,
                  'expediente'=>$expediente,
                  'edad'=>$edad,
                  'solicitud'=>$solicitudVih,
                  'datoEmbarazo'=>$datoEmbarazo
            )
        );

        return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($impresion,
                        array(
                            'page-size' => 'Letter',
                            'margin-top' => '5',
                            'margin-right' => '5',
                            'margin-left' => '5',
                            'margin-bottom' => '5',
                            'print-media-type'=>true,
                            'title'=>'FVIH01',
                            'no-pdf-compression'=>true)),
                200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline'
                )
        );
    }


    /*
     * DESCRIPCIÓN: Método que devuelve un knp_snappy dependiendo del formato que
                    se necesite.
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar
     * PARAMETROS ENTRADA:
     *          idHistorialClinico        =>  id del historial clinico
     *  PARAMETROS Salida:
            NINGUNO
     */

    /**
     * @Route("/impresion/vigepes01/{idHistorialClinico}", name="imprimir_vigepes01", options={"expose"=true})
     * @Method("GET")
     */
    public function imprimirVigepes01dAction($idHistorialClinico) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $historialClinico=$em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($idHistorialClinico);

        $expediente = $historialClinico->getIdExpediente();
        $conn = $em->getConnection();
        $calcular = new Funciones();
        $edad = $calcular->calcularEdad($conn, $expediente->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $expediente->getIdPaciente()->getHoraNacimiento() ? $expediente->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );

        $solicitudVih=$em->getRepository('MinsalSeguimientoBundle:TarSolicitudFvih')->findOneBy(array('idHistorialClinico'=>$idHistorialClinico));
        //$datoEmbarazo=$em->getRepository('MinsalSeguimientoBundle:SecDatoEmbarazo')->findOneBy(array('idHistorialClinico'=>$idHistorialClinico));

        $impresion = $this->renderView('MinsalSeguimientoBundle:Reportes:Vigepes/reporte_vigepes01.html.twig',
            array('object'=>$historialClinico,
                  'expediente'=>$expediente,
                  'edad'=>$edad,
                  'solicitud'=>$solicitudVih,
                  //'datoEmbarazo'=>$datoEmbarazo
            )
        );

        return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($impresion,
                        array(
                            'page-size' => 'Letter',
                            'margin-top' => '5',
                            'margin-right' => '5',
                            'margin-left' => '5',
                            'margin-bottom' => '5',
                            'print-media-type'=>true,
                            'title'=>'VIGEPES-01',
                            'no-pdf-compression'=>true)),
                200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline'
                )
        );
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un knp_snappy dependiendo del formato que
                    se necesite.
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar
     * PARAMETROS ENTRADA:
     *          idHistorialClinico        =>  id del historial clinico
     *  PARAMETROS Salida:
            NINGUNO
     */

    /**
     * @Route("/impresion/vigepes02/{idHistorialClinico}", name="imprimir_vigepes02", options={"expose"=true})
     * @Method("GET")
     */
    public function imprimirVigepes02dAction($idHistorialClinico) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $historialClinico=$em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($idHistorialClinico);

        $expediente = $historialClinico->getIdExpediente();
        $conn = $em->getConnection();
        $calcular = new Funciones();
        $edad = $calcular->calcularEdad($conn, $expediente->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $expediente->getIdPaciente()->getHoraNacimiento() ? $expediente->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );

        $solicitudVih=$em->getRepository('MinsalSeguimientoBundle:TarSolicitudFvih')->findOneBy(array('idHistorialClinico'=>$idHistorialClinico));
        //$datoEmbarazo=$em->getRepository('MinsalSeguimientoBundle:SecDatoEmbarazo')->findOneBy(array('idHistorialClinico'=>$idHistorialClinico));

        $impresion = $this->renderView('MinsalSeguimientoBundle:Reportes:Vigepes/reporte_vigepes02.html.twig',
            array('object'=>$historialClinico,
                  'expediente'=>$expediente,
                  'edad'=>$edad,
                  'solicitud'=>$solicitudVih,
                  //'datoEmbarazo'=>$datoEmbarazo
            )
        );

        return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($impresion,
                        array(
                            'orientation' => 'landscape',
                            'page-size' => 'Letter',
                            'margin-top' => '5',
                            'margin-right' => '5',
                            'margin-left' => '5',
                            'margin-bottom' => '5',
                            'print-media-type'=>true,
                            'title'=>'VIGEPES-02',
                            'no-pdf-compression'=>true)),
                200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline'
                )
        );
    }


    /**
     * @Route("/addNewAdvise/get", name="addnewadvise", options={"expose"=true})
     * @Method("GET")
     */
    public function addNewAdviseAction() {
        $em      = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        try{
            $idHistorialClinico = $request->get('idHistorialClinico') ? $this->findObject('MinsalSeguimientoBundle','SecHistorialClinico', $request->get('idHistorialClinico') ) : null;

            $secConsejeria = new SecConsejeria();
            $secConsejeria->setIdHistorialClinico( $idHistorialClinico );
            $secConsejeria->setConsejo( $request->get('consejo') );
            $secConsejeria->setIdTipoConsejeria( $this->findObject('MinsalSeguimientoBundle','CtlTipoConsejeria', $request->get('idTipoConsejeria') ) );
            $secConsejeria->setIdEmpleado( $idHistorialClinico->getIdEmpleado()->getId() == $request->get('idEmpleado') ? $idHistorialClinico->getIdEmpleado() : $this->findObject('MinsalSiapsBundle','MntEmpleado', $request->get('idEmpleado') ) );
            $secConsejeria->setIdAtenAreaModEstab( $idHistorialClinico->getIdAtenAreaModEstab() );
            $secConsejeria->setFechaHoraregistro( new \DateTime() );

            $em->persist($secConsejeria);
            $em->flush();

        }catch(\Exception $e){
            $result['success'] = false;
            $result['errorMsg'] = $e->getMessage();
            return new Response(json_encode($result));
        }

        $result['success'] = true;
        $result['id'] = $secConsejeria->getId();
        $result['nombreEmpleado'] = $secConsejeria->getIdEmpleado()->getNombreempleado();
        $result['nombreConsejeria'] = $secConsejeria->getIdTipoConsejeria()->getNombre();
        return new Response(json_encode($result));
    }

    /**
     * @Route("/updateadvise/get", name="updateadvise", options={"expose"=true})
     * @Method("GET")
     */
    public function updateAdviseAction() {
        $em      = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        try{
            $secConsejeria = $this->findObject('MinsalSeguimientoBundle','SecConsejeria', $request->get('adviseId'));
            $secConsejeria->setConsejoAnterior($secConsejeria->getConsejo());
            $secConsejeria->setConsejo( $request->get('consejo') );
            $secConsejeria->setFechaHoraMod( new \DateTime() );

            $em->persist($secConsejeria);
            $em->flush();

        }catch(\Exception $e){
            $result['success'] = false;
            $result['errorMsg'] = $e->getMessage();
            return new Response(json_encode($result));
        }

        $result['success'] = true;
        $result['id'] = $secConsejeria->getId();
        return new Response(json_encode($result));
    }

    private function findObject($bundle, $entity, $id) {
        $em = $this->getDoctrine()->getManager();
        $foundObject = $em->getRepository($bundle . ':' . $entity)->findOneById($id);
        return $foundObject;
    }

    /*
     * DESCRIPCIÓN: Metodo que almacena las indicaciones medicas y examenes de gabinete.
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar
     * PARAMETROS ENTRADA: $request
     *
     *  PARAMETROS Salida: $result
     */
    /**
     * @Route("/saveotrasobservaciones/get", name="saveotrasobservaciones", options={"expose"=true})
     * @Method("GET")
     */
    public function saveotrasobservacionesAction() {
        $em      = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        try{
            $idHistorialClinico = $request->get('idHistorialClinico') ? $this->findObject('MinsalSeguimientoBundle','SecHistorialClinico', $request->get('idHistorialClinico') ) : null;
            $campo = $request->get('campo');
            $SecOtrasObservaciones =  $em->getRepository('MinsalSeguimientoBundle:SecOtrasObservaciones')->findOneBy(array('idHistorialClinico' => $request->get('idHistorialClinico')));

            if(empty($SecOtrasObservaciones)){
                $SecOtrasObservaciones = new SecOtrasObservaciones();
                $SecOtrasObservaciones->setIdHistorialClinico($idHistorialClinico);
            }
            $set = 'set'.$campo;
            $SecOtrasObservaciones->$set($request->get('indicaciones_medicas') );
            $em->persist($SecOtrasObservaciones);
            $em->flush();

        }catch(\Exception $e){
            $result['success'] = false;
            $result['errorMsg'] = $e->getMessage();
            return new Response(json_encode($result));
        }

        $result['success'] = true;
        return new Response(json_encode($result));
    }


    /*
     * DESCRIPCIÓN: Consulta las especialidades configuradas de un determinado establecimiento
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar
     * PARAMETROS ENTRADA: $request
     *
     *  PARAMETROS Salida: $result
     */
    /**
     * @Route("/especialidadesConfiguradas/get", name="especialidadesConfiguradas", options={"expose"=true})
     * @Method("GET")
     */
    public function especialidadesConfiguradasAction() {
        $em      = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $i=0;

        try{
            $idEstablecimiento = $request->get('idEstablecimiento');
            $idHistorialClinico = $request->get('idHistorialClinico');

            $dql = "SELECT T01
                        FROM MinsalSiapsBundle:MntAtenAreaModEstab T01
                        JOIN MinsalSiapsBundle:CtlEstablecimiento T02 WITH (T01.idEstablecimiento = T02.id AND T02.id=$idEstablecimiento)
                        JOIN MinsalSiapsBundle:CtlAtencion T03 WITH (T01.idAtencion=T03.id)
                        JOIN MinsalSiapsBundle:MntAreaModEstab T04 WITH (T01.idAreaModEstab=T04.id AND T04.idAreaAtencion=1)
                        WHERE T01.nombreAmbiente IS NULL AND T03.id NOT IN (
                                        SELECT ad.id
                                        FROM MinsalSeguimientoBundle:SecRemisionPaciente srp
                                                JOIN srp.idAtencionDestino ad
                                        WHERE srp.idHistorialClinico=$idHistorialClinico AND srp.idEstablecimientoDestino=$idEstablecimiento )
                        ORDER BY T04.idServicioExternoEstab DESC";
            $especialidades= $em->createQuery($dql)->getResult();
        }catch(\Exception $e){
            $result['success'] = false;
            $result['errorMsg'] = $e->getMessage();
            return new Response(json_encode($result));
        }


        foreach ($especialidades as $especialidad){
         $arrayespecialidades[$especialidad->getId()]['id'] =  $especialidad->getId();
         $arrayespecialidades[$especialidad->getId()]['nombre'] =  $especialidad->getNombreConsulta();
        }

        $result['success'] = true;
        $result['especialidades'] = $arrayespecialidades;
        return new Response(json_encode($result));
    }

    /*
     * DESCRIPCIÓN: consulta el listado de especialidades del catalogo menos los id_tipo_atencion NOT IN (1,2,6)
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar
     * PARAMETROS ENTRADA: $request
     *
     *  PARAMETROS Salida: $result
     */
    /**
     * @Route("/especialidadesLocales/get", name="especialidadesLocales", options={"expose"=true})
     * @Method("GET")
     */
    public function especialidadesLocalesAction() {
        $em      = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $idEstablecimientoDestino = $request->get('idEstablecimiento');
        $idHistorialClinico = $request->get('idHistorialClinico');
        try{

        $sqlAtenciones = "
                   SELECT *
                   FROM ctl_atencion
                   WHERE  id_tipo_atencion  IN (1,2,6)
                         AND id NOT IN (SELECT id_atencion_destino
                                        FROM sec_remision_paciente
                                        WHERE id_historial_clinico=$idHistorialClinico AND id_establecimiento_destino=$idEstablecimientoDestino
                                        )
                   ORDER BY nombre";

        $stm = $this->container->get('database_connection')->prepare($sqlAtenciones);
        $stm->execute();
        $resultAtenciones = $stm->fetchAll();

        }catch(\Exception $e){
            $result['success'] = false;
            $result['errorMsg'] = $e->getMessage();
            return new Response(json_encode($result));
        }

        foreach ($resultAtenciones as $resultAtencion){
            $arrayatenciones[$resultAtencion['id']]['id'] =  $resultAtencion['id'];
            $arrayatenciones[$resultAtencion['nombre']]['nombre'] =  $resultAtencion['nombre'];
        }

        $result['success'] = true;
        $result['atenciones'] = $resultAtenciones;
        return new Response(json_encode($result));
    }

    /**
     * @Route("/tipolugartrabajo/get", name="tipolugartrabajo", options={"expose"=true})
     * @Method("GET")
     */
    public function getTipoLugarTrabajoAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $ids = $request->get('ids') ? $request->get('ids') : null ;


        $sql = "SELECT  id, nombre
                FROM ctl_tipo_lugar_trabajo".
                ( $ids ? " WHERE id IN (".$ids.")" : "" ).
                " ORDER BY nombre ASC"
                ;

        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        $data['data1'] = $result;

        return new Response(json_encode($data));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un json con la información SNOMED según
     *              los parametros de busqueda
     * ANALISTA PROGRAMADOR: Ing. Aaron Romero
     * PARAMETROS ENTRADA:
     *          id        =>  Id SNOMED a buscar
     *          clue      =>  palabra a buscar en el campo descriptivo del snomed
     *  PARAMETROS Salida:
     *          snomed   =>  Valores que cumplen con las condiciones del id o del
     *                       clue según sea el caso.
     */

    /**
     * @Route("/consulta/recibida/", name="consulta_recibida", options={"expose"=true})
     * @Method("GET")
     */
    public function consultaRecibidaAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);
        $fechaConsulta = $datos['fecha_consulta'];
        $especialidad = $datos['idAtenAreaModEstab'];
        $citCitasDiaService = $this->container->get('cit_citas_dia.services');

        $dql = "SELECT A
        FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab A
        JOIN MinsalSiapsBundle:MntAtenAreaModEstab B WITH (A.idAtenAreaModEstab = B.id AND B.id=$especialidad)
        JOIN MinsalSiapsBundle:MntEmpleado C WITH (A.idEmpleado=C.id)
        ORDER BY C.nombreempleado ASC";

        $empleadosEstab= $em->createQuery($dql)->getResult();

        $citas=array();
        foreach ($empleadosEstab as $key => $mntEmpleadoEspecialidadEstab) {
            $citas[$key]['empleado']=$mntEmpleadoEspecialidadEstab->getIdEmpleado();
            $aux= $citCitasDiaService->getConsolidadoCitCitasDia($mntEmpleadoEspecialidadEstab->getIdEmpleado()->getId(), $especialidad, $fechaConsulta, $fechaConsulta);
            $citas[$key]['total_citas']=$aux[0]['total_citas'];
            $citas[$key]['atendidos']=$aux[0]['atendidos'];
            $citas[$key]['especialidad']=$especialidad;
        }

        return $this->render('MinsalSeguimientoBundle:SecHistorialClinico:cargarListarPacientesAtendidos.html.twig',
        array('citas'=>$citas));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve una plantilla renderizada con la cantidad de citados, consultas dadas en siap y
     *                pacientes derivados a farmacia especializada
     * ANALISTA PROGRAMADOR: Ing. Karen Peñate
     * PARAMETROS ENTRADA:
     *          datos        =>  array con las fechas de evaluación
     *  PARAMETROS Salida:
     *          médicos   =>  array con el detalle del informe
     */

    /**
     * @Route("/cantidad/historias/medico", name="cantidad_historias_medico", options={"expose"=true})
     * @Method("GET")
     */
    public function cantidadHistoriasMedicosAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);
        $fechaInicio = $datos['fecha_inicio'];
        $fechaFin = $datos['fecha_final'];
        $citCitasDiaService = $this->container->get('cit_citas_dia.services');

        $sql = "SELECT COUNT(A.id) cantidad,B.id as id_empleado, initcap(B.nombreempleado) as nombreempleado,
	                   C.id as id_aten_area_mod_estab,initcap(D.nombre) as especialidad
                FROM sec_historial_clinico A
                    INNER JOIN mnt_empleado B ON (A.id_empleado=B.id)
                    INNER JOIN mnt_aten_area_mod_estab C ON (C.id=A.idsubservicio)
                    INNER JOIN ctl_atencion D ON (D.id=C.id_atencion)
                WHERE A.piloto='F' AND fechaconsulta BETWEEN date('$fechaInicio') AND date('$fechaFin')
                GROUP BY B.id,B.nombreempleado,C.id,D.nombre
                ORDER BY D.nombre ASC";

        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $resultados = $stm->fetchAll();
        $citas=array();

        foreach ($resultados as $key=>$value) {
            $total_citas=0;
            $citas[$key]['cantidad']=$value['cantidad'];
            $aux= $citCitasDiaService->getConsolidadoCitCitasDia($value['id_empleado'], $value['id_aten_area_mod_estab'], $fechaInicio, $fechaFin);
            foreach ($aux as $vAux) {
                $total_citas+=$vAux['total_citas'];
            }
            $citas[$key]['total_citas']=$total_citas;
            $citas[$key]['id_empleado']=$value['id_empleado'];
            $citas[$key]['nombreempleado']=$value['nombreempleado'];
            $citas[$key]['id_aten_area_mod_estab']=$value['id_aten_area_mod_estab'];
            $citas[$key]['especialidad']=$value['especialidad'];
            $sql="SELECT count(DISTINCT E.id) as cantidad_pacientes_derivados
                FROM farm_recetas A
                INNER JOIN sec_historial_clinico C ON (C.id=A.idhistorialclinico)
                INNER JOIN mnt_expediente D ON (C.id_numero_expediente=D.id)
                INNER JOIN mnt_paciente E ON (D.id_paciente=E.id)
                INNER JOIN farm_medicinarecetada F ON (F.idreceta=A.id)
                INNER JOIN mnt_empleado H ON (C.id_empleado=H.id)
                WHERE A.id_rangohora IS NOT NULL AND F.id_establecimiento_despacha!=C.idestablecimiento
                    AND C.fechaconsulta BETWEEN date('$fechaInicio') AND date('$fechaFin') AND C.id_empleado="
                    .$value['id_empleado']." AND C.idsubservicio=".$value['id_aten_area_mod_estab'];
            $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $stm->execute();
            $pacientes = $stm->fetchAll();
            $citas[$key]['pacientes_derivados']=$pacientes[0]['cantidad_pacientes_derivados'];

        }

        return $this->render('MinsalSeguimientoBundle:SecHistorialClinico:cargarHistoriasClinicasMedicos.html.twig',
        array('citas'=>$citas));
    }


    /**
     * @Route("/confirmSecSolicitudMatch/get", name="confirmsecsolicitudmatch", options={"expose"=true})
     * @Method("GET")
     */
    public function confirmSecSolicitudMatch() {
        $em      = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        try{
            $currentHistory = $request->get('currentHistoryId') ? $this->findObject('MinsalSeguimientoBundle','SecHistorialClinico', $request->get('currentHistoryId') ) : null;
            $falseHistory = $request->get('falseHistoryId') ? $this->findObject('MinsalSeguimientoBundle','SecHistorialClinico', $request->get('falseHistoryId') ) : null;

            $dql = "SELECT s
                    FROM MinsalSeguimientoBundle:SecSolicitudestudios s
                    WHERE s.idHistorialClinico = :falseHistoryId";

            $solicitudes = $em->createQuery($dql)
                                ->setParameter('falseHistoryId', $falseHistory->getId())
                                ->getResult();

            //$ids = array();
            foreach ($solicitudes as $solicitud) {
                //$ids[] = $solicitud->getId();
                $solicitud->setIdHistorialClinico($currentHistory);
                $em->persist($solicitud);
                $em->flush();
            }


        }catch(\Exception $e){
            $result['success'] = false;
            $result['errorMsg'] = $e->getMessage();
            return new Response(json_encode($result));
        }

        $result['success'] = true;
        return new Response(json_encode($result));
    }

}
