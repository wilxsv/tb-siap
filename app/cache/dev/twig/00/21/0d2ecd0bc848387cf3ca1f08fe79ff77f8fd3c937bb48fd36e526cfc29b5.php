<?php

/* MinsalSeguimientoBundle:SecHistorialClinico:listadoPacientesSumeve.html.twig */
class __TwigTemplate_00210d2ecd0bc848387cf3ca1f08fe79ff77f8fd3c937bb48fd36e526cfc29b5 extends Twig_Template
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
        // line 1
        echo "<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">

        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\"href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/bootstrap3/css/bootstrap.min.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/vendor/bootstrap/dist/css/bootstrap.min.css"), "html", null, true);
        echo "\"  />
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/siaps.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/corelayout.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/vendor/jqueryui/themes/base/jquery-ui.css"), "html", null, true);
        echo "\">
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/jquery.jqGrid-4.5.2/css/ui.jqgrid.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/jqGrid.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/vendor/AdminLTE/css/font-awesome.min.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/vendor/AdminLTE/css/ionicons.min.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/vendor/AdminLTE/css/AdminLTE.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css"), "html", null, true);
        echo "\" />

        <script type=\"text/javascript\" src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonataadmin/vendor/jquery/dist/jquery.min.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/funciones_generales.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/applicationcore/css/bootstrap3/js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/jquery-1.10.2.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/jquery-ui-1.10.4.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sonatajquery/jquery-ui-i18n.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/jquery.jqGrid-4.5.2/js/i18n/grid.locale-es.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/jquery.jqGrid-4.5.2/js/jquery.jqGrid.min.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/fosjsrouting/js/router.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl(($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "getBaseUrl", array(), "method") . "/js/routing?callback=fos.Router.setData")), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\">
            jQuery(document).ready(function(\$) {
                var msj = '<div class=\"alert alert-warning\" role=\"alert\">' +
                            '<h4><strong>Error de Conexión.</strong></h4>';

                ";
        // line 33
        if (((isset($context["codeEnvironment"]) ? $context["codeEnvironment"] : $this->getContext($context, "codeEnvironment")) === "dev")) {
            // line 34
            echo "                    \$.ajaxSetup({
                        error: function (jqXHR, exception) {
                            msj += 'Lo sentimos, hubo un problema de conexión en la búsqueda del paciente, por favor intente nuevamente, si el problema persiste contacte con el administrador.';
                            msj += '<br /><br />' +
                                    '<strong>Error al ejecutar el ajax</strong><br />' +
                                    'Detalle del Error: ';

                            if (jqXHR.status === 0) {
                                msj += 'No es posible establecer conexión, verificar Red.';
                            } else if (jqXHR.status == 404) {
                                msj += 'La página solicitada no ha sido encontrada. Error [404]';
                            } else if (jqXHR.status == 500) {
                                msj += 'Error interno del servidor: Error [500].';
                            } else if (exception === 'parsererror') {
                                msj += 'Fallo en la conversión del JSON.';
                            } else if (exception === 'timeout') {
                                msj += 'Tiempo de solicitud agotado.';
                            } else if (exception === 'abort') {
                                msj += 'Solicitud de Ajax abortada.';
                            } else {
                                msj += 'Error desconocido ' + jqXHR.responseText;
                            }

                            msj += '</div>';

                            \$('#messages').empty();
                            \$('#messages').append(msj);
                        }
                    });
                ";
        }
        // line 64
        echo "
                \$.ajax({
                    url: Routing.generate(\"get_listado_pacientes_sumeve\") + '/";
        // line 66
        echo twig_escape_filter($this->env, (isset($context["idPaciente"]) ? $context["idPaciente"] : $this->getContext($context, "idPaciente")), "html", null, true);
        echo "',
                    async: true,
                    dataType: 'json'
                }).done(function(object) {
                    if(object.status) {
                        if(object.data === '[]') {
                            msj = '<div class=\"alert alert-info\" role=\"alert\">' +
                                        '<h3><strong>No se han encontrado coincidencias.</strong></h3>' +
                                        '<span style=\"font-size: 18px;\">No se han encontrado concidencias del paciente en el sistema <strong>SUMEVE</strong>, por lo cu&aacute;l &eacute;ste ser&aacute; registrado como un <strong>PACIENTE NUEVO en el sistema SUMEVE.</strong></span>' +
                                        '<button id=\"new-registry\" type=\"button\" class=\"btn btn-info\" style=\"margin-left: 25px;\"><span class=\"fa fa-plus-circle\"></span> Aceptar</button>' +
                                    '</div>';

                            \$('#messages').empty();
                            \$('#messages').append(msj);

                            \$('#btn-close').attr('disabled', 'disabled');

                            \$('body #new-registry').on('click', function() {
                                window.opener.habilitarGuardar();
                                window.close();
                            });
                        } else {
                                \$(' #fd_action_buttons').prepend('<button id=\"new-registry\" type=\"button\" class=\"btn btn-info\" style=\"margin-left: 25px;\"><span class=\"fa fa-plus-circle\"></span> Paciente Nuevo</button>');

                            msj = '<div class=\"alert alert-info\" role=\"alert\">' +
                                        '<h3><span class=\"fa fa-exclamation-circle\"></span> <strong>Se han encontrado posibles coincidencias.</strong></h3>' +
                                        '<span style=\"font-size: 18px;\"><strong>Indicaciones: </strong></span>' +
                                        '<ol style=\"font-size: 16px;\">' +
                                            '<li>Realice una <strong>busqueda</strong> del paciente en la Lista de Posibles Coincidencias de pacientes que se muestra abajo.</li>' +
                                            '<li><strong>Determine</strong>, segun su <strong>criterio</strong>, si alguna de las coincidencias corresponde al paciente que esta <strong>atendiendo</strong>.</li>' +
                                            '<li>Si el paciente se encuentra en la Lista de Posibles Coincidencias y su Estado <strong>NO</strong> es Diagnosticado, haga click sobre el bot&oacute;n <strong>Seleccionar</strong>.</li>' +
                                            '<li>Si el paciente se encuentra en la Lista de Posibles Coincidencias y su Estado <strong>SI</strong> es Diagnosticado, haga click sobre el bot&oacute;n <strong>Cerrar</strong> y posteriormente <strong>Cancele</strong> el Formulario para Solicitud y Confirmación de VIH (FVIH01).</li>' +
                                            '<li>Si usted determina que el paciente que esta atendiendo, <strong>NO se encuentra</strong> en la Lista de Posibles Coincidencias, haga click sobre el bot&oacute;n <strong>Paciente Nuevo</strong>.</li>' +
                                        '</ol>' +
                                    '</div>';

                            \$('#messages').empty();
                            \$('#messages').append(msj);

                            \$(\"#tPacientes\").jqGrid({
                                datatype: \"local\",
                                height: 300,
                                //colNames: ['id', 'Nombres', 'Apellidos', 'Departamento', 'Municipio', 'Fecha_Nac', 'Dui', 'Sexo', 'Estado', 'Peso', ''],
                                colNames: ['id', 'Nombres', 'Apellidos', 'Departamento', 'Municipio', 'Fecha_Nac', 'Dui', 'Sexo', 'Estado', ''],
                                colModel: [
                                    {name: 'idp', index: 'idp', width: 60, sorttype: \"int\"},
                                    {name: 'nombres', index: 'name', width: 200},
                                    {name: 'apellidos', index: 'name', width: 200},
                                    {name: 'departamento', index: 'name', width: 100},
                                    {name: 'municipio', index: 'name', width: 100},
                                    {name: 'fecha_nac', index: 'name', width: 100},
                                    {name: 'dui', index: 'name', width: 100},
                                    {name: 'sexo', index: 'name', width: 100},
                                    {name: 'estado_pac', index: 'name', width: 140},
                                    //{name: 'total', index: 'name', width: 70},
                                    {name: 'edit', index: 'edit', align: 'center', sortable: false, width: 120}

                                ],
                                caption: \"Lista de Posibles Coincidencias en SUMEVE\",
                                data: jQuery.parseJSON(object.data),
                                        afterInsertRow: function (id, currentData, jsondata) {
                                            if (jsondata.estado_pac != 'DIAGNOSTICADO')
                                            {
                                                var button = \"<a  data-id='\" + jsondata.idp + \"' href='#' class='btn btn-success'><span class='fa fa-list'></span>Seleccionar</a>\";
                                                \$(this).setCell(id, \"edit\", button);
                                            }
                                        },
                                loadComplete: function (data) {
                                    \$('#gbox_tPacientes').attr('style', 'margin-bottom: 30px;')

                                    \$(\".btn-success\").on('click', function (e) {
                                        e.preventDefault();
                                        window.opener.seleccionarIdp(\$(this).data(\"id\"));
                                        window.close();
                                    });
                                    \$(\"#new-registry\").on('click', function (e) {
                                        e.preventDefault();
                                        window.opener.habilitarGuardar();
                                        window.close();
                                    });
                                }
                            });
                        }
                    } else {
                        msj += 'Lo sentimos, hubo un problema de conexión en la búsqueda del paciente.';

                        ";
        // line 152
        if (((isset($context["codeEnvironment"]) ? $context["codeEnvironment"] : $this->getContext($context, "codeEnvironment")) === "dev")) {
            // line 153
            echo "                            msj += '<br /><br />' +
                                'C&oacute;digo del Error: ' + object.errorCode + '<br />' +
                                'Detalle del Error: ' + object.errorMessage;
                        ";
        }
        // line 157
        echo "
                        msj += '</div>';

                        msj += '<div class=\"alert alert-info\" role=\"alert\">' +
                                    '<h3><span class=\"fa fa-exclamation-circle\"></span> <strong>Seleccione una Opci&oacute;n.</strong></h3>' +
                                    '<span style=\"font-size: 18px;\"><strong>Indicaciones: </strong></span>' +
                                    'Debido a que no se pudo establecer conexi&oacute;n, usted dispone de las siguientes opciones:' +
                                    '<ol style=\"font-size: 16px;\">' +
                                        '<li><strong>Reintentar: </strong>Seleccione esta opci&oacute;n para realizar la busqueda del paciente nuevamente.</li>' +
                                        '<li><strong>Continuar: </strong>Seleccione esta opci&oacute;n para continuar <strong>sin la busqueda del paciente</strong>. Esto implica que la Solicitud ser&aacute; <strong>guardada de forma local</strong>, sin embargo, ' +
                                            'el env&iacute;o autom&aacute;tico de la <strong>Solicitud FVIH01 al Sistema SUMEVE no ser&aacute; posible</strong>. Este paso debera realizarse posteriormente y completarse <strong>manualmente</strong>.</li>' +
                                    '</ol>' +
                                    '<button id=\"btn-reload\" type=\"button\" class=\"btn btn-info\" style=\"margin-left: 25px;\" onClick=\"window.location.reload();\"><span class=\"fa fa-refresh\"></span> Reintentar</button>' +
                                    '<button id=\"new-registry\" type=\"button\" class=\"btn btn-primary\" style=\"margin-left: 25px;\"><span class=\"fa fa-arrow-circle-right\"></span> Continuar</button>' +
                                '</div>';

                        \$('#messages').empty();
                        \$('#messages').append(msj);

                        \$('body #new-registry').on('click', function() {
                            window.opener.habilitarGuardar();
                            window.close();
                        });
                    }
                }).always(function() {
                    \$('#content-wrapper').removeClass('hidden');
                    \$('#loader-wrapper').addClass('hidden');
                    window.opener.setVerificarSumeve('false');
                });

            });
        </script>
        <title>
            MINSAL::SIAPS
        </title>
    </head>
    <body>
        <div id=\"content-wrapper\" class=\"hidden\" style=\"width:95%; margin: auto; padding: 35px;\">
            <div id=\"messages\"></div>
            <label id=\"lregistro\"></label>
            <table id=\"tPacientes\"></table>
            <div id=\"pagerpacientes\"></div>
            <div class=\"well well-small\" id=\"fd_action_buttons\">
                <button id=\"btn-close\" type=\"button\" class=\"btn btn-default\" onclick=\"window.close();\"><i class=\"fa fa-fw fa-times-circle\"></i> Cerrar</button>
            </div>
        </div>
        <div id=\"loader-wrapper\">
            <div id=\"loader\">
                <div id=\"loader-img\"></div>
                <div id=\"loader-msj\" style=\"font-size: larger;\">Buscando coincidencias del paciente<br />en el Sistema SUMEVE.<br /><strong>Por favor espere ...</strong></div>
            </div>
        </div>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecHistorialClinico:listadoPacientesSumeve.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  691 => 492,  655 => 481,  484 => 412,  552 => 439,  709 => 255,  397 => 168,  392 => 165,  1577 => 1107,  1574 => 1106,  1569 => 1111,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 921,  1289 => 896,  1286 => 895,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 856,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 767,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 759,  992 => 720,  962 => 697,  960 => 696,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 279,  419 => 293,  639 => 468,  611 => 386,  538 => 431,  646 => 307,  642 => 286,  544 => 434,  541 => 204,  517 => 192,  797 => 489,  752 => 533,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 430,  519 => 425,  416 => 221,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 416,  775 => 413,  762 => 540,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 203,  534 => 348,  530 => 428,  521 => 194,  489 => 179,  483 => 206,  394 => 217,  396 => 206,  345 => 189,  476 => 174,  386 => 162,  364 => 114,  234 => 78,  595 => 326,  589 => 267,  586 => 436,  562 => 505,  556 => 274,  506 => 103,  498 => 417,  492 => 274,  473 => 277,  458 => 121,  399 => 209,  352 => 279,  346 => 125,  328 => 179,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 244,  573 => 516,  567 => 507,  520 => 247,  481 => 123,  475 => 275,  472 => 172,  466 => 227,  441 => 346,  438 => 189,  432 => 230,  429 => 222,  395 => 400,  382 => 231,  378 => 211,  367 => 115,  357 => 222,  348 => 190,  334 => 110,  286 => 169,  205 => 106,  297 => 113,  218 => 147,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 561,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 302,  687 => 301,  671 => 262,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 281,  609 => 273,  602 => 230,  591 => 439,  571 => 262,  499 => 268,  488 => 273,  389 => 235,  223 => 143,  14 => 2,  306 => 117,  303 => 159,  300 => 98,  292 => 95,  280 => 108,  12 => 36,  624 => 282,  620 => 223,  612 => 232,  601 => 379,  599 => 441,  580 => 265,  574 => 263,  559 => 504,  526 => 427,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 172,  401 => 119,  391 => 216,  369 => 228,  333 => 95,  329 => 93,  307 => 117,  287 => 152,  195 => 117,  178 => 123,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 460,  663 => 484,  660 => 194,  657 => 482,  650 => 238,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 221,  603 => 229,  600 => 178,  594 => 440,  588 => 372,  584 => 158,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 156,  513 => 244,  479 => 279,  468 => 163,  451 => 307,  448 => 195,  424 => 296,  418 => 222,  410 => 151,  376 => 109,  373 => 209,  340 => 200,  326 => 212,  261 => 89,  118 => 34,  200 => 119,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 894,  1279 => 377,  1273 => 887,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 768,  1056 => 766,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 536,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 712,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 563,  785 => 560,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 258,  712 => 437,  710 => 502,  707 => 501,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 241,  654 => 357,  649 => 308,  643 => 306,  640 => 226,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 501,  550 => 255,  527 => 153,  515 => 191,  512 => 423,  509 => 422,  503 => 419,  496 => 282,  493 => 415,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 214,  408 => 173,  388 => 292,  371 => 136,  363 => 133,  350 => 191,  342 => 274,  335 => 182,  316 => 16,  290 => 154,  276 => 102,  266 => 149,  263 => 102,  255 => 87,  245 => 153,  207 => 84,  194 => 126,  184 => 118,  76 => 34,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 491,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 219,  627 => 236,  622 => 369,  619 => 212,  616 => 276,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 368,  572 => 204,  566 => 324,  547 => 435,  545 => 253,  542 => 156,  533 => 429,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 163,  443 => 162,  431 => 251,  428 => 250,  425 => 156,  422 => 338,  412 => 152,  406 => 111,  390 => 164,  383 => 161,  377 => 119,  375 => 210,  372 => 199,  370 => 208,  359 => 204,  356 => 132,  353 => 131,  349 => 220,  336 => 272,  332 => 123,  330 => 122,  318 => 105,  313 => 119,  291 => 153,  190 => 98,  321 => 106,  295 => 154,  274 => 71,  242 => 136,  236 => 151,  70 => 19,  170 => 95,  288 => 197,  284 => 109,  279 => 134,  275 => 207,  256 => 145,  250 => 66,  237 => 81,  232 => 79,  222 => 129,  191 => 131,  153 => 69,  150 => 64,  563 => 188,  560 => 275,  558 => 195,  553 => 256,  549 => 438,  543 => 179,  537 => 176,  532 => 201,  528 => 199,  525 => 311,  523 => 195,  518 => 292,  514 => 339,  511 => 243,  508 => 188,  501 => 186,  491 => 288,  487 => 413,  460 => 240,  455 => 120,  449 => 164,  442 => 278,  439 => 133,  436 => 159,  433 => 185,  426 => 180,  420 => 220,  415 => 121,  411 => 174,  405 => 211,  403 => 149,  380 => 120,  366 => 285,  354 => 102,  331 => 198,  325 => 267,  320 => 265,  317 => 209,  311 => 262,  308 => 173,  304 => 116,  272 => 105,  267 => 91,  249 => 85,  216 => 146,  155 => 93,  146 => 102,  126 => 104,  188 => 213,  181 => 112,  161 => 100,  110 => 61,  124 => 80,  692 => 373,  683 => 282,  678 => 279,  676 => 488,  666 => 485,  661 => 407,  656 => 402,  652 => 376,  645 => 236,  641 => 352,  635 => 376,  631 => 463,  625 => 460,  615 => 453,  607 => 363,  597 => 163,  590 => 223,  583 => 435,  579 => 353,  577 => 213,  575 => 212,  569 => 514,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 139,  529 => 222,  524 => 344,  516 => 424,  510 => 78,  504 => 145,  500 => 418,  495 => 416,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 158,  421 => 223,  417 => 219,  400 => 148,  385 => 203,  361 => 207,  344 => 127,  339 => 273,  324 => 102,  310 => 118,  302 => 115,  296 => 96,  282 => 143,  259 => 151,  244 => 142,  231 => 123,  226 => 76,  215 => 63,  186 => 121,  152 => 103,  114 => 75,  104 => 40,  358 => 209,  351 => 130,  347 => 208,  343 => 188,  338 => 125,  327 => 268,  323 => 121,  319 => 176,  315 => 104,  301 => 204,  299 => 174,  293 => 111,  289 => 162,  281 => 93,  277 => 107,  271 => 157,  265 => 150,  262 => 68,  260 => 146,  257 => 100,  251 => 157,  248 => 139,  239 => 131,  228 => 75,  225 => 149,  213 => 70,  211 => 128,  197 => 118,  174 => 115,  148 => 94,  134 => 81,  127 => 57,  20 => 1,  270 => 150,  253 => 124,  233 => 138,  212 => 135,  210 => 118,  206 => 141,  202 => 114,  198 => 104,  192 => 116,  185 => 100,  180 => 118,  175 => 110,  172 => 106,  167 => 104,  165 => 108,  160 => 95,  137 => 104,  113 => 76,  100 => 42,  90 => 29,  81 => 34,  65 => 24,  129 => 82,  97 => 45,  77 => 20,  34 => 8,  53 => 18,  84 => 80,  58 => 14,  23 => 3,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 227,  427 => 226,  423 => 256,  413 => 220,  409 => 219,  407 => 247,  402 => 210,  398 => 401,  393 => 296,  387 => 215,  384 => 214,  381 => 236,  379 => 110,  374 => 137,  368 => 207,  365 => 119,  362 => 205,  360 => 223,  355 => 280,  341 => 126,  337 => 201,  322 => 266,  314 => 162,  312 => 174,  309 => 100,  305 => 204,  298 => 165,  294 => 142,  285 => 152,  283 => 151,  278 => 142,  268 => 101,  264 => 90,  258 => 88,  252 => 148,  247 => 133,  241 => 141,  229 => 135,  220 => 72,  214 => 155,  177 => 77,  169 => 111,  140 => 73,  132 => 83,  128 => 81,  107 => 27,  61 => 52,  273 => 130,  269 => 104,  254 => 99,  243 => 152,  240 => 153,  238 => 140,  235 => 139,  230 => 2,  227 => 1,  224 => 90,  221 => 148,  219 => 128,  217 => 87,  208 => 132,  204 => 138,  179 => 112,  159 => 71,  143 => 88,  135 => 63,  119 => 78,  102 => 39,  71 => 18,  67 => 30,  63 => 15,  59 => 21,  28 => 2,  94 => 44,  89 => 42,  85 => 37,  75 => 19,  68 => 29,  56 => 12,  87 => 22,  201 => 152,  196 => 125,  183 => 211,  171 => 107,  166 => 107,  163 => 93,  158 => 104,  156 => 70,  151 => 68,  142 => 84,  138 => 99,  136 => 84,  121 => 79,  117 => 65,  105 => 89,  91 => 23,  62 => 15,  49 => 17,  25 => 4,  21 => 2,  31 => 3,  38 => 9,  26 => 6,  24 => 31,  19 => 1,  93 => 83,  88 => 33,  78 => 78,  46 => 11,  44 => 8,  27 => 6,  79 => 20,  72 => 33,  69 => 54,  47 => 9,  40 => 14,  37 => 11,  22 => 30,  246 => 84,  157 => 97,  145 => 90,  139 => 90,  131 => 80,  123 => 69,  120 => 69,  115 => 54,  111 => 74,  108 => 59,  101 => 47,  98 => 37,  96 => 84,  83 => 21,  74 => 33,  66 => 16,  55 => 13,  52 => 11,  50 => 12,  43 => 13,  41 => 12,  35 => 6,  32 => 7,  29 => 6,  209 => 68,  203 => 128,  199 => 151,  193 => 116,  189 => 80,  187 => 113,  182 => 68,  176 => 100,  173 => 65,  168 => 108,  164 => 97,  162 => 107,  154 => 66,  149 => 163,  147 => 91,  144 => 92,  141 => 91,  133 => 60,  130 => 97,  125 => 27,  122 => 84,  116 => 33,  112 => 47,  109 => 90,  106 => 61,  103 => 26,  99 => 25,  95 => 24,  92 => 43,  86 => 32,  82 => 36,  80 => 36,  73 => 77,  64 => 29,  60 => 19,  57 => 19,  54 => 13,  51 => 17,  48 => 17,  45 => 14,  42 => 10,  39 => 5,  36 => 4,  33 => 3,  30 => 7,);
    }
}
