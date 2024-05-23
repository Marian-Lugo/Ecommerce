<?php
class SectoresModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getSectores($estado)
    {
        $sql = "SELECT s.*, m.descripcion as manzana_descripcion FROM sectores s INNER JOIN manzanas m ON s.id_manzana = m.id_manzana WHERE s.estado = $estado";
        return $this->selectAll($sql);
    }
    
    public function getDatos($table)
    {
        $sql = "SELECT * FROM $table WHERE estado = 1";
        return $this->selectAll($sql);
    }

    public function registrar($id_manzana, $descripcion)
    {
        $sql = "INSERT INTO sectores (id_manzana, descripcion) VALUES (?, ?)";
        $array = array($id_manzana, $descripcion);
        return $this->insertar($sql, $array);
    }

    public function eliminar($idSector)
    {
        $sql = "UPDATE sectores SET estado = ? WHERE id_sector = ?";
        $array = array(0, $idSector);
        return $this->save($sql, $array);
    }

    public function getSector($idSector)
    {
        $sql = "SELECT * FROM sectores WHERE id_sector = $idSector";
        return $this->select($sql);
    }

    public function modificar($id_manzana, $descripcion, $id_sector)
    {
        $sql = "UPDATE sectores SET id_manzana = ?, descripcion = ? WHERE id_sector = ?";
        $array = array($id_manzana, $descripcion, $id_sector);
        return $this->save($sql, $array);
    }
}
?>
