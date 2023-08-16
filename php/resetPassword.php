<?php
date_default_timezone_set('America/Bogota');
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require("../conexion/conexion.php");	
	$result=mysql_query("select ID from usuario where correo='".$_POST['correo']."'");
	$num = mysql_num_rows($result);
		if($num > 0)
		{
			$nuevaContra = generarContrasena();
			
			if(sendMail($_POST['correo'], $nuevaContra))
			{
				$result=mysql_query("UPDATE usuario SET pass='".$nuevaContra."' where correo='".$_POST['correo']."'");
				if($result)
				{
					$array_devolver['mensaje'] ='Un correo electronico a sido enviado!';
					$array_devolver['resultado'] = '1';
				}
				else
				{
					$array_devolver['mensaje'] ='Actualización Fallida';
					$array_devolver['resultado'] ='0';
				}
			}
			else
			{
				$array_devolver['mensaje'] ='No es posible acualizar la clave en estos momentos';
				$array_devolver['resultado'] ='0';
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

<?php
function sendMail($correo,$newpass)
{
	error_reporting(-1);
	//$correos = "jhon.cobos@holdingvml.net";
	$correos = $correo;
	$pdfBase64 = "";
	$pdfName = "";
	include_once('./lib/nusoap.php');
	$usuario="wservice";
	$password="20SendMail22";
	$cliente = new nusoap_client("http://sype.com.co/mail/sendMailWS2v2.php?wsdl",'wsdl');
	$cliente->setCredentials($usuario,$password);
	$error = $cliente->getError();
	$asunto = "Recuperación de Contraseña";
	$resultadoCorreo = false;
	if ($error) 
	{
		echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	}
	$result = $cliente->call("senMail", array("user" => "CiatraNPRO",
												"password" => "20WsAcCeSs22",
												"emailFrom" => "authentication@holdingvml.com",
												"emailPass" => "dB94kH-)RArx",
												"host" => "mail.holdingvml.com",
												"puertoSMTP" => "587",
												"destinatarios" => $correos,
												"emailCopia" => "",
												"emailAsunto" => utf8_decode($asunto),
												"emailCuerpo" => "Se realizo la solicitud de recuperacion de acceso a la plataforma INFOBI para el usuario ".$correo.".<br>Su nueva clave es <h2>".$newpass."</h2>",
												"emailAdjunto" => $pdfBase64,
												"emailNameAdjunto" => $pdfName));
		if ($cliente->fault) 
		{
			echo "<h2>Fault</h2><pre>";
			print_r($result);
			echo "</pre>";
		}
		else 
		{
			$error = $cliente->getError();
			if ($error) 
			{
				echo "<h2>Error</h2><pre>" . $error . "</pre>";
				$mensaje_correo = "";
			}
			else 
			{
				//print_r($result);
				$resultadoCorreo = true;
				$mensaje_correo = "Se envío un correo a la dirección ".$correos." con la información de su agendamiento.";
			}
		}
		return $resultadoCorreo;
}
function generarContrasena()
{
	$caracteres='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$longpalabra=8;
	for($pass='', $n=strlen($caracteres)-1; strlen($pass) < $longpalabra ; ) 
	{
	  $x = rand(0,$n);
	  $pass.= $caracteres[$x];
	}
	return $pass;
}
?>