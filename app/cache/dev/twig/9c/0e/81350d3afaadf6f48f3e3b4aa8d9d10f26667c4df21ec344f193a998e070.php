<?php

/* MinsalSeguimientoBundle:SecHistorialClinico:body_show.html.twig */
class __TwigTemplate_9c0e81350d3afaadf6f48f3e3b4aa8d9d10f26667c4df21ec344f193a998e070 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
            // line 2
            echo "<div class=\"panel panel-info\">
    <div class=\"table-responsive\" style=\"overflow-x: auto;\">
        <table class=\"";
            // line 4
            if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
                echo " table table-hover ";
            }
            echo " table-bordered\">
            <tbody>
                <tr class=\"sonata-ba-view-container\">
                    <th style=\"min-width: 250px;\">Fecha de Consulta:</th>
                    <td><span>";
            // line 8
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "fechaconsulta"), "d-m-Y"), "html", null, true);
            echo "</span></td>
                </tr>
                <tr class=\"sonata-ba-view-container\">
                    <th style=\"min-width: 250px;\">Medico:</th>
                    <td><span>";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEmpleado", array(), "method"), "nombreempleado"), "html", null, true);
            echo "</span></td>
                </tr>
                <tr class=\"sonata-ba-view-container\">
                    <th style=\"min-width: 250px;\">Especialidad:</th>
                    <td><span>";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdAtenAreaModEstab", array(), "method"), "getNombreConsulta", array(), "method"), "html", null, true);
            echo "</span></td>
                </tr>
                ";
            // line 18
            if ($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getHistorialLugar", array(), "method")) {
                // line 19
                echo "                    <tr class=\"sonata-ba-view-container\">
                        <th>Lugar de Realización:</th>
                        <td>";
                // line 21
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getHistorialLugar", array(), "method"), "html", null, true);
                echo "</td>
                    <tr/>
                ";
            }
            // line 24
            echo "            </tbody>
        </table>
    </div>
</div>
";
        } else {
            // line 29
            echo "<!-- DATOS DE LA CONSULTA -->
<div class=\"panel panel-info\">
    <div class=\"panel-heading\"><b>Datos de la Consulta</b> ";
            // line 32
            echo "    </div>
    <table class=\"";
            // line 33
            if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
                echo " table table-hover ";
            }
            echo " table-bordered\">
            <tr class=\"sonata-ba-view-container\">
                <th >Fecha Consulta:</th>
                <td>";
            // line 36
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "fechaconsulta"), "d-m-Y"), "html", null, true);
            echo "</td>
                <th >Especialidad:</th>
                <td><span> ";
            // line 38
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idAtenAreaModEstab"), "getNombreConsulta", array(), "method"), "html", null, true);
            echo " </span></td>
                ";
            // line 39
            if ($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getHistorialLugar", array(), "method")) {
                // line 40
                echo "                    <th>Lugar de Realización:</th>
                    <td>";
                // line 41
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getHistorialLugar", array(), "method"), "html", null, true);
                echo "</td>
                ";
            }
            // line 43
            echo "            </tr>
    </table>
</div>
";
        }
        // line 47
        echo "<!-- Motivo de Consulta -->
<div class=\"panel panel-info\">
    <div class=\"panel-heading\"><b >Motivo de Consulta</b> ";
        // line 50
        echo "    </div>
    <div class=\"table-responsive\" style=\"overflow-x: auto;\">
        <table class=\"";
        // line 52
        if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
            echo " table table-hover ";
        }
        echo " table-bordered\">
            <tbody>
                <tr class=\"sonata-ba-view-container\">
                    <th style=\"min-width: 400px;\">Consulta por:</th>
                    <td><span>";
        // line 56
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdMotivoConsulta", array(), "method")) ? ($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdMotivoConsulta", array(), "method"), "consultaPor")) : ("No hay registro")), "html", null, true);
        echo "</span></td>
                </tr>
                <tr class=\"sonata-ba-view-container\">
                    <th style=\"min-width: 400px;\">Presenta Enfermedad:</th>
                    <td><span>";
        // line 60
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdMotivoConsulta", array(), "method")) ? ($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdMotivoConsulta", array(), "method"), "presentaEnfermedad")) : ("No hay registro")), "html", null, true);
        echo "</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Sección del Formulario -->
