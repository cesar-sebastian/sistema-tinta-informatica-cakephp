<?php //debug($rbacAcciones); ?>
<div>
    <span id="mensajes"></span>    
    <div class="col-md-12 well" style="margin-top: 10px;">
        <form autocomplete="off" class="form-horizontal" name="formCons" id="formCons" action="/rbac/RbacAcciones/" method="POST">
            
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Consulta Acciones</h4>
                <hr>                
                <div class="form-group">
                    <div class="col-sm-12 ">                        
                        <input type="text" id="controller" name="controller" class="form-control" placeholder="Controlador" value="<?php echo $controller;?>" >
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-12 ">                        
                        <input type="text" id="action" name="action" class="form-control" placeholder="Acción" value="<?php echo $action;?>" >
                    </div>
                </div>                                                              
                <div style="margin-top: 15px" class="text-center">
                    <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search"></span>                    
                    Buscar</button>                    
                    <button type="button" class="btn btn-primary" onclick="limpiar()">
                    <span class="glyphicon glyphicon-trash"></span>                    
                    Limpiar</button>
                </div>  
            
        </form>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
	        <h3 class='sub-header' >
	        <span class="glyphicon glyphicon-th-list"></span>
	        Acciones   
	        </h3>
	    </div>
	    <div class="col-md-6" style="text-align:right;">
	   		<button type="button" class="btn btn-primary" onclick="sincronizar()">
            	<span class="glyphicon glyphicon-refresh"></span> Sincronizar
            </button>
	   	</div>
	   	<div class="col-md-12 table-switch" style="padding:0;">         
	        <div class="table-responsive">
	            <table class="table table-hover tree">
	                <thead>
	                    <tr> 
	                        <th>Controlador<?php //echo $this->Paginator->sort('RbacAccion.controller','Controlador', array('Model'=>'Rbac,RbacAccion'));?></th>
	                        <th>Acción<?php //echo $this->Paginator->sort('RbacAccion.action','Acción', array('Model'=>'Rbac.RbacAccion'));?></th>
	                        <th data-placement="top" title="Solo lee datos o consulta sin ABM" >Sólo Lectura</th>                                                               
	                        <th data-placement="top" title="Permite envio de datos de la interfaz pública (consultas o envió de datos)" >Carga Pública</th>                         
	                        <th data-placement="top" title="Para sitios web con carga para usuarios registrados y las operaciones EXCLUSIVAS de los usuarios.">Carga Login Pública</th>                         
	                        <th data-placement="top" title="Para sitios web con carga para usuarios registraods y operaciones de administracion del sitio. Ej. Contenidos y Administracion de Usuarios">Carga Login Interna</th>
	                        <th data-placement="top" title="Solo para uso de Super Usuarios. Para administracion interna, instalacion y actualizacion de modulos, etc.">Carga Administración</th>
	                        <th data-placement="top" title="Heredado">Heredado</th>
	                        <th>Opción</th>
	                        
	                        <!-- th class="text-center">Acciones</th -->
	                    </tr>
	                </thead>
	                <tbody >
	                    <?php 
	                    $i=1;
	                    $num = 0;
	                    $aux = '';
	                    $controlador='';
	                    //debug($rbacAcciones);
	                    foreach ($rbacAcciones as $rbacAccion): ?>
	                    	<?php if ($rbacAccion['RbacAccion']['controller']!= 'Configuracion' && similar_text($rbacAccion['RbacAccion']['controller'],'Rbac')!=4) { ?> 
		                    	<?php if ($rbacAccion['RbacAccion']['action'] == '_null') $aux = $rbacAccion['RbacAccion']['controller']; ?>                 
		                        <tr id="headerTable" 
		                        	<?php if ($aux == $rbacAccion['RbacAccion']['controller'] && $rbacAccion['RbacAccion']['action'] == '_null') {
		                        		echo 'class="treegrid-'.$i.'"';
		                        		$controlador = $rbacAccion['RbacAccion']['controller'];
		                        		$i++;
		                        	} elseif ($aux == $rbacAccion['RbacAccion']['controller']) { 
										echo 'class="treegrid-parent-'.($i-1).'"';
										$controlador='';
									} else {
										$controlador = $rbacAccion['RbacAccion']['controller'];
									}?>>    
		                            <td><?php echo $controlador; ?></td>
		                            <td><?php echo ($rbacAccion['RbacAccion']['action']!='_null')?$rbacAccion['RbacAccion']['action']:''; ?></td>                            
		                            <td class="<?php echo $num; ?>">
		                            	<input id="solo_lectura" class="switch" type="checkbox" parentid="<?php echo ($i-1);?>" data-on-color="success" data-on-text="&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;" data-off-color="danger" 
		                            		dataid="<?php echo $rbacAccion['RbacAccion']['id']; ?>"  <?php echo ($rbacAccion['RbacAccion']['solo_lectura'] == 1)? 'checked' : ''; ?>
		                            		<?php echo ($rbacAccion['RbacPerfil']['accion_default_id'] == $rbacAccion['RbacAccion']['id'] && $rbacAccion['RbacPerfil']['PermisosVirtualHost']['permiso']=='solo_lectura')? 'disabled' : '';?> 
		                            	>
		                            </td>
		                            <td class="<?php echo $num; ?>">
		                            	<input id="carga_publica" type="checkbox" class="switch" parentid="<?php echo ($i-1);?>" data-on-color="success" data-on-text="&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;" data-off-color="danger" 
		                            		dataid="<?php echo $rbacAccion['RbacAccion']['id']; ?>" <?php echo ($rbacAccion['RbacAccion']['carga_publica'] == 1)? 'checked' : ''; ?>
		                            		<?php echo ($rbacAccion['RbacPerfil']['accion_default_id'] == $rbacAccion['RbacAccion']['id'] && $rbacAccion['RbacPerfil']['PermisosVirtualHost']['permiso']=='carga_publica')? 'disabled' : '';?>	
		                            	></td>
		                            <td class="<?php echo $num; ?>">
		                            	<input id="carga_login_publica" type="checkbox" class="switch" parentid="<?php echo ($i-1);?>" data-on-color="success" data-on-text="&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;" data-off-color="danger" 
		                            		dataid="<?php echo $rbacAccion['RbacAccion']['id']; ?>" <?php echo ($rbacAccion['RbacAccion']['carga_login_publica'] == 1)? 'checked' : ''; ?>
		                            		<?php echo ($rbacAccion['RbacPerfil']['accion_default_id'] == $rbacAccion['RbacAccion']['id'] && $rbacAccion['RbacPerfil']['PermisosVirtualHost']['permiso']=='carga_login_publica')? 'disabled' : '';?>
		                            	></td>
		                            <td class="<?php echo $num; ?>">
		                            	<input id="carga_login_interna" type="checkbox" class="switch" parentid="<?php echo ($i-1);?>" data-on-color="success" data-on-text="&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;" data-off-color="danger" dataid="<?php echo $rbacAccion['RbacAccion']['id']; ?>" 
		                            		<?php echo ($rbacAccion['RbacAccion']['carga_login_interna'] == 1)? 'checked' : ''; ?>
		                            		<?php echo ($rbacAccion['RbacPerfil']['accion_default_id'] == $rbacAccion['RbacAccion']['id'] && $rbacAccion['RbacPerfil']['PermisosVirtualHost']['permiso']=='carga_login_interna')? 'disabled' : '';?>
		                            	></td>
		                            <td class="<?php echo $num; ?>">
		                            	<input id="carga_administracion" type="checkbox" class="switch" parentid="<?php echo ($i-1);?>" data-on-color="success" data-on-text="&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;" data-off-color="danger" dataid="<?php echo $rbacAccion['RbacAccion']['id']; ?>" 
		                            		<?php echo ($rbacAccion['RbacAccion']['carga_administracion'] == 1)? 'checked' : ''; ?>
		                            		<?php echo ($rbacAccion['RbacPerfil']['accion_default_id'] == $rbacAccion['RbacAccion']['id'] && $rbacAccion['RbacPerfil']['PermisosVirtualHost']['permiso']=='carga_administracion')? 'disabled' : '';?>
		                            	></td>
		                            <td class="<?php echo $num; ?>">
		                            	<?php if ($rbacAccion['RbacAccion']['action'] != '_null') { ?>
		                            	<input id="heredado" class="switch" parentid="<?php echo ($i-1);?>" data-on-color="success" data-on-text="&nbsp;&nbsp;" data-off-text="&nbsp;&nbsp;" data-off-color="danger" dataid="<?php echo $rbacAccion['RbacAccion']['id']; ?>" type="checkbox" <?php echo ($rbacAccion['RbacAccion']['heredado'] == 1)? 'checked' : ''; ?>>
		                            	<?php } ?>
		                            </td>
		                            <td>
		                            	<?php //if ($aux != $rbacAccion['RbacAccion']['controller'] || $rbacAccion['RbacAccion']['action'] == '_null') { ?>
		                            	<button class="btn btn-warning" onclick="eliminar(<?php echo $rbacAccion['RbacAccion']['id']; ?>);">Borrar</button>
		                            	<?php //} ?>
		                            </td>
		                            <?php $num++; ?>
		                            <!-- >td id="acciones-1595">
		                                <div class="text-center">                                    
		                                    <a href="/rbac/RbacAcciones/edit/<?php //echo $rbacAccion['RbacAccion']['id']; ?>" type="button" class="btn btn-primary btn-xs" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>                                    
		                                    <button onClick="eliminar(<?php //echo $rbacAccion['RbacAccion']['id']; ?>)" type="button" class="btn btn-danger btn-xs" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>
		                                </div>
		                            </td  -->
		                        </tr>
	                        <?php } ?>
	                    <?php endforeach; ?>
	                </tbody>
	            </table>
	            
	            <!-- <div style="text-align:center; width:100%;">		        
			        <?php
			        $options = array('url'=> array('controller' => 'RbacAcciones' ) );
					$this->Paginator->options($options);
											

			        $pager_params = $this->Paginator->params();
			        //debug($pager_params);
			        if($pager_params['pageCount'] > 1){
						echo $this->Paginator->prev('<b>ANTERIOR</b>', array('escape'=> false,'class'=> 'btn btn-default'), null, array('escape'=> false,'class' => 'btn btn-default prev disabled'));
			            echo $this->Paginator->counter(' ( {:page} / {:pages} ) ');
			        	echo $this->Paginator->next('<b>SIGUIENTE</b>',array('escape'=> false,'class'=> 'btn btn-default'), null, array('escape'=> false,'class' => 'btn btn-default next disabled'));
			        }
			        ?>  		        
			    </div>-->
	        </div>
	    </div>
    </div>
