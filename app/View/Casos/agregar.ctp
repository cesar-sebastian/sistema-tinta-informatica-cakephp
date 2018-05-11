<h2 class="sub-header"><small>Nuevo Caso</small>  
    <!-- <a class="btn btn-default navbar-right" href="/formas/">Volver a la lista</a> -->
    <!-- <a class="btn btn-default navbar-right" href="/casos/index/">Volver a la lista</a>-->
    <a class="btn btn-primary navbar-right" href="/casos/<?php echo ($this->Session->Check('pag_'.$this->request->param('controller')))?'index/page:'.$this->Session->read('pag_'.$this->request->param('controller')):'index';?>">
  	Volver a la lista
  	</a>
</h2>
<div class="row-fluid" style="margin-top: 30px;">
    <div class="col-md-12">
        <fieldset>
            <form class="form-horizontal" id="AddForm" role="form" action="/casos/agregar/" method="POST">
            	<input type="hidden" id="forma" class="form-control" name="data[opcion]" />
            	<input type="hidden" id="completo" class="form-control" name="data[Caso][completo]" size="2" value="0" />
            	<input type="hidden" id="opcion" class="form-control" name="opcion"  />
                <div class="form-group">
                	<div class="col-sm-8"></div>
					<div class="col-sm-2">
                    	<label class="col-sm-2 control-label">Código Númerico</label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" id="cod_num" class="form-control" name="data[Caso][cod_num]" size="2" maxlength="2" value="<?php echo (isset($cod_num))?$cod_num:''; ?>" />
                        <span class="glyphicon form-control-feedback" id="forma1"></span>
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
						    <input type="hidden" name="data[CasoMultidioma][1][idiomas_id]" value="1" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Titulo del Caso</label>
							  		&nbsp;&nbsp;
							  		<input type="text" name="data[CasoMultidioma][1][titulo]" id="titulo_esp" size="50" />
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
									<input id="itemA_esp_#index#_idioma" name="data[ItemMultidiomaA][1][#index#][idiomas_id]" type="hidden" value="1" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemA_esp_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaA][1][#index#][item]', '', 'wysiwyg_#index#_itemA_esp',
													array(
														'altura'=>'100px',
														'ancho'=>'98%',
														'rows'=>4,
														'botones'=>array('negrita','italica','izquierda','centro','derecha','forecolor','linea','h4','signo','html'),
														'requerido'=>'Por favor complete el item A'
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
									<input id="itemB_esp_#index#_idioma" name="data[ItemMultidiomaB][1][#index#][idiomas_id]" type="hidden" value="1" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemB_esp_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaB][1][#index#][item]', '', 'wysiwyg_#index#_itemB_esp',
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
												'data[CasoMultidioma][1][leyenda]', '', 'wysiwyg_leyenda_esp',
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
												'data[CasoMultidioma][1][leyenda_pie]', '', 'wysiwyg_leyendapie_esp',
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
							<input type="hidden" name="data[CasoMultidioma][2][idiomas_id]" value="2" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Titulo del Caso</label>
							  		&nbsp;&nbsp;
							  		<input type="text" name="data[CasoMultidioma][2][titulo]" id="titulo_ing" size="50" />
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
									<input id="itemA_ing_#index#_idioma" name="data[ItemMultidiomaA][2][#index#][idiomas_id]" type="hidden" value="2" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemA_ing_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaA][2][#index#][item]', '', 'wysiwyg_#index#_itemA_ing',
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
									<input id="itemB_ing_#index#_idioma" name="data[ItemMultidiomaB][2][#index#][idiomas_id]" type="hidden" value="2" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemB_ing_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaB][2][#index#][item]', '', 'wysiwyg_#index#_itemB_ing',
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
												'data[CasoMultidioma][2][leyenda]', '', 'wysiwyg_leyenda_ing',
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
												'data[CasoMultidioma][2][leyenda_pie]', '', 'wysiwyg_leyendapie_ing',
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
							<input type="hidden" name="data[CasoMultidioma][3][idiomas_id]" value="3" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Titulo del Caso</label>
							  		&nbsp;&nbsp;
							  		<input type="text" name="data[CasoMultidioma][3][titulo]" id="titulo_por" size="50" />
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
									<input id="itemA_por_#index#_idioma" name="data[ItemMultidiomaA][3][#index#][idiomas_id]" type="hidden" value="3" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemA_por_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaA][3][#index#][item]', '', 'wysiwyg_#index#_itemA_por',
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
									<input id="itemB_por_#index#_idioma" name="data[ItemMultidiomaB][3][#index#][idiomas_id]" type="hidden" value="3" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemB_por_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaB][3][#index#][item]', '', 'wysiwyg_#index#_itemB_por',
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
												'data[CasoMultidioma][3][leyenda]', '', 'wysiwyg_leyenda_por',
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
												'data[CasoMultidioma][3][leyenda_pie]', '', 'wysiwyg_leyendapie_por',
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
							<input type="hidden" name="data[CasoMultidioma][4][idiomas_id]" value="4" />
						  	<br />
						  	<div class="form-group">
						  		<div class="col-sm-12">
							  		<label for="titulo" class="control-label">Titulo del Caso</label>
							  		&nbsp;&nbsp;
							  		<input type="text" name="data[CasoMultidioma][4][titulo]" id="titulo_fra" size="50" />
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
									<input id="itemA_fra_#index#_idioma" name="data[ItemMultidiomaA][4][#index#][idiomas_id]" type="hidden" value="4" />
									<div class="col-sm-1">
										<label class="control-label"><span style="border:1px solid #333; padding:5px;" id="itemA_fra_label"></span></label>
									</div>
									<div class="col-sm-9">
										<?php $this->DiticHtml->wysiwyg(
													'data[ItemMultidiomaA][4][#index#][item]', '', 'wysiwyg_#index#_itemA_fra',
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
												'data[CasoMultidioma][4][leyenda]', '', 'wysiwyg_leyenda_fra',
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
												'data[CasoMultidioma][4][leyenda_pie]', '', 'wysiwyg_leyendapie_fra',
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
                    	<input name="data[Caso][color]" type="hidden" value="#7bd148" />                        
                        <select name="color" class="color" id="color">
						  <option value="green">Verde</option>
						  <option value="blue">Azul</option>
						  <option value="yellow">Amarillo</option>
						  <option value="orange">Narajna</option>
						  <option value="red">Rojo</option>
						  <option value="purple">Violeta</option>
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
        $('#AddForm').validate({
           
           rules: {               
               'data[Caso][cod_num]': {
                   minlength: 1,
                   required: true,
                   number: true
               },
               'data[Caso][color]': {
                   required: true
               }
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
        	  
           },
           success: function(element) {
        	   $('.nav-tabs > li.active > a').removeClass('has-error');
               $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');  
               $('label.error').hide();
           }
           
        });
     // ESPAÑOL
    	item_a_esp = $('#itemA_esp').sheepIt({
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
	        aftereAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item A"}});
              	alert(newForm);                 	
            }
	    });

    	item_b_esp = $('#itemB_esp').sheepIt({
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
	        afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item B"}});           	
            }
	    });
		
	    // INGLES
	    item_a_ing = $('#itemA_ing').sheepIt({
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
	        /*afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item A"}});                 	
            }*/
	    });

	    item_b_ing = $('#itemB_ing').sheepIt({
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
	        /*afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item B"}});               	
            }*/
	    });
    	// PORTUGUES
	    item_a_por = $('#itemA_por').sheepIt({
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
	        /*afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item A"}});               	
            }*/
	    });

	    item_b_por = $('#itemB_por').sheepIt({
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
	        /*afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item B"}});                 	
            }*/
	    });
    	// FRANCES
	    item_a_fra = $('#itemA_fra').sheepIt({
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
	        /*afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item A"}});                	
            }*/
	    });

	    item_b_fra = $('#itemB_fra').sheepIt({
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
	        /*afterAdd: function(source, newForm) {
            	var myId = $(newForm).find('textarea').attr('id');
              	$('#'+myId).rules("add",{'required':true,  messages: { required: "Por favor completa el item B"}});                 	
            }*/
	    });
    	// ALEMAN
	    /*$('#itemA_ale').sheepIt({
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

    	/*$('#itemB_ale').sheepIt({
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
	    }); */
        
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
		var error = 0;
		var completo=0;
		var cod_num = $('input[name="data[Caso][cod_num]"]').val();
		//$('.nav-tabs > li > a').css('color','#2fa4e7'); 
		$.ajax({
        	url: '/casos/verificar/',
            cache: false,
            type: 'POST',
            dataType: 'json',
            data: {cod_num: cod_num},
            success: function (data) {
            	var validator = $( "#AddForm" ).validate();
                if (data.existe==1) {
                    validator.showErrors({
                        "data[Caso][cod_num]": "El código númerico ya existe en el sistema."
                    });
                    $('input[name="data[Caso][cod_num]"]').focus();
                	return false;
            	} else {
            		if( $('#AddForm').valid())
                    {
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
                    		$('#titulo_ale').focus();
                    		return false;
                    	}*/
                        $('.micontrol iframe').each( function() {
                            var myItem = $(this).parent().parent().parent().parent().find('div').attr('class');
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
                            //if (opcion==0) $('#completo').val(1);
                            $('#completo').val(1);
                            $('#opcion').val(opcion);
                        	$('#AddForm').submit();
                        }	
                    }
            	}
             }
        });
        
    }  
</script>