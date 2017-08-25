<?php

namespace Minsal\CitasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ReporteController extends Controller {
    /**
     * @Route("/citas/buildcomprobante/get/{id}/{report_format}", name="citasbuildcomprobante", options={"expose"=true})
     * @Method("GET")
     *
     */
    public function buildComprobanteCitaAction($id, $report_format = "HTML") {
        $report_name = "comprobante_citas";
        $jasperReport = $this->container->get('jasper.build.reports');
        $jasperReport->setReportName($report_name);
        $jasperReport->setReportFormat($report_format);
        $jasperReport->setReportPath("/reports/siaps/seguimiento/");
        $jasperReport->setReportParams(array('id' => $id));

        return $jasperReport->buildReport();
    }

    /**
     * @Route("/citas/buildcomprobante/ticke/{id}", name="citasbuildcomprobante_ticket", options={"expose"=true})
     * @Method("GET")
     *
     */
    public function buildComprobanteCitaTicketAction($id) {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $CitCitasDia = $em->getRepository('MinsalCitasBundle:CitCitasDia')->findOneById($id);

        if (!$CitCitasDia) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $report_name = "comprobante_citas_ticket";
        $report_format = 'HTML';
        $jasperReport = $this->container->get('jasper.build.reports');
        $jasperReport->setReportName($report_name);
        $jasperReport->setReportFormat($report_format);
        $jasperReport->setReportPath("/reports/siaps/seguimiento/");
        $jasperReport->setReportParams(array('id' => $id));

        return $jasperReport->buildReport();
    }

    /**
     * @Route("/procedimientos/comprobante/get/{id}/{report_format}", name="procedimientosbuildcomprobante", options={"expose"=true})
     * @Method("GET")
     *
     */
    public function buildComprobanteCitaProcedimientoAction($id, $report_format = "HTML") {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $citCitasProcedimientos = $em->getRepository('MinsalCitasBundle:CitCitasProcedimientos')->findOneById($id);

        if (!$citCitasProcedimientos) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $report_name = "comprobante_citas_procedimiento";
        $jasperReport = $this->container->get('jasper.build.reports');
        $jasperReport->setReportName($report_name);
        $jasperReport->setReportFormat($report_format);
        $jasperReport->setReportPath("/reports/siaps/seguimiento/");
        $jasperReport->setReportParams(array('id' => $id));

        return $jasperReport->buildReport();
    }

    /**
     * @Route("/procedimentos/buildcomprobante/ticke/{id}", name="procedimientosbuildcomprobante_ticket", options={"expose"=true})
     * @Method("GET")
     *
     */
    public function buildComprobanteCitaProcedimientoTicketAction($id) {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $citCitasProcedimientos = $em->getRepository('MinsalCitasBundle:CitCitasProcedimientos')->findOneById($id);

        if (!$citCitasProcedimientos) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $report_name = "comprobante_citas_procedimientos_ticket";
        $report_format = 'HTML';
        $jasperReport = $this->container->get('jasper.build.reports');
        $jasperReport->setReportName($report_name);
        $jasperReport->setReportFormat($report_format);
        $jasperReport->setReportPath("/reports/siaps/seguimiento/");
        $jasperReport->setReportParams(array('id' => $id));

        return $jasperReport->buildReport();
    }

    /**
     * @Route("/buildcitaspordia/", name="buildCitasPorDia", options={"expose"=true})
     * @Method("GET")
     *
     */
    public function buildCitasPorDiaAction() {
        $request = $this->getRequest();
        $idEspecialidad=$request->get('idEspecialidad')?$request->get('idEspecialidad'):0;
        //$em = $this->getDoctrine()->getManager();

        $report_name = "citasPorDia";
        $report_format = $request->get('format')?$request->get('format'):'PDF';
        $jasperReport = $this->container->get('jasper.build.reports');
        $jasperReport->setReportName($report_name);
        $jasperReport->setReportFormat($report_format);
        $jasperReport->setReportPath("/reports/siaps/citas/medicas/");
        $jasperReport->setReportParams(array('fechaInicial'=>$request->get('fechaInicio'),
                                             'fechaFinal'=>$request->get('fechaFin'),
                                             'id_especialidad'=>$idEspecialidad,
                                             'id_area_mod_estab'=>$request->get('idAreaModEstab'),
                                    ));

        return $jasperReport->buildReport();
    }

    /**
     * @Route("/buildcitasprocedimientopordia/", name="buildCitasProcedimientoPorDia", options={"expose"=true})
     * @Method("GET")
     *
     */
    public function buildCitasProcedimientoPorDiaAction() {
        $request = $this->getRequest();
        $idProcedimientoEstablecimiento=$request->get('idProcedimientoEstablecimiento')?$request->get('idProcedimientoEstablecimiento'):0;


        $report_name = "citasPorDia";
        $report_format = $request->get('format')?$request->get('format'):'PDF';
        $jasperReport = $this->container->get('jasper.build.reports');
        $jasperReport->setReportName($report_name);
        $jasperReport->setReportFormat($report_format);
        $jasperReport->setReportPath("/reports/siaps/citas/procedimientos/");
        $jasperReport->setReportParams(array('fechaInicial'=>$request->get('fechaInicio'),
                                             'fechaFinal'=>$request->get('fechaFin'),
                                             'id_procedimiento_establecimiento'=>$idProcedimientoEstablecimiento
                                    ));

        return $jasperReport->buildReport();
    }

    /**
     * @Route("/builCitasEliminadas/", name="builCitasEliminadas", options={"expose"=true})
     * @Method("GET")
     *
     */
    public function builCitasEliminadasAction() {
        $request = $this->getRequest();

        $report_name = "citasEliminadas";
        $report_format = $request->get('format')?$request->get('format'):'PDF';
        $jasperReport = $this->container->get('jasper.build.reports');
        $jasperReport->setReportName($report_name);
        $jasperReport->setReportFormat($report_format);
        $jasperReport->setReportPath("/reports/siaps/citas/medicas/");
        $jasperReport->setReportParams(array('fechaInicial'=>$request->get('fechaInicio'),
                                             'fechaFinal'=>$request->get('fechaFin')
                                    ));

        return $jasperReport->buildReport();
    }
}
?>
