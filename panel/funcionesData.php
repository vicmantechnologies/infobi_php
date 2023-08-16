<?php
function obtenerInformes($idUsuario)
{
	$result= "";
	require("../conexion/conexion.php");
	$qr_data=mysql_query("SELECT i.ID,nombre_iframe,IFRAEM,u.nombre FROM iframe i inner join usuario u on i.usuario= u.ID  WHERE usuario ='".$idUsuario."' order by id DESC ");
	while($row=mysql_fetch_array($qr_data))
	{
		$result .="<tr><td>".$row['ID']."</td><td>".$row['nombre_iframe']."</td><td><a href='#' onclick='modal(this.id)' id='".$row['IFRAEM']."'>CLIC PARA VER EL INFORME</a></td><td>".$row['nombre']."</td></tr>";
	}
	return $result;
}
function obtenerUsuario($idUsuario)
{
	$result= "";
	require("../conexion/conexion.php");
	$qr_data=mysql_query("SELECT nombre FROM usuario WHERE ID ='".$idUsuario."' LIMIT 1");
	$row=mysql_fetch_array($qr_data);
	return $row["nombre"];
}
function listarUsuarios()
{
	$result= "";
	require("../conexion/conexion.php");
	$qr_data=mysql_query("SELECT * FROM usuario order by id DESC");
	while($row=mysql_fetch_array($qr_data))
	{
		if ($row['estado']== "1")
		{
         $state = '<span class="badge bg-success">SI</span>';
         }
         else
		 {
          $state ='<span class="badge bg-danger">NO</span>';
		 }
		$result .="<tr><td>".$row['nombre']."</td><td>".$row['cargo']."</td><td>".$row['area']."</td><td>".$row['correo']."</td><td>".$state."</td><td><button type='button' class='btn btn-primary btn-sm2 btn-editar btn-editar'><i class='fa fa-pencil-square'></i></button></td></tr>";
	}
	return $result;
}
function listarUsuarios2()
{
	require("../conexion/conexion.php");
	$result= "";
	$data=mysql_query("SELECT * FROM usuario where estado=1 order by nombre ASC");
	$contador = 0;
	while($row=mysql_fetch_array($data))
	{
		$contador++;
		$result .='<div class=""><label><input type="checkbox" name="usuarios[]" id="usuarios'.$contador.'" class="js-switch" class="flat" value="'.$row['ID'].'"/> '.$row['nombre'].' <br /></label></div>';
	}
	return $result;
}
function obtenerInformes2($idUsuario)
{
	$result= "";
	require("../conexion/conexion.php");
	$qr_data=mysql_query("SELECT U.nombre,R.idReporte,R.nomReporte,R.urlReporte FROM iframe I INNER JOIN reportes R ON I.idRefReporte=R.idReporte INNER JOIN usuario U ON I.usuario= U.ID  WHERE I.usuario ='".$idUsuario."' and I.estadoIframe=1 order by R.idReporte DESC ");
	while($row=mysql_fetch_array($qr_data))
	{
		$result .="<tr><td>".$row['idReporte']."</td><td>".$row['nomReporte']."</td><td><a href='#' onclick='modal(this.id)' id='".$row['urlReporte']."'>CLIC PARA VER EL INFORME</a></td><td>".$row['nombre']."</td></tr>";
	}
	return $result;
}
function listarUsuariosReporte()
{
	require("../conexion/conexion.php");
	$result= "";
	$data=mysql_query("SELECT * FROM usuario where estado=1 order by nombre ASC");
	$contador = 0;
	while($row=mysql_fetch_array($data))
	{
		$contador++;
		$result .='<div class=""><label><input type="checkbox" name="usuarios[]" id="usuarios'.$contador.'" class="js-switch" class="flat" value="'.$row['ID'].'"/> '.$row['nombre'].' <br /></label></div>';
	}
	return $result;
}
?>