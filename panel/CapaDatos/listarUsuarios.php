<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_SESSION["user_id"]))
{
	require("../../conexion/conexion.php");
	$result=mysql_query("SELECT usuario.*, A.id, A.nom_area, C.id, C.nom_cargo FROM usuario
	INNER JOIN areas A ON usuario.area = A.id
	INNER JOIN cargos C ON usuario.cargo = C.id ORDER BY A.id ASC") or die (mysql_error());
	$contador = 0;
	$data = array();
	
	while($row=mysql_fetch_array($result))
	{
		$array_devolver['id'] = $row['ID'];
		$array_devolver['nombre'] = $row['nombre'];
 		$array_devolver['nom_cargo'] = $row['cargo']; 
	 	$array_devolver['nom_area'] = $row['area']; 
		$array_devolver['cargo'] = $row['nom_cargo'];
		$array_devolver['area'] = $row['nom_area'];
		$array_devolver['correo'] = $row['correo'];
		$array_devolver['perfil'] = $row['perfil'];
		$array_devolver['estado'] = $row['estado'];
		$idUsuario = $row['id']; // Obtener el ID del usuario

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