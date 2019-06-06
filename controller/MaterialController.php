<?php
namespace Controller;
use Core\Controller;
use Core\Input;
use Model\Material;

class MaterialController extends Controller{
	public function __construct(){
		parent::__construct();
	}

	public function info(){
		$material_number = Input::get('material_number');
		$materialModel = new Material;
		$material = $materialModel->findById($material_number);
		return $this->jsonResponse($material);
	}

	public function index(){
		$materialModel = new Material;
		$materials = $materialModel->all();

		$this->view->render('material/index',['materials'=>$materials]);
	}
}

?>