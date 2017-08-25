/*
 *  Funcion que permite obtener los atributos de un elemento como un objeto json
 *
 *  Ejemplo:
 *      var $div = $("<div data-a='1' id='b'>");
 *      $div.attr();  // { "data-a": "1", "id": "b" }
 */
(function (old) {
    $.fn.attr = function () {
        if (arguments.length === 0) {
            if (this.length === 0) {
                return null;
            }

            var obj = {};

            $.each(this[0].attributes, function () {
                if (this.specified) {
                    obj[this.name] = this.value;
                }
            });

            return obj;
        }

        return old.apply(this, arguments);
    };
})($.fn.attr);

/*
 *  Funcion que permite hacer el llamado de otra funcion, si el nombre de dicha
 *  funcion se tiene en una variable, además de permitir enviar parámetros a la
 *  funcion que se esta llamando.
 *
 *  NOTA:
 *      Para que el llamado a la funcion funcione de manera correcta, la funcion
 *      debe ser declarada fuera del jQuery(document).ready o tiene que agregarse
 *      a la variable window para que sea tomada como una variable global,
 *      Ejm: window.nombreFuncion = funcion() { //code... }
 *
 *  Ejemplo:
 *      var fnombre    = 'nombreFuncion';
 *      var parametros = [parametro1,parametro2,...,parametron];
 *
 *      callFunction(fnombre, parametros);
 */
function callFunction(name, arguments)
{
    var fn = window[name];
    if(typeof fn !== 'function'){
        console.log(name+' no es una función!!!');
        return;
    }

    fn.apply(window, arguments);
}

/*
 *  Prototipo de String que permite utilizar letra Capital, es decir colocar en
 *  mayuscula la primera letra del String.
 *
 *  Ejemplo:
 *      'esto es un texto'.capitalLetter(); // Esto es un texto
 */
String.prototype.capitalLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

/*
 * sortBy: Función que permite ordenar un array u objeto por un campo determinado
 *
 *  Ejemplo:
 *      var aNumbers = [10,8,5,3,7,4,5,1];
 *      var aObject = [
 *              {nombre: "david",  edad: 30},
 *              {nombre: "Luis",   edad: 24},
 *              {nombre: "julian", edad: 24},
 *              {nombre: "alex",   edad: 36},
 *              {nombre: "Samuel", edad: 28},
 *              {nombre: "Diana",  edad: 25}
 *            ];
 *
 * ***************** Objeto ******************      * ****************** ARRAY ******************
 * ------------ Versión Prototipo ------------      * ------------ Version Prototipo ------------
 *      -- Ordenado por elemento edad               *      -- Ascendente por defecto
 *          aObject.sortBy({ prop: "edad" });       *          aNumbers.sortBy();
 *                                                  *
 *      -- Salida descendente por defecto           *      -- Salida Ascendente
 *          edad: 24, nombre: Luis                  *          [1,3,4,5,5,7,8,10]
 *          edad: 24, nombre: julian                *
 *          edad: 25, nombre: Diana                 * ------------- Versión Función -------------
 *          edad: 28, nombre: Samuel                *      -- Descendente, enviado por parametro
 *          edad: 30, nombre: david                 *          sortBy(aNumbers, { desc: true });
 *          edad: 36, nombre: alex                  *
 *                                                  *      -- Salida Descendente
 * ------------- Versión Función -------------      *          [10,8,7,5,5,4,3,1]
 *      -- Ordenada por elemento nombre, desc.      *
 *          sortBy(aObject, {                       *
 *              prop: "nombre",                     *
 *              desc: true,                         *
 *              parser: function (item) {           *
 *                  //ignores uppercase/lowercase   *
 *                  return item.toUpperCase();      *
 *              }                                   *
 *          });                                     *
 *                                                  *
 *      -- Salida descendente                       *
 *          edad: 28, nombre: Samuel                *
 *          edad: 24, nombre: Luis                  *
 *          edad: 24, nombre: julian                *
 *          edad: 25, nombre: Diana                 *
 *          edad: 30, nombre: david                 *
 *          edad: 36, nombre: alex                  *
 *                                                  *
 * ------------ Versión Prototipo ------------      *
 *      -- Ordenado por fecha                       *
 *          aObject.sortBy({                        *
 *              prop: "fecha",                      *
 *              desc: true,                         *
 *              parser: function (item) {           *
 *                  return new Date(item);          *
 *              }                                   *
 *          });                                     *
 */
var sortBy = (function () {
    var _toString = Object.prototype.toString,
            //the default parser function
            _parser = function (x) {
                return x;
            },
            //gets the item to be sorted
            _getItem = function (x) {
                return this.parser((_toString.call(x) === "[object Object]" && x[this.prop]) || x);
            };

    /* PROTOTYPE VERSION */
    // Creates a sort method in the Array prototype
    Object.defineProperty(Array.prototype, "sortBy", {
        configurable: false,
        enumerable: false,
        // @o.prop: property name (if it is an Array of objects)
        // @o.desc: determines whether the sort is descending
        // @o.parser: function to parse the items to expected type
        value: function (o) {
            if (_toString.call(o) !== "[object Object]")
                o = {};
            if (typeof o.parser !== "function")
                o.parser = _parser;
            //if @o.desc is false: set 1, else -1
            o.desc = [1, -1][+!!o.desc];
            return this.sort(function (a, b) {
                a = _getItem.call(o, a);
                b = _getItem.call(o, b);
                return ((a > b) - (b > a)) * o.desc;
                //return o.desc * (a < b ? -1 : +(a > b));
            });
        }
    });

    /* FUNCTION VERSION */
    // Creates a method for sorting the Array
    // @array: the Array of elements
    // @o.prop: property name (if it is an Array of objects)
    // @o.desc: determines whether the sort is descending
    // @o.parser: function to parse the items to expected type
    return function (array, o) {
        if (!(array instanceof Array) || !array.length)
            return [];
        if (_toString.call(o) !== "[object Object]")
            o = {};
        if (typeof o.parser !== "function")
            o.parser = _parser;
        //if @o.desc is false: set 1, else -1
        o.desc = [1, -1][+!!o.desc];
        return array.sort(function (a, b) {
            a = _getItem.call(o, a);
            b = _getItem.call(o, b);
            return ((a > b) - (b > a)) * o.desc;
        });
    };
}());

/*
 *  limpiar_nombres
 *      Función que se utiliza para permitir solo letras y un solo espacio.
 *      quitando toda tilde, dieresis,etc
 */
function limpiar_nombres(text) {
    var text = text.toLowerCase(); // a minusculas
    text = text.replace(/[áàäâå]/, 'a');
    text = text.replace(/[éèëê]/, 'e');
    text = text.replace(/[íìïî]/, 'i');
    text = text.replace(/[óòöô]/, 'o');
    text = text.replace(/[úùüû]/, 'u');
    text = text.replace(/[ýÿ]/, 'y');
    text = text.replace(/[^a-zA-ZñÑ\s]/g, '');
    text = text.replace(/\s{2,}/, ' ');
    text = text.toUpperCase();
    return text;
}

/* Convertir Hora segun formato de 12 o 24 Horas */
function formatTime_12_24(convertFormat, strTime) {
    var time = false;
    var regex = null;

    if (convertFormat == "12") {
        regex = /^([0-1]?\d|2[0-3]):([0-5]\d):([0-5]\d)$/i;
    } else {
        if (convertFormat == "24") {
            regex = /^([0]\d|[1][0-2]):([0-5]\d):([0-5]\d)\s?(?:AM|PM)$/i;
        }
    }

    if (regex != null && regex.test(strTime)) {
        if (convertFormat == "24") {
            var arrayTime = strTime.split(":");
            var restTime = arrayTime[2].split(" ");
            var hours = Number(arrayTime[0]);
            var minutes = Number(arrayTime[1]);
            var seconds = Number(restTime[0]);
            var meridian = restTime[1];

            if (meridian == "PM" && hours < 12)
                hours = hours + 12;

            if (meridian == "AM" && hours == 12)
                hours = hours - 12;

            if (hours < 10)
                hours = "0" + hours.toString();

            if (minutes < 10)
                minutes = "0" + minutes.toString();

            if (seconds < 10)
                seconds = "0" + seconds.toString();

            time = hours + ":" + minutes + ":" + seconds;
        } else {
            var arrayTime = strTime.split(":");
            var hours = Number(arrayTime[0]);
            var minutes = Number(arrayTime[1]);
            var seconds = Number(arrayTime[2]);
            var meridian = "AM";

            if (hours >= 12) {
                hours = hours - 12;
                meridian = "PM";
            }

            if (hours == 0) {
                hours = 12;
            }

            if (hours < 10)
                hours = "0" + hours.toString();

            if (minutes < 10)
                minutes = "0" + minutes.toString();

            if (seconds < 10)
                seconds = "0" + seconds.toString();

            time = hours + ":" + minutes + ":" + seconds + " " + meridian;
        }
    }

    return time;
}

/*
 * Funcion que retorna la fecha actual en un formato determinado
 * Parametro:
 *      parameter: String que contiene el formato de la fecha
 *
 * Formatos Soportados:
 *      'dd/mm/yyyy', (Valor por defecto)
 *      'dd-mm-yyyy',
 *      'yyyy/mm/dd',
 *      'yyyy-mm-dd'
 */
function getCurrentDate(format) {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }

    switch (format) {
        case 'dd/mm/yyyy':
            today = dd + '/' + mm + '/' + yyyy;
            break;
        case 'dd-mm-yyyy':
            today = dd + '-' + mm + '-' + yyyy;
            break;
        case 'yyyy/mm/dd':
            today = yyyy + '/' + mm + '/' + dd;
            break;
        case 'yyyy-mm-dd':
            today = yyyy + '-' + mm + '-' + dd;
            break;
        default:
            today = dd + '/' + mm + '/' + yyyy;
            break;
    }

    return today;
}

/*
 *  slugToCamelCase:
 *      Funcion que permite convertir un string separado por guion '-'
 *      en un string en formato camelCase
 *
 *  Parámetros:
 *      string: Cadena de texto dividido por guiones.
 *
 *  Retorna:
 *      String en formato camelCase
 *
 *  Ejemplo:
 *      Entrada: 'esto-es-un-string'
 *      Salida:  'estoEsUnString'
 */
function slugToCamelCase(string) {
    return string.replace(/-([a-z])/ig, function (all, letter) {
        return letter.toUpperCase();
    });
}

/*
 *  time:
 *      Funcion que permite obtener el tiempo actual en segundos.
 *
 *  example 1: timeStamp = time();
 *  example 1: timeStamp > 1000000000 && timeStamp < 2000000000
 *  returns 1: true
 */
function time() {
    return Math.floor(new Date().getTime() / 1000);
}

/*
 *  appendEmptyOption:
 *      Funcion que permite agregar un option vacio, normalmente utilizado en la
 *      inicializaicón del select2
 *
 *  Parámetros:
 *      id: id del elemento al cual se le quiere agregar un option vacio.
 */
function appendEmptyOption(id) {
   if($('#'+id).find('option[value=""]').length === 0 && $('#'+id).find('option[value=null]').length === 0 && $('#'+id).find('option:not([value])').length === 0 && ( typeof $('#'+id).attr('multiple') === 'undefined' || $('#'+id).attr('multiple') === false ) ) {
       $('#'+id).prepend('<option/>').val(function(){
           return $('[selected]',this).val();
       });
   }
}

/*
 *  getSelect2TextInHTML
 *      Función que permite obtener el texto a mostrar al seleccionar un option
 *      del select2, esto srive cuando es enviado el html desde la entidad.
 *      dentro del texto debe existir el siguiente string: data-select2-text="texto"
 *      en donde texto es lo que se mostraría al seleccionar el option
 *
 *  Parámetros:
 *      str: String del option seleccionado que contiene el siguiente texto: data-select2-text="texto"
 */
function getSelect2TextInHTML(str) {
    var ret = "";

    if (/"/.test(str)) {
        ret = str.match(/data-select2-text="(.*?)"/)[1];
    } else {
        ret = str;
    }

    return ret;
}

/*
 *  checkToSwitch
 *      Función que permite cambiar un checkbox a la forma siwtch on - off
 *
 *  Opciones:
 *      Las opciones se envian a tráves de los attr que inicien con data-switch,
 *      los cuales se describen a continuacion:
 *          .- data-switch-enabled   = true : Permite habilitar el cambio de check a switch
 *          .- data-switch-on-label  = 'label' : Permite establecer el label cuando el switch este On
 *          .- data-switch-off-label = 'label' : Permite establecer el label cuando el switch este Off
 *          .- data-switch-float     = false | 'right' | 'left' : Permite colocar el switch flotante izquierda, derecha,
 *                                     valor por defecto false.
 *
 *  Documentación:
 *      https://proto.io/freebies/onoff/
 */
