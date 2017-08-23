<?php

/* MinsalFarmaciaBundle:FarmRecetas:complement.html.twig */
class __TwigTemplate_16b071d09d5e7e4b420686e3d3b2fac34b7bff750ca5deb3e5b54826f5b9ccf1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'sonata_breadcrumb' => array($this, 'block_sonata_breadcrumb'),
            'javascripts' => array($this, 'block_javascripts'),
            'form' => array($this, 'block_form'),
            'sonata_pre_fieldsets' => array($this, 'block_sonata_pre_fieldsets'),
            'sonata_tab_content' => array($this, 'block_sonata_tab_content'),
            'sonata_post_fieldsets' => array($this, 'block_sonata_post_fieldsets'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_sonata_breadcrumb($context, array $blocks = array())
    {
    }

    // line 4
    public function block_javascripts($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script type=\"text/javascript\">

        jQuery(document).ready(function (\$) {
            /* Inicializar Selectores */
            var formActionsDiv     = \$('#formActionsDiv');
            var formButtonsDiv     = \$('#formButtonsDiv');
            var fecha              = \$('input[id\$=\"_fecha\"]');
            var numExpNomPac       = \$('#numExpNomPac');
            var idEmpleado         = \$('select[id\$=\"_idEmpleado\"]');
            var idAtenAreaModEstab = \$('select[id\$=\"_idAtenAreaModEstab\"]');
            var idCitaDia          = \$('input[id\$=\"_idCitaDia\"]');
            var idHistoriaClinica  = \$('input[id\$=\"_idHistoriaClinica\"]');
            var superAdmin         = '";
        // line 19
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method")) {
            echo "true";
        } else {
            echo "false";
        }
        echo "';
            var waitDiv            = \$('#waitDiv');
            var buttonTitle        = '';
            var uniqId             = \$('input[id\$=\"__token\"]').attr('id').replace('__token','');
            var selectHistoryBtn   = \$('a[href*=\"uniqid='+uniqId+'\"]');
            var selectHistoryLink  = selectHistoryBtn.attr('href');
            var idSeguimientoHistoriaClinica  = \$('input[id\$=\"_idSeguimientoHistoriaClinica\"]');

            selectHistoryBtn.attr('disabled','disabled');

            /* Inicializar select2 para busqueda de Pacientes por Numero de Exp. o Nombre */
            numExpNomPac.select2({
                allowClear: true,
                placeholder: 'Seleccionar Expediente...',
                minimumInputLength: 1,
                dropdownAutoWidth: true,
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
                }
            }).on('change',function(e){
                initializeSelect2(idAtenAreaModEstab, true, true, { placeholder: 'Seleccionar Especialidad...', allowClear: true, width: '100%'} );
                //if( fecha.val() && fecha.val().indexOf(\"_\") == -1 && numExpNomPac.select2('val') && idEmpleado.select2('val') && idAtenAreaModEstab.select2('val') ){
                if( fecha.val() && fecha.val().indexOf(\"_\") == -1 && numExpNomPac.select2('val') && idAtenAreaModEstab.select2('val') ){
                    findMatchDate();
                }
                else{
                    cancelHistory();
                }

                if( numExpNomPac.select2('val') ){
                    idAtenAreaModEstab.select2( 'readonly', false );
                    ";
        // line 63
        if ((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SONATA_ADMIN_FARMRECETAS_COMPLEMENTALL"), "method") == false) && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method") == false))) {
            // line 64
            echo "                        setEspecialidadesEmpleado( ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "getId", array(), "method"), "html", null, true);
            echo " );
                    ";
        } else {
            // line 66
            echo "                        setEspecialidadesExpediente( numExpNomPac.select2('val') );
                    ";
        }
        // line 68
        echo "                }else{
                    idAtenAreaModEstab.select2( 'readonly', true );
                }
            });

            /** Acciones de comportamiento para select de Medico y Especialidad **/
            ";
        // line 74
        if (((!$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true)) || (!($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")))) {
            // line 75
            echo "
                /*initializeSelect2(idEmpleado, true, false, { placeholder: 'Seleccionar Medico...', allowClear: true, width: '100%' } );
                initializeSelect2(idAtenAreaModEstab, true, true, { placeholder: 'Seleccionar Especialidad...', allowClear: true, width: '100%' } );
                idAtenAreaModEstab.select2( 'readonly', true );


                idEmpleado.on('change', function(e) {
                    initializeSelect2(idAtenAreaModEstab, true, true, { placeholder: 'Seleccionar Especialidad...', allowClear: true, width: '100%'} );

                    if ( idEmpleado.select2('val') ) {
                        idAtenAreaModEstab.select2( 'readonly', false );
                        setEspecialidadesEmpleado( idEmpleado.select2('val') );
                    }
                    else{
                        idAtenAreaModEstab.select2( 'readonly', true );
                        cancelHistory();
                    }
                });*/

            ";
        } else {
            // line 95
            echo "                /*idEmpleado.select2( 'val', ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getId"), "html", null, true);
            echo " );
                idEmpleado.select2( 'readonly', true );*/

                ";
            // line 98
            if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SONATA_ADMIN_FARMRECETAS_COMPLEMENTALL"), "method") == false)) {
                // line 99
                echo "                    /*initializeSelect2(idAtenAreaModEstab, true, true, { placeholder: 'Seleccionar Especialidad...', allowClear: true, width: '100%'} );
                    setEspecialidadesEmpleado( idEmpleado.select2('val') );*/
                ";
            } else {
                // line 102
                echo "                    /*initializeSelect2(idAtenAreaModEstab, true, false, { placeholder: 'Seleccionar Especialidad...', allowClear: true, width: '100%'} );*/
                ";
            }
            // line 104
            echo "
            ";
        }
        // line 106
        echo "
            initializeSelect2(idAtenAreaModEstab, true, true, { placeholder: 'Seleccionar Especialidad...', allowClear: true, width: '100%'} );
            idAtenAreaModEstab.select2( 'readonly', true );

            idAtenAreaModEstab.on('change', function(e){
                //if( fecha.val() && fecha.val().indexOf(\"_\") == -1 && numExpNomPac.select2('val') && idEmpleado.select2('val') && idAtenAreaModEstab.select2('val') ){
                if( fecha.val() && fecha.val().indexOf(\"_\") == -1 && numExpNomPac.select2('val') && idAtenAreaModEstab.select2('val') ){
                    findMatchDate();
                }
                else{
                    cancelHistory();
                }
            });

            function setEspecialidadesEmpleado(id) {
                \$.ajax({
                    url: Routing.generate('citasgetmedicoespecialidadestab') + '?idEmpleado=' + id,
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        \$.each(data.result, function(indice, val) {
                            if (superAdmin == 'true') {
                                idAtenAreaModEstab.append(\$('<option>', {value: val.id, text: val.nombre}));
                            } else {
                                if (val.idEstablecimiento == ";
        // line 130
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado")) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdEstablecimiento"), "getId"), "html", null, true);
        }
        echo ") {
                                    idAtenAreaModEstab.append(\$('<option>', {value: val.id, text: val.nombre }));
                                }
                            }
                        });
                    }
                });
            };

            function setEspecialidadesExpediente(id){
                \$.ajax({
                    url: Routing.generate('especialidades_historia',{'idPaciente': id}),
                    async: false,
                    type: \"GET\",
                    dataType: 'json',
                    success: function(data) {
                        \$.each(data.idEspecialidad, function(indice, val) {
                            idAtenAreaModEstab.append(\$('<option>', {value: val.id, text: val.nombre}));
                        });
                    }
                });
            }

            function findMatchDate(){
                cancelHistory();
                waitDiv.append('<center><img id=\"wait\" src=\"";
        // line 155
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/wait_icon1.gif"), "html", null, true);
        echo "\" alt=\"wait\" width=\"24\" height=\"24\"><div id=\"search-message\">Por Favor Espere...</div></center>');
                \$.ajax({
                    //url: Routing.generate('datehistorycomplementmatch') + '?fecha=' + fecha.val() + '&idExpediente=' + numExpNomPac.select2('val') + '&idEmpleado=' + idEmpleado.select2('val') + '&idAtenAreaModEstab=' + idAtenAreaModEstab.select2('val') + '&typeSearch=farmrecetas-complement',
                    url: Routing.generate('datehistorycomplementmatch') + '?fecha=' + fecha.val() + '&idExpediente=' + numExpNomPac.select2('val') + '&idEmpleado=' + ";
        // line 158
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "getId", array(), "method"), "html", null, true);
        echo " + '&idAtenAreaModEstab=' + idAtenAreaModEstab.select2('val') + '&typeSearch=farmrecetas-complement',
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        waitDiv.empty();
                        waitDiv.append('\\
                            <div id=\"preInfo\" class=\"container-fluid\" style=\"margin-top: 10px;\">\\
                                <div class=\"row\">\\
                                    <div class=\"col-xs-12 col-md-6\" id=\"nextDates\"></div>\\
                                    <div class=\"col-xs-12 col-md-6\" id=\"lastHistory\"></div>\\
                                </div>\\
                            </div>'
                        );
                        \$('#nextDates').append(data.nextdates);
                        \$('#lastHistory').append(data.lasthistories);

                        if( data.continue ){
                            if( data.continue.idEstado == 5 ){//Finalizada
                                waitDiv.prepend('<br/><div class=\"alert alert-block alert-error\"><h4><i class=\"fa fa-fw fa-exclamation\"></i> Receta Repetitiva Complementaria Finalizada</h4>Ya existe una Receta Repetitiva Complementaria con los datos especificados para este mismo paciente, la cual ha finalizado. No puede realizar mas modificaciones.</div>');
                            }
                            else{
                                waitDiv.prepend('<br/><div class=\"alert alert-block alert-info\"><h4><i class=\"fa fa-fw fa-exclamation\"></i> Receta Repetitiva Complementaria en Proceso</h4>Existe una Receta Repetitiva Complementaria en Proceso con los datos especificados. Puede proceder a realizar las modificaciones necesarias.</div>');
                                idHistoriaClinica.val(data.continue.id);
                                enableHistoryComplement();
                            }
                        }else{
                            if( data.nextdatespecialty ){
                                if( data.sameday ){
                                    if( data.history.length > 0 ){
                                        waitDiv.prepend('<br/><div class=\"alert alert-block alert-warning\"><h4><i class=\"fa fa-fw fa-warning\"></i> El paciente tiene una <b>Consulta Activa</b> en la Especialidad seleccionada.</b></h4>El paciente, tiene una <b>Consulta Activa</b> en la <b>Especialidad seleccionada</b> con el Dr/a. '+data.history[0].nombre_empleado+'. El estado de la consulta es: <b>'+data.history[0].estado_historia+'</b>.</div>');
                                    }else{
                                        waitDiv.prepend('<br/><div class=\"alert alert-block alert-warning\"><h4><i class=\"fa fa-fw fa-warning\"></i> <b>Cita pendiente</b> para este día en la Especialidad seleccionada.</b></h4>El paciente, tiene una <b>Cita Pendiente</b> para este día en la <b>Especialidad seleccionada</b> con el Dr/a. '+data.citas[data.idcitadiaindex].nombre_empleado+'. El paciente debe pasar a la consulta para obtener su medicamento. El estado de la cita es: <b>'+data.citas[data.idcitadiaindex].estado+'</b>.</div>');
                                    }
                                }else{
                                    waitDiv.prepend('<br/><div class=\"alert alert-block alert-success\"><h4><i class=\"fa fa-fw fa-medkit\"></i> Receta Repetitiva Complementaria</h4> Para continuar con la prescripción, ingrese una <b>Observación/Justificación</b> y <b>seleccione</b> la <b>Historia Clínica a la que le da Seguimiento</b>.</div>');
                                    enableHistoryComplement();
                                }
                            }
                            else{
                                waitDiv.prepend('<br/><div class=\"alert alert-block alert-error\"><h4><i class=\"fa fa-fw fa-warning\"></i> No hay Citas Próximas en la <b>Especialidad.</b></h4>El paciente, <b>no</b> posee Citas asignadas para los próximos días en la <b>Especialidad seleccionada</b>. Por esta razón, <b>no puede continuar</b> con esta acción. El paciente debe <b>solicitar una Cita</b> en la Especialidad deseada.</div>');
                            }
                        }
                    }
                });
            }

            function enableHistoryComplement(){
                loadContainerDiv();
                if( ! idHistoriaClinica.val() ){
                    loadMotivo();
                    loadSelectedHistory();
                    addMainButton();
                }else{
                    enablePrescription(idHistoriaClinica.val());
                }
            }

            function cancelHistory(){
                waitDiv.empty();
                idHistoriaClinica.val('');
                \$('input[id\$=\"_idSeguimientoHistoriaClinica\"]').val('');
            }

            function loadContainerDiv(){
                waitDiv.append('\\
                    <div class=\"container-fluid\" style=\"margin-top: 30px; border: solid 1px #3CBC7A; padding-bottom: 5px; padding-top: 10px; -webkit-border-radius: 8px; border-radius: 8px; -webkit-box-shadow: #CEEBFF 0px 0px 2px 2px;\">\\
                        <div class=\"row\">\\
                            <div class=\"col-xs-12 col-md-5\" id=\"divConsultaPor\"></div>\\
                            <div class=\"col-xs-12 col-md-4\" id=\"divRecetario\"></div>\\
                            <div class=\"col-xs-12 col-md-3\" id=\"divMainButton\"></div>\\
                        </div>\\
                        <div class=\"row\">\\
                            <div class=\"col-xs-12 col-md-6\"></div>\\
                            <div class=\"col-xs-12 col-md-3\"></div>\\
                            <div class=\"col-xs-12 col-md-3\"></div>\\
                        </div>\\
                    </div>'
                );
            }

            function loadMotivo(){
                \$('#divConsultaPor').append('\\
                    <label id=\"labelConsultaPor\" class=\"control-label\">Observación/Justificación</label>\\
                    <textarea id=\"consultaPor\" name=\"consultaPor\" required=\"required\" class=\"form-control\"></textarea>'
                );
            }

            function loadSelectedHistory(){
                \$('#divRecetario').empty().append('\\
                    <label id=\"labelSeguimientoConsulta\" class=\"control-label\"> Seguimiento de la Consulta</label><span id=\"unsetSpan\" style=\"float: right; display: none;\"><a onClick=\"unsetHistoriaSeguimiento();\" class=\"mouse-pointer\"><i class=\"fa fa-fw fa-eraser\"></i> Cambiar</a></span>\\
                    <div id=\"divSeguimientoConsulta\" class=\"alert alert-warning\" role=\"alert\">No ha seleccionado la Historia Clínica a la que le dará <b>Seguimiento</b>.\\
                    Para seleccionarla, verifique la lista de <b>Últimas Consultas</b> y de clic en la opción <b>\"Seleccionar\"</b>, si no la encuentra,\\
                    utilice la opción <b>\"Ver Todas\"</b>.</div>'
                );
            }

            function addMainButton(){
                \$('#divMainButton').append('<br/><a id=\"mainButton\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-check-square-o\"></i> Continuar</a><br/>');
                \$('#mainButton').on('click', function(){
                    if( \$('#consultaPor').val() && \$('input[id\$=\"_idSeguimientoHistoriaClinica\"]').val() ){
                        var title = 'Continuar?';
                        var dialogClass = 'dialog-info';
                        var msg = 'Se creara una Receta Repetitiva Complementaria. ¿Desea continuar con esta acción?';
                        var width = 500;

                        var arrayBtns =
                        [{
                            text: 'Continuar', click: function() {
                                \$.ajax({
                                    method: \"POST\",
                                    url: '";
        // line 268
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_create");
        echo "',
                                    async: false,
                                    dataType: 'json',
                                    data: { id_expediente: numExpNomPac.select2('val'), id_empleado: ";
        // line 271
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "getId", array(), "method"), "html", null, true);
        echo ", id_aten_area_mod_estab: idAtenAreaModEstab.select2('val'), rrc: 'true', id_cita: idCitaDia.val(), consultaPor: \$('#consultaPor').val(), typeCreate: 'farmrecetas-complement', idSeguimientoHistoriaClinica: \$('input[id\$=\"_idSeguimientoHistoriaClinica\"]').val() }
                                })
                                .done( function(data, textStatus, jqXHR, e) {
                                    if( data.success ){
                                        enablePrescription(data.id);
                                        \$('#dialog-message').dialog( \"close\" );
                                        \$('#mainButton').hide();
                                        \$('#labelConsultaPor').hide();
                                        \$('#consultaPor').hide();
                                        \$('#labelSeguimientoConsulta').hide();
                                        \$('#divSeguimientoConsulta').hide();
                                        \$('#unsetSpan').hide();
                                        showDialogMsg('Creada Exitosamente.', 'Se ha creado la Receta Repetitiva Satisfactoriamente. Puede continuar con la prescripción de medicamentos.', 'dialog-success');
                                    }
                                    else{
                                        \$('#dialog-message').dialog( \"close\" );
                                        showDialogMsg('Error', 'Se ha producido un error al crear la Receta Repetitiva, por favor intente nuevamente.', 'dialog-error');
                                        console.log('Error: '+data.error);
                                    }
                                })
                                .fail( function(data, jqXHR, textStatus, errorThrown){
                                    \$('#dialog-message').dialog( \"close\" );
                                    showDialogMsg('Error', 'Se ha producido un error al crear la Receta Repetitiva, por favor intente nuevamente.', 'dialog-error');
                                    console.log('Error: '+textStatus);
                                });
                            }
                        },
                        {
                            text: 'Cancelar', click: function( event, ui) {
                                jQuery( this ).dialog( \"close\" );
                            }
                        }];

                        showDialogMsg(title, msg, dialogClass, '', arrayBtns, false, width);
                    }
                    else{
                        if( ! \$('#consultaPor').val() ){
                            var focusItem = \$('#consultaPor');
                            var titleItem = 'Ingrese una Observación/Justificación';
                            var msjItem   = 'Para Continuar, ingrese una <b>Observación/Justificación</b>.';
                        }
                        else{
                            var focusItem = \$('#seeAllHistory');
                            var titleItem = 'Seleccione la Consulta a dar Seguimiento';
                            var msjItem   = 'No ha seleccionado la <b>Historia Clínica</b> a la que le dará <b>Seguimiento</b>.';
                        }

                        var arrayBtns = [{
                            text: 'Ok', click: function() {
                                \$( this ).dialog( \"close\" );
                                focusItem.focus();
                            }
                        }];
                        showDialogMsg(titleItem, msjItem, 'dialog-error', '', arrayBtns, false, 400);
                    }
                });
            };

            function enablePrescription(id){
                \$('#divRecetario').append('<a href=\"#\" id=\"recetario\" style=\"min-height: 72px;\" class=\"btn btn-app btn-group\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Recetario de Consulta Externa\">\\
                                                <li class=\"fa fa-clipboard\"></li><span>Recetario<br/>Consulta Externa</span>\\
                                            </a>');
                \$(\"a#recetario\").on(\"click\", function () {
                    var parameters = {_external: 'true', idEmpleado: ";
        // line 334
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "getId", array(), "method"), "html", null, true);
        echo ", idEspecialidad: idAtenAreaModEstab.select2('val'), idHistorialClinico: id};
                    var winParams = [];

                    winParams['method'] = \"post\";
                    winParams['action'] = \"";
        // line 338
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_farmacia_farmrecetas_assign_receta");
        echo "\";
                    winParams['target'] = \"Creacion de Receta\";
                    winParams['parameters'] = parameters;
                    openPostPopUpWindows(winParams);
                });
                \$('a[btn-selectable=\"true\"]').hide();
            }

        });//fin document ready

        function setHistoriaSeguimiento(id){
            jQuery('input[id\$=\"_idSeguimientoHistoriaClinica\"]').val(id);
            jQuery('#divSeguimientoConsulta').empty().attr('class', 'alert alert-success').append('\\
                <h5><span class=\"glyphicon glyphicon-ok-sign\" aria-hidden=\"true\"></span> Historia Clínica de Seguimiento Seleccionada.</h5>\\
            ');
            \$('a[btn-selectable=\"true\"]').hide();
            \$('#unsetSpan').show();
        };

        function unsetHistoriaSeguimiento(){
            jQuery('input[id\$=\"_idSeguimientoHistoriaClinica\"]').val('');
            jQuery('#divSeguimientoConsulta').empty().attr('class', 'alert alert-warning').append('\\
                No ha seleccionado la Historia Clínica a la que le dará <b>Seguimiento</b>.\\
                Para seleccionarla, verifique la lista de <b>Últimas Consultas</b> y de clic en la opción <b>\"Seleccionar\"</b>, si no la encuentra,\\
                utilice la opción <b>\"Ver Todas\"</b>.\\
            ');
            \$('a[btn-selectable=\"true\"]').show();
            \$('#unsetSpan').hide();
        }

    </script>
";
    }

    // line 370
    public function block_form($context, array $blocks = array())
    {
        // line 371
        echo "    ";
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.top", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

    ";
        // line 373
        $context["url"] = (((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) ? ("edit") : ("create"));
        // line 374
        echo "
    ";
        // line 375
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url"))), "method"))) {
            // line 376
            echo "        <div>
            ";
            // line 377
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        </div>
    ";
        } else {
            // line 380
            echo "        <form
            ";
            // line 381
            if (($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "form_type"), "method") == "horizontal")) {
                echo "class=\"form-horizontal\"";
            }
            // line 382
            echo "            role=\"form\"
            action=\"";
            // line 383
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), 1 => array("id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
            echo "
            method=\"POST\"
            ";
            // line 385
            if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
                echo "novalidate=\"novalidate\"";
            }
            // line 386
            echo "            >
            ";
            // line 387
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
                // line 388
                echo "                <div class=\"sonata-ba-form-error\">
                    ";
                // line 389
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "
                </div>
            ";
            }
            // line 392
            echo "
            ";
            // line 393
            $this->displayBlock('sonata_pre_fieldsets', $context, $blocks);
            // line 396
            echo "
                ";
            // line 397
            $this->displayBlock('sonata_tab_content', $context, $blocks);
            // line 458
            echo "
                ";
            // line 459
            $this->displayBlock('sonata_post_fieldsets', $context, $blocks);
            // line 462
            echo "
            ";
            // line 463
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "

            ";
            // line 465
            $this->displayBlock('formactions', $context, $blocks);
            // line 472
            echo "        </form>
    ";
        }
        // line 474
        echo "
    ";
        // line 475
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.bottom", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

