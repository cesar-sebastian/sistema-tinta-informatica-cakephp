<?php

class RbacAccionesController extends RbacAppController {

    public $name = 'RbacAcciones';
    public $uses = array('Rbac.RbacAccion', 'Rbac.PermisosVirtualHost');
    public $components = array('Rbac.ControllerList');
    
    public function index() {

        $orders = array('controller' => 'ASC', 'action' => 'ASC');
    	if ($this->request->is('post')) {
    		// Resultado de busqueda
    		
            $acciones = array(
                'group' => array('controller', 'action'),
                'conditions' => array('action like' => '%' . trim($this->data['action']) . '%', 'controller like' => '%' . trim($this->data['controller']) . '%'),
            );
            $this->paginate = $acciones;
            $this->paginate += array('order' => $orders);
            $this->set('rbacAcciones', $this->paginate('RbacAccion'));
            $this->set('action', trim($this->data['action']));
            $this->set('controller', trim($this->data['controller']));
        } else {
            $rbacControllerActions = $this->RbacAccion->find('all', array('order' => $orders));            
            //Busco los controladores y acciones que aun no han sido cargadas en la DB y las agrego
            $aControllers = $this->ControllerList->get($rbacControllerActions);
            
            // Lista antes de sincronizar...
            $this->set('rbacNuevos', $aControllers);        		        	        	
           
			// Lista de acciones sincronizados
            $this->set('rbacAcciones', $rbacControllerActions);
            $this->set('controller', null);
            $this->set('action', null);
        }
    }

    public function switchAccion() {
        $this->layout = null;

        $accion_id = $this->data['accion_id'];
        $atributo_id = $this->data['atributo_id'];
        $valor = $this->data['valor'];
        debug($valor);
        $rbacAccion = $this->RbacAccion->findById($accion_id);

        $result = true;

        if (!$rbacAccion)
            $result = false;

        $this->RbacAccion->id = $accion_id;
        $this->RbacAccion->set($atributo_id, $valor);

        //$result = $this->RbacPerfil->query("SELECT * FROM `RbacAccionesRbacPerfileses` where rbac_accion_id=".$accion_id);

        if (!$this->RbacAccion->save()) {
            $result = false;
        } else {
            $permiso = $this->PermisosVirtualHost->find('first', array('conditions' => array('permiso' => $atributo_id)));
            $permiso_id = $permiso['PermisosVirtualHost']['id'];
            $perfiles = $this->RbacAccion->RbacPerfil->find('all', array('conditions' => array('permiso_virtual_host_id' => $permiso_id)));
            foreach ($perfiles as $perfil) {
                $perfil_id = $perfil['RbacPerfil']['id'];
                if ($valor) {
                    $results = $this->RbacAccion->RbacPerfil->query("SELECT * FROM rbac_acciones_rbac_perfiles 
		        			WHERE rbac_accion_id=" . $accion_id . ' AND rbac_perfil_id=' . $perfil_id);
                    if (isset($results) && empty($results)) {
                        //debug($results);
                        $ins_perfilxaccion = $this->RbacAccion->RbacPerfil->query("INSERT INTO rbac_acciones_rbac_perfiles 
		        				(rbac_accion_id,rbac_perfil_id) VALUES (" . $accion_id . "," . $perfil_id . ")");
                        //debug($ins_perfilxaccion);
                    }
                } else {
                    $del_perfilxaccion = $this->RbacAccion->RbacPerfil->query("DELETE FROM rbac_acciones_rbac_perfiles
		        			WHERE rbac_accion_id=" . $accion_id . ' AND rbac_perfil_id=' . $perfil_id);
                    //debug($del_perfilxaccion);
                }
            }
        }

        $this->set('data', array('result' => $result));
        $this->render('/Elements/ajaxreturn');
    }
    
    public function delete($id) {
    	$this->layout = null;
    	if ($id) {
    		$rbacAccion = $this->RbacAccion->findById($id);
    		if (isset($rbacAccion) && $rbacAccion['RbacPerfil']['accion_default_id'] != $id) {
    			if ($this->RbacAccion->delete($id)) {
    				$this->Session->setFlash('La Acción con identificador ' . $id . ' ha sido eliminada correctamente.', 'flash_custom');
    			} else {
    				$this->Session->setFlash('No pudo eliminar esta accion con identificador ' . $id . ' correctamente.', 'flash_custom_error');
    			}
    		} else {
    			$this->Session->setFlash('La acción ' . $id . ' no puede ser eliminada debido que esta asociada a un perfil', 'flash_custom_error');
    		}
    	}
    	$this->redirect(array('action' => 'index'));
    }
    
    public function sincronizar() {
    
    	$this->layout = null;
    	$result = false;
    	$miArray = $this->data['miArray'];
    	$i = 0;
    	//debug($miArray);
    	foreach ($miArray as $item) {
    		$datos = explode(';', $item);
    		$data[$i]['RbacAccion']['controller'] = $datos[0];
    		$data[$i]['RbacAccion']['action'] = $datos[1];
    		/*if ($datos[1] == '_null')
    			$data[$i]['RbacAccion']['solo_lectura'] = 1;
    		else*/
    		$data[$i]['RbacAccion']['carga_administracion'] = 1;
    		//debug($data);
    		$i++;
    	}
    	if ($data) {
    		if (!$this->RbacAccion->saveAll($data)) {
    			$result = false;
    			$this->Session->setFlash('Error, no pudo grabar correctamente.', 'flash_custom_error');
    		} else {
    			$result = true;
    			$this->Session->setFlash('Ha sido grabado correctamente', 'flash_custom');
    		}
    	}
    	$this->set('data', $result);
    	$this->render('/Elements/ajaxreturn');
    
    }

    /*
      public function add(){

      if($this->request->is('post')){
      if($this->RbacAccion->save($this->request->data)){
      $this->Session->setFlash('Se ha creado exitosamente','flash_custom');
      $this->redirect(array('action'=>'index'));
      }
      }

      }
     */
    /*
      public function edit($id = null){

      if(!$id)
      throw new Exception(__('Accion inválida'));

      $rbacAccion = $this->RbacAccion->findById($id);

      if (!$rbacAccion)
      throw new Exception(__('Accion inválida'));

      if($this->request->is('post','put')){
      $this->RbacAccion->id = $id;

      if($this->RbacAccion->save($this->request->data)){
      $this->Session->setFlash('Se ha actualizado exitosamente.','flash_custom');
      return $this->redirect(array('action'=>'index'));
      }

      $this->Session->setFlash('No se puede actualizar','flash_custom');
      }

      if (!$this->request->data){
      $this->request->data = $rbacAccion;
      }

      }
     */

    

}
