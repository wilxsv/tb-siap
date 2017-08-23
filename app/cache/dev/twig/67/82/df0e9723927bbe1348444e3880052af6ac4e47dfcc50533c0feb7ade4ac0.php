<?php

/* SonataAdminBundle::user_block.html.twig */
class __TwigTemplate_6782df0e9723927bbe1348444e3880052af6ac4e47dfcc50533c0feb7ade4ac0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'user_block' => array($this, 'block_user_block'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo " ";
        $this->displayBlock('user_block', $context, $blocks);
    }

    public function block_user_block($context, array $blocks = array())
    {
        // line 2
        echo "    ";
        if ($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user")) {
            // line 3
            echo "
        ";
            // line 4
            $context["_bg_class"] = "bg-light-blue";
            // line 5
            echo "        ";
            $context["_logout_uri"] = $this->env->getExtension('routing')->getUrl("sonata_user_admin_security_logout");
            // line 6
            echo "        ";
            $context["_logout_text"] = $this->env->getExtension('translator')->trans("user_block_logout", array(), "SonataUserBundle");
            // line 7
            echo "        ";
            $context["_user_image"] = $this->env->getExtension('assets')->getAssetUrl($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : $this->getContext($context, "sonata_user")), "defaultAvatar"));
            // line 8
            echo "        ";
            // line 9
            echo "        ";
            // line 10
            echo "
        ";
            // line 11
            if (($this->env->getExtension('security')->isGranted("ROLE_PREVIOUS_ADMIN") && $this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : $this->getContext($context, "sonata_user")), "impersonating"))) {
                // line 12
                echo "            ";
                $context["_bg_class"] = "bg-light-green";
                // line 13
                echo "            ";
                $context["_logout_uri"] = $this->env->getExtension('routing')->getUrl($this->getAttribute($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : $this->getContext($context, "sonata_user")), "impersonating"), "route"), twig_array_merge($this->getAttribute($this->getAttribute((isset($context["sonata_user"]) ? $context["sonata_user"] : $this->getContext($context, "sonata_user")), "impersonating"), "parameters"), array("_switch_user" => "_exit")));
                // line 14
                echo "            ";
                $context["_logout_text"] = "(exit)";
                // line 15
                echo "        ";
            }
            // line 16
            echo "
            <li>
                <a href=\"";
            // line 18
            echo twig_escape_filter($this->env, (isset($context["_logout_uri"]) ? $context["_logout_uri"] : $this->getContext($context, "_logout_uri")), "html", null, true);
            echo "\">
                    <i class=\"fa fa-sign-out fa-fw\" style=\"width:25px;\"></i>
                    ";
            // line 20
            echo twig_escape_filter($this->env, (isset($context["_logout_text"]) ? $context["_logout_text"] : $this->getContext($context, "_logout_text")), "html", null, true);
            echo "
                </a>
            </li>
            ";
            // line 23
            if ((((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true) && ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")) && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array(), "any", false, true), "get", array(0 => "_secured_token"), "method", true, true)) && (!(null === $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_secured_token"), "method")))) && ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") != "verify_medic_service"))) {
                // line 26
                echo "                <li>
                    <a href=\"";
                // line 27
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("verify_medic_service", array("_provided_token" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_secured_token"), "method"))), "html", null, true);
                echo "\">
                        <i style=\"width:25px; margin-right: 10px;\">
                            <span class=\"glyphicon glyphicon-user\" style=\"margin-right: 0;font-size: 10px;\"></span>
                            <span class=\"glyphicon glyphicon-log-in\" style=\"margin-right: 0;font-size: 10px;\"></span>
                        </i>
                        Cambiar de Especialidad
                    </a>
                </li>
            ";
            }
            // line 36
            echo "            ";
            if (!twig_in_filter($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_moduleSelection"), "method"), twig_split_filter((isset($context["signed_modules"]) ? $context["signed_modules"] : $this->getContext($context, "signed_modules")), ","))) {
                // line 37
                echo "                <li>
                    <a href=\"";
                // line 38
                echo $this->env->getExtension('routing')->getUrl("fos_user_change_password");
                echo "\">
                        <span class=\"glyphicon glyphicon-pencil\" style=\"width:25px;\"></span>
                        Cambiar Contraseña
                    </a>
                <li>
            ";
            }
            // line 44
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle::user_block.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  112 => 44,  103 => 38,  100 => 37,  97 => 36,  82 => 26,  80 => 23,  74 => 20,  69 => 18,  65 => 16,  59 => 14,  56 => 13,  53 => 12,  51 => 11,  48 => 10,  46 => 9,  38 => 6,  35 => 5,  33 => 4,  30 => 3,  27 => 2,  20 => 1,  170 => 85,  165 => 83,  160 => 82,  158 => 81,  151 => 76,  145 => 73,  141 => 71,  139 => 70,  134 => 69,  131 => 68,  126 => 66,  85 => 27,  81 => 25,  78 => 24,  67 => 22,  62 => 15,  60 => 20,  44 => 8,  41 => 7,  34 => 4,  31 => 3,);
    }
}
