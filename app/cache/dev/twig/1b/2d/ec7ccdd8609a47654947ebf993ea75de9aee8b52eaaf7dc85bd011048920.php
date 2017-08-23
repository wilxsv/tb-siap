<?php

/* MinsalCitasBundle:CitasMedicas:reprogramar.html.twig */
class __TwigTemplate_1b2dec7ccdd8609a47654947ebf993ea75de9aee8b52eaaf7dc85bd011048920 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'actions' => array($this, 'block_actions'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
";
    }

    // line 7
    public function block_javascripts($context, array $blocks = array())
    {
        // line 8
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script type=\"text/javascript\">
        var superAdmin = '";
        // line 10
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method")) {
            echo "true";
        } else {
            echo "false";
        }
        echo "';

        ";
        // line 12
        if ((array_key_exists("citasProcesadas", $context) && (twig_length_filter($this->env, (isset($context["citasProcesadas"]) ? $context["citasProcesadas"] : $this->getContext($context, "citasProcesadas"))) > 0))) {
            // line 13
            echo "            modal_elements.push({
                id: 'resultado_reprogramacion_modal',
                header: 'Estado de Reprogramacion de Citas',
                func: 'bodyResultadoReprogramacion',
                footer: '',
                widthModal: '80%'
            });

            \$citasProcesadas = ";
            // line 21
            echo twig_jsonencode_filter((isset($context["citasProcesadas"]) ? $context["citasProcesadas"] : $this->getContext($context, "citasProcesadas")));
            echo ";

            function bodyResultadoReprogramacion() {
                var html = '';

                if( Object.keys(\$citasProcesadas.mensaje).length > 0 ) {
                    html +=
                        '<div class=\"alert alert-'+\$citasProcesadas.mensaje.tipo+'\" role=\"alert\" style=\"margin-left:0px;\">'+
                            \$citasProcesadas.mensaje.descripcion+
                        '</div>';
                }

                if( \$citasProcesadas.reprogramadas.length > 0 ) {
                    html +=
                        '<div class=\"panel panel-success\">'+
                            '<div class=\"panel-heading\" style=\"font-weight:bold;\"><span class=\"fa fa-calendar\"></span> Listado de Citas Reprogramadas</div>'+
                            '<div class=\"table-responsive\">'+
                                '<table class=\"table table-bordered table-condensed td-vertical-align-middle\">'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th>NEC</th>'+
                                            '<th>Nombre del Paciente</th>'+
                                            '<th>Fecha y Hora de la Cita</th>'+
                                            '<th>Tipo de Cita</th>'+
                                            '<th></th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody>';
                                        \$.each(\$citasProcesadas.reprogramadas, function(idxr, cita) {
                                            html +=
                                                '<tr>'+
                                                    '<td>'+cita.numeroExpediente+'</td>'+
                                                    '<td>'+cita.nombrePaciente+'</td>'+
                                                    '<td>'+cita.fecha+' - '+cita.horaIni+'</td>'+
                                                    '<td>'+cita.nombreTipoCita+'</td>'+
                                                    '<td><a href=\"";
            // line 56
            echo $this->env->getExtension('routing')->getUrl("citasgetcomprobante");
            echo "?id='+cita.id+'\" target=\"_blank\" class=\"btn btn-info btn-sm\"><span class=\"fa fa-print\"> Imprimir</span></a></td>'+
                                                '</tr>';
                                        });
                            html += '</tbody>'+
                                '</table>'+
                            '</div>'+
                        '</div>';
                }

                if( \$citasProcesadas.noReprogramadas.length > 0 ) {
                    html +=
                        '<div class=\"panel panel-warning\">'+
                            '<div class=\"panel-heading\" style=\"font-weight:bold;\"><span class=\"fa fa-calendar-o\"></span> Listado de Citas No Reprogramadas</div>'+
                            '<div class=\"table-responsive\">'+
                                '<table class=\"table table-bordered table-condensed td-vertical-align-middle\">'+
                                    '<thead>'+
                                        '<tr>'+
                                            '<th>NEC</th>'+
                                            '<th>Nombre del Paciente</th>'+
                                            '<th>Fecha y Hora de la Cita</th>'+
                                            '<th>Tipo de Cita</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody>';
                                        \$.each(\$citasProcesadas.noReprogramadas, function(idxr, cita) {
                                            html +=
                                                '<tr>'+
                                                    '<td>'+cita.numeroExpediente+'</td>'+
                                                    '<td>'+cita.nombrePaciente+'</td>'+
                                                    '<td>'+cita.fecha+' - '+cita.horaIni+'</td>'+
                                                    '<td>'+cita.nombreTipoCita+'</td>'+
                                                '</tr>';
                                        });
                            html += '</tbody>'+
                                '</table>'+
                            '</div>'+
                        '</div>';
                }

                return html;
            }
        ";
        }
        // line 98
        echo "
        jQuery(document).ready(function(\$) {
            \$idEmpleado        = \$('#";
        // line 100
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleado');
            \$idEspecialidad    = \$('#";
        // line 101
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpEspecialidadEstab');
            \$rangoFecha        = \$('#";
        // line 102
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_rangoFecha');
            \$idJustificacion   = \$('#";
        // line 103
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idJustificacion');
            \$btnResetear       = \$('#btn-resetear');
            \$btnBuscar         = \$('#btn-buscar');
            \$btnReprogramar    = \$('#btn-reprogramar');
            \$resultadoBusqueda = \$('#resultado-busqueda');

            var select2Options = {
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            }
            var now = moment();
            var localS2Options   = \$.extend( {}, select2Options);
            var dataTableOptions = setDataTableOptions(\$resultadoBusqueda);
            var initAfterInsert  = ";
        // line 117
        if ((twig_length_filter($this->env, (isset($context["searchParameters"]) ? $context["searchParameters"] : $this->getContext($context, "searchParameters"))) > 0)) {
            echo "true";
        } else {
            echo "false";
        }
        echo ";

            ";
        // line 119
        if ((array_key_exists("citasProcesadas", $context) && (twig_length_filter($this->env, (isset($context["citasProcesadas"]) ? $context["citasProcesadas"] : $this->getContext($context, "citasProcesadas"))) > 0))) {
            // line 120
            echo "                callModal('resultado_reprogramacion_modal', { 'backdrop': 'static', 'keyboard': false }, true);

                \$('#myModalLabel').css({'color': '#5bc0de', 'font-weight': 'bold'});
                \$('#myModalLabel').css('text-align', 'center');
                \$('div.modal-content').css('background-color', '#f7f7f9');
                \$('div.modal-header').css('background-color', '#ffffff');
                \$('div.modal-body').css('background-color', '#f7f7f9');
                \$('div.modal-footer').css('background-color', '#ffffff');
            ";
        }
        // line 129
        echo "
            select2Options['placeholder'] = 'Seleccionar Médico...';
            initializeSelect2(\$idEmpleado, true, false, select2Options);

            select2Options['placeholder'] = 'Seleccionar Especialidad...';
            initializeSelect2(\$idEspecialidad, true, true, select2Options);

            localS2Options['placeholder'] = 'Seleccionar Justificacion...';
            localS2Options['width'] = 'calc(100% - 200px)';
            initializeSelect2(\$idJustificacion, true, false, localS2Options);

            dataTableOptions['dom'] = \"<'row'<'col-sm-6'l><'col-sm-6'f>>\" +
                                      \"<'row'<'col-sm-12 table-toolbar'>>\" +
                                      \"<'row'<'col-sm-12 table-responsive'tr>>\" +
                                      \"<'row'<'col-sm-5'i><'col-sm-7'p>>\";

            dataTableOptions['columnDefs'] = [{ \"width\": \"90px\", \"targets\": 4 }];
            dataTableOptions['order'] = [];

            \$resultadoBusqueda.DataTable(dataTableOptions);

            \$('.table-toolbar').append(
                '<div class=\"row\">'+
                    '<div class=\"col-md-12 text-right\">'+
                        '<button id=\"btn-check-current\" type=\"button\" class=\"btn btn-link\" data-action=\"check\" data-type=\"current\"><i class=\"fa fa-check-square-o\"></i> Seleccionar Actual</button>'+
                        '<button id=\"btn-uncheck-current\" type=\"button\" class=\"btn btn-link\" data-action=\"uncheck\" data-type=\"current\"><i class=\"fa fa-square-o\"></i> Deseleccionar Actual</button>'+
                        '<button id=\"btn-check-all\" type=\"button\" class=\"btn btn-link\" data-action=\"check\" data-type=\"all\"><i class=\"fa fa-check-square\"></i> Seleccionar Todos</button>'+
                        '<button id=\"btn-uncheck-all\" type=\"button\" class=\"btn btn-link\" data-action=\"uncheck\" data-type=\"all\"><i class=\"fa fa-square\"></i> Deseleccionar Todos</button>'+
                    '</div>'+
                '</div>'
            ).hide();

            \$('body').on('click', '[id^=\"btn-check-\"], [id^=\"btn-uncheck-\"]', function() {
                var action = \$(this).attr('data-action');
                var type   = \$(this).attr('data-type');

                callFunction(action+type.capitalLetter());
            });

            \$.ajax({
                url: Routing.generate(\"citasgetmedico\"),
                async: true,
                dataType: 'json',
                success: function(data) {
                    \$.each(data.data1, function(indice, val) {
                        if (superAdmin == 'true') {
                            \$idEmpleado.append( \$('<option>', {value: val.id, text: val.nombre, 'data-residente': val.residente} ) );
                        } else {
                            if(val.idEstablecimiento == ";
        // line 177
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

                    ";
        // line 183
        if (((array_key_exists("searchParameters", $context) && (twig_length_filter($this->env, (isset($context["searchParameters"]) ? $context["searchParameters"] : $this->getContext($context, "searchParameters"))) > 0)) && $this->getAttribute((isset($context["searchParameters"]) ? $context["searchParameters"] : null), "idEmpleado", array(), "any", true, true))) {
            // line 184
            echo "                        if(initAfterInsert) {
                            \$idEmpleado.select2('val', ";
            // line 185
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["searchParameters"]) ? $context["searchParameters"] : $this->getContext($context, "searchParameters")), "idEmpleado"), "html", null, true);
            echo ").trigger('change');
                        }
                    ";
        }
        // line 188
        echo "                }
            });

            \$idEmpleado.on('change', function(e) {
                select2Options['placeholder'] = 'Seleccionar Especialidad...';
                initializeSelect2(\$idEspecialidad, true, true, select2Options);

                if (\$(this).select2('val') !== '') {
                    empleadoChange(\$(this).select2('val'));
                }
            });

            \$( '#'+\$idEmpleado.attr('id')+', #'+\$idEspecialidad.attr('id') ).on('change', function(e) {
                resetTable();
            });

            \$rangoFecha.on('apply.daterangepicker', function(e) {
                resetTable();
            });

            \$.ajax({
                url: Routing.generate(\"get_justificacion_reprogramacion\"),
                async: true,
                dataType: 'json',
                success: function(data) {
                    \$.each(data, function(indice, val) {
                        \$idJustificacion.append( \$('<option>', {value: val.id, text: val.nombre} ) );
                    });
                }
            });

            ";
        // line 219
        if (((array_key_exists("searchParameters", $context) && (twig_length_filter($this->env, (isset($context["searchParameters"]) ? $context["searchParameters"] : $this->getContext($context, "searchParameters"))) > 0)) && $this->getAttribute((isset($context["searchParameters"]) ? $context["searchParameters"] : null), "rangoFecha", array(), "any", true, true))) {
            // line 220
            echo "                ";
            $context["rangoFecha"] = twig_split_filter($this->getAttribute((isset($context["searchParameters"]) ? $context["searchParameters"] : $this->getContext($context, "searchParameters")), "rangoFecha"), " - ");
            // line 221
            echo "                \$rangoFecha.data('daterangepicker').setStartDate('";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["rangoFecha"]) ? $context["rangoFecha"] : $this->getContext($context, "rangoFecha")), 0, array(), "array"), "html", null, true);
            echo "');
                \$rangoFecha.data('daterangepicker').setEndDate('";
            // line 222
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["rangoFecha"]) ? $context["rangoFecha"] : $this->getContext($context, "rangoFecha")), 1, array(), "array"), "html", null, true);
            echo "');
            ";
        }
        // line 224
        echo "

            \$btnResetear.on('click',function() {
                \$idEmpleado.select2('val','').trigger(\"change\");
                \$rangoFecha.val(now.format('DD/MM/YYYY')+' - '+now.format('DD/MM/YYYY'));

                resetTable();
            });

            \$btnBuscar.on('click',function() {
                var errorArray   = validarCamposBusqueda();
                var errorMessage = '';

                resetTable();

                \$resultadoBusqueda = \$('#resultado-busqueda').DataTable();
                \$('#error-messages').empty();

                if(errorArray.length > 0) {
                    if(errorArray.length === 1) {
                        errorMessage = 'El campo: '+errorArray[0].nombre+' no puede estar vacío.';
                    } else {
                        errorMessage = 'Los siguientes campos no han sido seleccionados o ingresados: ';
                        errorMessage += '<ul>';

                        errorArray.forEach(function(element, index, array) {
                            errorMessage += '<li>'+element.nombre+'</li>';
                        });

                        errorMessage += '</ul>';
                    }

                    \$('#error-messages').append(
                        '<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">'+
                            '<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>'+
                            '<h4><strong>Campos no seleccionados!</strong></h4>'+errorMessage+
                        '</div>'
                    );
                } else {
                    var rangoFecha = \$rangoFecha.data('daterangepicker');
                    \$('#table-search').waitMe({ text: 'Buscando...' });

                    \$.ajax({
                        url: Routing.generate(\"get_citas_info_rango\"),
                        data: { fechaInicial: rangoFecha.startDate.format('DD/MM/YYYY'), fechaFinal: rangoFecha.endDate.format('DD/MM/YYYY'), idEmpleado: \$idEmpleado.select2('val'), idEspecialidad: \$idEspecialidad.select2('val'), weekend: false, mostrarDetalleCitas: true, outputFormat: 'Y/m/d' },
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            var count = 0;
                            if(Object.keys(data).length > 0) {
                                \$.each(data, function(key, value) {
                                    if( value.totalAsignados > 0 ) {
                                        if(Object.keys(value.horarios).length > 0) {
                                            \$.each(value.horarios, function(hindex, hvalue) {
                                                if( hvalue.totalAsignados > 0 ) {
                                                    if(Object.keys(hvalue.citas).length > 0) {
                                                        \$.each(hvalue.citas, function(cindex, cvalue) {
                                                            count++;
                                                            \$resultadoBusqueda.row.add([cvalue.numeroExpediente, cvalue.nombrePaciente, value.format+' - '+hvalue.horaIni, cvalue.nombreTipoCita, ( parseInt(cvalue.idEstado) === 6 ? 'Programada' : cvalue.nombreEstado ), '<input id=\"cita_'+cvalue.id+'\" name=\"cita['+cvalue.id+']\" type=\"checkbox\" data-switch-enabled=\"true\" />' ]);
                                                        });
                                                    }
                                                }
                                            });
                                        }
                                    }
                                });
                            }

                            if(count > 0) {
                                \$resultadoBusqueda.draw();
                                \$('input:checkbox', \$resultadoBusqueda.rows().nodes()).each(function() {
                                    \$(this).iCheck({checkboxClass: 'icheckbox_square-blue position-relative',radioClass: 'iradio_square-blue'});
                                });

                                \$('td:contains(\"Reprogramada\")', \$resultadoBusqueda.rows().nodes()).parent().css({'color': '#8a6d3b !important', 'background-color': '#fcf8e3 !important'});

                                \$('.table-toolbar').show();
                                \$('#justificacion-toolbar').removeClass('hidden');
                            } else {
                                \$('.table-toolbar').hide();
                                \$('#justificacion-toolbar').addClass('hidden');
                            }

                            ";
        // line 307
        if (((array_key_exists("citasProcesadas", $context) && $this->getAttribute((isset($context["citasProcesadas"]) ? $context["citasProcesadas"] : null), "noReprogramadas", array(), "any", true, true)) && (twig_length_filter($this->env, $this->getAttribute((isset($context["citasProcesadas"]) ? $context["citasProcesadas"] : $this->getContext($context, "citasProcesadas")), "noReprogramadas")) > 0))) {
            // line 308
            echo "                                if(initAfterInsert) {
                                    var idSearch = '';
                                    \$.each(\$citasProcesadas.noReprogramadas, function(idxr, cita) {
                                        idSearch += '#cita_'+cita.id+',';
                                    });
                                    idSearch = idSearch.slice(0, -1);

                                    \$(idSearch, \$resultadoBusqueda.rows().nodes()).iCheck('check');
                                    initAfterInsert = false;
                                }
                            ";
        }
        // line 319
        echo "                        }
                    }).
                    always(function() {
                        \$('#table-search').waitMe('hide');
                    });
                }
            });

            \$btnReprogramar.on('click',function() {
                var errorArray      = [];
                var errorMessage    = '';
                var idJustificacion = \$idJustificacion.select2('val');
                var citas           = \$('input:checkbox:checked', \$resultadoBusqueda.rows().nodes());

                if(idJustificacion === '') {
                    errorArray.push({id: 'idJustificacion', nombre: 'Justificación'});
                    errorMessage = '<li>La justificación de transferencia no ha sido seleccionada.</li>';
                }

                if(citas.length === 0) {
                    errorArray.push({id: 'citas', nombre: 'Citas'});
                    errorMessage += '<li>Ninguna cita ha sido seleccionada para ser transferida.</li>';
                }

                if(errorArray.length > 0) {
                    var tmpMsj = '';
                    if(errorArray.length === 1) {
                        tmpMsj = '<p>La reprogramación de la cita no se ha podido realizar debido al siguiente motivo:</p>';
                    } else {
                        tmpMsj = '<p>La reprogramación de las citas no se han podido realizar debido a los siguientes motivos:</p>';
                    }

                    errorMessage = tmpMsj + '<ul>' + errorMessage + '</ul>';

                    showDialogMsg('Error en la reprogramación...', errorMessage, 'dialog-error');
                } else {
                    \$('form.form-reprogramar').append('<input type=\"hidden\" name=\"action\" value=\"reprogramar\" />');
                    \$('form.form-reprogramar').append('<input type=\"hidden\" name=\"searchParameters[idEmpleado]\" value=\"'+\$idEmpleado.select2('val')+'\" />');
                    \$('form.form-reprogramar').append('<input type=\"hidden\" name=\"searchParameters[idEspecialidad]\" value=\"'+\$idEspecialidad.select2('val')+'\" />');
                    \$('form.form-reprogramar').append('<input type=\"hidden\" name=\"searchParameters[rangoFecha]\" value=\"'+\$rangoFecha.val()+'\" />');

                    citas.each(function(idx) {
                        var idCita = \$(this).attr('id').replace('cita_','');
                        \$('form.form-reprogramar').append('<input type=\"hidden\" name=\"citas['+idx+']\" value=\"'+idCita+'\" />');
                    });

                    \$('form.form-reprogramar').submit();
                }
            });

            function resetTable() {
                \$resultadoBusqueda = \$('#resultado-busqueda').DataTable();
                \$resultadoBusqueda.clear().draw();
                \$('.table-toolbar').hide();
                \$('#justificacion-toolbar').addClass('hidden');
            }

            function empleadoChange(id) {
                \$.ajax({
                    url: Routing.generate('citasgetmedicoespecialidadestab') + '?idEmpleado=' + id,
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        \$.each(data.result, function(indice, val) {
                            if (superAdmin == 'true') {
                                \$idEspecialidad.append(\$('<option>', {value: val.id, text: val.nombre}));
                            } else {
                                if(val.idEstablecimiento == ";
        // line 386
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method")) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "getIdEstablecimiento", array(), "method"), "getId", array(), "method"), "html", null, true);
        } else {
            echo "''";
        }
        echo ") {
                                    \$idEspecialidad.append(\$('<option>', {value: val.id, text: val.nombre }));
                                }
                            }

                            ";
        // line 391
        if ((array_key_exists("searchParameters", $context) && (twig_length_filter($this->env, (isset($context["searchParameters"]) ? $context["searchParameters"] : $this->getContext($context, "searchParameters"))) > 0))) {
            // line 392
            echo "                                ";
            if ($this->getAttribute((isset($context["searchParameters"]) ? $context["searchParameters"] : null), "idEspecialidad", array(), "any", true, true)) {
                // line 393
                echo "                                    if(initAfterInsert) {
                                        \$idEspecialidad.select2('val', ";
                // line 394
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["searchParameters"]) ? $context["searchParameters"] : $this->getContext($context, "searchParameters")), "idEspecialidad"), "html", null, true);
                echo ");

                                        var errorArray = validarCamposBusqueda();

                                        if(errorArray.length === 0) {
                                            \$btnBuscar.trigger( \"click\" );
                                        }
                                    }
                                ";
            } else {
                // line 403
                echo "                                    initAfterInsert = false;
                                ";
            }
            // line 405
            echo "                            ";
        }
        // line 406
        echo "                        });
                    }
                });
            }

            function validarCamposBusqueda() {
                var errorArray = [];

                if(!\$idEmpleado.select2('val')) {
                    errorArray.push({id: 'idEmpleado', nombre: 'Médico'});
                }

                if(!\$idEspecialidad.select2('val')) {
                    errorArray.push({id: 'idEmpleadoEspecialidadEstab', nombre: 'Especialidad del Médico'});
                }

                if(!\$rangoFecha.val()) {
                    errorArray.push({id: 'rangoFecha', nombre: 'Rango de Fecha'});
                }

                return errorArray;
            }

            window.checkCurrent = function() {
                \$('body input[id^=\"cita_\"]').iCheck('check');
            }

            window.uncheckCurrent = function() {
                \$('body input[id^=\"cita_\"]').iCheck('uncheck');
            }

            window.checkAll = function() {
                // \$('input:checkbox', \$resultadoBusqueda.rows().nodes()).iCheck('check');
                \$('input:checkbox', \$resultadoBusqueda.rows( {search:'applied'} ).nodes()).iCheck('check');
            }

            window.uncheckAll = function() {
                // \$('input:checkbox', \$resultadoBusqueda.rows().nodes()).iCheck('uncheck');
                \$('input:checkbox', \$resultadoBusqueda.rows( {search:'applied'} ).nodes()).iCheck('uncheck');
            }

        });
    </script>
