
    <h3 class="sub-header">
	<span class="glyphicon glyphicon-credit-card"></span>
	<small>Editar Configuración</small>
	  <a class="btn btn-default navbar-right" href="/rbac/configuracion/">
		<span class="glyphicon glyphicon-arrow-left"></span>
		Volver a la lista</a>
	</h3>
    <?php if($this->data['Configuracion']['clave']=='captcha' || $this->data['Configuracion']['clave']=='noLDAP'){ ?>    
    <div class="col-md-10">
        <fieldset>
            <form accept-charset="utf-8" class="form-horizontal" id="ConfiguracionEditForm" role="form" action="/rbac/configuracion/edit/<?php echo $this->data['Configuracion']['id']; ?>" method="POST">
                <input type="hidden" value="POST" name="_method">
                <div class="form-group">
                    <label for="descripcion" class="col-sm-2 control-label"><?php echo strtoupper($this->data['Configuracion']['clave'])?></label>
                    <div class="col-sm-2">
                        <input type="hidden" required="required" value="<?php echo $this->data['Configuracion']['id']; ?>" placeholder="Descripción" class="form-control" name="data[Configuracion][id]">                       
                        <input type="hidden" required="required" value="<?php echo $this->data['Configuracion']['clave']; ?>" placeholder="Descripción" class="form-control" name="data[Configuracion][clave]">
                        <select name="data[Configuracion][valor]" id="ConfiguracionValor" class="form-control" >
                        <?php if($this->data['Configuracion']['valor']=='Si'){ ?>
                           <option selected="selected" value="Si" >Si</option>
                        <?php }else{ ?>
						   <option value="Si" >Si</option>
						<?php } ?>   						 
						<?php if($this->data['Configuracion']['valor']=='No'){ ?>
                           <option selected="selected" value="No" >No</option>
                        <?php }else{ ?>
						   <option value="No" >No</option>
						<?php } ?>  																																							
			            </select>   
  
                    </div>
                </div>                                                                       
               <div class="form-group pull-right">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-check"></span>
                        Guardar</button>    
                    </div>
                </div>                  
            </form>
        </fieldset>
    </div>
    <?php } ?>
   
   