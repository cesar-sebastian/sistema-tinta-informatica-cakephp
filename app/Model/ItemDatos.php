<?php
class ItemDatos extends AppModel {
   public $name = 'ItemPregunta';
   public $useTable = 'datos_contacto_multidioma';
   
   public $belongsTo = array(
        'DatosContacto' => array(
            'className' => 'DatosContacto',
            'foreignKey' => 'datos_contacto_id'	
        )
    );

}