";
    }

    // line 451
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 453
    public function block_content($context, array $blocks = array())
    {
        // line 454
        echo "    <h3 class=\"text-center\">Reprogramación de Citas</h3>
    <img src=\"";
        // line 455
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalcitas/imagenes/reprogramar-512.png"), "html", null, true);
        echo "\" alt=\"imagen_reprogramar\" style=\"width: 300px; margin: 20px auto; display:block;\" />
    <div class=\"row\">
        <div class=\"col-xs-12 col-sm-12 col-md-10 col-lg-8 center-block\">
            <div class=\"box box-primary\">
                <div class=\"box-header\">
                    <h4 class=\"box-title\">Filtros de Búsqueda</h4>
                </div>
                <div class=\"box-body\">
                    <div id=\"error-messages\"></div>
                    <div class=\"sonata-ba-collapsed-fields\">
                        <div class=\"row\">
                            <div class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6\">
                                <div class=\"form-group\" id=\"sonata-ba-field-container-";
        // line 467
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleado\">
                                    <label class=\"control-label required\" for=\"";
        // line 468
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleado\">Médico</label>
                                    <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
                                        <select id=\"";
        // line 470
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleado\" name=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "[idEmpleado]\" class=\"form-control\"></select>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6\">
                                <div class=\"form-group\" id=\"sonata-ba-field-container-";
        // line 475
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpEspecialidadEstab\">
                                    <label class=\"control-label required\" for=\"";
        // line 476
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpEspecialidadEstab\">Especialidad</label>
                                    <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
                                        <select id=\"";
        // line 478
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpEspecialidadEstab\" name=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "[idEmpEspecialidadEstab]\" class=\"form-control\"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=\"form-group\" id=\"sonata-ba-field-container-";
        // line 483
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_rangoFecha\">
                            <label class=\"control-label required\" for=\"";
        // line 484
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_rangoFecha\">Rango de Fecha</label>
                            <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
                                <div class=\"input-group\">
                                    <span class=\"input-group-addon\" id=\"basic-addon1\"><i class=\"fa fa-calendar\"></i></span>
                                    <input type=\"text\" class=\"form-control bootstrap-daterangepicker\" id=\"";
        // line 488
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_rangoFecha\" name=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "[rangoFecha]\"
                                           data-mask=\"99/99/9999 - 99/99/9999\" placeholder=\"dd/mm/yyyy - dd/mm/yyyy\" value=\"\" style=\"text-align:center; background-color: #FFFFFF;\" data-date-start-date=\"";
        // line 489
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d/m/Y"), "html", null, true);
        echo "\"
                                           data-date-min-date=\"";
        // line 490
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d/m/Y"), "html", null, true);
        echo "\" data-date-show-dropdowns=\"true\" readonly=\"readonly\" data-date-opens=\"center\" data-date-auto-apply=\"true\";
                                     />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"box-footer\">
                    <div class=\"row\">
                        <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right\">
                            <button type=\"button\" id=\"btn-buscar\" name=\"btn-buscar\" class=\"btn btn-primary\"><i class=\"fa fa-filter\"></i> Filtrar</button>
                            <button type=\"button\" id=\"btn-resetear\" name=\"btn-resetear\" class=\"btn btn-default\"><i class=\"fa fa-refresh\"></i> Resetear</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"box box-success\">
                <div class=\"box-header\">
                    <h4 class=\"box-title\">Resultados de Búsqueda</h4>
                </div>
                <div class=\"box-body\">
                    <div class=\"row hidden\" id=\"justificacion-toolbar\">
                        <div class=\"col-xs-12 col-sm-8 col-md-6 col-lg-6 pull-right\">
                            <div class=\"form-group\">
                                <label for=\"";
        // line 518
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idJustificacion\" class=\"required\">Justificación</label>
                                <select id=\"";
        // line 519
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idJustificacion\" name=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "[idJustificacion]\" class=\"form-control\"></select>
                                <button type=\"button\" id=\"btn-reprogramar\" name=\"btn-reprogramar\" class=\"btn btn-success btn-sm\" style=\"height: 28px; margin-left: 7px;\"><i class=\"fa fa-share\"></i> Reprogramar</button>
                            </div>
                        </div>
                    </div>
                    <div id=\"table-search\">
                        <table id=\"resultado-busqueda\" class=\"table table-condensed table-bordered\" style=\"width: 100%;\">
                            <thead>
                                <tr>
                                    <th>NEC</th>
                                    <th>Nombre del Paciente</th>
                                    <th>Fecha y Hora de la Cita</th>
                                    <th>Tipo de Cita</th>
                                    <th>Estado Cita</th>
                                    <th>Reprogramar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class=\"form-reprogramar\" action=\"";
        // line 544
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_citas_citcitasdia_reprogramar");
        echo "\" method=\"post\"></form>
";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:CitasMedicas:reprogramar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  736 => 544,  706 => 519,  702 => 518,  1720 => 1573,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1480,  1609 => 1479,  1594 => 1472,  1590 => 1471,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 922,  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 697,  803 => 630,  606 => 447,  691 => 492,  655 => 481,  484 => 412,  552 => 439,  709 => 255,  397 => 337,  392 => 251,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 988,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 767,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 759,  992 => 720,  962 => 697,  960 => 696,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 279,  419 => 293,  639 => 468,  611 => 386,  538 => 444,  646 => 307,  642 => 286,  544 => 434,  541 => 204,  517 => 393,  797 => 489,  752 => 533,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 430,  519 => 425,  416 => 307,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 416,  775 => 413,  762 => 540,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 406,  534 => 348,  530 => 428,  521 => 194,  489 => 179,  483 => 206,  394 => 217,  396 => 206,  345 => 189,  476 => 174,  386 => 162,  364 => 235,  234 => 158,  595 => 326,  589 => 267,  586 => 451,  562 => 505,  556 => 274,  506 => 429,  498 => 417,  492 => 274,  473 => 277,  458 => 121,  399 => 338,  352 => 219,  346 => 125,  328 => 179,  880 => 699,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 489,  573 => 516,  567 => 507,  520 => 394,  481 => 335,  475 => 275,  472 => 172,  466 => 227,  441 => 346,  438 => 189,  432 => 230,  429 => 222,  395 => 400,  382 => 248,  378 => 211,  367 => 115,  357 => 222,  348 => 190,  334 => 207,  286 => 169,  205 => 106,  297 => 189,  218 => 108,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 561,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 540,  705 => 539,  701 => 261,  690 => 302,  687 => 301,  671 => 490,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 470,  609 => 273,  602 => 230,  591 => 453,  571 => 419,  499 => 424,  488 => 273,  389 => 235,  223 => 143,  14 => 2,  306 => 117,  303 => 159,  300 => 98,  292 => 95,  280 => 108,  12 => 36,  624 => 282,  620 => 223,  612 => 467,  601 => 379,  599 => 441,  580 => 265,  574 => 263,  559 => 504,  526 => 427,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 339,  401 => 119,  391 => 216,  369 => 228,  333 => 95,  329 => 93,  307 => 192,  287 => 152,  195 => 140,  178 => 108,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 460,  663 => 484,  660 => 194,  657 => 482,  650 => 483,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 221,  603 => 229,  600 => 178,  594 => 454,  588 => 372,  584 => 488,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 156,  513 => 244,  479 => 334,  468 => 163,  451 => 307,  448 => 195,  424 => 296,  418 => 308,  410 => 151,  376 => 109,  373 => 209,  340 => 209,  326 => 222,  261 => 138,  118 => 70,  200 => 119,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 991,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 768,  1056 => 766,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 536,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 712,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 563,  785 => 560,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 258,  712 => 437,  710 => 502,  707 => 501,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 241,  654 => 484,  649 => 308,  643 => 306,  640 => 478,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 501,  550 => 255,  527 => 442,  515 => 191,  512 => 391,  509 => 422,  503 => 427,  496 => 423,  493 => 415,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 343,  408 => 340,  388 => 292,  371 => 136,  363 => 133,  350 => 191,  342 => 274,  335 => 182,  316 => 219,  290 => 154,  276 => 102,  266 => 180,  263 => 102,  255 => 87,  245 => 153,  207 => 104,  194 => 92,  184 => 118,  76 => 34,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 491,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 219,  627 => 236,  622 => 369,  619 => 212,  616 => 468,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 368,  572 => 204,  566 => 324,  547 => 435,  545 => 253,  542 => 156,  533 => 429,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 163,  443 => 162,  431 => 319,  428 => 250,  425 => 156,  422 => 338,  412 => 152,  406 => 111,  390 => 164,  383 => 161,  377 => 246,  375 => 210,  372 => 234,  370 => 208,  359 => 204,  356 => 132,  353 => 131,  349 => 220,  336 => 272,  332 => 206,  330 => 122,  318 => 220,  313 => 119,  291 => 153,  190 => 98,  321 => 221,  295 => 154,  274 => 184,  242 => 118,  236 => 116,  70 => 19,  170 => 103,  288 => 176,  284 => 109,  279 => 134,  275 => 180,  256 => 171,  250 => 173,  237 => 129,  232 => 79,  222 => 123,  191 => 91,  153 => 108,  150 => 70,  563 => 188,  560 => 275,  558 => 195,  553 => 256,  549 => 438,  543 => 179,  537 => 176,  532 => 403,  528 => 199,  525 => 311,  523 => 441,  518 => 292,  514 => 392,  511 => 243,  508 => 188,  501 => 186,  491 => 288,  487 => 337,  460 => 240,  455 => 120,  449 => 164,  442 => 278,  439 => 133,  436 => 159,  433 => 185,  426 => 180,  420 => 220,  415 => 121,  411 => 174,  405 => 211,  403 => 149,  380 => 247,  366 => 285,  354 => 102,  331 => 224,  325 => 267,  320 => 265,  317 => 199,  311 => 262,  308 => 173,  304 => 191,  272 => 183,  267 => 91,  249 => 85,  216 => 146,  155 => 87,  146 => 69,  126 => 104,  188 => 119,  181 => 118,  161 => 111,  110 => 53,  124 => 80,  692 => 373,  683 => 282,  678 => 279,  676 => 488,  666 => 485,  661 => 488,  656 => 402,  652 => 376,  645 => 236,  641 => 352,  635 => 476,  631 => 475,  625 => 460,  615 => 453,  607 => 363,  597 => 455,  590 => 223,  583 => 435,  579 => 353,  577 => 420,  575 => 212,  569 => 514,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 405,  529 => 222,  524 => 344,  516 => 424,  510 => 78,  504 => 145,  500 => 386,  495 => 416,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 158,  421 => 223,  417 => 219,  400 => 148,  385 => 203,  361 => 207,  344 => 127,  339 => 273,  324 => 102,  310 => 118,  302 => 115,  296 => 96,  282 => 143,  259 => 177,  244 => 142,  231 => 123,  226 => 155,  215 => 107,  186 => 88,  152 => 103,  114 => 75,  104 => 50,  358 => 209,  351 => 130,  347 => 208,  343 => 188,  338 => 125,  327 => 203,  323 => 201,  319 => 176,  315 => 198,  301 => 204,  299 => 190,  293 => 111,  289 => 162,  281 => 182,  277 => 185,  271 => 157,  265 => 150,  262 => 68,  260 => 177,  257 => 137,  251 => 157,  248 => 139,  239 => 117,  228 => 156,  225 => 111,  213 => 70,  211 => 121,  197 => 118,  174 => 85,  148 => 70,  134 => 90,  127 => 57,  20 => 2,  270 => 150,  253 => 174,  233 => 127,  212 => 106,  210 => 103,  206 => 141,  202 => 114,  198 => 120,  192 => 120,  185 => 94,  180 => 118,  175 => 117,  172 => 116,  167 => 104,  165 => 113,  160 => 95,  137 => 65,  113 => 87,  100 => 42,  90 => 29,  81 => 34,  65 => 30,  129 => 82,  97 => 83,  77 => 24,  34 => 4,  53 => 13,  84 => 79,  58 => 18,  23 => 3,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 287,  427 => 226,  423 => 256,  413 => 220,  409 => 219,  407 => 247,  402 => 210,  398 => 401,  393 => 296,  387 => 249,  384 => 214,  381 => 236,  379 => 110,  374 => 137,  368 => 207,  365 => 119,  362 => 234,  360 => 223,  355 => 280,  341 => 126,  337 => 201,  322 => 266,  314 => 162,  312 => 174,  309 => 100,  305 => 204,  298 => 165,  294 => 142,  285 => 175,  283 => 188,  278 => 142,  268 => 176,  264 => 179,  258 => 175,  252 => 136,  247 => 133,  241 => 163,  229 => 135,  220 => 72,  214 => 155,  177 => 117,  169 => 83,  140 => 67,  132 => 83,  128 => 62,  107 => 42,  61 => 13,  273 => 185,  269 => 104,  254 => 99,  243 => 152,  240 => 130,  238 => 140,  235 => 139,  230 => 114,  227 => 112,  224 => 124,  221 => 152,  219 => 128,  217 => 150,  208 => 132,  204 => 138,  179 => 112,  159 => 110,  143 => 68,  135 => 97,  119 => 90,  102 => 85,  71 => 21,  67 => 18,  63 => 72,  59 => 12,  28 => 3,  94 => 42,  89 => 41,  85 => 26,  75 => 76,  68 => 29,  56 => 69,  87 => 27,  201 => 118,  196 => 119,  183 => 211,  171 => 84,  166 => 102,  163 => 76,  158 => 100,  156 => 72,  151 => 107,  142 => 84,  138 => 65,  136 => 91,  121 => 58,  117 => 52,  105 => 51,  91 => 38,  62 => 15,  49 => 30,  25 => 4,  21 => 2,  31 => 3,  38 => 64,  26 => 6,  24 => 13,  19 => 5,  93 => 83,  88 => 80,  78 => 77,  46 => 25,  44 => 8,  27 => 14,  79 => 20,  72 => 75,  69 => 74,  47 => 9,  40 => 65,  37 => 7,  22 => 50,  246 => 134,  157 => 97,  145 => 90,  139 => 90,  131 => 63,  123 => 73,  120 => 56,  115 => 55,  111 => 48,  108 => 59,  101 => 47,  98 => 43,  96 => 84,  83 => 39,  74 => 28,  66 => 73,  55 => 27,  52 => 68,  50 => 10,  43 => 24,  41 => 7,  35 => 6,  32 => 15,  29 => 3,  209 => 129,  203 => 119,  199 => 94,  193 => 94,  189 => 116,  187 => 117,  182 => 68,  176 => 100,  173 => 65,  168 => 114,  164 => 97,  162 => 101,  154 => 98,  149 => 163,  147 => 91,  144 => 95,  141 => 2,  133 => 64,  130 => 97,  125 => 58,  122 => 91,  116 => 69,  112 => 53,  109 => 56,  106 => 47,  103 => 41,  99 => 84,  95 => 39,  92 => 81,  86 => 38,  82 => 36,  80 => 25,  73 => 21,  64 => 29,  60 => 29,  57 => 32,  54 => 13,  51 => 26,  48 => 67,  45 => 66,  42 => 9,  39 => 8,  36 => 5,  33 => 4,  30 => 5,);
    }
}
