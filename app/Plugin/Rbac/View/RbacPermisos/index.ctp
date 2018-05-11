<?php
$usuario_activo = $this->Session->read('RbacUsuario');
$perfilDefault = $this->Session->read('PerfilDefault');
$area = $this->Session->read('Area');
$accionesPermitidasPorPerfiles = $this->Session->read('RbacAcciones');
$accionesPermitidas = $accionesPermitidasPorPerfiles[$perfilDefault];
$perfilesPorUsuario = $this->Session->read('PerfilesPorUsuario');
?>
<span id="mensajes"></span>
<div class="col-md-12">
    <h3 class='sub-header' >
        <span class="glyphicon glyphicon-th-list"></span>                      
        Permisos VirtualHost
        <!--<?php if (isset($accionesPermitidas['rbac_permisos']['add']) && $accionesPermitidas['rbac_permisos']['add']) { ?>
                   <a href="/rbac/rbac_permisos/add/" class="btn btn-default navbar-right">        
                   <span class="glyphicon glyphicon-plus-sign"></span>Agregar Permiso</a>
        <?php } ?>-->   
    </h3>      
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>                        
                    <th><?php echo $this->Paginator->sort('RbacPermiso.permiso', 'Permiso', array('Model' => 'RbacPermiso')); ?></th>
                    <th><?php echo $this->Paginator->sort('RbacPermiso.url', 'URL', array('Model' => 'RbacUsuario')); ?></th>                                       
                    <?php if ((isset($accionesPermitidas['rbac_permisos']['edit']) && $accionesPermitidas['rbac_permisos']['edit']) || (isset($accionesPermitidas['rbac_permisos']['delete']) && $accionesPermitidas['rbac_permisos']['delete'])) {
                        ?>
                        <th class="text-center">Acciones</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rbacPermisos as $rbacPermiso): ?>
                    <tr>                                                       
                        <td><?php echo $rbacPermiso['PermisosVirtualHost']['permiso']; ?></td>
                        <td><?php echo $rbacPermiso['PermisosVirtualHost']['url']; ?></td>
                        <td>
                            <div class="text-center">
                                <?php if (isset($accionesPermitidas['rbac_permisos']['edit']) && $accionesPermitidas['rbac_permisos']['edit']) { ?>
                                    <a href="/rbac/RbacPermisos/edit/<?php echo $rbacPermiso['PermisosVirtualHost']['id']; ?>" type="button" class="btn btn-primary btn-xs" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>
                                <?php } ?>                                     
                                <!--<?php if (isset($accionesPermitidas['rbac_permisos']['delete']) && $accionesPermitidas['rbac_permisos']['delete']) { ?>
                                     <button onClick="eliminar(<?php echo $rbacPermiso['PermisosVirtualHost']['id']; ?>)" type="button" class="btn btn-danger btn-xs" title="Eliminar"><span class="glyphicon glyphicon-remove"></span></button>
                                <?php } ?>-->
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
            if ($pager_params['pageCount'] > 1) {
                echo $this->Paginator->prev('<b>ANTERIOR</b>', array('escape' => false, 'class' => 'btn btn-default'), null, array('escape' => false, 'class' => 'btn btn-default prev disabled'));
                echo $this->Paginator->counter(' ( {:page} / {:pages} ) ');
                echo $this->Paginator->next('<b>SIGUIENTE</b>', array('escape' => false, 'class' => 'btn btn-default'), null, array('escape' => false, 'class' => 'btn btn-default next disabled'));
            }
            ?>  		        
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('.alert-success, .alert-danger').fadeOut(3000);
    });
    function eliminar(id) {
        bootbox.confirm("Está seguro de eliminar el permiso # " + id + "?", function(result) {
            if (result) {
                document.location.href = "/rbac/RbacPermisos/delete/" + id;
            }
        });
    }
</script>