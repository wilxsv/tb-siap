<?php

/* MinsalSiapsBundle:MntPacienteAdmin:edit.html.twig */
class __TwigTemplate_e6205d2a8abdea3f4f5d473b2f75b2f42be0b310fade6b4cdbddcd2f66852cb1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'notice' => array($this, 'block_notice'),
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

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 7
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/MntPacienteAdmin/form-edit.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        // line 12
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/MntPacienteAdmin/MntPaciente_edit.js"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script type=\"text/javascript\">
        \$(document).ready(function () {
            \$('div[id\$=_justificacion]').hide();
            \$('div[id\$=_usuarioJustifica]').hide();

            \$('input[id\$=\"_numero\"]').focusout(function () {
                var fechaNacimiento=moment(\$('input[id\$=\"_fechaNacimiento\"]').val(),'DD/MM/YYYY');
                var fechaValidacion=moment('01-01-2017','DD/MM/YYYY');

                if (fechaNacimiento >= fechaValidacion) {

                    \$('input[id\$=\"_noValido\"]').val('');
                    resultado=validateCUN(\$(this).val());
                    if (!resultado){
                        var title='Error';
                        var body=\"El Código Único del Nacimiento no es valido, vuelva a digitarlo\";
                        var clase='dialog-error';
                        var width='750px'
                        var arrayBtns = [{text: 'Aceptar',
                                    click: function( event, ui) {
                                    jQuery( this ).dialog( \"close\" );
                                    \$('input[id\$=\"_noValido\"]').val('s');
                                    \$('div[id\$=_justificacion]').hide();
                                    \$('div[id\$=_usuarioJustifica]').hide();
                                    \$('input[id\$=\"_numero\"]').focus();
                                }},{text: 'Ingresar como un número de expediente tradicional',
                                            click: function( event, ui) {
                                            \$('input[id\$=\"_noValido\"]').val('t');
                                            \$('div[id\$=_justificacion]').show();
                                            \$('div[id\$=_usuarioJustifica]').show();
                                            jQuery( this ).dialog( \"close\" );
                                        }}
                                ];
                        showDialogMsg(title, body, clase, '', arrayBtns, false, width, true);
                    }
                }
            });

            \$('#form_paciente').submit(function (e) {
                if (\$('#idPaisDomicilio').select2('val') == 68 || \$('#idPaisDomicilio').select2('val') == 102 || \$('#idPaisDomicilio').select2('val') == 94 || \$('#idPaisDomicilio').select2('val') == 157) {
                    if (\$('select[id\$=\"_idDepartamentoDomicilio\"]').select2('val') == '') {
                        var title='Error';
                        var body=\"Debe de introducir el Departamento Domicilio\";
                        var clase='dialog-error';
                        var width='750px'
                        var arrayBtns = [{text: 'Aceptar',
                                    click: function( event, ui) {
                                    jQuery( this ).dialog( \"close\" );
                                    \$('select[id\$=\"_idDepartamentoDomicilio\"]').select2('focus');
                                }}
                                ];
                        showDialogMsg(title, body, clase, '', arrayBtns, false, width, true);
                        e.preventDefault();
                    }

                    if (\$('select[id\$=\"_idMunicipioDomicilio\"]').select2('val') == '' || \$('select[id\$=\"_idMunicipioDomicilio\"]').select2('val') == null) {
                        (\$('#error')) ? \$('#error').empty() : '';
                        var elem = \$(\"<div id='error' title='Error de Llenado'><center>\" +
                                \"Debe de introducir el Municipio Domicilio\"
                                + \"</center></div>\");
                        elem.insertAfter(\$(\"#form_paciente\"));
                        \$(\"#error\").dialog({
                            close: function () {
                                \$('select[id\$=\"_idMunicipioDomicilio\"]').select2('focus');
                            }

                        });
                        e.preventDefault();
                    }
                }

                if (\$('select[id\$=\"_idPaisNacimiento\"]').select2('val') == 68 || \$('select[id\$=\"_idPaisNacimiento\"]').select2('val') == 102 || \$('select[id\$=\"_idPaisNacimiento\"]').select2('val') == 94 || \$('select[id\$=\"_idPaisNacimiento\"]').select2('val') == 157) {
                    if (\$('select[id\$=\"_idDepartamentoNacimiento\"]').select2('val') == '') {
                        (\$('#error')) ? \$('#error').empty() : '';
                        var elem = \$(\"<div id='error' title='Error de Llenado'><center>\" +
                                \"Debe de introducir el Departamento de Nacimiento\"
                                + \"</center></div>\");
                        elem.insertAfter(\$(\"#form_paciente\"));
                        \$(\"#error\").dialog({
                            close: function () {
                                \$('select[id\$=\"_idDepartamentoNacimiento\"]').select2('focus');
                            }

                        });
                        e.preventDefault();
                    }
                    if (\$('select[id\$=\"_idMunicipioNacimiento\"]').select2('val') == '') {
                        (\$('#error')) ? \$('#error').empty() : '';
                        var elem = \$(\"<div id='error' title='Error de Llenado'><center>\" +
                                \"Debe de introducir el Municipio de Nacimiento\"
                                + \"</center></div>\");
                        elem.insertAfter(\$(\"#form_paciente\"));
                        \$(\"#error\").dialog({
                            close: function () {
                                \$('select[id\$=\"_idMunicipioNacimiento\"]').select2('focus');
                            }

                        });
                        e.preventDefault();
                    }
                }
                if(\$('input[id\$=\"_noValido\"]').val()=='t'){
                    if(\$('input[id\$=\"_justificacion\"]').val()=='' || \$('input[id\$=\"_justificacion\"]').val().length<10){
                        var title='Error';
                        var body=\"Debe de Ingresar una justificacion del porque no esta ingresando el Código Único del Nacimiento\";
                        var clase='dialog-error';
                        var width='750px'
                        var arrayBtns = [{text: 'Aceptar',
                                    click: function( event, ui) {
                                    jQuery( this ).dialog( \"close\" );
                                    \$('input[id\$=\"_justificacion\"]').focus();
                                }}
                                ];
                        showDialogMsg(title, body, clase, '', arrayBtns, false, width, true);
                        e.preventDefault();
                    }
                }else{
                    var fechaNacimiento=moment(\$('input[id\$=\"_fechaNacimiento\"]').val(),'DD/MM/YYYY');
                    var fechaValidacion=moment('01-01-2017','DD/MM/YYYY');

                    if (fechaNacimiento >= fechaValidacion) {
                        \$('input[id\$=\"_noValido\"]').val('');
                        resultado=validateCUN(\$('input[id\$=\"_numero\"]').val());
                        if (!resultado ){
                            e.preventDefault();
                            var title='Error';
                            var body=\"El Código Único del Nacimiento no es valido, vuelva a digitarlo\";
                            var clase='dialog-error';
                            var width='750px';
                            var arrayBtns = [{text: 'Aceptar',
                                        click: function( event, ui) {
                                        jQuery( this ).dialog( \"close\" );
                                        \$('input[id\$=\"_noValido\"]').val('');
                                        \$('div[id\$=_justificacion]').hide();
                                        \$('div[id\$=_usuarioJustifica]').hide();
                                        \$('input[id\$=\"_numero\"]').focus();
                                        e.preventDefault();
                                    }},{text: 'Ingresar como un número de expediente tradicional',
                                                click: function( event, ui) {
                                                \$('input[id\$=\"_noValido\"]').val('t');
                                                \$('div[id\$=_justificacion]').show();
                                                \$('div[id\$=_usuarioJustifica]').show();
                                                jQuery( this ).dialog( \"close\" );
                                                \$('input[id\$=\"_numero\"]').focus();
                                                e.preventDefault();
                                            }}
                                    ];
                            showDialogMsg(title, body, clase, '', arrayBtns, false, width, true);
                        }
                    }
                }
                \$('.deshabilitados').removeAttr('disabled');
            });
        });
    </script>
";
    }

    // line 171
    public function block_notice($context, array $blocks = array())
    {
        // line 172
        $this->env->loadTemplate("SonataCoreBundle:FlashMessage:render.html.twig")->display($context);
    }

    // line 174
    public function block_form($context, array $blocks = array())
    {
        // line 175
        echo "    ";
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.top", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

    ";
        // line 177
        $context["url"] = (((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) ? ("edit") : ("create"));
        // line 178
        echo "
    ";
        // line 179
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url"))), "method"))) {
            // line 180
            echo "        <div>
            ";
            // line 181
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        </div>
    ";
        } else {
            // line 184
            echo "        <form id=\"form_paciente\"
              ";
            // line 185
            if (($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "form_type"), "method") == "horizontal")) {
                echo "class=\"form-horizontal\"";
            }
            // line 186
            echo "              role=\"form\"
              action=\"";
            // line 187
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), 1 => array("id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
            echo "
              method=\"POST\"
              ";
            // line 189
            if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
                echo "novalidate=\"novalidate\"";
            }
            // line 190
            echo "              >

            ";
            // line 192
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
                // line 193
                echo "                <div class=\"sonata-ba-form-error\">
                    ";
                // line 194
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "
                </div>
            ";
            }
            // line 197
            echo "
            ";
            // line 198
            if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method"))) {
                // line 199
                echo "                <a style=\"position:relative;float:right;margin-bottom:20px;\" class=\"btn btn-info\" href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list"), "method"), "html", null, true);
                echo "\">
                    <span class=\"glyphicon glyphicon-list\"></span>
                    ";
                // line 201
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_action_list", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                </a>
            ";
            }
            // line 204
            echo "
            ";
            // line 205
            $this->displayBlock('sonata_pre_fieldsets', $context, $blocks);
            // line 208
            echo "
                ";
            // line 209
            $this->displayBlock('sonata_tab_content', $context, $blocks);
            // line 517
            echo "
                ";
            // line 518
            $this->displayBlock('sonata_post_fieldsets', $context, $blocks);
            // line 521
            echo "
            ";
            // line 522
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "

            ";
            // line 524
            $this->displayBlock('formactions', $context, $blocks);
            // line 554
            echo "        </form>
    ";
        }
    }

    // line 205
    public function block_sonata_pre_fieldsets($context, array $blocks = array())
    {
        // line 206
        echo "                <div class=\"row\">
                ";
    }

    // line 209
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 210
        echo "                    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formgroups"));
        foreach ($context['_seq'] as $context["name"] => $context["form_group"]) {
            // line 211
            echo "                        <div class=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class"), "col-md-12")) : ("col-md-12")), "html", null, true);
            echo "\">
                            <div class=\"box box-success\">
                                <div class=\"box-header\">
                                    <h4 class=\"box-title\">
                                        ";
            // line 216
            echo "                                    </h4>
                                </div>
                                ";
            // line 219
            echo "                                <div class=\"box-body\">
                                    <div class=\"sonata-ba-collapsed-fields\">
                                        ";
            // line 221
            if (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description") != false)) {
                // line 222
                echo "                                            <p>";
                echo $this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description");
                echo "</p>
                                        ";
            }
            // line 224
            echo "                                        <center>
                                            <table class=\"dat_paciente\">
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">A.Nombre del Paciente</td>
                                                </tr>
                                                <tr class=\"dat_paciente_content\">
                                                    <td width='50%'>";
            // line 230
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "primerApellido"), array(), "array"), 'row');
            echo "</td>
                                                    <td width=''>";
            // line 231
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "segundoApellido"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 234
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "primerNombre"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 235
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "segundoNombre"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 238
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "tercerNombre"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 239
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "apellidoCasada"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td colspan=\"2\">";
            // line 242
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "conocidoPor"), array(), "array"), 'row');
            echo "</td>
                                                    <td></td>
                                                </tr>
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">B.Datos del Nacimiento</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 249
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "fechaNacimiento"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 250
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "horaNacimiento"), array(), "array"), 'row');
            echo "
                                                     ";
            // line 251
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "horaNacimiento"), array(), "array"), 'errors')) > 0)) {
                // line 252
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 253
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "horaNacimiento"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 256
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label>Edad:</label>
                                                        <div class=\"sonata-ba-field sonata-ba-field-standard-natural\">
                                                            <input id=\"edad\" type=\"text\" maxlength=\"25\" class=\"form-control\">
                                                        </div>
                                                    </td>
                                                    <td>";
            // line 265
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idSexo"), array(), "array"), 'row');
            echo "
                                                    ";
            // line 266
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idSexo"), array(), "array"), 'errors')) > 0)) {
                // line 267
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 268
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idSexo"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 271
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 274
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idPaisNacimiento"), array(), "array"), 'row');
            echo "
                                                     ";
            // line 275
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idPaisNacimiento"), array(), "array"), 'errors')) > 0)) {
                // line 276
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 277
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idPaisNacimiento"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 280
            echo "                                                    </td>
                                                    <td>";
            // line 281
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDepartamentoNacimiento"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t\t ";
            // line 282
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDepartamentoNacimiento"), array(), "array"), 'errors')) > 0)) {
                // line 283
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 284
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDepartamentoNacimiento"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 287
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 290
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idMunicipioNacimiento"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t       ";
            // line 291
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idMunicipioNacimiento"), array(), "array"), 'errors')) > 0)) {
                // line 292
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 293
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idMunicipioNacimiento"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 296
            echo "                                                    </td>
                                                    <td>";
            // line 297
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idNacionalidad"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t\t";
            // line 298
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idNacionalidad"), array(), "array"), 'errors')) > 0)) {
                // line 299
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 300
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idNacionalidad"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 303
            echo "                                                    </td>
                                                </tr>
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">C.Datos de Identificación</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 309
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocPaciente"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t      ";
            // line 310
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocPaciente"), array(), "array"), 'errors')) > 0)) {
                // line 311
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 312
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocPaciente"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t      ";
            }
            // line 315
            echo "                                                    </td>
                                                    <td>";
            // line 316
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "numeroDocIdePaciente"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 319
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idEstadoCivil"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t\t ";
            // line 320
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idEstadoCivil"), array(), "array"), 'errors')) > 0)) {
                // line 321
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 322
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idEstadoCivil"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t      ";
            }
            // line 325
            echo "                                                    </td>
                                                    <td>";
            // line 326
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idOcupacion"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t\t";
            // line 327
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idOcupacion"), array(), "array"), 'errors')) > 0)) {
                // line 328
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 329
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idOcupacion"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t      ";
            }
            // line 332
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan=\"4\">";
            // line 335
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "direccion"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div id=\"sonata-ba-field-container-numeroAmbientes\" class=\"control-group\">
                                                            <label class=\" control-label\">País Domicilio:</label>
                                                            <div class=\"controls sonata-ba-field sonata-ba-field-standard-natural \">
                                                                <select id=\"idPaisDomicilio\" name=\"idPaisDomicilio\">
                                                                </select></td>
                                                            </div>
                                                        </div>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 349
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDepartamentoDomicilio"), array(), "array"), 'row');
            echo "
                                                       ";
            // line 350
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDepartamentoDomicilio"), array(), "array"), 'errors')) > 0)) {
                // line 351
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 352
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDepartamentoDomicilio"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t      ";
            }
            // line 355
            echo "                                                    </td>
                                                    <td>";
            // line 356
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idMunicipioDomicilio"), array(), "array"), 'row');
            echo "
                                                    ";
            // line 357
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idMunicipioDomicilio"), array(), "array"), 'errors')) > 0)) {
                // line 358
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 359
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idMunicipioDomicilio"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 362
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 365
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "areaGeograficaDomicilio"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t      ";
            // line 366
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "areaGeograficaDomicilio"), array(), "array"), 'errors')) > 0)) {
                // line 367
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 368
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "areaGeograficaDomicilio"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 371
            echo "                                                    </td>
                                                    <td>";
            // line 372
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idCantonDomicilio"), array(), "array"), 'row');
            echo "
                                                    ";
            // line 373
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idCantonDomicilio"), array(), "array"), 'errors')) > 0)) {
                // line 374
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 375
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idCantonDomicilio"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 378
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 381
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "telefonoCasa"), array(), "array"), 'row');
            echo "</td>
                                                    <td></td>
                                                </tr>
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">D.Datos Laborales</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 388
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "asegurado"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 389
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idAreaCotizacion"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t      ";
            // line 390
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idAreaCotizacion"), array(), "array"), 'errors')) > 0)) {
                // line 391
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 392
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idAreaCotizacion"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 395
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 398
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idTipoVeterano"), array(), "array"), 'row');
            echo "
                                                        ";
            // line 399
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoBeneficiarioVeterano"), array(), "array"), 'row');
            echo "
                                                    </td>
                                                    <td>";
            // line 401
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "numeroAfiliacion"), array(), "array"), 'row');
            echo "
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 405
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "lugarTrabajo"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 406
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "telefonoTrabajo"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">E.Datos Familiares</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 412
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "nombrePadre"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 413
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "nombreMadre"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td >";
            // line 416
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "nombreConyuge"), array(), "array"), 'row');
            echo "</td><td></td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 419
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoResponsable"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t      ";
            // line 420
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoResponsable"), array(), "array"), 'errors')) > 0)) {
                // line 421
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 422
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoResponsable"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 425
            echo "                                                    </td>
                                                    <td>";
            // line 426
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "nombreResponsable"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 429
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "telefonoResponsable"), array(), "array"), 'row');
            echo "</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 433
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocResponsable"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t      ";
            // line 434
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocResponsable"), array(), "array"), 'errors')) > 0)) {
                // line 435
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 436
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocResponsable"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 439
            echo "                                                    </td>
                                                    <td>";
            // line 440
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "numeroDocIdeResponsable"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr>
                                                    <td colspan=\"4\">";
            // line 443
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "direccionResponsable"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">F.Persona que Proporcionó Datos</td>
                                                </tr>
                                                <tr>
                                                    <td colspan=\"4\">
                                                        ";
            // line 450
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoProporDatos"), array(), "array"), 'row');
            echo "
                                                         ";
            // line 451
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoProporDatos"), array(), "array"), 'errors')) > 0)) {
                // line 452
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 453
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idParentescoProporDatos"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 456
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td >";
            // line 459
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "nombreProporcionoDatos"), array(), "array"), 'row');
            echo "</td>
                                                    <td>";
            // line 460
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocProporcionoDatos"), array(), "array"), 'row');
            echo "
