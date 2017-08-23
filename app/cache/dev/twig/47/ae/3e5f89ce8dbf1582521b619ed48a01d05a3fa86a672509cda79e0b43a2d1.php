<?php

/* MinsalLaboratorioBundle:CRUD:SecSolicitudestudios/list.html.twig */
class __TwigTemplate_47ae3e5f89ce8dbf1582521b619ed48a01d05a3fa86a672509cda79e0b43a2d1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:list.html.twig");

        $this->blocks = array(
            'sonata_header' => array($this, 'block_sonata_header'),
            'actions' => array($this, 'block_actions'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == false)) {
            // line 5
            echo "        ";
            $this->displayParentBlock("sonata_header", $context, $blocks);
            echo "
    ";
        }
    }

    // line 9
    public function block_actions($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == false)) {
            // line 11
            echo "        <li>";
            $this->env->loadTemplate("SonataAdminBundle:Core:create_button.html.twig")->display($context);
            echo "</li>
    ";
        }
    }

    // line 15
    public function block_javascripts($context, array $blocks = array())
    {
        // line 16
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    ";
        // line 17
        $this->env->loadTemplate("MinsalLaboratorioBundle:Custom:SecSolicitudestudios/requestParameters.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "MinsalLaboratorioBundle:CRUD:SecSolicitudestudios/list.html.twig";
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
