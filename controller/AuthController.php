<?php
namespace Controller;
use Core\Controller;
use Model\User;
use Core\View;
use Core\Router;
use Core\Session;


class AuthController extends Controller{

	public function __construct(){
		parent::__construct();
	}

	public function login(){
		$email = $_POST['email'];
		$password = $_POST['password'];

		$userModel = new User();

		$user = $userModel->findByEmail($email);
		if($user && password_verify($password, $user->password)){
			$userModel->login($user->email);
			$user_name = $user->user_name;
			Session::set('success', 'Welcome ' . $user_name .'!');
			Router::redirect('dashboard');
		}else{
			Router::redirect('home');
		}
	}

	public function logout(){
		$userModel = new User;
		$userModel->logout();
		Router::redirect('home');

	}
}