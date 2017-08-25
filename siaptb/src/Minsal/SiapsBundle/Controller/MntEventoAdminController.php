<?php

namespace Minsal\SiapsBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Minsal\SiapsBundle\Entity\MntEvento as Evento;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;


class MntEventoAdminController extends CRUDController {

    /**
    * return the Response object associated to the create action
    *
    * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
    * @return Response
    */
    public function createAction() {
        // the key used to lookup the template
        $templateKey = 'edit';

        if (false === $this->admin->isGranted('CREATE')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
        }

        $em = $this->getDoctrine()->getManager();

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);
        //Obtener datos del usuario
        $idusuarioreg = $this->container->get('security.context')->getToken()->getUser();
        $idAreaModEstab=NULL;
        if (!$idusuarioreg->hasRole('ROLE_SUPER_ADMIN')) {
            $idEmpleado = $idusuarioreg->getIdEmpleado()->getId();
            $dql = "SELECT A
                  FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab A
                  JOIN A.idEmpleado B
                  WHERE B.id=$idEmpleado";
            $AreaModEstab = $em
                    ->createQuery($dql)
                    ->getResult();
            $idAreaModEstab = $AreaModEstab[0]->getIdAreaModEstab();
        }

        if ($this->getRestMethod()== 'POST') {
            $form->submit($this->get('request'));

            $isFormValid = $form->isValid();

            $fechahorareg = new \DateTime();
            $idAreaModEstab = $object->getIdAreaModEstab();
            $idTipoevento = $object->getIdTipoEvento()->getId();
            $establecimiento = $em->getRepository("MinsalSiapsBundle:CtlEstablecimiento")->obtenerEstablecimientoConfigurado();
            //Modulo de citas id=4
            $idModulo = $em->getRepository('MinsalSiapsBundle:CtlModulo')->findOneById(4);

            $duracion = $this->admin->getForm()->get('duracion')->getData();
            list($fecha_hora_inicio, $fecha_hora_fin) = explode(' - ', $duracion);

            $fecha_hora_inicio = \DateTime::createFromFormat('d/m/Y h:i A', $fecha_hora_inicio);
            $fecha_hora_fin = \DateTime::createFromFormat('d/m/Y h:i A', $fecha_hora_fin);

            //$todas_las_especialidades = $this->admin->getForm()->get('todas_especialidades')->getData();
            $todos_los_medicos = $this->admin->getForm()->get('todos_los_medicos')->getData();
            $aplicacionEvento = $this->admin->getForm()->get('aplicacionEvento')->getData();
            $idProcedimientoEstablecimiento = $this->admin->getForm()->get('idProcedimientoEstablecimiento')->getData();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {

                if (false === $this->admin->isGranted('CREATE', $object)) {
                    return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                    'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
                }
                $em->getConnection()->beginTransaction();
                try {
                    //if ($todas_las_especialidades == false and $object->getIdTipoevento()->getId()!='1') {
                    //  $idAtenAreaModEstab = $this->admin->getForm()->get('idAtenAreaModEstab')->getData();

                    if ($todos_los_medicos == false and $aplicacionEvento != 'ambos') { //cuando sean eventos con médicos seleccionados
                        $medicos = $this->admin->getForm()->get('idEmpleadoMultiple')->getData();
                        foreach ($medicos as $medico) {
                            if ($aplicacionEvento == 'med' ){
                                $evento = new Evento();
                                $evento->setIdTipoEvento($object->getIdTipoEvento());
                                $evento->setIdAreaModEstab($idAreaModEstab);
                                $evento->setNombre($object->getNombre());
                                $evento->setDescripcion($object->getDescripcion());
                                $evento->setFechaHoraIni($fecha_hora_inicio);
                                $evento->setFechaHoraFin($fecha_hora_fin);
                                $evento->setIdEmpleado($medico);
                                $evento->setFechahorareg($fechahorareg);
                                $evento->setIdusuarioreg($idusuarioreg);
                                $evento->setIdEstablecimiento($establecimiento);
                                $evento->setIdModulo($idModulo);
                                $this->admin->create($evento);
                            }
                            if($aplicacionEvento == 'proc'){
                                $evento = new Evento();
                                $evento->setIdTipoEvento($object->getIdTipoEvento());
                                $evento->setIdAreaModEstab($idAreaModEstab);
                                $evento->setNombre($object->getNombre());
                                $evento->setDescripcion($object->getDescripcion());
                                $evento->setFechaHoraIni($fecha_hora_inicio);
                                $evento->setFechaHoraFin($fecha_hora_fin);
                                $evento->setIdEmpleado($medico);
                                $evento->setFechahorareg($fechahorareg);
                                $evento->setIdusuarioreg($idusuarioreg);
                                $evento->setIdEstablecimiento($establecimiento);
                                $evento->setIdModulo($idModulo);
                                $evento->setEsEventoMedico(false);
                                $evento->setIdProcedimientoEstablecimiento($idProcedimientoEstablecimiento);
                                $this->admin->create($evento);
                            }
                        }
                    } else {//No hay médicos seleccionados
                        if ($aplicacionEvento == 'med' or $aplicacionEvento == 'ambos'){
                            $evento = new Evento();
                            $evento->setIdTipoEvento($object->getIdTipoEvento());
                            $evento->setNombre($object->getNombre());
                            $evento->setDescripcion($object->getDescripcion());
                            $evento->setFechaHoraIni($fecha_hora_inicio);
                            $evento->setFechaHoraFin($fecha_hora_fin);
                            $evento->setFechahorareg($fechahorareg);
                            $evento->setIdusuarioreg($idusuarioreg);
                            $evento->setIdEstablecimiento($establecimiento);
                            $evento->setIdModulo($idModulo);
                            $this->admin->create($evento);
                        }

                        if($aplicacionEvento == 'proc' or $aplicacionEvento == 'ambos'){
                            if($idProcedimientoEstablecimiento == 'todos'){//No hay procedimiento seleccionado
                                $evento = new Evento();
                                $evento->setIdTipoEvento($object->getIdTipoEvento());
                                $evento->setNombre($object->getNombre());
                                $evento->setDescripcion($object->getDescripcion());
                                $evento->setFechaHoraIni($fecha_hora_inicio);
                                $evento->setFechaHoraFin($fecha_hora_fin);
                                $evento->setFechahorareg($fechahorareg);
                                $evento->setIdusuarioreg($idusuarioreg);
                                $evento->setIdEstablecimiento($establecimiento);
                                $evento->setIdModulo($idModulo);
                                $evento->setEsEventoMedico(false);
                                $this->admin->create($evento);
                            }else {
                                $evento = new Evento();
                                $evento->setIdTipoEvento($object->getIdTipoEvento());
                                $evento->setNombre($object->getNombre());
                                $evento->setDescripcion($object->getDescripcion());
                                $evento->setFechaHoraIni($fecha_hora_inicio);
                                $evento->setFechaHoraFin($fecha_hora_fin);
                                $evento->setFechahorareg($fechahorareg);
                                $evento->setIdusuarioreg($idusuarioreg);
                                $evento->setIdEstablecimiento($establecimiento);
                                $evento->setIdProcedimientoEstablecimiento($idProcedimientoEstablecimiento);
                                $evento->setIdModulo($idModulo);
                                $evento->setEsEventoMedico(false);
                                $this->admin->create($evento);
                            }
                        }
                    }

                $em->getConnection()->commit();
            } catch (\Exception $e) {
                $em->getConnection()->rollback();

                $this->addFlash('sonata_flash_error', $e);
                throw $e;
            }

            if ($this->isXmlHttpRequest()) {
                return $this->renderJson(array(
                    'result' => 'ok',
                    'objectId' => $this->admin->getNormalizedIdentifier($object)
                ));
            }

            $this->addFlash('sonata_flash_success', $this->admin->trans('flash_create_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));

            // redirect to edit mode
            return $this->redirectTo($object);
        }

        // show an error message if the form failed validation
        if (!$isFormValid) {
            if (!$this->isXmlHttpRequest()) {
                $this->addFlash('sonata_flash_error', $this->admin->trans('flash_create_error', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
            }
        } elseif ($this->isPreviewRequested()) {
            // pick the preview template if the form was valid and preview was requested
            $templateKey = 'preview';
            $this->admin->getShow();
        }
    }

    $view = $form->createView();

    // set the theme for the current Admin Form
    $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

    return $this->render($this->admin->getTemplate($templateKey), array(
        'action' => 'create',
        'form' => $view,
        'object' => $object,
        'cantMedicos' => null,
        'idAreaModEstab' => $idAreaModEstab
    ));
}

/**
* return the Response object associated to the edit action
*
*
* @param mixed $id
*
* @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
* @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
*
* @return Response
*/
public function editAction($id = null) {
    // the key used to lookup the template
    $templateKey = 'edit';

    $id = $this->get('request')->get($this->admin->getIdParameter());
    $object = $this->admin->getObject($id);

    if (!$object) {
        throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
    }

    if (false === $this->admin->isGranted('EDIT', $object)) {
        return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
    }

    $this->admin->setSubject($object);

    /** @var $form \Symfony\Component\Form\Form */
    $form = $this->admin->getForm();
    $form->setData($object);

    if($object->getEsEventoMedico())
        $eventoMedico = "true";
    else {
        $eventoMedico = "false";
    }
    $em = $this->getDoctrine()->getManager();
    $dql = "SELECT d.id as idEvento, e.id,e.nombreempleado as text
    FROM MinsalSiapsBundle:MntEvento d
    LEFT JOIN d.idEmpleado e
    WHERE d.nombre = '".$object->getNombre(). "' AND d.fechaHoraIni='".$object->getFechaHoraIni()->format('Y-m-d H:i')."' AND d.fechaHoraFin='".$object->getFechaHoraFin()->format('Y-m-d H:i')."' AND d.esEventoMedico=".$eventoMedico;
    $resultados= $em->createQuery($dql)->getArrayResult();

    $medicos='[';
    foreach ($resultados as $resul){
        $medicos.=$resul['id'].',';
    }
    $medicos.=']';

    if($medicos == '[,]')
        $medicos = null;

    //Modulo de citas id=4
    $idModulo = $em->getRepository('MinsalSiapsBundle:CtlModulo')->findOneById(4);

    $duracion = date_format($object->getFechaHoraIni(), 'd/m/Y h:i A').' - '.date_format($object->getFechaHoraFin(), 'd/m/Y h:i A');
    $fecha_hora_inicio = date_format($object->getFechaHoraIni(), 'd/m/Y H:i A');

    $idusuarioreg = $this->container->get('security.context')->getToken()->getUser();
    $idAreaModEstab=NULL;
    if (!$idusuarioreg->hasRole('ROLE_SUPER_ADMIN')) {
        $idEmpleado = $idusuarioreg->getIdEmpleado()->getId();
        $dql = "SELECT A
              FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab A
              JOIN A.idEmpleado B
              WHERE B.id=$idEmpleado";
        $AreaModEstab = $em
                ->createQuery($dql)
                ->getResult();
        $idAreaModEstab = $AreaModEstab[0]->getIdAreaModEstab();
    }

    if ($this->getRestMethod() == 'POST') {
        $form->submit($this->get('request'));

        $isFormValid = $form->isValid();

        $fechahoramod = new \DateTime();
        $idusuariomod = $this->container->get('security.context')->getToken()->getUser();
        $idAreaModEstab = $object->getIdAreaModEstab();
        $idTipoevento = $object->getIdTipoEvento()->getId();
        $establecimiento = $em->getRepository("MinsalSiapsBundle:CtlEstablecimiento")->obtenerEstablecimientoConfigurado();

        $duracion = $this->admin->getForm()->get('duracion')->getData();
        list($fecha_hora_inicio, $fecha_hora_fin) = explode(' - ', $duracion);

        $fecha_hora_inicio = \DateTime::createFromFormat('d/m/Y h:i A', $fecha_hora_inicio);
        $fecha_hora_fin = \DateTime::createFromFormat('d/m/Y h:i A', $fecha_hora_fin);

        $todos_los_medicos = $this->admin->getForm()->get('todos_los_medicos')->getData();
        $aplicacionEvento = $this->admin->getForm()->get('aplicacionEvento')->getData();
        $idProcedimientoEstablecimiento = $this->admin->getForm()->get('idProcedimientoEstablecimiento')->getData();

        // persist if the form was valid and if in preview mode the preview was approved
        if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {

            $em->getConnection()->beginTransaction();
            try {
                if ($todos_los_medicos == false) {
                    //Se recorren los eventos con esos médicos para eliminarlos
                    foreach ($resultados as $linea_resultado) {
                        if($linea_resultado['id'] != null){
                            $evento = $em->getRepository("MinsalSiapsBundle:MntEvento");
                            $registro = $evento->find($linea_resultado['idEvento']);
                            $em->remove($registro);
                            $flush=$em->flush();
                        }
                    }
                    //Obtener los médicos que vienen del formulario de edición
                    $medicos = $this->admin->getForm()->get('idEmpleadoMultiple')->getData();

                    foreach ($medicos as $medico) {
                        $evento = new Evento();
                        $evento->setIdTipoEvento($object->getIdTipoEvento());
                        $evento->setIdAreaModEstab($idAreaModEstab);
                        $evento->setNombre($object->getNombre());
                        $evento->setDescripcion($object->getDescripcion());
                        $evento->setFechaHoraIni($fecha_hora_inicio);
                        $evento->setFechaHoraFin($fecha_hora_fin);
                        $evento->setIdEmpleado($medico);
                        $evento->setFechahorareg($fechahoramod);
                        $evento->setIdusuarioreg($idusuariomod);
                        $evento->setIdEstablecimiento($establecimiento);
                        $evento->setIdModulo($idModulo);
                        if($aplicacionEvento == 'proc'){
                            $evento->setEsEventoMedico(false);
                            $evento->setIdProcedimientoEstablecimiento($idProcedimientoEstablecimiento);
                        }
                        $this->admin->create($evento);
                    }
                } else {
                    $object->setIdTipoEvento($object->getIdTipoEvento());
                    $object->setNombre($object->getNombre());
                    $object->setDescripcion($object->getDescripcion());
                    $object->setFechaHoraIni($fecha_hora_inicio);
                    $object->setFechaHoraFin($fecha_hora_fin);
                    $object->setFechahoramod($fechahoramod);
                    $object->setIdusuariomod($idusuariomod);
                    $object->setIdEstablecimiento($establecimiento);
                    $object->setIdModulo($idModulo);
                    if($aplicacionEvento == 'proc'){
                        $object->setEsEventoMedico(false);
                        if($idProcedimientoEstablecimiento != 'todos'){
                            $object->setIdProcedimientoEstablecimiento($idProcedimientoEstablecimiento);
                        }
                    }
                    $this->admin->update($object);
                }

                $em->getConnection()->commit();
            } catch (\Exception $e) {
                $em->getConnection()->rollback();

                $this->addFlash('sonata_flash_error', $e);
                throw $e;
            }

            if ($this->isXmlHttpRequest()) {
                return $this->renderJson(array(
                    'result' => 'ok',
                    'objectId' => $this->admin->getNormalizedIdentifier($object)
                ));
            }

            $this->addFlash('sonata_flash_success', $this->admin->trans('flash_edit_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));

            // redirect to edit mode
            return $this->redirectTo($object);
        }

        // show an error message if the form failed validation
        if (!$isFormValid) {
            if (!$this->isXmlHttpRequest()) {
                $this->addFlash('sonata_flash_error', $this->admin->trans('flash_edit_error', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
            }
        } elseif ($this->isPreviewRequested()) {
            // enable the preview template if the form was valid and preview was requested
            $templateKey = 'preview';
            $this->admin->getShow();
        }
    }

    $view = $form->createView();

    // set the theme for the current Admin Form
    $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

    return $this->render($this->admin->getTemplate($templateKey), array(
        'action' => 'edit',
        'form' => $view,
        'object' => $object,
        'medicos' => $medicos,
        'duracion_evento' => $duracion,
        'fecha_hora_inicio' => $fecha_hora_inicio,
        'idAreaModEstab' => $idAreaModEstab,
    ));
}

/**
* return the Response object associated to the list action
*
* @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
*
* @return Response
*/
public function listAction() {
    if (false === $this->admin->isGranted('LIST')) {
        return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
    ));
}
$em = $this->getDoctrine()->getManager();
$areas = $em->getRepository("MinsalSiapsBundle:MntAreaModEstab")->findBy(array('idAreaAtencion' => 1));
$tipo_eventos = $em->getRepository("MinsalSiapsBundle:MntTipoEvento")->findBy(array(),array('nombre' => 'ASC'));
$procedimientosEstablecimiento = $em->getRepository("MinsalSiapsBundle:MntProcedimientoEstablecimiento")->findBy(array(),array('idCiq' => 'ASC'));

$datagrid = $this->admin->getDatagrid();
$formView = $datagrid->getForm()->createView();

$idAreaModEstab = '';
$idusuarioreg = $this->container->get('security.context')->getToken()->getUser();

if (!$idusuarioreg->hasRole('ROLE_SUPER_ADMIN')) {
    $idEmpleado = $idusuarioreg->getIdEmpleado()->getId();
    $dql = "SELECT A
          FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab A
          JOIN A.idEmpleado B
          WHERE B.id=$idEmpleado";
    $AreaModEstab = $em
            ->createQuery($dql)
            ->getResult();
    $idAreaModEstab = $AreaModEstab[0]->getIdAreaModEstab();
}

// set the theme for the current Admin Form
$this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

return $this->render($this->admin->getTemplate('list'), array(
    'action' => 'list',
    'form' => $formView,
    'datagrid' => $datagrid,
    'csrf_token' => $this->getCsrfToken('sonata.batch'),
    'areas' => $areas,
    'idAreaModEstab'=> $idAreaModEstab,
    'tipo_eventos' => $tipo_eventos,
    'procedimientos' => $procedimientosEstablecimiento,
));
}

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
        return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
    }

    $this->admin->setSubject($object);

    $em = $this->getDoctrine()->getManager();
    $dql = "SELECT d.id as idEvento,e.id as idEmpleado,e.nombreempleado as nombreEmpleado
    FROM MinsalSiapsBundle:MntEvento d
    LEFT JOIN d.idEmpleado e
    WHERE d.nombre = '".$object->getNombre(). "' AND d.fechaHoraIni='".$object->getFechaHoraIni()->format('Y-m-d')
    ."' AND d.fechaHoraFin='".$object->getFechaHoraFin()->format('Y-m-d')."'";
    $medicos= $em->createQuery($dql)->getResult();

    return $this->render($this->admin->getTemplate('show'), array(
        'action'   => 'show',
        'object'   => $object,
        'elements' => $this->admin->getShow(),
        'medicos' => $medicos
    ));
}

    /**
    * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException|\Symfony\Component\Security\Core\Exception\AccessDeniedException
    *
    * @param mixed $id
    *
    * @return Response|RedirectResponse
    */
    public function deleteAction($id=null)
    {
        $id     = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('DELETE', $object)) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
        }

        if ($this->getRestMethod() == 'DELETE') {
            // check the csrf token
            $this->validateCsrfToken('sonata.delete');

            try {
                $em = $this->getDoctrine()->getManager();
                $dql = "SELECT d
                FROM MinsalSiapsBundle:MntEvento d
                WHERE d.nombre = '".$object->getNombre(). "' AND d.fechaHoraIni='".$object->getFechaHoraIni()->format('Y-m-d H:i')."' AND d.fechaHoraFin='".$object->getFechaHoraFin()->format('Y-m-d H:i')."'";
                $eventos= $em->createQuery($dql)->getResult();

                $em->getConnection()->beginTransaction();
                try {
                    foreach ($eventos as $evento) {
                        $this->admin->delete($evento);
                    }
                    $em->getConnection()->commit();
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();

                    $this->addFlash('sonata_flash_error', $e);
                    throw $e;
                }

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array('result' => 'ok'));
                }

                $this->addFlash(
                'sonata_flash_success',
                $this->admin->trans(
                'flash_delete_success',
                array('%name%' => $this->admin->toString($object)),
                'SonataAdminBundle'
                )
            );

        } catch (ModelManagerException $e) {

            if ($this->isXmlHttpRequest()) {
                return $this->renderJson(array('result' => 'error'));
            }

            $this->addFlash(
            'sonata_flash_error',
            $this->admin->trans(
            'flash_delete_error',
            array('%name%' => $this->admin->toString($object)),
            'SonataAdminBundle'
            )
        );
    }

    return new RedirectResponse($this->admin->generateUrl('list'));
    }

    return $this->render($this->admin->getTemplate('delete'), array(
        'object'     => $object,
        'action'     => 'delete',
        'csrf_token' => $this->getCsrfToken('sonata.delete')
    ));
    }

}
