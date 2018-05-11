<?php
 
class PreguntasController extends AppController
{
	public $helpers = array('Html','Form');
	public $name = 'Preguntas';
	var $uses = array ('Pregunta','ItemPregunta');
        
        var $layout = 'original_admin';

        public function _null() {

        }

	
	
	public function index()
	{
		$permitidas = $this->Session->read('permitidas');
		
		if (isset($permitidas['preguntas']['index']) && $permitidas['preguntas']['index']) {
			//$this->layout="admin";
			//$this->Session->write('mipopup',false);
			//$this->paginate = array('limit'=>5);
			$conditions = $this->getConditions();
			//$joins = $this->getJoins();
			//$this->paginate = array('conditions'=>$conditions,'joins'=> $joins,'limit'=>10);
			$this->paginate = array('conditions'=>$conditions,'limit'=>10);
			$data = $this->paginate( 'ItemPregunta' );
			$this->set('preguntas',$data);
			/*if($this->request->is('post') || $this->Session->check("#".$this->request->param('controller')))
				{
			$misesion = $this->Session->read("#".$this->request->param('controller'));
			if (empty($this->data) && isset($misesion)) $this->data = $misesion;
			$this->Session->write("#".$this->request->param('controller'),$this->data);
			$conditions = $this->getConditions();
			$this->paginate = array('conditions'=>$conditions,'limit'=>5);
			$data = $this->paginate( 'Caso' );
		
			$this->set('casos',$data);
			$this->set('cod_num', trim($this->data['numero']));
			}
			else
			{
			$this->set('cod_num', null);
			}*/
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}
	}
	/*private function getJoins(){
		$join = array(
				array(
						'table' => 'item_pregresp',
						'alias' => 'i',
						'type' => 'LEFT',
						'conditions' => array('i.preguntas_id=Pregunta.id',)
				)
		);
	
		return $join;
	}*/
	private function getConditions()
	{
		$conditions = array();

		$conditions[] =  array('ItemPregunta.idiomas_id' => 1);

		return $conditions;
	}

	public function editar($id = null) {
		$permitidas = $this->Session->read('permitidas');
		if (isset($permitidas['preguntas']['editar']) && $permitidas['preguntas']['editar']) {
			//$this->layout="admin";
			if(!$id)
			{
				//throw new Exception(__('Accion inválida'));
				$pregunta = $this->Pregunta->find('first');
				if (isset($pregunta) && count($pregunta)) {
					$id = $pregunta['Pregunta']['id'];
				} else {
					throw new Exception(__('Accion inválida'));
				}
			}
			
			$pregunta = $this->Pregunta->findById($id);
	
			//debug($this->request->data['ItemPregunta']); die();
			if (!$pregunta)
			{
				throw new Exception(__('Accion inválida'));
			} else {
				$aux = '';
				$i = 0;
				foreach ($pregunta['ItemPregunta'] as $item) {
					//debug($item);
					if ($aux != $item['idiomas_id']) {
						$aux = $item['idiomas_id'];
						$i=0;
				
					} else {
						$i++;
					}
					$itemPregunta['ItemPregunta'][$item['idiomas_id']][$i]['id']=$item['id'];
					$itemPregunta['ItemPregunta'][$item['idiomas_id']][$i]['preg_resp']=$item['preg_resp'];
				}
				
				
			}
	
			if (!$this->request->data)
			{
				$this->request->data = $pregunta;
			}
			$this->set('itemPregunta', $itemPregunta);
			//debug ($itemPregunta);
			if($this->request->is('post','put'))
			{
				//debug($this->request->data['ItemMultidiomaA']); die();
				$this->Pregunta->id = $id;
				$this->request->data['Pregunta']['id'] = $id;
				$data['Pregunta']['id'] = $id;
				$data['Pregunta']['titulo'] = $this->request->data['Pregunta']['titulo'];
				$this->Pregunta->begin();
				try {
					if (!$this->Pregunta->save($data)) {
						throw new Exception('Error, No pudo grabar pregunta/respuesta');
					} else {
						$idPregunta = $this->Pregunta->id;
					}
					$this->ItemPregunta->deleteAll(array("ItemPregunta.preguntas_id" => $id));
					foreach ($this->request->data['ItemPregunta'] as $datos=>$valor) {
						foreach ($valor as $item) {
							//$this->ItemMultidiomaA->id = $item['id'];
							$preg['ItemPregunta']['preguntas_id'] = $idPregunta;
							$preg['ItemPregunta']['id'] = $item['id'];
							$preg['ItemPregunta']['idiomas_id'] = $item['idiomas_id'];
							$preg['ItemPregunta']['preg_resp'] = $item['item'];
							//debug($itemA);
							if (!$this->ItemPregunta->saveAll($preg)) {
								throw new Exception('Error, no pudo grabar pregunta/respuesta');
							}
							//debug($itemA);
						}
					}
				
					//die();
					$this->Pregunta->commit();
					$this->Session->setFlash('Se han actualizado las preguntas correctamente','flash_custom');
					if ( $this->Session->check('pag_'.$this->request->param('controller'))) {
						$page = $this->Session->read('pag_'.$this->request->param('controller'));
						$this->Session->delete('pag_'.$this->request->param('controller'));
						return $this->redirect('/preguntas/index/page:'.$page);
					} else {
						return $this->redirect(array('controller'=>$this->request->param('controller'),'action'=>'editar'));
					}
				
				}
				catch (Exception $e) {
					/*print_r("<pre>");
					 print_r($e);
					print_r("</pre>");*/
					//debug($this->Caso->invalidFields());
					//debug($this->CasoMultidioma->invalidFields());
					/*debug($this->ItemMultidiomaA->invalidFields());
					 debug($this->ItemMultidiomaB->invalidFields());*/
					$this->Pregunta->rollback();
					$this->Session->setFlash('Error, no se pudo grabar correctamente.','flash_custom');
				}		
			}
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}

	}

