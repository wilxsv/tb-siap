<?php

/* MinsalLaboratorioBundle:Custom:SecSolicitudestudios/requestParameters.html.twig */
class __TwigTemplate_7b8d1721aabda91b20ea5f7ff3938646ff6090ecbced711c8f472ee6a71976b7 extends Twig_Template
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
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") === "true"))) {
            // line 2
            echo "    <script type=\"text/javascript\">
        jQuery(document).ready(function(\$) {
            var urlComplement = '&_external=";
            // line 4
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external"), "html", null, true);
            echo "&idExpediente=";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idExpediente"), "html", null, true);
            echo "&useProxy=true&idEspecialidadHclinica=";
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
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
            echo "_per_page option\" ).each(function() {
               \$(this).attr('value', \$(this).attr('value') + urlComplement);
            });

            \$( \"form\" ).prepend(
                '<input type=\"hidden\" name=\"_external\" id=\"_external\" value=\"";
            // line 23
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external"), "html", null, true);
            echo "\">' +
                '<input type=\"hidden\" name=\"idExpediente\" id=\"idExpediente\" value=\"";
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idExpediente"), "html", null, true);
            echo "\">' +
                '<input type=\"hidden\" name=\"idEspecialidadHclinica\" id=\"idEspecialidadHclinica\" value=\"";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idEspecialidadHclinica"), "html", null, true);
            echo "\">' +
                '<input type=\"hidden\" name=\"useProxy\" id=\"useProxy\" value=\"false\">'
            );
        });
    </script>
";
        }
    }

    public function getTemplateName()
    {
        return "MinsalLaboratorioBundle:Custom:SecSolicitudestudios/requestParameters.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 23,  46 => 18,  65 => 27,  41 => 19,  238 => 84,  233 => 82,  227 => 80,  217 => 76,  214 => 75,  200 => 73,  197 => 72,  187 => 69,  184 => 68,  177 => 65,  174 => 64,  171 => 63,  168 => 62,  165 => 61,  162 => 60,  157 => 57,  153 => 55,  151 => 54,  146 => 53,  140 => 52,  136 => 50,  125 => 46,  109 => 45,  89 => 39,  86 => 38,  83 => 37,  64 => 30,  111 => 40,  101 => 37,  88 => 33,  79 => 31,  71 => 33,  60 => 26,  99 => 30,  63 => 27,  52 => 23,  40 => 12,  35 => 19,  27 => 14,  25 => 4,  23 => 13,  87 => 28,  81 => 26,  76 => 35,  73 => 24,  56 => 28,  53 => 23,  51 => 25,  38 => 18,  32 => 18,  24 => 13,  21 => 2,  48 => 21,  45 => 20,  34 => 18,  31 => 17,  29 => 16,  26 => 14,  22 => 12,  19 => 1,  635 => 226,  624 => 224,  620 => 223,  612 => 220,  607 => 218,  601 => 216,  599 => 215,  594 => 212,  585 => 209,  580 => 207,  577 => 206,  574 => 205,  572 => 204,  566 => 203,  563 => 202,  559 => 201,  555 => 200,  551 => 199,  545 => 198,  536 => 194,  532 => 192,  529 => 191,  526 => 190,  523 => 189,  518 => 180,  514 => 167,  511 => 166,  507 => 165,  504 => 164,  501 => 163,  497 => 156,  493 => 155,  490 => 154,  485 => 124,  474 => 122,  470 => 121,  463 => 117,  459 => 116,  455 => 115,  450 => 114,  447 => 113,  424 => 91,  421 => 90,  415 => 127,  412 => 126,  410 => 113,  406 => 111,  404 => 90,  401 => 89,  398 => 88,  393 => 168,  391 => 163,  385 => 159,  381 => 157,  379 => 154,  376 => 153,  369 => 148,  359 => 144,  354 => 142,  351 => 141,  347 => 140,  340 => 136,  335 => 133,  333 => 132,  329 => 130,  326 => 129,  323 => 88,  320 => 87,  318 => 86,  313 => 84,  310 => 83,  307 => 82,  302 => 79,  287 => 77,  284 => 76,  281 => 75,  264 => 74,  261 => 73,  258 => 72,  252 => 68,  246 => 67,  243 => 66,  239 => 64,  235 => 63,  230 => 81,  224 => 79,  212 => 74,  210 => 59,  207 => 58,  204 => 57,  201 => 56,  198 => 55,  195 => 54,  192 => 53,  189 => 70,  186 => 51,  183 => 50,  180 => 66,  178 => 48,  175 => 47,  173 => 46,  169 => 44,  163 => 40,  160 => 39,  156 => 38,  152 => 36,  149 => 35,  144 => 26,  134 => 49,  131 => 181,  129 => 47,  126 => 179,  120 => 176,  117 => 175,  114 => 174,  110 => 172,  108 => 171,  105 => 170,  103 => 43,  100 => 42,  98 => 36,  95 => 41,  93 => 35,  90 => 34,  85 => 32,  80 => 36,  77 => 35,  74 => 34,  72 => 28,  69 => 27,  67 => 19,  62 => 25,  55 => 25,  49 => 17,  42 => 20,  39 => 19,  66 => 23,  61 => 29,  58 => 24,  50 => 11,  47 => 10,  44 => 21,  36 => 20,  33 => 16,  30 => 17,);
    }
}
