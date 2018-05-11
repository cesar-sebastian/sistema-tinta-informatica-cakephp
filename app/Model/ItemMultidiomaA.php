<?php
class ItemMultidiomaA extends AppModel {
   public $name = 'ItemMultidiomaA';
   public $useTable = 'items_multidioma_a';
   
   public $belongsTo = array(
        'Caso' => array(
            'className' => 'Caso',
            'foreignKey' => 'casos_id'	
        ),
   		'CasoMultidioma' => array(
   				'className' => 'CasoMultidioma',
   				'foreignKey' => 'casos_id'
   		),
    );

}