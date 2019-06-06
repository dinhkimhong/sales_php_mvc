<?php
namespace Core;
use Core\DB;
use Core\Session;
use Core\Helper;

class Validate{
	protected $_db=null, $_passed = false, $_errors=[];
	public function __construct(){
		$this->_db = new DB;
	}

	public function check($source, $items=[], $csrfCheck = false){
		$this->_errors = [];
		if($csrfCheck){
			$csrfPass = Helper::checkToken($source['csrf_token']);
			if(!isset($source['csrf_token']) || !$csrfPass){
				$this->addError("Something has gone wrong");
			}
		}

		foreach ($items as $item => $rules){
			$item = Input::sanitize($item);
			$display = $rules['display'];

//validate array
			if(is_array($source[$item])){
				foreach($source[$item] as $i){
					$value = Input::sanitize(trim($i));
					foreach($rules as $rule => $rule_value){
						if ($rule === 'required' && empty($value)){
							$this->addError("{$display} is required");
						}else if(!empty($value)){
							switch($rule){
								case 'min':
									if(strlen($value) < $rule_value){
										$this->addError("{$display} must be a minimum of {$rule_value} characters.");
									}
									break;
								case 'max':
									if(strlen($value)> $rule_value){
										$this->addError("{$display} must be a maximum of {$rule_value} characters.");
									}
									break;
								case 'matches':
									if($value != $source($rule_value)){
										$matchDisplay = $items[$rule_value]['display'];
										$this->addError("{$matchDisplay} and {$display} must match.");
									}
									break;
								case 'unique':
									$check = $this->_db->query("SELECT {$item} FROM {$rule_value} WHERE {$item} = ?", [$value]);
									if($check->_count){ //can replace $check by $this->_db
										$this->addError("{$display} already exists. Please choose another {$display}");
									}
									break;
								case 'unique_update':
									$t = explode(",", $rule_value);
									$table = $t[0];
									$id = $t[1];
									$query = $this->_db->query("SELECT * FROM {$table} WHERE id !=?  AND {$item} = ?", [$id, $value]);
									if($query->count()){
										$this->addError("{$diplay} already exist. Please choose another {$display}.");
									}
									break;
								case 'is_numeric':
									if(!is_number($value)){
										$this->addError("{$display} must be a number.");
									}
									break;
								case 'valid_email':
									if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
										$this->addError("{$display} must be a valid email.");
									}
								break;
							}
						}
				}
			}
//validate not array					
			}else{
				$value = Input::sanitize(trim($source[$item]));
				foreach($rules as $rule => $rule_value){

					if ($rule === 'required' && empty($value)){
						$this->addError("{$display} is required");
					}else if(!empty($value)){
						switch($rule){
							case 'min':
								if(strlen($value) < $rule_value){
									$this->addError("{$display} must be a minimum of {$rule_value} characters.");
								}
								break;
							case 'max':
								if(strlen($value)> $rule_value){
									$this->addError("{$display} must be a maximum of {$rule_value} characters.");
								}
								break;
							case 'matches':
								if($value != $source($rule_value)){
									$matchDisplay = $items[$rule_value]['display'];
									$this->addError("{$matchDisplay} and {$display} must match.");
								}
								break;
							case 'unique':
								$check = $this->_db->query("SELECT {$item} FROM {$rule_value} WHERE {$item} = ?", [$value]);
								if($check->_count){ //can replace $check by $this->_db
									$this->addError("{$display} already exists. Please choose another {$display}");
								}
								break;
							case 'unique_update':
								$t = explode(",", $rule_value);
								$table = $t[0];
								$id = $t[1];
								$query = $this->_db->query("SELECT * FROM {$table} WHERE id !=?  AND {$item} = ?", [$id, $value]);
								if($query->count()){
									$this->addError("{$diplay} already exist. Please choose another {$display}.");
								}
								break;
							case 'is_numeric':
								if(!is_number($value)){
									$this->addError("{$display} must be a number.");
								}
								break;
							case 'valid_email':
								if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
									$this->addError("{$display} must be a valid email.");
								}
							break;
						}
					}					
				}
			}	
		}
		if(empty($this->_errors)){
			$this->_passed = true;
		}
		return $this;
	}

	public function addError($errors){
		$this->_errors[] = $errors;
		if(empty($this->_errors)){
			$this->_passed = true;
		}else{
			$this->_passed = false;
		}
	}

	public function errors(){
		return $this->_errors;
	}

	public function passed(){
		return $this->_passed;
	}

	public function displayErrors(){
		Session::set('errors',$this->_errors);
	}
}