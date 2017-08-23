<?php

/* MinsalLaboratorioBundle:CRUD:SecSolicitudestudios/list__action_show.html.twig */
class __TwigTemplate_690978a60fd6d4299d48cb6ef1d7d01b0ee0da876fc1a7778447752da0b20e8c extends Twig_Template
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
        // line 2
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "VIEW", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "show"), "method"))) {
            // line 3
            echo "    <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_minsal_laboratorio_secsolicitudestudios_show", array("id" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"), "idEstablecimiento" => $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEstablecimiento", array(), "method"), "getId", array(), "method"), "external" => (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "_external"), "method")) ? ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "_external"), "method")) : ((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "lab_external"), "method")) ? ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "lab_external"), "method")) : ("false")))), "idSolicitudEstudio" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"))), "html", null, true);
            echo "\" class=\"btn btn-sm btn-default view_link\" title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_show", array(), "SonataAdminBundle"), "html", null, true);
            echo "\">
        <i class=\"glyphicon glyphicon-zoom-in\"></i>
        ";
            // line 5
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_show", array(), "SonataAdminBundle"), "html", null, true);
            echo "
    </a>
";
        }
    }

    public function getTemplateName()
    {
        return "MinsalLaboratorioBundle:CRUD:SecSolicitudestudios/list__action_show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 28,  81 => 20,  76 => 35,  73 => 34,  56 => 28,  53 => 18,  51 => 26,  38 => 21,  32 => 16,  24 => 12,  21 => 3,  48 => 25,  45 => 24,  34 => 18,  31 => 16,  29 => 5,  26 => 14,  22 => 12,  19 => 2,  635 => 226,  624 => 224,  620 => 223,  612 => 220,  607 => 218,  601 => 216,  599 => 215,  594 => 212,  585 => 209,  580 => 207,  577 => 206,  574 => 205,  572 => 204,  566 => 203,  563 => 202,  559 => 201,  555 => 200,  551 => 199,  545 => 198,  536 => 194,  532 => 192,  529 => 191,  526 => 190,  523 => 189,  518 => 180,  514 => 167,  511 => 166,  507 => 165,  504 => 164,  501 => 163,  497 => 156,  493 => 155,  490 => 154,  485 => 124,  474 => 122,  470 => 121,  463 => 117,  459 => 116,  455 => 115,  450 => 114,  447 => 113,  424 => 91,  421 => 90,  415 => 127,  412 => 126,  410 => 113,  406 => 111,  404 => 90,  401 => 89,  398 => 88,  393 => 168,  391 => 163,  385 => 159,  381 => 157,  379 => 154,  376 => 153,  369 => 148,  359 => 144,  354 => 142,  351 => 141,  347 => 140,  340 => 136,  335 => 133,  333 => 132,  329 => 130,  326 => 129,  323 => 88,  320 => 87,  318 => 86,  313 => 84,  310 => 83,  307 => 82,  302 => 79,  287 => 77,  284 => 76,  281 => 75,  264 => 74,  261 => 73,  258 => 72,  252 => 68,  246 => 67,  243 => 66,  239 => 64,  235 => 63,  230 => 62,  224 => 61,  212 => 60,  210 => 59,  207 => 58,  204 => 57,  201 => 56,  198 => 55,  195 => 54,  192 => 53,  189 => 52,  186 => 51,  183 => 50,  180 => 49,  178 => 48,  175 => 47,  173 => 46,  169 => 44,  163 => 40,  160 => 39,  156 => 38,  152 => 36,  149 => 35,  144 => 26,  134 => 182,  131 => 181,  129 => 180,  126 => 179,  120 => 176,  117 => 175,  114 => 174,  110 => 172,  108 => 171,  105 => 170,  103 => 82,  100 => 81,  98 => 72,  95 => 71,  93 => 35,  90 => 34,  85 => 32,  80 => 31,  77 => 30,  74 => 29,  72 => 28,  69 => 27,  67 => 19,  62 => 24,  55 => 21,  49 => 17,  42 => 23,  39 => 20,  66 => 17,  61 => 29,  58 => 22,  50 => 11,  47 => 10,  44 => 9,  36 => 20,  33 => 4,  30 => 13,);
    }
}
