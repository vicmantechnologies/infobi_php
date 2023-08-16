<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require("../../conexion/conexion.php");
	if($_POST['id'] == "0")
	{
		
		$result=mysql_query("INSERT INTO cargos (id, nom_cargo, estado) VALUES (NULL, '".$_POST['nombre_cargo']."',  '".$_POST['estado']."')");
		if($result)
		{
			$array_devolver['mensaje'] ='Cargo Registrado!';
			$array_devolver['resultado'] = '1';
		}
		else
		{
			$array_devolver['mensaje'] ='No es posible crear el cargo';
			$array_devolver['resultado'] ='0';
		}
	}
	else
	{
		$result=mysql_query("UPDATE cargos SET nom_cargo='".$_POST['nombre_cargo']."', estado ='".$_POST['estado']."' where id='".$_POST['id']."'");
		if($result)
		{
			
			$array_devolver['mensaje'] ='Cargo Actualizado!';
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