<?php //debug($itemDatos['ItemDatos']);?>
<h2 class="sub-header"><small>Editar Datos del contacto <?php //echo $this->data['DatosContacto']['id']; ?></small>
    <a class="btn btn-primary navbar-right" href="/datos_contacto/<?php echo ($this->Session->Check('pag_'.$this->request->param('controller')))?'index/page:'.$this->Session->read('pag_'.$this->request->param('controller')):'index';?>">
  	Volver a la lista
  	</a>
	<!-- <a class="btn btn-default navbar-right" href="/casos/">Volver a la lista</a>
	<a class="btn btn-default navbar-right" href="#" onclick="history.go(-1);">Volver a la lista</a>-->
</h2>
<div class="row-fluid" style="margin-top: 30px;">
    <div class="col-md-12">
        <fieldset>
            <form class="form-horizontal" id="EditForm" role="form" action="/datos_contacto/editar/<?php echo $this->data['DatosContacto']['id']; ?>" method="POST" enctype="multipart/form-data">
                <div class="col-sm-12 well">
                	<ul class="nav nav-tabs" role="tablist" id="myTab">
					  <li role="titulo"><a href="#esp" role="tab" data-toggle="tab">ESP</a></li>
					  <li role="titulo"><a href="#ing" role="tab" data-toggle="tab">ING</a></li>
					  <li role="titulo"><a href="#por" role="tab" data-toggle="tab">POR</a></li>
					  <li role="titulo"><a href="#fra" role="tab" data-toggle="tab">FRA</a></li>
					</ul>
					<div class="tab-content">
						<!--  FORMULARIO ESPAÑOL -->
						<div role="tabpanel" class="tab-pane active micontrol" id="esp">
							<input type="hidden" name="data[ItemDatos][1][id]" value="<?php echo $itemDatos['ItemDatos'][1]['id']; ?>" />
						    <input type="hidden" name="data[ItemDatos][1][idiomas_id]" value="1" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Titulo</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][1][titulo]', $itemDatos['ItemDatos'][1]['titulo'], 'wysiwyg_titulo_esp',
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
												'data[ItemDatos][1][direccion_postal]', $itemDatos['ItemDatos'][1]['direccion_postal'], 'wysiwyg_direccion_esp',
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
							  		<input type="hidden" id="img_logo_esp" name="data[ItemDatos][1][logo]" value="<?php echo $itemDatos['ItemDatos'][1]['logo'];?>" >
					                
					                <?php if (isset($itemDatos['ItemDatos'][1]['logo']) && !empty($itemDatos['ItemDatos'][1]['logo'])) { ?>
					                    <img src="<?php echo $this->webroot;?>files/<?php echo $itemDatos['ItemDatos'][1]['logo'];?>" height="100" border="0" /><br />
					                <?php } ?>
					                &nbsp;&nbsp;
					                <label class="control-label">                         
							  		<input type="file" name="data[ItemDatos][1][imagen]" class="img_logo_esp" />
							  		</label>
							  	</div>
							</div>
							<div class="form-group" id="email">
								<div class="col-sm-2">
			                    	<label class="control-label">Email</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="email" class="form-control" name="data[ItemDatos][1][email]" size="100" maxlength="100" value="<?php echo $itemDatos['ItemDatos'][1]['email']; ?>" />
			                    </div>
			                </div>
			                <div class="form-group" id="web">
								<div class="col-sm-2">
			                    	<label class="control-label">Web</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="web" class="form-control" name="data[ItemDatos][1][web]" size="255" maxlength="255" value="<?php echo $itemDatos['ItemDatos'][1]['web']; ?>" />
			                    </div>
			                </div>
			                <div class="form-group" id="telefono">
								<div class="col-sm-2">
			                    	<label class="control-label">Telefono</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="telefono" class="form-control" name="data[ItemDatos][1][telefono]" size="50" maxlength="50" value="<?php echo $itemDatos['ItemDatos'][1]['telefono']; ?>" />
			                    </div>
			                </div>
						</div>
						<!--  FORMULARIO INGLES -->
						<div role="tabpanel" class="tab-pane micontrol" id="ing">
							<input type="hidden" name="data[ItemDatos][2][id]" value="<?php echo $itemDatos['ItemDatos'][2]['id']; ?>" />
							<input type="hidden" name="data[ItemDatos][2][idiomas_id]" value="2" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Titulo</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][2][titulo]', $itemDatos['ItemDatos'][2]['titulo'], 'wysiwyg_titulo_ing',
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
												'data[ItemDatos][2][direccion_postal]', $itemDatos['ItemDatos'][2]['direccion_postal'], 'wysiwyg_direccion_ing',
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
							  		<input type="hidden" id="img_logo_ing" name="data[ItemDatos][2][logo]" value="<?php echo $itemDatos['ItemDatos'][2]['logo'];?>" >
					                <?php if (isset($itemDatos['ItemDatos'][2]['logo']) && !empty($itemDatos['ItemDatos'][2]['logo'])) { ?>
					                    <img src="<?php echo $this->webroot;?>files/<?php echo $itemDatos['ItemDatos'][2]['logo'];?>" height="100" border="0" /><br />
					                <?php } ?>
					                &nbsp;&nbsp;
					                <label class="control-label">                         
							  		<input type="file" name="data[ItemDatos][2][imagen]" class="img_logo_ing" />
							  		</label>
							  	</div>
							</div>
							<div class="form-group" id="email">
								<div class="col-sm-2">
			                    	<label class="control-label">Email</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="email" class="form-control" name="data[ItemDatos][2][email]" size="100" maxlength="100" value="<?php echo $itemDatos['ItemDatos'][2]['email']; ?>" />
			                    </div>
			                </div>
			                <div class="form-group" id="web">
								<div class="col-sm-2">
			                    	<label class="control-label">Web</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="web" class="form-control" name="data[ItemDatos][2][web]" size="255" maxlength="255" value="<?php echo $itemDatos['ItemDatos'][2]['web']; ?>" />
			                    </div>
			                </div>
			                <div class="form-group" id="telefono">
								<div class="col-sm-2">
			                    	<label class="control-label">Telefono</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="telefono" class="form-control" name="data[ItemDatos][2][telefono]" size="50" maxlength="50" value="<?php echo $itemDatos['ItemDatos'][2]['telefono']; ?>" />
			                    </div>
			                </div>
						</div>
						<!--  FORMULARIO PORTUGUES -->
						<div role="tabpanel" class="tab-pane micontrol" id="por">
							<input type="hidden" name="data[ItemDatos][3][id]" value="<?php echo $itemDatos['ItemDatos'][3]['id']; ?>" />
							<input type="hidden" name="data[ItemDatos][3][idiomas_id]" value="3" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Titulo</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][3][titulo]', $itemDatos['ItemDatos'][3]['titulo'], 'wysiwyg_titulo_por',
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
												'data[ItemDatos][3][direccion_postal]', $itemDatos['ItemDatos'][3]['direccion_postal'], 'wysiwyg_direccion_por',
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
							  		<input type="hidden" id="img_logo_por" name="data[ItemDatos][3][logo]" value="<?php echo $itemDatos['ItemDatos'][3]['logo'];?>" >
					                
					                <?php if (isset($itemDatos['ItemDatos'][3]['logo']) && !empty($itemDatos['ItemDatos'][3]['logo'])) { ?>
					                    <img src="<?php echo $this->webroot;?>files/<?php echo $itemDatos['ItemDatos'][3]['logo'];?>" height="100" border="0" /><br />
					                <?php } ?>
					                &nbsp;&nbsp;
					                <label class="control-label">                         
							  		<input type="file" name="data[ItemDatos][3][imagen]" class="img_logo_por" />
							  		</label>
							  	</div>
							</div>
							<div class="form-group" id="email">
								<div class="col-sm-2">
			                    	<label class="control-label">Email</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="email" class="form-control" name="data[ItemDatos][3][email]" size="100" maxlength="100" value="<?php echo $itemDatos['ItemDatos'][3]['email']; ?>" />
			                    </div>
			                </div>
			                <div class="form-group" id="web">
								<div class="col-sm-2">
			                    	<label class="control-label">Web</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="web" class="form-control" name="data[ItemDatos][3][web]" size="255" maxlength="255" value="<?php echo $itemDatos['ItemDatos'][3]['web']; ?>" />
			                    </div>
			                </div>
			                <div class="form-group">
								<div class="col-sm-2">
			                    	<label class="control-label">Telefono</label>
			                    </div>
			                    <div class="col-sm-6" id="telefono">
			                        <input type="text" id="telefono" class="form-control" name="data[ItemDatos][3][telefono]" size="50" maxlength="50" value="<?php echo $itemDatos['ItemDatos'][3]['telefono']; ?>" />
			                    </div>
			                </div>
						</div>
						<!--  FORMULARIO FRANCES -->
						<div role="tabpanel" class="tab-pane micontrol" id="fra">
							<input type="hidden" name="data[ItemDatos][4][id]" value="<?php echo $itemDatos['ItemDatos'][4]['id']; ?>" />
							<input type="hidden" name="data[ItemDatos][4][idiomas_id]" value="4" />
						  	<br />
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Titulo</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[ItemDatos][4][titulo]', $itemDatos['ItemDatos'][4]['titulo'], 'wysiwyg_titulo_fra',
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
												'data[ItemDatos][4][direccion_postal]', $itemDatos['ItemDatos'][4]['direccion_postal'], 'wysiwyg_direccion_fra',
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
							  		<input type="hidden" id="img_logo_fra" name="data[ItemDatos][4][logo]" value="<?php echo $itemDatos['ItemDatos'][4]['logo'];?>" >
					                
					                <?php if (isset($itemDatos['ItemDatos'][4]['logo']) && !empty($itemDatos['ItemDatos'][4]['logo'])) { ?>
					                    <img src="<?php echo $this->webroot;?>files/<?php echo $itemDatos['ItemDatos'][4]['logo'];?>" height="100" border="0" /><br />
					                <?php } ?>
					                &nbsp;&nbsp;
					                <label class="control-label">                         
							  		<input type="file" name="data[ItemDatos][4][imagen]" class="img_logo_fra" />
							  		</label>
							  	</div>
							</div>
							<div class="form-group" id="email">
								<div class="col-sm-2">
			                    	<label class="control-label">Email</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="email" class="form-control" name="data[ItemDatos][4][email]" size="100" maxlength="100" value="<?php echo $itemDatos['ItemDatos'][4]['email']; ?>" />
			                    </div>
			                </div>
			                <div class="form-group" id="web">
								<div class="col-sm-2">
			                    	<label class="control-label">Web</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="web" class="form-control" name="data[ItemDatos][4][web]" size="255" maxlength="255" value="<?php echo $itemDatos['ItemDatos'][4]['web']; ?>" />
			                    </div>
			                </div>
			                <div class="form-group" id="telefono">
								<div class="col-sm-2">
			                    	<label class="control-label">Telefono</label>
			                    </div>
			                    <div class="col-sm-6">
			                        <input type="text" id="telefono" class="form-control" name="data[ItemDatos][4][telefono]" size="50" maxlength="50" value="<?php echo $itemDatos['ItemDatos'][4]['telefono']; ?>" />
			                    </div>
			                </div>
						</div>
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
<div style="display:none;" id="dialog">¿Está seguro que desea guardar este dato?</div>
<script type="text/javascript">
	$(document).ready(function() {
        inicialize();
    });

    
    function inicialize()
    {
    	//console.log($('#wysiwyg_#index#_itemA_esp'));
    	$('#myTab a:first').tab('show');
    	$('.img_logo_esp').change(function(){
    		$('label[for=img_logo_esp]').hide(); 
        });
    	$('.img_logo_ing').change(function(){
    		$('label[for=img_logo_ing]').hide();
        });
    	$('.img_logo_por').change(function(){
    		$('label[for=img_logo_por]').hide();  
        });
    	$('.img_logo_fra').change(function(){
    		$('label[for=img_logo_fra]').hide();  
        });
    	/*$('.img_logo_ale').change(function(){
    		$('label[for=img_logo_ale]').hide();  
        });*/
        $('#EditForm').validate({
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
                'data[ItemDatos][1][email]': {
                    required: 'Complete el email válido'
                },
                'data[ItemDatos][2][email]': {
                    required: 'Complete el email válido'
                },
                'data[ItemDatos][3][email]': {
                    required: 'Complete el email válido'
                },
                'data[ItemDatos][4][email]': {
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
    	//$('.nav-tabs > li.active > a').css({'color':'#555555','background-color':'#ffffff'});
    	$('.nav-tabs > li.active > a').css('color','#555555');
        if( $('#EditForm').valid())
        {	
        	//var validator = $( "#EditForm" ).validate();
        	/*if ($('#wysiwyg_titulo_esp').val() == '') {
        		validator.showErrors({
                    "data[ItemDatos][1][titulo]": "Por favor complete titulo"
                });
        		$('#myTab a[href="#esp"]').tab('show');
        		$('.nav-tabs > li.active > a').css('color','red');  
        		$('#wysiwyg_titulo_esp').focus();
        		return false;
        	}
        	if ($('#wysiwyg_direccion_esp').val() == '') {
        		validator.showErrors({
        			"data[ItemDatos][1][direccion_postal]": "Por favor complete direccion postal"
                });
        		$('#myTab a[href="#esp"]').tab('show');
        		$('.nav-tabs > li.active > a').css('color','red');  
        		$('#wysiwyg_direccion_esp').focus();
        		return false;
        	}*/

        	$('.micontrol iframe').each( function() {           
                var myItem = $(this).parent().parent().parent().parent().find('div').attr('class');
            	if ($(this).contents().find('body').html() == '' ||  $(this).contents().find('body').html() == '<br>') {
                	var idioma = myItem.split("_").pop();
	                var hash = "#"+idioma;   
                    $('#myTab a[href="' + hash + '"]').tab('show');
                    //$('.nav-tabs > li > a').css('color','#2fa4e7');
	                //$('.nav-tabs > li.active > a').css('color','red');
	                $('.nav-tabs > li.active > a').addClass('has-error');
                	$('label#'+myItem).show();
                	$(this).contents().find('body').focus();	
	            	error=1;
                	return false;
            	}
            });
            if (!error) {
	       	 	bootbox.confirm("¿ Está seguro que desea guardar estos datos", function(result) {
	             	if (result)
	                {
			            $('#EditForm').submit();
	                }
	        	 });
            }
        }
    }  

    
    function borrar(id)
    {
        bootbox.confirm("¿Estás seguro de borrar este dato #"+id+"?", function(result) {
                if (result)
                {
                    document.location.href = "/datos_contacto/borrar/"+id;
                }
            }); 
    }
</script>
