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
		//inactivo todos los usuarios que tengana signado ese reporte
		mysql_query("UPDATE iframe SET estadoIframe=0 WHERE idRefReporte ='".$_POST['id']."' ");
		//actualizar los usuarios que pueden ver o no el reporte
		foreach ($_POST['usuarios'] as $clave => $valor)
		{
			$result=mysql_query("SELECT ID FROM iframe WHERE idRefReporte='".$_POST['id']."' and usuario='".$valor['value']."' limit 1");
			$total = mysql_num_rows($result);
			if($total > 0)
			{
				//actualizar estado del reporte al usuario
				$row=mysql_fetch_array($result);
				$result=mysql_query("UPDATE iframe SET estadoIframe=1 WHERE ID ='".$row["ID"]."' ");
			}
			else
			{
				//agregar el reporte al usuario 
				$result=mysql_query("INSERT INTO iframe (ID, IFRAEM, usuario, nombre_iframe,idRefReporte, estadoIframe) VALUES (NULL, '', '".$valor['value']."', '', '".$_POST['id']."','1')");
			}
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