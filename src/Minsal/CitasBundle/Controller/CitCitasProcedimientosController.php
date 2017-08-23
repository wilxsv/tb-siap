<?php
//src/Minsal/CitasBundle/Controller/CitCitasProcedimientosController.php

namespace Minsal\CitasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL as DBAL;
use Symfony\Component\Security\Core\SecurityContext;
use FOS\UserBundle\Model\User;
use Doctrine\DBAL\Types\Type;
use Minsal\CitasBundle\Entity\CitCitaTransferida;
use Minsal\CitasBundle\Entity\CitCitasProcedimientos;
use \Doctrine\ORM\Query;

class CitCitasProcedimientosController extends Controller {

    /*
     * DESCRIPCIÓN: Obtiene los procedimientos configurados por el área seleccionado.
     * ANALISTA PROGRAMADOR: Karen Peñate, Victoria López
     */

    /**
     * @Route("/distribucion/procedimientos/area/{idAreaModEstab}", name="obtener_procedimientos_distribucion_area", options={"expose"=true})
     */
    public function obtenerProcedimientosPorArea($idAreaModEstab) {
        $em = $this->getDoctrine()->getManager();
        $fechaActual =  new \DateTime();
        $dql = "SELECT DISTINCT t02
                FROM MinsalCitasBundle:CitDistribucionProcedimiento   t01
                INNER JOIN MinsalSiapsBundle:MntProcedimientoEstablecimiento   t02 WITH (t02.id = t01.idProcedimientoEstablecimiento)
                WHERE t01.idAreaModEstab=$idAreaModEstab AND t01.yrs>=".$fechaActual->format('Y')."
                ";

        $result = $em->createQuery($dql)
                ->getResult();
        $envio = array();
        foreach ($result  as $key => $value) {
            $envio[$key]['text'] = $value->getIdCiq()->__toString();
            $envio[$key]['id'] = $value->getId();
        }
        $resultados = array();
        $resultados['resultados'] = $envio;
        return new Response(json_encode($resultados));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON con todas los médicos configurados para un procedimiento específico.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/obtener/medicos/procedimiento/{idProcedimientoEstablecimiento}", name="obtener_medicos_por_procedimiento", options={"expose"=true})
     */
    public function obtenerMedicosProcedimiento($idProcedimientoEstablecimiento) {
        $em = $this->getDoctrine()->getManager();
        $fechaActual =  new \DateTime();
        $sql = "SELECT DISTINCT COALESCE(t01.id_empleado,0) as id,COALESCE(initcap(t05.nombreempleado),'No tiene médico asignado') as text
                FROM cit_distribucion_procedimiento t01
                	INNER JOIN mnt_procedimiento_establecimiento t02 ON (t01.id_procedimiento_establecimiento=:idProcedimientoEstablecimiento)
                    LEFT JOIN mnt_empleado t05 ON (t05.id=t01.id_empleado)
                WHERE t01.yrs >=".$fechaActual->format('Y')." AND (CASE WHEN yrs=".$fechaActual->format('Y')." THEN mes>=".$fechaActual->format('m')."
                         ELSE mes>=1 END)
                ORDER BY COALESCE(t01.id_empleado,0) ASC";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idProcedimientoEstablecimiento', $idProcedimientoEstablecimiento);
        $stm->execute();
        $result = $stm->fetchAll();

        $resultados['resultados'] = $result;
        return new Response(json_encode($resultados));
    }

    /**
     * @Route("/dar/cita/procedimiento", name="dar_cita_procedimiento", options={"expose"=true})
     * @Method("GET")
     */
    public function darCitaAction(){
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $idExpediente   = $request->get('idExpediente');
        $fecha   = $request->get('fecha');
        $idRangoHora   = $request->get('idRangoHora');
        $idEstadoCita   = $request->get('idEstadoCita');
        $idDistribucion   = $request->get('idDistribucion');
        $idJustificacion   = $request->get('idJustificacion')==0?NULL:$request->get('idJustificacion');
        $idEstablecimientoReferencia   = $request->get('idEstablecimientoReferencia')!=''?$request->get('idEstablecimientoReferencia'):NULL;
        $numeroExpedienteReferencia = $request->get('numeroExpedienteReferencia')!=''?$request->get('numeroExpedienteReferencia'):NULL;

        $citasService = $this->container->get('cit_citas_procedimientos.services');

        $darCita= $citasService->insertarCita($idDistribucion, $idExpediente, $fecha, $idRangoHora, $idEstadoCita,
         $idJustificacion,NULL, $idEstablecimientoReferencia, $numeroExpedienteReferencia);

        return new Response(json_encode($darCita));
    }

    /**
     * @Route("/procedimientos/comprobante/get", name="procedimientosgetcomprobante", options={"expose"=true})
     * @Method({"GET", "POST"})
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     */
    public function getComprobanteCitaAction() {
        $request = $this->getRequest();
        $id = $request->get('id');

        return $this->render('MinsalCitasBundle:Reports:comprobante_cita_procedimiento.html.twig', array('id' => $id));
    }

    /**
     * @Route("/consulta/citas/procedimientos/por/dia", name="consulta_citas_procedimientos_por_dia", options={"expose"=true})
     * @Method("GET")
     */

    public function getConsultaCitasProcedimientosPorDiaAction() {
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);
        $fechas = explode('-', $datos['rango_fechas']);
        $idProcedimientoEstablecimiento = $datos['idProcedimientoEstablecimiento']?$datos['idProcedimientoEstablecimiento']:NULL;


        return $this->render('MinsalCitasBundle:Reports:CitasProcedimientos/cargarCitasDia.html.twig', array(
            'fechaInicio'=>$fechas[0],
            'fechaFin'=>$fechas[1],
            'idProcedimientoEstablecimiento'=>$idProcedimientoEstablecimiento
        ));
    }

