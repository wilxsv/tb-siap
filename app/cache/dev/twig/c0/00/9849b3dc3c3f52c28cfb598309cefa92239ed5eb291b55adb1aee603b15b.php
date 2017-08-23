<?php

/* MinsalFarmaciaBundle:FarmRecetas:assign_receta.html.twig */
class __TwigTemplate_c0009849b3dc3c3f52c28cfb598309cefa92239ed5eb291b55adb1aee603b15b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");

        $this->blocks = array(
            'sonata_header' => array($this, 'block_sonata_header'),
            'actions' => array($this, 'block_actions'),
            'tab_menu' => array($this, 'block_tab_menu'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'content' => array($this, 'block_content'),
            'form' => array($this, 'block_form'),
            'formactionsenca' => array($this, 'block_formactionsenca'),
            'sonata_pre_fieldsets' => array($this, 'block_sonata_pre_fieldsets'),
            'sonata_tab_content' => array($this, 'block_sonata_tab_content'),
            'sonata_post_fieldsets' => array($this, 'block_sonata_post_fieldsets'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["estadoPaciente"] = (((twig_length_filter($this->env, (isset($context["recetasRegistradas"]) ? $context["recetasRegistradas"] : $this->getContext($context, "recetasRegistradas"))) > 0)) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["recetasRegistradas"]) ? $context["recetasRegistradas"] : $this->getContext($context, "recetasRegistradas")), 0, array(), "array"), "med"), "getIdReceta", array(), "method"), "getPacientestable", array(), "method")) : (0));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == false)) {
            // line 6
            echo "        ";
            $this->displayParentBlock("sonata_header", $context, $blocks);
            echo "
    ";
        }
    }

    // line 10
    public function block_actions($context, array $blocks = array())
    {
        // line 11
        echo "    ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == false)) {
            // line 12
            echo "        <li>";
            $this->env->loadTemplate("SonataAdminBundle:Button:create_button.html.twig")->display($context);
            echo "</li>
        <li>";
            // line 13
            $this->env->loadTemplate("SonataAdminBundle:Button:list_button.html.twig")->display($context);
            echo "</li>
        ";
        }
        // line 15
        echo "    ";
    }

    // line 17
    public function block_tab_menu($context, array $blocks = array())
    {
        // line 18
        echo "    ";
    }

    // line 24
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 25
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalfarmacia/css/farmacia.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 29
    public function block_javascripts($context, array $blocks = array())
    {
        // line 30
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script type=\"text/javascript\">
    var estadoPaciente = '";
        // line 32
        echo twig_escape_filter($this->env, (isset($context["estadoPaciente"]) ? $context["estadoPaciente"] : $this->getContext($context, "estadoPaciente")), "html", null, true);
        echo "';//Variable que almacena el estado del pacienteEstable
    var cuantificable = 0 ;
    jQuery(document).ready(function (\$) {
        pacienteEstable(estadoPaciente);

        \$('input[type=\"checkbox\"]').iCheck({//Inicializando CheckBox
            checkboxClass: 'icheckbox_flat-blue'
        });

        \$(\"#envioEspecializada\").val('N');
        var idEspecializada,despachoRecetaDelDia;
        var areaAtencion = ";
        // line 43
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["idHistorialClinico"]) ? $context["idHistorialClinico"] : $this->getContext($context, "idHistorialClinico")), "getIdAtenAreaModEstab", array(), "method"), "getHabilitadoFarmaciaEspecializada", array(), "method"), "html", null, true);
        echo ";//El area de atencion donde el paciente pasa consulta esta habilitado para enviar medicamento a especializada

        ";
        // line 45
        if ((!(null === $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["idHistorialClinico"]) ? $context["idHistorialClinico"] : $this->getContext($context, "idHistorialClinico")), "getIdExpediente", array(), "method"), "getIdPaciente", array(), "method"), "getIdMunicipioDomicilio", array(), "method")))) {
            // line 46
            echo "            ";
            $context["habitanteResidente"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["idHistorialClinico"]) ? $context["idHistorialClinico"] : $this->getContext($context, "idHistorialClinico")), "getIdExpediente", array(), "method"), "getIdPaciente", array(), "method"), "getIdMunicipioDomicilio", array(), "method"), "getIdDepartamento", array(), "method"), "getIdPais", array(), "method"), "getId", array(), "method");
            // line 47
            echo "        ";
        } else {
            // line 48
            echo "            ";
            $context["habitanteResidente"] = "null";
            // line 49
            echo "        ";
        }
        // line 50
        echo "

        var edadanios= ";
        // line 52
        echo twig_escape_filter($this->env, (isset($context["edadanios"]) ? $context["edadanios"] : $this->getContext($context, "edadanios")), "html", null, true);
        echo ";
        edadanios = parseInt(edadanios);//Solo mayores de 18 anios se envian a especializada
        var documentoValido = ";
        // line 54
        echo twig_escape_filter($this->env, (isset($context["documentoValido"]) ? $context["documentoValido"] : $this->getContext($context, "documentoValido")), "html", null, true);
        echo ";//Valor 1: Documento valido, 0: documento no valido, solo con valor 1 se envia a especializada
        var habitanteResidente = ";
        // line 55
        echo twig_escape_filter($this->env, (isset($context["habitanteResidente"]) ? $context["habitanteResidente"] : $this->getContext($context, "habitanteResidente")), "html", null, true);
        echo ";//Evalua si el paciente reside en El Salvador

        \$(\"#idEstablecimientoConsulta\").val(";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["idHistorialClinico"]) ? $context["idHistorialClinico"] : $this->getContext($context, "idHistorialClinico")), "getIdestablecimiento", array(), "method"), "getId", array(), "method"), "html", null, true);
        echo ");//asigno el id del establecimiento donde pasa consulta
        despachoRecetaDelDia = ";
        // line 58
        if ((twig_length_filter($this->env, (isset($context["habilitadoFarmaciaEspecializada"]) ? $context["habilitadoFarmaciaEspecializada"] : $this->getContext($context, "habilitadoFarmaciaEspecializada"))) > 0)) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["habilitadoFarmaciaEspecializada"]) ? $context["habilitadoFarmaciaEspecializada"] : $this->getContext($context, "habilitadoFarmaciaEspecializada")), 0, array(), "array"), "getRecetaDelDia"), "html", null, true);
        } else {
            echo "0";
        }
        echo ";
        \$(\"#despachoRecetaDelDia\").val(despachoRecetaDelDia);//Asigno valor para saber si receta del dia se dispensara en el establecimiento=0 o especializada=1
        idEspecializada = ";
        // line 60
        if ((twig_length_filter($this->env, (isset($context["habilitadoFarmaciaEspecializada"]) ? $context["habilitadoFarmaciaEspecializada"] : $this->getContext($context, "habilitadoFarmaciaEspecializada"))) > 0)) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["habilitadoFarmaciaEspecializada"]) ? $context["habilitadoFarmaciaEspecializada"] : $this->getContext($context, "habilitadoFarmaciaEspecializada")), 0, array(), "array"), "getIdEspecializada", array(), "method"), "getId", array(), "method"), "html", null, true);
        } else {
            echo "null";
        }
        echo ";
        recetadelDia = ";
        // line 61
        if ((twig_length_filter($this->env, (isset($context["habilitadoFarmaciaEspecializada"]) ? $context["habilitadoFarmaciaEspecializada"] : $this->getContext($context, "habilitadoFarmaciaEspecializada"))) > 0)) {
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["habilitadoFarmaciaEspecializada"]) ? $context["habilitadoFarmaciaEspecializada"] : $this->getContext($context, "habilitadoFarmaciaEspecializada")), 0, array(), "array"), "getRecetaDelDia", array(), "method"), "html", null, true);
        } else {
            echo "null";
        }
        echo ";

        //Se evaluan estos tres parametros que son de insumo para evaluar posteriormente con otros si el medicamento se envia a especializada
        if(areaAtencion==1 && (habitanteResidente==68) && idEspecializada!=null && edadanios >=18 && documentoValido == 1){
            \$(\"#envioEspecializada\").val('S');//Se asigna a lemento en formulario que si aplica el envio para especializada(se evaluan otros aspectos no solo este)
            \$(\"#idEspecializada\").val(idEspecializada);//Se asigna en formulario el id de la especializada donde se enviaran los medicamentos
            \$(\"#dividpacienteestable\").show();
        }

        var idsmedicamento = [];//Se utiliza cuando se borrar o agregan medicamentos
        var idmedicinarecetadaimpresion = [];//Se utiliza para selecionar los medicamentos a los cuales se les imprimira receta
        \$('button[id^=\"btn_cw\"]').on('click', function() {
            window.close();
        });

        window.checkMedicamentosAreaEstablecimiento = function(arrayBtns, onLoad) {
            var title = 'Medicamentos no levantados para el Area';
            var dialogClass = 'dialog-error';
            var createDefaultBtnClose = false;
            var width = 500;
            var msg =
                    '<b>Medicamentos.</b>'+
                    '<p>Descripción del error:<br />'+
                    'No se han ingresado medicamentos al sistema</p>'
                ;

                showDialogMsg(title, msg, dialogClass, '', arrayBtns, createDefaultBtnClose,width);
            }

            ";
        // line 90
        if (((isset($context["medicamentolevantados"]) ? $context["medicamentolevantados"] : $this->getContext($context, "medicamentolevantados")) <= 0)) {
            echo "//Se verifica que existan medicamentos para el area
                var arrayBtns = [
                                    {
                                        text: 'Aceptar', click: function() {
                                            window.close()
                                        }
                                    }
                                ];

                checkMedicamentosAreaEstablecimiento(arrayBtns, true);
            ";
        }
        // line 101
        echo "

        var idMedicamento = \$('#idMedicamento');
        \$(\"#cantidadMedicamento\").numeric();
        \$(\"#frecuencia\").numeric();
        \$(\"#durante\").numeric();
        \$(\"#totalMedicamento\").numeric();
        \$(\"#cantidadrepetitiva\").numeric();
        \$(\"#cantidadDistribucion\").numeric();
        initMedicamentoSearch(idMedicamento, 'Seleccione el Medicamento...');

        \$(\"#tiempoFrecuencia\").select2({
            placeholder: \"Periodo\",
            allowClear: true
        });

        \$(\"#iddosificacion\").select2({
            placeholder: \"Dosificación\",
            allowClear: true
        });



        \$(\"form\").submit(function (event) {
            var num_items = getChildrenNumber('#bodycontent-receta');
            if (num_items > 0 && \$('#emptyTr').length === 1) {
                showDialogMsg('Error', 'Por favor agregar medicamento(s)', 'dialog-error');
                return false;
            }
        });

        function pacienteEstable(estadoPaciente){
            var html = '';
            var inicializarCheckBox = false;

            switch (estadoPaciente) {
                case 'S':
                    html = '<label style=\"font-size:20px;margin-left: 100px;\"><u>Paciente Estable</u></label>';
                    break;
                case 'N':
                    html = '<label style=\"font-size:20px;margin-left: 100px;\"><u>Paciente No Estable</u></label>';
                    break;
                default:
                    html =
                        '<div class=\"col-md-2\">'+
                            '<b>Estable </b><input type=\"radio\" name=\"pacienteEstable\" value=\"S\">'+
                        '</div>'+
                        '<div class=\"col-md-2\">'+
                            '<b>No Estable</b> <input type=\"radio\" name=\"pacienteEstable\" value=\"N\">'+
                        '</div>'+
                        '<div class=\"col-md-8\">'+
                        '</div>';
                    inicializarCheckBox = true;
            }

            \$('#divpacienteestable').empty();
            \$('#divpacienteestable').append(html);

            if(inicializarCheckBox) {
                \$('input[type=\"radio\"]').iCheck({//Inicializando CheckBox
                     radioClass: 'iradio_square-blue',
                });
            }

        }


        /*AGREGANDO LOS VALORES DE EDITAR PARA QUE LOS CARGUE*/
        ";
        // line 169
        if (((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit")) {
            // line 170
            echo "            \$('#bodycontent-receta').empty();
            var tbody = '';


            ";
            // line 174
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["recetasRegistradas"]) ? $context["recetasRegistradas"] : $this->getContext($context, "recetasRegistradas")));
            foreach ($context['_seq'] as $context["_key"] => $context["medicamentos"]) {
                // line 175
                echo "                ";
                $context["estadoreceta"] = trim($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getIdreceta", array(), "method"), "getIdestado", array(), "method"));
                // line 176
                echo "                var tipo = \"hidden\";
                ";
                // line 177
                $context["banderareceta"] = "0";
                // line 178
                echo "                    ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["recetasmodificar"]) ? $context["recetasmodificar"] : $this->getContext($context, "recetasmodificar")));
                foreach ($context['_seq'] as $context["_key"] => $context["recetamodificar"]) {
                    // line 179
                    echo "                        ";
                    if (($this->getAttribute((isset($context["recetamodificar"]) ? $context["recetamodificar"] : $this->getContext($context, "recetamodificar")), "id") == $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"))) {
                        // line 180
                        echo "                            ";
                        $context["banderareceta"] = "1";
                        // line 181
                        echo "                        ";
                    }
                    // line 182
                    echo "                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['recetamodificar'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 183
                echo "
                    ";
                // line 184
                if ((((isset($context["banderareceta"]) ? $context["banderareceta"] : $this->getContext($context, "banderareceta")) == "1") && ((isset($context["estadoreceta"]) ? $context["estadoreceta"] : $this->getContext($context, "estadoreceta")) != "R"))) {
                    // line 185
                    echo "                        tipo =\"text\";
                    ";
                }
                // line 187
                echo "
                    tbody = tbody + '<tr id=\"tr_";
                // line 188
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "\"\">\\
                        <td style=\"width:40%;\">\\
                        ";
                // line 190
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getNombreMedicamentoReceta", array(), "method"), "html", null, true);
                echo "\\
                        <input type=\"hidden\" id=\"idMedicamento_";
                // line 191
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "\" name=\"idMedicamento[";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "]\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getIdMedicina", array(), "method"), "getId", array(), "method"), "html", null, true);
                echo "\" />\\
                        </td>\\
                        <td>";
                // line 193
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getCantidadMedicamento", array(), "method"), 2), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getIdDosificacion", array(), "method"), "html", null, true);
                echo "<input type=\"hidden\" name=\"cantidadMedicamento[";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "]\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getCantidadMedicamento", array(), "method"), "html", null, true);
                echo "\">\\
                        ";
                // line 194
                if ($this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getDistribucionEspecial", array(), "method")) {
                    echo "\\
                            <br/>Distribuido de la siguiente manera:<table class=\"table\"><tbody><tr><th>Cantidad</th><th>Descripción</th></tr>\\
                            ";
                    // line 196
                    $context["distribuciones"] = $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getDistribuciones", array(), "method");
                    echo "\\
                            ";
                    // line 197
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["distribuciones"]) ? $context["distribuciones"] : $this->getContext($context, "distribuciones")));
                    foreach ($context['_seq'] as $context["_key"] => $context["detalle"]) {
                        echo "\\
                                <tr><td> ";
                        // line 198
                        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "getCantidadDistribucion", array(), "method"), 2), "html", null, true);
                        echo " </td><td> ";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "getIndicacion", array(), "method"), "html", null, true);
                        echo "</td></tr>\\
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detalle'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 199
                    echo "\\
                            </tbody></table>\\
                        ";
                }
                // line 201
                echo "\\
                        ";
                // line 202
                if (($this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getFrecuencia", array(), "method") == 0)) {
                    echo "\\
                            ";
                    // line 203
                    $context["Frecuencia"] = "--";
                    echo "\\
                            ";
                } else {
                    // line 204
                    echo "\\
                                ";
                    // line 205
                    $context["Frecuencia"] = $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getFrecuencia", array(), "method");
                    echo "\\
                        ";
                }
                // line 206
                echo "\\
                        </td>\\
                        <td>";
                // line 208
                echo twig_escape_filter($this->env, (isset($context["Frecuencia"]) ? $context["Frecuencia"] : $this->getContext($context, "Frecuencia")), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getTiempoFrecuencia", array(), "method"), "html", null, true);
                echo "\\
                        <input type=\"hidden\" name=\"frecuencia[";
                // line 209
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "]\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getFrecuencia", array(), "method"), "html", null, true);
                echo "\">\\
                        <input type=\"hidden\" name=\"tiempoFrecuencia[";
                // line 210
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "]\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getTiempoFrecuencia", array(), "method"), "html", null, true);
                echo "\">\\
                        </td>\\
                        <td>";
                // line 212
                if (((isset($context["banderareceta"]) ? $context["banderareceta"] : $this->getContext($context, "banderareceta")) == "0")) {
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getDurante", array(), "method"), "html", null, true);
                    echo " ";
                }
                echo "  \\
                        <input type=\"'+tipo+'\" size = \"4\" name=\"durante[";
                // line 213
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "]\" id=\"durante_";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getDurante", array(), "method"), "html", null, true);
                echo "\" >\\
                        <input type=\"hidden\" name=\"tiempoDurante[";
                // line 214
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "]\" value=\"Dia(s)\">Dias\\
                        </td>\\
                        <td>";
                // line 216
                if (((isset($context["banderareceta"]) ? $context["banderareceta"] : $this->getContext($context, "banderareceta")) == "0")) {
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getTotalMedicamento", array(), "method"), "html", null, true);
                }
                echo "<input type=\"'+tipo+'\" id = \"totalMedicamento_";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "\" size = \"4\" name=\"totalMedicamento[";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "]\" value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getTotalMedicamento", array(), "method"), "html", null, true);
                echo "\"></td>\\
                        <td>";
                // line 217
                echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getRecomendacion", array(), "method"), "js"), "html", null, true);
                echo "<input type=\"hidden\" name=\"recomendacion[";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "]\" value=\"";
                echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getRecomendacion", array(), "method"), "js"), "html", null, true);
                echo "\"></td>\\
                        <td>";
                // line 218
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "idreceta"), "fecha"), "d-m-Y"), "html", null, true);
                echo "</td>\\
                        <td>";
                // line 219
                if (((isset($context["banderareceta"]) ? $context["banderareceta"] : $this->getContext($context, "banderareceta")) == "1")) {
                    echo "<span class=\"glyphicon glyphicon-floppy-disk mouse-pointer\"  title=\"Actualizar Informacion\" id=\"actualizarMedicamento_";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                    echo "\" style=\"font-size:20px;display:none;\" role=\"save\"></span>";
                }
                echo "</td>\\
                        <td style=\"width:25px;\"><span class=\"glyphicon glyphicon-trash mouse-pointer\" id=\"borrarMedicamento_";
                // line 220
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "\" style=\"font-size:20px;\" role=\"trash\"></span></td>\\
                        <td><span style=\"float: right\"><input type=\"checkbox\" id=\"seleccionarMediciaImpresion_";
                // line 221
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getId", array(), "method"), "html", null, true);
                echo "\" ></span></td>\\
                        </tr>';
                    \$('#bodycontent-receta').append(tbody);
                    idsmedicamento.push(";
                // line 224
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["medicamentos"]) ? $context["medicamentos"] : $this->getContext($context, "medicamentos")), "med"), "getIdMedicina", array(), "method"), "getId", array(), "method"), "html", null, true);
                echo ");

                    tbody = '';
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['medicamentos'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 228
            echo "


            var num_items = getChildrenNumber('#bodycontent-receta');
            if (num_items == 0) {
                tbody = '<tr id=\"emptyTr\"><td colspan=\"7\">No se han agregado medicamentos...</td></tr>';
                \$('#bodycontent-receta').append(tbody);
            }
        ";
        }
        // line 237
        echo "
        \$(\"body\").on('click', \"input[id^='seleccionarMediciaImpresion_']\", function () {//Se van agregando o removiendo los id de las recetas que se desean imprimir
            var item = \$(this);
            var valores = item.attr('id').split('_');
            var id = valores[1];
            var winParams = [];
            if(item.is(':checked')) {
                idmedicinarecetadaimpresion.push(id);
            } else {
                var index = idmedicinarecetadaimpresion.indexOf(id); //idsmedicamento es una variable global de tipo array que tiene los id de los medicamentos que se agregan a la receta
                idmedicinarecetadaimpresion.splice(index, 1);
            }
        });

        \$(\"body\").on('ifChecked','#idTodasLasRecetas',function () {//Si se han selecionado que se impriman todas las recetas se seleciona una por una
            \$(\"input[id^='seleccionarMediciaImpresion_']\").each(//Se recorre cada fila de receta para selecionar
                function (){
                    \$(\"input[id^='seleccionarMediciaImpresion_']\").prop(\"checked\", true);
                    var item = \$(this);
                    var valores = item.attr('id').split('_');
                    var id = valores[1];
                    idmedicinarecetadaimpresion.push(id);// se agrega al array
            });
        });

        \$(\"body\").on('ifUnchecked','#idTodasLasRecetas',function () {//Si se han deseleccionado que se impriman todas las recetas se deseleciona una por una
            \$(\"input[id^='seleccionarMediciaImpresion_']\").each(
                function (){
                    \$(\"input[id^='seleccionarMediciaImpresion_']\").prop(\"checked\", false);
                    idmedicinarecetadaimpresion= [];//se borra todo el array
            });
        });

        \$(\".class-valida\").on('change', function(){
            if(\$(\"#durante\").val()>30){
                \$(\"#durante\").val(30);
            }
            if(\$(\"#durante\").val()<= 0){
                \$(\"#durante\").val('');
            }
            if(\$(\"#frecuencia\").val()<= 0){
                \$(\"#frecuencia\").val('');
            }
            if(\$(\"#cantidadMedicamento\").val()<= 0){
                \$(\"#cantidadMedicamento\").val('');
            }
            if(\$(\"#totalMedicamento\").val()<= 0){
                \$(\"#totalMedicamento\").val('');
            }
            if(\$(\"#cantidadDistribucion\").val()<= 0){
                \$(\"#cantidadDistribucion\").val('');
            }
        });

        //Inicio calculo de total de medicamento a entregar NOTA:esto no aplica para insulina
        \$(\".class-calculototal\").on('change', function(){
            calculoTotalMedicamentoCuantificable();
        });

        function calculoTotalMedicamentoCuantificable() {
            var aplicaCalculo = cuantificable;
            if(aplicaCalculo == 1){
                if((\$(\"#cantidadMedicamento\").val() == '' || \$(\"#frecuencia\").val() == ''|| \$(\"#tiempoFrecuencia\").val() == '' || \$(\"#durante\").val() == '')){
                    \$(\"#totalMedicamento\").val('');
                }
                else{
                    var can = parseFloat(\$(\"#cantidadMedicamento\").val());
                    var fre = parseFloat(\$(\"#frecuencia\").val());
                    var tif = \$(\"#tiempoFrecuencia\").val();
                    var dur = parseInt(\$(\"#durante\").val());
                    var total;

                    switch (tif) {
                        case 'Hora(s)':
                            tif = 24
                            break;
                        case 'Dia(s)':
                            tif = 1;
                            break;
                        default:
                            tif = 0;
                        }
                    if(tif != 0){
                        total = Math.ceil((can*(tif/fre)*dur));
                            \$(\"#totalMedicamento\").val(total);
                        }
                    }
                }
        }


        //Fin calculo de total de medicamento

        //Inicio validacion de campos requeridos dentro del formulario
        \$(\"#agregarMedicamento\").on('click', function () {
            var myError = [];
            var errorString = '';

            if (\$(\"input[name\$='pacienteEstable']:checked\").length==0 && estadoPaciente != 'N' && estadoPaciente != 'S' && \$(\"#envioEspecializada\").val() == 'S'){
                myError.push('<li>Seleccionar si el paciente es estable</li>');
            }

            if (!idMedicamento.select2('val')) {
                myError.push('<li>Ingrese el medicamento.</li>');
            }

            if (\$(\"#cantidadMedicamento\").val() == '') {
                myError.push('<li>Cantidad.</li>');
            }

            if (\$(\"#frecuencia\").val() == '') {
            myError.push('<li>Cada.</li>');
            }

            if (\$(\"#tiempoFrecuencia\").select2('val') == '') {
            myError.push('<li>Seleccione el periodo.</li>');
            }

            if (\$(\"#iddosificacion\").select2('val') == '') {
            myError.push('<li>Seleccione dosificación.</li>');
            }

            if (\$(\"#durante\").val() == '') {
            myError.push('<li>Durante.</li>');
            }

            if (\$(\"#totalMedicamento\").val() == '') {
            myError.push('<li>Total medicamento a dispensar.</li>');
            }

            if (\$(\"#repetitiva\").is(':checked')) {
                if (\$(\"#cantidadrepetitiva\").val() == '') {
                    myError.push('<li>Numero de Repetitiva.</li>');
                }else{
                    if(\$(\"#cantidadrepetitiva\").val()>5){
                        myError.push('<li>No puede extender mas de 5 repetitivas por medicamento.</li>');
                    }
                }
            }

            if (\$(\"#aplicarDist\").is(':checked')) {
                var num_items = getChildrenNumber('#bodycontent-distribucion');
                if(num_items<2){
                    myError.push('<li>Debe de tener al menos dos distribuciones por medicamento.</li>');
                }
            }

            if (\$(\"#aplicarDistEspecial\").is(':checked')) {
                var num_items = getChildrenNumber('#bodycontent-distribucion');
                if(num_items<2){
                    myError.push('<li>Debe de tener al menos dos distribuciones por medicamento.</li>');
                }
            }

            if ( \$(\"#justificacionprescripcion\").length > 0 && \$(\"#justificacionprescripcion\").val() == '') {
                    myError.push('<li>Ingresar Justificacion de prescripcion de medicamento.</li>');
            }


            if (myError.length > 0) {
                if (myError.length == 1) {
                    errorString = 'Por favor ingresar el siguiente campo';
                }
                if (myError.length > 1) {
                    errorString = 'Por favor ingresar los siguientes campos';
                }
                for (var i = 0; i < myError.length; i++) {
                    errorString = errorString + myError[i];
                }
                showDialogMsg('Error', errorString + '', 'dialog-error');
            }
            else {
                    if(\$(\"input[name\$='pacienteEstable']\").length != 0) {
                        estadoPaciente = \$(\"input[name\$='pacienteEstable']:checked\").val();
                    }

                    populateTableReceta();
                    pacienteEstable(estadoPaciente);
            }
        });

        function initMedicamentoSearch(element, placeholder) {//Funcion que muestra la informacion de los medicamentos de manera linear
            element.select2({
                allowClear: true,
                width: '100%',
                placeholder: placeholder,
                minimumInputLength: 3,
                dropdownAutoWidth: true,
                ajax: {
                    url: Routing.generate('listadomedicamento',{'idHistorialClinico':";
        // line 426
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idHistorialClinico"), "html", null, true);
        echo "}),
                    dataType: 'json',
                    quietMillis: 500,
                    data: function (term, page) {
                        return {
                            clue: term, //search term
                            page_limit: 10, // page size
                            page: page, // page number
                            ids: idsmedicamento.toString(),
                        };
                    },
                    results: function (data, page) {
                        var more = (page * 10) < data.data2;
                        return {results: data.data1, more: more};
                    }
                },
                formatResult: function(result) {
                    var elements = [];
                    var text     = result.text;
                    var html     = ' ';

                    elements = text.split('---');

                    html =  '<table>'+
                                '<tbody>'+
                                    '<tr><td>Medicamento:</td><td style=\"padding-left: 7px;\"><strong>'+elements[0]+'</strong></td></tr>'+
                                    '<tr><td>Forma Farmaceutica:</td><td style=\"padding-left: 7px;\"><strong>'+elements[1]+'</strong></td></tr>'+
                                    '<tr><td>Concentracion:</td><td style=\"padding-left: 7px;\"><strong>'+elements[2]+'</strong></td></tr>'+
                                    '<tr><td>Presentacion:</td><td style=\"padding-left: 7px;\"><strong>'+elements[3]+'</strong></td></tr>'+
                                    '<tr><td>Existencia:</td><td style=\"padding-left: 7px;\"><strong>'+elements[4]+'</strong></td></tr>'+
                                '</tbody>'+
                            '</table>';

                    return html;
                }

            })
            .on(\"select2-selecting\", function(e) {//Al selecionar el medicamento se seleciona el texto que se mostrara en la lista desplegable
                var elements = [];
                var text = e.object.text;

                elements = text.split('---');

                if(elements[0] !== undefined) {
                    text = elements[0]+'----'+elements[1]+'----'+elements[2];//Se muestra el nombre del medicamento, cormula farmaceutica y concentracion
                }
                e.object.text = text;
            });
        };

        function getChildrenNumber(Selector) {
            return \$(Selector).children().length;
        }

        function populateTableReceta() {
            var num_items = getChildrenNumber('#bodycontent-receta');
            var repetitiva = '0';
            var cadenadistribucion = '';
            var exitedistribucion = 0;
            var distribucionlistado = '';
            var justificacionprescripcion = '';
            var coeficiente = 1000;
            var totalMedicamento;
            var pacienteEstable = estadoPaciente;

            cadenadistribucion = concatDistribucion ();

            if (cadenadistribucion !== ''){
                var exitedistribucion = 1;
                var distribucionlistado = '<br/>Distribuido de la siguiente manera:';
                distribucionlistado+='<table class=\"table\">';
                distribucionlistado+='<tbody><tr><th>Cantidad</th><th>Descripción</th></tr>';
                cadenadistribucion = cadenadistribucion.slice(0, - 2)
                var arrayDistribucion = cadenadistribucion.split('°°');
                for (var i = 0; i < arrayDistribucion.length; i++) {
                    resultados = arrayDistribucion[i].split(\"¬¬\");
                    distribucionlistado += '<tr><td>' + resultados[0] + '</td><td>'+resultados[1]+'</td></tr>';
                }//endfor
                    distribucionlistado+='</tbody></table>';
            }//endif

            var tbody = '';

            idsmedicamento.push(idMedicamento.select2('val'));

            if (num_items > 0 && \$('#emptyTr').length !== 0) {
                \$('#bodycontent-receta').empty();
            }

            if (\$(\"#repetitiva\").is(':checked')) {
                repetitiva = \$(\"#cantidadrepetitiva\").val();
            }

            var fechaCalculada='';
            var k, tiempo, cantidad;

            if(\$('#formulaInsulina').val() == 'S'){
                k= \$('#TiempoEnDiasInsulina').val();
                tiempo = 'dia';//si el calculo para  receta repetitiva sera en dias
            }
            else{
                k= 1;
                tiempo = 'mes';//si el calculo para  receta repetitiva sera en meses
            }

            if (\$(\"#justificacionprescripcion\").length > 0 ) {//si el medicamento ya ha sido prescrito en un periodo corto de tiempo se justifica la prescripcion
               justificacionprescripcion = \$(\"#justificacionprescripcion\").val();
            }

            ";
        // line 535
        if (((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit")) {
            // line 536
            echo "                var guardar;
                fechaReceta = \"";
            // line 537
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["idHistorialClinico"]) ? $context["idHistorialClinico"] : $this->getContext($context, "idHistorialClinico")), "getFechaconsulta", array(), "method"), "Y-m-d"), "html", null, true);
            echo "\";
                for(var i=0;i<=repetitiva;i++){
                    tipo =\"hidden\";
                    var pacienteEstable = estadoPaciente;

                    //inicio evaluar medicamentos que van a especializada
                    if(i>=recetadelDia && \$(\"#envioEspecializada\").val()=='S' && \$(\"#banderaMedicamentoEspecializada\").val()==1 && pacienteEstable == 'S'){
                        var formulaInsulina = \$(\"#formulaInsulina\").val();
                        if(formulaInsulina != 'S'){//Esto aplica a aquellos medicamentos que no son insulina para envio a especializada
                            tiempo = 'especializada';//cambiar a especializada el valor
                            coeficiente = parseInt(repetitiva)-i;//coeficiente igual a cero receta de un mes coeficiente distinto de cero receta bimensual
                            i++;
                            if(coeficiente == 0){
                                totalMedicamento= \$(\"#totalMedicamento\").val();
                                durante= \$(\"#durante\").val();
                            }
                            else{
                                totalMedicamento = \$(\"#totalMedicamento\").val();//La cantidad de medicamento a suministrar se duplica ya que la receta en bimensual
                                totalMedicamento = parseInt(totalMedicamento*2);
                                durante = \$(\"#durante\").val();
                                durante = parseInt(durante*2);
                            }
                        }
                        else{//Medicamentos insulina ya que la entrega es mensual no bimensual
                             coeficiente = parseInt(repetitiva)-i;//coeficiente igual a cero receta de un mes coeficiente distinto de cero receta bimensual
                             totalMedicamento= \$(\"#totalMedicamento\").val();
                             durante= \$(\"#durante\").val();
                        }
                        idestabdespacha=\$('#idEspecializada').val();//El id establecimiento que se ha configurado para farmacia especializada
                    }
                    else{//Cuando el medicamento se despacha en el establecimiento de consulta
                       totalMedicamento= \$(\"#totalMedicamento\").val();
                       durante= \$(\"#durante\").val();
                       idestabdespacha=\$('#idEstablecimientoConsulta').val();
                    }

                    if(\$(\"#envioEspecializada\").val()=='N'){
                        pacienteEstable = '';
                    }


                    //fin evaluacion medicamentos que van a especializada


                    if(\$(\"#aplicarDistEspecial\").is(':checked')){
                        frecuenciaDistEspecialshow = '--';
                        frecuenciaDistEspecialhide = 0;
                        tiempoDuranteDistEspecial = '--';
                    }
                    else{
                        frecuenciaDistEspecialshow = \$(\"#frecuencia\").val();
                        frecuenciaDistEspecialhide= \$(\"#frecuencia\").val();
                        tiempoDuranteDistEspecial = \$(\"#tiempoFrecuencia\").val();
                    }
                    cantidad = parseInt(i)* parseInt(k);
                    var dosificaciontexto = \$(\"#iddosificacion option:selected\").text();

                     var parametros = '?idMedicamento=' + idMedicamento.select2('val') + '&cantidadMedicamento=' + \$(\"#cantidadMedicamento\").val()
                                + '&frecuencia=' + \$(\"#frecuencia\").val() + '&tiempoFrecuencia=' + tiempoDuranteDistEspecial+'&pacienteEstable='+pacienteEstable
                                + '&durante=' + durante + '&tiempoDurante=Dia(s)&totalMedicamento=' + totalMedicamento
                                + '&recomendacion=' + \$(\"#recomendacion\").val() + '&repetitiva=' + repetitiva
                                + '&iddosificacion='+\$(\"#iddosificacion\").val()+'&dosificaciontexto='+dosificaciontexto
                                + '&banderaDistribucion=' + exitedistribucion + '&distribucion=' + cadenadistribucion+'&cantidad='+cantidad+'&justificacionprescripcion='+justificacionprescripcion+'&tiempo='+tiempo+'&fechaReceta='+fechaReceta+'&coeficiente='+coeficiente+'&idestabdespacha='+idestabdespacha+'&i='+i+'&recetadelDia='+recetadelDia+'&formulaInsulina='+formulaInsulina;
                    if (i == repetitiva && i > 0){
                        tipo =\"text\";
                        totalmedicamentomostrar = '';
                        durantemostrar = '';
                    }
                    else{
                        totalmedicamentomostrar = totalMedicamento;
                        durantemostrar = durante;
                    }
                    jQuery.ajax({
                        url: Routing.generate('agregar_medicina_recetada', {'idHistorialClinico': ";
            // line 610
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idHistorialClinico"), "html", null, true);
            echo "}) + parametros,
                        async: false,
                        dataType: 'json',
                        timeout: 8000,
                        success: function (data) {
                             if (i == repetitiva){//Esto es para que muestre el icono de guardar para que permita modificar algunos datos de la ultima receta
                                guardar ='<span class=\"glyphicon glyphicon-floppy-disk mouse-pointer\"  title=\"Actualizar Informacion\" id=\"actualizarMedicamento_'+data.id.id+'\" style=\"font-size:20px;display:none;\" role=\"save\"></span>';
                             }
                             else{
                                 guardar ='';
                             }
                              tbody = tbody + '\\
                              <tr id=\"tr_' + data.id.id + '\"\">\\
                              <td style=\"width:40%;\">\\
                              ' + idMedicamento.select2(\"data\")['text'] + '\\
                              <input type=\"hidden\" id=\"idMedicamento_' + data.id.id + '\" name=\"idMedicamento[' + data.id.id + ']\" value=\"' + idMedicamento.select2(\"data\") + '\" />\\
                              </td>\\
                              <td>' + \$(\"#cantidadMedicamento\").val() + dosificaciontexto + '' +distribucionlistado + '<input type=\"hidden\" name=\"cantidadMedicamento[' + data.id.id + ']\" value=\"' + \$(\"#cantidadMedicamento\").val() + '\"></td>\\
                              <td>' + frecuenciaDistEspecialshow + ' ' + tiempoDuranteDistEspecial + '\\
                              <input type=\"hidden\" name=\"frecuencia[' + data.id.id + ']\" value=\"' + frecuenciaDistEspecialhide + '\">\\
                              <input type=\"hidden\" name=\"tiempoFrecuencia[' + data.id.id + ']\" value=\"' + tiempoDuranteDistEspecial + '\">\\
                              </td>\\
                              <td>' +durantemostrar+ ' \\
                              <input size = \"4\" type=\"'+tipo+'\" name=\"durante[' + data.id.id + ']\" id = \"durante_'+data.id.id+'\" value=\"' + durante + '\">\\
                              <input type=\"hidden\" name=\"tiempoDurante[' + data.id.id + ']\" value=\"Dia(s)\">Dias\\
                              </td>\\
                              <td>' +totalmedicamentomostrar+ '<input size = \"4\" type=\"'+tipo+'\" name=\"totalMedicamento[' + data.id.id + ']\" id = \"totalMedicamento_'+data.id.id+'\"value=\"' + totalMedicamento + '\"></td>\\
                              <td>' + \$(\"#recomendacion\").val() + '<input type=\"hidden\" name=\"recomendacion[' + data.id.id + ']\" value=\"' + \$(\"#recomendacion\").val() + '\"></td>\\
                              <td>' + data.id.fecha+ '<input type=\"hidden\" name=\"repetitiva[' + data.id.id + ']\" value=\"' + repetitiva + '\"></td>\\
                              <td>'+guardar+'</td>\\
                              <td style=\"width:25px;\"><span class=\"glyphicon glyphicon-trash mouse-pointer\" id=\"borrarMedicamento_' + data.id.id + '\" style=\"font-size:20px;\" role=\"trash\"></span></td>\\
                              <td><span style=\"float: right\"><input type=\"checkbox\" id=\"seleccionarMediciaImpresion_' + data.id.id + '\" ></span></td>\\
                              </tr>';
                              fechaRecetaaux = data.id.fecha;
                              fechaRecetaaux = fechaRecetaaux.split(\"-\");
                              fechaReceta = fechaRecetaaux[0]+'-'+fechaRecetaaux[1]+'-'+fechaRecetaaux[2];
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error('Hubo un error al consultar la fecha.\\nDetalle del Error: textStatus: '+textStatus+', errorThrown: '+errorThrown);
                            showDialogMsg('Error al consultar la fecha','Se ha Producido un error al intentar consultar la fecha<br/>Es posible que existan problemas de conexión con la BD.','dialog-error');
                        }
                    });
                }

                \$('#bodycontent-receta').append(tbody);
                \$(\"#repetitiva\").prop(\"checked\", false);
                \$(\"#aplicarDist\").prop(\"checked\", false).trigger('change');
                \$(\"#aplicarDistEspecial\").prop(\"checked\", false).trigger('change');
                \$('#idbloquecantidad').hide();
                \$('#cuantosDistribucion').val('');
                clearform();

            ";
        } else {
            // line 662
            echo "/////INICIO QUITAR
                for (i=0;i<=repetitiva;i++){
                    totalMedicamento = 0;

                    if(i>=1 && \$(\"#envioEspecializada\").val()=='S' && \$(\"#banderaMedicamentoEspecializada\").val()==1 ){
                        tiempo = 'mes';//carbiar a especializada el valor
                        coeficiente = parseInt(repetitiva)-i;//coeficiente igual a cero receta de un mes coeficiente distinto de cero receta bimensual
                        cantidadCalculoFecha = parseInt(i)* parseInt(k);
                        i++;
                        if(coeficiente == 0){
                            totalMedicamento= \$(\"#totalMedicamento\").val();
                        }
                        else{
                            totalMedicamento = \$(\"#totalMedicamento\").val();//La cantidad de medicamento a suministrar se duplica ya que la receta en bimensual
                            totalMedicamento = parseInt(totalMedicamento*2);
                        }
                        idestabdespacha=\$('#idEspecializada').val();
                    }
                    else{//Cuando el medicamento se despacha en el establecimiento de consulta
                        cantidadCalculoFecha = parseInt(i)* parseInt(k);
                        totalMedicamento= \$(\"#totalMedicamento\").val();
                        idestabdespacha=\$('#idEstablecimientoConsulta').val();
                    }

                    jQuery.ajax({
                    url: Routing.generate('calcular_fecha_receta', {'cantidad': cantidadCalculoFecha,'tiempo':tiempo,'idHistorialClinico':";
            // line 687
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idHistorialClinico"), "html", null, true);
            echo ",'coeficiente':coeficiente}),
                    async: false,
                    dataType: 'json',
                    timeout: 8000, // 8 segundos
                    success:function (data) {
                            var fechaCalculada=data.fecha;
                            var frecuenciaDistEspecialhide,frecuenciaDistEspecialshow,tiempoDuranteDistEspecial;
                            if(\$(\"#aplicarDistEspecial\").is(':checked')){
                                frecuenciaDistEspecialshow = '--';
                                frecuenciaDistEspecialhide = 0;
                                tiempoDuranteDistEspecial = '--';
                            }
                            else{
                                frecuenciaDistEspecialshow = \$(\"#frecuencia\").val();
                                frecuenciaDistEspecialhide= \$(\"#frecuencia\").val();
                                tiempoDuranteDistEspecial = \$(\"#tiempoFrecuencia\").val();
                            }
                            tbody = tbody + '\\
                                <tr id=\"tr_' + idMedicamento.select2('val') + '_'+i+'\">\\
                                <td style=\"width:40%;\">\\
                                ' + idMedicamento.select2(\"data\")['text'] + '\\
                                <input type=\"hidden\" id=\"idMedicamento_' + idMedicamento.select2('val') + '\" name=\"idMedicamento[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + idMedicamento.select2('val') + '\" />\\
                                </td>\\
                                <td><b>' + \$(\"#cantidadMedicamento\").val() + '</b><input type=\"hidden\" name=\"cantidadMedicamento[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + \$(\"#cantidadMedicamento\").val() + '\">\\
                                ' + distribucionlistado + '\\
                                </td>\\
                                <td>' + frecuenciaDistEspecialshow + ' ' + tiempoDuranteDistEspecial + '\\
                                <input type=\"hidden\" name=\"frecuencia[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + frecuenciaDistEspecialhide + '\">\\
                                <input type=\"hidden\" name=\"tiempoFrecuencia[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + tiempoDuranteDistEspecial + '\">\\
                                <input type=\"hidden\" name=\"distribucion[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + cadenadistribucion + '\">\\
                                <input type=\"hidden\" name=\"banderaDistribucion[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + exitedistribucion + '\">\\
                                <input type=\"hidden\" name=\"tiempoCalculoFecha[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + tiempo + '\">\\
                                <input type=\"hidden\" name=\"cantidadCalculoFecha[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + cantidadCalculoFecha + '\">\\
                                </td>\\
                                <td>' + \$(\"#durante\").val() + ' \\
                                <input type=\"hidden\" name=\"durante[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + \$(\"#durante\").val() + '\">\\
                                <input type=\"hidden\" name=\"tiempoDurante[' + idMedicamento.select2('val') + '_'+i+']\" value=\"Dia(s)\">Dias\\
                                </td>\\
                                <td>' + totalMedicamento + '<input type=\"hidden\" name=\"totalMedicamento[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + totalMedicamento + '\"></td>\\
                                <td>' + \$(\"#recomendacion\").val() + '<input type=\"hidden\" name=\"recomendacion[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + \$(\"#recomendacion\").val() + '\"></td>\\
                                <td>' + fechaCalculada + '<input type=\"hidden\" name=\"repetitiva[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + repetitiva + '\"><input type=\"hidden\" name=\"fechaReceta[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + fechaCalculada + '\"></td>\\
                                <td style=\"width:25px;\"><span class=\"glyphicon glyphicon-trash mouse-pointer\" id=\"borrarMedicamento_' + idMedicamento.select2('val') + '_'+i+'\" style=\"font-size:20px;\" role=\"trash\"></span></td>\\
                                <td><input type=\"hidden\" name=\"justificacionprescripcion[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + justificacionprescripcion + '\"></td>\\
                                <td><input type=\"hidden\" name=\"idestabdespacha[' + idMedicamento.select2('val') + '_'+i+']\" value=\"' + idestabdespacha + '\"></td>\\
                                </tr>';
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error('Hubo un error al consultar la fecha.\\nDetalle del Error: textStatus: '+textStatus+', errorThrown: '+errorThrown);
                            showDialogMsg('Error al consultar la fecha','Se ha Producido un error al intentar consultar la fecha<br/>Es posible que existan problemas de conexión con la BD.','dialog-error');
                        }
                    });

                }/////FIN QUITAR
                \$('#bodycontent-receta').append(tbody);
                \$(\"#repetitiva\").prop(\"checked\", false);
                \$(\"#aplicarDist\").prop(\"checked\", false).trigger('change');
                \$(\"#aplicarDistEspecial\").prop(\"checked\", false).trigger('change');
                \$('#idbloquecantidad').hide();
                \$('#cuantosDistribucion').val('');
                clearform();
            ";
        }
        // line 748
        echo "        }

        function clearform() {
            \$(\"#idMedicamento\").select2('val', '');
            \$(\"#cantidadMedicamento\").val(\"\");
            \$(\"#frecuencia\").val(\"\");
            \$(\"#durante\").val(\"\");
            \$(\"#totalMedicamento\").val(\"\");
            \$(\"#recomendacion\").val(\"\");
            \$(\"#tiempoFrecuencia\").select2('val', '');
            \$(\"#cantidadrepetitiva\").val(\"\");
            \$(\"#formulaInsulina\").val(\"\");
            \$(\"#TiempoEnDiasInsulina\").val(\"\");
            \$('#totalMedicamento').attr(\"readonly\", false);
            \$('#durante').attr(\"readonly\", false);
            \$(\"#divjustificacionprescripcion\").remove();
            \$(\"#msjmedicina\").remove();
            \$(\"#banderaMedicamentoEspecializada\").val(\"\");
            \$(\"#iddosificacion\").select2('val', '');
        }

        //Bloque de codigo utilizado para borrar medicamentos que se han agregado
        \$(\"body\").on('click', \"span[id^='borrarMedicamento_']\", function () {
            ";
        // line 771
        if (((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) == "edit")) {
            // line 772
            echo "                var item = \$(this);
                var valores = item.attr('id').split('_');
                var id = valores[1];
                var title = 'Borrar Receta';
                var dialogClass = 'dialog-warning';
                var msg = '¿Desea borrar la receta?';
                var width= 350;
                var closeBtnName = '';
                var createDefaultBtnClose = false;
                var arrayBtns = [
                                    {
                                        text: 'Aceptar', click: function() {
                                                var tbody = '';
                                                jQuery.ajax({
                                                    url: Routing.generate('borrar_medicina_recetada', {'idMedicinaRecetada': id, 'idHistorialClinico':";
            // line 786
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idHistorialClinico"), "html", null, true);
            echo "}),
                                                    dataType: 'json',
                                                    success: function (data) {
                                                               var index = idsmedicamento.indexOf(data.id.idMedicamento); //idsmedicamento es una variable global de tipo array que tiene los id de los medicamentos que se agregan a la receta
                                                               idsmedicamento.splice(index, 1);//Borrar los medicamentos que estan en el array, validacion para no mostrar medicamento ya ingresado
                                                               var indeximpresion = idmedicinarecetadaimpresion.indexOf(data.id.idMedicamento);
                                                               idmedicinarecetadaimpresion.splice(indeximpresion, 1);//Borra los medicamentos por si esta selecionado para impresion
                                                               \$('#tr_' + data.id.id).remove();
                                                               var num_items = getChildrenNumber('#bodycontent-receta');
                                                               if (num_items == 0) {
                                                                   tbody = '<tr id=\"emptyTr\"><td colspan=\"7\">No se han agregado medicamentos...</td></tr>';
                                                                   \$('#bodycontent-receta').append(tbody);
                                                                   estadoPaciente = '0';
                                                                   pacienteEstable(estadoPaciente);
                                                               }
                                                               jQuery('div#dialog-message').dialog( \"close\" );
                                                           }
                                                });
                                            }
                                    },
                                    {
                                        text: 'Cerrar', click: function( event, ui) {
                                            jQuery( this ).dialog( \"close\" );
                                        }
                                    }
                                ];

              showDialogMsg(title, msg, dialogClass, closeBtnName, arrayBtns, createDefaultBtnClose, width);

            ";
        } else {
            // line 816
            echo "                var tbody = '';
                var item = \$(this);
                var valores = item.attr('id').split('_');
                var id = valores[1];
                var index = idsmedicamento.indexOf(id); //idsmedicamento es una variable global de tipo array que tiene los id de los medicamentos que se agregan a la receta
                idsmedicamento.splice(index, 1);
                idmedicinarecetadaimpresion.splice(index, 1);//Borra los medicamentos por si esta selecionado para impresion
                \$('#tr_' + id+'_'+valores[2]).remove();
                var num_items = getChildrenNumber('#bodycontent-receta');
                if (num_items == 0) {
                        tbody = '<tr id=\"emptyTr\"><td colspan=\"7\">No se han agregado medicamentos.med...</td></tr>';
                        \$('#bodycontent-receta').append(tbody);
                }
            ";
        }
        // line 830
        echo "        });
        //Fin bloque de codigo utilizado para borrar medicamentos

        \$(\"body\").on('input', \"input[id^='durante_']\", function () {
            console.log('hola');
            var item = \$(this);
            var valores = item.attr('id').split('_');
            var id = valores[1];

            \$('#actualizarMedicamento_'+id).show();
        });

        \$(\"body\").on('input', \"input[id^='totalMedicamento_']\", function () {
            console.log('hola');
            var item = \$(this);
            var valores = item.attr('id').split('_');
            var id = valores[1];
            \$('#actualizarMedicamento_'+id).show();
        });



        \$(\"body\").on('click', \"span[id^='actualizarMedicamento_']\", function () {
                var item = \$(this);
                var valores = item.attr('id').split('_');
                var id = valores[1];
                var durante = \$('#durante_'+id).val();
                var totalMedicamento = \$('#totalMedicamento_'+id).val();
                if(totalMedicamento == '' || durante == ''){
                    showDialogMsg('Recetario', 'Para guardar los cambios no pueden quedar vacios los campos de las columnas Durante y Total Medicamento', 'dialog-info');
                }
                else{
                    jQuery.ajax({
                        url: Routing.generate('actualizar_medicina_recetada', {'idMedicinaRecetada': id, 'idHistorialClinico':";
        // line 863
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idHistorialClinico"), "html", null, true);
        echo ",'durante':durante, 'totalMedicamento':totalMedicamento}),
                        dataType: 'json',
                        success: function (data) {
                            \$('#actualizarMedicamento_'+id).hide();
                        }
                    });
                }
        });


        \$(\"body\").on('click', \"span[id='imprimir-receta']\", function () {//Se envia el array de recetas que se desea imprimir
            if(idmedicinarecetadaimpresion.length!=0){//Pregunta si el array que contiene los id de las recetas esta vacio
                var winParams = [];
                winParams['method'] = \"post\";
                winParams['action'] = \"";
        // line 877
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_farmacia_farmrecetas_imprimir_receta");
        echo "\";
                winParams['target'] = \"Impresion de Receta\";
                winParams['parameters'] = { 'id_receta': idmedicinarecetadaimpresion };
                openPostPopUpWindows(winParams);
            }
            else{
                showDialogMsg('Recetario', 'Por favor selecionar la(s) recetas a imprimir', 'dialog-info');
            }
        });


        \$('input[noIcheck=\"true\"]').iCheck('destroy');
        showhideblockcantidad(\$(\"#repetitiva\"));
        showhideblockdistribucion(\$(\"#aplicarDist\"));
        showhideblockdistribucionespecial(\$(\"#aplicarDistEspecial\"));
        \$(\"#repetitiva\").on('change', function (event) {
                showhideblockcantidad(\$(this));
        });

        function showhideblockcantidad(element) {
            if (element.prop('checked')){
                \$('#idbloquecantidad').show();
            }
            else{
                \$('#idbloquecantidad').hide();
            }
        }

        \$(\"#aplicarDist\").on('change', function(event) {
            showhideblockdistribucion(\$(this));
        });

        \$(\"#aplicarDistEspecial\").on('change', function(event) {
            showhideblockdistribucionespecial(\$(this));
        });


         //Funcion que muestra u oculta elementos dependiendo si se aplica distribucion a la receta
        function showhideblockdistribucionespecial(element){
            \$(\"#aplicarDist\").removeAttr(\"checked\");
            if (element.prop('checked')){
                    \$('#blockdistribucion').show();


                    \$('#blockingresardistribucion').show();
                    \$('#cantidadMedicamento').attr(\"readonly\", true);
                    \$('#cantidadMedicamento').val(\"\");
                    \$('#totalMedicamento').val(\"\");
                    \$('#idblockperiodo').hide();
                    \$('#durante').val(\"--\");//se dejan por defecto estos valores ya que son ocultados en el formulario
                    \$('#frecuencia').val('0');//se dejan por defecto estos valores ya que son ocultados en el formulario
                    \$('#tiempoFrecuencia').select2('val','Dia(s)');//se dejan por defecto estos valores ya que son ocultados en el formulario
            }else{
                \$('#bodycontent-distribucion').remove();
                var tbody = '<tbody id=\"bodycontent-distribucion\">\\
                            <tr id=\"emptyTrDistribucion\"><td colspan=\"3\">No se han agregado detalles...</td></tr>\\
                            </tbody>';
                \$('#tabla-distribucion').append(tbody);
                \$('#blockdistribucion').hide();


                \$('#blockingresardistribucion').hide();
                \$('#cantidadMedicamento').attr(\"readonly\", false);
                \$('#cantidadMedicamento').val(\"\");
                \$('#frecuencia').val('');
                \$('#tiempoFrecuencia').select2('val','')
                \$('#totalMedicamento').val(\"\");
                \$('#durante').val(\"\");
                \$('#idblockperiodo').show();
            }
        }

        //Funcion que muestra u oculta elementos dependiendo si se aplica distribucion a la receta
        function showhideblockdistribucion(element){
            \$(\"#aplicarDistEspecial\").removeAttr(\"checked\");
            \$('#idblockperiodo').show();
            if (element.prop('checked')){
                    \$('#blockdistribucion').show();


                    \$('#blockingresardistribucion').show();
                    \$('#cantidadMedicamento').attr(\"readonly\", true);
                    \$('#cantidadMedicamento').val(\"\");
                    \$('#totalMedicamento').val(\"\");
                    \$('#durante').val(\"\");
                    \$('#frecuencia').val('1');
                    \$('#tiempoFrecuencia').select2('val','Dia(s)')
            }else{
                \$('#bodycontent-distribucion').remove();
                var tbody = '<tbody id=\"bodycontent-distribucion\">\\
                            <tr id=\"emptyTrDistribucion\"><td colspan=\"3\">No se han agregado detalles...</td></tr>\\
                            </tbody>';
                \$('#tabla-distribucion').append(tbody);
                \$('#blockdistribucion').hide();

                \$('#blockingresardistribucion').hide();
                \$('#cantidadMedicamento').attr(\"readonly\", false);
                \$('#cantidadMedicamento').val(\"\");
                \$('#frecuencia').val('');
                \$('#tiempoFrecuencia').select2('val','')
                \$('#totalMedicamento').val(\"\");
                \$('#durante').val(\"\");
            }
        }

        \$(\"#agregarDistribucion\").on('click', function(){
            var myError = [];
            var errorString = '';
            if (\$(\"#cantidadDistribucion\").val() == ''){
                myError.push('<li>Distribución.</li>');
            }
            if (\$(\"#indicacion\").val() == ''){
                myError.push('<li>Indicacion.</li>');
            }
            if (!idMedicamento.select2('val')){
                myError.push('<li>Selecionar medicamento.</li>');
            }
            if (myError.length > 0) {
                if (myError.length === 1){
                    errorString = 'Por favor ingresar el siguiente campo'
                };
                if (myError.length > 1){
                    errorString = 'Por favor ingresar los siguientes campos'};
                    for (var i = 0; i < myError.length; i++) {
                        errorString = errorString + myError[i];
                    }
                showDialogMsg('Error', '<span class=\"glyphicon glyphicon-remove\"></span>' + errorString + '', 'dialog-error');
            }else{
                    populateTableDistribucion ();
                    calculoInsulina ();
                    calculoTotalMedicamentoCuantificable();
            }
        });

        function populateTableDistribucion (){//Funcion utilizada para agregar detalles a la tabla de distribucion
            \$(\"#cantidadrepetitiva\").val('');
            var i;
            var num_items = getChildrenNumber('#bodycontent-distribucion');
            var tbody = '';
            if (\$('#cuantosDistribucion').val() === ''){
                i = 1;
                \$('#cuantosDistribucion').val(i);
            }else{
                i = parseFloat(\$('#cuantosDistribucion').val()) + 1;
                \$('#cuantosDistribucion').val(i)
            }
            if (num_items > 0 && \$('#emptyTrDistribucion').length !== 0) {
                \$('#bodycontent-distribucion').empty();
            }
            tbody = tbody + '\\
                    <tr id=\"tr_' + idMedicamento.select2('val') + '_' + i + '\">\\
                    <td>' + \$(\"#cantidadDistribucion\").val() + '<input auxid=\"' + i + '\" type=\"hidden\" id=\"td_cantdis_' + i + '_' + idMedicamento.select2('val') + '\" value=\"' + \$(\"#cantidadDistribucion\").val() + '\"></td>\\
                    <td>' + \$(\"#indicacion\").val() + '<input auxid=\"' + i + '\" type=\"hidden\" id=\"td_indicacion_' + i + '_' + idMedicamento.select2('val') + '\" value=\"' + \$(\"#indicacion\").val() + '\"></td>\\
                    <td style=\"width:25px;\"><span class=\"glyphicon glyphicon-trash mouse-pointer\" id=\"borrarDistribucion_' + idMedicamento.select2('val') + '_' + i + '\" style=\"font-size:20px;\" role=\"trash\"></span></td>\\
                    </tr>';
            \$('#bodycontent-distribucion').append(tbody);
            \$(\"#cantidadDistribucion\").val(\"\");
            \$(\"#indicacion\").val(\"\");
            sumarDistribucion();
        }

        function sumarDistribucion (){//Funcion utilizada para sumar las cantidades que se ingresan en distribucion y colocarlar la suma en catidadMedicamento
            var suma = 0;
            \$(\"body input[id^='td_cantdis_']\").each(function(){
                suma = suma + parseFloat(\$(this).val());
            });
            \$(\"#cantidadMedicamento\").val(suma.toFixed(2));
            calculoInsulina ();
            calculoTotalMedicamentoCuantificable();
        }

        \$(\"body\").on('click', \"span[id^='borrarDistribucion_']\", function(){//Funcion para borrar un detalle de la distribucion
            var tbody = '';
            var item = \$(this);
            var id = item.attr('id').replace('borrarDistribucion_', '');
            \$('#tr_' + id).remove();
            var num_items = getChildrenNumber('#bodycontent-distribucion');
            if (num_items == 0) {
                tbody = '<tr id=\"emptyTrDistribucion\"><td colspan=\"3\">No se han agregado detalles...</td></tr>';
                \$('#bodycontent-distribucion').append(tbody);
                \$('#durante').val('');
                \$(\"#totalMedicamento\").val('');
            }
            sumarDistribucion();
            \$(\"#cantidadrepetitiva\").val('');//Cuando se modifica la distribucion se borra el dato de repetitiva en caso haya sido ingresado.
        });

        function concatDistribucion (){ //Funcion para concatenar los valores cuando el medicamento contiene un distribucion
                var cadenadistribucion = '';
                \$('body input[id^=\"td_cantdis_\"]').each(function(){
                    cadenadistribucion += (\$(this).val() + '¬¬' + \$('body input[id^=\"td_indicacion_' + \$(this).attr('auxid') + '\"]').val()) + '°°';
                });
                return cadenadistribucion;
        }

        //Funcion que se utiliza para el calculo de la insulina
        function calculoInsulina (){
            if(\$('#cantidadMedicamento').val() != '' && \$('#formulaInsulina').val() == 'S' && \$('#cantidadMedicamento').val() != 0){
                var TotaldeUnidadesDelDia = \$('#cantidadMedicamento').val();
                var TotaldelMes;
                var TiempoEnDias;

                TotaldelMes =Math.ceil((TotaldeUnidadesDelDia/1000)*30);
                if(TotaldelMes < 1){
                    TotaldelMes=1;
                }
                if(TotaldelMes >= 4){
                    TotaldelMes=3;
                }

                TiempoEnDias=Math.ceil((TotaldelMes*(1000))/TotaldeUnidadesDelDia);
                if(TiempoEnDias > 30 && TotaldelMes==1){//Solo puede durar 1 mes un frasco
                    TiempoEnDias=30;
                }
                \$(\"#totalMedicamento\").val(TotaldelMes);
                \$(\"#TiempoEnDiasInsulina\").val(TiempoEnDias);//si ya lo guardo en campo durante puedo quitar este campo
                \$('#durante').val(TiempoEnDias);
            }
            else{
                if(cuantificable==0){//Si es cuantificable el medicamento no se borra el valor del total de medicamento esto no aplica para la Insulina
                    \$(\"#totalMedicamento\").val('');
                }
            }
        }

        //Llamar a la funcion para el calculo de la insulina cada vez que se cambie la cantidad de medicamen
        //to
       \$(\"#cantidadMedicamento\").on('change', function(event) {
            calculoInsulina ();
        });


        //Validar que el valor de repetitiva no sea mayor que 5
        \$(\"#cantidadrepetitiva\").on('change', function(event) {
            if( \$(\"#cantidadrepetitiva\").val() > 5 && \$('#formulaInsulina').val() != 'S'){
                \$(\"#cantidadrepetitiva\").val('')
                showDialogMsg('Recetario', 'El valor de repetitiva no puede ser mayor que 5', 'dialog-info');
                \$(\"#cantidadrepetitiva\").val(5);
            }

            //Calculo para evaluar si el tiempo total del tratamiento junto con el numero de repetitiva sobre pasa los 180 dias.
            var tiempoTotalInsulina = parseInt(\$(\"#TiempoEnDiasInsulina\").val())+parseInt(\$(\"#cantidadrepetitiva\").val()*\$(\"#TiempoEnDiasInsulina\").val());

            if( \$(\"#cantidadrepetitiva\").val() > 1 && tiempoTotalInsulina>180 && \$('#formulaInsulina').val() == 'S'){
                var numeroRep = (180/parseInt(\$(\"#TiempoEnDiasInsulina\").val()))-1;
                showDialogMsg('Notificacion', 'Insulina no puede ser prescrita para un maximo de 6 meses. El numero maximo recomendado de recetas repetitivas es: '+parseInt(numeroRep), 'dialog-info');
                \$(\"#cantidadrepetitiva\").val(parseInt(numeroRep));
            }
        });

        //Inicio bloque de codigo donde se obtine cierta informacion del medicamento que se ha selecionado para recerlo
        \$(\"#idMedicamento\").on('change', function(event) {
            var bandera = 0;
            var existencia = '';
            var valor;
            \$(\"#msjmedicina\").empty();
            \$(\"#divjustificacionprescripcion\").remove();
            if(\$(this).select2('val')){
                jQuery.ajax({
                        url: Routing.generate('consultar_medicina_recetada',{'idMedicamento':idMedicamento.select2('val'),'paramIdHistorialClinico':";
        // line 1136
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idHistorialClinico"), "html", null, true);
        echo "}),
                        dataType: 'json',
                         success: function (data) {

                             initializeSelect2(\$(\"#iddosificacion\"),true,true);
                             \$(\"#iddosificacion\").select2({
                                 placeholder: \"Dosificación\",
                                 allowClear: true
                             });
                             if(data.id.dosificacion.length > 0){
                             \$.each(data.id.dosificacion, function(key, value) {
                                    \$(\"#iddosificacion\").append('<option value=\"'+value.dosis+'\" selected>'+value.nombre+'</option>');
                                    valor = value.dosis;
                                })
                                if(data.id.dosificacion.length == 1){
                                    \$(\"#iddosificacion\").select2('val',valor);
                                }

                            }
                            else{
                            ";
        // line 1156
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["dosificaciones"]) ? $context["dosificaciones"] : $this->getContext($context, "dosificaciones")));
        foreach ($context['_seq'] as $context["_key"] => $context["dosificacion"]) {
            // line 1157
            echo "                                \$(\"#iddosificacion\").append('<option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["dosificacion"]) ? $context["dosificacion"] : $this->getContext($context, "dosificacion")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["dosificacion"]) ? $context["dosificacion"] : $this->getContext($context, "dosificacion")), "abreviatura"), "html", null, true);
            echo "</option>');
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dosificacion'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 1159
        echo "                            }


                            \$(\"#banderaMedicamentoEspecializada\").val(data.id.medespecializada);//Establecer si el medicamento va a especializada
                            cuantificable=data.id.cuantificable;//Establecer si al medicamento se le puede realizar el calculo
                            \$(\"#formulaInsulina\").val(data.id.dosis);//Establecer si el medicamento lleva calculo de insulina

                            if(cuantificable == 1){
                                \$(\"#totalMedicamento\").prop('disabled', true);
                            }
                            else{
                                \$(\"#totalMedicamento\").prop('disabled', false);
                            }

                            if(data.id.existencia == 0 ){
                                existencia = '<li><b><span style=\"font-size:12px\">Por el momento no se tienen existencia en el sistema de este medicamento. Usted puede prescribir este medicamento para posteriormente poder calcular la demanda insatisfecha<br/><u>EXISTENCIA 0</u></span></b></li>';
                                bandera = 1;
                            }

                            //Inicio IF Validacion que muestra si el medicamento seleccionado ya ha sido prescrito
                            if( data.id.resetado > 0 ){
                                existencia ='<li><b>Este medicamento ya ha sido recetado en los ultimos 30 días'+existencia+'</li></b><br>';
                                campo = '</br><div class=\"row\" id = \"divjustificacionprescripcion\">'+
                                            '<div class=\"col-md-3\">'+
                                                'Justificacion'+
                                            '</div>'+
                                            '<div class=\"col-md-8\">'+
                                                '<textarea class=\"form-control\" name = \"justificacionprescripcion\" id=\"justificacionprescripcion\" placeholder=\"Justificacion\"></textarea>'+
                                            '</div>'+
                                        '</div>';
                                \$(\"#divrecomendacion\").after(campo);
                                bandera = 1;
                            }//Fin IF Validacion que muestra si el medicamento seleccionado ya ha sido resetado

                            if (bandera==1){//Si se ha encontrado existencia = 0 o medicamento ya prescrito bandera toma el valor de uno y se muestra el msj
                                \$(\"#divjustificacionprescripcion\").remove();
                                \$(\"#msjmedicina\").append( '<div class=\"alert alert-warning\" role=\"alert\"><ul>'+existencia+'</lu></div>' );
                                showDialogMsg('warning', existencia, 'dialog-warning');
                            }

                            if(data.id.dosis == 'S'){
                                \$('#totalMedicamento').attr(\"readonly\", true);
                                \$('#durante').attr(\"readonly\", true);
                                calculoInsulina ();
                            }
                            else{
                                \$('#totalMedicamento').attr(\"readonly\", false);
                                \$('#durante').attr(\"readonly\", false);
                                \$(\"#totalMedicamento\").val('');
                                \$('#durante').val('');
                            }
                        }
                });
            }
            else{
                \$(\"#repetitiva\").prop(\"checked\", false);
                \$(\"#aplicarDist\").prop(\"checked\", false).trigger('change');
                \$(\"#aplicarDistEspecial\").prop(\"checked\", false).trigger('change');
                \$('#idbloquecantidad').hide();
                \$('#cuantosDistribucion').val('');
                clearform();
            }
        });
        // FIN bloque de codigo donde se obtine cierta informacion del medicamento que se ha selecionado para recerlo


    }); //fin document ready
    </script>


    ";
        // line 1229
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
            // line 1230
            echo "        <script type=\"text/javascript\">
            jQuery(document).ready(function(\$) {
                \$('#close-button').on('click', function() {
                    window.close();
                });

                ";
            // line 1236
            if ((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array(), "any", false, true), "get", array(0 => "createdElement"), "method", true, true) && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "createdElement"), "method") != "")) && (!(null === $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "createdElement"), "method"))))) {
                // line 1237
                echo "                    window.addEventListener(\"beforeunload\", function (e) {
                        if (window.opener != null && !window.opener.closed) {
                            try {
                                window.opener.updateIdFarmacia(";
                // line 1240
                if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "createdElement"), "method") > 0)) {
                    echo "\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "get", array(0 => "createdElement"), "method"), "html", null, true);
                    echo "\"";
                } else {
                    echo "null";
                }
                echo ");
                            } catch (err) {
                                console.log(err.description || err) //or console.log or however you debug
                            }
                        }
                    });
                ";
            }
            // line 1247
            echo "            });
        </script>

        <script  type=\"text/javascript\">
        var modal_elements = [
                                {
                                    id:'consultaRecetas_modal',
                                    func:'loadmodal_receta',
                                    header:'Consulta de recetas del paciente',
                                    footer: '',
                                    widthModal: '1020px'
                                }
                            ];

        function loadmodal_receta() {
                var pat = \"";
            // line 1262
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_minsal_farmacia_farmrecetas_list", array("external" => $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external"), "idHistorialClinico" => $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idHistorialClinico"))), "html", null, true);
            echo "\";
                console.log(pat);
                var cadena = '<iframe frameborder= \"0\" src=\"'+pat+'\" width=\"100%\" style=\"min-height: 500px;\"></iframe>';
                return cadena;
        }

        </script>
    ";
        }
    }

    // line 1272
    public function block_content($context, array $blocks = array())
    {
    }

    // line 1276
    public function block_form($context, array $blocks = array())
    {
        // line 1277
        echo "        ";
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "assign_receta"), "method"))) {
            // line 1278
            echo "            <div>
                ";
            // line 1279
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "
            </div>
        ";
        } else {
            // line 1282
            echo "
            <form
                ";
            // line 1284
            if (($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "form_type"), "method") == "horizontal")) {
                echo "class=\"form-horizontal\"";
            }
            // line 1285
            echo "                role=\"form\"
                action=\"";
            // line 1286
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create"), "method"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
            echo "
                method=\"POST\"
                ";
            // line 1288
            if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
                echo "novalidate=\"novalidate\"";
            }
            // line 1289
            echo "                >
                 ";
            // line 1290
            $this->displayBlock('formactionsenca', $context, $blocks);
            // line 1296
            echo "
                <input type=\"hidden\" name=\"idHistorialClinico\" value=\"";
            // line 1297
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idHistorialClinico"), "html", null, true);
            echo "\">
                <input type=\"hidden\" name=\"_external\" value=\"";
            // line 1298
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external"), "html", null, true);
            echo "\">
                <input type=\"hidden\" name=\"action\" value=\"";
            // line 1299
            echo twig_escape_filter($this->env, (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), "html", null, true);
            echo "\">
                <input type=\"hidden\" name=\"cuantosDistribucion\" id=\"cuantosDistribucion\" value=\"\">
                <input type=\"hidden\" name=\"formulaInsulina\" id=\"formulaInsulina\" value=\"\">
                <input type=\"hidden\" name=\"TiempoEnDiasInsulina\" id=\"TiempoEnDiasInsulina\" value=\"\">
                <input type=\"hidden\" name=\"envioEspecializada\" id=\"envioEspecializada\" value=\"\">
                <input type=\"hidden\" name=\"idEspecializada\" id=\"idEspecializada\" value=\"\">
                <input type=\"hidden\" name=\"idEstablecimientoConsulta\" id=\"idEstablecimientoConsulta\" value=\"\">
                <input type=\"hidden\" name=\"idEstablecimientoDespacha\" id=\"idEstablecimientoDespacha\" value=\"\">
                <input type=\"hidden\" name=\"banderaMedicamentoEspecializada\" id=\"banderaMedicamentoEspecializada\" value=\"\">
                <input type=\"hidden\" name=\"despachoRecetaDelDia\" id=\"despachoRecetaDelDia\" value=\"\">

                ";
            // line 1310
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
                // line 1311
                echo "                    <div class=\"sonata-ba-form-error\">
                        ";
                // line 1312
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "
                    </div>
                ";
            }
            // line 1315
            echo "
                ";
            // line 1316
            $this->displayBlock('sonata_pre_fieldsets', $context, $blocks);
            // line 1319
            echo "
                    ";
            // line 1320
            $this->displayBlock('sonata_tab_content', $context, $blocks);
            // line 1602
            echo "
                    ";
            // line 1603
            $this->displayBlock('sonata_post_fieldsets', $context, $blocks);
            // line 1606
            echo "
                ";
            // line 1607
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "

                ";
            // line 1609
            $this->displayBlock('formactions', $context, $blocks);
            // line 1615
            echo "            </form>
        ";
        }
        // line 1617
        echo "
";
    }

    // line 1290
    public function block_formactionsenca($context, array $blocks = array())
    {
        // line 1291
        echo "                    <div class=\"well well-small form-actions\">
                        <a href=\"#myModal\" id=\"consultaRecetas_modal\" role=\"button\" class=\"modal-message  btn btn-info\" data-toggle=\"modal\" custom-modal=\"true\"><i class=\"fa fa-fw fa-medkit\"></i>Consulta medicamentos recetados</a>
                        <button class=\"btn btn-default\" type=\"button\" id=\"btn_cw_close\" name=\"btn_close\">Cerrar</button>
                    </div>
                ";
    }

    // line 1316
    public function block_sonata_pre_fieldsets($context, array $blocks = array())
    {
        // line 1317
        echo "                    <div class=\"row\">
                    ";
    }

    // line 1320
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 1321
        echo "                        <div id=\"msjmedicina\" ></div>
                        <div class=\"";
        // line 1322
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class"), "col-md-12")) : ("col-md-12")), "html", null, true);
        echo "\">
                            <div class=\"box box-success\">
                                <div class=\"box-header\">
                                    <h4 class=\"box-title\">Recetario</h4>
                                </div>
                                <div class=\"panel panel-info\" style=\"margin-left: 20px;margin-right: 20px;display:none\" id =\"dividpacienteestable\" >
                                    <div class=\"panel-heading\" >
                                        <h2 class=\"panel-title\"><b>Estado del Paciente</b></h2>
                                        <br/>
                                        <div class=\"row\" id=\"divpacienteestable\">
                                            <div class=\"col-md-1\">
                                                Estable<input type=\"radio\" name=\"pacienteEstable\" value=\"S\">
                                            </div>
                                            <div class=\"col-md-1\">
                                                No Estable  <input type=\"radio\" name=\"pacienteEstable\" value=\"N\">
                                            </div>
                                            <div class=\"col-md-10\">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                ";
        // line 1344
        if ((twig_length_filter($this->env, (isset($context["medicamentosadversos"]) ? $context["medicamentosadversos"] : $this->getContext($context, "medicamentosadversos"))) > 0)) {
            // line 1345
            echo "                                    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["medicamentosadversos"]) ? $context["medicamentosadversos"] : $this->getContext($context, "medicamentosadversos")));
            foreach ($context['_seq'] as $context["_key"] => $context["adversos"]) {
                // line 1346
                echo "                                        <div class=\"alert alert-warning\">
                                            <strong> ";
                // line 1347
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["adversos"]) ? $context["adversos"] : $this->getContext($context, "adversos")), "nombre"), "html", null, true);
                echo ": ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["adversos"]) ? $context["adversos"] : $this->getContext($context, "adversos")), "especificacion"), "html", null, true);
                echo "</strong>
                                        </div>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['adversos'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1350
            echo "                                ";
        }
        // line 1351
        echo "

                                <div class=\"box-body\">
                                    <div class=\"container-fluid\" style=\"background-color: #FCFCFC; border: 1px solid #CCCCCC; padding: 30px 20px 5px 20px; border-radius: 15px; margin-bottom: 8px;\">
                                        <div class=\"row\">
                                            <div class=\"col-md-2\">
                                                <h4 style=\"text-align: right;\"><i class=\"fa fa-fw fa-medkit\"></i> Medicamento:</h4>
                                            </div>
                                            <div class=\"col-md-10\">
                                                <div class=\"form-group\" style=\"width:100%\">
                                                    <div class=\"input-group\" style=\"width:100%\">
                                                        <label class=\"sr-only\" for=\"idMedicamento\">Medicamento</label>
                                                        <!-- style=\"cursor:pointer\" esto se pone adentro de la class del div para cuando quiera hacer lo del pu pop
                                                        <div class=\"input-group-addon\"  >+</div>-->
                                                        <input type=\"text\" class=\"form-control full_width\" id=\"idMedicamento\" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=\"row\" style=\"margin-bottom: 10px;\">
                                            <div  style=\"text-align: left;\" class=\"col-md-2\">
                                                <strong>Prescripcion por Distribución Diaria</strong>
                                            </div>
                                            <div class=\"col-md-3\">
                                                <div class=\"onoffswitch\">
                                                    <input type=\"checkbox\" name=\"aplicarDist\" class=\"onoffswitch-checkbox\" id=\"aplicarDist\" noIcheck=\"true\">
                                                    <label class=\"onoffswitch-label\" for=\"aplicarDist\">
                                                        <span class=\"onoffswitch-inner\" data-switch-on-label=\"SI\" data-switch-off-label=\"NO\"></span>
                                                        <span class=\"onoffswitch-switch\"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div  style=\"text-align: left;\" class=\"col-md-2\">
                                                <strong>Prescripcion por Distribución Especial</strong>
                                            </div>
                                            <div class=\"col-md-3\">
                                                <div class=\"onoffswitch\">
                                                    <input type=\"checkbox\" name=\"aplicarDistEspecial\" class=\"onoffswitch-checkbox\" id=\"aplicarDistEspecial\" noIcheck=\"true\">
                                                    <label class=\"onoffswitch-label\" for=\"aplicarDistEspecial\">
                                                        <span class=\"onoffswitch-inner\" data-switch-on-label=\"SI\" data-switch-off-label=\"NO\"></span>
                                                        <span class=\"onoffswitch-switch\"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div><br/>

                                        <div class=\"row\">
                                            <div class=\"col-md-12\" id=\"blockdosis\">
                                                <div class=\"panel panel-info\">
                                                    <div class=\"panel-heading\">
                                                        <h3 class=\"panel-title\">Dosis</h3>
                                                    </div>
                                                    <div class=\"panel-body\">
                                                        <div class=\"container-fluid\">
                                                            <div class=\"row\">
                                                                <!--<div id=\"blockingresardistribucion\">
                                                                    <div class=\"col-md-2\">
                                                                        Cantidad
                                                                    </div>
                                                                    <div class=\"col-md-2\" >
                                                                        <input type=\"text\" class=\"form-control\" id=\"cantidadDistribucion\" placeholder=\"Cantidad\"/>
                                                                    </div>
                                                                    <div class=\"col-md-2\">
                                                                        Indicación/Descripción
                                                                    </div>
                                                                    <div class=\"col-md-4\">
                                                                        <input type=\"text\" class=\"form-control\" id=\"indicacion\" placeholder=\"Indicación/Descripción\"/>
                                                                    </div>
                                                                    <div class=\"col-md-2\">
                                                                        <button class=\"btn btn-info pull-right\" type=\"button\" id=\"agregarDistribucion\"><span class = \"glyphicon glyphicon-plus-sign\" aria-hidden=\"true\"></span></button>
                                                                    </div>
                                                                </div>-->
                                                                <div class=\"col-md-12\" id=\"blockdistribucion\">
                                                                    <div class=\"bs-callout bs-callout-primary\">
                                                                            <h4 class=\"panel-title\">Distribución</h4>
                                                                            <div class=\"container-fluid\">
                                                                                <div class=\"row\">
                                                                                    <div class=\"col-md-12\">
                                                                                        <div class=\"table-responsive\">
                                                                                            <table id=\"blockingresardistribucion\" style=\"margin-bottom: 10px; width:100%;\">
                                                                                                <tbody>
                                                                                                    <tr style=\"background-color: #D9EDF7;\">
                                                                                                        <td style=\"padding: 7px;\"><label>Cantidad</label></td>
                                                                                                        <td style=\"padding: 7px;\"><input type=\"text\" class=\"form-control class-valida\" id=\"cantidadDistribucion\" placeholder=\"Cantidad\"/></td>
                                                                                                        <td style=\"padding: 7px;\"><label>Indicación/Descripción</label></td>
                                                                                                        <td style=\"padding: 7px;\"><input type=\"text\" class=\"form-control\" id=\"indicacion\" placeholder=\"Indicación/Descripción\"/></td>
                                                                                                        <td style=\"padding: 7px;\"><button class=\"btn btn-info pull-right\" type=\"button\" id=\"agregarDistribucion\"><span class = \"glyphicon glyphicon-plus-sign\" aria-hidden=\"true\"></span></button></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class=\"row\">
                                                                                    <div class=\"col-md-12\">
                                                                                        <div class=\"table-responsive\">
                                                                                            <table class=\"table table-striped\" id=\"tabla-distribucion\">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Cantidad</th>
                                                                                                        <th>Indicación/Descripción</th>
                                                                                                        <th></th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div><br/>

                                                            <div class=\"row\" >
                                                                <div class=\"bs-callout bs-callout-primary\">
                                                                    <div class=\"container-fluid\" style=\"background-color: #D9EDF7;\">
                                                                        <div class=\"col-xs-12 col-md-2\" style=\"padding: 7px;\">
                                                                            <input type=\"text\"  class=\"form-control class-calculototal class-valida\" id=\"cantidadMedicamento\" placeholder=\"Cantidad\"/>
                                                                        </div>
                                                                        <div class=\"col-xs-12 col-md-2\" style=\"padding: 7px;\">
                                                                            ";
        // line 1472
        if (array_key_exists("dosificaciones", $context)) {
            // line 1473
            echo "                                                                                <select id=\"iddosificacion\" style=\"with:100%\">
                                                                                    <option value=\"\"></option>
                                                                                    ";
            // line 1475
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["dosificaciones"]) ? $context["dosificaciones"] : $this->getContext($context, "dosificaciones")));
            foreach ($context['_seq'] as $context["_key"] => $context["dosificacion"]) {
                // line 1476
                echo "                                                                                        <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["dosificacion"]) ? $context["dosificacion"] : $this->getContext($context, "dosificacion")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["dosificacion"]) ? $context["dosificacion"] : $this->getContext($context, "dosificacion")), "abreviatura"), "html", null, true);
                echo "</option>
                                                                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dosificacion'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 1478
            echo "                                                                                </select>
                                                                            ";
        }
        // line 1480
        echo "                                                                        </div>
                                                                        <div id=\"idblockperiodo\" class=\"col-xs-12 col-md-8\">
                                                                            <div class=\"row\">
                                                                                <div class=\"col-xs-12 col-md-1\" style=\"padding: 7px;\">
                                                                                    Cada
                                                                                </div>
                                                                                <div class=\"col-xs-12 col-md-2\" style=\"padding: 7px;\">
                                                                                    <input type=\"text\"  class=\"form-control class-calculototal class-valida\" id=\"frecuencia\" placeholder=\"Frecuencia\" />
                                                                                </div>
                                                                                <div class=\"col-xs-12 col-md-4\" style=\"padding: 7px;\">
                                                                                    <select style=\"\" id = \"tiempoFrecuencia\"  class=\"class-calculototal class-valida\"><option value=\"\"></option><option value=\"Hora(s)\">Hora(s)</option><option value=\"Dia(s)\">Dia(s)</option></select>
                                                                                </div>
                                                                                <div class=\"col-xs-12 col-md-2\" style=\"padding: 7px;\">
                                                                                    Durante
                                                                                </div>
                                                                                <div class=\"col-xs-12 col-md-2\" style=\"padding: 7px;\">
                                                                                    <input type=\"text\"  class=\"form-control class-calculototal class-valida\" id=\"durante\" placeholder=\"Durante\"/>
                                                                                </div>
                                                                                <div class=\"col-xs-12 col-md-1\" style=\"padding: 7px;\">
                                                                                    Dias(s)
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <br/>
                                                                    <div class=\"row\">
                                                                        <div class=\"col-md-3\">
                                                                            Total de Medicamento a Dispensar
                                                                        </div>
                                                                        <div class=\"col-md-3\">
                                                                            <input type=\"text\" class=\"form-control class-valida\" id=\"totalMedicamento\" placeholder=\"Total de Medicamento\"/>
                                                                        </div>
                                                                    </div><br/>
                                                                    <div class=\"row\" id = \"divrecomendacion\">
                                                                        <div class=\"col-md-3\">
                                                                            Recomendación
                                                                        </div>
                                                                        <div class=\"col-md-8\">
                                                                            <textarea class=\"form-control\" id=\"recomendacion\" placeholder=\"Recomendacion\"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class=\"row\">
                                            <div class=\"col-md-12\">
                                                <div class=\"panel panel-info\">
                                                    <div class=\"panel-body\">
                                                        <div class=\"container-fluid\">
                                                            <div class=\"row\" style=\"margin-bottom: 10px;\">
                                                                <div  style=\"text-align: left;\" class=\"col-md-1\">
                                                                    <strong>Repetitiva</strong>
                                                                </div>
                                                                <div class=\"col-md-1\">
                                                                    <div class=\"onoffswitch\">
                                                                        <input type=\"checkbox\" value=\"repetitiva\" class=\"onoffswitch-checkbox\" id=\"repetitiva\" name=\"_repetitiva\" noIcheck=\"true\">
                                                                        <label class=\"onoffswitch-label\" for=\"repetitiva\">
                                                                            <span class=\"onoffswitch-inner\" data-switch-on-label=\"SI\" data-switch-off-label=\"NO\"></span>
                                                                            <span class=\"onoffswitch-switch\"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class=\"col-md-10\" id=\"idbloquecantidad\">
                                                                    <div class=\"row\">
                                                                        <div class=\"col-md-2\">
                                                                            Cantidad de Recetas Repetitivas
                                                                        </div>
                                                                        <div class=\"col-md-10\">
                                                                            <input type=\"text\" class=\"form-control\" id=\"cantidadrepetitiva\" placeholder=\"Cantidad\" style=\"size: 10px; max-width: 80px;\"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <button class=\"btn btn-info pull-right\" type=\"button\" id=\"agregarMedicamento\"><span class=\"glyphicon glyphicon-plus-sign\" aria-hidden=\"true\"></span> <b>Guardar Medicamento</b></button>
                                        </div>
                                        <br/>
                                        <br/>
                                    </div>
                                    <div class=\"table-responsive\">
                                        <table class=\"table\">
                                            <thead>
                                                <tr>
                                                    <th>Medicamento</th>
                                                    <th>Cantidad</th>
                                                    <th>Cada</th>
                                                    <th>Durante</th>
                                                    <th>Total Medicamento</th>
                                                    <th>Recomendacion</th>
                                                    <th>Fecha de Entrega de Medicamento</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>
                                                        <span style=\"font-size:20px; float: right; padding: 3px;\" class=\"glyphicon glyphicon-print mouse-pointer\" id=\"imprimir-receta\"  role=\"print\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Impresión Recetas Selecionadas\"></span>
                                                        <span style=\"float: right; padding: 3px;\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Selecionar Recetas Todas/Ninguna\">
                                                            &nbsp;&nbsp;<input type=\"checkbox\" id=\"idTodasLasRecetas\" name=\"idTodasLasRecetas\">
                                                        </span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id=\"bodycontent-receta\">
                                                <tr id=\"emptyTr\"><td colspan=\"7\">No se han agregado medicamentos.....</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    ";
    }

    // line 1603
    public function block_sonata_post_fieldsets($context, array $blocks = array())
    {
        // line 1604
        echo "                    </div>
                ";
    }

    // line 1609
    public function block_formactions($context, array $blocks = array())
    {
        // line 1610
        echo "                    <div class=\"well well-small form-actions\">
                        <button class=\"btn btn-default\" type=\"button\" id=\"btn_cw_close\" name=\"btn_close\">Cerrar</button>

                    </div>
                ";
    }

    public function getTemplateName()
    {
        return "MinsalFarmaciaBundle:FarmRecetas:assign_receta.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  2118 => 1610,  2115 => 1609,  2110 => 1604,  2107 => 1603,  1982 => 1480,  1978 => 1478,  1967 => 1476,  1963 => 1475,  1959 => 1473,  1957 => 1472,  1834 => 1351,  1831 => 1350,  1820 => 1347,  1817 => 1346,  1812 => 1345,  1810 => 1344,  1785 => 1322,  1782 => 1321,  1779 => 1320,  1774 => 1317,  1771 => 1316,  1763 => 1291,  1760 => 1290,  1755 => 1617,  1751 => 1615,  1749 => 1609,  1744 => 1607,  1741 => 1606,  1739 => 1603,  1736 => 1602,  1734 => 1320,  1731 => 1319,  1729 => 1316,  1726 => 1315,  1717 => 1311,  1715 => 1310,  1701 => 1299,  1697 => 1298,  1693 => 1297,  1690 => 1296,  1688 => 1290,  1685 => 1289,  1681 => 1288,  1674 => 1286,  1671 => 1285,  1667 => 1284,  1657 => 1279,  1654 => 1278,  1651 => 1277,  1648 => 1276,  1643 => 1272,  1630 => 1262,  1597 => 1240,  1592 => 1237,  1580 => 1229,  1508 => 1159,  1497 => 1157,  1493 => 1156,  1470 => 1136,  1208 => 877,  1191 => 863,  1156 => 830,  1140 => 816,  1107 => 786,  1091 => 772,  1089 => 771,  684 => 459,  651 => 444,  1229 => 998,  1226 => 997,  1216 => 993,  1214 => 992,  1210 => 990,  1201 => 987,  1197 => 985,  1176 => 974,  1135 => 936,  1068 => 872,  1062 => 833,  1059 => 832,  1043 => 980,  1038 => 978,  1035 => 977,  1028 => 832,  1011 => 823,  1006 => 821,  988 => 816,  985 => 815,  971 => 809,  965 => 807,  938 => 789,  930 => 785,  886 => 757,  1119 => 855,  1116 => 854,  1075 => 869,  1054 => 829,  1050 => 861,  1034 => 856,  1031 => 854,  1025 => 831,  1023 => 828,  1020 => 827,  1017 => 849,  1000 => 687,  987 => 840,  972 => 833,  945 => 816,  943 => 792,  794 => 670,  770 => 661,  759 => 657,  723 => 628,  854 => 585,  850 => 584,  838 => 536,  826 => 569,  755 => 541,  750 => 539,  741 => 533,  704 => 517,  736 => 544,  706 => 519,  702 => 516,  1720 => 1312,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1247,  1609 => 1479,  1594 => 1472,  1590 => 1236,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 841,  1673 => 1259,  1670 => 1258,  1663 => 1282,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1230,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 697,  803 => 630,  606 => 447,  691 => 492,  655 => 481,  484 => 412,  552 => 472,  709 => 520,  397 => 337,  392 => 198,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 995,  1207 => 989,  1199 => 859,  1188 => 857,  1184 => 980,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 866,  1052 => 764,  1045 => 1000,  1042 => 761,  1037 => 857,  992 => 817,  962 => 697,  960 => 826,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 219,  462 => 168,  445 => 339,  419 => 204,  639 => 468,  611 => 386,  538 => 444,  646 => 307,  642 => 492,  544 => 434,  541 => 204,  517 => 427,  797 => 671,  752 => 533,  748 => 458,  681 => 553,  677 => 552,  630 => 437,  618 => 172,  535 => 397,  519 => 425,  416 => 215,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 974,  1030 => 973,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 820,  999 => 518,  995 => 818,  983 => 509,  977 => 507,  974 => 810,  968 => 808,  954 => 800,  948 => 494,  922 => 779,  916 => 480,  913 => 479,  911 => 774,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 535,  824 => 589,  781 => 552,  775 => 550,  762 => 544,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 406,  534 => 348,  530 => 393,  521 => 389,  489 => 179,  483 => 376,  394 => 305,  396 => 306,  345 => 243,  476 => 373,  386 => 197,  364 => 235,  234 => 113,  595 => 326,  589 => 450,  586 => 451,  562 => 505,  556 => 474,  506 => 221,  498 => 417,  492 => 380,  473 => 277,  458 => 121,  399 => 199,  352 => 268,  346 => 187,  328 => 181,  880 => 699,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 489,  573 => 516,  567 => 507,  520 => 394,  481 => 375,  475 => 409,  472 => 408,  466 => 227,  441 => 338,  438 => 337,  432 => 380,  429 => 222,  395 => 400,  382 => 196,  378 => 249,  367 => 193,  357 => 168,  348 => 165,  334 => 160,  286 => 143,  205 => 143,  297 => 169,  218 => 144,  940 => 351,  932 => 786,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 758,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 579,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 667,  784 => 293,  782 => 665,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 534,  740 => 456,  734 => 530,  731 => 392,  728 => 528,  725 => 251,  719 => 257,  716 => 438,  714 => 522,  711 => 540,  705 => 539,  701 => 261,  690 => 302,  687 => 460,  671 => 490,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 470,  609 => 419,  602 => 230,  591 => 453,  571 => 419,  499 => 382,  488 => 273,  389 => 235,  223 => 161,  14 => 4,  306 => 227,  303 => 149,  300 => 148,  292 => 145,  280 => 141,  12 => 36,  624 => 282,  620 => 223,  612 => 467,  601 => 379,  599 => 412,  580 => 265,  574 => 397,  559 => 475,  526 => 429,  497 => 173,  485 => 304,  463 => 196,  447 => 340,  404 => 310,  401 => 185,  391 => 216,  369 => 172,  333 => 234,  329 => 266,  307 => 237,  287 => 236,  195 => 139,  178 => 78,  956 => 271,  953 => 822,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 610,  914 => 775,  912 => 336,  909 => 773,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 587,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 564,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 662,  765 => 246,  760 => 621,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 504,  663 => 484,  660 => 447,  657 => 446,  650 => 483,  647 => 237,  644 => 190,  632 => 438,  629 => 186,  626 => 482,  603 => 229,  600 => 178,  594 => 454,  588 => 372,  584 => 488,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 228,  513 => 386,  479 => 388,  468 => 353,  451 => 287,  448 => 389,  424 => 334,  418 => 344,  410 => 202,  376 => 191,  373 => 257,  340 => 184,  326 => 222,  261 => 146,  118 => 60,  200 => 125,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 984,  1192 => 983,  1190 => 982,  1187 => 981,  1179 => 975,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 899,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 871,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 748,  1056 => 864,  1053 => 292,  1051 => 828,  1048 => 763,  1040 => 858,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 824,  1012 => 271,  1009 => 822,  1004 => 266,  982 => 839,  979 => 812,  976 => 811,  973 => 662,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 802,  955 => 823,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 788,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 766,  897 => 329,  894 => 762,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 537,  833 => 439,  830 => 303,  828 => 682,  825 => 681,  817 => 567,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 557,  793 => 556,  785 => 666,  783 => 177,  772 => 172,  769 => 171,  767 => 660,  764 => 659,  756 => 460,  753 => 540,  751 => 401,  739 => 156,  729 => 233,  724 => 426,  721 => 525,  712 => 521,  710 => 502,  707 => 501,  699 => 142,  697 => 513,  696 => 204,  695 => 466,  694 => 512,  689 => 137,  680 => 457,  675 => 199,  662 => 217,  658 => 500,  654 => 484,  649 => 308,  643 => 306,  640 => 491,  638 => 440,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 434,  550 => 465,  527 => 392,  515 => 191,  512 => 224,  509 => 385,  503 => 427,  496 => 423,  493 => 415,  478 => 374,  467 => 370,  456 => 288,  450 => 212,  414 => 203,  408 => 312,  388 => 292,  371 => 173,  363 => 170,  350 => 245,  342 => 185,  335 => 268,  316 => 232,  290 => 154,  276 => 176,  266 => 204,  263 => 146,  255 => 209,  245 => 116,  207 => 138,  194 => 91,  184 => 148,  76 => 92,  810 => 238,  804 => 662,  801 => 560,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 663,  774 => 249,  771 => 412,  768 => 547,  766 => 546,  761 => 658,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 509,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 443,  627 => 236,  622 => 481,  619 => 212,  616 => 468,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 399,  578 => 448,  572 => 204,  566 => 393,  547 => 435,  545 => 463,  542 => 462,  533 => 237,  531 => 154,  507 => 241,  505 => 214,  502 => 220,  477 => 232,  471 => 164,  465 => 214,  454 => 269,  446 => 388,  443 => 210,  431 => 208,  428 => 189,  425 => 188,  422 => 205,  412 => 152,  406 => 201,  390 => 304,  383 => 193,  377 => 194,  375 => 249,  372 => 200,  370 => 208,  359 => 251,  356 => 277,  353 => 276,  349 => 188,  336 => 272,  332 => 267,  330 => 233,  318 => 233,  313 => 192,  291 => 218,  190 => 90,  321 => 229,  295 => 146,  274 => 152,  242 => 194,  236 => 114,  70 => 28,  170 => 87,  288 => 217,  284 => 56,  279 => 134,  275 => 180,  256 => 171,  250 => 2,  237 => 140,  232 => 159,  222 => 108,  191 => 129,  153 => 70,  150 => 62,  563 => 188,  560 => 435,  558 => 195,  553 => 256,  549 => 438,  543 => 425,  537 => 458,  532 => 396,  528 => 199,  525 => 311,  523 => 441,  518 => 388,  514 => 392,  511 => 243,  508 => 424,  501 => 422,  491 => 288,  487 => 411,  460 => 195,  455 => 344,  449 => 164,  442 => 190,  439 => 226,  436 => 336,  433 => 345,  426 => 180,  420 => 220,  415 => 339,  411 => 313,  405 => 269,  403 => 149,  380 => 260,  366 => 171,  354 => 190,  331 => 182,  325 => 180,  320 => 155,  317 => 178,  311 => 152,  308 => 151,  304 => 207,  272 => 183,  267 => 189,  249 => 143,  216 => 143,  155 => 95,  146 => 54,  126 => 46,  188 => 128,  181 => 109,  161 => 72,  110 => 105,  124 => 45,  692 => 465,  683 => 282,  678 => 279,  676 => 488,  666 => 448,  661 => 488,  656 => 499,  652 => 497,  645 => 442,  641 => 441,  635 => 489,  631 => 475,  625 => 460,  615 => 453,  607 => 363,  597 => 455,  590 => 223,  583 => 435,  579 => 353,  577 => 398,  575 => 212,  569 => 394,  565 => 361,  555 => 257,  548 => 353,  540 => 459,  536 => 405,  529 => 222,  524 => 344,  516 => 387,  510 => 78,  504 => 145,  500 => 386,  495 => 381,  490 => 218,  486 => 377,  482 => 217,  470 => 216,  464 => 242,  459 => 346,  452 => 286,  434 => 279,  421 => 341,  417 => 219,  400 => 267,  385 => 203,  361 => 252,  344 => 238,  339 => 269,  324 => 102,  310 => 165,  302 => 240,  296 => 38,  282 => 178,  259 => 139,  244 => 204,  231 => 123,  226 => 151,  215 => 129,  186 => 126,  152 => 113,  114 => 86,  104 => 52,  358 => 191,  351 => 166,  347 => 275,  343 => 163,  338 => 241,  327 => 265,  323 => 156,  319 => 220,  315 => 177,  301 => 235,  299 => 170,  293 => 205,  289 => 144,  281 => 182,  277 => 140,  271 => 153,  265 => 169,  262 => 170,  260 => 211,  257 => 145,  251 => 181,  248 => 134,  239 => 158,  228 => 2,  225 => 1,  213 => 90,  211 => 140,  197 => 140,  174 => 76,  148 => 56,  134 => 49,  127 => 46,  20 => 1,  270 => 166,  253 => 144,  233 => 155,  212 => 106,  210 => 116,  206 => 152,  202 => 142,  198 => 140,  192 => 138,  185 => 110,  180 => 146,  175 => 103,  172 => 118,  167 => 57,  165 => 73,  160 => 58,  137 => 66,  113 => 64,  100 => 51,  90 => 26,  81 => 27,  65 => 20,  129 => 47,  97 => 39,  77 => 21,  34 => 74,  53 => 32,  84 => 94,  58 => 11,  23 => 4,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 213,  453 => 284,  444 => 185,  440 => 275,  437 => 209,  435 => 231,  430 => 344,  427 => 206,  423 => 256,  413 => 338,  409 => 219,  407 => 201,  402 => 199,  398 => 184,  393 => 265,  387 => 303,  384 => 302,  381 => 236,  379 => 110,  374 => 137,  368 => 255,  365 => 119,  362 => 234,  360 => 169,  355 => 280,  341 => 270,  337 => 183,  322 => 179,  314 => 153,  312 => 176,  309 => 175,  305 => 174,  298 => 147,  294 => 238,  285 => 179,  283 => 142,  278 => 217,  268 => 173,  264 => 188,  258 => 210,  252 => 166,  247 => 1,  241 => 141,  229 => 138,  220 => 107,  214 => 147,  177 => 61,  169 => 60,  140 => 21,  132 => 48,  128 => 114,  107 => 69,  61 => 12,  273 => 185,  269 => 214,  254 => 199,  243 => 140,  240 => 176,  238 => 192,  235 => 153,  230 => 111,  227 => 101,  224 => 151,  221 => 119,  219 => 174,  217 => 118,  208 => 132,  204 => 142,  179 => 134,  159 => 77,  143 => 120,  135 => 49,  119 => 43,  102 => 45,  71 => 15,  67 => 88,  63 => 15,  59 => 34,  28 => 3,  94 => 9,  89 => 46,  85 => 25,  75 => 17,  68 => 21,  56 => 33,  87 => 64,  201 => 134,  196 => 131,  183 => 135,  171 => 100,  166 => 131,  163 => 83,  158 => 93,  156 => 57,  151 => 55,  142 => 52,  138 => 50,  136 => 70,  121 => 18,  117 => 42,  105 => 32,  91 => 65,  62 => 87,  49 => 18,  25 => 69,  21 => 3,  31 => 33,  38 => 16,  26 => 2,  24 => 13,  19 => 1,  93 => 52,  88 => 48,  78 => 18,  46 => 18,  44 => 5,  27 => 70,  79 => 62,  72 => 91,  69 => 37,  47 => 6,  40 => 12,  37 => 7,  22 => 68,  246 => 205,  157 => 71,  145 => 68,  139 => 118,  131 => 115,  123 => 112,  120 => 63,  115 => 108,  111 => 63,  108 => 39,  101 => 34,  98 => 36,  96 => 29,  83 => 63,  74 => 23,  66 => 13,  55 => 10,  52 => 21,  50 => 11,  43 => 10,  41 => 4,  35 => 34,  32 => 15,  29 => 7,  209 => 145,  203 => 130,  199 => 92,  193 => 130,  189 => 127,  187 => 149,  182 => 117,  176 => 83,  173 => 133,  168 => 99,  164 => 99,  162 => 130,  154 => 124,  149 => 69,  147 => 54,  144 => 61,  141 => 67,  133 => 116,  130 => 56,  125 => 113,  122 => 61,  116 => 62,  112 => 40,  109 => 54,  106 => 42,  103 => 68,  99 => 30,  95 => 102,  92 => 49,  86 => 95,  82 => 24,  80 => 93,  73 => 27,  64 => 23,  60 => 19,  57 => 39,  54 => 16,  51 => 78,  48 => 77,  45 => 76,  42 => 5,  39 => 4,  36 => 2,  33 => 15,  30 => 72,);
    }
}
