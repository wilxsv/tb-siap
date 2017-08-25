<?php

//src/Minsal/CitasBundle/Controller/CitCitasDiaController.php

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
use Minsal\CitasBundle\Entity\CitCitasDia;
use \Doctrine\ORM\Query;

class GeneralCitasController extends Controller {

    /*
     * DESCRIPCIÓN: Método que devuelve los horarios con cupos disponibles dependiendo de los
     *              parametros enviados.
     * ANALISTA PROGRAMADOR: Karen Peñate, Ing. Victoria López, Ing. Caleb Rodriguez
     */

    /**
     * @Route("/obtener/cupo/citas/", name="obtener_cupos_citas", options={"expose"=true})
     */
    public function obtenerCuposCitasMedicas() {
            $em                             = $this->getDoctrine()->getManager();
            $request                        = $this->getRequest();
            $idAreaModEstab                 = $request->get('idAreaModEstab');
            $idEspecialidad                 = $request->get('idEspecialidad')=='NULL'? NULL: $request->get('idEspecialidad');
            $idTipoCita                     = $request->get('idTipoCita')=='NULL'? NULL: $request->get('idTipoCita');;
            $idExpediente                   = $request->get('idExpediente');
            $idEmpleado                     = $request->get('idEmpleado')=='NULL'? NULL: $request->get('idEmpleado');;
            $fechaInicial                   = $request->get('fechaInicial');
            $fechaFinal                     = $request->get('fechaFinal')=='NULL'? NULL: $request->get('fechaFinal');
            $origenCita                     = $request->get('origenCita');
            $incluirAgregados               = $request->get('incluirAgregados')=='true'?TRUE:FALSE;
            $permitirMasCitas               = $request->get('citaIntegral')=='true'?TRUE:FALSE;
            $autoSeleccionarHorario         = $request->get('autoSeleccionarHorario')=='true'?TRUE:FALSE;
            $idProcedimientoEstablecimiento = $request->get('idProcedimientoEstablecimiento')=='NULL'? NULL: $request->get('idProcedimientoEstablecimiento');
            $idEstablecimientoReferencia    = $request->get('idEstablecimientoReferencia')=='NULL'? NULL: $request->get('idEstablecimientoReferencia');
            $numeroExpedienteReferencia     = $request->get('numeroExpedienteReferencia')=='NULL'? NULL: $request->get('numeroExpedienteReferencia');
            $idTipoDistribucion             = $request->get('idTipoDistribucion')=='0'? NULL: $request->get('idTipoDistribucion');
            $buscarSinTipoCita              = $request->get('buscarSinTipoCita')=='true'? TRUE:FALSE;
            $expedienteObject               = $em->getRepository('MinsalSiapsBundle:MntExpediente')->find($idExpediente);



            $citCitasDiaService = $this->container->get('cit_citas_dia.services');
            $citCitasProcedimientoService = $this->container->get('cit_citas_procedimientos.services');

            $cuposDisponibles     = $citCitasDiaService->obtenerCupoDisponible($idEmpleado, $idExpediente, $idTipoCita, $idEspecialidad, $idAreaModEstab,
                    $idProcedimientoEstablecimiento, $fechaInicial, $fechaFinal, $origenCita, $incluirAgregados, $autoSeleccionarHorario,array(), $permitirMasCitas,
                    TRUE,$idTipoDistribucion,$buscarSinTipoCita
            );

            $justificacionAgregados=$em->getRepository('MinsalCitasBundle:CitJustificacion')->findBy(array('idEstadoCita'=>6));
            $plantilla='';
            $otrasCitas=NULL;
            $fechaActual= new \DateTime();

            if($fechaInicial==$fechaActual->format('d/m/Y')){
                $otrasCitas=$origenCita=='1'?$citCitasDiaService->pacientePoseeCita($idExpediente, $fechaActual->format('d/m/Y'), $fechaActual->format('d/m/Y'),NULL):$citCitasProcedimientoService->pacientePoseeCita($idExpediente, $fechaActual->format('d/m/Y'), $fechaActual->format('d/m/Y'),NULL);
            }

            //SI ES UNO ES CITA MÉDICA
            if($origenCita=='1'){
                return $this->render('MinsalCitasBundle:CitasMedicas:cupos_disponibles.html.twig',
                array('cuposDisponibles' => $cuposDisponibles,
                     'idEmpleado'=> $idEmpleado,
                     'nombreMedico'=>$em->getRepository('MinsalSiapsBundle:MntEmpleado')->find($idEmpleado)->__toString(),
                     'idExpediente' => $idExpediente,
                     'idEspecialidad' => $idEspecialidad,
                     'nombreEspecialidad' => $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($idEspecialidad)->__toString(),
                     'idTipoCita' => $idTipoCita,
                     'justificacionAgregados'=> $justificacionAgregados,
                     'idEstablecimientoReferencia'=>$idEstablecimientoReferencia,
                     'numeroExpedienteReferencia'=>$numeroExpedienteReferencia,
                     'expedienteObject' => $expedienteObject,
                     'otrasCitasMismoDia'=>$otrasCitas
                ));
            }else{
                return $this->render('MinsalCitasBundle:CitCitasProcedimientos:cupos_disponibles.html.twig',
                array('cuposDisponibles' => $cuposDisponibles,
                     'idEmpleado'=> $idEmpleado,
                     'nombreMedico'=>$idEmpleado?$em->getRepository('MinsalSiapsBundle:MntEmpleado')->find($idEmpleado)->__toString():'-',
                     'idExpediente' => $idExpediente,
                     'idProcedimientoEstablecimiento' => $idProcedimientoEstablecimiento,
                     'nombreProcedimiento' => $em->getRepository('MinsalSiapsBundle:MntProcedimientoEstablecimiento')->find($idProcedimientoEstablecimiento)->__toString(),
                     'justificacionAgregados'=> $justificacionAgregados,
                     'idEstablecimientoReferencia'=>$idEstablecimientoReferencia,
                     'numeroExpedienteReferencia'=>$numeroExpedienteReferencia,
                     'expedienteObject' => $expedienteObject,
                     'otrasCitasMismoDia'=>$otrasCitas
                ));

            }
    }

