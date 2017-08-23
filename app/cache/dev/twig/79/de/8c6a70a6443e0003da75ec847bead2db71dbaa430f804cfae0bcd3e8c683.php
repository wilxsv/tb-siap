<?php

/* MinsalSiapsBundle:MntEvento:edit.html.twig */
class __TwigTemplate_79de8c6a70a6443e0003da75ec847bead2db71dbaa430f804cfae0bcd3e8c683 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:edit.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["action"] = (((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) ? ("edit") : ("create"));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
";
    }

    // line 9
    public function block_javascripts($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script type=\"text/javascript\">
        var select2_options = {
            placeholder: 'Seleccionar...',
            allowClear: true,
            containerCss: {
                'width': '100%'
            }
        };

        \$(document).ready(function () {
            //Asignando los objetos
            var idAreaModEstab = \$('select[id\$=\"_idAreaModEstab\"]');
            ";
        // line 24
        echo "            var idTipoevento = \$('#";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idTipoEvento');
            var idEmpleadoMultiple = \$('#";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idEmpleadoMultiple');
            var claseEvento = \$('#";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_aplicacionEvento');
            var duracion = \$('#";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_duracion');
            var todosLosMedicos = \$('#";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_todos_los_medicos');
            var idProcedimiento = \$('#";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_idProcedimientoEstablecimiento');
            ";
        // line 31
        echo "
            initializeSelect2(claseEvento, true, false, select2_options);
            //Por defecto se pondrá la opción de clase de evento \"Citas Médicas\"
            ";
        // line 34
        if (((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "create")) {
            // line 35
            echo "                claseEvento.select2('val','med');
            ";
        }
        // line 37
        echo "
            select2_options['placeholder'] = 'seleccione tipo de evento...';
            initializeSelect2(idTipoevento, true, false, select2_options);
            /*Por defecto no aparecerá la opción \"Días Festivos\" sólo al seleccionar la clase de evento \"Citas Médicas y de Procedimientos\"*/
            \$('#'+idTipoevento.attr('id')+' option[value=\"1\"]').addClass('hidden');

            select2_options['placeholder'] = 'seleccione área de atención...';
            initializeSelect2(idAreaModEstab, true, false, select2_options);

            ";
        // line 48
        echo "
            select2_options['placeholder'] = 'seleccione médico...';
            initializeSelect2(idEmpleadoMultiple, false, false, select2_options);

            select2_options['placeholder'] = 'seleccione procedimiento...';
            initializeSelect2(idProcedimiento, true, false, select2_options);
            //Agregando la opción de \"Todos los procedimientos\"
            idProcedimiento.append(\$('<option>', {value: 'todos', text: 'Todos los procedimientos'}));

            var duracionOptions = setBootstrapDateRangePickerOptions(duracion);
            duracionOptions['locale']['format'] = 'DD/MM/YYYY hh:mm A';
            duracionOptions['autoApply']=true;
            duracion.daterangepicker(duracionOptions);


            duracion.on('apply.daterangepicker', function(ev, picker) {
                if( (picker.startDate.format('hh:mm:ss A') === '12:00:00 AM' && picker.endDate.format('hh:mm:ss A') === '12:00:00 AM') || (picker.startDate.format('hh:mm:ss A') === '12:00:00 PM' && picker.endDate.format('hh:mm:ss A') === '12:00:00 PM') ) {
                \t\t\$dateRangePicker = \$(this).data('daterangepicker');

                    var startDate = moment(picker.startDate.format('YYYY-MM-DD')+' 00:00:00', 'YYYY-MM-DD HH:mm:ss');
                    var endDate   = moment(picker.endDate.format('YYYY-MM-DD')+' 23:59:00', 'YYYY-MM-DD HH:mm:ss');

                    \$dateRangePicker.startDate = startDate;
                    \$dateRangePicker.endDate   = endDate;

                    \$dateRangePicker.updateView();
                    \$dateRangePicker.updateCalendars();
                    \$(this).val(startDate.format('DD/MM/YYYY hh:mm:ss A')+' - '+endDate.format('DD/MM/YYYY hh:mm:ss A'));
                }
            });

            //Ocultar el combo de procedimientos al inicio de la pantalla
            idProcedimiento.closest('div[id^=\"sonata-ba-field-container-";
        // line 80
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "\"]').hide();

            claseEvento.on('change', function () {
                if (\$(this).val() == 'proc') {
                    idProcedimiento.closest('div[id^=\"sonata-ba-field-container-";
        // line 84
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "\"]').show();
                    todosLosMedicos.closest('div[id^=\"sonata-ba-field-container-";
        // line 85
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_\"]').show();
                    todosLosMedicos.iCheck('enable');
                    todosLosMedicos.iCheck('uncheck');
                    idEmpleadoMultiple.closest('div[id^=\"sonata-ba-field-container-";
        // line 88
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_\"]').show();
                    idEmpleadoMultiple.select2('val', '');
                    idEmpleadoMultiple.select2(\"enable\", true);
                    idProcedimiento.select2('val', '');
                    idProcedimiento.select2(\"enable\", true);
                    idAreaModEstab.select2('val', '');
                    idTipoevento.select2('val', '');
                    //Ocultar la opción \"Días Festivos\"
                    \$('#'+idTipoevento.attr('id')+' option[value=\"1\"]').addClass('hidden');
                }
                else if (\$(this).val() == 'med') {
                    idProcedimiento.select2(\"enable\", false);
                    idProcedimiento.closest('div[id^=\"sonata-ba-field-container-";
        // line 100
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "\"]').hide();
                    todosLosMedicos.closest('div[id^=\"sonata-ba-field-container-";
        // line 101
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_\"]').show();
                    todosLosMedicos.iCheck('enable');
                    todosLosMedicos.iCheck('uncheck');
                    idEmpleadoMultiple.closest('div[id^=\"sonata-ba-field-container-";
        // line 104
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_\"]').show();
                    idEmpleadoMultiple.select2('val', '');
                    idEmpleadoMultiple.select2(\"enable\", true);
                    idAreaModEstab.select2('val', '');
                    idTipoevento.select2('val', '');
                    //Ocultar la opción \"Días Festivos\"
                    \$('#'+idTipoevento.attr('id')+' option[value=\"1\"]').addClass('hidden');
                }else{
                    idProcedimiento.closest('div[id^=\"sonata-ba-field-container-";
        // line 112
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "\"]').hide();
                    idProcedimiento.select2('val', '');
                    todosLosMedicos.closest('div[id^=\"sonata-ba-field-container-";
        // line 114
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_\"]').hide();
                    idEmpleadoMultiple.closest('div[id^=\"sonata-ba-field-container-";
        // line 115
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_\"]').hide();
                    //Mostrar la opción \"Días Festivos\"
                    \$('#'+idTipoevento.attr('id')+' option[value=\"1\"]').removeClass('hidden');
                }
            });

            idProcedimiento.on('change', function () {
                if (\$(this).val()){
                    if (\$(this).val() != 'todos'){
                        if (idAreaModEstab.select2('val')){
                            cargarMedicosPorProcedimiento();
                        }
                        idEmpleadoMultiple.select2('val', '');
                        idEmpleadoMultiple.select2(\"enable\", true);
                        todosLosMedicos.closest('div[id^=\"sonata-ba-field-container-";
        // line 129
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_\"]').show();
                        todosLosMedicos.iCheck('enable');
                        todosLosMedicos.iCheck('uncheck');
                    }
                    else{
                        idEmpleadoMultiple.select2('val', '');
                        idEmpleadoMultiple.select2(\"enable\", false);
                        todosLosMedicos.closest('div[id^=\"sonata-ba-field-container-";
        // line 136
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_\"]').show();
                        todosLosMedicos.iCheck('disable');
                        todosLosMedicos.iCheck('check');
                    }
                }
            });

            function cargarMedicosPorProcedimiento(){
                \$.ajax({
                    url: Routing.generate(\"obtener_procedimientos_por_area_medico\"),
                    async: false,
                    dataType: 'json',
                    data: {
                        'objetoRequerido': 'empleado', //médicos con distribución en ese procedimiento
                        'idProcedimientoEstablecimiento': idProcedimiento.select2('val'),
                        'idAreaModEstab': idAreaModEstab.select2('val')
                    },
                    success: function (data) {
                        select2_options['placeholder'] = 'seleccione médico...';
                        initializeSelect2(idEmpleadoMultiple, false, true, select2_options);

                        \$.each(data.resultados, function (indice, val) {
                            idEmpleadoMultiple.append(\$('<option>', {value: val.id, text: val.text}));
                        });
                    }
                });
            }

            idAreaModEstab.on('change', function () {

                if (\$(this).val()) {
                    \$.ajax({
                        url: Routing.generate(\"obtener_medicos_por_area\", {'idAreaModEstab': \$(this).val()}),
                        async: false,
                        dataType: 'json',
                        success: function (data) {
                            select2_options['placeholder'] = 'seleccione médico...';
                            initializeSelect2(idEmpleadoMultiple, false, true, select2_options);
                            \$.each(data.resultados, function (indice, val) {
                                idEmpleadoMultiple.append(\$('<option>', {value: val.id, text: val.text}));
                            });
                        }
                    });
                    if (idProcedimiento.val() && idProcedimiento.select2('val') != 'todos'){
                        cargarMedicosPorProcedimiento();
                    }
                }
                else {
                    select2_options['placeholder'] = 'seleccione médico...';
                    initializeSelect2(idEmpleadoMultiple, false, true, select2_options);
                }
            });

            ";
        // line 207
        echo "
            idTipoevento.on('change', function () {
                if (\$(this).val() == '1') {
                    idAreaModEstab.select2(\"enable\", false);
                    todosLosMedicos.iCheck('disable');
                    idEmpleadoMultiple.select2(\"enable\", false);
                    idEmpleadoMultiple.select2('val', '');
                    todosLosMedicos.iCheck('uncheck');
                    idAreaModEstab.select2('val', '');
                }
                else {
                    idAreaModEstab.select2(\"enable\", true);
                    todosLosMedicos.iCheck('enable');
                    idEmpleadoMultiple.select2(\"enable\", true);
                }
            });

            ";
        // line 242
        echo "
            todosLosMedicos.on('ifChanged', function () {
                var estado = \$(this).prop('checked');
                if (estado == true) {
                    idEmpleadoMultiple.select2(\"enable\", false);
                    idEmpleadoMultiple.select2('val', '');
                }
                else {
                    idEmpleadoMultiple.select2(\"enable\", true);
                }
            });

            ";
        // line 254
        if ((!$this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method"))) {
            // line 255
            echo "              idAreaModEstab.parent().parent().hide();
              idAreaModEstab.select2('val',";
            // line 256
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["idAreaModEstab"]) ? $context["idAreaModEstab"] : $this->getContext($context, "idAreaModEstab")), "getId", array(), "method"), "html", null, true);
            echo " );
              idAreaModEstab.change();
            ";
        }
        // line 259
        echo "

            ";
        // line 261
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method")) {
            // line 262
            echo "                idAreaModEstab.change();
                ";
            // line 263
            if (((isset($context["medicos"]) ? $context["medicos"] : $this->getContext($context, "medicos")) == null)) {
                // line 264
                echo "                    todosLosMedicos.iCheck('check');
                ";
            } else {
                // line 266
                echo "                    idEmpleadoMultiple.select2('val',";
                echo twig_escape_filter($this->env, (isset($context["medicos"]) ? $context["medicos"] : $this->getContext($context, "medicos")), "html", null, true);
                echo ");
                ";
            }
            // line 268
            echo "                ";
            if ($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getEsEventoMedico")) {
                // line 269
                echo "                    claseEvento.select2('val', 'med');
                ";
            } else {
                // line 271
                echo "                    claseEvento.select2('val', 'proc');
                ";
            }
            // line 273
            echo "                duracion.val('";
            echo twig_escape_filter($this->env, (isset($context["duracion_evento"]) ? $context["duracion_evento"] : $this->getContext($context, "duracion_evento")), "html", null, true);
            echo "');
                //No se puede cambiar la clase de evento\"
                claseEvento.select2( 'readonly', true );
            ";
        }
        // line 277
        echo "        });
    </script>
";
    }

    // line 281
    public function block_formactions($context, array $blocks = array())
    {
        // line 282
        echo "    <div class=\"well well-small form-actions\">
        ";
        // line 283
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 284
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 285
                echo "                <button type=\"submit\" class=\"btn btn-success\" name=\"btn_update\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            } else {
                // line 287
                echo "                <button type=\"submit\" class=\"btn btn-success\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            }
            // line 289
            echo "        ";
        } else {
            // line 290
            echo "            ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 291
                echo "                <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                    <i class=\"fa fa-eye\"></i>
                    ";
                // line 293
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                </button>
            ";
            }
            // line 296
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 297
                echo "                ";
                if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method")) {
                    // line 298
                    echo "                    <button type=\"submit\" class=\"btn btn-success\" name=\"btn_update_and_list\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-list\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</button>
                ";
                }
                // line 300
                echo "
                ";
                // line 301
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "delete"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "DELETE", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 302
                    echo "                   ";
                    $context["fechaActual"] = twig_date_converter($this->env);
                    // line 303
                    echo "                    ";
                    if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method") || ((isset($context["fechaActual"]) ? $context["fechaActual"] : $this->getContext($context, "fechaActual")) <= $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getFechaHoraIni", array(), "method")))) {
                        // line 304
                        echo "                      <a class=\"btn btn-danger\" href=\"";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "delete", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                        echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_delete", array(), "SonataAdminBundle"), "html", null, true);
                        echo "</a>
                    ";
                    }
                    // line 306
                    echo "                ";
                }
                // line 307
                echo "
                ";
                // line 308
                if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isAclEnabled", array(), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "acl"), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "MASTER", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 309
                    echo "                    <a class=\"btn btn-info\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "acl", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-users\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_edit_acl", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 311
                echo "            ";
            } else {
                // line 312
                echo "                ";
                if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method")) {
                    // line 313
                    echo "                    <button type=\"submit\" class=\"btn btn-success\" name=\"btn_create_and_list\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-list\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create_and_return_to_list", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</button>
                ";
                }
                // line 315
                echo "                <button class=\"btn btn-success\" type=\"submit\" name=\"btn_create_and_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create_and_create_a_new_one", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            }
            // line 317
            echo "        ";
        }
        // line 318
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:MntEvento:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  476 => 315,  386 => 284,  364 => 273,  234 => 88,  595 => 193,  589 => 192,  586 => 191,  562 => 184,  556 => 182,  506 => 103,  498 => 78,  492 => 76,  473 => 165,  458 => 160,  399 => 143,  352 => 126,  346 => 125,  328 => 117,  880 => 288,  837 => 274,  827 => 270,  823 => 268,  821 => 267,  818 => 266,  789 => 251,  758 => 243,  667 => 218,  573 => 172,  567 => 170,  520 => 177,  481 => 167,  475 => 159,  472 => 158,  466 => 156,  441 => 156,  438 => 149,  432 => 301,  429 => 300,  395 => 287,  382 => 128,  378 => 281,  367 => 120,  357 => 118,  348 => 115,  334 => 110,  286 => 6,  205 => 115,  297 => 92,  218 => 81,  940 => 351,  932 => 346,  926 => 342,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 327,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 297,  808 => 296,  787 => 294,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 259,  740 => 239,  734 => 254,  731 => 253,  728 => 252,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 224,  628 => 214,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 228,  499 => 154,  488 => 172,  389 => 285,  223 => 46,  14 => 2,  306 => 95,  303 => 91,  300 => 112,  292 => 86,  280 => 87,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 216,  599 => 194,  580 => 194,  574 => 230,  559 => 183,  526 => 179,  497 => 173,  485 => 318,  463 => 117,  447 => 152,  404 => 290,  401 => 289,  391 => 76,  369 => 129,  333 => 132,  329 => 65,  307 => 242,  287 => 58,  195 => 54,  178 => 46,  956 => 271,  953 => 270,  946 => 302,  942 => 300,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 301,  820 => 243,  816 => 265,  807 => 259,  805 => 295,  802 => 235,  791 => 262,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 225,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 231,  647 => 230,  644 => 190,  632 => 187,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 224,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 307,  448 => 306,  424 => 98,  418 => 112,  410 => 113,  376 => 153,  373 => 102,  340 => 122,  326 => 256,  261 => 76,  118 => 56,  200 => 64,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 297,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 276,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 304,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 255,  796 => 254,  793 => 182,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 265,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 231,  710 => 149,  707 => 208,  699 => 142,  697 => 141,  696 => 204,  695 => 230,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 123,  649 => 122,  643 => 227,  640 => 226,  638 => 118,  617 => 112,  614 => 201,  598 => 107,  593 => 201,  576 => 101,  564 => 162,  557 => 209,  550 => 94,  527 => 91,  515 => 305,  512 => 84,  509 => 228,  503 => 81,  496 => 79,  493 => 155,  478 => 143,  467 => 312,  456 => 309,  450 => 114,  414 => 148,  408 => 91,  388 => 138,  371 => 72,  363 => 32,  350 => 26,  342 => 123,  335 => 66,  316 => 16,  290 => 110,  276 => 2,  266 => 83,  263 => 133,  255 => 95,  245 => 122,  207 => 93,  194 => 106,  184 => 55,  76 => 70,  810 => 238,  804 => 260,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 248,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 241,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 202,  685 => 227,  682 => 226,  672 => 223,  670 => 222,  665 => 196,  648 => 219,  627 => 206,  622 => 204,  619 => 212,  616 => 202,  613 => 210,  610 => 209,  608 => 197,  605 => 207,  596 => 106,  592 => 203,  587 => 197,  585 => 196,  582 => 190,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 198,  542 => 186,  533 => 186,  531 => 95,  507 => 165,  505 => 180,  502 => 175,  477 => 164,  471 => 164,  465 => 161,  454 => 308,  446 => 156,  443 => 155,  431 => 151,  428 => 100,  425 => 152,  422 => 150,  412 => 147,  406 => 111,  390 => 139,  383 => 135,  377 => 73,  375 => 124,  372 => 277,  370 => 121,  359 => 70,  356 => 269,  353 => 268,  349 => 119,  336 => 261,  332 => 259,  330 => 103,  318 => 105,  313 => 96,  291 => 80,  190 => 105,  321 => 254,  295 => 201,  274 => 87,  242 => 121,  236 => 81,  70 => 81,  170 => 85,  288 => 207,  284 => 192,  279 => 82,  275 => 56,  256 => 74,  250 => 126,  237 => 89,  232 => 136,  222 => 129,  191 => 88,  153 => 72,  150 => 84,  563 => 188,  560 => 187,  558 => 186,  553 => 184,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 173,  525 => 172,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  491 => 157,  487 => 156,  460 => 143,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 297,  415 => 121,  411 => 293,  405 => 118,  403 => 117,  380 => 107,  366 => 106,  354 => 101,  331 => 96,  325 => 94,  320 => 92,  317 => 91,  311 => 87,  308 => 86,  304 => 85,  272 => 81,  267 => 130,  249 => 78,  216 => 159,  155 => 35,  146 => 49,  126 => 66,  188 => 54,  181 => 51,  161 => 54,  110 => 58,  124 => 113,  692 => 399,  683 => 282,  678 => 279,  676 => 265,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 215,  641 => 189,  635 => 226,  631 => 218,  625 => 361,  615 => 354,  607 => 208,  597 => 177,  590 => 202,  583 => 287,  579 => 284,  577 => 188,  575 => 328,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 98,  529 => 191,  524 => 90,  516 => 294,  510 => 78,  504 => 90,  500 => 88,  495 => 158,  490 => 154,  486 => 165,  482 => 317,  470 => 313,  464 => 311,  459 => 116,  452 => 158,  434 => 302,  421 => 90,  417 => 296,  400 => 116,  385 => 129,  361 => 207,  344 => 113,  339 => 116,  324 => 179,  310 => 204,  302 => 93,  296 => 151,  282 => 106,  259 => 81,  244 => 83,  231 => 67,  226 => 69,  215 => 63,  186 => 64,  152 => 51,  114 => 80,  104 => 28,  358 => 103,  351 => 116,  347 => 266,  343 => 264,  338 => 262,  327 => 108,  323 => 255,  319 => 124,  315 => 98,  301 => 80,  299 => 202,  293 => 111,  289 => 82,  281 => 57,  277 => 88,  271 => 79,  265 => 100,  262 => 184,  260 => 128,  257 => 53,  251 => 182,  248 => 71,  239 => 120,  228 => 103,  225 => 65,  213 => 69,  211 => 156,  197 => 30,  174 => 59,  148 => 91,  134 => 69,  127 => 82,  20 => 1,  270 => 85,  253 => 78,  233 => 118,  212 => 158,  210 => 63,  206 => 109,  202 => 108,  198 => 107,  192 => 66,  185 => 104,  180 => 115,  175 => 100,  172 => 81,  167 => 44,  165 => 83,  160 => 88,  137 => 2,  113 => 80,  100 => 26,  90 => 37,  81 => 25,  65 => 22,  129 => 83,  97 => 92,  77 => 83,  34 => 4,  53 => 11,  84 => 19,  58 => 10,  23 => 4,  480 => 75,  474 => 150,  469 => 157,  461 => 70,  457 => 124,  453 => 151,  444 => 151,  440 => 304,  437 => 303,  435 => 148,  430 => 153,  427 => 143,  423 => 298,  413 => 241,  409 => 146,  407 => 291,  402 => 107,  398 => 115,  393 => 112,  387 => 110,  384 => 283,  381 => 282,  379 => 154,  374 => 36,  368 => 34,  365 => 119,  362 => 148,  360 => 271,  355 => 27,  341 => 263,  337 => 97,  322 => 93,  314 => 88,  312 => 97,  309 => 113,  305 => 101,  298 => 91,  294 => 100,  285 => 88,  283 => 5,  278 => 110,  268 => 101,  264 => 104,  258 => 75,  252 => 79,  247 => 181,  241 => 75,  229 => 86,  220 => 99,  214 => 112,  177 => 52,  169 => 99,  140 => 47,  132 => 84,  128 => 101,  107 => 29,  61 => 13,  273 => 190,  269 => 189,  254 => 126,  243 => 76,  240 => 72,  238 => 68,  235 => 73,  230 => 167,  227 => 116,  224 => 163,  221 => 162,  219 => 113,  217 => 86,  208 => 155,  204 => 61,  179 => 101,  159 => 50,  143 => 80,  135 => 37,  119 => 99,  102 => 77,  71 => 26,  67 => 25,  63 => 59,  59 => 57,  28 => 3,  94 => 35,  89 => 71,  85 => 27,  75 => 27,  68 => 62,  56 => 12,  87 => 31,  201 => 114,  196 => 112,  183 => 55,  171 => 63,  166 => 98,  163 => 42,  158 => 81,  156 => 75,  151 => 76,  142 => 89,  138 => 87,  136 => 29,  121 => 82,  117 => 81,  105 => 78,  91 => 23,  62 => 24,  49 => 20,  25 => 3,  21 => 1,  31 => 4,  38 => 7,  26 => 5,  24 => 3,  19 => 1,  93 => 73,  88 => 20,  78 => 24,  46 => 7,  44 => 8,  27 => 3,  79 => 28,  72 => 23,  69 => 23,  47 => 8,  40 => 4,  37 => 42,  22 => 53,  246 => 71,  157 => 94,  145 => 73,  139 => 70,  131 => 68,  123 => 83,  120 => 42,  115 => 70,  111 => 32,  108 => 54,  101 => 93,  98 => 37,  96 => 31,  83 => 29,  74 => 16,  66 => 15,  55 => 9,  52 => 13,  50 => 9,  43 => 6,  41 => 7,  35 => 6,  32 => 5,  29 => 2,  209 => 157,  203 => 32,  199 => 59,  193 => 57,  189 => 65,  187 => 104,  182 => 103,  176 => 85,  173 => 48,  168 => 50,  164 => 53,  162 => 52,  154 => 85,  149 => 34,  147 => 101,  144 => 100,  141 => 71,  133 => 28,  130 => 40,  125 => 78,  122 => 77,  116 => 58,  112 => 69,  109 => 48,  106 => 28,  103 => 27,  99 => 24,  95 => 24,  92 => 34,  86 => 70,  82 => 68,  80 => 24,  73 => 82,  64 => 26,  60 => 20,  57 => 56,  54 => 73,  51 => 8,  48 => 9,  45 => 10,  42 => 9,  39 => 5,  36 => 7,  33 => 6,  30 => 5,);
    }
}
