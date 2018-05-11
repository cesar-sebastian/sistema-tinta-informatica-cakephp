<h3 class="sub-header">
    <span class="glyphicon glyphicon-user"></span>
    <small>Nuevo Usuario</small>
    <a class="btn btn-default navbar-right" href="/rbac/rbac_usuarios/">
        <span class="glyphicon glyphicon-arrow-left"></span>
        Volver a la lista</a>
</h3>
<div class="col-md-10">        
    <form class="form-horizontal" id="RbacUsuariosAddForm" name="RbacUsuariosAddForm" role="form" action="/rbac/rbac_usuarios/add/" method="POST">
        <div class="form-group">
            <label for="usuario" class="col-sm-2 control-label">Usuario</label>
            <div class="col-sm-10">                        
                <input type="text" autocomplete="off" id="RbacUsuarioUsuario" placeholder="Ingrese el usuario" class="form-control" name="data[RbacUsuario][usuario]">
            </div>
        </div>

        <div class="form-group">
            <label for="a" class="col-sm-2 control-label">Contraseña</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="data[RbacUsuario][password]" id="contrasenia" placeholder="Contraseña" >                        
            </div>
        </div>                

        <div class="form-group">
            <label for="a" class="col-sm-2 control-label">Reingrese Contraseña</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="contrasenia2" id="contrasenia2" placeholder="Reingrese Contraseña" >                        
            </div>
        </div>  

        <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">                        
                <input type="text" id="RbacUsuarioNombre" placeholder="Nombre" class="form-control" name="data[RbacUsuario][nombre]" >
            </div>
        </div>

        <div class="form-group">
            <label for="apellido" class="col-sm-2 control-label">Apellido</label>
            <div class="col-sm-10">                        
                <input type="text" id="RbacUsuarioApellido" placeholder="Apellido" class="form-control" name="data[RbacUsuario][apellido]" >
            </div>
        </div>

        <div class="form-group">                                        
            <input type="hidden" id="RbacPerfiles_" value="" name="data[RbacPerfil]">
            <label for="RbacPerfiles" class="col-sm-2 control-label">Perfil</label>
            <div class="col-sm-5">
                <select required="required" id="RbacPerfiles" name="data[RbacPerfil][]" class="form-control" multiple="multiple">                           
                    <?php foreach ($RbacPerfiles as $perfil): ?>
                        <option value="<?php echo $perfil['RbacPerfil']['id']; ?>"><?php echo $perfil['RbacPerfil']['descripcion']; ?></option>
                    <?php endforeach; ?>
                </select>

            </div>     
        </div>   

        <div class="form-group">                                                            
            <label for="RbacUsuarioPerfilDefault" class="col-sm-2 control-label">Perfil Default</label>
            <div class="col-sm-5">
                <select required="required" id="RbacUsuarioPerfilDefault" name="data[RbacUsuario][perfil_default]" class="form-control">
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
                    //eliminar del select
                    $("#RbacUsuarioPerfilDefault").find("option[value='" + element.val() + "']").remove();
                }
            }
        });

        $.validator.addMethod('correo', function(value, element, param) {
            return this.optional(element) || /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/.test(value);
        });
        validar_form();

        //$('#contrasenia-group').show();
        //$('#RbacUsuarioUsuario').rules('add', 'correo');
        //$('#RbacUsuarioNombre').rules('add', 'required');
        //$('#RbacUsuarioNombre').val('');
        //$('#RbacUsuarioApellido').val('');
        //$('#RbacUsuarioUsuario').val('');
        //$("label[for=RbacUsuarioUsuario]").removeClass('error').hide();
    }

    function validar_form()
    {
        $('#RbacUsuariosAddForm').validate({
            rules: {
                'data[RbacUsuario][usuario]': {
                    correo: true,
                    required: true
                },
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
        if ($('#contrasenia').val() != $('#contrasenia2').val()) 
        {
            var validator = $("#RbacUsuariosAddForm").validate();
            validator.showErrors({
                "contrasenia2": "Por favor reingrese la contraseña"
            });
        } else {
            if ($('#RbacUsuariosAddForm').valid()) 
            {
                usuario = $(RbacUsuarioUsuario).val();
                $.ajax({
                    url: '/rbac/rbac_usuarios/validarLoginDB/',
                    cache: false,
                    type: 'POST',
                    dataType: 'json',
                    data: {usuario: usuario},
                    success: function(data) {
                        if (data.result)
                        {
                            var validator = $("#RbacUsuariosAddForm").validate();
                            validator.showErrors({
                                "data[RbacUsuario][usuario]": "El usuario ya existe."
                            });
                        } else {
                            $('#RbacUsuariosAddForm').submit();
                        }
                    }
                });
            }
        }
    }

</script>