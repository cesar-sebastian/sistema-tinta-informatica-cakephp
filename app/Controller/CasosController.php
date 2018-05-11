<?php

class CasosController extends AppController
{
	public $helpers = array('Html','Form');
	public $name = 'Casos';
	var $uses = array ('Caso','CasoMultidioma','ItemMultidiomaA','ItemMultidiomaB','PaisCaso');	
        
    var $layout = 'original_admin';

	public function _null(){
            
	}
	
	public function index()
	{
		$permitidas = $this->Session->read('permitidas');
		if (isset($permitidas['casos']['index']) && $permitidas['casos']['index']) {
			//$this->layout="admin";
			//$this->Session->write('mipopup',false);
			$this->paginate = array('limit'=>10,'order'=>array('Caso.cod_num'=>'ASC'));
			$data = $this->paginate( 'Caso' );
			$this->set('casos',$data);
			//debug($data);
			if($this->request->is('post') || $this->Session->check("#".$this->request->param('controller')))
			{
				$misesion = $this->Session->read("#".$this->request->param('controller'));
				if (empty($this->data) && isset($misesion)) $this->data = $misesion;
				$this->Session->write("#".$this->request->param('controller'),$this->data);
				$conditions = $this->getConditions();
				$this->paginate = array('conditions'=>$conditions,'limit'=>10,'order'=>array('Caso.cod_num'=>'ASC'));
				$data = $this->paginate( 'Caso' );
				$this->set('casos',$data);
				$this->set('cod_num', trim($this->data['cod_num']));
			}
			else
			{
				$this->set('cod_num', null);
			}
			//debug($misesion);
			/*if ($this->passedArgs) {
				$pagina = $this->passedArgs;
			$this->Session->write('pagina', $pagina['page']);
			} else {
			$this->Session->delete('pagina');
			}*/
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}
	}

	private function getConditions()
	{
		$conditions = array();

		if(!empty($this->data['cod_num']))
		{
			$conditions[] =  array('Caso.cod_num like' => trim($this->data['cod_num'].'%'));
		}

		return $conditions;
	}

