<?php

class ProductoTipo extends AppModel {

    public $name = 'ProductoTipo';
    public $useTable = 'producto_tipo';
    public $recursive = -1;
    
    public $hasOne = array(
        'Producto' => array(
            'className' => 'Producto',
            'foreignKey' => 'productotipo_id',
        )
    );

}
