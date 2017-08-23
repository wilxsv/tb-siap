<?php

/* MinsalSeguimientoBundle:SecHistorialClinico:historiasClinicasMedicos.html.twig */
class __TwigTemplate_140bf9502b74027eb7960cc9d4457c95e7f5279a223338bd21e11e1da24e3acb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'notice' => array($this, 'block_notice'),
            'list_table' => array($this, 'block_list_table'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 3
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
";
    }

    // line 6
    public function block_javascripts($context, array $blocks = array())
    {
        // line 7
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
<script type=\"text/javascript\">
jQuery(document).ready(function(\$) {
    \$('#fecha_inicio').mask('99/99/9999');
    \$('#fecha_final').mask('99/99/9999');

    \$('#limpiar').on('click',function(e){

        \$('#resultado').empty();
    });

    \$('#emitir_informe').on('click',function(e){
        if(\$('#fecha_inicio').val()!='' && \$('#fecha_final').val()!=''){
            if(\$('#fecha_inicio').val() > \$('#fecha_final').val()){
                var title='Error de Llenado';
                var body=\"La fecha de inicio debe de ser mayor a la fecha final\";
                var clase='dialog-error';
                var arrayBtns = [{text: 'Cerrar',
                                        click: function( event, ui) {
                                            jQuery( this ).dialog( \"close\" );
                                            \$('#fecha_inicio').val('');
                                            \$('#fecha_inicio').focus();
                                            \$('#fecha_final').val('');
                                        }}
                                ];
                showDialogMsg(title, body, clase, '', arrayBtns, false, null, true);

            }else{
                \$('#resultado').empty();
                \$('#resultado').append('<center><img id=\"wait\" src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/wait_icon1.gif"), "html", null, true);
        echo "\" alt=\"wait\" width=\"24\" height=\"24\"><div id=\"search-message\">Por Favor Espere...</div></center>');
                \$('#resultado').load(Routing.generate('cantidad_historias_medico',{'datos':\$('#buscarForm').serialize()}));
            }
        } else{
            var title='Error de Llenado';
            var body=\"Debe de seleccionar ambas fechas para generar el informe\";
            var clase='dialog-error';
            var arrayBtns = [{text: 'Cerrar',
                                    click: function( event, ui) {
                                        jQuery( this ).dialog( \"close\" );
                                        if(\$('#fecha_inicio').val()=='')
                                            \$('#fecha_inicio').focus();
                                        else
                                            \$('#fecha_final').focus();
                                    }}
                            ];
            showDialogMsg(title, body, clase, '', arrayBtns, false, null, true);
        }
        e.preventDefault()
    });

});
</script>
";
    }

    // line 60
    public function block_notice($context, array $blocks = array())
    {
        // line 61
        $this->env->loadTemplate("SonataCoreBundle:FlashMessage:render.html.twig")->display($context);
    }

    // line 63
    public function block_list_table($context, array $blocks = array())
    {
        // line 64
        echo "<div class=\"container-fluid\">
    <form  id=\"buscarForm\" method=\"post\" >

    <div class=\"row\">
        <div class=\"col-md-7 col-md-offset-2\">
            <h2><img class=\"icono\" src=";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/listar.png"), "html", null, true);
        echo " />Cantidad de historias clinicas por médico</h2>
            <table class=\"table table-bordered\">
                    <tr>
                        <th>Fecha de Inicio:</th>
                        <td><input id=\"fecha_inicio\" name=\"fecha_inicio\" type=\"text\" class=\"fecha bootstrap-datepicker now form-control\" /></td>
                        <th>Fecha Final:</th>
                        <td><input id=\"fecha_final\" name=\"fecha_final\" type=\"text\" class=\"fecha bootstrap-datepicker now form-control\" /></td>
                    </tr>
            </table>
            <div class=\"well form-actions\">
                <center>
                <input type=\"submit\" class=\"btn btn-primary\" id=\"emitir_informe\" value=\"Emitir Informe\"/>
                <input type=\"reset\" class=\"btn btn-info\" id=\"limpiar\" value=\"Limpiar\"/>
                </center>
            </div>
        </div>
    </div>
</form>
</div>
<div id=\"resultado\"></div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecHistorialClinico:historiasClinicasMedicos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  552 => 208,  709 => 255,  397 => 168,  392 => 165,  1577 => 1107,  1574 => 1106,  1569 => 1111,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 921,  1289 => 896,  1286 => 895,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 856,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 767,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 759,  992 => 720,  962 => 697,  960 => 696,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 279,  419 => 293,  639 => 235,  611 => 386,  538 => 251,  646 => 307,  642 => 286,  544 => 352,  541 => 204,  517 => 192,  797 => 489,  752 => 533,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 224,  519 => 193,  416 => 221,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 416,  775 => 413,  762 => 540,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 388,  708 => 381,  703 => 378,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 203,  534 => 348,  530 => 248,  521 => 194,  489 => 179,  483 => 206,  394 => 217,  396 => 206,  345 => 189,  476 => 174,  386 => 162,  364 => 114,  234 => 78,  595 => 326,  589 => 267,  586 => 223,  562 => 144,  556 => 274,  506 => 103,  498 => 292,  492 => 274,  473 => 277,  458 => 121,  399 => 209,  352 => 279,  346 => 125,  328 => 179,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 244,  573 => 328,  567 => 347,  520 => 247,  481 => 123,  475 => 275,  472 => 172,  466 => 227,  441 => 346,  438 => 189,  432 => 230,  429 => 222,  395 => 400,  382 => 231,  378 => 211,  367 => 115,  357 => 222,  348 => 190,  334 => 110,  286 => 169,  205 => 106,  297 => 113,  218 => 127,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 561,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 302,  687 => 301,  671 => 262,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 281,  609 => 273,  602 => 230,  591 => 280,  571 => 262,  499 => 268,  488 => 273,  389 => 235,  223 => 114,  14 => 2,  306 => 117,  303 => 159,  300 => 98,  292 => 95,  280 => 108,  12 => 36,  624 => 282,  620 => 223,  612 => 232,  601 => 379,  599 => 327,  580 => 265,  574 => 263,  559 => 311,  526 => 309,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 172,  401 => 119,  391 => 216,  369 => 228,  333 => 95,  329 => 93,  307 => 117,  287 => 152,  195 => 110,  178 => 123,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 221,  668 => 460,  663 => 195,  660 => 194,  657 => 193,  650 => 238,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 221,  603 => 229,  600 => 178,  594 => 225,  588 => 372,  584 => 158,  570 => 149,  561 => 259,  554 => 188,  551 => 101,  546 => 175,  522 => 156,  513 => 244,  479 => 279,  468 => 163,  451 => 307,  448 => 195,  424 => 296,  418 => 222,  410 => 151,  376 => 109,  373 => 209,  340 => 200,  326 => 212,  261 => 89,  118 => 53,  200 => 127,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 894,  1279 => 377,  1273 => 887,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 768,  1056 => 766,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 536,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 712,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 563,  785 => 560,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 258,  712 => 437,  710 => 149,  707 => 208,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 241,  654 => 357,  649 => 308,  643 => 306,  640 => 226,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 101,  564 => 260,  557 => 366,  550 => 255,  527 => 153,  515 => 191,  512 => 147,  509 => 337,  503 => 238,  496 => 282,  493 => 155,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 214,  408 => 173,  388 => 292,  371 => 136,  363 => 133,  350 => 191,  342 => 274,  335 => 182,  316 => 16,  290 => 154,  276 => 102,  266 => 149,  263 => 102,  255 => 87,  245 => 122,  207 => 84,  194 => 81,  184 => 118,  76 => 34,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 372,  685 => 252,  682 => 202,  672 => 247,  670 => 365,  665 => 362,  648 => 219,  627 => 236,  622 => 369,  619 => 212,  616 => 276,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 368,  572 => 204,  566 => 324,  547 => 186,  545 => 253,  542 => 156,  533 => 138,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 163,  443 => 162,  431 => 251,  428 => 250,  425 => 156,  422 => 338,  412 => 152,  406 => 111,  390 => 164,  383 => 161,  377 => 119,  375 => 210,  372 => 199,  370 => 208,  359 => 204,  356 => 132,  353 => 131,  349 => 220,  336 => 272,  332 => 123,  330 => 122,  318 => 105,  313 => 119,  291 => 153,  190 => 98,  321 => 106,  295 => 154,  274 => 71,  242 => 136,  236 => 93,  70 => 31,  170 => 95,  288 => 197,  284 => 109,  279 => 134,  275 => 157,  256 => 145,  250 => 66,  237 => 81,  232 => 79,  222 => 129,  191 => 214,  153 => 69,  150 => 67,  563 => 188,  560 => 275,  558 => 195,  553 => 256,  549 => 207,  543 => 179,  537 => 176,  532 => 201,  528 => 199,  525 => 311,  523 => 195,  518 => 292,  514 => 339,  511 => 243,  508 => 188,  501 => 186,  491 => 288,  487 => 156,  460 => 240,  455 => 120,  449 => 164,  442 => 278,  439 => 133,  436 => 159,  433 => 185,  426 => 180,  420 => 220,  415 => 121,  411 => 174,  405 => 211,  403 => 149,  380 => 120,  366 => 285,  354 => 102,  331 => 198,  325 => 267,  320 => 265,  317 => 209,  311 => 262,  308 => 173,  304 => 116,  272 => 105,  267 => 91,  249 => 85,  216 => 134,  155 => 92,  146 => 67,  126 => 59,  188 => 213,  181 => 112,  161 => 62,  110 => 63,  124 => 58,  692 => 373,  683 => 282,  678 => 279,  676 => 367,  666 => 126,  661 => 407,  656 => 402,  652 => 376,  645 => 236,  641 => 352,  635 => 376,  631 => 238,  625 => 284,  615 => 335,  607 => 363,  597 => 163,  590 => 223,  583 => 266,  579 => 353,  577 => 213,  575 => 212,  569 => 213,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 139,  529 => 222,  524 => 344,  516 => 245,  510 => 78,  504 => 145,  500 => 331,  495 => 233,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 158,  421 => 223,  417 => 219,  400 => 148,  385 => 203,  361 => 207,  344 => 127,  339 => 273,  324 => 102,  310 => 118,  302 => 115,  296 => 96,  282 => 143,  259 => 151,  244 => 96,  231 => 123,  226 => 76,  215 => 63,  186 => 79,  152 => 103,  114 => 63,  104 => 57,  358 => 209,  351 => 130,  347 => 208,  343 => 188,  338 => 125,  327 => 268,  323 => 121,  319 => 176,  315 => 104,  301 => 204,  299 => 174,  293 => 111,  289 => 162,  281 => 93,  277 => 107,  271 => 157,  265 => 150,  262 => 68,  260 => 146,  257 => 100,  251 => 123,  248 => 139,  239 => 131,  228 => 75,  225 => 125,  213 => 70,  211 => 125,  197 => 135,  174 => 107,  148 => 88,  134 => 89,  127 => 70,  20 => 1,  270 => 150,  253 => 124,  233 => 92,  212 => 133,  210 => 118,  206 => 67,  202 => 114,  198 => 104,  192 => 124,  185 => 100,  180 => 78,  175 => 110,  172 => 106,  167 => 104,  165 => 203,  160 => 114,  137 => 63,  113 => 64,  100 => 42,  90 => 28,  81 => 53,  65 => 24,  129 => 56,  97 => 41,  77 => 20,  34 => 3,  53 => 18,  84 => 36,  58 => 26,  23 => 2,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 227,  427 => 226,  423 => 256,  413 => 220,  409 => 219,  407 => 247,  402 => 210,  398 => 401,  393 => 296,  387 => 215,  384 => 214,  381 => 236,  379 => 110,  374 => 137,  368 => 207,  365 => 119,  362 => 205,  360 => 223,  355 => 280,  341 => 126,  337 => 201,  322 => 266,  314 => 162,  312 => 174,  309 => 100,  305 => 204,  298 => 165,  294 => 142,  285 => 152,  283 => 151,  278 => 142,  268 => 101,  264 => 90,  258 => 88,  252 => 98,  247 => 133,  241 => 62,  229 => 135,  220 => 72,  214 => 86,  177 => 77,  169 => 105,  140 => 73,  132 => 74,  128 => 63,  107 => 58,  61 => 52,  273 => 130,  269 => 104,  254 => 99,  243 => 83,  240 => 95,  238 => 61,  235 => 80,  230 => 78,  227 => 91,  224 => 90,  221 => 89,  219 => 60,  217 => 87,  208 => 132,  204 => 138,  179 => 123,  159 => 71,  143 => 89,  135 => 71,  119 => 56,  102 => 45,  71 => 31,  67 => 30,  63 => 15,  59 => 21,  28 => 2,  94 => 30,  89 => 24,  85 => 37,  75 => 36,  68 => 30,  56 => 12,  87 => 36,  201 => 152,  196 => 125,  183 => 211,  171 => 206,  166 => 107,  163 => 93,  158 => 83,  156 => 70,  151 => 68,  142 => 93,  138 => 72,  136 => 60,  121 => 54,  117 => 1,  105 => 46,  91 => 53,  62 => 23,  49 => 16,  25 => 4,  21 => 2,  31 => 2,  38 => 5,  26 => 6,  24 => 3,  19 => 1,  93 => 39,  88 => 37,  78 => 46,  46 => 34,  44 => 8,  27 => 3,  79 => 33,  72 => 33,  69 => 54,  47 => 7,  40 => 6,  37 => 11,  22 => 15,  246 => 84,  157 => 93,  145 => 72,  139 => 92,  131 => 61,  123 => 69,  120 => 69,  115 => 54,  111 => 55,  108 => 59,  101 => 59,  98 => 40,  96 => 57,  83 => 60,  74 => 45,  66 => 19,  55 => 19,  52 => 11,  50 => 20,  43 => 7,  41 => 12,  35 => 6,  32 => 7,  29 => 6,  209 => 68,  203 => 153,  199 => 151,  193 => 116,  189 => 80,  187 => 114,  182 => 68,  176 => 100,  173 => 65,  168 => 108,  164 => 73,  162 => 72,  154 => 95,  149 => 163,  147 => 95,  144 => 94,  141 => 62,  133 => 60,  130 => 40,  125 => 27,  122 => 84,  116 => 50,  112 => 47,  109 => 35,  106 => 61,  103 => 60,  99 => 44,  95 => 2,  92 => 38,  86 => 59,  82 => 36,  80 => 35,  73 => 55,  64 => 29,  60 => 27,  57 => 19,  54 => 50,  51 => 17,  48 => 16,  45 => 7,  42 => 14,  39 => 13,  36 => 4,  33 => 3,  30 => 2,);
    }
}
