<?php

namespace Minsal\CitasBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Minsal\CitasBundle\Entity\CitDistribucionProcedimiento as DistribucionProcedimiento;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CitDistribucionProcedimientoAdminController extends CRUDController
{
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
        $request = $this->get('request');
        $idAreaModEstab = $request->get('idAreaModEstab') ? $request->get('idAreaModEstab') : NULL;
        $idEmpleado = $request->get('idEmpleado') ? $request->get('idEmpleado') : NULL;
        $idProcedimientoEstablecimiento = $request->get('idAreaModEstab') ? $request->get('idAreaModEstab') : NULL;
        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        //Obtener datos del usuario
        $idusuarioreg = $this->container->get('security.context')->getToken()->getUser();
        if (!$idusuarioreg->hasRole('ROLE_SUPER_ADMIN') && $idAreaModEstab === NULL) {
            $idEmpleado = $idusuarioreg->getIdEmpleado()->getId();

            $dql = "SELECT A
                  FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab A
                  JOIN A.idEmpleado B
                  WHERE B.id=$idEmpleado";

			$AreaModEstab = $em->createQuery($dql)
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
                $estadoDistribucion = $em->getRepository("MinsalCitasBundle:CitEstadoDistribucion")->find(1);

                $meses = $object->getMes();
                $dias = $object->getDia();

                $fechahorareg = new \DateTime();
                $idAreaModEstab = $object->getIdAreaModEstab();
                $idEmpleado = $object->getIdEmpleado();
				$idTipoDistribucion = $object->getIdTipoDistribucion();
                $yrs = $object->getYrs();
                $idRangohora = $object->getIdRangohora();
                $cupos = $object->getCupos();
                $tiempoLecturaDias = $object->gettiempoLecturaDias();
                $maxCitasAgregadas = $object->getMaxCitasAgregadas();
                $idProcedimientoEstablecimiento = $object->getIdProcedimientoEstablecimiento();
                $anio_actual = $fechahorareg->format('Y');
                $anio_actual = $fechahorareg->format('m');
                $em->getConnection()->beginTransaction();
                try {
                    foreach ($meses as $mes) {
                        if($yrs != $anio_actual or ($yrs == $anio_actual and $mes >= $mes_actual)){
                            if ($mes !== 13) {
                                foreach ($dias as $dia) {
                                    if ($dia !== 8) {
                                        $distribucion = new DistribucionProcedimiento();
                                        $distribucion->setDia($dia);
                                        $distribucion->setIdProcedimientoEstablecimiento($idProcedimientoEstablecimiento);
                                        $distribucion->setMes($mes);
                                        $distribucion->setFechahorareg($fechahorareg);
                                        $distribucion->setIdAreaModEstab($idAreaModEstab);
                                        $distribucion->setIdRangohora($idRangohora);
                                        $distribucion->setIdusuarioreg($idusuarioreg);
                                        $distribucion->setMaxCitasAgregadas($maxCitasAgregadas);
                                        $distribucion->setCupos($cupos);
                                        $distribucion->setTiempoLecturaDias($tiempoLecturaDias);
                                        $distribucion->setYrs($yrs);
                                        $distribucion->setIdEstadoDistribucion($estadoDistribucion);
										$distribucion->setIdTipoDistribucion($idTipoDistribucion);
                                        if($idEmpleado)
                                            $distribucion->setIdEmpleado($idEmpleado);
                                        $this->admin->create($distribucion);
                                    }
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

        return $this->render('MinsalCitasBundle:CitDistribucionProcedimiento:create.html.twig', array(
					'action'                         => 'create',
					'form'                           => $view,
					'object'                         => $object,
					'idAreaModEstab'                 => $idAreaModEstab,
					'idProcedimientoEstablecimiento' => $idProcedimientoEstablecimiento,
					'idEmpleado'                     => $idEmpleado
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
		$procedimientos = $em->getRepository("MinsalSiapsBundle:MntProcedimientoEstablecimiento")->findAll();

		$datagrid = $this->admin->getDatagrid();
		$formView = $datagrid->getForm()->createView();
        $idAreaModEstab = NULL;
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
            'procedimientos' => $procedimientos,
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
        $idAreaModEstab = $request->get('idAreaModEstab');
        $idEmpleado = $request->get('idEmpleado');
        $idProcedimientoEstablecimiento = $request->get('idProcedimientoEstablecimiento');
        $yrs = $request->get('yrs');
        $mes = $request->get('mes')? : $fechaActual->format('m');

        $idEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $procedimiento = $em->getRepository('MinsalSiapsBundle:MntProcedimientoEstablecimiento')->find($idProcedimientoEstablecimiento);
		$tiposDistribuciones= $em->getRepository('MinsalCitasBundle:CitTipoDistribucion')->findAll();

        $medicos =  $em->getRepository('MinsalSiapsBundle:MntEmpleado')->obtenerMedicosPorArea($idAreaModEstab);

        $criterios = array('yrs' => $yrs,'idProcedimientoEstablecimiento' => $idProcedimientoEstablecimiento,'mes' => $mes);

        if (!is_null($idEmpleado) and $idEmpleado != '') {
            $criterios['idEmpleado'] = $idEmpleado;
        }

        $distribuciones = $em->getRepository('MinsalCitasBundle:CitDistribucionProcedimiento')->findBy($criterios, array('dia' => 'ASC'));
        $rangosHoras = $em->getRepository('MinsalSiapsBundle:MntRangoHora')
                ->findBy(array('idEstablecimiento' => $idEstablecimiento,'activo'=>true,'idModulo'=>4),array('horaIni' => 'ASC'));
        $mesAnio = $distribuciones[0]->getMonthName() . ' ' . $yrs;

        //VARIABLES DE GUARDADO
        $rangoHora = $request->get('rangoHora')? : NULL;
        $cupos = $request->get('cupos')? : NULL;
        $tiempoLecturaDias = $request->get('tiempoLecturaDias')? : NULL;
        $agregadas = $request->get('agregadas')? : NULL;
        $medico = $request->get('medico')? : NULL;
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
                            $criterios['cupos'] = $distribucionOriginal->getCupos();
                            $criterios['tiempoLecturaDias'] = $distribucionOriginal->getTiempoLecturaDias();
                            $criterios['maxCitasAgregadas'] = $distribucionOriginal->getMaxCitasAgregadas();
                            $criterios['dia'] = $distribucionOriginal->getDia();
                            $criterios['idProcedimientoEstablecimiento'] = $distribucionOriginal->getIdProcedimientoEstablecimiento()->getId();
                            $criterios['idEstadoDistribucion'] = 1;//estado: activo
                            if($idEmpleado)
                                $criterios['idEmpleado'] = $distribucionOriginal->getIdEmpleado();
                            $distribucionActualizar = $em->getRepository('MinsalCitasBundle:CitDistribucionProcedimiento')->findOneBy($criterios);

                            if (!empty($distribucionActualizar)) {
                                $key = $distribucionOriginal->getId();
                                $distribucionActualizar->setCupos($cupos[$key]);
                                $distribucionActualizar->setTiempoLecturaDias($tiempoLecturaDias[$key]);
                                $distribucionActualizar->setMaxCitasAgregadas($agregadas[$key]);
                                $distribucionActualizar->setFechahoramod($fechaActual);
                                $distribucionActualizar->setIdusuariomod($user);
                                $idRangohora = $em->getRepository('MinsalSiapsBundle:MntRangohora')->find($rangoHora[$key]);
                                $distribucionActualizar->setIdRangohora($idRangohora);
                                if($medico[$key]){
                                    $empleado = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->find($medico[$key]);
                                    $distribucionActualizar->setIdEmpleado($empleado);
                                }else {
                                    $distribucionActualizar->setIdEmpleado(null);
                                }
								if($tipoDistribucion[$key]!=''){
                                    $idTipoDistribucion=$em->getRepository('MinsalCitasBundle:CitTipoDistribucion')->find($tipoDistribucion[$key]);
                                    $distribucionActualizar->setIdTipoDistribucion($idTipoDistribucion);
                                }else{
									$distribucionActualizar->setIdTipoDistribucion(null);
								}
                                $this->admin->update($distribucionActualizar);
                            }
                        }
                    }
                }
                foreach ($rangoHora as $key => $rango) {
                    $distribucion = $em->getRepository('MinsalCitasBundle:CitDistribucionProcedimiento')->find($key);
                    $distribucion->setCupos($cupos[$key]);
                    $distribucion->setTiempoLecturaDias($tiempoLecturaDias[$key]);
                    $distribucion->setMaxCitasAgregadas($agregadas[$key]);
                    $distribucion->setFechahoramod($fechaActual);
                    $distribucion->setIdusuariomod($user);
                    $idRangohora = $em->getRepository('MinsalSiapsBundle:MntRangohora')->find($rango);
                    $distribucion->setIdRangohora($idRangohora);
                    if($medico[$key]){
                        $empleado = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->find($medico[$key]);
                        $distribucion->setIdEmpleado($empleado);
                    }else {
                        $distribucion->setIdEmpleado(null);
                    }
					if($tipoDistribucion[$key]!=''){
						$idTipoDistribucion=$em->getRepository('MinsalCitasBundle:CitTipoDistribucion')->find($tipoDistribucion[$key]);
						$distribucion->setIdTipoDistribucion($idTipoDistribucion);
					}else{
						$distribucion->setIdTipoDistribucion(null);
					}
                    $this->admin->update($distribucion);
                }
                $em->getConnection()->commit();
            } catch (\Exception $e) {
                $em->getConnection()->rollback();

                $this->addFlash('sonata_flash_error', $e);
                throw $e;
            }

            $this->addFlash('sonata_flash_success', 'Distribucion de procedimiento actualizada correctamente');
            return $this->listAction();

        }else{

            $this->addFlash('sonata_flash_info', "<strong>NOTA:</strong>"
                    . "<br/> <span class=\"glyphicon glyphicon-info-sign\" aria-hidden=\"true\"></span>"
                    . "Tener cuidado al realizar una actualización de distribución; ya que todas las citas asociadas a esta distribución serán actualizadas");

        }


        return $this->render('MinsalCitasBundle:CitDistribucionProcedimiento:edit.html.twig', array(
                    'action' => 'edit',
                    'distribuciones' => $distribuciones,
                    'idProcedimientoEstablecimiento' => $idProcedimientoEstablecimiento,
                    'medicos' => $medicos,
                    'mesAnio' => $mesAnio,
                    'rangos' => $rangosHoras,
                    'anio' => $yrs,
                    'mes' => $mes,
                    'idAreaModEstab' => $idAreaModEstab,
                    'procedimiento' => $procedimiento,
                    'idEmpleado' => $idEmpleado,
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
    public function deleteAction($id=null)    {
        $id     = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();


        $fechaActual = new \DateTime();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('DELETE', $object)) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                  'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
                ));
        }

        if ($this->getRestMethod() == 'DELETE') {
            // check the csrf token
            $this->validateCsrfToken('sonata.delete');

            try {

                $em = $this->getDoctrine()->getManager();

                //Leer las citas asociadas a la distribución
                $idEmpleado = $object->getIdEmpleado()?$object->getIdEmpleado()->getId():NULL;
                $idProcedimientoEstablecimiento=$object->getIdProcedimientoEstablecimiento();
                $idRangohora=$object->getIdRangohora();
                $mes = $object->getMes();
                $year = $object->getYrs();
                $diaSemanaDistribucion = $object->getDia();
                $calendarDate = new \DateTime($year.'-'.$mes.'-01');
                $lowerLimit = date('d/m/Y', $calendarDate->getTimestamp());
                $upperLimit = date('t/m/Y', $calendarDate->getTimestamp());
                $horario = $object->getIdRangohora()->__toString();
                $diaSemanaDistribucion=$object->getDia();
                $citCitasProcedimientosService = $this->container->get('cit_citas_procedimientos.services');
                $citas = $citCitasProcedimientosService->getConsolidadoCitCitasProcedimientos($idProcedimientoEstablecimiento->getId(),$lowerLimit, $upperLimit,$idRangohora->getId(),$idEmpleado);
                $tiene_citas = false;
                foreach ($citas as $dvalue) {
                    if($dvalue['dia_semana'] == $diaSemanaDistribucion){
                        $tiene_citas = $dvalue['total_citas']>0 ? true :$tiene_citas;
                    }

                    if( $tiene_citas ){
                        $fechaCita = new \DateTime($dvalue['date']);
                        break;
                    }

                }

                if(!$tiene_citas){
                    $citasEliminadas=$em->getRepository('MinsalCitasBundle:CitCitasProcedimientos')->findBy(array('idDistribucionProcedimiento'=>$id,'idEstado'=>array(3,9)));
                    if(count($citasEliminadas)>0){
                        $object->setIdEstadoDistribucion($em->getRepository('MinsalCitasBundle:CitEstadoDistribucion')->find(2));
                        $object->setFechahoramod($fechaActual);
                        $object->setIdusuariomod($user);
                        $this->admin->update($object);
                        $message_type = 'sonata_flash_warning';
                        $message = 'El horario de la distribución del procedimiento sólo ha sido cambiado a estado CERRADO, debido a que posee citas eliminadas asociadas a esta distribución.';
                    }else{
                        $this->admin->delete($object);
                        $message_type = 'sonata_flash_success';
                        $message = $this->admin->trans(
                            'flash_delete_success',
                            array('%name%' => $this->admin->toString($object)),
                            'SonataAdminBundle'
                        );
                    }
                }elseif ($fechaCita<$fechaActual) {
                    $object->setIdEstadoDistribucion($em->getRepository('MinsalCitasBundle:CitEstadoDistribucion')->find(2));
                    $object->setFechahoramod($fechaActual);
                    $object->setIdusuariomod($user);
                    $this->admin->update($object);
                    $message_type = 'sonata_flash_warning';
                    $message = 'El horario de la distribución del procedimiento sólo ha sido cambiado a estado CERRADO, debido a que posee citas asociadas.';
                }
                else{
                    $message_type = 'sonata_flash_warning';
                    $message = 'El horario de la distribución del procedimiento sólo ha sido cambiado a estado CERRADO, debido a que posee citas asociadas.';
                    $object->setIdEstadoDistribucion($em->getRepository('MinsalCitasBundle:CitEstadoDistribucion')->find(2));
                    $object->setFechahoramod($fechaActual);
                    $object->setIdusuariomod($user);
                    $this->admin->update($object);
                    if($user->hasRole('ROLE_SONATA_ADMIN_CITCITAS_TRANSFER') || $user->hasRole('ROLE_SUPER_ADMIN')){
                        $url = $this->generateUrl('admin_minsal_citas_citdistribucionprocedimiento_list');//CAMBIAR ESTA CUANDO ESTE LA REPROGRAMACIÓN
                        $message .= '<br /> Si desea transferir las citas a otro médico, haga click en el siguiente botón <a href="'.$url.'" class="btn btn-primary"><span class="glyphicon glyphicon-share" ></span> Transferir</a>';
                        $message .= '<br /> Si desea reprogramar las citas con el mismo médico pero en otro horario, haga click en el siguiente botón <a href="'.$url.'" class="btn btn-primary"><span class="glyphicon glyphicon-share" ></span> Reprogramar</a>';
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
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                  'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
      ));
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
