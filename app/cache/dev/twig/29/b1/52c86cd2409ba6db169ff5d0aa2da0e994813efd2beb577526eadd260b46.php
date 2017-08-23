<?php

/* MinsalSeguimientoBundle:SecHistorialClinico:edit.html.twig */
class __TwigTemplate_29b152c86cd2409ba6db169ff5d0aa2da0e994813efd2beb577526eadd260b46 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'sonata_breadcrumb' => array($this, 'block_sonata_breadcrumb'),
            'javascripts' => array($this, 'block_javascripts'),
            'form' => array($this, 'block_form'),
            'sonata_pre_fieldsets' => array($this, 'block_sonata_pre_fieldsets'),
            'sonata_tab_content' => array($this, 'block_sonata_tab_content'),
            'sonata_post_fieldsets' => array($this, 'block_sonata_post_fieldsets'),
            'formactions' => array($this, 'block_formactions'),
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

    // line 11
    public function block_sonata_breadcrumb($context, array $blocks = array())
    {
    }

    // line 13
    public function block_javascripts($context, array $blocks = array())
    {
        // line 14
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script type=\"text/javascript\">
        var modal_elements = [];

        jQuery(document).ready(function (\$) {

            var embarazada = \$('input[id\$=\"_embarazada\"]');

            \$('div[id\$=\"_idDatoEmbarazo\"]').hide();
            \$('input[id*=\"_idDatoEmbarazo_\"]').prop('disabled', true);

            ";
        // line 26
        if ((!(isset($context["edadFertil"]) ? $context["edadFertil"] : $this->getContext($context, "edadFertil")))) {
            // line 27
            echo "                    \$('#checkbox_embarazada').hide();
            ";
        } else {
            // line 29
            echo "                ";
            if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdCondicionPersona", array(), "method"), "getId", array(), "method") == 1)) {
                // line 30
                echo "                        embarazada.iCheck('check');
                        \$('input[id*=\"_idDatoEmbarazo_\"]').prop('disabled', false);
                        \$('div[id\$=\"_idDatoEmbarazo\"]').show();
                        \$('input[id*=\"_idDatoEmbarazo_gravidez\"]').val(";
                // line 33
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method")) ? ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method"), "getIdAntecedentesObstetricos", array(), "method")) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method"), "getIdAntecedentesObstetricos", array(), "method"), "getGestaciones", array(), "method")) : (0))) : (0)), "html", null, true);
                echo ");
                        \$('input[id*=\"_idDatoEmbarazo_partos\"]').val(";
                // line 34
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method")) ? ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method"), "getIdAntecedentesObstetricos", array(), "method")) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method"), "getIdAntecedentesObstetricos", array(), "method"), "getPartosTermino", array(), "method")) : (0))) : (0)), "html", null, true);
                echo ");
                        \$('input[id*=\"_idDatoEmbarazo_prematuros\"]').val(";
                // line 35
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method")) ? ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method"), "getIdAntecedentesObstetricos", array(), "method")) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method"), "getIdAntecedentesObstetricos", array(), "method"), "getPartoPrematuro", array(), "method")) : (0))) : (0)), "html", null, true);
                echo ");
                        \$('input[id*=\"_idDatoEmbarazo_abortos\"]').val(";
                // line 36
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method")) ? ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method"), "getIdAntecedentesObstetricos", array(), "method")) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method"), "getIdAntecedentesObstetricos", array(), "method"), "getAbortos", array(), "method")) : (0))) : (0)), "html", null, true);
                echo ");
                        \$('input[id*=\"_idDatoEmbarazo_vivos\"]').val(";
                // line 37
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method")) ? ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method"), "getIdAntecedentesObstetricos", array(), "method")) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method"), "getIdAntecedentesObstetricos", array(), "method"), "getNacidosVivos", array(), "method")) : (0))) : (0)), "html", null, true);
                echo ");
                ";
            } else {
                // line 39
                echo "                        \$('div[id\$=\"_idDatoEmbarazo\"]').hide();
                ";
            }
            // line 41
            echo "            ";
        }
        // line 42
        echo "
                embarazada.on('ifChecked', function (event) {
                    \$('div[id\$=\"_idDatoEmbarazo\"]').show();
                    \$('input[id*=\"_idDatoEmbarazo_\"]').prop('disabled', false);
                });

                embarazada.on('ifUnchecked', function (event) {
                    \$('div[id\$=\"_idDatoEmbarazo\"]').hide();
                    \$('input[id*=\"_idDatoEmbarazo_\"]').val('');
                    \$('input[id*=\"_idDatoEmbarazo_\"]').prop('disabled', true);
                });

                if (embarazada.prop('checked')) {
                    \$('div[id\$=\"_idDatoEmbarazo\"]').show();
                    \$('input[id*=\"_idDatoEmbarazo_\"]').prop('disabled', false);
                }

                \$('input[id*=\"_idDatoEmbarazo_fechaUltimaMestruacion\"]').change(function(){
                    var actual=new Date();
                    fum=\$('input[id*=\"_idDatoEmbarazo_fechaUltimaMestruacion\"]').val().split('/');
                    var fum=new Date(fum[2]+'-'+fum[1]+'-'+fum[0]);
                    diferencia=actual-fum;
                    valor=Math.round((diferencia/(1000*60*60*24))/7);
                    \$('input[id*=\"_idDatoEmbarazo_semanaAmenorrea\"]').val(valor);

                });


            var controlPrenatal = \$('input[id\$=\"_controlPrenatal\"]');
            var idEstablecimientoControl = \$('select[id\$=\"_idEstablecimientoControl\"]');
            var divEstablecimientoControl = idEstablecimientoControl.parent().parent();

            initializeSelect2( idEstablecimientoControl, true, false, { placeholder: \"Ninguno.\", allowClear: true, containerCss: { 'width': '50%'} } );

            if( ! controlPrenatal.prop('checked') ){
                divEstablecimientoControl.hide();
            }

            controlPrenatal.on('ifChecked', function(){
                divEstablecimientoControl.show();
            }).on('ifUnchecked', function(){
                divEstablecimientoControl.hide();
            });

            idEstablecimientoControl.parent().append('<button type=\"button\" id=\"thisEstabButton\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-map-marker\"></i> &nbsp;Establecimiento Local</button>')
            \$('#thisEstabButton').on('click', function(){
                idEstablecimientoControl.select2('val', ";
        // line 88
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "getId", array(), "method"), "html", null, true);
        echo ")
            });


            ";
        // line 92
        if ((twig_length_filter($this->env, (isset($context["solicitudQuirurgica"]) ? $context["solicitudQuirurgica"] : $this->getContext($context, "solicitudQuirurgica"))) > 0)) {
            // line 93
            echo "                var arrayBtns =
                    [{
                        text: 'Verificar', click: function() {
                            jQuery( this ).dialog( \"close\" );
                            jQuery('#reviewSolQ').click();
                        }
                    }];

                if( ! jQuery('select[id\$=\"_idSolicitudQuirurgica\"]').val() ){
                    //showDialogMsg('¡ Atención !', 'Se han encontrado <b>Solicitudes de Intervención Quirurgicas</b> pendientes de evaluaciones para el paciente.', 'dialog-info', '', arrayBtns, false, 500, true, false, false);
                }

                modal_elements.push({
                    id: 'reviewSolQ',
                    func: 'getSolicitudesQuirurgicas',
                    header: 'Solicitudes de Intervención Quirurgicas Pendientes de Evaluaciones',
                    footer: '<button id=\"cancelEvaluacionQ\" value=\"true\" onClick=\"cancelEvaluacionQ()\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-ban\"></i> Cancelar</button>',
                    widthModal: '90%',
                    maxWidth: '900px',
                    parameters: '',
                    closeBtn: false,
                    closeXBtn: false
                });

            ";
        }
        // line 118
        echo "
        });//fin document ready

        function getSolicitudesQuirurgicas(){
            var htmlSQ = '';

            ";
        // line 124
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["solicitudQuirurgica"]) ? $context["solicitudQuirurgica"] : $this->getContext($context, "solicitudQuirurgica")));
        foreach ($context['_seq'] as $context["i"] => $context["solicitudQ"]) {
            // line 125
            echo "                htmlSQ += '<div class=\"panel panel-primary\">\\
                                <div class=\"panel-heading\" >\\
                                    <b>Solicitud #";
            // line 127
            echo twig_escape_filter($this->env, ((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) + 1), "html", null, true);
            echo "</b>\\
                                    \\
                                </div>\\
                                <div class=\"table-responsive\">\\
                                    <table class=\"table table-hover\">\\
                                        <tr><th>Fecha de Solicitud</th><td>";
            // line 132
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getFecha", array(), "method"), "d-m-Y"), "html", null, true);
            echo "</td></tr>\\
                                        <tr><th>Médico Solicitante</th><td>";
            // line 133
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getIdEmpleado", array(), "method"), "html", null, true);
            echo "</td></tr>\\
                                        <tr><th>Diagnostico del Paciente</th><td><ul>";
            // line 134
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getIdHistorialClinico", array(), "method"), "getDiagnostico", array(), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["diagnostico"]) {
                echo "<li>";
                echo twig_escape_filter($this->env, (isset($context["diagnostico"]) ? $context["diagnostico"] : $this->getContext($context, "diagnostico")), "html", null, true);
                echo "</li>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['diagnostico'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</ul></td></tr>\\
                                        <tr><th>Procedimientos Quirurgicos</th><td><ul>";
            // line 135
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getProcedimientoQuirurgico", array(), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["proc"]) {
                echo "<li>";
                echo twig_escape_filter($this->env, (isset($context["proc"]) ? $context["proc"] : $this->getContext($context, "proc")), "html", null, true);
                echo "</li>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['proc'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</ul></td></tr>\\
                                        <tr><th>Prioridad de la Cirugía</th><td>";
            // line 136
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getIdPrioridadCirugia", array(), "method"), "html", null, true);
            echo "</td></tr>\\
                                        <tr><!--<th>Detalles de Solicitud ...</th>-->\\
                                            <td colspan=\"2\">\\
                                                <button class=\"btn btn-info btn-xs\" type=\"button\" collapsed-details=\"true\" data-toggle=\"collapse\" data-target=\"#detailsSolQ";
            // line 139
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getId", array(), "method"), "html", null, true);
            echo "\" aria-expanded=\"false\" aria-controls=\"detailsSolQ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getId", array(), "method"), "html", null, true);
            echo "\" onClick=\"changeDetailsButton(jQuery(this));\">\\
                                                    <i class=\"fa fa-fw fa-angle-double-down\"></i> Ver Detalles de Solicitud\\
                                                </button>\\
                                            </td>\\
                                        </tr>\\
                                    </table>\\
                                </div>\\
                                <div class=\"collapse\" id=\"detailsSolQ";
            // line 146
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getId", array(), "method"), "html", null, true);
            echo "\">\\
                                    <div class=\"table-responsive\">\\
                                        <table class=\"table table-hover\">\\
                                            <tr><th>Riesgo Anestésico</th><td>";
            // line 149
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getIdRiesgoAnestesico", array(), "method"), "html", null, true);
            echo "</td></tr>\\
                                            <tr><th>Anestesia Solicitada</th><td><ul>";
            // line 150
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getTipoAnestesia", array(), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["anestesia"]) {
                echo "<li>";
                echo twig_escape_filter($this->env, (isset($context["anestesia"]) ? $context["anestesia"] : $this->getContext($context, "anestesia")), "html", null, true);
                echo "</li>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['anestesia'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</ul></td></tr>\\
                                            <tr><th>Manejo de la Cirugía</th><td>";
            // line 151
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getIdManejoCirugia", array(), "method"), "html", null, true);
            echo "</td></tr>\\
                                            <tr><th>Grado de Complejidad</th><td>";
            // line 152
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getIdGradoComplejidadQuirurgica", array(), "method"), "html", null, true);
            echo "</td></tr>\\
                                            <tr><th>Tiempo Quirurgico Estimado</th><td>";
            // line 153
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getTiempoQuirurgicoEstimado", array(), "method"), "html", null, true);
            echo " (min)</td></tr>\\
                                            <tr><th>Estado de Solicitud</th><td>";
            // line 154
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getIdEstadoSolicitudQuirurgica", array(), "method"), "html", null, true);
            echo "</td></tr>\\
                                            <tr><th></th><td></td></tr>\\
                                        </table>\\
                                    </div>\\
                                </div>\\
                                <div class=\"panel-footer\" align=\"right\"><button id=\"confirmSolicitudQuirurgica";
            // line 159
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getId", array(), "method"), "html", null, true);
            echo "\" value=\"true\" onClick=\"confirmSolicitudQuirurgica(";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitudQ"]) ? $context["solicitudQ"] : $this->getContext($context, "solicitudQ")), "getId", array(), "method"), "html", null, true);
            echo ")\" class=\"btn btn-success\"><i class=\"fa fa-fw fa-check\"></i> Brindar Evaluación Pre-Operatoria</button></div>\\
                           </div>';
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['i'], $context['solicitudQ'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 162
        echo "
            htmlSQ += '';
            return htmlSQ;
        };

        function confirmSolicitudQuirurgica(idSolQ){

            var arrayBtns =
                [{
                    text: 'Continuar', click: function() {
                        jQuery( this ).dialog( \"close\" );
                        jQuery('#myModal').modal('hide');
                        showAutoDismissMsg('La Evaluación Pre-Operatoria se mostrará al iniciar la consulta.', 'success', 'xlarge', true, '', '', '', 7000);
                        jQuery('select[id\$=\"_idSolicitudQuirurgica\"]').select2('val', idSolQ);
                    }
                },
                {
                    text: 'Cancelar', click: function() {
                        jQuery( this ).dialog( \"close\" );
                    }
                }];

            showDialogMsg('¿Confirmar Evaluación Pre-Operatoria?', 'Si brindará una Evaluación Pre-Operatoria al paciente presione el botón <b>Continuar</b>. Si no será realizada por usted, presione el botón <b>Cancelar</b>.', 'dialog-warning', '', arrayBtns, false, 500, false, false, false);
        };

        function cancelEvaluacionQ(){
            jQuery('#myModal').modal('hide');
        }

        function changeDetailsButton(element){
            if( element.attr('collapsed-details') == 'true'){
                element.empty().prepend('<i class=\"fa fa-fw fa-angle-double-up\"></i> Ocultar Detalles');
                element.attr('collapsed-details', 'false');
            }
            else{
                element.empty().prepend('<i class=\"fa fa-fw fa-angle-double-down\"></i> Ver Detalles de Solicitud');
                element.attr('collapsed-details', 'true');
            }
        }

    </script>
";
    }

    // line 204
    public function block_form($context, array $blocks = array())
    {
        // line 205
        echo "    ";
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.top", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

    ";
        // line 207
        $context["url"] = (((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) ? ("edit") : ("create"));
        // line 208
        echo "
    ";
        // line 209
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url"))), "method"))) {
            // line 210
            echo "        <div>
            ";
            // line 211
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        </div>
    ";
        } else {
            // line 214
            echo "        <form
            ";
            // line 215
            if (($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "form_type"), "method") == "horizontal")) {
                echo "class=\"form-horizontal\"";
            }
            // line 216
            echo "            role=\"form\"
            action=\"";
            // line 217
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), 1 => array("id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
            echo "&id_expediente=";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "id"), "html", null, true);
            echo "&id_empleado=";
            echo twig_escape_filter($this->env, (isset($context["id_empleado"]) ? $context["id_empleado"] : $this->getContext($context, "id_empleado")), "html", null, true);
            echo "&id_aten_area_mod_estab=";
            echo twig_escape_filter($this->env, (isset($context["id_aten_area_mod_estab"]) ? $context["id_aten_area_mod_estab"] : $this->getContext($context, "id_aten_area_mod_estab")), "html", null, true);
            echo "&id_cita=";
            echo twig_escape_filter($this->env, (isset($context["id_cita"]) ? $context["id_cita"] : $this->getContext($context, "id_cita")), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
            echo "
            method=\"POST\"
            ";
            // line 219
            if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
                echo "novalidate=\"novalidate\"";
            }
            // line 220
            echo "            >
            ";
            // line 221
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
                // line 222
                echo "                <div class=\"sonata-ba-form-error\">
                    ";
                // line 223
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "
                </div>
            ";
            }
            // line 226
            echo "
            ";
            // line 227
            $this->displayBlock('sonata_pre_fieldsets', $context, $blocks);
            // line 230
            echo "
                ";
            // line 231
            $this->displayBlock('sonata_tab_content', $context, $blocks);
            // line 274
            echo "
                ";
            // line 275
            $this->displayBlock('sonata_post_fieldsets', $context, $blocks);
            // line 278
            echo "
            ";
            // line 279
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "

            ";
            // line 281
            $this->displayBlock('formactions', $context, $blocks);
            // line 286
            echo "        </form>
    ";
        }
        // line 288
        echo "
    ";
        // line 289
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.edit.form.bottom", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

