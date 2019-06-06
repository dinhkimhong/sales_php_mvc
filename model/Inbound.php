<?php
namespace Model;
use Core\Model;

class Inbound extends Model{
	protected $table = "inbounds";
	protected $primaryKey = "inbound_number";
}