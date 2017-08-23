<?php

namespace Minsal\SiapsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class MntAreaModEstabController extends Controller {

    /**
     * @Route("/atenciones/get", name="get_atenciones", options={"expose"=true})
     */
    public function getAtencionesAction() {
        $em   = $this->getDoctrine()->getManager();
        $resp = '';

        $atenciones = $em->getRepository('MinsalSiapsBundle:CtlAtencion')->obtenerAtenciones();

        foreach ($atenciones as $k => $atencion) {
            if ($atencion->getIdAtencionPadre() === null) {
                $resp .= '{"title" : "' . $atencion->getNombre() . '", ' .
                        '"key" : "' . $atencion->getId() . '"';
                $hijos = '';
                $hijos = $this->getHijos($atencion->getId(), $atenciones);
                if ($hijos != '')
                    $resp .= ', "children" : [' . $hijos . ']';
                $resp .='},';
            }
        }
        $resp = trim($resp, ',');
        return new Response('[' . $resp . ']');
    }

    /**
     * @Route("/especialidades/get", name="get_especialidades", options={"expose"=true})
     */
    public function getEspecialidadesAction() {
        $em = $this->getDoctrine()->getManager();
        $resp = '';

        $atenciones = $em->getRepository('MinsalSiapsBundle:CtlAtencion')
                ->obtenerEspecialidades();

        foreach ($atenciones as $k => $atencion) {
            if ($atencion->getIdAtencionPadre() === null) {
                $resp .= '{"title" : "' . $atencion->getNombre() . '", ' .
                        '"key" : "' . $atencion->getId() . '"';
                $hijos = '';
                $hijos = $this->getHijos($atencion->getId(), $atenciones);
                if ($hijos != '')
                    $resp .= ', "children" : [' . $hijos . ']';
                $resp .='},';
            }
        }
        $resp = trim($resp, ',');
        return new Response('[' . $resp . ']');
    }

    private function getHijos($padre, $arreglo) {
        $hijos = '';
        foreach ($arreglo as $k => $atencion) {
            if ($atencion->getIdAtencionPadre() !== null)
                if ($atencion->getIdAtencionPadre()->getId() == $padre) {
                    $hijos .= '{"title" : "' . $atencion->getNombre() . '", ' .
                            '"key" : "' . $atencion->getId() . '"';
                    $hijos2 = '';
                    $hijos2 = $this->getHijos($atencion->getId(), $arreglo);
                    if ($hijos2 != '')
                        $hijos .= ', "children" : [' . $hijos2 . ']';
                    $hijos .='},';
                }
        }
        $hijos = trim($hijos, ',');
        return $hijos;
    }

    /**
     * @Route("/mntareamodestab/get", name="get_area_mod_estab", options={"expose"=true})
     */
    public function getAreaModEstabAction() {
        $em       = $this->getDoctrine()->getManager();
        $request  = $this->getRequest();
        $user     = $this->getUser();
        $andWhere = '';
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $idEstablecimiento  = $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : ( $user->getIdEmpleado() ? ( $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId() ) : $CtlEstablecimiento->getId() );



        $result = count($result) > 1 ? $result : $result[0];

        return new Response(json_encode($result));
    }

    /**
     * @Route("/mntareamodestab/user/get", name="get_area_mod_estab_de_empleado", options={"expose"=true})
     */
    public function obtenerAreaModEstabDeEmpleadoAction() {
        $em       = $this->getDoctrine()->getManager();
        $request  = $this->getRequest();
        $user     = $this->getUser();

        $idEmpleado = $request->get('idEmpleado') ? $request->get('idEmpleado') : ( $user->getIdEmpleado() ? $user->getIdEmpleado()->getId() : NULL );

        if(!$idEmpleado) {
            throw new \Exception('El id del Empleado no ha sido proporcionado');
        }

        $result = $em->getRepository('MinsalSiapsBundle:MntAreaModEstab')->obtenerAreaModEstabDeEmpleado($idEmpleado);

        return new Response(json_encode($result));
    }
}
