<?php
namespace Model;
use Core\Model;
use Core\Session;

class User extends Model{
	protected $table = 'users';
	protected $primaryKey = 'id';
	public static $currentUser = null;

	public function __construct($id_or_email = ''){
		parent::__construct();
		if($id_or_email != ''){
			if(is_int($id_or_email)){
				$user = $this->findById($id_or_email);
			}else{
				$user = $this->findByEmail($id_or_email);
			}
			if($user){
				foreach($user as $key=>$value){
					$this->$key = $value;
				}
			}
		}
	}

	public function findByEmail($email){
		$user = $this->findFirst(" email = ?",[$email]);
		return $user;
	}

	public function login($email){
		Session::set('login_user', $email);
	}

	public function logout(){
		Session::delete('login_user');
	}

	public static function currentUser(){
		if(!isset(self::$currentUser) && Session::exists('login_user')){
			$user = new User(Session::get('login_user'));
			self::$currentUser = $user;
		}
		return self::$currentUser;
	}

}

?>