function checkToSwitch() {
    jQuery('body input[data-switch-enabled="true"]').each(function () {
        var element     = jQuery(this);
        var attr        = element.attr();
        var hasOnLabel  = false;
        var hasOffLabel = false;
        var onLabel     = 'SI';
        var offLabel    = 'NO';
        var float       = false;
        var display     = false;

        jQuery.each(attr, function (key, value) {
            if (key.match('^data-switch-')) {
                var option = key.replace('data-switch-', '');

                switch (option) {
                    case 'on-label':
                        onLabel = value;
                        break;
                    case 'off-label':
                        offLabel = value;
                        break;
                    case 'float':
                        float = value;
                        break;
                    case 'display':
                        display = value;
                        break;
                    default:
                        break;
                }
            }
        });

        initializeSwitchOnOff(element, onLabel, offLabel, float, display)
    });
}

function initializeSwitchOnOff(element, onLabel, offLabel, float, display) {
    if (typeof onLabel === "undefined" || onLabel === null || onLabel === '') {
        onLabel = 'SI';
    }

    if (typeof offLabel === "undefined" || offLabel === null || offLabel === '') {
        offLabel = 'NO';
    }

    element.parent().css('width', 'auto');
    element.parent().prepend(
            '<div class="onoffswitch" id="onoff_' + element.attr('id') + '">' +
            '<label class="onoffswitch-label" for="' + element.attr('id') + '">' +
            '<span class="onoffswitch-inner" data-switch-on-label="' + onLabel + '" data-switch-off-label="' + offLabel + '"></span>' +
            '<span class="onoffswitch-switch"></span>' +
            '</label>' +
            '</div>'
            );

    element.prependTo($('#onoff_' + element.attr('id'))).addClass('onoffswitch-checkbox');

    if (typeof float === "undefined" || float === null || float === '') {
        float = false;
    }

    if (typeof display === "undefined" || display === null || display === '') {
        display = false;
    }

    if (float) {
        var outDiv = jQuery('#onoff_' + element.attr('id')).parent();
        outDiv.addClass('float-'+float);
    }

    if (display) {
        var outDiv = jQuery('#onoff_' + element.attr('id')).parent();
        outDiv.attr('style', outDiv.attr('style') + ' display:' + display + ';');
    }
}

/*
 *  setClockPicker
 *      Función que permite agregar el plugin de Reloj ClockPicker.
 *
 *  Opciones:
 *      Las opciones se envian a tráves de los attr que inicien con data-clockpicker,
 *      los cuales se describen a continuacion:
 *      Para las opciones que son camelCase segun la documentacion oficial listada arriba,
 *      colocar la opcion separada por un guion y seguido de su letra en minuscula ejemplos:
 *          .- data-clockpicker = true : Permite habilitar el plugin
 *
 *          Opcion     | enviada a traves de attr     | Descripcion
 *          -----------+------------------------------+--------------------------------------------------------------------------
 *          donetext   | data-clockpicker-donetext    | 'label'   : Permite cambiar el label por defecto del botón Done.
 *          beforeShow | data-clockpicker-before-show | 'calback' : Permite invocar una funcion antes de que se muestre el reloj.
 *
 *  Documentación:
 *      http://weareoutman.github.io/clockpicker/
 *      https://github.com/weareoutman/clockpicker
 */
function setClockPicker() {
    jQuery('body input[data-clockpicker-enabled="true"]').each(function () {
        initializeClockPicker(jQuery(this));
    });
}

function initializeClockPicker(element) {
    var options = setClockPickerOptions(element);
    element.clockpicker(options);
}

function setClockPickerOptions(element) {

    var newOptions = {
        default   : moment().format('h:mA'),
        placement : 'bottom',
        align     : 'left',
        autoclose : false,
        twelvehour: true,
        vibrate   : true,
        donetext  : 'Aceptar'
    };
    var attr = element.attr();

    jQuery.each(attr, function (key, value) {
        if (key.match('^data-clockpicker-')) {
            var option = slugToCamelCase(key.replace('data-clockpicker-', ''));

            newOptions[option] = isNaN(value) ? (value === 'true' ? true : (value === 'false' ? false : (isJson(value) ? JSON.parse(value) : value))) : parseInt(value);
        }
    });

    return newOptions;
}

function defalutlModalBodyMessage(e) {

    e = typeof e !== 'undefined' ? e : '';

    var html = '<div class="alert alert-block alert-error">\
                <h4>Error al cargar el elemento</h4>\
                Lo sentimos, hubo un problema al cargar la vista, \
                por favor intente nuevamente.<br /> \
                Si el problema persiste por favor contacte al administrador...</div>';

    if (e != '') {
        html = html + '<p><b>Detalle del Error</b><br />' + e + '</p>';
    }
    return html;
}

/*
 * showDialogMsg
 *      Funcion que facilita mostrar los Message Dialog
 *
 * Parametros:
 *      title:                 titulo de dialog
 *      msg:                   mensaje dentro del dialog
 *      dialogClass:           [dialog-warning | dialog-error | dialog-info | dialog-success]
 *      closeBtnName:          Permite definir un nombre para el botón cancelar.
 *      arrayBtns:             Array que contiene los botones junto con la lógica que ha de funcionar dentro de este.
 *      createDefaultBtnClose: True o False, bandera permite definir si se creará el boton cerrar por defecto.
 *      width:                 Permite cambiar el ancho por defecto de la ventana.
 *      modal:                 Permitir o no un comportamiento similar a un modal (Deshabilitar otros elementos de la pantalla). Default: true
 *      closeOnEscape:         True o False, indica si se puede cerrar el dialog presionando la tecla ESC. Default: false
 *      createXBtn:            True o FAlse, indica si se se agregará o no el boton (X) para cerrar el dialog por defecto. Default: true
 *
 * Ejemplo:
 *      var title = 'Limite excedido';
 *      var dialogClass = 'dialog-warning';
 *      var msg = 'Cuerpo del Mensaje';
 *      var width = 500;
 *      var modal = true;
 *
 *      var arrayBtns = [
 *                          {
 *                              text: 'Aceptar', click: function() {
 *                                  window.location = "http://midominio.com";
 *                              }
 *                          },
 *                          {
 *                              text: 'Cerrar', click: function( event, ui) {
 *                                  jQuery( this ).dialog( "close" );
 *                              }
 *                          }
 *                      ];
 *      showDialogMsg(title, msg, dialogClass, '', arrayBtns, null, width, modal, closeOnEscape, createXBtn);
 */
function showDialogMsg(title, msg, dialogClass, closeBtnName, arrayBtns, createDefaultBtnClose, width, modal, closeOnEscape, createXBtn) {
    if (jQuery('body #dialog-message').length > 0) {
        jQuery('body #dialog-message').remove();
    }

    if (jQuery('body #dialog-message').length === 0) {
        jQuery("body").append('<div id="dialog-message"></div>');
    }

    var element = jQuery('body #dialog-message');

    if (typeof dialogClass === "undefined" || dialogClass === null || dialogClass === '') {
        dialogClass = 'dialog-info'
    }

    if (typeof arrayBtns === "undefined" || arrayBtns === null || arrayBtns === '') {
        arrayBtns = [];
    }

    if (typeof closeBtnName === "undefined" || closeBtnName === null || closeBtnName === '') {
        closeBtnName = 'Cerrar';
    }

    if (typeof createDefaultBtnClose === "undefined" || createDefaultBtnClose === null || createDefaultBtnClose === '') {
        createDefaultBtnClose = true;
    }

    if (typeof width === "undefined" || width === null || width === '') {
        width = 300;
    }

    if (typeof modal === "undefined" || modal === null || modal === '') {
        modal = true;
    }

    if (typeof closeOnEscape === "undefined" || closeOnEscape === null || closeOnEscape === '') {
        closeOnEscape = false;
    }

    if (typeof createXBtn === "undefined" || createXBtn === null || createXBtn === '') {
        createXBtn = true;
    }

    if (createDefaultBtnClose === true || arrayBtns.length === 0) {
        arrayBtns.push({
            text: closeBtnName, click: function () {
                jQuery(this).dialog("close");
            }
        });
    }

    if (typeof title === "undefined" || title === null || title === '') {
        switch (dialogClass.replace('dialog-', '')) {
            case 'error':
                title = 'Ha ocurrido un Error!';
                break;
            case 'warning':
                title = 'Advertencia!';
                break;
            case 'success':
                title = 'Realizado correctamente!';
                break;
            default:
                title = 'Información';
                break;
        }
    }

    if (typeof msg === "undefined" || msg === null || msg === '') {
        switch (dialogClass.replace('dialog-', '')) {
            case 'error':
                msg = 'Se ha producido un error inesperado! Por favor, verifique los datos ingresados e intente nuevamente.';
                break;
            case 'warning':
                msg = 'Atenci&oacute;n, verifique la información proporcionada y que los datos esten completos. Esto podría generar un error.';
                break;
            case 'success':
                msg = 'La acci&oacute;n se ha realizado correctamente.';
                break;
            default:
                msg = 'No se ha definido información a mostrar al usuario.';
        }
    }

    var msgWi = '';

    switch (dialogClass.replace('dialog-', '')) {
        case 'error':
            msgWi = '<i class="fa fa-fw fa-times-circle"></i>&nbsp;&nbsp;' + msg;
            break;
        case 'warning':
            msgWi = '<i class="fa fa-fw fa-warning"></i>&nbsp;&nbsp;' + msg;
            break;
        case 'success':
            msgWi = '<i class="fa fa-fw fa-check-circle"></i>&nbsp;&nbsp;' + msg;
            break;
        default:
            msgWi = '<i class="fa fa-fw fa-info-circle"></i>&nbsp;&nbsp;' + msg;
    }

    element.append(msgWi);

    element.dialog({
        dialogClass: dialogClass + ( createXBtn ? '' : ' no-x-close'  ),
        modal: modal,
        title: title,
        width: width,
        buttons: arrayBtns,
        closeOnEscape: closeOnEscape
    });

}


/* Parametros que acepta la funcion
 *  method     : metodo a traves del cual se se realizara el envio de la informacion POST o GET
 *  action     : url al cual se enviara la informacion
 *  target     : Nombre de la nueva ventana
 *  parameters : json enconde de los parametros que  seran enviado al nuevo popoup
 */
function openPostPopUpWindows(winParams) {
    var windowObjectReference;
    var params = winParams['parameters'];

    var form = document.createElement("form");
    form.setAttribute("method", winParams['method']);
    form.setAttribute("action", winParams['action']);
    form.setAttribute("target", winParams['target']);

    for (var i in params) {
        if (params.hasOwnProperty(i)) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = i;
            input.value = params[i];
            form.appendChild(input);
        }
    }

    document.body.appendChild(form);

    //note I am using a post.htm page since I did not want to make double request to the page
    //it might have some Page_Load call which might screw things up.
    windowObjectReference = window.open("", winParams['target'], "_blank");
    windowObjectReference.resizeTo(screen.width, screen.height);

    form.submit();

    document.body.removeChild(form);
}

