<?php

/* ApplicationCoreBundle:FormDinamico:base_show.html.twig */
class __TwigTemplate_c55b85ddcc44c0e9441d4d15a03be09a9c7c038c60b900191b2df3944065085c extends Twig_Template
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
        // line 14
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["savedData"]) ? $context["savedData"] : $this->getContext($context, "savedData")));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            echo " ";
            // line 15
            echo "        ";
            $context["colspan"] = "2";
            // line 16
            echo "            <div class=\"panel panel-info\">
                <div class=\"panel-heading\"><b style=\"font-size: 17;\">";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "name"), "html", null, true);
            echo "</b> ";
            // line 18
            echo "                </div>
                    <div class=\"table-responsive\" style=\"overflow-x: auto;\">
                        <table class=\"table table-bordered table-hover\" style=\"font-size: 14px;\">
                            <tbody>
                                ";
            // line 22
            if ($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "isCollection")) {
                echo " ";
                // line 23
                echo "                                    ";
                if (($this->getAttribute((isset($context["section"]) ? $context["section"] : null), "collection", array(), "any", true, true) && (twig_length_filter($this->env, $this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "collection")) > 0))) {
                    // line 24
                    echo "                                        ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "collection"));
                    foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                        echo " ";
                        // line 25
                        echo "                                            <tr class=\"sonata-ba-view-container\">
                                                ";
                        // line 26
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["row"]) ? $context["row"] : $this->getContext($context, "row")));
                        foreach ($context['_seq'] as $context["item"] => $context["data"]) {
                            echo " ";
                            // line 27
                            echo "                                                    <th>";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "name"), "html", null, true);
                            echo "</th>
                                                    <td>";
                            // line 28
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                            echo "</td>
                                                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['item'], $context['data'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 30
                        echo "                                            </tr>
                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 32
                    echo "                                     ";
                } else {
                    // line 33
                    echo "                                        <tr><td><p class=\"text-muted\">No hay registros para mostrar.</p></td></tr>
                                    ";
                }
                // line 35
                echo "                                ";
            } else {
                // line 36
                echo "                                    ";
                if (($this->getAttribute((isset($context["section"]) ? $context["section"] : null), "items", array(), "any", true, true) && (twig_length_filter($this->env, $this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "items")) > 0))) {
                    // line 37
                    echo "                                        ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["section"]) ? $context["section"] : $this->getContext($context, "section")), "items"));
                    foreach ($context['_seq'] as $context["item"] => $context["data"]) {
                        echo " ";
                        // line 38
                        echo "                                            ";
                        if (((isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")) == "2")) {
                            // line 39
                            echo "                                                <tr class=\"sonata-ba-view-container\">
                                            ";
                        }
                        // line 41
                        echo "                                                ";
                        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "multiple", array(), "any", true, true)) {
                            echo "  ";
                            // line 42
                            echo "                                                    <th style=\"min-width: 400px; padding-left: ";
                            echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "level") * 10), "html", null, true);
                            echo "px;\">";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "name"), "html", null, true);
                            echo "</th>
                                                    <td>
                                                        ";
                            // line 44
                            if ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "hideTitle")) {
                                // line 45
                                echo "                                                            ";
                                if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "value")) > 0)) {
                                    // line 46
                                    echo "                                                                ";
                                    $context["answer"] = "Sí";
                                    // line 47
                                    echo "                                                            ";
                                } else {
                                    // line 48
                                    echo "                                                                ";
                                    $context["answer"] = "No";
                                    // line 49
                                    echo "                                                            ";
                                }
                                // line 50
                                echo "
                                                            ";
                                // line 51
                                echo twig_escape_filter($this->env, (isset($context["answer"]) ? $context["answer"] : $this->getContext($context, "answer")), "html", null, true);
                                echo "
                                                        ";
                            } else {
                                // line 53
                                echo "                                                            <ul>
                                                                ";
                                // line 54
                                $context['_parent'] = (array) $context;
                                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "multiple"), "value"));
                                foreach ($context['_seq'] as $context["_key"] => $context["subData"]) {
                                    // line 55
                                    echo "                                                                    <li>";
                                    echo twig_escape_filter($this->env, (isset($context["subData"]) ? $context["subData"] : $this->getContext($context, "subData")), "html", null, true);
                                    echo "</li>
                                                                ";
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subData'], $context['_parent'], $context['loop']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 57
                                echo "                                                            </ul>
                                                        ";
                            }
                            // line 59
                            echo "
                                                    </td>
                                                ";
                        } else {
                            // line 61
                            echo " ";
                            // line 62
                            echo "                                                    ";
                            if ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "hideTitle")) {
                                // line 63
                                echo "                                                        ";
                                if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "itemObject"), "getIdFormItem", array(), "method"), "getIdTipoObjeto", array(), "method"), "getId", array(), "method") == 3)) {
                                    // line 64
                                    echo "                                                            ";
                                    $context["colspan"] = "1";
                                    // line 65
                                    echo "                                                            <th colspan=\"";
                                    echo twig_escape_filter($this->env, (isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")), "html", null, true);
                                    echo "\" style=\"min-width: 400px; padding-left: ";
                                    echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "level") * 10), "html", null, true);
                                    echo "px;\">";
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "name"), "html", null, true);
                                    echo "</th>
                                                        ";
                                } else {
                                    // line 67
                                    echo "                                                            <td colspan=\"";
                                    echo twig_escape_filter($this->env, (isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")), "html", null, true);
                                    echo "\" style=\"min-width: 250px;\">";
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                                    echo "</td>
                                                            ";
                                    // line 68
                                    $context["colspan"] = "2";
                                    // line 69
                                    echo "                                                            <!-- <td><span>";
                                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                                    echo "</span></td> -->
                                                        ";
                                }
                                // line 71
                                echo "                                                    ";
                            } else {
                                // line 72
                                echo "                                                        ";
                                if (((isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")) == "1")) {
                                    // line 73
                                    echo "                                                                <td colspan=\"";
                                    echo twig_escape_filter($this->env, (isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")), "html", null, true);
                                    echo "\" style=\"min-width: 250px;\"></td>
                                                            </tr>
                                                            <tr class=\"sonata-ba-view-container\">
                                                            ";
                                    // line 76
                                    $context["colspan"] = "2";
                                    // line 77
                                    echo "                                                        ";
                                }
                                // line 78
                                echo "                                                        <th style=\"min-width: 400px; padding-left: ";
                                echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "level") * 10), "html", null, true);
                                echo "px;\">";
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "name"), "html", null, true);
                                echo "</th>
                                                        <td><span>";
                                // line 79
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "value"), "html", null, true);
                                echo "</span></td>
                                                    ";
                            }
                            // line 81
                            echo "                                                ";
                        }
                        // line 82
                        echo "                                            ";
                        if (((isset($context["colspan"]) ? $context["colspan"] : $this->getContext($context, "colspan")) == "2")) {
                            // line 83
                            echo "                                                </tr>
                                            ";
                        }
                        // line 85
                        echo "                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['item'], $context['data'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 86
                    echo "                                    ";
                } else {
                    // line 87
                    echo "                                        <tr><td><p class=\"text-muted\">No hay registros para mostrar.</p></td></tr>
                                    ";
                }
                // line 89
                echo "
                                ";
            }
            // line 91
            echo "                            </tbody>
                        </table>
                    </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "ApplicationCoreBundle:FormDinamico:base_show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  880 => 288,  837 => 274,  827 => 270,  823 => 268,  821 => 267,  818 => 266,  789 => 251,  758 => 243,  667 => 218,  573 => 172,  567 => 170,  520 => 177,  481 => 162,  475 => 159,  472 => 158,  466 => 156,  441 => 150,  438 => 149,  432 => 147,  429 => 146,  395 => 132,  382 => 128,  378 => 126,  367 => 120,  357 => 118,  348 => 115,  334 => 110,  286 => 85,  205 => 59,  297 => 92,  218 => 64,  940 => 351,  932 => 346,  926 => 342,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 327,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 297,  808 => 296,  787 => 294,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 259,  740 => 239,  734 => 254,  731 => 253,  728 => 252,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 224,  628 => 214,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 228,  499 => 154,  488 => 148,  389 => 75,  223 => 46,  14 => 2,  306 => 95,  303 => 91,  300 => 93,  292 => 86,  280 => 87,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 216,  599 => 213,  580 => 194,  574 => 230,  559 => 201,  526 => 179,  497 => 173,  485 => 124,  463 => 117,  447 => 152,  404 => 135,  401 => 134,  391 => 76,  369 => 148,  333 => 132,  329 => 65,  307 => 82,  287 => 58,  195 => 54,  178 => 46,  956 => 271,  953 => 270,  946 => 302,  942 => 300,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 301,  820 => 243,  816 => 265,  807 => 259,  805 => 295,  802 => 235,  791 => 262,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 225,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 231,  647 => 230,  644 => 190,  632 => 187,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 164,  561 => 168,  554 => 224,  551 => 199,  546 => 175,  522 => 156,  513 => 230,  479 => 135,  468 => 128,  451 => 120,  448 => 121,  424 => 98,  418 => 112,  410 => 113,  376 => 153,  373 => 102,  340 => 136,  326 => 129,  261 => 77,  118 => 53,  200 => 64,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 297,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 276,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 304,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 255,  796 => 254,  793 => 182,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 265,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 231,  710 => 149,  707 => 208,  699 => 142,  697 => 141,  696 => 204,  695 => 230,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 123,  649 => 122,  643 => 227,  640 => 226,  638 => 118,  617 => 112,  614 => 111,  598 => 107,  593 => 201,  576 => 101,  564 => 162,  557 => 209,  550 => 94,  527 => 91,  515 => 305,  512 => 84,  509 => 228,  503 => 81,  496 => 79,  493 => 155,  478 => 143,  467 => 72,  456 => 154,  450 => 114,  414 => 94,  408 => 91,  388 => 130,  371 => 72,  363 => 32,  350 => 26,  342 => 23,  335 => 66,  316 => 16,  290 => 90,  276 => 81,  266 => 366,  263 => 133,  255 => 353,  245 => 335,  207 => 93,  194 => 89,  184 => 63,  76 => 18,  810 => 238,  804 => 260,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 248,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 241,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 202,  685 => 227,  682 => 226,  672 => 223,  670 => 222,  665 => 196,  648 => 219,  627 => 217,  622 => 216,  619 => 212,  616 => 211,  613 => 210,  610 => 209,  608 => 211,  605 => 207,  596 => 106,  592 => 203,  587 => 197,  585 => 196,  582 => 195,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 198,  542 => 186,  533 => 186,  531 => 181,  507 => 165,  505 => 180,  502 => 175,  477 => 164,  471 => 129,  465 => 161,  454 => 121,  446 => 156,  443 => 155,  431 => 151,  428 => 100,  425 => 149,  422 => 148,  412 => 126,  406 => 111,  390 => 43,  383 => 74,  377 => 73,  375 => 124,  372 => 122,  370 => 121,  359 => 70,  356 => 126,  353 => 69,  349 => 119,  336 => 115,  332 => 88,  330 => 103,  318 => 105,  313 => 96,  291 => 80,  190 => 49,  321 => 100,  295 => 87,  274 => 90,  242 => 121,  236 => 81,  70 => 16,  170 => 57,  288 => 79,  284 => 76,  279 => 82,  275 => 56,  256 => 79,  250 => 126,  237 => 71,  232 => 48,  222 => 73,  191 => 88,  153 => 72,  150 => 71,  563 => 211,  560 => 172,  558 => 167,  553 => 194,  549 => 182,  543 => 174,  537 => 184,  532 => 192,  528 => 180,  525 => 157,  523 => 178,  518 => 180,  514 => 167,  511 => 166,  508 => 165,  501 => 163,  491 => 171,  487 => 156,  460 => 155,  455 => 123,  449 => 153,  442 => 111,  439 => 133,  436 => 132,  433 => 60,  426 => 145,  420 => 143,  415 => 127,  411 => 120,  405 => 108,  403 => 48,  380 => 130,  366 => 150,  354 => 117,  331 => 109,  325 => 107,  320 => 87,  317 => 98,  311 => 62,  308 => 102,  304 => 81,  272 => 89,  267 => 78,  249 => 72,  216 => 71,  155 => 73,  146 => 34,  126 => 64,  188 => 54,  181 => 232,  161 => 51,  110 => 37,  124 => 55,  692 => 399,  683 => 282,  678 => 279,  676 => 265,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 215,  641 => 189,  635 => 226,  631 => 218,  625 => 361,  615 => 354,  607 => 208,  597 => 177,  590 => 202,  583 => 287,  579 => 284,  577 => 193,  575 => 328,  569 => 213,  565 => 324,  555 => 166,  548 => 188,  540 => 185,  536 => 194,  529 => 191,  524 => 90,  516 => 294,  510 => 293,  504 => 164,  500 => 174,  495 => 166,  490 => 154,  486 => 165,  482 => 145,  470 => 121,  464 => 125,  459 => 116,  452 => 158,  434 => 118,  421 => 90,  417 => 142,  400 => 47,  385 => 129,  361 => 207,  344 => 113,  339 => 116,  324 => 179,  310 => 103,  302 => 93,  296 => 151,  282 => 83,  259 => 76,  244 => 83,  231 => 67,  226 => 102,  215 => 63,  186 => 51,  152 => 42,  114 => 39,  104 => 43,  358 => 103,  351 => 116,  347 => 68,  343 => 92,  338 => 130,  327 => 108,  323 => 99,  319 => 124,  315 => 98,  301 => 80,  299 => 89,  293 => 59,  289 => 94,  281 => 57,  277 => 95,  271 => 79,  265 => 51,  262 => 81,  260 => 363,  257 => 53,  251 => 110,  248 => 336,  239 => 82,  228 => 103,  225 => 108,  213 => 70,  211 => 69,  197 => 30,  174 => 49,  148 => 41,  134 => 28,  127 => 43,  20 => 1,  270 => 84,  253 => 78,  233 => 80,  212 => 62,  210 => 61,  206 => 57,  202 => 65,  198 => 55,  192 => 55,  185 => 53,  180 => 51,  175 => 81,  172 => 81,  167 => 55,  165 => 46,  160 => 44,  137 => 66,  113 => 38,  100 => 15,  90 => 29,  81 => 26,  65 => 35,  129 => 35,  97 => 26,  77 => 28,  34 => 5,  53 => 14,  84 => 27,  58 => 16,  23 => 11,  480 => 75,  474 => 122,  469 => 157,  461 => 70,  457 => 124,  453 => 151,  444 => 151,  440 => 154,  437 => 61,  435 => 148,  430 => 101,  427 => 143,  423 => 144,  413 => 241,  409 => 141,  407 => 136,  402 => 107,  398 => 88,  393 => 131,  387 => 134,  384 => 106,  381 => 157,  379 => 154,  374 => 36,  368 => 34,  365 => 119,  362 => 148,  360 => 128,  355 => 27,  341 => 67,  337 => 90,  322 => 106,  314 => 88,  312 => 97,  309 => 82,  305 => 101,  298 => 91,  294 => 100,  285 => 88,  283 => 92,  278 => 408,  268 => 373,  264 => 78,  258 => 72,  252 => 73,  247 => 75,  241 => 107,  229 => 47,  220 => 99,  214 => 63,  177 => 50,  169 => 80,  140 => 67,  132 => 36,  128 => 57,  107 => 28,  61 => 17,  273 => 84,  269 => 88,  254 => 46,  243 => 73,  240 => 69,  238 => 68,  235 => 105,  230 => 62,  227 => 76,  224 => 101,  221 => 65,  219 => 76,  217 => 64,  208 => 102,  204 => 101,  179 => 60,  159 => 50,  143 => 66,  135 => 37,  119 => 40,  102 => 27,  71 => 22,  67 => 15,  63 => 16,  59 => 13,  28 => 3,  94 => 25,  89 => 35,  85 => 23,  75 => 19,  68 => 21,  56 => 12,  87 => 28,  201 => 57,  196 => 89,  183 => 84,  171 => 48,  166 => 209,  163 => 58,  158 => 74,  156 => 75,  151 => 54,  142 => 22,  138 => 47,  136 => 46,  121 => 51,  117 => 45,  105 => 35,  91 => 23,  62 => 14,  49 => 11,  25 => 3,  21 => 11,  31 => 4,  38 => 5,  26 => 2,  24 => 14,  19 => 11,  93 => 30,  88 => 24,  78 => 25,  46 => 9,  44 => 7,  27 => 4,  79 => 29,  72 => 25,  69 => 23,  47 => 22,  40 => 6,  37 => 6,  22 => 12,  246 => 71,  157 => 56,  145 => 53,  139 => 51,  131 => 48,  123 => 63,  120 => 42,  115 => 30,  111 => 35,  108 => 47,  101 => 50,  98 => 25,  96 => 32,  83 => 25,  74 => 26,  66 => 21,  55 => 15,  52 => 12,  50 => 10,  43 => 9,  41 => 20,  35 => 5,  32 => 15,  29 => 15,  209 => 58,  203 => 32,  199 => 90,  193 => 36,  189 => 34,  187 => 69,  182 => 87,  176 => 85,  173 => 58,  168 => 47,  164 => 53,  162 => 45,  154 => 48,  149 => 72,  147 => 52,  144 => 39,  141 => 38,  133 => 45,  130 => 44,  125 => 33,  122 => 32,  116 => 39,  112 => 56,  109 => 50,  106 => 53,  103 => 52,  99 => 33,  95 => 41,  92 => 37,  86 => 30,  82 => 22,  80 => 24,  73 => 17,  64 => 20,  60 => 12,  57 => 14,  54 => 12,  51 => 12,  48 => 12,  45 => 11,  42 => 10,  39 => 20,  36 => 5,  33 => 3,  30 => 4,);
    }
}
