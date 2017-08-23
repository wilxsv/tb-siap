<?php

/* MinsalSeguimientoBundle:SecAntecedentes:show.html.twig */
class __TwigTemplate_2113a2cb9323ec2b7b8c54c949674c989f7378ad953dab8fba28120053abb543 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
            'tab_menu' => array($this, 'block_tab_menu'),
            'show' => array($this, 'block_show'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_actions($context, array $blocks = array())
    {
        // line 4
        echo "    <li>";
        $this->env->loadTemplate("SonataAdminBundle:Button:edit_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 5
        $this->env->loadTemplate("SonataAdminBundle:Button:history_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 6
        $this->env->loadTemplate("SonataAdminBundle:Button:list_button.html.twig")->display($context);
        echo "</li>
    <li>";
        // line 7
        $this->env->loadTemplate("SonataAdminBundle:Button:create_button.html.twig")->display($context);
        echo "</li>
";
    }

    // line 10
    public function block_tab_menu($context, array $blocks = array())
    {
        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active"), "list");
    }

    // line 12
    public function block_show($context, array $blocks = array())
    {
        // line 13
        echo "    <div class=\"sonata-ba-view\">

        ";
        // line 15
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["savedData"]) ? $context["savedData"] : $this->getContext($context, "savedData")));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            echo " ";
            // line 16
            echo "            <div class=\"panel panel-info\">
                <div class=\"panel-heading\"><b style=\"font-size: 17;\">";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "name"), "html", null, true);
            echo "</b> ";
            // line 18
            echo "                </div><br/>
                    <div class=\"table-responsive\" style=\"overflow-x: auto;\">
                        <table class=\"table table-bordered table-hover\" style=\"font-size: 14px;\">
                            <tbody>
                                ";
            // line 22
            if ($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "isCollection")) {
                echo " ";
                // line 23
                echo "                                    ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "collection"));
                foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                    echo " ";
                    // line 24
                    echo "                                        <tr class=\"sonata-ba-view-container\">
                                            ";
                    // line 25
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["row"]) ? $context["row"] : $this->getContext($context, "row")));
                    foreach ($context['_seq'] as $context["item"] => $context["data"]) {
                        echo " ";
                        // line 26
                        echo "                                                <th>";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "name"), "html", null, true);
                        echo "</th>
                                                <td>";
                        // line 27
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                        echo "</td>
                                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['item'], $context['data'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 29
                    echo "                                        </tr>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 31
                echo "                                ";
            } else {
                // line 32
                echo "                                    ";
                if ($this->getAttribute((isset($context["section"]) ? $context["section"] : null), "items", array(), "any", true, true)) {
                    // line 33
                    echo "                                        ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "items"));
                    foreach ($context['_seq'] as $context["item"] => $context["data"]) {
                        echo " ";
                        // line 34
                        echo "                                            <tr class=\"sonata-ba-view-container\">
                                                ";
                        // line 35
                        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "multiple", array(), "any", true, true)) {
                            echo "  ";
                            // line 36
                            echo "                                                    <th style=\"min-width: 250px;\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "name"), "html", null, true);
                            echo "</th>
                                                    <td>
                                                        ";
                            // line 38
                            if ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "hideTitle")) {
                                // line 39
                                echo "                                                            ";
                                if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "value")) > 0)) {
                                    // line 40
                                    echo "                                                                ";
                                    $context["answer"] = "SI";
                                    // line 41
                                    echo "                                                            ";
                                } else {
                                    // line 42
                                    echo "                                                                ";
                                    $context["answer"] = "NO";
                                    // line 43
                                    echo "                                                            ";
                                }
                                // line 44
                                echo "
                                                            ";
                                // line 45
                                echo twig_escape_filter($this->env, (isset($context["answer"]) ? $context["answer"] : $this->getContext($context, "answer")), "html", null, true);
                                echo "
                                                        ";
                            } else {
                                // line 47
                                echo "                                                        <ul>
                                                            ";
                                // line 48
                                $context['_parent'] = (array) $context;
                                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "value"));
                                foreach ($context['_seq'] as $context["_key"] => $context["subData"]) {
                                    // line 49
                                    echo "                                                                <li>";
                                    echo twig_escape_filter($this->env, (isset($context["subData"]) ? $context["subData"] : $this->getContext($context, "subData")), "html", null, true);
                                    echo "</li>
                                                            ";
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subData'], $context['_parent'], $context['loop']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 51
                                echo "                                                        </ul>
                                                        ";
                            }
                            // line 53
                            echo "
                                                    </td>
                                                ";
                        } else {
                            // line 55
                            echo " ";
                            // line 56
                            echo "                                                    <th style=\"min-width: 250px;\">";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "name"), "html", null, true);
                            echo "</th>
                                                    <td><span>";
                            // line 57
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                            echo "</span></td>
                                                ";
                        }
                        // line 59
                        echo "                                            </tr>
                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['item'], $context['data'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 61
                    echo "                                    ";
                }
                // line 62
                echo "
                                ";
            }
            // line 64
            echo "                            </tbody>
                        </table>
                    </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 69
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecAntecedentes:show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  535 => 224,  519 => 219,  416 => 172,  1082 => 552,  1076 => 550,  1072 => 548,  1069 => 547,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 450,  842 => 443,  836 => 440,  824 => 435,  781 => 416,  775 => 413,  762 => 406,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 388,  708 => 381,  703 => 378,  674 => 366,  659 => 359,  636 => 350,  604 => 329,  581 => 320,  568 => 315,  539 => 226,  534 => 298,  530 => 297,  521 => 220,  489 => 208,  483 => 206,  394 => 234,  396 => 163,  345 => 283,  476 => 315,  386 => 284,  364 => 219,  234 => 78,  595 => 326,  589 => 192,  586 => 322,  562 => 312,  556 => 182,  506 => 103,  498 => 211,  492 => 281,  473 => 165,  458 => 266,  399 => 143,  352 => 211,  346 => 125,  328 => 104,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 251,  758 => 405,  667 => 218,  573 => 172,  567 => 170,  520 => 177,  481 => 167,  475 => 203,  472 => 202,  466 => 156,  441 => 346,  438 => 149,  432 => 182,  429 => 342,  395 => 287,  382 => 128,  378 => 281,  367 => 120,  357 => 144,  348 => 115,  334 => 110,  286 => 90,  205 => 64,  297 => 92,  218 => 81,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 296,  787 => 419,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 259,  740 => 239,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 224,  628 => 214,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 316,  499 => 154,  488 => 172,  389 => 318,  223 => 172,  14 => 2,  306 => 117,  303 => 91,  300 => 115,  292 => 86,  280 => 103,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 328,  599 => 327,  580 => 194,  574 => 230,  559 => 311,  526 => 179,  497 => 173,  485 => 318,  463 => 268,  447 => 152,  404 => 238,  401 => 289,  391 => 161,  369 => 129,  333 => 132,  329 => 275,  307 => 96,  287 => 58,  195 => 54,  178 => 48,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 265,  807 => 259,  805 => 426,  802 => 425,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 368,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 356,  647 => 355,  644 => 190,  632 => 349,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 224,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 307,  448 => 306,  424 => 249,  418 => 112,  410 => 113,  376 => 224,  373 => 152,  340 => 122,  326 => 256,  261 => 76,  118 => 49,  200 => 95,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 543,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 536,  1036 => 534,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 255,  796 => 422,  793 => 421,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 231,  710 => 149,  707 => 208,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 357,  649 => 122,  643 => 227,  640 => 226,  638 => 351,  617 => 112,  614 => 201,  598 => 107,  593 => 201,  576 => 101,  564 => 162,  557 => 310,  550 => 94,  527 => 296,  515 => 305,  512 => 290,  509 => 228,  503 => 81,  496 => 282,  493 => 155,  478 => 204,  467 => 197,  456 => 309,  450 => 114,  414 => 242,  408 => 239,  388 => 231,  371 => 72,  363 => 32,  350 => 142,  342 => 282,  335 => 136,  316 => 16,  290 => 110,  276 => 102,  266 => 83,  263 => 81,  255 => 185,  245 => 122,  207 => 1,  194 => 106,  184 => 89,  76 => 21,  810 => 238,  804 => 260,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 399,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 372,  685 => 371,  682 => 226,  672 => 223,  670 => 365,  665 => 362,  648 => 219,  627 => 206,  622 => 204,  619 => 212,  616 => 202,  613 => 210,  610 => 332,  608 => 197,  605 => 207,  596 => 106,  592 => 325,  587 => 197,  585 => 196,  582 => 190,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 228,  542 => 227,  533 => 186,  531 => 95,  507 => 287,  505 => 214,  502 => 175,  477 => 164,  471 => 164,  465 => 161,  454 => 265,  446 => 156,  443 => 256,  431 => 151,  428 => 250,  425 => 152,  422 => 338,  412 => 147,  406 => 111,  390 => 139,  383 => 159,  377 => 73,  375 => 124,  372 => 277,  370 => 222,  359 => 145,  356 => 269,  353 => 143,  349 => 119,  336 => 205,  332 => 259,  330 => 554,  318 => 122,  313 => 209,  291 => 108,  190 => 59,  321 => 254,  295 => 201,  274 => 85,  242 => 121,  236 => 177,  70 => 17,  170 => 230,  288 => 197,  284 => 89,  279 => 193,  275 => 227,  256 => 80,  250 => 73,  237 => 75,  232 => 136,  222 => 129,  191 => 55,  153 => 53,  150 => 46,  563 => 188,  560 => 187,  558 => 186,  553 => 309,  549 => 182,  543 => 179,  537 => 176,  532 => 223,  528 => 173,  525 => 172,  523 => 171,  518 => 292,  514 => 218,  511 => 217,  508 => 165,  501 => 212,  491 => 157,  487 => 156,  460 => 194,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 183,  433 => 130,  426 => 126,  420 => 297,  415 => 121,  411 => 170,  405 => 118,  403 => 117,  380 => 107,  366 => 106,  354 => 101,  331 => 96,  325 => 94,  320 => 100,  317 => 99,  311 => 98,  308 => 205,  304 => 95,  272 => 81,  267 => 130,  249 => 78,  216 => 68,  155 => 43,  146 => 40,  126 => 13,  188 => 54,  181 => 107,  161 => 45,  110 => 29,  124 => 44,  692 => 373,  683 => 282,  678 => 279,  676 => 367,  666 => 126,  661 => 380,  656 => 358,  652 => 376,  645 => 215,  641 => 352,  635 => 226,  631 => 218,  625 => 361,  615 => 335,  607 => 208,  597 => 177,  590 => 202,  583 => 321,  579 => 284,  577 => 319,  575 => 328,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 299,  529 => 222,  524 => 90,  516 => 291,  510 => 78,  504 => 90,  500 => 88,  495 => 210,  490 => 154,  486 => 165,  482 => 317,  470 => 313,  464 => 196,  459 => 116,  452 => 191,  434 => 252,  421 => 90,  417 => 296,  400 => 116,  385 => 129,  361 => 207,  344 => 139,  339 => 137,  324 => 102,  310 => 208,  302 => 93,  296 => 92,  282 => 104,  259 => 186,  244 => 82,  231 => 67,  226 => 70,  215 => 63,  186 => 53,  152 => 42,  114 => 40,  104 => 31,  358 => 103,  351 => 116,  347 => 210,  343 => 264,  338 => 109,  327 => 108,  323 => 522,  319 => 124,  315 => 121,  301 => 94,  299 => 201,  293 => 199,  289 => 91,  281 => 57,  277 => 86,  271 => 84,  265 => 82,  262 => 187,  260 => 128,  257 => 53,  251 => 182,  248 => 83,  239 => 120,  228 => 75,  225 => 65,  213 => 62,  211 => 156,  197 => 113,  174 => 59,  148 => 49,  134 => 50,  127 => 40,  20 => 1,  270 => 85,  253 => 78,  233 => 66,  212 => 158,  210 => 61,  206 => 109,  202 => 63,  198 => 57,  192 => 55,  185 => 57,  180 => 49,  175 => 47,  172 => 80,  167 => 44,  165 => 83,  160 => 50,  137 => 64,  113 => 37,  100 => 37,  90 => 33,  81 => 27,  65 => 26,  129 => 34,  97 => 26,  77 => 31,  34 => 4,  53 => 10,  84 => 80,  58 => 12,  23 => 3,  480 => 205,  474 => 274,  469 => 271,  461 => 70,  457 => 124,  453 => 151,  444 => 185,  440 => 184,  437 => 253,  435 => 344,  430 => 153,  427 => 180,  423 => 298,  413 => 241,  409 => 327,  407 => 169,  402 => 166,  398 => 235,  393 => 162,  387 => 160,  384 => 230,  381 => 315,  379 => 154,  374 => 36,  368 => 149,  365 => 119,  362 => 146,  360 => 216,  355 => 27,  341 => 138,  337 => 97,  322 => 93,  314 => 88,  312 => 97,  309 => 118,  305 => 204,  298 => 247,  294 => 100,  285 => 105,  283 => 5,  278 => 110,  268 => 101,  264 => 93,  258 => 75,  252 => 184,  247 => 72,  241 => 179,  229 => 86,  220 => 171,  214 => 58,  177 => 55,  169 => 48,  140 => 43,  132 => 35,  128 => 41,  107 => 35,  61 => 13,  273 => 190,  269 => 189,  254 => 86,  243 => 77,  240 => 76,  238 => 79,  235 => 74,  230 => 72,  227 => 69,  224 => 74,  221 => 61,  219 => 60,  217 => 64,  208 => 65,  204 => 63,  179 => 50,  159 => 40,  143 => 39,  135 => 36,  119 => 38,  102 => 27,  71 => 17,  67 => 16,  63 => 15,  59 => 13,  28 => 3,  94 => 35,  89 => 24,  85 => 31,  75 => 77,  68 => 16,  56 => 12,  87 => 27,  201 => 115,  196 => 61,  183 => 55,  171 => 63,  166 => 47,  163 => 200,  158 => 44,  156 => 75,  151 => 1,  142 => 67,  138 => 87,  136 => 45,  121 => 75,  117 => 31,  105 => 34,  91 => 29,  62 => 12,  49 => 66,  25 => 4,  21 => 2,  31 => 4,  38 => 15,  26 => 2,  24 => 3,  19 => 1,  93 => 28,  88 => 40,  78 => 19,  46 => 7,  44 => 7,  27 => 3,  79 => 21,  72 => 76,  69 => 27,  47 => 7,  40 => 6,  37 => 5,  22 => 4,  246 => 78,  157 => 49,  145 => 68,  139 => 52,  131 => 42,  123 => 33,  120 => 32,  115 => 40,  111 => 32,  108 => 37,  101 => 31,  98 => 30,  96 => 1,  83 => 23,  74 => 18,  66 => 16,  55 => 10,  52 => 13,  50 => 10,  43 => 6,  41 => 61,  35 => 3,  32 => 2,  29 => 3,  209 => 157,  203 => 59,  199 => 62,  193 => 56,  189 => 65,  187 => 58,  182 => 51,  176 => 49,  173 => 49,  168 => 202,  164 => 102,  162 => 102,  154 => 48,  149 => 41,  147 => 45,  144 => 49,  141 => 38,  133 => 43,  130 => 40,  125 => 78,  122 => 39,  116 => 48,  112 => 89,  109 => 33,  106 => 47,  103 => 49,  99 => 2,  95 => 29,  92 => 25,  86 => 29,  82 => 37,  80 => 22,  73 => 23,  64 => 15,  60 => 72,  57 => 23,  54 => 14,  51 => 22,  48 => 9,  45 => 7,  42 => 8,  39 => 4,  36 => 5,  33 => 2,  30 => 7,);
    }
}
