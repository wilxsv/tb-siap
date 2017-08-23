<?php

/* MinsalSeguimientoBundle:SecAntecedentes:edit.html.twig */
class __TwigTemplate_2018a12a4282b833b06dd4b877cf4c60f7b23aacc5aa09c3d74815b480393e42 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");

        $this->blocks = array(
            'sonata_header' => array($this, 'block_sonata_header'),
            'actions' => array($this, 'block_actions'),
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 3
        echo "    ";
        if (array_key_exists("expediente", $context)) {
            // line 4
            echo "        ";
            $this->displayParentBlock("sonata_header", $context, $blocks);
            echo "
    ";
        }
    }

    // line 7
    public function block_actions($context, array $blocks = array())
    {
        // line 8
        echo "
";
    }

    // line 10
    public function block_javascripts($context, array $blocks = array())
    {
        // line 11
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script type=\"text/javascript\">

        ";
        // line 15
        echo (isset($context["itemsActionJs"]) ? $context["itemsActionJs"] : $this->getContext($context, "itemsActionJs"));
        echo "

        var idInputsYearCalc = ['form_i280_s123','form_i293_s123','form_i295_s123','form_i297_s123','form_i299_s123','form_i301_s123',
                                'form_i303_s123','form_i305_s123','form_i307_s123','form_i309_s123','form_i311_s123','form_i313_s123',
                                'form_i263_s124','form_i317_s124','form_i320_s124','form_i321_s124',
                                'form_i280_s86','form_i293_s86','form_i295_s86','form_i297_s86','form_i299_s86','form_i301_s86',
                                'form_i303_s86','form_i305_s86','form_i307_s86','form_i309_s86','form_i311_s86','form_i313_s86',
                                'form_i263_s89','form_i317_s89','form_i320_s89','form_i321_s89'
                                ];

        jQuery(document).ready(function (\$) {

            \$.each( idInputsYearCalc, function( index, value ){
                addAuxYearCalc(\$('#'+value));
            });

            ";
        // line 31
        if (array_key_exists("cerrar", $context)) {
            // line 32
            echo "                ";
            if ((isset($context["cerrar"]) ? $context["cerrar"] : $this->getContext($context, "cerrar"))) {
                // line 33
                echo "                        window.close();
                ";
            }
            // line 35
            echo "            ";
        }
        // line 36
        echo "
            ";
        // line 37
        if (((isset($context["idFormulario"]) ? $context["idFormulario"] : $this->getContext($context, "idFormulario")) == 6)) {
            // line 38
            echo "                \$('input[id^=\"form_i354_\"]').on('change', function(){
                    if( \$(this).val() == '0' ){
                        \$('input[id^=\"form_i355_\"]').val('0');
                        \$('input[id^=\"form_i356_\"]').val('0');
                        \$('input[id^=\"form_i357_\"]').val('0');
                        \$('input[id^=\"form_i358_\"]').val('0');
                    }
                });
            ";
        }
        // line 47
        echo "            
            ";
        // line 48
        if (((isset($context["idFormulario"]) ? $context["idFormulario"] : $this->getContext($context, "idFormulario")) == 32)) {
            // line 49
            echo "                \$('input[id^=\"form_i656_\"]').on('change', function(){
                    if( \$(this).val() == '0' ){
                        \$('input[id^=\"form_i657_\"]').val('0');
                        \$('input[id^=\"form_i658_\"]').val('0');
                        \$('input[id^=\"form_i659_\"]').val('0');
                        \$('input[id^=\"form_i660_\"]').val('0');
                    }
                });
            ";
        }
        // line 58
        echo "

        });//fin document ready
    </script>
";
    }

    // line 64
    public function block_content($context, array $blocks = array())
    {
    }

    // line 67
    public function block_form($context, array $blocks = array())
    {
        // line 68
        echo "    ";
        // line 69
        echo "    ";
        if ((!array_key_exists("expediente", $context))) {
            // line 70
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
        // line 79
        echo "    ";
        $this->displayBlock('sonata_tab_content', $context, $blocks);
        // line 102
        echo "
    ";
    }

    // line 79
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 80
        echo "        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"box box-success\">
                    <div class=\"box-header\">
                        <h4 class=\"box-title\">
                        </h4>
                    </div>
                    <div class=\"box-body\">
                        ";
        // line 88
        if (array_key_exists("expediente", $context)) {
            // line 89
            echo "                            ";
            $this->env->loadTemplate("MinsalSiapsBundle:MntPacienteAdmin:encabezado_paciente.html.twig")->display($context);
            // line 90
            echo "                            ";
            $this->env->loadTemplate("MinsalSeguimientoBundle:SecHistorialClinico:consultar_historial.html.twig")->display($context);
            // line 91
            echo "                        ";
        }
        // line 92
        echo "                        <div class=\"sonata-ba-collapsed-fields\">
                            ";
        // line 93
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "
                            ";
        // line 95
        echo "                            ";
        // line 96
        echo "                        </div>
                    </div>
                </div>
            </div>
        </div>
    ";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecAntecedentes:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  202 => 96,  200 => 95,  196 => 93,  193 => 92,  190 => 91,  187 => 90,  184 => 89,  182 => 88,  172 => 80,  169 => 79,  164 => 102,  161 => 79,  150 => 70,  147 => 69,  145 => 68,  142 => 67,  137 => 64,  129 => 58,  118 => 49,  116 => 48,  113 => 47,  102 => 38,  100 => 37,  97 => 36,  94 => 35,  90 => 33,  87 => 32,  85 => 31,  66 => 15,  58 => 11,  55 => 10,  50 => 8,  47 => 7,  39 => 4,  36 => 3,  33 => 2,);
    }
}
