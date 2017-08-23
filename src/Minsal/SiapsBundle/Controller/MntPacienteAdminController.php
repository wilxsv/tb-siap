<?php

namespace Minsal\SiapsBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\Metodos\Funciones;

class MntPacienteAdminController extends Controller {

    public function viewAction() {
        if (false === $this->admin->isGranted('VIEW')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }
        $em = $this->getDoctrine()->getManager();
        $valor = $this->get('request')->get('id');
        $clasificacion = $this->get('request')->get('clasificacion');
        $procedencia = $this->get('request')->get('procedencia');

        $datos_paciente = $em->getRepository("MinsalSiapsBundle:MntPaciente")->obtenerDatosPaciente($valor);
        $conn = $em->getConnection();
        $calcular = new Funciones();
        if ($datos_paciente->getHoraNacimiento())
            $edad = $calcular->calcularEdad($conn, $datos_paciente->getFechaNacimiento()->format('d-m-Y'), $datos_paciente->getHoraNacimiento()->format('H:i'));
        else
            $edad = $calcular->calcularEdad($conn, $datos_paciente->getFechaNacimiento()->format('d-m-Y'));

        $fechaActual = new \DateTime();
        if (is_null($datos_paciente->getFechaMod()))
            $fechaFinal = $fechaActual;
        else
            $fechaFinal = $datos_paciente->getFechaMod();
        $diferenciaUltimaActualizacion = $fechaActual->diff($fechaFinal)->format('%a');

        if ((int) $diferenciaUltimaActualizacion > 180) {
            $this->addFlash('sonata_flash_info', "<strong>NOTA:</strong>"
                    . "<br/> <span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>"
                    . "Tiene <strong>$diferenciaUltimaActualizacion </strong> días de no actualizar este paciente. "
                    . "Debería actualizar este paciente para tener al dia todos los datos");
        }

        if($clasificacion==1){
            $this->addFlash('sonata_flash_info', "<strong>ADVERTENCIA:</strong>"
                    . "<br/> <span class=\"fa fa-warning\" aria-hidden=\"true\"></span>"
                    . "Este Paciente puede contener:<ul>
                    <li>Historial Clínico</li>
                    <li>Recetas</li>
                    <li>Ingresos Realizados</li>
                    <li>Exámenes de laboratorios</li></ul>
                    <strong>Realizar solamente los cambios que sean estrictamente necesarios, ya que esto puede
                    afectar el Historial Clinico Electrónico del paciente causando incoherencia con los datos
                    físico de este expediente.
                    </strong>
                    ");
        }
        return $this->render($this->admin->getTemplate('view'), array(
                    'action' => 'view',
                    'datos' => $datos_paciente,
                    'edad' => $edad,
                    'procedencia'=>$procedencia,
                    'clasificacion'=>$clasificacion
        ));
    }

    /**
     * REESCRITO PARA QUE CUANDO SEA LA BUSQUEDA DE LA REGIONAL LE CARGUE POR DEFECTO LOS VALORES QUE POSEE
     * EL PACIENTE Y ASÍ SOLO LLENE LOS CAMPOS QUE HAGAN FALTA
     *
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
        $procedencia=$this->get('request')->get('procedencia')?:'c';
        //AGREGADO PARA VERIFICAR SI PROVIENE DE LA BUSQUEDA GLOBAL
        if (strcmp($this->get('request')->get('tipo'), 'g') == 0) {
            $id = $this->get('request')->get('idPacienteInicial');
            $em = $this->getDoctrine()->getManager();
            $establecimientoPN = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento();
            $regional = $establecimientoPN->getIdEstablecimientoPadre()->getIdEstablecimientoPadre();
            $conexion = $em->getRepository('MinsalSiapsBundle:MntConexion')->findOneBy(array('idEstablecimiento' => $regional));
            $conn = $em->getRepository('MinsalSiapsBundle:MntConexion')->getConexionGenerica($conexion);
            $sql = "SELECT * FROM mnt_paciente WHERE id=$id";
            $query = $conn->query($sql);
            foreach ($query->fetchAll() as $aux) {
                $object->setPrimerNombre($aux['primer_nombre']);
                $object->setSegundoNombre($aux['segundo_nombre']);
                $object->setTercerNombre($aux['tercer_nombre']);
                $object->setPrimerApellido($aux['primer_apellido']);
                $object->setSegundoApellido($aux['segundo_apellido']);
                $object->setApellidoCasada($aux['apellido_casada']);
                $object->setFechaNacimiento(new \DateTime($aux['fecha_nacimiento']));
                $object->setHoraNacimiento($aux['hora_nacimiento']);
                $object->setNumeroDocIdePaciente($aux['numero_doc_ide_paciente']);
                $object->setDireccion($aux['direccion']);
                $object->setTelefonoCasa($aux['telefono_casa']);
                $object->setLugarTrabajo($aux['lugar_trabajo']);
                $object->setTelefonoTrabajo($aux['telefono_trabajo']);
                if ($aux['id_area_cotizacion'] != null)
                    $object->setIdAreaCotizacion($em->getRepository('MinsalSiapsBundle:CtlAreaCotizante')->find($aux['id_area_cotizacion']));
                $object->setAsegurado($aux['asegurado']);
                $object->setCotizante($aux['cotizante']);
                $object->setNumeroAfiliacion($aux['numero_afiliacion']);
                $object->setNombrePadre($aux['nombre_padre']);
                $object->setNombreMadre($aux['nombre_madre']);
                $object->setNombreConyuge($aux['nombre_conyuge']);
                $object->setNombreResponsable($aux['nombre_responsable']);
                $object->setDireccionResponsable($aux['direccion_responsable']);
                $object->setTelefonoResponsable($aux['telefono_responsable']);
                $object->setNumeroDocIdeResponsable($aux['numero_doc_ide_responsable']);
                $object->setNombreProporcionoDatos($aux['nombre_proporciono_datos']);
                $object->setNumeroDocIdeProporDatos($aux['numero_doc_ide_propor_datos']);
                $object->setObservacion($aux['observacion']);
                $object->setConocidoPor($aux['conocido_por']);
                $object->setIdSiff($aux['id_siff']);
                $object->setDispensarizacionIndividual($aux['dispensarizacion_individual']);
                $object->setIdPacienteInicial($aux['id']);
                if ($aux['area_geografica_domicilio'] != null)
                    $object->setAreaGeograficaDomicilio($em->getRepository('MinsalSiapsBundle:CtlAreaGeografica')->find($aux['area_geografica_domicilio']));
                if ($aux['id_canton_domicilio'] != null)
                    $object->setIdCantonDomicilio($em->getRepository('MinsalSiapsBundle:CtlCanton')->find($aux['id_canton_domicilio']));
                if ($aux['id_departamento_domicilio'] != null)
                    $object->setIdDepartamentoDomicilio($em->getRepository('MinsalSiapsBundle:CtlDepartamento')->find($aux['id_departamento_domicilio']));
                if ($aux['id_doc_ide_paciente'] != null)
                    $object->setIdDocPaciente($em->getRepository('MinsalSiapsBundle:CtlDocumentoIdentidad')->find($aux['id_doc_ide_paciente']));
                if ($aux['id_doc_ide_proporciono_datos'] != null)
                    $object->setIdDocProporcionoDatos($em->getRepository('MinsalSiapsBundle:CtlDocumentoIdentidad')->find($aux['id_doc_ide_proporciono_datos']));
                if ($aux['id_doc_ide_responsable'] != null)
                    $object->setIdDocResponsable($em->getRepository('MinsalSiapsBundle:CtlDocumentoIdentidad')->find($aux['id_doc_ide_responsable']));
                if ($aux['id_municipio_domicilio'] != null)
                    $object->setIdMunicipioDomicilio($em->getRepository('MinsalSiapsBundle:CtlMunicipio')->find($aux['id_municipio_domicilio']));
                if ($aux['id_municipio_nacimiento'] != null)
                    $object->setIdMunicipioNacimiento($em->getRepository('MinsalSiapsBundle:CtlMunicipio')->find($aux['id_municipio_nacimiento']));
                if ($aux['id_departamento_nacimiento'] != null)
                    $object->setIdDepartamentoNacimiento($em->getRepository('MinsalSiapsBundle:CtlDepartamento')->find($aux['id_departamento_nacimiento']));
                if ($aux['id_nacionalidad'] != null)
                    $object->setIdNacionalidad($em->getRepository('MinsalSiapsBundle:CtlNacionalidad')->find($aux['id_nacionalidad']));
                if ($aux['id_ocupacion'] != null)
                    $object->setIdOcupacion($em->getRepository('MinsalSiapsBundle:CtlOcupacion')->find($aux['id_ocupacion']));
                if ($aux['id_pais_nacimiento'] != null)
                    $object->setIdPaisNacimiento($em->getRepository('MinsalSiapsBundle:CtlPais')->find($aux['id_pais_nacimiento']));
                if ($aux['id_parentesco_responsable'] != null)
                    $object->setIdParentescoResponsable($em->getRepository('MinsalSiapsBundle:CtlParentesco')->find($aux['id_parentesco_responsable']));
                if ($aux['id_parentesco_propor_datos'] != null)
                    $object->setIdParentescoProporDatos($em->getRepository('MinsalSiapsBundle:CtlParentesco')->find($aux['id_parentesco_propor_datos']));
                if ($aux['id_sexo'] != null)
                    $object->setIdSexo($em->getRepository('MinsalSiapsBundle:CtlSexo')->find($aux['id_sexo']));
            }
        }else {
            $object->setPrimerNombre($this->get('request')->get('primer_nombre'));
            $object->setPrimerApellido($this->get('request')->get('primer_apellido'));
            $object->setSegundoApellido($this->get('request')->get('segundo_apellido'));
            $object->setSegundoNombre($this->get('request')->get('segundo_nombre'));
            $object->setTercerNombre($this->get('request')->get('tercer_nombre'));
            $object->setNombreMadre($this->get('request')->get('nombre_madre'));
            $object->setConocidoPor($this->get('request')->get('conocido_por'));
            if ($this->get('request')->get('fecha_nacimiento') != '') {
                $fecha_nacimiento = new \DateTime(str_replace('/', '-', $this->get('request')->get('fecha_nacimiento')));
                $object->setFechaNacimiento($fecha_nacimiento);
            }
            if ($this->get('request')->get('dui') != '') {
                $em = $this->getDoctrine()->getManager();
                $object->setIdDocPaciente($em->getRepository('MinsalSiapsBundle:CtlDocumentoIdentidad')->find(1));
                $object->setNumeroDocIdePaciente($this->get('request')->get('dui'));
            }
        }


        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();

        $form->setData($object);

        if ($this->getRestMethod() == 'POST') {
            $form->bind($this->get('request'));

            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                $this->admin->create($object);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                                'result' => 'ok',
                                'objectId' => $this->admin->getNormalizedIdentifier($object)
                    ));
                }

                $this->addFlash('sonata_flash_success', 'flash_create_success');
                // redirect to edit mode
                return $this->redirectTo($object);
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash('sonata_flash_error', 'flash_create_error');
                }
            } elseif ($this->isPreviewRequested()) {
                // pick the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
            }
        }

        $view = $form->createView();
        //var_dump(get_class_vars($view));

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'create',
                    'form' => $view,
                    'object' => $object,
                    'procedencia' => $procedencia
        ));
    }

    /**
     * Para el registro de pacientes desde el área de citas
     *
     * return the Response object associated to the create action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function pacienteCitasAction() {
        // the key used to lookup the template
        $templateKey = 'pacientecitas';

        $user = $this->container->get('security.context')->getToken()->getUser();
        if ($user->hasRole('ROLE_SONATA_ADMIN_CITCITASDIA_REFERENCIA') === false && $user->hasRole('ROLE_SUPER_ADMIN') === false && $user->hasRole('ROLE_SONATA_ADMIN_CITCITASPROCEDIMIENTOS_REFERENCIA') === false) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $object = $this->admin->getNewInstance();
        $procedencia = $this->get('request')->get('procedencia');
        $origenCita = $this->get('request')->get('origenCita');
        $idEstablecimientoReferencia = $this->get('request')->get('idEstablecimientoReferencia');
        $expedienteReferencia = $this->get('request')->get('expedienteReferencia');

        $object->setPrimerNombre($this->get('request')->get('primer_nombre'));
        $object->setPrimerApellido($this->get('request')->get('primer_apellido'));
        $object->setSegundoApellido($this->get('request')->get('segundo_apellido'));
        $object->setSegundoNombre($this->get('request')->get('segundo_nombre'));
        $object->setTercerNombre($this->get('request')->get('tercer_nombre'));
        $object->setNombreMadre($this->get('request')->get('nombre_madre'));
        $object->setConocidoPor($this->get('request')->get('conocido_por'));

        if ($this->get('request')->get('fecha_nacimiento') != '') {
            $fecha_nacimiento = new \DateTime(str_replace('/', '-', $this->get('request')->get('fecha_nacimiento')));
            $object->setFechaNacimiento($fecha_nacimiento);
        }
        if ($this->get('request')->get('dui') != '') {
            $em = $this->getDoctrine()->getManager();
            $object->setIdDocPaciente($em->getRepository('MinsalSiapsBundle:CtlDocumentoIdentidad')->find(1));
            $object->setNumeroDocIdePaciente($this->get('request')->get('dui'));
        }

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->getRestMethod() == 'POST') {
            //   var_dump($object->getExpedientes());exit();
            $form->bind($this->get('request'));

            $isFormValid = $form->isValid();
            //var_dump($expedienteReferencia);exit;
            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                $this->admin->create($object);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                                'result' => 'ok',
                                'objectId' => $this->admin->getNormalizedIdentifier($object)
                    ));
                }

                $this->addFlash('sonata_flash_success', 'flash_create_success');
                // redireccionar a asignarCita
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

                $dql = "SELECT A.id
                      FROM MinsalSiapsBundle:MntExpediente A
                      WHERE A.idPaciente=".$object->getId();
                $idExpediente = $em
                        ->createQuery($dql)
                        ->getResult();
                $idExpediente = $idExpediente[0]['id'];

                if($origenCita == '1'){
                    return $this->render('MinsalCitasBundle:CitasMedicas:asignar.html.twig', array(
                                        'action' => 'list',
                                        'areas' => $areas,
                                        'idAreaModEstab'=> $idAreaModEstab,
                                        'idExpediente' => $idExpediente,
                                        'idEstablecimientoReferencia' => $idEstablecimientoReferencia,
                                        'expedienteReferencia' => $expedienteReferencia
                    ));
                }else {
                    return $this->render('MinsalCitasBundle:CitCitasProcedimientos:asignar.html.twig', array(
                                        'action' => 'list',
                                        'areas' => $areas,
                                        'idAreaModEstab'=> $idAreaModEstab,
                                        'idExpediente' => $idExpediente,
                                        'idEstablecimientoReferencia' => $idEstablecimientoReferencia,
                                        'expedienteReferencia' => $expedienteReferencia
                    ));
                }
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash('sonata_flash_error', 'flash_create_error');
                }
            } elseif ($this->isPreviewRequested()) {
                // pick the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'create',
                    'form' => $view,
                    'object' => $object,
                    'procedencia' => $procedencia,
                    'origenCita' => $origenCita,
                    'idEstablecimientoReferencia' => $idEstablecimientoReferencia,
                    'expedienteReferencia' => $expedienteReferencia
        ));
    }

    /**
     * REESCRITO PARA QUE SABER SI VIENE DE LA EMERGENCIA NO LE PIDA EL NUMERO DE EXPEDIENTE
     *
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
        $em = $this->getDoctrine()->getManager();
        $object = $this->admin->getObject($id);
        $procedencia = $this->get('request')->get('procedencia');
        $clasificacion = $this->get('request')->get('clasificacion');
        $editar = $this->get('request')->get('editar')? : false;

        if($clasificacion==1){
            $this->addFlash('sonata_flash_info', "<strong>ADVERTENCIA:</strong>"
                    . "<br/> <span class=\"fa fa-warning\" aria-hidden=\"true\"></span>"
                    . "Este Paciente puede contener:<ul>
                    <li>Historial Clínico</li>
                    <li>Recetas</li>
                    <li>Ingresos Realizados</li>
                    <li>Exámenes de laboratorios</li></ul>
                    <strong>Realizar solamente los cambios que sean estrictamente necesarios, ya que esto puede
                    afectar el Historial Clinico Electrónico del paciente causando incoherencia con los datos
                    físico de este expediente.
                    </strong>
                    ");
        }

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('EDIT', $object)) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $this->admin->setSubject($object);


        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->getRestMethod() == 'POST') {

            $form->submit($this->get('request'));
            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                $this->admin->update($object);

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
            $view = $form->createView();

            // set the theme for the current Admin Form
            $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

            return $this->render($this->admin->getTemplate($templateKey), array(
                        'action' => 'edit',
                        'form' => $view,
                        'object' => $object,
                        'procedencia' => $procedencia,
                        'clasificacion'=>$clasificacion
            ));

        }

        $dql = 'SELECT e FROM mnt_expediente WHERE idPaciente=' . $object->getId() . ' and habilitado=true';

        $expedienteActual = $expediente = $em->getRepository('MinsalSiapsBundle:MntExpediente')
                ->findOneBy(array('idPaciente' => $object->getId(), 'habilitado' => 'true'))
        ;
        if (is_null($expediente)) {
            if ((is_null($object->getPrimerNombre()) || is_null($object->getPrimerApellido()) || is_null($object->getFechaNacimiento()) || is_null($object->getIdSexo()) || is_null($object->getDireccion()) || is_null($object->getNombreMadre()) || is_null($object->getNombreResponsable()) || is_null($object->getIdDepartamentoNacimiento()) || is_null($object->getIdMunicipioNacimiento()) || is_null($object->getIdParentescoResponsable()) || is_null($object->getIdParentescoProporDatos()) || is_null($object->getAreaGeograficaDomicilio())) || (bool) $editar) {
                $view = $form->createView();

                // set the theme for the current Admin Form
                $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

                return $this->render($this->admin->getTemplate($templateKey), array(
                            'action' => 'edit',
                            'form' => $view,
                            'object' => $object,
                            'procedencia' => $procedencia,
                            'clasificacion'=>$clasificacion
                ));
            } else {

                $params = array();
                $params['id'] = $object->getId();
                $params['procedencia'] = $procedencia;
                $params['clasificacion'] = $clasificacion;
                $url = $this->admin->generateUrl('view', $params);

                return new RedirectResponse($url);
            }
        } else {
            if ((is_null($object->getPrimerNombre()) || is_null($object->getPrimerApellido()) || is_null($object->getFechaNacimiento()) || is_null($object->getIdSexo()) || is_null($object->getDireccion()) || is_null($object->getNombreMadre()) || is_null($object->getNombreResponsable()) || is_null($object->getIdDepartamentoNacimiento()) || is_null($object->getIdMunicipioNacimiento()) || is_null($object->getIdParentescoResponsable()) || is_null($object->getIdParentescoProporDatos()) || is_null($object->getAreaGeograficaDomicilio())) || (bool) $editar || $expedienteActual->getNumeroTemporal()) {
                $view = $form->createView();

                // set the theme for the current Admin Form
                $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

                return $this->render($this->admin->getTemplate($templateKey), array(
                            'action' => 'edit',
                            'form' => $view,
                            'object' => $object,
                            'procedencia' => $procedencia,
                            'clasificacion'=>$clasificacion
                ));
            } else {

                $params = array();
                $params['id'] = $object->getId();
                $params['procedencia'] = $procedencia;
                $params['clasificacion'] = $clasificacion;
                $url = $this->admin->generateUrl('view', $params);

                return new RedirectResponse($url);
            }
        }
    }

    public function redirectTo($object) {
        $params = array();
        $params['id'] = $object->getId();
        $url = $this->admin->generateUrl('view', $params);
        return new RedirectResponse($url);
    }

    public function buscaremergenciaAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if ($user->hasRole('ROLE_USER_BUSCAREMERGENCIA') === false && $user->hasRole('ROLE_SUPER_ADMIN') === false) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $procedencia='e';

        return $this->render($this->admin->getTemplate('buscaremergencia'), array(
                    'action' => 'buscaremergencia',
                    'procedencia'=>$procedencia
        ));
    }

}

?>
