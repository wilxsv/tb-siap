<?php

/* MinsalSiapsBundle:MntPacienteAdmin:resultado_busqueda.html.twig */
class __TwigTemplate_07d5762f46b286837f11f659268a19c69ac4cfa47b601a3e8124b0a5140b9343 extends Twig_Template
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
        // line 44
        echo "<div class=\"row\">
  <div class=\"col-md-offset-1 col-md-10\">

  </div>
</div>
<br/>
<table id=\"tablaResultados\" class=\"table table-bordered table-hover\" data-table-enabled=\"true\">
    <thead>
        <tr>
            <th>Acciones</th>
            <th>NEC</th>
            <th>Apellidos</th>
            <th>Nombres</th>
            <th>Fecha de Nacimiento</th>
            <th>Documento</th>
            <th>Nombre Madre</th>
            <th>Conocido por</th>
            ";
        // line 61
        if (twig_in_filter($this->getAttribute($this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "getIdTipoEstablecimiento", array(), "method"), "getId", array(), "method"), array(0 => 1, 1 => 30, 2 => 31, 3 => 14))) {
            // line 62
            echo "              <th>Fecha de Ultimo Ingreso</th>
              <th>Servicio</th>
              <th>Diagnóstico</th>
            ";
        } else {
            // line 66
            echo "              <th>Última Consulta</th>
            ";
        }
        // line 68
        echo "        </tr>
    </thead>
    <tbody>
        ";
        // line 71
        if (((isset($context["procedencia"]) ? $context["procedencia"] : $this->getContext($context, "procedencia")) == "citas")) {
            // line 72
            echo "            ";
            if (((isset($context["origenCita"]) ? $context["origenCita"] : $this->getContext($context, "origenCita")) == "1")) {
                // line 73
                echo "                ";
                $context["url"] = "admin_minsal_citas_citcitasdia_asignar";
                // line 74
                echo "            ";
            } elseif (((isset($context["origenCita"]) ? $context["origenCita"] : $this->getContext($context, "origenCita")) == "2")) {
                // line 75
                echo "                ";
                $context["url"] = "admin_minsal_citas_citcitasprocedimientos_list";
                // line 76
                echo "            ";
            }
            // line 77
            echo "            ";
            $context["etiqueta"] = "Seleccionar";
            // line 78
            echo "        ";
        } else {
            // line 79
            echo "            ";
            $context["url"] = "admin_minsal_siaps_mntpaciente_edit";
            // line 80
            echo "            ";
            $context["etiqueta"] = "Detalle";
            // line 81
            echo "        ";
        }
        // line 82
        echo "        ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pacientes"]) ? $context["pacientes"] : $this->getContext($context, "pacientes")));
        foreach ($context['_seq'] as $context["_key"] => $context["paciente"]) {
            // line 83
            echo "            <tr>
              <td>
                    ";
            // line 85
            if (($this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "numero_temporal", array(), "array") || ($this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "numero", array(), "array") === "EM"))) {
                // line 86
                echo "                        ";
                if ($this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "expediente_fisico_eliminado", array(), "array")) {
                    // line 87
                    echo "                            <a style=\"color: #FFFFFF\" href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), array("id" => $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "id", array(), "array"), "procedencia" => (isset($context["procedencia"]) ? $context["procedencia"] : $this->getContext($context, "procedencia")), "clasificacion" => 0, "idEstablecimientoReferencia" => (isset($context["idEstablecimientoReferencia"]) ? $context["idEstablecimientoReferencia"] : $this->getContext($context, "idEstablecimientoReferencia")), "expedienteReferencia" => (isset($context["expedienteReferencia"]) ? $context["expedienteReferencia"] : $this->getContext($context, "expedienteReferencia")))), "html", null, true);
                    echo "\" class=\"btn btn-success\"><span class=\"glyphicon glyphicon-folder-open\"></span> ";
                    echo twig_escape_filter($this->env, (isset($context["etiqueta"]) ? $context["etiqueta"] : $this->getContext($context, "etiqueta")), "html", null, true);
                    echo " </a>
                        ";
                } else {
                    // line 89
                    echo "                            <a style=\"color: #FFFFFF\" href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), array("id" => $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "id", array(), "array"), "procedencia" => (isset($context["procedencia"]) ? $context["procedencia"] : $this->getContext($context, "procedencia")), "clasificacion" => 0, "idEstablecimientoReferencia" => (isset($context["idEstablecimientoReferencia"]) ? $context["idEstablecimientoReferencia"] : $this->getContext($context, "idEstablecimientoReferencia")), "expedienteReferencia" => (isset($context["expedienteReferencia"]) ? $context["expedienteReferencia"] : $this->getContext($context, "expedienteReferencia")))), "html", null, true);
                    echo "\" class=\"btn btn-danger\"><span class=\"glyphicon glyphicon-folder-open\"></span> ";
                    echo twig_escape_filter($this->env, (isset($context["etiqueta"]) ? $context["etiqueta"] : $this->getContext($context, "etiqueta")), "html", null, true);
                    echo " </a>
                        ";
                }
                // line 91
                echo "                    ";
            } elseif ((($this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "historias", array(), "array") > 0) || (!(null === $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "ambiente", array(), "array"))))) {
                // line 92
                echo "                          <a style=\"color: #FFFFFF\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), array("id" => $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "id", array(), "array"), "procedencia" => (isset($context["procedencia"]) ? $context["procedencia"] : $this->getContext($context, "procedencia")), "clasificacion" => 1, "idEstablecimientoReferencia" => (isset($context["idEstablecimientoReferencia"]) ? $context["idEstablecimientoReferencia"] : $this->getContext($context, "idEstablecimientoReferencia")), "expedienteReferencia" => (isset($context["expedienteReferencia"]) ? $context["expedienteReferencia"] : $this->getContext($context, "expedienteReferencia")))), "html", null, true);
                echo "\" class=\"btn btn-warning\"><span class=\"glyphicon glyphicon-folder-open\"></span> ";
                echo twig_escape_filter($this->env, (isset($context["etiqueta"]) ? $context["etiqueta"] : $this->getContext($context, "etiqueta")), "html", null, true);
                echo " </a>
                    ";
            } else {
                // line 94
                echo "                            <a style=\"color: #FFFFFF\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), array("id" => $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "id", array(), "array"), "procedencia" => (isset($context["procedencia"]) ? $context["procedencia"] : $this->getContext($context, "procedencia")), "clasificacion" => 0, "idEstablecimientoReferencia" => (isset($context["idEstablecimientoReferencia"]) ? $context["idEstablecimientoReferencia"] : $this->getContext($context, "idEstablecimientoReferencia")), "expedienteReferencia" => (isset($context["expedienteReferencia"]) ? $context["expedienteReferencia"] : $this->getContext($context, "expedienteReferencia")))), "html", null, true);
                echo "\" class=\"btn btn-info\"><span class=\"glyphicon glyphicon-folder-open\"></span> ";
                echo twig_escape_filter($this->env, (isset($context["etiqueta"]) ? $context["etiqueta"] : $this->getContext($context, "etiqueta")), "html", null, true);
                echo " </a>
                    ";
            }
            // line 96
            echo "              </td>
              <td >";
            // line 97
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "numero", array(), "array"), "html", null, true);
            echo "</td>
              <td>";
            // line 98
            echo twig_escape_filter($this->env, (((($this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "primer_apellido", array(), "array") . " ") . $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "segundo_apellido", array(), "array")) . " ") . $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "apellido_casada", array(), "array")), "html", null, true);
            echo "</td>
              <td>";
            // line 99
            echo twig_escape_filter($this->env, (((($this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "primer_nombre", array(), "array") . " ") . $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "segundo_nombre", array(), "array")) . " ") . $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "tercer_nombre", array(), "array")), "html", null, true);
            echo "</td>
              <td>";
            // line 100
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "fecha_nacimiento", array(), "array"), "d/m/Y"), "html", null, true);
            echo "</td>
              <td>";
            // line 101
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "nombre", array(), "array")) ? ((($this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "nombre", array(), "array") . ":") . (($this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "numero_doc_ide_paciente", array(), "array")) ? ($this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "numero_doc_ide_paciente", array(), "array")) : ("-")))) : ("")), "html", null, true);
            echo "</td>
              <td>";
            // line 102
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "nombre_madre", array(), "array"), "html", null, true);
            echo "</td>
              <td>";
            // line 103
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "conocido_por", array(), "array"), "html", null, true);
            echo "</td>
              ";
            // line 104
            if (twig_in_filter($this->getAttribute($this->getAttribute((isset($context["establecimiento"]) ? $context["establecimiento"] : $this->getContext($context, "establecimiento")), "getIdTipoEstablecimiento", array(), "method"), "getId", array(), "method"), array(0 => 1, 1 => 30, 2 => 31, 3 => 14))) {
                // line 105
                echo "                  <td>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "fecha_hora_ingreso", array(), "array"), "html", null, true);
                echo "</td>
                  <td>";
                // line 106
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "ambiente", array(), "array"), "html", null, true);
                echo "</td>
                  <td>";
                // line 107
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "diagnostico", array(), "array"), "html", null, true);
                echo "</td>
              ";
            } else {
                // line 109
                echo "                <td></td>
              ";
            }
            // line 111
            echo "          </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['paciente'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 113
        echo "    </tbody>
