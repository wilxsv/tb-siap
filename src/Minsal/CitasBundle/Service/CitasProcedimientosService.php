<?php
namespace Minsal\CitasBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Minsal\CitasBundle\Entity\CitCitasProcedimientos;

class CitasProcedimientosService
{

    private $container = null;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    /*
     * DESCRIPCIÓN: Método que devuelve la cantidad de citas programadas, total de pacientes atendidos,
     *              rangos de hora de un determinado procedimiento
     * PARÁMETROS DE ENTRADA:
     *                  -idProcedimientoEstablecimiento=>id del procedimiento configurado en el establecimiento
     *                  -lowerLimit=>fecha inicial de comparación
     *                  -upperLimit=>fecha final de comparación
     *                  -idRangoHora=>No es obligatoria e indica el idRangoHora a buscar
     *                  -idEmpleado=>No es obligatoria e indica el idEmpleado a buscar
     * PARAMETROS DE ENVIO:
     *                  -result:array que posee algunos el detalle de lascitas de procedimiento programadas
     * ANALISTA PROGRAMADOR: Ing. Karen Peñate, Ing. Caleb Rodriguez
     */
    public function getConsolidadoCitCitasProcedimientos($idProcedimientoEstablecimiento,$lowerLimit, $upperLimit, $idRangoHora = NULL,$idEmpleado=NULL) {
        $em = $this->container->get('doctrine')->getManager();
        $selectRH       = '';
        $selectLOJRH    = '';
        $whereLOJRH     = '';
        $groupByLOJRH   = '';
        $leftJoin       = '';
        $whereEmpleado  = '';
        $totalCuposOrdinarios='COALESCE((SELECT sum(cupos)
                     FROM cit_distribucion_procedimiento
                     WHERE id_procedimiento_establecimiento=:idProcedimientoEstablecimiento
                            AND mes=EXTRACT(MONTH FROM t05.date)
                            AND dia=EXTRACT(DOW FROM t05.date)
                            AND yrs=EXTRACT(YEAR FROM t05.date)
                        ),0)';

        if($idRangoHora) {
            $selectRH = "t07.id AS id_rango_hora,
                         t07.hora_ini AS hora_inicial,
                         t07.hora_fin AS hora_final,";

            $selectLOJRH = "t04.id_rangohora,";

            $whereLOJRH  = "AND t04.id_rangohora = :idRangoHora";

            $groupByLOJRH = ", t04.id_rangohora";

            $leftJoin    = 'LEFT JOIN mnt_rangohora t07 ON (t07.id = t06.id_rangohora)';

            $totalCuposOrdinarios='COALESCE((SELECT sum(cupos)
                         FROM cit_distribucion_procedimiento
                         WHERE id_procedimiento_establecimiento=:idProcedimientoEstablecimiento
                                AND mes=EXTRACT(MONTH FROM t05.date)
                                AND dia=EXTRACT(DOW FROM t05.date)
                                AND yrs=EXTRACT(YEAR FROM t05.date)
                                AND id_rangohora = :idRangoHora),0)';
        }
        if($idEmpleado){
            $whereEmpleado="AND t04.id_empleado = :idEmpleado";
        }

        /*****************************************************************************************
         * SQL que determina la cantidad de citados,agregados, atendidos,dia de la semana y total de citas
         * para cada dia de un mes determinado por procedimiento y/o empleado
         ****************************************************************************************/
        $sql = "SELECT TO_CHAR(t05.date, 'YYYY/MM/DD') AS date,
                       $selectRH
                       COALESCE(t06.ordinarios,0) AS ordinarios,
                       COALESCE(t06.agregados,0) AS agregados,
                       COALESCE(t06.totalCitas,0) AS total_citas,
                       COALESCE(t06.atendidos,0) AS atendidos,
                       $totalCuposOrdinarios AS total_cupos ,
                       EXTRACT(DOW FROM t05.date) AS dia_semana
                FROM (
                      SELECT serie::date AS date
                      FROM generate_series ('$lowerLimit'::timestamp, '$upperLimit'::timestamp, '1 day'::interval) serie) t05
                LEFT OUTER JOIN (
                      SELECT DISTINCT t01.fecha as date,
                             $selectLOJRH
                             SUM((CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as ordinarios,
                             SUM(CASE WHEN t01.id_estado = 6 THEN 1 ELSE 0 END) as agregados,
                             COUNT(t01.id_estado) as totalCitas,
                             SUM((CASE WHEN t01.id_estado = 5 THEN 1 ELSE 0 END) + (CASE WHEN t01.id_estado = 7 THEN 1 ELSE 0 END)) atendidos
                      FROM cit_citas_procedimientos        t01
                      INNER JOIN mnt_expediente t02 ON (t01.id_expediente = t02.id)
                      INNER JOIN cit_distribucion_procedimiento t04 ON (t01.id_distribucion_procedimiento=t04.id
                          AND t04.id_procedimiento_establecimiento=:idProcedimientoEstablecimiento
                          $whereEmpleado)
                      WHERE t01.fecha >= date'$lowerLimit' AND t01.fecha<= '$upperLimit'
                            AND t01.id_estado NOT IN (3,9)
                            $whereLOJRH
                      GROUP BY t01.fecha $groupByLOJRH) t06 ON (t05.date = t06.date)
                      $leftJoin
                      ORDER BY date";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idProcedimientoEstablecimiento', $idProcedimientoEstablecimiento);

        if($idRangoHora) {
            $stm->bindValue(':idRangoHora', $idRangoHora);
        }
        if($idEmpleado){
            $stm->bindValue(':idEmpleado', $idEmpleado);
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
    *      idProcedimientoEstablecimiento  | Si        | -                 | INTEGER               | id del procedimiento configurado
    *      idEmpleado                      | No        | NULL              | INTEGER | NULL        | id del Médico; si es NULL indica que ese procedimiento no tiene empleado asociado
    *      anioInicial                     | No        | NULL              | INTEGER | NULL        | Año Inicial de la Busqueda; si es NULL no tiene límite de busqueda
    *      mesInicial                      | No        | NULL              | INTEGER | NULL        | Mes Inicial de la Busqueda; si es NULL no tiene límite de busqueda
    *      diaSemanaInicial                | No        | NULL              | INTEGER | NULL        | Dia de la Semana Inicial de la Busqueda; si es NULL no tiene límite de busqueda
    *      anioFinal                       | No        | NULL              | INTEGER | NULL        | Año Final de la Busqueda; si es NULL no tiene límite de busqueda
    *      mesFinal                        | No        | NULL              | INTEGER | NULL        | Mes Final de la Busqueda; si es NULL no tiene límite de busqueda
    *      diaSemanaFinal                  | No        | NULL              | INTEGER | NULL        | Dia de la Semana Final de la Busqueda; si es NULL no tiene límite de busqueda
    *      idTipoDistribucion              | No        | NULL              | INTEGER | NULL        | Tipo de distribucion especial del horario; si es NULL buscará donde el idTipoDistribucion es NULL
    *      buscarActivo                    | No        | TRUE              | BOOLEAN | NULL        | Bandera que permite buscar si la distribucion si se encuentra activa (true) o si esta cerrada (false), (NULL) para ambos estados
    *      obtenerTodosTipoDistribucion    | No        | FALSE             | BOOLEAN | NULL        | Bandera que permite mostrar todos los horarios habilitados para el procedimiento; si es TRUE buscará en todos, sino solo en el idTipoDistribucion enviado
    *
    * RETORNO:
    *       Array de distribuciones para el rango seleccionado.


    * ANALISTA PROGRAMADOR: Ing. Karen Peñate
    */
    public function obtenerRangoDistribucion($idProcedimientoEstablecimiento, $idEmpleado = NULL, $anioInicial = NULL, $mesInicial = NULL, $diaSemanaInicial = 1, $anioFinal = NULL, $mesFinal = NULL, $diaSemanaFinal = NULL, $idTipoDistribucion = NULL, $buscarActivo = TRUE, $obtenerTodosTipoDistribucion=FALSE) {
        $em   = $this->container->get('doctrine')->getManager();
        $anio ='';
        $mes  ='';
        $dia  ='';

        $rangoHora    = '';
        $fechaActual  = new \DateTime();
        $distribucion = array();
        $resultados   = array();

        $innerIdEmpleado = $idEmpleado ? " INNER JOIN mnt_empleado t05 ON (t01.id_empleado=t05.id AND t05.id= $idEmpleado)":' LEFT JOIN mnt_empleado t05 ON (t01.id_empleado=t05.id)';

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
                    $whereMes = " ( CASE WHEN t01.yrs = $anioInicial THEN t01.mes >= $mesInicial ELSE t01.mes >= 1 END ) AND ( CASE WHEN t01.yrs = $anioFinal THEN t01.mes <= $mesFinal ELSE t01.mes <= 12 END)";

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

        if($obtenerTodosTipoDistribucion){
            $whereTipoDistribucion = "";
        }else if($idTipoDistribucion) {
            $whereTipoDistribucion = " AND t01.id_tipo_distribucion = $idTipoDistribucion";
        }else{
            $whereTipoDistribucion = " AND t01.id_tipo_distribucion IS NULL";
        }

        $whereEstadoDistribucion = $buscarActivo === NULL ? '' : ( $buscarActivo ? ' AND t01.id_estado_distribucion = 1' : ' AND t01.id_estado_distribucion = 2' );

        $sql = "SELECT  t01.id as id_distribucion,
                    	t01.mes,
                    	t01.yrs,
                    	t01.dia,
                    	t01.cupos,
                    	t01.max_citas_agregadas,
                        t01.tiempo_lectura_dias,
                        t03.id as id_procedimiento,
                    	t04.id as id_rangohora,
                        t13.id as id_tipo_distribucion,
                        t13.nombre as nombre_tipo_distribucion,
                    	TO_CHAR(t04.hora_ini, 'HH12:MI:SS AM') AS hora_ini,
                            TO_CHAR(t04.hora_fin, 'HH12:MI:SS AM') AS hora_fin,
                            CONCAT(TO_CHAR(t04.hora_ini, 'HH12:MI:SS AM'),' - ',TO_CHAR(t04.hora_fin, 'HH12:MI:SS AM')) AS rango_hora,
                            initcap(t05.nombreempleado) as nombreempleado,
                            t05.id as id_empleado,
                            t06.id as id_area_mod_estab,
                            CASE
                    		WHEN t06.id_servicio_externo_estab IS NOT NULL THEN CONCAT_WS('-',t10.nombre,t07.nombre,t11.nombre)
                                    ELSE CONCAT_WS('-',t10.nombre,t07.nombre)
                             END as nombre_area_atencion,
                             t12.id as id_estado_distribucion,
                             t12.nombre as nombre_estado,
                             t02.id as id_procedimiento_establecimiento,
                             CONCAT_WS(' ',t03.codigo,'-',initcap(t03.procedimiento)) as nombre_procedimiento
               FROM cit_distribucion_procedimiento t01
                 	INNER JOIN mnt_procedimiento_establecimiento t02 ON (t01.id_procedimiento_establecimiento=t02.id AND t02.id=$idProcedimientoEstablecimiento)
                 	INNER JOIN mnt_ciq t03 ON (t03.id=t02.id_ciq)
                 	INNER JOIN mnt_rangohora t04 ON (t04.id=t01.id_rangohora)
                 	$innerIdEmpleado
                 	INNER JOIN mnt_area_mod_estab t06 ON (t06.id=t01.id_area_mod_estab)
                    INNER JOIN ctl_area_atencion t07 ON (t07.id=t06.id_area_atencion)
                    LEFT JOIN mnt_servicio_externo_establecimiento t08 ON (t08.id=t06.id_servicio_externo_estab)
                    INNER JOIN mnt_modalidad_establecimiento t09 ON (t09.id=t06.id_modalidad_estab)
                    INNER JOIN ctl_modalidad t10 ON (t10.id=t09.id_modalidad)
                    LEFT JOIN mnt_servicio_externo t11 ON (t11.id=t08.id_servicio_externo)
                    INNER JOIN cit_estado_distribucion t12 ON (t01.id_estado_distribucion=t12.id)
                    LEFT JOIN cit_tipo_distribucion t13 ON (t01.id_tipo_distribucion=t13.id)
                WHERE TRUE $whereEstadoDistribucion $whereAnio $whereMes $whereDiaSemana $whereTipoDistribucion
                ORDER BY t01.yrs ASC, t01.mes ASC, t01.dia ASC,t04.hora_ini ASC,t04.hora_fin ASC";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $resultados = $stm->fetchAll();

        foreach ($resultados as $value) {
            if($anio != $value['yrs']){
                $anio=$value['yrs'];
                $distribucion[$anio]=array('anio'=>$anio);
                $mes='';
                $dia='';
                $rangoHora='';
            }
            if($mes != $value['mes']){
                $mes = $value['mes'];
                $nombre= $mes === 1 ? 'Enero' : ( $mes === 2 ? 'Febrero' : ( $mes === 3 ? 'Marzo' : ( $mes === 4 ? 'Abril' : ( $mes === 5 ? 'Mayo' : ( $mes === 6 ? 'Junio' : ( $mes === 7 ? 'Julio' : ( $mes === 8 ? 'Agosto' : ( $mes === 9 ? 'Septiembre' : ( $mes === 10 ? 'Octubre' : ( $mes === 11 ? 'Noviembre' : ( $mes === 12 ? 'Diciembre' : '' ) ) ) ) ) ) ) ) ) ) );
                $distribucion[$anio]['meses'][$mes]=array('mes'=>$mes,'nombre'=>$nombre);
            }
            if($dia != $value['dia']){
                $dia = $value['dia'];
                $nombreDia=$dia === 1 ? 'Lunes' : ( $dia === 2 ? 'Martes' : ( $dia === 3 ? 'Miércoles' : ( $dia === 4 ? 'Jueves' : ( $dia === 5 ? 'Viernes' : ( $dia === 6 ? 'Sábado' : ( $dia === 7 ? 'Domingo' : '' ) ) ) ) ) );
                $distribucion[$anio]['meses'][$mes]['dias'][$dia]=
                        array('dia'=>$dia,'nombre'=>$nombreDia);
            }

            $rangoHora=$value['rango_hora'];

            $distribucion[$anio]['meses'][$mes]['dias'][$dia]['horarios'][$rangoHora]
                    =array( 'id'=>$value['id_rangohora'],
                            'horaIni'=>$value['hora_ini'],
                            'horaFin'=>$value['hora_fin'],
                            'rangoHora'=>$rangoHora,
                            'distribucion'=>array(  'id'=>$value['id_distribucion'],
                                                    'idEmpleado'=>$value['id_empleado'],
                                                    'nombreEmpleado'=>$value['nombreempleado'],
                                                    'idAreaModEstab'=>$value['id_area_mod_estab'],
                                                    'nombreAreaModEstab'=>$value['nombre_area_atencion'],
                                                    'idEstado'=>$value['id_estado_distribucion'],
                                                    'nombreEstado'=>$value['nombre_estado'],
                                                    'totalCapacidad'         => $value['cupos'],
                                                    'totalCapacidadConAg'    => $value['cupos']+$value['max_citas_agregadas'],
                                                    'distribucionProcedimiento' => array(
                                                                                    'capacidad' => $value['cupos'],
                                                                                    'capacidadAg' => $value['max_citas_agregadas'],
                                                                                    'idProcedimientoEstablecimiento' => $value['id_procedimiento_establecimiento'],
                                                                                    'nombreProcedimiento'=>$value['nombre_procedimiento'],
                                                                                    'tiempoLectura'=>$value['tiempo_lectura_dias'],
                                                                                    'idProcedimiento'=>$value['id_procedimiento'],
                                                                                    'idTipoDistribucion'     => $value['id_tipo_distribucion'],
                                                                                    'nombreTipoDistribucion' => $value['nombre_tipo_distribucion']
                                                                                 )
                                                 ),
                        );
        }//FIN DEL FOREACH
        return $distribucion;
    }

    /*
    * NOMBRE: getEventos
    * DESCRIPCIÓN:  Método que permite obtener los eventos de un procedimiento que tenga o no tenga asociados
                    un empleado que hayan sido configurados para un rango de fecha.
    * PARÁMETROS DE ENTRADA:
    *
    *  Parametros:                         | Requerido | Valor por Defecto | Posibles Valores      | Descripcion
    *  ------------------------------------+-----------+-------------------+-----------------------+------------
    *      idProcedimientoEstablecimiento  | Si        | -                 | INTEGER               | Id del Procedimiento Establecimiento
    *      lowerLimit                      | Si        | -                 | DATE                  | Fecha y hora de Inicio
    *      upperLimit                      | No        | NULL              | DATE | NULL           | Fecha y hora de Finalización; Si el valor es NULL tomará el valor de fechaHoraIni
    *      idEmpleado                      | No        | NULL              | INTEGER |NULL         | Id del Médico
    *      inputFormat                     | No        | 'd/m/Y'           | STRING                | Formato de entrada de las fechas enviadas
    *
    * RETORNO:
    *       Array que contiene el detalle de los eventos
    *
    * ANALISTA PROGRAMADOR: Ing. Caleb Rodriguez.
    *       MODIFICADO POR: Ing. Karen Peñate
    */

    public function getEventos($idProcedimientoEstablecimiento, $lowerLimit, $upperLimit = NULL,$idEmpleado = NULL, $inputFormat = 'd/m/Y', $outputFormat = 'dd/mm/yyyy', $checkEmpleadoNull = TRUE) {
        $em         = $this->container->get('doctrine')->getManager();
        $lowerLimit = \DateTime::createFromFormat($inputFormat,$lowerLimit);
        $upperLimit    = $upperLimit ? \DateTime::createFromFormat( $inputFormat,$upperLimit) : $lowerLimit;
        $lowerLimit    = $lowerLimit->format('Y-m-d');
        $upperLimit    = $upperLimit->format('Y-m-d');
        $whereEmpleado = '';
        $whereEmpleadoNull = '';


        if(!is_null($idEmpleado)) {
            $whereEmpleado=" OR (id_procedimiento_establecimiento=:idProcedimientoEstablecimiento AND id_empleado=$idEmpleado)";
        }

        if($checkEmpleadoNull) {
            $whereEmpleadoNull=" AND id_empleado IS NULL";
        }

        /*****************************************************************************************
         * SQL que determina los eventos que un empleado tiene para un mes en especifico, asi como
         * tambien las fechas festivas o no laborables
         ****************************************************************************************/
        $sql = " SELECT to_char(t01.date,'$outputFormat') as fecha,
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
                          WHERE ((((id_procedimiento_establecimiento =:idProcedimientoEstablecimiento OR id_procedimiento_establecimiento IS NULL) $whereEmpleadoNull)
                                $whereEmpleado)
                                AND id_modulo=4 AND es_evento_medico = FALSE)
                            )
                      AS t02 ON (t01.date BETWEEN date(t02.fecha_hora_ini) AND date(t02.fecha_hora_fin))
                ORDER BY date ASC";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idProcedimientoEstablecimiento', $idProcedimientoEstablecimiento);
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
                $bloqueoParcialDia = false;
                $bloqueoTotalDia   = false;
                $cantidadHoras     = 0;
                $eventos[$fecha]['horarios'] = array();
            }

            $horaIni=$value['hora_ini'];
            $horaFin=$value['hora_fin'];
            $rangoHora=$horaIni.' - '.$horaFin;

            $idTipoEventoDia     = 0;
            $nombreTipoEventoDia = 'N/A';

            if($rangoHora==' - ') {
                $eventos[$fecha]['horarios'] =array();
                $bloqueoParcialDia = false;
                $bloqueoTotalDia   = false;
            } else {
                $a = new \DateTime($horaIni);
                $b = new \DateTime($horaFin);
                $interval = $a->diff($b);
                $cantidadHoras = $cantidadHoras+$interval->format("%H");
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

    public function getDistribucionProcedimiento($idAreaModEstab, $idProcedimientoEstab, $lowerLimit, $upperLimit, $idEmpleado = NULL, $inputFormat = 'd/m/Y', $outputFormat= 'dd/mm/yyyy') {
        $em             = $this->container->get('doctrine')->getManager();
        $idAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAreaModEstab')->findOneById($idAreaModEstab)->getId();
        $lowerLimit     = \DateTime::createFromFormat($inputFormat,$lowerLimit);
        $upperLimit     = \DateTime::createFromFormat($inputFormat,$upperLimit);
        $lowerLimit     = $lowerLimit->format('Y-m-d');
        $upperLimit     = $upperLimit->format('Y-m-d');
        $whereEmpleado  = '';

        if(!is_null($idEmpleado)) {
            $whereEmpleado = " AND id_empleado = $idEmpleado";
        }

        /*****************************************************************************************
         * SQL que determina la distribucion de un médico, para un mes especifico
         ****************************************************************************************/
        $sql = "SELECT TO_CHAR(t01.date, '$outputFormat') AS date,
                       COALESCE(t02.distribucion, 0) AS distribucion
                FROM (
                      SELECT serie::date AS date, EXTRACT(DOW FROM serie) AS DOW
                      FROM generate_series ('$lowerLimit'::timestamp, '$upperLimit'::timestamp, '1 day'::interval) serie) t01
                LEFT OUTER JOIN (
                      SELECT yrs, mes, dia, COUNT(*) AS distribucion
                      FROM cit_distribucion_procedimiento
                      WHERE id_area_mod_estab = :idAreaModEstab
                            AND id_procedimiento_establecimiento = :idProcedimientoEstablecimiento
                            $whereEmpleado
                      GROUP BY yrs, mes, dia) t02 ON (t02.yrs = EXTRACT(YEAR FROM t01.date::timestamp)
                                  AND t02.mes = EXTRACT(MONTH FROM t01.date::timestamp)
                                  AND t02.dia = EXTRACT(DOW FROM t01.date::timestamp)) ORDER BY date";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idAreaModEstab', $idAreaModEstab);
        $stm->bindValue(':idProcedimientoEstablecimiento', $idProcedimientoEstab);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result;
    }

    /*
    * NOMBRE: verificarEvento
    * DESCRIPCIÓN:  Método que verifica si procedimiento posee o no un evento en una determinada fecha en un
    *               rango de hora en específico.
    * PARÁMETROS DE ENTRADA:
    *
    *  Parametros:                         | Requerido | Valor por Defecto | Posibles Valores      | Descripcion
    *  ------------------------------------+-----------+-------------------+-----------------------+------------
    *      idProcedimientoEstablecimiento  | Si        | -                 | INTEGER               | Id del Procedimiento Establecimiento
    *      fecha                           | Si        | -                 | DATE                  | Fecha
    *      idEmpleado                      | No        | NULL              | INTEGER |NULL         | Id del Médico
    *      hora                            | No        | ' 12:00:00 AM'    | STRING                | Hora de inicio para la busqueda; Si no es enviada tomará la media noche
    *      inputFormatDate                 | No        | 'd/m/Y'           | STRING                | Formato de entrada de las fechas enviadas
    *      inputFormatTime                 | No        | 'h:i:s A'         | STRING                | Formato de entrada de las horas enviadas
    *
    * RETORNO:
    *       Array del id del evento que tiene el médico en la fecha y hora indicada
    *
    *
    * ANALISTA PROGRAMADOR: Ing. Caleb Rodriguez.
    *       MODIFICADO POR: Ing. Karen Peñate
    */
    public function verificarEvento($idProcedimientoEstablecimiento, $fecha,$idEmpleado,$hora=' 12:00:00 AM',$inputFormatDate='d/m/Y',$inputFormatTime=' h:i:s A') {
        $em = $this->container->get('doctrine')->getManager();

        $fechaBusqueda=\DateTime::createFromFormat($inputFormatDate.$inputFormatTime, $fecha.$hora);
        $whereEmpleado='';
        if(!is_null($idEmpleado)){
            $whereEmpleado=" OR (id_procedimiento_establecimiento=:idProcedimientoEstablecimiento AND id_empleado=$idEmpleado)";
        }

        /*****************************************************************************************
         * SQL que verifica que el medico no tenga evento en la hora seleccionada
         *****************************************************************************************/

        $sql = "SELECT t01.id
                FROM mnt_evento t01
                WHERE (((id_procedimiento_establecimiento =:idProcedimientoEstablecimiento OR id_procedimiento_establecimiento IS NULL) AND id_empleado IS NULL)
                      $whereEmpleado)
                      AND id_modulo=4 AND es_evento_medico = FALSE
                      AND '". $fechaBusqueda->format('d/m/Y h:i:s A')."'::timestamp BETWEEN t01.fecha_hora_ini AND t01.fecha_hora_fin";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idProcedimientoEstablecimiento', $idProcedimientoEstablecimiento);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result;
    }

    /*  getRangoCitasInfo
     *      Función que permite obtener los datos referente a citas como son la capacidad de citas, las citas asignadas,
     *      cantidad de distribucion, el evento, para un rango de fechas dados
     *
     *  Parametros:             | Requerido | Valor por Defecto | Posibles Valores   | Descripcion
     *  ------------------------+-----------+-------------------+--------------------+------------
     *      idEmpleado          | Si        | -                 | INTEGER            | id del Empleado (Médico) del cual se buscaran las citas
     *      idProcedimiento     | Si        | -                 | INTEGER            | id de la Procedimiento asociadas a las citas
     *      idAreaModEstab      | Si        | -                 | INTEGER            | id del AreaModEstab con el que esta configurado la distribucion del procedimiento
     *      lowerLimit          | Si        | -                 | STRING             | fecha Inicial de la busqueda
     *      upperLimit          | Si        | -                 | STRING             | fecha Final de la busqueda
     *      weekday             | No        | false             | BOOLEAN | NULL     | Booleano que permite definir si se tomaran encuenta los dias que son fines de semana
     *      showHorarioReal     | No        | 'true'            | STRING  | NULL     | Bandera que permite definir si se muestra un horario escalonado para un rango de hora o se muestra el horario real
     *      mostrarDetalleCitas | No        | true              | BOOLEAN | NULL     | Bandera que permite limitar si el detalle de las citas se muestran o no
     *      outputKeyFormat     | No        | 'd/m/Y'           | STRING  | NULL     | formato de los datos de salida para las fechas
     */
    public function getRangoCitasInfo($idProcedimiento, $idAreaModEstab, $idEmpleado, $lowerLimit, $upperLimit, $weekday = false, $showHorarioReal = 'true', $mostrarDetalleCitas = true, $outputKeyFormat = 'd/m/Y') {
        $em             = $this->container->get('doctrine')->getManager();
        $lowerLimit     = \DateTime::createFromFormat('d/m/Y', $lowerLimit);
        $lowerLimit     = $lowerLimit->format('Y-m-d');
        $upperLimit     = \DateTime::createFromFormat('d/m/Y', $upperLimit);
        $upperLimit     = $upperLimit->format('Y-m-d');
        $diaWhere       = '';

        $selectDetalleCita   = '';
        $leftJoinDetalleCita = '';

        if($weekday === false) {
            $diaWhere = "WHERE EXTRACT(DOW FROM serie::timestamp) NOT IN (0,6)";
        }

        $whereIdEmpleado = $idEmpleado === NULL ? 'IS NULL' : '= '.$idEmpleado;
        $whereEventoEmpleado=$idEmpleado===NULL?'':" OR (t03.id_ciq=:idProcedimiento AND id_empleado=$idEmpleado)";

        if($mostrarDetalleCitas) {
            $selectDetalleCita =
                ",
                tx04.id AS id_cita,
                tx04.id_expediente,
                tx04.numero_expediente,
                tx04.nombre_paciente,
                tx04.id_estado,
                tx04.nombre_estado,
                tx04.nombre_tipo_cita";

            $leftJoinDetalleCita =
                "LEFT JOIN (
                    SELECT t01.fecha AS date,
                           t06.id AS id_rango_hora,
                           t01.id,
                           t01.id_expediente,
                           t02.numero AS numero_expediente,
                           CONCAT( CONCAT( CONCAT_WS(' ',t03.primer_apellido, t03.segundo_apellido, t03.apellido_casada), ', ' ), CONCAT_WS(' ',t03.primer_nombre, t03.segundo_nombre, t03.tercer_nombre) ) AS nombre_paciente,
                           t01.id_estado,
                           t04.estado AS nombre_estado,
                           CASE WHEN t01.id_justificacion IS NOT NULL
                                THEN 'Agregado'
                                ELSE 'Ordinario'
                           END AS nombre_tipo_cita
                    FROM cit_citas_procedimientos                t01
                    INNER JOIN mnt_expediente                    t02 ON (t02.id = t01.id_expediente)
                    INNER JOIN mnt_paciente                      t03 ON (t03.id = t02.id_paciente)
                    INNER JOIN cit_estado_cita                   t04 ON (t04.id = t01.id_estado)
                    INNER JOIN cit_distribucion_procedimiento    t05 ON (t05.id = t01.id_distribucion_procedimiento)
                    INNER JOIN mnt_rangohora                     t06 ON (t06.id = t05.id_rangohora)
                    INNER JOIN mnt_procedimiento_establecimiento t07 ON (t07.id = t05.id_procedimiento_establecimiento)
                    WHERE t01.fecha BETWEEN '$lowerLimit' AND '$upperLimit'
                        AND t05.id_empleado $whereIdEmpleado
                        AND t05.id_area_mod_estab = :idAreaModEstab
                        AND t07.id_ciq = :idProcedimiento
                        AND t04.id NOT IN (3,9)
                ) tx04 ON (tx01.date = tx04.date AND tx01.id_rango_hora = tx04.id_rango_hora)";
        }

        /*****************************************************************************************
         * SQL que determina el detalle de la cita para un rango de fecha determinado
         ****************************************************************************************/
        $sql = "WITH rango_fecha AS (
                    SELECT serie::date AS date
                    FROM generate_series ('$lowerLimit'::timestamp, '$upperLimit'::timestamp, '1 day'::interval) serie $diaWhere
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
                       tx01.id_rango_hora,
                       tx01.hora_ini,
                       tx01.hora_fin,
                       COALESCE(tx03.capacidad, 0) AS capacidad,
                       COALESCE(tx02.asignados,0) AS asignado,
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
                           ti04.id AS id_rango_hora,
                           ti04.hora_ini AS hora_ini,
                           ti04.hora_fin AS hora_fin,
                           to_timestamp(ti02.date || ' ' || ti04.hora_ini, 'YYYY-MM-DD HH24:MI:SS AM') AS timestamp_ini,
                           to_timestamp(ti02.date || ' ' || ti04.hora_fin, 'YYYY-MM-DD HH24:MI:SS AM') AS timestamp_fin,
                           COALESCE(ti01.residente, false) = true
                    FROM mnt_empleado ti01,
                         rango_fecha ti02
                    LEFT JOIN (
                        SELECT tt01.yrs,
                               tt01.mes,
                               tt01.dia,
                               COUNT(*) AS distribucion
                        FROM  cit_distribucion_procedimiento         tt01
                        INNER JOIN mnt_procedimiento_establecimiento tt02 ON (tt02.id = tt01.id_procedimiento_establecimiento)
                        WHERE tt01.id_empleado $whereIdEmpleado
                              AND tt01.id_area_mod_estab = :idAreaModEstab
                              AND tt02.id_ciq = :idProcedimiento
                        GROUP BY yrs, mes, dia
                    ) ti03 ON (ti03.yrs = EXTRACT(YEAR FROM ti02.date::timestamp) AND ti03.mes = EXTRACT(MONTH FROM ti02.date::timestamp) AND ti03.dia = EXTRACT(DOW FROM ti02.date::timestamp))
                    -- Horario de la Distribucion
                    LEFT JOIN (
                        SELECT t02.id,
                               TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM') AS hora_ini,
                               TO_CHAR(t02.hora_fin, 'HH12:MI:SS AM') AS hora_fin,
                               CONCAT(TO_CHAR(t02.hora_ini, 'HH12:MI:SS AM'),' - ',TO_CHAR(t02.hora_fin, 'HH12:MI:SS AM')) AS rango_hora,
                               t01.id AS id_distribucion,
                               t01.dia,
                               t01.mes,
                               t01.yrs
                        FROM cit_distribucion_procedimiento          t01
                        INNER JOIN mnt_rangohora                     t02 ON (t02.id = t01.id_rangohora)
                        INNER JOIN mnt_procedimiento_establecimiento t03 ON (t03.id = t01.id_procedimiento_establecimiento)
                        WHERE t01.id_empleado $whereIdEmpleado
                              AND t01.id_area_mod_estab = :idAreaModEstab
                              AND t03.id_ciq = :idProcedimiento
                    ) ti04 ON (ti04.yrs = EXTRACT(YEAR FROM ti02.date::timestamp) AND ti04.mes = EXTRACT(MONTH FROM ti02.date::timestamp) AND ti04.dia = EXTRACT(DOW FROM ti02.date::timestamp))
                ) tx01
                -- Citas Asignadas
                LEFT JOIN (
                    SELECT DISTINCT t01.fecha AS date,
                        t02.id_rangohora,
                        SUM(CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END) AS asignados,
                        SUM(CASE WHEN t01.id_estado = 6 THEN 1 ELSE 0 END) AS agregados,
                        COUNT(*) AS total_citas
                    FROM cit_citas_procedimientos                t01
                    INNER JOIN cit_distribucion_procedimiento    t02 ON (t02.id = t01.id_distribucion_procedimiento)
                    INNER JOIN mnt_procedimiento_establecimiento t03 ON (t03.id = t02.id_procedimiento_establecimiento)
                    WHERE t01.fecha BETWEEN '$lowerLimit' AND '$upperLimit'
                        AND t02.id_empleado $whereIdEmpleado
                        AND t02.id_area_mod_estab = :idAreaModEstab
                        AND t03.id_ciq = :idProcedimiento
                        AND t01.id_estado NOT IN (3,9)
                    GROUP BY t01.fecha, t02.id_rangohora
                ) tx02 ON (tx01.date = tx02.date AND tx01.id_rango_hora = tx02.id_rangohora)
                -- Capacidad de citas
                LEFT JOIN (
                    SELECT t01.yrs,
                           t01.mes,
                           t01.dia,
                           t01.id_rangohora,
                           SUM(t01.cupos) AS capacidad,
                           SUM(t01.max_citas_agregadas) AS agregados
                    FROM cit_distribucion_procedimiento          t01
                    INNER JOIN mnt_procedimiento_establecimiento t02 ON (t02.id = t01.id_procedimiento_establecimiento)
                    WHERE t01.id_empleado $whereIdEmpleado
                            AND t01.id_area_mod_estab = :idAreaModEstab
                            AND t02.id_ciq = :idProcedimiento
                    GROUP BY t01.yrs, t01.mes, t01.dia, t01.id_rangohora
                ) tx03 ON (tx03.yrs = EXTRACT(YEAR FROM tx01.date::timestamp) AND tx03.mes = EXTRACT(MONTH FROM tx01.date::timestamp) AND tx03.dia = EXTRACT(DOW FROM tx01.date::timestamp) AND tx03.id_rangohora = tx01.id_rango_hora)
                -- Detalle de las citas
                $leftJoinDetalleCita
                -- Eventos del Medico
                LEFT JOIN (
                    SELECT t01.fecha_hora_ini AS timestamp_ini,
                           t01.fecha_hora_fin AS timestamp_fin,
                           t02.id       AS id_tipo_evento,
                           t02.nombre   AS nombre_tipo_evento
                    FROM mnt_evento                              t01
                    INNER JOIN mnt_tipo_evento                   t02 ON (t02.id = t01.id_tipo_evento)
                    LEFT  JOIN mnt_procedimiento_establecimiento t03 ON (t03.id = t01.id_procedimiento_establecimiento)
                    WHERE (((t03.id_ciq=:idProcedimiento OR t01.id_procedimiento_establecimiento IS NULL) OR t01.id_empleado IS NULL)
                          $whereEventoEmpleado)
                        AND es_evento_medico = FALSE AND id_modulo = 4
                ) tx05 ON ( ( tx01.timestamp_ini > tx05.timestamp_ini AND tx01.timestamp_ini < tx05.timestamp_fin ) OR ( tx01.timestamp_fin > tx05.timestamp_ini AND tx01.timestamp_fin < tx05.timestamp_fin ) )
                ORDER BY tx01.date, tx01.timestamp_ini";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idProcedimiento', $idProcedimiento);
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
            $id   = $date->format($outputKeyFormat);

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
                $result[$id]['prCapacidad']            = 0;
                $result[$id]['prAsignado']             = 0;
                $result[$id]['agCapacidad']          = 0;
                $result[$id]['agAsignado']           = 0;
                $result[$id]['totalCapacidad']       = 0;
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
                    $row['capacidad'],
                    $row['asignado'],
                    $row['ag_capacidad'],
                    $row['ag_asignado'],
                    $row['total_asignados'],
                    $row['id_distribucion'],
                    $row['horario_bloqueado'],
                    $row['id_tipo_evento'],
                    $row['nombre_tipo_evento']
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
                'id'               => $newSchedule[0],
                'horaIni'          => $newSchedule[1],
                'horaFin'          => $newSchedule[2],
                'rangoHora'        => $newSchedule[3],
                'prCapacidad'      => $newSchedule[4],
                'prAsignado'       => $newSchedule[5],
                'agCapacidad'      => $newSchedule[6],
                'agAsignado'       => $newSchedule[7],
                'totalCapacidad'   => intval($newSchedule[4]) + intval($newSchedule[6]),
                'totalAsignados'   => $newSchedule[8],
                'idDistribucion'   => $newSchedule[9],
                'bloqueado'        => $newSchedule[10],
                'idTipoEvento'     => $newSchedule[11],
                'nombreTipoEvento' => $newSchedule[12]
            );

            $fechas['prCapacidad']      += $newSchedule[4];
            $fechas['prAsignado']       += $newSchedule[5];
            $fechas['agCapacidad']    += $newSchedule[6];
            $fechas['agAsignado']     += $newSchedule[7];
            $fechas['totalCapacidad'] += intval($newSchedule[4]) + intval($newSchedule[6]);
            $fechas['totalAsignados'] += $newSchedule[8];

            if($newSchedule[10] === true) {
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
                    $row['nombre_tipo_cita']
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
                'id'               => $newAppointment[0],
                'idExpediente'     => $newAppointment[1],
                'numeroExpediente' => $newAppointment[2],
                'nombrePaciente'   => $newAppointment[3],
                'idEstado'         => $newAppointment[4],
                'nombreEstado'     => $newAppointment[5],
                'nombreTipoCita'   => $newAppointment[6]
            );
        }

        return $citas;
    }
    /* Fin Funciones para el método getRangoCitasInfo */

    /*
     * DESCRIPCIÓN: Determina la cantidad de citas otorgadas a un paciente en un rango de fechas,
     * para un procedimiento en específico o en todos las que esten habilitados para el Establecimiento.
     * PARAMETROS: id del expediente, fecha de inicio para la búsqueda, fecha fin(opcional), id del procedimiento(opcional)
     */
    public function pacientePoseeCita($idExpediente, $lowerLimit, $upperLimit = NULL, $idProcedimientoEstablecimiento = NULL, $inputFormat = 'd/m/Y') {
        $em                 = $this->container->get('doctrine')->getManager();
        $whereProcedimiento = '';
        $whereFechaFin      = '';
        $lowerLimit         = \DateTime::createFromFormat($inputFormat, $lowerLimit);
        $upperLimit         = $upperLimit !== NULL ? \DateTime::createFromFormat($inputFormat, $upperLimit) : NULL;

        if($idProcedimientoEstablecimiento) {
            $whereProcedimiento = 'AND C.id = :idProcedimientoEstablecimiento';
        }

        if($upperLimit != NULL) {
            $whereFechaFin = 'AND A.fecha<= :upperLimit';
        }

        $sql = "SELECT A.*,CONCAT(TO_CHAR(D.hora_ini, 'HH12:MI:SS AM'),' - ',TO_CHAR(D.hora_fin, 'HH12:MI:SS AM')) AS rango_hora,
                CONCAT_WS(' - ',E.codigo,E.nombre_comun) as procedimiento
                FROM cit_citas_procedimientos A
                INNER JOIN cit_distribucion_procedimiento B ON (A.id_distribucion_procedimiento=B.id)
                INNER JOIN mnt_procedimiento_establecimiento C ON (B.id_procedimiento_establecimiento=C.id)
                INNER JOIN mnt_rangohora D ON (D.id=B.id_rangohora)
                INNER JOIN mnt_ciq E ON (E.id=C.id_ciq)
                WHERE A.fecha >= :lowerLimit
                    AND A.id_estado NOT IN (3,9)
                    AND A.id_expediente = :idExpediente
                    $whereProcedimiento
                    $whereFechaFin
                ORDER BY A.fecha";

        $stm = $this->container->get('database_connection')->prepare($sql);

        $stm->bindValue(':idExpediente', $idExpediente);
        $stm->bindValue(':lowerLimit', $lowerLimit->format('Y-m-d'));

        if($idProcedimientoEstablecimiento) {
            $stm->bindValue(':idProcedimientoEstablecimiento', $idProcedimientoEstablecimiento);
        }

        if($upperLimit != NULL) {
            $stm->bindValue(':upperLimit', $upperLimit->format('Y-m-d'));
        }

        $stm->execute();
        $result = $stm->fetchAll();

        return $result;
    }

    /*  insertarCita
     *      Función que permite insertar una cita Medica, segun los parametros proporcionados
     *
     *  Parametros:                            | Requerido | Valor por Defecto | Posibles Valores      | Descripcion
     *  ---------------------------------------+-----------+-------------------+-----------------------+------------
     *      idProcedimientoEstablecimiento     | Si        | -                 | INTEGER               | id del procedimiento establecimiento a insertar la cita
     *      idDistribucion                     | Si        | -                 | INTEGER               | id de la Distribucion a insertar
     *      idExpediente                       | Si        | -                 | INTEGER               | id del Expediente
     *      fecha                              | Si        | -                 | STRING  | DATETIME    | Fecha en que se insertará la cita
     *      idRangoHora                        | Si        | -                 | INTEGER               | id del Horario en que se ha de insertar la cita
     *      idEstadoCita                       | Si        | -                 | INTEGER               | id del Estado con el que se insertara la cita
     *      idJustificacion                    | No        | NULL              | INTEGER | NULL        | id del Motivo de justificacion por el cual se esta ingresando la cita ( para el caso de agregados, y reprogramados)
     *      idEstablecimiento                  | No        | NULL              | INTEGER | NULL        | id del Establecimiento al que se le desea insertar la cita, si este parámetro no esta definido se tomará el id del establecimiento configurado
     *      idEstablecimientoReferencia        | No        | NULL              | INTEGER | NULL        | id del Establecimiento de referencia
     *      numeroExpedienteReferencia         | No        | NULL              | STRIGN  | NULL        | Número de expediente de donde viene referido
     *      inputFormat                        | No        | 'd/m/Y'           | STRING                | Formato en que se esta dando las fechas para ser convertidas a DateTime, para el caso que se envie como string
     */
    public function insertarCita($idDistribucion, $idExpediente, $fecha, $idRangoHora, $idEstadoCita, $idJustificacion = NULL, $idEstablecimiento = NULL, $idEstablecimientoReferencia = NULL, $numeroExpedienteReferencia=NULL,$inputFormat = 'd/m/Y') {
        $em                = $this->container->get('doctrine')->getManager();
        $now               = new \DateTime();
        $user              = $this->container->get('security.context')->getToken()->getUser();
        $idExpediente      = $em->getRepository('MinsalSiapsBundle:MntExpediente')->findOneById($idExpediente);
        $fecha             = gettype($fecha) === 'string' ? \DateTime::createFromFormat($inputFormat, $fecha) : $fecha;
        $idRangoHora       = $em->getRepository('MinsalSiapsBundle:MntRangohora')->findOneById($idRangoHora);
        $idEstadoCita      = $em->getRepository('MinsalCitasBundle:CitEstadoCita')->findOneById($idEstadoCita); // id del Estado Reprogramada
        $idJustificacion   = $idJustificacion ? $em->getRepository('MinsalCitasBundle:CitJustificacion')->findOneById($idJustificacion) : NULL;
        $ipCita            = $this->container->get('request')->server->get('REMOTE_ADDR');
        $idEstablecimiento = $idEstablecimiento ? $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneById($idEstablecimiento) : $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneByConfigurado(true);
        $idEstablecimientoReferencia = $idEstablecimientoReferencia ? $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneById($idEstablecimientoReferencia) : NULL;
        $idDistribucion    = $em->getRepository('MinsalCitasBundle:CitDistribucionProcedimiento')->findOneById($idDistribucion);
        $idProcedimientoEstablecimiento    = $idDistribucion->getIdProcedimientoEstablecimiento();
        $idAreaModEstab    = $idDistribucion->getIdAreaModEstab();
        $idProcedimiento   = $idProcedimientoEstablecimiento->getIdCiq();
        $idEmpleado = $idDistribucion->getIdEmpleado();

        $cita           = array('estado' => FALSE );
        $insertarCita   = TRUE;

        $datosCita      = $this->getRangoCitasInfo($idProcedimiento->getId(), $idAreaModEstab->getId(),$idEmpleado?$idEmpleado->getId():NULL,$fecha->format('d/m/Y'), $fecha->format('d/m/Y'), false, 'true', false);

        $codigoTipoCita = $idEstadoCita->getId() !== 6 ? 'pr' : 'ag' ;
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
                'idProcedimientoEstablecimiento: '.$idProcedimientoEstablecimiento->getId().
                ', idEmpleado: '.$idEmpleado?$idEmpleado->getId():'NO TIENE'.
                ', idExpediente: '.$idExpediente->getId().
                ', fecha: '.$fecha->format('d/m/Y').
                ', idRangoHora: '.$idRangoHora->getId().
                ', idDistribucion: '.($idDistribucion ? $idDistribucion->getId() : 'NULL').
                ', idJustificacion: '.($idJustificacion ? $idJustificacion->getId() : 'NULL')
                .', idEstablecimiento: '.($idEstablecimiento ? $idEstablecimiento->getId() : 'NULL')
                .', idEstablecimientoReferencia: '.($idEstablecimientoReferencia ? $idEstablecimientoReferencia->getId() : 'NULL')
                .', inputFormat: '.$inputFormat;
        }

        if( $insertarCita ) {
            try {
                $citCitasProcedimientos = new CitCitasProcedimientos();

                $citCitasProcedimientos->setIdExpediente($idExpediente);
                $citCitasProcedimientos->setIdEstado($idEstadoCita);
                $citCitasProcedimientos->setFecha($fecha);
                $citCitasProcedimientos->setIdusuarioreg($user);
                $citCitasProcedimientos->setfechahorareg($now);
                $citCitasProcedimientos->setIpcita($ipCita);
                $citCitasProcedimientos->setIdEstablecimiento($idEstablecimiento);
                $citCitasProcedimientos->setIdEstablecimientoReferencia($idEstablecimientoReferencia);
                $citCitasProcedimientos->setNumeroExpedienteReferencia($numeroExpedienteReferencia);
                $citCitasProcedimientos->setIdDistribucionProcedimiento($idDistribucion);
                $citCitasProcedimientos->setIdJustificacion($idJustificacion);

                $em->persist($citCitasProcedimientos);
                $em->flush();

                $cita['estado'] = TRUE;
                $cita['idCita'] = $citCitasProcedimientos->getId();
            } catch(\Exception $e) {
                $cita['detalleError'] = $e->getTraceAsString();
            }
        }

        return $cita;
    }

    public function getDetalleCitaDia($idAreaModEstab, $idProcedimientoEstablecimiento, $fechaInicial, $fechaFinal, $idRangoHora, $idEmpleado, $idTipoCita, $inputFormat = 'd/m/Y', $outputFormat = 'dd/mm/yyyy') {
        $em           = $this->container->get('doctrine')->getManager();
        $fechaInicial = \DateTime::createFromFormat($inputFormat, $fechaInicial);
        $fechaFinal   = \DateTime::createFromFormat($inputFormat, $fechaFinal);

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
                       COALESCE(t07.id, 0) AS idDocumentoIdentidadPaciente,
                       CASE WHEN t07.id IS NULL
                            THEN ''
                            ELSE t03.numeroDocIdePaciente
                        END AS numeroDocumentoIdentidadPaciente,
                       CONCAT( CONCAT( CONCAT_WS(' ',t03.primerApellido, t03.segundoApellido, t03.apellidoCasada), ', ' ), CONCAT_WS(' ',t03.primerNombre, t03.segundoNombre, t03.tercerNombre) ) AS nombrePaciente,
                       IDENTITY(t01.idEstado) AS idEstado,
                       t04.estado AS nombreEstado
                FROM MinsalCitasBundle:CitCitasProcedimientos             t01
                INNER JOIN MinsalSiapsBundle:MntExpediente                t02 WITH (t02.id = t01.idExpediente)
                INNER JOIN MinsalSiapsBundle:MntPaciente                  t03 WITH (t03.id = t02.idPaciente)
                INNER JOIN MinsalCitasBundle:CitEstadoCita                t04 WITH (t04.id = t01.idEstado)
                INNER JOIN MinsalCitasBundle:CitDistribucionProcedimiento t05 WITH (t05.id = t01.idDistribucionProcedimiento)
                INNER JOIN MinsalSiapsBundle:MntRangohora                 t06 WITH (t06.id = t05.idRangohora)
                LEFT  JOIN MinsalSiapsBundle:CtlDocumentoIdentidad        t07 WITH (t07.id = t03.idDocPaciente AND t07.id = 1)";

        $where = " WHERE t01.fecha BETWEEN :fechaInicial AND :fechaFinal
                        AND t05.idAreaModEstab = :idAreaModEstab
                        AND t05.idProcedimientoEstablecimiento = :idProcedimientoEstablecimiento
                        AND t04.id NOT IN (3,9)";

        $where .= $idEmpleado ? " AND t05.idEmpleado = $idEmpleado" : " AND t05.idEmpleado IS NULL";
        $where .= $idTipoCita === 1 ? " AND t01.idJustificacion IS NULL" : " AND t01.idJustificacion >= 1";


        if($idRangoHora !== NULL) {
            $where .= " AND t05.idRangohora = :idRangoHora";
        }

        $orderBy = " ORDER BY t04.estado DESC";

        $query = $em->createQuery($dql.$where.$orderBy)
                     ->setParameter(':fechaInicial', $fechaInicial->format('Y-m-d'))
                     ->setParameter(':fechaFinal', $fechaFinal->format('Y-m-d'))
                     ->setParameter(':idProcedimientoEstablecimiento', $idProcedimientoEstablecimiento)
                     ->setParameter(':idAreaModEstab', $idAreaModEstab);

        if($idRangoHora) {
            $query->setParameter(':idRangoHora', $idRangoHora);
        }

        $result = $query->getArrayResult();

        return $result;
    }
}
