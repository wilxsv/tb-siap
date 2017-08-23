<?php

/* MinsalLaboratorioBundle:Custom:SecSolicitudestudios/assign_exam.html.twig */
class __TwigTemplate_3e4855ec567d2977cdbc850c983bac2ce4ea9657da01857d149d512c5e49f66a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle:CRUD:action.html.twig");

        $this->blocks = array(
            'sonata_header' => array($this, 'block_sonata_header'),
            'actions' => array($this, 'block_actions'),
            'tab_menu' => array($this, 'block_tab_menu'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'content' => array($this, 'block_content'),
            'sonata_pre_fieldsets' => array($this, 'block_sonata_pre_fieldsets'),
            'sonata_tab_content' => array($this, 'block_sonata_tab_content'),
            'sonata_post_fieldsets' => array($this, 'block_sonata_post_fieldsets'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_sonata_header($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == false)) {
            // line 5
            echo "        ";
            $this->displayParentBlock("sonata_header", $context, $blocks);
            echo "
    ";
        }
    }

    // line 9
    public function block_actions($context, array $blocks = array())
    {
    }

    // line 12
    public function block_tab_menu($context, array $blocks = array())
    {
        // line 13
        echo "    ";
        if (array_key_exists("action", $context)) {
            // line 14
            echo "        ";
            echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active"), "list");
            echo "
    ";
        }
    }

    // line 18
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 19
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/minsallaboratorio/css/laboratorio.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
    }

    // line 23
    public function block_javascripts($context, array $blocks = array())
    {
        // line 24
        echo "\t";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    <script type=\"text/javascript\">
        var count = 0;
        function getMedicData() {
            var idEmpleado = \"\";
            var nombreEmpleado = \"\";
            var idEmpleadoEspecialidadEstab = \"\";
            var idHistorialClinico =\"\";
            var tipoPacPertenencia =\"\";

            ";
        // line 34
        if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true) && ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED"))) {
            // line 35
            echo "                idEmpleado     = '";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getId"), "html", null, true);
            echo "';
                nombreEmpleado = '";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getNombreempleado"), "html", null, true);
            echo "';
                idEmpleadoEspecialidadEstab = '";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "get", array(0 => "_idEmpEspecialidadEstab"), "method"), "html", null, true);
            echo "';
            ";
        } else {
            // line 39
            echo "                ";
            // line 48
            echo "            ";
        }
        // line 49
        echo "
            idHistorialClinico          = '";
        // line 50
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "SecHistorialClinico"), "getId", array(), "method"), "html", null, true);
        echo "';
            tipoPacPertenencia          = '";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "tipoPacPertenencia"), "html", null, true);
        echo "';
            ";
        // line 52
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "hasRole", array(0 => "ROLE_SUPER_ADMIN"), "method") || ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "getIdEmpleado", array(), "any", false, true), "getIdTipoEmpleado", array(), "any", true, true) && (!($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user"), "getIdEmpleado"), "getIdTipoEmpleado"), "getCodigo") === "MED"))))) {
            // line 53
            echo "                idEmpleado                  = ";
            if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "mntEmpleado", array(), "any", true, true) && (!($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntEmpleado") === null)))) {
                echo "'";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntEmpleado"), "getId", array(), "method"), "html", null, true);
                echo "'";
            } else {
                echo "''";
            }
            echo ";
                nombreEmpleado              = ";
            // line 54
            if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "mntEmpleado", array(), "any", true, true) && (!($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntEmpleado") === null)))) {
                echo "'";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntEmpleado"), "getNombreempleado", array(), "method"), "html", null, true);
                echo "'";
            } else {
                echo "''";
            }
            echo ";
                idEmpleadoEspecialidadEstab = ";
            // line 55
            if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "mntAtenAreaModEstab", array(), "any", true, true) && (!($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntAtenAreaModEstab") === null)))) {
                echo "'";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "mntAtenAreaModEstab"), "getId", array(), "method"), "html", null, true);
                echo "'";
            } else {
                echo "''";
            }
            // line 56
            echo "            ";
        }
        // line 57
        echo "
            return {'idEmpleado': idEmpleado, 'nombreEmpleado': nombreEmpleado, 'idEmpleadoEspecialidadEstab': idEmpleadoEspecialidadEstab, 'idHistorialClinico': idHistorialClinico, 'tipoPacPertenencia': tipoPacPertenencia};
        }
    </script>
\t<script type=\"text/javascript\">
        var arrayBtnsParams = [];

        function pushModalElement(parameters) {
            modalElmentFound = 0;

            if( typeof parameters === 'object' && Object.keys(parameters).length !== 0 ) {
                if (modal_elements.length != 0) {
                    for (var i in modal_elements) {
                        if (modal_elements[i].id == parameters['id']) {
                            modalElmentFound = modalElmentFound + 1;
                        }
                    }
                }

                if (modalElmentFound == 0) {
                    modal_elements.push({
                        \"id\"                   : parameters['id'],
                        \"func\"                 : parameters['function'],
                        \"header\"               : parameters['header'],
                        \"footer\"               : parameters['footer'],
                        \"widthModal\"           : parameters['width'],
                        \"parameters\"           : parameters['parameters'],
                        \"closeBtnName\"         : parameters['closeBtnName'],
                        \"afterLoadCallFunction\": parameters['afterLoadCallFunction']
                    });
                }
            } else {
                var title = 'Error al procesar los perfiles';
                var body = 'Hubo un error al tratar de procesar los perfiles, por favor recargue la pagina nuevamente, si el problema persite contacte con el administrador.';
                var clase = 'dialog-error';

                showDialogMsg(title, body, clase);

                console.log('Error la variable parameters no es de tipo object o la variable esta vacía.');
                console.log(typeof parameters);
                console.log(parameters);
            }

        }

