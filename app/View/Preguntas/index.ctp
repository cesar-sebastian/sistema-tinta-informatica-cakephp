<div class="row-fluid">
    <span id="mensajes"></span>
    <!-- <div class="col-md-4" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="formCons" id="formCons" action="/casos/" method="POST">
            <div class="well">
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Consulta de Preguntas / Respuestas</h4>
                <hr>
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="cod_num" name="cod_num" placeholder="Número de código" class="form-control" value="<?php echo $cod_num;?>" maxlength="60" >
                    </div>
                </div>                          
                <div style="margin-top: 15px" class="text-center">
                    <button type="submit" class="btn btn-success">Buscar</button>                    
                    <button type="button" class="btn btn-warning" onclick="limpiar()">Limpiar</button>
                </div>  
            </div>
        </form>
    </div>-->
    <div class="col-md-12">
    	<?php if (isset($accionesPermitidas['preguntas']['agregar']) && $accionesPermitidas['preguntas']['agregar']) { ?>
    		<br /><a href="/preguntas/agregar/" class="btn btn-primary navbar-right">Agregar nuevo</a><br />
    	<?php } ?>
        <h2 class="sub-header">Listado de Preguntas / Respuestas</h2>
        <?php 
			if (!empty($preguntas)) {
				$columnas =
					array(
							0=>array(
									'titulo'=>'#',
									'campo'=>'Pregunta.id',
									'oculto'=>true),
							1=>array(
									'titulo'=>'Preguntas/Respuestas',
									'campo'=>'ItemPregunta.preg_resp',
									'orden'=>'asc',
									'oculto'=>false)
					);
				$botones =
					array(
							//'ver'=>array('/casos/view/','popup'),
							'editar' => '/preguntas/editar/',
							'eliminar' => array('/preguntas/eliminar/', 'Estas seguro de borrar esta pregunta/respuesta')
					);
				$this->DiticHtml->tabla('Pregunta', $preguntas, $columnas, $botones);
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
    document.location.href = "/preguntas/?inicio=1";
}
</script>