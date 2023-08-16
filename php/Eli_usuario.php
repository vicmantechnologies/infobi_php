<?php 
require('clases/conexion.php');
require('clases/c_Usuario.php');

(new Usuarios)->eliminar($_GET["q"]);

echo "ok";

 ?>