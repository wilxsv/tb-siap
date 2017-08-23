<?php

namespace Minsal\SiapsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL as DBAL;

class MntExpedienteController extends Controller {
    /*
     * DESCRIPCIÓN: Método que devuelve la vista para mostrar el resultado de
     * los expedientes creados en un determinado rango de fechas.
     * ANALISTA PROGRAMADOR: Victoria López
     */

    /**
     * @Route("/expedientes/creados", name="expedientes_creados", options={"expose"=true})
     */
    public function expedientesCreados() {
        //OBTENIENDO PARÁMETROS DE BUSQUEDA
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $request = $this->getRequest();
        parse_str($request->get('datos'), $datos);
        $fechaInicio = $datos['fecha_inicio'];
        $fechaFin = $datos['fecha_fin'];
        $tipo=$request->get('tipo')?:NULL;

        if (array_key_exists('nec', $datos)){
            $nec = $datos['nec'];
        }else{
            $nec ='';
        }
        if (array_key_exists('area', $datos)){
            $area = $datos['area'];
        }else{
            $area = '';
        }

        $establecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $restriccion = "";
        if (array_key_exists('usuario', $datos)){
            if ($datos['usuario'] != ''){
                $restriccion = " AND B.id_user=" . $datos['usuario'] . " ";
            }
        }

        if($nec !=''){
            $restriccion .=" AND A.numero='$nec'";
        }

        if ($fechaInicio != ''){
            if(is_null($tipo)){
                $restriccion .=" AND date(A.fecha_creacion)>=to_date('$fechaInicio','DD-MM-YYYY') AND date(A.fecha_creacion)<=to_date('$fechaFin','DD-MM-YYYY')";
            }else{
                  $restriccion .=" AND date(B.fecha_mod)>=to_date('$fechaInicio','DD-MM-YYYY') AND date(B.fecha_mod)<=to_date('$fechaFin','DD-MM-YYYY')";
            }
        }

        if($area != ''){
            $restriccion.=" AND A.id_creacion_expediente=$area";
        }

        $restriccionExpediente=' A.numero_temporal != TRUE AND A.cun = false';
        if(!is_null($tipo)){
            $restriccionExpediente=' A.numero_temporal =TRUE AND A.expediente_fisico_eliminado=TRUE AND A.cun = false';
        }


        $sql = "SELECT initcap(
                B.primer_apellido||coalesce(' '||B.segundo_apellido,'')||coalesce(' '||B.apellido_casada,'')||', '||
                B.primer_nombre||coalesce(' '||B.segundo_nombre,'')||coalesce(' '||B.tercer_nombre,'')) as nombre_paciente,
                to_char(B.fecha_nacimiento,'DD-MM-YYYY') as fecha_nacimiento,
                B.nombre_madre as madre,
                A.numero,
                A.id as id_expediente,
                to_char(A.fecha_creacion,'DD-MM-YYYY') as fecha_creacion,
                F.area as area_creacion,
                C.nombre as sexo,
                E.firstname||' '||E.lastname as tomo_datos,
                B.id as id_paciente,
                B.fecha_mod,
                G.firstname||' '||G.lastname as actualizo_datos
                FROM mnt_expediente A
                INNER JOIN mnt_paciente B on (A.id_paciente=B.id)
                INNER JOIN ctl_establecimiento D on (A.id_establecimiento=D.id AND configurado=true)
                INNER JOIN ctl_sexo C on (B.id_sexo=C.id)
                INNER JOIN ctl_creacion_expediente F on (F.id=A.id_creacion_expediente)
                LEFT JOIN fos_user_user E on (B.id_user=E.id)
                LEFT JOIN fos_user_user G on (B.id_user_mod=G.id)
                WHERE $restriccionExpediente $restriccion";
        $ordenamiento = "";
        if ($establecimiento->getTipoExpediente() == 'G')
            $ordenamiento = " ORDER BY cast (split_part(numero,'-',2) as integer) DESC,cast (split_part(numero,'-',1) as integer) ASC";
        else
            $ordenamiento = " ORDER BY cast (numero as integer) ASC";

        $sql.= $ordenamiento;
        $pacientes = $conn->query($sql);

