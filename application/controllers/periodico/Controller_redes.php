<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_redes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_redes');
    }

    public function cargar_plantilla($vista)
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_redes()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $vista = "periodico/View_redes";
        $this->cargar_plantilla($vista);
    }

    public function listar_redes()
    {

        $list = $this->Model_redes->lista_redes();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $estado = $person->estado;
            $xd = "";
            if ($estado == 'Activo') {
                $xd = "<i class='material-icons' style='color:green;'>done</i>";
            } else {
                $xd = "<i class='material-icons' style='color:red;'>clear</i>";
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $person->red_social;
            $row[] = '<a href="'.$person->url.'" target="_blank">Ir A Ver</a>';
            $row[] = "<i  class='".$person->icono."'></i>  ".$person->icono."";
            $row[] = $person->entidad;
            $row[] = $xd;
            $row[] = "<center>
            <b class='tool'>
              <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='editBtnId' data-editBtnId='" . $person->id_redes . "'>build</i></b></button>
              <span class='tooltip-css3'>EDITAR</span>
            </b>
            <b class='tool'>
              <button id='delteBtnId' class='btn bg-blue-grey waves-effect btn-xs' data-delteBtnId='" . $person->id_redes . "'><b><i class='material-icons'>delete_forever</i></b></button>
              <span class='tooltip-css3' >ELIMINAR</span>
            </b>            
            </center>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_redes->count_all(),
            "recordsFiltered" => $this->Model_redes->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function actualizar_crear_redes()
    {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'create') {

                date_default_timezone_set('America/El_Salvador');
                $fecha_hora = date("Y-m-d H:i:s");
                $id_u = $_SESSION['idusuario'];
                $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $acciones = array(
                    'fecha_hora' => $fecha_hora,
                    'ip' => $ip,
                    'accion' => "CREAR",
                    'tabla' => "REDES",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;

                

                $table = 'redes';

                $data = array(
                    'red_social' => $_POST['red_social'],
                    'url' => $_POST['url'],
                    'icono' => $_POST['icono'],
                    'entidad' => $_POST['entidad'],
                    'estado' => $_POST['estado'],
                );
                $result = $this->Model_redes->crear_redes($table, $data);
                if ($result) {
                    echo 'created';
                }
            }

            if ($_POST['action'] == 'update') {

                date_default_timezone_set('America/El_Salvador');
                $fecha_hora = date("Y-m-d H:i:s");
                $id_u = $_SESSION['idusuario'];
                $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $acciones = array(
                    'fecha_hora' => $fecha_hora,
                    'ip' => $ip,
                    'accion' => "ACTUALIZAR",
                    'tabla' => "REDES",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;
               

                $table = 'redes';
                $updateId = $_POST['updateId'];

                $data = array(
                    'red_social' => $_POST['red_social'],
                    'url' => $_POST['url'],
                    'icono' => $_POST['icono'],
                    'entidad' => $_POST['entidad'],
                    'estado' => $_POST['estado'],
                );
                $result = $this->Model_redes->actualizar_redes($table, $data, $updateId);
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
            $table = 'redes';
            $editBtnId = $_POST['editBtnId'];
            $result = $this->Model_redes->linea_actualizar($table, $editBtnId);
            foreach ($result as $value) {
                $output['red_social'] = $value->red_social;
                $output['url'] = $value->url;
                $output['icono'] = $value->icono;
                $output['entidad'] = $value->entidad;
                $output['estado'] = $value->estado;
            }
            echo json_encode($output);
        }
    }

    public function eliminar_redes()
    {
        if ($_POST['action'] == 'delete') {

            date_default_timezone_set('America/El_Salvador');
            $fecha_hora = date("Y-m-d H:i:s");
            $id_u = $_SESSION['idusuario'];
            $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $acciones = array(
                'fecha_hora' => $fecha_hora,
                'ip' => $ip,
                'accion' => "ELIMINAR",
                'tabla' => "REDES",
                'nombre' => $_SESSION['nombre_completo'],
                'id_usuario' => $id_u,
            );
            $this->Model_bitacora->guardar_bitacora($acciones) == true;

            $table = "redes";
            $delteBtnId = $_POST['delteBtnId'];
            $result = $this->Model_redes->eliminar_redes($table, $delteBtnId);
            if ($result) {
                echo 'deleted';
            }
        }
    }

    public function upload_img($file)
    {
        $extention = explode('.', $file['name']);
        $newName = rand() . '.' . $extention[1];
        $destination = './assets/upload/redes/' . $newName;
        move_uploaded_file($file['tmp_name'], $destination);
        return $newName;
    }
}