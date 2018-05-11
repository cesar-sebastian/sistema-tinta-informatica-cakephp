<?php //debug($this->data['CasoMultidioma'][1]);?>
<h2 class="sub-header"><small>Editar Caso # <?php echo $this->data['Caso']['cod_num']; ?></small>
    <a class="btn btn-primary navbar-right" href="/casos/<?php echo ($this->Session->Check('pag_'.$this->request->param('controller')))?'index/page:'.$this->Session->read('pag_'.$this->request->param('controller')):'index';?>">
  	Volver a la lista
  	</a>
	<!-- <a class="btn btn-default navbar-right" href="/casos/">Volver a la lista</a>
	<a class="btn btn-default navbar-right" href="#" onclick="history.go(-1);">Volver a la lista</a>-->
</h2>
<div class="row-fluid" style="margin-top: 30px;">
    <div class="col-md-12">
        <fieldset>
            <form accept-charset="utf-8" class="form-horizontal" id="EditForm" role="form" action="/casos/editar/<?php echo $this->data['Caso']['id']; ?>" method="POST">
                <input type="hidden" id="completo" class="form-control" name="data[Caso][completo]" size="2" value="0" />
                <input type="hidden" id="opcion" class="form-control" name="opcion"  />
                <div class="form-group">
                	<div class="col-sm-8"></div>
					<div class="col-sm-2">
                    	<label class="col-sm-2 control-label">Código Númerico</label>
                    </div>
                    <div class="col-sm-2">
                        <input type="hidden" id="codnum" class="form-control" name="data[Caso][cod_num]" size="2" maxlength="2" value="<?php echo $this->data['Caso']['cod_num']; ?>" />
                        <input type="text" class="form-control" name="codnum" size="2" maxlength="2" value="<?php echo $this->data['Caso']['cod_num']; ?>  " disabled />
                        <span class="glyphicon form-control-feedback" id="codnum1"></span>
                    </div>
                </div>
                <div class="col-sm-12">
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
							<input type="hidden" name="data[CasoMultidioma][1][id]" value="<?php echo $this->data['CasoMultidioma'][0]['id']; ?>" />
						    <input type="hidden" name="data[CasoMultidioma][1][idiomas_id]" value="1" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Titulo del Caso</label>
							  		&nbsp;&nbsp;
							  		<input type="text" name="data[CasoMultidioma][1][titulo]" id="titulo_esp" size="50" value="<?php echo $this->data['CasoMultidioma'][0]['titulo']; ?>" />
								</div>
							</div>								
							<!--  sheepit - comienzo -->
							
							<div id="itemA_esp" class="micontrol">
								<div class="form-group col-sm-12">
									<label class="control-label">Documentación Necesaria</label>
								</div>
								<div class="form-group col-sm-12">
									<label class="control-label">A)- Para presentar en el consulado</label>
								</div>
								<div id="itemA_esp_template" class="col-sm-12">
									<input id="itemA_esp_#index#_id" name="data[ItemMultidiomaA][1][#index#][id]" type="hidden" />
									<input id="itemA_esp_#index#_idioma" name="data[ItemMultidiomaA][1][#index#][idiomas_id]" type="hidden" value="1" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemA_esp_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php 
										$this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaA][1][#index#][item]','','wysiwyg_#index#_itemA_esp',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','forecolor','linea','h4','signo','html'),
														'requerido'=>'Por favor complete el item A',
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemA_esp">Por favor complete el item A</label>-->
									</div>
									<div class="col-sm-2">
										<!-- <a id="itemA_esp_remove_current">-->
										<a onclick="borraritemA(this)" class="#index#">
											<img class="delete" src="/img/cross.png" width="16" height="16"	border="0">
										</a>
									</div>
									<div style="clear:both;"><br /></div>
								</div>
								
								<div class="col-sm-12">
									<div id="itemA_esp_noforms_template">No hay item (A) agregado</div>
									<div id="itemA_esp_controls" style="float:right;">
										<!-- <div id="itemA_esp_add">-->
										<div>
											<a class="btn btn-primary" href="javascript:agregaritemA();"><span>Agregar más item</span></a>
										</div>
									</div>
								</div>
							</div>
							<!--  sheepit - fin -->
							<!--  sheepit - comienzo -->
							<div id="itemB_esp" class="micontrol">
								<div class="form-group col-sm-12">
									<label class="control-label">B)- Para presentar en las universidades y en el Ministerio de Educación en la Argentina</label>
								</div>
								<div id="itemB_esp_template" class="col-sm-12">
									<input id="itemB_esp_#index#_id" name="data[ItemMultidiomaB][1][#index#][id]" type="hidden" />
									<input id="itemB_esp_#index#_idioma" name="data[ItemMultidiomaB][1][#index#][idiomas_id]" type="hidden" value="1" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemB_esp_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaB][1][#index#][item]','', 'wysiwyg_#index#_itemB_esp',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','signo','c_haya','html'),
														'requerido'=>'Por favor complete el item B'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemB_esp">Por favor complete el item B</label>-->
									</div>
									<div class="col-sm-2">
										<a onclick="borraritemB(this)" class="#index#">
											<img class="delete" src="/img/cross.png" width="16" height="16"	border="0">
										</a>
									</div>
									<div style="clear:both;"><br /></div>
								</div>
								<div class="col-sm-12">
									<div id="itemB_esp_noforms_template">No hay item (B) agregado</div>
									<div id="itemB_esp_controls" style="float:right;">
										<div>
											<a class="btn btn-primary" href="javascript:agregaritemB();"><span>Agregar más item</span> </a>
										</div>
									</div>
								</div>
							</div>
							<!--  sheepit - fin -->
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Leyenda para el caso</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[CasoMultidioma][1][leyenda]', $this->data['CasoMultidioma'][0]['leyenda'], 'wysiwyg_leyenda_esp',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','html')
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Leyenda de pie para el caso</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[CasoMultidioma][1][leyenda_pie]', $this->data['CasoMultidioma'][0]['leyenda_pie'], 'wysiwyg_leyendapie_esp',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','texto','html')
												)
											);
									?>
								</div>
							</div>	
						</div>
						<!--  FORMULARIO INGLES -->
						<div role="tabpanel" class="tab-pane" id="ing">
							<input type="hidden" name="data[CasoMultidioma][2][id]" value="<?php echo $this->data['CasoMultidioma'][1]['id']; ?>" />
							<input type="hidden" name="data[CasoMultidioma][2][idiomas_id]" value="2" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Titulo del Caso</label>
							  		&nbsp;&nbsp;
							  		<input type="text" name="data[CasoMultidioma][2][titulo]" id="titulo_ing" size="50" value="<?php echo $this->data['CasoMultidioma'][1]['titulo']; ?>" />
								</div>
							</div>								
							<!--  sheepit - comienzo -->
							<div id="itemA_ing" class="micontrol">
								<div class="form-group col-sm-12">
									<label class="control-label">Documentación Necesaria</label>
								</div>
								<div class="form-group col-sm-12">
									<label class="control-label">A)- Para presentar en el consulado</label>
								</div>
								<div id="itemA_ing_template" class="col-sm-12">
									<input id="itemA_ing_#index#_id" name="data[ItemMultidiomaA][2][#index#][id]" type="hidden" />
									<input id="itemA_ing_#index#_idioma" name="data[ItemMultidiomaA][2][#index#][idiomas_id]" type="hidden" value="2" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemA_ing_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaA][2][#index#][item]','', 'wysiwyg_#index#_itemA_ing',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','forecolor','linea','h4','signo','html'),
														'requerido'=>'Por favor complete el item A'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemA_ing">Por favor complete el item A</label>-->
									</div>
									<div class="col-sm-2">
										<a onclick="borraritemA(this)" class="#index#">
											<img class="delete" src="/img/cross.png" width="16" height="16"	border="0">
										</a>
									</div>
									<div style="clear:both;"><br /></div>
								</div>
								<div class="col-sm-12">
									<div id="itemA_ing_noforms_template">No hay item (A) agregado</div>
									<div id="itemA_ing_controls" style="float:right;">
										<div>
											<a class="btn btn-primary" href="javascript:agregaritemA();"><span>Agregar más item</span></a>
										</div>
									</div>
								</div>
							</div>
							<!--  sheepit - fin -->
							<!--  sheepit - comienzo -->
							<div id="itemB_ing" class="micontrol">
								<div class="form-group col-sm-12">
									<label class="control-label">B)- Para presentar en las universidades y en el Ministerio de Educación en la Argentina</label>
								</div>
								<div id="itemB_ing_template" class="col-sm-12">
									<input id="itemB_ing_#index#_id" name="data[ItemMultidiomaB][2][#index#][id]" type="hidden" />
									<input id="itemB_ing_#index#_idioma" name="data[ItemMultidiomaB][2][#index#][idiomas_id]" type="hidden" value="2" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemB_ing_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaB][2][#index#][item]','', 'wysiwyg_#index#_itemB_ing',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','signo','c_haya','html'),
														'requerido'=>'Por favor complete el item B'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemB_ing">Por favor complete el item B</label>-->
									</div>
									<div class="col-sm-2">
										<a onclick="borraritemB(this)" class="#index#">
											<img class="delete" src="/img/cross.png" width="16" height="16"	border="0">
										</a>
									</div>
									<div style="clear:both;"><br /></div>
								</div>
								<div class="col-sm-12">
									<div id="itemB_ing_noforms_template">No hay item (B) agregado</div>
									<div id="itemB_ing_controls" style="float:right;">
										<div>
											<a class="btn btn-primary" href="javascript:agregaritemB();"><span>Agregar más item</span> </a>
										</div>
									</div>
								</div>
							</div>
							<!--  sheepit - fin -->
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Leyenda para el caso</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[CasoMultidioma][2][leyenda]', $this->data['CasoMultidioma'][1]['leyenda'], 'wysiwyg_leyenda_ing',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','html')
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Leyenda de pie para el caso</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[CasoMultidioma][2][leyenda_pie]', $this->data['CasoMultidioma'][1]['leyenda_pie'], 'wysiwyg_leyendapie_ing',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','texto','html')
												)
											);
									?>
								</div>
							</div>
						</div>
						<!--  FORMULARIO PORTUGUES -->
						<div role="tabpanel" class="tab-pane" id="por">
							<input type="hidden" name="data[CasoMultidioma][3][id]" value="<?php echo $this->data['CasoMultidioma'][2]['id']; ?>" />
							<input type="hidden" name="data[CasoMultidioma][3][idiomas_id]" value="3" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Titulo del Caso</label>
							  		&nbsp;&nbsp;
							  		<input type="text" name="data[CasoMultidioma][3][titulo]" id="titulo_por" size="50" value="<?php echo $this->data['CasoMultidioma'][2]['titulo']; ?>" />
								</div>
							</div>								
							<!--  sheepit - comienzo -->
							<div id="itemA_por" class="micontrol">
								<div class="form-group col-sm-12">
									<label class="control-label">Documentación Necesaria</label>
								</div>
								<div class="form-group col-sm-12">
									<label class="control-label">A)- Para presentar en el consulado</label>
								</div>
								<div id="itemA_por_template" class="col-sm-12">
									<input id="itemA_por_#index#_id" name="data[ItemMultidiomaA][3][#index#][id]" type="hidden" />
									<input id="itemA_por_#index#_idioma" name="data[ItemMultidiomaA][3][#index#][idiomas_id]" type="hidden" value="3" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemA_por_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaA][3][#index#][item]','', 'wysiwyg_#index#_itemA_por',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','signo','html'),
														'requerido'=>'Por favor complete el item A'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemA_por">Por favor complete el item A</label>-->
									</div>
									<div class="col-sm-2">
										<a onclick="borraritemA(this)" class="#index#">
											<img class="delete" src="/img/cross.png" width="16" height="16"	border="0">
										</a>
									</div>
									<div style="clear:both;"><br /></div>
								</div>
								<div class="col-sm-12">
									<div id="itemA_por_noforms_template">No hay item (A) agregado</div>
									<div id="itemA_por_controls" style="float:right;">
										<div>
											<a class="btn btn-primary" href="javascript:agregaritemA();"><span>Agregar más item</span></a>
										</div>
									</div>
								</div>
							</div>
							<!--  sheepit - fin -->
							<!--  sheepit - comienzo -->
							<div id="itemB_por" class="micontrol">
								<div class="form-group col-sm-12">
									<label class="control-label">B)- Para presentar en las universidades y en el Ministerio de Educación en la Argentina</label>
								</div>
								<div id="itemB_por_template" class="col-sm-12">
									<input id="itemB_por_#index#_id" name="data[ItemMultidiomaB][3][#index#][id]" type="hidden" />
									<input id="itemB_por_#index#_idioma" name="data[ItemMultidiomaB][3][#index#][idiomas_id]" type="hidden" value="3" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemB_por_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaB][3][#index#][item]','', 'wysiwyg_#index#_itemB_por',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','signo','c_haya','html'),
														'requerido'=>'Por favor complete el item B'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemB_por">Por favor complete el item B</label>-->
									</div>
									<div class="col-sm-2">
										<a onclick="borraritemB(this)" class="#index#">
											<img class="delete" src="/img/cross.png" width="16" height="16"	border="0">
										</a>
									</div>
									<div style="clear:both;"><br /></div>
								</div>
								<div class="col-sm-12">
									<div id="itemB_por_noforms_template">No hay item (B) agregado</div>
									<div id="itemB_por_controls" style="float:right;">
										<div>
											<a class="btn btn-primary"  href="javascript:agregaritemB();"><span>Agregar más item</span> </a>
										</div>
									</div>
								</div>
							</div>
							<!--  sheepit - fin -->
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Leyenda para el caso</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[CasoMultidioma][3][leyenda]', $this->data['CasoMultidioma'][2]['leyenda'], 'wysiwyg_leyenda_por',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','html')
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Leyenda de pie para el caso</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[CasoMultidioma][3][leyenda_pie]', $this->data['CasoMultidioma'][2]['leyenda_pie'], 'wysiwyg_leyendapie_por',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','texto','html')
												)
											);
									?>
								</div>
							</div>
						</div>
						<!--  FORMULARIO FRANCES -->
						<div role="tabpanel" class="tab-pane" id="fra">
							<input type="hidden" name="data[CasoMultidioma][4][id]" value="<?php echo $this->data['CasoMultidioma'][3]['id']; ?>" />
							<input type="hidden" name="data[CasoMultidioma][4][idiomas_id]" value="4" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Titulo del Caso</label>
							  		&nbsp;&nbsp;
							  		<input type="text" name="data[CasoMultidioma][4][titulo]" id="titulo_fra" size="50" value="<?php echo $this->data['CasoMultidioma'][3]['titulo']; ?>" />
								</div>
							</div>								
							<!--  sheepit - comienzo -->
							<div id="itemA_fra" class="micontrol">
								<div class="form-group col-sm-12">
									<label class="control-label">Documentación Necesaria</label>
								</div>
								<div class="form-group col-sm-12">
									<label class="control-label">A)- Para presentar en el consulado</label>
								</div>
								<div id="itemA_fra_template" class="col-sm-12">
									<input id="itemA_fra_#index#_id" name="data[ItemMultidiomaA][4][#index#][id]" type="hidden" />
									<input id="itemA_fra_#index#_idioma" name="data[ItemMultidiomaA][4][#index#][idiomas_id]" type="hidden" value="4" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemA_fra_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaA][4][#index#][item]','', 'wysiwyg_#index#_itemA_fra',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','signo','html'),
														'requerido'=>'Por favor complete el item A'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemA_fra">Por favor complete el item A</label>-->
									</div>
									<div class="col-sm-2">
										<a onclick="borraritemA(this)" class="#index#">
											<img class="delete" src="/img/cross.png" width="16" height="16"	border="0">
										</a>
									</div>
									<div style="clear:both;"><br /></div>
								</div>
								<div class="col-sm-12">
									<div id="itemA_fra_noforms_template">No hay item (A) agregado</div>
									<div id="itemA_fra_controls" style="float:right;">
										<div>
											<a class="btn btn-primary" href="javascript:agregaritemA();"><span>Agregar más item</span></a>
										</div>
									</div>
								</div>
							</div>
							<!--  sheepit - fin -->
							<!--  sheepit - comienzo -->
							<div id="itemB_fra" class="micontrol">
								<div class="form-group col-sm-12">
									<label class="control-label">B)- Para presentar en las universidades y en el Ministerio de Educación en la Argentina</label>
								</div>
								<div id="itemB_fra_template" class="col-sm-12">
									<input id="itemB_fra_#index#_id" name="data[ItemMultidiomaB][4][#index#][id]" type="hidden" />
									<input id="itemB_fra_#index#_idioma" name="data[ItemMultidiomaB][4][#index#][idiomas_id]" type="hidden" value="4" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemB_fra_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaB][4][#index#][item]', '', 'wysiwyg_#index#_itemB_fra',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','signo','c_haya','html'),
														'requerido'=>'Por favor complete el item B'
													)
												);
										?>
										<!-- <label class="error" style="display:none;" id="wysiwyg_#index#_itemB_fra">Por favor complete el item B</label>-->
									</div>
									<div class="col-sm-2">
										<a onclick="borraritemB(this)" class="#index#">
											<img class="delete" src="/img/cross.png" width="16" height="16"	border="0">
										</a>
									</div>
									<div style="clear:both;"><br /></div>
								</div>
								<div class="col-sm-12">
									<div id="itemB_fra_noforms_template">No hay item (B) agregado</div>
									<div id="itemB_fra_controls" style="float:right;">
										<div>
											<a class="btn btn-primary" href="javascript:agregaritemB();"><span>Agregar más item</span> </a>
										</div>
									</div>
								</div>
							</div>
							<!--  sheepit - fin -->
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Leyenda para el caso</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[CasoMultidioma][4][leyenda]', $this->data['CasoMultidioma'][3]['leyenda'], 'wysiwyg_leyenda_fra',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','html')
												)
											);
									?>
								</div>
							</div>
							<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Leyenda de pie para el caso</label>
							  	</div>
							  	<div class="col-sm-12">
							  		<?php $this->DiticHtml->wysiwyg(
												'data[CasoMultidioma][4][leyenda_pie]', $this->data['CasoMultidioma'][3]['leyenda_pie'], 'wysiwyg_leyendapie_fra',
												array(
													'altura'=>'100px',
													'ancho'=>'98%',
													'rows'=>4,
													'botones'=>array('negrita','italica','izquierda','centro','derecha','linea','h4','texto','html')
												)
											);
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
                <div class="form-group">
                    <label for="nombre" class="col-sm-2 control-label">Color</label>
                    <div class="col-sm-10">
                    	<input name="data[Caso][color]" type="hidden" value="<?php echo $this->data['Caso']['color']; ?>" />                        
                        <select name="color" class="color" id="color">
						  <option value="green" <?php if ($this->data['Caso']['color'] == 'green') echo "selected"; ?>>Verde</option>
						  <option value="blue" <?php if ($this->data['Caso']['color'] == 'blue') echo "selected"; ?>>Azul</option>
						  <option value="yellow" <?php if ($this->data['Caso']['color'] == 'yellow') echo "selected"; ?>>Amarillo</option>
						  <option value="orange" <?php if ($this->data['Caso']['color'] == 'orange') echo "selected"; ?>>Narajna</option>
						  <option value="red" <?php if ($this->data['Caso']['color'] == 'red') echo "selected"; ?>>Rojo</option>
						  <option value="purple" <?php if ($this->data['Caso']['color'] == 'purple') echo "selected"; ?>>Violeta</option>
						</select>
						<span class="glyphicon form-control-feedback" id="color1"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="button" class="btn btn-success"  onclick="guardar(0)">Guardar y Salir</button>
                        &nbsp;&nbsp;
                        <button type="button" class="btn btn-success"  onclick="guardar(1)">Guardar y Continuar</button>
                    </div>
                </div>            
            </form>
        </fieldset>
    </div>
