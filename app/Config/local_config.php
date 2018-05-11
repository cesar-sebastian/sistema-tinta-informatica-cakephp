<?php

/**
 * DITIC - Desarrollo (Plantilla Base)
 */
/**
 * Ambiente de desarrollo
 * Comentar cuando no se este en un ambiente de desarrollo
 */
define('AMBIENTE', 'DESARROLLO');

/**
 * Base de la app. util en DMZ por los aliases y el https
 */
if (!empty($_SERVER['SERVER_NAME']))
    Configure::write('App.fullBaseUrl', 'http://' . $_SERVER['SERVER_NAME']);


// default salt y seed, cambiar a gusto una sola vez
// salt alfanumerico
// seed numerico
Configure::write('Security.salt', 'A4hG03b0QYjTRXFStguVouubWWvnIr2g0FGAc9mi'); //ej: DYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mi
Configure::write('Security.cipherSeed', '16984306657235984398436836445'); // ej: 76859309657453542496749683645
// debug y cache clean 
// cuando esta en 0, hay que limpiar el cache a mano
Configure::write('debug', 0); // 2 para desa, 0 para test, prod y dmz
// otras configuraciones a necesidad de la aplicacion a continuacion
/**
 * 
 * Clase para conexi?n a LDAP
 * @copyright TI
 *
 */
class LDAP_CONFIG {   
    public $hostname = 'ldap.mrec.ar';
    public $base = 'dc=mrec,dc=ar';
}

class MAIL_CONFIG {    
    var $default_smtp = array(
        'host' => 'dedicado.tintainformatica.com.ar',
        'port' => '465',
        'username' => 'info@tintainformatica.com.ar',
        'password' => 'tinta2015',
        'timeout' => '30',
        'transport' => 'Smtp',
        'ssl' => false,
        'tls' => false,
        'default_cc' => '',
        'default_cco' => ''
    );
}

class PARAMS {
    public $aplicacion = 'Tinta Informatica';
}

?>