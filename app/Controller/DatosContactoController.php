<?php

class DatosContactoController extends AppController {

    public $helpers = array('Html', 'Form');
    public $name = 'DatosContacto';
    var $uses = array('DatosContacto', 'ItemDatos');
    
    var $layout = 'original_admin';

    public function _null(){

    }

    public function index() {
        $permitidas = $this->Session->read('permitidas');
        if (isset($permitidas['datos_contacto']['index']) && $permitidas['datos_contacto']['index']) {
            //$this->layout = "admin";
            //$this->Session->write('mipopup',false);
            $this->paginate = array('limit' => 10);
            $data = $this->paginate('DatosContacto');
            $this->set('datoscontacto', $data);
            if ($this->request->is('post') || $this->Session->check("#" . $this->request->param('controller'))) {
                $misesion = $this->Session->read("#" . $this->request->param('controller'));
                if (empty($this->data) && isset($misesion))
                    $this->data = $misesion;
                $this->Session->write("#" . $this->request->param('controller'), $this->data);
                $conditions = $this->getConditions();
                $join = $this->getJoins();
                $this->paginate = array('conditions' => $conditions, 'joins' => $join, 'limit' => 10);
                //$this->paginate = array('conditions'=>$conditions,'limit'=>10);
                $data = $this->paginate('DatosContacto');

                $this->set('datoscontacto', $data);
                $this->set('titulo', trim($this->data['titulo']));
            }
            else {
                $this->set('titulo', null);
            }
        } else {
            return $this->redirect(array('controller' => 'admin', 'action' => 'index'));
        }
    }

    private function getConditions() {
        $conditions = array();

        if (!empty($this->data['titulo'])) {
            $conditions[] = array('i.titulo like' => trim($this->data['titulo'] . '%'));
        }
        $conditions[] = array('i.idiomas_id' => 1);
        return $conditions;
    }

    private function getJoins() {
        $join = array(
            array(
                'table' => 'datos_contacto_multidioma',
                'alias' => 'i',
                'type' => 'LEFT',
                'conditions' => array('i.datos_contacto_id=DatosContacto.id',)
            )
        );

        return $join;
    }

    public function editar($id = null) {
        $permitidas = $this->Session->read('permitidas');
        if (isset($permitidas['datos_contacto']['editar']) && $permitidas['datos_contacto']['editar']) {
            //$this->layout = "admin";
            if (!$id) {
                throw new Exception(__('Accion inválida'));
            }

            $data = $this->DatosContacto->findById($id);
            //debug($data);
            //debug($this->request->data['ItemPregunta']); die();
            //debug($data);
            if (!$data) {
                throw new Exception(__('Accion inválida'));
            } else {
                $aux = '';
                $i = 0;
                foreach ($data['ItemDatos'] as $item) {
                    //debug($item);
                    /* if ($aux != $item['idiomas_id']) {
                      $aux = $item['idiomas_id'];
                      $i=0;

                      } else {
                      $i++;
                      } */
                    $itemDatos['ItemDatos'][$item['idiomas_id']]['id'] = $item['id'];
                    $itemDatos['ItemDatos'][$item['idiomas_id']]['titulo'] = $item['titulo'];
                    $itemDatos['ItemDatos'][$item['idiomas_id']]['direccion_postal'] = $item['direccion_postal'];
                    $itemDatos['ItemDatos'][$item['idiomas_id']]['logo'] = $item['logo'];
                    $itemDatos['ItemDatos'][$item['idiomas_id']]['email'] = $item['email'];
                    $itemDatos['ItemDatos'][$item['idiomas_id']]['web'] = $item['web'];
                    $itemDatos['ItemDatos'][$item['idiomas_id']]['telefono'] = $item['telefono'];
                }
            }
            //debug($itemDatos);
            //$item='';
            if (!$this->request->data) {
                $this->request->data = $data;
            }
            $this->set('itemDatos', $itemDatos);
            //debug ($itemDatos);
            if ($this->request->is('post', 'put')) {
                //debug($this->request->data['ItemMultidiomaA']); die();
                $this->DatosContacto->id = $id;
                $this->request->data['DatosContacto']['id'] = $id;
                $data['DatosContacto']['id'] = $id;
                /* $data['DatosContacto']['email'] = $this->request->data['DatosContacto']['email'];
                  $data['DatosContacto']['web'] = $this->request->data['DatosContacto']['web'];
                  $data['DatosContacto']['telefono'] = $this->request->data['DatosContacto']['telefono']; */
                $this->DatosContacto->begin();
                try {
                    if (!$this->DatosContacto->save($data)) {
                        throw new Exception('Error, No pudo grabar datos del contacto');
                    } else {
                        $idDato = $this->DatosContacto->id;
                    }

                    foreach ($this->request->data['ItemDatos'] as $item) {
                        $dato = '';
                        $filename = $item['imagen']['name'];
                        if (!empty($filename)) {
                            $destino = WWW_ROOT . 'files' . DS;
                            if (move_uploaded_file($item['imagen']['tmp_name'], $destino . basename($filename))) {
                                $dato['ItemDatos']['logo'] = $filename;
                            }
                            //} elseif (!empty($item['logo'])) {
                        } else {
                            $dato['ItemDatos']['logo'] = $item['logo'];
                        }
                        $this->ItemDatos->id = $item['id'];
                        $dato['ItemDatos']['datos_contacto_id'] = $idDato;
                        $dato['ItemDatos']['id'] = $item['id'];
                        $dato['ItemDatos']['idiomas_id'] = $item['idiomas_id'];
                        $dato['ItemDatos']['titulo'] = $item['titulo'];
                        $dato['ItemDatos']['direccion_postal'] = $item['direccion_postal'];
                        $dato['ItemDatos']['email'] = $item['email'];
                        $dato['ItemDatos']['web'] = $item['web'];
                        $dato['ItemDatos']['telefono'] = $item['telefono'];
                        //$dato['ItemDatos']['logo'] = $item['logo'];
                        if (!$this->ItemDatos->saveAll($dato)) {
                            throw new Exception('Error, no pudo grabar datos del contacto');
                        }
                    }

                    //die();
                    $this->DatosContacto->commit();
                    $this->Session->setFlash('Ha sido creado correctamente.', 'flash_custom');
                    if ($this->Session->check('pag_' . $this->request->param('controller'))) {
                        $page = $this->Session->read('pag_' . $this->request->param('controller'));
                        $this->Session->delete('pag_' . $this->request->param('controller'));
                        return $this->redirect('/datos_contacto/index/page:' . $page);
                    } else {
                        return $this->redirect(array('controller' => $this->request->param('controller'), 'action' => 'index'));
                    }
                } catch (Exception $e) {
                    $this->DatosContacto->rollback();
                    $this->Session->setFlash('Error, no se pudo grabar correctamente.', 'flash_custom');
                }
            }
        } else {
            return $this->redirect(array('controller' => 'admin', 'action' => 'index'));
        }
    }

