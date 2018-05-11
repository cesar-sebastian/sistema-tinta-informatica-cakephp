<h2 class="sub-header"><small>Editar Pais # <?php echo $this->data['Pais']['id']; ?></small>
    <a class="btn btn-default navbar-right" href="/paises/<?php echo ($this->Session->Check('pag_'.$this->request->param('controller')))?'index/page:'.$this->Session->read('pag_'.$this->request->param('controller')):'index';?>">
  	Volver a la lista
  	</a>
	<!-- <a class="btn btn-default navbar-right" href="/casos/">Volver a la lista</a>
	<a class="btn btn-default navbar-right" href="#" onclick="history.go(-1);">Volver a la lista</a>-->
</h2>
<div class="row-fluid" style="margin-top: 30px;">
    <div class="col-md-12">
        <fieldset>
            <form class="form-horizontal" id="EditForm" role="form" action="/paises/editar/<?php echo $this->data['Pais']['id']; ?>" method="POST">
                <div class="form-group">
					<div class="col-sm-2 ">
                    	<label class="col-sm-2 control-label">Pais</label>
                    </div>
                    <div class="col-sm-6 ">
                        <input type="text" id="pais" aria-describedby="inputSuccess3Status" class="form-control" name="data[Pais][pais]" size="100" maxlength="255" value="<?php echo $this->data['Pais']['pais']; ?>" />
                        <span class="glyphicon form-control-feedback" id="pais1"></span>
                    </div>
                </div>
                <div class="form-group">
					<div class="col-sm-2">
                    	<label class="col-sm-2 control-label">Región</label>
                    </div>
                    <div class="col-sm-6">
                    	<select id="region" name="data[Pais][regiones_id]" class="form-control">
                    		<option value="">Seleccione una región...</option>
                    		<?php if ($regiones) {
                    			foreach ($regiones as $data) { ?>
                    				<option value="<?php echo $data['Region']['id'];?>" <?php if($this->data['Pais']['regiones_id']==$data['Region']['id']) echo "selected"; ?>>
                    					<?php echo $data['Region']['region'];?>
                    				</option>
                    			<?php } 
                    		} ?>	
                    	</select>
                    	<span class="glyphicon form-control-feedback" id="region1"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <button type="button" class="btn btn-success"  onclick="guardar()">Guardar</button>
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
		
        $('#EditForm').validate({
        	rules: {               
                'data[Pais][pais]': {
                    minlength: 2,
                    required: true
                },
                'data[Pais][regiones_id]': {
                    minlength: 1,
                    required: true
                }
            },
            messages: {               
                'data[Pais][pais]': {
                    required: 'Complete el pais'
                },
                'data[Pais][regiones_id]': {
                    required: 'Seleccione una región'
                }
                
           },
           highlight: function(element) {
        	   var id_attr = "#" + $( element ).attr("id") + "1";
               $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
               $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');         
           },
           unhighlight: function(element) {
        	   var id_attr = "#" + $( element ).attr("id") + "1";
               $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
               $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');      
               $('label.error').remove();
        	  
           },
           success: function(element) {
               $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');  
               $('label.error').remove();
           }
           
        });
    }
    
    function guardar()
    { 
        if( $('#EditForm').valid())
        {	
       	 	bootbox.confirm("¿ Está seguro que desea guardar este pais?", function(result) {
             	if (result)
                {
		            $('#EditForm').submit();
                }
        	 });
        }
    }  

    
    function borrar(id)
    {
        bootbox.confirm("¿ Está seguro que desea borrar este pais?", function(result) {
                if (result)
                {
                    document.location.href = "/paises/borrar/"+id;
                }
            }); 
    }
</script>
