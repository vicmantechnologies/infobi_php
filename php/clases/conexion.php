<?php 

class Conexion {



    protected $conexion_db;



    public function Conexion(){



            try{



                //$this->conexion_db=new PDO('mysql:charset=utf8mb4;host=localhost;port=3306;dbname=gvml_infobi', "gvml_userbi", "H5AL%-16.)m.");
				$this->conexion_db=new PDO('mysql:charset=utf8mb4;host=localhost;port=3306;dbname=gvml_infobi', "root", "jhon8791");


                $this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



                $this->conexion_db->exec("SET CHARACTER SET utf8");



                return $this->conexion_db;



            }catch(Exception $e){



                echo "La conexion fallo" . $e->getLine();



            }

    }

}