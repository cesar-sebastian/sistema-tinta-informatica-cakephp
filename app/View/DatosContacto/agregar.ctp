<h2 class="sub-header"><small>Nuevo Dato del contacto</small>  
    <!-- <a class="btn btn-default navbar-right" href="/formas/">Volver a la lista</a> -->
    <!-- <a class="btn btn-default navbar-right" href="/casos/index/">Volver a la lista</a>-->
    <a class="btn btn-primary navbar-right" href="/datos_contacto/<?php echo ($this->Session->Check('pag_'.$this->request->param('controller')))?'index/page:'.$this->Session->read('pag_'.$this->request->param('controller')):'index';?>">
  	Volver a la lista
  	</a>
</h2>
<div class="row-fluid" style="margin-top: 30px;">
    <div class="col-md-12">
        <fieldset>
            <form class="form-horizontal" id="AddForm" role="form" action="/datos_contacto/agregar/" method="POST" enctype="multipart/form-data">
                <div class="col-sm-12 well">
                	<ul class="nav nav-tabs" role="tablist" id="myTab">
					  <li role="titulo"><a href="#esp" role="tab" data-toggle="tab">ESP</a></li>
					  <li role="titulo"><a href="#ing" role="tab" data-toggle="tab">ING</a></li>
					  <li role="titulo"><a href="#por" role="tab" data-toggle="tab">POR</a></li>
					  <li role="titulo"><a href="#fra" role="tab" data-toggle="tab">FRA</a></li>
					  <!-- <li role="titulo"><a href="#ale" role="tab" data-toggle="tab">ALE</a></li>-->
					</ul>
					<div class="tab-content">
						<!--  FORMULARIO ESPAÑOL -->
						<div role="tabpanel" class="tab-pane active micontrol" id="esp">
						    <input type="hidden" name="data[ItemDatos][1][idiomas_id]" value="1" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Titulo</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][1][titulo]', '', 'wysiwyg_titulo_esp',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','html'),
													'requerido'=>'Por favor complete el titulo'
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Dirección Postal</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][1][direccion_postal]', '', 'wysiwyg_direccion_esp',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','html'),
													'requerido'=>'Por favor complete dirección postal'
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-2">
							  		<label class="control-label">Logo</label>
							  	</div>
							  	<div class="col-sm-6">
							  		<input type="hidden" id="logo" name="data[ItemDatos][1][logo]">
							  		<label class="control-label"><input type="file" name="data[ItemDatos][1][logo]" id="img_logo_esp" /></label>
							  	</div>
							</div>
							<div class="form-group" id="email">
								<div class="col-sm-2">
			                    	<label class="control-label">Email</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="email" class="form-control" name="data[ItemDatos][1][email]" size="100" maxlength="100" />
			                    </div>
			                </div>
			                <div class="form-group">
								<div class="col-sm-2">
			                    	<label class="control-label">Web</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="web" class="form-control" name="data[ItemDatos][1][web]" size="255" maxlength="255" />
			                    </div>
			                </div>
			                <div class="form-group">
								<div class="col-sm-2">
			                    	<label class="control-label">Telefono</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="telefono" class="form-control" name="data[ItemDatos][1][telefono]" size="50" maxlength="50" />
			                    </div>
			                </div>
						</div>
						<!--  FORMULARIO INGLES -->
						<div role="tabpanel" class="tab-pane micontrol" id="ing">
							<input type="hidden" name="data[ItemDatos][2][idiomas_id]" value="2" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Titulo</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][2][titulo]', '', 'wysiwyg_titulo_ing',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','html'),
													'requerido'=>'Por favor complete titulo'
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Dirección Postal</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][2][direccion_postal]', '', 'wysiwyg_direccion_ing',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','html'),
													'requerido'=>'Por favor complete dirección postal'
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-2">
							  		<label class="control-label">Logo</label>
							  	</div>
							  	<div class="col-sm-6">
							  		<input type="hidden" id="logo" name="data[ItemDatos][2][logo]">
							  		<label class="control-label"><input type="file" name="data[ItemDatos][2][logo]" id="img_logo_ing" /></label>
							  	</div>
							</div>
							<div class="form-group" id="email">
								<div class="col-sm-2">
			                    	<label class="control-label">Email</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="email" class="form-control" name="data[ItemDatos][2][email]" size="100" maxlength="100" />
			                    </div>
			                </div>
			                <div class="form-group">
								<div class="col-sm-2">
			                    	<label class="control-label">Web</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="web" class="form-control" name="data[ItemDatos][2][web]" size="255" maxlength="255" />
			                    </div>
			                </div>
			                <div class="form-group">
								<div class="col-sm-2">
			                    	<label class="control-label">Telefono</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="telefono" class="form-control" name="data[ItemDatos][2][telefono]" size="50" maxlength="50" />
			                    </div>
			                </div>
						</div>
						<!--  FORMULARIO PORTUGUES -->
						<div role="tabpanel" class="tab-pane micontrol" id="por">
							<input type="hidden" name="data[ItemDatos][3][idiomas_id]" value="3" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Titulo</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][3][titulo]', '', 'wysiwyg_titulo_por',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','html'),
													'requerido'=>'Por favor complete titulo'
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Dirección Postal</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][3][direccion_postal]', '', 'wysiwyg_direccion_por',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','html'),
													'requerido'=>'Por favor complete dirección postal'
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-2">
							  		<label class="control-label">Logo</label>
							  	</div>
							  	<div class="col-sm-6">
							  		<input type="hidden" id="logo" name="data[ItemDatos][3][logo]">
							  		<label class="control-label"><input type="file" name="data[ItemDatos][3][logo]" id="img_logo_por" /></label>
							  	</div>
							</div>
							<div class="form-group" id="email">
								<div class="col-sm-2">
			                    	<label class="control-label">Email</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="email" class="form-control" name="data[ItemDatos][3][email]" size="100" maxlength="100" />
			                    </div>
			                </div>
			                <div class="form-group">
								<div class="col-sm-2">
			                    	<label class="control-label">Web</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="web" class="form-control" name="data[ItemDatos][3][web]" size="255" maxlength="255" />
			                    </div>
			                </div>
			                <div class="form-group">
								<div class="col-sm-2">
			                    	<label class="control-label">Telefono</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="telefono" class="form-control" name="data[ItemDatos][3][telefono]" size="50" maxlength="50" />
			                    </div>
			                </div>
						</div>
						<!--  FORMULARIO FRANCES -->
						<div role="tabpanel" class="tab-pane micontrol" id="fra">
							<input type="hidden" name="data[ItemDatos][4][idiomas_id]" value="4" />
						  	<br />
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Titulo</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][4][titulo]', '', 'wysiwyg_titulo_fra',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','html'),
													'requerido'=>'Por favor complete titulo'
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Dirección Postal</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][4][direccion_postal]', '', 'wysiwyg_direccion_fra',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','html'),
													'requerido'=>'Por favor complete dirección postal'
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-2">
							  		<label class="control-label">Logo</label>
							  	</div>
							  	<div class="col-sm-6">
							  		<input type="hidden" id="logo" name="data[ItemDatos][4][logo]">
							  		<label class="control-label"><input type="file" name="data[ItemDatos][4][logo]" id="img_logo_fra" /></label>
							  	</div>
							</div>
							<div class="form-group" id="email">
								<div class="col-sm-2">
			                    	<label class="control-label">Email</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="email" class="form-control" name="data[ItemDatos][4][email]" size="100" maxlength="100" />
			                    </div>
			                </div>
			                <div class="form-group">
								<div class="col-sm-2">
			                    	<label class="control-label">Web</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="web" class="form-control" name="data[ItemDatos][4][web]" size="255" maxlength="255" />
			                    </div>
			                </div>
			                <div class="form-group">
								<div class="col-sm-2">
			                    	<label class="control-label">Telefono</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="telefono" class="form-control" name="data[ItemDatos][4][telefono]" size="50" maxlength="50" />
			                    </div>
			                </div>
						</div>
						<!--  FORMULARIO ALEMAN -->
						<!-- <div role="tabpanel" class="tab-pane micontrol" id="ale">
							<input type="hidden" name="data[ItemDatos][5][idiomas_id]" value="5" />
						  	<br />
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Titulo</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][5][titulo]', '', 'wysiwyg_titulo_ale',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','html'),
													'requerido'=>'Por favor complete titulo'
												) 
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Dirección Postal</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][5][direccion_postal]', '', 'wysiwyg_direccion_ale',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','html'),
													'requerido'=>'Por favor complete dirección postal'
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-2">
							  		<label class="control-label">Logo</label>
							  	</div>
							  	<div class="col-sm-6">
							  		<input type="hidden" id="logo" name="data[ItemDatos][5][logo]">
							  		<label class="control-label"><input type="file" name="data[ItemDatos][5][logo]" id="img_logo_ale" /></label>
							  	</div>
							</div>
						</div>-->
					</div>
				</div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="button" class="btn btn-success"  onclick="guardar()">Guardar</button>
                    </div>
                </div>                
            </form>
        </fieldset>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
        inicialize();
    });

    
    function inicialize()
    {
    	//console.log($('#wysiwyg_#index#_itemA_esp'));
    	$('#myTab a:first').tab('show');
    	$('#img_logo_esp').change(function(){
    		$('label[for=img_logo_esp]').hide(); 
        });
    	$('#img_logo_ing').change(function(){
    		$('label[for=img_logo_ing]').hide();
        });
    	$('#img_logo_por').change(function(){
    		$('label[for=img_logo_por]').hide();  
        });
    	$('#img_logo_fra').change(function(){
    		$('label[for=img_logo_fra]').hide();  
        });
    	/*$('#img_logo_ale').change(function(){
    		$('label[for=img_logo_ale]').hide();  
        });*/
        $('#AddForm').validate({
           rules: {               
               'data[ItemDatos][1][email]': {
                   minlength: 2,
                   required: false,
                   email:true
               },
               /*'data[ItemDatos][1][web]': {
                   minlength: 2,
                   required: false
               },
               'data[ItemDatos][1][telefono]': {
                   minlength: 2,
                   required: false
               },*/
               'data[ItemDatos][2][email]': {
                   minlength: 2,
                   required: false,
                   email:true
               },
               /*'data[ItemDatos][2][web]': {
                   minlength: 2,
                   required: false
               },
               'data[ItemDatos][2][telefono]': {
                   minlength: 2,
                   required: false
               },*/
               'data[ItemDatos][3][email]': {
                   minlength: 2,
                   required: false,
                   email:true
               },
               /*'data[ItemDatos][3][web]': {
                   minlength: 2,
                   required: false
               },
               'data[ItemDatos][3][telefono]': {
                   minlength: 2,
                   required: false
               },*/
               'data[ItemDatos][4][email]': {
                   minlength: 2,
                   required: false,
                   email:true
               },
               /*'data[ItemDatos][4][web]': {
                   minlength: 2,
                   required: false
               },
               'data[ItemDatos][4][telefono]': {
                   minlength: 2,
                   required: false
               },*/
               'data[ItemDatos][1][logo]': {
            	   required: true
               },
               'data[ItemDatos][2][logo]': {
            	   required: true
               },
               'data[ItemDatos][3][logo]': {
            	   required: true
               },
               'data[ItemDatos][4][logo]': {
            	   required: true
               }/*,
               'data[ItemDatos][5][logo]': {
            	   required: true
               }*/
               
           },
           messages: {               
               'data[DatosContacto][email]': {
                   required: 'Complete el email válido'
               }
           },
           highlight: function(element) {
         	   var id_attr = "#" + $( element ).attr("id");
                $(id_attr).closest('.form-group').removeClass('has-success').addClass('has-error');
                $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');
                //if ($('label.error').val()=='') $('label.error').remove();
                         
            },
            unhighlight: function(element) {
         	    var id_attr = "#" + $( element ).attr("id");
                $(id_attr).closest('.form-group').removeClass('has-error').addClass('has-success');
                $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');
                //if ($('label.error').val()=='') $('label.error').remove(); 
                //$('div#'+$( element ).attr("id")+' label.error').remove();
                //if ($('div#'+$( element ).parent().attr("id")+' label.error').val()=='') $('div#'+$( element ).parent().attr("id")+' label.error').remove();
         	  
            },
            success: function(element) {
            	$('.nav-tabs > li.active > a').removeClass('has-error');
                $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');
                //$('div#'+$( element ).attr("id")+' label.error').remove();  
                //$('label.error').remove();
                //alert($( element ).parent().find('label').html());
                //if ($('div#'+$( element ).parent().attr("id")+' label.error').val()=='') $('div#'+$( element ).parent().attr("id")+' label.error').remove();
                if ($( element ).parent().find('label').html()=='') $( element ).parent().find('label').remove();
            }
           
        });
    }
    
    function guardar()
    { 
		var error = 0;
		//$('input[name="data[opcion]"]').val(opcion);
		//var validator = $('#AddForm').validate();
		$('.nav-tabs > li.active > a').css('color','#555555');
        if( $('#AddForm').valid())
        {

        	/*validator.addClassRules("name", {
        		required: true,
        		minlength: 2
        	});*/
        	/*if ($('#img_logo_esp').val()=='') {
        		validator.showErrors({
                	"data[ItemDatos][1][logo]": "Por favor suba un logo"
                });
        		$('#myTab a[href="#esp"]').tab('show');
                $('#img_logo_esp').focus();
             	return false;
        	}
        	if ($('#img_logo_ing').val()=='') {
        		validator.showErrors({
                	"data[ItemDatos][2][logo]": "Por favor suba un logo"
                });
        		$('#myTab a[href="#ing"]').tab('show');
                $('#img_logo_ing').focus();
             	return false;
        	}
        	if ($('#img_logo_por').val()=='') {
        		validator.showErrors({
                	"data[ItemDatos][3][logo]": "Por favor suba un logo"
                });
        		$('#myTab a[href="#por"]').tab('show');
                $('#img_logo_por').focus();
             	return false;
        	}
        	if ($('#img_logo_fra').val()=='') {
        		validator.showErrors({
                	"data[ItemDatos][4][logo]": "Por favor suba un logo"
                });
        		$('#myTab a[href="#fra"]').tab('show');
                $('#img_logo_fra').focus();
             	return false;
        	}
        	if ($('#img_logo_ale').val()=='') {
        		validator.showErrors({
                	"data[ItemDatos][5][logo]": "Por favor suba un logo"
                });
        		$('#myTab a[href="#ale"]').tab('show');
                $('#img_logo_ale').focus();
             	return false;
        	}*/
        	$('.micontrol iframe').each( function() {
            	var myItem = $(this).parent().parent().parent().parent().find('div').attr('class');
                if ($(this).contents().find('body').html() == '' ||  $(this).contents().find('body').html() == '<br>') {
                  	var idioma = myItem.split("_").pop();
                	//if (idioma == 'esp' || opcion==0) {						
    	            var hash = "#"+idioma;   
    	            $('#myTab a[href="' + hash + '"]').tab('show');
    	            //$('.nav-tabs > li > a').css('color','#2fa4e7');
    	            //$('.nav-tabs > li.active > a').css('color','red');
    	            $('.nav-tabs > li.active > a').addClass('has-error');
    	            $('label#'+myItem).show();
    	            $(this).contents().find('body').focus();
    	            error=1;          	
    	            return false;
                    //}
                }
            });
            if (!error) {
            	$('#AddForm').submit();
            }	  	
        }
    }  
</script>