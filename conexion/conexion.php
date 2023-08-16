<?php

@ $db=mysql_pconnect("localhost","root","12345678");
//@ $db=mysql_connect("localhost","gvml_userbi","H5AL%-16.)m.");
if (!$db)
{
	echo " Critical Error: No se ha podido conectar a la bd. Por favor prueba de nuevo.";
exit;
}
mysql_select_db("gvml_infobi");

?>