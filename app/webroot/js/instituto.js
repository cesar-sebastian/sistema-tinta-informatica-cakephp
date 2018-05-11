$(function() {
    inicialize();
});

function inicialize()
{
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        dateFormat: 'dd/mm/yy'
    })
    
    $('#myTab a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    })

    $('#AddForm').validate({
        rules: {
            'data[Instituto][nombre_canonico]': {
                minlength: 2,
                alphanumeric: true,
                required: true
            },
            'data[Instituto][nombre_comun]': {
                minlength: 2,
                alphanumeric: true,
                required: true
            },
            'data[Instituto][sigla]': {
                minlength: 2,
                alphanumeric: true,
                required: true
            },
            'data[Instituto][cuit]': {                
                required: true,
                cuit: true
            },
            'data[Instituto][nro_reg_ent_bien_publico]': {                
                required: true,
                alphanumeric: true
            },
            'data[Instituto][formas_id]': {                
                required: true
            },
            'data[Sede][calle]': {
                required: true,
                alphanumeric: true
            },
            'data[Sede][numero]': {
                required: true,
                number: true
            },
            'data[Sede][piso]': {
                required: true,
                number: true
            },
            'data[Sede][departamento]': {
                required: true,
                alphanumeric: true
            },
            'data[Sede][oficina]': {
                required: true,
                alphanumeric: true
            },
            'data[Sede][telefono]': {
                required: true,
                alphanumeric: true
            },
            'data[Sede][fax]': {
                required: true,
                alphanumeric: true
            },
            'data[Sede][email]': {
                required: true,                
                email: true
            },
            'data[Sede][juridiccion_id]': {
                required: true
            },
            'data[Instituto][tipo_entidades_id]': {
                required: true
            },
            'data[Instituto][calle]': {
                required: true,
                alphanumeric: true
            },
            'data[Instituto][numero]': {
                required: true,
                number: true
            },
            'data[Instituto][piso]': {
                required: true,
                number: true
            },
            'data[Instituto][departamento]': {
                required: true,
                number: true
            },
            'data[Instituto][oficina]': {
                required: true,
                alphanumeric: true
            },
            'data[Instituto][telefono]': {
                required: true,
                number: true
            },
            'data[Instituto][fax]': {
                required: true,
                number: true
            },
            'data[Instituto][email]': {
                required: true,
                email: true
            },
            'data[Instituto][decreto_ereccion_autoridad]': {                
                required: false,
                alphanumeric: true
            },
            /*'data[Instituto][decreto_ereccion_fecha]': {
                required: true                
            },*/
            
            'data[Instituto][admision_autoridad]': {
                required: true,
                alphanumeric: true
            },
            'data[Instituto][admision_lugar]': {
                required: true,
                alphanumeric: true
            },
            'data[Instituto][admision_fecha]': {
                required: true                
            },
            'data[Instituto][finalidad]': {
                required: true,                
            },
            'data[Instituto][sg_nombre_apellido]': {
                required: true,
                nya: true
            },
            'data[Instituto][sg_cargo]': {
                required: true,
                nya: true
            },
            'data[Instituto][sg_domicilio]': {
                required: true,
                alphanumeric: true
            },
            'data[Instituto][sm_nombre_apellido]': {
                required: true,
                nya: true
            },
            'data[Instituto][sm_cargo]': {
                required: true,
                nya: true
            },
            'data[Instituto][sm_tipodocumentos_id]': {
                required: true
            },
            'data[Instituto][sm_numero_doc]': {
                required: true,
                digits: true
            },
            'data[Instituto][sm_periodo_mandato]': {
                required: true,
                alphanumeric: true
            },
            'data[Instituto][sm_fecha_desde]': {
                required: true
            },
            'data[Instituto][sm_fecha_hasta]': {
                required: true
            },
            
            'data[PersoneriaJuridica][denominacion]':{
                //required: true,
                alphanumeric: true
            },
            'data[PersoneriaJuridica][autoridad_otorgante]':{
                //required: true,
                nya: true
            },
            'data[PersoneriaJuridica][numero_resolucion]':{
                //required: true,
                alphanumeric: true
            },
            'data[PersoneriaJuridica][fecha]':{
                //required: true
            },
            'data[PersoneriaJuridica][especificacion]':{
                //required: false,
                alphanumeric: true
            },
            'data[PersoneriaJuridica][tipospersoneriasjuridicas_id]':{
                //required: true
            }
        },
        messages: {
            'data[Instituto][nombre_canonico]': {
                required: "Ingrese nombre canónico de instituto"
            },
            'data[Instituto][nombre_comun]': {
            	required: "Ingrese nombre común de instituto"
            },
            'data[Instituto][sigla]': {
            	required: "Ingrese sigla de instituto"
            },
            'data[Instituto][cuit]': {                
            	required: "Ingrese cuit de instituto"
            },
            'data[Instituto][nro_reg_ent_bien_publico]': {               
            	required: "Ingrese n° registro de entidad bien público"
            },
            'data[Instituto][formas_id]': {                
            	required: "Seleccione una forma de sede"
            },
            'data[Sede][calle]': {
            	required: "Ingrese calle de sede"
            },
            'data[Sede][numero]': {
            	required: "Ingrese número de calle de sede"
            },
            'data[Sede][piso]': {
            	required: "Ingrese piso de sede"
            },
            'data[Sede][departamento]': {
            	required: "Ingrese departamento de sede"
            },
            'data[Sede][oficina]': {
            	required: "Ingrese oficina de sede"
            },
            'data[Sede][telefono]': {
            	required: "Ingrese número de teléfono de sede"
            },
            'data[Sede][fax]': {
            	required: "Ingrese número de fax de sede"
            },
            'data[Sede][email]': {
            	required: "Ingrese email de sede"
            },
            'data[Sede][juridiccion_id]': {
            	required: "Seleccione jurisdicción eclesiástica"
            },
            'data[Instituto][tipo_entidades_id]': {
            	required: "Seleccione tipo de entidad"
            },
            'data[Instituto][calle]': {
            	required: "Ingrese calle de instituto"
            },
            'data[Instituto][numero]': {
            	required: "Ingrese número de calle de instituto"
            },
            'data[Instituto][piso]': {
            	required: "Ingrese piso de instituto"
            },
            'data[Instituto][departamento]': {
            	required: "Ingrese departamento de instituto"
            },
            'data[Instituto][oficina]': {
            	required: "Ingrese oficina de instituto"
            },
            'data[Instituto][telefono]': {
            	required: "Ingrese número de teléfono de instituto"
            },
            'data[Instituto][fax]': {
            	required: "Ingrese fax de instituto"
            },
            'data[Instituto][email]': {
            	required: "Ingrese email de instituto"
            },
            'data[Instituto][decreto_ereccion_autoridad]': {                
            	required: "Ingrese decreto erección - autoridad"
            },
            /*'data[Instituto][decreto_ereccion_fecha]': {
                required: true                
            },*/
            
            'data[Instituto][admision_autoridad]': {
            	required: "Ingrese admisión en la R.A. - autoridad"
            },
            'data[Instituto][admision_lugar]': {
            	required: "Ingrese admisión en la R.A. - Lugar"
            },
            'data[Instituto][admision_fecha]': {
            	required: "Ingrese admisión en la R.A. - Fecha"                
            },
            'data[Instituto][finalidad]': {
            	required: "Ingrese finalidad"                
            },
            'data[Instituto][sg_nombre_apellido]': {
            	required: "Ingrese nombre y apellido de superior general"
            },
            'data[Instituto][sg_cargo]': {
            	required: "Ingrese cargo de superior general"
            },
            'data[Instituto][sg_domicilio]': {
            	required: "Ingrese domicilio de superior general"
            },
            'data[Instituto][sm_nombre_apellido]': {
            	required: "Ingrese nombre y apellido de superior mayor"
            },
            'data[Instituto][sm_cargo]': {
            	required: "Ingrese cargo de superior mayor"
            },
            'data[Instituto][sm_tipodocumentos_id]': {
            	required: "Seleccione tipo de documento de superior mayor"
            },
            'data[Instituto][sm_numero_doc]': {
            	required: "Ingrese nro de documento de superior mayor"
            },
            'data[Instituto][sm_periodo_mandato]': {
            	required: "Ingrese periodo mandato de superior mayor"
            },
            'data[Instituto][sm_fecha_desde]': {
            	required: "Ingrese fecha inicio de superior mayor"
            },
            'data[Instituto][sm_fecha_hasta]': {
            	required: "Ingrese fecha final de superior mayor"
            },
            'data[PersoneriaJuridica][denominacion]':{
            	//required: "Ingrese denominaciín de pers. juridica"
            },
            'data[PersoneriaJuridica][autoridad_otorgante]':{
            	//required: "Ingrese autoridad otorgante de pers. jurídica"
            },
            'data[PersoneriaJuridica][numero_resolucion]':{
            	//required: "Ingrese autoridad otorgante de pers. jurídica"
            },
            'data[PersoneriaJuridica][fecha]':{
            	//required: "Ingrese fecha de pers. jurídica"
            },
            'data[PersoneriaJuridica][especificacion]':{
            	//required: "Ingrese especificación de pers. jurídica"
            },
            'data[PersoneriaJuridica][tipospersoneriasjuridicas_id]':{
            	//required: "Seleccione tipo de pers. jurídica"
            }
        },
        highlight: function(element) {
            //$(element).closest('.control-group').removeClass('success').addClass('error');
            
            //error
            
            //<span class="glyphicon glyphicon-remove form-control-feedback"></span>
            
            //pinto el input
            $(element).closest('.form-group').removeClass('has-success has-feedback').addClass('has-error has-feedback');
            
            
            //elimino todo span que diga ok -> class="glyphicon glyphicon-ok form-control-feedback"
            //$(element).find("span.glyphicon.glyphicon-ok.form-control-feedback").remove();
            
            //console.log($(element).find("span").length);
            /*$(element).find("span").each(function(){                
                $(this).remove();
                
            });*/
            
            /*$(element).remove('span');
            $(element).closest('.form-group').append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');*/
            
            //agrego el span correspondiente a error
            
            
        },
        success: function(element) {
            /*element
                .text('OK!').addClass('valid')
                .closest('.control-group').removeClass('error').addClass('success');*/
            
            //ok
            //console.log(element);
            
            //<span class="glyphicon glyphicon-ok form-control-feedback"></span>
            
            
            
            //pinto el input
            element.closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');
            
            //elimino todo span que esté en el input -> class="glyphicon glyphicon-remove form-control-feedback"
            //element.closest('.form-group').find("span").remove();            
            //element.find("span.glyphicon.glyphicon-remove.form-control-feedback").remove();
            
            //console.log(element.find("span").length);
            /*element.find("span").each(function(){
                $(this).remove();                
                //console.log($(this));
            });*/
            /*element.remove('span');
            element.closest('.form-group').append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');*/
            
            //agrego el span correspondiente a ok
            
        }
    });

}

