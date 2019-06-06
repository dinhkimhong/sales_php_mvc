<?php
namespace Model;
use Core\Model;
use Model\InboundDetail;

class SalesOrderDetail extends Model{
	protected $table = 'sales_order_details';
	protected $primaryKey = 'number';

	public function findOrderDetailBySoNumber($so_number){
		$joinParams = [
			[
				['materials','material_number'],
				['sales_order_details','material_number']
			],
		];

		$order_details = $this->leftJoin($joinParams, "so_number = ?",[$so_number]);

		$inboundDetailModel = new InboundDetail;

		foreach($order_details as $detail){
			$material_number = $detail->material_number;

			$batch_number = $inboundDetailModel->findBatchByMaterialNumber($material_number);
			$detail->batch_number = $batch_number;
		}
		return $order_details;
	}
}

?>