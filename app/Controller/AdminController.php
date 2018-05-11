<?php

class AdminController extends AppController {

    public $helpers = array('Html', 'Form');
    public $name = 'Admin';
    var $layout = 'original_admin';
    var $uses = array('Producto','Rbac.Configuracion');

    public function _null() {}

    public function index() 
    {
        if ($this->request->is('post')) 
        {
            /*$conditions = $this->getConditions();
            $options = array('conditions' => $conditions);*/
            $productos = $this->Producto->findByCriteria(trim($this->data['criterio']));
            
            $ganancia = $this->Configuracion->findByClave('ganancia');            
            $recargo_tarjeta_1 = $this->Configuracion->findByClave('recargo_tarjeta_1');            
            $recargo_tarjeta_3 = $this->Configuracion->findByClave('recargo_tarjeta_3');            
            $recargo_tarjeta_6 = $this->Configuracion->findByClave('recargo_tarjeta_6');            
            
            $parametros = array();
            $parametros['ganancia'] = $ganancia['Configuracion']['valor'];
            $parametros['recargo_tarjeta_1'] = $recargo_tarjeta_1['Configuracion']['valor'];
            $parametros['recargo_tarjeta_3'] = $recargo_tarjeta_3['Configuracion']['valor'];
            $parametros['recargo_tarjeta_6'] = $recargo_tarjeta_6['Configuracion']['valor'];
            
            if (count($productos) == 1) 
            {
                //mandamos a ver el producto que esta
                //$this->redirect('controller'=>'Admin', 'action'=>'producto', 'id'=>$producto[0]['Producto']['id']);
                $this->redirect('/admin/producto/'.$productos[0]['producto']['id']);
            } 
            
            $this->set('criterio', trim($this->data['criterio']));            
            $this->set('productos', $productos);
            $this->set('parametros', $parametros);
        } else {
            $this->set('criterio', null);            
            $this->set('productos', null);            
            $this->set('parametros', null);
        }
    }

    private function getConditions() 
    {
        $conditions = array();
        
        if (!empty($this->data['criterio']))
        {
            $conditions = array(
                "OR" => array(
                    'descripcion like' => trim('%'. $this->data['criterio'] . '%'),
                    'codigo' => trim($this->data['criterio']),
                    'Marca.nombre' => trim('%'.$this->data['criterio']. '%'),
                    'ProductoTipo.nombre' => trim('%'.$this->data['criterio']. '%')
                )
            );
        }
        
        return $conditions;
    }
    
    public function producto($id)
    {
        if (!$id) { throw new Exception(__('Accion inválida')); }

        $producto = $this->Producto->findById($id);

        if (!$producto) { throw new Exception(__('Accion inválida')); }
        
        $ganancia = $this->Configuracion->findByClave('ganancia');            
        $recargo_tarjeta_1 = $this->Configuracion->findByClave('recargo_tarjeta_1');            
        $recargo_tarjeta_3 = $this->Configuracion->findByClave('recargo_tarjeta_3');            
        $recargo_tarjeta_6 = $this->Configuracion->findByClave('recargo_tarjeta_6');            

        $parametros = array();
        $parametros['ganancia'] = $ganancia['Configuracion']['valor'];
        $parametros['recargo_tarjeta_1'] = $recargo_tarjeta_1['Configuracion']['valor'];
        $parametros['recargo_tarjeta_3'] = $recargo_tarjeta_3['Configuracion']['valor'];
        $parametros['recargo_tarjeta_6'] = $recargo_tarjeta_6['Configuracion']['valor'];
        
        $this->set('producto', $producto);
        $this->set('parametros', $parametros);
    }

}
