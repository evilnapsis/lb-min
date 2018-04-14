<?php
class schema{
	public static $table_user = array(
		"id"=>array("key"=>"ai","label"=>"","form"=>"hidden","required"=>"","actions"=>"edit,view"),
		"image"=>array("label"=>"Imagen","form"=>"file","required"=>"","actions"=>"view,add,edit","edit"=>"image:100x100","upload"=>"storage/images/"),
		"name"=>array("label"=>"Nombre","form"=>"text","required"=>"","actions"=>"add,edit,view"),
		"lastname"=>array("label"=>"Apellidos","form"=>"text","required"=>"","actions"=>"add,edit,view"),
		"username"=>array("label"=>"Nombre de Usuario","form"=>"text","required"=>"","actions"=>"add,edit,view"),
		"email"=>array("label"=>"Correo electronico","form"=>"text","required"=>"","actions"=>"add,edit,view"),
		"password"=>array("label"=>"Password","form"=>"password","required"=>"","actions"=>"add,edit")
	);

	public static $category = array(
		"id"=>array("key"=>"ai","label"=>"","form"=>"hidden","required"=>"","actions"=>"edit"),
		"name"=>array("label"=>"Nombre","form"=>"text","required"=>"","actions"=>"add,edit,view")
	);

	public static $product = array(
		"id"=>array("key"=>"ai","label"=>"","form"=>"hidden","required"=>"","actions"=>"edit,view"),
		"image"=>array("label"=>"Imagen","form"=>"file","required"=>"","actions"=>"view,add,edit","edit"=>"image:100x100","upload"=>"storage/images/"),
		"name"=>array("label"=>"Nombre","form"=>"text","required"=>"","actions"=>"add,edit,view"),
		"description"=>array("label"=>"Descripcion","form"=>"textarea","required"=>"","actions"=>"add,edit,view"),
		"category_id"=>array("label"=>"Categoria","form"=>"select","required"=>"","actions"=>"add,edit,view","select"=>"category:id,name"),
		"email"=>array("label"=>"Correo electronico","form"=>"text","required"=>"","actions"=>"add,edit,view"),
		"password"=>array("label"=>"Password","form"=>"password","required"=>"","actions"=>"add,edit")
	);

}

?>
