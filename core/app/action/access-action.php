<?php
// access-action.php
// este archivo sirve para procesar las opciones de login y logout

if(isset($_GET["opt"]) && $_GET["opt"]=="login"){

if(!isset($_SESSION["user_id"])) {

$user_var = htmlentities($_POST["username"]);
$password = htmlentities($_POST['password']);


$user = $user_var;
$pass = sha1(md5($password_var));
$base = new Database();
$con = $base->connect();

$sql = "select * from user where username= \"".$user."\" and password= \"".$pass."\" and status=1";
//print $sql;
$query = $con->query($sql);
$found = false;
$userid = null;
while($r = $query->fetch_array()){
	$found = true ;
	$userid = $r['id'];
}

if($found==true) {
	$_SESSION['user_id']=$userid ;
	print "Cargando ... $user";
	Core::redir("./?view=home");
}else {
	Core::redir("./?view=login");
}
}else{
	Core::redir("./?view=home");	
}

}
if(isset($_GET["opt"]) && $_GET["opt"]=="logout"){
	unset($_SESSION);
	session_destroy();
	Core::redir("./?view=home");
}

?>