<div class="row-fluid">
    <span id="mensajes"></span>
    <div class="col-md-4" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="formCons" id="formCons" action="/paises/" method="POST">
            <div class="well">
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Búsqueda de Paises</h4>
                <hr>
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="pais" name="pais" placeholder="País" class="form-control" value="<?php echo $pais;?>" maxlength="255" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                    	<select id="region" name="region" class="form-control">
                    		<option value="">Seleccione una región...</option>
                    		<?php if ($regiones) {
                    			foreach ($regiones as $data) { ?>
                    				<option value="<?php echo $data['Region']['id'];?>" <?php if ($data['Region']['id'] == $region) echo "selected"; ?>>
                    					<?php echo $data['Region']['region'];?>
                    				</option>
                    			<?php } 
                    		} ?>	
                    	</select>                        
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
    	<?php if (isset($accionesPermitidas['paises']['agregar']) && $accionesPermitidas['paises']['agregar']) { ?>
    		<br /><a href="/paises/agregar/" class="btn btn-default navbar-right">Agregar nuevo</a><br />
    	<?php } ?>
        <h2 class="sub-header">Consulta de Paises</h2>
        <?php 
			if (!empty($paises)) {
				$columnas =
					array(
							0=>array(
									'titulo'=>'#',
									'campo'=>'Pais.id',
									'oculto'=>false),
							1=>array(
									'titulo'=>'Pais',
									'campo'=>'Pais.pais',
									'orden'=>'asc',
									'oculto'=>false),
							2=>array(
									'titulo'=>'Región',
									'campo'=>'Region.region',
									'orden'=>'asc',
									'oculto'=>false),
							3=>array(
								'titulo'=>'Traducido',
								'campo'=>'PaisIdioma.0.paises_id',
								'oculto'=>false,
								'formato'=>'si/no'),
							4=>array(
								'titulo'=>'Agregado',
								'campo'=>'Pais.agregado',
								'oculto'=>true)
					);
				$botones =
					array(
							//'ver'=>array('/paises/view/','popup'),
							'editar' => '/paises_idioma/editar/',
							'editar2' => '/paises/editar/',
							'eliminar2' => array('/paises/eliminar/', 'Estas seguro de borrar este pais')
					);
				$this->DiticHtml->tabla('Paises', $paises, $columnas, $botones);
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
    document.location.href = "/paises/?inicio=1";
}
</script>