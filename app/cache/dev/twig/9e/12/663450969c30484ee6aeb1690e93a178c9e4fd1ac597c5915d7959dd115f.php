<?php

/* MinsalCitasBundle:CitasMedicas:asignar.html.twig */
class __TwigTemplate_9e12663450969c30484ee6aeb1690e93a178c9e4fd1ac597c5915d7959dd115f extends Twig_Template
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
        // line 3
        $context["idAreaModEstab"] = (((isset($context["idAreaModEstab"]) ? $context["idAreaModEstab"] : $this->getContext($context, "idAreaModEstab"))) ? ((isset($context["idAreaModEstab"]) ? $context["idAreaModEstab"] : $this->getContext($context, "idAreaModEstab"))) : ("1"));
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalsiaps/css/MntExpediente/list.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 9
    public function block_javascripts($context, array $blocks = array())
    {
        // line 10
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script type=\"text/javascript\">
    \$(document).ready(function () {
        var idExpediente=\$('#numExpNomPac');
        var idAreaModEstab = \$('#idAreaModEstab');
        var idAtenAreaModEstab = \$('#idAtenAreaModEstab');
        var idEmpleado = \$('#idEmpleado');
        var idTipocita = \$('#idTipocita');
        var fecha = \$('#fecha');
        var cantidadDias = \$('#cantidadDias');
        var metodoAsignacion=\$(\"#metodoAsignacion\");
        var idEstablecimientoReferencia=\$('#idEstablecimientoReferencia');
        var numeroExpedienteReferencia=\$('#numeroExpedienteReferencia');
        var idTipoDistribucion=\$('#idTipoDistribucion');

        var incluirAgregados = \$('input[id\$=\"incluirAgregados\"]');
        initializeSwitchOnOff(incluirAgregados, 'Sí', 'No');
        var citaIntegral = \$('input[id\$=\"citaIntegral\"]');
        initializeSwitchOnOff(citaIntegral, 'Sí', 'No');
        var buscarSinTipoCita = \$('input[id\$=\"buscarSinTipoCita\"]');
        initializeSwitchOnOff(buscarSinTipoCita, 'Sí', 'No');


        metodoAsignacion.select2('val','1');
        cantidadDias.numeric();

        initializeSelect2(idTipocita, true, false, {
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        initializeSelect2(idTipoDistribucion, true, true, {
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });


        initializeSelect2(idAreaModEstab, true, false, {
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        initializeSelect2(idAtenAreaModEstab, true, true, {
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });
        initializeSelect2(idEmpleado, true, true, {
            placeholder: 'Seleccionar...',
            allowClear: true,
            width: '100%'
        });

        initExpedienteMedicoSearch(idExpediente,'Seleccionar...');
        function initExpedienteMedicoSearch(element, placeholder){
            element.select2({
                allowClear: true,
                placeholder: placeholder,
                minimumInputLength: 1,
                dropdownAutoWidth: true,
                ajax: {
                    url: Routing.generate('citasexpedientepaciente'),
                    dataType: 'json',
                    quietMillis: 1000,
                    data: function(term, page) {
                        return {
                            clue: term, //search term
                            page_limit: 10, // page size
                            page: page, // page number
                        };
                    },
                    results: function(data, page) {
                        var more = (page * 10) < data.data2;
                        return {results: data.data1, more: more};
                    }
                },
                initSelection: function(element, callback) {
                    // the input tag has a value attribute preloaded that points to a preselected repository's id
                    // this function resolves that id attribute to an object that select2 can render
                    // using its formatResult renderer - that way the repository name is shown preselected
                    var id = element.val();
                    if (id !== \"\") {
                        \$.ajax(Routing.generate('citasexpedientepaciente') +'?id='+id, {
                            dataType: \"json\"
                        }).done(function(data) {
                            callback(data);
                            element.select2('data',{id: id,text: data.data1[0].text });
                        });
                    }
                }
            });
        }


        ";
        // line 107
        if ((!$this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method"))) {
            // line 108
            echo "            idAreaModEstab.select2('val',";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["idAreaModEstab"]) ? $context["idAreaModEstab"] : $this->getContext($context, "idAreaModEstab")), "getId", array(), "method"), "html", null, true);
            echo " );
            idAreaModEstab.parent().parent().hide();
            ";
            // line 110
            if ((!$this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SONATA_ADMIN_CITCITASDIA_CITAINTEGRAL"), "method"))) {
                // line 111
                echo "                citaIntegral.parent().parent().parent().parent().hide();
            ";
            }
            // line 113
            echo "            ";
            if ((!$this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SONATA_ADMIN_CITCITASDIA_EXCLUYENDO_TIPO_CITA"), "method"))) {
                // line 114
                echo "                buscarSinTipoCita.parent().parent().parent().parent().hide();
            ";
            }
            // line 116
            echo "        ";
        }
        // line 117
        echo "
        idAtenAreaModEstab.on('change', function () {
            idTipocita.select2('val','');
            idTipocita.trigger('change');
        });

        idExpediente.on('change', function () {
            if (\$(this).val()!='' && idAreaModEstab.val()!='') {
                \$.ajax({
                    url: Routing.generate(\"obtener_cantidad_citas_expediente\", {'idExpediente': \$(this).val(),'idAreaModEstab':idAreaModEstab.val()}),
                    async: false,
                    dataType: 'json',
                    success: function (data) {

                        initializeSelect2(idAtenAreaModEstab, true, true, {
                            placeholder: 'Seleccionar...',
                            allowClear: true,
                            width: '100%'
                        });
                        idTipocita.select2('val');
                        incluirAgregados.iCheck('unCheck');
                        citaIntegral.iCheck('unCheck');
                        buscarSinTipoCita.iCheck('unCheck');

                        \$.each(data.resultados, function (indice, val) {
                          if (val.cuantas > 0){
                            if(val.tipoDistribucionCita==0){
                                idAtenAreaModEstab.append(\$('<option>', {value: val.id, text: val.text+' --- Posee cita en esta especialidad'}));
                                \$('#idAtenAreaModEstab option[value=\"'+val.id+'\"]').attr('disabled','disabled');
                            }else if (val.tipoDistribucionCita==1 && val.idTipoDistribucion=='cn') {
                                idAtenAreaModEstab.append(\$('<option>', {value: val.id, text: val.text+' --- Posee cita normal en esta especialidad'}));
                                \$('#idAtenAreaModEstab option[value=\"'+val.id+'\"]').attr('idtipodistribucioncita',val.idTipoDistribucion);
                            }else{
                                idAtenAreaModEstab.append(\$('<option>', {value: val.id, text: val.text+' --- Posee cita en esta especialidad con tipo distribucion'}));
                                \$('#idAtenAreaModEstab option[value=\"'+val.id+'\"]').attr('idtipodistribucioncita',val.idTipoDistribucion);
                            }
                          }else{
                            idAtenAreaModEstab.append(\$('<option>', {value: val.id, text: val.text}));
                            \$('#idAtenAreaModEstab option[value=\"'+val.id+'\"]').attr('idtipodistribucioncita','na');
                          }
                        });
                    }
                });
            } else {
                initializeSelect2(idAtenAreaModEstab, true, true, {
                    placeholder: 'Seleccionar...',
                    allowClear: true,
                    width: '100%'
                });
                initializeSelect2(idEmpleado, true, true, {
                    placeholder: 'Seleccionar...',
                    allowClear: true,
                    width: '100%'
                });
                initializeSelect2(idTipoDistribucion, true, true, {
                    placeholder: 'Seleccionar...',
                    allowClear: true,
                    width: '100%'
                });
                idTipocita.select2('val','');
                incluirAgregados.iCheck('unCheck');
                citaIntegral.iCheck('unCheck');
                buscarSinTipoCita.iCheck('unCheck');
            }
        });

        idTipocita.on('change', function () {
            if (\$(this).val()!='' && idAtenAreaModEstab != '') {
                \$.ajax({
                    url: Routing.generate(\"obtener_medicos_tipocita_especialidad\", {'idAtenAreaModEstab': idAtenAreaModEstab.val(),'idTipocita':\$(this).val(),
                    'idTipoDistribucionCita':\$('#idAtenAreaModEstab option[value=\"'+idAtenAreaModEstab.val()+'\"]').attr('idtipodistribucioncita')}),
                    async: false,
                    dataType: 'json',
                    success: function (data) {

                        initializeSelect2(idEmpleado, true, true, {
                            placeholder: 'Seleccionar...',
                            allowClear: true,
                            width: '100%'
                        });
                        initializeSelect2(idTipoDistribucion, true, true, {
                            placeholder: 'Seleccionar...',
                            allowClear: true,
                            width: '100%'
                        });

                        \$.each(data.resultados, function (indice, val) {
                            idEmpleado.append(\$('<option>', {value: val.id, text: val.text}));
                        });
                    }
                });
            } else {
                initializeSelect2(idEmpleado, true, true, {
                    placeholder: 'Seleccionar...',
                    allowClear: true,
                    width: '100%'
                });
                initializeSelect2(idTipoDistribucion, true, true, {
                    placeholder: 'Seleccionar...',
                    allowClear: true,
                    width: '100%'
                });
                incluirAgregados.iCheck('unCheck');
                citaIntegral.iCheck('unCheck');
                buscarSinTipoCita.iCheck('unCheck');
            }
        });

        metodoAsignacion.on('change',function(){
            if(metodoAsignacion.select2('val')==1){
                cantidadDias.removeAttr('readonly');
            }else{
                cantidadDias.attr('readonly','readonly');
            }
        });


        cantidadDias.on('focusout',function(){
            var fechaABuscar=calcularFecha(\$(this).val());
            fecha.val(fechaABuscar);
        });

        function calcularFecha(diasSumar){
            var calculada=moment().add(diasSumar,'day');

            switch (calculada.days()) {
                case 0:
                    calculada.add(1,'day');
                case 6:
                    calculada.add(2,'day');
                    break;
            }
            return calculada.format('DD/MM/YYYY');
        }

        idEmpleado.on('change',function(){
            initializeSelect2(idTipoDistribucion, true, true, {
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            });
            if (\$(this).select2('val')!=''){
                  \$.ajax({
                      url: Routing.generate(\"obtener_tipodistribucion_medico\", {'idAtenAreaModEstab': idAtenAreaModEstab.select2('val'),'idEmpleado':\$(this).select2('val'),
                      'idTipoDistribucionCita':\$('#idAtenAreaModEstab option[value=\"'+idAtenAreaModEstab.val()+'\"]').attr('idtipodistribucioncita')}),
                      async: false,
                      dataType: 'json',
                      success: function (data) {
                        if(data.resultados.length==1){
                            \$.each(data.resultados, function (indice, val) {
                                idTipoDistribucion.append(\$('<option>', {value: val.id, text: val.text}));
                                idTipoDistribucion.select2('val',val.id);
                            });
                        }else{
                            \$.each(data.resultados, function (indice, val) {
                                idTipoDistribucion.append(\$('<option>', {value: val.id, text: val.text}));
                            });
                        }
                      }
                  });
              }
        });

        window.cargarCuposDisponibles=function(){
            var html='';
            var fechaActual=moment().format('DD/MM/YYYY');
            var fechaElemento=moment(fecha.val(),'DD/MM/YYYY');
            \$('.modal-body').waitMe({'effect':'bounce', 'text' : 'Cargando...'});

            if(fecha.val() !='' && idEmpleado.select2('val')!='' && idAtenAreaModEstab.select2('val')!='' && idTipocita.select2('val')!='' && idExpediente.select2('val')!='' ){
                    if (fechaElemento<fechaActual){
                     html+='<div class=\"alert alert-danger\" role=\"alert\">\\
                             <p>La fecha debe ser mayor que la fecha actual</p>\\
                            </div>';
                            \$('.modal-body').waitMe('hide');
                     }else{
                      html='<div id=\"cargar\"></div>'
                    }
                }else{
                    html+='<div class=\"alert alert-danger\" role=\"alert\">\\
                            <p>Debe seleccionar todos los campos requeridos para poder buscar un cupo disponible</p>\\
                           </div>';
                           \$('.modal-body').waitMe('hide');
                }

            return html;

        }

        \$('#limpiar').on('click', function(){
            idExpediente.select2('val','');
            idTipocita.select2('val','');


            initializeSelect2(idAtenAreaModEstab, true, true, {
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            });
            initializeSelect2(idEmpleado, true, true, {
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            });
            initializeSelect2(idTipoDistribucion, true, true, {
                placeholder: 'Seleccionar...',
                allowClear: true,
                width: '100%'
            });
            \$('#fecha').val('');
            \$('#cantidadDias').val('');
            \$('#idEstablecimientoReferencia').val('');
            \$('#numeroExpedienteReferencia').val('');
            \$('#valor1').iCheck('check');
            incluirAgregados.iCheck('unCheck');
            citaIntegral.iCheck('unCheck');
            buscarSinTipoCita.iCheck('unCheck');
            idExpediente.select2('open');
        });

        ";
        // line 337
        if (((isset($context["idExpediente"]) ? $context["idExpediente"] : $this->getContext($context, "idExpediente")) != "")) {
            // line 338
            echo "            idExpediente.select2('val',";
            echo twig_escape_filter($this->env, (isset($context["idExpediente"]) ? $context["idExpediente"] : $this->getContext($context, "idExpediente")), "html", null, true);
            echo " );
            \$('#idEstablecimientoReferencia').val('";
            // line 339
            echo twig_escape_filter($this->env, (isset($context["idEstablecimientoReferencia"]) ? $context["idEstablecimientoReferencia"] : $this->getContext($context, "idEstablecimientoReferencia")), "html", null, true);
            echo "');
            \$('#numeroExpedienteReferencia').val('";
            // line 340
            echo twig_escape_filter($this->env, (isset($context["expedienteReferencia"]) ? $context["expedienteReferencia"] : $this->getContext($context, "expedienteReferencia")), "html", null, true);
            echo "');
            idExpediente.trigger('change');
        ";
        }
        // line 343
        echo "
        window.cargarAcciones=function(){
            var fechaFinal='NULL';
            \$('#otroExpediente').hide();

            if(fecha.val()==moment().format('DD/MM/YYYY')){
                fechaFinal=fecha.val();
            }

            \$('#cargar').load(Routing.generate(\"obtener_cupos_citas\",
                    {'idEspecialidad' : idAtenAreaModEstab.select2('val'),
                    'idProcedimientoEstablecimiento':'NULL',
                    'idEstablecimientoReferencia': idEstablecimientoReferencia.val(),
                    'idTipoCita'     : idTipocita.select2('val'),
                    'idExpediente'   : idExpediente.select2('val'),
                    'idEmpleado'     : idEmpleado.select2('val'),
                    'fechaInicial'   : fecha.val(),
                    'fechaFinal'     : fechaFinal,
                    'origenCita'     : 1,
                    'incluirAgregados'  : incluirAgregados.prop('checked'),
                    'autoSeleccionarHorario' : 'FALSE',
                    'idAreaModEstab': idAreaModEstab.select2('val'),
                    'citaIntegral': citaIntegral.prop('checked'),
                    'numeroExpedienteReferencia': numeroExpedienteReferencia.val(),
                    'idTipoDistribucion':idTipoDistribucion.select2('val'),
                    'buscarSinTipoCita':buscarSinTipoCita.prop('checked')
                }),
                function( response, status, xhr ) {
                    \$('.modal-body').waitMe('hide');
                    if(status!= 'error'){
                        \$('body select[id^=\"justificacion_\"]').each(function(){
                            initializeSelect2(\$(this), true, false, {
                                placeholder: 'Seleccionar...',
                                allowClear: true,
                                width: '100%'
                            });
                        });
                    }
                }
            );

            \$('#otroExpediente').on('click',function(){
                var otraVez=idExpediente.select2('val');
                \$('#limpiar').trigger('click');
                idExpediente.select2('val', otraVez);
                idExpediente.select2('close');
                idExpediente.trigger('change');
                idAtenAreaModEstab.select2('open');
            });



            \$('#cerrar').on('click',function(){
                \$('#limpiar').trigger('click');
            });
        }
    });
    var modal_elements=[];
    var parametros=[];
    var footer=''
    var footer='<button id=\"cerrar\" data-dismiss=\"modal\" class=\"btn btn-success\"><span class=\"label\"><span class=\"glyphicon glyphicon-minus-sign\"></span>&nbsp; Cerrar y Limpiar</span></button>';
    footer+='<button id=\"cancelar\" data-dismiss=\"modal\" class=\"btn btn-default\">Cancelar</button>'
    footer+='<button id=\"otroExpediente\" data-dismiss=\"modal\" class=\"btn btn-default\">Otra cita con el mismo número</button>'
    modal_elements.push({
        id: 'buscar_modal',
        func: 'cargarCuposDisponibles',
        header: 'Detalle de cupos disponibles',
        footer: footer,
        closeBtnName:'Cancelar',
        afterLoadCallFunction:'cargarAcciones',
        widthModal: '50%',
        maxWidth: '750px',
        parameters: parametros,
        closeBtn: false,
        closeXBtn:false
    });

    </script>
";
    }

    // line 423
    public function block_notice($context, array $blocks = array())
    {
        // line 424
        $this->env->loadTemplate("SonataCoreBundle:FlashMessage:render.html.twig")->display($context);
    }

    // line 427
    public function block_list_table($context, array $blocks = array())
    {
        // line 429
        echo "<div class=\"container-fluid\">
    <div class=\"row\">

        <form id=\"formDistribucion\" method=\"post\" >
            <div class=\"col-md-7 col-md-offset-2\">
                <h2 class=\"text-center\">Asignar Cita Médica</h2>
                <img src=\"";
        // line 435
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsalcitas/imagenes/BuscarCita.png"), "html", null, true);
        echo "\" alt=\"imagen_buscar\" style=\"width: 100px; margin: 20px auto; display:block;\" />
                <table class=\"table table-bordered\">
                    <tbody>
                      <tr>
                          <th style=\"width: 300px;\">Área a la que pertenece la especialidad:</th>
                          <td><select id=\"idAreaModEstab\" name=\"idAreaModEstab\" style=\"width:400px !important;\">
                              ";
        // line 441
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["areas"]) ? $context["areas"] : $this->getContext($context, "areas")));
        foreach ($context['_seq'] as $context["_key"] => $context["area"]) {
            // line 442
            echo "                              <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "id"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["area"]) ? $context["area"] : $this->getContext($context, "area")), "html", null, true);
            echo "</option>
                              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['area'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 444
        echo "                          </select></td>
                      </tr>
                      <tr>
                        <th>No. Expediente - Nombre Paciente *: </th>
                        <td><input type=\"hidden\" id=\"numExpNomPac\" name=\"numExpNomPac\" style=\"width:400px !important;\"></input></td>
                      </tr>
                        <tr>
                            <th>Especialidad *:
                                <span class=\"glyphicon glyphicon-info-sign fd_help_msg\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Si la especialidad se encuentra deshabilitada es porque ese paciente ya posee cita en esa especialidad.\"></span>
                            </th>
                            <td><select id=\"idAtenAreaModEstab\" name=\"idAtenAreaModEstab\" style=\"width:400px !important;\"></select></input></td>
                        </tr>
                        <tr>
                            <th>Tipo de Cita *:</th>
                            <td><select id=\"idTipocita\" name=\"idTipocita\" style=\"width:400px !important;\">
                              <option value=\"1\">Primera Vez</option>
                              <option value=\"2\">Subsecuente</option>
                            </select></input></td>
                        </tr>
                        <tr>
                            <th>Médico*:</th>
                            <td><select id=\"idEmpleado\" name=\"idEmpleado\" style=\"width:400px !important;\"></select></td>
                        </tr>
                        <tr>
                            <th>Tipo Distribucion*:</th>
                            <td><select id=\"idTipoDistribucion\" name=\"idTipoDistribucion\" style=\"width:400px !important;\"></select></td>
                        </tr>
                        <tr>
                            <th>Método de Asignación*:</th>
                            <td>
                                <select id=\"metodoAsignacion\" name=\"metodoAsignacion\" style=\"width:400px !important;\">
                                  <option value=\"1\">Por número de días</option>
                                  <option value=\"2\">Por Fecha</option>
                              </select>
                              </td>
                        </tr>
                        <tr>
                            <th>Cantidad de días(999):</th>
                            <td><input id=\"cantidadDias\" name=\"cantidadDias\" type=\"text\" class=\"form-control\" style=\"width: 50px !important;\" />
                            </td>
                        </tr>
                        <tr>
                            <th>Fecha a buscar cupo:</th>
                            <td>
                              <input id=\"fecha\" name=\"fecha\" type=\"text\" class=\"form-control bootstrap-datepicker\" placeholder=\"dd/mm/aaaa\" data-mask=\"99/99/9999\" style=\"width: 125px !important;\" data-date-start-date=\"";
        // line 488
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d/m/Y"), "html", null, true);
        echo "\"  />
                            </td>
                        </tr>
                        <tr>
                            <th>Buscar cupo sin importar tipo de cita:
                                <span class=\"glyphicon glyphicon-info-sign fd_help_msg\"
                                        data-toggle=\"tooltip\" data-placement=\"right\"
                                        title=\"Buscará fecha libre en el total de cupos asignado al médico \">
                                </span>
                            </th>
                            <td><input id=\"buscarSinTipoCita\" type=\"checkbox\"/></td>
                        </tr>
                        <tr>
                            <th>Incluir Cupos de Agregados:</th>
                            <td><input id=\"incluirAgregados\" type=\"checkbox\"/></td>
                        </tr>
                        <tr>
                            <th>Cita Integral:
                                <span class=\"glyphicon glyphicon-info-sign fd_help_msg\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Cita Integral aplica cuando a un paciente se le quieren dar cita en más de una especialidad el mismo día.\"></span>
                            </th>
                            <td><input id=\"citaIntegral\" type=\"checkbox\"/></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <input type=\"hidden\" id=\"idEstablecimientoReferencia\" value=\"\"/>
            <input type=\"hidden\" id=\"numeroExpedienteReferencia\" value=\"\"/>
        </form>
    </div>
    <div class=\"row\">
        <div class=\"col-md-7 col-md-offset-2\">
            <center>
                <a href=\"#myModal\" id=\"buscar_modal\" custom-modal=\"true\" role=\"button\" data-backdrop=\"static\" data-keyboard=\"false\" data-toggle=\"modal\" style=\"width: 160px; margin-top: 5px;\" class=\"btn btn-primary\"><i class=\"fa fa-list-alt\"></i><strong>&nbsp; Buscar Cupo</strong></a>
                <a id=\"limpiar\" style=\"width: 160px; margin-top: 5px;\" class=\"btn btn-info\" href=\"#\"><i class=\"fa fa-trash-o\"></i><strong>&nbsp; Limpiar</strong></a>
            </center>
        </div>
    </div>
    <br/>
    <div class=\"row\">
        <div id=\"resultado\" class=\"col-md-10 center-block\">
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "MinsalCitasBundle:CitasMedicas:asignar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1720 => 1573,  1668 => 1510,  1659 => 1504,  1655 => 1503,  1649 => 1502,  1641 => 1497,  1637 => 1496,  1620 => 1484,  1613 => 1480,  1609 => 1479,  1594 => 1472,  1590 => 1471,  1571 => 1457,  1564 => 1453,  1560 => 1452,  1545 => 1445,  1525 => 1430,  1407 => 1319,  1387 => 1309,  1359 => 1288,  990 => 922,  1673 => 1259,  1670 => 1258,  1663 => 1316,  1635 => 1290,  1632 => 1289,  1629 => 1288,  1622 => 1283,  1617 => 1281,  1614 => 1280,  1611 => 1279,  1606 => 1277,  1601 => 1476,  1598 => 1274,  1595 => 1273,  1588 => 1268,  1586 => 1267,  1582 => 1265,  1572 => 1262,  1566 => 1260,  1563 => 1258,  1557 => 1256,  1555 => 1255,  1552 => 1449,  1549 => 1253,  1541 => 1444,  1532 => 1247,  1527 => 1246,  1522 => 1429,  1519 => 1244,  1514 => 1243,  1511 => 1242,  1504 => 1237,  1492 => 1230,  1487 => 1227,  1485 => 1226,  1477 => 1220,  1475 => 1219,  1333 => 1084,  1320 => 1073,  1313 => 1070,  1306 => 1067,  1304 => 1066,  1301 => 1065,  1296 => 1063,  1280 => 1058,  1277 => 1057,  1274 => 1056,  1266 => 1053,  1217 => 1011,  1186 => 989,  874 => 697,  803 => 630,  606 => 447,  691 => 492,  655 => 481,  484 => 412,  552 => 439,  709 => 255,  397 => 337,  392 => 251,  1577 => 1107,  1574 => 1106,  1569 => 1261,  1567 => 1106,  1460 => 1001,  1454 => 997,  1444 => 993,  1437 => 989,  1433 => 988,  1429 => 987,  1425 => 986,  1421 => 985,  1415 => 982,  1409 => 978,  1405 => 977,  1391 => 965,  1389 => 964,  1367 => 946,  1356 => 944,  1352 => 943,  1347 => 941,  1321 => 923,  1318 => 922,  1316 => 1071,  1289 => 1061,  1286 => 1060,  1281 => 893,  1270 => 886,  1261 => 883,  1255 => 882,  1244 => 880,  1234 => 879,  1227 => 878,  1222 => 877,  1220 => 876,  1207 => 865,  1199 => 859,  1188 => 857,  1184 => 988,  1163 => 839,  1160 => 838,  1152 => 835,  1136 => 823,  1133 => 822,  1130 => 821,  1127 => 820,  1125 => 819,  1081 => 777,  1078 => 776,  1060 => 767,  1052 => 764,  1045 => 762,  1042 => 761,  1037 => 759,  992 => 720,  962 => 697,  960 => 696,  944 => 686,  893 => 640,  847 => 603,  829 => 591,  664 => 408,  623 => 234,  494 => 181,  462 => 168,  445 => 279,  419 => 293,  639 => 468,  611 => 386,  538 => 444,  646 => 307,  642 => 286,  544 => 434,  541 => 204,  517 => 192,  797 => 489,  752 => 533,  748 => 458,  681 => 412,  677 => 411,  630 => 181,  618 => 172,  535 => 430,  519 => 425,  416 => 221,  1082 => 552,  1076 => 775,  1072 => 548,  1069 => 771,  1066 => 546,  1058 => 544,  1049 => 540,  1046 => 539,  1033 => 533,  1030 => 532,  1018 => 528,  1015 => 527,  1013 => 526,  1010 => 525,  1007 => 524,  1002 => 519,  999 => 518,  995 => 516,  983 => 509,  977 => 507,  974 => 506,  968 => 503,  954 => 498,  948 => 494,  922 => 484,  916 => 480,  913 => 479,  911 => 478,  906 => 476,  896 => 469,  885 => 463,  882 => 462,  872 => 696,  867 => 456,  861 => 453,  858 => 452,  856 => 451,  852 => 605,  842 => 443,  836 => 595,  824 => 589,  781 => 416,  775 => 413,  762 => 540,  742 => 398,  737 => 395,  726 => 390,  722 => 389,  718 => 508,  708 => 381,  703 => 499,  674 => 248,  659 => 196,  636 => 234,  604 => 329,  581 => 387,  568 => 261,  539 => 203,  534 => 348,  530 => 428,  521 => 194,  489 => 179,  483 => 206,  394 => 217,  396 => 206,  345 => 189,  476 => 174,  386 => 162,  364 => 235,  234 => 158,  595 => 326,  589 => 267,  586 => 436,  562 => 505,  556 => 274,  506 => 429,  498 => 417,  492 => 274,  473 => 277,  458 => 121,  399 => 338,  352 => 219,  346 => 125,  328 => 179,  880 => 699,  837 => 274,  827 => 436,  823 => 268,  821 => 267,  818 => 433,  789 => 487,  758 => 405,  667 => 244,  573 => 516,  567 => 507,  520 => 247,  481 => 335,  475 => 275,  472 => 172,  466 => 227,  441 => 346,  438 => 189,  432 => 230,  429 => 222,  395 => 400,  382 => 248,  378 => 211,  367 => 115,  357 => 222,  348 => 190,  334 => 207,  286 => 169,  205 => 106,  297 => 189,  218 => 108,  940 => 351,  932 => 488,  926 => 485,  924 => 341,  908 => 334,  902 => 331,  899 => 330,  891 => 466,  888 => 326,  883 => 700,  875 => 286,  869 => 313,  866 => 312,  843 => 278,  839 => 306,  813 => 264,  811 => 429,  808 => 494,  787 => 561,  784 => 293,  782 => 292,  779 => 291,  776 => 290,  763 => 245,  754 => 266,  747 => 260,  744 => 457,  740 => 456,  734 => 254,  731 => 392,  728 => 391,  725 => 251,  719 => 257,  716 => 438,  714 => 250,  711 => 540,  705 => 539,  701 => 261,  690 => 302,  687 => 301,  671 => 262,  669 => 219,  653 => 239,  634 => 182,  628 => 232,  621 => 281,  609 => 273,  602 => 230,  591 => 439,  571 => 419,  499 => 424,  488 => 273,  389 => 235,  223 => 143,  14 => 2,  306 => 117,  303 => 159,  300 => 98,  292 => 95,  280 => 108,  12 => 36,  624 => 282,  620 => 223,  612 => 232,  601 => 379,  599 => 441,  580 => 265,  574 => 263,  559 => 504,  526 => 427,  497 => 173,  485 => 304,  463 => 143,  447 => 152,  404 => 339,  401 => 119,  391 => 216,  369 => 228,  333 => 95,  329 => 93,  307 => 192,  287 => 152,  195 => 140,  178 => 108,  956 => 271,  953 => 270,  946 => 302,  942 => 492,  933 => 296,  925 => 292,  917 => 291,  914 => 337,  912 => 336,  909 => 288,  901 => 285,  898 => 284,  890 => 281,  887 => 280,  879 => 317,  870 => 274,  868 => 273,  863 => 311,  853 => 261,  848 => 280,  840 => 253,  834 => 272,  832 => 271,  822 => 434,  820 => 243,  816 => 496,  807 => 259,  805 => 426,  802 => 569,  791 => 420,  788 => 233,  778 => 267,  773 => 289,  765 => 246,  760 => 222,  757 => 221,  738 => 214,  720 => 439,  717 => 210,  713 => 256,  700 => 205,  679 => 201,  673 => 487,  668 => 460,  663 => 484,  660 => 194,  657 => 482,  650 => 238,  647 => 237,  644 => 190,  632 => 233,  629 => 186,  626 => 221,  603 => 229,  600 => 178,  594 => 440,  588 => 372,  584 => 488,  570 => 149,  561 => 259,  554 => 500,  551 => 101,  546 => 175,  522 => 156,  513 => 244,  479 => 334,  468 => 163,  451 => 307,  448 => 195,  424 => 296,  418 => 222,  410 => 151,  376 => 109,  373 => 209,  340 => 209,  326 => 212,  261 => 138,  118 => 70,  200 => 119,  1402 => 1317,  1396 => 417,  1390 => 415,  1388 => 414,  1386 => 413,  1382 => 412,  1373 => 411,  1371 => 948,  1368 => 409,  1355 => 403,  1349 => 942,  1343 => 399,  1341 => 398,  1339 => 397,  1335 => 396,  1329 => 395,  1327 => 925,  1324 => 924,  1311 => 387,  1305 => 385,  1299 => 383,  1297 => 382,  1295 => 381,  1291 => 1062,  1287 => 379,  1283 => 1059,  1279 => 377,  1273 => 887,  1271 => 1055,  1268 => 1054,  1256 => 369,  1251 => 368,  1249 => 367,  1246 => 366,  1237 => 360,  1231 => 358,  1228 => 357,  1223 => 356,  1221 => 355,  1218 => 354,  1211 => 349,  1202 => 347,  1198 => 346,  1195 => 345,  1192 => 344,  1190 => 991,  1187 => 342,  1179 => 338,  1177 => 337,  1174 => 336,  1168 => 332,  1162 => 330,  1159 => 329,  1157 => 837,  1154 => 836,  1145 => 322,  1143 => 321,  1118 => 320,  1115 => 319,  1112 => 318,  1109 => 317,  1106 => 316,  1103 => 315,  1100 => 314,  1098 => 313,  1095 => 312,  1088 => 308,  1084 => 307,  1079 => 551,  1077 => 305,  1074 => 304,  1067 => 299,  1064 => 768,  1056 => 766,  1053 => 292,  1051 => 291,  1048 => 763,  1040 => 536,  1036 => 534,  1032 => 757,  1029 => 282,  1027 => 281,  1024 => 530,  1016 => 276,  1014 => 272,  1012 => 271,  1009 => 270,  1004 => 266,  982 => 261,  979 => 712,  976 => 259,  973 => 258,  970 => 257,  967 => 256,  964 => 502,  961 => 254,  958 => 499,  955 => 252,  952 => 691,  950 => 269,  947 => 249,  939 => 243,  936 => 489,  934 => 241,  931 => 295,  923 => 236,  920 => 339,  918 => 234,  915 => 233,  903 => 286,  900 => 228,  897 => 329,  894 => 328,  892 => 703,  889 => 702,  881 => 278,  878 => 287,  876 => 460,  873 => 217,  865 => 615,  862 => 212,  860 => 268,  857 => 281,  849 => 310,  846 => 279,  844 => 204,  841 => 203,  833 => 439,  830 => 303,  828 => 246,  825 => 196,  817 => 192,  814 => 191,  812 => 495,  809 => 189,  798 => 255,  796 => 422,  793 => 563,  785 => 560,  783 => 177,  772 => 172,  769 => 171,  767 => 170,  764 => 169,  756 => 460,  753 => 220,  751 => 401,  739 => 156,  729 => 233,  724 => 258,  721 => 258,  712 => 437,  710 => 502,  707 => 501,  699 => 142,  697 => 375,  696 => 204,  695 => 230,  694 => 374,  689 => 137,  680 => 250,  675 => 199,  662 => 217,  658 => 241,  654 => 357,  649 => 308,  643 => 306,  640 => 226,  638 => 375,  617 => 112,  614 => 367,  598 => 107,  593 => 270,  576 => 517,  564 => 260,  557 => 501,  550 => 255,  527 => 442,  515 => 191,  512 => 423,  509 => 422,  503 => 427,  496 => 423,  493 => 415,  478 => 122,  467 => 145,  456 => 288,  450 => 281,  414 => 343,  408 => 340,  388 => 292,  371 => 136,  363 => 133,  350 => 191,  342 => 274,  335 => 182,  316 => 16,  290 => 154,  276 => 102,  266 => 180,  263 => 102,  255 => 87,  245 => 153,  207 => 104,  194 => 92,  184 => 118,  76 => 34,  810 => 238,  804 => 493,  801 => 256,  799 => 234,  795 => 256,  792 => 252,  780 => 303,  777 => 250,  774 => 249,  771 => 412,  768 => 247,  766 => 249,  761 => 247,  749 => 218,  746 => 530,  743 => 240,  735 => 238,  732 => 234,  715 => 507,  698 => 259,  693 => 248,  688 => 372,  685 => 491,  682 => 490,  672 => 247,  670 => 486,  665 => 362,  648 => 219,  627 => 236,  622 => 369,  619 => 212,  616 => 276,  613 => 275,  610 => 332,  608 => 231,  605 => 230,  596 => 106,  592 => 373,  587 => 197,  585 => 331,  582 => 216,  578 => 368,  572 => 204,  566 => 324,  547 => 435,  545 => 253,  542 => 156,  533 => 429,  531 => 154,  507 => 241,  505 => 214,  502 => 278,  477 => 232,  471 => 164,  465 => 169,  454 => 269,  446 => 163,  443 => 162,  431 => 251,  428 => 250,  425 => 156,  422 => 338,  412 => 152,  406 => 111,  390 => 164,  383 => 161,  377 => 246,  375 => 210,  372 => 234,  370 => 208,  359 => 204,  356 => 132,  353 => 131,  349 => 220,  336 => 272,  332 => 206,  330 => 122,  318 => 105,  313 => 119,  291 => 153,  190 => 98,  321 => 106,  295 => 154,  274 => 71,  242 => 118,  236 => 116,  70 => 19,  170 => 95,  288 => 176,  284 => 109,  279 => 134,  275 => 180,  256 => 171,  250 => 173,  237 => 129,  232 => 79,  222 => 123,  191 => 91,  153 => 108,  150 => 70,  563 => 188,  560 => 275,  558 => 195,  553 => 256,  549 => 438,  543 => 179,  537 => 176,  532 => 201,  528 => 199,  525 => 311,  523 => 441,  518 => 292,  514 => 435,  511 => 243,  508 => 188,  501 => 186,  491 => 288,  487 => 337,  460 => 240,  455 => 120,  449 => 164,  442 => 278,  439 => 133,  436 => 159,  433 => 185,  426 => 180,  420 => 220,  415 => 121,  411 => 174,  405 => 211,  403 => 149,  380 => 247,  366 => 285,  354 => 102,  331 => 198,  325 => 267,  320 => 265,  317 => 199,  311 => 262,  308 => 173,  304 => 191,  272 => 105,  267 => 91,  249 => 85,  216 => 146,  155 => 87,  146 => 69,  126 => 104,  188 => 119,  181 => 118,  161 => 111,  110 => 53,  124 => 80,  692 => 373,  683 => 282,  678 => 279,  676 => 488,  666 => 485,  661 => 407,  656 => 402,  652 => 376,  645 => 236,  641 => 352,  635 => 376,  631 => 463,  625 => 460,  615 => 453,  607 => 363,  597 => 163,  590 => 223,  583 => 435,  579 => 353,  577 => 420,  575 => 212,  569 => 514,  565 => 361,  555 => 257,  548 => 353,  540 => 252,  536 => 139,  529 => 222,  524 => 344,  516 => 424,  510 => 78,  504 => 145,  500 => 418,  495 => 416,  490 => 154,  486 => 178,  482 => 176,  470 => 244,  464 => 242,  459 => 289,  452 => 286,  434 => 158,  421 => 223,  417 => 219,  400 => 148,  385 => 203,  361 => 207,  344 => 127,  339 => 273,  324 => 102,  310 => 118,  302 => 115,  296 => 96,  282 => 143,  259 => 151,  244 => 142,  231 => 123,  226 => 155,  215 => 107,  186 => 88,  152 => 103,  114 => 75,  104 => 50,  358 => 209,  351 => 130,  347 => 208,  343 => 188,  338 => 125,  327 => 203,  323 => 201,  319 => 176,  315 => 198,  301 => 204,  299 => 190,  293 => 111,  289 => 162,  281 => 182,  277 => 107,  271 => 157,  265 => 150,  262 => 68,  260 => 177,  257 => 137,  251 => 157,  248 => 139,  239 => 117,  228 => 156,  225 => 111,  213 => 70,  211 => 121,  197 => 118,  174 => 85,  148 => 70,  134 => 90,  127 => 57,  20 => 2,  270 => 150,  253 => 174,  233 => 127,  212 => 106,  210 => 103,  206 => 141,  202 => 114,  198 => 104,  192 => 120,  185 => 94,  180 => 118,  175 => 117,  172 => 116,  167 => 104,  165 => 113,  160 => 95,  137 => 65,  113 => 87,  100 => 42,  90 => 29,  81 => 34,  65 => 30,  129 => 82,  97 => 83,  77 => 24,  34 => 5,  53 => 13,  84 => 79,  58 => 18,  23 => 3,  480 => 175,  474 => 231,  469 => 228,  461 => 122,  457 => 306,  453 => 284,  444 => 185,  440 => 275,  437 => 274,  435 => 231,  430 => 287,  427 => 226,  423 => 256,  413 => 220,  409 => 219,  407 => 247,  402 => 210,  398 => 401,  393 => 296,  387 => 249,  384 => 214,  381 => 236,  379 => 110,  374 => 137,  368 => 207,  365 => 119,  362 => 234,  360 => 223,  355 => 280,  341 => 126,  337 => 201,  322 => 266,  314 => 162,  312 => 174,  309 => 100,  305 => 204,  298 => 165,  294 => 142,  285 => 175,  283 => 151,  278 => 142,  268 => 176,  264 => 179,  258 => 175,  252 => 136,  247 => 133,  241 => 163,  229 => 135,  220 => 72,  214 => 155,  177 => 117,  169 => 83,  140 => 67,  132 => 83,  128 => 62,  107 => 42,  61 => 71,  273 => 185,  269 => 104,  254 => 99,  243 => 152,  240 => 130,  238 => 140,  235 => 139,  230 => 114,  227 => 112,  224 => 124,  221 => 152,  219 => 128,  217 => 150,  208 => 132,  204 => 138,  179 => 112,  159 => 110,  143 => 68,  135 => 97,  119 => 90,  102 => 85,  71 => 21,  67 => 18,  63 => 72,  59 => 14,  28 => 3,  94 => 42,  89 => 41,  85 => 26,  75 => 76,  68 => 29,  56 => 69,  87 => 27,  201 => 118,  196 => 95,  183 => 211,  171 => 84,  166 => 98,  163 => 76,  158 => 104,  156 => 72,  151 => 107,  142 => 84,  138 => 65,  136 => 91,  121 => 58,  117 => 52,  105 => 51,  91 => 38,  62 => 15,  49 => 30,  25 => 4,  21 => 2,  31 => 4,  38 => 64,  26 => 6,  24 => 13,  19 => 5,  93 => 83,  88 => 80,  78 => 77,  46 => 25,  44 => 13,  27 => 14,  79 => 20,  72 => 75,  69 => 74,  47 => 9,  40 => 65,  37 => 7,  22 => 50,  246 => 134,  157 => 97,  145 => 90,  139 => 90,  131 => 63,  123 => 73,  120 => 56,  115 => 55,  111 => 48,  108 => 59,  101 => 47,  98 => 43,  96 => 84,  83 => 39,  74 => 28,  66 => 73,  55 => 27,  52 => 68,  50 => 10,  43 => 24,  41 => 6,  35 => 6,  32 => 15,  29 => 3,  209 => 147,  203 => 119,  199 => 94,  193 => 94,  189 => 116,  187 => 113,  182 => 68,  176 => 100,  173 => 65,  168 => 114,  164 => 97,  162 => 107,  154 => 101,  149 => 163,  147 => 91,  144 => 95,  141 => 2,  133 => 64,  130 => 97,  125 => 58,  122 => 91,  116 => 69,  112 => 53,  109 => 86,  106 => 47,  103 => 41,  99 => 84,  95 => 39,  92 => 81,  86 => 38,  82 => 36,  80 => 25,  73 => 21,  64 => 29,  60 => 29,  57 => 32,  54 => 13,  51 => 26,  48 => 67,  45 => 66,  42 => 9,  39 => 8,  36 => 5,  33 => 4,  30 => 5,);
    }
}
