<?php

class Marca extends AppModel {

    public $name = 'Marca';
    public $useTable = 'marca';
    public $recursive = -1;
    
    public $hasOne = array(
        'Producto' => array(
            'className' => 'Producto',
            'foreignKey' => 'marca_id',
        )
    );

}
