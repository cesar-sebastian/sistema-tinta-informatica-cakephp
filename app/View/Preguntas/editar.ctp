<!-- <h2 class="sub-header"><small>Editar Pregunta / Respuesta # <?php echo $this->data['Pregunta']['id']; ?></small>-->
<h2 class="sub-header">Preguntas / Respuestas
    <!-- <a class="btn btn-primary navbar-right" href="/preguntas/<?php echo ($this->Session->Check('pag_'.$this->request->param('controller')))?'index/page:'.$this->Session->read('pag_'.$this->request->param('controller')):'index';?>">
  	Volver a la lista
  	</a>-->
</h2>
<div class="row-fluid" style="margin-top: 30px;">
    <div class="col-md-12">
        <fieldset>
            <form accept-charset="utf-8" class="form-horizontal" id="EditForm" role="form" action="/preguntas/editar/<?php echo $this->data['Pregunta']['id']; ?>" method="POST">
                <div class="form-group" id="titulo" style="display:none;">
					<div class="col-sm-2">
                    	<label class="col-sm-2 control-label">Titulo</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" required="required" id="titulo" class="form-control" name="data[Pregunta][titulo]" size="30" value="<?php echo $this->data['Pregunta']['titulo']; ?>" />
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
									<input id="item_esp_#index#_id" name="data[ItemPregunta][1][#index#][id]" type="hidden" />
									<input id="item_esp_#index#_idioma" name="data[ItemPregunta][1][#index#][idiomas_id]" type="hidden" value="1" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="item_esp_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php 
										$this->DiticHtml->wysiwyg(
													'data[ItemPregunta][1][#index#][item]','','wysiwyg_#index#_item_esp',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','forecolor','linea','titulo','html'),
														'requerido'=>'Por favor complete el item A'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemA_esp">Por favor complete el item A</label>-->
									</div>
									<div class="col-sm-2">
										<!-- <a id="item_esp_remove_current">-->
										<a onclick="borraritem(this)" class="#index#">
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
									<input id="item_ing_#index#_id" name="data[ItemPregunta][2][#index#][id]" type="hidden" />
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
														'botones'=>array('negrita','italica','izquierda','centro','derecha','forecolor','linea','titulo','html'),
														'requerido'=>'Por favor complete el item A'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemA_ing">Por favor complete el item A</label>-->
									</div>
									<div class="col-sm-2">
										<a onclick="borraritem(this)" class="#index#">
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
									<input id="item_por_#index#_id" name="data[ItemPregunta][3][#index#][id]" type="hidden" />
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
														'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','titulo','html'),
														'requerido'=>'Por favor complete el item A'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemA_por">Por favor complete el item A</label>-->
									</div>
									<div class="col-sm-2">
										<a onclick="borraritem(this)" class="#index#">
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
									<input id="item_fra_#index#_id" name="data[ItemPregunta][4][#index#][id]" type="hidden" />
									<input id="item_fra_#index#_idioma" name="data[ItemPregunta][4][#index#][idiomas_id]" type="hidden" value="4" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="item_fra_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemPregunta][4][#index#][item]', '', 'wysiwyg_#index#_item_fra',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','titulo','html'),
														'requerido'=>'Por favor complete el item A'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemA_fra">Por favor complete el item A</label>-->
									</div>
									<div class="col-sm-2">
										<a onclick="borraritem(this)" class="#index#">
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
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-success"  onclick="guardar()">Guardar</button>
                    </div>
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

	function borraritem(item) {
		var index = $(item).attr('class');
		var num_item = parseInt(index) + 1;
		bootbox.confirm("¿Esta seguro que desea eliminar la Pregunta/Respuesta ("+num_item+")?. Esto aplicará a todos los idiomas", function(result) {
         	if (result)
            {
         		//var index = $(item).attr('class');
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
    			
        		/*if ($(item).attr('id')=='item_esp_remove_current') {
        			item_ing.removeForm(index);
        			item_por.removeForm(index);
        			item_fra.removeForm(index);
        		}
        		if ($(item).attr('id')=='item_eng_remove_current') {
        			item_esp.removeForm(index);
        			item_por.removeForm(index);
        			item_fra.removeForm(index);
        		}
        		if ($(item).attr('id')=='item_por_remove_current') {
        			item_esp.removeForm(index);
        			item_ing.removeForm(index);
        			item_fra.removeForm(index);
        		}
        		if ($(item).attr('id')=='item_fra_remove_current') {
        			item_ing.removeForm(index);
        			item_por.removeForm(index);
        			item_esp.removeForm(index);
        		}*/
            }
    	 });
    }
    
    function inicialize()
    {
        var i=0;
    	//console.log($('#wysiwyg_#index#_itemA_esp'));
    	$('#myTab a:first').tab('show');
		
        $('#EditForm').validate({
           
           rules: {
        	   'data[Pregunta][titulo]': {
                   required: true
               }               /*,
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
        	  $('.nav-tabs > li.active > a').removeClass('has-error');
              $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');  
              $('label.error').hide();
          }
           
        });
     	// ESPAÑOL
        <?php
  			  $numfila=0;
  			  $num_preg=0;
  			  $array_item = null;
  			  foreach ($itemPregunta['ItemPregunta'][1] as $item){
  					if (isset($item['id'])) { 
						$array_item .= "{'item_esp_#index#_id':'".$item['id']."'},";  						
						$numfila++;
						$num_preg++;
  					}
  			  }
  		?>
    	item_esp = $('#item_esp').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        /*removeCurrentConfirmation: true,
	        removeCurrentConfirmationMsg: '¿Esta seguro que desea eliminar la Pregunta/Respuesta?',*/
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo $numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_item; ?>],
	        /*afterAdd: function(source, newForm) {
		        i = i+1; 
				console.log(i);
				$('#item_ing').sheepIt().addForm();
	        }*/
	    });

    	// INGLES
    	<?php
    		$numfila=0;
    		$array_item = null;
    		foreach ($itemPregunta['ItemPregunta'][2] as $item){
    			if (isset($item['id'])) {
					$array_item .= "{'item_ing_#index#_id':'".$item['id']."'},"; 
  					$numfila++;
    			}
    		}
    	?>
	    
	    item_ing = $('#item_ing').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        removeCurrentConfirmationMsg: '¿Esta seguro que desea eliminar la Pregunta/Respuesta?',
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo ($numfila<$num_preg)?$num_preg:$numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_item; ?>],
	    });
    	// PORTUGUES
    	<?php
        	$numfila=0;
        	$array_item = null;
        	foreach ($itemPregunta['ItemPregunta'][3] as $item){
        		if (isset($item['id'])) {
					$array_item .= "{'item_por_#index#_id':'".$item['id']."'},"; 
      				$numfila++;
        		}
        	}
        ?>
        item_por = $('#item_por').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        removeCurrentConfirmationMsg: '¿Esta seguro que desea eliminar la Pregunta/Respuesta?',
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo ($numfila<$num_preg)?$num_preg:$numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_item; ?>],
	    });
    	// FRANCES
    	<?php
        	$numfila=0;
        	$array_item = null;
        	foreach ($itemPregunta['ItemPregunta'][4] as $item){
        		if (isset($item['id'])) {
					$array_item .= "{'item_fra_#index#_id':'".$item['id']."'},"; 
      				$numfila++;
        		}
        	}
        ?>
        item_fra = $('#item_fra').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        removeCurrentConfirmationMsg: '¿Esta seguro que desea eliminar la Pregunta/Respuesta?',
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo ($numfila<$num_preg)?$num_preg:$numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_item; ?>],
	    });
    	// ALEMAN
    	<?php
            /*$numfila=0;
            $array_item = null;
            foreach ($itemPregunta['ItemPregunta'][5] as $item){
            	if (isset($item['id'])) {
					$array_item .= "{'item_ale_#index#_id':'".$item['id']."'},"; 
          			$numfila++;
            	}
            }*/
        ?>
        /*item_ale = $('#item_ale').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo ($numfila<$num_preg)?$num_preg:$numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_item; ?>],
	    });*/
	    
		//ESPAÑOL
        <?php
			$numfila = 0; 
	    	foreach ($itemPregunta['ItemPregunta'][1] as $item){
				if (isset($item['preg_resp'])) { ?>
					valor = <?php echo '"'.str_replace('"','\"',preg_replace('/[\r\n]+/', "", $item['preg_resp'])).'"'; ?>;
					$('textarea#wysiwyg_<?php echo $numfila;?>_item_esp').html(valor);
					<?php 
					$numfila++;
				}
			}
        ?>
        //INGLES
        <?php
        	$numfila = 0; 
            foreach ($itemPregunta['ItemPregunta'][2] as $item){
        		if (isset($item['preg_resp'])) { ?>
        			valor = <?php echo '"'.str_replace('"','\"',preg_replace('/[\r\n]+/', "", $item['preg_resp'])).'"'; ?>;
        			$('textarea#wysiwyg_<?php echo $numfila;?>_item_ing').html(valor);
        			<?php 
        			$numfila++;
        		}
        	}
        ?>
      	//PORTUGES
        <?php
        	$numfila = 0; 
            foreach ($itemPregunta['ItemPregunta'][3] as $item){
        		if (isset($item['preg_resp'])) { ?>
        			valor = <?php echo '"'.str_replace('"','\"',preg_replace('/[\r\n]+/', "", $item['preg_resp'])).'"'; ?>;
    				$('textarea#wysiwyg_<?php echo $numfila;?>_item_por').html(valor);
        			<?php 
        			$numfila++;
        		}
        	}  
        ?>
      	//FRANCES
        <?php
        	$numfila = 0; 
            foreach ($itemPregunta['ItemPregunta'][4] as $item){
        		if (isset($item['preg_resp'])) { ?>
        			valor = <?php echo '"'.str_replace('"','\"',preg_replace('/[\r\n]+/', "", $item['preg_resp'])).'"'; ?>;
    				$('textarea#wysiwyg_<?php echo $numfila;?>_item_fra').html(valor);
        			<?php 
        			$numfila++;
        		}
        	}
        ?>
      	//ALEMAN
        <?php
        	/*$numfila = 0; 
            foreach ($itemPregunta['ItemPregunta'][5] as $item){
        		if (isset($item['preg_resp'])) { ?>
        			$('textarea#wysiwyg_<?php echo $numfila;?>_item_ale').html('<?php echo $item['preg_resp']; ?>');
        			<?php 
        			$numfila++;
        		}
        	} */
        ?>
    }

    function agregarPreg() {
        /*var aux = $('#myTab li.active').attr('href');
        alert(aux);*/
        item_esp.addForm();
        //$('#myTab a[href="#ing"]').tab('show');
        item_ing.addForm();
        //$('#myTab a[href="#por"]').tab('show');
        item_por.addForm();
        //$('#myTab a[href="#fra"]').tab('show');
        item_fra.addForm();
        //$('#myTab a[href="#ale"]').tab('show');
        //item_ale.addForm();
        //$('#myTab a[href="'+aux+'"]').tab('show');
         
    }
    
    function guardar()
    { 
    	var error = 0;
        if( $('#EditForm').valid())
        {	
        	$('.micontrol iframe').each( function() {
	            var myItem = $(this).parent().parent().parent().parent().find('div').attr('class');
	        	if ($(this).contents().find('body').html() == '' ||  $(this).contents().find('body').html() == '<br>') {
	            	var idioma = myItem.split("_").pop();
	            	//if (idioma == 'esp') {*/						
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
	       	 	bootbox.confirm("¿ Está seguro que desea guardar esta pregunta?", function(result) {
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
        bootbox.confirm("¿ Está seguro que desea borrar esta pregunta?", function(result) {
                if (result)
                {
                    document.location.href = "/preguntas/borrar/"+id;
                }
            }); 
    }
</script>