function guardar()
{
    //alert('entro');
    validarAll();
    if ($('#AddForm').validate() && $('#AddForm').valid())    
    {   
        submitCustomize();
    } 
}


function submitCustomize()
{
    var messagge = ''
    if(!validarSede())
    {
        messagge += 'Debe completar los campos obligatorios en "Sede" <br/>';
    } 
    if(!validarDomicilio())
    {
        messagge += 'Debe completar los campos obligatorios en "Domicilio" <br/>';
    }    
    if(!validarDecreto())
    {
        messagge += 'Debe completar los campos obligatorios en "Decreto" <br/>';
    }
    if(!validarAdmision())
    {
        messagge += 'Debe completar los campos obligatorios en "Decreto" <br/>';
    }
    if(!validarSuperiorGeneralMayor())
    {
        messagge += 'Debe completar los campos obligatorios en "Superior General y Mayor" <br/>';
    }
    if(!validarPJ())
    {
        messagge += 'Debe completar los campos obligatorios en "Personeria Jurídica" <br/>';
    }
    
    if(messagge == '')
    {
        $('#AddForm').submit();
    } else {
        bootbox.alert("Errores: <br/>"+ messagge);
    }
    
    
}



function validarAll()
{   
    if(!validarSede())
    {            
        $('#sedeToggle').html('Sede <span class="glyphicon glyphicon-info-sign"></span>');
        
    } else {            
        $('#sedeToggle').html('Sede <span class="glyphicon glyphicon-ok-sign"></span>');          
    }

    if(!validarDomicilio())
    {
        $('#domicilioToggle').html('Domicilio en C.A.B.A <span class="glyphicon glyphicon-info-sign"></span>');     
        
    } else {
        $('#domicilioToggle').html('Domicilio en C.A.B.A <span class="glyphicon glyphicon-ok-sign"></span>');        
    }

    if(!validarDecreto())
    {
        $('#decretoToggle').html('Decreto de Erección <span class="glyphicon glyphicon-info-sign"></span>');  
        
        
    } else {
        $('#decretoToggle').html('Decreto de Erección <span class="glyphicon glyphicon-ok-sign"></span>');
     
    }

    if(!validarAdmision())
    {
        $('#admisionToggle').html('Admisión en la Republica Argentina <span class="glyphicon glyphicon-info-sign"></span>');     
        
        
    } else {
        $('#admisionToggle').html('Admisión en la Republica Argentina <span class="glyphicon glyphicon-ok-sign"></span>');
     
    }

    if(!validarSuperiorGeneralMayor())
    {
        $('#superiorGeneralMayorToggle').html('Superior General y Mayor <span class="glyphicon glyphicon-info-sign"></span>');            
        
    } else {
        $('#superiorGeneralMayorToggle').html('Superior General y Mayor <span class="glyphicon glyphicon-ok-sign"></span>');
     
    }
    
    if(!validarPJ())
    {
        $('#addPJ').removeClass('btn btn-info btn-sm').addClass('btn btn-danger btn-sm');
    }else{
        $('#addPJ').removeClass('btn btn-danger btn-sm').addClass('btn btn-info btn-sm');
    }
    
    
}

