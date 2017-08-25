<?php

namespace Minsal\FarmaciaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL as DBAL;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Minsal\FarmaciaBundle\Entity\FarmMedicinarecetada as MedicinaRecetada;
use Minsal\FarmaciaBundle\Entity\FarmRecetas as Recetas;
use Minsal\FarmaciaBundle\Entity\FarmMedicinaDistribucion as Distribucion;
use Minsal\Metodos\Funciones;
use Minsal\FarmaciaBundle\Controller\FarmRecetasController as RecetasControlador;


class FarmRecetasAdminController extends CRUDController {
    /*
     * DESCRIPCIÓN: Método que se utiliza para guardar la receta con el medicamento
     *             prescripto al paciente
     * PARÁMETROS DE ENTRADA:
     *                  -NINGUNO: ya que toda la información va en el request
     * PARAMETROS DE ENVIO:
     *                  -params:array que posee algunos parametros necesarios para cargar la vista.
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar, Ing. Karen Peñate
     */

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
        if ($this->getRestMethod() == 'POST') {

            $em = $this->getDoctrine()->getManager();
            $request = $this->get('request');
            if ($request->get('action') === 'create') {
//            $object = $this->admin->getNewInstance();
//            $this->admin->setSubject($object);
            //AGREGAR LA VALIDACIÓN SI ESTE ESTABLECIMIENTO ENVIARÁ RECETA A LA ESPECIALIZADA
            //SE VA A TRATAR DIFERENTES LAS RECETAS
            $establecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
            $idHistorialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($request->get('idHistorialClinico'));
            $modalidad = $idHistorialClinico->getIdAtenAreaModEstab()->getIdAreaModEstab()->getIdModalidadEstab()->getIdModalidad();

            /* OBTENIENDO LAS VARIABLES MEDICAMENTOS */
            $idMedicamento = $request->get('idMedicamento');
            $cantidadMedicamento = $request->get('cantidadMedicamento');
            $frecuencia = $request->get('frecuencia');
            $tiempoFrecuencia = $request->get('tiempoFrecuencia');
            $durante = $request->get('durante');
            $tiempoDurante = $request->get('tiempoDurante');
            $totalMedicamento = $request->get('totalMedicamento');
            $recomendacion = $request->get('recomendacion');
            $cantidadRepetitiva = $request->get('repetitiva');
            $banderaDistribucion = $request->get('banderaDistribucion');
            $distribucion = $request->get('distribucion');
            $tiempoCalculoFecha = $request->get('tiempoCalculoFecha');
            $cantidadCalculoFecha = $request->get('cantidadCalculoFecha');
            $fechaReceta = $request->get('fechaReceta');
            $justificacionprescripcion = $request->get('justificacionprescripcion');
            $idestabdespacha=$request->get('idestabdespacha');

            $controladorReceta = new RecetasControlador();

            foreach ($idMedicamento as $key => $medicamento) {
                //PONER IF SI ES PARA LA ESPECIALIZADA Y NO ES INSULINA
                //CON INSULINA ES EL MISMO CALCULO

                //$fecha = $controladorReceta->calcularFechaReceta($cantidadCalculoFecha[$key], $tiempoCalculoFecha[$key],$idHistorialClinico->getId());

                $fechaCalculada = $fechaReceta[$key];
                $dql = "SELECT A
                            FROM MinsalFarmaciaBundle:FarmRecetas A
                            JOIN A.idhistorialclinico B
                            WHERE B.id=".$idHistorialClinico->getId()." AND A.fecha='" . $fechaCalculada . "'
                            GROUP BY A";
                $recetaCalculada = $em->createQuery($dql)->getResult();
                if (empty($recetaCalculada)) {
                    $receta = new Recetas();
                    $receta->setFecha(new \DateTime($fechaCalculada));
                    $i = substr($key, strpos($key, '_') + 1, strlen($key));
                    if ($i == '0')
                        $receta->setIdEstado($em->getRepository('MinsalFarmaciaBundle:FarmEstados')->find(3)->getIdestado());
                    else
                        $receta->setIdEstado($em->getRepository('MinsalFarmaciaBundle:FarmEstados')->find(4)->getIdestado());
                    //OBTENIENDO CORRELATIVO. PARA ELLO SE CUENTAN LA RECETAS DEL DIA QUE SE HAN INGRESADO
                    //DE SEGUIMIENTO Y SE LE SUMA 1
                    $dql = "SELECT COUNT(A.id) as cuenta
                        FROM MinsalFarmaciaBundle:FarmRecetas A
                        JOIN A.idhistorialclinico B
                        WHERE B.piloto = 'F' AND A.fecha = '" . $fechaCalculada . "'";
                    $correlativo = $em->createQuery($dql)->getSingleResult();
                    $receta->setNumeroreceta($correlativo['cuenta'] + 1);
                    $receta->setIdestablecimiento($establecimiento);
                    $receta->setIdModalidad($modalidad);
                    $receta->setIdfarmacia($em->getRepository('MinsalFarmaciaBundle:MntFarmacia')->find(2));
                    $receta->setIdhistorialclinico($idHistorialClinico);
                    $receta->setIdarea($em->getRepository('MinsalFarmaciaBundle:MntAreafarmacia')->find(2));
                    $em->persist($receta);
                    $em->flush();
                }else{
                    $receta=$recetaCalculada[0];
                }


                $idmedicina = $em->getRepository('MinsalFarmaciaBundle:FarmCatalogoproductos')->find($medicamento);
                $medicina = new MedicinaRecetada();
                $medicina->setCantidadMedicamento($cantidadMedicamento[$key]);
                $medicina->setCantidad($totalMedicamento[$key]);
                $medicina->setFrecuencia($frecuencia[$key]);
                $medicina->setTiempoFrecuencia($tiempoFrecuencia[$key]);
                $medicina->setDurante($durante[$key]);
                $medicina->setTiempoDurante($tiempoDurante[$key]);
                $medicina->setTotalMedicamento($totalMedicamento[$key]);
                $medicina->setRecomendacion($recomendacion[$key]);
                $medicina->setJustificacionPrescripcion($justificacionprescripcion[$key]);
                $IdEstablecimientoDespacha=$em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->find($idestabdespacha[$key]);
                $medicina->setIdEstablecimientoDespacha($IdEstablecimientoDespacha);
                if($frecuencia[$key]== 0){
                    $cada = ' ';
                }
                else {
                    $cada = ' cada ' . $frecuencia[$key] . ' ' . $tiempoFrecuencia[$key];
                }
                $dosis = $cantidadMedicamento[$key] . ' ' . $idmedicina->getNombre() . '-' . $idmedicina->getFormafarmaceutica() . $cada . ' durante ' . $durante[$key] . ' ' . $tiempoDurante[$key];
                $medicina->setDosis($dosis);
                $medicina->setIdmedicina($idmedicina);
                $medicina->setIdreceta($receta);
                $medicina->setIdareaorigen($em->getRepository('MinsalFarmaciaBundle:MntAreafarmacia')->find(2));
                $areamedicina = $em->getRepository('MinsalFarmaciaBundle:MntAreamedicina')->findOneBy(array('idmedicina' => $idmedicina, 'idestablecimiento' => $establecimiento, 'idmodalidad' => $modalidad));
                if (is_null($areamedicina->getDispensada())) {
                    $areaDispensa = $em->getRepository('MinsalFarmaciaBundle:MntAreafarmacia')->find(2);
                } else {
                    $areaDispensa = $areamedicina->getDispensada();
                }
                $medicina->setIdareadispensa($areaDispensa);
                $medicina->setIdestablecimiento($establecimiento);
                $medicina->setIdmodalidad($modalidad);
                $medicina->setIdestado($em->getRepository('MinsalFarmaciaBundle:FarmEstados')->find(17)->getIdestado());
                if ($banderaDistribucion[$key] == '1') {
                    $medicina->setDistribucionEspecial(true);
                    $distribuciones = explode('°°', $distribucion[$key]);
                    foreach ($distribuciones as $aux) {
                        list($cantidadDistribucion, $indicacion) = explode('¬¬', $aux);
                        $medicinaDistribucion = new Distribucion();
                        $medicinaDistribucion->setCantidadDistribucion($cantidadDistribucion);
                        $medicinaDistribucion->setIndicacion($indicacion);
                        $medicinaDistribucion->setIdMedicinaRecetada($medicina);
                        $em->persist($medicinaDistribucion);
                        $em->flush();
                    }
                } else {
                    $medicina->setDistribucionEspecial(false);
                }
                $em->persist($medicina);
                $em->flush();
            }
            $msjtype = 'sonata_flash_success';
            $msjcontent = 'Receta Creada Exitosamente';
        }
        else{
            $msjtype = 'sonata_flash_success';
            $msjcontent = 'Receta Actualizada Exitosamente';
        }

        }


