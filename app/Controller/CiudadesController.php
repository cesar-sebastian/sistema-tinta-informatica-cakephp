<?php

class CiudadesController extends AppController {

    public $helpers = array('Html', 'Form');
    public $name = 'Ciudades';
    var $uses = array('Ciudad');
    
    var $layout = 'original_admin';

    public function _null(){ }

    public function index() {
        $permitidas = $this->Session->read('permitidas');
        if (isset($permitidas['ciudades']['index']) && $permitidas['ciudades']['index']) {
            //$this->layout = "admin";
            $limite = 10;
            //$this->Session->write('mipopup',false);
            $this->paginate = array('limit' => $limite);
            $data = $this->paginate('Ciudad');
            $this->set('ciudades', $data);
            $paises = $this->Ciudad->Pais->find('all');
            $this->set('paises', $paises);
            if ($this->request->is('post') || $this->Session->check("#" . $this->request->param('controller'))) {
                $misesion = $this->Session->read("#" . $this->request->param('controller'));
                if (empty($this->data) && isset($misesion))
                    $this->data = $misesion;
                $this->Session->write("#" . $this->request->param('controller'), $this->data);
                $conditions = $this->getConditions();
                $this->paginate = array('conditions' => $conditions, 'limit' => $limite);
                $data = $this->paginate('Ciudad');

                $this->set('ciudades', $data);
                $this->set('pais', trim($this->data['pais']));
                $this->set('ciudad', trim($this->data['ciudad']));
            }
            else {
                $this->set('pais', null);
                $this->set('ciudad', null);
            }
        } else {
            return $this->redirect(array('controller' => 'admin', 'action' => 'index'));
        }
    }

    private function getConditions() {
        $conditions = array();

        if (!empty($this->data['pais'])) {
            $conditions[] = array('Ciudad.paises_id' => trim($this->data['pais']));
        }
        if (!empty($this->data['ciudad'])) {
            $conditions[] = array('Ciudad.nombre like' => trim($this->data['ciudad'] . '%'));
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