    /**
     * @Route("/consultar/proximas/citas/procedimiento", name="consultar_citas_proximas_procedimiento", options={"expose"=true})
     * @Method("GET")
     */
    public function consultarProximasCitasAction(){
        $em          = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $idExpediente = $request->get('idExpediente');
        $idProcedimientoEstablecimiento = $request->get('idProcedimientoEstablecimiento');
        $rangoFechas = $request->get('rangoFechas');
        $fechaActual = new \DateTime();
        $condicion='';
        $fechas=array();

        if($idProcedimientoEstablecimiento != ''){
            $condicion.=" AND distriProc.idProcedimientoEstablecimiento=$idProcedimientoEstablecimiento";
        }

        if($rangoFechas != ''){
            $fechas=explode('-', $rangoFechas);
            $condicion.=" AND cit.fecha>='".$fechas[0]."' AND cit.fecha<='".$fechas[1]."'";
        }else{
            $condicion.=" AND cit.fecha >= '".$fechaActual->format('Y-m-d')."'";
        }

        $dql = "SELECT cit
                FROM MinsalCitasBundle:CitCitasProcedimientos cit
                    JOIN cit.idDistribucionProcedimiento distriProc
                WHERE cit.idExpediente = $idExpediente
                 $condicion
                AND cit.idEstado NOT IN (3,9)
                ORDER BY cit.fecha";

        $result = $em->createQuery($dql)
                     ->getResult();

        return $this->render('MinsalCitasBundle:CitCitasProcedimientos:carga_citas.html.twig', array('citasMedicas'=>$result));
    }

