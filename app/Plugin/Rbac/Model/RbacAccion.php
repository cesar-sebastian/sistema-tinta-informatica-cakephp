<?php

class RbacAccion extends RbacAppModel {

    public $useTable = 'rbac_acciones';
    public $displayField = 'RbacAccion.descripcion';
    public $recursive = 2;
    public $hasAndBelongsToMany = array(
        'RbacPerfil' => array('className' => 'Rbac.RbacPerfil',
            'joinTable' => 'rbac_acciones_rbac_perfiles',
            'foreignKey' => 'rbac_perfil_id',
            'associationForeignKey' => 'rbac_accion_id',
            'unique' => true
        )
    );
    
    public $hasOne = array(
        'RbacPerfil' => array(
            'className' => 'Rbac.RbacPerfil',
        	'foreignKey' => 'accion_default_id',
        )
    );

    /*
     * Descripciรณn: Devuelve true si virtual host tiene permiso para leer la accion sino false
     */

    public function isValidActionVH($controlador, $accion, $virtualHost) 
    {
        $q = "SELECT count(*) as c FROM rbac_acciones WHERE controller = '{$controlador}' AND action = '{$accion}' AND {$virtualHost} = 1;";
        $r = $this->query($q);

        return $r[0][0]['c'] > 0;
    }
    
    /*
     * Descripciรณn: Devuelve true si virtual host tiene permiso para leer la accion sino false
     */

    public function isPublicAction($controlador, $accion) 
    {
        $q = "SELECT count(*) as c FROM rbac_acciones WHERE controller = '{$controlador}' AND action = '{$accion}' AND (solo_lectura = 1 OR carga_publica = 1);";
        $r = $this->query($q);

        return $r[0][0]['c'] > 0;
    }
    
    /*
     * Descripciรณn: devuelve todas las acciones que estan permitidas en el virtual host
     */    
    
    public function getAccionesByVirtualHost($virtualHost)
    {
        $q = "SELECT id, controller, action FROM rbac_acciones WHERE {$virtualHost} = 1 AND action <> '_null' AND id NOT IN (17,18,19,20,21,26) ORDER BY controller, action ASC";
        $r = $this->query($q);
        
        return $r;
    }
    
    /*
     * Descripciรณn: devuelve todas las acciones que estan permitidas en el virtual host
     */    
    
    public function getAccionesByVirtualHostNull($virtualHost)
    {
        $q = "SELECT id, controller, action FROM rbac_acciones WHERE {$virtualHost} = 1 ORDER BY controller, action ASC";
        $r = $this->query($q);
        
        return $r;
    }

}
