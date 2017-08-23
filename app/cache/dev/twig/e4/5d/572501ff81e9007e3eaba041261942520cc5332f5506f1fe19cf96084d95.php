<?php

/* MinsalFarmaciaBundle:FarmRecetas:body_plan_atencion.html.twig */
class __TwigTemplate_e45d572501ff81e9007e3eaba041261942520cc5332f5506f1fe19cf96084d95 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('javascripts', $context, $blocks);
        // line 68
        echo "<!-- Plan de Atención -->
";
        // line 69
        if ((isset($context["medicinaRecetada"]) ? $context["medicinaRecetada"] : $this->getContext($context, "medicinaRecetada"))) {
            // line 70
            echo "<div class=\"panel panel-info\">
    <div class=\"panel-heading\"> <b >Plan de Atención</b>";
            // line 72
            echo "    </div>
    <div class=\"table-responsive\" style=\"overflow-x: visible;\">
        <table class=\"";
            // line 74
            if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
                echo " table ";
            }
            echo " table-bordered\" ";
            if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) == true)) {
                echo "style=\"font-size: 12px;\"";
            }
            echo ">
            <tbody>
               ";
            // line 76
            if ((isset($context["medicinaRecetada"]) ? $context["medicinaRecetada"] : $this->getContext($context, "medicinaRecetada"))) {
                echo " ";
                // line 77
                echo "                    ";
                if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
                    // line 78
                    echo "                        <tr>
                            <td colspan=\"3\">
                                Impresión Recetas
                                <span class=\"glyphicon glyphicon-print mouse-pointer\" id=\"imprimir-receta\" style=\"font-size:20px;float: right\" role=\"print\">
                                    <input type=\"checkbox\" id=\"idTodasLasRecetas\" name=\"idTodasLasRecetas\">
                                </span>
                            </td>
                        <tr>
                        <tr class=\"sonata-ba-view-container\">
                            ";
                    // line 87
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["medicinaRecetada"]) ? $context["medicinaRecetada"] : $this->getContext($context, "medicinaRecetada")));
                    foreach ($context['_seq'] as $context["_key"] => $context["medicamento"]) {
                        echo " ";
                        // line 88
                        echo "                            <tr>
                                <td colspan=\"2\">
                                    <ul>
                                        <li><span><strong>Medicamento:</strong>";
                        // line 91
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "idmedicina"), "html", null, true);
                        echo " </li>
                                        <li><span><strong>Total a dispensar :</strong>";
                        // line 92
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "totalMedicamento"), "html", null, true);
                        echo "</li>
                                        <li><strong>Dosis: </strong> ";
                        // line 93
                        echo twig_escape_filter($this->env, (((((((((($this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "cantidadMedicamento") . " ") . $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "idmedicina")) . " cada ") . $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "frecuencia")) . " ") . $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "tiempoFrecuencia")) . " durante ") . $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "durante")) . " ") . $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "tiempoDurante")), "html", null, true);
                        echo "</span></li>
                                            ";
                        // line 94
                        if ($this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "distribucionEspecial")) {
                            // line 95
                            echo "                                            <li><strong>Distribuido de la siguiente manera:</strong></li>
                                            <table class=\"table\" style=\"width:20%\">
                                                <tbody>
                                                    <tr>
                                                        <th>Cantidad</th>
                                                        <th>Descripción</th>
                                                    </tr>
                                                    ";
                            // line 102
                            $context['_parent'] = (array) $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "getDistribuciones", array(), "method"));
                            foreach ($context['_seq'] as $context["_key"] => $context["distribucion"]) {
                                // line 103
                                echo "                                                        <tr><td>";
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["distribucion"]) ? $context["distribucion"] : $this->getContext($context, "distribucion")), "getCantidadDistribucion", array(), "method"), "html", null, true);
                                echo "</td><td>";
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["distribucion"]) ? $context["distribucion"] : $this->getContext($context, "distribucion")), "getIndicacion", array(), "method"), "html", null, true);
                                echo "</td></tr>
                                                    ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['distribucion'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 105
                            echo "                                                </tbody>
                                            </table>
                                        ";
                        }
                        // line 108
                        echo "                                        <li><span><strong>Fecha de entrega: </strong>";
                        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "idreceta"), "fecha"), "d-m-Y"), "html", null, true);
                        echo " </li>
                                    </ul>
                                </td>
                                <td style=\"float: right\">
                                    ";
                        // line 112
                        $context["fechactual"] = twig_date_format_filter($this->env, "now", "Y-m-d");
                        // line 113
                        echo "                                    ";
                        $context["fecharecetasum"] = twig_date_format_filter($this->env, twig_date_modify_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "idreceta"), "fecha"), "+15 day"), "Y-m-d");
                        // line 114
                        echo "
                                    ";
                        // line 115
                        if ((((trim($this->getAttribute($this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "idreceta"), "idestado")) == "R") || (trim($this->getAttribute($this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "idreceta"), "idestado")) == "RE")) && ((isset($context["fechactual"]) ? $context["fechactual"] : $this->getContext($context, "fechactual")) < (isset($context["fecharecetasum"]) ? $context["fecharecetasum"] : $this->getContext($context, "fecharecetasum"))))) {
                            // line 116
                            echo "                                    <input type=\"checkbox\" id=\"seleccionarMediciaImpresion_";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "id"), "html", null, true);
                            echo "\">
                                    ";
                        } else {
                            // line 118
                            echo "                                    ---
                                    ";
                        }
                        // line 120
                        echo "                                </td>
                            </tr>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['medicamento'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 123
                    echo "                    ";
                } else {
                    // line 124
                    echo "                        <tr>
                            <th style=\"width: 30px !important;\">Cantidad</th>
                            <th>Medicamento</th>
                            <th>Dosis</th>
                            <th>Cantidad de Recetas</th>
                        </tr>
                        ";
                    // line 130
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["medicinaRecetada"]) ? $context["medicinaRecetada"] : $this->getContext($context, "medicinaRecetada")));
                    foreach ($context['_seq'] as $context["_key"] => $context["medicamento"]) {
                        // line 131
                        echo "                            <tr>
                                <td style=\"width: 30px !important;\">";
                        // line 132
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "cantidad"), "html", null, true);
                        echo "</td>
                                <td>";
                        // line 133
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "medicina"), "nombre"), "html", null, true);
                        echo ", ";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "medicina"), "concentracion"), "html", null, true);
                        echo "</td>
                                <td>";
                        // line 134
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "dosis"), "html", null, true);
                        echo "</td>
                                <td>";
                        // line 135
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["medicamento"]) ? $context["medicamento"] : $this->getContext($context, "medicamento")), "cuantas"), "html", null, true);
                        echo "</td>
                            </tr>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['medicamento'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 138
                    echo "                    ";
                }
                // line 139
                echo "                ";
            } else {
                // line 140
                echo "                    <tr class=\"sonata-ba-view-container\"><td><p class=\"text-muted\">No hay registros para mostrar.</p></td></tr>
                ";
            }
            // line 142
            echo "                ";
            if ($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "IdOtrasObservaciones", array(), "method")) {
                // line 143
                echo "                    <tr class=\"sonata-ba-view-container\">
                        <td colspan=\"4\"><b>Recomendaciones Relacionadas con el Tratamiento: </b>
                        ";
                // line 145
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdOtrasObservaciones", array(), "method"), "indicacionObservacion"), "html", null, true);
                echo "</td>
                    ";
            }
            // line 147
            echo "                </tr>
                </tr>
            </tbody>
        </table>
    </div>
