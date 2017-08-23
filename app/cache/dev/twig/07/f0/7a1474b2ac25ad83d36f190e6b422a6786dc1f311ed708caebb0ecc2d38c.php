<?php

/* MinsalSiapsBundle:MntAmbienteAreaEstablecimiento:generar_servicios.html.twig */
class __TwigTemplate_07f07a1474b2ac25ad83d36f190e6b422a6786dc1f311ed708caebb0ecc2d38c extends Twig_Template
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
        echo "<legend>Generación de los servicios de hospitalización</legend>
";
        // line 2
        if (((isset($context["porSexo"]) ? $context["porSexo"] : $this->getContext($context, "porSexo")) == "true")) {
            // line 3
            echo "    ";
            if (((isset($context["numeroAmbientes"]) ? $context["numeroAmbientes"] : $this->getContext($context, "numeroAmbientes")) > 0)) {
                // line 4
                echo "      ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable(range(1, 2, 1));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 5
                    echo "            ";
                    if (((isset($context["i"]) ? $context["i"] : $this->getContext($context, "i")) == 1)) {
                        // line 6
                        echo "                ";
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["numeroAmbientes"]) ? $context["numeroAmbientes"] : $this->getContext($context, "numeroAmbientes")), 1));
                        foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
                            // line 7
                            echo "                    <div class=\"form-group\">
                        <div class=\"sonata-ba-field sonata-ba-field-standard-natural\">
                            <input type=\"text\" style=\"width: 400px\" class=\"fomr-control\" name=\"";
                            // line 9
                            echo twig_escape_filter($this->env, (isset($context["j"]) ? $context["j"] : $this->getContext($context, "j")), "html", null, true);
                            echo "_muj_nombre\" value=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["especialidades"]) ? $context["especialidades"] : $this->getContext($context, "especialidades")), "nombre"), "html", null, true);
                            echo " Mujeres ";
                            echo twig_escape_filter($this->env, (isset($context["j"]) ? $context["j"] : $this->getContext($context, "j")), "html", null, true);
                            echo "\"/>
                        </div>
                    </div>
                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 13
                        echo "            ";
                    } else {
                        // line 14
                        echo "                ";
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["numeroAmbientes"]) ? $context["numeroAmbientes"] : $this->getContext($context, "numeroAmbientes"))));
                        foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
                            // line 15
                            echo "                    <div class=\"form-group\">
                        <div class=\"sonata-ba-field sonata-ba-field-standard-natural\">
                            <input type=\"text\" style=\"width: 400px\" class=\"fomr-control\" name=\"";
                            // line 17
                            echo twig_escape_filter($this->env, (isset($context["j"]) ? $context["j"] : $this->getContext($context, "j")), "html", null, true);
                            echo "_hom_nombre\" value=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["especialidades"]) ? $context["especialidades"] : $this->getContext($context, "especialidades")), "nombre"), "html", null, true);
                            echo " Hombres ";
                            echo twig_escape_filter($this->env, (isset($context["j"]) ? $context["j"] : $this->getContext($context, "j")), "html", null, true);
                            echo "\" />
                        </div>
                    </div>
                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 21
                        echo "            ";
                    }
                    // line 22
                    echo "        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 23
                echo "    ";
            } else {
                echo " 
        <div class=\"form-group\">
            <div class=\"sonata-ba-field sonata-ba-field-standard-natural\">
                <input type=\"text\" style=\"width: 400px\" class=\"fomr-control\" name=\"muj_nombre\" value=\"";
                // line 26
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["especialidades"]) ? $context["especialidades"] : $this->getContext($context, "especialidades")), "nombre"), "html", null, true);
                echo " Mujeres\"/>
            </div>
        </div>
        <div class=\"form-group\">
            <div class=\"sonata-ba-field sonata-ba-field-standard-natural\">
                <input type=\"text\" style=\"width: 400px\" class=\"fomr-control\" name=\"hom_nombre\" value=\"";
                // line 31
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["especialidades"]) ? $context["especialidades"] : $this->getContext($context, "especialidades")), "nombre"), "html", null, true);
                echo " Hombres\" />
            </div>
        </div>
     ";
            }
        } else {
            // line 35
            echo "  
    ";
            // line 36
            if (((isset($context["numeroAmbientes"]) ? $context["numeroAmbientes"] : $this->getContext($context, "numeroAmbientes")) > 0)) {
                // line 37
                echo "        ";
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["numeroAmbientes"]) ? $context["numeroAmbientes"] : $this->getContext($context, "numeroAmbientes")), 1));
                foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
                    // line 38
                    echo "            <div class=\"form-group\">
                <div class=\"sonata-ba-field sonata-ba-field-standard-natural\">
                    <input type=\"text\" class=\"fomr-control\" name=\"";
                    // line 40
                    echo twig_escape_filter($this->env, (isset($context["j"]) ? $context["j"] : $this->getContext($context, "j")), "html", null, true);
                    echo "_nombre\" value=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["especialidades"]) ? $context["especialidades"] : $this->getContext($context, "especialidades")), "nombre"), "html", null, true);
                    echo " ";
                    echo twig_escape_filter($this->env, (isset($context["j"]) ? $context["j"] : $this->getContext($context, "j")), "html", null, true);
                    echo "\"/>
                </div>
            </div>
         ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 44
                echo "    ";
            } else {
                echo " 
        <div class=\"form-group\">
            <div class=\"sonata-ba-field sonata-ba-field-standard-natural\">
                <input type=\"text\" class=\"fomr-control\" name=\"nombre\" value=\"";
                // line 47
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["especialidades"]) ? $context["especialidades"] : $this->getContext($context, "especialidades")), "nombre"), "html", null, true);
                echo "\"/>
            </div>
        </div>
    ";
            }
            // line 50
            echo "    
