<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_SESSION["user_id"]))
{
	
	require("../../conexion/conexion.php");
	$result=mysql_query("SELECT * FROM reportes");
	$contador = 0;
	$data = array();
	while($row=mysql_fetch_array($result))
	{
		$array_devolver['id'] 	= $row['idReporte'];
		$array_devolver['url'] 	= $row['urlReporte'];
		$array_devolver['nombre'] 	= $row['nomReporte'];
		$array_devolver['estado'] 	= $row['estadoReporte'];
		
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