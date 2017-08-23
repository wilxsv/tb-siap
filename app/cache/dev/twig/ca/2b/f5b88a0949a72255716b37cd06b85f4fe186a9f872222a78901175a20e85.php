<?php

/* MinsalLaboratorioBundle:Custom:SecSolicitudestudios/registrar_paciente.html.twig */
class __TwigTemplate_ca2bf5b88a0949a72255716b37cd06b85f4fe186a9f872222a78901175a20e85 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'registrar_paciente' => array($this, 'block_registrar_paciente'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('registrar_paciente', $context, $blocks);
    }

    public function block_registrar_paciente($context, array $blocks = array())
    {
        // line 2
        echo "    <div class=\"sonata-ba-collapsed-fields\">
        <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
            <div class=\"form-group\">
                <label for=\"establecimiento\">Establecimiento</label>
                <input readonly=\"readonly\" class=\"form-control\" id=\"establecimiento\" name=\"establecimiento\" placeholder=\"Ingresar Establecimiento...\" type=\"text\">
            </div>
        </div>

        <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
            <div class=\"form-group\">
                <label for=\"expediente2\">Número de expediente</label>
                <input readonly=\"readonly\" class=\"form-control\" id=\"expediente2\" name=\"expediente2\" placeholder=\"Ingresar expediente...\" type=\"text\"></input>
            </div>
        </div>
        <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
            <div class=\"form-group\">
                <!-- <label for=\"nombres\">Nombres</label> -->
                <div class=\"row\">
                    <div class=\"col-xs-4\">
                        <label for=\"primer_nombres\">Primer Nombre *</label>
                        <input id=\"primer_nombre\" name=\"primer_nombre\" class=\"form-control\" placeholder=\"Primer Nombre\" type=\"text\" required=\"required\">
                    </div>
                    <div class=\"col-xs-4\">
                        <label for=\"segundo_nombres\">Segundo Nombre</label>
                        <input id=\"segundo_nombre\" name=\"segundo_nombre\" class=\"form-control\" placeholder=\"Segundo Nombre\" type=\"text\">
                    </div>
                    <div class=\"col-xs-4\">
                        <label for=\"tercer_nombres\">Tercer Nombre</label>
                        <input id=\"tercer_nombre\" name=\"tercer_nombre\" class=\"form-control\" placeholder=\"Tercer Nombre\" type=\"text\">
                    </div>
                </div>
            </div>
        </div>
        <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
            <div class=\"form-group\">
                <!-- <label for=\"nombres\">Apellidos</label> -->
                <div class=\"row\">
                    <div class=\"col-xs-4\">
                        <label for=\"primer_apellido\">Primer Apellido *</label>
                        <input id=\"primer_apellido\" name=\"primer_apellido\" class=\"form-control\" placeholder=\"Primer Apellido\" type=\"text\" required=\"required\">
                    </div>
                    <div class=\"col-xs-4\">
                        <label for=\"segundo_apellido\">Segundo Apellido</label>
                        <input id=\"segundo_apellido\" name=\"segundo_apellido\" class=\"form-control\" placeholder=\"Segundo Apellido\" type=\"text\">
                    </div>
                    <div class=\"col-xs-4\">
                        <label for=\"apellido_casada\">Apellido de Casada</label>
                        <input id=\"apellido_casada\" name=\"apellido_casada\" class=\"form-control\" placeholder=\"Tercer Apellido\" type=\"text\">
                    </div>
                </div>
            </div>
        </div>
        <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
            <div class=\"form-group\">
                <div class=\"row\">
                    <div class=\"col-xs-6\">
                        <label for=\"fecha_nacimiento\">Fecha de Nacimiento *</label>
                        <input id=\"fecha_nacimiento\" name=\"fecha_nacimiento\" type=\"text\" required class=\"form-control\" data-mask=\"99/99/9999\" placeholder=\"dd/mm/yyyy\" value=\"";
        // line 59
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d/m/Y"), "html", null, true);
        echo "\"></input>
                    </div>
                    <div class=\"col-xs-2\">
                        <label for=\"edad_anio\">Año(s)</label>
                        <input id=\"edad_anio\" name=\"edad_anio\" type=\"number\" class=\"form-control\" placeholder=\"Años\" type=\"text\" value=\"0\">
                    </div>
                    <div class=\"col-xs-2\">
                        <label for=\"edad_meses\">Mes(es)</label>
                        <input id=\"edad_meses\" name=\"edad_meses\" type=\"number\" class=\"form-control\" placeholder=\"Meses\" type=\"text\" value=\"0\">
                    </div>
                    <div class=\"col-xs-2\">
                        <label for=\"edad_dias\">Día(s)</label>
                        <input id=\"edad_dias\" name=\"edad_dias\" type=\"number\" class=\"form-control\" placeholder=\"Dias\" type=\"text\" value=\"0\">
                    </div>
                </div>
            </div>
            <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
                <div class=\"form-group\">
                <label for=\"id_sexo\">Sexo *</label>
                <select id=\"id_sexo\" name=\"id_sexo\" required=\"required\"></select>
            </div>
        </div>
        <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
            <div class=\"form-group\">
                <label for=\"nombre_madre\">Nombre de la Madre</label>
                <input class=\"form-control\" id=\"nombre_madre\" name=\"nombre_madre\" placeholder=\"Nombre de la madre...\" type=\"text\"></input>
            </div>
        </div>
        <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
            <div class=\"form-group\">
                <label for=\"nombre_padre\">Nombre del Padre</label>
                <input class=\"form-control\" id=\"nombre_padre\" name=\"nombre_padre\" placeholder=\"Nombre del padre...\" type=\"text\"></input>
            </div>
        </div>
        <div class=\" sonata-ba-field sonata-ba-field-standard-natural\">
            <div class=\"form-group\">
                <label for=\"nombre_responsable\">Responsable</label>
                <input class=\"form-control\" id=\"nombre_responsable\" name=\"nombre_responsable\" placeholder=\"Nombre del responsable...\" type=\"text\"></input>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalLaboratorioBundle:Custom:SecSolicitudestudios/registrar_paciente.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  85 => 59,  26 => 2,  20 => 1,  330 => 103,  321 => 100,  315 => 98,  312 => 97,  306 => 95,  303 => 94,  300 => 93,  292 => 91,  290 => 90,  287 => 89,  280 => 87,  275 => 86,  273 => 85,  270 => 84,  264 => 82,  262 => 81,  256 => 79,  253 => 78,  247 => 75,  243 => 73,  240 => 72,  237 => 71,  231 => 69,  225 => 67,  222 => 66,  220 => 65,  217 => 64,  214 => 63,  209 => 58,  206 => 57,  194 => 52,  190 => 49,  184 => 48,  178 => 46,  175 => 45,  171 => 44,  168 => 43,  162 => 41,  160 => 40,  156 => 38,  150 => 34,  142 => 30,  137 => 29,  134 => 28,  129 => 25,  126 => 24,  119 => 108,  112 => 105,  105 => 61,  102 => 60,  100 => 57,  97 => 56,  95 => 28,  92 => 27,  87 => 23,  76 => 18,  73 => 17,  69 => 16,  62 => 14,  59 => 13,  52 => 11,  46 => 8,  43 => 7,  41 => 6,  38 => 5,  36 => 4,  30 => 2,  24 => 1,  116 => 107,  113 => 39,  110 => 63,  104 => 34,  98 => 31,  94 => 30,  90 => 24,  86 => 28,  81 => 20,  78 => 19,  71 => 23,  68 => 22,  60 => 18,  54 => 16,  51 => 15,  12 => 36,  828 => 682,  825 => 681,  804 => 662,  760 => 621,  692 => 555,  681 => 553,  677 => 552,  660 => 537,  657 => 536,  543 => 425,  468 => 353,  459 => 346,  455 => 344,  447 => 340,  445 => 339,  441 => 338,  438 => 337,  436 => 336,  411 => 313,  408 => 312,  404 => 310,  396 => 306,  394 => 305,  390 => 304,  387 => 303,  384 => 302,  382 => 301,  356 => 277,  353 => 276,  349 => 274,  341 => 270,  339 => 269,  335 => 268,  332 => 267,  329 => 266,  327 => 102,  202 => 55,  149 => 93,  79 => 29,  58 => 12,  55 => 12,  48 => 14,  45 => 7,  40 => 5,  14 => 4,);
    }
}
