<?php

/* MinsalLaboratorioBundle:Custom:SecSolicitudestudios/body_solicitudestudio.html.twig */
class __TwigTemplate_20067baf0c43fbc05ef252e55e48e2a249404ec71aa402dbc1b0a6ab0a119216 extends Twig_Template
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
        if ($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "solicitudEstudio", array(), "any", false, true), "setFalseHistoryId", array(), "any", true, true)) {
            // line 2
            echo "    ";
            if ($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "solicitudEstudio"), "setFalseHistoryId")) {
                // line 3
                echo "        ";
                $context["history"] = $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "solicitudEstudio"), "falseHistory");
                // line 4
                echo "    ";
            } else {
                // line 5
                echo "        ";
                $context["history"] = (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"));
                // line 6
                echo "    ";
            }
        } else {
            // line 8
            echo "    ";
            $context["history"] = (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"));
        }
        // line 10
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "solicitudEstudio"), "laboratorio")) > 0)) {
            // line 11
            echo "<div class=\"panel panel-info\">
    <div class=\"panel-heading\"><b>Solicitud de Estudio de Laboratorio</b>
    ";
            // line 13
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "solicitudEstudio"), "laboratorio")) > 0)) {
                // line 14
                echo "        ";
                if ((!array_key_exists("impresion", $context))) {
                    // line 15
                    echo "            ";
                    $context["impresion"] = false;
                    // line 16
                    echo "        ";
                }
                // line 17
                echo "        ";
                if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) == false)) {
                    // line 18
                    echo "            <a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_minsal_laboratorio_secsolicitudestudios_show", array("id" => $this->getAttribute((isset($context["history"]) ? $context["history"] : $this->getContext($context, "history")), "getId", array(), "method"), "idEstablecimiento" => $this->getAttribute($this->getAttribute((isset($context["history"]) ? $context["history"] : $this->getContext($context, "history")), "getIdEstablecimiento", array(), "method"), "getId", array(), "method"), "external" => "true")), "html", null, true);
                    echo "\" target=\"_blank\" class=\"pull-right\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ver Resultados de Examenes\"><span class=\"fa fa-search-plus\"></span> <strong>Ver Resultados</strong></a>
            <a href=\"";
                    // line 19
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_minsal_laboratorio_secsolicitudestudios_imprimir_solicitudestudios", array("idHistorialClinico" => $this->getAttribute((isset($context["history"]) ? $context["history"] : $this->getContext($context, "history")), "getId", array(), "method"))), "html", null, true);
                    echo "\" target=\"_blank\" class=\"pull-right\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Imprimir Solicitud Estudio\" style=\"margin-right: 15px;\"><span class=\"fa fa-print\"></span> <strong>Imprimir</strong></a>
        ";
                }
                // line 21
                echo "    ";
            }
            // line 22
            echo "    </div>
    <div class=\"table-responsive\" style=\"overflow-x: auto;\">
        ";
            // line 24
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "solicitudEstudio"), "laboratorio")) > 0)) {
                // line 25
                echo "        <table class=\"";
                if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
                    echo " table table-hover ";
                }
                echo " table-bordered\" ";
                if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) == true)) {
                    echo "style=\"font-size: 12px;\"";
                }
                echo ">
            <tbody>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre del Examen</th>
                    <th>Tipo de Muestra</th>
                    <th>Origen</th>
                    <th>Indicacion</th>
                    <th>Urgente</th>
                </tr>
                ";
                // line 35
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "solicitudEstudio"), "laboratorio"));
                foreach ($context['_seq'] as $context["_key"] => $context["exam"]) {
                    // line 36
                    echo "                <tr>
                    <td>";
                    // line 37
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exam"]) ? $context["exam"] : $this->getContext($context, "exam")), "codigoexamen"), "html", null, true);
                    echo "</td>
                    <td>";
                    // line 38
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exam"]) ? $context["exam"] : $this->getContext($context, "exam")), "nombreexamen"), "html", null, true);
                    echo "</td>
                    <td>";
                    // line 39
                    echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["exam"]) ? $context["exam"] : $this->getContext($context, "exam")), "nombremuestra")) ? ($this->getAttribute((isset($context["exam"]) ? $context["exam"] : $this->getContext($context, "exam")), "nombremuestra")) : ("-")), "html", null, true);
                    echo "</td>
                    <td>";
                    // line 40
                    echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["exam"]) ? $context["exam"] : $this->getContext($context, "exam")), "nombreorigenmuestra")) ? ($this->getAttribute((isset($context["exam"]) ? $context["exam"] : $this->getContext($context, "exam")), "nombreorigenmuestra")) : ("-")), "html", null, true);
                    echo "</td>
                    <td>";
                    // line 41
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exam"]) ? $context["exam"] : $this->getContext($context, "exam")), "indicacion"), "html", null, true);
                    echo "</td>
                    <td>
                        ";
                    // line 43
                    if ((($this->getAttribute((isset($context["exam"]) ? $context["exam"] : $this->getContext($context, "exam")), "urgente") === "true") && ($this->getAttribute((isset($context["exam"]) ? $context["exam"] : $this->getContext($context, "exam")), "idtiposolicitud") == 1))) {
                        // line 44
                        echo "                        Si
                        ";
                    } else {
                        // line 46
                        echo "                        No
                        ";
                    }
                    // line 48
                    echo "                    </td>
                </tr>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['exam'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 51
                echo "            </tbody>
        </table>
        ";
            } else {
                // line 54
                echo "        <div class=\"panel-body\" style=\"padding:8px;\">
            <p class=\"text-muted\">No hay registros para mostrar.</p>
        </div>
        ";
            }
            // line 58
            echo "    </div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "MinsalLaboratorioBundle:Custom:SecSolicitudestudios/body_solicitudestudio.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  157 => 58,  138 => 48,  134 => 46,  130 => 44,  128 => 43,  119 => 40,  115 => 39,  104 => 36,  100 => 35,  80 => 25,  78 => 24,  74 => 22,  66 => 19,  61 => 18,  58 => 17,  52 => 15,  49 => 14,  47 => 13,  43 => 11,  37 => 8,  27 => 4,  24 => 3,  631 => 238,  627 => 236,  623 => 234,  612 => 232,  608 => 231,  605 => 230,  603 => 229,  594 => 225,  590 => 223,  582 => 216,  577 => 213,  568 => 210,  564 => 209,  552 => 208,  549 => 207,  545 => 206,  541 => 204,  539 => 203,  532 => 201,  528 => 199,  523 => 195,  521 => 194,  519 => 193,  517 => 192,  515 => 191,  513 => 190,  511 => 189,  508 => 188,  501 => 186,  494 => 181,  489 => 179,  486 => 178,  482 => 176,  480 => 175,  476 => 174,  472 => 172,  469 => 171,  465 => 169,  462 => 168,  459 => 167,  452 => 165,  449 => 164,  446 => 163,  443 => 162,  440 => 161,  436 => 159,  434 => 158,  430 => 157,  425 => 156,  421 => 154,  418 => 153,  412 => 152,  410 => 151,  403 => 149,  400 => 148,  394 => 144,  391 => 143,  387 => 141,  384 => 140,  378 => 139,  374 => 137,  371 => 136,  368 => 135,  363 => 133,  356 => 132,  353 => 131,  351 => 130,  344 => 127,  341 => 126,  338 => 125,  332 => 123,  330 => 122,  323 => 121,  313 => 119,  310 => 118,  307 => 117,  304 => 116,  302 => 115,  297 => 113,  293 => 111,  284 => 109,  280 => 108,  277 => 107,  272 => 105,  269 => 104,  266 => 103,  263 => 102,  260 => 101,  257 => 100,  254 => 99,  252 => 98,  244 => 96,  240 => 95,  236 => 93,  233 => 92,  227 => 91,  224 => 90,  221 => 89,  217 => 87,  214 => 86,  207 => 84,  199 => 82,  194 => 81,  189 => 80,  186 => 79,  180 => 78,  177 => 77,  174 => 76,  167 => 74,  164 => 73,  162 => 72,  159 => 71,  156 => 70,  153 => 69,  151 => 54,  146 => 51,  136 => 60,  129 => 56,  116 => 50,  112 => 47,  106 => 43,  101 => 41,  96 => 39,  92 => 38,  87 => 36,  79 => 33,  76 => 32,  72 => 29,  65 => 24,  59 => 21,  55 => 16,  53 => 18,  48 => 16,  41 => 10,  34 => 8,  25 => 4,  21 => 2,  19 => 1,  137 => 65,  125 => 55,  123 => 41,  120 => 52,  117 => 52,  111 => 38,  107 => 37,  102 => 44,  98 => 40,  94 => 42,  89 => 41,  86 => 40,  83 => 39,  71 => 21,  67 => 29,  45 => 10,  42 => 9,  35 => 5,  33 => 6,  30 => 5,);
    }
}
