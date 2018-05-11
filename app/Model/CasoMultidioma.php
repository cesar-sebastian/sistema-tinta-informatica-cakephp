<?php
class CasoMultidioma extends AppModel {
   public $name = 'CasoMultidioma';
   public $useTable = 'casos_multidioma';
   
   public $belongsTo = array(
        'Caso' => array(
            'className' => 'Caso',
            'foreignKey' => 'casos_id'	
        )
    );

}