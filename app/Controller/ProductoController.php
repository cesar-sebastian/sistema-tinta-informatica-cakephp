<?php

class ProductoController extends AppController {

    public $helpers = array('Html', 'Form');
    public $name = 'Producto';
    var $layout = 'original_admin';
    //var $uses = array('Marca','ProductoTipo');

    public function _null() { }

    public function index() 
    {
        $this->paginate = array('limit' => 10);
        $data = $this->paginate('Producto');
        $this->set('productos', $data);
        
        $this->set('marcas', $this->Producto->Marca->find('all', array('recursive'=>-1)));        
        $this->set('productoTipos', $this->Producto->ProductoTipo->find('all',array('recursive'=>-1)));        

        if ($this->request->is('post') || $this->Session->check("#" . $this->request->param('controller'))) 
        {
            $misesion = $this->Session->read("#" . $this->request->param('controller'));
            if (empty($this->data) && isset($misesion))
                $this->data = $misesion;
            $this->Session->write("#" . $this->request->param('controller'), $this->data);
            $conditions = $this->getConditions();
            $this->paginate = array('conditions' => $conditions, 'limit' => 10);
            $data = $this->paginate('Producto');
            
            $this->set('productos', $data);            
            $this->set('descripcion', trim($this->data['descripcion']));
            $this->set('codigo', trim($this->data['codigo']));
            $this->set('marca_id', trim($this->data['marca_id']));
            $this->set('productotipo_id', trim($this->data['productotipo_id']));            
            
        } else {
            $this->set('descripcion', null);
            $this->set('codigo', null);
            $this->set('marca_id', null);
            $this->set('productotipo_id', null);
        }
    }

    private function getConditions() 
    {     
        $conditions = array();
        
        if (!empty($this->data['descripcion'])) { $conditions[] = array('descripcion like' => trim('%'. $this->data['descripcion'] . '%')); }
        if (!empty($this->data['codigo'])) { $conditions[] = array('codigo' => trim($this->data['codigo'])); }
        if (!empty($this->data['marca_id'])) { $conditions[] = array('marca_id' => trim($this->data['marca_id'])); }
        if (!empty($this->data['productotipo_id'])) { $conditions[] = array('productotipo_id' => trim($this->data['productotipo_id'])); }

        return $conditions;
    }

    public function add() 
    {
        $this->set('marcas', $this->Producto->Marca->find('all', array('recursive'=>-1)));        
        $this->set('productoTipos', $this->Producto->ProductoTipo->find('all',array('recursive'=>-1)));        
        
        if ($this->request->is('post')) 
        {
            if ($this->Producto->save($this->request->data))
            {
                $this->Session->setFlash('El producto se ha creado correctamente.', 'flash_custom');
                if ($this->Session->check('pag_' . $this->request->param('controller'))) 
                {
                    $page = $this->Session->read('pag_' . $this->request->param('controller'));
                    $this->Session->delete('pag_' . $this->request->param('controller'));
                    
                    return $this->redirect('/producto/index/page:' . $page);
                } else {
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }
    }

    public function editar($id = null) 
    {
        if (!$id) { throw new Exception(__('Accion inválida')); }

        $producto = $this->Producto->findById($id);

        if (!$producto) { throw new Exception(__('Accion inválida')); }

        if (!$this->request->data) 
        {
            $this->request->data = $producto;
        }
        
        $this->set('marcas', $this->Producto->Marca->find('all', array('recursive'=>-1)));        
        $this->set('productoTipos', $this->Producto->ProductoTipo->find('all',array('recursive'=>-1)));        

        if ($this->request->is('post', 'put')) 
        {
            $this->Producto->id = $id;
            $this->request->data['Producto']['id'] = $id;

            if ($this->Producto->saveAll($this->request->data)) 
            {
                $this->Session->setFlash('El producto se ha actualizado.', 'flash_custom');
                if ($this->Session->check('pag_' . $this->request->param('controller'))) 
                {
                    $page = $this->Session->read('pag_' . $this->request->param('controller'));
                    $this->Session->delete('pag_' . $this->request->param('controller'));
                    
                    return $this->redirect('/producto/index/page:' . $page);
                } else {
                    
                    return $this->redirect(array('action' => 'index'));
                }
            }
            $this->Session->setFlash('El producto no se puede actualizar.', 'flash_custom');
        }
    }

    public function eliminar($id) 
    {
        if($this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }

        if($this->Producto->delete($id))
        {
            $this->Session->setFlash('El producto ha sido eliminado.','flash_custom');
            $this->redirect(array('action'=>'index'));
        } else {
            $this->Session->setFlash('El producto no ha sido eliminado.','flash_custom_error');
            $this->redirect(array('action'=>'index'));
        }        
    }

}
