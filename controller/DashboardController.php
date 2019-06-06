<?php
namespace Controller;
use Core\Controller;
use Core\View;
use Core\Session;

class DashboardController extends Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->view->render('dashboard');
	}
}