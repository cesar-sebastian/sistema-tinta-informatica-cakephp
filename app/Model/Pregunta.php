<?php
class Pregunta extends AppModel {
   public $name = 'Pregunta';
   public $useTable = 'preguntas_respuestas';
   
   public $hasMany = array(
   		'ItemPregunta' => array(
   				'className' => 'ItemPregunta',
   				'foreignKey'=> 'preguntas_id',
   				'order' => 'ItemPregunta.idiomas_id ASC'
   		)
   );

}