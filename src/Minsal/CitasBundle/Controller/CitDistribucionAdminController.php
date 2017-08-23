<?php

namespace Minsal\CitasBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Minsal\CitasBundle\Entity\CitDistribucion as Distribucion;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CitDistribucionAdminController extends CRUDController {

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
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $object = $this->admin->getNewInstance();
        $em = $this->getDoctrine()->getManager();
        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);


        $request            = $this->get('request');
        $idAreaModEstab     = $request->get('idAreaModEstab') ? $request->get('idAreaModEstab') : NULL;
        $idAtenAreaModEstab = $request->get('idAtenAreaModEstab') ? $request->get('idAtenAreaModEstab') : NULL;
        $idEmpleado         = $request->get('idEmpleado') ? $request->get('idEmpleado') : NULL;
        $idusuarioreg       = $this->container->get('security.context')->getToken()->getUser();

        if ( !$idusuarioreg->hasRole('ROLE_SUPER_ADMIN') && $idAreaModEstab === NULL ) {
            $idEmpleado = $idusuarioreg->getIdEmpleado()->getId();
            $dql = "SELECT A
                  FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab A
                  JOIN A.idEmpleado B
                  WHERE B.id=$idEmpleado";
            $AreaModEstab = $em
                    ->createQuery($dql)
                    ->getResult();
            $idAreaModEstab = $AreaModEstab[0]->getIdAreaModEstab()->getId();
        }

        if ($this->getRestMethod() == 'POST') {
            $form->submit($this->get('request'));

            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {

                if (false === $this->admin->isGranted('CREATE', $object)) {
                    return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                                'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
                    ));
                }

                //Asignar el valor de activo para estado distribucion
                $estadoDistribucion = $em->getRepository("MinsalCitasBundle:CitEstadoDistribucion");
                $estadoDistribucion = $estadoDistribucion->find(1);

                $meses = $object->getMes();
                $dias  = $object->getDia();

                $fechahorareg       = new \DateTime();
                $idAreaModEstab     = $object->getIdAreaModEstab();
                $idAtenAreaModEstab = $object->getIdAtenAreaModEstab();
                $idEmpleado         = $object->getIdEmpleado();
                $idTipoDistribucion = $object->getIdTipoDistribucion();
                $yrs                = $object->getYrs();
                $idRangohora        = $object->getIdRangohora();
                $primera            = $object->getPrimera();
                $subsecuente        = $object->getSubsecuente();
                $maxCitasAgregadas  = $object->getMaxCitasAgregadas();
                $idConsultorio      = $object->getIdConsultorio();

                $em->getConnection()->beginTransaction();
                try {
                    foreach ($meses as $mes) {
                        if ($mes !== 13) {
                            foreach ($dias as $dia) {
                                if ($dia !== 8) {
                                    $distribucion = new Distribucion();
                                    $distribucion->setDia($dia);
                                    $distribucion->setMes($mes);
                                    $distribucion->setFechahorareg($fechahorareg);
                                    $distribucion->setIdAreaModEstab($idAreaModEstab);
                                    $distribucion->setIdAtenAreaModEstab($idAtenAreaModEstab);
                                    $distribucion->setIdConsultorio($idConsultorio);
                                    $distribucion->setIdEmpleado($idEmpleado);
                                    $distribucion->setIdRangohora($idRangohora);
                                    $distribucion->setIdTipoDistribucion($idTipoDistribucion);
                                    $distribucion->setIdusuarioreg($idusuarioreg);
                                    $distribucion->setMaxCitasAgregadas($maxCitasAgregadas);
                                    $distribucion->setPrimera($primera);
                                    $distribucion->setSubsecuente($subsecuente);
                                    $distribucion->setYrs($yrs);
                                    $distribucion->setIdEstadoDistribucion($estadoDistribucion);
                                    $this->admin->create($distribucion);
                                }
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


        return $this->render('MinsalCitasBundle:CitDistribucion:create.html.twig', array(
            'action'             => 'create',
            'form'               => $view,
            'object'             => $object,
            'idAreaModEstab'     => $idAreaModEstab,
            'idAtenAreaModEstab' => $idAtenAreaModEstab,
            'idEmpleado'         => $idEmpleado
        ));

    }

    protected function redirectTo($object) {
        $url = false;

        if (null !== $this->get('request')->get('btn_update_and_list')) {
            $url = $this->admin->generateUrl('list');
        }
        if (null !== $this->get('request')->get('btn_create_and_list')) {
            $url = $this->admin->generateUrl('list');
        }

        if (null !== $this->get('request')->get('btn_create_and_create')) {
            $params = array();
            if ($this->admin->hasActiveSubClass()) {
                $params['subclass'] = $this->get('request')->get('subclass');
            }
            $url = $this->admin->generateUrl('create', $params);
        }

        if (!$url) {
            $url = $this->admin->generateObjectUrl('edit', $object);
        }

        return new RedirectResponse($url);
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

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();
        $request = $this->get('request');
        $idAreaModEstab = NULL;
        $idAtenAreaModEstab = $request->get('idAtenAreaModEstab')?:NULL;
        $idEmpleado = $request->get('idEmpleado')?:NULL;

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());
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
        return $this->render($this->admin->getTemplate('list'), array(
                    'action' => 'list',
                    'form' => $formView,
                    'datagrid' => $datagrid,
                    'csrf_token' => $this->getCsrfToken('sonata.batch'),
                    'areas' => $areas,
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

        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (false === $this->admin->isGranted('EDIT')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $user = $this->container->get('security.context')->getToken()->getUser();
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $fechaActual = new \DateTime();
        //RECEPCIÓN DE VARIABLES
        if(is_null($object)){
            $idAreaModEstab = $request->get('idAreaModEstab');
            $idAtenAreaModEstab = $request->get('idAtenAreaModEstab');
            $idEmpleado = $request->get('idEmpleado');
            $yrs = $request->get('yrs');
            $mes = $request->get('mes')? : $fechaActual->format('m');
        }
        else{
            $idAreaModEstab = $object->getIdAreaModEstab();
            $idAtenAreaModEstab = $object->getIdAtenAreaModEstab();
            $idEmpleado = $object->getIdEmpleado();
            $yrs = $object->getYrs();
            $mes = $object->getMes()? : $fechaActual->format('m');
        }

        $idEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $idEstadoDistribucion = $em->getRepository('MinsalCitasBundle:CitEstadoDistribucion')->find(1);
        $especialidad = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->find($idAtenAreaModEstab);

        $criterios = array('idAtenAreaModEstab' => $idAtenAreaModEstab,
                           'idEmpleado' => $idEmpleado,
                           'yrs' => $yrs,
                           'idEstadoDistribucion'=>$idEstadoDistribucion);
        if (!is_null($mes)) {
            $criterios['mes'] = $mes;
        }

        $distribuciones = $em->getRepository('MinsalCitasBundle:CitDistribucion')->findBy($criterios, array('dia' => 'ASC','idRangohora'=>'ASC'));
        $tiposDistribuciones= $em->getRepository('MinsalCitasBundle:CitTipoDistribucion')->findAll();
        $consultorios = $em->getRepository('MinsalSiapsBundle:MntConsultorio')->findBy(array('idAreaModEstab' => $idAreaModEstab));
        $rangosHoras = $em->getRepository('MinsalSiapsBundle:MntRangoHora')
                ->findBy(array('idEstablecimiento' => $idEstablecimiento,'activo'=>true,'idModulo'=>4),array('horaIni' => 'ASC'));
        $medico = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->find($idEmpleado);
        $mesAnio = $distribuciones[0]->getNombreMes() . ' ' . $yrs;

        //VARIABLES DE GUARDADO
        $rangoHora = $request->get('rangoHora')? : NULL;
        $consultorio = $request->get('consultorio')? : NULL;
        $primera = $request->get('primera')? : NULL;
        $subsecuente = $request->get('subsecuente')? : NULL;
        $agregadas = $request->get('agregadas')? : NULL;
        $tipoDistribucion=$request->get('tipoDistribucion')? : NULL;

        if (!is_null($rangoHora)) {
            $em->getConnection()->beginTransaction();
            try {
                $aplicar = $request->get('aplicar');
                if ($aplicar === 'on') {
                    for ($i = $mes + 1; $i <= 12; $i++) {
                        foreach ($distribuciones as $distribucionOriginal) {
                            $criterios['mes'] = $i;
                            $criterios['idRangohora'] = $distribucionOriginal->getIdRangohora()->getId();
                            $criterios['idConsultorio'] = $distribucionOriginal->getIdConsultorio()->getId();
                            $criterios['primera'] = $distribucionOriginal->getPrimera();
                            $criterios['subsecuente'] = $distribucionOriginal->getSubsecuente();
                            $criterios['maxCitasAgregadas'] = $distribucionOriginal->getMaxCitasAgregadas();
                            $criterios['dia'] = $distribucionOriginal->getDia();
                            $criterios['idEmpleado'] = $distribucionOriginal->getIdEmpleado();
                            $criterios['idAtenAreaModEstab'] = $distribucionOriginal->getIdAtenAreaModEstab();
                            $criterios['idEstadoDistribucion'] = $em->getRepository('MinsalCitasBundle:CitEstadoDistribucion')->find(1);//estado: activo
                            $distribucionActualizar = $em->getRepository('MinsalCitasBundle:CitDistribucion')->findOneBy($criterios);

                            if (!empty($distribucionActualizar)) {
                                $key = $distribucionOriginal->getId();
                                $key_actualizar = $distribucionActualizar->getId();
                                $distribucionActualizar->setPrimera($primera[$key]);
                                $distribucionActualizar->setSubsecuente($subsecuente[$key]);
                                $distribucionActualizar->setMaxCitasAgregadas($agregadas[$key]);
                                $distribucionActualizar->setFechahoramod($fechaActual);
                                $distribucionActualizar->setIdusuariomod($user);
                                $idConsultorio = $em->getRepository('MinsalSiapsBundle:MntConsultorio')->find($consultorio[$key]);
                                if($tipoDistribucion[$key]!=''){
                                    $idTipoDistribucion=$em->getRepository('MinsalCitasBundle:CitTipoDistribucion')->find($tipoDistribucion[$key]);
                                    $distribucionActualizar->setIdTipoDistribucion($idTipoDistribucion);
                                }else {
                                    $distribucionActualizar->setIdTipoDistribucion(null);
                                }
                                $distribucionActualizar->setIdConsultorio($idConsultorio);
                                $idRangohora = $em->getRepository('MinsalSiapsBundle:MntRangohora')->find($rangoHora[$key]);
                                $distribucionActualizar->setIdRangohora($idRangohora);
                                $this->admin->update($distribucionActualizar);

                                if($criterios['idRangohora']!=$rangoHora[$key]){
                                    $citas=$em->getRepository('MinsalCitasBundle:CitCitasDia')->findBy(array('idDistribucion'=>$key_actualizar));
                                    foreach ($citas as $cita) {
                                        $cita->setIdRangohora($idRangohora);
                                        $cita->setFechahoramod($fechaActual);
                                        $cita->setIdusuariomod($user);
                                        $em->persist($cita);
                                        $em->flush();
                                    }
                                }
                            }
                            //VERIFICO SI EL RANGO DE HORA HA SIDO MODIFICADO PARA ACTUALIZAR TODAS LAS CITAS ASOCIADAS A ESA DISTRIBUCIÓN

                        }
                    }
                }
                foreach ($rangoHora as $key => $rango) {
                    $distribucion = $em->getRepository('MinsalCitasBundle:CitDistribucion')->find($key);
                    $distribucion->setPrimera($primera[$key]);
                    $distribucion->setSubsecuente($subsecuente[$key]);
                    $distribucion->setMaxCitasAgregadas($agregadas[$key]);
                    $distribucion->setFechahoramod($fechaActual);
                    $distribucion->setIdusuariomod($user);
                    $idConsultorio = $em->getRepository('MinsalSiapsBundle:MntConsultorio')->find($consultorio[$key]);
                    $distribucion->setIdConsultorio($idConsultorio);
                    $idRangohora = $em->getRepository('MinsalSiapsBundle:MntRangohora')->find($rango);
                    $idRangohoraOriginal=$distribucion->getIdRangohora()->getId();
                    $distribucion->setIdRangohora($idRangohora);
                    if($tipoDistribucion[$key]!=''){
                        $idTipoDistribucion=$em->getRepository('MinsalCitasBundle:CitTipoDistribucion')->find($tipoDistribucion[$key]);
                        $distribucion->setIdTipoDistribucion($idTipoDistribucion);
                    }else {
                        $distribucion->setIdTipoDistribucion(null);
                    }
                    $this->admin->update($distribucion);
                    if($idRangohoraOriginal != $rango){
                        $citas=$em->getRepository('MinsalCitasBundle:CitCitasDia')->findBy(array('idDistribucion'=>$key));
                        foreach ($citas as $cita) {
                            $cita->setIdRangohora($idRangohora);
                            $cita->setFechahoramod($fechaActual);
                            $cita->setIdusuariomod($user);
                            $em->persist($cita);
                            $em->flush();
                        }
                    }
                }
                $em->getConnection()->commit();
            } catch (\Exception $e) {
                $em->getConnection()->rollback();

                $this->addFlash('sonata_flash_error', $e);
                throw $e;
            }

            $this->addFlash('sonata_flash_success', 'Distribucion actualizada correctamente');
            return $this->listAction();
        }else{

            $this->addFlash('sonata_flash_info', "<strong>NOTA:</strong>"
                    . "<br/> <span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"></span>"
                    . "Tener cuidado al realizar una actualización de distribución; ya que todas las citas asociadas a esta distribución serán actualizadas");

        }

        return $this->render('MinsalCitasBundle:CitDistribucion:edit.html.twig', array(
                    'action' => 'edit',
                    'distribuciones' => $distribuciones,
                    'medico' => $medico,
                    'mesAnio' => $mesAnio,
                    'consultorios' => $consultorios,
                    'rangos' => $rangosHoras,
                    'anio' => $yrs,
                    'especialidad' => $especialidad,
                    'mes' => $mes,
                    'tiposDistribuciones'=> $tiposDistribuciones
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
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();


        $fechaActual = new \DateTime();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('DELETE', $object)) {
            throw new AccessDeniedException();
        }

        if ($this->getRestMethod() == 'DELETE') {
            // check the csrf token
            $this->validateCsrfToken('sonata.delete');

            try {

                $em = $this->getDoctrine()->getManager();

                //Leer las citas asociadas a la distribución
                $idEmpleado = $object->getIdEmpleado()->getId();
                $idEspecialidad = $object->getIdAtenAreaModEstab()->getId();
                $mes = $object->getMes();
                $year = $object->getYrs();
                $diaSemanaDistribucion = $object->getDia();
                $calendarDate = new \DateTime($year.'-'.$mes.'-01');
                $lowerLimit = date('d/m/Y', $calendarDate->getTimestamp());
                $upperLimit = date('t/m/Y', $calendarDate->getTimestamp());
                $horario = $object->getIdRangohora()->__toString();

                $citCitasDiaService = $this->container->get('cit_citas_dia.services');
                $citas = $citCitasDiaService->getRangoCitasInfo($idEmpleado, $idEspecialidad, $lowerLimit, $upperLimit);

                $tiene_citas = false;
                foreach ($citas as $dkey => $dvalue) {
                    $diaSemana = date("N", strtotime($dvalue['dashFormat']));

                    if($diaSemana == $diaSemanaDistribucion){
                        $tiene_citas = $dvalue['horarios'][$horario] ? ($dvalue['horarios'][$horario]['totalAsignados'] > 0 ? true : $tiene_citas) : $tiene_citas;
                    }

                    if( $tiene_citas ){
                        $fechaCita = new \DateTime($dvalue['dashFormat']);
                        break;
                    }

                }

                if(!$tiene_citas){
                    $this->admin->delete($object);
                    $message_type = 'sonata_flash_success';
                    $message = $this->admin->trans(
                        'flash_delete_success',
                        array('%name%' => $this->admin->toString($object)),
                        'SonataAdminBundle'
                    );
                }elseif ($fechaCita<$fechaActual) {
                    $object->setIdEstadoDistribucion($em->getRepository('MinsalCitasBundle:CitEstadoDistribucion')->find(2));
                    $object->setFechahoramod($fechaActual);
                    $object->setIdusuariomod($user);
                    $this->admin->update($object);
                    $message_type = 'sonata_flash_warning';
                    $message = 'El horario de la distribución sólo ha sido cambiado a estado CERRADO, debido a que posee citas asociadas.';
                }
                else{
                    $message_type = 'sonata_flash_warning';
                    $message = 'El horario de la distribución sólo ha sido cambiado a estado CERRADO, debido a que posee citas  asociadas.';
                    $object->setIdEstadoDistribucion($em->getRepository('MinsalCitasBundle:CitEstadoDistribucion')->find(2));
                    $object->setFechahoramod($fechaActual);
                    $object->setIdusuariomod($user);
                    $this->admin->update($object);
                    if($user->hasRole('ROLE_SONATA_ADMIN_CITCITASDIA_TRANSFER') || $user->hasRole('ROLE_SUPER_ADMIN')){
                        $url = $this->generateUrl('admin_minsal_citas_citcitasdia_transfer');
                        $message .= '<br /> Si desea transferir las citas a otro médico, haga click en el siguiente botón <a href="'.$url.'" class="btn btn-primary"><span class="glyphicon glyphicon-share" ></span> Transferir</a>';
                    }
                }

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array('result' => 'ok'));
                }

                $this->addFlash($message_type, $message);

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

    public function activarAction($id=null)
    {
        $id     = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();


        $fechaActual = new \DateTime();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('DELETE', $object)) {
            throw new AccessDeniedException();
        }

        if ($this->getRestMethod() == 'ACTIVAR') {
            // check the csrf token
            $this->validateCsrfToken('sonata.delete');

            try {
                    $object->setIdEstadoDistribucion($em->getRepository('MinsalCitasBundle:CitEstadoDistribucion')->find(1));
                    $object->setFechahoramod($fechaActual);
                    $object->setIdusuariomod($user);
                    $this->admin->update($object);
                    $message_type = 'sonata_flash_sucess';
                    $message = 'La distribución ha sido activada satisfactoriamente';

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array('result' => 'ok'));
                }

                $this->addFlash($message_type, $message);
                return new RedirectResponse($this->admin->generateUrl('list'));


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

        return $this->render($this->admin->getTemplate('activar'), array(
            'object'     => $object,
            'action'     => 'activar',
            'csrf_token' => $this->getCsrfToken('sonata.delete')
        ));
    }
}
