<?php

/* FOSUserBundle:Group:new_content.html.twig */
class __TwigTemplate_5db335f327ed33d5fbc2f2bcde06e076f3bbfd7e5e847347bcc882a04a5f24c8 extends Twig_Template
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
        echo "<form action=\"";
        echo $this->env->getExtension('routing')->getPath("fos_user_group_new");
        echo "\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo " method=\"POST\" class=\"fos_user_group_new\">
    ";
        // line 2
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
    <div>
        <input type=\"submit\" value=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("group.new.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\" />
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Group:new_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  940 => 351,  932 => 346,  926 => 342,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 327,  888 => 326,  883 => 323,  875 => 315,  869 => 313,  866 => 312,  843 => 308,  839 => 306,  813 => 298,  811 => 297,  808 => 296,  787 => 294,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 273,  754 => 266,  747 => 260,  744 => 259,  740 => 256,  734 => 254,  731 => 253,  728 => 252,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 247,  687 => 246,  671 => 262,  669 => 246,  653 => 232,  634 => 224,  628 => 222,  621 => 220,  609 => 216,  602 => 214,  591 => 289,  571 => 228,  499 => 154,  488 => 148,  389 => 75,  223 => 46,  14 => 2,  306 => 95,  303 => 94,  300 => 93,  292 => 91,  280 => 87,  12 => 36,  624 => 224,  620 => 223,  612 => 220,  601 => 216,  599 => 213,  580 => 207,  574 => 230,  559 => 201,  526 => 190,  497 => 156,  485 => 124,  463 => 117,  447 => 113,  404 => 90,  401 => 89,  391 => 76,  369 => 148,  333 => 132,  329 => 65,  307 => 82,  287 => 58,  195 => 54,  178 => 46,  956 => 271,  953 => 270,  946 => 302,  942 => 300,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 258,  840 => 253,  834 => 249,  832 => 248,  822 => 301,  820 => 243,  816 => 299,  807 => 237,  805 => 295,  802 => 235,  791 => 262,  788 => 233,  778 => 267,  773 => 289,  765 => 274,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 200,  673 => 198,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 231,  647 => 230,  644 => 190,  632 => 187,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 164,  561 => 161,  554 => 224,  551 => 199,  546 => 175,  522 => 156,  513 => 230,  479 => 135,  468 => 128,  451 => 120,  448 => 121,  424 => 98,  418 => 112,  410 => 113,  376 => 153,  373 => 102,  340 => 136,  326 => 129,  261 => 73,  118 => 38,  200 => 40,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 297,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 219,  876 => 276,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 267,  849 => 310,  846 => 205,  844 => 204,  841 => 203,  833 => 304,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 184,  796 => 233,  793 => 182,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 265,  739 => 156,  729 => 155,  724 => 154,  721 => 258,  712 => 150,  710 => 149,  707 => 208,  699 => 142,  697 => 141,  696 => 204,  695 => 249,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 125,  658 => 124,  654 => 123,  649 => 122,  643 => 227,  640 => 226,  638 => 118,  617 => 112,  614 => 111,  598 => 107,  593 => 318,  576 => 101,  564 => 162,  557 => 209,  550 => 94,  527 => 91,  515 => 305,  512 => 84,  509 => 228,  503 => 81,  496 => 79,  493 => 155,  478 => 143,  467 => 72,  456 => 68,  450 => 114,  414 => 94,  408 => 91,  388 => 42,  371 => 72,  363 => 32,  350 => 26,  342 => 23,  335 => 66,  316 => 16,  290 => 90,  276 => 393,  266 => 366,  263 => 54,  255 => 353,  245 => 335,  207 => 42,  194 => 52,  184 => 48,  76 => 80,  810 => 238,  804 => 260,  801 => 185,  799 => 234,  795 => 256,  792 => 255,  780 => 303,  777 => 253,  774 => 252,  771 => 232,  768 => 231,  766 => 249,  761 => 247,  749 => 218,  746 => 161,  743 => 217,  735 => 238,  732 => 213,  715 => 151,  698 => 259,  693 => 248,  688 => 202,  685 => 230,  682 => 201,  672 => 223,  670 => 222,  665 => 196,  648 => 219,  627 => 217,  622 => 216,  619 => 219,  616 => 182,  613 => 213,  610 => 181,  608 => 211,  605 => 215,  596 => 106,  592 => 203,  587 => 201,  585 => 209,  582 => 199,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 198,  542 => 190,  533 => 186,  531 => 225,  507 => 165,  505 => 180,  502 => 179,  477 => 164,  471 => 129,  465 => 161,  454 => 121,  446 => 156,  443 => 155,  431 => 151,  428 => 100,  425 => 149,  422 => 148,  412 => 126,  406 => 111,  390 => 43,  383 => 74,  377 => 73,  375 => 127,  372 => 126,  370 => 101,  359 => 70,  356 => 126,  353 => 69,  349 => 119,  336 => 115,  332 => 88,  330 => 103,  318 => 86,  313 => 84,  291 => 80,  190 => 49,  321 => 100,  295 => 142,  274 => 53,  242 => 113,  236 => 42,  70 => 9,  170 => 79,  288 => 79,  284 => 76,  279 => 77,  275 => 56,  256 => 79,  250 => 51,  237 => 71,  232 => 48,  222 => 66,  191 => 26,  153 => 55,  150 => 34,  563 => 211,  560 => 172,  558 => 160,  553 => 194,  549 => 182,  543 => 174,  537 => 159,  532 => 192,  528 => 184,  525 => 157,  523 => 189,  518 => 180,  514 => 167,  511 => 166,  508 => 165,  501 => 163,  491 => 171,  487 => 156,  460 => 123,  455 => 123,  449 => 157,  442 => 111,  439 => 133,  436 => 132,  433 => 60,  426 => 58,  420 => 123,  415 => 127,  411 => 120,  405 => 108,  403 => 48,  380 => 130,  366 => 150,  354 => 142,  331 => 96,  325 => 94,  320 => 87,  317 => 63,  311 => 62,  308 => 13,  304 => 81,  272 => 134,  267 => 78,  249 => 89,  216 => 35,  155 => 68,  146 => 34,  126 => 48,  188 => 25,  181 => 232,  161 => 75,  110 => 41,  124 => 19,  692 => 399,  683 => 282,  678 => 279,  676 => 265,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 369,  641 => 189,  635 => 226,  631 => 218,  625 => 361,  615 => 354,  607 => 218,  597 => 177,  590 => 202,  583 => 287,  579 => 284,  577 => 283,  575 => 328,  569 => 213,  565 => 324,  555 => 200,  548 => 176,  540 => 160,  536 => 194,  529 => 191,  524 => 90,  516 => 294,  510 => 293,  504 => 164,  500 => 172,  495 => 153,  490 => 154,  486 => 147,  482 => 145,  470 => 121,  464 => 125,  459 => 116,  452 => 158,  434 => 118,  421 => 90,  417 => 243,  400 => 47,  385 => 159,  361 => 207,  344 => 24,  339 => 116,  324 => 179,  310 => 83,  302 => 79,  296 => 151,  282 => 161,  259 => 149,  244 => 50,  231 => 69,  226 => 131,  215 => 44,  186 => 51,  152 => 61,  114 => 39,  104 => 43,  358 => 103,  351 => 141,  347 => 68,  343 => 92,  338 => 130,  327 => 102,  323 => 64,  319 => 124,  315 => 98,  301 => 80,  299 => 60,  293 => 59,  289 => 140,  281 => 57,  277 => 95,  271 => 374,  265 => 51,  262 => 81,  260 => 363,  257 => 53,  251 => 101,  248 => 336,  239 => 64,  228 => 41,  225 => 67,  213 => 69,  211 => 81,  197 => 30,  174 => 154,  148 => 23,  134 => 28,  127 => 52,  20 => 1,  270 => 84,  253 => 78,  233 => 82,  212 => 60,  210 => 59,  206 => 57,  202 => 55,  198 => 55,  192 => 53,  185 => 61,  180 => 49,  175 => 32,  172 => 31,  167 => 75,  165 => 28,  160 => 40,  137 => 29,  113 => 56,  100 => 15,  90 => 39,  81 => 20,  65 => 19,  129 => 63,  97 => 41,  77 => 23,  34 => 5,  53 => 17,  84 => 34,  58 => 16,  23 => 12,  480 => 75,  474 => 122,  469 => 158,  461 => 70,  457 => 124,  453 => 151,  444 => 119,  440 => 154,  437 => 61,  435 => 146,  430 => 101,  427 => 143,  423 => 57,  413 => 241,  409 => 141,  407 => 238,  402 => 107,  398 => 88,  393 => 168,  387 => 134,  384 => 106,  381 => 157,  379 => 154,  374 => 36,  368 => 34,  365 => 71,  362 => 148,  360 => 128,  355 => 27,  341 => 67,  337 => 90,  322 => 93,  314 => 88,  312 => 97,  309 => 82,  305 => 61,  298 => 91,  294 => 100,  285 => 78,  283 => 138,  278 => 408,  268 => 373,  264 => 82,  258 => 72,  252 => 68,  247 => 75,  241 => 87,  229 => 47,  220 => 65,  214 => 63,  177 => 43,  169 => 44,  140 => 68,  132 => 57,  128 => 47,  107 => 35,  61 => 21,  273 => 85,  269 => 55,  254 => 46,  243 => 73,  240 => 72,  238 => 49,  235 => 63,  230 => 62,  227 => 80,  224 => 61,  221 => 38,  219 => 76,  217 => 64,  208 => 124,  204 => 41,  179 => 86,  159 => 196,  143 => 33,  135 => 66,  119 => 59,  102 => 32,  71 => 31,  67 => 8,  63 => 16,  59 => 24,  28 => 3,  94 => 30,  89 => 27,  85 => 27,  75 => 32,  68 => 20,  56 => 18,  87 => 28,  201 => 56,  196 => 52,  183 => 33,  171 => 44,  166 => 209,  163 => 58,  158 => 74,  156 => 38,  151 => 54,  142 => 22,  138 => 57,  136 => 21,  121 => 51,  117 => 45,  105 => 33,  91 => 48,  62 => 28,  49 => 11,  25 => 3,  21 => 11,  31 => 4,  38 => 6,  26 => 2,  24 => 6,  19 => 1,  93 => 29,  88 => 28,  78 => 21,  46 => 10,  44 => 16,  27 => 4,  79 => 34,  72 => 31,  69 => 26,  47 => 88,  40 => 24,  37 => 16,  22 => 1,  246 => 67,  157 => 56,  145 => 53,  139 => 51,  131 => 48,  123 => 40,  120 => 42,  115 => 47,  111 => 35,  108 => 34,  101 => 33,  98 => 32,  96 => 30,  83 => 25,  74 => 32,  66 => 17,  55 => 15,  52 => 3,  50 => 21,  43 => 9,  41 => 83,  35 => 15,  32 => 14,  29 => 3,  209 => 58,  203 => 32,  199 => 265,  193 => 36,  189 => 34,  187 => 69,  182 => 87,  176 => 85,  173 => 46,  168 => 29,  164 => 55,  162 => 41,  154 => 36,  149 => 35,  147 => 52,  144 => 60,  141 => 72,  133 => 49,  130 => 49,  125 => 46,  122 => 45,  116 => 43,  112 => 17,  109 => 55,  106 => 16,  103 => 52,  99 => 31,  95 => 41,  92 => 28,  86 => 26,  82 => 26,  80 => 24,  73 => 34,  64 => 19,  60 => 6,  57 => 5,  54 => 19,  51 => 29,  48 => 11,  45 => 85,  42 => 8,  39 => 17,  36 => 20,  33 => 3,  30 => 1,);
    }
}
