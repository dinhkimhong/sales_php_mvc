<?php
namespace Core;

class Cookie{
	public static function exist($name){
		return (isset($_COOKIE[$name]));
	}

	public static function get($name){
		return $_COOKIE[$name];
	}

	public static function set($name, $value, $expiry){
		if(setCookie($name, $value, time()+$expiry,'/')){
			return true;
		}
		return false;
	}

	public static function delete($name){
		unset($_COOKIE[$name]);
		setCookie($name, '', time()-3600,'/');
	}
}

?>