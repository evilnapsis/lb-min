<?php
class schema{
	public static $table_user = array(
		"id"=>array("key"=>"ai","label"=>"","form"=>"hidden","required"=>"","actions"=>"view"),
		"name"=>array("label"=>"Nombre","form"=>"text","required"=>"","actions"=>"add,edit,view"),
		"lastname"=>array("label"=>"Apellidos","form"=>"text","required"=>"","actions"=>"add,edit,view"),
		"username"=>array("label"=>"Nombre de Usuario","form"=>"text","required"=>"","actions"=>"add,edit,view"),
		"email"=>array("label"=>"Correo electronico","form"=>"text","required"=>"","actions"=>"add,edit,view"),
		"password"=>array("label"=>"Password","form"=>"password","required"=>"","actions"=>"add,edit")
	);

}

?>
