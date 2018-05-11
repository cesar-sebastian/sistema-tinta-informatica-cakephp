<?php

class InicioController extends AppController {
    
	public $helpers = array('Html','Form');
	public $name = 'Inicio';
	var $uses = array ('Pais','PaisIdioma','Ciudad','Caso','PaisCaso','CasoMultidioma','ItemMultidiomaA','ItemMultidiomaB',
			'Pregunta','DatosContacto','Sede','Direccion','Telefono');
        
        var $layout = 'public';

        public function _null(){

        }        
	
	public function index() 
	{	      
		//$this->layout="default";
		$paises_idioma = null;
		$join = $this->getJoins();
		if ($this->idioma_id!=1) {
			$paises_idioma = $this->PaisIdioma->find('all',array('conditions'=>array('PaisIdioma.idiomas_id'=>$this->idioma_id),'order'=>array('PaisIdioma.pais'=>'ASC')));
		} else {
			$paises = $this->PaisIdioma->find('all',array('order'=>array('Pais.pais'=>'ASC')));
		}
		if (isset($paises_idioma)) $paises = $paises_idioma;
		//debug($paises);
		$this->set('paises',$paises);
		$this->Session->write('paises',$paises);
	}
	
	private function getJoins(){
		$join = array(
				array(
						'table' => 'paises_idioma',
						'alias' => 'p',
						'type' => 'LEFT',
						'conditions' => array('p.paises_id=Pais.id')
				)
		);
	
		return $join;
	}
		
	public function cargar_tramite() {
		$this->layout=null;
		$tramite = '';
		
		if (isset($this->data['pais']) && isset($this->data['ciudad'])) {
			$pais = $this->data['pais'];
			$ciudad = $this->data['ciudad'];
			$pais_rel = $this->Ciudad->find('first',array('conditions'=>array('Ciudad.id'=>$ciudad)));
			//$conditions = array('Sede.pais_id'=>$pais, 'Sede.idciudades'=>$ciudad);
			$conditions = array('Sede.pais_id'=>$pais_rel['Ciudad']['paises_id'],'Sede.idciudades'=>$ciudad,'Sede.sede_padre'=>NULL);
			$sedes = $this->Sede->find('all',array('conditions'=>$conditions));
			$sede_id=null;
			if (isset($sedes) && count($sedes)) {
				foreach ($sedes as $sede) {
					if ((count($sedes) > 1) && (substr($sede['Sede']['sigla'],0,1)=='C')) {
						$sede_id = $sede['Sede']['id'];
					} elseif (count($sedes) == 1) {
						$sede_id = $sede['Sede']['id'];
					}
					if (isset($sede_id)) {
						$conditions = array('Direccion.sede_id'=>$sede_id);
						$direcciones = $this->Direccion->find('all',array('conditions'=>$conditions));
						if (isset($direcciones) && count($direcciones)) {
							foreach ($direcciones as $direccion) {
								if (isset($direccion['Direccion']['direccion'])) {
									
									if ($direccion['Direccion']['tipo_direccion_id'] == 1 && !empty($direccion['Direccion']['direccion'])) {
										$tramite.='<p>';
										$tramite.='<img src="/img/icono_home2.png" border="0" />&nbsp;&nbsp;&nbsp;';
										$tramite.=$direccion['Direccion']['direccion'];
										$tramite.='</p>';
									}
									if ($direccion['Direccion']['tipo_direccion_id'] == 3 && !empty($direccion['Direccion']['direccion'])) {
										$tramite.='<p>';
										$tramite.='<img src="/img/icono_email2.png" border="0" />&nbsp;&nbsp;&nbsp;';
										$tramite.=$direccion['Direccion']['direccion'];
										$tramite.='</p>';
									}
									if ($direccion['Direccion']['tipo_direccion_id'] == 4 && !empty($direccion['Direccion']['direccion'])) {
										$tramite.='<p>';
										$tramite.='<img src="/img/icono_web2.png" border="0" />&nbsp;&nbsp;&nbsp;';
										$tramite.='<a href="'.$direccion['Direccion']['direccion'].'" target="_blank">'.$direccion['Direccion']['direccion'].'</a>';
										$tramite.='</p>';
									}
								}
								
							}
						}
						$conditions = array('Telefono.sede_id'=>$sede['Sede']['id']);
						$telefonos = $this->Telefono->find('all',array('conditions'=>$conditions));
						if (isset($telefonos) && count($telefonos)) {
							$tramite.='<p>';
							$tramite.='<img src="/img/icono_tel2.png" border="0" />&nbsp;&nbsp;&nbsp;';
							$i=0;
							foreach ($telefonos as $telefono) {
								if (isset($telefono['Telefono']['numero'])) {
									if ($telefono['Telefono']['tipo_telefono_id'] == 1) {
										if ($i>0) $tramite.=' / ';
										$tramite.=$telefono['Telefono']['numero'];
									}
								}
								$i++;
							}
							$tramite.='</p>';
						}
						if (isset($sede['Sede']['hora_atencion'])) {
							$tramite.='<p><img src="/img/icono_horario2.png" border="0" />&nbsp;&nbsp;&nbsp;';
							$tramite.=$sede['Sede']['hora_atencion'];
							$tramite.='</p>';
						}
					}
				}
				
			} else {
				$tramite = null;
			}
				
		}
		$this->set('data', $tramite);
		$this->render('/Elements/ajaxreturn');
	}
	
