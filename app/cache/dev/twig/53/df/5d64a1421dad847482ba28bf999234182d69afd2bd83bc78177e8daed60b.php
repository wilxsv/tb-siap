<?php

/* MinsalSiapsBundle:MntPacienteAdmin:list.html.twig */
class __TwigTemplate_53df5d64a1421dad847482ba28bf999234182d69afd2bd83bc78177e8daed60b extends Twig_Template
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
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/MntPacienteAdmin/list.css"), "html", null, true);
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
    <script type=\"text/javascript\">
      \$(document).ready(function () {

        \$('#idEstablecimientoReferencia').val('');

        \$('#dui').mask(\"99999999-9\");
        \$(\"#fecha_nacimiento\").mask(\"99/99/9999\");
        \$(\"#primer_apellido\").focus();

        \$(\"#capturar\").hide().click(function () {
          var url = \$(this).attr(\"href\");
          url += \"?primer_nombre=\" + \$(\"#primer_nombre\").val();
          url += \"&primer_apellido=\" + \$(\"#primer_apellido\").val();
          url += \"&segundo_apellido=\" + \$(\"#segundo_apellido\").val();
          url += \"&segundo_nombre=\" + \$(\"#segundo_nombre\").val();
          url += \"&tercer_nombre=\" + \$(\"#tercer_nombre\").val();
          url += \"&nombre_madre=\" + \$(\"#nombre_madre\").val();
          url += \"&conocido_por=\" + \$(\"#conocido_por\").val();
          url += \"&fecha_nacimiento=\" + \$(\"#fecha_nacimiento\").val();
          url += \"&dui=\" + \$(\"#dui\").val();
          url += \"&nec=\" + \$(\"#nec\").val();
          url += \"&procedencia=\" + \$(\"#procedencia\").val();
          url += \"&origenCita=\" + \$(\"#origenCita\").val();
          url += \"&idEstablecimientoReferencia=\" + \$(\"#idEstablecimientoReferencia\").val();
          url += \"&expedienteReferencia=\" + \$(\"#expedienteReferencia\").val();
          url += \"&clasificacion=0\";
          \$(this).attr(\"href\", url);
        });

        \$(\"#buscarGlobal\").hide();

        \$(\"#limpiar\").click(function () {
          \$('#resultadoBusqueda').empty();
          \$('#buscarForm')[0].reset();
          \$(\"#buscar\").show();
          \$(\"#buscarGlobal\").hide();
          \$(\"#capturar\").hide();

          return false;
        });

        \$(\"#buscar\").click(function (e) {
          regexp = /^[0-9]{1,}\$/;

            //Si es búsqueda del módulo de citas
            ";
        // line 55
        if (array_key_exists("origenCita", $context)) {
            // line 56
            echo "                if (\$(\"#idEstablecimientoReferencia\").val() == ''){
                    /*PARA MOSTRAR MENSAJE DE ERROR DE FORMATO DE EXPEDIENTE
                    * PRIMERO SE CREA O ELIMINA EL ELEMENTO
                    * LUEGO SE CREA CON EL MENSAJE ADECUADO Y SE COLOCA
                    * LUEGO DEL FORMULARIO PARA ABRIRSE.
                    * */
                    var title='Campos Obligatorios';
                    var body=\"Debe seleccionar un establecimiento de referencia.\";
                    var clase='dialog-error';
                    var arrayBtns = [{text: 'Cerrar',
                                click: function( event, ui) {
                                jQuery( this ).dialog( \"close\" );
                                \$(\"#idEstablecimientoReferencia\").select2('open');
                              }}
                            ];
                    showDialogMsg(title, body, clase, '', arrayBtns, false, null, true);
                    return false;
                }
            ";
        }
        // line 75
        echo "
          if (\$(\"#nec\").val() != '') {
            var valores = \$(\"#nec\").val().split('-');
            if (valores.length > 2) {
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
              if (!regexp.test(valores[0])) {
                if (valores[0].charAt(0).toLowerCase() == 't') {
                  if (!regexp.test(valores[0].substring(1, valores[0].length))) {
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
                    \$(\"#capturar\").show();
                    cargarResultadoBusqueda();
                  }
                } else {
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
                }
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
                    \$(\"#capturar\").show();
                    cargarResultadoBusqueda();
                    // \$(\"#buscarGlobal\").show();
                    //\$(\"#buscar\").show();
                  }
                } else {
                  \$(\"#capturar\").show();
                  cargarResultadoBusqueda();
                  // \$(\"#buscarGlobal\").show();
                  //\$(\"#buscar\").show();
                }
              }
            }
           } else {
            if (\$(\"#dui\").val() != '') {
              \$(\"#capturar\").show();
              cargarResultadoBusqueda();
              // \$(\"#buscarGlobal\").show();
              //\$(\"#buscar\").show();
            } else {
              if (\$(\"#fecha_nacimiento\").val() != '') {
                \$(\"#capturar\").show();
                cargarResultadoBusqueda();
              }
              else {
                if (\$(\"#primer_apellido\").val() == '' && \$(\"#primer_nombre\").val() == '') {
                  //SE LE ASIGNA VALOR AL ELEMENTO
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
                  \$(\"#capturar\").show();
                  cargarResultadoBusqueda();
                }
              }
            }
          }
          e.preventDefault();
        });


        \$(\"#buscarGlobal\").click(function () {
          if (\$(\"#primer_apellido\").val() == '' && \$(\"#primer_nombre\").val() == '') {
            //SE LE ASIGNA VALOR AL ELEMENTO
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
            \$(\"#capturar\").show();
            \$(this).hide();
            \$(\"#buscar\").show();
            \$('#resultadoBusqueda').empty();
            \$('#resultadoBusqueda').append('<center><img id=\"wait\" src=\"";
        // line 227
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/wait_icon1.gif"), "html", null, true);
        echo "\" alt=\"wait\" width=\"24\" height=\"24\"><div id=\"search-message\">Por Favor Espere...</div></center>');
            \$('#resultadoBusqueda').load(Routing.generate('buscar_paciente_global'));
          }
          return false;
        });

        function cargarResultadoBusqueda(){
            \$('#resultadoBusqueda').empty();
            \$('#resultadoBusqueda').waitMe({'text':'Buscando'});
            \$('#resultadoBusqueda').load(Routing.generate('buscar_paciente',{'datos':\$('#buscarForm').serialize(),'tipo_busqueda':'l'}));
        }

        //PASANDO A MAYUSCULAS LOS ELEMENTOS
        \$('input.nombres').blur(function () {
            \$(this).val(limpiar_nombres(\$(this).val()))
        });
        \$('input.nombresLargos').blur(function () {
            \$(this).val(limpiar_nombres(\$(this).val()))
        });

        ";
        // line 247
        if (array_key_exists("origenCita", $context)) {
            // line 248
            echo "            \$idEstablecimientoReferencia = \$('#idEstablecimientoReferencia');

            \$idEstablecimientoReferencia.select2({
                allowClear: true,
                placeholder: 'Seleccionar...',
                minimumInputLength: 4,
                dropdownAutoWidth: true,
                width: '100%',
                ajax: {
                    url: Routing.generate('obtener_establecimientos'),
                    dataType: 'json',
                    quietMillis: 500,
                    data: function(term, page) {
                        return {
                            clue: term, //search term
                            page_limit: 10, // page size
                            page: page, // page number
                        };
                    },
                    results: function(data, page) {
                        var more = (page * 10) < data.total;

                        return {results: data.datos, more: more};
                    }
                }
            });
        ";
        }
        // line 275
        echo "      });
    </script>
";
    }

    // line 279
    public function block_notice($context, array $blocks = array())
    {
        // line 280
        $this->env->loadTemplate("SonataCoreBundle:FlashMessage:render.html.twig")->display($context);
    }

    // line 282
    public function block_list_table($context, array $blocks = array())
    {
        // line 283
        echo "<h4><img class=\"icono\" src=";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/buscar-paciente.png"), "html", null, true);
        echo " />Buscar Registro de Identificación de  Pacientes</h4>
    <br/>
    <form id=\"buscarForm\" method=\"post\" >
        <table class=\"table table-bordered cuadro\">
            <tbody>
                <tr>
                    <td class=\"sonata-ba-list-field-header \"><strong>NEC</strong></td>
                    <td><input id=\"nec\" name=\"nec\" type=\"text\" class=\"fecha form-control\"  maxlength=\"15\" length='15'/></td>
                    <td class=\"sonata-ba-list-field-header \"><strong>Primer Apellido:*</strong></td>
                    <td><input id=\"primer_apellido\" name=\"primer_apellido\" class=\"nombres form-control\" type=\"text\"  maxlength=\"25\"/></td>
                    <td class=\"sonata-ba-list-field-header \"><strong>Segundo Apellido:</td>
                    <td><input id=\"segundo_apellido\" name=\"segundo_apellido\" class=\"nombres form-control\" type=\"text\"  maxlength=\"25\"/></td>
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
                    <td><input id=\"fecha_nacimiento\" name=\"fecha_nacimiento\" type=\"text\" class=\"fecha form-control bootstrap-datepicker now\" /></td>
                    <td class=\"sonata-ba-list-field-header\"><strong>Nombre de la Madre:</strong></td>
                    <td colspan=\"3\"><input id=\"nombre_madre\" name=\"nombre_madre\" class=\"nombresLargos form-control\" type=\"text\" maxlength=\"80\" /></td>
                </tr>
                <tr>
                    <td class=\"sonata-ba-list-field-header \"><strong>DUI: </strong></td>
                    <td><input id=\"dui\" name=\"dui\" type=\"text\" class=\"fecha form-control\" /></td>
                    <td class=\"sonata-ba-list-field-header \"><strong>Conocido por:</strong></td>
                    <td colspan=\"3\">
                        ";
        // line 315
        if (array_key_exists("procedencia", $context)) {
            // line 316
            echo "                            <input id=\"procedencia\" name=\"procedencia\" value=\"";
            echo twig_escape_filter($this->env, (isset($context["procedencia"]) ? $context["procedencia"] : $this->getContext($context, "procedencia")), "html", null, true);
            echo "\" type=\"hidden\"/>
                        ";
        } else {
            // line 318
            echo "                            <input id=\"procedencia\" name=\"procedencia\" value=\"c\" type=\"hidden\"/>
                        ";
        }
        // line 320
        echo "                        ";
        if (array_key_exists("origenCita", $context)) {
            // line 321
            echo "                            <input id=\"origenCita\" name=\"origenCita\" value=\"";
            echo twig_escape_filter($this->env, (isset($context["origenCita"]) ? $context["origenCita"] : $this->getContext($context, "origenCita")), "html", null, true);
            echo "\" type=\"hidden\"/>
                        ";
        }
        // line 323
        echo "                        <input id=\"conocido_por\" name=\"conocido_por\" type=\"text\"  class=\"nombresLargos form-control\"  maxlength=\"20\" />
                    </td>
                </tr>
                ";
        // line 326
        if ((array_key_exists("procedencia", $context) && ((isset($context["procedencia"]) ? $context["procedencia"] : $this->getContext($context, "procedencia")) == "citas"))) {
            // line 327
            echo "                    <tr>
                        <td class=\"sonata-ba-list-field-header \"><strong>Establecimiento de Referencia: </strong></td>
                        <td>
                            <input type=\"hidden\" id=\"idEstablecimientoReferencia\" name=\"idEstablecimientoReferencia\" style=\"width:203px !important;\"></input>
                        </td>
                        <td class=\"sonata-ba-list-field-header \"><strong>N&uacute;mero de Expediente de Referencia:</strong></td>
                        <td colspan=\"3\">
                            <input id=\"expedienteReferencia\" name=\"expedienteReferencia\" type=\"text\"  class=\"fecha form-control\"  maxlength=\"10\" />
                        </td>
                    </tr>
                ";
        }
        // line 338
        echo "                <tr>
                    <td colspan=\"6\" class=\"no-bottom-border\">
                        <div class=\"pull-right\">
                            ";
        // line 341
        if ((array_key_exists("procedencia", $context) && ((isset($context["procedencia"]) ? $context["procedencia"] : $this->getContext($context, "procedencia")) == "citas"))) {
            // line 342
            echo "                                <a id=\"capturar\" class=\"btn btn-info\" href=\"";
            echo $this->env->getExtension('routing')->getPath("admin_minsal_siaps_mntpaciente_pacientecitas");
            echo "\">
                            ";
        } else {
            // line 344
            echo "                                <a id=\"capturar\" class=\"btn btn-info\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create"), "method"), "html", null, true);
            echo "\">
                            ";
        }
        // line 346
        echo "                                <span class=\"glyphicon glyphicon-plus\"></span>
                                Capturar Datos
                            </a>

                            <button id=\"buscar\" class=\"btn btn-primary\" type=\"submit\">
                                <span class=\"glyphicon glyphicon-search\"></span>
                                Buscar
                            </button>

                            <a id=\"buscarGlobal\" class=\"btn btn-primary\" href=\"\">
                                <span class=\"glyphicon glyphicon-search\"></span>
                                Buscar Global
                            </a>
                            <a id=\"limpiar\" class=\"btn btn-primary\" href=\"\">
                                <span class=\"glyphicon glyphicon-trash\"></span>
                                Limpiar
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <div id=\"resultadoBusqueda\" style=\"min-height:150px;\"></div>
    <br><br>
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:MntPacienteAdmin:list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  396 => 321,  345 => 283,  476 => 315,  386 => 284,  364 => 273,  234 => 88,  595 => 193,  589 => 192,  586 => 191,  562 => 184,  556 => 182,  506 => 103,  498 => 78,  492 => 76,  473 => 165,  458 => 160,  399 => 143,  352 => 126,  346 => 125,  328 => 117,  880 => 288,  837 => 274,  827 => 270,  823 => 268,  821 => 267,  818 => 266,  789 => 251,  758 => 243,  667 => 218,  573 => 172,  567 => 170,  520 => 177,  481 => 167,  475 => 159,  472 => 158,  466 => 156,  441 => 346,  438 => 149,  432 => 301,  429 => 342,  395 => 287,  382 => 128,  378 => 281,  367 => 120,  357 => 118,  348 => 115,  334 => 110,  286 => 6,  205 => 115,  297 => 92,  218 => 81,  940 => 351,  932 => 346,  926 => 342,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 327,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 297,  808 => 296,  787 => 294,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 259,  740 => 239,  734 => 254,  731 => 253,  728 => 252,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 224,  628 => 214,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 228,  499 => 154,  488 => 172,  389 => 318,  223 => 46,  14 => 2,  306 => 95,  303 => 91,  300 => 248,  292 => 86,  280 => 87,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 216,  599 => 194,  580 => 194,  574 => 230,  559 => 183,  526 => 179,  497 => 173,  485 => 318,  463 => 117,  447 => 152,  404 => 290,  401 => 289,  391 => 76,  369 => 129,  333 => 132,  329 => 275,  307 => 242,  287 => 58,  195 => 54,  178 => 48,  956 => 271,  953 => 270,  946 => 302,  942 => 300,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 301,  820 => 243,  816 => 265,  807 => 259,  805 => 295,  802 => 235,  791 => 262,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 225,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 231,  647 => 230,  644 => 190,  632 => 187,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 224,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 307,  448 => 306,  424 => 98,  418 => 112,  410 => 113,  376 => 153,  373 => 102,  340 => 122,  326 => 256,  261 => 76,  118 => 39,  200 => 64,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 297,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 276,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 304,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 255,  796 => 254,  793 => 182,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 265,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 231,  710 => 149,  707 => 208,  699 => 142,  697 => 141,  696 => 204,  695 => 230,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 123,  649 => 122,  643 => 227,  640 => 226,  638 => 118,  617 => 112,  614 => 201,  598 => 107,  593 => 201,  576 => 101,  564 => 162,  557 => 209,  550 => 94,  527 => 91,  515 => 305,  512 => 84,  509 => 228,  503 => 81,  496 => 79,  493 => 155,  478 => 143,  467 => 312,  456 => 309,  450 => 114,  414 => 148,  408 => 91,  388 => 138,  371 => 72,  363 => 32,  350 => 26,  342 => 282,  335 => 279,  316 => 16,  290 => 110,  276 => 2,  266 => 83,  263 => 133,  255 => 95,  245 => 122,  207 => 93,  194 => 106,  184 => 55,  76 => 24,  810 => 238,  804 => 260,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 248,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 241,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 202,  685 => 227,  682 => 226,  672 => 223,  670 => 222,  665 => 196,  648 => 219,  627 => 206,  622 => 204,  619 => 212,  616 => 202,  613 => 210,  610 => 209,  608 => 197,  605 => 207,  596 => 106,  592 => 203,  587 => 197,  585 => 196,  582 => 190,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 198,  542 => 186,  533 => 186,  531 => 95,  507 => 165,  505 => 180,  502 => 175,  477 => 164,  471 => 164,  465 => 161,  454 => 308,  446 => 156,  443 => 155,  431 => 151,  428 => 100,  425 => 152,  422 => 338,  412 => 147,  406 => 111,  390 => 139,  383 => 316,  377 => 73,  375 => 124,  372 => 277,  370 => 121,  359 => 70,  356 => 269,  353 => 268,  349 => 119,  336 => 261,  332 => 259,  330 => 103,  318 => 105,  313 => 96,  291 => 80,  190 => 53,  321 => 254,  295 => 201,  274 => 87,  242 => 121,  236 => 81,  70 => 22,  170 => 85,  288 => 207,  284 => 192,  279 => 82,  275 => 227,  256 => 74,  250 => 73,  237 => 89,  232 => 136,  222 => 129,  191 => 88,  153 => 72,  150 => 84,  563 => 188,  560 => 187,  558 => 186,  553 => 184,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 173,  525 => 172,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  491 => 157,  487 => 156,  460 => 143,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 297,  415 => 121,  411 => 293,  405 => 118,  403 => 117,  380 => 107,  366 => 106,  354 => 101,  331 => 96,  325 => 94,  320 => 92,  317 => 91,  311 => 87,  308 => 86,  304 => 85,  272 => 81,  267 => 130,  249 => 78,  216 => 159,  155 => 35,  146 => 49,  126 => 87,  188 => 54,  181 => 51,  161 => 54,  110 => 58,  124 => 113,  692 => 399,  683 => 282,  678 => 279,  676 => 265,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 215,  641 => 189,  635 => 226,  631 => 218,  625 => 361,  615 => 354,  607 => 208,  597 => 177,  590 => 202,  583 => 287,  579 => 284,  577 => 188,  575 => 328,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 98,  529 => 191,  524 => 90,  516 => 294,  510 => 78,  504 => 90,  500 => 88,  495 => 158,  490 => 154,  486 => 165,  482 => 317,  470 => 313,  464 => 311,  459 => 116,  452 => 158,  434 => 302,  421 => 90,  417 => 296,  400 => 116,  385 => 129,  361 => 207,  344 => 113,  339 => 116,  324 => 179,  310 => 204,  302 => 93,  296 => 151,  282 => 106,  259 => 81,  244 => 83,  231 => 67,  226 => 69,  215 => 63,  186 => 51,  152 => 51,  114 => 80,  104 => 28,  358 => 103,  351 => 116,  347 => 266,  343 => 264,  338 => 280,  327 => 108,  323 => 255,  319 => 124,  315 => 98,  301 => 80,  299 => 202,  293 => 111,  289 => 82,  281 => 57,  277 => 88,  271 => 79,  265 => 100,  262 => 184,  260 => 128,  257 => 53,  251 => 182,  248 => 71,  239 => 120,  228 => 103,  225 => 65,  213 => 69,  211 => 156,  197 => 30,  174 => 59,  148 => 38,  134 => 35,  127 => 16,  20 => 1,  270 => 85,  253 => 78,  233 => 66,  212 => 158,  210 => 63,  206 => 109,  202 => 108,  198 => 54,  192 => 66,  185 => 104,  180 => 49,  175 => 47,  172 => 81,  167 => 44,  165 => 83,  160 => 88,  137 => 2,  113 => 53,  100 => 56,  90 => 30,  81 => 26,  65 => 20,  129 => 88,  97 => 92,  77 => 35,  34 => 3,  53 => 11,  84 => 22,  58 => 33,  23 => 3,  480 => 75,  474 => 150,  469 => 157,  461 => 70,  457 => 124,  453 => 151,  444 => 151,  440 => 304,  437 => 303,  435 => 344,  430 => 153,  427 => 341,  423 => 298,  413 => 241,  409 => 327,  407 => 326,  402 => 323,  398 => 115,  393 => 320,  387 => 110,  384 => 283,  381 => 315,  379 => 154,  374 => 36,  368 => 34,  365 => 119,  362 => 148,  360 => 271,  355 => 27,  341 => 263,  337 => 97,  322 => 93,  314 => 88,  312 => 97,  309 => 113,  305 => 101,  298 => 247,  294 => 100,  285 => 88,  283 => 5,  278 => 110,  268 => 101,  264 => 104,  258 => 75,  252 => 79,  247 => 72,  241 => 69,  229 => 86,  220 => 99,  214 => 58,  177 => 52,  169 => 44,  140 => 47,  132 => 84,  128 => 42,  107 => 29,  61 => 19,  273 => 190,  269 => 189,  254 => 126,  243 => 76,  240 => 72,  238 => 68,  235 => 67,  230 => 65,  227 => 116,  224 => 62,  221 => 61,  219 => 60,  217 => 86,  208 => 155,  204 => 61,  179 => 101,  159 => 40,  143 => 36,  135 => 37,  119 => 99,  102 => 28,  71 => 26,  67 => 25,  63 => 35,  59 => 57,  28 => 5,  94 => 25,  89 => 56,  85 => 43,  75 => 19,  68 => 21,  56 => 22,  87 => 55,  201 => 114,  196 => 112,  183 => 55,  171 => 63,  166 => 43,  163 => 42,  158 => 81,  156 => 75,  151 => 1,  142 => 89,  138 => 87,  136 => 45,  121 => 75,  117 => 81,  105 => 34,  91 => 29,  62 => 17,  49 => 12,  25 => 4,  21 => 2,  31 => 2,  38 => 7,  26 => 2,  24 => 3,  19 => 1,  93 => 31,  88 => 40,  78 => 25,  46 => 7,  44 => 9,  27 => 3,  79 => 28,  72 => 14,  69 => 23,  47 => 10,  40 => 6,  37 => 5,  22 => 14,  246 => 71,  157 => 94,  145 => 64,  139 => 46,  131 => 34,  123 => 86,  120 => 42,  115 => 12,  111 => 32,  108 => 54,  101 => 45,  98 => 55,  96 => 26,  83 => 26,  74 => 16,  66 => 21,  55 => 23,  52 => 9,  50 => 9,  43 => 6,  41 => 7,  35 => 6,  32 => 4,  29 => 3,  209 => 157,  203 => 56,  199 => 59,  193 => 57,  189 => 65,  187 => 104,  182 => 103,  176 => 85,  173 => 48,  168 => 50,  164 => 42,  162 => 52,  154 => 2,  149 => 34,  147 => 101,  144 => 100,  141 => 71,  133 => 28,  130 => 40,  125 => 78,  122 => 77,  116 => 54,  112 => 11,  109 => 10,  106 => 47,  103 => 49,  99 => 33,  95 => 46,  92 => 34,  86 => 29,  82 => 37,  80 => 21,  73 => 23,  64 => 12,  60 => 10,  57 => 17,  54 => 14,  51 => 9,  48 => 9,  45 => 8,  42 => 8,  39 => 4,  36 => 5,  33 => 6,  30 => 4,);
    }
}