	public function agregar() {
		$permitidas = $this->Session->read('permitidas');
		
		if (isset($permitidas['preguntas']['agregar']) && $permitidas['preguntas']['agregar']) {
			//$this->layout="admin";
			if($this->request->is('post'))
			{
				//debug($this->request->data); 
				//die();
				
				$data['Pregunta']['titulo'] = $this->request->data['Pregunta']['titulo'];
				$this->Pregunta->begin();
				try {
					if (!$this->Pregunta->save($data)) {
						throw new Exception('Error, No pudo grabar pregunta/respuesta');
					} else {
						$idPregunta = $this->Pregunta->id;
					}
					$this->ItemPregunta->deleteAll(array("ItemPregunta.preguntas_id" => $idPregunta));
					foreach ($this->request->data['ItemPregunta'] as $datos=>$valor) {
						foreach ($valor as $item) {
							$preg['ItemPregunta']['preguntas_id'] = $idPregunta;
							$preg['ItemPregunta']['idiomas_id'] = $item['idiomas_id'];
							$preg['ItemPregunta']['preg_resp'] = $item['item'];
							if (!$this->ItemPregunta->saveAll($preg)) {
								throw new Exception('Error, no pudo grabar pregunta/respuesta');
							}
							//debug($itemA);
						}	
					}
					
					$this->Pregunta->commit();
					$this->Session->setFlash('Ha sido creado correctamente.','flash_custom');
					if ( $this->Session->check('pag_'.$this->request->param('controller'))) {
						$page = $this->Session->read('pag_'.$this->request->param('controller'));
						$this->Session->delete('pag_'.$this->request->param('controller'));
						return $this->redirect('/preguntas/index/page:'.$page);
					} else {
						return $this->redirect(array('controller'=>$this->request->param('controller'),'action'=>'index'));
					}
					
				}
				catch (Exception $e) {
					/*print_r("<pre>");
					print_r($e);
					print_r("</pre>");*/
					//debug($this->Caso->invalidFields());
				    //debug($this->CasoMultidioma->invalidFields());
					/*debug($this->ItemMultidiomaA->invalidFields());
					debug($this->ItemMultidiomaB->invalidFields());*/
					$this->Pregunta->rollback();
					$this->Session->setFlash('Error, no se pudo grabar correctamente.','flash_custom');
				}
			}
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}

	}
	
	public function eliminar($id){
		$permitidas = $this->Session->read('permitidas');
		
		if (isset($permitidas['preguntas']['eliminar']) && $permitidas['preguntas']['eliminar']) {
			//$this->layout="admin";
			if($this->request->is('post'))
			{
				throw new MethodNotAllowedException();
			}
	
			if($this->Pregunta->delete($id))
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
		$this->set('pregunta', $this->Pregunta->findById($id));
	}

	/*public function limpiar() {
		$this->Session->delete($this->request->param('controller'));
	$this->redirect(array('action'=>'index'));
	}*/
}