</div>
<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			   	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><br />								      
				<h4 class="modal-title">Sincronizacion</h4>
			</div>
			<div class="modal-body">
				<div id="datos">
					<div class="col-md-12">
				                 
				        <div class="table-responsive">
				            <table class="table table-hover tree">
				                <thead>
				                    <tr> 
				                        <th>Controlador</th>
				                        <th>Accion</th>
				                        <th id="marcar"><a href="#" id="valores[]" style="text-decoration:underline">RBAC</a></th>
				                    </tr>
				                </thead>
				                <tbody >
				                    <?php
				                    //debug($rbacNuevos);
				                    if (isset($rbacNuevos) && count($rbacNuevos)) { 
					                    foreach ($rbacNuevos as $rbac): ?>                 
					                        <tr id="headerTable2">
					                            <td><?php echo $rbac['RbacAccion']['controller']; ?></td>
					                            <td><?php echo ($rbac['RbacAccion']['action']=='_null')?'NULO':$rbac['RbacAccion']['action']; ?></td>
					                            <td>
					                            	<!-- <input class="switch2" data-on-color="success" data-on-text="SI" data-off-text="NO" data-off-color="danger" data-action="<?php echo $rbac['RbacAccion']['action']; ?>" data-controller="<?php echo $rbac['RbacAccion']['controller']; ?>" type="checkbox">-->
					                            	<input class="checkbox" name="valores[]" type="checkbox" data-action="<?php echo $rbac['RbacAccion']['action']; ?>" data-controller="<?php echo $rbac['RbacAccion']['controller']; ?>" value="1" />
					                            </td>
					                        </tr>
					                    <?php endforeach;
					                } else { ?>
										<tr><td colspan="3"><h4 style="text-align:center;">No hay nuevas acciones...</h4></td></tr>
									<?php } ?>
				                </tbody>
				            </table>
				        </div>
				    </div>
				    <?php if (isset($rbacNuevos) && count($rbacNuevos)) { ?>
				    <div class="col-md-12" style="text-align:left;">
				    	<button onClick="guardar()" type="button" class="btn btn-primary" title="Guardar"><span class="glyphicon glyphicon-check"> </span>Guardar</button>
				    </div>
				    <?php } ?>
				</div>
			</div>
			<div class="modal-footer" style="clear:both;">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
