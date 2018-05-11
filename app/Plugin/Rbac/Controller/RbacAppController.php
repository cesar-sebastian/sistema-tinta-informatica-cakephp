<?php

class RbacAppController extends AppController {

    var $components = array('Session');
    var $helpers = array('Paginator', 'Session');
    var $layout = 'original_admin';

    function generateToken($length = 24) {
        if (function_exists('openssl_random_pseudo_bytes')) {
            $token = base64_encode(openssl_random_pseudo_bytes($length, $strong));
            if ($strong == TRUE)
                return strtr(substr($token, 0, $length), '+/=', '-_,');
        }

        //php < 5.3 or no openssl
        $characters = '0123456789';
        $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz+';
        $charactersLength = strlen($characters) - 1;
        $token = '';

        //select some random characters
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[mt_rand(0, $charactersLength)];
        }

        return $token;
    }

}
