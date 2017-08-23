<?php

/* MinsalSiapsBundle:Core:dashboard.html.twig */
class __TwigTemplate_23458a4f77f2390e0302e543617ef5a3c107f8c6585488e2bad04512f046565e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 13
    public function block_content($context, array $blocks = array())
    {
        // line 14
        echo "    <!--div id=\"fondo_siaps\"></div-->
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:Core:dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 14,  26 => 13,);
    }
}
