<?php

/* MinsalCitasBundle:Reports:comprobante_cita_procedimiento.html.twig */
class __TwigTemplate_b4f211aca7a020bf7dc8d8935078baa7da0ea73805ae443f807f58149549aeeb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("ApplicationCoreBundle:Reports:standardHtmlReports.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'javascript' => array($this, 'block_javascript'),
            'stylesheet' => array($this, 'block_stylesheet'),
            'body' => array($this, 'block_body'),
            'iframe' => array($this, 'block_iframe'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "ApplicationCoreBundle:Reports:standardHtmlReports.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["urlDefault"] = $this->env->getExtension('routing')->getUrl("procedimientosbuildcomprobante", array("id" => (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"))));
        // line 4
        $context["urlTicket"] = $this->env->getExtension('routing')->getUrl("procedimientosbuildcomprobante_ticket", array("id" => (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"))));
        // line 6
        if ((array_key_exists("print_ticket", $context) && twig_in_filter($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_moduleSelection"), "method"), (isset($context["print_ticket"]) ? $context["print_ticket"] : $this->getContext($context, "print_ticket"))))) {
            // line 7
            $context["availableTicket"] = true;
        } else {
            // line 9
            $context["availableTicket"] = false;
        }
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 12
    public function block_title($context, array $blocks = array())
    {
        echo "Comprobante de Cita";
    }

    // line 13
    public function block_javascript($context, array $blocks = array())
    {
        // line 14
        echo "    ";
        $this->displayParentBlock("javascript", $context, $blocks);
        echo "
    <!--script type=\"text/javascript\">
        jQuery(document).ready(function(\$) {
            \$iframe = \$('iframe#content-iframe');

            \$iframe.load(function() {
                  this.contentWindow.print();
            });
        });
    </script-->
        <script type=\"text/javascript\">
            jQuery(document).ready(function(\$) {
                var selectedPrinted = \$('#printer-selection option:selected').val();
                hideShowComprobante(selectedPrinted);

                \$('#printer-selection').on('change', function() {
                    hideShowComprobante(\$(this).val());
                });

                function hideShowComprobante(selectedPrinted) {
                    switch (selectedPrinted) {
                        case 'ticket':
                            \$('#content-iframe').addClass('hidden');
                            // \$('#footer-page').addClass('hidden');
                            \$('#content-ticket').removeClass('hidden');
                            break;
                        default:
                            \$('#content-ticket').addClass('hidden');
                            \$('#content-iframe').removeClass('hidden');
                            // \$('#footer-page').removeClass('hidden');
                            break;
                    }
                }
            });
        </script>
";
    }

    // line 51
    public function block_stylesheet($context, array $blocks = array())
    {
        // line 52
        echo "    ";
        $this->displayParentBlock("stylesheet", $context, $blocks);
        echo "
    ";
        // line 53
        if (((isset($context["availableTicket"]) ? $context["availableTicket"] : $this->getContext($context, "availableTicket")) === true)) {
            // line 54
            echo "        <style media=\"screen\">
            html, body {
                width: 100%;
                height: 100%;
            }
        </style>
    ";
        }
    }

    // line 63
    public function block_body($context, array $blocks = array())
    {
        // line 64
        echo "    <div class=\"row";
        if (((isset($context["availableTicket"]) ? $context["availableTicket"] : $this->getContext($context, "availableTicket")) === false)) {
            echo " hidden";
        }
        echo "\">
        <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\" style=\"text-align:center;margin-top:10px;\">
            <strong>Seleccionar Tipo de Impresi&oacute;n</strong>
        </div>
        <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\" style=\"text-align:center;\">
            <select id=\"printer-selection\" class=\"form-control col-xs-12\" style=\"width:450px;display:block;margin: 10px auto 20px auto;float:none;\">
                <option value=\"default\" ";
        // line 70
        if (((isset($context["availableTicket"]) ? $context["availableTicket"] : $this->getContext($context, "availableTicket")) === false)) {
            echo "selected";
        }
        echo ">Impresora</option>
                <option value=\"ticket\" ";
        // line 71
        if (((isset($context["availableTicket"]) ? $context["availableTicket"] : $this->getContext($context, "availableTicket")) === true)) {
            echo "selected";
        }
        echo ">Ticket</option>
            </select>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
            ";
        // line 77
        $this->displayBlock('iframe', $context, $blocks);
        // line 83
        echo "            ";
        $this->displayBlock('content', $context, $blocks);
        // line 86
        echo "        </div>
    </div>
";
    }

    // line 77
    public function block_iframe($context, array $blocks = array())
    {
        // line 78
        echo "                <center id=\"content-default\">
                    <iframe id=\"content-ticket\" src=\"";
        // line 79
        echo twig_escape_filter($this->env, (isset($context["urlTicket"]) ? $context["urlTicket"] : $this->getContext($context, "urlTicket")), "html", null, true);
        echo "\" style=\"width:100%; height:100%;min-height: 481px;\"></iframe>
                    <iframe id=\"content-iframe\" name=\"content-iframe\" src=\"";
        // line 80
        echo twig_escape_filter($this->env, (isset($context["urlDefault"]) ? $context["urlDefault"] : $this->getContext($context, "urlDefault")), "html", null, true);
        echo "\" scrolling=\"no\"></iframe>
                </center>
            ";
    }

    // line 83
    public function block_content($context, array $blocks = array())
    {
        // line 84
        echo "                ";
        $this->displayParentBlock("content", $context, $blocks);
        echo "
            ";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:Reports:comprobante_cita_procedimiento.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1119 => 855,  1116 => 854,  1075 => 869,  1054 => 863,  1050 => 861,  1034 => 856,  1031 => 854,  1025 => 852,  1023 => 851,  1020 => 850,  1017 => 849,  1000 => 843,  987 => 840,  972 => 833,  945 => 816,  943 => 815,  794 => 670,  770 => 661,  759 => 657,  723 => 628,  854 => 585,  850 => 584,  838 => 575,  826 => 569,  755 => 541,  750 => 539,  741 => 533,  704 => 517,  736 => 544,  706 => 519,  702 => 516,  1720 => 1573,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1480,  1609 => 1479,  1594 => 1472,  1590 => 1471,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 841,  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 697,  803 => 630,  606 => 447,  691 => 492,  655 => 481,  484 => 412,  552 => 439,  709 => 520,  397 => 337,  392 => 251,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 988,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 866,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 857,  992 => 720,  962 => 697,  960 => 826,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 284,  419 => 293,  639 => 468,  611 => 386,  538 => 444,  646 => 307,  642 => 492,  544 => 434,  541 => 204,  517 => 427,  797 => 671,  752 => 533,  748 => 458,  681 => 412,  677 => 507,  630 => 181,  618 => 172,  535 => 430,  519 => 425,  416 => 215,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 842,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 552,  775 => 550,  762 => 544,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 406,  534 => 348,  530 => 428,  521 => 194,  489 => 179,  483 => 206,  394 => 196,  396 => 256,  345 => 243,  476 => 174,  386 => 162,  364 => 235,  234 => 155,  595 => 326,  589 => 450,  586 => 451,  562 => 505,  556 => 274,  506 => 429,  498 => 417,  492 => 274,  473 => 277,  458 => 121,  399 => 199,  352 => 190,  346 => 239,  328 => 193,  880 => 699,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 489,  573 => 516,  567 => 507,  520 => 394,  481 => 335,  475 => 409,  472 => 408,  466 => 227,  441 => 346,  438 => 189,  432 => 380,  429 => 222,  395 => 400,  382 => 202,  378 => 249,  367 => 197,  357 => 222,  348 => 190,  334 => 196,  286 => 219,  205 => 155,  297 => 182,  218 => 144,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 579,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 667,  784 => 293,  782 => 665,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 534,  740 => 456,  734 => 530,  731 => 392,  728 => 528,  725 => 251,  719 => 257,  716 => 438,  714 => 522,  711 => 540,  705 => 539,  701 => 261,  690 => 302,  687 => 301,  671 => 490,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 470,  609 => 273,  602 => 230,  591 => 453,  571 => 419,  499 => 421,  488 => 273,  389 => 235,  223 => 161,  14 => 2,  306 => 227,  303 => 183,  300 => 223,  292 => 37,  280 => 153,  12 => 36,  624 => 282,  620 => 223,  612 => 467,  601 => 379,  599 => 441,  580 => 265,  574 => 447,  559 => 504,  526 => 429,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 335,  401 => 334,  391 => 216,  369 => 189,  333 => 234,  329 => 93,  307 => 237,  287 => 236,  195 => 153,  178 => 105,  956 => 271,  953 => 822,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 587,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 564,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 662,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 504,  663 => 484,  660 => 194,  657 => 482,  650 => 483,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 482,  603 => 229,  600 => 178,  594 => 454,  588 => 372,  584 => 488,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 156,  513 => 425,  479 => 388,  468 => 407,  451 => 287,  448 => 389,  424 => 342,  418 => 344,  410 => 271,  376 => 191,  373 => 257,  340 => 209,  326 => 222,  261 => 138,  118 => 62,  200 => 125,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 991,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 899,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 871,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 867,  1056 => 864,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 858,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 846,  1004 => 266,  982 => 839,  979 => 838,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 823,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 567,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 557,  793 => 556,  785 => 666,  783 => 177,  772 => 172,  769 => 171,  767 => 660,  764 => 659,  756 => 460,  753 => 540,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 525,  712 => 521,  710 => 502,  707 => 501,  699 => 142,  697 => 513,  696 => 204,  695 => 230,  694 => 512,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 500,  654 => 484,  649 => 308,  643 => 306,  640 => 491,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 434,  550 => 255,  527 => 442,  515 => 191,  512 => 391,  509 => 422,  503 => 427,  496 => 423,  493 => 415,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 343,  408 => 338,  388 => 292,  371 => 256,  363 => 244,  350 => 245,  342 => 274,  335 => 235,  316 => 232,  290 => 154,  276 => 176,  266 => 204,  263 => 146,  255 => 209,  245 => 195,  207 => 138,  194 => 139,  184 => 148,  76 => 46,  810 => 238,  804 => 493,  801 => 560,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 663,  774 => 249,  771 => 412,  768 => 547,  766 => 546,  761 => 658,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 509,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 219,  627 => 236,  622 => 481,  619 => 212,  616 => 468,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 448,  572 => 204,  566 => 324,  547 => 435,  545 => 253,  542 => 432,  533 => 430,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 388,  443 => 387,  431 => 351,  428 => 250,  425 => 277,  422 => 373,  412 => 152,  406 => 201,  390 => 164,  383 => 193,  377 => 246,  375 => 248,  372 => 200,  370 => 208,  359 => 251,  356 => 250,  353 => 131,  349 => 189,  336 => 272,  332 => 239,  330 => 233,  318 => 233,  313 => 231,  291 => 218,  190 => 124,  321 => 229,  295 => 221,  274 => 152,  242 => 194,  236 => 156,  70 => 44,  170 => 107,  288 => 217,  284 => 154,  279 => 134,  275 => 180,  256 => 171,  250 => 2,  237 => 168,  232 => 159,  222 => 151,  191 => 129,  153 => 86,  150 => 83,  563 => 188,  560 => 435,  558 => 195,  553 => 256,  549 => 438,  543 => 179,  537 => 431,  532 => 403,  528 => 199,  525 => 311,  523 => 441,  518 => 292,  514 => 392,  511 => 243,  508 => 424,  501 => 422,  491 => 288,  487 => 411,  460 => 240,  455 => 120,  449 => 164,  442 => 353,  439 => 226,  436 => 159,  433 => 345,  426 => 180,  420 => 220,  415 => 339,  411 => 339,  405 => 269,  403 => 149,  380 => 260,  366 => 285,  354 => 191,  331 => 173,  325 => 236,  320 => 182,  317 => 227,  311 => 225,  308 => 243,  304 => 207,  272 => 183,  267 => 189,  249 => 206,  216 => 143,  155 => 141,  146 => 91,  126 => 59,  188 => 128,  181 => 109,  161 => 113,  110 => 126,  124 => 64,  692 => 373,  683 => 282,  678 => 279,  676 => 488,  666 => 485,  661 => 488,  656 => 499,  652 => 497,  645 => 493,  641 => 352,  635 => 489,  631 => 475,  625 => 460,  615 => 453,  607 => 363,  597 => 455,  590 => 223,  583 => 435,  579 => 353,  577 => 420,  575 => 212,  569 => 514,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 405,  529 => 222,  524 => 344,  516 => 424,  510 => 78,  504 => 145,  500 => 386,  495 => 416,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 279,  421 => 341,  417 => 219,  400 => 267,  385 => 203,  361 => 252,  344 => 238,  339 => 273,  324 => 102,  310 => 165,  302 => 240,  296 => 38,  282 => 178,  259 => 201,  244 => 204,  231 => 123,  226 => 151,  215 => 191,  186 => 126,  152 => 113,  114 => 50,  104 => 56,  358 => 242,  351 => 240,  347 => 275,  343 => 188,  338 => 241,  327 => 232,  323 => 49,  319 => 220,  315 => 198,  301 => 235,  299 => 234,  293 => 205,  289 => 237,  281 => 182,  277 => 208,  271 => 206,  265 => 169,  262 => 170,  260 => 211,  257 => 200,  251 => 181,  248 => 139,  239 => 139,  228 => 164,  225 => 149,  213 => 123,  211 => 140,  197 => 140,  174 => 115,  148 => 77,  134 => 90,  127 => 78,  20 => 1,  270 => 166,  253 => 3,  233 => 167,  212 => 106,  210 => 128,  206 => 152,  202 => 121,  198 => 120,  192 => 114,  185 => 110,  180 => 146,  175 => 103,  172 => 118,  167 => 116,  165 => 79,  160 => 143,  137 => 71,  113 => 60,  100 => 101,  90 => 44,  81 => 49,  65 => 42,  129 => 69,  97 => 100,  77 => 44,  34 => 6,  53 => 7,  84 => 1,  58 => 18,  23 => 3,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 344,  427 => 350,  423 => 256,  413 => 338,  409 => 219,  407 => 247,  402 => 210,  398 => 207,  393 => 265,  387 => 263,  384 => 251,  381 => 236,  379 => 110,  374 => 137,  368 => 255,  365 => 119,  362 => 234,  360 => 223,  355 => 280,  341 => 237,  337 => 197,  322 => 266,  314 => 226,  312 => 187,  309 => 48,  305 => 223,  298 => 239,  294 => 238,  285 => 179,  283 => 31,  278 => 217,  268 => 173,  264 => 188,  258 => 210,  252 => 166,  247 => 1,  241 => 203,  229 => 138,  220 => 150,  214 => 141,  177 => 111,  169 => 80,  140 => 114,  132 => 61,  128 => 107,  107 => 57,  61 => 19,  273 => 185,  269 => 214,  254 => 199,  243 => 140,  240 => 176,  238 => 192,  235 => 153,  230 => 200,  227 => 178,  224 => 151,  221 => 163,  219 => 174,  217 => 173,  208 => 132,  204 => 142,  179 => 84,  159 => 77,  143 => 89,  135 => 84,  119 => 64,  102 => 51,  71 => 44,  67 => 103,  63 => 102,  59 => 40,  28 => 3,  94 => 99,  89 => 46,  85 => 96,  75 => 93,  68 => 35,  56 => 32,  87 => 2,  201 => 134,  196 => 131,  183 => 127,  171 => 100,  166 => 106,  163 => 114,  158 => 93,  156 => 92,  151 => 94,  142 => 109,  138 => 65,  136 => 85,  121 => 55,  117 => 73,  105 => 54,  91 => 98,  62 => 71,  49 => 82,  25 => 4,  21 => 2,  31 => 2,  38 => 4,  26 => 6,  24 => 13,  19 => 5,  93 => 52,  88 => 97,  78 => 39,  46 => 36,  44 => 29,  27 => 17,  79 => 94,  72 => 39,  69 => 72,  47 => 9,  40 => 33,  37 => 27,  22 => 14,  246 => 205,  157 => 116,  145 => 137,  139 => 86,  131 => 70,  123 => 58,  120 => 52,  115 => 127,  111 => 48,  108 => 125,  101 => 55,  98 => 52,  96 => 47,  83 => 1,  74 => 22,  66 => 73,  55 => 37,  52 => 31,  50 => 10,  43 => 1,  41 => 6,  35 => 33,  32 => 4,  29 => 6,  209 => 145,  203 => 139,  199 => 135,  193 => 130,  189 => 127,  187 => 149,  182 => 117,  176 => 83,  173 => 119,  168 => 99,  164 => 107,  162 => 78,  154 => 95,  149 => 90,  147 => 91,  144 => 2,  141 => 135,  133 => 2,  130 => 1,  125 => 68,  122 => 106,  116 => 63,  112 => 59,  109 => 104,  106 => 103,  103 => 53,  99 => 50,  95 => 51,  92 => 113,  86 => 2,  82 => 95,  80 => 33,  73 => 42,  64 => 34,  60 => 33,  57 => 39,  54 => 14,  51 => 13,  48 => 30,  45 => 12,  42 => 35,  39 => 9,  36 => 7,  33 => 4,  30 => 3,);
    }
}
