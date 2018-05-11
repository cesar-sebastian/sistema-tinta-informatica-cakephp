<h3 class="sub-header">
    <span class="glyphicon glyphicon-credit-card"></span>
    <small>Nuevo Perfil</small>
    <a class="btn btn-default navbar-right" href="/rbac/RbacPerfiles/">
        <span class="glyphicon glyphicon-arrow-left"></span>
        Volver a la lista</a>
</h3>
<div class="col-md-10">                                                       
    <form class="form-horizontal" id="RbacPerfilAddForm" role="form" action="/rbac/RbacPerfiles/add/" method="POST">
        <div class="form-group">
            <label for="login" class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">                        
                <input type="text" required="required" id="RbacPerfilDescripcion" placeholder="Descripción" class="form-control" name="data[RbacPerfil][descripcion]" />
            </div>
        </div>
        
        <div class="form-group form-inline">
            <label for="usa_area_representacion" class="col-sm-2 control-label">Usa Área/Repre.</label>
            <div class="col-sm-10">                                            
                <div class="radio">
                    <label>
                        <input type="radio" name="data[RbacPerfil][usa_area_representacion]" id="optionsRadios" value="1" />
                        Si
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="data[RbacPerfil][usa_area_representacion]" id="optionsRadios" value="0" checked />
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
                        <input type="radio" name="data[RbacPerfil][es_default]" id="optionsEsDefault" value="1" onclick="changeRadio(1);" />
                        Si
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="data[RbacPerfil][es_default]" id="optionsEsDefault" value="0" onclick="changeRadio(0);" checked />
                        No
                    </label>
                </div>
            </div>                            
        </div>        
        
        <div class="form-group" >
            <label for="vh" class="col-sm-2 control-label">Virtual Host</label>
            <div class="controls col-sm-3">  
                <select id="vh" name="data[RbacPerfil][permiso_virtual_host_id]" class="form-control" required="required">
                    <!-- Carga automatica-->                        
                </select>
            </div>
        </div>
        
        <div class="form-group well" style="margin-left: 35px"  id="dual-list">  
            <input type="hidden" id="RbacAcciones_" value="" name="data[RbacAccion][]">
            <select id="RbacAcciones" name="data[RbacAccion][]" class="form-control" multiple="multiple">
                <!-- Carga automatica-->
            </select>
        </div>
        
        <div class="form-group" >
            <label for="ca-inicio" class="col-sm-2 control-label">Página de inicio</label>
            <div class="controls col-sm-5">  
                <select id="ca-inicio" name="data[RbacPerfil][accion_default_id]" class="form-control" required="required">
                    <!-- Carga automatica-->
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
</div>
<script type="text/javascript">
    $(function() {    
        
        PermisosVirtualHostDisponiblesDefault = <?php echo json_encode($PermisosVirtualHostDisponiblesDefault);?>;
        PermisosVirtualHost = <?php echo json_encode($PermisosVirtualHost);?>;
        
        esDefault = 0;
        
        //como aparece en no, cargar combo virtual host con PermisosVirtualHost
        $('#vh').html('');
        var options = '<option value="">Seleccionar Virtual Host</option>';
        $.each(PermisosVirtualHost, function(key, value){
            options = options + '<option value="' + value.PermisosVirtualHost.id + '">' + value.PermisosVirtualHost.permiso + '</option>';
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
            .bootstrapDualListbox('refresh', true);
        
        $("#vh").change(function() {
            
            $.ajax({
                url: '/rbac/RbacPerfiles/getAccionesByVirtualHost/',
                cache: false,
                type: 'POST',
                dataType: 'json',                
                data: {virtualHost: $('option:selected', $(this)).text()},
                success: function (data) {        
                    
                    //esto va a depender del valor de $('[name="data[RbacPerfil][es_default]"]')
                    if (esDefault == 1)
                    {
                        //si deberia llenar el combo de acciones default directamente                        
                        $('#ca-inicio').html('');
                        var options = '<option value="">Seleccionar Controlador => Accion</option>';
                        $.each(data.acciones, function(key, value){
                            options = options + '<option value="' + value.rbac_acciones.id + '">' + value.rbac_acciones.controller + ' => ' +value.rbac_acciones.action + '</option>';                        
                        });
                        $('#ca-inicio').html(options);
                        
                    } else {
                        //si deberia llenar el dual list
                        
                        RbacAcciones.html('');
                        var options = '';
                        $.each(data.acciones, function(key, value){
                            options = options + '<option value="' + value.rbac_acciones.id + '">' + value.rbac_acciones.controller + ' => ' +value.rbac_acciones.action + '</option>';                        
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
        
        
        /*$("#RbacPerfilAddForm").submit(function() {
            alert($("#RbacAcciones").val());
            return false;
          });*/
        
        
    });
    
    function enviar()
    { 
        var ff = $('select[name="data[RbacAccion][]"]').bootstrapDualListbox();
            
        $("#RbacPerfilAddForm").append('<input type="hidden" name="RbacAccionAux" value="'+ff.val()+'" /> ');
        
        $("#RbacPerfilAddForm").submit();
        
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