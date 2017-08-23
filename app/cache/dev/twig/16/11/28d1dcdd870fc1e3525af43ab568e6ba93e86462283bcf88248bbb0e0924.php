<?php

/* MinsalCitasBundle:Custom:agenda_dia_medico.html.twig */
class __TwigTemplate_161128d1dcdd870fc1e3525af43ab568e6ba93e86462283bcf88248bbb0e0924 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'content' => array($this, 'block_content'),
            'sonata_page_content_nav' => array($this, 'block_sonata_page_content_nav'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["codigoEmpleado"] = (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true)) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo")) : ("N/A"));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 8
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 9
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <!--link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalcitas/css/CitasBundle.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" /-->
";
    }

    // line 13
    public function block_javascripts($context, array $blocks = array())
    {
        // line 14
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    ";
        // line 15
        $this->env->loadTemplate("MinsalCitasBundle:Custom:agenda_dia.html.twig")->display($context);
        // line 16
        echo "    <script type=\"text/javascript\">
        jQuery(document).ready(function(\$) {
            ";
        // line 18
        if ((!((isset($context["codigoEmpleado"]) ? $context["codigoEmpleado"] : $this->getContext($context, "codigoEmpleado")) === "MED"))) {
            // line 19
            echo "                \$idEmpleado = \$('#idEmpleado');
                \$idEmpleadoEspecialidadEstab = \$('#idEmpleadoEspecialidadEstab');
                var superAdmin = '";
            // line 21
            if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method")) {
                echo "true";
            } else {
                echo "false";
            }
            echo "';

                \$idEmpleado.prepend('<option/>').val(function() {
                    return \$('[selected]', this).val();
                });
                \$idEmpleado.select2({
                    placeholder: 'Seleccionar Medico...',
                    allowClear: true,
                    width: '100%'
                });

                \$('#resultado').append(
                    '<div class=\"alert alert-info\" role=\"alert\">'+
                        '<i class=\"fa fa-info-circle\"></i> Por favor <strong>seleccione un médio y una especialidad</strong> para ver el detalle de la agenda del día.'+
                    '</div>'
                );

                \$.ajax({
                    url: Routing.generate(\"citasgetmedico\"),
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        \$.each(data.data1, function(indice, val) {
                            if (superAdmin == 'true') {
                                \$idEmpleado.append( \$('<option>', {value: val.id, text: val.nombre, 'data-residente': val.residente} ) );
                            } else {
                                if(value.idEstablecimiento == ";
            // line 47
            if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado")) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdEstablecimiento"), "getId"), "html", null, true);
            } else {
                echo "''";
            }
            echo ") {
                                    \$idEmpleado.append( \$('<option>', {value: val.id, text: val.nombre, 'data-residente': val.residente} ) );
                                }
                            }
                        });
                    }
                });

                \$idEmpleadoEspecialidadEstab.prepend('<option/>').val(function() {
                    return \$('[selected]', this).val();
                });
                \$idEmpleadoEspecialidadEstab.select2({
                    placeholder: 'Seleccionar Especialidad...',
                    allowClear: true,
                    width: '100%'
                });

                \$idEmpleado.on('change', function(e) {
                    \$idEmpleadoEspecialidadEstab.children().remove();

                    \$idEmpleadoEspecialidadEstab.prepend('<option/>').val(function() {
                        return \$('[selected]', this).val();
                    });
                    \$idEmpleadoEspecialidadEstab.select2({
                        placeholder: 'Seleccionar Especialidad...',
                        allowClear: true,
                        width: '100%'
                    });

                    if (e.val) {
                        empleadoChange(e.val);
                    }
                });

                \$('#idEmpleadoEspecialidadEstab').on('change', function(e) {
                    generarAgendaDia(true);
                });
            ";
        } else {
            // line 85
            echo "                generarAgendaDia(false);
            ";
        }
        // line 87
        echo "
            function empleadoChange(id) {
                \$.ajax({
                    url: Routing.generate('citasgetmedicoespecialidadestab') + '?idEmpleado=' + id,
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        \$.each(data.result, function(indice, val) {
                            if (superAdmin == 'true') {
                                \$idEmpleadoEspecialidadEstab.append(\$('<option>', {value: val.id, text: val.nombre}));
                            } else {
                                if(value.idEstablecimiento == ";
        // line 98
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado")) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdEstablecimiento"), "getId"), "html", null, true);
        } else {
            echo "''";
        }
        echo ") {
                                    \$idEmpleadoEspecialidadEstab.append(\$('<option>', {value: val.id, text: val.nombre}));
                                }
                            }
                        });
                    }
                });

                \$('#resultado').empty();
                \$('#resultado').append(
                    '<div class=\"alert alert-info\" role=\"alert\">'+
                        '<i class=\"fa fa-info-circle\"></i> Por favor <strong>seleccione una especialidad</strong> para ver el detalle de la agenda del día.'+
                    '</div>'
                );
            }

            function generarAgendaDia(choice) {
                medicData              = getMedicData();
                parameters             = [];
                today                  = new Date();
                today.setHours(0, 0, 0, 0);
                parameters['date']     = today;
                parameters['external'] = true;

                \$('#resultado').empty();

                if(medicData.idEmpleadoEspecialidadEstab !== '') {
                    \$.ajax({
                        url: Routing.generate('citashorariomedico') + '?date=' + today + '&idEmpleado=' + medicData.idEmpleado + '&idEmpleadoEspecialidadEstab=' + medicData.idEmpleadoEspecialidadEstab,
                        async: false,
                        dataType: 'json',
                        success: function(data) {
                            if (data.data1.length == 0) {
                                \$('#resultado').append(
                                    '<div class=\"alert alert-info\" role=\"alert\">'+
                                        '<i class=\"fa fa-info-circle\"></i> <h4><strong>Sin distribución para mostrar</strong></h4>'+
                                        'El médico no posee una distribución para este día.'+
                                        (choice === true ? ' Por favor seleccione otra especialidad y/u otro médico.' : '')+
                                    '</div>'
                                );
                            } else {
                                \$.each(data.data1, function(indice, aux) {
                                    parameters['url'] = Routing.generate('citasdetallehora') + '?idEmpleado=' + medicData.idEmpleado + '&idEmpleadoEspecialidadEstab=' + medicData.idEmpleadoEspecialidadEstab + '&date=' + today + '&hora=' + aux.id;
                                    var detalleAgenda = buildDetailAgendaMedica(parameters);

                                    \$('#resultado').append('<h3>' + aux.rango_hora + ( aux.id_tipo_distribucion ? ' - ' + aux.nombre_tipo_distribucion : '') + '</h3>');
                                    if(Object.keys(detalleAgenda).length === 0 || detalleAgenda.content === '') {
                                        detalleAgenda.warningMessage = '';
                                        detalleAgenda.content = '<div class=\"alert alert-block alert-error\">\\
                                                    <h4>Error al construir la agenda m&eacute;dica</h4>\\
                                                    Lo sentimos, hubo un error al construir el detalle de la agenda m&eacute;dica, por favor intentelo nuevamente, si el problema persiste contacte con el administrador del sistema...\\
                                                </div>';
                                    }

                                    \$('#resultado').append(detalleAgenda.content);
                                });
                            }
                        }
                    });
                } else {
                    \$('#resultado').append(
                        '<div class=\"alert '+( choice === true ? 'alert-info' : 'alert-error')+'\" role=\"alert\">'+
                            ( choice === true ?
                                '<i class=\"fa fa-info-circle\"></i> Por favor <strong>seleccione una especialidad</strong> para ver el detalle de la agenda del día.' :
                                '<i class=\"fa fa-exclamation-triangle\"></i> <h4><strong>Especialidad no detectada</strong></h4>.'+
                                'Hubo un problema al obtener la especialidad con la que se ha logueado el médico, por favor recargue la página, si el problema persiste contacte con el Administrador'
                            )+
                        '</div>'
                    );
                }
            }
        });
    </script>
