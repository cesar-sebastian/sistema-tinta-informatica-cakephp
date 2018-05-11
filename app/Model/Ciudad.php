<?php
class Ciudad extends AppModel {
   public $name = 'Ciudad';
   public $useTable = 'ciudades';
   
   public $belongsTo = array(
        'Pais' => array(
            'className' => 'Pais',
            'foreignKey' => 'paises_id'	
        )
    );

}