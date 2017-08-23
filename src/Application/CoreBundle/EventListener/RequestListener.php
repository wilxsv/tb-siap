<?php
namespace Application\CoreBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class RequestListener
{
    protected $securityContext;
    protected $router;
    protected $session;

    public function __construct(SecurityContextInterface $securityContext, RouterInterface $router, Session $session = NULL)
    {
        $this->securityContext = $securityContext;
        $this->router = $router;
        $this->session = $session;
    }

    public function onRouteRequest(GetResponseEvent $event)
    {
        if($this->securityContext->getToken() instanceof UsernamePasswordToken) {
            $request = $event->getRequest();
            $_route  = $request->attributes->get('_route');

            if($_route !== 'verify_medic_service' && $_route !== 'set_emp_especialidad_estab' && $_route !== 'sonata_user_admin_security_logout') {
                $user           = $this->securityContext->getToken()->getUser();
                $codigoEmpleado = $codigoEmpleado = $user->getIdEmpleado() ? ($user->getIdEmpleado()->getIdTipoEmpleado() !== null ? $user->getIdEmpleado()->getIdTipoEmpleado()->getCodigo() : 'N/A') : 'N/A';

                if(strtoupper($codigoEmpleado) === 'MED' && $this->session->get('_moduleSelection') !== null && $this->session->get('_idEmpEspecialidadEstab') === null) {
                    $event->setResponse( new RedirectResponse( $this->router->generate( 'verify_medic_service' ) ) );
                } else {
                    if(($_route == "sonata_user_admin_security_login")) {
                        $event->setResponse( new RedirectResponse( $this->router->generate( 'sonata_admin_dashboard' ) ) );
                    }
                }
            }
        }
    }
}
