<?php

class RbacPerfil extends RbacAppModel {

    public $useTable = 'rbac_perfiles';
    public $displayField = 'RbacPerfil.descripcion';
    /*public $validate = array(
        'descripcion' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true
            ),
            'between' => array(
                'rule' => array('between', 3, 200)
            )
        )
    );*/
    public $hasAndBelongsToMany = array(
        'RbacAccion' => array('className' => 'Rbac.RbacAccion',
            'joinTable' => 'rbac_acciones_rbac_perfiles',
            'foreignKey' => 'rbac_perfil_id',
            'associationForeignKey' => 'rbac_accion_id',
            'order' => array('controller' => 'ASC'),
            'unique' => true),
        'RbacUsuario' => array('className' => 'Rbac.RbacUsuario',
            'joinTable' => 'rbac_perfiles_rbac_usuarios',
            'foreignKey' => 'rbac_perfil_id',
            'associationForeignKey' => 'rbac_usuario_id',
            'order' => array('apellido' => 'ASC'),
            'unique' => true)
    );
    
    public $belongsTo = array(        
        'PermisosVirtualHost' => array(
            'className' => 'PermisosVirtualHost',
            'foreignKey' => 'permiso_virtual_host_id',
            'dependent' => false
        )
    );
    
    /*
     * Devuelve los virtual host que no tienen un perfil default designado
     */
    
    public function getHostVirtualDisponiblesDefault()
    {   
        $virtualHostNoPermitidos = $this->find('list',array('conditions'=>array('es_default'=>'1'),'fields'=>'permiso_virtual_host_id'));
        
        $q = "SELECT id,permiso FROM permisos_virtual_hosts";
        $virtualHosts = $this->PermisosVirtualHost->find('all');
        
        foreach ($virtualHosts as $key => $v) 
        {
            if($this->buscarInArray($v['PermisosVirtualHost']['id'], $virtualHostNoPermitidos)){
                unset($virtualHosts[$key]);
            }
        }
        return $virtualHosts;
        
    }
    
    private function buscarInArray($valor, $arrs)
    {
        foreach ($arrs as $key => $v) 
        {   
            if($v == $valor)
            {
                return true;
            }
        }
        return false;
        
    }

}
