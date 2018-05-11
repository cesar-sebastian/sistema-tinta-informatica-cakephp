<?php

/**
 * AppController por default
 */
App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $components = array('DebugKit.Toolbar', 'Session', 'Cookie', 'Rbac.Permisos');
    public $helpers = array('Session', 'Html', 'Form');

    function beforeFilter() 
    {    	
    	$perfilDefault = $this->Session->read('PerfilDefault');
    	$accionesPermitidasPorPerfiles = $this->Session->read('RbacAcciones');
    	$accionesPermitidas = $accionesPermitidasPorPerfiles[$perfilDefault];
    	$perfilesPorUsuario = $this->Session->read('PerfilesPorUsuario');
    	$this->Session->write('permitidas',$accionesPermitidas);
    }
    
    function afterFilter() 
    {
        $this->Session->write('mipopup',false);
        if (isset($this->params['url']['inicio'])) 
        {
            $this->Session->delete("#".$this->request->param('controller'));
            $this->redirect(array('action'=>'index'));
        }
    }

}
