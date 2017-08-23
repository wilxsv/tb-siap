<?php

/* MinsalCitasBundle:Custom:agenda.html.twig */
class __TwigTemplate_83f2d7e912693d6627f1e088da778450ab87f853ae116b8e23b9d9cf0aa7f520 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");

        $this->blocks = array(
            'sonata_header' => array($this, 'block_sonata_header'),
            'actions' => array($this, 'block_actions'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'notice' => array($this, 'block_notice'),
            'content' => array($this, 'block_content'),
            'sonata_page_content_nav' => array($this, 'block_sonata_page_content_nav'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 4
        $context["availableCitaIntegral"] = (((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method") || $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SONATA_ADMIN_CITCITASDIA_CITAINTEGRAL"), "method")) || $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "CITAINTEGRAL"), "method"))) ? (true) : (false));
        // line 5
        $context["availableCitaCreate"] = (((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method") || $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SONATA_ADMIN_CITCITASDIA_CREATE"), "method")) || $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "CREATE"), "method"))) ? (true) : (false));
        // line 6
        $context["availableTipoCita"] = (((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method") || $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SONATA_ADMIN_CITCITASDIA_MEDICO_EXCLUYENDO_TIPO_CITA"), "method")) || $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "ROLE_SONATA_ADMIN_CITCITASDIA_MEDICO_EXCLUYENDO_TIPO_CITA"), "method"))) ? (true) : (false));
        // line 7
        $context["availableEmpleadoEspecialidadList"] = ((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method") || $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SONATA_ADMIN_AGENDAMEDICA_EMPLEADO_ESPECIALIDAD_LIST"), "method"))) ? (true) : (false));
        // line 8
        $context["codigoEmpleado"] = (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true)) ? (twig_upper_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo"))) : ("N/A"));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 10
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 11
        echo "    ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == false)) {
            // line 12
            echo "        ";
            $this->displayParentBlock("sonata_header", $context, $blocks);
            echo "
    ";
        }
    }

    // line 16
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 19
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 20
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalcitas/css/CitasBundle.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 24
    public function block_javascripts($context, array $blocks = array())
    {
        // line 25
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    ";
        // line 26
        $this->env->loadTemplate("MinsalCitasBundle:Custom:agenda_dia.html.twig")->display($context);
        // line 27
        echo "    <script type=\"text/javascript\">
        var modal_elements = [];
        var cit_info = [];
        var clickDay;

        jQuery.fn.modal.Constructor.prototype.enforceFocus = function () {};

        function pushModalElement(newId, callFunction, parameters_func) {
            modalElmentFound = 0;
            if (modal_elements.length != 0) {
                for (var i in modal_elements) {
                    if (modal_elements[i].id == newId) {
                        modalElmentFound = modalElmentFound + 1;
                    }
                }
            }

            if (modalElmentFound == 0) {
                var foot = \"\";

                ";
        // line 47
        if ((isset($context["availableCitaCreate"]) ? $context["availableCitaCreate"] : $this->getContext($context, "availableCitaCreate"))) {
            // line 48
            echo "                    if (parameters_func.type == 4 || parameters_func.type == 5) {
                        foot = '<button id=\"cita_submit\" name=\"cita_submit\" value=\"cita_submit\" class=\"btn btn-primary\"><span class=\"label\"><span class=\"glyphicon glyphicon-plus-sign\"></span> Crear Cita</span></button>';
                    }
                ";
        }
        // line 52
        echo "
                modal_elements.push({
                    id:         newId,
                    func:       callFunction,
                    header:     'Agenda M&eacute;dica',
                    footer:     foot,
                    widthModal: '80%',
                    maxWidth:   '950px',
                    parameters: parameters_func
                });
            }
        }

        function updateMonthIformationCit() {
            var calendarDate = \$('#calendar-holder').fullCalendar('getDate');
            calendarDate.setHours(0, 0, 0, 0);
            var medicData = getMedicData();
            var momentDate = moment(calendarDate);
            jQuery.ajax({
                url: Routing.generate('citasdiaxmedico') + '?idEmpleado=' + medicData.idEmpleado + '&idEmpleadoEspecialidadEstab=' + medicData.idEmpleadoEspecialidadEstab + '&calendarDate=' + momentDate.format('YYYY-MM-DD'),
                async: false,
                dataType: 'json',
                success: function(data) {
                    cit_info[0] = data.data1;
                    cit_info[1] = data.data2;
                    cit_info[2] = data.data3;
                }
            });
        }

        function getIndexOfK(arr, date) {
            var date = moment(date);
            for (var i = 0; i < arr.length; i++) {
                var array_date = moment(arr[i].date, 'YYYY/MM/DD');
                // var array_date = new Date(arr[i].date + ' 00:00:00');   // YYYY/MM/DD formato soportado para FF, GC, y IC
                // if (date.getDate() === array_date.getDate() && date.getMonth() === array_date.getMonth() && date.getFullYear() === array_date.getFullYear()) {
                if ( date.format('DD/MM/YYYY') === array_date.format('DD/MM/YYYY') ) {
                    return i;
                }
            }
            return -1;
        }
    </script>
    <script type=\"text/javascript\">
        function agendaMedica(parameters) {
            ";
        // line 97
        $context["headerColSize"] = (((isset($context["availableCitaIntegral"]) ? $context["availableCitaIntegral"] : $this->getContext($context, "availableCitaIntegral"))) ? (3) : (4));
        // line 98
        echo "            var options      = {weekday: \"long\", year: \"numeric\", month: \"long\", day: \"numeric\"};
            var medicData    = getMedicData();
            var now          = moment();
            var clickedDay   = moment(clickDay);
            var citaIntegral = clickedDay.format('DD/MM/YYYY') === now.format('DD/MM/YYYY') ? 'true' : 'false';

            var header =
                '<div id=\"cm-modal\">'+
                    '<center>'+
                        '<div class=\"custom-modal-header\">'+
                            '<form id=\"cita_submit_form\" action=\"";
        // line 108
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create"), "method"), "html", null, true);
        echo "\" method=\"POST\">'+
                                '<div class=\"row\">'+
                                    '<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center\" style=\"margin: 10px 0px;\">'+
                                        medicData.nombreEmpleado + ', ' + parameters['date'].toLocaleString(\"es-SV\", options).replace(' 00:00:00 CST', '') +
                                    '</div>'+
                                '</div>'+
                                '<div class=\"row\">'+
                                    '<div class=\"row-height\">'+
                                        '<div class=\"col-xs-12 col-sm-6 col-md-";
        // line 116
        echo twig_escape_filter($this->env, (isset($context["headerColSize"]) ? $context["headerColSize"] : $this->getContext($context, "headerColSize")), "html", null, true);
        echo " col-lg-";
        echo twig_escape_filter($this->env, (isset($context["headerColSize"]) ? $context["headerColSize"] : $this->getContext($context, "headerColSize")), "html", null, true);
        if ((isset($context["availableCitaCreate"]) ? $context["availableCitaCreate"] : $this->getContext($context, "availableCitaCreate"))) {
            echo " col-md-height col-lg-height col-md-bottom col-lg-bottom";
        } else {
            echo " center-block";
        }
        echo "\" id=\"horario-atencion\">'+
                                        '</div>'+
                                        ";
        // line 118
        if ((isset($context["availableCitaCreate"]) ? $context["availableCitaCreate"] : $this->getContext($context, "availableCitaCreate"))) {
            // line 119
            echo "                                            '<div class=\"col-xs-12 col-sm-6 col-md-";
            echo twig_escape_filter($this->env, (isset($context["headerColSize"]) ? $context["headerColSize"] : $this->getContext($context, "headerColSize")), "html", null, true);
            echo " col-lg-";
            echo twig_escape_filter($this->env, (isset($context["headerColSize"]) ? $context["headerColSize"] : $this->getContext($context, "headerColSize")), "html", null, true);
            echo " col-md-height col-lg-height col-md-bottom col-lg-bottom\" id=\"num_exp_nom_paciente\">'+
                                            '</div>'+
                                            '<div class=\"col-xs-12 col-sm-6 col-md-";
            // line 121
            echo twig_escape_filter($this->env, (isset($context["headerColSize"]) ? $context["headerColSize"] : $this->getContext($context, "headerColSize")), "html", null, true);
            echo " col-lg-";
            echo twig_escape_filter($this->env, (isset($context["headerColSize"]) ? $context["headerColSize"] : $this->getContext($context, "headerColSize")), "html", null, true);
            echo " col-md-height col-lg-height col-md-bottom col-lg-bottom";
            if (((isset($context["availableTipoCita"]) ? $context["availableTipoCita"] : $this->getContext($context, "availableTipoCita")) == false)) {
                echo " hidden";
            }
            echo "\" id=\"tipo_cita\">'+
                                            '</div>'+
                                            ";
            // line 123
            if ((isset($context["availableCitaIntegral"]) ? $context["availableCitaIntegral"] : $this->getContext($context, "availableCitaIntegral"))) {
                // line 124
                echo "                                                '<div class=\"col-xs-12 col-sm-6 col-md-";
                echo twig_escape_filter($this->env, (isset($context["headerColSize"]) ? $context["headerColSize"] : $this->getContext($context, "headerColSize")), "html", null, true);
                echo " col-lg-";
                echo twig_escape_filter($this->env, (isset($context["headerColSize"]) ? $context["headerColSize"] : $this->getContext($context, "headerColSize")), "html", null, true);
                echo " col-md-height col-lg-height col-md-bottom col-lg-bottom\" id=\"citaIntegralTools\">'+
                                                '</div>'+
                                            ";
            } else {
                // line 127
                echo "                                                '<input type=\"hidden\" id=\"citaIntegral\" name=\"citaIntegral\" value=\"'+citaIntegral+'\">'+
                                            ";
            }
            // line 129
            echo "                                        ";
        }
        // line 130
        echo "                                    '</div>'+
                                '</div>'+
                                '<input type=\"hidden\" id=\"idEmpleado\" name=\"idEmpleado\" value=\"' + medicData.idEmpleado + '\" />'+
                                '<input type=\"hidden\" id=\"idEmpleadoEspecialidadEstab\" name=\"idEmpleadoEspecialidadEstab\" value=\"' + medicData.idEmpleadoEspecialidadEstab + '\" />'+
                                '<input type=\"hidden\" id=\"external\" name=\"external\" value=\"";
        // line 134
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external"), "html", null, true);
        echo "\" />'+
                                ";
        // line 135
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
            // line 136
            echo "                                    '<input type=\"hidden\" id=\"external_tipo\" name=\"external_tipo\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "tipo"), "html", null, true);
            echo "\" />'+
                                    '<input type=\"hidden\" id=\"external_modulo\" name=\"external_modulo\" value=\"";
            // line 137
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "modulo"), "html", null, true);
            echo "\" />'+
                                    '<input type=\"hidden\" id=\"idHistorialClinico\" name=\"idHistorialClinico\" value=\"";
            // line 138
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "secHistorialClinico"), "getId", array(), "method"), "html", null, true);
            echo "\" />'+
                                ";
        }
        // line 140
        echo "                                '<input type=\"hidden\" id=\"date\" name=\"date\" value=\"' + clickDay + '\" />'+
                            '</form>'+
                        '</div>'+
                    '</center>'+
                '<div>';

            if (\$('#cm-modal'.length != 0)) {
                \$('#cm-modal').remove();
            }

            \$('#myModalLabel').after(header);
            \$('#myModalLabel').css({'color': '#0088cc', 'font-weight': 'bold'});
            \$('#myModalLabel').css('text-align', 'center');
            \$('div.modal-body').css('background-color', '#f7f7f9');
            \$('div.modal-footer').css('background-color', '#ffffff');

            html = \"\";

            switch (parameters['type']) {
                case 1:
                    html = '<div class=\"alert alert-block alert-info\">\\
                                <h4>D&iacute;a No Disponible</h4>\\
                                El m&eacute;dico no posee un horario de atenci&oacute;n de pacientes para la fecha seleccionadad, motivo por el cual <b>no es posible asignar citas</b>...\\
                            </div>';
                    break;
                case 2:
                    html = '<div class=\"alert alert-block alert-info\">\\
                                <h4>D&iacute;a Bloqueado</h4>\\
                                <b>no es posible asignar citas</b>...\\
                            </div>';
                    html = parameters.posee_dist ? html + buildAgendaMedica(parameters) : html;
                    break;
                case 3:
                    html = '<div class=\"alert alert-block alert-warning\">\\
                                <h4>Dia Inhabilitado</h4>\\
                                Dia inhabilitado por las Fiestas, <b>no es posible asignar citas</b>...\\
                            </div>';
                    html = parameters.posee_dist ? html + buildAgendaMedica(parameters) : html;
                    break;
                case 4:
                    html = '<div class=\"alert alert-info\">\\
                                <b>Algunos horarios de atenci&oacute;n no estan disponibles debido a que han sido bloqueados por el m&eacute;dico</b>...\\
                            </div>';
                    html = html + buildAgendaMedica(parameters);
                    break;
                case 5:
                    html = buildAgendaMedica(parameters);
                    break;
                case 6:
                    html = '<div class=\"alert alert-block alert-info\">\\
                                <h4>Dia Inhabilitado</h4>\\
                                El dia seleccionado es anterior a la fecha actual, motivo por el cual <b>no es posible asignar citas</b>...\\
                            </div>';
                    html = parameters.posee_dist ? html + buildAgendaMedica(parameters) : html;
                    break;
            }
            return html;
        }


        function buildAgendaMedica(parameters) {
            var result = {};
            var medicData  = getMedicData();
            var momentDate = moment(parameters['date']);

            \$(\"#horario-atencion\").empty();
            \$(\"#horario-atencion\").append('Horario de Atencion de Pacientes<br /><select id=\"horarioMedico\" name=\"horarioMedico\"></select>');
            \$(\"#citaIntegralTools\").empty();
            \$(\"#citaIntegralTools\").append(
                'Cita Integral <span class=\"glyphicon glyphicon-info-sign fd_help_msg\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Cita Integral aplica cuando a un paciente se le quieren dar cita en más de una especialidad el mismo día.\"></span>'+
                ' <input type=\"checkbox\" id=\"citaIntegral\" name=\"citaIntegral\" value=\"false\">'
            );
            \$(\"#num_exp_nom_paciente\").empty();
            \$(\"#tipo_cita\").empty();
            \$(\"#tipo_cita\").append(
                'Tipo de Cita<br />'+
                '<select id=\"idTipoCita\" name=\"idTipoCita\">'+
                    '<option value=\"1\">Primera Vez</option>'+
                    '<option value=\"2\" selected=\"selected\">Subsecuente</option>'+
                '</select>'
            );

            \$horarioMedico = \$('#horarioMedico');
            \$horarioMedico.select2({
                allowClear: false,
                width: '100%'
            });

            \$idTipoCita = \$('#idTipoCita');
            \$idTipoCita.select2({
                allowClear: false,
                width: '100%'
            });

            ";
        // line 234
        if (((isset($context["availableCitaIntegral"]) ? $context["availableCitaIntegral"] : $this->getContext($context, "availableCitaIntegral")) == true)) {
            // line 235
            echo "                \$('#citaIntegral').iCheck({});
                initializeSwitchOnOff(\$('#citaIntegral'));

                \$('#citaIntegral').on('ifToggled', function() {
                    if( \$(this).prop('checked') ) {
                        \$(this).val('true');
                    } else {
                        \$(this).val('false');
                    }
                });
            ";
        }
        // line 246
        echo "
            ";
        // line 247
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
            // line 248
            echo "                \$(\"#num_exp_nom_paciente\").append('No. Expediente - Nombre Paciente<br /><input type=\"hidden\" id=\"numExpNomPac\" name=\"numExpNomPac\" style=\"width:203px !important;\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "secHistorialClinico"), "getIdExpediente", array(), "method"), "getId", array(), "method"), "html", null, true);
            echo "\" />\\
                    <label style=\"color:black !important;\">";
            // line 249
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "secHistorialClinico"), "getIdExpediente"), "getNumero", array(), "method") . " - ") . $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "secHistorialClinico"), "getIdExpediente"), "getIdPaciente", array(), "method"), "getNombrePaciente", array(), "method")), "html", null, true);
            echo "</label>');
            ";
        } else {
            // line 251
            echo "                \$(\"#num_exp_nom_paciente\").append('No. Expediente - Nombre Paciente<br /><input type=\"hidden\" id=\"numExpNomPac\" name=\"numExpNomPac\" style=\"width:203px !important;\"></input>');

                \$numExpNomPac = \$('#numExpNomPac');
                \$numExpNomPac.select2({
                    allowClear: true,
                    placeholder: 'Seleccionar...',
                    minimumInputLength: 1,
                    dropdownAutoWidth: true,
                    width: '100%',
                    ajax: {
                        url: Routing.generate('citasexpedientepaciente'),
                        dataType: 'json',
                        quietMillis: 1000,
                        data: function(term, page) {
                            return {
                                clue: term, //search term
                                page_limit: 10, // page size
                                page: page, // page number
                            };
                        },
                        results: function(data, page) {
                            var more = (page * 10) < data.data2;

                            return {results: data.data1, more: more};
                        }
                    },
                    sorter: function(results) {
                        var query = \$('.select2-search__field').val().toLowerCase();

                        return results.sort(function(a, b) {
                            return a.text.toLowerCase().indexOf(query) -
                            b.text.toLowerCase().indexOf(query);
                        });
                    }
                });
            ";
        }
        // line 287
        echo "
            var countHorario = 0;
            jQuery.ajax({
                url: Routing.generate('citashorariomedico') + '?idEmpleado=' + medicData.idEmpleado + '&idEmpleadoEspecialidadEstab=' + medicData.idEmpleadoEspecialidadEstab + '&date=' + parameters['mDate'].format('YYYY/MM/DD'),
                async: false,
                dataType: 'json',
                success: function(data) {
                    countHorario = 0;
                    \$.each(data.data1, function(indice, val) {
                        \$horarioMedico.append(\$('<option>', {value: val.id, text: val.rango_hora + ( val.id_tipo_distribucion ? ' - ' + val.nombre_tipo_distribucion : ''), 'data-cerrado': ( val.id_estado_distribucion === 2 ) }));
                        countHorario++;
                    });
                }
            });

            if(countHorario !== 0) {
                \$horarioMedico.select2('val', \$('#' + \$horarioMedico.attr('id') + ' option').eq(0).val());
                parameters['field'] = \$horarioMedico;
                parameters['idTipoCita'] = \$('#idTipoCita');
                parameters['url']   = Routing.generate('citasdetallehora') + '?idEmpleado=' + medicData.idEmpleado + '&idEmpleadoEspecialidadEstab=' + medicData.idEmpleadoEspecialidadEstab + '&date=' + parameters['mDate'].format('YYYY/MM/DD') + '&hora=' + parameters['field'].select2('val');

                result = buildDetailAgendaMedica(parameters);

                if(Object.keys(result).length === 0 || result.content === '') {
                    result.warningMessage = '';
                    result.content = '<div class=\"alert alert-block alert-error\">\\
                                                                <h4>Error al construir la agenda m&eacute;dica</h4>\\
                                                                Lo sentimos un error al construir el detalle de la agenda m&eacute;dica, por favor intentelo nuevamente, si el problema persiste contacte con el administrador del sistema...\\
                                                        </div>';
                }

                return '<div id=\"horario-cerrado-mensaje\"></div><div id=\"warning-message\">'+result.warningMessage+'</div><div id=\"info-message\"></div><div class=\"panel-primary-custom\"><div class=\"agendamd-content\">'+result.content+'</div></div>';
            }
            // else {
            //     \$horarioMedico.select2('enable', false);
            //
            //     return '<div id=\"warning-message\"></div>'+
            //             '<div id=\"info-message\">'+
            //             '<div class=\"alert alert-danger\" role=\"alert\">'+
            //                 '<i class=\"fa fa-times\"></i>'+
            //                 '<h3>Horarios no disponibles</h3>'+
            //                 'Lo sentimos no puede citar ningún paciente para el día seleccionado, debido a que no se encontró ningún horario disponible y esto puede ser debido a las siguientes razones:'+
            //                 '<ul>'+
            //                     '<li>Hay un error en la configuración de horarios utilizados en la distribución del médico.</li>'+
            //                     '<li>No existe al menos una distribución acitva para el médico, todas sus distribuciones se encuentran cerradas o no han sido configuradas.</li>'+
            //                 '</ul>'+
            //                 'Por favor contacte con el administrador.'+
            //                 ";
        // line 334
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SONATA_ADMIN_CITAMEDICAS"), "method") || $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "ROLE_SONATA_ADMIN_CITAMEDICAS"), "method"))) {
            // line 335
            echo "            //                     '<br/ ><br/ > <strong>Si desea ver las citas asigandas para el día seleccionado puede hacer click en el siguiente enlace: <a href=\"";
            echo $this->env->getExtension('routing')->getUrl("admin_minsal_citas_citcitasdia_citamedica_consulta");
            echo "?rangoFechas='+parameters['mDate'].format('DD/MM/YYYY')+' - '+parameters['mDate'].format('DD/MM/YYYY')+'&idAtenAreaModEstab='+medicData.idEmpleadoEspecialidadEstab+'\" target=\"_blank\"><i class=\"fa fa-search\"></i> Ver citas...</a></strong>'+
            //                 ";
        }
        // line 337
        echo "            //             '</div>'+
            //         '</div>'+
            //         '<div class=\"panel-primary-custom\">'+
            //             '<div class=\"agendamd-content\"></div>'+
            //         '</div>';
            // }
        }

        function validate_form() {
            var horario          = jQuery(\"#horarioMedico\");
            var expediente       = jQuery(\"#numExpNomPac\");
            var info_message     = jQuery(\"#info-message\");
            var date             = new Date();
            var hora             = formatTime_12_24(\"12\", date.getHours() + ':00:00');
            var medicData        = getMedicData();
            var error_message    = [];
            var error_string     = '';
            var citaExistente    = [];
            var citaDelMedico    = [];
            var max_agregados    = 0;
            var act_agregados    = 0;
            var horarioEvento    = [];
            var citasIntermedias = [];
            var bloqueLleno      = '';
            var ok               = false;
            var now              = moment();
            var clickedDay       = moment(clickDay);
            var horarioSplit     = horario.select2('data').text.split(' - ');
            var horaIni          = moment(clickedDay.format('DD/MM/YYYY')+' '+horarioSplit[0], 'DD/MM/YYYY hh:mm:ss A');
            var horaFin          = moment(clickedDay.format('DD/MM/YYYY')+' '+horarioSplit[1], 'DD/MM/YYYY hh:mm:ss A');
            var nombreTipoCita   = parseInt( \$('#idTipoCita').select2('val') ) === 1 ? 'de Primera Vez' : 'Subsecuentes';

            if(!horario.select2('data') || \$('#numExpNomPac').val() === \"\") {
                if(\$('#numExpNomPac').val() === \"\") {
                    error_message.push('<li>El campo <b>\"No. de Expediente - Nombre del Paciente\"</b>, no ha sido seleccionado.</li>');
                }

                if(!horario.select2('data')) {
                    error_message.push('<li>El horario no ha sido seleccionado.</li>');
                }
            } else {
                if( now.format('DD/MM/YYYY') === clickedDay.format('DD/MM/YYYY') ) {
                    // Es now > horaFin ?
                    if(now.diff(horaFin) > 0) {
                        var lastSchedule = ( jQuery('#'+horario.attr('id')+' option:last-child').text() === horario.select2('data').text ) ? true : false ;

                        if(!lastSchedule) {
                            error_message.push('<li>El horario seleccionado es anterior a la hora actual <b>'+now.format('hh:mm:ss A')+'</b>.</li>');
                        }
                    }
                }

                if( \$(\"body #horarioMedico option:selected\").attr('data-cerrado') === 'true' ) {
                    error_message.push('<li>El horario del médico ha sido cerrado, motivo por el cual <b>no es posible crear la cita</b></li>');
                }

                \$.ajax({
                    url:  Routing.generate(\"citasverificarevento\"),
                    async: false,
                    dataType: 'json',
                    data: {
                        idEmpleado: medicData.idEmpleado,
                        fecha:       clickedDay.format('DD/MM/YYYY'),
                        horaIni:     horarioSplit[0],
                        horaFin:     horarioSplit[1],
                    },
                    success: function(data) {
                        horarioEvento = data;
                    }
                });

                if(horarioEvento.length > 0 ) {
                    error_message.push('<li>El medico tiene un evento en el horario seleccionado, motivo por el cual <b>no es posible crear la cita</b></li>');
                }

                \$.ajax({
                    url:  Routing.generate(\"citas_verificar_cita_previa\"),
                    async: false,
                    dataType: 'json',
                    data: {
                        idEmpleado:     medicData.idEmpleado,
                        idEspecialidad: medicData.idEmpleadoEspecialidadEstab,
                        idExpediente:   ";
        // line 419
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
            echo "expediente.val()";
        } else {
            echo "expediente.select2('val')";
        }
        // line 420
        echo "                    },
                    success: function(data) {
                        if(Object.keys(data).length > 0) {
                            var citaDate = moment(data.fecha);

                            if(data.idEmpleado === medicData.idEmpleado) {
                                var fechaRegistro = moment(data.fechahorareg);

                                if(now.format('YYYY-MM-DD') !== fechaRegistro.format('YYYY-MM-DD')) {
                                    if( now.format('YYYY-MM-DD') !== clickedDay.format('YYYY-MM-DD') ) {
                                        error_message.push('<li>El paciente ya posee una cita con el Médico: <strong>'+data.nombreEmpleado+'</strong>, en la fecha: <strong>'+citaDate.format('DD/MM/YYYY')+'</strong> para la especialidad: <strong>'+data.nombreAtenAreaModEstab+'</strong>, la cita no se podrá mover a la nueva fecha debido que esto solo se puede realizar el mismo dia de su creación.</li>');
                                    }
                                }
                            } else {
                                error_message.push('<li>El paciente ya posee una cita con el Médico: <strong>'+data.nombreEmpleado+'</strong>, en la fecha: <strong>'+citaDate.format('DD/MM/YYYY')+'</strong> para la Especialidad: <strong>'+data.nombreAtenAreaModEstab+'</strong>, motivo por el cuál no es posible crear la cita.</li>');
                            }
                        }
                    }
                });

                \$.ajax({
                    url:  Routing.generate(\"citaspacienteposeecita\"),
                    async: false,
                    dataType: 'json',
                    data: {
                        idEmpleado:   medicData.idEmpleado,
                        idEspecialidad: medicData.idEmpleadoEspecialidadEstab,
                        idExpediente: ";
        // line 447
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
            echo "expediente.val()";
        } else {
            echo "expediente.select2('val')";
        }
        echo ",
                        fecha:        clickedDay.format('DD/MM/YYYY'),
                        citaIntegral: ( \$('#citaIntegral').attr('type') === 'checkbox' ? \$('#citaIntegral').val() : ( clickedDay.format('DD/MM/YYYY') === now.format('DD/MM/YYYY') ? 'true' : \$('#citaIntegral').val() ) )
                    },
                    success: function(data) {
                        citaExistente = data.data1;
                        citaDelMedico = data.data2;
                    }
                });

                if(citaExistente.length > 0 || citaDelMedico.length > 0) {
                    var msjError = \"\";

                    if(citaExistente.length > 1 || citaDelMedico.length > 1) {
                        msjError = 'El paciente ya posee citas en este dia en los siguientes horarios y especialidades:';
                    } else {
                        msjError = 'El paciente ya posee cita en este dia en el siguiente horario y especialidad:';
                    }

                    if(msjError !== '') {
                        msjError += '<ul>';
                    }

                    if(citaDelMedico.length > 0) {
                        for (var i = 0; i < citaDelMedico.length; i++) {
                            var cita = citaDelMedico[i];

                            if(cita.id_empleado == medicData.idEmpleado && cita.id_especialidad == medicData.idEmpleadoEspecialidadEstab ) {
                                if(cita.id_rangohora == horario.select2('val')) {
                                    msjError += '<li>hora: <b>'+cita.hora_ini+'</b> - Especialidad: <b>'+cita.nombre_especialidad+'</b></li>';
                                }
                            } else {
                                msjError += '<li>hora: <b>'+cita.hora_ini+'</b> - Especialidad: <b>'+cita.nombre_especialidad+'</b></li>';
                            }
                        }
                    }

                    if(citaExistente.length > 0) {
                        for (var i = 0; i < citaExistente.length; i++) {
                            var cita = citaExistente[i];

                            if(cita.id_empleado == medicData.idEmpleado && cita.id_especialidad == medicData.idEmpleadoEspecialidadEstab ) {
                                if(cita.id_rangohora == horario.select2('val')) {
                                    msjError += '<li>hora: <b>'+cita.hora_ini+'</b> - Especialidad: <b>'+( cita.clase_cita === 'citas_medica' ? cita.nombre_especialidad : cita.nombre_procedimiento )+'</b></li>';
                                }
                            } else {
                                msjError += '<li>hora: <b>'+cita.hora_ini+'</b> - Especialidad: <b>'+( cita.clase_cita === 'citas_medica' ? cita.nombre_especialidad : cita.nombre_procedimiento )+'</b></li>';
                            }
                        }
                    }

                    if(msjError !== '') {
                        msjError += '</ul>';

                        error_message.push(msjError);
                    }
                }

                \$.ajax({
                    url:  Routing.generate(\"citascomprobardisponibilidad\"),
                    async: false,
                    dataType: 'JSON',
                    data: {
                        idEmpleado:   medicData.idEmpleado,
                        especialidad: medicData.idEmpleadoEspecialidadEstab,
                        date:         clickDay,
                        idRangohora:  horario.select2('val'),
                        idTipoCita:   \$('#idTipoCita').select2('val')
                    },
                    success: function(data) {
                        max_agregados = data.data1.max_citas_agregadas;
                        act_agregados = data.data2;
                        bloqueLleno  = data.data3;
                    }
                });

                if(bloqueLleno == 'true') {
                    if(act_agregados >= max_agregados) {
                        if( now.format('YYYY-MM-DD') !== clickedDay.format('YYYY-MM-DD') ) {
                            error_message.push('<li><strong>Ya no hay cupos '+nombreTipoCita+' ni agregados disponibles para el dia y horario seleccionado</strong>, por favor intente en <b>otro horario o en otro dia</b></li>');
                        }
                    }
                }

                // Validacion de Dias intermedios entre citas
                if( now.format('DD/MM/YYYY') !== clickedDay.format('DD/MM/YYYY') ) {
                    \$.ajax({
                        url: Routing.generate(\"verificar_dias_intermedios\"),
                        async: false,
                        dataType: 'JSON',
                        data: {
                            fecha:        clickedDay.format('DD/MM/YYYY'),
                            idExpediente: ";
        // line 539
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
            echo "expediente.val()";
        } else {
            echo "expediente.select2('val')";
        }
        // line 540
        echo "                        },
                        success: function(data) {
                            citasIntermedias = data;
                        }
                    });

                    if(citasIntermedias.length > 0) {
                        error_message.push('<li>La cita no ha podido ser agendada debido a que <strong>el paciente posee cita dentro del rango de dias intermedios entre citas configurados</strong>, por favor seleccione otra fecha.</li>');
                    }
                }
            }

            if (error_message.length > 0) {
                info_message.empty();
                error_string = '<div class=\"alert alert-block alert-error\">\\
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>\\
                                    <h4>Error al crear la cita</h4>\\
                                    <ul>';
                for (var i = 0; i < error_message.length; i++) {
                    error_string = error_string + error_message[i];
                }
                error_string = error_string + '</ul></div>';

                info_message.empty();
                info_message.append(error_string);
            } else {
                if(bloqueLleno == 'true') {
                    var title = 'Confirmación de Creación';
                    var dialogClass = 'dialog-warning';
                    var msg = 'El <strong>límite de Pacientes '+nombreTipoCita+' ha sido sobrepasado</strong>, sin embargo el paciente puede agendarse como sobrecupo (Agregado).'+
                            '<br /><br />Para <strong>agendar el Paciente como sobrecupo (Agregado)</strong> por favor haga click sobre el Botón <strong>Confirmar</strong>.'+
                            ' Si desea <strong>cancelar la creación</strong> haga click sobre el botón <strong>Cancelar</strong>';
                    var width = 640;

                    var arrayBtns = [
                        {
                            text: 'Confirmar', click: function() {
                                \$(this).dialog('close');
                                \$('body form#cita_submit_form').submit();
                            }
                        },
                        {
                            text: 'Cancelar', click: function( event, ui) {
                                \$(this).dialog('close');
                            }
                        }
                    ];

                    showDialogMsg(title, msg, dialogClass, '', arrayBtns, false, width, true);
                } else {
                    ok = true;
                }
            }

            return ok;
        }

        jQuery(document).ready(function(\$) {
            \$('body').on('click','#cita_submit', function() {
                var status = validate_form();

                if(status) {
                    \$('body form#cita_submit_form').submit();
                }
            });

            if( \$('body #horarioMedico').select2('val') !== '' ) {
                if(\$(\"#horarioMedico option:selected\").attr('data-cerrado') === 'true') {
                    \$('body #cita_submit').addClass('hidden');
                }
            } else {
                \$('body #horarioMedico').select2('enable', false);
            }

            \$(\"body\").on('change', \"#horarioMedico\", function(e) {
                \$field = \$('#horarioMedico');
                var ag_content = {};
                var parameters = [];
                var now = moment().set({ 'hour': 0, 'minute': 0, 'second': 0, 'millisecond': 0 });
                var clickedDay = moment(clickDay).set({ 'hour': 0, 'minute': 0, 'second': 0, 'millisecond': 0 });

                parameters['field'] = \$field;
                parameters['date'] = clickDay;
                parameters['mDate'] = moment(clickDay);
                parameters['idTipoCita'] = \$('#idTipoCita');
                medicData = getMedicData();

                \$('div#info-message').empty();
                \$('#horario-cerrado-mensaje').empty();
                \$('div.agendamd-content').empty();
                \$('div.agendamd-content').append('<center><img id=\"wait\" src=\"";
        // line 630
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/wait_icon1.gif"), "html", null, true);
        echo "\" alt=\"wait\" width=\"24\" height=\"24\"><div id=\"search-message\">Buscando...</div></center>');

                if( \$(\"body #horarioMedico option:selected\").attr('data-cerrado') === 'true' && clickedDay.diff(now) >= 0 ) {
                    \$('#horario-cerrado-mensaje').append(
                        '<div class=\"alert alert-error\" role=\"alert\">'+
                            '<h3><strong>Horario Cerrado</strong></h3>'+
                            'Lo sentimos no es posible crear citas para el horario seleccionado debido a que el horario se encuentra cerrado. <strong>Para poder citar el paciente debe de seleccionar otro dia u horario</strong>.'+
                        '</div>'
                    );

                    \$('body #cita_submit').addClass('hidden');
                } else {
                    \$('body #cita_submit').removeClass('hidden');
                }

                if(\$(\"body #horarioMedico\").select2('val') !== '') {
                    setTimeout(function() {
                        parameters['url'] = Routing.generate('citasdetallehora') + '?idEmpleado=' + medicData.idEmpleado + '&idEmpleadoEspecialidadEstab=' + medicData.idEmpleadoEspecialidadEstab + '&date=' + parameters['mDate'].format('YYYY/MM/DD') + '&hora=' + parameters['field'].select2('val');
                        ag_content = buildDetailAgendaMedica(parameters);

                        if(Object.keys(ag_content).length === 0 || ag_content.content === '') {
                            ag_content.warningMessage = '';
                            ag_content.content = '<div class=\"alert alert-block alert-error\">\\
                                        <h4>Error al construir la agenda m&eacute;dica</h4>\\
                                        Lo sentimos, hubo un error al construir el detalle de la agenda m&eacute;dica, por favor intentelo nuevamente, si el problema persiste contacte con el administrador del sistema...\\
                                    </div>';
                        }

                        \$('div.agendamd-content').empty();
                        \$('div.agendamd-content').append(ag_content.content);
                        \$('div#warning-message').empty();
                        \$('div#warning-message').append(ag_content.warningMessage);
                    }, 500);
                } else {
                    \$('div.agendamd-content').empty();
                    \$('div.agendamd-content').append('<div class=\"alert alert-info\" role=\"alert\"><h5>Agenda sin horarios</h5> El detalle de la agenda no se puede mostrar debido a que no se han detectado horarios para el Médico y Especialidad</div>');
                }
            });

            \$('#calendar-holder').fullCalendar({
                header: {
                    left: 'prev, next,today',
                    center: 'title',
                    right: 'prevYear, nextYear'
                },
                lazyFetching: true,
                timeFormat: {
                    // for agendaWeek and agendaDay
                    agenda: 'h:mmt', // 5:00 - 6:30

                    // for all other views
                    '': 'h:mmt'            // 7p
                },
                buttonText: {
                    prev: 'Mes Anterior',
                    next: 'Mes Siguiente',
                    prevYear: 'Año Anterior',
                    nextYear: 'Año Siguiente',
                    today: 'Hoy'
                },
                buttonIcons: {
                    prev: 'left-single-arrow',
                    next: 'right-single-arrow',
                    prevYear: 'left-double-arrow',
                    nextYear: 'right-double-arrow'
                },
                ";
        // line 696
        if ((($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "month"), "method", true, true) && ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "month"), "method") != "")) && (!(null === $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "month"), "method"))))) {
            // line 697
            echo "                    month: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "month"), "method"), "html", null, true);
            echo ",
                ";
        }
        // line 699
        echo "                ";
        if ((($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "year"), "method", true, true) && ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "year"), "method") != "")) && (!(null === $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "year"), "method"))))) {
            // line 700
            echo "                    year: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "year"), "method"), "html", null, true);
            echo ",
                ";
        }
        // line 702
        echo "                dayRender: function(date, cell) {
                    var medicUser = '";
        // line 703
        if (((!$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true)) || (!($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")))) {
            echo "false";
        } else {
            echo "true";
        }
        echo "';
                    var renderCalendar = false;

                    if (medicUser == 'false') {
                        if (\$('#idEmpleado').select2('data') && \$('#idEmpleadoEspecialidadEstab').select2('data')) {
                            renderCalendar = true;
                        }
                    } else {
                        renderCalendar = true;
                    }

                    if (renderCalendar) {
                        var today = new Date();
                        date.setHours(0, 0, 0, 0);
                        var mDate = moment(date);
                        var mToday = moment();
                        today.setHours(0, 0, 0, 0);
                        var calendarDate = \$('#calendar-holder').fullCalendar('getDate');
                        calendarDate = new Date(calendarDate);
                        var lowerLimit = new Date(calendarDate.getFullYear(), calendarDate.getMonth(), 1);
                        var upperLimit = new Date(calendarDate.getFullYear(), calendarDate.getMonth() + 1, 0);
                        var cell_date  = date.getFullYear()+ '-' + ((parseInt(date.getMonth())+1) < 10 ? '0' + (parseInt(date.getMonth())+1) : '' + (parseInt(date.getMonth())+1)) + '-' + (date.getDate()  < 10 ? '0' + date.getDate()  : '' + date.getDate());
                        var primera_vez;
                        var subsecuentes;
                        var agregados;
                        var total_citas;
                        var atendidos;
                        var total_cupos;
                        var type;
                        var dateKey = mDate.format('YYYY/MM/DD');

                        if (cit_info != false && date >= lowerLimit && date <= upperLimit) {
                            index0 = getIndexOfK(cit_info[0], date);
                            index1 = cit_info[1][dateKey] !== undefined ? 1 : -1;
                            index2 = getIndexOfK(cit_info[2], date);

                            if(index0 > -1 && index1 > -1 && index2 > -1) {
                                total_citas  = cit_info[0][index0].total_citas;
                                atendidos    = cit_info[0][index0].atendidos;
                                total_cupos  = cit_info[0][index0].total_cupos;
                                primera_vez  = cit_info[0][index0].primera_vez;
                                subsecuentes = cit_info[0][index0].subsecuentes;
                                agregados    = cit_info[0][index0].agregados;
                                index1       = dateKey;

                                if (date >= lowerLimit && date < today) {
                                    if(cit_info[2][index2]['distribucion'] > 0) {
                                        if(cit_info[1][index1]['bloqueoTotalDia'] === true) {
                                            if(cit_info[1][index1]['idTipoEventoDia'] === 1) {
                                                type = 3;
                                            } else {
                                                type = 6;
                                            }
                                        } else {
                                            type = 6;
                                        }
                                    } else {
                                        if(cit_info[1][index1]['bloqueoTotalDia'] === true) {
                                            if(cit_info[1][index1]['idTipoEventoDia'] === 1) {
                                                type = 3;
                                            } else {
                                                type = 2;
                                            }
                                        } else {
                                            type = 1;
                                        }
                                    }

                                    // createCellContent(cell, [{
                                    //         'type': type,
                                    //         'total_citas': total_citas,
                                    //         'atendidos': atendidos,
                                    //         'cell_date': cell_date,
                                    //         'date': date,
                                    //         'before': true
                                    //     }]
                                    //         );
                                }

                                if( ( date > today && date >= lowerLimit && date <= upperLimit ) || ( mDate.format('YYYY/MM/DD') === mToday.format('YYYY/MM/DD') ) ) {

                                    if(cit_info[2][index2]['distribucion'] > 0) {
                                        if(cit_info[1][index1]['bloqueoTotalDia'] === true || cit_info[1][index1]['bloqueoParcialDia'] === true) {
                                            if(cit_info[1][index1]['bloqueoTotalDia'] === true) {
                                                if(cit_info[1][index1]['idTipoEventoDia'] == 1) {
                                                    type = 3;
                                                } else {
                                                    type = 2;
                                                }
                                            } else {
                                                type = 4;
                                            }
                                        } else {
                                            type = 5;
                                        }
                                    } else {
                                        if(cit_info[1][index1]['bloqueoTotalDia'] === true) {
                                            if(cit_info[1][index1]['idTipoEventoDia'] === 1 ) {
                                                type = 3;
                                            } else {
                                                type = 2;
                                            }
                                        } else {
                                            type = 1;
                                        }
                                    }

                                    // createCellContent(cell, [{
                                    //         'type': type,
                                    //         'primera_vez': primera_vez,
                                    //         'subsecuentes': subsecuentes,
                                    //         'total_citas': total_citas,
                                    //         'agregados': agregados,
                                    //         'cell_date': cell_date,
                                    //         'date': date,
                                    //         'mDate': mDate,
                                    //         'before': false
                                    //     }]
                                    // );
                                }

                                createCellContent(cell, [{
                                        'type'        : type,
                                        'primera_vez' : primera_vez,
                                        'subsecuentes': subsecuentes,
                                        'total_citas' : total_citas,
                                        'atendidos'   : atendidos,
                                        'total_cupos' : total_cupos,
                                        'agregados'   : agregados,
                                        'cell_date'   : cell_date,
                                        'date'        : date,
                                        'mDate'       : mDate,
                                        'posee_dist'  : ( cit_info[2][index2]['distribucion'] > 0 ),
                                        'before'      : false
                                    }]
                                );
                            }
                        }
                    }

                    if (cell.find(\"div.fc-custom-content-tb\").length == 0) {
                        cell.append('<div class=\"fc-custom-content-tb\"></div>');
                    }
                },
                dayClick: function(date, allDay, jsEvent, view) {
                    clickDay = date;
                },
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'],
                hiddenDays: [0, 6],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sab'],
                eventSources: [
                    {
                            url: Routing.generate('fullcalendar_loader'),
                        type: 'POST',
                        // A way to add custom filters to your event listeners
                        data: {
                        },
                        error: function() {
                            //alert('There was an error while fetching Google Calendar!');
                        }
                    }
                ]
            });

            /********************************************************************************************************
             * Creación del contenido de la celda (día) del calendario dependiendo del tipo de condicion que cumpla,*
             * los cuales se describen a continuacion:                                                              *
             * 1: Dia No Disponible- Debido a que el medico no posee una distribucion de horarios para esa fecha    *
             * 2: Dia Bloqueado    - El medico no posee distribucion y posee un evento de tipo personal para dicha  *
             *                       fecha                                                                          *
             * 3: Dia Festivo      - Dia inhabilitado debido a fiestas a nivel nacional aplica a todos los empleados*
             * 4: Bloqueo Parcial  - Si el medico tiene un evento personal y ha bloqueado ciertos horarios de aten- *
             *                       cion de pacientes, puede asignarse cita pero solo en los horarios disponibles. *
             * 5: Dia Habilitado   - Puese ser asignada la cita.                                                    *
             * 6: Dia Inhabilitado - No es posible asignar citas por que la fecha es anterior a la fecha actual.    *
             ********************************************************************************************************/
            function createCellContent(cell, parameters) {
                var now = moment();

                switch (parameters[0].type) {
                    case 1:
                        if (parameters[0].before) {
                            cell.css(\"background-color\", \"#E8F2FF\");
                        } else {
                            cell.css(\"background-color\", \"#DCFCE9\");
                        }
                        cell.append('<a href=\"#myModal\" id=\"citDay-' + parameters[0].cell_date + '_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
                                            <div class=\"fc-custom-content-tb\">\\
                                                    <div class=\"fc-custom-content\">\\
                                                            <div class=\"disabled-day\">DIA NO DISPONIBLE</div>\\
                                                    </div>\\
                                            </div>\\
                                    </a>');
                        break;
                    case 2:
                        if (parameters[0].before) {
                            cell.css(\"background-color\", \"#E8F2FF\");
                        } else {
                            cell.css(\"background-color\", \"#FFE7E7\");
                        }
                        cell.append('<a href=\"#myModal\" id=\"citDay-' + parameters[0].cell_date + '_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
                                            <div class=\"fc-custom-content-tb\">\\
                                                    <div class=\"fc-custom-content\">\\
                                                            <div class=\"locked-day\">DIA BLOQUEADO</div>\\
                                                    </div>\\
                                            </div>\\
                                    </a>');
                        break;
                    case 3:
                        cell.css(\"background-color\", \"#FFF1E1\");
                        cell.append('<a href=\"#myModal\" id=\"citDay-' + parameters[0].cell_date + '_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
                                            <div class=\"fc-custom-content-tb\">\\
                                                    <div class=\"fc-custom-content\">\\
                                                            <div class=\"festive-day\">DIA FESTIVO</div>\\
                                                    </div>\\
                                            </div>\\
                                    </a>');
                        break;
                    case 4:
                        cell.css(\"background-color\", \"#DCFCE9\");
                        cell.append('<a href=\"#myModal\" id=\"citDay-' + parameters[0].cell_date + '_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
                                        <div class=\"fc-custom-content-tb\">\\
                                                <div class=\"fc-custom-content\">\\
                                                    <div class=\"locked-day\">BLOQUEO PARCIAL</div><br />\\
                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">1er vez:</div>\\
                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + parameters[0].primera_vez + '</div>\\
                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">Subsecuentes:</div>\\
                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + parameters[0].subsecuentes + '</div>\\
                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled fc-cuscont-border\">Agregados:</div>\\
                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled fc-cuscont-border\">' + parameters[0].agregados + '</div>\\
                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">Total Citados:</div>\\
                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + parameters[0].total_citas + '</div>\\
                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">Cupos Disponibles:</div>\\
                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + (parameters[0].total_cupos-(parameters[0].primera_vez+parameters[0].subsecuentes)) + '</div>\\
                                            </div>\\
                                            </div>\\
                                    </a>');
                        break;
                    case 5:
                        cell.css(\"background-color\", \"#DCFCE9\");
                        cell.append('<a href=\"#myModal\" id=\"citDay-' + parameters[0].cell_date + '_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
                                        <div class=\"fc-custom-content-tb\">\\
                                                <div class=\"fc-custom-content\">\\
                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">1er vez:</div>\\
                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + parameters[0].primera_vez + '</div>\\
                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">Subsecuentes:</div>\\
                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + parameters[0].subsecuentes + '</div>\\
                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled fc-cuscont-border\">Agregados:</div>\\
                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled fc-cuscont-border\">' + parameters[0].agregados + '</div>\\
                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">Total Citados:</div>\\
                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + parameters[0].total_citas + '</div>\\
                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">Cupos Disponibles:</div>\\
                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + (parameters[0].total_cupos-(parameters[0].primera_vez+parameters[0].subsecuentes)) + '</div>\\
                                            </div>\\
                                            </div>\\
                                    </a>');
                        break;
                    case 6:
                        cell.css(\"background-color\", \"#E8F2FF\");
                        cell.append('<a href=\"#myModal\" id=\"citDay-' + parameters[0].cell_date + '_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
                                            <div class=\"fc-custom-content-tb\">\\
                                                    <div class=\"fc-custom-content\">\\
                                                            <div class=\"fc-cuscont-left fc-cuscont-disabled fc-cuscont-border\">Citados:</div>\\
                                                            <div class=\"fc-cuscont-right fc-cuscont-disabled fc-cuscont-border\">' + parameters[0].total_citas + '</div>\\
                                                            <div class=\"fc-cuscont-left fc-cuscont-disabled fc-cuscont-border\">Atendidos:</div>\\
                                                            <div class=\"fc-cuscont-right fc-cuscont-disabled fc-cuscont-border\">' + parameters[0].atendidos + '</div>\\
                                                    </div>\\
                                            </div>\\
                                    </a>');
                        break;
                }

                if( now.format('YYYY/MM/DD') === parameters[0]['mDate'].format('YYYY/MM/DD') ) {
                    cell.css(\"background-color\", \"#FEFFDB\");
                }

                pushModalElement('citDay-' + parameters[0].cell_date + '_modal', 'agendaMedica', parameters[0]);
            }
        });
    </script>
    <script type=\"text/javascript\">
        jQuery(document).ready(function(\$) {
            // initialize calendar first
        ";
        // line 988
        if ((isset($context["availableEmpleadoEspecialidadList"]) ? $context["availableEmpleadoEspecialidadList"] : $this->getContext($context, "availableEmpleadoEspecialidadList"))) {
            // line 989
            echo "                \$idEmpleado = \$('#idEmpleado');
                \$idEmpleadoEspecialidadEstab = \$('#idEmpleadoEspecialidadEstab');
                var superAdmin = '";
            // line 991
            if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "';

                \$idEmpleado.prepend('<option/>').val(function() {
                    return \$('[selected]', this).val();
                });
                \$idEmpleado.select2({
                    placeholder: 'Seleccionar Medico...',
                    allowClear: true,
                    width: '100%'
                });

                \$.ajax({
                    url: Routing.generate(\"citasgetmedico\"),
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        \$.each(data.data1, function(indice, val) {
                            if (superAdmin == 'true') {
                                \$idEmpleado.append( \$('<option>', {value: val.id, text: val.nombre, 'data-residente': val.residente} ) );
                            } else {
                                if(val.idEstablecimiento == ";
            // line 1011
            if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado")) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdEstablecimiento"), "getId"), "html", null, true);
            } else {
                echo "''";
            }
            echo ") {
                                    \$idEmpleado.append( \$('<option>', {value: val.id, text: val.nombre, 'data-residente': val.residente} ) );
                                }
                            }
                        });
                    }
                });

                \$idEmpleadoEspecialidadEstab.prepend('<option/>').val(function() {
                    return \$('[selected]', this).val();
                });
                \$idEmpleadoEspecialidadEstab.select2({
                    placeholder: 'Seleccionar Especialidad...',
                    allowClear: true,
                    width: '100%'
                });

                \$idEmpleado.on('change', function(e) {
                    \$idEmpleadoEspecialidadEstab.children().remove();

                    \$idEmpleadoEspecialidadEstab.prepend('<option/>').val(function() {
                        return \$('[selected]', this).val();
                    });
                    \$idEmpleadoEspecialidadEstab.select2({
                        placeholder: 'Seleccionar Especialidad...',
                        allowClear: true,
                        width: '100%'
                    });

                    if (e.val) {
                        empleadoChange(e.val);
                    }
                    updateCalendar();
                });

                \$idEmpleadoEspecialidadEstab.on('change', function(e) {
                    if (e.val) {
                        updateMonthIformationCit();
                    }
                    updateCalendar();
                });

            ";
            // line 1053
            if ((twig_length_filter($this->env, (isset($context["query"]) ? $context["query"] : $this->getContext($context, "query"))) > 0)) {
                // line 1054
                echo "                ";
                $context["setIdEmpleado"] = (($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "idEmpleado"), "method", true, true)) ? ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "idEmpleado"), "method")) : (""));
                // line 1055
                echo "                ";
                $context["setIdEspecialidad"] = (($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "idEspecialidad"), "method", true, true)) ? ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "idEspecialidad"), "method")) : (""));
                // line 1056
                echo "            ";
            } else {
                // line 1057
                echo "                ";
                $context["setIdEmpleado"] = ((((isset($context["codigoEmpleado"]) ? $context["codigoEmpleado"] : $this->getContext($context, "codigoEmpleado")) == "MED")) ? ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getId")) : (""));
                // line 1058
                echo "                ";
                $context["setIdEspecialidad"] = ((((isset($context["codigoEmpleado"]) ? $context["codigoEmpleado"] : $this->getContext($context, "codigoEmpleado")) == "MED")) ? ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idEmpEspecialidadEstab"), "method")) : (""));
                // line 1059
                echo "            ";
            }
            // line 1060
            echo "
            ";
            // line 1061
            if (((isset($context["setIdEmpleado"]) ? $context["setIdEmpleado"] : $this->getContext($context, "setIdEmpleado")) != "")) {
                // line 1062
                echo "                \$idEmpleado.select2('val', '";
                echo twig_escape_filter($this->env, (isset($context["setIdEmpleado"]) ? $context["setIdEmpleado"] : $this->getContext($context, "setIdEmpleado")), "html", null, true);
                echo "');
                empleadoChange('";
                // line 1063
                echo twig_escape_filter($this->env, (isset($context["setIdEmpleado"]) ? $context["setIdEmpleado"] : $this->getContext($context, "setIdEmpleado")), "html", null, true);
                echo "');
            ";
            }
            // line 1065
            echo "
            ";
            // line 1066
            if (((isset($context["setIdEspecialidad"]) ? $context["setIdEspecialidad"] : $this->getContext($context, "setIdEspecialidad")) != "")) {
                // line 1067
                echo "                \$idEmpleadoEspecialidadEstab.select2('val', '";
                echo twig_escape_filter($this->env, (isset($context["setIdEspecialidad"]) ? $context["setIdEspecialidad"] : $this->getContext($context, "setIdEspecialidad")), "html", null, true);
                echo "');
                updateMonthIformationCit();
            ";
            }
            // line 1070
            echo "        ";
        } else {
            // line 1071
            echo "                updateMonthIformationCit();
        ";
        }
        // line 1073
        echo "
                function empleadoChange(id) {
                    \$.ajax({
                        url: Routing.generate('citasgetmedicoespecialidadestab') + '?idEmpleado=' + id,
                        async: false,
                        dataType: 'json',
                        success: function(data) {
                            \$.each(data.result, function(indice, val) {
                                if (superAdmin == 'true') {
                                    \$idEmpleadoEspecialidadEstab.append(\$('<option>', {value: val.id, text: val.nombre}));
                                } else {
                                    if(val.idEstablecimiento == ";
        // line 1084
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method")) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "getIdEstablecimiento", array(), "method"), "getId", array(), "method"), "html", null, true);
        } else {
            echo "''";
        }
        echo ") {
                                        \$idEmpleadoEspecialidadEstab.append(\$('<option>', {value: val.id, text: val.nombre }));
                                    }
                                }
                            });
                        }
                    });
                }

                updateCalendar();

                //removiendo css
                \$('#calendar-holder .fc-week .fc-day.fc-first div:first-child').css('min-height', '');

                // Update the calendar when previous button is pressed
                \$('#calendar-holder .fc-button-prev').on('click', function() {
                    updateMonthIformationCit();
                    updateCalendar();
                });

                // Update the calendar when next button is pressed
                \$('#calendar-holder .fc-button-next').on('click', function() {
                    updateMonthIformationCit();
                    updateCalendar();
                });

                // Update the calendar when the today button is pressed
                \$('#calendar-holder .fc-button-today').on('click', function() {
                    updateMonthIformationCit();
                    updateCalendar();
                });

                \$('#calendar-holder .fc-button-prevYear').on('click', function() {
                    updateMonthIformationCit();
                    updateCalendar();
                });

                // Update the calendar when next button is pressed
                \$('#calendar-holder .fc-button-nextYear').on('click', function() {
                    updateMonthIformationCit();
                    updateCalendar();
                });


                function updateCalendar() {
                    modal_elements = [];
                    renderCalendar();
                    var calendarDate = \$('#calendar-holder').fullCalendar('getDate');
                    calendarDate.setHours(0, 0, 0, 0);

                    var currentDate = new Date();
                    currentDate.setHours(0, 0, 0, 0);

                    // Disable prev button for the past
                    // if (currentDate.getFullYear() == calendarDate.getFullYear() && currentDate.getMonth() == calendarDate.getMonth()) {
                    //     disablePrevMonthButton();
                    // } else {
                    //     enablePrevMonthButton();
                    // }

                    // Disable next button for 2 years from today
                    if (currentDate.getFullYear() + 2 == calendarDate.getFullYear() && currentDate.getMonth() == calendarDate.getMonth()) {
                        disableNextMonthButton();
                    } else {
                        enableNextMonthButton();
                    }

                    var limit = new Date(currentDate.getFullYear() + 1, currentDate.getMonth(), currentDate.getDate());
                    if (currentDate.getFullYear() == calendarDate.getFullYear() && currentDate.getMonth() == calendarDate.getMonth()) {
                        disablePrevYearButton();
                        enableNextYearButton();
                    } else if (currentDate.getFullYear() + 1 == calendarDate.getFullYear() && currentDate.getMonth() == calendarDate.getMonth()) {
                        enablePrevYearButton();
                        enableNextYearButton();
                    } else if (calendarDate < limit) {
                        disablePrevYearButton();
                        enableNextYearButton();
                    } else {
                        disableNextYearButton();
                        enablePrevYearButton();
                    }
                }

                function enablePrevMonthButton() {
                    \$(\"#calendar-holder .fc-button-prev\").removeClass('fc-state-disabled');
                }

                function disablePrevMonthButton() {
                    \$(\"#calendar-holder .fc-button-prev\").addClass('fc-state-disabled');
                }

                function enableNextMonthButton() {
                    \$(\"#calendar-holder .fc-button-next\").removeClass('fc-state-disabled');
                }

                function disableNextMonthButton() {
                    \$(\"#calendar-holder .fc-button-next\").addClass('fc-state-disabled');
                }

                function enablePrevYearButton() {
                    \$(\"#calendar-holder .fc-button-prevYear\").removeClass('fc-state-disabled');
                }

                function disablePrevYearButton() {
                    \$(\"#calendar-holder .fc-button-prevYear\").addClass('fc-state-disabled');
                }

                function enableNextYearButton() {
                    \$(\"#calendar-holder .fc-button-nextYear\").removeClass('fc-state-disabled');
                }

                function disableNextYearButton() {
                    \$(\"#calendar-holder .fc-button-nextYear\").addClass('fc-state-disabled');
                }

                \$(window).on('resize', function() {
                    renderCalendar();
                });

                function renderCalendar() {
                    \$('#calendar-holder').fullCalendar('render');
                    \$('#calendar-holder .fc-week .fc-day.fc-first div:first-child').css('min-height', '');
                    \$('#calendar-holder .fc-week .fc-day.fc-first div.fc-custom-content-tb').css('min-height', '');
                }
            });
    </script>
    <script type=\"text/javascript\">
        jQuery(document).ready(function(\$) {
            \$('span.fc-button-prev').prepend('<span class=\"glyphicon glyphicon-chevron-left\"></span> ')
            \$('span.fc-button-next').append(' <span class=\"glyphicon glyphicon-chevron-right\"></span>')

            \$('span.fc-button-prevYear').prepend('<span class=\"glyphicon glyphicon-chevron-left\"></span><span class=\"glyphicon glyphicon-chevron-left\"></span> ')
            \$('span.fc-button-nextYear').append(' <span class=\"glyphicon glyphicon-chevron-right\"></span><span class=\"glyphicon glyphicon-chevron-right\"></span>')
        });
    </script>
    ";
        // line 1219
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
            // line 1220
            echo "        <script type=\"text/javascript\">
            jQuery(document).ready(function(\$) {
                \$('#close-button').on('click', function() {
                    window.close();
                });

                ";
            // line 1226
            if ((($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "createdElement"), "method", true, true) && ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "createdElement"), "method") != "")) && (!(null === $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "createdElement"), "method"))))) {
                // line 1227
                echo "                    window.addEventListener(\"beforeunload\", function (e) {
                        if (window.opener != null && !window.opener.closed) {
                            try {
                                window.opener.updateIdCita(";
                // line 1230
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "createdElement"), "method"), "html", null, true);
                echo ", ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "tipo"), "html", null, true);
                echo ");
                            } catch (err) {
                                console.error(err.description || err) //or console.log or however you debug
                            }
                        }
                    });
                ";
            }
            // line 1237
            echo "            });
        </script>
    ";
        }
    }

    // line 1242
    public function block_notice($context, array $blocks = array())
    {
        // line 1243
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(array(0 => "success", 1 => "error", 2 => "info", 3 => "warning"));
        foreach ($context['_seq'] as $context["_key"] => $context["notice_level"]) {
            // line 1244
            echo "        ";
            $context["session_var"] = ("sonata_flash_" . (isset($context["notice_level"]) ? $context["notice_level"] : $this->getContext($context, "notice_level")));
            // line 1245
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "flashbag"), "get", array(0 => (isset($context["session_var"]) ? $context["session_var"] : $this->getContext($context, "session_var"))), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["flash"]) {
                // line 1246
                echo "            <div class=\"alert ";
                echo twig_escape_filter($this->env, ("alert-" . (isset($context["notice_level"]) ? $context["notice_level"] : $this->getContext($context, "notice_level"))), "html", null, true);
                echo "\">
                <center>";
                // line 1247
                echo $this->env->getExtension('translator')->trans((isset($context["flash"]) ? $context["flash"] : $this->getContext($context, "flash")), array(), "SonataAdminBundle");
                echo "</center>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flash'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1250
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notice_level'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    // line 1253
    public function block_content($context, array $blocks = array())
    {
        // line 1254
        echo "
    ";
        // line 1255
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"))) {
            // line 1256
            echo "        <div>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "</div>
    ";
        } else {
            // line 1258
            echo "        ";
            $this->displayBlock('sonata_page_content_nav', $context, $blocks);
            // line 1260
            echo "        ";
            if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
                // line 1261
                echo "            <div class=\"col-md-12 text-left\" style=\"margin-bottom: 20px; color: #367fa9; padding-left:45px;\">
        <button id=\"close-button\" class=\"btn btn-default pull-right\"><span class=\"fa fa-times-circle-o\"></span> ";
                // line 1262
                if ((($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "createdElement"), "method", true, true) && ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "createdElement"), "method") != "")) && (!(null === $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "createdElement"), "method"))))) {
                    echo "Cerrar";
                } else {
                    echo "Cancelar";
                }
                echo "</button>
            </div>
        ";
            }
            // line 1265
            echo "        <div class=\"col-md-3\">
            <div class=\"col-md-12\" style=\"margin-bottom: 20px;\">
                ";
            // line 1267
            if ((isset($context["availableEmpleadoEspecialidadList"]) ? $context["availableEmpleadoEspecialidadList"] : $this->getContext($context, "availableEmpleadoEspecialidadList"))) {
                // line 1268
                echo "                    <label class=\"col-md-12 label-filters\">Medico:</label>
                    <select id=\"idEmpleado\"></select>
                    <label class=\"col-md-12 label-filters\">Especialidad:</label>
                    <select id=\"idEmpleadoEspecialidadEstab\"></select>
                ";
            } else {
                // line 1273
                echo "                    ";
                if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
                    // line 1274
                    echo "                        <label class=\"col-md-12 label-filters\">Medico:</label>
                        <label class=\"col-md-12\" style=\"font-weight:bold;\">";
                    // line 1275
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntEmpleado"), "getNombreempleado", array(), "method"), "html", null, true);
                    echo "</label>
                        <label class=\"col-md-12 label-filters\">Especialidad:</label>
                        <label class=\"col-md-12\" style=\"font-weight:bold;\">";
                    // line 1277
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntAtenAreaModEstab"), "getNombreConsulta", array(), "method"), "html", null, true);
                    echo "</label>
                    ";
                } else {
                    // line 1279
                    echo "                        ";
                    if (((isset($context["codigoEmpleado"]) ? $context["codigoEmpleado"] : $this->getContext($context, "codigoEmpleado")) === "MED")) {
                        // line 1280
                        echo "                            <label class=\"col-md-12 label-filters\">Especialidad:</label>
                            <label class=\"col-md-12\" style=\"font-weight:bold;\">";
                        // line 1281
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_nombreEmpEspecialidadEstab"), "method"), "html", null, true);
                        echo "</label>
                        ";
                    } else {
                        // line 1283
                        echo "                            <label class=\"col-md-12 label-filters\">Medico:</label>
                            <select id=\"idEmpleado\"></select>
                            <label class=\"col-md-12 label-filters\">Especialidad:</label>
                            <select id=\"idEmpleadoEspecialidadEstab\"></select>
                        ";
                    }
                    // line 1288
                    echo "                    ";
                }
                // line 1289
                echo "                ";
            }
            // line 1290
            echo "            </div>
            <div class=\"col-md-12\" style=\"padding-top: 20px; border-top:1px solid #DDDDDD;\">
                <div class=\"accordion\" id=\"accordion2\" style=\"background-color:white;\">
                    <div class=\"accordion-group\">
                        <div class=\"accordion-heading\">
                            <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion2\" href=\"#collapseOne\">
                                <div style=\"font-size: 15px;font-weight:bold;\">Codigo de Colores</div>
                            </a>
                        </div>
                        <div id=\"collapseOne\" class=\"accordion-body collapse in\">
                            <div class=\"accordion-inner\">
                                <div style=\"text-align:left;\">
                                    <table>
                                        <tr><td style=\"background-color:#E8F2FF;width:16px;height:36px;\"></td><td style=\"padding-left:10px;border-bottom: 1px solid #DDDDDD;\">Dia anterior a la fecha actual</td></tr>
                                        <tr><td style=\"background-color:#FEFFDB;width:16px;height:36px;\"></td><td style=\"padding-left:10px;border-bottom: 1px solid #DDDDDD;\">Fecha Actual</td></tr>
                                        <tr><td style=\"background-color:#DCFCE9;width:16px;height:36px;\"></td><td style=\"padding-left:10px;border-bottom: 1px solid #DDDDDD;\">Dia posterior a la fecha actual</td></tr>
                                        <tr><td style=\"background-color:#FFF1E1;width:16px;height:36px;\"></td><td style=\"padding-left:10px;border-bottom: 1px solid #DDDDDD;\">Dia festivo</td></tr>
                                        <tr><td style=\"background-color:#FFE7E7;width:16px;height:36px;\"></td><td style=\"padding-left:10px;\">Dia bloqueado</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-md-9\">";
            // line 1316
            $this->env->loadTemplate("ADesignsCalendarBundle::calendar.html.twig")->display($context);
            echo "</div>
    ";
        }
    }

    // line 1258
    public function block_sonata_page_content_nav($context, array $blocks = array())
    {
        // line 1259
        echo "        ";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:Custom:agenda.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1275,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1569 => 1261,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1254,  1549 => 1253,  1541 => 1250,  1532 => 1247,  1527 => 1246,  1522 => 1245,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1316 => 1071,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1291 => 1062,  1289 => 1061,  1286 => 1060,  1283 => 1059,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1271 => 1055,  1268 => 1054,  1266 => 1053,  1217 => 1011,  1190 => 991,  1186 => 989,  1184 => 988,  892 => 703,  889 => 702,  883 => 700,  880 => 699,  874 => 697,  872 => 696,  803 => 630,  711 => 540,  705 => 539,  606 => 447,  577 => 420,  571 => 419,  487 => 337,  481 => 335,  479 => 334,  430 => 287,  392 => 251,  387 => 249,  382 => 248,  380 => 247,  377 => 246,  364 => 235,  362 => 234,  266 => 140,  261 => 138,  257 => 137,  252 => 136,  250 => 135,  246 => 134,  240 => 130,  237 => 129,  233 => 127,  224 => 124,  222 => 123,  211 => 121,  203 => 119,  201 => 118,  189 => 116,  178 => 108,  166 => 98,  164 => 97,  117 => 52,  111 => 48,  109 => 47,  87 => 27,  85 => 26,  80 => 25,  77 => 24,  71 => 21,  66 => 20,  63 => 19,  58 => 16,  50 => 12,  47 => 11,  44 => 10,  39 => 8,  37 => 7,  35 => 6,  33 => 5,  31 => 4,);
    }
}
