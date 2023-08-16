<?php

Class iframe extends Conexion
{
	public function cons(){
        parent::_construct();
    }

	public function consultar ($id)
	{
		$consulta = $this->conexion_db->prepare("SELECT * FROM iframe WHERE usuario = '$id'");
          $consulta->execute();
           $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $consulta->closeCursor();
        $this->conexion_db = null;
         return $resultado;

	}
  public function insertar ($id)
    {
        $consulta = $this->conexion_db->prepare("INSERT INTO iframe VALUES(null, 'iFrame', '$id', 'NombreFrame')");
          $consulta->execute();
            $consulta->closeCursor();
        $this->conexion_db = null;

    }
  public function eliminar ($id)
    {
        $consulta = $this->conexion_db->prepare("DELETE FROM iframe WHERE ID = '$id'");
          $consulta->execute();
            $consulta->closeCursor();
        $this->conexion_db = null;

    }
}