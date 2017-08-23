<?php

/* SonataAdminBundle:Button:history_button.html.twig */
class __TwigTemplate_67714040fc5c67ef4a74e83299f59ac8bf4317cfc3cb2b0d49e5318052cb3ef1 extends Twig_Template
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
        // line 11
        echo "
";
        // line 12
        if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "history"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
            // line 13
            echo "    <a class=\"sonata-action-element\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "history", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
            echo "\">
        <i class=\"fa fa-archive\"></i>
        ";
            // line 15
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_action_history", array(), "SonataAdminBundle"), "html", null, true);
            echo "</a>
";
        }
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Button:history_button.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 12,  19 => 11,  85 => 59,  26 => 2,  20 => 1,  330 => 103,  321 => 100,  315 => 98,  312 => 97,  306 => 95,  303 => 94,  300 => 93,  292 => 91,  290 => 90,  287 => 89,  280 => 87,  275 => 86,  273 => 85,  270 => 84,  264 => 82,  262 => 81,  256 => 79,  253 => 78,  247 => 75,  243 => 73,  240 => 72,  237 => 71,  231 => 69,  225 => 67,  222 => 66,  220 => 65,  217 => 64,  214 => 63,  209 => 58,  206 => 57,  194 => 52,  190 => 49,  184 => 48,  178 => 46,  175 => 45,  171 => 44,  168 => 43,  162 => 41,  160 => 40,  156 => 38,  150 => 34,  142 => 30,  137 => 29,  134 => 28,  129 => 25,  126 => 24,  119 => 108,  112 => 105,  105 => 61,  102 => 60,  100 => 57,  97 => 56,  95 => 28,  92 => 27,  87 => 23,  76 => 18,  73 => 17,  69 => 16,  62 => 14,  59 => 13,  52 => 11,  46 => 8,  43 => 7,  41 => 6,  38 => 5,  36 => 4,  30 => 15,  24 => 13,  116 => 107,  113 => 39,  110 => 63,  104 => 34,  98 => 31,  94 => 30,  90 => 24,  86 => 28,  81 => 20,  78 => 19,  71 => 23,  68 => 22,  60 => 18,  54 => 16,  51 => 15,  12 => 36,  828 => 682,  825 => 681,  804 => 662,  760 => 621,  692 => 555,  681 => 553,  677 => 552,  660 => 537,  657 => 536,  543 => 425,  468 => 353,  459 => 346,  455 => 344,  447 => 340,  445 => 339,  441 => 338,  438 => 337,  436 => 336,  411 => 313,  408 => 312,  404 => 310,  396 => 306,  394 => 305,  390 => 304,  387 => 303,  384 => 302,  382 => 301,  356 => 277,  353 => 276,  349 => 274,  341 => 270,  339 => 269,  335 => 268,  332 => 267,  329 => 266,  327 => 102,  202 => 55,  149 => 93,  79 => 29,  58 => 12,  55 => 12,  48 => 14,  45 => 7,  40 => 5,  14 => 4,);
    }
}
