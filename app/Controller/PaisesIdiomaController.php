<?php

class PaisesIdiomaController extends AppController
{
	public $helpers = array('Html','Form');
	public $name = 'PaisesIdioma';
	var $uses = array ('PaisIdioma','Pais');
        
	var $layout = 'original_admin';

	public function _null(){

	}

	public function editar($id = null) {
		$permitidas = $this->Session->read('permitidas');
		
		$datos = null;
		if (isset($permitidas['paises_idioma']['editar']) && $permitidas['paises_idioma']['editar']) {
			//$this->layout="admin";
			if(!$id)
			{
				throw new Exception(__('Accion inválida'));
			}
	
			$data = $this->PaisIdioma->find('all',array('conditions'=>array('PaisIdioma.paises_id'=>$id)));
			
			//debug($data);
			//debug($this->request->data['ItemPregunta']); die();
			if (!$data)
			{
				//throw new Exception(__('Accion inválida'));
			} else {
				foreach ($data as $item) {
					$datos['PaisIdioma'][$item['PaisIdioma']['idiomas_id']]['id']=$item['PaisIdioma']['id'];
					$datos['PaisIdioma'][$item['PaisIdioma']['idiomas_id']]['pais']=$item['PaisIdioma']['pais'];
					$datos['PaisIdioma'][$item['PaisIdioma']['idiomas_id']]['idiomas_id']=$item['PaisIdioma']['idiomas_id'];
					$datos['PaisIdioma'][$item['PaisIdioma']['idiomas_id']]['paises_id']=$item['PaisIdioma']['paises_id'];
				}
			}
			
			/*if (!$this->request->data)
			{
				$datos = $this->request->data;
			}*/
			$this->set('datos', $datos);
			$pais = $this->Pais->find('first',array('conditions'=>array('Pais.id'=>$id)));
			$this->set('pais',$pais['Pais']['pais']);
			$this->set('paises_id',$id);
			//debug ($datos);
			if($this->request->is('post','put'))
			{
				//debug($this->request->data['ItemMultidiomaA']); die();
				//$this->DatosContacto->id = $id;
				$data = $this->request->data['PaisIdioma'];
				
				/*if (isset($this->request->data['PaisIdioma']['id'])) {
					$data['PaisIdioma']['id'] = $this->request->data['PaisIdioma']['id'];
				}*/
				//debug($data); die();
				if (!$this->PaisIdioma->saveAll($data)) {
					$this->Session->setFlash('Error, No pudo grabar datos del pais','flash_custom_error');
					//throw new Exception('Error, No pudo grabar datos del contacto');
				} else {
					$this->Session->setFlash('Ha sido grabado correctamente','flash_custom');
					if ( $this->Session->check('pag_paises')) {
						$page = $this->Session->read('pag_paises');
						$this->Session->delete('pag_paises');
						return $this->redirect('/paises/index/page:'.$page);
					} else {
						return $this->redirect(array('controller'=>'paises','action'=>'index'));
					}
				} 		
			}
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}

	}
	public function borrar($id = null) {
		$permitidas = $this->Session->read('permitidas');
		
		if (isset($permitidas['paises_idioma']['borrar']) && $permitidas['paises_idioma']['borrar']) {
			//$this->layout="admin";
			if($this->request->is('post'))
			{
				throw new MethodNotAllowedException();
			}
			if (isset($id)) {
				if($this->PaisIdioma->deleteAll(array('PaisIdioma.paises_id' => $id), false))
				{
					$this->Session->setFlash('El caso ha sido eliminado correctamente.','flash_custom');
					if ( $this->Session->check('pag_paises')) {
						$page = $this->Session->read('pag_paises');
						$this->Session->delete('pag_paises');
						return $this->redirect(array('controller'=>'paises','action'=>'index','page:'.$page));
					} else {
						return $this->redirect(array('controller'=>'paises','action'=>'index'));
					}
				} else {
					$this->Session->setFlash('No pudo borrar correctamente.','flash_custom_error');
					return $this->redirect(array('controller'=>'paises_idioma','action'=>'editar',$id));
				}
			} else {
				$this->Session->setFlash('No encuentra la id de pais antes de eliminarlos.','flash_custom_error');
				return $this->redirect(array('controller'=>'paises_idioma','action'=>'editar',$id));
			}
		} else {
			$this->Session->setFlash('No tiene permiso de borrar estos datos.','flash_custom_error');
			return $this->redirect(array('controller'=>'paises_idioma','action'=>'editar',$id));
		}
	}
}