    /**
     * @Route("/citas/dia/procedimiento/get", name="get_citas_dia_procedimiento", options={"expose"=true})
     * @Method("GET")
     */
    public function getCitasDiaProcedimientoAction() {
        $em      = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $calendarDate          = $request->get('calendarDate') ? new \DateTime($request->get('calendarDate')) : new \DateTime();
        $lowerLimit            = $request->get('lowerLimit') ? $request->get('lowerLimit') : date('Y-m-01', $calendarDate->getTimestamp());
        $upperLimit            = $request->get('upperLimit') ? $request->get('upperLimit') : date('Y-m-t', $calendarDate->getTimestamp());
        $idAreaModEstab        = $request->get('idAreaModEstab');
        $idProcedimientoEstab  = $request->get('idProcedimientoEstab');
        $procedimientoServices = $this->container->get('cit_citas_procedimientos.services');

        /****************************************************************************************
         * Obteniendo la cantidad de citas por primera vez, subsecuentes, agregados, atendidos
         * y total de citas para cada dia de un mes determinado por usuario y especialidad
         ****************************************************************************************/
        $citcita['consolidado'] = $procedimientoServices->getConsolidadoCitCitasProcedimientos($idProcedimientoEstab, $lowerLimit, $upperLimit);

        /****************************************************************************************
         * Obteniendo los eventos que un empleado tiene para un mes en especifico, asi como
         * tambien las fechas festivas o no laborables
         ****************************************************************************************/
        $citcita['eventos'] = $procedimientoServices->getEventos($idProcedimientoEstab, $lowerLimit, $upperLimit, NULL, 'Y-m-d', 'yyyy/mm/dd', FALSE);

        /****************************************************************************************
         * Obteniendo la distribucion de un médico, para un mes especifico
         ****************************************************************************************/
        $citcita['distribucion'] = $procedimientoServices->getDistribucionProcedimiento($idAreaModEstab, $idProcedimientoEstab, $lowerLimit, $upperLimit, NULL, 'Y-m-d', 'yyyy/mm/dd');

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/procedimiento/detalle/hora/get", name="get_citas_procedimiento_detallehora", options={"expose"=true})
     * @Method("GET")
     */
    public function getCitasProcedimientoDetalleHoraAction() {
        $em                    = $this->getDoctrine()->getManager();
        $request               = $this->getRequest();
        $date                  = new \DateTime($request->get('fecha'));
        $idAreaModEstab        = $request->get('idAreaModEstab');
        $idProcedimientoEstab  = $request->get('idProcedimientoEstab');
        $idRangoHora           = $request->get('idRangoHora');
        $idEmpleado            = $request->get('idEmpleado') ? : NULL;
        $procedimientoServices = $this->container->get('cit_citas_procedimientos.services');

        /*****************************************************************************************
         * Determinando el detalle de la cita por hora
         ****************************************************************************************/
        $citcita['ordinarios'] = $procedimientoServices->getDetalleCitaDia($idAreaModEstab, $idProcedimientoEstab, $date->format('d/m/Y'), $date->format('d/m/Y'), $idRangoHora, $idEmpleado, 1);
        $citcita['agregados']  = $procedimientoServices->getDetalleCitaDia($idAreaModEstab, $idProcedimientoEstab, $date->format('d/m/Y'), $date->format('d/m/Y'), $idRangoHora, $idEmpleado, 6);

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/procedimiento/horario/get", name="citashorarioProcedimiento", options={"expose"=true})
     * @Method("GET")
     */
    public function getHorarioMedicoAction() {
        $em                   = $this->getDoctrine()->getManager();
        $request              = $this->getRequest();
        $inputFormat          = $request->get('inputFormat') ? : 'd/m/Y';
        $date                 = \DateTime::createFromFormat($inputFormat, $request->get('fecha'));
        $idAreaModEstab       = $request->get('idAreaModEstab');
        $idProcedimientoEstab = $request->get('idProcedimientoEstab');
        $procedimientoServices = $this->container->get('cit_citas_procedimientos.services');

        $anio     = $date->format('Y');
        $mes      = $date->format('n');
        $dia      = $date->format('w');
        $horarios = array();

        /*****************************************************************************************
         * Obteniendo el horario de atencion de pacientes de un medico (rangos de horas)
         * para una fecha determinada
         ****************************************************************************************/
        $result = $procedimientoServices->obtenerRangoDistribucion($idProcedimientoEstab, NULL, $anio, $mes, $dia, $anio, $mes, $dia, NULL, NULL,TRUE);

        if($result && isset($result[$anio]['meses'][$mes]['dias'][$dia]['horarios'])) {
            $horarios = $result[$anio]['meses'][$mes]['dias'][$dia]['horarios'];
        }

        $citcita = $horarios;

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/obtener/tipo/distribucion/procedimiento/{idProcedimientoEstablecimiento}", name="obtener_tipodistribucion_procedimiento", options={"expose"=true})
     */
    public function obtenerTipodistribucionPorProcedimiento($idProcedimientoEstablecimiento) {

        $em          = $this->getDoctrine()->getManager();
        $sql = "SELECT DISTINCT (COALESCE(t02.id,0)) as id,COALESCE(t02.nombre,'Consulta Normal') as text
                FROM cit_distribucion_procedimiento t01
                	LEFT JOIN cit_tipo_distribucion t02 ON (t02.id=t01.id_tipo_distribucion)
                WHERE t01.id_procedimiento_establecimiento=$idProcedimientoEstablecimiento
                ORDER BY COALESCE(t02.id,0) ASC";
        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $resultados['resultados'] = $stm->fetchAll();

        return new Response(json_encode($resultados));
    }

    /**
     * @Route("/consulta/fechas/libres/procedimientos", name="consulta_fechas_libres_procedimiento", options={"expose"=true})
     * @Method("GET")
     */

    public function getConsultaFechasLibresAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $citasService = $this->container->get('cit_citas_dia.services');

        parse_str($request->get('datos'), $datos);
        $idProcedimientoEstablecimiento = $datos['idProcedimientoEstablecimiento'];
        $idAreaModEstab = $datos['idAreaModEstab'];
        $fechaActual=new \DateTime();

        $whereIdProcedimiento='';
        if($idProcedimientoEstablecimiento){
            $whereIdProcedimiento=" AND C.id_procedimiento_establecimiento=$idProcedimientoEstablecimiento";
        }

        $horarios=array();

        $fechaActual=new \DateTime();
        $mes=$fechaActual->format('m');
        $yrs=$fechaActual->format('Y');

        $sql="SELECT DISTINCT A.id AS id, concat_ws(' -', B.codigo,B.nombre_comun) as nombreprocedimiento, max(cupos) as cupo
                FROM mnt_procedimiento_establecimiento A
                INNER JOIN mnt_ciq B ON (B.id=A.id_ciq)
                INNER JOIN cit_distribucion_procedimiento C ON (C.id_procedimiento_establecimiento = A.id AND C.id_estado_distribucion=1
                      $whereIdProcedimiento AND C.id_area_mod_estab=$idAreaModEstab
                      AND ((C.yrs=$yrs AND C.mes>=$mes) OR (C.yrs>$yrs)))
                GROUP BY A.id,B.codigo,B.nombre_comun
                ORDER BY nombreprocedimiento ASC
        ";
        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $procedimientos = $stm->fetchAll();
        //var_dump($procedimientos);
        foreach ($procedimientos as $key => $procedimiento) {
            $horarios[$procedimiento['nombreprocedimiento']]['id']=$procedimiento['id'];
            if($procedimiento['cupo']>0){
                $horarios[$procedimiento['nombreprocedimiento']]['cupos']=$citasService->obtenerCupoDisponible(NULL, NULL, NULL, NULL,
                $idAreaModEstab,$procedimiento['id'], $fechaActual->format('d/m/Y'), NULL,2,FALSE, FALSE, array(), FALSE);
            }else{
                $horarios[$procedimiento['nombreprocedimiento']]['cupos']=null;
            }

        }

        return $this->render('MinsalCitasBundle:Reports:CitasProcedimientos/cargarFechasLibres.html.twig', array(
            'horariosDisponibles'=>$horarios
        ));
    }
}
