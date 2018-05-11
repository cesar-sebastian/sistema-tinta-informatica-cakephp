<div style="width:900px; margin:15px auto 0;text-align:right;color:#3492C1;font-size:16px;padding-right:10px;clear:both;">
	<?php 
	echo $this->Html->link('ESP', array('language'=>'esp'))." | ";
	echo $this->Html->link('ENG', array('language'=>'eng'))." | ";
	echo $this->Html->link('POR', array('language'=>'por'))." | ";
	echo $this->Html->link('FRA', array('language'=>'fra'));
	//echo $this->Html->link('ALE', array('language'=>'ale'));
	?>
</div>
<div class="cuadro-home">
	<!-- <div class="img-izq">
		<img src="/img/logo.png"  width="400" border="0" />
	</div>	
	<div class="img-der">
		<span style="font-size:40px; font-family:Arial; font-weight: bold; color:#3290BF;">
			<? //echo __("GESTION_VISA")?>
		</span>
		<br />
		<span style="font-size:25px; font-family:Arial; font-weight: bold; color:#3290BF;">
			<? //echo __("ESTUDIO_CARRERA")?>
		</span>
	</div>-->
	<div>
		<img src="/img/header-<?php echo $this->Session->read('Config.language');?>.jpg" width="898" border="0" />
	</div>	
	<div class="linea"></div>
	<!-- <div class="cuadro_caso">CASO&nbsp;&nbsp;<span id="num_caso"></span></div>-->
	<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false" style="float:rigth;">	
		<div class="carousel-inner">
	    	<div class="item active" id="pagina1">
				<div class="contenido">
					<div class="numero">1</div>
					<div class="texto-der">
						<div style="padding:0 10px;">
						<? echo __("SELECCIONAR")?>
						&nbsp;&nbsp;
						<select name="pais" id="pais" style="font-size:12px;">
							<option value="-1"></option>
							<?php 
							$aux='';
							foreach($paises as $pais) {
								if ($this->Session->read('Config.language')=='esp') { 
									if($aux != $pais['Pais']['pais']) {
								?>
									<option value="<?php print $pais['Pais']['id'];?>"><?php print $pais['Pais']['pais'];?></option>
								<?php
									} 
								} else { ?>
									<option value="<?php print $pais['PaisIdioma']['paises_id'];?>"><?php print $pais['PaisIdioma']['pais'];?></option>
								<?php } 
								$aux=$pais['Pais']['pais'];
								?>
							<?php } ?>
						</select>
						</div>
					</div>
				</div>
				<div style="clear:both;"></div>
				<div style="padding:15px 0;background:url('/img/mapa.png') no-repeat;height:500px;"></div>
			</div>
			<div class="item" id="pagina2">	
				<div class="contenido">
					<div class="numero">2</div>
					<div class="texto-der">
						<div style="padding:0 10px;">
						<h3>
						<? echo __("ESTAS_ARGENTINA")?>
						</h3>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div style="padding:50px 0;margin:0 auto;width:49%;float:left;">
						<!-- <a id="boton_no"><img src="/img/boton_no.png" border="0" /></a>-->
						<a id="boton_no"><img src="/img/no-<?php echo $this->Session->read('Config.language');?>.png" border="0" /></a>
					</div>
					<div style="padding:50px 0;margin:0 auto;width:49%;float:right;">
						<!-- <a id="boton_si"><img src="/img/boton_si.png" border="0" /></a>-->
						<a id="boton_si"><img src="/img/si-<?php echo $this->Session->read('Config.language');?>.png" border="0" /></a>
					</div>
				</div>
				<div style="margin:20px 0;"><a class="btn btn-primary" href="#" onClick="volver(0)"><? echo __("VOLVER")?></a></div>
			</div>
			<div class="item" id="pagina3">	
				<div class="contenido">
					<span style="font-size:20px; font-weight:bold;color:#2A779D;">></span>
					<span style="font-size:20px; font-weight:bold;">
						<? echo __("TEXTO_ARGENTINA")?>
					</span>
					<br /><br />
					<div style="clear:both;"></div>
					<div style="border:1px dashed #999; padding:20px;height:auto;display:inline-block;width:95%;">
						<div style="float:left;width:49%;">
							<img src="/img/logo_migraciones.png" border="0" />
						</div>
						<div style="float:right;width:49%;">
							<div style="text-align:left;">
								<p>
									<img src="/img/icono_web.png" border="0" />&nbsp;&nbsp;&nbsp;
									<a style="font-weight:bold;font-size:16px;">www.migraciones.gov.ar</a>
								</p>
								<p>
									<img src="/img/icono_email.png" border="0" />&nbsp;&nbsp;&nbsp;
									<a style="font-weight:bold;font-size:16px;">info@migraciones.gov.ar</a>
								</p>
								<p>
									<img src="/img/icono_tel.png" border="0" />&nbsp;&nbsp;&nbsp;
									<a style="font-weight:bold;font-size:16px;">+54 (11) 4317-0234</a>
								</p>
							</div>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div style="margin:20px 0;"><a class="btn btn-primary" href="#" onClick="volver(1)"><? echo __("VOLVER")?></a></div>
				</div>
			</div>
			<div class="item" id="pagina4">	
				<div class="contenido">
					<div style="font-size:18px; font-weight:bold;color:#2A779D;text-align:left;">
						<? echo __("SELECCIONASTE")?>&nbsp;&nbsp;
						<span id="seleccion"></span>
					</div>
					<br />
					<div class="panel-group" id="accordion">
  						<div class="panel panel-default" id="panel1">
    						<div class="panel-heading color_tramite">
								<h4 class="panel-title" data-panel="1">
									<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
										<img src="/img/icono_tramite.png" border="0">&nbsp;&nbsp;&nbsp;<? echo __("TRAMITE")?>
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="cuadro_tramite_titulo">
										<h4>> <? echo __("FUERA_ARGENTINA")?></h4>
										<div class="cuadro_tramite_cuerpo">
											<p><b><? echo __("SUBTITULO_TRAMITE");?></b></p>
											<span><? echo __("CONSULADO_DISPONIBLE");?>&nbsp;&nbsp;&nbsp;<br />
											<select name="pais_tramite" id="pais_tramite" style="font-size:12px;">
												<option value="-1"><? echo __("SEL_PAIS");?></option>
												<!--<?php 
													$aux='';
													foreach($paises as $pais) {
														if ($this->Session->read('Config.language')=='esp') { 
															if($aux != $pais['Pais']['pais']) {
														?>
															<option value="<?php print $pais['Pais']['id'];?>"><?php print $pais['Pais']['pais'];?></option>
														<?php
															} 
														} else { ?>
															<option value="<?php print $pais['PaisIdioma']['paises_id'];?>"><?php print $pais['PaisIdioma']['pais'];?></option>
														<?php } 
														$aux=$pais['Pais']['pais'];
														?>
													<?php } ?>-->
											</select>&nbsp;&nbsp;&nbsp;
											<select name="ciudad_tramite" id="ciudad_tramite" style="font-size:12px;">
												<option value="-1"><? echo __("SEL_CIUDAD");?></option>
											</select>
											<br /><br />
											<? echo __("SELECCIONAR_TRAMITE");?>
											<br /><br /> 
											</span>
											<div class="cuadro_datos_tramite"></div>
										</div>
										<br />
										<h4>> <? echo __("DENTRO_ARGENTINA")?></h4>
										<div class="cuadro_tramite_cuerpo">
											<p><b><? echo __("SEDES_MIGRACIONES");?></b></p>
											<div class="cuadro_datos_argentina">
												<p><b>Dirección Nacional de Migraciones</b></p>
												<p><img src="/img/icono_home2.png" border="0" />&nbsp;&nbsp;&nbsp;
												Av. Antártida Argentina 1355 - C1104ACA - Ciudad de Buenos Aires</p>
												<p><img src="/img/icono_web2.png" border="0" />&nbsp;&nbsp;&nbsp;
												<a href="http://www.migraciones.gov.ar" target="blank">http://www.migraciones.gov.ar</a></p>
												<p><img src="/img/icono_email2.png" border="0" />&nbsp;&nbsp;&nbsp;
												<a href="mailto:info@migraciones.gov.ar">info@migraciones.gov.ar</a></p>
												<p><img src="/img/icono_tel2.png" border="0" />&nbsp;&nbsp;&nbsp;
												+54 (11) 4317-0234</p>
											</div>
										</div>
									</div>
									<br />
									<div class="cuadro_tramite_titulo" style="text-align:left;">
										<img src="/img/estrella.png" border="0" />&nbsp;&nbsp;<? echo __("CONCURRIR_PERSONALMENTE");?>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default" id="panel2">
							<input name="caso" id="caso" type="hidden" />
    						<div class="panel-heading color_documentos">
    							<h4 class="panel-title" data-panel="2">
									<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" >
										<img src="/img/icono_documentos.png" border="0">&nbsp;&nbsp;&nbsp;<? echo __("DOCUMENTOS")?>
									</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">
								<div class="panel-body" id="cuadro_documentos">
									<div class="cuadro_documentos_titulo">
										<h4>> <? echo __("PRESENTAR_CONSULADO")?></h4>
										<div class="cuadro_documentos_cuerpo itemsA">
										</div>
									</div>
									<br />
									<div class="cuadro_documentos_titulo">
										<h4>> <? echo __("PRESENTAR_UNIVERSIDADES")?></h4>
										<div class="cuadro_documentos_cuerpo itemsB">
										</div>
									</div>
									<div class="cuadro_leyenda"></div> 
								</div>
							</div>
						</div>
						<div class="panel panel-default" id="panel3">
    						<div class="panel-heading color_faq">
    							<h4 class="panel-title" data-panel="3">
									<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
										<img src="/img/icono_faq.png" border="0">&nbsp;&nbsp;&nbsp;<? echo __("PREGUNTAS_FRECUENTES")?>
									</a>
								</h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="cuadro_preguntas">
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default" id="panel4">
    						<div class="panel-heading color_contacto">
    							<h4 class="panel-title" data-panel="4">
									<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
										<img src="/img/icono_contacto.png" border="0">&nbsp;&nbsp;&nbsp;<? echo __("DATOS_CONTACTO")?>
									</a>
								</h4>
							</div>
							<div id="collapseFour" class="panel-collapse collapse">
								<div class="panel-body">
									<div class="cuadro_datos">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div style="margin:20px 0;"><a class="btn btn-primary" href="#" onClick="volver(1)"><? echo __("VOLVER")?></a></div>
					<br /><br />
					<div class="cuadro-pie">
						<div class="col-md-6" style="border-right:1px solid #3492C1;">
							<? echo __("OFERTA")?>
						</div>
						<div class="col-md-6" style="border-left:1px solid #3492C1;">
							<? echo __("VIVIR")?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="pie"></div>
