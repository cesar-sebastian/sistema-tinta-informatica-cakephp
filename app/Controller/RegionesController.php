<?php

class RegionesController extends AppController
{
	public $helpers = array('Html','Form');
	public $name = 'Regiones';
	var $uses = array ('Region');
        
	var $layout = 'original_admin';

	public function _null() {

	}

	public function index()
	{
		$permitidas = $this->Session->read('permitidas');
		
		if (isset($permitidas['regiones']['index']) && $permitidas['regiones']['index']) {
			//$this->layout="admin";
			$limite = 10;
			//$this->Session->write('mipopup',false);
			$this->paginate = array('limit'=>$limite);
			$data = $this->paginate( 'Region' );
			$this->set('regiones',$data);
			if($this->request->is('post') || $this->Session->check("#".$this->request->param('controller')))
			{
				$misesion = $this->Session->read("#".$this->request->param('controller'));
				if (empty($this->data) && isset($misesion)) $this->data = $misesion;
				$this->Session->write("#".$this->request->param('controller'),$this->data);
				$conditions = $this->getConditions();
				$this->paginate = array('conditions'=>$conditions,'limit'=>$limite);
				$data = $this->paginate( 'Region' );
					
				$this->set('regiones',$data);
				$this->set('region', trim($this->data['region']));
			}
			else
			{
				$this->set('region', null);
			}
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}
	}

	private function getConditions()
	{
		$conditions = array();

		if(!empty($this->data['region']))
		{
			$conditions[] =  array('Region.region like' => trim($this->data['region'].'%'));
		}

		return $conditions;
	}

	public function editar($id = null) {
		$permitidas = $this->Session->read('permitidas');
		$puede_cargar_path = $this->Session->read('puede_cargar_path');
		$puede_publico_path = $this->Session->read('puede_publico_path');
		if (isset($permitidas['regiones']['editar']) && $permitidas['regiones']['editar']) {
			//$this->layout="admin";
			if(!$id)
			{
				throw new Exception(__('Accion inválida'));
			}
	
			$datos = $this->Region->findById($id);
	
			//debug($this->request->data['ItemPregunta']); die();
			if (!$datos)
			{
				throw new Exception(__('Accion inválida'));
			} 
	
			if (!$this->request->data)
			{
				$this->request->data = $datos;
			}
			
			if($this->request->is('post','put'))
			{
				//debug($this->request->data['ItemMultidiomaA']); die();
				$this->Region->id = $id;
				$this->request->data['Region']['id'] = $id;
				$data = $this->request->data;
				if (!$this->Region->save($data)) {
					throw new Exception('Error, No pudo grabar region');
				} else {
					$this->Session->setFlash('Ha sido grabado correctamente.','flash_custom');
					if ( $this->Session->check('pag_'.$this->request->param('controller'))) {
						$page = $this->Session->read('pag_'.$this->request->param('controller'));
						$this->Session->delete('pag_'.$this->request->param('controller'));
						return $this->redirect('/regiones/index/page:'.$page);
					} else {
						return $this->redirect(array('controller'=>$this->request->param('controller'),'action'=>'index'));
					}
				}	
			}
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}

	}

	public function agregar() {
		$permitidas = $this->Session->read('permitidas');
		
		if (isset($permitidas['regiones']['agregar']) && $permitidas['regiones']['agregar']) {
			//$this->layout="admin";
			if($this->request->is('post'))
			{
				
				$data = $this->request->data;
				if (!$this->Region->save($data)) {
					throw new Exception('Error, No pudo grabar región');
				} else {
					$this->Session->setFlash('Ha sido creado correctamente.','flash_custom');
					if ( $this->Session->check('pag_'.$this->request->param('controller'))) {
						$page = $this->Session->read('pag_'.$this->request->param('controller'));
						$this->Session->delete('pag_'.$this->request->param('controller'));
						return $this->redirect('/regiones/index/page:'.$page);
					} else {
						return $this->redirect(array('controller'=>$this->request->param('controller'),'action'=>'index'));
					}
				}
			}
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}
	}
	
	public function eliminar($id){
		$permitidas = $this->Session->read('permitidas');
		
		if (isset($permitidas['regiones']['eliminar']) && $permitidas['regiones']['eliminar']) {
			//$this->layout="admin";
			if($this->request->is('post'))
			{
				throw new MethodNotAllowedException();
			}
	
			if($this->Region->delete($id))
			{
				$this->Session->setFlash('Ha sido eliminado correctamente.','flash_custom');
				$this->redirect(array('action'=>'index'));
			}
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}

	}

	public function ver($id = null)
	{
		//$this->layout = 'admin';
		$this->Session->write('mipopup',true);
		$this->set('region', $this->Region->findById($id));
	}

	/*public function limpiar() {
		$this->Session->delete($this->request->param('controller'));
	$this->redirect(array('action'=>'index'));
	}*/
}