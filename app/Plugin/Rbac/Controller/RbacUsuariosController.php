<?php

class RbacUsuariosController extends RbacAppController {

    public $name = 'RbacUsuarios';
    public $uses = array('Rbac.RbacUsuario', 'Rbac.Configuracion', 'Rbac.RbacToken', 'Rbac.PermisosVirtualHost');
    //public $components = array('Rbac.LdapHandler', 'Rbac.DbHandler', 'Email');
    public $components = array('Rbac.DbHandler', 'Email');
    
    

    /**
     * (non-PHPdoc)
     * @see AppRbacController::beforeFilter()
     */
    public function beforeFilter() {

        if ($this->params['action'] != 'login')
            parent::beforeFilter();
    }

    /**
     * Muestra el listado de usuario existentes
     */
    public function index() {

        if ($this->request->is('post')) {
            $usuarios = array('conditions' => array('usuario like' => '%' . trim($this->data['usuario']) . '%',
                    'nombre like' => '%' . trim($this->data['nombre']) . '%',
                    'apellido like' => '%' . trim($this->data['apellido']) . '%'),
                'contain' => array('RbacPerfil', 'PerfilDefault'));
            $this->paginate = $usuarios;
            $this->paginate += array("limit" => 10);
            $this->set('rbacUsuarios', $this->paginate('RbacUsuario'));

            $this->set('usuario', trim($this->data['usuario']));
            $this->set('nombre', trim($this->data['nombre']));
            $this->set('apellido', trim($this->data['apellido']));
        } else {
            $this->paginate = array('contain' => array('RbacPerfil', 'PerfilDefault'), 'limit' => 10);
            $this->set('rbacUsuarios', $this->paginate('RbacUsuario'));
            $this->set('usuario', null);
            $this->set('nombre', null);
            $this->set('apellido', null);
        }
    }

    /**
     * Agrega un usuario nuevo
     */
    public function add() 
    {
        if ($this->request->is('post')) {
            try {
                $this->RbacUsuario->saveAll($this->request->data, array('validate' => false));               
                $id = $this->RbacUsuario->id;
                $token = $this->generateToken();
                $data['RbacToken']['token'] = $token;
                $data['RbacToken']['usuario_id'] = $id;
                $data['RbacToken']['validez'] = 1440;

                $this->config = get_object_vars(new PARAMS());

                $datos = array();
                $datos['subject'] = 'Confirmación de nuevo usuario';
                $datos['url'] = Router::url('/', true) . "rbac/rbac_usuarios/recuperarPass/" . $token;
                $datos['aplicacion'] = $this->config['aplicacion'];
                $datos['template'] = 'nuevo_usuario_noldap';
                $datos['email'] = $this->request->data['RbacUsuario']['usuario'];
               
                if ($this->_sendEmail($datos)) 
                {
                    if ($this->RbacToken->save($data)) 
                    {
                        $url = $datos['url'];
                        $mensaje = "Active su usuario desde su correo electronico";  
                        $this->Session->setFlash($mensaje, 'flash_custom');
                        $this->redirect(array('action' => 'index'));
                    } else {
                        throw new Exception(__('Error al guardar usuario'));
                    } 
                } else {
                    $this->Session->setFlash($this->Email->smtpError, 'flash_custom_error');
                }               
            } catch (Exception $e) {
                $this->Session->setFlash($e->getMessage(), 'flash_custom');
                //$this->Session->setFlash("El usuario que esta intentando crear ya existe.",'flash_custom');
            }
        }
        $this->set('RbacPerfiles', $this->RbacUsuario->RbacPerfil->find('all'));
    }

