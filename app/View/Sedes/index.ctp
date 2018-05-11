<div class="row-fluid">
    <span id="mensajes"></span>
    <div class="col-md-4" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="formCons" id="formCons" action="/sedes/" method="POST">
            <div class="well">
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Búsqueda de Sedes</h4>
                <hr>
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="sede" name="sede" placeholder="Sede" class="form-control" value="<?php echo $sede;?>" maxlength="255" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                    	<select id="ciudad" name="ciudad" class="form-control">
                    		<option value="">Seleccione una ciudad...</option>
                    		<?php if (isset($ciudades) && count($ciudades)) {
                    			foreach ($ciudades as $data) { ?>
                    				<option value="<?php echo $data['Ciudad']['id'];?>" <?php if ($data['Ciudad']['id'] == $ciudad) echo "selected"; ?>>
                    					<?php echo $data['Ciudad']['nombre'];?>
                    				</option>
                    			<?php } 
                    		} ?>	
                    	</select>                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                    	<select id="pais" name="pais" class="form-control">
                    		<option value="">Seleccione un pais...</option>
                    		<?php if ($paises) {
                    			foreach ($paises as $data) { ?>
                    				<option value="<?php echo $data['Pais']['id'];?>" <?php if ($data['Pais']['id'] == $pais) echo "selected"; ?>>
                    					<?php echo $data['Pais']['pais'];?>
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
    	
        <h2 class="sub-header">Consulta de Sedes</h2>
        <?php 
			if (!empty($sedes)) {
				$columnas =
					array(
							0=>array(
									'titulo'=>'#',
									'campo'=>'Sede.id',
									'oculto'=>false),
							1=>array(
									'titulo'=>'Sede',
									'campo'=>'Sede.nombre',
									'orden'=>'asc',
									'oculto'=>false),
							2=>array(
									'titulo'=>'Pais',
									'campo'=>'Pais.pais',
									'orden'=>'asc',
									'oculto'=>false,
									'array'=>true),
							3=>array(
									'titulo'=>'Ciudad',
									'campo'=>'Ciudad.nombre',
									'orden'=>'asc',
									'oculto'=>false,
									'array'=>true),
					);
				$botones =
					array(
							//'ver'=>array('/casos/view/','popup'),
							'editar' => '/sedes/editar/',
							'eliminar' => array('/sedes/eliminar/', 'Estas seguro de borrar esta sede')
					);
				$this->DiticHtml->tabla('sedes', $sedes, $columnas);
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
    document.location.href = "/sedes/?inicio=1";
}
</script>