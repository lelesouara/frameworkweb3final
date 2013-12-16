<?php
class View{
	private $vars = array();
	private $module;
	private $view;
	private $template;
	private $_title;
	
	public function __construct($module, $view, $template=null){
		$this->view = $view;
		$this->module = $module;
		$this->template = $template;
		if(isset($_GET['ajax'])){
			$this->template = NULL;
		}
	}
	
	// define o <title> $t </title>
	public function setTitle($t){
		$this->_title = $t;
	}
	
	public function __set($name, $value){
		$this->vars[$name] = $value;
	}

	public function render(){
		header("Content-Type: text/html; charset=UTF-8", true);
		foreach($this->vars as $key => $value){
			$$key = $value;
		}
		$view = 'view/'.$this->module.'/'.$this->view.'.php';
		$title = $this->_title;
		if(empty($this->template))
			include $view;
		else
			include 'template/'.$this->template.'/index.php';
	}

} // fim da classe


