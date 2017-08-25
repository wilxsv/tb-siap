<?php

//src/Minsal/CitasBundle/Controller/CitDistribucionProcedimientoController.php

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
use \Doctrine\ORM\Query;

class CitDistribucionProcedimientoController extends Controller {

    /**
     * @Route("/cargar/distribucion/procedimiento/medico/", name="cargar_distribucion_procedimiento_medico", options={"expose"=true})
     * @Method("POST")
     */
    public function cargarDistribucionProcedimiento() {

        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        $datos = '';
        parse_str($request->get('datos'), $datos);
        $fechaActual= new \DateTime();
        $dql = "SELECT A
                    FROM MinsalCitasBundle:CitDistribucionProcedimiento A
                    LEFT JOIN A.idEmpleado B
                    JOIN A.idAreaModEstab D
                    JOIN A.idProcedimientoEstablecimiento C
                    WHERE D.id=" . $datos['idAreaModEstab'];
        if ($datos['idEmpleado']){
            $dql.=" AND B.id=" . $datos['idEmpleado'];
        }

        if ($datos['idProcedimientoEstablecimiento']){
            $dql.=" AND C.id=" . $datos['idProcedimientoEstablecimiento'];
        }

        if ($datos['yrs']){
            $dql.=" AND A.yrs=" . $datos['yrs'];
        }else{
            $dql.=" AND A.yrs>=" . $fechaActual->format('Y');
        }

        if ($datos['mes']){
            $dql.=" AND A.mes=" . $datos['mes'];
        }
        $dql.=" ORDER BY A.yrs,A.mes,A.dia";

        $distribuciones = $em->createQuery($dql)
                ->getResult();

        return $this->render('MinsalCitasBundle:CitDistribucionProcedimiento:cargar_distribucion.html.twig', array(
                    'action' => 'list',
                    'distribuciones'=>$distribuciones
        ));
    }

