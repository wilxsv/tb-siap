<?php

/* MinsalCitasBundle:CitCitasProcedimientos:agenda.html.twig */
class __TwigTemplate_1ab98073518be6b621e9099b9b5265e1f6c3e868bc25309d60c4d1fc5b026ced extends Twig_Template
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
        $context["codigoEmpleado"] = (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true)) ? (twig_upper_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo"))) : ("N/A"));
        // line 5
        $context["superAdmin"] = $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method");
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 7
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 8
        echo "    ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == false)) {
            // line 9
            echo "        ";
            $this->displayParentBlock("sonata_header", $context, $blocks);
            echo "
    ";
        }
    }

    // line 13
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 16
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 17
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalcitas/css/CitasBundle.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 21
    public function block_javascripts($context, array $blocks = array())
    {
        // line 22
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    ";
        // line 23
        $this->env->loadTemplate("MinsalCitasBundle:CitCitasProcedimientos:detalle_agenda.html.twig")->display($context);
        // line 24
        echo "    <script type=\"text/javascript\">
        var modal_elements = [];
        var cit_info = [];
        var clickDay;

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
            var procData = getAgendaProcedimientoData();

            jQuery.ajax({
                url: Routing.generate('get_citas_dia_procedimiento') + '?idAreaModEstab=' + procData.idAreaModEstab + '&idProcedimientoEstab=' + procData.idProcedimiento + '&calendarDate=' + calendarDate,
                async: false,
                dataType: 'json',
                success: function(data) {
                    cit_info[0] = data.consolidado;
                    cit_info[1] = data.eventos;
                    cit_info[2] = data.distribucion;
                }
            });
        }

        function getIndexOfK(arr, date) {
            var date = moment(date);
            for (var i = 0; i < arr.length; i++) {
                var array_date = moment(arr[i].date, 'YYYY/MM/DD');
                if ( date.format('DD/MM/YYYY') === array_date.format('DD/MM/YYYY') ) {
                    return i;
                }
            }
            return -1;
        }
    </script>
    <script type=\"text/javascript\">
        function agendaMedica(parameters) {
            var options = {weekday: \"long\", year: \"numeric\", month: \"long\", day: \"numeric\"};
            var procData = getAgendaProcedimientoData();
            var header =
                '<div id=\"cm-modal\">'+
                    '<center>'+
                        '<div class=\"custom-modal-header\">'+
                            '<form id=\"cita_submit_form\" action=\"";
        // line 90
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create"), "method"), "html", null, true);
        echo "\" method=\"POST\">'+
                                '<div class=\"row\">'+
                                    '<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center\" style=\"margin: 10px 0px;\">'+
                                        parameters['date'].toLocaleString(\"es-SV\", options).replace(' 00:00:00 CST', '') +
                                    '</div>'+
                                '</div>'+
                                '<div class=\"row\">'+
                                    '<div class=\"row-height\">'+
                                        '<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6 col-md-height col-lg-height col-md-bottom col-lg-bottom\" id=\"horario-atencion\">'+
                                        '</div>'+
                                        '<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6 col-md-height col-lg-height col-md-bottom col-lg-bottom\" id=\"id-medico-block\">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<input type=\"hidden\" id=\"idProcedimientoEstablecimiento\" name=\"idProcedimientoEstablecimiento\" value=\"' + procData.idProcedimientoEstablecimiento + '\" />'+
                                '<input type=\"hidden\" id=\"external\" name=\"external\" value=\"";
        // line 105
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external"), "html", null, true);
        echo "\" />'+
                                '<input type=\"hidden\" id=\"date\" name=\"date\" value=\"' + clickDay + '\" />'+
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
            console.log(parameters.posee_dist);
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
            var procData = getAgendaProcedimientoData();
            var clickedDay = moment(parameters['date']);

            \$(\"#horario-atencion\").empty();
            \$(\"#horario-atencion\").append('Horario de Atencion de Pacientes<br /><select id=\"idRangoHora\" name=\"idRangoHora\"></select>');
            \$(\"#num_exp_nom_paciente\").empty();
            \$(\"#tipo_cita\").empty();

            \$idRangoHora = \$('#idRangoHora');
            \$idRangoHora.select2({
                allowClear: false,
                width: '100%'
            });

            \$idEmpleado = \$('input.idEmpleado');
            \$labelEmpleado = \$('label.idEmpleado');

            var countHorario = 0;
            jQuery.ajax({
                url: Routing.generate('citashorarioProcedimiento') + '?idAreaModEstab=' + procData.idAreaModEstab + '&idProcedimientoEstab=' + procData.idProcedimiento + '&fecha=' + clickedDay.format('DD/MM/YYYY'),
                async: false,
                dataType: 'json',
                success: function(data) {
                    countHorario = 0;
                    \$.each(data, function(indice, val) {
                        \$idRangoHora.append(\$('<option>', { value: val.id, text: val.rangoHora + ( val.distribucion.distribucionProcedimiento.idTipoDistribucion ? ' - ' + val.distribucion.distribucionProcedimiento.nombreTipoDistribucion : '') }));
                        \$('#id-medico-block').append('<div id=\"responsable-horario-'+val.id+'\" class=\"hidden\">Médico<br /><label class=\"idMedico\" style=\"color: #666666;\">'+( val.distribucion.idEmpleado ? val.distribucion.nombreEmpleado : 'Sin médico asociado')+'</label><input type=\"hidden\" class=\"idMedico\" value=\"'+( val.distribucion.idEmpleado ? val.distribucion.idEmpleado : '0')+'\" /></div>');
                        countHorario++;
                    });
                }
            });

            if(countHorario > 0) {
                \$idRangoHora.select2('val', \$('#' + \$idRangoHora.attr('id') + ' option').eq(0).val());

                \$('#responsable-horario-'+\$idRangoHora.select2('val')).removeClass('hidden');

                parameters['idHorario'] = \$idRangoHora;
                parameters['idMedico']  = \$('div[id^=\"responsable-horario-\"]').not('[class=\"hidden\"]').find('input.idMedico');
                parameters['url']       = Routing.generate('get_citas_procedimiento_detallehora') + '?idAreaModEstab='+procData.idAreaModEstab+'&idProcedimientoEstab=' + procData.idProcedimiento + '&fecha=' + parameters['mDate'].format('YYYY/MM/DD') + '&idRangoHora=' + parameters['idHorario'].select2('val')+'&idEmpleado='+parameters['idMedico'].val();

                result = buildDetailAgendaMedica(parameters);

                if(Object.keys(result).length === 0 || result.content === '') {
                    result.content = '<div class=\"alert alert-block alert-error\">\\
                                                                <h4>Error al construir la agenda m&eacute;dica</h4>\\
                                                                Lo sentimos un error al construir el detalle de la agenda m&eacute;dica, por favor intentelo nuevamente, si el problema persiste contacte con el administrador del sistema...\\
                                                        </div>';
                }

                return '</div><div class=\"panel-primary-custom\"><div class=\"agendamd-content\">'+result.content+'</div></div>';
            }
            // else {
            //     \$idRangoHora.select2('enable', false);
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
        // line 234
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_MINSAL_CITAS_ADMIN_CIT_CITAS_PROCEDIMIENTOS_LIST"), "method") || $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "ROLE_MINSAL_CITAS_ADMIN_CIT_CITAS_PROCEDIMIENTOS_LIST"), "method"))) {
            // line 235
            echo "            //                     '<br/ ><br/ > <strong>Si desea ver las citas asigandas para el día seleccionado puede hacer click en el siguiente enlace: <a href=\"";
            echo $this->env->getExtension('routing')->getUrl("admin_minsal_citas_citcitasprocedimientos_consulta");
            echo "?rangoFechas='+parameters['mDate'].format('DD/MM/YYYY')+' - '+parameters['mDate'].format('DD/MM/YYYY')+'&idAreaModEstab='+procData.idAreaModEstab+'&idProcedimientoEstablecimiento='+procData.idProcedimiento+'\" target=\"_blank\"><i class=\"fa fa-search\"></i> Ver citas...</a></strong>'+
            //                 ";
        }
        // line 237
        echo "            //             '</div>'+
            //         '</div>'+
            //         '<div class=\"panel-primary-custom\">'+
            //             '<div class=\"agendamd-content\"></div>'+
            //         '</div>';
            // }
        }

        jQuery(document).ready(function(\$) {
            if( \$('body #idRangoHora').select2('val') !== '' ) {
                // if(\$(\"#idRangoHora option:selected\").attr('data-cerrado') === 'true') {
                //     \$('body #cita_submit').addClass('hidden');
                // }
            } else {
                \$('body #idRangoHora').select2('enable', false);
            }

            \$(\"body\").on('change', \"#idRangoHora\", function(e) {
                \$idRangoHora   = \$(this);
                \$idEmpleado    = \$('inputidEmpleado').parent().not('[class=\"hidden\"]');
                \$labelEmpleado = \$('label.idEmpleado');

                \$('div[id^=\"responsable-horario-\"]').not('[class=\"hidden\"]').addClass('hidden');
                \$('#responsable-horario-'+\$idRangoHora.select2('val')).removeClass('hidden');

                var ag_content = {};
                var parameters = [];
                var now = moment().set({ 'hour': 0, 'minute': 0, 'second': 0, 'millisecond': 0 });
                var clickedDay = moment(clickDay).set({ 'hour': 0, 'minute': 0, 'second': 0, 'millisecond': 0 });

                parameters['idHorario'] = \$idRangoHora;
                parameters['idMedico']  = \$('div[id^=\"responsable-horario-\"]').not('[class=\"hidden\"]').find('input.idMedico');
                parameters['date']      = clickDay;
                parameters['mDate']     = moment(clickDay);
                procData = getAgendaProcedimientoData();

                \$('div#info-message').empty();
                \$('div.agendamd-content').empty();
                \$('div.agendamd-content').append('<center><img id=\"wait\" src=\"";
        // line 275
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/wait_icon1.gif"), "html", null, true);
        echo "\" alt=\"wait\" width=\"24\" height=\"24\"><div id=\"search-message\">Buscando...</div></center>');

                if( \$(\"body #idRangoHora option:selected\").attr('data-cerrado') === 'true' && clickedDay.diff(now) >= 0 ) {
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

                if(\$idRangoHora.select2('val') !== '') {
                    setTimeout(function() {
                        parameters['url'] = Routing.generate('get_citas_procedimiento_detallehora') + '?idAreaModEstab='+procData.idAreaModEstab+'&idProcedimientoEstab=' + procData.idProcedimiento + '&fecha=' + parameters['mDate'].format('YYYY/MM/DD') + '&idRangoHora=' + parameters['idHorario'].select2('val')+'&idEmpleado='+parameters['idMedico'].val();
                        ag_content = buildDetailAgendaMedica(parameters);

                        if(Object.keys(ag_content).length === 0 || ag_content.content === '') {
                            ag_content.content = '<div class=\"alert alert-block alert-error\">\\
                                        <h4>Error al construir la agenda m&eacute;dica</h4>\\
                                        Lo sentimos, hubo un error al construir el detalle de la agenda m&eacute;dica, por favor intentelo nuevamente, si el problema persiste contacte con el administrador del sistema...\\
                                    </div>';
                        }

                        \$('div.agendamd-content').empty();
                        \$('div.agendamd-content').append(ag_content.content);
                    }, 500);
                } else {
                    \$('div.agendamd-content').empty();
                    \$('div.agendamd-content').append('<div class=\"alert alert-info\" role=\"alert\"><h5>El procedimiento sin horarios</h5> El detalle de la agenda no se puede mostrar debido a que no se han detectado horarios para el procedimiento seleccinado</div>');
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
        // line 338
        if ((($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "month"), "method", true, true) && ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "month"), "method") != "")) && (!(null === $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "month"), "method"))))) {
            // line 339
            echo "                    month: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "month"), "method"), "html", null, true);
            echo ",
                ";
        }
        // line 341
        echo "                ";
        if ((($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "year"), "method", true, true) && ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "year"), "method") != "")) && (!(null === $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "year"), "method"))))) {
            // line 342
            echo "                    year: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "year"), "method"), "html", null, true);
            echo ",
                ";
        }
        // line 344
        echo "                dayRender: function(date, cell) {
                    var medicUser = '";
        // line 345
        if (((!$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true)) || (!($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")))) {
            echo "false";
        } else {
            echo "true";
        }
        echo "';
                    var renderCalendar = false;

                    if (medicUser == 'false') {
                        if (\$('#idEmpleado').select2('data') && \$('#idProcedimientoEstablecimiento').select2('data')) {
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
                        var ordinarios;
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
                                total_citas = cit_info[0][index0].total_citas;
                                atendidos   = cit_info[0][index0].atendidos;
                                ordinarios  = cit_info[0][index0].ordinarios;
                                agregados   = cit_info[0][index0].agregados;
                                total_cupos = cit_info[0][index0].total_cupos;
                                index1      = dateKey;

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
                                    //         'index': index,
                                    //         'before': true
                                    //     }]
                                    // );
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
                                    //         'ordinarios': ordinarios,
                                    //         'total_citas': total_citas,
                                    //         'agregados': agregados,
                                    //         'cell_date': cell_date,
                                    //         'date': date,
                                    //         'mDate': moment(date),
                                    //         'index': index,
                                    //         'before': false
                                    //     }]
                                    // );
                                }

                                createCellContent(cell, [{
                                        'type'       : type,
                                        'ordinarios' : ordinarios,
                                        'agregados'  : agregados,
                                        'total_citas': total_citas,
                                        'atendidos'  : atendidos,
                                        'total_cupos': total_cupos,
                                        'cell_date'  : cell_date,
                                        'date'       : date,
                                        'mDate'      : moment(date),
                                        'posee_dist' : ( cit_info[2][index2]['distribucion'] > 0 ),
                                        'before'     : false
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
                                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">Ordinarios:</div>\\
                                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + parameters[0].ordinarios + '</div>\\
                                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled fc-cuscont-border\">Agregados:</div>\\
                                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled fc-cuscont-border\">' + parameters[0].agregados + '</div>\\
                                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">Total Citados:</div>\\
                                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + parameters[0].total_citas + '</div>\\
                                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">Cupos Disponibles:</div>\\
                                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + (parameters[0].total_cupos-parameters[0].ordinarios) + '</div>\\
                                                            </div>\\
                                                            </div>\\
                                                    </a>');
                        break;
                    case 5:
                        cell.css(\"background-color\", \"#DCFCE9\");
                        cell.append('<a href=\"#myModal\" id=\"citDay-' + parameters[0].cell_date + '_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">\\
                                                        <div class=\"fc-custom-content-tb\">\\
                                                                <div class=\"fc-custom-content\">\\
                                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">Ordinarios:</div>\\
                                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + parameters[0].ordinarios + '</div>\\
                                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled fc-cuscont-border\">Agregados:</div>\\
                                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled fc-cuscont-border\">' + parameters[0].agregados + '</div>\\
                                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">Total Citados:</div>\\
                                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + parameters[0].total_citas + '</div>\\
                                                                        <div class=\"fc-cuscont-left fc-cuscont-enabled\">Cupos Disponibles:</div>\\
                                                                        <div class=\"fc-cuscont-right fc-cuscont-enabled\">' + (parameters[0].total_cupos-parameters[0].ordinarios) + '</div>\\
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
                \$idAreaModEstab = \$('#idAreaModEstab');
                \$idProcedimientoEstablecimiento = \$('#idProcedimientoEstablecimiento');

                var procData   = getAgendaProcedimientoData();
                var superAdmin = '";
        // line 628
        if ((isset($context["superAdmin"]) ? $context["superAdmin"] : $this->getContext($context, "superAdmin"))) {
            echo "true";
        } else {
            echo "false";
        }
        echo "';
                var select2Options = {
                    placeholder: 'Seleccionar...',
                    allowClear: true,
                    width: '100%'
                }

                select2Options['placeholder'] = 'Seleccionar Procedimiento...';
                initializeSelect2(\$idProcedimientoEstablecimiento, true, true, select2Options);

                if(\$idAreaModEstab.length > 0) {
                    select2Options['placeholder'] = 'Seleccionar Área...';
                    initializeSelect2(\$idAreaModEstab, true, false, select2Options);

                    \$idAreaModEstab.on('change', function(e) {
                        getAreaModEstab(\$(this).select2('val'));
                    });
                } else {
                    getAreaModEstab(procData.idAreaModEstab);
                }

                \$idProcedimientoEstablecimiento.on('change', function(e) {
                    if (e.val) {
                        updateMonthIformationCit();
                    }

                    updateCalendar();
                });

            ";
        // line 657
        if ((twig_length_filter($this->env, (isset($context["query"]) ? $context["query"] : $this->getContext($context, "query"))) > 0)) {
            // line 658
            echo "                ";
            $context["setIdAreaModEstab"] = (($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "idAreaModEstab"), "method", true, true)) ? ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "idAreaModEstab"), "method")) : (""));
            // line 659
            echo "                ";
            $context["setIdProcedimiento"] = (($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "idProcedimiento"), "method", true, true)) ? ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "idProcedimiento"), "method")) : (""));
            // line 660
            echo "                ";
            if (((isset($context["setIdAreaModEstab"]) ? $context["setIdAreaModEstab"] : $this->getContext($context, "setIdAreaModEstab")) != "")) {
                // line 661
                echo "                    if(\$('#idAreaModEstab').select2('data') != null) {
                        \$idAreaModEstab.select2('val', '";
                // line 662
                echo twig_escape_filter($this->env, (isset($context["setIdAreaModEstab"]) ? $context["setIdAreaModEstab"] : $this->getContext($context, "setIdAreaModEstab")), "html", null, true);
                echo "');
                        areaModEstabChange('";
                // line 663
                echo twig_escape_filter($this->env, (isset($context["setIdAreaModEstab"]) ? $context["setIdAreaModEstab"] : $this->getContext($context, "setIdAreaModEstab")), "html", null, true);
                echo "');
                ";
            }
            // line 665
            echo "
                ";
            // line 666
            if (((isset($context["setIdProcedimiento"]) ? $context["setIdProcedimiento"] : $this->getContext($context, "setIdProcedimiento")) != "")) {
                // line 667
                echo "                    \$idProcedimientoEstablecimiento.select2('val', '";
                echo twig_escape_filter($this->env, (isset($context["setIdProcedimiento"]) ? $context["setIdProcedimiento"] : $this->getContext($context, "setIdProcedimiento")), "html", null, true);
                echo "');
                    updateMonthIformationCit();
                ";
            }
            // line 670
            echo "            ";
        }
        // line 671
        echo "
            function getAreaModEstab(idAreaModEstab) {
                select2Options['placeholder'] = 'Seleccionar Procedimiento...';
                initializeSelect2(\$idProcedimientoEstablecimiento, true, true, select2Options);
                if(idAreaModEstab) {
                    \$.ajax({
                        url: Routing.generate(\"obtener_procedimientos_distribucion_area\", { 'idAreaModEstab': idAreaModEstab } ),
                        async: false,
                        dataType: 'json',
                        success: function (data) {
                            \$.each(data.resultados, function (indice, val) {
                                \$idProcedimientoEstablecimiento.append(\$('<option>', {value: val.id, text: val.text}));
                            });
                        }
                    });
                }
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
                    if (currentDate.getFullYear() == calendarDate.getFullYear() && currentDate.getMonth() == calendarDate.getMonth()) {
                        disablePrevMonthButton();
                    } else {
                        enablePrevMonthButton();
                    }

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
        // line 815
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
            // line 816
            echo "        <script type=\"text/javascript\">
            jQuery(document).ready(function(\$) {
                \$('#close-button').on('click', function() {
                    window.close();
                });

                ";
            // line 822
            if ((($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "createdElement"), "method", true, true) && ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "createdElement"), "method") != "")) && (!(null === $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "createdElement"), "method"))))) {
                // line 823
                echo "                    window.addEventListener(\"beforeunload\", function (e) {
                        if (window.opener != null && !window.opener.closed) {
                            try {
                                window.opener.updateIdCita(";
                // line 826
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
            // line 833
            echo "            });
        </script>
    ";
        }
    }

    // line 838
    public function block_notice($context, array $blocks = array())
    {
        // line 839
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(array(0 => "success", 1 => "error", 2 => "info", 3 => "warning"));
        foreach ($context['_seq'] as $context["_key"] => $context["notice_level"]) {
            // line 840
            echo "        ";
            $context["session_var"] = ("sonata_flash_" . (isset($context["notice_level"]) ? $context["notice_level"] : $this->getContext($context, "notice_level")));
            // line 841
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "flashbag"), "get", array(0 => (isset($context["session_var"]) ? $context["session_var"] : $this->getContext($context, "session_var"))), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["flash"]) {
                // line 842
                echo "            <div class=\"alert ";
                echo twig_escape_filter($this->env, ("alert-" . (isset($context["notice_level"]) ? $context["notice_level"] : $this->getContext($context, "notice_level"))), "html", null, true);
                echo "\">
                <center>";
                // line 843
                echo $this->env->getExtension('translator')->trans((isset($context["flash"]) ? $context["flash"] : $this->getContext($context, "flash")), array(), "SonataAdminBundle");
                echo "</center>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flash'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 846
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notice_level'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    // line 849
    public function block_content($context, array $blocks = array())
    {
        // line 850
        echo "
    ";
        // line 851
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"))) {
            // line 852
            echo "        <div>";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "</div>
    ";
        } else {
            // line 854
            echo "        ";
            $this->displayBlock('sonata_page_content_nav', $context, $blocks);
            // line 856
            echo "        ";
            if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
                // line 857
                echo "            <div class=\"col-md-12 text-left\" style=\"margin-bottom: 20px; color: #367fa9; padding-left:45px;\">
                <button id=\"close-button\" class=\"btn btn-default pull-right\"><span class=\"fa fa-times-circle-o\"></span> ";
                // line 858
                if ((($this->getAttribute((isset($context["query"]) ? $context["query"] : null), "get", array(0 => "createdElement"), "method", true, true) && ($this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "createdElement"), "method") != "")) && (!(null === $this->getAttribute((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), "get", array(0 => "createdElement"), "method"))))) {
                    echo "Cerrar";
                } else {
                    echo "Cancelar";
                }
                echo "</button>
            </div>
        ";
            }
            // line 861
            echo "        <div class=\"col-md-3\">
            <div class=\"col-md-12\" style=\"margin-bottom: 20px;\">
                ";
            // line 863
            if ((twig_length_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntAreaModEstab")) > 1)) {
                // line 864
                echo "                    <label class=\"col-md-12 label-filters\">Area del Procedimiento:</label>
                    <select id=\"idAreaModEstab\">
                        ";
                // line 866
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntAreaModEstab"));
                foreach ($context['_seq'] as $context["_key"] => $context["areaModEstab"]) {
                    // line 867
                    echo "                            <option value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["areaModEstab"]) ? $context["areaModEstab"] : $this->getContext($context, "areaModEstab")), "id"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["areaModEstab"]) ? $context["areaModEstab"] : $this->getContext($context, "areaModEstab")), "nombreModalidad") . " - ") . $this->getAttribute((isset($context["areaModEstab"]) ? $context["areaModEstab"] : $this->getContext($context, "areaModEstab")), "nombreAreaAtencion")) . (($this->getAttribute((isset($context["areaModEstab"]) ? $context["areaModEstab"] : $this->getContext($context, "areaModEstab")), "idServicioExterno")) ? ((" - " . $this->getAttribute((isset($context["areaModEstab"]) ? $context["areaModEstab"] : $this->getContext($context, "areaModEstab")), "nombreServicioExterno"))) : (""))), "html", null, true);
                    echo "</option>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['areaModEstab'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 869
                echo "                    </select>
                ";
            }
            // line 871
            echo "                <label class=\"col-md-12 label-filters\">Procedimiento:</label>
                <select id=\"idProcedimientoEstablecimiento\"></select>
            </div>
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
            // line 899
            $this->env->loadTemplate("ADesignsCalendarBundle::calendar.html.twig")->display($context);
            echo "</div>
    ";
        }
    }

    // line 854
    public function block_sonata_page_content_nav($context, array $blocks = array())
    {
        // line 855
        echo "        ";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:CitCitasProcedimientos:agenda.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1119 => 855,  1116 => 854,  1075 => 869,  1054 => 863,  1050 => 861,  1034 => 856,  1031 => 854,  1025 => 852,  1023 => 851,  1020 => 850,  1017 => 849,  1000 => 843,  987 => 840,  972 => 833,  945 => 816,  943 => 815,  794 => 670,  770 => 661,  759 => 657,  723 => 628,  854 => 585,  850 => 584,  838 => 575,  826 => 569,  755 => 541,  750 => 539,  741 => 533,  704 => 517,  736 => 544,  706 => 519,  702 => 516,  1720 => 1573,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1480,  1609 => 1479,  1594 => 1472,  1590 => 1471,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 841,  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 697,  803 => 630,  606 => 447,  691 => 492,  655 => 481,  484 => 412,  552 => 439,  709 => 520,  397 => 337,  392 => 251,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 988,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 866,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 857,  992 => 720,  962 => 697,  960 => 826,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 284,  419 => 293,  639 => 468,  611 => 386,  538 => 444,  646 => 307,  642 => 492,  544 => 434,  541 => 204,  517 => 427,  797 => 671,  752 => 533,  748 => 458,  681 => 412,  677 => 507,  630 => 181,  618 => 172,  535 => 430,  519 => 425,  416 => 215,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 842,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 552,  775 => 550,  762 => 544,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 406,  534 => 348,  530 => 428,  521 => 194,  489 => 179,  483 => 206,  394 => 196,  396 => 256,  345 => 243,  476 => 174,  386 => 162,  364 => 235,  234 => 155,  595 => 326,  589 => 450,  586 => 451,  562 => 505,  556 => 274,  506 => 429,  498 => 417,  492 => 274,  473 => 277,  458 => 121,  399 => 199,  352 => 190,  346 => 239,  328 => 193,  880 => 699,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 489,  573 => 516,  567 => 507,  520 => 394,  481 => 335,  475 => 409,  472 => 408,  466 => 227,  441 => 346,  438 => 189,  432 => 380,  429 => 222,  395 => 400,  382 => 202,  378 => 249,  367 => 197,  357 => 222,  348 => 190,  334 => 196,  286 => 219,  205 => 155,  297 => 182,  218 => 144,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 579,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 667,  784 => 293,  782 => 665,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 534,  740 => 456,  734 => 530,  731 => 392,  728 => 528,  725 => 251,  719 => 257,  716 => 438,  714 => 522,  711 => 540,  705 => 539,  701 => 261,  690 => 302,  687 => 301,  671 => 490,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 470,  609 => 273,  602 => 230,  591 => 453,  571 => 419,  499 => 421,  488 => 273,  389 => 235,  223 => 161,  14 => 2,  306 => 227,  303 => 183,  300 => 223,  292 => 37,  280 => 153,  12 => 36,  624 => 282,  620 => 223,  612 => 467,  601 => 379,  599 => 441,  580 => 265,  574 => 447,  559 => 504,  526 => 429,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 335,  401 => 334,  391 => 216,  369 => 189,  333 => 234,  329 => 93,  307 => 237,  287 => 236,  195 => 153,  178 => 116,  956 => 271,  953 => 822,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 587,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 564,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 662,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 504,  663 => 484,  660 => 194,  657 => 482,  650 => 483,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 482,  603 => 229,  600 => 178,  594 => 454,  588 => 372,  584 => 488,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 156,  513 => 425,  479 => 388,  468 => 407,  451 => 287,  448 => 389,  424 => 342,  418 => 344,  410 => 271,  376 => 191,  373 => 257,  340 => 209,  326 => 222,  261 => 138,  118 => 128,  200 => 125,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 991,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 899,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 871,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 867,  1056 => 864,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 858,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 846,  1004 => 266,  982 => 839,  979 => 838,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 823,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 567,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 557,  793 => 556,  785 => 666,  783 => 177,  772 => 172,  769 => 171,  767 => 660,  764 => 659,  756 => 460,  753 => 540,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 525,  712 => 521,  710 => 502,  707 => 501,  699 => 142,  697 => 513,  696 => 204,  695 => 230,  694 => 512,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 500,  654 => 484,  649 => 308,  643 => 306,  640 => 491,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 434,  550 => 255,  527 => 442,  515 => 191,  512 => 391,  509 => 422,  503 => 427,  496 => 423,  493 => 415,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 343,  408 => 338,  388 => 292,  371 => 256,  363 => 244,  350 => 245,  342 => 274,  335 => 235,  316 => 232,  290 => 154,  276 => 176,  266 => 204,  263 => 146,  255 => 209,  245 => 195,  207 => 138,  194 => 139,  184 => 148,  76 => 40,  810 => 238,  804 => 493,  801 => 560,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 663,  774 => 249,  771 => 412,  768 => 547,  766 => 546,  761 => 658,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 509,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 219,  627 => 236,  622 => 481,  619 => 212,  616 => 468,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 448,  572 => 204,  566 => 324,  547 => 435,  545 => 253,  542 => 432,  533 => 430,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 388,  443 => 387,  431 => 351,  428 => 250,  425 => 277,  422 => 373,  412 => 152,  406 => 201,  390 => 164,  383 => 193,  377 => 246,  375 => 248,  372 => 200,  370 => 208,  359 => 251,  356 => 250,  353 => 131,  349 => 189,  336 => 272,  332 => 239,  330 => 233,  318 => 233,  313 => 231,  291 => 218,  190 => 124,  321 => 229,  295 => 221,  274 => 152,  242 => 194,  236 => 156,  70 => 19,  170 => 114,  288 => 217,  284 => 154,  279 => 134,  275 => 180,  256 => 171,  250 => 2,  237 => 168,  232 => 159,  222 => 151,  191 => 129,  153 => 140,  150 => 70,  563 => 188,  560 => 435,  558 => 195,  553 => 256,  549 => 438,  543 => 179,  537 => 431,  532 => 403,  528 => 199,  525 => 311,  523 => 441,  518 => 292,  514 => 392,  511 => 243,  508 => 424,  501 => 422,  491 => 288,  487 => 411,  460 => 240,  455 => 120,  449 => 164,  442 => 353,  439 => 226,  436 => 159,  433 => 345,  426 => 180,  420 => 220,  415 => 339,  411 => 339,  405 => 269,  403 => 149,  380 => 260,  366 => 285,  354 => 191,  331 => 173,  325 => 236,  320 => 182,  317 => 227,  311 => 225,  308 => 243,  304 => 207,  272 => 183,  267 => 189,  249 => 206,  216 => 143,  155 => 141,  146 => 1,  126 => 59,  188 => 128,  181 => 126,  161 => 112,  110 => 126,  124 => 130,  692 => 373,  683 => 282,  678 => 279,  676 => 488,  666 => 485,  661 => 488,  656 => 499,  652 => 497,  645 => 493,  641 => 352,  635 => 489,  631 => 475,  625 => 460,  615 => 453,  607 => 363,  597 => 455,  590 => 223,  583 => 435,  579 => 353,  577 => 420,  575 => 212,  569 => 514,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 405,  529 => 222,  524 => 344,  516 => 424,  510 => 78,  504 => 145,  500 => 386,  495 => 416,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 279,  421 => 341,  417 => 219,  400 => 267,  385 => 203,  361 => 252,  344 => 238,  339 => 273,  324 => 102,  310 => 165,  302 => 240,  296 => 38,  282 => 178,  259 => 201,  244 => 204,  231 => 123,  226 => 151,  215 => 191,  186 => 149,  152 => 113,  114 => 50,  104 => 46,  358 => 242,  351 => 240,  347 => 275,  343 => 188,  338 => 241,  327 => 232,  323 => 49,  319 => 220,  315 => 198,  301 => 235,  299 => 234,  293 => 205,  289 => 237,  281 => 182,  277 => 208,  271 => 206,  265 => 169,  262 => 170,  260 => 211,  257 => 200,  251 => 181,  248 => 139,  239 => 139,  228 => 164,  225 => 149,  213 => 129,  211 => 140,  197 => 140,  174 => 115,  148 => 111,  134 => 90,  127 => 57,  20 => 1,  270 => 166,  253 => 3,  233 => 167,  212 => 106,  210 => 128,  206 => 152,  202 => 126,  198 => 120,  192 => 172,  185 => 135,  180 => 146,  175 => 103,  172 => 124,  167 => 105,  165 => 119,  160 => 143,  137 => 134,  113 => 60,  100 => 55,  90 => 112,  81 => 24,  65 => 18,  129 => 85,  97 => 83,  77 => 43,  34 => 62,  53 => 11,  84 => 77,  58 => 18,  23 => 3,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 344,  427 => 350,  423 => 256,  413 => 338,  409 => 219,  407 => 247,  402 => 210,  398 => 207,  393 => 265,  387 => 263,  384 => 251,  381 => 236,  379 => 110,  374 => 137,  368 => 255,  365 => 119,  362 => 234,  360 => 223,  355 => 280,  341 => 237,  337 => 197,  322 => 266,  314 => 226,  312 => 187,  309 => 48,  305 => 223,  298 => 239,  294 => 238,  285 => 179,  283 => 31,  278 => 217,  268 => 173,  264 => 188,  258 => 210,  252 => 166,  247 => 1,  241 => 203,  229 => 138,  220 => 150,  214 => 141,  177 => 134,  169 => 144,  140 => 108,  132 => 61,  128 => 66,  107 => 47,  61 => 19,  273 => 185,  269 => 214,  254 => 199,  243 => 140,  240 => 176,  238 => 192,  235 => 160,  230 => 200,  227 => 178,  224 => 146,  221 => 163,  219 => 174,  217 => 173,  208 => 132,  204 => 142,  179 => 112,  159 => 117,  143 => 136,  135 => 60,  119 => 90,  102 => 51,  71 => 21,  67 => 103,  63 => 102,  59 => 70,  28 => 3,  94 => 48,  89 => 46,  85 => 110,  75 => 73,  68 => 31,  56 => 97,  87 => 37,  201 => 136,  196 => 140,  183 => 127,  171 => 100,  166 => 113,  163 => 76,  158 => 142,  156 => 92,  151 => 108,  142 => 109,  138 => 65,  136 => 91,  121 => 55,  117 => 56,  105 => 57,  91 => 45,  62 => 71,  49 => 36,  25 => 4,  21 => 2,  31 => 4,  38 => 7,  26 => 6,  24 => 13,  19 => 5,  93 => 113,  88 => 111,  78 => 105,  46 => 20,  44 => 9,  27 => 81,  79 => 23,  72 => 39,  69 => 72,  47 => 9,  40 => 6,  37 => 7,  22 => 78,  246 => 205,  157 => 116,  145 => 137,  139 => 90,  131 => 86,  123 => 58,  120 => 52,  115 => 127,  111 => 48,  108 => 125,  101 => 44,  98 => 44,  96 => 43,  83 => 37,  74 => 22,  66 => 73,  55 => 23,  52 => 13,  50 => 10,  43 => 8,  41 => 8,  35 => 5,  32 => 4,  29 => 6,  209 => 145,  203 => 139,  199 => 135,  193 => 132,  189 => 121,  187 => 149,  182 => 117,  176 => 131,  173 => 119,  168 => 124,  164 => 107,  162 => 95,  154 => 109,  149 => 90,  147 => 91,  144 => 2,  141 => 135,  133 => 133,  130 => 132,  125 => 100,  122 => 129,  116 => 61,  112 => 126,  109 => 48,  106 => 3,  103 => 2,  99 => 50,  95 => 114,  92 => 113,  86 => 38,  82 => 35,  80 => 33,  73 => 42,  64 => 30,  60 => 17,  57 => 16,  54 => 31,  51 => 12,  48 => 93,  45 => 26,  42 => 90,  39 => 4,  36 => 20,  33 => 5,  30 => 3,);
    }
}
