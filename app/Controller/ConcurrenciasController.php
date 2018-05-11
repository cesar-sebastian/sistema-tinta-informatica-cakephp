<?php

class ConcurrenciasController extends AppController {

    public $helpers = array('Html', 'Form');
    public $name = 'Concurrencias';
    
    var $layout = 'original_admin';

    public function _null(){ }

    public function index() {
        $permitidas = $this->Session->read('permitidas');
        if (isset($permitidas['paises']['index']) && $permitidas['paises']['index']) {
            //$this->layout = "admin";

            App::uses('HttpSocket', 'Network/Http');
            $HttpSocket = new HttpSocket();
            $response = $HttpSocket->get('http://desa.datosrepresentaciones.mrec.ar/wspaises/cargar_concurrencias.php');
            $datos = unserialize($response['body']);

            $this->set('datos', $datos);
        } else {
            return $this->redirect(array('controller' => 'admin', 'action' => 'index'));
        }
    }

}
