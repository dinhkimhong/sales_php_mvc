<?php
namespace Core;
use Core\View;

class Controller{
	public $view;
	public function __construct(){
		$this->view = new View;
		Session::delete('success');
		Session::delete('error');
		Session::delete('errors');
		Session::delete('oldInput');
	}

	public function jsonResponse($response){
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		http_response_code(200);
		echo json_encode($response);
		exit;
	}
}