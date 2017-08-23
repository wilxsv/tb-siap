<?php

/* MinsalSeguimientoBundle:SecHistorialClinico:consultar_historial.html.twig */
class __TwigTemplate_0d5ec9162cd60c37e2828bec39cdaeb8321bf3d853c421e9e0db18702a2ea4a2 extends Twig_Template
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
        // line 2
        $context["url_parameters"] = array("_external" => "true", "_modulo" => "seguimiento_clinico", "tipoPacPertenencia" => "local");
        // line 3
        echo "

";
        // line 5
        if (($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : null), "idEmpleado", array(), "any", true, true) && (!($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEmpleado") === "")))) {
            // line 6
            echo "    ";
            $context["url_parameters"] = twig_array_merge((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")), array("idEmpleado" => $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEmpleado")));
        }
        // line 8
        echo "
";
        // line 9
        if (($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : null), "idEspecialidad", array(), "any", true, true) && (!($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEspecialidad") === "")))) {
            // line 10
            echo "    ";
            $context["url_parameters"] = twig_array_merge((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")), array("idEspecialidad" => $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idEspecialidad")));
        }
        // line 12
        echo "
";
        // line 13
        if (($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : null), "idHistorialClinico", array(), "any", true, true) && (!($this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idHistorialClinico") === "")))) {
            // line 14
            echo "    ";
            $context["url_parameters"] = twig_array_merge((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")), array("idHistorialClinico" => $this->getAttribute((isset($context["parameters"]) ? $context["parameters"] : $this->getContext($context, "parameters")), "idHistorialClinico")));
        }
        // line 17
        echo "<script type=\"text/javascript\">
    jQuery(document).ready(function (\$) {
        var idEspecialidadConsulta = \$('select[id\$=\"_idEspecialidad\"]');

        initSelect2(idEspecialidadConsulta, false, true, ";
        // line 21
        if ((twig_length_filter($this->env, (isset($context["idEspecialidad"]) ? $context["idEspecialidad"] : $this->getContext($context, "idEspecialidad"))) > 0)) {
            echo "'Seleccione Especialidad...'";
        } else {
            echo "'El Paciente aun no posee Historias Clinicas'";
        }
        echo ", true);

        \$('#antecedente').on('click', function() {
            if (idEspecialidadConsulta.val()) {
                var postDataIdPaciente = ";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getId", array(), "method"), "html", null, true);
        echo ";
                var postDataAreaModEstab = idEspecialidadConsulta.val();

                \$.ajax({
                    url: Routing.generate('sec_antecedentes_leer') + '/' + postDataIdPaciente + '/' + postDataAreaModEstab,
                    type: \"POST\",
                    dataType: 'json',
                    success: function (msg) {
                        if (msg.idantecedente == 0) {
                            showDialogMsg('Informacion','Este paciente aun no tiene antecedentes');
                        } else {
                            var parameters = ";
        // line 36
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                            var winParams = [];

                            if (msg.idantecedente){
                                parameters['id'] = msg.idantecedente;
                                winParams['method'] = \"post\";
                                //winParams['action'] = \"";
        // line 42
        echo "\";
                                winParams['action'] = Routing.generate('sec_antecedentes_show',{'id':msg.idantecedente, 'idatenareamodestab':postDataAreaModEstab});
                                winParams['target'] = \"Antecedente de Paciente\";
                                winParams['parameters'] = parameters;
                                openPostPopUpWindows(winParams);
                            }
                        }

                    }
                });
            } else {
                showDialogMsg('Seleccione Especialidad!','Seleccione la Especialidad','dialog-error', 'Cerrar');
            }
        });
    });


    jQuery(document).ready(function(\$) {
        var especialidadConsulta = \$('select[id\$=\"_idEspecialidad\"]');
        var idExpediente = ";
        // line 61
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getId", array(), "method"), "html", null, true);
        echo " ;

        \$('#verHistorialClinico').on('click', function() {
            if( especialidadConsulta.select2('val') ){
                var parameters = ";
        // line 65
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";
                var winParams  = [];

                parameters['idExpedienteHclinica'] = idExpediente;
                parameters['idEspecialidadHclinica']  = especialidadConsulta.select2('val');
                parameters['external']  = 'true';

                var filter = { filter : {
                                       idAtenAreaModEstab : { type : null, value : especialidadConsulta.select2('val') },
                                       idExpediente       : { type : null, value : idExpediente }
                                     }
                           };

                //  jQuery.param(filter) <-----Simula la aplicacion de filtros por un usuario
                //  alert(jQuery.param(filter));
                //  var filterArray = (jQuery.param(filter)).split('&');
                //  for ( var filterx in filterArray ){
                //      alert((filterArray[filterx]).split('=')[0]);
                //      alert((filterArray[filterx]).split('=')[1]);
                //      parameters[ (filterArray[filterx]).split('=')[0] ] = (filterArray[filterx]).split('=')[1];
                //  }

                winParams['method'] = \"post\";
                //winParams['action'] = \"";
        // line 88
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_historias_clinicas_pre_show");
        echo "\";
                winParams['action'] = \"";
        // line 89
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_list");
        echo "\";
                //winParams['action'] = Routing.generate('admin_minsal_seguimiento_sechistorialclinico_historias_clinicas_pre_show');
                winParams['target'] = \"Historias Clinicas del Paciente\";
                winParams['parameters'] = parameters;
                openPostPopUpWindows(winParams);
            } else {
                showDialogMsg('Seleccione Especialidad!','<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span> Seleccione la Especialidad deseada para consultar el Historial Clinico del Paciente.','dialog-error', 'Cerrar');
            }
        });

        \$('#verHistorialLaboratorio').on('click', function() {
            var parameters = ";
        // line 100
        echo twig_jsonencode_filter((isset($context["url_parameters"]) ? $context["url_parameters"] : $this->getContext($context, "url_parameters")));
        echo ";

            if( especialidadConsulta.select2('val') ){
                parameters['idEspecialidadHclinica'] = especialidadConsulta.select2('val');
            }

            parameters['useProxy'] = 'true';
            parameters['idExpediente'] = '";
        // line 107
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getId", array(), "method"), "html", null, true);
        echo "';

            var winParams = [];

            winParams['method'] = \"post\";
            winParams['action'] = \"";
        // line 112
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_laboratorio_secsolicitudestudios_list");
        echo "\";
            winParams['target'] = \"Historial de Solicitud de Estudio de Laboratorio Clinico\";
            winParams['parameters'] = parameters;

            openPostPopUpWindows(winParams);
        });
    });

    /**  Funcion que inicializa los select a Select2  **/
    function initSelect2(element, removeChildren, prepend, placeholder, allowClear) {
        if (removeChildren) {
            element.children().remove();
        }

        if (prepend) {
            element.prepend('<option/>').val(function () {
                return \$('[selected]', this).val();
            });
        }

        element.select2({
            placeholder: placeholder,
            allowClear: allowClear
        });
    };
</script>

<table class=\"vista_paciente\" border=\"0\" width=\"100%\">
    <tr class=\"titulo_vista\">
        <td colspan=\"4\"><b>Consultar Historial Clinico de Paciente</b></td>
    </tr>
    <tr>
        <td><label>Seleccione Especialidad:</label> </td>
        <td><div align=\"center\">
                ";
        // line 146
        if (array_key_exists("idEspecialidad", $context)) {
            // line 147
            echo "                    <select id=\"_idEspecialidad\" class=\"full-width\">
                        ";
            // line 148
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["idEspecialidad"]) ? $context["idEspecialidad"] : $this->getContext($context, "idEspecialidad")));
            foreach ($context['_seq'] as $context["_key"] => $context["espec"]) {
                // line 149
                echo "                            <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["espec"]) ? $context["espec"] : $this->getContext($context, "espec")), "id"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["espec"]) ? $context["espec"] : $this->getContext($context, "espec")), "getNombreConsulta", array(), "method"), "html", null, true);
                echo "</option>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['espec'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 151
            echo "                    </select>
                ";
        }
        // line 153
        echo "            </div>
        </td>
        <td colspan=\"2\">
            <div class=\"row\" style=\"margin-left: 0; margin-right: 0;\">
                <div class=\"col-md-3\" style=\"margin-top: 5px;\" align=\"center\">
                    <a href=\"#\" id=\"antecedente\" class=\"btn btn-app btn-group\" style=\"min-height: 72px;\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ver Antecedentes M&eacute;dicos del Paciente\">
                        <i class=\"fa fa-file-text\"></i>Ver Antecedentes
                    </a>
                </div>
                <div class=\"col-md-3\" style=\"margin-top: 5px;\" align=\"center\">
                    <a href=\"#\" id=\"verHistorialClinico\" class=\"btn btn-app btn-group\" style=\"min-height: 72px;\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ver Historias Cl&iacute;nicas del Paciente\">
                        <i class=\"fa fa-archive\"></i>Ver Historial Cl&iacute;nico
                    </a>
                </div>
                <div class=\"col-md-3\" style=\"margin-top: 5px;\" align=\"center\">
                    <a href=\"#\" id=\"verFichaFamiliar\" class=\"btn btn-app btn-group\" style=\"min-height: 72px;\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ver Ficha Familiar Asociada al Paciente\">
                        <i class=\"fa fa-users\"></i>Ver Ficha Familiar
                    </a>
                </div>
                <div class=\"col-md-3\" style=\"margin-top: 5px;\" align=\"center\">
                    <a href=\"#\" id=\"verHistorialLaboratorio\" class=\"btn btn-app btn-group\" style=\"min-height: 72px;\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ver Historial de &Eacute;xamenes de Laboratorio del Paciente\">
                        <i class=\"fa fa-flask\"></i>Historial <br/>de Laboratorio
                    </a>
                </div>
            </div>
        </td>
    </tr>
