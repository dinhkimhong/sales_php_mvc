<?php
namespace Model;
use Core\Model;

class Outbound extends Model{
	protected $table = "outbounds";
	protected $primaryKey = "outbound_number";
}