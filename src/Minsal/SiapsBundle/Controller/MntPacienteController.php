<?php

namespace Minsal\SiapsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Minsal\Metodos\Funciones;
use Doctrine\DBAL as DBAL;

class MntPacienteController extends Controller {
    /*
     * DESCRIPCIÓN: Método que devuelve la vista para la busqueda local
     * del paciente
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/buscar/paciente", name="buscar_paciente", options={"expose"=true})
     */
    public function buscarPacienteAction() {
        $em = $this->getDoctrine()->getManager();
        $establecimiento = $em->getRepository("MinsalSiapsBundle:CtlEstablecimiento")->obtenerEstablecimientoConfigurado();
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);

        $primerNombre = chop(ltrim($datos['primer_nombre']));
        $segundoNombre = chop(ltrim($datos['segundo_nombre']));
        $tercerNombre = chop(ltrim($datos['tercer_nombre']));
        $primerApellido = chop(ltrim($datos['primer_apellido']));
        $segundoApellido = chop(ltrim($datos['segundo_apellido']));
        $nombreMadre = chop(ltrim($datos['nombre_madre']));
        $fechaNacimiento = $datos['fecha_nacimiento'];
        $conocidoPor = chop(ltrim($datos['conocido_por']));
        $nec = chop(ltrim($datos['nec']));
        $dui = $datos['dui'];
        $tipo_busqueda = $request->get('tipo_busqueda')?:'l';
        $procedencia = $datos['procedencia'];
        if(isset($datos['origenCita'])){
            $origenCita = $datos['origenCita'];
            $idEstablecimientoReferencia = $datos['idEstablecimientoReferencia'];
            $expedienteReferencia = $datos['expedienteReferencia'];
        }
        else {
            $origenCita = '';
            $idEstablecimientoReferencia = '';
            $expedienteReferencia = '';
        }
        $eliminarExpediente = $request->get('eliminar_expediente')?TRUE:FALSE;

        //INICIALIZANDO VARIABLE DOCTRINE
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        //CONSTANTES
        $sql = $this->generaConsultaBusqueda($tipo_busqueda, $primerNombre, $segundoNombre, $tercerNombre, $primerApellido, $segundoApellido, $nombreMadre, $fechaNacimiento, $conocidoPor, $nec, $dui);
        if (strcmp($tipo_busqueda, 'l') == 0) {
            $query = $conn->query($sql);
        } else {
            $establecimientoPN = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento();
            $regional = $establecimientoPN->getIdEstablecimientoPadre()->getIdEstablecimientoPadre();
            $conexion = $em->getRepository('MinsalSiapsBundle:MntConexion')->findOneBy(array('idEstablecimiento' => $regional));
            $conn = $em->getRepository('MinsalSiapsBundle:MntConexion')->getConexionGenerica($conexion);
            $query = $conn->query($sql);
        }

        $establecimiento = $em->getRepository("MinsalSiapsBundle:CtlEstablecimiento")->obtenerEstablecimientoConfigurado();

