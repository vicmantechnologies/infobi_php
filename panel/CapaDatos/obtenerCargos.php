<?php
require("../../conexion/conexion.php");	

$cargos = array();

$query = "SELECT id, nom_cargo FROM cargos WHERE estado = 1";
$resultado = mysql_query($query);

while ($fila = mysql_fetch_assoc($resultado)) {
  $cargos[] = $fila;
}


echo json_encode($cargos);
?>
