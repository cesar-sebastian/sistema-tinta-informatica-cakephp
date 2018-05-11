<?php
App::uses('AppHelper', 'View/Helper');

class DiticHtmlHelper extends AppHelper{
	public $name 		= 'DiticHtml';
	public $components = array('Session');
	public $helpers = array('Session','Paginator');
	
	
	protected function p($txt){
		print $txt.chr(10);
	}
	
public function wysiwyg($fieldName, $valor, $id, $options) {
		$perfilDefault = $this->Session->read('PerfilDefault');
		$accionesPermitidasPorPerfiles = $this->Session->read('RbacAcciones');
		$accionesPermitidas = $accionesPermitidasPorPerfiles[$perfilDefault];
		$output ='';
		if ($fieldName) {
			if (!isset($id)) {
				$id = "wysiwyg";
			}
			$output .= '<div class="'.$id.'">';
			if (isset($options['botones'])) {
				$botones = $options['botones'];
				//if (count($botones)>0) {
					foreach ($botones as $boton) {
						if ($boton == 'negrita') {
							$output .= '<a class="btn btn-default" id="negrita"></a>';
						}
						if ($boton == 'italica') {
							$output .= '<a class="btn btn-default" id="italica"></a>';
						}
						if ($boton == 'subrayada') {
							$output .= '<a class="btn btn-default" id="subrayada"></a>';
						}
						if ($boton == 'izquierda') {
							$output .= '<a class="btn btn-default" id="izquierda"></a>';
						}
						if ($boton == 'centro') {
							$output .= '<a class="btn btn-default" id="centro"></a>';
						}
						if ($boton == 'derecha') {
							$output .= '<a class="btn btn-default" id="derecha"></a>';
						}
						if ($boton == 'lista') {
							$output .= '<a class="btn btn-default" id="lista"></a>';
						}
						if ($boton == 'listaizquierda') {
							$output .= '<a class="btn btn-default" id="listaizquierda"></a>';
						}
						if ($boton == 'listaderecha') {
							$output .= '<a class="btn btn-default" id="listaderecha"></a>';
						}
						if ($boton == 'aumentar') {
							$output .= '<a class="btn btn-default" id="aumentar"></a>';
						}
						if ($boton == 'achicar') {
							$output .= '<a class="btn btn-default" id="achicar"></a>';
						}
						if ($boton == 'imagen') {
							$output .= '<a class="btn btn-default" id="imagen"></a>';
						}
						if ($boton == 'h4') {
							$output .= '<a class="btn btn-default" id="h4"></a>';
						}
						if ($boton == 'html') {
							$output .= '<a class="btn btn-default" id="html"></a>';
						}
						if ($boton == 'signo') {
							$output .= '<a class="btn btn-default" id="signo"></a>';
						}
						if ($boton == 'estrella') {
							$output .= '<a class="btn btn-default" id="estrella"></a>';
						}
						if ($boton == 'texto') {
							$output .= '<a class="btn btn-default" id="texto"></a>';
						}
						if ($boton == 'titulo') {
							$output .= '<a class="btn btn-default" id="titulo"></a>';
						}
						if ($boton == 'c_haya') {
							$output .= '<a class="btn btn-default" id="c_haya"></a>';
						}
						if ($boton == 'linea') {
							$output .= '<a class="btn btn-default" id="linea"></a>';
						}
					}
				//}
			}
			
			$output .= '<textarea name="'.$fieldName.'" style="height:120px;" class="form-control" id="'.$id.'" ';
			if (isset($options['cols'])) $output .= 'cols="'.$options['cols'].'" ';
			
			if (isset($options['rows'])) $output .= 'rows="'.$options['rows'].'" ';
			
			if (isset($options['modo'])) {
				if ($options['modo']=='sololectura') $output .= 'readonly ';
				if ($options['modo']=='desactivado') $output .= 'disabled ';
				if ($options['modo']=='oculto') $output .= 'hidden ';
			}
			$output .= '>';
			if (!empty($valor)) $output .= $valor;
			$output .= '</textarea></div>';
			
			$output .= "
					<script type='text/javascript'>
					$(function () {
	        			$('textarea#{$id}').htmlarea({
	        				css: '/css/jHtmlArea/jHtmlArea.Editor.css',
	        				updateHtmlArea:$('#{$id}').val(),
							loaded: function(){
					    		$.myControl = { jhtmlarea: this }; 
								$($.myControl.jhtmlarea.editor.body).bind('keyup' , function() { if ($(this).html()!='<br>' && $(this).html()!='') $('label#{$id}').hide(); else $('label#{$id}').show(); });
							}
						});";
						if (isset($options['altura'])) 
							$output .= "$('.{$id} iframe').height('".$options['altura']."');";
						if (isset($options['ancho']))
							$output .= "$('.{$id} iframe').width('".$options['ancho']."');";
			$output .= "         
	        			$('.jHtmlArea iframe').contents().find('body')
	        				.css('font-family','Helvetica')
	        				.css('color','#333333')
	        				.css('font-size','14px')
	        				.css('width','98%')
	        				.css('overflow-x','none');
	        			$('div.{$id} a#html ,button#html').click(function() {
    						$('#{$id}').htmlarea('toggleHTMLView');
    					});
					    $('div.{$id} a#negrita,button#negrita').click(function() {
					    	$('#{$id}').htmlarea('bold');
					    });
					    $('div.{$id} a#italica,button#italica').click(function() {
					    	$('#{$id}').htmlarea('italic');
					    });
					    $('div.{$id} a#subrayada,button#subrayada').click(function() {
					    	$('#{$id}').htmlarea('underline');
					    });
					    $('div.{$id} a#izquierda,button#izquierda').click(function() {
					    	$('#{$id}').htmlarea('justifyLeft');
					    });
					    $('div.{$id} a#centro, button#centro').click(function() {
					    	$('#{$id}').htmlarea('justifyCenter');
					    });
					    $('div.{$id} a#derecha, button#derecha').click(function() {
					    	$('#{$id}').htmlarea('justifyRight');
					    });
					    $('div.{$id} a#lista,button#lista').click(function() {
					    	$('#{$id}').htmlarea('unorderedList');
					    });
					    $('div.{$id} a#listaizquierda,button#listaizquierda').click(function() {
					    	$('#{$id}').htmlarea('outdent');
					    });
					    $('div.{$id} a#listaderecha,button#listaderecha').click(function() {
					    	$('#{$id}').htmlarea('indent');
					    });
					    $('div.{$id} a#aumentar,button#aumentar').click(function() {
					    	$('#{$id}').htmlarea('increaseFontSize');
					    });
					    $('div.{$id} a#achicar,button#achicar').click(function() {
					    	$('#{$id}').htmlarea('decreaseFontSize');
					    });
					    $('div.{$id} a#imagen,button#imagen').click(function() {
					    	$('#{$id}').htmlarea('image');
					    });
					    $('div.{$id} a#h4,button#h4').click(function() {
					    	$('#{$id}').htmlarea('h4');
					    });
					    $('div.{$id} a#signo,button#signo').click(function() {
					    	$('#{$id}').htmlarea('signo');
					    });
					    $('div.{$id} a#estrella,button#estrella').click(function() {
					    	$('#{$id}').htmlarea('estrella');
					    });
					    $('div.{$id} a#texto,button#texto').click(function() {
					    	$('#{$id}').htmlarea('texto');
					    });
					    $('div.{$id} a#titulo,button#titulo').click(function() {
					    	$('#{$id}').htmlarea('titulo');
					    });
					    $('div.{$id} a#c_haya,button#c_haya').click(function() {
					    	$('#{$id}').htmlarea('c_haya');
					    });
					    $('div.{$id} a#linea,button#linea').click(function() {
					    	$('#{$id}').htmlarea('insertHorizontalRule');
					    });
					    //$('#{$id}').htmlarea('updateHtmlArea',$('#{$id}').val());
						
					});
	    			</script>
			";
			if (isset($options['requerido']) && !empty($options['requerido'])) {
				$output .= "<label id='{$id}' class='error' style='display:none;'>".$options['requerido']."</label>";
			}
				
			$this->p($output);
		}
		
	}
	
