<?php //debug($accionesAsignadas); ?>

<h3 class="sub-header">
    <span class="glyphicon glyphicon-credit-card"></span>
    <small>Editar Perfil</small>
    <a class="btn btn-default navbar-right" href="/rbac/rbac_perfiles/">
        <span class="glyphicon glyphicon-arrow-left"></span>
        Volver a la lista</a>
</h3>

<div class="col-md-10">
    <fieldset>
        <form accept-charset="utf-8" class="form-horizontal" id="RbacPerfilesEditForm" name="RbacPerfilesEditForm" role="form" action="/rbac/rbac_perfiles/edit/<?php echo $this->data['RbacPerfil']['id']; ?>" method="POST">
            <input type="hidden" value="POST" name="_method">
            <div class="form-group">
                <label for="descripcion" class="col-sm-2 control-label">Descripción</label>
                <div class="col-sm-10">
                    <input type="hidden" required="required" id="RbacPerfilesDescripcion" value="<?php echo $this->data['RbacPerfil']['id']; ?>" placeholder="Descripción" class="form-control" name="data[RbacPerfil][id]">
                    <input type="text" required="required" id="RbacPerfilesDescripcion" value="<?php echo $this->data['RbacPerfil']['descripcion']; ?>" placeholder="Descripción" class="form-control" name="data[RbacPerfil][descripcion]">
                </div>
            </div>
            
            <div class="form-group form-inline">
                <label for="usa_area_representacion" class="col-sm-2 control-label">Usa Área/Repre.</label>
                <div class="col-sm-10">                                            
                    <div class="radio">
                        <label>
                            <input type="radio" name="data[RbacPerfil][usa_area_representacion]" id="optionsRadios" value="1"
                            <?php if ($this->data['RbacPerfil']['usa_area_representacion']) echo "checked"; ?>		
                                   >
                            Si
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="data[RbacPerfil][usa_area_representacion]" id="optionsRadios" value="0" 
                            <?php if (!$this->data['RbacPerfil']['usa_area_representacion']) echo "checked"; ?>
                                   >
                            No
                        </label>
                    </div>
                </div>                            
            </div>
            
            <div class="form-group form-inline">
                <label for="es_default" class="col-sm-2 control-label">Perfil Default</label>
                <div class="col-sm-10">                                            
                    <div class="radio">
                        <label>
                            <input type="radio" name="data[RbacPerfil][es_default]" id="optionsEsDefault" onclick="changeRadio(1);" value="1"
                            <?php if ($this->data['RbacPerfil']['es_default']) echo "checked"; ?>		
                                   >
                            Si
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="data[RbacPerfil][es_default]" id="optionsEsDefault" onclick="changeRadio(0);" value="0" 
                            <?php if (!$this->data['RbacPerfil']['es_default']) echo "checked"; ?>
                                   >
                            No
                        </label>
                    </div>
                </div>                            
            </div>
            
            
            <div class="form-group" >
                <label for="vh" class="col-sm-2 control-label">Virtual Host</label>
                <div class="controls col-sm-3">  
                    <select id="vh" name="data[RbacPerfil][permiso_virtual_host_id]" class="form-control" required="required">
                       
                        
                    </select>
                </div>
            </div>
            
            <div class="form-group well" style="margin-left: 35px"  id="dual-list">            
                <!-- input type="hidden" id="RbacAcciones_" value="" name="data[RbacAccion][]"-->
                <select id="RbacAcciones" name="data[RbacAccion][]" class="form-control" multiple="multiple">
                    <!-- Carga automatica-->
                    <?php foreach ($accionesPosibles as $accion): ?>                                                   
                        <option value="<?php echo $accion['RbacAccion']['id']; ?>" ><?php echo $accion['RbacAccion']['controller'] . "=>" . $accion['RbacAccion']['action']; ?></option>                            
                    <?php endforeach; ?>
                    <?php foreach ($accionesAsignadas as $accion): ?>                            
                        <option value="<?php echo $accion['id']; ?>" selected><?php echo $accion['controller'] . "=>" . $accion['action']; ?></option>                            
                    <?php endforeach; ?>
                </select>
            </div>
        
            <div class="form-group" >
                <label for="ca-inicio" class="col-sm-2 control-label">Página de inicio</label>
                <div class="controls col-sm-5">  
                    <select id="ca-inicio" name="data[RbacPerfil][accion_default_id]" class="form-control" required="required">
                        <!-- Carga automatica segun virtual host-->
                        <option value="">Seleccionar  Página Inicio</option>
                        <?php foreach ($accionesAsignadas as $ra) {?>                            
                            <?php if ($this->data['RbacPerfil']['accion_default_id'] == $ra['id']) { ?>
                                <option selected="selected" value="<?php echo $ra['id']; ?>"><?php echo $ra['controller'] .'=>'. $ra['action']; ?></option>
                            <?php } else { ?>                                
                                <option value="<?php echo $ra['id']; ?>"><?php echo $ra['controller'] .'=>'. $ra['action']; ?></option>
                            <?php } ?>    
                        <?php } ?>
                    </select>
                </div>                                     
            </div>
            
            
            <div class="form-group pull-right">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-primary" onclick="enviar();">
                        <span class="glyphicon glyphicon-check"></span>
                        Guardar</button>    
                </div>
            </div>                  
        </form>
    </fieldset>
</div>

