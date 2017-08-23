<?php

/* MinsalCitasBundle:CitDistribucionProcedimiento:create.html.twig */
class __TwigTemplate_4e6d410556a11c4cef8f09e598540cb5ce280e9208e0a10f9bc01be88a0b0606 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:edit.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
";
    }

    // line 7
    public function block_javascripts($context, array $blocks = array())
    {
        // line 8
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script type=\"text/javascript\">
    \$(document).ready(function () {
        var idAreaModEstab                 = \$('select[id\$=\"_idAreaModEstab\"]');
        var idProcedimientoEstablecimiento = \$('select[id\$=\"_idProcedimientoEstablecimiento\"]');
        var yrs                            = \$('select[id\$=\"_yrs\"]');
        var idEmpleado                     = \$('select[id\$=\"_idEmpleado\"]');
        var rangoHora                      = \$('select[id\$=\"_idRangohora\"]');
        var dias                           = \$('input[id^=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_dia_\"]');
        var meses                          = \$('input[id^=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_mes_\"]');
        var idTipoDistribucion             = \$('select[id\$=\"_idTipoDistribucion\"]');
        var tipoDistribucion               = idTipoDistribucion.select2('val');

        initializeSelect2(idTipoDistribucion,true,false,{
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        initializeSelect2(idAreaModEstab, true, false, {
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        initializeSelect2(idProcedimientoEstablecimiento, true, false, {
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        initializeSelect2(yrs,true,false,{
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        initializeSelect2(rangoHora, true, false, {
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        initializeSelect2(idEmpleado, true, true, {
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        idAreaModEstab.on('change', function () {
            if (\$(this).val()) {
                \$.ajax({
                    url: Routing.generate(\"obtener_medicos_por_area\", {'idAreaModEstab': \$(this).val()}),
                    async: false,
                    dataType: 'json',
                    success: function (data) {

                        initializeSelect2(idEmpleado, true, true, {
                            placeholder: 'Seleccionar...',
                            allowClear: true,
                            width: '100%'
                        });

                        \$.each(data.resultados, function (indice, val) {
                            idEmpleado.append(\$('<option>', {value: val.id, text: val.text}));
                        });
                    }
                });
            } else {
                initializeSelect2(idEmpleado, true, true, {
                    placeholder: 'Seleccionar...',
                    allowClear: true,
                    width: '100%'
                });
            }
        });

        dias.on('ifClicked', function () {
            var valor = \$(this).attr('value');
            if(valor == '8'){
                var estado=\$(this).prop('checked');
                if(estado==false){
                    dias.each(function () {
                        \$(this).iCheck('check');
                    });
                }else {
                    dias.each(function () {
                        \$(this).iCheck('uncheck');
                    });
                }
            }else {
                dias.each(function () {
                    valor = \$(this).attr('value');
                    if (\$(this).attr('value') === '8') {
                            \$(this).iCheck('uncheck');
                    }
                });
            }
        });

        meses.on('ifClicked', function () {
            var valor = \$(this).attr('value');
            if(valor == '13'){
                var estado=\$(this).prop('checked');
                if(estado==false){
                    meses.each(function () {
                        \$(this).iCheck('check');
                    });
                }else {
                    meses.each(function () {
                        \$(this).iCheck('uncheck');
                    });
                }
            }else {
                meses.each(function () {
                    valor = \$(this).attr('value');
                    if (\$(this).attr('value') === '13') {
                            \$(this).iCheck('uncheck');
                    }
                });
            }
        });

        ";
        // line 131
        if ((!$this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method"))) {
            // line 132
            echo "            idAreaModEstab.parent().parent().hide();
        ";
        }
        // line 134
        echo "
        ";
        // line 135
        if ((isset($context["idAreaModEstab"]) ? $context["idAreaModEstab"] : $this->getContext($context, "idAreaModEstab"))) {
            // line 136
            echo "            idAreaModEstab.select2('val',";
            echo twig_escape_filter($this->env, (isset($context["idAreaModEstab"]) ? $context["idAreaModEstab"] : $this->getContext($context, "idAreaModEstab")), "html", null, true);
            echo " );
            idAreaModEstab.trigger('change');
        ";
        }
        // line 139
        echo "
        ";
        // line 140
        if ((isset($context["idProcedimientoEstablecimiento"]) ? $context["idProcedimientoEstablecimiento"] : $this->getContext($context, "idProcedimientoEstablecimiento"))) {
            // line 141
            echo "            idProcedimientoEstablecimiento.select2('val',";
            echo twig_escape_filter($this->env, (isset($context["idProcedimientoEstablecimiento"]) ? $context["idProcedimientoEstablecimiento"] : $this->getContext($context, "idProcedimientoEstablecimiento")), "html", null, true);
            echo ");
            idProcedimientoEstablecimiento.change();
        ";
        }
        // line 144
        echo "
        ";
        // line 145
        if ((isset($context["idEmpleado"]) ? $context["idEmpleado"] : $this->getContext($context, "idEmpleado"))) {
            // line 146
            echo "             idEmpleado.select2('val',";
            echo twig_escape_filter($this->env, (isset($context["idEmpleado"]) ? $context["idEmpleado"] : $this->getContext($context, "idEmpleado")), "html", null, true);
            echo ");
        ";
        }
        // line 148
        echo "
        \$('form').on('submit',function(e){
            \$(this).parent().waitMe({ text: 'Procesando...' });
        });


    });
    </script>
";
    }

    // line 158
    public function block_formactions($context, array $blocks = array())
    {
        // line 159
        echo "    <div class=\"well well-small form-actions\">
        ";
        // line 160
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 161
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 162
                echo "                <button type=\"submit\" class=\"btn btn-success\" name=\"btn_update\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            } else {
                // line 164
                echo "                <button type=\"submit\" class=\"btn btn-success\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            }
            // line 166
            echo "        ";
        } else {
            // line 167
            echo "            ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 168
                echo "                <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                    <i class=\"fa fa-eye\"></i>
                    ";
                // line 170
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                </button>
            ";
            }
            // line 173
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 174
                echo "
                ";
                // line 175
                if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method")) {
                    // line 176
                    echo "                    <button type=\"submit\" class=\"btn btn-primary\" name=\"btn_update_and_list\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-list\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update_and_return_to_list", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</button>
                ";
                }
                // line 178
                echo "
                ";
                // line 179
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "delete"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "DELETE", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 180
                    echo "                    ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("delete_or", array(), "SonataAdminBundle"), "html", null, true);
                    echo "
                    <a class=\"btn btn-danger\" href=\"";
                    // line 181
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "delete", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_delete", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 183
                echo "
                ";
                // line 184
                if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isAclEnabled", array(), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "acl"), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "MASTER", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 185
                    echo "                    <a class=\"btn btn-info\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "acl", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-users\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_edit_acl", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 187
                echo "
            ";
            } else {
                // line 189
                echo "                ";
                if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method")) {
                    // line 190
                    echo "                    <button type=\"submit\" class=\"btn btn-primary\" name=\"btn_create_and_list\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-list\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create_and_return_to_list", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</button>
                ";
                }
                // line 192
                echo "
                <button class=\"btn btn-success\" type=\"submit\" name=\"btn_create_and_create\"><i class=\"fa fa-plus-circle\"></i> ";
                // line 193
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create_and_create_a_new_one", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>

            ";
            }
            // line 196
            echo "        ";
        }
        // line 197
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:CitDistribucionProcedimiento:create.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  736 => 544,  706 => 519,  702 => 518,  1720 => 1573,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1480,  1609 => 1479,  1594 => 1472,  1590 => 1471,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 922,  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 697,  803 => 630,  606 => 447,  691 => 492,  655 => 481,  484 => 412,  552 => 439,  709 => 255,  397 => 337,  392 => 251,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 988,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 767,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 759,  992 => 720,  962 => 697,  960 => 696,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 279,  419 => 293,  639 => 468,  611 => 386,  538 => 444,  646 => 307,  642 => 286,  544 => 434,  541 => 204,  517 => 393,  797 => 489,  752 => 533,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 430,  519 => 425,  416 => 215,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 416,  775 => 413,  762 => 540,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 406,  534 => 348,  530 => 428,  521 => 194,  489 => 179,  483 => 206,  394 => 217,  396 => 206,  345 => 189,  476 => 174,  386 => 162,  364 => 235,  234 => 155,  595 => 326,  589 => 267,  586 => 451,  562 => 505,  556 => 274,  506 => 429,  498 => 417,  492 => 274,  473 => 277,  458 => 121,  399 => 338,  352 => 190,  346 => 125,  328 => 193,  880 => 699,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 489,  573 => 516,  567 => 507,  520 => 394,  481 => 335,  475 => 275,  472 => 172,  466 => 227,  441 => 346,  438 => 189,  432 => 224,  429 => 222,  395 => 400,  382 => 202,  378 => 201,  367 => 197,  357 => 222,  348 => 190,  334 => 196,  286 => 169,  205 => 127,  297 => 182,  218 => 145,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 561,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 540,  705 => 539,  701 => 261,  690 => 302,  687 => 301,  671 => 490,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 470,  609 => 273,  602 => 230,  591 => 453,  571 => 419,  499 => 424,  488 => 273,  389 => 235,  223 => 143,  14 => 2,  306 => 178,  303 => 183,  300 => 98,  292 => 181,  280 => 168,  12 => 36,  624 => 282,  620 => 223,  612 => 467,  601 => 379,  599 => 441,  580 => 265,  574 => 263,  559 => 504,  526 => 427,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 339,  401 => 119,  391 => 216,  369 => 228,  333 => 95,  329 => 93,  307 => 192,  287 => 180,  195 => 133,  178 => 132,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 460,  663 => 484,  660 => 194,  657 => 482,  650 => 483,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 221,  603 => 229,  600 => 178,  594 => 454,  588 => 372,  584 => 488,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 156,  513 => 244,  479 => 334,  468 => 163,  451 => 307,  448 => 195,  424 => 296,  418 => 308,  410 => 151,  376 => 109,  373 => 209,  340 => 209,  326 => 222,  261 => 138,  118 => 54,  200 => 141,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 991,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 768,  1056 => 766,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 536,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 712,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 563,  785 => 560,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 258,  712 => 437,  710 => 502,  707 => 501,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 241,  654 => 484,  649 => 308,  643 => 306,  640 => 478,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 501,  550 => 255,  527 => 442,  515 => 191,  512 => 391,  509 => 422,  503 => 427,  496 => 423,  493 => 415,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 343,  408 => 213,  388 => 292,  371 => 136,  363 => 133,  350 => 191,  342 => 274,  335 => 210,  316 => 189,  290 => 154,  276 => 176,  266 => 180,  263 => 102,  255 => 167,  245 => 153,  207 => 156,  194 => 139,  184 => 137,  76 => 40,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 491,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 219,  627 => 236,  622 => 369,  619 => 212,  616 => 468,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 368,  572 => 204,  566 => 324,  547 => 435,  545 => 253,  542 => 156,  533 => 429,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 163,  443 => 162,  431 => 319,  428 => 250,  425 => 156,  422 => 338,  412 => 152,  406 => 212,  390 => 164,  383 => 161,  377 => 246,  375 => 210,  372 => 200,  370 => 208,  359 => 204,  356 => 132,  353 => 131,  349 => 189,  336 => 272,  332 => 206,  330 => 122,  318 => 220,  313 => 180,  291 => 170,  190 => 124,  321 => 221,  295 => 154,  274 => 175,  242 => 118,  236 => 154,  70 => 19,  170 => 103,  288 => 176,  284 => 109,  279 => 134,  275 => 180,  256 => 171,  250 => 173,  237 => 161,  232 => 159,  222 => 151,  191 => 91,  153 => 102,  150 => 70,  563 => 188,  560 => 275,  558 => 195,  553 => 256,  549 => 438,  543 => 179,  537 => 176,  532 => 403,  528 => 199,  525 => 311,  523 => 441,  518 => 292,  514 => 392,  511 => 243,  508 => 188,  501 => 186,  491 => 288,  487 => 337,  460 => 240,  455 => 120,  449 => 164,  442 => 278,  439 => 226,  436 => 159,  433 => 185,  426 => 180,  420 => 220,  415 => 121,  411 => 174,  405 => 211,  403 => 149,  380 => 247,  366 => 285,  354 => 191,  331 => 224,  325 => 192,  320 => 182,  317 => 199,  311 => 262,  308 => 173,  304 => 185,  272 => 183,  267 => 91,  249 => 85,  216 => 146,  155 => 103,  146 => 96,  126 => 131,  188 => 119,  181 => 118,  161 => 111,  110 => 126,  124 => 64,  692 => 373,  683 => 282,  678 => 279,  676 => 488,  666 => 485,  661 => 488,  656 => 402,  652 => 376,  645 => 236,  641 => 352,  635 => 476,  631 => 475,  625 => 460,  615 => 453,  607 => 363,  597 => 455,  590 => 223,  583 => 435,  579 => 353,  577 => 420,  575 => 212,  569 => 514,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 405,  529 => 222,  524 => 344,  516 => 424,  510 => 78,  504 => 145,  500 => 386,  495 => 416,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 158,  421 => 223,  417 => 219,  400 => 148,  385 => 203,  361 => 207,  344 => 127,  339 => 273,  324 => 102,  310 => 39,  302 => 184,  296 => 173,  282 => 178,  259 => 164,  244 => 142,  231 => 123,  226 => 151,  215 => 107,  186 => 149,  152 => 103,  114 => 127,  104 => 50,  358 => 193,  351 => 130,  347 => 208,  343 => 188,  338 => 187,  327 => 203,  323 => 49,  319 => 190,  315 => 198,  301 => 36,  299 => 183,  293 => 31,  289 => 30,  281 => 182,  277 => 185,  271 => 174,  265 => 169,  262 => 170,  260 => 177,  257 => 3,  251 => 1,  248 => 139,  239 => 117,  228 => 151,  225 => 149,  213 => 123,  211 => 146,  197 => 140,  174 => 113,  148 => 97,  134 => 90,  127 => 57,  20 => 1,  270 => 166,  253 => 174,  233 => 154,  212 => 106,  210 => 103,  206 => 144,  202 => 136,  198 => 120,  192 => 139,  185 => 135,  180 => 135,  175 => 103,  172 => 116,  167 => 108,  165 => 115,  160 => 143,  137 => 65,  113 => 60,  100 => 55,  90 => 42,  81 => 34,  65 => 30,  129 => 85,  97 => 47,  77 => 24,  34 => 3,  53 => 15,  84 => 42,  58 => 18,  23 => 3,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 287,  427 => 221,  423 => 256,  413 => 220,  409 => 219,  407 => 247,  402 => 210,  398 => 207,  393 => 204,  387 => 249,  384 => 214,  381 => 236,  379 => 110,  374 => 137,  368 => 207,  365 => 119,  362 => 234,  360 => 223,  355 => 280,  341 => 126,  337 => 197,  322 => 266,  314 => 162,  312 => 187,  309 => 100,  305 => 204,  298 => 165,  294 => 142,  285 => 179,  283 => 188,  278 => 142,  268 => 173,  264 => 179,  258 => 168,  252 => 166,  247 => 162,  241 => 157,  229 => 158,  220 => 150,  214 => 141,  177 => 134,  169 => 113,  140 => 67,  132 => 133,  128 => 66,  107 => 47,  61 => 13,  273 => 185,  269 => 170,  254 => 161,  243 => 161,  240 => 162,  238 => 140,  235 => 160,  230 => 153,  227 => 152,  224 => 124,  221 => 146,  219 => 128,  217 => 148,  208 => 132,  204 => 142,  179 => 112,  159 => 105,  143 => 136,  135 => 60,  119 => 90,  102 => 85,  71 => 21,  67 => 104,  63 => 103,  59 => 17,  28 => 14,  94 => 46,  89 => 44,  85 => 26,  75 => 76,  68 => 31,  56 => 35,  87 => 40,  201 => 155,  196 => 140,  183 => 127,  171 => 100,  166 => 102,  163 => 76,  158 => 93,  156 => 92,  151 => 139,  142 => 84,  138 => 65,  136 => 91,  121 => 55,  117 => 128,  105 => 57,  91 => 45,  62 => 15,  49 => 30,  25 => 4,  21 => 2,  31 => 15,  38 => 4,  26 => 6,  24 => 13,  19 => 5,  93 => 39,  88 => 36,  78 => 77,  46 => 20,  44 => 7,  27 => 82,  79 => 20,  72 => 39,  69 => 74,  47 => 9,  40 => 7,  37 => 7,  22 => 14,  246 => 164,  157 => 142,  145 => 137,  139 => 90,  131 => 86,  123 => 73,  120 => 52,  115 => 50,  111 => 48,  108 => 59,  101 => 44,  98 => 41,  96 => 42,  83 => 37,  74 => 32,  66 => 73,  55 => 16,  52 => 22,  50 => 14,  43 => 8,  41 => 31,  35 => 6,  32 => 5,  29 => 6,  209 => 145,  203 => 139,  199 => 141,  193 => 132,  189 => 150,  187 => 136,  182 => 134,  176 => 131,  173 => 119,  168 => 99,  164 => 107,  162 => 95,  154 => 110,  149 => 163,  147 => 91,  144 => 2,  141 => 1,  133 => 64,  130 => 97,  125 => 54,  122 => 91,  116 => 61,  112 => 52,  109 => 48,  106 => 47,  103 => 49,  99 => 84,  95 => 114,  92 => 113,  86 => 38,  82 => 34,  80 => 33,  73 => 21,  64 => 30,  60 => 36,  57 => 32,  54 => 13,  51 => 12,  48 => 33,  45 => 32,  42 => 7,  39 => 4,  36 => 16,  33 => 4,  30 => 3,);
    }
}
