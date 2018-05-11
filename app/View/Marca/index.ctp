<div class="row-fluid">
    <span id="mensajes"></span>
    <div class="col-md-4" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="formCons" id="formCons" action="/marca/" method="POST">
            <div class="well">
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Consulta de marca</h4>
                <hr>
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="form-control" value="<?php echo $nombre; ?>" >
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
        <br /><a href="/marca/add/" class="btn btn-primary navbar-right">Agregar nuevo</a><br />
        <h2 class="sub-header">Lista de tipos de producto</h2>
        <?php
        if (!empty($marcas)) 
        {
            $columnas = array(
                0 => array(
                    'titulo' => '#',
                    'campo' => 'Marca.id',
                    'oculto' => true
                ),
                1 => array(
                    'titulo' => 'Nombre',
                    'campo' => 'Marca.nombre',
                    'orden' => 'asc',
                    'oculto' => false
                )
            );
            $botones = array(
                'editar' => '/marca/editar/',
                'eliminar' => array('/marca/eliminar/', 'Está seguro que quiere eliminar la marca?', 'sin_num')
            );
            $this->DiticHtml->tabla('Marca', $marcas, $columnas, $botones);
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
        document.location.href = "/marca/?inicio=1";
    }
</script>