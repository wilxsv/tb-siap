<?php
namespace Minsal\SiapsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL as DBAL;

class MntCiqController extends Controller {
    /**
     * @Route("/mnt/ciq/rs2/get", name="get_ciq_remote_select2", options={"expose"=true})
     * @Method("GET")
     */
    public function getCiqRemoteSelect2Action() {
        $em        = $this->getDoctrine()->getManager();
        $request   = $this->getRequest();
        $clue      = preg_replace( '/\s\s+/',' ', ( trim( $request->get('clue') ) ) );
        $limit     = $request->get('page_limit');
        $page      = ($request->get('page') - 1) * 10;

        /*****************************************************************************************
         * SQL que todos los procedimientos disponibles
         ****************************************************************************************/

        $sql = "SELECT t01.id,
                       CONCAT_WS(' - ', t01.codigo, t01.nombre_comun) AS text,
                       count(*) OVER() AS total
                FROM mnt_ciq t01
                WHERE UNACCENT(LOWER(CONCAT_WS(' - ', t01.codigo, t01.nombre_comun))) ILIKE UNACCENT(LOWER('%$clue%'))
                GROUP BY t01.id, CONCAT_WS(' - ', t01.codigo, t01.nombre_comun)
                LIMIT $limit OFFSET $page";

        $stm = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        $citcita['result'] = $result;
        $citcita['total']  = count($result) > 0 ? $result[0]['total'] : 0;

        return new Response(json_encode($citcita));
    }
}
