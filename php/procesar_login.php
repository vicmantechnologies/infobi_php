<?php
require_once "conexion/config.php";
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    header("Content-Type: application/json");
    $array_devolver=[];
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];

    // comprobar si el user existe 
    $buscar_user = $con->prepare("SELECT * FROM usuario WHERE correo = '$email' LIMIT 1");
    $buscar_user->bindParam(':email', $email, PDO::PARAM_STR);
    $buscar_user->execute();

    if($buscar_user->rowCount() == 1){
        // Existe
        $user = $buscar_user->fetch(PDO::FETCH_ASSOC);
        $user_id = (int) $user['ID'];
        $hash = (string) $user['pass'];
        $nombre = (string) $user['nombre'];
        $perfil = $user['perfil'];
        if($password == $hash){
            $_SESSION['user_id']=$user_id;
            $_SESSION['perfil']=$perfil;
            $_SESSION['nombre']=$nombre;
            date_default_timezone_set("Etc/GMT+5");
            $hoy = date('Y/m/d H:i:s');
            $insertar = $con->prepare("INSERT INTO fecha_i VALUES(null, '$hoy', '$user_id')");
            $insertar->execute();
			if($perfil == "1")
			{
				$array_devolver['redirect'] ='panel/admin.php';
			}
			else
			{
				$array_devolver['redirect'] ='usuario/informes.php';
			}
            
        }else{
            $array_devolver['error']="Los datos no son validos.";
        }

    }else{
      $array_devolver['error']="Usuario no registrado.";
    }

    echo json_encode($array_devolver);

}else{
    exit("Fuera de aquí");
    header( "refresh:1; url=../login.php" ); 
}


?>