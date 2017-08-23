<?php

/* MinsalSeguimientoBundle:SecHistorialClinico:cargarListarPacientesAtendidos.html.twig */
class __TwigTemplate_393c34b241d50e9a5c73d9b54bcc8d82cc2cd39aa48f87aa5fdc7f8110c79e6c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('javascripts', $context, $blocks);
        // line 30
        if ((twig_length_filter($this->env, (isset($context["citas"]) ? $context["citas"] : $this->getContext($context, "citas"))) > 0)) {
            // line 31
            echo "<div class=\"row\">
    <div class=\"col-md-offset-1 col-md-9\">
        <div class=\"bs-callout bs-callout-info\" id=\"callout-glyphicons-location\">
            <div class=\"row\">
                <div class=\"col-md-8\">

                    <h4> Consideraciones a tener en cuenta</h4>
                    <p>
                        A continuación se presenta la interpretación de las barras que apareceran en el informe:
                        <div class=\"progress-group\">
                            <span class=\"progress-text\">NOMBRE DEL MÉDICO</span>
                            <span class=\"progress-number  pull-right \">Atendidos/Total Citados</span>
                            <div class=\"progress progress-sm active\">
                                <div style=\"width:70%\" class=\"progress-bar progress-bar-info progress-bar-striped\">(Atendidos/Total Citados)*100 %</div>
                            </div>
                        </div>
                    </p>
                </div>
                <div class=\"col-md-4\">

                    <div class=\"accordion-group\">
                        <div class=\"accordion-heading\">
                            <a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion2\" href=\"#collapseOne\">
                                <div style=\"font-size: 15px;font-weight:bold;\">Código de Colores</div>
                            </a>
                        </div>
                        <div id=\"collapseOne\" class=\"accordion-body collapse in\">
                            <div class=\"accordion-inner\">
                                <div style=\"text-align:left;\">
                                    <table>
                                        <tr><td style=\"background-color:#00a65a;width:16px;height:36px;\"></td><td style=\"padding-left:10px;border-bottom: 1px solid #DDDDDD;\">Porcentajes de consulta atendidas mayores a 80%</td></tr>
                                        <tr><td style=\"background-color:#f39c12;width:16px;height:36px;\"></td><td style=\"padding-left:10px;border-bottom: 1px solid #DDDDDD;\">Porcentajes de consulta atendidas entre 50% y 80%</td></tr>
                                        <tr><td style=\"background-color:#f56954;width:16px;height:36px;\"></td><td style=\"padding-left:10px;border-bottom: 1px solid #DDDDDD;\">Porcentajes de consulta atendidas menores a 50%</td></tr>


                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        ";
            // line 76
            $context["citados"] = 0;
            // line 77
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["citas"]) ? $context["citas"] : $this->getContext($context, "citas")));
            foreach ($context['_seq'] as $context["_key"] => $context["detalle"]) {
                // line 78
                echo "        ";
                if (($this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "total_citas", array(), "array") != 0)) {
                    // line 79
                    echo "          ";
                    $context["calculo"] = (($this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "atendidos", array(), "array") / $this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "total_citas", array(), "array")) * 100);
                    // line 80
                    echo "        ";
                } else {
                    // line 81
                    echo "          ";
                    $context["calculo"] = (-1);
                    // line 82
                    echo "          ";
                    $context["citados"] = ((isset($context["citados"]) ? $context["citados"] : $this->getContext($context, "citados")) + 1);
                    // line 83
                    echo "        ";
                }
                // line 84
                echo "        ";
                if (((isset($context["calculo"]) ? $context["calculo"] : $this->getContext($context, "calculo")) != (-1))) {
                    // line 85
                    echo "
        <div class=\"row\">
          <div class=\"col-md-offset-2 col-md-6\">
                  <div class=\"progress-group\">
                      <span class=\"progress-text\">";
                    // line 89
                    echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "empleado", array(), "array"), "nombreempleado")), "html", null, true);
                    echo "</span>
                      ";
                    // line 90
                    if (((isset($context["calculo"]) ? $context["calculo"] : $this->getContext($context, "calculo")) >= 80)) {
                        // line 91
                        echo "                          <span class=\"progress-number  pull-right \">";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "atendidos", array(), "array"), "html", null, true);
                        echo "/";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "total_citas", array(), "array"), "html", null, true);
                        echo "</span>
                          <div class=\"progress progress-sm active\">
                              <div style=\"width:";
                        // line 93
                        echo twig_escape_filter($this->env, (isset($context["calculo"]) ? $context["calculo"] : $this->getContext($context, "calculo")), "html", null, true);
                        echo "%\" class=\"progress-bar progress-bar-success progress-bar-striped\">";
                        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["calculo"]) ? $context["calculo"] : $this->getContext($context, "calculo"))), "html", null, true);
                        echo "%</div>
                          </div>
                      ";
                    } else {
                        // line 96
                        echo "                          ";
                        if (((isset($context["calculo"]) ? $context["calculo"] : $this->getContext($context, "calculo")) >= 50)) {
                            // line 97
                            echo "                              <span class=\"progress-number pull-right\">";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "atendidos", array(), "array"), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "total_citas", array(), "array"), "html", null, true);
                            echo "</span>
                              <div class=\"progress progress-sm active\">
                                  <div style=\"width:";
                            // line 99
                            echo twig_escape_filter($this->env, (isset($context["calculo"]) ? $context["calculo"] : $this->getContext($context, "calculo")), "html", null, true);
                            echo "%\" class=\"progress-bar progress-bar-warning progress-bar-striped active\">";
                            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["calculo"]) ? $context["calculo"] : $this->getContext($context, "calculo"))), "html", null, true);
                            echo "%</div>
                              </div>
                          ";
                        } else {
                            // line 102
                            echo "                                <span class=\"progress-number  pull-right\">";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "atendidos", array(), "array"), "html", null, true);
                            echo "/";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "total_citas", array(), "array"), "html", null, true);
                            echo "</span>
                                <div class=\"progress progress-sm active\">
                                    <div style=\"width:";
                            // line 104
                            echo twig_escape_filter($this->env, (isset($context["calculo"]) ? $context["calculo"] : $this->getContext($context, "calculo")), "html", null, true);
                            echo "%\" class=\"progress-bar progress-bar-danger progress-bar-striped\">";
                            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["calculo"]) ? $context["calculo"] : $this->getContext($context, "calculo"))), "html", null, true);
                            echo "%</div>
                                </div>
                          ";
                        }
                        // line 107
                        echo "                      ";
                    }
                    // line 108
                    echo "              </div>
          </div>
          <div class=\"col-md-1\">
              <script type=\"text/javascript\">

              jQuery(document).ready(function (\$) {
                    var parametros=[];
                    parametros['id']=";
                    // line 115
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "empleado", array(), "array"), "id"), "html", null, true);
                    echo ";//split para mandar ir
                    parametros['especialidad']=\$('#idAtenAreaModEstab').select2('val');
                    parametros['fecha']=moment(\$('#fecha_consulta').val(),'DD/MM/YYYY').format('YYYY-MM-DD');
                    pushModalElement('detalle_";
                    // line 118
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "empleado", array(), "array"), "id"), "html", null, true);
                    echo "_modal', 'agendaMedica', parametros);
              });
              </script>
              <a href=\"#myModal\" id=\"detalle_";
                    // line 121
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["detalle"]) ? $context["detalle"] : $this->getContext($context, "detalle")), "empleado", array(), "array"), "id"), "html", null, true);
                    echo "_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\">
              <div class=\"icon\"><i class=\"glyphicon glyphicon-zoom-in fa-2x\"></i><br/>Ver Detalle</div></a>
          </div>
        </div>
        ";
                }
                // line 126
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['detalle'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 127
            echo "        ";
            if (((isset($context["citados"]) ? $context["citados"] : $this->getContext($context, "citados")) == twig_length_filter($this->env, (isset($context["citas"]) ? $context["citas"] : $this->getContext($context, "citas"))))) {
                // line 128
                echo "        <div class=\"row\">
            <div class=\"col-md-offset-2 col-md-7\">
                <div class=\"alert alert-info\" role=\"alert\"> <h4 class=\"center\">No hay pacientes citados para esta fecha en esta especialidad</h4></div>

            </div>
        ";
            }
        } else {
            // line 135
            echo "<div class=\"row\">
    <div class=\"col-md-offset-2 col-md-7\">
        <div class=\"alert alert-info\" role=\"alert\"> <h4 class=\"center\">No hay pacientes citados para esta fecha en esta especialidad</h4></div>
    </div>
</div>

";
        }
        // line 142
        $context["codigoEmpleado"] = (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true)) ? (twig_upper_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo"))) : ("N/A"));
        // line 143
        $this->env->loadTemplate("MinsalCitasBundle:Custom:agenda_dia.html.twig")->display($context);
    }

    // line 1
    public function block_javascripts($context, array $blocks = array())
    {
        // line 2
        echo "    <script type=\"text/javascript\">
        var modal_elements = [];
        function pushModalElement(newId, callFunction, parameters_func) {
            modal_elements.push({
                id: newId,
                func: callFunction,
                header: 'Detalle de Pacientes Atendidos',
                footer: '',
                widthModal: '800px',
                parameters: parameters_func
            });
        }
        function agendaMedica(parameters) {
              parameters['url']   = Routing.generate('citasdetallehora') + '?idEmpleado=' + parameters['id'] + '&idEmpleadoEspecialidadEstab=' + parameters['especialidad'] + '&date=' + parameters['fecha'];
              result = buildDetailAgendaMedica(parameters);

              if(Object.keys(result).length === 0 || result.content === '') {
                  result.warningMessage = '';
                  result.content = '<div class=\"alert alert-block alert-error\">\\
                                                              <h4>Error al construir la agenda m&eacute;dica</h4>\\
                                                              Lo sentimos un error al construir el detalle de la agenda m&eacute;dica, por favor intentelo nuevamente, si el problema persiste contacte con el administrador del sistema...\\
                                                      </div>';
              }

              return '<div id=\"warning-message\">'+result.warningMessage+'</div><div id=\"info-message\"></div><div class=\"panel-primary-custom\"><div class=\"agendamd-content\">'+result.content+'</div></div>';
          }
    </script>
";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecHistorialClinico:cargarListarPacientesAtendidos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  552 => 208,  709 => 255,  397 => 168,  392 => 165,  1577 => 1107,  1574 => 1106,  1569 => 1111,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 921,  1289 => 896,  1286 => 895,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 856,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 767,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 759,  992 => 720,  962 => 697,  960 => 696,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 279,  419 => 293,  639 => 235,  611 => 386,  538 => 251,  646 => 307,  642 => 286,  544 => 352,  541 => 204,  517 => 192,  797 => 489,  752 => 533,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 224,  519 => 193,  416 => 221,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 416,  775 => 413,  762 => 540,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 388,  708 => 381,  703 => 378,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 203,  534 => 348,  530 => 248,  521 => 194,  489 => 179,  483 => 206,  394 => 217,  396 => 206,  345 => 189,  476 => 174,  386 => 162,  364 => 114,  234 => 78,  595 => 326,  589 => 267,  586 => 223,  562 => 144,  556 => 274,  506 => 103,  498 => 292,  492 => 274,  473 => 277,  458 => 121,  399 => 209,  352 => 279,  346 => 125,  328 => 179,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 244,  573 => 328,  567 => 347,  520 => 247,  481 => 123,  475 => 275,  472 => 172,  466 => 227,  441 => 346,  438 => 189,  432 => 230,  429 => 222,  395 => 400,  382 => 231,  378 => 211,  367 => 115,  357 => 222,  348 => 190,  334 => 110,  286 => 169,  205 => 106,  297 => 113,  218 => 127,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 561,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 302,  687 => 301,  671 => 262,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 281,  609 => 273,  602 => 230,  591 => 280,  571 => 262,  499 => 268,  488 => 273,  389 => 235,  223 => 143,  14 => 2,  306 => 117,  303 => 159,  300 => 98,  292 => 95,  280 => 108,  12 => 36,  624 => 282,  620 => 223,  612 => 232,  601 => 379,  599 => 327,  580 => 265,  574 => 263,  559 => 311,  526 => 309,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 172,  401 => 119,  391 => 216,  369 => 228,  333 => 95,  329 => 93,  307 => 117,  287 => 152,  195 => 110,  178 => 123,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 221,  668 => 460,  663 => 195,  660 => 194,  657 => 193,  650 => 238,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 221,  603 => 229,  600 => 178,  594 => 225,  588 => 372,  584 => 158,  570 => 149,  561 => 259,  554 => 188,  551 => 101,  546 => 175,  522 => 156,  513 => 244,  479 => 279,  468 => 163,  451 => 307,  448 => 195,  424 => 296,  418 => 222,  410 => 151,  376 => 109,  373 => 209,  340 => 200,  326 => 212,  261 => 89,  118 => 53,  200 => 127,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 894,  1279 => 377,  1273 => 887,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 768,  1056 => 766,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 536,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 712,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 563,  785 => 560,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 258,  712 => 437,  710 => 149,  707 => 208,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 241,  654 => 357,  649 => 308,  643 => 306,  640 => 226,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 101,  564 => 260,  557 => 366,  550 => 255,  527 => 153,  515 => 191,  512 => 147,  509 => 337,  503 => 238,  496 => 282,  493 => 155,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 214,  408 => 173,  388 => 292,  371 => 136,  363 => 133,  350 => 191,  342 => 274,  335 => 182,  316 => 16,  290 => 154,  276 => 102,  266 => 149,  263 => 102,  255 => 87,  245 => 122,  207 => 84,  194 => 126,  184 => 118,  76 => 34,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 372,  685 => 252,  682 => 202,  672 => 247,  670 => 365,  665 => 362,  648 => 219,  627 => 236,  622 => 369,  619 => 212,  616 => 276,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 368,  572 => 204,  566 => 324,  547 => 186,  545 => 253,  542 => 156,  533 => 138,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 163,  443 => 162,  431 => 251,  428 => 250,  425 => 156,  422 => 338,  412 => 152,  406 => 111,  390 => 164,  383 => 161,  377 => 119,  375 => 210,  372 => 199,  370 => 208,  359 => 204,  356 => 132,  353 => 131,  349 => 220,  336 => 272,  332 => 123,  330 => 122,  318 => 105,  313 => 119,  291 => 153,  190 => 98,  321 => 106,  295 => 154,  274 => 71,  242 => 136,  236 => 93,  70 => 31,  170 => 95,  288 => 197,  284 => 109,  279 => 134,  275 => 157,  256 => 145,  250 => 66,  237 => 81,  232 => 79,  222 => 129,  191 => 214,  153 => 69,  150 => 67,  563 => 188,  560 => 275,  558 => 195,  553 => 256,  549 => 207,  543 => 179,  537 => 176,  532 => 201,  528 => 199,  525 => 311,  523 => 195,  518 => 292,  514 => 339,  511 => 243,  508 => 188,  501 => 186,  491 => 288,  487 => 156,  460 => 240,  455 => 120,  449 => 164,  442 => 278,  439 => 133,  436 => 159,  433 => 185,  426 => 180,  420 => 220,  415 => 121,  411 => 174,  405 => 211,  403 => 149,  380 => 120,  366 => 285,  354 => 102,  331 => 198,  325 => 267,  320 => 265,  317 => 209,  311 => 262,  308 => 173,  304 => 116,  272 => 105,  267 => 91,  249 => 85,  216 => 134,  155 => 92,  146 => 102,  126 => 59,  188 => 213,  181 => 112,  161 => 62,  110 => 63,  124 => 58,  692 => 373,  683 => 282,  678 => 279,  676 => 367,  666 => 126,  661 => 407,  656 => 402,  652 => 376,  645 => 236,  641 => 352,  635 => 376,  631 => 238,  625 => 284,  615 => 335,  607 => 363,  597 => 163,  590 => 223,  583 => 266,  579 => 353,  577 => 213,  575 => 212,  569 => 213,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 139,  529 => 222,  524 => 344,  516 => 245,  510 => 78,  504 => 145,  500 => 331,  495 => 233,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 158,  421 => 223,  417 => 219,  400 => 148,  385 => 203,  361 => 207,  344 => 127,  339 => 273,  324 => 102,  310 => 118,  302 => 115,  296 => 96,  282 => 143,  259 => 151,  244 => 96,  231 => 123,  226 => 76,  215 => 63,  186 => 121,  152 => 103,  114 => 63,  104 => 57,  358 => 209,  351 => 130,  347 => 208,  343 => 188,  338 => 125,  327 => 268,  323 => 121,  319 => 176,  315 => 104,  301 => 204,  299 => 174,  293 => 111,  289 => 162,  281 => 93,  277 => 107,  271 => 157,  265 => 150,  262 => 68,  260 => 146,  257 => 100,  251 => 123,  248 => 139,  239 => 131,  228 => 75,  225 => 125,  213 => 70,  211 => 125,  197 => 135,  174 => 115,  148 => 88,  134 => 89,  127 => 96,  20 => 1,  270 => 150,  253 => 124,  233 => 92,  212 => 135,  210 => 118,  206 => 67,  202 => 114,  198 => 104,  192 => 124,  185 => 100,  180 => 118,  175 => 110,  172 => 106,  167 => 104,  165 => 108,  160 => 114,  137 => 63,  113 => 64,  100 => 42,  90 => 82,  81 => 79,  65 => 24,  129 => 56,  97 => 41,  77 => 20,  34 => 3,  53 => 18,  84 => 80,  58 => 26,  23 => 2,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 227,  427 => 226,  423 => 256,  413 => 220,  409 => 219,  407 => 247,  402 => 210,  398 => 401,  393 => 296,  387 => 215,  384 => 214,  381 => 236,  379 => 110,  374 => 137,  368 => 207,  365 => 119,  362 => 205,  360 => 223,  355 => 280,  341 => 126,  337 => 201,  322 => 266,  314 => 162,  312 => 174,  309 => 100,  305 => 204,  298 => 165,  294 => 142,  285 => 152,  283 => 151,  278 => 142,  268 => 101,  264 => 90,  258 => 88,  252 => 98,  247 => 133,  241 => 62,  229 => 135,  220 => 72,  214 => 86,  177 => 77,  169 => 105,  140 => 73,  132 => 74,  128 => 63,  107 => 58,  61 => 52,  273 => 130,  269 => 104,  254 => 99,  243 => 83,  240 => 95,  238 => 61,  235 => 80,  230 => 2,  227 => 1,  224 => 90,  221 => 142,  219 => 60,  217 => 87,  208 => 132,  204 => 138,  179 => 123,  159 => 71,  143 => 89,  135 => 71,  119 => 93,  102 => 45,  71 => 76,  67 => 30,  63 => 15,  59 => 21,  28 => 2,  94 => 30,  89 => 24,  85 => 37,  75 => 36,  68 => 30,  56 => 12,  87 => 81,  201 => 152,  196 => 125,  183 => 211,  171 => 206,  166 => 107,  163 => 93,  158 => 83,  156 => 70,  151 => 68,  142 => 93,  138 => 99,  136 => 60,  121 => 54,  117 => 1,  105 => 89,  91 => 53,  62 => 23,  49 => 16,  25 => 4,  21 => 2,  31 => 2,  38 => 5,  26 => 6,  24 => 31,  19 => 1,  93 => 83,  88 => 37,  78 => 78,  46 => 34,  44 => 8,  27 => 3,  79 => 33,  72 => 33,  69 => 54,  47 => 7,  40 => 6,  37 => 11,  22 => 30,  246 => 84,  157 => 93,  145 => 72,  139 => 92,  131 => 61,  123 => 69,  120 => 69,  115 => 54,  111 => 91,  108 => 59,  101 => 59,  98 => 40,  96 => 84,  83 => 60,  74 => 45,  66 => 19,  55 => 19,  52 => 11,  50 => 20,  43 => 7,  41 => 12,  35 => 6,  32 => 7,  29 => 6,  209 => 68,  203 => 128,  199 => 151,  193 => 116,  189 => 80,  187 => 114,  182 => 68,  176 => 100,  173 => 65,  168 => 108,  164 => 73,  162 => 107,  154 => 104,  149 => 163,  147 => 95,  144 => 94,  141 => 62,  133 => 60,  130 => 97,  125 => 27,  122 => 84,  116 => 50,  112 => 47,  109 => 90,  106 => 61,  103 => 60,  99 => 85,  95 => 2,  92 => 38,  86 => 59,  82 => 36,  80 => 35,  73 => 77,  64 => 29,  60 => 27,  57 => 19,  54 => 50,  51 => 17,  48 => 16,  45 => 7,  42 => 14,  39 => 13,  36 => 4,  33 => 3,  30 => 2,);
    }
}
