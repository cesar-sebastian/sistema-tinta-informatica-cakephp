<!-- <h2 class="sub-header"><small>Nueva Pregunta / Respuesta</small>-->
<h2>Preguntas / Respuestas
    <!-- <a class="btn btn-primary navbar-right" href="/preguntas/<?php echo ($this->Session->Check('pag_'.$this->request->param('controller')))?'index/page:'.$this->Session->read('pag_'.$this->request->param('controller')):'index';?>">
  	Volver a la lista
  	</a>-->
</h2>
<div class="row-fluid" style="margin-top: 30px;">
    <div class="col-md-12">
        <fieldset>
            <form class="form-horizontal" id="AddForm" role="form" action="/preguntas/agregar/" method="POST">
            	<input type="hidden" id="forma" class="form-control" name="data[opcion]" />
                <div class="form-group" id="titulo" style="display:none;">
					<div class="col-sm-2">
                    	<label class="col-sm-2 control-label">Titulo</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" id="titulo" class="form-control" name="data[Pregunta][titulo]" size="30" value="Preguntas Frecuentes" />
                        <span class="glyphicon form-control-feedback" id="titulo1"></span>
                    </div>
                </div>
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
						<div role="tabpanel" class="tab-pane active" id="esp">
						    							
							<!--  sheepit - comienzo -->
							<div id="item_esp" class="micontrol">
								<div class="form-group col-sm-12">
									<label class="control-label">Pregunta / Respuesta</label>
								</div>
								<div id="item_esp_template" class="col-sm-12">
									<input id="item_esp_#index#_idioma" name="data[ItemPregunta][1][#index#][idiomas_id]" type="hidden" value="1" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="item_esp_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemPregunta][1][#index#][item]', '', 'wysiwyg_#index#_item_esp',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','forecolor','linea','h4','html'),
														'requerido'=>'Por favor complete pregunta / respuesta'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemA_esp">Por favor complete el item A</label>-->
									</div>
									<div class="col-sm-2">
										<a id="item_esp_remove_current" href="borraritem(#index#)">
											<img class="delete" src="/img/cross.png" width="16" height="16"	border="0">
										</a>
									</div>
									<div style="clear:both;"><br /></div>
								</div>
								
								<div class="col-sm-12">
									<div id="item_esp_noforms_template">No hay pregunta agregada</div>
									<div id="item_esp_controls" style="float:right;">
										<!-- <div id="item_esp_add">
											<a class="btn btn-primary"><span>Agregar pregunta</span></a>
										</div>-->
										<div>
											<a class="btn btn-primary" href="javascript:agregarPreg();"><span>Agregar pregunta</span></a>
										</div>
									</div>
								</div>
							</div>
							<!--  sheepit - fin -->
							
						</div>
						<!--  FORMULARIO INGLES -->
						<div role="tabpanel" class="tab-pane" id="ing">						
							<!--  sheepit - comienzo -->
							<div id="item_ing" class="micontrol">
								<div class="form-group col-sm-12">
									<label class="control-label">Pregunta / Respuesta</label>
								</div>
								<div id="item_ing_template" class="col-sm-12">
									<input id="item_ing_#index#_idioma" name="data[ItemPregunta][2][#index#][idiomas_id]" type="hidden" value="2" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="item_ing_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemPregunta][2][#index#][item]', '', 'wysiwyg_#index#_item_ing',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','forecolor','linea','h4','html'),
														'requerido'=>'Por favor complete el item A'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_item_ing">Por favor complete el item A</label>-->
									</div>
									<div class="col-sm-2">
										<a id="item_ing_remove_current">
											<img class="delete" src="/img/cross.png" width="16" height="16"	border="0">
										</a>
									</div>
									<div style="clear:both;"><br /></div>
								</div>
								<div class="col-sm-12">
									<div id="item_ing_noforms_template">No hay pregunta agregada</div>
									<div id="item_ing_controls" style="float:right;">
										<!-- <div id="item_ing_add">
											<a class="btn btn-primary"><span>Agregar pregunta</span></a>
										</div>-->
										<div>
											<a class="btn btn-primary" href="javascript:agregarPreg();"><span>Agregar pregunta</span></a>
										</div>
									</div>
								</div>
							</div>
							<!--  sheepit - fin -->
						</div>
						<!--  FORMULARIO PORTUGUES -->
						<div role="tabpanel" class="tab-pane" id="por">						
							<!--  sheepit - comienzo -->
							<div id="item_por" class="micontrol">
								<div class="form-group col-sm-12">
									<label class="control-label">Pregunta / Respuesta</label>
								</div>
								<div id="item_por_template" class="col-sm-12">
									<input id="item_por_#index#_idioma" name="data[ItemPregunta][3][#index#][idiomas_id]" type="hidden" value="3" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="item_por_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemPregunta][3][#index#][item]', '', 'wysiwyg_#index#_item_por',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','html'),
														'requerido'=>'Por favor complete el item A'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemA_por">Por favor complete el item A</label>-->
									</div>
									<div class="col-sm-2">
										<a id="item_por_remove_current">
											<img class="delete" src="/img/cross.png" width="16" height="16"	border="0">
										</a>
									</div>
									<div style="clear:both;"><br /></div>
								</div>
								<div class="col-sm-12">
									<div id="item_por_noforms_template">No hay pregunta agregada</div>
									<div id="item_por_controls" style="float:right;">
										<!-- <div id="item_por_add">
											<a class="btn btn-primary"><span>Agregar pregunta</span></a>
										</div>-->
										<div>
											<a class="btn btn-primary" href="javascript:agregarPreg();"><span>Agregar pregunta</span></a>
										</div>
									</div>
								</div>
							</div>
							<!--  sheepit - fin -->
						</div>
						<!--  FORMULARIO FRANCES -->
						<div role="tabpanel" class="tab-pane" id="fra">							
							<!--  sheepit - comienzo -->
							<div id="item_fra" class="micontrol">
								<div class="form-group col-sm-12">
									<label class="control-label">Pregunta / Respuesta</label>
								</div>
								<div id="item_fra_template" class="col-sm-12">
									<input id="item_fra_#index#_idioma" name="data[ItemPregunta][4][#index#][idiomas_id]" type="hidden" value="4" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="item_fra_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemPregunta][4][#index#][item]', '', 'wysiwyg_#index#_itemA_fra',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','html'),
														'requerido'=>'Por favor complete el item A'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemA_fra">Por favor complete el item A</label>-->
									</div>
									<div class="col-sm-2">
										<a id="item_fra_remove_current">
											<img class="delete" src="/img/cross.png" width="16" height="16"	border="0">
										</a>
									</div>
									<div style="clear:both;"><br /></div>
								</div>
								<div class="col-sm-12">
									<div id="item_fra_noforms_template">No hay pregunta agregada</div>
									<div id="item_fra_controls" style="float:right;">
										<!-- <div id="item_fra_add">
											<a class="btn btn-primary"><span>Agregar pregunta</span></a>
										</div>-->
										<div>
											<a class="btn btn-primary" href="javascript:agregarPreg();"><span>Agregar pregunta</span></a>
										</div>
									</div>
								</div>
							</div>
							<!--  sheepit - fin -->
						</div>
					</div>
				</div>
                <div class="col-sm-offset-2 col-sm-8">
                	<button type="button" class="btn btn-success"  onclick="guardar()">Guardar y Salir</button>
                    <!-- &nbsp;&nbsp;
                    <button type="button" class="btn btn-success"  onclick="guardar(1)">Guardar y Continuar</button>-->
                </div>              
            </form>
        </fieldset>
    </div>
    
