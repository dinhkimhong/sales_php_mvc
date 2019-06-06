<?php
namespace Controller;
use Core\Controller;
use Model\DeliveryTerm;
use Model\Currency;
use Model\User;
use Model\SalesOrder;
use Model\SalesOrderDetail;
use Core\Input;
use Core\Validate;
use Core\Router;
use Core\Session;

class SalesController extends Controller{
	public function __construct(){
		parent::__construct();
	}

	public function create(){
		$deliveryTermModel = new DeliveryTerm;
		$delivery_terms = $deliveryTermModel->all();

		$currencyModel = new Currency;
		$currencies = $currencyModel->all();

		$this->view->render('sales_order/create',['delivery_terms'=>$delivery_terms,'currencies'=>$currencies]);
	}

	public function new(){
		$customer_number = Input::get("customer_number");
		$currency = Input::get("currency");
		$payment_term = Input::get("payment_term");
		$delivery_date = Input::get("delivery_date");
		$delivery_term = Input::get("delivery_term");
		$delivery_place = Input::get("delivery_place");
		$contact = Input::get("contact");
		$tel = Input::get("tel");
		$delivery_instruction = Input::get("delivery_instruction");
//get user_id (created_by)		
		$userModel = new User;
		$created_by = $userModel->currentUser()->id;
//====
		$material_number = Input::get("material_number");
		$quantity = Input::get("quantity");
		$unit_price = Input::get("unit_price");
//===validate Input
		$validation = new Validate;
		if($_POST){
			$validation->check($_POST,[
				'customer_number'=>[
					'display'=> 'Customer number',
					'required'=>true	
				],
				'payment_term'=>[
					'display'=>'Payment term',
					'required'=>true,
					'max'=>30
				],
				'delivery_date'=>[
					'display'=>'Delivery date',
					'required'=>true
				],
				'delivery_place'=>[
					'display'=>'Delivery place',
					'required'=>true
				],
				'material_number'=>[
					'display'=>'Material number',
					'required'=>true,
				],
				'quantity'=>[
					'display'=>'Quantity',
					'required'=>true,
				],
				'unit_price'=>[
					'display'=>'Unit price',
					'required'=>true
				]

			],true);
			$data = ["customer_number"=>$customer_number, "currency"=>$currency, "payment_term"=>$payment_term, "delivery_date"=>$delivery_date, "delivery_place"=>$delivery_place, "delivery_term"=>$delivery_term,"contact"=>$contact, "tel"=>$tel, "delivery_instruction"=>$delivery_instruction,"created_by"=>$created_by];
			
			if($validation->passed()){
				$salesOrderModel = new SalesOrder;

				if($salesOrderModel->insert($data)){
					$so_number = $salesOrderModel->getLastInsertId();
					foreach ($material_number as $key=>$value){
							$salesOrderDetailModel = new SalesOrderDetail;
							$so_detail_data = ["so_number"=>$so_number,"material_number"=>$value,"quantity"=>$quantity[$key],"unit_price"=>$unit_price[$key]];	

							$salesOrderDetailModel->insert($so_detail_data);
					}
					Session::set('success','Sales order number ' . $so_number . ' has been created.');
					Router::redirect('sales/create');
				}				
			}else{			
				$validation->displayErrors();
				Session::set('oldInput',$_POST);
				Router::redirect('sales/create');
			}
		}
	}
}

?>