/***** Indice de Masa Corporal *****/
jQuery(document).ready(function ($) {
    /*
     *  Inicializacion de Funciones
     */
    setBootstrapDateRangePicker();
    setDataTables();
    setBootstrapDatePicker();
    checkToSwitch();
    setClockPicker();
    setEditors();

    var pesoIMC = null;
    var estaturaIMC = null;
    var valorFinalIMC = null;
    var rangoIMC = null;
    var pesoIMCField = jQuery('input[id^="form_i330_s"]');
    var estaturaIMCField = jQuery('input[id^="form_i331_s"]');
    var IMCField = jQuery('input[id^="form_i335_s"]');
    var sexoIMC = jQuery('#sexo_paciente');
    var valorSexoIMC = sexoIMC.attr('value')
    var edadPaciente = jQuery('#edad_paciente');
    var valorEdadPaciente = edadPaciente.attr('value');

    if (jQuery('#edad_paciente').length > 0) {
        valorEdadPaciente = valorEdadPaciente.split(",");
        var aniosPaciente = valorEdadPaciente[0].split(" ")
        aniosPaciente = aniosPaciente[0];
    }

    pesoIMCField.on('change', function () {
        jQuery('#idestadonutricional').remove()
        if (isNumber(jQuery(this).val())) {
            pesoIMC = parseFloat(jQuery(this).val());
            if (pesoIMC > 0) {
                if (estaturaIMC != null) {
                    if (estaturaIMC > 0) {
                        valorFinalIMC = calcularIMC(pesoIMC, estaturaIMC);
                        rangoIMC = buscarRangoIMC(valorSexoIMC, valorFinalIMC, aniosPaciente);
                        IMCField.val(valorFinalIMC);
                    }
                    else {
                        showDialogMsg('Error!', 'El valor de la Talla debe ser mayor que cero.', 'dialog-error');
                    }
                }
            }
            else {
                showDialogMsg('Error!', 'El valor del Peso debe ser mayor que cero.', 'dialog-error');
                jQuery(this).val('');
            }
        }
        else {
            showDialogMsg('Error!', 'Ingrese un numero.', 'dialog-error');
            jQuery(this).val('');
        }
    });

    estaturaIMCField.on('change', function () {
        jQuery('#idestadonutricional').remove()
        if (isNumber(jQuery(this).val())) {
            estaturaIMC = parseFloat(jQuery(this).val());
            if (estaturaIMC > 0) {
                if (pesoIMC != null) {
                    if (pesoIMC > 0) {
                        valorFinalIMC = calcularIMC(pesoIMC, estaturaIMC);
                        rangoIMC = buscarRangoIMC(valorSexoIMC, valorFinalIMC, aniosPaciente);
                        IMCField.val(valorFinalIMC);
                    }
                    else {
                        showDialogMsg('Error!', 'El valor del Peso debe ser mayor que cero.', 'dialog-error');
                    }
                }
            }
            else {
                showDialogMsg('Error!', 'El valor de la Talla debe ser mayor que cero.', 'dialog-error');
                jQuery(this).val('');
            }
        }
        else {
            showDialogMsg('Error!', 'Ingrese un numero.', 'dialog-error');
            jQuery(this).val('');
        }
    });

    function buscarRangoIMC(sexo, imc, edad) {
        jQuery.ajax({
            url: Routing.generate('consultar_IMC', {'sexo': sexo, 'imc': imc, 'edad': edad}),
            async: false,
            dataType: 'json',
            timeout: 8000, // 8 segundos
            success: function (data) {
                if (data.length == 0) {
                    IMCField.before('<div id="idestadonutricional"></br><label class="alert alert-success"><span class="glyphicon glyphicon-info-sign"></span> Clasificacion Estado Nutricional: <u>No disponible</u></label></div>');
                }
                else {
                    IMCField.before('<div id="idestadonutricional"></br><label class="alert alert-success"><span class="glyphicon glyphicon-info-sign"></span> Clasificacion Estado Nutricional: <u>' + data[0].clasificacion + '</u></label></div>');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error('Hubo un error al consultar .\nDetalle del Error: textStatus: ' + textStatus + ', errorThrown: ' + errorThrown);
                showDialogMsg('Error al consultar ', 'Se ha Producido un error al intentar consultar <br/>Es posible que existan problemas de conexión con la BD.', 'dialog-error');
            }
        });
    };
});

function calcularIMC(peso, estatura) {
    var estaturaMeters = parseFloat(estatura) / 100.0;
    var peso = parseFloat(peso);

    if (estaturaMeters > 0.0 && peso > 0.0)
    {
        var IMC = (peso / Math.pow(estaturaMeters, 2)).toFixed(2);
        return IMC;
    }
}
;
/*** Fin Indice de Masa Corporal ***/

/*** Mascara de Presion Arterial ***/
jQuery(document).ready(function ($) {
    $('input[id^="form_i334_s"]').each(function () {
        $(this).mask("999/99?9");
    });
});
/*** Fin Mascara de Presion Arterial ***/


/* Funcion que determina si un determinado valor es un numero valido */
function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

jQuery(document).ready(function ($) {

    $("*.fd_parent_ident").parent().addClass("fd_options_ident");

    /***** Mosrtrar Mensajes de Error de Sonata y Esconderlos Automaticamente ******/

    $('i[class="ui-icon ui-icon-alert"]').attr("data-placement", "top");
    $('i[class="ui-icon ui-icon-alert"][data-title="error"]').attr("data-title", '<spam style="color: #b94a48;">Se ha producido un error:</spam>');
    $('i[class="ui-icon ui-icon-alert"]').popover('show');
    var popOverShow = true;
    var popOverClicked = false;
    var lastPopOverClicked = null;

    $('body').on('click', function (event) {


        if (popOverShow == true && popOverClicked == false) {
            $('i[class="ui-icon ui-icon-alert"]').popover('hide');
            popOverShow = false;
            lastPopOverClicked = null;
        }
        else {
            if (popOverShow == true && popOverClicked == true) {
                popOverShow = false;
                popOverClicked = false;
            }
            else {
                if (popOverShow == false && popOverClicked == true) {
                    popOverShow = true;
                    popOverClicked = false;
                }
                else {
                    popOverShow = false;
                    popOverClicked = false;
                    lastPopOverClicked = null;
                }
            }
        }

        lasElementClicked = event.target;

    });

    $('i[class="ui-icon ui-icon-alert"]').on('click', function (event) {

        if (lastPopOverClicked != null) { //Determina si hay un PopUp abierto y se ha dado click en otro diferente.
            if ($(this) != lastPopOverClicked && popOverShow == true) {
                lastPopOverClicked.popover('hide');       //Se cierra el PopUp ya abierto.
                popOverShow = false;
            }
        }

        popOverClicked = true;
        lastPopOverClicked = $(this);

    });
    /*********************************************/

    //Estandarización del uso de modal dentro del proyecto
    $('body').append('\
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\
            <div class="modal-dialog">\
                <div class="modal-content">\
                    <div class="modal-header">\
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>\
                    </div>\
                    <div class="modal-body">\
                    </div>\
                    <div class="modal-footer">\
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="color: #636363;font-weight: bold;">Cerrar</button>\
                    </div>\
                </div>\
            </div>\
        </div>');

    $("body").on('click', 'a[custom-modal="true"]', function (e) {
        var idModal = $(this).attr("id");
        if (!(typeof modal_elements === 'undefined') && modal_elements.length != 0) {
            callModal(idModal);
        } else {
            $('#myModal div.modal-header h4#myModalLabel').empty();
            $('#myModal div.modal-body').empty();
            $('#myModal div.modal-footer').empty();
            $('#myModal div.modal-header h4#myModalLabel').append('Error!!!');
            $('#myModal div.modal-body').append('<div class="alert alert-error">\
                                                     <h4>Ops! ha ocurrido un error</h4>\
                                                     Lo sentimos pero ha ocurrido un error, por favor intente nuevamente, si el problema persiste por favor contacte con el administrador\
                                                 </div>');
            $('#myModal div.modal-footer').append('<button class="action" data-dismiss="modal" aria-hidden="true"><span class="label">Cerrar</span></button>');

        }
    });


    window.callModal = function(idModal, options, autoExecute) {
        var found = false;

        if (typeof autoExecute === 'undefined' || autoExecute == '') {
            autoExecute = false;
        }

        if (typeof options === 'undefined' || options == '') {
            options = {
                'backdrop': true,
                'keyboard': true,
                'show': true
            };
        }

        for (var i = 0; i < modal_elements.length; i++) {
            if (idModal == modal_elements[i].id) {
                found = true;

                if (modal_elements[i].empty != true) {
                    if (typeof modal_elements[i].closeXBtn === "undefined" || modal_elements[i].closeXBtn === null || modal_elements[i].closeXBtn === '') {
                        modal_elements[i].closeXBtn = true;
                    }

                    /*Limpiando los elementos del modal*/
                    $('#myModal div.modal-header').empty();
                    $('#myModal div.modal-header').append(
                            ( modal_elements[i].closeXBtn ? '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' : '' ) +
                            '<h4 class="modal-title" id="myModalLabel"></h4>'
                            );
                    $('#myModal div.modal-body').empty();
                    $('#myModal div.modal-footer').empty();
                    $('div.modal-content').css('background-color', '#ffffff');
                    $('div.modal-header').css('background-color', '#ffffff');
                    $('div.modal-body').css('background-color', '#ffffff');
                    $('div.modal-footer').css('background-color', '#ffffff');

                    /*Verificando el contendio a mostrar*/
                    if (typeof modal_elements[i].header === 'undefined' || modal_elements[i].header == '') {
                        modal_elements[i].header = 'Detalle';
                    }

                    if (typeof modal_elements[i].func === 'undefined' || modal_elements[i].func == '') {
                        modal_elements[i].func = 'defalutlModalBodyMessage';
                    }

                    if (typeof modal_elements[i].footer === 'undefined') {
                        modal_elements[i].footer = '';
                    }

                    if (typeof modal_elements[i].parameters === 'undefined' || modal_elements[i].func == '') {
                        var modalBody = window[modal_elements[i].func]();
                    } else {
                        var modalBody = window[modal_elements[i].func](modal_elements[i].parameters);
                    }

                    if (typeof modal_elements[i].closeBtn === "undefined" || modal_elements[i].closeBtn === null || modal_elements[i].closeBtn === '') {
                        modal_elements[i].closeBtn = true;
                    }

                    /*Estableciendo los nuevos valores del modal*/
                    $('#myModal div.modal-header h4#myModalLabel').append(modal_elements[i].header);
                    if (modalBody != '') {
                        $('#myModal div.modal-body').append(modalBody);
                        if (typeof modal_elements[i].closeBtnName === 'undefined' || modal_elements[i].closeBtnName == '') {
                            $('#myModal div.modal-footer').append(modal_elements[i].footer + ( modal_elements[i].closeBtn ? '<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #636363;font-weight: bold;">Cerrar</button>' : '') );
                        } else {
                            $('#myModal div.modal-footer').append(modal_elements[i].footer + ( modal_elements[i].closeBtn ? '<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #636363;font-weight: bold;">' + modal_elements[i].closeBtnName + '</button>' : '' ) );
                        }
                    } else {
                        $('#myModal div.modal-body').append(window['defalutlModalBodyMessage']());
                        $('#myModal div.modal-footer').append('<button type="button" class="btn btn-default" data-dismiss="modal" style="color: #636363;font-weight: bold;">Cerrar</button>');
                    }

                    if (typeof modal_elements[i].afterLoadCallFunction !== 'undefined' && modal_elements[i].afterLoadCallFunction != '') {
                        window[modal_elements[i].afterLoadCallFunction]();
                    }

                    if (typeof modal_elements[i].widthModal !== 'undefined' && modal_elements[i].widthModal !== '' && modal_elements[i].widthModal !== null) {
                        $('div#myModal div.modal-dialog').css({'width': modal_elements[i].widthModal});
                    }

                    if (typeof modal_elements[i].maxWidth !== 'undefined' && modal_elements[i].maxWidth !== '' && modal_elements[i].maxWidth !== null) {
                        $('div#myModal div.modal-dialog').css({'max-width': modal_elements[i].maxWidth});
                    }
                } else {
                    if (typeof modal_elements[i].emptyMessage === 'undefined') {
                        var mBody = '<i class="icon-exclamation-sign" style="margin-right:7px;"></i>\
                                     No se ha seleccionado ningun elemento del cual se puedan mostrar los detalles,\
                                     por favor seleccione uno e intente nuevamente.';

                        modal_elements[i].emptyMessage = [{emptyMTitle: 'Elemento no seleccionado', emptyMBody: mBody}];
                    } else {

                        if (typeof modal_elements[i].emptyMessage[0].emptyMTitle === 'undefined' || modal_elements[i].emptyMessage[0].emptyMTitle == '') {
                            modal_elements[i].emptyMessage[0].emptyMTitle = 'Elemento no seleccionado';
                        }

                        if (typeof modal_elements[i].emptyMessage[0].emptyMBody === 'undefined' || modal_elements[i].emptyMessage[0].emptyMBody == '') {
                            modal_elements[i].emptyMessage[0].emptyMBody = '<i class="icon-exclamation-sign" style="margin-right:7px;"></i>\
                                     No se ha seleccionado ningun elemento del cual se puedan mostrar los detalles,\
                                     por favor seleccione uno e intente nuevamente.';
                        }
                    }

                    $('#myModal div.modal-header h4#myModalLabel').empty();
                    $('#myModal div.modal-body').empty();
                    $('#myModal div.modal-footer').empty();

                    $('#myModal div.modal-header h4#myModalLabel').append(modal_elements[i].emptyMessage[0].emptyMTitle);
                    $('#myModal div.modal-body').append(modal_elements[i].emptyMessage[0].emptyMBody);
                    $('#myModal div.modal-footer').append('<button class="action" data-dismiss="modal" aria-hidden="true"><span class="label">Cerrar</span></button>');
                }

                if(autoExecute) {
                    $('#myModal').modal(options);
                }
            }
        }

        if(!found) {
            console.error('Error no se ha encontrado ningun id con el nombre: '+idModal+', dentro del array modal_elements: ');
            console.log(modal_elements);
        }
    }

    /*PARA FUNCIÓN DE ARCHIVO*/
    $('.btn-file :file').on('fileselect', function (event, numFiles, label) {
        var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

        if (input.length) {
            input.val(log);
        } else {
            if (log)
                alert(log);
        }
    });
});
/*PARA FUNCIÓN DE ARCHIVO*/
$(document).on('change', '.btn-file :file', function () {
    var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});

/*
 *  setBootstrapDatePicker
 *      Función que inicializa los calendarios que tengan la classe bootstrap-datepicker
 *      con el plugin bootstrap-datepicker
 *
 *  Documentación:
 *      http://eternicode.github.io/bootstrap-datepicker/
 */
function setBootstrapDatePicker() {
    jQuery('body .bootstrap-datepicker').each(function () {
        initializeElementBootstrapDatePicker(jQuery(this));
    });
}

function initializeElementBootstrapDatePicker(element) {
    var options = setBootstrapDatePickerOptions(element);

    element.datepicker(options);
}

function setBootstrapDatePickerOptions(element) {
    var newOptions = {
        format: "dd/mm/yyyy",
        weekStart: 0,
        clearBtn: true,
        language: "es",
        autoclose: true
    };
    var attr = element.attr();

    jQuery.each(attr, function (key, value) {
        if (key.match('^data-date-')) {
            var option = slugToCamelCase(key.replace('data-date-', ''));

            newOptions[option] = isNaN(value) ? (value === 'true' ? true : (value === 'false' ? false : (isJson(value) ? JSON.parse(value) : value))) : parseInt(value);
        }
    });

    if (element.hasClass('now')) {
        newOptions['endDate'] = moment().format('DD/MM/YYYY');
    }

    return newOptions;
}

/*
 *  setBootstrapDateRangePicker
 *      Función que inicializa los calendarios que tengan la classe bootstrap-daterangepicker
 *      con el plugin bootstrap-daterangepicker
 *
 *  Documentación:
 *      https://github.com/dangrossman/bootstrap-daterangepicker
 */
function setBootstrapDateRangePicker() {
    jQuery('body .bootstrap-daterangepicker').each(function () {
        initializeElementBootstrapDateRangePicker(jQuery(this));
    });
}

function initializeElementBootstrapDateRangePicker(element) {
    var options = setBootstrapDateRangePickerOptions(element);

    element.daterangepicker(options);
}

function setBootstrapDateRangePickerOptions(element) {
    var newOptions = {
        locale: {
            format: 'DD/MM/YYYY',
            applyLabel: 'Aceptar',
            cancelLabel: 'Cancelar',
            fromLabel: 'DESDE',
            toLabel: 'HASTA',
            daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        }
    };
    var attr = element.attr();

    jQuery.each(attr, function (key, value) {
        if (key.match('^data-date-')) {
            var option = slugToCamelCase(key.replace('data-date-', ''));

            newOptions[option] = isNaN(value) ? (value === 'true' ? true : (value === 'false' ? false : (isJson(value) ? JSON.parse(value) : value))) : parseInt(value);
        }
    });

    if (element.hasClass('now')) {
        newOptions['endDate'] = moment().format('DD/MM/YYYY');
    }

    return newOptions;
}

/*
 *  setDataTables
 *      Función que inicializa las tablas que tengan la classe data-tables
 *      con el plugin data-tables
 *
 *  Documentación:
 *      http://eternicode.github.io/bootstrap-datepicker/
 */
function setDataTables() {
    jQuery('body table[data-table-enabled="true"]').each(function () {
        initializeDataTable(jQuery(this));
    });
}

function initializeDataTable(element) {
    var options = setDataTableOptions(element);

    element.DataTable(options);
}

function setDataTableOptions(element) {
    var newOptions = {
        "language": {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "infoPostFix": "",
            "search": "Buscar:",
            "url": "",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "autoWidth": true,
        "responsive": true
    };

    var attr = element.attr();

    jQuery.each(attr, function (key, value) {
        if (key.match('^data-table-')) {
            var option = slugToCamelCase(key.replace('data-table-', ''));

            newOptions[option] = isNaN(value) ? (value === 'true' ? true : (value === 'false' ? false : (isJson(value) ? JSON.parse(value) : value))) : parseInt(value);
        }
    });

    return newOptions;
}


/* Funcion que retorna el Navegador y Versión utilizada actualmente */
function getCurrentBrowser() {
    var ua = navigator.userAgent, tem,
            M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
    if (/trident/i.test(M[1])) {
        tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
        return 'IE ' + (tem[1] || '');
    }
    if (M[1] === 'Chrome') {
        tem = ua.match(/\b(OPR|Edge)\/(\d+)/);
        if (tem != null)
            return tem.slice(1).join(' ').replace('OPR', 'Opera');
    }
    M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, '-?'];
    if ((tem = ua.match(/version\/(\d+)/i)) != null)
        M.splice(1, 1, tem[1]);
    return M.join(' ');
}

/*
 *
 * Copyright (c) 2006-2010 Sam Collett (http://www.texotela.co.uk)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version 1.2
 * Demo: http://www.texotela.co.uk/code/jquery/numeric/
 *
 */
(function ($) {
    /*
     * Allows only valid characters to be entered into input boxes.
     * Note: does not validate that the final text is a valid number
     * (that could be done by another script, or server-side)
     *
     * @name     numeric
     * @param    decimal      Decimal separator (e.g. '.' or ',' - default is '.'). Pass false for integers
     * @param    callback     A function that runs if the number is not valid (fires onblur)
     * @author   Sam Collett (http://www.texotela.co.uk)
     * @example  $(".numeric").numeric();
     * @example  $(".numeric").numeric(",");
     * @example  $(".numeric").numeric(null, callback);
     *
     */
    $.fn.numeric = function (decimal, callback)
    {
        decimal = (decimal === false) ? "" : decimal || ".";
        callback = typeof callback == "function" ? callback : function () {
        };
        return this.data("numeric.decimal", decimal).data("numeric.callback", callback).keypress($.fn.numeric.keypress).blur($.fn.numeric.blur);
    }

    $.fn.numeric.keypress = function (e)
    {
        var decimal = $.data(this, "numeric.decimal");
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        // allow enter/return key (only when in an input box)
        if (key == 13 && this.nodeName.toLowerCase() == "input")
        {
            return true;
        }
        else if (key == 13)
        {
            return false;
        }
        var allow = false;
        // allow Ctrl+A
        if ((e.ctrlKey && key == 97 /* firefox */) || (e.ctrlKey && key == 65) /* opera */)
            return true;
        // allow Ctrl+X (cut)
        if ((e.ctrlKey && key == 120 /* firefox */) || (e.ctrlKey && key == 88) /* opera */)
            return true;
        // allow Ctrl+C (copy)
        if ((e.ctrlKey && key == 99 /* firefox */) || (e.ctrlKey && key == 67) /* opera */)
            return true;
        // allow Ctrl+Z (undo)
        if ((e.ctrlKey && key == 122 /* firefox */) || (e.ctrlKey && key == 90) /* opera */)
            return true;
        // allow or deny Ctrl+V (paste), Shift+Ins
        if ((e.ctrlKey && key == 118 /* firefox */) || (e.ctrlKey && key == 86) /* opera */
                || (e.shiftKey && key == 45))
            return true;
        // if a number was not pressed
        if (key < 48 || key > 57)
        {
            /* '-' only allowed at start */
            if (key == 45 && this.value.length == 0)
                return true;
            /* only one decimal separator allowed */
            if (decimal && key == decimal.charCodeAt(0) && this.value.indexOf(decimal) != -1)
            {
                allow = false;
            }
            // check for other keys that have special purposes
            if (
                    key != 8 /* backspace */ &&
                    key != 9 /* tab */ &&
                    key != 13 /* enter */ &&
                    key != 35 /* end */ &&
                    key != 36 /* home */ &&
                    key != 37 /* left */ &&
                    key != 39 /* right */ &&
                    key != 46 /* del */
                    )
            {
                allow = false;
            }
            else
            {
                // for detecting special keys (listed above)
                // IE does not support 'charCode' and ignores them in keypress anyway
                if (typeof e.charCode != "undefined")
                {
                    // special keys have 'keyCode' and 'which' the same (e.g. backspace)
                    if (e.keyCode == e.which && e.which != 0)
                    {
                        allow = true;
                        // . and delete share the same code, don't allow . (will be set to true later if it is the decimal point)
                        if (e.which == 46)
                            allow = false;
                    }
                    // or keyCode != 0 and 'charCode'/'which' = 0
                    else if (e.keyCode != 0 && e.charCode == 0 && e.which == 0)
                    {
                        allow = true;
                    }
                }
            }
            // if key pressed is the decimal and it is not already in the field
            if (decimal && key == decimal.charCodeAt(0))
            {
                if (this.value.indexOf(decimal) == -1)
                {
                    allow = true;
                }
                else
                {
                    allow = false;
                }
            }
        }
        else
        {
            allow = true;
        }
        return allow;
    }

    $.fn.numeric.blur = function ()
    {
        var decimal = $.data(this, "numeric.decimal");
        var callback = $.data(this, "numeric.callback");
        var val = $(this).val();
        if (val != "")
        {
            var re = new RegExp("^\\d+$|\\d*" + decimal + "\\d+");
            if (!re.exec(val))
            {
                callback.apply(this);
            }
        }
    }

    $.fn.removeNumeric = function ()
    {
        return this.data("numeric.decimal", null).data("numeric.callback", null).unbind("keypress", $.fn.numeric.keypress).unbind("blur", $.fn.numeric.blur);
    }

})(jQuery);

/******     Funcion que permite campturar los eventos show y hide por ejemplo: $('#input').on('show',function(){ ... }); ******/
jQuery(document).ready(function ($) {
    (function ($) {
        $.each(['show', 'hide'], function (i, ev) {
            var el = $.fn[ev];
            $.fn[ev] = function () {
                this.trigger(ev);
                return el.apply(this, arguments);
            };
        });
    })(jQuery);
});


/** Funcion que permite inicializar un Select2 especificando:
 **   element:        Selector del objeto
 **   blankOption:    Si es true, agrega una opcion en blanco al select2
 **   removeChildren: Si es true, remueve las opciones iniciales del select2
 **   options:        Opciones propias utilizadas por el select2
 ***/
function initializeSelect2(element, blankOption, removeChildren, options) {
    if (removeChildren) {
        element.children().remove();
    }

    if (blankOption) {
        appendEmptyOption(jQuery(element).attr('id'));
    }

    if (typeof options === 'undefined' || options == '' || options === null) {
        options = {
            placeholder: 'Seleccione...',
            allowClear: true,
            containerCss: {
                'width': '100%'
            }
        }
    }

    element.select2(options);
}
;

jQuery(document).ready(function ($) {
    $('div[class*="form-group"][class*="has-error"] label').first().each(function () {
        $(this).parent().after('<input type="text" id="form_error_aux_input"/>');
        $('#form_error_aux_input').focus();
        $('#form_error_aux_input').remove();
    });
});


function initDiagnosticoSearch(element, placeholder){
    element.select2({
        allowClear: true,
        placeholder: placeholder,
        minimumInputLength: 2,
        dropdownAutoWidth: true,
        ajax: {
            url: Routing.generate('diagnostico'),
            dataType: 'json',
            quietMillis: 500,
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
            if (id !== "") {
                $.ajax(Routing.generate('diagnostico') +'?id='+id, {
                    dataType: "json"
                }).done(function(data) {
                            callback(data);
                            element.select2('data',{id: id,text: data.data1[0].text });

                        });
            }
        }/*,
        formatSelection: repoFormatSelection*/
    });
};

function initProcedimientoQuirurgicoSearch(element, placeholder){
    element.select2({
        allowClear: true,
        placeholder: placeholder,
        minimumInputLength: 3,
        dropdownAutoWidth: true,
        ajax: {
            url: Routing.generate('procquirurgico'),
            dataType: 'json',
            quietMillis: 500,
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
            if (id !== "") {
                $.ajax(Routing.generate('procquirurgico') +'?id='+id, {
                    dataType: "json"
                }).done(function(data) {
                            callback(data);
                            element.select2('data',{id: id,text: data.data1[0].text });

                        });
            }
        }/*,
        formatSelection: repoFormatSelection*/
    });
};

/*
 *  isJson
 *      Función que verifica si un string es un json válido.
 *
 *  Parámetros:
 *      str:  String que contiene el json.
 *
 *  Retorna: Boolean TRUE | FALSE si es un json válido o no.
 */
function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

/* Funcion que agrega una herramienta auxiliar para calculo de años atras */
jQuery(document).ready(function($) {
    jQuery('body .year-ago-to-year').each(function() {
        addAuxYearCalc(jQuery(this));
    });
});


function addAuxYearCalc(element){

    element.popover({
        html: true,
        placement: 'right',
        trigger: 'click',
        title: '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Seleccione o digite la cantidad de años atras:',
        content: function(){
            elementId = $(this).attr('id');
            return '<div class="range-list">\
                        <ul for="'+elementId+'">\
                            <li onclick="setAuxYearCalc(0, \''+elementId+'\')">Este año</li>\
                            <li onclick="setAuxYearCalc(1, \''+elementId+'\')">El año pasado</li>\
                            <li onclick="setAuxYearCalc(2, \''+elementId+'\')">Hace 2 años</li>\
                            <li onclick="setAuxYearCalc(3, \''+elementId+'\')">Hace 3 años</li>\
                            <li onclick="setAuxYearCalc(4, \''+elementId+'\')">Hace 4 años</li>\
                            <li onclick="setAuxYearCalc(5, \''+elementId+'\')">Hace 5 años</li>\
                            <!--<li onclick="setAuxYearCalc(6, \''+elementId+'\')">Hace 6 años</li>-->\
                            <li>Hace &nbsp;<input id="auxYearCalcInput'+elementId+'" class="form-control input-sm" style="max-width: 50px; display: inline;" type="text" onfocus="jQuery(this).numeric(); disableEnterKey(jQuery(this));"/>&nbsp; años.\
                                &nbsp;&nbsp;<button class="btn btn-success btn-sm" type="button" onclick="setAuxYearCalc(jQuery(\'#auxYearCalcInput'+elementId+'\').val(), \''+elementId+'\')">Aplicar</button>\
                            </li>\
                            <li class="range-list-muted"><center><button class="btn btn-default btn-sm" type="button" onclick="jQuery(\'#'+elementId+'\').popover(\'hide\');">Cerrar</button></center>\
                            </li>\
                        </ul>\
                    </div>';
        }
    });
}

function setAuxYearCalc(yearsAgo, elementId){
    jQuery('#'+elementId).val( yearsAgoToYear( yearsAgo ) );
    jQuery('#'+elementId).popover('hide');
}

function yearsAgoToYear(yearsAgo) {
    return moment().subtract(yearsAgo, 'years').format('YYYY');
}

/* Deshabilita la tecla enter para un detemrinado input y evitar que se envie un submit por ejemplo */
jQuery(document).ready(function($) {
    $('.no-enter-key').each(function(){
        disableEnterKey($(this));
    });
});


function disableEnterKey(element){
    element.on("keypress", function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            e.preventDefault();
            return false;
        }
    });
}

