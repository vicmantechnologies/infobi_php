<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require("../../conexion/conexion.php");
	if($_POST['id'] != "0")
	{
		$result=mysql_query("UPDATE usuario SET pass='".$_POST['contrasena']."' where ID='".$_POST['id']."'");
		if($result)
		{
			
			$array_devolver['mensaje'] ='Usuario Actualizado!';
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