	public function cargar_paises_ciudades() {
		$this->layout=null;
		$combo_pais = null;
		$combo_ciudad= null;
		if ($this->idioma_id!=1) {
			$paises = $this->PaisIdioma->find('all',array('conditions'=>array('PaisIdioma.idiomas_id'=>$this->idioma_id),'order'=>array('PaisIdioma.pais'=>'ASC')));
		} else {
			$paises = $this->PaisIdioma->find('all',array('order'=>array('Pais.pais'=>'ASC')));
		}
		//if (isset($paises_idioma)) $paises = $paises_idioma;
		if (isset($this->data['pais'])) {
			$pais = $this->data['pais'];
			//$paises = $this->Session->read('paises');
			App::uses('HttpSocket', 'Network/Http');
			$HttpSocket = new HttpSocket();
			$response = $HttpSocket->get('http://desa.datosrepresentaciones.mrec.ar/wspaises/cargar_concurrencias_pais.php');
			$ciudades = unserialize($response['body']);
			$response = $HttpSocket->get('http://desa.datosrepresentaciones.mrec.ar/wspaises/cargar_sin_concurrencias.php');
			$concurrencias = unserialize($response['body']);
			$i=0;
			foreach ($ciudades as $ciudad) {
				if ($ciudad['Ciudad']['paises_id']==$pais){
					$datos[$i]['Ciudad']['id']=$ciudad['Ciudad']['id'];
					$datos[$i]['Ciudad']['nombre']=$ciudad['Ciudad']['nombre'];
					$datos[$i]['Ciudad']['paises_id']=$ciudad['Ciudad']['paises_id'];
					$datos[$i]['Ciudad']['paisesrel_id']=$ciudad['Ciudad']['paisesrel_id'];
					$datos[$i]['Ciudad']['paisesrel_nombre']=$ciudad['Ciudad']['paisesrel_nombre'];
					$i++;
				}
			}
			
			if (!isset($datos) && empty($datos)) {
				$conditions = array('Ciudad.paises_id'=>$pais);
				$ciudades = $this->Ciudad->find('all',array('conditions'=>$conditions,'order'=>array('Pais.pais'=>'ASC')));
				$combo_pais = '<option value=\'-1\'>'.$this->sel_pais.'</option>';
				$aux_pais='';
				//debug($paises);
				foreach ($paises as $p) {
					if ($this->idioma_id!=1) {
						$dif = in_array($p['PaisIdioma']['paises_id'],$concurrencias);
						if (!$dif) {
							if ($aux_pais!=$p['PaisIdioma']['paises_id']) {
								$combo_pais .= '<option value=\''.$p['PaisIdioma']['paises_id'].'\'';
								if ($p['PaisIdioma']['paises_id']==$pais) {
									$combo_pais .= ' selected="selected"';
								}
								$combo_pais .= '>'.$p['PaisIdioma']['pais'].'</option>';
							}
							$aux_pais = $p['PaisIdioma']['paises_id'];
						}
					} else {
						$dif = in_array($p['Pais']['id'],$concurrencias);
						if (!$dif) {
							if ($aux_pais!=$p['Pais']['id']) {
								$combo_pais .= '<option value=\''.$p['Pais']['id'].'\'';
								if ($p['Pais']['id']==$pais) {
									$combo_pais .= ' selected="selected"';
								}
								$combo_pais .= '>'.$p['Pais']['pais'].'</option>';
							}
							$aux_pais = $p['Pais']['id'];
						}
					}
				}
			} else {
				$ciudades = $datos;
				$combo_pais = '<option value=\'-1\'>'.$this->sel_pais.'</option>';
				$aux_pais='';
				$i = 1;
				foreach ($ciudades as $ciudad) {
					$pais_rel=null;
					if ($aux_pais!=$ciudad['Ciudad']['paisesrel_nombre']) {
						
						$combo_pais .= '<option value=\''.$ciudad['Ciudad']['paisesrel_id'].'\'';
						if ($i==1) { 
							$combo_pais .= ' selected="selected"';
							$pais_rel_id = $ciudad['Ciudad']['paisesrel_id'];
							if ($this->idioma_id!=1) {
								$pais_rel = $this->PaisIdioma->find('first',array('conditions'=>array('PaisIdioma.idiomas_id'=>$this->idioma_id,'PaisIdioma.paises_id'=>$pais_rel_id)));
							}
						}
						if (isset($pais_rel['PaisIdioma'])) {
							$combo_pais .= '>'.$pais_rel['PaisIdioma']['pais'].'</option>';
						} else {
							$combo_pais .= '>'.$ciudad['Ciudad']['paisesrel_nombre'].'</option>';
						}
						
					}
					$aux_pais=$ciudad['Ciudad']['paisesrel_nombre'];
					$i++;
				}
				foreach ($paises as $p) {
					if ($this->idioma_id!=1) {
						$dif = in_array($p['PaisIdioma']['paises_id'],$concurrencias);
						if (!$dif) {
							if ($aux_pais!=$p['PaisIdioma']['paises_id'] && $pais_rel_id != $p['PaisIdioma']['paises_id'] ) {
								$combo_pais .= '<option value=\''.$p['Pais']['id'].'\'';
								/*if ($p['Pais']['id']==$pais) {
									$combo_pais .= ' selected="selected"';
								}*/
								$combo_pais .= '>'.$p['PaisIdioma']['pais'].'</option>';
							}
							$aux_pais = $p['PaisIdioma']['paises_id'];
						}
					} else {
						$dif = in_array($p['Pais']['id'],$concurrencias);
						if (!$dif) {
							if ($aux_pais!=$p['Pais']['id'] && $pais_rel_id != $p['Pais']['id'] ) {
								$combo_pais .= '<option value=\''.$p['Pais']['id'].'\'';
								/*if ($p['Pais']['id']==$pais) {
								 $combo_pais .= ' selected="selected"';
								}*/
								$combo_pais .= '>'.$p['Pais']['pais'].'</option>';
							}
							$aux_pais = $p['Pais']['id'];
						}
					}
				}
			}
			$combo_ciudad = '<option value=\'-1\'>'.$this->sel_ciudad.'</option>';
			foreach ($ciudades as $ciudad) {
				$combo_ciudad .= '<option value=\''.$ciudad['Ciudad']['id'].'\'>'.$ciudad['Ciudad']['nombre'].'</option>';
			}
		}
		$data['ciudades']=$combo_ciudad;
		$data['paises']=$combo_pais;
		$this->set('data', $data);
		$this->render('/Elements/ajaxreturn');
	}
	
	
	public function cargar_ciudades() {
		$this->layout=null;
		$combo = '';
		if (isset($this->data['pais'])) {
			$pais = $this->data['pais'];
				
			App::uses('HttpSocket', 'Network/Http');
			$HttpSocket = new HttpSocket();
			$response = $HttpSocket->get('http://desa.datosrepresentaciones.mrec.ar/wspaises/cargar_concurrencias_pais.php');
			$ciudades = unserialize($response['body']);
			$i=0;
			foreach ($ciudades as $ciudad) {
				if ($ciudad['Ciudad']['paises_id']==$pais){
					$datos[$i]['Ciudad']['id']=$ciudad['Ciudad']['id'];
					$datos[$i]['Ciudad']['nombre']=$ciudad['Ciudad']['nombre'];
					$datos[$i]['Ciudad']['paises_id']=$ciudad['Ciudad']['paises_id'];
					$i++;
				}
			}
			if (!isset($datos) && empty($datos)) {
				$conditions = array('Ciudad.paises_id'=>$pais);
				$ciudades = $this->Ciudad->find('all',array('conditions'=>$conditions,'order'=>array('Pais.pais'=>'ASC')));
			} else {
				$ciudades = $datos;
			}
			$combo = '<option value=\'-1\'>'.$this->sel_ciudad.'</option>';
			foreach ($ciudades as $ciudad) {
				$combo .= '<option value=\''.$ciudad['Ciudad']['id'].'\'>'.$ciudad['Ciudad']['nombre'].'</option>';
			}
		}
		$this->set('data', $combo);
		$this->render('/Elements/ajaxreturn');
	}
	
	
	function cargar_numero() {
		$this->layout=null;
		$num = null;
		if (isset($this->data['pais'])) {
			$pais = $this->data['pais'];
			$this->Session->write('pais',$pais);
			$conditions = array('PaisCaso.pais_id'=>$pais);
			$paiscaso = $this->PaisCaso->find('first',array('conditions'=>$conditions));
			if (isset($paiscaso['PaisCaso']['casos_id'])) {
				$conditions = array('Caso.id'=>$paiscaso['PaisCaso']['casos_id']);
				$caso = $this->Caso->find('first',array('conditions'=>$conditions));
				$num = $caso['Caso']['cod_num'];
				$this->Session->write('caso',$caso['Caso']['id']);
			}
				
		}
		$this->set('data', $num);
		$this->render('/Elements/ajaxreturn');
	}
	