function showOverCenter(element, bounds){
    var position = getCentralPosition(bounds);
    var xposition = position['x'];
    var yposition = position['y'];

    element.prependTo('body');
    element.css('margin-left', ( xposition + 'px' ) );
    element.css('margin-top', ( yposition + 'px') );
    element.addClass('floating-auto-dismiss');
}

/* Funcion para esconder y remover (autodismiss) un elemento despues de un determinado tiempo utilizando efectos
   element:         elemento jQuery al que se aplicara el efecto.
   elementEffect:   Efecto deseado. Default: 'fade' Ver efectos de jQuery ui
   effectDuration:  Duracion de efecto en milisegundos. Default: 3500
   floating:        Si se desea que el elemento aparezca como elemento flotante sobre la pantalla. Default: false
   bounds:          En caso de que floating sea true, se puede indicar el contorno para le calculo de los puntos centrales, ya sea 'body' o 'window'. Default: 'window'
   x:               Punto en X especifico. Default: Resultado del calculo por medio del parametro bounds.
   y:               Punto en Y especifico. Default: Resultado del calculo por medio del parametro bounds.

*/
function autoDismissElement(element, elementEffect, effectDuration, floating, bounds, x, y){

    var xposition = 0;
    var yposition = 0;

    if (typeof elementEffect === "undefined" || elementEffect === null || elementEffect === '') {
        elementEffect = 'fade';
    }

    if (typeof effectDuration === "undefined" || effectDuration === null || effectDuration === '') {
        effectDuration = 3500;
    }

    if (typeof floating === "undefined" || floating === null || floating === '') {
        floating = false;
    }

    if(floating){
        var position = getCentralPosition(bounds, x, y);
        xposition = position['x'];
        yposition = position['y'];

        element.prependTo('body');
        element.css('margin-left', ( xposition + 'px' ) );
        element.css('margin-top', ( yposition + 'px') );
        element.addClass('floating-auto-dismiss');
    }

    element.hide({
                    effect : elementEffect,
                    duration: effectDuration,
                    complete: function(){
                        jQuery(this).remove();
                    }
                });
}

