<?php

/* MinsalSiapsBundle::ServicioMedicoEstablecimiento.html.twig */
class __TwigTemplate_f01f1e2628a8d985856ad7d1cae2801004778fb4e61ec14cc589347266999fd6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_side_nav' => array($this, 'block_sonata_side_nav'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "\t";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
";
    }

    // line 7
    public function block_javascripts($context, array $blocks = array())
    {
        // line 8
        echo "\t";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

\t<script type=\"text/javascript\">
\t\tjQuery(document).ready(function(\$) {
\t\t\t\$field = \$('#_id-especialidad');
\t\t\t\$field.prepend('<option/>').val(function(){return \$('[selected]',this).val() ;})

\t\t\t\$field.select2({
\t\t\t\tplaceholder: 'Seleccionar Especialidad...',
\t\t\t\tallowClear: true
\t\t\t});

\t\t\t";
        // line 20
        if ((twig_length_filter($this->env, (isset($context["empEspecialidades"]) ? $context["empEspecialidades"] : $this->getContext($context, "empEspecialidades"))) > 0)) {
            // line 21
            echo "\t\t\t\t";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["empEspecialidades"]) ? $context["empEspecialidades"] : $this->getContext($context, "empEspecialidades")));
            foreach ($context['_seq'] as $context["_key"] => $context["especialidad"]) {
                // line 22
                echo "\t\t\t\t\t\$field.append(\$('<option>', {value: ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["especialidad"]) ? $context["especialidad"] : $this->getContext($context, "especialidad")), "getId", array(), "method"), "html", null, true);
                echo ", text: '";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["especialidad"]) ? $context["especialidad"] : $this->getContext($context, "especialidad")), "getNombreConsulta", array(), "method"), "html", null, true);
                echo "' }));
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['especialidad'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "\t\t\t";
        } else {
            // line 25
            echo "\t\t\t\t\$field.select2('enable', false);
\t\t\t";
        }
        // line 27
        echo "
\t\t\t\$field.on('change', function(e){
\t\t\t\tif(e.val) {

\t\t\t\t\t\$('#_nombre-especialidad').val(\$('#_id-especialidad option:selected').text());
\t\t\t\t}
\t\t\t});

            \$(document).on('submit','form',function(e){

               if(\$('#_id-especialidad option:selected').val() == \"\") {
               \t\tif(\$('div#dialog-message').length == 0) {
                        \$('body').append('<div id=\"dialog-message\"></div>');
                    } else {
                        \$('#dialog-message').empty();
                    }

                    \$(\"#dialog-message\").append('<p><i class=\"icon-warning-sign\" style=\"margin-right:7px;\"></i>\\
                                         La especialidad no ha sido seleccionada, por favor seleccione una especialidad \\
                                         antes de continuar.</p>');

                    \$(\"#dialog-message\").dialog({
                        dialogClass: \"dialog-error\",
                        modal: true,
                        title: 'Especialidad no seleccionada!!!',
                        buttons: {
                            Cerrar: function() {
                                    \$( this ).dialog( \"close\" );
                            }
                        }
                    });

                \te.preventDefault();
               }
            });
\t\t});
\t</script>
";
    }

    // line 66
    public function block_sonata_side_nav($context, array $blocks = array())
    {
    }

    // line 68
    public function block_content($context, array $blocks = array())
    {
        // line 69
        echo "\t<form action=\"";
        echo $this->env->getExtension('routing')->getUrl("set_emp_especialidad_estab");
        echo "\" method=\"POST\">
\t\t";
        // line 70
        if ((twig_length_filter($this->env, (isset($context["empEspecialidades"]) ? $context["empEspecialidades"] : $this->getContext($context, "empEspecialidades"))) === 0)) {
            // line 71
            echo "\t\t\t<div class=\"alert alert-warning\" role=\"alert\">
\t\t\t\t<h4><i class=\"fa fa-warning\"></i> Especialidad no encontrada</h4>
\t\t\t\tEl médico ";
            // line 73
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "getNombreempleado", array(), "method"), "html", null, true);
            echo " <strong>No posee ninguna especialidad</strong> por favor contacte al encargado de la consulta externa para que se le cofigure sus especialidades.
\t\t\t</div>
\t\t";
        }
        // line 76
        echo "\t\t<center>
\t\t\t<label>Seleccion una especialidad: *</label><br />
\t\t\t<select id=\"_id-especialidad\" name=\"_id-especialidad\" style=\"width:300px;\"></select>
\t\t\t<input type=\"hidden\" id=\"_nombre-especialidad\" name=\"_nombre-especialidad\" value=\"\" />
\t\t\t<br /><br />
\t\t\t";
        // line 81
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session", array(), "any", false, true), "get", array(0 => "_secured_token"), "method", true, true) && (!(null === $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_secured_token"), "method"))))) {
            // line 82
            echo "\t\t\t\t<input type=\"hidden\" name=\"_provided_token\" id=\"_provided_token\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_secured_token"), "method"), "html", null, true);
            echo "\" />
\t\t\t\t<input type=\"hidden\" name=\"previous_url\" id=\"previous_url\" value=\"";
            // line 83
            echo twig_escape_filter($this->env, (isset($context["previous_url"]) ? $context["previous_url"] : $this->getContext($context, "previous_url")), "html", null, true);
            echo "\" />
\t\t\t";
        }
        // line 85
        echo "\t\t\t<button type=\"submit\" id=\"_enviar-especialida\" name=\"_enviar-especialida\" class=\"btn btn-primary\" formaction=\"";
        echo $this->env->getExtension('routing')->getUrl("set_emp_especialidad_estab");
        echo "\" ";
        if ((twig_length_filter($this->env, (isset($context["empEspecialidades"]) ? $context["empEspecialidades"] : $this->getContext($context, "empEspecialidades"))) === 0)) {
            echo "disabled=\"disabled\"";
        }
        echo "><span class=\"label\">Ingresar</span></button>
\t\t</center>
\t</form>
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle::ServicioMedicoEstablecimiento.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 85,  165 => 83,  160 => 82,  158 => 81,  151 => 76,  145 => 73,  141 => 71,  139 => 70,  134 => 69,  131 => 68,  126 => 66,  85 => 27,  81 => 25,  78 => 24,  67 => 22,  62 => 21,  60 => 20,  44 => 8,  41 => 7,  34 => 4,  31 => 3,);
    }
}
