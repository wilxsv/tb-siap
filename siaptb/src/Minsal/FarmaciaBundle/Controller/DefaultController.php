<?php

namespace Minsal\FarmaciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /*
     * DESCRIPCIÓN: Pacientes referidos a farmacia especializada
     * PARAMETROS ENTRADA:
     *          datos        =>  array que contiene los valores del formulario
     *  PARAMETROS RETORNO:
     *          template  =>  Template de resultados de pacientes referidos a farmacia especializada
     * ANALISTA PROGRAMADOR: Karen Elvira Peñate
     */

        /**
        * @Route("/cargar/pacientes/derivados", name="cargar_pacientes_derivados", options={"expose"=true})
        * @Method("POST")
        */
       public function cargarDistribucion() {

           $em = $this->getDoctrine()->getManager();
           $request = $this->get('request');
           $datos = '';
           parse_str($request->get('datos'), $datos);
           $fechaActual= new \DateTime();
           $sql = "
           SELECT CONCAT_WS(' ',E.primer_nombre,E.segundo_nombre,E.tercer_nombre,E.primer_apellido,E.segundo_apellido,E.apellido_casada) as nombre_completo,
                   E.telefono_casa as contacto,
                   D.id as id_expediente,D.numero as numero_expediente,
                   to_char(A.fecha,'DD-MM-YYYY') as fecha_retiro,CONCAT_WS(' ',B.hora_ini,B.meridianoini,'-',B.hora_fin,B.meridianofin) as horario,
                   G.nombre as medicamento, F.cantidad as cantidad,
                   H.nombreempleado as medico,H.id as id_medico,
                   to_char(C.fechaconsulta,'DD-MM-YYYY') as fecha_consulta, C.id as id_historial_clinico,
                   J.nombre as especialidad,
                   C.idestablecimiento as id_establecimiento_prescribe,
                   K.nombre as establecimiento_prescribe,
                   L.nombre as establecimiento_despacha,
                   F.dosis as dosis
           FROM farm_recetas A INNER JOIN farm_rangohora B ON (A.id_rangohora=B.id)
               INNER JOIN sec_historial_clinico C ON (C.id=A.idhistorialclinico)
               INNER JOIN mnt_expediente D ON (C.id_numero_expediente=D.id)
               INNER JOIN mnt_paciente E ON (D.id_paciente=E.id)
               INNER JOIN farm_medicinarecetada F ON (F.idreceta=A.id)
               INNER JOIN farm_catalogoproductos G ON (F.idmedicina=G.id)
               INNER JOIN mnt_empleado H ON (C.id_empleado=H.id)
               INNER JOIN mnt_aten_area_mod_estab I ON (C.idsubservicio=I.id)
               INNER JOIN ctl_atencion J ON (I.id_atencion=J.id)
               INNER JOIN ctl_establecimiento K ON (K.id=C.idestablecimiento)
               INNER JOIN ctl_establecimiento L ON (F.id_establecimiento_despacha=L.id)
           WHERE A.id_rangohora IS NOT NULL AND F.id_establecimiento_despacha!=C.idestablecimiento";
           if($datos['fecha_inicio']!=''){
             $condicion=" AND A.fecha BETWEEN DATE('".$datos['fecha_inicio']."') AND DATE('".$datos['fecha_fin']."')";
           }else{
             $condicion=" AND C.fechaconsulta=DATE('".$datos['fecha_consulta']."') ";
           }
           $sql.=$condicion." ORDER BY A.fecha,id_rangohora,nombre_completo";

           $stm = $em->getConnection()->prepare($sql);
           $stm->execute();
           $result = $stm->fetchAll();
           $cuantos=array();
           $llave='';

           foreach ($result as $key => $value) {
             if(array_key_exists($value['numero_expediente'].'-'.$value['fecha_retiro'], $cuantos))
                $cuantos[$value['numero_expediente'].'-'.$value['fecha_retiro']]++;
             else
                $cuantos[$value['numero_expediente'].'-'.$value['fecha_retiro']]=1;
           }

           return $this->render('MinsalFarmaciaBundle:FarmEstados:cargar_pacientes.html.twig', array(
                    'pacientes'=>$result,
                    'cuantos'=>$cuantos

           ));
       }

       /*
        * DESCRIPCIÓN: Detalle de pacientes sin documento Identidad
        * PARAMETROS ENTRADA:
        *          NINGUNO
        *  PARAMETROS RETORNO:
        *          template  =>  Template de resultados de pacientes sin documento identidad que son
                                candidatos a envio de farmacia especialidad.
        * ANALISTA PROGRAMADOR: Karen Elvira Peñate
        */

           /**
           * @Route("/cargar/detalle/pacientes", name="cargar_detalle_pacientes", options={"expose"=true})
           * @Method("GET")
           */
          public function cargarDetallePacientes() {

              $em = $this->getDoctrine()->getManager();
              $sql = "SELECT DISTINCT(tb06.id),tb06.*,tb05.numero
              FROM
              sec_historial_clinico tb01
              JOIN farm_recetas tb02 ON (tb02.idhistorialclinico = tb01.id)
              JOIN farm_medicinarecetada tb03 ON (tb03.idreceta = tb02.id)
              JOIN mnt_expediente tb05 ON (tb05.id = tb01.id_numero_expediente)
              JOIN mnt_paciente tb06 ON (tb06.id = tb05.id_paciente)
              JOIN farm_catalogoproductos tb07 ON (tb07.id = tb03.idmedicina)
              JOIN farm_catalogoproductosxestablecimiento tb08 ON (tb07.id = tb08.idmedicina)
              WHERE (id_doc_ide_paciente NOT IN (1,11) OR id_doc_ide_paciente IS NULL) AND
              CAST(SPLIT_PART(fn_calcular_edad(tb06.id,'anio'),' ',1)as integer) >=18 AND CAST(SPLIT_PART(fn_calcular_edad(tb06.id,'anio'),' ',1)as integer)<=125 AND
              idsubservicio IN (
                 SELECT e.id FROM mnt_aten_area_mod_estab e
                 INNER JOIN ctl_atencion a ON (e.id_atencion = a.id)
                 INNER JOIN mnt_area_mod_estab area ON (e.id_area_mod_estab = area.id AND area.id_area_atencion = 1 AND area.id_servicio_externo_estab IS NULL)
                 INNER JOIN mnt_modalidad_establecimiento mod ON (area.id_modalidad_estab = mod.id AND mod.id_modalidad = 1)
                 WHERE a.id IN (9,11,12,13,14)
              ) AND
              tb08.medicamento_especializada = 1";
              $stm = $em->getConnection()->prepare($sql);
              $stm->execute();
              $result = $stm->fetchAll();

              return $this->render('MinsalFarmaciaBundle:FarmEstados:detalle_pacientes_sin_documento.html.twig', array(
                       'pacientes'=>$result

              ));
          }

}
