<div class="row-fluid">
    <div class="col-md-12" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="AddForm" id="AddForm" action="/paises_casos/guardar" method="POST">
            <div class="well">
                <h4>Asociacion de paises y casos</h4>
                <div class="form-group">                    
                    <div class="col-sm-12">                   
                    	<label> Region:</label>     
                        <select name="regiones" id="regiones">
                        	<option value="">Seleccione una región...</option>
                        	<?php foreach ($regiones as $region) { ?>
                        		<option value="<?php echo $region['Region']['id'];?>"><?php echo $region['Region']['region'];?></option>
                        	<?php } ?>
                        </select>
                    </div>
                </div>
                <hr />
                <div class="form-group">
                    <div class="col-sm-12">
                    	<div id="tabla"></div>                       
                    </div>
                </div>                          
                <div style="margin-top: 15px" class="text-center">
                    <button type="button" class="btn btn-success"  onclick="guardar()">Guardar</button>                    
                </div>  
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(function () {
	$('.alert-success, .alert-danger').fadeOut(5000);
	$('#regiones').change(function() {
		if ($(this).val()) {
	    	$.ajax({
			     type: "POST",
			     url: "/paises_casos/cargar_paises/"+$(this).val(),
			     success: function(data) {
			          $("#tabla").html(data);
			     }
			});
		} else {
			$("#tabla").html('');
		}
	});

	

});
function guardar() {
	if ($('#regiones').val() != '') {
		//$('#AddForm').submit();
		if (validar_casos()) {
			$('#AddForm').submit();
		} else {
			bootbox.alert("Error, Marque una opcion de cada pais en todos los casos");
		}
	} else {
		bootbox.alert("Selecciona primero una región antes de guardar datos"); 
	}
}
function Create2DArray(rows) {
  var arr = [];

  for (var i=0;i<rows;i++) {
     arr[i] = [];
  }

  return arr;
}
function validar_casos() {
	var completo;
	var j = 0;
	var aux=0;
	var valor;
	var num = $("tr.mifila").length;
	var checkeo = Create2DArray(num);
	for (i=0;i<=num-1;i++) {
		j=0;
		aux=0;
		$("tr#mifila_"+i+"  td.fila_"+i+"  input[name='caso_"+i+"']").each(function() {
			valor = $(this).is(':checked');
			if (valor) {
				aux=1;
				checkeo[i][j] = valor;
			} else {
				if (aux==1) {
					checkeo[i][j] = true;			
				} else {
					aux = 0;
					checkeo[i][j] = valor;
				}
			}
			j++;
		});
	}
	var result;
	for (i=0;i<=num-1;i++) {
		result = $.inArray(true, checkeo[i]);
		if (result!=-1) {
			completo=1;
		} else {
			completo=0;
			break;
		}
		
	}
	return completo;
}

</script>