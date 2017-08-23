<?php

/* MinsalCitasBundle:CitDistribucion:create.html.twig */
class __TwigTemplate_3414b20c7ef56fe7da346d3e7aaf7c2da5847da4be6fcf339de89048ddb45e64 extends Twig_Template
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
        var idAreaModEstab     = \$('select[id\$=\"_idAreaModEstab\"]');
        var idAtenAreaModEstab = \$('select[id\$=\"_idAtenAreaModEstab\"]');
        var yrs                = \$('select[id\$=\"_yrs\"]');
        var idEmpleado         = \$('select[id\$=\"_idEmpleado\"]');
        var idTipoDistribucion = \$('select[id\$=\"_idTipoDistribucion\"]');
        var rangoHora          = \$('select[id\$=\"_idRangohora\"]');
        var idConsultorio      = \$('select[id\$=\"_idConsultorio\"]');
        var dias               = \$('input[id^=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_dia_\"]');
        var meses              = \$('input[id^=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_mes_\"]');
        var especialidad       = idAtenAreaModEstab.select2('val');
        var medico             = idEmpleado.select2('val');
        var consultorio        = idConsultorio.select2('val');
        var tipoDistribucion   = idTipoDistribucion.select2('val');

        initializeSelect2(idAreaModEstab, true, false, {
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        if(idAtenAreaModEstab.select2('val') != '') {
            idAreaModEstab.change();
            idAtenAreaModEstab.select2('val',especialidad);
            idAtenAreaModEstab.change();
            idEmpleado.select2('val',medico);
            idConsultorio.select2('val',consultorio);
        } else {
            initializeSelect2(idAtenAreaModEstab, true, true, {
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            });

            initializeSelect2(idConsultorio, true, true, {
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            });

            initializeSelect2(idEmpleado, true, true, {
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            });
        }

        initializeSelect2(idTipoDistribucion,true,false,{
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

        idAreaModEstab.on('change', function () {
            initializeSelect2(idAtenAreaModEstab, true, true, {
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            });
            initializeSelect2(idConsultorio, true, true, {
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            });
            initializeSelect2(idEmpleado, true, true, {
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            });

            if (\$(this).val()) {
                \$.ajax({
                    url: Routing.generate(\"obtener_especialidades_por_area\", {'idAreaModEstab': \$(this).val()}),
                    async: false,
                    dataType: 'json',
                    success: function (data) {
                        \$.each(data.resultados, function (indice, val) {
                            idAtenAreaModEstab.append(\$('<option>', {value: val.id, text: val.text}));
                        });
                    }
                });

                \$.ajax({
                    url: Routing.generate(\"obtener_consultorios_por_area\", {'idAreaModEstab': \$(this).val()}),
                    async: false,
                    dataType: 'json',
                    success: function (data) {
                        \$.each(data.resultados, function (indice, val) {
                            idConsultorio.append(\$('<option>', {value: val.id, text: val.text}));
                        });
                    }
                });
            }
        });

        idAtenAreaModEstab.on('change', function () {
            if (\$(this).val()) {
                \$.ajax({
                    url: Routing.generate(\"obtener_medicos_por_especialidad\", {'idAtenAreaModEstab': \$(this).val()}),
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
        // line 191
        if ((!$this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method"))) {
            // line 192
            echo "            idAreaModEstab.parent().parent().hide();
        ";
        }
        // line 194
        echo "
        ";
        // line 195
        if ((isset($context["idAreaModEstab"]) ? $context["idAreaModEstab"] : $this->getContext($context, "idAreaModEstab"))) {
            // line 196
            echo "            idAreaModEstab.select2('val',";
            echo twig_escape_filter($this->env, (isset($context["idAreaModEstab"]) ? $context["idAreaModEstab"] : $this->getContext($context, "idAreaModEstab")), "html", null, true);
            echo " );
            idAreaModEstab.trigger('change');
        ";
        }
        // line 199
        echo "
        ";
        // line 200
        if ((isset($context["idAtenAreaModEstab"]) ? $context["idAtenAreaModEstab"] : $this->getContext($context, "idAtenAreaModEstab"))) {
            // line 201
            echo "            idAtenAreaModEstab.select2('val',";
            echo twig_escape_filter($this->env, (isset($context["idAtenAreaModEstab"]) ? $context["idAtenAreaModEstab"] : $this->getContext($context, "idAtenAreaModEstab")), "html", null, true);
            echo ");
            idAtenAreaModEstab.change();
        ";
        }
        // line 204
        echo "
        ";
        // line 205
        if ((isset($context["idEmpleado"]) ? $context["idEmpleado"] : $this->getContext($context, "idEmpleado"))) {
            // line 206
            echo "             idEmpleado.select2('val',";
            echo twig_escape_filter($this->env, (isset($context["idEmpleado"]) ? $context["idEmpleado"] : $this->getContext($context, "idEmpleado")), "html", null, true);
            echo ");
        ";
        }
        // line 208
        echo "
        \$('form').on('submit',function(e){
            \$(this).parent().waitMe({ text: 'Procesando...' });
        });

    });
    </script>
";
    }

    // line 217
    public function block_formactions($context, array $blocks = array())
    {
        // line 218
        echo "    <div class=\"well well-small form-actions\">
        ";
        // line 219
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "isxmlhttprequest")) {
            // line 220
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 221
                echo "                <button type=\"submit\" class=\"btn btn-success\" name=\"btn_update\"><i class=\"fa fa-save\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            } else {
                // line 223
                echo "                <button type=\"submit\" class=\"btn btn-success\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>
            ";
            }
            // line 225
            echo "        ";
        } else {
            // line 226
            echo "            ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "supportsPreviewMode")) {
                // line 227
                echo "                <button class=\"btn btn-info persist-preview\" name=\"btn_preview\" type=\"submit\">
                    <i class=\"fa fa-eye\"></i>
                    ";
                // line 229
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_preview", array(), "SonataAdminBundle"), "html", null, true);
                echo "
                </button>
            ";
            }
            // line 232
            echo "            ";
            if ((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) {
                // line 233
                echo "
                ";
                // line 234
                if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method")) {
                    // line 235
                    echo "                    <button type=\"submit\" class=\"btn btn-primary\" name=\"btn_update_and_list\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-list\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update_and_return_to_list", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</button>
                ";
                }
                // line 237
                echo "
                ";
                // line 238
                if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "delete"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "DELETE", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 239
                    echo "                    ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("delete_or", array(), "SonataAdminBundle"), "html", null, true);
                    echo "
                    <a class=\"btn btn-danger\" href=\"";
                    // line 240
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "delete", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_delete", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 242
                echo "
                ";
                // line 243
                if ((($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isAclEnabled", array(), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "acl"), "method")) && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "MASTER", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
                    // line 244
                    echo "                    <a class=\"btn btn-info\" href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "acl", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
                    echo "\"><i class=\"fa fa-users\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_edit_acl", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a>
                ";
                }
                // line 246
                echo "
            ";
            } else {
                // line 248
                echo "                ";
                if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasroute", array(0 => "list"), "method")) {
                    // line 249
                    echo "                    <button type=\"submit\" class=\"btn btn-primary\" name=\"btn_create_and_list\"><i class=\"fa fa-save\"></i> <i class=\"fa fa-list\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create_and_return_to_list", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</button>
                ";
                }
                // line 251
                echo "
                <button class=\"btn btn-success\" type=\"submit\" name=\"btn_create_and_create\"><i class=\"fa fa-plus-circle\"></i> ";
                // line 252
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create_and_create_a_new_one", array(), "SonataAdminBundle"), "html", null, true);
                echo "</button>

            ";
            }
            // line 255
            echo "        ";
        }
        // line 256
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:CitDistribucion:create.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  736 => 544,  706 => 519,  702 => 518,  1720 => 1573,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1480,  1609 => 1479,  1594 => 1472,  1590 => 1471,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 922,  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 697,  803 => 630,  606 => 447,  691 => 492,  655 => 481,  484 => 412,  552 => 439,  709 => 255,  397 => 337,  392 => 251,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 988,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 767,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 759,  992 => 720,  962 => 697,  960 => 696,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 279,  419 => 293,  639 => 468,  611 => 386,  538 => 444,  646 => 307,  642 => 286,  544 => 434,  541 => 204,  517 => 393,  797 => 489,  752 => 533,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 430,  519 => 425,  416 => 215,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 416,  775 => 413,  762 => 540,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 406,  534 => 348,  530 => 428,  521 => 194,  489 => 179,  483 => 206,  394 => 196,  396 => 256,  345 => 189,  476 => 174,  386 => 162,  364 => 235,  234 => 155,  595 => 326,  589 => 267,  586 => 451,  562 => 505,  556 => 274,  506 => 429,  498 => 417,  492 => 274,  473 => 277,  458 => 121,  399 => 199,  352 => 190,  346 => 239,  328 => 193,  880 => 699,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 489,  573 => 516,  567 => 507,  520 => 394,  481 => 335,  475 => 275,  472 => 172,  466 => 227,  441 => 346,  438 => 189,  432 => 224,  429 => 222,  395 => 400,  382 => 202,  378 => 249,  367 => 197,  357 => 222,  348 => 190,  334 => 196,  286 => 169,  205 => 127,  297 => 182,  218 => 145,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 561,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 540,  705 => 539,  701 => 261,  690 => 302,  687 => 301,  671 => 490,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 470,  609 => 273,  602 => 230,  591 => 453,  571 => 419,  499 => 424,  488 => 273,  389 => 235,  223 => 143,  14 => 2,  306 => 178,  303 => 183,  300 => 159,  292 => 181,  280 => 153,  12 => 36,  624 => 282,  620 => 223,  612 => 467,  601 => 379,  599 => 441,  580 => 265,  574 => 263,  559 => 504,  526 => 427,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 339,  401 => 119,  391 => 216,  369 => 189,  333 => 234,  329 => 93,  307 => 192,  287 => 180,  195 => 133,  178 => 116,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 460,  663 => 484,  660 => 194,  657 => 482,  650 => 483,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 221,  603 => 229,  600 => 178,  594 => 454,  588 => 372,  584 => 488,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 156,  513 => 244,  479 => 334,  468 => 163,  451 => 307,  448 => 195,  424 => 296,  418 => 308,  410 => 151,  376 => 191,  373 => 209,  340 => 209,  326 => 222,  261 => 138,  118 => 54,  200 => 125,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 991,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 768,  1056 => 766,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 536,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 712,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 563,  785 => 560,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 258,  712 => 437,  710 => 502,  707 => 501,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 241,  654 => 484,  649 => 308,  643 => 306,  640 => 478,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 501,  550 => 255,  527 => 442,  515 => 191,  512 => 391,  509 => 422,  503 => 427,  496 => 423,  493 => 415,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 343,  408 => 213,  388 => 292,  371 => 246,  363 => 244,  350 => 191,  342 => 274,  335 => 235,  316 => 189,  290 => 154,  276 => 176,  266 => 204,  263 => 146,  255 => 167,  245 => 195,  207 => 127,  194 => 139,  184 => 135,  76 => 40,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 491,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 219,  627 => 236,  622 => 369,  619 => 212,  616 => 468,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 368,  572 => 204,  566 => 324,  547 => 435,  545 => 253,  542 => 156,  533 => 429,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 163,  443 => 162,  431 => 319,  428 => 250,  425 => 156,  422 => 338,  412 => 152,  406 => 201,  390 => 164,  383 => 193,  377 => 246,  375 => 248,  372 => 200,  370 => 208,  359 => 184,  356 => 132,  353 => 131,  349 => 189,  336 => 272,  332 => 206,  330 => 233,  318 => 167,  313 => 180,  291 => 218,  190 => 124,  321 => 229,  295 => 156,  274 => 152,  242 => 194,  236 => 191,  70 => 19,  170 => 114,  288 => 217,  284 => 154,  279 => 134,  275 => 180,  256 => 171,  250 => 173,  237 => 161,  232 => 159,  222 => 151,  191 => 91,  153 => 102,  150 => 70,  563 => 188,  560 => 275,  558 => 195,  553 => 256,  549 => 438,  543 => 179,  537 => 176,  532 => 403,  528 => 199,  525 => 311,  523 => 441,  518 => 292,  514 => 392,  511 => 243,  508 => 188,  501 => 186,  491 => 288,  487 => 337,  460 => 240,  455 => 120,  449 => 164,  442 => 278,  439 => 226,  436 => 159,  433 => 185,  426 => 180,  420 => 220,  415 => 121,  411 => 174,  405 => 211,  403 => 149,  380 => 247,  366 => 285,  354 => 191,  331 => 173,  325 => 172,  320 => 182,  317 => 227,  311 => 225,  308 => 164,  304 => 207,  272 => 183,  267 => 189,  249 => 180,  216 => 146,  155 => 103,  146 => 1,  126 => 59,  188 => 119,  181 => 118,  161 => 112,  110 => 126,  124 => 64,  692 => 373,  683 => 282,  678 => 279,  676 => 488,  666 => 485,  661 => 488,  656 => 402,  652 => 376,  645 => 236,  641 => 352,  635 => 476,  631 => 475,  625 => 460,  615 => 453,  607 => 363,  597 => 455,  590 => 223,  583 => 435,  579 => 353,  577 => 420,  575 => 212,  569 => 514,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 405,  529 => 222,  524 => 344,  516 => 424,  510 => 78,  504 => 145,  500 => 386,  495 => 416,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 158,  421 => 223,  417 => 219,  400 => 148,  385 => 203,  361 => 243,  344 => 238,  339 => 273,  324 => 102,  310 => 165,  302 => 184,  296 => 220,  282 => 178,  259 => 201,  244 => 142,  231 => 123,  226 => 151,  215 => 107,  186 => 149,  152 => 103,  114 => 50,  104 => 46,  358 => 242,  351 => 240,  347 => 208,  343 => 188,  338 => 187,  327 => 232,  323 => 49,  319 => 220,  315 => 198,  301 => 36,  299 => 221,  293 => 205,  289 => 204,  281 => 182,  277 => 208,  271 => 206,  265 => 169,  262 => 170,  260 => 177,  257 => 200,  251 => 181,  248 => 139,  239 => 139,  228 => 151,  225 => 149,  213 => 129,  211 => 146,  197 => 140,  174 => 115,  148 => 97,  134 => 90,  127 => 57,  20 => 1,  270 => 166,  253 => 174,  233 => 154,  212 => 106,  210 => 128,  206 => 152,  202 => 126,  198 => 120,  192 => 139,  185 => 135,  180 => 135,  175 => 103,  172 => 116,  167 => 108,  165 => 115,  160 => 143,  137 => 65,  113 => 60,  100 => 55,  90 => 40,  81 => 44,  65 => 40,  129 => 85,  97 => 47,  77 => 43,  34 => 3,  53 => 37,  84 => 42,  58 => 18,  23 => 3,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 287,  427 => 221,  423 => 256,  413 => 220,  409 => 219,  407 => 247,  402 => 210,  398 => 207,  393 => 255,  387 => 252,  384 => 251,  381 => 236,  379 => 110,  374 => 137,  368 => 207,  365 => 119,  362 => 234,  360 => 223,  355 => 280,  341 => 237,  337 => 197,  322 => 266,  314 => 226,  312 => 187,  309 => 100,  305 => 223,  298 => 165,  294 => 219,  285 => 179,  283 => 188,  278 => 142,  268 => 173,  264 => 188,  258 => 143,  252 => 166,  247 => 196,  241 => 157,  229 => 138,  220 => 150,  214 => 141,  177 => 134,  169 => 113,  140 => 64,  132 => 61,  128 => 66,  107 => 47,  61 => 19,  273 => 185,  269 => 205,  254 => 199,  243 => 140,  240 => 176,  238 => 192,  235 => 160,  230 => 153,  227 => 152,  224 => 135,  221 => 163,  219 => 128,  217 => 131,  208 => 132,  204 => 142,  179 => 112,  159 => 105,  143 => 136,  135 => 60,  119 => 90,  102 => 51,  71 => 21,  67 => 104,  63 => 103,  59 => 17,  28 => 14,  94 => 48,  89 => 46,  85 => 38,  75 => 76,  68 => 31,  56 => 35,  87 => 37,  201 => 155,  196 => 140,  183 => 127,  171 => 100,  166 => 113,  163 => 76,  158 => 111,  156 => 92,  151 => 108,  142 => 84,  138 => 65,  136 => 91,  121 => 55,  117 => 56,  105 => 57,  91 => 45,  62 => 15,  49 => 36,  25 => 4,  21 => 2,  31 => 15,  38 => 4,  26 => 6,  24 => 13,  19 => 5,  93 => 39,  88 => 36,  78 => 77,  46 => 20,  44 => 6,  27 => 82,  79 => 20,  72 => 39,  69 => 41,  47 => 9,  40 => 7,  37 => 7,  22 => 16,  246 => 179,  157 => 142,  145 => 137,  139 => 90,  131 => 86,  123 => 58,  120 => 52,  115 => 50,  111 => 48,  108 => 53,  101 => 44,  98 => 44,  96 => 43,  83 => 37,  74 => 32,  66 => 73,  55 => 23,  52 => 22,  50 => 14,  43 => 8,  41 => 5,  35 => 6,  32 => 5,  29 => 6,  209 => 145,  203 => 139,  199 => 141,  193 => 132,  189 => 121,  187 => 136,  182 => 117,  176 => 131,  173 => 119,  168 => 124,  164 => 107,  162 => 95,  154 => 109,  149 => 2,  147 => 91,  144 => 2,  141 => 1,  133 => 64,  130 => 97,  125 => 54,  122 => 91,  116 => 61,  112 => 52,  109 => 48,  106 => 47,  103 => 49,  99 => 50,  95 => 114,  92 => 113,  86 => 38,  82 => 35,  80 => 33,  73 => 42,  64 => 30,  60 => 36,  57 => 18,  54 => 13,  51 => 12,  48 => 8,  45 => 7,  42 => 34,  39 => 4,  36 => 16,  33 => 4,  30 => 3,);
    }
}
