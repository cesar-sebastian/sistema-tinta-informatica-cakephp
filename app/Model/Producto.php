<?php

class Producto extends AppModel {

    public $name = 'Producto';
    public $useTable = 'producto';
    
    public $belongsTo = array(
        'Marca' => array(
            'className' => 'Marca',
            'foreignKey' => 'marca_id'
        ),
        'ProductoTipo' => array(
            'className' => 'ProductoTipo',
            'foreignKey' => 'productotipo_id'
        )
    );
    
    public function findByCriteria($criterio)
    {
        $sql = <<<EOD
SELECT *
FROM producto
INNER JOIN marca ON marca.id = producto.marca_id
INNER JOIN producto_tipo ON producto_tipo.id = producto.productotipo_id
WHERE producto.codigo = '$criterio'
OR
producto.descripcion like '%$criterio%'
OR 
marca.nombre like '%$criterio%'
OR
producto_tipo.nombre like '%$criterio%'
EOD;
        
        $result = $this->query($sql);
        
        return $result;
    }
}
