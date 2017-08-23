<?php

/* SonataUserBundle:Admin:Security/login.html.twig */
class __TwigTemplate_f1c2a90e83bcd2060ce8b36c2bcf8cc23604eb2f33e061f5cfab4a1788efd4ec extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_nav' => array($this, 'block_sonata_nav'),
            'sonata_header' => array($this, 'block_sonata_header'),
            'logo' => array($this, 'block_logo'),
            'sonata_left_side' => array($this, 'block_sonata_left_side'),
            'body_attributes' => array($this, 'block_body_attributes'),
            'sonata_wrapper' => array($this, 'block_sonata_wrapper'),
            'sonata_user_login_form' => array($this, 'block_sonata_user_login_form'),
            'sonata_user_login_error' => array($this, 'block_sonata_user_login_error'),
            'session_messages' => array($this, 'block_session_messages'),
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
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/corelogin.css"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 9
    public function block_javascripts($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script type=\"text/javascript\">
        jQuery(document).ready(function (\$) {
            \$('body').append('</div>');

            \$('#_digitalSignature').on('change', function () {
                var file = this.files[0];
                var name = file.name;
                var size = file.size;
                var type = file.type;
                /* if(type !== 'application/x-pkcs12') {
                 \$(this).val('');
                 \$('#fileInfo').val('');
                 if(\$('div#dialog-message').length == 0) {
                 \$('body').append('<div id=\"dialog-message\"></div>');
                 } else {
                 \$('#dialog-message').empty();
                 }

                 \$(\"#dialog-message\").append('<p><i class=\"icon-warning-sign\" style=\"margin-right:7px;\"></i>\\
                 El archivo seleccionado no es un archivo de tipo <b>Firma digital</b> cuya extensi&oacute;n debe ser <b>.p12</b>,\\
                 <br />Por favor seleccione un nuevo archivo.</p>');

                 \$(\"#dialog-message\").dialog({
                 dialogClass: \"dialog-warning\",
                 modal: true,
                 title: 'Tipo de archivo incorrecto!!!',
                 buttons: {
                 Cerrar: function() {
                 \$( this ).dialog( \"close\" );
                 }
                 }
                 });
                 } else {*/
                \$('#fileInfo').val(\$(this).val().replace(\"C:\\\\fakepath\\\\\", \"\"));
                //  }
            });

            ";
        // line 49
        if (array_key_exists("module", $context)) {
            // line 50
            echo "                var url = window.location;
                //truco para añadir a la url el modulo seleccionado en la primera pagina de login
                if (window.location.href.indexOf('_moduleSelection') == -1) {
                    window.history.replaceState(\"object or string\", \"Title\", \"?";
            // line 53
            echo twig_escape_filter($this->env, (isset($context["module"]) ? $context["module"] : $this->getContext($context, "module")), "html", null, true);
            echo "\");
                }
            ";
        }
        // line 56
        echo "        });
    </script>
";
    }

    // line 60
    public function block_sonata_nav($context, array $blocks = array())
    {
    }

    // line 63
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 64
        echo "    <div id=\"wrapper\">
        <header class=\"header\">
            ";
        // line 66
        $this->displayBlock('logo', $context, $blocks);
        // line 69
        echo "        </header>
    ";
    }

    // line 66
    public function block_logo($context, array $blocks = array())
    {
        // line 67
        echo "                <center><img class=\"banner\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/banner.png"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" alt=\"Ministerio de Salud banner\" /></center>
                ";
    }

    // line 72
    public function block_sonata_left_side($context, array $blocks = array())
    {
        // line 73
        echo "    ";
    }

    // line 75
    public function block_body_attributes($context, array $blocks = array())
    {
        echo "class=\"sonata-bc bg-black\"";
    }

    // line 77
    public function block_sonata_wrapper($context, array $blocks = array())
    {
        // line 78
        echo "        prueba
        <div class=\"form-box\" id=\"login-box\">
            <div class=\"header\">";
        // line 80
        echo "</div>
            ";
        // line 81
        $this->displayBlock('sonata_user_login_form', $context, $blocks);
        // line 137
        echo "        </div>
        <div class=\"page-footer\"><img class=\"dtic-footer\" src=\"";
        // line 138
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/images/dtic.png"), "html", null, true);
        echo "?v=";
        echo twig_escape_filter($this->env, (isset($context["_version"]) ? $context["_version"] : $this->getContext($context, "_version")), "html", null, true);
        echo "\" alt=\"dtic\"/>Direcci&oacute;n de Tecnolog&iacute;as de Informaci&oacute;n y Comunicaciones - Ministerio de Salud</div>
        ";
    }

    // line 81
    public function block_sonata_user_login_form($context, array $blocks = array())
    {
        // line 82
        echo "                <form action=\"";
        echo $this->env->getExtension('routing')->getPath("sonata_user_admin_security_check");
        echo "\" method=\"post\" role=\"form\" enctype=\"multipart/form-data\">
                    <div class=\"body bg-gray\">
                        ";
        // line 84
        $this->displayBlock('sonata_user_login_error', $context, $blocks);
        // line 89
        echo "
                        ";
        // line 90
        $this->displayBlock('session_messages', $context, $blocks);
        // line 100
        echo "
                        <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 101
        echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : $this->getContext($context, "csrf_token")), "html", null, true);
        echo "\"/>
                        <input type=\"hidden\" name=\"_moduleSelection\" value=\"";
        // line 102
        echo twig_escape_filter($this->env, twig_slice($this->env, (isset($context["module"]) ? $context["module"] : $this->getContext($context, "module")), (-1), 1), "html", null, true);
        echo "\" />
                        <div class=\"form-group control-group\">
                            ";
        // line 104
        if (!twig_in_filter(twig_slice($this->env, (isset($context["module"]) ? $context["module"] : $this->getContext($context, "module")), (-1), 1), (isset($context["signed_modules"]) ? $context["signed_modules"] : $this->getContext($context, "signed_modules")))) {
            // line 105
            echo "                                <label for=\"username\" style=\"text-align:left;\">Nombre de Usuario</label>
                                <input type=\"text\" class=\"form-control\" id=\"username\"  name=\"_username\" value=\"";
            // line 106
            echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
            echo "\" required=\"required\" placeholder=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.username", array(), "SonataUserBundle"), "html", null, true);
            echo "\"/>
                            ";
        } else {
            // line 108
            echo "                                <label for=\"digtalSignature\" style=\"text-align:left;\">Firma digital</label>
                                <div class=\"custom_file_upload form-control\">
                                    <input type=\"text\" id=\"fileInfo\" class=\"file_info\" placeholder=\"Seleccionar firma digital\" name=\"_username\" readonly />
                                    <div class=\"file_upload\">
                                        <input type=\"file\" id=\"_digitalSignature\" name=\"_digitalSignature\" />
                                    </div>
                                </div>
                            ";
        }
        // line 116
        echo "                        </div>


                        <div class=\"form-group control-group\">
                            <label>Contrase&ntilde;a</label>
                            <input type=\"password\" class=\"form-control\" id=\"password\" name=\"_password\" required=\"required\" placeholder=\"";
        // line 121
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.password", array(), "SonataUserBundle"), "html", null, true);
        echo "\"/>
                        </div>

                        <!--<div class=\"form-group\">
                            <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\"/>
                        ";
        // line 126
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "
                    </div>-->

                    </div>

                    <div class=\"footer\">
                        <center><button type=\"submit\" id=\"_submit\" name=\"_submit\" class=\"btn btn-primary btn-block\">";
        // line 132
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "</button></center>
                        <!--<p><a href=\"";
        // line 133
        echo $this->env->getExtension('routing')->getPath("fos_user_resetting_request");
        echo "\" class=\"text-center\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("forgotten_password", array(), "SonataUserBundle"), "html", null, true);
        echo "</a></p>-->
                    </div>
                </form>
            ";
    }

    // line 84
    public function block_sonata_user_login_error($context, array $blocks = array())
    {
        // line 85
        echo "                            ";
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 86
            echo "                                <div class=\"alert alert-danger alert-error\">";
            echo $this->env->getExtension('translator')->trans((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), array(), "FOSUserBundle");
            echo "</div>
                            ";
        }
        // line 88
        echo "                        ";
    }

    // line 90
    public function block_session_messages($context, array $blocks = array())
    {
        // line 91
        echo "                            ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sessionMsjType"]) ? $context["sessionMsjType"] : $this->getContext($context, "sessionMsjType")));
        foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
            // line 92
            echo "                                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["msj"]) ? $context["msj"] : $this->getContext($context, "msj")), (isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), array(), "array"));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 93
                echo "                                    <div class=\"alert alert-";
                echo twig_escape_filter($this->env, (isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "html", null, true);
                echo " alert-dismissable\">
                                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                        ";
                // line 95
                echo (isset($context["message"]) ? $context["message"] : $this->getContext($context, "message"));
                echo "
                                    </div>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 98
            echo "                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 99
        echo "                        ";
    }

    public function getTemplateName()
    {
        return "SonataUserBundle:Admin:Security/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  323 => 99,  317 => 98,  308 => 95,  302 => 93,  297 => 92,  292 => 91,  289 => 90,  285 => 88,  279 => 86,  276 => 85,  273 => 84,  263 => 133,  259 => 132,  250 => 126,  242 => 121,  235 => 116,  225 => 108,  218 => 106,  215 => 105,  213 => 104,  208 => 102,  204 => 101,  201 => 100,  199 => 90,  196 => 89,  194 => 84,  188 => 82,  185 => 81,  177 => 138,  174 => 137,  172 => 81,  169 => 80,  165 => 78,  162 => 77,  156 => 75,  152 => 73,  149 => 72,  140 => 67,  137 => 66,  132 => 69,  130 => 66,  126 => 64,  123 => 63,  118 => 60,  112 => 56,  106 => 53,  101 => 50,  99 => 49,  56 => 10,  53 => 9,  45 => 6,  39 => 4,  36 => 3,);
    }
}
