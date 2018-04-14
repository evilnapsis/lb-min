<?php
class ProductData {
	public static $tablename = "product";

	public function ProductData(){
		$this->name = "";
		$this->lastname = "";
		$this->username = "";
		$this->email = "";
		$this->password = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		//$sql = "insert into user (name,lastname,username,email,password,created_at) ";
		//$sql .= "value (\"$this->name\",\"$this->lastname\",\"$this->username\",\"$this->email\",\"$this->password\",$this->created_at)";
		$fs = Crudadmin::prepareFields(schema::$product,"add");
		$vs = Crudadmin::prepareValues(schema::$product,$this,"add");
		$fs[]="created_at";
		$vs[]="NOW()";
		echo $sql = Crudadmin::buildIFromFV(self::$tablename,$fs, $vs);
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
//		$sql = "update ".self::$tablename." set name=\"$this->name\",lastname=\"$this->lastname\",username=\"$this->username\",lastname=\"$this->lastname\",status=\"$this->status\",kind=\"$this->kind\" where id=$this->id";
		$fs = Crudadmin::prepareFields(schema::$product,"edit");
		$vs = Crudadmin::prepareValues(schema::$product,$this,"edit");
		$sql = Crudadmin::buildUFromFV(self::$tablename,$fs, $vs,$this->id);
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
		return Model::one($query[0],new ProductData());
	}

	public static function getBy($k,$v){
		$sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProductData());
	}

	public static function getAll(){
		$fs = Crudadmin::prepareFields(schema::$product,"view");
		 //$sql = "select * from ".self::$tablename;
		$sql = Crudadmin::buildS(self::$tablename,$fs);
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getAllBy($k,$v){
		 $sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}


}

?>