<?php

/* MinsalSeguimientoBundle:Reportes/SecHistorialClinico:reporteHistoriaClinicaGeneral.html.twig */
class __TwigTemplate_1baa1c4fa30eb02a7328342078008f4fa0f7f59bcd1e11684504527b051d8736 extends Twig_Template
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
        <META HTTP-EQUIV=\"Content-Style-Type\" CONTENT=\"text/css\">
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        ";
        // line 5
        $this->env->loadTemplate("MinsalSiapsBundle::standard_css_reportes.html.twig")->display($context);
        // line 6
        echo "
        <style type=\"text/css\">

            html,body {
                overflow: visible !important;
            }

            div .table-responsive {
                overflow: visible !important;
            }

            .panel-info > .panel-heading,.titulo_vista {
                background-color: white;
                font-size: 12px;
                border-color: black;
                color: black;
                font-weight: bold;
                padding: 2px 5px;
            }

            .panel-body, .vista_paciente,.table.table-bordered.table-hover,.table-bordered {
                font-size: 10px;
            }

            td,th {
                padding: 2px 5px;
            }

            .panel-info{
                border-color:black;
                margin: 4px;
            }

            table {
                width: 100%
            }
        </style>

        <script type=\"text/javascript\">
            jQuery(document).ready(function (\$) {
                \$('td.offset-color-gray').siblings().css('background-color', '#e8e8e8');
                //\$('tr:has(td.offset-color-gray) > th').css('background-color', '#e8e8e8');
            });
        </script>
    </head>
    <body>
        <!-- DATOS DE LA CONSULTA -->
        <div class=\"panel panel-info\">
            <div class=\"panel-heading\"><b>Datos de la Consulta</b> ";
        // line 55
        echo "            </div>
            <table class=\"";
        // line 56
        if (((isset($context["impresion"]) ? $context["impresion"] : $this->getContext($context, "impresion")) != true)) {
            echo " table table-hover ";
        }
        echo " table-bordered\">
                <tr class=\"sonata-ba-view-container\">
                    <th >Fecha Consulta:</th>
                    <td>";
        // line 59
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "fechaconsulta"), "d-m-Y"), "html", null, true);
        echo "</td>
                    <th >Especialidad:</th>
                    <td><span> ";
        // line 61
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "idAtenAreaModEstab"), "getNombreConsulta", array(), "method"), "html", null, true);
        echo " </span></td>
                    ";
        // line 62
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getHistorialLugar", array(), "method")) {
            // line 63
            echo "                    <th>Lugar de Realización:</th>
                    <td>";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getHistorialLugar", array(), "method"), "html", null, true);
            echo "</td>
                    ";
        }
        // line 66
        echo "                </tr>
                <tr class=\"sonata-ba-view-container\">
                    <th style=\"min-width: 250px;\">Consulta por:</th>
                    <td colspan=\"3\"><span>";
        // line 69
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdMotivoConsulta", array(), "method"), "consultaPor"), "html", null, true);
        echo "</span></td>
                </tr>
                <tr class=\"sonata-ba-view-container\">
                    <th style=\"min-width: 250px;\">Presenta Enfermedad:</th>
                    <td colspan=\"3\"><span>";
        // line 73
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdMotivoConsulta", array(), "method"), "presentaEnfermedad"), "html", null, true);
        echo "</span></td>
                </tr>
            </tbody>
        </table>
    </div>

        <!-- Definir las secciones que no se desea imprimir -->
        ";
        // line 80
        $context["sectionsAvoid"] = array(0 => "Atención por Violencia", 1 => "Resultado de exámenes externos tomados");
        // line 83
        echo "
        <!-- Definir las secciones que se desea resaltar -->
        ";
        // line 85
        $context["sectionsHighlight"] = array(0 => "Diagnóstico");
        // line 87
        echo "
        ";
        // line 88
        $this->env->loadTemplate("MinsalSeguimientoBundle:Reportes:SecHistorialClinico/mainBodySections.html.twig")->display($context);
        // line 89
        echo "
        <!-- Consejería -->
        <!-- ";
        // line 91
        if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "consejeriaBrindada")) {
            // line 92
            echo "            <div class=\"panel panel-info\">
                <div class=\"panel-heading\"><b >Consejería</b> ";
            // line 94
            echo "                </div>
                <div class=\"table-responsive\" style=\"overflow-x: auto;\">
                    <table class=\"table-bordered\">
                        <tbody>
                            ";
            // line 98
            if ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "consejeriaBrindada")) {
                // line 99
                echo "                                ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "consejeriaBrindada"));
                foreach ($context['_seq'] as $context["_key"] => $context["consejo"]) {
                    // line 100
                    echo "                                    <tr class=\"sonata-ba-view-container\">
                                        <th>";
                    // line 101
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getIdTipoConsejeria", array(), "method"), "getNombre", array(), "method"), "html", null, true);
                    echo ":</th>
                                        <td colspan=\"3\">";
                    // line 102
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["consejo"]) ? $context["consejo"] : $this->getContext($context, "consejo")), "getConsejo", array(), "method"), "html", null, true);
                    echo "</td>
                                    </tr>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['consejo'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 105
                echo "                            ";
            } else {
                // line 106
                echo "                                <tr class=\"sonata-ba-view-container\"><td><p class=\"text-muted\">No hay registros para mostrar.</p></td></tr>
                            ";
            }
            // line 108
            echo "                        </tbody>
                    </table>
                </div>
            </div>
        ";
        }
        // line 112
        echo " -->

        <!-- Seguimiento de consulta -->
        <!-- <div class=\"panel panel-info\" id=\"seguimiento\">
            <div class=\"panel-heading\"><b >Seguimiento de Consulta</b> ";
        // line 117
        echo "            </div>
            <div class=\"table-responsive\" style=\"overflow-x: auto;\">
                <table class=\"table table-bordered table-hover\" >
                    <tbody>
                        <tr class=\"sonata-ba-view-container\">
                            <td>
                                <span>
                                    ";
        // line 124
        if ((isset($context["citasAsignadas"]) ? $context["citasAsignadas"] : $this->getContext($context, "citasAsignadas"))) {
            // line 125
            echo "                                        <ul>
                                            ";
            // line 126
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["citasAsignadas"]) ? $context["citasAsignadas"] : $this->getContext($context, "citasAsignadas")));
            foreach ($context['_seq'] as $context["_key"] => $context["citas"]) {
                // line 127
                echo "                                                <li><span style=\"font-size: 13px;\"><strong>";
                echo twig_escape_filter($this->env, ("Cita de " . $this->getAttribute($this->getAttribute((isset($context["citas"]) ? $context["citas"] : $this->getContext($context, "citas")), "getIdTipoCitaSubsecuente", array(), "method"), "nombre")), "html", null, true);
                echo "</strong>: ";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["citas"]) ? $context["citas"] : $this->getContext($context, "citas")), "getIdCitaDia", array(), "method"), "fecha"), "d-m-Y"), "html", null, true);
                echo "</span></li>
                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['citas'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 129
            echo "                                        </ul>
                                    ";
        } else {
            // line 131
            echo "                                        <p class=\"text-muted\">No hay registros para mostrar.</p>
                                    ";
        }
        // line 133
        echo "                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> -->

        ";
        // line 141
        $this->env->loadTemplate("MinsalLaboratorioBundle:Custom:SecSolicitudestudios/body_solicitudestudio.html.twig")->display($context);
        // line 142
        echo "        ";
        $this->env->loadTemplate("MinsalFarmaciaBundle:FarmRecetas:body_plan_atencion.html.twig")->display($context);
        // line 143
        echo "        ";
        $this->env->loadTemplate("MinsalSeguimientoBundle:Reportes:SecHistorialClinico/body_consejeria.html.twig")->display($context);
        // line 144
        echo "        ";
        $this->env->loadTemplate("MinsalSeguimientoBundle:Reportes:SecHistorialClinico/body_datos_embarazo.html.twig")->display($context);
        // line 145
        echo "        ";
        $this->env->loadTemplate("MinsalSeguimientoBundle:Reportes:SecHistorialClinico/body_plan_ingresos.html.twig")->display($context);
        // line 146
        echo "        ";
        $this->env->loadTemplate("MinsalSeguimientoBundle:Reportes:SecHistorialClinico/body_seguimiento_consulta.html.twig")->display($context);
        // line 147
        echo "        ";
        $this->env->loadTemplate("MinsalSeguimientoBundle:Reportes:firma_medico.html.twig")->display($context);
        // line 148
        echo "
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:Reportes/SecHistorialClinico:reporteHistoriaClinicaGeneral.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  797 => 489,  752 => 459,  748 => 458,  681 => 412,  677 => 411,  630 => 373,  618 => 368,  535 => 224,  519 => 219,  416 => 172,  1082 => 552,  1076 => 550,  1072 => 548,  1069 => 547,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 450,  842 => 443,  836 => 440,  824 => 435,  781 => 416,  775 => 413,  762 => 406,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 388,  708 => 381,  703 => 378,  674 => 366,  659 => 359,  636 => 350,  604 => 329,  581 => 330,  568 => 315,  539 => 322,  534 => 298,  530 => 297,  521 => 220,  489 => 208,  483 => 206,  394 => 234,  396 => 117,  345 => 283,  476 => 270,  386 => 284,  364 => 219,  234 => 78,  595 => 326,  589 => 357,  586 => 322,  562 => 323,  556 => 182,  506 => 103,  498 => 277,  492 => 274,  473 => 165,  458 => 266,  399 => 143,  352 => 211,  346 => 125,  328 => 104,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 218,  573 => 328,  567 => 347,  520 => 309,  481 => 167,  475 => 275,  472 => 269,  466 => 272,  441 => 346,  438 => 149,  432 => 182,  429 => 342,  395 => 287,  382 => 128,  378 => 281,  367 => 120,  357 => 103,  348 => 100,  334 => 110,  286 => 144,  205 => 53,  297 => 79,  218 => 127,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 419,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 374,  628 => 372,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 316,  499 => 154,  488 => 273,  389 => 114,  223 => 118,  14 => 2,  306 => 117,  303 => 181,  300 => 115,  292 => 86,  280 => 103,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 328,  599 => 327,  580 => 194,  574 => 230,  559 => 311,  526 => 179,  497 => 173,  485 => 283,  463 => 271,  447 => 152,  404 => 238,  401 => 119,  391 => 222,  369 => 106,  333 => 95,  329 => 93,  307 => 85,  287 => 75,  195 => 105,  178 => 123,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 425,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 209,  700 => 205,  679 => 368,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 356,  647 => 355,  644 => 190,  632 => 349,  629 => 186,  626 => 221,  603 => 362,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 321,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 307,  448 => 306,  424 => 234,  418 => 112,  410 => 236,  376 => 109,  373 => 152,  340 => 200,  326 => 92,  261 => 146,  118 => 49,  200 => 117,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 543,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 536,  1036 => 534,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 488,  785 => 486,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 437,  710 => 149,  707 => 208,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 357,  649 => 122,  643 => 227,  640 => 226,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 358,  576 => 101,  564 => 162,  557 => 310,  550 => 94,  527 => 296,  515 => 305,  512 => 290,  509 => 228,  503 => 81,  496 => 282,  493 => 155,  478 => 204,  467 => 197,  456 => 309,  450 => 114,  414 => 242,  408 => 239,  388 => 207,  371 => 216,  363 => 187,  350 => 142,  342 => 97,  335 => 198,  316 => 16,  290 => 76,  276 => 102,  266 => 136,  263 => 153,  255 => 144,  245 => 122,  207 => 137,  194 => 112,  184 => 65,  76 => 21,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 399,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 372,  685 => 413,  682 => 226,  672 => 223,  670 => 365,  665 => 362,  648 => 219,  627 => 206,  622 => 369,  619 => 212,  616 => 202,  613 => 210,  610 => 332,  608 => 197,  605 => 207,  596 => 106,  592 => 325,  587 => 197,  585 => 331,  582 => 190,  578 => 178,  572 => 204,  566 => 324,  547 => 93,  545 => 228,  542 => 227,  533 => 186,  531 => 95,  507 => 287,  505 => 214,  502 => 278,  477 => 164,  471 => 164,  465 => 265,  454 => 265,  446 => 156,  443 => 256,  431 => 251,  428 => 250,  425 => 247,  422 => 338,  412 => 147,  406 => 111,  390 => 139,  383 => 112,  377 => 199,  375 => 218,  372 => 107,  370 => 222,  359 => 145,  356 => 269,  353 => 143,  349 => 119,  336 => 205,  332 => 259,  330 => 554,  318 => 90,  313 => 161,  291 => 108,  190 => 129,  321 => 254,  295 => 201,  274 => 71,  242 => 153,  236 => 177,  70 => 26,  170 => 95,  288 => 197,  284 => 89,  279 => 193,  275 => 162,  256 => 132,  250 => 66,  237 => 133,  232 => 136,  222 => 129,  191 => 104,  153 => 36,  150 => 35,  563 => 188,  560 => 187,  558 => 322,  553 => 309,  549 => 182,  543 => 179,  537 => 176,  532 => 223,  528 => 173,  525 => 311,  523 => 171,  518 => 292,  514 => 218,  511 => 217,  508 => 281,  501 => 212,  491 => 157,  487 => 156,  460 => 194,  455 => 141,  449 => 263,  442 => 259,  439 => 133,  436 => 183,  433 => 130,  426 => 126,  420 => 233,  415 => 121,  411 => 170,  405 => 118,  403 => 117,  380 => 107,  366 => 105,  354 => 102,  331 => 173,  325 => 94,  320 => 91,  317 => 99,  311 => 98,  308 => 158,  304 => 84,  272 => 81,  267 => 148,  249 => 142,  216 => 56,  155 => 100,  146 => 91,  126 => 13,  188 => 54,  181 => 115,  161 => 105,  110 => 72,  124 => 82,  692 => 373,  683 => 282,  678 => 279,  676 => 367,  666 => 126,  661 => 380,  656 => 358,  652 => 376,  645 => 215,  641 => 352,  635 => 376,  631 => 218,  625 => 361,  615 => 335,  607 => 363,  597 => 359,  590 => 202,  583 => 354,  579 => 353,  577 => 329,  575 => 352,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 299,  529 => 222,  524 => 90,  516 => 286,  510 => 78,  504 => 296,  500 => 88,  495 => 210,  490 => 154,  486 => 165,  482 => 317,  470 => 313,  464 => 196,  459 => 270,  452 => 191,  434 => 252,  421 => 90,  417 => 296,  400 => 116,  385 => 129,  361 => 207,  344 => 98,  339 => 137,  324 => 102,  310 => 86,  302 => 93,  296 => 92,  282 => 143,  259 => 151,  244 => 147,  231 => 123,  226 => 137,  215 => 63,  186 => 53,  152 => 54,  114 => 40,  104 => 31,  358 => 209,  351 => 101,  347 => 183,  343 => 264,  338 => 96,  327 => 108,  323 => 522,  319 => 164,  315 => 121,  301 => 94,  299 => 201,  293 => 177,  289 => 91,  281 => 74,  277 => 72,  271 => 70,  265 => 82,  262 => 68,  260 => 128,  257 => 53,  251 => 182,  248 => 65,  239 => 125,  228 => 75,  225 => 65,  213 => 127,  211 => 125,  197 => 50,  174 => 59,  148 => 92,  134 => 29,  127 => 40,  20 => 1,  270 => 85,  253 => 67,  233 => 131,  212 => 139,  210 => 126,  206 => 109,  202 => 52,  198 => 57,  192 => 55,  185 => 100,  180 => 105,  175 => 47,  172 => 59,  167 => 101,  165 => 40,  160 => 56,  137 => 87,  113 => 37,  100 => 37,  90 => 66,  81 => 27,  65 => 10,  129 => 80,  97 => 62,  77 => 55,  34 => 4,  53 => 10,  84 => 15,  58 => 12,  23 => 2,  480 => 205,  474 => 274,  469 => 271,  461 => 70,  457 => 124,  453 => 151,  444 => 185,  440 => 184,  437 => 244,  435 => 344,  430 => 153,  427 => 180,  423 => 298,  413 => 237,  409 => 327,  407 => 169,  402 => 166,  398 => 226,  393 => 116,  387 => 113,  384 => 230,  381 => 315,  379 => 110,  374 => 36,  368 => 215,  365 => 119,  362 => 146,  360 => 104,  355 => 27,  341 => 138,  337 => 97,  322 => 188,  314 => 186,  312 => 97,  309 => 118,  305 => 204,  298 => 150,  294 => 78,  285 => 105,  283 => 5,  278 => 142,  268 => 101,  264 => 147,  258 => 145,  252 => 143,  247 => 141,  241 => 62,  229 => 129,  220 => 171,  214 => 126,  177 => 55,  169 => 48,  140 => 88,  132 => 50,  128 => 84,  107 => 66,  61 => 36,  273 => 161,  269 => 165,  254 => 86,  243 => 77,  240 => 146,  238 => 61,  235 => 60,  230 => 72,  227 => 57,  224 => 74,  221 => 145,  219 => 60,  217 => 129,  208 => 54,  204 => 63,  179 => 98,  159 => 99,  143 => 82,  135 => 85,  119 => 73,  102 => 64,  71 => 19,  67 => 25,  63 => 15,  59 => 9,  28 => 7,  94 => 35,  89 => 24,  85 => 31,  75 => 13,  68 => 40,  56 => 12,  87 => 16,  201 => 123,  196 => 61,  183 => 106,  171 => 102,  166 => 107,  163 => 106,  158 => 44,  156 => 37,  151 => 94,  142 => 89,  138 => 31,  136 => 102,  121 => 47,  117 => 76,  105 => 20,  91 => 57,  62 => 23,  49 => 10,  25 => 5,  21 => 2,  31 => 8,  38 => 12,  26 => 6,  24 => 2,  19 => 1,  93 => 61,  88 => 59,  78 => 14,  46 => 7,  44 => 8,  27 => 6,  79 => 21,  72 => 12,  69 => 18,  47 => 7,  40 => 11,  37 => 13,  22 => 2,  246 => 78,  157 => 98,  145 => 68,  139 => 52,  131 => 83,  123 => 33,  120 => 74,  115 => 23,  111 => 32,  108 => 65,  101 => 31,  98 => 69,  96 => 33,  83 => 23,  74 => 20,  66 => 16,  55 => 29,  52 => 16,  50 => 8,  43 => 7,  41 => 14,  35 => 8,  32 => 2,  29 => 3,  209 => 124,  203 => 107,  199 => 51,  193 => 49,  189 => 47,  187 => 108,  182 => 64,  176 => 44,  173 => 43,  168 => 41,  164 => 100,  162 => 39,  154 => 48,  149 => 41,  147 => 45,  144 => 92,  141 => 53,  133 => 43,  130 => 40,  125 => 27,  122 => 26,  116 => 37,  112 => 69,  109 => 73,  106 => 81,  103 => 71,  99 => 63,  95 => 29,  92 => 17,  86 => 27,  82 => 37,  80 => 56,  73 => 18,  64 => 15,  60 => 14,  57 => 20,  54 => 14,  51 => 22,  48 => 13,  45 => 12,  42 => 13,  39 => 4,  36 => 6,  33 => 5,  30 => 4,);
    }
}
