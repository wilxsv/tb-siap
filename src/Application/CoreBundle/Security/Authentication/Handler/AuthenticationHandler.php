<?php

//Application/CoreBundle/Security/Authentication/Handler/AuthenticationHandler.php

namespace Application\CoreBundle\Security\Authentication\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface {

    protected $httpKernel;
    protected $httpUtils;
    protected $logger;
    protected $options;
    protected $providerKey;
    private $container;
    protected $entityManager;

    /**
     * Constructor.
     *
     * @param HttpKernelInterface $httpKernel
     * @param HttpUtils           $httpUtils
     * @param array               $options    Options for processing a failed authentication attempt.
     * @param LoggerInterface     $logger     Optional logger
     */
    public function __construct(HttpKernelInterface $httpKernel, HttpUtils $httpUtils, LoggerInterface $logger = null, array $options, Container $container) {
        $this->httpKernel = $httpKernel;
        $this->httpUtils = $httpUtils;
        $this->logger = $logger;
        $this->container = $container;

        $this->entityManager = $this->container->get('doctrine.orm.entity_manager');

        $this->options = array_merge(array(
            'failure_path' => null,
            'failure_forward' => false,
            'login_path' => '/admin/login',
            'failure_path_parameter' => '_failure_path',
            'always_use_default_target_path' => true,
            'default_target_path' => '/admin/dashboard',
            'target_path_parameter' => '_target_path',
            'use_referer' => true,
                ), $options);

        if (!array_key_exists('login_path', $this->options)) {
            $this->options = array_merge(array('login_path' => '/admin/login'), $this->options);
        }

        if (!array_key_exists('default_target_path', $this->options)) {
            $this->options = array_merge(array('default_target_path' => '/admin/dashboard'), $this->options);
        }

        if (!array_key_exists('after_login_path', $this->options)) {
            $this->options = array_merge(array('after_login_path' => null), $this->options);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
        if ($failureUrl = $request->get($this->options['failure_path_parameter'], null, true)) {
            $this->options['failure_path'] = $failureUrl;
        }

        if (null === $this->options['failure_path']) {
            $this->options['failure_path'] = $this->options['login_path'];
        }

        if ($this->options['failure_forward']) {
            if (null !== $this->logger) {
                $this->logger->debug(sprintf('Forwarding to %s', $this->options['failure_path']));
            }

            $subRequest = $this->httpUtils->createRequest($request, $this->options['failure_path']);
            $subRequest->attributes->set(SecurityContextInterface::AUTHENTICATION_ERROR, $exception);

            return $this->httpKernel->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
        }

        if (null !== $this->logger) {
            $this->logger->debug(sprintf('Redirecting to %s', $this->options['failure_path']));
        }

        $request->getSession()->set(SecurityContextInterface::AUTHENTICATION_ERROR, $exception);

        return $this->httpUtils->createRedirectResponse($request, $this->options['failure_path']);
    }

    /**
     * {@inheritDoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
        $request->getSession()->set('_moduleSelection', $this->options['_moduleSelection']);
        $dql = "SELECT mu 
                 FROM MinsalSiapsBundle:MntManualUsuario mu
                 JOIN mu.idModulo m
                 WHERE mu.activo=true AND m.ordenMenuSiap =" . $this->options['_moduleSelection'];

        $query = $this->entityManager->createQuery($dql);
        $result = $query->getSingleResult();

        $request->getSession()->set('_manualUsuario', $result->getIdRutaManual());

        return $this->httpUtils->createRedirectResponse($request, $this->determineTargetUrl($request));
    }

    /**
     * Get the provider key.
     *
     * @return string
     */
    public function getProviderKey() {
        return $this->providerKey;
    }

    /**
     * Set the provider key.
     *
     * @param string $providerKey
     */
    public function setProviderKey($providerKey) {
        $this->providerKey = $providerKey;
    }

    /**
     * Builds the target URL according to the defined options.
     *
     * @param Request $request
     *
     * @return string
     */
    protected function determineTargetUrl(Request $request) {
        if ($this->options['after_login_path'] != null) {
            return $this->options['after_login_path'];
        }

        if ($this->options['always_use_default_target_path']) {
            return $this->options['default_target_path'];
        }

        if ($targetUrl = $request->get($this->options['target_path_parameter'], null, true)) {
            return $targetUrl;
        }

        if (null !== $this->providerKey && $targetUrl = $request->getSession()->get('_security.' . $this->providerKey . '.target_path')) {
            $request->getSession()->remove('_security.' . $this->providerKey . '.target_path');

            return $targetUrl;
        }

        if ($this->options['use_referer'] && ($targetUrl = $request->headers->get('Referer')) && $targetUrl !== $this->httpUtils->generateUri($request, $this->options['login_path'])) {
            return $targetUrl;
        }

        return $this->options['default_target_path'];
    }

}
