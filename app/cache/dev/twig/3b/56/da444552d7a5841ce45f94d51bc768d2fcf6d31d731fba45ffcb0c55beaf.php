<?php

/* MinsalLaboratorioBundle:CRUD:SecSolicitudestudios/edit.html.twig */
class __TwigTemplate_3b56da444552d7a5841ce45f94d51bc768d2fcf6d31d731fba45ffcb0c55beaf extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:edit.html.twig");

        $_trait_0 = $this->env->loadTemplate("MinsalLaboratorioBundle:Custom:SecSolicitudestudios/registrar_paciente.html.twig");
        // line 4
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."MinsalLaboratorioBundle:Custom:SecSolicitudestudios/registrar_paciente.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            array(
                'actions' => array($this, 'block_actions'),
                'javascripts' => array($this, 'block_javascripts'),
                'form' => array($this, 'block_form'),
                'formactions' => array($this, 'block_formactions'),
            )
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 5
        $context["_registrar_paciente"] = $this->renderBlock("registrar_paciente", $context, $blocks);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 7
    public function block_actions($context, array $blocks = array())
    {
        // line 8
        echo "    ";
        $this->displayParentBlock("actions", $context, $blocks);
        echo "
";
    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        // line 12
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script type=\"text/javascript\">

        modal_elements.push({ //agregar modal para agregar paciente
            id:           'add_paciente_modal',
            func:         'agregar_paciente',
            header:       'Registro de Paciente',
            closeBtnName: 'Cancelar',
            afterLoadCallFunction: 'inicializarElementos',
            footer:
                '<button id=\"agregar_paciente_submit\" type=\"button\" name=\"agregar_paciente_submit\"'+
                'class=\"btn btn-primary\"><span class=\"label\"> <span class=\"fa fa-plus-square\"></span> Agregar Paciente</span></button>',
            widthModal:   750
        });

        function agregar_paciente() { //requerido para el modal
            var html = '';
            html     = '";
        // line 29
        ob_start();
        echo strtr((isset($context["_registrar_paciente"]) ? $context["_registrar_paciente"] : $this->getContext($context, "_registrar_paciente")), array("
" => ""));
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        echo "'; //carga el block de una vista

            return html;
        }

        function inicializarElementos() { //requerido para la modal de agregar_paciente
            \$id_sexo = \$('#id_sexo');
            \$establecimiento = \$('#establecimiento');
            \$fecha_nacimiento = \$('#fecha_nacimiento');

            var options = {
                placeholder: '...Seleccione...',
                allowClear: true,
                containerCss: {
                    'width': '100%'
                }
            };

            var datePickerOptions = setBootstrapDatePickerOptions(\$fecha_nacimiento);
            datePickerOptions['startView'] = 2;

            \$fecha_nacimiento.datepicker(datePickerOptions);

            \$('body').on('changeDate','#fecha_nacimiento', function(e) {
                var text = \$(this).val();

                if(text.length === 10) {
                    var now   = moment();
                    var fecha = moment(text, 'DD/MM/YYYY');

                    now.set({ 'hour': 0, 'minute': 0, 'seconds': 0, 'milliseconds': 0 });
                    fecha.set({ 'hour': 0, 'minute': 0, 'seconds': 0, 'milliseconds': 0 });

                    var years = now.diff(fecha, 'year');
                    fecha.add(years, 'years');

                    var months = now.diff(fecha, 'months');
                    fecha.add(months, 'months');

                    var days = now.diff(fecha, 'days');

                    \$('#edad_anio').val( years );
                    \$('#edad_meses').val( months );
                    \$('#edad_dias').val( days );
                }
            });

            \$('body').on('input','#edad_anio', function() {
                calcularFecha();
            });

            \$('body').on('input','#edad_meses', function() {
                calcularFecha();
            });

            \$('body').on('input','#edad_dias', function() {
                calcularFecha();
            });

            options['placeholder'] = 'Sexo...';
            initializeSelect2(\$id_sexo, true, false, options);

            \$(\"#agregar_paciente_submit\").on('click', function () {
                var paciente = {
                    idestablecimiento_local: ";
        // line 93
        echo twig_escape_filter($this->env, (isset($context["idestablecimiento_local"]) ? $context["idestablecimiento_local"] : $this->getContext($context, "idestablecimiento_local")), "html", null, true);
        echo ",
                    expediente             : \$('#expediente').val(),
                    idestablecimiento      : \$('#idestablecimiento').select2('val'),
                    primer_nombre          : \$('#primer_nombre').val(),
                    segundo_nombre         : \$('#segundo_nombre').val(),
                    tercer_nombre          : \$('#tercer_nombre').val(),
                    primer_apellido        : \$('#primer_apellido').val(),
                    segundo_apellido       : \$('#segundo_apellido').val(),
                    apellido_casada        : \$('#apellido_casada').val(),
                    fecha_nacimiento       : \$('#fecha_nacimiento').val(),
                    nombre_responsable     : \$('#nombre_responsable').val(),
                    nombre_madre           : \$('#nombre_madre').val(),
                    nombre_padre           : \$('#nombre_padre').val(),
                    id_sexo                : \$('#id_sexo').select2('val')
                };

                var errorArray = [];

                /* verificar campos obligatorios para agregar al paciente */
                if(!\$('#primer_nombre').val()) {
                    errorArray.push({nombre: 'Primer Nombre'});
                }

                if(!\$('#primer_apellido').val()) {
                    errorArray.push({nombre: 'Primer Apellido'});
                }

                if(!\$('#fecha_nacimiento').val()) {
                    errorArray.push({nombre: 'Fecha de Nacimiento'});
                }

                if(!\$('#id_sexo').select2('val')) {
                    errorArray.push({nombre: 'Sexo'});
                }

                if(errorArray.length > 0) { // evaluar si hubo error en los parametros necesarios
                    if(errorArray.length === 1) {
                        errorMessage = 'El campo: <strong>'+errorArray[0].nombre+'</strong> no ha sido seleccionado o ingresado.';
                    } else {
                        errorMessage = 'Los siguientes campos no han sido seleccionados o ingresados: ';
                        errorMessage += '<ul>';
                        errorArray.forEach(function(element, index, array) {
                            errorMessage += '<li><strong>'+element.nombre+'</strong></li>';
                        });
                        errorMessage += '</ul>';
                    }

                    showDialogMsg('Campos No seleccionados', errorMessage, 'dialog-error', 'Cerrar', null, true, 500, false);
                } else {
                    \$.ajax({
                        url: \"";
        // line 143
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_laboratorio_secsolicitudestudios_agregar_paciente_referido");
        echo "\",
                        data: paciente,
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            if(data.status) {
                                \$('button[name=\"btn_search\"').trigger('click');
                                \$('body #myModal').modal('hide');
                            } else {
                                console.error(data.msjError);
                                showDialogMsg('Error al agregar paciente', 'Lo sentimos, hubo un error al agregar el paciente, por favor intente nuevamente si el problema persiste contacte con el administrador...', 'dialog-error', 'Cerrar');
                            }
                        }
                    });
                }
            });

            \$.ajax({
                url: Routing.generate('get_sexo'),
                async: true, //hace mas agil la llamada al ajax
                dataType: 'json',
                success: function(data) {
                    \$.each(data, function(idx, val) {
                        \$id_sexo.append(\$('<option>', {value:val.id, text: val.nombre}));
                    });
                }
            });

            // setea el input con el texto del select2 (establecimiento seleccionado)
            \$idEstablecimiento = \$('#idestablecimiento');
            \$establecimiento = \$('#establecimiento');
            \$establecimiento.val( \$idEstablecimiento.select2('data') !== null ? \$idEstablecimiento.select2('data').text : '');
            // setea el input con el texto del input expediente
            \$expediente = \$('#expediente');
            \$expediente2 = \$('#expediente2');
            \$expediente2.val( \$expediente.val() !== null ? \$expediente.val() : '');
        } /* fin de inicializar la variables para la popup */


        /* inicio del jquery de la paguina*/
        jQuery(document).ready(function (\$) {
            \$idEstablecimiento = \$('#idestablecimiento'); // # = cuando es id; [name=\"nombre\"] = cuando es por nombre, . cuando es clase
            \$id_cie10 = \$('#id_cie10');
            \$id_procedencia = \$('#id_procedencia');
            \$id_subservicio = \$('#id_subservicio');
            \$id_medico = \$('#id_medico');

            \$idEstablecimiento.on('change', function(e) { // obtiene la opcion que ha cambiado dentro del select e=EVENTO
                if(e.val) { //validar para ejecutar solo cuando hay un valor seleccionado.
                    \$('#id_establecimiento_text').val(\$('#idestablecimiento').select2('val'));
                }

                clearElements();
            });

            \$('#expediente').on('input', function() {
                clearElements();
            });

            var options = { // objeto variable
                placeholder: 'Seleccione...',
                allowClear: true, //permite deseleccionar
                containerCss: {
                    'width': '100%'
                }
            };

            \$id_cie10.select2({
                allowClear: true,
                placeholder: 'Seleccionar diagnostico...',
                minimumInputLength: 2,
                dropdownAutoWidth: true,
                containerCss: {
                    'width': '100%'
                },
                ajax: {
                    url: Routing.generate('diagnostico'),
                    dataType: 'json',
                    quietMillis: 500,
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
                initSelection: function(element, callback) {
                    // the input tag has a value attribute preloaded that points to a preselected repository's id
                    // this function resolves that id attribute to an object that select2 can render
                    // using its formatResult renderer - that way the repository name is shown preselected
                    var id = element.val();
                    if (id !== \"\") {
                        \$.ajax(Routing.generate('diagnostico') +'?id='+id, {
                            dataType: \"json\"
                        }).done(function(data) {
                                    callback(data);
                                    element.select2('data',{id: id,text: data.data1[0].text });

                                });
                    }
                }
            })
            .on('change',function(e) {
                \$('#solicitud-error-message').empty();
            });

            /* inicializando procedencias */
            \$.ajax({
                url: Routing.generate('get_procedencia'),
                async: true,
                dataType: 'json',
                success: function(data){
                    \$.each(data, function(idx, val) {
                        \$id_procedencia.append(\$('<option>', {value:val.id, text: val.nombre}));
                    });

                    ";
        // line 265
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")) {
            // line 266
            echo "                        ";
            if ((!(null === $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idAreaAtenModEstab"), "method")))) {
                // line 267
                echo "                            if( Object.keys(data).length > 0 ) {
                                \$id_procedencia.select2('val','";
                // line 268
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idAreaAtenModEstab"), "method"), "html", null, true);
                echo "').trigger('change');
                                ";
                // line 269
                if ((!(null === $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idAreaAtencion"), "method")))) {
                    // line 270
                    echo "                                    if( '";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idAreaAtencion"), "method"), "html", null, true);
                    echo "' == '1' ){
                                        \$id_procedencia.select2( 'readonly', true );
                                    }
                                ";
                }
                // line 274
                echo "                            }
                        ";
            }
            // line 276
            echo "                    ";
        }
        // line 277
        echo "                }
            });

            /* cambiar sub-servicio deacuerdo a la procedencias */
            \$id_procedencia.on('change', function(e) { // obtiene la opcion que ha cambiado dentro del select e=EVENTO
                options['placeholder'] = 'Seleccione sub-servicio...';
                initializeSelect2(\$id_subservicio, true, true, options);

                options['placeholder'] = 'Seleccione medico...';
                initializeSelect2(\$id_medico, true, true, options);

                \$('#solicitud-error-message').empty();

                if( \$id_procedencia.select2('val') ) { //validar para ejecutar solo cuando hay un valor seleccionado.
                    \$.ajax({
                        url: Routing.generate('get_subservicio'),
                        data: { id_procedencia: \$id_procedencia.select2('val') }, // parametros de envio a la consulta
                        async: true,
                        dataType: 'json',
                        success: function(data) { //si fue exitosa la llamada del ajax
                            \$.each(data, function(idx, val) { // los datos devueltos
                                \$id_subservicio.append(\$('<option>', {value:val.id, text: val.nombre})); //agrega al combo
                            });

                            ";
        // line 301
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")) {
            // line 302
            echo "                                ";
            if ((!(null === $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idEmpEspecialidadEstab"), "method")))) {
                // line 303
                echo "                                    if( Object.keys(data).length > 0 ) {
                                        \$id_subservicio.select2('val','";
                // line 304
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idEmpEspecialidadEstab"), "method"), "html", null, true);
                echo "').trigger('change');
                                        ";
                // line 305
                if ((!(null === $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idAreaAtencion"), "method")))) {
                    // line 306
                    echo "                                            if( '";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idAreaAtencion"), "method"), "html", null, true);
                    echo "' == '1' ){
                                                \$id_subservicio.select2( 'readonly', true );
                                            }
                                        ";
                }
                // line 310
                echo "                                    }
                                ";
            }
            // line 312
            echo "                            ";
        }
        // line 313
        echo "                        }
                    });
                }
            });

            /* cambiar sub-medico deacuerdo a la sub-servicio */
            \$id_subservicio.on('change', function(e) { // obtiene la opcion que ha cambiado dentro del select e=EVENTO
                options['placeholder'] = 'Seleccione medico...';
                initializeSelect2(\$id_medico, true, true, options);

                \$('#solicitud-error-message').empty();

                if( \$id_subservicio.select2('val') ) { //validar para ejecutar solo cuando hay un valor seleccionado.
                    \$.ajax({
                        url: Routing.generate('get_medico'),
                        data: { id_subservicio: \$id_subservicio.select2('val') }, // parametros de envio a la consulta
                        async: true,
                        dataType: 'json',
                        success: function(data) { //si fue exitosa la llamada del ajax
                            \$.each(data, function(idx, val) { // los datos devueltos
                                \$id_medico.append(\$('<option>', {value:val.id, text: val.nombre})); //agrega al combo
                            });

                            ";
        // line 336
        if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")) {
            // line 337
            echo "                                if( Object.keys(data).length > 0 ) {
                                    \$id_medico.select2('val','";
            // line 338
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "getId", array(), "method"), "html", null, true);
            echo "').trigger('change');
                                    ";
            // line 339
            if ((!(null === $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idAreaAtencion"), "method")))) {
                // line 340
                echo "                                        if( '";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idAreaAtencion"), "method"), "html", null, true);
                echo "' == '1' ){
                                            \$id_medico.select2( 'readonly', true );
                                        }
                                    ";
            }
            // line 344
            echo "                                }
                            ";
        }
        // line 346
        echo "                        }
                    });
                }
            });

            options['placeholder'] = 'Seleccionar Establecimiento...';
            initializeSelect2(\$idEstablecimiento, true, false, options);
            \$idEstablecimiento.select2('val', '";
        // line 353
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "getIdEstablecimiento", array(), "method"), "getId", array(), "method"), "html", null, true);
        echo "'); // setea el select2 con el valor por defecto.


            options['placeholder'] = 'Seleccionar procedencia...';
            initializeSelect2(\$id_procedencia, true, false, options);


            options['placeholder'] = 'Seleccionar sub-servicio...';
            initializeSelect2(\$id_subservicio, true, false, options);


            options['placeholder'] = 'Seleccionar medico...';
            initializeSelect2(\$id_medico, true, false, options);

            \$id_medico.on('change',function(e) {
                \$('#solicitud-error-message').empty();
            });

            \$('#fecha_solicitud').on('changeDate input', function() {
                \$('#solicitud-error-message').empty();
            });

            /* proceso para buscar el expediente ingresado
             * una vez cumpla las condiciones
             */
            \$('button[name=\"btn_search\"').on('click', function (e) {
                /* validar los datos requeridos para ejecutar la busqueda */
                \$('#paciente_no_encontrado').empty();

                var errorArray  = validate();
                var errorMessage = '';

                if(errorArray.length > 0) { // evaluar si hubo error en los parametros necesarios
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

                    \$('#paciente_no_encontrado').append('<div class=\"alert alert-danger\" role=\"alert\"><i class=\"fa fa-times\"></i> ' + errorMessage + '</div>');
                } else { //evaluar si los parametros necesarios estan completos
                    \$.ajax({
                        url: Routing.generate('get_paciente'),
                        async: true,
                        dataType: 'json',
                        data: {'idestablecimiento': \$('#idestablecimiento').select2('val'),
                            'expediente': \$('#expediente').val()
                        },
                        success: function (data) {
                            if (Object.keys(data).length > 0) { // si se recibe al menos un dato de algun paciente encontrado
                                // Mostrar los datos
                                \$('#nombre').text(data.nombres);
                                \$('#sexo').text(data.sexo);
                                \$('#edad').text(data.edad);
                                \$('#conocidopor').text( (data.conocidopor ? data.conocidopor : 'N/A' ) );
                                \$('#add_paciente_modal').attr('disabled','disabled');
                                \$('#id_numero_expediente_text').val(data.id_numero_expediente);
                                // mostrar la solicitud
                                \$('#div_solicitud').attr('hidden', false);
                                if( ! \$(\"#fecha_solicitud\").val() ){
                                    \$(\"#fecha_solicitud\").val(getCurrentDate());
                                }
                            } else { // no hubo coincidencia de la buaque de paciente
                                \$('#nombre').text('N/A');
                                \$('#sexo').text('N/A');
                                \$('#edad').text('N/A');
                                \$('#conocidopor').text('N/A');
                                if (\$('#idestablecimiento').select2('val') == ";
        // line 425
        echo twig_escape_filter($this->env, (isset($context["idestablecimiento_local"]) ? $context["idestablecimiento_local"] : $this->getContext($context, "idestablecimiento_local")), "html", null, true);
        echo ") { //evaluar si es el mismo establecimiento
                                    \$('#paciente_no_encontrado').append('<div class=\"alert alert-warning\" role=\"alert\"><i class=\"fa fa-warning\"></i> <strong>Expediente no encontrado</strong>, por favor solicite el registro del paciente en el área de archivo.</strong></div>');
                                    \$('#add_paciente_modal').attr('disabled','disabled');
                                } else {
                                    // Mostrar botón de registro de paciente.
                                    \$('#add_paciente_modal').removeAttr('disabled');
                                    \$('#paciente_no_encontrado').append('<div class=\"alert alert-warning\" role=\"alert\"><i class=\"fa fa-warning\"></i> <strong>Expediente no encontrado</strong>, para continuar por favor registre el paciente haciendo click en el botón <strong>Agregar Paciente</strong>.</strong></div>');
                                }
                            }

                            /* capturar id_establecimiento para enviarlo a la consulta */
                            \$('#id_establecimiento_text').val(\$('#idestablecimiento').select2('val'));
                        }
                    });
                }
            });

            function validate() {
                var errorArray = [];

                if(!\$('#idestablecimiento').select2('val')) {
                    errorArray.push({nombre: 'Establecimiento'});
                }

                if(!\$('#expediente').val()) {
                    errorArray.push({nombre: 'Expediente'});
                }

                return errorArray;
            }

            window.calcularFecha = function() {
                var years  = parseInt( \$('#edad_anio').val() ) >= 0 ? parseInt( \$('#edad_anio').val() ) : 0 ;
                var months = parseInt( \$('#edad_meses').val() ) >= 0 ? parseInt( \$('#edad_meses').val() ) : 0 ;
                var days   = parseInt( \$('#edad_dias').val() ) >= 0 ? parseInt( \$('#edad_dias').val() ) : 0 ;
                var fecha  = moment();
                fecha.set({ 'hour': 0, 'minute': 0, 'seconds': 0, 'milliseconds': 0 });

                fecha.subtract(years, 'y').subtract(months, 'M').subtract(days - 1, 'd');

                \$('#fecha_nacimiento').datepicker('update',fecha.format('DD/MM/YYYY'));
            }

            \$('[name=\"btn_add_examenes\"]').on('click',function() {
                var errorArray  = validateSolicitud();
                var errorMessage = '';

                \$('#solicitud-error-message').empty();

                if(errorArray.length > 0) { // evaluar si hubo error en los parametros necesarios
                    if(errorArray.length === 1) {
                        errorMessage = 'El campo: '+errorArray[0].nombre+' no ha sido seleccionado o ingresado.';
                    } else {
                        errorMessage = 'Los siguientes campos no han sido seleccionados o ingresados: ';
                        errorMessage += '<ul>';

                        errorArray.forEach(function(element, index, array) {
                            errorMessage += '<li>'+element.nombre+'</li>';
                        });

                        errorMessage += '</ul>';
                    }

                    \$('#solicitud-error-message').append('<div class=\"alert alert-danger\" role=\"alert\">'+errorMessage+'</div>')
                } else {
                    \$('form#frm-agregar-examenes').submit();
                }
            });

            function validateSolicitud() {
                var errorArray = [];

                if( ( ! \$('#id_cie10').select2('val') ) && ( ! \$(\"#espec_diagnostico\").val() ) ) {
                    errorArray.push({nombre: 'Diagnóstico Presuntivo: Debe especificar el diagnostico presuntivo al menos en una opción.'});
                }

                if(!\$('#id_procedencia').select2('val')) {
                    errorArray.push({nombre: 'Procedencia'});
                }

                if(!\$('#id_subservicio').select2('val')) {
                    errorArray.push({nombre: 'Sub-servicio'});
                }

                if(!\$('#id_medico').select2('val')) {
                    errorArray.push({nombre: 'Médico Solicitante'});
                }

                if(!\$('#fecha_solicitud').val()) {
                    errorArray.push({nombre: 'Fecha de la Solicitud'});
                }

                return errorArray;
            }

            function clearElements() {
                \$('#div_solicitud').attr('hidden', true);

                \$('#nombre').text('N/A');
                \$('#sexo').text('N/A');
                \$('#edad').text('N/A');
                \$('#conocidopor').text('N/A');
                \$('#add_paciente_modal').attr('disabled','disabled');
                \$('#id_numero_expediente_text').val('');
                \$('#id_establecimiento_text').val('');

            }
        });
    </script>
";
    }

    // line 536
    public function block_form($context, array $blocks = array())
    {
        // line 537
        echo "    <div class=\"row\">
        <div class=\"col-md-6\">
            <div class=\"box box-success\">
                <div class=\"box-header\">
                    <h4 class=\"box-title\">
                        Búsqueda de expediente clínico
                    </h4>
                </div>
                <div class=\"box-body\">
                    <div id=\"paciente_no_encontrado\"></div>
                    <div class=\"sonata-ba-collapsed-fields\">
                        <div class=\" sonata-ba-field sonata-ba-field-standard-natural  \">
                            <div class=\"form-group\">
                                <label for=\"idestablecimiento\">Establecimiento:</label>
                                <select id=\"idestablecimiento\" name=\"idestablecimiento\">
                                    ";
        // line 552
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["establecimientos"]) ? $context["establecimientos"] : $this->getContext($context, "establecimientos")));
        foreach ($context['_seq'] as $context["_key"] => $context["estab"]) {
            // line 553
            echo "                                        <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["estab"]) ? $context["estab"] : $this->getContext($context, "estab")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["estab"]) ? $context["estab"] : $this->getContext($context, "estab")), "nombre"), "html", null, true);
            echo "</option>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['estab'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 555
        echo "                                </select>
                            </div>
                        </div>
                        <div class=\" sonata-ba-field sonata-ba-field-standard-natural  \">
                            <div class=\"form-group\">
                                <label for=\"expediente\">Expediente:</label>
                                <input required class=\"form-control\" id=\"expediente\" name=\"expediente\" placeholder=\"Ingresar No. Expediente\" type=\"text\">
                            </div>
                        </div>
                        <div class=\"well well-small form-actions\">
                            <button class=\"btn btn-success\" type=\"button\" name=\"btn_search\"><i class=\"fa fa-search\"></i> Búscar expediente</button>

                            <i class=\"fa fa-refresh fa-spin\" style=\"display: none\"></i>
                            <a disabled id=\"add_paciente_modal\" href=\"#myModal\" data-toggle=\"modal\" custom-modal=\"true\" class=\"btn btn-primary\" name=\"btn_agregarpaciente\" data-backdrop=\"static\" data-keyboard=\"false\"><i class=\"fa fa-plus-square\"></i> Agregar paciente</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"col-md-6\">
            <div class=\"box box-success\">
                <div class=\"box-header\">
                    <h4 class=\"box-title\">
                        Datos del paciente
                    </h4>
                </div>
                <div class=\"box-body\">
                    <div class=\"sonata-ba-collapsed-fields\">
                        <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
                            <label class=\"control-label\">Nombre:</label>
                            <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
                                <label id=\"nombre\" class=\"control-label\" style=\"color: #0aa7d6;\">N/A</label>
                            </div>
                        </div>
                        <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
                            <label class=\"control-label\">Edad:</label>
                            <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
                                <label id=\"edad\" class=\"control-label\" style=\"color: #0aa7d6;\">N/A</label>
                            </div>
                        </div>
                        <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
                            <label class=\"control-label\">Sexo:</label>

                            <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
                                <label id=\"sexo\" class=\"control-label\" style=\"color: #0aa7d6;\">N/A</label>
                            </div>
                        </div>
                        <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
                            <label class=\"control-label\">Conocido por:</label>
                            <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
                                <label id=\"conocidopor\" class=\"control-label\" style=\"color: #0aa7d6;\">N/A</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=\"col-md-12\" id='div_solicitud' hidden >
            <div class=\"box box-success\">
                <div class=\"box-header\">
                    <h4 class=\"box-title\">
                        Solicitud
                    </h4>
                </div>
                <div class=\"box-body\">
                    <form id=\"frm-agregar-examenes\" action=\"";
        // line 621
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_laboratorio_secsolicitudestudios_agregar_solicitud");
        echo "\">
                        <input type=\"hidden\" id=\"id_numero_expediente_text\" name=\"id_numero_expediente_text\" value=\"\">
                        <input type=\"hidden\" id=\"id_establecimiento_text\" name=\"id_establecimiento_text\" value=\"\">
                        <div id=\"solicitud-error-message\"></div>
                        <div class=\"bs-callout bs-callout-info\">
                            <div class=\" sonata-ba-field sonata-ba-field-standard-natural  \">
                                <h4>Diagnostico Presuntivo</h4>
                                Por favor ingrese el diagnostico presuntivo CIE10 y/o especificación diagnostica.
                                <div class=\"form-group\" style=\"position: relative;\">
                                    <label class=\"control-label\">CIE10:</label>
                                    <input type=\"hidden\" id=\"id_cie10\" name=\"id_cie10\" value=\"\">
                                </div>
                                <div class=\"form-group\" style=\"position: relative;\">
                                    <label class=\"control-label\">Especificación/Observación:</label><br/>
                                    <textarea class=\"form-control\" id=\"espec_diagnostico\" name=\"espec_diagnostico\"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class=\"bs-callout bs-callout-primary\">
                            <h4>Datos Complementarios</h4>
                            <div class=\" sonata-ba-field sonata-ba-field-standard-natural  \">
                                <div class=\"form-group\" style=\"position: relative;\">
                                    <label class=\"control-label\">Procedencia:</label>
                                    <select required name=\"id_procedencia\" id=\"id_procedencia\"></select>
                                </div>
                            </div>
                            <div class=\" sonata-ba-field sonata-ba-field-standard-natural  \">
                                <div class=\"form-group\" style=\"position: relative;\">
                                    <label class=\"control-label\">Sub-servicio:</label>
                                    <select required name=\"id_subservicio\" id=\"id_subservicio\"></select>
                                </div>
                            </div>
                            <div class=\" sonata-ba-field sonata-ba-field-standard-natural  \">
                                <div class=\"form-group\" style=\"position: relative;\">
                                    <label class=\"control-label\">Médico solicitante:</label>
                                    <select required name=\"id_medico\" id=\"id_medico\"></select>
                                </div>
                            </div>
                            <div class=\" sonata-ba-field sonata-ba-field-standard-natural  \">
                                <div class=\"form-group\" style=\"position: relative;\">
                                    <label class=\"control-label\">Fecha de la solicitud:</label>
                                    <input name=\"fecha_solicitud\" id=\"fecha_solicitud\" required class=\"form-control bootstrap-datepicker\" data-mask=\"99/99/9999\" placeholder=\"dd/mm/yyyy\" data-date-end-date=\"";
        // line 662
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now"), "html", null, true);
        echo "\"></input>
                                </div>
                            </div>
                        </div>

                        <div class=\"well well-small form-actions\">
                            <button class=\"btn btn-success\" type=\"button\" id=\"btn_add_examenes\" name=\"btn_add_examenes\"><i class=\"fa fa-plus-square\"></i> Agregar examenes</button>

                            <i class=\"fa fa-refresh fa-spin\" style=\"display: none\"></i>
                            <a id=\"btn_nueva_busqueda\"class=\"btn btn-primary\" name=\"btn_nueva_busqueda\" data-backdrop=\"static\" data-keyboard=\"false\" onClick=\"location.reload(true);\"><i class=\"fa fa-search\"></i> Nueva búsqueda de expediente</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
";
    }

    // line 681
    public function block_formactions($context, array $blocks = array())
    {
        // line 682
        echo "    ";
        $this->displayParentBlock("formactions", $context, $blocks);
        echo "
";
    }

    public function getTemplateName()
    {
        return "MinsalLaboratorioBundle:CRUD:SecSolicitudestudios/edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  828 => 682,  825 => 681,  804 => 662,  760 => 621,  692 => 555,  681 => 553,  677 => 552,  660 => 537,  657 => 536,  543 => 425,  468 => 353,  459 => 346,  455 => 344,  447 => 340,  445 => 339,  441 => 338,  438 => 337,  436 => 336,  411 => 313,  408 => 312,  404 => 310,  396 => 306,  394 => 305,  390 => 304,  387 => 303,  384 => 302,  382 => 301,  356 => 277,  353 => 276,  349 => 274,  341 => 270,  339 => 269,  335 => 268,  332 => 267,  329 => 266,  327 => 265,  202 => 143,  149 => 93,  79 => 29,  58 => 12,  55 => 11,  48 => 8,  45 => 7,  40 => 5,  14 => 4,);
    }
}