";
        // line 67
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["savedData"]) ? $context["savedData"] : $this->getContext($context, "savedData")));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            echo " ";
            // line 68
            $context["colspan"] = "2";
            // line 69
            echo "<div class=\"panel panel-info\">
    <div class=\"panel-heading\"><b >";
            // line 70
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "name"), "html", null, true);
            echo "</b> ";
            // line 71
            echo "    </div>
    ";
            // line 72
            if (($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "name") != "Signos Vitales")) {
                // line 73
                echo "    <div class=\"table-responsive\" style=\"overflow-x: auto;\">
        <table class=\"";
                // line 74
                if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
                    echo " table table-hover ";
                }
                echo " table-bordered\" >
            <tbody>
                ";
                // line 76
                if ($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "isCollection")) {
                    echo " ";
                    // line 77
                    echo "                    ";
                    if (($this->getAttribute((isset($context["section"]) ? $context["section"] : null), "collection", array(), "any", true, true) && (twig_length_filter($this->env, $this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "collection")) > 0))) {
                        // line 78
                        echo "                        ";
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "collection"));
                        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                            echo " ";
                            // line 79
                            echo "                            <tr class=\"sonata-ba-view-container\">
                                ";
                            // line 80
                            $context['_parent'] = (array) $context;
                            $context['_seq'] = twig_ensure_traversable((isset($context["row"]) ? $context["row"] : $this->getContext($context, "row")));
                            foreach ($context['_seq'] as $context["item"] => $context["data"]) {
                                echo " ";
                                // line 81
                                echo "                                    <th>";
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "name"), "html", null, true);
                                echo "</th>
                                    <td>";
                                // line 82
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                                echo "</td>
                                ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['item'], $context['data'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 84
                            echo "                            </tr>
                        ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 86
                        echo "                    ";
                    } else {
                        // line 87
                        echo "                        <tr><td><p class=\"text-muted\">No hay registros para mostrar.</p></td></tr>
                    ";
                    }
                    // line 89
                    echo "                ";
                } else {
                    // line 90
                    echo "                    ";
                    if (($this->getAttribute((isset($context["section"]) ? $context["section"] : null), "items", array(), "any", true, true) && (twig_length_filter($this->env, $this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "items")) > 0))) {
                        // line 91
                        echo "                        ";
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "items"));
                        foreach ($context['_seq'] as $context["item"] => $context["data"]) {
                            echo " ";
                            // line 92
                            echo "                            ";
                            if (((isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")) == "2")) {
                                // line 93
                                echo "                                <tr class=\"sonata-ba-view-container\">
                            ";
                            }
                            // line 95
                            echo "                                ";
                            if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "multiple", array(), "any", true, true)) {
                                echo "  ";
                                // line 96
                                echo "                                    <th style=\"min-width: 400px; padding-left: ";
                                echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "level") * 10), "html", null, true);
                                echo "px;\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "name"), "html", null, true);
                                echo "</th>
                                    <td>
                                        ";
                                // line 98
                                if ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "hideTitle")) {
                                    // line 99
                                    echo "                                            ";
                                    if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "value")) > 0)) {
                                        // line 100
                                        echo "                                                ";
                                        $context["answer"] = "Sí";
                                        // line 101
                                        echo "                                            ";
                                    } else {
                                        // line 102
                                        echo "                                                ";
                                        $context["answer"] = "No";
                                        // line 103
                                        echo "                                            ";
                                    }
                                    // line 104
                                    echo "
                                            ";
                                    // line 105
                                    echo twig_escape_filter($this->env, (isset($context["answer"]) ? $context["answer"] : $this->getContext($context, "answer")), "html", null, true);
                                    echo "
                                        ";
                                } else {
                                    // line 107
                                    echo "                                            <ul>
                                                ";
                                    // line 108
                                    $context['_parent'] = (array) $context;
                                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "value"));
                                    foreach ($context['_seq'] as $context["_key"] => $context["subData"]) {
                                        // line 109
                                        echo "                                                    <li>";
                                        echo twig_escape_filter($this->env, (isset($context["subData"]) ? $context["subData"] : $this->getContext($context, "subData")), "html", null, true);
                                        echo "</li>
                                                ";
                                    }
                                    $_parent = $context['_parent'];
                                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subData'], $context['_parent'], $context['loop']);
                                    $context = array_intersect_key($context, $_parent) + $_parent;
                                    // line 111
                                    echo "                                            </ul>
                                        ";
                                }
                                // line 113
                                echo "
                                    </td>
                                ";
                            } else {
                                // line 115
                                echo " ";
                                // line 116
                                echo "                                    ";
                                if ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "hideTitle")) {
                                    // line 117
                                    echo "                                        ";
                                    if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "itemObject"), "getIdFormItem", array(), "method"), "getIdTipoObjeto", array(), "method"), "getId", array(), "method") == 3)) {
                                        // line 118
                                        echo "                                            ";
                                        $context["colspan"] = "1";
                                        // line 119
                                        echo "                                            <th colspan=\"";
                                        echo twig_escape_filter($this->env, (isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")), "html", null, true);
                                        echo "\" style=\"min-width: 400px; padding-left: ";
                                        echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "level") * 10), "html", null, true);
                                        echo "px;\">";
                                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "name"), "html", null, true);
                                        echo "</th>
                                        ";
                                    } else {
                                        // line 121
                                        echo "                                            <td colspan=\"";
                                        echo twig_escape_filter($this->env, (isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")), "html", null, true);
                                        echo "\" style=\"min-width: 250px;\">";
                                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                                        echo "</td>
                                            ";
                                        // line 122
                                        $context["colspan"] = "2";
                                        // line 123
                                        echo "                                            <!-- <td><span>";
                                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                                        echo "</span></td> -->
                                        ";
                                    }
                                    // line 125
                                    echo "                                    ";
                                } else {
                                    // line 126
                                    echo "                                        ";
                                    if (((isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")) == "1")) {
                                        // line 127
                                        echo "                                                <td colspan=\"";
                                        echo twig_escape_filter($this->env, (isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")), "html", null, true);
                                        echo "\" style=\"min-width: 250px;\"></td>
                                            </tr>
                                            <tr class=\"sonata-ba-view-container\">
                                            ";
                                        // line 130
                                        $context["colspan"] = "2";
                                        // line 131
                                        echo "                                        ";
                                    }
                                    // line 132
                                    echo "                                        <th style=\"min-width: 400px; padding-left: ";
                                    echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "level") * 10), "html", null, true);
                                    echo "px;\">";
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "name"), "html", null, true);
                                    echo "</th>
                                        <td><span>";
                                    // line 133
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                                    echo "</span></td>
                                    ";
                                }
                                // line 135
                                echo "                                ";
                            }
                            // line 136
                            echo "                            ";
                            if (((isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")) == "2")) {
                                // line 137
                                echo "                                </tr>
                            ";
                            }
                            // line 139
                            echo "                        ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['item'], $context['data'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 140
                        echo "                    ";
                    } else {
                        // line 141
                        echo "                        <tr><td><p class=\"text-muted\">No hay registros para mostrar.</p></td></tr>
                    ";
                    }
                    // line 143
                    echo "                ";
                }
                // line 144
                echo "            </tbody>
        </table>
    </div>
    ";
            } else {
                // line 148
                echo "    <div class=\"table-responsive\" style=\"overflow-x: auto;\">
        <table class=\"";
                // line 149
                if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
                    echo " table table-hover ";
                }
                echo " table-bordered\" >
            <tbody>
                ";
                // line 151
                $context["i"] = 1;
                // line 152
                echo "                ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "items"));
                foreach ($context['_seq'] as $context["item"] => $context["data"]) {
                    echo " ";
                    // line 153
                    echo "                    ";
                    if (((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) == 1)) {
                        // line 154
                        echo "                        <tr class=\"sonata-ba-view-container\">
                    ";
                    }
                    // line 156
                    echo "                        <th colspan=\"2\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "name"), "html", null, true);
                    echo "</th>
                        <td><span>";
                    // line 157
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                    echo "</span></td>
                    ";
                    // line 158
                    if (((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) == 3)) {
                        // line 159
                        echo "                        </tr>
                    ";
                    }
                    // line 161
                    echo "                    ";
                    $context["i"] = ((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) + 1);
                    // line 162
                    echo "                    ";
                    if (((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) > 3)) {
                        // line 163
                        echo "                    ";
                        $context["i"] = 1;
                        // line 164
                        echo "                    ";
                    }
                    // line 165
                    echo "
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['item'], $context['data'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 167
                echo "                ";
                if (((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) != 1)) {
                    // line 168
                    echo "                ";
                    if (((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) < 3)) {
                        // line 169
                        echo "                    </tr>
                    ";
                    }
                    // line 171
                    echo "                ";
                }
                // line 172
                echo "                <tr class=\"sonata-ba-view-container\">
                    <th colspan=\"2\">IMC:</th>
                    <td><span>";
                // line 174
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["imc"]) ? $context["imc"] : $this->getContext($context, "imc")), "valor", array(), "array"), "html", null, true);
                echo "</span><td>
                    ";
                // line 175
                if ((null === $this->getAttribute((isset($context["imc"]) ? $context["imc"] : $this->getContext($context, "imc")), "clasificacion", array(), "array"))) {
                    // line 176
                    echo "                        <td colspan=\"6\"></td>
                    ";
                } else {
                    // line 178
                    echo "                        <th colspan=\"2\">Clasificación:</th>
                        <td>";
                    // line 179
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["imc"]) ? $context["imc"] : $this->getContext($context, "imc")), "clasificacion", array(), "array"), "html", null, true);
                    echo "</td>
                    ";
                }
                // line 181
                echo "                </tr>
            </tbody>
        </table>
    </div>
    ";
            }
            // line 186
            echo "</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 188
        echo "
