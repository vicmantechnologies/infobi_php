<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION["user_id"]))
{
	
	require("../../conexion/conexion.php");
	
	$data=mysql_query("SELECT * FROM usuario where estado=1 order by nombre ASC");
	$contador = 0;
	while($row=mysql_fetch_array($data))
	{
		$result=mysql_query("SELECT I.estadoIframe FROM iframe I  WHERE I.idRefReporte='".$_POST["id"]."' AND I.usuario='".$row["ID"]."' LIMIT 1");
		$fila=mysql_fetch_array($result);
		$check = "checked";
		if($fila['estadoIframe'] == 0)
		{
			$check = "";
		}
		$contador++;
		$html .='<div class=""><label><input type="checkbox" '.$check.' name="usuarios[]" id="usuarios'.$contador.'" class="js-switch" class="flat" value="'.$row['ID'].'"/> '.$row['nombre'].' <br /></label></div>';
	}
	echo $html;
}
else 
{
	header( "refresh:1; url=../page_404.html" );
	die();
}
?>