<?php

namespace Minsal\SeguimientoBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

class SecSolicitudQuirurgicaAdminController extends CRUDController
{
    /**
     * return the Response object associated to the view action
     *
     * @param null $id
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return Response
     */
    public function showAction($id = null)
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('VIEW', $object)) {
            throw new AccessDeniedException();
        }

        $this->admin->setSubject($object);

        $em  = $this->getDoctrine()->getManager();
        $dql = "SELECT A FROM MinsalSeguimientoBundle:SecSolicitudQuirurgicaAptitud A WHERE A.idSolicitudQuirurgica = :idSolicitudQuirurgica ORDER BY A.fechaHoraRegistro DESC";
        $solicitudQuirurgicaAptitudResult = $em->createQuery($dql)->setParameter('idSolicitudQuirurgica', $object->getId())->getResult();

        return $this->render($this->admin->getTemplate('show'), array(
            'action'   => 'show',
            'object'   => $object,
            'elements' => $this->admin->getShow(),
            'aptitudes'=> $solicitudQuirurgicaAptitudResult
        ));
    }
}