    /**
     * @Route("/verificar/horario/distribucion/procedimiento/", name="verificar_horario_distribucion_procedimiento", options={"expose"=true})
     * @Method("GET")
     */
    public function verificarHorario() {

        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        $idEmpleado = $request->get('idEmpleado')?:NULL;
        $idProcedimientoEstablecimiento = $request->get('idProcedimientoEstablecimiento');
        $yrs = $request->get('yrs');
        $mes = $request->get('mes');
        $horario = $request->get('horario');
        $textoHorario = $request->get('textoHorario');
        $dia = $request->get('dia');
        $idDistribucion = $request->get('idDistribucion');
        $todosLosMeses = $request->get('todosLosMeses');
        $resultado = 'false';

        list($horaIni,$horaFin)=explode(' - ',$textoHorario);

        $condicion_empleado_sql = '';
        $condicion_empleado_dql = '';

        //Si se ha chequeado aplicar a todos los meses a partir de la fecha actual
        $distribucionProcedimientoActual=$em->getRepository('MinsalCitasBundle:CitDistribucionProcedimiento')->find($idDistribucion);
        
        if($todosLosMeses == 'false'){
            $mes=" AND A.mes=$mes";
            $idDistribucionABuscar="($idDistribucion)";
        }
        else {
            $mes=" AND A.mes>=$mes";

            $dql = "SELECT A
                    FROM MinsalCitasBundle:CitDistribucionProcedimiento A
                    WHERE A.yrs=$yrs" .
                    " AND A.idRangohora=".$distribucionProcedimientoActual->getIdRangohora()->getId().
                    " AND A.dia=" .$distribucionProcedimientoActual->getDia().
                    " AND A.cupos=".$distribucionProcedimientoActual->getCupos().
                    " AND A.maxCitasAgregadas=".$distribucionProcedimientoActual->getMaxCitasAgregadas().
                    " AND A.tiempoLecturaDias=".$distribucionProcedimientoActual->getTiempoLecturaDias().
                    " AND A.idAreaModEstab=".$distribucionProcedimientoActual->getIdAreaModEstab()->getId().
                    " AND A.idProcedimientoEstablecimiento=".$distribucionProcedimientoActual->getIdProcedimientoEstablecimiento()->getId().
                    " AND A.idEstadoDistribucion=1".
                    $mes;
            $distribucionesEncontradas = $em->createQuery($dql)
                    ->getResult();
            $idDistribucionABuscar='(';
            foreach ($distribucionesEncontradas as $encontradas) {
                $idDistribucionABuscar=$idDistribucionABuscar.$encontradas->getId().',';
            }
            $idDistribucionABuscar=substr($idDistribucionABuscar, 0, -1);
            $idDistribucionABuscar=$idDistribucionABuscar.')';

        }

        if(!is_null($idEmpleado)){
            //Consulta a la tabla distribuciones para buscar registros para ese horario
            $dql = "SELECT A
                    FROM MinsalCitasBundle:CitDistribucion A
                    WHERE A.idEmpleado= $idEmpleado ".
                    " AND A.yrs=$yrs" .
                    " AND A.idRangohora=$horario".
                    " AND A.dia=$dia" .
                    " AND A.idEstadoDistribucion=1".
                    $mes
                    ;

            $distribucion = $em->createQuery($dql)
            ->getResult();

            //Verificando si el horario seleccionado se traslapa con otro ya registrado en las distribuciones del médico
            $sql = "SELECT A.id,A.mes,A.id_aten_area_mod_estab,A.dia
                    FROM cit_distribucion A
                    INNER JOIN mnt_rangohora B ON A.id_rangohora=B.id
                    WHERE
                    A.id_empleado=$idEmpleado AND
                    A.yrs=$yrs AND
                    A.dia=$dia AND
                    A.id_estado_distribucion=1 AND
                    (to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM') OR
                    to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM'))
                    $mes
                    ";

            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->execute();
            $result_distr = $stm->fetchAll();
            $distribucion_traslape = count($result_distr);

            if(count($distribucion)>0){
                $resultado = 'distribucion-'.$distribucion[0]->getNombreMes().'|'.$distribucion[0]->getIdAtenAreaModEstab();
            }
            elseif ($distribucion_traslape>0){
                $especialidad = $em->find('MinsalCitasBundle:CitDistribucion',$result_distr[0]['id'])->getIdAtenAreaModEstab();
                $mes = $em->find('MinsalCitasBundle:CitDistribucion',$result_distr[0]['id'])->getNombreMes();
                $resultado = 'distribucion_traslape|'.$mes.'|'.$especialidad;
            }

            //formar condición para búsqueda en distribuciones de procedimientos
            $condicion_empleado_sql = " AND A.id_empleado=$idEmpleado";
            $condicion_empleado_dql = " AND A.idEmpleado=$idEmpleado";

        }

        //Consulta a la tabla distribuciones de procedimientos para buscar registros para ese horario
        $dql = "SELECT A
                FROM MinsalCitasBundle:CitDistribucionProcedimiento A
                WHERE  A.yrs=$yrs" .
                " AND A.idRangohora=$horario" .
                " AND A.dia=$dia" .
                " AND A.idEstadoDistribucion=1".
                " AND A.idProcedimientoEstablecimiento=".$distribucionProcedimientoActual->getIdProcedimientoEstablecimiento()->getId().
                " AND A.id NOT IN $idDistribucionABuscar".
                $mes .
                $condicion_empleado_dql
                ;

        $procedimiento = $em->createQuery($dql)
        ->getResult();

        //Verificando si el horario seleccionado se traslapa con otro ya registrado en las distribuciones de procedimientos del médico
        $sql = "SELECT A.id,A.mes,A.id_procedimiento_establecimiento
                FROM cit_distribucion_procedimiento A
                INNER JOIN mnt_rangohora B ON A.id_rangohora=B.id
                WHERE A.yrs=$yrs AND
                A.dia=$dia AND
                A.id_procedimiento_establecimiento=".$distribucionProcedimientoActual->getIdProcedimientoEstablecimiento()->getId()."
                AND A.id_estado_distribucion=1 AND
                (to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM') OR
                to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM'))
                AND A.id  NOT IN $idDistribucionABuscar
                $mes
                $condicion_empleado_sql
                ";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $result_proc = $stm->fetchAll();
        $procedimiento_traslape = count($result_proc);

        if(count($procedimiento)>0) {
            $resultado = 'procedimiento|'.$procedimiento[0]->getMonthName().'|'.$procedimiento[0]->getIdProcedimientoEstablecimiento();
        }
        elseif ($procedimiento_traslape>0) {
            $procedimiento = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$result_proc[0]['id_procedimiento_establecimiento'])->getIdProcedimientoEstablecimiento();
            $mes = $em->find('MinsalCitasBundle:CitDistribucionProcedimiento',$result_proc[0]['id'])->getMonthName();
            $resultado = 'procedimiento_traslape|'.$mes.'|'.$procedimiento;
        }

        return new Response(json_encode($resultado));
    }


}
