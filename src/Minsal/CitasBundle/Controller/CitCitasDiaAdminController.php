<?php
//src/Minsal/CitasBundle/Controller/CitCitasDiaAdminController.php

namespace Minsal\CitasBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL as DBAL;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\SeguimientoBundle\Entity\SecHistorialCitaDiaSubsec;
use Minsal\SiapsBundle\Entity\MntPaciente as Paciente;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Minsal\SiapsBundle\Entity\MntExpediente as Expediente;

class CitCitasDiaAdminController extends CRUDController {

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

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        $params['external'] = $request->get('_external') ? true : false;

        if($params['external']) {
            $em          = $this->getDoctrine()->getManager();
            $mntEmpleado = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneById($request->get('idEmpleado'));
            $mntAtenAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($request->get('idEspecialidad'));
            $secHistorialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->findOneById($request->get('idHistorialClinico'));

            $params['tipo']                = $request->get('tipo') ? $request->get('tipo') : null;
            $params['modulo']              = $request->get('modulo') ? $request->get('modulo') : null;
            $params['mntEmpleado']         = $request->get('idEmpleado') ? $mntEmpleado : null;
            $params['mntAtenAreaModEstab'] = $request->get('idEspecialidad') ? $mntAtenAreaModEstab : null;
            $params['secHistorialClinico'] = $request->get('idHistorialClinico') ? $secHistorialClinico : null;

        }

