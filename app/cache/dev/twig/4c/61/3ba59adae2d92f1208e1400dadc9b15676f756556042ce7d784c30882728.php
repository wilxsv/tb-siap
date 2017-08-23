<?php

/* MinsalSeguimientoBundle:SecIngreso:list.html.twig */
class __TwigTemplate_4c613ba59adae2d92f1208e1400dadc9b15676f756556042ce7d784c30882728 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_admin_content' => array($this, 'block_sonata_admin_content'),
            'notice' => array($this, 'block_notice'),
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
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalseguimiento/css/SecIngreso/list.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 8
    public function block_javascripts($context, array $blocks = array())
    {
        // line 9
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/js/maskedinput/jquery.maskedinput.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script type=\"text/javascript\">
    \$(document).ready(function() {
        \$('select[id\$=\"servicio_ingreso\"]').prepend('<option/>').val(function(){ return \$('[selected]',this).val(); });
        \$('select[id\$=\"servicio_ingreso\"]').select2({
            placeholder: 'Seleccionar...',
            allowClear:  true,
            width:'50%'
        });

        \$(\"#fecha_nacimiento\").mask(\"99/99/9999\");
        \$(\"#nec\").focus();
        \$('input.nombres').blur(function () {
            \$(this).val(limpiar_nombres(\$(this).val()));
        });
        \$('input.nombresLargos').blur(function () {
            \$(this).val(limpiar_nombres(\$(this).val()))
        });

        \$.getJSON(Routing.generate('get_servicios_hospitalarios_todos'),
        function(data) {
            \$.each(data.especialidades, function(indice, aux) {
                \$('#servicio_ingreso').append('<option value=\"' + aux.id + '\">' + aux.nombre + '</option>');
            });
        });

        \$(\"#buscar\").click(function(e) {
                if (\$(\"#nec\").val() != '') {
                    regexp = /^[0-9]{1,}\$/;
                    var valores = \$(\"#nec\").val().split('-');
                    if (valores.length > 2) {//VERIFICA SI TIENE MAS DE DOS GUIONES
                        /*PARA MOSTRAR MENSAJE DE ERROR DE FORMATO DE EXPEDIENTE
                         * PRIMERO SE CREA O ELIMINA EL ELEMENTO
                         * LUEGO SE CREA CON EL MENSAJE ADECUADO Y SE COLOCA
                         * LUEGO DEL FORMULARIO PARA ABRIRSE.
                         * */
                         var title='Error de Formato de Expediente';
                         var body=\"El formato del número de expediente no es el adecuado.\";
                         var clase='dialog-error';
                         var arrayBtns = [{text: 'Cerrar',
                                     click: function( event, ui) {
                                     jQuery( this ).dialog( \"close\" );
                                     \$(\"#nec\").val('');
                                     \$(\"#nec\").focus();
                                   }}
                                 ];
                        showDialogMsg(title, body, clase, '', arrayBtns, false, null, true);
                         e.preventDefault();
                    } else {
                        if (!regexp.test(valores[0])) {//CONTIENE LETRAS EN INFINITO
                            /*PARA MOSTRAR MENSAJE DE ERROR DE FORMATO DE EXPEDIENTE
                             * PRIMERO SE CREA O ELIMINA EL ELEMENTO
                             * LUEGO SE CREA CON EL MENSAJE ADECUADO Y SE COLOCA
                             * LUEGO DEL FORMULARIO PARA ABRIRSE.
                             * */
                             var title='Error de escritura';
                             var body=\"El Número de Expediente no puede contener letras\";
                             var clase='dialog-error';
                             var arrayBtns = [{text: 'Cerrar',
                                         click: function( event, ui) {
                                         jQuery( this ).dialog( \"close\" );
                                         \$(\"#nec\").val('');
                                         \$(\"#nec\").focus();
                                       }}
                                     ];
                             showDialogMsg(title, body, clase, '', arrayBtns, false, null, true);
                             e.preventDefault();
                        } else {
                            if (valores.length > 1) {
                                if (!regexp.test(valores[1])) {
                                    /*PARA MOSTRAR MENSAJE DE ERROR DE FORMATO DE EXPEDIENTE
                                     * PRIMERO SE CREA O ELIMINA EL ELEMENTO
                                     * LUEGO SE CREA CON EL MENSAJE ADECUADO Y SE COLOCA
                                     * LUEGO DEL FORMULARIO PARA ABRIRSE.
                                     * */
                                     var title='Error de escritura';
                                     var body=\"El Número de Expediente no puede contener letras\";
                                     var clase='dialog-error';
                                     var arrayBtns = [{text: 'Cerrar',
                                                 click: function( event, ui) {
                                                 jQuery( this ).dialog( \"close\" );
                                                 \$(\"#nec\").val('');
                                                 \$(\"#nec\").focus();
                                               }}
                                             ];
                                     showDialogMsg(title, body, clase, '', arrayBtns, false, null, true);
                                     e.preventDefault();
                                } else {
                                    cargarPacientes();
                                }
                            } else {
                                cargarPacientes();
                            }
                        }
                    }
                } else {
                    if (\$(\"#servicio_ingreso\").val() != '') {
                        cargarPacientes();
                    } else {
                        if (\$(\"#nec\").val() != '') {
                            cargarPacientes();
                        } else {
                            if (\$(\"#fecha_nacimiento\").val() != '') {
                                cargarPacientes();
                            }
                            else {
                                if (\$(\"#primer_apellido\").val() == '' && \$(\"#primer_nombre\").val() == '') {
                                    var title='Campos Obligatorios';
                                    var body=\"Los campos:\\n\\
                                    <ul><li> <strong>Primer Apellido</strong> </li><li><strong>Primer Nombre</strong></li></ul>\";
                                    var clase='dialog-error';
                                    var arrayBtns = [{text: 'Cerrar',
                                                click: function( event, ui) {
                                                jQuery( this ).dialog( \"close\" );
                                                  \$(\"#primer_apellido\").focus();
                                              }}
                                            ];
                                    showDialogMsg(title, body, clase, '', arrayBtns, false, null, true);
                                    e.preventDefault();
                                } else {
                                    cargarPacientes();
                                }
                            }
                        }
                    }
                }
                return false;
            });
            function cargarPacientes(){
                \$('#resultadoBusqueda').empty();
                \$('#resultadoBusqueda').append('<center><img id=\"wait\" src=\"";
        // line 140
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/wait_icon1.gif"), "html", null, true);
        echo "\" alt=\"wait\" width=\"24\" height=\"24\"><div id=\"search-message\">Por Favor Espere...</div></center>');
                \$('#resultadoBusqueda').load(Routing.generate('buscar_ingresos',{'datos':\$('#buscarForm').serialize()}));
            }
    });
    </script>
";
    }

    // line 147
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 148
        $this->displayBlock('notice', $context, $blocks);
        // line 151
        echo "    <h4><img class=\"icono\" src=";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/buscar-paciente.png"), "html", null, true);
        echo " />Consulta de  Ingresos por Paciente</h4>
    <br/>
    <form id=\"buscarForm\" method=\"post\" >
        <table class=\"table table-bordered \">
            <tbody>
                <tr>
                    <td class=\"sonata-ba-list-field-header \"><strong>Número de Expediente</strong></td>
                    <td><input id=\"nec\" name=\"nec\" type=\"text\" class=\"fecha form-control\"  maxlength=\"15\" /></td>
                </tr>
                <tr>
                    <td class=\"sonata-ba-list-field-header \"><strong>Primer Apellido:*</strong></td>
                    <td><input id=\"primer_apellido\" name=\"primer_apellido\" class=\"nombres form-control\" type=\"text\"  maxlength=\"25\"/></td>
                    <td class=\"sonata-ba-list-field-header \"><strong>Segundo Apellido:</td>
                    <td><input id=\"segundo_apellido\" name=\"segundo_apellido\" class=\"nombres form-control\" type=\"text\"  maxlength=\"25\"/></td>
                    <td class=\"sonata-ba-list-field-header \"><strong>Apellido Casada:</td>
                    <td><input id=\"apellido_casada\" name=\"apellido_casada\" class=\"nombres form-control\" type=\"text\"  maxlength=\"25\"/></td>

                </tr>
                <tr>
                    <td class=\"sonata-ba-list-field-header \"><strong>Primer Nombre: *</strong></td>
                    <td><input id=\"primer_nombre\" name=\"primer_nombre\" type=\"text\" class=\"nombres form-control\"  maxlength=\"25\"/></td>
                    <td class=\"sonata-ba-list-field-header \"><strong>Segundo Nombre:</strong></td>
                    <td><input id=\"segundo_nombre\" name=\"segundo_nombre\" type=\"text\" class=\"nombres form-control\"  maxlength=\"25\"/></td>
                    <td class=\"sonata-ba-list-field-header \"><strong>Tercer Nombre:</strong></td>
                    <td><input id=\"tercer_nombre\" name=\"tercer_nombre\" type=\"text\" class=\"nombres form-control\"  maxlength=\"25\"/></td>
                </tr>
                <tr>
                    <td class=\"sonata-ba-list-field-header \"><strong>Fecha Nacimiento:</strong></td>
                    <td><input id=\"fecha_nacimiento\" name=\"fecha_nacimiento\" type=\"text\" class=\"fecha form-control bootstrap-datepicker now form-control\" /></td>
                    <td class=\"sonata-ba-list-field-header\"><strong>Servicio de Ingreso:</strong></td>
                    <td colspan=\"3\">
                        <select id=\"servicio_ingreso\" name=\"servicio_ingreso\" style=\"margin-left:4px !important;\">
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan=\"6\" class=\"no-bottom-border\">
                        <div class=\"pull-right\">
                            <a id=\"buscar\" class=\"btn btn-primary\" href=\"\">
                                <span class=\"glyphicon glyphicon-search\"></span>
                                Buscar
                            </a>
                            <a id=\"limpiar\" class=\"btn btn-info\" href=\"\">
                                <span class=\"glyphicon glyphicon-trash\"></span>
                                Limpiar
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <div id=\"resultadoBusqueda\"></div>
";
    }

    // line 148
    public function block_notice($context, array $blocks = array())
    {
        // line 149
        echo "    ";
        $this->env->loadTemplate("SonataCoreBundle:FlashMessage:render.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecIngreso:list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  639 => 285,  611 => 283,  538 => 271,  646 => 188,  642 => 286,  544 => 273,  541 => 272,  517 => 301,  797 => 489,  752 => 459,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 224,  519 => 306,  416 => 172,  1082 => 552,  1076 => 550,  1072 => 548,  1069 => 547,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 450,  842 => 443,  836 => 440,  824 => 435,  781 => 416,  775 => 413,  762 => 406,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 388,  708 => 381,  703 => 378,  674 => 366,  659 => 196,  636 => 350,  604 => 329,  581 => 330,  568 => 315,  539 => 322,  534 => 298,  530 => 297,  521 => 220,  489 => 208,  483 => 206,  394 => 234,  396 => 206,  345 => 189,  476 => 248,  386 => 284,  364 => 219,  234 => 78,  595 => 326,  589 => 161,  586 => 322,  562 => 144,  556 => 274,  506 => 103,  498 => 292,  492 => 274,  473 => 277,  458 => 266,  399 => 209,  352 => 221,  346 => 125,  328 => 179,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 218,  573 => 328,  567 => 347,  520 => 270,  481 => 280,  475 => 275,  472 => 269,  466 => 272,  441 => 346,  438 => 224,  432 => 260,  429 => 222,  395 => 287,  382 => 128,  378 => 231,  367 => 120,  357 => 222,  348 => 190,  334 => 110,  286 => 137,  205 => 106,  297 => 79,  218 => 127,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 419,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 302,  687 => 301,  671 => 262,  669 => 219,  653 => 232,  634 => 182,  628 => 372,  621 => 220,  609 => 169,  602 => 206,  591 => 280,  571 => 316,  499 => 268,  488 => 273,  389 => 114,  223 => 114,  14 => 2,  306 => 117,  303 => 161,  300 => 115,  292 => 86,  280 => 159,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 164,  599 => 327,  580 => 277,  574 => 152,  559 => 311,  526 => 309,  497 => 173,  485 => 283,  463 => 271,  447 => 152,  404 => 242,  401 => 119,  391 => 222,  369 => 228,  333 => 95,  329 => 93,  307 => 85,  287 => 75,  195 => 110,  178 => 123,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 425,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 209,  700 => 205,  679 => 201,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 189,  647 => 355,  644 => 190,  632 => 349,  629 => 186,  626 => 221,  603 => 362,  600 => 178,  594 => 281,  588 => 279,  584 => 158,  570 => 149,  561 => 168,  554 => 321,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 279,  468 => 163,  451 => 307,  448 => 306,  424 => 234,  418 => 112,  410 => 236,  376 => 109,  373 => 152,  340 => 200,  326 => 212,  261 => 149,  118 => 53,  200 => 117,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 543,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 536,  1036 => 534,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 488,  785 => 486,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 437,  710 => 149,  707 => 208,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 134,  675 => 199,  662 => 217,  658 => 124,  654 => 357,  649 => 122,  643 => 227,  640 => 226,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 162,  576 => 101,  564 => 162,  557 => 310,  550 => 94,  527 => 296,  515 => 305,  512 => 299,  509 => 228,  503 => 269,  496 => 282,  493 => 155,  478 => 204,  467 => 243,  456 => 270,  450 => 114,  414 => 214,  408 => 212,  388 => 204,  371 => 216,  363 => 226,  350 => 191,  342 => 97,  335 => 182,  316 => 16,  290 => 154,  276 => 102,  266 => 136,  263 => 149,  255 => 135,  245 => 122,  207 => 107,  194 => 112,  184 => 95,  76 => 51,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 399,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 372,  685 => 413,  682 => 202,  672 => 223,  670 => 365,  665 => 362,  648 => 219,  627 => 206,  622 => 369,  619 => 212,  616 => 202,  613 => 170,  610 => 332,  608 => 282,  605 => 207,  596 => 106,  592 => 325,  587 => 197,  585 => 331,  582 => 190,  578 => 154,  572 => 204,  566 => 324,  547 => 93,  545 => 228,  542 => 227,  533 => 138,  531 => 95,  507 => 287,  505 => 214,  502 => 278,  477 => 164,  471 => 164,  465 => 265,  454 => 269,  446 => 156,  443 => 264,  431 => 251,  428 => 250,  425 => 247,  422 => 338,  412 => 147,  406 => 111,  390 => 238,  383 => 112,  377 => 201,  375 => 230,  372 => 199,  370 => 222,  359 => 145,  356 => 193,  353 => 192,  349 => 220,  336 => 216,  332 => 215,  330 => 176,  318 => 90,  313 => 208,  291 => 141,  190 => 98,  321 => 254,  295 => 164,  274 => 71,  242 => 153,  236 => 177,  70 => 26,  170 => 95,  288 => 197,  284 => 89,  279 => 134,  275 => 157,  256 => 132,  250 => 66,  237 => 133,  232 => 136,  222 => 129,  191 => 104,  153 => 80,  150 => 35,  563 => 188,  560 => 275,  558 => 322,  553 => 309,  549 => 182,  543 => 179,  537 => 176,  532 => 223,  528 => 173,  525 => 311,  523 => 171,  518 => 292,  514 => 218,  511 => 217,  508 => 281,  501 => 294,  491 => 288,  487 => 156,  460 => 240,  455 => 141,  449 => 267,  442 => 259,  439 => 133,  436 => 183,  433 => 130,  426 => 221,  420 => 220,  415 => 121,  411 => 213,  405 => 211,  403 => 117,  380 => 202,  366 => 227,  354 => 102,  331 => 180,  325 => 94,  320 => 91,  317 => 209,  311 => 98,  308 => 173,  304 => 205,  272 => 81,  267 => 148,  249 => 142,  216 => 56,  155 => 82,  146 => 79,  126 => 71,  188 => 54,  181 => 90,  161 => 84,  110 => 58,  124 => 82,  692 => 373,  683 => 282,  678 => 279,  676 => 367,  666 => 126,  661 => 380,  656 => 287,  652 => 376,  645 => 215,  641 => 352,  635 => 376,  631 => 218,  625 => 284,  615 => 335,  607 => 363,  597 => 163,  590 => 202,  583 => 278,  579 => 353,  577 => 276,  575 => 352,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 139,  529 => 222,  524 => 90,  516 => 286,  510 => 78,  504 => 295,  500 => 88,  495 => 210,  490 => 154,  486 => 165,  482 => 317,  470 => 244,  464 => 242,  459 => 271,  452 => 191,  434 => 252,  421 => 90,  417 => 219,  400 => 116,  385 => 203,  361 => 207,  344 => 219,  339 => 137,  324 => 102,  310 => 86,  302 => 93,  296 => 200,  282 => 143,  259 => 151,  244 => 141,  231 => 123,  226 => 115,  215 => 63,  186 => 140,  152 => 54,  114 => 40,  104 => 48,  358 => 209,  351 => 101,  347 => 183,  343 => 188,  338 => 217,  327 => 108,  323 => 172,  319 => 176,  315 => 175,  301 => 204,  299 => 201,  293 => 177,  289 => 162,  281 => 74,  277 => 158,  271 => 70,  265 => 150,  262 => 68,  260 => 148,  257 => 126,  251 => 123,  248 => 142,  239 => 131,  228 => 75,  225 => 125,  213 => 127,  211 => 125,  197 => 101,  174 => 59,  148 => 92,  134 => 29,  127 => 56,  20 => 1,  270 => 146,  253 => 124,  233 => 117,  212 => 109,  210 => 126,  206 => 109,  202 => 114,  198 => 104,  192 => 98,  185 => 100,  180 => 105,  175 => 47,  172 => 59,  167 => 101,  165 => 40,  160 => 56,  137 => 61,  113 => 50,  100 => 60,  90 => 66,  81 => 53,  65 => 23,  129 => 71,  97 => 56,  77 => 55,  34 => 3,  53 => 10,  84 => 37,  58 => 12,  23 => 2,  480 => 205,  474 => 274,  469 => 271,  461 => 70,  457 => 124,  453 => 236,  444 => 185,  440 => 225,  437 => 244,  435 => 223,  430 => 153,  427 => 180,  423 => 256,  413 => 237,  409 => 327,  407 => 169,  402 => 210,  398 => 226,  393 => 205,  387 => 113,  384 => 237,  381 => 236,  379 => 110,  374 => 200,  368 => 197,  365 => 119,  362 => 195,  360 => 223,  355 => 27,  341 => 218,  337 => 180,  322 => 211,  314 => 186,  312 => 174,  309 => 118,  305 => 204,  298 => 165,  294 => 142,  285 => 152,  283 => 160,  278 => 142,  268 => 101,  264 => 147,  258 => 140,  252 => 143,  247 => 133,  241 => 62,  229 => 129,  220 => 123,  214 => 120,  177 => 93,  169 => 96,  140 => 73,  132 => 74,  128 => 63,  107 => 61,  61 => 22,  273 => 130,  269 => 129,  254 => 86,  243 => 134,  240 => 146,  238 => 61,  235 => 118,  230 => 116,  227 => 57,  224 => 74,  221 => 119,  219 => 60,  217 => 111,  208 => 117,  204 => 63,  179 => 98,  159 => 99,  143 => 82,  135 => 71,  119 => 67,  102 => 1,  71 => 57,  67 => 56,  63 => 55,  59 => 27,  28 => 7,  94 => 35,  89 => 24,  85 => 32,  75 => 58,  68 => 42,  56 => 53,  87 => 61,  201 => 151,  196 => 147,  183 => 104,  171 => 83,  166 => 107,  163 => 93,  158 => 83,  156 => 37,  151 => 79,  142 => 71,  138 => 69,  136 => 102,  121 => 54,  117 => 65,  105 => 2,  91 => 53,  62 => 20,  49 => 10,  25 => 5,  21 => 2,  31 => 2,  38 => 16,  26 => 6,  24 => 3,  19 => 1,  93 => 35,  88 => 52,  78 => 52,  46 => 13,  44 => 8,  27 => 6,  79 => 59,  72 => 44,  69 => 49,  47 => 20,  40 => 14,  37 => 13,  22 => 27,  246 => 78,  157 => 90,  145 => 72,  139 => 52,  131 => 64,  123 => 65,  120 => 74,  115 => 60,  111 => 62,  108 => 65,  101 => 58,  98 => 37,  96 => 64,  83 => 60,  74 => 26,  66 => 21,  55 => 29,  52 => 16,  50 => 21,  43 => 7,  41 => 17,  35 => 35,  32 => 12,  29 => 6,  209 => 108,  203 => 107,  199 => 148,  193 => 99,  189 => 107,  187 => 108,  182 => 95,  176 => 100,  173 => 43,  168 => 88,  164 => 85,  162 => 39,  154 => 69,  149 => 85,  147 => 45,  144 => 92,  141 => 62,  133 => 60,  130 => 40,  125 => 27,  122 => 26,  116 => 37,  112 => 51,  109 => 50,  106 => 49,  103 => 71,  99 => 54,  95 => 2,  92 => 1,  86 => 57,  82 => 37,  80 => 56,  73 => 25,  64 => 23,  60 => 54,  57 => 19,  54 => 14,  51 => 22,  48 => 9,  45 => 8,  42 => 12,  39 => 4,  36 => 6,  33 => 14,  30 => 13,);
    }
}
