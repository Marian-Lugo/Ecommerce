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
        $data['title'] = 'manzanas';
        $this->views->getView('admin/manzanas', "index", $data);
    }
    public function listar()
    {
        $data = $this->model->getManzanas(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
            <button class="btn btn-primary" type="button" onclick="editarManzana(' . $data[$i]['id_manzana'] . ')"><i class="fas fa-edit"></i></button>
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
            $id = $_POST['id_manzana'];
           
            if (empty($_POST['descripcion'])) {
                $respuesta = array('msg' => 'todos los campos son requeridos', 'icono' => 'warning');
            } else {
                ##### VERIFICAR IMG ACTUAL #####
                /* $destino = null;
                if (!empty($imagen['name'])) {
                    $fecha = date('YmdHis');
                    $destino = $fecha . '.jpg';
                } else if (!empty($fotoActual) && empty($imagen['name'])) {
                    $destino = $fotoActual;
                } */
                if (empty($id)) {
                    /* if (empty($imagen['name'])) {
                        $respuesta = array('msg' => 'seleccionar una imagen', 'icono' => 'error');
                    } else { */
                        $result = $this->model->verificarManzana($descripcion);
                        if (empty($result)) {
                            $data = $this->model->registrar($descripcion,);
                            if ($data > 0) {
                                /* $destino = 'public/img/categorias/' . $nombreImg . '.jpg';
                                move_uploaded_file($tmp_name, $destino); */
                                $respuesta = array('msg' => 'manzana registrada', 'icono' => 'success');
                            } else {
                                $respuesta = array('msg' => 'error al registrar', 'icono' => 'error');
                            }
                        } else {
                            $respuesta = array('msg' => 'la manzana ya existe', 'icono' => 'warning');
                        }
                    // }
                } else {
                   /*  if (empty($destino)) {
                        $respuesta = array('msg' => 'seleccionar una imagen', 'icono' => 'error');
                    } else { */
                        ##temporal
                        $temp = $this->model->getManzana($id);
                        $data = $this->model->modificar($descripcion, $id);
                        if ($data == 1) {
                            /* if (!empty($imagen['name'])) {
                                if (file_exists('public/img/categorias/' . $temp['imagen'])) {
                                    unlink('public/img/categorias/' . $temp['imagen']);
                                }
                                $destino = 'public/img/categorias/' . $nombreImg . '.jpg';
                                move_uploaded_file($tmp_name, $destino);
                            } */
                            $respuesta = array('msg' => 'manzana modificado', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'error al modificar', 'icono' => 'error');
                        }
                    // }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }
    
    public function delete($idManzana)
    {
        if (is_numeric($idManzana)) {
            $data = $this->model->eliminar($idManzana);
            if ($data == 1) {
                $respuesta = array('msg' => 'Manzana dada de baja', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }

    public function edit($idManzana)
    {
        if (is_numeric($idManzana)) {
            $data = $this->model->getManzana($idManzana);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
