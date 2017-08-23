<?php

/* MinsalSeguimientoBundle:Reportes/Fvih01:reporte_fvih01_v2.html.twig */
class __TwigTemplate_10bbab65ea584e8c57e0b0918f2b1f76ef30c7481b2109bb19d06974650fad8d extends Twig_Template
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

            html,body {
                overflow: visible !important;
                color: black !important;
                border-style: none !important;
                border-color:black !important;
                font-size: 12px!important;
            }

            div .table-responsive {
                overflow: visible !important;
                border-style: none !important
            }

            .panel{
                margin: 8px;
            }

            .panel-info > .panel-heading,.titulo_vista {
                background-color: white;
                font-size: 12px;
                border-color: black;
                color: black;
                font-weight: bold;
                border-style: none !important;
                padding: 2px 5px;
            }

            table{
                font-size: 10px!important;
            }

            .panel-body, .vista_paciente{
                font-size: 10px;
                border-style: none !important;
            }

            td,th {
                padding: 2px 5px;
            }

            .panel-info{
                border-color:black
            }

            table {
                width: 100%
            }

            .square-span{
                border: 1px solid #000000;
                width: 15px !important;
                height: 12px !important;
                margin: 0px;
                padding: 0px;
                display: inline-block;
            }

            .table-strong-label strong  {
                font-size: 11px;
            }

            .border-title{
                border: 1px solid #000000;
            }
        </style>
    </head>
    <body >
        <div style=\"height: 824px;border-bottom-style: dashed; border-width: 1px;\">
            <div class=\"table-responsive\" style=\"overflow-x: auto; border:0px; \">
                <table  style=\"font-size: 10px;border:0px;\">
                    <tbody>
                        <tr>
                            <td><img src=\"";
        // line 81
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/Reporte-Escudo.png")), "html", null, true);
        echo "\" style=\"width: 50px;\"/></td>
                            <td  width=\"500px\">
                                <center>
                                    MINISTERIO DE SALUD <br/>
                                    SISTEMA NACIONAL DE SALUD/COMISION INTERSECTORIAL DE SALUD (CISALUD)<br/>
                                    FORMULARIO PARA SOLICITUD Y CONFIRMACIÓN DE VIH (FVIH-01)<br/>
                                    ";
        // line 87
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento", array(), "method")), "html", null, true);
        echo "
                                </center>
                            </td>
                            <td ><img src=\"";
        // line 90
        echo twig_escape_filter($this->env, ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "schemeAndHttpHost") . $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/imagenes/minsal_2014.png")), "html", null, true);
        echo "\" style=\"width: 120px;float:right;\"/></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <table class=\"table-strong-label\">
                <tbody>
                    <tr class=\"border-title\">
                        <th colspan=\"8\">A. DATOS GENERALES</th>
                    </tr>
                    <tr>
                        <td><strong>Fecha de Consulta: </strong></td>
                        <td>";
        // line 102
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "fechaconsulta"), "d-m-Y"), "html", null, true);
        echo "</td>
                        <td><strong>Nombre del Establecimiento</strong></td>
                        <td colspan=\"5\">";
        // line 104
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento", array(), "method"), "html", null, true);
        echo " </td>
                    </tr>
                    <tr>
                        <td><strong>No. Expediente:</strong></td>
                        <td>";
        // line 108
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "numero"), "html", null, true);
        echo "</td>
                        <td><strong>Categoría de Afiliación:</strong></td>
                        <td colspan=\"5\">";
        // line 110
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAreaCotizacion")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAreaCotizacion")) : ("- -")), "html", null, true);
        echo "</td>
                    </tr>
                    <tr class=\"border-title\">
                        <th colspan=\"8\">I. DATOS DE IDENTIFICACIÓN</th>
                    </tr>
                    <tr>
                        <td><strong>1er Nombre:</strong></td>
                        <td>";
        // line 117
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "primerNombre")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "primerNombre")) : ("--")), "html", null, true);
        echo "</td>
                        <td><strong>1er Apellido:</strong></td>
                        <td>";
        // line 119
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "primerApellido")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "primerApellido")) : ("--")), "html", null, true);
        echo "</td>
                        <td><strong>Fecha Nacimiento:</strong></td>
                        <td>";
        // line 121
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "fechaNacimiento"), "d/m/Y"), "html", null, true);
        echo "</td>
                        <td><strong>DUI:</strong></td>
                        <td>";
        // line 123
        echo twig_escape_filter($this->env, ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idDocPaciente"), "id") == 1)) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "numeroDocIdePaciente")) : ("- -")), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <td><strong>2&deg; Nombre:</strong></td>
                        <td>";
        // line 127
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "segundoNombre")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "segundoNombre")) : ("--")), "html", null, true);
        echo "</td>
                        <td><strong>2&deg; Apellido:</strong></td>
                        <td>";
        // line 129
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "segundoApellido")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "segundoApellido")) : ("--")), "html", null, true);
        echo "</td>
                        <td><strong>Edad:</strong></td>
                        <td colspan=\"3\">";
        // line 131
        echo twig_escape_filter($this->env, (isset($context["edad"]) ? $context["edad"] : $this->getContext($context, "edad")), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <td><strong>3er Nombre:</strong></td>
                        <td>";
        // line 135
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "tercerNombre")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "tercerNombre")) : ("--")), "html", null, true);
        echo "</td>
                        <td><strong>Apellido Casada:</strong></td>
                        <td>";
        // line 137
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "apellidoCasada")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "apellidoCasada")) : ("--")), "html", null, true);
        echo "</td>
                        <td><strong>Sexo:</strong></td>
                        <td>";
        // line 139
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idSexo"), "html", null, true);
        echo "</td>
                        <td colspan=\"2\"></td>
                    </tr>
                    <tr>
                        <td colspan=\"3\"><strong>Si es menor de edad, nombre completo de responsable:</strong></td>
                        <td colspan=\"3\">
                            ";
        // line 145
        $context["var"] = twig_split_filter((isset($context["edad"]) ? $context["edad"] : $this->getContext($context, "edad")), "año");
        // line 146
        echo "                            ";
        if ((twig_length_filter($this->env, (isset($context["var"]) ? $context["var"] : $this->getContext($context, "var"))) == 2)) {
            // line 147
            echo "                                ";
            if (($this->getAttribute((isset($context["var"]) ? $context["var"] : $this->getContext($context, "var")), 0, array(), "array") < 18)) {
                // line 148
                echo "                                    ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "nombreResponsable"), "html", null, true);
                echo "
                                ";
            } else {
                // line 150
                echo "                                    N/A
                                ";
            }
            // line 152
            echo "                            ";
        } else {
            // line 153
            echo "                                ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "nombreResponsable"), "html", null, true);
            echo "
                            ";
        }
        // line 155
        echo "                        </td>
                        <td colspan=\"1\"><strong>Conocido por:</strong></td>
                        <td colspan=\"1\">";
        // line 157
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "conocidoPor")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "conocidoPor")) : ("--")), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <td><strong>Departamento:</strong></td>
                        <td>";
        // line 161
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idDepartamentoDomicilio")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idDepartamentoDomicilio")) : ("--")), "html", null, true);
        echo "</td>
                        <td><strong>Municipio:</strong></td>
                        <td>";
        // line 163
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idMunicipioDomicilio")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idMunicipioDomicilio")) : ("--")), "html", null, true);
        echo "</td>
                        <td><strong>Area:</strong></td>
                        <td>";
        // line 165
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "areaGeograficaDomicilio")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "areaGeograficaDomicilio")) : ("--")), "html", null, true);
        echo "</td>
                        <td><strong>Nacionalidad:</strong></td>
                        <td>";
        // line 167
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idNacionalidad")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idNacionalidad")) : ("--")), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <td><strong>Dirección Completa:</strong></td>
                        <td colspan=\"5\">";
        // line 171
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "direccion"), "html", null, true);
        echo "</td>
                        <td><strong>Teléfono:</strong></td>
                        <td>";
        // line 173
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "telefonoCasa")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "telefonoCasa")) : ("--")), "html", null, true);
        echo "</td>
                    </tr>
                    <tr>
                        <td><strong>Estado Civil:</strong></td>
                        <td>";
        // line 177
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idEstadoCivil")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idEstadoCivil")) : ("--")), "html", null, true);
        echo "</td>
                        <td><strong>Alfabeta:</strong></td>
                        <td>";
        // line 179
        echo (($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getAlfabeta", array(), "method")) ? ("Si") : ("No"));
        echo "</td>
                        <td><strong>Educación:</strong></td>
                        <td>";
        // line 181
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getIdNivelEducacion", array(), "method"), "getNombre", array(), "method"), "html", null, true);
        echo "</td>
                        <td><strong>Ocupación:</strong></td>
                        <td>";
        // line 183
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getIdOcupacion", array(), "method"), "getNombre", array(), "method"), "html", null, true);
        echo "</td>
                    </tr>
                    <tr class=\"border-title\">
                        <th colspan=\"3\" class=\"border-title\">";
        // line 186
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, "II.Datos Espeficos de Mujeres en edad Reproductiva (09-54) Años"), "html", null, true);
        echo "</th>
                        <th colspan=\"3\" class=\"border-title\">";
        // line 187
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, "III.Datos Especificos Sobre Población"), "html", null, true);
        echo "</th>
                        <th colspan=\"2\" class=\"border-title\">";
        // line 188
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, "IV.Motivos de Solicitud de Examen"), "html", null, true);
        echo "</th>
                    </tr>
                    <tr>
                        <td colspan=\"3\" class=\"border-title\">
                            <table>
                                <tr>
                                    <td colspan=\"4\"><center>Indagar en toda mujer en edad reproductiva (09 a 54 años de edad)</center></td>
                                </tr>
                                <tr>
                                    <td><strong>Embarazada:</strong></td>
                                    <td>";
        // line 198
        echo ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdCondicionPersona", array(), "method"), "getId", array(), "method") == 1)) ? ("Si") : ("No"));
        echo "</td>
                                    <td><strong>En control prenatal: </strong></td>
                                    <td>";
        // line 200
        echo (((isset($context["datoEmbarazo"]) ? $context["datoEmbarazo"] : $this->getContext($context, "datoEmbarazo"))) ? ((($this->getAttribute((isset($context["datoEmbarazo"]) ? $context["datoEmbarazo"] : $this->getContext($context, "datoEmbarazo")), "idEstablecimientoControl")) ? (" Si") : ("No"))) : ("No"));
        echo "</td><!-- Este se obtine de SecDatoEmbarazo -->
                                    <!--<td colspan=\"2\"><strong>En control prenatal:</strong>";
        // line 201
        echo (($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idDatoEmbarazo")) ? ((($this->getAttribute($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idDatoEmbarazo"), "controlPrenatal")) ? ("Si") : ("No"))) : ("N/A"));
        echo "</td>--><!-- Proviene de TarDatosEmbarazada -->
                                </tr>
                                <tr>
                                    <td><strong>Establecimiento de Control:</strong></td>
                                    <td colspan=\"3\">";
        // line 205
        echo twig_escape_filter($this->env, (((isset($context["datoEmbarazo"]) ? $context["datoEmbarazo"] : $this->getContext($context, "datoEmbarazo"))) ? ((($this->getAttribute((isset($context["datoEmbarazo"]) ? $context["datoEmbarazo"] : $this->getContext($context, "datoEmbarazo")), "idEstablecimientoControl")) ? ($this->getAttribute($this->getAttribute((isset($context["datoEmbarazo"]) ? $context["datoEmbarazo"] : $this->getContext($context, "datoEmbarazo")), "idEstablecimientoControl"), "nombre")) : ("- -"))) : ("N/A")), "html", null, true);
        echo "</td>
                                </tr>
                                <tr>
                                    <td><strong>FUM:</strong></td>
                                    <td colspan=\"3\">";
        // line 209
        echo twig_escape_filter($this->env, (((isset($context["datoEmbarazo"]) ? $context["datoEmbarazo"] : $this->getContext($context, "datoEmbarazo"))) ? (twig_date_format_filter($this->env, $this->getAttribute((isset($context["datoEmbarazo"]) ? $context["datoEmbarazo"] : $this->getContext($context, "datoEmbarazo")), "fechaUltimaMestruacion"), "d/m/Y")) : ("N/A")), "html", null, true);
        echo "</td>
                                </tr>
                                <tr>
                                    <td><strong>Formula Obstétrica:</strong></td>
                                    <td colspan=\"3\">
                                        ";
        // line 214
        if ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method")) {
            // line 215
            echo "                                            ";
            if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "getIdPaciente", array(), "method"), "getIdAntecedentes", array(), "method"), "idAntecedentesObstetricos", array(), "method")) {
                // line 216
                echo "                                                <table>
                                                    <tr>
                                                        <td>G: ";
                // line 218
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAntecedentes"), "idAntecedentesObstetricos"), "gestaciones")) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAntecedentes"), "idAntecedentesObstetricos"), "gestaciones")) : ("- -")), "html", null, true);
                echo "</td>
                                                        <td>P: ";
                // line 219
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAntecedentes"), "idAntecedentesObstetricos"), "partosTermino")) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAntecedentes"), "idAntecedentesObstetricos"), "partosTermino")) : ("- -")), "html", null, true);
                echo "</td>
                                                        <td>P: ";
                // line 220
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAntecedentes"), "idAntecedentesObstetricos"), "partoPrematuro")) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAntecedentes"), "idAntecedentesObstetricos"), "partoPrematuro")) : ("- -")), "html", null, true);
                echo "</td>
                                                        <td>A: ";
                // line 221
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAntecedentes"), "idAntecedentesObstetricos"), "abortos")) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAntecedentes"), "idAntecedentesObstetricos"), "abortos")) : ("- -")), "html", null, true);
                echo "</td>
                                                        <td>V: ";
                // line 222
                echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAntecedentes"), "idAntecedentesObstetricos"), "nacidosVivos")) ? ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idAntecedentes"), "idAntecedentesObstetricos"), "nacidosVivos")) : ("- -")), "html", null, true);
                echo "</td>
                                                    </tr>
                                                </table>
                                            ";
            } else {
                // line 226
                echo "                                                <table>
                                                    <tr>
                                                        <td>G: N/A</td>
                                                        <td>P: N/A</td>
                                                        <td>P: N/A</td>
                                                        <td>A: N/A</td>
                                                        <td>V: N/A</td>
                                                    </tr>
                                                </table>
                                            ";
            }
            // line 236
            echo "                                        ";
        } else {
            // line 237
            echo "                                            <table>
                                                <tr>
                                                    <td>G: N/A</td>
                                                    <td>P: N/A</td>
                                                    <td>P: N/A</td>
                                                    <td>A: N/A</td>
                                                    <td>V: N/A</td>
                                                </tr>
                                            </table>
                                        ";
        }
        // line 247
        echo "                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=\"2\"><strong>Periodo de indicación del examen: </strong></td>
                                    <td colspan=\"2\">";
        // line 251
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idDatoEmbarazo")) ? ($this->getAttribute($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "idDatoEmbarazo"), "idPeriodo")) : ("N/A")), "html", null, true);
        echo "</td>
                                </tr>
                            </table>
                        </td>
                        <td colspan=\"3\" class=\"border-title\">
                            <table>
                                <tr>
                                    <td><strong>Orientación Sexual:</strong></td>
                                    <td>";
        // line 259
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getIdOrientacionSexual", array(), "method"), "html", null, true);
        echo "</td>
                                </tr>
                                <tr>
                                    <td><strong>Identitidad Sexual:</strong></td>
                                    <td>";
        // line 263
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getIdentidadGenero", array(), "method"), "html", null, true);
        echo "</td>
                                </tr>
                                <tr>
                                    <td colspan=\"2\"><strong>Otros Posibles Factores de Riesgo</strong></td>
                                </tr>
                                <tr>
                                    <td colspan=\"2\">
                                        ";
        // line 270
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getIdFactoresRiesgo", array(), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["factor"]) {
            // line 271
            echo "                                            <ul style=\"margin: 0px;\">
                                                <li>";
            // line 272
            echo twig_escape_filter($this->env, (isset($context["factor"]) ? $context["factor"] : $this->getContext($context, "factor")), "html", null, true);
            echo "</li>
                                            </ul>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['factor'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 275
        echo "                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td colspan=\"2\" class=\"border-title\">
                            <table>
                                <tr>
                                    <td><strong>Motivo:</strong></td>
                                    <td>";
        // line 283
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getIdMotivoSolicitud", array(), "method"), "html", null, true);
        echo "</td>
                                </tr>
                                <tr>
                                    <td><strong>Población Meta:</strong></td>
                                    <td>";
        // line 287
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getIdPoblacionMeta", array(), "method"), "html", null, true);
        echo "</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"3\">
                            <br/>
                            <table>
                                <tr><td ><center>";
        // line 296
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEmpleado", array(), "method"), "html", null, true);
        echo "</center></td></tr>
                                <tr><td><center>Nombre de responsable de indicar prueba</center></td></tr>
                                <tr><td><center><br/><br/><br/><br/><br/><br/></center></td></tr>
                                <tr><td><center>Firma y Sello</center></td></tr>
                            </table>
                        </td>
                        <td colspan=\"3\">
                            <table class=\"border-title\">
                                <tr>
                                    <td colspan=\"4\"><strong>V. DATOS CLINICOS:</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Clínica:</strong></td>
                                    <td>";
        // line 309
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getIdDatosClinicos", array(), "method"), "html", null, true);
        echo "</td>
                                    <td><strong>Manejo:</strong></td>
                                    <td>";
        // line 311
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getIdDatosManejo", array(), "method"), "html", null, true);
        echo "</td>
                                </tr>
                            </table>
                        </td>
                        <td colspan=\"2\">
                            <table class=\"border-title\">
                                <tr>
                                    <td colspan=\"2\"><strong>VI. CONSEJERIA:</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Se registró consejería:</strong></td>
                                    <td>";
        // line 322
        echo (($this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getEsConsejeria", array(), "method")) ? ("Si") : ("No"));
        echo "</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <br/>
                        <td colspan=\"8\"><center>Esta hoja deberá ser llenada en forma completa con letra legible por personal que indicó la prueba de VIH</center></td>
                    </tr>
                    <tr class=\"border-title\">
                        <td colspan=\"8\">
                            <center>
                                <strong>Ley y Reglamento de Prevención y Control de la Infección Provocada por el Virus de Inmunodefiencia Humana<br/>
                                        DECRETO No. 588. CAPITULO III. Vigilancia Epidemiológica Art. 30. Y DECRETO No.40 CAPITULO IV. Art.59. Art.61.
                                </strong>
                            </center>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br/>
        <table class=\"border-title\">
            <tbody>
                <tr>
                    <td><strong>Establecimiento: </strong>";
        // line 347
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEstablecimiento", array(), "method")), "html", null, true);
        echo "</td>
                    <td><strong>Fecha:</strong> _______________</td>
                    <td><strong>ORDEN DE SOLICIUTD DE EXAMEN</strong></td>
                </tr>
                <tr>
                    <td><strong>1er Nombre: </strong>";
        // line 352
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "primerNombre")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "primerNombre")) : ("- -")), "html", null, true);
        echo "</td>
                    <td><strong>1er Apellido: </strong>";
        // line 353
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "primerApellido")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "primerApellido")) : ("- -")), "html", null, true);
        echo "</td>
                    <td><strong>DUI: </strong>";
        // line 354
        echo twig_escape_filter($this->env, ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idDocPaciente"), "id") == 1)) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "numeroDocIdePaciente")) : ("- -")), "html", null, true);
        echo "</td>
                </tr>
                <tr>
                    <td><strong>2&deg; Nombre: </strong>";
        // line 357
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "segundoNombre")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "segundoNombre")) : ("- -")), "html", null, true);
        echo "</td>
                    <td><strong>2&deg; Apellido: </strong>";
        // line 358
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "segundoApellido")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "segundoApellido")) : ("- -")), "html", null, true);
        echo "</td>
                    <td><strong>Conocido por: </strong>";
        // line 359
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "conocidoPor")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "conocidoPor")) : ("- -")), "html", null, true);
        echo "</td>
                </tr>
                <tr>
                    <td><strong>3er Nombre: </strong>";
        // line 362
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "tercerNombre")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "tercerNombre")) : ("- -")), "html", null, true);
        echo "</td>
                    <td><strong>Apellido de Casada: </strong>";
        // line 363
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "apellidoCasada")) ? ($this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "apellidoCasada")) : ("- -")), "html", null, true);
        echo "</td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>Edad: </strong>";
        // line 367
        echo twig_escape_filter($this->env, (isset($context["edad"]) ? $context["edad"] : $this->getContext($context, "edad")), "html", null, true);
        echo "</td>
                    <td><strong>Sexo: </strong>";
        // line 368
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "idPaciente"), "idSexo"), "html", null, true);
        echo "</td>
                    <td><strong>No. Expediente: </strong>";
        // line 369
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["expediente"]) ? $context["expediente"] : $this->getContext($context, "expediente")), "numero"), "html", null, true);
        echo "</td>
                </tr>
                <tr>
                    <td colspan=\"2\"><strong>Motivo de Solicitud de Examen: </strong>";
        // line 372
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["solicitud"]) ? $context["solicitud"] : $this->getContext($context, "solicitud")), "getIdMotivoSolicitud", array(), "method"), "html", null, true);
        echo "</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan=\"2\"><center>";
        // line 376
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "getIdEmpleado", array(), "method"), "html", null, true);
        echo "</center></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan=\"2\"><center>Nombre de responsable de indicar prueba</center></td>
                    <td><center>Firma y Sello</center></td>
                </tr>
            </tbody>
        </table>

        <!-- Salto de Página-->
        <p style=\"page-break-after: always;\"></p>
        <div style=\"height: 830px;border-bottom-style: dashed;border-width: 1px;\">
            <p style=\"text-align: right\">Uso exclusivo de Laboratorio</p>
            <p><strong>B. EXAMENES QUE FUNDAMENTAN EL DIANÓSTICO</strong></p>
            <table class=\"border-title\">
                <td><br/></td>
                <tr>
                    <td><strong>Nombre del Establecimiento que realiza la prueba: </strong>____________________________________________________________________________________________________</td>
                </tr>
                <tr>
                    <td>
                        <strong>Fecha toma de muestra: </strong>___________________&emsp;
                        <strong>Fecha de realización: </strong>___________________&emsp;
                        <strong>Fecha de resultado: </strong>___________________
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Prueba Rápida &nbsp;</strong><span class=\"square-span\"></span>
                        Marca _______________
                        &nbsp;Reactivo pendiente de confirmar <span class=\"square-span\"></span>
                        &nbsp;No Reactivo a la fecha <span class=\"square-span\"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>ELISA &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;</strong><span class=\"square-span\"></span>
                        Marca _______________
                        Lectura _____________
                        Reactivo pendiente de confirmar <span class=\"square-span\"></span>&nbsp;
                        No Reactivo a la fecha <span class=\"square-span\"></span>&nbsp;
                        Indeterminado pendiente de confirmar <span class=\"square-span\"></span>
                    </td>
                </tr>
                <tr>
                    <td><strong>Responsable:</strong></td>
                </tr>
            </table>
        </div>
        <p><strong>EXÁMENES QUE FUNDAMENTAN EL DIAGNÓSTICO</strong></p>
        <table class=\"border-title\">
            <td><br/></td>
            <tr>
                <td><strong>Nombre del Establecimiento que realiza la prueba: </strong>____________________________________________________________________________________________________</td>
            </tr>
            <tr>
                <td>
                    <strong>Fecha toma de muestra: </strong>___________________&emsp;
                    <strong>Fecha de realización: </strong>___________________&emsp;
                    <strong>Fecha de resultado: </strong>___________________
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Prueba Rápida &nbsp;</strong><span class=\"square-span\"></span>
                    Marca _______________
                    &nbsp;Reactivo pendiente de confirmar <span class=\"square-span\"></span>
                    &nbsp;No Reactivo a la fecha <span class=\"square-span\"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>ELISA &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;</strong><span class=\"square-span\"></span>
                    Marca _______________
                    Lectura _____________
                    Reactivo pendiente de confirmar <span class=\"square-span\"></span>&nbsp;
                    No Reactivo a la fecha <span class=\"square-span\"></span>&nbsp;
                    Indeterminado pendiente de confirmar <span class=\"square-span\"></span>
                </td>
            </tr>
            <tr>
                <td><strong>Responsable:</strong></td>
            </tr>
        </table>
    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:Reportes/Fvih01:reporte_fvih01_v2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  618 => 368,  535 => 224,  519 => 219,  416 => 172,  1082 => 552,  1076 => 550,  1072 => 548,  1069 => 547,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 459,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 450,  842 => 443,  836 => 440,  824 => 435,  781 => 416,  775 => 413,  762 => 406,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 388,  708 => 381,  703 => 378,  674 => 366,  659 => 359,  636 => 350,  604 => 329,  581 => 320,  568 => 315,  539 => 322,  534 => 298,  530 => 297,  521 => 220,  489 => 208,  483 => 206,  394 => 234,  396 => 163,  345 => 283,  476 => 315,  386 => 284,  364 => 219,  234 => 78,  595 => 326,  589 => 357,  586 => 322,  562 => 312,  556 => 182,  506 => 103,  498 => 211,  492 => 287,  473 => 165,  458 => 266,  399 => 143,  352 => 211,  346 => 125,  328 => 104,  880 => 461,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 251,  758 => 405,  667 => 218,  573 => 172,  567 => 347,  520 => 309,  481 => 167,  475 => 275,  472 => 202,  466 => 272,  441 => 346,  438 => 149,  432 => 182,  429 => 342,  395 => 287,  382 => 128,  378 => 281,  367 => 120,  357 => 144,  348 => 115,  334 => 110,  286 => 173,  205 => 64,  297 => 92,  218 => 81,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 290,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 296,  787 => 419,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 259,  740 => 239,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 251,  714 => 250,  711 => 249,  705 => 248,  701 => 261,  690 => 228,  687 => 246,  671 => 262,  669 => 219,  653 => 232,  634 => 224,  628 => 372,  621 => 220,  609 => 216,  602 => 206,  591 => 289,  571 => 316,  499 => 154,  488 => 172,  389 => 318,  223 => 146,  14 => 2,  306 => 117,  303 => 181,  300 => 115,  292 => 86,  280 => 103,  12 => 36,  624 => 213,  620 => 223,  612 => 220,  601 => 328,  599 => 327,  580 => 194,  574 => 230,  559 => 311,  526 => 179,  497 => 173,  485 => 283,  463 => 271,  447 => 152,  404 => 238,  401 => 289,  391 => 222,  369 => 129,  333 => 132,  329 => 275,  307 => 96,  287 => 58,  195 => 131,  178 => 123,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 265,  807 => 259,  805 => 426,  802 => 425,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 211,  717 => 210,  713 => 209,  700 => 205,  679 => 368,  673 => 221,  668 => 197,  663 => 195,  660 => 194,  657 => 193,  650 => 356,  647 => 355,  644 => 190,  632 => 349,  629 => 186,  626 => 221,  603 => 362,  600 => 178,  594 => 212,  588 => 175,  584 => 173,  570 => 186,  561 => 168,  554 => 224,  551 => 101,  546 => 175,  522 => 156,  513 => 79,  479 => 135,  468 => 163,  451 => 307,  448 => 306,  424 => 249,  418 => 112,  410 => 236,  376 => 224,  373 => 152,  340 => 200,  326 => 256,  261 => 76,  118 => 49,  200 => 95,  1402 => 419,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 410,  1368 => 409,  1355 => 403,  1349 => 401,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 394,  1324 => 393,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 380,  1287 => 379,  1283 => 378,  1279 => 377,  1273 => 376,  1271 => 375,  1268 => 374,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 343,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 328,  1154 => 327,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 298,  1056 => 543,  1053 => 292,  1051 => 291,  1048 => 290,  1040 => 536,  1036 => 534,  1032 => 283,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 260,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 251,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 282,  889 => 224,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 272,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 190,  809 => 189,  798 => 255,  796 => 422,  793 => 421,  785 => 232,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 165,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 154,  721 => 258,  712 => 231,  710 => 149,  707 => 208,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 134,  675 => 132,  662 => 217,  658 => 124,  654 => 357,  649 => 122,  643 => 227,  640 => 226,  638 => 351,  617 => 112,  614 => 367,  598 => 107,  593 => 358,  576 => 101,  564 => 162,  557 => 310,  550 => 94,  527 => 296,  515 => 305,  512 => 290,  509 => 228,  503 => 81,  496 => 282,  493 => 155,  478 => 204,  467 => 197,  456 => 309,  450 => 114,  414 => 242,  408 => 239,  388 => 231,  371 => 216,  363 => 32,  350 => 142,  342 => 282,  335 => 198,  316 => 16,  290 => 110,  276 => 102,  266 => 83,  263 => 81,  255 => 185,  245 => 122,  207 => 137,  194 => 106,  184 => 65,  76 => 21,  810 => 238,  804 => 260,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 399,  743 => 240,  735 => 238,  732 => 234,  715 => 151,  698 => 259,  693 => 248,  688 => 372,  685 => 371,  682 => 226,  672 => 223,  670 => 365,  665 => 362,  648 => 219,  627 => 206,  622 => 369,  619 => 212,  616 => 202,  613 => 210,  610 => 332,  608 => 197,  605 => 207,  596 => 106,  592 => 325,  587 => 197,  585 => 196,  582 => 190,  578 => 178,  572 => 204,  566 => 212,  547 => 93,  545 => 228,  542 => 227,  533 => 186,  531 => 95,  507 => 287,  505 => 214,  502 => 175,  477 => 164,  471 => 164,  465 => 161,  454 => 265,  446 => 156,  443 => 256,  431 => 251,  428 => 250,  425 => 247,  422 => 338,  412 => 147,  406 => 111,  390 => 139,  383 => 220,  377 => 73,  375 => 218,  372 => 277,  370 => 222,  359 => 145,  356 => 269,  353 => 143,  349 => 119,  336 => 205,  332 => 259,  330 => 554,  318 => 187,  313 => 209,  291 => 108,  190 => 129,  321 => 254,  295 => 201,  274 => 167,  242 => 153,  236 => 177,  70 => 26,  170 => 230,  288 => 197,  284 => 89,  279 => 193,  275 => 227,  256 => 80,  250 => 73,  237 => 75,  232 => 136,  222 => 129,  191 => 55,  153 => 110,  150 => 46,  563 => 188,  560 => 187,  558 => 186,  553 => 309,  549 => 182,  543 => 179,  537 => 176,  532 => 223,  528 => 173,  525 => 311,  523 => 171,  518 => 292,  514 => 218,  511 => 217,  508 => 165,  501 => 212,  491 => 157,  487 => 156,  460 => 194,  455 => 141,  449 => 263,  442 => 259,  439 => 133,  436 => 183,  433 => 130,  426 => 126,  420 => 297,  415 => 121,  411 => 170,  405 => 118,  403 => 117,  380 => 107,  366 => 214,  354 => 101,  331 => 96,  325 => 94,  320 => 100,  317 => 99,  311 => 98,  308 => 183,  304 => 95,  272 => 81,  267 => 130,  249 => 78,  216 => 68,  155 => 43,  146 => 40,  126 => 13,  188 => 54,  181 => 107,  161 => 45,  110 => 72,  124 => 44,  692 => 373,  683 => 282,  678 => 279,  676 => 367,  666 => 126,  661 => 380,  656 => 358,  652 => 376,  645 => 215,  641 => 352,  635 => 376,  631 => 218,  625 => 361,  615 => 335,  607 => 363,  597 => 359,  590 => 202,  583 => 354,  579 => 353,  577 => 319,  575 => 352,  569 => 213,  565 => 324,  555 => 185,  548 => 188,  540 => 99,  536 => 299,  529 => 222,  524 => 90,  516 => 291,  510 => 78,  504 => 296,  500 => 88,  495 => 210,  490 => 154,  486 => 165,  482 => 317,  470 => 313,  464 => 196,  459 => 270,  452 => 191,  434 => 252,  421 => 90,  417 => 296,  400 => 116,  385 => 129,  361 => 207,  344 => 201,  339 => 137,  324 => 102,  310 => 208,  302 => 93,  296 => 92,  282 => 104,  259 => 161,  244 => 82,  231 => 67,  226 => 147,  215 => 63,  186 => 53,  152 => 54,  114 => 40,  104 => 31,  358 => 209,  351 => 205,  347 => 210,  343 => 264,  338 => 109,  327 => 108,  323 => 522,  319 => 124,  315 => 121,  301 => 94,  299 => 201,  293 => 177,  289 => 91,  281 => 171,  277 => 86,  271 => 84,  265 => 82,  262 => 187,  260 => 128,  257 => 53,  251 => 182,  248 => 155,  239 => 152,  228 => 75,  225 => 65,  213 => 62,  211 => 156,  197 => 113,  174 => 59,  148 => 108,  134 => 48,  127 => 40,  20 => 1,  270 => 85,  253 => 78,  233 => 66,  212 => 139,  210 => 61,  206 => 109,  202 => 135,  198 => 57,  192 => 55,  185 => 127,  180 => 49,  175 => 47,  172 => 59,  167 => 44,  165 => 83,  160 => 56,  137 => 49,  113 => 37,  100 => 37,  90 => 33,  81 => 27,  65 => 24,  129 => 46,  97 => 26,  77 => 26,  34 => 4,  53 => 10,  84 => 26,  58 => 12,  23 => 2,  480 => 205,  474 => 274,  469 => 271,  461 => 70,  457 => 124,  453 => 151,  444 => 185,  440 => 184,  437 => 253,  435 => 344,  430 => 153,  427 => 180,  423 => 298,  413 => 237,  409 => 327,  407 => 169,  402 => 166,  398 => 226,  393 => 162,  387 => 221,  384 => 230,  381 => 315,  379 => 219,  374 => 36,  368 => 215,  365 => 119,  362 => 146,  360 => 216,  355 => 27,  341 => 138,  337 => 97,  322 => 188,  314 => 186,  312 => 97,  309 => 118,  305 => 204,  298 => 179,  294 => 100,  285 => 105,  283 => 5,  278 => 110,  268 => 101,  264 => 163,  258 => 75,  252 => 157,  247 => 72,  241 => 179,  229 => 148,  220 => 171,  214 => 58,  177 => 55,  169 => 48,  140 => 50,  132 => 35,  128 => 41,  107 => 71,  61 => 13,  273 => 190,  269 => 165,  254 => 86,  243 => 77,  240 => 76,  238 => 79,  235 => 150,  230 => 72,  227 => 69,  224 => 74,  221 => 145,  219 => 60,  217 => 64,  208 => 65,  204 => 63,  179 => 50,  159 => 40,  143 => 52,  135 => 36,  119 => 38,  102 => 27,  71 => 19,  67 => 25,  63 => 15,  59 => 13,  28 => 3,  94 => 35,  89 => 24,  85 => 31,  75 => 77,  68 => 16,  56 => 12,  87 => 27,  201 => 115,  196 => 61,  183 => 55,  171 => 63,  166 => 47,  163 => 117,  158 => 44,  156 => 55,  151 => 1,  142 => 67,  138 => 87,  136 => 102,  121 => 90,  117 => 31,  105 => 37,  91 => 31,  62 => 23,  49 => 10,  25 => 5,  21 => 2,  31 => 8,  38 => 7,  26 => 2,  24 => 3,  19 => 1,  93 => 28,  88 => 40,  78 => 19,  46 => 7,  44 => 8,  27 => 6,  79 => 21,  72 => 46,  69 => 18,  47 => 7,  40 => 11,  37 => 5,  22 => 4,  246 => 78,  157 => 49,  145 => 68,  139 => 52,  131 => 47,  123 => 33,  120 => 32,  115 => 87,  111 => 32,  108 => 37,  101 => 31,  98 => 40,  96 => 34,  83 => 23,  74 => 20,  66 => 16,  55 => 10,  52 => 11,  50 => 10,  43 => 6,  41 => 7,  35 => 9,  32 => 2,  29 => 3,  209 => 157,  203 => 59,  199 => 62,  193 => 56,  189 => 65,  187 => 58,  182 => 64,  176 => 49,  173 => 121,  168 => 119,  164 => 57,  162 => 102,  154 => 48,  149 => 41,  147 => 45,  144 => 49,  141 => 104,  133 => 43,  130 => 40,  125 => 78,  122 => 39,  116 => 37,  112 => 89,  109 => 33,  106 => 81,  103 => 49,  99 => 35,  95 => 29,  92 => 37,  86 => 29,  82 => 37,  80 => 24,  73 => 23,  64 => 16,  60 => 15,  57 => 20,  54 => 14,  51 => 22,  48 => 9,  45 => 7,  42 => 8,  39 => 4,  36 => 4,  33 => 3,  30 => 7,);
    }
}
