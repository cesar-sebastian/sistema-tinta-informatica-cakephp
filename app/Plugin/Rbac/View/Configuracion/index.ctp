    <div class="col-md-8">
        <h3 class='sub-header' >Lista de Configuraciones </h3>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>                        
                        <th><?php echo $this->Paginator->sort('Configuracion.clave','Clave', array('Model'=>'Configuracion'));?></th>
                        <th><?php echo $this->Paginator->sort('Configuracion.valor','Valor', array('Model'=>'Configuracion'));?></th>
                        <th class="text-center">Acciones</th>                                                                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($configuraciones as $configuracion): ?>
                        <tr>                                                       
                            <td><?php echo $configuracion['Configuracion']['clave']; ?></td>
                            <td>
                            <?php echo $configuracion['Configuracion']['valor']; ?>
                            </td> 
                            <td>
                                <div class="text-center">
                                    <a href="/rbac/configuracion/edit/<?php echo $configuracion['Configuracion']['id']; ?>" type="button" class="btn btn-primary btn-xs" title="Editar">
                                    <span class="glyphicon glyphicon-edit"></span></a>                                    
                                    
                                </div>
                            </td>                                                       
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
             <br />
            <div style="text-align:center; width:100%;">		        
		        <?php
		        $pager_params = $this->Paginator->params();
		        if($pager_params['pageCount'] > 1){
		        	echo $this->Paginator->prev('<b>ANTERIOR</b>', array('escape'=> false,'class'=> 'btn btn-default'), null, array('escape'=> false,'class' => 'btn btn-default prev disabled'));
		            echo $this->Paginator->counter(' ( {:page} / {:pages} ) ');
		        	echo $this->Paginator->next('<b>SIGUIENTE</b>',array('escape'=> false,'class'=> 'btn btn-default'), null, array('escape'=> false,'class' => 'btn btn-default next disabled'));
		        }
		        ?>  		        
		    </div>
        </div>
    </div>
     <div class="col-md-4" style="margin-top: 10px;">
        <form autocomplete="off"  class="form-horizontal" name="formCons" id="formCons" action="/rbac/Configuracion/" method="POST">
            <div class="well">
                <div style="display: none;" class="alert alert-error" id="errores"></div>
                <h4 class="text-center">Consulta Configuraciones</h4>
                <hr>                
                
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="clave" name="clave" placeholder="Clave" class="form-control" value="<?php echo $clave;?>" >                
                    </div>
                </div>
                
                <div class="form-group">                    
                    <div class="col-sm-12">                        
                        <input type="text" id="valor" name="valor" placeholder="Valor" class="form-control" value="<?php echo $valor;?>" >                
                    </div>
                </div>
                
                <div style="margin-top: 15px" class="text-center">
                    <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search"></span>
                    Buscar</button>                    
                    <button type="button" class="btn btn-primary" onclick="limpiar()">
                    <span class="glyphicon glyphicon-trash"></span>
                    Limpiar</button>                                                                                                                                
                </div>  
            </div>
        </form>
    </div>

<script type="text/javascript">
    
function eliminar(id)
{
    bootbox.confirm("Está seguro de eliminar el usuario # "+id+"?", function(result) {
        if (result)
        {
            document.location.href = "/rbac/Configuracion/delete/"+id;
        }
    });
}

function limpiar()
{
    document.location.href = "/rbac/Configuracion/"; 
}

</script>