	function cargar_pie() {
		$this->layout=null;
		$caso_id = $this->Session->read('caso');
		
		//OBTENER LEYENDA
		$conditions = array('CasoMultidioma.casos_id'=>$caso_id,'CasoMultidioma.idiomas_id'=>$this->idioma_id);
		$casoMultidioma = $this->CasoMultidioma->find('first',array('conditions'=>$conditions));
		if (isset($casoMultidioma) && count($casoMultidioma)) {
			$leyenda = $casoMultidioma['CasoMultidioma']['leyenda_pie'];
		} else {
			$leyenda = null;
		}
		$this->set('data', $leyenda);
		$this->render('/Elements/ajaxreturn');
	}
	
	function cargar_caso() {
		$this->layout=null;
		$caso_id = $this->Session->read('caso');
		//OBTENER NOMBRE DEL PAIS
		//$pais = $this->Session->read('pais');
		$pais = $this->data['pais'];
		$conditions = array('Pais.id'=>$pais);
		$select_pais = $this->Pais->find('first',array('conditions'=>$conditions));
		if ($this->idioma_id!=1) {
			$paises_idioma = $this->PaisIdioma->find('first',array('conditions'=>array('PaisIdioma.idiomas_id'=>$this->idioma_id,'PaisIdioma.paises_id'=>$pais)));
		}
		if (isset($paises_idioma)) $select_pais = $paises_idioma;
		
		//OBTENER COLOR
		$conditions = array('Caso.id'=>$caso_id);
		$caso = $this->Caso->find('first',array('conditions'=>$conditions));
		if (isset($caso) && count($caso)) {
			$color = $caso['Caso']['color'];
		} else {
			$color=null;
		}
		
		//OBTENER CONVENCION HAYA
		$conditions = array('PaisCaso.pais_id'=>$pais,'PaisCaso.casos_id'=>$caso_id);
		$paiscaso = $this->PaisCaso->find('first',array('conditions'=>$conditions));
		$cuadro_haya='';
		$conv_haya = '';
		$itemsA='';
		$itemsB ='';
		$leyenda = null;
		if (isset($paiscaso) && count($paiscaso)) {
			
			//OBTENER DATOS DE ITEMS A
			$conditions = array('ItemMultidiomaA.casos_id'=>$caso_id,'ItemMultidiomaA.idiomas_id'=>$this->idioma_id);
			$itemMultidiomaA = $this->ItemMultidiomaA->find('all',array('conditions'=>$conditions));
			
			if (isset($itemMultidiomaA)) {
				$i=1;
				foreach($itemMultidiomaA as $value) {
					//debug($key);
					//$itemsA.='<span class="vineta">'.$i.'</span> <b>'.$itemMultidiomaA['CasoMultidioma']['titulo'].'</b>';
					$itemsA.='<span class="vineta">'.$i.'</span> ';
					$itemsA.=$value['ItemMultidiomaA']['item'];
					$itemsA.='<p></p>';
					$i++;
				}
			}
			
			//OBTENER DATOS DE ITEMS B
			$conditions = array('ItemMultidiomaB.casos_id'=>$caso_id,'ItemMultidiomaB.idiomas_id'=>$this->idioma_id);
			$itemMultidiomaB = $this->ItemMultidiomaB->find('all',array('conditions'=>$conditions));
			if (isset($itemMultidiomaB)) {
				$i=1;
				foreach($itemMultidiomaB as $value) {
					//debug($key);
					//$itemsB.='<span class="vineta">'.$i.'</span> <b>'.$itemMultidiomaB['CasoMultidioma']['titulo'].'</b>';
					$itemsB.='<span class="vineta">'.$i.'</span> ';
					$itemsB.=$value['ItemMultidiomaB']['item'];
					$itemsB.='<p></p>';
					$i++;
				}
			}
			
			//OBTENER LEYENDA
			$conditions = array('CasoMultidioma.casos_id'=>$caso_id,'CasoMultidioma.idiomas_id'=>$this->idioma_id);
			$casoMultidioma = $this->CasoMultidioma->find('first',array('conditions'=>$conditions));
			if (isset($casoMultidioma) && count($casoMultidioma)) {
				$leyenda = $casoMultidioma['CasoMultidioma']['leyenda'];
			}
			if ($paiscaso['PaisCaso']['convencion']) {
				//$cuadro_haya = '<p></p><b>'.strtoupper($sel_pais['Pais']['pais']).' '.$conv_haya.'</b><p></p>';
				if (isset($select_pais['PaisIdioma']['pais'])) {
					$cuadro_haya = '<p></p><b>'.strtoupper($select_pais['PaisIdioma']['pais']).' '.$this->conv_haya.'</b><p></p>';
				} else {
					$cuadro_haya = '<p></p><b>'.strtoupper($select_pais['Pais']['pais']).' '.$this->conv_haya.'</b><p></p>';
				}
				//'es miembro de la Convención de La Haya.</p><p></p>';
			}
		}
		
		$data['itemsA']=$itemsA;
		$data['itemsB']=$itemsB;
		$data['conv_haya']=$cuadro_haya;
		$data['leyenda']=$leyenda;
		$data['color']=$color;
		$this->set('data', $data);
		$this->render('/Elements/ajaxreturn');
	}
	