<script type="text/javascript">
    $(function() {
        
        PermisosVirtualHostDisponiblesDefault = <?php echo json_encode($PermisosVirtualHostDisponiblesDefault);?>;
        PermisosVirtualHost = <?php echo json_encode($PermisosVirtualHost);?>;
        
        //carga del virtual host
        esDefault = <?php echo $this->data['RbacPerfil']['es_default'] ?>;        
        permiso_virtual_host_id = <?php echo $this->data['RbacPerfil']['permiso_virtual_host_id']; ?>;

        if(permiso_virtual_host_id == 5)
        {
            data = PermisosVirtualHost;
        } else {
            data = PermisosVirtualHostDisponiblesDefault;
        }
        
        if(esDefault == 1)
        {
            $('#dual-list').hide();
            
        } else {
            $('#dual-list').show();   
            
        }
        
        $('#vh').html('');
        var options = '<option value="">Seleccionar Virtual Host</option>';
        $.each(data, function(key, value){
            if(permiso_virtual_host_id == value.PermisosVirtualHost.id) {
                options = options + '<option value="' + value.PermisosVirtualHost.id + '" selected="selected">' + value.PermisosVirtualHost.permiso + '</option>';
            } else {
                options = options + '<option value="' + value.PermisosVirtualHost.id + '">' + value.PermisosVirtualHost.permiso + '</option>';
            }
        });
        $('#vh').html(options);
        
        
        var RbacAcciones = $('#RbacAcciones')
            .bootstrapDualListbox({
                bootstrap2Compatible: false,
                moveAllLabel: 'Asignar todas',
                removeAllLabel: 'Eliminar todas',
                moveSelectedLabel: 'MOVE SELECTED',
                removeSelectedLabel: 'REMOVE SELECTED',
                filterPlaceHolder: 'Buscar',
                filterSelected: '2',
                filterNonSelected: '1',
                moveOnSelect: false,
                preserveSelectionOnMove: 'all',
                helperSelectNamePostfix: '_myhelper',
                selectedListLabel: 'Acciones Permitidas',
                nonSelectedListLabel: 'Acciones',
                selectOrMinimalHeight: 210
            })
            .bootstrapDualListbox('setMoveAllLabel', 'Mover todas las acciones')
            .bootstrapDualListbox('setRemoveAllLabel', 'Eliminar todas las acciones')
            .bootstrapDualListbox('setSelectedFilter', undefined)
            .bootstrapDualListbox('setNonSelectedFilter', undefined)
            //.append('<option>added element</option>')
            .bootstrapDualListbox('refresh');
        
        
        $("#vh").change(function() {        
            $.ajax({
                url: '/rbac/RbacPerfiles/getAccionesByVirtualHost/',
                cache: false,
                type: 'POST',
                dataType: 'json',                
                data: {virtualHost: $('option:selected', $(this)).text()},
                success: function (data) {                    
                	if(esDefault == 1)
                    {
                        //si deberia llenar el combo de acciones default directamente                        
                        $('#ca-inicio').html('');
                        var options = '<option value="">Seleccionar Controlador => Accion</option>';
                        $.each(data.acciones, function(key, value){
                            options = options + '<option value="' + value.rbac_acciones.id + '">' + value.rbac_acciones.controller + '=>' +value.rbac_acciones.action + '</option>';                        
                        });
                        $('#ca-inicio').html(options);
                        
                    } else {
                        //si deberia llenar el dual list
                        
                        RbacAcciones.html('');
                        var options = '';
                        $.each(data.acciones, function(key, value){
                            options = options + '<option value="' + value.rbac_acciones.id + '">' + value.rbac_acciones.controller + '=>' +value.rbac_acciones.action + '</option>';                        
                        });                    

                        RbacAcciones.append(options);
                        RbacAcciones.bootstrapDualListbox('refresh');
                    }
                }
            });
        });
        
        $("#RbacAcciones").change(function() {
            var select = $('[name="data[RbacPerfil][accion_default_id]"]');
            $('option', select).remove();
            $('[name="data[RbacAccion][]_myhelper2"]').find('option').each(function(index, item) {
                var $item = $(item);
                //console.log($item.val()+" - "+$item.text());
                select.append('<option value="' + $item.val() + '">' + $item.text() + '</option>');
            });
            $('[name="data[RbacPerfil][accion_default_id]"] option:first').attr('selected', 'selected');

            //select.prop('selectedIndex', 0);
        }); 
        
    });
    
    function enviar()
    { 
        var ff = $('select[name="data[RbacAccion][]"]').bootstrapDualListbox();
            
        $("#RbacPerfilesEditForm").append('<input type="hidden" name="RbacAccionAux" value="'+ff.val()+'" /> ');
        
        $("#RbacPerfilesEditForm").submit();       
        
    }
    
    function changeRadio(value)
    {
        //reseteo todo
        $('#ca-inicio').html('');
        $('#RbacAcciones').html('');
        $('[name="data[RbacPerfil][permiso_virtual_host_id]"]').val('');
        
        //indica donde se debe cargar cuando se haga un cambio en el virtual host si en el duallist o en el combo de default accion
        esDefault = value;
        
        data = null;
        
        if (value == 1)
        {
            //ocultar acciones dual list
            $('#dual-list').hide();
            data = PermisosVirtualHostDisponiblesDefault;
            //cargar $('#vh') con los virtual host disponibles es decir con $PermisosVirtualHostDisponiblesDefault
            
        } else {
            //mostrar dual list
            $('#dual-list').show();   
            
            data = PermisosVirtualHost;
            
            //cargar $('#vh') $PermisosVirtualHost
        }
        
        
        $('#vh').html('');
        var options = '<option value="">Seleccionar Virtual Host</option>';
        $.each(data, function(key, value){
            options = options + '<option value="' + value.PermisosVirtualHost.id + '">' + value.PermisosVirtualHost.permiso + '</option>';                        
            //console.log(value.PermisosVirtualHost.permiso);
        });
        $('#vh').html(options);
        
    }
    
    
</script>