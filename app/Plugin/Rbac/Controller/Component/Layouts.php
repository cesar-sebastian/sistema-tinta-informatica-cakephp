<?php  
/**
 * Layouts component.
 *
 * Layouts component that allowes to choose the application's layout.
 *
 * PHP version 5
 * 
 * (C) Copyright 2014, Sebastián Bustelo
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * 
 * @author        wbs
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

class LayoutsComponent extends Object{

	public $components = array('Session');

	public function initialize(&$controller) {
		$view_paths = App::path('View');
		array_unshift($view_paths, ROOT.DS.'Plugin'.DS.'Rbac'.DS.'View'.DS, APP.'Plugin'.DS.'Rbac'.DS.'View'.DS);
		App::build(array('View' => $view_paths));

		$controller->layout = $this->__setLayout();
	}

	private function __setLayout(){
		$layout = $this->Session->read('Configuraciones.Rbac.Layout');
		if(empty($layout)){
			// Read the whole settings table
			$settings = ClassRegistry::init('Configracion')->find('all');
			foreach($settings as $value){
				// Write each setting value from the database to session.
				$this->Session->write('Configraciones.'.$value['Configuracion']['categoria'].'.'.$value['Configuracion']['configuracion'], $value['Configuracion']['valor']);
				if($value['Configuracion']['categoria'] == 'Rbac' AND $value['Configuracion']['configuracion'] == 'Layout'){
					$layout = $value['Configuracion']['valor'];
				}
			}
		}
		return $layout;
	}
}
?>