\t\tjQuery(document).ready(function(\$) {
            ";
        // line 129
        echo "
            /* Declaraciones de variables globales */
            var uniqueIdPrograms = {'125': {'idPrograma': '125', 'nombrePrograma': 'VIH', 'limit': 1}};
            var medicData = getMedicData();

            \$('#post-data').append(
                '<input type=\"hidden\" id=\"idEmpleado\" name=\"idEmpleado\" value=\"' + medicData.idEmpleado + '\" />'+
                '<input type=\"hidden\" id=\"idEmpleadoEspecialidadEstab\" name=\"idEmpleadoEspecialidadEstab\" value=\"' + medicData.idEmpleadoEspecialidadEstab + '\" />'+
                '<input type=\"hidden\" id=\"external\" name=\"external\" value=\"";
        // line 137
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external"), "html", null, true);
        echo "\" />'+
                '<input type=\"hidden\" id=\"tipoPacPertenencia\" name=\"tipoPacPertenencia\" value=\"";
        // line 138
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "tipoPacPertenencia"), "html", null, true);
        echo "\" />'+
                '<input type=\"hidden\" id=\"idPaciente\" name=\"idPaciente\" value=\"";
        // line 139
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "paciente"), "getId", array(), "method"), "html", null, true);
        echo "\" />'+
                '<input type=\"hidden\" id=\"idExpediente\" name=\"idExpediente\" value=\"";
        // line 140
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "expediente"), "getId", array(), "method"), "html", null, true);
        echo "\" />'+
                '<input type=\"hidden\" id=\"numeroExpediente\" name=\"numeroExpediente\" value=\"";
        // line 141
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "expediente"), "getNumero", array(), "method"), "html", null, true);
        echo "\" />'+
                '<input type=\"hidden\" id=\"idEstablecimiento\" name=\"idEstablecimiento\" value=\"";
        // line 142
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idEstablecimiento"), "html", null, true);
        echo "\" />'+
                '<input type=\"hidden\" id=\"fechaSolicitud\" name=\"fechaSolicitud\" value=\"";
        // line 143
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "fechaSolicitud"), "html", null, true);
        echo "\" />'+
                '<input type=\"hidden\" id=\"action\" name=\"action\" value=\"";
        // line 144
        echo twig_escape_filter($this->env, (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), "html", null, true);
        echo "\" />'+
                '<input type=\"hidden\" id=\"external_modulo\" name=\"external_modulo\" value=\"";
        // line 145
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "modulo"), "html", null, true);
        echo "\" />'+
                '<input type=\"hidden\" id=\"idHistorialClinico\" name=\"idHistorialClinico\" value=\"";
        // line 146
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "SecHistorialClinico"), "getId", array(), "method"), "html", null, true);
        echo "\" />'
            );

            \$.ajax({
                url: Routing.generate('get_laboratorio_perfiles'),
                async: true,
                dataType: 'json',
                data: { idSexo: '";
        // line 153
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "paciente"), "getIdSexo", array(), "method"), "getId", array(), "method"), "html", null, true);
        echo "' },
                success: function(object) {
                    \$('#perfil-content').empty();
                    var html       = '';
                    var parameters = [];

                    parameters['function'] = 'viewPerfilExamn';
                    parameters['width']    = '750px'

                    if( Object.keys(object).length > 0 ) {
                        \$.each( object, function(idx, val) {
                            html +=
                                '<div id=\"perfil_'+val.id+'\" class=\"perfil-item\" id_perfil=\"'+val.id+'\" perfil_nombre=\"'+val.nombre+'\">'+
                                    val.nombre+
                                    '<a href=\"#\" id=\"perfil_add_'+val.id+'\" class=\"pull-right add-item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Click para Agregar Examenes del Perfil\"><span class=\"fa fa-plus-circle\"></span> Agregar</a>'+
                                    '<a href=\"#myModal\" id=\"perfil_view_'+val.id+'_modal\" custom-modal=\"true\" role=\"button\" data-toggle=\"modal\" class=\"pull-right view-item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Click para Ver los Examenes del Perfil\"><span class=\"fa fa-eye\"></span> Ver Exmámenes</a>'+
                                '</div>';

                            parameters['id']         = 'perfil_view_'+val.id+'_modal';
                            parameters['header']     = '<strong>Detalle del Pefil '+val.nombre+'</strong>';
                            parameters['parameters'] = { 'idPerfil': val.id, 'nombrePerfil': val.nombre };

                            pushModalElement(parameters);
                        });
                    } else {
                        html =
                            '<div class=\"alert alert-info\" role=\"alert\">'+
                                '<strong>No se ha econtrado ningún perfil</strong> para mostrar.'+
                            '</div>';
                    }

                    \$('#perfil-content').append(html);
                }
            });

            \$.ajax({
                url: Routing.generate('getsecsollabexamen'),
                async: true,
                dataType: 'json',
                data: { idSexo: '";
        // line 192
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "paciente"), "getIdSexo", array(), "method"), "getId", array(), "method"), "html", null, true);
        echo "', idHistorialClinico: medicData.idHistorialClinico, idEstablecimiento: '";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idEstablecimiento"), "html", null, true);
        echo "' },
                success: function(object) {

                    var nav_header = \"\";
                    var nav_content = \"\";
                    var asignados = [];
                    var exa_idx = 0;

                    \$('#nav-header').empty();
                    \$('#nav-content').empty();

                    \$.each(object.data, function(aidx,aval) {
                        var are_idx = 0;

                        if(exa_idx === 0) {
                            nav_header = nav_header + '<li class=\"active\">';
                            nav_content = nav_content + '<div class=\"tab-pane fade in active\" id=\"pane_'+aval.codigo+'\">';
                        } else {
                            nav_header = nav_header + '<li>'
                            nav_content = nav_content + '<div class=\"tab-pane fade\" id=\"pane_'+aval.codigo+'\">';
                        }

                        nav_header = nav_header + '<a href=\"#pane_'+aval.codigo+'\" role=\"tab\" data-toggle=\"tab\">'+aval.nombre+'</a></li>';
                        exa_idx++;

                        nav_content = nav_content + '<div style=\"max-height: 300px;overflow: hidden;overflow-y: auto;overflow-x: auto;\">';

                        \$.each(object.data[aidx]['examenes'], function(eidx,eval) {
                            var disponible = '';

                            if(eval.disponible) {
                                disponible = 'true';
                            } else {
                                disponible = 'false';
                                asignados.push('add_'+aval.id+'_'+eval.id);
                            }

                            nav_content = nav_content + '\\
                                            <div id=\"'+aval.id+'_'+eval.id+'\" class=\"examen-item'+ (disponible === \"true\" ? ' clickable' : ' disabled') + '\" dragme=\"'+disponible+'\" id_area=\"'+aval.id+'\" codigo_area=\"'+aval.codigo+'\" nombre_area=\"'+aval.nombre+'\" id_examen=\"'+eval.id+'\" codigo_examen=\"'+eval.codigo+'\" nombre_examen=\"'+eval.nombre+'\"\\
                                            urgente=\"'+eval.urgente+'\" id_programa=\"'+eval.id_programa+'\" id_perfil=\"'+eval.id_perfil+'\">\\
                                                '+eval.nombre+'<span id=\"add_'+aval.id+'_'+eval.id+'\" class=\"fa fa-plus-circle add-item pull-right mouse-pointer\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Agregar Examen de Laboratorio\"></span>\\
                                            </div>';

                            are_idx++;
                        });

                        nav_content = nav_content + '</div></div>'
                    });

                    \$('#nav-header').append(nav_header);
                    \$('#nav-content').append(nav_content);

                    \$.each(asignados, function(sidx, sval) {
                        id = sval.replace('add_', '');
                        \$item = \$('#add_'+id);
                        var parameters = [];

                        var detalleSolicitudEstudios = ";
        // line 249
        echo twig_jsonencode_filter($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "detalleSolicitudEstudios"));
        echo "

                        \$item.parent().attr('dragme', 'true');
                        \$item.parent().removeClass('disabled');

                        if(id in detalleSolicitudEstudios) {
                            parameters['idsolicitud']     = detalleSolicitudEstudios[id]['idsolicitudestudio'];
                            parameters['iddetalle']       = detalleSolicitudEstudios[id]['iddetalle'];
                            parameters['urgente']         = detalleSolicitudEstudios[id]['urgente'];
                            parameters['indicacion']      = detalleSolicitudEstudios[id]['indicacion'];
                            parameters['idtipomuestra']   = detalleSolicitudEstudios[id]['idtipomuestra'];
                            parameters['idorigenmuestra'] = detalleSolicitudEstudios[id]['idorigenmuestra'];
                            parameters['idtiposolicitud'] = detalleSolicitudEstudios[id]['idtiposolicitud'];
                            parameters['id_programa']     = detalleSolicitudEstudios[id]['id_programa'];
                        }

                        //if(Object.keys(parameters).length > 0) {
                            addExam(\$item, parameters);
                        //}
                    });

                    \$('div[dragme=\"true\"]').draggable({
                        revert: \"invalid\",
                        appendTo: \"body\",
                        containment: 'document',
                        helper: \"clone\",
                        cursor: \"move\"
                    });

                    \$('div[dropme=\"true\"]').droppable({
                        accept: 'div[dragme=\"true\"]',
                        activeClass: \"ui-state-highlight\",
                        drop: function( event, ui ) {
                            var parameters = [];

                            currentItem = ui.draggable;

                            if(currentItem.attr('id_programa') in uniqueIdPrograms) {
                                validateUniqueExam(currentItem, parameters);
                            } else {
                                populateTable(currentItem, parameters);
                            }
                        }
                    });
                }
            });

            function populateTable (element, parameters) {
                var num_items = getChildrenNumber('#tbody-pool-examns');

                var id_area = element.attr('id_area');
                var id_examen = element.attr('id_examen');
                var origen_selected = '';
                var muestra_selected = '';
                var indicacion_cont = '';
                var urgente_estado = '';
                var idsolicitud = '';
                var iddetalle = '';

                if(parameters['idsolicitud'] !== undefined && parameters['idsolicitud'] !== null ) {
                    idsolicitud = parameters['idsolicitud'];
                }

                if(parameters['iddetalle'] !== undefined && parameters['iddetalle'] !== null ) {
                    iddetalle = parameters['iddetalle'];
                }

                if(parameters['idtipomuestra'] !== undefined && parameters['idtipomuestra'] !== null ) {
                    muestra_selected = parameters['idtipomuestra'];
                }

                if(parameters['idorigenmuestra'] !== undefined && parameters['idorigenmuestra'] !== null) {
                    origen_selected = parameters['idorigenmuestra'];
                }

                if(parameters['indicacion'] !== undefined && parameters['indicacion'] !== null) {
                    indicacion_cont = parameters['indicacion'];
                }

                if(parameters['urgente'] !== undefined && parameters['urgente'] !== null) {
                    if(parameters['urgente'] === 'false') {
                        urgente_estado = '';
                    } else {
                        urgente_estado = 'checked';
                    }
                }

                \$.ajax({
                    url: Routing.generate('gettipomuestraexam'),
                    async: true,
                    dataType: 'json',
                    data: { idExamen: element.attr('id_examen') },
                    success: function(object) {
                        var tipo_muestra = \"\";
                        var origen = \"\";

                        if(object.data.length > 0) {
                            if(num_items > 0 && \$('#no-items').length !== 0) {
                                \$('#tbody-pool-examns').empty();
                            }

                            element.hide();

                            getOrigenMuestra(object.data[0].id_muestra, function(objOrigen) {
                                if(object.data.length <= 0) {
                                    tipo_muestra = tipo_muestra + ' - <input type=\"hidden\"  id=\"muestra_'+element.attr('id')+'\" name=\"muestra_'+element.attr('id')+'\" value=\"\" />';
                                    origen = origen + ' - <input type=\"hidden\"  id=\"origen_'+element.attr('id')+'\" name=\"origen_'+element.attr('id')+'\" value=\"\" />';
                                } else {
                                    if(object.data.length === 1) {
                                        tipo_muestra = tipo_muestra + ''+object.data[0].nombre_muestra+' <input type=\"hidden\"  id=\"muestra_'+element.attr('id')+'\" name=\"muestra_'+element.attr('id')+'\" value=\"'+object.data[0].id_muestra+'\" />';
                                        if(objOrigen !== undefined) {
                                            if(objOrigen.length <= 0) {
                                                origen = origen + ' - <input type=\"hidden\"  id=\"origen_'+element.attr('id')+'\" name=\"origen_'+element.attr('id')+'\" value=\"\" />';
                                            } else {
                                                if(objOrigen.length === 1) {
                                                    origen = origen + objOrigen[0].nombre_origen+' <input type=\"hidden\"  id=\"origen_'+element.attr('id')+'\" name=\"origen_'+element.attr('id')+'\" value=\"'+objOrigen[0].id_origen+'\" />';
                                                } else {
                                                    origen = origen + '<select id=\"origen_'+element.attr('id')+'\" name=\"origen_'+element.attr('id')+'\" required=\"true\"><option></option>';

                                                    \$.each(objOrigen, function(idx, val) {
                                                        origen = origen + '<option value=\"'+val.id_origen+'\">'+val.nombre_origen+'</option>';
                                                    });

                                                    origen = origen + '</select>';
                                                }
                                            }
                                        }
                                    } else {
                                        tipo_muestra = tipo_muestra + '<select id=\"muestra_'+element.attr('id')+'\" name=\"muestra_'+element.attr('id')+'\" required=\"true\"><option></option>';

                                        \$.each(object.data, function(idx, val) {
                                            tipo_muestra = tipo_muestra + '<option value=\"'+val.id_muestra+'\" '+ (muestra_selected == val.id_muestra ? 'selected' : '') +'>'+val.nombre_muestra+'</option>';
                                        });

                                        tipo_muestra = tipo_muestra + '</select>';

                                        origen = ' - <input type=\"hidden\"  id=\"origen_'+element.attr('id')+'\" name=\"origen_'+element.attr('id')+'\" value=\"\" />';
                                    }
                                }

                                var tbody = '';

                                tbody = tbody + '\\
                                    <tr id=\"tr_'+element.attr('id')+'\">\\
                                        <input type=\"hidden\" id=\"exam_'+element.attr('id')+'\" name=\"exam_'+count+'\" value=\"'+element.attr('id')+'\" id_programa=\"'+element.attr('id_programa')+'\" nombre_examen=\"'+element.attr('nombre_examen')+'\" />\\
                                        <td>'+element.attr('codigo_examen')+'</td>\\
                                        <td>'+element.attr('nombre_examen')+'</td>\\
                                        <td style=\"width:206px;\">'+tipo_muestra+'</td>\\
                                        <td style=\"width:206px;\" id=\"td_origen_'+element.attr('id')+'\" name=\"origen_'+element.attr('id')+'\">'+origen+'</td>\\
                                        <td style=\"width:250px;\">\\
                                            <div class=\"input-group\">\\
                                                <div class=\"input-group-addon\"><span class=\"fa fa-pencil\"></span></div>\\
                                                <input id=\"indicacion_'+element.attr('id')+'\" type=\"text\" name=\"indicacion_'+element.attr('id')+'\" value=\"'+indicacion_cont+'\" class=\"form-control\" />\\
                                            </div>\\
                                        </td>\\
                                        <td style=\"width: 55px; vertical-align: middle;\">';

                                if(element.attr('urgente') === 'true') {
                                    tbody = tbody + '\\
                                            <div class=\"onoffswitch\">\\
                                                <input type=\"checkbox\" name=\"urgente_'+element.attr('id')+'\" class=\"onoffswitch-checkbox\" id=\"urgente_'+element.attr('id')+'\" '+urgente_estado+'>\\
                                                <label class=\"onoffswitch-label\" for=\"urgente_'+element.attr('id')+'\">\\
                                                    <span class=\"onoffswitch-inner\"></span>\\
                                                    <span class=\"onoffswitch-switch\"></span>\\
                                                </label>\\
                                            </div>';
                                } else {
                                    tbody = tbody + ' - '
                                }

                                tbody = tbody + '\\
                                        </td>\\
                                        <td style=\"vertical-align: middle;\"><span id=\"trash_'+element.attr('id')+'\" class=\"fa fa-trash-o mouse-pointer\" role=\"trash\" idsolicitud=\"'+idsolicitud+'\" iddetalle=\"'+iddetalle+'\"></span></td>\\
                                    </tr>';

                                \$('#tbody-pool-examns').append(tbody);

                                \$('select[id^=\"muestra_\"]').select2({
                                    placeholder: \"Seleccionar muestra...\",
                                    allowClear: true,
                                    width: '100%'
                                });

                                \$('select[id^=\"origen_\"]').select2({
                                    placeholder: \"Seleccionar origen...\",
                                    allowClear: true,
                                    width: '100%'
                                });

                                var id = id_area + '_' + id_examen;
                                if(\$('select[id=\"muestra_'+id+'\"]').length !== 0) {
                                    \$('select[id=\"muestra_'+id+'\"]').select2('val', muestra_selected);

                                    if(parameters['idtipomuestra'] !== undefined && parameters['idtipomuestra'] !== null ) {
                                        changeOrigenMuestra(\$('#muestra_'+id), parameters);
                                    }
                                }

                                if(\$('select[id=\"origen_'+id+'\"]').length !== 0) {
                                    \$('select[id=\"origen_'+id+'\"]').select2('val', origen_selected);
                                }

                                count++;
                            });
                        } else {
                            var title       = 'Tipo de muestra no configurada!';
                            var dialogClass = 'dialog-error';
                            var msg         = 'El tipo de muestra del Examen <strong>\"'+element.attr('nombre_examen')+'\"</strong> no ha sido configurado.<br /><br />'+
                                              '<strong>Por favor contacte al Jefe/a del Laboratorio Clínico e infórmele que el examen no ha sido configurado con almenos un tipo de muestra</strong>.<br /><br />'+
                                              'Una vez que el examen haya sido configurado podrá asignar este examen a la solicitud de laboratorio.';
                            var width       = 500;

                            showDialogMsg(title, msg, dialogClass, '', null, null, width);
                        }
                    }
                });
            }

            function validateUniqueExam(element, parameters) {
                \$tbody = \$('#tbody-pool-examns');
                var idprograma = element.attr('id_programa');
                var msj = \"\";
                var closeBtnName = null;

                if(\$('input[id_programa=\"'+idprograma+'\"]').length > 0) {
                    msj += '<b>No se puede agregar m&aacute;s de '+uniqueIdPrograms[idprograma]['limit'];

                    if(uniqueIdPrograms[idprograma]['limit'] > 1) {
                        msj += ' examenes ';
                    } else {
                        msj += ' examen ';
                    }

                    msj += '</b> a la solicitud de estudio.<br /><br />';

                    if(uniqueIdPrograms[idprograma]['limit'] > 1) {
                        msj += 'Los siguientes examenes ya han sido agregados:<br />';
                    } else {
                        msj += 'El siguiente examen ya ha sido agreado:<br />';
                    }

                    msj += '<ul>';

                    \$('input[id_programa=\"'+idprograma+'\"]').each(function(idx) {
                        msj += '<li><b>'+\$(this).attr('nombre_examen')+'</b></li>';
                    });

                    msj += '</ul><br />';

                    if(\$('input[id_programa=\"'+idprograma+'\"]').length === 1) {
                        msj += 'Si desea <b>agregar el examen seleccionado y eliminar el examen descrito arriba haga click en el boton Aceptar</b>, sino haga click en el boton Cancelar';
                        closeBtnName = 'Cancelar';
                    } else {
                        msj += 'Por favor elimine un examen antes de poder agregar el examen seleccionado';
                    }
                }

                if(msj === '') {
                    populateTable(element, parameters);
                } else {
                    var title = 'Limite excedido';
                    var dialogClass = 'dialog-warning';
                    arrayBtnsParams['Aceptar'] = {'element': element, 'parameters': parameters, 'idprograma': idprograma};

                    var arrayBtns = [{
                                        text: 'Aceptar', click: function() {
                                            \$('input[id_programa=\"'+arrayBtnsParams['Aceptar']['idprograma']+'\"]').each(function(idx) {
                                                removeExam(\$(this).attr('id').replace('exam_',''));
                                            });

                                            arrayBtnsParams['Aceptar']['element'].hide();
                                            populateTable(arrayBtnsParams['Aceptar']['element'], arrayBtnsParams['Aceptar']['parameters']);

                                            jQuery( this ).dialog( \"close\" );
                                        }
                                    }];
                    showDialogMsg(title, msj, dialogClass, closeBtnName, arrayBtns);
                }
            }

            function getChildrenNumber(Selector) {
                return \$(Selector).children().length;
            }

            function addExam(element, parameters) {
                \$item = \$('#'+element.attr('id').replace('add_',''));
                var title = '';
                var body  = '';
                var clase = '';

                if(element.parent().attr('dragme') === 'true') {

                    if(\$item.attr('id_programa') in uniqueIdPrograms) {
                        validateUniqueExam(\$item, parameters);
                    } else {
                        if( \$('#tr_'+\$item.attr('id')).length === 0 ) {
                            \$item.hide();
                            populateTable(\$item, parameters);
                        }
                    }
                } else {
                    title = 'Examen ya ha sido asignado';
                    body = 'El examen ya ha sido asignado al paciente y actualmente se encuentra en proceso, motivo por el cual <b>no es posible asignar el examen</b>.';
                    clase = 'dialog-warning';

                    showDialogMsg(title, body, clase);
                }
            }

            function removeExam(id) {
                if(\$('#trash_'+id).attr('idsolicitud') !== '' && \$('#trash_'+id).attr('iddetalle') !== '') {
                    deleteDetalle(\$('#trash_'+id).attr('idsolicitud'), \$('#trash_'+id).attr('iddetalle'), id);
                }

                \$('#tr_'+id).remove();
                \$('#'+id).show();

                var num_items = getChildrenNumber('#tbody-pool-examns');
                if(num_items === 0 && \$('#no-items').length === 0) {
                    \$('#tbody-pool-examns').append('<tr><td colspan=\"7\"><span id=\"no-items\" class=\"disabled-label col-md-12 col-xs-12\">No hay ningun examen asignado...</span></td></tr>');
                }

            }

            function deleteDetalle(idsolicitud, iddetalle, idelement) {
                \$element = \$('#exam_'+idelement);
                var idprograma = '';

                if(\$element.attr('id_programa') !== undefined  && \$element.attr('id_programa') !== '') {
                    idprograma = \$element.attr('id_programa');
                } else {
                    idprograma = 'null';
                }

                \$('#remove-data').append('<input type=\"hidden\" id=\"delete_'+idsolicitud+'_'+iddetalle+'\" name=\"delete_'+idsolicitud+'_'+iddetalle+'\" value=\"'+idsolicitud+'_'+iddetalle+'_'+idprograma+'\" />');
            }

            \$('body').on('click', 'span[role=\"trash\"]', function() {
                var id = \$(this).attr('id').replace('trash_','');

                removeExam(id);
            });

            \$('body').on('click','span[id^=\"add_\"]', function () {
                addExamnEvent(\$(this));
            });

            \$('body').on('dblclick','.examen-item.clickable', function () {
                addExamnEvent(\$('#add_'+\$(this).attr('id')));
            });

            /* Eventos de Perfiles */
            \$('body').on('click','a[id^=\"perfil_add_\"]', function () {
                var idPerfil = \$(this).parent().attr('id_perfil');
                addExamnPerfilEvent(idPerfil);
            });

            \$('body').on('dblclick','.perfil-item', function () {
                var idPerfil = \$(this).attr('id_perfil');

                addExamnPerfilEvent(idPerfil);
            });
            /* Fin de Eventos de Perfiles */

            \$('body').on('change', 'select[id^=\"muestra_\"]', function() {
                var parameters = [];

                changeOrigenMuestra(\$(this), parameters);
            });

            function addExamnPerfilEvent(idPerfil) {
                if(idPerfil !== undefined) {
                    \$('body .examen-item[id_perfil*=\"'+idPerfil+'\"]').each(function() {
                        if( \$.inArray( idPerfil, \$(this).attr('id_perfil').replace(/\\[/g, '').replace(/\\]/g, '').split(',')  ) > -1 ) {
                            addExamnEvent(\$('#add_'+\$(this).attr('id')));
                        }
                    });
                } else {
                    var title = 'Error en el Perfil';
                    var body = 'Hubo un error al tratar de obtener los examenes asociados al perfil seleccionado.<br /><br />Por favor intentelo nuevamente, si el problema persiste por favor contacte con el Administrador del Sistema.';
                    var clase = 'dialog-error';

                    showDialogMsg(title, body, clase);
                }
            }

            function addExamnEvent(element) {
                var parameters = [];

                if( element.length > 0 ) {
                    addExam(element, parameters);
                } else {
                    var title = 'Error al agregar el examen';
                    var body = 'Hubo un error al tratar de agregar el examen a la solicitud de laboratorio.<br /><br />Por favor intentelo nuevamente, si el problema persiste por favor contacte con el Administrador del Sistema.';
                    var clase = 'dialog-error';

                    showDialogMsg(title, body, clase);
                }
            }

            function changeOrigenMuestra(muestra, parameters) {
                var origen = '';
                var origen_selected = '';
                var id = muestra.attr('id').replace('muestra_','');
                var origen_selected = '';

                if(parameters['idorigenmuestra'] !== undefined && parameters['idorigenmuestra'] !== null) {
                    origen_selected = parameters['idorigenmuestra'];
                }

                getOrigenMuestra(muestra.select2('val'), function(objOrigen) {
                    if(muestra.select2('val') !== '') {
                        if(objOrigen !== undefined) {
                            if(objOrigen.length <= 0) {
                                origen = ' - <input type=\"hidden\"  id=\"origen_'+id+'\" name=\"origen_'+id+'\" value=\"\" />';
                            } else {
                                if(objOrigen.length === 1) {
                                    origen = origen + objOrigen.nombre_origen+' <input type=\"hidden\"  id=\"origen_'+id+'\" name=\"origen_'+id+'\" value=\"'+objOrigen.id_origen+'\" />';
                                } else {
                                    origen = origen + '<select id=\"origen_'+id+'\" name=\"origen_'+id+'\" required=\"true\"><option></option>';

                                    \$.each(objOrigen, function(idx, val) {
                                        origen = origen + '<option value=\"'+val.id_origen+'\" '+ (origen_selected == val.id_origen ? 'selected' : '') +'>'+val.nombre_origen+'</option>';
                                    });

                                    origen = origen + '</select>';
                                }
                            }
                        }
                    } else {
                        origen = ' - <input type=\"hidden\"  id=\"origen_'+id+'\" name=\"origen_'+id+'\" value=\"\" />';
                    }

                    \$('#td_origen_'+id).empty();
                    \$('#td_origen_'+id).append(origen);

                    \$('select[id=\"origen_'+id+'\"]').select2({
                        placeholder: \"Seleccionar origen...\",
                        allowClear: true,
                        width: '100%'
                    });
                });
            }

            function getOrigenMuestra(idMuestra, funct) {
                var data = [];
                \$.ajax({
                    url: Routing.generate('getorigenmuestraexam'),
                    async: true,
                    dataType: 'json',
                    data: { idMuestra: idMuestra },
                    success: function(object) {
                        funct(object.data);
                    }
                });
            }

            window.viewPerfilExamn = function(parameters) {
                var html     = '';
                var idPerfil = parameters.idPerfil;
                var count    = 0;
                var body     = '';

                if(idPerfil !== undefined) {
                    \$('body .examen-item[id_perfil*=\"'+idPerfil+'\"]').each(function() { console.log(\$(this).attr('id_perfil'));
                        var perfiles = \$(this).attr('id_perfil').replace(/\\[/g, '').replace(/\\]/g, '');
                        if( \$.inArray( idPerfil, perfiles.split(',')  ) > -1 || parseInt(perfiles) === parseInt(idPerfil) ) {
                            body +=
                                '<div class=\"examen-item\">'+
                                    \$(this).attr('nombre_examen')+
                                '</div>';

                            count++;
                        }
                    });
                    console.log('count: '+count);
                    if(count === 0) {
                        html =
                            '<div class=\"alert alert-info\" role=\"alert\">'+
                                '<h4><strong>Sin examenes para mostrar.</strong></h4>'+
                                'Ningún examen ha sido asociado a este perfil, por favor contacte al administrador de laboratorio para que asigne examenes al perfil.'+
                            '</div>';
                    } else {
                        html =
                            '<p>'+
                                'A continuación se muestra un <strong>listado con los éxamenes pertenecientes al perfil</strong> seleccionados.'+
                            '</p>'+
                            body;
                    }
                } else {
                    html =
                        '<div class=\"alert alert-danger\" role=\"alert\">'+
                            '<h3>Error al seleccionar el Perfil</h3>'+
                            'Hubo un error al tratar de obtener los examenes asociados al perfil seleccionado.<br /><br />Por favor intentelo nuevamente, si el problema persiste por favor contacte con el Administrador del Sistema.'+
                        '</div>';

                    console.log('Error el id del Perfil es de tipo undefined');
                }

                return html;
            }

            \$('form').on('submit', function(e) {
                var num = \$('td[id^=td_]').length;

                if(num <= 0) {
                    e.preventDefault();

                    ";
        // line 757
        if (((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) === "create")) {
            // line 758
            echo "                        var title = 'Examenes no asignados';
                        var body = 'Debe de agregar al menos un examen antes de poder generar la solicitud de estudio.';
                        var clase = 'dialog-error';
                    ";
        } else {
            // line 762
            echo "                        var title = 'Examenes no asignados';
                        var body = 'Debe de agregar al menos un examen antes de poder actualizar la solicitud de estudio.<br />Si no desea agregar examenes, por favor haga clic en el boton <b>Eliminar Solicitud para eliminar la solicitud de estudio de laboratorio</b>.';
                        var clase = 'dialog-error';
                    ";
        }
        // line 766
        echo "
                    showDialogMsg(title, body, clase);
                }
            });

            \$('#impresiones').iCheck('destroy');

            ";
        // line 773
        if (((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) === "edit")) {
            // line 774
            echo "                ";
            $context["urldel"] = $this->env->getExtension('routing')->getUrl("admin_minsal_laboratorio_secsolicitudestudios_delete", array("id" => $this->getAttribute($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "SecHistorialClinico"), "getId", array(), "method"), ("_token" . $this->getAttribute((isset($context["tokens"]) ? $context["tokens"] : $this->getContext($context, "tokens")), "token1")) => $this->getAttribute((isset($context["tokens"]) ? $context["tokens"] : $this->getContext($context, "tokens")), "token2"), "idEstablecimiento" => $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "idEstablecimiento"), "external" => $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external"), "modulo" => $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "modulo"), "tipoPacPertenencia" => $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "tipoPacPertenencia"), "fechaSolicitud" => $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "fechaSolicitud")));
            // line 775
            echo "                deleteurl = '";
            echo twig_escape_filter($this->env, (isset($context["urldel"]) ? $context["urldel"] : $this->getContext($context, "urldel")), "html", null, true);
            echo "&idEmpleado='+medicData.idEmpleado+'&idEspecialidad='+medicData.idEmpleadoEspecialidadEstab;

                \$('#btn_delete').attr('href', deleteurl.replace(/&amp;/g, '&'));
            ";
        }
        // line 779
        echo "
            \$('button[id^=\"btn_cw\"]').on('click', function() {
                window.close();
            });
\t    });
\t</script>
    ";
        // line 785
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "external", array(), "any", true, true) && ($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true))) {
            // line 786
            echo "        <script type=\"text/javascript\">
            jQuery(document).ready(function(\$) {
                ";
            // line 788
            if ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array(), "any", false, true), "query", array(), "any", false, true), "get", array(0 => "createdElement"), "method", true, true) && ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "query"), "get", array(0 => "createdElement"), "method") != "")) && (!(null === $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "query"), "get", array(0 => "createdElement"), "method"))))) {
                // line 789
                echo "                window.addEventListener(\"beforeunload\", function (e) {
                    if (window.opener != null && !window.opener.closed) {
                        try {
                            window.opener.updateIdSolicitudestudios(";
                // line 792
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request"), "query"), "get", array(0 => "createdElement"), "method"), "html", null, true);
                echo ");
                            window.opener.reloadPage();
                        } catch (err) {
                            alert(err.description || err); //or console.log or however you debug
                        }
                    }
                });
                ";
            } else {
                // line 800
                echo "                    window.opener.updateIdSolicitudestudios(null);
                ";
            }
            // line 802
            echo "            });
        </script>
    ";
        }
    }

    // line 807
    public function block_content($context, array $blocks = array())
    {
        // line 808
        echo "    ";
        $context["url"] = "create";
        // line 809
        echo "
    ";
        // line 810
        if ((!$this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url"))), "method"))) {
            // line 811
            echo "        <div>
            ";
            // line 812
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form_not_available", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        </div>
    ";
        } else {
            // line 815
            echo "        <form
              ";
            // line 816
            if (($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "form_type"), "method") == "horizontal")) {
                echo "class=\"form-horizontal\"";
            }
            // line 817
            echo "              role=\"form\"
              action=\"";
            // line 818
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url"))), "method"), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
            echo "
              method=\"POST\"
              ";
            // line 820
            if ((!$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method"))) {
                echo "novalidate=\"novalidate\"";
            }
            // line 821
            echo "              >
            ";
            // line 822
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars"), "errors")) > 0)) {
                // line 823
                echo "                <div class=\"sonata-ba-form-error\">
                    ";
                // line 824
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
                echo "
                </div>
            ";
            }
            // line 827
            echo "
            ";
            // line 828
            $this->displayBlock('sonata_pre_fieldsets', $context, $blocks);
            // line 831
            echo "
            ";
            // line 832
            $this->displayBlock('sonata_tab_content', $context, $blocks);
            // line 973
            echo "
            ";
            // line 974
            $this->displayBlock('sonata_post_fieldsets', $context, $blocks);
            // line 977
            echo "
            ";
            // line 978
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "_token"), 'widget');
            echo "

            ";
            // line 980
            $this->displayBlock('formactions', $context, $blocks);
            // line 1000
            echo "        </form>
    ";
        }
    }

    // line 828
    public function block_sonata_pre_fieldsets($context, array $blocks = array())
    {
        // line 829
        echo "                <div class=\"row\">
            ";
    }

    // line 832
    public function block_sonata_tab_content($context, array $blocks = array())
    {
        // line 833
        echo "                ";
        // line 870
        echo "                <div id=\"post-data\"></div>
                <div id=\"remove-data\"></div>
                <div class=\"";
        // line 872
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["form_group"]) ? $context["form_group"] : null), "class"), "col-md-12")) : ("col-md-12")), "html", null, true);
        echo "\">
                    <div class=\"box box-success\">
                        <div class=\"box-header\">
                            <h4 class=\"box-title\">
                                Examenes de Laboratorio
                            </h4>
                        </div>
                        <div class=\"box-body\">
                            <div class=\"sonata-ba-collapsed-fields\">
                                <!-- Tab list -->
                                <ul class=\"nav nav-tabs\" role=\"tablist\">
                                    <li role=\"presentation\" class=\"active\"><a href=\"#exam-list\" aria-controls=\"exam-list\" role=\"tab\" data-toggle=\"tab\">Examenes</a></li>
                                    <li role=\"presentation\"><a href=\"#exam-profile\" aria-controls=\"exam-list\" role=\"tab\" data-toggle=\"tab\">Perfiles</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class=\"tab-content\" style=\"padding-top: 15px;\">
                                    <div role=\"tabpanel\" class=\"tab-pane active\" id=\"exam-list\">

                                        <!-- Por listado de Examenes -->
                                        <div class=\"row\">
                                            <div class=\"col-xs-12 col-md-12\">
                                                <table class=\"nav-tabs-stacked-table\">
                                                    <tr>
                                                        <td class=\"col-xs-3 col-md-3 nav-tabs-stacked-content-left\">
                                                            <ul class=\"nav nav-tabs nav-stacked\" role=\"tablist\" id=\"nav-header\">
                                                            </ul>
                                                        </td>
                                                        <td class=\"col-xs-9 col-md-9 nav-tabs-stacked-content-right\">
                                                            <div class=\"tab-content\" id=\"nav-content\">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div role=\"tabpanel\" class=\"tab-pane\" id=\"exam-profile\">

                                        <!-- Por Perfiles -->
                                        <div class=\"row\">
                                            <div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">
                                                <p style=\"margin-bottom: 20px;\">
                                                    A continuación se le muestra un listado de perfiles de exámenes de laboratorio, cada perfil le permitirá
                                                    agregar a la solicitud de éxamenes de laboratorio clínico el conjunto de pruebas relacionados a dicho perfil.
                                                    <br /><br />
                                                    Para agregar los exámenes asociados a un perfil, haga clic sobre el botón de Agregar.<br />
                                                </p>
                                                <div id=\"perfil-content\">
                                                    <div class=\"alert alert-info\" role=\"alert\">
                                                        <strong>No se ha econtrado ningún perfil</strong> para mostrar.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Resultados -->
                                <div class=\"row\">
                                    <div class=\"col-xs-12 col-md-12\">
                                        <div class=\"top-boder-length-10\"></div>
                                        <div class=\"panel panel-primary\">
                                            <div class=\"panel-heading\">
                                                <h4 style=\"margin:0; line-height:18px;\">Examenes Asignados
                                                    <div class=\"onoffswitch inverted pull-right\">
                                                        <input type=\"checkbox\" name=\"impresiones\" class=\"onoffswitch-checkbox\" id=\"impresiones\" ";
        // line 936
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "impresiones"), "html", null, true);
        echo ">
                                                        <label class=\"onoffswitch-label\" for=\"impresiones\">
                                                            <span class=\"onoffswitch-inner\"></span>
                                                            <span class=\"onoffswitch-switch\"></span>
                                                        </label>
                                                    </div>
                                                    <div class=\"pull-right\" style=\"padding-right: 10px; font-size:15px;\"><span class=\"fa fa-print\"></span> Resultados de Examenes Impresos (Pre-Operatorios)</div>
                                                </h4>
                                            </div>
                                            <div id=\"pull-exams\" class=\"table-responsive\" dropme=\"true\">
                                                <table class=\"table table-hover\" style=\"min-width:700px;\">
                                                    <thead>
                                                        <tr>
                                                            <th>Codigo</th>
                                                            <th>Nombre del Examen</th>
                                                            <th>Tipo de Muestra</th>
                                                            <th>Origen</th>
                                                            <th>Indicacion</th>
                                                            <th>Urgente</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id=\"tbody-pool-examns\">
                                                        <tr>
                                                            <td colspan=\"7\"><span id=\"no-items\" class=\"disabled-label col-md-12 col-xs-12\">No hay ningun examen asignado...</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
    }

    // line 974
    public function block_sonata_post_fieldsets($context, array $blocks = array())
    {
        // line 975
        echo "                </div>
            ";
    }

    // line 980
    public function block_formactions($context, array $blocks = array())
    {
        // line 981
        echo "                <div class=\"well well-small form-actions\">
                    ";
        // line 982
        if (((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")) === "create")) {
            // line 983
            echo "                        <button class=\"btn btn-success\" type=\"submit\" name=\"btn_create\"><i class=\"fa fa-plus-circle\"></i> Crear Solicitud</button>
                        ";
            // line 984
            if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true)) {
                // line 985
                echo "                            <button class=\"btn btn-default\" type=\"button\" id=\"btn_cw_cancel\" name=\"btn_cancel\">Cancelar</button>
                        ";
            } else {
                // line 987
                echo "                            <a href=\"";
                echo $this->env->getExtension('routing')->getUrl("admin_minsal_laboratorio_secsolicitudestudios_list");
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-list\"></i> Volver a la Lista</a>
                        ";
            }
            // line 989
            echo "                    ";
        } else {
            // line 990
            echo "                        <button class=\"btn btn-primary\" type=\"submit\" name=\"btn_update\"><i class=\"glyphicon glyphicon-floppy-open\"></i> Actualizar Solicitud</button>
                        <a href=\"#\" class=\"btn btn-danger\" id=\"btn_delete\" name=\"btn_delete\"><i class=\"fa fa-trash-o\"></i> Eliminar Solicitud</a>
                        ";
            // line 992
            if (($this->getAttribute((isset($context["params"]) ? $context["params"] : $this->getContext($context, "params")), "external") == true)) {
                // line 993
                echo "                            <button class=\"btn btn-default\" type=\"button\" id=\"btn_cw_close\" name=\"btn_close\">Cerrar</button>
                        ";
            } else {
                // line 995
                echo "                            <a href=\"";
                echo $this->env->getExtension('routing')->getUrl("admin_minsal_laboratorio_secsolicitudestudios_list");
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-list\"></i> Volver a la Lista</a>
                        ";
            }
            // line 997
            echo "                    ";
        }
        // line 998
        echo "                </div>
            ";
    }

    public function getTemplateName()
    {
        return "MinsalLaboratorioBundle:Custom:SecSolicitudestudios/assign_exam.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1229 => 998,  1226 => 997,  1220 => 995,  1216 => 993,  1214 => 992,  1210 => 990,  1207 => 989,  1201 => 987,  1197 => 985,  1195 => 984,  1192 => 983,  1190 => 982,  1187 => 981,  1184 => 980,  1179 => 975,  1176 => 974,  1135 => 936,  1068 => 872,  1064 => 870,  1062 => 833,  1059 => 832,  1054 => 829,  1051 => 828,  1045 => 1000,  1043 => 980,  1038 => 978,  1035 => 977,  1033 => 974,  1030 => 973,  1028 => 832,  1025 => 831,  1023 => 828,  1020 => 827,  1014 => 824,  1011 => 823,  1009 => 822,  1006 => 821,  1002 => 820,  995 => 818,  992 => 817,  988 => 816,  985 => 815,  979 => 812,  976 => 811,  974 => 810,  971 => 809,  968 => 808,  965 => 807,  958 => 802,  954 => 800,  943 => 792,  938 => 789,  936 => 788,  932 => 786,  930 => 785,  922 => 779,  914 => 775,  911 => 774,  909 => 773,  900 => 766,  894 => 762,  888 => 758,  886 => 757,  375 => 249,  313 => 192,  271 => 153,  261 => 146,  257 => 145,  253 => 144,  249 => 143,  245 => 142,  241 => 141,  237 => 140,  233 => 139,  229 => 138,  225 => 137,  215 => 129,  167 => 57,  164 => 56,  156 => 55,  146 => 54,  135 => 53,  133 => 52,  129 => 51,  125 => 50,  122 => 49,  119 => 48,  117 => 39,  112 => 37,  108 => 36,  103 => 35,  101 => 34,  87 => 24,  84 => 23,  78 => 20,  73 => 19,  70 => 18,  62 => 14,  59 => 13,  56 => 12,  51 => 9,  43 => 5,  40 => 4,  37 => 3,);
    }
}
