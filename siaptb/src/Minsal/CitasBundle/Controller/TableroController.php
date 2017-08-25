<?php
namespace Minsal\CitasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Minsal\CitasBundle\Entity\CitCitasDia;
use Minsal\CitasBundle\ClinicaSeleccion\Cseleccion;

/**
* Description of TableroController
*
* @author marvin
*/
class TableroController extends Controller {

    /**
     * @Route("/modalida/get", name="modalida", options={"expose"=true})
     * @Method("GET")
     */
    public function ModalidaAction() {
        try {
            $user               = $this->container->get('security.context')->getToken()->getUser();
            $em                 = $this->getDoctrine()->getManager();
            $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
            $establecimiento    = $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : ( $user->getIdEmpleado() ? ( $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId() ) : $CtlEstablecimiento->getId() );
            $request            = $this->getRequest();
            $id_modalida        = $request->get('idModalida');
            // Areas de atencion
            $data['data1'] = $this->getAtencionModalidad($id_modalida);

            /***************************************************************************
             * Muestra los medios de cada area de atencion, con la capacidad de citas  *
             * y el total de citas asignadas                                           *
             ***************************************************************************/
            $medicos = $this->getTodosMedicos($id_modalida, $establecimiento);

            if (empty($medicos)) {
                $data['data2'] = false;
            } else {
                $data['data2'] = $medicos;
            }

            return new Response(json_encode($data));
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @Route("/asigna_cita/get", name="asigna_cita", options={"expose"=true})
     * @Method("GET")
     */
    public function AsignaCitaAction() {
        try {
            $em                 = $this->getDoctrine()->getManager();
            $request            = $this->getRequest();
            $idMedico           = $request->get('medico');
            $prioridad          = $request->get('prioridad');
            $Idespecialida      = $request->get('especialida');
            $especialidadNombre = $request->get('especialidadNombre');
            $idExp              = $request->get('idExpediente');
            $estadoButon        = "";
            $tipoCita           = "";
            $idRangoHora        = "";
            $result_motivo      = "";
            $local              = "";
            $rangoHora          = "";
            $CapacidaCitaRango  = "";

            $idPaciente        = $this->getDoctrine()->getRepository('MinsalSiapsBundle:MntExpediente')->find($request->get('idExpediente'))->getIdPaciente()->getId();
            $historialPaciente = $this->getHistorialPaciente($idExp, $Idespecialida, $idMedico);

            $mntEmpleado         = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneById($idMedico);
            $mntAtenAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($Idespecialida);
            $numeroExpediente    = $this->getDoctrine()->getRepository('MinsalSiapsBundle:MntExpediente')->findOneBy(array('idPaciente' => $idPaciente))->getNumero();
            $IdExpediente        = $this->getDoctrine()->getRepository('MinsalSiapsBundle:MntExpediente')->findOneBy(array('idPaciente' => $idPaciente))->getId();

            $mntEmpleado     = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneById($idMedico);
            $result_medico   = $this->getDoctrine()->getRepository('MinsalSiapsBundle:MntEmpleado');
            $result_paciente = $this->getDoctrine()->getRepository('MinsalSiapsBundle:MntPaciente');
            $nombreEmpleado  = $result_medico->findOneBy(array('id' => $idMedico))->getNombreempleado();

            $nombrePaciente = $result_paciente->findOneBy(array('id' => $idPaciente))->getPrimerNombre() . " "
                            . $result_paciente->findOneBy(array('id' => $idPaciente))->getSegundoNombre() . " "
                            . $result_paciente->findOneBy(array('id' => $idPaciente))->getPrimerApellido() . " "
                            . $result_paciente->findOneBy(array('id' => $idPaciente))->getPrimerApellido();

            $fecha = date('l jS \of F Y ');
            $date = Date("Y-m-d");
            $hora = Date("H:i:s");

            /******************************************************************
             *   Obtener rango de hora y la capacidad de citas                *
             ******************************************************************/
            $resultRangoHora    = $this->getConsultarHora($idMedico, $Idespecialida, $date);
            $citCitasDiaService = $this->container->get('cit_citas_dia.services');
            $citcita['data1']   = $citCitasDiaService->getHorarioEmpleado($idMedico, $Idespecialida, $date, $date);

            if (empty($resultRangoHora)) {
                $data['msj'] = "Medico no poseer horario de atención mayor a la hora actual.";

                $estadoButon = 0;
            } else {
                // si el medico tiene horario de atencion
                if (!empty($citcita['data1'])) {
                    foreach ($resultRangoHora as $row) {
                        $rangoHora         = $row['rango_hora'];
                        $idRangoHora       = $row['id'];
                        $CapacidaCitaRango = $row['hrango'];
                    }

                    /*********************************************************************
                     *   Obtener numero de rangos de un medico el dia de hoy             *
                     *********************************************************************/
                    $conutRango = $this->getCountRango($idMedico, $Idespecialida, $date);

                    /**********************************************************************
                     *   Obtener numero de citas del rango de hora actual                 *
                     **********************************************************************/
                    $citasRangoHora = $this->getCitasRangoHora($idRangoHora, $idMedico, $Idespecialida);

                    /**************************************************************************************************
                    *   1 = Primera Vez son los pacientes que no estan registrados en el sistema (Demanda espontanea) *
                    *   2 = Subsecuenete: el paciente ya existe en el sistema(citados)                                *
                    *   5 = Agregadas (Sobrecupo)                                                                     *
                    ***************************************************************************************************/
                    if (isset($citasRangoHora)) {
                        if ($citasRangoHora >= $CapacidaCitaRango) {
                            if ($prioridad == 'Alta') {
                                $msjCupo       = "El total de cupos disponibles ha sido completado, la cita será creada como sobre cupo.";
                                $dql_motivo    = "SELECT ma.id AS id, ma.nombre AS motivo FROM MinsalCitasBundle:CitJustificacion ma";
                                $result_motivo = $em->createQuery($dql_motivo)->getArrayResult();
                                // $tipoCita = 2;
                                $estadoButon     = 1;
                                $data['msjCupo'] = $msjCupo;
                            }
                            // Selecciona el siguinete rengo de hora
                            elseif ($prioridad == 'Baja' or $prioridad == 'Media') {
                                // $msj3 = "El total de cupos disponibles ha sido completado, la cita será  creada en el siguiente rango de hora. ";

                                /***************************************************************************************
                                 *   Obtiene el sieguiente rango de hora con la capacidad, cuando el actual esta lleno *
                                 ***************************************************************************************/
                                $siguienteRango = $this->getRangoSiguiente($idMedico, $Idespecialida, $conutRango);

                                if (isset($siguienteRango)) {
                                    foreach ($siguienteRango as $row) {
                                        $rangoHora         = $row['rango_hora'];
                                        $idRangoHora       = $row['id_rango'];
                                        $CapacidaCitaRango = $row['hrango'];
                                    }
                                    /******************************************************
                                     *   Total de citas asignadas a un rango de hora      *
                                     ******************************************************/
                                    $citasRangoHora = $this->getCitasRangoHora($idRangoHora, $idMedico, $Idespecialida);

                                    if ($citasRangoHora >= $CapacidaCitaRango) {
                                        $msj2          = "El total de cupos disponibles ha sido completado, la cita será creada como sobre cupo. ";
                                        $dql_motivo    = "SELECT ma.id AS id, ma.nombre AS motivo FROM MinsalCitasBundle:CitJustificacion ma";
                                        $result_motivo = $em->createQuery($dql_motivo)->getArrayResult();
                                        $data['msj2']  = $msj2;
                                    }
                                } else {
                                    $msjCupo       = "El total de cupos disponibles ha sido completado, la cita será creada como sobre cupo. ";
                                    $dql_motivo    = "SELECT ma.id AS id, ma.nombre AS motivo FROM MinsalCitasBundle:CitJustificacion ma";
                                    $result_motivo = $em->createQuery($dql_motivo)->getArrayResult();
                                    // $tipoCita = 2;
                                    $estadoButon     = 1;
                                    $data['msjCupo'] = $msjCupo;
                                }
                            }
                        }

                        //  Obtener Consultorio
                        $dql_consultorio =
                            "SELECT t01.descripcion descripcion
                             FROM MinsalSiapsBundle:MntConsultorio  t01
                             JOIN MinsalCitasBundle:CitDistribucion t02 WITH(t01.id = t02.idConsultorio)
                             WHERE t02.idEmpleado = $idMedico
                                AND t02.idRangohora =$idRangoHora";

                        $result_consultorio = $em->createQuery($dql_consultorio)->getArrayResult();

                        foreach ($result_consultorio as $row) {
                            $local = $row['descripcion'];
                        }

                        if ($historialPaciente == 'FALSE') {
                            $tipoCita = 2;
                        } elseif ($historialPaciente == 'TRUE') {
                            $tipoCita = 1;
                        }
                    } else {
                        $data['msj'] = "Medico no disponible";
                    }
                }
            }

            $data['nExpe']       = $numeroExpediente;
            $data['priori']      = $prioridad;
            $data['fecha']       = $fecha;
            $data['rhora']       = $rangoHora;
            $data['paciente']    = $nombrePaciente;
            $data['medico']      = $nombreEmpleado;
            $data['local']       = $local;
            $data['nomEspe']     = $especialidadNombre;
            $data['idTipoCita']  = $tipoCita;
            $data['idEmp']       = $idMedico;
            $data['idRangoH']    = $idRangoHora;
            $data['idPriori']    = $request->get('idprioridad');
            $data['idPaciente']  = $idPaciente;
            $data['idEspe']      = $Idespecialida;
            $data['arrayMotivo'] = $result_motivo;

            return new Response(json_encode($data));
        } catch (\Exception $e) {

            $data['msj']="Falla al mostrar la cita";
            return new Response(json_encode($data));
            //echo $e->getMessage();
        }
    }

    /**
     * @Route("/agenda_dia/get", name="agenda_dia", options={"expose"=true})
     * @Method("GET")
     */
    public function Agende_DiaAction() {
        try {
            $em              = $this->getDoctrine()->getManager();
            $request         = $this->getRequest();
            $idMedico        = $request->get('medico');
            $idEspecialidad  = $request->get('especialidaId');
            $especialidad    = $request->get('espe');
            $result_empleado = $this->getDoctrine()->getRepository('MinsalSiapsBundle:MntEmpleado');
            $nombreEmpleado  = $result_empleado->findOneBy(array('id' => $idMedico))->getNombreempleado();
            $estadoButon     = 1;
            $date            = Date("Y-m-d");

            /******************************************************************
             *   Obtener rango de hora y la capacidad de citas                *
             ******************************************************************/
            $resultRangoHora = $this->getConsultarHora($idMedico, $idEspecialidad , $date);

            if (empty($resultRangoHora)) {
                $estadoButon = 0;
            }

            /*****************************************
             *    Citas diarias                      *
             *****************************************/
            $sql =
                "SELECT cd.id AS idcita,
                        ex.numero AS numero_expediente,
                        CONCAT( CONCAT( CONCAT_WS(' ',p.primer_apellido, p.segundo_apellido, p.apellido_casada), ', ' ), CONCAT_WS(' ',p.primer_nombre, p.segundo_nombre, p.tercer_nombre) ) AS paciente,
                        TO_CHAR(cd.fecha, 'DD/MM/YYYY') AS fecha,
                        ec.estado AS estado,
                        pr.nombre AS prioridad,
                        TO_CHAR(rh.hora_ini,'HH12:MI:SS AM') rangohora
                FROM cit_citas_dia      cd
                JOIN cit_estado_cita    ec ON (ec.id = cd.id_estado AND cd.fecha = CURRENT_DATE)
                JOIN mnt_expediente     ex ON (ex.id = cd.id_expediente)
                JOIN mnt_paciente       p  ON ( p.id = ex.id_paciente AND cd.id_empleado = :idempleado AND cd.id_aten_area_mod_estab = :idEspecialidad)
                JOIN mnt_rangohora      rh ON (rh.id = cd.id_rangohora)
                LEFT JOIN ctl_prioridad pr ON (pr.id = cd.id_prioridad)
                ORDER BY rh.hora_ini, pr.id";

            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->bindValue(':idempleado', $idMedico);
            $stm->bindValue('idEspecialidad', $idEspecialidad);
            $stm->execute();
            $result_citas = $stm->fetchAll();

            $data['cita']           = $result_citas;
            $data['Idempleado']     = $idMedico;
            $data['empleado']       = $nombreEmpleado;
            $data['especialidadId'] = $idEspecialidad;
            $data['especialidad']   = $especialidad;
            $data['estadoBoton']    = $estadoButon;

            return new Response(json_encode($data));
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getConsultarHora($idEmpleado, $Idespecialida, $date) {
        try {
            $em             = $this->container->get('doctrine')->getManager();
            $fecha          = new \DateTime($date);
            $idAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($Idespecialida)->getIdAreaModEstab()->getId();

            list($horas, $minutos, $segundos) = explode(':', Date("H:i:s"));
            $hora = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;

            /************************************************************
             *   Obtener rango de hora y la capacidad de citas,         *
             *   si la hora actual se encuentra dentro del rango        *
             ************************************************************/
            $sql_hora =
                "SELECT t02.id,
                        TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM') AS hora_ini,
                        TO_CHAR(t02.hora_fin, 'HH12:MI:SS AM') AS hora_fin,
                        CONCAT(TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM'),' - ',TO_CHAR(t02.hora_fin, 'HH12:MI:SS AM')) AS rango_hora,
                        SUM(t01.subsecuente+t01.primera) AS hrango
                FROM cit_distribucion    t01
                INNER JOIN mnt_rangohora t02 ON (t02.id = t01.id_rangohora)
                WHERE t01.id_empleado              = :idEmpleado
                    AND t01.id_aten_area_mod_estab = :idAtenAreaModEstab
                    AND t01.id_area_mod_estab      = :idAreaModEstab
                    AND t01.dia                    = :dia
                    AND t01.mes                    = :mes
                    AND t01.yrs                    = :yrs
                    AND '$hora' BETWEEN THEN EXTRACT(EPOCH FROM t02.hora_ini)::INTEGER AND EXTRACT(EPOCH FROM t02.hora_fin)::INTEGER
                GROUP BY t02.id,t01.id
                ORDER BY t02.hora_ini";

            $stm = $this->container->get('database_connection')->prepare($sql_hora);
            $stm->bindValue(':idEmpleado', $idEmpleado);
            $stm->bindValue(':idAtenAreaModEstab', $Idespecialida);
            $stm->bindValue(':idAreaModEstab', $idAreaModEstab);
            $stm->bindValue(':dia', date("w", $fecha->getTimestamp()) + 1);
            $stm->bindValue(':mes', date("n", $fecha->getTimestamp()));
            $stm->bindValue(':yrs', date("Y", $fecha->getTimestamp()));
            $stm->execute();
            $result = $stm->fetchAll();

            /*******************************************************************
             *  Si la hora no esta dentro de un rango de hora,                 *
             *  obtiene el rango de hora mas proxiomo y la capacidad de citas  *
             *******************************************************************/
            if (empty($result)) {
                $sql_horaProxima =
                    "SELECT MIN (EXTRACT(EPOCH FROM t02.hora_ini)::INTEGER) AS rango1,
                            t02.id,
                            TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM') AS hora_ini,
                            TO_CHAR(t02.hora_fin, 'HH12:MI:SS AM') AS hora_fin,
                            CONCAT(TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM'),' - ',TO_CHAR(t02.hora_fin, 'HH12:MI:SS AM')) AS rango_hora,
                            SUM(t01.subsecuente+t01.primera) AS hrango
                    FROM cit_distribucion    t01
                    INNER JOIN mnt_rangohora t02 ON (t02.id = t01.id_rangohora)
                    WHERE t01.id_empleado              = :idEmpleado
                        AND t01.id_aten_area_mod_estab = :idAtenAreaModEstab
                        AND t01.id_area_mod_estab      = :idAreaModEstab
                        AND t01.dia                    = :dia
                        AND t01.mes                    = :mes
                        AND t01.yrs                    = :yrs
                        AND EXTRACT(EPOCH FROM t02.hora_ini)::INTEGER > '$hora'
                GROUP BY t02.id,t01.id
                ORDER BY t02.hora_ini limit 1";

                $stm = $this->container->get('database_connection')->prepare($sql_horaProxima);
                $stm->bindValue(':idEmpleado', $idEmpleado);
                $stm->bindValue(':idAtenAreaModEstab', $Idespecialida);
                $stm->bindValue(':idAreaModEstab', $idAreaModEstab);
                $stm->bindValue(':dia', date("w", $fecha->getTimestamp()) + 1);
                $stm->bindValue(':mes', date("n", $fecha->getTimestamp()));
                $stm->bindValue(':yrs', date("Y", $fecha->getTimestamp()));
                $stm->execute();
                $result = $stm->fetchAll();
            }

            return $result;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @Route("/area_atencion/get", name="area_atencion", options={"expose"=true})
     * @Method("GET")
     */
    public function AreaAtencionction() {
        try {
            $em                 = $this->getDoctrine()->getManager();
            $session            = $this->container->get('session');
            $request            = $this->getRequest();
            $idEspecialida      = $request->get('especialida');
            $user               = $this->container->get('security.context')->getToken()->getUser();
            $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
            $establecimiento    = $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : ( $user->getIdEmpleado() ? ( $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId() ) : $CtlEstablecimiento->getId() );
            $idModalidad        = $request->get('idmodalidad');

            if($idModalidad == "") {
                $idEsp       = $session->get('_idEmpEspecialidadEstab');
                $idModalidad = $this->getDoctrine()->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($idEsp)->getIdAreaModEstab()->getIdModalidadEstab()->getIdModalidad()->getId();
            }

            if ($idEspecialida == 0) {
                // Lista todos los medicos de una modalidad, para el caso donde elija todos.
                $result_medico_area = $this->getTodosMedicos($idModalidad, $establecimiento);

                if (empty($result_medico_area)) {
                    echo '<div class="alert alert-info" role="alert" ><span style="font-size:18px;"><strong> <i class="fa fa-info-circle fa-lg"></i> </strong> Modalidad sin médico asignado para el dia de hoy.</span></div>';
                }
            } else {
                if (empty($request->get('idmodalidad'))) {
                    $idModalidad = 1;
                }

                $fecha = Date("Y-m-d");

                $sql =
                    "WITH Medicos AS (
                        SELECT aame.id AS id_servicio,a.nombre AS servicio,em.nombreempleado AS nombre, em.id as id_empleado
                        FROM mnt_empleado_especialidad_estab  est
                        JOIN mnt_empleado                     em   ON (em.id = est.id_empleado)
                        JOIN mnt_aten_area_mod_estab          aame ON (aame.id = est.id_aten_area_mod_estab AND aame.id_establecimiento = :idestablecimiento)
                        JOIN ctl_atencion                     a    ON (a.id = aame.id_atencion AND aame.id = :idEspecialidad)
                        JOIN mnt_area_mod_estab               ame  ON (ame.id = aame.id_area_mod_estab)
                        JOIN mnt_modalidad_establecimiento    me   ON (me.id = ame.id_modalidad_estab)
                        AND me.id_modalidad=:idmodalidad ),
                    Capacidad AS (
                        SELECT TO_CHAR(t01.date, 'YYYY/MM/DD') AS date,
                               COALESCE(t02.primera_vez, 0) AS primera_vez,
                               COALESCE(t02.subsecuentes, 0) AS subsecuentes,
                               COALESCE(t02.agregados, 0) AS agregados,
                               id_empleado,
                               idEspecialidad
                        FROM (
                            SELECT serie::date AS date, EXTRACT(DOW FROM serie) AS DOW
                            FROM generate_series ('$fecha'::timestamp, '$fecha'::timestamp, '1 day'::interval) serie) t01
                        LEFT OUTER JOIN (
                            SELECT d.yrs,
                                   d.mes,
                                   d.dia,
                                   d.id_empleado,
                                   t03.id idEspecialidad,
                                   SUM(primera) AS primera_vez,
                                   SUM(subsecuente) AS subsecuentes,
                                   SUM(max_citas_agregadas) AS agregados
                            FROM cit_distribucion d
                            JOIN mnt_area_mod_estab t02 ON t02.id=d.id_area_mod_estab
                            JOIN mnt_aten_area_mod_estab t03 ON t02.id=t03.id_area_mod_estab AND t03.id=d.id_aten_area_mod_estab
                            GROUP BY d.yrs,d.mes,d.dia,d.id_empleado,t03.id
                            ORDER BY yrs, mes, dia) t02 ON (t02.yrs = EXTRACT(YEAR FROM t01.date::timestamp) AND t02.mes = EXTRACT(MONTH FROM t01.date::timestamp) AND t02.dia = EXTRACT(DOW FROM t01.date::timestamp))
                        ORDER BY date),
                    CitasAtendidas AS (
                        SELECT TO_CHAR(t05.date, 'YYYY/MM/DD') AS date,
                               COALESCE(t06.primeraVez,0) AS primera_vez,
                               COALESCE(t06.subsecuentes,0) AS subsecuentes,
                               COALESCE(t06.agregados,0) AS agregados,
                               COALESCE(t06.totalCitas,0) AS total_citas,
                               COALESCE(t06.atendidos,0) AS atendidos,
                               t06.id_empleado id_empleado,
                               t06.idEspecialidad idEspecialidad
                        FROM (
                            SELECT serie::date AS date
                            FROM generate_series ('$fecha'::timestamp,'$fecha'::timestamp, '1 day'::interval) serie) t05
                        LEFT OUTER JOIN (
                            SELECT DISTINCT t01.id_aten_area_mod_estab As idEspecialidad,t01.fecha as date,
                                   SUM((CASE WHEN t01.id_tipocita = 1 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as primeraVez,
                                   SUM((CASE WHEN t01.id_tipocita = 2 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as subsecuentes,
                                   SUM(CASE WHEN t01.id_estado = 6 THEN 1 ELSE 0 END) as agregados,
                                   COUNT(t01.id_tipocita) as totalCitas,
                                   t03.id id_empleado,
                                   SUM((CASE WHEN t01.id_estado = 5 THEN 1 ELSE 0 END) + (CASE WHEN t01.id_estado = 7 THEN 1 ELSE 0 END)) atendidos
                            FROM cit_citas_dia        t01
                            INNER JOIN mnt_expediente t02 ON (t01.id_expediente = t02.id)
                            INNER JOIN mnt_empleado   t03 ON (t01.id_empleado   = t03.id)
                            WHERE t01.fecha >= '$fecha' AND t01.fecha<= '$fecha'
                                AND t01.id_estado <> 3
                            GROUP BY t01.id_aten_area_mod_estab,t01.fecha,t03.id) t06 ON (t05.date = t06.date)
                            ORDER BY date)

                    SELECT t01.id_servicio AS id_servicio,
                           servicio,
                           t08.id_empleado AS id_empleado,
                           UPPER(t01.nombre) nombre_empleado,
                           SUM(t08.primera_vez+t08.subsecuentes) AS capacidad,
                           t03.total_citas AS total_citas,
                           COALESCE((SUM(t08.primera_vez+t08.subsecuentes)-t03.total_citas), SUM(t08.primera_vez+t08.subsecuentes)) AS can_disponible
                    FROM Medicos t01 inner join Capacidad t08 ON t08.id_empleado=t01.id_empleado AND t08.idespecialidad=t01.id_servicio
                    LEFT JOIN CitasAtendidas t03 ON t03.id_empleado=t01.id_empleado AND t03.idEspecialidad=t08.idEspecialidad
                    GROUP BY t01.id_servicio,t01.id_empleado,servicio, t08.id_empleado, t01.nombre,t03.total_citas
                    ORDER BY can_disponible DESC";

                $stm = $this->container->get('database_connection')->prepare($sql);
                $stm->bindValue(':idestablecimiento', $establecimiento);
                $stm->bindValue(':idEspecialidad', $idEspecialida);
                $stm->bindValue(':idmodalidad', $idModalidad);

                $stm->execute();
                $result_medico_area = $stm->fetchAll();
                if (empty($result_medico_area)) {
                    echo' <div class="alert alert-info" role="alert"><span style="font-size:18px;"><strong> <i class="fa fa-info-circle fa-lg"></i> </strong> Área de atención sin médico asignado el dia de hoy.</span></div>';
                }
            }

            return $this->render('MinsalCitasBundle:ClinicaSeleccion:medico_area.html.twig',array('medicos' => $result_medico_area,'idEspe' => $idEspecialida));
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @Route("/crear_cita/get", name="crear_cita", options={"expose"=true})
     * @Method("GET")
     */
    public function Crear_CitaAction() {
        try {
            $em                 = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction();
            $request            = $this->getRequest();
            $today              = new \DateTime();
            $ipcita             = $request->server->get('REMOTE_ADDR');
            $Idespecialida      = $request->get('Idespecialida');
            $idEmpleado         = $request->get('idEmpleado');
            $id_Prioridad       = $request->get('id_prioridad');
            $idRangoh           = $request->get('idRangohora');
            $expediente         = $request->get('expediente');
            $idPaciente         = $request->get('IdPaciente');
            $id_Tipocita        = $request->get('idTipocita');
            $id_justificacion          = $request->get('motivo');
            $MotivoConsulta     =$request->get('motivoCons');
            $usuario            = $this->container->get('security.context')->getToken()->getUser();
            $id_establecimiento = $usuario->getIdEmpleado()->getIdEstablecimiento()->getId();
            $id_Expediente      = $this->getDoctrine()->getRepository('MinsalSiapsBundle:MntExpediente')->findOneBy(array('numero' => $expediente))->getId();

            $CitasDia = new CitCitasDia();

            $Idestablecimiento   = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->find($id_establecimiento);
            $mntEmpleado         = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->find($idEmpleado);
            $mntAtenAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($Idespecialida);
            $idExpediente        = $em->getRepository('MinsalSiapsBundle:MntExpediente')->find($id_Expediente);
            $idRangohora         = $em->getRepository('MinsalSiapsBundle:MntRangohora')->find($idRangoh);
            $idTipocita          = $em->getRepository('MinsalCitasBundle:CitTipocita')->find($id_Tipocita);
            $idEstado            = $em->getRepository('MinsalCitasBundle:CitEstadoCita')->find(1);
            $idPrioridad         = $em->getRepository('MinsalCitasBundle:CtlPrioridad')->find($id_Prioridad);
            $idAtenAreaModEstab  = $mntAtenAreaModEstab->getIdAreaModEstab();

            $pacienteCitado = json_decode($this->getPacienteCita($idPaciente, $idEmpleado, $idRangoh, $idPrioridad->getId()));

            // sino esta bacio
            if (!empty($pacienteCitado->msj)) {
                $data['msj1'] = $pacienteCitado->msj;
            } else if (!empty($pacienteCitado->paciente)) {
                $CitasDia->setIdTipocita($idTipocita);
                $CitasDia->setIdAtenAreaModEstab($mntAtenAreaModEstab);
                $CitasDia->setIdEstado($idEstado);
                $CitasDia->setFecha($today);
                $CitasDia->setIdusuarioreg($usuario);
                $CitasDia->setFechahorareg($today);
                $CitasDia->setIpcita($ipcita);
                $CitasDia->setIdEmpleado($mntEmpleado);
                $CitasDia->setIdExpediente($idExpediente);
                $CitasDia->setIdEstablecimiento($Idestablecimiento);
                $CitasDia->setIdRangohora($idRangohora);
                $CitasDia->setIdAreaModEstab($idAtenAreaModEstab);
                $CitasDia->setIdPrioridad($idPrioridad);
                $CitasDia->setCitaPor($MotivoConsulta);

                if (Isset($id_justificacion)) {
                    $idMotivo = $em->getRepository('MinsalCitasBundle:CitJustificacion')->find($id_justificacion);
                    $CitasDia->setIdJustificacion($idMotivo);
                }

                $em->persist($CitasDia);
                $em->flush();

                $data['msj2'] = "Cita asignada exitosamente";
            } else if (!empty($pacienteCitado->idCita)) {
                // Actualizar cita
                $cita = $em->getRepository('MinsalCitasBundle:CitCitasDia')->find($pacienteCitado->idCita);
                $cita->setIdAtenAreaModEstab($mntAtenAreaModEstab);
                $cita->setIdEmpleado($mntEmpleado);
                $cita->setIdRangohora($idRangohora);
                $cita->setIdAreaModEstab($idAtenAreaModEstab);
                $cita->setIdPrioridad($idPrioridad);
                $cita->setIdTipocita($idTipocita);
                $cita->setIdusuarioreg($usuario);
                $cita->setIpcita($ipcita);
                $cita->setIdusuarioreg($usuario);
                $cita->setCitaPor($MotivoConsulta);
                $em->flush();

                $data['msj2'] = "Cita asignada exitosamente";
            }

            $em->getConnection()->commit();
            return new Response(json_encode($data));
        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $data['msj3'] = $e->getMessage();
            return new Response(json_encode($data));
        }
    }

    public function getHistorialPaciente($idExpediente, $idEspecialidad, $idEmpleado) {
        /** Si es primera vez en el Establecimiento (para Seguimiento Clínico) **/
        $em           = $this->getDoctrine()->getManager();
        $expediente   = $em->getRepository("MinsalSiapsBundle:MntExpediente")->find($idExpediente);
        $especialidad = $em->getRepository("MinsalSiapsBundle:MntAtenAreaModEstab")->find($idEspecialidad);
        $antecedentes = $em->getRepository('MinsalSeguimientoBundle:SecAntecedentes')->findOneBy(array('idPaciente' => $expediente->getIdPaciente()));

        /** Saber si es primera vez en la especialidad **/
        $historialClinico = $em->getRepository("MinsalSeguimientoBundle:SecHistorialClinico")->obtenerHistorialClinico($idEmpleado, $idExpediente, $idEspecialidad);
        if (count($historialClinico) > 0) {
            /* VERIFICAR QUE HAYA PASADO UN AÑO DESDE SU ULTIMA ACTUALIZACIÓN */
            $paciente = $expediente->getIdPaciente()->getId();

            $dql = "SELECT B.id,DATE_DIFF(CURRENT_DATE(),A.fecha) diferencia
                    FROM MinsalSeguimientoBundle:SecAntecedentesEspecialidadForm A
                    JOIN MinsalSeguimientoBundle:SecAntecedentes B WITH (A.idAntecedentes = B.id)
                    JOIN B.idPaciente C
                    JOIN A.idAtenAreaModEstab D
                    WHERE C.id=$paciente AND D.id=$idEspecialidad
                    ORDER BY A.fecha DESC";

            $resultado = $em->createQuery($dql)->getResult();

            if (empty($resultado)) {
                $primeraVez = 'TRUE';
            } else if ($resultado[0]['diferencia'] < 365) {
                $primeraVez = 'FALSE';
            } else {
                $primeraVez = 'TRUE';
            }
        } else {
            $primeraVez = 'TRUE';
        }

        return $primeraVez;
    }

    public function getPacienteCita($idPaciente, $idMedico, $idRangoHora, $idPrioridad) {
        $user               = $this->container->get('security.context')->getToken()->getUser();
        $em                 = $this->getDoctrine()->getManager();
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $establecimiento    = $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : ( $user->getIdEmpleado() ? ( $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId() ) : $CtlEstablecimiento->getId() );

        /** Si el paciente tiene cita hoy con el mismo medico * */
        $em = $this->getDoctrine()->getManager();

        $dql_agenda_dia =
            "SELECT a.nombre AS servicio, ex.numero  numero_expediente, IDENTITY(cd.idPrioridad) IdPrioridad,
                    cd.fecha fecha, ec.estado  estado, TO_CHAR(rh.horaIni, 'HH12:MI:SS AM') AS rangohora
            FROM MinsalCitasBundle:CitCitasDia cd
            JOIN MinsalCitasBundle:CitEstadoCita ec ON (ec.id=cd.idEstado AND cd.fecha= CURRENT_DATE AND cd.idEmpleado=$idMedico)
            JOIN MinsalSiapsBundle:MntExpediente ex ON (ex.id=cd.idExpediente)
            JOIN MinsalSiapsBundle:MntRangohora rh ON (rh.id=cd.idRangohora)
            JOIN MinsalSiapsBundle:MntPaciente p ON (p.id=ex.idPaciente AND ex.idPaciente=$idPaciente AND cd.idRangohora=$idRangoHora)
            JOIN MinsalSiapsBundle:MntAtenAreaModEstab aame WHERE aame.id=cd.idAtenAreaModEstab
            JOIN MinsalSiapsBundle:CtlAtencion a WHERE a.id=aame.idAtencion";

        $result_pacienta = $em->createQuery($dql_agenda_dia)->getArrayResult();

        /*******************************************************************************
        *   si el paciente tiene cita programada hoy y el estado de cita es diferente  *
        *   5 y diferente 3 (Atendida y anulada respectivamente)                       *
        ********************************************************************************/
        list($horas, $minutos, $segundos) = explode(':', Date("H:i:s"));
        $hora = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;

        $sql =
            "SELECT cd.id id_cita ,a.nombre AS servicio, ex.numero  numero_expediente,
                    cd.fecha fecha, ec.estado  estado, TO_CHAR(rh.horaIni, 'HH12:MI:SS AM') AS rangohora,
                    EXTRACT(EPOCH FROM rh.hora_ini)::INTEGER,EXTRACT(EPOCH FROM rh.hora_fin)::INTEGER
            FROM cit_citas_dia cd
            JOIN cit_estado_cita ec ON ec.id=cd.id_estado AND cd.fecha= CURRENT_DATE AND cd.id_establecimiento=:idestablecimiento AND ec.id<>5 AND ec.id<>3
            JOIN mnt_expediente ex on ex.id=cd.id_expediente
            JOIN mnt_rangohora rh on rh.id=cd.id_rangohora
            JOIN mnt_paciente p on p.id=ex.id_paciente AND ex.id_paciente=:idPaciente
            JOIN mnt_aten_area_mod_estab aame on aame.id=cd.id_aten_area_mod_estab
            JOIN ctl_atencion a on a.id=aame.id_atencion AND EXTRACT(EPOCH FROM rh.hora_fin)::INTEGER >= '$hora'";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idestablecimiento', $establecimiento);
        $stm->bindValue(':idPaciente', $idPaciente);
        $stm->execute();
        $paciente_cita = $stm->fetchAll();

        if (count($result_pacienta) > 0) {
            //  $citado = 1;
            foreach ($result_pacienta as $row) {
                $servicio   = $row['servicio'];
                // $hora       = $row['rangohora'];
                $expediente = $row['numero_expediente'];
                $IdPriori   =$row['IdPrioridad'];

            }

            // Modificar si la prioridad es diferente aunque tenga cita a la misma hora con el mismo medico
            if($idPrioridad!=$IdPriori) {
                foreach ($paciente_cita as $row) {
                    $data['idCita'] = $row['id_cita'];
                }
            } else {
                $data['msj'] = 'El paciente con expediente: <strong>' . $expediente . '</strong>, ya posee una cita con este medico, en esta especialidad.';
            }
        } else if (count($paciente_cita) > 0) {
            foreach ($paciente_cita as $row) {
                $data['idCita'] = $row['id_cita'];
            }
        } else {
            $data['paciente'] = true;
        }

        return json_encode($data);
    }

    /**
     * @Route("/area_modalida/get", name="area_modalida", options={"expose"=true})
     * @Method("GET")
     */
    public function AreaModalidaAction() {
        try {
            $request            = $this->getRequest();
            $idModalida         = $request->get('idModalida');
            $user               = $this->container->get('security.context')->getToken()->getUser();
            $em                 = $this->getDoctrine()->getManager();
            $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
            $establecimiento    = $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : ( $user->getIdEmpleado() ? ( $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId() ) : $CtlEstablecimiento->getId() );

            $sql =
                "SELECT t02.id id_especialidad,
                        CASE WHEN t02.nombre_ambiente IS NOT NULL
                            THEN
                                CASE WHEN id_servicio_externo_estab IS NOT NULL
                                    THEN t05.abreviatura ||'-->' ||t02.nombre_ambiente
                                    ELSE t02.nombre_ambiente
                                END
                            ELSE
                                CASE WHEN id_servicio_externo_estab IS NOT NULL
                                        THEN t05.abreviatura ||'--> ' || t01.nombre
                                    WHEN not exists (select nombre_ambiente from mnt_aten_area_mod_estab where nombre_ambiente=t01.nombre)
                                        THEN t01.nombre
                            END
                        END AS servicio
                FROM  ctl_atencion                  		    t01
                INNER JOIN mnt_aten_area_mod_estab              t02 ON (t01.id = t02.id_atencion AND t01.id_tipo_atencion != 4)
                INNER JOIN mnt_area_mod_estab             	    t03 ON (t03.id = t02.id_area_mod_estab)
                LEFT  JOIN mnt_servicio_externo_establecimiento t04 ON (t04.id = t03.id_servicio_externo_estab)
                LEFT  JOIN mnt_servicio_externo             	t05 ON (t05.id = t04.id_servicio_externo)
                LEFT  JOIN mnt_modalidad_establecimiento 	    t06 ON (t06.id = t03.id_modalidad_estab)
                WHERE t02.id_establecimiento = :idestablecimiento
                    AND t03.id_area_atencion = 1
                    AND t06.id_modalidad = :idModalidad
                ORDER BY 2";

            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->bindValue(':idestablecimiento', $establecimiento);
            $stm->bindValue(':idModalidad', $idModalida);
            $stm->execute();
            $result_atencion = $stm->fetchAll();

            return $this->render('MinsalCitasBundle:ClinicaSeleccion:agenda_dia.html.twig', array('agendaDia' => $result_agenda_dia, 'empleado' => $nombreEmpleado));
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCitasRangoHora($IdRangoHora, $idEmpleado, $Idespecialida) {
        try {
            $em                 = $this->getDoctrine()->getManager();
            $citaRangoHora      = "";
            $user               = $this->container->get('security.context')->getToken()->getUser();
            $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
            $establecimiento    = $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : ( $user->getIdEmpleado() ? ( $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId() ) : $CtlEstablecimiento->getId() );
            $idAreaModEstab     = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($Idespecialida)->getIdAreaModEstab()->getId();

            /******************************************************
             *  Total de citas asignadas a un rango de hora       *
             ******************************************************/
            $sql = "SELECT t01.fecha as date,
                        SUM((CASE WHEN t01.id_tipocita = 1 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as primeraVez,
                        SUM((CASE WHEN t01.id_tipocita = 2 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as subsecuentes,
                        SUM(CASE WHEN t01.id_estado = 6 THEN 1 ELSE 0 END) as agregados,
                        COUNT(t01.id_tipocita) as total_citas,
                        SUM((CASE WHEN t01.id_estado = 5 THEN 1 ELSE 0 END) + (CASE WHEN t01.id_estado = 7 THEN 1 ELSE 0 END)) atendidos
                    FROM cit_citas_dia        t01
                    INNER JOIN mnt_expediente t02 ON (t01.id_expediente = t02.id)
                    INNER JOIN mnt_empleado 	t03 ON (t01.id_empleado   = t03.id)
                    WHERE t01.fecha = CURRENT_DATE
                        AND t01.id_establecimiento     =:idEstablecimiento
                        AND t01.id_empleado            =:idEmpleado
                        AND t01.id_rangohora           =:idRangoHora
                        AND t01.id_area_mod_estab      =:idAreaModEstab
                        AND t01.id_aten_area_mod_estab =:idEspecialida
                        AND t01.id_estado <> 3
                    GROUP BY t01.fecha,t03.id";

            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->bindValue(':idEstablecimiento', $establecimiento);
            $stm->bindValue(':idRangoHora', $IdRangoHora);
            $stm->bindValue(':idEmpleado', $idEmpleado);
            $stm->bindValue(':idEspecialida', $Idespecialida);
            $stm->bindValue(':idAreaModEstab', $idAreaModEstab);
            $stm->execute();
            $citasRangoHora = $stm->fetchAll();

            foreach ($citasRangoHora as $row) {
                $citaRangoHora = $row['total_citas'];
            }

            return $citaRangoHora;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getCountRango($idEmpleado, $Idespecialida, $date) {
        $em         = $this->container->get('doctrine')->getManager();
        $fecha      = new \DateTime($date);
        $countCitas = "";

        try {
            $idAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($Idespecialida)->getIdAreaModEstab()->getId();

            list($horas, $minutos, $segundos) = explode(':', Date("H:i:s"));
            $hora = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;

            /******************************************************************
             *   Contar cuantos rangos de horas hay despues de la hora actual *
             ******************************************************************/

            $count_citas = "SELECT  count(t02.id) AS ncitas
                            FROM cit_distribucion t01
                            INNER JOIN mnt_rangohora t02 ON (t02.id = t01.id_rangohora)
                            WHERE t01.id_empleado              = :idEmpleado
                                AND t01.id_aten_area_mod_estab = :idAtenAreaModEstab
                                AND t01.id_area_mod_estab      = :idAreaModEstab
                                AND t01.dia                    = :dia
                                AND t01.mes                    = :mes
                                AND t01.yrs                    = :yrs
                                AND EXTRACT(EPOCH FROM t02.hora_fin)::INTEGER > '$hora'";

            $stm = $this->container->get('database_connection')->prepare($count_citas);
            $stm->bindValue(':idEmpleado', $idEmpleado);
            $stm->bindValue(':idAtenAreaModEstab', $Idespecialida);
            $stm->bindValue(':idAreaModEstab', $idAreaModEstab);
            $stm->bindValue(':dia', date("w", $fecha->getTimestamp()) + 1);
            $stm->bindValue(':mes', date("n", $fecha->getTimestamp()));
            $stm->bindValue(':yrs', date("Y", $fecha->getTimestamp()));
            $stm->execute();
            $Countresult = $stm->fetchAll();

            foreach ($Countresult as $row) {
                $countCitas = $row['ncitas'];
            }

            return $countCitas;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getRangoSiguiente($idEmpleado, $Idespecialida, $countCitas) {
        $em    = $this->container->get('doctrine')->getManager();
        $date  = Date("Y-m-d");
        $fecha = new \DateTime($date);

        try {
            $idAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($Idespecialida)->getIdAreaModEstab()->getId();

            list($horas, $minutos, $segundos) = explode(':', Date("H:i:s"));
            $hora = ($horas * 3600 ) + ($minutos * 60 ) + $segundos;

            /********************************************************
             *  Obtener segundo rango de horas con pacaidad         *
             ********************************************************/
            if ($countCitas >= 2) {
                $sql_horaProxima =
                    "SELECT id_rango,hrango,rango_hora
                    FROM (
                        SELECT t02.id AS id_rango,
                                EXTRACT(EPOCH FROM t02.hora_ini) AS rango1,
                                t02.id,
                                TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM') AS hora_ini,
                                TO_CHAR(t02.hora_fin, 'HH12:MI:SS AM') AS hora_fin,
                                CONCAT(TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM'),' - ',TO_CHAR(t02.hora_fin, 'HH12:MI:SS AM')) AS rango_hora,
                                SUM(t01.subsecuente+t01.primera) AS hrango
                        FROM cit_distribucion t01
                        INNER JOIN mnt_rangohora t02 ON (t02.id = t01.id_rangohora)
                        WHERE t01.id_empleado              = :idEmpleado
                            AND t01.id_aten_area_mod_estab = :idAtenAreaModEstab
                            AND t01.id_area_mod_estab      = :idAreaModEstab
                            AND t01.dia                    = :dia
                            AND t01.mes                    = :mes
                            AND t01.yrs                    = :yrs
                            AND EXTRACT(EPOCH FROM t02.hora_ini)::INTEGER > '$hora'
                        GROUP BY t02.id,t01.id
                        ORDER BY hrango ASC limit 2) AS Rangos
                    ORDER BY hrango ASC limit 1";

                $stm = $this->container->get('database_connection')->prepare($sql_horaProxima);
                $stm->bindValue(':idEmpleado', $idEmpleado);
                $stm->bindValue(':idAtenAreaModEstab', $Idespecialida);
                $stm->bindValue(':idAreaModEstab', $idAreaModEstab);
                $stm->bindValue(':dia', date("w", $fecha->getTimestamp()) + 1);
                $stm->bindValue(':mes', date("n", $fecha->getTimestamp()));
                $stm->bindValue(':yrs', date("Y", $fecha->getTimestamp()));
                $stm->execute();
                $result = $stm->fetchAll();

                return $result;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAtencionModalidad($id_modalida) {
        try {
            $user               = $this->container->get('security.context')->getToken()->getUser();
            $em                 = $this->getDoctrine()->getManager();
            $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
            $establecimiento    = $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : ( $user->getIdEmpleado() ? ( $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId() ) : $CtlEstablecimiento->getId() );

            /********************************************************
             *   Obtener las areas de atencion de la modalidad      *
             ********************************************************/
            $sql = "SELECT t02.id id_especialidad,
                        CASE WHEN t02.nombre_ambiente IS NOT NULL THEN
                            CASE WHEN id_servicio_externo_estab IS NOT NULL THEN t05.abreviatura ||'-->' ||t02.nombre_ambiente
                                            ELSE t02.nombre_ambiente
                            END
                        ELSE
                            CASE WHEN id_servicio_externo_estab IS NOT NULL THEN t05.abreviatura ||'--> ' || t01.nombre
                                WHEN not exists (select nombre_ambiente from mnt_aten_area_mod_estab where nombre_ambiente=t01.nombre) THEN t01.nombre
                            END
                        END AS servicio
                    FROM  ctl_atencion                  		    t01
                    INNER JOIN mnt_aten_area_mod_estab              t02 ON (t01.id = t02.id_atencion AND t01.id_tipo_atencion != 4)
                    INNER JOIN mnt_area_mod_estab           	    t03 ON (t03.id = t02.id_area_mod_estab)
                    LEFT  JOIN mnt_servicio_externo_establecimiento t04 ON (t04.id = t03.id_servicio_externo_estab)
                    LEFT  JOIN mnt_servicio_externo             	t05 ON (t05.id = t04.id_servicio_externo)
                    LEFT  JOIN mnt_modalidad_establecimiento 	    t06 ON (t06.id = t03.id_modalidad_estab)
                    WHERE t02.id_establecimiento = :idestablecimiento
                        AND t03.id_area_atencion = 1
                        AND t06.id_modalidad = :idModalidad
                    ORDER BY 2";

            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->bindValue(':idestablecimiento', $establecimiento);
            $stm->bindValue(':idModalidad', $id_modalida);
            $stm->execute();
            $resul_atencion = $stm->fetchAll();

            return $resul_atencion;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getTodosMedicos($idModalidad, $establecimiento) {
        $fecha = Date("Y-m-d");
        /***************************************************************************
         *  OBTIENE LOS MEDICOS DE TODAS LAS AREAS DE ATENCION,                    *
         *  CON LA CAPACIDAD DE CITAS Y EL TOTAL DE CITAS ASIGNADAS                *
         ***************************************************************************/
        try {
            $sql =
            "WITH Medicos AS (
                SELECT aame.id AS id_servicio,
                       a.nombre AS servicio,
                       em.nombreempleado AS nombre,
                       em.id as id_empleado
                FROM mnt_empleado_especialidad_estab  est
                JOIN mnt_empleado em ON em.id=est.id_empleado
                JOIN mnt_aten_area_mod_estab aame ON aame.id=est.id_aten_area_mod_estab AND aame.id_establecimiento=:idestablecimiento
                JOIN ctl_atencion a ON a.id=aame.id_atencion
                JOIN mnt_area_mod_estab ame ON ame.id=aame.id_area_mod_estab
                JOIN mnt_modalidad_establecimiento me ON me.id=ame.id_modalidad_estab AND me.id_modalidad=:idmodalidad),
            Capacidad AS (
                SELECT TO_CHAR(t01.date,'YYYY/MM/DD') AS date,
                       COALESCE(t02.primera_vez,0) AS primera_vez,
                       COALESCE(t02.subsecuentes,0) AS subsecuentes,
                       COALESCE(t02.agregados,0) AS agregados,
                       id_empleado,
                       idEspecialidad
                FROM (
                    SELECT serie::date AS date,
                           EXTRACT(DOW FROM serie)+1 AS DOW
                    FROM generate_series ('$fecha'::timestamp, '$fecha'::timestamp, '1 day'::interval) serie) t01
                LEFT OUTER JOIN (
                    SELECT d.yrs,
                           d.mes,
                           d.dia,
                           d.id_empleado,
                           t03.id idEspecialidad,
                           SUM(primera) AS primera_vez,
                           SUM(subsecuente) AS subsecuentes,
                           SUM(max_citas_agregadas) AS agregados
                    FROM cit_distribucion d
                    JOIN mnt_area_mod_estab t02 ON t02.id=d.id_area_mod_estab
                    JOIN mnt_aten_area_mod_estab t03 ON t02.id=t03.id_area_mod_estab AND t03.id=d.id_aten_area_mod_estab
                    GROUP BY d.yrs, d.mes,d.dia,d.id_empleado,t03.id
                    ORDER BY yrs, mes, dia) t02 ON (t02.yrs = EXTRACT(YEAR FROM t01.date::timestamp) AND t02.mes = EXTRACT(MONTH FROM t01.date::timestamp) AND t02.dia = EXTRACT(DOW FROM t01.date::timestamp)+1)
                ORDER BY date),
            CitasAtendidas AS (
                SELECT TO_CHAR(t05.date,'YYYY/MM/DD') AS date,
                       COALESCE(t06.primeraVez,0) AS primera_vez,
                       COALESCE(t06.subsecuentes,0) AS subsecuentes,
                       COALESCE(t06.agregados,0) AS agregados,
                       COALESCE(t06.totalCitas,0) AS total_citas,
                       COALESCE(t06.atendidos,0) AS atendidos,
                       t06.id_empleado id_empleado,
                       t06.idEspecialidad idEspecialidad
                FROM (
                    SELECT serie::date AS date
                    FROM generate_series ('$fecha'::timestamp,'$fecha'::timestamp, '1 day'::interval) serie) t05
                LEFT OUTER JOIN (
                    SELECT DISTINCT t01.id_aten_area_mod_estab As idEspecialidad,
                        t01.fecha as date,
                        SUM((CASE WHEN t01.id_tipocita = 1 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as primeraVez,
                        SUM((CASE WHEN t01.id_tipocita = 2 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as subsecuentes,
                        SUM(CASE WHEN t01.id_estado = 6 THEN 1 ELSE 0 END) as agregados,
                        COUNT(t01.id_tipocita) as totalCitas,
                        t03.id id_empleado,
                        SUM((CASE WHEN t01.id_estado = 5 THEN 1 ELSE 0 END) + (CASE WHEN t01.id_estado = 7 THEN 1 ELSE 0 END)) atendidos
                    FROM cit_citas_dia t01
                    INNER JOIN mnt_expediente t02 ON (t01.id_expediente = t02.id)
                    INNER JOIN mnt_empleado  t03 ON (t01.id_empleado   = t03.id)
                    WHERE t01.fecha >= '$fecha' AND t01.fecha<= '$fecha' AND t01.id_estado <> 3
                    GROUP BY t01.id_aten_area_mod_estab, t01.fecha, t03.id) t06 ON (t05.date = t06.date)
                ORDER BY date)

                SELECT t01.id_servicio AS id_servicio,
                       t01.servicio AS servicio,
                       t08.id_empleado AS id_empleado,
                       UPPER(t01.nombre) nombre_empleado,
                       SUM(t08.primera_vez+t08.subsecuentes) AS capacidad,
                       COALESCE(t03.total_citas,0) total_citas,
                       COALESCE((SUM(t08.primera_vez+t08.subsecuentes)-t03.total_citas),
                       SUM(t08.primera_vez+t08.subsecuentes)) AS can_disponible
                FROM Medicos t01
                INNER JOIN Capacidad t08 ON t08.id_empleado=t01.id_empleado AND t08.idespecialidad=t01.id_servicio
                LEFT JOIN CitasAtendidas t03 ON t03.id_empleado=t01.id_empleado AND t03.idEspecialidad=t08.idEspecialidad
                GROUP BY t01.id_servicio, t01.id_empleado, servicio, t08.id_empleado, t01.nombre, t03.total_citas
                ORDER BY can_disponible DESC";

            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->bindValue(':idestablecimiento', $establecimiento);
            $stm->bindValue(':idmodalidad', $idModalidad);
            $stm->execute();
            $result_medico_area = $stm->fetchAll();
            return $result_medico_area;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @Route("/filtrar/get", name="filtrar", options={"expose"=true})
     * @Method("GET")
     */
    public function filtarAction() {
        try {
            $em          = $this->getDoctrine()->getManager();
            $session     = $this->container->get('session');
            $em->getConnection()->beginTransaction();
            $request     = $this->getRequest();
            $criterio    = $request->get('criterio');
            $idEspe      = $request->get('especialida');
            $idModalidad = $request->get('idModalida');

            if($idModalidad=="") {
                $idEsp       = $session->get('_idEmpEspecialidadEstab');
                $idModalidad = $this->getDoctrine()->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($idEsp)->getIdAreaModEstab()->getIdModalidadEstab()->getIdModalidad()->getId();
            }

            /***************************************************************************
             * Muestra los medios de cada area de atencion, con la capacidad de citas  *
             * y el total de citas asignadas                                           *
             ***************************************************************************/
            $medico= $this->getMedico($idModalidad,$idEspe,$criterio);

            if (empty($medico)) {
                $data['data'] = false;
            } else {
                $data['data'] = $medico;
                $data['idEsp'] = $idEspe;
            }

            return new Response(json_encode($data));
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getMedico($idModalidad, $idEspe,$criterio) {
        $user               = $this->container->get('security.context')->getToken()->getUser();
        $em                 = $this->getDoctrine()->getManager();
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $establecimiento    = $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : ( $user->getIdEmpleado() ? ( $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId() ) : $CtlEstablecimiento->getId() );
        $fecha              = Date("Y-m-d");

        /***************************************************************************
         *  OBTIENE LOS MEDICOS DE TODAS LAS AREAS DE ATENCION,                    *
         *  CON LA CAPACIDAD DE CITAS Y EL TOTAL DE CITAS ASIGNADAS                *
         ***************************************************************************/
        try {
            if($idEspe==0) {
                $medico =
                    "SELECT aame.id AS id_servicio,a.nombre AS servicio,em.nombreempleado AS nombre,
                            em.id as id_empleado FROM mnt_empleado_especialidad_estab  est
                    JOIN mnt_empleado em ON em.id=est.id_empleado and em.nombreempleado  ILIKE TRIM('%$criterio%')
                    JOIN mnt_aten_area_mod_estab aame ON aame.id=est.id_aten_area_mod_estab AND aame.id_establecimiento=$establecimiento
                    JOIN ctl_atencion a ON a.id=aame.id_atencion
                    JOIN mnt_area_mod_estab ame ON ame.id=aame.id_area_mod_estab
                    JOIN mnt_modalidad_establecimiento me ON me.id=ame.id_modalidad_estab AND me.id_modalidad=".$idModalidad;
            } else {
                $medico =
                    "SELECT aame.id AS id_servicio,a.nombre AS servicio,em.nombreempleado AS nombre,
                            em.id as id_empleado FROM mnt_empleado_especialidad_estab  est
                    JOIN mnt_empleado em ON em.id=est.id_empleado and em.nombreempleado  ILIKE TRIM('%$criterio%')
                    JOIN mnt_aten_area_mod_estab aame ON aame.id=est.id_aten_area_mod_estab AND aame.id_establecimiento=$establecimiento AND aame.id=$idEspe
                    JOIN ctl_atencion a ON a.id=aame.id_atencion
                    JOIN mnt_area_mod_estab ame ON ame.id=aame.id_area_mod_estab
                    JOIN mnt_modalidad_establecimiento me ON me.id=ame.id_modalidad_estab AND me.id_modalidad=".$idModalidad;
            }

            $sql = "WITH Medicos AS ($medico),
                    Capacidad AS (
                        SELECT TO_CHAR(t01.date, 'YYYY/MM/DD') AS date,
                               COALESCE(t02.primera_vez, 0) AS primera_vez,
                               COALESCE(t02.subsecuentes, 0) AS subsecuentes,
                               COALESCE(t02.agregados, 0) AS agregados,
                               id_empleado,
                               idEspecialidad
                        FROM (
                            SELECT serie::date AS date, EXTRACT(DOW FROM serie)+1 AS DOW
                            FROM generate_series ('$fecha'::timestamp, '$fecha'::timestamp, '1 day'::interval) serie) t01
                        LEFT OUTER JOIN (
                            SELECT d.yrs,
                	               d.mes,
                	               d.dia,
                                   d.id_empleado,
                                   t03.id idEspecialidad,
                	               SUM(primera) AS primera_vez,
                                   SUM(subsecuente) AS subsecuentes,
                                   SUM(max_citas_agregadas) AS agregados
                            FROM cit_distribucion d
                            JOIN mnt_area_mod_estab t02 ON t02.id=d.id_area_mod_estab
                	        JOIN mnt_aten_area_mod_estab t03 ON t02.id=t03.id_area_mod_estab AND t03.id=d.id_aten_area_mod_estab
                	        GROUP BY d.yrs,
                                     d.mes,
                	                 d.dia,
                                     d.id_empleado,
                                     t03.id
                	        ORDER BY yrs, mes, dia) t02 ON (t02.yrs = EXTRACT(YEAR FROM t01.date::timestamp) AND t02.mes = EXTRACT(MONTH FROM t01.date::timestamp) AND t02.dia = EXTRACT(DOW FROM t01.date::timestamp)+1)
                        ORDER BY date),
                    CitasAtendidas AS (
                        SELECT TO_CHAR(t05.date, 'YYYY/MM/DD') AS date,
                               COALESCE(t06.primeraVez,0) AS primera_vez,
                               COALESCE(t06.subsecuentes,0) AS subsecuentes,
                               COALESCE(t06.agregados,0) AS agregados,
                               COALESCE(t06.totalCitas,0) AS total_citas,
                               COALESCE(t06.atendidos,0) AS atendidos,
                               t06.id_empleado id_empleado,
                               t06.idEspecialidad
                        FROM (
                            SELECT serie::date AS date
                            FROM generate_series ('$fecha'::timestamp,'$fecha'::timestamp,'1 day'::interval) serie) t05
                        LEFT OUTER JOIN (
                            SELECT DISTINCT t01.id_aten_area_mod_estab As idEspecialidad,t01.fecha as date,
                                   SUM((CASE WHEN t01.id_tipocita = 1 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as primeraVez,
                                   SUM((CASE WHEN t01.id_tipocita = 2 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as subsecuentes,
                                   SUM(CASE WHEN t01.id_estado = 6 THEN 1 ELSE 0 END) as agregados,
                                   COUNT(t01.id_tipocita) as totalCitas,
                                   t03.id id_empleado,
                                   SUM((CASE WHEN t01.id_estado = 5 THEN 1 ELSE 0 END) + (CASE WHEN t01.id_estado = 7 THEN 1 ELSE 0 END)) atendidos
                            FROM cit_citas_dia        t01
                            INNER JOIN mnt_expediente t02 ON (t01.id_expediente = t02.id)
                            INNER JOIN mnt_empleado 	t03 ON (t01.id_empleado   = t03.id)
                            WHERE t01.fecha >= '$fecha' AND t01.fecha<= '$fecha' AND t01.id_estado <> 3
                        GROUP BY t01.id_aten_area_mod_estab,t01.fecha,t03.id) t06 ON (t05.date = t06.date)
                        ORDER BY date)";

            $sql .= "SELECT t01.id_servicio AS id_servicio,
                            t01.servicio AS servicio,
                            t08.id_empleado AS id_empleado,
                            upper(t01.nombre) nombre_empleado,
                            SUM(t08.primera_vez+t08.subsecuentes) AS capacidad,
                            COALESCE(t03.total_citas,0) total_citas,
                            COALESCE((SUM(t08.primera_vez+t08.subsecuentes)-t03.total_citas),
                            SUM(t08.primera_vez+t08.subsecuentes)) AS can_disponible
                    FROM Medicos t01 inner join Capacidad t08 ON t08.id_empleado=t01.id_empleado AND t08.idespecialidad=t01.id_servicio
                    left join CitasAtendidas t03 ON t03.id_empleado=t01.id_empleado AND t03.idEspecialidad=t08.idEspecialidad
                    GROUP BY t01.id_servicio,t01.id_empleado,servicio, t08.id_empleado, t01.nombre,t03.total_citas
                    ORDER BY can_disponible DESC";

            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->execute();
            $result_medico = $stm->fetchAll();

            return $result_medico;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
