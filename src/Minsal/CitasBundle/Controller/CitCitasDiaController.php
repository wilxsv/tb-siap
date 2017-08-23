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

class CitCitasDiaController extends Controller {

    /**
     * @Route("/citas/dia/medico/get", name="citasdiaxmedico", options={"expose"=true})
     * @Method("GET")
     */
    public function getCitCitasDiaxMedicoAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $calendarDate = $request->get('calendarDate') ? new \DateTime($request->get('calendarDate')) : new \DateTime();
        $lowerLimit = $request->get('lowerLimit') ? $request->get('lowerLimit') : date('Y-m-01', $calendarDate->getTimestamp());
        $upperLimit = $request->get('upperLimit') ? $request->get('upperLimit') : date('Y-m-t', $calendarDate->getTimestamp());
        $idEmpleado = $request->get('idEmpleado');
        $idEspecialidad = $request->get('idEmpleadoEspecialidadEstab');
        $citCitasDiaService = $this->container->get('cit_citas_dia.services');

        /****************************************************************************************
         * Obteniendo la cantidad de citas por primera vez, subsecuentes, agregados, atendidos
         * y total de citas para cada dia de un mes determinado por usuario y especialidad
         ****************************************************************************************/
        $citcita['data1'] = $citCitasDiaService->getConsolidadoCitCitasDia($idEmpleado, $idEspecialidad, $lowerLimit, $upperLimit);

        /****************************************************************************************
         * Obteniendo los eventos que un empleado tiene para un mes en especifico, asi como
         * tambien las fechas festivas o no laborables
         ****************************************************************************************/
        $citcita['data2'] = $citCitasDiaService->getEventos($idEmpleado, $lowerLimit, $upperLimit, 'Y-m-d', 'yyyy/mm/dd');

        /****************************************************************************************
         * Obteniendo la distribucion de un médico, para un mes especifico
         ****************************************************************************************/
        $citcita['data3'] = $citCitasDiaService->getDistribucionEmpleado($idEmpleado, $idEspecialidad, $lowerLimit, $upperLimit);

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/horario/medico/get", name="citashorariomedico", options={"expose"=true})
     * @Method("GET")
     */
    public function getHorarioMedicoAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $date = $request->get('date');
        $lowerLimit = $request->get('lowerLimit') ? $request->get('lowerLimit') : $date;
        $upperLimit = $request->get('upperLimit') ? $request->get('upperLimit') : $date;
        $idEmpleado = $request->get('idEmpleado');
        $idEspecialidad = $request->get('idEmpleadoEspecialidadEstab');
        $citCitasDiaService = $this->container->get('cit_citas_dia.services');
        $EmpEmpleado = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneById($idEmpleado);
        $residente = $EmpEmpleado->getResidente() ? true : false;
        $showHorarioReal = $request->get('showHorarioReal') ? (string) $request->get('showHorarioReal') : 'true';

        $lowerLimit = new \DateTime($lowerLimit);
        $lowerLimit = $lowerLimit->format('d/m/Y');
        $upperLimit = new \DateTime($upperLimit);
        $upperLimit = $upperLimit->format('d/m/Y');
        $horarios = array();

        /*****************************************************************************************
         * Obteniendo el horario de atencion de pacientes de un medico (rangos de horas)
         * para una fecha determinada
         ****************************************************************************************/
        $result = $citCitasDiaService->getRangoCitasInfo($idEmpleado, $idEspecialidad, $lowerLimit, $upperLimit, false, $showHorarioReal, 'Y/m/d');

        $getHorario = true;
        foreach ($result as $keyDay => $day) {
            foreach ($day['horarios'] as $keyHorario => $horario) {
                $getHorario = $residente === true ? ( $horario['generico'] === true ? ( $horario['totalAsignados'] > 0 ? true : false ) : true ) : true;

                if ($getHorario) {
                    $horarios [] = array(
                        'date'                     => str_replace('/', '-', $day['date']),
                        'id'                       => $horario['id'],
                        'hora_ini'                 => $horario['horaIni'],
                        'hora_fin'                 => $horario['horaFin'],
                        'rango_hora'               => $horario['rangoHora'],
                        'id_tipo_distribucion'     => $horario['idTipoDistribucion'],
                        'nombre_tipo_distribucion' => $horario['nombreTipoDistribucion'],
                        'id_estado_distribucion' => $horario['idEstadoDistribucion']
                    );
                }
            }
        }

