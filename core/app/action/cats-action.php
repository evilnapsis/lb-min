<?php

if(Core::g("opt","add")){
if(Crudadmin::valid(schema::$category)){
	Crudadmin::add(schema::$category,new CategoryData(), Core::$post);

	Core::addFlash("info","Nueva categoria agregado exitosamente!");
}
Core::redir("./?view=cats&opt=all");
}
else if(Core::g("opt","update")){
if(Crudadmin::valid(schema::$category)){
	$user = CategoryData::getById(Core::$post["id"]);
	Crudadmin::update(schema::$category,$user, Core::$post);
	Core::addFlash("success","Categoria actualizada exitosamente!");
}
Core::redir("./?view=cats&opt=all");
}
else if(Core::g("opt","del")){
	$u  = CategoryData::getById($_GET["id"]);
	$u->del();
	Core::addFlash("danger","[#$u->id] Eliminada exitosamente!");
	Core::redir("./?view=cats&opt=all");
}
?>