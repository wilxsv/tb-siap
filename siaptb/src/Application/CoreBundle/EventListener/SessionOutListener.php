<?php
namespace Application\CoreBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\CredentialsExpiredException;

class SessionOutListener {

    protected $session;
    protected $securityContext;
    protected $router;
    protected $maxIdleTime;

    public function __construct(SessionInterface $session, SecurityContextInterface $securityContext, RouterInterface $router, $maxIdleTime = 0) {
        $this->session         = $session;
        $this->securityContext = $securityContext;
        $this->router          = $router;
        $this->maxIdleTime     = $maxIdleTime;
    }

    public function onKernelRequest(GetResponseEvent $event) {
        $request = $event->getRequest();
        $_route  = $request->attributes->get('_route');

        if($this->securityContext->getToken() !== null &&  $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            if(!$this->session->has('lastUsed')) {
                $this->session->set('lastUsed', $this->session->getMetadataBag()->getLastUsed());
            }

            if($_route !== "siapsTimeInfo") {
                $this->session->set('lastUsed', $this->session->getMetadataBag()->getLastUsed());
            }

            if ($this->maxIdleTime > 0) {

                $this->session->start();
                $lapse = time() - $this->session->get('lastUsed');

                if ($lapse > $this->maxIdleTime) {
                    $redirect = $this->router->generate('sonata_user_admin_security_login', array('_moduleSelection' => $this->session->get('_moduleSelection') ) );
                    $this->securityContext->setToken(null);
                    $this->session->invalidate();
                    $this->session->remove('endedSession');
                    $this->session->getFlashBag()->add('session_expired_warning', 'La sesion ha sido cerrada por inactividad.');
                    $event->setResponse(new RedirectResponse($redirect));
                }
            }
        } else {
            if($_route === "siapsTimeInfo") {
                if(!$this->session->getFlashBag()->has('session_expired_warning')) {
                    $this->session->getFlashBag()->add('session_expired_warning', 'La sesion ha sido cerrada por inactividad.');
                }
            }
        }
    }
}
