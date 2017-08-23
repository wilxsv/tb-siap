<?php

/* MinsalSeguimientoBundle:SecHistorialClinico/Retroactive:retroactive.html.twig */
class __TwigTemplate_1ed867d302bf8160d207d7c5f14d41ef1e0a5a98264f598aaa02e49fc5a1adaa extends Twig_Template
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
            var fechaConsulta      = \$('input[id\$=\"_fechaconsulta\"]');
            var numExpNomPac       = \$('#numExpNomPac');
            var idEmpleado         = \$('select[id\$=\"_idEmpleado\"]');
            var idAtenAreaModEstab = \$('select[id\$=\"_idAtenAreaModEstab\"]');
            var idCitaDia          = \$('input[id\$=\"_idCitaDia\"]');
            var idRetroactiva      = \$('input[id\$=\"_idRetroactiva\"]');
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
            var createUrl          = '";
        // line 22
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_create");
        echo "';
            var motivoHTML         = \$('select[id\$=\"_idMotivoRetroactivo\"]').html();

            \$('#originMotivo').empty();

            /* Accion de comportamiento para seleccion de Fecha que se brindo la consulta */
            fechaConsulta.datepicker('setEndDate', moment().subtract(1, 'days').format('DD-MM-YYYY') );

            fechaConsulta.datepicker().on('changeDate', function(e){
                if( fechaConsulta.val().indexOf(\"_\") == -1){
                    if( /*e.format(0,'dd/mm/yyyy')*/ fechaConsulta.val() == getCurrentDate() ){
                        showDialogMsg('Fecha Invalida','Debe seleccionar una fecha <b>anterior</b> a la fecha actual.','dialog-error');
                        //fechaConsulta.datepicker('clearDates');
                        fechaConsulta.val('');
                    }
                    else{
                        if( fechaConsulta.val() && fechaConsulta.val().indexOf(\"_\") == -1 && numExpNomPac.select2('val') && idEmpleado.select2('val') && idAtenAreaModEstab.select2('val') ){
                            findMatchDate();
                        }
                        else{
                            cancelHistory();
                        }
                    }
                }
                else{
                    cancelHistory();
                }
            });

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
                if( fechaConsulta.val() && fechaConsulta.val().indexOf(\"_\") == -1 && numExpNomPac.select2('val') && idEmpleado.select2('val') && idAtenAreaModEstab.select2('val') ){
                    findMatchDate();
                }
                else{
                    cancelHistory();
                }
            });

            /** Acciones de comportamiento para select de Medico y Especialidad **/
            ";
        // line 83
        if (((!$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true)) || (!($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")))) {
            // line 84
            echo "
                initializeSelect2(idEmpleado, true, false, { placeholder: 'Seleccionar Medico...', allowClear: true, width: '100%' } );
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
                });

            ";
        } else {
            // line 104
            echo "                idEmpleado.select2( 'val', ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getId"), "html", null, true);
            echo " );
                idEmpleado.select2( 'readonly', true );

                initializeSelect2(idAtenAreaModEstab, true, true, { placeholder: 'Seleccionar Especialidad...', allowClear: true, width: '100%'} );
                setEspecialidadesEmpleado( idEmpleado.select2('val') );

            ";
        }
        // line 111
        echo "
            idAtenAreaModEstab.on('change', function(e){
                if( fechaConsulta.val() && fechaConsulta.val().indexOf(\"_\") == -1 && numExpNomPac.select2('val') && idEmpleado.select2('val') && idAtenAreaModEstab.select2('val') ){
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
        // line 131
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

            function findMatchDate(){
                waitDiv.empty().append('<center><img id=\"wait\" src=\"";
        // line 141
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/wait_icon1.gif"), "html", null, true);
        echo "\" alt=\"wait\" width=\"24\" height=\"24\"><div id=\"search-message\">Por Favor Espere...</div></center>');
                \$.ajax({
                    url: Routing.generate('datehistorymatch') + '?fechaConsulta=' + fechaConsulta.val() + '&idExpediente=' + numExpNomPac.select2('val') + '&idEmpleado=' + idEmpleado.select2('val') + '&idAtenAreaModEstab=' + idAtenAreaModEstab.select2('val'),
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        waitDiv.empty();
                        if( data.citas.length > 0 ){
                            //Se asume que para una misma fecha solo existe una cita con el mismo idExediente para un mismo idEmpleado en una misma idAtenAreaModEstab
                            idCitaDia.val(data.citas[0].id);
                            //waitDiv.append('Se toma la Cita con Id: ' + data.citas[0].id + ' del Paciente con Exp: ' + data.citas[0].id_expediente + ' Programada el dia: ' + data.citas[0].fecha + ' a las ' + data.citas[0].hora_ini );
                            if( data.history.length > 0 ){
                                idRetroactiva.val(data.history[0].id);
                                if( data.history[0].id_motivo_retroactivo != null ){
                                    if( data.history[0].codigo == 'F' ){
                                        waitDiv.append('<br/><div class=\"alert alert-block alert-error\"><h4><i class=\"fa fa-fw fa-ban\"></i> Ya Existe la Consulta Retroactiva.</h4>La Historia Clinica Restroactiva ha sido Registrada y Finalizada, no puede ser Modificada.</div>');
                                    }
                                    else{
                                        waitDiv.append('<br/><div id=\"startDiv\" class=\"alert alert-block alert-info\"><h4><i class=\"fa fa-fw fa-mail-forward\"></i> Consulta Retroactiva en Proceso</h4>Se continuar&aacute; con la Historia Retroactiva en proceso.</div>');
                                        //waitDiv.append(' Id Historia: '+data.history[0].id);
                                        buttonTitle = 'Continuar';
                                        enableHistory();
                                    }
                                }else{
                                    //Ya existe una Historia similar que no es retroactiva.
                                    waitDiv.append('<br/><div class=\"alert alert-block alert-error\"><h4><i class=\"fa fa-fw fa-warning\"></i> La Consulta ya Existe.</h4>Ya existe una Historia Clinica registrada con los datos especificados. Por Favor, verifique la informaci&oacute;n proporcionada.</div>');
                                    //waitDiv.append(' Id Historia: '+data.history[0].id);
                                }
                            }else{ //No hay Historia Asociada. Se creara una Nueva.
                                idRetroactiva.val('');
                                waitDiv.append('<br/><div id=\"startDiv\" class=\"alert alert-block alert-info\"><h4><i class=\"fa fa-fw fa-file-text\"></i> Iniciar Consulta Retroactiva</h4>Se creara una <strong>nueva Consulta Retroactiva</strong>. Para Iniciar, <strong>complete los datos</strong> que se le piden a continuación, y luego de click en el Boton <strong>\"Iniciar Consulta Retroactiva\"</strong>.</div><br/><br/>');
                                buttonTitle = 'Iniciar Consulta Retroactiva';
                                enableHistory();
                            }
                        }
                        else{ //No se ha encontrado una posible Cita asociada con los datos especificados. Se creara una nueva Cita y la Historia.
                            idCitaDia.val('');
                            idRetroactiva.val('');
                            waitDiv.append('<br/><div id=\"startDiv\" class=\"alert alert-block alert-info\"><h4><i class=\"fa fa-fw fa-file-text\"></i> Iniciar Consulta Retroactiva</h4>Se creara una <strong>nueva Consulta Retroactiva</strong>. Para Iniciar, <strong>complete los datos</strong> que se le piden a continuación, y luego de click en el Boton <strong>\"Iniciar Consulta Retroactiva\"</strong>.</div><br/><br/>');
                            buttonTitle = 'Iniciar Consulta Retroactiva';
                            enableHistory();
                        }
                    }
                });
            }

            function enableHistory(){

                loadContainerDiv();

                if( ! idCitaDia.val()  ){
                    loadHorary();
                }

                if( ! idRetroactiva.val() ){
                    loadMotivo();
                    \$('#startDiv').append('<br/><a id=\"mainButton\" class=\"btn btn-primary\" disabled=\"disabled\" href=\"'+createUrl+'?id_expediente='+numExpNomPac.select2('val')+'&id_empleado='+idEmpleado.select2('val')+'&id_aten_area_mod_estab='+idAtenAreaModEstab.select2('val')+'&rta=true'+'&id_cita='+idCitaDia.val()+'\">'+buttonTitle+'</a><br/>');
                }else{
                    \$('#startDiv').append('<a id=\"mainButton\" class=\"btn btn-primary\" href=\"'+createUrl+'?id_expediente='+numExpNomPac.select2('val')+'&id_empleado='+idEmpleado.select2('val')+'&id_aten_area_mod_estab='+idAtenAreaModEstab.select2('val')+'&id_cita='+idCitaDia.val()+'&rta=true\">'+buttonTitle+'</a><br/>');
                }

                \$('#mainButton').on('click', function(e){
                    //e.preventDefault();
                    if( ! idCitaDia.val()  ){
                        \$.ajax({
                            method: \"POST\",
                            url: '";
        // line 207
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_citas_citcitasdia_create");
        echo "',
                            async: false,
                            dataType: 'json',
                            data: { idEmpleado: idEmpleado.select2('val'), idEmpleadoEspecialidadEstab: idAtenAreaModEstab.select2('val'), horarioMedico: horarioMedico.select2('val'), numExpNomPac: numExpNomPac.select2('val'), date: fechaConsulta.val().replace(/\\//g, \"-\"), jsonReturn: 'true', retroactive: 'true' }
                        })
                        .done( function(data, textStatus, jqXHR, e) {
                            console.log(textStatus);
                            \$('#mainButton').attr('href', \$('#mainButton').attr('href')+data['createdElement']+'&idMotivoRta='+\$('#idMotivoRetroactivo').select2('val') +
                                                          ( ( \$('#idTipoLugar').length > 0 ) ? '&idTipoLugar=' + \$('#idTipoLugar').select2('val') : '' ) +
                                                          ( ( \$('#nombreLugar').length > 0 ) ? '&nombreLugar=' + \$('#nombreLugar').val() : '' )
                                                 );
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus);
                            \$('#mainButton').attr('href', '#');
                        });

                    }
                    else{
                        if( ! idRetroactiva.val() ){
                            \$('#mainButton').attr('href', \$('#mainButton').attr('href')+'&idMotivoRta='+\$('#idMotivoRetroactivo').select2('val') +
                                                  ( ( \$('#idTipoLugar').length > 0 ) ? '&idTipoLugar=' + \$('#idTipoLugar').select2('val') : '' ) +
                                                  ( ( \$('#nombreLugar').length > 0 ) ? '&nombreLugar=' + \$('#nombreLugar').val() : '' )
                                                );
                        }
                    }
                    //e.preventDefault();
                });
            }

            function cancelHistory(){
                waitDiv.empty();
                idCitaDia.val('');
                formActionsDiv.hide();
            }

            function loadContainerDiv(){
                \$('#startDiv').append('\\
                    <div class=\"container-fluid\" style=\"margin-top: 30px;\">\\
                        <div class=\"row\">\\
                            <div class=\"col-xs-12 col-md-4\" id=\"divMotivoRetroactivo\"></div>\\
                            <div class=\"col-xs-18 col-md-3\" id=\"divHorarioMedico\"></div>\\
                            <div class=\"col-xs-12 col-md-2\" id=\"divTipoLugarRealizo\"></div>\\
                            <div class=\"col-xs-12 col-md-3\" id=\"divNombreLugarRealizo\"></div>\\
                        </div>\\
                    </div>'
                );
            }

            function loadHorary(){
                \$('#divHorarioMedico').append('\\
                    <label id=\"labelHorarioMedico\" class=\"control-label\">Horario de Atencion de Paciente</label>\\
                    <select id=\"horarioMedico\" name=\"horarioMedico\" required=\"required\" class=\"form-control\"></select>'
                );

                horarioMedico = \$('#horarioMedico');
                initializeSelect2(horarioMedico, true, true, { placeholder: 'Seleccionar Horario...', allowClear: true, width: '100%'} );

                jQuery.ajax({
                    url: Routing.generate('citashorariomedico') + '?idEmpleado=' + idEmpleado.select2('val') + '&idEmpleadoEspecialidadEstab=' + idAtenAreaModEstab.select2('val') + '&date=' + fechaConsulta.val().replace(/\\//g, \"-\"),
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        \$.each(data.data1, function(indice, val) {
                            if(val.id_estado_distribucion==1){
                                horarioMedico.append(\$('<option>', {value: val.id, text: val.rango_hora + ( val.id_tipo_distribucion ? ' - ' + val.nombre_tipo_distribucion : '') }));
                            }
                        });
                    }
                });

                horarioMedico.on('change', function(){
                    if( horarioMedico.select2('val') ){
                        if( \$('#idMotivoRetroactivo').length > 0 ){
                            if( \$('#idMotivoRetroactivo').select2('val') ){
                                if( \$('#idTipoLugar').length > 0 ){
                                    if( \$('#idTipoLugar').select2('val') ){
                                        \$('#mainButton').removeAttr('disabled');
                                    }
                                }
                                else{
                                    \$('#mainButton').removeAttr('disabled');
                                }
                            }
                        }
                        else{
                            \$('#mainButton').removeAttr('disabled');
                        }
                    }else{
                        \$('#mainButton').attr('disabled', 'disabled');
                    }
                });


            }

            function loadMotivo(){
                \$('#divMotivoRetroactivo').append('\\
                    <label id=\"labelMotivoRetroactivo\" class=\"control-label\">Motivo por el cual no se realizo la consulta</label>\\
                    <select id=\"idMotivoRetroactivo\" name=\"idMotivoRetroactivo\" required=\"required\" class=\"form-control\">'+motivoHTML.replace(/\\r?\\n|\\r/g, \"\")+'</select>'
                );

                var idMotivoRetroactivo = \$('#idMotivoRetroactivo');
                initializeSelect2( idMotivoRetroactivo, true, false, { placeholder: 'Seleccionar Motivo...', allowClear: true, width: '100%'} );

                idMotivoRetroactivo.on('change', function(){
                    if( idMotivoRetroactivo.select2('val') ){
                        if( idMotivoRetroactivo.select2('val') == 12 ){
                            loadTipoLugarRealizo();
                            loadNombreLugarRealizo();
                        }
                        else {
                            \$('#divTipoLugarRealizo').empty();
                            \$('#divNombreLugarRealizo').empty();
                            if( \$('#horarioMedico').length > 0 ){
                                if( \$('#horarioMedico').select2('val') ){
                                    \$('#mainButton').removeAttr('disabled');
                                }
                            }
                            else{
                                \$('#mainButton').removeAttr('disabled');
                            }
                        }
                    }else{
                        \$('#divTipoLugarRealizo').empty();
                        \$('#divNombreLugarRealizo').empty();
                        \$('#mainButton').attr('disabled', 'disabled');
                    }
                });


            }

            function loadTipoLugarRealizo(){
                \$('#divTipoLugarRealizo').append('\\
                    <label id=\"labelTipoLugar\" class=\"control-label\">Lugar de Realización</label>\\
                    <select id=\"idTipoLugar\" name=\"idTipoLugar\" required=\"required\" class=\"form-control\"></select>'
                );

                var idLugar = \$('#idTipoLugar');
                initializeSelect2( idLugar, true, true, { placeholder: 'Tipo de Lugar...', allowClear: true, width: '100%'} );

                jQuery.ajax({
                    url: Routing.generate('tipolugartrabajo') + '?ids=4,5,6,8,9,10', //Por el momento se habilitan estas opciones, si se desean todas eliminar el parametro
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        \$.each(data.data1, function(indice, val) {
                            idLugar.append(\$('<option>', { value: val.id, text: val.nombre }));
                        });
                    }
                });

                idLugar.on('change', function(){
                    if( idLugar.select2('val') ){

                        if( \$('#horarioMedico').length > 0 ){
                            if( \$('#horarioMedico').select2('val') && \$('#nombreLugar').val() ){
                                \$('#mainButton').removeAttr('disabled');
                            }
                        }
                        else{
                            if( \$('#nombreLugar').val() ){
                                \$('#mainButton').removeAttr('disabled');
                            }
                        }

                    }else{
                        \$('#mainButton').attr('disabled', 'disabled');
                    }
                });
            }

            function loadNombreLugarRealizo(){
                \$('#divNombreLugarRealizo').append('\\
                    <label id=\"labelNombreLugar\" class=\"control-label\">Nombre del Lugar</label>\\
                    <input id=\"nombreLugar\" name=\"nombreLugar\" required=\"required\" class=\"form-control\"/>'
                );

                var nombreLugar = \$('#nombreLugar');

                nombreLugar.on('keyup', function(){
                    if( nombreLugar.val() && nombreLugar.val().length >= 2 ){

                        if( \$('#horarioMedico').length > 0 ){
                            if( \$('#horarioMedico').select2('val') && \$('#idTipoLugar').select2('val') ){
                                \$('#mainButton').removeAttr('disabled');
                            }
                        }
                        else{
                            if( \$('#idTipoLugar').select2('val') ){
                                \$('#mainButton').removeAttr('disabled');
                            }
                        }

                    }else{
                        \$('#mainButton').attr('disabled', 'disabled');
                    }
                });
            }

        });//fin document ready

    </script>
";
    }

    // line 412
    public function block_form($context, array $blocks = array())
    {
        // line 413
        echo "    ";
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.top", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

    ";
        // line 415
        $context["url"] = (((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) ? ("edit") : ("create"));
        // line 416
        echo "
    ";
        // line 417
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url"))), "method"))) {
            // line 418
            echo "        <div>
            ";
            // line 419
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        </div>
    ";
        } else {
            // line 422
            echo "        <form
            ";
            // line 423
            if (($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "form_type"), "method") == "horizontal")) {
                echo "class=\"form-horizontal\"";
            }
            // line 424
            echo "            role=\"form\"
            action=\"";
            // line 425
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), 1 => array("id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
            echo "
            method=\"POST\"
            ";
            // line 427
            if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
                echo "novalidate=\"novalidate\"";
            }
            // line 428
            echo "            >
            ";
            // line 429
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
                // line 430
                echo "                <div class=\"sonata-ba-form-error\">
                    ";
                // line 431
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "
                </div>
            ";
            }
            // line 434
            echo "
            ";
            // line 435
            $this->displayBlock('sonata_pre_fieldsets', $context, $blocks);
            // line 438
            echo "
                ";
            // line 439
            $this->displayBlock('sonata_tab_content', $context, $blocks);
            // line 500
            echo "
                ";
            // line 501
            $this->displayBlock('sonata_post_fieldsets', $context, $blocks);
            // line 504
            echo "
            ";
            // line 505
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "

            ";
            // line 507
            $this->displayBlock('formactions', $context, $blocks);
            // line 514
            echo "        </form>
    ";
        }
        // line 516
        echo "
    ";
        // line 517
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.bottom", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

