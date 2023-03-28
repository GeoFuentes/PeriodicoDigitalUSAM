<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_comentario  extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_comentario');
        $this->load->model('Model_perfiles');
    }

    public function listar_comentarios() {
        if($_POST['action'] == 'get'){
            $perfilId = $_POST['perfilId'];
            $data = array(
                "comen" => $this->Model_comentario->listar_comentarios($perfilId)
            );
            echo json_encode($data);
        }
    }

    public function actualizar_crear_comentario()
    {
        if (isset($_POST['actionComen'])) {
            if ($_POST['actionComen'] == 'create') {

                date_default_timezone_set('America/El_Salvador');
                $fecha_hora = date("Y-m-d H:i:s");
                $id_u = $_SESSION['idusuario'];
                $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $acciones = array(
                    'fecha_hora' => $fecha_hora,
                    'ip' => $ip,
                    'accion' => "CREAR",
                    'tabla' => "EDICION",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;

                $img = '';
                if ($_FILES['foto_comen']['name'] != '') {
                    $img = $this->upload_img($_FILES['foto_comen']);
                } else {
                    $img = '';
                }

                $table = 'comentario';

                $data = array(                    
                    'nombre' => $_POST['nombreComen'],
                    'comentario' => $_POST['comentario'],
                    'titulo' => $_POST['titulo'],
                    'estado' => $_POST['estado'],
                    'foto_comen' => $img,                
                    'idperfiles' => $_POST['idperfiles'],                    
                );
                $result = $this->Model_comentario->crear_comentario($table, $data);
                if ($result) {
                    echo 'created';
                }
            }

            if ($_POST['actionComen'] == 'update') {

                date_default_timezone_set('America/El_Salvador');
                $fecha_hora = date("Y-m-d H:i:s");
                $id_u = $_SESSION['idusuario'];
                $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $acciones = array(
                    'fecha_hora' => $fecha_hora,
                    'ip' => $ip,
                    'accion' => "ACTUALIZAR",
                    'tabla' => "EDICION",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;

                $img = '';
                if ($_FILES['foto_comen']['name'] != '') {
                    $img = $this->upload_img($_FILES['foto_comen']);
                } else {
                    $img = $_POST['com_hidden'];
                }

                $table = 'comentario';
                $updateId = $_POST['updateIdComen'];

                $data = array(                    
                    'nombre' => $_POST['nombreComen'],
                    'comentario' => $_POST['comentario'],
                    'titulo' => $_POST['titulo'],
                    'estado' => $_POST['estado_comen'],
                    'foto_comen' => $img, 
                    'idperfiles' => $_POST['idperfiles'],
                );
                $result = $this->Model_comentario->actualizar_comentario($table, $data, $updateId);
                if ($result) {
                    echo 'update';
                }
            }
        }
    }

    public function linea_actualizar()
    {
        if ($_POST['action'] == 'fetchSingleRow') {
            $output[] = '';
            $table = 'comentario';
            $editBtnId = $_POST['btnEditComen'];
            $result = $this->Model_comentario->linea_actualizar($table, $editBtnId);
            foreach ($result as $value) {
                $output['idperfiles'] = $value->idperfiles;
                $output['nombre'] = $value->nombre;
                $output['comentario'] = $value->comentario;
                $output['titulo'] = $value->titulo;
                $output['estado'] = $value->estado;
                $output['foto_comen'] = $value->foto_comen;
                $output['idComentario'] = $value->idComentario;
            }
            echo json_encode($output);
        }
    }

    public function upload_img($file)
    {
        $extention = explode('.', $file['name']);
        $newName = rand() . '.' . $extention[1];
        $destination = './assets/upload/perfiles/' . $newName;
        move_uploaded_file($file['tmp_name'], $destination);
        return $newName;
    }
    
}