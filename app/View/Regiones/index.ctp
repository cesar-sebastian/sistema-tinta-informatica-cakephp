<div class="row-fluid">
    <span id="mensajes"></span>
    <div class="col-md-4" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="formCons" id="formCons" action="/regiones/" method="POST">
            <div class="well">
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Búsqueda de Regiones</h4>
                <hr>
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="region" name="region" placeholder="Region" class="form-control" value="<?php echo $region;?>" maxlength="60" >
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
    	<!--<?php if (isset($accionesPermitidas['regiones']['agregar']) && $accionesPermitidas['regiones']['agregar']) { ?>
    		<br /><a href="/regiones/agregar/" class="btn btn-default navbar-right">Agregar nuevo</a><br />
    	<?php } ?>-->
        <h2 class="sub-header">Consulta de Regiones</h2>
        <?php 
			if (!empty($regiones)) {
				$columnas =
					array(
							0=>array(
									'titulo'=>'#',
									'campo'=>'Region.id',
									'oculto'=>false),
							1=>array(
									'titulo'=>'Región',
									'campo'=>'Region.region',
									'orden'=>'asc',
									'oculto'=>false)
					);
				$botones =
					array(
							//'ver'=>array('/casos/view/','popup'),
							'editar' => '/regiones/editar/',
							'eliminar' => array('/regiones/eliminar/', 'Estas seguro de borrar esta region')
					);
				$this->DiticHtml->tabla('Regiones', $regiones, $columnas);
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
    document.location.href = "/regiones/?inicio=1";
}
</script>