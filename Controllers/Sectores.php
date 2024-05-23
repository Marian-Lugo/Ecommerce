<?php
class Sectores extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['tipo']) || $_SESSION['tipo'] == 2) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'sectores';
        $data['manzanas'] = $this->model->getDatos('manzanas');
        $this->views->getView('admin/sectores', "index", $data);
    }

    public function listar()
    {
        $data = $this->model->getSectores(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '
            <a class="btn btn-info" href="#" onclick="editSector(' . $data[$i]['id_sector'] . ')"><i class="fas fa-edit"></i> Editar</a>
            <a class="btn btn-danger" href="#" onclick="eliminarSector(' . $data[$i]['id_sector'] . ')"><i class="fas fa-trash"></i> Eliminar</a>';
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {
        if (isset($_POST['descripcion']) && isset($_POST['id_manzana'])) {
            $id_manzana = $_POST['id_manzana'];
            $descripcion = $_POST['descripcion'];
            $id = $_POST['id'];

            if (empty($descripcion) || empty($id_manzana)) {
                $respuesta = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
            } else {
                if (empty($id)) {
                    // Registrar nuevo sector
                    $data = $this->model->registrar($id_manzana, $descripcion);
                    if ($data > 0) {
                        $respuesta = array('msg' => 'Sector registrado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al registrar', 'icono' => 'error');
                    }
                } else {
                    // Modificar sector existente
                    $data = $this->model->modificar($id_manzana, $descripcion, $id);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Sector modificado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al modificar', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }

    // Eliminar sector
    public function delete($idSector)
    {
        if (is_numeric($idSector)) {
            $data = $this->model->eliminar($idSector);
            if ($data == 1) {
                $respuesta = array('msg' => 'Sector dado de baja', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }

    // Editar sector
    public function edit($idSector)
    {
        if (is_numeric($idSector)) {
            $data = $this->model->getSector($idSector);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
?>
