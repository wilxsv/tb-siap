<?php

/* MinsalSeguimientoBundle:TarSolicitudFvih01:edit_v2.html.twig */
class __TwigTemplate_baa6cc9cebc75bdf5a338cce379a212de88399cc05153a5ccad64501991139ca extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");

        $this->blocks = array(
            'sonata_header' => array($this, 'block_sonata_header'),
            'javascripts' => array($this, 'block_javascripts'),
            'content' => array($this, 'block_content'),
            'form' => array($this, 'block_form'),
            'sonata_tab_content' => array($this, 'block_sonata_tab_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["url_parameters"] = array("_external" => "true", "_modulo" => "seguimiento_clinico", "tipoPacPertenencia" => "local");
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        if (array_key_exists("expediente", $context)) {
            // line 5
            echo "        ";
            $this->displayParentBlock("sonata_header", $context, $blocks);
            echo "
    ";
        }
    }

    // line 9
    public function block_javascripts($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script type=\"text/javascript\">

        ";
        // line 14
        echo (isset($context["itemsActionJs"]) ? $context["itemsActionJs"] : $this->getContext($context, "itemsActionJs"));
        echo "

        function habilitarGuardar() {
            \$('#form_save').attr(\"disabled\",false);
        }

        function setVerificarSumeve(status) {
            \$('#form_verificarSumeve').val(status);
        }

        function seleccionarIdp(idp) {

            \$('#form_save').attr(\"disabled\",false);
            //\$('#idp').value=idp;
            document.getElementById(\"form_idp\").value = idp;
            // window.location.reload();
        }
            jQuery(document).ready(function (\$) {
                \$(\"#form_check\").removeAttr(\"style\");
                if( \$('#form_verificarSumeve').val() == 'true' ){
                    \$(\"#form_save\").attr(\"disabled\",true);
                }

                \$('#form_check').on(\"click\", function () {
                    var parameters= ";
        // line 38
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                    var winParams = [];
                    var path = Routing.generate('verify_datos_pacientes_sumeve',{'idpac':";
        // line 40
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdpaciente", array(), "method"), "getId", array(), "method"), "html", null, true);
        echo "});

                    winParams['method'] = \"get\";
                    winParams['action'] = path;
                    winParams['target'] = \"Remision de Paciente\";
                    winParams['parameters'] = parameters;

                    openPostPopUpWindows(winParams);
                });

                ";
        // line 50
        if ((!(null === $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdOcupacion", array(), "method")))) {
            // line 51
            echo "                    \$('select[id^=\"form_i679_\"]').select2('val', ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdOcupacion", array(), "method"), "getId", array(), "method"), "html", null, true);
            echo ");
                ";
        }
        // line 53
        echo "
                ";
        // line 54
        if ((!(null === (isset($context["sexualidad"]) ? $context["sexualidad"] : $this->getContext($context, "sexualidad"))))) {
            // line 55
            echo "                    /* Sexualidad */
                    \$('select[id^=\"form_i574_\"]').select2('val', ";
            // line 56
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sexualidad"]) ? $context["sexualidad"] : $this->getContext($context, "sexualidad")), "getIdOrientacionSexual", array(), "method"), "getId", array(), "method"), "html", null, true);
            echo " );
                    \$('select[id^=\"form_i574_\"]').select2(\"readonly\", true);
                    \$('select[id^=\"form_i575_\"]').select2('val', ";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sexualidad"]) ? $context["sexualidad"] : $this->getContext($context, "sexualidad")), "getIdentidadSexual", array(), "method"), "getId", array(), "method"), "html", null, true);
            echo " );
                    \$('select[id^=\"form_i575_\"]').select2(\"readonly\", true);

                    if( ";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sexualidad"]) ? $context["sexualidad"] : $this->getContext($context, "sexualidad")), "getIdentidadSexual", array(), "method"), "getId", array(), "method"), "html", null, true);
            echo " == 6 ){
                        \$('input[id^=\"form_i576_\"][value=5]').iCheck('check');
                    }
                ";
        }
        // line 65
        echo "
                ";
        // line 66
        if ((!(null === (isset($context["trabajoSexual"]) ? $context["trabajoSexual"] : $this->getContext($context, "trabajoSexual"))))) {
            // line 67
            echo "                    ";
            if (($this->getAttribute($this->getAttribute((isset($context["trabajoSexual"]) ? $context["trabajoSexual"] : $this->getContext($context, "trabajoSexual")), "getIdRespuestaBasica", array(), "method"), "getId", array(), "method") == 1)) {
                // line 68
                echo "                        \$('input[id^=\"form_i576_\"][value=4]').iCheck('check');
                    ";
            }
            // line 70
            echo "                ";
        }
        // line 71
        echo "
                ";
        // line 72
        if (($this->getAttribute($this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "getIdCondicionPersona"), "getId", array(), "method") != 1)) {
            // line 73
            echo "                    \$('label[for=\"form_section167\"]').hide();
                    \$('#divSection167').hide();
                ";
        }
        // line 76
        echo "
                ";
        // line 77
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdDatoEmbarazo", array(), "method")) {
            // line 78
            echo "                    ";
            if ((!(null === $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdDatoEmbarazo", array(), "method"), "getIdEstablecimientoControl", array(), "method")))) {
                // line 79
                echo "                        \$('input[id^=\"form_i548_\"][value=1]').iCheck('check');
                    ";
            }
            // line 81
            echo "                ";
        }
        // line 82
        echo "
            });//fin document ready

    </script>
