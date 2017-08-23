<?php

/* MinsalSiapsBundle:MntPacienteAdmin:encabezado_paciente_reporte.html.twig */
class __TwigTemplate_9fb21bb94de915306486ffe857e7d505a73e3a81b8d537ad092b870989fe610e extends Twig_Template
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
        echo "<div class=\"table-responsive\" style=\"overflow-x: auto;\">
    ";
        // line 2
        if ((array_key_exists("lab_section", $context) && ((isset($context["lab_section"]) ? $context["lab_section"] : $this->getContext($context, "lab_section")) == true))) {
            // line 3
            echo "        <table class=\"table-header\" style=\"font-size: 12px;\">
            <tbody>
                <tr>
                    <th><strong>No. de Expediente:</strong></th>
                    <td colspan=\"2\"><span style=\"font-size: 16px;\">";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "numero"), "html", null, true);
            echo "</span></td>
                    <th><strong>Paciente:</strong></th>
                    <td colspan=\"2\"><span>";
            // line 9
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : null), "getIdPaciente", array(), "method", false, true), "primerApellido", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : null), "getIdPaciente", array(), "method", false, true), "primerApellido"), "")) : ("")), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : null), "getIdPaciente", array(), "method", false, true), "segundoApellido", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : null), "getIdPaciente", array(), "method", false, true), "segundoApellido"), "")) : ("")), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : null), "getIdPaciente", array(), "method", false, true), "apellidoCasada", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : null), "getIdPaciente", array(), "method", false, true), "apellidoCasada"), "")) : ("")), "html", null, true);
            echo ", ";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : null), "getIdPaciente", array(), "method", false, true), "primerNombre", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : null), "getIdPaciente", array(), "method", false, true), "primerNombre"), "")) : ("")), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : null), "getIdPaciente", array(), "method", false, true), "segundoNombre", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : null), "getIdPaciente", array(), "method", false, true), "segundoNombre"), "")) : ("")), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : null), "getIdPaciente", array(), "method", false, true), "tercerNombre", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : null), "getIdPaciente", array(), "method", false, true), "tercerNombre"), "")) : ("")), "html", null, true);
            echo "</span></td>
                </tr>
                <tr>
                    <th><strong>Sexo:</strong></th>
                    <td><span>";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdSexo", array(), "method"), "getNombre", array(), "method"), "html", null, true);
            echo "</span></td>
                    <th><span>Fecha de Nacimiento:</span></th>
                    <td><span>";
            // line 15
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getFechaNacimiento", array(), "method"), "d/m/Y"), "html", null, true);
            echo "</span></td>
                    <th><span>Edad:</span></th>
                    <td><span>";
            // line 17
            echo twig_escape_filter($this->env, (isset($context["edad"]) ? $context["edad"] : $this->getContext($context, "edad")), "html", null, true);
            echo "</span></td>
                </tr>
                <tr>
                    <th><strong>Procedencia:</strong></th>
                    <td colspan=\"2\"><span>";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "datosGenerales"), "procedencia"), "html", null, true);
            echo "</span></td>
                    <th><span>Origen:</span></th>
                    <td colspan=\"2\"><span>";
            // line 23
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "datosGenerales"), "servicio"), "html", null, true);
            echo "</span></td>
                </tr>
                <tr>
                    <th><span>Médico:</span></th>
                    <td colspan=\"2\"><span>";
            // line 27
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "datosGenerales"), "nombre_empleado"), "html", null, true);
            echo "</span></td>
                    <th><strong>Fecha Solicitud:</strong></th>
                    <td colspan=\"2\"><span>";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "datosGenerales"), "fecha_solicitud"), "html", null, true);
            echo "</span></td>
                </tr>
            </tbody>
        </table>
    ";
        } else {
            // line 34
            echo "        <table class=\"table-bordered table-condensed\">
            <tbody>
                <tr class=\"sonata-ba-view-container\">
                    <th >Nombre:</th>
                    <td> ";
            // line 38
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "primerApellido"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "segundoApellido"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "apellidoCasada"), "html", null, true);
            echo ", ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "primerNombre"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "segundoNombre"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "tercerNombre"), "html", null, true);
            echo "   </td>
                    <th>Número Expediente:</th>
                    <td style=\"font-size: 16px;\"><span>";
            // line 40
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "numero"), "html", null, true);
            echo "</span></td>
                </tr>
                <tr class=\"sonata-ba-view-container\">
                    <th>Edad:</th>
                    <td ><span>";
            // line 44
            echo twig_escape_filter($this->env, (isset($context["edad"]) ? $context["edad"] : $this->getContext($context, "edad")), "html", null, true);
            echo "</span></td>
                    <th>Sexo: </th>
                    <td ><span>";
            // line 46
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "idSexo"), "html", null, true);
            echo "</span></td>
                </tr>
                <tr class=\"sonata-ba-view-container\">
                    <th>Conocido por:</th>
                    <td ><span>";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getConocidoPor", array(), "method"), "html", null, true);
            echo "</span></td>
                    <th>Doc. Identidad: </th>
                    <td ><span>";
            // line 52
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdDocPaciente", array(), "method"), "html", null, true);
            echo ":";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getNumeroDocIdePaciente", array(), "method")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getNumeroDocIdePaciente", array(), "method")) : ("-")), "html", null, true);
            echo "</span></td>
                </tr>
            </tbody>
        </table>
    ";
        }
        // line 57
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:MntPacienteAdmin:encabezado_paciente_reporte.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  535 => 224,  519 => 219,  416 => 172,  1082 => 552,  1076 => 550,  1072 => 548,  1069 => 547,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 450,  842 => 443,  836 => 440,  824 => 435,  781 => 416,  775 => 413,  762 => 406,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 388,  708 => 381,  703 => 378,  674 => 366,  659 => 359,  636 => 350,  604 => 329,  581 => 320,  568 => 315,  539 => 226,  534 => 298,  530 => 297,  521 => 220,  489 => 208,  483 => 206,  394 => 234,  396 => 163,  345 => 283,  476 => 315,  386 => 284,  364 => 219,  234 => 78,  595 => 326,  589 => 192,  586 => 322,  562 => 312,  556 => 182,  506 => 103,  498 => 211,  492 => 281,  473 => 165,  458 => 266,  399 => 143,  352 => 211,  346 => 125,  328 => 524,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 251,  758 => 405,  667 => 218,  573 => 172,  567 => 170,  520 => 177,  481 => 167,  475 => 203,  472 => 202,  466 => 156,  441 => 346,  438 => 149,  432 => 182,  429 => 342,  395 => 287,  382 => 128,  378 => 281,  367 => 120,  357 => 144,  348 => 115,  334 => 110,  286 => 6,  205 => 115,  297 => 92,  218 => 81,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 296,  787 => 419,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 259,  740 => 239,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 224,  628 => 214,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 316,  499 => 154,  488 => 172,  389 => 318,  223 => 172,  14 => 2,  306 => 117,  303 => 91,  300 => 115,  292 => 86,  280 => 103,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 328,  599 => 327,  580 => 194,  574 => 230,  559 => 311,  526 => 179,  497 => 173,  485 => 318,  463 => 268,  447 => 152,  404 => 238,  401 => 289,  391 => 161,  369 => 129,  333 => 132,  329 => 275,  307 => 242,  287 => 58,  195 => 54,  178 => 48,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 265,  807 => 259,  805 => 426,  802 => 425,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 368,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 356,  647 => 355,  644 => 190,  632 => 349,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 224,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 307,  448 => 306,  424 => 249,  418 => 112,  410 => 113,  376 => 224,  373 => 152,  340 => 122,  326 => 256,  261 => 76,  118 => 41,  200 => 60,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 543,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 536,  1036 => 534,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 255,  796 => 422,  793 => 421,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 231,  710 => 149,  707 => 208,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 357,  649 => 122,  643 => 227,  640 => 226,  638 => 351,  617 => 112,  614 => 201,  598 => 107,  593 => 201,  576 => 101,  564 => 162,  557 => 310,  550 => 94,  527 => 296,  515 => 305,  512 => 290,  509 => 228,  503 => 81,  496 => 282,  493 => 155,  478 => 204,  467 => 197,  456 => 309,  450 => 114,  414 => 242,  408 => 239,  388 => 231,  371 => 72,  363 => 32,  350 => 142,  342 => 282,  335 => 136,  316 => 16,  290 => 110,  276 => 102,  266 => 83,  263 => 133,  255 => 185,  245 => 122,  207 => 1,  194 => 106,  184 => 53,  76 => 21,  810 => 238,  804 => 260,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 399,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 372,  685 => 371,  682 => 226,  672 => 223,  670 => 365,  665 => 362,  648 => 219,  627 => 206,  622 => 204,  619 => 212,  616 => 202,  613 => 210,  610 => 332,  608 => 197,  605 => 207,  596 => 106,  592 => 325,  587 => 197,  585 => 196,  582 => 190,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 228,  542 => 227,  533 => 186,  531 => 95,  507 => 287,  505 => 214,  502 => 175,  477 => 164,  471 => 164,  465 => 161,  454 => 265,  446 => 156,  443 => 256,  431 => 151,  428 => 250,  425 => 152,  422 => 338,  412 => 147,  406 => 111,  390 => 139,  383 => 159,  377 => 73,  375 => 124,  372 => 277,  370 => 222,  359 => 145,  356 => 269,  353 => 143,  349 => 119,  336 => 205,  332 => 259,  330 => 554,  318 => 122,  313 => 209,  291 => 108,  190 => 111,  321 => 254,  295 => 201,  274 => 87,  242 => 121,  236 => 177,  70 => 22,  170 => 230,  288 => 197,  284 => 192,  279 => 193,  275 => 227,  256 => 74,  250 => 73,  237 => 89,  232 => 136,  222 => 129,  191 => 88,  153 => 53,  150 => 52,  563 => 188,  560 => 187,  558 => 186,  553 => 309,  549 => 182,  543 => 179,  537 => 176,  532 => 223,  528 => 173,  525 => 172,  523 => 171,  518 => 292,  514 => 218,  511 => 217,  508 => 165,  501 => 212,  491 => 157,  487 => 156,  460 => 194,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 183,  433 => 130,  426 => 126,  420 => 297,  415 => 121,  411 => 170,  405 => 118,  403 => 117,  380 => 107,  366 => 106,  354 => 101,  331 => 96,  325 => 94,  320 => 521,  317 => 91,  311 => 87,  308 => 205,  304 => 116,  272 => 81,  267 => 130,  249 => 78,  216 => 68,  155 => 195,  146 => 98,  126 => 87,  188 => 54,  181 => 107,  161 => 54,  110 => 58,  124 => 44,  692 => 373,  683 => 282,  678 => 279,  676 => 367,  666 => 126,  661 => 380,  656 => 358,  652 => 376,  645 => 215,  641 => 352,  635 => 226,  631 => 218,  625 => 361,  615 => 335,  607 => 208,  597 => 177,  590 => 202,  583 => 321,  579 => 284,  577 => 319,  575 => 328,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 299,  529 => 222,  524 => 90,  516 => 291,  510 => 78,  504 => 90,  500 => 88,  495 => 210,  490 => 154,  486 => 165,  482 => 317,  470 => 313,  464 => 196,  459 => 116,  452 => 191,  434 => 252,  421 => 90,  417 => 296,  400 => 116,  385 => 129,  361 => 207,  344 => 139,  339 => 137,  324 => 179,  310 => 208,  302 => 93,  296 => 151,  282 => 104,  259 => 186,  244 => 82,  231 => 67,  226 => 69,  215 => 63,  186 => 109,  152 => 51,  114 => 40,  104 => 36,  358 => 103,  351 => 116,  347 => 210,  343 => 264,  338 => 280,  327 => 108,  323 => 522,  319 => 124,  315 => 121,  301 => 80,  299 => 201,  293 => 199,  289 => 82,  281 => 57,  277 => 192,  271 => 79,  265 => 100,  262 => 187,  260 => 128,  257 => 53,  251 => 182,  248 => 83,  239 => 120,  228 => 75,  225 => 65,  213 => 69,  211 => 156,  197 => 113,  174 => 59,  148 => 49,  134 => 50,  127 => 46,  20 => 1,  270 => 85,  253 => 78,  233 => 66,  212 => 158,  210 => 66,  206 => 109,  202 => 108,  198 => 54,  192 => 55,  185 => 104,  180 => 49,  175 => 47,  172 => 105,  167 => 44,  165 => 83,  160 => 199,  137 => 48,  113 => 34,  100 => 38,  90 => 30,  81 => 27,  65 => 20,  129 => 88,  97 => 92,  77 => 35,  34 => 13,  53 => 68,  84 => 80,  58 => 71,  23 => 3,  480 => 205,  474 => 274,  469 => 271,  461 => 70,  457 => 124,  453 => 151,  444 => 185,  440 => 184,  437 => 253,  435 => 344,  430 => 153,  427 => 180,  423 => 298,  413 => 241,  409 => 327,  407 => 169,  402 => 166,  398 => 235,  393 => 162,  387 => 160,  384 => 230,  381 => 315,  379 => 154,  374 => 36,  368 => 149,  365 => 119,  362 => 146,  360 => 216,  355 => 27,  341 => 138,  337 => 97,  322 => 93,  314 => 88,  312 => 97,  309 => 118,  305 => 204,  298 => 247,  294 => 100,  285 => 105,  283 => 5,  278 => 110,  268 => 101,  264 => 93,  258 => 75,  252 => 184,  247 => 72,  241 => 179,  229 => 86,  220 => 171,  214 => 58,  177 => 106,  169 => 44,  140 => 47,  132 => 84,  128 => 41,  107 => 29,  61 => 15,  273 => 190,  269 => 189,  254 => 86,  243 => 180,  240 => 72,  238 => 79,  235 => 67,  230 => 175,  227 => 174,  224 => 74,  221 => 61,  219 => 60,  217 => 86,  208 => 65,  204 => 63,  179 => 50,  159 => 40,  143 => 36,  135 => 37,  119 => 37,  102 => 31,  71 => 19,  67 => 25,  63 => 73,  59 => 21,  28 => 5,  94 => 34,  89 => 56,  85 => 43,  75 => 77,  68 => 18,  56 => 22,  87 => 81,  201 => 115,  196 => 112,  183 => 55,  171 => 63,  166 => 103,  163 => 200,  158 => 196,  156 => 75,  151 => 1,  142 => 97,  138 => 87,  136 => 45,  121 => 75,  117 => 36,  105 => 34,  91 => 29,  62 => 17,  49 => 66,  25 => 4,  21 => 2,  31 => 2,  38 => 7,  26 => 2,  24 => 3,  19 => 1,  93 => 31,  88 => 40,  78 => 22,  46 => 7,  44 => 9,  27 => 3,  79 => 28,  72 => 76,  69 => 21,  47 => 10,  40 => 6,  37 => 5,  22 => 2,  246 => 181,  157 => 2,  145 => 48,  139 => 52,  131 => 42,  123 => 92,  120 => 91,  115 => 40,  111 => 32,  108 => 37,  101 => 86,  98 => 33,  96 => 26,  83 => 24,  74 => 23,  66 => 74,  55 => 13,  52 => 13,  50 => 9,  43 => 62,  41 => 61,  35 => 9,  32 => 12,  29 => 3,  209 => 157,  203 => 56,  199 => 59,  193 => 57,  189 => 65,  187 => 54,  182 => 103,  176 => 49,  173 => 48,  168 => 202,  164 => 42,  162 => 102,  154 => 1,  149 => 57,  147 => 101,  144 => 49,  141 => 71,  133 => 43,  130 => 40,  125 => 78,  122 => 44,  116 => 54,  112 => 89,  109 => 33,  106 => 47,  103 => 49,  99 => 30,  95 => 29,  92 => 28,  86 => 29,  82 => 37,  80 => 26,  73 => 23,  64 => 16,  60 => 72,  57 => 15,  54 => 14,  51 => 12,  48 => 11,  45 => 8,  42 => 8,  39 => 14,  36 => 5,  33 => 6,  30 => 7,);
    }
}