</div>
<script type="text/javascript">
	var item_a_esp = {};
	var item_b_esp = {};
	var item_a_ing = {};
	var item_b_ing = {};
	var item_a_por = {};
	var item_b_por = {};
	var item_a_fra = {};
	var item_b_fra = {};
	$(document).ready(function() {
		//$('#codnum').attr('disabled','disabled');
        inicialize();
    });

	function borraritemA(item) {
		bootbox.confirm("¿Esta seguro que desea eliminar este item del caso?", function(result) {
         	if (result)
            {
         		var index = $(item).attr('class');
         		item_a_esp.removeForm(index);
         		item_a_ing.removeForm(index);
    			item_a_por.removeForm(index);
    			item_a_fra.removeForm(index);
            }
    	 });
    }

	function borraritemB(item) {
		bootbox.confirm("¿Esta seguro que desea eliminar este item del caso?", function(result) {
         	if (result)
            {
         		var index = $(item).attr('class');
         		item_b_esp.removeForm(index);
         		item_b_ing.removeForm(index);
    			item_b_por.removeForm(index);
    			item_b_fra.removeForm(index);
            }
    	 });
    }
    
    function inicialize()
    {
    	//console.log($('#wysiwyg_#index#_itemA_esp'));
    	$('#myTab a:first').tab('show');
    	$('select[name="color"]').simplecolorpicker({picker: true, theme: 'glyphicons'}).on('change', function() {
    		$('input[name="data[Caso][color]"]').val($('select[name="color"]').val());
  		    //alert($('select[name="data[Caso][cod_num]"]').val());
    	});
        $('#EditForm').validate({
           
           rules: {               
               'data[Caso][cod_num]': {
                   minlength: 1,
                   required: true,
                   number: true
               },
               'data[Caso][color]': {
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
               'data[Caso][cod_num]': {
                   required: 'Ingrese número de código'
               },
               'data[Caso][color]': {
                   required: 'Seleccione un color'
               }
           },
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
               //$('.nav-tabs > li > a').css('color','#2fa4e7');
               //$('.nav-tabs > li.active > a').css('color','#555555');
        	  
           },
           success: function(element) {
        	   $('.nav-tabs > li.active > a').removeClass('has-error');
               $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');  
               $('label.error').hide();
               //$('.nav-tabs > li > a').css('color','#2fa4e7'); 
               //$('.nav-tabs > li.active > a').css('color','#555555');
           }
           
        });
     	// ESPAÑOL
        <?php
  			  $numfila=0;
  			  $num_pregA=0;
  			  $array_itemA = null;
  			  if (isset($itemMultidiomaA['ItemMultidiomaA'][1])) {
	  			  foreach ($itemMultidiomaA['ItemMultidiomaA'][1] as $itemA){
	  					if (isset($itemA['item'])) { 
							$array_itemA .= "{'itemA_esp_#index#_id':'".$itemA['id']."'},";
							//$array_itemA .= "{'itemA_esp_#index#_id':'".$itemA['id']."','itemA_esp_#index#_item':'".$itemA['item']."'},";
							$num_pregA++;
							$numfila++;
	  					}
	  			  }
	  		  } else {
				$numfila=1;
				$array_itemA .= "{'itemA_esp_#index#_id':''}";
			  }
  		?>
  		item_a_esp = $('#itemA_esp').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo $numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_itemA; ?>],
	        afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item A"}});                 	
            }
	    });
    	//$('#itemA_esp_#index#_item').htmlarea('updateHtmlArea',$('#itemA_esp_#index#_item').val());
    	<?php
    		$numfila=0;
    		$num_pregB=0;
    		$array_itemB=null;
    		if (isset($itemMultidiomaB['ItemMultidiomaB'][1])) {
	    		foreach ($itemMultidiomaB['ItemMultidiomaB'][1] as $itemB){
	    			if (isset($itemB['item'])) {
	    				$array_itemB .= "{'itemB_esp_#index#_id':'".$itemB['id']."'},";
	    				$num_pregB++;
	    				$numfila++;
	    			}
	    		}
	    	} else {
				$numfila=1;
				$array_itemB .= "{'itemB_esp_#index#_id':''}";
			}
    	?>
    	item_b_esp = $('#itemB_esp').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo $numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_itemB; ?>],
	        afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item B"}});           	
            }
	    });
    	// INGLES
    	<?php
    		$numfila=0;
    		$array_itemA = null;
    		if (isset($itemMultidiomaA['ItemMultidiomaA'][2])) {
	    		foreach ($itemMultidiomaA['ItemMultidiomaA'][2] as $itemA){
	    			if (isset($itemA['item'])) {
						$array_itemA .= "{'itemA_ing_#index#_id':'".$itemA['id']."'},"; 
	  					$numfila++;
	    			}
	    		}
    		} else {
    			$numfila=1;
    			$array_itemA .= "{'itemA_ing_#index#_id':''}";
    		}
	    ?>
	    
	    item_a_ing = $('#itemA_ing').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo ($numfila<$num_pregA)?$num_pregA:$numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_itemA; ?>],
	        /*afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item A"}});                 	
            }*/
	    });
	    <?php
    		$numfila=0;
    		$array_itemB = null;
    		if (isset($itemMultidiomaB['ItemMultidiomaB'][2])) {
	    		foreach ($itemMultidiomaB['ItemMultidiomaB'][2] as $itemB){
	    			if (isset($itemB['item'])) {
						$array_itemB .= "{'itemB_ing_#index#_id':'".$itemB['id']."'},"; 
	  					$numfila++;
	    			}
	    		}
    		} else {
    			$numfila=1;
    			$array_itemB .= "{'itemB_ing_#index#_id':''}";
    		}
	    ?>
	    item_b_ing = $('#itemB_ing').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo ($numfila<$num_pregB)?$num_pregB:$numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_itemB; ?>],
	        /*afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item B"}});               	
            }*/
	    });
    	// PORTUGUES
    	<?php
        	$numfila=0;
        	$array_itemA = null;
        	if (isset($itemMultidiomaA['ItemMultidiomaA'][3])) {
	        	foreach ($itemMultidiomaA['ItemMultidiomaA'][3] as $itemA){
	        		if (isset($itemA['item'])) {
						$array_itemA .= "{'itemA_por_#index#_id':'".$itemA['id']."'},"; 
	      				$numfila++;
	        		}
	        	}
        	} else {
        		$numfila=1;
        		$array_itemA .= "{'itemA_por_#index#_id':''}";
        	}
        ?>
        item_a_por = $('#itemA_por').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo ($numfila<$num_pregA)?$num_pregA:$numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_itemA; ?>],
	        /*afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item A"}});               	
            }*/
	    });
	    <?php
    		$numfila=0;
    		$array_itemB = null;
    		if (isset($itemMultidiomaB['ItemMultidiomaB'][3])) {
	    		foreach ($itemMultidiomaB['ItemMultidiomaB'][3] as $itemB){
	    			if (isset($itemB['item'])) {
						$array_itemB .= "{'itemB_por_#index#_id':'".$itemB['id']."'},"; 
	  					$numfila++;
	    			}
	    		}
    		} else {
    			$numfila=1;
    			$array_itemB .= "{'itemB_por_#index#_id':''}";
    		}
    	?>
    	item_b_por = $('#itemB_por').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo ($numfila<$num_pregB)?$num_pregB:$numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_itemB; ?>],
	        /*afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item B"}});                 	
            }*/
	    });
    	// FRANCES
    	<?php
        	$numfila=0;
        	$array_itemA = null;
        	if (isset($itemMultidiomaA['ItemMultidiomaA'][4])) {
	        	foreach ($itemMultidiomaA['ItemMultidiomaA'][4] as $itemA){
	        		if (isset($itemA['item'])) {
						$array_itemA .= "{'itemA_fra_#index#_id':'".$itemA['id']."'},"; 
	      				$numfila++;
	        		}
	        	}
        	} else {
        		$numfila=1;
        		$array_itemA .= "{'itemA_fra_#index#_id':''}";
        	}
        ?>
        item_a_fra = $('#itemA_fra').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo ($numfila<$num_pregA)?$num_pregA:$numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_itemA; ?>],
	        /*afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item A"}});               	
            }*/
	    });
	    <?php
        	$numfila=0;
        	$array_itemB = null;
        	if (isset($itemMultidiomaB['ItemMultidiomaB'][4])) {
	        	foreach ($itemMultidiomaB['ItemMultidiomaB'][4] as $itemB){
	        		if (isset($itemB['item'])) {
						$array_itemB .= "{'itemB_fra_#index#_id':'".$itemB['id']."'},"; 
	      				$numfila++;
	        		}
	        	}
	        } else {
        		$numfila=1;
        		$array_itemB .= "{'itemB_fra_#index#_id':''}";
        	}
        ?>
        item_b_fra = $('#itemB_fra').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo ($numfila<$num_pregB)?$num_pregB:$numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_itemB; ?>],
	        /*afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item B"}});                 	
            }*/
	    });
    	// ALEMAN
    	<?php
            /*$numfila=0;
            $array_itemA = null;
            if (isset($itemMultidiomaA['ItemMultidiomaA'][5])) {
	            foreach ($itemMultidiomaA['ItemMultidiomaA'][5] as $itemA){
	            	if (isset($itemA['item'])) {
						$array_itemA .= "{'itemA_ale_#index#_id':'".$itemA['id']."'},"; 
	          			$numfila++;
	            	}
	            }
            } else {
            	$numfila=1;
            	$array_itemA .= "{'itemA_ale_#index#_id':''}";
            }*/  
        ?>
	    /*$('#itemA_ale').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo $numfila;?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_itemA; ?>],
	       
	    });*/
	    <?php
        	/*$numfila=0;
        	$array_itemB = null;
        	if (isset($itemMultidiomaB['ItemMultidiomaB'][5])) {
	        	foreach ($itemMultidiomaB['ItemMultidiomaB'][5] as $itemB){
	        		if (isset($itemB['item'])) {
						$array_itemB .= "{'itemB_ale_#index#_id':'".$itemB['id']."'},"; 
	      				$numfila++;
	        		}
	        	}
        	} else {
        		$numfila=1;
        		$array_itemB .= "{'itemB_ale_#index#_id':''}";
        	}*/
        ?>
    	/*$('#itemB_ale').sheepIt({
	        separator: '',
	        allowRemoveLast: true,
	        allowRemoveCurrent: true,
	        allowRemoveAll: true,
	        allowAdd: true,
	        allowAddN: true,
	        maxFormsCount: 10,
	        minFormsCount: 0,
	        iniFormsCount: <?php echo $numfila; ?>,
	        indexFormat:'#index#',
	        data: [<?php echo $array_itemB; ?>],
	    }); */
	    
		//ESPAÑOL
        <?php
			$numfila = 0;
			if (isset($itemMultidiomaA['ItemMultidiomaA'][1])) {
		    	foreach ($itemMultidiomaA['ItemMultidiomaA'][1] as $itemA){
					if (isset($itemA['item'])) { ?>
						valor = <?php echo '"'.str_replace('"','\"',preg_replace('/[\r\n]+/', "", $itemA['item'])).'"'; ?>;
						$('textarea#wysiwyg_<?php echo $numfila;?>_itemA_esp').html(valor);
						<?php 
						$numfila++;
					}
				}
			}
			$numfila = 0;
			if (isset($itemMultidiomaB['ItemMultidiomaB'][1])) {
				foreach ($itemMultidiomaB['ItemMultidiomaB'][1] as $itemB){
					if (isset($itemB['item'])) { ?>
					valor = <?php echo '"'.str_replace('"','\"',preg_replace('/[\r\n]+/', "", $itemB['item'])).'"'; ?>;
						$('textarea#wysiwyg_<?php echo $numfila;?>_itemB_esp').html(valor);
						<?php 
						$numfila++;
					}
				}  
			}
        ?>
        //INGLES
        <?php
        	$numfila = 0;
        	if (isset($itemMultidiomaA['ItemMultidiomaA'][2])) { 
	            foreach ($itemMultidiomaA['ItemMultidiomaA'][2] as $itemA){
	        		if (isset($itemA['item'])) { ?>
	        			valor = <?php echo '"'.str_replace('"','\"',preg_replace('/[\r\n]+/', "", $itemA['item'])).'"'; ?>;
	        			$('textarea#wysiwyg_<?php echo $numfila;?>_itemA_ing').html(valor);
	        			<?php 
	        			$numfila++;
	        		}
	        	}
			}
        	$numfila = 0;
        	if (isset($itemMultidiomaB['ItemMultidiomaB'][2])) {
	        	foreach ($itemMultidiomaB['ItemMultidiomaB'][2] as $itemB){
	        		if (isset($itemB['item'])) { ?>
	        		valor = <?php echo '"'.str_replace('"','\"',preg_replace('/[\r\n]+/', "", $itemB['item'])).'"'; ?>;
	        			$('textarea#wysiwyg_<?php echo $numfila;?>_itemB_ing').html(valor);
	        			<?php 
	        			$numfila++;
	        		}
	        	}
			}
        ?>
      	//PORTUGES
        <?php
        	$numfila = 0;
        	if (isset($itemMultidiomaA['ItemMultidiomaA'][3])) {
	            foreach ($itemMultidiomaA['ItemMultidiomaA'][3] as $itemA){
	        		if (isset($itemA['item'])) { ?>
	        			valor = <?php echo '"'.str_replace('"','\"',preg_replace('/[\r\n]+/', "", $itemA['item'])).'"'; ?>;
        				$('textarea#wysiwyg_<?php echo $numfila;?>_itemA_por').html(valor);
	        			<?php 
	        			$numfila++;
	        		}
	        	}
			}
        	$numfila = 0;
        	if (isset($itemMultidiomaB['ItemMultidiomaB'][3])) {
	        	foreach ($itemMultidiomaB['ItemMultidiomaB'][3] as $itemB){
	        		if (isset($itemB['item'])) { ?>
	        			valor = <?php echo '"'.str_replace('"','\"',preg_replace('/[\r\n]+/', "", $itemB['item'])).'"'; ?>;
        				$('textarea#wysiwyg_<?php echo $numfila;?>_itemB_por').html(valor);
	        			<?php 
	        			$numfila++;
	        		}
	        	}  
			}
        ?>
      	//FRANCES
        <?php
        	$numfila = 0; 
        	if (isset($itemMultidiomaA['ItemMultidiomaA'][4])) {
	            foreach ($itemMultidiomaA['ItemMultidiomaA'][4] as $itemA){
	        		if (isset($itemA['item'])) { ?>
	        			valor = <?php echo '"'.str_replace('"','\"',preg_replace('/[\r\n]+/', "", $itemA['item'])).'"'; ?>;
        				$('textarea#wysiwyg_<?php echo $numfila;?>_itemA_fra').html(valor);
	        			<?php 
	        			$numfila++;
	        		}
	        	}
			}
        	$numfila = 0;
        	if (isset($itemMultidiomaB['ItemMultidiomaB'][4])) {
	        	foreach ($itemMultidiomaB['ItemMultidiomaB'][4] as $itemB){
	        		if (isset($itemB['item'])) { ?>
	        			valor = <?php echo '"'.str_replace('"','\"',preg_replace('/[\r\n]+/', "", $itemB['item'])).'"'; ?>;
        				$('textarea#wysiwyg_<?php echo $numfila;?>_itemB_fra').html(valor);
	        			<?php 
	        			$numfila++;
	        		}
	        	}  
			}
        ?>
      	//ALEMAN
        <?php
        	/*$numfila = 0;
        	if (isset($itemMultidiomaA['ItemMultidiomaA'][5])) {
	            foreach ($itemMultidiomaA['ItemMultidiomaA'][5] as $itemA){
	        		if (isset($itemA['item'])) { ?>
	        			$('textarea#wysiwyg_<?php echo $numfila;?>_itemA_ale').html('<?php echo $itemA['item']; ?>');
	        			<?php 
	        			$numfila++;
	        		}
	        	}
			}
        	$numfila = 0;
        	if (isset($itemMultidiomaB['ItemMultidiomaB'][5])) {
	        	foreach ($itemMultidiomaB['ItemMultidiomaB'][5] as $itemB){
	        		if (isset($itemB['item'])) { ?>
	        			$('textarea#wysiwyg_<?php echo $numfila;?>_itemB_ale').html('<?php echo $itemB['item']; ?>');		
	        			<?php 
	        			$numfila++;
	        		}
	        	}
			}*/
        ?>
    }

    function agregaritemA() {
        item_a_esp.addForm();
        item_a_ing.addForm();
        item_a_por.addForm();
        item_a_fra.addForm();
        //item_ale.addForm();    
    }

    function agregaritemB() {
        item_b_esp.addForm();
        item_b_ing.addForm();
        item_b_por.addForm();
        item_b_fra.addForm();
        //item_ale.addForm();    
    }
    
    function guardar(opcion)
    { 
		var error=0;
		var completo=0;
		$('.nav-tabs > li > a').css('color','#2fa4e7'); 
        //$('.nav-tabs > li.active > a').css('color','#555555');
        if( $('#EditForm').valid())
        {	
        	var validator = $( "#EditForm" ).validate();
        	if ($('#titulo_esp').val() == '') {
        		validator.showErrors({
                    "data[CasoMultidioma][1][titulo]": "Por favor complete titulo"
                });
        		$('#myTab a[href="#esp"]').tab('show');
        		//$('.nav-tabs > li.active > a').css('color','red');
        		$('.nav-tabs > li.active > a').addClass('has-error');  
        		$('#titulo_esp').focus();
        		return false;
        	}
        	if ($('#titulo_ing').val() == '' && opcion==0) {
        		validator.showErrors({
                    "data[CasoMultidioma][2][titulo]": "Por favor complete titulo"
                });
        		$('#myTab a[href="#ing"]').tab('show');
        		//$('.nav-tabs > li.active > a').css('color','red');
        		$('.nav-tabs > li.active > a').addClass('has-error'); 
        		$('#titulo_ing').focus();
        		return false;
        	}
            if ($('#titulo_por').val() == '' && opcion==0) {
        		validator.showErrors({
                    "data[CasoMultidioma][3][titulo]": "Por favor complete titulo"
                });
        		$('#myTab a[href="#por"]').tab('show');
        		//$('.nav-tabs > li.active > a').css('color','red');
        		$('.nav-tabs > li.active > a').addClass('has-error'); 
        		$('#titulo_por').focus();
        		return false;
        	}
            if ($('#titulo_fra').val() == '' && opcion==0) {
        		validator.showErrors({
                    "data[CasoMultidioma][4][titulo]": "Por favor complete titulo"
                });
        		$('#myTab a[href="#fra"]').tab('show');
        		//$('.nav-tabs > li.active > a').css('color','red');
        		$('.nav-tabs > li.active > a').addClass('has-error'); 
        		$('#titulo_fra').focus();
        		return false;
        	}
            /*if ($('#titulo_ale').val() == '' && opcion==0) {
        		validator.showErrors({
                    "data[CasoMultidioma][5][titulo]": "Por favor complete titulo"
                });
        		$('#myTab a[href="#ale"]').tab('show');
        		$('.nav-tabs > li.active > a').css('color','red'); 
        		$('#titulo_ale').focus();
        		return false;
        	}*/
       	 	$('.micontrol iframe').each( function() {           
                var myItem = $(this).parent().parent().parent().parent().find('div').attr('class');
                //alert($(this).contents().find('body').html());
            	if ($(this).contents().find('body').html() == '' ||  $(this).contents().find('body').html() == '<br>') {
					completo=0;
                	var idioma = myItem.split("_").pop();
                	if (idioma == 'esp' || opcion==0) {	
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
            	} else {
					completo=1;
            	}
            });
            if (!error) {
	       	 	bootbox.confirm("¿Está seguro que desea guardar este caso?", function(result) {
	             	if (result)
	                {
						//if(opcion==0) $('#completo').val(completo);
						$('#completo').val(completo);
						$('#opcion').val(opcion);
			            $('#EditForm').submit();
	                }
	        	 });
            }
        }
    }  

    
    function borrar(id)
    {
        bootbox.confirm("¿Está seguro que desea borrar este caso?", function(result) {
                if (result)
                {
                    document.location.href = "/caso/borrar/"+id;
                }
            }); 
    }
</script>
