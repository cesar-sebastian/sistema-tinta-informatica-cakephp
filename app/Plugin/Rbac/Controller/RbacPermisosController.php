<?php

class RbacPermisosController extends RbacAppController {

    public $name = 'RbacPermisos';
    public $uses = array('Rbac.PermisosVirtualHost');
    
    public function index() {
        $this->paginate = array('limit' => 10);
        $this->set('rbacPermisos', $this->paginate('PermisosVirtualHost'));
    }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->PermisosVirtualHost->saveAll($this->request->data)) {
            	$this->Session->setFlash('Ha sido Grabado correctamente', 'flash_custom');
            	return $this->redirect(array('action' => 'index'));
            } else {
            	$this->Session->setFlash('Error, no pudo grabar correctamente', 'flash_custom');
        	}  
        }
    }

    public function edit($id = null) {

        if (!$id)
            throw new Exception(__('Accion inválida'));

        $rbacPermiso = $this->PermisosVirtualHost->findById($id);

        if (!$rbacPermiso)
            throw new Exception(__('Accion inválida'));

        if ($this->request->is('post', 'put')) {
            $this->PermisosVirtualHost->id = $id;

            if ($this->PermisosVirtualHost->saveAll($this->request->data)) {
                $this->Session->setFlash('El Permiso se ha actualizado correctamente.', 'flash_custom');
                return $this->redirect(array('action' => 'index'));
            } else {
            	$this->Session->setFlash('El Permiso no se puede actualizar.', 'flash_custom_error');
            }
        }
        
        if (!$this->request->data)
        	$this->request->data = $rbacPermiso;

    }

    public function delete($id) {

        if ($this->request->is('post'))
            throw new MethodNotAllowedException();

        
        if ($this->PermisosVirtualHost->delete($id)) {
        	$this->Session->setFlash('Este permiso ha sido eliminado correctamente.', 'flash_custom');
        } else {
        	$this->Session->setFlash('No pudo eliminar este permiso correctamente.', 'flash_custom_error');
        }
        $this->redirect(array('action' => 'index'));
    }

}