    /**
     * Edita un usuario existente
     * @param int $id
     * @throws Exception
     */
    public function edit($id = null) 
    {
        if (!$id)
            throw new Exception(__('Accion inválida'));

        $this->RbacUsuario->contain('RbacPerfil');
        $rbacUsuario = $this->RbacUsuario->findById($id);

        if (!$rbacUsuario)
            throw new Exception(__('Accion inválida'));

        $RbacPerfiles = $this->RbacUsuario->RbacPerfil->find('all', array('contain' => array()));

        foreach ($rbacUsuario['RbacPerfil'] as $perfil) 
        {
            $RbacPerfilesIds[] = $perfil['id'];
        }

        $this->set('RbacPerfiles', $RbacPerfiles);
        $this->set('RbacPerfilesIds', $RbacPerfilesIds);
        $this->set('RbacUsuario', $rbacUsuario);

        if ($this->request->is('post', 'put')) 
        {
            $this->RbacUsuario->id = $id;
            
            if ($this->RbacUsuario->saveAll($this->request->data)) 
            {
                $this->Session->setFlash('El Usuario se ha actualizado correctamente.', 'flash_custom');
                $usuario = $this->Session->read('RbacUsuario');
                if ($usuario['id'] == $this->request->data['RbacUsuario']['id']) 
                {
                    //se deberia volver a cargar las variables de session nomas **ver despues
                    $this->Session->write('RbacUsuario', null);
                    $this->Session->write('RbacAcciones', null);
                    $this->Session->destroy();
                }

                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash('El Usuario no se puede actualizar.', 'flash_custom');
        }

        if (!$this->request->data)
            $this->request->data = $rbacUsuario;
    }

    /**
     * Elimina un usuario
     * @param int $id identificador del usuario a eliminar
     * @param $ususario_activo bandera que indica si el usuario eliminado es el usuario activo elimina los datos
     * de la sesión y redirije al login
     * @throws MethodNotAllowedException
     */
    public function delete($id, $ususario_activo = NULL) {

        if ($this->request->is('post'))
            throw new MethodNotAllowedException();

        if ($ususario_activo == 1) {
            if ($this->RbacUsuario->delete($id)) {
                $this->Session->destroy();
                $this->redirect(array('action' => 'login'));
            }
        } else {
            if ($this->RbacUsuario->delete($id)) {
                $this->Session->setFlash('El Usuario ha sido eliminado correctamente.', 'flash_custom');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function login() 
    {
        $this->layout = 'login';
        $configuracionCaptcha = $this->Configuracion->findByClave('captcha');        
        if ($this->request->is('Post')) 
        {
            //validación de captcha
            if ($configuracionCaptcha['Configuracion']['valor'] == 'Si') 
            {
                if (strtolower($this->Session->read('hash')) != strtolower($this->data['captcha'])) 
                {
                    $this->Session->destroy();
                    $this->set('captcha', $configuracionCaptcha['Configuracion']);                    
                    $this->Session->setFlash('Validación erronea.', 'flash_custom_error');
                    return false;
                }
            }
            
            //validacion de usuario
            if (isset($this->data['RbacUsuario']['usuario']) && isset($this->data['RbacUsuario']['password'])) 
            {
                $usuario = $this->data['RbacUsuario']['usuario'];                
                $usr = $this->RbacUsuario->find('all', array('conditions' => array('usuario' => $usuario), 'recursive' => 2));

                /*
                 * Si el perfil por default utiliza area/representación
                 */
                if (count($usr) > 0) 
                {
                    $password = $this->data['RbacUsuario']['password'];
                    //validacion simple ir a BD
                    $result = $this->DbHandler->autenticacion($usuario, $password);
                    
                } else {
                    //no existe usuario en BD
                    $configuracionCaptcha = $this->Configuracion->findByClave('captcha');
                    $this->set('captcha', $configuracionCaptcha['Configuracion']);                    
                    $this->Session->setFlash('Validación de trigrama y clave erronea.', 'flash_custom_error');
                    $result = false;
                }
                
                if ($result != false)                 
                //if (true) 
                {
                    //el usuario valido 
                    
                    //leer vh
                    //OBTENGO EL PERFIL DEL USUARIO  y virtual host y redirecciono segun eso 
                    //QUE CORRESPONDE CON EL VIRTUAL HOST
                    //SI NO TIENE PERFIL PARA ESE VIRTUAL HOST ERROR
                    
                    //lo viejo necesario
                    //chekear esto
                    $result['id'] = $usr[0]['RbacUsuario']['id'];                   
                    
                    $perfilDefault = $usr[0]['RbacUsuario']['perfil_default'];//no debo traer el perfil defuatl
                    
                    //if(!is_null($this->Session->read('PerfilDefault')))
                    //{
                        //$perfilDefault = $this->Session->read('PerfilDefault');
                    //}
                    
                    $rbacAcciones = $this->generarListadoAccionesPorPerfiles($usr[0]['RbacPerfil']);
                    
                    $this->Session->write('RbacUsuario', $result);
                    $this->Session->write('PerfilDefault', $perfilDefault);                    
                    $this->Session->write('virtualHost', $this->getVirtualHost());
                    
                    //Esto funcionaba                    
                    /*$perfilId = $usr[0]['RbacUsuario']['perfil_default'];                    
                    $perfil = $this->RbacUsuario->RbacPerfil->findById($perfilId);                    
                    $accion = $this->RbacUsuario->RbacPerfil->RbacAccion->findById($perfil['RbacPerfil']['accion_default_id']);
                                                            
                    //vemos si la pagina de inicio está dentro del plugin
                    $pg = '';                    
                    if(similar_text('Rbac', $accion['RbacAccion']['controller']) == 4)
                    {
                        $pg = 'rbac';
                    }
                    
                    //ver redireccion cuando cambio de perfil                    
                    $this->redirect(array('plugin'=>$pg, 'controller'=>$accion['RbacAccion']['controller'], 'action'=>$accion['RbacAccion']['action']));*/
                    
                    //nuevo nuevo
                    //$perfilId = $usr[0]['RbacUsuario']['perfil_default'];
                    
                    //$this->redirect($this->getUrlRedirect($perfilId));
                    $this->redirect($this->getUrlRedirect($perfilDefault));
                    
                } else {
                    //$this->Session->destroy(); //por que sino no puedo cambiar de perfil
                    $this->Session->delete('RbacUsuario');
                    $this->set('captcha', $configuracionCaptcha['Configuracion']);                    
                    $this->Session->setFlash('Validación de trigrama y clave erronea.', 'flash_custom_error');
                }
            }
        } else {
            //die("fd");
            //$this->Session->destroy();
            
        	//Aca cambiar el controlador y accion de front-end
        	$vh_default = $this->Session->read('vh_default');
        	if ($vh_default == 'solo_lectura') {
        		$this->redirect(array('plugin'=>'', 'controller'=>'inicio', 'action'=>'index'));
        	} else {
        		$this->Session->delete('RbacUsuario'); //por que sino no puedo cambiar de perfil
        		$this->set('captcha', $configuracionCaptcha['Configuracion']);        		
        	}
        }
    }

    /**
     * @param array $perfilesAcciones
     * @return array $rbacAcciones
     */
    private function generarListadoAccionesPorPerfiles($perfilesAcciones) 
    {
        $rbacAcciones = array();

        foreach ($perfilesAcciones as $key => $perfil) 
        {
            //solo cargo perfiles que tienen acceso a login, los otros no tienen sentido
            if(($perfil['permiso_virtual_host_id'] != 1) && ($perfil['permiso_virtual_host_id'] != 2)){
                $p['id'] = $perfil['id'];
                $p['descripcion'] = $perfil['descripcion'];            
                $perfilesPorUsuario[] = $p;
            }
            
            foreach ($perfil['RbacAccion'] as $accion) 
            {
                $controller = $this->camelCaseToUnderscore($accion['controller']);                
                $rbacAcciones[$perfil['id']][$controller][$accion['action']] = array(
                                                                                    'value' => 1, 
                                                                                    'solo_lectura' => $accion['solo_lectura'],
                                                                                    'carga_publica' => $accion['carga_publica'],
                                                                                    'carga_login_publica' => $accion['carga_login_publica'],
                                                                                    'carga_login_interna' => $accion['carga_login_interna'],
                                                                                    'carga_administracion' => $accion['carga_administracion']
                                                                                );
                /*if ($accion['id'] == $perfil['inicio']) 
                {
                    $rbacAcciones[$perfil['id']]['inicio'] = $controller . '/' . $accion['action'];
                }*/
            }
        }
        $this->Session->write('PerfilesPorUsuario', $perfilesPorUsuario);
        $this->Session->write('RbacAcciones', $rbacAcciones);

        return $rbacAcciones;
    }

    /**
     * Permite al usuario logueado cambiar de Perfil.
     * @param int $perfil
     */
    public function cambiarPerfil($perfil) 
    {
        $usuario = $this->Session->read('RbacUsuario');
        $perfiles = $this->Session->read('PerfilesPorUsuario');
        $perfil_valido = false;
        $acciones = $this->Session->read('RbacAcciones');

        foreach ($perfiles as $p) 
        {
            if ($p['id'] == $perfil)
                $perfil_valido = true;
        }

        if ($perfil_valido) 
        {
            $this->Session->delete('RbacUsuario');
            $this->Session->write('PerfilDefault', $perfil);
            //$inicio = $acciones[$perfil]['inicio'];  
            
            $url = $this->getUrlRedirect($perfil);
            
            $this->redirect($url);
            
            //aqui debo redireccionar a url + controller + accion            
            /*$accion = $this->RbacUsuario->RbacPerfil->RbacAccion->findById($perfil);
            $pg = '';
                    
            if(similar_text('Rbac', $accion['RbacAccion']['controller']) == 4)
            {
                $pg = 'rbac';
            }

            //ver redireccion cuando cambio de perfil                    
            $this->redirect(array('plugin'=>$pg, 'controller'=>$accion['RbacAccion']['controller'], 'action'=>$accion['RbacAccion']['action']));*/

            /*if (strpos($inicio, 'rbac') === false) 
            {
                $this->redirect("/" . $inicio);
            } else {
                $this->redirect('/rbac/' . $inicio);
            }*/
        } else {
            $this->Session->setFlash('Perfil inválido, consulte con el administrador');
        }
    }

    /**
     * Permite modificar la contraseña del usuario
     */
    public function changePass() {

        $usuario = $this->Session->read('RbacUsuario');
        if ($this->request->is('post')) {

            $this->RbacUsuario->recursive = -1;
            $user = $this->RbacUsuario->findById($usuario['id']);
            $seed = $user['RbacUsuario']['seed'];
            $contrasenia = $user['RbacUsuario']['password'];

            $contraseniaActual = $this->request->data['contraseniaActual'];
            $contraseniaActualEncrypt = hash('sha256', $seed . $contraseniaActual);

            if ($contrasenia != $contraseniaActualEncrypt) {
                $this->Session->setFlash('La contraseña actual no es correcta.', 'flash_custom_error');
                $this->redirect(array('action' => 'changePass'));
            }

            $contraseniaNueva = $this->request->data['contraseniaNueva'];
            $contraseniaNuevaConfirm = $this->request->data['contraseniaNuevaConfirm'];

            if ($contraseniaNueva != $contraseniaNuevaConfirm) {
                $this->Session->setFlash('La confirmación de nueva contraseña es incorrecta.', 'flash_custom_error');
                $this->redirect(array('action' => 'changePass'));
            }

            $user['RbacUsuario']['password'] = hash('sha256', $seed . $contraseniaNueva);
            $user['RbacUsuario']['contraseniaOld'] = $contrasenia;

            if ($this->RbacUsuario->saveAll($user)) {
                $this->Session->setFlash('La contraseña fue modificada correctamente.', 'flash_custom');
                
                //cesar verrr
                //debo obtener el perfil actual y segun eso redireccionar
                
                $this->redirect(array('controller' => 'rbac_usuarios', 'action' => 'index'));
            }
        } else {
            $this->RbacUsuario->recursive = -1;
            $user = $this->RbacUsuario->findById($usuario['id']);

            $this->set('user', $user);
        }
    }

    /**
     * Permite recuperar la contraseña a un usuario no LDAP
     */
    public function recuperar() 
    {
        $this->layout = 'login';

        if ($this->request->is('post')) {

            if (strtolower($this->Session->read('hash')) == strtolower($this->request->data['captcha'])) {
                $usuario = $this->RbacUsuario->find('first', array('conditions' => array('usuario' => $this->request->data['correo'])));

                if (!empty($usuario)) {
                    $token = $this->generateToken();
                    $data['RbacToken']['token'] = $token;
                    $data['RbacToken']['usuario_id'] = $usuario['RbacUsuario']['id'];
                    $data['RbacToken']['validez'] = 1440;
                    $this->config = get_object_vars(new PARAMS());

                    $datos = array();
                    $datos['subject'] = 'Recuperar contraseña';
                    $datos['url'] = Router::url('/', true) . "rbac/rbac_usuarios/recuperarPass/" . $token;
                    $datos['aplicacion'] = $this->config['aplicacion'];
                    $datos['template'] = 'recuperar_contrasenia';
                    $datos['email'] = $this->request->data['correo'];

                    if ($this->_sendEmail($datos)) {
                        if ($this->RbacToken->save($data)) {
                            $this->Session->setFlash(
                                    'Se ha enviado la información para recuperar la clave al usuario ingresado a la dirección ' . $this->request->data['correo'], 'flash_custom'
                            );
                            //$this->redirect(array('action'=>'index'));
                        }
                    } else {
                        $this->Session->setFlash($this->Email->smtpError, 'flash_custom');
                    }
                } else {
                    // ver cesar
                    $this->redirect(array('controller' => 'rbac_usuarios', 'action' => 'login'));
                }
            }
        }
    }

    /**
     * Permite recuperar el password a partir del token enviado por mail al usuario
     * @param hash $token
     */
    public function recuperarPass($token) 
    {
        $result = $this->RbacToken->find('first', array('conditions' => array('token' => $token)));
        if (!empty($result)) 
        {
            $fecha_actual = strtotime("now");
            $fecha_creacion = strtotime($result['RbacToken']['created']);
            $minutos = ($fecha_actual - $fecha_creacion) / 60;
            if ($minutos < $result['RbacToken']['validez']) 
            {
                if ($this->request->is('post')) 
                {
                    $id = $result['RbacToken']['usuario_id'];
                    $this->RbacUsuario->recursive = -1;
                    $user = $this->RbacUsuario->findById($id);
                    $seed = $user['RbacUsuario']['seed'];

                    $contraseniaNueva = $this->request->data['contraseniaNueva'];
                    $contraseniaNuevaConfirm = $this->request->data['contraseniaNuevaConfirm'];

                    $user['RbacUsuario']['id'] = $id;
                    $user['RbacUsuario']['password'] = hash('sha256', $seed . $contraseniaNueva);

                    if ($this->RbacUsuario->save($user)) {
                        $this->redirect(array('controller' => 'rbac_usuarios', 'action' => 'login'));
                    }
                } else {
                    $id = $result['RbacToken']['usuario_id'];
                    $user = $this->RbacUsuario->findById($id);
                    $this->set('user', $user);
                    $this->set('token', $token);
                }
            } else {
                //ver cesar
                $this->redirect(array('controller' => 'rbac_usuarios', 'action' => 'login'));
            }
        } else {
            //ver cesar
            $this->redirect(array('controller' => 'rbac_usuarios', 'action' => 'login'));
        }
    }
    
    /**
     * Verifica si un usuario existe en la tabla rbac_usuarios de la DB.
     * @return boolean true si el usuario existe en la DB
     */
    public function validarLoginDB() 
    {
        $this->layout = null;
        $result = false;
        $rbacUsuario = $this->RbacUsuario->findByUsuario($this->data['usuario']);
        if (count($rbacUsuario) > 0) {
            $result = true;
        }
        $data = array('result' => $result);
        $this->set('data', $data);
        $this->render('/Elements/ajaxreturn');
    }

    private function _sendEmail($datos) 
    {
        $this->config = get_object_vars(new MAIL_CONFIG());
        $this->Email->xMailer = 'DITIC - Componente de Correo Electrónico';
        $this->Email->delivery = 'smtp';
        $this->Email->smtpOptions = array(
            'port' => $this->config['default_smtp']['port'],
            'timeout' => $this->config['default_smtp']['timeout'],
            'host' => $this->config['default_smtp']['host'],
            'username' => $this->config['default_smtp']['username'],
            'password' => $this->config['default_smtp']['password']
        );
        $datos['from'] = ' <rbac@mrecic.gov.ar>';

        $this->Email->from = $this->config['default_smtp']['username'];
        $this->Email->to = $datos['email'];
        $this->Email->subject = $datos['subject'];
        $this->Email->delivery = 'smtp';
        $this->Email->sendAs = 'html';
        $this->Email->template = $datos['template'];
        $this->set('url', $datos['url']);
        $this->set('aplicacion', $datos['aplicacion']);

        if (!$this->Email->send())
            return false;
        else
            return true;
    }
    
    /*
     * Funcion solo disponible en ambiente local y desarrollo
     */
    
    public function cambiarEntorno($vh)
    {        
    	$config_vh = get_object_vars(new VH());    	
        
    	switch ($vh) {
            case 'solo_lectura':                
                $config_vh['vh_default'] = 'solo_lectura';    			    	
                break;
            case 'carga_publica':                
                $config_vh['vh_default'] = 'carga_publica';    			    		
                break;
            case 'carga_login_publica':                
                $config_vh['vh_default'] = 'carga__login_publica';   				   			
                break;
            case 'carga_login_interna':                
                $config_vh['vh_default'] = 'carga_login_interna';
                break;
            case 'carga_administracion':                
                $config_vh['vh_default'] = 'carga_administracion';								
                break;            
    	}
        
       //cambio el ambiente default al seleccionado por el usuario
        $this->Session->write('vh_default',$config_vh['vh_default']);       
        
        //Si es ambiente de desarrollo y es solo_lectura o carga_publica redirecciono
        if (($config_vh['vh_default'] == 'solo_lectura') || ($config_vh['vh_default'] == 'carga_publica'))
        {            
            //limpio session
            $this->Session->delete('RbacUsuario');
        
            //voy a la home publica siempre
            $this->redirect(Configure::read('App.fullBaseUrl')); 
            
        } else {
            //voy a login siempre
             $this->redirect(array('action' => 'login'));
        }
    }
    
     /*
     * Descripcion: Dado un Perfil, devuelve la url de redireccion segun virtual host y accion de inicio
     */
    
    private function getUrlRedirect($perfilId)
    {   
        if (Configure::read('debug') != 2)
        {
            //estamos en produccion
            //obtenemos la url de la bs segun virtualhost
            $b = $this->PermisosVirtualHost->findByPermiso($this->getVirtualHost());
            $baseUri = $b['PermisosVirtualHost']['url'];
            
        } else {
            $baseUri = Configure::read('App.fullBaseUrl');
        }
        
        $perfil = $this->RbacUsuario->RbacPerfil->findById($perfilId);
        $accion = $this->RbacUsuario->RbacPerfil->RbacAccion->findById($perfil['RbacPerfil']['accion_default_id']);        
        
        $pg = '';
                    
        if(similar_text('Rbac', $accion['RbacAccion']['controller']) == 4)
        {
            $pg = 'rbac/';
        }
        
        return $baseUri . '/' . $pg . $accion['RbacAccion']['controller'] . '/' .$accion['RbacAccion']['action'];
    }
    
    private function getVirtualHost()
    {
        if (Configure::read('debug') == 2)
        {
            //$vh = VH_DEFAULT;
            $vh = $this->Session->read('vh_default');
        } else {
            $vh = null;        
            if (strstr(get_include_path(), 'solo_lectura')) { $vh = 'solo_lectura'; }
            if (strstr(get_include_path(), 'carga_publica')) { $vh = 'carga_publica'; }        
            if (strstr(get_include_path(), 'carga_login_publica')) { $vh = 'carga_login_publica'; }
            if (strstr(get_include_path(), 'carga_login_interna')) { $vh = 'carga_login_interna'; }
            if (strstr(get_include_path(), 'carga_administracion')) { $vh = 'carga_administracion'; }
        }
        
        return $vh;        
    }    
    
    public function camelCaseToUnderscore($str) 
    {
        $str[0] = strtolower($str[0]);
        $func = create_function('$c', 'return "_" . strtolower($c[1]);');
        
        return preg_replace_callback('/([A-Z])/', $func, $str);
    }
}