	public function editar($id = null) {
		$permitidas = $this->Session->read('permitidas');
		
		if (isset($permitidas['casos']['editar']) && $permitidas['casos']['editar']) {
			//$this->layout="admin";
			if(!$id)
			{
				throw new Exception(__('Accion inválida'));
			}
	
			$caso = $this->Caso->findById($id);
	
			if (!$caso)
			{
				throw new Exception(__('Accion inválida'));
			} else {
				$aux = '';
				$i = 0;
				foreach ($caso['ItemMultidiomaA'] as $itemA) {
					//debug($itemA);
					if ($aux != $itemA['idiomas_id']) {
						$aux = $itemA['idiomas_id'];
						$i=0;
				
					} else {
						$i++;
					}
					$itemMultidiomaA['ItemMultidiomaA'][$itemA['idiomas_id']][$i]['id']=$itemA['id'];
					$itemMultidiomaA['ItemMultidiomaA'][$itemA['idiomas_id']][$i]['item']=$itemA['item'];
				}
				
				$aux = '';
				$i = 0;
				foreach ($caso['ItemMultidiomaB'] as $itemB) {
					//debug($itemA);
					if ($aux != $itemB['idiomas_id']) {
						$aux = $itemB['idiomas_id'];
						$i=0;
					} else {
						$i++;
					}
					$itemMultidiomaB['ItemMultidiomaB'][$itemB['idiomas_id']][$i]['id']=$itemB['id'];
					$itemMultidiomaB['ItemMultidiomaB'][$itemB['idiomas_id']][$i]['item']=$itemB['item'];
				}
			}
			if (!$this->request->data)
			{
				$this->request->data = $caso;
			}
			$this->set('itemMultidiomaA', $itemMultidiomaA);
			//debug ($itemMultidiomaA);
			$this->set('itemMultidiomaB', $itemMultidiomaB);
			//debug($itemMultidiomaB);
			if($this->request->is('post','put'))
			{
				//debug($this->request->data['ItemMultidiomaA']); die();
				/*debug($this->request->data);
				 die();*/
				$this->Caso->id = $id;
				$this->request->data['Caso']['id'] = $id;
				$data['Caso']['id'] = $id;
				$data['Caso']['cod_num'] = $this->request->data['Caso']['cod_num'];
				$data['Caso']['color'] = $this->request->data['Caso']['color'];
				$data['Caso']['completo'] = $this->request->data['Caso']['completo'];
			
				$this->Caso->begin();
				try {
					if (!$this->Caso->save($data)) {
						throw new Exception('Error, No pudo grabar caso');
					} else {
						$idCaso = $this->Caso->id;
					}
					//debug ($idCaso);
					foreach ($this->request->data['CasoMultidioma'] as $datos) {
						//$this->CasoMultidioma->id = $datos['id'];
						$casosM['CasoMultidioma']['casos_id'] = $idCaso;
						$casosM['CasoMultidioma']['id'] = $datos['id'];
						$casosM['CasoMultidioma']['idiomas_id'] = $datos['idiomas_id'];
						$casosM['CasoMultidioma']['titulo'] = $datos['titulo'];
						$casosM['CasoMultidioma']['leyenda'] = $datos['leyenda'];
						$casosM['CasoMultidioma']['leyenda_pie'] = $datos['leyenda_pie'];
						if (!$this->CasoMultidioma->saveAll($casosM)) {
							throw new Exception('Error, no pudo grabar casos multidiomas');
						}
						//debug($casosM);
					}
						
					$this->ItemMultidiomaA->deleteAll(array("ItemMultidiomaA.casos_id" => $idCaso));
					foreach ($this->request->data['ItemMultidiomaA'] as $datos=>$valor) {
						foreach ($valor as $item) {
							//$this->ItemMultidiomaA->id = $item['id'];
							$itemA['ItemMultidiomaA']['casos_id'] = $idCaso;
							$itemA['ItemMultidiomaA']['id'] = $item['id'];
							$itemA['ItemMultidiomaA']['idiomas_id'] = $item['idiomas_id'];
							$itemA['ItemMultidiomaA']['item'] = $item['item'];
							//debug($itemA);
							if (!$this->ItemMultidiomaA->saveAll($itemA)) {
								throw new Exception('Error, no pudo grabar item A');
							}
							//debug($itemA);
						}
					}
					$this->ItemMultidiomaB->deleteAll(array("ItemMultidiomaB.casos_id" => $idCaso));
					foreach ($this->request->data['ItemMultidiomaB'] as $datos=>$valor) {
						foreach ($valor as $item) {
							$itemB['ItemMultidiomaB']['casos_id'] = $idCaso;
							$itemB['ItemMultidiomaB']['id'] = $item['id'];
							$itemB['ItemMultidiomaB']['idiomas_id'] = $item['idiomas_id'];
							$itemB['ItemMultidiomaB']['item'] = $item['item'];
							//debug($itemB);
							if (!$this->ItemMultidiomaB->saveAll($itemB)) {
								throw new Exception('Error, no pudo grabar item B');
							}
							//debug($itemB);
						}
					}
					//die();
					$this->Caso->commit();
					$this->Session->setFlash('El caso ha sido guardado correctamente.','flash_custom');
					if (!$this->request->data['opcion']) {
						if ( $this->Session->check('pag_'.$this->request->param('controller'))) {
							$page = $this->Session->read('pag_'.$this->request->param('controller'));
							$this->Session->delete('pag_'.$this->request->param('controller'));
							return $this->redirect('/casos/index/page:'.$page);
						} else {
							return $this->redirect(array('controller'=>$this->request->param('controller'),'action'=>'index'));
						}
					} else {
						return $this->redirect('/casos/editar/'.$id);
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
					$this->Caso->rollback();
					$this->Session->setFlash('El caso no se pudo grabar correctamente.','flash_custom_error');
				}
			}
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}

	}

	public function agregar() {
		$permitidas = $this->Session->read('permitidas');
		
		if (isset($permitidas['casos']['agregar']) && $permitidas['casos']['agregar']) {
			//$this->layout="admin";
			$ultimo = $this->Caso->find('first',array('order'=>array('cod_num'=>'DESC')));
			if (isset($ultimo['Caso']['cod_num'])) 
				$cod_num = $ultimo['Caso']['cod_num']+1;
			else
				$cod_num=null;
			//debug($ultimo);
			$this->set('cod_num', $cod_num);
			if($this->request->is('post'))
			{
				//debug($this->request->data); 
				//die();
				$data['Caso']['cod_num'] = $this->request->data['Caso']['cod_num'];
				$data['Caso']['color'] = $this->request->data['Caso']['color'];
				
				$this->Caso->begin();
				try {
					if (!$this->Caso->save($data)) {
						throw new Exception('Error, No pudo grabar caso');
					} else {
						$idCaso = $this->Caso->id;
					}
					//debug ($idCaso);
					foreach ($this->request->data['CasoMultidioma'] as $datos) {
						$casosM['CasoMultidioma']['casos_id'] = $idCaso;
						$casosM['CasoMultidioma']['idiomas_id'] = $datos['idiomas_id'];
						$casosM['CasoMultidioma']['titulo'] = $datos['titulo'];
						$casosM['CasoMultidioma']['leyenda'] = $datos['leyenda'];
						$casosM['CasoMultidioma']['leyenda_pie'] = $datos['leyenda_pie'];
						if (!$this->CasoMultidioma->saveAll($casosM)) {
							throw new Exception('Error, no pudo grabar casos multidiomas');
						}
						//debug($casosM);
					}
					
					
					foreach ($this->request->data['ItemMultidiomaA'] as $datos=>$valor) {
						foreach ($valor as $item) {
							$itemA['ItemMultidiomaA']['casos_id'] = $idCaso;
							$itemA['ItemMultidiomaA']['idiomas_id'] = $item['idiomas_id'];
							$itemA['ItemMultidiomaA']['item'] = $item['item'];
							if (!$this->ItemMultidiomaA->saveAll($itemA)) {
								throw new Exception('Error, no pudo grabar item A');
							}
							//debug($itemA);
						}	
					}
					
					foreach ($this->request->data['ItemMultidiomaB'] as $datos=>$valor) {
						foreach ($valor as $item) {
							$itemB['ItemMultidiomaB']['casos_id'] = $idCaso;
							$itemB['ItemMultidiomaB']['idiomas_id'] = $item['idiomas_id'];
							$itemB['ItemMultidiomaB']['item'] = $item['item'];
							if (!$this->ItemMultidiomaB->saveAll($itemB)) {
								throw new Exception('Error, no pudo grabar item B');
							}
							//debug($itemB);
						}	
					}
					$this->Caso->commit();
					$this->Session->setFlash('El caso se ha creado correctamente.','flash_custom');
					if (!$this->request->data['opcion']) {
						if ( $this->Session->check('pag_'.$this->request->param('controller'))) {
							$page = $this->Session->read('pag_'.$this->request->param('controller'));
							$this->Session->delete('pag_'.$this->request->param('controller'));
							return $this->redirect('/casos/index/page:'.$page);
						} else {
							return $this->redirect(array('controller'=>$this->request->param('controller'),'action'=>'index'));
						}
					} else {
						if ($idCaso) {
							return $this->redirect('/casos/editar/'.$idCaso);
						}
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
					$this->Caso->rollback();
					$this->Session->setFlash('El caso no se pudo grabar correctamente.','flash_custom_error');
				}
			}
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}

	}
	
	public function verificar()
	{
		$this->layout = null;
		$data = array('existe' => 0);
		$cod_num = $this->data['cod_num'];
		if ($cod_num) {
			$existe = $this->Caso->find('list', array('conditions'=> array('Caso.cod_num' => $cod_num)));
			if (isset($existe) && !empty($existe)) {
				$data = array('existe' => 1);
			}
		}
		$this->set('data', $data);
		$this->render('/Elements/ajaxreturn');
	}
	
	public function verificar_caso()
	{
		$this->layout = null;
		$casos_id = $this->data['casos_id'];
		if ($casos_id) {
			//$cod = $this->Caso->find('first', array('conditions'=> array('Caso.id' => $casos_id)));
			$existe = $this->PaisCaso->find('all', array('conditions'=> array('PaisCaso.casos_id' => $casos_id)));
		 	if (isset($existe) && count($existe)) {
				//if (isset($cod['Caso']['cod_num'])) {
					//$data = array('existe' => $cod['Caso']['cod_num']);
				//}
		 		$data['existe'] = $this->data['casos_id'];
			} else {
				$data['existe'] = null;
			}
			//$data = array('codigo' => $cod['Caso']['cod_num']);
			$data['codigo'] = $this->data['codigo'];
			
		}
		$this->set('data', $data);
		$this->render('/Elements/ajaxreturn');
	}

	public function eliminar($id){
		$permitidas = $this->Session->read('permitidas');
		if (isset($permitidas['casos']['eliminar']) && $permitidas['casos']['eliminar']) {
			//$this->layout="admin";
			if($this->request->is('post'))
			{
				throw new MethodNotAllowedException();
			}
			$existe = $this->PaisCaso->find('first', array('conditions'=> array('PaisCaso.casos_id' => $id)));
			if (isset($existe) && !empty($existe)) {
				//$this->Session->setFlash('No pudo borrar porque esta asociado con los paises-casos. Para eliminarlo, debes deseleccionar los paises-casos.','flash_custom_error');
				$this->redirect(array('action'=>'index'));
			} else {
				if($this->Caso->delete($id))
				{
					$this->Session->setFlash('El caso ha sido eliminado correctamente.','flash_custom');
					$this->redirect(array('action'=>'index'));
				}
			}
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}

	}

	public function ver($id = null)
	{
		//$this->layout = 'admin';
		$this->Session->write('mipopup',true);
		$this->set('forma', $this->Caso->findById($id));
	}

	/*public function limpiar() {
		$this->Session->delete($this->request->param('controller'));
	$this->redirect(array('action'=>'index'));
	}*/
}