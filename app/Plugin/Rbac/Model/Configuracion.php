<?php

class Configuracion extends AppModel {
    
    public $useTable = 'configuracion';
    public $validate = array(
        'id' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'allowEmpty' => true
            )
        ),
        'clave' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true
            )
        ),
        'valor' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true
            )
        )
    );

}