</div>
";
        }
    }

    // line 1
    public function block_javascripts($context, array $blocks = array())
    {
        // line 2
        echo "    <script>
        \$(document).ready(function () {
            \$('input[type=\"checkbox\"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue'
            });
        });
    </script>
    <script  type=\"text/javascript\">
        jQuery(document).ready(function (\$) {
            var idmedicinarecetadaimpresion = [];//Se utiliza para selecionar los medicamentos a los cuales se les imprimira receta

            \$(\"body\").on('ifChecked', \"input[id^='seleccionarMediciaImpresion_']\", function () {//Si se han selecionado que se impriman todas las recetas se seleciona una por una
                var item = \$(this);
                var valores = item.attr('id').split('_');
                var id = valores[1];
                var winParams = [];
                idmedicinarecetadaimpresion.push(id);

            });

            \$(\"body\").on('ifUnchecked', \"input[id^='seleccionarMediciaImpresion_']\", function () {//Si se han selecionado que se impriman todas las recetas se seleciona una por una
                var item = \$(this);
                var valores = item.attr('id').split('_');
                var id = valores[1];
                var index = idmedicinarecetadaimpresion.indexOf(id); //idsmedicamento es una variable global de tipo array que tiene los id de los medicamentos que se agregan a la receta
                idmedicinarecetadaimpresion.splice(index, 1);

            });


            \$(\"body\").on('ifChecked', '#idTodasLasRecetas', function () {//Si se han selecionado que se impriman todas las recetas se seleciona una por una
                \$(\"input[id^='seleccionarMediciaImpresion_']\").each(//Se recorre cada fila de receta para selecionar
                        function () {
                            \$(\"input[id^='seleccionarMediciaImpresion_']\").iCheck('check');
                            var item = \$(this);
                            var valores = item.attr('id').split('_');
                            var id = valores[1];
                            idmedicinarecetadaimpresion.push(id);// se agrega al array
                        });
            });

            \$(\"body\").on('ifUnchecked', '#idTodasLasRecetas', function () {//Si se han deseleccionado que se impriman todas las recetas se deseleciona una por una
                \$(\"input[id^='seleccionarMediciaImpresion_']\").each(
                        function () {
                            \$(\"input[id^='seleccionarMediciaImpresion_']\").iCheck('uncheck');
                            idmedicinarecetadaimpresion = [];//se borra todo el array
                        });
            });


            \$(\"body\").on('click', \"span[id='imprimir-receta']\", function () {//Se envia el array de recetas que se desea imprimir
                if (idmedicinarecetadaimpresion.length != 0) {//Pregunta si el array que contiene los id de las recetas esta vacio
                    var winParams = [];
                    winParams['method'] = \"post\";
                    winParams['action'] = \"";
        // line 56
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_farmacia_farmrecetas_imprimir_receta");
        echo "\";
                    winParams['target'] = \"Impresion de Receta\";
                    winParams['parameters'] = {'id_receta': idmedicinarecetadaimpresion};//Se envia un array que contiene las recetas ya sea una, varias o todas
                    openPostPopUpWindows(winParams);
                }
                else {
                    showDialogMsg('Recetario', 'Por favor selecionar la(s) recetas a imprimir', 'dialog-info');
                }
            });
        }); //fin document ready
    </script>
