<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require("../../conexion/conexion.php");
	if($_POST['id'] == "0")
	{
		$contrasenaActual = $_POST['contrasena'];
		$result=mysql_query("INSERT INTO usuario (ID, area, correo, pass, perfil, nombre, cargo, estado) VALUES (NULL, '".$_POST['area']."', '".$_POST['correo']."', '".$_POST['contrasena']."', '".$_POST['perfil']."', '".$_POST['nombre']."', '".$_POST['cargo']."', '".$_POST['estado']."')");
		if($result)
		{
			
			$array_devolver['mensaje'] ='Usuario Registrado!';
			$array_devolver['resultado'] = '1';
		}
		else
		{
			$array_devolver['mensaje'] ='No es posible crear el usuario';
			$array_devolver['resultado'] ='0';
		}
	}
	else
	{
		$result=mysql_query("UPDATE usuario SET area='".$_POST['area']."', correo='".$_POST['correo']."', perfil='".$_POST['perfil']."', nombre='".$_POST['nombre']."', cargo='".$_POST['cargo']."', estado ='".$_POST['estado']."' where ID='".$_POST['id']."'");
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