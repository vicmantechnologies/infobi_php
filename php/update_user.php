<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	require('clases/conexion.php');
	require('clases/clases.php');
	
 $id = $_POST['identificador'];
 $email = strtolower($_POST['email']);
 $area = $_POST['area'];
 $password = $_POST['password'];
 $perfil = $_POST['perfil'];
 $name = $_POST['nombre'];
 $cargo = $_POST['cargo'];

$resultado = (new usuarios)->actualizar($id, $area, $email, $password, $perfil, $name, $cargo);

echo json_encode($resultado);


}
 ?>