";
    }

    // line 88
    public function block_content($context, array $blocks = array())
    {
    }

    // line 91
    public function block_form($context, array $blocks = array())
    {
        // line 92
        echo "    ";
        // line 93
        echo "    ";
        if ((!array_key_exists("expediente", $context))) {
            // line 94
            echo "        <div class=\"container-fluid\">
            <div class=\"row\">
                <div class=\"pull-right\">
                    <button type=\"button\" class=\"btn btn-info\" onclick=\"window.history.back();\"><i class=\"fa fa-fw fa-arrow-circle-left\"></i> Regresar</button>
                    <button type=\"button\" class=\"btn btn-default\" onclick=\"window.close();\"><i class=\"fa fa-fw fa-times-circle\"></i> &nbsp;Cerrar&nbsp;</button>
                </div>
            </div>
        </div><br/>
    ";
        }
        // line 103
        echo "    ";
        $this->displayBlock('sonata_tab_content', $context, $blocks);
    }

    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 104
        echo "        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"box box-success\">
                    <div class=\"box-header\">
                        <h3 class=\"box-title form-title-success\">
                            Formulario para Solicitud y Confirmaci&oacute;n de VIH - FVIH01
                        </h3>
                    </div>
                    <div class=\"box-body\">
                        ";
        // line 113
        if (array_key_exists("expediente", $context)) {
            // line 114
            echo "                            ";
            $this->env->loadTemplate("MinsalSiapsBundle:MntPacienteAdmin:encabezado_paciente.html.twig")->display($context);
            // line 115
            echo "                            ";
            $this->env->loadTemplate("MinsalSeguimientoBundle:SecHistorialClinico:consultar_historial.html.twig")->display($context);
            // line 116
            echo "                        ";
        }
        // line 117
        echo "                        <div class=\"sonata-ba-collapsed-fields\">
                            ";
        // line 118
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "
                        </div>

                    </div>
                </div>
            </div>
        </div>
    ";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:TarSolicitudFvih01:edit_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  242 => 118,  239 => 117,  236 => 116,  233 => 115,  230 => 114,  228 => 113,  217 => 104,  210 => 103,  199 => 94,  196 => 93,  194 => 92,  191 => 91,  186 => 88,  178 => 82,  175 => 81,  171 => 79,  168 => 78,  166 => 77,  163 => 76,  158 => 73,  156 => 72,  153 => 71,  150 => 70,  146 => 68,  143 => 67,  141 => 66,  138 => 65,  131 => 61,  125 => 58,  120 => 56,  117 => 55,  115 => 54,  112 => 53,  106 => 51,  104 => 50,  91 => 40,  86 => 38,  59 => 14,  51 => 10,  48 => 9,  40 => 5,  37 => 4,  34 => 3,  29 => 2,);
    }
}
