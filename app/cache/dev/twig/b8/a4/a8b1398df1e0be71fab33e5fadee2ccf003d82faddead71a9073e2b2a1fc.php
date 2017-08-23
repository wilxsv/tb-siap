<?php

/* MinsalSeguimientoBundle:SecHistorialClinico:finalizar_consulta.html.twig */
class __TwigTemplate_b8a4a8b1398df1e0be71fab33e5fadee2ccf003d82faddead71a9073e2b2a1fc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_breadcrumb' => array($this, 'block_sonata_breadcrumb'),
            'actions' => array($this, 'block_actions'),
            'form' => array($this, 'block_form'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 5
        $context["url_parameters"] = array("_external" => "true", "_modulo" => "seguimiento_clinico", "tipoPacPertenencia" => "local");
        // line 7
        if (($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : null), "idEmpleado", array(), "any", true, true) && (!($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEmpleado") === "")))) {
            // line 8
            $context["url_parameters"] = twig_array_merge((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")), array("idEmpleado" => $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEmpleado")));
        }
        // line 11
        if (($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : null), "idEspecialidad", array(), "any", true, true) && (!($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEspecialidad") === "")))) {
            // line 12
            $context["url_parameters"] = twig_array_merge((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")), array("idEspecialidad" => $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEspecialidad")));
        }
        // line 15
        if (($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : null), "idHistorialClinico", array(), "any", true, true) && (!($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idHistorialClinico") === "")))) {
            // line 16
            $context["url_parameters"] = twig_array_merge((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")), array("idHistorialClinico" => $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idHistorialClinico")));
        }
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 20
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 21
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/MntPacienteAdmin/encabezado_paciente.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalseguimiento/css/seguimiento.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 26
    public function block_javascripts($context, array $blocks = array())
    {
        // line 27
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalseguimiento/js/SecHistorialClinico/finalizar_consulta.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <!--Script para Citas-->
    <script type=\"text/javascript\">
                var idCitaControl = null;
                var idCitaSeguimiento = null;
                var idCitaProcedimiento = null;
                var numReceta = null;
                var numReferencia = null;
                var idSolicitud = null;
                var idSolFVIH = null;
                var modal_elements = [];

                function updateIdCita(idCita, tipoCita) {
                switch (tipoCita) {
                case 1:
                        idCitaControl = idCita;
                        break;
                        case 2:
                        idCitaSeguimiento = idCita;
                        break;
                        default:
                        idCitaProcedimiento = idCita;
                        break;
                }

                updatePrintButtons();
                }

        function updateIdFarmacia(idFarmacia) {
        if (idFarmacia !== null && idFarmacia !== '') {
        numReceta = 1;
        } else {
        numReceta = 0;
        }

        updatePrintButtons();
        }

        function updateIdReferencia(idReferencia) {
        if (idReferencia !== null && idReferencia !== '') {
        numReferencia = 1;
        } else {
        numReferencia = 0;
        }

        updatePrintButtons();
        }

        function updateIdSolicitudestudios(idSolicitudestudios) {
        idSolicitud = idSolicitudestudios;
                updatePrintButtons();
        }

        function updateSolicitudFVIH(idSolicitud) {
        idSolFVIH = idSolicitud;
                updatePrintButtons();
        }


        function updatePrintButtons() {
                changeBtnStatus(jQuery('#comprobante-cita-control'), idCitaControl, \"";
        // line 88
        echo $this->env->getExtension('routing')->getUrl("citasgetcomprobante");
        echo "?id=\" + idCitaControl);
                changeBtnStatus(jQuery('#comprobante-cita-seguimiento'), idCitaSeguimiento, \"";
        // line 89
        echo $this->env->getExtension('routing')->getUrl("citasgetcomprobante");
        echo "?id=\" + idCitaSeguimiento);
                changeBtnStatus(jQuery('#comprobante-cita-procedimiento'), idCitaSeguimiento, \"";
        // line 90
        echo $this->env->getExtension('routing')->getUrl("citasgetcomprobante");
        echo "?id=\" + idCitaSeguimiento);
                changeBtnStatus(jQuery('#imprimir-recetas'), numReceta, '#');
                changeBtnStatus(jQuery('#imprimir-fvih01'), idSolFVIH, '#');
                changeBtnStatus(jQuery('#imprimir-solicitud-estudios'), idSolicitud, '#');
                changeBtnStatus(jQuery('#imprimir-referencia-interconsulta'), numReferencia, '#');
        }

        function changeBtnStatus(element, value, url) {
        if (value === null || value === '') {
        element.addClass('disabled');
                element.attr('href', '#');
        } else {
        element.removeClass('disabled');
                element.attr('href', url);
        }
        }

        jQuery(document).ready(function (\$) {
            ";
        // line 108
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["SecHistorialCitaDiaSubsec"]) ? $context["SecHistorialCitaDiaSubsec"] : $this->getContext($context, "SecHistorialCitaDiaSubsec")));
        foreach ($context['_seq'] as $context["_key"] => $context["cita"]) {
            // line 109
            echo "                ";
            if (($this->getAttribute($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "getIdTipoCitaSubsecuente", array(), "method"), "getId", array(), "method") == "1")) {
                // line 110
                echo "                    idCitaControl = '";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "getIdCitaDia", array(), "method"), "getId", array(), "method"), "html", null, true);
                echo "';
                ";
            } elseif (($this->getAttribute($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "getIdTipoCitaSubsecuente", array(), "method"), "getId", array(), "method") == "2")) {
                // line 112
                echo "                    idCitaSeguimiento = '";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "getIdCitaDia", array(), "method"), "getId", array(), "method"), "html", null, true);
                echo "';
                ";
            } else {
                // line 114
                echo "                    idCitaProcedimiento = '";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "getIdCitaDia", array(), "method"), "getId", array(), "method"), "html", null, true);
                echo "';
                ";
            }
            // line 116
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cita'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 117
        echo "                        numReceta = ";
        if ((twig_length_filter($this->env, (isset($context["objreceta"]) ? $context["objreceta"] : $this->getContext($context, "objreceta"))) > 0)) {
            echo "\"";
            echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["objreceta"]) ? $context["objreceta"] : $this->getContext($context, "objreceta"))), "html", null, true);
            echo "\"";
        } else {
            echo "null";
        }
        echo ";
                        numReferencia = ";
        // line 118
        if ((twig_length_filter($this->env, (isset($context["objremision"]) ? $context["objremision"] : $this->getContext($context, "objremision"))) > 0)) {
            echo "\"";
            echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["objremision"]) ? $context["objremision"] : $this->getContext($context, "objremision"))), "html", null, true);
            echo "\"";
        } else {
            echo "null";
        }
        echo ";
                        idSolFVIH = \"";
        // line 119
        echo twig_escape_filter($this->env, (((isset($context["idSolFVIH"]) ? $context["idSolFVIH"] : $this->getContext($context, "idSolFVIH"))) ? ($this->getAttribute((isset($context["idSolFVIH"]) ? $context["idSolFVIH"] : $this->getContext($context, "idSolFVIH")), "getId", array(), "method")) : (null)), "html", null, true);
        echo "\";
                        ";
        // line 120
        if ((twig_length_filter($this->env, (isset($context["SecSolicitudestudios"]) ? $context["SecSolicitudestudios"] : $this->getContext($context, "SecSolicitudestudios"))) > 0)) {
            // line 121
            echo "                            idSolicitud = ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["SecSolicitudestudios"]) ? $context["SecSolicitudestudios"] : $this->getContext($context, "SecSolicitudestudios")), "getId", array(), "method"), "html", null, true);
            echo ";
                        ";
        }
        // line 123
        echo "                        updatePrintButtons();
                        \$.ajaxSetup({
                        error: function (jqXHR, exception) {
                        if (jqXHR.status === 0) {
                        alert('Not connect.\\n Verify Network.');
                        } else if (jqXHR.status == 404) {
                        alert('Requested page not found. [404]');
                        } else if (jqXHR.status == 500) {
                        alert('Internal Server Error [500].');
                        } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                        } else if (exception === 'timeout') {
                        alert('Time out error.');
                        } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                        } else {
                        alert('Uncaught Error.\\n' + jqXHR.responseText);
                        }
                        }
                        });
                        \$(\"a[id^='asignar-cita']\").on(\"click\", function () {
                var tipo = \"\";
                        var parameters = ";
        // line 145
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                        var winParams = [];
                        if (\$(this).attr('id') === \"asignar-cita-control\") {
                tipo = \"1\"; //Control
                } else if (\$(this).attr('id') === \"asignar-cita-seguimiento\") {
                tipo = \"2\"; //Seguimiento
                } else {
                tipo = \"3\"; //Procedimiento
                }

                parameters['tipo'] = tipo;
                        winParams['method'] = \"post\";
                        winParams['action'] = \"";
        // line 157
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_citas_citcitasdia_list");
        echo "\";
                        winParams['target'] = \"Asignacion de Cita al Paciente\";
                        winParams['parameters'] = parameters;
                        openPostPopUpWindows(winParams);
                });

                \$('#btn-solicitud-estudios').on('click', function() {
                    \$serv_ap = \$('#servicio_apoyo');

                    if (\$serv_ap.select2(\"val\") != \"\") {
                        switch (\$serv_ap.select2(\"val\")) {
                        case \"1\":
                            var parameters = ";
        // line 169
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                            var winParams = [];
                            parameters['fechaSolicitud'] = ";
        // line 171
        if ((!(null === $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdMotivoRetroactivo", array(), "method")))) {
            // line 172
            echo "                                                                '";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getFechaconsulta", array(), "method"), "Y-m-d"), "html", null, true);
            echo "'
                                                            ";
        } else {
            // line 174
            echo "                                                                getCurrentDate('yyyy-mm-dd')
                                                            ";
        }
        // line 175
        echo ";
                            winParams['method'] = \"post\";
                            winParams['action'] = \"";
        // line 177
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_laboratorio_secsolicitudestudios_assign_exam");
        echo "\";
                            winParams['target'] = \"Creacion de Solicitud de Estudio de Laboratorio Clinico\";
                            winParams['parameters'] = parameters;
                            openPostPopUpWindows(winParams);
                            break;
                            default:
                            var title = 'Funcion no disponible';
                            var body = 'Lo sentimos, por el momento no se encuentra disponible esta funcion del sistema.';
                            var clase = 'dialog-info';
                            showDialogMsg(title, body, clase);
                            break;
                        }
                    } else {
                        var title = 'Dato incompleto!!!';
                        var body = 'Debe de seleccionar un <b>servicio de apoyo</b> ante de crear una solicitud de estudios';
                        var clase = 'dialog-warning';
                        showDialogMsg(title, body, clase);
                    }
                });

                \$(\"a#recetario\").on(\"click\", function () {
                        var parameters = ";
        // line 198
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                        var winParams = [];
                        winParams['method'] = \"post\";
                        winParams['action'] = \"";
        // line 201
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_farmacia_farmrecetas_assign_receta");
        echo "\";
                        winParams['target'] = \"Creacion de Receta\";
                        winParams['parameters'] = parameters;
                        openPostPopUpWindows(winParams);
                });
                \$(\"a#imprimir-recetas\").on(\"click\", function () {
                        var tipo = \"\";
                        var parameters = ";
        // line 208
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                        var winParams = [];
                        winParams['method'] = \"post\";
                        winParams['action'] = \"";
        // line 211
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_farmacia_farmrecetas_imprimir_receta");
        echo "\";
                        winParams['target'] = \"Impresion de Receta\";
                        winParams['parameters'] = parameters;
                        openPostPopUpWindows(winParams);
                });

                \$(\"a#imprimir-solicitud-estudios\").on(\"click\", function () {
                    var tipo = \"\";
                    var parameters = ";
        // line 219
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                    var winParams = [];

                    winParams['method'] = \"post\";
                    winParams['action'] = \"";
        // line 223
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_minsal_laboratorio_secsolicitudestudios_imprimir_solicitudestudios", array("idHistorialClinico" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"))), "html", null, true);
        echo "\";
                    winParams['target'] = \"Impresion Solicitud Estudios\";
                    winParams['parameters'] = parameters;
                    openPostPopUpWindows(winParams);
                });

                        \$(\"#imprimir-fvih01\").on(\"click\", function () {
                var tipo = \"\";
                        var parameters = ";
        // line 231
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                        var winParams = [];

                        winParams['method'] = \"get\";
                        winParams['action'] = \"";
        // line 235
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("imprimir_fvih01", array("idHistorialClinico" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"))), "html", null, true);
        echo "\";
                        winParams['target'] = \"Impresion FVIH01\";
                        winParams['parameters'] = parameters;
                        openPostPopUpWindows(winParams);
                });

                        \$(\"#imprimir-vigepes01\").on(\"click\", function () {
                var tipo = \"\";
                        var parameters = ";
        // line 243
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                        var winParams = [];

                        winParams['method'] = \"get\";
                        winParams['action'] = \"";
        // line 247
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("imprimir_vigepes01", array("idHistorialClinico" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"))), "html", null, true);
        echo "\";
                        winParams['target'] = \"Impresion VIGEPES01\";
                        winParams['parameters'] = parameters;
                        openPostPopUpWindows(winParams);
                });

                \$(\"#imprimir-vigepes02\").on(\"click\", function () {
                        var tipo = \"\";
                        var parameters = ";
        // line 255
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                        var winParams = [];

                        winParams['method'] = \"get\";
                        winParams['action'] = \"";
        // line 259
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("imprimir_vigepes02", array("idHistorialClinico" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"))), "html", null, true);
        echo "\";
                        winParams['target'] = \"Impresion VIGEPES02\";
                        winParams['parameters'] = parameters;
                        openPostPopUpWindows(winParams);
                });
                        \$('#establecimiento').prepend('<option/>')
                        .val(function () {
                        return \$('[selected]', this).val();
                        })
                        .select2({
                        placeholder: 'Seleccionar Establecimiento ...',
                                allowClear: true,
                                dropdownAutoWidth: true
                        });
                        \$('#especialidad').prepend('<option/>')
                        .val(function () {
                        return \$('[selected]', this).val();
                        })
                        .select2({
                        placeholder: 'Seleccionar Especialidad ...',
                                allowClear: true,
                                dropdownAutoWidth: true
                        });

            /* Agregar Consejeria */
            var addedAdviseTypes = [ ";
        // line 284
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "consejeriaBrindada"));
        foreach ($context['_seq'] as $context["_key"] => $context["consejo"]) {
            echo "'";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdTipoConsejeria", array(), "method"), "getId", array(), "method"), "html", null, true);
            echo "',";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['consejo'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo " ];

            \$('#tipoConsejeria').prepend('<option/>').val(function () {
                return \$('[selected]', this).val();
            })
            .select2({
                placeholder: 'Seleccionar Tipo de Consejería ...',
                allowClear: true,
                dropdownAutoWidth: true
            })
            .on('change', function(){
                if( \$(this).val() != '' && jQuery.inArray( \$(this).val() , addedAdviseTypes ) >= 0 ){
                    showDialogMsg('Consejería ya registrada.', 'Ya agregó este tipo de consejería. Si desea modificarla, de clic sobre el botón correspondiente \"Editar\".', 'dialog-error', null, [ { text: 'Cerrar', click: function(){ \$(this).dialog(\"close\"); \$(\"button[advise-type='\"+\$('#tipoConsejeria').val()+\"']\").effect( {effect: \"highlight\", duration: 1000} ); \$('#tipoConsejeria').select2('val',''); } } ], false );
                }
            });

            \$(\"#btn-add-advise\").on('click', function(){
                if (\$('#tipoConsejeria').val()){
                    if (\$('#consejeria').val() && (\$('#consejeria').val()).replace(/\\s+/g, '') != ''){
                        jQuery.ajax({
                            url: Routing.generate('addnewadvise') + '?idHistorialClinico='+";
        // line 304
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"), "html", null, true);
        echo "+'&idTipoConsejeria=' + \$('#tipoConsejeria').val() + '&consejo=' + \$('#consejeria').val() + '&idEmpleado='+";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEmpleado"), "html", null, true);
        echo "+'&idAtenAreaModEstab=' +";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEspecialidad"), "html", null, true);
        echo " ,
                            async: false,
                            dataType: 'json',
                            timeout: 8000, // 8 sec
                            success: function(data) {
                                if (data.success){
                                    \$('#advisesDiv').prepend('\\
                                        <blockquote id=\"advise' + data.id + '\" class=\"advise-block\" advise-type=\"' + \$('#tipoConsejeria').val() + '\" recently-added=\"true\">\\
                                            <p class=\"text-' + (\$('#tipoConsejeria').val() == 1 ? 'green' : \$('#tipoConsejeria').val() == 2 ? 'yellow' : 'light-blue') + '\">\\
                                                <b>' + data.nombreConsejeria + '</b>&nbsp;&nbsp;&nbsp;<button type=\"button\" class=\"btn btn-primary btn-xs\" id=\"adviseEditButton' + data.id + '\" onClick=\"editAdvise(' + data.id + ');\" advise-type=\"' + \$('#tipoConsejeria').val() + '\"><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span> Editar</button>\\
                                            </p>\\
                                            <span id=\"adviseText' + data.id + '\">' + \$('#consejeria').val() + '</span>\\
                                            <small>Brindada por: ' + data.nombreEmpleado + '</small>\\
                                        </blockquote>\\
                                    ');
                                    addedAdviseTypes.push(\$('#tipoConsejeria').select2('val'));
                                    \$('#tipoConsejeria').select2('val', '');
                                    \$('#consejeria').val('');
                                }
                                else{
                                    showDialogMsg('Error...', 'Hubo un error al intentar realizar el registro de Consejeria. Por favor, Intente nuevamente.', 'dialog-error');
                                }
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                console.error('Hubo un error al intentar realizar el registro de Consejeria.\\nDetalle del Error: textStatus: '+textStatus+', errorThrown: '+errorThrown);
                                showDialogMsg('Error...', 'Hubo un error al intentar realizar el registro de Consejeria. Por favor, Intente nuevamente.', 'dialog-error');
                            }
                        });
                    }else{
                        showDialogMsg('Consejo no especificado', 'Por favor, especifíque el Consejo que esta brindando.', 'dialog-error', null, [ { text: 'Cerrar', click: function(){ \$(this).dialog(\"close\"); \$('#consejeria').focus(); } } ], false );
                    }
                }else{
                    showDialogMsg('Seleccione Tipo de Consejeria', 'Por favor, seleccione el Tipo de Consejeria que esta brindando.', 'dialog-error', null, [ { text: 'Cerrar', click: function(){ \$(this).dialog(\"close\"); \$('#tipoConsejeria').focus(); } } ], false  );
                }
            });

            /* Fin Agregar Consejeria*/

            \$(\"#indicaciones_medicas\").on('change', function(){
                jQuery.ajax({
                        url: Routing.generate('saveotrasobservaciones')+'?idHistorialClinico='+";
        // line 344
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"), "html", null, true);
        echo "+'&indicaciones_medicas='+\$('#indicaciones_medicas').val()+'&campo=IndicacionObservacion',
                        async: false,
                        dataType: 'json',
                        timeout: 8000, // 8 sec
                        success: function(data) {
                            if(data.success){
                                //showDialogMsg('Guardado', 'La informacion de Indicaciones Médicas y Recomendaciones se ha guardado.', 'dialog-success');
                            }
                            else{
                                showDialogMsg('Error...', 'Hubo un error al intentar guardar el registro de Indicaciones Médicas y Recomendaciones. Por favor, Intente nuevamente.', 'dialog-error');
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                                        console.error('Hubo un error al intentar realizar el registro de Indicaciones Médicas y Recomendaciones.\\nDetalle del Error: textStatus: '+textStatus+', errorThrown: '+errorThrown);
                                showDialogMsg('Error...', 'Hubo un error al intentar realizar el registro de Indicaciones Médicas y Recomendaciones. Por favor, Intente nuevamente.', 'dialog-error');
                        }
                    });

                });

            \$(\"#examen_gabinete\").on('change', function(){
                jQuery.ajax({
                       url: Routing.generate('saveotrasobservaciones')+'?idHistorialClinico='+";
        // line 366
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"), "html", null, true);
        echo "+'&indicaciones_medicas='+\$('#examen_gabinete').val()+'&campo=examenGabinete',
                        async: false,
                        dataType: 'json',
                        timeout: 8000, // 8 sec
                        success: function(data) {
                            if (data.success){
                            //showDialogMsg('Guardado', 'La informacion de Indicaciones Médicas y Recomendaciones se ha guardado.', 'dialog-success');
                            }
                            else{
                            showDialogMsg('Error...', 'Hubo un error al intentar guardar el registro de Examenes de Gabinete. Por favor, Intente nuevamente.', 'dialog-error');
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                        console.error('Hubo un error al intentar realizar el registro de Examenes de Gabinete.\\nDetalle del Error: textStatus: ' + textStatus + ', errorThrown: ' + errorThrown);
                                showDialogMsg('Error...', 'Hubo un error al intentar realizar el registro de Examenes de Gabinete. Por favor, Intente nuevamente.', 'dialog-error');
                        }
                    });
                });

            \$(\"#plan_ingreso\").on('change', function(){
                    jQuery.ajax({
                           url: Routing.generate('saveotrasobservaciones')+'?idHistorialClinico='+";
        // line 387
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"), "html", null, true);
        echo "+'&indicaciones_medicas='+\$('#plan_ingreso').val()+'&campo=planIngreso',
                            async: false,
                            dataType: 'json',
                            timeout: 8000, // 8 sec
                            success: function(data) {
                                if (data.success){
                                //showDialogMsg('Guardado', 'La informacion de Indicaciones Médicas y Recomendaciones se ha guardado.', 'dialog-success');
                                }
                                else{
                                showDialogMsg('Error...', 'Hubo un error al intentar guardar el registro de Examenes de Gabinete. Por favor, Intente nuevamente.', 'dialog-error');
                                }
                            },
                            error: function(xhr, textStatus, errorThrown) {
                            console.error('Hubo un error al intentar realizar el registro de Examenes de Gabinete.\\nDetalle del Error: textStatus: ' + textStatus + ', errorThrown: ' + errorThrown);
                                    showDialogMsg('Error...', 'Hubo un error al intentar realizar el registro de Examenes de Gabinete. Por favor, Intente nuevamente.', 'dialog-error');
                            }
                        });
                    });
                \$('#grupo_dispensarial').select2({
                        allowClear: true,
                        placeholder: 'Seleccione el grupo dispensarial del paciente',
                        dropdownAutoWidth: true
                });

                \$('#grupo_dispensarial').select2('val', '";
        // line 411
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdGrupoDispensarial", array(), "method"), "getId", array(), "method"), "html", null, true);
        echo "');
                \$('#establecimiento').on('change', function() {//Dependiendo del establecimiento selecionado muestra las areas de atencion
                        var resultadoExterno;
                        \$('#especialidad').empty();
                        if (\$('#establecimiento').val()) {
                            var idEstablecimientoLocal = ";
        // line 416
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEstablecimiento"), "html", null, true);
        echo ";
                            var idEstablecimientoSelect = \$('#establecimiento').val();
                            if (idEstablecimientoLocal == idEstablecimientoSelect){//Establecimiento selecionado igual que el local
                                consultaEspeLocalConf(); //llama a funcion que muestra los establecimientos configurados localmente
                        }
                        else{
                            consultaEspeExterno();
                        }
                }});

                        function consultaEspeLocalConf() {
                        jQuery.ajax({
                        url: Routing.generate('especialidadesConfiguradas') + '?idEstablecimiento=";
        // line 428
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEstablecimiento"), "html", null, true);
        echo "&idHistorialClinico=";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"), "html", null, true);
        echo "' ,
                                async: true,
                                dataType: 'json',
                                timeout: 8000, // 8 sec
                                success: function(data) {
                                if (data.success){
                                jQuery.each(data.especialidades, function(indice, val) {
                                \$('#especialidad').append('<option value=\"' + val['id'] + '\">' + val['nombre'] + '</option>');
                                });
                                        \$('#especialidad').prepend('<option/>')
                                        .val(function () {
                                        return \$('[selected]', this).val();
                                        })
                                        .select2({
                                        placeholder: 'Seleccionar Especialidad ...',
                                                allowClear: true,
                                                dropdownAutoWidth: true
                                        });
                                        \$('#idEnviar').val('FALSE');
                                }
                                else{
                                showDialogMsg('Error...', 'Hubo un error al intentar consultar . Por favor, Intente nuevamente.', 'dialog-error');
                                }
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                console.error('Hubo un error al intentar realizar el registro de Examenes de Gabinete.\\nDetalle del Error: textStatus: ' + textStatus + ', errorThrown: ' + errorThrown);
                                        showDialogMsg('Error...', 'Hubo un error al intentar realizar el registro de Examenes de Gabinete. Por favor, Intente nuevamente.', 'dialog-error');
                                }
                        });
                        }

                function consultaEspeExterno() {
                        //var path = \"";
        // line 460
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("mespecialidades", array("establecimiento" => "selectedId", "host" => (isset($context["global_host"]) ? $context["global_host"] : $this->getContext($context, "global_host")), "method" => (isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")))), "html", null, true);
        echo "\";
                        var path=\"";
        // line 461
        echo $this->env->getExtension('routing')->getUrl("especialidadesLocales");
        echo "?idHistorialClinico=";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"), "html", null, true);
        echo "&idEstablecimiento=\"+\$('#establecimiento').val();
                        jQuery.ajax({
                                url: path,
                                async: true,
                                dataType: 'json',
                                timeout: 8000, // 8 sec
                                success: function(data) {
                                if (data.success){
                                    jQuery.each(data.atenciones, function(indice, val) {
                                      \$('#especialidad').append('<option value=\"' + val.id + '\">' + val.nombre + '</option>');
                                    });
                                    \$('#especialidad').prepend('<option/>').val(function () {
                                              return \$('[selected]', this).val();
                                    }).select2({
                                      placeholder: 'Seleccionar Especialidad ...',
                                      allowClear: true,
                                      dropdownAutoWidth: true
                                    });
                                    \$('#idEnviar').val('FALSE');
                                }
                                else{
                                    showDialogMsg('Error...', 'Hubo un error al intentar consultar . Por favor, Intente nuevamente.', 'dialog-error');
                                    }
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                console.error('Hubo un error .\\nDetalle del Error: textStatus: ' + textStatus + ', errorThrown: ' + errorThrown);
                                        showDialogMsg('Error...', 'Hubo un error.', 'dialog-error');
                                }
                        });
                }

                function consultaEspeLocal() {
                jQuery.ajax({
                url: Routing.generate('especialidadesLocales'),
                        async: true,
                        dataType: 'json',
                        timeout: 8000, // 8 sec
                        success: function(data) {
                        if (data.success){
                        jQuery.each(data.atenciones, function(indice, val) {
                        \$('#especialidad').append('<option value=\"' + val.id + '\">' + val.nombre + '</option>');
                        });
                                \$('#especialidad').prepend('<option/>')
                                .val(function () {
                                return \$('[selected]', this).val();
                                })
                                .select2({
                                placeholder: 'Seleccionar Especialidad ...',
                                        allowClear: true,
                                        dropdownAutoWidth: true
                                });
                                \$('#idEnviar').val('FALSE');
                        }
                        else{
                        showDialogMsg('Error...', 'Hubo un error al intentar consultar . Por favor, Intente nuevamente.', 'dialog-error');
                        }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                        console.error('Hubo un error al intentar realizar el registro de Examenes de Gabinete.\\nDetalle del Error: textStatus: ' + textStatus + ', errorThrown: ' + errorThrown);
                                showDialogMsg('Error...', 'Hubo un error al intentar realizar el registro de Examenes de Gabinete. Por favor, Intente nuevamente.', 'dialog-error');
                        }
                });
                }

                \$(\"#generar-referencia\").on(\"click\", function () {
                        var especialidad = \$('#especialidad').val();
                        var establecimiento = \$('#establecimiento').val();
                        var valEnviar = \$('#idEnviar').val();
                        if ((establecimiento && especialidad)) {
                        var parameters = ";
        // line 530
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                        var winParams = [];
                        if (1 == 1) {
                                var path = \"";
        // line 533
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_secremisionpaciente_createsolo", array("idhistoria" => $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idHistorialClinico"), "estadoEnviar" => "env", "idespe" => "elespe", "idestable" => "elestable")), "html", null, true);
        echo "\";
                                var url = path;
                                var url = path.replace('env', valEnviar);
                                var url = url.replace('elespe', especialidad);
                                var url = url.replace('elestable', establecimiento);
                                var nurl = url;
                        } else {
                            var path = \"";
        // line 540
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_secremisionpaciente_createespe", array("idhistoria" => $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idHistorialClinico"), "idespe" => "elespe", "idestable" => "elestable")), "html", null, true);
        echo "\";
                                    var url = path.replace('elespe', especialidad);
                                    var nurl = url.replace('elestable', establecimiento);
                }
                        winParams['method'] = \"post\";
                        winParams['action'] = nurl;
                        winParams['target'] = \"Remision de Paciente\";
                        winParams['parameters'] = parameters;
                        openPostPopUpWindows(winParams);
                } else {
                        var title = 'Dato incompleto!!!';
                        var body = '<p><span class=\"fa fa-warning\"></span> \\
                                                Debe de seleccionar un <b>establecimiento</b> y una <b>especialidad</b> antes de generar una referencia';
                        var clase = 'dialog-warning';
                        showDialogMsg(title, body, clase);
                }
                });


                \$(\"#imprimir-referencia-interconsulta\").on(\"click\", function () {
                ";
        // line 560
        if ((!(null === (isset($context["referencias"]) ? $context["referencias"] : $this->getContext($context, "referencias"))))) {
            // line 561
            echo "                    var parameters = ";
            echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
            echo ";
                            var winParams = [];
                            var path = \"";
            // line 563
            echo $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_secremisionpaciente_referencia_reporte");
            echo "\";
                            winParams['method'] = \"post\";
                            winParams['action'] = path;
                            winParams['target'] = \"Remision de Paciente\";
                            winParams['parameters'] = parameters;
                            openPostPopUpWindows(winParams);";
        }
        // line 569
        echo "                    });
                var idReferenciasImpresion = [];//Se utiliza para selecionar los medicamentos a los cuales se les imprimira receta
                \$(\"body\").on('ifChecked', \"input[id^='seleccionarReferencia_']\", function () {//Si se han selecionado que se impriman todas las recetas se seleciona una por una
                        var item = \$(this);
                        var valores = item.attr('id').split('_');
                        var id = valores[1];
                        var winParams = [];
                        idReferenciasImpresion.push(id);
                });

                \$(\"body\").on('ifUnchecked', \"input[id^='seleccionarReferencia_']\", function () {//Si se han selecionado que se impriman todas las recetas se seleciona una por una
                    var item = \$(this);
                    var valores = item.attr('id').split('_');
                    var id = valores[1];
                    var index = idReferenciasImpresion.indexOf(id); //idsmedicamento es una variable global de tipo array que tiene los id de los medicamentos que se agregan a la receta
                    idReferenciasImpresion.splice(index, 1);
                });
                \$(\"span[id^='imprimir-referencia']\").on(\"click\", function () {
                    if (idReferenciasImpresion.length != 0) {//Pregunta si el array que contiene los id de las recetas esta vacio
                        var resultado = \$(this).attr('id').split('_');
                        var parameters = ";
        // line 589
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                        var winParams = [];
                        var path = \"";
        // line 591
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_secremisionpaciente_referencia_reporte");
        echo "\";
                        winParams['method'] = \"post\";
                        winParams['action'] = path;
                        winParams['target'] = \"Remision de Paciente\";
                        winParams['parameters'] = {'idRemision': idReferenciasImpresion,'idHistorialClinico':";
        // line 595
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"), "html", null, true);
        echo "};//Se envia un array que contiene las recetas ya sea una, varias o todas
                        openPostPopUpWindows(winParams);
                     }else {
                        showDialogMsg('Referencias', 'Por favor selecionar la(s) referencias a imprimir', 'dialog-info');
                     }
                });

                \$(\"#imprimir-historia-clincia\").on(\"click\", function () {
                    var parameters = ";
        // line 603
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                    var winParams = [];
                    var path = \"";
        // line 605
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_imprimir_historia_clinica", array("id" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"))), "html", null, true);
        echo "\";
                    winParams['method'] = \"post\";
                    winParams['action'] = path;
                    winParams['target'] = \"Remision de Paciente\";
                    winParams['parameters'] = parameters;
                    openPostPopUpWindows(winParams);
                });
        });

        function editAdvise(id){
            var historyStatus = ";
        // line 615
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstadoHistoriaClinica", array(), "method"), "getId", array(), "method"), "html", null, true);
        echo ";

            if( ( historyStatus < 4 ) || ( historyStatus >= 4 && jQuery('#advise' + id).attr('recently-added') == \"true\" ) ){

                jQuery('#adviseText'+id).hide();
                jQuery('#adviseEditButton'+id).hide();
                jQuery('#adviseText'+id).after('<textarea id=\"adviseEditArea\" class=\"form-control\">' + jQuery('#adviseText'+id).text() + '</textarea>');
                jQuery('#adviseEditButton'+id).after('<button type=\"button\" class=\"btn btn-success btn-xs\" id=\"adviseUpdateButton\" onClick=\"updateAdvise(' + id + ');\"><span class=\"glyphicon glyphicon-floppy-disk\" aria-hidden=\"true\"></span> Guardar</button>\\
                                                      <button type=\"button\" class=\"btn btn-danger btn-xs\" id=\"cancelAdviseUpdateButton\" onClick=\"cancelAdviceUpdate(' + id + ');\"><span class=\"glyphicon glyphicon-ban-circle\" aria-hidden=\"true\"></span> Cancelar</button>\\
                                                    ');
                jQuery('#adviseEditArea').focus();
                jQuery('button[id^=\"adviseEditButton\"]').attr('disabled','disabled');

            }
            else{
                showDialogMsg('Acción no permitida.','No puede editar la consejería debido a que la consula ya ha sido finalizada.', 'dialog-error');
            }
        }

        function updateAdvise(id){
            if( jQuery('#adviseText'+id).text() != jQuery('#adviseEditArea').val() ){
                if( jQuery('#adviseEditArea').val() && (jQuery('#adviseEditArea').val()).replace(/\\s+/g, '') != ''){

                    jQuery('#cancelAdviseUpdateButton').after('<span id=\"waitUpdate\"><img src=\"/bundles/minsalsiaps/imagenes/wait_icon1.gif\" alt=\"wait\" width=\"20\" height=\"20\" style=\"margin-left: 20px;\"> Actualizando...</span>');
                    jQuery.ajax({
                        url: Routing.generate('updateadvise') + '?idHistorialClinico='+";
        // line 640
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"), "html", null, true);
        echo " + '&adviseId=' + id +'&consejo=' + jQuery('#adviseEditArea').val() + '&idEmpleado=' + ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEmpleado"), "html", null, true);
        echo ",
                        async: false,
                        dataType: 'json',
                        timeout: 8000, // 8 sec
                        success: function(data) {
                            if (data.success){
                                jQuery('#adviseText'+id).text( jQuery('#adviseEditArea').val() );
                                cancelAdviceUpdate(id);
                                jQuery('#adviseEditButton'+id).after('<span id=\"updateAdviseOk\" style=\"margin-left: 20px; color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6;\"><i class=\"fa fa-fw fa-check-circle\"></i><strong> Actualizado correctamente </strong></span>');
                                autoDismissElement(jQuery('#updateAdviseOk'), 'fade', null, false);
                            }
                            else{
                                showDialogMsg('Error...', 'Hubo un error al intentar realizar el registro de Consejeria. Por favor, Intente nuevamente.', 'dialog-error');
                            }
                            jQuery('#waitUpdate').remove();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            jQuery('#waitUpdate').remove();
                            console.error('Hubo un error al intentar actualizar la Consejeria.\\nDetalle del Error: textStatus: '+textStatus+', errorThrown: '+errorThrown);
                            showDialogMsg('Error...', 'Hubo un error al intentar actualizar la Consejeria. Por favor, Intente nuevamente.', 'dialog-error');
                        }
                    });

                }
                else{
                    showDialogMsg('Consejo no especificado', 'Por favor, especifíque el Consejo que esta brindando.', 'dialog-error', null, [ { text: 'Cerrar', click: function(){ \$(this).dialog(\"close\"); jQuery('#adviseEditArea').focus(); } } ], false );
                }
            }
            else{
                cancelAdviceUpdate(id);
            }
        }

        function cancelAdviceUpdate(id){
            jQuery('#adviseText'+id).show();
            jQuery('#adviseEditButton'+id).show();
            jQuery('#adviseEditArea').remove();
            jQuery('#adviseUpdateButton').remove();
            jQuery('#cancelAdviseUpdateButton').remove();
            jQuery('button[id^=\"adviseEditButton\"]').removeAttr('disabled');
        }

        function reloadPage() {
            var navegador = getCurrentBrowser();
            if (navegador.indexOf(\"Chrome\") >= 0){
                //alert( 'Chrome' );
                jQuery('form').attr('action', \"";
        // line 686
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_seguimiento_consulta", array("idHistorialClinico" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"))), "html", null, true);
        echo "\");
                jQuery('form').append('<input name=\"reload\" id=\"reload\" type=\"hidden\" value=\"true\"/>');
                jQuery('form').submit();
            }else{
                //alert( 'Firefox' );
                window.location = \"";
        // line 691
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_seguimiento_consulta", array("idHistorialClinico" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"))), "html", null, true);
        echo "\";
            }
        }

        jQuery(document).ready(function (\$) {
            ";
        // line 696
        if ($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "solicitudEstudio"), "setFalseHistoryId")) {
            // line 697
            echo "
                var arrayBtns =
                    [{
                        text: 'Verificar', click: function() {
                            jQuery( this ).dialog( \"close\" );
                            \$('#verifySecSolicitudMatch').click();
                        }
                    }];

                showDialogMsg('¡ Atención !', 'Se ha encontrado una Solicitud de Examenes registrada que <b>coincide</b> con la <b>Fecha</b> indicada, <b>Expediente</b>, <b>Médico</b> y <b>Especialidad</b> actual.', 'dialog-info', '', arrayBtns, false, 500, true, false, false);

                modal_elements.push({
                    id: 'verifySecSolicitudMatch',
                    func: 'setSecSolicitudMatchToModal',
                    header: 'Detalles de la Solicitud de Examenes Encontrada',
                    footer: '<button id=\"confirmSecSolicitudMatchBtn\" value=\"true\" onClick=\"confirmSecSolicitudMatch(";
            // line 712
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"), "html", null, true);
            echo ",";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "solicitudEstudio"), "falseHistory"), "getId", array(), "method"), "html", null, true);
            echo ")\" class=\"btn btn-success\"><span class=\"label\"><span class=\"glyphicon glyphicon-plus-sign\"></span> Confirmar</span></button>',
                    widthModal: 850,
                    parameters: '',
                    closeBtn: false,
                    closeXBtn: false
                });

            ";
        }
        // line 720
        echo "        });

        function confirmSecSolicitudMatch(currentHistoryId, falseHistoryId){

            jQuery('#confirmSecSolicitudMatchBtn').hide().after('<span id=\"waitUpdate\"><img src=\"/bundles/minsalsiaps/imagenes/wait_icon1.gif\" alt=\"wait\" width=\"20\" height=\"20\" style=\"margin-left: 20px;\"> Asociando...</span>');
            jQuery.ajax({
                url: Routing.generate('confirmsecsolicitudmatch') + '?currentHistoryId='+currentHistoryId + '&falseHistoryId=' + falseHistoryId,
                async: false,
                dataType: 'json',
                timeout: 8000, // 8 sec
                success: function(data) {
                    jQuery('#waitUpdate').remove();
                    if (data.success){
                        jQuery('#myModal').modal('hide');
                        showAutoDismissMsg('Se han aplicado los cambios!', 'success', 'large');
                    }
                    else{
                        jQuery('#confirmSecSolicitudMatchBtn').show();
                        showDialogMsg('Error...', 'Hubo un error al intentar realizar la actualización. Por favor, Intente nuevamente. Si el problema persiste, contacte con el Administrador.', 'dialog-error');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    jQuery('#waitUpdate').remove();
                    jQuery('#confirmSecSolicitudMatchBtn').show();
                    console.error('Hubo un error al intentar asociar la Solicitud.\\nDetalle del Error: textStatus: '+textStatus+', errorThrown: '+errorThrown);
                    showDialogMsg('Error...', 'Hubo un error al intentar asociar la Solicitud. Por favor, Intente nuevamente. Si el problema persiste, contacte con el Administrador.', 'dialog-error');
                }
            });
        }

        function setSecSolicitudMatchToModal(){

            return 'La siguiente Solicitud de Examenes será asociada a la Historia Clínica actual:<br/><br/>'+jQuery('#secSolicitudMatch').html();
        }

    </script>
";
    }

    // line 757
    public function block_sonata_breadcrumb($context, array $blocks = array())
    {
    }

    // line 759
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 761
    public function block_form($context, array $blocks = array())
    {
        // line 762
        echo "<form
    ";
        // line 763
        if (($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "form_type"), "method") == "horizontal")) {
            echo "class=\"form-horizontal\"";
        }
        // line 764
        echo "    role=\"form\"
    method=\"POST\"
    action=\"";
        // line 766
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "cerrar_consulta", 1 => array("idHistorialClinico" => $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idHistorialClinico"))), "method"), "html", null, true);
        echo "\"
    ";
        // line 767
        if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
            echo "novalidate=\"novalidate\"";
        }
        // line 768
        echo "    >
    <input type=\"hidden\" name=\"idEnviar\" id=\"idEnviar\" value=\"\">
    <div class=\"row\">
        <div class=\"";
        // line 771
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class"), "col-md-12")) : ("col-md-12")), "html", null, true);
        echo "\">
            <div class=\"box box-success\">
                <div class=\"box-body\">
                    <div class=\"sonata-ba-collapsed-fields\">
                        ";
        // line 775
        $this->env->loadTemplate("MinsalSiapsBundle:MntPacienteAdmin:encabezado_paciente.html.twig")->display($context);
        // line 776
        echo "                        ";
        $this->env->loadTemplate("MinsalSeguimientoBundle:SecHistorialClinico:consultar_historial.html.twig")->display($context);
        // line 777
        echo "                        <br/>
                        <table class=\"vista_paciente padding-table\" border=\"0\" width=\"100%\">
                            <tr class=\"titulo_vista\">
                                <td colspan=\"4\"><li class=\"fa fa-calendar\"></li> <b>Seguimiento de Consulta</b></td>
                            </tr>
                            <tr><td colspan=\"4\" style=\"border-bottom: 2px solid #ffffff;\"><label>Asignar Cita:</label></td></tr>
                            <tr>
                                <td colspan=\"4\">
                                    <div class=\"col-md-4\" align=\"center\">
                                        <a href=\"#\" id=\"asignar-cita-control\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Asignación de Cita de Control\">
                                            <li class=\"fa fa-stethoscope\"></li>Cita de Control
                                        </a>
                                    </div>
                                    <div class=\"col-md-4\" align=\"center\">
                                        <a href=\"#\" id=\"asignar-cita-seguimiento\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Asignación de Cita de Seguimiento\">
                                            <li class=\"fa fa-clipboard\"></li>Cita de Seguimiento
                                        </a>
                                    </div>
                                    <div class=\"col-md-4\" align=\"center\">
                                        <a href=\"#\" id=\"asignar-cita-procedimiento\" class=\"btn btn-app btn-group disabled\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Asignación de Cita de Procedimiento\">
                                            <li class=\"fa fa-list-alt\"></li>Cita de Procedimiento
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table class=\"vista_paciente padding-table\" border=\"0\" width=\"100%\">
                            <tr class=\"titulo_vista\">
                                <td colspan=\"4\"><b><i class=\"fa fa-fw fa-medkit\"></i> Plan de Atención</b></td>
                            </tr>
                            <tr>
                                <td width=\"30%\"><label>Solicitud de Medicamentos a Farmacia:</label></td>
                                <td colspan=\"3\">
                                    <a href=\"#\" id=\"recetario\" style=\"min-height: 72px;\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Recetario de Consulta Externa\">
                                        <li class=\"fa fa-clipboard\"></li><span>Recetario<br/>Consulta Externa</span>
                                    </a>

                            </tr>
                            <tr>
                                <td width=\"30%\"><label>Recomendaciones Relacionadas con el Tratamiento:</label></td>
                                <td colspan=\"3\">
                                    ";
        // line 819
        $context["indicacionObservacion"] = "";
        // line 820
        echo "                                    ";
        if ((twig_length_filter($this->env, (isset($context["SecOtrasObservaciones"]) ? $context["SecOtrasObservaciones"] : $this->getContext($context, "SecOtrasObservaciones"))) > 0)) {
            // line 821
            echo "                                        ";
            $context["indicacionObservacion"] = $this->getAttribute((isset($context["SecOtrasObservaciones"]) ? $context["SecOtrasObservaciones"] : $this->getContext($context, "SecOtrasObservaciones")), "indicacionObservacion");
            // line 822
            echo "                                    ";
        }
        // line 823
        echo "                                    <textarea id=\"indicaciones_medicas\" class=\" form-control\" name=\"indicaciones_medicas\">";
        echo twig_escape_filter($this->env, (isset($context["indicacionObservacion"]) ? $context["indicacionObservacion"] : $this->getContext($context, "indicacionObservacion")), "html", null, true);
        echo "</textarea>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <table class=\"vista_paciente padding-table\" border=\"0\" width=\"100%\">
                            <tr class=\"titulo_vista\">
                                <td colspan=\"4\"><b><i class=\"fa fa-fw fa-ambulance\"></i> Plan de Ingreso o Tratamiento</b></td>
                            </tr>
                            <tr>
                                <td width=\"30%\"><label>Detalle:</label></td>
                                <td colspan=\"3\">
                                    ";
        // line 835
        $context["planIngreso"] = "";
        // line 836
        echo "                                    ";
        if ((twig_length_filter($this->env, (isset($context["SecOtrasObservaciones"]) ? $context["SecOtrasObservaciones"] : $this->getContext($context, "SecOtrasObservaciones"))) > 0)) {
            // line 837
            echo "                                        ";
            $context["planIngreso"] = $this->getAttribute((isset($context["SecOtrasObservaciones"]) ? $context["SecOtrasObservaciones"] : $this->getContext($context, "SecOtrasObservaciones")), "planIngreso");
            // line 838
            echo "                                    ";
        }
        // line 839
        echo "                                    <textarea id=\"plan_ingreso\" class=\" form-control\" name=\"plan_ingreso\">";
        echo twig_escape_filter($this->env, (isset($context["planIngreso"]) ? $context["planIngreso"] : $this->getContext($context, "planIngreso")), "html", null, true);
        echo "</textarea>
                                </td>
                            </tr>
                        </table>
                        <table class=\"vista_paciente padding-table\" border=\"0\" width=\"100%\">
                            <tr class=\"titulo_vista\">
                                <td colspan=\"5\"><b><i class=\"fa fa-fw fa-warning\"></i> Consejería</b></td>
                            </tr>
                            <tr>
                                <td colspan=\"5\">
                                    <div class=\"container-fluid\">
                                        <div class=\"row\">
                                            <div class=\"col-md-1\">
                                                <label>Tipo de Consejería:</label>
                                            </div>
                                            <div class=\"col-md-3\">
                                                <select id=\"tipoConsejeria\" class=\"form-control\" name=\"tipoConsejeria\">
                                                    ";
        // line 856
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "tipoConsejeria"));
        foreach ($context['_seq'] as $context["_key"] => $context["tipoC"]) {
            // line 857
            echo "                                                        <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tipoC"]) ? $context["tipoC"] : $this->getContext($context, "tipoC")), "getId", array(), "method"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tipoC"]) ? $context["tipoC"] : $this->getContext($context, "tipoC")), "getNombre", array(), "method"), "html", null, true);
            echo "</option>
                                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipoC'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 859
        echo "                                                </select>
                                            </div>
                                            <div class=\"col-md-1\">
                                                <label>Consejo:</label>
                                            </div>
                                            <div class=\"col-md-5\">
                                                <textarea id=\"consejeria\" style=\"max-width: 100%;\" rows=\"2\" class=\" form-control\" name=\"consejeria\">";
        // line 865
        echo "</textarea>
                                            </div>
                                            <div class=\"col-md-2\">
                                                <button type=\"button\" class=\"btn btn-primary\" id=\"btn-add-advise\" style=\"min-width: 70%;\"><span class=\"fa fa-plus\"></span> Guardar Consejo</button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td id=\"advisesDiv\" colspan=\"5\" style=\"text-align: center;\">
                                    ";
        // line 876
        if ($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "consejeriaBrindada")) {
            // line 877
            echo "                                        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "consejeriaBrindada"));
            foreach ($context['_seq'] as $context["_key"] => $context["consejo"]) {
                // line 878
                echo "                                            <blockquote id=\"advise";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getId", array(), "method"), "html", null, true);
                echo "\" class=\"advise-block\" advise-type=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdTipoConsejeria", array(), "method"), "getId", array(), "method"), "html", null, true);
                echo "\" recently-added=\"false\">
                                                <p class=\"text-";
                // line 879
                if (($this->getAttribute($this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdTipoConsejeria", array(), "method"), "getId", array(), "method") == 1)) {
                    echo "green";
                } elseif (($this->getAttribute($this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdTipoConsejeria", array(), "method"), "getId", array(), "method") == 2)) {
                    echo "yellow";
                } else {
                    echo "light-blue";
                }
                echo "\">
                                                    <b>";
                // line 880
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdTipoConsejeria", array(), "method"), "getNombre", array(), "method"), "html", null, true);
                echo "</b>&nbsp;&nbsp;&nbsp;<button type=\"button\" class=\"btn btn-primary btn-xs\" id=\"adviseEditButton";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getId", array(), "method"), "html", null, true);
                echo "\" onClick=\"editAdvise(";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getId", array(), "method"), "html", null, true);
                echo ");\" advise-type=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdTipoConsejeria", array(), "method"), "getId", array(), "method"), "html", null, true);
                echo "\"><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span> Editar</button>
                                                </p>
                                                <span id=\"adviseText";
                // line 882
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getId", array(), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getConsejo", array(), "method"), "html", null, true);
                echo "</span>
                                                <small>Brindada por: ";
                // line 883
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdEmpleado", array(), "method"), "html", null, true);
                echo "</small>
                                            </blockquote>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['consejo'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 886
            echo "                                    ";
        }
        // line 887
        echo "                                </td>
                            </tr>
                        </table>
                        <br/>
                        <a href=\"#myModal\" id=\"verifySecSolicitudMatch\" custom-modal=\"true\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\" style=\"display: none;\"></a>
                        <div id=\"secSolicitudMatch\" style=\"display: none;\">
                            ";
        // line 893
        if ($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "solicitudEstudio"), "setFalseHistoryId")) {
            // line 894
            echo "                                ";
            $this->env->loadTemplate("MinsalLaboratorioBundle:Custom:SecSolicitudestudios/body_solicitudestudio.html.twig")->display($context);
            // line 895
            echo "                            ";
        }
        // line 896
        echo "                        </div>
                        <table class=\"vista_paciente padding-table\" border=\"0\" width=\"100%\">
                            <tr class=\"titulo_vista\">
                                <td colspan=\"4\"><b><i class=\"fa fa-fw fa-flask\"></i> Solicitud Estudios</b></td>
                            </tr>
                            <tr>
                                <td width=\"30%\"><label>Servicio de Apoyo:</label></td>
                                <td colspan=\"3\">
                                    <select id=\"servicio_apoyo\">
                                        <option value=\"1\">Laboratorio</option>
                                        <option value=\"2\">Imagenología</option>
                                    </select>
                                    <button type=\"button\" class=\"btn btn-primary\" id=\"btn-solicitud-estudios\" style=\"margin-left: 25px;\"><span class=\"fa fa-file-text\"></span> Crear Solicitud</button>
                                </td>

                            </tr>
                            <tr>
                                <td width=\"30%\"><label>Procedimientos:</label></td>
                                <td colspan=\"3\"> <select id=\"procedimientos\">
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width=\"30%\"><label>Examenes de Gabinete:</label></td>
                                <td colspan=\"3\">
                                    ";
        // line 921
        $context["examenGabinete"] = "";
        // line 922
        echo "                                    ";
        if ((twig_length_filter($this->env, (isset($context["SecOtrasObservaciones"]) ? $context["SecOtrasObservaciones"] : $this->getContext($context, "SecOtrasObservaciones"))) > 0)) {
            // line 923
            echo "                                        ";
            $context["examenGabinete"] = $this->getAttribute((isset($context["SecOtrasObservaciones"]) ? $context["SecOtrasObservaciones"] : $this->getContext($context, "SecOtrasObservaciones")), "examenGabinete");
            // line 924
            echo "                                    ";
        }
        // line 925
        echo "                                    <textarea id=\"examen_gabinete\" class=\" form-control\" name=\"examen_gabinete\">";
        echo twig_escape_filter($this->env, (isset($context["examenGabinete"]) ? $context["examenGabinete"] : $this->getContext($context, "examenGabinete")), "html", null, true);
        echo "</textarea>
                                </td>
                            </tr>
                        </table>
                        <br/>
                        <div class=\"table-responsive\">
                            <table class=\"vista_paciente padding-table\" border=\"0\" width=\"100%\">
                                <tr class=\"titulo_vista\">
                                    <td colspan=\"4\"><b><i class=\"fa fa-fw fa-share-square-o\"></i> Referencia, Interconsulta, Retorno</b></td>
                                </tr>
                                <tr>
                                    <td colspan=\"3\">
                                        <div class=\"container-fluid\">
                                            <div class=\"row\"  style=\"margin-bottom: 5px;\">
                                                <div class=\"col-md-2\" align=\"center\"><label>Establecimiento:</label> </div>
                                                <div class=\"col-md-10\" align=\"left\">
                                                    ";
        // line 941
        if (array_key_exists("establecimientos", $context)) {
            // line 942
            echo "                                                        <select id=\"establecimiento\" class=\"full-width\">
                                                            ";
            // line 943
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["establecimientos"]) ? $context["establecimientos"] : $this->getContext($context, "establecimientos")));
            foreach ($context['_seq'] as $context["_key"] => $context["esta"]) {
                // line 944
                echo "                                                                <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["esta"]) ? $context["esta"] : $this->getContext($context, "esta")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["esta"]) ? $context["esta"] : $this->getContext($context, "esta")), "nombre"), "html", null, true);
                echo "</option>
                                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['esta'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 946
            echo "                                                        </select>
                                                    ";
        }
        // line 948
        echo "                                                </div>
                                            </div>
                                            <div class=\"row\">
                                                <div class=\"col-md-2\" align=\"center\"><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Especialidad:</label></div>
                                                <div class=\"col-md-10\" align=\"left\">
                                                    <select id=\"especialidad\" class=\"full-width\"></select>
                                                </div>
                                                <!-- <div class=\"col-md-2\" align=\"center\">
                                                </div> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td style=\"width: 163px;\">
                                        <button type=\"button\" class=\"btn btn-primary\" id=\"generar-referencia\" style=\"\"><span class=\"fa fa-hospital-o\"></span> Generar Referencia</button>
                                    </td>
                                </tr>
                                ";
        // line 964
        if ((!twig_test_empty((isset($context["referencias"]) ? $context["referencias"] : $this->getContext($context, "referencias"))))) {
            // line 965
            echo "                                    <tr>
                                        <td colspan=\"4\">
                                            <div class=\"container-fluid\">
                                                <div class=\"row\">
                                                    <div class=\"col-md-11 col-xs-11\">
                                                    </div>
                                                    <div class=\"col-md-1 col-xs-1\">
                                                        <span class=\"glyphicon glyphicon-print mouse-pointer\" id=\"imprimir-referencia\" style=\"font-size:20px;\" role=\"print\"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=\"container-fluid\">
                                                ";
            // line 977
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["referencias"]) ? $context["referencias"] : $this->getContext($context, "referencias")));
            foreach ($context['_seq'] as $context["_key"] => $context["referencia"]) {
                // line 978
                echo "                                                    <div class=\"row\">
                                                        <div class=\"col-md-11 col-xs-11\">
                                                            <blockquote class=\"advise-block\">
                                                                <p class=\"text-green\">
                                                                    <b>";
                // line 982
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["referencia"]) ? $context["referencia"] : $this->getContext($context, "referencia")), "codigo"), "html", null, true);
                echo "</b>

                                                                </p>
                                                                <strong>Tipo de Remisión:</strong>";
                // line 985
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["referencia"]) ? $context["referencia"] : $this->getContext($context, "referencia")), "idTipoRemision"), "html", null, true);
                echo "<br/>
                                                                <strong>Motivo de Remisión: </strong>";
                // line 986
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["referencia"]) ? $context["referencia"] : $this->getContext($context, "referencia")), "idMotivoRemision"), "html", null, true);
                echo "<br/>
                                                                <strong>Especialidad a la que se refiere: </strong>";
                // line 987
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["referencia"]) ? $context["referencia"] : $this->getContext($context, "referencia")), "idAtencionDestino"), "html", null, true);
                echo "<br/>
                                                                <strong>Establecimiento al que refiere: </strong>";
                // line 988
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["referencia"]) ? $context["referencia"] : $this->getContext($context, "referencia")), "idEstablecimientoDestino"), "html", null, true);
                echo "<br/>
                                                                <small>Fecha de Remisión: ";
                // line 989
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["referencia"]) ? $context["referencia"] : $this->getContext($context, "referencia")), "fechaRemision"), "d-m-Y"), "html", null, true);
                echo "</small>
                                                            </blockquote>
                                                        </div>
                                                        <div class=\"col-md-1 col-xs-1\">
                                                            <input type=\"checkbox\" id=\"seleccionarReferencia_";
                // line 993
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["referencia"]) ? $context["referencia"] : $this->getContext($context, "referencia")), "id"), "html", null, true);
                echo "\"/>
                                                        </div>
                                                    </div>
                                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['referencia'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 997
            echo "                                            </div>
                                        </td>
                                    </tr>
                                ";
        }
        // line 1001
        echo "                            </table>
                        </div>
                        <br/>
                        <table class=\"vista_paciente padding-table\" border=\"0\" width=\"100%\">
                            <tr class=\"titulo_vista\">
                                <td colspan=\"4\"><li class=\"fa fa-print\"></li> <b>Impresiones</b></td>
                            </tr>
                            <!--tr><td colspan=\"4\" style=\"border-bottom: 2px solid #ffffff;\"><label>Imprimir:</label></td></tr-->
                            <tr>
                                <td colspan=\"4\">
                                    <div class=\"row\" style=\"margin-left: 0; margin-right: 0;\">
                                        <div class=\"col-md-12\"><span><b>Comprobantes de Cita:</b></span></div>
                                    </div>
                                    <div class=\"row\" style=\"margin-left: 0; margin-right: 0;\">
                                        <div class=\"col-md-4\" align=\"center\">
                                            <a href=\"#\" id=\"comprobante-cita-control\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Imprimir Comprobante de Cita de Control\" target=\"_blank\">
                                                <div class=\"multiple-icons\">
                                                    <li class=\"fa fa-calendar\"></li>
                                                    <li class=\"fa fa-stethoscope\"></li>
                                                </div>Cita de Control
                                            </a>
                                        </div>
                                        <div class=\"col-md-4\" align=\"center\">
                                            <a href=\"#\" id=\"comprobante-cita-seguimiento\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Imprimir Comprobante de Cita de Seguimiento\" target=\"_blank\">
                                                <div class=\"multiple-icons\">
                                                    <li class=\"fa fa-calendar\"></li>
                                                    <li class=\"fa fa-clipboard\"></li>
                                                </div>Cita de Seguimiento
                                            </a>
                                        </div>
                                        <div class=\"col-md-4\" align=\"center\">
                                            <a href=\"#\" id=\"comprobante-cita-procedimiento\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Imprimir Comprobante de Cita de Procedimiento\" target=\"_blank\">
                                                <div class=\"multiple-icons\">
                                                    <li class=\"fa fa-calendar\"></li>
                                                    <li class=\"fa fa-list-alt\"></li>
                                                </div>Cita de Procedimiento
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=\"4\">
                                    <div class=\"row\" style=\"margin-left: 0; margin-right: 0;\">
                                        <div class=\"col-md-12\"><span><b>De la Historia Clinica:</b></span></div>
                                    </div>
                                    <div class=\"row\" style=\"margin-left: 0; margin-right: 0;\">
                                        <div class=\"col-md-3\" align=\"center\">
                                            <a href=\"#\" id=\"imprimir-recetas\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Imprimir Recetas\">
                                                <li class=\"fa fa-medkit\"></li>Recetas
                                            </a>
                                        </div>
                                        <div class=\"col-md-3\" align=\"center\">
                                            <a href=\"#\" id=\"imprimir-solicitud-estudios\" style=\"min-height: 72px;\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Imprimir Solicitud Estudios\">
                                                <li class=\"fa fa-file-text-o\"></li>&nbsp;&nbsp;Solicitud de&nbsp;&nbsp;&nbsp;<br/> Estudios
                                            </a>
                                        </div>
                                        <div class=\"col-md-3\" align=\"center\">
                                            <a href=\"#\" id=\"imprimir-referencia-interconsulta\" style=\"min-height: 72px;\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Imprimir Referencias o Interconsultas\">
                                                <li class=\"fa fa-hospital-o\"></li>Referencias<br/>o Interconsultas
                                            </a>
                                        </div>
                                        <div class=\"col-md-3\" align=\"center\">
                                            <a href=\"#\" id=\"imprimir-historia-clincia\" style=\"min-height: 72px;\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Imprimir Historia Clinica\">
                                                <!-- <li class=\"fa fa-user-md\"></li> -->
                                                <span class=\"glyphicon glyphicon-file\" aria-hidden=\"true\"></span>&nbsp;&nbsp;&nbsp;&nbsp;Historia&nbsp;&nbsp;&nbsp;&nbsp;<br/>Clinica
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=\"4\">
                                    <div class=\"row\" style=\"margin-left: 0; margin-right: 0;\">
                                        <div class=\"col-md-12\"><span><b>Otros Formularios:</b></span></div>
                                    </div>
                                    <div class=\"row\" style=\"margin-left: 0; margin-right: 0;\">
                                        <div class=\"col-md-3\" align=\"center\">
                                            <a href=\"#\" id=\"imprimir-fvih01\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Imprimir FVIH01\">
                                                <li class=\"fa fa-user-md\"></li>FVIH01
                                            </a>
                                        </div>

                                        <div class=\"col-md-3\" align=\"center\">
                                            <a href=\"#\" id=\"imprimir-vigepes01\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Imprimir VIGEPES-01\">
                                                <li class=\"fa fa-user-md\"></li>VIGEPES-01
                                            </a>
                                        </div>

                                        <div class=\"col-md-3\" align=\"center\">
                                            <a href=\"#\" id=\"imprimir-vigepes02\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Imprimir VIGEPES-02\">
                                                <li class=\"fa fa-user-md\"></li>VIGEPES-02
                                            </a>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ";
        // line 1106
        $this->displayBlock('formactions', $context, $blocks);
        // line 1111
        echo "</form>
