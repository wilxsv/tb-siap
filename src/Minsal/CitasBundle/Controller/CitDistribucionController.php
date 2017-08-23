<?php

//src/Minsal/CitasBundle/Controller/CitDistribucionController.php

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

class CitDistribucionController extends Controller {

    /**
     * @Route("/cargar/distribucion/medico/", name="cargar_distribucion_medico", options={"expose"=true})
     * @Method("POST")
     */
    public function cargarDistribucion() {

        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        $datos = '';
        parse_str($request->get('datos'), $datos);
        $fechaActual= new \DateTime();
        $dql = "SELECT A
                    FROM MinsalCitasBundle:CitDistribucion A
                    JOIN A.idEmpleado B
                    JOIN A.idAtenAreaModEstab C
                    JOIN A.idAreaModEstab D
                    WHERE C.id=" . $datos['idAtenAreaModEstab'] . " AND
                    D.id=" . $datos['idAreaModEstab'];

        if ($datos['idEmpleado']){
            $dql.=" AND B.id=" . $datos['idEmpleado'];
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

        return $this->render('MinsalCitasBundle:CitDistribucion:cargar_distribucion.html.twig', array(
                    'action' => 'list',
                    'distribuciones'=>$distribuciones
        ));
    }

    /**
     * @Route("/verificar/horario/distribucion/", name="verificar_horario_distribucion", options={"expose"=true})
     * @Method("GET")
     */
    public function verificarHorario() {

        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        $idEmpleado = $request->get('idEmpleado');
        $idAtenAreaModEstab = $request->get('idAtenAreaModEstab');
        $yrs = $request->get('yrs');
        $mes = $request->get('mes');
        $horario = $request->get('horario');
        $textoHorario = $request->get('textoHorario');
        $dia = $request->get('dia');
        $idDistribucion = $request->get('idDistribucion');
        $todosLosMeses = $request->get('todosLosMeses');
        $resultado = 'false';

        list($horaIni,$horaFin)=explode(' - ',$textoHorario);

        //Si se ha chequeado aplicar a todos los meses a partir de la fecha actual
        if($todosLosMeses == 'false'){
            $mes=" AND A.mes=$mes";
            $idDistribucionABuscar="($idDistribucion)";
        }else {
            $mes=" AND A.mes>=$mes";//PARA BUSCAR EN TODOS LOS MESES RESTANTES
            //BUSCAR ESTA DISTRIBUCION PARA OBTENER LOS VALORES ORIGINALES
            $distribucionActual=$em->getRepository('MinsalCitasBundle:CitDistribucion')->find($idDistribucion);
            //BUSCAR LAS OTRAS DISTRUBUCIONES IGUALES A ELLA

            $dql = "SELECT A
                    FROM MinsalCitasBundle:CitDistribucion A
                    WHERE A.yrs=$yrs" .
                    " AND A.idRangohora=".$distribucionActual->getIdRangohora()->getId().
                    " AND A.dia=" .$distribucionActual->getDia().
                    " AND A.primera=".$distribucionActual->getPrimera().
                    " AND A.subsecuente=".$distribucionActual->getSubsecuente().
                    " AND A.maxCitasAgregadas=".$distribucionActual->getMaxCitasAgregadas().
                    " AND A.idConsultorio=".$distribucionActual->getIdConsultorio()->getId().
                    " AND A.idAtenAreaModEstab=".$distribucionActual->getIdAtenAreaModEstab()->getId().
                    " AND A.idEstadoDistribucion=1".
                    $mes;
            if($distribucionActual->getIdTipoDistribucion()){
                $dql.=" AND A.idTipoDistribucion=".$distribucionActual->getIdTipoDistribucion()->getId();
            }
            $distribucionesEncontradas = $em->createQuery($dql)
                    ->getResult();
            $idDistribucionABuscar='(';
            foreach ($distribucionesEncontradas as $encontradas) {
                $idDistribucionABuscar=$idDistribucionABuscar.$encontradas->getId().',';
            }
            $idDistribucionABuscar=substr($idDistribucionABuscar, 0, -1);
            $idDistribucionABuscar=$idDistribucionABuscar.')';
        }
        //Consulta a la tabla distribuciones para buscar registros para ese horario


        $dql = "SELECT A
                FROM MinsalCitasBundle:CitDistribucion A
                WHERE A.idEmpleado= $idEmpleado ".
                " AND A.yrs=$yrs" .
                " AND A.idRangohora=$horario".
                " AND A.dia=$dia" .
                " AND A.idEstadoDistribucion=1".
                " AND A.id NOT IN $idDistribucionABuscar".
                $mes;

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
                A.id NOT IN $idDistribucionABuscar AND
                (to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM') OR
                to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM')< to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM'))
                $mes
                ";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $result_distr = $stm->fetchAll();
        $distribucion_traslape = count($result_distr);

        //Consulta a la tabla distribuciones de procedimientos para buscar registros para ese horario
        $dql = "SELECT A
                FROM MinsalCitasBundle:CitDistribucionProcedimiento A
                WHERE A.idEmpleado=$idEmpleado ".
                " AND A.yrs=$yrs" .
                " AND A.idRangohora=$horario".
                " AND A.dia=$dia" .
                $mes
                ;

        $procedimiento = $em->createQuery($dql)
        ->getResult();

        //Verificando si el horario seleccionado se traslapa con otro ya registrado en las distribuciones de procedimientos del médico
        $sql = "SELECT A.id,A.mes,A.id_procedimiento_establecimiento
                FROM cit_distribucion_procedimiento A
                INNER JOIN mnt_rangohora B ON A.id_rangohora=B.id
                WHERE
                A.id_empleado=$idEmpleado AND
                A.yrs=$yrs AND
                A.dia=$dia AND
                (to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaIni', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM') OR
                to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') > to_timestamp(current_date || ' ' || B.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AND to_timestamp(current_date || ' ' || '$horaFin', 'YYYY-MM-DD HH12:MI:SS AM') < to_timestamp(current_date || ' ' || B.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM'))
                $mes
                ";
        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $result_proc = $stm->fetchAll();
        $procedimiento_traslape = count($result_proc);

        if(count($distribucion)>0){
            $resultado = 'distribucion|'.$distribucion[0]->getNombreMes().'|'.$distribucion[0]->getIdAtenAreaModEstab();
        }
        elseif ($distribucion_traslape>0){
            $especialidad = $em->find('MinsalCitasBundle:CitDistribucion',$result_distr[0]['id'])->getIdAtenAreaModEstab();
            $mes = $em->find('MinsalCitasBundle:CitDistribucion',$result_distr[0]['id'])->getNombreMes();
            $resultado = 'distribucion_traslape|'.$mes.'|'.$especialidad;
        }

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
