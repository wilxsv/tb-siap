<?php

/* SonataFormatterBundle:Block:block_formatter.html.twig */
class __TwigTemplate_f65d0e8a63f977ee7d313de048f90e6f68abf4d20be23c6222ce880946f53451 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        return $this->env->resolveTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : $this->getContext($context, "sonata_block")), "templates"), "block_base"));
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 14
    public function block_block($context, array $blocks = array())
    {
        // line 15
        echo "    ";
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "content");
        echo "
";
    }

    public function getTemplateName()
    {
        return "SonataFormatterBundle:Block:block_formatter.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  297 => 92,  218 => 106,  940 => 351,  932 => 346,  926 => 342,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 327,  888 => 326,  883 => 323,  875 => 315,  869 => 313,  866 => 312,  843 => 308,  839 => 306,  813 => 298,  811 => 297,  808 => 296,  787 => 294,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 273,  754 => 266,  747 => 260,  744 => 259,  740 => 256,  734 => 254,  731 => 253,  728 => 252,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 247,  687 => 246,  671 => 262,  669 => 246,  653 => 232,  634 => 224,  628 => 222,  621 => 220,  609 => 216,  602 => 214,  591 => 289,  571 => 228,  499 => 154,  488 => 148,  389 => 75,  223 => 46,  14 => 2,  306 => 95,  303 => 94,  300 => 93,  292 => 91,  280 => 87,  12 => 36,  624 => 224,  620 => 223,  612 => 220,  601 => 216,  599 => 213,  580 => 207,  574 => 230,  559 => 201,  526 => 190,  497 => 156,  485 => 124,  463 => 117,  447 => 113,  404 => 90,  401 => 89,  391 => 76,  369 => 148,  333 => 132,  329 => 65,  307 => 82,  287 => 58,  195 => 54,  178 => 46,  956 => 271,  953 => 270,  946 => 302,  942 => 300,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 258,  840 => 253,  834 => 249,  832 => 248,  822 => 301,  820 => 243,  816 => 299,  807 => 237,  805 => 295,  802 => 235,  791 => 262,  788 => 233,  778 => 267,  773 => 289,  765 => 274,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 200,  673 => 198,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 231,  647 => 230,  644 => 190,  632 => 187,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 164,  561 => 161,  554 => 224,  551 => 199,  546 => 175,  522 => 156,  513 => 230,  479 => 135,  468 => 128,  451 => 120,  448 => 121,  424 => 98,  418 => 112,  410 => 113,  376 => 153,  373 => 102,  340 => 136,  326 => 129,  261 => 73,  118 => 60,  200 => 40,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 297,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 219,  876 => 276,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 267,  849 => 310,  846 => 205,  844 => 204,  841 => 203,  833 => 304,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 184,  796 => 233,  793 => 182,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 265,  739 => 156,  729 => 155,  724 => 154,  721 => 258,  712 => 150,  710 => 149,  707 => 208,  699 => 142,  697 => 141,  696 => 204,  695 => 249,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 125,  658 => 124,  654 => 123,  649 => 122,  643 => 227,  640 => 226,  638 => 118,  617 => 112,  614 => 111,  598 => 107,  593 => 318,  576 => 101,  564 => 162,  557 => 209,  550 => 94,  527 => 91,  515 => 305,  512 => 84,  509 => 228,  503 => 81,  496 => 79,  493 => 155,  478 => 143,  467 => 72,  456 => 68,  450 => 114,  414 => 94,  408 => 91,  388 => 42,  371 => 72,  363 => 32,  350 => 26,  342 => 23,  335 => 66,  316 => 16,  290 => 90,  276 => 85,  266 => 366,  263 => 133,  255 => 353,  245 => 335,  207 => 42,  194 => 84,  184 => 48,  76 => 80,  810 => 238,  804 => 260,  801 => 185,  799 => 234,  795 => 256,  792 => 255,  780 => 303,  777 => 253,  774 => 252,  771 => 232,  768 => 231,  766 => 249,  761 => 247,  749 => 218,  746 => 161,  743 => 217,  735 => 238,  732 => 213,  715 => 151,  698 => 259,  693 => 248,  688 => 202,  685 => 230,  682 => 201,  672 => 223,  670 => 222,  665 => 196,  648 => 219,  627 => 217,  622 => 216,  619 => 219,  616 => 182,  613 => 213,  610 => 181,  608 => 211,  605 => 215,  596 => 106,  592 => 203,  587 => 201,  585 => 209,  582 => 199,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 198,  542 => 190,  533 => 186,  531 => 225,  507 => 165,  505 => 180,  502 => 179,  477 => 164,  471 => 129,  465 => 161,  454 => 121,  446 => 156,  443 => 155,  431 => 151,  428 => 100,  425 => 149,  422 => 148,  412 => 126,  406 => 111,  390 => 43,  383 => 74,  377 => 73,  375 => 127,  372 => 126,  370 => 101,  359 => 70,  356 => 126,  353 => 69,  349 => 119,  336 => 115,  332 => 88,  330 => 103,  318 => 86,  313 => 84,  291 => 80,  190 => 49,  321 => 100,  295 => 142,  274 => 53,  242 => 121,  236 => 42,  70 => 30,  170 => 79,  288 => 79,  284 => 76,  279 => 86,  275 => 56,  256 => 79,  250 => 126,  237 => 71,  232 => 48,  222 => 66,  191 => 26,  153 => 55,  150 => 34,  563 => 211,  560 => 172,  558 => 160,  553 => 194,  549 => 182,  543 => 174,  537 => 159,  532 => 192,  528 => 184,  525 => 157,  523 => 189,  518 => 180,  514 => 167,  511 => 166,  508 => 165,  501 => 163,  491 => 171,  487 => 156,  460 => 123,  455 => 123,  449 => 157,  442 => 111,  439 => 133,  436 => 132,  433 => 60,  426 => 58,  420 => 123,  415 => 127,  411 => 120,  405 => 108,  403 => 48,  380 => 130,  366 => 150,  354 => 142,  331 => 96,  325 => 94,  320 => 87,  317 => 98,  311 => 62,  308 => 95,  304 => 81,  272 => 134,  267 => 78,  249 => 89,  216 => 35,  155 => 68,  146 => 34,  126 => 64,  188 => 82,  181 => 232,  161 => 75,  110 => 28,  124 => 19,  692 => 399,  683 => 282,  678 => 279,  676 => 265,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 369,  641 => 189,  635 => 226,  631 => 218,  625 => 361,  615 => 354,  607 => 218,  597 => 177,  590 => 202,  583 => 287,  579 => 284,  577 => 283,  575 => 328,  569 => 213,  565 => 324,  555 => 200,  548 => 176,  540 => 160,  536 => 194,  529 => 191,  524 => 90,  516 => 294,  510 => 293,  504 => 164,  500 => 172,  495 => 153,  490 => 154,  486 => 147,  482 => 145,  470 => 121,  464 => 125,  459 => 116,  452 => 158,  434 => 118,  421 => 90,  417 => 243,  400 => 47,  385 => 159,  361 => 207,  344 => 24,  339 => 116,  324 => 179,  310 => 83,  302 => 93,  296 => 151,  282 => 161,  259 => 132,  244 => 50,  231 => 69,  226 => 131,  215 => 105,  186 => 51,  152 => 73,  114 => 39,  104 => 43,  358 => 103,  351 => 141,  347 => 68,  343 => 92,  338 => 130,  327 => 102,  323 => 99,  319 => 124,  315 => 98,  301 => 80,  299 => 60,  293 => 59,  289 => 90,  281 => 57,  277 => 95,  271 => 374,  265 => 51,  262 => 81,  260 => 363,  257 => 53,  251 => 101,  248 => 336,  239 => 64,  228 => 41,  225 => 108,  213 => 104,  211 => 81,  197 => 30,  174 => 137,  148 => 23,  134 => 28,  127 => 52,  20 => 1,  270 => 84,  253 => 78,  233 => 82,  212 => 60,  210 => 59,  206 => 57,  202 => 55,  198 => 55,  192 => 53,  185 => 81,  180 => 49,  175 => 32,  172 => 81,  167 => 75,  165 => 78,  160 => 40,  137 => 66,  113 => 56,  100 => 15,  90 => 38,  81 => 20,  65 => 35,  129 => 63,  97 => 41,  77 => 23,  34 => 4,  53 => 12,  84 => 34,  58 => 14,  23 => 11,  480 => 75,  474 => 122,  469 => 158,  461 => 70,  457 => 124,  453 => 151,  444 => 119,  440 => 154,  437 => 61,  435 => 146,  430 => 101,  427 => 143,  423 => 57,  413 => 241,  409 => 141,  407 => 238,  402 => 107,  398 => 88,  393 => 168,  387 => 134,  384 => 106,  381 => 157,  379 => 154,  374 => 36,  368 => 34,  365 => 71,  362 => 148,  360 => 128,  355 => 27,  341 => 67,  337 => 90,  322 => 93,  314 => 88,  312 => 97,  309 => 82,  305 => 61,  298 => 91,  294 => 100,  285 => 88,  283 => 138,  278 => 408,  268 => 373,  264 => 82,  258 => 72,  252 => 68,  247 => 75,  241 => 87,  229 => 47,  220 => 65,  214 => 63,  177 => 138,  169 => 80,  140 => 67,  132 => 69,  128 => 47,  107 => 27,  61 => 15,  273 => 84,  269 => 55,  254 => 46,  243 => 73,  240 => 72,  238 => 49,  235 => 116,  230 => 62,  227 => 80,  224 => 61,  221 => 38,  219 => 76,  217 => 64,  208 => 102,  204 => 101,  179 => 86,  159 => 196,  143 => 33,  135 => 66,  119 => 59,  102 => 32,  71 => 18,  67 => 36,  63 => 13,  59 => 24,  28 => 20,  94 => 24,  89 => 27,  85 => 27,  75 => 19,  68 => 20,  56 => 10,  87 => 28,  201 => 100,  196 => 89,  183 => 33,  171 => 44,  166 => 209,  163 => 58,  158 => 74,  156 => 75,  151 => 54,  142 => 22,  138 => 57,  136 => 21,  121 => 51,  117 => 45,  105 => 33,  91 => 23,  62 => 16,  49 => 20,  25 => 3,  21 => 11,  31 => 21,  38 => 25,  26 => 14,  24 => 14,  19 => 11,  93 => 29,  88 => 39,  78 => 20,  46 => 32,  44 => 19,  27 => 4,  79 => 33,  72 => 16,  69 => 15,  47 => 10,  40 => 7,  37 => 6,  22 => 12,  246 => 67,  157 => 56,  145 => 53,  139 => 51,  131 => 48,  123 => 63,  120 => 42,  115 => 47,  111 => 35,  108 => 34,  101 => 50,  98 => 25,  96 => 30,  83 => 25,  74 => 31,  66 => 17,  55 => 13,  52 => 21,  50 => 11,  43 => 22,  41 => 18,  35 => 5,  32 => 15,  29 => 15,  209 => 58,  203 => 32,  199 => 90,  193 => 36,  189 => 34,  187 => 69,  182 => 87,  176 => 85,  173 => 46,  168 => 29,  164 => 55,  162 => 77,  154 => 36,  149 => 72,  147 => 52,  144 => 60,  141 => 72,  133 => 49,  130 => 66,  125 => 46,  122 => 45,  116 => 43,  112 => 56,  109 => 55,  106 => 53,  103 => 52,  99 => 49,  95 => 41,  92 => 28,  86 => 30,  82 => 21,  80 => 24,  73 => 19,  64 => 27,  60 => 12,  57 => 14,  54 => 12,  51 => 34,  48 => 10,  45 => 9,  42 => 7,  39 => 6,  36 => 5,  33 => 18,  30 => 1,);
    }
}
