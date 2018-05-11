<?php
abstract class SVNClient {
	
	static public $urlRepository = 'No detectado';
	static public $lastChangedRevision = 'No detectado';
	static public $lastChangedDate = 'No detectado';
	
	static public function readInfo(){
		if(file_exists(ROOT.DS.'.svn'.DS.'wc.db')){
			self::leerVersionDB();
		}elseif (file_exists(ROOT.DS.'.svn'.DS.'entries')){
			self::leerVersionFile();
		}
	} 
	
	static public function leerVersionDB(){
		$db = new SQLite3(ROOT.DS.'.svn'.DS.'wc.db', SQLITE3_OPEN_READONLY);
		
		$resultado = $db->query('SELECT root FROM REPOSITORY WHERE id = 1');
		$temp = $resultado->fetchArray(SQLITE3_ASSOC);
		self::$urlRepository = $temp['root']; 
		
		$resultado = $db->query('SELECT MAX(revision) FROM NODES');
		$temp = $resultado->fetchArray(SQLITE3_NUM);
		self::$lastChangedRevision = $temp[0];
		
		$resultado = $db->query('SELECT MAX(changed_date) FROM NODES');
		$temp = $resultado->fetchArray(SQLITE3_NUM);
		self::$lastChangedDate = date('d/m/Y H:i',substr($temp[0], 0,10));
	}

	static public function leerVersionFile(){
		$entriesContents = file(ROOT.DS.'.svn'.DS.'entries');
		self::$urlRepository = $entriesContents[4];
		self::$lastChangedRevision = $entriesContents[3];
		self::$lastChangedDate = $entriesContents[9];// date('d/m/yy',strtotime(substr(,0,10)));
	}	
}