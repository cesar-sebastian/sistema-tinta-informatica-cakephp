<h2 class="sub-header"><small>Nuevo Tipo de producto</small>  
    <!-- <a class="btn btn-default navbar-right" href="/formas/">Volver a la lista</a> -->
    <!-- <a class="btn btn-default navbar-right" href="/casos/index/">Volver a la lista</a>-->
    <a class="btn btn-primary navbar-right" href="/producto_tipo/<?php echo ($this->Session->Check('pag_' . $this->request->param('controller'))) ? 'index/page:' . $this->Session->read('pag_' . $this->request->param('controller')) : 'index'; ?>">
        Volver a la lista
    </a>
</h2>
<div class="row-fluid" style="margin-top: 30px;">
    <div class="col-md-12">
        <fieldset>
            <form class="form-horizontal" id="AddForm" role="form" action="/producto_tipo/add/" method="POST" enctype="multipart/form-data">
                <div class="col-sm-12 well">
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Tipo</label>
                        <div class="col-sm-10">                              
                            <input type="text" required="required" id="nombre" placeholder="Tipo de producto" class="form-control" name="data[ProductoTipo][nombre]">                            
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
                'data[ProductoTipo][nombre]': {                    
                    required: true
                }
            },
            messages: {
                'data[ProductoTipo][nombre]': {
                    required: 'El valor es obligatorio'
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