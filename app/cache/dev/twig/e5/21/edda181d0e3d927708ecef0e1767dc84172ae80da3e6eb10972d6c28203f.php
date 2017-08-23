<?php

/* MinsalCitasBundle:CitasMedicas:carga_citas.html.twig */
class __TwigTemplate_e521edda181d0e3d927708ecef0e1767dc84172ae80da3e6eb10972d6c28203f extends Twig_Template
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
        // line 2
        $this->displayBlock('javascripts', $context, $blocks);
        // line 50
        echo "<table id=\"tablaResultados\" class=\"table table-bordered table-hover\" data-table-enabled=\"true\">
    <thead>
        <tr>
            <th>Especialidad</th>
            <th>Médico</th>
            <th>Tipo Cita</th>
            <th>Fecha y Hora de la Cita</th>
            <th>Estado de la cita</th>
            <th>Usuario que asigno la cita</th>
            <th>Fecha y Hora de asignación</th>
            <th width=\"60px;\">Acciones</th>
        </tr>
    </thead>
    <tbody>
        ";
        // line 64
        $context["fechaActual"] = twig_date_converter($this->env);
        // line 65
        echo "        ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["citasMedicas"]) ? $context["citasMedicas"] : $this->getContext($context, "citasMedicas")));
        foreach ($context['_seq'] as $context["_key"] => $context["cita"]) {
            // line 66
            echo "        <tr>
            <td >";
            // line 67
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idAtenAreaModEstab"), "html", null, true);
            echo "</td>
            <td>";
            // line 68
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idEmpleado"), "html", null, true);
            echo "</td>
            <td >";
            // line 69
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idTipoCita"), "html", null, true);
            echo "</td>
            <td >
                ";
            // line 71
            $context["nombreTipoDistribucion"] = "";
            // line 72
            echo "            ";
            if ($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idDistribucion")) {
                // line 73
                echo "                ";
                if ($this->getAttribute($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idDistribucion"), "idTipoDistribucion")) {
                    // line 74
                    echo "                    ";
                    $context["nombreTipoDistribucion"] = $this->getAttribute($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idDistribucion"), "idTipoDistribucion");
                    // line 75
                    echo "                ";
                }
                // line 76
                echo "            ";
            }
            // line 77
            echo "            ";
            echo twig_escape_filter($this->env, ((((twig_title_string_filter($this->env, twig_localized_date_filter($this->env, $this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "fecha"), "full", "none", "es_SV")) . " En el horario: ") . $this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idRangohora")) . " ") . (isset($context["nombreTipoDistribucion"]) ? $context["nombreTipoDistribucion"] : $this->getContext($context, "nombreTipoDistribucion"))), "html", null, true);
            echo "
                </td>
            <td >";
            // line 79
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idEstado"), "html", null, true);
            echo "</td>
            <td >";
            // line 80
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "getIdusuarioreg", array(), "method"), "getIdEmpleado", array(), "method"), "html", null, true);
            echo "</td>
            <td >";
            // line 81
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "fechahorareg"), "d/m/Y h:i A"), "html", null, true);
            echo "</td>
            <td>
                ";
            // line 83
            if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SONATA_ADMIN_CITCITASDIA_REPORTES"), "method") == false)) {
                // line 84
                echo "                    ";
                if ((((($this->getAttribute($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idEstado"), "id") != 5) && ($this->getAttribute($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idEstado"), "id") != 7)) && ($this->getAttribute($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idEstado"), "id") != 8)) && ($this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "fecha") >= twig_date_modify_filter($this->env, (isset($context["fechaActual"]) ? $context["fechaActual"] : $this->getContext($context, "fechaActual")), "-1 day")))) {
                    // line 85
                    echo "                        <span class=\"glyphicon glyphicon-trash mouse-pointer\" citaEliminar=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "id"), "html", null, true);
                    echo "\" fechaCita='";
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "fecha"), "d/m/Y"), "html", null, true);
                    echo "'
                        medico=\"";
                    // line 86
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idEmpleado"), "html", null, true);
                    echo "\"
                        especialidad=\"";
                    // line 87
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "idAtenAreaModEstab"), "html", null, true);
                    echo "\"
                        style=\"font-size:20px;padding-left:10px;\" role=\"trash\"></span>
                    ";
                }
                // line 90
                echo "                ";
            }
            // line 91
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("citasgetcomprobante", array("id" => $this->getAttribute((isset($context["cita"]) ? $context["cita"] : $this->getContext($context, "cita")), "id"))), "html", null, true);
            echo "\" target=\"_blank\" class=\"\">
                    <span class=\"glyphicon glyphicon-print mouse-pointer\"
                    style=\"font-size:20px;padding-left:10px;\"></span></a>
            </td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cita'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 97
        echo "    </tbody>