        $this->addFlash($msjtype, $msjcontent);
        $params['external'] = $request->get('_external') ? $request->get('_external') : 'false';
        $params['_external'] = $request->get('_external') ? $request->get('_external') : 'false'; //$params['_external'] = $request->get('_external') ? true : false;
        $params['idHistorialClinico'] = $request->get('idHistorialClinico') ? $request->get('idHistorialClinico') : null;
        $params['action'] = 'edit';
        $params['createdElement'] = $msjtype === 'sonata_flash_success' ? 1 : 0;
        return new RedirectResponse($this->admin->generateUrl('assign_receta', $params));
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza para llamar a la vista de generar recetas
     * PARÁMETROS DE ENTRADA:
     *                  -action: la acción a realiza, si es nulo se le asignara crear
     *                  -external: se utiliza para saber de donde es llamada. true si
     *                             es llamada del formulario de la consulta.
     *                  -idHistorialClinico: el id historial clinico que le corresponde
     *                                       a esa receta.
     * PARAMETROS DE ENVIO:
     *                  -params:array que posee algunos parametros necesarios para cargar la vista.
     *                  -action: acción a realizar.
     *                  -recetasRegistradas: objeto que contienen toda la información de las recetas.
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar, Ing. Karen Peñate
     */

    /**
     * return the Response object associated to the action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function assignRecetaAction() {

        if (false === $this->admin->isGranted('ASSIGNRECETA')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }
        $request = $this->get('request'); //obtengo todo lo que sen envia a travez de get y post
        $params['external'] = $request->get('_external') ? $request->get('_external') : 'false';
        $params['idHistorialClinico'] = $request->get('idHistorialClinico') ? $request->get('idHistorialClinico') : null;

        $em = $this->getDoctrine()->getManager();

        $idHistorialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($params['idHistorialClinico']);//Obteniendo el obj IdHistoriasClinico

        if (!$idHistorialClinico) {
            throw $this->createNotFoundException(
                'No hay Historia Clinica asociada '
            );
        }

        $medicamentolevantados = $em->getRepository("MinsalFarmaciaBundle:FarmCatalogoproductos")->obtenerMedicamentosLevandados($params['idHistorialClinico']);

        $habilitadoFarmaciaEspecializada = $em->getRepository('MinsalFarmaciaBundle:MntConfiguracionEspecializada')->findByIdEstablecimiento($idHistorialClinico->getIdEstablecimiento());

        $dql = "SELECT A1 as med
                    FROM MinsalFarmaciaBundle:FarmMedicinarecetada A1
                         JOIN A1.idreceta B1
                         JOIN B1.idhistorialclinico C1
                    WHERE C1.id=" . $params['idHistorialClinico'] . "
                    ORDER BY A1.idmedicina, B1.fecha";
        $recetasRegistradas = $em->createQuery($dql)->getResult();

        //Inicio Consulta las recetas que podran ser editadas en cuanto a cantidad de medicamento y duracion de tratamiento esto solo aplica a recetas repetitivas y a la receta con la fecha mayor
        $sqlrecetasmodificar = "SELECT
                          tb01.id
                        FROM
                          farm_medicinarecetada tb01
                          JOIN farm_recetas tb02 ON (tb02.id = tb01.idreceta)
                          JOIN sec_historial_clinico tb03 ON (tb03.id = tb02.idhistorialclinico)
                        WHERE
                          tb03.id = :idhistorialclinico AND
                          fecha=(SELECT max(tb1.fecha)
                                    FROM farm_recetas tb1,sec_historial_clinico tb2, farm_medicinarecetada tb3
                                    WHERE tb2.id = tb1.idhistorialclinico AND
                                    tb3.idreceta = tb1.id AND
                                    tb2.id = tb03.id  AND
                                    tb3.idmedicina = tb01.idmedicina)";
        $stm = $this->container->get('database_connection')->prepare($sqlrecetasmodificar);
        $stm->bindValue(':idhistorialclinico', $params['idHistorialClinico']);
        $stm->execute();
        $recetasmodificar = $stm->fetchAll();
        //Fin consulta recetas que podran ser editadas

        //Consulta de medicamentos adversos registrados al paciente
        $sqlmedicamentosadversos = "SELECT
                                    tb01.id,tb01.numero, tb06.nombre,
                                    tb05.especificacion,tb06.id
                                FROM
                                    mnt_expediente tb01 JOIN mnt_paciente tb02 ON (tb02.id = tb01.id_paciente)
                                    JOIN sec_antecedentes tb03 ON (tb03.id_paciente = tb02.id)
                                    JOIN sec_antecedentes_otro tb04 ON  (tb03.id = tb04.id_antecedentes)
                                    JOIN sec_antecedentes_otro_detalle tb05 ON (tb04.id = tb05.id_antecedentes_otros)
                                    JOIN ctl_otro_antecedente tb06 ON (tb06.id = tb04.id_otros_antecedentes)
                                WHERE
                                    tb06.id = 1 AND tb01.id = :idexpediente
                                ORDER BY tb02.primer_nombre,tb02.segundo_nombre, tb02.primer_apellido";
        $stm = $this->container->get('database_connection')->prepare($sqlmedicamentosadversos);
        $stm->bindValue(':idexpediente', $idHistorialClinico->getIdExpediente()->getId());
        $stm->execute();
        $medicamentosadversos = $stm->fetchAll();
        //Fin consulta de medicamentos adversos registrados al paciente


        $dqldosificaciones = "SELECT C FROM MinsalFarmaciaBundle:FarmDosificacion C  ORDER BY C.abreviatura";
        $dosificaciones = $em->createQuery($dqldosificaciones)->getResult();

        //if (empty($recetasRegistradas)) {///esto quitarlo si solo nos quedaremos con la edicion
        //    $action = 'create';
        //} else {
            $action = 'edit';
        //}

        $tipoDocumento = $idHistorialClinico->getIdExpediente()->getIdPaciente()->getidDocPaciente()->getId();
        $numeroDocumento = $idHistorialClinico->getIdExpediente()->getIdPaciente()->getnumeroDocIdePaciente();
        if(($tipoDocumento ==1 || $tipoDocumento ==11) && $numeroDocumento=!null && $numeroDocumento =! ''){
            $documentoValido = 1;//Documento valido
        }
        else{
            $documentoValido = 0;//Documento no valido
        }

        $fechaNacimiento = $idHistorialClinico->getIdExpediente()->getIdPaciente()->getFechaNacimiento();

        $to = new \DateTime('today');
        $edadanios = $fechaNacimiento->diff($to)->y;

        $form = $this->admin->getForm(); //preparo la vista creo formulario obtengame el formulario del admin que tengo
        $view = $form->createView(); //creo la la vista creo elementos del formulario aqui los creo
        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme()); //renderizar es como pintar la vista aqui solo le he dicho este tema va a utilizar
        //var_dump($recetasRegistradas[1]['med']->getIdReceta()->getPacientestable());
        //exit();
        return $this->render($this->admin->getTemplate('assign_receta'), array(
                    'action' => $action,
                    'form' => $view, //practicamente es la plantilla el menu logo head footer se esta renderizando a nivel de twiwg
                    'params' => $params,
                    'recetasRegistradas' => $recetasRegistradas,
                    'idHistorialClinico'=> $idHistorialClinico,
                    'habilitadoFarmaciaEspecializada' =>$habilitadoFarmaciaEspecializada,
                    'medicamentolevantados' =>$medicamentolevantados[0]['cuantos'],
                    'recetasmodificar' => $recetasmodificar,
                    'dosificaciones'=> $dosificaciones,
                    'medicamentosadversos'=>$medicamentosadversos,
                    'edadanios'=>$edadanios,
                    'documentoValido'=>$documentoValido
        ));
    }

    /*
     * DESCRIPCIÓN: Método que se utiliza para llamar a la vista y generar pdf de esta
     * PARÁMETROS DE ENTRADA:
     *                  -action: la acción a realiza, si es nulo se le asignara crear
     *                  -external: se utiliza para saber de donde es llamada. true si
     *                             es llamada del formulario de la consulta.
     *                  -idHistorialClinico: el id historial clinico que le corresponde
     *                                       a esa receta.
     * PARAMETROS DE ENVIO:
     *                    -expediente
      -edad: edad del paciente
      -idhistorialclinico: id del historial clinico
      -objReceta: objeto receta
      -cuantamedicina: cuanta medicina se receto
     * ANALISTA PROGRAMADOR: Ing. Jasmin Menjivar, Ing. Karen Peñate
     */