/*  Funcion que muestra un mensaje sobre la pantalla que luego de cierto tiempo desaparece.
    msg:      Mensaje a mostrar al usuario.
    type:     ['info'|'warning'|'success'|'error'] Tipo de mensaje a mostrar. Default: 'info'
    size:     ['small'|'normal'|'large'|'xlarge'] Tamaño del mensaje. Default: 'normal'
    strong:   [true|false] Mostrar en negrita. Default: true
    bounds:   ['body'|'window'] Especifica de que contorno se tomaran los puntos centrales, si del body o window. Default: window
    x:        Punto en X especifico. Default: Resultado del calculo por medio del parametro bounds.
    y:        Punto en Y especifico. Default: Resultado del calculo por medio del parametro bounds.
    duration: Duracion del mensaje en milisegundos. Default: 3500
*/
function showAutoDismissMsg(msg, type, size, strong, bounds, x, y, duration){

    var icon = '';
    var xposition = 0;
    var yposition = 0;

    if ( typeof type === "undefined" || type === null || type === '' || ( jQuery.inArray( type, ['error','warning', 'success','info'] ) < 0 ) ) {
        type = 'info'
    }

    if (typeof strong === "undefined" || strong === null || strong === '') {
        strong = true;
    }

    if (typeof size === "undefined" || size === null || size === '' || ( jQuery.inArray( type, ['small','normal','large','xlarge'] ) < 0 ) ) {
        size = 'normal';
    }

    if (typeof duration === "undefined" || duration === null || duration === '') {
        duration = null;
    }

    if (typeof msg === "undefined" || msg === null || msg === '') {
        switch ( type ) {
            case 'error':
                msg = 'Se ha producido un error! Por favor, verifique los datos e intente nuevamente.';
                break;
            case 'warning':
                msg = 'Atenci&oacute;n, verifique los datos proporcionados. Esto podría generar un error.';
                break;
            case 'success':
                msg = 'La acci&oacute;n se ha realizado correctamente.';
                break;
            default:
                msg = 'No se ha definido información para mostrar al usuario.';
        }
    }

    switch ( type ) {
        case 'error':
            icon = '<i class="fa fa-fw fa-times-circle"></i>';
            break;
        case 'warning':
            icon = '<i class="fa fa-fw fa-warning"></i>';
            break;
        case 'success':
            icon = '<i class="fa fa-fw fa-check-circle"></i>';
            break;
        default:
            icon = '<i class="fa fa-fw fa-info-circle"></i>';
    }

    var position = getCentralPosition(bounds, x, y);
    xposition = position['x'];
    yposition = position['y'];

    if ( jQuery('body #autodismiss-message').length > 0 ){
        jQuery('body #autodismiss-message').remove();
    }

    jQuery("body").prepend('<span id="autodismiss-message" class="autodismiss-message-' + type + ' autodismiss-message-' + size + '" >' + icon + ( strong ? '<strong>' : '' ) + ' ' + msg + ( strong ? '</strong>' : '' ) +'</span>');

    var spanWidth = parseInt( jQuery('body #autodismiss-message').css('width').replace('px','') );
    autoDismissElement(jQuery('body #autodismiss-message'), 'fade', duration, true, bounds, (xposition - (spanWidth/2) ), yposition );
}


/*  Funcion que retorna los puntos centrales de la ventana o el body. En caso de especificarse los puntos x,y son validados y luego retornados como enteros.
    bounds: ['body'|'window'] Especifica de que contorno se tomaran los puntos centrales, si del body o window. Default: window
    x:      Punto en X especifico. Default: Resultado del calculo por medio del parametro bounds.
    y:      Punto en Y especifico. Default: Resultado del calculo por medio del parametro bounds.
    Retorno: { 'x': value, 'y' : value }.
*/
function getCentralPosition(bounds, x, y){
    if ( typeof x !== "undefined" && x !== null && x !== '' && isNumber(x) ) {
        xposition = Math.round(x);
    }
    else{
        if ( typeof bounds === "undefined" || bounds === null || bounds === '' ) {
            bounds = 'window';
        }
        switch ( bounds ) {
            case 'body':
                xposition = ( parseInt( jQuery('body').css('width').replace('px', '') ) / 2);
                break;
            case 'window':
                xposition = ( jQuery(window).width() / 2 );
                break;
            default:
                xposition = ( jQuery(window).width() / 2 );
        }
    }

    if ( typeof y !== "undefined" && y !== null && y !== '' && isNumber(y) ) {
        yposition = Math.round(y);
    }
    else{
        if ( typeof bounds === "undefined" || bounds === null || bounds === '' ) {
            bounds = 'window';
        }
        switch ( bounds ) {
            case 'body':
                yposition = ( parseInt( jQuery('body').css('height').replace('px', '') ) / 2);
                break;
            case 'window':
                yposition = ( jQuery(window).height() / 2 );
                break;
            default:
                yposition = ( jQuery(window).height() / 2 );
        }
    }

    return { 'x' : xposition , 'y' : yposition };
}

/*  Funcion que agrega Menues de forma flotante y sus respectiva Opciones. Al momento solamente se agrega uno que sirve como Menu Auxiliar Principal
    en layout.html.twig, el cual se utiliza como ejemplo para la definicion de su estructura y se le pueden seguir agregando tabs:
    var auxiliarMenu =  { main :                                                                                        //Nombre del Menu. Requerido.
                            {
                                backgroundColor: '#F9F9F9',                                                               // Color de Fondo del Menu. Default: '#F9F9F9'
                                borderColor    : '#3C8DBC',                                                               // Color del Borde del Menu. Default: '#3C8DBC'
                                color          : '#3C8DBC',                                                               // Color del Texto del Menu. Default: '#3C8DBC'
                                marginTop      : 300,                                                                     // Margen desde el limite superior. Default: 300
                                icon           : '<i class="fa fa-fw fa-bars"></i>',                                      // Icono de inicio del Menu. Default: '<i class="fa fa-fw fa-bars"></i>'
                                tabs           :                                                                          // Se definen las Tabs (u Opciones de Menu Desplegable) que va a tener el Menu.
                                                {
                                                    userTour :                                                            // Identificador de la nueva Tab. Requerido.
                                                        {
                                                            title            : 'Tutorial de Usuario',                     // Titulo Principal del Tab. Default 'New Tab'
                                                            icon             : '<i class="fa fa-fw fa-rocket"></i>',      // Icono del Tab. Default: ''
                                                            dropdown         : true,                                      // Indica si es o no una Opcion de Menu Desplegable. Default: false
                                                            active           : false,                                     // Indica si la Tab aparecera activa por defecto. Solo aplica para Tabs, no para Opciones de Menu Desplegables. Debe especificarse sola en una de las Tabs. Default: false
                                                            content          : '',                                        // Contenido de la Tab. Solo aplica para Tabs. Default: ''
                                                            dropdownOptions  :                                            // Se definen las Opciones de la Opcion de Menu Desplegable. Aplica solo si dropdown es true.
                                                                {
                                                                    createTour :                                          // Identificador de la Opcion. Requerido.
                                                                    {
                                                                        title      : 'Crear',                             // Titulo Principal de la Opcion. Default 'New Option'
                                                                        href       : '#',                                 // Link de la Opcion. Default: '#'
                                                                        addDivider : false,                               // Agrega un divisor en la parte superior de la Opcion. Defaul: false
                                                                        otherAttrs : { 'onClick' : 'createUserTour();' }  // Se pueden especificar otro atributos html para la Opcion. Default: null
                                                                    }
                                                                }
                                                        }
                                                }
                            }
                        };


*/
function buildAuxMenu(auxMenu){

    if( jQuery('#floating-menu-container').length > 0 ){
        var containerElement = '#floating-menu-container';
        var htmlMenu = '';
    }
    else{
        var containerElement = 'body';
        var htmlMenu = '<div id="floating-menu-container">';
    }

    var marginTopIni = ( jQuery('div[id^="floating-menu_"]').length > 0 ) ? ( parseInt( jQuery('div[id^="floating-menu_"]').last().css('margin-top').replace('px', '') ) + 35) : 300;

    for ( menu in auxMenu ){
        var currentMenu = auxMenu[menu];
        htmlMenu += '<div class="floating-menu" id="floating-menu_' + menu + '" style="' +
                            (currentMenu.marginTop ? 'margin-top: ' + currentMenu.marginTop + 'px; ' : 'margin-top: ' + marginTopIni + 'px; ' ) +
                            (currentMenu.backgroundColor ? 'background: ' + currentMenu.backgroundColor + '; ' : '') +
                            (currentMenu.borderColor ? 'border-color: ' + currentMenu.borderColor + '; ' : '') +
                            (currentMenu.color ? 'color: ' + currentMenu.color + '; ' : '') +
                    '">'+
                        ( currentMenu.icon ? currentMenu.icon : '<i class="fa fa-fw fa-bars"></i>' ) +
                        '<div class="nav-tabs-custom floating-menu-options">';

        var htmlTabs = '<ul class="nav nav-tabs">\
                                <li class="pull-left header">' + ( currentMenu.icon ? currentMenu.icon : '<i class="fa fa-fw fa-bars"></i>' ) + ' </li>';

        var htmlTabsContent = '<div class="tab-content">';

        for ( tab in currentMenu.tabs ){
            var currentTab = currentMenu.tabs[tab];
            if( currentTab.dropdown ){
                htmlTabs += '<li class="dropdown">'+
                                '<a class="dropdown-toggle" data-toggle="dropdown" href="#">' + ( currentTab.icon ? currentTab.icon : '' )  + ' ' + ( currentTab.title ? currentTab.title : 'New Tab') + ' <span class="caret"></span></a>'+
                                '<ul class="dropdown-menu">';

                for( option in currentTab.dropdownOptions ){
                    var currentOption = currentTab.dropdownOptions[option];
                    if( currentOption.addDivider ){
                        htmlTabs += '<li role="presentation" class="divider"></li>';
                    }

                    var attributes = ' ';
                    for( attr in currentOption.otherAttrs ){
                        var currentAttr = currentOption.otherAttrs[attr];
                        attributes += attr + '="' +  currentAttr + '" ';
                    }
                    htmlTabs += '<li role="presentation"><a tabindex="-1" href="' + ( currentOption.href ? currentOption.href : '#' ) + '"' + attributes + '>' + ( currentOption.title ? currentOption.title : 'New Option' ) + '</a></li>';
                }

                htmlTabs += '</ul></li>';
            }
            else{
                htmlTabs += '<li class="' + ( currentTab.active ? 'active' : '' ) + '"><a href="#floating-menu-tab_' + tab + '" data-toggle="tab">' + ( currentTab.icon ? currentTab.icon : '' ) + ' ' + ( currentTab.title ? currentTab.title : 'New Tab') + '</a></li>';
                htmlTabsContent += '<div class="tab-pane ' + ( currentTab.active ? 'active' : '' ) + '" id="floating-menu-tab_' + tab + '">' +
                                        ( currentTab.content ? currentTab.content : '' ) + '</div>';
            }
        }

        htmlTabs += '</ul>';
        htmlTabsContent += '</div>';
        htmlMenu += htmlTabs+htmlTabsContent+'</div></div>';

        marginTopIni += 35;
    }

    if( containerElement == 'body' ){
        htmlMenu += '</div>';
        jQuery( containerElement ).prepend(htmlMenu);
    }
    else{
        jQuery( containerElement ).append(htmlMenu);
    }

}

