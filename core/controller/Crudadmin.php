<?php

class Crudadmin{

	public static function valid($schema){
		return true;
	}

	public static function add($schema,$model,$data){
		foreach($schema as $k =>$v){
			if($v["form"]!="hidden"){
				$model->{$k} = $_POST[$k];
			}
		}
		$model->add();
	}



	public static function prepareFields($schema,$action="add"){
		$fields = array();
		foreach($schema as $k=>$v){
			if(in_array($action, explode(",", $v["actions"]))){
				$fields[] = $k;
			}
		}
	return ($fields);
	}

	public static function prepareLabels($schema,$action="add"){
		$fields = array();
		foreach($schema as $k=>$v){
			if(in_array($action, explode(",", $v["actions"]))){
				$fields[] = $v["label"];
			}
		}
	return ($fields);
	}

	public static function prepareValues($schema,$ths,$action="add"){
		$values = array();
		foreach($schema as $k=>$v){
			if(in_array($action, explode(",", $v["actions"]))){
				$val = $ths->{$k};
				if( !is_numeric($val) && $val!="NOW()" ){
					$val = "\"".$val."\"";
				}
				$values[] = $val;
			}
		}
	return ($values);
	}

	public static function buildIFromFV($tbn,$fs,$vs){
		return "insert into ".$tbn." (".implode(",", $fs).") values (".implode(",", $vs).")";
	}

	public static function buildS($tbn, $fields){
		$sql = "select ".implode(",", $fields)." from $tbn ";
		return $sql;
	}

}


?>