function validarSliderPJ()
{
    if (!($('#pj_denominacion').valid() && $('#pj_autoridad').valid() && $('#pj_nroresolucion').valid() && $('#pj_fecha').valid() && $('#pj_especificacion').valid() && $('#pj_tipo_pers_jurid').valid() && $('#pj_tipo_pers_jurid').valid()))
    {
        //pintar de rojo el boton
        $('#addPJ').removeClass('btn btn-info btn-sm').addClass('btn btn-danger btn-sm');
        
    } else {
        //pintar de celeste el boton        
        $('#addPJ').removeClass('btn btn-danger btn-sm').addClass('btn btn-info btn-sm');        
    }
}



function validarSede()
{   
    return $('#s_calle').valid() && $('#s_numero').valid() && $('#s_piso').valid() && $('#s_departamento').valid() && $('#s_oficina').valid() && $('#s_telefono').valid() && $('#s_fax').valid() && $('#s_email').valid();    
}

function validarDomicilio()
{
    return $('#calle').valid() && $('#numero').valid() && $('#piso').valid() && $('#departamento').valid() && $('#oficina').valid() && $('#telefono').valid() && $('#fax').valid() && $('#email').valid();
}

function validarDecreto()
{
    return $('#dea').valid() && $('#def').valid();
}

