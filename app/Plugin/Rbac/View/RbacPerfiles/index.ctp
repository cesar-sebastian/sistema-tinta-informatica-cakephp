<?php 
   $perfilDefault =   $this->Session->read('PerfilDefault');
   $accionesPermitidasPorPerfiles = $this->Session->read('RbacAcciones');
   $accionesPermitidas = $accionesPermitidasPorPerfiles[$perfilDefault];
?>
<span id="mensajes"></span>
    <div class="col-md-8">
         <h3 class='sub-header' >
        <span class="glyphicon glyphicon-th-list"></span>   
        Perfiles
         <?php if(isset($accionesPermitidas['rbac_perfiles']['add']) && $accionesPermitidas['rbac_perfiles']['add']) {?>
	         <a href="/rbac/RbacPerfiles/add/" class="btn btn-default navbar-right">        
	        <span class="glyphicon glyphicon-plus-sign"></span> Agregar Perfil</a>
         <?php } ?>   
        </h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>                        
                        <th>Perfil</th>  
                        <th>Permiso Virtual Host</th>  
                        <th>Perfil default</th>  
                        <?php if((isset($accionesPermitidas['rbac_perfiles']['edit']) && $accionesPermitidas['rbac_perfiles']['edit'])
                       		|| (isset($accionesPermitidas['rbac_perfiles']['delete']) && $accionesPermitidas['rbac_perfiles']['delete'])) { ?>
                        <th class="text-center">Acciones</th>
                        <?php } ?>                                                                      
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rbacPerfiles as $rbacPerfil): ?>
                        <tr>                            
                            <td><?php echo $rbacPerfil['RbacPerfil']['descripcion']; ?></td>                            
                            <td><?php echo $rbacPerfil['PermisosVirtualHost']['permiso']; ?></td>
                            <td><?php echo ($rbacPerfil['RbacPerfil']['es_default'] == 1) ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>' ; ?></td>
                            <td>
                                <div class="text-center" >
                                <?php if(isset($accionesPermitidas['rbac_perfiles']['edit']) && $accionesPermitidas['rbac_perfiles']['edit']) {?>
                                    <a href="/rbac/rbac_perfiles/edit/<?php echo $rbacPerfil['RbacPerfil']['id']; ?>" type="button" class="btn btn-primary btn-xs" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                                <?php } ?>                                        
                                <?php if(isset($accionesPermitidas['rbac_perfiles']['delete']) && $accionesPermitidas['rbac_perfiles']['delete']) {?>
                                    <button onClick="eliminar(<?php echo $rbacPerfil['RbacPerfil']['id']; ?>)" type="button" class="btn btn-danger btn-xs" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>
                                <?php } ?>    
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4 well" style="margin-top: 10px;">
        <form autocomplete="off" name="formCons" class="form-horizontal" id="formCons" action="/rbac/RbacPerfiles/" method="POST">            
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Consulta Perfiles</h4>
                <hr>                                               
                 <div class="form-group">
                    <div class="col-sm-12 ">                        
                        <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Perfil" value="<?php echo $descripcion;?>" >
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


<script type="text/javascript">    
function eliminar(id){
    bootbox.confirm("Está seguro de eliminar el Perfil #"+id+"?", function(result) {
        if (result)        {
            document.location.href = "/rbac/rbac_perfiles/delete/"+id;
        }  
    });
}

function limpiar(){   
    document.location.href = "/rbac/RbacPerfiles/";
}
</script>