        $citcita['data1'] = $horarios;

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/verificar/evento/get", name="citasverificarevento", options={"expose"=true})
     * @Method("GET")
     */
    public function verifyMedicEventAction() {
        $em              = $this->getDoctrine()->getManager();
        $request         = $this->getRequest();
        $inputDateFormat = $request->get('inputDateFormat') ? $request->get('inputDateFormat') : 'd/m/Y';
        $inputTimeFormat = $request->get('inputTimeFormat') ? $request->get('inputTimeFormat') : 'h:i:s A';
        $fechaHoraIni    = \DateTime::createFromFormat($inputDateFormat.' '.$inputTimeFormat, $request->get('fecha').' '.$request->get('horaIni'));
        $fechaHoraFin    = $request->get('horaFin') ? \DateTime::createFromFormat($inputDateFormat.' '.$inputTimeFormat, $request->get('fecha').' '.$request->get('horaFin')) : NULL;
        $idEmpleado      = $request->get('idEmpleado');

        $citCitasDiaService = $this->container->get('cit_citas_dia.services');

        /*****************************************************************************************
         * Verificando que el medico no tenga evento en la hora seleccionada
         ****************************************************************************************/
        $citcita = $citCitasDiaService->verificarEvento($idEmpleado, $fechaHoraIni->format($inputDateFormat), $fechaHoraIni->format($inputTimeFormat), $inputDateFormat, $inputTimeFormat);

        if($fechaHoraFin !== NULL) {
            $citcita = array_merge($citcita, $citCitasDiaService->verificarEvento($idEmpleado, $fechaHoraFin->format($inputDateFormat), $fechaHoraFin->format($inputTimeFormat), $inputDateFormat, $inputTimeFormat));
        }

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/detalle/hora/get", name="citasdetallehora", options={"expose"=true})
     * @Method("GET")
     */
    public function getDetalleCitaHoraAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $date = new \DateTime($request->get('date'));
        $idEmpleado = $request->get('idEmpleado');
        $idEspecialidad = $request->get('idEmpleadoEspecialidadEstab');
        $idRangohora = $request->get('hora');
        $citCitasDiaService = $this->container->get('cit_citas_dia.services');

        /*****************************************************************************************
         * Determinando el detalle de la cita por hora
         ****************************************************************************************/
        $citcita['data1'] = $citCitasDiaService->getDetalleCitaDia($idEmpleado, $idEspecialidad, $date->format('d/m/Y'), $date->format('d/m/Y'), 1, $idRangohora);
        $citcita['data2'] = $citCitasDiaService->getDetalleCitaDia($idEmpleado, $idEspecialidad, $date->format('d/m/Y'), $date->format('d/m/Y'), 2, $idRangohora);
        $citcita['data3'] = $citCitasDiaService->getDetalleCitaDia($idEmpleado, $idEspecialidad, $date->format('d/m/Y'), $date->format('d/m/Y'), 6, $idRangohora);

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/dias/intermedios/verify", name="verificar_dias_intermedios", options={"expose"=true})
     * @Method("GET")
     */
    public function verificarDiasIntermediosAction() {
        $em                 = $this->getDoctrine()->getManager();
        $request            = $this->getRequest();
        $inputFormat        = $request->get('inputFormat') ? $request->get('inputFormat') : 'd/m/Y';
        $fecha              = \DateTime::createFromFormat( $inputFormat, $request->get('fecha') );
        $idExpediente       = $request->get('idExpediente');
        $citCitasDiaService = $this->container->get('cit_citas_dia.services');
        $user               = $this->getUser();

        /*****************************************************************************************
         * Determinando el detalle de la cita por hora
         ****************************************************************************************/
        $citcita = $citCitasDiaService->verificarDiasIntermedios($fecha->format($inputFormat), $idExpediente, $inputFormat, true, $user->getId());

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/expediente/paciente/get", name="citasexpedientepaciente", options={"expose"=true})
     * @Method("GET")
     */
    public function getExpedientePacienteAction() {
        $em      = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $clue    = ltrim(strtolower($request->get('clue')), '0');
        $limit   = $request->get('page_limit');
        $page    = ($request->get('page') - 1) * 10;
        $id      = $request->get('id');

        $condition = '';
        $sort = '';

        if (isset($id)) {
            $sql = "SELECT t01.id,
                           INITCAP(CONCAT_WS(' ', CONCAT(COALESCE(t01.numero, ''), ' - '), t02.primer_nombre, t02.segundo_nombre, t02.tercer_nombre, t02.primer_apellido, t02.segundo_apellido, t02.apellido_casada)) AS text,
                           INITCAP(CONCAT_WS(' ', t02.primer_nombre, t02.segundo_nombre, t02.tercer_nombre, t02.primer_apellido, t02.segundo_apellido, t02.apellido_casada)) AS nombre_completo,
                           count(*) OVER() AS total
                    FROM mnt_expediente     t01
                    INNER JOIN mnt_paciente t02 ON (t02.id = t01.id_paciente AND t01.id=$id)";
        }else{
            if (is_numeric(substr(str_replace('-', '', $clue),1))) {
                $condition = "ltrim(t01.numero, '0') ILIKE '$clue%'";
                $sort = "t01.numero";
            } else {
                $clue = str_replace(' ', '', $clue);
                $condition = "unaccent(trim(CONCAT_WS('', t02.primer_nombre, t02.segundo_nombre, t02.tercer_nombre, t02.primer_apellido, t02.segundo_apellido, t02.apellido_casada))) ILIKE unaccent('%$clue%')";
                $sort = "CONCAT_WS(' ', t02.primer_nombre, t02.segundo_nombre, t02.tercer_nombre, t02.primer_apellido, t02.segundo_apellido, t02.apellido_casada)";
            }

            /*****************************************************************************************
             * SQL que obtiene el numero de expediente y nombre del paciente para asignar la cita
             ****************************************************************************************/

            $sql = "SELECT t01.id,
                           INITCAP(CONCAT_WS(' ', CONCAT(COALESCE(t01.numero, ''), ' - '), t02.primer_nombre, t02.segundo_nombre, t02.tercer_nombre, t02.primer_apellido, t02.segundo_apellido, t02.apellido_casada)) AS text,
                           INITCAP(CONCAT_WS(' ', t02.primer_nombre, t02.segundo_nombre, t02.tercer_nombre, t02.primer_apellido, t02.segundo_apellido, t02.apellido_casada)) AS nombre_completo,
                           count(*) OVER() AS total
                    FROM mnt_expediente     t01
                    INNER JOIN mnt_paciente t02 ON (t02.id = t01.id_paciente AND t01.habilitado = true AND t01.expediente_fisico_eliminado = FALSE)
                    WHERE $condition
                    GROUP BY t01.id,
                           CONCAT_WS(' ', CONCAT(COALESCE(t01.numero, ''), ' - '), t02.primer_nombre, t02.segundo_nombre, t02.tercer_nombre, t02.primer_apellido, t02.segundo_apellido, t02.apellido_casada),
                           CONCAT_WS(' ', t02.primer_nombre, t02.segundo_nombre, t02.tercer_nombre, t02.primer_apellido, t02.segundo_apellido, t02.apellido_casada)
                    ORDER BY $sort
                    LIMIT $limit OFFSET $page";
        }
        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        $citcita['data1'] = $result;
        $citcita['data2'] = count($result) > 0 ? $result[0]['total'] : 0;

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/medicos/get", name="citasgetmedico", options={"expose"=true})
     * @Method("GET")
     */
    public function getMedicoAction() {
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT t01.id,
                       COALESCE(INITCAP(t01.nombreempleado),'') AS nombre,
                       IDENTITY(t01.idEstablecimiento) AS idEstablecimiento,
                       COALESCE(t01.residente, false) AS residente
                FROM MinsalSiapsBundle:MntEmpleado              t01
                INNER JOIN MinsalSiapsBundle:MntTipoEmpleado    t02 WITH (t02.id = t01.idTipoEmpleado)
                INNER JOIN MinsalSiapsBundle:CtlEstablecimiento t03 WITH (t03.id = t01.idEstablecimiento)
                WHERE t02.codigo = 'MED'";

        $result = $em->createQuery($dql)
                ->getArrayResult();

        $citcita['data1'] = $result;

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/medicos/especilidad/estab/get", name="citasgetmedicoespecialidadestab", options={"expose"=true})
     * @Method("GET")
     */
    public function getMedicoEspecialidadEstabAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $request = $this->getRequest();
        $session = $request->getSession();
        $idEmpleado = $request->get('idEmpleado');
        $EmpEmpleado = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneById($idEmpleado);
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $idEstablecimiento = ($user->getIdEstablecimiento() !== null) ? $user->getIdEstablecimiento()->getId() : ( ($user->getIdEmpleado() !== null) ? ( ($user->getIdEmpleado()->getIdEstablecimiento() !== null) ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId() ) : $CtlEstablecimiento->getId() );
        $idModalidad = NULL;
        $whereModalidad = '';

        if ($user->getIdEmpleado() !== NULL && $user->getIdEmpleado()->getIdTipoEmpleado() !== NULL && $user->getIdEmpleado()->getIdTipoEmpleado()->getCodigo() === 'MED') {
            $MntAtenAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($session->get('_idEmpEspecialidadEstab'));
            $idModalidad = $MntAtenAreaModEstab->getIdAreaModEstab()->getIdModalidadEstab()->getIdModalidad()->getId();
        }

        /*****************************************************************************************
         * SQL que obtiene todas las especialidades del medico
         ****************************************************************************************/
        if ($EmpEmpleado->getResidente() === true) {
            if ($idModalidad !== NULL) {
                $whereModalidad = 'AND t05.id = ' . $idModalidad;
            }

            $dql = "SELECT t01
                    FROM MinsalSiapsBundle:MntAtenAreaModEstab               t01
                    INNER JOIN MinsalSiapsBundle:MntAreaModEstab             t02 WITH (t02.id = t01.idAreaModEstab)
                    INNER JOIN MinsalSiapsBundle:CtlAreaAtencion             t03 WITH (t03.id = t02.idAreaAtencion)
                    INNER JOIN MinsalSiapsBundle:MntModalidadEstablecimiento t04 WITH (t04.id = t02.idModalidadEstab)
                    INNER JOIN MinsalSiapsBundle:CtlModalidad                t05 WITH (t05.id = t04.idModalidad)
                    WHERE t01.idEstablecimiento = :idEstablecimiento
                        AND t03.id = :idAreaAtencion
                        $whereModalidad";

            $result = $em->createQuery($dql)
                    ->setParameters(
                            array(
                                ':idEstablecimiento' => $idEstablecimiento,
                                ':idAreaAtencion' => 1
                            )
                    )
                    ->getResult();
        } else {
            if ($idModalidad !== NULL) {
                $whereModalidad = 'AND t07.id = ' . $idModalidad;
            }

            $dql = "SELECT t02
                    FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab      t01
                    INNER JOIN MinsalSiapsBundle:MntAtenAreaModEstab         t02 WITH (t02.id = t01.idAtenAreaModEstab)
                    INNER JOIN MinsalSiapsBundle:CtlAtencion                 t03 WITH (t03.id = t02.idAtencion)
                    INNER JOIN MinsalSiapsBundle:MntAreaModEstab             t04 WITH (t04.id = t02.idAreaModEstab)
                    INNER JOIN MinsalSiapsBundle:CtlAreaAtencion             t05 WITH (t05.id = t04.idAreaAtencion)
                    INNER JOIN MinsalSiapsBundle:MntModalidadEstablecimiento t06 WITH (t06.id = t04.idModalidadEstab)
                    INNER JOIN MinsalSiapsBundle:CtlModalidad                t07 WITH (t07.id = t06.idModalidad)
                    INNER JOIN MinsalSiapsBundle:MntEmpleado                 t08 WITH (t08.id = t01.idEmpleado)
                    INNER JOIN MinsalSiapsBundle:MntTipoEmpleado             t09 WITH (t09.id = t08.idTipoEmpleado)
                    WHERE t01.idEmpleado = :idEmpleado
                        AND t02.idEstablecimiento = :idEstablecimiento
                        AND t05.id = :idAreaAtencion
                        AND UPPER(t09.codigo) = :codEmpleado
                        $whereModalidad";

            $result = $em->createQuery($dql)
                    ->setParameters(
                            array(
                                ':idEmpleado' => $idEmpleado,
                                ':codEmpleado' => 'MED',
                                ':idEstablecimiento' => $idEstablecimiento,
                                ':idAreaAtencion' => 1
                            )
                    )
                    ->getResult();
        }

        $new_result = array();

        foreach ($result as $key => $value) {
            $new_result[$key]['id'] = $value->getId();
            $new_result[$key]['nombre'] = $value->getNombreConsulta();
            $new_result[$key]['idEstablecimiento'] = $value->getIdAreaModEstab()->getIdEstablecimiento()->getId();
        }

        $citcita['result'] = $new_result;
        $citcita['residente'] = $EmpEmpleado->getResidente() === true ? true : false;

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/paciente/poseecita/get", name="citaspacienteposeecita", options={"expose"=true})
     * @Method("GET")
     */
    public function pacientePoseeCitaAction() {
        $em             = $this->getDoctrine()->getManager();
        $request        = $this->getRequest();
        $idEmpleado     = $request->get('idEmpleado');
        $idExpediente   = $request->get('idExpediente');
        $idEspecialidad = $request->get('idEspecialidad');
        $inputFormat    = $request->get('inputFormat') ? $request->get('especialidad') : 'd/m/Y';
        $date           = \DateTime::createFromFormat($inputFormat, $request->get('fecha'));
        $fecha          = $date->format('Y-m-d');
        $citaIntegral   = $request->get('citaIntegral') ? ( $request->get('citaIntegral') === 'true' ? true : false ) : false;
        $now            = new \DateTime();
        $hoy            = $now->format('Y-m-d');
        $user           = $this->getUser();
        $idEspecialidadWhere = '';

        if($citaIntegral) {
            $idEspecialidadWhere = 'AND t03.id = '.$idEspecialidad;
        }

        /**************************************************************************************************************************************************
         * SQL que verifica y obtiene si un paciente tiene cita en una especialidad (citaIntegral = true) o en varias especialidades (citaIntegral = false)
         **************************************************************************************************************************************************/
        $sql = "SELECT t01.id AS id_cita,
                       'citas_medica'::text AS clase_cita,
                       t01.id_empleado,
                       t03.id_area_mod_estab,
                       t03.id AS id_especialidad,
                       t04.nombre AS nombre_especialidad,
                       t01.id_rangohora,
                       TO_CHAR(t02.hora_ini, 'HH12:MI:SS A') as hora_ini,
                       NULL AS id_procedimiento,
                       NULL AS nombre_procedimiento
                FROM cit_citas_dia                 t01
                INNER JOIN mnt_rangohora           t02 ON (t02.id = t01.id_rangohora)
                INNER JOIN mnt_aten_area_mod_estab t03 ON (t03.id = t01.id_aten_area_mod_estab)
                INNER JOIN ctl_atencion            t04 ON (t04.id = t03.id_atencion)
                INNER JOIN mnt_expediente          t05 ON (t05.id = t01.id_expediente)
                WHERE t01.fecha='$fecha'
                    AND t05.id=:idExpediente
                    AND t01.id_estado NOT IN (3,9)
                    $idEspecialidadWhere

                UNION

                SELECT t07.id AS id_cita,
                       'citas_procedimiento'::text AS clase_cita,
                       t08.id_empleado,
                       t08.id_area_mod_estab,
                       NULL AS id_especialidad,
                       NULL AS nombre_especialidad,
                       t08.id_rangohora,
                       TO_CHAR(t11.hora_ini, 'HH12:MI:SS A') as hora_ini,
                       t10.id AS id_procedimiento,
                       t10.procedimiento AS nombre_procedimiento
                FROM cit_citas_procedimientos                t07
                INNER JOIN cit_distribucion_procedimiento    t08 ON (t08.id = t07.id_distribucion_procedimiento)
                INNER JOIN mnt_procedimiento_establecimiento t09 ON (t09.id = t08.id_procedimiento_establecimiento)
                INNER JOIN mnt_ciq                           t10 ON (t10.id = t09.id_ciq)
                INNER JOIN mnt_rangohora                     t11 ON (t11.id = t08.id_rangohora)
                INNER JOIN mnt_expediente                    t12 ON (t12.id = t07.id_expediente)
                WHERE t07.fecha='$fecha'
                    AND t12.id=:idExpediente
                    AND t07.id_estado NOT IN (3,9)";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idExpediente', $idExpediente);
        $stm->execute();
        $result = $stm->fetchAll();

        $citcita['data1'] = $result;

        /*********************************************************************************************************************************************
         * SQL que verifica y obtiene si un paciente tiene cita en la fecha, y si esa cita ha dido registrada por el usuario en sesion el dia de ahora
         *********************************************************************************************************************************************/

        $sql = "SELECT t01.id AS id_cita,
                       t01.id_empleado,
                       t03.id_area_mod_estab,
                       t03.id AS id_especialidad,
                       t04.nombre AS nombre_especialidad,
                       t01.id_rangohora,
                       TO_CHAR(t02.hora_ini, 'HH12:MI:SS A') as hora_ini
                FROM cit_citas_dia t01
                INNER JOIN mnt_rangohora           t02 ON (t02.id = t01.id_rangohora)
                INNER JOIN mnt_aten_area_mod_estab t03 ON (t03.id = t01.id_aten_area_mod_estab)
                INNER JOIN ctl_atencion            t04 ON (t04.id = t03.id_atencion)
                WHERE t01.fecha = '$fecha'
                    AND t01.id_estado NOT IN (3,9)
                    AND t01.id_expediente          = :idExpediente
                    AND t01.idusuarioreg           = :idUsuarioReg
                    AND t01.id_aten_area_mod_estab = :idAtenAreaModEstab
                    AND DATE(t01.fechahorareg)     = '$hoy'";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idExpediente', $idExpediente);
        $stm->bindValue(':idUsuarioReg', $user->getId());
        $stm->bindValue(':idAtenAreaModEstab', $idEspecialidad);
        $stm->execute();
        $result = $stm->fetchAll();

        $citcita['data2'] = $result;

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/comprobar/disponibilidad", name="citascomprobardisponibilidad", options={"expose"=true})
     * @Method("GET")
     *
     */
    public function comprobarDisponibilidadAction() {
        $em                  = $this->getDoctrine()->getManager();
        $request             = $this->getRequest();
        $date                = new \DateTime($request->get('date'));
        $idEmpleado          = $request->get('idEmpleado');
        $idEspecialidad      = $request->get('especialidad');
        $idRangohora         = $request->get('idRangohora');
        $mntAtenAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($idEspecialidad);
        $idAreaModEstab      = $mntAtenAreaModEstab->getIdAreaModEstab()->getId();
        $idEstablecimiento   = $mntAtenAreaModEstab->getIdEstablecimiento()->getId();
        $tipoCita            = $request->get('idTipoCita');

        /*****************************************************************************************
         * SQL que determina el numero maximo de citas agregadas que puede brindar un medico en un
         * horario determinado
         ****************************************************************************************/
        $sql = "SELECT t01.max_citas_agregadas
                FROM cit_distribucion t01
                WHERE t01.id_empleado = :idEmpleado
                      AND t01.id_aten_area_mod_estab = :idAtenAreaModEstab
                      AND t01.id_area_mod_estab      = :idAreaModEstab
                      AND t01.id_rangohora           = :idRangohora
                      AND t01.dia                    = :dia
                      AND t01.mes                    = :mes
                      AND t01.yrs                    = :yrs";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idEmpleado', $idEmpleado);
        $stm->bindValue(':idAtenAreaModEstab', $idEspecialidad);
        $stm->bindValue(':idAreaModEstab', $idAreaModEstab);
        $stm->bindValue(':idRangohora', $idRangohora);
        $stm->bindValue(':dia', date("w", $date->getTimestamp()));
        $stm->bindValue(':mes', date("n", $date->getTimestamp()));
        $stm->bindValue(':yrs', date("Y", $date->getTimestamp()));
        $stm->execute();
        $result = $stm->fetchAll();

        $citcita['data1'] = $result[0];

        /*****************************************************************************************
         * SQL que determina el numero de pacientes agregados que tiene un medico en para una
         * especialidad y horario determinado
         ****************************************************************************************/
        $dql = "SELECT COUNT(t01.id)
                FROM MinsalCitasBundle:CitCitasDia t01
                WHERE t01.idAtenAreaModEstab  = :idAtenAreaModEstab
                    AND t01.idEstado          = :idEstado
                    AND t01.fecha             = :fecha
                    AND t01.idEmpleado        = :idEmpleado
                    AND t01.idEstablecimiento = :idEstablecimiento
                    AND t01.idRangohora       = :idRangohora
                    AND t01.idAreaModEstab    = :idAreaModEstab";

        $result = $em->createQuery($dql)
                ->setParameter(':idAtenAreaModEstab', $idEspecialidad)
                ->setParameter(':idEstado', '6')
                ->setParameter(':fecha', date("Y-m-d", $date->getTimestamp()))
                ->setParameter(':idEmpleado', $idEmpleado)
                ->setParameter(':idEstablecimiento', $idEstablecimiento)
                ->setParameter(':idRangohora', $idRangohora)
                ->setParameter(':idAreaModEstab', $idAreaModEstab)
                ->getSingleScalarResult();

        $citcita['data2'] = $result;

        /*****************************************************************************************
         * SQL que obtiene los datos de la distribución para un médico para una fecha,
         * especialidad y horario determinado
         ****************************************************************************************/
        $citDistribucion = $em->getRepository('MinsalCitasBundle:CitDistribucion')->findOneBy(
                array(
                    'idEmpleado' => $idEmpleado,
                    'dia' => date("w", $date->getTimestamp()),
                    'mes' => date("n", $date->getTimestamp()),
                    'yrs' => date("Y", $date->getTimestamp()),
                    'idAtenAreaModEstab' => $idEspecialidad,
                    'idRangohora' => $idRangohora
                )
        );

        /* Limite de subsecuentes que pueden ser asignados en el dia y hora al medico */
        $subsecuentes = $citDistribucion->getSubsecuente();

        /* Obteniendo el total de citas que posee el medico */
        $qb = $em->createQueryBuilder();

        $totalCitas = $qb->select($qb->expr()->count('t01.id'))
                ->from('MinsalCitasBundle:CitCitasDia', 't01')
                ->where('t01.fecha = :fecha')
                ->andWhere('t01.idEmpleado = :idEmpleado')
                ->andWhere('t01.idTipocita = :idTipocita')
                ->andWhere('t01.idAtenAreaModEstab = :especialidad')
                ->andWhere('t01.idRangohora = :idRangohora')
                ->andWhere('t01.idEstado NOT IN (3,9)')
                ->setParameters(array(
                    ':fecha' => date('Y-m-d', $date->getTimestamp()),
                    ':idEmpleado' => $idEmpleado,
                    ':idTipocita' => $tipoCita,
                    ':especialidad' => $idEspecialidad,
                    ':idRangohora' => $idRangohora))
                ->getQuery()
                ->getSingleScalarResult();

        if ($totalCitas >= $subsecuentes) {
            $result = 'true';
        } else {
            $result = 'false';
        }

        $citcita['data3'] = $result;

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/historia/paciente/match/get", name="datehistorymatch", options={"expose"=true})
     * @Method("GET")
     */
    public function dateHistoryMatchAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $idEmpleado = $request->get('idEmpleado');
        $idExpediente = $request->get('idExpediente');
        $idAtenAreaModEstab = $request->get('idAtenAreaModEstab');
        $fechaConsulta = new \DateTime(str_replace("/", "-", $request->get('fechaConsulta')));
        $fecha = date('Y-m-d', $fechaConsulta->getTimestamp());

        $user = $this->getUser();

        /* SQL que verifica y obtiene si un paciente tiene cita previa con el medico, para una fecha y especialidad determinada */

        $sql = "SELECT t01.id,
                       t01.fecha,
                       t01.id_expediente,
                       t01.id_empleado,
                       t03.id AS id_especialidad,
                       t04.nombre AS nombre_atencion,
                       t01.id_rangohora,
                       TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM')
                FROM cit_citas_dia t01
                INNER JOIN mnt_rangohora           t02 ON (t02.id = t01.id_rangohora)
                INNER JOIN mnt_aten_area_mod_estab t03 ON (t03.id = t01.id_aten_area_mod_estab)
                INNER JOIN ctl_atencion            t04 ON (t04.id = t03.id_atencion)
                WHERE t01.fecha = '$fecha'
                  AND t01.id_estado NOT IN (3,9)
                  AND t01.id_expediente          = :idExpediente
                  AND t01.id_empleado           = :idEmpleado
                  AND t01.id_aten_area_mod_estab = :idAtenAreaModEstab
                ";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idExpediente', $idExpediente);
        $stm->bindValue(':idEmpleado', $idEmpleado);
        $stm->bindValue(':idAtenAreaModEstab', $idAtenAreaModEstab);
        $stm->execute();
        $result = $stm->fetchAll();

        $citcita['citas'] = $result;

        /* Verificar si la cita ya tiene asociada una Historia Clinica y obtenerla */
        if (count($result) > 0) {
            $idCitaDia = $result[0]['id'];

            $sql = "SELECT h.id,
                           h.id_cita_dia,
                           h.id_estado_historia_clinica,
                           eh.codigo,
                           h.id_motivo_retroactivo
                    FROM sec_historial_clinico h
                    INNER JOIN ctl_estado_historia_clinica eh on (h.id_estado_historia_clinica = eh.id)
                    WHERE h.id_cita_dia = :idCitaDia";

            $stm = $this->container->get('database_connection')->prepare($sql);
            $stm->bindValue(':idCitaDia', $idCitaDia);
            $stm->execute();
            $result = $stm->fetchAll();

            $citcita['history'] = $result;
        } else {
            $citcita['history'] = array();
        }

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/historia/farmcomplement/paciente/match/get", name="datehistorycomplementmatch", options={"expose"=true})
     * @Method("GET")
     */
    public function dateHistoryComplementMatchAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $idEmpleado = $request->get('idEmpleado');
        $idExpediente = $request->get('idExpediente');
        $idAtenAreaModEstab = $request->get('idAtenAreaModEstab');
        $fechaConsulta = new \DateTime(str_replace("/", "-", $request->get('fechaConsulta')));
        $fecha = date('Y-m-d', $fechaConsulta->getTimestamp());
        $typeSearch = $request->get('typeSearch') ? $request->get('typeSearch') : 'retroactive';
        $sameDay = false;
        $idCitaDia = null;
        $idCitaDiaIndex = null;
        $citcita['history'] = array();
        $citcita['continue'] = null;
        $citcita['nextdatespecialty'] = false;

        $user = $this->getUser();

        /* Verificar proximas citas del paciente para la especialidad especificada */
        $sql = "SELECT t01.id,
                       t01.fecha,
                       t01.id_expediente,
                       t01.id_empleado,
                       t05.nombre || t05.apellido as nombre_empleado,
                       t03.id AS id_especialidad,
                       t04.nombre AS nombre_atencion,
                       t01.id_rangohora,
                       t02.hora_ini,
                       t01.id_estado,
                       t06.estado
                FROM cit_citas_dia t01
                INNER JOIN mnt_rangohora           t02 ON (t02.id = t01.id_rangohora)
                INNER JOIN mnt_aten_area_mod_estab t03 ON (t03.id = t01.id_aten_area_mod_estab)
                INNER JOIN ctl_atencion            t04 ON (t04.id = t03.id_atencion)
                INNER JOIN mnt_empleado            t05 ON (t05.id = t01.id_empleado)
                INNER JOIN cit_estado_cita         t06 ON (t06.id = t01.id_estado)
                WHERE t01.fecha >= '$fecha'
                  AND t01.id_estado NOT IN (3,9)
                  AND t01.id_expediente          = :idExpediente
                  AND t01.id_aten_area_mod_estab = :idAtenAreaModEstab
                ORDER BY t01.fecha ASC
                ";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idExpediente', $idExpediente);
        $stm->bindValue(':idAtenAreaModEstab', $idAtenAreaModEstab);
        $stm->execute();
        $result = $stm->fetchAll();

        $citcita['citas'] = $result;


        if (count($result) > 0) {

            $citcita['nextdatespecialty'] = true;

            /* Verifica si alguna de las citas de misma especialidad esta programa para la fecha actual */

            foreach ($result as $corr => $datespecialty) {
                if ($datespecialty['fecha'] == $fecha) {
                    $sameDay = true;
                    $idCitaDia = $datespecialty['id'];
                    $idCitaDiaIndex = $corr;
                }
                if ($sameDay)
                    break;
            }

            if ($sameDay) {
                $sql = "SELECT h.id,
                               h.id_cita_dia,
                               emp.nombre || emp.apellido as nombre_empleado,
                               h.id_estado_historia_clinica,
                               eh.codigo,
                               eh.nombre as estado_historia,
                               h.id_motivo_retroactivo
                        FROM sec_historial_clinico h
                        INNER JOIN ctl_estado_historia_clinica eh on (h.id_estado_historia_clinica = eh.id)
                        INNER JOIN mnt_empleado emp on (h.id_empleado = emp.id)
                        WHERE h.id_cita_dia = :idCitaDia";

                $stm = $this->container->get('database_connection')->prepare($sql);
                $stm->bindValue(':idCitaDia', $idCitaDia);
                $stm->execute();
                $result = $stm->fetchAll();

                $citcita['history'] = $result;
            }
        }

        $citcita['sameday'] = $sameDay;
        $citcita['idcitadia'] = $idCitaDia;
        $citcita['idcitadiaindex'] = $idCitaDiaIndex;

        if ($typeSearch == 'farmrecetas-complement') {

            /* ------ Buscar Historia Clinica de Entrega de Receta Repetitiva Complementaria existente------ */
            $dql = "SELECT historia
                    FROM MinsalSeguimientoBundle:SecHistorialClinico historia
                    WHERE historia.fechaconsulta = '$fecha'
                    AND historia.idExpediente = :idExpediente
                    AND historia.idAtenAreaModEstab = :idAtenAreaModEstab
                    AND historia.idEmpleado = :idEmpleado
                    AND historia.idTipoHistoriaClinica = 5 ";

            $continue = $em->createQuery($dql)
                    ->setParameter(':idExpediente', $idExpediente)
                    ->setParameter(':idEmpleado', $idEmpleado)
                    ->setParameter(':idAtenAreaModEstab', $idAtenAreaModEstab)
                    ->getResult();

            if (count($continue) > 0) {
                $citcita['continue']['id'] = $continue[0]->getId();
                $citcita['continue']['estado'] = $continue[0]->getIdEstadoHistoriaClinica()->getCodigo();
                $citcita['continue']['idEstado'] = $continue[0]->getIdEstadoHistoriaClinica()->getId();
            }


            /* ------ Proximas Citas del Paciente  ------------ */
            $dql = "SELECT citas
                    FROM MinsalCitasBundle:CitCitasDia citas
                    WHERE citas.fecha >= '$fecha'
                    AND citas.idExpediente = :idExpediente
                    AND citas.idAtenAreaModEstab = :idAtenAreaModEstab
                    AND citas.idEstado NOT IN (3,9)
                    ORDER BY citas.fecha ASC";

            $nextDates = $em->createQuery($dql)
                    ->setParameter(':idExpediente', $idExpediente)
                    ->setParameter(':idAtenAreaModEstab', $idAtenAreaModEstab)
                    ->setMaxResults('5')
                    ->getResult();

            $htmlCitas = '';
            if ($nextDates) {
                $htmlCitas.= '<div><h3><i class="fa fa-fw fa-clock-o"></i> Próximas Citas</h3>
                              <div class="table-responsive"><table class="table table-striped table-hover">
                                  <thead><tr><th>#</th><th>Fecha</th><th>Hora</th><th>Médico</th><th>Especialidad</th><th>Faltan</th><th></th></tr></thead>
                              <tbody>';
                foreach ($nextDates as $corr => $cita) {
                    $diff = $fechaConsulta->diff($cita->getFecha());
                    $htmlCitas.= '<tr>';
                    $htmlCitas.= '<td><a href="' . $this->generateUrl('citasgetcomprobante', array('id' => $cita->getId())) . '" target="_blank">' . ($corr + 1) . '</a></td>
                                  <td>' . $cita->getFecha()->format('d/m/Y') . '</td>
                                  <td>' . $cita->getIdRangoHora()->getHoraIni()->format('h:i A') . '</td>
                                  <td>' . $cita->getIdEmpleado() . '</td>
                                  <td>' . $cita->getIdAtenAreaModEstab()->getNombreConsulta() . '</td>
                                  <td>' . ( $diff->y > 0 ? ( $diff->y == 1 ? $diff->y . ' año ' : $diff->y . ' años ') : '' ) .
                            ( $diff->m > 0 ? ( $diff->m == 1 ? $diff->m . ' mes ' : $diff->m . ' meses ') : '' ) . ( $diff->d > 0 ? ( $diff->d == 1 ? $diff->d . ' día ' : $diff->d . ' dias' ) : '' ) . '</td>
                                  <td><a href="' . $this->generateUrl('citasgetcomprobante', array('id' => $cita->getId())) . '" target="_blank" class="btn btn-primary"><span class="fa fa-print"></span></a></td>';
                    $htmlCitas.= '</tr>';
                }
                $htmlCitas.= '</tbody></table></div></div>';
            } else {
                $htmlCitas.= '<div><h3><i class="fa fa-fw fa-clock-o"></i> Próximas Citas</h3></div><p class="bg-warning"><i class="fa fa-fw fa-warning"></i> El paciente no tiene citas próximas en la especialidad.</p>';
            }

            $citcita['nextdates'] = $htmlCitas;

            /* ------ Ultimas Historias del Paciente  ------------ */

            $dql = "SELECT historias
                    FROM MinsalSeguimientoBundle:SecHistorialClinico historias
                    WHERE historias.fechaconsulta <= '$fecha'
                    AND historias.idExpediente = :idExpediente
                    AND historias.piloto = 'F'
                    AND historias.idAtenAreaModEstab = :idAtenAreaModEstab
                    ORDER BY historias.fechaconsulta DESC";

            $lastHistories = $em->createQuery($dql)
                    ->setParameter(':idExpediente', $idExpediente)
                    ->setParameter(':idAtenAreaModEstab', $idAtenAreaModEstab)
                    ->setMaxResults('5')
                    ->getResult();

            $htmlHistories = '';
            if ($lastHistories) {
                $htmlHistories.= '<div><h3><i class="fa fa-fw fa-stethoscope"></i> Últimas Consultas<a id="seeAllHistory" onClick="openPostPopUpWindows( { action: \'' . $this->generateUrl('admin_minsal_seguimiento_sechistorialclinico_list') . '?external=true\', method: \'post\', target: \'Historial Clínico\', parameters: { idExpedienteHclinica: ' . $idExpediente . ', external: \'true\', selectable: \'true\' } } )" target="_blank" style="float: right; font-size: 14px;" class="mouse-pointer"><i class="fa fa-fw fa-folder-open"></i> Ver Todas</a></h3>
                                  <div class="table-responsive"><table class="table table-striped table-hover">
                                  <thead><tr><th>#</th><th>Fecha</th><th>Médico</th><th>Especialidad</th><th>Realizada</th><th>Seguimiento de Consulta</th></tr></thead>
                              <tbody>';
                foreach ($lastHistories as $corr => $history) {
                    $diff = $fechaConsulta->diff($history->getFechaconsulta());
                    $htmlHistories.= '<tr>';
                    $htmlHistories.= '<td><a onClick="openPostPopUpWindows( { action: \'' . $this->generateUrl('admin_minsal_seguimiento_sechistorialclinico_show', array('id' => $history->getId())) . '?external=true\', method: \'post\', target: \'Ver Historia Clínica\'})" target="_blank" class="mouse-pointer">' . ($corr + 1) . '</a></td>
                                  <td>' . $history->getFechaconsulta()->format('d/m/Y') . '</td>
                                  <td>' . $history->getIdEmpleado() . '</td>
                                  <td>' . $history->getIdAtenAreaModEstab()->getNombreConsulta() . '</td>
                                  <td> ' . (($diff->y > 0 || $diff->m > 0 || $diff->d > 0) ? 'Hace ' : 'Hoy ') . ( $diff->y > 0 ? ( $diff->y == 1 ? $diff->y . ' año ' : $diff->y . ' años ') : '' ) . ( $diff->m > 0 ? ( $diff->m == 1 ? $diff->m . ' mes ' : $diff->m . ' meses ') : '' ) . ( $diff->d > 0 ? ( $diff->d == 1 ? $diff->d . ' día ' : $diff->d . ' dias' ) : '' ) . '</td>
                                  <td><a onClick="openPostPopUpWindows( { action: \'' . $this->generateUrl('admin_minsal_seguimiento_sechistorialclinico_show', array('id' => $history->getId())) . '?external=true\', method: \'post\', target: \'Ver Historia Clínica\'})" target="_blank" class="btn btn-primary"><span class="fa fa-search-plus"></span></a><a onClick="setHistoriaSeguimiento(' . $history->getId() . ')" class="btn btn-success view_link" btn-selectable="true" title="" style="margin-left: 2px;"><i class="glyphicon glyphicon-ok-sign"></i> Seleccionar</a></td>';
                    $htmlHistories.= '</tr>';
                }
                $htmlHistories.= '</tbody></table></div></div>';
            } else {
                $htmlHistories.= '<div><a id="seeAllHistory" onClick="openPostPopUpWindows( { action: \'' . $this->generateUrl('admin_minsal_seguimiento_sechistorialclinico_list') . '?external=true\', method: \'post\', target: \'Historial Clínico\', parameters: { idExpedienteHclinica: ' . $idExpediente . ', external: \'true\', selectable: \'false\' } } )" target="_blank" style="float: right; font-size: 14px;" class="mouse-pointer"><i class="fa fa-fw fa-folder-open"></i> Ver Todas</a><h3><i class="fa fa-fw fa-stethoscope"></i> Últimas Historia Clínicas</h3></div><p class="bg-warning"><i class="fa fa-fw fa-warning"></i> El paciente no posee ninguna Historia Clínica a la fecha en la especialidad seleccionada.</p>';
            }

            $citcita['lasthistories'] = $htmlHistories;
        }

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/comprobante/get", name="citasgetcomprobante", options={"expose"=true})
     * @Method({"GET", "POST"})
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     */
    public function getComprobanteCitaAction() {
        $request = $this->getRequest();
        $id = $request->get('id');

        return $this->render('MinsalCitasBundle:Reports:comprobante_cita.html.twig', array('id' => $id));
    }

    /**
     * @Route("/citas/info/rango", name="get_citas_info_rango", options={"expose"=true})
     * @Method("GET")
     */
    public function getCitasInfoRangoAction() {
        $em         = $this->getDoctrine()->getManager();
        $request    = $this->getRequest();
        $lowerLimit = $request->get('fechaInicial');
        $upperLimit = $request->get('fechaFinal');
        $idEmpleado = $request->get('idEmpleado');
        $idEspecialidad      = $request->get('idEspecialidad');
        $weekend             = $request->get('weekend') ? ( $request->get('weekend') === 'true' ? true : false ) : false;
        $citCitasDiaService  = $this->container->get('cit_citas_dia.services');
        $showHorarioReal     = $request->get('showHorarioReal') ? (string) $request->get('showHorarioReal') : 'true';
        $mostrarDetalleCitas = $request->get('mostrarDetalleCitas') ? ( $request->get('mostrarDetalleCitas') === 'true' ? true : false ) : false;
        $outputFormat        = $request->get('outputFormat') ? $request->get('outputFormat') : 'd/m/Y';

        /*****************************************************************************************
         * Obteniendo la cantidad de citas por primera vez, subsecuentes, agregados, atendidos
         * y total de citas para cada dia de un mes determinado por usuario y especialidad
         ****************************************************************************************/
        $citcita = $citCitasDiaService->getRangoCitasInfo($idEmpleado, $idEspecialidad, $lowerLimit, $upperLimit, $weekend, $showHorarioReal, $mostrarDetalleCitas, $outputFormat);

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/tipo/cita/{idEmpleado}/{idEspecialidad}/{idExpediente}", name="citas_tipo_cita", options={"expose"=true})
     * @Method("GET")
     */
    public function determinarTipoCitaAction($idEmpleado, $idEspecialidad, $idExpediente) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $citCitasDiaService = $this->container->get('cit_citas_dia.services');

        /*****************************************************************************************
         * Obteniendo la cantidad de citas por primera vez, subsecuentes, agregados, atendidos
         * y total de citas para cada dia de un mes determinado por usuario y especialidad
         ****************************************************************************************/
        $citcita = $citCitasDiaService->determinarTipoCita($idEmpleado, $idEspecialidad, $idExpediente);

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/transferir/cita", name="citas_transferir_cita", options={"expose"=true})
     * @Method("POST")
     */
    public function transferirCitasAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $data = json_decode($request->get('citas'), true);
        $status = false;
        $user = $this->getUser();

        $citcita['notFound'] = array();
        $citcita['transferred'] = array();
        $citcita['errorDetail'] = '';

        $em->getConnection()->beginTransaction();
        try {
            foreach ($data as $key => $cita) {
                $CitCitasDiaAnt = $em->getRepository('MinsalCitasBundle:CitCitasDia')->findOneById($cita['idCita']);

                if ($CitCitasDiaAnt) {
                    $CitTipocita         = $em->getRepository('MinsalCitasBundle:CitTipocita')->findOneById(( $cita['tipoCita'] === 'pv' ? 1 : 2));
                    $MntAtenAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($cita['idEspecialidad']);
                    $CitJustificacion    = $cita['agregado'] ? $em->getRepository('MinsalCitasBundle:CitJustificacion')->findOneById($cita['idMotivo']) : NULL;
                    $MntEmpleado         = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneById($cita['idEmpleado']);
                    $MntRangohora        = $em->getRepository('MinsalSiapsBundle:MntRangohora')->findOneById($cita['idRangohora']);
                    $CitEstadoCita       = $em->getRepository('MinsalCitasBundle:CitEstadoCita')->findOneById(3);
                    $newDate             = \DateTime::createFromFormat('d-m-Y', $cita['fecha']);
                    $newCitEstadoCita    = $CitJustificacion !== NULL ? $CitCitasDiaAnt->getIdEstado() : $em->getRepository('MinsalCitasBundle:CitEstadoCita')->findOneById(1);
                    $CitDistribucion     = $MntEmpleado->getResidente() !== true ? $em->getRepository('MinsalCitasBundle:CitDistribucion')->findOneBy( array( 'idEmpleado' => $cita['idEmpleado'], 'dia' => date("w", $newDate->getTimestamp()), 'mes' => date("n", $newDate->getTimestamp()), 'yrs' => date("Y", $newDate->getTimestamp()), 'idAtenAreaModEstab' => $MntAtenAreaModEstab->getId(), 'idRangohora' => $MntRangohora->getId() ) ) : NULL;

                    $CitCitasDiaNueva = new CitCitasDia();
                    $CitCitasDiaNueva->setIdTipoCIta($CitTipocita);
                    $CitCitasDiaNueva->setIdAtenAreaModEstab($MntAtenAreaModEstab);
                    $CitCitasDiaNueva->setIdEstado($newCitEstadoCita);
                    $CitCitasDiaNueva->setFecha($newDate);
                    $CitCitasDiaNueva->setIdusuarioreg($user);
                    $CitCitasDiaNueva->setFechahorareg(new \DateTime());
                    $CitCitasDiaNueva->setIdJustificacion($CitJustificacion);
                    $CitCitasDiaNueva->setIpcita($request->server->get('REMOTE_ADDR'));
                    $CitCitasDiaNueva->setIdEmpleado($MntEmpleado);
                    $CitCitasDiaNueva->setIdExpediente($CitCitasDiaAnt->getIdExpediente());
                    $CitCitasDiaNueva->setIdEstablecimiento($CitCitasDiaAnt->getIdEstablecimiento());
                    $CitCitasDiaNueva->setIdEstablecimientoReferencia($CitCitasDiaAnt->getIdEstablecimientoReferencia());
                    $CitCitasDiaNueva->setIdRangohora($MntRangohora);
                    $CitCitasDiaNueva->setIdAreaModEstab($MntAtenAreaModEstab->getIdAreaModEstab());
                    $CitCitasDiaNueva->setCitaPor($CitCitasDiaAnt->getCitaPor());
                    $CitCitasDiaNueva->setIdPrioridad($CitCitasDiaAnt->getIdPrioridad());
                    $CitCitasDiaNueva->setIdDistribucion($CitDistribucion);

                    $CitCitasDiaAnt->setIdEstado($CitEstadoCita);

                    $CitCitaTransferida = new CitCitaTransferida();
                    $CitCitaTransferida->setIdCitaAntigua($CitCitasDiaAnt);
                    $CitCitaTransferida->setIdCitaNueva($CitCitasDiaNueva);

                    $em->persist($CitCitasDiaNueva);
                    $em->persist($CitCitaTransferida);
                    $em->persist($CitCitasDiaAnt);
                    $em->flush();

                    $citcita['transferred'][] = array('idHtml' => $cita['htmlId'], 'id'=> $CitCitasDiaNueva->getId(), 'numeroExpediente' => $CitCitasDiaNueva->getIdExpediente()->getNumero(), 'nombrePaciente' => $CitCitasDiaNueva->getIdExpediente()->getIdPaciente()->getNombrePaciente(), 'fechaHora' => $newDate->format('d/m/Y').' '.$MntRangohora->getFormatterRangHora());
                } else {
                    $citcita['notFound'][] = $cita['htmlId'];
                }
            }

            $em->getConnection()->commit();
            $status = true;
        } catch (\Exception $ex) {
            $em->getConnection()->rollback();

            $citcita['transferred'] = array();
            $citcita['notFound'] = array();
            $citcita['errorDetail'] = $ex;
        }

        $citcita['status'] = $status;

        return new Response(json_encode($citcita));
    }

    /**
     * @Route("/citas/verificar/cita/previa", name="citas_verificar_cita_previa", options={"expose"=true})
     * @Method("GET")
     */
    public function verificarCitaPreviaAction() {
        $em             = $this->getDoctrine()->getManager();
        $request        = $this->getRequest();
        $idExpediente   = $request->get('idExpediente');
        $idEmpleado     = $request->get('idEmpleado');
        $idEspecialidad = $request->get('idEspecialidad');
        $today          = new \DateTime();
        $result         = array();

        $qb = $em->createQueryBuilder();
        $citaPrevia = $qb->select('t01')
                         ->from('MinsalCitasBundle:CitCitasDia', 't01')
                         ->where('t01.fecha > :today')
                         // ->andWhere('t01.idEmpleado = :idEmpleado')
                         ->andWhere('t01.idExpediente = :idExpediente')
                         ->andWhere('t01.idAtenAreaModEstab = :idEspecialidad')
                         ->andWhere('t01.idEstado = 1 OR t01.idEstado = 6')
                         ->setParameters(array(
                            ':today' => date('Y-m-d', $today->getTimestamp()),
                            // ':idEmpleado'   => $idEmpleado,
                            ':idExpediente' => $idExpediente,
                            ':idEspecialidad' => $idEspecialidad))
                         ->getQuery()
                         ->setHint(Query::HINT_INCLUDE_META_COLUMNS, true) // Para obtener las llaves Foráneas
                         ->getResult();

        if($citaPrevia) {
            $citaPrevia = $citaPrevia[0];

            $result['id']                     = $citaPrevia->getId();
            $result['fecha']                  = $citaPrevia->getFecha()->format('Y-m-d');
            $result['fechahorareg']           = $citaPrevia->getFechahorareg()->format('Y-m-d');
            $result['ipcita']                 = $citaPrevia->getIpcita();
            $result['ipconfirmado']           = $citaPrevia->getIpconfirmado();
            $result['citaPor']                = $citaPrevia->getCitaPor();
            $result['orden']                  = $citaPrevia->getOrden();
            $result['fechahoramod']           = $citaPrevia->getFechahoramod() ? $citaPrevia->getFechahoramod()->format('Y-m-d') : null;
            $result['idEstado']               = $citaPrevia->getIdEstado()->getId();
            $result['nombreEstado']           = $citaPrevia->getIdEstado()->getEstado();
            $result['idTipocita']             = $citaPrevia->getIdTipocita()->getId();
            $result['nombreTipocita']         = $citaPrevia->getIdTipocita()->getTipocita();
            $result['idEstablecimiento']      = $citaPrevia->getIdEstablecimiento()->getId();
            $result['nombreEstablecimiento']  = $citaPrevia->getIdEstablecimiento()->getNombre();
            $result['idusuarioreg']           = $citaPrevia->getIdusuarioreg()->getId();
            $result['nombreUsuarioreg']       = $citaPrevia->getIdusuarioreg()->getUsername();
            $result['idAreaModEstab']         = $citaPrevia->getIdAreaModEstab()->getId();
            $result['nombreAreaModEstab']     = $citaPrevia->getIdAreaModEstab()->__toString();
            $result['idAtenAreaModEstab']     = $citaPrevia->getIdAtenAreaModEstab()->getId();
            $result['nombreAtenAreaModEstab'] = $citaPrevia->getIdAtenAreaModEstab()->getNombreConsulta();
            $result['idEmpleado']             = $citaPrevia->getIdEmpleado()->getId();
            $result['nombreEmpleado']         = $citaPrevia->getIdEmpleado()->getNombreempleado();
            $result['idExpediente']           = $citaPrevia->getIdExpediente()->getId();
            $result['numeroExpediente']       = $citaPrevia->getIdExpediente()->getNumero();
            $result['idRangohora']            = $citaPrevia->getIdRangohora()->getId();
            $result['rangohora']              = $citaPrevia->getIdRangohora()->getFormatterRangHora();
        }

        return new Response(json_encode($result));
    }

    /**
     * @Route("/consultar/proximas/citas/", name="consultar_citas_proximas", options={"expose"=true})
     * @Method("GET")
     */
    public function consultarProximasCitasAction(){
        $em          = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $idExpediente = $request->get('idExpediente');
        $idEspecialidad = $request->get('idAtenAreaModEstab');
        $rangoFechas = $request->get('rangoFechas');
        $fechaActual = new \DateTime();
        $condicion='';
        $fechas=array();

        if($idEspecialidad != ''){
            $condicion.=" AND cit.idAtenAreaModEstab=$idEspecialidad";
        }

        if($rangoFechas != ''){
            $fechas=explode('-', $rangoFechas);
            $condicion.=" AND cit.fecha>='".$fechas[0]."' AND cit.fecha<='".$fechas[1]."'";
        }else{
            $condicion.=" AND cit.fecha >= '".$fechaActual->format('Y-m-d')."'";
        }

        $dql = "SELECT cit
                FROM MinsalCitasBundle:CitCitasDia  cit
                WHERE cit.idExpediente = $idExpediente
                 $condicion
                AND cit.idEstado NOT IN (3,9)
                ORDER BY cit.fecha";

        $result = $em->createQuery($dql)
                     ->getResult();

        return $this->render('MinsalCitasBundle:CitasMedicas:carga_citas.html.twig', array('citasMedicas'=>$result));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON con todas las especialidades por area y la cantidad
     *               de citas en cada especialidad para un expeiente.
     * ANALISTA PROGRAMADOR: Karen Peñate, Victoria López
     */

    /**
     * @Route("/citas/expediente/{idAreaModEstab}/{idExpediente}", name="obtener_cantidad_citas_expediente", options={"expose"=true})
     */
    public function obtenerEspecialidadesPorArea($idAreaModEstab,$idExpediente) {
        $em          = $this->getDoctrine()->getManager();
        $repositorio = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab');
        $resultados  = $repositorio->obtenerIdAtenAreaModEstab($idAreaModEstab);
        $envio       = array();

        $citCitasDiaService = $this->container->get('cit_citas_dia.services');
        $fechaActual = $citCitasDiaService->addOrSubDays( ( new \DateTime() ) , 1, 'add');

        foreach ($resultados as $key => $value) {
            $envio[$key]['text'] = $value->getIdAtencion()->getNombre();
            $idAtenAreaModEstab=$value->getId();
            /****************************************************************************************
             * Obteniendo si la especialidad posee tipo de distribución que permite mas citas
             ****************************************************************************************/
            $sql = "SELECT DISTINCT (t02.id) as id,COALESCE(t02.nombre) as text
                     FROM cit_distribucion t01
                         INNER JOIN cit_tipo_distribucion t02 ON (t02.id=t01.id_tipo_distribucion AND permite_mas_citas=true)
                     WHERE t01.id_aten_area_mod_estab=$idAtenAreaModEstab";

            $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
            $stm->execute();
            $tiposDistribucion = $stm->fetchAll();

            $idTiposDistribucion=array();
            foreach ($tiposDistribucion as $llave=>$tipo) {
                $idTiposDistribucion[$llave]=$tipo['id'];
            }

            /****************************************************************************************
             * Obteniendo la cantidad de citas del paciente en esa especialidad
             ****************************************************************************************/
            $fechaFin = NULL;
            $citasPacientes   = $citCitasDiaService->pacientePoseeCita($idExpediente, $fechaActual->format('d/m/Y'), $fechaFin,$idAtenAreaModEstab);

            $envio[$key]['id']      = $value->getId();
            $envio[$key]['cuantas'] = count($citasPacientes);
            $envio[$key]['tipoDistribucionCita'] = 0;//APARECERA COMO ESPECIALIDAD NORMAL
            $envio[$key]['idTipoDistribucion']=null;

            /****************************************************************************************
             * Obteniendo la cantidad de citas del paciente en esa especialidad
             ****************************************************************************************/

             if (count($idTiposDistribucion)>0){
                 $i=0;
                 foreach ($citasPacientes as $cita) {
                     $i++;
                     $distribucion=$em->getRepository('MinsalCitasBundle:CitDistribucion')->find($cita['id_distribucion']);
                     if(in_array($distribucion->getIdTipoDistribucion()?$distribucion->getIdTipoDistribucion()->getId():NULL,$idTiposDistribucion)){
                        $envio[$key]['tipoDistribucionCita'] = 2;//APARACERÁ COMO UNA CITA EN ESPECIALIDAD CON TIPO DISTRIBUCION
                        $envio[$key]['idTipoDistribucion'].= $distribucion->getIdTipoDistribucion()->getId().',';//APARACERÁ COMO UNA CITA EN ESPECIALIDAD CON TIPO DISTRIBUCION
                    }else{
                        $envio[$key]['tipoDistribucionCita'] = 1;//APARACERÁ COMO UNA CITA EN LA ESPECIALIDAD SIN TIPO DISTRIBUCION QUE PERMITE MAS CITA
                        $envio[$key]['idTipoDistribucion'].= 'cn,';//APARACERÁ COMO UNA CITA EN ESPECIALIDAD CON TIPO DISTRIBUCION
                    }
                 }
                 if($i==(count($tiposDistribucion)+1)){
                     $envio[$key]['tipoDistribucionCita'] = 0;//APARECERA COMO ESPECIALIDAD NORMAL
                     $envio[$key]['idTipoDistribucion']=null;
                 }else{
                    $envio[$key]['idTipoDistribucion']=trim($envio[$key]['idTipoDistribucion'],',');
                 }

             }
        }

        $resultados = array();
        $resultados['resultados'] = $envio;

        return new Response(json_encode($resultados));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON las especialidades por area.
     * ANALISTA PROGRAMADOR: Karen Peñate, Ing. Victoria López
     */

    /**
     * @Route("/obtener/medicos/tipocita/especialidad/{idAtenAreaModEstab}/{idTipocita}/{idTipoDistribucionCita}", name="obtener_medicos_tipocita_especialidad", options={"expose"=true})
     */
    public function obtenerMedicosPorEspecialidadPorTipocita($idAtenAreaModEstab,$idTipocita,$idTipoDistribucionCita) {

        $em = $this->getDoctrine()->getManager();
        $fechaActual=new \DateTime();
        $mes=$fechaActual->format('m');
        $yrs=$fechaActual->format('Y');

        $whereTipocita='';
        $whereIdTipoDistribucion='';
        switch ($idTipocita) {
          case '1':
               $whereTipocita='AND C.primera <> 0';
            break;
            case '2':
                 $whereTipocita='AND C.subsecuente <> 0';
           break;
        }

        if($idTipoDistribucionCita!='na'){
            if($idTipoDistribucionCita == 'cn'){
               $whereIdTipoDistribucion=' INNER JOIN cit_tipo_distribucion D ON (C.id_tipo_distribucion=D.id AND permite_mas_citas=true)';
            }else{
                if(strstr($idTipoDistribucionCita, 'cn')){
                   $tipos=str_replace('cn,','',$idTipoDistribucionCita);
                   $tipos=str_replace(',cn','',$tipos);
                   $whereIdTipoDistribucion=" INNER JOIN cit_tipo_distribucion D ON (C.id_tipo_distribucion=D.id AND permite_mas_citas=true and C.id_tipo_distribucion NOT IN ($tipos))";
               }else{
                   $whereIdTipoDistribucion=" WHERE C.id_tipo_distribucion IS NULL OR C.id_tipo_distribucion NOT IN ($idTipoDistribucionCita)";
               }
            }
        }

        $sql="SELECT DISTINCT B.id AS id, initcap(B.nombreempleado) as text
                FROM mnt_empleado_especialidad_estab A
                INNER JOIN mnt_empleado B ON (A.id_empleado = B.id and A.id_aten_area_mod_estab=$idAtenAreaModEstab AND B.habilitado=true)
                INNER JOIN cit_distribucion C ON (C.id_empleado = B.id AND C.id_estado_distribucion=1 AND C.id_aten_area_mod_estab= A.id_aten_area_mod_estab
                $whereTipocita AND ((C.yrs=$yrs AND C.mes>=$mes) OR (C.yrs>$yrs)))
                $whereIdTipoDistribucion
                ORDER BY text ASC
        ";
        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        $resultados = array();
        $resultados['resultados'] = $result;

        return new Response(json_encode($resultados));
    }

    /**
     * @Route("/citas/test", name="citas_test", options={"expose"=true})
     * @Method("GET")
     */
    public function testAction(){
        $em = $this->getDoctrine()->getManager();
        $CitasService = $this->container->get('cit_citas_dia.services');
        $ProcedimientoServices = $this->container->get('cit_citas_procedimientos.services');

        // $result = $ProcedimientoServices->getRangoCitasInfo(3479, 1, 157, '14/07/2016', '30/07/2016', false, 'true', true);
        // ($idEmpleado, $idExpediente, $idTipoCita = NULL, $idEspecialidad = NULL, $idAreaModEstab, $idProcedimientoEstablecimiento = NULL, $fechaInicial = NULL, $fechaFinal =  NULL, $origenCita = 1, $incluirAgregados = FALSE, $autoSeleccionarHorario = FALSE, $excluirFechas = array(), $permitirMasCitas = FALSE, $formatoFecha = 'd/m/Y')
        // $result = $CitasService->obtenerCupoDisponible(13, 116597, 2, 1, 1, NULL, '15/07/2016', NULL, 1, TRUE, FALSE);
        // $cargaCitas = $procedimientoServices->getRangoCitasInfo($idProcedimiento, $idAreaModEstab, $idEmpleado, $currentDate->format('d/m/Y'), $currentDate->format('d/m/Y'), false, 'true', false);
        $result = $CitasService->obtenerCupoDisponible(125, 116597, 2, 1, 1, NULL, '15/08/2016', NULL, 1, FALSE, FALSE, array(), FALSE, TRUE, 2);

        // insertarCita($idEmpleado, $idExpediente, $idEspecialidad, $fecha, $idRangoHora, $idTipoCita, $idDistribucion = NULL, $idJustificacion = NULL, $idEstablecimiento = NULL, $idEstablecimientoReferencia = NULL, $inputFormat = 'd/m/Y') {
        // $result = $CitasService->insertarCita(13, 116597, 1, '28/07/2016', 77, 2, NULL);

        return new Response(json_encode($result));
    }

    /**
     * @Route("/dar/cita/medica", name="dar_cita_medica", options={"expose"=true})
     * @Method("GET")
     */
    public function darCitaAction(){
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $idEspecialidad = $request->get('idEspecialidad');
        $idTipoCita     = $request->get('idTipoCita');
        $idExpediente   = $request->get('idExpediente');
        $idEmpleado     = $request->get('idEmpleado');
        $fecha   = $request->get('fecha');
        $idRangoHora   = $request->get('idRangoHora');
        $idEstadoCita   = $request->get('idEstadoCita');
        $idDistribucion   = $request->get('idDistribucion');
        $idJustificacion   = $request->get('idJustificacion')==0?NULL:$request->get('idJustificacion');
        $idEstablecimientoReferencia   = $request->get('idEstablecimientoReferencia')!=''?$request->get('idEstablecimientoReferencia'):NULL;
        $numeroExpedienteReferencia = $request->get('numeroExpedienteReferencia')!=''?$request->get('numeroExpedienteReferencia'):NULL;

        $citasService = $this->container->get('cit_citas_dia.services');

        $darCita= $citasService->insertarCita($idEmpleado, $idExpediente, $idEspecialidad, $fecha,
        $idRangoHora, $idTipoCita, $idEstadoCita,  $idDistribucion,$idJustificacion,NULL, $idEstablecimientoReferencia, $numeroExpedienteReferencia);

        return new Response(json_encode($darCita));
    }
    /**
     * @Route("/consulta/citas/por/dia", name="consulta_citas_por_dia", options={"expose"=true})
     * @Method("GET")
     */

    public function getConsultaCitasPorDiaAction() {
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);
        $fechas = explode('-', $datos['rango_fechas']);
        $idAtenAreaModEstab = $datos['idAtenAreaModEstab']?$datos['idAtenAreaModEstab']:NULL;


        return $this->render('MinsalCitasBundle:Reports:CitasMedicas/cargarCitasDia.html.twig', array(
            'fechaInicio'=>$fechas[0],
            'fechaFin'=>$fechas[1],
            'idEspecialidad'=>$idAtenAreaModEstab,
            'idAreaModEstab'=>$datos['idAreaModEstab']
        ));
    }

    /**
     * @Route("/consulta/fechas/libres/citasmedicas", name="consulta_fechas_libres", options={"expose"=true})
     * @Method("GET")
     */

    public function getConsultaFechasLibresAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $citasService = $this->container->get('cit_citas_dia.services');

        parse_str($request->get('datos'), $datos);
        $idAtenAreaModEstab = $datos['idAtenAreaModEstab'];
        $idEspecialidad=$em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find(intval($idAtenAreaModEstab));
        $fechaActual=new \DateTime();

        $horarios=array();

        $fechaActual=new \DateTime();
        $mes=$fechaActual->format('m');
        $yrs=$fechaActual->format('Y');

        $sql="SELECT DISTINCT B.id AS id, initcap(B.nombreempleado) as nombreempleado, max(primera) as primeravez,max(subsecuente) as subsecuente,
                     COALESCE (D.id, 0) as id_tipo_distribucion, COALESCE (D.nombre,'Consulta Normal') as tipo_distribucion
                FROM mnt_empleado_especialidad_estab A
                INNER JOIN mnt_empleado B ON (A.id_empleado = B.id and A.id_aten_area_mod_estab=$idAtenAreaModEstab AND B.habilitado=true)
                INNER JOIN cit_distribucion C ON (C.id_empleado = B.id AND C.id_estado_distribucion=1 AND C.id_aten_area_mod_estab= A.id_aten_area_mod_estab
                      AND ((C.yrs=$yrs AND C.mes>=$mes) OR (C.yrs>$yrs)))
                LEFT JOIN cit_tipo_distribucion D ON (D.id=C.id_tipo_distribucion)
                GROUP BY B.id,D.id
                ORDER BY nombreempleado ASC
        ";
        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $medicos = $stm->fetchAll();
        $i=0;
        foreach ($medicos as $key => $medico) {
            $horarios[$i]['medico']=$medico['nombreempleado'];
            $horarios[$i]['id']=$medico['id'];
            $tipoDistribucion=$medico['id_tipo_distribucion']==0?NULL:$medico['id_tipo_distribucion'];

            if($medico['primeravez']>0){
                $horarios[$i]['primeravez']=$citasService->obtenerCupoDisponible($medico['id'], NULL, 1, $idAtenAreaModEstab,
                $idEspecialidad->getIdAreaModEstab()->getId(),NULL, $fechaActual->format('d/m/Y'), NULL,1,FALSE, FALSE, array(), FALSE,TRUE,$tipoDistribucion);
            }else{
                $horarios[$i]['primeravez']=null;
            }

            if($medico['subsecuente']>0){
                $horarios[$i]['subsecuente']=$citasService->obtenerCupoDisponible($medico['id'], NULL, 2, $idAtenAreaModEstab,
                $idEspecialidad->getIdAreaModEstab()->getId(),NULL, $fechaActual->format('d/m/Y'), NULL,1,FALSE, FALSE, array(), FALSE,TRUE,$tipoDistribucion);
            }else{
                $horarios[$i]['subsecuente']=null;
            }
            $i++;
        }

        return $this->render('MinsalCitasBundle:Reports:CitasMedicas/cargarFechasLibres.html.twig', array(
            'horariosDisponibles'=>$horarios
        ));
    }

    /**
     * @Route("/consulta/estadistica/medico", name="consulta_estadistica_medico", options={"expose"=true})
     * @Method("GET")
     */

    public function consultaEstadisticaMedicoAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $citasService = $this->container->get('cit_citas_dia.services');

        parse_str($request->get('datos'), $datos);
        $idAtenAreaModEstab = $datos['idAtenAreaModEstab'];
        $anio=intval($datos['anio']);

        $sql=   "SELECT SUM((t05.primera)*
                		(SELECT count(d.date) as n_lunes FROM
                		(SELECT generate_series('$anio-01-01'::timestamp, '$anio-12-31'::timestamp, '1 day'::interval) as date ) d
                		WHERE EXTRACT('month' from d.date) = t05.mes
                		AND EXTRACT('dow' from d.date) = t05.dia)
                	) as capacidad_primera,
                	SUM((t05.subsecuente)*
                		(SELECT count(d.date) as n_lunes FROM
                		(SELECT generate_series('$anio-01-01'::timestamp, '$anio-12-31'::timestamp, '1 day'::interval) as date ) d
                		WHERE EXTRACT('month' from d.date) = t05.mes
                		AND EXTRACT('dow' from d.date) = t05.dia)
                	)as capacidad_subsecuente,
                       t06.id_empleado,
                       t06.primera_vez,
                       t06.subsecuente,
                       t06.nombreempleado,
                       t06.mes,
                       t06.dia
                FROM cit_distribucion t05 INNER JOIN (
                		SELECT COALESCE(SUM(CASE WHEN t01.id_tipocita=1 THEN 1 END),0) as primera_vez,
                		       COALESCE(SUM(CASE WHEN t01.id_tipocita=2 THEN 1 END),0) as subsecuente,
                		       t01.id_empleado,
                		       EXTRACT ('MONTH' FROM t01.fecha) as mes,
                		       EXTRACT ('dow' FROM t01.fecha) as dia,
                		       initcap(t03.nombreempleado) as nombreempleado
                		FROM cit_citas_dia t01
                			INNER JOIN mnt_empleado t03 ON (t03.id=t01.id_empleado)
                		WHERE t01.id_aten_area_mod_estab=$idAtenAreaModEstab AND EXTRACT ('YEAR' FROM t01.fecha)=$anio
                		GROUP BY t01.id_empleado,initcap(t03.nombreempleado),EXTRACT ('MONTH' FROM t01.fecha),EXTRACT ('dow' FROM t01.fecha)
                		ORDER BY nombreempleado ASC, mes ASC
                	) t06 ON (t05.dia=t06.dia and t05.id_empleado=t06.id_empleado AND t05.mes=t06.mes
                              AND t05.yrs=$anio AND t05.id_estado_distribucion=1
                              AND t05.id_aten_area_mod_estab=$idAtenAreaModEstab)
                GROUP BY t06.id_empleado,t06.mes,t06.primera_vez,t06.subsecuente,t06.nombreempleado,t06.dia
                ORDER BY nombreempleado ASC, mes ASC,dia ASC";

        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        $resultados=array();
        $idEmpleado='';
        $mes='';
        foreach ($result as $valor) {
            if($idEmpleado!=$valor['id_empleado']){
                $idEmpleado=$valor['id_empleado'];
                $resultados[$idEmpleado]['nombre']=$valor['nombreempleado'];
            }

            if($mes!=$valor['mes']){
                $mes=$valor['mes'];
                $resultados[$idEmpleado]['meses'][$mes]['asignadas_p']=0;
                $resultados[$idEmpleado]['meses'][$mes]['asignadas_s']=0;
                $resultados[$idEmpleado]['meses'][$mes]['capacidad_p']=0;
                $resultados[$idEmpleado]['meses'][$mes]['capacidad_s']=0;
            }

            $resultados[$idEmpleado]['meses'][$mes]['asignadas_p']+=$valor['primera_vez'];
            $resultados[$idEmpleado]['meses'][$mes]['asignadas_s']+=$valor['subsecuente'];
            $resultados[$idEmpleado]['meses'][$mes]['capacidad_p']+=$valor['capacidad_primera'];
            $resultados[$idEmpleado]['meses'][$mes]['capacidad_s']+=$valor['capacidad_subsecuente'];
        }

        return $this->render('MinsalCitasBundle:Reports:CitasMedicas/cargarEstadisticaMedico.html.twig', array(
            'resultados'=>$resultados
        ));
    }

    /**
     * @Route("/obtener/tipodistribucion/{idEmpleado}/{idAtenAreaModEstab}/{idTipoDistribucionCita}", name="obtener_tipodistribucion_medico", options={"expose"=true})
     */
    public function obtenerTipodistribucionPorMedico($idEmpleado,$idAtenAreaModEstab,$idTipoDistribucionCita) {
        $em = $this->getDoctrine()->getManager();

        $whereIdTipoDistribucion='';
        $joinTipoDistribucion='';
        $fechaActual=new \DateTime();
        $mes=$fechaActual->format('m');
        $yrs=$fechaActual->format('Y');

        if($idTipoDistribucionCita!='na'){
            if($idTipoDistribucionCita == 'cn'){
               $joinTipoDistribucion=' INNER JOIN cit_tipo_distribucion t02 ON (t01.id_tipo_distribucion=t02.id AND permite_mas_citas=true)';
            }else{
                if(strstr($idTipoDistribucionCita, 'cn')){
                   $tipos=str_replace('cn,','',$idTipoDistribucionCita);
                   $tipos=str_replace(',cn','',$tipos);
                   $joinTipoDistribucion=" INNER JOIN cit_tipo_distribucion t02 ON (t01.id_tipo_distribucion=t02.id AND permite_mas_citas=true and t01.id_tipo_distribucion NOT IN ($tipos))";
               }else{
                   $joinTipoDistribucion=" LEFT JOIN cit_tipo_distribucion t02 ON (t01.id_tipo_distribucion=t02.id AND permite_mas_citas=true AND t01.id_tipo_distribucion NOT IN ($idTipoDistribucionCita))";
                   //$whereIdTipoDistribucion="  AND t01.id_tipo_distribucion IS NULL OR t01.id_tipo_distribucion NOT IN ($idTipoDistribucionCita)";
               }
            }
        }else{
           $joinTipoDistribucion=" LEFT JOIN cit_tipo_distribucion t02 ON (t02.id=t01.id_tipo_distribucion)";
        }

        /*if($idTipoDistribucionCita == '0'){
           $joinTipoDistribucion=' INNER JOIN cit_tipo_distribucion t02 ON (t02.id=t01.id_tipo_distribucion AND t01.id_tipo_distribucion IS NOT NULL AND t02.permite_mas_citas = TRUE)';
        }else{
           $joinTipoDistribucion=" LEFT JOIN cit_tipo_distribucion t02 ON (t02.id=t01.id_tipo_distribucion AND (t01.id_tipo_distribucion IS NULL OR t01.id_tipo_distribucion <> $idTipoDistribucionCita))";
       }*/

        $sql = "SELECT DISTINCT (COALESCE(t02.id,0)) as id,COALESCE(t02.nombre,'Consulta Normal') as text
                FROM cit_distribucion t01
                    $joinTipoDistribucion
                WHERE t01.id_empleado=$idEmpleado AND t01.id_aten_area_mod_estab=$idAtenAreaModEstab
                    AND t01.id_estado_distribucion=1 AND t01.id_estado_distribucion=1 AND ((t01.yrs=$yrs AND t01.mes>=$mes) OR (t01.yrs>$yrs))
                    $whereIdTipoDistribucion
                ORDER BY COALESCE(t02.id,0) ASC";
        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $resultados['resultados'] = $stm->fetchAll();

        return new Response(json_encode($resultados));
    }

    /**
     * @Route("/consulta/citas/eliminadas", name="consulta_citas_eliminadas", options={"expose"=true})
     * @Method("GET")
     */

    public function getCitasEliminadasAction() {
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);
        $fechas=explode('-', $datos['rango_fechas']);
        $fechaInicial=$fechas[0];
        $fechaFin=$fechas[1];
        $em          = $this->getDoctrine()->getManager();


        $dql = "SELECT cit
                FROM MinsalCitasBundle:CitCitasDia  cit
                WHERE cit.fecha>='$fechaInicial' AND cit.fecha<='$fechaFin'
                AND cit.idEstado in(3,9)
                ORDER BY cit.fecha";

        $result = $em->createQuery($dql)
                     ->getResult();

        return $this->render('MinsalCitasBundle:Reports:CitasMedicas/cargarCitasEliminadas.html.twig', array('citasMedicas'=>$result));
    }
    /**
     * @Route("/programadas/medico", name="consulta_citas_programadas", options={"expose"=true})
     * @Method("GET")
     */

    public function citasProgramadasMedicoAction() {
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);
        $fechas=explode('-', $datos['rango_fechas']);
        $fechaInicial=$fechas[0];
        $fechaFin=$fechas[1];
        $idAreaModEstab=$datos['idAreaModEstab'];
        $idAtenAreaModEstab=$datos['idAtenAreaModEstab'];
        $whereIdEspecialidad='';
        if($idAtenAreaModEstab!=''){
            $whereIdEspecialidad=" AND C.id=$idAtenAreaModEstab";
        }

        $em = $this->getDoctrine()->getManager();


        $sql = "SELECT TO_CHAR(A.fecha, 'DD/MM/YYYY') as fecha,
                initcap(B.nombreempleado) as nombreempleado,
                initcap(D.nombre) as nombreespecialidad,
                SUM((CASE WHEN A.id_tipocita = 1 THEN 1 ELSE 0 END) * (CASE WHEN A.id_estado <> 6 THEN 1 ELSE 0 END)) AS primera_vez,
                SUM((CASE WHEN A.id_tipocita = 2 THEN 1 ELSE 0 END) * (CASE WHEN A.id_estado <> 6 THEN 1 ELSE 0 END)) AS subsecuentes,
                SUM(CASE WHEN A.id_estado = 6 THEN 1 ELSE 0 END) AS agregados,
                COUNT(b.nombreempleado) AS total
                FROM cit_citas_dia A
                	INNER JOIN mnt_empleado B ON (A.id_empleado=B.id)
                	INNER JOIN mnt_aten_area_mod_estab C ON (C.id=A.id_aten_area_mod_estab $whereIdEspecialidad)
                	INNER JOIN ctl_atencion D ON (D.id=C.id_atencion)
                WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFin' AND A.id_area_mod_estab=$idAreaModEstab AND id_estado not in (3,9)
                GROUP BY A.fecha,initcap(B.nombreempleado),initcap(D.nombre)
                ORDER BY A.fecha ASC,nombreempleado ASC, nombreespecialidad ASC";

                $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
                $stm->execute();
                $result = $stm->fetchAll();


        return $this->render('MinsalCitasBundle:Reports:CitasMedicas/cargarProduccionCitas.html.twig', array('citasMedicas'=>$result));
    }
}
