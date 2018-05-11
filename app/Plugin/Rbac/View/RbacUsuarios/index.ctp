<?php  
        $usuario_activo = $this->Session->read('RbacUsuario');
        
        
        $perfilDefault =   $this->Session->read('PerfilDefault');
        $area =   $this->Session->read('Area');
        $accionesPermitidasPorPerfiles = $this->Session->read('RbacAcciones');		
        $accionesPermitidas = $accionesPermitidasPorPerfiles[$perfilDefault];	
        $perfilesPorUsuario = $this->Session->read('PerfilesPorUsuario');	
?>
<span id="mensajes"></span>
    <div class="col-md-8">
        <h3 class='sub-header' >
        <span class="glyphicon glyphicon-th-list"></span>                      
        Usuarios
          <?php if(isset($accionesPermitidas['rbac_usuarios']['add']) && $accionesPermitidas['rbac_usuarios']['add']) {?>
	         <a href="/rbac/rbac_usuarios/add/" class="btn btn-default navbar-right">        
	         <span class="glyphicon glyphicon-plus-sign"></span>Agregar Usuario</a>
	      <?php } ?>   
        </h3>      
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>                        
                        <th><?php echo $this->Paginator->sort('RbacUsuario.nombre','Nombre', array('Model'=>'RbacUsuario'));?></th>
                        <th><?php echo $this->Paginator->sort('RbacUsuario.apellido','Apellido', array('Model'=>'RbacUsuario'));?></th>
                        <th><?php echo $this->Paginator->sort('RbacUsuario.usuario','Usuario', array('Model'=>'RbacUsuario'));?></th>                                       
                        <th><?php echo 'Perfil por Defecto' 
                        //echo $this->Paginator->sort('RbacPerfil.descripcion','Login', array('Model'=>'RbacUsuario'));?>
                        </th>
                       <?php if((isset($accionesPermitidas['rbac_usuarios']['edit']) && $accionesPermitidas['rbac_usuarios']['edit'])
                       		|| (isset($accionesPermitidas['rbac_usuarios']['delete']) && $accionesPermitidas['rbac_usuarios']['delete'])) {?>
                        <th class="text-center">Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rbacUsuarios as $rbacUsuario): ?>
                        <tr>                                                       
                            <td><?php echo $rbacUsuario['RbacUsuario']['nombre']; ?></td>
                            <td><?php echo $rbacUsuario['RbacUsuario']['apellido']; ?></td>
                            <td><?php echo $rbacUsuario['RbacUsuario']['usuario']; ?></td>
                            <td><?php echo $rbacUsuario['PerfilDefault']['descripcion']; ?></td>
                            <td>
                                <div class="text-center">
                                  <?php if(isset($accionesPermitidas['rbac_usuarios']['edit']) && $accionesPermitidas['rbac_usuarios']['edit']) {?>
                                    <a href="/rbac/RbacUsuarios/edit/<?php echo $rbacUsuario['RbacUsuario']['id']; ?>" type="button" class="btn btn-primary btn-xs" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                                   <?php } ?>                                     
                                   <?php if(isset($accionesPermitidas['rbac_usuarios']['delete']) && $accionesPermitidas['rbac_usuarios']['delete']) {?>
                                    <button onClick="eliminar(<?php echo $rbacUsuario['RbacUsuario']['id'].",".$usuario_activo['id']; ?>)" type="button" class="btn btn-danger btn-xs" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>
                                    <?php }?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
             <br />
            <div style="text-align:center; width:100%;">		        
		        <?php
		        $pager_params = $this->Paginator->params();
		        if($pager_params['pageCount'] > 1){
		        	echo $this->Paginator->prev('<b>ANTERIOR</b>', array('escape'=> false,'class'=> 'btn btn-default'), null, array('escape'=> false,'class' => 'btn btn-default prev disabled'));
		            echo $this->Paginator->counter(' ( {:page} / {:pages} ) ');
		        	echo $this->Paginator->next('<b>SIGUIENTE</b>',array('escape'=> false,'class'=> 'btn btn-default'), null, array('escape'=> false,'class' => 'btn btn-default next disabled'));
		        }
		        ?>  		        
		    </div>
        </div>
    </div>
     <div class="col-md-4" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="formCons" id="formCons" action="/rbac/RbacUsuarios/" method="POST">
            <div class="well">
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">                
                Consulta Usuarios</h4>
                <hr>                                
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="form-control" value="<?php echo $nombre;?>" >                
                    </div>
                </div>                
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="apellido" name="apellido" placeholder="Apellido" class="form-control" value="<?php echo $apellido;?>" >                
                    </div>
                </div>                
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="login" name="usuario" placeholder="Usuario" class="form-control" value="<?php echo $usuario;?>" >                
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
            </div>
        </form>
    </div>

<script type="text/javascript">
$(function () {
	$('.alert-success, .alert-danger').fadeOut(3000);
});
function eliminar(id,usr_activo){
	if(id==usr_activo){
		bootbox.confirm("Está seguro de eliminar su usuario? No podra ingresar de vuelta al sistema.", function(result) {
	        if (result){
	            document.location.href = "/rbac/RbacUsuarios/delete/"+id+"/1";
	        }
	    });
	}else{
	    bootbox.confirm("Está seguro de eliminar el usuario # "+id+"?", function(result) {
	        if (result){
	            document.location.href = "/rbac/RbacUsuarios/delete/"+id;
	        }
	    });
	}   
}

function limpiar(){
    document.location.href = "/rbac/RbacUsuarios/"; 
}
</script>