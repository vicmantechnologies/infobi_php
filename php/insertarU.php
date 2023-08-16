<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	require('clases/conexion.php');
	require('clases/clases.php');
	$array_devolver=[];
 $email = strtolower($_POST['email']);
 $area = $_POST['area'];
 $password = $_POST['password'];
 $perfil = $_POST['perfil'];
 $name = $_POST['name'];
 $cargo = $_POST['cargo'];

	$resultado = (new usuarios)->con_by($email);
if(empty($resultado)){
	(new usuarios)->registrar($area, $email, $password, $perfil, $name, $cargo);
	$array_devolver['save']="<strong>Exito!</strong> Se ha guardaro exitosamente.";
}else{
	$array_devolver['error']="<strong>Ups!</strong> Ya existe usuario o correo";
}
echo json_encode($array_devolver);

}else 
{
    exit("Fuera de aquí");
}