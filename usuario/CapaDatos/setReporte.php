<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require("../../conexion/conexion.php");
	if($_POST['id'] == "0")
	{
		
		/*$result=mysql_query("INSERT INTO usuario (ID, area, correo, pass, perfil, nombre, cargo, estado) VALUES (NULL, '".$_POST['area']."', '".$_POST['correo']."', '".$_POST['contrasena']."', '".$_POST['perfil']."', '".$_POST['nombre']."', '".$_POST['cargo']."', '".$_POST['estado']."')");
		if($result)
		{
			$id=mysqli_insert_id();
			$array_devolver['mensaje'] ='Usuario Registrado!';
			$array_devolver['resultado'] = $id;
		}
		else
		{
			$array_devolver['mensaje'] ='No es posible crear el usuario';
			$array_devolver['resultado'] ='0';
		}*/
	}
	else
	{
		$result=mysql_query("UPDATE reportes SET nomReporte='".$_POST['nombre']."', urlReporte='".$_POST['url']."', estadoReporte ='".$_POST['estado']."' where idReporte='".$_POST['id']."'");
		if($result)
		{
			
			$array_devolver['mensaje'] ='Reporte Actualizado!';
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