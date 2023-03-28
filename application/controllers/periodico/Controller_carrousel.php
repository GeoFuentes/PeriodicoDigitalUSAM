<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_carrousel extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_carrousel');
    }

    public function cargar_plantilla($vista)
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_carrousel()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $vista = "periodico/View_carrousel";
        $this->cargar_plantilla($vista);
    }

    public function listar_carrousel()
    {

        $list = $this->Model_carrousel->lista_carrousel();
        $rol = $this->Usuarios->get_rolUser($_SESSION['idusuario']);
        $eliminar="";
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            if ($rol->id_rol == 1 || $rol->id_rol == 2) {
                $eliminar = "<b class='tool'>
                <button id='delteBtnId' class='btn bg-blue-grey waves-effect btn-xs' data-delteBtnId='" . $person->idcarrousel . "'><b><i class='material-icons'>delete_forever</i></b></button>
                <span class='tooltip-css3' >ELIMINAR</span>
              </b>";
            } 
            $estado = $person->estado;
            $xd = "";
            if ($estado == 'Activo') {
                $xd = "<i class='material-icons' style='color:green;'>done</i>";
            } else {
                $xd = "<i class='material-icons' style='color:red;'>cleat</i>";
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $person->titulo;
            // $row[] = base_url().'/assets/upload/carrousel/'.$person->foto;
            $row[] = '<img src="'.base_url().'assets/upload/carrousel/'.$person->foto.'" style="width:200px">';
            $row[] = $xd;
            $row[] = '<a href="'.$person->url.'" target="_blank">Ir A Ver</a>';
            $row[] = "<center>
            <b class='tool'>
              <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='editBtnId' data-editBtnId='" . $person->idcarrousel . "'>build</i></b></button>
              <span class='tooltip-css3'>EDITAR</span>
            </b>".$eliminar."</center>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_carrousel->count_all(),
            "recordsFiltered" => $this->Model_carrousel->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function actualizar_crear_carrousel()
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
                    'tabla' => "CARROUSEL",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;

                $img = '';
                if ($_FILES['foto']['name'] != '') {
                    $img = $this->upload_img($_FILES['foto']);
                } else {
                    $img = '';
                }

                $table = 'carrousel';

                $data = array(
                    'titulo' => $_POST['titulo'],
                    'foto' => $img,
                    'url' => $_POST['url'],
                    'estado' => $_POST['estado'],
                );
                $result = $this->Model_carrousel->crear_carrousel($table, $data);
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
                    'tabla' => "CARROUSEL",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;
                $img = '';

                if ($_FILES['foto']['name'] != '') {
                    $img = $this->upload_img($_FILES['foto']);
                } else if ($_POST['n_foto'] != '') {
                    $img = $_POST['n_foto'];
                }else{
                    $img = '';
                }

                $table = 'carrousel';
                $updateId = $_POST['updateId'];

                $data = array(
                    'titulo' => $_POST['titulo'],
                    'foto' => $img,
                    'url' => $_POST['url'],
                    'estado' => $_POST['estado'],
                );
                $result = $this->Model_carrousel->actualizar_carrousel($table, $data, $updateId);
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
            $table = 'carrousel';
            $editBtnId = $_POST['editBtnId'];
            $result = $this->Model_carrousel->linea_actualizar($table, $editBtnId);
            foreach ($result as $value) {
                $output['titulo'] = $value->titulo;
                $output['foto'] = $value->foto;
                $output['estado'] = $value->estado;
                $output['url'] = $value->url;
            }
            echo json_encode($output);
        }
    }

    public function eliminar_carrousel()
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
                'tabla' => "CARROUSEL",
                'nombre' => $_SESSION['nombre_completo'],
                'id_usuario' => $id_u,
            );
            $this->Model_bitacora->guardar_bitacora($acciones) == true;

            $table = "carrousel";
            $delteBtnId = $_POST['delteBtnId'];
            $result = $this->Model_carrousel->eliminar_carrousel($table, $delteBtnId);
            if ($result) {
                echo 'deleted';
            }
        }
    }

    public function upload_img($file)
    {
        $extention = explode('.', $file['name']);
        $newName = rand() . '.' . $extention[1];
        $destination = './assets/upload/carrousel/' . $newName;
        move_uploaded_file($file['tmp_name'], $destination);
        return $newName;
    }
}
