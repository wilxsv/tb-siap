<?php
namespace Minsal\SeguimientoBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL as DBAL;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
//use Minsal\SeguimientoBundle\Entity\TarPaciente;
//use Symfony\Component\Validator\Constraints;


class SecAntecedentesController extends Controller
{
    /**
     * @Route("/sec_antecedentes/leer/{idpaciente}/{idatenaremodestab}/{idExp}", name="sec_antecedentes_leer", options={"expose"=true})
     */
    public function leerAntecedenteAction($idpaciente, $idatenaremodestab, $idExp = '0')
    {
        $em = $this->getDoctrine()->getManager();
        if($idExp == '1'){
            $idpaciente = $em->getRepository('MinsalSiapsBundle:MntExpediente')->findOneBy(array('id'=>$idpaciente))->getIdPaciente()->getId();
        }
        $idantecedente = $em->getRepository('MinsalSeguimientoBundle:SecAntecedentes')
                    ->getIdPorEspecialidad($idpaciente, $idatenaremodestab);
        $jsonresponse = '{"idantecedente":"' . ($idantecedente?$idantecedente:0) . '"}';

        return new Response($jsonresponse);
    }

    /**
     * @Route("/sec_antecedentes/show/{id}/{idatenareamodestab}", name="sec_antecedentes_show", options={"expose"=true})
     */
    public function showAntecedenteAction($id, $idatenareamodestab)
    {
        $url = $this->generateUrl('admin_minsal_seguimiento_secantecedentes_showespe',array('id'=>$id, 'idatenareamodestab'=>$idatenareamodestab));
        return $this->redirect($url);
    }
}
