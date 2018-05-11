<?php

class Caso extends AppModel {

    public $name = 'Caso';
    public $useTable = 'casos';
    public $hasMany = array(
        'CasoMultidioma' => array(
            'className' => 'CasoMultidioma',
            'foreignKey' => 'casos_id'
        ),
        'ItemMultidiomaA' => array(
            'className' => 'ItemMultidiomaA',
            'foreignKey' => 'casos_id',
            'order' => 'ItemMultidiomaA.idiomas_id ASC'
        ),
        'ItemMultidiomaB' => array(
            'className' => 'ItemMultidiomaB',
            'foreignKey' => 'casos_id',
            'order' => 'ItemMultidiomaB.idiomas_id ASC'
        )
    );

}
