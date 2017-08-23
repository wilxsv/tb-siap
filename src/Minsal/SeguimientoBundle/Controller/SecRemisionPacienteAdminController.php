<?php

/* TODOS LOS XML DEBEN IR SIN IDENTADO PORQUE SINO EL CONTROLADOR NO LOS RECONOCE */

namespace Minsal\SeguimientoBundle\Controller;

use Minsal\Metodos\Funciones;
use Sonata\AdminBundle\Controller\CRUDController;
use Minsal\SeguimientoBundle\Controller\ClienteController as Cliente;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SecRemisionPacienteAdminController extends CRUDController {

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
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        
        $form->setData($object);

        if ($this->getRestMethod() == 'POST') {
            $form->submit($this->get('request'));

            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {

                if (false === $this->admin->isGranted('CREATE', $object)) {
                    throw new AccessDeniedException();
                }

                $this->admin->create($object);

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
        ));
    }

    public function createEspeAction($idhistoria = null, $idespe, $idestable) {
        // the key used to lookup the template
        $templateKey = 'edit';

        $cerrar = false;
        $problema = false;
        $respuesta = 1;
        $em = $this->getDoctrine()->getManager();
        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $object = $this->admin->getNewInstance();

        $historia = $this->findObject('MinsalSeguimientoBundle', 'SecHistorialClinico', $idhistoria);
        $cliente = new Cliente();
        $cliente->setContainer($this->container);
        $labase = $this->container->getParameter('global_host');

        try {
            $especialidad = $cliente->obtenerEspecialidadAction($idestable, $labase, $idespe);
        } catch (\Exception $ex) {
            $especialidad = null;
            $errorMsj = $ex->getMessage();
            throw $ex;
        }


        //INICIO Consulta para mostrar los examenes de laboratorio
        $sql = "SELECT A.id as id_expediente, A.numero as numero_expediente, B.id as id_historial_clinico, B.fechaconsulta as fecha_consulta
                    FROM mnt_expediente A
                    JOIN sec_historial_clinico B ON (A.id = B.id_numero_expediente)
                    WHERE A.numero = :numero_expediente
                    ORDER BY fecha_consulta desc";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':numero_expediente', $historia->getIdExpediente()->getNumero());
        $stm->execute();
        $result = $stm->fetchAll();

        $resultados = array();
        $datosGenerales = array();
        if (count($result) > 1) {
            $ExamnResult = $this->container->get('lab_examnresult'); //service de los resultados de examenes de laboratorio
            $datosGenerales = $ExamnResult->getDatosGenerales($result[1]['id_historial_clinico'], 0, $historia->getIdEstablecimiento()->getId());
            $resultados = $ExamnResult->getExamnResult($result[1]['id_historial_clinico'], 0, $historia->getIdEstablecimiento()->getId());
        }
        //FIN consulta para mostrar los examenes de laboratorio
        //INICIO consulta para mostrar medicamentos recetados al  paciente
        $sqlmedicamentos = "SELECT numero,nombre,idmedicina,dosis,count(idmedicina) as recetasactivas
                                FROM
                                    farm_recetas D,
                                    farm_medicinarecetada C,
                                    sec_historial_clinico G,
                                    mnt_expediente H,
                                    farm_catalogoproductos I
                                WHERE
                                    D.id = C.idreceta AND
                                    D.idhistorialclinico = G.id AND
                                    G.id_numero_expediente = H.id AND
                                    C.idmedicina = I.id AND
                                    D.fecha >= current_date AND
                                    numero = :numero_expediente
                                GROUP BY numero,nombre,idmedicina,dosis";

        $stm = $this->container->get('database_connection')->prepare($sqlmedicamentos);
        $stm->bindValue(':numero_expediente', $historia->getIdExpediente()->getNumero());
        $stm->execute();
        $resultmedicamentos = $stm->fetchAll();
        //FIN consulta para mostrar medicamentos recetados al paciente

        try {
            $especialidad = $cliente->obtenerEspecialidadAction($idestable, $labase, $idespe);
        } catch (\Exception $ex) {
            $especialidad = null;
            $errorMsj = $ex->getMessage();
            throw $ex;
        }

        $object->setNumeroExpediente($historia->getIdExpediente()->getNumero());
        //$object->setNombreEspecialidadOrigen($historia->getIdAtenAreaModEstab()->getIdAtencion()->getNombre());
        //$object->setNombreEspecialidadDestino($especialidad);
        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);



        if ($this->getRestMethod() == 'POST' && ($this->get('request')->get('_external') == false || !$this->get('request')->get('_external'))) {
            // print_r(); exit();
            $form->submit($this->get('request'));
            $request = $this->get('request');

            $isFormValid = true; //$form->isValid();
            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {

                if (false === $this->admin->isGranted('CREATE', $object)) {
                    throw new AccessDeniedException();
                }

                $em->getConnection()->beginTransaction();
                try {
                    $codigo = $this->generarCodigo($historia->getIdEstablecimiento()->getId());

                    $object->setCodigo($codigo);
                    $object->setFechaRemision(new \DateTime());
                    $object->setIdHistorialClinico($historia->getId());
                    $object->setIdEstablecimientoOrigen($historia->getIdEstablecimiento());
                    $object->setIdEstablecimientoDestino($idestable);
                    $object->setIdEspecialidadDestino($idespe);

                    if ($request->get('recetaReferidos') == '') {
                        $recetaReferidos = '-';
                    } else {
                        $recetaReferidos = $request->get('recetaReferidos') . '?¬¬?';
                    }

                    if ($request->get('examenesReferidos') == '') {
                        $examenesReferidos = '-';
                    } else {
                        $examenesReferidos = $request->get('examenesReferidos') . '?¬¬?';
                    }
                    $object->setTratamiento($recetaReferidos . $object->getTratamiento());
                    $object->setObservacionResultado($examenesReferidos . $object->getdatosExamen());

                    $this->admin->create($object);
                    $respuesta = $this->guardarReferencia($object->getId());
                    $em->getConnection()->commit();
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();

                    $this->addFlash('sonata_flash_error', $e);
                    throw $e;
                }

                if ($respuesta == '0') {
                    $problema = true;
                } else {
                    $problema = false;
                }

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                                'result' => 'ok',
                                'objectId' => $this->admin->getNormalizedIdentifier($object)
                    ));
                }

                $this->addFlash('sonata_flash_success', $this->admin->trans('flash_create_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
                $cerrar = true;
                // redirect to edit mode
                //return $this->redirectTo($object);
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
        $em = $this->container->get('doctrine')->getManager();
        $conn = $em->getConnection();
        $calcular = new Funciones();

        $edad = $calcular->calcularEdad($conn, $historia->getIdExpediente()->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $historia->getIdExpediente()->getIdPaciente()->getHoraNacimiento() ? $historia->getIdExpediente()->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );
        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'create',
                    'form' => $view,
                    'object' => $object,
                    'expediente' => $historia->getIdExpediente(),
                    'edad' => $edad,
                    'idhistoria' => $idhistoria,
                    'idespe' => $idespe,
                    'idestable' => $idestable,
                    'cerrar' => $cerrar,
                    'problema' => $problema,
                    'respuesta' => $respuesta,
                    'labresultados' => $resultados,
                    'medicamentos' => $resultmedicamentos
        ));
    }

    public function referenciaSolLaboratorio($historia) {
        $sql = "SELECT A.id as id_expediente, A.numero as numero_expediente, B.id as id_historial_clinico, B.fechaconsulta as fecha_consulta
                    FROM mnt_expediente A
                    JOIN sec_historial_clinico B ON (A.id = B.id_numero_expediente)
                    WHERE A.numero = :numero_expediente
                    ORDER BY fecha_consulta desc";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':numero_expediente', $historia->getIdExpediente()->getNumero());
        $stm->execute();
        $result = $stm->fetchAll();
        $resultados = array();
        $datosGenerales = array();
        if (count($result) > 1) {
            $ExamnResult = $this->container->get('lab_examnresult'); //service de los resultados de examenes de laboratorio
            $datosGenerales = $ExamnResult->getDatosGenerales($result[1]['id_historial_clinico'], 0, $historia->getIdEstablecimiento()->getId());
            $resultados = $ExamnResult->getExamnResult($result[1]['id_historial_clinico'], 0, $historia->getIdEstablecimiento()->getId());
        }
        return $resultados;
    }

    public function referenciaSolMedicamento($historia) {
        $sqlmedicamentos = "SELECT numero,nombre,idmedicina,dosis,count(idmedicina) as recetasactivas
                                FROM
                                    farm_recetas D,
                                    farm_medicinarecetada C,
                                    sec_historial_clinico G,
                                    mnt_expediente H,
                                    farm_catalogoproductos I
                                WHERE
                                    D.id = C.idreceta AND
                                    D.idhistorialclinico = G.id AND
                                    G.id_numero_expediente = H.id AND
                                    C.idmedicina = I.id AND
                                    D.fecha >= current_date AND
                                    numero = :numero_expediente
                                GROUP BY numero,nombre,idmedicina,dosis";

        $stm = $this->container->get('database_connection')->prepare($sqlmedicamentos);
        $stm->bindValue(':numero_expediente', $historia->getIdExpediente()->getNumero());
        $stm->execute();
        $resultmedicamentos = $stm->fetchAll();
        return $resultmedicamentos;
    }

    public function createSoloAction($idhistoria = null, $estadoEnviar, $idespe, $idestable) {
        // the key used to lookup the template
        $templateKey = 'edit';
        $cerrar = false;
        $problema = false;
        $respuesta = 1;
        $createdElement = null;
        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $historia = $this->findObject('MinsalSeguimientoBundle', 'SecHistorialClinico', $idhistoria);

        //INICIO Consulta para mostrar los examenes de laboratorio
        $resultados = $this->referenciaSolLaboratorio($historia);
        //FIN consulta para mostrar los examenes de laboratorio
        //INICIO consulta para mostrar medicamentos recetados al  paciente
        $resultmedicamentos = $this->referenciaSolMedicamento($historia);
        //FIN consulta para mostrar medicamentos recetados al paciente

        $object = $this->admin->getNewInstance();

        $object->setNumeroExpediente($historia->getIdExpediente()->getNumero());
        $object->setIdAtencionOrigen($historia->getIdAtenAreaModEstab()->getIdAtencion());

        if ($estadoEnviar == 'FALSE' && ($historia->getIdEstablecimiento()->getId() == (int) $idestable)) {

            $object->setIdAtendAreaModEstabDestino($idespe);
            $destinoatencion = $this->findObject('MinsalSiapsBundle', 'MntAtenAreaModEstab', $idespe);
            $object->setidAtencionDestino($destinoatencion->getIdAtencion());
        } else {
            $destinoatencion = $this->findObject('MinsalSiapsBundle', 'CtlAtencion', $idespe);
            $object->setidAtencionDestino($destinoatencion);
        }



        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);


        if (($this->getRestMethod() == 'POST' && ($this->get('request')->get('_external') == false) || !$this->get('request')->get('_external'))) {

            $form->submit($this->get('request'));
            $request = $this->get('request');

            $isFormValid = true; //$form->isValid();
            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {
                if (false === $this->admin->isGranted('CREATE', $object)) {
                    throw new AccessDeniedException();
                }
                $codigo = $this->generarCodigo($historia->getIdEstablecimiento()->getId());

                $object->setCodigo($codigo);
                if ($historia->getIdMotivoRetroactivo()) {
                    $object->setFechaRemision($historia->getFechaconsulta());
                } else {
                    $object->setFechaRemision(new \DateTime());
                }
                $object->setIdHistorialClinico($historia->getId());
                $object->setIdEstablecimientoOrigen($historia->getIdEstablecimiento());
                if ($request->get('recetaReferidos') == '') {
                    $recetaReferidos = '-';
                } else {
                    $recetaReferidos = $request->get('recetaReferidos') . '?¬¬?';
                }

                if ($request->get('examenesReferidos') == '') {
                    $examenesReferidos = '-';
                } else {
                    $examenesReferidos = $request->get('examenesReferidos') . '?¬¬?';
                }

                $object->setTratamiento($recetaReferidos . $object->getTratamiento());
                $object->setObservacionResultado($examenesReferidos . $object->getObservacionResultado());
                $object->setIdEstablecimientoDestino($this->findObject('MinsalSiapsBundle', 'CtlEstablecimiento', $idestable));

                $this->admin->create($object);

                if ($this->isXmlHttpRequest()) {
                    return $this->renderJson(array(
                                'result' => 'ok',
                                'objectId' => $this->admin->getNormalizedIdentifier($object)
                    ));
                }

                $this->addFlash('sonata_flash_success', $this->admin->trans('flash_create_success', array('%name%' => $this->admin->toString($object)), 'SonataAdminBundle'));
                $cerrar = true;
                $createdElement = 1;
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
        $em = $this->container->get('doctrine')->getManager();
        $conn = $em->getConnection();
        $calcular = new Funciones();

        $edad = $calcular->calcularEdad($conn, $historia->getIdExpediente()->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $historia->getIdExpediente()->getIdPaciente()->getHoraNacimiento() ? $historia->getIdExpediente()->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );
        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'create',
                    'form' => $view,
                    'object' => $object,
                    'expediente' => $historia->getIdExpediente(),
                    'edad' => $edad,
                    'idhistoria' => $idhistoria,
                    'estadoEnviar' => $estadoEnviar,
                    'idespe' => $idespe,
                    'idestable' => $idestable,
                    'cerrar' => $cerrar,
                    'problema' => $problema,
                    'respuesta' => $respuesta,
                    'labresultados' => $resultados,
                    'medicamentos' => $resultmedicamentos,
                    'createdElement' => $createdElement
        ));
    }

    private function findObject($bundle, $entity, $id) {
        $em = $this->getDoctrine()->getManager();
        $foundObject = $em->getRepository($bundle . ':' . $entity)->findOneById($id);
        return $foundObject;
    }

    private function generarCodigo($idestable) {
        $codigo = "RE";
        $anio = date("Y");
        $estable = str_pad($idestable, 4, '0', STR_PAD_LEFT);
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT COUNT(u.id) FROM MinsalSeguimientoBundle:SecRemisionPaciente u where (u.idPacienteReferido is NULL )");
        $count = $query->getSingleScalarResult();
        $correlativo = str_pad(($count + 1), 5, '0', STR_PAD_LEFT);
        $codigo = $codigo . $anio . $estable . $correlativo;
        return $codigo;
    }

    private function guardarReferencia($id) {
        //$em = $this->getDoctrine()->getManager();
        $remision = $this->findObject('MinsalSeguimientoBundle', 'SecRemisionPaciente', $id);
        $cliente = new Cliente();
        $cliente->setContainer($this->container);
        $labase = $this->container->getParameter('global_host');
        $idestable = $remision->getIdEstablecimientoDestino();
        $codigo = $remision->getCodigo();
        $fecha = date('Y-m-d H:i:s', $remision->getFechaRemision()->getTimestamp());

        $tiporemision = $remision->getIdTipoRemision()->getId();
        $motivoremision = $remision->getIdMotivoRemision()->getId();
        $numeroexpediente = $remision->getNumeroExpediente();
        $idestableorigen = $remision->getIdEstablecimientoOrigen()->getId();
        $idestabledestino = $remision->getIdEstablecimientoDestino();
        $idespedestino = $remision->getIdEspecialidadDestino();
        //$nombreespedestino=$remision->getNombreEspecialidadDestino();
        //$nombreespeorigen=$remision->getNombreEspecialidadOrigen();
        $impresiondiagnostica = !empty($remision->getImpresionDiagnostica()) ? $remision->getImpresionDiagnostica() : "??";
        $justificacionremision = !empty($remision->getJustificacionRemision()) ? $remision->getJustificacionRemision() : "??";
        $datosexamen = !empty($remision->getDatosExamen()) ? $remision->getDatosExamen() : "??";
        $observacionresultado = !empty($remision->getObservacionResultado()) ? $remision->getObservacionResultado() : "??";
        $tratamiento = !empty($remision->getTratamiento()) ? $remision->getTratamiento() : "??";

        /* TODOS LOS XML DEBEN IR SIN IDENTADO PORQUE SINO EL CONTROLADOR NO LOS RECONOCE */

        $elxml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<datos>
<referencia>
<idreferenciaorigen>$id</idreferenciaorigen>
<codigo>$codigo</codigo>
<fecha>$fecha</fecha>
<tipore>$tiporemision</tipore>
<motivre>$motivoremision</motivre>
<numexp>$numeroexpediente</numexp>
<estableorigen>$idestableorigen</estableorigen>
<establedest>$idestabledestino</establedest>
<espedest>$idespedestino</espedest>
<nespedest>$nombreespedestino</nespedest>
<nespeorigen>$nombreespeorigen</nespeorigen>
<diagnos>$impresiondiagnostica</diagnos>
<justif>$justificacionremision</justif>
<examen>$datosexamen</examen>
<resultado><![CDATA[$observacionresultado]]></resultado>
<trata><![CDATA[$tratamiento]]></trata>
</referencia>
</datos>
XML;
        //var_dump($elxml); exit();
        $resp = $cliente->guardarReferenciaAction($idestable, $labase, $elxml);
        $lastresp = $this->guardarDatosReferencia($id, $resp);
        return $lastresp;
    }

    private function guardarDatosReferencia($id, $idremisiondestino) {
        //$em = $this->getDoctrine()->getManager();
        $remision = $this->findObject('MinsalSeguimientoBundle', 'SecRemisionPaciente', $id);
        $cliente = new Cliente();
        $cliente->setContainer($this->container);
        $labase = $this->container->getParameter('global_host');
        $idestable = $remision->getIdEstablecimientoDestino();
        $historia = $this->findObject('MinsalSeguimientoBundle', 'SecHistorialClinico', $remision->getIdHistorialClinico());
        $em = $this->getDoctrine()->getManager();
        $signos = $em->getRepository('MinsalSeguimientoBundle:SecSignosVitales')->findOneBy(array('idHistorialClinico' => $remision->getIdHistorialClinico()));
        $paciente = $historia->getIdExpediente()->getIdPaciente();
        $temp = $signos->getTemperatura();
        $peso = $signos->getPeso();
        $talla = $signos->getTalla();
        $freqr = $signos->getFrecuenciaRespiratoria();
        $freqc = $signos->getFrecuenciaCardiaca();
        $presion = $signos->getPresionArterial();
        $primern = !empty($paciente->getPrimerNombre()) ? $paciente->getPrimerNombre() : "??";
        $segundon = !empty($paciente->getSegundoNombre()) ? $paciente->getSegundoNombre() : "??";
        $tercern = !empty($paciente->getTercerNombre()) ? $paciente->getTercerNombre() : "??";
        $primera = !empty($paciente->getPrimerApellido()) ? $paciente->getPrimerApellido() : "??";
        $segundoa = !empty($paciente->getSegundoApellido()) ? $paciente->getSegundoApellido() : "??";
        $apellidoc = !empty($paciente->getApellidoCasada()) ? $paciente->getApellidoCasada() : "??";
        $fechanac = date('Y-m-d H:i:s', $paciente->getFechaNacimiento()->getTimestamp());
        $respon = !empty($paciente->getNombreResponsable()) ? $paciente->getNombreResponsable() : "??";
        $madre = !empty($paciente->getNombreMadre()) ? $paciente->getNombreMadre() : "??";
        $padre = !empty($paciente->getNombrePadre()) ? $paciente->getNombrePadre() : "??";
        $sexo = $paciente->getIdSexo()->getId();
        $modulo = $em->getRepository('MinsalLaboratorioBundle:CtlModulo')->findOneBy(array('codModulo' => 'SEG'));
        $idmodulo = $modulo->getId();
        $direccion = !empty($paciente->getDireccion()) ? $paciente->getDireccion() : "??";
        $iddepto = !empty($paciente->getIdDepartamentoDomicilio()->getId()) ? $paciente->getIdDepartamentoDomicilio()->getId() : "??";
        $idmuni = !empty($paciente->getIdMunicipioDomicilio()->getId()) ? $paciente->getIdMunicipioDomicilio()->getId() : "??";
        $area = !empty($paciente->getAreaGeograficaDomicilio()->getId()) ? $paciente->getAreaGeograficaDomicilio()->getId() : "??";

        $elxml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<datos>
<referencia>
<idremision>$idremisiondestino</idremision>
<temperatura>$temp</temperatura>
<peso>$peso</peso>
<talla>$talla</talla>
<freqr>$freqr</freqr>
<freqc>$freqc</freqc>
<presion>$presion</presion>
</referencia>
</datos>
XML;

        $elxml2 = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<datos>
<referencia>
<idremision>$idremisiondestino</idremision>
<primern>$primern</primern>
<segundon>$segundon</segundon>
<tercern>$tercern</tercern>
<primera>$primera</primera>
<segundoa>$segundoa</segundoa>
<apellidoc>$apellidoc</apellidoc>
<fechanac>$fechanac</fechanac>
<respon>$respon</respon>
<madre>$madre</madre>
<padre>$padre</padre>
<sexo>$sexo</sexo>
<idmodulo>$idmodulo</idmodulo>
<direccion>$direccion</direccion>
<iddepto>$iddepto</iddepto>
<idmuni>$idmuni</idmuni>
<area>$area</area>
</referencia>
</datos>
XML;

        $resp = $cliente->guardarDatosReferenciaAction($idestable, $labase, $elxml, $elxml2);
        return $resp;
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza hacer la llamada a la vista que genera pdf de la remison de paciente
     * PARÁMETROS DE ENTRADA:
     *                  -external: se utiliza para saber de donde es llamada. true si
     *                             es llamada del formulario de la consulta.
     *                  -idHistorialClinico: el id historial clinico.
     * PARAMETROS DE ENVIO:
      -edad
      -idhistorialclinico
      -remisiones
      -signosvitales
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar
     */

    /**
     * return the Response object associated to the action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response


      /**
     * return the Response object associated to the action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function referenciaReporteAction() {
        if (false) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }
        $request = $this->get('request'); //obtengo todo lo que sen envia a travez de get y post

        $params['external'] = $request->get('_external') ? true : false;
        $params['idHistorialClinico'] = $request->get('idHistorialClinico') ? $request->get('idHistorialClinico') : null;
        $params['idRemision']=$request->get('idRemision')?:null;

        $em = $this->getDoctrine()->getManager();

        $idHistorialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($params['idHistorialClinico']);
        $expediente = $idHistorialClinico->getIdExpediente();
        if (is_null($params['idRemision'])) {
            $remisiones = $em->getRepository('MinsalSeguimientoBundle:SecRemisionPaciente')->findBy(array('idHistorialClinico' => $idHistorialClinico->getId()));
        } else {
          
            $dql='SELECT srm
                  FROM MinsalSeguimientoBundle:SecRemisionPaciente srm
                  WHERE srm.idHistorialClinico='.$params['idHistorialClinico'].
                  ' AND srm.id IN ('.$params['idRemision'].')';
            $remisiones=$em->createQuery($dql)
                            ->getResult();
        }
        $signosvitales = $em->getRepository('MinsalSeguimientoBundle:SecSignosVitales')->findOneBy(array('idHistorialClinico' => $idHistorialClinico->getId()));
        $idEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));

        //INICIO Consulta para mostrar los examenes de laboratorio
        $sql = "SELECT A.id as id_expediente, A.numero as numero_expediente, B.id as id_historial_clinico, B.fechaconsulta as fecha_consulta
                FROM mnt_expediente A
                JOIN sec_historial_clinico B ON (A.id = B.id_numero_expediente)
                WHERE A.numero = :numero_expediente
                ORDER BY fecha_consulta desc";

        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->bindValue(':numero_expediente', $idHistorialClinico->getIdExpediente()->getNumero());
        $stm->execute();
        $result = $stm->fetchAll();

        $resultados = array();
        $datosGenerales = array();
        if (count($result) > 1) {
            $ExamnResult = $this->container->get('lab_examnresult'); //service de los resultados de examenes de laboratorio
            $datosGenerales = $ExamnResult->getDatosGenerales($result[1]['id_historial_clinico'], 0, $idEstablecimiento->getId());
            $resultados = $ExamnResult->getExamnResult($result[1]['id_historial_clinico'], 0, $idEstablecimiento->getId());
        }
        //FIN consulta para mostrar los examenes de laboratorio
        //INICIO consulta para mostrar medicamentos recetados al  paciente
        $sqlmedicamentos = "SELECT numero,nombre,idmedicina,dosis,count(idmedicina) as recetasactivas
                            FROM
                                farm_recetas D,
                                farm_medicinarecetada C,
                                sec_historial_clinico G,
                                mnt_expediente H,
                                farm_catalogoproductos I
                            WHERE
                                D.id = C.idreceta AND
                                D.idhistorialclinico = G.id AND
                                G.id_numero_expediente = H.id AND
                                C.idmedicina = I.id AND
                                D.fecha >= current_date AND
                                numero = :numero_expediente
                            GROUP BY numero,nombre,idmedicina,dosis";

        $stm = $this->container->get('database_connection')->prepare($sqlmedicamentos);
        $stm->bindValue(':numero_expediente', $idHistorialClinico->getIdExpediente()->getNumero());
        $stm->execute();
        $resultmedicamentos = $stm->fetchAll();
        //FIN consulta para mostrar medicamentos recetados al paciente

        $conn = $em->getConnection();
        $calcular = new Funciones();

        $edad = $calcular->calcularEdad($conn, $expediente->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $expediente->getIdPaciente()->getHoraNacimiento() ? $expediente->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );

        $receta = $this->renderView($this->admin->getTemplate('referencia_reporte'), array('expediente' => $expediente,
            'edad' => $edad,
            'idhistorialclinico' => $idHistorialClinico,
            'remisiones' => $remisiones,
            'signosvitales' => $signosvitales,
            'labresultados' => $resultados,
            'labdatosgenerales' => $datosGenerales,
            'medicamentos' => $resultmedicamentos
        ));

        return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($receta, array('page-size' => 'Letter', 'margin-top' => '10', 'margin-right' => '10', 'margin-left' => '10', 'margin-bottom' => '10')), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline'
                )
        );
    }

}
