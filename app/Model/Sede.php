<?php
class Sede extends AppModel {
   public $name = 'Sede';
   public $useTable = 'sedes';
   
   public $belongsTo = array(
        'Pais' => array(
            'className' => 'Pais',
            'foreignKey' => 'pais_id'	
        ),
   		'Ciudad' => array(
   				'className' => 'Ciudad',
   				'foreignKey' => 'idciudades'
   		)
    );

}