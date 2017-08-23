<?php

/* MinsalSeguimientoBundle:SecHistorialClinico:requestParameters.html.twig */
class __TwigTemplate_c1383413d8d50dbcce10fbfe148744934f39c6833f32618fe990aef44f16c3f7 extends Twig_Template
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
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") === true))) {
            // line 2
            echo "    <script type=\"text/javascript\">
        jQuery(document).ready(function(\$) {
            var urlComplement = '&external=";
            // line 4
            if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "&selectable=";
            if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "selectable")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "&idExpedienteHclinica=";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idExpedienteHclinica"), "html", null, true);
            echo "&idEspecialidadHclinica=";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idEspecialidadHclinica"), "html", null, true);
            echo "';

            \$( \".sonata-ba-list-field-header a\" ).each(function() {
                \$(this).attr('href', \$(this).attr('href') + urlComplement);
            });
            \$( \".sonata-filter-form a\" ).each(function() {
                \$(this).attr('href', \$(this).attr('href') + urlComplement);
            });

            \$( \".pagination a\" ).each(function() {
                \$(this).attr('href', \$(this).attr('href') + urlComplement);
            });

            \$( \"#";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
            echo "_per_page option\" ).each(function() {
               \$(this).attr('value', \$(this).attr('value') + urlComplement);
            });

            \$( \"form\" ).prepend(
                '<input type=\"hidden\" name=\"external\" id=\"external\" value=\"";
            // line 22
            if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "\">' +
                '<input type=\"hidden\" name=\"selectable\" id=\"selectable\" value=\"";
            // line 23
            if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "selectable")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "\">' +
                '<input type=\"hidden\" name=\"idExpedienteHclinica\" id=\"idExpedienteHclinica\" value=\"";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idExpedienteHclinica"), "html", null, true);
            echo "\">' +
                '<input type=\"hidden\" name=\"idEspecialidadHclinica\" id=\"idEspecialidadHclinica\" value=\"";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idEspecialidadHclinica"), "html", null, true);
            echo "\">'
            );

            \$( 'a[href\$=\"show\"]' ).each(function(){
                \$(this).attr('href', \$(this).attr('href') + '?external=";
            // line 29
            if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "&idExpedienteHclinica=";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idExpedienteHclinica"), "html", null, true);
            echo "&idEspecialidadHclinica=";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idEspecialidadHclinica"), "html", null, true);
            echo "');
            });
        });
    </script>
";
        }
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecHistorialClinico:requestParameters.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 29,  83 => 25,  63 => 22,  55 => 17,  25 => 4,  21 => 2,  24 => 13,  22 => 12,  19 => 1,  43 => 19,  35 => 17,  40 => 18,  32 => 15,  29 => 15,  26 => 14,  724 => 258,  713 => 256,  709 => 255,  685 => 252,  680 => 250,  674 => 248,  672 => 247,  667 => 244,  658 => 241,  653 => 239,  650 => 238,  647 => 237,  645 => 236,  639 => 235,  636 => 234,  632 => 233,  628 => 232,  624 => 231,  602 => 230,  593 => 226,  589 => 224,  586 => 223,  583 => 222,  580 => 221,  575 => 212,  571 => 199,  568 => 198,  564 => 197,  561 => 196,  558 => 195,  554 => 188,  550 => 187,  547 => 186,  542 => 156,  531 => 154,  527 => 153,  520 => 149,  516 => 148,  512 => 147,  507 => 146,  504 => 145,  481 => 123,  478 => 122,  472 => 159,  469 => 158,  467 => 145,  463 => 143,  461 => 122,  458 => 121,  455 => 120,  450 => 200,  448 => 195,  442 => 191,  438 => 189,  436 => 186,  433 => 185,  426 => 180,  416 => 176,  411 => 174,  408 => 173,  404 => 172,  397 => 168,  392 => 165,  390 => 164,  386 => 162,  383 => 161,  380 => 120,  377 => 119,  375 => 118,  370 => 116,  367 => 115,  364 => 114,  359 => 111,  344 => 109,  341 => 108,  338 => 107,  321 => 106,  318 => 105,  315 => 104,  309 => 100,  303 => 99,  300 => 98,  296 => 96,  292 => 95,  287 => 94,  281 => 93,  269 => 92,  267 => 91,  264 => 90,  261 => 89,  258 => 88,  255 => 87,  252 => 86,  249 => 85,  246 => 84,  243 => 83,  240 => 82,  237 => 81,  235 => 80,  232 => 79,  230 => 78,  226 => 76,  220 => 72,  217 => 71,  213 => 70,  209 => 68,  206 => 67,  201 => 58,  191 => 214,  188 => 213,  186 => 212,  183 => 211,  177 => 208,  174 => 207,  171 => 206,  167 => 204,  165 => 203,  162 => 202,  160 => 114,  157 => 113,  155 => 104,  152 => 103,  150 => 67,  147 => 66,  142 => 64,  137 => 63,  134 => 62,  131 => 61,  129 => 60,  126 => 59,  124 => 58,  119 => 56,  115 => 54,  105 => 46,  102 => 45,  99 => 44,  93 => 41,  85 => 37,  82 => 36,  79 => 24,  71 => 23,  68 => 30,  65 => 29,  51 => 17,  49 => 21,  44 => 15,  41 => 14,);
    }
}
