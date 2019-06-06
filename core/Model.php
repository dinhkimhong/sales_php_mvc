<?php
namespace Core;
use Core\DB;
use \PDO;
use \PDOException;
use Model\Customer;

class Model{
	private $db;
	protected $table, $primaryKey;
	protected $fillable = array();
	public $lastInsertId;

	public function __construct(){
		$this->db = new DB;
	}

	public function fetchAll($condition = null, $params = []){
		$sql = "SELECT * FROM {$this->table}";
		if($condition && $params){
			$sql .= " WHERE {$condition}";
		}
		if($this->db->query($sql,$params)){
			if(count($this->db->_results)) return true;
			return false;
		}
		return false;
	}

	public function leftJoin($joinParams = [],$condition = null, $params = []){
		$sql = "SELECT * FROM {$this->table}";
		foreach ($joinParams as $p){
				$sql .= " LEFT JOIN {$p[0][0]} ON {$p[0][0]}.{$p[0][1]} = {$p[1][0]}.{$p[1][1]}";
		}

		if($condition && $params){
			$sql .= " WHERE {$condition}";
		}
		if($this->db->query($sql,$params)){
			if(count($this->db->_results)) return $this->db->_results;
			return false;
		}
		return false;		
	}

	public function all($condition = null, $params = []){
		if($this->fetchAll($condition, $params)){
			return $this->db->_results;
		}
	}

	public function findFirst($condition = null, $params = []){
		if($this->fetchAll($condition, $params)){
			return $this->db->_results[0];
		}
	}

	public function findById($id){
		$condition = "{$this->primaryKey} = ?";
		return $this->findFirst($condition, [$id]);
	}

	public function insert($data){
		$fieldString = '';
		$valueString = '';
		$values = array();
		foreach ($data as $key=>$value){
			$fieldString .= '`'. $key .'`,';
			$valueString .= '?,';
			$values[] = $value;

		}
		$fieldString = rtrim($fieldString,',');
		$valueString = rtrim($valueString,',');
		$sql = "INSERT INTO {$this->table} ({$fieldString}) VALUES ({$valueString})";
		return $this->db->query($sql, $values);
	}


	public function update($id, $data){
		$fieldString = '';
		$values = array();
		foreach ($data as $key=>$value){
			$fieldString .= ' '. $key .' = ?,';
			$values[] = $value;

		}
		$fieldString = trim($fieldString);
		$fieldString = rtrim($fieldString,',');

		$sql = "UPDATE {$this->table} SET {$fieldString} WHERE {$this->primaryKey} = {$id}";		
		return $this->db->query($sql, $values);
	}

	public function delete($id){
		$sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = {$id}";
		return $this->db->query($sql);

	}

	public function getLastInsertId(){
		return $this->db->_lastInsertId;
	}

	public static function pluck($arrays,$key_name){
		$result_array = array();
		foreach($arrays as $array){
			foreach($array as $key=>$value){
				$result_array[] = $array->$key_name;
			}
		}
		return $result_array;
	}
}
?>