\t\t\t\t\t\t       ";
            // line 461
            if ((twig_length_filter($this->env, $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocProporcionoDatos"), array(), "array"), 'errors')) > 0)) {
                // line 462
                echo "\t\t\t\t\t\t\t<div class=\"sonata-ba-form-error\">
\t\t\t\t\t\t\t      ";
                // line 463
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idDocProporcionoDatos"), array(), "array"), 'errors');
                echo "
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
            }
            // line 466
            echo "                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>";
            // line 469
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "numeroDocIdeProporDatos"), array(), "array"), 'row');
            echo "</td>
                                                    <td></td>
                                                </tr>
                                                <tr class=\"dat_paciente_sec\">
                                                    <td colspan=\"4\">G.Otros</td>
                                                </tr>
                                                <tr>
                                                    <td colspan=\"4\">";
            // line 476
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "observacion"), array(), "array"), 'row');
            echo "</td>
                                                </tr>
                                                ";
            // line 478
            if (array_key_exists("procedencia", $context)) {
                // line 479
                echo "                                                    ";
                if (((isset($context["procedencia"]) ? $context["procedencia"] : $this->getContext($context, "procedencia")) != "e")) {
                    // line 480
                    echo "                                                        <tr class=\"dat_paciente_sec\">
                                                            <td colspan=\"4\">H.Número de Expediente</td>
                                                        </tr>
                                                        <tr>
                                                            <td>";
                    // line 484
                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "numero"), array(), "array"), 'row');
                    echo "</td>
                                                            <td>";
                    // line 485
                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idCreacionExpediente"), array(), "array"), 'row');
                    echo "</td>
                                                        </tr>
                                                        <tr>
                                                            <td>";
                    // line 488
                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "usuarioJustifica"), array(), "array"), 'row');
                    echo "</td>
                                                            <td>";
                    // line 489
                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "justificacion"), array(), "array"), 'row');
                    echo "</td>
                                                        </tr>
                                                    ";
                }
                // line 492
                echo "                                                    <input type=\"hidden\" id=\"procedencia\" name=\"procedencia\" value=\"";
                echo twig_escape_filter($this->env, (isset($context["procedencia"]) ? $context["procedencia"] : $this->getContext($context, "procedencia")), "html", null, true);
                echo "\"/>
                                                ";
            } else {
                // line 494
                echo "                                                    <tr class=\"dat_paciente_sec\">
                                                        <td colspan=\"4\">H.Número de Expediente</td>
                                                    </tr>
                                                    <tr>
                                                        <td>";
                // line 498
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "numero"), array(), "array"), 'row');
                echo "</td>
                                                        <td>";
                // line 499
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "idCreacionExpediente"), array(), "array"), 'row');
                echo "</td>
                                                    </tr>
                                                    <tr>
                                                        <td>";
                // line 502
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "usuarioJustifica"), array(), "array"), 'row');
                echo "</td>
                                                        <td>";
                // line 503
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"), "justificacion"), array(), "array"), 'row');
                echo "</td>
                                                    </tr>
                                                ";
            }
            // line 506
            echo "                                                ";
            if (array_key_exists("clasificacion", $context)) {
                // line 507
                echo "                                                    <input type=\"hidden\" id=\"clasificacion\" name=\"clasificacion\" value=\"";
                echo twig_escape_filter($this->env, (isset($context["clasificacion"]) ? $context["clasificacion"] : $this->getContext($context, "clasificacion")), "html", null, true);
                echo "\"/>
                                                ";
            }
            // line 509
            echo "                                            </table>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['form_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 516
        echo "                ";
    }

    // line 518
    public function block_sonata_post_fieldsets($context, array $blocks = array())
    {
        // line 519
        echo "                </div>
            ";
    }

    // line 524
    public function block_formactions($context, array $blocks = array())
    {
        // line 525
        echo "                <div class=\"well well-small form-actions\">
                    ";
        // line 526
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 527
            echo "                        ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 528
                echo "                            <button type=\"submit\" class=\"btn btn-success\" name=\"btn_update\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
                        ";
            } else {
                // line 530
                echo "                            <button type=\"submit\" class=\"btn btn-success\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
                        ";
            }
            // line 532
            echo "                    ";
        } else {
            // line 533
            echo "                        ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 534
                echo "                            <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                                <i class=\"fa fa-eye\"></i>
                                ";
                // line 536
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                            </button>
                        ";
            }
            // line 539
            echo "                        ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 540
                echo "                            <button type=\"submit\" class=\"btn btn-success\" name=\"btn_update_and_edit\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update_and_edit_again", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>


                            ";
                // line 543
                if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isAclEnabled", array(), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "acl"), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "MASTER", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 544
                    echo "                                <a class=\"btn btn-info\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "acl", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-users\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_edit_acl", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                            ";
                }
                // line 546
                echo "                        ";
            } else {
                // line 547
                echo "                            ";
                if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method")) {
                    // line 548
                    echo "                                <button type=\"submit\" class=\"btn btn-success\" name=\"btn_create_and_list\"><i class=\"fa fa-save\"></i> Guardar</button>
                            ";
                }
                // line 550
                echo "                        ";
            }
            // line 551
            echo "                    ";
        }
        // line 552
        echo "                </div>
            ";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:MntPacienteAdmin:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1082 => 552,  1076 => 550,  1072 => 548,  1069 => 547,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 450,  842 => 443,  836 => 440,  824 => 435,  781 => 416,  775 => 413,  762 => 406,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 388,  708 => 381,  703 => 378,  674 => 366,  659 => 359,  636 => 350,  604 => 329,  581 => 320,  568 => 315,  539 => 300,  534 => 298,  530 => 297,  521 => 293,  489 => 280,  483 => 277,  394 => 234,  396 => 321,  345 => 283,  476 => 315,  386 => 284,  364 => 219,  234 => 88,  595 => 326,  589 => 192,  586 => 322,  562 => 312,  556 => 182,  506 => 103,  498 => 283,  492 => 281,  473 => 165,  458 => 266,  399 => 143,  352 => 211,  346 => 125,  328 => 524,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 251,  758 => 405,  667 => 218,  573 => 172,  567 => 170,  520 => 177,  481 => 167,  475 => 159,  472 => 158,  466 => 156,  441 => 346,  438 => 149,  432 => 251,  429 => 342,  395 => 287,  382 => 128,  378 => 281,  367 => 120,  357 => 118,  348 => 115,  334 => 110,  286 => 6,  205 => 115,  297 => 92,  218 => 81,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 296,  787 => 419,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 259,  740 => 239,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 224,  628 => 214,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 316,  499 => 154,  488 => 172,  389 => 318,  223 => 172,  14 => 2,  306 => 95,  303 => 91,  300 => 248,  292 => 86,  280 => 87,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 328,  599 => 327,  580 => 194,  574 => 230,  559 => 311,  526 => 179,  497 => 173,  485 => 318,  463 => 268,  447 => 152,  404 => 238,  401 => 289,  391 => 76,  369 => 129,  333 => 132,  329 => 275,  307 => 242,  287 => 58,  195 => 54,  178 => 48,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 265,  807 => 259,  805 => 426,  802 => 425,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 368,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 356,  647 => 355,  644 => 190,  632 => 349,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 224,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 307,  448 => 306,  424 => 249,  418 => 112,  410 => 113,  376 => 224,  373 => 102,  340 => 122,  326 => 256,  261 => 76,  118 => 39,  200 => 64,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 543,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 536,  1036 => 534,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 255,  796 => 422,  793 => 421,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 231,  710 => 149,  707 => 208,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 357,  649 => 122,  643 => 227,  640 => 226,  638 => 351,  617 => 112,  614 => 201,  598 => 107,  593 => 201,  576 => 101,  564 => 162,  557 => 310,  550 => 94,  527 => 296,  515 => 305,  512 => 290,  509 => 228,  503 => 81,  496 => 282,  493 => 155,  478 => 275,  467 => 312,  456 => 309,  450 => 114,  414 => 242,  408 => 239,  388 => 231,  371 => 72,  363 => 32,  350 => 26,  342 => 282,  335 => 279,  316 => 16,  290 => 110,  276 => 2,  266 => 83,  263 => 133,  255 => 185,  245 => 122,  207 => 93,  194 => 106,  184 => 55,  76 => 24,  810 => 238,  804 => 260,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 399,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 372,  685 => 371,  682 => 226,  672 => 223,  670 => 365,  665 => 362,  648 => 219,  627 => 206,  622 => 204,  619 => 212,  616 => 202,  613 => 210,  610 => 332,  608 => 197,  605 => 207,  596 => 106,  592 => 325,  587 => 197,  585 => 196,  582 => 190,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 303,  542 => 186,  533 => 186,  531 => 95,  507 => 287,  505 => 180,  502 => 175,  477 => 164,  471 => 164,  465 => 161,  454 => 265,  446 => 156,  443 => 256,  431 => 151,  428 => 250,  425 => 152,  422 => 338,  412 => 147,  406 => 111,  390 => 139,  383 => 316,  377 => 73,  375 => 124,  372 => 277,  370 => 222,  359 => 70,  356 => 269,  353 => 268,  349 => 119,  336 => 205,  332 => 259,  330 => 554,  318 => 518,  313 => 209,  291 => 198,  190 => 53,  321 => 254,  295 => 201,  274 => 87,  242 => 121,  236 => 177,  70 => 22,  170 => 85,  288 => 197,  284 => 192,  279 => 193,  275 => 227,  256 => 74,  250 => 73,  237 => 89,  232 => 136,  222 => 129,  191 => 88,  153 => 72,  150 => 84,  563 => 188,  560 => 187,  558 => 186,  553 => 309,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 173,  525 => 172,  523 => 171,  518 => 292,  514 => 168,  511 => 167,  508 => 165,  501 => 284,  491 => 157,  487 => 156,  460 => 267,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 297,  415 => 121,  411 => 293,  405 => 118,  403 => 117,  380 => 107,  366 => 106,  354 => 101,  331 => 96,  325 => 94,  320 => 521,  317 => 91,  311 => 87,  308 => 205,  304 => 85,  272 => 81,  267 => 130,  249 => 78,  216 => 159,  155 => 35,  146 => 49,  126 => 87,  188 => 54,  181 => 51,  161 => 54,  110 => 58,  124 => 113,  692 => 373,  683 => 282,  678 => 279,  676 => 367,  666 => 126,  661 => 380,  656 => 358,  652 => 376,  645 => 215,  641 => 352,  635 => 226,  631 => 218,  625 => 361,  615 => 335,  607 => 208,  597 => 177,  590 => 202,  583 => 321,  579 => 284,  577 => 319,  575 => 328,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 299,  529 => 191,  524 => 90,  516 => 291,  510 => 78,  504 => 90,  500 => 88,  495 => 158,  490 => 154,  486 => 165,  482 => 317,  470 => 313,  464 => 311,  459 => 116,  452 => 158,  434 => 252,  421 => 90,  417 => 296,  400 => 116,  385 => 129,  361 => 207,  344 => 209,  339 => 206,  324 => 179,  310 => 208,  302 => 93,  296 => 151,  282 => 194,  259 => 186,  244 => 83,  231 => 67,  226 => 69,  215 => 63,  186 => 51,  152 => 51,  114 => 80,  104 => 28,  358 => 103,  351 => 116,  347 => 210,  343 => 264,  338 => 280,  327 => 108,  323 => 522,  319 => 124,  315 => 517,  301 => 80,  299 => 201,  293 => 199,  289 => 82,  281 => 57,  277 => 192,  271 => 79,  265 => 100,  262 => 187,  260 => 128,  257 => 53,  251 => 182,  248 => 71,  239 => 120,  228 => 103,  225 => 65,  213 => 69,  211 => 156,  197 => 30,  174 => 59,  148 => 38,  134 => 35,  127 => 16,  20 => 1,  270 => 85,  253 => 78,  233 => 66,  212 => 158,  210 => 63,  206 => 109,  202 => 108,  198 => 54,  192 => 66,  185 => 104,  180 => 49,  175 => 47,  172 => 81,  167 => 44,  165 => 83,  160 => 88,  137 => 2,  113 => 53,  100 => 56,  90 => 30,  81 => 26,  65 => 20,  129 => 88,  97 => 92,  77 => 35,  34 => 3,  53 => 11,  84 => 22,  58 => 33,  23 => 3,  480 => 276,  474 => 274,  469 => 271,  461 => 70,  457 => 124,  453 => 151,  444 => 151,  440 => 304,  437 => 253,  435 => 344,  430 => 153,  427 => 341,  423 => 298,  413 => 241,  409 => 327,  407 => 326,  402 => 323,  398 => 235,  393 => 320,  387 => 110,  384 => 230,  381 => 315,  379 => 154,  374 => 36,  368 => 221,  365 => 119,  362 => 148,  360 => 216,  355 => 27,  341 => 263,  337 => 97,  322 => 93,  314 => 88,  312 => 97,  309 => 113,  305 => 204,  298 => 247,  294 => 100,  285 => 88,  283 => 5,  278 => 110,  268 => 101,  264 => 104,  258 => 75,  252 => 184,  247 => 72,  241 => 179,  229 => 86,  220 => 171,  214 => 58,  177 => 52,  169 => 44,  140 => 47,  132 => 84,  128 => 42,  107 => 29,  61 => 19,  273 => 190,  269 => 189,  254 => 126,  243 => 180,  240 => 72,  238 => 178,  235 => 67,  230 => 175,  227 => 174,  224 => 62,  221 => 61,  219 => 60,  217 => 86,  208 => 155,  204 => 61,  179 => 101,  159 => 40,  143 => 36,  135 => 37,  119 => 99,  102 => 28,  71 => 26,  67 => 25,  63 => 35,  59 => 57,  28 => 5,  94 => 25,  89 => 56,  85 => 43,  75 => 19,  68 => 21,  56 => 22,  87 => 55,  201 => 114,  196 => 112,  183 => 55,  171 => 63,  166 => 43,  163 => 42,  158 => 81,  156 => 75,  151 => 1,  142 => 89,  138 => 87,  136 => 45,  121 => 75,  117 => 81,  105 => 34,  91 => 29,  62 => 17,  49 => 11,  25 => 4,  21 => 2,  31 => 2,  38 => 7,  26 => 2,  24 => 3,  19 => 1,  93 => 31,  88 => 40,  78 => 25,  46 => 7,  44 => 9,  27 => 3,  79 => 28,  72 => 14,  69 => 23,  47 => 10,  40 => 6,  37 => 5,  22 => 14,  246 => 181,  157 => 94,  145 => 64,  139 => 46,  131 => 34,  123 => 86,  120 => 42,  115 => 12,  111 => 32,  108 => 54,  101 => 45,  98 => 55,  96 => 26,  83 => 26,  74 => 16,  66 => 21,  55 => 23,  52 => 12,  50 => 9,  43 => 8,  41 => 7,  35 => 6,  32 => 4,  29 => 3,  209 => 157,  203 => 56,  199 => 59,  193 => 57,  189 => 65,  187 => 104,  182 => 103,  176 => 85,  173 => 48,  168 => 50,  164 => 42,  162 => 52,  154 => 2,  149 => 34,  147 => 101,  144 => 100,  141 => 71,  133 => 28,  130 => 40,  125 => 78,  122 => 77,  116 => 54,  112 => 11,  109 => 10,  106 => 47,  103 => 49,  99 => 33,  95 => 46,  92 => 34,  86 => 29,  82 => 37,  80 => 21,  73 => 23,  64 => 12,  60 => 10,  57 => 13,  54 => 14,  51 => 9,  48 => 9,  45 => 8,  42 => 8,  39 => 4,  36 => 5,  33 => 6,  30 => 4,);
    }
}
