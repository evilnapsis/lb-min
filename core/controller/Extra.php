<?php

class Extra {

	public $extra_fields;
	public $extra_fields_strings;

	public function __construct(){
		$this->extra_fields = array();
	}

	public function addExtraField($name, $value ){
		$extra = $this->extra_fields;

		$data = array("name"=>$name, "value"=> $value);
		array_push($extra, $data);

		$this->extra_fields = $extra;

	}

	public function addExtraFieldString($name, $value ){
		$extra = $this->extra_fields;

		$data = array("name"=>$name, "value"=> "\"$value\"");
		array_push($extra, $data);

		$this->extra_fields = $extra;

	}

	public function getExtraFieldNames(){
		$extra_names = array();
		foreach($this->extra_fields as $k=>$v){
			$extra_names[] = $k;
		}
		foreach($this->extra_fields_strings as $k=>$v){
			$extra_names[] = $k;
		}
		return implode(",", $extra_names);
	}

	public function getExtraFieldValues(){
		$extra_names = array();
		foreach($this->extra_fields as $k=>$v){
			$extra_names[] = $k;
		}
		foreach($this->extra_fields_strings as $k=>$v){
			$extra_names[] = $k;
		}
		return implode(",", $extra_names);
	}

}


?>