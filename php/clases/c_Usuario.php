<?php

Class usuarios extends Conexion
{
	public function cons(){
        parent::_construct();
    }

    public function consultar()
    {
        $consulta = $this->conexion_db->prepare("SELECT * FROM usuario");
          $consulta->execute();
           $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $consulta->closeCursor();
        $this->conexion_db = null;
         return $resultado;

    }
    public function registrar($user, $email, $pass, $perfil, $name, $cargo)
    {
        $consulta = $this->conexion_db->prepare("INSERT INTO usuario VALUES(null, '$user', '$email', '$pass', '$perfil', '$name', '$cargo')");
          $consulta->execute();
            $consulta->closeCursor();
        $this->conexion_db = null;
    }
    public function con_by($email)
    {
        $consulta = $this->conexion_db->prepare("SELECT * FROM usuario WHERE correo = '$email'");
          $consulta->execute();
           $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $consulta->closeCursor();
        $this->conexion_db = null;
         return $resultado;

    }
    public function Con_by_id($id)
    {
        $consulta = $this->conexion_db->prepare("SELECT * FROM usuario WHERE ID = '$id'");
          $consulta->execute();
           $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $consulta->closeCursor();
        $this->conexion_db = null;
         return $resultado;

    }
    public function actualizar($id, $user, $email, $password, $perfil, $name, $cargo)
    {
      $array_devolver=[];
        $consulta = $this->conexion_db->prepare("SELECT * FROM usuario WHERE area = '$user' AND correo = '$email'");
          $consulta->execute();
           $resultado = $consulta->fetchAll();

    if (!empty($resultado)) {
          $consulta2 = $this->conexion_db->prepare("SELECT * FROM usuario WHERE ID = '$id'");
          $consulta2->execute();
           $resultado2 = $consulta2->fetchAll();

           if ($resultado[0]["correo"] == $resultado2[0]["correo"]) {
             $consulta = $this->conexion_db->prepare("UPDATE usuario SET area = '$user', correo = '$email', pass = '$password', perfil = '$perfil', nombre='$name', cargo='$cargo' WHERE Id = '$id';");
              $consulta->execute();
            $respuesta = 1;
           }else{
              $respuesta = 0;
           }
        }else{
            $consulta = $this->conexion_db->prepare("UPDATE usuario SET area = '$user', correo = '$email', pass = '$password', perfil = '$perfil', nombre='$name', cargo='$cargo' WHERE Id = '$id';");
              $consulta->execute();
            $respuesta = 1;
        }
            $consulta->closeCursor();
            $consulta2->closeCursor();
        $this->conexion_db = null;
         return $respuesta;

    }
    public function eliminar($user)
    {
        $consulta = $this->conexion_db->prepare("DELETE FROM usuario WHERE ID = '$user';");
          $consulta->execute();
            $consulta->closeCursor();
        $this->conexion_db = null;
    }
}