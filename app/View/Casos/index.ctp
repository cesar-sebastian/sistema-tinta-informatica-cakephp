<div class="row-fluid">
    <span id="mensajes"></span>
    <div class="col-md-4" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="formCons" id="formCons" action="/casos/" method="POST">
            <div class="well">
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Búsqueda de Casos</h4>
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
    </div>
    <div class="col-md-8">
    	<?php if (isset($accionesPermitidas['casos']['agregar']) && $accionesPermitidas['casos']['agregar']) { ?>
    		<br /><a href="/casos/agregar/" class="btn btn-primary navbar-right">Agregar nuevo</a><br />
    	<?php } ?>
        <h2 class="sub-header">Consulta de Casos</h2>
        <?php 
			if (!empty($casos)) {
				$columnas =
					array(
							0=>array(
									'titulo'=>'#',
									'campo'=>'Caso.id',
									'oculto'=>true),
							1=>array(
									'titulo'=>'Código',
									'campo'=>'Caso.cod_num',
									'orden'=>'asc',
									'oculto'=>false),
							2=>array(
									'titulo'=>'Titulo',
									'campo'=>'CasoMultidioma.0.titulo',
									'orden'=>'asc',
									'oculto'=>false)
					);
				$botones =
					array(
							//'ver'=>array('/casos/view/','popup'),
							'editar' => '/casos/editar/',
							'eliminar' => array('/casos/eliminar/', '¿Estás seguro de borrar este caso','cod_num')
					);
				$this->DiticHtml->tabla('Caso', $casos, $columnas, $botones);
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
    document.location.href = "/casos/?inicio=1";
}
function eliminar2(url,id,cod) {
	
	$.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/casos/verificar_caso',
		data: { casos_id : id, codigo: cod},
	    success: function(data) {
	    	var cod_num;
	    	if (data.existe) {
	    		cod_num = data.codigo;	
	    		if (cod_num.length==1) cod_num = (0+data.codigo);
		    	bootbox.dialog({
					message: "No es posible eliminar el caso #"+cod_num+
						" por tener países asociados. Debe modificarse previamente la asociación de países y casos",
	    	 		title: "Atención!",
	    	 		buttons: {
				    	success: {
					    	label: "Aceptar",
					    	className: "btn-success",
					    	callback: function() {
					    		document.location.href = url+id;
	    	 		      	}  	
				    	},
				    	/*danger: {
				    		label: "No",
				    	 	className: "btn-danger"
				    	},*/
				    	main: {
				    		label: "Ir a Paises-Casos",
				    	 	className: "btn-primary",
				    	 	callback: function() {
				    	 		document.location.href="/paises_casos/";
				    	 	}
				    	}
		   	 	    }
				});
	    	} else {
				cod_num = data.codigo;
	    		if (cod_num.length==1) cod_num = (0+data.codigo);
	    		bootbox.confirm("¿Está seguro de eliminar el caso #"+cod_num+"?", function(result) {
    				if (result)
    				{
        				document.location.href = url+id;
    				}
				});
		    	
	    	}
	     },
	     error: function(xhr, status, error) {
	    	 alert(xhr.responseText+"/r"+status+" - "+error);
   	 }
	});
}
</script>