$(document).ready(function() {
    $('#servicio_apoyo')
            .prepend('<option/>')
            .val(function() {
                return $('[selected]', this).val();
            })
            .select2({
                placeholder: 'Seleccionar Servicio de Apoyo ...',
                allowClear: true,
                width: '30%'
            });
    $('#procedimientos')
            .prepend('<option/>')
            .val(function() {
                return $('[selected]', this).val();
            })
            .select2({
                placeholder: 'Seleccionar el procedimiento a solicitar ...',
                allowClear: true,
                width: '40%'
            });
});

