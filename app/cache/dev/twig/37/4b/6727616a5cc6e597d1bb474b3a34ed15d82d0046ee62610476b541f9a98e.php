<?php

/* MinsalCitasBundle:Custom:agenda_dia.html.twig */
class __TwigTemplate_374b6727616a5cc6e597d1bb474b3a34ed15d82d0046ee62610476b541f9a98e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 5
        echo "<script type=\"text/javascript\">
/*OBTIENE EL MPEDICO YA SEA QUE SE HAYA LOGUEADO EN EL SISTEMA
* O SI ES ADMINISTRADR EL QUE HAYA SELECCIONADO
* EN LA LISTA DESPLEGABLE*/
    function getMedicData() {
        var idEmpleado = \"\";
        var nombreEmpleado = \"\";
        var idEmpleadoEspecialidadEstab = \"\";

        ";
        // line 14
        if ((array_key_exists("availableEmpleadoEspecialidadList", $context) && ((isset($context["availableEmpleadoEspecialidadList"]) ? $context["availableEmpleadoEspecialidadList"] : $this->getContext($context, "availableEmpleadoEspecialidadList")) == true))) {
            // line 15
            echo "            if(\$('#idEmpleado').select2('data') != null) {
                idEmpleado     = \$('#idEmpleado').select2('data').id;
                nombreEmpleado = \$('#idEmpleado').select2('data').text;
            }

            if(\$('#idEmpleadoEspecialidadEstab').select2('data') != null) {
                idEmpleadoEspecialidadEstab = \$('#idEmpleadoEspecialidadEstab').select2('data').id;
            }
        ";
        } else {
            // line 24
            echo "            ";
            if (((isset($context["codigoEmpleado"]) ? $context["codigoEmpleado"] : $this->getContext($context, "codigoEmpleado")) === "MED")) {
                // line 25
                echo "                idEmpleado     = '";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getId"), "html", null, true);
                echo "';
                nombreEmpleado = '";
                // line 26
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getNombreempleado"), "html", null, true);
                echo "';
                idEmpleadoEspecialidadEstab = '";
                // line 27
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idEmpEspecialidadEstab"), "method"), "html", null, true);
                echo "';
            ";
            } elseif (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
                // line 29
                echo "                idEmpleado     = '";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntEmpleado"), "getId", array(), "method"), "html", null, true);
                echo "';
                nombreEmpleado = '";
                // line 30
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntEmpleado"), "getNombreempleado", array(), "method"), "html", null, true);
                echo "';
                idEmpleadoEspecialidadEstab = '";
                // line 31
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntAtenAreaModEstab"), "getId", array(), "method"), "html", null, true);
                echo "';
            ";
            } else {
                // line 33
                echo "                if(\$('#idEmpleado').select2('data') != null) {
                    idEmpleado     = \$('#idEmpleado').select2('data').id;
                    nombreEmpleado = \$('#idEmpleado').select2('data').text;
                }

                if(\$('#idEmpleadoEspecialidadEstab').select2('data') != null) {
                    idEmpleadoEspecialidadEstab = \$('#idEmpleadoEspecialidadEstab').select2('data').id;
                }
            ";
            }
            // line 42
            echo "        ";
        }
        // line 43
        echo "
        return {'idEmpleado': idEmpleado, 'nombreEmpleado': nombreEmpleado, 'idEmpleadoEspecialidadEstab': idEmpleadoEspecialidadEstab};
    }


    /**************************************************************************
    * FUNCION QUE GENERA LA AGENDA MEDICA, CON LOS PACIENTES DE PRIMERA VEZ, *
    * SUBSECUENTES O AGREGADOS SEGÚN SEA EL CASO.                            *
    * PARAMETERS: Contiene la url para obtener los pacientes y la fecha a    *
    * efectuar la evaluación
    *************************************************************************/
    function buildDetailAgendaMedica(parameters) {
        var content         = \"\";
        var detalle         = [];
        var primera_vez     = \"\";
        var subsecuentes    = \"\";
        var agregados       = \"\";
        var medicData       = getMedicData();
        var count           = 0;
        var max_agregados   = 0;
        var act_agregados   = 0;
        var bloqueLleno     = '';
        var warningMessage  = '';
        var clearWarningMsg = false;
        var expTemporalMsg  = \"No se puede dar seguimiento al paciente, hasta que actualicen sus datos de expediente en el área de documentos médicos.\";

        ";
        // line 69
        if ((array_key_exists("availableCitaCreate", $context) && ((isset($context["availableCitaCreate"]) ? $context["availableCitaCreate"] : $this->getContext($context, "availableCitaCreate")) == true))) {
            // line 70
            echo "            /*
             *  Verificando si se sobrepaso el limite de sobrecupo para el dia actual
             */
            if( '";
            // line 73
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method"), "html", null, true);
            echo "' === 'admin_minsal_citas_citcitasdia_list' ) {
                \$.ajax({
                    url:  Routing.generate(\"citascomprobardisponibilidad\"),
                    async: false,
                    dataType: 'JSON',
                    data: {
                        idEmpleado:   medicData.idEmpleado,
                        especialidad: medicData.idEmpleadoEspecialidadEstab,
                        date:         clickDay,
                        idRangohora:  parameters['field'].select2('val'),
                        idTipoCita:   parameters['idTipoCita'].select2('val')
                    },
                    success: function(data) {
                        max_agregados = data.data1.max_citas_agregadas;
                        act_agregados = data.data2;
                        bloqueLleno   = data.data3;

                    }
                });

                if(bloqueLleno === 'true') {
                    warningMessage =
                        '<div class=\"alert alert-warning\" role=\"alert\">'+
                            '<i class=\"fa fa-warning\"></i> <h4><strong>Advertencia</strong></h4>'+
                            '<ul>'
                    ;

                    if(act_agregados >= max_agregados) {
                        var now        = moment();
                        var clickedDay = moment(clickDay);

                        if( now.format('YYYY-MM-DD') === clickedDay.format('YYYY-MM-DD') ) {
                            warningMessage +=
                                    '<li>El límite de cupos para <strong>Para pacientes Agregados del Médico ha sido alcanzado</strong>. Si desea agendar el '+
                                    'paciente y el <strong>cupo de Pacientes de Primera vez o Subsecuentes</strong> se encuentra lleno la cita será asignada '+
                                    'dentro del bloque de pacientes agregados sobrepasando el límite asignado.<br />'+
                                    'Si desea continuar con la creación de la cita haga click en botón <strong>\"Crear Cita\"</strong>, de lo contrario '+
                                    'seleccione otro horario u otra fecha para crear la cita.</li>'
                            ;
                        } else {
                            clearWarningMsg = true;
                        }
                    } else {
                        var nombreTipoCita = parseInt( parameters['idTipoCita'].select2('val') ) === 1 ? 'de Primera Vez' : 'Subsecuentes';
                        warningMessage += '<li>El límite de cupos para <strong>Pacientes '+nombreTipoCita+' ya ha sido alcanzado</strong>, la cita que se cree a partir de este momento será sobrecupo (Agregados).</li>';
                    }

                    warningMessage += '</ul></div>';

                    if(clearWarningMsg) {
                        warningMessage = '';
                    }
                }
            }
        ";
        }
        // line 128
        echo "        jQuery.ajax({
            url: parameters['url'],
            async: false,
            dataType: 'json',
            success: function(data) {
                detalle['primera_vez'] = data.data1;
                detalle['subsecuentes'] = data.data2;
                detalle['agregados'] = data.data3;
            }
        });

        if (detalle['primera_vez'].length == 0) {
            primera_vez = '<tr><td colspan=\"";
        // line 140
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") == "admin_minsal_citas_citcitasdia_agenda_dia")) {
            echo "5";
        } else {
            echo "6";
        }
        echo "\"><span class=\"disabled-label\">No hay resultados para mostrar...</span></td></tr>';
        } else {
            jQuery.each(detalle['primera_vez'], function(key, value) {
                count += 1;
                primera_vez = primera_vez + '\\
                    <tr>'+
                        '<td>' + count + '</td>'+
                        ";
        // line 147
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") == "admin_minsal_citas_citcitasdia_agenda_dia")) {
            // line 148
            echo "                            '<td><a ' + ( value.numeroTemporal ? ('onClick=\"showDialogMsg(\\'Expediente Temporal\\',\\'' + expTemporalMsg + '\\',\\'dialog-error\\');\" href=\"#\"') : 'href=\"";
            echo $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_create");
            echo "?id_expediente='+value.idExpediente+'&id_empleado='+medicData.idEmpleado+'&id_aten_area_mod_estab='+medicData.idEmpleadoEspecialidadEstab+'&id_cita='+value.idCita+'\"' ) + '>' + value.codExpediente + '</a></td>'+
                        ";
        } else {
            // line 150
            echo "                            '<td>' + value.codExpediente + '</td>'+
                        ";
        }
        // line 152
        echo "                        '<td>' + value.numeroDocumentoIdentidadPaciente+ '</td>'+
                        '<td>' + value.nombrePaciente+ '</td>'+
                        '<td>' + value.nombreEstado+ '</td>'+
                        ";
        // line 155
        if (((!($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") === "admin_minsal_citas_citcitasdia_agenda_dia")) && (!($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") === "consulta_recibida")))) {
            // line 156
            echo "                            '<td><a href=\"";
            echo $this->env->getExtension('routing')->getUrl("citasgetcomprobante");
            echo "?id='+value.idCita+'\" target=\"_blank\" class=\"btn btn-info\"><span class=\"fa fa-print\"> Imprimir</span></a></td>' +
                        ";
        }
        // line 158
        echo "                    '</tr>';
            });
        }

        if (detalle['subsecuentes'].length == 0) {
            subsecuentes = '<tr><td colspan=\"";
        // line 163
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") == "admin_minsal_citas_citcitasdia_agenda_dia")) {
            echo "5";
        } else {
            echo "6";
        }
        echo "\"><span class=\"disabled-label\">No hay resultados para mostrar...</span></td></tr>';
        } else {
            count = 0;
            jQuery.each(detalle['subsecuentes'], function(key, value) {
                count += 1;
                subsecuentes = subsecuentes + '\\
                    <tr>'+
                        '<td>' + count + '</td>'+
                        ";
        // line 171
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") == "admin_minsal_citas_citcitasdia_agenda_dia")) {
            // line 172
            echo "                            '<td><a ' + ( value.numeroTemporal ? ('onClick=\"showDialogMsg(\\'Expediente Temporal\\',\\'' + expTemporalMsg + '\\',\\'dialog-error\\');\" href=\"#\"') : 'href=\"";
            echo $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_create");
            echo "?id_expediente='+value.idExpediente+'&id_empleado='+medicData.idEmpleado+'&id_aten_area_mod_estab='+medicData.idEmpleadoEspecialidadEstab+'&id_cita='+value.idCita+'\"' ) + '>' + value.codExpediente + '</a></td>'+
                        ";
        } else {
            // line 174
            echo "                            '<td>' + value.codExpediente + '</td>'+
                        ";
        }
        // line 176
        echo "                        '<td>' + value.numeroDocumentoIdentidadPaciente+ '</td>'+
                        '<td>' + value.nombrePaciente+ '</td>'+
                        '<td>' + value.nombreEstado+ '</td>'+
                        ";
        // line 179
        if (((!($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") === "admin_minsal_citas_citcitasdia_agenda_dia")) && (!($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") === "consulta_recibida")))) {
            // line 180
            echo "                            '<td><a href=\"";
            echo $this->env->getExtension('routing')->getUrl("citasgetcomprobante");
            echo "?id='+value.idCita+'\" target=\"_blank\" class=\"btn btn-info\"><span class=\"fa fa-print\"> Imprimir</span></a></td>' +
                        ";
        }
        // line 182
        echo "                    '</tr>';
            });
        }

        if (detalle['agregados'].length == 0) {
            agregados = '<tr><td colspan=\"";
        // line 187
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") == "admin_minsal_citas_citcitasdia_agenda_dia")) {
            echo "5";
        } else {
            echo "6";
        }
        echo "\"><span class=\"disabled-label\">No hay resultados para mostrar...</span></td></tr>';
        } else {
            ";
        // line 189
        if ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") == "admin_minsal_citas_citcitasdia_agenda_dia") || ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") == "consulta_recibida"))) {
            // line 190
            echo "                ";
            $context["citCitasDia"] = true;
        } else {
            $context["citCitasDia"] = false;
            // line 191
            echo "            ";
        }
        // line 192
        echo "            count = 0;
            jQuery.each(detalle['agregados'], function(key, value) {
                count += 1;
                agregados = agregados + '\\
                    <tr>'+
                        '<td>' + count + '</td>'+
                        ";
        // line 198
        if ((isset($context["citCitasDia"]) ? $context["citCitasDia"] : $this->getContext($context, "citCitasDia"))) {
            // line 199
            echo "                            '<td><a ' + ( value.numeroTemporal ? ('onClick=\"showDialogMsg(\\'Expediente Temporal\\',\\'' + expTemporalMsg + '\\',\\'dialog-error\\');\" href=\"#\"') : 'href=\"";
            echo $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_create");
            echo "?id_expediente='+value.idExpediente+'&id_empleado='+medicData.idEmpleado+'&id_aten_area_mod_estab='+medicData.idEmpleadoEspecialidadEstab+'&id_cita='+value.idCita+'\"' ) + '>' + value.codExpediente + '</a></td>'+
                        ";
        } else {
            // line 201
            echo "                            '<td>' + value.codExpediente + '</td>'+
                        ";
        }
        // line 203
        echo "                        '<td>' + value.numeroDocumentoIdentidadPaciente+ '</td>'+
                        '<td>' + value.nombrePaciente+ '</td>'+
                        '<td>' + value.nombreTipoCita+' - '+(value.idEstado === 6 ? 'Programada' : value.nombreEstado)+ '</td>'+
                        ";
        // line 206
        if (((isset($context["citCitasDia"]) ? $context["citCitasDia"] : $this->getContext($context, "citCitasDia")) === false)) {
            // line 207
            echo "                            '<td><a href=\"";
            echo $this->env->getExtension('routing')->getUrl("citasgetcomprobante");
            echo "?id='+value.idCita+'\" target=\"_blank\" class=\"btn btn-info\"><span class=\"fa fa-print\"> Imprimir</span></a></td>' +
                        ";
        }
        // line 209
        echo "                    '</tr>';;
            });
        }

        content = '<div class=\"panel panel-primary\">\\
                        <div class=\"panel-heading\">Pacientes primera vez</div>\\
                        <div class=\"panel-body\" id=\"pb-primervez\">\\
                            <div class=\"table-responsive\">\\
                                <table class=\"table table-striped table-hover table-condensed\">\\
                                    <thead>\\
                                        <tr><th>No.</th><th>Expediente</th><th>DUI</th><th>Nombre del paciente</th><th>Estado de la cita</th>";
        // line 219
        if (((isset($context["citCitasDia"]) ? $context["citCitasDia"] : $this->getContext($context, "citCitasDia")) === false)) {
            echo "<th>Comprobante</th>";
        }
        echo "</tr>\\
                                    </thead>\\
                                    <tbody>\\
                                        ' + primera_vez + '\\
                                    </tbody>\\
                                </table>\\
                            </div>\\
                        </div>\\
                    </div>\\
                    <div class=\"panel panel-success\">\\
                        <div class=\"panel-heading\">Pacientes subsecuentes</div>\\
                        <div class=\"panel-body\" id=\"pb-subsecuentes\">\\
                            <div class=\"table-responsive\">\\
                                <table class=\"table table-striped table-hover table-condensed\">\\
                                    <thead>\\
                                        <tr><th>No.</th><th>Expediente</th><th>DUI</th><th>Nombre del paciente</th><th>Estado de la cita</th>";
        // line 234
        if (((isset($context["citCitasDia"]) ? $context["citCitasDia"] : $this->getContext($context, "citCitasDia")) === false)) {
            echo "<th>Comprobante</th>";
        }
        echo "</tr>\\
                                    </thead>\\
                                    <tbody>\\
                                        ' + subsecuentes + '\\
                                    </tbody>\\
                                </table>\\
                            </div>\\
                        </div>\\
                    </div>\\
                    <div class=\"panel panel-info\">\\
                        <div class=\"panel-heading\">Pacientes agregados</div>\\
                        <div class=\"panel-body\" id=\"pb-agregados\">\\
                            <div class=\"table-responsive\">\\
                                <table class=\"table table-striped table-hover table-condensed\">\\
                                    <thead>\\
                                        <tr><th>No.</th><th>Expediente</th><th>DUI</th><th>Nombre del paciente</th><th>Estado de la cita</th>";
        // line 249
        if (((isset($context["citCitasDia"]) ? $context["citCitasDia"] : $this->getContext($context, "citCitasDia")) === false)) {
            echo "<th>Comprobante</th>";
        }
        echo "</tr>\\
                                    </thead>\\
                                    <tbody>\\
                                        ' + agregados + '\\
                                    </tbody>\\
                                </table>\\
                            </div>\\
                        </div>\\
                    </div>';

        return { warningMessage: warningMessage, content: content };
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:Custom:agenda_dia.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  372 => 234,  352 => 219,  340 => 209,  334 => 207,  332 => 206,  327 => 203,  323 => 201,  317 => 199,  315 => 198,  307 => 192,  304 => 191,  299 => 190,  297 => 189,  288 => 187,  281 => 182,  275 => 180,  273 => 179,  268 => 176,  264 => 174,  258 => 172,  256 => 171,  241 => 163,  234 => 158,  228 => 156,  226 => 155,  221 => 152,  217 => 150,  209 => 147,  195 => 140,  181 => 128,  123 => 73,  118 => 70,  116 => 69,  88 => 43,  74 => 33,  69 => 31,  65 => 30,  60 => 29,  55 => 27,  51 => 26,  46 => 25,  43 => 24,  32 => 15,  30 => 14,  19 => 5,  59 => 26,  56 => 25,  48 => 21,  45 => 20,  42 => 19,  36 => 16,  28 => 14,  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1275,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1569 => 1261,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1254,  1549 => 1253,  1541 => 1250,  1532 => 1247,  1527 => 1246,  1522 => 1245,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1316 => 1071,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1291 => 1062,  1289 => 1061,  1286 => 1060,  1283 => 1059,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1271 => 1055,  1268 => 1054,  1266 => 1053,  1217 => 1011,  1190 => 991,  1186 => 989,  1184 => 988,  892 => 703,  889 => 702,  883 => 700,  880 => 699,  874 => 697,  872 => 696,  803 => 630,  711 => 540,  705 => 539,  606 => 447,  577 => 420,  571 => 419,  487 => 337,  481 => 335,  479 => 334,  430 => 287,  392 => 249,  387 => 249,  382 => 248,  380 => 247,  377 => 246,  364 => 235,  362 => 234,  266 => 140,  261 => 138,  257 => 137,  252 => 136,  250 => 135,  246 => 134,  240 => 130,  237 => 129,  233 => 127,  224 => 124,  222 => 123,  211 => 148,  203 => 119,  201 => 118,  189 => 116,  178 => 108,  166 => 98,  164 => 97,  117 => 52,  111 => 48,  109 => 47,  87 => 27,  85 => 42,  80 => 25,  77 => 24,  71 => 21,  66 => 20,  63 => 19,  58 => 16,  50 => 12,  47 => 11,  44 => 10,  39 => 8,  37 => 7,  35 => 6,  33 => 5,  31 => 15,);
    }
}