";
        // line 189
        $this->env->loadTemplate("MinsalLaboratorioBundle:Custom:SecSolicitudestudios/body_solicitudestudio.html.twig")->display($context);
        // line 190
        $this->env->loadTemplate("MinsalFarmaciaBundle:FarmRecetas:body_plan_atencion.html.twig")->display($context);
        // line 191
        $this->env->loadTemplate("MinsalSeguimientoBundle:Reportes:SecHistorialClinico/body_consejeria.html.twig")->display($context);
        // line 192
        $this->env->loadTemplate("MinsalSeguimientoBundle:Reportes:SecHistorialClinico/body_datos_embarazo.html.twig")->display($context);
        // line 193
        $this->env->loadTemplate("MinsalSeguimientoBundle:Reportes:SecHistorialClinico/body_plan_ingresos.html.twig")->display($context);
        // line 194
        $this->env->loadTemplate("MinsalSeguimientoBundle:Reportes:SecHistorialClinico/body_seguimiento_consulta.html.twig")->display($context);
        // line 195
        echo "
                <!-- Consejería -->
                <!--<div class=\"panel panel-info\">
                    <div class=\"panel-heading\"><b >Consejería</b> ";
        // line 199
        echo "                    </div>
                    <div class=\"table-responsive\" style=\"overflow-x: auto;\">
                        <table class=\"";
        // line 201
        if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
            echo " table table-hover ";
        }
        echo " table-bordered\">
                            <tbody>
                                ";
        // line 203
        if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "consejeriaBrindada")) {
            // line 204
            echo "                                <tr>
                                    <td colspan=\"4\" style=\"text-align: center;\">
                                        ";
            // line 206
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "consejeriaBrindada"));
            foreach ($context['_seq'] as $context["_key"] => $context["consejo"]) {
                // line 207
                echo "                                        <blockquote class=\"\" style=\"text-align: left; font-size: 15px; padding-left: 10px; border-left: 5px solid #D8EAF0 !important; border: 1px solid #F2F2F2;\">
                                            <p class=\"text-";
                // line 208
                if (($this->getAttribute($this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdTipoConsejeria", array(), "method"), "getId", array(), "method") == 1)) {
                    echo "success";
                } elseif (($this->getAttribute($this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdTipoConsejeria", array(), "method"), "getId", array(), "method") == 2)) {
                    echo "primary";
                } else {
                    echo "info";
                }
                echo "\"><b>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdTipoConsejeria", array(), "method"), "getNombre", array(), "method"), "html", null, true);
                echo ",</b></p>
                                            ";
                // line 209
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getConsejo", array(), "method"), "html", null, true);
                echo "
                                            <small>Brindada por: ";
                // line 210
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdEmpleado", array(), "method"), "html", null, true);
                echo "</small>
                                        </blockquote>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['consejo'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 213
            echo "                                    </td>
                                </tr>
                                ";
        }
        // line 216
        echo "                            </tbody>
                        </table>
                    </div>
                </div>-->
                <!-- Seguimiento de consulta -->
                <!--<div class=\"panel panel-info\">
                    <div class=\"panel-heading\"><b >Seguimiento de Consulta</b> ";
        // line 223
        echo "                    </div>
                    <div class=\"table-responsive\" style=\"overflow-x: auto;\">
                        <table class=\"";
        // line 225
        if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
            echo " table table-hover ";
        }
        echo " table-bordered\" >
                            <tbody>
                                <tr class=\"sonata-ba-view-container\">
                                    <td><span>
                                        ";
        // line 229
        if ((isset($context["citasAsignadas"]) ? $context["citasAsignadas"] : $this->getContext($context, "citasAsignadas"))) {
            // line 230
            echo "                                        <ul>
                                            ";
            // line 231
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["citasAsignadas"]) ? $context["citasAsignadas"] : $this->getContext($context, "citasAsignadas")));
            foreach ($context['_seq'] as $context["_key"] => $context["citas"]) {
                // line 232
                echo "                                            <li><strong>";
                echo twig_escape_filter($this->env, ("Cita de " . $this->getAttribute($this->getAttribute((isset($context["citas"]) ? $context["citas"] : $this->getContext($context, "citas")), "getIdTipoCitaSubsecuente", array(), "method"), "nombre")), "html", null, true);
                echo "</strong>:";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["citas"]) ? $context["citas"] : $this->getContext($context, "citas")), "getIdCitaDia", array(), "method"), "fecha"), "d-M-Y"), "html", null, true);
                echo "</li>
                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['citas'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 234
            echo "                                        </ul>
                                        ";
        } else {
            // line 236
            echo "                                        <p class=\"text-muted\">No hay registros para mostrar.</p>
                                        ";
        }
        // line 238
        echo "                                    </span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>-->
