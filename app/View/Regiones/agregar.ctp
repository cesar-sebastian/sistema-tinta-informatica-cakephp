<h2 class="sub-header"><small>Nueva Región</small>  
    <!-- <a class="btn btn-default navbar-right" href="/formas/">Volver a la lista</a> -->
    <!-- <a class="btn btn-default navbar-right" href="/casos/index/">Volver a la lista</a>-->
    <a class="btn btn-default navbar-right" href="/regiones/<?php echo ($this->Session->Check('pag_'.$this->request->param('controller')))?'index/page:'.$this->Session->read('pag_'.$this->request->param('controller')):'index';?>">
  	Volver a la lista
  	</a>
</h2>
<div class="row-fluid" style="margin-top: 30px;">
    <div class="col-md-12">
        <fieldset>
            <form class="form-horizontal" id="AddForm" role="form" action="/regiones/agregar/" method="POST">
                <div class="form-group">
					<div class="col-sm-2">
                    	<label class="col-sm-2 control-label">Region</label>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" id="region" class="form-control" name="data[Region][region]" size="100" maxlength="255" />
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
		
        $('#AddForm').validate({
           rules: {               
               'data[Region][region]': {
                   minlength: 2,
                   required: true
               }
           },
           messages: {               
               'data[Region][region]': {
                   required: 'Complete la region'
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
		
        if( $('#AddForm').valid())
        {
        	$('#AddForm').submit();	  	
        }
    }  
</script>