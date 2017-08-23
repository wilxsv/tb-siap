<?php

/* MinsalSeguimientoBundle:SecHistorialClinico:list.html.twig */
class __TwigTemplate_b8624a4cc2e176c56cae10d85c264f96b5e431f5359a169f3812d9430636c479 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SonataAdminBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'sonata_admin_content' => array($this, 'block_sonata_admin_content'),
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
    var idExpediente=0;
    var winParams=[];
    var parameters=[];
    \$('#numExpNomPac').select2({
        allowClear: true,
        placeholder: 'Seleccionar...',
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
        }
    }).on('change',function(e){
            if( e.val== ''){
                \$('#especialidades').children().remove();
                \$('#especialidades').append('<option></option>');
                \$('#especialidades').select2({
                    allowClear: true,
                    placeholder: 'Seleccionar...',
                    dropdownAutoWidth: true
                }).prop('disabled',true);
                \$('#verHistorial').hide();
                \$('#verAntecedentes').hide();
            }else{
                \$('#especialidades').children().remove();
                \$('#especialidades').append('<option></option>');
                \$.ajax({
                    url: Routing.generate('especialidades_historia',{'idPaciente':e.val}),
                    type: \"GET\",
                    dataType: 'json',
                    async: false,
                    success: function(data) {
                        \$.each(data.idEspecialidad, function(indice, val) {
                            \$('#especialidades').append(\$('<option>', {value: val.id, text: val.nombre}));
                            idExpediente=val.idexpediente;
                        });
                    }
                });
                \$('#especialidades').prop('disabled',false);
            }
    });

    \$('#especialidades').select2({
        allowClear: true,
        placeholder: 'Seleccionar...',
        dropdownAutoWidth: true
    }).prop('disabled',true).on('change',function(e){
        if(e.val!=\"\"){
            \$('#verHistorial').show();
            \$('#verAntecedentes').show();
        }
        else{
            \$('#verHistorial').hide();
            \$('#verAntecedentes').hide();
        }
    });

    \$('#verHistorial').on('click', function(){
        parameters['idExpedienteHclinica'] = idExpediente;
        parameters['idEspecialidadHclinica']  = \$('#especialidades').select2('val');
        parameters['external'] = 'true';
        winParams['method'] = \"post\";
        winParams['action'] = \"";
        // line 84
        echo $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_sechistorialclinico_list");
        echo "\";
        winParams['target'] = \"Historias Clinicas del Paciente\";
        winParams['parameters'] = parameters;
        openPostPopUpWindows(winParams);
    });

    \$('#verAntecedentes').on('click', function() {
            var idExpediente   = \$('#numExpNomPac').select2('val');
            var idEspecialidad = \$('#especialidades').select2('val');
            var showUrl = \"";
        // line 93
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_minsal_seguimiento_secantecedentes_showespe", array("id" => "idAntecedente", "idatenareamodestab" => "idEspecialidad")), "html", null, true);
        echo "\";

            \$.ajax({
                url: Routing.generate('sec_antecedentes_leer') + '/' + idExpediente + '/' + idEspecialidad + '/1', // 1: Envío de Id de Expediente, 0: Envío de Id de Paciente
                type: \"POST\",
                dataType: 'json',
                success: function (data) {
                    if (data.idantecedente == 0) {
                        showDialogMsg('Informacion','Este paciente aun no tiene antecedentes');
                    } else {
                        parameters['external'] = 'true';
                        parameters['noEdit']   = 'true';
                        var winParams = [];

                        if (data.idantecedente){
                            parameters['id'] = data.idantecedente;
                            winParams['method'] = \"post\";
                            //winParams['action'] = Routing.generate('sec_antecedentes_show',{ 'id':data.idantecedente, 'idatenareamodestab':idEspecialidad });
                            winParams['action'] = showUrl.replace('idAntecedente', data.idantecedente).replace('idEspecialidad', idEspecialidad );
                            winParams['target'] = \"Antecedente de Paciente\";
                            winParams['parameters'] = parameters;
                            openPostPopUpWindows(winParams);
                        }
                    }

                }
            });
    });
});
</script>
";
    }

    // line 125
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        // line 126
        echo "<div class=\"container-fluid\">
    <div class=\"row\">
        <div class=\"col-md-8\">
            <table class=\"table table-bordered\">
                <tbody>
                    <tr>
                        <th>No. Expediente - Nombre Paciente </th>
                        <td><input type=\"hidden\" id=\"numExpNomPac\" name=\"numExpNomPac\" style=\"width:400px !important;\"></input></td>
                    </tr>
                    <tr>
                        <th>Especialidades en las que ha pasado consulta</th>
                        <td><select id=\"especialidades\" name=\"especialidades\" style=\"width:400px !important;\"><option></option></select></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class=\"col-md-4\">
            <a id=\"verHistorial\" style=\"display: none; width: 160px; margin-top: 5px;\" class=\"btn btn-info\" href=\"#\"><i class=\"fa fa-archive\"></i>&nbsp; Ver Historial Cl&iacute;nico</a>
            <a id=\"verAntecedentes\" style=\"display: none; width: 160px; margin-top: 5px;\" class=\"btn btn-primary\" href=\"#\"><i class=\"fa fa-file-text\"></i>&nbsp; Ver Antecedentes</a>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "MinsalSeguimientoBundle:SecHistorialClinico:list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  172 => 126,  169 => 125,  134 => 93,  122 => 84,  42 => 7,  39 => 6,  33 => 3,  30 => 2,);
    }
}
