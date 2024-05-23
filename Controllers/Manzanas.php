<?php
class Manzanas extends Controller
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
        $data['title'] = 'Manzanas';
        $this->views->getView('admin/manzanas', "index", $data);
    }
    public function listar()
    {
        $data = $this->model->getManzanas(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
            <button class="btn btn-primary" type="button" onclick="editManzana(' . $data[$i]['id_manzana'] . ')"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onclick="eliminarManzana(' . $data[$i]['id_manzana'] . ')"><i class="fas fa-trash"></i></button>
        </div>';
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {
        if (isset($_POST['descripcion'])) {
            $descripcion = strClean($_POST['descripcion']);
            $id = $_POST['id'];
            if (empty($descripcion)) {
                $respuesta = array('msg' => 'todos los campos son requeridos', 'icono' => 'warning');
            } else {
                if (empty($id)) {
                    $result = $this->model->verificarManzana($descripcion);
                    if (empty($result)) {
                        $data = $this->model->registrar($descripcion);
                        if ($data > 0) {
                            $respuesta = array('msg' => 'manzana registrada', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'error al registrar', 'icono' => 'error');
                        }
                    } else {
                        $respuesta = array('msg' => 'la manzana ya existe', 'icono' => 'warning');
                    }
                } else {
                    $data = $this->model->modificar($descripcion, $id);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'manzana modificada', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'error al modificar', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }
    //eliminar manzana
    public function delete($idManzana)
    {
        if (is_numeric($idManzana)) {
            $data = $this->model->eliminar($idManzana);
            if ($data == 1) {
                $respuesta = array('msg' => 'manzana dada de baja', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }
    //editar manzana
    public function edit($idManzana)
    {
        if (is_numeric($idManzana)) {
            $data = $this->model->getManzana($idManzana);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
?>
