<?php

/* MinsalSeguimientoBundle:Reportes:SecHistorialClinico/body_consejeria.html.twig */
class __TwigTemplate_db142d92516c1db93f6e229b15269d607a29e1505950311b9fb5f4f1429b09da extends Twig_Template
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
    <div class=\"panel-heading\"><b>Consejería</b> ";
            // line 4
            echo "    </div>
    <div class=\"table-responsive\" style=\"overflow-x: auto;\">
        <table class=\"";
            // line 6
            if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
                echo " table table-hover ";
            }
            echo " table-bordered\">
            <tbody>
                ";
            // line 8
            if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "consejeriaBrindada")) {
                // line 9
                echo "                <tr>
                    <td colspan=\"4\" style=\"text-align: center;\">
                        ";
                // line 11
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "consejeriaBrindada"));
                foreach ($context['_seq'] as $context["_key"] => $context["consejo"]) {
                    // line 12
                    echo "                        <blockquote class=\"\" style=\"text-align: left; font-size: 15px; padding-left: 10px; border-left: 5px solid #D8EAF0 !important; border: 1px solid #F2F2F2;\">
                            <p class=\"text-";
                    // line 13
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
                    // line 14
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getConsejo", array(), "method"), "html", null, true);
                    echo "
                            <small>Brindada por: ";
                    // line 15
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdEmpleado", array(), "method"), "html", null, true);
                    echo "</small>
                        </blockquote>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['consejo'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 18
                echo "                    </td>
                </tr>
                ";
            } else {
                // line 21
                echo "                <tr class=\"sonata-ba-view-container\">
                    <td><span>
                        <p class=\"text-muted\">No hay registros para mostrar.</p>
                    </span></td>
                </tr>
                ";
            }
            // line 27
            echo "            </tbody>
        </table>
    </div>
</div>
";
        } else {
            // line 32
            echo "    ";
            if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "consejeriaBrindada")) {
                // line 33
                echo "        <div class=\"panel panel-info\">
            <div class=\"panel-heading\"><b >Consejería</b> ";
                // line 35
                echo "            </div>
            <div class=\"table-responsive\" style=\"overflow-x: auto;\">
                <table class=\"";
                // line 37
                if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
                    echo " table table-hover ";
                }
                echo " table-bordered\">
                    <thead>
                        <tr>
                            <th>Tipo de Consejeria</th>
                            <th colspan=\"2\">Consejo</th>
                            <th>Brindado por</th>
                        </tr>
                    </thead>
                    <tbody>
                        ";
                // line 46
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "consejeriaBrindada"));
                foreach ($context['_seq'] as $context["_key"] => $context["consejo"]) {
                    // line 47
                    echo "                            <tr>
                                <td>";
                    // line 48
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdTipoConsejeria", array(), "method"), "getNombre", array(), "method"), "html", null, true);
                    echo "</td>
                                <td  colspan=\"2\">";
                    // line 49
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getConsejo", array(), "method"), "html", null, true);
                    echo "</td>
                                <td><small>";
                    // line 50
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdEmpleado", array(), "method"), "html", null, true);
                    echo "</small></td>
                            </tr>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['consejo'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 53
                echo "                    </tbody>
                </table>
            </div>
        </div>
    ";
            }
        }
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:Reportes:SecHistorialClinico/body_consejeria.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 53,  132 => 50,  124 => 48,  121 => 47,  103 => 37,  93 => 32,  73 => 18,  64 => 15,  60 => 14,  28 => 6,  228 => 2,  225 => 1,  209 => 145,  205 => 143,  202 => 142,  198 => 140,  195 => 139,  192 => 138,  183 => 135,  179 => 134,  173 => 133,  169 => 132,  166 => 131,  154 => 124,  143 => 120,  139 => 118,  133 => 116,  131 => 115,  110 => 105,  99 => 35,  95 => 102,  84 => 94,  62 => 87,  51 => 78,  22 => 68,  20 => 1,  157 => 58,  138 => 48,  134 => 46,  130 => 44,  128 => 49,  119 => 40,  115 => 108,  104 => 36,  100 => 35,  80 => 93,  78 => 21,  74 => 22,  66 => 19,  61 => 18,  58 => 17,  52 => 15,  49 => 14,  47 => 13,  43 => 11,  37 => 9,  27 => 70,  24 => 4,  631 => 238,  627 => 236,  623 => 234,  612 => 232,  608 => 231,  605 => 230,  603 => 229,  594 => 225,  590 => 223,  582 => 216,  577 => 213,  568 => 210,  564 => 209,  552 => 208,  549 => 207,  545 => 206,  541 => 204,  539 => 203,  532 => 201,  528 => 199,  523 => 195,  521 => 194,  519 => 193,  517 => 192,  515 => 191,  513 => 190,  511 => 189,  508 => 188,  501 => 186,  494 => 181,  489 => 179,  486 => 178,  482 => 176,  480 => 175,  476 => 174,  472 => 172,  469 => 171,  465 => 169,  462 => 168,  459 => 167,  452 => 165,  449 => 164,  446 => 163,  443 => 162,  440 => 161,  436 => 159,  434 => 158,  430 => 157,  425 => 156,  421 => 154,  418 => 153,  412 => 152,  410 => 151,  403 => 149,  400 => 148,  394 => 144,  391 => 143,  387 => 141,  384 => 140,  378 => 139,  374 => 137,  371 => 136,  368 => 135,  363 => 133,  356 => 132,  353 => 131,  351 => 130,  344 => 127,  341 => 126,  338 => 125,  332 => 123,  330 => 122,  323 => 121,  313 => 119,  310 => 118,  307 => 117,  304 => 116,  302 => 115,  297 => 113,  293 => 111,  284 => 56,  280 => 108,  277 => 107,  272 => 105,  269 => 104,  266 => 103,  263 => 102,  260 => 101,  257 => 100,  254 => 99,  252 => 98,  244 => 96,  240 => 95,  236 => 93,  233 => 92,  227 => 91,  224 => 90,  221 => 89,  217 => 87,  214 => 147,  207 => 84,  199 => 82,  194 => 81,  189 => 80,  186 => 79,  180 => 78,  177 => 77,  174 => 76,  167 => 74,  164 => 73,  162 => 130,  159 => 71,  156 => 70,  153 => 69,  151 => 123,  146 => 51,  136 => 60,  129 => 56,  116 => 50,  112 => 47,  106 => 43,  101 => 41,  96 => 33,  92 => 38,  87 => 36,  79 => 33,  76 => 92,  72 => 91,  65 => 24,  59 => 21,  55 => 16,  53 => 18,  48 => 13,  41 => 11,  34 => 74,  25 => 69,  21 => 2,  19 => 1,  137 => 65,  125 => 113,  123 => 112,  120 => 52,  117 => 46,  111 => 38,  107 => 37,  102 => 44,  98 => 40,  94 => 42,  89 => 41,  86 => 27,  83 => 39,  71 => 21,  67 => 88,  45 => 12,  42 => 9,  35 => 8,  33 => 6,  30 => 72,);
    }
}
