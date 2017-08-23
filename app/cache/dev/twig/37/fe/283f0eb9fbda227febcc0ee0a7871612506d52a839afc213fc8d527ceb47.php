<?php

/* MinsalSiapsBundle:CRUD/MntRangohora:edit.html.twig */
class __TwigTemplate_37fe283f0eb9fbda227febcc0ee0a7871612506d52a839afc213fc8d527ceb47 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:edit.html.twig");

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["action"] = (((!(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")))) ? ("edit") : ("create"));
        // line 4
        $context["superAdmin"] = $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method");
        // line 5
        $context["idEstablecimiento"] = (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento", array(), "method")) ? ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento", array(), "method"), "getId", array(), "method")) : ((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method")) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado", array(), "method"), "getIdEstablecimiento", array(), "method"), "getId", array(), "method")) : (""))));
        // line 6
        $context["actionDisabled"] = $this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "parameters"), "actionDisabled");
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 8
    public function block_javascripts($context, array $blocks = array())
    {
        // line 9
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script type=\"text/javascript\">
        jQuery(document).ready(function(\$) {
            /*
             * Declaracion de Variables
             */
            ";
        // line 16
        if (((isset($context["superAdmin"]) ? $context["superAdmin"] : $this->getContext($context, "superAdmin")) === true)) {
            // line 17
            echo "                \$idEstablecimiento = \$('#";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
            echo "_idEstablecimiento');
                \$idModulo          = \$('#";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
            echo "_idModulo');
            ";
        }
        // line 20
        echo "            \$horaInicial = \$('#";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_horaIni');
            \$horaFinal   = \$('#";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid"), "html", null, true);
        echo "_horaFin');

            var idEstablecimiento = '";
        // line 23
        echo twig_escape_filter($this->env, (isset($context["idEstablecimiento"]) ? $context["idEstablecimiento"] : $this->getContext($context, "idEstablecimiento")), "html", null, true);
        echo "';

            /*
             * Inicialización de Elementos del Formulario.
             */
            var select2Options = {
                    placeholder: 'Seleccionar...',
                    allowClear: true,
                    containerCss: {
                        'width': '100%'
                    }
                };

            ";
        // line 36
        if (((isset($context["superAdmin"]) ? $context["superAdmin"] : $this->getContext($context, "superAdmin")) === true)) {
            // line 37
            echo "                select2Options['placeholder'] = 'Seleccionar Establecimiento...';
                initializeSelect2(\$idEstablecimiento, true, false, select2Options);

                select2Options['placeholder'] = 'Seleccionar Módulo...';
                initializeSelect2(\$idModulo, true, false, select2Options);
            ";
        }
        // line 43
        echo "
            /*
             * Lógica de Proceso.
             */
            ";
        // line 47
        if (((isset($context["superAdmin"]) ? $context["superAdmin"] : $this->getContext($context, "superAdmin")) === true)) {
            // line 48
            echo "                if(idEstablecimiento === '') {
                    \$.ajax({
                        url: Routing.generate(\"get_establecimiento_configurado\"),
                        async: false,
                        dataType: 'json',
                        success: function (data) {
                            idEstablecimiento = data.id;
                        }
                    });
                }

                \$idEstablecimiento.select2('val',idEstablecimiento);
            ";
        }
        // line 61
        echo "
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:CRUD/MntRangohora:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  595 => 193,  589 => 192,  586 => 191,  562 => 184,  556 => 182,  506 => 103,  498 => 78,  492 => 76,  473 => 165,  458 => 160,  399 => 143,  352 => 126,  346 => 125,  328 => 117,  880 => 288,  837 => 274,  827 => 270,  823 => 268,  821 => 267,  818 => 266,  789 => 251,  758 => 243,  667 => 218,  573 => 172,  567 => 170,  520 => 177,  481 => 167,  475 => 159,  472 => 158,  466 => 156,  441 => 156,  438 => 149,  432 => 147,  429 => 146,  395 => 132,  382 => 128,  378 => 132,  367 => 120,  357 => 118,  348 => 115,  334 => 110,  286 => 85,  205 => 59,  297 => 92,  218 => 64,  940 => 351,  932 => 346,  926 => 342,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 327,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 297,  808 => 296,  787 => 294,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 259,  740 => 239,  734 => 254,  731 => 253,  728 => 252,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 224,  628 => 214,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 228,  499 => 154,  488 => 172,  389 => 75,  223 => 46,  14 => 2,  306 => 95,  303 => 91,  300 => 112,  292 => 86,  280 => 87,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 216,  599 => 194,  580 => 194,  574 => 230,  559 => 183,  526 => 179,  497 => 173,  485 => 124,  463 => 117,  447 => 152,  404 => 135,  401 => 144,  391 => 76,  369 => 129,  333 => 132,  329 => 65,  307 => 82,  287 => 58,  195 => 54,  178 => 46,  956 => 271,  953 => 270,  946 => 302,  942 => 300,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 301,  820 => 243,  816 => 265,  807 => 259,  805 => 295,  802 => 235,  791 => 262,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 225,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 231,  647 => 230,  644 => 190,  632 => 187,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 224,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 120,  448 => 121,  424 => 98,  418 => 112,  410 => 113,  376 => 153,  373 => 102,  340 => 122,  326 => 129,  261 => 76,  118 => 37,  200 => 64,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 297,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 276,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 304,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 255,  796 => 254,  793 => 182,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 265,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 231,  710 => 149,  707 => 208,  699 => 142,  697 => 141,  696 => 204,  695 => 230,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 123,  649 => 122,  643 => 227,  640 => 226,  638 => 118,  617 => 112,  614 => 201,  598 => 107,  593 => 201,  576 => 101,  564 => 162,  557 => 209,  550 => 94,  527 => 91,  515 => 305,  512 => 84,  509 => 228,  503 => 81,  496 => 79,  493 => 155,  478 => 143,  467 => 72,  456 => 154,  450 => 114,  414 => 148,  408 => 91,  388 => 138,  371 => 72,  363 => 32,  350 => 26,  342 => 123,  335 => 66,  316 => 16,  290 => 90,  276 => 109,  266 => 366,  263 => 133,  255 => 353,  245 => 70,  207 => 93,  194 => 89,  184 => 55,  76 => 70,  810 => 238,  804 => 260,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 248,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 241,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 202,  685 => 227,  682 => 226,  672 => 223,  670 => 222,  665 => 196,  648 => 219,  627 => 206,  622 => 204,  619 => 212,  616 => 202,  613 => 210,  610 => 209,  608 => 197,  605 => 207,  596 => 106,  592 => 203,  587 => 197,  585 => 196,  582 => 190,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 198,  542 => 186,  533 => 186,  531 => 95,  507 => 165,  505 => 180,  502 => 175,  477 => 164,  471 => 164,  465 => 161,  454 => 121,  446 => 156,  443 => 155,  431 => 151,  428 => 100,  425 => 152,  422 => 150,  412 => 147,  406 => 111,  390 => 139,  383 => 135,  377 => 73,  375 => 124,  372 => 122,  370 => 121,  359 => 70,  356 => 127,  353 => 69,  349 => 119,  336 => 115,  332 => 88,  330 => 103,  318 => 105,  313 => 96,  291 => 80,  190 => 56,  321 => 100,  295 => 87,  274 => 90,  242 => 121,  236 => 81,  70 => 10,  170 => 57,  288 => 79,  284 => 76,  279 => 82,  275 => 56,  256 => 74,  250 => 126,  237 => 71,  232 => 48,  222 => 64,  191 => 88,  153 => 72,  150 => 48,  563 => 211,  560 => 172,  558 => 167,  553 => 194,  549 => 182,  543 => 174,  537 => 184,  532 => 192,  528 => 91,  525 => 90,  523 => 178,  518 => 180,  514 => 167,  511 => 166,  508 => 165,  501 => 163,  491 => 171,  487 => 156,  460 => 161,  455 => 159,  449 => 158,  442 => 111,  439 => 133,  436 => 132,  433 => 154,  426 => 145,  420 => 143,  415 => 127,  411 => 120,  405 => 108,  403 => 48,  380 => 130,  366 => 150,  354 => 117,  331 => 118,  325 => 107,  320 => 87,  317 => 98,  311 => 62,  308 => 102,  304 => 81,  272 => 107,  267 => 105,  249 => 72,  216 => 71,  155 => 73,  146 => 53,  126 => 64,  188 => 54,  181 => 54,  161 => 59,  110 => 37,  124 => 39,  692 => 399,  683 => 282,  678 => 279,  676 => 265,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 215,  641 => 189,  635 => 226,  631 => 218,  625 => 361,  615 => 354,  607 => 208,  597 => 177,  590 => 202,  583 => 287,  579 => 284,  577 => 188,  575 => 328,  569 => 213,  565 => 324,  555 => 166,  548 => 188,  540 => 99,  536 => 98,  529 => 191,  524 => 90,  516 => 294,  510 => 78,  504 => 90,  500 => 88,  495 => 77,  490 => 154,  486 => 165,  482 => 145,  470 => 121,  464 => 125,  459 => 116,  452 => 158,  434 => 118,  421 => 90,  417 => 142,  400 => 47,  385 => 129,  361 => 207,  344 => 113,  339 => 116,  324 => 179,  310 => 103,  302 => 93,  296 => 151,  282 => 83,  259 => 76,  244 => 83,  231 => 67,  226 => 102,  215 => 63,  186 => 51,  152 => 57,  114 => 39,  104 => 47,  358 => 103,  351 => 116,  347 => 68,  343 => 92,  338 => 130,  327 => 108,  323 => 114,  319 => 124,  315 => 98,  301 => 80,  299 => 89,  293 => 59,  289 => 94,  281 => 57,  277 => 95,  271 => 79,  265 => 51,  262 => 81,  260 => 363,  257 => 53,  251 => 72,  248 => 71,  239 => 82,  228 => 103,  225 => 65,  213 => 70,  211 => 69,  197 => 30,  174 => 63,  148 => 47,  134 => 40,  127 => 40,  20 => 1,  270 => 84,  253 => 78,  233 => 80,  212 => 62,  210 => 61,  206 => 57,  202 => 62,  198 => 72,  192 => 55,  185 => 53,  180 => 51,  175 => 81,  172 => 81,  167 => 55,  165 => 46,  160 => 44,  137 => 50,  113 => 38,  100 => 38,  90 => 37,  81 => 26,  65 => 9,  129 => 41,  97 => 26,  77 => 28,  34 => 8,  53 => 14,  84 => 27,  58 => 13,  23 => 11,  480 => 75,  474 => 122,  469 => 157,  461 => 70,  457 => 124,  453 => 151,  444 => 151,  440 => 154,  437 => 61,  435 => 148,  430 => 153,  427 => 143,  423 => 144,  413 => 241,  409 => 146,  407 => 136,  402 => 107,  398 => 88,  393 => 140,  387 => 134,  384 => 106,  381 => 157,  379 => 154,  374 => 36,  368 => 34,  365 => 119,  362 => 148,  360 => 128,  355 => 27,  341 => 67,  337 => 90,  322 => 106,  314 => 88,  312 => 97,  309 => 113,  305 => 101,  298 => 91,  294 => 100,  285 => 88,  283 => 111,  278 => 110,  268 => 373,  264 => 104,  258 => 75,  252 => 73,  247 => 75,  241 => 107,  229 => 47,  220 => 99,  214 => 63,  177 => 52,  169 => 80,  140 => 51,  132 => 36,  128 => 45,  107 => 28,  61 => 14,  273 => 84,  269 => 88,  254 => 46,  243 => 73,  240 => 67,  238 => 68,  235 => 105,  230 => 62,  227 => 76,  224 => 101,  221 => 65,  219 => 63,  217 => 86,  208 => 102,  204 => 101,  179 => 60,  159 => 50,  143 => 52,  135 => 37,  119 => 40,  102 => 35,  71 => 60,  67 => 21,  63 => 16,  59 => 13,  28 => 3,  94 => 25,  89 => 35,  85 => 23,  75 => 19,  68 => 59,  56 => 6,  87 => 28,  201 => 57,  196 => 60,  183 => 84,  171 => 63,  166 => 60,  163 => 58,  158 => 74,  156 => 75,  151 => 54,  142 => 45,  138 => 47,  136 => 43,  121 => 61,  117 => 45,  105 => 36,  91 => 23,  62 => 20,  49 => 11,  25 => 3,  21 => 2,  31 => 6,  38 => 4,  26 => 13,  24 => 14,  19 => 1,  93 => 30,  88 => 36,  78 => 173,  46 => 9,  44 => 8,  27 => 4,  79 => 25,  72 => 23,  69 => 23,  47 => 9,  40 => 6,  37 => 8,  22 => 12,  246 => 71,  157 => 58,  145 => 46,  139 => 44,  131 => 46,  123 => 63,  120 => 42,  115 => 30,  111 => 35,  108 => 37,  101 => 28,  98 => 43,  96 => 31,  83 => 26,  74 => 22,  66 => 25,  55 => 15,  52 => 17,  50 => 16,  43 => 9,  41 => 10,  35 => 14,  32 => 6,  29 => 5,  209 => 58,  203 => 32,  199 => 61,  193 => 36,  189 => 34,  187 => 69,  182 => 66,  176 => 85,  173 => 51,  168 => 50,  164 => 53,  162 => 49,  154 => 48,  149 => 72,  147 => 45,  144 => 45,  141 => 44,  133 => 42,  130 => 41,  125 => 40,  122 => 41,  116 => 39,  112 => 56,  109 => 50,  106 => 48,  103 => 25,  99 => 24,  95 => 23,  92 => 37,  86 => 177,  82 => 22,  80 => 24,  73 => 69,  64 => 20,  60 => 23,  57 => 18,  54 => 21,  51 => 20,  48 => 38,  45 => 18,  42 => 21,  39 => 9,  36 => 8,  33 => 3,  30 => 2,);
    }
}
