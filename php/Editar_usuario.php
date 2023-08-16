
<?php 

require('clases/conexion.php');
require('clases/c_Usuario.php');

$user = $_GET["q"];

$resultados = (new Usuarios)->Con_by_id($user);

$output = "";

foreach ($resultados as $r) {
$output .= '
<input type="number" name="id" hidden="" value="'.$r["ID"].'">
<div class="row">
		      <div class="form-group col-md-12">
        <label for="name"><strong>Nombre Completo</strong></label>
        <input type="text" name="name" class="form-control" required autocomplete="name" value="'.$r["nombre"].'">
          </div>
          <div class="form-group col-md-6">
        <label for="area"><strong>Area</strong></label>
        <input type="text" name="area" class="form-control" required autocomplete="username" value="'.$r["area"].'">
          </div>
          <div class="form-group col-md-6">
        <label for="cargo"><strong>Cargo</strong></label>
        <input type="text" name="cargo" class="form-control" required autocomplete="cargo" value="'.$r["cargo"].'">
          </div>
          <div class="form-group col-md-12">
        <label for="email"><strong>Correo / Usuario</strong></label>
        <input type="email" name="email" class="form-control" required autocomplete="email" value="'.$r["correo"].'">
          </div>
          <div class="form-group col-md-6">
        <label for="pass"><strong>Password</strong></label>
        <input type="password" name="pass" class="form-control" required autocomplete="current-password" value="'.$r["pass"].'">
          </div>
          <div class="form-group col-md-6">
        <label for="perfil"><strong>Perfil</strong></label>
        <select name="perfil" class="form-control" required>';
          if ($r["perfil"] == 1) {
          	$output.='
          	<option value="'.$r["perfil"].'" selected>Admin</option>
          	<option value="2">Usuario</option>
          	';
          }else{
          	$output.='<option value="'.$r["perfil"].'" selected>Usuario</option>
          	<option value="1">Admin</option>';
          }

          $output.='
        </select>
          </div>
</div>
';
}
echo $output;




 ?>