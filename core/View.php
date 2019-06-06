<?php
namespace Core;
use Core\Session;

class View{
	protected $_head, $_body, $_script, $_siteTitle = SITE_TITLE, $_outputBuffer, $_layout = DEFAULT_LAYOUT;
	public $_success, $_error, $_errors, $_oldInput = array();

	public function __construct(){
		if(Session::exists('success')){
			$this->_success = Session::get('success');
		}else if(Session::exists('oldInput')){
			$this->_oldInput = Session::get('oldInput');
			if(Session::exists('error')){
				$this->_error = Session::get('error');
			}else if(Session::exists('errors')){
			$this->_errors = Session::get('errors');
			}
		}
	}
	
	public function render($viewName, $params = []){
		$viewArray = explode('/',$viewName);
		$viewString = implode(DS, $viewArray);
		if(file_exists(ROOT . DS . 'view' . DS . $viewString . '.php')){
			if(isset($params)){
				foreach($params as $key=>$param){
					$this->$key = $param;
				}
			}
			include(ROOT . DS . 'view' . DS . $viewString . '.php');
			include(ROOT . DS . 'view' . DS . 'layout' . DS . $this->_layout . '.php');
		}else{
			die('The view \"' . $viewName . '\" does not exist.');
		}
	}

	public function content($type){
		if($type == 'head'){
			return $this->_head;
		}else if($type == 'body'){
			return $this->_body;
		}else if($type == 'script'){
			return $this->_script;
		}
		return false;
	}

	public function start($type){
		$this->_outputBuffer = $type;
		ob_start();
	}

	public function end(){
		if($this->_outputBuffer == 'head'){
			$this->_head = ob_get_clean();
		}else if($this->_outputBuffer == 'body'){
			$this->_body = ob_get_clean();
		}else if($this->_outputBuffer == 'script'){
			$this->_script = ob_get_clean();
		}else {
			die('You must run the start method first');
		}
	}

	public function siteTitle(){
		return $this->_siteTitle;
	}

	public function setSiteTitle($title){
		$this->_siteTitle = $title;
	}

	public function setLayout($path){
		$this->_layout = $path;
	}

}