";
    }

    // line 435
    public function block_sonata_pre_fieldsets($context, array $blocks = array())
    {
        // line 436
        echo "                <div class=\"row\">
                ";
    }

    // line 439
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 440
        echo "                    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formgroups"));
        foreach ($context['_seq'] as $context["name"] => $context["form_group"]) {
            // line 441
            echo "                        <div class=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class"), "col-md-12")) : ("col-md-12")), "html", null, true);
            echo "\">
                            <div class=\"box box-primary\">
                                <div class=\"box-header\">
                                    <h4 class=\"box-title\">
                                        Por Favor Ingrese los siguientes Datos:
                                    </h4>
                                </div>
                                <div class=\"box-body\">
                                    <div class=\"sonata-ba-collapsed-fields\">
                                        <div class=\"container-fluid\">
                                            <div class=\"row\">
                                                <div class=\"col-xs-18 col-md-2\">
                                                    ";
            // line 453
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "fechaconsulta"), 'row');
            echo "
                                                </div>
                                                <div class=\"col-xs-12 col-md-4\">
                                                    <label id=\"labelNumExpNomPac\" class=\"control-label\">N° Expediente</label>
                                                    <input type=\"text\" id=\"numExpNomPac\" name=\"numExpNomPac\" required=\"required\" class=\"form-control\">
                                                </div>
                                                <div class=\"col-xs-12 col-md-3\">
                                                    ";
            // line 460
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idEmpleado"), 'row');
            echo "
                                                </div>
                                                <div class=\"col-xs-12 col-md-3\">
                                                    ";
            // line 463
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idAtenAreaModEstab"), 'row');
            echo "
                                                </div>
                                            </div>
                                            <div class=\"row\">
                                                <div class=\"col-xs-18 col-md-6\" id=\"originMotivo\">
                                                    ";
            // line 468
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idMotivoRetroactivo"), 'row');
            echo "
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
            // line 481
            if (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description") != false)) {
                // line 482
                echo "                                            <p>";
                echo $this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description");
                echo "</p>
                                        ";
            }
            // line 484
            echo "
                                        ";
            // line 485
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"));
            foreach ($context['_seq'] as $context["_key"] => $context["field_name"]) {
                // line 486
                echo "                                            ";
                if ($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "formfielddescriptions", array(), "any", false, true), (isset($context["field_name"]) ? $context["field_name"] : $this->getContext($context, "field_name")), array(), "array", true, true)) {
                    // line 487
                    echo "                                                ";
                    if ($this->getAttribute((isset($context["form"]) ? $context["form"] : null), (isset($context["field_name"]) ? $context["field_name"] : $this->getContext($context, "field_name")), array(), "array", true, true)) {
                        // line 488
                        echo "                                                    ";
                        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), (isset($context["field_name"]) ? $context["field_name"] : $this->getContext($context, "field_name")), array(), "array"), 'row');
                        echo "
                                                ";
                    }
                    // line 490
                    echo "                                            ";
                }
                // line 491
                echo "                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field_name'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 492
            echo "                                    </div>
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
        // line 499
        echo "                ";
    }

    // line 501
    public function block_sonata_post_fieldsets($context, array $blocks = array())
    {
        // line 502
        echo "                </div>
            ";
    }

    // line 507
    public function block_formactions($context, array $blocks = array())
    {
        // line 508
        echo "                <div id=\"formActionsDiv\" style=\"display: none;\">
                    <div id=\"formButtonsDiv\" class=\"well well-small form-actions\">
                        <!--<input type=\"submit\" class=\"btn btn-primary\" name=\"btn_create\" value=\"Crear Consulta Retroactiva\"/>-->
                    </div>
                </div>
            ";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecHistorialClinico/Retroactive:retroactive.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  691 => 492,  655 => 481,  484 => 412,  552 => 439,  709 => 255,  397 => 168,  392 => 165,  1577 => 1107,  1574 => 1106,  1569 => 1111,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 921,  1289 => 896,  1286 => 895,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 856,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 767,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 759,  992 => 720,  962 => 697,  960 => 696,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 279,  419 => 293,  639 => 468,  611 => 386,  538 => 431,  646 => 307,  642 => 286,  544 => 434,  541 => 204,  517 => 192,  797 => 489,  752 => 533,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 430,  519 => 425,  416 => 221,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 416,  775 => 413,  762 => 540,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 203,  534 => 348,  530 => 428,  521 => 194,  489 => 179,  483 => 206,  394 => 217,  396 => 206,  345 => 189,  476 => 174,  386 => 162,  364 => 114,  234 => 78,  595 => 326,  589 => 267,  586 => 436,  562 => 505,  556 => 274,  506 => 103,  498 => 417,  492 => 274,  473 => 277,  458 => 121,  399 => 209,  352 => 279,  346 => 125,  328 => 179,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 244,  573 => 516,  567 => 507,  520 => 247,  481 => 123,  475 => 275,  472 => 172,  466 => 227,  441 => 346,  438 => 189,  432 => 230,  429 => 222,  395 => 400,  382 => 231,  378 => 211,  367 => 115,  357 => 222,  348 => 190,  334 => 110,  286 => 169,  205 => 106,  297 => 113,  218 => 147,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 561,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 302,  687 => 301,  671 => 262,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 281,  609 => 273,  602 => 230,  591 => 439,  571 => 262,  499 => 268,  488 => 273,  389 => 235,  223 => 143,  14 => 2,  306 => 117,  303 => 159,  300 => 98,  292 => 95,  280 => 108,  12 => 36,  624 => 282,  620 => 223,  612 => 232,  601 => 379,  599 => 441,  580 => 265,  574 => 263,  559 => 504,  526 => 427,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 172,  401 => 119,  391 => 216,  369 => 228,  333 => 95,  329 => 93,  307 => 117,  287 => 152,  195 => 110,  178 => 123,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 460,  663 => 484,  660 => 194,  657 => 482,  650 => 238,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 221,  603 => 229,  600 => 178,  594 => 440,  588 => 372,  584 => 158,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 156,  513 => 244,  479 => 279,  468 => 163,  451 => 307,  448 => 195,  424 => 296,  418 => 222,  410 => 151,  376 => 109,  373 => 209,  340 => 200,  326 => 212,  261 => 89,  118 => 79,  200 => 127,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 894,  1279 => 377,  1273 => 887,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 768,  1056 => 766,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 536,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 712,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 563,  785 => 560,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 258,  712 => 437,  710 => 502,  707 => 501,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 241,  654 => 357,  649 => 308,  643 => 306,  640 => 226,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 501,  550 => 255,  527 => 153,  515 => 191,  512 => 423,  509 => 422,  503 => 419,  496 => 282,  493 => 415,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 214,  408 => 173,  388 => 292,  371 => 136,  363 => 133,  350 => 191,  342 => 274,  335 => 182,  316 => 16,  290 => 154,  276 => 102,  266 => 149,  263 => 102,  255 => 87,  245 => 122,  207 => 84,  194 => 126,  184 => 118,  76 => 34,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 491,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 219,  627 => 236,  622 => 369,  619 => 212,  616 => 276,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 368,  572 => 204,  566 => 324,  547 => 435,  545 => 253,  542 => 156,  533 => 429,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 163,  443 => 162,  431 => 251,  428 => 250,  425 => 156,  422 => 338,  412 => 152,  406 => 111,  390 => 164,  383 => 161,  377 => 119,  375 => 210,  372 => 199,  370 => 208,  359 => 204,  356 => 132,  353 => 131,  349 => 220,  336 => 272,  332 => 123,  330 => 122,  318 => 105,  313 => 119,  291 => 153,  190 => 98,  321 => 106,  295 => 154,  274 => 71,  242 => 136,  236 => 151,  70 => 22,  170 => 95,  288 => 197,  284 => 109,  279 => 134,  275 => 207,  256 => 145,  250 => 66,  237 => 81,  232 => 79,  222 => 129,  191 => 131,  153 => 69,  150 => 67,  563 => 188,  560 => 275,  558 => 195,  553 => 256,  549 => 438,  543 => 179,  537 => 176,  532 => 201,  528 => 199,  525 => 311,  523 => 195,  518 => 292,  514 => 339,  511 => 243,  508 => 188,  501 => 186,  491 => 288,  487 => 413,  460 => 240,  455 => 120,  449 => 164,  442 => 278,  439 => 133,  436 => 159,  433 => 185,  426 => 180,  420 => 220,  415 => 121,  411 => 174,  405 => 211,  403 => 149,  380 => 120,  366 => 285,  354 => 102,  331 => 198,  325 => 267,  320 => 265,  317 => 209,  311 => 262,  308 => 173,  304 => 116,  272 => 105,  267 => 91,  249 => 85,  216 => 146,  155 => 93,  146 => 102,  126 => 59,  188 => 213,  181 => 112,  161 => 100,  110 => 61,  124 => 80,  692 => 373,  683 => 282,  678 => 279,  676 => 488,  666 => 485,  661 => 407,  656 => 402,  652 => 376,  645 => 236,  641 => 352,  635 => 376,  631 => 463,  625 => 460,  615 => 453,  607 => 363,  597 => 163,  590 => 223,  583 => 435,  579 => 353,  577 => 213,  575 => 212,  569 => 514,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 139,  529 => 222,  524 => 344,  516 => 424,  510 => 78,  504 => 145,  500 => 418,  495 => 416,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 158,  421 => 223,  417 => 219,  400 => 148,  385 => 203,  361 => 207,  344 => 127,  339 => 273,  324 => 102,  310 => 118,  302 => 115,  296 => 96,  282 => 143,  259 => 151,  244 => 96,  231 => 123,  226 => 76,  215 => 63,  186 => 121,  152 => 103,  114 => 75,  104 => 57,  358 => 209,  351 => 130,  347 => 208,  343 => 188,  338 => 125,  327 => 268,  323 => 121,  319 => 176,  315 => 104,  301 => 204,  299 => 174,  293 => 111,  289 => 162,  281 => 93,  277 => 107,  271 => 157,  265 => 150,  262 => 68,  260 => 146,  257 => 100,  251 => 123,  248 => 139,  239 => 131,  228 => 75,  225 => 149,  213 => 70,  211 => 125,  197 => 135,  174 => 115,  148 => 94,  134 => 83,  127 => 96,  20 => 1,  270 => 150,  253 => 124,  233 => 92,  212 => 135,  210 => 118,  206 => 141,  202 => 114,  198 => 104,  192 => 124,  185 => 100,  180 => 118,  175 => 110,  172 => 106,  167 => 104,  165 => 108,  160 => 95,  137 => 104,  113 => 76,  100 => 42,  90 => 82,  81 => 34,  65 => 24,  129 => 82,  97 => 45,  77 => 20,  34 => 2,  53 => 18,  84 => 80,  58 => 26,  23 => 2,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 227,  427 => 226,  423 => 256,  413 => 220,  409 => 219,  407 => 247,  402 => 210,  398 => 401,  393 => 296,  387 => 215,  384 => 214,  381 => 236,  379 => 110,  374 => 137,  368 => 207,  365 => 119,  362 => 205,  360 => 223,  355 => 280,  341 => 126,  337 => 201,  322 => 266,  314 => 162,  312 => 174,  309 => 100,  305 => 204,  298 => 165,  294 => 142,  285 => 152,  283 => 151,  278 => 142,  268 => 101,  264 => 90,  258 => 88,  252 => 98,  247 => 133,  241 => 62,  229 => 135,  220 => 72,  214 => 86,  177 => 77,  169 => 111,  140 => 73,  132 => 83,  128 => 81,  107 => 58,  61 => 52,  273 => 130,  269 => 104,  254 => 99,  243 => 83,  240 => 153,  238 => 61,  235 => 80,  230 => 2,  227 => 1,  224 => 90,  221 => 148,  219 => 60,  217 => 87,  208 => 132,  204 => 138,  179 => 112,  159 => 71,  143 => 88,  135 => 84,  119 => 77,  102 => 45,  71 => 32,  67 => 30,  63 => 15,  59 => 21,  28 => 2,  94 => 44,  89 => 42,  85 => 37,  75 => 36,  68 => 30,  56 => 12,  87 => 81,  201 => 152,  196 => 125,  183 => 211,  171 => 107,  166 => 107,  163 => 93,  158 => 104,  156 => 70,  151 => 68,  142 => 84,  138 => 99,  136 => 84,  121 => 80,  117 => 65,  105 => 89,  91 => 53,  62 => 23,  49 => 17,  25 => 5,  21 => 3,  31 => 3,  38 => 5,  26 => 6,  24 => 31,  19 => 2,  93 => 83,  88 => 37,  78 => 78,  46 => 34,  44 => 8,  27 => 6,  79 => 33,  72 => 33,  69 => 54,  47 => 7,  40 => 12,  37 => 11,  22 => 30,  246 => 84,  157 => 94,  145 => 85,  139 => 90,  131 => 61,  123 => 69,  120 => 69,  115 => 54,  111 => 91,  108 => 59,  101 => 47,  98 => 40,  96 => 84,  83 => 60,  74 => 33,  66 => 29,  55 => 21,  52 => 11,  50 => 20,  43 => 13,  41 => 12,  35 => 6,  32 => 7,  29 => 6,  209 => 68,  203 => 128,  199 => 151,  193 => 116,  189 => 80,  187 => 114,  182 => 68,  176 => 100,  173 => 65,  168 => 108,  164 => 97,  162 => 107,  154 => 104,  149 => 163,  147 => 89,  144 => 92,  141 => 91,  133 => 60,  130 => 97,  125 => 27,  122 => 84,  116 => 50,  112 => 47,  109 => 90,  106 => 61,  103 => 60,  99 => 85,  95 => 2,  92 => 43,  86 => 59,  82 => 36,  80 => 36,  73 => 77,  64 => 29,  60 => 19,  57 => 19,  54 => 50,  51 => 17,  48 => 16,  45 => 14,  42 => 5,  39 => 4,  36 => 10,  33 => 3,  30 => 2,);
    }
}