    /**
     * return the Response object associated to the action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function imprimirRecetaAction() {
        $template = 'imprimir_receta';//formato de receta a imprimir por defecto cuatro recetas por pagina
        $em = $this->getDoctrine()->getManager();
        if (false === $this->admin->isGranted('ASSIGNRECETA')) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $request = $this->get('request'); //obtengo todo lo que sen envia a travez de get y post
        $ids_recetas=$request->get('id_receta');
        $arrayids_recetas=  explode(',', $ids_recetas);//Esto es para obtener el id de una receta y poder obtener el id historial clinico
        if ($request->get('id_receta')) {//Si solo se imprime una receta en particular
            $idreceta = ' AND B.id IN ('.$ids_recetas.')';
            $idMedicinaRecetada = $em->getRepository('MinsalFarmaciaBundle:FarmMedicinarecetada')->find($arrayids_recetas[0]);
            $idHistorialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($idMedicinaRecetada->getIdReceta()->getIdHistorialClinico());
        }
        else{//Si se imprimen todas las recetas del historial clinico
            $idreceta = '';
            $idHistorialClinico = $em->getRepository('MinsalSeguimientoBundle:SecHistorialClinico')->find($request->get('idHistorialClinico'));
        }
        $expediente = $idHistorialClinico->getIdExpediente();

        $dql = "SELECT B as med, ( SELECT count(C.idmedicina)
                                    FROM
                                            MinsalFarmaciaBundle:FarmRecetas D,
                                            MinsalFarmaciaBundle:FarmMedicinarecetada C
                                    WHERE
                                            D.id = C.idreceta AND
                                            D.idhistorialclinico = " . $idHistorialClinico->getId() . " AND
                                            C.idmedicina = B.idmedicina) as cuantos
              FROM
                MinsalFarmaciaBundle:FarmRecetas A,
                MinsalFarmaciaBundle:FarmMedicinarecetada B
              WHERE
                A.id = B.idreceta AND
                A.idhistorialclinico =" . $idHistorialClinico->getId() .$idreceta."
                ORDER BY A.idhistorialclinico, A.fecha, B.idmedicina";

        $recetasRegistradas = $em->createQuery($dql)->getResult();
        $cuantamedicina = count($recetasRegistradas);

        $conn = $em->getConnection();
        $calcular = new Funciones();

        $edad = $calcular->calcularEdad($conn, $expediente->getIdPaciente()->getFechaNacimiento()->format('d-m-Y'), $expediente->getIdPaciente()->getHoraNacimiento() ? $expediente->getIdPaciente()->getHoraNacimiento()->format('H:i') : null );

        //Se consulta la configuracion de la impresin de la receta en el parameter.yml si la receta se mostrara 4 o 2 por pagina
        $template = $this->container->hasParameter('numero_receta_imprimir') ? ($this->container->getParameter('numero_receta_imprimir') === 2 ? 'imprimir_receta2' : $template) : $template;
        $receta = $this->renderView($this->admin->getTemplate($template), array('expediente' => $expediente,
            'edad' => $edad,
            'idhistorialclinico' => $idHistorialClinico,
            'objReceta' => $recetasRegistradas,
            'cuantamedicina' => $cuantamedicina)
        );

        return new Response(
             $this->get('knp_snappy.pdf')->getOutputFromHtml($receta, array('page-size' => 'Letter', 'margin-top' => '5', 'margin-right' => '5', 'margin-left' => '5', 'margin-bottom' => '5')), 200, array(
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline'
                )
        );
    }


     /**
     * return the Response object associated to the list action
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     *
     * @return Response
     */
    public function listAction()
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();
        $params = array();
        $request = $this->get('request');

