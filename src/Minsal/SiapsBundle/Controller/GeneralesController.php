<?php

namespace Minsal\SiapsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL as DBAL;
use FOS\UserBundle\Model\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Util\TokenGenerator;
use Minsal\Metodos\Funciones as Funciones;


class GeneralesController extends Controller {

    /**
     * @Route("/download/file/{name}/{directory}/{file_type}/{disposition}/{thumbnail}", name="render_download_file", options={"expose"=true})
     * @Method("GET")
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function downloadFileAction($name, $directory, $file_type, $disposition = 'inline', $thumbnail = false) {
        $basePath = substr($this->container->get('kernel')->getRootDir(), 0, -4);
        $location = '/upload/' . urldecode($directory) . '/' . $name;
        $status = 200;
        $formatSettings = explode("/", strtolower(urldecode($file_type)));
        $type = $formatSettings[0] ? $formatSettings[0] : 'document';
        $format = $formatSettings[1] ? $formatSettings[1] : 'unknow';

        if ($thumbnail) {
            if (!file_exists($basePath . $location)) {
                if ($type === 'image') {
                    $name = 'imagen-no-disponible.gif';
                } else {
                    $name = 'archivo-no-disponible.png';
                }

                $status = 404;
                $location = '/web/bundles/applicationcore/images/' . $name;
            } else {
                if ($type === 'document') {
                    switch ($format) {
                        case 'pdf':
                            $name = 'pdf.svg';
                            break;
                        default:
                            $name = 'download.svg';
                            break;
                    }

                    $location = '/web/bundles/applicationcore/images/' . $name;
                }
            }
        }

        $content = file_get_contents($basePath . $location);
        $headers = array('Content-Type' => mime_content_type($basePath . $location), 'Content-Disposition' => $disposition . '; filename="' . $name . '"');

        return new Response($content, 200, $headers);
    }

    /*
     * DESCRIPCIÓN: Función para que el FosUserBundle pueda imprimir el mensaje
     * de cambiar contraseña con éxito.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/", name="sonata_user_profile_show")
     */
    public function raiz() {
        $this->get('session')->getFlashBag()->add(
                'notice', 'change_password.flash.success'
        );

        return $this->redirect($this->generateUrl('_inicio'));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON con los departamentos de acuerdo
     * al idPais que se envia.
     * ANALISTA PROGRAMADOR: Victoria López
     */

    /**
     * @Route("/departamentos/get", name="get_departamentos", options={"expose"=true})
     * @Method("GET")
     */
    public function getDepartamentosAction() {

        $request = $this->getRequest();
        $idPais = $request->get('idPais');
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT d FROM MinsalSiapsBundle:CtlDepartamento d
                    WHERE d.idPais = :idPais ";
        $departamentos['deptos'] = $em->createQuery($dql)
                ->setParameter('idPais', $idPais)
                ->getArrayResult();

        return new Response(json_encode($departamentos));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON con los municipios de acuerdo
     * al idDepartamento que se envia.
     * ANALISTA PROGRAMADOR: Victoria López
     */

    /**
     * @Route("/municipios/get", name="get_municipios", options={"expose"=true})
     * @Method("GET")
     */
    public function getMunicipiosAction() {

        $request = $this->getRequest();
        $idDepartamento = $request->get('idDepartamento');
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT m FROM MinsalSiapsBundle:CtlMunicipio m
                    WHERE m.idDepartamento = :idDepartamento ";
        $municipios['municipios'] = $em->createQuery($dql)
                ->setParameter('idDepartamento', $idDepartamento)
                ->getArrayResult();

        return new Response(json_encode($municipios));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON con los cantones de acuerdo
     * al idMunicipio que se envia.
     * ANALISTA PROGRAMADOR: Victoria López
     */

    /**
     * @Route("/cantones/get", name="get_cantones", options={"expose"=true})
     * @Method("GET")
     */
    public function getCantonesAction() {

        $request = $this->getRequest();
        $idMunicipio = $request->get('idMunicipio');
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT c FROM MinsalSiapsBundle:CtlCanton c
                    WHERE c.idMunicipio = :idMunicipio ";
        $cantones['cantones'] = $em->createQuery($dql)
                ->setParameter('idMunicipio', $idMunicipio)
                ->getArrayResult();

        return new Response(json_encode($cantones));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON de los paises
     * habilitados.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/paises/get", name="get_paises", options={"expose"=true})
     */
    public function getPaisesHabilitadosAction() {
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT p
                FROM MinsalSiapsBundle:CtlPais p
                WHERE p.activo = TRUE
                ORDER BY p.nombre";
        $paises['paises'] = $em->createQuery($dql)
                ->getArrayResult();

        return new Response(json_encode($paises));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON de los paises
     * habilitados.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/pais/depto/get", name="get_pais_depto", options={"expose"=true})
     */
    public function obtenerPaisPorDeptoAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $dql = "SELECT p.id
                FROM MinsalSiapsBundle:CtlDepartamento d
                JOIN d.idPais p
                WHERE d.id= :departamento";
        $aux = $em->createQuery($dql)
                ->setParameter('departamento', $request->get('idDepartamento'))
                ->getArrayResult();
        $pais['pais'] = $aux[0]['id'];
        return new Response(json_encode($pais));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON con los usuarios de archivo.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/usuarios/archivos/get", name="obtener_usuarios_archivo", options={"expose"=true})
     */
    public function getUsuariosArchivosAction() {

        $em = $this->getDoctrine()->getManager();
        $establecimiento = $em->getRepository("MinsalSiapsBundle:CtlEstablecimiento")->obtenerEstablecimientoConfigurado();

        $dql = "SELECT u
                FROM ApplicationSonataUserBundle:User u
                JOIN u.idEmpleado e
                WHERE e.idTipoEmpleado = 7 AND u.idEstablecimiento=" . $establecimiento->getId();

        $usuarios['usuarios'] = $em->createQuery($dql)
                ->getArrayResult();

        return new Response(json_encode($usuarios));
    }

    /*
     * DESCRIPCIÓN:
     *      Método que verifica si el empleado posee servicios a brindar
     *      dentro del establecimiento
     * ANALISTA PROGRAMADOR: Caleb Rodríguez
     */

    /**
     * @Route("/siaps/verify/medicservice", name="verify_medic_service", options={"expose"=true})
     *
     * @return Response
     */
    public function verifyMedicServiceAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $session = $this->container->get('session');
        $request = $this->container->get('request');
        $em = $this->getDoctrine()->getManager();
        $response = new RedirectResponse($this->generateUrl('sonata_admin_dashboard'));
        $codigoEmpleado = $codigoEmpleado = $user->getIdEmpleado() ? ($user->getIdEmpleado()->getIdTipoEmpleado() !== null ? $user->getIdEmpleado()->getIdTipoEmpleado()->getCodigo() : 'N/A') : 'N/A';

        if (( ( $session->get('_moduleSelection') !== null && $session->get('_idEmpEspecialidadEstab') === null ) ||
                ( $session->get('_secured_token') === $request->query->get('_provided_token') && null !== $session->get('_idEmpEspecialidadEstab') )
                ) && $codigoEmpleado == 'MED'
        ) {

            $idEmpleado = $user->getIdEmpleado()->getId();
            $idEstablecimiento = $user->getIdEmpleado()->getIdEstablecimiento()->getId();

            $dql = "SELECT t02
                    FROM MinsalSiapsBundle:MntEmpleadoEspecialidadEstab      t01
                    INNER JOIN MinsalSiapsBundle:MntAtenAreaModEstab         t02 WITH (t02.id = t01.idAtenAreaModEstab)
                    INNER JOIN MinsalSiapsBundle:CtlAtencion                 t03 WITH (t03.id = t02.idAtencion)
                    INNER JOIN MinsalSiapsBundle:MntAreaModEstab             t04 WITH (t04.id = t02.idAreaModEstab)
                    INNER JOIN MinsalSiapsBundle:CtlAreaAtencion             t05 WITH (t05.id = t04.idAreaAtencion)
                    INNER JOIN MinsalSiapsBundle:MntModalidadEstablecimiento t06 WITH (t06.id = t04.idModalidadEstab)
                    INNER JOIN MinsalSiapsBundle:CtlModalidad                t07 WITH (t07.id = t06.idModalidad)
                    INNER JOIN MinsalSiapsBundle:MntEmpleado                 t08 WITH (t08.id = t01.idEmpleado)
                    INNER JOIN MinsalSiapsBundle:MntTipoEmpleado             t09 WITH (t09.id = t08.idTipoEmpleado)
                    WHERE t01.idEmpleado = :idEmpleado
                        AND t02.idEstablecimiento = :idEstablecimiento
                        AND t05.id = :idAreaAtencion
                        AND UPPER(t09.codigo) = :codEmpleado";

            $query = $em->createQuery($dql);
            $query->setParameters(
                    array(
                        ':idEmpleado' => $idEmpleado,
                        ':codEmpleado' => 'MED',
                        ':idEstablecimiento' => $idEstablecimiento,
                        ':idAreaAtencion' => 1
                    )
            );

            $empEspecialidades = $query->getResult();

            if ($empEspecialidades !== null) {
                $count = count($empEspecialidades);

                if ($count !== 1) {
                    if ($count === 0) {
                        if ($user->getIdEmpleado()->getResidente()) {
                            $dql = "SELECT t01
                                    FROM MinsalSiapsBundle:MntAtenAreaModEstab   t01
                                    INNER JOIN MinsalSiapsBundle:MntAreaModEstab t02 WITH (t02.id = t01.idAreaModEstab)
                                    INNER JOIN MinsalSiapsBundle:CtlAreaAtencion t03 WITH (t03.id = t02.idAreaAtencion)
                                    WHERE t01.idEstablecimiento = :idEstablecimiento
                                        AND t03.id = :idAreaAtencion";

                            $query = $em->createQuery($dql);
                            $query->setParameters(
                                    array(
                                        ':idEstablecimiento' => $idEstablecimiento,
                                        ':idAreaAtencion' => 1
                                    )
                            );

                            $empEspecialidades = $query->getResult();
                        }
                    }

                    $response = $this->render(
                        'MinsalSiapsBundle::ServicioMedicoEstablecimiento.html.twig', array(
                            'user' => $user,
                            'empEspecialidades' => $empEspecialidades,
                            'admin_pool' => $this->container->get('sonata.admin.pool'),
                            'previous_url' => $session->get('_secured_token') ? $request->server->get('HTTP_REFERER') : null,
                        )
                    );
                } else {
                    $session->set('_idEmpEspecialidadEstab', $empEspecialidades[0]->getId());
                    $session->set('_nombreEmpEspecialidadEstab', $empEspecialidades[0]->getNombreConsulta());
                    $session->set('_idAreaAtenModEstab', $empEspecialidades[0]->getIdAreaModEstab()->getId());
                    $session->set('_nombreAreaAtenModEstab', $empEspecialidades[0]->getIdAreaModEstab()->getNombreAreaModEstab());
                    $session->set('_idAreaAtencion', $empEspecialidades[0]->getIdAreaModEstab()->getIdAreaAtencion()->getId());
                    $session->set('_nombreAreaAtencion', $empEspecialidades[0]->getIdAreaModEstab()->getIdAreaAtencion()->getNombre());
                }
            }
        }

        return $response;
    }

    /*
     * DESCRIPCIÓN:
     *      Método que setea la especialidad seleccionada por el empleado
     *      y redirecciona a la página principal
     * ANALISTA PROGRAMADOR: Caleb Rodríguez
     */

    /**
     * @Route("/siaps/set/empespecialidad/estab", name="set_emp_especialidad_estab", options={"expose"=true})
     * @Method("POST")
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function setEmpEspecialidadEstabAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em   = $this->getDoctrine()->getManager();
        $request = $this->container->get('request');
        $session = $this->container->get('session');
        $response = new RedirectResponse($this->generateUrl('sonata_admin_dashboard'));
        $codigoEmpleado = $user->getIdEmpleado() ? $user->getIdEmpleado()->getIdTipoEmpleado()->getCodigo() : 'N/A';

        if (( ( $session->get('_moduleSelection') !== null && $session->get('_idEmpEspecialidadEstab') === null ) ||
                ( $session->get('_secured_token') === $request->get('_provided_token') && null !== $session->get('_idEmpEspecialidadEstab') )
                ) && $request->isMethod('POST') && $codigoEmpleado === 'MED'
        ) {

            if ($session->get('_secured_token') === null) {
                $tokenGenerator = new TokenGenerator();
                $session->set('_secured_token', $tokenGenerator->generateToken());
            } else {
                if ($request->get('previous_url') != '')
                    $response = new RedirectResponse($request->get('previous_url'));
            }

            $MntAtenAreaModEstab = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab')->findOneById($request->get('_id-especialidad'));

            $session->set('_idEmpEspecialidadEstab', $request->get('_id-especialidad'));
            $session->set('_nombreEmpEspecialidadEstab', $request->get('_nombre-especialidad'));
            $session->set('_idAreaAtenModEstab', $MntAtenAreaModEstab->getIdAreaModEstab()->getId());
            $session->set('_nombreAreaAtenModEstab', $MntAtenAreaModEstab->getIdAreaModEstab()->getNombreAreaModEstab());
            $session->set('_idAreaAtencion', $MntAtenAreaModEstab->getIdAreaModEstab()->getIdAreaAtencion()->getId());
            $session->set('_nombreAreaAtencion', $MntAtenAreaModEstab->getIdAreaModEstab()->getIdAreaAtencion()->getNombre());

            return $response;
        } else {
            throw new AccessDeniedException();
        }
    }

    /**
     * @Route("/siaps/timeInfo", name="siapsTimeInfo", options={"expose"=true})
     * @Method("GET")
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return Response
     */
    public function siapsTimeInfo() {
        $session = $this->container->get('session');

        $data['status'] = $session->get('endedSession');
        $data['time'] = $session->get('lastUsed');

        return new Response(json_encode($data));
    }

    /*
     * DESCRIPCIÓN:
     *
     *
     * ANALISTA PROGRAMADOR: Jasmin Menjivar
     */

    /**
     * @Route("/consultar/IMC/{sexo}/{imc}/{edad}", name="consultar_IMC", options={"expose"=true})
     * @Method("GET")
     */
    public function consultaIMC($sexo, $imc, $edad) {
        $sqlImc = "SELECT
                    E.nombre as rango,
                    F.nombre as genero,
                    D.nombre as condicion,
                    A.nombre as clasificacion,
                    B.rango_minimo as minimo,
                    B.rango_maximo as maximo
                  FROM
                    ctl_clasificacion_peso A INNER JOIN  mnt_imc_rango B ON (A.id = B.id_clasificacion_peso)
                    INNER JOIN sec_imc_parametros C ON (C.id = B.id_imc_parametros)
                    INNER JOIN ctl_condicion_persona D ON (D.id = C.id_condicion_persona)
                    INNER JOIN (SELECT * From ctl_rango_edad WHERE cod_modulo = 'IMC') E ON (E.id = C.id_rango_edad)
                    INNER JOIN ctl_sexo F ON (F.id = C.id_sexo)
                  WHERE
                      F.abreviatura = :sexo AND
                      (:imc BETWEEN rango_minimo AND rango_maximo) AND
                      (:edad BETWEEN edad_minima_anios AND edad_maxima_anios)";

        $stm = $this->container->get('database_connection')->prepare($sqlImc);
        $stm->bindValue(':sexo', $sexo);
        $stm->bindValue(':edad', $edad);
        $stm->bindValue(':imc', $imc);
        $stm->execute();
        $resultImc = $stm->fetchAll();

        return new Response(json_encode($resultImc));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON las especialidades por area.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/especialidades/por/area/{idAreaModEstab}", name="obtener_especialidades_por_area", options={"expose"=true})
     */
    public function obtenerEspecialidadesPorArea($idAreaModEstab) {

        $em = $this->getDoctrine()->getManager();
        $repositorio = $em->getRepository('MinsalSiapsBundle:MntAtenAreaModEstab');
        $resultados = $repositorio->obtenerIdAtenAreaModEstab($idAreaModEstab);

        $envio = array();
        foreach ($resultados as $key => $value) {
            $envio[$key]['text'] = $value->getIdAtencion()->getNombre();
            $envio[$key]['id'] = $value->getId();
        }
        $resultados = array();
        $resultados['resultados'] = $envio;
        return new Response(json_encode($resultados));
    }
    /*
    * DESCRIPCIÓN: Método que devuelve un JSON con el username generado por el
    *              sistema.
    * ENTRADA: nombres, apellidos
    * SALIDA: username generado

    * ANALISTA PROGRAMADOR: Karen Peñate
    */

    /**
    * @Route("/obtener/username", name="obtener_username", options={"expose"=true})
    * @Method("GET")
    */
   public function obtenerUsernameAction() {
       $request = $this->getRequest();
       $nombres = $request->get('nombres');
       $apellidos = $request->get('apellidos');

       $em = $this->getDoctrine()->getManager();
       //$em = $this->getConfigurationPool()->getContainer()->get('Doctrine')->getManager();
       $Funciones=new Funciones();
       $username=$Funciones->obtenerUsername($em,$nombres,$apellidos);

       $resultados['username'] = $username;

       return new Response(json_encode($resultados));
   }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON las especialidades por area.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/medicos/por/especialidad/{idAtenAreaModEstab}", name="obtener_medicos_por_especialidad", options={"expose"=true})
     */
    public function obtenerMedicosPorEspecialidad($idAtenAreaModEstab) {

        $em = $this->getDoctrine()->getManager();
        $repositorio = $em->getRepository('MinsalSiapsBundle:MntEmpleado');
        $resultados = $repositorio->obtenerMedicosPorEspecialidad($idAtenAreaModEstab);

        foreach ($resultados as $key => $value) {
            $envio[$key]['text'] = ucwords(strtolower($value->getNombreempleado()));
            $envio[$key]['id'] = $value->getId();
        }
        $resultados = array();
        $resultados['resultados'] = $envio;
        return new Response(json_encode($resultados));
    }

    /**
     * @Route("/medicos/por/area/{idAreaModEstab}", name="obtener_medicos_por_area", options={"expose"=true})
     */
    public function obtenerMedicosPorArea($idAreaModEstab) {

        $em = $this->getDoctrine()->getManager();
        $repositorio = $em->getRepository('MinsalSiapsBundle:MntEmpleado');
        $resultados = $repositorio->obtenerMedicosPorArea($idAreaModEstab);

        $envio = array();
        foreach ($resultados as $key => $value) {
            $envio[$key]['text'] = ucwords(strtolower($value->getNombreempleado()));
            $envio[$key]['id'] = $value->getId();
        }
        $resultados = array();

        $resultados['resultados'] = $envio;
        return new Response(json_encode($resultados));
    }

    /*
     * DESCRIPCIÓN:
     *      Método que obtiene el establecimiento configurado.
     * ANALISTA PROGRAMADOR: Caleb Rodríguez
     */

    /**
     * @Route("/siaps/get/establecimiento/configurado", name="get_establecimiento_configurado", options={"expose"=true})
     * @Method({"GET", "POST"})
     */
    public function getEstablecimientoConfiguradoAction() {
        $em                 = $this->getDoctrine()->getManager();
        $CtlEstablecimiento = $em->getRepository('MinsalSiapsBundle:CtlEstablecimiento')->findOneBy(array('configurado' => true));
        $serializer         = $this->container->get('serializer');
        $jsonContent        = $serializer->serialize($CtlEstablecimiento, 'json');

        return new Response(json_encode($jsonContent));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON las especialidades por area.
     * ANALISTA PROGRAMADOR: Karen Peñate
     */

    /**
     * @Route("/consultorios/por/area/{idAreaModEstab}", name="obtener_consultorios_por_area", options={"expose"=true})
     */
    public function obtenerConsultoriosPorArea($idAreaModEstab) {

        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT consultorio
                  FROM MinsalSiapsBundle:MntConsultorio consultorio
                  JOIN consultorio.idAreaModEstab idArea
                  WHERE idArea.id=$idAreaModEstab
                  ORDER BY consultorio.nombre ASC";

        $resultados = $em->createQuery($dql)
                ->getResult();
        $envio = array();
        foreach ($resultados as $key => $value) {
            $envio[$key]['text'] = $value->getNombre();
            $envio[$key]['id'] = $value->getId();
        }
        $resultados = array();
        $resultados['resultados'] = $envio;
        return new Response(json_encode($resultados));
    }

    /*
     * DESCRIPCIÓN: Método que devuelve un JSON con los procedimientos para el establecimiento ó
     * con los médicos con distribución para un procedimiento, según el parámetro "objetoRequerido" que se
     * envíe.
     * ANALISTA PROGRAMADOR: Victoria López
     */
     /**
     * @Route("/procedimientos/por/area/medico/", name="obtener_procedimientos_por_area_medico", options={"expose"=true})
     * @Method("GET")
     */
     public function obtenerProcedimientosPorAreaMedico() {

         $em = $this->getDoctrine()->getManager();
         $request = $this->get('request');
         $objetoRequerido = $request->get('objetoRequerido');
         $idEmpleado = $request->get('idEmpleado');
         $idAreaModEstab = $request->get('idAreaModEstab');
         $idProcedimiento = $request->get('idProcedimientoEstablecimiento');

         $repositorio = $em->getRepository('MinsalSiapsBundle:MntProcedimientoEstablecimiento');
         $resultados = $repositorio->obtenerProcedimientosEstablecimiento($objetoRequerido,$idAreaModEstab,$idEmpleado,$idProcedimiento);

         $envio = array();
         foreach ($resultados as $key => $value) {
             if($objetoRequerido == 'procedimiento'){
                 $envio[$key]['text'] = $value->getIdCiq()->getNombreProcedimiento();
                 $envio[$key]['id'] = $value->getId();
             }else {
                 $envio[$key]['text'] = $value->getNombreempleado();
                 $envio[$key]['id'] = $value->getId();
             }
         }
         $resultados = array();

         $resultados['resultados'] = $envio;
         return new Response(json_encode($resultados));
     }

}
