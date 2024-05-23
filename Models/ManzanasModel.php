<?php
class ManzanasModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getManzanas($estado)
    {
        $sql = "SELECT * FROM manzanas WHERE estado = $estado";
        return $this->selectAll($sql);
    }

    public function registrar($descripcion)
    {
        $sql = "INSERT INTO manzanas (descripcion, estado) VALUES (?, 1)";
        $array = array($descripcion);
        return $this->insertar($sql, $array);
    }

    public function verificarManzana($descripcion)
    {
        $sql = "SELECT descripcion FROM manzanas WHERE descripcion = '$descripcion' AND estado = 1";
        return $this->select($sql);
    }

    public function eliminar($idManzana)
    {
        $sql = "UPDATE manzanas SET estado = ? WHERE id_manzana = ?";
        $array = array(0, $idManzana);
        return $this->save($sql, $array);
    }

    public function getManzana($idManzana)
    {
        $sql = "SELECT * FROM manzanas WHERE id_manzana = $idManzana";
        return $this->select($sql);
    }

    public function modificar($descripcion, $id)
    {
        $sql = "UPDATE manzanas SET descripcion=? WHERE id_manzana = ?";
        $array = array($descripcion, $id);
        return $this->save($sql, $array);
    }
}
?>
