<?php

class ConfiguracionController extends RbacAppController {

    var $name = 'Configuracion';
    var $uses = array('Rbac.Configuracion');

    public function index() {

        if ($this->request->is('post')) {
            $configuracion_condicion = array('clave like' => '%' . $this->data['clave'] . '%',
                'valor like' => '%' . $this->data['valor'] . '%');
            $this->paginate = $configuracion_condicion;
            $this->paginate += array("limit" => 10);
            $this->set('configuraciones', $this->paginate('Configuracion'));
            $this->set('clave', $clave);
            $this->set('valor', $valor);
        } else {
            $data = $this->paginate('Configuracion');
            $this->paginate += array("limit" => 10);
            $this->set('configuraciones', $data);
            $this->set('clave', null);
            $this->set('valor', null);
        }
    }

    public function add() {

        $this->set('RbacAcciones', $this->RbacPerfil->RbacAccion->find('all'));

        if ($this->request->is('post')) {
            if ($this->RbacPerfil->save($this->request->data)) {
                $this->Session->setFlash('Se ha creado exitosamente', 'flash_custom');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null) {

        if (!$id)
            throw new Exception(__('Accion inválida'));

        $configuracion = $this->Configuracion->findById($id);

        if (!$configuracion)
            throw new Exception(__('Accion inválida'));


        if ($this->request->is('post', 'put')) {
            if ($this->Configuracion->save($this->request->data)) {
                $this->Session->setFlash('Se ha actualizado exitosamente.', 'flash_custom');
                $this->redirect('/rbac/configuracion/index');
            }
            $this->Session->setFlash('No se puede actualizar', 'flash_custom');
        }

        if (!$this->request->data)
            $this->request->data = $configuracion;
    }

    public function delete($id) {

        if ($this->request->is('post'))
            throw new MethodNotAllowedException();

        if ($this->RbacPerfil->delete($id)) {
            $this->Session->setFlash('El perfil con identificador ' . $id . ' ha sido eliminado correctamente.', 'flash_custom');
            $this->redirect(array('action' => 'index'));
        }
    }

}
