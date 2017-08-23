<?php

/* SonataAdminBundle:CRUD:list.html.twig */
class __TwigTemplate_f6f50ae4048c339688b1216026f6860ee87f7e6bf5934e2bc784f9eaafee57e4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:base_list.html.twig");

        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 17,  61 => 16,  58 => 15,  50 => 11,  47 => 10,  44 => 9,  36 => 5,  33 => 4,  30 => 3,);
    }
}
