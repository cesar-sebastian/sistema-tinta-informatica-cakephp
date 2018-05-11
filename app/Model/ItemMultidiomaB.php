<?php
class ItemMultidiomaB extends AppModel {
   public $name = 'ItemMultidiomaB';
   public $useTable = 'items_multidioma_b';
   
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