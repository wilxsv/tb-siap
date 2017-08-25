<?php

namespace Application\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Application\CoreBundle\Entity\MntUserTour;
use Application\CoreBundle\Entity\MntUserTourStep;

class MntUserTourController extends Controller {

    /**
    * @Route("/create/tourstep", name="createtourstep", options={"expose"=true})
    * @Method("POST")
    */
    public function createTourStepAction() {

        $em      = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $tourId  = $request->get('tourId');
        $tour    = $em->getRepository('ApplicationCoreBundle:MntUserTour')->findOneBy( array( 'id' => $tourId ) );
        $step    = new MntUserTourStep();

        try {

            $step->setIdUserTour($tour);
            $step->setElement( $request->get('stepSelector') ? $request->get('stepSelector') : '' );
            $step->setPlacement( $request->get('userTourStepPlacement') ? $request->get('userTourStepPlacement') : 'right' );
            $step->setTitle( $request->get('userTourStepTitle') ? $request->get('userTourStepTitle') : '' );
            $step->setContent( $request->get('userTourStepContent') ? $request->get('userTourStepContent') : '' );
            $step->setAnimation( $request->get('userTourStepAnimation') ? $request->get('userTourStepAnimation') : 'true' );
            $step->setContainer( $request->get('userTourStepContainer') ? $request->get('userTourStepContainer') : 'body' );
            $step->setBackdrop( $request->get('userTourStepBackdrop') ? $request->get('userTourStepBackdrop') : 'true' );
            $step->setBackdropcontainer( $request->get('userTourStepBackdropContainer') ? $request->get('userTourStepBackdropContainer') : 'body' );
            $step->setBackdroppadding( $request->get('userTourStepBackdropPadding') ? $request->get('userTourStepBackdropPadding') : '0' );
            $step->setOrphan( $request->get('userTourStepOrphan') ? $request->get('userTourStepOrphan') : 'false' );
            $step->setDuration( $request->get('userTourStepDuration') ? $request->get('userTourStepDuration') : 'false' );
            $step->setOrden( ( $request->get('userTourStepOrden') || $request->get('userTourStepOrden') === "0" ) ? $request->get('userTourStepOrden') : null );
            $step->setTemplate( $request->get('userTourStepTemplate') ? $request->get('userTourStepTemplate') : null );

            $em->persist($step);
            $em->flush();

            $result['success'] = 'true';
            $result['id'] = $step->getId();

        } catch (\Exception $e) {

            $result['id'] = null;
            $result['success'] = false;
            $result['error'] = '' . $e;
            return new Response(json_encode($result));

        }
        return new Response(json_encode($result));

    }
}