";
    }

    // line 1106
    public function block_formactions($context, array $blocks = array())
    {
        // line 1107
        echo "        <div class=\"well well-small form-actions\">
            <input class=\"btn btn-primary\" type=\"submit\" value=\"Finalizar Consulta\"/>
        </div>
    ";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecHistorialClinico:finalizar_consulta.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1577 => 1107,  1574 => 1106,  1569 => 1111,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1371 => 948,  1367 => 946,  1356 => 944,  1352 => 943,  1349 => 942,  1347 => 941,  1327 => 925,  1324 => 924,  1321 => 923,  1318 => 922,  1316 => 921,  1289 => 896,  1286 => 895,  1283 => 894,  1281 => 893,  1273 => 887,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 856,  1163 => 839,  1160 => 838,  1157 => 837,  1154 => 836,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1076 => 775,  1069 => 771,  1064 => 768,  1060 => 767,  1056 => 766,  1052 => 764,  1048 => 763,  1045 => 762,  1042 => 761,  1037 => 759,  1032 => 757,  992 => 720,  979 => 712,  962 => 697,  960 => 696,  952 => 691,  944 => 686,  893 => 640,  865 => 615,  852 => 605,  847 => 603,  836 => 595,  829 => 591,  824 => 589,  802 => 569,  793 => 563,  787 => 561,  785 => 560,  762 => 540,  752 => 533,  746 => 530,  672 => 461,  668 => 460,  631 => 428,  616 => 416,  608 => 411,  581 => 387,  557 => 366,  532 => 344,  485 => 304,  453 => 284,  425 => 259,  418 => 255,  407 => 247,  400 => 243,  389 => 235,  382 => 231,  371 => 223,  364 => 219,  353 => 211,  347 => 208,  337 => 201,  331 => 198,  307 => 177,  303 => 175,  299 => 174,  293 => 172,  291 => 171,  286 => 169,  271 => 157,  256 => 145,  232 => 123,  226 => 121,  224 => 120,  220 => 119,  210 => 118,  199 => 117,  193 => 116,  187 => 114,  181 => 112,  175 => 110,  172 => 109,  168 => 108,  147 => 90,  143 => 89,  139 => 88,  76 => 28,  71 => 27,  68 => 26,  62 => 23,  58 => 22,  53 => 21,  50 => 20,  44 => 16,  42 => 15,  39 => 12,  37 => 11,  34 => 8,  32 => 7,  30 => 5,);
    }
}
