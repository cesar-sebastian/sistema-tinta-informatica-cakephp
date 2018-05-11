<?php //debug($datos);?>
<h2 class="sub-header"><small>Editar pais de idiomas <?php //echo $this->data['DatosContacto']['id']; ?></small>
    <a class="btn btn-primary navbar-right" href="/paises/<?php echo ($this->Session->Check('pag_paises'))?'index/page:'.$this->Session->read('pag_paises'):'index';?>">
  	Volver a la lista
  	</a>
	<!-- <a class="btn btn-default navbar-right" href="/casos/">Volver a la lista</a>
	<a class="btn btn-default navbar-right" href="#" onclick="history.go(-1);">Volver a la lista</a>-->
</h2>
<div class="row-fluid" style="margin-top: 30px;">
    <div class="col-md-12">
        <fieldset>
            <form class="form-horizontal" id="EditForm" role="form" action="/paises_idioma/editar/<?php echo $paises_id; ?>" method="POST" enctype="multipart/form-data">
                <div class="col-sm-12 well">
                	<div class="form-group">
						<div class="col-sm-12">
							<b>Pais: <?php echo $pais; ?></b>
	                		<!-- <input type="text" name="pais" value="<?php echo $pais; ?>" disabled />-->
	                	</div>
	                </div>
	                <br />
                	<ul class="nav nav-tabs" role="tablist" id="myTab">
					  <li role="titulo"><a href="#ing" role="tab" data-toggle="tab">ING</a></li>
					  <li role="titulo"><a href="#por" role="tab" data-toggle="tab">POR</a></li>
					  <li role="titulo"><a href="#fra" role="tab" data-toggle="tab">FRA</a></li>
					</ul>
					<div class="tab-content">
						<!--  FORMULARIO INGLES -->
						<div role="tabpanel" class="tab-pane micontrol" id="ing">
							<?php if (isset($datos['PaisIdioma'][2]['id'])) { ?>
								<input type="hidden" name="data[PaisIdioma][2][id]" value="<?php echo $datos['PaisIdioma'][2]['id']; ?>" />
							<?php } ?>
						    <input type="hidden" name="data[PaisIdioma][2][paises_id]" value="<?php echo $paises_id; ?>" />
						    <input type="hidden" name="data[PaisIdioma][2][idiomas_id]" value="2" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Denominación</label>
							  	</div>
							  	<div class="col-sm-6">
			                        <input type="text" id="pais_ing" class="form-control" name="data[PaisIdioma][2][pais]" size="100" maxlength="100" value="<?php echo (isset($datos['PaisIdioma'][2]['pais']))?$datos['PaisIdioma'][2]['pais']:''; ?>" />
			                        <label id="ing" class="error" style="display:none;">Complete el pais en ingles</label>
			                    </div>
							</div>
						</div>
						<!--  FORMULARIO PORTUGUES -->
						<div role="tabpanel" class="tab-pane micontrol" id="por">
							<?php if (isset($datos['PaisIdioma'][3]['id'])) { ?>
								<input type="hidden" name="data[PaisIdioma][3][id]" value="<?php echo $datos['PaisIdioma'][3]['id']; ?>" />
							<?php } ?>
						    <input type="hidden" name="data[PaisIdioma][3][paises_id]" value="<?php echo $paises_id; ?>" />
						    <input type="hidden" name="data[PaisIdioma][3][idiomas_id]" value="3" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Denominación</label>
							  	</div>
							  	<div class="col-sm-6">
			                        <input type="text" id="pais_por" class="form-control" name="data[PaisIdioma][3][pais]" size="100" maxlength="100" value="<?php echo (isset($datos['PaisIdioma'][3]['pais']))?$datos['PaisIdioma'][3]['pais']:''; ?>" />
			                        <label id="por" class="error" style="display:none;">Complete el pais en portuges</label>
			                    </div>
							</div>
						</div>
						<!--  FORMULARIO FRANCES -->
						<div role="tabpanel" class="tab-pane micontrol" id="fra">
							<?php if (isset($datos['PaisIdioma'][4]['id'])) { ?>
								<input type="hidden" name="data[PaisIdioma][4][id]" value="<?php echo $datos['PaisIdioma'][4]['id']; ?>" />
							<?php } ?>
						    <input type="hidden" name="data[PaisIdioma][4][paises_id]" value="<?php echo $paises_id; ?>" />
						    <input type="hidden" name="data[PaisIdioma][4][idiomas_id]" value="4" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label class="control-label">Denominación</label>
							  	</div>
							  	<div class="col-sm-6">
			                        <input type="text" id="pais_fra" class="form-control" name="data[PaisIdioma][4][pais]" size="100" maxlength="100" value="<?php echo (isset($datos['PaisIdioma'][4]['pais']))?$datos['PaisIdioma'][4]['pais']:''; ?>" />
			                        <label id="fra" class="error" style="display:none;">Complete el pais en frances</label>
			                    </div>
							</div>
						</div>
					</div>
				</div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-3">
                        <button type="button" class="btn btn-success"  onclick="guardar()">Guardar</button>
                    </div>
                    <div class="col-sm-offset-2 col-sm-3">
                        <button type="button" class="btn btn-danger"  onclick="borrar(<?php echo $paises_id; ?>)">Borrar</button>
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
    	$('#myTab a:first').tab('show');
    	/*$('#myTab a').click(function() {
        	//alert("ghkj");
        	$('.nav-tabs > li > a').css('color','#2fa4e7');
    		$('.nav-tabs > li.active > a').css('color','#555555');
    		$(this).tab('show');
    	});*/
    	$('#EditForm').validate({
    		 //excluded: [':disabled'],
        	/*rules: {               
        		'data[PaisIdioma][2][pais]': {
                    minlength: 1,
                    required: true
                },
                'data[PaisIdioma][3][pais]': {
                    minlength: 1,
                    required: true
                },
                'data[PaisIdioma][4][pais]': {
                    minlength: 1,
                    required: true
                }
            },
            messages: {               
                'data[PaisIdioma][2][pais]': {
                    required: 'Complete el pais en ingles'
                },
                'data[PaisIdioma][3][pais]': {
                    required: 'Complete el pais en portugues'
                },
                'data[PaisIdioma][4][pais]': {
                    required: 'Complete el pais en frances'
                }
            },*/
            highlight: function(element) {
         	   var id_attr = "#" + $( element ).attr("id");
                $(id_attr).closest('.form-group').removeClass('has-success').addClass('has-error');
                $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');
            },
            unhighlight: function(element) {
         	    var id_attr = "#" + $( element ).attr("id");
                $(id_attr).closest('.form-group').removeClass('has-error').addClass('has-success');
                $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');
            },
            success: function(element) {
            	$('.nav-tabs > li.active > a').removeClass('has-error');
                $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');
                if ($( element ).parent().find('label').html()=='') $( element ).parent().find('label').remove();
                
            }
           
        });
    }
    
    function guardar()
    { 
    	var error = 0;
        if( $('#EditForm').valid())
        {	
        	var validator = $( "#EditForm" ).validate();
        	if ($('#pais_ing').val() == '') {
        		validator.showErrors({
                    "data[PaisIdioma][2][pais]": "Por favor complete pais en ingles"
                });
        		$('#myTab a[href="#ing"]').tab('show');
        		$('.nav-tabs > li.active > a').addClass('has-error');
        		$('#pais_ing').focus();
        		return false;
        	}
        	if ($('#pais_por').val() == '') {
        		validator.showErrors({
                    "data[PaisIdioma][3][pais]": "Por favor complete pais en portuges"
                });
        		$('#myTab a[href="#por"]').tab('show');
        		$('.nav-tabs > li.active > a').addClass('has-error'); 
        		$('#pais_por').focus();
        		return false;
        	}
        	if ($('#pais_fra').val() == '') {
        		validator.showErrors({
                    "data[PaisIdioma][4][pais]": "Por favor complete pais en francés"
                });
        		$('#myTab a[href="#fra"]').tab('show');
        		$('.nav-tabs > li.active > a').addClass('has-error');
        		$('#pais_fra').focus();
        		return false;
        	}

			$('#EditForm').submit();
        }
    }
    function borrar(id)
    {
    	bootbox.dialog({
			message: "¿Está seguro que desea borrar estos idiomas?",
	 		title: "Aviso",
	 		buttons: {
		    	success: {
			    	label: "Si",
			    	className: "btn-success",
			    	callback: function() {
			    		document.location.href = "/paises_idioma/borrar/"+id;
	 		      	}  	
		    	},
		    	danger: {
		    		label: "No",
		    	 	className: "btn-danger"
		    	}
   	 	    }
		});

        /*bootbox.confirm("¿Está seguro que desea borrar estos idiomas?", function(result) {
                if (result)
                {
                    document.location.href = "/paises_idioma/borrar/"+id;
                }
            }); */
    }
</script>