";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecHistorialClinico:body_show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  631 => 238,  627 => 236,  623 => 234,  612 => 232,  608 => 231,  605 => 230,  603 => 229,  594 => 225,  590 => 223,  582 => 216,  577 => 213,  568 => 210,  564 => 209,  552 => 208,  549 => 207,  545 => 206,  541 => 204,  539 => 203,  532 => 201,  528 => 199,  523 => 195,  521 => 194,  519 => 193,  517 => 192,  515 => 191,  513 => 190,  511 => 189,  508 => 188,  501 => 186,  494 => 181,  489 => 179,  486 => 178,  482 => 176,  480 => 175,  476 => 174,  472 => 172,  469 => 171,  465 => 169,  462 => 168,  459 => 167,  452 => 165,  449 => 164,  446 => 163,  443 => 162,  440 => 161,  436 => 159,  434 => 158,  430 => 157,  425 => 156,  421 => 154,  418 => 153,  412 => 152,  410 => 151,  403 => 149,  400 => 148,  394 => 144,  391 => 143,  387 => 141,  384 => 140,  378 => 139,  374 => 137,  371 => 136,  368 => 135,  363 => 133,  356 => 132,  353 => 131,  351 => 130,  344 => 127,  341 => 126,  338 => 125,  332 => 123,  330 => 122,  323 => 121,  313 => 119,  310 => 118,  307 => 117,  304 => 116,  302 => 115,  297 => 113,  293 => 111,  284 => 109,  280 => 108,  277 => 107,  272 => 105,  269 => 104,  266 => 103,  263 => 102,  260 => 101,  257 => 100,  254 => 99,  252 => 98,  244 => 96,  240 => 95,  236 => 93,  233 => 92,  227 => 91,  224 => 90,  221 => 89,  217 => 87,  214 => 86,  207 => 84,  199 => 82,  194 => 81,  189 => 80,  186 => 79,  180 => 78,  177 => 77,  174 => 76,  167 => 74,  164 => 73,  162 => 72,  159 => 71,  156 => 70,  153 => 69,  151 => 68,  146 => 67,  136 => 60,  129 => 56,  116 => 50,  112 => 47,  106 => 43,  101 => 41,  96 => 39,  92 => 38,  87 => 36,  79 => 33,  76 => 32,  72 => 29,  65 => 24,  59 => 21,  55 => 19,  53 => 18,  48 => 16,  41 => 12,  34 => 8,  25 => 4,  21 => 2,  19 => 1,  137 => 65,  125 => 55,  123 => 54,  120 => 52,  117 => 52,  111 => 48,  107 => 46,  102 => 44,  98 => 40,  94 => 42,  89 => 41,  86 => 40,  83 => 39,  71 => 30,  67 => 29,  45 => 10,  42 => 9,  35 => 5,  33 => 4,  30 => 3,);
    }
}
