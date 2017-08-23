<?php

namespace Minsal\SeguimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Minsal\Metodos\Funciones;

class SecEmergenciaController extends Controller {

    /*
     * DESCRIPCIÓN: Método que devuelve la vista para la busqueda de las
     * emergencias
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/buscar/emergencias", name="buscar_emergencias", options={"expose"=true})
     */
    public function buscarEmergenciasAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);
        $primerNombre = chop(ltrim($datos['primer_nombre']));
        $segundoNombre = chop(ltrim($datos['segundo_nombre']));
        $tercerNombre = chop(ltrim($datos['tercer_nombre']));
        $primerApellido = chop(ltrim($datos['primer_apellido']));
        $segundoApellido = chop(ltrim($datos['segundo_apellido']));
        $apellidoCasada = chop(ltrim($datos['apellido_casada']));
        $fechaNacimiento = $datos['fecha_nacimiento'];
        $nec = chop(ltrim($datos['nec']));



            //INICIALIZANDO VARIABLE DOCTRINE
            $em = $this->getDoctrine()->getManager();
            $conn = $em->getConnection();
            //CONSTANTES

            $sql = "SELECT A.*,E.id id_emergencia,concat(C.nombre,':',coalesce(A.numero_doc_ide_paciente,'-')),coalesce(B.numero,'EM') numero,
    			E.numero_emergencia,to_char(E.fecha_registra,'DD-MM-YYYY') as fecha_emergencia
                    FROM mnt_paciente A
                         LEFT JOIN mnt_expediente B ON (B.id_paciente=A.id and B.habilitado= TRUE)
                         LEFT JOIN ctl_documento_identidad C ON C.id=A.id_doc_ide_paciente
                         INNER JOIN sec_emergencia E ON E.id_paciente=A.id
                    WHERE
                    ";


            if ($primerNombre != '')
                $primerNombre = "  AND A.primer_nombre::text ~* '$primerNombre'";
            if ($primerApellido != '')
                $primerApellido = " AND A.primer_apellido::text ~* '$primerApellido'";
            if ($segundoNombre != '')
                $segundoNombre = " AND A.segundo_nombre::text ~* '$segundoNombre'";
            if ($tercerNombre != '')
                $tercerNombre = " AND A.tercer_nombre::text ~* '$tercerNombre'";
            if ($segundoApellido != '')
                $segundoApellido = " AND A.segundo_apellido::text ~* '$segundoApellido'";
            if ($apellidoCasada != '')
                $apellidoCasada = " AND A.apellido_casada::text ~* '$apellidoCasada'";
            if ($fechaNacimiento != '')
                $fechaNacimiento = " AND A.fecha_nacimiento='$fechaNacimiento'";

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

    	//'Número Expediente', 'Nombre del Paciente', 'F. NAC.','Fecha de Emergencia','No. de Emergencia'
            $condiciones=$primerNombre . $primerApellido . $segundoNombre . $tercerNombre . $segundoApellido . $apellidoCasada . $fechaNacimiento . $nec ;
            $sql.= substr_replace($condiciones, '', 0, 5)." ORDER BY cast(E.numero_emergencia as integer) DESC LIMIT 100";

            $pacientes = $conn->query($sql);

        return $this->render('MinsalSeguimientoBundle:SecEmergencia:resultado_busqueda.html.twig', array('pacientes'=>$pacientes));
    }

     /*
     * DESCRIPCIÓN: Método que devuelve la vista para la busqueda de los
     * emergencias por fecha
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/buscar/emergencias/pacientes", name="buscar_emergencias_pacientes", options={"expose"=true})
     */
    public function buscarEmergenciasPacienteAction() {
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);
        $fecha_inicio= $datos['fecha_inicio'];
        $fecha_fin= $datos['fecha_fin'];

        //INICIALIZANDO VARIABLE DOCTRINE
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        //CONSTANTES

        $sql = "SELECT A.*,E.id id_emergencia,concat(C.nombre,':',coalesce(A.numero_doc_ide_paciente,'-')),coalesce(B.numero,'EM') numero,
			E.numero_emergencia,to_char(E.fecha_registra,'DD-MM-YYYY HH24:MI AM') as fecha_emergencia
                FROM mnt_paciente A
                     LEFT JOIN mnt_expediente B ON (B.id_paciente=A.id and B.habilitado= TRUE)
                     LEFT JOIN ctl_documento_identidad C ON C.id=A.id_doc_ide_paciente
                     INNER JOIN sec_emergencia E ON E.id_paciente=A.id
                WHERE date(E.fecha_registra)>=to_date('$fecha_inicio','DD-MM-YYYY') AND date(E.fecha_registra)<=to_date('$fecha_fin','DD-MM-YYYY')
                ORDER BY E.id";

        $pacientes = $conn->query($sql);

        return $this->render('MinsalSeguimientoBundle:SecEmergencia:resultado_reporte_list.html.twig', array('pacientes'=>$pacientes));
    }

     /*
     * DESCRIPCIÓN: Método que devuelve un JSON que contiene los emergencias de
     * los pacientes en las fechas establecidas.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/pacientes/en/emergencia", name="pacientes_en_emergencia", options={"expose"=true})
     */
    public function cargarReporteEmergenciaAction() {
        //OBTENIENDO PARÁMETROS DE BUSQUEDA


        $numfilas = count($query->rowCount());
        $espacio = "";
        $i = 0;
        $rows = array();
        if ($numfilas > 0) {
            foreach ($query->fetchAll() as $aux) {
                $rows[$i]['id'] = $aux['id_emergencia'];
                $rows[$i]['cell'] = array(
                    $aux['numero'],
                    $aux['primer_apellido'] . ' ' . $aux['segundo_apellido'] . ' ' . $aux['apellido_casada'].$aux['primer_nombre'] . ' ' . $aux['segundo_nombre'] . ' ' . $aux['tercer_nombre'],
                    date('d-m-Y', strtotime($aux['fecha_nacimiento'])),
                    date('d-m-Y H:i', strtotime($aux['fecha_emergencia'])),
                    $aux['numero_emergencia']
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
