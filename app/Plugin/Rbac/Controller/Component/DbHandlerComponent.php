<?php

/**
 * @author wsb
 * @version 1.0
 */
class DbHandlerComponent extends Component {

    /**
     * Acceso local al controlador que invoco a la componente. 
     * @var AppController
     */
    private $controller = NULL;

    public function startup(Controller $controller) {
        $this->modelo = ClassRegistry::init('Rbac.RbacUsuario');
    }

    /**
     * El metodo verifica que el nombre de usuario existe y esta activo. 
     * Si el nombre de usuario existe y esta activo, verifica que la correspondencia de la contraseña. 
     * @param string $usuario
     * @param string $password
     * @return boolean, TRUE si la autenticacion es correcta, FALSE en caso contrario.
     */
    public function autenticacion($usuario, $password) {
        $result = false;

        if ($this->modelo->autenticacion($usuario, $password)) {
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
    public function getUsuario($usuario) {
        $data = NULL;

        $usuario = $this->modelo->findByUsuario($usuario);

        if (count($usuario) == 0) {
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
