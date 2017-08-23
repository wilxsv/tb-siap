<?php

/* MinsalSiapsBundle:MntExpedienteAdmin:expedientes_creados.html.twig */
class __TwigTemplate_72a94268d06eb688bf98d0d3f9ec4f042b9f10d181ef32a5522cbad5a7b61d41 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 4
        echo "
";
        // line 5
        $this->displayBlock('javascripts', $context, $blocks);
        // line 35
        echo "<div class=\"row\">
  <div class=\"col-md-offset-3 col-md-6\">
      <h4>Lista de Expedientes</h4>
  </div>
  <div class=\"col-md-3\">
      <form id='reporteExpedientesForm' >
          <label>Exportar a:
              <a id=\"exportar_hoja_calculo\" class=\"img_export_inf\" href=\"\"><img src=";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/calc_icon.png"), "html", null, true);
        echo " /></a>
              <a id=\"exportar_pdf\" class=\"img_export_inf\" href=\"\"><img src=";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/pdf_icon.png"), "html", null, true);
        echo " /></a>
          </label>
      </form>
  </div>
</div>
<table id=\"tablaResultados\" class=\"table table-bordered table-hover\" data-table-enabled=\"true\">
    <thead>
        <tr>

            <th>Número de Expediente</th>
            <th>Nombre Completo Paciente</th>
            <th>Sexo</th>
            <th>Fecha de Nacimiento</th>
            ";
        // line 56
        if (((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")) == "eliminados")) {
            // line 57
            echo "                <th>Eliminó Expediente</th>
            ";
        } else {
            // line 59
            echo "                <th>Nombre de la Madre</th>
                <th>Creó Expediente</th>
            ";
        }
        // line 62
        echo "            ";
        if (((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")) == "eliminados")) {
            // line 63
            echo "                <th>Fecha de Eliminación</th>
            ";
        } else {
            // line 65
            echo "                <th>Fecha de Creación</th>
            ";
        }
        // line 67
        echo "            ";
        if (((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_USER_CONSULTAR"), "method") == "1") || ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method") == "1")) && ((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")) != "eliminados"))) {
            // line 68
            echo "                <th>Acciones</th>
            ";
        }
        // line 70
        echo "            ";
        if (((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")) != "eliminados")) {
            // line 71
            echo "                <th>Area Creación</th>
            ";
        }
        // line 73
        echo "        </tr>
    </thead>
    <tbody>
        ";
        // line 76
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pacientes"]) ? $context["pacientes"] : $this->getContext($context, "pacientes")));
        foreach ($context['_seq'] as $context["_key"] => $context["paciente"]) {
            // line 77
            echo "            <tr>
             <td >";
            // line 78
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "numero", array(), "array"), "html", null, true);
            echo "</td>
             <td>";
            // line 79
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "nombre_paciente", array(), "array"), "html", null, true);
            echo "</td>
             <td>";
            // line 80
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "sexo", array(), "array"), "html", null, true);
            echo "</td>
             <td>";
            // line 81
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "fecha_nacimiento", array(), "array"), "d/m/Y"), "html", null, true);
            echo "</td>
             ";
            // line 82
            if (((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")) == "eliminados")) {
                // line 83
                echo "                <td>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "actualizo_datos", array(), "array"), "html", null, true);
                echo "</td>
             ";
            } else {
                // line 85
                echo "                 <td>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "madre", array(), "array"), "html", null, true);
                echo "</td>
                 <td>";
                // line 86
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "tomo_datos", array(), "array"), "html", null, true);
                echo "</td>
            ";
            }
            // line 88
            echo "            ";
            if (((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")) == "eliminados")) {
                // line 89
                echo "               <td>";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "fecha_mod", array(), "array"), "d/m/Y"), "html", null, true);
                echo "</td>
            ";
            } else {
                // line 91
                echo "               <td>";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "fecha_creacion", array(), "array"), "d/m/Y"), "html", null, true);
                echo "</td>
           ";
            }
            // line 93
            echo "             ";
            if (((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_USER_CONSULTAR"), "method") == "1") || ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method") == "1")) && ((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")) != "eliminados"))) {
                // line 94
                echo "             <td>
                 <a target=\"_blank\" href=\"";
                // line 95
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_report_paciente", array("report_name" => "hoja_datos_paciente", "report_format" => "PDF", "paciente" => $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "id_paciente", array(), "array"))), "html", null, true);
                echo "\" class=\"btn btn-info\"><span class=\"fa fa-file-text\"></span>Hoja Identificación</a>
             </td>
             ";
            }
            // line 98
            echo "             ";
            if (((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")) != "eliminados")) {
                // line 99
                echo "                <td>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "area_creacion", array(), "array"), "html", null, true);
                echo "</td>
             ";
            }
            // line 101
            echo "          </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['paciente'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 103
        echo "        ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pacientesCun"]) ? $context["pacientesCun"] : $this->getContext($context, "pacientesCun")));
        foreach ($context['_seq'] as $context["_key"] => $context["paciente"]) {
            // line 104
            echo "            <tr>
             <td >";
            // line 105
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "numero", array(), "array"), "html", null, true);
            echo "</td>
             <td>";
            // line 106
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "nombre_paciente", array(), "array"), "html", null, true);
            echo "</td>
             <td>";
            // line 107
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "sexo", array(), "array"), "html", null, true);
            echo "</td>
             <td>";
            // line 108
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "fecha_nacimiento", array(), "array"), "d/m/Y"), "html", null, true);
            echo "</td>
             ";
            // line 109
            if (((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")) == "eliminados")) {
                // line 110
                echo "                <td>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "actualizo_datos", array(), "array"), "html", null, true);
                echo "</td>
             ";
            } else {
                // line 112
                echo "                 <td>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "madre", array(), "array"), "html", null, true);
                echo "</td>
                 <td>";
                // line 113
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "tomo_datos", array(), "array"), "html", null, true);
                echo "</td>
            ";
            }
            // line 115
            echo "            ";
            if (((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")) == "eliminados")) {
                // line 116
                echo "               <td>";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "fecha_mod", array(), "array"), "d/m/Y"), "html", null, true);
                echo "</td>
            ";
            } else {
                // line 118
                echo "               <td>";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "fecha_creacion", array(), "array"), "d/m/Y"), "html", null, true);
                echo "</td>
           ";
            }
            // line 120
            echo "             ";
            if (((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_USER_CONSULTAR"), "method") == "1") || ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method") == "1")) && ((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")) != "eliminados"))) {
                // line 121
                echo "             <td>
                 <a target=\"_blank\" href=\"";
                // line 122
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_report_paciente", array("report_name" => "hoja_datos_paciente", "report_format" => "PDF", "paciente" => $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "id_paciente", array(), "array"))), "html", null, true);
                echo "\" class=\"btn btn-info\"><span class=\"fa fa-file-text\"></span>Hoja Identificación</a>
             </td>
             ";
            }
            // line 125
            echo "             ";
            if (((isset($context["tipo"]) ? $context["tipo"] : $this->getContext($context, "tipo")) != "eliminados")) {
                // line 126
                echo "                <td>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["paciente"]) ? $context["paciente"] : $this->getContext($context, "paciente")), "area_creacion", array(), "array"), "html", null, true);
                echo "</td>
             ";
            }
            // line 128
            echo "          </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['paciente'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 130
        echo "    </tbody>
</table>
";
    }

    // line 1
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 2
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/MntExpediente/list.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 5
    public function block_javascripts($context, array $blocks = array())
    {
        // line 6
        echo "    <script type=\"text/javascript\">
        jQuery(document).ready(function (\$) {
            var tablaResultados=\$('#tablaResultados');
            var opcionesTable=setDataTableOptions(tablaResultados);
            opcionesTable['bSort']=false;
            opcionesTable['iDisplayLength']=15;
            opcionesTable['bFilter']=false;
            opcionesTable['sDom']='<\"top\"flp>rt<\"bottom\"i>';
            opcionesTable['aLengthMenu']= [[15,25, 50, 75, -1], [15,25, 50, 75, \"Todos\"]];
            tablaResultados.DataTable(opcionesTable);

            //para exportar reportes
                \$('#exportar_hoja_calculo').click(function() {
                        url = Routing.generate('_exportar_reporte',{'report_name':'expedientes_creados','report_format':'XLS','datos':\$('#expedientes_creados').serialize()});
                        window.open(url, '_blank');
                        return false;
                });

                \$('#exportar_pdf').click(function() {
                    url = Routing.generate('_exportar_reporte',{'report_name':'expedientes_creados','report_format':'PDF','datos':\$('#expedientes_creados').serialize()});
                        window.open(url, '_blank');
                        return false;
                });

                \$('#resultado').waitMe('hide');

        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "MinsalSiapsBundle:MntExpedienteAdmin:expedientes_creados.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  234 => 88,  595 => 193,  589 => 192,  586 => 191,  562 => 184,  556 => 182,  506 => 103,  498 => 78,  492 => 76,  473 => 165,  458 => 160,  399 => 143,  352 => 126,  346 => 125,  328 => 117,  880 => 288,  837 => 274,  827 => 270,  823 => 268,  821 => 267,  818 => 266,  789 => 251,  758 => 243,  667 => 218,  573 => 172,  567 => 170,  520 => 177,  481 => 167,  475 => 159,  472 => 158,  466 => 156,  441 => 156,  438 => 149,  432 => 147,  429 => 146,  395 => 132,  382 => 128,  378 => 132,  367 => 120,  357 => 118,  348 => 115,  334 => 110,  286 => 6,  205 => 59,  297 => 92,  218 => 81,  940 => 351,  932 => 346,  926 => 342,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 327,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 297,  808 => 296,  787 => 294,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 259,  740 => 239,  734 => 254,  731 => 253,  728 => 252,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 224,  628 => 214,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 228,  499 => 154,  488 => 172,  389 => 75,  223 => 46,  14 => 2,  306 => 95,  303 => 91,  300 => 112,  292 => 86,  280 => 87,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 216,  599 => 194,  580 => 194,  574 => 230,  559 => 183,  526 => 179,  497 => 173,  485 => 124,  463 => 117,  447 => 152,  404 => 135,  401 => 144,  391 => 76,  369 => 129,  333 => 132,  329 => 65,  307 => 82,  287 => 58,  195 => 54,  178 => 46,  956 => 271,  953 => 270,  946 => 302,  942 => 300,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 301,  820 => 243,  816 => 265,  807 => 259,  805 => 295,  802 => 235,  791 => 262,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 225,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 231,  647 => 230,  644 => 190,  632 => 187,  629 => 186,  626 => 221,  603 => 179,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 224,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 120,  448 => 121,  424 => 98,  418 => 112,  410 => 113,  376 => 153,  373 => 102,  340 => 122,  326 => 129,  261 => 76,  118 => 56,  200 => 64,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 306,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 293,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 285,  1036 => 284,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 280,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 255,  961 => 254,  958 => 253,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 297,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 276,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 304,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 255,  796 => 254,  793 => 182,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 265,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 231,  710 => 149,  707 => 208,  699 => 142,  697 => 141,  696 => 204,  695 => 230,  694 => 138,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 123,  649 => 122,  643 => 227,  640 => 226,  638 => 118,  617 => 112,  614 => 201,  598 => 107,  593 => 201,  576 => 101,  564 => 162,  557 => 209,  550 => 94,  527 => 91,  515 => 305,  512 => 84,  509 => 228,  503 => 81,  496 => 79,  493 => 155,  478 => 143,  467 => 72,  456 => 154,  450 => 114,  414 => 148,  408 => 91,  388 => 138,  371 => 72,  363 => 32,  350 => 26,  342 => 123,  335 => 66,  316 => 16,  290 => 110,  276 => 2,  266 => 83,  263 => 133,  255 => 95,  245 => 122,  207 => 93,  194 => 106,  184 => 55,  76 => 70,  810 => 238,  804 => 260,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 248,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 241,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 202,  685 => 227,  682 => 226,  672 => 223,  670 => 222,  665 => 196,  648 => 219,  627 => 206,  622 => 204,  619 => 212,  616 => 202,  613 => 210,  610 => 209,  608 => 197,  605 => 207,  596 => 106,  592 => 203,  587 => 197,  585 => 196,  582 => 190,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 198,  542 => 186,  533 => 186,  531 => 95,  507 => 165,  505 => 180,  502 => 175,  477 => 164,  471 => 164,  465 => 161,  454 => 121,  446 => 156,  443 => 155,  431 => 151,  428 => 100,  425 => 152,  422 => 150,  412 => 147,  406 => 111,  390 => 139,  383 => 135,  377 => 73,  375 => 124,  372 => 122,  370 => 121,  359 => 70,  356 => 127,  353 => 69,  349 => 119,  336 => 115,  332 => 88,  330 => 103,  318 => 105,  313 => 96,  291 => 80,  190 => 105,  321 => 100,  295 => 87,  274 => 87,  242 => 121,  236 => 81,  70 => 81,  170 => 57,  288 => 79,  284 => 76,  279 => 82,  275 => 56,  256 => 74,  250 => 126,  237 => 89,  232 => 72,  222 => 67,  191 => 88,  153 => 72,  150 => 34,  563 => 188,  560 => 187,  558 => 186,  553 => 184,  549 => 182,  543 => 179,  537 => 176,  532 => 174,  528 => 173,  525 => 172,  523 => 171,  518 => 170,  514 => 168,  511 => 167,  508 => 165,  501 => 161,  491 => 157,  487 => 156,  460 => 143,  455 => 141,  449 => 138,  442 => 134,  439 => 133,  436 => 132,  433 => 130,  426 => 126,  420 => 123,  415 => 121,  411 => 120,  405 => 118,  403 => 117,  380 => 107,  366 => 106,  354 => 101,  331 => 96,  325 => 94,  320 => 92,  317 => 91,  311 => 87,  308 => 86,  304 => 85,  272 => 81,  267 => 130,  249 => 78,  216 => 65,  155 => 35,  146 => 49,  126 => 38,  188 => 54,  181 => 51,  161 => 54,  110 => 58,  124 => 113,  692 => 399,  683 => 282,  678 => 279,  676 => 265,  666 => 126,  661 => 380,  656 => 378,  652 => 376,  645 => 215,  641 => 189,  635 => 226,  631 => 218,  625 => 361,  615 => 354,  607 => 208,  597 => 177,  590 => 202,  583 => 287,  579 => 284,  577 => 188,  575 => 328,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 98,  529 => 191,  524 => 90,  516 => 294,  510 => 78,  504 => 90,  500 => 88,  495 => 158,  490 => 154,  486 => 165,  482 => 145,  470 => 121,  464 => 125,  459 => 116,  452 => 158,  434 => 118,  421 => 90,  417 => 142,  400 => 116,  385 => 129,  361 => 207,  344 => 113,  339 => 116,  324 => 179,  310 => 103,  302 => 93,  296 => 151,  282 => 106,  259 => 81,  244 => 83,  231 => 67,  226 => 69,  215 => 63,  186 => 64,  152 => 51,  114 => 80,  104 => 28,  358 => 103,  351 => 116,  347 => 68,  343 => 92,  338 => 130,  327 => 108,  323 => 114,  319 => 124,  315 => 98,  301 => 80,  299 => 89,  293 => 111,  289 => 82,  281 => 57,  277 => 88,  271 => 79,  265 => 100,  262 => 81,  260 => 128,  257 => 53,  251 => 125,  248 => 71,  239 => 120,  228 => 103,  225 => 65,  213 => 69,  211 => 69,  197 => 30,  174 => 59,  148 => 91,  134 => 86,  127 => 40,  20 => 1,  270 => 85,  253 => 78,  233 => 118,  212 => 62,  210 => 63,  206 => 109,  202 => 108,  198 => 107,  192 => 66,  185 => 53,  180 => 115,  175 => 101,  172 => 81,  167 => 44,  165 => 46,  160 => 95,  137 => 2,  113 => 80,  100 => 26,  90 => 37,  81 => 30,  65 => 22,  129 => 85,  97 => 92,  77 => 83,  34 => 4,  53 => 11,  84 => 19,  58 => 10,  23 => 4,  480 => 75,  474 => 150,  469 => 157,  461 => 70,  457 => 124,  453 => 151,  444 => 151,  440 => 154,  437 => 61,  435 => 148,  430 => 153,  427 => 143,  423 => 144,  413 => 241,  409 => 146,  407 => 136,  402 => 107,  398 => 115,  393 => 112,  387 => 110,  384 => 109,  381 => 157,  379 => 154,  374 => 36,  368 => 34,  365 => 119,  362 => 148,  360 => 104,  355 => 27,  341 => 67,  337 => 97,  322 => 93,  314 => 88,  312 => 97,  309 => 113,  305 => 101,  298 => 91,  294 => 100,  285 => 88,  283 => 5,  278 => 110,  268 => 101,  264 => 104,  258 => 75,  252 => 79,  247 => 75,  241 => 75,  229 => 86,  220 => 99,  214 => 112,  177 => 52,  169 => 99,  140 => 47,  132 => 117,  128 => 101,  107 => 29,  61 => 13,  273 => 1,  269 => 88,  254 => 126,  243 => 76,  240 => 72,  238 => 68,  235 => 73,  230 => 62,  227 => 116,  224 => 115,  221 => 82,  219 => 113,  217 => 86,  208 => 110,  204 => 61,  179 => 60,  159 => 50,  143 => 52,  135 => 37,  119 => 99,  102 => 77,  71 => 63,  67 => 14,  63 => 59,  59 => 57,  28 => 35,  94 => 23,  89 => 71,  85 => 20,  75 => 65,  68 => 62,  56 => 12,  87 => 22,  201 => 60,  196 => 58,  183 => 55,  171 => 63,  166 => 98,  163 => 42,  158 => 50,  156 => 75,  151 => 47,  142 => 89,  138 => 47,  136 => 29,  121 => 82,  117 => 81,  105 => 78,  91 => 23,  62 => 20,  49 => 20,  25 => 3,  21 => 1,  31 => 3,  38 => 67,  26 => 5,  24 => 3,  19 => 1,  93 => 73,  88 => 20,  78 => 18,  46 => 7,  44 => 10,  27 => 4,  79 => 67,  72 => 23,  69 => 23,  47 => 11,  40 => 7,  37 => 42,  22 => 53,  246 => 71,  157 => 94,  145 => 46,  139 => 88,  131 => 46,  123 => 83,  120 => 42,  115 => 70,  111 => 32,  108 => 54,  101 => 93,  98 => 76,  96 => 31,  83 => 26,  74 => 16,  66 => 15,  55 => 9,  52 => 72,  50 => 8,  43 => 6,  41 => 43,  35 => 6,  32 => 3,  29 => 2,  209 => 58,  203 => 32,  199 => 59,  193 => 57,  189 => 65,  187 => 104,  182 => 103,  176 => 85,  173 => 48,  168 => 50,  164 => 53,  162 => 52,  154 => 93,  149 => 34,  147 => 101,  144 => 100,  141 => 32,  133 => 28,  130 => 40,  125 => 40,  122 => 100,  116 => 58,  112 => 69,  109 => 79,  106 => 28,  103 => 27,  99 => 24,  95 => 24,  92 => 22,  86 => 70,  82 => 68,  80 => 24,  73 => 82,  64 => 26,  60 => 25,  57 => 56,  54 => 73,  51 => 8,  48 => 9,  45 => 8,  42 => 68,  39 => 5,  36 => 3,  33 => 6,  30 => 5,);
    }
}
