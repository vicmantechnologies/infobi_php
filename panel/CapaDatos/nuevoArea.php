<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require("../../conexion/conexion.php");
	if($_POST['id'] == "0")
	{
		
		$result=mysql_query("INSERT INTO areas (id, nom_area, estado) VALUES (NULL, '".$_POST['nombre_area']."',  '".$_POST['estado']."')");
		if($result)
		{
			$id=mysqli_insert_id();
			$array_devolver['mensaje'] ='Areá Registrado!';
			$array_devolver['resultado'] = $id;
		}
		else
		{
			$array_devolver['mensaje'] ='No es posible crear el cargo';
			$array_devolver['resultado'] ='0';
		}
	}
	else
	{
		$result=mysql_query("UPDATE areas SET nom_area='".$_POST['nombre_area']."', estado ='".$_POST['estado']."' where id='".$_POST['id']."'");
		if($result)
		{
			
			$array_devolver['mensaje'] ='Areá Actualizado!';
			$array_devolver['resultado'] = '1';
		}
		else
		{
			$array_devolver['mensaje'] ='Actualización Fallida';
			$array_devolver['resultado'] ='0';
		}
	}
	echo json_encode($array_devolver);
}
else 
{
    header( "refresh:1; url=../page_404.html" );
	die();
}
?>