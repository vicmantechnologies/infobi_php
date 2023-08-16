<?php 

class DB {

    protected static $con;

    private function __construct(){

        try{

            //self::$con = new PDO('mysql:charset=utf8mb4;host=localhost;port=3306;dbname=gvml_infobi_pruebas', 'gvml_userbi', 'H5AL%-16.)m.');
			self::$con = new PDO('mysql:charset=utf8;host=localhost;port=3306;dbname=gvml_infobi', 'root', '12345678');

            self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$con->setAttribute(PDO::ATTR_PERSISTENT, false);    

        }catch (PDOException $e){

            echo "No hemos podido conectar con la base de datos pruebas.";

            exit;

        }

    }

    public static function getConn(){

        if(!self::$con){

            new DB();

        }

        return self::$con;

    }

}

?>