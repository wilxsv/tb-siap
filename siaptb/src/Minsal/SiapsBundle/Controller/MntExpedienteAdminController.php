<?php

namespace Minsal\SiapsBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

class MntExpedienteAdminController extends Controller {

    public function listAction() {
        if (false === $this->admin->isGranted('LIST')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }
        $em = $this->getDoctrine()->getManager();
        $establecimiento = $em->getRepository("MinsalSiapsBundle:CtlEstablecimiento")->obtenerEstablecimientoConfigurado();

        return $this->render($this->admin->getTemplate('list'), array(
                    'action' => 'list',
                    'establecimiento' => $establecimiento
        ));
    }

    public function listarexpedientesAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if ($user->hasRole('ROLE_USER_LISTAREXPEDIENTES') === false && $user->hasRole('ROLE_SUPER_ADMIN') === false) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        return $this->render($this->admin->getTemplate('listarexpedientes'), array(
                    'action' => 'listarexpedientes'
        ));
    }

    public function listarexpedientesPorAnioAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if ($user->hasRole('ROLE_USER_LISTAREXPEDIENTES') === false && $user->hasRole('ROLE_SUPER_ADMIN') === false) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        return $this->render($this->admin->getTemplate('listarexpedientes_por_anio'), array(
                    'action' => 'list'
        ));
    }

    public function listarexpedientesPorCorrelativoAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if ($user->hasRole('ROLE_USER_LISTAREXPEDIENTES') === false && $user->hasRole('ROLE_SUPER_ADMIN') === false) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $sql = "SELECT COUNT(mnt_expediente.id) cuantos,'20'||split_part(numero,'-',2) anio
                FROM mnt_expediente
                WHERE  numero_temporal =FALSE AND CUN=FALSE
                GROUP BY '20'||split_part(numero,'-',2)
                ORDER BY anio";
        $resultados = $conn->query($sql);
        $resultados = $resultados->fetchAll();


        return $this->render($this->admin->getTemplate('listarexpedientes_por_correlativo'), array(
                    'action' => 'list',
                    'expedientes'=>$resultados
        ));
    }

    public function depuracionAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if ($user->hasRole('ROLE_USER_DEPURACION') === false && $user->hasRole('ROLE_SUPER_ADMIN') === false) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        return $this->render($this->admin->getTemplate('depuracion'), array(
                    'action' => 'list'
        ));
    }

    public function reporteDepuracionAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if ($user->hasRole('ROLE_USER_DEPURACION') === false && $user->hasRole('ROLE_SUPER_ADMIN') === false) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        return $this->render($this->admin->getTemplate('reporteDepuracion'), array(
                    'action' => 'list'
        ));
    }

}
