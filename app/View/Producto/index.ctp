<div class="row-fluid">
    <span id="mensajes"></span>
    <div class="col-md-4" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="formCons" id="formCons" action="/producto/" method="POST">
            <div class="well">
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Consulta de productos</h4>
                <hr>                
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="descripcion" name="descripcion" placeholder="Descripcion" class="form-control" value="<?php echo $descripcion; ?>" >
                    </div>
                </div>                          
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="codigo" name="codigo" placeholder="Código" class="form-control" value="<?php echo $codigo; ?>" >
                    </div>
                </div>                          
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <select id="productotipo_id" name="productotipo_id" class="form-control">
                            <option value="">Seleccione tipo</option>
                            <?php if ($productoTipos) { ?>
                                <?php foreach ($productoTipos as $data) { ?>                                    
                                    <option value="<?php echo $data['ProductoTipo']['id']; ?>" <?php if ($data['ProductoTipo']['id'] == $productotipo_id) echo "selected"; ?>>
                                        <?php echo $data['ProductoTipo']['nombre']; ?>
                                    </option>
                                <?php } ?>	
                            <?php } ?>                            
                        </select>
                    </div>
                </div>                          
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <select id="marca_id" name="marca_id" class="form-control">
                            <option value="">Seleccione marca</option>
                            <?php if ($marcas) { ?>
                                <?php foreach ($marcas as $data) { ?>                                    
                                    <option value="<?php echo $data['Marca']['id']; ?>" <?php if ($data['Marca']['id'] == $marca_id) echo "selected"; ?>>
                                        <?php echo $data['Marca']['nombre']; ?>
                                    </option>
                                <?php } ?>	
                            <?php } ?>                            
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
        <br /><a href="/producto/add/" class="btn btn-primary navbar-right">Agregar nuevo</a><br />
        <h2 class="sub-header">Lista de productos</h2>
        <?php
        if (!empty($productos)) 
        {
            $columnas = array(
                0 => array(
                    'titulo' => '#',
                    'campo' => 'Producto.id',
                    'oculto' => true
                ),
                1 => array(
                    'titulo' => 'Código',
                    'campo' => 'Producto.codigo',
                    'orden' => 'asc',
                    'oculto' => false
                ),
                2 => array(
                    'titulo' => 'Tipo',
                    'campo' => 'ProductoTipo.nombre',
                    'orden' => 'asc',
                    'oculto' => false                
                ),
                3 => array(
                    'titulo' => 'Marca',
                    'campo' => 'Marca.nombre',
                    'orden' => 'asc',
                    'oculto' => false                
                ),
                4 => array(
                    'titulo' => 'Nombre',
                    'campo' => 'Producto.descripcion',
                    'orden' => 'asc',
                    'oculto' => false
                ),
                5 => array(
                    'titulo' => 'Costo',
                    'campo' => 'Producto.costo',
                    'orden' => 'asc',
                    'oculto' => false
                )
            );
            $botones = array(
                'editar' => '/producto/editar/',
                'eliminar' => array('/producto/eliminar/', 'Está seguro que quiere eliminar el producto?', 'sin_num')
            );
            $this->DiticHtml->tabla('Producto', $productos, $columnas, $botones);
        } else {
            echo "<h4>No hay resultados.</h4>";
        }
        ?>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('.alert-success, .alert-danger').fadeOut(5000);
    });
    function limpiar()
    {
        document.location.href = "/producto/?inicio=1";
    }
</script>