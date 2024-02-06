<?php require("layout/header.php"); ?>
<h1>CLIENTES</h1>
<br/>
<h2><?php echo ($opcion == 'EDITAR' ? 'MODIFICAR' : 'NUEVO'); ?></h2>
<form action="<?php echo 'index.php?m=' .
($opcion == 'EDITAR' ? 'modificar&id=' . $cliente->id : 'insertar'); ?>"
method="POST">
<label for="nombre" class="form-label">Nombre</label>
<input type="text"
class="form-control"
name="nombre"
id="nombre"
value="<?php echo ($opcion == 'EDITAR' ? $cliente->nombre : ''); ?>"
required/>
<br/>
<label for="email" class="form-label">Email</label>
<input type="text"
class="form-control"
name="email"
id="email"
value="<?php echo ($opcion == 'EDITAR' ? $cliente->email : ''); ?>"
required/>
<br/>
<button type="submit" class="btn btn-primary">Aceptar</button>
<a href="<?php echo URLSITE; ?>">
<button type="button"
class="btn btn-outline-secondary float-end">Cancelar</button>
</a>
</form>
 
<?php require("layout/footer.php"); ?>
<?php
if (session_status() === PHP_SESSION_NONE)
session_start();
require_once("../config.php");
require("layout/header.php");
?>
<br/>
<div class="alert alert-danger" role="alert">
<h4 class="alert-heading">¡Error!</h4>
<p>Ha habido un error al realizar la operación:</p>
<p style="font-style: italic;"><?php echo $_SESSION["CRUDMVC_ERROR"]; ?></p>
<hr>
<p class="mb-0">
<button type="submit" class="btn btn-primary"
onclick="window.history.back()">Reintentar</button>
<a href="<?php echo URLSITE; ?>"><button type="button"
class="btn btn-outline-secondary float-end">Cancelar</button></a>
</p>
</div>
<?php require("layout/footer.php"); ?>