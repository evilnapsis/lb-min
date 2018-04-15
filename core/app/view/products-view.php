<?php
if(Core::g("opt","all")):
?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1>Productos</h1>
<?=Bs::a("Nuevo","./?view=products&opt=new");?>
<br><br>
<?php Core::getFlashes(); 
$fields = Crudadmin::prepareFields(ProductData::$schema,"view");
$labels = Crudadmin::prepareLabels(ProductData::$schema,"view");
$users = ProductData::getAll();
$tablearray = array();
$labels[] = "";
$tablearray["header"]=$labels;
$data = array();
foreach($users as $u){
	$d = array();
	foreach($fields as $f){
		// hacemos una comparacion cuando vallamos a mostrar imagenes, para cambiar la forma en que se van a mostrar
		if($f=="image"){
			if($u->{$f}!=""){
				$d[]= "<img src='storage/images/".$u->{$f}."' style='width: 48px; height:48px;'>";
			}else{
				$d[]="";
			}
		}
		else if($f=="category_id"){
			if($u->{$f}!=""){
				$d[] = CategoryData::getById($u->{$f})->name;
			}else{
				$d[]= "";
			}
		}
		else if($f=="price"){
		$d[] = "$ ".$u->{$f}; 	
		}
		else{
		$d[] = $u->{$f}; 	
		}
	}
	$d[] = Bs::a("Editar","./?view=products&opt=edit&id=".$u->id,"warning","xs")." ".Bs::a("Eliminar","./?action=products&opt=del&id=".$u->id,"danger","xs");
	$data[]=$d;
}
$tablearray["body"]=$data;

?>
<?php if(count($users)>0):?>
<div class="panel panel-default">
<div class="panel-heading">Productos</div>

<?php
echo Table::render($tablearray);

?>
</div>
<?php else:
	echo "<p class='alert alert-warning'>No hay Productos</p>";
endif; 

?>
</div>
</div>
</div>
<?php elseif(Core::g("opt","new")):?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1>Productos</h1>
<h3>Nuevo Producto</h3>
<div class="panel panel-default">
<div class="panel-heading">Nuevo</div>
<div class="panel-body">

<form method="post" action="./?action=products&opt=add" enctype="multipart/form-data">
	<?php 
	Bs::render_new(ProductData::$schema,"add1");
	$select = array();
	$select[] = array("k"=>"","l"=>"-- SELECCIONE --");
	foreach(CategoryData::getAll() as $c){ $select[] = array("k"=>$c->id,"l"=>$c->name); }
	Bs::select("Categoria", "category_id",$select,""); 
	Bs::render_new(ProductData::$schema,"add2");
	?>
	<?=Bs::button('Agregar','submit'); ?>
</form>

</div>
</div>


</div>
</div>
</div>
<?php elseif(Core::g("opt","edit")):?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1>PRODUCTS</h1>
<h3>Editar Producto</h3>
<div class="panel panel-default">
<div class="panel-heading">Editar</div>
<div class="panel-body">

<form method="post" action="./?action=products&opt=update" enctype="multipart/form-data">
	<?php 
	$user = ProductData::getById($_GET["id"]);
	Bs::render_edit(ProductData::$schema,$user,"add1");
		$select = array();
	$select[] = array("k"=>"","l"=>"-- SELECCIONE --");
	foreach(CategoryData::getAll() as $c){ $select[] = array("k"=>$c->id,"l"=>$c->name); }
	Bs::select("Categoria", "category_id",$select,$user->category_id); 
 
	Bs::render_edit(ProductData::$schema,$user,"add2"); 

	?>
	<?=Bs::button('Actualizar','submit',"success"); 
	?>
</form>

</div>
</div>


</div>
</div>
</div>
<?php endif; ?>