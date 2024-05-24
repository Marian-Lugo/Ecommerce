<?php
class UbicacionesModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }

    public function getUbicaciones($estado)
    {
        $sql = "SELECT u.*, m.descripcion as manzana, s.descripcion as sector FROM ubicaciones u 
                INNER JOIN manzanas m ON u.id_manzana = m.id_manzana 
                INNER JOIN sectores s ON u.id_sector = s.id_sector 
                WHERE u.estado = $estado";
        return $this->selectAll($sql);
    }
    
    public function getDatos($table)
    {
        $sql = "SELECT * FROM $table WHERE estado = 1";
        return $this->selectAll($sql);
    }

    public function registrar($id_manzana, $id_sector, $nombre_extinto, $descripcion, $estado)
    {
        $sql = "INSERT INTO ubicaciones (id_manzana, id_sector, nombre_extinto, descripcion, estado) VALUES (?,?,?,?,?)";
        $array = array($id_manzana, $id_sector, $nombre_extinto, $descripcion, $estado);
        return $this->insertar($sql, $array);
    }

    public function eliminar($idUbicacion)
    {
        $sql = "UPDATE ubicaciones SET estado = 0 WHERE id_ubicacion = ?";
        $array = array($idUbicacion);
        return $this->save($sql, $array);
    }

    public function getUbicacion($idUbicacion)
    {
        $sql = "SELECT * FROM ubicaciones WHERE id_ubicacion = $idUbicacion";
        return $this->select($sql);
    }


    public function buscarExtintoPorNombre($nombreExtinto)
    {
        $nombreExtinto = $this->db->real_escape_string($nombreExtinto);
        $sql = "SELECT * FROM ubicaciones WHERE nombre_extinto = '$nombreExtinto'";
        return $this->select($sql);
    }


    public function modificar($id_manzana, $id_sector, $nombre_extinto, $descripcion, $estado, $id_ubicacion)
    {
        $sql = "UPDATE ubicaciones SET id_manzana=?, id_sector=?, nombre_extinto=?, descripcion=?, estado=? WHERE id_ubicacion = ?";
        $array = array($id_manzana, $id_sector, $nombre_extinto, $descripcion, $estado, $id_ubicacion);
        return $this->save($sql, $array);
    }

}
 
?>
