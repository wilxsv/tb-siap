<?php
namespace Application\CoreBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;


class MntUserTourAdminController extends Controller {

    /**
     * return the Response object associated to the create action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function createAction()
    {
        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        $request = $this->get('request');
        $creationType = $request->get('creationType') ? $request->get('creationType') : 'normal-mode';

        if( $creationType === 'visual-mode' ){
            if ($this->getRestMethod()== 'POST') {

                try {
                    $object->setNombre( $request->get('userTourName') );
                    $object->setRoute( $request->get('userTourRoute') ? $request->get('userTourRoute') : null );
                    $object->setActivo( $request->get('userTourActive') ? ( $request->get('userTourActive') == 'true' ? true : false ) : false );
                    $object->setObjectName( $request->get('userTourObjectName') ? $request->get('userTourObjectName') : null  );
                    $object->setContainer( $request->get('userTourContainer') ? $request->get('userTourContainer') : 'body'  );
                    $object->setKeyboard( $request->get('userTourKeyboard') ? $request->get('userTourKeyboard') : 'true' );
                    $object->setAutoscroll( $request->get('userTourAutoscroll') ?  $request->get('userTourAutoscroll') : 'true' );
                    $object->setBackdrop( $request->get('userTourBackdrop') ? $request->get('userTourBackdrop') : 'true' );
                    $object->setBackdropcontainer( $request->get('userTourBackdropContainer') ? $request->get('userTourBackdropContainer') : 'body' );
                    $object->setBackdroppadding( $request->get('userTourBackdropPadding') ? $request->get('userTourBackdropPadding') : '0' );
                    $object->setOrphan( $request->get('userTourOrphan') ? $request->get('userTourOrphan') : 'false' );
                    $object->setDuration( $request->get('userTourEnableDuration') ? ( $request->get('userTourEnableDuration') == 'true' ? $request->get('userTourDuration') : 'false' ) : 'false' );
                    $object->setTemplate( $request->get('userTourTemplate') ? $request->get('userTourTemplate') : null );
                    $object->setFechaHoraregistro( new \DateTime() );

                    //$resultData['success'] = 'true '.(count($object->getTourSteps()));
                    $this->admin->create($object);

                    $resultData['success'] = 'true';
                    $resultData['id'] = $object->getId();
                    return new Response(json_encode($resultData));

                } catch (\Exception $e) {
                    $resultData['success'] = 'false';
                    $resultData['error'] = ' '.$e;
                    $resultData['id'] = null;
                    return new Response(json_encode($resultData));
                }

            }
        }else{
            if ($this->getRestMethod()== 'POST') {
                $form->submit($this->get('request'));
                /* Codigo de Admin Normal */

            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
            'action' => 'create',
            'form'   => $view,
            'object' => $object,
        ));
    }

}
