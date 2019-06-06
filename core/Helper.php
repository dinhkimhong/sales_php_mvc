<?php
namespace Core;
use Core\Session;
use Model\User;

class Helper{
	public static function currentUser(){
		return User::currentUser();
	}

	public static function currentPage(){
		$currentPage = $_SERVER['REQUEST_URI'];
		return $currentPage;
	}

	//get first element in url
	public static function firstElementUrl(){
		$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : [];
		return $url[0];

	}


}

?>