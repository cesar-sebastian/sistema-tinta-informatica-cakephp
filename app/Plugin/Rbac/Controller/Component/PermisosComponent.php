<?php

/**
 * Component para cargar los permisos del usuario logeado
 * @author wsb 
 * @version 1.0
 * 
 * @author cyc 
 * @version 2.0
 */
App::uses('Component', 'Controller');
App::uses('CakeEventListener', 'Event');
App::uses('CakeEvent', 'Event');

class PermisosComponent extends Component implements CakeEventListener {

    var $name = 'Permisos';

    /**
     * Components used by Permisos
     *
     * @var array
     */
    public $components = array('RequestHandler', 'Session', 'Rbac.ControllerList');

    /**
     * Acceso local al controlador que invoco a la componente.
     * @var AppController
     */
    //private $RbacUsuario = NULL;
    private $RbacAccion = NULL;
    //private $controllerPermiso = NULL;
    private $Controller = NULL;
    public $params = NULL;
    
    
    public function initialize(Controller $controller, $settings = array()) 
    {	
        $this->Controller = $controller;
        $this->Verificar();
    }
    
    public function startup(Controller $controller) {
        parent::startup($controller);
        $controller->getEventManager()->attach($this);
        $this->Controller = $controller;
    }

    public function __construct(ComponentCollection $collection, $settings = array()) {
        parent::__construct($collection, $settings);
        $controller = $collection->getController();
        $this->params = $controller->params->params;
    }    

    /**
     * List of callable functions which are attached to system events
     *
     * @return array
     */
    
    public function implementedEvents() {
        return array('Component.initialize' => 'Verificar');
    }

    /**
     * Control de accion, virtual host y usuario
     *
     * @param CakeEvent $event
     * @return void
     */
    
    public function Verificar() 
    { 
        /*
         * 1) Rbac toma accion, controlador y virtual host y valida.
         */
        
        $this->RbacAccion = ClassRegistry::init('Rbac.RbacAccion');
        
        $controlador = $this->camelUnderscoreToCase($this->params['controller']);
        $accion = $this->params['action'];        
              
        /*
         *  2) Rbac se fija si el usuario ya esta logeado y con perfil en session 
         */

        //Veo si el usuario tiene session y ademas si es distinto de login        
        if (is_null($this->Session->read('RbacUsuario'))) 
        {
            if(($accion != 'login') && ($accion != 'recuperar'))
            {
                //redirigimos a logearse            
                $this->Controller->redirect(array('plugin' => 'rbac', 'controller' => 'rbac_usuarios', 'action' => 'login'));
            }            
        } else {

            $perfilDefault = $this->Session->read('PerfilDefault');
            $accionesPermitidasPorPerfiles = $this->Session->read('RbacAcciones');

            //tomo las acciones permitidas para el perfil de usuario
            $accionesPermitidas = $accionesPermitidasPorPerfiles[$perfilDefault];

            //tomo $controlador en formato especifico, la accion ya la tengo en $accion
            $controlador = $this->camelCaseToUnderscore($this->params['controller']);

            //veo si el usuario tiene permiso para esa accion sobre en el virtual host
            $tienePermiso = (bool) false;

            if(isset($accionesPermitidas[$controlador][$accion]['carga_administracion']))                    
                $tienePermiso = (bool) ($accionesPermitidas[$controlador][$accion]['carga_administracion'] == 1);


            if(!$tienePermiso){                
                throw new NotFoundException('El usuario no tiene permiso para acceder a la funcionalidad requerida.');
            }
        }       
    }    

    private function camelCaseToUnderscore($str) 
    {
        $str[0] = strtolower($str[0]);
        $func = create_function('$c', 'return "_" . strtolower($c[1]);');
        return preg_replace_callback('/([A-Z])/', $func, $str);
    }
    
    private function camelUnderscoreToCase($str) 
    {   
        $e = explode('_', $str);
        $r = '';
        foreach($e as $i)
        {
            $r = $r.strtoupper($i[0]).substr($i, 1, strlen($i));
        }
        return $r;
    }

    /**
     * El metodo verifica que el nombre de usuario existe y esta activo.
     * Si el nombre de usuario existe y esta activo, verifica que la correspondencia de la contraseña.
     * @param string $usuario
     * @param string $password
     * @return boolean, TRUE si la autenticacion es correcta, FALSE en caso contrario.
     */
    
    public function autenticacion($usuario, $password) 
    {
        $result = false;

        if ($this->modelo->autenticacion($usuario, $password)) 
        {
            return $this->getUsuario($usuario);
        } else {
            return false;
        }
    }

    /**
     * El metodo devuelve los datos del usuario registrado en el servidor LDAP.
     * @param string trigrama.
     * Retorna un arreglo con el siguiente formato:
     * 			data[usuario],
     * 			data[nombres],
     * 			data[apellidos].
     * Si el trigrama no existe ó no esta activo retorna NULL.
     *
     * @return array
     */
    
    public function getUsuario($usuario) 
    {
        $data = NULL;
        $usuario = $this->modelo->findByUsuario($usuario);

        if (count($usuario) == 0) 
        {
            throw new InternalErrorException("El usuario " . $$usuario . " no fue encontrado .");
        } else {
            $data = array();
            $data['usuario'] = $usuario['RbacUsuario']['usuario'];
            $data['nombres'] = $usuario['RbacUsuario']['nombre'];
            $data['apellidos'] = $usuario['RbacUsuario']['apellido'];
        }

        return $data;
    }
}