        //CONSULTA DE NIÑOS APARTIR DEL 01-01-2017 PARA EL CUN
        $pacientesCun=array();
        if(is_null($tipo)){
            $restriccionExpediente=' A.cun = TRUE';

            $sql = "SELECT initcap(
                    B.primer_apellido||coalesce(' '||B.segundo_apellido,'')||coalesce(' '||B.apellido_casada,'')||', '||
                    B.primer_nombre||coalesce(' '||B.segundo_nombre,'')||coalesce(' '||B.tercer_nombre,'')) as nombre_paciente,
                    to_char(B.fecha_nacimiento,'DD-MM-YYYY') as fecha_nacimiento,
                    B.nombre_madre as madre,
                    A.numero,
                    A.id as id_expediente,
                    to_char(A.fecha_creacion,'DD-MM-YYYY') as fecha_creacion,
                    F.area as area_creacion,
                    C.nombre as sexo,
                    E.firstname||' '||E.lastname as tomo_datos,
                    B.id as id_paciente,
                    B.fecha_mod,
                    G.firstname||' '||G.lastname as actualizo_datos
                    FROM mnt_expediente A
                    INNER JOIN mnt_paciente B on (A.id_paciente=B.id)
                    INNER JOIN ctl_establecimiento D on (A.id_establecimiento=D.id AND configurado=true)
                    INNER JOIN ctl_sexo C on (B.id_sexo=C.id)
                    INNER JOIN ctl_creacion_expediente F on (F.id=A.id_creacion_expediente)
                    LEFT JOIN fos_user_user E on (B.id_user=E.id)
                    LEFT JOIN fos_user_user G on (B.id_user_mod=G.id)
                    WHERE $restriccionExpediente $restriccion
                    ORDER BY A.fecha_creacion ASC";
            $pacientesCun = $conn->query($sql);
        }

        return $this->render('MinsalSiapsBundle:MntExpedienteAdmin:expedientes_creados.html.twig',
                    array('pacientes'=>$pacientes,'tipo'=>$tipo,'pacientesCun'=>$pacientesCun));

    }

    /*
     * DESCRIPCIÓN: Método que devuelve el JSON de los expedientes creados en un rango de años
     * para el JQGRID
     * ANALISTA PROGRAMADOR: KAREN PEÑATE
     */

    /**
     * @Route("/expedientes/creados/listado/anio", name="expedientes_creados_listado_anio", options={"expose"=true})
     */
    public function expedientesCreadosPorAnioAction() {
        //OBTENIENDO PARÁMETROS DE BUSQUEDA
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $anioInicio = $request->get('anioInicio');
        $anioFin = $request->get('anioFin');

        $sql = "SELECT COUNT(id) cuantos,EXTRACT(YEAR FROM fecha_creacion) anio
                FROM mnt_expediente
                WHERE EXTRACT(YEAR FROM fecha_creacion) BETWEEN $anioInicio AND $anioFin
                      AND numero_temporal != TRUE
                GROUP BY EXTRACT(YEAR FROM fecha_creacion)
                ORDER BY EXTRACT(YEAR FROM fecha_creacion) ASC";
        $expedientes = $conn->query($sql)->fetchAll();

        $datos['expedientes'] = $expedientes;

        return new Response(json_encode($datos));
    }

    /**
     * @Route("/areas/creacion/get", name="obtener_area_creacion_archivo", options={"expose"=true})
     */
    public function getAreaCreacionArchivoAction() {

        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT c
                FROM MinsalSiapsBundle:CtlCreacionExpediente c";

        $areas['areas'] = $em->createQuery($dql)
                ->getArrayResult();

        return new Response(json_encode($areas));
    }

    /**
     * @Route("/cambiar/estado/expediente", name="cambiar_estado_expediente", options={"expose"=true})
     */
    public function cambiarEstadoExpedienteAction() {
        $em = $this->getDoctrine()->getManager();

        $connection = $this->container->get('database_connection');
        $request = $this->getRequest();
        $id=$request->get('idExpediente');
        $accion=$request->get('accion');

        $valor=$accion=='habilitar'?'FALSE':'TRUE';
        //var_dump($valor,$accion);
        $sql = "UPDATE mnt_expediente SET expediente_fisico_eliminado=$valor, numero_temporal=$valor WHERE id=$id;";

        $stm  = $connection->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        $expediente=$em->getRepository('MinsalSiapsBundle:MntExpediente')->find($id);
        $paciente =$expediente->getIdPaciente();
        $paciente->setIdUserMod($this->container->get('security.context')->getToken()->getUser());
        $paciente->setfechaMod(new \DateTime());
        $em->persist($paciente);
        $em->flush();

        $resultado['resultado'] = 'Si';

        return new Response(json_encode($resultado));
    }

}
