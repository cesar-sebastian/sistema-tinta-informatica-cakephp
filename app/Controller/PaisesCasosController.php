<?php

class PaisesCasosController extends AppController
{
	public $helpers = array('Html','Form');
	public $name = 'PaisesCasos';
	var $uses = array ('PaisCaso','Pais','Caso');
	
    var $layout = 'original_admin';

    public function _null(){

    }

	public function index()
	{
		$permitidas = $this->Session->read('permitidas');
		if (isset($permitidas['paises_casos']['index']) && $permitidas['paises_casos']['index']) {
			//$this->layout="admin";
			$regiones = $this->Pais->Region->find('all',array('order'=>'Region.region'));
			$this->set('regiones',$regiones);
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}
	}

	private function getConditions()
	{
		$conditions = array();

		if(!empty($this->data['region']))
		{
			$conditions[] =  array('Pais.regiones_id' => trim($this->data['region']));
		}
		if(!empty($this->data['pais']))
		{
			$conditions[] =  array('Pais.pais like' => trim($this->data['pais'].'%'));
		}

		return $conditions;
	}


	public function guardar() {
		$permitidas = $this->Session->read('permitidas');
		if (isset($permitidas['paises_casos']['guardar']) && $permitidas['paises_casos']['guardar']) {
			//$this->layout="admin";
			$error = 1;
			//debug ($this->request->data);
			$regiones_id = $this->request->data['regiones'];
			$paises = $this->Pais->find('all',array('conditions'=>array('regiones_id'=>$regiones_id)));
			$i=0;
				foreach ($paises as $pais) {
					if (!empty($this->request->data['caso_'.$i])) {
						if (isset($this->request->data['paiscaso_'.$i]) && !empty($this->request->data['paiscaso_'.$i])) {
							//$this->PaisCaso->id = $this->request->data['paiscaso_'.$i];
							$data[$i]['PaisCaso']['id'] =  $this->request->data['paiscaso_'.$i];
						}
						$data[$i]['PaisCaso']['pais_id'] =  $this->request->data['pais_'.$i];
						$data[$i]['PaisCaso']['casos_id'] =  $this->request->data['caso_'.$i];
						if (!empty($this->request->data['convencion_'.$i])) {
							$data[$i]['PaisCaso']['convencion'] = $this->request->data['convencion_'.$i];
						} else {
							$data[$i]['PaisCaso']['convencion'] = 0;
						}
					} /*else {
						throw new Exception('Por favor marque uno de los casos');
					}*/
					$i++;	
				}
				if (isset($data)) {
					$this->PaisCaso->begin();
					try {
						if (!$this->PaisCaso->saveAll($data)) {
							throw new Exception('Error, No pudo grabar datos');
						} else {
							$this->PaisCaso->commit();
							$this->Session->setFlash('Ha sido guardado correctamente.','flash_custom');
							return $this->redirect(array('controller'=>$this->request->param('controller'),'action'=>'index'));
						}		
					}
					catch (Exception $e) {
						$this->PaisCaso->rollback();
						$this->Session->setFlash('Error. no se pudo guardar correctamente.','flash_custom');
					}
				} /*else {
					$this->Session->setFlash('Por favor marque uno de los casos','flash_custom_error');
					//return $this->redirect(array('controller'=>'admin','action'=>'index'));
					
				}*/
		} else {
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}
	}
	
	public function cargar_paises($regiones_id) {
		$this->layout=null;
		$paises = $this->Pais->find('all',array('conditions'=>array('regiones_id'=>$regiones_id),'order'=>'Pais.pais'));
		$casos = $this->Caso->find('all', array('conditions'=>array('Caso.completo'=>'1')));
		$paisescasos = $this->PaisCaso->find('all');
		$filas = null;
		
		if (!empty($paisescasos)) {
			foreach ($paisescasos as $paiscaso) {
				$filas[$paiscaso['PaisCaso']['pais_id']]['id']=$paiscaso['PaisCaso']['id'];
				$filas[$paiscaso['PaisCaso']['pais_id']]['pais']=$paiscaso['PaisCaso']['pais_id'];
				$filas[$paiscaso['PaisCaso']['pais_id']]['caso']=$paiscaso['PaisCaso']['casos_id'];
				$filas[$paiscaso['PaisCaso']['pais_id']]['convencion']=$paiscaso['PaisCaso']['convencion'];
			}
		}
		/*if (!empty($casos)) {
			foreach ($casos as $caso) {
				$columnas[$caso['Caso']['id']]=$caso['Caso']['color'];
			}
		}*/
		
		$this->set('paises',$paises);
		$this->set('casos',$casos);
		//$this->set('paisescasos',$paisescasos);
		$this->set('filas',$filas);
		//$this->set('columnas',$columnas);
		$this->render('cargar_paises_casos');
	}

	
}