<?php

/* MinsalFarmaciaBundle:FarmRecetas:receta2.html.twig */
class __TwigTemplate_f9a3cf8e35392e79f9247cfb60fb02fd85ec237225d0346b5145c82e8910819f extends Twig_Template
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
        echo "<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
                border: 1px dashed #000;
                font-size:11px;
                border-collapse: separate;
                border-spacing: 10px 0px;
                height:460px;
            }
            .td-enca {
                text-align:center;
                font-size:15px;
            }
            label{
                font-weight: bold;
            }
            td {
               padding-left: 5px;
            }
            .td-medicamento{
                font-size: 15px;
            }
            .td-medicamento-detalle{
                font-size:  13px;
            }
            </style>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    </head>
    <body onload=\"subst()\">
    ";
        // line 32
        $context["i"] = 1;
        // line 33
        echo "    ";
        $context["twoxpage"] = 1;
        // line 34
        echo "    ";
        $context["aux"] = "";
        // line 35
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["objReceta"]) ? $context["objReceta"] : $this->getContext($context, "objReceta")));
        foreach ($context['_seq'] as $context["_key"] => $context["cuantamedicina"]) {
            // line 36
            echo "
    ";
            // line 37
            if (((isset($context["aux"]) ? $context["aux"] : $this->getContext($context, "aux")) != $this->getAttribute($this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "med"), "getIdmedicina"))) {
                // line 38
                echo "        ";
                $context["aux"] = $this->getAttribute($this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "med"), "getIdmedicina");
                // line 39
                echo "        ";
                $context["i"] = 1;
                // line 40
                echo "    ";
            }
            // line 41
            echo "

    <table width=\"100%\" >
        <tr>
            <td class =\"td-enca\" colspan=\"4\">
            <b><br/>
                ";
            // line 47
            echo twig_escape_filter($this->env, ("#" . $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "med"), "getIdreceta", array(), "method"), "numeroreceta")), "html", null, true);
            echo "
                ";
            // line 48
            echo twig_escape_filter($this->env, (((trim($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "med"), "getIdreceta", array(), "method"), "getIdestado", array(), "method")) === "R")) ? ("RECETA DEL DIA") : ((("<<" . "RECETA REPETITIVA") . ">>"))), "html", null, true);
            echo "
                ";
            // line 49
            echo twig_escape_filter($this->env, (((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) . "/") . $this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "cuantos")), "html", null, true);
            echo "<br/>
                ";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["idhistorialclinico"]) ? $context["idhistorialclinico"] : $this->getContext($context, "idhistorialclinico")), "getIdEstablecimiento"), "nombre"), "html", null, true);
            echo "
                ";
            // line 51
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["idhistorialclinico"]) ? $context["idhistorialclinico"] : $this->getContext($context, "idhistorialclinico")), "getIdEstablecimiento"), "getIdMunicipio"), "nombre"), "html", null, true);
            echo "
                <br/>Receta de Dispensaci&oacute;n a Paciente Consulta Externa<br/>
                Medicamento se despachara: ";
            // line 53
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "med"), "getIdEstablecimientoDespacha", array(), "method"), "html", null, true);
            echo "
            </b>
            </td>

        </tr>
        <tr>
            <td colspan=\"4\" style=\"font-size: 20px;text-align:right;\" colspan=\"2\"><label>No Expediente: </label><b>";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "numero"), "html", null, true);
            echo "</b></td>
        <tr>
            <td colspan=\"2\" style=\"font-size: 11px;border:solid 1px\" class=\"td-medicamento-detalle\" colspan=\"2\"><label>Fecha Entrega: </label><b>";
            // line 61
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_localized_date_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "med"), "getIdreceta", array(), "method"), "getFecha", array(), "method"), "full", "none", "es_SV")), "html", null, true);
            echo " </b></td>
            <td colspan=\"2\" class=\"td-medicamento-detalle\"><label>Horario: </label><b>";
            // line 62
            echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "med"), "getIdreceta", array(), "method"), "getIdRangohora", array(), "method");
            echo "</b></td>
        </tr>
        <tr>
            <td colspan=\"4\" class=\"td-medicamento-detalle\" ><label>Paciente:</label>
            ";
            // line 66
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "primerApellido"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "segundoApellido"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "apellidoCasada"), "html", null, true);
            echo ", ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "primerNombre"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "segundoNombre"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "tercerNombre"), "html", null, true);
            echo "   </td>
        </tr>
        <tr>
            <td colspan=\"2\" class=\"td-medicamento-detalle\"><label>Procedencia: </label>";
            // line 69
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "areaGeograficaDomicilio"), "html", null, true);
            echo "
            <td colspan=\"2\" class=\"td-medicamento-detalle\"><label>Edad: </label>";
            // line 70
            echo twig_escape_filter($this->env, (isset($context["edad"]) ? $context["edad"] : $this->getContext($context, "edad")), "html", null, true);
            echo "</td>
        </tr>
        <tr>
            <td colspan=\"2\" class=\"td-medicamento-detalle\"><label>Sexo: </label>";
            // line 73
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "idSexo"), "html", null, true);
            echo "</td>
            <td colspan=\"2\" class=\"td-medicamento-detalle\"><label>Fecha consulta: </label>";
            // line 74
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["idhistorialclinico"]) ? $context["idhistorialclinico"] : $this->getContext($context, "idhistorialclinico")), "fechaconsulta"), "d-m-Y"), "html", null, true);
            echo "</td>
        </tr>
        <tr >
            <td class=\"td-medicamento\" colspan=\"4\"><label>Medicamento: </label>";
            // line 77
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "med"), "getIdmedicina", array(), "method"), "nombre"), "html", null, true);
            echo ", ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "med"), "getIdmedicina", array(), "method"), "concentracion"), "html", null, true);
            echo ", ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "med"), "getIdmedicina", array(), "method"), "formafarmaceutica"), "html", null, true);
            echo "</td>
        </tr>
        <tr>
            <td class=\"td-medicamento\" colspan=\"4\"><label>Dosis: </label>";
            // line 80
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "med"), "dosis"), "html", null, true);
            echo "</td>
        </tr>
        <tr>
            <td style=\"font-size: 20px;\" class=\"td-medicamento\" colspan=\"4\"><label>Cantidad: </label>";
            // line 83
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["cuantamedicina"]) ? $context["cuantamedicina"] : $this->getContext($context, "cuantamedicina")), "med"), "totalMedicamento"), "html", null, true);
            echo "</td>
        </tr>
        <tr><td><br/></td></tr>
        <tr>
            ";
            // line 87
            $context["codeqr"] = (((($this->getAttribute($this->getAttribute((isset($context["idhistorialclinico"]) ? $context["idhistorialclinico"] : $this->getContext($context, "idhistorialclinico")), "getIdEmpleado"), "nombreempleado") . "
 J.V.P.M  No. ") . (((!(null === $this->getAttribute($this->getAttribute((isset($context["idhistorialclinico"]) ? $context["idhistorialclinico"] : $this->getContext($context, "idhistorialclinico")), "getIdEmpleado"), "numeroJuntaVigilancia")))) ? ($this->getAttribute($this->getAttribute((isset($context["idhistorialclinico"]) ? $context["idhistorialclinico"] : $this->getContext($context, "idhistorialclinico")), "getIdEmpleado"), "numeroJuntaVigilancia")) : ("-"))) . "
") . $this->getAttribute($this->getAttribute((isset($context["idhistorialclinico"]) ? $context["idhistorialclinico"] : $this->getContext($context, "idhistorialclinico")), "idAtenAreaModEstab"), "getNombreConsulta", array(), "method"));
            // line 88
            echo "            <td style=\"text-align: center\"><img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('endroid_qrcode')->qrcodeDataUriFunction(("" . (isset($context["codeqr"]) ? $context["codeqr"] : $this->getContext($context, "codeqr"))), 500, 10, null, null, null, null), "html", null, true);
            echo "\" height = '60px'/></td>
            <td class=\"td-medicamento-detalle\" style=\"text-align: center\"><label><br/><br/>";
            // line 89
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["idhistorialclinico"]) ? $context["idhistorialclinico"] : $this->getContext($context, "idhistorialclinico")), "idAtenAreaModEstab"), "getNombreConsulta", array(), "method"), "html", null, true);
            echo "</label></td>
            <td class=\"td-medicamento-detalle\"><br/><label>F. _______________<br/>";
            // line 90
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["idhistorialclinico"]) ? $context["idhistorialclinico"] : $this->getContext($context, "idhistorialclinico")), "getIdEmpleado"), "nombreempleado"), "html", null, true);
            echo "</label></td>
            <td class=\"td-medicamento-detalle\" style=\"text-align: center\"><br/> <label>__________________<br/>Sello del Medico</label></td>
        </tr>
         <tr>
            <td colspan=\"4\" style=\"font-size:9px;\">
                Nota: Farmacia dispensara en base a la dosis, hasta un maximo de 30 días.
            </td>
        </tr>
        <tr>
            <td style=\"text-align: center\" class=\"td-medicamento-detalle\"><br/><br/><br/><br/><label>_________________<br/>Cantidad Despachada</label> </td>
            <td colspan=\"2\" style=\"text-align: center\" class=\"td-medicamento-detalle\"><br/><br/><br/><br/><label>__________________<br/>Auxiliar de Farmacia</label> </td>
            <td style=\"text-align: center\" class=\"td-medicamento-detalle\"><br/><br/><br/><br/><label>_________________<br/>Sello de Despacho</label> </td>
        </tr>
    </table>

    ";
            // line 105
            $context["i"] = ((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) + 1);
            // line 106
            echo "    ";
            $context["twoxpage"] = ((isset($context["twoxpage"]) ? $context["twoxpage"] : $this->getContext($context, "twoxpage")) + 1);
            // line 107
            echo "
    ";
            // line 108
            if (((isset($context["twoxpage"]) ? $context["twoxpage"] : $this->getContext($context, "twoxpage")) > 2)) {
                // line 109
                echo "        <br>
         <p style=\"page-break-after: always;\"></p>
        ";
                // line 111
                $context["twoxpage"] = 1;
                // line 112
                echo "    ";
            }
            // line 113
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cuantamedicina'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 114
        echo "    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "MinsalFarmaciaBundle:FarmRecetas:receta2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  2118 => 1610,  2115 => 1609,  2110 => 1604,  2107 => 1603,  1982 => 1480,  1978 => 1478,  1967 => 1476,  1963 => 1475,  1959 => 1473,  1957 => 1472,  1834 => 1351,  1831 => 1350,  1820 => 1347,  1817 => 1346,  1812 => 1345,  1810 => 1344,  1785 => 1322,  1782 => 1321,  1779 => 1320,  1774 => 1317,  1771 => 1316,  1763 => 1291,  1760 => 1290,  1755 => 1617,  1751 => 1615,  1749 => 1609,  1744 => 1607,  1741 => 1606,  1739 => 1603,  1736 => 1602,  1734 => 1320,  1731 => 1319,  1729 => 1316,  1726 => 1315,  1717 => 1311,  1715 => 1310,  1701 => 1299,  1697 => 1298,  1693 => 1297,  1690 => 1296,  1688 => 1290,  1685 => 1289,  1681 => 1288,  1674 => 1286,  1671 => 1285,  1667 => 1284,  1657 => 1279,  1654 => 1278,  1651 => 1277,  1648 => 1276,  1643 => 1272,  1630 => 1262,  1597 => 1240,  1592 => 1237,  1580 => 1229,  1508 => 1159,  1497 => 1157,  1493 => 1156,  1470 => 1136,  1208 => 877,  1191 => 863,  1156 => 830,  1140 => 816,  1107 => 786,  1091 => 772,  1089 => 771,  684 => 459,  651 => 444,  1229 => 998,  1226 => 997,  1216 => 993,  1214 => 992,  1210 => 990,  1201 => 987,  1197 => 985,  1176 => 974,  1135 => 936,  1068 => 872,  1062 => 833,  1059 => 832,  1043 => 980,  1038 => 978,  1035 => 977,  1028 => 832,  1011 => 823,  1006 => 821,  988 => 816,  985 => 815,  971 => 809,  965 => 807,  938 => 789,  930 => 785,  886 => 757,  1119 => 855,  1116 => 854,  1075 => 869,  1054 => 829,  1050 => 861,  1034 => 856,  1031 => 854,  1025 => 831,  1023 => 828,  1020 => 827,  1017 => 849,  1000 => 687,  987 => 840,  972 => 833,  945 => 816,  943 => 792,  794 => 670,  770 => 661,  759 => 657,  723 => 628,  854 => 585,  850 => 584,  838 => 536,  826 => 569,  755 => 541,  750 => 539,  741 => 533,  704 => 517,  736 => 544,  706 => 519,  702 => 516,  1720 => 1312,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1247,  1609 => 1479,  1594 => 1472,  1590 => 1236,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 841,  1673 => 1259,  1670 => 1258,  1663 => 1282,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1230,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 697,  803 => 630,  606 => 447,  691 => 492,  655 => 481,  484 => 412,  552 => 472,  709 => 520,  397 => 337,  392 => 198,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 995,  1207 => 989,  1199 => 859,  1188 => 857,  1184 => 980,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 866,  1052 => 764,  1045 => 1000,  1042 => 761,  1037 => 857,  992 => 817,  962 => 697,  960 => 826,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 219,  462 => 168,  445 => 339,  419 => 204,  639 => 468,  611 => 386,  538 => 444,  646 => 307,  642 => 492,  544 => 434,  541 => 204,  517 => 427,  797 => 671,  752 => 533,  748 => 458,  681 => 553,  677 => 552,  630 => 437,  618 => 172,  535 => 397,  519 => 425,  416 => 215,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 974,  1030 => 973,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 820,  999 => 518,  995 => 818,  983 => 509,  977 => 507,  974 => 810,  968 => 808,  954 => 800,  948 => 494,  922 => 779,  916 => 480,  913 => 479,  911 => 774,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 535,  824 => 589,  781 => 552,  775 => 550,  762 => 544,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 406,  534 => 348,  530 => 393,  521 => 389,  489 => 179,  483 => 376,  394 => 305,  396 => 306,  345 => 243,  476 => 373,  386 => 197,  364 => 235,  234 => 113,  595 => 326,  589 => 450,  586 => 451,  562 => 505,  556 => 474,  506 => 221,  498 => 417,  492 => 380,  473 => 277,  458 => 121,  399 => 199,  352 => 268,  346 => 187,  328 => 181,  880 => 699,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 489,  573 => 516,  567 => 507,  520 => 394,  481 => 375,  475 => 409,  472 => 408,  466 => 227,  441 => 338,  438 => 337,  432 => 380,  429 => 222,  395 => 400,  382 => 196,  378 => 249,  367 => 193,  357 => 168,  348 => 165,  334 => 160,  286 => 143,  205 => 90,  297 => 169,  218 => 144,  940 => 351,  932 => 786,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 758,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 579,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 667,  784 => 293,  782 => 665,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 534,  740 => 456,  734 => 530,  731 => 392,  728 => 528,  725 => 251,  719 => 257,  716 => 438,  714 => 522,  711 => 540,  705 => 539,  701 => 261,  690 => 302,  687 => 460,  671 => 490,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 470,  609 => 419,  602 => 230,  591 => 453,  571 => 419,  499 => 382,  488 => 273,  389 => 235,  223 => 105,  14 => 4,  306 => 227,  303 => 149,  300 => 148,  292 => 145,  280 => 141,  12 => 36,  624 => 282,  620 => 223,  612 => 467,  601 => 379,  599 => 412,  580 => 265,  574 => 397,  559 => 475,  526 => 429,  497 => 173,  485 => 304,  463 => 196,  447 => 340,  404 => 310,  401 => 185,  391 => 216,  369 => 172,  333 => 234,  329 => 266,  307 => 237,  287 => 236,  195 => 139,  178 => 78,  956 => 271,  953 => 822,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 610,  914 => 775,  912 => 336,  909 => 773,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 587,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 564,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 662,  765 => 246,  760 => 621,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 504,  663 => 484,  660 => 447,  657 => 446,  650 => 483,  647 => 237,  644 => 190,  632 => 438,  629 => 186,  626 => 482,  603 => 229,  600 => 178,  594 => 454,  588 => 372,  584 => 488,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 228,  513 => 386,  479 => 388,  468 => 353,  451 => 287,  448 => 389,  424 => 334,  418 => 344,  410 => 202,  376 => 191,  373 => 257,  340 => 184,  326 => 222,  261 => 146,  118 => 60,  200 => 125,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 984,  1192 => 983,  1190 => 982,  1187 => 981,  1179 => 975,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 899,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 871,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 748,  1056 => 864,  1053 => 292,  1051 => 828,  1048 => 763,  1040 => 858,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 824,  1012 => 271,  1009 => 822,  1004 => 266,  982 => 839,  979 => 812,  976 => 811,  973 => 662,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 802,  955 => 823,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 788,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 766,  897 => 329,  894 => 762,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 537,  833 => 439,  830 => 303,  828 => 682,  825 => 681,  817 => 567,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 557,  793 => 556,  785 => 666,  783 => 177,  772 => 172,  769 => 171,  767 => 660,  764 => 659,  756 => 460,  753 => 540,  751 => 401,  739 => 156,  729 => 233,  724 => 426,  721 => 525,  712 => 521,  710 => 502,  707 => 501,  699 => 142,  697 => 513,  696 => 204,  695 => 466,  694 => 512,  689 => 137,  680 => 457,  675 => 199,  662 => 217,  658 => 500,  654 => 484,  649 => 308,  643 => 306,  640 => 491,  638 => 440,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 434,  550 => 465,  527 => 392,  515 => 191,  512 => 224,  509 => 385,  503 => 427,  496 => 423,  493 => 415,  478 => 374,  467 => 370,  456 => 288,  450 => 212,  414 => 203,  408 => 312,  388 => 292,  371 => 173,  363 => 170,  350 => 245,  342 => 185,  335 => 268,  316 => 232,  290 => 154,  276 => 176,  266 => 204,  263 => 146,  255 => 209,  245 => 116,  207 => 138,  194 => 91,  184 => 148,  76 => 40,  810 => 238,  804 => 662,  801 => 560,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 663,  774 => 249,  771 => 412,  768 => 547,  766 => 546,  761 => 658,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 509,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 443,  627 => 236,  622 => 481,  619 => 212,  616 => 468,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 399,  578 => 448,  572 => 204,  566 => 393,  547 => 435,  545 => 463,  542 => 462,  533 => 237,  531 => 154,  507 => 241,  505 => 214,  502 => 220,  477 => 232,  471 => 164,  465 => 214,  454 => 269,  446 => 388,  443 => 210,  431 => 208,  428 => 189,  425 => 188,  422 => 205,  412 => 152,  406 => 201,  390 => 304,  383 => 193,  377 => 194,  375 => 249,  372 => 200,  370 => 208,  359 => 251,  356 => 277,  353 => 276,  349 => 188,  336 => 272,  332 => 267,  330 => 233,  318 => 233,  313 => 192,  291 => 218,  190 => 90,  321 => 229,  295 => 146,  274 => 152,  242 => 113,  236 => 114,  70 => 38,  170 => 87,  288 => 217,  284 => 56,  279 => 134,  275 => 180,  256 => 171,  250 => 2,  237 => 111,  232 => 159,  222 => 108,  191 => 129,  153 => 70,  150 => 62,  563 => 188,  560 => 435,  558 => 195,  553 => 256,  549 => 438,  543 => 425,  537 => 458,  532 => 396,  528 => 199,  525 => 311,  523 => 441,  518 => 388,  514 => 392,  511 => 243,  508 => 424,  501 => 422,  491 => 288,  487 => 411,  460 => 195,  455 => 344,  449 => 164,  442 => 190,  439 => 226,  436 => 336,  433 => 345,  426 => 180,  420 => 220,  415 => 339,  411 => 313,  405 => 269,  403 => 149,  380 => 260,  366 => 171,  354 => 190,  331 => 182,  325 => 180,  320 => 155,  317 => 178,  311 => 152,  308 => 151,  304 => 207,  272 => 183,  267 => 189,  249 => 143,  216 => 143,  155 => 95,  146 => 54,  126 => 62,  188 => 128,  181 => 109,  161 => 72,  110 => 105,  124 => 45,  692 => 465,  683 => 282,  678 => 279,  676 => 488,  666 => 448,  661 => 488,  656 => 499,  652 => 497,  645 => 442,  641 => 441,  635 => 489,  631 => 475,  625 => 460,  615 => 453,  607 => 363,  597 => 455,  590 => 223,  583 => 435,  579 => 353,  577 => 398,  575 => 212,  569 => 394,  565 => 361,  555 => 257,  548 => 353,  540 => 459,  536 => 405,  529 => 222,  524 => 344,  516 => 387,  510 => 78,  504 => 145,  500 => 386,  495 => 381,  490 => 218,  486 => 377,  482 => 217,  470 => 216,  464 => 242,  459 => 346,  452 => 286,  434 => 279,  421 => 341,  417 => 219,  400 => 267,  385 => 203,  361 => 252,  344 => 238,  339 => 269,  324 => 102,  310 => 165,  302 => 240,  296 => 38,  282 => 178,  259 => 139,  244 => 204,  231 => 108,  226 => 151,  215 => 129,  186 => 126,  152 => 113,  114 => 86,  104 => 52,  358 => 191,  351 => 166,  347 => 275,  343 => 163,  338 => 241,  327 => 265,  323 => 156,  319 => 220,  315 => 177,  301 => 235,  299 => 170,  293 => 205,  289 => 144,  281 => 182,  277 => 140,  271 => 153,  265 => 169,  262 => 170,  260 => 211,  257 => 145,  251 => 181,  248 => 114,  239 => 112,  228 => 107,  225 => 106,  213 => 90,  211 => 140,  197 => 140,  174 => 76,  148 => 56,  134 => 49,  127 => 46,  20 => 1,  270 => 166,  253 => 144,  233 => 109,  212 => 106,  210 => 116,  206 => 152,  202 => 142,  198 => 140,  192 => 87,  185 => 83,  180 => 146,  175 => 103,  172 => 118,  167 => 57,  165 => 73,  160 => 58,  137 => 66,  113 => 64,  100 => 51,  90 => 26,  81 => 27,  65 => 36,  129 => 47,  97 => 39,  77 => 21,  34 => 74,  53 => 32,  84 => 94,  58 => 11,  23 => 4,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 213,  453 => 284,  444 => 185,  440 => 275,  437 => 209,  435 => 231,  430 => 344,  427 => 206,  423 => 256,  413 => 338,  409 => 219,  407 => 201,  402 => 199,  398 => 184,  393 => 265,  387 => 303,  384 => 302,  381 => 236,  379 => 110,  374 => 137,  368 => 255,  365 => 119,  362 => 234,  360 => 169,  355 => 280,  341 => 270,  337 => 183,  322 => 179,  314 => 153,  312 => 176,  309 => 175,  305 => 174,  298 => 147,  294 => 238,  285 => 179,  283 => 142,  278 => 217,  268 => 173,  264 => 188,  258 => 210,  252 => 166,  247 => 1,  241 => 141,  229 => 138,  220 => 107,  214 => 147,  177 => 61,  169 => 77,  140 => 21,  132 => 48,  128 => 114,  107 => 69,  61 => 12,  273 => 185,  269 => 214,  254 => 199,  243 => 140,  240 => 176,  238 => 192,  235 => 153,  230 => 111,  227 => 101,  224 => 151,  221 => 119,  219 => 174,  217 => 118,  208 => 132,  204 => 142,  179 => 80,  159 => 73,  143 => 120,  135 => 49,  119 => 43,  102 => 45,  71 => 15,  67 => 88,  63 => 15,  59 => 34,  28 => 3,  94 => 9,  89 => 46,  85 => 25,  75 => 17,  68 => 37,  56 => 33,  87 => 47,  201 => 89,  196 => 88,  183 => 135,  171 => 100,  166 => 131,  163 => 74,  158 => 93,  156 => 57,  151 => 55,  142 => 52,  138 => 50,  136 => 70,  121 => 18,  117 => 59,  105 => 32,  91 => 48,  62 => 87,  49 => 18,  25 => 69,  21 => 3,  31 => 33,  38 => 16,  26 => 2,  24 => 13,  19 => 1,  93 => 52,  88 => 48,  78 => 18,  46 => 18,  44 => 5,  27 => 70,  79 => 41,  72 => 91,  69 => 37,  47 => 6,  40 => 12,  37 => 7,  22 => 68,  246 => 205,  157 => 71,  145 => 68,  139 => 118,  131 => 115,  123 => 112,  120 => 63,  115 => 108,  111 => 63,  108 => 53,  101 => 34,  98 => 36,  96 => 29,  83 => 63,  74 => 23,  66 => 13,  55 => 10,  52 => 32,  50 => 11,  43 => 10,  41 => 4,  35 => 34,  32 => 15,  29 => 7,  209 => 145,  203 => 130,  199 => 92,  193 => 130,  189 => 127,  187 => 149,  182 => 117,  176 => 83,  173 => 133,  168 => 99,  164 => 99,  162 => 130,  154 => 124,  149 => 69,  147 => 54,  144 => 61,  141 => 67,  133 => 66,  130 => 56,  125 => 113,  122 => 61,  116 => 62,  112 => 40,  109 => 54,  106 => 42,  103 => 51,  99 => 50,  95 => 49,  92 => 49,  86 => 95,  82 => 24,  80 => 93,  73 => 39,  64 => 23,  60 => 35,  57 => 34,  54 => 33,  51 => 78,  48 => 77,  45 => 76,  42 => 5,  39 => 4,  36 => 2,  33 => 15,  30 => 72,);
    }
}
