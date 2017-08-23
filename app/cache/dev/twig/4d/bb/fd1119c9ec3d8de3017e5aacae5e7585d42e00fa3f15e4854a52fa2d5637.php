<?php

/* MinsalSeguimientoBundle:Reportes/Vigepes:reporte_vigepes01.html.twig */
class __TwigTemplate_4dbbfd1119c9ec3d8de3017e5aacae5e7585d42e00fa3f15e4854a52fa2d5637 extends Twig_Template
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
        echo "<html>
    <head>
        <META HTTP-EQUIV=\"Content-Style-Type\" CONTENT=\"text/css\">
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        ";
        // line 5
        $this->env->loadTemplate("MinsalSiapsBundle::standard_css_reportes.html.twig")->display($context);
        // line 6
        echo "        <link href=\"";
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/MntPacienteAdmin/encabezado_paciente.css")), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\">
        <style type=\"text/css\">
            html,body {overflow: visible !important; color: black !important; border-style: none !important; border-color:black !important;font-size: 12px!important;}
            div .table-responsive {overflow: visible !important; border-style: none !important}

            .panel{ margin: 8px;}
            .panel-info > .panel-heading,.titulo_vista {
                background-color: white;
                font-size: 12px;
                border-color: black;
                color: black;
                font-weight: bold;
                border-style: none !important;
                padding: 2px 5px;
            }
            table{font-size: 10px!important;}
            .panel-body, .vista_paciente{font-size: 10px; border-style: none !important;}
            td,th {padding: 5px 10px;}
            .panel-info{border-color:black}
            table {width: 100%}

        </style>
    </head>
    <body >
        <div>             
            <div class=\"table-responsive\" style=\"overflow-x: auto; border:0px; \">
                <table  style=\"font-size: 10px;border:0px;\">
                    <tbody>
                        <tr>
                            <td><img src=\"";
        // line 35
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/Reporte-Escudo.png")), "html", null, true);
        echo "\" style=\"width: 50px;\"/></td>
                            <td  width=\"500px\">
                                <b>
                                <center>MINISTERIO DE SALUD <br/>
                                    SISTEMA NACIONAL DE SALUD/COMISION INTERSECTORIAL DE SALUD (CISALUD)<br/>
                                    FORMULARIO PARA NOTIFICACION INDIVIDUAL DE ENFERMEDADES OBJETO DE VIGILANCIA SANITARIA (VIGEPES-01)<br/>
                                </b>
                                </center>
                            </td>
                            <td ><img src=\"";
        // line 44
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/minsal_2014.png")), "html", null, true);
        echo "\" style=\"width: 120px;float:right;\"/></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <table class=\"\" border = \"0\">
                <tbody>
                    <tr>
                        <td> <strong>Nombre del Establecimiento</strong></td>
                        <td colspan=\"2\">";
        // line 53
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento", array(), "method")), "html", null, true);
        echo " </td>
                        <td><strong>Fecha de Consulta: </strong>";
        // line 54
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "fechaconsulta"), "d-m-Y"), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <td><strong>No. Expediente/No. de Afiliación:</strong></td>
                        <td>";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "numero"), "html", null, true);
        echo "</td>
                        <td><strong>Categoría de Afiliación:</strong></td>
                        <td> ";
        // line 60
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAreaCotizacion")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAreaCotizacion")) : ("-")), "html", null, true);
        echo " </td>
                    </tr>
                    <tr>
                        <td><strong>No. DUI:</strong></td>
                        <td>";
        // line 64
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idDocPaciente"), "id") == 1)) {
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "numeroDocIdePaciente"), "html", null, true);
            echo " ";
        } else {
            echo " - ";
        }
        echo "</td>
                        <td><strong>Fecha de nacimiento</strong>: ";
        // line 65
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "fechaNacimiento"), "d/m/Y"), "html", null, true);
        echo "</td>
                        <td><strong>Edad: </strong>";
        // line 66
        echo twig_escape_filter($this->env, (isset($context["edad"]) ? $context["edad"] : $this->getContext($context, "edad")), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <td><strong>Nombre:</strong></td>
                        <td colspan=\"3\" style=\"font-size: 12px\">
                            ";
        // line 71
        echo twig_escape_filter($this->env, (((($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "primerApellido") . " ") . $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "segundoApellido")) . " ") . $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "apellidoCasada")), "html", null, true);
        echo "   
                            ";
        // line 72
        echo twig_escape_filter($this->env, (((($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "primerNombre") . " ") . $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "segundoNombre")) . " ") . $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "tercerNombre")), "html", null, true);
        echo "
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Si es menor de edad<br/>Nombre completo de responsable:</strong></td>
                        <td colspan=\"2\">";
        // line 77
        $context["var"] = twig_split_filter((isset($context["edad"]) ? $context["edad"] : $this->getContext($context, "edad")), "año");
        // line 78
        echo "                            ";
        if ((twig_length_filter($this->env, (isset($context["var"]) ? $context["var"] : $this->getContext($context, "var"))) == 2)) {
            // line 79
            echo "                                ";
            if (($this->getAttribute((isset($context["var"]) ? $context["var"] : $this->getContext($context, "var")), 0, array(), "array") < 18)) {
                // line 80
                echo "                                    ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "nombreResponsable"), "html", null, true);
                echo "
                                ";
            }
            // line 82
            echo "                            ";
        } else {
            // line 83
            echo "                                ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "nombreResponsable"), "html", null, true);
            echo "
                            ";
        }
        // line 85
        echo "                        </td>
                        
                        <td>
                            <strong>Sexo: </strong>";
        // line 88
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idSexo"), "html", null, true);
        echo "
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Dirección Completa:</strong></td>
                        <td colspan=\"2\">";
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "direccion"), "html", null, true);
        echo "</td>
                        <td>
                            <strong>Area: </strong>";
        // line 95
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "areaGeograficaDomicilio"), "html", null, true);
        echo " <br><br>
                            <strong>Nacionalidad: </strong>";
        // line 96
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idNacionalidad"), "html", null, true);
        echo "
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Departamento: </strong>";
        // line 100
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idDepartamentoDomicilio"), "html", null, true);
        echo "</td>
                        <td colspan=\"2\"><strong>Municipio: </strong>";
        // line 101
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idMunicipioDomicilio"), "html", null, true);
        echo "</td>
                        <td><strong>Pais de residencia:</strong></td> 
                    </tr>
                    <tr>
                        <td colspan=\"3\"><strong>Localidad:</strong></td> 
                        <td ><strong>Teléfono:</strong>";
        // line 106
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "telefonoCasa"), "html", null, true);
        echo "</td> 
                    </tr>
                </tbody>
            </table>  
        </div>