</table>
<input hidden=\"hidden\" value=\"";
        // line 115
        echo twig_escape_filter($this->env, (isset($context["tipo_busqueda"]) ? $context["tipo_busqueda"] : $this->getContext($context, "tipo_busqueda")), "html", null, true);
        echo "\" id=\"tipo\"/>
";
    }

    // line 1
    public function block_javascripts($context, array $blocks = array())
    {
        // line 2
        echo "    <script type=\"text/javascript\">
        jQuery(document).ready(function (\$) {
            var tablaResultados=\$('#tablaResultados');
            var opcionesTable=setDataTableOptions(tablaResultados);
            opcionesTable['displayLength']=15;
            opcionesTable['filter']=false;
            opcionesTable['dom'] = \"<'row'<'col-sm-6'l><'col-sm-6'p>>\" +
                                      \"<'row'<'col-sm-12 table-toolbar'>>\" +
                                      \"<'row'<'col-sm-12 table-responsive'tr>>\" +
                                      \"<'row'<'col-sm-5'i><'col-sm-7'>>\";

            // opcionesTable['dom']='<\"top\"flp>rt<\"bottom\"i>';
            opcionesTable['lengthMenu']= [[15,25, 50, 75, -1], [15,25, 50, 75, \"Todos\"]];
            tablaResultados.DataTable(opcionesTable);
            \$('.table-toolbar').append(
                '<div class=\"accordion\" id=\"accordion2\" style=\"background-color:white;\">'+
                    '<div class=\"accordion-group\">'+
                        '<div class=\"accordion-heading\">'+
                            '<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion2\" href=\"#collapseOne\">'+
                                '<div style=\"font-size: 15px;font-weight:bold;\">Código de Colores</div>'+
                            '</a>'+
                        '</div>'+
                        '<div id=\"collapseOne\" class=\"accordion-body collapse in\">'+
                            '<div class=\"accordion-inner\">'+
                                '<div style=\"text-align:left;\">'+
                                    '<table>'+
                                        '<tr><td style=\"background-color:#f56954;width:16px;height:36px;\"></td><td style=\"padding-left:10px;padding-right: 10px; border-bottom: 1px solid #DDDDDD;\">Expediente Temporal</td>'+
                                        '<td style=\"background-color:#00c0ef;width:16px;height:36px;\"></td><td style=\"padding-left:10px;padding-right: 10px; border-bottom: 1px solid #DDDDDD;\">Expediente Sin Historial Clínico</td>'+
                                        '<td style=\"background-color:#f39c12;width:16px;height:36px;\"></td><td style=\"padding-left:10px;padding-right: 10px; border-bottom: 1px solid #DDDDDD;\">Expediente Con Historial Clínico</td>'+
                                        '<td style=\"background-color:#00a65a;width:16px;height:36px;\"></td><td style=\"padding-left:10px;padding-right: 10px; border-bottom: 1px solid #DDDDDD;\">Expediente Eliminado Físicamente del Archivo</td></tr>'+
                                    '</table>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'
            );

            \$('#resultadoBusqueda').waitMe('hide');
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:MntPacienteAdmin:resultado_busqueda.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1082 => 552,  1076 => 550,  1072 => 548,  1069 => 547,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 450,  842 => 443,  836 => 440,  824 => 435,  781 => 416,  775 => 413,  762 => 406,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 388,  708 => 381,  703 => 378,  674 => 366,  659 => 359,  636 => 350,  604 => 329,  581 => 320,  568 => 315,  539 => 300,  534 => 298,  530 => 297,  521 => 293,  489 => 280,  483 => 277,  394 => 234,  396 => 321,  345 => 283,  476 => 315,  386 => 284,  364 => 219,  234 => 88,  595 => 326,  589 => 192,  586 => 322,  562 => 312,  556 => 182,  506 => 103,  498 => 283,  492 => 281,  473 => 165,  458 => 266,  399 => 143,  352 => 211,  346 => 125,  328 => 524,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 251,  758 => 405,  667 => 218,  573 => 172,  567 => 170,  520 => 177,  481 => 167,  475 => 159,  472 => 158,  466 => 156,  441 => 346,  438 => 149,  432 => 251,  429 => 342,  395 => 287,  382 => 128,  378 => 281,  367 => 120,  357 => 118,  348 => 115,  334 => 110,  286 => 6,  205 => 115,  297 => 92,  218 => 81,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 296,  787 => 419,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 259,  740 => 239,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 224,  628 => 214,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 316,  499 => 154,  488 => 172,  389 => 318,  223 => 172,  14 => 2,  306 => 95,  303 => 91,  300 => 248,  292 => 86,  280 => 87,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 328,  599 => 327,  580 => 194,  574 => 230,  559 => 311,  526 => 179,  497 => 173,  485 => 318,  463 => 268,  447 => 152,  404 => 238,  401 => 289,  391 => 76,  369 => 129,  333 => 132,  329 => 275,  307 => 242,  287 => 58,  195 => 54,  178 => 48,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 265,  807 => 259,  805 => 426,  802 => 425,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 368,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 356,  647 => 355,  644 => 190,  632 => 349,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 224,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 307,  448 => 306,  424 => 249,  418 => 112,  410 => 113,  376 => 224,  373 => 102,  340 => 122,  326 => 256,  261 => 76,  118 => 39,  200 => 64,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 543,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 536,  1036 => 534,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 255,  796 => 422,  793 => 421,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 231,  710 => 149,  707 => 208,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 357,  649 => 122,  643 => 227,  640 => 226,  638 => 351,  617 => 112,  614 => 201,  598 => 107,  593 => 201,  576 => 101,  564 => 162,  557 => 310,  550 => 94,  527 => 296,  515 => 305,  512 => 290,  509 => 228,  503 => 81,  496 => 282,  493 => 155,  478 => 275,  467 => 312,  456 => 309,  450 => 114,  414 => 242,  408 => 239,  388 => 231,  371 => 72,  363 => 32,  350 => 26,  342 => 282,  335 => 279,  316 => 16,  290 => 110,  276 => 2,  266 => 83,  263 => 133,  255 => 185,  245 => 122,  207 => 1,  194 => 106,  184 => 55,  76 => 24,  810 => 238,  804 => 260,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 399,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 372,  685 => 371,  682 => 226,  672 => 223,  670 => 365,  665 => 362,  648 => 219,  627 => 206,  622 => 204,  619 => 212,  616 => 202,  613 => 210,  610 => 332,  608 => 197,  605 => 207,  596 => 106,  592 => 325,  587 => 197,  585 => 196,  582 => 190,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 303,  542 => 186,  533 => 186,  531 => 95,  507 => 287,  505 => 180,  502 => 175,  477 => 164,  471 => 164,  465 => 161,  454 => 265,  446 => 156,  443 => 256,  431 => 151,  428 => 250,  425 => 152,  422 => 338,  412 => 147,  406 => 111,  390 => 139,  383 => 316,  377 => 73,  375 => 124,  372 => 277,  370 => 222,  359 => 70,  356 => 269,  353 => 268,  349 => 119,  336 => 205,  332 => 259,  330 => 554,  318 => 518,  313 => 209,  291 => 198,  190 => 111,  321 => 254,  295 => 201,  274 => 87,  242 => 121,  236 => 177,  70 => 22,  170 => 104,  288 => 197,  284 => 192,  279 => 193,  275 => 227,  256 => 74,  250 => 73,  237 => 89,  232 => 136,  222 => 129,  191 => 88,  153 => 72,  150 => 99,  563 => 188,  560 => 187,  558 => 186,  553 => 309,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 173,  525 => 172,  523 => 171,  518 => 292,  514 => 168,  511 => 167,  508 => 165,  501 => 284,  491 => 157,  487 => 156,  460 => 267,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 297,  415 => 121,  411 => 293,  405 => 118,  403 => 117,  380 => 107,  366 => 106,  354 => 101,  331 => 96,  325 => 94,  320 => 521,  317 => 91,  311 => 87,  308 => 205,  304 => 85,  272 => 81,  267 => 130,  249 => 78,  216 => 159,  155 => 35,  146 => 98,  126 => 87,  188 => 54,  181 => 107,  161 => 54,  110 => 58,  124 => 113,  692 => 373,  683 => 282,  678 => 279,  676 => 367,  666 => 126,  661 => 380,  656 => 358,  652 => 376,  645 => 215,  641 => 352,  635 => 226,  631 => 218,  625 => 361,  615 => 335,  607 => 208,  597 => 177,  590 => 202,  583 => 321,  579 => 284,  577 => 319,  575 => 328,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 299,  529 => 191,  524 => 90,  516 => 291,  510 => 78,  504 => 90,  500 => 88,  495 => 158,  490 => 154,  486 => 165,  482 => 317,  470 => 313,  464 => 311,  459 => 116,  452 => 158,  434 => 252,  421 => 90,  417 => 296,  400 => 116,  385 => 129,  361 => 207,  344 => 209,  339 => 206,  324 => 179,  310 => 208,  302 => 93,  296 => 151,  282 => 194,  259 => 186,  244 => 83,  231 => 67,  226 => 69,  215 => 63,  186 => 109,  152 => 51,  114 => 80,  104 => 87,  358 => 103,  351 => 116,  347 => 210,  343 => 264,  338 => 280,  327 => 108,  323 => 522,  319 => 124,  315 => 517,  301 => 80,  299 => 201,  293 => 199,  289 => 82,  281 => 57,  277 => 192,  271 => 79,  265 => 100,  262 => 187,  260 => 128,  257 => 53,  251 => 182,  248 => 71,  239 => 120,  228 => 103,  225 => 65,  213 => 69,  211 => 156,  197 => 113,  174 => 59,  148 => 38,  134 => 35,  127 => 16,  20 => 1,  270 => 85,  253 => 78,  233 => 66,  212 => 158,  210 => 2,  206 => 109,  202 => 108,  198 => 54,  192 => 66,  185 => 104,  180 => 49,  175 => 47,  172 => 105,  167 => 44,  165 => 83,  160 => 88,  137 => 2,  113 => 53,  100 => 56,  90 => 82,  81 => 79,  65 => 20,  129 => 88,  97 => 92,  77 => 35,  34 => 3,  53 => 68,  84 => 80,  58 => 71,  23 => 3,  480 => 276,  474 => 274,  469 => 271,  461 => 70,  457 => 124,  453 => 151,  444 => 151,  440 => 304,  437 => 253,  435 => 344,  430 => 153,  427 => 341,  423 => 298,  413 => 241,  409 => 327,  407 => 326,  402 => 323,  398 => 235,  393 => 320,  387 => 110,  384 => 230,  381 => 315,  379 => 154,  374 => 36,  368 => 221,  365 => 119,  362 => 148,  360 => 216,  355 => 27,  341 => 263,  337 => 97,  322 => 93,  314 => 88,  312 => 97,  309 => 113,  305 => 204,  298 => 247,  294 => 100,  285 => 88,  283 => 5,  278 => 110,  268 => 101,  264 => 104,  258 => 75,  252 => 184,  247 => 72,  241 => 179,  229 => 86,  220 => 171,  214 => 58,  177 => 106,  169 => 44,  140 => 47,  132 => 84,  128 => 42,  107 => 29,  61 => 19,  273 => 190,  269 => 189,  254 => 126,  243 => 180,  240 => 72,  238 => 178,  235 => 67,  230 => 175,  227 => 174,  224 => 62,  221 => 61,  219 => 60,  217 => 86,  208 => 155,  204 => 61,  179 => 101,  159 => 40,  143 => 36,  135 => 37,  119 => 99,  102 => 28,  71 => 26,  67 => 25,  63 => 73,  59 => 57,  28 => 5,  94 => 25,  89 => 56,  85 => 43,  75 => 77,  68 => 21,  56 => 22,  87 => 81,  201 => 115,  196 => 112,  183 => 55,  171 => 63,  166 => 103,  163 => 42,  158 => 101,  156 => 75,  151 => 1,  142 => 97,  138 => 87,  136 => 45,  121 => 75,  117 => 81,  105 => 34,  91 => 29,  62 => 17,  49 => 66,  25 => 4,  21 => 2,  31 => 2,  38 => 7,  26 => 2,  24 => 3,  19 => 1,  93 => 31,  88 => 40,  78 => 78,  46 => 7,  44 => 9,  27 => 3,  79 => 28,  72 => 76,  69 => 75,  47 => 10,  40 => 6,  37 => 5,  22 => 44,  246 => 181,  157 => 94,  145 => 64,  139 => 96,  131 => 94,  123 => 92,  120 => 91,  115 => 12,  111 => 32,  108 => 54,  101 => 86,  98 => 55,  96 => 26,  83 => 26,  74 => 16,  66 => 74,  55 => 23,  52 => 12,  50 => 9,  43 => 62,  41 => 61,  35 => 6,  32 => 4,  29 => 3,  209 => 157,  203 => 56,  199 => 59,  193 => 57,  189 => 65,  187 => 104,  182 => 103,  176 => 85,  173 => 48,  168 => 50,  164 => 42,  162 => 102,  154 => 100,  149 => 34,  147 => 101,  144 => 100,  141 => 71,  133 => 28,  130 => 40,  125 => 78,  122 => 77,  116 => 54,  112 => 89,  109 => 10,  106 => 47,  103 => 49,  99 => 85,  95 => 83,  92 => 34,  86 => 29,  82 => 37,  80 => 21,  73 => 23,  64 => 12,  60 => 72,  57 => 13,  54 => 14,  51 => 9,  48 => 9,  45 => 8,  42 => 8,  39 => 4,  36 => 5,  33 => 6,  30 => 4,);
    }
}
