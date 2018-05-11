<?php

class RbacPerfilesController extends RbacAppController {

    var $name = 'RbacPerfiles';
    var $uses = array('Rbac.RbacPerfil', 'Rbac.PermisosVirtualHost');  
    
    var $accionesDefaultLogin = array(17,18,19,20,21,26);

    public function index() 
    {       
                
        if ($this->request->is('post')) {
            $perfiles_condicion = array('descripcion like' => '%' . $this->data['descripcion'] . '%');
            $this->paginate = $perfiles_condicion;
            $this->paginate += array("limit" => 10);
            $this->set('rbacPerfiles', $this->paginate('RbacPerfil'));
            $this->set('descripcion', $descripcion);
        } else {
            $data = $this->paginate('RbacPerfil');
            $this->paginate += array("limit" => 10);
            $this->set('rbacPerfiles', $data);
            $this->set('descripcion', null);
        }
    }

    public function add() 
    {        
        $this->set('PermisosVirtualHost', $this->PermisosVirtualHost->find('all'));
        $this->set('PermisosVirtualHostDisponiblesDefault', $this->RbacPerfil->getHostVirtualDisponiblesDefault());

        if ($this->request->is('post')) 
        {   
            $this->parcheEditAcciones();
            
            $this->addAccionesPerfil();            
            
            if ($this->RbacPerfil->save($this->request->data))
            {
                $this->Session->setFlash('Se ha creado exitosamente', 'flash_custom');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null) 
    {
        if (!$id)
            throw new Exception(__('Accion inv?lida'));

        $rbacPerfil = $this->RbacPerfil->findById($id);

        if (!$rbacPerfil)
            throw new Exception(__('Accion inv?lida'));

        if ($this->request->is('post', 'put')) 
        {
            $this->parcheEditAcciones();
            
            //alta de perfiles acciones es manual dependiendo del virtual host
            $this->addAccionesPerfil();            
                     
            if ($this->RbacPerfil->save($this->request->data)) 
            {
                $this->Session->setFlash('Se ha actualizado exitosamente.', 'flash_custom');                
                
                //ver a donde redirigir, al fullbaseurl ?
                return $this->redirect(array('action' => 'index'));
            }
            
            $this->Session->setFlash('No se puede actualizar el perfil', 'flash_custom');
            
        } else {
            
            $permiso = $rbacPerfil['PermisosVirtualHost']['permiso'];
            
            //traigo los virtual host
            $this->set('PermisosVirtualHost', $this->PermisosVirtualHost->find('all')); //todas
            
            $PermisosVirtualHostDisponiblesDefault = $this->RbacPerfil->getHostVirtualDisponiblesDefault();
            
            if($rbacPerfil['RbacPerfil']['es_default'] == 1)
            {
                $selfVH = array();
                $selfVH['PermisosVirtualHost']['id'] = $rbacPerfil['PermisosVirtualHost']['id'];
                $selfVH['PermisosVirtualHost']['permiso'] = $rbacPerfil['PermisosVirtualHost']['permiso'];
                $selfVH['PermisosVirtualHost']['url'] = $rbacPerfil['PermisosVirtualHost']['url'];
                $PermisosVirtualHostDisponiblesDefault[] = $selfVH;
            }            
            
            $this->set('PermisosVirtualHostDisponiblesDefault', $PermisosVirtualHostDisponiblesDefault); //los diponibles + el mismo arreglar
            
             //traigo las acciones que el perfil tiene asignadas de la tabla intermedia
            //$idsAccionesPorPerfil = array();
            $accionesAsignadas = array();
            foreach ($rbacPerfil['RbacAccion'] as $accion) 
            {
                //traigo acciones que no sean null y que no sean las reservadas(acciones default para usuarios)
                if(($accion['action'] <> '_null') && (!in_array($accion['id'], $this->accionesDefaultLogin)))
                {   
                    $this->accionesDefaultLogin[] = $accion['id'];
                    $accionesAsignadas[] = $accion;
                }
            }        
            
            //acciones asignadas al usuario            
            $this->set('accionesAsignadas',$accionesAsignadas);
            
            $condicion = array('RbacAccion.'.$permiso => 1, 'RbacAccion.action <> "_null"', 'NOT' => array('RbacAccion.id' => $this->accionesDefaultLogin));
            $this->RbacPerfil->RbacAccion->recursive=-1;
            $accionesPosibles = $this->RbacPerfil->RbacAccion->find('all',array('conditions'=>$condicion));            
           
            
            //acciones posibles a asignar
            $this->set('accionesPosibles',$accionesPosibles);
            
            //traigo todos las acciones
            //$this->set('RbacAcciones', $this->RbacPerfil->RbacAccion->getAccionesByVirtualHost($rbacPerfil['PermisosVirtualHost']['permiso']));
            
            $this->set('rbacPerfil', $rbacPerfil);
        }

        if (!$this->request->data)
            $this->request->data = $rbacPerfil;
    }

    public function delete($id) 
    {

        if ($this->request->is('post'))
            throw new MethodNotAllowedException();
        try {
            $rbacPerfil = $this->RbacPerfil->findById($id);
        	if (isset($rbacPerfil['RbacUsuario']) && count($rbacPerfil['RbacUsuario'])) {
        		$this->Session->setFlash('No se puede eliminar el perfil porque tiene usuarios asociados.', 'flash_custom_error');
        		$this->redirect(array('action' => 'index'));
        	} else {
	        	$this->RbacPerfil->delete($id);
	            $this->Session->setFlash('El perfil ha sido eliminado correctamente.', 'flash_custom');
	            $this->redirect(array('action' => 'index'));
        	}
        } catch (Exception $e) {
            $this->Session->setFlash('No se puede eliminar el perfil porque tiene usuarios asociados.', 'flash_custom_error');
            $this->redirect(array('action' => 'index'));
        }
    }
    
    public function getAccionesByVirtualHost()
    {
        $this->layout = null;
        
        $virtualHost = $this->data['virtualHost'];        
        $acciones = $this->RbacPerfil->RbacAccion->getAccionesByVirtualHost($virtualHost);
        
        $data = array('acciones' => $acciones);        
        $this->set('data', $data);
        
        $this->render('/Elements/ajaxreturn');
    }
    
    /*
     * Alta de acciones a perfil dependiendo del virtual host
     */
    
    private function addAccionesPerfil()
    {
    	
        //va a depender de si la opcion es por default es 1 o 0        
        if($this->request->data['RbacPerfil']['es_default'] == 1)
        {
            //es un perfil default hay que asignarle todas las acciones del virtual host
            if (!isset($this->request->data['RbacPerfil']['permiso_virtual_host_id'])) 
            	$virtualHost = $this->PermisosVirtualHost->findById(5);
            else
            	$virtualHost = $this->PermisosVirtualHost->findById($this->request->data['RbacPerfil']['permiso_virtual_host_id']);

            $acciones = $this->RbacPerfil->RbacAccion->getAccionesByVirtualHostNull($virtualHost['PermisosVirtualHost']['permiso']);            	            
            foreach ($acciones as $accion)
            {
                $this->request->data['RbacAccion'][] = $accion['rbac_acciones']['id'];
            }
        }
        
        if(($this->request->data['RbacPerfil']['permiso_virtual_host_id'] == 3) || ($this->request->data['RbacPerfil']['permiso_virtual_host_id'] == 4) || ($this->request->data['RbacPerfil']['permiso_virtual_host_id'] == 5))
        {
            $this->request->data['RbacAccion'][] = 17;
            $this->request->data['RbacAccion'][] = 18;
            $this->request->data['RbacAccion'][] = 19;
            $this->request->data['RbacAccion'][] = 20;
            $this->request->data['RbacAccion'][] = 21;
            $this->request->data['RbacAccion'][] = 26;
        }
        
    }
    
    private function parcheEditAcciones()
    {    	
        $this->request->data['RbacAccion'] = explode(',', $this->request->data['RbacAccionAux']);        
    }

}