<?php	
    //echo $this->Html->css('bootstrap-switch.min.css');
    //echo $this->Html->script('bootstrap-switch.min.js');
?>


<script type="text/javascript">
$(function() {

    $('.tree').treegrid({'initialState':'collapsed'});
    //$('#headerTable .switch').bootstrapSwitch();
    desactivar_filas(); 
    $('#marcar a').click(function() {
    	var row = $(this).attr('id');
        $('input[name="'+row+'"]').each(function(){
            if(this.checked){
            	this.checked = false;
            }else{
            	this.checked = true;
            }
        })
   });

   
    
});

function desactivar_filas() {
	$('input#heredado').each(function() {
		var myFila = $(this).closest('td').attr('class');
		var myOpcion = $(this).bootstrapSwitch('state');
		//console.log(myFila+" - "+myOpcion);
		$('td.'+myFila+' input').each(function() {
			if ($(this).attr('id') != 'heredado') {
				if (myOpcion == true) {
					$(this).bootstrapSwitch('readonly', true);
					//$(this).attr('disabled',true);
				} else {
					$(this).bootstrapSwitch('readonly', false);
					//$(this).attr('disabled',false);
				}
			}			
		});
	});
}

//$('.switch').on('switchChange.bootstrapSwitch', function(event, state) {
	
