<?php

namespace Minsal\CitasBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Minsal\SiapsBundle\Entity\MntExpediente as Expediente;


class CitCitasProcedimientosAdminController extends CRUDController{

    /**
     * return the Response object associated to the action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function listAction() {
        if (false === $this->admin->isGranted('LIST')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
        }

        $request = $this->get('request');

        $idPaciente = $request->get('id')?:NULL;


        $em = $this->getDoctrine()->getManager();
        $areas = $em->getRepository("MinsalSiapsBundle:MntAreaModEstab")->findBy(array('idAreaAtencion' => 1));
        $idAreaModEstab = '';
        $idusuarioreg = $this->container->get('security.context')->getToken()->getUser();

        if (!$idusuarioreg->hasRole('ROLE_SUPER_ADMIN')) {
            $idEmpleado = $idusuarioreg->getIdEmpleado()->getId();
            $dql = "SELECT A
                    FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab A
                    JOIN A.idEmpleado B
                    WHERE B.id=$idEmpleado";

            $AreaModEstab = $em->createQuery($dql)
                               ->getResult();
            $idAreaModEstab = $AreaModEstab[0]->getIdAreaModEstab();
        }

        if($idPaciente){
            $mntExpedienteService = $this->container->get('mnt_expediente.services');
            $expediente = $mntExpedienteService->obtenerExpedientePaciente($idPaciente);

            if(!$expediente){
                $expediente=new Expediente();
                $expediente->setIdPaciente($em->getRepository('MinsalSiapsBundle:MntPaciente')->find($idPaciente));
                $expediente->setNumero('T'.$idPaciente);
                $expediente->setHabilitado(true);
                $expediente->setIdEstablecimiento($em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado'=>true)));
                $expediente->setNumeroTemporal(true);
                $expediente->setFechaCreacion(new \DateTime());
                $expediente->setHoraCreacion(new \DateTime());
                $em->persist($expediente);
                $em->flush();
                $expediente=$expediente->getId();
            }

            $idEstablecimientoReferencia=$request->get('idEstablecimientoReferencia');
            $numeroExpedienteReferencia=$request->get('expedienteReferencia')?:NULL;
        } else{
            $expediente = '';
            $idEstablecimientoReferencia=NULL;
            $numeroExpedienteReferencia=NULL;
        }

         return $this->render($this->admin->getTemplate('list'), array(
             'action' => 'list',
             'areas' => $areas,
             'idAreaModEstab'=> $idAreaModEstab,
             'idExpediente' => $expediente,
             'idEstablecimientoReferencia'=>$idEstablecimientoReferencia,
             'expedienteReferencia'=>$numeroExpedienteReferencia
         ));
     }

    public function consultaAction() {

        if (false === $this->admin->isGranted('LIST') && (false === $this->admin->isGranted('REPORTES'))) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
        }

        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $MntProcedimientoEstablecimiento = $request->get('idProcedimientoEstablecimiento') ? $em->getRepository('MinsalSiapsBundle:MntProcedimientoEstablecimiento')->findOneById($request->get('idProcedimientoEstablecimiento')) : NULL;

        $idAreaModEstab = $request->get('idAreaModEstab') ? $request->get('idAreaModEstab') : ( $MntProcedimientoEstablecimiento ? $MntProcedimientoEstablecimiento->getId() : NULL );
        $idusuarioreg   = $this->container->get('security.context')->getToken()->getUser();

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

        $areas = $em->getRepository("MinsalSiapsBundle:MntAreaModEstab")->findBy(array('idAreaAtencion' => 1));

        return $this->render('MinsalCitasBundle:CitCitasProcedimientos:citasPorDia.html.twig', array(
            'action'         => 'list',
            'idAreaModEstab' => $idAreaModEstab,
            'areas'          => $areas
        ));
    }

     public function busquedaAction(){

         if (false === $this->admin->isGranted('LIST') && (false === $this->admin->isGranted('REPORTES'))) {
             return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
             'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
         }
         $request = $this->getRequest();
         $em = $this->getDoctrine()->getManager();

         $idExpediente = $request->get('numExpNomPac')?:'';

         $idAreaModEstab = $request->get('idAreaModEstab')?:NULL;
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

         if ($this->getRestMethod() == 'POST') {
             $em = $this->getDoctrine()->getManager();
             $fechaActual = new \DateTime();

             $usuario = $this->container->get('security.context')->getToken()->getUser();
             $idCita = $request->get('idCita');

             $cita=$em->getRepository('MinsalCitasBundle:CitCitasProcedimientos')->find($idCita);
             $parameters = array(
                             'idEstadoAct'        => $em->getRepository('MinsalCitasBundle:CitEstadoCita')->find(9),
                             'idMotivoAct'        => $cita->getIdJustificacion(),
                             'fecha'              => $cita->getFecha(),
                             'idusuarioreg'       => $usuario,
                             'fechahorareg'       => $fechaActual,
                             'idDistribucion'     => $cita->getIdDistribucionProcedimiento()
             );

             $this->updateCita($idCita, $parameters);
             $this->addFlash('sonata_flash_success', 'Cita Eliminada satisfactoriamente');
         }

         $areas = $em->getRepository("MinsalSiapsBundle:MntAreaModEstab")->findBy(array('idAreaAtencion' => 1));

         return $this->render('MinsalCitasBundle:CitCitasProcedimientos:busqueda.html.twig', array(
             'action'     => 'list',
             'idAreaModEstab'=>$idAreaModEstab,
             'areas'=>$areas,
             'idExpediente' => $idExpediente,
         ));
     }

     private function updateCita($id, $parameters) {
         $em = $this->getDoctrine()->getManager();
         $citCitasProcedimientos = $em->getRepository('MinsalCitasBundle:CitCitasProcedimientos')->find($id);

         $citCitasProcedimientos->setIdEstado($parameters['idEstadoAct']);
         $citCitasProcedimientos->setFecha($parameters['fecha']);
         $citCitasProcedimientos->setIdJustificacion($parameters['idMotivoAct']);
         $citCitasProcedimientos->setIdusuariomod($parameters['idusuarioreg']->getId());
         $citCitasProcedimientos->setfechahoramod($parameters['fechahorareg']);
         $citCitasProcedimientos->setIdDistribucionProcedimiento($parameters['idDistribucion']);

         $this->admin->update($citCitasProcedimientos);
     }

    /**
     * return the Response object associated to the action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function agendaAction() {
        if (false === $this->admin->isGranted('AGENDA')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
        }

        $request = $this->get('request');
        $user    = $this->getUser();
        $em      = $this->getDoctrine()->getManager();

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        $params['external'] = $request->get('_external') ? true : false;

        if($params['external']) {
            $mntEmpleado                     = $request->get('idEmpleado') ? $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneById($request->get('idEmpleado')) : NULL;
            $mntAreaModEstab                 = $request->get('idEmpleado') ? $em->getRepository('MinsalSiapsBundle:MntAreaModEstab')->obtenerAreaModEstabDeEmpleado($idEmpleado) : NULL;
            $mntProcedimientoEstablecimiento = $request->get('idProcedimientoEstablecimiento') ? $em->getRepository('MinsalSiapsBundle:MntProcedimientoEstablecimiento')->findOneById($request->get('idProcedimientoEstablecimiento')) : NULL;
            $secHistorialClinico             = $request->get('idHistorialClinico') ? $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->findOneById($request->get('idHistorialClinico')) : NULL;

            $params['tipo']                            = $request->get('tipo') ? $request->get('tipo')     : null;
            $params['modulo']                          = $request->get('modulo') ? $request->get('modulo') : null;
            $params['mntEmpleado']                     = $mntEmpleado;
            $params['mntAreaModEstab']                 = $mntAreaModEstab;
            $params['mntProcedimientoEstablecimiento'] = $mntProcedimientoEstablecimiento;
            $params['secHistorialClinico']             = $secHistorialClinico;
        } else {
            if( $user->hasRole('ROLE_SUPER_ADMIN') ) {
                $mntAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAreaModEstab')->obtenerAreaModEstab();
            } else {
                $mntAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAreaModEstab')->obtenerAreaModEstabDeEmpleado($user->getIdEmpleado()->getId());
            }

            $params['mntAreaModEstab'] = $mntAreaModEstab;
        }

        return $this->render($this->admin->getTemplate('agenda'), array(
                            'action' => 'agenda',
                            'form'   => $formView,
                            'query'  => $request->query,
                            'params' => $params
                ));
    }

    public function fechaslibresAction(){

        if (false === $this->admin->isGranted('LIST') && (false === $this->admin->isGranted('REPORTES'))) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
        }
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $idAreaModEstab = $request->get('idAreaModEstab')?:NULL;
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

        $areas = $em->getRepository("MinsalSiapsBundle:MntAreaModEstab")->findBy(array('idAreaAtencion' => 1));

        return $this->render('MinsalCitasBundle:CitCitasProcedimientos:fechasLibres.html.twig', array(
            'action'     => 'list',
            'idAreaModEstab'=>$idAreaModEstab,
            'areas'=>$areas
        ));
    }
}
