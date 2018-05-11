<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
               Tinta Informatica		
	</title>
	<?php
		echo $this->Html->meta('icon');                     
		echo $this->Html->css('bootstrap.min');				
		echo $this->Html->css('signin');
		echo $this->Html->css('font-awesome.min');
                
                echo $this->Html->script('jquery.min');		
		echo $this->Html->script('jquery.validate.min');
		echo $this->Html->script('bootstrap-tooltip');
		echo $this->Html->script('jquery-validate.bootstrap-tooltip.min');
                
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    <div class="jumbotron" style="background-color: #428bca;">
        <div class="container">            
               <!--img src="/img/MREC.png" class="img-responsive" alt="Responsive image"-->                                               
        </div>         
    </div>
    <div class="container">
         <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>
	
</body>
</html>