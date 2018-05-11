<h3 class="sub-header">
    <span class="glyphicon glyphicon-user"></span>		
    <small>Editar Usuario</small>
    <a class="btn btn-default navbar-right" href="/rbac/RbacUsuarios/">
        <span class="glyphicon glyphicon-arrow-left"></span>
        Volver a la lista</a>
</h3>
<div class="col-md-10">       
    <form accept-charset="utf-8" class="form-horizontal" id="RbacUsuarioEditForm" name="RbacUsuarioEditForm" role="form" action="/rbac/RbacUsuarios/edit/<?php echo $this->data['RbacUsuario']['id']; ?>" method="POST">

        <div class="form-group">
            <label for="login" class="col-sm-2 control-label">Usuario</label>
            <div class="col-sm-10">                        
                <input type="hidden" class="form-control" name="data[RbacUsuario][id]" value="<?php echo $this->data['RbacUsuario']['id']; ?>" readonly>                        						
                <input required="required" type="text" placeholder="Usuario" class="form-control" name="data[RbacUsuario][usuario]" value="<?php echo $this->data['RbacUsuario']['usuario']; ?>" readonly>
            </div>
        </div>   
        <?php if (!$this->data['RbacUsuario']['id']) { ?>
            <div class="form-group" id="contrasenia-group">
                <label for="a" class="col-sm-2 control-label">Contraseña</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="data[RbacUsuario][password]" id="contrasenia" placeholder="Contraseña" >                        
                </div>
            </div>        
        <?php } ?>

        <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">                        
                <input type="text" placeholder="Nombre" class="form-control" name="data[RbacUsuario][nombre]"  value="<?php echo $this->data['RbacUsuario']['nombre']; ?>" >
            </div>
        </div>                              
        <div class="form-group">
            <label for="apellido" class="col-sm-2 control-label">Apellido</label>
            <div class="col-sm-10">                        
                <input type="text" placeholder="Apellido" class="form-control" name="data[RbacUsuario][apellido]" value="<?php echo $this->data['RbacUsuario']['apellido']; ?>" >
            </div>
        </div>                
        <div class="form-group">                                        
            <input type="hidden" id="RbacPerfiles_" value="" name="data[RbacPerfil]">
            <label for="RbacPerfiles" class="col-sm-2 control-label">Perfil</label>

            <div class="col-sm-3">                    
                <select required="required" id="RbacPerfiles" name="data[RbacPerfil][]" class="form-control" multiple="multiple" >
                    <?php foreach ($RbacPerfiles as $perfil): ?>                            
                        <?php if (in_array($perfil['RbacPerfil']['id'], $RbacPerfilesIds)) { ?>                            
                            <option value="<?php echo $perfil['RbacPerfil']['id']; ?>" selected="selected"><?php echo $perfil['RbacPerfil']['descripcion']; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $perfil['RbacPerfil']['id']; ?>"><?php echo $perfil['RbacPerfil']['descripcion']; ?></option>
                        <?php } ?>
                    <?php endforeach; ?>
                </select>      
            </div>     
        </div> 

        <div class="form-group">                                                            
            <label for="RbacUsuarioPerfilDefault" class="col-sm-2 control-label">Perfil Default</label>
            <div class="col-sm-5">
                <select required="required" id="RbacUsuarioPerfilDefault" name="data[RbacUsuario][perfil_default]" class="form-control">   
                    <?php $perfilDefault = $this->Session->read('PerfilDefault'); ?>                       
                    <?php foreach ($RbacPerfiles as $perfil): ?>
                        <?php if (in_array($perfil['RbacPerfil']['id'], $RbacPerfilesIds)) { ?>
                            <?php if ($perfilDefault != $perfil['RbacPerfil']['id']) { ?>
                                <option value="<?php echo $perfil['RbacPerfil']['id']; ?>"><?php echo $perfil['RbacPerfil']['descripcion']; ?></option>
                            <?php } else { ?>
                                <option selected="selected" value="<?php echo $perfil['RbacPerfil']['id']; ?>"><?php echo $perfil['RbacPerfil']['descripcion']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    <?php endforeach; ?>

                </select>

            </div>     
        </div>     

        <div class="form-group pull-right">
            <div class="col-sm-offset-2 col-sm-10">                                        
                <button type="button" class="btn btn-primary" onclick="guardar()">
                    <span class="glyphicon glyphicon-check"></span>
                    Guardar</button>                      
            </div>
        </div>                                                                                                      
    </form>

</div>


<script type="text/javascript">
    $(function() {
        inicialize();        
    });

    function inicialize() 
    {
        $('#RbacPerfiles').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            filterPlaceholder: 'Buscar',
            onChange: function(element, checked) {
                if (checked) {
                    //agregar en el select                     
                    $('#RbacUsuarioPerfilDefault').append('<option value="' + element.val() + '" >' + element.text() + '</option>');
                } else {
                    $("#RbacUsuarioPerfilDefault").find("option[value='" + element.val() + "']").remove();
                }
            }            
        });
        
        $.validator.addMethod('correo', function(value, element, param) {
            return this.optional(element) || /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/.test(value);
        });
        validar_form();

    }
    
    function validar_form()
    {
        $('#RbacUsuarioEditForm').validate({
            rules: {               
                'data[RbacPerfil]': {
                    required: true
                },
                'data[RbacUsuario][perfil_default]': {
                    required: true
                }
            },
            messages: {
                'data[RbacUsuario][usuario]': {
                    correo: "El usuario ingresado debe ser la dirección del correo"
                }
            },
            highlight: function(element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            }
        });        
    }

    function guardar() 
    {
        if ($('#RbacUsuarioEditForm').valid()) 
        { 
            $('#RbacUsuarioEditForm').submit();
        }
    }
</script>