";
    }

    // line 173
    public function block_content($context, array $blocks = array())
    {
        // line 174
        echo "    <h1>Agenda del ";
        echo twig_escape_filter($this->env, twig_localized_date_filter($this->env, "now", "long", "none", "es_SV"), "html", null, true);
        echo "</h1>
    ";
        // line 175
        $this->displayBlock('sonata_page_content_nav', $context, $blocks);
        // line 177
        echo "    <div class=\"col-md-3\">
        <div class=\"col-md-12\" style=\"margin-bottom: 20px;\">
            ";
        // line 179
        if (((!$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true)) || (!($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED")))) {
            // line 180
            echo "                <label class=\"col-md-12 label-filters\">Medico:</label>
                <select id=\"idEmpleado\"></select>
                <label class=\"col-md-12 label-filters\">Sub-especialidad:</label>
                <select id=\"idEmpleadoEspecialidadEstab\"></select>
            ";
        }
        // line 185
        echo "            <img  src=";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/agenda.png"), "html", null, true);
        echo " />
        </div>
    </div>
    <div class=\"col-md-9\">
        <div id=\"resultado\" ></div>
    </div>
";
    }

    // line 175
    public function block_sonata_page_content_nav($context, array $blocks = array())
    {
        // line 176
        echo "    ";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:Custom:agenda_dia_medico.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  288 => 176,  285 => 175,  273 => 185,  266 => 180,  264 => 179,  260 => 177,  258 => 175,  253 => 174,  250 => 173,  168 => 98,  155 => 87,  151 => 85,  106 => 47,  73 => 21,  69 => 19,  67 => 18,  63 => 16,  61 => 15,  56 => 14,  53 => 13,  47 => 10,  42 => 9,  39 => 8,  34 => 5,  29 => 3,);
    }
}
