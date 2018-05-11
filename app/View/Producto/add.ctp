<h2 class="sub-header"><small>Nuevo producto</small>    
    <a class="btn btn-primary navbar-right" href="/producto/<?php echo ($this->Session->Check('pag_' . $this->request->param('controller'))) ? 'index/page:' . $this->Session->read('pag_' . $this->request->param('controller')) : 'index'; ?>">
        Volver a la lista
    </a>
</h2>
<div class="row-fluid" style="margin-top: 30px;">
    <div class="col-md-12">
        <fieldset>
            <form class="form-horizontal" id="AddForm" role="form" action="/producto/add/" method="POST" enctype="multipart/form-data">
                <div class="col-sm-12 well">
                    <div class="form-group">
                        <label for="descripcion" class="col-sm-2 control-label">Descripcion</label>
                        <div class="col-sm-10">                              
                            <input type="text" id="descripcion" placeholder="Descripcion" class="form-control" name="data[Producto][descripcion]">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="costo" class="col-sm-2 control-label">Costo</label>
                        <div class="col-sm-10">                              
                            <input type="text" id="costo" placeholder="Costo" class="form-control" name="data[Producto][costo]">                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="codigo" class="col-sm-2 control-label">Código</label>
                        <div class="col-sm-10">                              
                            <input type="text" id="codigo" placeholder="Código" class="form-control" name="data[Producto][codigo]">                            
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="marca" class="col-sm-2 control-label">Marca</label>
                        <div class="col-sm-10">                              
                            <select id="marca_id" name="data[Producto][marca_id]" class="form-control">
                                <option value="">Seleccione marca</option>
                                <?php if ($marcas) { ?>
                                    <?php foreach ($marcas as $data) { ?>                                    
                                        <option value="<?php echo $data['Marca']['id']; ?>">
                                            <?php echo $data['Marca']['nombre']; ?>
                                        </option>
                                    <?php } ?>	
                                <?php } ?>                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipo" class="col-sm-2 control-label">Tipo</label>
                        <div class="col-sm-10">                              
                            <select id="marca_id" name="data[Producto][productotipo_id]" class="form-control">
                                <option value="">Seleccione tipo</option>
                                <?php if ($productoTipos) { ?>
                                    <?php foreach ($productoTipos as $data) { ?>                                    
                                        <option value="<?php echo $data['ProductoTipo']['id']; ?>">
                                            <?php echo $data['ProductoTipo']['nombre']; ?>
                                        </option>
                                    <?php } ?>	
                                <?php } ?>                            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>                
            </form>
        </fieldset>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        inicialize();
    });

    function inicialize()
    {       
        $('#AddForm').validate({
            rules: {
                'data[Producto][descripcion]': {                    
                    required: true
                },
                'data[Producto][costo]': {
                    required: true,
                    number: true
                },
                'data[Producto][codigo]': {
                    number: true
                },
                'data[Producto][marca_id]': {                    
                    required: true                
                },
                'data[Producto][productotipo_id]': {                    
                    required: true
                }
            },
            messages: {
                'data[Producto][descripcion]': {                    
                    required: 'Campo obligatorio'
                },
                'data[Producto][costo]': {
                    required: 'Campo obligatorio',
                    number: 'Debe ingresar un número'
                },
                'data[Producto][codigo]': {
                    number: 'Debe ingresar un número'
                },
                'data[Producto][marca_id]': {                    
                    required: 'Campo obligatorio'
                },
                'data[Producto][productotipo_id]': {                    
                    required: 'Campo obligatorio'
                }
            },
            highlight: function(element) {
                var id_attr = "#" + $(element).attr("id");
                $(id_attr).closest('.form-group').removeClass('has-success').addClass('has-error');
                $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');
                //if ($('label.error').val()=='') $('label.error').remove();

            },
            unhighlight: function(element) {
                var id_attr = "#" + $(element).attr("id");
                $(id_attr).closest('.form-group').removeClass('has-error').addClass('has-success');
                $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');
                //if ($('label.error').val()=='') $('label.error').remove(); 
                //$('div#'+$( element ).attr("id")+' label.error').remove();
                //if ($('div#'+$( element ).parent().attr("id")+' label.error').val()=='') $('div#'+$( element ).parent().attr("id")+' label.error').remove();

            },
            success: function(element) {
                $('.nav-tabs > li.active > a').removeClass('has-error');
                $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');
                //$('div#'+$( element ).attr("id")+' label.error').remove();  
                //$('label.error').remove();
                //alert($( element ).parent().find('label').html());
                //if ($('div#'+$( element ).parent().attr("id")+' label.error').val()=='') $('div#'+$( element ).parent().attr("id")+' label.error').remove();
                if ($(element).parent().find('label').html() == '')
                    $(element).parent().find('label').remove();
            }
        });
    }
</script>