    public function agregar() {
        $permitidas = $this->Session->read('permitidas');
        if (isset($permitidas['datos_contacto']['agregar']) && $permitidas['datos_contacto']['agregar']) {
            //$this->layout = "admin";
            if ($this->request->is('post')) {
                //debug($this->request->data); 
                //die();			
                /* $data['DatosContacto']['email'] = $this->request->data['DatosContacto']['email'];
                  $data['DatosContacto']['web'] = $this->request->data['DatosContacto']['web'];
                  $data['DatosContacto']['telefono'] = $this->request->data['DatosContacto']['telefono']; */
                $data['DatosContacto']['email'] = '';
                $data['DatosContacto']['web'] = '';
                $data['DatosContacto']['telefono'] = '';
                $this->DatosContacto->begin();
                try {
                    if (!$this->DatosContacto->save($data)) {
                        throw new Exception('Error, No pudo grabar datos del contacto');
                    } else {
                        $idDato = $this->DatosContacto->id;
                    }

                    foreach ($this->request->data['ItemDatos'] as $item) {

                        $filename = $item['logo']['name'];
                        $destino = WWW_ROOT . 'files' . DS;
                        if (move_uploaded_file($item['logo']['tmp_name'], $destino . basename($filename))) {
                            $dato['ItemDatos']['logo'] = $filename;
                        }
                        $dato['ItemDatos']['datos_contacto_id'] = $idDato;
                        $dato['ItemDatos']['idiomas_id'] = $item['idiomas_id'];
                        $dato['ItemDatos']['titulo'] = $item['titulo'];
                        $dato['ItemDatos']['direccion_postal'] = $item['direccion_postal'];
                        $dato['ItemDatos']['email'] = $item['email'];
                        $dato['ItemDatos']['web'] = $item['web'];
                        $dato['ItemDatos']['telefono'] = $item['telefono'];
                        //$dato['ItemDatos']['logo'] = $item['logo'];
                        if (!$this->ItemDatos->saveAll($dato)) {
                            throw new Exception('Error, no pudo grabar datos de contacto');
                        }
                    }

                    $this->DatosContacto->commit();
                    $this->Session->setFlash('Ha sido creado correctamente.', 'flash_custom');
                    if ($this->Session->check('pag_' . $this->request->param('controller'))) {
                        $page = $this->Session->read('pag_' . $this->request->param('controller'));
                        $this->Session->delete('pag_' . $this->request->param('controller'));
                        return $this->redirect('/datos_contacto/index/page:' . $page);
                    } else {
                        return $this->redirect(array('controller' => $this->request->param('controller'), 'action' => 'index'));
                    }
                } catch (Exception $e) {
                    /* print_r("<pre>");
                      print_r($e);
                      print_r("</pre>"); */
                    //debug($this->DatosContacto->invalidFields());
                    //debug($this->ItemDatos->invalidFields());
                    $this->DatosContacto->rollback();
                    $this->Session->setFlash('Error, no se pudo grabar correctamente.', 'flash_custom');
                    //die();
                }
            }
        } else {
            return $this->redirect(array('controller' => 'admin', 'action' => 'index'));
        }
    }

    public function eliminar($id) {
        $permitidas = $this->Session->read('permitidas');
        if (isset($permitidas['datos_contacto']['eliminar']) && $permitidas['datos_contacto']['eliminar']) {
            $this->layout = "admin";
            if ($this->request->is('post')) {
                throw new MethodNotAllowedException();
            }

            if ($this->DatosContacto->delete($id)) {
                $this->Session->setFlash('Ha sido eliminado correctamente.', 'flash_custom');
                $this->redirect(array('action' => 'index'));
            }
        } else {
            return $this->redirect(array('controller' => 'admin', 'action' => 'index'));
        }
    }

    public function ver($id = null) {
        //$this->layout = 'admin';
        $this->Session->write('mipopup', true);
        $this->set('datoscontacto', $this->DatosContacto->findById($id));
    }

    /* public function limpiar() {
      $this->Session->delete($this->request->param('controller'));
      $this->redirect(array('action'=>'index'));
      } */
}
