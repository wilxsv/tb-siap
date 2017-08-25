/*  src/Minsal/SiapsBundle/Resource/public/js/MntPacienteAdmin/MntPaciente_edit.html.twig
 *  Se utiliza para la creación y actualización de los pacientes.
 */
$(document).ready(function () {

    function validaFormatoDUI(dui,nombreElemento,valorSeccionadoTipoDocumento){
        if(dui!='_________-_' || dui!=''){
            if(valorSeccionadoTipoDocumento=='DUI'){
                resultado =validateDUI(dui);
                if (!resultado){
                    var nombre=nombreElemento.split('_');
                    switch (nombre[1]) {
                        case 'numeroDocIdePaciente':
                            etiqueta= 'del Paciente'
                            break;
                        case 'numeroDocIdeResponsable':
                            etiqueta= 'de la Persona Responsable'
                            break;
                        case 'numeroDocIdeProporDatos':
                            etiqueta= 'de la Persona que proporciona los datos'
                                break;
                    }
                    var title='Error';
                    var body="El número del DUI no es valido para el Documento "+etiqueta;
                    var clase='dialog-error';
                    var arrayBtns = [{text: 'Cerrar',
                                click: function( event, ui) {
                                jQuery( this ).dialog( "close" );
                              }}
                            ];
                    showDialogMsg(title, body, clase, '', arrayBtns, false, null, true);
                }
            }
        }
    }

    $('select[id$="_horaNacimiento_hour"]').select2({
        placeholder: 'Hora',
        allowClear: true
    });

    $('select[id$="_horaNacimiento_minute"]').select2({
        placeholder: 'Minutos',
        allowClear: true
    }).on('select2-close', function () {
        calcular_edad('h');
    });

    $('select[id$="_idTipoVeterano"]').select2({
        placeholder: 'Tipo de Afiliación  ...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idParentescoBeneficiarioVeterano"]').select2({
        placeholder: 'Parentesco del Beneficiario ...',
        allowClear: true,
        width: '100%'
    });

    initializeSelect2($('select[id$="_idSexo"]'), true, false, {
        placeholder: 'Sexo..',
        width: '100%'
    })


    $('select[id$="_idPaisNacimiento"]').select2({
        placeholder: 'Pais de Nacimiento...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idDepartamentoNacimiento"]').select2({
        placeholder: 'Departamento de Nacimiento...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idMunicipioNacimiento"]').select2({
        placeholder: 'Municipio de Nacimiento...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idNacionalidad"]').select2({
        placeholder: 'Nacionalidad...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idDocPaciente"]').select2({
        placeholder: 'Seleccione...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idEstadoCivil"]').select2({
        placeholder: 'Estado Civil...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idOcupacion"]').select2({
        placeholder: 'Ocupacion...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="idPaisDomicilio"]').select2({
        placeholder: 'Pais de Domicilio...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idDepartamentoDomicilio"]').select2({
        placeholder: 'Departamento de Domicilio...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idMunicipioDomicilio"]').select2({
        placeholder: 'Municipio de Domicilio...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_areaGeograficaDomicilio"]').select2({
        placeholder: 'Area Geografica de Domicilio...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idCantonDomicilio"]').select2({
        placeholder: 'Canton de Domicilio...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idAreaCotizacion"]').select2({
        placeholder: 'Area de Cotizacion...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idParentescoResponsable"]').select2({
        placeholder: 'Parentesco del Responsable...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idDocResponsable"]').select2({
        placeholder: 'Tipo de Documento...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idParentescoProporDatos"]').select2({
        placeholder: 'Seleccione...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idDocProporcionoDatos"]').select2({
        placeholder: 'Seleccione...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idCreacionExpediente"]').select2({
        placeholder: 'Seleccione...',
        allowClear: true,
        width: '100%'
    });

    $('select[id$="_idPaisNacimiento"]').focusout(function () {
        $('select[id$="_idDepartamentoNacimiento"]').focus();
    });

    $('select[id$="_idDepartamentoNacimiento"]').focusout(function () {
        $('select[id$="_idMunicipioNacimiento"]').focus();
    })
    $('select[id$="_horaNacimiento_minute"]').focusout(function () {
        $('select[id$="_idSexo"]').focus();
    })

    $('.deshabilitados').attr('disabled', 'disabled');

    $('input[id$="_fechaNacimiento"]').mask("99/99/9999").focusout(function () {
        if($(this).val()!=''){
            if($(this).val()!='__/__/____'){
                calcular_edad('f');
            }
        }
    });

    if ($('input[id$="_fechaNacimiento"]').val() != '' &&  $('input[id$="_fechaNacimiento"]').val() != null) {
        if ($('select[id$="_horaNacimiento_minute"]').select2('val') != '')
            calcular_edad('h');
        else
            calcular_edad('f');
    }

    function opcionesDocumento(nombreElemento,nombreNumero) {
         elemento=$('select[id$="_id'+nombreElemento+'"] option:selected');
         switch (elemento.text()) {
             case 'Ninguno':
                 $('input[id$="_numero'+nombreNumero+'"]').attr('disabled', 'disabled');
                 break;
            case 'DUI':
                 $('input[id$="_numero'+nombreNumero+'"]').removeAttr('disabled');
                 $('input[id$="_numero'+nombreNumero+'"]').mask("99999999-9").blur(function () {
                    validaFormatoDUI($(this).val(),$(this).attr('id'),elemento.text());
                });
                break;
            case 'NIT':
                 $('input[id$="_numero'+nombreNumero+'"]').removeAttr('disabled');
                 $('input[id$="_numero'+nombreNumero+'"]').mask("9999-999999-999-9").blur(function () {
                     validaFormatoDUI($(this).val(),$(this).attr('id'),'');
                 });
            break;
            default:
                 $('input[id$="_numero'+nombreNumero+'"]').removeAttr('disabled').blur(function () {
                     validaFormatoDUI($(this).val(),$(this).attr('id'),'');
                 });
                 $('input[id$="_numero'+nombreNumero+'"]').unmask();
         }
    }
    opcionesDocumento('DocPaciente','DocIdePaciente');
    opcionesDocumento('DocResponsable','DocIdeResponsable');
    opcionesDocumento('DocProporcionoDatos','DocIdeProporDatos');

    $('.telefono').mask("9999-9999");

    $('input[id$="_numeroAfiliacion"]').blur(function () {
        $(this).val(($(this).val()).replace(/[^\d]/g, ''))
    }
    );

    $('input.limpiar').blur(function () {
        $(this).val(limpiar_nombres($(this).val()))
    });

    $('.mayuscula').blur(function () {
        $(this).val($(this).val().toUpperCase())
    });

    $('#edad').focusout(function () {
        if (!(/día/.test($(this).val())) && !(/año/.test($(this).val())) && !(/mes/.test($(this).val()))) {
            $(this).val(($(this).val()).replace(/[^\d]/g, ''))
            var regexp = /^[\d]{2,3}$/;
            if (!regexp.test($('#edad').val())) {
                var title='Error';
                var body="Para hacer el cálculo de la edad debe ingresar un número entero de dos o tres dígitos";
                var clase='dialog-error';
                var arrayBtns = [{text: 'Cerrar',
                            click: function( event, ui) {
                            jQuery( this ).dialog( "close" );
                            $('#edad').val('');
                          }}
                        ];
                showDialogMsg(title, body, clase, '', arrayBtns, false, null, true);
            }
            else {
                var fecha = new Date();
                var anio = fecha.getFullYear();
                var anio_nacimiento = anio - $(this).val();
                $('input[id$="_fechaNacimiento"]').val('01/01/' + anio_nacimiento);
            }
        }
    });

    $('select[id$="_idDocPaciente"]').change(function () {
        $('input[id$="_numeroDocIdePaciente"]').val('');
        opcionesDocumento('DocPaciente','DocIdePaciente');
    })

    $('select[id$="_idDocResponsable"]').change(function () {
        $('input[id$="_numeroDocIdeResponsable"]').val('');
        opcionesDocumento('DocResponsable','DocIdeResponsable');
    });

    $('select[id$="_idDocProporcionoDatos"]').change(function () {
        $('input[id$="_numeroDocIdeProporDatos"]').val('');
        opcionesDocumento('DocProporcionoDatos','DocIdeProporDatos');
    });


    if ($('input:checkbox[id$="_asegurado"]').prop('checked')) {
        $('select[id$="_idAreaCotizacion"]').removeAttr('disabled');
        $('input[id$="_numeroAfiliacion"]').removeAttr('disabled');
    } else {
        $('select[id$="_idAreaCotizacion"] option[value=""]').attr('selected', true);
        $('select[id$="_idAreaCotizacion"]').attr('disabled', 'disabled');
        $('input[id$="_numeroAfiliacion"]').val('');
        $('input[id$="_numeroAfiliacion"]').attr('disabled', 'disabled');
        $('select[id$="_idTipoVeterano"]').select2('val', '');

    }

    $('input:checkbox[id$="_asegurado"]').on('ifChecked', function (event) {
        $('select[id$="_idAreaCotizacion"]').removeAttr('disabled');
        $('input[id$="_numeroAfiliacion"]').removeAttr('disabled');
    });

    $('input:checkbox[id$="_asegurado"]').on('ifUnchecked', function (event) {
        $('div[id$=_numeroAfiliacion]').show();
        $('div[id$=_idTipoVeterano]').hide();
        $('div[id$=_idParentescoBeneficiarioVeterano]').hide();
        $('select[id$="_idAreaCotizacion"]').select2('val', '');
        $('select[id$="_idAreaCotizacion"]').attr('disabled', 'disabled');
        $('input[id$="_numeroAfiliacion"]').val('');
        $('input[id$="_numeroAfiliacion"]').attr('disabled', 'disabled');
        $('select[id$="_idTipoVeterano"]').select2('val', '');
        $('select[id$="_idParentescoBeneficiarioVeterano"]').select2('val', '');
    });

    /*LIMPIAR APELLIDO CASADA SI ES HOMBRE*/
    $('select[id$="_idSexo"]').change(function () {
        if ($('select[id$="_idSexo"]').select2('val') == '1' || $('select[id$="_idSexo"]').select2('val') == '3') {
            $('input[id$="_apellidoCasada"]').attr('disabled', 'disabled');
            $('input[id$="_apellidoCasada"]').val('');
        }
        else
            $('input[id$="_apellidoCasada"]').removeAttr('disabled');
    });

    if ($('select[id$="_idSexo"]').select2('val') == '1' || $('select[id$="_idSexo"]').select2('val') == '3')
        $('input[id$="_apellidoCasada"]').attr('disabled', 'disabled');
    else
        $('input[id$="_apellidoCasada"]').removeAttr('disabled');

    //COLOCAR NACIONALIDAD SALVADOREÑO POR DEFECTO
    if ($('select[id$="_idNacionalidad"]').select2('val') == '') {
        $('select[id$="_idNacionalidad"]').select2('val', 1);
    }

    /*LLENAR DATOS PERSONA RESPONSABLE*/
    $('select[id$="_idParentescoResponsable"]').change(function () {
        if ($('select[id$="_idParentescoResponsable"] option:selected').text() == 'Madre') {
            $('input[id$="_nombreResponsable"]').val($('input[id$="_nombreMadre"]').val());
            $('select[id$="_idDocResponsable"]').select2('val', "");
            $('input[id$="_numeroDocIdeResponsable"]').val("");
            $('input[id$="_direccionResponsable"]').val("");
            $('input[id$="_telefonoResponsable"]').val("");

        }
        else if ($('select[id$="_idParentescoResponsable"] option:selected').text() == 'Padre') {
            $('input[id$="_nombreResponsable"]').val($('input[id$="_nombrePadre"]').val());
            $('select[id$="_idDocResponsable"]').select2('val', "");
            $('input[id$="_numeroDocIdeResponsable"]').val("");
            $('input[id$="_direccionResponsable"]').val("");
            $('input[id$="_telefonoResponsable"]').val("");
        }
        else {
            if ($('select[id$="_idParentescoResponsable"] option:selected').text() == 'Compañero(a) ' || $('select[id$="_idParentescoResponsable"] option:selected').text() == 'Esposo(a)') {
                $('input[id$="_nombreResponsable"]').val($('input[id$="_nombreConyuge"]').val());
                $('select[id$="_idDocResponsable"]').select2('val', "");
                $('input[id$="_numeroDocIdeResponsable"]').val("");
                $('input[id$="_direccionResponsable"]').val("");
                $('input[id$="_telefonoResponsable"]').val("");
            }
            else if ($('select[id$="_idParentescoResponsable"] option:selected').text() == 'El paciente') {
                $('input[id$="_nombreResponsable"]').val($('input[id$="_primerNombre"]').val() + ' ' + $('input[id$="_primerApellido"]').val());
                $('select[id$="_idDocResponsable"]').select2('val', $('select[id$="_idDocPaciente"]').select2('val'));
                $('input[id$="_numeroDocIdeResponsable"]').val($('input[id$="_numeroDocIdePaciente"]').val());
                $('input[id$="_direccionResponsable"]').val($('input[id$="_direccion"]').val());
                $('input[id$="_telefonoResponsable"]').val($('input[id$="_telefonoCasa"]').val());
            }
            else {
                $('input[id$="_nombreResponsable"]').val("");
                $('select[id$="_idDocResponsable"]').select2('val', "");
                $('input[id$="_numeroDocIdeResponsable"]').val("");
                $('input[id$="_direccionResponsable"]').val("");
                $('input[id$="_telefonoResponsable"]').val("");
            }

        }
    });
    /*LLENAR DATOS PERSONA PROPORCIONÓ DATOS*/
    $('select[id$="_idParentescoProporDatos"]').change(function () {
        if ($('select[id$="_idParentescoProporDatos"] option:selected').text() == 'Madre') {
            $('input[id$="_nombreProporcionoDatos"]').val($('input[id$="_nombreMadre"]').val());
            if ($('select[id$="_idParentescoResponsable"] option:selected').text() == 'Madre') {
                $('select[id$="_idDocProporcionoDatos"]').select2('val', $('select[id$="_idDocResponsable"]').select2('val'));
                $('input[id$="_numeroDocIdeProporDatos"]').val($('input[id$="_numeroDocIdeResponsable"]').val());
            } else {
                $('select[id$="_idDocProporcionoDatos"]').val("");
                $('input[id$="_numeroDocIdeProporDatos"]').val("");
            }
        }
        else if ($('select[id$="_idParentescoProporDatos"] option:selected').text() == 'Padre') {
            $('input[id$="_nombreProporcionoDatos"]').val($('input[id$="_nombrePadre"]').val());
            if ($('select[id$="_idParentescoResponsable"] option:selected').text() == 'Padre') {
                $('select[id$="_idDocProporcionoDatos"]').select2('val', $('select[id$="_idDocResponsable"]').select2('val'));
                $('input[id$="_numeroDocIdeProporDatos"]').val($('input[id$="_numeroDocIdeResponsable"]').val());
            } else {
                $('select[id$="_idDocProporcionoDatos"]').select2('val', "");
                $('input[id$="_numeroDocIdeProporDatos"]').val("");
            }
        }
        else {
            if ($('select[id$="_idParentescoProporDatos"] option:selected').text() == 'Compañero(a) ' || $('select[id$="_idParentescoProporDatos"] option:selected').text() == 'Esposo(a)') {
                $('input[id$="_nombreProporcionoDatos"]').val($('input[id$="_nombreConyuge"]').val());
                if ($('select[id$="_idParentescoResponsable"] option:selected').text() == 'Compañero(a) ' || $('select[id$="_idParentescoResponsable"] option:selected').text() == 'Esposo(a)') {
                    $('select[id$="_idDocProporcionoDatos"]').select2('val', $('select[id$="_idDocResponsable"]').select2('val'));
                    $('input[id$="_numeroDocIdeProporDatos"]').val($('input[id$="_numeroDocIdeResponsable"]').val());
                } else {
                    $('select[id$="_idDocProporcionoDatos"]').val("");
                    $('input[id$="_numeroDocIdeProporDatos"]').val("");
                }
            }
            else if ($('select[id$="_idParentescoProporDatos"] option:selected').text() == 'El paciente') {
                //NOMBRE COMPLETO DEL PACIENTE EN PROPORCIONO DATOS
                nombre = $('input[id$="_primerNombre"]').val();
                if ($('input[id$="_segundoNombre"]').val() != "")
                    nombre += ' ' + $('input[id$="_segundoNombre"]').val();
                if ($('input[id$="_tercerNombre"]').val() != "")
                    nombre += ' ' + $('input[id$="_tercerNombre"]').val();
                nombre += ' ' + $('input[id$="_primerApellido"]').val();
                if ($('input[id$="_segundoApellido"]').val() != "")
                    nombre += ' ' + $('input[id$="_segundoApellido"]').val();
                if ($('input[id$="_apellidoCasada"]').val() != "")
                    nombre += ' ' + $('input[id$="_apellidoCasada"]').val();
                $('input[id$="_nombreProporcionoDatos"]').val(nombre);

                $('select[id$="_idDocProporcionoDatos"]').select2('val', $('select[id$="_idDocPaciente"]').select2('val'));
                $('input[id$="_numeroDocIdeProporDatos"]').val($('input[id$="_numeroDocIdePaciente"]').val()).mask("99999999-9").blur(function () {
                    validaFormatoDUI($(this).val(),$(this).attr('id'),$('select[id$="_idParentescoProporDatos"] option:selected').text());
                });
            } else {
                if ($('select[id$="_idParentescoProporDatos"] option:selected').text() == $('select[id$="_idParentescoResponsable"] option:selected').text()) {
                    $('input[id$="_nombreProporcionoDatos"]').val($('input[id$="_nombreResponsable"]').val());
                    $('select[id$="_idDocProporcionoDatos"]').select2('val', $('select[id$="_idDocResponsable"]').select2('val'));
                    $('input[id$="_numeroDocIdeProporDatos"]').val($('input[id$="_numeroDocIdeResponsable"]').val());
                }
                else {
                    $('input[id$="_nombreProporcionoDatos"]').val("");
                    $('select[id$="_idDocProporcionoDatos"]').select2('val', "");
                    $('input[id$="_numeroDocIdeProporDatos"]').val("");
                }
            }

        }
    });
    /*CARGAR DEPARTAMENTOS NACIMIENTO*/
    $('select[id$="_idPaisNacimiento"]').change(function () {
        $('select[id$="_idDepartamentoNacimiento"]').children().remove();
        $('select[id$="_idDepartamentoNacimiento"]').append('<option></option>');
        $('select[id$="_idDepartamentoNacimiento"]').select2({
            placeholder: 'Departamento de Nacimiento...',
            allowClear: true,
            width: '100%'
        });
        $('select[id$="_idMunicipioNacimiento"]').children().remove();
        $('select[id$="_idMunicipioNacimiento"]').append('<option></option>');
        $('select[id$="_idMunicipioNacimiento"]').select2({
            placeholder: 'Municipio de Nacimiento...',
            allowClear: true,
            width: '100%'
        });
        if ($('select[id$="_idPaisNacimiento"]').select2('val') == '') {
            $('select[id$="_idDepartamentoNacimiento"]').attr('disabled', 'disabled');
        } else {
            $.getJSON(Routing.generate('get_departamentos') + '?idPais=' + $('select[id$="_idPaisNacimiento"]').select2('val'),
                    function (data) {
                        $.each(data.deptos, function (indice, depto) {
                            $('select[id$="_idDepartamentoNacimiento"]').append($('<option>', {value: depto.id, text: depto.nombre}));
                        });
                        $('select[id$="_idDepartamentoNacimiento"]').removeAttr('disabled');
                        $('select[id$="_idMunicipioNacimiento"]').attr('disabled', 'disabled');
                    });

        }

    });

    if (($('select[id$="_idPaisNacimiento"]').select2('val') == 68 && $('select[id$="_idDepartamentoNacimiento"]').select2('val') == "")) {
        $('select[id$="_idPaisNacimiento"]').select2('val', 68);
        $('select[id$="_idDepartamentoNacimiento"]').children().remove();
        $('select[id$="_idDepartamentoNacimiento"]').append('<option></option>');
        $('select[id$="_idDepartamentoNacimiento"]').select2({
            placeholder: 'Departamento de Nacimiento...',
            allowClear: true,
            width: '100%'
        });
        $.getJSON(Routing.generate('get_departamentos') + '?idPais=' + $('select[id$="_idPaisNacimiento"]').select2('val'),
                function (data) {
                    $.each(data.deptos, function (indice, depto) {
                        $('select[id$="_idDepartamentoNacimiento"]').append($('<option>', {value: depto.id, text: depto.nombre}));
                    });
                    $('select[id$="_idDepartamentoNacimiento"]').removeAttr('disabled');
                });

    }
    if(($('select[id$="_idPaisNacimiento"]').select2('val')==108 || $('select[id$="_idPaisNacimiento"]').select2('val')==94 || $('select[id$="_idPaisNacimiento"]').select2('val')==157) && $('select[id$="_idDepartamentoNacimiento"]').val()=='') {
        $('select[id$="_idDepartamentoNacimiento"]').children().remove();
        $('select[id$="_idDepartamentoNacimiento"]').append('<option></option>');
        $('select[id$="_idDepartamentoNacimiento"]').select2({
            placeholder: 'Departamento de Nacimiento...',
            allowClear: true,
            width: '100%'
        });
        $.getJSON(Routing.generate('get_departamentos') + '?idPais=' + $('select[id$="_idPaisNacimiento"]').select2('val'),
                function (data) {
                    $.each(data.deptos, function (indice, depto) {
                        $('select[id$="_idDepartamentoNacimiento"]').append($('<option>', {value: depto.id, text: depto.nombre}));
                    });
                    $('select[id$="_idDepartamentoNacimiento"]').removeAttr('disabled');
                });

    }
    /*CARGAR MUNICIPIOS NACIMIENTO*/
    $('select[id$="_idDepartamentoNacimiento"]').on('change', function (e) {
        $('select[id$="_idMunicipioNacimiento"]').children().remove();
        $('select[id$="_idMunicipioNacimiento"]').append('<option></option>');
        $('select[id$="_idMunicipioNacimiento"]').select2({
            placeholder: 'Municipio de Nacimiento...',
            allowClear: true,
            width: '100%'
        });
        if (!e.val) {
            $('select[id$="_idMunicipioNacimiento"]').attr('disabled', 'disabled');
        } else {
            $.getJSON(Routing.generate('get_municipios') + '?idDepartamento=' + $('select[id$="_idDepartamentoNacimiento"]').select2('val'),
                    function (data) {
                        $.each(data.municipios, function (indice, munic) {
                            $('select[id$="_idMunicipioNacimiento"]').append($('<option>', {value: munic.id, text: munic.nombre}));
                        });
                        $('select[id$="_idMunicipioNacimiento"]').removeAttr('disabled');
                    });

        }

    });

    /*CARGAR MUNICIPIOS DE DOMICILIO*/
    $('select[id$="_idDepartamentoDomicilio"]').on('change', function (e) {
        $('select[id$="_idMunicipioDomicilio"]').children().remove();
        $('select[id$="_idMunicipioDomicilio"]').append('<option></option>');
        $('select[id$="_idMunicipioDomicilio"]').select2({
            placeholder: 'Municipio de Domicilio...',
            allowClear: true,
            width: '100%'
        });
        if ($('select[id$="_idDepartamentoDomicilio"]').select2('val') == '' ) {
            $('select[id$="_idMunicipioDomicilio"]').attr('disabled', 'disabled');
        } else {
            $.getJSON(Routing.generate('get_municipios') + '?idDepartamento=' + $('select[id$="_idDepartamentoDomicilio"]').select2('val'),
                    function (data) {
                        $.each(data.municipios, function (indice, munic) {
                            $('select[id$="_idMunicipioDomicilio"]').append($('<option>', {value: munic.id, text: munic.nombre}));
                        });
                        $('select[id$="_idMunicipioDomicilio"]').removeAttr('disabled');
                    });
        }

    }).focusout(function () {
        $('select[id$="_idMunicipioDomicilio"]').focus();
    });

    /*LIMPIAR CANTONES DE DOMICILIO AL CAMBIAR MUNICIPIO*/
    $('select[id$="_idMunicipioDomicilio"]').on('change', function (e) {
        $('select[id$="_idCantonDomicilio"]').children().remove();
        $('select[id$="_idCantonDomicilio"]').append('<option></option>');
        $('select[id$="_idCantonDomicilio"]').select2({
            placeholder: 'Cantón de Domicilio...',
            allowClear: true,
            width: '100%'
        });
        $('select[id$="_areaGeograficaDomicilio"]').change();
    }).focusout(function () {
        $('select[id$="_areaGeograficaDomicilio"]').focus();
    });

    /*CUANDO CARGA EL MUNICIPIO DE DOMICILIO SI ESTA LLENO*/
    if ($('select[id$="_idDepartamentoNacimiento"]').length>0 && $('select[id$="_idDepartamentoNacimiento"]').select2('val') !== '') {
        $('select[id$="_idDepartamentoNacimiento"]').removeAttr('disabled');
        valor = $('select[id$="_idMunicipioNacimiento"]').val();
        $('select[id$="_idMunicipioNacimiento"]').children().remove();
        $('select[id$="_idMunicipioNacimiento"]').append('<option></option>');
        $.getJSON(Routing.generate('get_municipios') + '?idDepartamento=' + $('select[id$="_idDepartamentoNacimiento"]').select2('val'),
                function (data) {
                    $.each(data.municipios, function (indice, munic) {
                        $('select[id$="_idMunicipioNacimiento"]').append($('<option>', {value: munic.id, text: munic.nombre}));
                    });
                    $('select[id$="_idMunicipioNacimiento"]').select2('val', valor);
                });

        $('select[id$="_idMunicipioNacimiento"]').removeAttr('disabled');
    }

    if ($('select[id$="_idDepartamentoDomicilio"]').select2('val') != '' ) {

        valorDoc = $('select[id$="_idMunicipioDomicilio"]').select2('val');
        $('select[id$="_idMunicipioDomicilio"]').children().remove();
        $.getJSON(Routing.generate('get_municipios') + '?idDepartamento=' + $('select[id$="_idDepartamentoDomicilio"]').select2('val'),
                function (data) {
                    $.each(data.municipios, function (indice, municDoc) {
                        $('select[id$="_idMunicipioDomicilio"]').append($('<option>', {value: municDoc.id, text: municDoc.nombre}));
                    });
                    $('select[id$="_idMunicipioDomicilio"]').select2('val', valorDoc);
                    $('select[id$="_idMunicipioDomicilio"]').removeAttr('disabled');
                });


    }

    /*CARGAR CANTONES DE DOMICILIO*/
    $('select[id$="_areaGeograficaDomicilio"]').on('change', function (e) {
        $('select[id$="_idCantonDomicilio"]').children().remove();
        $('select[id$="_idCantonDomicilio"]').append('<option></option>');
        $('select[id$="_idCantonDomicilio"]').select2({
            placeholder: 'Cantón de Domicilio...',
            allowClear: true,
            width: '100%'
        });
        if ($('select[id$="_areaGeograficaDomicilio"]').select2('val') != '') {
            if ($('select[id$="_areaGeograficaDomicilio"]').select2('val') != 2) {
                $('select[id$="_idCantonDomicilio"]').attr('disabled', 'disabled');
            } else {
                if ($('select[id$="_idMunicipioDomicilio"]').select2('val') != '') {
                    $.getJSON(Routing.generate('get_cantones') + '?idMunicipio=' + $('select[id$="_idMunicipioDomicilio"]').select2('val'),
                            function (data) {
                                $.each(data.cantones, function (indice, canton) {
                                    $('select[id$="_idCantonDomicilio"]').append($('<option>', {value: canton.id, text: canton.nombre}));
                                });
                                $('select[id$="_idCantonDomicilio"]').removeAttr('disabled');
                            });
                } else {
                    $('select[id$="_idCantonDomicilio"]').attr('disabled', 'disabled');
                }
            }
        } else {
            if ($('select[id$="_areaGeograficaDomicilio"]').select2('val') != 2) {
                $('select[id$="_idCantonDomicilio"]').attr('disabled', 'disabled');
            } else {
                if ($('select[id$="_idMunicipioDomicilio"]').select2('val') != '') {
                    $.getJSON(Routing.generate('get_cantones') + '?idMunicipio=' + $('select[id$="_idMunicipioDomicilio"]').select2('val'),
                            function (data) {
                                $.each(data.cantones, function (indice, canton) {
                                    $('select[id$="_idCantonDomicilio"]').append($('<option>', {value: canton.id, text: canton.nombre}));
                                });
                                $('select[id$="_idCantonDomicilio"]').removeAttr('disabled');
                            });
                } else {
                    $('select[id$="_idCantonDomicilio"]').attr('disabled', 'disabled');
                }
            }
        }
    }).focusout(function () {
        $('select[id$="_idCantonDomicilio"]').focus();
    });

    //AGREGANDO JSON PARA CARGAR LOS PAISES ALEDAÑOS A EL SALVADOR
    if ($('select[id$="_idDepartamentoDomicilio"]').select2('val') == '') {
        $.getJSON(Routing.generate('get_paises'), function (data) {
            $.each(data.paises, function (indice, aux) {
                $('#idPaisDomicilio').append($('<option>', {value: aux.id, text: aux.nombre}));
            });
            $('#idPaisDomicilio').select2('val', '68');
        });

        $('select[id$="_idDepartamentoDomicilio"]').children().remove();
        $('select[id$="_idDepartamentoDomicilio"]').append('<option></option>');

        $.getJSON(Routing.generate('get_departamentos') + '?idPais=68', function (data) {
            $.each(data.deptos, function (indice, depto) {
                $('select[id$="_idDepartamentoDomicilio"]').append($('<option>', {value: depto.id, text: depto.nombre}));
            });
        });

        $('select[id$="_idDepartamentoDomicilio"]').removeAttr('disabled');
        $('input[id$="_primerApellido"]').focus();
    } else {
        $.getJSON(Routing.generate('get_pais_depto') + '?idDepartamento=' + $('select[id$="_idDepartamentoDomicilio"]').select2('val'), function (datos) {
            $.getJSON(Routing.generate('get_paises'), function (data) {
                $.each(data.paises, function (indice, aux2) {
                    $('#idPaisDomicilio').append($('<option>', {value: aux2.id, text: aux2.nombre}));
                });
                $('#idPaisDomicilio').select2('val', datos.pais);
            });
        });
    }
    //AL CAMBIAR EL PAIS DE DOMICILIO QUE CARGUE LOS DEPARTAMENTO DE DOMICILIO.
    $('#idPaisDomicilio').on('change', function (e) {
        $('select[id$="_idDepartamentoDomicilio"]').children().remove();
        $('select[id$="_idDepartamentoDomicilio"]').append('<option></option>');
        $('select[id$="_idDepartamentoDomicilio"]').select2({
            placeholder: 'Departamento de Domicilio...',
            allowClear: true,
            width: '100%'
        });
        $('select[id$="_idMunicipioDomicilio"]').children().remove();
        $('select[id$="_idMunicipioDomicilio"]').append('<option></option>');
        $('select[id$="_idMunicipioDomicilio"]').select2({
            placeholder: 'Municipio de Domicilio...',
            allowClear: true,
            width: '100%'
        });

        $.getJSON(Routing.generate('get_departamentos') + '?idPais=' + $('#idPaisDomicilio').select2('val'),
                function (data) {
                    $.each(data.deptos, function (indice, depto) {
                        $('select[id$="_idDepartamentoDomicilio"]').append($('<option>', {value: depto.id, text: depto.nombre}));
                    });
                    $('select[id$="_idDepartamentoDomicilio"]').change();
                    $('select[id$="_idMunicipioDomicilio"]').change();
                    $('select[id$="_areaGeograficaDomicilio"]').change();
                    $('select[id$="_idMunicipioDomicilio"]').attr('disabled', 'disabled');
                });
    });

    //PARA CALCULAR LA EDAD DEL PACIENTE
    function calcular_edad(tipo) {
        if (tipo == 'h')
            $.getJSON(Routing.generate('edad_paciente') + '?fecha_nacimiento=' + $('input[id$="_fechaNacimiento"]').val() + '&hora_nacimiento=' + $('select[id$="_horaNacimiento_hour"]').select2('val') + ':' + $('select[id$="_horaNacimiento_minute"]').select2('val'),
                    function (data) {
                        $('input[id="edad"]').val(data.edad);
                    });
        else
            $.getJSON(Routing.generate('edad_paciente') + '?fecha_nacimiento=' + $('input[id$="_fechaNacimiento"]').val(),
                    function (data) {
                        $('input[id="edad"]').val(data.edad);
                    });
    }

    //VETERANO DE GUERRA
    $('div[id$=_idParentescoBeneficiarioVeterano]').hide();
    $('div[id$=_idTipoVeterano]').hide();
    $('select[id$="_idAreaCotizacion"]').on('change', function (e) {
        switch (e.val) {
            case '12':
                $('div[id$=_numeroAfiliacion]').hide();
                $('div[id$=_idParentescoBeneficiarioVeterano]').show();
                $('div[id$=_idTipoVeterano]').hide();
                break;
            case '11':
                $('div[id$=_numeroAfiliacion]').hide();
                $('div[id$=_idTipoVeterano]').show();
                $('div[id$=_idParentescoBeneficiarioVeterano]').hide();
                break;
            default:
                $('div[id$=_numeroAfiliacion]').show();
                $('div[id$=_idParentescoBeneficiarioVeterano]').hide();
                $('div[id$=_idTipoVeterano]').hide();
        }
    });

    if ($('input:checkbox[id$="_asegurado"]').is(':checked')) {
        $('select[id$="_idAreaCotizacion"]').removeAttr('disabled');
        $('input[id$="_numeroAfiliacion"]').removeAttr('disabled');
        $('select[id$="_idTipoVeterano"]').removeAttr('disabled');
        switch ($('select[id$="_idAreaCotizacion"]').val()) {
            case '12':
                $('div[id$=_numeroAfiliacion]').hide();
                $('div[id$=_idParentescoBeneficiarioVeterano]').show();
                $('div[id$=_idTipoVeterano]').hide();
                break;
            case '11':
                $('div[id$=_numeroAfiliacion]').hide();
                $('div[id$=_idTipoVeterano]').show();
                $('div[id$=_idParentescoBeneficiarioVeterano]').hide();
                break;
            default:
                $('div[id$=_numeroAfiliacion]').show();
                $('div[id$=_idParentescoBeneficiarioVeterano]').hide();
                $('div[id$=_idTipoVeterano]').hide();
        }
    }
});
