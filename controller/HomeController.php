<?php
namespace Controller;
use Core\Controller;
use Core\View;

class HomeController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->view->setLayout('home');
	}

	public function index(){
		$this->view->render('home/index');
	}

}
