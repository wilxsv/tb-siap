<?php

//src/Minsal/CitasBundle/Controller/CitJustificacionController.php

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
use \Doctrine\ORM\Query;

class CitJustificacionController extends Controller {
    /**
     * @Route("/citjustificacion/reprogramacion/get", name="get_justificacion_reprogramacion", options={"expose"=true})
     * @Method("GET")
     */
    public function getJustificacionReprogramacion() {
        $em      = $this->getDoctrine()->getManager();
        $request = $this->get('request');

        //Consulta a la tabla distribuciones para buscar registros para ese horario
        $dql = "SELECT t01.id,
                       t01.nombre
                FROM MinsalCitasBundle:CitJustificacion t01
                WHERE t01.idEstadoCita = 4
                ORDER BY t01.nombre";

        $result = $em->createQuery($dql)
                     ->getArrayResult();

        return new Response(json_encode($result));
    }
}
