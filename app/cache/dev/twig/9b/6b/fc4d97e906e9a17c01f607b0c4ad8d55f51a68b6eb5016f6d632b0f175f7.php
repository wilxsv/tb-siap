<?php

/* MinsalCitasBundle:CitCitasProcedimientos:detalle_agenda.html.twig */
class __TwigTemplate_9b6bfc4d97e906e9a17c01f607b0c4ad8d55f51a68b6eb5016f6d632b0f175f7 extends Twig_Template
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
    function getAgendaProcedimientoData() {
        var idAreaModEstab      = \"0\";
        var nombreAreaModEstab  = \"\";
        var idProcedimiento     = \"0\";
        var nombreProcedimiento = \"\";

        if(jQuery('#idProcedimientoEstablecimiento').select2('data') != null) {
            idProcedimiento     = jQuery('#idProcedimientoEstablecimiento').select2('val');
            nombreProcedimiento = jQuery('#idProcedimientoEstablecimiento').select2('data').text;
        }

        ";
        // line 20
        if ((isset($context["superAdmin"]) ? $context["superAdmin"] : $this->getContext($context, "superAdmin"))) {
            // line 21
            echo "            if(jQuery('#idAreaModEstab').select2('data') != null) {
                idAreaModEstab     = jQuery('#idAreaModEstab').select2('val');
                nombreAreaModEstab = jQuery('#idAreaModEstab').select2('data').text;
            }
        ";
        } else {
            // line 26
            echo "            var data = getAreaModEstabDeEmpleado('";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "getId", array(), "method"), "html", null, true);
            echo "');

            idAreaModEstab     = data.idAreaModEstab;
            nombreAreaModEstab = data.nombreAreaModEstab;
        ";
        }
        // line 31
        echo "
        return { 'idProcedimiento': idProcedimiento, 'nombreProcedimiento': nombreProcedimiento, 'idAreaModEstab': idAreaModEstab, 'nombreAreaModEstab': nombreAreaModEstab };
    }

    function obtenerAreaModEstabDeEmpleado(idEmpleado) {
        var result = [];

        jQuery.ajax({
            url: Routing.generate(\"get_area_mod_estab_de_empleado\"),
            data: { 'idEmpleado': idEmpleado },
            async: false,
            dataType: 'json',
            success: function(data) {
                result = data;
            }
        });

        return result;
    }

    function getAreaModEstabDeEmpleado(idEmpleado) {
        var data  = obtenerAreaModEstabDeEmpleado(idEmpleado);
        var count = Object.keys(data).length;
        var idAreaModEstab     = '0';
        var nombreAreaModEstab = '';

        if( count > 0 ) {
            if( count === 1 ) {
                idAreaModEstab     = data[0].id;
                nombreAreaModEstab = data[0].nombreModalidad + ' - ' + data[0].nombreAreaAtencion + ( data[0].nombreServicioExterno ? ' - ' + data[0].nombreServicioExterno : '' ) ;
            } else {
                if(jQuery('#idAreaModEstab').select2('data') != null) {
                    idAreaModEstab     = jQuery('#idAreaModEstab').select2('val');
                    nombreAreaModEstab = jQuery('#idAreaModEstab').select2('data').text;
                }
            }
        } else {
            console.error('Error el empleado no tiene asociado ninguna area de atencion');
        }

        return { 'idAreaModEstab': idAreaModEstab, 'nombreAreaModEstab': nombreAreaModEstab };
    }


    /**********************************************************************
    * FUNCION QUE GENERA LA AGENDA MEDICA, CON LOS PACIENTES ORDINARIOS,  *
    * AGREGADOS SEGÚN SEA EL CASO.                                        *
    * PARAMETERS: Contiene la url para obtener los pacientes y la fecha a *
    * efectuar la evaluación
    ***********************************************************************/
    function buildDetailAgendaMedica(parameters) {
        var content      = \"\";
        var detalle      = [];
        var ordinarios   = \"\";
        var agregados    = \"\";
        var procData     = getAgendaProcedimientoData();
        var count        = 0;

        jQuery.ajax({
            url: parameters['url'],
            async: false,
            dataType: 'json',
            success: function(data) {
                detalle['ordinarios'] = data.ordinarios;
                detalle['agregados']  = data.agregados;
            }
        });

        if (detalle['ordinarios'].length == 0) {
            ordinarios = '<tr><td colspan=\"";
        // line 100
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") == "admin_minsal_citas_citcitasdia_agenda_dia")) {
            echo "5";
        } else {
            echo "6";
        }
        echo "\"><span class=\"disabled-label\">No hay resultados para mostrar...</span></td></tr>';
        } else {
            count = 0;
            jQuery.each(detalle['ordinarios'], function(key, value) {
                count += 1;
                ordinarios = ordinarios + '\\
                    <tr>'+
                        '<td>' + count + '</td>'+
                        ";
        // line 108
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") == "admin_minsal_citas_citcitasdia_agenda_dia")) {
            // line 109
            echo "                            '<td><a ' + ( value.numeroTemporal ? ('onClick=\"showDialogMsg(\\'Expediente Temporal\\',\\'' + expTemporalMsg + '\\',\\'dialog-error\\');\" href=\"#\"') : 'href=\"";
            echo $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_create");
            echo "?id_expediente='+value.idExpediente+'&id_empleado='+medicData.idEmpleado+'&id_aten_area_mod_estab='+medicData.idEmpleadoEspecialidadEstab+'&id_cita='+value.idCita+'\"' ) + '>' + value.codExpediente + '</a></td>'+
                        ";
        } else {
            // line 111
            echo "                            '<td>' + value.codExpediente + '</td>'+
                        ";
        }
        // line 113
        echo "                        '<td>' + value.numeroDocumentoIdentidadPaciente+ '</td>'+
                        '<td>' + value.nombrePaciente+ '</td>'+
                        '<td>' + value.nombreEstado+ '</td>'+
                        ";
        // line 116
        if (((!($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") === "admin_minsal_citas_citcitasdia_agenda_dia")) && (!($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") === "consulta_recibida")))) {
            // line 117
            echo "                            '<td><a href=\"";
            echo $this->env->getExtension('routing')->getUrl("procedimientosgetcomprobante");
            echo "?id='+value.idCita+'\" target=\"_blank\" class=\"btn btn-info\"><span class=\"fa fa-print\"> Imprimir</span></a></td>' +
                        ";
        }
        // line 119
        echo "                    '</tr>';
            });
        }

        if (detalle['agregados'].length == 0) {
            agregados = '<tr><td colspan=\"";
        // line 124
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") == "admin_minsal_citas_citcitasdia_agenda_dia")) {
            echo "5";
        } else {
            echo "6";
        }
        echo "\"><span class=\"disabled-label\">No hay resultados para mostrar...</span></td></tr>';
        } else {
            ";
        // line 126
        if ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") == "admin_minsal_citas_citcitasdia_agenda_dia") || ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "attributes"), "get", array(0 => "_route"), "method") == "consulta_recibida"))) {
            // line 127
            echo "                ";
            $context["citCitasDia"] = true;
        } else {
            $context["citCitasDia"] = false;
            // line 128
            echo "            ";
        }
        // line 129
        echo "            count = 0;
            jQuery.each(detalle['agregados'], function(key, value) {
                count += 1;
                agregados = agregados + '\\
                    <tr>'+
                        '<td>' + count + '</td>'+
                        ";
        // line 135
        if ((isset($context["citCitasDia"]) ? $context["citCitasDia"] : $this->getContext($context, "citCitasDia"))) {
            // line 136
            echo "                            '<td><a ' + ( value.numeroTemporal ? ('onClick=\"showDialogMsg(\\'Expediente Temporal\\',\\'' + expTemporalMsg + '\\',\\'dialog-error\\');\" href=\"#\"') : 'href=\"";
            echo $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_create");
            echo "?id_expediente='+value.idExpediente+'&id_empleado='+medicData.idEmpleado+'&id_aten_area_mod_estab='+medicData.idEmpleadoEspecialidadEstab+'&id_cita='+value.idCita+'\"' ) + '>' + value.codExpediente + '</a></td>'+
                        ";
        } else {
            // line 138
            echo "                            '<td>' + value.codExpediente + '</td>'+
                        ";
        }
        // line 140
        echo "                        '<td>' + value.numeroDocumentoIdentidadPaciente+ '</td>'+
                        '<td>' + value.nombrePaciente+ '</td>'+
                        '<td>' + value.nombreTipoCita+' - '+(value.idEstado === 6 ? 'Programada' : value.nombreEstado)+ '</td>'+
                        ";
        // line 143
        if (((isset($context["citCitasDia"]) ? $context["citCitasDia"] : $this->getContext($context, "citCitasDia")) === false)) {
            // line 144
            echo "                            '<td><a href=\"";
            echo $this->env->getExtension('routing')->getUrl("procedimientosgetcomprobante");
            echo "?id='+value.idCita+'\" target=\"_blank\" class=\"btn btn-info\"><span class=\"fa fa-print\"> Imprimir</span></a></td>' +
                        ";
        }
        // line 146
        echo "                    '</tr>';;
            });
        }

        content = '<div class=\"panel panel-primary\">\\
                        <div class=\"panel-heading\">Pacientes Citados</div>\\
                        <div class=\"panel-body\" id=\"pb-ordinarios\">\\
                            <div class=\"table-responsive\">\\
                                <table class=\"table table-striped table-hover table-condensed\">\\
                                    <thead>\\
                                        <tr><th>No.</th><th>Expediente</th><th>DUI</th><th>Nombre del paciente</th><th>Estado de la cita</th>";
        // line 156
        if (((isset($context["citCitasDia"]) ? $context["citCitasDia"] : $this->getContext($context, "citCitasDia")) === false)) {
            echo "<th>Comprobante</th>";
        }
        echo "</tr>\\
                                    </thead>\\
                                    <tbody>\\
                                        ' + ordinarios + '\\
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
        // line 171
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

        return { content: content };
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:CitCitasProcedimientos:detalle_agenda.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  854 => 585,  850 => 584,  838 => 575,  826 => 569,  755 => 541,  750 => 539,  741 => 533,  704 => 517,  736 => 544,  706 => 519,  702 => 516,  1720 => 1573,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1480,  1609 => 1479,  1594 => 1472,  1590 => 1471,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 922,  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 697,  803 => 630,  606 => 447,  691 => 492,  655 => 481,  484 => 412,  552 => 439,  709 => 520,  397 => 337,  392 => 251,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 988,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 767,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 759,  992 => 720,  962 => 697,  960 => 696,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 284,  419 => 293,  639 => 468,  611 => 386,  538 => 444,  646 => 307,  642 => 492,  544 => 434,  541 => 204,  517 => 427,  797 => 489,  752 => 533,  748 => 458,  681 => 412,  677 => 507,  630 => 181,  618 => 172,  535 => 430,  519 => 425,  416 => 215,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 552,  775 => 550,  762 => 544,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 406,  534 => 348,  530 => 428,  521 => 194,  489 => 179,  483 => 206,  394 => 196,  396 => 256,  345 => 243,  476 => 174,  386 => 162,  364 => 235,  234 => 155,  595 => 326,  589 => 450,  586 => 451,  562 => 505,  556 => 274,  506 => 429,  498 => 417,  492 => 274,  473 => 277,  458 => 121,  399 => 199,  352 => 190,  346 => 239,  328 => 193,  880 => 699,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 489,  573 => 516,  567 => 507,  520 => 394,  481 => 335,  475 => 409,  472 => 408,  466 => 227,  441 => 346,  438 => 189,  432 => 380,  429 => 222,  395 => 400,  382 => 202,  378 => 249,  367 => 197,  357 => 222,  348 => 190,  334 => 196,  286 => 219,  205 => 155,  297 => 182,  218 => 144,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 579,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 554,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 534,  740 => 456,  734 => 530,  731 => 392,  728 => 528,  725 => 251,  719 => 257,  716 => 438,  714 => 522,  711 => 540,  705 => 539,  701 => 261,  690 => 302,  687 => 301,  671 => 490,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 470,  609 => 273,  602 => 230,  591 => 453,  571 => 419,  499 => 421,  488 => 273,  389 => 235,  223 => 161,  14 => 2,  306 => 227,  303 => 183,  300 => 223,  292 => 37,  280 => 153,  12 => 36,  624 => 282,  620 => 223,  612 => 467,  601 => 379,  599 => 441,  580 => 265,  574 => 447,  559 => 504,  526 => 429,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 335,  401 => 334,  391 => 216,  369 => 189,  333 => 234,  329 => 93,  307 => 192,  287 => 236,  195 => 153,  178 => 116,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 587,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 564,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 504,  663 => 484,  660 => 194,  657 => 482,  650 => 483,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 482,  603 => 229,  600 => 178,  594 => 454,  588 => 372,  584 => 488,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 156,  513 => 425,  479 => 388,  468 => 407,  451 => 287,  448 => 389,  424 => 296,  418 => 344,  410 => 271,  376 => 191,  373 => 257,  340 => 209,  326 => 222,  261 => 138,  118 => 128,  200 => 125,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 991,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 768,  1056 => 766,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 536,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 712,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 567,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 557,  793 => 556,  785 => 560,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 540,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 525,  712 => 521,  710 => 502,  707 => 501,  699 => 142,  697 => 513,  696 => 204,  695 => 230,  694 => 512,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 500,  654 => 484,  649 => 308,  643 => 306,  640 => 491,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 434,  550 => 255,  527 => 442,  515 => 191,  512 => 391,  509 => 422,  503 => 427,  496 => 423,  493 => 415,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 343,  408 => 338,  388 => 292,  371 => 256,  363 => 244,  350 => 245,  342 => 274,  335 => 235,  316 => 232,  290 => 154,  276 => 176,  266 => 204,  263 => 146,  255 => 209,  245 => 195,  207 => 138,  194 => 139,  184 => 148,  76 => 40,  810 => 238,  804 => 493,  801 => 560,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 547,  766 => 546,  761 => 247,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 509,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 219,  627 => 236,  622 => 481,  619 => 212,  616 => 468,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 448,  572 => 204,  566 => 324,  547 => 435,  545 => 253,  542 => 432,  533 => 430,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 388,  443 => 387,  431 => 351,  428 => 250,  425 => 277,  422 => 373,  412 => 152,  406 => 201,  390 => 164,  383 => 193,  377 => 246,  375 => 248,  372 => 200,  370 => 208,  359 => 251,  356 => 250,  353 => 131,  349 => 189,  336 => 272,  332 => 239,  330 => 233,  318 => 233,  313 => 231,  291 => 218,  190 => 124,  321 => 229,  295 => 221,  274 => 152,  242 => 194,  236 => 156,  70 => 19,  170 => 114,  288 => 217,  284 => 154,  279 => 134,  275 => 180,  256 => 171,  250 => 2,  237 => 168,  232 => 159,  222 => 151,  191 => 129,  153 => 140,  150 => 70,  563 => 188,  560 => 435,  558 => 195,  553 => 256,  549 => 438,  543 => 179,  537 => 431,  532 => 403,  528 => 199,  525 => 311,  523 => 441,  518 => 292,  514 => 392,  511 => 243,  508 => 424,  501 => 422,  491 => 288,  487 => 411,  460 => 240,  455 => 120,  449 => 164,  442 => 353,  439 => 226,  436 => 159,  433 => 185,  426 => 180,  420 => 220,  415 => 274,  411 => 339,  405 => 269,  403 => 149,  380 => 260,  366 => 285,  354 => 191,  331 => 173,  325 => 236,  320 => 182,  317 => 227,  311 => 225,  308 => 243,  304 => 207,  272 => 183,  267 => 189,  249 => 206,  216 => 143,  155 => 141,  146 => 1,  126 => 59,  188 => 128,  181 => 126,  161 => 112,  110 => 126,  124 => 130,  692 => 373,  683 => 282,  678 => 279,  676 => 488,  666 => 485,  661 => 488,  656 => 499,  652 => 497,  645 => 493,  641 => 352,  635 => 489,  631 => 475,  625 => 460,  615 => 453,  607 => 363,  597 => 455,  590 => 223,  583 => 435,  579 => 353,  577 => 420,  575 => 212,  569 => 514,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 405,  529 => 222,  524 => 344,  516 => 424,  510 => 78,  504 => 145,  500 => 386,  495 => 416,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 279,  421 => 223,  417 => 219,  400 => 267,  385 => 203,  361 => 252,  344 => 238,  339 => 273,  324 => 102,  310 => 165,  302 => 240,  296 => 38,  282 => 178,  259 => 201,  244 => 204,  231 => 123,  226 => 151,  215 => 191,  186 => 149,  152 => 113,  114 => 50,  104 => 46,  358 => 242,  351 => 240,  347 => 208,  343 => 188,  338 => 241,  327 => 232,  323 => 49,  319 => 220,  315 => 198,  301 => 36,  299 => 221,  293 => 205,  289 => 237,  281 => 182,  277 => 208,  271 => 206,  265 => 169,  262 => 170,  260 => 211,  257 => 200,  251 => 181,  248 => 139,  239 => 139,  228 => 164,  225 => 149,  213 => 129,  211 => 140,  197 => 140,  174 => 115,  148 => 111,  134 => 90,  127 => 57,  20 => 1,  270 => 166,  253 => 3,  233 => 167,  212 => 106,  210 => 128,  206 => 152,  202 => 126,  198 => 120,  192 => 172,  185 => 135,  180 => 146,  175 => 103,  172 => 124,  167 => 108,  165 => 119,  160 => 143,  137 => 134,  113 => 60,  100 => 55,  90 => 112,  81 => 76,  65 => 40,  129 => 85,  97 => 83,  77 => 43,  34 => 62,  53 => 11,  84 => 77,  58 => 18,  23 => 3,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 287,  427 => 350,  423 => 256,  413 => 220,  409 => 219,  407 => 247,  402 => 210,  398 => 207,  393 => 265,  387 => 263,  384 => 251,  381 => 236,  379 => 110,  374 => 137,  368 => 255,  365 => 119,  362 => 234,  360 => 223,  355 => 280,  341 => 237,  337 => 197,  322 => 266,  314 => 226,  312 => 187,  309 => 48,  305 => 223,  298 => 239,  294 => 238,  285 => 179,  283 => 31,  278 => 217,  268 => 173,  264 => 188,  258 => 210,  252 => 166,  247 => 1,  241 => 203,  229 => 138,  220 => 150,  214 => 141,  177 => 134,  169 => 144,  140 => 108,  132 => 61,  128 => 66,  107 => 47,  61 => 19,  273 => 185,  269 => 214,  254 => 199,  243 => 140,  240 => 176,  238 => 192,  235 => 160,  230 => 200,  227 => 178,  224 => 146,  221 => 163,  219 => 174,  217 => 173,  208 => 132,  204 => 142,  179 => 112,  159 => 117,  143 => 136,  135 => 60,  119 => 90,  102 => 51,  71 => 21,  67 => 103,  63 => 102,  59 => 70,  28 => 3,  94 => 48,  89 => 46,  85 => 110,  75 => 73,  68 => 31,  56 => 97,  87 => 37,  201 => 136,  196 => 140,  183 => 127,  171 => 100,  166 => 113,  163 => 76,  158 => 142,  156 => 92,  151 => 108,  142 => 109,  138 => 65,  136 => 91,  121 => 55,  117 => 56,  105 => 57,  91 => 45,  62 => 71,  49 => 36,  25 => 4,  21 => 2,  31 => 15,  38 => 21,  26 => 6,  24 => 13,  19 => 5,  93 => 113,  88 => 111,  78 => 105,  46 => 20,  44 => 65,  27 => 81,  79 => 20,  72 => 39,  69 => 72,  47 => 9,  40 => 6,  37 => 7,  22 => 78,  246 => 205,  157 => 116,  145 => 137,  139 => 90,  131 => 86,  123 => 58,  120 => 52,  115 => 127,  111 => 48,  108 => 125,  101 => 44,  98 => 44,  96 => 43,  83 => 37,  74 => 32,  66 => 73,  55 => 23,  52 => 67,  50 => 10,  43 => 8,  41 => 6,  35 => 5,  32 => 4,  29 => 6,  209 => 145,  203 => 139,  199 => 135,  193 => 132,  189 => 121,  187 => 149,  182 => 117,  176 => 131,  173 => 119,  168 => 124,  164 => 107,  162 => 95,  154 => 109,  149 => 138,  147 => 91,  144 => 2,  141 => 135,  133 => 133,  130 => 132,  125 => 100,  122 => 129,  116 => 61,  112 => 126,  109 => 48,  106 => 3,  103 => 2,  99 => 50,  95 => 114,  92 => 113,  86 => 38,  82 => 35,  80 => 33,  73 => 42,  64 => 30,  60 => 36,  57 => 69,  54 => 31,  51 => 12,  48 => 93,  45 => 26,  42 => 90,  39 => 4,  36 => 20,  33 => 84,  30 => 3,);
    }
}