";
    }

    // line 393
    public function block_sonata_pre_fieldsets($context, array $blocks = array())
    {
        // line 394
        echo "                <div class=\"row\">
                ";
    }

    // line 397
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 398
        echo "                    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formgroups"));
        foreach ($context['_seq'] as $context["name"] => $context["form_group"]) {
            // line 399
            echo "                        <div class=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class"), "col-md-12")) : ("col-md-12")), "html", null, true);
            echo "\">
                            <div class=\"box box-primary\">
                                <div class=\"box-header\">
                                    <h3 class=\"box-title\">Receta Repetitiva Complementaria</h3>
                                </div>
                                <div class=\"box-body\">
                                    <h5 class=\"box-title\">
                                        Por Favor Ingrese los siguientes Datos:
                                    </h5>
                                    <div class=\"sonata-ba-collapsed-fields\">
                                        <div class=\"container-fluid\">
                                            <div class=\"row\">
                                                <div class=\"col-xs-18 col-md-2\">
                                                    ";
            // line 412
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "fecha"), 'row');
            echo "
                                                </div>
                                                <div class=\"col-xs-12 col-md-5\">
                                                    <label id=\"labelNumExpNomPac\" class=\"control-label\">N° Expediente</label>
                                                    <input type=\"text\" id=\"numExpNomPac\" name=\"numExpNomPac\" required=\"required\" class=\"form-control\">
                                                </div>
                                                <div class=\"col-xs-12 col-md-5\">
                                                    ";
            // line 419
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idAtenAreaModEstab"), 'row');
            echo "
                                                </div>
                                            </div>
                                            <div class=\"row\">
                                                <div class=\"col-xs-18 col-md-6\" id=\"originMotivo\">

                                                </div>
                                                <div class=\"col-xs-12 col-md-2\">

                                                </div>
                                                <div class=\"col-xs-12 col-md-2\">

                                                </div>
                                                <div class=\"col-xs-12 col-md-2\">

                                                </div>
                                            </div>
                                        </div>
                                        ";
            // line 437
            if (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description") != false)) {
                // line 438
                echo "                                            <p>";
                echo $this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description");
                echo "</p>
                                        ";
            }
            // line 440
            echo "
                                        ";
            // line 441
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"));
            foreach ($context['_seq'] as $context["_key"] => $context["field_name"]) {
                // line 442
                echo "                                            ";
                if ($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "formfielddescriptions", array(), "any", false, true), (isset($context["field_name"]) ? $context["field_name"] : $this->getContext($context, "field_name")), array(), "array", true, true)) {
                    // line 443
                    echo "                                                ";
                    if ($this->getAttribute((isset($context["form"]) ? $context["form"] : null), (isset($context["field_name"]) ? $context["field_name"] : $this->getContext($context, "field_name")), array(), "array", true, true)) {
                        // line 444
                        echo "                                                    ";
                        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), (isset($context["field_name"]) ? $context["field_name"] : $this->getContext($context, "field_name")), array(), "array"), 'row');
                        echo "
                                                ";
                    }
                    // line 446
                    echo "                                            ";
                }
                // line 447
                echo "                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field_name'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 448
            echo "                                    </div>
                                    <div id=\"preInfo\">
                                    </div>
                                    <div id=\"waitDiv\">
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['form_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 457
        echo "                ";
    }

    // line 459
    public function block_sonata_post_fieldsets($context, array $blocks = array())
    {
        // line 460
        echo "                </div>
            ";
    }

    // line 465
    public function block_formactions($context, array $blocks = array())
    {
        // line 466
        echo "                <div id=\"formActionsDiv\" style=\"display: none;\">
                    <div id=\"formButtonsDiv\" class=\"well well-small form-actions\">

                    </div>
                </div>
            ";
    }

    public function getTemplateName()
    {
        return "MinsalFarmaciaBundle:FarmRecetas:complement.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  684 => 459,  651 => 444,  1229 => 998,  1226 => 997,  1216 => 993,  1214 => 992,  1210 => 990,  1201 => 987,  1197 => 985,  1176 => 974,  1135 => 936,  1068 => 872,  1062 => 833,  1059 => 832,  1043 => 980,  1038 => 978,  1035 => 977,  1028 => 832,  1011 => 823,  1006 => 821,  988 => 816,  985 => 815,  971 => 809,  965 => 807,  938 => 789,  930 => 785,  886 => 757,  1119 => 855,  1116 => 854,  1075 => 869,  1054 => 829,  1050 => 861,  1034 => 856,  1031 => 854,  1025 => 831,  1023 => 828,  1020 => 827,  1017 => 849,  1000 => 843,  987 => 840,  972 => 833,  945 => 816,  943 => 792,  794 => 670,  770 => 661,  759 => 657,  723 => 628,  854 => 585,  850 => 584,  838 => 575,  826 => 569,  755 => 541,  750 => 539,  741 => 533,  704 => 517,  736 => 544,  706 => 519,  702 => 516,  1720 => 1573,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1480,  1609 => 1479,  1594 => 1472,  1590 => 1471,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 841,  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 697,  803 => 630,  606 => 447,  691 => 492,  655 => 481,  484 => 412,  552 => 472,  709 => 520,  397 => 337,  392 => 251,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 995,  1207 => 989,  1199 => 859,  1188 => 857,  1184 => 980,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 866,  1052 => 764,  1045 => 1000,  1042 => 761,  1037 => 857,  992 => 817,  962 => 697,  960 => 826,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 339,  419 => 186,  639 => 468,  611 => 386,  538 => 444,  646 => 307,  642 => 492,  544 => 434,  541 => 204,  517 => 427,  797 => 671,  752 => 533,  748 => 458,  681 => 553,  677 => 552,  630 => 437,  618 => 172,  535 => 397,  519 => 425,  416 => 215,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 974,  1030 => 973,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 820,  999 => 518,  995 => 818,  983 => 509,  977 => 507,  974 => 810,  968 => 808,  954 => 800,  948 => 494,  922 => 779,  916 => 480,  913 => 479,  911 => 774,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 552,  775 => 550,  762 => 544,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 406,  534 => 348,  530 => 393,  521 => 389,  489 => 179,  483 => 376,  394 => 305,  396 => 306,  345 => 243,  476 => 373,  386 => 162,  364 => 235,  234 => 113,  595 => 326,  589 => 450,  586 => 451,  562 => 505,  556 => 474,  506 => 429,  498 => 417,  492 => 380,  473 => 277,  458 => 121,  399 => 199,  352 => 268,  346 => 164,  328 => 158,  880 => 699,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 489,  573 => 516,  567 => 507,  520 => 394,  481 => 375,  475 => 409,  472 => 408,  466 => 227,  441 => 338,  438 => 337,  432 => 380,  429 => 222,  395 => 400,  382 => 301,  378 => 249,  367 => 197,  357 => 168,  348 => 165,  334 => 160,  286 => 143,  205 => 115,  297 => 182,  218 => 144,  940 => 351,  932 => 786,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 758,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 579,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 667,  784 => 293,  782 => 665,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 534,  740 => 456,  734 => 530,  731 => 392,  728 => 528,  725 => 251,  719 => 257,  716 => 438,  714 => 522,  711 => 540,  705 => 539,  701 => 261,  690 => 302,  687 => 460,  671 => 490,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 470,  609 => 419,  602 => 230,  591 => 453,  571 => 419,  499 => 382,  488 => 273,  389 => 235,  223 => 161,  14 => 4,  306 => 227,  303 => 149,  300 => 148,  292 => 145,  280 => 141,  12 => 36,  624 => 282,  620 => 223,  612 => 467,  601 => 379,  599 => 412,  580 => 265,  574 => 397,  559 => 475,  526 => 429,  497 => 173,  485 => 304,  463 => 196,  447 => 340,  404 => 310,  401 => 185,  391 => 216,  369 => 172,  333 => 234,  329 => 266,  307 => 237,  287 => 236,  195 => 153,  178 => 78,  956 => 271,  953 => 822,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 775,  912 => 336,  909 => 773,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 587,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 564,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 662,  765 => 246,  760 => 621,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 504,  663 => 484,  660 => 447,  657 => 446,  650 => 483,  647 => 237,  644 => 190,  632 => 438,  629 => 186,  626 => 482,  603 => 229,  600 => 178,  594 => 454,  588 => 372,  584 => 488,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 156,  513 => 386,  479 => 388,  468 => 353,  451 => 287,  448 => 389,  424 => 334,  418 => 344,  410 => 271,  376 => 191,  373 => 257,  340 => 162,  326 => 222,  261 => 146,  118 => 60,  200 => 125,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 984,  1192 => 983,  1190 => 982,  1187 => 981,  1179 => 975,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 899,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 871,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 870,  1056 => 864,  1053 => 292,  1051 => 828,  1048 => 763,  1040 => 858,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 824,  1012 => 271,  1009 => 822,  1004 => 266,  982 => 839,  979 => 812,  976 => 811,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 802,  955 => 823,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 788,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 766,  897 => 329,  894 => 762,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 682,  825 => 681,  817 => 567,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 557,  793 => 556,  785 => 666,  783 => 177,  772 => 172,  769 => 171,  767 => 660,  764 => 659,  756 => 460,  753 => 540,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 525,  712 => 521,  710 => 502,  707 => 501,  699 => 142,  697 => 513,  696 => 204,  695 => 466,  694 => 512,  689 => 137,  680 => 457,  675 => 199,  662 => 217,  658 => 500,  654 => 484,  649 => 308,  643 => 306,  640 => 491,  638 => 440,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 434,  550 => 465,  527 => 392,  515 => 191,  512 => 391,  509 => 385,  503 => 427,  496 => 423,  493 => 415,  478 => 374,  467 => 370,  456 => 288,  450 => 281,  414 => 343,  408 => 312,  388 => 292,  371 => 173,  363 => 170,  350 => 245,  342 => 274,  335 => 268,  316 => 232,  290 => 154,  276 => 176,  266 => 204,  263 => 146,  255 => 209,  245 => 116,  207 => 138,  194 => 91,  184 => 148,  76 => 24,  810 => 238,  804 => 662,  801 => 560,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 663,  774 => 249,  771 => 412,  768 => 547,  766 => 546,  761 => 658,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 509,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 443,  627 => 236,  622 => 481,  619 => 212,  616 => 468,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 399,  578 => 448,  572 => 204,  566 => 393,  547 => 435,  545 => 463,  542 => 462,  533 => 430,  531 => 154,  507 => 241,  505 => 214,  502 => 383,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 388,  443 => 387,  431 => 338,  428 => 189,  425 => 188,  422 => 187,  412 => 152,  406 => 201,  390 => 304,  383 => 193,  377 => 246,  375 => 249,  372 => 200,  370 => 208,  359 => 251,  356 => 277,  353 => 276,  349 => 274,  336 => 272,  332 => 267,  330 => 233,  318 => 233,  313 => 192,  291 => 218,  190 => 90,  321 => 229,  295 => 146,  274 => 152,  242 => 194,  236 => 114,  70 => 28,  170 => 87,  288 => 217,  284 => 154,  279 => 134,  275 => 180,  256 => 171,  250 => 2,  237 => 140,  232 => 159,  222 => 108,  191 => 129,  153 => 70,  150 => 62,  563 => 188,  560 => 435,  558 => 195,  553 => 256,  549 => 438,  543 => 425,  537 => 458,  532 => 396,  528 => 199,  525 => 311,  523 => 441,  518 => 388,  514 => 392,  511 => 243,  508 => 424,  501 => 422,  491 => 288,  487 => 411,  460 => 195,  455 => 344,  449 => 164,  442 => 190,  439 => 226,  436 => 336,  433 => 345,  426 => 180,  420 => 220,  415 => 339,  411 => 313,  405 => 269,  403 => 149,  380 => 260,  366 => 171,  354 => 167,  331 => 159,  325 => 157,  320 => 155,  317 => 154,  311 => 152,  308 => 151,  304 => 207,  272 => 183,  267 => 189,  249 => 143,  216 => 143,  155 => 95,  146 => 54,  126 => 63,  188 => 128,  181 => 109,  161 => 72,  110 => 40,  124 => 64,  692 => 465,  683 => 282,  678 => 279,  676 => 488,  666 => 448,  661 => 488,  656 => 499,  652 => 497,  645 => 442,  641 => 441,  635 => 489,  631 => 475,  625 => 460,  615 => 453,  607 => 363,  597 => 455,  590 => 223,  583 => 435,  579 => 353,  577 => 398,  575 => 212,  569 => 394,  565 => 361,  555 => 257,  548 => 353,  540 => 459,  536 => 405,  529 => 222,  524 => 344,  516 => 387,  510 => 78,  504 => 145,  500 => 386,  495 => 381,  490 => 154,  486 => 377,  482 => 176,  470 => 371,  464 => 242,  459 => 346,  452 => 286,  434 => 279,  421 => 341,  417 => 219,  400 => 267,  385 => 203,  361 => 252,  344 => 238,  339 => 269,  324 => 102,  310 => 165,  302 => 240,  296 => 38,  282 => 178,  259 => 139,  244 => 204,  231 => 123,  226 => 151,  215 => 129,  186 => 126,  152 => 113,  114 => 86,  104 => 52,  358 => 271,  351 => 166,  347 => 275,  343 => 163,  338 => 241,  327 => 265,  323 => 156,  319 => 220,  315 => 198,  301 => 235,  299 => 234,  293 => 205,  289 => 144,  281 => 182,  277 => 140,  271 => 153,  265 => 169,  262 => 170,  260 => 211,  257 => 145,  251 => 181,  248 => 134,  239 => 158,  228 => 110,  225 => 109,  213 => 117,  211 => 140,  197 => 140,  174 => 76,  148 => 56,  134 => 49,  127 => 46,  20 => 1,  270 => 166,  253 => 144,  233 => 155,  212 => 106,  210 => 116,  206 => 152,  202 => 143,  198 => 120,  192 => 114,  185 => 110,  180 => 146,  175 => 103,  172 => 118,  167 => 57,  165 => 73,  160 => 143,  137 => 66,  113 => 64,  100 => 51,  90 => 41,  81 => 27,  65 => 20,  129 => 64,  97 => 39,  77 => 21,  34 => 2,  53 => 32,  84 => 23,  58 => 23,  23 => 4,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 344,  427 => 350,  423 => 256,  413 => 338,  409 => 219,  407 => 247,  402 => 210,  398 => 184,  393 => 265,  387 => 303,  384 => 302,  381 => 236,  379 => 110,  374 => 137,  368 => 255,  365 => 119,  362 => 234,  360 => 169,  355 => 280,  341 => 270,  337 => 161,  322 => 266,  314 => 153,  312 => 187,  309 => 48,  305 => 150,  298 => 147,  294 => 238,  285 => 179,  283 => 142,  278 => 217,  268 => 173,  264 => 188,  258 => 210,  252 => 166,  247 => 1,  241 => 141,  229 => 138,  220 => 107,  214 => 141,  177 => 106,  169 => 102,  140 => 21,  132 => 61,  128 => 1,  107 => 69,  61 => 33,  273 => 185,  269 => 214,  254 => 199,  243 => 140,  240 => 176,  238 => 192,  235 => 153,  230 => 111,  227 => 178,  224 => 151,  221 => 119,  219 => 174,  217 => 118,  208 => 132,  204 => 142,  179 => 85,  159 => 77,  143 => 22,  135 => 53,  119 => 66,  102 => 45,  71 => 60,  67 => 36,  63 => 15,  59 => 34,  28 => 3,  94 => 9,  89 => 46,  85 => 59,  75 => 39,  68 => 21,  56 => 33,  87 => 64,  201 => 134,  196 => 131,  183 => 86,  171 => 100,  166 => 106,  163 => 83,  158 => 93,  156 => 55,  151 => 71,  142 => 71,  138 => 48,  136 => 70,  121 => 18,  117 => 42,  105 => 59,  91 => 65,  62 => 25,  49 => 18,  25 => 5,  21 => 3,  31 => 33,  38 => 16,  26 => 2,  24 => 13,  19 => 1,  93 => 52,  88 => 48,  78 => 40,  46 => 18,  44 => 9,  27 => 6,  79 => 62,  72 => 38,  69 => 37,  47 => 10,  40 => 12,  37 => 7,  22 => 12,  246 => 205,  157 => 71,  145 => 68,  139 => 51,  131 => 74,  123 => 68,  120 => 63,  115 => 39,  111 => 63,  108 => 39,  101 => 34,  98 => 36,  96 => 50,  83 => 63,  74 => 23,  66 => 27,  55 => 22,  52 => 21,  50 => 11,  43 => 10,  41 => 27,  35 => 34,  32 => 15,  29 => 7,  209 => 145,  203 => 130,  199 => 92,  193 => 130,  189 => 127,  187 => 149,  182 => 117,  176 => 83,  173 => 104,  168 => 99,  164 => 99,  162 => 98,  154 => 95,  149 => 69,  147 => 70,  144 => 61,  141 => 67,  133 => 75,  130 => 56,  125 => 78,  122 => 61,  116 => 62,  112 => 40,  109 => 54,  106 => 42,  103 => 68,  99 => 44,  95 => 66,  92 => 49,  86 => 2,  82 => 95,  80 => 29,  73 => 27,  64 => 23,  60 => 19,  57 => 39,  54 => 16,  51 => 31,  48 => 29,  45 => 7,  42 => 5,  39 => 4,  36 => 5,  33 => 15,  30 => 14,);
    }
}
