<?php
namespace Core;
use \PDO;
use \PDOException;

class DB{
	private $_pdo;
	public $_query, $_results, $_lastInsertId, $_count = 0, $_error = false;

	public function __construct(){
		try{
			$this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME , DB_USER, DB_PASSWORD);
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}catch(PDOExeption $e){
			die($e->getMessage());
		}
	}

	public function query($sql, $params = []){
		$this->_error = false;
		$this->_query = $this->_pdo->prepare($sql);
		$x = 1;
		if(count($params)){
			foreach ($params as $param){
				$this->_query->bindValue($x, $param);
				$x++;
			}
		}
		if($this->_query->execute()){
			$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
			$this->_count = $this->_query->rowCount();
			$this->_lastInsertId = $this->_pdo->lastInsertId();
			return $this;
		} else{
			return false;
		}
	}


}