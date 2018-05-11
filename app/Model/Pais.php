<?php
class Pais extends AppModel {
   public $name = 'Pais';
   public $useTable = 'paises';
   
   public $belongsTo = array(
        'Region' => array(
            'className' => 'Region',
            'foreignKey' => 'regiones_id'	
        )/*,
   		'PaisIdioma' => array(
   				'className' => 'PaisIdioma',
   				'foreignKey' => 'id'
   		)*/
    );
   public $hasMany = array(
   		'PaisIdioma' => array(
   				'className' => 'PaisIdioma',
   				'foreignKey' => 'paises_id'
   		),
   	);

}