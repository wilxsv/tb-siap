<?php

/* MinsalSeguimientoBundle:SecHistorialClinico:historiaClinicaGeneral.html.twig */
class __TwigTemplate_e63fc58544c0dbe8822784c321eea738e6ecc99cf259c0bbe2bd75b4e86022fd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
            'content' => array($this, 'block_content'),
            'sonata_breadcrumb' => array($this, 'block_sonata_breadcrumb'),
            'actions' => array($this, 'block_actions'),
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

    // line 3
    public function block_javascripts($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script type=\"text/javascript\">

        ";
        // line 8
        echo (isset($context["itemsActionJs"]) ? $context["itemsActionJs"] : $this->getContext($context, "itemsActionJs"));
        echo "

    </script>
    <script type=\"text/javascript\">

        jQuery(document).ready(function(\$) {

            var tipoDiag1 = \$('select[id^=\"form_i375_s\"]');
            var tipoDiag2 = \$('select[id^=\"form_i379_s\"]');
            var tipoDiag3 = \$('select[id^=\"form_i383_s\"]');

            var diag1 = \$('input[id^=\"form_i376_s\"]');
            var diag2 = \$('input[id^=\"form_i380_s\"]');
            var diag3 = \$('input[id^=\"form_i384_s\"]');

            var espec1 = \$('textarea[id^=\"form_i377_s\"]');

            tipoDiag1.select2(\"val\", 1);
            tipoDiag2.select2(\"val\", 2);
            tipoDiag3.select2(\"val\", 3);

            tipoDiag1.select2(\"readonly\", true);
            tipoDiag2.select2(\"readonly\", true);
            tipoDiag3.select2(\"readonly\", true);

            var labelDiag1  = \$('label[for^=\"form_i376_s\"]');
            var labelDiag1e = \$('label[for^=\"form_i377_s\"]');
            labelDiag1.append('*');
            //labelDiag1e.append('*');

            initDiagnosticoSearch(diag1,'Seleccione el Diagnostico Principal...');
            initDiagnosticoSearch(diag2,'Seleccione el Diagnostico Secundario...');
            initDiagnosticoSearch(diag3,'Seleccione la Causa Externa...');

            \$('form').on('submit', function(e){
                if( ! diag1.select2('val') ){
                    showDialogMsg('Establecer Diagnostico Principal','<span class=\"glyphicon glyphicon-remove\"></span> Debe establecer el Diagnostico Principal para continuar.','dialog-error');
                    e.preventDefault();
                    diag1.focus();
                }
                // else if ( espec1.val() == ''){
                //     showDialogMsg('Brinde una Observación','Debe agregar alguna especificación u observación sobre el Diagnostico Principal.','dialog-error');
                //     e.preventDefault();
                //     espec1.focus();
                // }
            });


        });//fin document ready

        function repoFormatSelection(repo) {
            console.log(repo);
            /*if(repo.text.length > 0)
                return repo.data1[0].text;
            else*/
                return repo.data1[0].text;
        }



        //Calcula indice de masa corporal



    </script>
";
    }

    // line 75
    public function block_content($context, array $blocks = array())
    {
    }

    // line 77
    public function block_sonata_breadcrumb($context, array $blocks = array())
    {
    }

    // line 80
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 82
    public function block_form($context, array $blocks = array())
    {
        // line 83
        echo "
    ";
        // line 84
        $this->displayBlock('sonata_tab_content', $context, $blocks);
        // line 104
        echo "
";
    }

    // line 84
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 85
        echo "    <div class=\"row\">
\t   <div class=\"col-md-12\">
            <div class=\"box box-success\">
                <div class=\"box-header\">
                    <h4 class=\"box-title\">
                    </h4>
                </div>
                <div class=\"box-body\">
                      ";
        // line 93
        $this->env->loadTemplate("MinsalSiapsBundle:MntPacienteAdmin:encabezado_paciente.html.twig")->display($context);
        // line 94
        echo "                      ";
        $this->env->loadTemplate("MinsalSeguimientoBundle:SecHistorialClinico:consultar_historial.html.twig")->display($context);
        // line 95
        echo "
                    <div class=\"sonata-ba-collapsed-fields\">
                        ";
        // line 97
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
        return "MinsalSeguimientoBundle:SecHistorialClinico:historiaClinicaGeneral.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  164 => 97,  160 => 95,  157 => 94,  155 => 93,  145 => 85,  142 => 84,  137 => 104,  135 => 84,  132 => 83,  129 => 82,  124 => 80,  119 => 77,  114 => 75,  44 => 8,  36 => 4,  33 => 3,);
    }
}
