<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // _inicio
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', '_inicio');
            }

            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::dashboardAction',  '_route' => '_inicio',);
        }

        // root
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'root');
            }

            return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::urlRedirectAction',  'path' => '/admin/login',  'permanent' => true,  '_route' => 'root',);
        }

        // obtener_establecimientos
        if ($pathinfo === '/establecimientos/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_obtener_establecimientos;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\CtlEstablecimientoController::getEstablecimientosAction',  '_route' => 'obtener_establecimientos',);
        }
        not_obtener_establecimientos:

        if (0 === strpos($pathinfo, '/d')) {
            // render_download_file
            if (0 === strpos($pathinfo, '/download/file') && preg_match('#^/download/file/(?P<name>[^/]++)/(?P<directory>[^/]++)/(?P<file_type>[^/]++)(?:/(?P<disposition>[^/]++)(?:/(?P<thumbnail>[^/]++))?)?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_render_download_file;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'render_download_file')), array (  'disposition' => 'inline',  'thumbnail' => false,  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::downloadFileAction',));
            }
            not_render_download_file:

            // get_departamentos
            if ($pathinfo === '/departamentos/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_departamentos;
                }

                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::getDepartamentosAction',  '_route' => 'get_departamentos',);
            }
            not_get_departamentos:

        }

        // get_municipios
        if ($pathinfo === '/municipios/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_municipios;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::getMunicipiosAction',  '_route' => 'get_municipios',);
        }
        not_get_municipios:

        // get_cantones
        if ($pathinfo === '/cantones/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_cantones;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::getCantonesAction',  '_route' => 'get_cantones',);
        }
        not_get_cantones:

        if (0 === strpos($pathinfo, '/pais')) {
            // get_paises
            if ($pathinfo === '/paises/get') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::getPaisesHabilitadosAction',  '_route' => 'get_paises',);
            }

            // get_pais_depto
            if ($pathinfo === '/pais/depto/get') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::obtenerPaisPorDeptoAction',  '_route' => 'get_pais_depto',);
            }

        }

        // obtener_usuarios_archivo
        if ($pathinfo === '/usuarios/archivos/get') {
            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::getUsuariosArchivosAction',  '_route' => 'obtener_usuarios_archivo',);
        }

        if (0 === strpos($pathinfo, '/siaps')) {
            // verify_medic_service
            if ($pathinfo === '/siaps/verify/medicservice') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::verifyMedicServiceAction',  '_route' => 'verify_medic_service',);
            }

            // set_emp_especialidad_estab
            if ($pathinfo === '/siaps/set/empespecialidad/estab') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_set_emp_especialidad_estab;
                }

                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::setEmpEspecialidadEstabAction',  '_route' => 'set_emp_especialidad_estab',);
            }
            not_set_emp_especialidad_estab:

            // siapsTimeInfo
            if ($pathinfo === '/siaps/timeInfo') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_siapsTimeInfo;
                }

                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::siapsTimeInfo',  '_route' => 'siapsTimeInfo',);
            }
            not_siapsTimeInfo:

        }

        // consultar_IMC
        if (0 === strpos($pathinfo, '/consultar/IMC') && preg_match('#^/consultar/IMC/(?P<sexo>[^/]++)/(?P<imc>[^/]++)/(?P<edad>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_consultar_IMC;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'consultar_IMC')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::consultaIMC',));
        }
        not_consultar_IMC:

        // obtener_especialidades_por_area
        if (0 === strpos($pathinfo, '/especialidades/por/area') && preg_match('#^/especialidades/por/area/(?P<idAreaModEstab>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'obtener_especialidades_por_area')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::obtenerEspecialidadesPorArea',));
        }

        // obtener_username
        if ($pathinfo === '/obtener/username') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_obtener_username;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::obtenerUsernameAction',  '_route' => 'obtener_username',);
        }
        not_obtener_username:

        if (0 === strpos($pathinfo, '/medicos/por')) {
            // obtener_medicos_por_especialidad
            if (0 === strpos($pathinfo, '/medicos/por/especialidad') && preg_match('#^/medicos/por/especialidad/(?P<idAtenAreaModEstab>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'obtener_medicos_por_especialidad')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::obtenerMedicosPorEspecialidad',));
            }

            // obtener_medicos_por_area
            if (0 === strpos($pathinfo, '/medicos/por/area') && preg_match('#^/medicos/por/area/(?P<idAreaModEstab>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'obtener_medicos_por_area')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::obtenerMedicosPorArea',));
            }

        }

        // get_establecimiento_configurado
        if ($pathinfo === '/siaps/get/establecimiento/configurado') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_get_establecimiento_configurado;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::getEstablecimientoConfiguradoAction',  '_route' => 'get_establecimiento_configurado',);
        }
        not_get_establecimiento_configurado:

        // obtener_consultorios_por_area
        if (0 === strpos($pathinfo, '/consultorios/por/area') && preg_match('#^/consultorios/por/area/(?P<idAreaModEstab>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'obtener_consultorios_por_area')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::obtenerConsultoriosPorArea',));
        }

        // obtener_procedimientos_por_area_medico
        if (rtrim($pathinfo, '/') === '/procedimientos/por/area/medico') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_obtener_procedimientos_por_area_medico;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'obtener_procedimientos_por_area_medico');
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\GeneralesController::obtenerProcedimientosPorAreaMedico',  '_route' => 'obtener_procedimientos_por_area_medico',);
        }
        not_obtener_procedimientos_por_area_medico:

        // get_areas_modalidades
        if ($pathinfo === '/areas/modalidades/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_areas_modalidades;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAmbienteAreaEstablecimientoController::getAreaModalidadAction',  '_route' => 'get_areas_modalidades',);
        }
        not_get_areas_modalidades:

        // get_especialidades_hospitalizacion
        if ($pathinfo === '/especialidades/hospitalizacion/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_especialidades_hospitalizacion;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAmbienteAreaEstablecimientoController::getEspecialidadesHospitalizacionAction',  '_route' => 'get_especialidades_hospitalizacion',);
        }
        not_get_especialidades_hospitalizacion:

        if (0 === strpos($pathinfo, '/servicios')) {
            // get_servicios
            if ($pathinfo === '/servicios/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_servicios;
                }

                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAmbienteAreaEstablecimientoController::getServiciosHospitalariosAction',  '_route' => 'get_servicios',);
            }
            not_get_servicios:

            // generar_servicios_hospitalarios
            if ($pathinfo === '/servicios/hospitalarios/generar') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_generar_servicios_hospitalarios;
                }

                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAmbienteAreaEstablecimientoController::generarServiciosHospitalariosAction',  '_route' => 'generar_servicios_hospitalarios',);
            }
            not_generar_servicios_hospitalarios:

        }

        // guardar_hopitalizacion
        if (0 === strpos($pathinfo, '/guardar/hospitalizacion') && preg_match('#^/guardar/hospitalizacion/(?P<sexo>[^/]++)/(?P<numero_ambientes>[^/]++)/(?P<id_aten_area_mod_estab>[^/]++)$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_guardar_hopitalizacion;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'guardar_hopitalizacion')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAmbienteAreaEstablecimientoController::guardarHospitalizacionAction',));
        }
        not_guardar_hopitalizacion:

        // get_atenciones
        if ($pathinfo === '/atenciones/get') {
            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAreaModEstabController::getAtencionesAction',  '_route' => 'get_atenciones',);
        }

        // get_especialidades
        if ($pathinfo === '/especialidades/get') {
            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAreaModEstabController::getEspecialidadesAction',  '_route' => 'get_especialidades',);
        }

        if (0 === strpos($pathinfo, '/mnt')) {
            if (0 === strpos($pathinfo, '/mntareamodestab')) {
                // get_area_mod_estab
                if ($pathinfo === '/mntareamodestab/get') {
                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAreaModEstabController::getAreaModEstabAction',  '_route' => 'get_area_mod_estab',);
                }

                // get_area_mod_estab_de_empleado
                if ($pathinfo === '/mntareamodestab/user/get') {
                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAreaModEstabController::obtenerAreaModEstabDeEmpleadoAction',  '_route' => 'get_area_mod_estab_de_empleado',);
                }

            }

            // get_ciq_remote_select2
            if ($pathinfo === '/mnt/ciq/rs2/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_ciq_remote_select2;
                }

                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntCiqController::getCiqRemoteSelect2Action',  '_route' => 'get_ciq_remote_select2',);
            }
            not_get_ciq_remote_select2:

        }

        // cargar_eventos
        if ($pathinfo === '/cargar/eventos/') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_cargar_eventos;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEventoController::cargarEventosAction',  '_route' => 'cargar_eventos',);
        }
        not_cargar_eventos:

        if (0 === strpos($pathinfo, '/expedientes/creados')) {
            // expedientes_creados
            if ($pathinfo === '/expedientes/creados') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteController::expedientesCreados',  '_route' => 'expedientes_creados',);
            }

            // expedientes_creados_listado_anio
            if ($pathinfo === '/expedientes/creados/listado/anio') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteController::expedientesCreadosPorAnioAction',  '_route' => 'expedientes_creados_listado_anio',);
            }

        }

        // obtener_area_creacion_archivo
        if ($pathinfo === '/areas/creacion/get') {
            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteController::getAreaCreacionArchivoAction',  '_route' => 'obtener_area_creacion_archivo',);
        }

        // cambiar_estado_expediente
        if ($pathinfo === '/cambiar/estado/expediente') {
            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteController::cambiarEstadoExpedienteAction',  '_route' => 'cambiar_estado_expediente',);
        }

        if (0 === strpos($pathinfo, '/buscar/paciente')) {
            // buscar_paciente
            if ($pathinfo === '/buscar/paciente') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteController::buscarPacienteAction',  '_route' => 'buscar_paciente',);
            }

            // buscar_paciente_global
            if ($pathinfo === '/buscar/paciente/global') {
                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteController::buscarPacienteGlobalAction',  '_route' => 'buscar_paciente_global',);
            }

        }

        // edad_paciente
        if ($pathinfo === '/paciente/edad}') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_edad_paciente;
            }

            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteController::edad_paciente',  '_route' => 'edad_paciente',);
        }
        not_edad_paciente:

        if (0 === strpos($pathinfo, '/report')) {
            // _report_show
            if (0 === strpos($pathinfo, '/report/show') && preg_match('#^/report/show/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_report_show')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\ReporteController::showAction',));
            }

            // _report_paciente
            if (0 === strpos($pathinfo, '/report/paciente') && preg_match('#^/report/paciente/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_report_paciente')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\ReporteController::pacienteAction',));
            }

        }

        if (0 === strpos($pathinfo, '/exportar')) {
            // _exportar_reporte
            if (preg_match('#^/exportar/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not__exportar_reporte;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => '_exportar_reporte')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\ReporteController::exportarReporteAction',));
            }
            not__exportar_reporte:

            // exportar_pacientes_derivados
            if (rtrim($pathinfo, '/') === '/exportar/pacientes/derivados') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_exportar_pacientes_derivados;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'exportar_pacientes_derivados');
                }

                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\ReporteController::exportarPacientesDerivadosReporteAction',  '_route' => 'exportar_pacientes_derivados',);
            }
            not_exportar_pacientes_derivados:

        }

        // minsal_farmacia_default_index
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'minsal_farmacia_default_index')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\DefaultController::indexAction',));
        }

        if (0 === strpos($pathinfo, '/cargar')) {
            // cargar_pacientes_derivados
            if ($pathinfo === '/cargar/pacientes/derivados') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_cargar_pacientes_derivados;
                }

                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\DefaultController::cargarDistribucion',  '_route' => 'cargar_pacientes_derivados',);
            }
            not_cargar_pacientes_derivados:

            // cargar_detalle_pacientes
            if ($pathinfo === '/cargar/detalle/pacientes') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_cargar_detalle_pacientes;
                }

                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\DefaultController::cargarDetallePacientes',  '_route' => 'cargar_detalle_pacientes',);
            }
            not_cargar_detalle_pacientes:

        }

        // listadomedicamento
        if (0 === strpos($pathinfo, '/listadomedicamento/get') && preg_match('#^/listadomedicamento/get/(?P<idHistorialClinico>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_listadomedicamento;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'listadomedicamento')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasController::getListadoMedicamentoAction',));
        }
        not_listadomedicamento:

        // borrar_medicina_recetada
        if (0 === strpos($pathinfo, '/borrar/medicina/recetada') && preg_match('#^/borrar/medicina/recetada/(?P<idMedicinaRecetada>[^/]++)/(?P<idHistorialClinico>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_borrar_medicina_recetada;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'borrar_medicina_recetada')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasController::borrarMedicinaRecetadaAction',));
        }
        not_borrar_medicina_recetada:

        if (0 === strpos($pathinfo, '/a')) {
            // actualizar_medicina_recetada
            if (0 === strpos($pathinfo, '/actualizar/medicina/recetada') && preg_match('#^/actualizar/medicina/recetada/(?P<idMedicinaRecetada>[^/]++)/(?P<idHistorialClinico>[^/]++)/(?P<durante>[^/]++)/(?P<totalMedicamento>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_actualizar_medicina_recetada;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'actualizar_medicina_recetada')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasController::actualizarMedicinaRecetadaAction',));
            }
            not_actualizar_medicina_recetada:

            // agregar_medicina_recetada
            if (0 === strpos($pathinfo, '/agregar/medicina/recetada') && preg_match('#^/agregar/medicina/recetada/(?P<idHistorialClinico>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_agregar_medicina_recetada;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'agregar_medicina_recetada')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasController::agregarMedicinaRecetadaAction',));
            }
            not_agregar_medicina_recetada:

        }

        if (0 === strpos($pathinfo, '/c')) {
            // calcular_fecha_receta
            if (0 === strpos($pathinfo, '/calcular/fecha') && preg_match('#^/calcular/fecha/(?P<fechaReceta>[^/]++)/(?P<cantidad>[^/]++)/(?P<tiempo>[^/]++)/(?P<idHistorialClinico>[^/]++)/(?P<i>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_calcular_fecha_receta;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'calcular_fecha_receta')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasController::calcularFechaReceta',));
            }
            not_calcular_fecha_receta:

            // consultar_medicina_recetada
            if (0 === strpos($pathinfo, '/consultar/medicina/recetada') && preg_match('#^/consultar/medicina/recetada/(?P<idMedicamento>[^/]++)/(?P<paramIdHistorialClinico>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_consultar_medicina_recetada;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'consultar_medicina_recetada')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasController::consultarMedicinaRecetadaAction',));
            }
            not_consultar_medicina_recetada:

        }

        // hoja_ingreso_egreso
        if (0 === strpos($pathinfo, '/hoja/ingreso/egreso') && preg_match('#^/hoja/ingreso/egreso/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'hoja_ingreso_egreso')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\ReporteSeguimientoController::hojaIngresoEgresoAction',));
        }

        // total_ingresos
        if (0 === strpos($pathinfo, '/total/ingresos') && preg_match('#^/total/ingresos/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'total_ingresos');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'total_ingresos')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\ReporteSeguimientoController::totalIngresosAction',));
        }

        // _report_seguimiento_paciente
        if (0 === strpos($pathinfo, '/report/seguimiento/paciente') && preg_match('#^/report/seguimiento/paciente/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => '_report_seguimiento_paciente')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\ReporteSeguimientoController::pacienteAction',));
        }

        // total_emergencias
        if (0 === strpos($pathinfo, '/total/emergencias') && preg_match('#^/total/emergencias/(?P<report_name>[^/]++)/(?P<report_format>[^/]++)/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'total_emergencias');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'total_emergencias')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\ReporteSeguimientoController::totalEmergenciasAction',));
        }

        if (0 === strpos($pathinfo, '/sec_antecedentes')) {
            // sec_antecedentes_leer
            if (0 === strpos($pathinfo, '/sec_antecedentes/leer') && preg_match('#^/sec_antecedentes/leer/(?P<idpaciente>[^/]++)/(?P<idatenaremodestab>[^/]++)(?:/(?P<idExp>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sec_antecedentes_leer')), array (  'idExp' => '0',  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecAntecedentesController::leerAntecedenteAction',));
            }

            // sec_antecedentes_show
            if (0 === strpos($pathinfo, '/sec_antecedentes/show') && preg_match('#^/sec_antecedentes/show/(?P<id>[^/]++)/(?P<idatenareamodestab>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sec_antecedentes_show')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecAntecedentesController::showAntecedenteAction',));
            }

        }

        if (0 === strpos($pathinfo, '/buscar/emergencias')) {
            // buscar_emergencias
            if ($pathinfo === '/buscar/emergencias') {
                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaController::buscarEmergenciasAction',  '_route' => 'buscar_emergencias',);
            }

            // buscar_emergencias_pacientes
            if ($pathinfo === '/buscar/emergencias/pacientes') {
                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaController::buscarEmergenciasPacienteAction',  '_route' => 'buscar_emergencias_pacientes',);
            }

        }

        // pacientes_en_emergencia
        if ($pathinfo === '/pacientes/en/emergencia') {
            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaController::cargarReporteEmergenciaAction',  '_route' => 'pacientes_en_emergencia',);
        }

        // diagnostico
        if ($pathinfo === '/diagnostico/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_diagnostico;
            }

            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::getDiagnosticoAction',  '_route' => 'diagnostico',);
        }
        not_diagnostico:

        // procquirurgico
        if ($pathinfo === '/procedimiento/quirurgico/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_procquirurgico;
            }

            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::getProcedimientoQuirurgicoAction',  '_route' => 'procquirurgico',);
        }
        not_procquirurgico:

        // verify_datos_pacientes_sumeve
        if (0 === strpos($pathinfo, '/datos/paciente/sumeve') && preg_match('#^/datos/paciente/sumeve/(?P<idpac>[^/]++)/verify$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_verify_datos_pacientes_sumeve;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'verify_datos_pacientes_sumeve')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::getDatosPacienteSumeve',));
        }
        not_verify_datos_pacientes_sumeve:

        // get_listado_pacientes_sumeve
        if (0 === strpos($pathinfo, '/get/listado/pacientes/sumeve') && preg_match('#^/get/listado/pacientes/sumeve/(?P<idPaciente>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_listado_pacientes_sumeve;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_listado_pacientes_sumeve')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::getListadoPacientesSumeve',));
        }
        not_get_listado_pacientes_sumeve:

        // especialidades_historia
        if (0 === strpos($pathinfo, '/obtener/especialidades/historia') && preg_match('#^/obtener/especialidades/historia/(?P<idPaciente>[^/]++)$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_especialidades_historia;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'especialidades_historia')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::obtenerEspecialidadesHistoria',));
        }
        not_especialidades_historia:

        if (0 === strpos($pathinfo, '/impresion')) {
            // imprimir_fvih01
            if (0 === strpos($pathinfo, '/impresion/fvih01') && preg_match('#^/impresion/fvih01/(?P<idHistorialClinico>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_imprimir_fvih01;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'imprimir_fvih01')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::imprimirFvih01dAction',));
            }
            not_imprimir_fvih01:

            if (0 === strpos($pathinfo, '/impresion/vigepes0')) {
                // imprimir_vigepes01
                if (0 === strpos($pathinfo, '/impresion/vigepes01') && preg_match('#^/impresion/vigepes01/(?P<idHistorialClinico>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_imprimir_vigepes01;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'imprimir_vigepes01')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::imprimirVigepes01dAction',));
                }
                not_imprimir_vigepes01:

                // imprimir_vigepes02
                if (0 === strpos($pathinfo, '/impresion/vigepes02') && preg_match('#^/impresion/vigepes02/(?P<idHistorialClinico>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_imprimir_vigepes02;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'imprimir_vigepes02')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::imprimirVigepes02dAction',));
                }
                not_imprimir_vigepes02:

            }

        }

        // addnewadvise
        if ($pathinfo === '/addNewAdvise/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_addnewadvise;
            }

            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::addNewAdviseAction',  '_route' => 'addnewadvise',);
        }
        not_addnewadvise:

        // updateadvise
        if ($pathinfo === '/updateadvise/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_updateadvise;
            }

            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::updateAdviseAction',  '_route' => 'updateadvise',);
        }
        not_updateadvise:

        // saveotrasobservaciones
        if ($pathinfo === '/saveotrasobservaciones/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_saveotrasobservaciones;
            }

            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::saveotrasobservacionesAction',  '_route' => 'saveotrasobservaciones',);
        }
        not_saveotrasobservaciones:

        if (0 === strpos($pathinfo, '/especialidades')) {
            // especialidadesConfiguradas
            if ($pathinfo === '/especialidadesConfiguradas/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_especialidadesConfiguradas;
                }

                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::especialidadesConfiguradasAction',  '_route' => 'especialidadesConfiguradas',);
            }
            not_especialidadesConfiguradas:

            // especialidadesLocales
            if ($pathinfo === '/especialidadesLocales/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_especialidadesLocales;
                }

                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::especialidadesLocalesAction',  '_route' => 'especialidadesLocales',);
            }
            not_especialidadesLocales:

        }

        // tipolugartrabajo
        if ($pathinfo === '/tipolugartrabajo/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_tipolugartrabajo;
            }

            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::getTipoLugarTrabajoAction',  '_route' => 'tipolugartrabajo',);
        }
        not_tipolugartrabajo:

        if (0 === strpos($pathinfo, '/c')) {
            // consulta_recibida
            if (rtrim($pathinfo, '/') === '/consulta/recibida') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_consulta_recibida;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'consulta_recibida');
                }

                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::consultaRecibidaAction',  '_route' => 'consulta_recibida',);
            }
            not_consulta_recibida:

            // cantidad_historias_medico
            if ($pathinfo === '/cantidad/historias/medico') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_cantidad_historias_medico;
                }

                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::cantidadHistoriasMedicosAction',  '_route' => 'cantidad_historias_medico',);
            }
            not_cantidad_historias_medico:

            // confirmsecsolicitudmatch
            if ($pathinfo === '/confirmSecSolicitudMatch/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_confirmsecsolicitudmatch;
                }

                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoController::confirmSecSolicitudMatch',  '_route' => 'confirmsecsolicitudmatch',);
            }
            not_confirmsecsolicitudmatch:

        }

        if (0 === strpos($pathinfo, '/obtener')) {
            // get_especialidad_ingresos
            if ($pathinfo === '/obtener/especialidades/ingresos') {
                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::getEspecialidadesIngresoAction',  '_route' => 'get_especialidad_ingresos',);
            }

            if (0 === strpos($pathinfo, '/obtener/servicios/hospitalarios')) {
                // get_servicios_hospitalarios
                if ($pathinfo === '/obtener/servicios/hospitalarios') {
                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::getServiciosHospitalariosAction',  '_route' => 'get_servicios_hospitalarios',);
                }

                // get_servicios_hospitalarios_otros
                if ($pathinfo === '/obtener/servicios/hospitalarios/otros') {
                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::getServiciosHospitalariosOtrosAction',  '_route' => 'get_servicios_hospitalarios_otros',);
                }

                // get_servicios_hospitalarios_todos
                if ($pathinfo === '/obtener/servicios/hospitalarios/todos') {
                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::getServiciosHospitalariosTodosAction',  '_route' => 'get_servicios_hospitalarios_todos',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/buscar/ingresos')) {
            // buscar_ingresos
            if ($pathinfo === '/buscar/ingresos') {
                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::buscarIngresosAction',  '_route' => 'buscar_ingresos',);
            }

            // buscar_ingresos_pacientes
            if ($pathinfo === '/buscar/ingresos/pacientes') {
                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::buscarIngresosPacienteAction',  '_route' => 'buscar_ingresos_pacientes',);
            }

        }

        // pacientes_ingresados
        if ($pathinfo === '/pacientes/ingresado') {
            return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoController::cargarReporteIngresoAction',  '_route' => 'pacientes_ingresados',);
        }

        if (0 === strpos($pathinfo, '/c')) {
            if (0 === strpos($pathinfo, '/citas')) {
                // citasdiaxmedico
                if ($pathinfo === '/citas/dia/medico/get') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_citasdiaxmedico;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getCitCitasDiaxMedicoAction',  '_route' => 'citasdiaxmedico',);
                }
                not_citasdiaxmedico:

                // citashorariomedico
                if ($pathinfo === '/citas/horario/medico/get') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_citashorariomedico;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getHorarioMedicoAction',  '_route' => 'citashorariomedico',);
                }
                not_citashorariomedico:

                // citasverificarevento
                if ($pathinfo === '/citas/verificar/evento/get') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_citasverificarevento;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::verifyMedicEventAction',  '_route' => 'citasverificarevento',);
                }
                not_citasverificarevento:

                if (0 === strpos($pathinfo, '/citas/d')) {
                    // citasdetallehora
                    if ($pathinfo === '/citas/detalle/hora/get') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_citasdetallehora;
                        }

                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getDetalleCitaHoraAction',  '_route' => 'citasdetallehora',);
                    }
                    not_citasdetallehora:

                    // verificar_dias_intermedios
                    if ($pathinfo === '/citas/dias/intermedios/verify') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_verificar_dias_intermedios;
                        }

                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::verificarDiasIntermediosAction',  '_route' => 'verificar_dias_intermedios',);
                    }
                    not_verificar_dias_intermedios:

                }

                // citasexpedientepaciente
                if ($pathinfo === '/citas/expediente/paciente/get') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_citasexpedientepaciente;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getExpedientePacienteAction',  '_route' => 'citasexpedientepaciente',);
                }
                not_citasexpedientepaciente:

                if (0 === strpos($pathinfo, '/citas/medicos')) {
                    // citasgetmedico
                    if ($pathinfo === '/citas/medicos/get') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_citasgetmedico;
                        }

                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getMedicoAction',  '_route' => 'citasgetmedico',);
                    }
                    not_citasgetmedico:

                    // citasgetmedicoespecialidadestab
                    if ($pathinfo === '/citas/medicos/especilidad/estab/get') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_citasgetmedicoespecialidadestab;
                        }

                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getMedicoEspecialidadEstabAction',  '_route' => 'citasgetmedicoespecialidadestab',);
                    }
                    not_citasgetmedicoespecialidadestab:

                }

                // citaspacienteposeecita
                if ($pathinfo === '/citas/paciente/poseecita/get') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_citaspacienteposeecita;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::pacientePoseeCitaAction',  '_route' => 'citaspacienteposeecita',);
                }
                not_citaspacienteposeecita:

                // citascomprobardisponibilidad
                if ($pathinfo === '/citas/comprobar/disponibilidad') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_citascomprobardisponibilidad;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::comprobarDisponibilidadAction',  '_route' => 'citascomprobardisponibilidad',);
                }
                not_citascomprobardisponibilidad:

                if (0 === strpos($pathinfo, '/citas/historia')) {
                    // datehistorymatch
                    if ($pathinfo === '/citas/historia/paciente/match/get') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_datehistorymatch;
                        }

                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::dateHistoryMatchAction',  '_route' => 'datehistorymatch',);
                    }
                    not_datehistorymatch:

                    // datehistorycomplementmatch
                    if ($pathinfo === '/citas/historia/farmcomplement/paciente/match/get') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_datehistorycomplementmatch;
                        }

                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::dateHistoryComplementMatchAction',  '_route' => 'datehistorycomplementmatch',);
                    }
                    not_datehistorycomplementmatch:

                }

                // citasgetcomprobante
                if ($pathinfo === '/citas/comprobante/get') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_citasgetcomprobante;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getComprobanteCitaAction',  '_route' => 'citasgetcomprobante',);
                }
                not_citasgetcomprobante:

                // get_citas_info_rango
                if ($pathinfo === '/citas/info/rango') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_get_citas_info_rango;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getCitasInfoRangoAction',  '_route' => 'get_citas_info_rango',);
                }
                not_get_citas_info_rango:

                if (0 === strpos($pathinfo, '/citas/t')) {
                    // citas_tipo_cita
                    if (0 === strpos($pathinfo, '/citas/tipo/cita') && preg_match('#^/citas/tipo/cita/(?P<idEmpleado>[^/]++)/(?P<idEspecialidad>[^/]++)/(?P<idExpediente>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_citas_tipo_cita;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'citas_tipo_cita')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::determinarTipoCitaAction',));
                    }
                    not_citas_tipo_cita:

                    // citas_transferir_cita
                    if ($pathinfo === '/citas/transferir/cita') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_citas_transferir_cita;
                        }

                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::transferirCitasAction',  '_route' => 'citas_transferir_cita',);
                    }
                    not_citas_transferir_cita:

                }

                // citas_verificar_cita_previa
                if ($pathinfo === '/citas/verificar/cita/previa') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_citas_verificar_cita_previa;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::verificarCitaPreviaAction',  '_route' => 'citas_verificar_cita_previa',);
                }
                not_citas_verificar_cita_previa:

            }

            // consultar_citas_proximas
            if (rtrim($pathinfo, '/') === '/consultar/proximas/citas') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_consultar_citas_proximas;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'consultar_citas_proximas');
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::consultarProximasCitasAction',  '_route' => 'consultar_citas_proximas',);
            }
            not_consultar_citas_proximas:

            // obtener_cantidad_citas_expediente
            if (0 === strpos($pathinfo, '/citas/expediente') && preg_match('#^/citas/expediente/(?P<idAreaModEstab>[^/]++)/(?P<idExpediente>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'obtener_cantidad_citas_expediente')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::obtenerEspecialidadesPorArea',));
            }

        }

        // obtener_medicos_tipocita_especialidad
        if (0 === strpos($pathinfo, '/obtener/medicos/tipocita/especialidad') && preg_match('#^/obtener/medicos/tipocita/especialidad/(?P<idAtenAreaModEstab>[^/]++)/(?P<idTipocita>[^/]++)/(?P<idTipoDistribucionCita>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'obtener_medicos_tipocita_especialidad')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::obtenerMedicosPorEspecialidadPorTipocita',));
        }

        // citas_test
        if ($pathinfo === '/citas/test') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_citas_test;
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::testAction',  '_route' => 'citas_test',);
        }
        not_citas_test:

        // dar_cita_medica
        if ($pathinfo === '/dar/cita/medica') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_dar_cita_medica;
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::darCitaAction',  '_route' => 'dar_cita_medica',);
        }
        not_dar_cita_medica:

        if (0 === strpos($pathinfo, '/consulta')) {
            // consulta_citas_por_dia
            if ($pathinfo === '/consulta/citas/por/dia') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_consulta_citas_por_dia;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getConsultaCitasPorDiaAction',  '_route' => 'consulta_citas_por_dia',);
            }
            not_consulta_citas_por_dia:

            // consulta_fechas_libres
            if ($pathinfo === '/consulta/fechas/libres/citasmedicas') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_consulta_fechas_libres;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getConsultaFechasLibresAction',  '_route' => 'consulta_fechas_libres',);
            }
            not_consulta_fechas_libres:

            // consulta_estadistica_medico
            if ($pathinfo === '/consulta/estadistica/medico') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_consulta_estadistica_medico;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::consultaEstadisticaMedicoAction',  '_route' => 'consulta_estadistica_medico',);
            }
            not_consulta_estadistica_medico:

        }

        // obtener_tipodistribucion_medico
        if (0 === strpos($pathinfo, '/obtener/tipodistribucion') && preg_match('#^/obtener/tipodistribucion/(?P<idEmpleado>[^/]++)/(?P<idAtenAreaModEstab>[^/]++)/(?P<idTipoDistribucionCita>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'obtener_tipodistribucion_medico')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::obtenerTipodistribucionPorMedico',));
        }

        // consulta_citas_eliminadas
        if ($pathinfo === '/consulta/citas/eliminadas') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_consulta_citas_eliminadas;
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::getCitasEliminadasAction',  '_route' => 'consulta_citas_eliminadas',);
        }
        not_consulta_citas_eliminadas:

        // consulta_citas_programadas
        if ($pathinfo === '/programadas/medico') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_consulta_citas_programadas;
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaController::citasProgramadasMedicoAction',  '_route' => 'consulta_citas_programadas',);
        }
        not_consulta_citas_programadas:

        // obtener_procedimientos_distribucion_area
        if (0 === strpos($pathinfo, '/distribucion/procedimientos/area') && preg_match('#^/distribucion/procedimientos/area/(?P<idAreaModEstab>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'obtener_procedimientos_distribucion_area')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosController::obtenerProcedimientosPorArea',));
        }

        // obtener_medicos_por_procedimiento
        if (0 === strpos($pathinfo, '/obtener/medicos/procedimiento') && preg_match('#^/obtener/medicos/procedimiento/(?P<idProcedimientoEstablecimiento>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'obtener_medicos_por_procedimiento')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosController::obtenerMedicosProcedimiento',));
        }

        // dar_cita_procedimiento
        if ($pathinfo === '/dar/cita/procedimiento') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_dar_cita_procedimiento;
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosController::darCitaAction',  '_route' => 'dar_cita_procedimiento',);
        }
        not_dar_cita_procedimiento:

        // procedimientosgetcomprobante
        if ($pathinfo === '/procedimientos/comprobante/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                goto not_procedimientosgetcomprobante;
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosController::getComprobanteCitaAction',  '_route' => 'procedimientosgetcomprobante',);
        }
        not_procedimientosgetcomprobante:

        if (0 === strpos($pathinfo, '/c')) {
            if (0 === strpos($pathinfo, '/consulta')) {
                // consulta_citas_procedimientos_por_dia
                if ($pathinfo === '/consulta/citas/procedimientos/por/dia') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_consulta_citas_procedimientos_por_dia;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosController::getConsultaCitasProcedimientosPorDiaAction',  '_route' => 'consulta_citas_procedimientos_por_dia',);
                }
                not_consulta_citas_procedimientos_por_dia:

                // consultar_citas_proximas_procedimiento
                if ($pathinfo === '/consultar/proximas/citas/procedimiento') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_consultar_citas_proximas_procedimiento;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosController::consultarProximasCitasAction',  '_route' => 'consultar_citas_proximas_procedimiento',);
                }
                not_consultar_citas_proximas_procedimiento:

            }

            if (0 === strpos($pathinfo, '/citas')) {
                // get_citas_dia_procedimiento
                if ($pathinfo === '/citas/dia/procedimiento/get') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_get_citas_dia_procedimiento;
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosController::getCitasDiaProcedimientoAction',  '_route' => 'get_citas_dia_procedimiento',);
                }
                not_get_citas_dia_procedimiento:

                if (0 === strpos($pathinfo, '/citas/procedimiento')) {
                    // get_citas_procedimiento_detallehora
                    if ($pathinfo === '/citas/procedimiento/detalle/hora/get') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_get_citas_procedimiento_detallehora;
                        }

                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosController::getCitasProcedimientoDetalleHoraAction',  '_route' => 'get_citas_procedimiento_detallehora',);
                    }
                    not_get_citas_procedimiento_detallehora:

                    // citashorarioProcedimiento
                    if ($pathinfo === '/citas/procedimiento/horario/get') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_citashorarioProcedimiento;
                        }

                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosController::getHorarioMedicoAction',  '_route' => 'citashorarioProcedimiento',);
                    }
                    not_citashorarioProcedimiento:

                }

            }

        }

        // obtener_tipodistribucion_procedimiento
        if (0 === strpos($pathinfo, '/obtener/tipo/distribucion/procedimiento') && preg_match('#^/obtener/tipo/distribucion/procedimiento/(?P<idProcedimientoEstablecimiento>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'obtener_tipodistribucion_procedimiento')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosController::obtenerTipodistribucionPorProcedimiento',));
        }

        if (0 === strpos($pathinfo, '/c')) {
            // consulta_fechas_libres_procedimiento
            if ($pathinfo === '/consulta/fechas/libres/procedimientos') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_consulta_fechas_libres_procedimiento;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosController::getConsultaFechasLibresAction',  '_route' => 'consulta_fechas_libres_procedimiento',);
            }
            not_consulta_fechas_libres_procedimiento:

            // cargar_distribucion_medico
            if ($pathinfo === '/cargar/distribucion/medico/') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_cargar_distribucion_medico;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionController::cargarDistribucion',  '_route' => 'cargar_distribucion_medico',);
            }
            not_cargar_distribucion_medico:

        }

        // verificar_horario_distribucion
        if (rtrim($pathinfo, '/') === '/verificar/horario/distribucion') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_verificar_horario_distribucion;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'verificar_horario_distribucion');
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionController::verificarHorario',  '_route' => 'verificar_horario_distribucion',);
        }
        not_verificar_horario_distribucion:

        // cargar_distribucion_procedimiento_medico
        if ($pathinfo === '/cargar/distribucion/procedimiento/medico/') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_cargar_distribucion_procedimiento_medico;
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionProcedimientoController::cargarDistribucionProcedimiento',  '_route' => 'cargar_distribucion_procedimiento_medico',);
        }
        not_cargar_distribucion_procedimiento_medico:

        // verificar_horario_distribucion_procedimiento
        if (rtrim($pathinfo, '/') === '/verificar/horario/distribucion/procedimiento') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_verificar_horario_distribucion_procedimiento;
            }

            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'verificar_horario_distribucion_procedimiento');
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionProcedimientoController::verificarHorario',  '_route' => 'verificar_horario_distribucion_procedimiento',);
        }
        not_verificar_horario_distribucion_procedimiento:

        // get_justificacion_reprogramacion
        if ($pathinfo === '/citjustificacion/reprogramacion/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_justificacion_reprogramacion;
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitJustificacionController::getJustificacionReprogramacion',  '_route' => 'get_justificacion_reprogramacion',);
        }
        not_get_justificacion_reprogramacion:

        // obtener_cupos_citas
        if (rtrim($pathinfo, '/') === '/obtener/cupo/citas') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'obtener_cupos_citas');
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\GeneralCitasController::obtenerCuposCitasMedicas',  '_route' => 'obtener_cupos_citas',);
        }

        if (0 === strpos($pathinfo, '/c')) {
            // cargar_produccion_citas_recurso
            if ($pathinfo === '/cargar/produccion/citas/recurso') {
                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\GeneralCitasController::cargarProduccionCitasRecursoAction',  '_route' => 'cargar_produccion_citas_recurso',);
            }

            if (0 === strpos($pathinfo, '/citas/buildcomprobante')) {
                // citasbuildcomprobante
                if (0 === strpos($pathinfo, '/citas/buildcomprobante/get') && preg_match('#^/citas/buildcomprobante/get/(?P<id>[^/]++)(?:/(?P<report_format>[^/]++))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_citasbuildcomprobante;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'citasbuildcomprobante')), array (  'report_format' => 'HTML',  '_controller' => 'Minsal\\CitasBundle\\Controller\\ReporteController::buildComprobanteCitaAction',));
                }
                not_citasbuildcomprobante:

                // citasbuildcomprobante_ticket
                if (0 === strpos($pathinfo, '/citas/buildcomprobante/ticke') && preg_match('#^/citas/buildcomprobante/ticke/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_citasbuildcomprobante_ticket;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'citasbuildcomprobante_ticket')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\ReporteController::buildComprobanteCitaTicketAction',));
                }
                not_citasbuildcomprobante_ticket:

            }

        }

        if (0 === strpos($pathinfo, '/procedim')) {
            // procedimientosbuildcomprobante
            if (0 === strpos($pathinfo, '/procedimientos/comprobante/get') && preg_match('#^/procedimientos/comprobante/get/(?P<id>[^/]++)(?:/(?P<report_format>[^/]++))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_procedimientosbuildcomprobante;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'procedimientosbuildcomprobante')), array (  'report_format' => 'HTML',  '_controller' => 'Minsal\\CitasBundle\\Controller\\ReporteController::buildComprobanteCitaProcedimientoAction',));
            }
            not_procedimientosbuildcomprobante:

            // procedimientosbuildcomprobante_ticket
            if (0 === strpos($pathinfo, '/procedimentos/buildcomprobante/ticke') && preg_match('#^/procedimentos/buildcomprobante/ticke/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_procedimientosbuildcomprobante_ticket;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'procedimientosbuildcomprobante_ticket')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\ReporteController::buildComprobanteCitaProcedimientoTicketAction',));
            }
            not_procedimientosbuildcomprobante_ticket:

        }

        if (0 === strpos($pathinfo, '/buil')) {
            if (0 === strpos($pathinfo, '/buildcitasp')) {
                // buildCitasPorDia
                if (rtrim($pathinfo, '/') === '/buildcitaspordia') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_buildCitasPorDia;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'buildCitasPorDia');
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\ReporteController::buildCitasPorDiaAction',  '_route' => 'buildCitasPorDia',);
                }
                not_buildCitasPorDia:

                // buildCitasProcedimientoPorDia
                if (rtrim($pathinfo, '/') === '/buildcitasprocedimientopordia') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_buildCitasProcedimientoPorDia;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'buildCitasProcedimientoPorDia');
                    }

                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\ReporteController::buildCitasProcedimientoPorDiaAction',  '_route' => 'buildCitasProcedimientoPorDia',);
                }
                not_buildCitasProcedimientoPorDia:

            }

            // builCitasEliminadas
            if (rtrim($pathinfo, '/') === '/builCitasEliminadas') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_builCitasEliminadas;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'builCitasEliminadas');
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\ReporteController::builCitasEliminadasAction',  '_route' => 'builCitasEliminadas',);
            }
            not_builCitasEliminadas:

        }

        // modalida
        if ($pathinfo === '/modalida/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_modalida;
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\TableroController::ModalidaAction',  '_route' => 'modalida',);
        }
        not_modalida:

        if (0 === strpos($pathinfo, '/a')) {
            // asigna_cita
            if ($pathinfo === '/asigna_cita/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_asigna_cita;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\TableroController::AsignaCitaAction',  '_route' => 'asigna_cita',);
            }
            not_asigna_cita:

            // agenda_dia
            if ($pathinfo === '/agenda_dia/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_agenda_dia;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\TableroController::Agende_DiaAction',  '_route' => 'agenda_dia',);
            }
            not_agenda_dia:

            // area_atencion
            if ($pathinfo === '/area_atencion/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_area_atencion;
                }

                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\TableroController::AreaAtencionction',  '_route' => 'area_atencion',);
            }
            not_area_atencion:

        }

        // crear_cita
        if ($pathinfo === '/crear_cita/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_crear_cita;
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\TableroController::Crear_CitaAction',  '_route' => 'crear_cita',);
        }
        not_crear_cita:

        // area_modalida
        if ($pathinfo === '/area_modalida/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_area_modalida;
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\TableroController::AreaModalidaAction',  '_route' => 'area_modalida',);
        }
        not_area_modalida:

        // filtrar
        if ($pathinfo === '/filtrar/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_filtrar;
            }

            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\TableroController::filtarAction',  '_route' => 'filtrar',);
        }
        not_filtrar:

        if (0 === strpos($pathinfo, '/laboratorio')) {
            // getsecsollabexamen
            if ($pathinfo === '/laboratorio/examen/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_getsecsollabexamen;
                }

                return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosController::getExamenLaboratorioAction',  '_route' => 'getsecsollabexamen',);
            }
            not_getsecsollabexamen:

            // gettipomuestraexam
            if ($pathinfo === '/laboratorio/tipomuestra/examen/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_gettipomuestraexam;
                }

                return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosController::getTipoMuestraExamenAction',  '_route' => 'gettipomuestraexam',);
            }
            not_gettipomuestraexam:

            // getorigenmuestraexam
            if ($pathinfo === '/laboratorio/origenmuestra/examen/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_getorigenmuestraexam;
                }

                return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosController::getOrigenMuestraExamenAction',  '_route' => 'getorigenmuestraexam',);
            }
            not_getorigenmuestraexam:

            // get_laboratorio_perfiles
            if ($pathinfo === '/laboratorio/perfiles/get') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_laboratorio_perfiles;
                }

                return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosController::getPerfilesLaboratorioAction',  '_route' => 'get_laboratorio_perfiles',);
            }
            not_get_laboratorio_perfiles:

        }

        // get_paciente
        if ($pathinfo === '/get_paciente') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_paciente;
            }

            return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosController::getPaciente',  '_route' => 'get_paciente',);
        }
        not_get_paciente:

        // get_sexo
        if ($pathinfo === '/sexo/get') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_get_sexo;
            }

            return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosController::getSexoAction',  '_route' => 'get_sexo',);
        }
        not_get_sexo:

        if (0 === strpos($pathinfo, '/get_')) {
            // get_cie_10
            if ($pathinfo === '/get_cie_10') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_cie_10;
                }

                return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosController::getCie10Action',  '_route' => 'get_cie_10',);
            }
            not_get_cie_10:

            // get_procedencia
            if ($pathinfo === '/get_procedencia') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_procedencia;
                }

                return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosController::get_procedenciaAction',  '_route' => 'get_procedencia',);
            }
            not_get_procedencia:

            // get_subservicio
            if ($pathinfo === '/get_subservicio') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_subservicio;
                }

                return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosController::get_subservicioAction',  '_route' => 'get_subservicio',);
            }
            not_get_subservicio:

            // get_medico
            if ($pathinfo === '/get_medico') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_medico;
                }

                return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosController::get_medicoAction',  '_route' => 'get_medico',);
            }
            not_get_medico:

        }

        // createtourstep
        if ($pathinfo === '/create/tourstep') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_createtourstep;
            }

            return array (  '_controller' => 'Application\\CoreBundle\\Controller\\MntUserTourController::createTourStepAction',  '_route' => 'createtourstep',);
        }
        not_createtourstep:

        if (0 === strpos($pathinfo, '/ws_')) {
            // ws_acceptmessage
            if ($pathinfo === '/ws_acceptmessage') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_ws_acceptmessage;
                }

                return array (  '_controller' => 'Application\\SoapBundle\\Controller\\InterfaceLisController::ws_acceptMessageAction',  '_route' => 'ws_acceptmessage',);
            }
            not_ws_acceptmessage:

            // ws_checkin
            if ($pathinfo === '/ws_checkin') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_ws_checkin;
                }

                return array (  '_controller' => 'Application\\SoapBundle\\Controller\\InterfaceLisController::checkinAction',  '_route' => 'ws_checkin',);
            }
            not_ws_checkin:

        }

        if (0 === strpos($pathinfo, '/api/laboratorio')) {
            // api_laboratorio_generarHl7_create
            if (0 === strpos($pathinfo, '/api/laboratorio/generarHl7') && preg_match('#^/api/laboratorio/generarHl7/(?P<id>[^/]++)/create$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_laboratorio_generarHl7_create;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_laboratorio_generarHl7_create')), array (  'id' => NULL,  '_controller' => 'Application\\SoapBundle\\Controller\\InterfaceLisController::apiLaboratorioGenerarHl7CreateAction',));
            }
            not_api_laboratorio_generarHl7_create:

            // api_laboratorio_resultados_equipoautomatizado_save
            if ($pathinfo === '/api/laboratorio/resultados/equipoautomatizado/save') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_laboratorio_resultados_equipoautomatizado_save;
                }

                return array (  '_controller' => 'Application\\SoapBundle\\Controller\\InterfaceLisController::apiLaboratorioResultadosEquipoAutomatizadoSaveAction',  '_route' => 'api_laboratorio_resultados_equipoautomatizado_save',);
            }
            not_api_laboratorio_resultados_equipoautomatizado_save:

        }

        // ws_codificar_solicitudes_pendiente
        if ($pathinfo === '/ws_codificar_solicitud_pendiente') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_ws_codificar_solicitudes_pendiente;
            }

            return array (  '_controller' => 'Application\\SoapBundle\\Controller\\InterfaceLisController::codificarSolicitudPendienteAction',  '_route' => 'ws_codificar_solicitudes_pendiente',);
        }
        not_ws_codificar_solicitudes_pendiente:

        // api_laboratorio_solicitud_equipoautomatizado_send
        if ($pathinfo === '/api/laboratorio/solicitud/equipoautomatizado/send') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_api_laboratorio_solicitud_equipoautomatizado_send;
            }

            return array (  '_controller' => 'Application\\SoapBundle\\Controller\\InterfaceLisController::apiLaboratorioSolicitudEquipoAutomatizadoSendAction',  '_route' => 'api_laboratorio_solicitud_equipoautomatizado_send',);
        }
        not_api_laboratorio_solicitud_equipoautomatizado_send:

        // ws_soap
        if (0 === strpos($pathinfo, '/soap') && preg_match('#^/soap/(?P<service>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'ws_soap')), array (  '_controller' => 'Application\\SoapBundle\\Controller\\WebServiceProviderController::getWebServiceAction',));
        }

        if (0 === strpos($pathinfo, '/a')) {
            if (0 === strpos($pathinfo, '/api')) {
                if (0 === strpos($pathinfo, '/api/check')) {
                    // application_api_checkin
                    if ($pathinfo === '/api/checkin') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_application_api_checkin;
                        }

                        return array (  '_controller' => 'Application\\ApiBundle\\Controller\\ApiController::checkInAction',  '_route' => 'application_api_checkin',);
                    }
                    not_application_api_checkin:

                    // application_api_check_token
                    if ($pathinfo === '/api/check/token') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_application_api_check_token;
                        }

                        return array (  '_controller' => 'Application\\ApiBundle\\Controller\\ApiController::checkTokenAction',  '_route' => 'application_api_check_token',);
                    }
                    not_application_api_check_token:

                }

                // application_api_isgranted
                if ($pathinfo === '/api/isgranted') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_application_api_isgranted;
                    }

                    return array (  '_controller' => 'Application\\ApiBundle\\Controller\\ApiController::isGrantedAction',  '_route' => 'application_api_isgranted',);
                }
                not_application_api_isgranted:

                // application_api_check_out
                if ($pathinfo === '/api/checkout') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_application_api_check_out;
                    }

                    return array (  '_controller' => 'Application\\ApiBundle\\Controller\\ApiController::checkOutAction',  '_route' => 'application_api_check_out',);
                }
                not_application_api_check_out:

            }

            if (0 === strpos($pathinfo, '/admin')) {
                // sonata_admin_redirect
                if (rtrim($pathinfo, '/') === '/admin') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'sonata_admin_redirect');
                    }

                    return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'sonata_admin_dashboard',  'permanent' => 'true',  '_route' => 'sonata_admin_redirect',);
                }

                // sonata_admin_dashboard
                if ($pathinfo === '/admin/dashboard') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::dashboardAction',  '_route' => 'sonata_admin_dashboard',);
                }

                if (0 === strpos($pathinfo, '/admin/core')) {
                    // sonata_admin_retrieve_form_element
                    if ($pathinfo === '/admin/core/get-form-field-element') {
                        return array (  '_controller' => 'sonata.admin.controller.admin:retrieveFormFieldElementAction',  '_route' => 'sonata_admin_retrieve_form_element',);
                    }

                    // sonata_admin_append_form_element
                    if ($pathinfo === '/admin/core/append-form-field-element') {
                        return array (  '_controller' => 'sonata.admin.controller.admin:appendFormFieldElementAction',  '_route' => 'sonata_admin_append_form_element',);
                    }

                    // sonata_admin_short_object_information
                    if (0 === strpos($pathinfo, '/admin/core/get-short-object-description') && preg_match('#^/admin/core/get\\-short\\-object\\-description(?:\\.(?P<_format>html|json))?$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_admin_short_object_information')), array (  '_controller' => 'sonata.admin.controller.admin:getShortObjectDescriptionAction',  '_format' => 'html',));
                    }

                    // sonata_admin_set_object_field_value
                    if ($pathinfo === '/admin/core/set-object-field-value') {
                        return array (  '_controller' => 'sonata.admin.controller.admin:setObjectFieldValueAction',  '_route' => 'sonata_admin_set_object_field_value',);
                    }

                }

                // sonata_admin_search
                if ($pathinfo === '/admin/search') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::searchAction',  '_route' => 'sonata_admin_search',);
                }

                if (0 === strpos($pathinfo, '/admin/minsal/s')) {
                    if (0 === strpos($pathinfo, '/admin/minsal/siaps')) {
                        if (0 === strpos($pathinfo, '/admin/minsal/siaps/ctlestablecimiento')) {
                            // admin_minsal_siaps_ctlestablecimiento_list
                            if ($pathinfo === '/admin/minsal/siaps/ctlestablecimiento/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.establecimiento',  '_sonata_name' => 'admin_minsal_siaps_ctlestablecimiento_list',  '_route' => 'admin_minsal_siaps_ctlestablecimiento_list',);
                            }

                            // admin_minsal_siaps_ctlestablecimiento_batch
                            if ($pathinfo === '/admin/minsal/siaps/ctlestablecimiento/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.establecimiento',  '_sonata_name' => 'admin_minsal_siaps_ctlestablecimiento_batch',  '_route' => 'admin_minsal_siaps_ctlestablecimiento_batch',);
                            }

                            // admin_minsal_siaps_ctlestablecimiento_edit
                            if (preg_match('#^/admin/minsal/siaps/ctlestablecimiento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_ctlestablecimiento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.establecimiento',  '_sonata_name' => 'admin_minsal_siaps_ctlestablecimiento_edit',));
                            }

                            // admin_minsal_siaps_ctlestablecimiento_show
                            if (preg_match('#^/admin/minsal/siaps/ctlestablecimiento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_ctlestablecimiento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.establecimiento',  '_sonata_name' => 'admin_minsal_siaps_ctlestablecimiento_show',));
                            }

                            // admin_minsal_siaps_ctlestablecimiento_export
                            if ($pathinfo === '/admin/minsal/siaps/ctlestablecimiento/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.establecimiento',  '_sonata_name' => 'admin_minsal_siaps_ctlestablecimiento_export',  '_route' => 'admin_minsal_siaps_ctlestablecimiento_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/siaps/mnt')) {
                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntmodalidadestablecimiento')) {
                                // admin_minsal_siaps_mntmodalidadestablecimiento_list
                                if ($pathinfo === '/admin/minsal/siaps/mntmodalidadestablecimiento/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_list',  '_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_list',);
                                }

                                // admin_minsal_siaps_mntmodalidadestablecimiento_create
                                if ($pathinfo === '/admin/minsal/siaps/mntmodalidadestablecimiento/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_create',  '_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_create',);
                                }

                                // admin_minsal_siaps_mntmodalidadestablecimiento_batch
                                if ($pathinfo === '/admin/minsal/siaps/mntmodalidadestablecimiento/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_batch',  '_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_batch',);
                                }

                                // admin_minsal_siaps_mntmodalidadestablecimiento_edit
                                if (preg_match('#^/admin/minsal/siaps/mntmodalidadestablecimiento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_edit',));
                                }

                                // admin_minsal_siaps_mntmodalidadestablecimiento_delete
                                if (preg_match('#^/admin/minsal/siaps/mntmodalidadestablecimiento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_delete',));
                                }

                                // admin_minsal_siaps_mntmodalidadestablecimiento_show
                                if (preg_match('#^/admin/minsal/siaps/mntmodalidadestablecimiento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_show',));
                                }

                                // admin_minsal_siaps_mntmodalidadestablecimiento_export
                                if ($pathinfo === '/admin/minsal/siaps/mntmodalidadestablecimiento/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.modalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntmodalidadestablecimiento_export',  '_route' => 'admin_minsal_siaps_mntmodalidadestablecimiento_export',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mnta')) {
                                if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntareamodestab')) {
                                    // admin_minsal_siaps_mntareamodestab_list
                                    if ($pathinfo === '/admin/minsal/siaps/mntareamodestab/list') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_list',  '_route' => 'admin_minsal_siaps_mntareamodestab_list',);
                                    }

                                    // admin_minsal_siaps_mntareamodestab_create
                                    if ($pathinfo === '/admin/minsal/siaps/mntareamodestab/create') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_create',  '_route' => 'admin_minsal_siaps_mntareamodestab_create',);
                                    }

                                    // admin_minsal_siaps_mntareamodestab_batch
                                    if ($pathinfo === '/admin/minsal/siaps/mntareamodestab/batch') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_batch',  '_route' => 'admin_minsal_siaps_mntareamodestab_batch',);
                                    }

                                    // admin_minsal_siaps_mntareamodestab_edit
                                    if (preg_match('#^/admin/minsal/siaps/mntareamodestab/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntareamodestab_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_edit',));
                                    }

                                    // admin_minsal_siaps_mntareamodestab_delete
                                    if (preg_match('#^/admin/minsal/siaps/mntareamodestab/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntareamodestab_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_delete',));
                                    }

                                    // admin_minsal_siaps_mntareamodestab_show
                                    if (preg_match('#^/admin/minsal/siaps/mntareamodestab/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntareamodestab_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_show',));
                                    }

                                    // admin_minsal_siaps_mntareamodestab_export
                                    if ($pathinfo === '/admin/minsal/siaps/mntareamodestab/export') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.areamodalidadestablecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntareamodestab_export',  '_route' => 'admin_minsal_siaps_mntareamodestab_export',);
                                    }

                                }

                                if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntatenareamodestab')) {
                                    // admin_minsal_siaps_mntatenareamodestab_list
                                    if ($pathinfo === '/admin/minsal/siaps/mntatenareamodestab/list') {
                                        return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::listAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_list',  '_route' => 'admin_minsal_siaps_mntatenareamodestab_list',);
                                    }

                                    // admin_minsal_siaps_mntatenareamodestab_create
                                    if ($pathinfo === '/admin/minsal/siaps/mntatenareamodestab/create') {
                                        return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::createAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_create',  '_route' => 'admin_minsal_siaps_mntatenareamodestab_create',);
                                    }

                                    // admin_minsal_siaps_mntatenareamodestab_batch
                                    if ($pathinfo === '/admin/minsal/siaps/mntatenareamodestab/batch') {
                                        return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_batch',  '_route' => 'admin_minsal_siaps_mntatenareamodestab_batch',);
                                    }

                                    // admin_minsal_siaps_mntatenareamodestab_edit
                                    if (preg_match('#^/admin/minsal/siaps/mntatenareamodestab/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntatenareamodestab_edit')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::editAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_edit',));
                                    }

                                    // admin_minsal_siaps_mntatenareamodestab_delete
                                    if (preg_match('#^/admin/minsal/siaps/mntatenareamodestab/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntatenareamodestab_delete')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_delete',));
                                    }

                                    // admin_minsal_siaps_mntatenareamodestab_show
                                    if (preg_match('#^/admin/minsal/siaps/mntatenareamodestab/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntatenareamodestab_show')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::showAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_show',));
                                    }

                                    // admin_minsal_siaps_mntatenareamodestab_export
                                    if ($pathinfo === '/admin/minsal/siaps/mntatenareamodestab/export') {
                                        return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntAtenAreaModEstabAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.ambientes',  '_sonata_name' => 'admin_minsal_siaps_mntatenareamodestab_export',  '_route' => 'admin_minsal_siaps_mntatenareamodestab_export',);
                                    }

                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntmanualusuario')) {
                                // admin_minsal_siaps_mntmanualusuario_list
                                if ($pathinfo === '/admin/minsal/siaps/mntmanualusuario/list') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntManualUsuarioAdminController::listAction',  '_sonata_admin' => 'sonata.admin.manualusuario',  '_sonata_name' => 'admin_minsal_siaps_mntmanualusuario_list',  '_route' => 'admin_minsal_siaps_mntmanualusuario_list',);
                                }

                                // admin_minsal_siaps_mntmanualusuario_create
                                if ($pathinfo === '/admin/minsal/siaps/mntmanualusuario/create') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntManualUsuarioAdminController::createAction',  '_sonata_admin' => 'sonata.admin.manualusuario',  '_sonata_name' => 'admin_minsal_siaps_mntmanualusuario_create',  '_route' => 'admin_minsal_siaps_mntmanualusuario_create',);
                                }

                                // admin_minsal_siaps_mntmanualusuario_batch
                                if ($pathinfo === '/admin/minsal/siaps/mntmanualusuario/batch') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntManualUsuarioAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.manualusuario',  '_sonata_name' => 'admin_minsal_siaps_mntmanualusuario_batch',  '_route' => 'admin_minsal_siaps_mntmanualusuario_batch',);
                                }

                                // admin_minsal_siaps_mntmanualusuario_edit
                                if (preg_match('#^/admin/minsal/siaps/mntmanualusuario/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntmanualusuario_edit')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntManualUsuarioAdminController::editAction',  '_sonata_admin' => 'sonata.admin.manualusuario',  '_sonata_name' => 'admin_minsal_siaps_mntmanualusuario_edit',));
                                }

                                // admin_minsal_siaps_mntmanualusuario_show
                                if (preg_match('#^/admin/minsal/siaps/mntmanualusuario/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntmanualusuario_show')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntManualUsuarioAdminController::showAction',  '_sonata_admin' => 'sonata.admin.manualusuario',  '_sonata_name' => 'admin_minsal_siaps_mntmanualusuario_show',));
                                }

                                // admin_minsal_siaps_mntmanualusuario_export
                                if ($pathinfo === '/admin/minsal/siaps/mntmanualusuario/export') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntManualUsuarioAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.manualusuario',  '_sonata_name' => 'admin_minsal_siaps_mntmanualusuario_export',  '_route' => 'admin_minsal_siaps_mntmanualusuario_export',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntconexion')) {
                                // admin_minsal_siaps_mntconexion_list
                                if ($pathinfo === '/admin/minsal/siaps/mntconexion/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_list',  '_route' => 'admin_minsal_siaps_mntconexion_list',);
                                }

                                // admin_minsal_siaps_mntconexion_create
                                if ($pathinfo === '/admin/minsal/siaps/mntconexion/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_create',  '_route' => 'admin_minsal_siaps_mntconexion_create',);
                                }

                                // admin_minsal_siaps_mntconexion_batch
                                if ($pathinfo === '/admin/minsal/siaps/mntconexion/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_batch',  '_route' => 'admin_minsal_siaps_mntconexion_batch',);
                                }

                                // admin_minsal_siaps_mntconexion_edit
                                if (preg_match('#^/admin/minsal/siaps/mntconexion/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntconexion_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_edit',));
                                }

                                // admin_minsal_siaps_mntconexion_delete
                                if (preg_match('#^/admin/minsal/siaps/mntconexion/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntconexion_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_delete',));
                                }

                                // admin_minsal_siaps_mntconexion_show
                                if (preg_match('#^/admin/minsal/siaps/mntconexion/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntconexion_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_show',));
                                }

                                // admin_minsal_siaps_mntconexion_export
                                if ($pathinfo === '/admin/minsal/siaps/mntconexion/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.conexion',  '_sonata_name' => 'admin_minsal_siaps_mntconexion_export',  '_route' => 'admin_minsal_siaps_mntconexion_export',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntpaciente')) {
                                // admin_minsal_siaps_mntpaciente_list
                                if ($pathinfo === '/admin/minsal/siaps/mntpaciente/list') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::listAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_list',  '_route' => 'admin_minsal_siaps_mntpaciente_list',);
                                }

                                // admin_minsal_siaps_mntpaciente_create
                                if ($pathinfo === '/admin/minsal/siaps/mntpaciente/create') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::createAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_create',  '_route' => 'admin_minsal_siaps_mntpaciente_create',);
                                }

                                // admin_minsal_siaps_mntpaciente_batch
                                if ($pathinfo === '/admin/minsal/siaps/mntpaciente/batch') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_batch',  '_route' => 'admin_minsal_siaps_mntpaciente_batch',);
                                }

                                // admin_minsal_siaps_mntpaciente_edit
                                if (preg_match('#^/admin/minsal/siaps/mntpaciente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntpaciente_edit')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::editAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_edit',));
                                }

                                // admin_minsal_siaps_mntpaciente_delete
                                if (preg_match('#^/admin/minsal/siaps/mntpaciente/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntpaciente_delete')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_delete',));
                                }

                                // admin_minsal_siaps_mntpaciente_show
                                if (preg_match('#^/admin/minsal/siaps/mntpaciente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntpaciente_show')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::showAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_show',));
                                }

                                // admin_minsal_siaps_mntpaciente_export
                                if ($pathinfo === '/admin/minsal/siaps/mntpaciente/export') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_export',  '_route' => 'admin_minsal_siaps_mntpaciente_export',);
                                }

                                // admin_minsal_siaps_mntpaciente_view
                                if (preg_match('#^/admin/minsal/siaps/mntpaciente/(?P<id>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntpaciente_view')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::viewAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_view',));
                                }

                                // admin_minsal_siaps_mntpaciente_buscaremergencia
                                if ($pathinfo === '/admin/minsal/siaps/mntpaciente/consulta/emergencia') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::buscaremergenciaAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_buscaremergencia',  '_route' => 'admin_minsal_siaps_mntpaciente_buscaremergencia',);
                                }

                                // admin_minsal_siaps_mntpaciente_pacientecitas
                                if ($pathinfo === '/admin/minsal/siaps/mntpaciente/paciente/citas') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteAdminController::pacientecitasAction',  '_sonata_admin' => 'sonata.admin.mntpaciente',  '_sonata_name' => 'admin_minsal_siaps_mntpaciente_pacientecitas',  '_route' => 'admin_minsal_siaps_mntpaciente_pacientecitas',);
                                }

                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sec')) {
                        if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secingreso')) {
                            // admin_minsal_seguimiento_secingreso_list
                            if ($pathinfo === '/admin/minsal/seguimiento/secingreso/list') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::listAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_list',  '_route' => 'admin_minsal_seguimiento_secingreso_list',);
                            }

                            // admin_minsal_seguimiento_secingreso_create
                            if ($pathinfo === '/admin/minsal/seguimiento/secingreso/create/id_paciente') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::createAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_create',  '_route' => 'admin_minsal_seguimiento_secingreso_create',);
                            }

                            // admin_minsal_seguimiento_secingreso_batch
                            if ($pathinfo === '/admin/minsal/seguimiento/secingreso/batch') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_batch',  '_route' => 'admin_minsal_seguimiento_secingreso_batch',);
                            }

                            // admin_minsal_seguimiento_secingreso_edit
                            if (preg_match('#^/admin/minsal/seguimiento/secingreso/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secingreso_edit')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::editAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_edit',));
                            }

                            // admin_minsal_seguimiento_secingreso_delete
                            if (preg_match('#^/admin/minsal/seguimiento/secingreso/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secingreso_delete')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_delete',));
                            }

                            // admin_minsal_seguimiento_secingreso_show
                            if (preg_match('#^/admin/minsal/seguimiento/secingreso/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secingreso_show')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::showAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_show',));
                            }

                            // admin_minsal_seguimiento_secingreso_export
                            if ($pathinfo === '/admin/minsal/seguimiento/secingreso/export') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_export',  '_route' => 'admin_minsal_seguimiento_secingreso_export',);
                            }

                            // admin_minsal_seguimiento_secingreso_resumen
                            if (rtrim($pathinfo, '/') === '/admin/minsal/seguimiento/secingreso/resumen') {
                                if (substr($pathinfo, -1) !== '/') {
                                    return $this->redirect($pathinfo.'/', 'admin_minsal_seguimiento_secingreso_resumen');
                                }

                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecIngresoAdminController::resumenAction',  '_sonata_admin' => 'sonata.admin.secingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secingreso_resumen',  '_route' => 'admin_minsal_seguimiento_secingreso_resumen',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secemergencia')) {
                            // admin_minsal_seguimiento_secemergencia_list
                            if ($pathinfo === '/admin/minsal/seguimiento/secemergencia/list') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaAdminController::listAction',  '_sonata_admin' => 'sonata.admin.secemergencia',  '_sonata_name' => 'admin_minsal_seguimiento_secemergencia_list',  '_route' => 'admin_minsal_seguimiento_secemergencia_list',);
                            }

                            // admin_minsal_seguimiento_secemergencia_batch
                            if ($pathinfo === '/admin/minsal/seguimiento/secemergencia/batch') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.secemergencia',  '_sonata_name' => 'admin_minsal_seguimiento_secemergencia_batch',  '_route' => 'admin_minsal_seguimiento_secemergencia_batch',);
                            }

                            // admin_minsal_seguimiento_secemergencia_show
                            if (preg_match('#^/admin/minsal/seguimiento/secemergencia/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secemergencia_show')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaAdminController::showAction',  '_sonata_admin' => 'sonata.admin.secemergencia',  '_sonata_name' => 'admin_minsal_seguimiento_secemergencia_show',));
                            }

                            // admin_minsal_seguimiento_secemergencia_export
                            if ($pathinfo === '/admin/minsal/seguimiento/secemergencia/export') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.secemergencia',  '_sonata_name' => 'admin_minsal_seguimiento_secemergencia_export',  '_route' => 'admin_minsal_seguimiento_secemergencia_export',);
                            }

                            // admin_minsal_seguimiento_secemergencia_resumen_emergencia
                            if ($pathinfo === '/admin/minsal/seguimiento/secemergencia/resumen/emergencia') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecEmergenciaAdminController::resumenEmergenciaAction',  '_sonata_admin' => 'sonata.admin.secemergencia',  '_sonata_name' => 'admin_minsal_seguimiento_secemergencia_resumen_emergencia',  '_route' => 'admin_minsal_seguimiento_secemergencia_resumen_emergencia',);
                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntexpediente')) {
                        // admin_minsal_siaps_mntexpediente_list
                        if ($pathinfo === '/admin/minsal/siaps/mntexpediente/list') {
                            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::listAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_list',  '_route' => 'admin_minsal_siaps_mntexpediente_list',);
                        }

                        // admin_minsal_siaps_mntexpediente_create
                        if ($pathinfo === '/admin/minsal/siaps/mntexpediente/create') {
                            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::createAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_create',  '_route' => 'admin_minsal_siaps_mntexpediente_create',);
                        }

                        // admin_minsal_siaps_mntexpediente_batch
                        if ($pathinfo === '/admin/minsal/siaps/mntexpediente/batch') {
                            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_batch',  '_route' => 'admin_minsal_siaps_mntexpediente_batch',);
                        }

                        // admin_minsal_siaps_mntexpediente_edit
                        if (preg_match('#^/admin/minsal/siaps/mntexpediente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntexpediente_edit')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::editAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_edit',));
                        }

                        // admin_minsal_siaps_mntexpediente_show
                        if (preg_match('#^/admin/minsal/siaps/mntexpediente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntexpediente_show')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::showAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_show',));
                        }

                        // admin_minsal_siaps_mntexpediente_export
                        if ($pathinfo === '/admin/minsal/siaps/mntexpediente/export') {
                            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_export',  '_route' => 'admin_minsal_siaps_mntexpediente_export',);
                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntexpediente/listarexpedientes')) {
                            // admin_minsal_siaps_mntexpediente_listarexpedientes
                            if ($pathinfo === '/admin/minsal/siaps/mntexpediente/listarexpedientes') {
                                return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::listarexpedientesAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_listarexpedientes',  '_route' => 'admin_minsal_siaps_mntexpediente_listarexpedientes',);
                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntexpediente/listarexpedientes/por')) {
                                // admin_minsal_siaps_mntexpediente_listarexpedientes_por_anio
                                if ($pathinfo === '/admin/minsal/siaps/mntexpediente/listarexpedientes/por/anio') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::listarexpedientesPorAnioAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_listarexpedientes_por_anio',  '_route' => 'admin_minsal_siaps_mntexpediente_listarexpedientes_por_anio',);
                                }

                                // admin_minsal_siaps_mntexpediente_listarexpedientes_por_correlativo
                                if ($pathinfo === '/admin/minsal/siaps/mntexpediente/listarexpedientes/por/correlativo') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::listarexpedientesPorCorrelativoAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_listarexpedientes_por_correlativo',  '_route' => 'admin_minsal_siaps_mntexpediente_listarexpedientes_por_correlativo',);
                                }

                            }

                        }

                        // admin_minsal_siaps_mntexpediente_depuracion
                        if ($pathinfo === '/admin/minsal/siaps/mntexpediente/depuracion/expediente/fisico') {
                            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::depuracionAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_depuracion',  '_route' => 'admin_minsal_siaps_mntexpediente_depuracion',);
                        }

                        // admin_minsal_siaps_mntexpediente_reporte_depuracion
                        if ($pathinfo === '/admin/minsal/siaps/mntexpediente/reporte/depuracion/expediente/fisico') {
                            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntExpedienteAdminController::reporteDepuracionAction',  '_sonata_admin' => 'sonata.admin.expediente',  '_sonata_name' => 'admin_minsal_siaps_mntexpediente_reporte_depuracion',  '_route' => 'admin_minsal_siaps_mntexpediente_reporte_depuracion',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secprocedenciaingreso')) {
                        // admin_minsal_seguimiento_secprocedenciaingreso_list
                        if ($pathinfo === '/admin/minsal/seguimiento/secprocedenciaingreso/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.reporte.ingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secprocedenciaingreso_list',  '_route' => 'admin_minsal_seguimiento_secprocedenciaingreso_list',);
                        }

                        // admin_minsal_seguimiento_secprocedenciaingreso_batch
                        if ($pathinfo === '/admin/minsal/seguimiento/secprocedenciaingreso/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.reporte.ingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secprocedenciaingreso_batch',  '_route' => 'admin_minsal_seguimiento_secprocedenciaingreso_batch',);
                        }

                        // admin_minsal_seguimiento_secprocedenciaingreso_show
                        if (preg_match('#^/admin/minsal/seguimiento/secprocedenciaingreso/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secprocedenciaingreso_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.reporte.ingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secprocedenciaingreso_show',));
                        }

                        // admin_minsal_seguimiento_secprocedenciaingreso_export
                        if ($pathinfo === '/admin/minsal/seguimiento/secprocedenciaingreso/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.reporte.ingreso',  '_sonata_name' => 'admin_minsal_seguimiento_secprocedenciaingreso_export',  '_route' => 'admin_minsal_seguimiento_secprocedenciaingreso_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntci')) {
                        if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntcie10')) {
                            // admin_minsal_siaps_mntcie10_list
                            if ($pathinfo === '/admin/minsal/siaps/mntcie10/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.cie10',  '_sonata_name' => 'admin_minsal_siaps_mntcie10_list',  '_route' => 'admin_minsal_siaps_mntcie10_list',);
                            }

                            // admin_minsal_siaps_mntcie10_batch
                            if ($pathinfo === '/admin/minsal/siaps/mntcie10/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.cie10',  '_sonata_name' => 'admin_minsal_siaps_mntcie10_batch',  '_route' => 'admin_minsal_siaps_mntcie10_batch',);
                            }

                            // admin_minsal_siaps_mntcie10_show
                            if (preg_match('#^/admin/minsal/siaps/mntcie10/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntcie10_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.cie10',  '_sonata_name' => 'admin_minsal_siaps_mntcie10_show',));
                            }

                            // admin_minsal_siaps_mntcie10_export
                            if ($pathinfo === '/admin/minsal/siaps/mntcie10/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.cie10',  '_sonata_name' => 'admin_minsal_siaps_mntcie10_export',  '_route' => 'admin_minsal_siaps_mntcie10_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntciq')) {
                            // admin_minsal_siaps_mntciq_list
                            if ($pathinfo === '/admin/minsal/siaps/mntciq/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.ciq',  '_sonata_name' => 'admin_minsal_siaps_mntciq_list',  '_route' => 'admin_minsal_siaps_mntciq_list',);
                            }

                            // admin_minsal_siaps_mntciq_batch
                            if ($pathinfo === '/admin/minsal/siaps/mntciq/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.ciq',  '_sonata_name' => 'admin_minsal_siaps_mntciq_batch',  '_route' => 'admin_minsal_siaps_mntciq_batch',);
                            }

                            // admin_minsal_siaps_mntciq_show
                            if (preg_match('#^/admin/minsal/siaps/mntciq/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntciq_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.ciq',  '_sonata_name' => 'admin_minsal_siaps_mntciq_show',));
                            }

                            // admin_minsal_siaps_mntciq_export
                            if ($pathinfo === '/admin/minsal/siaps/mntciq/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.ciq',  '_sonata_name' => 'admin_minsal_siaps_mntciq_export',  '_route' => 'admin_minsal_siaps_mntciq_export',);
                            }

                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/sonata/user')) {
                    if (0 === strpos($pathinfo, '/admin/sonata/user/user')) {
                        // admin_sonata_user_user_list
                        if ($pathinfo === '/admin/sonata/user/user/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_list',  '_route' => 'admin_sonata_user_user_list',);
                        }

                        // admin_sonata_user_user_create
                        if ($pathinfo === '/admin/sonata/user/user/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_create',  '_route' => 'admin_sonata_user_user_create',);
                        }

                        // admin_sonata_user_user_batch
                        if ($pathinfo === '/admin/sonata/user/user/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_batch',  '_route' => 'admin_sonata_user_user_batch',);
                        }

                        // admin_sonata_user_user_edit
                        if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_edit',));
                        }

                        // admin_sonata_user_user_delete
                        if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_delete',));
                        }

                        // admin_sonata_user_user_show
                        if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_show',));
                        }

                        // admin_sonata_user_user_export
                        if ($pathinfo === '/admin/sonata/user/user/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_export',  '_route' => 'admin_sonata_user_user_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sonata/user/group')) {
                        // admin_sonata_user_group_list
                        if ($pathinfo === '/admin/sonata/user/group/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_list',  '_route' => 'admin_sonata_user_group_list',);
                        }

                        // admin_sonata_user_group_create
                        if ($pathinfo === '/admin/sonata/user/group/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_create',  '_route' => 'admin_sonata_user_group_create',);
                        }

                        // admin_sonata_user_group_batch
                        if ($pathinfo === '/admin/sonata/user/group/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_batch',  '_route' => 'admin_sonata_user_group_batch',);
                        }

                        // admin_sonata_user_group_edit
                        if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_edit',));
                        }

                        // admin_sonata_user_group_delete
                        if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_delete',));
                        }

                        // admin_sonata_user_group_show
                        if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_show',));
                        }

                        // admin_sonata_user_group_export
                        if ($pathinfo === '/admin/sonata/user/group/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_export',  '_route' => 'admin_sonata_user_group_export',);
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/minsal/s')) {
                    if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntempleado')) {
                        // admin_minsal_siaps_mntempleado_list
                        if ($pathinfo === '/admin/minsal/siaps/mntempleado/list') {
                            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEmpleadoAdminController::listAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_list',  '_route' => 'admin_minsal_siaps_mntempleado_list',);
                        }

                        // admin_minsal_siaps_mntempleado_create
                        if ($pathinfo === '/admin/minsal/siaps/mntempleado/create') {
                            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEmpleadoAdminController::createAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_create',  '_route' => 'admin_minsal_siaps_mntempleado_create',);
                        }

                        // admin_minsal_siaps_mntempleado_batch
                        if ($pathinfo === '/admin/minsal/siaps/mntempleado/batch') {
                            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEmpleadoAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_batch',  '_route' => 'admin_minsal_siaps_mntempleado_batch',);
                        }

                        // admin_minsal_siaps_mntempleado_edit
                        if (preg_match('#^/admin/minsal/siaps/mntempleado/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntempleado_edit')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEmpleadoAdminController::editAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_edit',));
                        }

                        // admin_minsal_siaps_mntempleado_delete
                        if (preg_match('#^/admin/minsal/siaps/mntempleado/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntempleado_delete')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEmpleadoAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_delete',));
                        }

                        // admin_minsal_siaps_mntempleado_show
                        if (preg_match('#^/admin/minsal/siaps/mntempleado/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntempleado_show')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEmpleadoAdminController::showAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_show',));
                        }

                        // admin_minsal_siaps_mntempleado_export
                        if ($pathinfo === '/admin/minsal/siaps/mntempleado/export') {
                            return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEmpleadoAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.empleado',  '_sonata_name' => 'admin_minsal_siaps_mntempleado_export',  '_route' => 'admin_minsal_siaps_mntempleado_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sec')) {
                        if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sechistorial')) {
                            if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sechistorialclinico')) {
                                // admin_minsal_seguimiento_sechistorialclinico_list
                                if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/list') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::listAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_list',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_list',);
                                }

                                // admin_minsal_seguimiento_sechistorialclinico_create
                                if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/create') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::createAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_create',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_create',);
                                }

                                // admin_minsal_seguimiento_sechistorialclinico_batch
                                if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/batch') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_batch',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_batch',);
                                }

                                // admin_minsal_seguimiento_sechistorialclinico_edit
                                if (preg_match('#^/admin/minsal/seguimiento/sechistorialclinico/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistorialclinico_edit')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::editAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_edit',));
                                }

                                // admin_minsal_seguimiento_sechistorialclinico_delete
                                if (preg_match('#^/admin/minsal/seguimiento/sechistorialclinico/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistorialclinico_delete')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_delete',));
                                }

                                // admin_minsal_seguimiento_sechistorialclinico_show
                                if (preg_match('#^/admin/minsal/seguimiento/sechistorialclinico/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistorialclinico_show')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::showAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_show',));
                                }

                                // admin_minsal_seguimiento_sechistorialclinico_export
                                if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/export') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_export',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_export',);
                                }

                                // admin_minsal_seguimiento_sechistorialclinico_finalizar_consulta
                                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sechistorialclinico/finalizar/consulta') && preg_match('#^/admin/minsal/seguimiento/sechistorialclinico/finalizar/consulta/(?P<idHistorialClinico>[^/]++)$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistorialclinico_finalizar_consulta')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::finalizarConsultaAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_finalizar_consulta',));
                                }

                                // admin_minsal_seguimiento_sechistorialclinico_seguimiento_consulta
                                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sechistorialclinico/seguimiento/consulta') && preg_match('#^/admin/minsal/seguimiento/sechistorialclinico/seguimiento/consulta/(?P<idHistorialClinico>[^/]++)$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistorialclinico_seguimiento_consulta')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::seguimientoConsultaAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_seguimiento_consulta',));
                                }

                                // admin_minsal_seguimiento_sechistorialclinico_cerrar_consulta
                                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sechistorialclinico/cerrar/consulta') && preg_match('#^/admin/minsal/seguimiento/sechistorialclinico/cerrar/consulta/(?P<idHistorialClinico>[^/]++)$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistorialclinico_cerrar_consulta')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::cerrarConsultaAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_cerrar_consulta',));
                                }

                                // admin_minsal_seguimiento_sechistorialclinico_historias_clinicas_pre_show
                                if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/historiasclinicas/preshow') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::historiasClinicasPreShowAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_historias_clinicas_pre_show',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_historias_clinicas_pre_show',);
                                }

                                // admin_minsal_seguimiento_sechistorialclinico_imprimir_historia_clinica
                                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sechistorialclinico/imprimir/historia/clinica') && preg_match('#^/admin/minsal/seguimiento/sechistorialclinico/imprimir/historia/clinica/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistorialclinico_imprimir_historia_clinica')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::imprimirHistoriaClinicaAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_imprimir_historia_clinica',));
                                }

                                // admin_minsal_seguimiento_sechistorialclinico_change_status_form
                                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sechistorialclinico/change/status/form') && preg_match('#^/admin/minsal/seguimiento/sechistorialclinico/change/status/form/(?P<id>[^/]++)/(?P<status>[^/]++)$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistorialclinico_change_status_form')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::changeStatusFormAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_change_status_form',));
                                }

                                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sechistorialclinico/re')) {
                                    // admin_minsal_seguimiento_sechistorialclinico_remove_form
                                    if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sechistorialclinico/remove/form') && preg_match('#^/admin/minsal/seguimiento/sechistorialclinico/remove/form/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistorialclinico_remove_form')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::removeFormAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_remove_form',));
                                    }

                                    // admin_minsal_seguimiento_sechistorialclinico_retroactive
                                    if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/retroactive/consulta') {
                                        return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::retroactiveAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_retroactive',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_retroactive',);
                                    }

                                }

                                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sechistorialclinico/detalle')) {
                                    // admin_minsal_seguimiento_sechistorialclinico_pacientes_atendidos
                                    if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/detalle/pacientes/atendidos') {
                                        return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::pacientesAtendidosAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_pacientes_atendidos',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_pacientes_atendidos',);
                                    }

                                    // admin_minsal_seguimiento_sechistorialclinico_historias_clinicas_medicos
                                    if ($pathinfo === '/admin/minsal/seguimiento/sechistorialclinico/detalle/historias/clinicas/medicos') {
                                        return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecHistorialClinicoAdminController::historiasClinicasMedicosAction',  '_sonata_admin' => 'sonata.admin.sechistorialclinico',  '_sonata_name' => 'admin_minsal_seguimiento_sechistorialclinico_historias_clinicas_medicos',  '_route' => 'admin_minsal_seguimiento_sechistorialclinico_historias_clinicas_medicos',);
                                    }

                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sechistoriallugar')) {
                                // admin_minsal_seguimiento_sechistoriallugar_list
                                if ($pathinfo === '/admin/minsal/seguimiento/sechistoriallugar/list') {
                                    return array (  '_controller' => 'MinsalSeguimientoBundle:SecHistorialLugarAdmin:list',  '_sonata_admin' => 'sonata.admin.sechistoriallugar',  '_sonata_name' => 'admin_minsal_seguimiento_sechistoriallugar_list',  '_route' => 'admin_minsal_seguimiento_sechistoriallugar_list',);
                                }

                                // admin_minsal_seguimiento_sechistoriallugar_create
                                if ($pathinfo === '/admin/minsal/seguimiento/sechistoriallugar/create') {
                                    return array (  '_controller' => 'MinsalSeguimientoBundle:SecHistorialLugarAdmin:create',  '_sonata_admin' => 'sonata.admin.sechistoriallugar',  '_sonata_name' => 'admin_minsal_seguimiento_sechistoriallugar_create',  '_route' => 'admin_minsal_seguimiento_sechistoriallugar_create',);
                                }

                                // admin_minsal_seguimiento_sechistoriallugar_batch
                                if ($pathinfo === '/admin/minsal/seguimiento/sechistoriallugar/batch') {
                                    return array (  '_controller' => 'MinsalSeguimientoBundle:SecHistorialLugarAdmin:batch',  '_sonata_admin' => 'sonata.admin.sechistoriallugar',  '_sonata_name' => 'admin_minsal_seguimiento_sechistoriallugar_batch',  '_route' => 'admin_minsal_seguimiento_sechistoriallugar_batch',);
                                }

                                // admin_minsal_seguimiento_sechistoriallugar_edit
                                if (preg_match('#^/admin/minsal/seguimiento/sechistoriallugar/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistoriallugar_edit')), array (  '_controller' => 'MinsalSeguimientoBundle:SecHistorialLugarAdmin:edit',  '_sonata_admin' => 'sonata.admin.sechistoriallugar',  '_sonata_name' => 'admin_minsal_seguimiento_sechistoriallugar_edit',));
                                }

                                // admin_minsal_seguimiento_sechistoriallugar_delete
                                if (preg_match('#^/admin/minsal/seguimiento/sechistoriallugar/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistoriallugar_delete')), array (  '_controller' => 'MinsalSeguimientoBundle:SecHistorialLugarAdmin:delete',  '_sonata_admin' => 'sonata.admin.sechistoriallugar',  '_sonata_name' => 'admin_minsal_seguimiento_sechistoriallugar_delete',));
                                }

                                // admin_minsal_seguimiento_sechistoriallugar_show
                                if (preg_match('#^/admin/minsal/seguimiento/sechistoriallugar/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_sechistoriallugar_show')), array (  '_controller' => 'MinsalSeguimientoBundle:SecHistorialLugarAdmin:show',  '_sonata_admin' => 'sonata.admin.sechistoriallugar',  '_sonata_name' => 'admin_minsal_seguimiento_sechistoriallugar_show',));
                                }

                                // admin_minsal_seguimiento_sechistoriallugar_export
                                if ($pathinfo === '/admin/minsal/seguimiento/sechistoriallugar/export') {
                                    return array (  '_controller' => 'MinsalSeguimientoBundle:SecHistorialLugarAdmin:export',  '_sonata_admin' => 'sonata.admin.sechistoriallugar',  '_sonata_name' => 'admin_minsal_seguimiento_sechistoriallugar_export',  '_route' => 'admin_minsal_seguimiento_sechistoriallugar_export',);
                                }

                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secmotivoconsulta')) {
                            // admin_minsal_seguimiento_secmotivoconsulta_list
                            if ($pathinfo === '/admin/minsal/seguimiento/secmotivoconsulta/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.admin.secmotivoconsulta',  '_sonata_name' => 'admin_minsal_seguimiento_secmotivoconsulta_list',  '_route' => 'admin_minsal_seguimiento_secmotivoconsulta_list',);
                            }

                            // admin_minsal_seguimiento_secmotivoconsulta_create
                            if ($pathinfo === '/admin/minsal/seguimiento/secmotivoconsulta/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.admin.secmotivoconsulta',  '_sonata_name' => 'admin_minsal_seguimiento_secmotivoconsulta_create',  '_route' => 'admin_minsal_seguimiento_secmotivoconsulta_create',);
                            }

                            // admin_minsal_seguimiento_secmotivoconsulta_batch
                            if ($pathinfo === '/admin/minsal/seguimiento/secmotivoconsulta/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.admin.secmotivoconsulta',  '_sonata_name' => 'admin_minsal_seguimiento_secmotivoconsulta_batch',  '_route' => 'admin_minsal_seguimiento_secmotivoconsulta_batch',);
                            }

                            // admin_minsal_seguimiento_secmotivoconsulta_edit
                            if (preg_match('#^/admin/minsal/seguimiento/secmotivoconsulta/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secmotivoconsulta_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.admin.secmotivoconsulta',  '_sonata_name' => 'admin_minsal_seguimiento_secmotivoconsulta_edit',));
                            }

                            // admin_minsal_seguimiento_secmotivoconsulta_delete
                            if (preg_match('#^/admin/minsal/seguimiento/secmotivoconsulta/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secmotivoconsulta_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.admin.secmotivoconsulta',  '_sonata_name' => 'admin_minsal_seguimiento_secmotivoconsulta_delete',));
                            }

                            // admin_minsal_seguimiento_secmotivoconsulta_show
                            if (preg_match('#^/admin/minsal/seguimiento/secmotivoconsulta/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secmotivoconsulta_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.admin.secmotivoconsulta',  '_sonata_name' => 'admin_minsal_seguimiento_secmotivoconsulta_show',));
                            }

                            // admin_minsal_seguimiento_secmotivoconsulta_export
                            if ($pathinfo === '/admin/minsal/seguimiento/secmotivoconsulta/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.admin.secmotivoconsulta',  '_sonata_name' => 'admin_minsal_seguimiento_secmotivoconsulta_export',  '_route' => 'admin_minsal_seguimiento_secmotivoconsulta_export',);
                            }

                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/application/core')) {
                    if (0 === strpos($pathinfo, '/admin/application/core/frmformulario')) {
                        // admin_application_core_frmformulario_list
                        if ($pathinfo === '/admin/application/core/frmformulario/list') {
                            return array (  '_controller' => 'Application\\CoreBundle\\Controller\\FrmFormularioAdminController::listAction',  '_sonata_admin' => 'sonata.admin.frmformulario',  '_sonata_name' => 'admin_application_core_frmformulario_list',  '_route' => 'admin_application_core_frmformulario_list',);
                        }

                        // admin_application_core_frmformulario_create
                        if ($pathinfo === '/admin/application/core/frmformulario/create') {
                            return array (  '_controller' => 'Application\\CoreBundle\\Controller\\FrmFormularioAdminController::createAction',  '_sonata_admin' => 'sonata.admin.frmformulario',  '_sonata_name' => 'admin_application_core_frmformulario_create',  '_route' => 'admin_application_core_frmformulario_create',);
                        }

                        // admin_application_core_frmformulario_batch
                        if ($pathinfo === '/admin/application/core/frmformulario/batch') {
                            return array (  '_controller' => 'Application\\CoreBundle\\Controller\\FrmFormularioAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.frmformulario',  '_sonata_name' => 'admin_application_core_frmformulario_batch',  '_route' => 'admin_application_core_frmformulario_batch',);
                        }

                        // admin_application_core_frmformulario_edit
                        if (preg_match('#^/admin/application/core/frmformulario/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_core_frmformulario_edit')), array (  '_controller' => 'Application\\CoreBundle\\Controller\\FrmFormularioAdminController::editAction',  '_sonata_admin' => 'sonata.admin.frmformulario',  '_sonata_name' => 'admin_application_core_frmformulario_edit',));
                        }

                        // admin_application_core_frmformulario_delete
                        if (preg_match('#^/admin/application/core/frmformulario/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_core_frmformulario_delete')), array (  '_controller' => 'Application\\CoreBundle\\Controller\\FrmFormularioAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.frmformulario',  '_sonata_name' => 'admin_application_core_frmformulario_delete',));
                        }

                        // admin_application_core_frmformulario_show
                        if (preg_match('#^/admin/application/core/frmformulario/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_core_frmformulario_show')), array (  '_controller' => 'Application\\CoreBundle\\Controller\\FrmFormularioAdminController::showAction',  '_sonata_admin' => 'sonata.admin.frmformulario',  '_sonata_name' => 'admin_application_core_frmformulario_show',));
                        }

                        // admin_application_core_frmformulario_export
                        if ($pathinfo === '/admin/application/core/frmformulario/export') {
                            return array (  '_controller' => 'Application\\CoreBundle\\Controller\\FrmFormularioAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.frmformulario',  '_sonata_name' => 'admin_application_core_frmformulario_export',  '_route' => 'admin_application_core_frmformulario_export',);
                        }

                        // admin_application_core_frmformulario_generateformtest
                        if (preg_match('#^/admin/application/core/frmformulario/(?P<id>[^/]++)/generateformtest$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_core_frmformulario_generateformtest')), array (  '_controller' => 'Application\\CoreBundle\\Controller\\FrmFormularioAdminController::generateformtestAction',  '_sonata_admin' => 'sonata.admin.frmformulario',  '_sonata_name' => 'admin_application_core_frmformulario_generateformtest',));
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/application/core/mntusertour')) {
                        // admin_application_core_mntusertour_list
                        if ($pathinfo === '/admin/application/core/mntusertour/list') {
                            return array (  '_controller' => 'Application\\CoreBundle\\Controller\\MntUserTourAdminController::listAction',  '_sonata_admin' => 'sonata.admin.mntusertour',  '_sonata_name' => 'admin_application_core_mntusertour_list',  '_route' => 'admin_application_core_mntusertour_list',);
                        }

                        // admin_application_core_mntusertour_create
                        if ($pathinfo === '/admin/application/core/mntusertour/create') {
                            return array (  '_controller' => 'Application\\CoreBundle\\Controller\\MntUserTourAdminController::createAction',  '_sonata_admin' => 'sonata.admin.mntusertour',  '_sonata_name' => 'admin_application_core_mntusertour_create',  '_route' => 'admin_application_core_mntusertour_create',);
                        }

                        // admin_application_core_mntusertour_batch
                        if ($pathinfo === '/admin/application/core/mntusertour/batch') {
                            return array (  '_controller' => 'Application\\CoreBundle\\Controller\\MntUserTourAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.mntusertour',  '_sonata_name' => 'admin_application_core_mntusertour_batch',  '_route' => 'admin_application_core_mntusertour_batch',);
                        }

                        // admin_application_core_mntusertour_edit
                        if (preg_match('#^/admin/application/core/mntusertour/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_core_mntusertour_edit')), array (  '_controller' => 'Application\\CoreBundle\\Controller\\MntUserTourAdminController::editAction',  '_sonata_admin' => 'sonata.admin.mntusertour',  '_sonata_name' => 'admin_application_core_mntusertour_edit',));
                        }

                        // admin_application_core_mntusertour_delete
                        if (preg_match('#^/admin/application/core/mntusertour/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_core_mntusertour_delete')), array (  '_controller' => 'Application\\CoreBundle\\Controller\\MntUserTourAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.mntusertour',  '_sonata_name' => 'admin_application_core_mntusertour_delete',));
                        }

                        // admin_application_core_mntusertour_show
                        if (preg_match('#^/admin/application/core/mntusertour/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_application_core_mntusertour_show')), array (  '_controller' => 'Application\\CoreBundle\\Controller\\MntUserTourAdminController::showAction',  '_sonata_admin' => 'sonata.admin.mntusertour',  '_sonata_name' => 'admin_application_core_mntusertour_show',));
                        }

                        // admin_application_core_mntusertour_export
                        if ($pathinfo === '/admin/application/core/mntusertour/export') {
                            return array (  '_controller' => 'Application\\CoreBundle\\Controller\\MntUserTourAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.mntusertour',  '_sonata_name' => 'admin_application_core_mntusertour_export',  '_route' => 'admin_application_core_mntusertour_export',);
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/minsal')) {
                    if (0 === strpos($pathinfo, '/admin/minsal/seguimiento')) {
                        if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secantecedentes')) {
                            // admin_minsal_seguimiento_secantecedentes_list
                            if ($pathinfo === '/admin/minsal/seguimiento/secantecedentes/list') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecAntecedentesAdminController::listAction',  '_sonata_admin' => 'sonata.admin.secantecedentes',  '_sonata_name' => 'admin_minsal_seguimiento_secantecedentes_list',  '_route' => 'admin_minsal_seguimiento_secantecedentes_list',);
                            }

                            // admin_minsal_seguimiento_secantecedentes_create
                            if ($pathinfo === '/admin/minsal/seguimiento/secantecedentes/create') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecAntecedentesAdminController::createAction',  '_sonata_admin' => 'sonata.admin.secantecedentes',  '_sonata_name' => 'admin_minsal_seguimiento_secantecedentes_create',  '_route' => 'admin_minsal_seguimiento_secantecedentes_create',);
                            }

                            // admin_minsal_seguimiento_secantecedentes_batch
                            if ($pathinfo === '/admin/minsal/seguimiento/secantecedentes/batch') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecAntecedentesAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.secantecedentes',  '_sonata_name' => 'admin_minsal_seguimiento_secantecedentes_batch',  '_route' => 'admin_minsal_seguimiento_secantecedentes_batch',);
                            }

                            // admin_minsal_seguimiento_secantecedentes_edit
                            if (preg_match('#^/admin/minsal/seguimiento/secantecedentes/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secantecedentes_edit')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecAntecedentesAdminController::editAction',  '_sonata_admin' => 'sonata.admin.secantecedentes',  '_sonata_name' => 'admin_minsal_seguimiento_secantecedentes_edit',));
                            }

                            // admin_minsal_seguimiento_secantecedentes_delete
                            if (preg_match('#^/admin/minsal/seguimiento/secantecedentes/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secantecedentes_delete')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecAntecedentesAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.secantecedentes',  '_sonata_name' => 'admin_minsal_seguimiento_secantecedentes_delete',));
                            }

                            // admin_minsal_seguimiento_secantecedentes_show
                            if (preg_match('#^/admin/minsal/seguimiento/secantecedentes/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secantecedentes_show')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecAntecedentesAdminController::showAction',  '_sonata_admin' => 'sonata.admin.secantecedentes',  '_sonata_name' => 'admin_minsal_seguimiento_secantecedentes_show',));
                            }

                            // admin_minsal_seguimiento_secantecedentes_export
                            if ($pathinfo === '/admin/minsal/seguimiento/secantecedentes/export') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecAntecedentesAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.secantecedentes',  '_sonata_name' => 'admin_minsal_seguimiento_secantecedentes_export',  '_route' => 'admin_minsal_seguimiento_secantecedentes_export',);
                            }

                            // admin_minsal_seguimiento_secantecedentes_showespe
                            if (preg_match('#^/admin/minsal/seguimiento/secantecedentes/(?P<id>[^/]++)/(?P<idatenareamodestab>[^/]++)/showespe$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secantecedentes_showespe')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecAntecedentesAdminController::showespeAction',  '_sonata_admin' => 'sonata.admin.secantecedentes',  '_sonata_name' => 'admin_minsal_seguimiento_secantecedentes_showespe',));
                            }

                            // admin_minsal_seguimiento_secantecedentes_editespe
                            if (preg_match('#^/admin/minsal/seguimiento/secantecedentes/(?P<id>[^/]++)/(?P<idatenareamodestab>[^/]++)/editespe$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secantecedentes_editespe')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecAntecedentesAdminController::editespeAction',  '_sonata_admin' => 'sonata.admin.secantecedentes',  '_sonata_name' => 'admin_minsal_seguimiento_secantecedentes_editespe',));
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/tars')) {
                            if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/tarsolicitudfvih')) {
                                // admin_minsal_seguimiento_tarsolicitudfvih_list
                                if ($pathinfo === '/admin/minsal/seguimiento/tarsolicitudfvih/list') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSolicitudFvihAdminController::listAction',  '_sonata_admin' => 'sonata.admin.tarsolicitudfvih',  '_sonata_name' => 'admin_minsal_seguimiento_tarsolicitudfvih_list',  '_route' => 'admin_minsal_seguimiento_tarsolicitudfvih_list',);
                                }

                                // admin_minsal_seguimiento_tarsolicitudfvih_create
                                if ($pathinfo === '/admin/minsal/seguimiento/tarsolicitudfvih/create') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSolicitudFvihAdminController::createAction',  '_sonata_admin' => 'sonata.admin.tarsolicitudfvih',  '_sonata_name' => 'admin_minsal_seguimiento_tarsolicitudfvih_create',  '_route' => 'admin_minsal_seguimiento_tarsolicitudfvih_create',);
                                }

                                // admin_minsal_seguimiento_tarsolicitudfvih_batch
                                if ($pathinfo === '/admin/minsal/seguimiento/tarsolicitudfvih/batch') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSolicitudFvihAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.tarsolicitudfvih',  '_sonata_name' => 'admin_minsal_seguimiento_tarsolicitudfvih_batch',  '_route' => 'admin_minsal_seguimiento_tarsolicitudfvih_batch',);
                                }

                                // admin_minsal_seguimiento_tarsolicitudfvih_edit
                                if (preg_match('#^/admin/minsal/seguimiento/tarsolicitudfvih/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_tarsolicitudfvih_edit')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSolicitudFvihAdminController::editAction',  '_sonata_admin' => 'sonata.admin.tarsolicitudfvih',  '_sonata_name' => 'admin_minsal_seguimiento_tarsolicitudfvih_edit',));
                                }

                                // admin_minsal_seguimiento_tarsolicitudfvih_delete
                                if (preg_match('#^/admin/minsal/seguimiento/tarsolicitudfvih/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_tarsolicitudfvih_delete')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSolicitudFvihAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.tarsolicitudfvih',  '_sonata_name' => 'admin_minsal_seguimiento_tarsolicitudfvih_delete',));
                                }

                                // admin_minsal_seguimiento_tarsolicitudfvih_show
                                if (preg_match('#^/admin/minsal/seguimiento/tarsolicitudfvih/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_tarsolicitudfvih_show')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSolicitudFvihAdminController::showAction',  '_sonata_admin' => 'sonata.admin.tarsolicitudfvih',  '_sonata_name' => 'admin_minsal_seguimiento_tarsolicitudfvih_show',));
                                }

                                // admin_minsal_seguimiento_tarsolicitudfvih_export
                                if ($pathinfo === '/admin/minsal/seguimiento/tarsolicitudfvih/export') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSolicitudFvihAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.tarsolicitudfvih',  '_sonata_name' => 'admin_minsal_seguimiento_tarsolicitudfvih_export',  '_route' => 'admin_minsal_seguimiento_tarsolicitudfvih_export',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/tarsectar')) {
                                // admin_minsal_seguimiento_tarsectar_list
                                if ($pathinfo === '/admin/minsal/seguimiento/tarsectar/list') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSecTarAdminController::listAction',  '_sonata_admin' => 'sonata.admin.tarsectar',  '_sonata_name' => 'admin_minsal_seguimiento_tarsectar_list',  '_route' => 'admin_minsal_seguimiento_tarsectar_list',);
                                }

                                // admin_minsal_seguimiento_tarsectar_create
                                if ($pathinfo === '/admin/minsal/seguimiento/tarsectar/create') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSecTarAdminController::createAction',  '_sonata_admin' => 'sonata.admin.tarsectar',  '_sonata_name' => 'admin_minsal_seguimiento_tarsectar_create',  '_route' => 'admin_minsal_seguimiento_tarsectar_create',);
                                }

                                // admin_minsal_seguimiento_tarsectar_batch
                                if ($pathinfo === '/admin/minsal/seguimiento/tarsectar/batch') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSecTarAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.tarsectar',  '_sonata_name' => 'admin_minsal_seguimiento_tarsectar_batch',  '_route' => 'admin_minsal_seguimiento_tarsectar_batch',);
                                }

                                // admin_minsal_seguimiento_tarsectar_edit
                                if (preg_match('#^/admin/minsal/seguimiento/tarsectar/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_tarsectar_edit')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSecTarAdminController::editAction',  '_sonata_admin' => 'sonata.admin.tarsectar',  '_sonata_name' => 'admin_minsal_seguimiento_tarsectar_edit',));
                                }

                                // admin_minsal_seguimiento_tarsectar_delete
                                if (preg_match('#^/admin/minsal/seguimiento/tarsectar/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_tarsectar_delete')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSecTarAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.tarsectar',  '_sonata_name' => 'admin_minsal_seguimiento_tarsectar_delete',));
                                }

                                // admin_minsal_seguimiento_tarsectar_show
                                if (preg_match('#^/admin/minsal/seguimiento/tarsectar/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_tarsectar_show')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSecTarAdminController::showAction',  '_sonata_admin' => 'sonata.admin.tarsectar',  '_sonata_name' => 'admin_minsal_seguimiento_tarsectar_show',));
                                }

                                // admin_minsal_seguimiento_tarsectar_export
                                if ($pathinfo === '/admin/minsal/seguimiento/tarsectar/export') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSecTarAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.tarsectar',  '_sonata_name' => 'admin_minsal_seguimiento_tarsectar_export',  '_route' => 'admin_minsal_seguimiento_tarsectar_export',);
                                }

                                // admin_minsal_seguimiento_tarsectar_createespe
                                if (preg_match('#^/admin/minsal/seguimiento/tarsectar/(?P<idhistoria>[^/]++)/createespe$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_tarsectar_createespe')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\TarSecTarAdminController::createespeAction',  '_sonata_admin' => 'sonata.admin.tarsectar',  '_sonata_name' => 'admin_minsal_seguimiento_tarsectar_createespe',));
                                }

                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secremisionpaciente')) {
                            // admin_minsal_seguimiento_secremisionpaciente_list
                            if ($pathinfo === '/admin/minsal/seguimiento/secremisionpaciente/list') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecRemisionPacienteAdminController::listAction',  '_sonata_admin' => 'sonata.admin.secremisionpaciente',  '_sonata_name' => 'admin_minsal_seguimiento_secremisionpaciente_list',  '_route' => 'admin_minsal_seguimiento_secremisionpaciente_list',);
                            }

                            // admin_minsal_seguimiento_secremisionpaciente_create
                            if ($pathinfo === '/admin/minsal/seguimiento/secremisionpaciente/create') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecRemisionPacienteAdminController::createAction',  '_sonata_admin' => 'sonata.admin.secremisionpaciente',  '_sonata_name' => 'admin_minsal_seguimiento_secremisionpaciente_create',  '_route' => 'admin_minsal_seguimiento_secremisionpaciente_create',);
                            }

                            // admin_minsal_seguimiento_secremisionpaciente_batch
                            if ($pathinfo === '/admin/minsal/seguimiento/secremisionpaciente/batch') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecRemisionPacienteAdminController::batchAction',  '_sonata_admin' => 'sonata.admin.secremisionpaciente',  '_sonata_name' => 'admin_minsal_seguimiento_secremisionpaciente_batch',  '_route' => 'admin_minsal_seguimiento_secremisionpaciente_batch',);
                            }

                            // admin_minsal_seguimiento_secremisionpaciente_edit
                            if (preg_match('#^/admin/minsal/seguimiento/secremisionpaciente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secremisionpaciente_edit')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecRemisionPacienteAdminController::editAction',  '_sonata_admin' => 'sonata.admin.secremisionpaciente',  '_sonata_name' => 'admin_minsal_seguimiento_secremisionpaciente_edit',));
                            }

                            // admin_minsal_seguimiento_secremisionpaciente_delete
                            if (preg_match('#^/admin/minsal/seguimiento/secremisionpaciente/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secremisionpaciente_delete')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecRemisionPacienteAdminController::deleteAction',  '_sonata_admin' => 'sonata.admin.secremisionpaciente',  '_sonata_name' => 'admin_minsal_seguimiento_secremisionpaciente_delete',));
                            }

                            // admin_minsal_seguimiento_secremisionpaciente_show
                            if (preg_match('#^/admin/minsal/seguimiento/secremisionpaciente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secremisionpaciente_show')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecRemisionPacienteAdminController::showAction',  '_sonata_admin' => 'sonata.admin.secremisionpaciente',  '_sonata_name' => 'admin_minsal_seguimiento_secremisionpaciente_show',));
                            }

                            // admin_minsal_seguimiento_secremisionpaciente_export
                            if ($pathinfo === '/admin/minsal/seguimiento/secremisionpaciente/export') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecRemisionPacienteAdminController::exportAction',  '_sonata_admin' => 'sonata.admin.secremisionpaciente',  '_sonata_name' => 'admin_minsal_seguimiento_secremisionpaciente_export',  '_route' => 'admin_minsal_seguimiento_secremisionpaciente_export',);
                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secremisionpaciente/create')) {
                                // admin_minsal_seguimiento_secremisionpaciente_createespe
                                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secremisionpaciente/createespe') && preg_match('#^/admin/minsal/seguimiento/secremisionpaciente/createespe/(?P<idhistoria>[^/]++)/(?P<idespe>[^/]++)/(?P<idestable>[^/]++)$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secremisionpaciente_createespe')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecRemisionPacienteAdminController::createespeAction',  '_sonata_admin' => 'sonata.admin.secremisionpaciente',  '_sonata_name' => 'admin_minsal_seguimiento_secremisionpaciente_createespe',));
                                }

                                // admin_minsal_seguimiento_secremisionpaciente_createsolo
                                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secremisionpaciente/createsolo') && preg_match('#^/admin/minsal/seguimiento/secremisionpaciente/createsolo/(?P<idhistoria>[^/]++)/(?P<estadoEnviar>[^/]++)/(?P<idespe>[^/]++)/(?P<idestable>[^/]++)$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secremisionpaciente_createsolo')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecRemisionPacienteAdminController::createsoloAction',  '_sonata_admin' => 'sonata.admin.secremisionpaciente',  '_sonata_name' => 'admin_minsal_seguimiento_secremisionpaciente_createsolo',));
                                }

                            }

                            // admin_minsal_seguimiento_secremisionpaciente_referencia_reporte
                            if ($pathinfo === '/admin/minsal/seguimiento/secremisionpaciente/referencia_reporte') {
                                return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecRemisionPacienteAdminController::referenciaReporteAction',  '_sonata_admin' => 'sonata.admin.secremisionpaciente',  '_sonata_name' => 'admin_minsal_seguimiento_secremisionpaciente_referencia_reporte',  '_route' => 'admin_minsal_seguimiento_secremisionpaciente_referencia_reporte',);
                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/minsal/farmacia/farm')) {
                        if (0 === strpos($pathinfo, '/admin/minsal/farmacia/farmrecetas')) {
                            // admin_minsal_farmacia_farmrecetas_list
                            if ($pathinfo === '/admin/minsal/farmacia/farmrecetas/list') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasAdminController::listAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_recetas',  '_sonata_name' => 'admin_minsal_farmacia_farmrecetas_list',  '_route' => 'admin_minsal_farmacia_farmrecetas_list',);
                            }

                            // admin_minsal_farmacia_farmrecetas_create
                            if ($pathinfo === '/admin/minsal/farmacia/farmrecetas/create') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasAdminController::createAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_recetas',  '_sonata_name' => 'admin_minsal_farmacia_farmrecetas_create',  '_route' => 'admin_minsal_farmacia_farmrecetas_create',);
                            }

                            // admin_minsal_farmacia_farmrecetas_batch
                            if ($pathinfo === '/admin/minsal/farmacia/farmrecetas/batch') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasAdminController::batchAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_recetas',  '_sonata_name' => 'admin_minsal_farmacia_farmrecetas_batch',  '_route' => 'admin_minsal_farmacia_farmrecetas_batch',);
                            }

                            // admin_minsal_farmacia_farmrecetas_edit
                            if (preg_match('#^/admin/minsal/farmacia/farmrecetas/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_farmacia_farmrecetas_edit')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasAdminController::editAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_recetas',  '_sonata_name' => 'admin_minsal_farmacia_farmrecetas_edit',));
                            }

                            // admin_minsal_farmacia_farmrecetas_delete
                            if (preg_match('#^/admin/minsal/farmacia/farmrecetas/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_farmacia_farmrecetas_delete')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasAdminController::deleteAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_recetas',  '_sonata_name' => 'admin_minsal_farmacia_farmrecetas_delete',));
                            }

                            // admin_minsal_farmacia_farmrecetas_show
                            if (preg_match('#^/admin/minsal/farmacia/farmrecetas/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_farmacia_farmrecetas_show')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasAdminController::showAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_recetas',  '_sonata_name' => 'admin_minsal_farmacia_farmrecetas_show',));
                            }

                            // admin_minsal_farmacia_farmrecetas_export
                            if ($pathinfo === '/admin/minsal/farmacia/farmrecetas/export') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasAdminController::exportAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_recetas',  '_sonata_name' => 'admin_minsal_farmacia_farmrecetas_export',  '_route' => 'admin_minsal_farmacia_farmrecetas_export',);
                            }

                            // admin_minsal_farmacia_farmrecetas_assign_receta
                            if ($pathinfo === '/admin/minsal/farmacia/farmrecetas/assign_receta') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasAdminController::assignRecetaAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_recetas',  '_sonata_name' => 'admin_minsal_farmacia_farmrecetas_assign_receta',  '_route' => 'admin_minsal_farmacia_farmrecetas_assign_receta',);
                            }

                            // admin_minsal_farmacia_farmrecetas_imprimir_receta
                            if ($pathinfo === '/admin/minsal/farmacia/farmrecetas/imprimir_receta') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasAdminController::imprimirRecetaAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_recetas',  '_sonata_name' => 'admin_minsal_farmacia_farmrecetas_imprimir_receta',  '_route' => 'admin_minsal_farmacia_farmrecetas_imprimir_receta',);
                            }

                            // admin_minsal_farmacia_farmrecetas_complement
                            if ($pathinfo === '/admin/minsal/farmacia/farmrecetas/repetitiva/complement') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmRecetasAdminController::complementAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_recetas',  '_sonata_name' => 'admin_minsal_farmacia_farmrecetas_complement',  '_route' => 'admin_minsal_farmacia_farmrecetas_complement',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/farmacia/farmmedicinarecetada')) {
                            // admin_minsal_farmacia_farmmedicinarecetada_list
                            if ($pathinfo === '/admin/minsal/farmacia/farmmedicinarecetada/list') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmMedicinarecetadaAdminController::listAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_medicinarecetada',  '_sonata_name' => 'admin_minsal_farmacia_farmmedicinarecetada_list',  '_route' => 'admin_minsal_farmacia_farmmedicinarecetada_list',);
                            }

                            // admin_minsal_farmacia_farmmedicinarecetada_create
                            if ($pathinfo === '/admin/minsal/farmacia/farmmedicinarecetada/create') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmMedicinarecetadaAdminController::createAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_medicinarecetada',  '_sonata_name' => 'admin_minsal_farmacia_farmmedicinarecetada_create',  '_route' => 'admin_minsal_farmacia_farmmedicinarecetada_create',);
                            }

                            // admin_minsal_farmacia_farmmedicinarecetada_batch
                            if ($pathinfo === '/admin/minsal/farmacia/farmmedicinarecetada/batch') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmMedicinarecetadaAdminController::batchAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_medicinarecetada',  '_sonata_name' => 'admin_minsal_farmacia_farmmedicinarecetada_batch',  '_route' => 'admin_minsal_farmacia_farmmedicinarecetada_batch',);
                            }

                            // admin_minsal_farmacia_farmmedicinarecetada_edit
                            if (preg_match('#^/admin/minsal/farmacia/farmmedicinarecetada/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_farmacia_farmmedicinarecetada_edit')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmMedicinarecetadaAdminController::editAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_medicinarecetada',  '_sonata_name' => 'admin_minsal_farmacia_farmmedicinarecetada_edit',));
                            }

                            // admin_minsal_farmacia_farmmedicinarecetada_delete
                            if (preg_match('#^/admin/minsal/farmacia/farmmedicinarecetada/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_farmacia_farmmedicinarecetada_delete')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmMedicinarecetadaAdminController::deleteAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_medicinarecetada',  '_sonata_name' => 'admin_minsal_farmacia_farmmedicinarecetada_delete',));
                            }

                            // admin_minsal_farmacia_farmmedicinarecetada_show
                            if (preg_match('#^/admin/minsal/farmacia/farmmedicinarecetada/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_farmacia_farmmedicinarecetada_show')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmMedicinarecetadaAdminController::showAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_medicinarecetada',  '_sonata_name' => 'admin_minsal_farmacia_farmmedicinarecetada_show',));
                            }

                            // admin_minsal_farmacia_farmmedicinarecetada_export
                            if ($pathinfo === '/admin/minsal/farmacia/farmmedicinarecetada/export') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmMedicinarecetadaAdminController::exportAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_medicinarecetada',  '_sonata_name' => 'admin_minsal_farmacia_farmmedicinarecetada_export',  '_route' => 'admin_minsal_farmacia_farmmedicinarecetada_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/farmacia/farmestados')) {
                            // admin_minsal_farmacia_farmestados_list
                            if ($pathinfo === '/admin/minsal/farmacia/farmestados/list') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmEstadosAdminController::listAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_estados',  '_sonata_name' => 'admin_minsal_farmacia_farmestados_list',  '_route' => 'admin_minsal_farmacia_farmestados_list',);
                            }

                            // admin_minsal_farmacia_farmestados_batch
                            if ($pathinfo === '/admin/minsal/farmacia/farmestados/batch') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmEstadosAdminController::batchAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_estados',  '_sonata_name' => 'admin_minsal_farmacia_farmestados_batch',  '_route' => 'admin_minsal_farmacia_farmestados_batch',);
                            }

                            // admin_minsal_farmacia_farmestados_show
                            if (preg_match('#^/admin/minsal/farmacia/farmestados/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_farmacia_farmestados_show')), array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmEstadosAdminController::showAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_estados',  '_sonata_name' => 'admin_minsal_farmacia_farmestados_show',));
                            }

                            // admin_minsal_farmacia_farmestados_export
                            if ($pathinfo === '/admin/minsal/farmacia/farmestados/export') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmEstadosAdminController::exportAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_estados',  '_sonata_name' => 'admin_minsal_farmacia_farmestados_export',  '_route' => 'admin_minsal_farmacia_farmestados_export',);
                            }

                            // admin_minsal_farmacia_farmestados_listar_pacientes_aptos
                            if ($pathinfo === '/admin/minsal/farmacia/farmestados/listar/pacientes/aptos') {
                                return array (  '_controller' => 'Minsal\\FarmaciaBundle\\Controller\\FarmEstadosAdminController::listarPacientesAptosAction',  '_sonata_admin' => 'minsal_farmacia.admin.farm_estados',  '_sonata_name' => 'admin_minsal_farmacia_farmestados_listar_pacientes_aptos',  '_route' => 'admin_minsal_farmacia_farmestados_listar_pacientes_aptos',);
                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/minsal/s')) {
                        if (0 === strpos($pathinfo, '/admin/minsal/siaps/mnt')) {
                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntpacientereferido')) {
                                // admin_minsal_siaps_mntpacientereferido_list
                                if ($pathinfo === '/admin/minsal/siaps/mntpacientereferido/list') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteReferidoAdminController::listAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_paciente_referido',  '_sonata_name' => 'admin_minsal_siaps_mntpacientereferido_list',  '_route' => 'admin_minsal_siaps_mntpacientereferido_list',);
                                }

                                // admin_minsal_siaps_mntpacientereferido_batch
                                if ($pathinfo === '/admin/minsal/siaps/mntpacientereferido/batch') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteReferidoAdminController::batchAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_paciente_referido',  '_sonata_name' => 'admin_minsal_siaps_mntpacientereferido_batch',  '_route' => 'admin_minsal_siaps_mntpacientereferido_batch',);
                                }

                                // admin_minsal_siaps_mntpacientereferido_show
                                if (preg_match('#^/admin/minsal/siaps/mntpacientereferido/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntpacientereferido_show')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteReferidoAdminController::showAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_paciente_referido',  '_sonata_name' => 'admin_minsal_siaps_mntpacientereferido_show',));
                                }

                                // admin_minsal_siaps_mntpacientereferido_mostrar
                                if ($pathinfo === '/admin/minsal/siaps/mntpacientereferido/mostrar') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteReferidoAdminController::mostrarAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_paciente_referido',  '_sonata_name' => 'admin_minsal_siaps_mntpacientereferido_mostrar',  '_route' => 'admin_minsal_siaps_mntpacientereferido_mostrar',);
                                }

                                // admin_minsal_siaps_mntpacientereferido_buscar_paciente_siap
                                if ($pathinfo === '/admin/minsal/siaps/mntpacientereferido/buscar_paciente_siap') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntPacienteReferidoAdminController::buscarPacienteSiapAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_paciente_referido',  '_sonata_name' => 'admin_minsal_siaps_mntpacientereferido_buscar_paciente_siap',  '_route' => 'admin_minsal_siaps_mntpacientereferido_buscar_paciente_siap',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntconsultorio')) {
                                // admin_minsal_siaps_mntconsultorio_list
                                if ($pathinfo === '/admin/minsal/siaps/mntconsultorio/list') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntConsultorioAdminController::listAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_consultorio',  '_sonata_name' => 'admin_minsal_siaps_mntconsultorio_list',  '_route' => 'admin_minsal_siaps_mntconsultorio_list',);
                                }

                                // admin_minsal_siaps_mntconsultorio_create
                                if ($pathinfo === '/admin/minsal/siaps/mntconsultorio/create') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntConsultorioAdminController::createAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_consultorio',  '_sonata_name' => 'admin_minsal_siaps_mntconsultorio_create',  '_route' => 'admin_minsal_siaps_mntconsultorio_create',);
                                }

                                // admin_minsal_siaps_mntconsultorio_batch
                                if ($pathinfo === '/admin/minsal/siaps/mntconsultorio/batch') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntConsultorioAdminController::batchAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_consultorio',  '_sonata_name' => 'admin_minsal_siaps_mntconsultorio_batch',  '_route' => 'admin_minsal_siaps_mntconsultorio_batch',);
                                }

                                // admin_minsal_siaps_mntconsultorio_edit
                                if (preg_match('#^/admin/minsal/siaps/mntconsultorio/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntconsultorio_edit')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntConsultorioAdminController::editAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_consultorio',  '_sonata_name' => 'admin_minsal_siaps_mntconsultorio_edit',));
                                }

                                // admin_minsal_siaps_mntconsultorio_export
                                if ($pathinfo === '/admin/minsal/siaps/mntconsultorio/export') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntConsultorioAdminController::exportAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_consultorio',  '_sonata_name' => 'admin_minsal_siaps_mntconsultorio_export',  '_route' => 'admin_minsal_siaps_mntconsultorio_export',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntrangohora')) {
                                // admin_minsal_siaps_mntrangohora_list
                                if ($pathinfo === '/admin/minsal/siaps/mntrangohora/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_rangohora',  '_sonata_name' => 'admin_minsal_siaps_mntrangohora_list',  '_route' => 'admin_minsal_siaps_mntrangohora_list',);
                                }

                                // admin_minsal_siaps_mntrangohora_create
                                if ($pathinfo === '/admin/minsal/siaps/mntrangohora/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_rangohora',  '_sonata_name' => 'admin_minsal_siaps_mntrangohora_create',  '_route' => 'admin_minsal_siaps_mntrangohora_create',);
                                }

                                // admin_minsal_siaps_mntrangohora_batch
                                if ($pathinfo === '/admin/minsal/siaps/mntrangohora/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_rangohora',  '_sonata_name' => 'admin_minsal_siaps_mntrangohora_batch',  '_route' => 'admin_minsal_siaps_mntrangohora_batch',);
                                }

                                // admin_minsal_siaps_mntrangohora_edit
                                if (preg_match('#^/admin/minsal/siaps/mntrangohora/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntrangohora_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_rangohora',  '_sonata_name' => 'admin_minsal_siaps_mntrangohora_edit',));
                                }

                                // admin_minsal_siaps_mntrangohora_show
                                if (preg_match('#^/admin/minsal/siaps/mntrangohora/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntrangohora_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_rangohora',  '_sonata_name' => 'admin_minsal_siaps_mntrangohora_show',));
                                }

                                // admin_minsal_siaps_mntrangohora_export
                                if ($pathinfo === '/admin/minsal/siaps/mntrangohora/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_rangohora',  '_sonata_name' => 'admin_minsal_siaps_mntrangohora_export',  '_route' => 'admin_minsal_siaps_mntrangohora_export',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntprocedimientoestablecimiento')) {
                                // admin_minsal_siaps_mntprocedimientoestablecimiento_list
                                if ($pathinfo === '/admin/minsal/siaps/mntprocedimientoestablecimiento/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_procedimiento_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_list',  '_route' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_list',);
                                }

                                // admin_minsal_siaps_mntprocedimientoestablecimiento_create
                                if ($pathinfo === '/admin/minsal/siaps/mntprocedimientoestablecimiento/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_procedimiento_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_create',  '_route' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_create',);
                                }

                                // admin_minsal_siaps_mntprocedimientoestablecimiento_batch
                                if ($pathinfo === '/admin/minsal/siaps/mntprocedimientoestablecimiento/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_procedimiento_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_batch',  '_route' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_batch',);
                                }

                                // admin_minsal_siaps_mntprocedimientoestablecimiento_edit
                                if (preg_match('#^/admin/minsal/siaps/mntprocedimientoestablecimiento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_procedimiento_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_edit',));
                                }

                                // admin_minsal_siaps_mntprocedimientoestablecimiento_delete
                                if (preg_match('#^/admin/minsal/siaps/mntprocedimientoestablecimiento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_procedimiento_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_delete',));
                                }

                                // admin_minsal_siaps_mntprocedimientoestablecimiento_show
                                if (preg_match('#^/admin/minsal/siaps/mntprocedimientoestablecimiento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_procedimiento_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_show',));
                                }

                                // admin_minsal_siaps_mntprocedimientoestablecimiento_export
                                if ($pathinfo === '/admin/minsal/siaps/mntprocedimientoestablecimiento/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_procedimiento_establecimiento',  '_sonata_name' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_export',  '_route' => 'admin_minsal_siaps_mntprocedimientoestablecimiento_export',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mnttipoevento')) {
                                // admin_minsal_siaps_mnttipoevento_list
                                if ($pathinfo === '/admin/minsal/siaps/mnttipoevento/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_tipo_evento',  '_sonata_name' => 'admin_minsal_siaps_mnttipoevento_list',  '_route' => 'admin_minsal_siaps_mnttipoevento_list',);
                                }

                                // admin_minsal_siaps_mnttipoevento_create
                                if ($pathinfo === '/admin/minsal/siaps/mnttipoevento/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_tipo_evento',  '_sonata_name' => 'admin_minsal_siaps_mnttipoevento_create',  '_route' => 'admin_minsal_siaps_mnttipoevento_create',);
                                }

                                // admin_minsal_siaps_mnttipoevento_batch
                                if ($pathinfo === '/admin/minsal/siaps/mnttipoevento/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_tipo_evento',  '_sonata_name' => 'admin_minsal_siaps_mnttipoevento_batch',  '_route' => 'admin_minsal_siaps_mnttipoevento_batch',);
                                }

                                // admin_minsal_siaps_mnttipoevento_edit
                                if (preg_match('#^/admin/minsal/siaps/mnttipoevento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mnttipoevento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_tipo_evento',  '_sonata_name' => 'admin_minsal_siaps_mnttipoevento_edit',));
                                }

                                // admin_minsal_siaps_mnttipoevento_delete
                                if (preg_match('#^/admin/minsal/siaps/mnttipoevento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mnttipoevento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_tipo_evento',  '_sonata_name' => 'admin_minsal_siaps_mnttipoevento_delete',));
                                }

                                // admin_minsal_siaps_mnttipoevento_show
                                if (preg_match('#^/admin/minsal/siaps/mnttipoevento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mnttipoevento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_tipo_evento',  '_sonata_name' => 'admin_minsal_siaps_mnttipoevento_show',));
                                }

                                // admin_minsal_siaps_mnttipoevento_export
                                if ($pathinfo === '/admin/minsal/siaps/mnttipoevento/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_tipo_evento',  '_sonata_name' => 'admin_minsal_siaps_mnttipoevento_export',  '_route' => 'admin_minsal_siaps_mnttipoevento_export',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/siaps/mntevento')) {
                                // admin_minsal_siaps_mntevento_list
                                if ($pathinfo === '/admin/minsal/siaps/mntevento/list') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEventoAdminController::listAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_evento',  '_sonata_name' => 'admin_minsal_siaps_mntevento_list',  '_route' => 'admin_minsal_siaps_mntevento_list',);
                                }

                                // admin_minsal_siaps_mntevento_create
                                if ($pathinfo === '/admin/minsal/siaps/mntevento/create') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEventoAdminController::createAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_evento',  '_sonata_name' => 'admin_minsal_siaps_mntevento_create',  '_route' => 'admin_minsal_siaps_mntevento_create',);
                                }

                                // admin_minsal_siaps_mntevento_batch
                                if ($pathinfo === '/admin/minsal/siaps/mntevento/batch') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEventoAdminController::batchAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_evento',  '_sonata_name' => 'admin_minsal_siaps_mntevento_batch',  '_route' => 'admin_minsal_siaps_mntevento_batch',);
                                }

                                // admin_minsal_siaps_mntevento_edit
                                if (preg_match('#^/admin/minsal/siaps/mntevento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntevento_edit')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEventoAdminController::editAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_evento',  '_sonata_name' => 'admin_minsal_siaps_mntevento_edit',));
                                }

                                // admin_minsal_siaps_mntevento_delete
                                if (preg_match('#^/admin/minsal/siaps/mntevento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntevento_delete')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEventoAdminController::deleteAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_evento',  '_sonata_name' => 'admin_minsal_siaps_mntevento_delete',));
                                }

                                // admin_minsal_siaps_mntevento_show
                                if (preg_match('#^/admin/minsal/siaps/mntevento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_siaps_mntevento_show')), array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEventoAdminController::showAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_evento',  '_sonata_name' => 'admin_minsal_siaps_mntevento_show',));
                                }

                                // admin_minsal_siaps_mntevento_export
                                if ($pathinfo === '/admin/minsal/siaps/mntevento/export') {
                                    return array (  '_controller' => 'Minsal\\SiapsBundle\\Controller\\MntEventoAdminController::exportAction',  '_sonata_admin' => 'minsal_siaps.admin.mnt_evento',  '_sonata_name' => 'admin_minsal_siaps_mntevento_export',  '_route' => 'admin_minsal_siaps_mntevento_export',);
                                }

                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/sec')) {
                            if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secdatoembarazo')) {
                                // admin_minsal_seguimiento_secdatoembarazo_list
                                if ($pathinfo === '/admin/minsal/seguimiento/secdatoembarazo/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_dato_embarazo',  '_sonata_name' => 'admin_minsal_seguimiento_secdatoembarazo_list',  '_route' => 'admin_minsal_seguimiento_secdatoembarazo_list',);
                                }

                                // admin_minsal_seguimiento_secdatoembarazo_create
                                if ($pathinfo === '/admin/minsal/seguimiento/secdatoembarazo/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_dato_embarazo',  '_sonata_name' => 'admin_minsal_seguimiento_secdatoembarazo_create',  '_route' => 'admin_minsal_seguimiento_secdatoembarazo_create',);
                                }

                                // admin_minsal_seguimiento_secdatoembarazo_batch
                                if ($pathinfo === '/admin/minsal/seguimiento/secdatoembarazo/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_dato_embarazo',  '_sonata_name' => 'admin_minsal_seguimiento_secdatoembarazo_batch',  '_route' => 'admin_minsal_seguimiento_secdatoembarazo_batch',);
                                }

                                // admin_minsal_seguimiento_secdatoembarazo_edit
                                if (preg_match('#^/admin/minsal/seguimiento/secdatoembarazo/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secdatoembarazo_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_dato_embarazo',  '_sonata_name' => 'admin_minsal_seguimiento_secdatoembarazo_edit',));
                                }

                                // admin_minsal_seguimiento_secdatoembarazo_delete
                                if (preg_match('#^/admin/minsal/seguimiento/secdatoembarazo/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secdatoembarazo_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_dato_embarazo',  '_sonata_name' => 'admin_minsal_seguimiento_secdatoembarazo_delete',));
                                }

                                // admin_minsal_seguimiento_secdatoembarazo_show
                                if (preg_match('#^/admin/minsal/seguimiento/secdatoembarazo/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secdatoembarazo_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_dato_embarazo',  '_sonata_name' => 'admin_minsal_seguimiento_secdatoembarazo_show',));
                                }

                                // admin_minsal_seguimiento_secdatoembarazo_export
                                if ($pathinfo === '/admin/minsal/seguimiento/secdatoembarazo/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_dato_embarazo',  '_sonata_name' => 'admin_minsal_seguimiento_secdatoembarazo_export',  '_route' => 'admin_minsal_seguimiento_secdatoembarazo_export',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secsolicitudquirurgica')) {
                                // admin_minsal_seguimiento_secsolicitudquirurgica_list
                                if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgica/list') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecSolicitudQuirurgicaAdminController::listAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgica_list',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgica_list',);
                                }

                                // admin_minsal_seguimiento_secsolicitudquirurgica_create
                                if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgica/create') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecSolicitudQuirurgicaAdminController::createAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgica_create',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgica_create',);
                                }

                                // admin_minsal_seguimiento_secsolicitudquirurgica_batch
                                if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgica/batch') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecSolicitudQuirurgicaAdminController::batchAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgica_batch',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgica_batch',);
                                }

                                // admin_minsal_seguimiento_secsolicitudquirurgica_edit
                                if (preg_match('#^/admin/minsal/seguimiento/secsolicitudquirurgica/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secsolicitudquirurgica_edit')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecSolicitudQuirurgicaAdminController::editAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgica_edit',));
                                }

                                // admin_minsal_seguimiento_secsolicitudquirurgica_delete
                                if (preg_match('#^/admin/minsal/seguimiento/secsolicitudquirurgica/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secsolicitudquirurgica_delete')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecSolicitudQuirurgicaAdminController::deleteAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgica_delete',));
                                }

                                // admin_minsal_seguimiento_secsolicitudquirurgica_show
                                if (preg_match('#^/admin/minsal/seguimiento/secsolicitudquirurgica/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secsolicitudquirurgica_show')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecSolicitudQuirurgicaAdminController::showAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgica_show',));
                                }

                                // admin_minsal_seguimiento_secsolicitudquirurgica_export
                                if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgica/export') {
                                    return array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\SecSolicitudQuirurgicaAdminController::exportAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgica_export',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgica_export',);
                                }

                                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secsolicitudquirurgicaaptitud')) {
                                    // admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_list
                                    if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgicaaptitud/list') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_aptitud',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_list',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_list',);
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_create
                                    if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgicaaptitud/create') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_aptitud',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_create',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_create',);
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_batch
                                    if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgicaaptitud/batch') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_aptitud',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_batch',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_batch',);
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_edit
                                    if (preg_match('#^/admin/minsal/seguimiento/secsolicitudquirurgicaaptitud/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_aptitud',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_edit',));
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_delete
                                    if (preg_match('#^/admin/minsal/seguimiento/secsolicitudquirurgicaaptitud/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_aptitud',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_delete',));
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_show
                                    if (preg_match('#^/admin/minsal/seguimiento/secsolicitudquirurgicaaptitud/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_aptitud',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_show',));
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_export
                                    if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgicaaptitud/export') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_aptitud',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_export',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaaptitud_export',);
                                    }

                                }

                                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secsolicitudquirurgicaprocedimiento')) {
                                    // admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_list
                                    if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgicaprocedimiento/list') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_procedimiento',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_list',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_list',);
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_create
                                    if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgicaprocedimiento/create') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_procedimiento',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_create',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_create',);
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_batch
                                    if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgicaprocedimiento/batch') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_procedimiento',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_batch',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_batch',);
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_edit
                                    if (preg_match('#^/admin/minsal/seguimiento/secsolicitudquirurgicaprocedimiento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_procedimiento',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_edit',));
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_delete
                                    if (preg_match('#^/admin/minsal/seguimiento/secsolicitudquirurgicaprocedimiento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_procedimiento',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_delete',));
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_show
                                    if (preg_match('#^/admin/minsal/seguimiento/secsolicitudquirurgicaprocedimiento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_procedimiento',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_show',));
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_export
                                    if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgicaprocedimiento/export') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_procedimiento',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_export',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicaprocedimiento_export',);
                                    }

                                }

                                if (0 === strpos($pathinfo, '/admin/minsal/seguimiento/secsolicitudquirurgicatipoanestesia')) {
                                    // admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_list
                                    if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgicatipoanestesia/list') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_tipo_anestesia',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_list',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_list',);
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_create
                                    if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgicatipoanestesia/create') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_tipo_anestesia',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_create',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_create',);
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_batch
                                    if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgicatipoanestesia/batch') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_tipo_anestesia',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_batch',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_batch',);
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_edit
                                    if (preg_match('#^/admin/minsal/seguimiento/secsolicitudquirurgicatipoanestesia/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_tipo_anestesia',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_edit',));
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_delete
                                    if (preg_match('#^/admin/minsal/seguimiento/secsolicitudquirurgicatipoanestesia/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_tipo_anestesia',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_delete',));
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_show
                                    if (preg_match('#^/admin/minsal/seguimiento/secsolicitudquirurgicatipoanestesia/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_tipo_anestesia',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_show',));
                                    }

                                    // admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_export
                                    if ($pathinfo === '/admin/minsal/seguimiento/secsolicitudquirurgicatipoanestesia/export') {
                                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_seguimiento.admin.sec_solicitud_quirurgica_tipo_anestesia',  '_sonata_name' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_export',  '_route' => 'admin_minsal_seguimiento_secsolicitudquirurgicatipoanestesia_export',);
                                    }

                                }

                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/minsal/citas/cit')) {
                        if (0 === strpos($pathinfo, '/admin/minsal/citas/citcitasdia')) {
                            // admin_minsal_citas_citcitasdia_list
                            if ($pathinfo === '/admin/minsal/citas/citcitasdia/list') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::listAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_list',  '_route' => 'admin_minsal_citas_citcitasdia_list',);
                            }

                            // admin_minsal_citas_citcitasdia_create
                            if ($pathinfo === '/admin/minsal/citas/citcitasdia/create') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::createAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_create',  '_route' => 'admin_minsal_citas_citcitasdia_create',);
                            }

                            // admin_minsal_citas_citcitasdia_edit
                            if (preg_match('#^/admin/minsal/citas/citcitasdia/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citcitasdia_edit')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::editAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_edit',));
                            }

                            // admin_minsal_citas_citcitasdia_show
                            if (preg_match('#^/admin/minsal/citas/citcitasdia/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citcitasdia_show')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::showAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_show',));
                            }

                            // admin_minsal_citas_citcitasdia_agenda_dia
                            if ($pathinfo === '/admin/minsal/citas/citcitasdia/agenda/dia') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::agendaDiaAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_agenda_dia',  '_route' => 'admin_minsal_citas_citcitasdia_agenda_dia',);
                            }

                            // admin_minsal_citas_citcitasdia_transfer
                            if ($pathinfo === '/admin/minsal/citas/citcitasdia/transfer') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::transferAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_transfer',  '_route' => 'admin_minsal_citas_citcitasdia_transfer',);
                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/citas/citcitasdia/c')) {
                                // admin_minsal_citas_citcitasdia_cseleccion
                                if ($pathinfo === '/admin/minsal/citas/citcitasdia/cseleccion') {
                                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::cseleccionAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_cseleccion',  '_route' => 'admin_minsal_citas_citcitasdia_cseleccion',);
                                }

                                // admin_minsal_citas_citcitasdia_citamedica_eliminar
                                if ($pathinfo === '/admin/minsal/citas/citcitasdia/citamedica/eliminar') {
                                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::citamedicaEliminarAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_citamedica_eliminar',  '_route' => 'admin_minsal_citas_citcitasdia_citamedica_eliminar',);
                                }

                            }

                            // admin_minsal_citas_citcitasdia_reprogramar
                            if ($pathinfo === '/admin/minsal/citas/citcitasdia/reprogramar') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::reprogramarAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_reprogramar',  '_route' => 'admin_minsal_citas_citcitasdia_reprogramar',);
                            }

                            // admin_minsal_citas_citcitasdia_citamedica_busqueda
                            if ($pathinfo === '/admin/minsal/citas/citcitasdia/citamedica/busqueda') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::citamedicaBusquedaAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_citamedica_busqueda',  '_route' => 'admin_minsal_citas_citcitasdia_citamedica_busqueda',);
                            }

                            // admin_minsal_citas_citcitasdia_asignar
                            if ($pathinfo === '/admin/minsal/citas/citcitasdia/asignar') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::asignarAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_asignar',  '_route' => 'admin_minsal_citas_citcitasdia_asignar',);
                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/citas/citcitasdia/cita')) {
                                // admin_minsal_citas_citcitasdia_cita_referencia
                                if ($pathinfo === '/admin/minsal/citas/citcitasdia/cita/referencia') {
                                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::citaReferenciaAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_cita_referencia',  '_route' => 'admin_minsal_citas_citcitasdia_cita_referencia',);
                                }

                                if (0 === strpos($pathinfo, '/admin/minsal/citas/citcitasdia/citamedica')) {
                                    // admin_minsal_citas_citcitasdia_citamedica_consulta
                                    if ($pathinfo === '/admin/minsal/citas/citcitasdia/citamedica/consulta') {
                                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::citamedicaConsultaAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_citamedica_consulta',  '_route' => 'admin_minsal_citas_citcitasdia_citamedica_consulta',);
                                    }

                                    // admin_minsal_citas_citcitasdia_citamedica_programadas
                                    if ($pathinfo === '/admin/minsal/citas/citcitasdia/citamedica/programadas') {
                                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::citamedicaProgramadasAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_citamedica_programadas',  '_route' => 'admin_minsal_citas_citcitasdia_citamedica_programadas',);
                                    }

                                    // admin_minsal_citas_citcitasdia_citamedica_fechaslibres
                                    if ($pathinfo === '/admin/minsal/citas/citcitasdia/citamedica/fechaslibres') {
                                        return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::citamedicaFechaslibresAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_citamedica_fechaslibres',  '_route' => 'admin_minsal_citas_citcitasdia_citamedica_fechaslibres',);
                                    }

                                    if (0 === strpos($pathinfo, '/admin/minsal/citas/citcitasdia/citamedica/e')) {
                                        // admin_minsal_citas_citcitasdia_citamedica_estadistica
                                        if ($pathinfo === '/admin/minsal/citas/citcitasdia/citamedica/estadistica') {
                                            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::citamedicaEstadisticaAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_citamedica_estadistica',  '_route' => 'admin_minsal_citas_citcitasdia_citamedica_estadistica',);
                                        }

                                        // admin_minsal_citas_citcitasdia_citamedica_eliminadas
                                        if ($pathinfo === '/admin/minsal/citas/citcitasdia/citamedica/eliminadas') {
                                            return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::citamedicaEliminadasAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_citamedica_eliminadas',  '_route' => 'admin_minsal_citas_citcitasdia_citamedica_eliminadas',);
                                        }

                                    }

                                }

                            }

                            // admin_minsal_citas_citcitasdia_reporte_produccion
                            if ($pathinfo === '/admin/minsal/citas/citcitasdia/reporte/produccion') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasDiaAdminController::reporteProduccionAction',  '_sonata_admin' => 'sonata.admin.citcitasdia',  '_sonata_name' => 'admin_minsal_citas_citcitasdia_reporte_produccion',  '_route' => 'admin_minsal_citas_citcitasdia_reporte_produccion',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/citas/cittipodistribucion')) {
                            // admin_minsal_citas_cittipodistribucion_list
                            if ($pathinfo === '/admin/minsal/citas/cittipodistribucion/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_citas.admin.cit_tipo_distribucion',  '_sonata_name' => 'admin_minsal_citas_cittipodistribucion_list',  '_route' => 'admin_minsal_citas_cittipodistribucion_list',);
                            }

                            // admin_minsal_citas_cittipodistribucion_create
                            if ($pathinfo === '/admin/minsal/citas/cittipodistribucion/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_citas.admin.cit_tipo_distribucion',  '_sonata_name' => 'admin_minsal_citas_cittipodistribucion_create',  '_route' => 'admin_minsal_citas_cittipodistribucion_create',);
                            }

                            // admin_minsal_citas_cittipodistribucion_batch
                            if ($pathinfo === '/admin/minsal/citas/cittipodistribucion/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_citas.admin.cit_tipo_distribucion',  '_sonata_name' => 'admin_minsal_citas_cittipodistribucion_batch',  '_route' => 'admin_minsal_citas_cittipodistribucion_batch',);
                            }

                            // admin_minsal_citas_cittipodistribucion_edit
                            if (preg_match('#^/admin/minsal/citas/cittipodistribucion/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_cittipodistribucion_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_citas.admin.cit_tipo_distribucion',  '_sonata_name' => 'admin_minsal_citas_cittipodistribucion_edit',));
                            }

                            // admin_minsal_citas_cittipodistribucion_export
                            if ($pathinfo === '/admin/minsal/citas/cittipodistribucion/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_citas.admin.cit_tipo_distribucion',  '_sonata_name' => 'admin_minsal_citas_cittipodistribucion_export',  '_route' => 'admin_minsal_citas_cittipodistribucion_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/citas/citdistribucion')) {
                            // admin_minsal_citas_citdistribucion_list
                            if ($pathinfo === '/admin/minsal/citas/citdistribucion/list') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionAdminController::listAction',  '_sonata_admin' => 'minsal_citas.admin.cit_distribucion',  '_sonata_name' => 'admin_minsal_citas_citdistribucion_list',  '_route' => 'admin_minsal_citas_citdistribucion_list',);
                            }

                            // admin_minsal_citas_citdistribucion_create
                            if ($pathinfo === '/admin/minsal/citas/citdistribucion/create') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionAdminController::createAction',  '_sonata_admin' => 'minsal_citas.admin.cit_distribucion',  '_sonata_name' => 'admin_minsal_citas_citdistribucion_create',  '_route' => 'admin_minsal_citas_citdistribucion_create',);
                            }

                            // admin_minsal_citas_citdistribucion_edit
                            if ($pathinfo === '/admin/minsal/citas/citdistribucion/edit') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionAdminController::editAction',  '_sonata_admin' => 'minsal_citas.admin.cit_distribucion',  '_sonata_name' => 'admin_minsal_citas_citdistribucion_edit',  '_route' => 'admin_minsal_citas_citdistribucion_edit',);
                            }

                            // admin_minsal_citas_citdistribucion_delete
                            if (preg_match('#^/admin/minsal/citas/citdistribucion/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citdistribucion_delete')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionAdminController::deleteAction',  '_sonata_admin' => 'minsal_citas.admin.cit_distribucion',  '_sonata_name' => 'admin_minsal_citas_citdistribucion_delete',));
                            }

                            // admin_minsal_citas_citdistribucion_show
                            if (preg_match('#^/admin/minsal/citas/citdistribucion/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citdistribucion_show')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionAdminController::showAction',  '_sonata_admin' => 'minsal_citas.admin.cit_distribucion',  '_sonata_name' => 'admin_minsal_citas_citdistribucion_show',));
                            }

                            // admin_minsal_citas_citdistribucion_activar
                            if (preg_match('#^/admin/minsal/citas/citdistribucion/(?P<id>[^/]++)/activar$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citdistribucion_activar')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionAdminController::activarAction',  '_sonata_admin' => 'minsal_citas.admin.cit_distribucion',  '_sonata_name' => 'admin_minsal_citas_citdistribucion_activar',));
                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/citas/citdistribucionprocedimiento')) {
                                // admin_minsal_citas_citdistribucionprocedimiento_list
                                if ($pathinfo === '/admin/minsal/citas/citdistribucionprocedimiento/list') {
                                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionProcedimientoAdminController::listAction',  '_sonata_admin' => 'minsal_citas.admin.cit_distribucion_procedimiento',  '_sonata_name' => 'admin_minsal_citas_citdistribucionprocedimiento_list',  '_route' => 'admin_minsal_citas_citdistribucionprocedimiento_list',);
                                }

                                // admin_minsal_citas_citdistribucionprocedimiento_create
                                if ($pathinfo === '/admin/minsal/citas/citdistribucionprocedimiento/create') {
                                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionProcedimientoAdminController::createAction',  '_sonata_admin' => 'minsal_citas.admin.cit_distribucion_procedimiento',  '_sonata_name' => 'admin_minsal_citas_citdistribucionprocedimiento_create',  '_route' => 'admin_minsal_citas_citdistribucionprocedimiento_create',);
                                }

                                // admin_minsal_citas_citdistribucionprocedimiento_edit
                                if ($pathinfo === '/admin/minsal/citas/citdistribucionprocedimiento/edit') {
                                    return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionProcedimientoAdminController::editAction',  '_sonata_admin' => 'minsal_citas.admin.cit_distribucion_procedimiento',  '_sonata_name' => 'admin_minsal_citas_citdistribucionprocedimiento_edit',  '_route' => 'admin_minsal_citas_citdistribucionprocedimiento_edit',);
                                }

                                // admin_minsal_citas_citdistribucionprocedimiento_delete
                                if (preg_match('#^/admin/minsal/citas/citdistribucionprocedimiento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citdistribucionprocedimiento_delete')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionProcedimientoAdminController::deleteAction',  '_sonata_admin' => 'minsal_citas.admin.cit_distribucion_procedimiento',  '_sonata_name' => 'admin_minsal_citas_citdistribucionprocedimiento_delete',));
                                }

                                // admin_minsal_citas_citdistribucionprocedimiento_show
                                if (preg_match('#^/admin/minsal/citas/citdistribucionprocedimiento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citdistribucionprocedimiento_show')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionProcedimientoAdminController::showAction',  '_sonata_admin' => 'minsal_citas.admin.cit_distribucion_procedimiento',  '_sonata_name' => 'admin_minsal_citas_citdistribucionprocedimiento_show',));
                                }

                                // admin_minsal_citas_citdistribucionprocedimiento_activar
                                if (preg_match('#^/admin/minsal/citas/citdistribucionprocedimiento/(?P<id>[^/]++)/activar$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citdistribucionprocedimiento_activar')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitDistribucionProcedimientoAdminController::activarAction',  '_sonata_admin' => 'minsal_citas.admin.cit_distribucion_procedimiento',  '_sonata_name' => 'admin_minsal_citas_citdistribucionprocedimiento_activar',));
                                }

                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/citas/citestadocita')) {
                            // admin_minsal_citas_citestadocita_list
                            if ($pathinfo === '/admin/minsal/citas/citestadocita/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_citas.admin.cit_estado_cita',  '_sonata_name' => 'admin_minsal_citas_citestadocita_list',  '_route' => 'admin_minsal_citas_citestadocita_list',);
                            }

                            // admin_minsal_citas_citestadocita_create
                            if ($pathinfo === '/admin/minsal/citas/citestadocita/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_citas.admin.cit_estado_cita',  '_sonata_name' => 'admin_minsal_citas_citestadocita_create',  '_route' => 'admin_minsal_citas_citestadocita_create',);
                            }

                            // admin_minsal_citas_citestadocita_batch
                            if ($pathinfo === '/admin/minsal/citas/citestadocita/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_citas.admin.cit_estado_cita',  '_sonata_name' => 'admin_minsal_citas_citestadocita_batch',  '_route' => 'admin_minsal_citas_citestadocita_batch',);
                            }

                            // admin_minsal_citas_citestadocita_edit
                            if (preg_match('#^/admin/minsal/citas/citestadocita/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citestadocita_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_citas.admin.cit_estado_cita',  '_sonata_name' => 'admin_minsal_citas_citestadocita_edit',));
                            }

                            // admin_minsal_citas_citestadocita_delete
                            if (preg_match('#^/admin/minsal/citas/citestadocita/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citestadocita_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'minsal_citas.admin.cit_estado_cita',  '_sonata_name' => 'admin_minsal_citas_citestadocita_delete',));
                            }

                            // admin_minsal_citas_citestadocita_show
                            if (preg_match('#^/admin/minsal/citas/citestadocita/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citestadocita_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_citas.admin.cit_estado_cita',  '_sonata_name' => 'admin_minsal_citas_citestadocita_show',));
                            }

                            // admin_minsal_citas_citestadocita_export
                            if ($pathinfo === '/admin/minsal/citas/citestadocita/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_citas.admin.cit_estado_cita',  '_sonata_name' => 'admin_minsal_citas_citestadocita_export',  '_route' => 'admin_minsal_citas_citestadocita_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/citas/cittipocita')) {
                            // admin_minsal_citas_cittipocita_list
                            if ($pathinfo === '/admin/minsal/citas/cittipocita/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_citas.admin.cit_tipocita',  '_sonata_name' => 'admin_minsal_citas_cittipocita_list',  '_route' => 'admin_minsal_citas_cittipocita_list',);
                            }

                            // admin_minsal_citas_cittipocita_create
                            if ($pathinfo === '/admin/minsal/citas/cittipocita/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_citas.admin.cit_tipocita',  '_sonata_name' => 'admin_minsal_citas_cittipocita_create',  '_route' => 'admin_minsal_citas_cittipocita_create',);
                            }

                            // admin_minsal_citas_cittipocita_batch
                            if ($pathinfo === '/admin/minsal/citas/cittipocita/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_citas.admin.cit_tipocita',  '_sonata_name' => 'admin_minsal_citas_cittipocita_batch',  '_route' => 'admin_minsal_citas_cittipocita_batch',);
                            }

                            // admin_minsal_citas_cittipocita_edit
                            if (preg_match('#^/admin/minsal/citas/cittipocita/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_cittipocita_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_citas.admin.cit_tipocita',  '_sonata_name' => 'admin_minsal_citas_cittipocita_edit',));
                            }

                            // admin_minsal_citas_cittipocita_delete
                            if (preg_match('#^/admin/minsal/citas/cittipocita/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_cittipocita_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'minsal_citas.admin.cit_tipocita',  '_sonata_name' => 'admin_minsal_citas_cittipocita_delete',));
                            }

                            // admin_minsal_citas_cittipocita_show
                            if (preg_match('#^/admin/minsal/citas/cittipocita/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_cittipocita_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_citas.admin.cit_tipocita',  '_sonata_name' => 'admin_minsal_citas_cittipocita_show',));
                            }

                            // admin_minsal_citas_cittipocita_export
                            if ($pathinfo === '/admin/minsal/citas/cittipocita/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_citas.admin.cit_tipocita',  '_sonata_name' => 'admin_minsal_citas_cittipocita_export',  '_route' => 'admin_minsal_citas_cittipocita_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/citas/citcitasprocedimientos')) {
                            // admin_minsal_citas_citcitasprocedimientos_list
                            if ($pathinfo === '/admin/minsal/citas/citcitasprocedimientos/list') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosAdminController::listAction',  '_sonata_admin' => 'minsal_citas.admin.cit_citas_procedimientos',  '_sonata_name' => 'admin_minsal_citas_citcitasprocedimientos_list',  '_route' => 'admin_minsal_citas_citcitasprocedimientos_list',);
                            }

                            // admin_minsal_citas_citcitasprocedimientos_create
                            if ($pathinfo === '/admin/minsal/citas/citcitasprocedimientos/create') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosAdminController::createAction',  '_sonata_admin' => 'minsal_citas.admin.cit_citas_procedimientos',  '_sonata_name' => 'admin_minsal_citas_citcitasprocedimientos_create',  '_route' => 'admin_minsal_citas_citcitasprocedimientos_create',);
                            }

                            // admin_minsal_citas_citcitasprocedimientos_edit
                            if (preg_match('#^/admin/minsal/citas/citcitasprocedimientos/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citcitasprocedimientos_edit')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosAdminController::editAction',  '_sonata_admin' => 'minsal_citas.admin.cit_citas_procedimientos',  '_sonata_name' => 'admin_minsal_citas_citcitasprocedimientos_edit',));
                            }

                            // admin_minsal_citas_citcitasprocedimientos_show
                            if (preg_match('#^/admin/minsal/citas/citcitasprocedimientos/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_citas_citcitasprocedimientos_show')), array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosAdminController::showAction',  '_sonata_admin' => 'minsal_citas.admin.cit_citas_procedimientos',  '_sonata_name' => 'admin_minsal_citas_citcitasprocedimientos_show',));
                            }

                            // admin_minsal_citas_citcitasprocedimientos_consulta
                            if ($pathinfo === '/admin/minsal/citas/citcitasprocedimientos/consulta') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosAdminController::consultaAction',  '_sonata_admin' => 'minsal_citas.admin.cit_citas_procedimientos',  '_sonata_name' => 'admin_minsal_citas_citcitasprocedimientos_consulta',  '_route' => 'admin_minsal_citas_citcitasprocedimientos_consulta',);
                            }

                            // admin_minsal_citas_citcitasprocedimientos_busqueda
                            if ($pathinfo === '/admin/minsal/citas/citcitasprocedimientos/busqueda') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosAdminController::busquedaAction',  '_sonata_admin' => 'minsal_citas.admin.cit_citas_procedimientos',  '_sonata_name' => 'admin_minsal_citas_citcitasprocedimientos_busqueda',  '_route' => 'admin_minsal_citas_citcitasprocedimientos_busqueda',);
                            }

                            // admin_minsal_citas_citcitasprocedimientos_agenda
                            if ($pathinfo === '/admin/minsal/citas/citcitasprocedimientos/agenda') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosAdminController::agendaAction',  '_sonata_admin' => 'minsal_citas.admin.cit_citas_procedimientos',  '_sonata_name' => 'admin_minsal_citas_citcitasprocedimientos_agenda',  '_route' => 'admin_minsal_citas_citcitasprocedimientos_agenda',);
                            }

                            // admin_minsal_citas_citcitasprocedimientos_fechaslibres
                            if ($pathinfo === '/admin/minsal/citas/citcitasprocedimientos/fechaslibres') {
                                return array (  '_controller' => 'Minsal\\CitasBundle\\Controller\\CitCitasProcedimientosAdminController::fechaslibresAction',  '_sonata_admin' => 'minsal_citas.admin.cit_citas_procedimientos',  '_sonata_name' => 'admin_minsal_citas_citcitasprocedimientos_fechaslibres',  '_route' => 'admin_minsal_citas_citcitasprocedimientos_fechaslibres',);
                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/minsal/laboratorio')) {
                        if (0 === strpos($pathinfo, '/admin/minsal/laboratorio/labsuministrante')) {
                            // admin_minsal_laboratorio_labsuministrante_list
                            if ($pathinfo === '/admin/minsal/laboratorio/labsuministrante/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'minsal_laboratorio.admin.lab_suministrante',  '_sonata_name' => 'admin_minsal_laboratorio_labsuministrante_list',  '_route' => 'admin_minsal_laboratorio_labsuministrante_list',);
                            }

                            // admin_minsal_laboratorio_labsuministrante_create
                            if ($pathinfo === '/admin/minsal/laboratorio/labsuministrante/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'minsal_laboratorio.admin.lab_suministrante',  '_sonata_name' => 'admin_minsal_laboratorio_labsuministrante_create',  '_route' => 'admin_minsal_laboratorio_labsuministrante_create',);
                            }

                            // admin_minsal_laboratorio_labsuministrante_batch
                            if ($pathinfo === '/admin/minsal/laboratorio/labsuministrante/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'minsal_laboratorio.admin.lab_suministrante',  '_sonata_name' => 'admin_minsal_laboratorio_labsuministrante_batch',  '_route' => 'admin_minsal_laboratorio_labsuministrante_batch',);
                            }

                            // admin_minsal_laboratorio_labsuministrante_edit
                            if (preg_match('#^/admin/minsal/laboratorio/labsuministrante/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_laboratorio_labsuministrante_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'minsal_laboratorio.admin.lab_suministrante',  '_sonata_name' => 'admin_minsal_laboratorio_labsuministrante_edit',));
                            }

                            // admin_minsal_laboratorio_labsuministrante_delete
                            if (preg_match('#^/admin/minsal/laboratorio/labsuministrante/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_laboratorio_labsuministrante_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'minsal_laboratorio.admin.lab_suministrante',  '_sonata_name' => 'admin_minsal_laboratorio_labsuministrante_delete',));
                            }

                            // admin_minsal_laboratorio_labsuministrante_show
                            if (preg_match('#^/admin/minsal/laboratorio/labsuministrante/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_laboratorio_labsuministrante_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'minsal_laboratorio.admin.lab_suministrante',  '_sonata_name' => 'admin_minsal_laboratorio_labsuministrante_show',));
                            }

                            // admin_minsal_laboratorio_labsuministrante_export
                            if ($pathinfo === '/admin/minsal/laboratorio/labsuministrante/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'minsal_laboratorio.admin.lab_suministrante',  '_sonata_name' => 'admin_minsal_laboratorio_labsuministrante_export',  '_route' => 'admin_minsal_laboratorio_labsuministrante_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/minsal/laboratorio/secsolicitudestudios')) {
                            // admin_minsal_laboratorio_secsolicitudestudios_list
                            if ($pathinfo === '/admin/minsal/laboratorio/secsolicitudestudios/list') {
                                return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosAdminController::listAction',  '_sonata_admin' => 'minsal_laboratorio.admin.sec_solicitudestudios',  '_sonata_name' => 'admin_minsal_laboratorio_secsolicitudestudios_list',  '_route' => 'admin_minsal_laboratorio_secsolicitudestudios_list',);
                            }

                            // admin_minsal_laboratorio_secsolicitudestudios_create
                            if ($pathinfo === '/admin/minsal/laboratorio/secsolicitudestudios/create') {
                                return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosAdminController::createAction',  '_sonata_admin' => 'minsal_laboratorio.admin.sec_solicitudestudios',  '_sonata_name' => 'admin_minsal_laboratorio_secsolicitudestudios_create',  '_route' => 'admin_minsal_laboratorio_secsolicitudestudios_create',);
                            }

                            // admin_minsal_laboratorio_secsolicitudestudios_edit
                            if (preg_match('#^/admin/minsal/laboratorio/secsolicitudestudios/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_laboratorio_secsolicitudestudios_edit')), array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosAdminController::editAction',  '_sonata_admin' => 'minsal_laboratorio.admin.sec_solicitudestudios',  '_sonata_name' => 'admin_minsal_laboratorio_secsolicitudestudios_edit',));
                            }

                            // admin_minsal_laboratorio_secsolicitudestudios_delete
                            if (preg_match('#^/admin/minsal/laboratorio/secsolicitudestudios/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_laboratorio_secsolicitudestudios_delete')), array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosAdminController::deleteAction',  '_sonata_admin' => 'minsal_laboratorio.admin.sec_solicitudestudios',  '_sonata_name' => 'admin_minsal_laboratorio_secsolicitudestudios_delete',));
                            }

                            // admin_minsal_laboratorio_secsolicitudestudios_show
                            if (preg_match('#^/admin/minsal/laboratorio/secsolicitudestudios/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_laboratorio_secsolicitudestudios_show')), array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosAdminController::showAction',  '_sonata_admin' => 'minsal_laboratorio.admin.sec_solicitudestudios',  '_sonata_name' => 'admin_minsal_laboratorio_secsolicitudestudios_show',));
                            }

                            if (0 === strpos($pathinfo, '/admin/minsal/laboratorio/secsolicitudestudios/a')) {
                                // admin_minsal_laboratorio_secsolicitudestudios_assign_exam
                                if ($pathinfo === '/admin/minsal/laboratorio/secsolicitudestudios/assign_exam') {
                                    return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosAdminController::assignExamAction',  '_sonata_admin' => 'minsal_laboratorio.admin.sec_solicitudestudios',  '_sonata_name' => 'admin_minsal_laboratorio_secsolicitudestudios_assign_exam',  '_route' => 'admin_minsal_laboratorio_secsolicitudestudios_assign_exam',);
                                }

                                if (0 === strpos($pathinfo, '/admin/minsal/laboratorio/secsolicitudestudios/agregar_')) {
                                    // admin_minsal_laboratorio_secsolicitudestudios_agregar_solicitud
                                    if ($pathinfo === '/admin/minsal/laboratorio/secsolicitudestudios/agregar_solicitud') {
                                        return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosAdminController::agregarSolicitudAction',  '_sonata_admin' => 'minsal_laboratorio.admin.sec_solicitudestudios',  '_sonata_name' => 'admin_minsal_laboratorio_secsolicitudestudios_agregar_solicitud',  '_route' => 'admin_minsal_laboratorio_secsolicitudestudios_agregar_solicitud',);
                                    }

                                    // admin_minsal_laboratorio_secsolicitudestudios_agregar_paciente_referido
                                    if ($pathinfo === '/admin/minsal/laboratorio/secsolicitudestudios/agregar_paciente_referido') {
                                        return array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosAdminController::agregarPacienteReferidoAction',  '_sonata_admin' => 'minsal_laboratorio.admin.sec_solicitudestudios',  '_sonata_name' => 'admin_minsal_laboratorio_secsolicitudestudios_agregar_paciente_referido',  '_route' => 'admin_minsal_laboratorio_secsolicitudestudios_agregar_paciente_referido',);
                                    }

                                }

                            }

                            // admin_minsal_laboratorio_secsolicitudestudios_imprimir_solicitudestudios
                            if (0 === strpos($pathinfo, '/admin/minsal/laboratorio/secsolicitudestudios/imprimir/solicitudestudios') && preg_match('#^/admin/minsal/laboratorio/secsolicitudestudios/imprimir/solicitudestudios/(?P<idHistorialClinico>[^/]++)$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_minsal_laboratorio_secsolicitudestudios_imprimir_solicitudestudios')), array (  '_controller' => 'Minsal\\LaboratorioBundle\\Controller\\SecSolicitudestudiosAdminController::imprimirSolicitudestudiosAction',  '_sonata_admin' => 'minsal_laboratorio.admin.sec_solicitudestudios',  '_sonata_name' => 'admin_minsal_laboratorio_secsolicitudestudios_imprimir_solicitudestudios',));
                            }

                        }

                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/sonata/cache')) {
            // sonata_cache_esi
            if (0 === strpos($pathinfo, '/sonata/cache/esi') && preg_match('#^/sonata/cache/esi/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_cache_esi')), array (  '_controller' => 'sonata.cache.esi:cacheAction',));
            }

            // sonata_cache_ssi
            if (0 === strpos($pathinfo, '/sonata/cache/ssi') && preg_match('#^/sonata/cache/ssi/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_cache_ssi')), array (  '_controller' => 'sonata.cache.ssi:cacheAction',));
            }

            if (0 === strpos($pathinfo, '/sonata/cache/js-')) {
                // sonata_cache_js_async
                if ($pathinfo === '/sonata/cache/js-async') {
                    return array (  '_controller' => 'sonata.cache.js_async:cacheAction',  '_route' => 'sonata_cache_js_async',);
                }

                // sonata_cache_js_sync
                if ($pathinfo === '/sonata/cache/js-sync') {
                    return array (  '_controller' => 'sonata.cache.js_sync:cacheAction',  '_route' => 'sonata_cache_js_sync',);
                }

            }

            // sonata_cache_apc
            if (0 === strpos($pathinfo, '/sonata/cache/apc') && preg_match('#^/sonata/cache/apc/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_cache_apc')), array (  '_controller' => 'sonata.cache.apc:cacheAction',));
            }

            // sonata_cache_symfony
            if (0 === strpos($pathinfo, '/sonata/cache/symfony') && preg_match('#^/sonata/cache/symfony/(?P<token>[^/]++)/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_cache_symfony')), array (  '_controller' => 'sonata.cache.symfony:cacheAction',));
            }

        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::loginAction',  '_route' => 'fos_user_security_login',);
                }

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::logoutAction',  '_route' => 'fos_user_security_logout',);
            }

            if (0 === strpos($pathinfo, '/login')) {
                // sonata_user_security_login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::loginAction',  '_route' => 'sonata_user_security_login',);
                }

                // sonata_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_sonata_user_security_check;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::checkAction',  '_route' => 'sonata_user_security_check',);
                }
                not_sonata_user_security_check:

            }

            // sonata_user_security_logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::logoutAction',  '_route' => 'sonata_user_security_logout',);
            }

        }

        if (0 === strpos($pathinfo, '/resetting')) {
            // fos_user_resetting_request
            if ($pathinfo === '/resetting/request') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_request;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::requestAction',  '_route' => 'fos_user_resetting_request',);
            }
            not_fos_user_resetting_request:

            // fos_user_resetting_send_email
            if ($pathinfo === '/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_user_resetting_send_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
            }
            not_fos_user_resetting_send_email:

            // fos_user_resetting_check_email
            if ($pathinfo === '/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_check_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
            }
            not_fos_user_resetting_check_email:

            if (0 === strpos($pathinfo, '/resetting/re')) {
                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_resetting_reset;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::resetAction',));
                }
                not_fos_user_resetting_reset:

                // sonata_user_resetting_request
                if ($pathinfo === '/resetting/request') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_sonata_user_resetting_request;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::requestAction',  '_route' => 'sonata_user_resetting_request',);
                }
                not_sonata_user_resetting_request:

            }

            // sonata_user_resetting_send_email
            if ($pathinfo === '/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_sonata_user_resetting_send_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::sendEmailAction',  '_route' => 'sonata_user_resetting_send_email',);
            }
            not_sonata_user_resetting_send_email:

            // sonata_user_resetting_check_email
            if ($pathinfo === '/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_sonata_user_resetting_check_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::checkEmailAction',  '_route' => 'sonata_user_resetting_check_email',);
            }
            not_sonata_user_resetting_check_email:

            // sonata_user_resetting_reset
            if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_sonata_user_resetting_reset;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_user_resetting_reset')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::resetAction',));
            }
            not_sonata_user_resetting_reset:

        }

        if (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }

                return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            if (0 === strpos($pathinfo, '/profile/edit-')) {
                // fos_user_profile_edit_authentication
                if ($pathinfo === '/profile/edit-authentication') {
                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editAuthenticationAction',  '_route' => 'fos_user_profile_edit_authentication',);
                }

                // fos_user_profile_edit
                if ($pathinfo === '/profile/edit-profile') {
                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editProfileAction',  '_route' => 'fos_user_profile_edit',);
                }

            }

            // sonata_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_sonata_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_user_profile_show');
                }

                return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::showAction',  '_route' => 'sonata_user_profile_show',);
            }
            not_sonata_user_profile_show:

            if (0 === strpos($pathinfo, '/profile/edit-')) {
                // sonata_user_profile_edit_authentication
                if ($pathinfo === '/profile/edit-authentication') {
                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editAuthenticationAction',  '_route' => 'sonata_user_profile_edit_authentication',);
                }

                // sonata_user_profile_edit
                if ($pathinfo === '/profile/edit-profile') {
                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editProfileAction',  '_route' => 'sonata_user_profile_edit',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/register')) {
            // fos_user_registration_register
            if (rtrim($pathinfo, '/') === '/register') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::registerAction',  '_route' => 'fos_user_registration_register',);
            }

            if (0 === strpos($pathinfo, '/register/c')) {
                // fos_user_registration_check_email
                if ($pathinfo === '/register/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_registration_check_email;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                }
                not_fos_user_registration_check_email:

                if (0 === strpos($pathinfo, '/register/confirm')) {
                    // fos_user_registration_confirm
                    if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_confirm;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmAction',));
                    }
                    not_fos_user_registration_confirm:

                    // fos_user_registration_confirmed
                    if ($pathinfo === '/register/confirmed') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_confirmed;
                        }

                        return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                    }
                    not_fos_user_registration_confirmed:

                }

            }

            // sonata_user_registration_register
            if (rtrim($pathinfo, '/') === '/register') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_user_registration_register');
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::registerAction',  '_route' => 'sonata_user_registration_register',);
            }

            if (0 === strpos($pathinfo, '/register/c')) {
                // sonata_user_registration_check_email
                if ($pathinfo === '/register/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_sonata_user_registration_check_email;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::checkEmailAction',  '_route' => 'sonata_user_registration_check_email',);
                }
                not_sonata_user_registration_check_email:

                if (0 === strpos($pathinfo, '/register/confirm')) {
                    // sonata_user_registration_confirm
                    if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_sonata_user_registration_confirm;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_user_registration_confirm')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmAction',));
                    }
                    not_sonata_user_registration_confirm:

                    // sonata_user_registration_confirmed
                    if ($pathinfo === '/register/confirmed') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_sonata_user_registration_confirmed;
                        }

                        return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmedAction',  '_route' => 'sonata_user_registration_confirmed',);
                    }
                    not_sonata_user_registration_confirmed:

                }

            }

        }

        if (0 === strpos($pathinfo, '/admin')) {
            if (0 === strpos($pathinfo, '/admin/change-password')) {
                // fos_user_change_password
                if ($pathinfo === '/admin/change-password') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_change_password;
                    }

                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ChangePasswordFOSUser1Controller::changePasswordAction',  '_route' => 'fos_user_change_password',);
                }
                not_fos_user_change_password:

                // sonata_user_change_password
                if ($pathinfo === '/admin/change-password') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_sonata_user_change_password;
                    }

                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\ChangePasswordFOSUser1Controller::changePasswordAction',  '_route' => 'sonata_user_change_password',);
                }
                not_sonata_user_change_password:

            }

            if (0 === strpos($pathinfo, '/admin/log')) {
                if (0 === strpos($pathinfo, '/admin/login')) {
                    // sonata_user_admin_security_login
                    if ($pathinfo === '/admin/login') {
                        return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\AdminSecurityController::loginAction',  '_route' => 'sonata_user_admin_security_login',);
                    }

                    // sonata_user_admin_security_check
                    if ($pathinfo === '/admin/login_check') {
                        return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\AdminSecurityController::checkAction',  '_route' => 'sonata_user_admin_security_check',);
                    }

                }

                // sonata_user_admin_security_logout
                if ($pathinfo === '/admin/logout') {
                    return array (  '_controller' => 'Application\\Sonata\\UserBundle\\Controller\\AdminSecurityController::logoutAction',  '_route' => 'sonata_user_admin_security_logout',);
                }

            }

        }

        // fullcalendar_loader
        if ($pathinfo === '/fc-load-events') {
            return array (  '_controller' => 'ADesigns\\CalendarBundle\\Controller\\CalendarController::loadCalendarAction',  '_route' => 'fullcalendar_loader',);
        }

        // fos_js_routing_js
        if (0 === strpos($pathinfo, '/js/routing') && preg_match('#^/js/routing(?:\\.(?P<_format>js|json))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_js_routing_js')), array (  '_controller' => 'fos_js_routing.controller:indexAction',  '_format' => 'js',));
        }

        // generate_formtest
        if (0 === strpos($pathinfo, '/generateformtest') && preg_match('#^/generateformtest/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'generate_formtest')), array (  '_controller' => 'MinsalSeguimientoBundle:FormGeneratorTest:generateFormTest',));
        }

        if (0 === strpos($pathinfo, '/espe')) {
            // mespecialidades
            if (preg_match('#^/espe/(?P<establecimiento>[^/]++)/(?P<host>[^/]++)/(?P<method>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'mespecialidades')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\ClienteController::obtenerEspecialidadesAction',));
            }

            // mespecialidad
            if (preg_match('#^/espe/(?P<establecimiento>[^/]++)/(?P<host>[^/]++)/(?P<especialidad>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'mespecialidad')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\ClienteController::obtenerEspecialidadesAction',));
            }

        }

        // referencia
        if (0 === strpos($pathinfo, '/referencia/guardar') && preg_match('#^/referencia/guardar/(?P<establecimiento>[^/]++)/(?P<host>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'referencia')), array (  '_controller' => 'Minsal\\SeguimientoBundle\\Controller\\ClienteController::guardarReferenciaAction',));
        }

        // endroid_qrcode
        if (0 === strpos($pathinfo, '/qrcode') && preg_match('#^/qrcode/(?P<text>[\\w\\W]+)\\.(?P<extension>jpg|png|gif)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'endroid_qrcode')), array (  '_controller' => 'Endroid\\Bundle\\QrCodeBundle\\Controller\\QrCodeController::generateAction',));
        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                if (0 === strpos($pathinfo, '/_profiler/i')) {
                    // _profiler_info
                    if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                    }

                    // _profiler_import
                    if ($pathinfo === '/_profiler/import') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:importAction',  '_route' => '_profiler_import',);
                    }

                }

                // _profiler_export
                if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]++)\\.txt$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_export')), array (  '_controller' => 'web_profiler.controller.profiler:exportAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
