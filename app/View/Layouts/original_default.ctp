<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css('jquery-ui');
        echo $this->Html->css('bootstrap');        
        echo $this->Html->css('default');        
        echo $this->Html->script('jquery-1.10.2');
        echo $this->Html->script('jquery-ui');
        echo $this->Html->script('bootstrap');        
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div id="container">
            <div id="content">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>	
        <?php //echo $this->element('sql_dump');  ?>
    </body>
</html>
