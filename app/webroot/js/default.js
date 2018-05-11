
jQuery.validator.addMethod('alphanumeric', function(value, element, param) {
    //return this.optional(element) || /^[0-9A-Za-záéíóúñ]$/i.test(value);
    //return this.optional(element) || /^[ A-Za-z0-9]+$/i.test(value);
    return this.optional(element) || /^[ A-Za-z0-9]+$/.test(value);
}, 'Ingrese letras y números');

jQuery.validator.addMethod("nya", function(value, element) {
    return this.optional(element) || /^[A-Za-záéíóúñ\s]{2,}$/i.test(value);
}, "Ingrese contenido alfabético válido");

jQuery.validator.addMethod('cuit', function(value, element, param) {
    return this.optional(element) || /^\d{2}\-\d{8}\-\d{1}$/i.test(value);
}, 'Ingrese cuit válido. Ej.:22-22222222-2');



$.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);