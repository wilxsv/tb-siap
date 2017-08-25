<?php

//src/Minsal/SiapsBundle/Controller/CitEventoController.php

namespace Minsal\SiapsBundle\Controller;

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
use \Doctrine\ORM\Query;

class MntEventoController extends Controller {

    /**
     * @Route("/cargar/eventos/", name="cargar_eventos", options={"expose"=true})
     * @Method("POST")
     */
    public function cargarEventosAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');

        $datos = '';
        $condicion='';
        $nombreProcedimiento = '';
        $joinProcedimiento = '';
        parse_str($request->get('datos'), $datos);

        if($datos['claseEvento'] == 'med')
            $condicion=" AND A.es_evento_medico=true";
        else {
            $condicion=" AND A.es_evento_medico=false";
            $nombreProcedimiento = ",E.codigo||' '||E.procedimiento as procedimiento";
            $joinProcedimiento = "LEFT JOIN mnt_procedimiento_establecimiento D ON A.id_procedimiento_establecimiento=D.id
                                  LEFT JOIN mnt_ciq E ON D.id_ciq=E.id";
        }

        if($datos['idTipoevento']!='')
            $condicion.=" AND A.id_tipo_evento=".$datos['idTipoevento'];

        if($datos['idAreaModEstab']!='')
            $condicion.=" AND (A.id_area_mod_estab=".$datos['idAreaModEstab']." or A.id_area_mod_estab is null)";

        if($datos['idEmpleado']!='')
            $condicion.=" AND A.id_empleado=".$datos['idEmpleado'];

        if($datos['rango_fechas']!=''){
            list($fecha_inicio, $fecha_fin) = explode(' - ', $datos['rango_fechas']);
            $condicion.=" AND A.fecha_hora_ini::date >= '$fecha_inicio' AND A.fecha_hora_fin::date <= '$fecha_fin'";
        }
        else{
            $condicion.=" AND date_part('year',A.fecha_hora_ini)>=date_part('year',CURRENT_DATE)";
        }

        $sql = "SELECT A.id as id_evento,A.nombre as nombre,A.fecha_hora_ini as fechaini,A.fecha_hora_fin as fechafin,B.nombre as tipo_evento,C.nombreempleado $nombreProcedimiento
                FROM mnt_evento A
                INNER JOIN mnt_tipo_evento B ON A.id_tipo_evento=B.id
                LEFT JOIN mnt_empleado C ON A.id_empleado=C.id
                $joinProcedimiento
                WHERE true $condicion
                ORDER BY date_part('year',A.fecha_hora_ini) ASC,date_part('month',A.fecha_hora_ini) ASC,date_part('day',A.fecha_hora_ini) ASC,A.nombre";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        $fila=  array();
        $nombre_evento='';
        $fechaini='';
        $fechafin='';
        $i=0;
        $j=0;
        foreach ($result as $fila_evento){
            if($fila_evento['nombre']!=$nombre_evento || $fila_evento['fechaini']!=$fechaini || $fila_evento['fechafin']!=$fechafin){
                $i++;
                $j=0;
                $nombre_evento=$fila_evento['nombre'];
                $fechaini=$fila_evento['fechaini'];
                $fechafin=$fila_evento['fechafin'];
                $fila[$i]['nombre']=$fila_evento['nombre'];
                $fila[$i]['medico'][$j]=ucwords(strtolower($fila_evento['nombreempleado']));
                $fila[$i]['tipo_evento']=$fila_evento['tipo_evento'];
                $fila[$i]['fechaini']=$fila_evento['fechaini'];
                $fila[$i]['fechafin']=$fila_evento['fechafin'];
                $fila[$i]['id_evento']=$fila_evento['id_evento'];
                if($datos['claseEvento'] == 'proc'){
                    $fila[$i]['procedimiento']=$fila_evento['procedimiento'];
                }
            }  else {
                $j++;
                $fila[$i]['medico'][$j]=ucwords(strtolower($fila_evento['nombreempleado']));
            }
        }
        $response = $this->render('MinsalSiapsBundle:MntEvento:cargar_eventos.html.twig', array(
                    'action' => 'list',
                    'eventos'=> $fila,
                    'claseEvento'=> $datos['claseEvento']
        ));
        return $response;
    }
}
