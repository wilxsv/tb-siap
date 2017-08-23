<?php

namespace Minsal\SiapsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CtlEstablecimientoController extends Controller {

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON con los establecimientos que ofrecen servicios de salud.
     * ANALISTA PROGRAMADOR: Victoria López
     */

    /**
     * @Route("/establecimientos/get", name="obtener_establecimientos", options={"expose"=true})
     * @Method("GET")
     */
    // public function getEstablecimientosAction() {
    //
    //     $em = $this->getDoctrine()->getManager();
    //     $dql = "SELECT C
    //             FROM MinsalSiapsBundle:CtlEstablecimiento C
    //             WHERE C.idTipoEstablecimiento NOT IN (12,13,28,29)
    //             ORDER BY C.nombre";
    //     $establecimientos = $em->createQuery($dql)->getResult();
    //
    //     foreach ($establecimientos as $key => $value) {
    //         $envio[$key]['id']   = $value->getId();
    //         $envio[$key]['text'] =  ucwords(strtolower($value->getNombre()));
    //     }
    //
    //     $resultados = array();
    //     $resultados['resultados'] = $envio;
    //
    //     return new Response(json_encode($resultados));
    // }

    /**
     * @Route("/establecimientos/get", name="obtener_establecimientos", options={"expose"=true})
     * @Method("GET")
     */
    public function getEstablecimientosAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $clue = trim(strtolower($request->get('clue')));
        $limit = $request->get('page_limit');
        $page = ($request->get('page') - 1) * 10;

        /*****************************************************************************************
         * SQL que obtiene el numero de expediente y nombre del paciente para asignar la cita
         ****************************************************************************************/
        $sql = "SELECT C.id, C.nombre AS text, count(*) OVER() AS total
                FROM ctl_establecimiento C
                WHERE C.id_tipo_establecimiento NOT IN (12,13,28,29)
                AND unaccent(lower(C.nombre)) ilike unaccent('%$clue%')
                ORDER BY C.nombre
                LIMIT $limit OFFSET $page";

        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        $establecimiento['datos'] = $result;
        $establecimiento['total'] = count($result) > 0 ? $result[0]['total'] : 0;

        return new Response(json_encode($establecimiento));
    }
}