<br/>

<div >  
    <table style=\"border-style: solid;border-color: black; border-width: 1px\">
        <tbody>
            <tr>
                <td>
                    <strong>Estudiante:&nbsp;&nbsp;SI&nbsp;</strong> 
                    &nbsp;&nbsp;<img src=\"";
        // line 119
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/cuadrado_impresion.jpg")), "html", null, true);
        echo "\" style=\"width: 12px; height: 12px;\"/>&nbsp;&nbsp;
                    <strong>&nbsp;&nbsp;NO&nbsp;&nbsp;</strong> 
                    <img src=\"";
        // line 121
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/cuadrado_impresion.jpg")), "html", null, true);
        echo "\" style=\"width: 12px; height: 12px;\"/>
                </td>
                <td >
                    <br>_____________________________________________________________________________________________________<br>
                    <strong>Nombre del Centro Educativo</strong> (completar esta informacion unicamente si es un estudiante)  
                </td>
            </tr>
            <tr>
                <td colspan=\"2\">
                    <strong>Antecedentes Obstétricos: </strong> 
                    &nbsp;&nbsp;&nbsp;&nbsp;<img src=\"";
        // line 131
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/cuadrado_impresion.jpg")), "html", null, true);
        echo "\" style=\"width: 12px; height: 12px;\"/> &nbsp;&nbsp;Aborto&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;<img src=\"";
        // line 132
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/cuadrado_impresion.jpg")), "html", null, true);
        echo "\" style=\"width: 12px; height: 12px;\"/> &nbsp;&nbsp;Embarazada&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;<img src=\"";
        // line 133
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/cuadrado_impresion.jpg")), "html", null, true);
        echo "\" style=\"width: 12px; height: 12px;\"/> &nbsp;&nbsp;Parto&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;<img src=\"";
        // line 134
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/cuadrado_impresion.jpg")), "html", null, true);
        echo "\" style=\"width: 12px; height: 12px;\"/> &nbsp;&nbsp;Puerperio&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;<img src=\"";
        // line 135
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/cuadrado_impresion.jpg")), "html", null, true);
        echo "\" style=\"width: 12px; height: 12px;\"/> &nbsp;&nbsp;No aplica&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td colspan=\"2\">
                    Semana de amenorrea:&nbsp; ____________<br><br>
                </td>
            </tr>
        </tbody>
    </table>
    <br/>
  
    <table border = \"0\">
        <tbody>
            <tr>
                <td>
                    <strong>Manejo:</strong> 
                    &nbsp;&nbsp;<img src=\"";
        // line 152
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/cuadrado_impresion.jpg")), "html", null, true);
        echo "\" style=\"width: 12px; height: 12px;\"/>&nbsp;&nbsp;
                    &nbsp;&nbsp;Ambulatorio&nbsp;
                    &nbsp;&nbsp;<img src=\"";
        // line 154
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/cuadrado_impresion.jpg")), "html", null, true);
        echo "\" style=\"width: 12px; height: 12px;\"/>&nbsp;&nbsp;
                    &nbsp;&nbsp;Hospitalario&nbsp;&nbsp;
                    <img src=\"";
        // line 156
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/cuadrado_impresion.jpg")), "html", null, true);
        echo "\" style=\"width: 12px; height: 12px;\"/>
                </td>
                <td >
                    <strong>Referido a:</strong>__________________________________________________________________________________________<br>
                </td>
            </tr>
            <tr>
                <td colspan=\"2\">
                    <br> __________________________________________________________________________________________________________________________________________________<br>
                    <center><strong>Dianóstico clínico/ Sospecha Diagnóstica:</strong></center>
                </td>
            </tr>
            <tr>
                <td><strong>Fecha de inicio de Síntima: </strong>_____/______/______</td>
                <td style=\"text-align: right\"><strong>Fecha de notificación: </strong>_____/______/______</td>
            </tr>
            <tr>
                <td>
                    <strong>Condicion: </strong>
                    &nbsp;&nbsp;Vivo&nbsp;
                    &nbsp;&nbsp;<img src=\"";
        // line 176
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/cuadrado_impresion.jpg")), "html", null, true);
        echo "\" style=\"width: 12px; height: 12px;\"/>&nbsp;&nbsp;
                    &nbsp;&nbsp;Muerto&nbsp;
                    &nbsp;&nbsp;<img src=\"";
        // line 178
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/cuadrado_impresion.jpg")), "html", null, true);
        echo "\" style=\"width: 12px; height: 12px;\"/>&nbsp;&nbsp;
                <td style=\"text-align: right\"><strong>Fecha de defuncion: </strong>_____/______/______</td>
            </tr>
            <tr>
                <td colspan=\"2\">
                    <strong>Causa de Defunción: </strong>______________________________________________________________________________________________________________________________<br>
                </td>
            </tr>
            <tr>
                <td colspan=\"2\" style=\"font-size: 12px\">
                    <strong>Nombre del médico que notifica: </strong>";
        // line 188
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEmpleado", array(), "method"), "html", null, true);
        echo "<br>
                </td>
            </tr>
            <tr>
                <td colspan=\"2\" style=\"text-align: right\">
                    <strong>Firma y Sello: _________________________</strong>
                </td>
            </tr>
            <tr>
                <td colspan=\"2\" style=\"font-size: 8px\">
                    <center>Una copia queda en expediente y otra se envía al centro de acopio para su registro en el VIGEPES. Este formulario debe ser llenado en forma completa y con letra de molde</center>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>
