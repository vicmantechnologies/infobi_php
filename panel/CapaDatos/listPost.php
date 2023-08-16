<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_SESSION["user_id"]))
{
	require("../../conexion/conexion.php");
	$result=mysql_query("SELECT * FROM cargos") or die (mysql_error());
	$contador = 0;
	$data = array();
	
	while($row=mysql_fetch_array($result))
	{
		$array_devolver['id'] 	= $row['id'];
		$array_devolver['nombre_cargo'] = $row['nom_cargo'];
		$array_devolver['estado'] 	= $row['estado'];
		
		$data['data'][$contador] = $array_devolver;
		$contador++;
	}
	echo json_encode($data);
}
else 
{
	header( "refresh:1; url=../page_404.html" );
	die();
}
?>