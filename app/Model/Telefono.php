<?php
class Telefono extends AppModel {
   public $name = 'Telefono';
   public $useTable = 'telefonos';
   
   public $belongsTo = array(
        'Sede' => array(
            'className' => 'Sede',
            'foreignKey' => 'sede_id'	
        )
    );

}