</table>
";
    }

    // line 2
    public function block_javascripts($context, array $blocks = array())
    {
        // line 3
        echo "    <script type=\"text/javascript\">
        jQuery(document).ready(function (\$) {
            var tablaResultados=\$('#tablaResultados');
            var opcionesTable=setDataTableOptions(tablaResultados);
            opcionesTable['bSort']=false;
            opcionesTable['iDisplayLength']=15;
            opcionesTable['bFilter']=false;
            opcionesTable['sDom']='<\"top\"flp>rt<\"bottom\"i>';
            opcionesTable['aLengthMenu']= [[15,20], [15,20]];
            tablaResultados.DataTable(opcionesTable);

            //citasbuildcomprobante
            \$('.glyphicon-print').on('click',function(){
              var id=\$(this).attr('citaImprimir');
            });

            \$('.glyphicon-trash').on('click',function(){
                var id=\$(this).attr('citaEliminar');
                var medico=\$(this).attr('medico');
                var fechaCita=\$(this).attr('fechaCita');
                var especialidad=\$(this).attr('especialidad');
                var title='Confirmación';
                var paciente=\$('#numExpNomPac').select2('data').text.split(' - ');
                var body=\"¿Esta seguro que desea eliminar la Cita de <strong>\"+paciente[1]+\"</strong> en la especialidad <strong>\"+especialidad
                        +\"</strong> con el médico <strong>\"+medico+\"</strong>\"
                        + \" en la fecha <strong>\"+fechaCita+\"</strong>\";
                var width='750px'
                var clase='dialog-warning';
                var arrayBtns = [
                    {
                        text: 'Confirmar', click: function() {
                            \$(this).dialog('close');
                            \$('#idCita').val(id);
                            \$('body form#eliminar_cita').submit();
                        }
                    },
                    {
                        text: 'Cancelar', click: function( event, ui) {
                            \$(this).dialog('close');
                        }
                    }
                ];
                showDialogMsg(title, body, clase, '', arrayBtns, false, width, true);
            });
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:CitasMedicas:carga_citas.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1720 => 1573,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1480,  1609 => 1479,  1594 => 1472,  1590 => 1471,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 922,  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 697,  803 => 630,  606 => 447,  691 => 492,  655 => 481,  484 => 412,  552 => 439,  709 => 255,  397 => 168,  392 => 251,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 988,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 767,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 759,  992 => 720,  962 => 697,  960 => 696,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 279,  419 => 293,  639 => 468,  611 => 386,  538 => 431,  646 => 307,  642 => 286,  544 => 434,  541 => 204,  517 => 192,  797 => 489,  752 => 533,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 430,  519 => 425,  416 => 221,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 416,  775 => 413,  762 => 540,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 203,  534 => 348,  530 => 428,  521 => 194,  489 => 179,  483 => 206,  394 => 217,  396 => 206,  345 => 189,  476 => 174,  386 => 162,  364 => 235,  234 => 158,  595 => 326,  589 => 267,  586 => 436,  562 => 505,  556 => 274,  506 => 103,  498 => 417,  492 => 274,  473 => 277,  458 => 121,  399 => 209,  352 => 219,  346 => 125,  328 => 179,  880 => 699,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 244,  573 => 516,  567 => 507,  520 => 247,  481 => 335,  475 => 275,  472 => 172,  466 => 227,  441 => 346,  438 => 189,  432 => 230,  429 => 222,  395 => 400,  382 => 248,  378 => 211,  367 => 115,  357 => 222,  348 => 190,  334 => 207,  286 => 169,  205 => 106,  297 => 189,  218 => 108,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 561,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 540,  705 => 539,  701 => 261,  690 => 302,  687 => 301,  671 => 262,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 281,  609 => 273,  602 => 230,  591 => 439,  571 => 419,  499 => 268,  488 => 273,  389 => 235,  223 => 143,  14 => 2,  306 => 117,  303 => 159,  300 => 98,  292 => 95,  280 => 108,  12 => 36,  624 => 282,  620 => 223,  612 => 232,  601 => 379,  599 => 441,  580 => 265,  574 => 263,  559 => 504,  526 => 427,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 172,  401 => 119,  391 => 216,  369 => 228,  333 => 95,  329 => 93,  307 => 192,  287 => 152,  195 => 140,  178 => 108,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 460,  663 => 484,  660 => 194,  657 => 482,  650 => 238,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 221,  603 => 229,  600 => 178,  594 => 440,  588 => 372,  584 => 158,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 156,  513 => 244,  479 => 334,  468 => 163,  451 => 307,  448 => 195,  424 => 296,  418 => 222,  410 => 151,  376 => 109,  373 => 209,  340 => 209,  326 => 212,  261 => 138,  118 => 70,  200 => 119,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 991,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 768,  1056 => 766,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 536,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 712,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 563,  785 => 560,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 258,  712 => 437,  710 => 502,  707 => 501,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 241,  654 => 357,  649 => 308,  643 => 306,  640 => 226,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 501,  550 => 255,  527 => 153,  515 => 191,  512 => 423,  509 => 422,  503 => 419,  496 => 282,  493 => 415,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 214,  408 => 173,  388 => 292,  371 => 136,  363 => 133,  350 => 191,  342 => 274,  335 => 182,  316 => 16,  290 => 154,  276 => 102,  266 => 180,  263 => 102,  255 => 87,  245 => 153,  207 => 104,  194 => 92,  184 => 118,  76 => 34,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 491,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 219,  627 => 236,  622 => 369,  619 => 212,  616 => 276,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 368,  572 => 204,  566 => 324,  547 => 435,  545 => 253,  542 => 156,  533 => 429,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 163,  443 => 162,  431 => 251,  428 => 250,  425 => 156,  422 => 338,  412 => 152,  406 => 111,  390 => 164,  383 => 161,  377 => 246,  375 => 210,  372 => 234,  370 => 208,  359 => 204,  356 => 132,  353 => 131,  349 => 220,  336 => 272,  332 => 206,  330 => 122,  318 => 105,  313 => 119,  291 => 153,  190 => 98,  321 => 106,  295 => 154,  274 => 71,  242 => 118,  236 => 116,  70 => 19,  170 => 95,  288 => 176,  284 => 109,  279 => 134,  275 => 180,  256 => 171,  250 => 173,  237 => 129,  232 => 79,  222 => 123,  191 => 91,  153 => 73,  150 => 70,  563 => 188,  560 => 275,  558 => 195,  553 => 256,  549 => 438,  543 => 179,  537 => 176,  532 => 201,  528 => 199,  525 => 311,  523 => 195,  518 => 292,  514 => 339,  511 => 243,  508 => 188,  501 => 186,  491 => 288,  487 => 337,  460 => 240,  455 => 120,  449 => 164,  442 => 278,  439 => 133,  436 => 159,  433 => 185,  426 => 180,  420 => 220,  415 => 121,  411 => 174,  405 => 211,  403 => 149,  380 => 247,  366 => 285,  354 => 102,  331 => 198,  325 => 267,  320 => 265,  317 => 199,  311 => 262,  308 => 173,  304 => 191,  272 => 105,  267 => 91,  249 => 85,  216 => 146,  155 => 87,  146 => 69,  126 => 104,  188 => 119,  181 => 128,  161 => 79,  110 => 53,  124 => 80,  692 => 373,  683 => 282,  678 => 279,  676 => 488,  666 => 485,  661 => 407,  656 => 402,  652 => 376,  645 => 236,  641 => 352,  635 => 376,  631 => 463,  625 => 460,  615 => 453,  607 => 363,  597 => 163,  590 => 223,  583 => 435,  579 => 353,  577 => 420,  575 => 212,  569 => 514,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 139,  529 => 222,  524 => 344,  516 => 424,  510 => 78,  504 => 145,  500 => 418,  495 => 416,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 158,  421 => 223,  417 => 219,  400 => 148,  385 => 203,  361 => 207,  344 => 127,  339 => 273,  324 => 102,  310 => 118,  302 => 115,  296 => 96,  282 => 143,  259 => 151,  244 => 142,  231 => 123,  226 => 155,  215 => 107,  186 => 88,  152 => 103,  114 => 75,  104 => 50,  358 => 209,  351 => 130,  347 => 208,  343 => 188,  338 => 125,  327 => 203,  323 => 201,  319 => 176,  315 => 198,  301 => 204,  299 => 190,  293 => 111,  289 => 162,  281 => 182,  277 => 107,  271 => 157,  265 => 150,  262 => 68,  260 => 177,  257 => 137,  251 => 157,  248 => 139,  239 => 117,  228 => 156,  225 => 111,  213 => 70,  211 => 121,  197 => 118,  174 => 85,  148 => 70,  134 => 81,  127 => 57,  20 => 2,  270 => 150,  253 => 174,  233 => 127,  212 => 106,  210 => 103,  206 => 141,  202 => 114,  198 => 104,  192 => 116,  185 => 94,  180 => 118,  175 => 81,  172 => 106,  167 => 104,  165 => 108,  160 => 95,  137 => 65,  113 => 87,  100 => 42,  90 => 29,  81 => 34,  65 => 30,  129 => 82,  97 => 83,  77 => 24,  34 => 5,  53 => 13,  84 => 79,  58 => 18,  23 => 3,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 287,  427 => 226,  423 => 256,  413 => 220,  409 => 219,  407 => 247,  402 => 210,  398 => 401,  393 => 296,  387 => 249,  384 => 214,  381 => 236,  379 => 110,  374 => 137,  368 => 207,  365 => 119,  362 => 234,  360 => 223,  355 => 280,  341 => 126,  337 => 201,  322 => 266,  314 => 162,  312 => 174,  309 => 100,  305 => 204,  298 => 165,  294 => 142,  285 => 175,  283 => 151,  278 => 142,  268 => 176,  264 => 179,  258 => 175,  252 => 136,  247 => 133,  241 => 163,  229 => 135,  220 => 72,  214 => 155,  177 => 77,  169 => 83,  140 => 67,  132 => 83,  128 => 62,  107 => 42,  61 => 71,  273 => 185,  269 => 104,  254 => 99,  243 => 152,  240 => 130,  238 => 140,  235 => 139,  230 => 114,  227 => 112,  224 => 124,  221 => 152,  219 => 128,  217 => 150,  208 => 132,  204 => 138,  179 => 112,  159 => 71,  143 => 68,  135 => 97,  119 => 90,  102 => 85,  71 => 21,  67 => 18,  63 => 72,  59 => 14,  28 => 4,  94 => 42,  89 => 41,  85 => 26,  75 => 76,  68 => 29,  56 => 69,  87 => 27,  201 => 118,  196 => 95,  183 => 211,  171 => 84,  166 => 98,  163 => 76,  158 => 73,  156 => 72,  151 => 85,  142 => 84,  138 => 65,  136 => 65,  121 => 58,  117 => 52,  105 => 51,  91 => 38,  62 => 15,  49 => 30,  25 => 4,  21 => 2,  31 => 4,  38 => 64,  26 => 6,  24 => 13,  19 => 5,  93 => 83,  88 => 80,  78 => 77,  46 => 25,  44 => 13,  27 => 14,  79 => 20,  72 => 75,  69 => 74,  47 => 10,  40 => 65,  37 => 7,  22 => 50,  246 => 134,  157 => 97,  145 => 90,  139 => 90,  131 => 63,  123 => 73,  120 => 56,  115 => 55,  111 => 48,  108 => 59,  101 => 47,  98 => 43,  96 => 84,  83 => 39,  74 => 28,  66 => 73,  55 => 27,  52 => 68,  50 => 12,  43 => 24,  41 => 12,  35 => 6,  32 => 15,  29 => 3,  209 => 147,  203 => 119,  199 => 94,  193 => 94,  189 => 116,  187 => 113,  182 => 68,  176 => 100,  173 => 65,  168 => 98,  164 => 97,  162 => 107,  154 => 66,  149 => 163,  147 => 91,  144 => 3,  141 => 2,  133 => 64,  130 => 97,  125 => 58,  122 => 91,  116 => 69,  112 => 53,  109 => 86,  106 => 47,  103 => 41,  99 => 84,  95 => 39,  92 => 81,  86 => 38,  82 => 36,  80 => 25,  73 => 21,  64 => 29,  60 => 29,  57 => 32,  54 => 13,  51 => 26,  48 => 67,  45 => 66,  42 => 9,  39 => 8,  36 => 4,  33 => 7,  30 => 5,);
    }
}