</div>
<script type="text/javascript">
	var item_esp = {};
	var item_ing = {};
	var item_por = {};
	var item_fra = {};
	
	$(document).ready(function() {
        inicialize();
    });

    function borraritem(index) {
    	item_esp.removeForm(index);
        item_ing.removeForm(index);
        item_por.removeForm(index);
        item_fra.removeForm(index);

        var i = 1;
        $('#item_esp #item_esp_label').each(function() {
            $(this).html(i);
            i++;
        });
        var i = 1;
        $('#item_ing #item_ing_label').each(function() {
            $(this).html(i);
            i++;
        });
        var i = 1;
        $('#item_por #item_por_label').each(function() {
            $(this).html(i);
            i++;
        });
        var i = 1;
        $('#item_fra #item_fra_label').each(function() {
            $(this).html(i);
            i++;
        });
    }
    function inicialize()
    {
    	//console.log($('#wysiwyg_#index#_itemA_esp'));
    	$('#myTab a:first').tab('show');
		
        $('#AddForm').validate({
           
           rules: {               
               'data[Pregunta][titulo]': {
                   required: true
               }/*,
               'data[CasoMultidioma][1][titulo]': {
            	   minlength: 2,
                   required: true
               },
               'data[CasoMultidioma][2][titulo]': {
            	   minlength: 2,
                   required: true
               },
               'data[CasoMultidioma][3][titulo]': {
            	   minlength: 2,
                   required: true
               },
               'data[CasoMultidioma][4][titulo]': {
            	   minlength: 2,
                   required: true
               },
               'data[CasoMultidioma][5][titulo]': {
            	   minlength: 2,
                   required: true
               }*/
           },
           messages: {               
               'data[Pregunta][titulo]': {
                   required: 'Por favor complete titulo'
               }
           },
           /*highlight: function(element) {
        	    var id_attr = "#" + $( element ).attr("id") + "1";
               $(id_attr).closest('.form-group').removeClass('has-success').addClass('has-error');
               $(id_attr+' label.error').removeClass('glyphicon-ok').addClass('glyphicon-remove');
               //if ($('label.error').val()=='') $('label.error').remove();
                        
           },
           unhighlight: function(element) {
        	    var id_attr = "#" + $( element ).attr("id") + "1";
               $(id_attr).closest('.form-group').removeClass('has-error').addClass('has-success');
               $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');
               //if ($('label.error').val()=='') $('label.error').remove(); 
               $('div#'+$( element ).attr("id")+' label.error').remove();
        	  
           },
           success: function(element) {
               $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');  
               //$('label.error').remove();
               //if ($('label.error').val()=='') $('label.error').remove();
           }*/
           highlight: function(element) {
        	   var id_attr = "#" + $( element ).attr("id") + "1";
               $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
               $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');         
           },
           unhighlight: function(element) {
        	   var id_attr = "#" + $( element ).attr("id") + "1";
               $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
               $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');      
               $('label.error').hide();
        	  
           },
           success: function(element) {
               $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');  
               $('label.error').hide();
           }
           
        });
     // ESPAÑOL
    	item_esp = $('#item_esp').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: 1,
	        indexFormat:'#index#',
	    });
		
	    // INGLES
	    item_ing = $('#item_ing').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: 1,
	        indexFormat:'#index#',
	    });

    	// PORTUGUES
	    item_por = $('#item_por').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: 1,
	        indexFormat:'#index#',
	    });

    	// FRANCES
	    item_fra = $('#item_fra').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: 1,
	        indexFormat:'#index#',
	    });

    	// ALEMAN
	    /*item_ale = $('#item_ale').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: 1,
	        indexFormat:'#index#',
	    });*/
        
    }

    function agregarPreg() {
        item_esp.addForm();
        item_ing.addForm();
        item_por.addForm();
        item_fra.addForm();
        //item_ale.addForm();    
    }
    
    function guardar()
    { 
    	var error = 0;
    	if( $('#AddForm').valid()) {
			//$('input[name="data[opcion]"]').val(opcion);
			$('.micontrol iframe').each( function() {
	            var myItem = $(this).parent().parent().parent().parent().find('div').attr('class');
	        	if ($(this).contents().find('body').html() == '' ||  $(this).contents().find('body').html() == '<br>') {
	            	var idioma = myItem.split("_").pop();
	            	//if (idioma == 'esp') {*/						
		                var hash = "#"+idioma;   
		                $('#myTab a[href="' + hash + '"]').tab('show');
		                $('.nav-tabs > li.active > a').css('color','red');
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