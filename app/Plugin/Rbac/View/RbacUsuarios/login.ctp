<form class="form-signin well" role="form" action="/rbac/rbac_usuarios/login/" method="POST">
    <h3 class="form-signin-heading">
        <i class="fa fa-arrow-circle-right"></i> Acceso al sistema
    </h3>
    <br> 
    <input type="text" name="data[RbacUsuario][usuario]" class="form-control" placeholder="Usuario" required autofocus>
    <br> 
    <input type="password" name="data[RbacUsuario][password]" class="form-control" placeholder="Contraseña" required>

    <label class="checkbox"> <input type="checkbox" value="remember-me">Recordarme </label>
    <br>

    <?php if ($captcha['valor'] == 'Si') { ?>
        <img class="form-control" src="/files/captcha.php" alt="verificacion" height="70" border="1" vspace="5" onclick="location.href = '/login/';"/><br>    
        <input type="hidden" id="valor">
        <input class="form-control" type="text" size="10" placeholder="Ingrese las letras" name="captcha"><br>
    <?php } ?>		
    <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
    <br />	
    <a href="/rbac/rbac_usuarios/recuperar"><span class="label label-danger">Recuperar contraseña</span></a>	
</form>
<script type="text/javascript">
    $(function() {
        $('.alert-success, .alert-danger').fadeOut(4000);
    });
</script>