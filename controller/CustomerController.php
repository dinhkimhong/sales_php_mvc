<?php
namespace Controller;
use Core\Controller;
use Core\View;
use Model\Customer;
use Model\Country;
use Model\Title;
use Model\CustomerClass;
use Core\Router;
use Core\Session;
use Core\Helper;
use Core\Input;
use Core\Validate;
use Model\User;


class CustomerController extends Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->view->render('customer/index');
	}

	public function info(){
		$customer_number = Input::get('customer_number');
		$customerModel = new Customer;
		$customer_info = $customerModel->findById($customer_number);
		return $this->jsonResponse($customer_info);
	}

	public function create(){
		$countryModel = new Country;
		$countries = $countryModel->all();

		$titleModel = new Title;
		$titles = $titleModel->all();

		$customerClassModel = new CustomerClass;
		$customer_classes = $customerClassModel->all();
		$this->view->render('customer/create',['countries'=>$countries,'titles'=>$titles,'customer_classes'=>$customer_classes]);
	}

	public function new(){
		$customer_name = Input::get('customer_name');
		$billing_address = Input::get('billing_address');
		$billing_province = Input::get('billing_province');
		$ship_to_address = Input::get('ship_to_address');
		$ship_to_province = Input::get('ship_to_province');
		$country_code = Input::get('country_code');
		$tel = Input::get('tel');
		$fax = Input::get('fax');
		$website = Input::get('website');
		$contact = Input::get('contact');
		$title = Input::get('title');
		$email = Input::get('email');
		$gst = isset($_POST['gst']) ? 1 : 0;
		$gst_number = Input::get('gst_number');
		$pst = isset($_POST['pst']) ? 1 : 0;
		$pst_number = Input::get('pst_number');
		$hst = isset($_POST['hst']) ? 1 : 0;
		$hst_number = Input::get('hst_number');
		$discount = Input::get('discount');
		$sales_person = Input::get('sales_person');
		$customer_class = Input::get('customer_class');
		$created_by = User::currentUser()->id;

		$data = ['customer_name'=>$customer_name, 'billing_address'=>$billing_address, 'billing_province'=>$billing_province, 'ship_to_address'=>$ship_to_address,'ship_to_province'=>$ship_to_province,'country_code'=>$country_code,'tel'=>$tel,'fax'=>$fax,'website'=>$website,'contact'=>$contact,'title'=>$title,'email'=>$email,'gst'=>$gst,'gst_number'=>$gst_number,'pst'=>$pst,'pst_number'=>$pst_number,'hst'=>$hst,'hst_number'=>$hst_number, 'discount'=>$discount,'sales_person'=>$sales_person,'customer_class'=>$customer_class,'created_by'=>$created_by];

		$validation = new Validate;
		if($_POST){
			$validation->check($_POST,[
				'customer_name'=>[
					'display' => 'Customer name',
					'required'=>true,
					'unique'=> 'customers',
					'max'=>100,
				],
				'billing_address'=>[
					'display'=>'Billing address',
					'required'=>true,
					'max'=>150,
				],
				'billing_province'=>[
					'display'=>'Billing province',
					'required'=>true,
					'max'=>30,
				],
				'tel'=>[
					'display'=>'Tel number',
					'required'=>true,
				]
			], true);
			if($validation->passed()){
				$customerModel = new Customer;
				$customerModel->insert($data);
				$customer_number = $customerModel->getLastInsertId();
				Session::set('success','Customer number ' . $customer_number . ' has been created');
				Router::redirect('customer/create');
			}else{
				$validation->displayErrors();
				Router::redirect('customer/create');
				
			}
		}
	}

	public function view($customer_number){
		$countryModel = new Country;
		$countries = $countryModel->all();

		$titleModel = new Title;
		$titles = $titleModel->all();

		$customerClassModel = new CustomerClass;
		$customer_classes = $customerClassModel->all();

		$customerModel = new Customer;
		$customers = $customerModel->all();
		$customer_number_array = Customer::pluck($customers,'customer_number');

		if(!in_array($customer_number,$customer_number_array)){
			Session::set('error','Customer number ' . $customer_number . ' does not exist.');
			Router::redirect('customer'); 
		}else {
			$customer = $customerModel->findById($customer_number);
			$this->view->render('customer/view',['customer'=>$customer,'countries'=>$countries,'titles'=>$titles,'customer_classes'=>$customer_classes]);
		}

	}

	public function update(){
		$customer_number = Input::get('customer_number');
		$customer_name = Input::get('customer_name');
		$billing_address = Input::get('billing_address');
		$billing_province = Input::get('billing_province');
		$ship_to_address = Input::get('ship_to_address');
		$ship_to_province = Input::get('ship_to_province');
		$country_code = Input::get('country_code');
		$tel = Input::get('tel');
		$fax = Input::get('fax');
		$website = Input::get('website');
		$contact = Input::get('contact');
		$title = Input::get('title');
		$email = Input::get('email');
		$gst = isset($_POST['gst']) ? 1 : 0;
		$gst_number = Input::get('gst_number');
		$pst = isset($_POST['pst']) ? 1 : 0;
		$pst_number = Input::get('pst_number');
		$hst = isset($_POST['hst']) ? 1 : 0;
		$hst_number = Input::get('hst_number');
		$discount = Input::get('discount');
		$sales_person = Input::get('sales_person');
		$customer_class = Input::get('customer_class');
		$created_by = User::currentUser()->id;

		$data = ['customer_name'=>$customer_name, 'billing_address'=>$billing_address, 'billing_province'=>$billing_province, 'ship_to_address'=>$ship_to_address,'ship_to_province'=>$ship_to_province,'country_code'=>$country_code,'tel'=>$tel,'fax'=>$fax,'website'=>$website,'contact'=>$contact,'title'=>$title,'email'=>$email,'gst'=>$gst,'gst_number'=>$gst_number,'pst'=>$pst,'pst_number'=>$pst_number,'hst'=>$hst,'hst_number'=>$hst_number, 'discount'=>$discount,'sales_person'=>$sales_person,'customer_class'=>$customer_class,'created_by'=>$created_by];
		
		$validation = new Validate;
		if($_POST){
			$validation->check($_POST,[
				'customer_name'=>[
					'display' => 'Customer name',
					'required'=>true,
					'unique'=> 'customers',
					'max'=>100,
				],
				'billing_address'=>[
					'display'=>'Billing address',
					'required'=>true,
					'max'=>150,
				],
				'billing_province'=>[
					'display'=>'Billing province',
					'required'=>true,
					'max'=>30,
				],
				'tel'=>[
					'display'=>'Tel number',
					'required'=>true,
				]
			], true);
			if($validation->passed()){
				$customerModel = new Customer;
				$customerModel->update($customer_number,$data);
				Session::set('success',"Customer number ". $customer_number . " has been updated");
				Router::redirect('customer/view/' . $customer_number);
			}else{
				$validation->displayErrors();
				Router::redirect('customer/create');
			}
		}
	}

	public function delete(){
		$customer_number = Input::get('customer_number');
		$customerModel = new Customer;

		if($customerModel->delete($customer_number)){
			Session::set('success','Customer number ' . $customer_number . ' has been deleted.');
			Router::redirect('customer');
		}else{
			Session::set('error','You can not delete this customer');
			Router::redirect('customer/view/' . $customer_number);
		}
	}

}