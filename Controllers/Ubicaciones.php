<?php
class Ubicaciones extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['tipo']) || $_SESSION['tipo'] == 2) {
            header('Location: '. BASE_URL . 'admin');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'ubicaciones';
        $data['manzanas'] = $this->model->getDatos('manzanas');
        $data['sectores'] = $this->model->getDatos('sectores');
        $this->views->getView('admin/ubicaciones', "index", $data);
    }
    
   /*  public function listar()
    {
        $data = $this->model->getUbicaciones(1);
        echo json_encode($data);
        die();
    } */

    public function listar()
    {
        $data = $this->model->getUbicaciones(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '
            <a class="btn btn-info" href="#" onclick="editUbicacion(' . $data[$i]['id_ubicacion'] . ')"><i class="fas fa-edit"></i> Editar</a>
            <a class="btn btn-danger" href="#" onclick="eliminarUbicacion(' . $data[$i]['id_ubicacion'] . ')"><i class="fas fa-trash"></i> Eliminar</a>';
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
{
    if (isset($_POST['id_manzana']) && isset($_POST['id_sector']) && isset($_POST['nombre_extinto']) && isset($_POST['descripcion'])) {
        $id_manzana = $_POST['id_manzana'];
        $id_sector = $_POST['id_sector'];
        $nombre_extinto = $_POST['nombre_extinto'];
        $descripcion = $_POST['descripcion'];

        if (empty($_POST['id'])) { 
            // Registrar nueva ubicación
            $data = $this->model->registrar($id_manzana, $id_sector, $nombre_extinto, $descripcion, 1);
            if ($data > 0) {
                $respuesta = array('msg' => 'Ubicación registrada', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
            }
        } else {
            // Modificar ubicación existente
            $id_ubicacion = $_POST['id'];
            $data = $this->model->modificar($id_manzana, $id_sector, $nombre_extinto, $descripcion, 1, $id_ubicacion);
            if ($data == 1) {
                $respuesta = array('msg' => 'Ubicación modificada', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al modificar', 'icono' => 'error');
            }
        }
        echo json_encode($respuesta);
    }
    die();
}


    public function delete($idUbicacion)
    {
        if (is_numeric($idUbicacion)) {
            $data = $this->model->eliminar($idUbicacion);
            if ($data == 1) {
                $respuesta = array('msg' => 'ubicación eliminada', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }

    public function edit($idUbicacion)
    {
        if (is_numeric($idUbicacion)) {
            $data = $this->model->getUbicacion($idUbicacion);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function ubicacionPorNombre($nombreExtinto)
    {
        // Verificar que el nombre no esté vacío
        if (!empty($nombreExtinto)) {
            $data = $this->model->buscarExtintoPorNombre($nombreExtinto);
            echo json_encode($data);
        } else {
            echo json_encode(array('error' => 'El nombre del extinto está vacío.'));
        }
        die();
    }

}
?>
