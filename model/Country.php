<?php
namespace Model;
use Core\Model;

class Country extends Model{
	protected $table = "countries";
	protected $primaryKey = "country_code";
}