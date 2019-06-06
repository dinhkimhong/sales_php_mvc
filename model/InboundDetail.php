<?php
namespace Model;
use Core\Model;

class InboundDetail extends Model{
	protected $table = "inbound_details";
	protected $primaryKey = "number";

	public function findBatchByMaterialNumber($material_number){
		$joinParams = [
			[
				['materials','material_number'],
				['inbound_details','material_number']
			]
		];
		$outbound_details = $this->leftJoin($joinParams, "inbound_details.material_number = ?",[$material_number]);
		return $outbound_details;		
	}
}