";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:Reportes/Vigepes:reporte_vigepes01.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  797 => 489,  752 => 459,  748 => 458,  681 => 412,  677 => 411,  630 => 373,  618 => 368,  535 => 224,  519 => 219,  416 => 172,  1082 => 552,  1076 => 550,  1072 => 548,  1069 => 547,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 450,  842 => 443,  836 => 440,  824 => 435,  781 => 416,  775 => 413,  762 => 406,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 388,  708 => 381,  703 => 378,  674 => 366,  659 => 359,  636 => 350,  604 => 329,  581 => 330,  568 => 315,  539 => 322,  534 => 298,  530 => 297,  521 => 220,  489 => 208,  483 => 206,  394 => 234,  396 => 117,  345 => 283,  476 => 270,  386 => 284,  364 => 219,  234 => 78,  595 => 326,  589 => 357,  586 => 322,  562 => 323,  556 => 182,  506 => 103,  498 => 277,  492 => 274,  473 => 165,  458 => 266,  399 => 143,  352 => 211,  346 => 125,  328 => 104,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 218,  573 => 328,  567 => 347,  520 => 309,  481 => 167,  475 => 275,  472 => 269,  466 => 272,  441 => 346,  438 => 149,  432 => 182,  429 => 342,  395 => 287,  382 => 128,  378 => 281,  367 => 120,  357 => 103,  348 => 100,  334 => 110,  286 => 144,  205 => 106,  297 => 79,  218 => 127,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 419,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 374,  628 => 372,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 316,  499 => 154,  488 => 273,  389 => 114,  223 => 118,  14 => 2,  306 => 117,  303 => 181,  300 => 115,  292 => 86,  280 => 154,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 328,  599 => 327,  580 => 194,  574 => 230,  559 => 311,  526 => 179,  497 => 173,  485 => 283,  463 => 271,  447 => 152,  404 => 238,  401 => 119,  391 => 222,  369 => 106,  333 => 95,  329 => 93,  307 => 85,  287 => 75,  195 => 105,  178 => 123,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 425,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 209,  700 => 205,  679 => 368,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 356,  647 => 355,  644 => 190,  632 => 349,  629 => 186,  626 => 221,  603 => 362,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 321,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 307,  448 => 306,  424 => 234,  418 => 112,  410 => 236,  376 => 109,  373 => 152,  340 => 200,  326 => 188,  261 => 146,  118 => 49,  200 => 117,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 543,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 536,  1036 => 534,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 488,  785 => 486,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 437,  710 => 149,  707 => 208,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 357,  649 => 122,  643 => 227,  640 => 226,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 358,  576 => 101,  564 => 162,  557 => 310,  550 => 94,  527 => 296,  515 => 305,  512 => 290,  509 => 228,  503 => 81,  496 => 282,  493 => 155,  478 => 204,  467 => 197,  456 => 309,  450 => 114,  414 => 242,  408 => 239,  388 => 207,  371 => 216,  363 => 187,  350 => 142,  342 => 97,  335 => 198,  316 => 16,  290 => 76,  276 => 102,  266 => 136,  263 => 153,  255 => 135,  245 => 122,  207 => 137,  194 => 112,  184 => 65,  76 => 21,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 399,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 372,  685 => 413,  682 => 226,  672 => 223,  670 => 365,  665 => 362,  648 => 219,  627 => 206,  622 => 369,  619 => 212,  616 => 202,  613 => 210,  610 => 332,  608 => 197,  605 => 207,  596 => 106,  592 => 325,  587 => 197,  585 => 331,  582 => 190,  578 => 178,  572 => 204,  566 => 324,  547 => 93,  545 => 228,  542 => 227,  533 => 186,  531 => 95,  507 => 287,  505 => 214,  502 => 278,  477 => 164,  471 => 164,  465 => 265,  454 => 265,  446 => 156,  443 => 256,  431 => 251,  428 => 250,  425 => 247,  422 => 338,  412 => 147,  406 => 111,  390 => 139,  383 => 112,  377 => 199,  375 => 218,  372 => 107,  370 => 222,  359 => 145,  356 => 269,  353 => 143,  349 => 119,  336 => 205,  332 => 259,  330 => 554,  318 => 90,  313 => 178,  291 => 108,  190 => 129,  321 => 254,  295 => 201,  274 => 71,  242 => 153,  236 => 177,  70 => 26,  170 => 95,  288 => 197,  284 => 89,  279 => 193,  275 => 152,  256 => 132,  250 => 66,  237 => 133,  232 => 136,  222 => 129,  191 => 104,  153 => 36,  150 => 35,  563 => 188,  560 => 187,  558 => 322,  553 => 309,  549 => 182,  543 => 179,  537 => 176,  532 => 223,  528 => 173,  525 => 311,  523 => 171,  518 => 292,  514 => 218,  511 => 217,  508 => 281,  501 => 212,  491 => 157,  487 => 156,  460 => 194,  455 => 141,  449 => 263,  442 => 259,  439 => 133,  436 => 183,  433 => 130,  426 => 126,  420 => 233,  415 => 121,  411 => 170,  405 => 118,  403 => 117,  380 => 107,  366 => 105,  354 => 102,  331 => 173,  325 => 94,  320 => 91,  317 => 99,  311 => 98,  308 => 176,  304 => 84,  272 => 81,  267 => 148,  249 => 142,  216 => 56,  155 => 82,  146 => 79,  126 => 13,  188 => 54,  181 => 115,  161 => 105,  110 => 72,  124 => 82,  692 => 373,  683 => 282,  678 => 279,  676 => 367,  666 => 126,  661 => 380,  656 => 358,  652 => 376,  645 => 215,  641 => 352,  635 => 376,  631 => 218,  625 => 361,  615 => 335,  607 => 363,  597 => 359,  590 => 202,  583 => 354,  579 => 353,  577 => 329,  575 => 352,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 299,  529 => 222,  524 => 90,  516 => 286,  510 => 78,  504 => 296,  500 => 88,  495 => 210,  490 => 154,  486 => 165,  482 => 317,  470 => 313,  464 => 196,  459 => 270,  452 => 191,  434 => 252,  421 => 90,  417 => 296,  400 => 116,  385 => 129,  361 => 207,  344 => 98,  339 => 137,  324 => 102,  310 => 86,  302 => 93,  296 => 92,  282 => 143,  259 => 151,  244 => 147,  231 => 123,  226 => 121,  215 => 63,  186 => 96,  152 => 54,  114 => 40,  104 => 31,  358 => 209,  351 => 101,  347 => 183,  343 => 264,  338 => 96,  327 => 108,  323 => 522,  319 => 164,  315 => 121,  301 => 94,  299 => 201,  293 => 177,  289 => 91,  281 => 74,  277 => 72,  271 => 70,  265 => 82,  262 => 68,  260 => 128,  257 => 53,  251 => 134,  248 => 65,  239 => 131,  228 => 75,  225 => 65,  213 => 127,  211 => 125,  197 => 101,  174 => 59,  148 => 92,  134 => 29,  127 => 40,  20 => 1,  270 => 85,  253 => 67,  233 => 131,  212 => 139,  210 => 126,  206 => 109,  202 => 52,  198 => 57,  192 => 55,  185 => 100,  180 => 105,  175 => 47,  172 => 59,  167 => 101,  165 => 40,  160 => 56,  137 => 87,  113 => 37,  100 => 60,  90 => 66,  81 => 27,  65 => 41,  129 => 71,  97 => 62,  77 => 55,  34 => 4,  53 => 10,  84 => 53,  58 => 12,  23 => 2,  480 => 205,  474 => 274,  469 => 271,  461 => 70,  457 => 124,  453 => 151,  444 => 185,  440 => 184,  437 => 244,  435 => 344,  430 => 153,  427 => 180,  423 => 298,  413 => 237,  409 => 327,  407 => 169,  402 => 166,  398 => 226,  393 => 116,  387 => 113,  384 => 230,  381 => 315,  379 => 110,  374 => 36,  368 => 215,  365 => 119,  362 => 146,  360 => 104,  355 => 27,  341 => 138,  337 => 97,  322 => 188,  314 => 186,  312 => 97,  309 => 118,  305 => 204,  298 => 150,  294 => 78,  285 => 156,  283 => 5,  278 => 142,  268 => 101,  264 => 147,  258 => 145,  252 => 143,  247 => 133,  241 => 62,  229 => 129,  220 => 171,  214 => 126,  177 => 93,  169 => 88,  140 => 88,  132 => 50,  128 => 84,  107 => 64,  61 => 36,  273 => 161,  269 => 165,  254 => 86,  243 => 132,  240 => 146,  238 => 61,  235 => 60,  230 => 72,  227 => 57,  224 => 74,  221 => 119,  219 => 60,  217 => 129,  208 => 54,  204 => 63,  179 => 98,  159 => 99,  143 => 78,  135 => 85,  119 => 73,  102 => 64,  71 => 19,  67 => 25,  63 => 40,  59 => 9,  28 => 7,  94 => 35,  89 => 24,  85 => 31,  75 => 13,  68 => 42,  56 => 12,  87 => 16,  201 => 123,  196 => 61,  183 => 106,  171 => 102,  166 => 107,  163 => 106,  158 => 83,  156 => 37,  151 => 94,  142 => 89,  138 => 31,  136 => 102,  121 => 66,  117 => 65,  105 => 20,  91 => 57,  62 => 23,  49 => 10,  25 => 5,  21 => 2,  31 => 7,  38 => 12,  26 => 6,  24 => 3,  19 => 1,  93 => 61,  88 => 54,  78 => 14,  46 => 7,  44 => 8,  27 => 6,  79 => 21,  72 => 44,  69 => 18,  47 => 7,  40 => 11,  37 => 13,  22 => 2,  246 => 78,  157 => 98,  145 => 68,  139 => 52,  131 => 83,  123 => 33,  120 => 74,  115 => 23,  111 => 32,  108 => 65,  101 => 31,  98 => 69,  96 => 33,  83 => 23,  74 => 20,  66 => 16,  55 => 29,  52 => 17,  50 => 8,  43 => 7,  41 => 14,  35 => 8,  32 => 2,  29 => 6,  209 => 124,  203 => 107,  199 => 51,  193 => 100,  189 => 47,  187 => 108,  182 => 95,  176 => 44,  173 => 43,  168 => 41,  164 => 85,  162 => 39,  154 => 48,  149 => 80,  147 => 45,  144 => 92,  141 => 77,  133 => 72,  130 => 40,  125 => 27,  122 => 26,  116 => 37,  112 => 69,  109 => 73,  106 => 81,  103 => 71,  99 => 63,  95 => 58,  92 => 17,  86 => 27,  82 => 37,  80 => 56,  73 => 18,  64 => 23,  60 => 35,  57 => 19,  54 => 14,  51 => 22,  48 => 13,  45 => 13,  42 => 12,  39 => 4,  36 => 6,  33 => 8,  30 => 4,);
    }
}
