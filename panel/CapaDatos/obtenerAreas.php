<?php
require("../../conexion/conexion.php");	
$areas = array();

$query = "SELECT id, nom_area FROM areas WHERE estado=1";
$resultado = mysql_query($query);

while ($fila = mysql_fetch_assoc($resultado)) {
  $areas[] = $fila;
}


echo json_encode($areas);
?>
