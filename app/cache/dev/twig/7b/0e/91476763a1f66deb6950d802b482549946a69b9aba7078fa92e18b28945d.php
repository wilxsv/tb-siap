<?php

/* MinsalSeguimientoBundle:SecIngreso:edit.html.twig */
class __TwigTemplate_7b0e91476763a1f66deb6950d802b482549946a69b9aba7078fa92e18b28945d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'form' => array($this, 'block_form'),
            'sonata_pre_fieldsets' => array($this, 'block_sonata_pre_fieldsets'),
            'sonata_tab_content' => array($this, 'block_sonata_tab_content'),
            'notice' => array($this, 'block_notice'),
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

    // line 4
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalseguimiento/css/SecIngreso/edit.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
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
    \$(document).ready(function() {
        ";
        // line 13
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "validate_ingreso_hospitalario"), "method") == false)) {
            // line 14
            echo "            \$('select[id\$=\"_idModalidadIngreso\"]').prepend('<option/>').val(function() {
                return \$('[selected]', this).val();
            });

            \$('select[id\$=\"_idModalidadIngreso\"]').select2({
                placeholder: 'Seleccione la modalidad del ingreso...',
                allowClear: true,
                width: '100%'
            });
        ";
        }
        // line 24
        echo "
        \$('select[id\$=\"_idEstablecimientoReferencia\"]').select2({
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });



        \$('select[id\$=\"_idProcedenciaIngreso\"]').prepend('<option/>').val(function() {
            return \$('[selected]', this).val();
        });

        \$('select[id\$=\"_idProcedenciaIngreso\"]').select2({
            placeholder: 'Seleccione la procedencia del ingreso...',
            allowClear: true,
            width: '100%'
        });

        \$('select[id\$=\"_idCircunstanciaIngreso\"]').prepend('<option/>').val(function() {
            return \$('[selected]', this).val();
        });
        \$('select[id\$=\"_idCircunstanciaIngreso\"]').select2({
            placeholder: 'Seleccione la circunstancia del ingreso...',
            allowClear: true,
            width: '100%'
        });

        \$('select[id\$=\"_idAtenAreaModEstab\"]').prepend('<option/>').val(function() {
            return \$('[selected]', this).val();
        });
        \$('select[id\$=\"_idAtenAreaModEstab\"]').select2({
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        \$('select[id\$=\"_hora_hour\"]').prepend('<option/>').val(function() {
            return \$('[selected]', this).val();
        });
        \$('select[id\$=\"_hora_hour\"]').select2({
            placeholder: 'Hora...',
            allowClear: true
        });

        \$('select[id\$=\"_hora_minute\"]').prepend('<option/>').val(function() {
            return \$('[selected]', this).val();
        });
        \$('select[id\$=\"_hora_minute\"]').select2({
            placeholder: 'Minutos...',
            allowClear: true
        });

        \$('select[id\$=\"_idAmbienteIngreso\"]').select2({
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        \$('select[id\$=\"_idTipoAccidente\"]').select2({
            placeholder: 'Seleccione si existiera...',
            allowClear: true,
            width: '100%'

        });

        \$('select[id\$=\"_idEmpleado\"]').select2({
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        /*COLOCAR LOS DATEPICKER Y LOS IMPUT MASK A LOS CAMPOS DE FECHA*/

        if (\$('input[id\$=\"_fecha\"]').val() == '')
            \$('input[id\$=\"_fecha\"]').mask(\"99/99/9999\").datepicker(\"setDate\", \"0\");
        else
            \$('input[id\$=\"_fecha\"]').mask(\"99/99/9999\");
        \$('input[id\$=\"_fechaProbableParto\"]').datepicker({
            minDate: \"-0m\",
            maxDate: \"+9m\"
        }).mask(\"99/99/9999\");



        /*OCULTAR LO RELACIONADO A LO OBSTETRICO*/
        \$('div[id\$=\"_embarazada\"]').hide();
        \$('div[id\$=\"_fechaProbableParto\"]').hide();
        \$('div[id\$=\"_semanasAmenorrea\"]').hide();

        /*VALIDAR SI ES MUJER Y SI ESTA EMBARAZADA*/
        if (\$(\"#sexo\").val() == 2 && \$(\"#embarazo\").val() == '1')
            \$('div[id\$=\"_embarazada\"]').show();

        /*AL DAR CLIC EN EMBARAZADA */
        //\$('input:checkbox[name*=\"embarazada\"]').click(function() {
        //if (

        if (\$('input:checkbox[name*=\"embarazada\"]').prop('checked')) {
            \$('div[id\$=\"_fechaProbableParto\"]').show();
            \$('div[id\$=\"_semanasAmenorrea\"]').show();
        } else {
            \$('div[id\$=\"_fechaProbableParto\"]').hide();
            \$('div[id\$=\"_semanasAmenorrea\"]').hide();
        }
        \$('input:checkbox[name*=\"embarazada\"]').on('ifChecked', function(event) {
            \$('div[id\$=\"_fechaProbableParto\"]').show();
            \$('div[id\$=\"_semanasAmenorrea\"]').show();
        });

        \$('input:checkbox[name*=\"embarazada\"]').on('ifUnchecked', function(event) {
            \$('div[id\$=\"_fechaProbableParto\"]').hide();
            \$('div[id\$=\"_semanasAmenorrea\"]').hide();
            \$('input[id\$=\"_fechaProbableParto\"]').val('');
            \$('input[id\$=\"_semanasAmenorrea\"]').val('');
        });
        //});
        \$('select[id\$=\"_idAtenAreaModEstab\"]').on(\"change\", function(e) {
            \$('select[id\$=\"idAmbienteIngreso\"]').children().remove();

            \$('select[id\$=\"idAmbienteIngreso\"]').prepend('<option/>').val(function() {
                return \$('[selected]', this).val();
            });
            \$('select[id\$=\"idAmbienteIngreso\"]').select2({
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            });

            if (e.val) {
                \$.getJSON(Routing.generate('get_servicios_hospitalarios') + '?idAtenAreaModEstab=' + e.val, function(data) {
                    \$.each(data.especialidades, function(indice, aux) {
                        if (aux.nombreAmbiente != \"\") {
                            \$('select[id\$=\"idAmbienteIngreso\"]').append(\$('<option>', {value: aux.id, text: aux.nombreAmbiente}));
                        }
                    });

                    \$('select[id\$=\"idAmbienteIngreso\"]').append(\$('<option>', {value: 'n', text: '-------------------', disabled: true}));
                    \$.getJSON(Routing.generate('get_servicios_hospitalarios_otros') + '?idAtenAreaModEstab=' + e.val, function(data) {
                        \$.each(data.especialidades, function(indice, aux) {
                            if (aux.nombreAmbiente != \"\") {
                                \$('select[id\$=\"idAmbienteIngreso\"]').append(\$('<option>', {value: aux.id, text: aux.nombreAmbiente}));
                            }
                        });
                    });
                    \$('select[id\$=\"idAmbienteIngreso\"]').select2('readonly', false);
                });
            } else {
                \$('select[id\$=\"idAmbienteIngreso\"]').select2('readonly', true);
            }
        });

        /*CARGAR LAS ESPECIALIDADES DE HOSPITALIZACION*/

        if (\$('select[id\$=\"_idAtenAreaModEstab\"]').select2('val') == '') {
            \$.getJSON(Routing.generate('get_especialidad_ingresos'),
                    function(data) {
                        \$('select[id\$=\"_idAtenAreaModEstab\"]').children().remove();
                        \$('select[id\$=\"_idAtenAreaModEstab\"]').append('<option></option>');
                        \$.each(data.especialidades, function(indice, aux) {
                            \$('select[id\$=\"_idAtenAreaModEstab\"]').append(\$('<option>', {value: aux.id, text: aux.nombre}));
                        });
                        \$('select[id\$=\"_idAtenAreaModEstab\"]').select2('readonly', false);
                        \$('select[id\$=\"_idProcedenciaIngreso\"]').focus();
                    });
        } else {

            \$.getJSON(Routing.generate('get_especialidad_ingresos'),
                    function(data) {
                        var aux2 = \$('select[id\$=\"_idAtenAreaModEstab\"]').select2('val');
                        \$('select[id\$=\"_idAtenAreaModEstab\"]').children().remove();
                        \$('select[id\$=\"_idAtenAreaModEstab\"]').append('<option></option>');
                        \$.each(data.especialidades, function(indice, aux) {
                            \$('select[id\$=\"_idAtenAreaModEstab\"]').append(\$('<option>', {value: aux.id, text: aux.nombre}));
                        });
                        \$('select[id\$=\"_idAtenAreaModEstab\"]').select2('val', aux2);
                        \$('select[id\$=\"_idAtenAreaModEstab\"]').select2('readonly', false);
                        \$('select[id\$=\"_idProcedenciaIngreso\"]').focus();
                    });
        }

        if (\$('select[id\$=\"_idAtenAreaModEstab\"]').select2('val') != '') {
            var aux2 = \$('select[id\$=\"idAmbienteIngreso\"]').select2('val');

            \$('select[id\$=\"_idAmbienteIngreso\"]').children().remove();
            \$('select[id\$=\"_idAmbienteIngreso\"]').prepend('<option/>').val(function() {
                return \$('[selected]', this).val();
            });
            \$('select[id\$=\"_idAmbienteIngreso\"]').select2({
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            });
            var especialidad = \$('select[id\$=\"_idAtenAreaModEstab\"]').select2('val');
            \$.getJSON(Routing.generate('get_servicios_hospitalarios') + '?idAtenAreaModEstab=' + especialidad, function(data) {
                \$.each(data.especialidades, function(indice, aux) {
                    if (aux.nombreAmbiente != \"\") {
                        \$('select[id\$=\"idAmbienteIngreso\"]').append(\$('<option>', {value: aux.id, text: aux.nombreAmbiente}));
                    }
                });

                \$('select[id\$=\"idAmbienteIngreso\"]').append(\$('<option>', {value: 'n', text: '-------------------', disabled: true}));
                \$.getJSON(Routing.generate('get_servicios_hospitalarios_otros') + '?idAtenAreaModEstab=' + especialidad, function(data) {
                    \$.each(data.especialidades, function(indice, aux) {
                        if (aux.nombreAmbiente != \"\") {
                            \$('select[id\$=\"idAmbienteIngreso\"]').append(\$('<option>', {value: aux.id, text: aux.nombreAmbiente}));
                        }
                    });
                });
                \$('select[id\$=\"idAmbienteIngreso\"]').select2('readonly', false);
                \$('select[id\$=\"idAmbienteIngreso\"]').select2('val', aux2);
            });
        } else {
            \$('select[id\$=\"idAmbienteIngreso\"]').children().remove();

            \$('select[id\$=\"idAmbienteIngreso\"]').prepend('<option/>').val(function() {
                return \$('[selected]', this).val();
            });
            \$('select[id\$=\"idAmbienteIngreso\"]').select2({
                placeholder: 'Seleccionar...',
                allowClear: true
            });

            \$('select[id\$=\"idAmbienteIngreso\"]').select2('readonly', true);
        }
        /*COLOCAR HORA ACTUAL DEL SISTEMA*/
        if (\$('select[id\$=\"_hora_hour\"]').select2('val') == '') {
            var dia = new Date();
            \$('select[id\$=\"_hora_hour\"]').select2('val',dia.getHours());
            \$('select[id\$=\"_hora_minute\"]').select2('val',dia.getMinutes());
        }
    });

    </script>
";
    }

    // line 262
    public function block_form($context, array $blocks = array())
    {
        // line 263
        echo "    ";
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.top", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

    ";
        // line 265
        $context["url"] = (((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) ? ("edit") : ("create"));
        // line 266
        echo "
    ";
        // line 267
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url"))), "method"))) {
            // line 268
            echo "        <div>
            ";
            // line 269
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        </div>
    ";
        } else {
            // line 272
            echo "        ";
            $this->env->loadTemplate("MinsalSiapsBundle:MntPacienteAdmin:identificacion_paciente.html.twig")->display($context);
            // line 273
            echo "
        ";
            // line 274
            if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method"))) {
                // line 275
                echo "            <a style=\"position:relative;float:right;margin-bottom:20px;\" class=\"btn btn-info\" href=\"";
                echo $this->env->getExtension('routing')->getPath("admin_minsal_siaps_mntpaciente_list");
                echo "\">
                <span class=\"glyphicon glyphicon-list\"></span> Buscar Otro Paciente
            </a>
        ";
            }
            // line 279
            echo "
        <input id=\"sexo\" type=\"hidden\" value=\"";
            // line 280
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "getIdSexo", array(), "method"), "getId", array(), "method"), "html", null, true);
            echo "\"/>
        <input id=\"embarazo\" type=\"hidden\" value=\"";
            // line 281
            echo twig_escape_filter($this->env, (isset($context["embarazo"]) ? $context["embarazo"] : $this->getContext($context, "embarazo")), "html", null, true);
            echo "\"/>

        <form
            id=\"form_ingreso\"
            ";
            // line 285
            if (($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "form_type"), "method") == "horizontal")) {
                echo "class=\"form-horizontal\"";
            }
            // line 286
            echo "            role=\"form\"
            action=\"";
            // line 287
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), 1 => array("id_paciente" => $this->getAttribute((isset($context["datos"]) ? $context["datos"] : $this->getContext($context, "datos")), "getId"), "id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
            echo "
            method=\"POST\"
            ";
            // line 289
            if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
                echo "novalidate=\"novalidate\"";
            }
            // line 290
            echo "            >

            ";
            // line 292
            $this->displayBlock('sonata_pre_fieldsets', $context, $blocks);
            // line 295
            echo "
                ";
            // line 296
            $this->displayBlock('sonata_tab_content', $context, $blocks);
            // line 400
            echo "
                ";
            // line 401
            $this->displayBlock('sonata_post_fieldsets', $context, $blocks);
            // line 404
            echo "
            ";
            // line 405
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "

            ";
            // line 407
            $this->displayBlock('formactions', $context, $blocks);
            // line 412
            echo "        </form>
    ";
        }
    }

    // line 292
    public function block_sonata_pre_fieldsets($context, array $blocks = array())
    {
        // line 293
        echo "                <div class=\"row\">
                ";
    }

    // line 296
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 297
        echo "                    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formgroups"));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["name"] => $context["form_group"]) {
            // line 298
            echo "                        <div class=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class"), "col-md-12")) : ("col-md-12")), "html", null, true);
            echo "\">
                            <div class=\"box box-success\">
                                <div class=\"box-header\">
                                    <h4 class=\"box-title\">

                                    </h4>
                                    <br />

                                    ";
            // line 306
            $this->displayBlock('notice', $context, $blocks);
            // line 309
            echo "                                    ";
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
                // line 310
                echo "                                        <div class=\"alert alert-danger alert-dismissable\">
                                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                            ";
                // line 312
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "
                                        </div>
                                    ";
            }
            // line 315
            echo "                                </div>

                                <div class=\"box-body\">
                                    <div class=\"sonata-ba-collapsed-fields\">
                                        ";
            // line 319
            if (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description") != false)) {
                // line 320
                echo "                                            <p>";
                echo $this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description");
                echo "</p>
                                        ";
            }
            // line 322
            echo "                                        <center>
                                            <table class=\"dat_ingreso\">
                                                <tr class=\"dat_ingreso_sec\">
                                                    <td colspan=\"4\">EN CASO DE REFERENCIA</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%' colspan=\"4\">";
            // line 328
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idEstablecimientoReferencia"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%' colspan=\"4\">";
            // line 331
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "motivoReferencia"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <!-- BLOQUE DE INGRESO -->
                                                <tr class=\"dat_ingreso_sec\">
                                                    <td colspan=\"4\">DATOS DE INGRESO</td>
                                                </tr>
                                                ";
            // line 337
            if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "validate_ingreso_hospitalario"), "method") == false)) {
                // line 338
                echo "                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
                // line 339
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idModalidadIngreso"), array(), "array"), 'row');
                echo "</td>

                                                </tr>
                                                ";
            }
            // line 343
            echo "                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 344
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idProcedenciaIngreso"), array(), "array"), 'row');
            echo "</td>
                                                    <td >";
            // line 345
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idCircunstanciaIngreso"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 348
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "fecha"), array(), "array"), 'row');
            echo "</td>
                                                    <td >";
            // line 349
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "hora"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 352
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idAtenAreaModEstab"), array(), "array"), 'row');
            echo "</td>
                                                    <td >";
            // line 353
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idAmbienteIngreso"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 356
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "embarazada"), array(), "array"), 'row');
            echo "</td>
                                                    <td ></td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 360
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "semanasAmenorrea"), array(), "array"), 'row');
            echo "</td>
                                                    <td >";
            // line 361
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "fechaProbableParto"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%' colspan=4>";
            // line 364
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "diagnostico"), array(), "array"), 'row');
            echo "</td>

                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 368
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idTipoAccidente"), array(), "array"), 'row');
            echo "</td>
                                                    <td >";
            // line 369
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idEmpleado"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'>";
            // line 372
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "tarjetasEntregadas"), array(), "array"), 'row');
            echo "</td>
                                                    <td >";
            // line 373
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "responsableTarjeta"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_ingreso_content\">
                                                    <td width='50%'><div class=\"control-group\">
                                                            <label class=\" control-label\">Responsable de elaborar el ingreso en ESDOMED:</label>
                                                            <div class=\"controls sonata-ba-field sonata-ba-field-standard-natural \">
                                                                <strong>";
            // line 379
            echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "firstname") . $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "lastname")), "html", null, true);
            echo "</strong>
                                                            </div>
                                                    </td>
                                                    <td >
                                                        <div class=\"control-group\">
                                                            <label class=\" control-label\"> Fecha y hora de elaboración: </label>
                                                            <div class=\"controls sonata-ba-field sonata-ba-field-standard-natural \">
                                                                <strong>";
            // line 386
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d-M-Y H:i"), "html", null, true);
            echo "</strong>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </center>
                                    </div>
                                </div>
                                ";
            // line 396
            echo "                            </div>
                        </div>
                    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['form_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 399
        echo "                ";
    }

    // line 306
    public function block_notice($context, array $blocks = array())
    {
        // line 307
        echo "                                        ";
        $this->env->loadTemplate("SonataCoreBundle:FlashMessage:render.html.twig")->display($context);
        // line 308
        echo "                                    ";
    }

    // line 401
    public function block_sonata_post_fieldsets($context, array $blocks = array())
    {
        // line 402
        echo "                </div>
            ";
    }

    // line 407
    public function block_formactions($context, array $blocks = array())
    {
        // line 408
        echo "                <div class=\"well well-small form-actions\">
                    <input type=\"submit\" class=\"btn btn-primary\" name=\"btn_create_and_list\" value=\"Guardar\"/>
                </div>
            ";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecIngreso:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  664 => 408,  623 => 396,  494 => 328,  462 => 310,  445 => 298,  419 => 293,  639 => 399,  611 => 386,  538 => 349,  646 => 307,  642 => 286,  544 => 352,  541 => 272,  517 => 301,  797 => 489,  752 => 459,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 224,  519 => 306,  416 => 292,  1082 => 552,  1076 => 550,  1072 => 548,  1069 => 547,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 450,  842 => 443,  836 => 440,  824 => 435,  781 => 416,  775 => 413,  762 => 406,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 388,  708 => 381,  703 => 378,  674 => 366,  659 => 196,  636 => 350,  604 => 329,  581 => 330,  568 => 315,  539 => 322,  534 => 348,  530 => 297,  521 => 343,  489 => 208,  483 => 206,  394 => 234,  396 => 206,  345 => 189,  476 => 248,  386 => 284,  364 => 219,  234 => 78,  595 => 326,  589 => 161,  586 => 322,  562 => 144,  556 => 274,  506 => 103,  498 => 292,  492 => 274,  473 => 277,  458 => 266,  399 => 209,  352 => 279,  346 => 125,  328 => 179,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 218,  573 => 328,  567 => 347,  520 => 270,  481 => 280,  475 => 275,  472 => 315,  466 => 312,  441 => 346,  438 => 224,  432 => 260,  429 => 222,  395 => 400,  382 => 128,  378 => 231,  367 => 120,  357 => 222,  348 => 190,  334 => 110,  286 => 137,  205 => 106,  297 => 79,  218 => 127,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 419,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 302,  687 => 301,  671 => 262,  669 => 219,  653 => 401,  634 => 182,  628 => 372,  621 => 220,  609 => 169,  602 => 206,  591 => 280,  571 => 364,  499 => 268,  488 => 273,  389 => 114,  223 => 114,  14 => 2,  306 => 117,  303 => 161,  300 => 115,  292 => 86,  280 => 159,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 379,  599 => 327,  580 => 277,  574 => 152,  559 => 311,  526 => 309,  497 => 173,  485 => 283,  463 => 271,  447 => 152,  404 => 242,  401 => 119,  391 => 222,  369 => 228,  333 => 95,  329 => 93,  307 => 85,  287 => 75,  195 => 110,  178 => 123,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 425,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 209,  700 => 205,  679 => 201,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 189,  647 => 355,  644 => 190,  632 => 349,  629 => 186,  626 => 221,  603 => 362,  600 => 178,  594 => 281,  588 => 372,  584 => 158,  570 => 149,  561 => 360,  554 => 356,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 279,  468 => 163,  451 => 307,  448 => 306,  424 => 296,  418 => 112,  410 => 412,  376 => 109,  373 => 287,  340 => 200,  326 => 212,  261 => 149,  118 => 53,  200 => 117,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 543,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 536,  1036 => 534,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 488,  785 => 486,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 437,  710 => 149,  707 => 208,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 134,  675 => 199,  662 => 217,  658 => 124,  654 => 357,  649 => 308,  643 => 306,  640 => 226,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 162,  576 => 101,  564 => 162,  557 => 310,  550 => 94,  527 => 296,  515 => 305,  512 => 299,  509 => 337,  503 => 269,  496 => 282,  493 => 155,  478 => 319,  467 => 243,  456 => 270,  450 => 114,  414 => 214,  408 => 407,  388 => 292,  371 => 216,  363 => 226,  350 => 191,  342 => 274,  335 => 182,  316 => 16,  290 => 154,  276 => 102,  266 => 136,  263 => 149,  255 => 135,  245 => 122,  207 => 107,  194 => 112,  184 => 95,  76 => 51,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 399,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 372,  685 => 413,  682 => 202,  672 => 223,  670 => 365,  665 => 362,  648 => 219,  627 => 206,  622 => 369,  619 => 212,  616 => 202,  613 => 170,  610 => 332,  608 => 282,  605 => 207,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 369,  578 => 368,  572 => 204,  566 => 324,  547 => 93,  545 => 228,  542 => 227,  533 => 138,  531 => 95,  507 => 287,  505 => 214,  502 => 278,  477 => 164,  471 => 164,  465 => 265,  454 => 269,  446 => 156,  443 => 264,  431 => 251,  428 => 250,  425 => 247,  422 => 338,  412 => 147,  406 => 111,  390 => 295,  383 => 112,  377 => 201,  375 => 230,  372 => 199,  370 => 286,  359 => 281,  356 => 193,  353 => 192,  349 => 220,  336 => 272,  332 => 215,  330 => 269,  318 => 90,  313 => 208,  291 => 141,  190 => 98,  321 => 254,  295 => 164,  274 => 71,  242 => 153,  236 => 177,  70 => 26,  170 => 95,  288 => 197,  284 => 89,  279 => 134,  275 => 157,  256 => 132,  250 => 66,  237 => 133,  232 => 136,  222 => 129,  191 => 104,  153 => 80,  150 => 35,  563 => 188,  560 => 275,  558 => 322,  553 => 309,  549 => 182,  543 => 179,  537 => 176,  532 => 223,  528 => 345,  525 => 311,  523 => 171,  518 => 292,  514 => 339,  511 => 338,  508 => 281,  501 => 294,  491 => 288,  487 => 156,  460 => 240,  455 => 141,  449 => 267,  442 => 259,  439 => 133,  436 => 183,  433 => 130,  426 => 221,  420 => 220,  415 => 121,  411 => 213,  405 => 211,  403 => 405,  380 => 289,  366 => 285,  354 => 102,  331 => 180,  325 => 267,  320 => 265,  317 => 209,  311 => 262,  308 => 173,  304 => 205,  272 => 81,  267 => 148,  249 => 142,  216 => 56,  155 => 82,  146 => 79,  126 => 71,  188 => 54,  181 => 90,  161 => 84,  110 => 58,  124 => 82,  692 => 373,  683 => 282,  678 => 279,  676 => 367,  666 => 126,  661 => 407,  656 => 402,  652 => 376,  645 => 215,  641 => 352,  635 => 376,  631 => 218,  625 => 284,  615 => 335,  607 => 363,  597 => 163,  590 => 202,  583 => 278,  579 => 353,  577 => 276,  575 => 352,  569 => 213,  565 => 361,  555 => 185,  548 => 353,  540 => 99,  536 => 139,  529 => 222,  524 => 344,  516 => 286,  510 => 78,  504 => 295,  500 => 331,  495 => 210,  490 => 154,  486 => 322,  482 => 317,  470 => 244,  464 => 242,  459 => 309,  452 => 191,  434 => 252,  421 => 90,  417 => 219,  400 => 404,  385 => 203,  361 => 207,  344 => 275,  339 => 273,  324 => 102,  310 => 86,  302 => 93,  296 => 200,  282 => 143,  259 => 151,  244 => 141,  231 => 123,  226 => 115,  215 => 63,  186 => 140,  152 => 54,  114 => 40,  104 => 48,  358 => 209,  351 => 101,  347 => 183,  343 => 188,  338 => 217,  327 => 268,  323 => 172,  319 => 176,  315 => 175,  301 => 204,  299 => 201,  293 => 177,  289 => 162,  281 => 74,  277 => 158,  271 => 70,  265 => 150,  262 => 68,  260 => 148,  257 => 126,  251 => 123,  248 => 142,  239 => 131,  228 => 75,  225 => 125,  213 => 127,  211 => 125,  197 => 101,  174 => 59,  148 => 92,  134 => 29,  127 => 56,  20 => 1,  270 => 146,  253 => 124,  233 => 117,  212 => 109,  210 => 126,  206 => 109,  202 => 114,  198 => 104,  192 => 98,  185 => 100,  180 => 105,  175 => 47,  172 => 59,  167 => 101,  165 => 40,  160 => 56,  137 => 61,  113 => 50,  100 => 60,  90 => 66,  81 => 53,  65 => 23,  129 => 71,  97 => 56,  77 => 55,  34 => 3,  53 => 10,  84 => 37,  58 => 12,  23 => 2,  480 => 320,  474 => 274,  469 => 271,  461 => 70,  457 => 306,  453 => 236,  444 => 185,  440 => 225,  437 => 244,  435 => 223,  430 => 153,  427 => 297,  423 => 256,  413 => 237,  409 => 327,  407 => 169,  402 => 210,  398 => 401,  393 => 296,  387 => 113,  384 => 290,  381 => 236,  379 => 110,  374 => 200,  368 => 197,  365 => 119,  362 => 195,  360 => 223,  355 => 280,  341 => 218,  337 => 180,  322 => 266,  314 => 263,  312 => 174,  309 => 118,  305 => 204,  298 => 165,  294 => 142,  285 => 152,  283 => 160,  278 => 142,  268 => 101,  264 => 147,  258 => 140,  252 => 143,  247 => 133,  241 => 62,  229 => 129,  220 => 123,  214 => 120,  177 => 93,  169 => 96,  140 => 73,  132 => 74,  128 => 63,  107 => 61,  61 => 14,  273 => 130,  269 => 129,  254 => 86,  243 => 134,  240 => 146,  238 => 61,  235 => 118,  230 => 116,  227 => 57,  224 => 74,  221 => 119,  219 => 60,  217 => 111,  208 => 117,  204 => 63,  179 => 98,  159 => 99,  143 => 82,  135 => 71,  119 => 67,  102 => 1,  71 => 57,  67 => 56,  63 => 55,  59 => 13,  28 => 7,  94 => 35,  89 => 24,  85 => 32,  75 => 58,  68 => 42,  56 => 53,  87 => 61,  201 => 151,  196 => 147,  183 => 104,  171 => 83,  166 => 107,  163 => 93,  158 => 83,  156 => 37,  151 => 79,  142 => 71,  138 => 69,  136 => 102,  121 => 54,  117 => 65,  105 => 2,  91 => 53,  62 => 20,  49 => 9,  25 => 5,  21 => 2,  31 => 2,  38 => 5,  26 => 6,  24 => 3,  19 => 1,  93 => 35,  88 => 52,  78 => 52,  46 => 13,  44 => 8,  27 => 6,  79 => 59,  72 => 44,  69 => 49,  47 => 20,  40 => 14,  37 => 13,  22 => 27,  246 => 78,  157 => 90,  145 => 72,  139 => 52,  131 => 64,  123 => 65,  120 => 74,  115 => 60,  111 => 62,  108 => 65,  101 => 58,  98 => 37,  96 => 64,  83 => 60,  74 => 26,  66 => 21,  55 => 29,  52 => 10,  50 => 21,  43 => 6,  41 => 17,  35 => 4,  32 => 12,  29 => 6,  209 => 108,  203 => 107,  199 => 148,  193 => 99,  189 => 107,  187 => 108,  182 => 95,  176 => 100,  173 => 43,  168 => 88,  164 => 85,  162 => 39,  154 => 69,  149 => 85,  147 => 45,  144 => 92,  141 => 62,  133 => 60,  130 => 40,  125 => 27,  122 => 26,  116 => 37,  112 => 51,  109 => 50,  106 => 49,  103 => 71,  99 => 54,  95 => 2,  92 => 1,  86 => 57,  82 => 37,  80 => 56,  73 => 24,  64 => 23,  60 => 54,  57 => 19,  54 => 14,  51 => 22,  48 => 9,  45 => 8,  42 => 12,  39 => 4,  36 => 6,  33 => 14,  30 => 13,);
    }
}
