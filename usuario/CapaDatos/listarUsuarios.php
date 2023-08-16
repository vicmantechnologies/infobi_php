<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_SESSION["user_id"]))
{
	
	require("../../conexion/conexion.php");
	$result=mysql_query("SELECT * FROM usuario ");
	$contador = 0;
	$data = array();
	while($row=mysql_fetch_array($result))
	{
		$array_devolver['id'] 	= $row['ID'];
		$array_devolver['nombre'] 	= $row['nombre'];
		$array_devolver['cargo'] 	= $row['cargo'];
		$array_devolver['area'] 	= $row['area'];
		$array_devolver['correo'] 	= $row['correo'];
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