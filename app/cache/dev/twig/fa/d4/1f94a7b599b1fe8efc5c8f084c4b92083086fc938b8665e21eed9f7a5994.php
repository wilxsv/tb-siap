<?php

/* MinsalSeguimientoBundle:Reportes:SecHistorialClinico/body_plan_ingresos.html.twig */
class __TwigTemplate_fad41f94a7b599b1fe8efc5c8f084c4b92083086fc938b8665e21eed9f7a5994 extends Twig_Template
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
        echo "<!-- Seguimiento de consulta -->
";
        // line 2
        if ((isset($context["secOtrasObservaciones"]) ? $context["secOtrasObservaciones"] : $this->getContext($context, "secOtrasObservaciones"))) {
            // line 3
            if ($this->getAttribute((isset($context["secOtrasObservaciones"]) ? $context["secOtrasObservaciones"] : $this->getContext($context, "secOtrasObservaciones")), "planIngreso")) {
                // line 4
                echo "<div class=\"panel panel-info\" id=\"seguimiento\">
    <div class=\"panel-heading\"><b >Plan de Ingreso</b> ";
                // line 6
                echo "    </div>
    <div class=\"table-responsive\" style=\"overflow-x: auto;\">
        <table class=\"";
                // line 8
                if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
                    echo " table table-hover ";
                }
                echo " table-bordered\">
            <tbody>
                <tr class=\"sonata-ba-view-container\">
                    <td>
                        ";
                // line 12
                echo $this->getAttribute((isset($context["secOtrasObservaciones"]) ? $context["secOtrasObservaciones"] : $this->getContext($context, "secOtrasObservaciones")), "planIngreso");
                echo "
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
";
            }
        }
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:Reportes:SecHistorialClinico/body_plan_ingresos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 6,  26 => 4,  57 => 19,  40 => 11,  31 => 7,  141 => 53,  132 => 50,  124 => 48,  121 => 47,  103 => 37,  93 => 32,  73 => 18,  64 => 23,  60 => 14,  28 => 6,  228 => 2,  225 => 1,  209 => 145,  205 => 143,  202 => 142,  198 => 140,  195 => 139,  192 => 138,  183 => 135,  179 => 134,  173 => 133,  169 => 132,  166 => 131,  154 => 124,  143 => 120,  139 => 118,  133 => 116,  131 => 115,  110 => 105,  99 => 35,  95 => 102,  84 => 94,  62 => 87,  51 => 78,  22 => 2,  20 => 1,  157 => 58,  138 => 48,  134 => 46,  130 => 44,  128 => 49,  119 => 40,  115 => 108,  104 => 36,  100 => 35,  80 => 93,  78 => 21,  74 => 22,  66 => 19,  61 => 18,  58 => 17,  52 => 17,  49 => 14,  47 => 13,  43 => 11,  37 => 9,  27 => 5,  24 => 3,  631 => 238,  627 => 236,  623 => 234,  612 => 232,  608 => 231,  605 => 230,  603 => 229,  594 => 225,  590 => 223,  582 => 216,  577 => 213,  568 => 210,  564 => 209,  552 => 208,  549 => 207,  545 => 206,  541 => 204,  539 => 203,  532 => 201,  528 => 199,  523 => 195,  521 => 194,  519 => 193,  517 => 192,  515 => 191,  513 => 190,  511 => 189,  508 => 188,  501 => 186,  494 => 181,  489 => 179,  486 => 178,  482 => 176,  480 => 175,  476 => 174,  472 => 172,  469 => 171,  465 => 169,  462 => 168,  459 => 167,  452 => 165,  449 => 164,  446 => 163,  443 => 162,  440 => 161,  436 => 159,  434 => 158,  430 => 157,  425 => 156,  421 => 154,  418 => 153,  412 => 152,  410 => 151,  403 => 149,  400 => 148,  394 => 144,  391 => 143,  387 => 141,  384 => 140,  378 => 139,  374 => 137,  371 => 136,  368 => 135,  363 => 133,  356 => 132,  353 => 131,  351 => 130,  344 => 127,  341 => 126,  338 => 125,  332 => 123,  330 => 122,  323 => 121,  313 => 119,  310 => 118,  307 => 117,  304 => 116,  302 => 115,  297 => 113,  293 => 111,  284 => 56,  280 => 108,  277 => 107,  272 => 105,  269 => 104,  266 => 103,  263 => 102,  260 => 101,  257 => 100,  254 => 99,  252 => 98,  244 => 96,  240 => 95,  236 => 93,  233 => 92,  227 => 91,  224 => 90,  221 => 89,  217 => 87,  214 => 147,  207 => 84,  199 => 82,  194 => 81,  189 => 80,  186 => 79,  180 => 78,  177 => 77,  174 => 76,  167 => 74,  164 => 73,  162 => 130,  159 => 71,  156 => 70,  153 => 69,  151 => 123,  146 => 51,  136 => 60,  129 => 56,  116 => 50,  112 => 47,  106 => 43,  101 => 41,  96 => 33,  92 => 38,  87 => 36,  79 => 33,  76 => 92,  72 => 91,  65 => 24,  59 => 21,  55 => 16,  53 => 18,  48 => 13,  41 => 11,  34 => 74,  25 => 69,  21 => 2,  19 => 1,  137 => 65,  125 => 113,  123 => 112,  120 => 52,  117 => 46,  111 => 38,  107 => 37,  102 => 44,  98 => 40,  94 => 42,  89 => 41,  86 => 27,  83 => 39,  71 => 21,  67 => 88,  45 => 13,  42 => 12,  35 => 8,  33 => 8,  30 => 72,);
    }
}