        $params['external'] = $request->get('external') ? $request->get('external') : 'false';
        $params['idHistorialClinico'] = $request->get('idHistorialClinico') ? $request->get('idHistorialClinico') : 0;

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render($this->admin->getTemplate('list'), array(
            'action'     => 'list',
            'form'       => $formView,
            'datagrid'   => $datagrid,
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
            'params'     => $params,
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
            throw new AccessDeniedException();
        }

        $request = $this->get('request');
        $params['external'] = $request->get('external') ? $request->get('external') : 'false';
        $this->admin->setSubject($object);

        $sqlreceta = "SELECT
                    C.nombre,
                    C.concentracion,
                    C.formafarmaceutica,
                    C.presentacion,
                    B.dosis,
                    B.total_medicamento,
                    B.cantidad,
                    B.fechaentrega,
                    A.fecha,
                    A.idhistorialclinico,
                    B.idreceta,
                    E.descripcion as estado,
                    CASE WHEN F.divisormedicina IS NULL
                               THEN B.cantidad
                         ELSE
                             B.cantidad*F.divisormedicina
                    END as cantidad_despachada
                  FROM
                    farm_recetas A JOIN  farm_medicinarecetada B ON (A.id = B.idreceta)
                    JOIN farm_catalogoproductos C ON (C.id = B.idmedicina)
                    JOIN farm_estados E ON (B.id_estados = E.id)
                    LEFT JOIN farm_divisores F ON (F.id=C.divisormedicina)
                  WHERE B.idreceta= :idreceta
                  ORDER BY
                    B.idreceta";

        $stm = $this->container->get('database_connection')->prepare($sqlreceta);
        $stm->bindValue(':idreceta', $id);
        $stm->execute();
        $resultmedicamentos = $stm->fetchAll();


        return $this->render($this->admin->getTemplate('show'), array(
            'action'   => 'show',
            'object'   => $object,
            'elements' => $this->admin->getShow(),
            'params'   => $params,
            'resultmedicamentos'   => $resultmedicamentos,
        ));
    }

    public function complementAction() {

        $templateKey = 'complement';
        $user = $this->getUser();

        //$user->hasRole('ROLE_SONATA_ADMIN_SECHISTORIALCLINICO_RETROACTIVE');
        if ( ! ( $user->hasRole('ROLE_SONATA_ADMIN_FARMRECETAS_COMPLEMENT') || $user->hasRole('ROLE_SONATA_ADMIN_FARMRECETAS_COMPLEMENTALL') || $user->hasRole('ROLE_SUPER_ADMIN') ) ) {
            return $this->render('MinsalSiapsBundle::Accesso_denegado.html.twig', array('admin_pool' => $this->container->get('sonata.admin.pool'),
                        'layout' => $this->container->get('sonata.admin.pool')->getTemplate('layout')
            ));
        }

        $object = $this->admin->getNewInstance();

        $this->admin->setSubject($object);

        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->getRestMethod()== 'POST') {
            $form->submit($this->get('request'));

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
            'action' => 'complement',
            'form'   => $view,
            'object' => $object,
        ));

    }


}
