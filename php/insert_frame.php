<?php 
session_start();
if(isset($_SESSION["user_id"])){
	require('clases/conexion.php');
require('clases/clases.php');
$user =  $_GET["q"];
(new iframe)->insertar($user);

echo "ok";
}else{
	session_start();
	session_destroy();
	header( "refresh:1; url=../login.php" );
}
