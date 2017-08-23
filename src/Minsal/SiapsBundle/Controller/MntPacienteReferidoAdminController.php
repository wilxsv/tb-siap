<?php

namespace Minsal\SiapsBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

class MntPacienteReferidoAdminController extends CRUDController
{
    public function mostrarAction()
    {
        $id = $this->get('request')->get('id');

        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('LIST', $object)) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
        ));
        }

        $this->admin->setSubject($object);

        return $this->render($this->admin->getTemplate('mostrar'), array(
            'action'   => 'show',
            'object'   => $object,
            'elements' => $this->admin->getShow(),
        ));
    }

    public function buscarPacienteSiapAction()
    {
        $id = $this->get('request')->get('id');

        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('LIST', $object)) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
        ));
    }

    $this->admin->setSubject($object);

    return $this->render($this->admin->getTemplate('mostrar'), array(
        'action'   => 'show',
        'object'   => $object,
        'elements' => $this->admin->getShow(),
    ));
}


}
