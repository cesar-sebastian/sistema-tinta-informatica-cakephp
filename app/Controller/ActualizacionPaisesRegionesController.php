<?php

class ActualizacionPaisesRegionesController extends AppController {

    public $helpers = array('Html', 'Form');
    public $name = 'ActualizacionPaisesRegiones';
    var $uses = array('Pais', 'Region', 'Ciudad', 'Sede', 'Direccion', 'Telefono');

    var $layout = 'original_admin';

    public function _null(){

    }

    public function index() {
        $permitidas = $this->Session->read('permitidas');
        if (isset($permitidas['actualizacion_paises_regiones']['index']) && $permitidas['actualizacion_paises_regiones']['index']) {
            $this->layout = "admin";
            App::uses('HttpSocket', 'Network/Http');
            $HttpSocket = new HttpSocket();
            $response = $HttpSocket->get('http://desa.datosrepresentaciones.mrec.ar/wspaises/cargar_paises.php');
            $paises = unserialize($response['body']);
            $HttpSocket = new HttpSocket();
            $response = $HttpSocket->get('http://desa.datosrepresentaciones.mrec.ar/wspaises/cargar_regiones.php');
            $regiones = unserialize($response['body']);
            $HttpSocket = new HttpSocket();
            $response = $HttpSocket->get('http://desa.datosrepresentaciones.mrec.ar/wspaises/cargar_ciudades.php');
            $ciudades = unserialize($response['body']);
            $HttpSocket = new HttpSocket();
            $response = $HttpSocket->get('http://desa.datosrepresentaciones.mrec.ar/wspaises/cargar_sedes.php');
            $sedes = unserialize($response['body']);
            $HttpSocket = new HttpSocket();
            $response = $HttpSocket->get('http://desa.datosrepresentaciones.mrec.ar/wspaises/cargar_direcciones.php');
            $direcciones = unserialize($response['body']);
            $HttpSocket = new HttpSocket();
            $response = $HttpSocket->get('http://desa.datosrepresentaciones.mrec.ar/wspaises/cargar_telefonos.php');
            $telefonos = unserialize($response['body']);
            /* $this->Ciudad->query('TRUNCATE TABLE ciudades');
              $this->Pais->query('TRUNCATE TABLE paises');
              $this->Region->query('TRUNCATE TABLE regiones');
              $this->Sede->query('TRUNCATE TABLE sedes');
              $this->Direccion->query('TRUNCATE TABLE direcciones');
              $this->Telefono->query('TRUNCATE TABLE telefonos'); */
            $this->Ciudad->query('DELETE FROM ciudades');
            $this->Pais->query('DELETE FROM paises where agregado != "si"');
            $this->Region->query('DELETE FROM regiones');
            $this->Sede->query('DELETE FROM sedes');
            $this->Direccion->query('DELETE FROM direcciones');
            $this->Telefono->query('DELETE FROM telefonos');
            if (!$this->Ciudad->saveAll($ciudades)) {
                throw new Exception('Error, No pudo actualizar...');
            }
            if (!$this->Pais->saveAll($paises)) {
                throw new Exception('Error, No pudo actualizar...');
            }
            if (!$this->Region->saveAll($regiones)) {
                throw new Exception('Error, No pudo actualizar...');
            }
            if (!$this->Sede->saveAll($sedes)) {
                throw new Exception('Error, No pudo actualizar...');
            }
            if (!$this->Direccion->saveAll($direcciones)) {
                throw new Exception('Error, No pudo actualizar...');
            }
            if (!$this->Telefono->saveAll($telefonos)) {
                throw new Exception('Error, No pudo actualizar...');
            }
            $this->Session->setFlash('Ha sido actualizado correctamente.', 'flash_custom');
        } else {
            return $this->redirect(array('controller' => 'admin', 'action' => 'index'));
        }
    }

    /* public function agregar() {

      $this->layout="admin";
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

      }

      public function eliminar($id){
      $this->layout="admin";
      if($this->request->is('post'))
      {
      throw new MethodNotAllowedException();
      }

      if($this->Pais->delete($id))
      {
      $this->Session->setFlash('Ha sido eliminado correctamente.','flash_custom');
      $this->redirect(array('action'=>'index'));
      }

      } */
}
