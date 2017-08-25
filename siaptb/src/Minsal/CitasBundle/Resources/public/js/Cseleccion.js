
var actualiza = 0;// para actualizar si se guarda desde area de atencion. O para todos; 1 para araea de atencion

function especialidad(v1)
{
    $('input#hEspecialidadId').val(v1);
    if (v1 !== 0)
    {
        actualiza = 1;
        $('#home').empty();
    }

    if (vtab === null && v1 !== "undefined" && v1 !== 0)
    {
        vtab = v1;
        $elemento = $('#' + vtab);
    }
    else if (vtab != null && v1 != 0 && actualiza == 1)
    {
        $('#' + vtab).empty();
        vtab = v1;
        $elemento = $('#' + vtab);

    }
    else if (vtab !== null && v1 != 0 && actualiza == 0)
    {

        $('#' + vtab).empty();
        vtab = v1;
        $elemento = $('#' + vtab);
    }
    else if (v1 == 0)
    {
        actualiza = 0;
        $('#' + vtab).empty();
        $elemento = $('#home');

    }

    jQuery(document).ready(function ($) {
        $.ajax({
            type: "GET",
            async: false,
            url: Routing.generate('area_atencion'),
            data: {especialida: v1, idmodalidad: $('#cmbModalida').val()},
            success: function (data)
            {
                $elemento.html(data);

            }
        });
    });

}
function Modalida()
{
     actualiza = 0;
    var data3, tr, contenedor_div;
    $('#ContenAtencion').empty();
    $('#home').empty();
    $('#conten_div').empty();
    $('#example1').empty();
    $('input#hEspecialidadId').val(0);
    jQuery(document).ready(function ($) {

        $.ajax({
            type: "GET",
            dataType: 'json',
            url: Routing.generate('modalida'),
            data: {idModalida: $("#cmbModalida").val()},
            success: function (data)
            {
                data3 = '<li class="active"><a href="#home" data-toggle="tab" onClick="especialidad(' + 0 + ',' + 0 + ')">Todo</a></li>';
                contenedor_div = '<div id="home" class="tab-pane active"></div>';
                $.each(data.data1, function (indice, val) {
                    data3 += '<li><a href="#' + val.id_especialidad + '" data-toggle="tab" onClick="especialidad(' + val.id_especialidad + ')">' + val.servicio + '</a></li>';
                    contenedor_div += '<div id="' + val.id_especialidad + '" class="tab-pane"></div>';

                });

                $('#ContenAtencion').append(data3);
                tr = '<div style="float: right;margin: 9px 0px 0px -15px;width:200px;">';
                tr += '<input type="text" class="txtBuscar form-control" id="buscar2" placeholder="Médico">';
                tr += '</div>';
                tr += '  <div id="MBusquedas" style="height:335px; overflow: auto;position:absolute;top:53px;right:0px;left:0px;">';
                tr += '<table  class="table-hover display " width="100%" style="margin: 0px 0 0px -5px;">';
                tr += '<thead><tr>';
                tr += '<th style="width: 12px;" ></th>';
                tr += '<th style="width: 280px;" ></th>';
                tr += '<th width="7%"  align="center"><h6">Cant. Disponible</h6></th>\
                                        <th  style="width: 242px;"  ALIGN="right"></th>\
                                        </tr>\
                                        </thead>';
                if (data.data2 === false)
                {
                    tr = '<div class="alert alert-info" role="alert" ><span style="font-size:18px;"><strong> <i class="fa fa-info-circle fa-lg"></i> </strong> Modalidad sin médico asignado para el dia de hoy.</span></div>';
                }
                else {
                    $.each(data.data2, function (indice, val) {

                        var capacidadFormated = parseInt(val.capacidad);
                        tr += '<tr class="odd" >';
                        tr += '<td class=" " align="center"><div class="icon"><i class="fa fa-user-md fa-4x"></i></div></td>';
                        tr += '<td class=" " valign="bottom">' + val.nombre_empleado + '(' + val.servicio + ')';
                        if (val.total_citas === 0)
                        {

                            tr += '&nbsp&nbsp<span class="badge bg-green" style="float: right;">' + capacidadFormated + '</span>';
                        }
                        else if (val.total_citas !== 0)
                        {

                            if (((val.total_citas / capacidadFormated) * capacidadFormated) <= (capacidadFormated * 0.25))
                            {
                                tr += '&nbsp&nbsp<span class="badge bg-green" style="float: right;">' + val.total_citas + '/' + capacidadFormated + '</span>';
                            }
                            else if (((val.total_citas / capacidadFormated) * capacidadFormated) > (capacidadFormated * 0.25) && ((val.total_citas / capacidadFormated) * capacidadFormated) <= (capacidadFormated * 0.5))
                            {
                                tr += '<span class="badge bg-blue"  style="float: right;">' + val.total_citas + '/' + capacidadFormated + '</span>';
                            }
                            else if (((val.total_citas / capacidadFormated) * capacidadFormated) > (capacidadFormated * 0.5) && ((val.total_citas / capacidadFormated) * capacidadFormated) <= (capacidadFormated * 0.75))
                            {
                                tr += '<span class="badge bg-orange"  style="float: right;">' + val.total_citas + '/' + capacidadFormated + '</span>';
                            }
                            else if (((val.total_citas / capacidadFormated) * capacidadFormated) > (capacidadFormated * 0.75))
                            {
                                tr += '<span class="badge bg-red"  style="float: right;">' + val.total_citas + '/' + capacidadFormated + '</span>';
                            }
                        }
                        tr += '<div class="progress progress-xs progress-striped active ">';
                        if (val.total_citas === '0')
                        {
                            tr += '<div class="progress-bar progress-bar-green" style="width: 0%; "></div> ';
                        }
                        else if (val.total_citas !== 0)
                        {
                            if (((val.total_citas / capacidadFormated) * capacidadFormated) <= (capacidadFormated * 0.25))
                            {
                                tr += '<div class="progress-bar progress-bar-green" style="width:' + (val.total_citas / capacidadFormated) * 100 + '%">  </div>';
                            }
                            else if (((val.total_citas / capacidadFormated) * capacidadFormated) > (capacidadFormated * 0.25) && ((val.total_citas / capacidadFormated) * capacidadFormated) <= (capacidadFormated * 0.5))
                            {
                                tr += '<div class="progress-bar progress-bar-blue" style="width:' + ((val.total_citas / capacidadFormated) * 100) + '%">  </div>';
                            }
                            else if (((val.total_citas / capacidadFormated) * capacidadFormated) > (capacidadFormated * 0.5) && ((val.total_citas / capacidadFormated) * capacidadFormated) <= (capacidadFormated * 0.75))
                            {
                                tr += '<div class="progress-bar progress-bar-warning" style="width:' + (val.total_citas / capacidadFormated) * 100 + '%">   </div>';
                            }
                            else if (((val.total_citas / capacidadFormated) * capacidadFormated) > (capacidadFormated * 0.75))
                            {
                                tr += '<div class="progress-bar progress-bar-danger" style="width:' + (val.total_citas / capacidadFormated) * 100 + '%">   </div>';
                            }
                        }
                        tr += '<td class=" "  align="center">';
                        if (val.total_citas === 0)
                        {

                            tr += '<span class="badge bg-green" align="right">' + (capacidadFormated - val.total_citas) + '</span>';
                        }
                        else if ((capacidadFormated - val.total_citas) > 0)
                        {

                            if (((val.total_citas / capacidadFormated) * capacidadFormated) <= (capacidadFormated * 0.25))
                            {

                                tr += '<span class="badge bg-green" align="right">' + (capacidadFormated - val.total_citas) + '</span>';
                            }
                            else if (((val.total_citas / capacidadFormated) * capacidadFormated) > (capacidadFormated * 0.25) && ((val.total_citas / capacidadFormated) * capacidadFormated) <= (capacidadFormated * 0.5))
                            {
                                tr += '<span class="badge bg-blue" align="right">' + (capacidadFormated - val.total_citas) + '</span>';
                            }

                            else if (((val.total_citas / capacidadFormated) * capacidadFormated) > (capacidadFormated * 0.5) && ((val.total_citas / capacidadFormated) * capacidadFormated) <= (capacidadFormated * 0.75))
                            {
                                tr += '<span class="badge bg-orange" align="right">' + (capacidadFormated - val.total_citas) + '</span>';
                            }
                            else if (((val.total_citas / capacidadFormated) * capacidadFormated) > (capacidadFormated * 0.75))
                            {
                                tr += '<span class="badge bg-red" align="right">' + (capacidadFormated - val.total_citas) + '</span>';
                            }
                            else if (capacidadFormated - val.total_citas <= 0)
                            {
                                tr += '<span class="badge bg-red" align="right">0</span>';
                            }

                        }
                        tr += '</td>';
                        tr += '</td><td class=" " ALIGN="right"><a class="btn btn-success btn-sm" id="enviar" onClick="asignar(' + val.id_empleado + ',' + val.id_servicio + ',\'' + val.servicio + '\',' + 0 + ')" >';
                        tr += '<i class="fa fa-plus-circle"></i> Asignar Cupo</a>';
                        tr += '<a class="btn btn-default btn-sm" id="enviar" onClick="detalle(' + val.id_empleado + ',' + val.id_servicio + ')">';
                        tr += '<i class="fa fa-tasks"></i> Detalle</a>';
                        tr += '<a class="btn btn-info btn-sm"  onClick="agendaMedica(' + val.id_empleado + ')">';
                        tr += '<i class="fa fa-calendar"></i> Agenda Medica</a>';
                        tr += '</td></tr>';

                    });
                }
                tr += '</tbody></table> </div>';
                $('#conten_div').append(contenedor_div);
                $('#home').append(tr);

            }
        });
    });
    return false;
}
function asignar(medico, idEspe, espe, var1)
{
    $('#modal_detalle').modal('hide');
    var data2;
    var data3;
    var data1;
    var msj = "";
    var butom, head;

    if ($("#sPaciente").val() == 0)
    {
        showDialogMsg('Campo vacio', 'Seleccionar Paciente', 'dialog-error');
    }
    else if ($("#sPrioridad").val() == 0)
    {
        showDialogMsg('Campo vacio', 'Seleccionar Prioridad', 'dialog-error');
    }
    else
    {
        $('#modal_body').empty();
        $('#botom').empty();
    
        var options = {weekday: "long", year: "numeric", month: "long", day: "numeric"};
        jQuery(document).ready(function ($) {
            $.ajax({
                async: false,
                dataType: 'json',
                url: Routing.generate('asigna_cita'),
                data: {idExpediente: $("#sPaciente").val(), prioridad: $("#sPrioridad option:selected").text(), idprioridad: $("#sPrioridad").val(),
                    medico: medico, especialida: idEspe, especialidadNombre: espe},
                success: function (data)
                {
                    if (typeof data.msj == "undefined")
                    {
                        head = '<span  style="font-weight: bold;font-size:20px;">&nbsp Detalle de Cita</span>';
                        if (typeof data.msjCupo !== "undefined")
                        {
                            jQuery(document).ready(function ($) {
                                var numExpNomPac = $('#sMovito');
                                initializeSelect2(numExpNomPac, false, false, {allowClear: false});
                            });

                            msj = '</br><div class="alert alert-warning" role="alert"><span><strong> <i class="fa fa-warning "></i> </strong>' + data.msjCupo + '</strong></div>';
                            msj += '<div class="row"  style="font-size:16px;">\
                                    <div  class="col-md-6">Motivo de sobrecupo:&nbsp \
                                        <select class="form-control"  name="sMovito" id="sMovito" >';
                            $.each(data.arrayMotivo, function (indice, val) {
                                msj += '<option value="' + val.id + '">' + val.motivo + '</option>';
                            });
                            msj += ' </select></div>\
                                              </div> ';

                        }
                        else if (typeof data.msj2 !== "undefined")
                        {

                            msj = '<div class="alert alert-warning" role="alert"><span><strong> <i class="fa fa-warning "></i> </strong>' + data.msj2 + '</span></div>';
                            msj += '<div class="row"  style="font-size:16px;">\
                                    <div  class="col-md-6">Motivo:&nbsp \
                                        <select class="form-control"  name="sMovito" id="sMovito" >';
                            $.each(data.arrayMotivo, function (indice, val) {
                                msj += '<option value="' + val.id + '">' + val.motivo + '</option>';
                            });
                            msj += ' </select></div>\
                                              </div> ';
                        }
                        data1 = '\
                                             <div class="row" style="font-size:16px;height:30px; "><div class="col-md-6">Numero de expediente:&nbsp\
                                             <span style="font-weight: bold; font-size:19px;">' + data.nExpe + '</span>\
                                             </div><div  class="col-md-4">';

                        if (data.priori == "Baja") {
                            data2 = '<span style="font-weight: bold; font-size:18px;color:#32CD32;">Prioridad ' + data.priori + '</span>';
                        } else if (data.priori == "Media") {
                            data2 = '<span style="font-weight: bold; font-size:18px;color: #F39C12;">Prioridad ' + data.priori + '</span>';
                        } else if (data.priori == 'Alta') {
                            data2 = '<span style="font-weight: bold; font-size:18px;color: #ff0000;">Prioridad ' + data.priori + '</span>';
                        }
                        data3 = '\</div>\
                                    </div>\
                                    <div class="row" style="font-size:16px;height:30px; ">\
                                        <div  class="col-md-6">Fecha de la Consulta:&nbsp<span style="font-weight: bold; font-size:18px;">' + MaysPrimera(new Date().toLocaleString("es-SV", options).replace(' 00:00:00 CST', '').toLowerCase()) + '</span> </div>\
                                        <div  class="col-md-6">Hora de la Consulta:&nbsp<span style="font-weight: bold; font-size:19px;">' + data.rhora + '</span></div>\
                                    </div>\
                                    <div class="row" style="font-size:16px;height:30px; "><div  class="col-md-6">Nombre del Paciente:&nbsp' + data.paciente + '</div>\
                                        <div  class="col-md-6">Nombre del Medico:&nbsp\
                                           ' + data.medico.toUpperCase() + '</div><div  class="col-md-3"></div>\
                                    </div><div class="row" style="font-size:16px;height:30px;"><div  class="col-md-6">Numero de consultorio:&nbsp ' + data.local + '</div>\
                                        <div  class="col-md-4">Especialidad:&nbsp' + data.nomEspe + '</div>\
                                        <div  class="col-md-3"></div></div>';
                        data3 += '<div class="row" style="font-size:16px;">\
                                        <div  class="col-md-12">Motivo de consulta:&nbsp\
                                             <textarea id="areaMotivo"class="form-control" rows="2" style="resize:none;"></textarea></div>\
                                        </div>';

                        butom = '<div Style=" margin: -10px 0 0 0;"><button type="button" class="btn btn-success btn-sm" \
                                            onClick="crearCita(' + data.idTipoCita + ',' + data.idEmp + ',' + data.idRangoH + ',' + data.idPriori + ',' + data.idEspe + ',' + data.idPaciente + ',\'' + data.nExpe + '\')">\
                                            <i class="fa fa-plus-circle"></i> Asignar Cupo</button>\
                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle"></i> Cancelar</button></div>';


                        $('#modal_body').append(head + msj + data1 + data2 + data3);

                        $('#botom').append(butom);
                        $('#modal_cita').modal('show');

                        $('div.modal-body').css('background-color', '#f7f7f9');

                    }
                    else
                    {
                        showDialogMsg('Hora de atencion', data.msj, 'dialog-warning');

                    }
                }
            });
        });
    }
    return false;
}
function MaysPrimera(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
function detalle(medico, idservicio, espe)
{
    var tr, contador = 1, color, botom;
    var fecha;

    $("#fecha").empty();
    $('#detalle').empty();
    $('#botones').empty();

    $("#empleado").empty();
    var options = {weekday: "long", year: "numeric", month: "long", day: "numeric"};

    jQuery(document).ready(function ($) {
        $.ajax({
            async: false,
            dataType: 'json',
            type: "GET",
            url: Routing.generate('agenda_dia'),
            data: {medico: medico, especialidaId: idservicio, espe: espe},
            success: function (data)
            {
                if (data.cita == '')
                {
                    tr += '<tr align="left" style="background-color:#fff;font-size:15px;">';
                    tr += ' <td class=" " colspan="7"><div class="alert alert-info" role="alert" ><span style="font-size:18px;"><strong> <i class="fa fa-info-circle fa-lg"></i> </strong> No hay citas para el médico el dia de hoy.</span></div></td></tr>';
                }
                else {
                    $.each(data.cita, function (indice, val) {

                        if (val.prioridad == 'Alta')
                        {
                            color = '#FFC0CB'
                        }
                        else if (val.prioridad == 'Media')
                        {
                            color = '#FFFACD'
                        }
                        else if (val.prioridad == 'Baja')
                        {
                            color = '#99D699'
                        }
                        else
                        {
                            color = '#fff'
                        }

                        tr += '<tr align="left" style="background-color:' + color + ';font-size:15px;">';
                        tr += ' <td class=" " align="center" width="5%";>' + contador + '</td>';
                        tr += '<td class=" " width="10%">' + val.numero_expediente + '</td>';
                        tr += '<td class=" "  width="40%">' + val.paciente + '</td>';
                        tr += '<td class=" "  width="15%">' + val.estado + '</td>';
                        tr += '<td class=" "  width="12%">' + val.fecha + ' ' + val.rangohora.toUpperCase() + '</td>';
                        tr += '<td class=" "  width="10%">';

                        if (val.prioridad === null)
                        {
                            tr += '--</td>';
                        }
                        else
                        {
                            tr += val.prioridad + '</td>';
                        }

                        tr += '<td class=" " align="center" style="font-weight: bold; font-size:14pxp;" > <a class="btn btn-info btn-md"  href="' + Routing.generate('citasgetcomprobante') + '?id=' + val.idcita + '" target="_blank" ><i class="fa fa-print fa-2x"></i></a></td></tr>';
                        contador = contador + 1;
                    });
                }
                botom = '<div Style=" margin: -10px 0 0 0;"><button type="button" class="btn btn-success btn-sm" data-dismiss="modal"';
                         if (data.estadoBoton ==0)
                        {
                           botom +='disabled="disabled"';
                        }
                         
                botom +='onClick="asignar(' + data.Idempleado + ',' + data.especialidadId + ',\'' + data.especialidad + '\')">';
                botom +=' <i class="fa fa-plus-circle"></i> Asignar Cupo</button>';
                botom +=' <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"> <i class="fa fa-times-circle"></i> Cancelar</button><div>';

                var options = {weekday: "long", year: "numeric", month: "long", day: "numeric"};
                fecha = MaysPrimera(new Date().toLocaleString("es-SV", options).replace(' 00:00:00 CST', '').toLowerCase());
                $("#empleado").append(data.empleado);
                $("#fecha").append(fecha);
                $("#detalle").append(tr);
                $("#botones").append(botom);
                $('#modal_detalle').modal('show');
                $('div.modal-body').css('background-color', '#f7f7f9');


            }
        });
    });
    return false;
}

function crearCita(idTipocita, idEmpleado, idRangohora, id_prioridad, Idespecialida, IdPaciente, expediente)
{
    var error;
    if($('#cmb_movito').val()==='')
    { error = '<br><div class="row" >\
                <div  class="col-md-12"><div class="alert alert-error" role="alert" >\
                 <span style="font-size:18px;"><strong> <i class="fa fa-times-circle fa-lg"></i> \
                 </strong> Seleccione el Motivo de consulta.</span></div></div></div>';
        $('#modal_body').append(error);
    }
    else if ($("#areaMotivo").val() === '')
    {
        error = '<br><div class="row" >\
                <div  class="col-md-12"><div class="alert alert-error" role="alert" >\
                 <span style="font-size:18px;"><strong> <i class="fa fa-times-circle fa-lg"></i> \
                 </strong> Introducir motivo de consulta.</span></div></div></div>';
        $('#modal_body').append(error);
    }
    else {

        jQuery(document).ready(function ($) {
            $.ajax({
                dataType: 'json',
                url: Routing.generate('crear_cita'),
                data: {IdPaciente: IdPaciente, idEmpleado: idEmpleado, idTipocita: idTipocita,
                    idRangohora: idRangohora, id_prioridad: id_prioridad, Idespecialida: Idespecialida,
                    expediente: expediente, motivo: $('#cmb_movito').val(), motivoCons: $("#areaMotivo").val()},
                success: function (data)
                {
                    if (typeof data.msj1 != "undefined") {
                        showDialogMsg('Error al asignar cita', data.msj1, 'dialog-error');
                    }
                    else if (typeof data.msj2 != "undefined") {
                        showDialogMsg('Asignación exitosa', data.msj2, 'dialog-success');

                        if (actualiza === 0)
                        {
                            especialidad(actualiza);
                        }
                        else {
                            especialidad(Idespecialida);
                        }

                    }
                    else if (typeof data.msj3 != "undefined") {
                        showDialogMsg('Error al asignar cita', data.msj3, 'dialog-error');
                    }
                    $('#modal_cita').modal('toggle');
                }
            });
        });
    }
}


function areaModalida()
{
    jQuery(document).ready(function ($) {
        $.ajax({
            type: "GET",
            url: Routing.generate('area_modalida'),
            data: {idModalida: $('#cmbModalida').val()},
            success: function (data)
            {
                $("#modal_body_detalle").html(data);
                $('#modal_detalle1').modal('show');
            }
        });
    });
    return false;
}
