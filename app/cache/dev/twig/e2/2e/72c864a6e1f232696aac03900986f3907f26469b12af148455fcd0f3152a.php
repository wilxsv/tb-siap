<?php

/* SonataAdminBundle:CRUD:edit.html.twig */
class __TwigTemplate_e22e72c864a6e1f232696aac03900986f3907f26469b12af148455fcd0f3152a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_edit.html.twig");

        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  828 => 682,  825 => 681,  804 => 662,  760 => 621,  692 => 555,  681 => 553,  677 => 552,  660 => 537,  657 => 536,  543 => 425,  468 => 353,  459 => 346,  455 => 344,  447 => 340,  445 => 339,  441 => 338,  438 => 337,  436 => 336,  411 => 313,  408 => 312,  404 => 310,  396 => 306,  394 => 305,  390 => 304,  387 => 303,  384 => 302,  382 => 301,  356 => 277,  353 => 276,  349 => 274,  341 => 270,  339 => 269,  335 => 268,  332 => 267,  329 => 266,  327 => 265,  202 => 143,  149 => 93,  79 => 29,  58 => 12,  55 => 11,  48 => 8,  45 => 7,  40 => 5,  14 => 4,);
    }
}
