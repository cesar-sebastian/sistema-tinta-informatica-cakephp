<?php

class SedesController extends AppController {

    public $helpers = array('Html', 'Form');
    public $name = 'Sedes';
    var $uses = array('Sede', 'Ciudad', 'Pais');
    
    var $layout = 'original_admin';

    public function _null() {
        
    }

    public function index() {
        $permitidas = $this->Session->read('permitidas');
        
        if (isset($permitidas['ciudades']['index']) && $permitidas['ciudades']['index']) {
            //$this->layout = "admin";
            $limite = 10;
            //$this->Session->write('mipopup',false);
            $this->paginate = array('limit' => $limite);
            $data = $this->paginate('Sede');
            $this->set('sedes', $data);
            $ciudades = $this->Ciudad->find('all', array('order' => 'nombre'));
            $this->set('ciudades', $ciudades);
            $paises = $this->Pais->find('all', array('order' => 'pais'));
            $this->set('paises', $paises);
            if ($this->request->is('post') || $this->Session->check("#" . $this->request->param('controller'))) {
                $misesion = $this->Session->read("#" . $this->request->param('controller'));
                if (empty($this->data) && isset($misesion))
                    $this->data = $misesion;
                $this->Session->write("#" . $this->request->param('controller'), $this->data);
                $conditions = $this->getConditions();
                $this->paginate = array('conditions' => $conditions, 'limit' => $limite);
                $data = $this->paginate('Sede');

                $this->set('sedes', $data);
                $this->set('sede', trim($this->data['sede']));
                $this->set('ciudad', trim($this->data['ciudad']));
                $this->set('pais', trim($this->data['pais']));
            }
            else {
                $this->set('sede', null);
                $this->set('ciudad', null);
                $this->set('pais', null);
            }
        } else {
            return $this->redirect(array('controller' => 'admin', 'action' => 'index'));
        }
    }

    private function getConditions() {
        $conditions = array();

        if (!empty($this->data['sede'])) {
            $conditions[] = array('Sede.id' => trim($this->data['sede']));
        }
        if (!empty($this->data['ciudad'])) {
            $conditions[] = array('Sede.idciudades' => trim($this->data['ciudad']));
        }
        if (!empty($this->data['pais'])) {
            $conditions[] = array('Sede.pais_id' => trim($this->data['pais']));
        }

        return $conditions;
    }

    /* public function editar($id = null) {
      $permitidas = $this->Session->read('permitidas');
      
      if (isset($permitidas['paises']['editar']) && $permitidas['paises']['editar']) {
      //$this->layout="admin";
      $regiones = $this->Pais->Region->find('all');
      $this->set('regiones',$regiones);
      if(!$id)
      {
      throw new Exception(__('Accion inválida'));
      }

      $datos = $this->Pais->findById($id);

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
      $this->Pais->id = $id;
      $this->request->data['Pais']['id'] = $id;
      $data = $this->request->data;
      if (!$this->Pais->save($data)) {
      throw new Exception('Error, No pudo grabar pais');
      } else {
      $this->Session->setFlash('Ha sido grabado correctamente.','flash_custom');
      if ( $this->Session->check('pag_'.$this->request->param('controller'))) {
      $page = $this->Session->read('pag_'.$this->request->param('controller'));
      $this->Session->delete('pag_'.$this->request->param('controller'));
      return $this->redirect('/paises/index/page:'.$page);
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
      
      if (isset($permitidas['paises']['agregar']) && $permitidas['paises']['agregar']) {
      //$this->layout="admin";
      $regiones = $this->Pais->Region->find('all');
      $this->set('regiones',$regiones);
      if($this->request->is('post'))
      {

      $data = $this->request->data;
      if (!$this->Pais->save($data)) {
      throw new Exception('Error, No pudo grabar pais');
      } else {
      $this->Session->setFlash('Ha sido creado correctamente.','flash_custom');
      if ( $this->Session->check('pag_'.$this->request->param('controller'))) {
      $page = $this->Session->read('pag_'.$this->request->param('controller'));
      $this->Session->delete('pag_'.$this->request->param('controller'));
      return $this->redirect('/paises/index/page:'.$page);
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
      
      if (isset($permitidas['paises']['eliminar']) && $permitidas['paises']['eliminar']) {
      //$this->layout="admin";
      if($this->request->is('post'))
      {
      throw new MethodNotAllowedException();
      }

      if($this->Pais->delete($id))
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
      $this->set('pais', $this->Pais->findById($id));
      } */

    /* public function limpiar() {
      $this->Session->delete($this->request->param('controller'));
      $this->redirect(array('action'=>'index'));
      } */
}
