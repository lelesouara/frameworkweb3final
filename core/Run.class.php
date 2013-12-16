<?php
class Run{
	
	function __construct(){	
		if(isset($_GET['mod'])){
			$modulo = $_GET['mod'];
		}
		else{
			$modulo = 'Editora';
			$action = 'all';
		}		
		if(isset($_GET['page'])){
			$action = $_GET['page'];		
		}				
		$modulo .= 'Controller';
		$modulo = ucfirst($modulo);
		include 'controller/'.$modulo.'.class.php';
		spl_autoload_register(array($this, 'loader'));
		$M = new $modulo();
		$M->$action();	
	}
	
	private function loader($className) {
		if(file_exists('model/'.$className.'.class.php'))
			include 'model/'.$className.'.class.php';
    }

}