";
    }

    // line 227
    public function block_sonata_pre_fieldsets($context, array $blocks = array())
    {
        // line 228
        echo "                <div class=\"row\">
                ";
    }

    // line 231
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 232
        echo "                    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "formgroups"));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["name"] => $context["form_group"]) {
            // line 233
            echo "                        <div class=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class"), "col-md-12")) : ("col-md-12")), "html", null, true);
            echo "\">
                            <div class=\"box box-success\">
                                <div class=\"box-header\">
                                    <h4 class=\"box-title\">
                                        ";
            // line 238
            echo "                                    </h4>
                                </div>
                                ";
            // line 241
            echo "                                <div class=\"box-body\">

                                    ";
            // line 243
            $this->env->loadTemplate("MinsalSiapsBundle:MntPacienteAdmin:encabezado_paciente.html.twig")->display($context);
            // line 244
            echo "                                    ";
            $this->env->loadTemplate("MinsalSeguimientoBundle:SecHistorialClinico:consultar_historial.html.twig")->display($context);
            // line 245
            echo "                                    <div class=\"bs-callout bs-callout-primary\" style=\"max-width: 450px; max-height: 100px; float: right; padding-top: 2px; padding-bottom: 0px;\">
                                        <h4 style=\"color: #6B6B6B;\">Opciones de Consulta <small>(Dependen de diversos criterios)</small></h4>
                                        <div ";
            // line 247
            if (((isset($context["displayResultsHistory"]) ? $context["displayResultsHistory"] : $this->getContext($context, "displayResultsHistory")) == false)) {
                echo "style=\"display: none;\"";
            }
            echo "><h4>";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "entregaResultados"), 'label');
            echo "&nbsp;&nbsp;";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "entregaResultados"), 'widget');
            echo "</h4></div>
                                        <h4 id=\"checkbox_embarazada\">";
            // line 248
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "embarazada"), 'label');
            echo "&nbsp;&nbsp;";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "embarazada"), 'widget');
            echo "</h4>
                                    </div>
                                    <a href=\"#myModal\" id=\"reviewSolQ\" custom-modal=\"true\" data-toggle=\"modal\" data-backdrop=\"static\" data-keyboard=\"false\" style=\"display: none;\"></a>
                                    ";
            // line 251
            if ((!(null === (isset($context["idTipoLugar"]) ? $context["idTipoLugar"] : $this->getContext($context, "idTipoLugar"))))) {
                // line 252
                echo "                                        <input id=\"idTipoLugar\" name=\"idTipoLugar\" value=\"";
                echo twig_escape_filter($this->env, (isset($context["idTipoLugar"]) ? $context["idTipoLugar"] : $this->getContext($context, "idTipoLugar")), "html", null, true);
                echo "\" style=\"display: none;\" />
                                        <input id=\"nombreLugar\" name=\"nombreLugar\" value=\"";
                // line 253
                echo twig_escape_filter($this->env, (isset($context["nombreLugar"]) ? $context["nombreLugar"] : $this->getContext($context, "nombreLugar")), "html", null, true);
                echo "\" style=\"display: none;\" />
                                    ";
            }
            // line 255
            echo "                                    <div class=\"sonata-ba-collapsed-fields\">
                                        ";
            // line 256
            if (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description") != false)) {
                // line 257
                echo "                                            <p>";
                echo $this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "description");
                echo "</p>
                                        ";
            }
            // line 259
            echo "
                                        ";
            // line 260
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : $this->getContext($context, "form_group")), "fields"));
            foreach ($context['_seq'] as $context["_key"] => $context["field_name"]) {
                // line 261
                echo "                                            ";
                if ($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "formfielddescriptions", array(), "any", false, true), (isset($context["field_name"]) ? $context["field_name"] : $this->getContext($context, "field_name")), array(), "array", true, true)) {
                    // line 262
                    echo "                                                ";
                    if ($this->getAttribute((isset($context["form"]) ? $context["form"] : null), (isset($context["field_name"]) ? $context["field_name"] : $this->getContext($context, "field_name")), array(), "array", true, true)) {
                        // line 263
                        echo "                                                    ";
                        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), (isset($context["field_name"]) ? $context["field_name"] : $this->getContext($context, "field_name")), array(), "array"), 'row');
                        echo "
                                                ";
                    }
                    // line 265
                    echo "                                            ";
                }
                // line 266
                echo "                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field_name'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 267
            echo "                                    </div>
                                </div>
                                ";
            // line 270
            echo "                            </div>
                        </div>
                    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['form_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 273
        echo "                ";
    }

    // line 275
    public function block_sonata_post_fieldsets($context, array $blocks = array())
    {
        // line 276
        echo "                </div>
            ";
    }

    // line 281
    public function block_formactions($context, array $blocks = array())
    {
        // line 282
        echo "                <div class=\"well well-small form-actions\">
                    <input type=\"submit\" class=\"btn btn-primary\" name=\"btn_create\" value=\"Continuar\"/>
                </div>
            ";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecHistorialClinico:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  624 => 282,  621 => 281,  616 => 276,  613 => 275,  609 => 273,  593 => 270,  589 => 267,  583 => 266,  580 => 265,  574 => 263,  571 => 262,  568 => 261,  564 => 260,  561 => 259,  555 => 257,  553 => 256,  550 => 255,  545 => 253,  540 => 252,  538 => 251,  530 => 248,  520 => 247,  516 => 245,  513 => 244,  511 => 243,  507 => 241,  503 => 238,  495 => 233,  477 => 232,  474 => 231,  469 => 228,  466 => 227,  459 => 289,  456 => 288,  452 => 286,  450 => 281,  445 => 279,  442 => 278,  440 => 275,  437 => 274,  435 => 231,  432 => 230,  430 => 227,  427 => 226,  421 => 223,  418 => 222,  416 => 221,  413 => 220,  409 => 219,  394 => 217,  391 => 216,  387 => 215,  384 => 214,  378 => 211,  375 => 210,  373 => 209,  370 => 208,  368 => 207,  362 => 205,  359 => 204,  314 => 162,  303 => 159,  295 => 154,  291 => 153,  287 => 152,  283 => 151,  270 => 150,  266 => 149,  260 => 146,  248 => 139,  242 => 136,  229 => 135,  216 => 134,  212 => 133,  208 => 132,  200 => 127,  196 => 125,  192 => 124,  184 => 118,  157 => 93,  155 => 92,  148 => 88,  100 => 42,  97 => 41,  93 => 39,  88 => 37,  84 => 36,  80 => 35,  76 => 34,  72 => 33,  67 => 30,  64 => 29,  60 => 27,  58 => 26,  42 => 14,  39 => 13,  34 => 11,);
    }
}
