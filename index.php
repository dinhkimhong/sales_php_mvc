<?php
use Core\Router;


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require_once(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'core' . DS . 'Helper.php');


function autoload($className){
	$classArray = explode('\\', $className);
	$class = array_pop($classArray);//take off last element in class array;

	$subPath = strtoLower(implode(DS, $classArray));//$classArray is rest of array after taking off last element
	$path = ROOT . DS . $subPath . DS . $class . '.php'; //directory to class
	if(file_exists($path)){
		require_once($path);
	}
}

spl_autoload_register('autoload');
session_start();

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : [];

Router::route($url);

?>