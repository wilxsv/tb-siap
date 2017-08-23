<?php

/* MinsalSeguimientoBundle:SecHistorialClinico:show.html.twig */
class __TwigTemplate_9362907c8106e6e3f73dcd3ddef99ed97dd7ad3629e2c4cdfdc959a3e32b634f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'sonata_header' => array($this, 'block_sonata_header'),
            'javascripts' => array($this, 'block_javascripts'),
            'actions' => array($this, 'block_actions'),
            'tab_menu' => array($this, 'block_tab_menu'),
            'show' => array($this, 'block_show'),
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

    // line 3
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 4
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == false)) {
            // line 5
            $this->displayParentBlock("sonata_header", $context, $blocks);
            echo "
";
        }
    }

    // line 9
    public function block_javascripts($context, array $blocks = array())
    {
        // line 10
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

<script type=\"text/javascript\">

window.openOrFocus = function(url, name) {
    if (!window.popups)
        window.popups = {};
        if (window.popups[name])
            window.popups[name].close();
            window.popups[name] = window.open(url, name);
        };

    jQuery(document).ready(function(\$) {
            \$(\"#imprimirHC\").on(\"click\", function () {
                var tipo = \"\";
                var winParams = [];


                winParams['method'] = \"post\";
                winParams['action'] = \"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_imprimir_historia_clinica", array("id" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getId", array(), "method"))), "html", null, true);
        echo "\";
                winParams['target'] = \"Imprimir Historial Clinico de ";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdExpediente", array(), "method"), "getIdPaciente", array(), "method"), "html", null, true);
        echo "\";
                //winParams['parameters'] = parameters;
                openPostPopUpWindows(winParams);
            });
    });

        </script>
    ";
    }

    // line 39
    public function block_actions($context, array $blocks = array())
    {
        // line 40
        echo "    ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == false)) {
            // line 41
            echo "    <li>";
            $this->env->loadTemplate("SonataAdminBundle:Button:edit_button.html.twig")->display($context);
            echo "</li>
    <li>";
            // line 42
            $this->env->loadTemplate("SonataAdminBundle:Button:history_button.html.twig")->display($context);
            echo "</li>
    <li>";
            // line 43
            $this->env->loadTemplate("SonataAdminBundle:Button:list_button.html.twig")->display($context);
            echo "</li>
    <li>";
            // line 44
            $this->env->loadTemplate("SonataAdminBundle:Button:create_button.html.twig")->display($context);
            echo "</li>
    ";
        }
        // line 46
        echo "    ";
    }

    // line 48
    public function block_tab_menu($context, array $blocks = array())
    {
        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active"), "list");
    }

    // line 52
    public function block_show($context, array $blocks = array())
    {
        // line 53
        echo "<div class=\"sonata-ba-view\">
    ";
        // line 54
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true)) {
            // line 55
            echo "    <div class=\"container-fluid\">
        <div class=\"row\">
            <div class=\"pull-right\">
                <button type=\"button\" class=\"btn btn-info\" onclick=\"window.history.back();\"><i class=\"fa fa-fw fa-arrow-circle-left\"></i> Regresar</button>
                <button type=\"button\" class=\"btn btn-info\" id=\"imprimirHC\"><i class=\"fa fa-print\"></i> &nbsp;Imprimir&nbsp;</button>
                <button type=\"button\" class=\"btn btn-default\" onclick=\"window.close();\"><i class=\"fa fa-fw fa-times-circle\"></i> &nbsp;Cerrar&nbsp;</button>
            </div>
        </div>
    </div><br/>
    ";
        }
        // line 65
        echo "    ";
        $this->env->loadTemplate("MinsalSeguimientoBundle:SecHistorialClinico:body_show.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecHistorialClinico:show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 65,  125 => 55,  123 => 54,  120 => 53,  117 => 52,  111 => 48,  107 => 46,  102 => 44,  98 => 43,  94 => 42,  89 => 41,  86 => 40,  83 => 39,  71 => 30,  67 => 29,  45 => 10,  42 => 9,  35 => 5,  33 => 4,  30 => 3,);
    }
}