        return $this->render($this->admin->getTemplate('agenda'), array(
                            'action' => 'list',
                            'form'   => $formView,
                            'query'  => $request->query,
                            'params' => $params
                ));
    }

    /**
     * return the Response object associated to the create action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function createAction() {
        if (false === $this->admin->isGranted('CREATE')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
        }

        if ($this->getRestMethod() == 'POST') {
            $em      = $this->getDoctrine()->getManager();
            $request = $this->get('request');

            $idEmpleado   = $request->get('idEmpleado');
            $especialidad = $request->get('idEmpleadoEspecialidadEstab');
            $date         = new \DateTime($request->get('date'));
            $idRangohora  = $request->get('horarioMedico');
            $idExpediente = $request->get('numExpNomPac');
            $today        = new \DateTime();
            $usuario      = $this->getUser();
            $ipcita       = $request->server->get('REMOTE_ADDR');
            $jsonReturn   = $request->get('jsonReturn') ? $request->get('jsonReturn') : 'false';
            $retroactive  = $request->get('retroactive') ? ( $request->get('retroactive') == 'true' ? true: false ) : false;
            $tipoCita     = $request->get('idTipoCita') ? intval( $request->get('idTipoCita') ) : 2;

            try {
                $citDistribucion = $em->getRepository('MinsalCitasBundle:CitDistribucion')->findOneBy(
                        array(
                            'idEmpleado' => $idEmpleado,
                            'dia' => date("w", $date->getTimestamp()),
                            'mes' => date("n", $date->getTimestamp()),
                            'yrs' => date("Y", $date->getTimestamp()),
                            'idAtenAreaModEstab' => $especialidad,
                            'idRangohora' => $idRangohora
                        )
                );

                /* Limite de subsecuentes que pueden ser asignados en el dia y hora al medico */
                $nombreFuncion = $tipoCita === 1 ? 'getPrimera' : 'getSubsecuente';
                $cupo = $citDistribucion->{ $nombreFuncion }();

                /* Preparando los campos para insersion o actualizacion */
                $mntEmpleado         = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneById($idEmpleado);
                $mntAtenAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($especialidad);

                /* Obteniendo el total de citas que posee el medico */
                $qb = $em->createQueryBuilder();
                $totalCitas = $qb->select($qb->expr()->count('t01.id'))
                        ->from('MinsalCitasBundle:CitCitasDia', 't01')
                        ->where('t01.fecha = :fecha')
                        ->andWhere('t01.idEmpleado = :idEmpleado')
                        ->andWhere('t01.idTipocita = :idTipocita')
                        ->andWhere('t01.idAtenAreaModEstab = :especialidad')
                        ->andWhere('t01.idRangohora = :idRangohora')
                        ->andWhere('t01.idEstado NOT IN(3,9)')
                        ->setParameters(array(
                            ':fecha' => date('Y-m-d', $date->getTimestamp()),
                            ':idEmpleado' => $idEmpleado,
                            ':idTipocita' => $tipoCita,
                            ':especialidad' => $especialidad,
                            ':idRangohora' => $idRangohora))
                        ->getQuery()
                        ->getSingleScalarResult();

                if ($cupo > $totalCitas) {
                    $idEstadoInsr = 1;
                    $idMotivoInsr = NULL;
                } else {
                    $idEstadoInsr = 6;
                    $idMotivoInsr = 2;
                }

                /* Obteniendo el total de citas asignadas */
                $qb = $em->createQueryBuilder();
                $totalCitasAsignadas = $qb->select($qb->expr()->count('t01.id'))
                        ->from('MinsalCitasBundle:CitCitasDia', 't01')
                        ->where('t01.fecha = :fecha')
                        ->andWhere('t01.idEmpleado = :idEmpleado')
                        ->andWhere('t01.idTipocita = :idTipocita')
                        ->andWhere('t01.idAreaModEstab = :idAreaModEstab')
                        ->andWhere('t01.idRangohora = :idRangohora')
                        ->setParameters(array(
                            ':fecha' => date('Y-m-d', $date->getTimestamp()),
                            ':idEmpleado' => $idEmpleado,
                            ':idTipocita' => $tipoCita,
                            ':idAreaModEstab' => $mntAtenAreaModEstab->getIdAreaModEstab()->getId(),
                            ':idRangohora' => $idRangohora))
                        ->getQuery()
                        ->getSingleScalarResult();

                if ($cupo > $totalCitasAsignadas) {
                    $idEstadoAct = 1;
                    $idMotivoAct = NULL;
                } else {
                    $idEstadoAct = 6;
                    $idMotivoAct = 2;
                }

                $parameters = array(
                    'idTipocita'         => $em->getRepository('MinsalCitasBundle:CitTipocita')->findOneById($tipoCita),
                    'idAtenAreaModEstab' => $mntAtenAreaModEstab,
                    'idEstadoInsr'       => $em->getRepository('MinsalCitasBundle:CitEstadoCita')->findOneById($idEstadoInsr),
                    'idMotivoInsr'       => $idMotivoInsr != NULL ? $em->getRepository('MinsalCitasBundle:CitJustificacion')->findOneById($idMotivoInsr) : $idMotivoInsr,
                    'idEstadoAct'        => $em->getRepository('MinsalCitasBundle:CitEstadoCita')->findOneById($idEstadoAct),
                    'idMotivoAct'        => $idMotivoAct != NULL ? $em->getRepository('MinsalCitasBundle:CitJustificacion')->findOneById($idMotivoAct) : $idMotivoAct,
                    'fecha'              => $date,
                    'idusuarioreg'       => $usuario,
                    'fechahorareg'       => $today,
                    'ipcita'             => $ipcita,
                    'idEmpleado'         => $mntEmpleado,
                    'idExpediente'       => $em->getRepository('MinsalSiapsBundle:MntExpediente')->findOneById($idExpediente),
                    'idEstablecimiento'  => $mntEmpleado->getIdEstablecimiento(),
                    'idRangohora'        => $em->getRepository('MinsalSiapsBundle:MntRangohora')->findOneById($idRangohora),
                    'idAreaModEstab'     => $mntAtenAreaModEstab->getIdAreaModEstab(),
                    'idDistribucion'     => $em->getRepository('MinsalCitasBundle:CitDistribucion')->findOneBy(array('idRangohora' => $idRangohora, 'idEmpleado' => $mntEmpleado->getId(), 'yrs' => date('Y',$date->getTimestamp()), 'mes' => date('n',$date->getTimestamp()), 'dia' => date('w',$date->getTimestamp()), 'idAtenAreaModEstab' => $mntAtenAreaModEstab->getId(), 'idAreaModEstab' => $mntAtenAreaModEstab->getIdAreaModEstab()->getId(), 'idEstadoDistribucion' => true))
                );

                $citaPrevia = array();

                if( $retroactive === false){
                    if($request->get('external') !== null && $request->get('external') === "1") {
                        $dql = "SELECT t04
                                FROM MinsalSeguimientoBundle:SecHistorialCitaDiaSubsec    t01
                                INNER JOIN MinsalSeguimientoBundle:SecHistorialClinico    t02 WITH (t02.id = t01.idHistorialClinico)
                                INNER JOIN MinsalSeguimientoBundle:CtlTipoCitaSubsecuente t03 WITH (t03.id = t01.idTipoCitaSubsecuente)
                                INNER JOIN MinsalCitasBundle:CitCitasDia                  t04 WITH (t04.id = t01.idCitaDia)
                                WHERE t02.id = :idHistorialClinico AND t03.id = :idTipoCitaSubsecuente
                                    AND t04.fecha > :today         AND t04.idEmpleado = :idEmpleado
                                    AND t04.idExpediente = :idExpediente AND t04.idAtenAreaModEstab = :especialidad
                                    AND (t04.idEstado = 1 OR t04.idEstado = 6)";

                        $query = $em->createQuery($dql);
                        $citaPrevia = $query->setParameters(array(
                                                ':idHistorialClinico' => $request->get('idHistorialClinico'),
                                                ':idTipoCitaSubsecuente' => $request->get('external_tipo'),
                                                ':today' => date('Y-m-d', $today->getTimestamp()),
                                                ':idEmpleado'   => $mntEmpleado->getId(),
                                                ':idExpediente' => $idExpediente,
                                                ':especialidad' => $especialidad))
                                            ->getResult();

                    } else {
                        $qb = $em->createQueryBuilder();
                        $citaPrevia = $qb->select('t01')
                                ->from('MinsalCitasBundle:CitCitasDia', 't01')
                                ->where('t01.fecha > :today')
                                ->andWhere('t01.idEmpleado = :idEmpleado')
                                ->andWhere('t01.idExpediente = :idExpediente')
                                ->andWhere('t01.idAtenAreaModEstab = :especialidad')
                                ->andWhere('t01.idEstado = 1 OR t01.idEstado = 6')
                                ->setParameters(array(
                                    ':today' => date('Y-m-d', $today->getTimestamp()),
                                    ':idEmpleado'   => $mntEmpleado->getId(),
                                    ':idExpediente' => $idExpediente,
                                    ':especialidad' => $especialidad))
                                ->getQuery()
                                ->getResult();
                    }
                }

                $em->getConnection()->beginTransaction();
                try {
                    if ($citaPrevia) {
                        if($request->get('external') !== null && $request->get('external') === "1") {
                            $secHistorialCitaDiaSubsec = $em->getRepository('MinsalSeguimientoBundle:SecHistorialCitaDiaSubsec')->findOneBy(array('idHistorialClinico' => $request->get('idHistorialClinico'), 'idCitaDia' => $citaPrevia[0]->getId()));

                            if(strval($secHistorialCitaDiaSubsec->getIdTipoCitaSubsecuente()->getId()) === $request->get('external_tipo')) {
                                if( date('Y-m-d', $date->getTimestamp()) === date('Y-m-d', $today->getTimestamp()) ) {
                                    $id = $this->insertCita($parameters);
                                } else {
                                    $this->updateCita($citaPrevia[0]->getId(), $parameters);
                                    $id = $citaPrevia[0]->getId();
                                }
                            } else {
                                $id = $this->insertCita($parameters);
                            }
                        } else {
                            if( date('Y-m-d', $date->getTimestamp()) === date('Y-m-d', $today->getTimestamp()) ) {
                                $id = $this->insertCita($parameters);
                            } else {
                                $this->updateCita($citaPrevia[0]->getId(), $parameters);
                                $id = $citaPrevia[0]->getId();
                            }
                        }
                    } else {
                        $id = $this->insertCita($parameters);
                    }

                    $em->getConnection()->commit();
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();

                    $this->addFlash('sonata_flash_error', $e);
                    throw $e;
                }

                $url = $this->generateUrl('citasgetcomprobante');
                $comprobante = '<form id="_comprobante-form" method="POST" action="' . $url . '" target="_blank" style="margin:0;">
                                    <input type="hidden" name="id" value="' . $id . '" /><br />
                                    <a href="javascript:void(0);" onclick="document.getElementById(\'_comprobante-form\').submit();">
                                        <span class="label label-success mouse-pointer" style="margin-top:5px;">Ver comprobante</span>
                                    </a>
                                </form>';
                $this->addFlash('sonata_flash_success', 'Cita creada exitosamente ' . $comprobante);

            } catch (\Exception $e) {
                $this->addFlash('sonata_flash_error', 'Error en la generacion de la cita... Detalle del Erro: ' . $e);
            }

            $urlParameters = array('idEmpleado' => $idEmpleado, 'idEspecialidad' => $especialidad, 'month' => date( "n", $date->getTimestamp())-1, 'year' => date( "Y", $date->getTimestamp()) );

            if($request->get('external') !== null && $request->get('external') === "1") {
                $urlParameters = array_merge(array('_external' => "true", 'tipo' => $request->get('external_tipo'), "idHistorialClinico" => $request->get('idHistorialClinico'), "createdElement" => $id), $urlParameters);
            }

            if( $jsonReturn == 'true' ){
                $urlParameters = array_merge(array("createdElement" => $id), $urlParameters);
                return new Response(json_encode($urlParameters));
            }
            else{
                return new RedirectResponse($this->admin->generateUrl('list', $urlParameters));
            }
        } else {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
        }
    }

    private function insertCita($parameters) {
        $em     = $this->getDoctrine()->getManager();
        $object = $this->admin->getNewInstance();

        $object->setIdTipocita($parameters['idTipocita']);
        $object->setIdAtenAreaModEstab($parameters['idAtenAreaModEstab']);
        $object->setIdEstado($parameters['idEstadoInsr']);
        $object->setFecha($parameters['fecha']);
        $object->setIdusuarioreg($parameters['idusuarioreg']);
        $object->setfechahorareg($parameters['fechahorareg']);
        $object->setIdJustificacion($parameters['idMotivoInsr']);
        $object->setIpcita($parameters['ipcita']);
        $object->setIdEmpleado($parameters['idEmpleado']);
        $object->setIdExpediente($parameters['idExpediente']);
        $object->setIdEstablecimiento($parameters['idEstablecimiento']);
        $object->setIdRangohora($parameters['idRangohora']);
        $object->setIdAreaModEstab($parameters['idAreaModEstab']);
        $object->setIdDistribucion($parameters['idDistribucion']);

        $request = $this->get('request');
        $this->admin->create($object);

        if($request->get('external') !== null && $request->get('external') === "1") {
            $secHistorialCitaDiaSubsec = new SecHistorialCitaDiaSubsec();

            $citCitasDia            = $em->getRepository('MinsalCitasBundle:CitCitasDia')->findOneById($object->getId());
            $secHistorialClinico    = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->findOneById($request->get('idHistorialClinico'));
            $ctlTipoCitaSubsecuente = $em->getRepository('MinsalSeguimientoBundle:CtlTipoCitaSubsecuente')->findOneById($request->get('external_tipo'));

            $secHistorialCitaDiaSubsec->setIdHistorialClinico($secHistorialClinico);
            $secHistorialCitaDiaSubsec->setIdCitaDia($citCitasDia);
            $secHistorialCitaDiaSubsec->setIdTipoCitaSubsecuente($ctlTipoCitaSubsecuente);

            $this->admin->create($secHistorialCitaDiaSubsec);
        }

        return $object->getId();
    }

    private function updateCita($id, $parameters) {
        $em = $this->getDoctrine()->getManager();
        $citCitasDia = $em->getRepository('MinsalCitasBundle:CitCitasDia')->findOneById($id);

        $citCitasDia->setIdTipocita($parameters['idTipocita']);
        $citCitasDia->setIdEstado($parameters['idEstadoAct']);
        $citCitasDia->setFecha($parameters['fecha']);
        $citCitasDia->setIdJustificacion($parameters['idMotivoAct']);
        $citCitasDia->setIdRangohora($parameters['idRangohora']);
        $citCitasDia->setIdusuariomod($parameters['idusuarioreg']);
        $citCitasDia->setfechahoramod($parameters['fechahorareg']);
        $citCitasDia->setIdDistribucion($parameters['idDistribucion']);

        $this->admin->update($citCitasDia);
    }

    public function agendaDiaAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (($user->hasRole('ROLE_SONATA_ADMIN_CITCITASDIA_LIST') === false || $user->getIdEmpleado()->getIdTipoEmpleado()->getCodigo()!= 'MED')&& $user->hasRole('ROLE_SUPER_ADMIN') === false) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        return $this->render($this->admin->getTemplate('agenda_dia'), array());
    }

    /**
     * return the Response object associated to the create action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function transferAction()
    {
        if (false === $this->admin->isGranted('TRANSFER')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
        }

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate('transfer'), array(
            'action' => 'transfer',
            'form'   => $view,
            'object' => $object,
        ));
    }

    public function cseleccionAction() {
        $em                 = $this->getDoctrine()->getManager();
        $session            = $this->container->get('session');
        $user               = $this->container->get('security.context')->getToken()->getUser();
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $establecimiento    = $user->getIdEstablecimiento() ? $user->getIdEstablecimiento()->getId() : ( $user->getIdEmpleado() ? ( $user->getIdEmpleado()->getIdEstablecimiento() ? $user->getIdEmpleado()->getIdEstablecimiento()->getId() : $CtlEstablecimiento->getId() ) : $CtlEstablecimiento->getId() );
        $tipoEmpleado       = $user->getIdEmpleado() ? ( $user->getIdEmpleado()->getIdTipoEmpleado() ? $user->getIdEmpleado()->getIdTipoEmpleado()->getCodigo() : NULL ) : NULL;
        $result_modalidad   = "";

        if ($user->hasRole('ROLE_SONATA_ADMIN_CITCITASDIA_CSELECCION') === false && $user->hasRole('ROLE_SUPER_ADMIN') === false) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $idEsp = $session->get('_idEmpEspecialidadEstab');

        if (!empty($idEsp)) {
            $idModalidad = $this->getDoctrine()->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')
                            ->find($idEsp)->getIdAreaModEstab()->getIdModalidadEstab()->getIdModalidad()->getId();
        } else {
            $idModalidad = 1;
            $dql_modalidad = "SELECT me.id, m.nombre FROM MinsalSiapsBundle:MntModalidadEstablecimiento me "
                    . "JOIN MinsalSiapsBundle:CtlModalidad m WHERE m.id=me.idModalidad AND me.idEstablecimiento=" . $establecimiento;
            $result_modalidad = $em->createQuery($dql_modalidad)->getArrayResult();
        }
        /**********************************************************
         *   SQl que obtiene las atenciones del establecimiento   *
         **********************************************************/
        $sql = "SELECT t02.id id_especialidad,
                CASE WHEN t02.nombre_ambiente IS NOT NULL THEN
                    CASE WHEN id_servicio_externo_estab IS NOT NULL THEN t05.abreviatura ||'-->' ||t02.nombre_ambiente
                         ELSE t02.nombre_ambiente
                    END
                ELSE
                    CASE WHEN id_servicio_externo_estab IS NOT NULL THEN t05.abreviatura ||'--> ' || t01.nombre
                         WHEN not exists (select nombre_ambiente from mnt_aten_area_mod_estab where nombre_ambiente=t01.nombre) THEN t01.nombre
                    END
                END AS servicio
                FROM  ctl_atencion                  		t01
                INNER JOIN mnt_aten_area_mod_estab              t02 ON (t01.id = t02.id_atencion AND t01.id_tipo_atencion != 4)
                INNER JOIN mnt_area_mod_estab           	t03 ON (t03.id = t02.id_area_mod_estab)
                LEFT  JOIN mnt_servicio_externo_establecimiento t04 ON (t04.id = t03.id_servicio_externo_estab)
                LEFT  JOIN mnt_servicio_externo             	t05 ON (t05.id = t04.id_servicio_externo)
                LEFT  JOIN mnt_modalidad_establecimiento 	t06 ON (t06.id = t03.id_modalidad_estab)
                WHERE t02.id_establecimiento = :idestablecimiento
                        AND t03.id_area_atencion = 1
                        AND t06.id_modalidad = :idModalidad
                ORDER BY 2";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idestablecimiento', $establecimiento);
        $stm->bindValue(':idModalidad', $idModalidad);

        $stm->execute();
        $result_atencion = $stm->fetchAll();
        $dql_prioridad = "SELECT p.id, p.nombre FROM MinsalCitasBundle:CtlPrioridad p ORDER BY p.id DESC";

        $fecha = Date("Y-m-d");

        /***************************************************************************
         *  OBTIENE LOS MEDICOS DE TODAS LAS AREAS DE ATENCION,                    *
         *  CON LA CAPACIDAD DE CITAS Y EL TOTAL DE CITAS ASIGNADAS                *
         ***************************************************************************/
        $sql = "WITH Medicos AS ( SELECT aame.id AS id_servicio,a.nombre AS servicio,em.nombreempleado AS nombre,
                em.id as id_empleado FROM mnt_empleado_especialidad_estab  est
              JOIN mnt_empleado em ON em.id=est.id_empleado
              JOIN mnt_aten_area_mod_estab aame ON aame.id=est.id_aten_area_mod_estab AND aame.id_establecimiento=:idestablecimiento
               JOIN ctl_atencion a ON a.id=aame.id_atencion
              JOIN mnt_area_mod_estab ame ON ame.id=aame.id_area_mod_estab
              JOIN mnt_modalidad_establecimiento me ON me.id=ame.id_modalidad_estab
                AND me.id_modalidad=:idmodalidad  ),"
                . " Capacidad AS (SELECT TO_CHAR(t01.date, 'YYYY/MM/DD') AS date,

                       COALESCE(t02.primera_vez, 0) AS primera_vez,
                       COALESCE(t02.subsecuentes, 0) AS subsecuentes,
                       COALESCE(t02.agregados, 0) AS agregados,
                       id_empleado,
                       idEspecialidad
                FROM (
                        SELECT serie::date AS date, EXTRACT(DOW FROM serie) AS DOW
                        FROM generate_series ('" . $fecha . "'::timestamp, '" . $fecha . "'::timestamp, '1 day'::interval) serie) t01
                LEFT OUTER JOIN (
                    SELECT d.yrs,
                	      d.mes,
                	       d.dia,
                               d.id_empleado,
                                t03.id idEspecialidad,
                	       SUM(primera) AS primera_vez,
                	       SUM(subsecuente) AS subsecuentes,
                	       SUM(max_citas_agregadas) AS agregados
                	FROM cit_distribucion d
                        JOIN mnt_area_mod_estab t02 ON t02.id=d.id_area_mod_estab
                	JOIN mnt_aten_area_mod_estab t03 ON t02.id=t03.id_area_mod_estab
                	AND t03.id=d.id_aten_area_mod_estab
                	GROUP BY d.yrs,
                	      d.mes,
                	       d.dia,
                               d.id_empleado,
                               t03.id
                	ORDER BY yrs, mes, dia) t02 ON (t02.yrs = EXTRACT(YEAR FROM t01.date::timestamp)
                		  AND t02.mes = EXTRACT(MONTH FROM t01.date::timestamp)
                		  AND t02.dia = EXTRACT(DOW FROM t01.date::timestamp))
                    ORDER BY date), "
                . " CitasAtendidas AS (SELECT TO_CHAR(t05.date, 'YYYY/MM/DD') AS date,
                       COALESCE(t06.primeraVez,0) AS primera_vez,
                       COALESCE(t06.subsecuentes,0) AS subsecuentes,
                       COALESCE(t06.agregados,0) AS agregados,
                       COALESCE(t06.totalCitas,0) AS total_citas,
                       COALESCE(t06.atendidos,0) AS atendidos,
                       t06.id_empleado id_empleado,
                       t06.idEspecialidad idEspecialidad
                FROM (
                      SELECT serie::date AS date
                      FROM generate_series ('" . $fecha . "'::timestamp,'" . $fecha . "'::timestamp, '1 day'::interval) serie) t05
                LEFT OUTER JOIN (
                      SELECT DISTINCT t01.id_aten_area_mod_estab As idEspecialidad,t01.fecha as date,
                             SUM((CASE WHEN t01.id_tipocita = 1 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as primeraVez,
                             SUM((CASE WHEN t01.id_tipocita = 2 THEN 1 ELSE 0 END) * (CASE WHEN t01.id_estado <> 6 THEN 1 ELSE 0 END)) as subsecuentes,
                             SUM(CASE WHEN t01.id_estado = 6 THEN 1 ELSE 0 END) as agregados,
                             COUNT(t01.id_tipocita) as totalCitas,
                             t03.id id_empleado,
                             SUM((CASE WHEN t01.id_estado = 5 THEN 1 ELSE 0 END) + (CASE WHEN t01.id_estado = 7 THEN 1 ELSE 0 END)) atendidos
                      FROM cit_citas_dia        t01
                      INNER JOIN mnt_expediente t02 ON (t01.id_expediente = t02.id)
                      INNER JOIN mnt_empleado 	t03 ON (t01.id_empleado   = t03.id)
                      WHERE t01.fecha >= '" . $fecha . "' AND t01.fecha<= '" . $fecha . "'
                            AND t01.id_estado <> 3
                      GROUP BY t01.id_aten_area_mod_estab,t01.fecha,t03.id) t06 ON (t05.date = t06.date)
                      ORDER BY date)"
                . " SELECT t01.id_servicio AS id_servicio, servicio, t08.id_empleado AS id_empleado, upper(t01.nombre) nombre_empleado,"
                . " SUM(t08.primera_vez+t08.subsecuentes) AS capacidad,t03.total_citas total_citas,"
                . "  COALESCE((SUM(t08.primera_vez+t08.subsecuentes)-t03.total_citas), SUM(t08.primera_vez+t08.subsecuentes)) AS can_disponible"
                . " FROM Medicos t01 inner join Capacidad t08 ON t08.id_empleado=t01.id_empleado "
                . " AND t08.idespecialidad=t01.id_servicio"
                . " left join CitasAtendidas t03 ON t03.id_empleado=t01.id_empleado AND t03.idEspecialidad=t08.idEspecialidad"
                . " GROUP BY t01.id_servicio,t01.id_empleado,servicio, t08.id_empleado, t01.nombre,t03.total_citas "
                . "ORDER BY can_disponible DESC";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':idestablecimiento', $establecimiento);
        $stm->bindValue(':idmodalidad',$idModalidad);
        $stm->execute();
        $result_medico_area = $stm->fetchAll();

        $result_prioridad = $em->createQuery($dql_prioridad)
                ->getArrayResult();

        return $this->render($this->admin->getTemplate('cseleccion'), array('medicos' => $result_medico_area,
                    'atencion' => $result_atencion,
                    'prioridad' => $result_prioridad,
                    'result_modalidad' => $result_modalidad,
                    'tipoEmpleado' => $tipoEmpleado));
    }

    /**
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException|\Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @param mixed $id
     *
     * @return Response|RedirectResponse
     */
    public function citamedicaBusquedaAction(){

        if (false === $this->admin->isGranted('LISTAMEDICA_LIST') && (false === $this->admin->isGranted('REPORTES'))) {
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

            $cita=$em->getRepository('MinsalCitasBundle:CitCitasDia')->find($idCita);
            $parameters = array(
                            'idEstadoAct'        => $em->getRepository('MinsalCitasBundle:CitEstadoCita')->find(9),
                            'idMotivoAct'        => $cita->getIdJustificacion(),
                            'fecha'              => $cita->getFecha(),
                            'idusuarioreg'       => $usuario,
                            'fechahorareg'       => $fechaActual,
                            'idRangohora'        => $cita->getIdRangohora(),
                            'idTipocita'         => $cita->getIdTipoCita(),
                            'idDistribucion'     => $cita->getIdDistribucion()
            );

            $this->updateCita($idCita, $parameters);
            $this->addFlash('sonata_flash_success', 'Cita Eliminada satisfactoriamente');
        }

        $areas = $em->getRepository("MinsalSiapsBundle:MntAreaModEstab")->findBy(array('idAreaAtencion' => 1));

        return $this->render('MinsalCitasBundle:CitasMedicas:delete.html.twig', array(
            'action'     => 'delete',
            'idExpediente' => $idExpediente,
            'idAreaModEstab'=>$idAreaModEstab,
            'areas'=>$areas
        ));
    }

    public function asignarAction() {
        if (false === $this->admin->isGranted('ASIGNAR')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
        }

        $request = $this->get('request');

        $idPaciente = $request->get('id')?:NULL;

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());
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
            $AreaModEstab = $em
                    ->createQuery($dql)
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

        return $this->render($this->admin->getTemplate('asignar'), array(
                            'action' => 'list',
                            'areas' => $areas,
                            'idAreaModEstab'=> $idAreaModEstab,
                            'idExpediente' => $expediente,
                            'idEstablecimientoReferencia'=>$idEstablecimientoReferencia,
                            'expedienteReferencia'=>$numeroExpedienteReferencia
                ));
    }

    /**
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException|\Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @return Response|RedirectResponse
     */
    public function reprogramarAction() {
        $template = 'reprogramar';

        if (false === $this->admin->isGranted('REPROGRAMAR')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
        }

        $request = $this->getRequest();
        $session = $this->container->get('session');
        $em      = $this->getDoctrine()->getManager();

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        $citasProcesadas  = array();
        $citas            = $request->get('citas');
        $searchParameters = array();
        $citasLength      = $citas !== NULL ? count($citas) : 0;

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        if ( $this->getRestMethod() === 'POST' ) {
            if($request->get('action') !== NULL && $request->get('action') === 'reprogramar') {
                $now   = new \DateTime();
                $fecha = new \DateTime();
                $fecha->add(new \DateInterval('P1D'));
                $user  = $this->getUser();

                $searchParameters = $request->get('searchParameters');
                $citasService     = $this->container->get('cit_citas_dia.services');
                $citasProcesadas  = array('reprogramadas' => array(), 'noReprogramadas' => array());

                if( $citasLength > 0 ) {
                    for ( $i=0; $i < count($citas) ; $i++ ) {
                        $datosCita = $em->getRepository('MinsalCitasBundle:CitCitasDia')->findOneById($citas[$i]);

                        $idCita         = $datosCita->getId();
                        $idEmpleado     = $datosCita->getIdEmpleado()->getId();
                        $idEspecialidad = $datosCita->getIdAtenAreaModEstab()->getId();
                        $idExpediente   = $datosCita->getIdExpediente()->getId();
                        $idTipoCita     = $datosCita->getIdTipocita()->getId();
                        $idAreaModEstab = $datosCita->getIdAreaModEstab()->getId();

                        $estadoReprogramacion = 0;  // Estados: 0 - No reprogramada | 1 - Reprogramada | 2 - Sin Reprogramacion por falta de cupo
                        $citaProcesada        = $datosCita;

                        while ( $estadoReprogramacion === 0 ) {
                            $cupoDisponible = $citasService->obtenerCupoDisponible($idEmpleado, $idExpediente, $idTipoCita, $idEspecialidad, $idAreaModEstab, NULL, $fecha, NULL, 1, FALSE, TRUE);

                            if( count($cupoDisponible) > 0 ) {
                                $cupoDisponible  = $cupoDisponible[0];
                                $fecha           = $cupoDisponible['fecha'];
                                $idRangoHora     = $cupoDisponible['idRangoHora'];
                                $idDistribucion  = $cupoDisponible['idDistribucion'];
                                $idEstadoCita    = 4;
                                $citaInsertada   = $citasService->insertarCita($idEmpleado, $idExpediente, $idEspecialidad, $fecha, $idRangoHora, $idTipoCita, $idEstadoCita, $idDistribucion);

                                if( $citaInsertada['estado'] ) {
                                    $CitEstadoCita = $em->getRepository('MinsalCitasBundle:CitEstadoCita')->findOneById(3);
                                    $citaProcesada->setIdEstado($CitEstadoCita);
                                    $citaProcesada->setIdusuariomod($user);
                                    $citaProcesada->setFechahoramod($now);

                                    $this->admin->update($citaProcesada);

                                    $citaProcesada = $em->getRepository('MinsalCitasBundle:CitCitasDia')->findOneById($citaInsertada['idCita']);

                                    $estadoReprogramacion = 1;
                                } else {
                                    $estadoReprogramacion = 0;
                                }
                            } else {
                                $estadoReprogramacion = 2;
                            }
                        }

                        $tipoProcesoCita = $estadoReprogramacion === 1 ? 'reprogramadas' : 'noReprogramadas';

                        $citasProcesadas[$tipoProcesoCita][] = $citaProcesada->getId();
                    }

                    if( count($citasProcesadas) > 0 ) {
                        $generator = new SecureRandom();
                        $random    = $generator->nextBytes(10);
                        $session->set('_cit_reprogramacion_token', $random);

                        return new RedirectResponse($this->admin->generateUrl('reprogramar', array(
                            'token'            => $random,
                            'citasProcesadas'  => $citasProcesadas,
                            'searchParameters' => $searchParameters,
                            'citasLength'      => $citasLength
                        )));
                    } else {
                        $this->addFlash('sonata_flash_error', 'Lo sentimos pero hubo un error, ninguna cita pudo ser procesada. Por favor intente nuevamente si el problema persiste contacte al administrador');
                    }
                } else {
                    $this->addFlash('sonata_flash_error', 'Lo sentimos pero hubo un error al procesar las citas y no se pudo obtener los datos de ninguna cita, por favor intente nuevamente, si el problema persiste contacte con el administrador');
                }
            }
        }

        if( $session->has('_cit_reprogramacion_token') && $session->get('_cit_reprogramacion_token') === $request->get('token') ) {
            $citasProcesadas  = $request->get('citasProcesadas');
            $searchParameters = $request->get('searchParameters');
            $citasLength      = $request->get('citasLength') ? intval($request->get('citasLength')) : 0;
            $mntEmpleado      = $em->getRepository('MinsalSiapsBundle:MntEmpleado')->findOneById($searchParameters['idEmpleado']);
            $mntEspecialidad  = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($searchParameters['idEspecialidad']);

            $citasProcesadas['reprogramadas']   = array_key_exists('reprogramadas', $citasProcesadas) ? $this->crearDatosCitasProcesadas($citasProcesadas['reprogramadas']) : array();
            $citasProcesadas['noReprogramadas'] = array_key_exists('noReprogramadas', $citasProcesadas) ? $this->crearDatosCitasProcesadas($citasProcesadas['noReprogramadas']) : array();

            $citasProcesadas['mensaje'] = array();

            if( count($citasProcesadas['reprogramadas']) === $citasLength ) {
                $citasProcesadas['mensaje']['tipo']        = 'success';
                $citasProcesadas['mensaje']['descripcion'] = 'La reprogramacion de citas se realizo de manera exitosa.';
            } else {
                if( count($citasProcesadas['noReprogramadas']) === $citasLength ) {
                    $citasProcesadas['mensaje']['tipo']        = 'danger';
                    $citasProcesadas['mensaje']['descripcion'] =
                        'Ningun cita ha sido reprogramada esto puede ser debido a <strong>alguna de las siguientes razones</strong>: <br />'.
                        '<ul>'.
                            '<li>El M&eacute;dico <strong>'.$mntEmpleado->getNombreempleado().'</strong> ya no tiene cupos disponible en las distribuciones creadas para la Especialidad: <strong>'.$mntEspecialidad->getNombreConsulta().'</strong></li>'.
                            '<li>Ninguna distribuci&oacute;n ha sido creada para el M&eacute;dico <strong>'.$mntEmpleado->getNombreempleado().'</strong></li>'.
                            '<li>No se encontró ningun cupo disponible para los dias intermedios entre citas configurados</li>'.
                        '</ul>';
                } else {
                    $citasProcesadas['mensaje']['tipo']        = 'warning';
                    $citasProcesadas['mensaje']['descripcion'] =
                        'Algunas citas no pudieron ser reprogramdas debido a <strong>alguna de las siguientes razones</strong>: <br />'.
                        '<ul>'.
                            '<li>El M&eacute;dico <strong>'.$mntEmpleado->getNombreempleado().'</strong> ya no tiene cupos disponible en las distribuciones creadas para la Especialidad: <strong>'.$mntEspecialidad->getNombreConsulta().'</strong></li>'.
                            '<li>No se encontró ningun cupo disponible para los dias intermedios entre citas configurados</li>'.
                        '</ul>';
                }
            }
        }

        return $this->render($this->admin->getTemplate($template), array(
            'action'           => 'reprogramar',
            'form'             => $view,
            'object'           => $object,
            'citasProcesadas'  => $citasProcesadas,
            'searchParameters' => $searchParameters
        ));
    }

    private function crearDatosCitasProcesadas($citas) {
        $em = $this->getDoctrine()->getManager();
        $citasProcesadas = array();

        foreach ($citas as $key => $cita) {
            $citaProcesada = $em->getRepository('MinsalCitasBundle:CitCitasDia')->findOneById($cita);

            $citasProcesadas[] = array(
                'id'                    => $citaProcesada->getId(),
                'idTipoCita'            => $citaProcesada->getIdTipocita()->getId(),
                'nombreTipoCita'        => $citaProcesada->getIdEstado()->getId() === 6 ? 'Agregado' : ( $citaProcesada->getIdTipocita()->getId() === 1 ? 'Primera Vez' : 'Subsecuente' ),
                'idEspecialidad'        => $citaProcesada->getIdAtenAreaModEstab()->getId(),
                'nombreEspecialidad'    => $citaProcesada->getIdAtenAreaModEstab()->getNombreConsulta(),
                'idEstadoCita'          => $citaProcesada->getIdEstado()->getId(),
                'nombreEstadoCita'      => $citaProcesada->getIdEstado()->getEstado(),
                'fecha'                 => $citaProcesada->getFecha()->format('d/m/Y'),
                'idJustificacion'       => $citaProcesada->getIdJustificacion() ? $citaProcesada->getIdJustificacion()->getId() : NULL,
                'nombreJustificacion'   => $citaProcesada->getIdJustificacion() ? $citaProcesada->getIdJustificacion()->getNombre() : NULL,
                'idEmpleado'            => $citaProcesada->getIdEmpleado()->getId(),
                'nombreEmpleado'        => $citaProcesada->getIdEmpleado()->getNombreempleado(),
                'idExpediente'          => $citaProcesada->getIdExpediente()->getId(),
                'numeroExpediente'      => $citaProcesada->getIdExpediente()->getNumero(),
                'idPaciente'            => $citaProcesada->getIdExpediente()->getIdPaciente()->getId(),
                'nombrePaciente'        => $citaProcesada->getIdExpediente()->getIdPaciente()->getNombrePaciente(),
                'idEstablecimiento'     => $citaProcesada->getIdEstablecimiento()->getId(),
                'nombreEstablecimiento' => $citaProcesada->getIdEstablecimiento()->getNombre(),
                'idRangoHora'           => $citaProcesada->getIdRangohora()->getId(),
                'horaIni'               => $citaProcesada->getIdRangohora()->getFormatterHoraIni(),
                'horaFin'               => $citaProcesada->getIdRangohora()->getFormatterHoraFin(),
                'rangoHora'             => $citaProcesada->getIdRangohora()->getFormatterRangHora(),
                'idAreaModEstab'        => $citaProcesada->getIdAreaModEstab()->getId(),
                'nombreAreaModEstab'    => $citaProcesada->getIdAreaModEstab()->__toString(),
                'idDistribucion'        => $citaProcesada->getIdDistribucion() ? $citaProcesada->getIdDistribucion()->getId() : NULL
            );
        }

        return $citasProcesadas;
    }

    /**
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException|\Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @return Response|RedirectResponse
     */
    public function citaReferenciaAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if ($user->hasRole('ROLE_SONATA_ADMIN_CITCITASDIA_REFERENCIA') === false && $user->hasRole('ROLE_SUPER_ADMIN') === false && $user->hasRole('ROLE_SONATA_ADMIN_CITCITASPROCEDIMIENTOS_REFERENCIA') === false) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $origenCita = $this->get('request')->get('origenCita');
         //Por defecto es uno por si el valor no estuviera inicializado
        if($origenCita != '2')
            $origenCita = '1';

        $procedencia='citas';

        return $this->render($this->admin->getTemplate('cita_referencia'), array(
            'action' => 'list',
            'procedencia' => $procedencia,
            'origenCita' => $origenCita
        ));
    }

    /**
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException|\Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @param mixed $id
     *
     * @return Response|RedirectResponse
     */
    public function citamedicaConsultaAction() {
        $em = $this->getDoctrine()->getManager();

        if (false === $this->admin->isGranted('LISTAMEDICA_LIST') && (false === $this->admin->isGranted('REPORTES'))) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
            'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')));
        }
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $MntAtenAreaModEstab = $request->get('idAtenAreaModEstab') ? $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($request->get('idAtenAreaModEstab')) : NULL;

        $idAreaModEstab = $request->get('idAreaModEstab') ? $request->get('idAreaModEstab') : ( $MntAtenAreaModEstab ? $MntAtenAreaModEstab->getIdAreaModEstab()->getId() : NULL );
        $idusuarioreg   = $this->container->get('security.context')->getToken()->getUser();

        if (!$idusuarioreg->hasRole('ROLE_SUPER_ADMIN') && $idAreaModEstab === NULL) {
            $idEmpleado = $idusuarioreg->getIdEmpleado()->getId();

            $dql = "SELECT A
                  FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab A
                  JOIN A.idEmpleado B
                  WHERE B.id = $idEmpleado";

            $AreaModEstab = $em->createQuery($dql)
                               ->getResult();

            $idAreaModEstab = $AreaModEstab[0]->getIdAreaModEstab()->getId();
        }

        $areas = $em->getRepository("MinsalSiapsBundle:MntAreaModEstab")->findBy(array('idAreaAtencion' => 1));

        return $this->render('MinsalCitasBundle:CitasMedicas:citasPorDia.html.twig', array(
            'action'         => 'list',
            'idAreaModEstab' => $idAreaModEstab,
            'areas'          => $areas
        ));
    }

    public function citamedicaFechaslibresAction(){

        if (false === $this->admin->isGranted('LISTAMEDICA_LIST') && (false === $this->admin->isGranted('REPORTES'))) {
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

        return $this->render('MinsalCitasBundle:CitasMedicas:fechasLibres.html.twig', array(
            'action'     => 'list',
            'idAreaModEstab'=>$idAreaModEstab,
            'areas'=>$areas
        ));
    }

    public function citamedicaEstadisticaAction(){

        if (false === $this->admin->isGranted('LISTAMEDICA_LIST') && (false === $this->admin->isGranted('REPORTES'))) {
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
        $sql="SELECT DISTINCT EXTRACT('YEAR' FROM fecha) as anio FROM cit_citas_dia ORDER BY anio ASC";
        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $anios = $stm->fetchAll();

        return $this->render('MinsalCitasBundle:CitasMedicas:estadisticaMedico.html.twig', array(
            'action'     => 'list',
            'idAreaModEstab'=>$idAreaModEstab,
            'areas'=>$areas,
            'anios'=>$anios
        ));
    }

    public function citamedicaEliminadasAction(){

        if (false === $this->admin->isGranted('LISTAMEDICA_LIST') && (false === $this->admin->isGranted('REPORTES'))) {
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

        return $this->render('MinsalCitasBundle:CitasMedicas:citasEliminadas.html.twig', array(
            'action'     => 'list',
            'idAreaModEstab'=>$idAreaModEstab,
            'areas'=>$areas
        ));
    }

    public function citamedicaProgramadasAction(){

        if (false === $this->admin->isGranted('LISTAMEDICA_LIST') && (false === $this->admin->isGranted('REPORTES'))) {
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

        return $this->render('MinsalCitasBundle:CitasMedicas:programadas.html.twig', array(
            'action'     => 'list',
            'idAreaModEstab'=>$idAreaModEstab,
            'areas'=>$areas
        ));
    }

    public function reporteProduccionAction(){

        if (false === $this->admin->isGranted('LISTAMEDICA_LIST') && (false === $this->admin->isGranted('REPORTES'))) {
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

        return $this->render('MinsalCitasBundle::produccionCitasRecurso.html.twig', array(
            'idAreaModEstab'=>$idAreaModEstab,
            'areas'=>$areas
        ));
    }
}
