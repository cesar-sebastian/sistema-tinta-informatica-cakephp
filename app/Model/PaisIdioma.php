<?php
class PaisIdioma extends AppModel {
   public $name = 'PaisIdioma';
   public $useTable = 'paises_idioma';
   
   public $belongsTo = array(
        'Pais' => array(
            'className' => 'Pais',
            'foreignKey' => 'paises_id'	
        ),
   		'Idioma' => array(
   				'className' => 'Idioma',
   				'foreignKey' => 'idiomas_id'
   		)
    );

}