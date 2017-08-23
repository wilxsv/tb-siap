<?php
namespace Minsal\CitasBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Minsal\CitasBundle\Entity\CitCitasDia;

class CitasService
{

    private $container = null;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function getConsolidadoCitCitasDia($idEmpleado, $idEspecialidad, $lowerLimit, $upperLimit, $idRangoHora = NULL) {
        $em = $this->container->get('doctrine')->getManager();
        $selectRH       = '';
        $selectLOJRH    = '';
        $whereLOJRH     = '';
        $groupByLOJRH   = '';
        $leftJoin       = '';
        $totalCuposOrdinarios='COALESCE((SELECT sum(primera)
                     FROM cit_distribucion
                     WHERE  id_empleado = :idEmpleado
                            AND id_aten_area_mod_estab = :especialidad
                            AND mes=EXTRACT(MONTH FROM t05.date)
                            AND dia=EXTRACT(DOW FROM t05.date)
                            AND yrs=EXTRACT(YEAR FROM t05.date)),0)+
                            COALESCE((SELECT sum(subsecuente)
                                         FROM cit_distribucion
                                         WHERE  id_empleado = :idEmpleado
                                                AND id_aten_area_mod_estab = :especialidad
                                                AND mes=EXTRACT(MONTH FROM t05.date)
                                                AND dia=EXTRACT(DOW FROM t05.date)
                                                AND yrs=EXTRACT(YEAR FROM t05.date)),0)
                            ';

        if($idRangoHora) {
            $selectRH = "t07.id AS id_rango_hora,
                         t07.hora_ini AS hora_inicial,
                         t07.hora_fin AS hora_final,";

            $selectLOJRH = "t01.id_rangohora,";

            $whereLOJRH  = "AND t01.id_rangohora = :idRangoHora";

            $groupByLOJRH = ", t01.id_rangohora";

            $leftJoin    = 'LEFT JOIN mnt_rangohora t07 ON (t07.id = t06.id_rangohora)';

            $totalCuposOrdinarios='COALESCE((SELECT sum(primera)
                         FROM cit_distribucion
                         WHERE id_empleado = :idEmpleado
                                AND id_aten_area_mod_estab = :especialidad
                                AND mes=EXTRACT(MONTH FROM t05.date)
                                AND dia=EXTRACT(DOW FROM t05.date)
                                AND yrs=EXTRACT(YEAR FROM t05.date)
                                AND id_rangohora = :idRangoHora),0)+
                                COALESCE((SELECT sum(subsecuente)
                                             FROM cit_distribucion
                                             WHERE id_empleado = :idEmpleado
                                                    AND id_aten_area_mod_estab = :especialidad
                                                    AND mes=EXTRACT(MONTH FROM t05.date)
                                                    AND dia=EXTRACT(DOW FROM t05.date)
                                                    AND yrs=EXTRACT(YEAR FROM t05.date)
                                                    AND id_rangohora = :idRangoHora),0)';
        }

        /*****************************************************************************************
         * SQL que determina la cantidad de citas por primera vez, subsecuentes, agregados, aten-
         * didos y total de citas para cada dia de un mes determinado por usuario y especialidad
         ****************************************************************************************/
        $sql = "SELECT TO_CHAR(t05.date, 'YYYY/MM/DD') AS date,
                       $selectRH
                       COALESCE(t06.primeraVez,0) AS primera_vez,
                       COALESCE(t06.subsecuentes,0) AS subsecuentes,
                       COALESCE(t06.agregados,0) AS agregados,
                       COALESCE(t06.totalCitas,0) AS total_citas,
                       COALESCE(t06.atendidos,0) AS atendidos,
                       $totalCuposOrdinarios AS total_cupos
                FROM (
                      SELECT serie::date AS date
                      FROM generate_series ('$lowerLimit'::timestamp, '$upperLimit'::timestamp, '1 day'::interval) serie) t05
                LEFT OUTER JOIN (
                      SELECT DISTINCT t01.fecha as date,
                             $selectLOJRH
                             SUM((CASE WHEN t01.id_tipocita = 1 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as primeraVez,
                             SUM((CASE WHEN t01.id_tipocita = 2 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as subsecuentes,
                             SUM(CASE WHEN t01.id_estado = 6 THEN 1 ELSE 0 END) as agregados,
                             COUNT(t01.id_tipocita) as totalCitas,
                             SUM((CASE WHEN t01.id_estado = 5 THEN 1 ELSE 0 END) + (CASE WHEN t01.id_estado = 7 THEN 1 ELSE 0 END)) atendidos
                      FROM cit_citas_dia        t01
                      INNER JOIN mnt_expediente t02 ON (t01.id_expediente = t02.id)
                      INNER JOIN mnt_empleado 	t03 ON (t01.id_empleado   = t03.id)
                      WHERE t01.fecha >= date'$lowerLimit' AND t01.fecha<= '$upperLimit'
                            AND t01.id_empleado = :idEmpleado
                            AND t01.id_aten_area_mod_estab = :especialidad
                            AND t01.id_estado NOT IN (3,9)
                            $whereLOJRH
                      GROUP BY t01.fecha $groupByLOJRH) t06 ON (t05.date = t06.date)
                      $leftJoin
                      ORDER BY date";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idEmpleado', $idEmpleado);
        $stm->bindValue(':especialidad', $idEspecialidad);

        if($idRangoHora) {
            $stm->bindValue(':idRangoHora', $idRangoHora);
        }

        $stm->execute();
        $result = $stm->fetchAll();

        return $result;
    }
    /*
    * NOMBRE: getEventos
    * DESCRIPCIÓN:  Método que permite obtener los eventos del médico o del procedimiento que hayan sido configurados para un rango de fecha
    * PARÁMETROS DE ENTRADA:
    *
    *  Parametros:                         | Requerido | Valor por Defecto | Posibles Valores      | Descripcion
    *  ------------------------------------+-----------+-------------------+-----------------------+------------
    *      idEmpleado                      | Si        | -                 | INTEGER               | Id del Médico
    *      lowerLimit                      | Si        | -                 | DATE                  | Fecha y hora de Inicio
    *      upperLimit                      | No        | NULL              | DATE | NULL           | Fecha y hora de Finalización; Si el valor es NULL tomará el valor de fechaHoraIni
    *      inputFormat                     | No        | 'd/m/Y'           | STRING                | Formato de entrada de las fechas enviadas
    *
    * RETORNO:
    *       Array que contiene el detalle de los eventos
    *
    * ANALISTA PROGRAMADOR: Ing. Caleb Rodriguez.
    *       MODIFICADO POR: Ing. Karen Peñate
    */

    public function getEventos($idEmpleado, $lowerLimit, $upperLimit = NULL, $inputFormat = 'd/m/Y', $outputFormat = 'dd/mm/yyyy') {
        $em = $this->container->get('doctrine')->getManager();
        $lowerLimit = \DateTime::createFromFormat($inputFormat, $lowerLimit);

        $upperLimit = $upperLimit ? \DateTime::createFromFormat( $inputFormat,$upperLimit) : $lowerLimit;
        $lowerLimit = $lowerLimit->format('Y-m-d');
        $upperLimit = $upperLimit->format('Y-m-d');
        /*****************************************************************************************
         * SQL que determina los eventos que un empleado tiene para un mes en especifico, asi como
         * tambien las fechas festivas o no laborables
         ****************************************************************************************/
        $sql = "SELECT to_char(t01.date,'$outputFormat') as fecha,
                    	CASE WHEN t01.date = date(t02.fecha_hora_ini) THEN to_char(t02.fecha_hora_ini,'HH12:MI:SS AM')
                    		WHEN t02.fecha_hora_ini IS NOT NULL THEN '12:00:00 AM'
                    	 END as hora_ini,
                    	 CASE WHEN t01.date = date(t02.fecha_hora_fin) THEN to_char(t02.fecha_hora_fin,'HH12:MI:SS AM')
                    		WHEN t02.fecha_hora_fin IS NOT NULL THEN '11:59:00 PM'
                    	 END as hora_fin,
                    	t02.id_tipo_evento,
                    	t02.nombre_tipo_evento,
                    	t02.id_evento,
                    	t02.nombre_evento
                FROM (SELECT serie::date AS date
                          FROM generate_series ('$lowerLimit'::timestamp, '$upperLimit'::timestamp, '1 day'::interval) serie)
                      AS t01
                      LEFT OUTER JOIN (
                      SELECT A.id as id_evento,A.fecha_hora_ini,A.fecha_hora_fin,A.nombre as nombre_evento,
                    		 B.id as id_tipo_evento, B.nombre as nombre_tipo_evento
                          FROM mnt_evento A INNER JOIN mnt_tipo_evento B ON (B.id=A.id_tipo_evento)
                          WHERE (id_empleado =:idEmpleado OR id_empleado IS NULL) AND id_modulo=4 AND es_evento_medico = TRUE)
                      AS t02 ON (t01.date BETWEEN date(t02.fecha_hora_ini) AND date(t02.fecha_hora_fin))
                ORDER BY date ASC";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idEmpleado', $idEmpleado);
        $stm->execute();
        $result = $stm->fetchAll();

        $fecha             = '';
        $eventos           = array();
        $bloqueoParcialDia = false;
        $bloqueoTotalDia   = false;
        $cantidadHoras     = 0;
        $horaIni           = '';
        $horaFin           = '';
        $rangoHora         = '';

        foreach ($result as $value) {
            if($fecha != $value['fecha']){
                $fecha             = $value['fecha'];
                $eventos[$fecha]   = array('fecha'=>$fecha);
                $eventos[$fecha]['horarios'] = array();
                $bloqueoParcialDia = false;
                $bloqueoTotalDia   = false;
                $cantidadHoras     = 0;
            }

            $horaIni   = $value['hora_ini'];
            $horaFin   = $value['hora_fin'];
            $rangoHora = $horaIni.' - '.$horaFin;

            $idTipoEventoDia     = 0;
            $nombreTipoEventoDia = 'N/A';

            if($rangoHora === ' - ') {
                $eventos[$fecha]['horarios'] = array();
                $bloqueoParcialDia = false;
                $bloqueoTotalDia   = false;
            } else {
                $a = new \DateTime($horaIni);
                $b = new \DateTime($horaFin);
                $interval = $a->diff($b);
                $cantidadHoras = $cantidadHoras + $interval->format("%H");
                $cantidadHoras = $cantidadHoras > 23 ? 23 : $cantidadHoras;

                if($cantidadHoras==23) {
                    $bloqueoParcialDia   = false;
                    $bloqueoTotalDia     = true;
                    $idTipoEventoDia     = $value['id_tipo_evento'];
                    $nombreTipoEventoDia = $value['nombre_tipo_evento'];
                } else {
                    $bloqueoParcialDia = true;
                    $bloqueoTotalDia   = false;
                }

                if(array_key_exists($rangoHora,$eventos[$fecha]['horarios'])){
                    if($value['id_tipo_evento']==1){
                        $eventos[$fecha]['horarios'][$rangoHora]=array(
                            'horaIni'          => $horaIni,
                            'horaFin'          => $horaFin,
                            'rangoHora'        => $rangoHora,
                            'idTipoEvento'     => $value['id_tipo_evento'],
                            'nombreTipoEvento' => $value['nombre_tipo_evento'],
                            'idEvento'         => $value['id_evento'],
                            'nombreEvento'     => $value['nombre_evento']
                        );
                    }
                }else{
                    $eventos[$fecha]['horarios'][$rangoHora]=array(
                        'horaIni'          => $horaIni,
                        'horaFin'          => $horaFin,
                        'rangoHora'        => $rangoHora,
                        'idTipoEvento'     => $value['id_tipo_evento'],
                        'nombreTipoEvento' => $value['nombre_tipo_evento'],
                        'idEvento'         => $value['id_evento'],
                        'nombreEvento'     => $value['nombre_evento']
                    );
                }
            }

            $eventos[$fecha]['bloqueoParcialDia']   = $bloqueoParcialDia;
            $eventos[$fecha]['bloqueoTotalDia']     = $bloqueoTotalDia;
            $eventos[$fecha]['horas']               = $cantidadHoras;
            $eventos[$fecha]['idTipoEventoDia']     = $idTipoEventoDia;
            $eventos[$fecha]['nombreTipoEventoDia'] = $nombreTipoEventoDia;
        }

        return $eventos;
    }

    public function getDistribucionEmpleado($idEmpleado, $idEspecialidad, $lowerLimit, $upperLimit) {
        $em             = $this->container->get('doctrine')->getManager();
        $idAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($idEspecialidad)->getIdAreaModEstab()->getId();

        /*****************************************************************************************
         * SQL que determina la distribucion de un médico, para un mes especifico
         ****************************************************************************************/
        $sql = "SELECT TO_CHAR(t01.date, 'YYYY/MM/DD') AS date,
                       COALESCE(t02.distribucion, 0) AS distribucion
                FROM (
                      SELECT serie::date AS date, EXTRACT(DOW FROM serie) AS DOW
                      FROM generate_series ('$lowerLimit'::timestamp, '$upperLimit'::timestamp, '1 day'::interval) serie) t01
                LEFT OUTER JOIN (
                      SELECT yrs, mes, dia, COUNT(*) AS distribucion FROM  cit_distribucion
                      WHERE id_empleado = :idEmpleado
                            AND id_aten_area_mod_estab = :especialidad
                            AND id_area_mod_estab = :idAreaModEstab
                      GROUP BY yrs, mes, dia) t02 ON (t02.yrs = EXTRACT(YEAR FROM t01.date::timestamp)
                                  AND t02.mes = EXTRACT(MONTH FROM t01.date::timestamp)
                                  AND t02.dia = EXTRACT(DOW FROM t01.date::timestamp)) ORDER BY date";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idEmpleado', $idEmpleado);
        $stm->bindValue(':especialidad', $idEspecialidad);
        $stm->bindValue(':idAreaModEstab', $idAreaModEstab);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result;
    }

    public function getHorarioEmpleado($idEmpleado, $idEspecialidad, $lowerLimit, $upperLimit) {
        $em             = $this->container->get('doctrine')->getManager();
        $idAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($idEspecialidad)->getIdAreaModEstab()->getId();

        /*****************************************************************************************
         * SQL que determina el horario de atencion de pacientes de un medico (rangos de horas)
         * para una fecha determinada
         ****************************************************************************************/
        $sql = "SELECT tx01.date,
                       tx02.id,
                       tx02.hora_ini,
                       tx02.hora_fin,
                       tx02.rango_hora
                FROM (
                      SELECT serie::date AS date, EXTRACT(DOW FROM serie) AS DOW
                        FROM generate_series ('$lowerLimit'::timestamp, '$upperLimit'::timestamp, '1 day'::interval) serie) tx01
                LEFT JOIN (
                    SELECT t02.id,
                           TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM') AS hora_ini,
                           TO_CHAR(t02.hora_fin, 'HH12:MI:SS AM') AS hora_fin,
                           CONCAT(TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM'),' - ',TO_CHAR(t02.hora_fin, 'HH12:MI:SS AM')) AS rango_hora,
                           t01.dia,
                           t01.mes,
                           t01.yrs
                    FROM cit_distribucion t01
                    INNER JOIN mnt_rangohora t02 ON (t02.id = t01.id_rangohora)
                    WHERE t01.id_empleado = :idEmpleado
                          AND t01.id_aten_area_mod_estab = :idAtenAreaModEstab
                          AND t01.id_area_mod_estab      = :idAreaModEstab
                    ORDER BY t02.hora_ini) tx02 ON (tx02.yrs = EXTRACT(YEAR FROM tx01.date::timestamp)
                        AND tx02.mes = EXTRACT(MONTH FROM tx01.date::timestamp)
                        AND tx02.dia = EXTRACT(DOW FROM tx01.date::timestamp))
                ORDER BY tx01.date, tx02.hora_ini";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idEmpleado', $idEmpleado);
        $stm->bindValue(':idAtenAreaModEstab', $idEspecialidad);
        $stm->bindValue(':idAreaModEstab', $idAreaModEstab);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result;
    }

    /*
    * NOMBRE: verificarEvento
    * DESCRIPCIÓN:  Método que verifica si un médico posee o no un evento en una determinada fecha en un
    *               rango de hora en específico.
    * PARÁMETROS DE ENTRADA:
    *
    *  Parametros:                         | Requerido | Valor por Defecto | Posibles Valores      | Descripcion
    *  ------------------------------------+-----------+-------------------+-----------------------+------------
    *      idEmpleado                      | Si        | -                 | INTEGER               | Id del Médico
    *      fecha                           | Si        | -                 | DATE                  | Fecha
    *      inputFormatDate                 | No        | 'd/m/Y'           | STRING                | Formato de entrada de las fechas enviadas
    *      inputFormatTime                 | No        | 'h:i:s A'         | STRING                | Formato de entrada de las horas enviadas
    *      hora                            | No        | ' 12:00:00 AM'    | STRING                | Hora de inicio para la busqueda; Si no es enviada tomará la media noche
    *
    * RETORNO:
    *       Array del id del evento que tiene el médico en la fecha y hora indicada
    *
    *
    * ANALISTA PROGRAMADOR: Ing. Caleb Rodriguez.
    *       MODIFICADO POR: Ing. Karen Peñate
    */
    public function verificarEvento($idEmpleado, $fecha, $hora, $inputDateFormat='d/m/Y', $inputTimeFormat='h:i:s A') {
        $em = $this->container->get('doctrine')->getManager();

        $fechaBusqueda = \DateTime::createFromFormat($inputDateFormat.' '.$inputTimeFormat, $fecha.' '.$hora);

        /*****************************************************************************************
         * SQL que verifica que el medico no tenga evento en la hora seleccionada
         *****************************************************************************************/
        $sql = "SELECT t01.id
                FROM mnt_evento t01
                WHERE (t01.id_empleado = :idEmpleado OR t01.id_empleado IS NULL) AND t01.id_modulo=4 AND t01.es_evento_medico = TRUE
                    AND '". $fechaBusqueda->format('d/m/Y h:i:s A')."'::timestamp BETWEEN t01.fecha_hora_ini AND t01.fecha_hora_fin";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idEmpleado', $idEmpleado);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result;
    }

    public function obtenerCapacidadCitasEmpleado($idEmpleado, $idEspecialidad, $lowerLimit, $upperLimit, $idRangoHora = NULL) {
        $em             = $this->container->get('doctrine')->getManager();
        $idAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($idEspecialidad)->getIdAreaModEstab()->getId();
        $selectRH       = '';
        $selectLOJRH    = '';
        $whereLOJRH     = '';
        $groupByLOJRH   = '';
        $leftJoin       = '';

        if($idRangoHora) {
            $selectRH = "t03.id AS id_rango_hora,
                         t03.hora_ini AS hora_inicial,
                         t03.hora_fin AS hora_final,";

            $selectLOJRH = "id_rangohora,";

            $whereLOJRH  = "AND id_rangohora = :idRangoHora";

            $groupByLOJRH = ", id_rangohora";

            $leftJoin    = 'LEFT JOIN mnt_rangohora t03 ON (t03.id = t02.id_rangohora)';
        }

        /*****************************************************************************************
         * SQL que obtiene la capacidad de citas de primera vez, subsecuentes y agregados que
         * un médico tiene para un rango de hora o para un día o rango de días específicos.
         ****************************************************************************************/
        $sql = "SELECT TO_CHAR(t01.date, 'YYYY/MM/DD') AS date,
                       $selectRH
                       COALESCE(t02.primera_vez, 0) AS primera_vez,
                       COALESCE(t02.subsecuentes, 0) AS subsecuentes,
                       COALESCE(t02.agregados, 0) AS agregados
                FROM (
                        SELECT serie::date AS date, EXTRACT(DOW FROM serie) AS DOW
                        FROM generate_series ('$lowerLimit'::timestamp, '$upperLimit'::timestamp, '1 day'::interval) serie) t01
                LEFT OUTER JOIN (
                    SELECT yrs,
                	       mes,
                	       dia,
                           $selectLOJRH
                	       SUM(primera) AS primera_vez,
                	       SUM(subsecuente) AS subsecuentes,
                	       SUM(max_citas_agregadas) AS agregados
                	FROM cit_distribucion
                	WHERE id_empleado = :idEmpleado
                		    AND id_aten_area_mod_estab = :idEspecialidad
                		    AND id_area_mod_estab = :idAreaModEstab
                            $whereLOJRH
                	GROUP BY yrs, mes, dia $groupByLOJRH
                	ORDER BY yrs, mes, dia) t02 ON (t02.yrs = EXTRACT(YEAR FROM t01.date::timestamp)
                		  AND t02.mes = EXTRACT(MONTH FROM t01.date::timestamp)
                		  AND t02.dia = EXTRACT(DOW FROM t01.date::timestamp))
                    $leftJoin
                    ORDER BY date";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idEmpleado', $idEmpleado);
        $stm->bindValue(':idEspecialidad', $idEspecialidad);
        $stm->bindValue(':idAreaModEstab', $idAreaModEstab);

        if($idRangoHora) {
            $stm->bindValue(':idRangoHora', $idRangoHora);
        }

        $stm->execute();
        $result = $stm->fetchAll();

        return $result;
    }

    public function getDetalleCitaDia($idEmpleado, $idEspecialidad, $fechaInicial, $fechaFinal, $idTipoCita, $idRangoHora) {
        $em           = $this->container->get('doctrine')->getManager();
        $fechaInicial = \DateTime::createFromFormat('d/m/Y', $fechaInicial);
        $fechaFinal   = \DateTime::createFromFormat('d/m/Y', $fechaFinal);

        /*****************************************************************************************
         * SQL que determina el detalle de la cita para un rango de fecha determinado
         ****************************************************************************************/
        $dql = "SELECT t01.fecha,
                       t06.id AS idRangoHora,
                       t06.horaIni AS horaInicial,
                       t06.horaFin AS horaFinal,
                       t01.id AS idCita,
                       IDENTITY(t01.idExpediente) AS idExpediente,
                       t02.numeroTemporal,
                       t02.numero AS codExpediente,
                       COALESCE(t08.id, 0) AS idDocumentoIdentidadPaciente,
                       CASE WHEN t08.id IS NULL
                            THEN ''
                            ELSE t03.numeroDocIdePaciente
                        END AS numeroDocumentoIdentidadPaciente,
                       CONCAT( CONCAT( CONCAT_WS(' ',t03.primerApellido, t03.segundoApellido, t03.apellidoCasada), ', ' ), CONCAT_WS(' ',t03.primerNombre, t03.segundoNombre, t03.tercerNombre) ) AS nombrePaciente,
                       IDENTITY(t01.idEstado) AS idEstado,
                       t05.estado AS nombreEstado,
                       t07.id AS idTipoCita,
                       t07.tipocita AS nombreTipoCita
                FROM MinsalCitasBundle:CitCitasDia                 t01
                INNER JOIN MinsalSiapsBundle:MntExpediente         t02 WITH (t02.id = t01.idExpediente)
                INNER JOIN MinsalSiapsBundle:MntPaciente           t03 WITH (t03.id = t02.idPaciente)
                INNER JOIN MinsalSiapsBundle:MntEmpleado           t04 WITH (t04.id = t01.idEmpleado)
                INNER JOIN MinsalCitasBundle:CitEstadoCita         t05 WITH (t05.id = t01.idEstado)
                INNER JOIN MinsalSiapsBundle:MntRangohora          t06 WITH (t06.id = t01.idRangohora)
                INNER JOIN MinsalCitasBundle:CitTipocita           t07 WITH (t07.id = t01.idTipocita)
                LEFT  JOIN MinsalSiapsBundle:CtlDocumentoIdentidad t08 WITH (t08.id = t03.idDocPaciente AND t08.id = 1)";

        $where = " WHERE t01.fecha BETWEEN :fechaInicial AND :fechaFinal
                        AND t01.idEmpleado = :idEmpleado
                        AND t01.idAtenAreaModEstab = :idEspecialidad
                        AND t05.id NOT IN (3,9)";

        if($idTipoCita === 1 || $idTipoCita === 2) {
            $where .= " AND t01.idTipocita = :idTipocita AND t01.idJustificacion IS NULL";
        } else {
            $where .= " AND t01.idJustificacion >= 1";
        }

        if($idRangoHora !== NULL) {
            $where .= " AND t01.idRangohora = :idRangoHora";
        }

        $orderBy = " ORDER BY t05.estado DESC";

        $query = $em->createQuery($dql.$where.$orderBy)
                     ->setParameter(':fechaInicial', $fechaInicial->format('Y-m-d'))
                     ->setParameter(':fechaFinal', $fechaFinal->format('Y-m-d'))
                     ->setParameter(':idEmpleado', $idEmpleado)
                     ->setParameter(':idEspecialidad', $idEspecialidad);

        if($idTipoCita === 1 || $idTipoCita === 2) {
            $query->setParameter(':idTipocita', $idTipoCita);
        }

        if($idRangoHora) {
            $query->setParameter(':idRangoHora', $idRangoHora);
        }

        $result = $query->getArrayResult();

        return $result;
    }

    /*  getRangoCitasInfo
     *      Función que permite obtener los datos referente a citas como son la capacidad de citas, las citas asignadas,
     *      cantidad de distribucion, el evento, para un rango de fechas dados
     *
     *  Parametros:             | Requerido | Valor por Defecto | Posibles Valores   | Descripcion
     *  ------------------------+-----------+-------------------+--------------------+------------
     *      idEmpleado          | Si        | -                 | INTEGER            | id del Empleado (Médico) del cual se buscaran las citas
     *      idEspecialidad      | Si        | -                 | INTEGER            | id de la Especialidad asociadas a las citas
     *      lowerLimit          | Si        | -                 | STRING             | fecha Inicial de la busqueda
     *      upperLimit          | Si        | -                 | STRING             | fecha Final de la busqueda
     *      weekday             | No        | false             | BOOLEAN | NULL     | Booleano que permite definir si se tomaran encuenta los dias que son fines de semana
     *      showHorarioReal     | No        | 'true'            | STRING  | NULL     | Bandera que permite definir si se muestra un horario escalonado para un rango de hora o se muestra el horario real
     *      mostrarDetalleCitas | No        | true              | BOOLEAN | NULL     | Bandera que permite limitar si el detalle de las citas se muestran o no
     *      outputKeyFormat     | No        | 'd/m/Y'           | STRING  | NULL     | formato de los datos de salida para las fechas
     */
    public function getRangoCitasInfo($idEmpleado, $idEspecialidad, $lowerLimit, $upperLimit, $weekday = false, $showHorarioReal = 'true', $mostrarDetalleCitas = true, $outputKeyFormat = 'd/m/Y') {
        $em             = $this->container->get('doctrine')->getManager();
        $lowerLimit     = \DateTime::createFromFormat('d/m/Y', $lowerLimit);
        $lowerLimit     = $lowerLimit->format('Y-m-d');
        $upperLimit     = \DateTime::createFromFormat('d/m/Y', $upperLimit);
        $upperLimit     = $upperLimit->format('Y-m-d');
        $diaWhere       = '';
        $idAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($idEspecialidad)->getIdAreaModEstab()->getId();

        $selectDetalleCita   = '';
        $leftJoinDetalleCita = '';

        if($weekday === false) {
            $diaWhere = "WHERE EXTRACT(DOW FROM serie::timestamp) NOT IN (0,6)";
        }

        if($mostrarDetalleCitas) {
            $selectDetalleCita =
                ",
                tx04.id AS id_cita,
                tx04.id_expediente,
                tx04.numero_expediente,
                tx04.nombre_paciente,
                tx04.id_estado,
                tx04.nombre_estado,
                tx04.id_tipo_cita,
                tx04.nombre_tipo_cita,
                tx04.id_justificacion,
                tx04.nombre_justificacion";

            $leftJoinDetalleCita =
                "LEFT JOIN (
                    SELECT t01.fecha AS date,
                           t06.id AS id_rango_hora,
                           t01.id,
                           t01.id_expediente,
                           t02.numero AS numero_expediente,
                           CONCAT( CONCAT( CONCAT_WS(' ',t03.primer_apellido, t03.segundo_apellido, t03.apellido_casada), ', ' ), CONCAT_WS(' ',t03.primer_nombre, t03.segundo_nombre, t03.tercer_nombre) ) AS nombre_paciente,
                           t01.id_estado,
                           t05.estado AS nombre_estado,
                           t01.id_justificacion,
                           COALESCE(t08.nombre, 'N/A') AS nombre_justificacion,
                        --    CASE WHEN t01.id_justificacion IS NOT NULL
                        --         THEN 5
                        --         ELSE t01.id_tipocita
                        --    END AS id_tipo_cita,
                           t01.id_tipocita AS id_tipo_cita,
                        --   CASE WHEN t01.id_justificacion IS NOT NULL
                        --        THEN 'Agregado'
                        --        ELSE t07.tipocita
                        --   END AS nombre_tipo_cita
                           t07.tipocita AS nombre_tipo_cita
                    FROM cit_citas_dia t01
                    INNER JOIN mnt_expediente    t02 ON (t02.id = t01.id_expediente)
                    INNER JOIN mnt_paciente      t03 ON (t03.id = t02.id_paciente)
                    INNER JOIN mnt_empleado      t04 ON (t04.id = t01.id_empleado)
                    INNER JOIN cit_estado_cita   t05 ON (t05.id = t01.id_estado)
                    INNER JOIN mnt_rangohora     t06 ON (t06.id = t01.id_rangohora)
                    LEFT  JOIN cit_tipocita      t07 ON (t07.id = t01.id_tipocita)
                    LEFT  JOIN cit_justificacion t08 ON (t08.id = t01.id_justificacion)
                    WHERE t01.fecha BETWEEN '$lowerLimit' AND '$upperLimit'
                        AND t01.id_empleado = :idEmpleado
                        AND t01.id_aten_area_mod_estab = :idEspecialidad
                        AND t05.id NOT IN (3,9)
                ) tx04 ON (tx01.date = tx04.date AND tx01.id_rango_hora = tx04.id_rango_hora)";
        }

        /*****************************************************************************************
         * SQL que determina el detalle de la cita para un rango de fecha determinado
         ****************************************************************************************/
        $sql = "WITH rango_fecha AS (
                    SELECT serie::date AS date
                    FROM generate_series ('$lowerLimit'::timestamp, '$upperLimit'::timestamp, '1 day'::interval) serie $diaWhere
                ),
                rango_hora_filtrado AS (
                    SELECT id,
                           to_timestamp(current_date || ' ' || hora_ini, 'YYYY-MM-DD HH24:MI:SS') AS hora_inicial,
                           to_timestamp(current_date || ' ' || hora_fin, 'YYYY-MM-DD HH24:MI:SS') AS hora_final
                    FROM mnt_rangohora
                    WHERE to_timestamp(current_date || ' ' || hora_ini, 'YYYY-MM-DD HH24:MI:SS') <= current_timestamp
                        AND to_timestamp(current_date || ' ' || hora_fin, 'YYYY-MM-DD HH24:MI:SS') >= current_timestamp
                ),
                rango_hora_escalonado AS (
                    SELECT id,
                           generate_series(
                               to_timestamp(current_date || ' ' || hora_ini, 'YYYY-MM-DD HH24:MI:SS'),
                               to_timestamp(current_date || ' ' || hora_fin, 'YYYY-MM-DD HH24:MI:SS'),
                               interval '1 hour'
                           )::timestamp AS hora
                    FROM mnt_rangohora
                    WHERE to_timestamp(current_date || ' ' || hora_ini, 'YYYY-MM-DD HH24:MI:SS') = (
                            SELECT MIN(hora_inicial) AS hora_inicial
                            FROM rango_hora_filtrado
                            WHERE (hora_final - hora_inicial) = ( SELECT MAX(hora_final - hora_inicial) FROM rango_hora_filtrado )
                        )
                        AND to_timestamp(current_date || ' ' || hora_fin, 'YYYY-MM-DD HH24:MI:SS') = (
                            SELECT MAX(hora_final) AS hora_final
                            FROM rango_hora_filtrado
                            WHERE hora_inicial =  (
                                    SELECT MIN(hora_inicial) AS hora_inicial
                                    FROM rango_hora_filtrado
                                    WHERE (hora_final - hora_inicial) = ( SELECT MAX(hora_final - hora_inicial) FROM rango_hora_filtrado )
                                )
                            GROUP BY hora_inicial
                        )
                )";
        $sql .= "SELECT tx01.date,
                       CASE WHEN
                               tx01.timestamp_ini > tx05.timestamp_ini AND tx01.timestamp_ini < tx05.timestamp_fin OR
                               tx01.timestamp_fin > tx05.timestamp_ini AND tx01.timestamp_fin < tx05.timestamp_fin
                           THEN true
                           ELSE false
                       END horario_bloqueado,
                       COALESCE(tx05.id_tipo_evento, 0) AS id_tipo_evento,
                       COALESCE(tx05.nombre_tipo_evento, 'N/A') AS nombre_tipo_evento,
                       tx01.id_distribucion,
                       tx01.posee_distribucion,
                       tx01.residente,
                       tx01.cantidad_distribucion,
                       tx01.id_estado_distribucion,
                       tx01.id_rango_hora,
                       tx01.hora_ini,
                       tx01.hora_fin,
                       tx01.horario_generico,
                       tx01.id_tipo_distribucion,
                       tx01.nombre_tipo_distribucion,
                       COALESCE(tx03.primera_vez, 0) AS pv_capacidad,
                       COALESCE(tx02.primera_vez,0) AS pv_asignado,
                       COALESCE(tx03.subsecuentes, 0) AS sb_capacidad,
                       COALESCE(tx02.subsecuentes,0) AS sb_asignado,
                       COALESCE(tx03.agregados, 0) AS ag_capacidad,
                       COALESCE(tx02.agregados,0) AS ag_asignado,
                       COALESCE(tx02.total_citas,0) AS total_asignados
                       $selectDetalleCita
                -- Tabla Pivote, contiene la fecha, distribucion y horario del médico
                FROM (
                    SELECT DISTINCT
                           ti02.date,
                           COALESCE(ti01.residente, false) AS residente,
                           ti04.id_distribucion,
                           CASE WHEN COALESCE(ti03.distribucion, 0) > 0
                                THEN true
                                ELSE false
                           END AS posee_distribucion,
                           COALESCE(ti03.distribucion, 0) AS cantidad_distribucion,
                           CASE WHEN COALESCE(ti01.residente, false) = true
                                THEN
                                    CASE WHEN COALESCE(ti03.distribucion, 0) > 0
                                        THEN
                                            CASE WHEN
                                                    to_timestamp(current_date || ' ' || ti05.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') OR
                                                    to_timestamp(current_date || ' ' || ti05.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM')
                                                THEN ti04.id_estado_distribucion
                                                ELSE 1
                                            END
                                        ELSE 1
                                    END
                                ELSE ti04.id_estado_distribucion
                           END AS id_estado_distribucion,
                           CASE WHEN COALESCE(ti01.residente, false) = true
                                THEN
                                    CASE WHEN COALESCE(ti03.distribucion, 0) > 0
                                        THEN
                                            CASE WHEN
                                                    to_timestamp(current_date || ' ' || ti05.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') OR
                                                    to_timestamp(current_date || ' ' || ti05.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM')
                                                THEN ti04.id
                                                ELSE ti05.id
                                            END
                                        ELSE ti05.id
                                    END
                                ELSE ti04.id
                           END AS id_rango_hora,
                           CASE WHEN COALESCE(ti01.residente, false) = true
                                THEN
                                    CASE WHEN COALESCE(ti03.distribucion, 0) > 0
                                        THEN
                                            CASE WHEN
                                                    to_timestamp(current_date || ' ' || ti05.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') OR
                                                    to_timestamp(current_date || ' ' || ti05.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM')
                                                THEN ti04.hora_ini
                                                ELSE
                                                    CASE WHEN $showHorarioReal = FALSE
                                                        THEN ti05.hora_ini
                                                        ELSE ti05.hora_ini_original
                                                    END
                                            END
                                        ELSE
                                            CASE WHEN $showHorarioReal = FALSE
                                                THEN ti05.hora_ini
                                                ELSE ti05.hora_ini_original
                                            END
                                    END
                                ELSE ti04.hora_ini
                           END AS hora_ini,
                           CASE WHEN COALESCE(ti01.residente, false) = true
                                THEN
                                    CASE WHEN COALESCE(ti03.distribucion, 0) > 0
                                        THEN
                                            CASE WHEN
                                                    to_timestamp(current_date || ' ' || ti05.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') OR
                                                    to_timestamp(current_date || ' ' || ti05.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM')
                                                THEN ti04.hora_fin
                                                ELSE
                                                    CASE WHEN $showHorarioReal = FALSE
                                                        THEN ti05.hora_fin
                                                        ELSE ti05.hora_fin_original
                                                    END
                                            END
                                        ELSE
                                            CASE WHEN $showHorarioReal = FALSE
                                                THEN ti05.hora_fin
                                                ELSE ti05.hora_fin_original
                                            END
                                    END
                                ELSE ti04.hora_fin
                           END AS hora_fin,
                           CASE WHEN COALESCE(ti01.residente, false) = true
                                THEN
                                    CASE WHEN COALESCE(ti03.distribucion, 0) > 0
                                        THEN
                                            CASE WHEN
                                                    to_timestamp(current_date || ' ' || ti05.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') OR
                                                    to_timestamp(current_date || ' ' || ti05.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM')
                                                THEN to_timestamp(ti02.date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM')
                                                ELSE
                                                    CASE WHEN $showHorarioReal = FALSE
                                                        THEN to_timestamp(ti02.date || ' ' || ti05.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM')
                                                        ELSE to_timestamp(ti02.date || ' ' || ti05.hora_ini_original, 'YYYY-MM-DD HH12:MI:SS AM')
                                                    END
                                            END
                                        ELSE
                                            CASE WHEN $showHorarioReal = FALSE
                                                THEN to_timestamp(ti02.date || ' ' || ti05.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM')
                                                ELSE to_timestamp(ti02.date || ' ' || ti05.hora_ini_original, 'YYYY-MM-DD HH12:MI:SS AM')
                                            END
                                    END
                                ELSE to_timestamp(ti02.date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM')
                           END AS timestamp_ini,
                           CASE WHEN COALESCE(ti01.residente, false) = true
                                THEN
                                    CASE WHEN COALESCE(ti03.distribucion, 0) > 0
                                        THEN
                                            CASE WHEN
                                                    to_timestamp(current_date || ' ' || ti05.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') OR
                                                    to_timestamp(current_date || ' ' || ti05.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM')
                                                THEN to_timestamp(ti02.date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM')
                                                ELSE
                                                    CASE WHEN $showHorarioReal = FALSE
                                                        THEN to_timestamp(ti02.date || ' ' || ti05.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM')
                                                        ELSE to_timestamp(ti02.date || ' ' || ti05.hora_fin_original, 'YYYY-MM-DD HH12:MI:SS AM')
                                                    END
                                            END
                                        ELSE
                                            CASE WHEN $showHorarioReal = FALSE
                                                THEN to_timestamp(ti02.date || ' ' || ti05.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM')
                                                ELSE to_timestamp(ti02.date || ' ' || ti05.hora_fin_original, 'YYYY-MM-DD HH12:MI:SS AM')
                                            END
                                    END
                                ELSE to_timestamp(ti02.date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM')
                           END AS timestamp_fin,
                           CASE WHEN COALESCE(ti01.residente, false) = true
                                THEN
                                    CASE WHEN COALESCE(ti03.distribucion, 0) > 0
                                        THEN
                                            CASE WHEN
                                                    to_timestamp(current_date || ' ' || ti05.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') OR
                                                    to_timestamp(current_date || ' ' || ti05.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM') BETWEEN to_timestamp(current_date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH12:MI:SS AM') AND to_timestamp(current_date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH12:MI:SS AM')
                                                THEN FALSE
                                                ELSE TRUE
                                            END
                                        ELSE TRUE
                                    END
                                ELSE FALSE
                           END AS horario_generico,
                           CASE WHEN $showHorarioReal = TRUE
                               THEN ti04.id_tipo_distribucion
                               ELSE NULL
                           END AS id_tipo_distribucion,
                           CASE WHEN $showHorarioReal = TRUE
                               THEN ti04.nombre_tipo_distribucion
                               ELSE NULL
                           END AS nombre_tipo_distribucion
                    FROM mnt_empleado ti01,
                         rango_fecha ti02
                    LEFT JOIN (
                        SELECT yrs,
                               mes,
                               dia,
                               COUNT(*) AS distribucion
                        FROM  cit_distribucion
                        WHERE id_empleado = :idEmpleado
                              AND id_aten_area_mod_estab = :idEspecialidad
                              AND id_area_mod_estab = :idAreaModEstab
                        GROUP BY yrs, mes, dia
                    ) ti03 ON (ti03.yrs = EXTRACT(YEAR FROM ti02.date::timestamp) AND ti03.mes = EXTRACT(MONTH FROM ti02.date::timestamp) AND ti03.dia = EXTRACT(DOW FROM ti02.date::timestamp))
                    -- Horario de la Distribucion
                    LEFT JOIN (
                        SELECT t02.id,
                               TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM') AS hora_ini,
                               TO_CHAR(t02.hora_fin, 'HH12:MI:SS AM') AS hora_fin,
                               CONCAT(TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM'),' - ',TO_CHAR(t02.hora_fin, 'HH12:MI:SS AM')) AS rango_hora,
                               t03.id AS id_tipo_distribucion,
                               t03.nombre AS nombre_tipo_distribucion,
                               t01.id AS id_distribucion,
                               t01.dia,
                               t01.mes,
                               t01.yrs,
                               t01.id_estado_distribucion
                        FROM cit_distribucion t01
                        INNER JOIN mnt_rangohora t02 ON (t02.id = t01.id_rangohora)
                        LEFT  JOIN cit_tipo_distribucion t03 ON (t03.id = t01.id_tipo_distribucion)
                        WHERE t01.id_empleado = :idEmpleado
                              AND t01.id_aten_area_mod_estab = :idEspecialidad
                              AND t01.id_area_mod_estab      = :idAreaModEstab
                    ) ti04 ON (ti04.yrs = EXTRACT(YEAR FROM ti02.date::timestamp) AND ti04.mes = EXTRACT(MONTH FROM ti02.date::timestamp) AND ti04.dia = EXTRACT(DOW FROM ti02.date::timestamp))
                    -- Horario del Rango Escaldo
                    LEFT JOIN (
                        SELECT t01.date,
                               t02.id,
                               TO_CHAR(t02.hora, 'HH12:MI:SS AM') AS hora_ini,
                               TO_CHAR(t02.hora + interval '1 hour', 'HH12:MI:SS AM') AS hora_fin,
                               TO_CHAR(t03.hora_ini, 'HH12:MI:SS AM') AS hora_ini_original,
                               TO_CHAR(t03.hora_fin, 'HH12:MI:SS AM') AS hora_fin_original
                        FROM rango_fecha t01,
                             rango_hora_escalonado t02
                        LEFT JOIN mnt_rangohora t03 ON (t03.id = t02.id)
                    ) ti05 ON (ti05.date = ti02.date)
                    WHERE ti01.id = :idEmpleado
                    ORDER BY date, timestamp_ini
                ) tx01
                -- Citas Asignadas
                LEFT JOIN (
                    SELECT DISTINCT t01.fecha AS date,
                        t01.id_rangohora,
                        SUM((CASE WHEN t01.id_tipocita = 1 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) AS primera_vez,
                        SUM((CASE WHEN t01.id_tipocita = 2 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) AS subsecuentes,
                        SUM(CASE WHEN t01.id_estado = 6 THEN 1 ELSE 0 END) AS agregados,
                        COUNT(t01.id_tipocita) AS total_citas
                    FROM cit_citas_dia        t01
                    INNER JOIN mnt_expediente t02 ON (t01.id_expediente = t02.id)
                    INNER JOIN mnt_empleado   t03 ON (t01.id_empleado   = t03.id)
                    WHERE t01.fecha BETWEEN '$lowerLimit' AND '$upperLimit'
                        AND t01.id_empleado = :idEmpleado
                        AND t01.id_aten_area_mod_estab = :idEspecialidad
                        AND t01.id_estado NOT IN (3,9)
                    GROUP BY t01.fecha, t01.id_rangohora
                ) tx02 ON (tx01.date = tx02.date AND tx01.id_rango_hora = tx02.id_rangohora)
                -- Capacidad de citas
                LEFT JOIN (
                    SELECT yrs,
                           mes,
                           dia,
                           id_rangohora,
                           SUM(primera) AS primera_vez,
                           SUM(subsecuente) AS subsecuentes,
                           SUM(max_citas_agregadas) AS agregados
                    FROM cit_distribucion
                    WHERE id_empleado = :idEmpleado
                            AND id_aten_area_mod_estab = :idEspecialidad
                            AND id_area_mod_estab = :idAreaModEstab
                    GROUP BY yrs, mes, dia, id_rangohora
                ) tx03 ON (tx03.yrs = EXTRACT(YEAR FROM tx01.date::timestamp) AND tx03.mes = EXTRACT(MONTH FROM tx01.date::timestamp) AND tx03.dia = EXTRACT(DOW FROM tx01.date::timestamp) AND tx03.id_rangohora = tx01.id_rango_hora)
                -- Detalle de las citas
                $leftJoinDetalleCita
                -- Eventos del Medico
                LEFT JOIN (
                    SELECT t01.fecha_hora_ini AS timestamp_ini,
                           t01.fecha_hora_fin AS timestamp_fin,
                           t02.id       AS id_tipo_evento,
                           t02.nombre   AS nombre_tipo_evento
                    FROM mnt_evento            t01
                    INNER JOIN mnt_tipo_evento t02 ON (t02.id = t01.id_tipo_evento)
                    WHERE (t01.id_empleado = :idEmpleado OR id_empleado IS NULL)
                        AND es_evento_medico = TRUE AND id_modulo = 4
                ) tx05 ON ( ( tx01.timestamp_ini > tx05.timestamp_ini AND tx01.timestamp_ini < tx05.timestamp_fin ) OR ( tx01.timestamp_fin > tx05.timestamp_ini AND tx01.timestamp_fin < tx05.timestamp_fin ) )
                ORDER BY tx01.date, tx01.timestamp_ini";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idEmpleado', $idEmpleado);
        $stm->bindValue(':idEspecialidad', $idEspecialidad);
        $stm->bindValue(':idAreaModEstab', $idAreaModEstab);
        $stm->execute();
        $result = $stm->fetchAll();

        $result = $this->buildRangoCitasInfo($result, $mostrarDetalleCitas, $outputKeyFormat);

        return $result;
    }

    /* Funciones para el método getRangoCitasInfo */
    private function buildRangoCitasInfo($data, $mostrarDetalleCitas, $outputKeyFormat) {
        $result       = array();
        $arrayEventos = array();

        foreach ($data as $row) {
            $date = new \DateTime($row['date']);
            $id = $date->format($outputKeyFormat);

            if( !isset($result[$id]) ) {
                $result[$id] = array();
                $result[$id]['date']                 = $date->format('Y/m/d');
                $result[$id]['format']               = $date->format('d/m/Y');
                $result[$id]['dashFormat']           = $date->format('d-m-Y');
                $result[$id]['diaBloqueado']         = false;
                $result[$id]['diaParcialBloqueado']  = false;
                $result[$id]['poseeDistribucion']    = $row['posee_distribucion'];
                $result[$id]['residente']            = $row['residente'];
                $result[$id]['cantidadDistribucion'] = $row['cantidad_distribucion'];
                $result[$id]['pvCapacidad']          = 0;
                $result[$id]['pvAsignado']           = 0;
                $result[$id]['sbCapacidad']          = 0;
                $result[$id]['sbAsignado']           = 0;
                $result[$id]['agCapacidad']          = 0;
                $result[$id]['agAsignado']           = 0;
                $result[$id]['totalAsignados']       = 0;

                $arrayEventos[$id] = 0;
            }

            if( !isset($result[$id]['horarios']) ) {
                $result[$id]['horarios'] = array();
            }

            if($row['id_rango_hora'] !== NULL) {
                $newSchedule = array(
                    $row['id_rango_hora'],
                    $row['hora_ini'],
                    $row['hora_fin'],
                    $row['hora_ini'].' - '.$row['hora_fin'],
                    $row['horario_generico'],
                    $row['pv_capacidad'],
                    $row['pv_asignado'],
                    $row['sb_capacidad'],
                    $row['sb_asignado'],
                    $row['ag_capacidad'],
                    $row['ag_asignado'],
                    $row['total_asignados'],
                    $row['id_distribucion'],
                    $row['horario_bloqueado'],
                    $row['id_tipo_evento'],
                    $row['nombre_tipo_evento'],
                    $row['id_tipo_distribucion'],
                    $row['nombre_tipo_distribucion'],
                    $row['id_estado_distribucion']
                );

                $result[$id]['horarios'] = $this->addScheduleToDate($result[$id]['horarios'], $newSchedule, $row, $result[$id], $mostrarDetalleCitas, $arrayEventos[$id]);
            }

            if( $arrayEventos[$id] > 0 ) {
                if( count( $result[$id]['horarios'] ) === $arrayEventos[$id] ) {
                    $result[$id]['diaBloqueado'] = true;
                    $result[$id]['diaParcialBloqueado'] = false;
                } else {
                    $result[$id]['diaBloqueado'] = false;
                    $result[$id]['diaParcialBloqueado'] = true;
                }
            }
        }

        return $result;
    }

    private function addScheduleToDate($horarios, $newSchedule, $row, &$fechas, $mostrarDetalleCitas, &$countHorariosBloqueados) {
        $id = $newSchedule[3];

        if( !isset($horarios[$id]) ) {
            $horarios[$id] = array(
                'id'                     => $newSchedule[0],
                'horaIni'                => $newSchedule[1],
                'horaFin'                => $newSchedule[2],
                'rangoHora'              => $newSchedule[3],
                'generico'               => $newSchedule[4],
                'pvCapacidad'            => $newSchedule[5],
                'pvAsignado'             => $newSchedule[6],
                'sbCapacidad'            => $newSchedule[7],
                'sbAsignado'             => $newSchedule[8],
                'agCapacidad'            => $newSchedule[9],
                'agAsignado'             => $newSchedule[10],
                'totalAsignados'         => $newSchedule[11],
                'idDistribucion'         => $newSchedule[12],
                'bloqueado'              => $newSchedule[13],
                'idTipoEvento'           => $newSchedule[14],
                'nombreTipoEvento'       => $newSchedule[15],
                'idTipoDistribucion'     => $newSchedule[16],
                'nombreTipoDistribucion' => $newSchedule[17],
                'idEstadoDistribucion' => $newSchedule[18]
            );

            $fechas['pvCapacidad']    += $newSchedule[5];
            $fechas['pvAsignado']     += $newSchedule[6];
            $fechas['sbCapacidad']    += $newSchedule[7];
            $fechas['sbAsignado']     += $newSchedule[8];
            $fechas['agCapacidad']    += $newSchedule[9];
            $fechas['agAsignado']     += $newSchedule[10];
            $fechas['totalAsignados'] += $newSchedule[11];

            if($newSchedule[13] === true) {
                $countHorariosBloqueados++;
            }
        }

        if($mostrarDetalleCitas) {
            if( !isset($horarios[$id]['citas']) ) {
                $horarios[$id]['citas'] = array();
            }

            if($row['id_cita'] !== NULL) {
                $newAppointment = array(
                    $row['id_cita'],
                    $row['id_expediente'],
                    $row['numero_expediente'],
                    $row['nombre_paciente'],
                    $row['id_estado'],
                    $row['nombre_estado'],
                    $row['id_tipo_cita'],
                    $row['nombre_tipo_cita'],
                    $row['id_justificacion'],
                    $row['nombre_justificacion']
                );

                $horarios[$id]['citas'] = $this->addAppointmentToSchedule($horarios[$id]['citas'], $newAppointment);
            }
        }

        return $horarios;
    }

    private function addAppointmentToSchedule($citas, $newAppointment) {
        $id = $newAppointment[0];

        if( !isset($citas[$id]) ) {
            $citas[$id] = array(
                'id'                  => $newAppointment[0],
                'idExpediente'        => $newAppointment[1],
                'numeroExpediente'    => $newAppointment[2],
                'nombrePaciente'      => $newAppointment[3],
                'idEstado'            => $newAppointment[4],
                'nombreEstado'        => $newAppointment[5],
                'idTipoCita'          => $newAppointment[6],
                'nombreTipoCita'      => $newAppointment[7],
                'idJustificacion'     => $newAppointment[8],
                'nombreJustificacion' => $newAppointment[8]
            );
        }

        return $citas;
    }
    /*  Fin Funciones para el método getRangoCitasInfo */

    public function determinarTipoCita($idEmpleado, $idEspecialidad, $idExpediente) {
        $em         = $this->container->get('doctrine')->getManager();
        $primeraVez = false;

        /** Si es primera vez en el Establecimiento (para Seguimiento Clínico) **/
        $expediente   = $em->getRepository("MinsalSiapsBundle:MntExpediente")->find($idExpediente);
        $especialidad = $em->getRepository("MinsalSiapsBundle:MntAtenAreaModEstab")->find($idEspecialidad);
        $antecedentes = $em->getRepository('MinsalSeguimientoBundle:SecAntecedentes')->findOneBy(array('idPaciente' => $expediente->getIdPaciente()));

        if( count($antecedentes) > 0 ) {
            /** Saber si es primera vez en la especialidad **/
            $historialClinico = $em->getRepository("MinsalSeguimientoBundle:SecHistorialClinico")->obtenerHistorialClinico($idEmpleado, $idExpediente, $idEspecialidad);

            if ( count($historialClinico) > 0 ) {
                /* VERIFICAR QUE HAYA PASADO UN AÑO DESDE SU ULTIMA ACTUALIZACIÓN */
                $paciente = $expediente->getIdPaciente()->getId();
                $dql = "SELECT B.id,
                               DATE_DIFF(CURRENT_DATE(),A.fecha) diferencia
                        FROM MinsalSeguimientoBundle:SecAntecedentesEspecialidadForm A
                        JOIN MinsalSeguimientoBundle:SecAntecedentes B WITH (A.idAntecedentes = B.id)
                        JOIN B.idPaciente C
                        JOIN A.idAtenAreaModEstab D
                        WHERE C.id = $paciente AND D.id = $idEspecialidad
                        ORDER BY A.fecha DESC";

                $resultado = $em->createQuery($dql)->getResult();

                if ( empty($resultado) ) {
                    $primeraVez = true;
                } else if ($resultado[0]['diferencia'] < 365) {
                    $primeraVez = false;
                } else {
                    $primeraVez = true;
                }
            } else {
                $primeraVez = true;
            }
        } else {
            $primeraVez = true;
        }

        return $primeraVez;
    }

    /*  obtenerCupoDisponible
     *      Función que permite obtener el horario o rango de horarios en una fecha
     *      en la que se puede asignar citas.
     *
     *  Parametros:                         | Requerido | Valor por Defecto | Posibles Valores      | Descripcion
     *  ------------------------------------+-----------+-------------------+-----------------------+------------
     *      idEmpleado                      | No        | -                 | INTEGER |NULL         | id del Médico solo para citas médicas y para cuando el procedimiento tenga empleado
     *      idExpediente                    | No        | NULL              | INTEGER |NULL         | id del Expediente solo para obtener los días libres el idExpediente no es obligatorio
     *      idTipoCita                      | No        | NULL              | INTEGER | NULL        | id del tipo de cita primera vez o subsecuente solo aplicaría para citas médicas
     *      idEspecialidad                  | No        | NULL              | INTEGER | NULL        | id de la especialidad solo para citas medicas
     *      idAreaModEstab                  | Si        | -                 | INTEGER               | id del area de atencion este es necesario para las citas de procedimiento
     *      idProcedimientoEstablecimiento  | No        | NULL              | INTEGER | NULL        | id del procedimiento solo para citas de procedimiento
     *      fechaInicial                    | No        | NOW (fecha de Hoy)| DATETIME| NULL        | fecha de inicio de la busqueda
     *      fechaFinal                      | No        | NULL              | DATETIME| NULL        | fehca de finalizacion de la busqueda
     *      origenCita                      | No        | 1                 | 1       | 2     | NULL| Si la cita es de medica (1) o de procedimiento (2)
     *      incluirAgregados                | No        | FALSE             | TRUE    | FALSE | NULL| Si se incluira los cupos de agregados en la busqueda
     *      autoSeleccionarHorario          | No        | FALSE             | TRUE    | FALSE | NULL| Si se retornará el primer horario en que encuentre cupo
     *      exlcuirFechas                   | No        | array() (empty)   | array() | NULL        | Las fechas a excluir en la busqueda
     *      permitirMasCitas                | No        | FALSE             | TRUE    | FALSE | NULL| Si tiene TRUE(cita_integral=si) limita la búsqueda solamente a la especialidad en la que se está dando la cita, porque no permite más citas en la misma especialidad, FALSE busca en todas las demás especialidades incluyendola
     *      cambiarMedProc                  | No        | TRUE              | TRUE    | FALSE | NULL| Bandera que se utilizará para saber si el médico del procedimiento se cambiará según la distribución obtenida
     *      idTipoDistribucion              | No        | NULL              | INTEGER | NULL        | id del Tipo de Distribucion especial, si se proporciona se buscaran cupos solamente en dicho tipo de distribucion
     *      formatoFecha                    | No        | 'd/m/Y'           | STRING                | Formato en que se estan dando las fechas para ser convertidas a DateTime
     *      excluirTipoCita                 | No        | FALSE             | TRUE    | FALSE | NULL| Bandera que permitira buscar cupo sin tomar en cuenta el tipo de la cita si es TRUE, de lo contrario buscara cupos segun el tipo de cita
     */
    public function obtenerCupoDisponible($idEmpleado=NULL, $idExpediente=NULL, $idTipoCita = NULL, $idEspecialidad = NULL, $idAreaModEstab, $idProcedimientoEstablecimiento = NULL, $fechaInicial = NULL, $fechaFinal =  NULL, $origenCita = 1, $incluirAgregados = FALSE, $autoSeleccionarHorario = FALSE, $excluirFechas = array(), $permitirMasCitas = FALSE, $cambiarMedProc = TRUE, $idTipoDistribucion = NULL,$excluirTipoCita = FALSE, $formatoFecha = 'd/m/Y') {
        $now = new \DateTime();
        $em  = $this->container->get('doctrine')->getManager();

        /* Convirtiendo a los tipos de datos correctos */
        $idTipoCita      = $idTipoCita === NULL ? NULL : intval($idTipoCita);
        $fechaInicial    = $fechaInicial === NULL ? $now : ( gettype($fechaInicial) === 'object' ? $fechaInicial : \DateTime::createFromFormat($formatoFecha, $fechaInicial) ) ;
        $fechaFinal      = gettype($fechaFinal) === 'string' ? \DateTime::createFromFormat($formatoFecha, $fechaFinal) : $fechaFinal;
        $origenCita      = intval($origenCita);
        $excluirTipoCita = $excluirTipoCita === NULL ? FALSE : $excluirTipoCita;

        /* Inicializando variables */
        $currentDate      = $fechaInicial;
        $dia              = intval(date('w',$currentDate->getTimestamp()));
        $mes              = intval(date('n',$currentDate->getTimestamp()));
        $anio             = intval(date('Y',$currentDate->getTimestamp()));
        $cuposDisponibles = array();
        $dateFound        = FALSE;
        $codigoTipoCita   = $origenCita === 1 ? ( $idTipoCita === 1 ? 'Pv' : 'Sb' ) : 'Pr';
        $procedimientoServices = $this->container->get('cit_citas_procedimientos.services');
        $idProcedimiento  = $idProcedimientoEstablecimiento !== NULL ? $em->getRepository('MinsalSiapsBundle:MntProcedimientoEstablecimiento')->findOneById($idProcedimientoEstablecimiento)->getIdCiq()->getId() : NULL;

        if($origenCita === 1) {
            $distribucion = $this->obtenerRangoDistribucion($idEmpleado, $idEspecialidad, $anio, $mes, NULL, NULL, NULL, NULL, $idTipoDistribucion);
        } else {
            $distribucion = $procedimientoServices->obtenerRangoDistribucion($idProcedimientoEstablecimiento,$idEmpleado, $anio, $mes, NULL, NULL, NULL, NULL, $idTipoDistribucion);
        }

        if( count($distribucion) > 0 ) {
            $today = FALSE;

            if($fechaFinal === NULL) {
                $today = FALSE;
            } else {
                if( $fechaInicial->format('d/m/Y') === $now->format('d/m/Y') && $fechaFinal->format('d/m/Y') === $now->format('d/m/Y') ) {
                    $today = TRUE;
                }
            }

            if( $today === FALSE ) {
                $maxAnio = max(array_keys($distribucion));
                while( $anio <= $maxAnio && $dateFound === FALSE ) {

                    if( array_key_exists( $anio, $distribucion ) ) {
                        $maxMes = max( array_keys( $distribucion[$anio]['meses']));

                        while ( $mes <= $maxMes && $dateFound === FALSE ) {

                            if( array_key_exists( $mes, $distribucion[$anio]['meses'] ) ) {
                                $DOWs        = array_keys($distribucion[$anio]['meses'][$mes]['dias']);
                                $rangoFechas = $this->getDatesOfRangeByDOW($currentDate->format('d/m/Y'), NULL, $DOWs);

                                $rangoFechas = array_values(array_diff($rangoFechas, $excluirFechas));
                                if( count($rangoFechas) > 0 ) {
                                    for ($i = 0; $i < count($rangoFechas) && $dateFound === FALSE ; $i++) {
                                        $currentDate = \DateTime::createFromFormat('d/m/Y',$rangoFechas[$i]);

                                        $estadoDiasIntermedio = $permitirMasCitas==false ?($origenCita==1 ? ($idExpediente?$this->verificarDiasIntermedios($currentDate->format('d/m/Y'), $idExpediente):array()):array()):array();//Aplica para citas médicas y de procedimientos

                                        if( count($estadoDiasIntermedio) === 0 ) {
                                            $idEspecialidadBuscar  = $permitirMasCitas ? $idEspecialidad : NULL;
                                            $idProcedimientoBuscar = $permitirMasCitas ? $idProcedimientoEstablecimiento : NULL;

                                            if($permitirMasCitas){
                                                if($origenCita == 1){
                                                    $poseeCita = $idExpediente?$this->pacientePoseeCita($idExpediente, $currentDate->format('d/m/Y'), $currentDate->format('d/m/Y'), $idEspecialidadBuscar):array();
                                                }else{
                                                    $poseeCita = $idExpediente?$procedimientoServices->pacientePoseeCita($idExpediente, $currentDate->format('d/m/Y'), $currentDate->format('d/m/Y'), $idProcedimientoBuscar):array();
                                                }
                                            }else{
                                                $poseeCita = $idExpediente?$this->pacientePoseeCita($idExpediente, $currentDate->format('d/m/Y'), $currentDate->format('d/m/Y'), $idEspecialidadBuscar):array();
                                                if(count($poseeCita) === 0){
                                                    $poseeCita = $idExpediente?$procedimientoServices->pacientePoseeCita($idExpediente, $currentDate->format('d/m/Y'), $currentDate->format('d/m/Y'), $idProcedimientoBuscar):array();
                                                }
                                            }

                                            if( count($poseeCita) === 0 ) {
                                                if($origenCita === 1) {
                                                    $eventos = $this->getEventos($idEmpleado, $currentDate->format('d/m/Y'), $currentDate->format('d/m/Y'));
                                                } else {
                                                    $eventos = $procedimientoServices->getEventos($idProcedimientoEstablecimiento, $currentDate->format('d/m/Y'), $currentDate->format('d/m/Y'),$idEmpleado);
                                                }

                                                $eventos = $eventos[$currentDate->format('d/m/Y')];

                                                if( $eventos['bloqueoTotalDia'] === FALSE ) {
                                                    $dow           = date( 'w', $currentDate->getTimestamp() );
                                                    $horarios      = $distribucion[$anio]['meses'][$mes]['dias'][$dow]['horarios'];
                                                    $limiteHorario = $autoSeleccionarHorario ? 1 : count($horarios);

                                                    foreach ($horarios as $key => $horario) {
                                                        $horarioSinEvento = TRUE;

                                                        if($eventos['bloqueoParcialDia'] === TRUE) {
                                                            $distribucionHorarioIni = \DateTime::createFromFormat('h:i:s A', $horario['horaIni']);
                                                            $distribucionHorarioFin = \DateTime::createFromFormat('h:i:s A', $horario['horaFin']);

                                                            foreach ($eventos['horarios'] as $ehKey => $eventoHorario) {
                                                                $eventoHorarioIni = \DateTime::createFromFormat('h:i:s A', $eventoHorario['horaIni']);
                                                                $eventoHorarioFin = \DateTime::createFromFormat('h:i:s A', $eventoHorario['horaIni']);

                                                                if( ( $distribucionHorarioIni > $eventoHorarioIni && $distribucionHorarioIni > $eventoHorarioFin ) || ( $distribucionHorarioFin > $eventoHorarioIni && $distribucionHorarioFin > $eventoHorarioFin ) ) {
                                                                    $horarioSinEvento = FALSE;
                                                                    break;
                                                                }
                                                            }
                                                        }

                                                        if($horarioSinEvento && $horario['distribucion']['idEstado']==1) {
                                                            $incluirHorario = FALSE;

                                                            $capacidadPv = $origenCita === 1 ? intval($horario['distribucion']['distribucionMedica']['capacidadPv'])      : NULL;
                                                            $capacidadSb = $origenCita === 1 ? intval($horario['distribucion']['distribucionMedica']['capacidadSb'])      : NULL;
                                                            $capacidadPr = $origenCita === 2 ? intval($horario['distribucion']['distribucionProcedimiento']['capacidad']) : NULL;
                                                            $capacidadAg = $origenCita === 1 ? intval($horario['distribucion']['distribucionMedica']['capacidadAg'])      : intval($horario['distribucion']['distribucionProcedimiento']['capacidadAg']);

                                                            if($origenCita === 1) {
                                                                $cargaCitas = $this->getRangoCitasInfo($idEmpleado, $idEspecialidad, $currentDate->format('d/m/Y'), $currentDate->format('d/m/Y'), false, 'true', true);
                                                            } else {
                                                                $auxEmpleado=$cambiarMedProc?$horario['distribucion']['idEmpleado']:$idEmpleado;
                                                                $cargaCitas = $procedimientoServices->getRangoCitasInfo($idProcedimiento, $idAreaModEstab, $auxEmpleado, $currentDate->format('d/m/Y'), $currentDate->format('d/m/Y'), false, 'true', false);
                                                            }

                                                            $cargaPv = $origenCita === 1 ? intval($cargaCitas[$currentDate->format('d/m/Y')]['horarios'][$key]['pvAsignado']) : NULL;
                                                            $cargaSb = $origenCita === 1 ? intval($cargaCitas[$currentDate->format('d/m/Y')]['horarios'][$key]['sbAsignado']) : NULL;
                                                            $cargaPr = $origenCita === 2 ? intval($cargaCitas[$currentDate->format('d/m/Y')]['horarios'][$key]['prAsignado']) : NULL;
                                                            $cargaAg = intval($cargaCitas[$currentDate->format('d/m/Y')]['horarios'][$key]['agAsignado']);

                                                            $capacidad = $excluirTipoCita ? ($origenCita === 1 ? ( $capacidadPv + $capacidadSb ):( $capacidadPr ))  : ${ 'capacidad'.$codigoTipoCita };
                                                            $carga     = $excluirTipoCita ? ($origenCita === 1 ? ( $cargaPv + $cargaSb ):($cargaPr)) : ${ 'carga'.$codigoTipoCita };

                                                            if( $carga < $capacidad ) {
                                                                if( $excluirTipoCita ) {
                                                                    $incluirHorario = TRUE;
                                                                } else {
                                                                    if ($origenCita===1) {
                                                                        if( ( $cargaPv + $cargaSb ) < ( $capacidadPv + $capacidadSb ) ) {
                                                                            $incluirHorario = TRUE;
                                                                        }else{
                                                                            if( $incluirAgregados ) {
                                                                                if( $cargaAg < $capacidadAg ) {
                                                                                    $incluirHorario = TRUE;
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        if( ( $cargaPr ) < ( $capacidadPr ) ) {
                                                                            $incluirHorario = TRUE;
                                                                        }
                                                                    }

                                                                }
                                                            } else {
                                                                if( $incluirAgregados ) {
                                                                    if( $cargaAg < $capacidadAg ) {
                                                                        $incluirHorario = TRUE;
                                                                    }
                                                                }
                                                            }

                                                            if( $incluirHorario ) {
                                                                $cuposDisponibles[] = $this->crearArrayCuposDisponibles($origenCita, $idTipoCita, $codigoTipoCita, $horario, $horario['rangoHora'], $currentDate, $cargaCitas,$excluirTipoCita);
                                                            }

                                                            if( count($cuposDisponibles) >= $limiteHorario ) {
                                                                break;
                                                            }
                                                        }
                                                    }

                                                    if( count($cuposDisponibles) > 0 ) {
                                                        $dateFound = TRUE;
                                                    }
                                                }
                                            }//FIN DEL POSEE CITA MÉDICA
                                        }
                                    }
                                }
                            }

                            $mes         = $mes + 1;
                            $currentDate = \DateTime::createFromFormat('d/m/Y', '01/'.$mes.'/'.$anio);
                        }
                    }

                    $anio = $anio + 1;
                    $mes=1;
                    $currentDate = \DateTime::createFromFormat('d/m/Y', '01/01/'.$anio);
                }
            } else {
                if(array_key_exists($dia, $distribucion[$anio]['meses'][$mes]['dias'])){
                    $horarios      = $distribucion[$anio]['meses'][$mes]['dias'][$dia]['horarios'];
                    $limiteHorario = $autoSeleccionarHorario ? 1 : count($horarios);

                    foreach ($horarios as $key => $horario) {
                        $incluirHorario = FALSE;
                        $horaFin        = \DateTime::createFromFormat('h:i:s A', $horario['horaFin']);

                        if( $horaFin > $now ) {
                            $incluirHorario = TRUE;
                        }

                        if( $incluirHorario ) {
                            if($origenCita === 1) {
                                $cargaCitas = $this->getRangoCitasInfo($idEmpleado, $idEspecialidad, $fechaInicial->format('d/m/Y'), $fechaFinal->format('d/m/Y'), false, 'true', false);
                            } else {
                                $auxEmpleado=$cambiarMedProc?$horario['distribucion']['idEmpleado']:$idEmpleado;
                                $cargaCitas = $procedimientoServices->getRangoCitasInfo($idProcedimiento, $idAreaModEstab, $auxEmpleado, $currentDate->format('d/m/Y'), $currentDate->format('d/m/Y'), false, 'true', false);
                            }

                            $cuposDisponibles[] = $this->crearArrayCuposDisponibles($origenCita, $idTipoCita, $codigoTipoCita, $horario, $horario['rangoHora'], $fechaInicial, $cargaCitas,$excluirTipoCita);
                        }
                    }

                    if( count($horarios) > 0 && count($cuposDisponibles) === 0 ) {
                        $ultimoHorario = end($horarios);
                        if($origenCita === 1) {
                            $cargaCitas = $this->getRangoCitasInfo($idEmpleado, $idEspecialidad, $fechaInicial->format('d/m/Y'), $fechaFinal->format('d/m/Y'), false, 'true', false);
                        } else {
                            $auxEmpleado=$cambiarMedProc?$ultimoHorario['distribucion']['idEmpleado']:$idEmpleado;
                            $cargaCitas = $procedimientoServices->getRangoCitasInfo($idProcedimiento, $idAreaModEstab, $auxEmpleado, $currentDate->format('d/m/Y'), $currentDate->format('d/m/Y'), false, 'true', false);
                        }

                        $cuposDisponibles[] = $this->crearArrayCuposDisponibles($origenCita, $idTipoCita, $codigoTipoCita, $ultimoHorario, $ultimoHorario['rangoHora'], $fechaInicial, $cargaCitas,$excluirTipoCita);
                    }
                }
            }
        }

        return $cuposDisponibles;
    }

    /*  verificarDiasIntermedios
     *      Función que permite obtener las citas para un limite inferior y superior
     *      a partir de una fecha pivote y de los dias intermedios configurados en las citas
     *
     *  Parametros:           | Requerido | Valor por Defecto | Posibles Valores      | Descripcion
     *  ----------------------+-----------+-------------------+-----------------------+------------
     *      date              | Si        | -                 | STRING                | fecha pivote a partir de la cual se desea verificar los limites
     *      idExpediente      | Si        | -                 | INTEGER               | id del Expediente del paciente
     *      inputFormat       | No        | 'd/m/Y'           | STRING  | NULL        | formato de entrada de la fecha enviada
     *      weekday           | No        | FALSE             | STRING  | NULL        | bandera que permite definir si los fines de semanas seran incluidos
     *      skypeTodayCreated | No        | FALSE             | BOOLEAN               | bandera que permite no tomar encuenta las citas creadas el dia de ahora
     *      skypeUser         | No        | NULL              | INTEGER | NULL        | bandera que permite no tomar en cuenta las citas creadas por el usuario
     */
    public function verificarDiasIntermedios($date, $idExpediente, $inputFormat = 'd/m/Y', $weekday = FALSE, $skipTodayCreated = FALSE, $skipUser = NULL) {
        $em                 = $this->container->get('doctrine')->getManager();
        $pivotDate          = \DateTime::createFromFormat($inputFormat.' h:i:s', $date.' 00:00:00');
        $lowerLimit         = \DateTime::createFromFormat($inputFormat.' h:i:s', $date.' 00:00:00');
        $upperLimit         = \DateTime::createFromFormat($inputFormat.' h:i:s', $date.' 00:00:00');
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $diasEntreCitas     = intval($CtlEstablecimiento->getDiasIntermediosCitas());
        $result             = array();
        $now                = new \DateTime();

        if($diasEntreCitas > 0) {
            $lowerLimit = $this->addOrSubDays($lowerLimit, $diasEntreCitas, 'sub');
            $upperLimit = $this->addOrSubDays($upperLimit, $diasEntreCitas, 'add');

            $qb = $em->createQueryBuilder();

            $qb->select('t01')
               ->from('MinsalCitasBundle:CitCitasDia', 't01')
               ->where($qb->expr()->between('t01.fecha', ':lowerLimit', ':upperLimit'))
               ->andWhere($qb->expr()->in('t01.idEstado', array(1,4,6)))
               ->andWhere('t01.idExpediente = :idExpediente')
               ->andWhere('t01.fecha != :fecha')
               ->setParameters(
                    array(
                        ':lowerLimit'   => $lowerLimit->format('Y-m-d'),
                        ':upperLimit'   => $upperLimit->format('Y-m-d'),
                        ':idExpediente' => $idExpediente,
                        ':fecha'        => $pivotDate->format('Y-m-d')
                    )
                );

            if( $skipTodayCreated ) {
                $qb->andWhere('date(t01.fechahorareg) != :fechahorareg')
                   ->setParameter(':fechahorareg', $now->format('Y-m-d'));
            }

            if( $skipUser ) {
                $qb->andWhere('t01.idusuarioreg != :idusuarioreg')
                   ->setParameter(':idusuarioreg', $skipUser);
            }

            $result = $qb->getQuery()->getArrayResult();
        }

        return $result;
    }

    /*  getDatesOfRangeByDOW
     *      Permite obtener un rango de fechas para los dias de la semana dados, desde
     *      una fecha inicial hasta el final del mes, si no se especifica la fecha final es el ultimo dia del mes
     *
     *  Parametros:         | Requerido | Valor por Defecto | Posibles Valores      | Descripcion
     *  --------------------+-----------+-------------------+-----------------------+------------
     *      startDate       | Si        | -                 | STRING                | fecha pivote a partir de la cual se desea verificar los limites
     *      endDate         | No        | NULL              | STRING | NULL         | formato de entrada de la fecha enviada
     *      DOWs            | No        | array('0',...,'6')| ARRAY  | NULL         | Array que contiene los dias de la semana de los cuales se quieren obtener las fechas
     *      startDateFormat | No        | 'd/m/Y'           | STRING                | id del Expediente del paciente
     *      endDateFormat   | No        | 'd/m/Y'           | STRING | NULL         | bandera que permite definir si los fines de semanas seran incluidos
     *      $formatReturn   | No        | 'd/m/Y'           | STRIGN | NULL         | formato de retorno de las fechas
     */
    public function getDatesOfRangeByDOW($startDate, $endDate = NULL, $DOWs = array('0','1','2','3','4','5','6'), $startDateFormat = 'd/m/Y', $endDateFormat = 'd/m/Y', $formatReturn = 'd/m/Y') {
        $date       = \DateTime::createFromFormat($startDateFormat, $startDate);
        $endDate    = $endDate === NULL ? date( 't', strtotime( $date->format('Y-m-d') ) ).$date->format('/m/Y') : $endDate;
        $endDate    = \DateTime::createFromFormat($endDateFormat, $endDate);
        $arrayDates = array();

        while($date <= $endDate) {
            if(in_array(date('w', $date->getTimestamp()), $DOWs)) {
                $arrayDates[] = $date->format($formatReturn);
            }

            $date->add(new \DateInterval('P1D'));
        }

        return $arrayDates;
    }

    /*  addOrSubDays
     *      permite agregar o restar dias a una fecha dada, los dias agregados o restados
     *      pueden o no incluir los fines de semana segun la configracion dada
     *
     *  Parametros:         | Requerido | Valor por Defecto | Posibles Valores   | Descripcion
     *  --------------------+-----------+-------------------+--------------------+------------
     *      date            | Si        | -                 | STRING  | DATETIME | fecha ya sea en string o DateTime a la cual se le quiere sumar o restar dias
     *      daysToAddSub    | Si        | -                 | INTEGER            | cantidad de dias a sumar o restar
     *      action          | Si        | -                 | STRING             | acion que se desea hacer 'add' (SUMAR) o sub ('RESTAR')
     *      weekdays        | No        | FALSE             | BOOLEAN | NULL     | bandera que permite definir si los fines de semanas seran incluidos
     *      inputFormat     | No        | 'd/m/y'           | STRING  | NULL     | formato de entrada de la fecha para el caso que se envia un string
     */
    public function addOrSubDays($date, $daysToAddSub, $action, $weekdays = FALSE, $inputFormat = 'd/m/Y') {
        $addedDays = 0;
        $date = gettype($date) === 'string' ? \DateTime::createFromFormat($inputFormat, $date) : ( gettype($date) === 'object' ? $date : NULL );

        while ($addedDays < $daysToAddSub) {
            if ( strtolower($action) === 'add') {
                $date->add(new \DateInterval('P1D'));
            } else {
                $date->sub(new \DateInterval('P1D'));
            }

            $dayOfWeek = date( 'w', $date->getTimestamp() );

            if($weekdays === FALSE) {
                if( $dayOfWeek !== '0' && $dayOfWeek !== '6' ) {
                    $addedDays++;
                }
            } else {
                $addedDays++;
            }
        }

        return $date;
    }

    /*
     * DESCRIPCIÓN: Determina la cantidad de citas otorgadas a un paciente en un rango de fechas,
     * en una especialidad en específico o en todas las que esten habilitadas para el Establecimiento.
     * PARAMETROS: id del expediente, fecha de inicio para la búsqueda, fecha fin(opcional), especialidad médica(opcional)
     */
    public function pacientePoseeCita($idExpediente, $lowerLimit, $upperLimit = NULL, $idEspecialidad = NULL, $inputFormat = 'd/m/Y') {
        $em                = $this->container->get('doctrine')->getManager();
        $whereEspecialidad = '';
        $whereFechaFin     = '';
        $lowerLimit        = \DateTime::createFromFormat($inputFormat, $lowerLimit);
        $upperLimit        = $upperLimit !== NULL ? \DateTime::createFromFormat($inputFormat, $upperLimit) : NULL;

        if($idEspecialidad) {
            $whereEspecialidad = 'AND A.id_aten_area_mod_estab = :idAtenAreaModEstab';
        }

        if($upperLimit != NULL) {
            $whereFechaFin = 'AND A.fecha<= :upperLimit';
        }

        $sql = "SELECT A.*,initcap(nombreempleado) as medico, initcap(D.nombre) as especialidad,
                CONCAT(TO_CHAR(E.hora_ini, 'HH12:MI:SS AM'),' - ',TO_CHAR(E.hora_fin, 'HH12:MI:SS AM')) AS rango_hora
                FROM cit_citas_dia A
                      INNER JOIN mnt_empleado B ON (A.id_empleado=B.id)
                      INNER JOIN mnt_aten_area_mod_estab C ON (A.id_aten_area_mod_estab=C.id)
                      INNER JOIN ctl_atencion D ON (D.id=C.id_atencion)
                      INNER JOIN mnt_rangohora E ON (A.id_rangohora=E.id)
                WHERE A.fecha >= :lowerLimit
                    AND A.id_estado NOT IN (3,9)
                    AND A.id_expediente = :idExpediente
                    $whereEspecialidad
                    $whereFechaFin
                ORDER BY A.fecha";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idExpediente', $idExpediente);
        $stm->bindValue(':lowerLimit', $lowerLimit->format('Y-m-d'));

        if($idEspecialidad) {
            $stm->bindValue(':idAtenAreaModEstab', $idEspecialidad);
        }

        if($upperLimit !== NULL) {
            $stm->bindValue(':upperLimit', $upperLimit->format('Y-m-d'));
        }

        $stm->execute();
        $result = $stm->fetchAll();

        return $result;
    }

    /*
     * NOMBRE: obtenerRangoDistribucion
     * DESCRIPCIÓN: Método que permite obtener las distribuciones de un médico en un rango predeterminado.
     * PARÁMETROS DE ENTRADA:
     *
     *  Parametros:                         | Requerido | Valor por Defecto | Posibles Valores      | Descripcion
     *  ------------------------------------+-----------+-------------------+-----------------------+------------
     *      idEmpleado                      | Si        | -                 | -                     | id del Médico
     *      idEspecialidad                  | No        | NULL              | INTEGER | NULL        | id de la especialidad, cuando sea NULL se mostrarán todas las especialidades
     *      anioInicial                     | No        | NULL              | INTEGER | NULL        | Año Inicial de la Busqueda; si es NULL no tiene límite de busqueda
     *      mesInicial                      | No        | NULL              | INTEGER | NULL        | Mes Inicial de la Busqueda; si es NULL no tiene límite de busqueda
     *      diaSemanaInicial                | No        | NULL              | INTEGER | NULL        | Dia de la Semana Inicial de la Busqueda; si es NULL no tiene límite de busqueda
     *      anioFinal                       | No        | NULL              | INTEGER | NULL        | Año Final de la Busqueda; si es NULL no tiene límite de busqueda
     *      mesFinal                        | No        | NULL              | INTEGER | NULL        | Mes Final de la Busqueda; si es NULL no tiene límite de busqueda
     *      diaSemanaFinal                  | No        | NULL              | INTEGER | NULL        | Dia de la Semana Final de la Busqueda; si es NULL no tiene límite de busqueda
     *      idTipoDistribucion              | No        | NULL              | INTEGER | NULL        | id del Tipo de Distribucion Especial, si se proporciona retornará solamente las distribuciones de dicho tipo
     *      buscarActivo                    | No        | TRUE              | BOOLEAN | NULL        | Bandera que permite buscar si la distribucion si se encuentra activa (true) o si esta cerrada (false), (NULL) para ambos estados
     *
     * RETORNO:
     *       Array de distribuciones para el rango seleccionado.
     * ANALISTA PROGRAMADOR: Ing. Karen Peñate
     */
    public function obtenerRangoDistribucion($idEmpleado, $idEspecialidad = NULL, $anioInicial = NULL, $mesInicial = NULL, $diaSemanaInicial = 1, $anioFinal = NULL, $mesFinal = NULL, $diaSemanaFinal = NULL, $idTipoDistribucion = NULL, $buscarActivo = TRUE) {
        $em   = $this->container->get('doctrine')->getManager();
        $anio = '';
        $mes  = '';
        $dia  = '';

        $rangoHora    = '';
        $fechaActual  = new \DateTime();
        $distribucion = array();
        $resultados   = array();

        $whereIdEspecialidad = $idEspecialidad ? " AND t03.id = $idEspecialidad" : '';

        $whereMes                = '';
        $whereAnio               = '';
        $whereDiaSemana          = '';
        $whereTipoDistribucion   = '';
        $whereEstadoDistribucion = '';

        if( $anioInicial !== NULL && $anioFinal !== NULL ) {
            if( $anioInicial === $anioFinal ) {
                $whereAnio = " AND t01.yrs = $anioInicial";

                if( $mesInicial !== NULL && $mesFinal !== NULL ) {
                    if( $mesInicial === $mesFinal ) {
                        $whereMes = " AND t01.mes = $mesInicial";

                        if( $diaSemanaInicial !== NULL && $diaSemanaFinal !== NULL ) {
                            if( $diaSemanaInicial === $diaSemanaFinal ) {
                                $whereDiaSemana = " AND t01.dia = $diaSemanaInicial";
                            } else {
                                $whereDiaSemana = " AND t01.dia >= $diaSemanaInicial AND t01.ida <= $diaSemanaFinal";
                            }
                        } else {
                            if( $diaSemanaInicial !== NULL ) {
                                $whereDiaSemana = " AND t01.dia >= $diaSemanaInicial";
                            } else {
                                if( $diaSemanaFinal !== NULL ) {
                                    $whereDiaSemana = " AND t01.ida <= $diaSemanaInicial";
                                }
                            }
                        }
                    } else {
                        $whereMes = " AND t01.mes >= $mesInicial AND t01.mes <= $mesFinal";

                        if( $diaSemanaInicial !== NULL && $diaSemanaFinal !== NULL ) {
                            $whereDiaSemana = " AND ( CASE WHEN t01.mes = $mesInicial THEN t01.dia >= $diaSemanaInicial ELSE t01.dia >= 1 END) AND ( CASE WHEN t01.mes = $mesFinal THEN t01.dia <= $diaSemanaFinal ELSE t01.dia <= 5  END)";
                        } else {
                            if( $diaSemanaInicial !== NULL ) {
                                $whereDiaSemana = " AND ( CASE WHEN t01.mes = $mesInicial THEN t01.dia >= $diaSemanaInicial ELSE t01.dia >= 1 END)";
                            } else {
                                if( $diaSemanaFinal !== NULL ) {
                                    $whereDiaSemana = " AND ( CASE WHEN t01.mes = $mesFinal THEN t01.dia <= $diaFinal ELSE t01.dia <= 5 END)";
                                }
                            }
                        }
                    }
                } else {
                    if( $mesInicial !== NULL ) {
                        $whereMes = " AND t01.mes >= $mesInicial";

                        if( $diaSemanaInicial !== NULL ) {
                            $whereDiaSemana = " AND ( CASE WHEN t01.mes = $mesInicial THEN t01.dia >= $diaSemanaInicial ELSE t01.dia >= 1 END)";
                        }
                    } else {
                        if( $mesFinal !== NULL ) {
                            $whereMes = " AND t01.mes <= $mesFinal";

                            if( $diaSemanaFinal !== NULL ) {
                                $whereDiaSemana = " AND ( CASE WHEN t01.mes = $mesFinal THEN t01.dia <= $diaSemanaFinal ELSE t01.dia <= 5 END)";
                            }
                        }
                    }
                }
            } else {
                $whereAnio = " AND t01.yrs >= $anioInicial AND t01.yrs <= $anioFinal";

                if( $mesInicial !== NULL && $mesFinal !== NULL ) {
                    $whereMes = " ( CASE WHEN t01.yrs = $anioInicial THEN t01.mes >= $mesInicial ELSE t01.mes >= 1 ) AND ( CASE WHEN t01.yrs = $anioFinal THEN t01.mes <= $mesFinal ELSE t01.mes <= 12 END)";

                    if( $diaSemanaInicial !== NULL && $diaSemanaFinal !== NULL ) {
                        $whereDiaSemana = " AND ( CASE WHEN t01.yrs = $anioInicial AND t01.mes = $mesInicial THEN t01.dia >= $diaSemanaInicial ELSE t01.dia >= 1 END) AND ( CASE WHEN t01.yrs = $anioFin AND t01.mes = $mesFin THEN t01.dia <= $diaSemanaFinal ELSE t01.dia <= 5 END)";
                    } else {
                        if( $diaSemanaInicial !== NULL ) {
                            $whereDiaSemana = " AND ( CASE WHEN t01.yrs = $anioInicial AND t01.mes = $mesInicial THEN t01.dia >= $diaSemanaInicial ELSE t01.dia >= 1 END)";
                        } else {
                            if( $diaSemanaFinal !== NULL ) {
                                $diaSemanaFinal = "( CASE WHEN t01.yrs = $anioFin AND t01.mes = $mesFin THEN t01.dia <= $diaSemanaFinal ELSE t01.dia <= 5 END)";
                            }
                        }
                    }
                } else {
                    if( $mesInicial !== NULL ) {
                        $whereMes = " AND ( CASE WHEN t01.yrs = $anioInicial THEN t01.mes >= $mesInicial ELSE t01.mes >= 1 END)";

                        if( $diaSemanaInicial !== NULL ) {
                            $whereDiaSemana = " AND ( CASE WHEN t01.yrs = $anioInicial AND t01.mes = $mesInicial THEN t01.dia >= $diaSemanaInicial ELSE t01.dia >= 1 END)";
                        }
                    } else {
                        if( $mesFinal !== NULL ) {
                            $whereMes = " AND ( CASE WHEN t01.yrs = $anioFinal THEN t01.mes <= $mesFinal ELSE t01.mes <= 12 END)";

                            if( $diaSemanaFinal !== NULL ) {
                                $diaWhere = " AND ( CASE WHEN t01.yrs = $anioFinal AND t01.mes = $mesFinal THEN t01.dia <= $diaSemanaFinal ELSE t01.dia <= 5 END)";
                            }
                        }
                    }
                }
            }
        } else {
            if( $anioInicial !== NULL ) {
                $whereAnio = " AND t01.yrs >= $anioInicial";

                if( $mesInicial !== NULL ) {
                    $whereMes = " AND ( CASE WHEN t01.yrs = $anioInicial THEN t01.mes >= $mesInicial ELSE t01.mes >= 1 END)";

                    if( $diaSemanaInicial !== NULL ) {
                        $whereDiaSemana = " AND ( CASE WHEN t01.yrs = $anioInicial AND t01.mes = $mesInicial THEN t01.dia >= $diaSemanaInicial ELSE t01.dia >= 1 END)";
                    }
                }
            } else {
                if( $anioFinal !== NULL ) {
                    $whereAnio = " AND t01.yrs >= $anioFinal";

                    if( $mesFinal !== NULL ) {
                        $whereMes = " AND ( CASE WHEN t01.yrs = $anioFinal THEN t01.mes <= $mesFinal ELSE t01.mes <= 12 END)";

                        if( $diaSemanaInicial !== NULL ) {
                            $whereDiaSemana = " AND ( CASE WHEN t01.yrs = $anioFinal AND t01.mes = $mesFinal THEN t01.dia <= $diaSemanaFinal ELSE t01.dia <= 5 END)";
                        }
                    }
                }
            }
        }

        if($idTipoDistribucion) {
            $whereTipoDistribucion = " AND t01.id_tipo_distribucion = $idTipoDistribucion";
        }else{
            $whereTipoDistribucion = " AND t01.id_tipo_distribucion IS NULL";
        }

        $whereEstadoDistribucion = $buscarActivo === NULL ? '' : ( $buscarActivo ? ' AND t01.id_estado_distribucion = 1' : ' AND t01.id_estado_distribucion = 2' );

        $sql = "SELECT  t01.id as id_distribucion,
                	t01.mes,
                	t01.yrs,
                	t01.dia,
                	t01.primera,
                	t01.subsecuente,
                	t01.max_citas_agregadas,
                	t07.id as id_rangohora,
                	TO_CHAR(t07.hora_ini, 'HH12:MI:SS AM') AS hora_ini,
                        TO_CHAR(t07.hora_fin, 'HH12:MI:SS AM') AS hora_fin,
                        CONCAT(TO_CHAR(t07.hora_ini, 'HH12:MI:SS AM'),' - ',TO_CHAR(t07.hora_fin, 'HH12:MI:SS AM')) AS rango_hora,
                        initcap(t02.nombreempleado) as nombreempleado,
                        t02.id as id_empleado,
                        t04.id as id_consultorio,
                        initcap(t04.nombre) as nombre_consultorio,
                        t05.id as id_estado_distribucion,
                        t05.nombre as nombre_estado,
                        t06.nombre as nombre_especialidad,
                        t03.id as id_aten_area_mod_estab,
                        t08.id as id_tipo_distribucion,
                        t08.nombre as nombre_tipo_distribucion,
                        t09.id as id_area_mod_estab,
                        CASE
                    		WHEN t09.id_servicio_externo_estab IS NOT NULL THEN CONCAT_WS('-',t13.nombre,t10.nombre,t14.nombre)
                    		ELSE CONCAT_WS('-',t13.nombre,t10.nombre)
                    	END as nombre_area_atencion
                FROM cit_distribucion                               t01
                	INNER JOIN mnt_empleado                         t02 ON (t02.id = t01.id_empleado AND t02.id=$idEmpleado)
                    INNER JOIN mnt_aten_area_mod_estab              t03 ON (t03.id = t01.id_aten_area_mod_estab $whereIdEspecialidad)
                    INNER JOIN mnt_consultorio                      t04 ON (t04.id = t01.id_consultorio)
                    INNER JOIN cit_estado_distribucion              t05 ON (t05.id = t01.id_estado_distribucion)
                    INNER JOIN ctl_atencion                         t06 ON (t06.id = t03.id_atencion)
                    INNER JOIN mnt_rangohora                        t07 ON (t07.id = t01.id_rangohora)
                	LEFT  JOIN cit_tipo_distribucion                t08 ON (t08.id = t01.id_tipo_distribucion)
                    INNER JOIN mnt_area_mod_estab                   t09 ON (t09.id = t03.id_area_mod_estab)
                	INNER JOIN ctl_area_atencion                    t10 ON (t10.id = t09.id_area_atencion)
                	LEFT  JOIN mnt_servicio_externo_establecimiento t11 ON (t11.id = t09.id_servicio_externo_estab)
                	INNER JOIN mnt_modalidad_establecimiento        t12 ON (t12.id = t09.id_modalidad_estab)
                	INNER JOIN ctl_modalidad                        t13 ON (t13.id = t12.id_modalidad)
                	LEFT  JOIN mnt_servicio_externo                 t14 ON (T14.id = t11.id_servicio_externo)
                WHERE TRUE $whereEstadoDistribucion $whereAnio $whereMes $whereDiaSemana $whereTipoDistribucion
                ORDER BY t01.yrs ASC, t01.mes ASC, t01.dia ASC,t07.hora_ini ASC,t07.hora_fin ASC";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $resultados = $stm->fetchAll();

        foreach ($resultados as $value) {
            if($anio != $value['yrs']){
                $anio                = $value['yrs'];
                $distribucion[$anio] = array('anio'=>$anio);
                $mes                 = '';
                $dia                 = '';
                $rangoHora           = '';
            }
            if($mes != $value['mes']){
                $mes    = $value['mes'];
                $nombre = $mes === 1 ? 'Enero' : ( $mes === 2 ? 'Febrero' : ( $mes === 3 ? 'Marzo' : ( $mes === 4 ? 'Abril' : ( $mes === 5 ? 'Mayo' : ( $mes === 6 ? 'Junio' : ( $mes === 7 ? 'Julio' : ( $mes === 8 ? 'Agosto' : ( $mes === 9 ? 'Septiembre' : ( $mes === 10 ? 'Octubre' : ( $mes === 11 ? 'Noviembre' : ( $mes === 12 ? 'Diciembre' : '' ) ) ) ) ) ) ) ) ) ) );
                $distribucion[$anio]['meses'][$mes] = array('mes'=>$mes,'nombre'=>$nombre);
            }
            if($dia != $value['dia']){
                $dia = $value['dia'];
                $nombreDia = $dia === 1 ? 'Lunes' : ( $dia === 2 ? 'Martes' : ( $dia === 3 ? 'Miércoles' : ( $dia === 4 ? 'Jueves' : ( $dia === 5 ? 'Viernes' : ( $dia === 6 ? 'Sábado' : ( $dia === 7 ? 'Domingo' : '' ) ) ) ) ) );
                $distribucion[$anio]['meses'][$mes]['dias'][$dia] = array('dia'=>$dia,'nombre'=>$nombreDia);
            }

            $rangoHora = $value['rango_hora'];

            $distribucion[$anio]['meses'][$mes]['dias'][$dia]['horarios'][$rangoHora] = array(
                'id'           => $value['id_rangohora'],
                'horaIni'      => $value['hora_ini'],
                'horaFin'      => $value['hora_fin'],
                'rangoHora'    => $rangoHora,
                'distribucion' => array(
                    'id'                  => $value['id_distribucion'],
                    'idEmpleado'          => $value['id_empleado'],
                    'nombreEmpleado'      => $value['nombreempleado'],
                    'idAreaModEstab'      => $value['id_area_mod_estab'],
                    'nombreAreaModEstab'  => $value['nombre_area_atencion'],
                    'idEstado'            => $value['id_estado_distribucion'],
                    'nombreEstado'        => $value['nombre_estado'],
                    'totalCapacidad'      => $value['primera']+ $value['subsecuente'],
                    'totalCapacidadConAg' => $value['primera']+ $value['subsecuente']+$value['max_citas_agregadas'],
                    'distribucionMedica'  => array(
                        'idConsultorio'          => $value['id_consultorio'],
                        'nombreConsultorio'      => $value['nombre_consultorio'],
                        'idEspecialidad'         => $value['id_aten_area_mod_estab'],
                        'nombreEspecialidad'     => $value['nombre_especialidad'],
                        'idTipoDistribucion'     => $value['id_tipo_distribucion'],
                        'nombreTipoDistribucion' => $value['nombre_tipo_distribucion'],
                        'capacidadPv'            => $value['primera'],
                        'capacidadSb'            => $value['subsecuente'],
                        'capacidadAg'            => $value['max_citas_agregadas'],
                    )
                ),
            );
        } //FIN DEL FOREACH

        return $distribucion;
    }

    protected function crearArrayCuposDisponibles($origenCita, $idTipoCita, $codigoTipoCita, $horario, $keyHorario, $fecha, $cargaCitas,$excluirTipoCita) {
        $distribucionMedica        = array();
        $distribucionProcedimiento = array();

        $capacidadPv = $origenCita === 1 ? intval($horario['distribucion']['distribucionMedica']['capacidadPv'])      : NULL;
        $capacidadSb = $origenCita === 1 ? intval($horario['distribucion']['distribucionMedica']['capacidadSb'])      : NULL;
        $capacidadPr = $origenCita === 2 ? intval($horario['distribucion']['distribucionProcedimiento']['capacidad']) : NULL;
        $capacidadAg = $origenCita === 1 ? intval($horario['distribucion']['distribucionMedica']['capacidadAg'])      : intval($horario['distribucion']['distribucionProcedimiento']['capacidadAg']);

        $cargaPv = $origenCita === 1 ? intval($cargaCitas[$fecha->format('d/m/Y')]['horarios'][$keyHorario]['pvAsignado']) : NULL;
        $cargaSb = $origenCita === 1 ? intval($cargaCitas[$fecha->format('d/m/Y')]['horarios'][$keyHorario]['sbAsignado']) : NULL;
        $cargaPr = $origenCita === 2 ? intval($cargaCitas[$fecha->format('d/m/Y')]['horarios'][$keyHorario]['prAsignado'])   : NULL;
        $cargaAg = intval($cargaCitas[$fecha->format('d/m/Y')]['horarios'][$keyHorario]['agAsignado']);


        if( $origenCita === 1 ) {
            $distribucionMedica = array(
                'idConsultorio'          => $horario['distribucion']['distribucionMedica']['idConsultorio'],
                'nombreConsultorio'      => $horario['distribucion']['distribucionMedica']['nombreConsultorio'],
                'idTipoDistribucion'     => $horario['distribucion']['distribucionMedica']['idTipoDistribucion'],
                'nombreTipoDistribucion' => $horario['distribucion']['distribucionMedica']['nombreTipoDistribucion']
            );
        } else {
            $distribucionProcedimiento = array(
                'nombreProcedimiento'            => $horario['distribucion']['distribucionProcedimiento']['nombreProcedimiento'],
                'idProcedimientoEstablecimiento' => $horario['distribucion']['distribucionProcedimiento']['idProcedimientoEstablecimiento'],
                'idProcedimiento' => $horario['distribucion']['distribucionProcedimiento']['idProcedimiento'],
                'tiempoLectura' => $horario['distribucion']['distribucionProcedimiento']['tiempoLectura'],
                'idTipoDistribucion'     => $horario['distribucion']['distribucionProcedimiento']['idTipoDistribucion'],
                'nombreTipoDistribucion' => $horario['distribucion']['distribucionProcedimiento']['nombreTipoDistribucion']
            );
        }

        if($excluirTipoCita){
           $disponible=($capacidadPv+$capacidadSb)-($cargaPv+$cargaSb);
        }else{
            $disponible   = ${ 'capacidad'.$codigoTipoCita } - ${ 'carga'.$codigoTipoCita };
        }

        $disponibleAg = $capacidadAg - $cargaAg;

        $nombreTipoCita   = $origenCita === 1 ? ( $idTipoCita === 1 ? 'Primera Vez' : 'Subsecuente' ) : 'Ordinario';

        $cuposDisponibles = array(
            'fecha'                     => $fecha->format('d/m/Y'),
            'idDistribucion'            => $horario['distribucion']['id'],
            'idTipoCita'                => $idTipoCita,
            'nombreTipoCita'            => $nombreTipoCita,
            'idRangoHora'               => $horario['id'],
            'horaIni'                   => $horario['horaIni'],
            'horaFin'                   => $horario['horaFin'],
            'rangoHora'                 => $horario['rangoHora'],
            'disponible'                => $disponible<=0?0:$disponible,
            'disponibleAg'              => $disponibleAg,
            'idEmpleado'                => $horario['distribucion']['idEmpleado'],
            'nombreEmpleado'            => $horario['distribucion']['nombreEmpleado'],
            'distribucionMedica'        => $distribucionMedica,
            'distribucionProcedimiento' => $distribucionProcedimiento,
            'fechaObjeto'               => $fecha->setTime(0,0,0)
        );

        return $cuposDisponibles;
    }

    /*  insertarCita
     *      Función que permite insertar una cita Medica, segun los parametros proporcionados
     *
     *  Parametros:                     | Requerido | Valor por Defecto | Posibles Valores      | Descripcion
     *  --------------------------------+-----------+-------------------+-----------------------+------------
     *      idEmpleado                  | Si        | -                 | INTEGER               | id del Médico
     *      idExpediente                | Si        | -                 | INTEGER               | id del Expediente
     *      idEspecialidad              | Si        | -                 | INTEGER               | id de la Especialidad en que se desea insertar la Cita
     *      fecha                       | Si        | -                 | STRING  | DATETIME    | Fecha en que se insertará la cita
     *      idRangoHora                 | Si        | -                 | INTEGER               | id del Horario en que se ha de insertar la cita
     *      idTipoCita                  | Si        | -                 | INTEGER               | id del Tipo de Cita, Primera vez o Subsecuente
     *      idEstadoCita                | Si        | -                 | INTEGER               | id del Estado con el que se insertara la cita
     *      idDistribucion              | No        | NULL              | INTEGER | NULL        | id de la Distribucion a insertar
     *      idJustificacion             | No        | NULL              | INTEGER | NULL        | id del Motivo de justificacion por el cual se esta ingresando la cita ( para el caso de agregados, y reprogramados)
     *      idEstablecimiento           | No        | NULL              | INTEGER | NULL        | id del Establecimiento al que se le desea insertar la cita, si este parámetro no esta definido se tomará el id del establecimiento configurado
     *      idEstablecimientoReferencia | No        | NULL              | INTEGER | NULL        | id del Establecimiento de referencia
     *      numeroExpedienteReferencia  | No        | NULL              | STRIGN  | NULL        | Número de expediente de donde viene referido
     *      inputFormat                 | No        | 'd/m/Y'           | STRING                | Formato en que se esta dando las fechas para ser convertidas a DateTime, para el caso que se envie como string
     */
    public function insertarCita($idEmpleado, $idExpediente, $idEspecialidad, $fecha, $idRangoHora, $idTipoCita, $idEstadoCita,  $idDistribucion = NULL, $idJustificacion = NULL, $idEstablecimiento = NULL, $idEstablecimientoReferencia = NULL, $numeroExpedienteReferencia=NULL,$inputFormat = 'd/m/Y') {
        $em                = $this->container->get('doctrine')->getManager();
        $now               = new \DateTime();
        $user              = $this->container->get('security.context')->getToken()->getUser();
        $idEmpleado        = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneById($idEmpleado);
        $idExpediente      = $em->getRepository('MinsalSiapsBundle:MntExpediente')->findOneById($idExpediente);
        $idEspecialidad    = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($idEspecialidad);
        $fecha             = gettype($fecha) === 'string' ? \DateTime::createFromFormat($inputFormat, $fecha) : $fecha;
        $idRangoHora       = $em->getRepository('MinsalSiapsBundle:MntRangohora')->findOneById($idRangoHora);
        $idTipoCita        = $em->getRepository('MinsalCitasBundle:CitTipocita')->findOneById($idTipoCita);
        $idEstadoCita      = $em->getRepository('MinsalCitasBundle:CitEstadoCita')->findOneById($idEstadoCita); // id del Estado Reprogramada
        $idJustificacion   = $idJustificacion ? $em->getRepository('MinsalCitasBundle:CitJustificacion')->findOneById($idJustificacion) : NULL;
        $idAreaModEstab    = $idEspecialidad->getIdAreaModEstab();
        $ipCita            = $this->container->get('request')->server->get('REMOTE_ADDR');
        $idEstablecimiento = $idEstablecimiento ? $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneById($idEstablecimiento) : $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneByConfigurado(true);
        $idEstablecimientoReferencia = $idEstablecimientoReferencia ? $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneById($idEstablecimientoReferencia) : NULL;
        $idDistribucion    = $idDistribucion ? $em->getRepository('MinsalCitasBundle:CitDistribucion')->findOneById($idDistribucion) : $em->getRepository('MinsalCitasBundle:CitDistribucion')->findOneBy(array('idRangohora' => $idRangoHora->getId(), 'idEmpleado' => $idEmpleado->getId(), 'yrs' => date('Y',$fecha->getTimestamp()), 'mes' => date('n',$fecha->getTimestamp()), 'dia' => date('w',$fecha->getTimestamp()), 'idAtenAreaModEstab' => $idEspecialidad->getId(), 'idAreaModEstab' => $idAreaModEstab->getId(), 'idEstadoDistribucion' => true));

        $cita           = array('estado' => FALSE );
        $insertarCita   = TRUE;

        $datosCita      = $this->getRangoCitasInfo($idEmpleado->getId(), $idEspecialidad->getId(), $fecha->format('d/m/Y'), $fecha->format('d/m/Y'), false, 'true', false);

        $codigoTipoCita = $idEstadoCita->getId() !== 6 ? ( $idTipoCita->getId() === 1 ? 'pv' : 'sb' ) : 'ag' ;
        $horarios       = $datosCita[$fecha->format('d/m/Y')]['horarios'];
        $horarioKey     = $idRangoHora->getFormatterRangHora();

        if( count($horarios) > 0 && array_key_exists($horarioKey, $horarios) ) {
            $capacidad      = $datosCita[$fecha->format('d/m/Y')]['horarios'][$idRangoHora->getFormatterRangHora()][$codigoTipoCita.'Capacidad'];
            $asignados      = $datosCita[$fecha->format('d/m/Y')]['horarios'][$idRangoHora->getFormatterRangHora()][$codigoTipoCita.'Asignado'];

            if( ( intval($capacidad) - intval($asignados) ) > 0 ) {
                $insertarCita = TRUE;
            } else {
                $insertarCita = FALSE;
                $cita['detalleError'] = 'La cita no fue insertada debido a que ya no existe cupo disponible. Detalles: '.$codigoTipoCita.'Capacidad: '.$capacidad.
                    ', '.$codigoTipoCita.'Asigandos: '.$asignados;
            }
        } else {
            $insertarCita = FALSE;
            $cita['detalleError'] = 'Error en los parámetros proporcionados, el horario '.$horarioKey.' no ha sido encontrado con los siguientes parámetros: '.
                'idEmpleado: '.$idEmpleado->getId().', idExpediente: '.$idExpediente->getId().', idEspecialidad: '.$idEspecialidad->getId().', fecha: '.$fecha->format('d/m/Y').
                ', idRangoHora: '.$idRangoHora->getId().', idTipoCita: '.$idTipoCita->getId().', idDistribucion: '.($idDistribucion ? $idDistribucion->getId() : 'NULL').
                ', idJustificacion: '.($idJustificacion ? $idJustificacion->getId() : 'NULL').', idEstablecimiento: '.($idEstablecimiento ? $idEstablecimiento->getId() : 'NULL').
                ', idEstablecimientoReferencia: '.($idEstablecimientoReferencia ? $idEstablecimientoReferencia->getId() : 'NULL').', inputFormat: '.$inputFormat;
        }

        if( $insertarCita ) {
            try {
                $citCitasDia = new CitCitasDia();

                $citCitasDia->setIdTipocita($idTipoCita);
                $citCitasDia->setIdAtenAreaModEstab($idEspecialidad);
                $citCitasDia->setIdEstado($idEstadoCita);
                $citCitasDia->setFecha($fecha);
                $citCitasDia->setIdusuarioreg($user);
                $citCitasDia->setfechahorareg($now);
                $citCitasDia->setIdJustificacion($idJustificacion);
                $citCitasDia->setIpcita($ipCita);
                $citCitasDia->setIdEmpleado($idEmpleado);
                $citCitasDia->setIdExpediente($idExpediente);
                $citCitasDia->setIdEstablecimiento($idEstablecimiento);
                $citCitasDia->setIdEstablecimientoReferencia($idEstablecimientoReferencia);
                $citCitasDia->setIdRangohora($idRangoHora);
                $citCitasDia->setIdAreaModEstab($idAreaModEstab);
                $citCitasDia->setIdDistribucion($idDistribucion);
                $citCitasDia->setNumeroExpedienteReferencia($numeroExpedienteReferencia);

                $em->persist($citCitasDia);
                $em->flush();

                $cita['estado'] = TRUE;
                $cita['idCita'] = $citCitasDia->getId();
            } catch(\Exception $e) {
                $cita['detalleError'] = $e->getTraceAsString();
            }
        }

        return $cita;
    }
}