        if ($eliminarExpediente) {
            return $this->render('MinsalSiapsBundle:MntExpedienteAdmin:cargar_expediente_eliminar.html.twig',
                 array(
                 'pacientes'=>$query
            ));
        }else{
            $vista = 'MinsalSiapsBundle:MntPacienteAdmin:resultado_busqueda.html.twig';

            return $this->render($vista,

             array('tipo_busqueda' => 'l',
             'procedencia'=>$procedencia,
             'pacientes'=>$query,
             'establecimiento'=>$establecimiento,
             'origenCita' => $origenCita,
             'idEstablecimientoReferencia' => $idEstablecimientoReferencia,
             'expedienteReferencia' => $expedienteReferencia
            ));
        }
    }

    /*
     * DESCRIPCIÓN: Método que devuelve la vista para la busqueda global
     * del paciente
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/buscar/paciente/global", name="buscar_paciente_global", options={"expose"=true})
     */
    public function buscarPacienteGlobalAction() {

        return $this->render('MinsalSiapsBundle:MntPacienteAdmin:resultado_busqueda.html.twig', array('tipo_busqueda' => 'g'));
    }

    private function generaConsultaBusqueda($tipo_busqueda, $primerNombre, $segundoNombre, $tercerNombre, $primerApellido, $segundoApellido, $nombreMadre, $fechaNacimiento, $conocidoPor, $nec, $dui) {
        if (strcmp($tipo_busqueda, 'l') == 0) {
            $sql = "SELECT A.*,C.nombre,coalesce(B.numero,'EM') numero,B.numero_temporal,B.id as id_expediente,B.expediente_fisico_eliminado,
                            E.nombre_ambiente ambiente,
                            D.diagnostico,to_char(D.fecha,'DD/MM/YYYY')||' '||to_char(D.hora,'HH12:MI AM') fecha_hora_ingreso,D.fecha,D.hora,
                            (SELECT count(id) FROM sec_historial_clinico WHERE id_numero_expediente=B.id) as historias
                            FROM mnt_paciente A
                            LEFT JOIN ctl_documento_identidad C ON C.id=A.id_doc_ide_paciente
                            LEFT JOIN mnt_expediente B ON B.id_paciente=A.id
                            LEFT JOIN sec_ingreso D ON (D.id_expediente=B.id AND D.id IN (SELECT id FROM sec_ingreso
                            WHERE to_timestamp(to_char(fecha,'DD/MM/YYYY')||' '||to_char(hora,'HH24:MI'),'DD/MM/YYYY HH24:MI')=
                            (SELECT max(to_timestamp(to_char(fecha,'DD/MM/YYYY')||' '||to_char(hora,'HH24:MI'),'DD/MM/YYYY HH24:MI')) FROM sec_ingreso WHERE id_expediente=B.id)) )
                            LEFT JOIN mnt_aten_area_mod_estab E ON D.id_ambiente_ingreso=E.id
                            WHERE (B.habilitado= TRUE OR (SELECT COUNT(id) FROM sec_emergencia WHERE id_paciente=A.id)>0)
                ";
        } else {
            $sql = "SELECT A.*,C.nombre
               FROM mnt_paciente A LEFT JOIN ctl_documento_identidad C ON C.id=A.id_doc_ide_paciente
                WHERE '1' ";
        }

        if ($primerNombre != '') {
            $primerNombre = " AND A.nombre_completo_fonetico ~* soundexesp('$primerNombre')";
        }
        if ($segundoNombre != '') {
            $segundoNombre = " AND A.nombre_completo_fonetico ~* soundexesp('$segundoNombre')";
        }
        if ($tercerNombre != '') {
            $tercerNombre = " AND A.nombre_completo_fonetico ~* soundexesp('$tercerNombre')";
        }
        if ($primerApellido != '') {
            $primerApellido = " AND A.apellido_completo_fonetico ~* soundexesp('$primerApellido')";
        }
        if ($segundoApellido != '') {
            $segundoApellido = " AND A.apellido_completo_fonetico ~* soundexesp('$segundoApellido')";
        }
        if ($nombreMadre != '') {
            $nombreMadre = " AND soundexesp(A.nombre_madre) ~* soundexesp('$nombreMadre')";
        }
        if ($conocidoPor != '') {
            $conocidoPor = " OR soundexesp(A.conocido_por) ~* soundexesp('$conocidoPor')";
        }
        if ($fechaNacimiento != '') {
            $fechaNacimiento = " AND A.fecha_nacimiento='$fechaNacimiento'";
        }
        if ($nec != '') {
            if (strtoupper(substr($nec, 0, 1)) == 'T') {
                $nec = strtoupper($nec);
            } else {
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
            }
            $nec = " AND B.numero='$nec'";
        }
        $sql.=$primerNombre . $primerApellido . $segundoNombre . $tercerNombre . $segundoApellido . $nombreMadre . $conocidoPor . $fechaNacimiento . $nec;
        if ($dui != '') {
            if ($primerNombre == '' && $segundoNombre == '' && $tercerNombre == '' && $primerApellido == '' && $segundoApellido == '' && $conocidoPor == '' && $fechaNacimiento == '' && $nec == '') {
                $sql = "SELECT A.*,C.nombre,coalesce(B.numero,'EM') numero,B.numero_temporal,
                                E.nombre_ambiente ambiente,
                                D.diagnostico,to_char(D.fecha,'DD/MM/YYYY')||' '||to_char(D.hora,'HH12:MI AM') fecha_hora_ingreso,D.fecha,D.hora,
                                (SELECT count(id) FROM sec_historial_clinico WHERE id_numero_expediente=B.id) as historias
                            FROM mnt_paciente A
                            LEFT JOIN ctl_documento_identidad C ON C.id=A.id_doc_ide_paciente
                            LEFT JOIN mnt_expediente B ON B.id_paciente=A.id
                            LEFT JOIN sec_ingreso D ON (D.id_expediente=B.id AND D.id IN (SELECT id FROM sec_ingreso
                            WHERE to_timestamp(to_char(fecha,'DD/MM/YYYY')||' '||to_char(hora,'HH24:MI'),'DD/MM/YYYY HH24:MI')=
                            (SELECT max(to_timestamp(to_char(fecha,'DD/MM/YYYY')||' '||to_char(hora,'HH24:MI'),'DD/MM/YYYY HH24:MI')) FROM sec_ingreso WHERE id_expediente=B.id)) )
                            LEFT JOIN mnt_aten_area_mod_estab E ON D.id_ambiente_ingreso=E.id
                            WHERE (B.habilitado= TRUE OR (SELECT COUNT(id) FROM sec_emergencia WHERE id_paciente=A.id)>0)
                            AND A.numero_doc_ide_paciente::text ~*'$dui'";
            } else {
                $dui = "UNION
                            SELECT A.*,C.nombre,coalesce(B.numero,'EM') numero,B.numero_temporal,
                                E.nombre_ambiente ambiente,
                                D.diagnostico,to_char(D.fecha,'DD/MM/YYYY')||' '||to_char(D.hora,'HH12:MI AM') fecha_hora_ingreso,D.fecha,D.hora,
                                (SELECT count(id) FROM sec_historial_clinico WHERE id_numero_expediente=B.id) as historias
                            FROM mnt_paciente A
                            LEFT JOIN ctl_documento_identidad C ON C.id=A.id_doc_ide_paciente
                            LEFT JOIN mnt_expediente B ON B.id_paciente=A.id
                            LEFT JOIN sec_ingreso D ON (D.id_expediente=B.id AND D.id IN (SELECT id FROM sec_ingreso
                            WHERE to_timestamp(to_char(fecha,'DD/MM/YYYY')||' '||to_char(hora,'HH24:MI'),'DD/MM/YYYY HH24:MI')=
                            (SELECT max(to_timestamp(to_char(fecha,'DD/MM/YYYY')||' '||to_char(hora,'HH24:MI'),'DD/MM/YYYY HH24:MI')) FROM sec_ingreso WHERE id_expediente=B.id)) )
                            LEFT JOIN mnt_aten_area_mod_estab E ON D.id_ambiente_ingreso=E.id
                            WHERE (B.habilitado= TRUE OR (SELECT COUNT(id) FROM sec_emergencia WHERE id_paciente=A.id)>0)
                            AND A.numero_doc_ide_paciente::text ~*'$dui'";
                $sql.=$dui;
            }
        }
        $order_by = " ORDER BY  numero_temporal DESC, primer_apellido,primer_nombre, fecha_nacimiento ";
        $sql.=$order_by;
        return $sql;
    }

    /*
     * DESCRIPCIÓN: Método que se devuelve en un JSON la edad de un determinado
     * paciente.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/paciente/edad}", name="edad_paciente", options={"expose"=true})
     * @Method("GET")
     */
    public function edad_paciente() {
        $request = $this->getRequest();
        $fecha_nacimiento = $request->get('fecha_nacimiento');
        $hora_nacimiento = $request->get('hora_nacimiento');
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $calcular = new Funciones();

        $datos['edad'] = $calcular->calcularEdad($conn, $fecha_nacimiento, $hora_nacimiento);

        return new Response(json_encode($datos));
    }

}
