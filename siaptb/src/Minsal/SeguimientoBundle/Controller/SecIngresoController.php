<?php

namespace Minsal\SeguimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Minsal\Metodos\Funciones;

class SecIngresoController extends Controller {
    /*
     * DESCRIPCIÓN: Método que devuelve las especialidades de hospitalización
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/obtener/especialidades/ingresos", name="get_especialidad_ingresos", options={"expose"=true})
     */
    public function getEspecialidadesIngresoAction() {

        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT A.id as id,
                        (CASE WHEN F.nombre IS NOT NULL THEN CONCAT('Hospitalización ',F.nombre)
                                ELSE C.nombre
                        END)  as nombre
                FROM MinsalSiapsBundle:MntAtenAreaModEstab A
                JOIN A.idAreaModEstab B
                JOIN A.idAtencion C
                JOIN B.idAreaAtencion D
                LEFT JOIN B.idServicioExternoEstab E
                LEFT JOIN E.idServicioExterno F
                WHERE C.idTipoAtencion = 1
                      AND A.nombreAmbiente IS NULL
                      AND D.id = 3
                ORDER BY nombre";
        $especialidades['especialidades'] = $em->createQuery($dql)
                ->getArrayResult();

        return new Response(json_encode($especialidades));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve los servicios hospitalarios dependiendo
     * de la especialidad seleccionada
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/obtener/servicios/hospitalarios", name="get_servicios_hospitalarios", options={"expose"=true})
     */
    public function getServiciosHospitalariosAction() {
        $request = $this->getRequest();

        $especialidad = $request->get('idAtenAreaModEstab');
        $em = $this->getDoctrine()->getManager();

        $idAtenAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($especialidad);
        $dql = "SELECT A.id as id, A.nombreAmbiente
                FROM MinsalSiapsBundle:MntAtenAreaModEstab A
                WHERE A.idAreaModEstab =:area AND A.idAtencion =:atencion
                      AND A.nombreAmbiente IS NOT NULL";
        $especialidades['especialidades'] = $em->createQuery($dql)
                ->setParameters(array(
                    'area' => $idAtenAreaModEstab->getIdAreaModEstab(),
                    'atencion' => $idAtenAreaModEstab->getIdAtencion()
                ))
                ->getArrayResult();

        return new Response(json_encode($especialidades));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve todos los servicios de hospitalización
     * restantes.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/obtener/servicios/hospitalarios/otros", name="get_servicios_hospitalarios_otros", options={"expose"=true})
     */
    public function getServiciosHospitalariosOtrosAction() {
        $request = $this->getRequest();

        $especialidad = $request->get('idAtenAreaModEstab');
        $em = $this->getDoctrine()->getManager();

        $idAtenAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($especialidad);
        $dql = "SELECT A.id as id, A.nombreAmbiente
                FROM MinsalSiapsBundle:MntAtenAreaModEstab A
                WHERE A.nombreAmbiente IS NOT NULL AND
                      A.id NOT IN(SELECT B.id
                                  FROM MinsalSiapsBundle:MntAtenAreaModEstab B
                                  WHERE B.idAreaModEstab =:area AND B.idAtencion =:atencion
                                  AND B.nombreAmbiente IS NOT NULL)";
        $especialidades['especialidades'] = $em->createQuery($dql)
                ->setParameters(array(
                    'area' => $idAtenAreaModEstab->getIdAreaModEstab(),
                    'atencion' => $idAtenAreaModEstab->getIdAtencion()
                ))
                ->getArrayResult();

        return new Response(json_encode($especialidades));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve TODOS los servicios de hospitalización
     * registrados.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/obtener/servicios/hospitalarios/todos", name="get_servicios_hospitalarios_todos", options={"expose"=true})
     */
    public function getServiciosHospitalariosTodosAction() {
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT A.id as id, A.nombreAmbiente nombre
                FROM MinsalSiapsBundle:MntAtenAreaModEstab A
                WHERE A.nombreAmbiente IS NOT NULL
                ORDER BY A.nombreAmbiente";
        $especialidades['especialidades'] = $em->createQuery($dql)
                ->getArrayResult();

        return new Response(json_encode($especialidades));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve la vista para la busqueda de los
     * ingresos
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/buscar/ingresos", name="buscar_ingresos", options={"expose"=true})
     */
    public function buscarIngresosAction() {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);
        if(array_search('primer_nombre', array_keys($datos))){
            $primerNombre = chop(ltrim($datos['primer_nombre']));
            $segundoNombre = chop(ltrim($datos['segundo_nombre']));
            $tercerNombre = chop(ltrim($datos['tercer_nombre']));
            $primerApellido = chop(ltrim($datos['primer_apellido']));
            $segundoApellido = chop(ltrim($datos['segundo_apellido']));
            $apellidoCasada = chop(ltrim($datos['apellido_casada']));
            $fechaNacimiento = $datos['fecha_nacimiento'];
            $nec = chop(ltrim($datos['nec']));
            $servicio = $datos['servicio_ingreso'];
        }else{
            $primerNombre = '';
            $segundoNombre='';
            $tercerNombre='';
            $primerApellido = '';
            $segundoApellido='';
            $apellidoCasada='';
            $nec = '';
            $fechaNacimiento = '';
            $servicio = '';

        }
        //INICIALIZANDO VARIABLE DOCTRINE
        $conn = $em->getConnection();
        $sql = "SELECT A.*,E.id id_ingreso,C.nombre,B.numero,D.nombre_ambiente ambiente,E.diagnostico,to_char(E.fecha,'DD/MM/YYYY')||' '||to_char(E.hora,'HH12:MI AM') fecha_hora_ingreso,
                    concat(coalesce(cast(E.tarjetas_entregadas as text)||' Tarjetas','0 Tarjetas'),coalesce(' A '||E.responsable_tarjeta,'')) tarjetas
                FROM mnt_paciente A
                     INNER JOIN mnt_expediente B ON B.id_paciente=A.id
                     LEFT JOIN ctl_documento_identidad C ON C.id=A.id_doc_ide_paciente
                     INNER JOIN sec_ingreso E ON E.id_expediente=B.id
                     LEFT JOIN mnt_aten_area_mod_estab D ON E.id_ambiente_ingreso=D.id
                WHERE  B.habilitado= TRUE ";


        if ($primerNombre != '') {
            $primerNombre = "  AND A.primer_nombre::text ~* '$primerNombre'";
        }
        if ($primerApellido != '') {
            $primerApellido = " AND A.primer_apellido::text ~* '$primerApellido'";
        }
        if ($segundoNombre != '') {
            $segundoNombre = " AND A.segundo_nombre::text ~* '$segundoNombre'";
        }
        if ($tercerNombre != '') {
            $tercerNombre = " AND A.tercer_nombre::text ~* '$tercerNombre'";
        }
        if ($segundoApellido != '') {
            $segundoApellido = " AND A.segundo_apellido::text ~* '$segundoApellido'";
        }
        if ($apellidoCasada != '') {
            $apellidoCasada = " AND A.apellido_casada::text ~* '$apellidoCasada'";
        }
        if ($fechaNacimiento != '') {
            $fechaNacimiento = " AND A.fecha_nacimiento='$fechaNacimiento'";
        }
        if ($nec != '') {
            if (strlen($nec)==12) {
                $nec=$nec;
            }else{
                $numero = explode('-', $nec);
                $entero = (int) $numero[0];
                $nec = (string) $entero;
                if (count($numero) == 2) {
                    $nec.='-' . $numero[1];
                }
            }
            $nec = " AND B.numero='$nec'";
        }
        if ($servicio != '') {
            $servicio = " AND E.id_ambiente_ingreso=$servicio";
        }
        $fechas = '';
        if ($primerNombre == '' && $primerApellido == '' && $nec == '' && $fechaNacimiento == '' && $servicio == '') {
            $fechas = " AND date(E.fecha) = current_date";
        }
        $sql.=$primerNombre . $primerApellido . $segundoNombre . $tercerNombre . $segundoApellido . $apellidoCasada . $fechaNacimiento . $nec . $servicio . $fechas;
        $sql.= " ORDER BY E.id DESC, E.fecha DESC, E.hora DESC,A.primer_Apellido ASC";

        $pacientes = $conn->query($sql);

        return $this->render('MinsalSeguimientoBundle:SecIngreso:resultado_busqueda.html.twig', array('pacientes'=>$pacientes));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve la vista para la busqueda de los
     * ingresos por fecha
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/buscar/ingresos/pacientes", name="buscar_ingresos_pacientes", options={"expose"=true})
     */
    public function buscarIngresosPacienteAction() {
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);
        $fecha_inicio = $datos['fecha_inicio'];
        $fecha_fin = $datos['fecha_fin'];
        $servicio = $datos['servicio_ingreso'];

        //INICIALIZANDO VARIABLE DOCTRINE
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        //CONSTANTES

        $sql = "SELECT A.*,E.id id_ingreso,B.numero,D.nombre_ambiente ambiente,E.diagnostico,E.fecha,E.hora,
            concat(coalesce(cast(E.tarjetas_entregadas as text)||' Tarjetas','0 Tarjetas'),coalesce(' A '||E.responsable_tarjeta,'')) tarjetas
                FROM mnt_paciente A
                     INNER JOIN mnt_expediente B ON B.id_paciente=A.id
                     INNER JOIN sec_ingreso E ON E.id_expediente=B.id
                     LEFT JOIN mnt_aten_area_mod_estab D ON E.id_ambiente_ingreso=D.id
                WHERE  B.habilitado= TRUE
                       AND E.fecha>=to_date('$fecha_inicio','DD-MM-YYYY') and E.fecha<=to_date('$fecha_fin','DD-MM-YYYY')";
        if ($servicio != '') {
            $sql .= " AND E.id_ambiente_ingreso=$servicio";
        }
        $sql.= " ORDER BY E.fecha DESC, E.hora DESC,A.primer_Apellido ASC";

        $pacientes = $conn->query($sql);
        return $this->render('MinsalSeguimientoBundle:SecIngreso:resultado_reporte_list.html.twig', array('pacientes'=>$pacientes));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON que contiene los ingresos de
     * los pacientes en las fechas establecidas.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/pacientes/ingresado", name="pacientes_ingresados", options={"expose"=true})
     */
    public function cargarReporteIngresoAction() {
        //OBTENIENDO PARÁMETROS DE BUSQUEDA


        $numfilas = count($query->rowCount());
        $espacio = "";
        $i = 0;
        $rows = array();
        if ($numfilas > 0) {
            foreach ($query->fetchAll() as $aux) {
                $rows[$i]['id'] = $aux['id_ingreso'];
                $rows[$i]['cell'] = array(
                    $aux['numero'],
                    $aux['primer_apellido'] . ' ' . $aux['segundo_apellido'] . ' ' . $aux['apellido_casada'] . $aux['primer_nombre'] . ' ' . $aux['segundo_nombre'] . ' ' . $aux['tercer_nombre'],
                    date('d-m-Y', strtotime($aux['fecha_nacimiento'])),
                    date('d-m-Y', strtotime($aux['fecha'])) . " " . date('H:i', strtotime($aux['hora'])),
                    $aux['ambiente'],
                    $aux['diagnostico'],
                    $aux['tarjetas']
                );
                $i++;
            }
        }

        $datos = json_encode($rows);
        $pages = floor($numfilas / 10) + 1;

        $jsonresponse = '{
               "page":"1",
               "total":"' . $pages . '",
               "records":"' . $numfilas . '",
               "rows":' . $datos . '}';

        return new Response($jsonresponse);
    }

}

?>
