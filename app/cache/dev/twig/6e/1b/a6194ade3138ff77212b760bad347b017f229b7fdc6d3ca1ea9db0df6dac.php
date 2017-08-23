<?php

/* SonataAdminBundle:Button:list_button.html.twig */
class __TwigTemplate_6e1ba6194ade3138ff77212b760bad347b017f229b7fdc6d3ca1ea9db0df6dac extends Twig_Template
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
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method"))) {
            // line 13
            echo "    <a class=\"sonata-action-element\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list"), "method"), "html", null, true);
            echo "\">
        <i class=\"fa fa-list\"></i>
        ";
            // line 15
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_action_list", array(), "SonataAdminBundle"), "html", null, true);
            echo "</a>
";
        }
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Button:list_button.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 12,  73 => 27,  67 => 24,  61 => 21,  55 => 18,  50 => 16,  37 => 10,  30 => 15,  24 => 13,  19 => 11,  143 => 22,  140 => 21,  126 => 20,  123 => 19,  121 => 18,  117 => 16,  114 => 15,  110 => 14,  108 => 13,  100 => 12,  96 => 10,  94 => 9,  80 => 8,  71 => 7,  68 => 6,  65 => 5,  47 => 4,  44 => 3,  26 => 2,  20 => 1,  470 => 201,  463 => 196,  460 => 195,  442 => 190,  428 => 189,  425 => 188,  422 => 187,  419 => 186,  401 => 185,  398 => 184,  390 => 180,  384 => 177,  375 => 175,  371 => 173,  369 => 172,  366 => 171,  363 => 170,  360 => 169,  357 => 168,  354 => 167,  351 => 166,  348 => 165,  346 => 164,  343 => 163,  340 => 162,  337 => 161,  334 => 160,  331 => 159,  328 => 158,  325 => 157,  323 => 156,  320 => 155,  317 => 154,  314 => 153,  311 => 152,  308 => 151,  305 => 150,  303 => 149,  300 => 148,  298 => 147,  295 => 146,  292 => 145,  289 => 144,  286 => 143,  283 => 142,  280 => 141,  277 => 140,  259 => 139,  257 => 138,  248 => 134,  237 => 125,  233 => 123,  230 => 122,  221 => 119,  217 => 118,  213 => 117,  210 => 116,  205 => 115,  203 => 114,  177 => 91,  170 => 87,  163 => 83,  156 => 79,  149 => 75,  142 => 71,  135 => 67,  118 => 52,  107 => 43,  104 => 42,  101 => 41,  77 => 21,  74 => 20,  66 => 16,  63 => 15,  60 => 14,  52 => 17,  49 => 9,  46 => 14,  40 => 11,  35 => 9,  32 => 3,);
    }
}