";
        }
        // line 52
        echo "<input type=\"submit\" class=\"btn btn-success\" name=\"btn_create_and_list\" value=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create_and_return_to_list", array(), "SonataAdminBundle"), "html", null, true);
        echo "\"/>
<input class=\"btn btn-success\" type=\"submit\" name=\"btn_create_and_create\" value=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_create_and_create_a_new_one", array(), "SonataAdminBundle"), "html", null, true);
        echo "\"/>
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:MntAmbienteAreaEstablecimiento:generar_servicios.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  595 => 193,  589 => 192,  586 => 191,  562 => 184,  556 => 182,  506 => 103,  498 => 78,  492 => 76,  473 => 165,  458 => 160,  399 => 143,  352 => 126,  346 => 125,  328 => 117,  880 => 288,  837 => 274,  827 => 270,  823 => 268,  821 => 267,  818 => 266,  789 => 251,  758 => 243,  667 => 218,  573 => 172,  567 => 170,  520 => 177,  481 => 167,  475 => 159,  472 => 158,  466 => 156,  441 => 156,  438 => 149,  432 => 147,  429 => 146,  395 => 132,  382 => 128,  378 => 132,  367 => 120,  357 => 118,  348 => 115,  334 => 110,  286 => 85,  205 => 59,  297 => 92,  218 => 64,  940 => 351,  932 => 346,  926 => 342,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 327,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 297,  808 => 296,  787 => 294,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 259,  740 => 239,  734 => 254,  731 => 253,  728 => 252,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 224,  628 => 214,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 228,  499 => 154,  488 => 172,  389 => 75,  223 => 46,  14 => 2,  306 => 95,  303 => 91,  300 => 112,  292 => 86,  280 => 87,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 216,  599 => 194,  580 => 194,  574 => 230,  559 => 183,  526 => 179,  497 => 173,  485 => 124,  463 => 117,  447 => 152,  404 => 135,  401 => 144,  391 => 76,  369 => 129,  333 => 132,  329 => 65,  307 => 82,  287 => 58,  195 => 54,  178 => 46,  956 => 271,  953 => 270,  946 => 302,  942 => 300,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 301,  820 => 243,  816 => 265,  807 => 259,  805 => 295,  802 => 235,  791 => 262,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 225,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 231,  647 => 230,  644 => 190,  632 => 187,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 224,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 120,  448 => 121,  424 => 98,  418 => 112,  410 => 113,  376 => 153,  373 => 102,  340 => 122,  326 => 129,  261 => 76,  118 => 37,  200 => 64,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 297,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 276,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 304,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 255,  796 => 254,  793 => 182,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 265,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 231,  710 => 149,  707 => 208,  699 => 142,  697 => 141,  696 => 204,  695 => 230,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 123,  649 => 122,  643 => 227,  640 => 226,  638 => 118,  617 => 112,  614 => 201,  598 => 107,  593 => 201,  576 => 101,  564 => 162,  557 => 209,  550 => 94,  527 => 91,  515 => 305,  512 => 84,  509 => 228,  503 => 81,  496 => 79,  493 => 155,  478 => 143,  467 => 72,  456 => 154,  450 => 114,  414 => 148,  408 => 91,  388 => 138,  371 => 72,  363 => 32,  350 => 26,  342 => 123,  335 => 66,  316 => 16,  290 => 90,  276 => 109,  266 => 366,  263 => 133,  255 => 353,  245 => 70,  207 => 93,  194 => 89,  184 => 55,  76 => 70,  810 => 238,  804 => 260,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 248,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 241,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 202,  685 => 227,  682 => 226,  672 => 223,  670 => 222,  665 => 196,  648 => 219,  627 => 206,  622 => 204,  619 => 212,  616 => 202,  613 => 210,  610 => 209,  608 => 197,  605 => 207,  596 => 106,  592 => 203,  587 => 197,  585 => 196,  582 => 190,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 198,  542 => 186,  533 => 186,  531 => 95,  507 => 165,  505 => 180,  502 => 175,  477 => 164,  471 => 164,  465 => 161,  454 => 121,  446 => 156,  443 => 155,  431 => 151,  428 => 100,  425 => 152,  422 => 150,  412 => 147,  406 => 111,  390 => 139,  383 => 135,  377 => 73,  375 => 124,  372 => 122,  370 => 121,  359 => 70,  356 => 127,  353 => 69,  349 => 119,  336 => 115,  332 => 88,  330 => 103,  318 => 105,  313 => 96,  291 => 80,  190 => 56,  321 => 100,  295 => 87,  274 => 90,  242 => 121,  236 => 81,  70 => 17,  170 => 57,  288 => 79,  284 => 76,  279 => 82,  275 => 56,  256 => 74,  250 => 126,  237 => 71,  232 => 48,  222 => 64,  191 => 88,  153 => 72,  150 => 48,  563 => 188,  560 => 187,  558 => 186,  553 => 184,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 173,  525 => 172,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  491 => 157,  487 => 156,  460 => 143,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 120,  405 => 118,  403 => 117,  380 => 107,  366 => 106,  354 => 101,  331 => 96,  325 => 94,  320 => 92,  317 => 91,  311 => 87,  308 => 86,  304 => 85,  272 => 81,  267 => 78,  249 => 74,  216 => 70,  155 => 52,  146 => 49,  126 => 38,  188 => 54,  181 => 61,  161 => 54,  110 => 37,  124 => 41,  692 => 399,  683 => 282,  678 => 279,  676 => 265,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 215,  641 => 189,  635 => 226,  631 => 218,  625 => 361,  615 => 354,  607 => 208,  597 => 177,  590 => 202,  583 => 287,  579 => 284,  577 => 188,  575 => 328,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 98,  529 => 191,  524 => 90,  516 => 294,  510 => 78,  504 => 90,  500 => 88,  495 => 158,  490 => 154,  486 => 165,  482 => 145,  470 => 121,  464 => 125,  459 => 116,  452 => 158,  434 => 118,  421 => 90,  417 => 142,  400 => 116,  385 => 129,  361 => 207,  344 => 113,  339 => 116,  324 => 179,  310 => 103,  302 => 93,  296 => 151,  282 => 83,  259 => 76,  244 => 83,  231 => 67,  226 => 102,  215 => 63,  186 => 64,  152 => 51,  114 => 39,  104 => 47,  358 => 103,  351 => 116,  347 => 68,  343 => 92,  338 => 130,  327 => 108,  323 => 114,  319 => 124,  315 => 98,  301 => 80,  299 => 89,  293 => 59,  289 => 82,  281 => 57,  277 => 95,  271 => 79,  265 => 51,  262 => 81,  260 => 363,  257 => 53,  251 => 72,  248 => 71,  239 => 82,  228 => 103,  225 => 65,  213 => 69,  211 => 69,  197 => 30,  174 => 59,  148 => 47,  134 => 45,  127 => 40,  20 => 1,  270 => 84,  253 => 78,  233 => 71,  212 => 62,  210 => 61,  206 => 57,  202 => 62,  198 => 72,  192 => 66,  185 => 53,  180 => 51,  175 => 81,  172 => 81,  167 => 53,  165 => 46,  160 => 44,  137 => 46,  113 => 38,  100 => 26,  90 => 50,  81 => 30,  65 => 9,  129 => 41,  97 => 26,  77 => 28,  34 => 8,  53 => 14,  84 => 21,  58 => 13,  23 => 11,  480 => 75,  474 => 150,  469 => 157,  461 => 70,  457 => 124,  453 => 151,  444 => 151,  440 => 154,  437 => 61,  435 => 148,  430 => 153,  427 => 143,  423 => 144,  413 => 241,  409 => 146,  407 => 136,  402 => 107,  398 => 115,  393 => 112,  387 => 110,  384 => 109,  381 => 157,  379 => 154,  374 => 36,  368 => 34,  365 => 119,  362 => 148,  360 => 104,  355 => 27,  341 => 67,  337 => 97,  322 => 93,  314 => 88,  312 => 97,  309 => 113,  305 => 101,  298 => 91,  294 => 100,  285 => 88,  283 => 111,  278 => 110,  268 => 373,  264 => 104,  258 => 75,  252 => 73,  247 => 75,  241 => 107,  229 => 47,  220 => 99,  214 => 63,  177 => 52,  169 => 80,  140 => 47,  132 => 44,  128 => 45,  107 => 28,  61 => 14,  273 => 84,  269 => 88,  254 => 46,  243 => 73,  240 => 72,  238 => 68,  235 => 105,  230 => 62,  227 => 76,  224 => 101,  221 => 65,  219 => 63,  217 => 86,  208 => 102,  204 => 101,  179 => 60,  159 => 50,  143 => 52,  135 => 37,  119 => 36,  102 => 38,  71 => 60,  67 => 27,  63 => 16,  59 => 10,  28 => 2,  94 => 25,  89 => 35,  85 => 23,  75 => 19,  68 => 59,  56 => 6,  87 => 22,  201 => 57,  196 => 68,  183 => 84,  171 => 63,  166 => 60,  163 => 58,  158 => 50,  156 => 75,  151 => 47,  142 => 45,  138 => 47,  136 => 43,  121 => 37,  117 => 45,  105 => 39,  91 => 23,  62 => 20,  49 => 20,  25 => 3,  21 => 12,  31 => 3,  38 => 4,  26 => 13,  24 => 3,  19 => 1,  93 => 23,  88 => 36,  78 => 173,  46 => 7,  44 => 9,  27 => 4,  79 => 25,  72 => 23,  69 => 23,  47 => 7,  40 => 7,  37 => 4,  22 => 2,  246 => 71,  157 => 58,  145 => 46,  139 => 44,  131 => 46,  123 => 63,  120 => 42,  115 => 30,  111 => 35,  108 => 31,  101 => 28,  98 => 37,  96 => 31,  83 => 26,  74 => 22,  66 => 15,  55 => 9,  52 => 21,  50 => 16,  43 => 6,  41 => 10,  35 => 6,  32 => 5,  29 => 2,  209 => 58,  203 => 32,  199 => 61,  193 => 36,  189 => 65,  187 => 69,  182 => 66,  176 => 85,  173 => 51,  168 => 50,  164 => 53,  162 => 52,  154 => 48,  149 => 72,  147 => 45,  144 => 44,  141 => 44,  133 => 42,  130 => 40,  125 => 40,  122 => 41,  116 => 35,  112 => 56,  109 => 40,  106 => 48,  103 => 25,  99 => 24,  95 => 23,  92 => 37,  86 => 177,  82 => 22,  80 => 24,  73 => 29,  64 => 26,  60 => 25,  57 => 18,  54 => 21,  51 => 8,  48 => 12,  45 => 18,  42 => 6,  39 => 5,  36 => 4,  33 => 4,  30 => 3,);
    }
}
