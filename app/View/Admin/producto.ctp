<div class="row-fluid">
    <h2 class="sub-header">
        <a class="btn btn-primary navbar-right" href="/admin/index">
            Volver
        </a>	
    </h2>    
</div>    
<div class="row-fluid">    
    <div class="col-md-12" align="center">
        <h5 id="marca"><?php echo $producto['Marca']['nombre']; ?></h5>
        <h3 id="tipo"><?php echo $producto['ProductoTipo']['nombre']; ?></h3>
        <!--span id="imagen"><img src="/uploads/hp_cartucho_60.jpg" width="200px"/></span-->
        <h6 id="descripcion"><?php echo $producto['Producto']['descripcion']; ?></h6>        
        <h3>Precio contado: $<span id="precio"><?php echo round(($producto['Producto']['costo'] * (($parametros['ganancia']+100)/100)),1); ?></span></h3>
        <h5>Precio 1 cuota o débito: $<span id="precio"><?php echo round((($producto['Producto']['costo'] * (($parametros['ganancia']+100)/100)) * (($parametros['recargo_tarjeta_1']+100)/100)),1); ?></span></h5>
        <h5>Precio hasta 3 pagos: $<span id="precio_tarjeta_3"><?php echo round((($producto['Producto']['costo'] * (($parametros['ganancia']+100)/100)) * (($parametros['recargo_tarjeta_3']+100)/100)),1); ?></span></h5>
        <h5>Precio hasta 6 pagos: $<span id="precio_tarjeta_3_mas"><?php echo round((($producto['Producto']['costo'] * (($parametros['ganancia']+100)/100)) * (($parametros['recargo_tarjeta_6']+100)/100)),1); ?></span></h5>
    </div>
</div>
<script type="text/javascript">
   
    $(function() {
        $("#criterio").focus();
    });
    
    function limpiar()
    {
        
    }
</script>