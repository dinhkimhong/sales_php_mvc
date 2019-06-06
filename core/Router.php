<?php
namespace Core;

class Router {
	public static function route($url){
		$controller = (isset($url[0]) && $url[0] != '')? ucwords($url[0]).'Controller' : DEFAULT_CONTROLLER;
		$controller_name = str_replace('Controller', '', $controller);
		array_shift($url);//remove first element in array

		$action = (isset($url[0]) && $url[0] != '')? $url[0] : 'index';
		array_shift($url);



		$grantAccess = self::hasAccess($controller_name, $action);

		if(!$grantAccess){
			$controller = "HomeController";
			$action = "index";
		}

		//params
		$queryParams = $url;

		$controller = 'Controller\\'.$controller;
		$dispatch = new $controller;
		if(method_exists($controller, $action)){
			call_user_func_array([$dispatch, $action], $queryParams);
		}else{
			die('This method does not exits in the controller \"' . $controller_name . '\"');
		}
	}

	public static function redirect($location){
		if(!headers_sent()){
			header('Location: ' . PROOT . $location);
			exit();
		}else {
			echo '<script type="text/javascript">';
			echo 'window.location.href ="' . PROOT . $location . '";';
			echo '</script>';
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
			echo '</noscript>';
			exit();
		}
	}

	public static function hasAccess($controller, $action){
		$acl = '';
		$acl_file = file_get_contents(ROOT . DS . 'app' . DS . 'acl.json');
		$acl = json_decode($acl_file, true);
		$current_user_acl = "Guest";
		$grantAccess = false;
		
		if(Session::exists('login_user')){
			$current_user_acl = "LoggedIn";
		}

		if(array_key_exists($current_user_acl,$acl) && array_key_exists($controller, $acl[$current_user_acl])){
			if(in_array($action, $acl[$current_user_acl][$controller]) || in_array("*",$acl[$current_user_acl][$controller])){
				$grantAccess = true;
			}
		}

		//check denied
		$denied = $acl[$current_user_acl]['denied'];			
		if(!empty($denied) && array_key_exists($controller, $denied) && in_array($action,$denied[$controller])){
			$grantAccess = false;
		}

		return $grantAccess;
		

	}

}


?>