function removeAuxMenu( identifier ){
    if( identifier === 'all' ){
        jQuery('div[id^="floating-menu_"]').remove();
    }
    if( jQuery('#floating-menu_'+identifier).length > 0 ){
        jQuery('#floating-menu_'+identifier).remove();
    }
}

/* JavaScript para User Tour*/
var onStepConfig = false;
var blockStepConfig = false;
var elementStepConfig = null;
var userTourId = null;
var lastDockWidth = null;
var stepCorr = 0;
var deletedSteps = {};

function createUserTour(){

    addUserTourDock();

    document.addEventListener("click",tourCreationClickHandler,true);
    document.addEventListener("mouseover",tourCreationMouseOverHandler,true);
    document.addEventListener("mouseout",tourCreationMouseOutHandler,true);

}

function addUserTourDock(){
    jQuery('body').prepend('<div id="userTourDock" class="box box-solid box-primary dock-div">\
                                    <div id="userTourHeader" class="box-header" >\
                                        <h3 class="box-title">Tutorial de Usuario</h3>\
                                        <div class="box-tools pull-right">\
                                            <button id="userTourDockMin" class="btn btn-primary btn-sm" onClick="minimizeUserTourDock();"><i class="fa fa-minus"></i></button>\
                                            <button id="autoHideUserTourDock" class="btn btn-primary btn-sm" onClick="autoHideUserTourDock();"><i class="fa fa-fw fa-angle-double-up"></i></button>\
                                            <button id="" class="btn btn-primary btn-sm" onClick="resizeUserTourDock(\'expand\');"><i class="fa fa-fw fa-chevron-left"></i></button>\
                                            <button id="" class="btn btn-primary btn-sm" onClick="resizeUserTourDock(\'compress\');"><i class="fa fa-fw fa-chevron-right"></i></button>\
                                            <button class="btn btn-danger btn-sm" onClick="cancelUserTour();"><i class="fa fa-times"></i></button>\
                                        </div>\
                                    </div>\
                                    <div id="userTourBody" class="slimScrollDiv box-body" style="position: relative; overflow-y: scroll; width: auto; max-height: 596px; margin-left: 10px;">\
                                        <form id="userTourForm">\
                                            <div class="form-group" style="margin-bottom: 0px;">\
                                                <p class="text-right" style="font-weight: bold; margin-bottom: 0px;"><i class="fa fa-info-circle" style="cursor: pointer; margin-right: 15px; padding-top: 5px;" onClick="if( jQuery(\'#userTourDockInfo\').is(\':visible\') ) jQuery(\'#userTourDockInfo\').hide(); else jQuery(\'#userTourDockInfo\').show();"></i></p>\
                                                <p id="userTourDockInfo" class="bg-info text-justify" style="display: none; padding: 10px;">\
                                                    Para construir un Tuturial Guiado de Usuario, seleccione con el puntero el elemento donde desea realizar la descripción,\
                                                    o digite de forma manual el selector del elemento según la notación de jQuery. Luego especifique las diferentes opciones globales o de cada paso del tutorial.\
                                                    Para información más detallada, ver la <a href="http://bootstraptour.com/api/" target="_blank">Documentación de Bootstrap Tour</a>.\
                                                </p>\
                                            </div>\
                                            <input type="text" id="creationType" name="creationType" style="display: none;" value="visual-mode">\
                                            <input type="text" id="userTourId" name="userTourId" style="display: none;" value="">\
                                            <div class="form-group">\
                                                <label>Nombre del Tutorial</label>\
                                                <input type="text" id="userTourName" name="userTourName" class="form-control" style="width: 95%; margin-left: 3px;" placeholder="Digite el nombre del tutorial">\
                                            </div>\
                                            <div class="checkbox" style="margin-left: 25px;">\
                                                <input type="checkbox" id="userTourActive" name="userTourActive">\
                                                <label>Habilitado</label>\
                                            </div>\
                                            <div class="checkbox" style="margin-left: 25px;">\
                                                <input type="checkbox" id="userTourKeyboard" name="userTourKeyboard" checked>\
                                                <label>Transición con Teclado</label>\
                                                <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Habilita el uso de teclas (<i class=\'fa fa-fw fa-arrow-left\'></i> , <i class=\'fa fa-fw fa-arrow-right\'></i>) para la navegación del usuario.</span>"></span>\
                                            </div>\
                                            <div class="checkbox" style="margin-left: 25px;">\
                                                <input type="checkbox" id="userTourAutoscroll" name="userTourAutoscroll" checked>\
                                                <label>Scroll automático</label>\
                                                <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Realiza scroll automaticamente cuando el popover del Paso se encuentra fuera del rango de vista.</span>"></span>\
                                            </div>\
                                            <div class="checkbox" style="margin-left: 25px;">\
                                                <input type="checkbox" id="userTourBackdrop" name="userTourBackdrop" checked>\
                                                <label>Fondo Oscuro</label>\
                                                <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Muestra un fondo oscuro detras de cada Paso del tutorial, resaltando el popover actual.</span>"></span>\
                                            </div>\
                                            <div class="checkbox" style="margin-left: 25px;">\
                                                <input type="checkbox" id="userTourEnableDuration" name="userTourEnableDuration" onClick=" if( jQuery(this).is(\':checked\') ) jQuery(\'#userTourDurationDiv\').show(); else { jQuery(\'#userTourDurationDiv\').hide(); jQuery(\'#userTourDuration\').val(\'\'); } ">\
                                                <label>Establecer duración</label>\
                                                <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>El siguiente Paso se muestra automáticamente despues de completar el tiempo de duración especificado (en milisegundos).</span>"></span>\
                                            </div>\
                                            <div class="form-group" id="userTourDurationDiv" style="padding-left: 30px; display: none;">\
                                                <label>Duración: </label>\
                                                <input type="number" id="userTourDuration" name="userTourDuration" min="1" class="form-control" style="width: 110px;">\
                                            </div>\
                                            <div class="checkbox" style="margin-left: 25px;">\
                                                <input type="checkbox" id="userTourOrphan" name="userTourOrphan">\
                                                <label>Permitir mostrar al centro</label>\
                                                <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Permite mostrar el popover del Paso cuando el elemento asociado no esta establecido, no está presente en la página o está oculto. El Paso se despliega en el centro de la página.</span>"></span>\
                                            </div>\
                                            <div class="form-group">\
                                                <span style="cursor: pointer; font-weight: bold;" onClick="if ( jQuery(\'.user-tour-hidden-option\').first().is(\':visible\') ) jQuery(\'.user-tour-hidden-option\').hide(); else jQuery(\'.user-tour-hidden-option\').show();"><i class="fa fa-cogs" style="margin-top: 5px;"></i> Opciones avanzadas</span>\
                                            </div>\
                                            <div class="form-group user-tour-hidden-option" id="try" style="display: none;">\
                                                <label>Nombre de Objeto</label>\
                                                <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Utilizado para construir el objeto Tour con un nombre específico. Default: \'nombre_del_tour\'</span>"></span>\
                                                <input type="text" id="userTourObjectName" name="userTourObjectName" class="form-control" style="width: 98%;" placeholder="Nombre del objeto JS">\
                                            </div>\
                                            <div class="form-group user-tour-hidden-option" style="display: none;">\
                                                <label>Contenedor</label>\
                                                <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto left" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Contenedor HTML en el cual se agregará el popover de los Pasos. Default: \'body\'</span>"></span>\
                                                <input type="text" id="userTourContainer" name="userTourContainer" class="form-control" style="width: 98%;" placeholder="Contenedor del objeto JS">\
                                            </div>\
                                            <div class="form-group user-tour-hidden-option" style="display: none;">\
                                                <label>Contenedor del Fondo</label>\
                                                <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Contenedor HTML en el cual se mostrará el fondo oscuro. Default: \'body\'</span>"></span>\
                                                <input type="text" id="userTourBackdropContainer" name="userTourBackdropContainer" class="form-control" style="width: 98%;" placeholder="Contenedor del fondo oscuro">\
                                            </div>\
                                            <div class="form-group user-tour-hidden-option" style="display: none;">\
                                                <label>Padding del Fondo</label>\
                                                <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Agrega un padding al fondo oscuro. Puede especificar un numero entero u objeto con las opciones top, right, bottom y left. Default: 0</span>"></span>\
                                                <input type="text" id="userTourBackdropPadding" name="userTourBackdropPadding" class="form-control" style="width: 98%;" placeholder="Padding del fondo oscuro">\
                                            </div>\
                                            <div class="form-group user-tour-hidden-option" style="display: none;">\
                                                <label>Template</label>\
                                                <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto left" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Template HTLM para los popover. Ver la documentación de Bootstrap Tour para más información.</span>"></span>\
                                                <textarea id="userTourTemplate" name="userTourTemplate" class="form-control" style="width: 98%;" placeholder=""></textarea>\
                                            </div>\
                                            <ul id="userTourStepsList" class="todo-list" style="overflow: hidden;">\
                                            </ul>\
                                        </form>\
                                    </div>\
                                    <div id="user-tour-footer" class="box-footer">\
                                        <!--<div class="input-group">\
                                            <input class="form-control" placeholder="Type message...">\
                                            <div class="input-group-btn">\
                                                <button class="btn btn-success"><i class="fa fa-plus"></i></button>\
                                            </div>\
                                        </div>-->\
                                        <button type="button" class="btn btn-info" onClick="addTourStep(null, false);"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></button>\
                                        <button type="button" class="btn btn-danger" onClick="cancelUserTour();">Cancelar</button>\
                                        <button type="button" id="saveUserTourButton" class="btn btn-success" onClick="saveUserTour();">Guardar</button>\
                                    </div>\
                                </div>');
                            jQuery('.fd_help_msg').popover({trigger: 'hover'});
                            jQuery('#userTourStepsList').sortable({ placeholder: "sort-highlight",
                                                                    handle: ".handle",
                                                                    forcePlaceholderSize: true,
                                                                    zIndex: 999999
                                                                });//.disableSelection();
}

function minimizeUserTourDock(){
    if( jQuery('#userTourDock').hasClass('minimized-dock') ){
        jQuery('#userTourDock').removeClass('minimized-dock');
        jQuery('#userTourDockMin').empty().append('<i class="fa fa-minus"></i>');

        if ( lastDockWidth ){
            jQuery('#userTourDock').css('max-width', lastDockWidth + '%' );
            //jQuery('body').css('max-width', ( 100 - lastDockWidth ) + '%' );
        }
    }
    else{

        jQuery('#userTourDock').addClass('minimized-dock');
        jQuery('#userTourDockMin').empty().append('<i class="fa fa-square"></i>');

        if( lastDockWidth ){
            jQuery('#userTourDock').css('max-width', '');
            //jQuery('body').css('max-width', '');
        }
    }
}

function autoHideUserTourDock(){
    if( jQuery('#userTourDock').hasClass('dock-div-hover-show') ){
        jQuery('#userTourDock').removeClass('dock-div-hover-show');
        jQuery('#autoHideUserTourDock').empty().append('<i class="fa fa-fw fa-angle-double-up"></i>');
    }
    else{

        jQuery('#userTourDock').addClass('dock-div-hover-show');
        jQuery('#autoHideUserTourDock').empty().append('<i class="fa fa-fw fa-thumb-tack"></i>');
    }
}

function cancelUserTour(){
    if ( onStepConfig ){
        cancelStepAdd();
    }

    jQuery('#userTourDock').remove();

    if( lastDockWidth ){
        jQuery('body').css('max-width', '');
    }

    document.removeEventListener("click",tourCreationClickHandler,true);
    document.removeEventListener("mouseover",tourCreationMouseOverHandler,true);
    document.removeEventListener("mouseout",tourCreationMouseOutHandler,true);
}

