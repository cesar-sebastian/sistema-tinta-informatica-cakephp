<?php

class ControllerListComponent extends Component {

    /**
     * Return an array of user Controllers and their methods.
     * The function will exclude ApplicationController methods
     * @return array
     */
    public function get($listControlleDB) {

        $aCtrlClasses = App::objects('controller');
        $i = 0;
        $controllerAcciones = array();
        //debug($aCtrlClasses);
        foreach ($aCtrlClasses as $controller) {           
            // Load the controller            	
            App::import('Controller', str_replace('Controller', '', $controller));
            // Load its methods / actions
            $aMethods = get_class_methods($controller);
            $controller = str_replace("Controller", '', $controller);
            //debug($aMethods);
            foreach ($aMethods as $idx => $method) {

                if ($method{0} == '_' && $method != '_null') {
                    unset($aMethods[$idx]);
                }
            }

            // Load the ApplicationController (if there is one)
            App::import('Controller', 'AppController');
            $parentActions = get_class_methods('AppController');
            $controllers[$controller] = array_diff($aMethods, $parentActions);

            foreach ($controllers[$controller] as $controllerAccion) {
                if (!$this->existeEnDB($controller, $controllerAccion, $listControlleDB)) {
                    $controllerAcciones[$i]['RbacAccion']['id'] = '';
                    $controllerAcciones[$i]['RbacAccion']['controller'] = $controller;
                    $controllerAcciones[$i]['RbacAccion']['action'] = $controllerAccion;
                    $i++;
                }
            }           
        }

        return ( $controllerAcciones);
    }

    function existeEnDB($controller, $controllerAccion, $listControlleDB) {

        foreach ($listControlleDB as $value) {
            if ($value['RbacAccion']['controller'] == $controller && $value['RbacAccion']['action'] == $controllerAccion)
                return true;
        }

        return false;
    }

}
