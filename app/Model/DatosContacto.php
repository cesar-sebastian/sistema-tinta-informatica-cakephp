<?php
class DatosContacto extends AppModel {
   public $name = 'DatosContacto';
   public $useTable = 'datos_contacto';
   
   public $hasMany = array(
   		'ItemDatos' => array(
   				'className' => 'ItemDatos',
   				'foreignKey'=> 'datos_contacto_id',
   				'order' => 'ItemDatos.idiomas_id ASC'
   		)
   );

}