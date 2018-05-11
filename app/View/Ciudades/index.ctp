<div class="row-fluid">
    <span id="mensajes"></span>
    <div class="col-md-4" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="formCons" id="formCons" action="/ciudades/" method="POST">
            <div class="well">
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Búsqueda de Ciudades</h4>
                <hr>
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad" class="form-control" value="<?php echo $ciudad; ?>" maxlength="255" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <select id="pais" name="pais" class="form-control">
                            <option value="">Seleccione un pais...</option>
                            <?php if ($paises) {
                                foreach ($paises as $data) {
                                    ?>
                                    <option value="<?php echo $data['Pais']['id']; ?>" <?php if ($data['Pais']['id'] == $pais) echo "selected"; ?>>
                                    <?php echo $data['Pais']['pais']; ?>
                                    </option>
                                <?php }
                            }
                            ?>	
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
        <!--<?php if (isset($accionesPermitidas['ciudades']['agregar']) && $accionesPermitidas['ciudades']['agregar']) { ?>
                    <br /><a href="/paises/agregar/" class="btn btn-default navbar-right">Agregar nuevo</a><br />
        <?php } ?>-->
        <h2 class="sub-header">Consulta de Ciudades</h2>
        <?php
        if (!empty($ciudades)) {
            $columnas = array(
                        0 => array(
                            'titulo' => '#',
                            'campo' => 'Ciudad.id',
                            'oculto' => false),
                        1 => array(
                            'titulo' => 'Ciudad',
                            'campo' => 'Ciudad.nombre',
                            'orden' => 'asc',
                            'oculto' => false),
                        2 => array(
                            'titulo' => 'Pais',
                            'campo' => 'Pais.pais',
                            'orden' => 'asc',
                            'oculto' => false)
            );
            $botones = array(
                        //'ver'=>array('/casos/view/','popup'),
                        'editar' => '/ciudades/editar/',
                        'eliminar' => array('/ciudades/eliminar/', 'Estas seguro de borrar esta ciudad')
            );
            $this->DiticHtml->tabla('Ciudades', $ciudades, $columnas);
        } else {
            echo "<h4>No hay resultado que mostrar...</h4>";
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
        document.location.href = "/ciudades/?inicio=1";
    }
</script>