";
    }

    public function getTemplateName()
    {
        return "MinsalFarmaciaBundle:FarmRecetas:body_plan_atencion.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  228 => 2,  225 => 1,  209 => 145,  205 => 143,  202 => 142,  198 => 140,  195 => 139,  192 => 138,  183 => 135,  179 => 134,  173 => 133,  169 => 132,  166 => 131,  154 => 124,  143 => 120,  139 => 118,  133 => 116,  131 => 115,  110 => 105,  99 => 103,  95 => 102,  84 => 94,  62 => 87,  51 => 78,  22 => 68,  20 => 1,  157 => 58,  138 => 48,  134 => 46,  130 => 44,  128 => 114,  119 => 40,  115 => 108,  104 => 36,  100 => 35,  80 => 93,  78 => 24,  74 => 22,  66 => 19,  61 => 18,  58 => 17,  52 => 15,  49 => 14,  47 => 13,  43 => 11,  37 => 8,  27 => 70,  24 => 3,  631 => 238,  627 => 236,  623 => 234,  612 => 232,  608 => 231,  605 => 230,  603 => 229,  594 => 225,  590 => 223,  582 => 216,  577 => 213,  568 => 210,  564 => 209,  552 => 208,  549 => 207,  545 => 206,  541 => 204,  539 => 203,  532 => 201,  528 => 199,  523 => 195,  521 => 194,  519 => 193,  517 => 192,  515 => 191,  513 => 190,  511 => 189,  508 => 188,  501 => 186,  494 => 181,  489 => 179,  486 => 178,  482 => 176,  480 => 175,  476 => 174,  472 => 172,  469 => 171,  465 => 169,  462 => 168,  459 => 167,  452 => 165,  449 => 164,  446 => 163,  443 => 162,  440 => 161,  436 => 159,  434 => 158,  430 => 157,  425 => 156,  421 => 154,  418 => 153,  412 => 152,  410 => 151,  403 => 149,  400 => 148,  394 => 144,  391 => 143,  387 => 141,  384 => 140,  378 => 139,  374 => 137,  371 => 136,  368 => 135,  363 => 133,  356 => 132,  353 => 131,  351 => 130,  344 => 127,  341 => 126,  338 => 125,  332 => 123,  330 => 122,  323 => 121,  313 => 119,  310 => 118,  307 => 117,  304 => 116,  302 => 115,  297 => 113,  293 => 111,  284 => 56,  280 => 108,  277 => 107,  272 => 105,  269 => 104,  266 => 103,  263 => 102,  260 => 101,  257 => 100,  254 => 99,  252 => 98,  244 => 96,  240 => 95,  236 => 93,  233 => 92,  227 => 91,  224 => 90,  221 => 89,  217 => 87,  214 => 147,  207 => 84,  199 => 82,  194 => 81,  189 => 80,  186 => 79,  180 => 78,  177 => 77,  174 => 76,  167 => 74,  164 => 73,  162 => 130,  159 => 71,  156 => 70,  153 => 69,  151 => 123,  146 => 51,  136 => 60,  129 => 56,  116 => 50,  112 => 47,  106 => 43,  101 => 41,  96 => 39,  92 => 38,  87 => 36,  79 => 33,  76 => 92,  72 => 91,  65 => 24,  59 => 21,  55 => 16,  53 => 18,  48 => 77,  41 => 10,  34 => 74,  25 => 69,  21 => 2,  19 => 1,  137 => 65,  125 => 113,  123 => 112,  120 => 52,  117 => 52,  111 => 38,  107 => 37,  102 => 44,  98 => 40,  94 => 42,  89 => 41,  86 => 95,  83 => 39,  71 => 21,  67 => 88,  45 => 76,  42 => 9,  35 => 5,  33 => 6,  30 => 72,);
    }
}
