<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require("../../conexion/conexion.php");	
	$result=mysql_query("select pass from usuario where ID='".$_POST['id']."'");
	$num = mysql_num_rows($result);
		if($num > 0)
		{
			$row = mysql_fetch_array($result);
			if($row["pass"] != $_POST['clave'])
			{
				$array_devolver['mensaje'] ='La contraseña actual no coincide.';
				$array_devolver['resultado'] = "0";
			}
			else
			{
				$result=mysql_query("UPDATE usuario SET pass='".$_POST['nuevaClave']."' where ID='".$_POST['id']."'");
				if($result)
				{
					$array_devolver['mensaje'] ='Cambio de contraseña Realizado!';
					$array_devolver['resultado'] = "1";
				}
				else
				{
					$array_devolver['mensaje'] ='No es posible actualizar la contraseña.';
					$array_devolver['resultado'] ='0';
				}
			}
			
		}
		else
		{
			$array_devolver['mensaje'] ='Usuario no Encontrado';
			$array_devolver['resultado'] ='0';
		}
	

	echo json_encode($array_devolver);
}
else 
{
	session_destroy();
    header( "refresh:1; url=../page_404.html" );
	die();
}
?>