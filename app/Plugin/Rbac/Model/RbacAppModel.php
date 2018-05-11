<?php
/**
 * Controlador de Nivel de Seguridad: Plugin RBAC
 *
 * @author        Tinta
 * @copyright     Tinta Informatica
 * @link          tintainformatica.com.ar
 * @package       app.Model
 * @since         CakePHP(tm) v 2.4 
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppModel', 'Model');
class RbacAppModel extends AppModel {

	public $actsAs = array("Containable");
}