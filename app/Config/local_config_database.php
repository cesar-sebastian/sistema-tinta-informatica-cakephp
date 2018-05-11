<?php

class DATABASE_CONFIG {

    // permisos conector default
    // los PLACEHOLDER son para el script de creacion de ambientes, modificar por los valores del entorno segun corresponda
    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,        
        'host' => 'localhost',
        'port' => '3306',
        'login' => 'tintainf_sistema',
        'password' => '^*?ZGTP4FC7k',
        'database' => 'tintainf_sistema',
        'prefix' => '',
        'encoding' => 'utf8'
    );
}
