<?php

/* MinsalSeguimientoBundle:SecRemisionPacienteAdmin:edit.html.twig */
class __TwigTemplate_a33de934284733827fdf36668470a4447ffd9455bb36bf84840fa443addee472 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_edit.html.twig");

        $this->blocks = array(
            'sonata_header' => array($this, 'block_sonata_header'),
            'actions' => array($this, 'block_actions'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'content' => array($this, 'block_content'),
            'form' => array($this, 'block_form'),
            'sonata_pre_fieldsets' => array($this, 'block_sonata_pre_fieldsets'),
            'sonata_tab_content' => array($this, 'block_sonata_tab_content'),
            'sonata_post_fieldsets' => array($this, 'block_sonata_post_fieldsets'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 14
        echo "
";
    }

    // line 17
    public function block_actions($context, array $blocks = array())
    {
        // line 18
        echo "
";
    }

    // line 20
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 21
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/MntPacienteAdmin/encabezado_paciente.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    <link rel=\"stylesheet\" href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalseguimiento/css/seguimiento.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 25
    public function block_javascripts($context, array $blocks = array())
    {
        // line 26
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script  type=\"text/javascript\">
        jQuery(document).ready(function (\$) {

        ";
        // line 31
        if (array_key_exists("cerrar", $context)) {
            // line 32
            echo "            ";
            if ((isset($context["cerrar"]) ? $context["cerrar"] : $this->getContext($context, "cerrar"))) {
                // line 33
                echo "                
                ";
                // line 34
                if (array_key_exists("respuesta", $context)) {
                    // line 35
                    echo "                       
                    ";
                    // line 36
                    if ((isset($context["problema"]) ? $context["problema"] : $this->getContext($context, "problema"))) {
                        // line 37
                        echo "                           var title = 'Problema de conexion!!!';
                    var body = '<p><span class=\"fa fa-warning\"></span> \\
                                Hubo problema al enviar la referencia';
                    var clase = 'dialog-warning';
                   var arrayBtns = [{
                                        text: 'Cerrar', click: function() {
                                           window.opener.reloadPage();
                                           window.close();
                                           jQuery( this ).dialog( \"close\" );
                                        }
                                    }];
                    showDialogMsg(title, body, clase, null, arrayBtns,false);
                    ";
                    } else {
                        // line 50
                        echo "                        var title = 'Proceso completado!!!';
                    var body = '<p><span class=\"fa fa-success\"></span> \\
                                Los datos se han enviado satisfactoriamente';
                    var clase = 'dialog-success';
                   var arrayBtns = [{
                                        text: 'Cerrar', click: function() {
                                           window.opener.reloadPage();
                                           window.close();
                                           jQuery( this ).dialog( \"close\" );
                                        }
                                    }];
                    showDialogMsg(title, body, clase, null, arrayBtns,false);
                    ";
                    }
                    // line 63
                    echo "                ";
                }
                // line 64
                echo "                        //window.opener.reloadPage();
                        //window.close();
                        
                         
            ";
            }
            // line 69
            echo "
        ";
        }
        // line 71
        echo "        ";
        if ((!array_key_exists("idestable", $context))) {
            // line 72
            echo "                \$('input[id\$=\"_nombreEspecialidadDestino\"]').attr(\"readonly\", false);
        ";
        }
        // line 74
        echo "            
            \$('select[id\$=\"_idAtencionOrigen\"]').select2('readonly',true);
            \$('select[id\$=\"_idAtencionDestino\"]').select2('readonly',true);
            \$('input[id\$=\"_idAtendAreaModEstabDestino\"]').hide();
            
            });//fin document ready
    </script>
    
    <script type=\"text/javascript\">
            jQuery(document).ready(function(\$) {
                ";
        // line 84
        if (((array_key_exists("createdElement", $context) && ((isset($context["createdElement"]) ? $context["createdElement"] : $this->getContext($context, "createdElement")) != "")) && (!(null === (isset($context["createdElement"]) ? $context["createdElement"] : $this->getContext($context, "createdElement")))))) {
            // line 85
            echo "                    window.addEventListener(\"beforeunload\", function (e) {
                        if (window.opener != null && !window.opener.closed) {
                            try {
                                window.opener.updateIdReferencia(";
            // line 88
            if (((isset($context["createdElement"]) ? $context["createdElement"] : $this->getContext($context, "createdElement")) > 0)) {
                echo "\"";
                echo twig_escape_filter($this->env, (isset($context["createdElement"]) ? $context["createdElement"] : $this->getContext($context, "createdElement")), "html", null, true);
                echo "\"";
            } else {
                echo "null";
            }
            echo ");
                            } catch (err) {
                                alert(err.description || err) //or console.log or however you debug
                            }
                        }
                    });
                ";
        }
        // line 95
        echo "            });
        </script>
";
    }

    // line 98
    public function block_content($context, array $blocks = array())
    {
        // line 99
        echo "
";
    }

    // line 104
    public function block_form($context, array $blocks = array())
    {
        // line 105
        echo "    ";
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.top", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

    ";
        // line 107
        $context["url"] = (((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) ? ("edit") : ("createespe"));
        // line 108
        echo "
    ";
        // line 109
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url"))), "method"))) {
            // line 110
            echo "        <div>
            ";
            // line 111
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        </div>
    ";
        } else {
            // line 114
            echo "        <form
            ";
            // line 115
            if (($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "form_type"), "method") == "horizontal")) {
                echo "class=\"form-horizontal\"";
            }
            // line 116
            echo "            role=\"form\"
                ";
            // line 117
            $context["url"] = "createsolo";
            // line 118
            echo "                action=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), 1 => array("idhistoria" => (isset($context["idhistoria"]) ? $context["idhistoria"] : $this->getContext($context, "idhistoria")), "estadoEnviar" => (isset($context["estadoEnviar"]) ? $context["estadoEnviar"] : $this->getContext($context, "estadoEnviar")), "idespe" => (isset($context["idespe"]) ? $context["idespe"] : $this->getContext($context, "idespe")), "idestable" => (isset($context["idestable"]) ? $context["idestable"] : $this->getContext($context, "idestable")), "id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
            echo "
   
            method=\"POST\"
            ";
            // line 121
            if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
                echo "novalidate=\"novalidate\"";
            }
            // line 122
            echo "            >
            ";
            // line 123
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
                // line 124
                echo "                <div class=\"sonata-ba-form-error\">

                    ";
                // line 126
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idTipoRemision"), 'errors');
                echo "
                    ";
                // line 127
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idMotivoRemision"), 'errors');
                echo "
                    ";
                // line 128
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "numeroExpediente"), 'errors');
                echo "
                    ";
                // line 129
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "nombreEspecialidadOrigen"), 'errors');
                echo "
                    ";
                // line 130
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "nombreEspecialidadDestino"), 'errors');
                echo "


                    ";
                // line 134
                echo "                    ";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "
                </div>
            ";
            }
            // line 137
            echo "
            ";
            // line 138
            $this->displayBlock('sonata_pre_fieldsets', $context, $blocks);
            // line 141
            echo "
                ";
            // line 142
            $this->displayBlock('sonata_tab_content', $context, $blocks);
            // line 200
            echo "
            ";
            // line 201
            $this->displayBlock('sonata_post_fieldsets', $context, $blocks);
            // line 204
            echo "            <br/>
            ";
            // line 205
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "impresionDiagnostica"), 'label');
            echo "
            ";
            // line 206
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "impresionDiagnostica"), 'widget');
            echo "
            <br/>
            ";
            // line 208
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "justificacionRemision"), 'label');
            echo "
            ";
            // line 209
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "justificacionRemision"), 'widget');
            echo "
            <br/>
            ";
            // line 211
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "datosExamen"), 'label');
            echo "
            ";
            // line 212
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "datosExamen"), 'widget');
            echo "
            <br/>
            
            ";
            // line 215
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "observacionResultado"), 'label');
            echo "
            ";
            // line 216
            $context["html"] = "";
            // line 217
            echo "            ";
            if ($this->getAttribute((isset($context["labresultados"]) ? $context["labresultados"] : null), "RC", array(), "any", true, true)) {
                // line 218
                echo "            ";
                if ((twig_length_filter($this->env, $this->getAttribute((isset($context["labresultados"]) ? $context["labresultados"] : $this->getContext($context, "labresultados")), "RC")) > 0)) {
                    // line 219
                    echo "                ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["labresultados"]) ? $context["labresultados"] : $this->getContext($context, "labresultados")), "RC"));
                    foreach ($context['_seq'] as $context["_key"] => $context["area"]) {
                        // line 220
                        echo "                    ";
                        if (($this->getAttribute($this->getAttribute((isset($context["area"]) ? $context["area"] : null), "plantillas", array(), "any", false, true), "A", array(), "array", true, true) && (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "plantillas"), "A", array(), "array")) > 0))) {
                            // line 221
                            echo "                        ";
                            $context['_parent'] = (array) $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "plantillas"), "A", array(), "array"), "examenes"));
                            foreach ($context['_seq'] as $context["_key"] => $context["examen"]) {
                                // line 222
                                echo "                            ";
                                if (($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "codigo_estado_detalle") === "RC")) {
                                    // line 223
                                    echo "                                ";
                                    $context["html"] = ((((((isset($context["html"]) ? $context["html"] : $this->getContext($context, "html")) . "<tr>") . "<td>") . $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "nombre")) . "</td>") . "<td>");
                                    // line 226
                                    echo "                                        ";
                                    if (((!(null === $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "id_posible_resultado"))) || ($this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "id_posible_resultado") != ""))) {
                                        // line 227
                                        echo "                                            ";
                                        $context["html"] = ((isset($context["html"]) ? $context["html"] : $this->getContext($context, "html")) . $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "nombre_posible_resultado"));
                                        // line 228
                                        echo "                                        ";
                                    } else {
                                        // line 229
                                        echo "                                            ";
                                        $context["html"] = ((isset($context["html"]) ? $context["html"] : $this->getContext($context, "html")) . $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "resultado"));
                                        // line 230
                                        echo "                                        ";
                                    }
                                    // line 231
                                    echo "                                    ";
                                    $context["html"] = ((((((((((((((isset($context["html"]) ? $context["html"] : $this->getContext($context, "html")) . "</td>") . "<td>") . $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "unidad")) . "</td>") . "<td>") . $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "rango_inicio")) . "-") . $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "rango_fin")) . "</td>") . "<td>") . $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "observacion")) . "</td>") . "</tr>");
                                    // line 236
                                    echo "                            ";
                                }
                                // line 237
                                echo "                        ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['examen'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 238
                            echo "                    ";
                        }
                        // line 239
                        echo "                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['area'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 240
                    echo "
                ";
                    // line 241
                    if ((!((isset($context["html"]) ? $context["html"] : $this->getContext($context, "html")) === ""))) {
                        // line 242
                        echo "                    <table width=\"100%\" class=\"table table-bordered table-striped\">
                        <thead style=\"text-align:left;\">
                            <tr>
                                <th>Nombre Examen</th>
                                <th>Resultado</th>
                                <th>Unidades</th>
                                <th>Rangos Normales</th>
                                <th>Observacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            ";
                        // line 253
                        echo (isset($context["html"]) ? $context["html"] : $this->getContext($context, "html"));
                        echo "
                        </tbody>
                    </table>
                ";
                        // line 256
                        $context["html"] = (("<table width='100%'><thead style='text-align:left;'><tr><th>Nombre Examen</th><th>Resultado</th><th>Unidades</th><th>Rangos Normales</th><th>Observacion</th></tr></thead>
                               <tbody>" . (isset($context["html"]) ? $context["html"] : $this->getContext($context, "html"))) . "</tbody></table>");
                        // line 258
                        echo "                ";
                    }
                    // line 259
                    echo "            ";
                }
                // line 260
                echo "            ";
            }
            // line 261
            echo "            
            <input name=\"examenesReferidos\" type=\"text\" value=\"";
            // line 262
            echo (isset($context["html"]) ? $context["html"] : $this->getContext($context, "html"));
            echo "\" style=\"display: none\"/>
            <br/>
            ";
            // line 264
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "observacionResultado"), 'widget');
            echo "
            <br/>
            
            ";
            // line 267
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "tratamiento"), 'label');
            echo "
            <br/>
            ";
            // line 269
            $context["htmlmedicamento"] = "";
            // line 270
            echo "            ";
            if ((twig_length_filter($this->env, (isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos"))) > 0)) {
                // line 271
                echo "                ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")));
                foreach ($context['_seq'] as $context["_key"] => $context["medicamento"]) {
                    // line 272
                    echo "                    ";
                    $context["htmlmedicamento"] = (((((((((isset($context["htmlmedicamento"]) ? $context["htmlmedicamento"] : $this->getContext($context, "htmlmedicamento")) . "<tr>") . "<td>") . $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "nombre")) . "</td>") . "<td>") . $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "dosis")) . "</td>") . "</tr>");
                    // line 276
                    echo "                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['medicamento'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 277
                echo "            ";
            }
            // line 278
            echo "            
            ";
            // line 279
            if ((!((isset($context["htmlmedicamento"]) ? $context["htmlmedicamento"] : $this->getContext($context, "htmlmedicamento")) === ""))) {
                // line 280
                echo "                <table width=\"100%\"  class=\"table table-bordered table-striped\">
                    <thead style=\"text-align:left;\">
                        <tr>
                            <th>Medicamento</th>
                            <th>Dosis</th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
                // line 288
                echo (isset($context["htmlmedicamento"]) ? $context["htmlmedicamento"] : $this->getContext($context, "htmlmedicamento"));
                echo "
                    </tbody>
                </table>
                    
                ";
                // line 292
                $context["htmlmedicamento"] = (("<table width='100%'><thead style='text-align:left;'><tr><th>Nombre Examen</th><th>Resultado</th><th>Unidades</th><th>Rangos Normales</th><th>Observacion</th></tr></thead>
                                            <tbody>" . (isset($context["htmlmedicamento"]) ? $context["htmlmedicamento"] : $this->getContext($context, "htmlmedicamento"))) . "</tbody></table>");
                // line 294
                echo "            ";
            }
            // line 295
            echo "            <input name=\"recetaReferidos\" type=\"text\" value=\"";
            echo (isset($context["htmlmedicamento"]) ? $context["htmlmedicamento"] : $this->getContext($context, "htmlmedicamento"));
            echo "\" style=\"display: none\"/>
            
           
            
            ";
            // line 299
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "tratamiento"), 'widget', array("attr" => array("placeholder" => "Si desea agregar informacion sobre tratamiento especifique aqui")));
            echo "
           
            ";
            // line 301
            $this->displayBlock('formactions', $context, $blocks);
            // line 306
            echo "            ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "
        </form>
    ";
        }
        // line 309
        echo "    ";
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.bottom", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "
";
    }

    // line 138
    public function block_sonata_pre_fieldsets($context, array $blocks = array())
    {
        // line 139
        echo "                <div class=\"row\">
                ";
    }

    // line 142
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 143
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
            // line 144
            echo "                        <div class=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class"), "col-md-12")) : ("col-md-12")), "html", null, true);
            echo "\">
                            <div class=\"box box-success\">
                                <div class=\"box-header\">
                                    <h4 class=\"box-title\">
                                        ";
            // line 149
            echo "                                    </h4>
                                </div>
                                ";
            // line 152
            echo "                                <div class=\"box-body\">

                                    ";
            // line 154
            $this->env->loadTemplate("MinsalSeguimientoBundle:SecRemisionPacienteAdmin:encabezado_paciente.html.twig")->display($context);
            // line 155
            echo "                                    <div class=\"sonata-ba-collapsed-fields\">

                                        ";
            // line 158
            echo "                                        <div class=\"row\">
                                            <div class=\"col-md-6\">
                                                <div class=\"row\">
                                                    <div class=\"col-md-3\">";
            // line 161
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idTipoRemision"), 'label');
            echo "</div>
                                                    <div class=\"col-md-3\">";
            // line 162
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idTipoRemision"), 'widget');
            echo "</div>
                                                    <div class=\"col-md-3\">";
            // line 163
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idMotivoRemision"), 'label');
            echo "</div>
                                                    <div class=\"col-md-3\">";
            // line 164
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idMotivoRemision"), 'widget');
            echo "</div>
                                                </div>
                                            </div>
                                            <div class=\"col-md-6\">
                                                <div class=\"row\">
                                                    <div class=\"col-md-3\">";
            // line 169
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "numeroExpediente"), 'label');
            echo "</div>
                                                    <div class=\"col-md-3\">";
            // line 170
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "numeroExpediente"), 'widget');
            echo "</div>
                                                    <div class=\"col-md-3\"><label>Fecha Remision</label></div>
                                                    <div class=\"col-md-3\">";
            // line 172
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d/m/Y"), "html", null, true);
            echo "</div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-md-6\">
                                                <div class=\"row\">
                                                    <div class=\"col-md-3\">";
            // line 181
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idAtencionOrigen"), 'label');
            echo "</div>
                                                    <div class=\"col-md-9\">";
            // line 182
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idAtencionOrigen"), 'widget');
            echo "</div>
                                                </div>
                                            </div>
                                            <div class=\"col-md-6\">
                                                <div class=\"row\">
                                                    <div class=\"col-md-3\">";
            // line 187
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idAtencionDestino"), 'label');
            echo "</div>
                                                    <div class=\"col-md-9\">";
            // line 188
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idAtencionDestino"), 'widget');
            echo "</div>
                                                    ";
            // line 189
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "idAtendAreaModEstabDestino"), 'widget');
            echo "
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                                ";
            // line 196
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
        // line 199
        echo "                ";
    }

    // line 201
    public function block_sonata_post_fieldsets($context, array $blocks = array())
    {
        // line 202
        echo "                </div>
            ";
    }

    // line 301
    public function block_formactions($context, array $blocks = array())
    {
        // line 302
        echo "                <div class=\"well well-small form-actions\">
                    <input  class=\"btn btn-primary\" type=\"submit\" value=\"Enviar y Cerrar\"/>
                </div>
            ";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecRemisionPacienteAdmin:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  646 => 188,  642 => 187,  544 => 143,  541 => 142,  517 => 301,  797 => 489,  752 => 459,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 224,  519 => 306,  416 => 172,  1082 => 552,  1076 => 550,  1072 => 548,  1069 => 547,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 450,  842 => 443,  836 => 440,  824 => 435,  781 => 416,  775 => 413,  762 => 406,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 388,  708 => 381,  703 => 378,  674 => 366,  659 => 196,  636 => 350,  604 => 329,  581 => 330,  568 => 315,  539 => 322,  534 => 298,  530 => 297,  521 => 220,  489 => 208,  483 => 206,  394 => 234,  396 => 117,  345 => 283,  476 => 278,  386 => 284,  364 => 219,  234 => 78,  595 => 326,  589 => 161,  586 => 322,  562 => 144,  556 => 182,  506 => 103,  498 => 292,  492 => 274,  473 => 277,  458 => 266,  399 => 240,  352 => 221,  346 => 125,  328 => 104,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 218,  573 => 328,  567 => 347,  520 => 309,  481 => 280,  475 => 275,  472 => 269,  466 => 272,  441 => 346,  438 => 262,  432 => 260,  429 => 259,  395 => 287,  382 => 128,  378 => 231,  367 => 120,  357 => 222,  348 => 100,  334 => 110,  286 => 137,  205 => 106,  297 => 79,  218 => 127,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 419,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 302,  687 => 301,  671 => 262,  669 => 219,  653 => 232,  634 => 182,  628 => 372,  621 => 220,  609 => 169,  602 => 206,  591 => 289,  571 => 316,  499 => 154,  488 => 273,  389 => 114,  223 => 114,  14 => 2,  306 => 117,  303 => 161,  300 => 115,  292 => 86,  280 => 150,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 164,  599 => 327,  580 => 155,  574 => 152,  559 => 311,  526 => 309,  497 => 173,  485 => 283,  463 => 271,  447 => 152,  404 => 242,  401 => 119,  391 => 222,  369 => 228,  333 => 95,  329 => 93,  307 => 85,  287 => 75,  195 => 105,  178 => 123,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 425,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 209,  700 => 205,  679 => 201,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 189,  647 => 355,  644 => 190,  632 => 349,  629 => 186,  626 => 221,  603 => 362,  600 => 178,  594 => 212,  588 => 175,  584 => 158,  570 => 149,  561 => 168,  554 => 321,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 279,  468 => 163,  451 => 307,  448 => 306,  424 => 234,  418 => 112,  410 => 236,  376 => 109,  373 => 152,  340 => 200,  326 => 212,  261 => 127,  118 => 53,  200 => 117,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 543,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 536,  1036 => 534,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 488,  785 => 486,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 437,  710 => 149,  707 => 208,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 134,  675 => 199,  662 => 217,  658 => 124,  654 => 357,  649 => 122,  643 => 227,  640 => 226,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 162,  576 => 101,  564 => 162,  557 => 310,  550 => 94,  527 => 296,  515 => 305,  512 => 299,  509 => 228,  503 => 81,  496 => 282,  493 => 155,  478 => 204,  467 => 276,  456 => 270,  450 => 114,  414 => 242,  408 => 239,  388 => 207,  371 => 216,  363 => 226,  350 => 142,  342 => 97,  335 => 198,  316 => 16,  290 => 154,  276 => 102,  266 => 136,  263 => 142,  255 => 135,  245 => 122,  207 => 107,  194 => 112,  184 => 95,  76 => 51,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 399,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 372,  685 => 413,  682 => 202,  672 => 223,  670 => 365,  665 => 362,  648 => 219,  627 => 206,  622 => 369,  619 => 212,  616 => 202,  613 => 170,  610 => 332,  608 => 197,  605 => 207,  596 => 106,  592 => 325,  587 => 197,  585 => 331,  582 => 190,  578 => 154,  572 => 204,  566 => 324,  547 => 93,  545 => 228,  542 => 227,  533 => 138,  531 => 95,  507 => 287,  505 => 214,  502 => 278,  477 => 164,  471 => 164,  465 => 265,  454 => 269,  446 => 156,  443 => 264,  431 => 251,  428 => 250,  425 => 247,  422 => 338,  412 => 147,  406 => 111,  390 => 238,  383 => 112,  377 => 199,  375 => 230,  372 => 229,  370 => 222,  359 => 145,  356 => 269,  353 => 143,  349 => 220,  336 => 216,  332 => 215,  330 => 176,  318 => 90,  313 => 208,  291 => 141,  190 => 98,  321 => 254,  295 => 201,  274 => 71,  242 => 153,  236 => 177,  70 => 26,  170 => 95,  288 => 197,  284 => 89,  279 => 134,  275 => 148,  256 => 132,  250 => 66,  237 => 133,  232 => 136,  222 => 129,  191 => 104,  153 => 80,  150 => 35,  563 => 188,  560 => 187,  558 => 322,  553 => 309,  549 => 182,  543 => 179,  537 => 176,  532 => 223,  528 => 173,  525 => 311,  523 => 171,  518 => 292,  514 => 218,  511 => 217,  508 => 281,  501 => 294,  491 => 288,  487 => 156,  460 => 194,  455 => 141,  449 => 267,  442 => 259,  439 => 133,  436 => 183,  433 => 130,  426 => 258,  420 => 233,  415 => 121,  411 => 170,  405 => 118,  403 => 117,  380 => 107,  366 => 227,  354 => 102,  331 => 173,  325 => 94,  320 => 91,  317 => 209,  311 => 98,  308 => 206,  304 => 205,  272 => 81,  267 => 148,  249 => 142,  216 => 56,  155 => 82,  146 => 79,  126 => 13,  188 => 54,  181 => 90,  161 => 84,  110 => 58,  124 => 82,  692 => 373,  683 => 282,  678 => 279,  676 => 367,  666 => 126,  661 => 380,  656 => 358,  652 => 376,  645 => 215,  641 => 352,  635 => 376,  631 => 218,  625 => 361,  615 => 335,  607 => 363,  597 => 163,  590 => 202,  583 => 354,  579 => 353,  577 => 329,  575 => 352,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 139,  529 => 222,  524 => 90,  516 => 286,  510 => 78,  504 => 295,  500 => 88,  495 => 210,  490 => 154,  486 => 165,  482 => 317,  470 => 313,  464 => 272,  459 => 271,  452 => 191,  434 => 252,  421 => 90,  417 => 253,  400 => 116,  385 => 129,  361 => 207,  344 => 219,  339 => 137,  324 => 102,  310 => 86,  302 => 93,  296 => 200,  282 => 143,  259 => 151,  244 => 121,  231 => 123,  226 => 115,  215 => 63,  186 => 96,  152 => 54,  114 => 40,  104 => 48,  358 => 209,  351 => 101,  347 => 183,  343 => 264,  338 => 217,  327 => 108,  323 => 172,  319 => 164,  315 => 121,  301 => 204,  299 => 201,  293 => 177,  289 => 138,  281 => 74,  277 => 72,  271 => 70,  265 => 128,  262 => 68,  260 => 128,  257 => 126,  251 => 123,  248 => 122,  239 => 131,  228 => 75,  225 => 125,  213 => 127,  211 => 125,  197 => 101,  174 => 59,  148 => 92,  134 => 29,  127 => 56,  20 => 1,  270 => 146,  253 => 124,  233 => 117,  212 => 109,  210 => 126,  206 => 109,  202 => 52,  198 => 104,  192 => 98,  185 => 100,  180 => 105,  175 => 47,  172 => 59,  167 => 101,  165 => 40,  160 => 56,  137 => 61,  113 => 50,  100 => 60,  90 => 66,  81 => 53,  65 => 23,  129 => 71,  97 => 62,  77 => 55,  34 => 4,  53 => 20,  84 => 37,  58 => 12,  23 => 2,  480 => 205,  474 => 274,  469 => 271,  461 => 70,  457 => 124,  453 => 151,  444 => 185,  440 => 184,  437 => 244,  435 => 261,  430 => 153,  427 => 180,  423 => 256,  413 => 237,  409 => 327,  407 => 169,  402 => 241,  398 => 226,  393 => 239,  387 => 113,  384 => 237,  381 => 236,  379 => 110,  374 => 36,  368 => 215,  365 => 119,  362 => 146,  360 => 223,  355 => 27,  341 => 218,  337 => 180,  322 => 211,  314 => 186,  312 => 97,  309 => 118,  305 => 204,  298 => 159,  294 => 142,  285 => 152,  283 => 5,  278 => 142,  268 => 101,  264 => 147,  258 => 140,  252 => 143,  247 => 133,  241 => 62,  229 => 129,  220 => 123,  214 => 110,  177 => 93,  169 => 88,  140 => 73,  132 => 50,  128 => 63,  107 => 57,  61 => 22,  273 => 130,  269 => 129,  254 => 86,  243 => 134,  240 => 146,  238 => 61,  235 => 118,  230 => 116,  227 => 57,  224 => 74,  221 => 119,  219 => 60,  217 => 111,  208 => 54,  204 => 63,  179 => 98,  159 => 99,  143 => 74,  135 => 71,  119 => 73,  102 => 55,  71 => 25,  67 => 25,  63 => 40,  59 => 27,  28 => 7,  94 => 35,  89 => 24,  85 => 32,  75 => 13,  68 => 42,  56 => 21,  87 => 16,  201 => 105,  196 => 61,  183 => 106,  171 => 83,  166 => 107,  163 => 85,  158 => 83,  156 => 37,  151 => 79,  142 => 71,  138 => 69,  136 => 102,  121 => 54,  117 => 65,  105 => 56,  91 => 34,  62 => 23,  49 => 10,  25 => 5,  21 => 2,  31 => 7,  38 => 12,  26 => 6,  24 => 3,  19 => 1,  93 => 35,  88 => 33,  78 => 52,  46 => 7,  44 => 8,  27 => 6,  79 => 53,  72 => 44,  69 => 49,  47 => 21,  40 => 14,  37 => 13,  22 => 2,  246 => 78,  157 => 82,  145 => 72,  139 => 52,  131 => 64,  123 => 65,  120 => 74,  115 => 60,  111 => 32,  108 => 65,  101 => 31,  98 => 37,  96 => 36,  83 => 31,  74 => 26,  66 => 31,  55 => 29,  52 => 23,  50 => 8,  43 => 7,  41 => 14,  35 => 12,  32 => 2,  29 => 6,  209 => 108,  203 => 107,  199 => 51,  193 => 99,  189 => 47,  187 => 108,  182 => 95,  176 => 88,  173 => 43,  168 => 88,  164 => 85,  162 => 39,  154 => 69,  149 => 74,  147 => 45,  144 => 92,  141 => 62,  133 => 60,  130 => 40,  125 => 27,  122 => 26,  116 => 37,  112 => 51,  109 => 50,  106 => 49,  103 => 71,  99 => 54,  95 => 58,  92 => 42,  86 => 57,  82 => 37,  80 => 56,  73 => 18,  64 => 23,  60 => 35,  57 => 19,  54 => 14,  51 => 22,  48 => 18,  45 => 17,  42 => 12,  39 => 4,  36 => 6,  33 => 8,  30 => 4,);
    }
}
