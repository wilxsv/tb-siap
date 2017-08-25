<?php
namespace Application\ApiBundle\Service;

use Doctrine\DBAL\Connection;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationServiceException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class ApiService {
	private $container;

	public function __construct($container = null) {
        $this->container = $container;
    }

    public function signIn($username, $password) {
        if( $username === NULL || $username === '' ) {
            throw new MissingOptionsException('El nombre de usuario no ha sido proporcionado');
        }

		if( $password === NULL || $password === '') {
            throw new MissingOptionsException('La contraseña no ha sido proporcionada');
        }

		$request = $this->container->get('request');
		$user    = $this->container->get('security.context')->getToken()->getUser();
		$em      = $this->container->get('doctrine')->getManager();
		$repo    = $em->getRepository("ApplicationSonataUserBundle:User");
		$session = $this->container->get('session');
		$data    = array('estado' => false, 'mensaje' => '', 'token' => null);

		if ($user instanceof UserInterface) {
			$data['mensaje'] = 'El usuario ya se encuentra autenticado';
        } else {
			$user = $repo->findOneByUsername($username);
			if (!$user) {
			    $data['mensaje'] = "El nombre de usuario '$username' no ha sido encontrado";
			} else {
				$userChecker    = $this->container->get('security.user_checker');
				$encoderFactory = $this->container->get('security.encoder_factory');

				try {
					$userChecker->checkPreAuth($user);
					if( !$encoderFactory->getEncoder($user)->isPasswordValid($user->getPassword(), $password, $user->getSalt()) ) {
						$data['mensaje'] = 'Credenciales no válidas.';
					}
					$userChecker->checkPostAuth($user);
				} catch (\Exception $e) {
					$data['mensaje'] = 'Credenciales no válidas, Detalle: '.$e->getMessage;
				}

				if( $data['mensaje'] === '' ) {
					$token = new UsernamePasswordToken($user, null, "admin", $user->getRoles());
				    $this->container->get("security.context")->setToken($token); //now the user is logged in

				    //now dispatch the login event
				    $event = new InteractiveLoginEvent($request, $token);
				    $this->container->get("event_dispatcher")->dispatch("security.interactive_login", $event);

					$guid = $this->createGuid();
					$now  = new \DateTime();

					$user->setGuid($guid);
					$user->setGuidCreatedAt($now);

					$em->persist($user);
					$em->flush();

					$data['token']  = $guid;
					$data['estado'] = true;

					if(!$session->has('_api_last_used')) {
		                $session->set('_api_last_used', $now->getTimestamp());
		            }
				}
			}
		}

		return $data;
    }

	public function signOut($guid) {
		try {
			$valid = $this->isValidGuid($guid);
		} catch (\Exception $e) {
			throw new AuthenticationServiceException('La GUID proporcionada no es válida, Detalle: '.$e->getMessage());
		}

		$data = array('estado' => true, 'mensaje' => 'Sesión de Usuario Finalizada con Éxito');

		if( $valid ) {
			$user = $this->getUserByGuid($guid);

			if($user) {
				try {
					$this->invalidateUser($user);
				} catch (\Exception $e) {
					throw new $e;
				}
			}
		}

		return $data;
	}

	public function isValidGuid($guid) {
		try {
			$user = $this->getUserByGuid($guid);
		} catch (\Exception $e) {
			throw new AuthenticationServiceException($e->getMessage());
		}

		$valid = false;

		if($user) {
			$idleTime = $this->container->hasParameter('api_idle_time') ? $this->container->getParameter('api_idle_time') : 0;
			$now      = new \DateTime();
			$session  = $this->container->get('session');
			$lastUsed = $session->get('_api_last_used');
			$interval = $now->getTimestamp() - $lastUsed;

			if( $interval > 0 && $interval < $idleTime ) {
				$valid = true;
				$session->set('_api_last_used', $now->getTimestamp());
			} else {
				try {
					$invalidateData = $this->invalidateUser($user);
				} catch (\Exception $e) {
					throw new $e;
				}
			}
		}

		return $valid;
	}

	public function isGranted($guid, $role) {
		$securityChecker = $this->container->get('security.context');
		$role            = strtoupper($role);
		$isGranted       = false;

		try {
			$valid = $this->isValidGuid($guid);
		} catch (\Exception $e) {
			throw new AuthenticationServiceException('La GUID proporcionada no es válida, Detalle: '.$e->getMessage());
		}
                return gettype($valid);
		if( $valid ) {
			$user = $this->getUserByGuid($guid);

			if($user) {
				if( $securityChecker->isGranted($role) || $user->hasRole($role) ) {
					$isGranted = true;
				}
			}
		}

		return $isGranted;
	}

	private function getUserByGuid($guid) {
		if( $guid === NULL || $guid === '') {
            throw new MissingOptionsException('El parámetro GUID no ha sido proporcionado');
        }

		$em   = $this->container->get('doctrine')->getManager();
		$user = $em->getRepository('ApplicationSonataUserBundle:User')->findOneByGuid($guid);

		return $user;
	}

	private function invalidateUser($user) {
		$securityContext = $this->container->get('security.context');
		$session = $this->container->get('session');
		$em      = $this->container->get('doctrine')->getManager();

		try {
			$user->setGuid(null);
			$user->setGuidCreatedAt(null);

			$em->persist($user);
			$em->flush();

			$securityContext->setToken(null);
			$session->invalidate();
		} catch (\Exception $e) {
			throw $e;
		}

		return true;
	}

	private function createGuid() {
	    if (function_exists('com_create_guid') === true)
	        return trim(com_create_guid(), '{}');

	    $data = openssl_random_pseudo_bytes(16);
	    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
	    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
	    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
	}
}
