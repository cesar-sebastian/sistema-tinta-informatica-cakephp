<?php

class RbacUsuario extends RbacAppModel {

    public $order = 'RbacUsuario.apellido';    
    public $useTable = 'rbac_usuarios';
    public $recursive = -1;    

    public $validate = array(
        'usuario' => array(
            'between' => array(
                'rule' => array('between', 3, 100)
            )
        )
    );
    
    public $hasAndBelongsToMany = array(
        'RbacPerfil' => array(
            'className' => 'Rbac.RbacPerfil',
            'joinTable' => 'rbac_perfiles_rbac_usuarios',
            'foreignKey' => 'rbac_usuario_id',
            'associationForeignKey' => 'rbac_perfil_id',
            'unique' => true
        )
    );
    
    public $belongsTo = array(
        'PerfilDefault' => array(
            'className' => 'Rbac.RbacPerfil',
            'foreignKey' => 'perfil_default'
        )
    );

    public function saveAll($data = null, $validate = true, $fieldList = array()) 
    {    
        $this->set($data);
        
        //si es un reg nuevo encriptar la nueva pass			    
        if ($this->id == null && $data['RbacUsuario']['usuario'] != '') 
        {
            $this->securityEncrypt();
        }
        
        return parent::saveAll($this->data);
    }

    /**
     * Encriptacion de password, seteo de valores seed y password.
     */
    private function securityEncrypt()
    {
        if (!(isset($this->data[$this->alias]['password'])))
        {
            $password = md5(rand(0, 9999));
        } else{
            $password = $this->data[$this->alias]['password'];
        }
        
        $seed = md5(rand(0, 9999));
        $password = hash('sha256', $seed . $password);
        $this->data[$this->alias]['seed'] = $seed;
        $this->data[$this->alias]['password'] = $password;
    }

    /**
     * @param string $usuario
     * @param int $password
     * @return boolean, TRUE si la autenticacion es correcta, FALSE en caso contrario.
     */
    public function autenticacion($usuario, $password) {

        $usuario = $this->findByUsuario($usuario);
        $passwordInput = hash('sha256', $usuario['RbacUsuario']['seed'] . $password);
        
        if ($passwordInput != $usuario['RbacUsuario']['password']) {
            return false;
        } else {
            return true;
        }
    }
}
