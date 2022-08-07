<?php 
// si el usuario no esta logeado
if(!isset($_SESSION["user_id"])){ Core::redir("./");}
$user= UserData::getById($_SESSION["user_id"]);
// si el id  del usuario no existe.
if($user==null){ Core::redir("./");}
?>
<?php if(isset($_GET["opt"]) && $_GET['opt']=="all"):
$contacts = PersonData::getAll();
  ?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>Contactos</h2>

<a href="./?view=persons&opt=new" class="btn btn-secondary">Nuevo Contacto</a>
<br><br>
<?php if(count($contacts)>0):?>
  <table class="table table-bordered">
    <thead>
      <th>Id</th>
      <th>Nombre</th>
      <th>Direccion</th>
      <th>Telefono</th>
      <th></th>
    </thead>
    <?php foreach($contacts as $con):?>
      <tr>
        <td><a href="./?view=persons&opt=open&id=<?php echo $con->id; ?>" class="btn btn-link btn-sm">#<?php echo $con->id; ?></a></td>
        <td><?php echo $con->name." ".$con->lastname; ?></td>
        <td><?php echo $con->address; ?></td>
        <td><?php echo $con->phone; ?></td>
        <td>
          <a href="./?view=persons&opt=edit&id=<?php echo $con->id; ?>" class="btn btn-warning btn-sm"><i class="bi-pencil"></i></a>
          <a href="./?action=persons&opt=del&id=<?php echo $con->id; ?>" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php else:?>
  <p class="alert alert-warning">No hay contactos</p>
<?php endif; ?>

</div>
</div>
</div>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="new"):?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>Nuevo Contacto</h2>


<form method="post" action="./?action=persons&opt=add">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" required name="name" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Apellidos</label>
    <input type="text" required name="lastname" class="form-control" id="exampleInputEmail1" placeholder="Apellidos">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="text" required name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Telefono</label>
    <input type="text" required name="phone" class="form-control" id="exampleInputPassword1" placeholder="Telefono">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Direccion</label>
    <input type="text" required name="address" class="form-control" id="exampleInputPassword1" placeholder="Direccion">
  </div>

  <div class="d-grid gap-2">
  <button type="submit" class="btn btn-primary ">Guardar</button>
</div>
</form>

</div>
</div>
</div>
<?php elseif(isset($_GET["opt"]) && $_GET["opt"]=="edit"):
$contact = PersonData::getById($_GET["id"]);
  ?>
  <div class="container">
<div class="row">
<div class="col-md-12">
<h2>Editar Contacto</h2>


<form method="post" action="./?action=persons&opt=update">
  <input type="hidden" name="_id" value="<?php echo $contact->id; ?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre</label>
    <input type="text" required name="name" value="<?php echo $contact->name; ?>" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Apellidos</label>
    <input type="text" required name="lastname" value="<?php echo $contact->lastname; ?>" class="form-control" id="exampleInputEmail1" placeholder="Apellidos">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="text" required name="email" value="<?php echo $contact->email; ?>" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Telefono</label>
    <input type="text" required name="phone" value="<?php echo $contact->phone; ?>" class="form-control" id="exampleInputPassword1" placeholder="Telefono">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Direccion</label>
    <input type="text" required name="address" value="<?php echo $contact->address; ?>" class="form-control" id="exampleInputPassword1" placeholder="Direccion">
  </div>

  <div class="d-grid gap-2">
  <button type="submit" class="btn btn-success ">Actualizar</button>
</div>
</form>

</div>
</div>
</div>
<?php endif; ?>