function validarAdmision()
{
    return $('#aa').valid() && $('#al').valid() && $('#af').valid();
}

function validarSuperiorGeneralMayor()
{
    return $('#sg_nombre_apellido').valid() && $('#sg_cargo').valid() && $('#sg_domicilio').valid() && $('#sm_nombre_apellido').valid() && $('#sm_cargo').valid() && $('#sm_tipodocumentos_id').valid() && $('#sm_numero_doc').valid() && $('#sm_periodo_mandato').valid() && $('#sm_periodo_mandato').valid() && $('#sm_fecha_hasta').valid();
}

function validarSuperiorGeneralMayor()
{
    return $('#sg_nombre_apellido').valid() && $('#sg_cargo').valid() && $('#sg_domicilio').valid() && $('#sm_nombre_apellido').valid() && $('#sm_cargo').valid() && $('#sm_tipodocumentos_id').valid() && $('#sm_numero_doc').valid() && $('#sm_periodo_mandato').valid() && $('#sm_periodo_mandato').valid() && $('#sm_fecha_hasta').valid();
}

function validarPJ()
{
    //return $('#pj_denominacion').valid() && $('#pj_autoridad').valid() && $('#pj_nroresolucion').valid() && $('#pj_fecha').valid() && $('#pj_especificacion').valid() && $('#pj_tipo_pers_jurid').valid() && $('#pj_tipo_pers_jurid').valid();
    return true;//$('#pj_denominacion').valid() && $('#pj_autoridad').valid() && $('#pj_nroresolucion').valid() && $('#pj_fecha').valid() && $('#pj_especificacion').valid() && $('#pj_tipo_pers_jurid').valid() && $('#pj_tipo_pers_jurid').valid();
}

/*function validarDocumentacion()
{
    return $('#').valid() && $('#').valid();
}*/
    
    
    
/*domicilioToggle
decretoToggle
admisionToggle
superiorGeneralMayorToggle
documentacionToggle*/