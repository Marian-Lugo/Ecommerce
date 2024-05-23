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

            $data = $this->model->registrar($id_manzana, $id_sector, $nombre_extinto, $descripcion, 1);
            if ($data > 0) {
                $respuesta = array('msg' => 'ubicación registrada', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'error al registrar', 'icono' => 'error');
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
}
?>
