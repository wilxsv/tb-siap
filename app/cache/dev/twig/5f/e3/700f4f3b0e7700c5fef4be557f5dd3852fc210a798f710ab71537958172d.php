<?php

/* SonataDoctrineORMAdminBundle:CRUD:list_orm_one_to_one.html.twig */
class __TwigTemplate_5fe3700f4f3b0e7700c5fef4be557f5dd3852fc210a798f710ab71537958172d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        if (((($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "hasAssociationAdmin") && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin"), "id", array(0 => (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))), "method")) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin"), "isGranted", array(0 => "EDIT", 1 => (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))), "method")) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin"), "hasRoute", array(0 => "edit"), "method"))) {
            // line 16
            echo "        <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin"), "generateObjectUrl", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "route"), "name"), 1 => (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), 2 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options"), "route"), "parameters")), "method"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))), "html", null, true);
            echo "</a>
    ";
        } else {
            // line 18
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))), "html", null, true);
            echo "
    ";
        }
    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:list_orm_one_to_one.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 18,  32 => 16,  29 => 15,  26 => 14,  724 => 258,  713 => 256,  709 => 255,  685 => 252,  680 => 250,  674 => 248,  672 => 247,  667 => 244,  658 => 241,  653 => 239,  650 => 238,  647 => 237,  645 => 236,  639 => 235,  636 => 234,  632 => 233,  628 => 232,  624 => 231,  602 => 230,  593 => 226,  589 => 224,  586 => 223,  583 => 222,  580 => 221,  575 => 212,  571 => 199,  568 => 198,  564 => 197,  561 => 196,  558 => 195,  554 => 188,  550 => 187,  547 => 186,  542 => 156,  531 => 154,  527 => 153,  520 => 149,  516 => 148,  512 => 147,  507 => 146,  504 => 145,  481 => 123,  478 => 122,  472 => 159,  469 => 158,  467 => 145,  463 => 143,  461 => 122,  458 => 121,  455 => 120,  450 => 200,  448 => 195,  442 => 191,  438 => 189,  436 => 186,  433 => 185,  426 => 180,  416 => 176,  411 => 174,  408 => 173,  404 => 172,  397 => 168,  392 => 165,  390 => 164,  386 => 162,  383 => 161,  380 => 120,  377 => 119,  375 => 118,  370 => 116,  367 => 115,  364 => 114,  359 => 111,  344 => 109,  341 => 108,  338 => 107,  321 => 106,  318 => 105,  315 => 104,  309 => 100,  303 => 99,  300 => 98,  296 => 96,  292 => 95,  287 => 94,  281 => 93,  269 => 92,  267 => 91,  264 => 90,  261 => 89,  258 => 88,  255 => 87,  252 => 86,  249 => 85,  246 => 84,  243 => 83,  240 => 82,  237 => 81,  235 => 80,  232 => 79,  230 => 78,  226 => 76,  220 => 72,  217 => 71,  213 => 70,  209 => 68,  206 => 67,  201 => 58,  191 => 214,  188 => 213,  186 => 212,  183 => 211,  177 => 208,  174 => 207,  171 => 206,  167 => 204,  165 => 203,  162 => 202,  160 => 114,  157 => 113,  155 => 104,  152 => 103,  150 => 67,  147 => 66,  142 => 64,  137 => 63,  134 => 62,  131 => 61,  129 => 60,  126 => 59,  124 => 58,  119 => 56,  115 => 54,  105 => 46,  102 => 45,  99 => 44,  93 => 41,  85 => 37,  82 => 36,  79 => 35,  71 => 31,  68 => 30,  65 => 29,  51 => 17,  49 => 16,  44 => 15,  41 => 14,);
    }
}
