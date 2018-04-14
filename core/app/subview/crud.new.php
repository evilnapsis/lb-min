<div class="container">
<div class="row">
<div class="col-md-12">
<h1>USUARIOS</h1>
<h3>Nuevo Usuario</h3>
<div class="panel panel-default">
<div class="panel-heading">Login</div>
<div class="panel-body">

<form method="post" action="./?action=adduser">
	<?php Bs::render_new(schema::$table_user); ?>
	<?=Bs::button('Acceder','submit'); ?>
</form>

</div>
</div>


</div>
</div>
</div>