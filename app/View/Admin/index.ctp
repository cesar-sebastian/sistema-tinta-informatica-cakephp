<div class="row-fluid">
    <span id="mensajes"></span>
    <div class="col-md-12" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="formCons" id="formCons" action="/admin/index/" method="POST">
            <div class="well">
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Producto</h4>
                <hr>                 
                <div class="form-group">                    
                    <div class="col-sm-6 col-md-offset-3">
                        <input type="text" id="criterio" name="criterio" placeholder="Código/Nombre/Marca/Tipo" class="form-control" value="<?php echo $criterio; ?>" >
                    </div>
                </div>                                                                                  
                <div style="margin-top: 15px" class="text-center">
                    <button type="submit" class="btn btn-success">Buscar</button>                    
                    <button type="button" class="btn btn-warning" onclick="limpiar()">Limpiar</button>
                </div>
            </div>
        </form>
    </div>
</div>    
<div class="row-fluid">    
    <div class="col-md-12" align="center">
        
        <?php if(count($productos) > 0) { ?>
        
        <h2 class="sub-header">Resultado</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>                        
                        <th>
                            <span>Tipo</span>                            
                        </th>
                        <th>
                            <span>Marca</span>
                        </th>
                        <th>                            
                            <span>Nombre</span>                            
                        </th>
                        <th>
                            <span>P. efectivo</span>
                        </th>
                        <th>
                            <span>P. 1 cuota</span>
                        </th>
                        <th>
                            <span>P. 3 cuotas</span>
                        </th>
                        <th>
                            <span>P. 6 cuotas</span>
                        </th>
                        <th style="text-align:right;padding-right:25px;width:auto;">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) { ?>
                    <tr>                        
                        <td><?php echo $producto['producto_tipo']['nombre']; ?></td>
                        <td><?php echo $producto['marca']['nombre']; ?></td>                        
                        <td><?php echo $producto['producto']['descripcion']; ?></td>
                        <td>$<?php echo round(($producto['producto']['costo'] * (($parametros['ganancia']+100)/100)),1); ?></td>
                        <td>$<?php echo round((($producto['producto']['costo'] * (($parametros['ganancia']+100)/100)) * (($parametros['recargo_tarjeta_1']+100)/100)),1); ?></td>
                        <td>$<?php echo round((($producto['producto']['costo'] * (($parametros['ganancia']+100)/100)) * (($parametros['recargo_tarjeta_3']+100)/100)),1); ?></td>
                        <td>$<?php echo round((($producto['producto']['costo'] * (($parametros['ganancia']+100)/100)) * (($parametros['recargo_tarjeta_6']+100)/100)),1); ?></td>         
                        <td style="text-align:right;width:auto;">
                            <a title="Ver" class="btn btn-success btn-xs" type="button" href="/admin/producto/<?php echo $producto['producto']['id']; ?>" >
                                <span class="glyphicon glyphicon-search"></span>
                            </a>
                        </td>
                    </tr>                    
                    <?php } ?>
                </tbody>
            </table>
            <br>
            <div style="text-align:center; width:100%;"></div>                
        </div>
        
        <?php } else {?>
            <h2 class="sub-header">Búsqueda de productos</h2>
        <?php } ?>        
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