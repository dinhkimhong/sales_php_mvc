<?php
namespace Model;
use Core\Model;

class SalesOrder extends Model{
	protected $table = 'sales_orders';
	protected $primaryKey = 'so_number';

	public function findFirst($condition = null, $params = []){
		if($this->fetchAll($condition, $params)){
			return $this->db->_results[0];
		}
	}

	public function findOrderInfoBySoNumber($so_number){
		$joinParams = [
			[
				['customers','customer_number'],
				['sales_orders','customer_number']
			],
		];		
		$sales_order = $this->leftJoin($joinParams, "so_number = ?",[$so_number]);
		return $sales_order[0];
	}
}

?>