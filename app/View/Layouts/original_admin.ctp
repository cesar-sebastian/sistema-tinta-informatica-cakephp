<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?>
        </title>
        <?php
        if (!$this->Session->read('mipopup')) {

            echo $this->Html->meta('icon');

            echo $this->Html->css('bootstrap.min');            
            echo $this->Html->css('jquery-ui');
            echo $this->Html->css('bootstrap-duallistbox');
            echo $this->Html->css('table-fixed-header');
            echo $this->Html->css('bootstrap-multiselect');
            echo $this->Html->css('jquery.simplecolorpicker');
            echo $this->Html->css('jquery.simplecolorpicker-glyphicons');
            echo $this->Html->css('jHtmlArea/jHtmlArea');
            echo $this->Html->css('datepicker');
            echo $this->Html->css('carousel');
            echo $this->Html->css('blue/style');
            echo $this->Html->css('jquery.tablesorter.pager');
            echo $this->Html->css('jquery.treegrid');
            echo $this->Html->css('bootstrap-select.min');
            echo $this->Html->css('bootstrap-switch.min');
            echo $this->Html->css('default');

            echo $this->Html->script('jquery-1.10.2');
            //echo $this->Html->script('jquery.min');
            echo $this->Html->script('jquery.easing.1.3');
            echo $this->Html->script('jquery-ui');
            //echo $this->Html->script('jquery.validate.min');
            echo $this->Html->script('jquery.validate');
            echo $this->Html->script('bootbox.min');
            echo $this->Html->script('bootstrap');
            //echo $this->Html->script('bootstrap.min');
            echo $this->Html->script('jquery.sheepItPlugin-1.1.1');
            echo $this->Html->script('jquery.bootstrap-duallistbox');
            echo $this->Html->script('bootstrap-multiselect');
            echo $this->Html->script('bootstrap-select.min');
            echo $this->Html->script('bootstrap-switch.min');
            echo $this->Html->script('bootstrap-datepicker');
            echo $this->Html->script('jquery.simplecolorpicker');
            echo $this->Html->script('jHtmlArea-0.8');
            echo $this->Html->script('wysiwyg');
            echo $this->Html->script('jquery.printElement');
            echo $this->Html->script('jquery.tablesorter');
            echo $this->Html->script('jquery.tablesorter.pager');
            echo $this->Html->script('jquery.treegrid');
            echo $this->Html->script('jquery.treegrid.bootstrap3.js');
            echo $this->Html->script('default');
        }
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

        $area = $this->Session->read('Area');
        $perfilDefault = $this->Session->read('PerfilDefault');
        $accionesPermitidasPorPerfiles = $this->Session->read('RbacAcciones');
        $accionesPermitidas = $accionesPermitidasPorPerfiles[$perfilDefault];
        $perfilesPorUsuario = $this->Session->read('PerfilesPorUsuario');
        ?>

    </head>
    <body>
        <?php if (!$this->Session->read('mipopup')) { ?>
            <div id="menu" class="navbar navbar-default admin navbar-fixed-top" role="navigation">                
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/admin/index">Consultar!</a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav ">                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Productos</b> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php if (isset($accionesPermitidas['producto']['index']) && $accionesPermitidas['producto']['index']) { ?>
                                        <li><a href="/producto/index"><b>Productos</b> </a></li>
                                    <?php } ?>
                                    <?php if (isset($accionesPermitidas['producto_tipo']['index']) && $accionesPermitidas['producto_tipo']['index']) { ?>
                                        <li><a href="/producto_tipo/index"><b>Tipo de Productos</b> </a></li>
                                    <?php } ?>
                                    <?php if (isset($accionesPermitidas['marca']['index']) && $accionesPermitidas['marca']['index']) { ?>
                                        <li><a href="/marca/index"><b>Marca</b> </a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php if (isset($accionesPermitidas['rbac_acciones']['index']) || isset($accionesPermitidas['rbac_perfiles']['index']) || isset($accionesPermitidas['rbac_usuarios']['index']) || isset($accionesPermitidas['rbac_configuracion']['index'])) { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Sistema</b> <b class="caret"></b> </a>
                                <ul class="dropdown-menu">
                                    <?php if (isset($accionesPermitidas['rbac_acciones']['index']) && $accionesPermitidas['rbac_acciones']['index']) { ?>
                                        <li><a href="/rbac/rbac_acciones/">Acciones</a></li>
                                    <?php }; ?>
                                    <?php if (isset($accionesPermitidas['rbac_perfiles']['index']) && $accionesPermitidas['rbac_perfiles']['index']) { ?>
                                        <li><a href="/rbac/rbac_perfiles/">Perfiles</a></li>
                                    <?php }; ?>
                                    <?php if (isset($accionesPermitidas['rbac_usuarios']['index']) && $accionesPermitidas['rbac_usuarios']['index']) { ?>
                                        <li><a href="/rbac/rbac_usuarios/">Usuarios</a></li>
                                    <?php }; ?>
                                    <?php if (isset($accionesPermitidas['rbac_permisos']['index']) && $accionesPermitidas['rbac_permisos']['index']) { ?>
                                        <li><a href="/rbac/rbac_permisos/">Permisos</a></li>
                                    <?php }; ?>
                                    <?php if (isset($accionesPermitidas['configuracion']['index']) && $accionesPermitidas['configuracion']['index']) { ?>
                                        <li><a href="/rbac/configuracion/">Configuración</a></li>
                                    <?php }; ?>
                                </ul>
                            </li>
                            <?php } ?>
                        </ul>

                        <?php $usuario = $this->Session->read('RbacUsuario'); ?>
                        <?php if (isset($usuario)) { ?>
                            <ul class="nav navbar-nav navbar-right ">
                                <li class="dropdown ">
                                    <a href="#" class="dropdown-toggle btn-primary"> <span class="glyphicon glyphicon-user"></span> <strong> <?php echo $usuario['usuario']; ?> </strong></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Tinta Informática 
                                    <?php foreach ($perfilesPorUsuario as $perfil) { ?>
                                        <?php if ($perfilDefault == $perfil['id']) { ?>
                                            <?php echo 'Perfil:&nbsp;<b>' . $perfil['descripcion'] . '</b>'; ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if (count($perfilesPorUsuario) > 1) { ?>
                                        <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                        <?php foreach ($perfilesPorUsuario as $perfil) { ?>
                                            <?php if ($perfilDefault != $perfil['id']) { ?>                                                
                                                <li>
                                                    <a href="/rbac/rbac_usuarios/cambiarPerfil/<?php echo $perfil['id'] ?>"><?php echo '<b>' . $perfil['descripcion'] . '</b>'; ?></a>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>                                        
                                        </ul> 
                                    <?php } else { ?> 
                                        </a> 
                                    <?php } ?>
                                </li>
                                <li class="dropdown">
                                    <a href="/rbac/rbac_usuarios/changePass">Cambiar contraseña</a>
                                </li>
                                <li>
                                    <a href="/rbac/rbac_usuarios/login/"><span class="glyphicon glyphicon-log-out"></span></a>
                                </li>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (!$this->Session->read('mipopup')) { ?>
            <div id="content" class='container well'>
            <?php } else { ?>
            <div id="content">
            <?php } ?>
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
            </div>
            <?php if (!$this->Session->read('mipopup')) { ?>
                <br />
                <!-- <footer class="container well">-->
                <footer class="navbar navbar-fixed-bottom navbar-default well admin" style="margin:10px 0px 0px;padding-bottom:8px">
                    <p class="text-center ">
                        <a href="https://www.tintainformatica.com.ar/"> Tinta Informatica - Argentina </a>
                    </p>
                </footer>

            <?php } ?>
            <script type="text/javascript">
                $(function() {
                    $('.alert-success, .alert-danger').fadeOut(5000);
                });
            </script>
    </body>
</html>
