<?php
namespace Controller;
use Core\Controller;
use Core\Input;
use Core\Router;
use Core\Session;
use Model\Outbound;
use Model\User;
use Model\OutboundDetail;
use Model\Inbound;
use Model\InboundDetail;
use Model\SalesOrder;
use Model\SalesOrderDetail;


class OutboundController extends Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->view->render('outbound/index');
	}

	public function create(){
		$so_number = Input::get('so_number');

		$userModel = new User;
		$created_by = User::currentUser()->id;

		$salesOrderModel = new SalesOrder;
		$sales_order = $salesOrderModel->findOrderInfoBySoNumber($so_number);

		$salesOrderDetailModel = new SalesOrderDetail;
		$sales_order_details = $salesOrderDetailModel->findOrderDetailBySoNumber($so_number);

		$this->view->render('outbound/create',['sales_order'=>$sales_order,'sales_order_details'=>$sales_order_details]);
	}

	public function new(){
		$so_number = Input::get('so_number');
		$created_by = User::currentUser()->id;
		$sod_number = Input::get('sod_number');
		$material_number = Input::get('material_number');
		$delivery_quantity = Input::get('delivery_quantity');
		$batch_number = Input::get('batch_number');

		$outboundModel = new Outbound;
		$outboundDetailModel = new OutboundDetail;

		if($outboundModel->insert(['so_number'=>$so_number,'created_by'=>$created_by])){
			$outbound_number = $outboundModel->getLastInsertId();
			foreach($sod_number as $key=>$value){
				if($delivery_quantity[$key] != 0){
					$outboundDetailModel->insert(['outbound_number'=>$outbound_number, 'sod_number'=>$value,'material_number'=>$material_number,'delivery_quantity'=>$delivery_quantity[$key],'batch_number'=>$batch_number[$key]]);
				}
			}
			Session::set('success','Outbound number ' . $outbound_number . ' has been created.');
			Router::redirect('outbound');

		}
		Session::set('error','Something wrong');
		Router::redirect('outbound');
	}

}