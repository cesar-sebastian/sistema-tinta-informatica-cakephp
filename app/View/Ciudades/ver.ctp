<?php if (!$this->Session->read('mipopup'))  { ?>
	<div class="row-fluid" style="margin-top: 10px; float: right;">
	    <div class="col-md-3 col-md-offset-3"><a class="btn btn-default navbar-right" href="/formas/">Volver a la lista</a></div>
	</div>
<?php } ?>
	<div class="row-fluid">
	    <div>
	        <fieldset>  
	            <form class="form-horizontal" role="form">
	                <h4>Forma # <?php echo $forma['Forma']['id'];  ?></h4>
	                <div class="form-group">                
	                	<label for="forma" class="col-sm-2 control-label">Forma</label>
	                    <div class="col-sm-8">                        
	                        <input type="text" class="form-control" id="forma" name="data[Forma][forma]" placeholder="<?php echo ($forma['Forma']['forma']); ?>" disabled>
	               		</div>
	                 </div>
	            </form>    
	        </fieldset>
	    </div>
	</div>