</div>
<div class="cargando"><img src="/img/cargando.gif" border="0"></div>
<!-- <div class="cuadro_leyenda_pie"></div>-->
<script type="text/javascript">
    $(function () {
    	$(".cargando").hide();
        $(".pie").css('background-image','url(<?php echo "/img/logos-".$this->Session->read('Config.language');?>.jpg)'); 
    	//$(".cuadro_caso").hide();
    	$('#pais').removeAttr('selected').find('option:first').attr('selected', 'selected');
        $('#pais').change(function() {
            var valor=$(this).val();
            //if (valor==187) {
                $('#myCarousel').carousel(1);
            //}
            $('#seleccion').html($('#pais option:selected').text());
			$('#pais_tramite').val($('#pais option:selected').val());
			$(".cuadro_datos_tramite").html('');
			cargar_combo($('#pais option:selected').val());
        });
        $('#boton_no').click(function() {
        	//$("a.accordion-toggle").unbind('click');
        	//$("a.accordion-toggle").attr("disabled",true);
        	$("a.accordion-toggle").each(function(){
			    $(this).data("href", $(this).attr("href")).removeAttr("href");
			});
        	$("div#pagina4 *").prop('disabled',true);
        	$("div#pagina4").css({ opacity: 0.5 });
        	$(".cargando").show();
        	$(".cuadro_datos_tramite").html('');
        	//$(".cuadro_leyenda_pie").html('');
        	$('.itemsA').html('');
        	$('.itemsB').html('');
        	$('.conv_haya').html('');
        	$('.cuadro_leyenda').html('');
        	$('.cuadro_preguntas').html('');
        	$('.cuadro_datos').html('');
        	$('#cuadro_documentos').show(); 
        	$('#myCarousel').carousel(3);
        	$.ajax({
			     type: "POST",
			     url: "/inicio/cargar_numero/",
			     data: { pais : $('#pais').val() },
			     success: function(data) {
				      valor = $.parseJSON(data);
				      if (valor!=null) {
			          	//$("#num_caso").html(valor);
			          	$("#caso").val(valor);
			          	//$(".cuadro_caso").show();
				      }
			     }
			});
        	$.ajax({
			     type: "POST",
			     dataType: 'json',
			     url: "/inicio/cargar_paises_ciudades/",
			     data: { pais : $('#pais').val() },
			     success: function(data) {
    			     if (data.paises) {
						$('#pais_tramite').html(data.paises);
    			     } else {
    			    	 $("#pais_tramite").html('');
    			     }
    			     if (data.ciudades) {
    			    	 $('#ciudad_tramite').html(data.ciudades);
    			     } else {
    			    	 $("#ciudad_tramite").html('');
    			     }
			     }
			});
			
        	$('#pais_tramite').change(function() {
    	        $.ajax({
    			     type: "POST",
    			     url: "/inicio/cargar_ciudades/",
    			     data: { pais : $(this).val() },
    			     success: function(data) {
        			     if (data) {
    			         	$("#ciudad_tramite").html($.parseJSON(data));
        			     } else {
    			        	$("#ciudad_tramite").html('');
        			     }
        			     
    			     }
    			});
            });
        	$('#ciudad_tramite').change(function() {
	        	$.ajax({
				     type: "POST",
				     url: "/inicio/cargar_tramite/",
				     data: { pais : $('#pais_tramite').val(), ciudad: $(this).val() },
				     success: function(data) {
						if (data) { 
				          $(".cuadro_datos_tramite").html($.parseJSON(data));
						} else {
							$(".cuadro_datos_tramite").html('');
						}
				     }
				});
        	});
        	setTimeout(function() {	
            	$.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '/inicio/cargar_caso/',
                    data: { pais : $('#pais').val() },
            	    success: function(data) {
            	    	if (data.itemsA) {
                	    	$('.itemsA').html(data.itemsA);
            	    	} else {
            	    		$('.itemsA').html('');
            	    	}
            	    	if (data.itemsB) {
            	    		$('.itemsB').html(data.itemsB);
            	    	} else {
            	    		$('.itemsB').html('');
            	    	}
            	    	
            	    	if (data.conv_haya) {
            	    		$('.conv_haya').html(data.conv_haya);
            	    		//$('.conv_haya').show();
            	    	} else {
            	    		$('.conv_haya').html('');
            	    		//$('.conv_haya').hide();
            	    	}
            	    	if (!data.itemsA && !data.itemsB) {
            	    		$('#cuadro_documentos').hide();
            	    	}
            	    	if (data.leyenda) {
            	    		$('.cuadro_leyenda').html(data.leyenda);
            	    		$('.cuadro_leyenda').show();
            	    		if (data.color) {
        						$('.cuadro_leyenda').css('color',data.color);
        						$('.cuadro_leyenda').css('border-color',data.color);
                	    	}
            	    	} else {
            	    		$('.cuadro_leyenda').html('');
            	    		$('.cuadro_leyenda').hide();
            	    	}
            	    },
            	    complete:function(r){
            	    	$(".cargando").hide();
            	    	$("div#pagina4 *").prop('disabled',false);
            	    	//$("a.accordion-toggle").bind('click');
            	    	//$("a.accordion-toggle").attr("disabled",false);
            	    	$('a.accordion-toggle').each(function(){
						    $(this).attr("href", $(this).data("href"));
						});
            	    	$("div#pagina4").css({ opacity: 1.0 });
            	    },
           	     	error: function(xhr, status, error) {
    					alert(xhr.responseText+"/r"+status+" - "+error);
              	 	}
            	});
            	/*$.ajax({
    			    type: "POST",
    			    url: "/home/cargar_pie/",
    			    success: function(data) {
    					if (data) {
    						datos = $.parseJSON(data);
    			          	$(".cuadro_leyenda_pie").html(datos);
    				    } else {
    				    	$(".cuadro_leyenda_pie").html('');
    				    }
    			     }
    			});*/
            	$.ajax({
                    type: 'POST',
                    //dataType: 'json',
                    url: '/inicio/cargar_preguntas/',
            	    success: function(data) {
            	    	if (data) {
                	    	//alert(data);
                	    	$('.cuadro_preguntas').html($.parseJSON(data));
            	    	} else {
            	    		$('.cuadro_preguntas').html('');
            	    	}
            	    },
           	     	error: function(xhr, status, error) {
    					alert(xhr.responseText+"/r"+status+" - "+error);
              	 	}
            	});
            	
            	$.ajax({
                    type: 'POST',
                    //dataType: 'json',
                    url: '/inicio/cargar_datos/',
            	    success: function(data) {
            	    	if (data) {
                	    	//alert(data);
                	    	$('.cuadro_datos').html($.parseJSON(data));
            	    	} else {
            	    		$('.cuadro_datos').html('');
            	    	}
            	    },
           	     	error: function(xhr, status, error) {
    					alert(xhr.responseText+"/r"+status+" - "+error);
              	 	}
            	});
            	
        	}, 3000);
        	
        });
        $('#boton_si').click(function() { 
        	$('#myCarousel').carousel(2);
        	$(".cuadro_caso").hide();
        });

        /*$("#accordion h4").click(function () {
        	if ($(this).attr('data-panel')=='1') {
        	}	
    	});*/

        /*$(document).on('show','#accordion', function (e) {
            $(e.target).prev('.panel-heading').addClass('panel-opened');
        });
       
        $(document).on('hide','#accordion', function (e) {
           $(this).find('.panel-heading').not($(e.target)).removeClass('panel-opened');
        });*/
        /*$('.panel-collapse').each(function(){
            if ($(this).hasClass('in')) {
                $(this).collapse('toggle');
            }
        });*/
       
        
    });
	function cargar_combo(pais) {
		$.ajax({
			 type: "POST",
			 url: "/inicio/cargar_ciudades/",
			 data: { pais : pais },
			 success: function(data) {
				  $("#ciudad_tramite").html($.parseJSON(data));
			 }
		});
	}
    function volver(item) {
    	$(".cuadro_caso").hide();
    	$('#myCarousel').carousel(item);
    	$(".cuadro_leyenda_pie").html('');
    }
</script>