    /*
     * DESCRIPCIÓN: Método que devuelve el resultado de la busqueda de produccion
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/cargar/produccion/citas/recurso", name="cargar_produccion_citas_recurso", options={"expose"=true})
     */
     public function cargarProduccionCitasRecursoAction() {
         $em        = $this->getDoctrine()->getManager();
         $request   = $this->getRequest();
         parse_str($request->get('datos'), $datos);
         $fechas=explode('-', $datos['rango_fechas']);
         $fechaInicial=$fechas[0];
         $fechaFin=$fechas[1];
         $idAreaModEstab=$datos['idAreaModEstab'];

         $sql = "SELECT *
                FROM (SELECT initcap(A.nombreempleado) as nombreempleado,
                		C.tipo as tipo_empleado,
                		(SELECT count(idusuarioreg)
                		FROM cit_citas_dia
                		WHERE idusuarioreg=B.id
                			AND date(fechahorareg) BETWEEN date('$fechaInicial') AND date('$fechaFin')
                			AND id_area_mod_estab=$idAreaModEstab
                		)
                		as citas_medicas,
                		(SELECT count(cit_citas_procedimientos.idusuarioreg)
                		FROM cit_citas_procedimientos
                			INNER JOIN cit_distribucion_procedimiento ON (cit_citas_procedimientos.id_distribucion_procedimiento=cit_distribucion_procedimiento.id AND id_area_mod_estab=$idAreaModEstab)
                		WHERE cit_citas_procedimientos.idusuarioreg=B.id
                		      AND date(cit_citas_procedimientos.fechahorareg) BETWEEN date('$fechaInicial') AND date('$fechaFin'))
                		as citas_procedimientos
                	FROM mnt_empleado A
                		INNER JOIN fos_user_user B ON (A.id=B.id_empleado)
                		INNER JOIN mnt_tipo_empleado C ON (C.id=A.id_tipo_empleado)
                	) t01
                WHERE t01.citas_medicas >0 OR t01.citas_procedimientos>0";
         $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
         $stm->execute();
         $resultados = $stm->fetchAll();


         return $this->render('MinsalCitasBundle:Reports:cargarProduccionRecurso.html.twig', array('produccion'=>$resultados));





    }




}
