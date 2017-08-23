<?php

/* MinsalLaboratorioBundle:Custom:SecSolicitudestudios/headerLayout.html.twig */
class __TwigTemplate_74b94c171c824fdd4c61ddd453aecac05fe95029259009647719d89890873bd9 extends Twig_Template
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
        echo "<h4>
    <div class=\"row\">
        <div class=\"col-md-4 col-sm-4 header-exam-name\">
            <strong>";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "nombre"), "html", null, true);
        echo "</strong>
        </div>
        <div class=\"col-md-4 col-sm-4 header-default-color\">
            Estado: <strong>";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "nombre_estado_detalle"), "html", null, true);
        echo "</strong>
        </div>
        ";
        // line 9
        if (((!(null === $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "fecha_toma_muestra"))) && (!($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "fecha_toma_muestra") === "")))) {
            // line 10
            echo "            <div class=\"col-md-4 col-sm-4 header-default-color\">
                Fecha de Toma de Muestra: <strong>";
            // line 11
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "fecha_toma_muestra"), "m/d/Y"), "html", null, true);
            echo "</strong>
            </div>
        ";
        }
        // line 14
        echo "    </div>
    <div class=\"row\" style=\"margin-top: 10px;\">
        ";
        // line 16
        if (((isset($context["examStatus"]) ? $context["examStatus"] : $this->getContext($context, "examStatus")) === "RC")) {
            // line 17
            echo "            <div class=\"col-md-4 col-sm-4 header-default-color\">
                Validado por: <strong>";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "nombre_empleado"), "html", null, true);
            echo "</strong>
            </div>
            <div class=\"col-md-4 col-sm-4 header-default-color\">
                Fecha de Resultado: <strong>";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "fecha_resultado"), "html", null, true);
            echo "</strong>
            </div>
            <div class=\"col-md-4 col-sm-4 header-default-color\">
                Urgente: <strong>";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["examen"]) ? $context["examen"] : $this->getContext($context, "examen")), "resultadoFinal"), "urgente"), "html", null, true);
            echo "</strong>
            </div>
        ";
        }
        // line 27
        echo "    </div>
</h4>
";
    }

    public function getTemplateName()
    {
        return "MinsalLaboratorioBundle:Custom:SecSolicitudestudios/headerLayout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 27,  67 => 24,  61 => 21,  55 => 18,  50 => 16,  37 => 10,  30 => 7,  24 => 4,  19 => 1,  143 => 22,  140 => 21,  126 => 20,  123 => 19,  121 => 18,  117 => 16,  114 => 15,  110 => 14,  108 => 13,  100 => 12,  96 => 10,  94 => 9,  80 => 8,  71 => 7,  68 => 6,  65 => 5,  47 => 4,  44 => 3,  26 => 2,  20 => 1,  470 => 201,  463 => 196,  460 => 195,  442 => 190,  428 => 189,  425 => 188,  422 => 187,  419 => 186,  401 => 185,  398 => 184,  390 => 180,  384 => 177,  375 => 175,  371 => 173,  369 => 172,  366 => 171,  363 => 170,  360 => 169,  357 => 168,  354 => 167,  351 => 166,  348 => 165,  346 => 164,  343 => 163,  340 => 162,  337 => 161,  334 => 160,  331 => 159,  328 => 158,  325 => 157,  323 => 156,  320 => 155,  317 => 154,  314 => 153,  311 => 152,  308 => 151,  305 => 150,  303 => 149,  300 => 148,  298 => 147,  295 => 146,  292 => 145,  289 => 144,  286 => 143,  283 => 142,  280 => 141,  277 => 140,  259 => 139,  257 => 138,  248 => 134,  237 => 125,  233 => 123,  230 => 122,  221 => 119,  217 => 118,  213 => 117,  210 => 116,  205 => 115,  203 => 114,  177 => 91,  170 => 87,  163 => 83,  156 => 79,  149 => 75,  142 => 71,  135 => 67,  118 => 52,  107 => 43,  104 => 42,  101 => 41,  77 => 21,  74 => 20,  66 => 16,  63 => 15,  60 => 14,  52 => 17,  49 => 9,  46 => 14,  40 => 11,  35 => 9,  32 => 3,);
    }
}
