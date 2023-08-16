<?php
require("../../conexion/conexion.php");	
$perfiles = array();

$query = "SELECT id, nom_perfil FROM perfil WHERE estado = 1";
$resultado = mysql_query($query);

while ($fila = mysql_fetch_assoc($resultado)) {
  $perfiles[] = $fila;
}


echo json_encode($perfiles);
?>
