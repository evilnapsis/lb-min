<?php
if(isset($_GET["opt"]) && $_GET["opt"]=="register"){
if(count($_POST)>0){



	$user = new UserData();

	$user->addExtraFieldString("name", htmlentities($_POST["name"]));
	$user->addExtraFieldString("lastname", htmlentities($_POST["lastname"]));

	$user->email = htmlentities($_POST["email"]);
	$user->password = sha1(md5(htmlentities($_POST["password"])));
	$user->register();
	Core::alert("Usuario agregado!");
	Core::redir("./?view=login");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
if(count($_POST)>0){
	$user = new UserData();
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->username = $_POST["username"];
	$user->email = $_POST["email"];
	$user->password = sha1(md5($_POST["password"]));
	$user->add();
	Core::alert("Usuario eliminado!");
	Core::redir("./?view=users");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="upd"){
if(count($_POST)>0){
	$user = UserData::getById($_POST["user_id"]);
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->username = $_POST["username"];
	$user->email = $_POST["email"];
	$user->update();

	if($_POST["password"]!=""){
		$user->password = sha1(md5($_POST["password"]));
		$user->update_passwd();
		Core::alert("Se ha actualizado el password!");
	}
	Core::alert("Usuario actualizado!");
	Core::redir("./?view=users&o=all");
}
}
else if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$user = UserData::getById($_GET["id"]);
	if($user->id!=$_SESSION["user_id"]){
		$user->del();
	}
	Core::alert("Usuario eliminado!");
	Core::redir("./?view=users&o=all");
}



?>