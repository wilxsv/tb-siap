<?php

namespace Minsal\SiapsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ReporteController extends Controller {
    /*
     * DESCRIPCIÓN: Método que genera la cartera de servicios
     * ANALISTA PROGRAMADOR: Karen Peñate
     * PARAMETROS ENTRADA:
     *          report_name     =>  Nombre del reporte
     *          report_format   =>  Formato del reporte
     */

    /**
     * @Route("/report/show/{report_name}/{report_format}", name="_report_show", options={"expose"=true})
     */
    public function showAction($report_name, $report_format) {
        //$report_format='pdf';
        $jasper_url = JASPER_URL;
        $jasper_username = JASPER_USER;
        $jasper_password = JASPER_PASSWORD;
        $report_unit = "/reports/siaps/cartera/" . $report_name;
        $report_params = array();

        $client = new JasperClient($jasper_url, $jasper_username, $jasper_password);

        $contentType = (($report_format == 'HTML') ? 'text' : 'application') .
                '/' . strtolower($report_format);

        $result = $client->requestReport($report_unit, $report_format, $report_params);

        $response = new Response();
        $response->headers->set('Content-Type', $contentType);
        //if (strtoupper($report_format) != 'HTML')
        //$response->headers->set('Content-disposition', 'attachment; filename="' . $report_name . '.' . strtolower($report_format) . '"');
        $response->setContent($result);

        return $response;
    }

    /*
     * DESCRIPCIÓN: Método que genera la hoja de identificación paciente
     * ANALISTA PROGRAMADOR: Karen Peñate
     * PARAMETROS ENTRADA:
     *          paciente        =>  Id del paciente
     *          report_name     =>  Nombre del reporte
     *          report_format   =>  Formato del reporte
     */

    /**
     * @Route("/report/paciente/{report_name}/{report_format}", name="_report_paciente", options={"expose"=true})
     */
    public function pacienteAction($report_name, $report_format) {
        $request = $this->getRequest();
        $id_paciente = $request->get('paciente');

        $jasperReport = $this->container->get('jasper.build.reports');
        $jasperReport->setReportName($report_name);
        $jasperReport->setReportFormat($report_format);
        $jasperReport->setReportPath("/reports/siaps/administracion/");
        $jasperReport->setReportParams(array('id_paciente' => $id_paciente));

        return $jasperReport->buildReport();
    }

     /*
     * DESCRIPCIÓN: Método que genera la hoja de expedientes realizados en una
     * determinada fecha
     * ANALISTA PROGRAMADOR: Karen Peñate
     * PARAMETROS ENTRADA:
     *          fecha_inicio    =>  Fecha de inicio del reporte
     *          fecha_fin       =>  Fecha de finalización del reporte
     *          report_name     =>  Nombre del reporte
     *          report_format   =>  Formato del reporte
     */

    /**
     * @Route("/exportar/{report_name}/{report_format}", name="_exportar_reporte", options={"expose"=true})
     * @Method("GET")
     */
    public function exportarReporteAction($report_name, $report_format) {
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);
        $fecha_inicio = $datos['fecha_inicio'];
        $fecha_fin = $datos['fecha_fin'];
        if(array_key_exists('usuario', $datos))
            $usuario = $datos['usuario'];
        else
            $usuario = 0;

        $jasperReport = $this->container->get('jasper.build.reports');
        $jasperReport->setReportName($report_name);
        $jasperReport->setReportFormat($report_format);
        $jasperReport->setReportPath("/reports/siaps/identificacion/");
        $jasperReport->setReportParams(array('fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'id_user'=> $usuario));

        return $jasperReport->buildReport();
    }

    /*
    * DESCRIPCIÓN: Método que genera el reporte de pacientes Derivados a
                   Farmacia Especializada
    * ANALISTA PROGRAMADOR: Karen Peñate
    * PARAMETROS ENTRADA:
    *          fecha_inicio    =>  Fecha de inicio del reporte
    *          fecha_fin       =>  Fecha de finalización del reporte
    *          report_name     =>  Nombre del reporte
    *          report_format   =>  Formato del reporte
    */

   /**
    * @Route("/exportar/pacientes/derivados/", name="exportar_pacientes_derivados", options={"expose"=true})
    * @Method("GET")
    */
   public function exportarPacientesDerivadosReporteAction() {
     $em = $this->getDoctrine()->getManager();
     $request = $this->get('request');
     $datos = '';
     $report_name=$request->get('report_name');
     $report_format=$request->get('report_format');
     parse_str($request->get('datos'), $datos);
     $fecha_inicio=$datos['fecha_inicio']?:'0';
     $fecha_fin=$datos['fecha_fin']?:'0';
     $fecha_consulta=$datos['fecha_consulta']?:'0';
     $jasperReport = $this->container->get('jasper.build.reports');
     $jasperReport->setReportName($report_name);
     $jasperReport->setReportFormat($report_format);
     $jasperReport->setReportPath("/reports/siaps/seguimiento/");
     $jasperReport->setReportParams(array('fecha_inicio' => $fecha_inicio,
     'fecha_fin' => $fecha_fin,'fecha_consulta'=>$fecha_consulta));

     return $jasperReport->buildReport();
   }

}

?>
