<div class="row-fluid">
    <span id="mensajes"></span>
    <div class="col-md-4" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="formCons" id="formCons" action="/datos_contacto/" method="POST">
            <div class="well">
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Consulta de Datos de contacto</h4>
                <hr>
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="titulo" name="titulo" placeholder="Titulo" class="form-control" value="<?php echo $titulo;?>" maxlength="60" >
                    </div>
                </div>                          
                <div style="margin-top: 15px" class="text-center">
                    <button type="submit" class="btn btn-success">Buscar</button>                    
                    <button type="button" class="btn btn-warning" onclick="limpiar()">Limpiar</button>
                </div>  
            </div>
        </form>
    </div>
    <div class="col-md-8">
    	<?php if (isset($accionesPermitidas['datos_contacto']['agregar']) && $accionesPermitidas['datos_contacto']['agregar']) { ?>
    		<br /><a href="/datos_contacto/agregar/" class="btn btn-primary navbar-right">Agregar nuevo</a><br />
    	<?php } ?>
        <h2 class="sub-header">Lista de Datos de contacto</h2>
        <?php 
			if (!empty($datoscontacto)) {
				$columnas =
					array(
							0=>array(
									'titulo'=>'#',
									'campo'=>'DatosContacto.id',
									'oculto'=>true),
							/*1=>array(
									'titulo'=>'Email',
									'campo'=>'DatosContacto.email',
									'orden'=>'asc',
									'oculto'=>false),
							2=>array(
									'titulo'=>'Web',
									'campo'=>'DatosContacto.web',
									'orden'=>'asc',
									'oculto'=>false),
							3=>array(
									'titulo'=>'Teléfono',
									'campo'=>'DatosContacto.telefono',
									'orden'=>'asc',
									'oculto'=>false),*/
							1=>array(
									'titulo'=>'Titulo',
									'campo'=>'ItemDatos.0.titulo',
									'orden'=>'asc',
									'oculto'=>false)
					);
				$botones =
					array(
							//'ver'=>array('/casos/view/','popup'),
							'editar' => '/datos_contacto/editar/',
							'eliminar' => array('/datos_contacto/eliminar/', 'Esta seguro de eliminar este dato de Contacto?', 'sin_num')
					);
				$this->DiticHtml->tabla('DatosContacto', $datoscontacto, $columnas, $botones);
			} else {
				echo "<h4>No hay resultado que mostrar...</h4>";
			}
		?>
    </div>
</div>
<script type="text/javascript">
$(function () {
	$('.alert-success, .alert-danger').fadeOut(5000);
});
function limpiar()
{
    document.location.href = "/datos_contacto/?inicio=1";
}
</script>