</table>
";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecHistorialClinico:consultar_historial.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  218 => 147,  117 => 65,  49 => 17,  27 => 6,  25 => 5,  21 => 3,  19 => 2,  32 => 12,  22 => 4,  30 => 4,  85 => 26,  83 => 34,  73 => 26,  63 => 14,  50 => 11,  28 => 3,  82 => 29,  57 => 23,  53 => 12,  36 => 10,  26 => 2,  20 => 1,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 250,  947 => 249,  939 => 243,  936 => 242,  934 => 241,  931 => 240,  923 => 236,  920 => 235,  918 => 234,  915 => 233,  903 => 229,  900 => 228,  897 => 227,  894 => 226,  892 => 225,  889 => 224,  881 => 220,  878 => 219,  876 => 218,  873 => 217,  865 => 213,  862 => 212,  860 => 211,  857 => 210,  849 => 206,  846 => 205,  844 => 204,  841 => 203,  833 => 199,  830 => 198,  828 => 197,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 184,  796 => 183,  793 => 182,  785 => 178,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 164,  751 => 163,  739 => 156,  729 => 155,  724 => 154,  721 => 153,  712 => 150,  710 => 149,  707 => 148,  699 => 142,  697 => 141,  696 => 140,  695 => 139,  694 => 138,  689 => 137,  683 => 135,  680 => 134,  678 => 133,  675 => 132,  666 => 126,  662 => 125,  658 => 124,  654 => 123,  649 => 122,  643 => 120,  640 => 119,  638 => 118,  635 => 117,  617 => 112,  614 => 111,  598 => 107,  576 => 101,  557 => 96,  529 => 92,  527 => 91,  524 => 90,  515 => 85,  512 => 84,  509 => 83,  501 => 80,  496 => 79,  493 => 78,  490 => 77,  478 => 74,  470 => 73,  467 => 72,  464 => 71,  433 => 60,  426 => 58,  423 => 57,  414 => 52,  408 => 50,  405 => 49,  403 => 48,  388 => 42,  385 => 41,  374 => 36,  371 => 35,  366 => 33,  363 => 32,  355 => 27,  350 => 26,  344 => 24,  342 => 23,  337 => 22,  335 => 21,  316 => 16,  311 => 14,  308 => 13,  299 => 8,  293 => 6,  290 => 5,  285 => 3,  281 => 409,  278 => 408,  276 => 393,  273 => 392,  271 => 374,  268 => 373,  263 => 365,  258 => 354,  255 => 353,  253 => 342,  245 => 335,  243 => 327,  240 => 153,  227 => 301,  225 => 149,  220 => 290,  215 => 280,  210 => 270,  207 => 269,  204 => 267,  202 => 266,  199 => 265,  194 => 248,  191 => 246,  189 => 240,  181 => 232,  179 => 112,  174 => 217,  171 => 107,  161 => 100,  149 => 182,  146 => 181,  129 => 65,  126 => 147,  124 => 132,  114 => 111,  111 => 110,  106 => 104,  101 => 89,  99 => 2,  89 => 42,  81 => 40,  79 => 23,  69 => 27,  66 => 25,  61 => 17,  810 => 263,  804 => 260,  801 => 185,  799 => 258,  795 => 256,  792 => 255,  780 => 176,  777 => 253,  774 => 252,  771 => 251,  768 => 250,  766 => 249,  761 => 247,  749 => 162,  746 => 161,  743 => 243,  735 => 238,  732 => 237,  715 => 151,  698 => 234,  693 => 232,  688 => 231,  685 => 230,  682 => 229,  676 => 225,  672 => 223,  670 => 222,  665 => 221,  648 => 219,  631 => 218,  627 => 217,  622 => 216,  619 => 113,  610 => 212,  608 => 211,  605 => 210,  596 => 106,  592 => 203,  590 => 202,  587 => 201,  585 => 200,  582 => 199,  578 => 178,  572 => 176,  566 => 174,  563 => 173,  560 => 172,  547 => 93,  542 => 190,  536 => 187,  533 => 186,  531 => 185,  528 => 184,  525 => 183,  505 => 180,  502 => 179,  500 => 172,  491 => 171,  486 => 168,  480 => 75,  471 => 162,  465 => 161,  461 => 70,  454 => 159,  449 => 157,  446 => 156,  443 => 155,  434 => 152,  431 => 151,  428 => 59,  425 => 149,  422 => 148,  412 => 142,  406 => 140,  400 => 47,  398 => 137,  393 => 136,  390 => 43,  383 => 132,  380 => 130,  377 => 37,  372 => 126,  356 => 122,  353 => 121,  349 => 119,  339 => 116,  336 => 115,  332 => 20,  330 => 113,  323 => 111,  318 => 110,  313 => 15,  310 => 107,  304 => 103,  294 => 100,  288 => 4,  284 => 97,  279 => 96,  264 => 90,  249 => 89,  244 => 88,  238 => 312,  232 => 82,  228 => 80,  222 => 297,  217 => 289,  201 => 74,  193 => 69,  188 => 66,  183 => 64,  167 => 63,  162 => 61,  156 => 195,  154 => 189,  151 => 188,  145 => 55,  142 => 54,  139 => 169,  125 => 48,  122 => 46,  119 => 117,  116 => 116,  113 => 43,  107 => 27,  105 => 40,  90 => 33,  87 => 35,  77 => 31,  74 => 20,  71 => 19,  55 => 21,  48 => 10,  45 => 14,  40 => 12,  327 => 112,  321 => 152,  315 => 109,  312 => 149,  309 => 148,  301 => 144,  289 => 140,  277 => 95,  274 => 94,  272 => 134,  269 => 91,  265 => 130,  236 => 151,  209 => 96,  197 => 249,  187 => 87,  185 => 86,  182 => 85,  176 => 223,  170 => 79,  165 => 62,  160 => 76,  158 => 75,  153 => 72,  147 => 89,  144 => 176,  141 => 175,  138 => 61,  136 => 168,  132 => 59,  128 => 49,  123 => 57,  120 => 56,  110 => 61,  104 => 90,  98 => 25,  92 => 45,  86 => 30,  78 => 20,  70 => 20,  59 => 16,  54 => 12,  43 => 13,  38 => 15,  35 => 5,  250 => 341,  247 => 72,  241 => 87,  235 => 311,  233 => 304,  230 => 303,  224 => 103,  221 => 148,  219 => 76,  214 => 99,  203 => 93,  198 => 54,  190 => 67,  186 => 239,  180 => 49,  178 => 48,  175 => 47,  169 => 210,  166 => 209,  164 => 203,  159 => 196,  143 => 88,  134 => 161,  131 => 160,  127 => 16,  121 => 131,  115 => 12,  112 => 52,  109 => 50,  102 => 39,  96 => 1,  94 => 24,  91 => 23,  75 => 19,  65 => 26,  62 => 21,  51 => 22,  46 => 11,  37 => 5,  31 => 8,  624 => 282,  621 => 281,  616 => 214,  613 => 213,  609 => 273,  593 => 105,  589 => 267,  583 => 266,  580 => 265,  574 => 263,  571 => 262,  568 => 261,  564 => 99,  561 => 259,  555 => 95,  553 => 194,  550 => 94,  545 => 191,  540 => 252,  538 => 251,  530 => 248,  520 => 247,  516 => 245,  513 => 244,  511 => 243,  507 => 181,  503 => 81,  495 => 233,  477 => 164,  474 => 163,  469 => 228,  466 => 227,  459 => 69,  456 => 68,  452 => 158,  450 => 64,  445 => 279,  442 => 62,  440 => 154,  437 => 61,  435 => 231,  432 => 230,  430 => 227,  427 => 226,  421 => 223,  418 => 222,  416 => 221,  413 => 220,  409 => 141,  394 => 217,  391 => 216,  387 => 134,  384 => 214,  378 => 211,  375 => 127,  373 => 209,  370 => 125,  368 => 34,  362 => 124,  359 => 123,  314 => 162,  303 => 159,  295 => 142,  291 => 99,  287 => 152,  283 => 138,  270 => 150,  266 => 366,  260 => 363,  248 => 336,  242 => 113,  229 => 135,  216 => 146,  212 => 279,  208 => 132,  200 => 127,  196 => 71,  192 => 88,  184 => 233,  157 => 93,  155 => 92,  148 => 56,  100 => 38,  97 => 37,  93 => 39,  88 => 27,  84 => 41,  80 => 36,  76 => 22,  72 => 37,  67 => 19,  64 => 18,  60 => 10,  58 => 20,  42 => 10,  39 => 6,  34 => 9,);
    }
}
