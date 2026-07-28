<?php
class UserData extends Extra{
	public static $tablename = "user";
	public $extra_fields;
	public $extra_fields_strings;

	public $id, $name, $lastname, $username, $email, $password, $kind, $status, $created_at, $image;

	public function __construct(){
		$this->extra_fields = array();
		$this->extra_fields_strings = array();
		$this->name = "";
		$this->lastname = "";
		$this->username = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}


	public function register(){

		$sql = "insert into user (".$this->getExtraFieldNames().",username,email,password,created_at) ";
		$sql .= "value (".$this->getExtraFieldValues().",\"$this->username\",\"$this->email\",\"$this->password\",$this->created_at)";
		return Executor::doit($sql);
	}


	public function add(){
		$sql = "insert into user (name,lastname,email,password,kind,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->lastname\",\"$this->email\",\"$this->password\",$this->kind,$this->created_at)";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public static function delBy($k,$v){
		$sql = "delete from ".self::$tablename." where $k=\"$v\"";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",lastname=\"$this->lastname\",lastname=\"$this->lastname\",status=\"$this->status\",kind=\"$this->kind\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_passwd(){
		$sql = "update ".self::$tablename." set password=\"$this->password\" where id=$this->id";
		Executor::doit($sql);
	}

	public function updateById($k,$v){
		$sql = "update ".self::$tablename." set $k=\"$v\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}

	public static function getLogin($username,$password){
		$db = static::getDb();
		$stmt = $db->prepare("select * from ".self::$tablename." where (username = :u or email = :u) and password = :p and status = 1 limit 1");
		$stmt->execute(['u' => $username, 'p' => $password]);
		$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
		return $stmt->fetch() ?: null;
	}

	public static function getBy($k,$v){
		$sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}

	public static function getAll(){
		 $sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}

	public static function getAllBy($k,$v){
		 $sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}


}

?>