	function cargar_preguntas() {
		$this->layout=null;
		$items = '';
		$conditions = array('ItemPregunta.idiomas_id'=>$this->idioma_id);
		$preguntas = $this->Pregunta->ItemPregunta->find('all',array('conditions'=>$conditions));
		if (isset($preguntas)) {
			$i=1;
			foreach($preguntas as $value) {
				//debug($key);
				//$itemsA.='<span class="vineta">'.$i.'</span> <b>'.$itemMultidiomaA['CasoMultidioma']['titulo'].'</b>';
				$items.='<span class="vineta2">'.$i.'</span> ';
				$items.=$value['ItemPregunta']['preg_resp'];
				$items.='<p></p>';
				$i++;
			}
		}
		$this->set('data', $items);
		$this->render('/Elements/ajaxreturn');
	}
	function cargar_datos() {
		$this->layout=null;
		$items = '';
		$borden = '';
		$conditions = array('ItemDatos.idiomas_id'=>$this->idioma_id);
		$datos = $this->DatosContacto->ItemDatos->find('all',array('conditions'=>$conditions));
		if (isset($datos)) {
			foreach($datos as $value) {
				//debug($key);
				//$itemsA.='<span class="vineta">'.$i.'</span> <b>'.$itemMultidiomaA['CasoMultidioma']['titulo'].'</b>';
				$items .= '<div class="cuadro_datos_contacto">';
				if (isset($value['ItemDatos']['titulo'])) { 
					$items .= '<h4>'.$value['ItemDatos']['titulo'].'</h4>';
				}
				$items .= '<div class="row" style="padding:10px;">';
				if (isset($value['ItemDatos']['logo']) && !empty($value['ItemDatos']['logo']) ) {
					$items .= '<div class="col-md-5" style="text-align:center;">
						<img src="/files/'.$value['ItemDatos']['logo'].'" border="0" width="300" />
						</div>';
					$borden = 'border-left:2px solid #999;';
				}
				$items .= '<div class="col-md-7" style="'.$borden.'">';
				if (isset($value['ItemDatos']['direccion_postal']) && !empty($value['ItemDatos']['direccion_postal'])) {
						$items .= '<p><img src="/img/icono_home2.png" border="0" />&nbsp;&nbsp;&nbsp;'.$value['ItemDatos']['direccion_postal'].'</p>';
				}
				if (isset($value['ItemDatos']['web']) && !empty($value['ItemDatos']['web'])) {
					$items .= '<p><img src="/img/icono_web2.png" border="0" />&nbsp;&nbsp;&nbsp;'.$value['ItemDatos']['web'].'</p>';
				}
				if (isset($value['ItemDatos']['email']) && !empty($value['ItemDatos']['email'])) {
					$items .= '<p><img src="/img/icono_email2.png" border="0" />&nbsp;&nbsp;&nbsp;'.$value['ItemDatos']['email'].'</p>';
				}
				if (isset($value['ItemDatos']['telefono']) && !empty($value['ItemDatos']['telefono'])) {
					$items .= '<p><img src="/img/icono_tel2.png" border="0" />&nbsp;&nbsp;&nbsp;'.$value['ItemDatos']['telefono'].'</p>';
				}
				$items .= '</div>
						</div>
						
					</div>
					';				

			}
		}
		$this->set('data', $items);
		$this->render('/Elements/ajaxreturn');
	
	}
}