function addTourStep( element, hasId ){

    if ( onStepConfig ){
        cancelStepAdd();
    }

    onStepConfig = true;
    var center = false;

    if( element == null ){
        if( jQuery('#auxAddStepDiv').length > 0 ){
            jQuery('#auxAddStepDiv').empty();
        }
        else{
            jQuery('body').append('<div id="auxAddStepDiv"></div>');
        }
        element = jQuery('#auxAddStepDiv');
        center = true;
    }

    elementStepConfig = element;

    element.popover({
        html: true,
        placement: 'auto top',
        trigger: 'manual',
        viewport: { selector: 'body', padding: 0 },
        selector: 'body',
        template: '<div id="stepForm" class="popover' + ( center ? ' tour-tour orphan' : '' ) + '" style="max-width: 300px;" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
        title: '<label>Título</label><input type="text" id="userTourStepTitle" name="userTourStepTitle" class="form-control" placeholder="Título para el usuario">',
        content: function(){
            infoMsgHtml = hasId ? '<div id="stepConfig" style="min-width: 260px; overflow-y: scroll; max-height: 285px;">' : '<div id="stepConfig" style="min-width: 260px; overflow-y: scroll; max-height: 285px;"><p class="bg-info text-justify" style="padding: 5px; border-radius: 10px;" id="stepInfo" ><span class="glyphicon glyphicon-exclamation-sign" style="color: #0080c0;" aria-hidden="true"></span><span style="color: #0080c0; font-weight: bold;"> Elemento sin Id</span><button type="button" class="close" aria-label="Close" onClick="jQuery(\'#stepInfo\').remove();"><span aria-hidden="true">&times;</span></button><br/>El elemento seleccionado no posee Id, digite el selector de forma manual para continuar, o marque la opción mostrar al centro.</p>'
            stepOptionsHtml = '<label>Selector del elemento</label><input type="text" id="stepSelector" name="stepSelector" class="form-control" style="width: 97%;" value="' + ( hasId ? ( '#'+ element.attr('id') ) : '' ) + '" placeholder="Digite el selector del elemento">\
                               <div class="checkbox" style="margin-left: 25px;">\
                                    <input type="checkbox" id="userTourStepOrphan" name="userTourStepOrphan">\
                                    <label>Mostrar al centro</label>\
                                    <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Despliega en el centro de la página el popover del Paso, independientemente si el elemento asociado no esta establecido, no está presente en la página o está oculto.</span>"></span>\
                               </div>\
                               <div class="form-group">\
                                   <label>Descripción</label>\
                                   <input type="text" id="userTourStepContent" name="userTourStepContent" class="form-control" style="width: 97%;" placeholder="Descripción para el usuario">\
                               </div>\
                               <div class="form-group">\
                                   <span style="cursor: pointer; font-weight: bold;" onClick="if ( jQuery(\'.user-tour-step-hidden-option-basic\').first().is(\':visible\') ) { jQuery(\'.user-tour-step-hidden-option-basic\').hide(); jQuery(\'.user-tour-step-hidden-option-advance\').hide(); } else jQuery(\'.user-tour-step-hidden-option-basic\').show();"><i class="fa fa-cog" style="margin-top: 5px;"></i> Más Opciones</span>\
                               </div>\
                               <div class="checkbox user-tour-step-hidden-option-basic" style="margin-left: 25px; display: none;">\
                                   <input type="checkbox" id="userTourStepBackdrop" name="userTourStepBackdrop" ' + (jQuery('#userTourBackdrop').prop('checked') ? 'checked' : '') + '>\
                                   <label>Fondo Oscuro</label>\
                                   <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Muestra un fondo oscuro detras del Paso, resaltando el popover actual.</span>"></span>\
                               </div>\
                               <div class="checkbox user-tour-step-hidden-option-basic" style="margin-left: 25px; display: none;">\
                                   <input type="checkbox" id="userTourStepEnableDuration" name="userTourStepEnableDuration" onClick=" if( jQuery(this).is(\':checked\') ) jQuery(\'#userTourStepDurationDiv\').show(); else { jQuery(\'#userTourStepDurationDiv\').hide(); jQuery(\'#userTourStepDuration\').val(\'\'); } ">\
                                   <label>Establecer duración</label>\
                                   <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>El siguiente Paso se muestra automáticamente despues de completar el tiempo de duración especificado (en milisegundos).</span>"></span>\
                               </div>\
                               <div class="form-group" id="userTourStepDurationDiv" style="padding-left: 30px; display: none;">\
                                   <label>Duración: </label>\
                                   <input type="number" id="userTourStepDuration" name="userTourStepDuration" min="1" class="form-control" style="width: 110px;">\
                               </div>\
                               <div class="checkbox user-tour-step-hidden-option-basic" style="margin-left: 25px; display: none;">\
                                    <input type="checkbox" id="userTourStepAnimation" name="userTourStepAnimation" checked>\
                                    <label>Aplicar animación</label>\
                                    <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Aplica animación de transición.</span>"></span>\
                               </div>\
                               <div class="form-group user-tour-step-hidden-option-basic" style="margin-bottom: 0px; display: none;">\
                                    <label>Posición</label>\
                               </div>\
                               <div class="radio-inline user-tour-step-hidden-option-basic" style="padding-left: 0px; display: none;">\
                                    <input type="radio" id="userTourStepPlacement1" name="userTourStepPlacement" style="display: none;" value="top">\
                                    <span class="badge hover-blue" for="userTourStepPlacement1" onClick="jQuery(\'#\' + jQuery(this).attr(\'for\')).prop(\'checked\', true); jQuery(\'.selected-blue\').removeClass(\'selected-blue\'); jQuery(this).addClass(\'selected-blue\');"><i class="fa fa-fw fa-arrow-up"></i></span>\
                               </div>\
                               <div class="radio-inline user-tour-step-hidden-option-basic" style="padding-left: 0px; display: none;">\
                                    <input type="radio" id="userTourStepPlacement2" name="userTourStepPlacement" style="display: none;" value="right" checked>\
                                    <span class="badge hover-blue selected-blue" for="userTourStepPlacement2" onClick="jQuery(\'#\' + jQuery(this).attr(\'for\')).prop(\'checked\', true); jQuery(\'.selected-blue\').removeClass(\'selected-blue\'); jQuery(this).addClass(\'selected-blue\');"><i class="fa fa-fw fa-arrow-right"></i></span>\
                               </div>\
                               <div class="radio-inline user-tour-step-hidden-option-basic" style="padding-left: 0px; display: none;">\
                                    <input type="radio" id="userTourStepPlacement3" name="userTourStepPlacement" style="display: none;" value="bottom">\
                                    <span class="badge hover-blue" for="userTourStepPlacement3" onClick="jQuery(\'#\' + jQuery(this).attr(\'for\')).prop(\'checked\', true); jQuery(\'.selected-blue\').removeClass(\'selected-blue\'); jQuery(this).addClass(\'selected-blue\');"><i class="fa fa-fw fa-arrow-down"></i></span>\
                               </div>\
                               <div class="radio-inline user-tour-step-hidden-option-basic" style="padding-left: 0px; display: none;">\
                                    <input type="radio" id="userTourStepPlacement4" name="userTourStepPlacement" style="display: none;" value="left">\
                                    <span class="badge hover-blue" for="userTourStepPlacement4" onClick="jQuery(\'#\' + jQuery(this).attr(\'for\')).prop(\'checked\', true); jQuery(\'.selected-blue\').removeClass(\'selected-blue\'); jQuery(this).addClass(\'selected-blue\');"><i class="fa fa-fw fa-arrow-left"></i></span>\
                               </div>\
                               <div class="form-group user-tour-step-hidden-option-basic" style="display: none; margin-top: 8px;">\
                                   <span style="cursor: pointer; font-weight: bold;" onClick="if ( jQuery(\'.user-tour-step-hidden-option-advance\').first().is(\':visible\') ) jQuery(\'.user-tour-step-hidden-option-advance\').hide(); else jQuery(\'.user-tour-step-hidden-option-advance\').show();"><i class="fa fa-cogs" style="margin-top: 5px;"></i> Opciones avanzadas</span>\
                               </div>\
                               <div class="form-group user-tour-step-hidden-option-advance" style="display: none;">\
                                   <label>Contenedor</label>\
                                   <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto left" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Contenedor HTML en el cual se agregará el popover de los Pasos. Default: \'body\'</span>"></span>\
                                   <input type="text" id="userTourStepContainer" name="userTourStepContainer" class="form-control" style="width: 97%;" placeholder="Contenedor del objeto JS">\
                               </div>\
                               <div class="form-group user-tour-step-hidden-option-advance" style="display: none;">\
                                   <label>Contenedor del Fondo</label>\
                                   <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Contenedor HTML en el cual se mostrará el fondo oscuro. Default: \'body\'</span>"></span>\
                                   <input type="text" id="userTourStepBackdropContainer" name="userTourStepBackdropContainer" class="form-control" style="width: 98%;" placeholder="Contenedor del fondo oscuro">\
                               </div>\
                               <div class="form-group user-tour-step-hidden-option-advance" style="display: none;">\
                                   <label>Padding del Fondo</label>\
                                   <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto top" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Agrega un padding al fondo oscuro. Puede especificar un numero entero u objeto con las opciones top, right, bottom y left. Default: 0</span>"></span>\
                                   <input type="text" id="userTourStepBackdropPadding" name="userTourStepBackdropPadding" class="form-control" style="width: 97%;" placeholder="Padding del fondo oscuro">\
                               </div>\
                               <div class="form-group user-tour-step-hidden-option-advance" style="display: none;">\
                                   <label>Template</label>\
                                   <span class="glyphicon glyphicon-info-sign fd_help_msg" data-toggle="popover" data-placement="auto left" data-html="true" data-content="<span style=\'font-size: 12px; color: #0A78AC;\'>Template HTLM para los popover. Ver la documentación de Bootstrap Tour para más información.</span>"></span>\
                                   <textarea id="userTourStepTemplate" name="userTourStepTemplate" class="form-control" style="width: 97%;" placeholder=""></textarea>\
                               </div>\
                               <div>\
                                    <input type="text" id="userTourStepOrden" name="userTourStepOrden" class="form-control" value="' + ( jQuery('#userTourStepsList li[id^="step"] ').length ) + '" style="display: none;">\
                               </div>\
                               </div>\
                               ';
            stepActionsHtml = '<div class="linear-divider"></div>\
                               <button class="btn btn-danger btn-sm" onClick="window.event.preventDefault(); cancelStepAdd();">Cancelar</i></button>\
                               <button class="btn btn-success btn-sm" onClick="window.event.preventDefault(); confirmStepAdd(null);">Confirmar</i></button>\
                               ';

            return infoMsgHtml + stepOptionsHtml + stepActionsHtml;
        }
    });

    element.popover('show');
    //jQuery('input[name="userTourStepPlacement"]').show();
    jQuery('.fd_help_msg').popover({trigger: 'hover'});
}

function cancelStepAdd(){
    elementStepConfig.popover('destroy');
    onStepConfig = false;
    elementStepConfig = null;
}

function confirmStepAdd(id){

    var edit = userTourId ? true : false;
    var done = false;

    var identifier = id ? id : ( edit ? null : ( ++stepCorr ) );
    var newStep = id ? false : true;
    var pre = id ? '' : '';
    if( identifier ){
        addStepToList(pre, identifier, newStep );
        showAutoDismissMsg('Agregado correctamente!', 'success', 'normal', true, 'window', null, null, 4000);
        done = true;
    }
    else{

        var stepFormInputs = getStepFormInputs('', 'object', newStep);
        console.log(stepFormInputs);
        jQuery('body').append('<div id="saving-message"><i class="fa fa-fw fa-save"></i><span> Guardando...<span></div>');
        showOverCenter(jQuery('#saving-message'));

        stepFormInputs[ 'tourId' ] = userTourId;

        $.ajax({
            method: "POST",
            url: Routing.generate('createtourstep'),
            async: false,
            dataType: 'json',
            data: stepFormInputs
        })
        .done( function(data, textStatus, jqXHR, e) {
            console.log(data);
            if( data.success == 'true' ){
                identifier = data.id;
                addStepToList(pre, identifier, newStep );
                showAutoDismissMsg('Agregado correctamente!', 'success', 'normal', true, 'window', null, null, 4000);
                done = true;
            }
            else{
                showAutoDismissMsg('Se ha producido un error al guardar el nuevo paso. Por favor, intente nuevamente.', 'error', 'normal', true, 'window', null, null, 4000);
                console.log(data.error);
            }
        })
        .fail( function(data, jqXHR, textStatus, errorThrown){
            jQuery('#saving-message').remove();
            showAutoDismissMsg('Se ha producido un error al guardar el nuevo paso. Por favor, intente nuevamente.', 'error', 'normal', true, 'window', null, null, 4000);
            console.log('Error: '+textStatus);
        });
        jQuery('#saving-message').remove();
    }

    if ( done ){
        jQuery('#' + pre +'stepCheckbox' + identifier).iCheck({checkboxClass: 'icheckbox_flat-green'});
        elementStepConfig.popover('destroy');
        onStepConfig = false;
        elementStepConfig = null;
    }
}