	public function leerCampo($fila,$campo){
		$niveles = explode('.', $campo);
		$actual = $fila;
		for($i=0;$i<count($niveles);$i++){
			if (isset($actual[$niveles[$i]])) {
				$actual = $actual[$niveles[$i]];
			} else {
				$actual = $fila;
			}
		}
	
		return $actual;
	}
	
	public function tabla($modelo, $datos, $columnas, $botones=null) {
		$puede_cargar_path = $this->Session->read('puede_cargar_path');
		$puede_publico_path = $this->Session->read('puede_publico_path');
		$perfilDefault = $this->Session->read('PerfilDefault');
		$accionesPermitidasPorPerfiles = $this->Session->read('RbacAcciones');
		$accionesPermitidas = $accionesPermitidasPorPerfiles[$perfilDefault];
		$output = '';
		$id = null;
		$popup = false;
		$url = array();
		if ($modelo && $datos) {
			$output = '<div class="table-responsive">';
			if (count($columnas)) {
				$output .= '<table class="table table-hover">';
				$output .= '<thead><tr>';
				foreach ($columnas as $columna) {
					if (isset($columna['oculto']) && !$columna['oculto']) {
						if (isset($columna['orden'])) {
							$output.= '<th>'.$this->Paginator->sort($columna['campo'],$columna['titulo'], array('Model'=>$modelo, 'direction' => $columna['orden'])).'</th>';
						} else {
							$output.= '<th>'.$columna['titulo'].'</th>';
						}
					}
				}
				if (count($botones)) $output .= '<th style="text-align:right;padding-right:25px;width:auto;">Accion</th>';
				$output .= '</tr></thead>';
				$output .= '<tbody>';
				foreach ($datos as $dato) {
					$titulo_ver = null;
					$titulo_eliminar = null;
					$output .= '<tr>';
					foreach ($columnas as $columna) {
						$campo = $columna['campo'];
						$is_id = explode('.', $campo);
						if ($is_id[1]=='id') { 
							$id = $this->leerCampo($dato, $campo);
						} elseif ($is_id[1]=='agregado') {
							$agregado = $this->leerCampo($dato, $campo);
						}
						if (isset($botones['eliminar'][2]) &&  $botones['eliminar'][2] == 'cod_num' && $is_id[1]=='cod_num') {
							$cod_num = $this->leerCampo($dato, $campo);
						}
						if (isset($columna['oculto']) && !$columna['oculto']) {
							$output .= '<td ';
							if (isset($columna['css'])) $output .= 'class="'.$columna['clase'].'"';
							$output .= '>';
							
							
							if (isset($columna['href'])) $url = $this->leerCampo($dato,$columna['href'][0]);
							
							//if (isset($is_url)) $url = $this->leerCampo($dato, $is_url);
							$valor_campo = $this->leerCampo($dato, $campo);
							
							if (isset($columna['formato']) && $columna['formato']=='si/no') {
								if (!is_array($valor_campo)) 
									$valor_campo = "si";
								else
									$valor_campo = "no";
							}
							if (isset($columna['tamaño']) && is_numeric($columna['tamaño'])) {
								$valor_campo = substr($valor_campo,0,$columna['tamaño']);
							}
							if (isset($columna['href'])) {
								if (isset($url)) {
									$output.='<a href="'.$url.'" ';
									if (isset($columna['destino'][1]))	$output.='target="'.$columna['href'][1].'" ';
									$output .= '>'.$valor_campo.'</a>';
									
								} else {
									$output .=$valor_campo;
								}
							} elseif (isset($columna['imagen']) && $columna['imagen']) {
								$output .= '<img src="'.$valor_campo.'" border="0" />';
							} elseif (isset($columna['fecha']) && $columna['fecha']) {
								$output .= trim(date("d/m/Y",strtotime($valor_campo)));
							} else {
								$output .= $valor_campo;
							}
							
							$output .= '</td>';
						}
					}
					if (count($botones) && isset($id)) {
						$output .= '<td style="text-align:right;width:auto;">';
						if (isset($botones['ver'])) {
							if (isset($botones['ver'][2])) $titulo_ver = $botones['ver'][2];
							$url = explode('/',$botones['ver'][0]);
							if(isset($accionesPermitidas[$url[1]]['ver']) && $accionesPermitidas[$url[1]]['ver']) {
								if ($botones['ver'][0] && !isset($botones['ver'][1])) {
									$popup = false;
									$output .= '<a href="'.$botones['ver'][0].$id.'" type="button" class="btn btn-success btn-xs" title="Ver"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;';
								} elseif ($botones['ver'][0] && isset($botones['ver'][1]) && $botones['ver'][1]=='popup') {
									$popup = true;
									if (isset($botones['ver'][2])) $titulo_ver = $botones['ver'][2];
									$output .= '<button onClick="ver(\''.$botones['ver'][0].$id.'\')" type="button" class="btn btn-success btn-xs" title="Ver"><span class="glyphicon glyphicon-eye-open"></span></button>&nbsp;';
								}
							}
						}
						if (isset($botones['editar'])) {
							$url = explode('/',$botones['editar']);
							if (isset($accionesPermitidas[$url[1]]['editar']) && $accionesPermitidas[$url[1]]['editar']) {
								$output .= '<a href="'.$botones['editar'].$id.'" type="button" class="btn btn-success btn-xs" title="Editar"><span class="glyphicon glyphicon-list-alt"></span></a>&nbsp;';
							}
						} 
						if (isset($botones['editar2'])) {
							$url = explode('/',$botones['editar2']);
							if ($agregado == 'si') {
								if (isset($accionesPermitidas[$url[1]]['editar']) && $accionesPermitidas[$url[1]]['editar']) {
									$output .= '<a href="'.$botones['editar2'].$id.'" type="button" class="btn btn-primary btn-xs" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;';
									/*if (isset($botones['editar'][0]) && !isset($botones['editar'][1])) {
										$popup = false;
										$output .= '<a href="'.$botones['editar'].$id.'" type="button" class="btn btn-primary btn-xs" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;';
									} elseif (isset($botones['editar'][0]) && isset($botones['ver'][1]) && $botones['ver'][1]=='popup') {
										$popup = true;
										if (isset($botones['ver'][2])) $titulo_ver = $botones['ver'][2];
										$output .= '<button onClick="editar(\''.$botones['editar'][0].$id.'\')" type="button" class="btn btn-success btn-xs" title="Editar"><span class="glyphicon glyphicon-eye-open"></span></button>&nbsp;';
									} else {
										$output .= '<a href="'.$botones['editar'].$id.'" type="button" class="btn btn-primary btn-xs" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;';
									}*/
								}
							}
						}
						
						if (isset($botones['eliminar'][0])) {
							$url = explode('/',$botones['eliminar'][0]);                                                        
							if (isset($accionesPermitidas[$url[1]]['eliminar']) && $accionesPermitidas[$url[1]]['eliminar']) {
								if (isset($botones['eliminar'][2]) &&  $botones['eliminar'][2] == 'cod_num') {
									$output .= '<button onClick="eliminar2(\''.$botones['eliminar'][0].'\','.$id.','.$cod_num.')" type="button" class="btn btn-danger btn-xs" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>';
								} else {
									$output .= '<button onClick="eliminar(\''.$botones['eliminar'][0].'\','.$id.',null)" type="button" class="btn btn-danger btn-xs" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>';
								}
								if (isset($botones['eliminar'][1])) $titulo_eliminar = $botones['eliminar'][1];
							}
						}
						if (isset($botones['eliminar2'][0])) {
							$url = explode('/',$botones['eliminar2'][0]);
							if ($agregado == 'si') {
								if (isset($accionesPermitidas[$url[1]]['eliminar']) && $accionesPermitidas[$url[1]]['eliminar']) {
									if (isset($botones['eliminar2'][2]) &&  $botones['eliminar2'][2] == 'cod_num') {
										$output .= '<button onClick="eliminar2(\''.$botones['eliminar2'][0].'\','.$id.','.$cod_num.')" type="button" class="btn btn-danger btn-xs" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>';
									} else {
										$output .= '<button onClick="eliminar(\''.$botones['eliminar2'][0].'\','.$id.',null)" type="button" class="btn btn-danger btn-xs" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>';
									}
									if (isset($botones['eliminar2'][1])) $titulo_eliminar = $botones['eliminar2'][1];
								}
							}
								
						}
						$output .= '</td>';
					}
					$output .= '</tr>';
					if (isset($id) && $popup) {
						$div = '
						    <div class="modal fade" id="myModal">
  							  <div class="modal-dialog">
	    						<div class="modal-content">
							      <div class="modal-header">
							        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><br />';								      
								        if (isset($titulo_ver)) {
								        	$div .= '<h4 class="modal-title">';
								        	$div .= $titulo_ver.' ';
								        	$div .= '</h4>';
								        	//$div .= $id.'</h4>';
								        }
							      $div .='
							      </div>
							      <div class="modal-body">
							        <div id="datos"></div>
							      </div>
							      <div class="modal-footer" style="clear:both;">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							      </div>
							    </div>
							  </div>
							</div>';
					}
				}
				$output .= '</table>';
			}
			$output .= '<br />';
			$output .= '<div style="text-align:center; width:100%;">';
			$pager_params = $this->Paginator->params();
			if($pager_params['pageCount'] > 1)
			{
				$output.= $this->Paginator->prev('<b>ANTERIOR</b>', array('escape'=> false,'class'=> 'btn btn-default'), null, array('escape'=> false,'class' => 'btn btn-default prev disabled'));
				$output.= $this->Paginator->counter(' ( {:page} / {:pages} ) ');
				$output.= $this->Paginator->next('<b>SIGUIENTE</b>',array('escape'=> false,'class'=> 'btn btn-default'), null, array('escape'=> false,'class' => 'btn btn-default next disabled'));
			}
			$output .= '</div>';
			$output .= '</div>';
			if (isset($div)) {
				$output .= $div;
			}
			//if (!isset($botones['eliminar'][2]) && !$botones['eliminar'][2]) {
				$output .= '
					<script type="text/javascript">
						function eliminar(url,id,cod) {
							bootbox.confirm("';
							if (isset($titulo_eliminar)) {
								$output .= $titulo_eliminar;
							} else {
								$output .= 'Está seguro de eliminar el registro';
							}
							
							if (isset($botones['eliminar'][2])) {
								if ($botones['eliminar'][2] == 'cod_num') {
									$output .= ' # "+cod+"?"';
								} elseif ($botones['eliminar'][2] == 'sin_num') {
									$output .= '"';
								}
							} else {
								$output .= ' # "+id+"?"';
							}
							$output .= ', function(result) {
        						if (result)
        						{
            						document.location.href = url+id;
        						}
    						});
						}
					</script>';
			//}			
			$output .= '
					<script type="text/javascript">
					function ver(url) {
						$.ajax({
						     type: "POST",
						     url: url,
						     success: function(data) {
						          $("#datos").html(data);
						     }
						});';
						if (isset($div)) {
							$output.='$("#myModal").modal("show");';
						}
						$output.='
					}
					function editar(url) {
						$.ajax({
						     type: "POST",
						     url: url,
						     success: function(data) {
						          $("#datos").html(data);
						     }
						});';
						if (isset($div)) {
							$output.='$("#myModal").modal("show");';
						}
						$output.='
					}
				</script>';
			$this->p($output);
		}
	}
	
	public function autocomplete($nombre,$valor,$id,$url,$destino1=NULL,$destino2=NULL,$opciones=NULL) 
	{
		$perfilDefault = $this->Session->read('PerfilDefault');
		$accionesPermitidasPorPerfiles = $this->Session->read('RbacAcciones');
		$accionesPermitidas = $accionesPermitidasPorPerfiles[$perfilDefault];
		$output = '';
		if (isset($nombre) && isset($id)) {
			$output = '<input type="text" name="'.$nombre.'" id="'.$id.'" value="'.$valor.'" class="form-control ui-autocomplete-input" />';
			if($id)
			{
				$output .= '<script type="text/javascript">
					$("#'.$id.'").autocomplete({
						source: function (request, response) {
							$.ajax({
								url: "'.$url.'",
								type: "POST",
								dataType: "json",
								data: {'.$nombre.': request.term},
								success: function (data) {
									response($.map(data, function(item) {
										return {
											label: item.label,
											value: item.value
										};
									}));
								}
							});
						},
						minLength: 1,';
						if (isset($destino1)) {
							$output .= '
								select: function(event, ui) {
									$("#'.$destino1.').val(ui.item.label.split(",")[1].trim().split(" ")[0].trim());';
								if (isset($destino2)) {
									$output .= '$("#'.$destino2.').val(ui.item.label.split(",")[0].trim());';
								}
							$output .= '};';
						}
				$output .= '});
						</script>';
			} else {
				$output = '<script type="text/javascript">$("#'.$id.').autocomplete("destroy");</script>';
			}
			$this->p($output);
		}
	}
	public function array_controles($nombre, $id, $valores) 
	{
		$output = '';
		if (isset($nombre) && isset($id)) {
			$numfila=0;
			if (isset($valores)) { 
				if(count($valores)>0) {
					foreach ($valores as $key=>$dato) {
						$array_datos .= "{'".$nombre."_#index#_".$key."':'".$dato."'},";
						$numfila++;
					}		
				}
			}
		
			$output = '
				<input id="'.$nombre."_#index#_".$key.'" name="data['.$nombre.'][#index#]['.$key.']" type="text" />	
				<script type="text/javascript">
				$(function () {						  
					      $("#'.$id.'").sheepIt({
					            separator: "",
					            allowRemoveLast: true,
					            allowRemoveCurrent: true,
					            allowRemoveAll: true,
					            allowAdd: true,
					            allowAddN: true,
					            maxFormsCount: 20,
					            minFormsCount: 1,';
								if ($numfila==0)
									$output .= 'iniFormsCount: 1,';
								else 
									$output .= 'iniFormsCount: '.($numfila-1).',
					            indexFormat:"#index#",';
					            if (count($valores)>0) $output .= 'data: ['.$array_datos.']
					        });
				</script>';
		}
	}
}