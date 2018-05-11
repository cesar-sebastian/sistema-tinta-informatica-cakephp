<?php

class DiticEmailComponent extends Component {

    var $name = 'TintaInformatica';
    //Usa
    var $components = array('Email');

    /**
     * Variable de Configuracion de la componente DiticEmail.
     * 
     * URL servidor			: $this->config['default_smtp']['host']
     * Puerto				: $this->config['default_smtp']['port']
     * Acceso				: $this->config['default_smtp']['user']
     * Clave				: $this->config['default_smtp']['password']
     * Timeout conexión		: $this->config['default_smtp']['timeout']
     * Tipo transporte		: $this->config['default_smtp']['transport'] (default 'smtp') 
     * Aplicar SSL 			: $this->config['default_smtp']['ssl'] (default '')
     * Copia forzada		: $this->config['default_smtp']['default_cc'] (default '')
     * Copia oculta forzada	: $this->config['default_smtp']['default_cco'] (default '') 
     * 
     * 
     * @link /config/local_config.php
     * @var MAIL_CONFIG
     */
    public $config = NULL;

    /**
     * Acceso al controlador que llama a la componente 
     * @var AppController
     */
    var $controller = NULL;

    /**
     * Metodo de inicializacion de la componente. 
     * Sobre-escritura del metodo del Framework Cake.
     * @param AppController $controller
     */
    public function initialize(Controller $controller) {
        $this->controller = $controller;
        $this->config = get_object_vars(new MAIL_CONFIG());
    }

    /**
     * El método envía un correo electrónico con los datos recibidos como argumentos.
     * Si se produce algún error durante el envio del correo electrónico, el método 
     * lanza una excepcion con el mensaje informado por el controlador nativo. 
     * 
     * @param array $datos
     * @param string $datos['email']
     * @param string $datos['subject']
     * @param string $datos['from']
     * @param string $datos['body'] si existe envia su contenido como texto plano
     * @param string $datos['template'] si no existe $datos['body'], enviara el contenido del template
     * @param string $datos['format'] (text|html|both) funciona en conjunto $datos['template']
     * 
     * @throws Exception
     */
    public function enviarCon($datos) {
        $this->Email->reset();

        $this->Email->xMailer = 'TintaInformatica - Correo Electrónico';
        $this->Email->delivery = 'smtp';
        $this->Email->smtpOptions = array(
            'port' => $this->config['default_smtp']['port'],
            'timeout' => $this->config['default_smtp']['timeout'],
            'host' => $this->config['default_smtp']['host'],
            'username' => $this->config['default_smtp']['user'],
            'password' => $this->config['default_smtp']['password']
        );

        $this->Email->to = $datos['email'];
        $this->Email->subject = $datos['subject'];
        $this->Email->from = $datos['from'];

        if (isset($datos['body'])) {
            $this->Email->sendAs = 'text';
            if (!$this->Email->send($datos['body'])) {
                throw new Exception($this->Email->smtpError);
            }
        } else {
            $this->Email->sendAs = $datos['format'];
            $this->Email->template = $datos['template'];
            if (!$this->Email->send()) {
                throw new Exception($this->Email->smtpError);
            }
        }
    }

}
