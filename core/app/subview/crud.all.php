<div class="container">
<div class="row">
<div class="col-md-12">
<h1>EVILNAPSIS</h1>
<?=Bs::a("Nuevo","./?view=crud&sb=new");?>
<br><br>
<?php Core::getFlashes(); 
$fields = Crudadmin::prepareFields(schema::$table_user,"view");
$labels = Crudadmin::prepareLabels(schema::$table_user,"view");
$users = UserData::getAll();
$tablearray = array();
$labels[] = "";
$tablearray["header"]=$labels;
$data = array();
foreach($users as $u){
	$d = array();
	foreach($fields as $f){
		$d[] = $u->{$f}; 
	}
	$d[] = Bs::a("Editar","./?view=crud&sb=edit&id=".$u->id,"warning","xs")." ".Bs::a("Eliminar","./?action=users&sa=del&id=".$u->id,"danger","xs");
	$data[]=$d;
}
$tablearray["body"]=$data;

?>


<div class="panel panel-default">
<div class="panel-heading">Usuarios</div>

<?=Table::render($tablearray);?>


</div>


</div>
</div>
</div>