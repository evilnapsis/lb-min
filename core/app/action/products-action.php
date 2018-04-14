<?php

if(Core::g("opt","add")){
if(Crudadmin::valid(schema::$product)){
	Core::$post["image"] = Form::upload("image","storage/images");
	Crudadmin::add(schema::$product,new ProductData(), Core::$post);

	Core::addFlash("info","Nueva categoria agregado exitosamente!");
}
Core::redir("./?view=products&opt=all");
}
else if(Core::g("opt","update")){
if(Crudadmin::valid(schema::$product)){
	$user = ProductData::getById(Core::$post["id"]);
	Core::$post["image"] = Form::upload("image","storage/images");

	if(Core::$post["image"]==""){ Core::$post["image"]=$user->image;}

	Crudadmin::update(schema::$product,$user, Core::$post);
	Core::addFlash("success","Categoria actualizada exitosamente!");
}
Core::redir("./?view=products&opt=all");
}
else if(Core::g("opt","del")){
	$u  = ProductData::getById($_GET["id"]);
	$u->del();
	Core::addFlash("danger","[#$u->id] Eliminada exitosamente!");
	Core::redir("./?view=products&opt=all");
}
?>