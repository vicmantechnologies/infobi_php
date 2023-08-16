<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require("../../conexion/conexion.php");
	$report=mysql_query("INSERT INTO reportes (idReporte, urlReporte, nomReporte, estadoReporte) VALUES (NULL, '".$_POST['url']."', '".$_POST['informe']."','1')");
	$id=mysql_insert_id();
	foreach ($_POST['usuarios'] as $clave => $valor)
	{
		$result=mysql_query("INSERT INTO iframe (ID, IFRAEM, usuario, nombre_iframe,idRefReporte, estadoIframe) VALUES (NULL, '', '".$valor['value']."', '', '".$id."','1')");
			if($result)
			{
				$array_devolver['mensaje'] ='Informe Registrado!';
				$array_devolver['resultado'] = '1';
			}
			else
			{
				$array_devolver['mensaje'] ='No es posible crear el reporte';
				$array_devolver['resultado'] ='0';
			}
	}
	echo json_encode($array_devolver);
}
else 
{
	header( "refresh:1; url=../page_404.html" );
}
?>