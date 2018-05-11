<?php
class ItemPregunta extends AppModel {
   public $name = 'ItemPregunta';
   public $useTable = 'item_pregresp';
   
   public $belongsTo = array(
        'Pregunta' => array(
            'className' => 'Pregunta',
            'foreignKey' => 'preguntas_id'	
        )
    );

}
