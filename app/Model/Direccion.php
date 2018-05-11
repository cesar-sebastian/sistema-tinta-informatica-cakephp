<?php
class Direccion extends AppModel {
   public $name = 'Direccion';
   public $useTable = 'direcciones';
   
   public $belongsTo = array(
        'Sede' => array(
            'className' => 'Sede',
            'foreignKey' => 'sede_id'	
        )
    );

}