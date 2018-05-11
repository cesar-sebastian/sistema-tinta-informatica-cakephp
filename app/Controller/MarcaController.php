<?php

class MarcaController extends AppController {

    public $helpers = array('Html', 'Form');
    public $name = 'Marca';
    var $layout = 'original_admin';

    public function _null() { }

    public function index() 
    {
        $this->paginate = array('limit' => 10);
        $data = $this->paginate('Marca');
        $this->set('marcas', $data);

        if ($this->request->is('post') || $this->Session->check("#" . $this->request->param('controller'))) 
        {
            $misesion = $this->Session->read("#" . $this->request->param('controller'));
            if (empty($this->data) && isset($misesion))
                $this->data = $misesion;
            $this->Session->write("#" . $this->request->param('controller'), $this->data);
            $conditions = $this->getConditions();
            $this->paginate = array('conditions' => $conditions, 'limit' => 10);
            $data = $this->paginate('Marca');
            $this->set('marcas', $data);
            $this->set('nombre', trim($this->data['nombre']));
        } else {
            $this->set('nombre', null);
        }
    }

    private function getConditions() 
    {
        $conditions = array();
        if (!empty($this->data['nombre'])) 
        {
            $conditions[] = array('nombre like' => trim($this->data['nombre'] . '%'));
        }

        return $conditions;
    }

    public function add() 
    {
        if ($this->request->is('post')) 
        {
            if ($this->Marca->save($this->request->data)) 
            {
                $this->Session->setFlash('La marca se ha creado correctamente.', 'flash_custom');
                if ($this->Session->check('pag_' . $this->request->param('controller'))) 
                {
                    $page = $this->Session->read('pag_' . $this->request->param('controller'));
                    $this->Session->delete('pag_' . $this->request->param('controller'));
                    
                    return $this->redirect('/marca/index/page:' . $page);
                } else {
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }
    }

    public function editar($id = null) 
    {
        if (!$id) { throw new Exception(__('Accion inválida')); }

        $productoTipo = $this->Marca->findById($id);

        if (!$productoTipo) { throw new Exception(__('Accion inválida')); }

        if (!$this->request->data) 
        {
            $this->request->data = $productoTipo;
        }

        if ($this->request->is('post', 'put')) 
        {
            $this->Marca->id = $id;
            $this->request->data['Marca']['id'] = $id;

            if ($this->Marca->saveAll($this->request->data)) 
            {
                $this->Session->setFlash('La marca se ha actualizado.', 'flash_custom');
                if ($this->Session->check('pag_' . $this->request->param('controller'))) 
                {
                    $page = $this->Session->read('pag_' . $this->request->param('controller'));
                    $this->Session->delete('pag_' . $this->request->param('controller'));
                    
                    return $this->redirect('/marca/index/page:' . $page);
                } else {
                    
                    return $this->redirect(array('action' => 'index'));
                }
            }
            $this->Session->setFlash('La marca no se puede actualizar.', 'flash_custom');
        }
    }

    public function eliminar($id) 
    {
        if($this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }

        if($this->Marca->delete($id))
        {
            $this->Session->setFlash('La marca ha sido eliminado.','flash_custom');
            $this->redirect(array('action'=>'index'));
        } else {
            $this->Session->setFlash('La marca no ha sido eliminado.','flash_custom_error');
            $this->redirect(array('action'=>'index'));
        }        
    }

}