function addStepToList(pre, identifier, newStep ){

    var stepFormInputs = getStepFormInputs(identifier, 'html', newStep);

    jQuery('#userTourStepsList').append('\
        <li id="' + pre +'step' + identifier + '">\
            <span class="handle">\
                <i class="fa fa-ellipsis-v"></i>\
                <i class="fa fa-ellipsis-v"></i>\
            </span>\
            <input type="checkbox" id="' + pre +'stepCheckbox' + identifier + '"  name="stepCheckbox" value="' + identifier + '" new="'+ newStep + '">\
            <span class="text">' + jQuery('#userTourStepTitle').val() + '</span>\
            <!--<small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>-->\
            <div class="tools">\
                <i class="fa fa-fw fa-toggle-down" onClick="showStepDesc(' + identifier + ', this, ' + newStep +');"></i>\
                <i class="fa fa-edit"></i>\
                <i class="fa fa-trash-o" onClick="deleteStep(' + identifier + ',' + newStep + ')"></i>\
            </div>\
            <div id="' + pre +'stepDesc' + identifier + '" style="display: none;">\
                ' + jQuery('#userTourStepContent').val() + '\
            </div>\
            <div id="' + pre +'stepInputsDiv' + identifier + '">\
                ' + stepFormInputs + '\
            </div>\
        </li>');
}

function showStepDesc(id, element, newStep){

    if ( typeof newStep === "undefined" || newStep === null || newStep === '' || ( jQuery.inArray( newStep, [false,true] ) < 0 ) ) {
        newStep = false;
    }

    var pre = newStep ? '' : '';

    var identifier = '#' + pre + 'stepDesc' + id;

    if( jQuery( identifier ).is(":visible") ){
        jQuery( identifier ).hide();
        jQuery(element).removeClass('fa-toggle-up').addClass('fa-toggle-down');
    }
    else{
        jQuery( identifier ).show();
        jQuery(element).removeClass('fa-toggle-down').addClass('fa-toggle-up');
    }
}

function getStepFormInputs(id, dataType, newStep){

    var inputHtml = '';
    var inputData = {};
    var pre = ( newStep ? '' : '' );

    jQuery("div#stepForm :input").each( function(){

        var input = jQuery(this);
        var inputName = pre + input.attr('name') + id;

        if( input.prop('nodeName') !== 'BUTTON'){
            if( input.attr('type') == 'checkbox' ){
                if( dataType == 'html')
                    inputHtml += '<input type="text" id="' + inputName + '" name="' + inputName + '" value="' + ( input.prop('checked') ? 'true' : 'false' ) + '" style="display: none;">';
                else
                    inputData[ inputName ] = input.prop('checked') ? 'true' : 'false';
            }
            else if( input.attr('type') == 'radio') {
                if( input.prop('checked') ){
                    if( dataType == 'html')
                        inputHtml += '<input type="text" id="' + inputName + '" name="' + inputName + '" value="' + input.val() + '" style="display: none;">';
                    else
                        inputData[ inputName ] = input.val();
                }
            }
            else{
                if( dataType == 'html')
                    inputHtml += '<input type="text" id="' + inputName + '" name="' + inputName + '" value="' + input.val() + '" style="display: none;">';
                else
                    inputData[ inputName ] = input.val();
            }
        }
    });

    if( dataType == 'html')
        return inputHtml;
    else
        return inputData;
}

function deleteStep(id, newStep){
    blockStepConfig = true;
    var pre = newStep ? '' : '';

    var title = '¿Eliminar el paso seleccionado?';
    var dialogClass = 'dialog-warning';
    var msg = 'Se eliminara el paso seleccionado del tutorial. ¿Desea continuar con esta acción?';
    var width = 350;

    var arrayBtns =
    [{
        text: 'Continuar', click: function() {

            if( ! newStep ){
                deletedSteps.push(id);
            }
            jQuery('#' + pre + 'step' + id ).remove();
            jQuery( this ).dialog( "close" );
            blockStepConfig = false;
            showAutoDismissMsg('Eliminado correctamente!', 'success', 'normal', true, 'window', null, null, 4000);
        }
    },
    {
        text: 'Cancelar', click: function() {
            jQuery( this ).dialog( "close" );
            blockStepConfig = false;
        }
    }];

    showDialogMsg(title, msg, dialogClass, '', arrayBtns, false, width);
}


function saveUserTour(){

    blockStepConfig = true;

    if ( onStepConfig ){
        cancelStepAdd();
    }

    if( jQuery('#userTourName').val().replace(/\s+/g, '') != '' ){
        if( jQuery('#userTourEnableDuration').prop('checked') == false || ( jQuery('#userTourEnableDuration').prop('checked') && jQuery('#userTourDuration').val() )  ){
            if( jQuery('#userTourEnableDuration').prop('checked') == false || ( jQuery('#userTourEnableDuration').prop('checked') && isNumber( parseInt( jQuery('#userTourDuration').val() ) ) && parseInt( jQuery('#userTourDuration').val() ) > 0 ) ){
                jQuery('body').append('<div id="saving-message"><i class="fa fa-fw fa-save"></i><span> Guardando...<span></div>');
                showOverCenter(jQuery('#saving-message'));
                var inputData = {};

                jQuery("form#userTourForm :input").each( function(){

                    var input = jQuery(this);

                    if( input.attr('type') == 'checkbox' ){
                        inputData[ input.attr('name') ] = input.prop('checked') ? 'true' : 'false';
                    }
                    else{
                        inputData[ input.attr('name') ] = input.val();
                    }
                });

                console.log(inputData);

                $.ajax({
                    method: "POST",
                    url: userTourCreateRoute,
                    async: false,
                    dataType: 'json',
                    data: inputData
                })
                .done( function(data, textStatus, jqXHR, e) {
                    console.log(data);
                    jQuery('#saving-message').remove();
                    if( data.success == 'true' ){
                        showAutoDismissMsg('El nuevo tutorial se ha guardado correctamente!', 'success', 'normal', true, 'window', null, null, 4000);
                        jQuery('#userTourId').val(data.id)
                        userTourId = data.id;
                        jQuery('#saveUserTourButton').text('Actualizar');
                    }
                    else{
                        showAutoDismissMsg('Se ha producido un error al guardar el tutorial. Por favor, intente nuevamente.', 'error', 'normal', true, 'window', null, null, 4000);
                        console.log(data.error);
                    }
                })
                .fail( function(data, jqXHR, textStatus, errorThrown){
                    jQuery('#saving-message').remove();
                    showAutoDismissMsg('Se ha producido un error al guardar los datos. Por favor, intente nuevamente.', 'error', 'normal', true, 'window', null, null, 4000);
                    console.log('Error: '+textStatus);
                });
            }
            else{
                showAutoDismissMsg('Debe especificar una Duración valida.', 'error', 'normal', true, 'window', null, null, 4000);
            }
        }
        else{
            showAutoDismissMsg('No ha especificado la Duración.', 'error', 'normal', true, 'window', null, null, 4000);
        }
    }
    else{
        showAutoDismissMsg('Digite el Nombre del Tutorial de usuario.', 'error', 'normal', true, 'window', null, null, 4000);
    }

    blockStepConfig = false;
}


function resizeUserTourDock(action, diff){

    if (typeof diff === "undefined" || diff === null || diff === '') {
        diff = 1;
    }
    // El atributo max-width para userTourDock esta expresado en proporcion (%)
    var currentMaxWidth = parseInt( jQuery('#userTourDock').css('max-width').replace('%','') );
    var maxMaxWidth = 40;
    var minMaxWidth = 25;

    if( action == 'expand'){
        var newMaxWidth = currentMaxWidth + diff;
    }
    else{
        var newMaxWidth = currentMaxWidth - diff;
    }

    if( newMaxWidth > maxMaxWidth ) {
        newMaxWidth = maxMaxWidth;
    }
    else if ( newMaxWidth < minMaxWidth ) {
        newMaxWidth = minMaxWidth;
    }

    jQuery('#userTourDock').css('max-width', newMaxWidth + '%' );
    //jQuery('body').css('max-width', ( 100 - newMaxWidth ) + '%' );

    lastDockWidth = newMaxWidth;
}

function tourCreationClickHandler(e){
    if ( onStepConfig == false && blockStepConfig == false ){
        if( ! (jQuery(e.target).closest("#userTourDock").length > 0) ){ //Aplicar a todo elemento fuera del userTourDock
            e.stopPropagation();
            e.preventDefault();
            var hasId = ( jQuery(e.target).attr('id') ) ? true : false;
            addTourStep( jQuery(e.target), hasId );
        }
    }
}

function tourCreationMouseOverHandler(e){
    if ( onStepConfig == false && blockStepConfig == false ){
        if( ! (jQuery(e.target).closest("#userTourDock").length > 0) ){ //Aplicar a todo elemento fuera del userTourDock
            jQuery(e.target).addClass('tour-hover-element');
        }
    }
}

function tourCreationMouseOutHandler(e){
    jQuery(e.target).removeClass('tour-hover-element');
}



function initializeElementWysihtml5(element) {
    var options = setWysihtml5Options(element);
    element.wysihtml5(options);
}

function setWysihtml5Options(element) {
    var newOptions = {
        "image"      : false,
        "blockquote" : false,
        "size"       : "sm",
        'locale'     : "es-ES"
    };
    var attr = element.attr();

    jQuery.each(attr, function(key, value) {
        if(key.match('^data-editor-')) {
            var option = slugToCamelCase(key.replace('data-editor-',''));

            newOptions[option] = isNaN(value) ? ( value === 'true' ? true : ( value === 'false' ? false : ( isJson( value ) ? JSON.parse(value) : value ) ) ) : parseInt(value);
        }
    });

    return newOptions;
}

/*
 *  setEditors
 *      Función que permite inicializar los editores wysihtml5 y CK Editor
 *      que vienen incorporados con AdminLTE
 *
 *  Documentación:
 *      https://almsaeedstudio.com/themes/AdminLTE/pages/forms/editors.html
 *      https://github.com/bootstrap-wysiwyg/bootstrap3-wysiwyg
 *      http://docs.cksource.com/Main_Page
 */
function setEditors() {
    jQuery('body [data-editor-enabled="true"]').each(function() {
        switch (jQuery(this).attr('data-editor-type')) {
            case 'wysihtml5':
                initializeElementWysihtml5(jQuery(this));
                break;
            case 'ckeditor':
                break;
            default:
                break;
        }
    });
}
/*
 *  validateDUI
 *      Función que permite validar si el Documento Único de Identidad
 *      es valido.
 *
 *  Parametros de entrada: número a validar
 *  Retorna: Booleano que indica que el DUI es válido.
 */
function validateDUI(dui){
    var dui_parts=[];
    var validador='';
    var digitos='';
    var posicion=9;
    var suma=0;
    var resta=0;
    var mod=0;
    var valido=false;

    //SI EL DUI NO TIENE 10 CARACTERES INICIA EL ALGORITMO
    //SINO DESDE AHI NO ES VALIDO
    if(dui.length==10){
        if(dui!='00000000-0'){
            //SE PARTE PARA TENER APARTE EL VERIFICADOR
            dui_parts=dui.split('-');
            //VERIFICA QUE SEAN DOS ELEMENTOS EN EL ARRAY
            if(dui_parts.length==2){
                if (dui_parts[1].length==1){//VERIFICA QUE EL SEGUNDO VALOR ES UN CARACTER
                    validador= parseInt(dui_parts[1]);
                    digitos=dui_parts[0];//LO HAGO ARRAY PARA RECORRELOS

                    for(var i=0;i<digitos.length;i++){
                        suma=suma+(parseInt(digitos[i])*posicion);
                        posicion--;
                    }

                    mod=suma%10;

                    if (validador==0 && mod==0){
                        mod=10;
                    }

                    resta=10-mod;
                    if(resta==validador)
                        valido=true;
                }
            }
        }
    }

    return valido;
}

/*
 *  validateCUN
 *      Función que permite validar si el expediente del niño es un número valido
 *
 *  Parametros de entrada: número a validar
 *  Retorna: Booleano que indica que el CUN es válido.
 */
function validateCUN(cun){
    if(cun.length<12){
        return false;
    }
    var valoresNumero='0'+cun.substring(0,cun.length-1);
    var par=0;
    var impar=0;
    var calculo_impar;
    var calculo_par;
    var valido=false;
    var decena_superior;
    var verificador;
    var verificadorCUN;
    var i;

    for (i = 0; i < valoresNumero.length; i++) {
        if ( i % 2 == 0) {
            par=par+parseInt(valoresNumero[i]);
        }else{
            impar=impar+parseInt(valoresNumero[i]);
        }
    }

    calculo_impar=impar*3;
    calculo_par=par;
    suma=calculo_par+calculo_impar;
    decena_superior=Math.ceil((suma/10))*10;
    verificador=decena_superior-suma;
    verificadorCUN=cun.substring(cun.length-1, cun.length);

    if (verificador==verificadorCUN) {
        valido=true;
    }

    return valido;
}
