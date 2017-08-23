<?php

/* MinsalCitasBundle:Custom:transfer.html.twig */
class __TwigTemplate_3a14118118aa036ea294338f8b4ec9db76df76ef94e30c57ecba6898772b1435 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 4
        if (((!$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true)) || (!($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")))) {
            // line 5
            $context["idUserEspecialidad"] = null;
        } else {
            // line 7
            $context["idUserEspecialidad"] = $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idEmpEspecialidadEstab"), "method");
        }
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 10
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 13
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 14
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalcitas/css/CitasBundle.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 18
    public function block_javascripts($context, array $blocks = array())
    {
        // line 19
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script type=\"text/javascript\">
        var select2Options = {
            placeholder: 'Seleccionar...',
            allowClear: true,
            containerCss: {
                'width': '100%'
            }
        };
        var superAdmin         = ";
        // line 28
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method")) {
            echo "true";
        } else {
            echo "false";
        }
        echo ";
        var medSupResidente    = false;
        var citasTransferidas  = [];
        var startDateOld       = null;
        var endDateOld         = null;

        jQuery(document).ready(function(\$) {
            /*
             * Declaracion de Varibles
             */
            \$idEmpleadoPropietario     = \$('#";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleadoPropietario');
            \$idEspecialidadPropietario = \$('#";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEspecialidadPropietario');
            \$idEmpleadoSuplente        = \$('#";
        // line 40
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleadoSuplente');
            \$idEspecialidadSuplente    = \$('#";
        // line 41
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEspecialidadSuplente');
            \$rangoFecha                = \$('#";
        // line 42
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_rangoFecha');

            var autoClean = false;

            /*
             * Inicializacion de Selects
             */
            select2Options['placeholder'] = 'Seleccionar Médico...';
            initializeSelect2(\$idEmpleadoPropietario, true, false, select2Options);

            select2Options['placeholder'] = 'Seleccionar Especialidad...';
            initializeSelect2(\$idEspecialidadPropietario, true, true, select2Options);

            select2Options['placeholder'] = 'Seleccionar Médico...';
            initializeSelect2(\$idEmpleadoSuplente, true, false, select2Options);

            select2Options['placeholder'] = 'Seleccionar Especialidad...';
            initializeSelect2(\$idEspecialidadSuplente, true, true, select2Options);

            /*
             * Logica de Proceso
             */
            initializeICheck();

            getMedico(\$idEmpleadoPropietario);
            getMedicoEspecialidad(\$idEspecialidadPropietario, \$idEmpleadoPropietario.select2('val'))
            getMedico(\$idEmpleadoSuplente);
            getMedicoEspecialidad(\$idEspecialidadSuplente, \$idEmpleadoSuplente.select2('val'))

            \$idEmpleadoPropietario.on('change', function(e) {
                select2Options['placeholder'] = 'Seleccionar Especialidad...';
                initializeSelect2(\$idEspecialidadPropietario, true, true, select2Options);

                \$('#error-messages').empty();

                if(e.val) {
                    getMedicoEspecialidad(\$idEspecialidadPropietario, e.val);
                }

                // Descomentar si se decide que no se puede transferir al mismo médico
                // if(\$idEmpleadoPropietario.select2('val') === \$idEmpleadoSuplente.select2('val')) {
                //     \$idEmpleadoSuplente.select2('val','');
                //     \$idEspecialidadSuplente.select2('val','');
                // }

                // \$('#'+\$idEmpleadoSuplente.attr('id')+' option[disabled]').each(function() {
                //     \$(this).removeAttr('disabled');
                // });

                // \$('#'+\$idEmpleadoSuplente.attr('id')+' option[value=\"'+\$idEmpleadoPropietario.select2('val')+'\"]').attr('disabled','disabled');

                cleanElements();
            });

            \$idEmpleadoSuplente.on('change', function(e) {
                select2Options['placeholder'] = 'Seleccionar Especialidad...';
                initializeSelect2(\$idEspecialidadSuplente, true, true, select2Options);

                \$('#error-messages').empty();

                if(e.val) {
                    if( \$(this).find(\":selected\").data(\"residente\") === false ) {
                        \$('.residente-capacidad').addClass('hidden');
                    } else {
                        \$('.residente-capacidad').removeClass('hidden');
                    }
                } else {
                    \$('.residente-capacidad').addClass('hidden');
                }

                if(e.val) {
                    getMedicoEspecialidad(\$idEspecialidadSuplente, e.val);
                }

                cleanElements();
            });

            \$idEspecialidadPropietario.on('change', function(e) {
                if(\$idEmpleadoPropietario.select2('val') === \$idEmpleadoSuplente.select2('val') && \$idEspecialidadPropietario.select2('val') === \$idEspecialidadSuplente.select2('val')) {
                    \$idEspecialidadSuplente.select2('val','');
                }

                enableDisableEspecialidadSuplente();

                cleanElements();
            });

            \$idEspecialidadSuplente.on('change', function(e) {
                cleanElements();
            });

            \$rangoFecha.on('apply.daterangepicker', function(ev, picker) {
                if( startDateOld !== picker.startDate.format('DD-MM-YYYY') || endDateOld !== picker.endDate.format('DD-MM-YYYY') ) {
                    startDateOld = picker.startDate.format('DD-MM-YYYY');
                    endDateOld   = picker.endDate.format('DD-MM-YYYY');

                    if(picker.startDate.format('DD-MM-YYYY') === picker.endDate.format('DD-MM-YYYY')) {
                        \$('#siguiente-horario-rango-fecha').closest('div.row').addClass('hidden');
                    } else {
                        \$('#siguiente-horario-rango-fecha').closest('div.row').removeClass('hidden');
                    }

                    cleanElements();
                }
            });

            \$('body').on('click', 'a[href^=\"#page\"]', function() {
                evaluatePagination(\$(this));
            });

            \$('#btn_citas_search').on('click', function() {
                var errorArray  = validate();
                var errorMessage = '';

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
                    autoClean = true;

                    cleanElements(false);
                    \$('#info-box-message').removeClass('hidden');

                    if( \$idEmpleadoSuplente.find(\":selected\").data(\"residente\") === true ) {
                        \$('.residente-capacidad').removeClass('hidden');
                    }

                    var page_limit = 10;
                    var rangoFecha = \$rangoFecha.data('daterangepicker');

                    \$('#box-med-propietario').waitMe({ 'text': 'Buscando Citas del Médico Propietaro...' });
                    \$.ajax({
                        url: Routing.generate(\"get_citas_info_rango\"),
                        data: { fechaInicial: rangoFecha.startDate.format('DD/MM/YYYY'), fechaFinal: rangoFecha.endDate.format('DD/MM/YYYY'), idEmpleado: \$idEmpleadoPropietario.select2('val'), idEspecialidad: \$idEspecialidadPropietario.select2('val'), weekend: false, mostrarDetalleCitas: true, 'outputFormat': 'Y/m/d' },
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            var content           = '';
                            var totalDays         = 0;
                            var totalPages        = 0;
                            var countIndex        = 1;
                            var paginationContent = '';
                            var numberPage        = 1;
                            var index             = 0;

                            if(Object.keys(data).length > 0) {
                                \$.each(data, function(key, value) {
                                    if( value.totalAsignados > 0 ) {
                                        totalDays++;

                                        if( countIndex === 1 || ( (countIndex - 1) % page_limit) === 0) {
                                            numberPage = Math.ceil( countIndex/page_limit );
                                            content += '<div id=\"content-page-'+ numberPage +'\"'+ (numberPage !== 1 ? ' class=\"hidden\"' : '') +'>';
                                        }

                                        content +=
                                                '<div class=\"panel panel-info\" id=\"panel-mdp-'+value.dashFormat+'\">'+
                                                    '<div class=\"panel-heading\" role=\"tab\">'+
                                                        '<div class=\"row\">'+
                                                            '<div class=\"collapsed col-xs-11 col-sm-11 col-md-11 col-lg-11\">'+
                                                                '<h4 class=\"panel-title\">'+
                                                                    '<a role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse-mdp-'+value.dashFormat+'\" aria-expanded=\"true\" aria-controls=\"collapse-mdp-'+value.dashFormat+'\">'+
                                                                        '<i class=\"fa fa-calendar\"></i> '+value.format+
                                                                        '&nbsp;'+
                                                                        '&nbsp;<span class=\"badge bg-blue pv\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"'+value.pvAsignado+' asignados de un total de '+value.pvCapacidad+' para pacientes de primera vez\" data-pv-asignado=\"'+value.pvAsignado+'\" data-pv-capacidad=\"'+value.pvCapacidad+'\" style=\"font-size:15px;\">'+value.pvAsignado+'/'+value.pvCapacidad+'</span></span>'+
                                                                        '&nbsp;<span class=\"badge bg-green sb\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"'+value.sbAsignado+' asignados de un total de '+value.sbCapacidad+' para pacientes de subsecuentes\" data-sb-asignado=\"'+value.sbAsignado+'\" data-sb-capacidad=\"'+value.sbCapacidad+'\" style=\"font-size:15px;\">'+value.sbAsignado+'/'+value.sbCapacidad+'</span></span>'+
                                                                        '&nbsp;<span class=\"badge bg-teal ag\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"'+value.agAsignado+' asignados de un total de '+value.agCapacidad+' para pacientes de agregados\" data-ag-asignado=\"'+value.agAsignado+'\" data-ag-capacidad=\"'+value.agCapacidad+'\" style=\"font-size:15px;\">'+value.agAsignado+'/'+value.agCapacidad+'</span></span>'+
                                                                    '</a>'+
                                                                '</h4>'+
                                                            '</div>'+
                                                            '<div class=\"col-xs-1 col-sm-1 col-md-1 col-lg-1 text-right checkbox-tools\">'+
                                                                '<i class=\"fa fa-square-o mouse-pointer check-all\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Seleccionar todos los pacientes del día '+value.format+'\" style=\"color:#989898;\" data-fecha=\"'+value.dashFormat+'\"></i></span>&nbsp;'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div id=\"collapse-mdp-'+value.dashFormat+'\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"heading-mdp-'+value.dashFormat+'\">'+
                                                        '<div class=\"panel-body\">';
                                                            if(Object.keys(value.horarios).length > 0) {
                                                                \$.each(value.horarios, function(hindex, hvalue) {
                                                                    if( hvalue.totalAsignados > 0 ) {
                                                                        content +=
                                                                            '<div class=\"bs-callout bs-callout-'+(index % 2 === 0 ? 'primary' : 'info')+'\" id=\"callout-mdp-'+value.dashFormat+'-'+hvalue.id+'\">'+
                                                                                '<div class=\"row\">'+
                                                                                    '<div class=\"collapsed col-xs-11 col-sm-11 col-md-11 col-lg-11\">'+
                                                                                        '<h4 style=\"position: relative;\">'+
                                                                                            '<i class=\"fa fa-clock-o\"></i> <strong>'+hvalue.rangoHora+'</strong>'+
                                                                                        '</h4>'+
                                                                                    '</div>'+
                                                                                    '<div class=\"col-xs-1 col-sm-1 col-md-1 col-lg-1 text-right checkbox-tools\">'+
                                                                                        '<i class=\"fa fa-square-o mouse-pointer check-all\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Seleccionar todos los pacientes del día '+value.format+' y rango de hora '+
                                                                                            hvalue.rangoHora+'\" style=\"color:#989898;\" data-fecha=\"'+value.dashFormat+'\" data-rangohora=\"'+hvalue.id+'\"></i></span>&nbsp;'+
                                                                                    '</div>'+
                                                                                '</div>'+
                                                                                '<div class=\"table-responsive\">'+
                                                                                    '<table class=\"table table-hover table-condensed\">'+
                                                                                        '<thead>'+
                                                                                            '<tr>'+
                                                                                                '<th></th>'+
                                                                                                '<th>No.</th>'+
                                                                                                '<th>Expediente</th>'+
                                                                                                '<th>Nombre del Paciente</th>'+
                                                                                                '<th>Estado de la Cita</th>'+
                                                                                                '<th>Tipo de Cita</th>'+
                                                                                            '</tr>'+
                                                                                        '</thead>'+
                                                                                        '<tbody>';
                                                                                            if(Object.keys(hvalue.citas).length > 0) {
                                                                                                count = 1;
                                                                                                \$.each(hvalue.citas, function(cindex, cvalue) {
                                                                                                    content +=
                                                                                                        '<tr>'+
                                                                                                            '<td>'+
                                                                                                                '<input type=\"checkbox\" id=\"'+value.dashFormat+'-'+hvalue.id+'-'+cvalue.id+'\" name=\"cita['+value.dashFormat+']['+hvalue.id+']['+cvalue.id+']\" class=\"icheck\" data-type=\"flat-blue\"'+
                                                                                                                    'data-fecha=\"'+value.dashFormat+'\" data-id-rango-hora=\"'+hvalue.id+'\" data-rango-hora=\"'+hvalue.rangoHora+'\" data-id-cita=\"'+cvalue.id+'\" data-id-expediente=\"'+cvalue.idExpediente+'\"'+
                                                                                                                    'data-numero-expediente=\"'+cvalue.numeroExpediente+'\" data-nombre-paciente=\"'+cvalue.nombrePaciente+'\" data-id-estado-cita=\"'+cvalue.idEstado+'\" data-nombre-estado=\"'+cvalue.nombreEstado+'\" data-id-tipo-cita=\"'+cvalue.idTipoCita+'\"'+
                                                                                                                    'data-nombre-tipo-cita=\"'+cvalue.nombreTipoCita+'\"'+'data-id-justificacion=\"'+cvalue.idJustificacion+'\"'+'data-nombre-justificacion=\"'+cvalue.nombreJustificacion+'\"'+
                                                                                                                '/>'+
                                                                                                            '</td>'+
                                                                                                            '<td>'+count+'</td>'+
                                                                                                            '<td>'+cvalue.numeroExpediente+'</td>'+
                                                                                                            '<td>'+cvalue.nombrePaciente+'</td>'+
                                                                                                            '<td>'+cvalue.nombreEstado+'</td>'+
                                                                                                            '<td>'+cvalue.nombreTipoCita+'</td>'+
                                                                                                        '</tr>';

                                                                                                    count++;
                                                                                                });
                                                                                            } else {
                                                                                                content +=
                                                                                                    '<tr class=\"no-citas\">'+
                                                                                                        '<td colspan=\"5\"><span class=\"disabled-label\">No hay resultados para mostrar...</span></td>'+
                                                                                                    '</tr>';
                                                                                            }
                                                                                        content +=
                                                                                        '</tbody>'+
                                                                                    '</table>'+
                                                                                '</div>'+
                                                                            '</div>';
                                                                    }
                                                                });
                                                            }
                                                        content +=
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>';

                                        if( countIndex % page_limit === 0 ) {
                                            content += '</div>';
                                        }

                                        index++;
                                        countIndex++;
                                    }
                                });

                                if(totalDays > 0) {
                                    \$('#box-med-propietario .display-tools').removeClass('hidden');

                                    totalPages = Math.ceil(totalDays/page_limit);

                                    if(totalPages > 1) {
                                        paginationContent +=
                                            '<li class=\"hidden\"><a href=\"#pagef\" data-page=\"1\" aria-label=\"First\"><span>&laquo;</span></a></li>'+
                                            '<li class=\"hidden\"><a href=\"#pagep\" data-page=\"1\" aria-label=\"Previous\"><span>&lsaquo;</span></a></li>';

                                        for (var i = 1; i <= totalPages; i++) {
                                            paginationContent += '<li'+ (i === 1 ? ' class=\"active\"' : '') +'><a href=\"#page'+ i +'\" data-page=\"'+ i +'\">'+ i +'</a></li>'
                                        }

                                        paginationContent +=
                                            '<li><a href=\"#pagen\" data-page=\"2\" aria-label=\"Next\"><span>&rsaquo;</span></a></li>'+
                                            '<li><a href=\"#pagel\" data-page=\"'+totalPages+'\" aria-label=\"Last\"><span>&raquo;</span></a></li>';
                                    } else {
                                        paginationContent += '<li class=\"active hidden\"><a href=\"#page1\" data-page=\"1\">1</a></li>';
                                    }

                                    \$('#pagination-mdp-propietario').append(paginationContent);

                                    \$('#box-med-propietario .todo-list').append(content);
                                    initializeICheck();
                                    if(\$('body #pagination-mdp-propietario a[href=\"#page1\"]').length !== 0) {
                                        evaluatePagination(\$('body #pagination-mdp-propietario a[href=\"#page1\"]'));
                                    }
                                } else {
                                    \$('#med-propietario-message').append(
                                        '<div class=\"alert alert-info\" role=\"alert\">'+
                                            '<strong>Ninguna cita ha sido asignada</strong> para el rango de fechas seleccionado.'+
                                        '</div>'
                                    );
                                }
                            } else {
                                \$('#med-propietario-message').append(
                                    '<div class=\"alert alert-info\" role=\"alert\">'+
                                        '<strong>Ninguna cita ha sido asignada</strong> para el rango de fechas seleccionado.'+
                                    '</div>'
                                );
                            }
                        }
                    })
                    .always(function( jqXHR, textStatus, errorThrown ) {
                        \$('#box-med-propietario').waitMe('hide');
                    });

                    \$('#box-med-suplente').waitMe({ 'text': 'Opteniendo la Distribución del Médico Suplente...' });
                    \$.ajax({
                        url: Routing.generate(\"get_citas_info_rango\"),
                        data: { fechaInicial: rangoFecha.startDate.format('DD/MM/YYYY'), fechaFinal: rangoFecha.endDate.format('DD/MM/YYYY'), idEmpleado: \$idEmpleadoSuplente.select2('val'), idEspecialidad: \$idEspecialidadSuplente.select2('val'), weekend: false, showHorarioReal: false, mostrarDetalleCitas: false, outputFormat: 'Y/m/d' },
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            var content            = '';
                            var totalDays          = 0;
                            var totalPages         = 0;
                            var countIndex         = 1;
                            var paginationContent  = '';
                            var numberPage         = 1;
                            var index              = 0;
                            var type               = null;
                            var showExpandCompress = false;
                            var hourIndex          = 1;
                            var currentTimeStamp   = moment();
                            var startHour          = null;
                            var endHour            = null;
                            var countHours         = 0;

                            totalDays = Object.keys(data).length;

                            if(totalDays > 0) {
                                totalPages = Math.ceil(totalDays/page_limit);

                                if(totalPages > 1) {
                                    paginationContent +=
                                        '<li class=\"hidden\"><a href=\"#pagef\" data-page=\"1\" aria-label=\"First\"><span>&laquo;</span></a></li>'+
                                        '<li class=\"hidden\"><a href=\"#pagep\" data-page=\"1\" aria-label=\"Previous\"><span>&lsaquo;</span></a></li>';

                                    for (var i = 1; i <= totalPages; i++) {
                                        paginationContent += '<li'+ (i === 1 ? ' class=\"active\"' : '') +'><a href=\"#page'+ i +'\" data-page=\"'+ i +'\">'+ i +'</a></li>'
                                    }

                                    paginationContent +=
                                        '<li><a href=\"#pagen\" data-page=\"2\" aria-label=\"Next\"><span>&rsaquo;</span></a></li>'+
                                        '<li><a href=\"#pagel\" data-page=\"'+totalPages+'\" aria-label=\"Last\"><span>&raquo;</span></a></li>';
                                } else {
                                    paginationContent += '<li class=\"active hidden\"><a href=\"#page1\" data-page=\"1\">1</a></li>';
                                }

                                \$('#pagination-mdp-suplente').append(paginationContent);


                                \$.each(data, function(key, value) {
                                    countHours = 0;

                                    if(value.poseeDistribucion === true || value.residente === true) {
                                        if(value.diaBloqueado === true) {
                                            if(value.tipoEvento === 'festivo') {
                                                type = 3;
                                            } else {
                                                /* Descomentar cuando se haga bloqueo de eventor por hora*/
                                                //type = 4;
                                                type = 2;
                                            }
                                        } else {
                                            type = 5;
                                        }
                                    } else {
                                        if(value.diaBloqueado === true) {
                                            if(value.tipoEvento === 'festivo') {
                                                type = 3;
                                            } else {
                                                type = 2;
                                            }
                                        } else {
                                            type = 1;
                                        }
                                    }

                                    if( countIndex === 1 || ( (countIndex - 1) % page_limit) === 0) {
                                        numberPage = Math.ceil( countIndex/page_limit );
                                        content += '<div id=\"content-page-'+ numberPage +'\"'+ (numberPage !== 1 ? ' class=\"hidden\"' : '') +'>';
                                    }

                                    content +=
                                        '<div class=\"panel panel-info\" id=\"panel-mds-'+value.dashFormat+'\">'+
                                            '<div class=\"panel-heading'+(type === 1 ? ' dia-no-disponible' : ( type === 2 ? ' dia-bloqueado' : (type === 3 ? ' dia-festivo' : '') ) )+'\" role=\"tab\">'+
                                                '<div class=\"row\">';
                                    if(type === 1 || type === 2 || type === 3) {
                                        content +=
                                                        '<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">'+
                                                            '<h4 class=\"panel-title\">'+
                                                                '<a style=\"line-height: 25px; height: 25px;\">'+
                                                                    '<i class=\"fa fa-calendar-o\"></i> '+value.format+'&nbsp;'+
                                                                    '<label class=\"label '+(type === 1 ? 'bg-gray' : ( type === 2 ? ' bg-red' : 'bg-yellow' ) )+'\" style=\"'+( type === 1 ? 'background-color: #777 !important; ' : '' )+'margin-left: 15px;\">'+
                                                                        (type === 1 ? 'DIA NO DISPONIBLE' : ( type === 2 ? ' DIA BLOQUEADO' : 'DIA FESTIVO' ) )+
                                                                    '</label>'+
                                                                '</a>'+
                                                            '</h4>'+
                                                        '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>';
                                    } else {
                                        showExpandCompress = true;
                                        content +=
                                                        '<div class=\"collapsed col-xs-11 col-sm-11 col-md-11 col-lg-11\">'+
                                                            '<h4 class=\"panel-title\">'+
                                                                '<a class=\"\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse-mds-'+value.dashFormat+'\" aria-expanded=\"true\" aria-controls=\"collapse-mds-'+value.dashFormat+'\">'+
                                                                    '<i class=\"fa fa-calendar\"></i> '+value.format+
                                                                    '&nbsp;'+
                                                                    '&nbsp;<span class=\"badge bg-blue pv\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"'+value.pvAsignado+( value.pvAsignado !== 1 ? ' pacientes asignados' : ' paciente asignado' )+
                                                                        ( value.residente === true ? '' : ' de un total de '+value.pvCapacidad+' para pacientes ' )+' de primera vez\" data-pv-asignado=\"'+value.pvAsignado+'\"'+
                                                                        'data-pv-capacidad=\"'+value.pvCapacidad+'\" data-residente=\"'+value.residente+'\" style=\"font-size:15px;\">'+value.pvAsignado+( value.residente === true ? '' : '/'+value.pvCapacidad )+'</span>'+
                                                                    '&nbsp;<span class=\"badge bg-green sb\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"'+value.sbAsignado+( value.sbAsignado !== 1 ? ' pacientes asignados' : ' paciente asignado' )+
                                                                        ( value.residente === true ? '' : ' de un total de '+value.sbCapacidad+' para pacientes ' )+' subsecuentes\" data-sb-asignado=\"'+value.sbAsignado+'\"'+
                                                                        'data-sb-capacidad=\"'+value.sbCapacidad+'\" data-residente=\"'+value.residente+'\" style=\"font-size:15px;\">'+value.sbAsignado+( value.residente === true ? '' : '/'+value.sbCapacidad )+'</span>'+
                                                                    '&nbsp;<span class=\"badge bg-teal ag\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"'+value.agAsignado+( value.agAsignado !== 1 ? ' pacientes asignados' : ' paciente asignado' )+
                                                                        ( value.residente === true ? '' : ' de un total de '+value.agCapacidad+' para pacientes ' )+' agregados\" data-ag-asignado=\"'+value.agAsignado+'\"'+
                                                                        'data-ag-capacidad=\"'+value.agCapacidad+'\" data-residente=\"'+value.residente+'\" style=\"font-size:15px;\">'+value.agAsignado+( value.residente === true ? '' : '/'+value.agCapacidad )+'</span>'+
                                                                '</a>'+
                                                            '</h4>'+
                                                        '</div>'+
                                                        '<div class=\"col-xs-1 col-sm-1 col-md-1 col-lg-1 text-right checkbox-tools\">'+
                                                            '<i class=\"fa fa-square-o mouse-pointer check-all\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Seleccionar todos los horarios para el día '+value.format+'\" style=\"color:#989898;\" data-fecha=\"'+value.dashFormat+'\"></i></span>'+
                                                        '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div id=\"collapse-mds-'+value.dashFormat+'\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"heading-mds-'+value.dashFormat+'\">'+
                                                '<div class=\"panel-body\">';
                                                    if(Object.keys(value.horarios).length > 0) {
                                                        \$.each(value.horarios, function(hindex, hvalue) {
                                                            startHour = moment(value.date+' '+hvalue.horaIni, 'YYYY/MM/DD hh:mm:ss A');
                                                            endHour   = moment(value.date+' '+hvalue.horaFin, 'YYYY/MM/DD hh:mm:ss A');

                                                            if(endHour.diff(currentTimeStamp) > 0 ) {
                                                                content +=
                                                                    '<div class=\"bs-callout bs-callout-'+(hourIndex % 2 === 0 ? 'primary' : 'info')+'\" id=\"callout-mdp-'+value.dashFormat+'-'+hvalue.id+'\">'+
                                                                        '<div class=\"row\">'+
                                                                            '<div class=\"collapsed col-xs-11 col-sm-11 col-md-11 col-lg-11\">'+
                                                                                '<h4 style=\"position: relative;\">'+
                                                                                    '<i class=\"fa fa-clock-o\"></i> <strong>'+hvalue.rangoHora+'</strong>'+
                                                                                    '&nbsp;'+
                                                                                    '&nbsp;<span class=\"badge bg-blue pv\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"'+hvalue.pvAsignado+( hvalue.pvAsignado !== 1 ? ' pacientes asignados' : ' paciente asignado' )+
                                                                                        ( value.residente === true ? ( hvalue.generico === true ? '' : ' de un total de '+hvalue.pvCapacidad+' para pacientes' ) : ' de un total de '+hvalue.pvCapacidad+' para pacientes' )+
                                                                                        ' de primera vez\" style=\"font-size:15px;\">'+hvalue.pvAsignado+( value.residente === true ? ( hvalue.generico === true ? '' : '/'+hvalue.pvCapacidad ) : '/'+hvalue.pvCapacidad )+'</span>'+
                                                                                    '&nbsp;<span class=\"badge bg-green sb\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"'+hvalue.sbAsignado+( hvalue.sbAsignado !== 1 ? ' pacientes asignados' : ' paciente asignado' )+
                                                                                        ( value.residente === true ? ( hvalue.generico === true ? '' : ' de un total de '+hvalue.sbCapacidad+' para pacientes' ) : ' de un total de '+hvalue.sbCapacidad+' para pacientes' )+
                                                                                        ' subsecuentes\" style=\"font-size:15px;\">'+hvalue.sbAsignado+( value.residente === true ? ( hvalue.generico === true ? '' : '/'+hvalue.sbCapacidad ) : '/'+hvalue.sbCapacidad )+'</span>'+
                                                                                    '&nbsp;<span class=\"badge bg-teal ag\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"'+hvalue.agAsignado+( hvalue.agAsignado !== 1 ? ' pacientes asignados' : ' paciente asignado' )+
                                                                                        ( value.residente === true ? ( hvalue.generico === true ? '' : ' de un total de '+hvalue.agCapacidad+' para pacientes' ) : ' de un total de '+hvalue.agCapacidad+' para pacientes' )+
                                                                                        ' agregados\" style=\"font-size:15px;\">'+hvalue.agAsignado+( value.residente === true ? ( hvalue.generico === true ? '' : '/'+hvalue.agCapacidad ) : '/'+hvalue.agCapacidad )+'</span>'+
                                                                                '</h4>'+
                                                                            '</div>'+
                                                                            '<div class=\"col-xs-1 col-sm-1 col-md-1 col-lg-1 text-right checkbox-tools\">'+
                                                                                '<input type=\"checkbox\" id=\"'+value.dashFormat+'-'+hvalue.id+'\" name=\"horario['+value.dashFormat+']['+hvalue.id+']\" class=\"icheck\" data-type=\"flat-blue\"'+
                                                                                    'data-pv-capacidad=\"'+hvalue.pvCapacidad+'\" data-pv-asignado=\"'+hvalue.pvAsignado+'\" data-sb-capacidad=\"'+hvalue.sbCapacidad+'\" data-sb-asignado=\"'+hvalue.sbAsignado+'\" data-ag-capacidad=\"'+hvalue.agCapacidad+'\" data-ag-asignado=\"'+hvalue.agAsignado+'\"'+
                                                                                    'data-residente=\"'+value.residente+'\" data-generico=\"'+hvalue.generico+'\" data-id=\"'+hvalue.id+'\" data-fecha=\"'+value.dashFormat+'\"'+
                                                                                '/>'+
                                                                            '</div>'+
                                                                        '</div>'+
                                                                        '<div class=\"table-responsive\">'+
                                                                            '<table class=\"table table-hover table-condensed\">'+
                                                                                '<thead>'+
                                                                                    '<tr>'+
                                                                                        '<th></th>'+
                                                                                        '<th>Expediente</th>'+
                                                                                        '<th>Nombre del Paciente</th>'+
                                                                                        '<th>Estado de la Cita</th>'+
                                                                                        '<th>Tipo de Cita</th>'+
                                                                                    '</tr>'+
                                                                                '</thead>'+
                                                                                '<tbody>'+
                                                                                    '<tr class=\"no-citas\">'+
                                                                                        '<td colspan=\"6\"><span class=\"disabled-label\">Ninguna cita ha sido transferida...</span></td>'+
                                                                                    '</tr>'+
                                                                                '</tbody>'+
                                                                            '</table>'+
                                                                        '</div>'+
                                                                    '</div>';
                                                                    hourIndex++;
                                                            } else {
                                                                countHours++;
                                                            }
                                                        });

                                                        if(countHours === Object.keys(value.horarios).length) {
                                                            content += '<span class=\"disabled-label\">Ningun horario para mostrar...</span>';
                                                        }
                                                    } else {
                                                        content += '<span class=\"disabled-label\">Ningun horario para mostrar...</span>';
                                                    }

                                            content +=
                                                '</div>'+
                                            '</div>'+
                                        '</div>';
                                    }

                                    if( countIndex % page_limit === 0 ) {
                                        content += '</div>';
                                    }

                                    countIndex++;
                                });

                                \$('#box-med-suplente .todo-list').append(content);

                                if(\$('body #pagination-mdp-suplente a[href=\"#page1\"]').length !== 0) {
                                    evaluatePagination(\$('body #pagination-mdp-suplente a[href=\"#page1\"]'));
                                }

                                if(showExpandCompress) {
                                    \$('#box-med-suplente .display-tools').removeClass('hidden');
                                    \$('#box-med-suplente .todo-list').css('margin-top','');
                                } else {
                                    \$('#box-med-suplente .todo-list').css('margin-top','40px');
                                }

                                cssComplement();
                                initializeICheck();
                            } else {
                                \$('#med-suplente-message').append(
                                    '<div class=\"alert alert-info\" role=\"alert\">'+
                                        '<strong>Ninguna cita ha sido asignada</strong> para el rango de fechas seleccionado.'+
                                    '</div>'
                                );
                            }
                        }
                    })
                    .always(function( jqXHR, textStatus, errorThrown ) {
                        \$('#box-med-suplente').waitMe('hide');
                    });
                }
            });

            \$('.expand-all').on('click', function() {
                var propietario  = \$(this).closest('div#box-med-propietario').length > 0 ? true : false;
                var idBox        = propietario ? 'box-med-propietario' : 'box-med-suplente';
                var idPagination = propietario ? 'pagination-mdp-propietario' : 'pagination-mdp-suplente';
                var activePage   = \$('body #'+idPagination).find('li[class~=\"active\"] a').attr('data-page');

                if(\$(this).hasClass('fa-expand')) {
                    \$('#'+idBox+' .todo-list #content-page-'+activePage+' .collapse').collapse('show');
                    expandCompressIcon(\$(this), true);
                } else {
                    \$('#'+idBox+' .todo-list #content-page-'+activePage+' .collapse').collapse('hide');
                    expandCompressIcon(\$(this), false);
                }
            });

            \$('.check-hole').on('click', function() {
                var propietario  = \$(this).closest('div#box-med-propietario').length > 0 ? true : false;
                var idBox        = propietario ? 'box-med-propietario' : 'box-med-suplente';
                var idPagination = propietario ? 'pagination-mdp-propietario' : 'pagination-mdp-suplente';
                var activePage   = \$('body #'+idPagination).find('li[class~=\"active\"] a').attr('data-page');

                if(\$(this).hasClass('fa-square-o')) {
                    \$('body #'+idBox+' .todo-list #content-page-'+activePage+' input[type=\"checkbox\"]').iCheck('check');
                    checkUncheckIcon(\$(this), true, 'Click para deseleccionar todos los pacientes de todas las fechas');
                } else {
                    \$('body #'+idBox+' .todo-list #content-page-'+activePage+' input[type=\"checkbox\"]').iCheck('uncheck');
                    checkUncheckIcon(\$(this), false, 'Click para seleccionar todos los pacientes de todas las fechas');
                }
            });

            \$('body').on('click', 'i.check-all', function() {
                var propietario = \$(this).closest('div#box-med-propietario').length > 0 ? true : false;
                var idBox       = propietario ? 'box-med-propietario' : 'box-med-suplente';
                var fecha       = \$(this).attr('data-fecha');
                var idRangoHora = \$(this).attr('data-rangohora');
                var idPattern   = fecha;

                if(typeof idRangoHora !== 'undefined') {
                    idPattern += '-' + idRangoHora;
                }

                if(\$(this).hasClass('fa-square-o')) {
                    checkUncheckIcon(\$(this), true, 'Click para deseleccionar todos los pacientes del día '+fecha);
                    \$('body #'+idBox+' input[id^=\"'+idPattern+'\"]').iCheck('check');
                } else {
                    checkUncheckIcon(\$(this), false, 'Click para deseleccionar todos los pacientes del día '+fecha);
                    \$('body #'+idBox+' input[id^=\"'+idPattern+'\"]').iCheck('uncheck');
                }
            });

            \$('body').on('ifToggled', 'input[type=\"checkbox\"]', function() {
                var bsCallout       = \$(this).closest('div.bs-callout');
                var panelCollapsed  = \$(this).closest('div.panel');
                var contentPage     = \$(this).closest('div[id^=\"content-page-\"]');
                var helpSelector    = \$(this).closest('#box-med-propietario').length > 0 ? 'box-med-propietario' : 'box-med-suplente';

                evaluateCheckUncheckIcon(bsCallout, bsCallout.find('.checkbox-tools i.check-all', 'del rango de hora'));
                evaluateCheckUncheckIcon(panelCollapsed, panelCollapsed.find('.checkbox-tools i.check-all'), 'del día');
                evaluateCheckUncheckIcon(contentPage, \$('#'+helpSelector+' i.check-hole'), '');
            });

            \$('body').on('hidden.bs.collapse shown.bs.collapse', '.panel', function() {
                var contentPage  = \$(this).closest('div[id^=\"content-page-\"]');
                var helpSelector = \$(this).closest('#box-med-propietario').length > 0 ? 'box-med-propietario' : 'box-med-suplente';

                evaluateExpandCompressIcon(contentPage, \$('#'+helpSelector+' i.expand-all'));
            });

            \$('body').on('click', 'a[data-type=\"descripcion\"]', function() {
                var atributos = \$(this).attr();

                if( atributos.hasOwnProperty('data-status') ) {
                    \$(this).empty();

                    if( atributos['data-status'] === 'hidden' ) {
                        \$(this).append('ocultar descripcion...');
                        \$(this).attr('data-status','shown');
                    } else {
                        \$(this).append('ver descripcion...');
                        \$(this).attr('data-status','hidden');
                    }
                }
            });

            \$('#transferir-citas').on('click', function() {
                var cantidadCitas    = \$('#box-med-propietario').find('input[type=\"checkbox\"]:checked').length;
                var cantidadHorarios = \$('#box-med-suplente').find('input[type=\"checkbox\"]:checked').length;
                var noTransferidos   = [];
                var nextIteration    = true;
                var siguienteHorario = \$('#ningun-horario').prop('checked') === false ? true : false;

                if(cantidadCitas > 0) {
                    if(cantidadHorarios > 0) {
                        \$('#box-med-propietario').find('input[type=\"checkbox\"]:checked').each(function() {
                            var cita = \$(this);
                            var atributos = cita.attr();
                            // var primeraVez = atributos['data-id-tipo-cita'] === '1' ? true : false;
                            var tipoCita = atributos['data-id-tipo-cita'] === '1' ? 'pv' : 'sb';

                            /*
                             *  Evalua si el paciente es de Primera Vez en la especialidad a la que se le esta transfiriendo, descomentar si se hace la consulta en vivo
                             */
                            // \$.ajax({
                            //     url: Routing.generate(\"citas_tipo_cita\")+'/'+\$idEmpleadoSuplente.select2('val')+'/'+\$idEspecialidadSuplente.select2('val')+'/'+atributos['data-id-expediente'],
                            //     async: false,
                            //     dataType: 'json',
                            //     success: function(data) {
                            //         primeraVez = data;
                            //     }
                            // });

                            if(nextIteration) {
                                nextIteration = agregarCita(cita, tipoCita);

                                if(nextIteration === false) {
                                    noTransferidos.push(cita.attr('id'));
                                }
                            } else {
                                noTransferidos.push(cita.attr('id'));
                                return;
                            }
                        });

                        if(noTransferidos.length > 0) {
                            var title       = '';
                            var dialogClass = '';
                            var msj         = '';
                            var width       = null;

                            if( cantidadCitas === noTransferidos.length ) {
                                title       = 'Citas no transferidas.';
                                dialogClass = 'dialog-warning';
                                msj = '<strong>El proceso de transferencia de citas no se pudo realizar.</strong><br /><br />'+
                                      ( cantidadCitas > 1 ? 'Las citas seleccionadas no pudieron ser transferidas' : 'La cita no pudo ser transferida' )+' debido que no se <strong>encontró espacio disponible</strong> en '+( cantidadHorarios > 1 ? 'los horarios seleccionados' : 'el horario seleccionado' ) + ( siguienteHorario === true ? ', ni en los horarios posteriores.' : '' )+'<br />';
                            } else {
                                title       = 'Informe de transferencia de Citas.';
                                dialogClass = 'dialog-info';
                                width       = 800;
                                msj = (noTransferidos.length > 1 ? 'Las siguientes citas no pudieron ser transferidas' : 'La siguiente cita no pudo ser transferida' )+' debido que no se <strong>encontró espacio disponible</strong> en '+( cantidadHorarios > 1 ? 'los horarios seleccionados' : 'el horario seleccionado' ) + ( siguienteHorario === true ? ', ni en los horarios posteriores.' : '' )+
                                      '<br />'+
                                      '<div class=\"table-responsive\">'+
                                        '<table class=\"table table-hover table-condensed\" style=\"margin: 0px 30px;\">'+
                                            '<thead>'+
                                                '<tr>'+
                                                    '<th>Fecha</th>'+
                                                    '<th>Horario</th>'+
                                                    '<th>No. Expediente</th>'+
                                                    '<th>Paciente</th>'+
                                                '</tr>'+
                                            '</thead>'+
                                            '<tbody>';

                                for (var i = 0; i < noTransferidos.length; i++) {
                                    msj +=  '<tr>'+
                                                '<td>'+\$('#'+noTransferidos[i]).attr('data-fecha')+'</td>'+
                                                '<td>'+\$('#'+noTransferidos[i]).attr('data-rango-hora')+'</td>'+
                                                '<td>'+\$('#'+noTransferidos[i]).attr('data-numero-expediente')+'</td>'+
                                                '<td>'+\$('#'+noTransferidos[i]).attr('data-nombre-paciente')+'</td>'+
                                            '</tr>';
                                }

                                msj += '</tbody>'+
                                    '</table>'+
                                '</div>';
                            }

                            msj += '<br />Por favor <strong>seleccione otra fecha y/o horario</strong> y haga click sobre el botón transferir para poder asignar las citas';

                            showDialogMsg(title, msj, dialogClass, null, null, null, width);
                        }
                    } else {
                        var title = 'Citas no seleccionadas';
                        var dialogClass = 'dialog-error';
                        var msj = '<strong>Debe de seleccionar al menos un horario del médico suplente</strong> al cual desea transferir las citas seleccionadas.';
                        showDialogMsg(title, msj, dialogClass);
                    }
                } else {
                    var title = 'Citas no seleccionadas';
                    var dialogClass = 'dialog-error';
                    var msj = '<strong>Ninguna cita ha sido seleccionada para ser transferidad.</strong>.<br />Para poder transferir las citas debe de seleccionar al menos una.';
                    showDialogMsg(title, msj, dialogClass);
                }

                saveButtonChangeStatus();
            });

            \$('body').on('click','span[id^=\"trash-\"]', function() {
                var tbody       = \$(this).closest('tbody');
                var id          = \$(this).attr('id').replace(/trash\\-/g,'');
                var tipoCitaNew = \$(this).attr('data-tipo');
                var horario     = \$(this).closest('.bs-callout').find('input[type=\"checkbox\"]');
                var tipoCitaOld = \$('#'+id).attr('data-id-estado-cita') === '6' ? 'ag' : ( \$('#'+id).attr('data-id-tipo-cita') === '1' ? 'pv' : 'sb' );
                // var tipoCitaOld = parseInt( \$('#'+id).attr('data-id-tipo-cita') ) === 1 ? 'pv' : ( parseInt( \$('#'+id).attr('data-id-tipo-cita') ) === 2 ? 'sb' : 'ag' );
                var asignado    = \$('#'+id).closest('.panel').find('.badge.'+tipoCitaOld);

                index = getIndexOfK(citasTransferidas, 'htmlId', id);

                if(index !== -1) {
                    \$('#'+id).closest('tr').removeClass('hidden');
                    \$('#'+id).iCheck('check');;
                    \$('#'+id).iCheck('enable');

                    \$(this).closest('tr').remove();

                    if( \$('#'+id).closest('tbody').find(\"tr:not('[class*=hidden]')\").length > 0 ) {
                        \$('#'+id).closest('tbody').find('tr.no-citas').addClass('hidden');
                    }

                    if( tbody.find(\"tr:not('[class*=hidden]')\").length === 0 ) {
                        tbody.find('tr.hidden').removeClass('hidden');
                    }

                    citasTransferidas.splice(index, 1);

                    /* Actualizando la cantidad de asignados del rango de hora de la cita transferida*/
                    agregarRestarCapacidadAsignado(asignado, asignado, tipoCitaOld, '+');

                    /* Actualizando la cantidad de asignados del rango de hora*/
                    agregarRestarCapacidadAsignado(horario, horario.closest('.bs-callout').find('.collapsed .badge.'+tipoCitaNew), tipoCitaNew, '-');

                    /* Actualizando la cantidad de asignados del día del rango de hora seleccionado*/
                    agregarRestarCapacidadAsignado(horario.closest('.panel').find('.panel-title .badge.'+tipoCitaNew), horario.closest('.panel').find('.panel-title .badge.'+tipoCitaNew), tipoCitaNew, '-', isPanel = true);
                } else {
                    console.error('Error no se pudo encontrar el id: '+id+' en el array de citas transferidas');

                    var title = 'Cita transferida no eliminada.';
                    var dialogClass = 'dialog-error';
                    var msj = '<strong>No se pudo eliminar la cita transferida</strong>.<br />Por favor intente nuevamente si el probema persiste contacte con el Administrador.';
                    showDialogMsg(title, msj, dialogClass);
                }

                saveButtonChangeStatus();
            });

            \$('#guardar-citas').on('click', function() {
                var title       = '';
                var dialogClass = '';
                var msg         = '';
                var width       = 800;

                if(citasTransferidas.length > 0) {
                    \$('.sonata-ba-content').waitMe({ 'text': '<h3><strong>Procesando las citas a transferir.</strong></h3>Esto puede tomar un poco de tiempo, no cierre ni recargue la pagina, por favor espere...' })
                    \$.ajax({
                        url: Routing.generate(\"citas_transferir_cita\"),
                        async: true,
                        dataType: 'json',
                        method: \"POST\",
                        data: { citas: JSON.stringify(citasTransferidas) },
                        success: function(data) {
                            \$('#error-messages').empty();

                            if(data.status) {
                                if( Object.keys(data.transferred).length > 0 ) {
                                    \$.each(data.transferred, function(key, transferred) {
                                        var index = getIndexOfK(citasTransferidas, 'htmlId', transferred.idHtml);

                                        if(index != -1) {
                                            citasTransferidas.splice(index, 1);
                                        } else {
                                            console.error('Error no se pudo encontrar el id html de la cita: '+transferred.idHtml+' en el array de citas Transferidas: ');
                                            console.log(citasTransferidas);
                                        }
                                    });
                                }

                                if( data.notFound.length > 0 ) {
                                    title = 'Problemas al guardar los cambios';
                                    dialogClass = 'dialog-error';

                                    msg = '<strong>Problemas al guardar los cambios de transferencia.</strong><br />'+
                                            ( data.notFound.length === 1 ? 'El cambio de transferencia de cita no se pudo guardar para la siguiente cita' : 'Los cambios de transferencia de citas no se pudieron guardar de las siguientes citas' )+
                                            '<div class=\"table-responsive\">'+
                                                '<table class=\"table table-hover table-condensed\" style=\"margin: 0px 30px;\">'+
                                                    '<thead>'+
                                                        '<tr>'+
                                                            '<th>Fecha</th>'+
                                                            '<th>Horario</th>'+
                                                            '<th>No. Expediente</th>'+
                                                            '<th>Paciente</th>'+
                                                        '</tr>'+
                                                    '</thead>'+
                                                        '<tbody>';

                                    for (var i = 0; i < data.notFound.length; i++) {
                                        msg +=  '<tr>'+
                                                    '<td>'+\$('#'+notFound[i]).attr('data-fecha')+'</td>'+
                                                    '<td>'+\$('#'+notFound[i]).attr('data-rango-hora')+'</td>'+
                                                    '<td>'+\$('#'+notFound[i]).attr('data-numero-expediente')+'</td>'+
                                                    '<td>'+\$('#'+notFound[i]).attr('data-nombre-paciente')+'</td>'+
                                                '</tr>';
                                    }

                                    msg +=
                                                    '</tbody>'+
                                                '</table>'+
                                            '</div>'+
                                            '<br />Por favor intente nuevamente, si el problema persiste contacte con el Administrador.';
                                } else {
                                    title = 'Transferencia Exitosa';
                                    dialogClass = 'dialog-success';

                                    msg = '<strong>Transferencia Realizada Exitosamente.</strong><br />';

                                    if( data.transferred.length === 1 ) {
                                        msg += 'La cita ha sido transferida exitosamente,  a continuación se muestra el detalle de la transferencia:';
                                    } else {
                                        msg +=
                                            'Las citas han sido transferidas exitosamente, a continuación se muestra el detalle de la transferencia:';
                                    }

                                    msg +=
                                        '<div class=\"table-responsive\">'+
                                            '<table class=\"table table-hover table-condensed\" style=\"margin: 0px 30px;\">'+
                                                '<thead>'+
                                                    '<tr>'+
                                                        '<th>No. Expediente</th>'+
                                                        '<th>Paciente</th>'+
                                                        '<th>Fecha y hora (Cita Transferida)</th>'+
                                                        '<th></th>'+
                                                    '</tr>'+
                                                '</thead>'+
                                                    '<tbody>';

                                    for (var i = 0; i < data.transferred.length; i++) {
                                        msg +=  '<tr>'+
                                                    '<td>'+data.transferred[i].numeroExpediente+'</td>'+
                                                    '<td>'+data.transferred[i].nombrePaciente+'</td>'+
                                                    '<td>'+data.transferred[i].fechaHora+'</td>'+
                                                    '<td><a href=\"";
        // line 922
        echo $this->env->getExtension('routing')->getUrl("citasgetcomprobante");
        echo "?id='+data.transferred[i].id+'\" target=\"_blank\" class=\"btn btn-info\" style=\"color: #ffffff;\"><span class=\"fa fa-print\"> Imprimir</span></a></td>'+
                                                '</tr>';
                                    }

                                    msg +=
                                                    '</tbody>'+
                                                '</table>'+
                                            '</div>';

                                    citasTransferidas = [];
                                }

                                \$('#btn_citas_search').trigger('click');
                                // \$('#error-messages').append(msg);
                            } else {
                                console.error('Error al procesar la transferencia de citas - Detalles del Error: ');
                                console.log(data.errorDetail);

                                title       = 'Error al guardar los cambios';
                                dialogClass = 'dialog-error';
                                msg         = '<strong>Error al tratar de guardar los cambios de la transferencia</strong>. Por favor intente nuevamente, si el problema persiste contacte con el Administrador.';
                                width       = 500;
                            }

                            showDialogMsg(title, msg, dialogClass, null, null, null, width);
                        }
                    })
                    .always(function( jqXHR, textStatus, errorThrown ) {
                        \$('.sonata-ba-content').waitMe('hide');
                    });
                } else {
                    title       = 'Error al Guardar la transferencia.';
                    dialogClass = 'dialog-error';
                    msg         = 'No se puede guardar ningun cambio de transferencia, debido a que <strong>ninguna cita ha sido transferida del Médico Propietario al Médico Suplente.</strong>.';
                    width       = 500;

                    showDialogMsg(title, msg, dialogClass, null, null, null, width);
                }
            });

            function agregarCita(cita, tipoCita) {
                var transferirComoAgregado = \$('#ag-cupo-agregado').prop('checked') ? true : false;
                var esAgregado             = cita.attr('data-id-estado-cita') === '6' ? true : false;
                var tipoCitaBusqueda       = transferirComoAgregado ? ( esAgregado ? 'ag' : tipoCita ) : tipoCita;
                var horario                = buscarHorarioDisponible(tipoCitaBusqueda);
                var tipoCitaNew            = tipoCitaBusqueda;
                var tbody                  = null;
                var atributos              = cita.attr();
                var status                 = false;
                var horarioTitle           = '';
                var tipoCitaOld            = cita.attr('data-id-estado-cita') === '6' ? 'ag' : ( cita.attr('data-id-tipo-cita') === '1' ? 'pv' : 'sb' );
                // var tipoCitaOld         = parseInt( cita.attr('data-id-tipo-cita') ) === 1 ? 'pv' : ( parseInt( cita.attr('data-id-tipo-cita') ) === 2 ? 'sb' : 'ag' );
                var asignado               = cita.closest('.panel').find('.badge.'+tipoCitaOld);

                if(horario !== false) {
                    cita.closest('tr').addClass('hidden');

                    if(cita.closest('tbody').find(\"tr:not('[class*=hidden]')\").length === 0) {
                        if(cita.closest('tbody').find('tr.no-citas').length === 0) {
                            cita.closest('tbody').append('<tr class=\"no-citas\"><td colspan=\"6\"><span class=\"disabled-label\">No hay citas para ser transferidas...</span></td></tr>');
                        } else {
                            cita.closest('tbody').find('tr.no-citas').removeClass('hidden');
                        }
                    }

                    tbody = horario.closest('div.bs-callout').find('table tbody');

                    if(tbody.find('tr.no-citas').length > 0) {
                        tbody.find('tr.no-citas').addClass('hidden');
                    }

                    tbody.append(
                        '<tr>'+
                            '<td>'+
                                '<span class=\"fa fa-trash-o mouse-pointer\" id=\"trash-'+atributos['id']+'\" name=\"trash-'+atributos['name'].replace(/cita/g,'')+'\" data-tipo=\"'+tipoCitaNew+'\">'+
                                '</span>'+
                            '</td>'+
                            '<td>'+atributos['data-numero-expediente']+'</td>'+
                            '<td>'+atributos['data-nombre-paciente']+'</td>'+
                            '<td>'+(tipoCitaBusqueda === 'ag' ? 'Agregado' : 'Programada')+'</td>'+
                            // '<td>'+(primeraVez === true ? 'Primera Vez' : 'Subsecuente')+'</td>'+
                            '<td>'+atributos['data-nombre-tipo-cita']+'</td>'+

                        '</tr>'
                    );

                    cita.iCheck('disable');
                    cita.iCheck('uncheck');
                    /* Actualizando la cantidad de asignados del rango de hora de la cita transferida*/
                    agregarRestarCapacidadAsignado(asignado, asignado, tipoCitaOld, '-');

                    /* Actualizando la cantidad de asignados del rango de hora*/
                    agregarRestarCapacidadAsignado(horario, horario.closest('.bs-callout').find('.collapsed .badge.'+tipoCitaNew), tipoCitaNew, '+');

                    /* Actualizando la cantidad de asignados del día del rango de hora seleccionado*/
                    agregarRestarCapacidadAsignado(horario.closest('.panel').find('.panel-title .badge.'+tipoCitaNew), horario.closest('.panel').find('.panel-title .badge.'+tipoCitaNew), tipoCitaNew, '+', isPanel = true);

                    citasTransferidas.push({ htmlId: atributos['id'], idEmpleado: \$idEmpleadoSuplente.select2('val'), idEspecialidad: \$idEspecialidadSuplente.select2('val'), idCita: atributos['data-id-cita'], fecha: horario.attr('data-fecha'), idRangohora: horario.attr('data-id'), tipoCita: tipoCita, agregado: ( tipoCitaBusqueda === 'ag' ? true : false ), idMotivo: ( tipoCitaBusqueda === 'ag' ? atributos['data-id-justificacion'] : '' )  });

                    status = true;
                }

                return status;
            }

            function agregarRestarCapacidadAsignado(elemento, budge, tipo, action, isPanel) {
                var title     = '';
                var residente = elemento.attr('data-residente') === 'true' ? true : false;
                var generico  = elemento.attr('data-generico') === 'true' ? true : false;
                var isPanel   = isPanel === true ? true : false;

                elemento.attr( 'data-'+tipo+'-asignado', (  action === '+' ? ( parseInt( elemento.attr('data-'+tipo+'-asignado') ) + 1 ) : ( parseInt( elemento.attr('data-'+tipo+'-asignado') ) - 1 ) ) );
                title = elemento.attr('data-'+tipo+'-asignado')+(parseInt( elemento.attr('data-'+tipo+'asignado') ) !== 1 ? ' pacientes asignados' : ' paciente asignado')+
                        ( elemento.attr('data-residente') === 'true' ? ( isPanel ? '' : ( generico ? '' : ' de un total de '+elemento.attr('data-'+tipo+'-capacidad' ) )+' para pacientes ' ) : ' de un total de '+elemento.attr('data-'+tipo+'-capacidad')+' para pacientes ' )+
                        ( tipo === 'pv' ?  'de primera vez' : ( tipo === 'sb' ? 'subsecuentes' : 'agregados' ) );
                budge.attr('title', title);
                budge.empty().append( elemento.attr('data-'+tipo+'-asignado')+( residente === true ?  ( isPanel ? '' : ( generico ? '' : '/'+elemento.attr('data-'+tipo+'-capacidad' ) ) ) : '/'+elemento.attr('data-'+tipo+'-capacidad') ) );

                return;
            }

            function buscarHorarioDisponible(tipo) {
                var horario           = null;
                var pattern           = 'data-'+tipo+'-';
                var lastChecked       = \$('#box-med-suplente').find('input[type=\"checkbox\"]:checked:last');
                var noSchedule        = \$('#ningun-horario').prop('checked');
                var nextScheduleDay   = \$('#siguiente-horario-dia').prop('checked');
                var nextScheduleRange = \$('#siguiente-horario-rango-fecha').prop('checked');

                horario = recorrerHorarios(pattern, \$('#box-med-suplente').find('input[type=\"checkbox\"]:checked'));

                if(horario === null) {
                    if(noSchedule === false) {
                        if(nextScheduleDay === true || nextScheduleRange === true) {
                            horario = recorrerHorarios(pattern, lastChecked.closest('div.bs-callout').nextAll().has(\":checkbox\").find('input[type=\"checkbox\"]'));

                            if(horario === null) {
                                if(nextScheduleRange === true) {
                                    horario = recorrerHorarios(pattern, lastChecked.closest('div.panel').nextAll().has(\":checkbox\").find('input[type=\"checkbox\"]'));

                                    if(horario === null) {
                                        horario = recorrerHorarios(pattern, lastChecked.closest('div[id^=\"content-page-\"]').nextAll().has(\":checkbox\").find('input[type=\"checkbox\"]'));

                                        if(horario === null) {
                                            horario = false;
                                        }
                                    }
                                } else {
                                    horario = false;
                                }
                            }
                        } else {
                            horario = false;
                        }
                    } else {
                        horario = false;
                    }
                }

                return horario;
            }

            function recorrerHorarios(pattern, horarios) {
                var horario    = null;
                var patternType = pattern.replace(/-/g,'').replace(/data/g,'');

                if(horarios.length > 0) {
                    horarios.each(function() {
                        var atributos = \$(this).attr();
                        var capacidad = atributos['data-residente'] === 'true' ? ( atributos['data-generico'] === 'true' ? ( \$('#def-capacidad-'+patternType).val() === '' ? 0 : parseInt( \$('#def-capacidad-'+patternType).val() ) ) : parseInt( atributos[pattern+'capacidad'] ) ) : parseInt( atributos[pattern+'capacidad'] );
                        var asignado  = parseInt( atributos[pattern+'asignado'] );

                        if( (  capacidad - asignado ) > 0 ) {
                            horario = \$(this);
                            return false;
                        } else {
                            return;
                        }
                    });
                }

                return horario;
            }

            function evaluateCheckUncheckIcon(element, iconCheck, msj) {
                var totalCheckBoxes = 0;
                var totalChecked    = 0;
                var totalUnchecked  = 0;
                var check           = null;
                totalCheckBoxes = element.find('input[type=\"checkbox\"]').length;

                element.find('input[type=\"checkbox\"]').each(function(index) {
                    if( \$(this).prop('checked') ) {
                        totalChecked++;
                    } else {
                        totalUnchecked++;
                    }
                });

                if(totalCheckBoxes > 0) {
                    if(totalChecked === totalCheckBoxes) {
                        check = true;
                    } else {
                        if(totalUnchecked === totalCheckBoxes) {
                            check = false;
                        } else {
                            check = null;
                        }
                    }
                } else {
                    check = false;
                }

                checkUncheckIcon(iconCheck, check, msj);
            }

            function checkUncheckIcon(element, check, title) {
                switch (check) {
                    case true:
                        element.removeClass('fa-square-o');
                        element.removeClass('fa-minus-square');
                        element.addClass('fa-check-square');
                        element.attr('title','Click para deseleccionar todos los pacientes '+title);
                        element.css({'color': '#428bca'});
                        break;
                    case false:
                        element.removeClass('fa-check-square');
                        element.removeClass('fa-minus-square');
                        element.addClass('fa-square-o');
                        element.attr('title','Click para deseleccioar todos los pacientes '+title);
                        element.css({'color': '#989898'});
                        break;
                    default:
                        element.removeClass('fa-square-o');
                        element.removeClass('fa-check-square');
                        element.addClass('fa-minus-square');
                        element.attr('title','Click para deseleccioar todos los pacientes '+title);
                        element.css({'color': '#428bca'});
                        break;
                }
            }

            function evaluateExpandCompressIcon(element, iconElement) {
                var totalCollapsed = 0;
                var totalShow      = 0;
                var totalHide      = 0;
                var type           = null;

                totalCollapsed = element.find('div.panel-collapse').length;

                element.find('div.panel-collapse').each(function(index) {
                    if( \$(this).hasClass('in') ) {
                        totalShow++;
                    } else {
                        totalHide++;
                    }
                });

                if(totalCollapsed > 0) {
                    if(totalShow === totalCollapsed) {
                        type = true;
                    } else {
                        if(totalHide === totalCollapsed) {
                            type = false;
                        } else {
                            type = null;
                        }
                    }
                } else {
                    type = null;
                }

                expandCompressIcon(iconElement, type);
            }

            function expandCompressIcon(element, type) {
                switch (type) {
                    case true:
                        element.removeClass('fa-expand');
                        element.addClass('fa-compress');
                        element.attr('title','Click para contraer todas las fechas');
                        element.css({'color': '#428bca'});
                        break;
                    default:
                        element.removeClass('fa-compress');
                        element.addClass('fa-expand');
                        element.attr('title','Click para expandir todas las fechas');
                        element.css({'color': '#989898'});
                        break;
                }
            }

            function evaluatePagination(element) {
                var parent          = element.parent();
                var First           = parent.parent().find('a[aria-label=\"First\"]');
                var Last            = parent.parent().find('a[aria-label=\"Last\"]');
                var Next            = parent.parent().find('a[aria-label=\"Next\"]');
                var Previous        = parent.parent().find('a[aria-label=\"Previous\"]');
                var lastPage        = parseInt( Last.attr('data-page') );
                var firstPage       = parseInt( First.attr('data-page') );
                var newActivePage   = parseInt( element.attr('data-page') );
                var newNextPage     = (lastPage - newActivePage) > 0 ? (newActivePage + 1) : lastPage;
                var newPreviousPage = (newActivePage - firstPage) > 0 ? (newActivePage - 1) : firstPage;
                var propietario     = parent.parent().attr('id') === 'pagination-mdp-propietario' ? true : false;
                var pageIdPattern   = propietario ? 'box-med-propietario' : 'box-med-suplente';
                var contentPage     = element.closest('#content-page-'+newActivePage);

                parent.siblings().removeClass('active');
                parent.parent().find('a[href=\"#page'+newActivePage+'\"]').parent().addClass('active');
                parent.siblings().removeClass('hidden');

                switch (element.attr('aria-label')) {
                    case 'First':
                        parent.addClass('hidden');
                        Previous.parent().addClass('hidden');
                        break;
                    case 'Last':
                        parent.addClass('hidden');
                        Next.parent().addClass('hidden');
                        break;
                    default:
                        hideNextLast(lastPage, newActivePage, Next, Last);
                        hidePreviousFirst(firstPage, newActivePage, Previous, First);
                        break;
                }

                Next.attr('data-page', newNextPage);
                Previous.attr('data-page', newPreviousPage);

                \$('body #'+ pageIdPattern +' div[id^=\"content-page-\"]').addClass('hidden');
                \$('body #'+ pageIdPattern +' #content-page-'+newActivePage).removeClass('hidden');

                evaluateCheckUncheckIcon(contentPage, \$('#'+pageIdPattern+' i.check-hole'), '');
                evaluateExpandCompressIcon(contentPage, \$('#'+pageIdPattern+' i.expand-all'));
            }

            function hidePreviousFirst(firstPage, newActivePage, Previous, First) {
                if( (newActivePage - firstPage) <= 1 ) {
                    if( (newActivePage - firstPage) === 0 ) {
                        Previous.parent().addClass('hidden');
                    }

                    First.parent().addClass('hidden');
                }
            }

            function hideNextLast(lastPage, newActivePage, Next, Last) {
                if( (lastPage - newActivePage) <= 1 ) {
                    if( (lastPage - newActivePage) === 0 ) {
                        Next.parent().addClass('hidden');
                    }

                    Last.parent().addClass('hidden');
                }
            }

            function getMedico(element) {
                \$.ajax({
                    url: Routing.generate(\"citasgetmedico\"),
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        \$.each(data.data1, function(indice, val) {
                            if (superAdmin) {
                                element.append( \$('<option>', {value: val.id, text: val.nombre, 'data-residente': val.residente} ) );
                            } else {
                                if( val.idEstablecimiento === ";
        // line 1288
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado")) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdEstablecimiento"), "getId"), "html", null, true);
        } else {
            echo "''";
        }
        echo " ) {
                                    element.append( \$('<option>', {value: val.id, text: val.nombre, 'data-residente': val.residente} ) );
                                }
                            }
                        });
                    }
                });
            }

            function getMedicoEspecialidad(element, idEmpleado) {
                if(idEmpleado) {
                    \$.ajax({
                        url: Routing.generate('citasgetmedicoespecialidadestab') + '?idEmpleado=' + idEmpleado,
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            if(Object.keys(data.result).length > 0) {
                                \$.each(data.result, function(indice, val) {
                                    if (superAdmin) {
                                        element.append(\$('<option>', {value: val.id, text: val.nombre}));
                                    } else {
                                        if (val.idEstablecimiento === ";
        // line 1309
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado")) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdEstablecimiento"), "getId"), "html", null, true);
        } else {
            echo "''";
        }
        echo ") {
                                            element.append(\$('<option>', {value: val.id, text: val.nombre }));
                                        }
                                    }
                                });

                                enableDisableEspecialidadSuplente();
                            } else {
                                var propietario = \$(element).attr('id') === '";
        // line 1317
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEspecialidadPropietario' ? true : false;
                                var idMessage   = 'error-messages';
                                var idEmpleado  = propietario === true ? '";
        // line 1319
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleadoPropietario' : '";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleadoSuplente';

                                \$('#'+idMessage).empty();
                                \$('#'+idMessage).append(
                                    '<div class=\"alert alert-warning\" role=\"alert\">'+
                        \t\t\t\t'<h4><i class=\"fa fa-warning\"></i> Especialidad no encontrada</h4>'+
                        \t\t\t\t'El médico '+\$('#'+idEmpleado).select2('data').text+' <strong>No posee ninguna especialidad</strong> por favor contacte al encargado de la consulta externa para que se le cofigure sus especialidades.'+
                        \t\t\t'</div>'
                                );
                            }
                        }
                    });
                }
            }

            function validate() {
                var errorArray = [];

                if(!\$idEmpleadoPropietario.select2('val')) {
                    errorArray.push({id: 'idEmpleadoPropietario', nombre: 'Nombre del Médico Propietario'});
                }

                if(!\$idEspecialidadPropietario.select2('val')) {
                    errorArray.push({id: 'idEspecialidadSuplente', nombre: 'Especialidad del Médico Propietario'});
                }

                if(!\$idEmpleadoSuplente.select2('val')) {
                    errorArray.push({id: 'idEmpleadoSuplente', nombre: 'Nombre del Médico Suplente'});
                }

                if(!\$idEspecialidadSuplente.select2('val')) {
                    errorArray.push({id: 'idEspecialidadSuplente', nombre: 'Especialidad del Médico Suplente'});
                }

                if(!\$rangoFecha.val()) {
                    errorArray.push({id: 'rangoFecha', nombre: 'Rango de Fecha'});
                }

                return errorArray;
            }

            function initializeICheck() {
                \$('.icheck').each(function() {
                    var type = \$(this).attr('data-type');

                    \$(this).iCheck({
                        checkboxClass: 'icheckbox_'+type,
                        radioClass: 'iradio_'+type
                    });
                });
            }

            function cssComplement() {
                \$('body .panel-heading.dia-no-disponible').parent().css({'border-right': '1px solid #F3F4F5', 'border-left': '3px solid #E6E7E8', 'border-top': '1px solid #F3F4F5', 'border-bottom': '1px solid #F3F4F5'});
                \$('body .panel-heading.dia-bloqueado').parent().css({'border-right': '1px solid #FFE7E7', 'border-left': '3px solid #DD4B39', 'border-top': '1px solid #FFE7E7', 'border-bottom': '1px solid #FFE7E7'});
                \$('body .panel-heading.dia-festivo').parent().css({'border-right': '1px solid #FFF1E1', 'border-left': '3px solid #ED872D', 'border-top': '1px solid #FFF1E1', 'border-bottom': '1px solid #FFF1E1'});
            }

            function cleanElements(showEmptyMessage) {
                showEmptyMessage = (typeof showEmptyMessage === 'undefined') ? true : showEmptyMessage;

                if(autoClean) {
                    \$('#ningun-horario').iCheck('check');

                    \$('#box-med-propietario .display-tools').addClass('hidden');
                    \$('#med-propietario-message').empty();
                    if(showEmptyMessage) { \$('#med-propietario-message').append('<div class=\"alert alert-info\" role=\"alert\">Haga click en el botón <strong>Consultar</strong> para ver los resultados de la búsqueda...</div>'); }
                    \$('#box-med-propietario .todo-list').empty();
                    \$('#box-med-propietario .todo-list').css('margin-top','');
                    \$('#pagination-mdp-propietario').empty();

                    \$('#box-med-suplente .display-tools').addClass('hidden');
                    \$('#med-suplente-message').empty();
                    if(showEmptyMessage) { \$('#med-suplente-message').append('<div class=\"alert alert-info\" role=\"alert\">Haga click en el botón <strong>Consultar</strong> para ver los resultados de la búsqueda...</div>'); }
                    \$('#box-med-suplente .todo-list').empty();
                    \$('#box-med-suplente .todo-list').css('margin-top','');
                    \$('#pagination-mdp-suplente').empty();
                }
            }

            function getIndexOfK(arr, field, clue) {
                for (var i = 0; i < arr.length; i++) {
                    if (arr[i][field] === clue) {
                        return i;
                    }
                }
                return -1;
            }

            function saveButtonChangeStatus() {
                if(citasTransferidas.length > 0) {
                    \$('#guardar-citas').prop('disabled', false);
                } else {
                    \$('#guardar-citas').prop('disabled', 'disabled');
                }
            }

            function enableDisableEspecialidadSuplente() {
                \$('#'+\$idEspecialidadSuplente.attr('id')+' option[disabled]').each(function() {
                    \$(this).removeAttr('disabled');
                });

                if(\$idEmpleadoPropietario.select2('val') === \$idEmpleadoSuplente.select2('val')) {
                    \$('#'+\$idEspecialidadSuplente.attr('id')+' option[value=\"'+\$idEspecialidadPropietario.select2('val')+'\"]').attr('disabled','disabled');
                }
            }
        });
    </script>
";
    }

    // line 1429
    public function block_content($context, array $blocks = array())
    {
        // line 1430
        echo "    <div id=\"error-messages\"></div>
    <div class=\"row\">
        <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
            <div class=\"box box-success\">
                <div class=\"box-header with-border\">
                    <h3 class=\"box-title\">Transferencia de citas</h3>
                </div>
                <div class=\"box-body\">
                    <div class=\"row\">
                        <div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\">
                            <div class=\"small-box bg-aqua\">
                                <div class=\"inner\" style=\"padding-right: 90px;\">
                                    <h4><strong>Datos del Médico Propietario</strong></h4>
                                    <p>Médico al que pertenecen las citas.</p>
                                    <div class=\"form-group\" id=\"sonata-ba-field-container-";
        // line 1444
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleadoPropietario\">
                                        <label class=\"control-label required\" for=\"";
        // line 1445
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleadoPropietario\">
                                            Nombre
                                        </label>
                                        <div class=\"input-group sonata-ba-field sonata-ba-field-standard-natural\" style=\"width:100%;\">
                                            <select id=\"";
        // line 1449
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleadoPropietario\" name=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "[idEmpleadoPropietario]\"></select>
                                        </div>
                                    </div>
                                    <div class=\"form-group\" id=\"sonata-ba-field-container-";
        // line 1452
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEspecialidadPropietario\" style=\"width:100%;\">
                                        <label class=\"control-label required\" for=\"";
        // line 1453
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEspecialidadPropietario\">
                                            Especialidad
                                        </label>
                                        <div class=\"input-group sonata-ba-field sonata-ba-field-standard-natural\" style=\"width:100%;\">
                                            <select id=\"";
        // line 1457
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEspecialidadPropietario\" name=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "[idEspecialidadPropietario]\"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"icon\">
                                    <i class=\"fa fa-user-md\"></i>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-6\">
                            <div class=\"small-box bg-teal\">
                                <div class=\"inner\" style=\"padding-right: 90px;\">
                                    <h4><strong>Datos del Médico Suplente</strong></h4>
                                    <p>Médico al que se le trasladrán las citas</p>
                                    <div class=\"form-group\" id=\"sonata-ba-field-container-";
        // line 1471
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleadoSuplente\">
                                        <label class=\"control-label required\" for=\"";
        // line 1472
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleadoSuplente\">
                                            Nombre
                                        </label>
                                        <div class=\"input-group sonata-ba-field sonata-ba-field-standard-natural\" style=\"width:100%;\">
                                            <select id=\"";
        // line 1476
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleadoSuplente\" name=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "[idEmpleadoSuplente]\"></select>
                                        </div>
                                    </div>
                                    <div class=\"form-group\" id=\"sonata-ba-field-container-";
        // line 1479
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEspecialidadSuplente\" style=\"width:100%;\">
                                        <label class=\"control-label required\" for=\"";
        // line 1480
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEspecialidadSuplente\">
                                            Especialidad
                                        </label>
                                        <div class=\"input-group sonata-ba-field sonata-ba-field-standard-natural\" style=\"width:100%;\">
                                            <select id=\"";
        // line 1484
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEspecialidadSuplente\" name=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "[idEspecialidadSuplente]\"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"icon\">
                                    <i class=\"fa fa-user-md\"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-xs-12 col-sm-9 col-md-10 col-lg-10\">
                            <div class=\"form-group\" id=\"sonata-ba-field-container-";
        // line 1496
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_rangoFecha\">
                                <label class=\"control-label required\" for=\"";
        // line 1497
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_rangoFecha\">
                                    Seleccione el Rango de Fecha
                                </label>
                                <div class=\"input-group sonata-ba-field sonata-ba-field-standard-natural\">
                                    <span class=\"input-group-addon\"><span class=\"glyphicon glyphicon-calendar\"></span></span>
                                    <input type=\"text\" class=\"form-control bootstrap-daterangepicker\" id=\"";
        // line 1502
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_rangoFecha\" name=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "[rangoFecha]\"
                                           data-mask=\"99/99/9999 - 99/99/9999\" placeholder=\"dd/mm/yyyy - dd/mm/yyyy\" value=\"\" style=\"text-align:center; background-color: #FFFFFF;\" data-date-start-date=\"";
        // line 1503
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d/m/Y"), "html", null, true);
        echo "\"
                                           data-date-min-date=\"";
        // line 1504
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d/m/Y"), "html", null, true);
        echo "\" data-date-show-dropdowns=\"true\" data-date-opens=\"center\" data-date-auto-apply=\"true\";
                                     />
                                </div>
                            </div>
                        </div>
                        <div class=\"col-xs-12 col-sm-3 col-md-2 col-lg-2\">
                            <div class=\"form-group\" id=\"sonata-ba-field-container-";
        // line 1510
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_btnSearch\" style=\"height: 59px;vertical-align: bottom;display: table-cell;\">
                                <button type=\"button\" class=\"btn btn-info\" id=\"btn_citas_search\" name=\"btn_citas_search\"><i class=\"fa fa-search\"></i> Consultar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-xs-12 col-md-12 col-lg-12\">
            <div id=\"info-box-message\" class=\"bs-callout bs-callout-default hidden\">
                <h4>Información</h4>
                <div class=\"row\" style=\"padding-left:15px;\">
                    <div class=\"col-md-12\">
                        <strong style=\"display:block;\">Codigo de Colores:</strong>
                        <label class=\"label\" style=\"background-color: #0073b7; height: 19px; width: 19px; display: inline-flex;\"></label> <label class=\"label\" style=\"color: #777; font-size: 100%;\">Primera Vez</label>
                        <label class=\"label\" style=\"background-color: #00a65a; height: 19px; width: 19px; display: inline-flex;\"></label> <label class=\"label\" style=\"color: #777; font-size: 100%;\">Subsecuentes</label>
                        <label class=\"label\" style=\"background-color: #39cccc; height: 19px; width: 19px; display: inline-flex;\"></label> <label class=\"label\" style=\"color: #777; font-size: 100%;\">Agregados</label>
                    </div>
                    <div class=\"col-md-12\">
                        <br />
                        <div class=\"alert alert-info\" role=\"alert\" style=\"margin-left: 0px;\">
                            <strong style=\"display:block;\">Indicaciones de Traslado de Citas:</strong>
                            <p style=\"padding-left:20px;\">
                                Una vez que haya seleccionado todas las citas que desea transferir, haga click sobre el botón <strong>Transferir</strong>. <strong>Los cambios de transferencia serán
                                aplicados solamente si se hace click sobre el botón Guardar</strong>.<br />
                                A continuaci&oacute;n se le presenta una lista de opciones para el traslado de citas del m&eacute;dico propietario al m&eacute;dico suplente:
                            </p>
                            <br />
                            <div class=\"row\" style=\"padding-left:20px;\">
                                <div class=\"col-xs-12 col-sm-12 col-md-6 col-md-6\">
                                    <div class=\"callout callout-info\">
                                        <h4>Configuración de Citas a Transferir:</h4>
                                        <div class=\"row\" class=\"color: #777 !importan;\">
                                            <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                                                <div class=\"row\">
                                                    <div class=\"col-xs-6 col-sm-5 col-md-4 col-lg-3\">
                                                        <div class=\"radio\">
                                                            <label>
                                                                <input type=\"radio\" id=\"ningun-horario\" name=\"optionsRadios\" class=\"icheck\" data-type=\"square-blue\" checked />
                                                                <strong>Transferir únicamente en dia(s) y horario(s) seleccionados</strong>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class=\"col-xs-6 col-sm-7 col-md-8 col-lg-9\">
                                                        Si selecciona esta opción, <strong>solamente se asignarán citas en los horarios seleccionados</strong>, para el día o días al que pertenece el/los horario(s). Si la capacidad de estos son menores al número de citas que se desea transferir, <strong>las citas restantes no serán transferidas</strong>.
                                                    </div>
                                                </div>
                                                ";
        // line 1573
        echo "                                                <div class=\"row hidden\">
                                                    <div class=\"col-xs-6 col-sm-5 col-md-4 col-lg-3\">
                                                        <div class=\"radio\">
                                                            <label>
                                                                <input type=\"radio\" id=\"siguiente-horario-rango-fecha\" name=\"optionsRadios\" class=\"icheck\" data-type=\"square-blue\" />
                                                                <strong>Transferir a partir de la Fecha y Hora dentro del Rango de Búsqueda</strong>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class=\"col-xs-6 col-sm-7 col-md-8 col-lg-9\">
                                                        Si selecciona esta opción, le permitirá asignar citas del médico propietario, al médico suplente en los siguientes horarios disponibles <strong>posteriores al último horario seleccionado del rango de fechas del cual se ha realizado la búsqueda</strong>.
                                                        Esta opción es aplicada <strong>solamente cuando el número de citas que se desean transferir sobrepasan la capacidad del/los horarios seleccionados</strong>.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-xs-12 col-sm-12 col-md-6 col-md-6\">
                                    <div class=\"callout callout-warning\">
                                        <h4>Configuración de Pacientes Agregados a transferir:</h4>
                                        <div class=\"row\" class=\"color: #777 !important;\">
                                            <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                                                <div class=\"row\">
                                                    <div class=\"col-xs-6 col-sm-5 col-md-4 col-lg-3\">
                                                        <div class=\"radio\">
                                                            <label>
                                                                <input type=\"radio\" id=\"ag-cupo-ordinario\" name=\"optionsRadios2\" class=\"icheck\" data-type=\"square-yellow\" checked />
                                                                <strong>Cupo Ordinario</strong>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class=\"col-xs-6 col-sm-7 col-md-8 col-lg-9\">
                                                        Si selecciona esta opción, los pacientes <strong>agregados</strong> del médico propietario<strong>serán asignados en los cupos ordinarios</strong> (primera vez y subsecuentes) del médico suplente.
                                                    </div>
                                                </div>
                                                <div class=\"row\">
                                                    <div class=\"col-xs-6 col-sm-5 col-md-4 col-lg-3\">
                                                        <div class=\"radio\">
                                                            <label>
                                                                <input type=\"radio\" id=\"ag-cupo-agregado\" name=\"optionsRadios2\" class=\"icheck\" data-type=\"square-yellow\" />
                                                                <strong>Cupo Agregado</strong>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class=\"col-xs-6 col-sm-7 col-md-8 col-lg-9\">
                                                        Si selecciona esta opción, los pacientes <strong>agregados</strong> del médico propietario<strong>serán asignados en los cupos de pacientes agregados</strong> del médico suplente.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-xs-12 col-sm-12 col-md-12 col-md-12 residente-capacidad hidden\">
                                    <strong>Definir Capacidad de Atencion de Paciente</strong>
                                    <div class=\"row\" style=\"padding-left:25px;padding-right:25px;\">
                                        <div class=\"col-xs-5 col-sm-4 col-md-3 col-lg-2\">
                                            <div class=\"form-inline\">
                                                <div class=\"form-group\">
                                                    <label for=\"def-pv-capacidad\">Capacidad Primera Vez</label>
                                                    <div class=\"input-group\">
                                                        <span class=\"input-group-addon\">#</span>
                                                        <input type=\"text\" id=\"def-capacidad-pv\" class=\"form-control\" placeholder=\"0\" data-mask=\"9?9\">
                                                    </div>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label for=\"def-sb-capacidad\">Capacidad Subsecuentes</label>
                                                    <div class=\"input-group\">
                                                        <span class=\"input-group-addon\">#</span>
                                                        <input type=\"text\" id=\"def-capacidad-sb\" class=\"form-control\" placeholder=\"0\" data-mask=\"9?9\">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=\"col-xs-7 col-sm-8 col-md-9 col-lg-10\">
                                            Esta opción le permite asignar <strong>las capacidad de citas que puede atender el médico suplente</strong> en los hoarios seleccionados (y en los posteriores a este, dependiendo de la configuración de la opción <strong>\"Asignar cita en el siguiente horario disponible\"</strong>
                                            que se haya seleccionado), para pacientes de primera vez como subsecuentes y sólo <strong>cuando el médico suplente seleccionado es residente</strong>. Si no se asigna una capacidad se tómara como <strong>valor por defecto CERO</strong>.
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-xs-12 col-sm-12 col-md-12 col-md-12\">
                                    <div class=text-right>
                                        <button id=\"transferir-citas\" type=\"button\" class=\"btn btn-primary\"><div class=\"double-arrow-icon\"><span class=\"fa fa-long-arrow-left\"></span><span class=\"fa fa-long-arrow-right\"></span></div> Transferir</button>
                                        <button id=\"guardar-citas\" type=\"button\" class=\"btn btn-success\" disabled=\"disabled\"><span class=\"glyphicon glyphicon-floppy-disk\"></span> Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6\">
            <div class=\"box box-info\" id=\"box-med-propietario\">
                <div class=\"box-header\">
                    <i class=\"fa fa-calendar\"></i>
                    <h3 class=\"box-title\">Citas del Médico Propietario</h3>
                    <div class=\"box-tools pull-right\">
                        <ul class=\"pagination pagination-sm inline\" id=\"pagination-mdp-propietario\">
                        </ul>
                    </div>
                </div>
                <div class=\"box-body\">
                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <div class=\"display-tools pull-right hidden\" style=\"font-size:18px;color:#989898;padding: 0px 16px 15px 0px;\">
                                <i class=\"fa fa-expand expand-all\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Click para expandir todas las fechas\"></i>
                                <i class=\"fa fa-square-o check-hole\" style=\"padding-left:10px;\" title=\"Click para Seleccionar las citats de todas las fechas\"></i>
                            </div>
                        </div>
                        <div class=\"col-md-12\">
                            <div id=\"med-propietario-message\">
                                <div class=\"alert alert-info\" role=\"alert\">
                                    Haga click en el botón <strong>Consultar</strong> para ver los resultados de la búsqueda...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"todo-list\">
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-xs-12 col-sm-12 col-md-6 col-lg-6\">
            <div class=\"box box-success aqua\" id=\"box-med-suplente\">
                <div class=\"box-header\">
                    <i class=\"fa fa-calendar\"></i>
                    <h3 class=\"box-title\">Citas del Médico Suplente</h3>
                    <div class=\"box-tools pull-right\">
                        <ul class=\"pagination pagination-sm inline\" id=\"pagination-mdp-suplente\">
                        </ul>
                    </div>
                </div>
                <div class=\"box-body\">
                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <div class=\"display-tools pull-right hidden\" style=\"font-size:18px;color:#989898;padding: 0px 16px 15px 0px;\">
                                <i class=\"fa fa-expand expand-all\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Click para expandir todas las fechas\"></i>
                            </div>
                        </div>
                        <div class=\"col-md-12\">
                            <div id=\"med-suplente-message\">
                                <div class=\"alert alert-info\" role=\"alert\">
                                    Haga click en el botón <strong>Consultar</strong> para ver los resultados de la búsqueda...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"todo-list\">
                    </div>
                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:Custom:transfer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1720 => 1573,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1480,  1609 => 1479,  1594 => 1472,  1590 => 1471,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 922,  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 697,  803 => 630,  606 => 447,  691 => 492,  655 => 481,  484 => 412,  552 => 439,  709 => 255,  397 => 168,  392 => 251,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 988,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 767,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 759,  992 => 720,  962 => 697,  960 => 696,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 279,  419 => 293,  639 => 468,  611 => 386,  538 => 431,  646 => 307,  642 => 286,  544 => 434,  541 => 204,  517 => 192,  797 => 489,  752 => 533,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 430,  519 => 425,  416 => 221,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 416,  775 => 413,  762 => 540,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 203,  534 => 348,  530 => 428,  521 => 194,  489 => 179,  483 => 206,  394 => 217,  396 => 206,  345 => 189,  476 => 174,  386 => 162,  364 => 235,  234 => 158,  595 => 326,  589 => 267,  586 => 436,  562 => 505,  556 => 274,  506 => 103,  498 => 417,  492 => 274,  473 => 277,  458 => 121,  399 => 209,  352 => 219,  346 => 125,  328 => 179,  880 => 699,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 244,  573 => 516,  567 => 507,  520 => 247,  481 => 335,  475 => 275,  472 => 172,  466 => 227,  441 => 346,  438 => 189,  432 => 230,  429 => 222,  395 => 400,  382 => 248,  378 => 211,  367 => 115,  357 => 222,  348 => 190,  334 => 207,  286 => 169,  205 => 106,  297 => 189,  218 => 108,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 561,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 540,  705 => 539,  701 => 261,  690 => 302,  687 => 301,  671 => 262,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 281,  609 => 273,  602 => 230,  591 => 439,  571 => 419,  499 => 268,  488 => 273,  389 => 235,  223 => 143,  14 => 2,  306 => 117,  303 => 159,  300 => 98,  292 => 95,  280 => 108,  12 => 36,  624 => 282,  620 => 223,  612 => 232,  601 => 379,  599 => 441,  580 => 265,  574 => 263,  559 => 504,  526 => 427,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 172,  401 => 119,  391 => 216,  369 => 228,  333 => 95,  329 => 93,  307 => 192,  287 => 152,  195 => 140,  178 => 108,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 460,  663 => 484,  660 => 194,  657 => 482,  650 => 238,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 221,  603 => 229,  600 => 178,  594 => 440,  588 => 372,  584 => 158,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 156,  513 => 244,  479 => 334,  468 => 163,  451 => 307,  448 => 195,  424 => 296,  418 => 222,  410 => 151,  376 => 109,  373 => 209,  340 => 209,  326 => 212,  261 => 138,  118 => 70,  200 => 119,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 991,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 768,  1056 => 766,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 536,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 712,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 563,  785 => 560,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 258,  712 => 437,  710 => 502,  707 => 501,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 241,  654 => 357,  649 => 308,  643 => 306,  640 => 226,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 501,  550 => 255,  527 => 153,  515 => 191,  512 => 423,  509 => 422,  503 => 419,  496 => 282,  493 => 415,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 214,  408 => 173,  388 => 292,  371 => 136,  363 => 133,  350 => 191,  342 => 274,  335 => 182,  316 => 16,  290 => 154,  276 => 102,  266 => 140,  263 => 102,  255 => 87,  245 => 153,  207 => 104,  194 => 92,  184 => 118,  76 => 34,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 491,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 219,  627 => 236,  622 => 369,  619 => 212,  616 => 276,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 368,  572 => 204,  566 => 324,  547 => 435,  545 => 253,  542 => 156,  533 => 429,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 163,  443 => 162,  431 => 251,  428 => 250,  425 => 156,  422 => 338,  412 => 152,  406 => 111,  390 => 164,  383 => 161,  377 => 246,  375 => 210,  372 => 234,  370 => 208,  359 => 204,  356 => 132,  353 => 131,  349 => 220,  336 => 272,  332 => 206,  330 => 122,  318 => 105,  313 => 119,  291 => 153,  190 => 98,  321 => 106,  295 => 154,  274 => 71,  242 => 118,  236 => 116,  70 => 19,  170 => 95,  288 => 187,  284 => 109,  279 => 134,  275 => 180,  256 => 171,  250 => 135,  237 => 129,  232 => 79,  222 => 123,  191 => 91,  153 => 73,  150 => 70,  563 => 188,  560 => 275,  558 => 195,  553 => 256,  549 => 438,  543 => 179,  537 => 176,  532 => 201,  528 => 199,  525 => 311,  523 => 195,  518 => 292,  514 => 339,  511 => 243,  508 => 188,  501 => 186,  491 => 288,  487 => 337,  460 => 240,  455 => 120,  449 => 164,  442 => 278,  439 => 133,  436 => 159,  433 => 185,  426 => 180,  420 => 220,  415 => 121,  411 => 174,  405 => 211,  403 => 149,  380 => 247,  366 => 285,  354 => 102,  331 => 198,  325 => 267,  320 => 265,  317 => 199,  311 => 262,  308 => 173,  304 => 191,  272 => 105,  267 => 91,  249 => 85,  216 => 146,  155 => 93,  146 => 69,  126 => 104,  188 => 119,  181 => 128,  161 => 79,  110 => 53,  124 => 80,  692 => 373,  683 => 282,  678 => 279,  676 => 488,  666 => 485,  661 => 407,  656 => 402,  652 => 376,  645 => 236,  641 => 352,  635 => 376,  631 => 463,  625 => 460,  615 => 453,  607 => 363,  597 => 163,  590 => 223,  583 => 435,  579 => 353,  577 => 420,  575 => 212,  569 => 514,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 139,  529 => 222,  524 => 344,  516 => 424,  510 => 78,  504 => 145,  500 => 418,  495 => 416,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 158,  421 => 223,  417 => 219,  400 => 148,  385 => 203,  361 => 207,  344 => 127,  339 => 273,  324 => 102,  310 => 118,  302 => 115,  296 => 96,  282 => 143,  259 => 151,  244 => 142,  231 => 123,  226 => 155,  215 => 107,  186 => 88,  152 => 103,  114 => 75,  104 => 50,  358 => 209,  351 => 130,  347 => 208,  343 => 188,  338 => 125,  327 => 203,  323 => 201,  319 => 176,  315 => 198,  301 => 204,  299 => 190,  293 => 111,  289 => 162,  281 => 182,  277 => 107,  271 => 157,  265 => 150,  262 => 68,  260 => 146,  257 => 137,  251 => 157,  248 => 139,  239 => 117,  228 => 156,  225 => 111,  213 => 70,  211 => 121,  197 => 118,  174 => 85,  148 => 70,  134 => 81,  127 => 57,  20 => 1,  270 => 150,  253 => 124,  233 => 127,  212 => 106,  210 => 103,  206 => 141,  202 => 114,  198 => 104,  192 => 116,  185 => 94,  180 => 118,  175 => 81,  172 => 106,  167 => 104,  165 => 108,  160 => 95,  137 => 65,  113 => 76,  100 => 42,  90 => 29,  81 => 34,  65 => 30,  129 => 82,  97 => 45,  77 => 24,  34 => 3,  53 => 31,  84 => 80,  58 => 18,  23 => 3,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 287,  427 => 226,  423 => 256,  413 => 220,  409 => 219,  407 => 247,  402 => 210,  398 => 401,  393 => 296,  387 => 249,  384 => 214,  381 => 236,  379 => 110,  374 => 137,  368 => 207,  365 => 119,  362 => 234,  360 => 223,  355 => 280,  341 => 126,  337 => 201,  322 => 266,  314 => 162,  312 => 174,  309 => 100,  305 => 204,  298 => 165,  294 => 142,  285 => 152,  283 => 151,  278 => 142,  268 => 176,  264 => 174,  258 => 172,  252 => 136,  247 => 133,  241 => 163,  229 => 135,  220 => 72,  214 => 155,  177 => 77,  169 => 83,  140 => 67,  132 => 83,  128 => 62,  107 => 42,  61 => 19,  273 => 179,  269 => 104,  254 => 99,  243 => 152,  240 => 130,  238 => 140,  235 => 139,  230 => 114,  227 => 112,  224 => 124,  221 => 152,  219 => 128,  217 => 150,  208 => 132,  204 => 138,  179 => 112,  159 => 71,  143 => 68,  135 => 63,  119 => 78,  102 => 44,  71 => 21,  67 => 29,  63 => 19,  59 => 14,  28 => 4,  94 => 42,  89 => 41,  85 => 26,  75 => 19,  68 => 29,  56 => 12,  87 => 27,  201 => 118,  196 => 95,  183 => 211,  171 => 84,  166 => 98,  163 => 76,  158 => 73,  156 => 72,  151 => 68,  142 => 84,  138 => 65,  136 => 65,  121 => 58,  117 => 52,  105 => 51,  91 => 38,  62 => 15,  49 => 30,  25 => 4,  21 => 2,  31 => 4,  38 => 9,  26 => 6,  24 => 13,  19 => 5,  93 => 83,  88 => 43,  78 => 78,  46 => 25,  44 => 13,  27 => 14,  79 => 20,  72 => 33,  69 => 31,  47 => 14,  40 => 5,  37 => 7,  22 => 12,  246 => 134,  157 => 97,  145 => 90,  139 => 90,  131 => 63,  123 => 73,  120 => 56,  115 => 55,  111 => 48,  108 => 59,  101 => 47,  98 => 43,  96 => 84,  83 => 39,  74 => 28,  66 => 20,  55 => 27,  52 => 15,  50 => 12,  43 => 24,  41 => 12,  35 => 6,  32 => 15,  29 => 2,  209 => 147,  203 => 119,  199 => 94,  193 => 94,  189 => 116,  187 => 113,  182 => 68,  176 => 100,  173 => 65,  168 => 78,  164 => 97,  162 => 107,  154 => 66,  149 => 163,  147 => 91,  144 => 92,  141 => 66,  133 => 64,  130 => 97,  125 => 58,  122 => 84,  116 => 69,  112 => 53,  109 => 47,  106 => 51,  103 => 41,  99 => 40,  95 => 39,  92 => 43,  86 => 38,  82 => 36,  80 => 25,  73 => 37,  64 => 29,  60 => 29,  57 => 32,  54 => 13,  51 => 26,  48 => 9,  45 => 10,  42 => 9,  39 => 10,  36 => 4,  33 => 7,  30 => 5,);
    }
}