$('#headerTable .switch').bootstrapSwitch({onSwitchChange: function(event, state) {
        
    var accion_id = event.currentTarget.attributes.dataid.nodeValue;
    var atributo_id = event.currentTarget.attributes.id.nodeValue;
    var valor = (state==true) ? 1 : 0 ;
    var pariente = event.currentTarget.attributes.parentid.nodeValue;
    var miFila = $(this).closest('td').attr('class');
    /*$.ajax({        
        url: "/rbac/rbac_acciones/switchAccion/",
        type: 'POST',
        dataType: 'json',
        data: {'accion_id': accion_id, 'atributo_id': atributo_id, 'valor': valor},
        success: function (data) {
            console.log(data);
        }
    });*/
    actualizar(accion_id,atributo_id,valor);
  	if (atributo_id == 'heredado' && valor==true) {
		$('tr.treegrid-parent-'+pariente+' td.'+miFila+' input').each(function() {
			var myId = $(this).attr('id');
			if (myId != undefined && myId != 'heredado') {
				var myAccion = $(this).attr('data-id');
				var myValor = $('tr.treegrid-'+pariente+' td input#'+myId).bootstrapSwitch('state');
				//if (valor != myValor) {
					$(this).bootstrapSwitch('state',myValor);
					actualizar(myAccion,atributo_id,myValor);
				//}
			}
		});
  	} else if (atributo_id != 'heredado' && $(this).closest('tr').hasClass('treegrid-expanded')) {
  		//var myId = $(this).attr('id');
  		//var myValor = $(this).bootstrapSwitch('state');
  		$('tr.treegrid-parent-'+pariente+' td input#heredado').each(function() {
			//console.log($(this).bootstrapSwitch('state'));
			if ($(this).bootstrapSwitch('state')==true) {
				var idFila = $(this).closest('td').attr('class');
				$('tr.treegrid-parent-'+pariente+' td.'+idFila+' input').each(function() {
					if ($(this).attr('id') == atributo_id) {
						if (valor != $(this).bootstrapSwitch('state')) {
							//var myAccion = $(this).attr('data-id');
							$(this).bootstrapSwitch('readonly', false);
							$(this).bootstrapSwitch('state', valor);
							actualizar(accion_id,atributo_id,valor);
						}
					}
				});
			} else {
				actualizar(accion_id,atributo_id,valor);
			}
  		});
	}
  	desactivar_filas();
  	
}});

function actualizar(accion_id,atributo_id,valor) {
	if (accion_id != null) {
		$.ajax({        
	        url: "/rbac/rbac_acciones/switchAccion/",
	        type: 'POST',
	        dataType: 'json',
	        data: {'accion_id': accion_id, 'atributo_id': atributo_id, 'valor': valor},
	        success: function (data) {
	            //console.log(data);
	        }
		});
	}
}
    
function eliminar(id){
    bootbox.confirm("Está seguro de eliminar la Acción #"+id+"?", function(result) {
        if (result)
        {
            document.location.href = "/rbac/RbacAcciones/delete/"+id;
        }  
    });
}

function sincronizar() {
	$("#myModal").modal("show");
	//$('#headerTable2 .switch2').bootstrapSwitch();
}

function guardar() {
	var atributo_id;
	var accion_id;
	var grabado;
	var miArray = [];
	$('#headerTable2 .checkbox').each(function() {
		if (this.checked) {
			atributo_id = $(this).attr('data-controller');
			accion_id = $(this).attr('data-action');
			valor = $(this).val();
			var item = atributo_id+";"+accion_id+";"+valor;
			miArray.push(item);
		}
	});
	if (miArray) {	
		$.ajax({        
	        url: "/rbac/rbac_acciones/sincronizar/",
	        type: 'POST',
	        dataType: 'json',
	        data: {'miArray':miArray},
	        success: function (data) {
	            if (data) document.location.href = "/rbac/RbacAcciones/";
	        }
		});
	}
}

function limpiar(){   
    document.location.href = "/rbac/RbacAcciones/";
 
}

</script>