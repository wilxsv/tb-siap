<?php

/* MinsalLaboratorioBundle:Custom:SecSolicitudestudios/examnResult.html.twig */
class __TwigTemplate_139a5fda4b074d66a3c996bfa20b4563c51a0dda95090494d77f5731aefc17bc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'sonata_header' => array($this, 'block_sonata_header'),
            'sonata_page_content_nav' => array($this, 'block_sonata_page_content_nav'),
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsallaboratorio/css/laboratorio.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 8
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 9
        echo "    ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == "false")) {
            // line 10
            echo "        ";
            $this->displayParentBlock("sonata_header", $context, $blocks);
            echo "
    ";
        }
    }

    // line 14
    public function block_sonata_page_content_nav($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == "false")) {
            // line 16
            echo "        ";
            $this->displayParentBlock("sonata_page_content_nav", $context, $blocks);
            echo "
    ";
        }
    }

    // line 20
    public function block_javascripts($context, array $blocks = array())
    {
        // line 21
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script type=\"text/javascript\">
        jQuery(document).ready(function(\$) {
            \$('#expand-compress-btn').on('click', function(){
                var eClass = \$(this).find('span').attr('class');
                if(eClass === 'fa fa-expand') {
                    \$('div[id^=\"collapse-exam-\"]').collapse('show');
                    \$(this).children('span').removeClass('fa fa-expand');
                    \$(this).children('span').addClass('fa fa-compress');
                } else {
                    \$('div[id^=\"collapse-exam-\"]').collapse('hide');
                    \$(this).children('span').removeClass('fa fa-compress');
                    \$(this).children('span').addClass('fa fa-expand');
                }
            });
        });
    </script>
";
    }

    // line 41
    public function block_content($context, array $blocks = array())
    {
        // line 42
        echo "    ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == "true")) {
            // line 43
            echo "        <div style=\"padding-bottom: 20px;\" class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"pull-right\">
                    <button type=\"button\" class=\"btn btn-info\" onclick=\"window.history.back();\"><i class=\"fa fa-fw fa-arrow-circle-left\"></i> Regresar</button>
                    <button type=\"button\" class=\"btn btn-default\" onclick=\"window.close();\"><i class=\"fa fa-fw fa-times-circle\"></i> &nbsp;Cerrar&nbsp;</button>
                </div>
            </div>
        </div>
    ";
        }
        // line 52
        echo "    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"box box-success\">
                    <div class=\"box-header\">
                        <h3 class=\"box-title full-width text-center\" style=\"color: #00A65A;font-weight: bold;\">
                            Datos Generales de la Solicitud
                            <div class=\"pull-right\" data-toggle=\"collapse\" data-target=\"#sol-info\" aria-expanded=\"false\" aria-controls=\"sol-info\"><span class=\"fa fa-minus\" style=\"padding-right:15px;\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Expandir/Contraer\"></span></div>
                        </h3>
                    </div>
                    <div class=\"box-body collapse in\" id=\"sol-info\">
                        <table class=\"table table-hover no-border\" id=\"datosGenerales\">
                            <tbody>
                                <tr>
                                    <td>Establecimiento: </td>
                                    <td>";
        // line 67
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "datosGenerales"), "nombre_establecimiento"), "html", null, true);
        echo "</td>
                                </tr>
                                <tr>
                                    <td>Procedencia: </td>
                                    <td>";
        // line 71
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "datosGenerales"), "procedencia"), "html", null, true);
        echo "</td>
                                </tr>
                                <tr>
                                    <td>Origen: </td>
                                    <td>";
        // line 75
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "datosGenerales"), "servicio"), "html", null, true);
        echo "</td>
                                </tr>
                                <tr>
                                    <td>M&eacute;dico: </td>
                                    <td>";
        // line 79
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "datosGenerales"), "nombre_empleado"), "html", null, true);
        echo "</td>
                                </tr>
                                <tr>
                                    <td>No. Expediente: </td>
                                    <td>";
        // line 83
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "datosGenerales"), "numero_expediente"), "html", null, true);
        echo "</td>
                                </tr>
                                <tr>
                                    <td>Nombre Paciente: </td>
                                    <td>";
        // line 87
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "datosGenerales"), "nombre_paciente"), "html", null, true);
        echo "</td>
                                </tr>
                                <tr>
                                    <td>Fecha de Solicitud: </td>
                                    <td>";
        // line 91
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "datosGenerales"), "fecha_solicitud"), "html", null, true);
        echo "</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--div class=\"box-footer\"></div-->
                </div>
            </div>
            <div class=\"col-md-12\">
                <div class=\"box box-warning\">
                    <div class=\"box-header\">
                        <h3 class=\"box-title full-width text-center\" style=\"color: #F39C12; font-weight: bold;\">Pruebas Rechazadas</h3>
                    </div>
                    <div class=\"box-body\">
                        <table class=\"table table-condensed table-hover\">
                            <thead class=\"th-background\">
                                <tr>
                                    <th>Nombre del Examen</th>
                                    <th>Estado</th>
                                    <th>Motivo de Rechazo</th>
                                </tr>
                            </thead>
                            <tbody class=\"tb-background\">
                                ";
        // line 114
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "result"), "RM")) > 0)) {
            // line 115
            echo "                                    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "result"), "RM"));
            foreach ($context['_seq'] as $context["_key"] => $context["examen"]) {
                // line 116
                echo "                                        <tr>
                                            <td>";
                // line 117
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "nombre"), "html", null, true);
                echo "</td>
                                            <td>";
                // line 118
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "nombre_estado_rechazo"), "html", null, true);
                echo "</td>
                                            <td>";
                // line 119
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "nombre_observacion_rechazo"), "html", null, true);
                echo "</td>
                                        </tr>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['examen'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 122
            echo "                                ";
        } else {
            // line 123
            echo "                                    <tr><td>No existen examenes para mostrar...</td></tr>
                                ";
        }
        // line 125
        echo "                            </tbody>
                        </table>
                    </div>
                    <!--div class=\"box-footer\"></div-->
                </div>
            </div>
            <div class=\"col-md-12\">
                <div class=\"box box-primary\">
                    <div class=\"box-header\">
                        <h2 class=\"box-title full-width text-center\" style=\"color: #3C8DBC;font-weight: bold;\">Resultados de Examens de Laboratorio. ";
        // line 134
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "result"), "RC")) > 0)) {
            echo "<div class=\"pull-right mouse-pointer\" id=\"expand-compress-btn\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Expandir/Contraer resultados\"><span class=\"fa fa-expand\" style=\"padding-right:15px;\"></span></div>";
        }
        echo "</h2>
                    </div>
                    <div class=\"box-body\">
                        <div class=\"panel-group collapsed\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">
                            ";
        // line 138
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "result"), "RC")) > 0)) {
            // line 139
            echo "                                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "result"), "RC"));
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
            foreach ($context['_seq'] as $context["_key"] => $context["area"]) {
                // line 140
                echo "                                    ";
                if ($this->getAttribute($this->getAttribute((isset($context["area"]) ? $context["area"] : null), "plantillas", array(), "any", false, true), "A", array(), "array", true, true)) {
                    // line 141
                    echo "                                        ";
                    $context["length"] = twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "plantillas"), "A", array(), "array"), "examenes", array(), "array"));
                    // line 142
                    echo "                                    ";
                } else {
                    // line 143
                    echo "                                        ";
                    $context["length"] = 0;
                    // line 144
                    echo "                                    ";
                }
                // line 145
                echo "                                    ";
                $context["count"] = array("A" => 1);
                // line 146
                echo "
                                    ";
                // line 147
                $context["count"] = twig_array_merge((isset($context["count"]) ? $context["count"] : $this->getContext($context, "count")), array("B" => ((isset($context["length"]) ? $context["length"] : $this->getContext($context, "length")) + 1)));
                // line 148
                echo "
                                    ";
                // line 149
                if ($this->getAttribute($this->getAttribute((isset($context["area"]) ? $context["area"] : null), "plantillas", array(), "any", false, true), "B", array(), "array", true, true)) {
                    // line 150
                    echo "                                        ";
                    $context["lengthCurrent"] = twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "plantillas"), "B", array(), "array"), "examenes", array(), "array"));
                    // line 151
                    echo "                                    ";
                } else {
                    // line 152
                    echo "                                        ";
                    $context["lengthCurrent"] = 0;
                    // line 153
                    echo "                                    ";
                }
                // line 154
                echo "                                    ";
                $context["length"] = ((isset($context["length"]) ? $context["length"] : $this->getContext($context, "length")) + (isset($context["lengthCurrent"]) ? $context["lengthCurrent"] : $this->getContext($context, "lengthCurrent")));
                // line 155
                echo "
                                    ";
                // line 156
                $context["count"] = twig_array_merge((isset($context["count"]) ? $context["count"] : $this->getContext($context, "count")), array("C" => ((isset($context["length"]) ? $context["length"] : $this->getContext($context, "length")) + 1)));
                // line 157
                echo "                                    ";
                if ($this->getAttribute($this->getAttribute((isset($context["area"]) ? $context["area"] : null), "plantillas", array(), "any", false, true), "C", array(), "array", true, true)) {
                    // line 158
                    echo "                                        ";
                    $context["lengthCurrent"] = twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "plantillas"), "C", array(), "array"), "examenes", array(), "array"));
                    // line 159
                    echo "                                    ";
                } else {
                    // line 160
                    echo "                                        ";
                    $context["lengthCurrent"] = 0;
                    // line 161
                    echo "                                    ";
                }
                // line 162
                echo "                                    ";
                $context["length"] = ((isset($context["length"]) ? $context["length"] : $this->getContext($context, "length")) + (isset($context["lengthCurrent"]) ? $context["lengthCurrent"] : $this->getContext($context, "lengthCurrent")));
                // line 163
                echo "
                                    ";
                // line 164
                $context["count"] = twig_array_merge((isset($context["count"]) ? $context["count"] : $this->getContext($context, "count")), array("D" => ((isset($context["length"]) ? $context["length"] : $this->getContext($context, "length")) + 1)));
                // line 165
                echo "                                    ";
                if ($this->getAttribute($this->getAttribute((isset($context["area"]) ? $context["area"] : null), "plantillas", array(), "any", false, true), "D", array(), "array", true, true)) {
                    // line 166
                    echo "                                        ";
                    $context["lengthCurrent"] = twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "plantillas"), "D", array(), "array"), "examenes", array(), "array"));
                    // line 167
                    echo "                                    ";
                } else {
                    // line 168
                    echo "                                        ";
                    $context["lengthCurrent"] = 0;
                    // line 169
                    echo "                                    ";
                }
                // line 170
                echo "                                    ";
                $context["length"] = ((isset($context["length"]) ? $context["length"] : $this->getContext($context, "length")) + (isset($context["lengthCurrent"]) ? $context["lengthCurrent"] : $this->getContext($context, "lengthCurrent")));
                // line 171
                echo "
                                    ";
                // line 172
                $context["count"] = twig_array_merge((isset($context["count"]) ? $context["count"] : $this->getContext($context, "count")), array("E" => ((isset($context["length"]) ? $context["length"] : $this->getContext($context, "length")) + 1)));
                // line 173
                echo "
                                    <div class=\"panel panel-primary\">
                                        <div class=\"panel-heading mouse-pointer\" role=\"tab\" id=\"heading-";
                // line 175
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "codigo"), "html", null, true);
                echo "\" data-toggle=\"collapse\" data-target=\"#area-";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "codigo"), "html", null, true);
                echo "\" aria-expanded=\"false\" aria-controls=\"area-";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "codigo"), "html", null, true);
                echo "\">
                                            <h4 class=\"panel-title\">
                                                ";
                // line 177
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "nombre"), "html", null, true);
                echo "
                                            </h4>
                                        </div>
                                        <div id=\"area-";
                // line 180
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "codigo"), "html", null, true);
                echo "\" class=\"panel-collapse collapse in\" role=\"tabpanel\" aria-labelledby=\"heading-area-";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "codigo"), "html", null, true);
                echo "\">
                                            <div class=\"panel-body\">
                                                <div class=\"table-responsive\">
                                                    ";
                // line 184
                echo "                                                    ";
                $context["arrayPlantillas"] = array(0 => "A", 1 => "B", 2 => "C", 3 => "E");
                // line 185
                echo "                                                    ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["arrayPlantillas"]) ? $context["arrayPlantillas"] : $this->getContext($context, "arrayPlantillas")));
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
                foreach ($context['_seq'] as $context["_key"] => $context["pType"]) {
                    // line 186
                    echo "                                                        ";
                    if ($this->getAttribute($this->getAttribute((isset($context["area"]) ? $context["area"] : null), "plantillas", array(), "any", false, true), (isset($context["pType"]) ? $context["pType"] : $this->getContext($context, "pType")), array(), "array", true, true)) {
                        // line 187
                        echo "                                                            ";
                        $this->env->loadTemplate("MinsalLaboratorioBundle:Custom:SecSolicitudestudios/bodyLayout.html.twig")->display(array_merge($context, array("pType" => (isset($context["pType"]) ? $context["pType"] : $this->getContext($context, "pType")))));
                        // line 188
                        echo "                                                        ";
                    }
                    // line 189
                    echo "                                                    ";
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
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pType'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 190
                echo "                                                </div>
                                            </div>
                                        </div>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['area'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 195
            echo "                            ";
        } else {
            // line 196
            echo "                                <div class=\"alert alert-info alert-dismissable\">
                                    <span class=\"fa fa-info\"></span>
                                    <b>Los examenes no han sido procesados aun...</b>
                                </div>
                            ";
        }
        // line 201
        echo "                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalLaboratorioBundle:Custom:SecSolicitudestudios/examnResult.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  470 => 201,  463 => 196,  460 => 195,  442 => 190,  428 => 189,  425 => 188,  422 => 187,  419 => 186,  401 => 185,  398 => 184,  390 => 180,  384 => 177,  375 => 175,  371 => 173,  369 => 172,  366 => 171,  363 => 170,  360 => 169,  357 => 168,  354 => 167,  351 => 166,  348 => 165,  346 => 164,  343 => 163,  340 => 162,  337 => 161,  334 => 160,  331 => 159,  328 => 158,  325 => 157,  323 => 156,  320 => 155,  317 => 154,  314 => 153,  311 => 152,  308 => 151,  305 => 150,  303 => 149,  300 => 148,  298 => 147,  295 => 146,  292 => 145,  289 => 144,  286 => 143,  283 => 142,  280 => 141,  277 => 140,  259 => 139,  257 => 138,  248 => 134,  237 => 125,  233 => 123,  230 => 122,  221 => 119,  217 => 118,  213 => 117,  210 => 116,  205 => 115,  203 => 114,  177 => 91,  170 => 87,  163 => 83,  156 => 79,  149 => 75,  142 => 71,  135 => 67,  118 => 52,  107 => 43,  104 => 42,  101 => 41,  77 => 21,  74 => 20,  66 => 16,  63 => 15,  60 => 14,  52 => 10,  49 => 9,  46 => 8,  40 => 5,  35 => 4,  32 => 3,);
    }
}
