<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_perfiles extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_perfiles');
    }


    public function cargar_plantilla($vista)
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_perfiles()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $vista = "periodico/View_perfiles";
        $this->cargar_plantilla($vista);
    }

    public function listar_perfiles()
    {

        $list = $this->Model_perfiles->lista_perfiles();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $estado = $person->estado;
            $xd = "";
            if ($estado == 'Activo') {
                $xd = "<i class='material-icons' style='color:green;'>done</i> Activo";
            } else {
                $xd = "<i class='material-icons' style='color:red;'>clear</i> Inactivo";
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $person->nombre;
            $row[] = $person->fecha_crea;
            $row[] = $xd;
            $row[] = "<center>            
            <b class='tool'>
              <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='notaBtnId' data-notaBtnId='" . $person->idperfiles . "'>description</i></b></button>
              <span class='tooltip-css3'>NOTA</span>
            </b>
            <b class='tool'>
              <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='btnComentario' data-btnComentario='" . $person->idperfiles . "'>comment</i></b></button>
              <span class='tooltip-css3'>COMENTARIOS</span>
            </b>
            <b class='tool'>
              <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='editBtnId' data-editBtnId='" . $person->idperfiles . "'>build</i></b></button>
              <span class='tooltip-css3'>EDITAR</span>
            </b>
            </center>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_perfiles->count_all(),
            "recordsFiltered" => $this->Model_perfiles->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function actualizar_crear_perfiles()
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
                    'tabla' => "EDICION",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;

                $img = '';
                if ($_FILES['url_foto']['name'] != '') {
                    $img = $this->upload_img($_FILES['url_foto']);
                } else {
                    $img = '';
                }

                $img2 = '';
                if ($_FILES['banner']['name'] != '') {
                    $img2 = $this->upload_img($_FILES['banner']);
                } else {
                    $img2 = '';
                }

                $table = 'perfiles';

                $data = array(
                    'nombre' => $_POST['nombre'],                
                    'cargo' => $_POST['cargo'],
                    'url_foto' => $img,
                    'banner' => $img2,
                    'fecha_crea' => $_POST['fecha_crea'],
                    'estado' => $_POST['estado'],
                    'info' => "",
                );
                $result = $this->Model_perfiles->crear_perfil($table, $data);
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
                    'tabla' => "EDICION",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;

                $img = '';
                if ($_FILES['url_foto']['name'] != '') {
                    $img = $this->upload_img($_FILES['url_foto']);
                } else {
                    $img = $_POST['url_hidden'];
                }

                $img2 = '';
                if ($_FILES['banner']['name'] != '') {
                    $img2 = $this->upload_img($_FILES['banner']);
                } else {
                    $img2 = $_POST['ban_hidden'];
                }

                $table = 'perfiles';
                $updateId = $_POST['updateId'];

                $data = array(
                    'nombre' => $_POST['nombre'],
                    'cargo' => $_POST['cargo'],
                    'url_foto' => $img,
                    'banner' => $img2,
                    'fecha_crea' => $_POST['fecha_crea'],
                    'estado' => $_POST['estado'],
                );
                $result = $this->Model_perfiles->actualizar_perfil($table, $data, $updateId);
                if ($result) {
                    echo 'update';
                }
            }
        }
        
        if (isset($_POST['actionNota'])) {
            if($_POST['actionNota'] == 'nota'){
                date_default_timezone_set('America/El_Salvador');
                $fecha_hora = date("Y-m-d H:i:s");
                $id_u = $_SESSION['idusuario'];
                $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $acciones = array(
                    'fecha_hora' => $fecha_hora,
                    'ip' => $ip,
                    'accion' => "INFO",
                    'tabla' => "PERFILES",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;
    
                $updateId = 'idperfiles ='.$_POST['updateIdNota'];
    
                $data = array(
                    'info' => $_POST['nota'],
                );
    
                $result = $this->Model_perfiles->actualizar_data('perfiles', $data, $updateId);
    
                if ($result) {
                    echo 'Updated';
                }
            }
        }
    }

    public function linea_actualizar()
    {
        if ($_POST['action'] == 'fetchSingleRow') {
            $output[] = '';
            $table = 'perfiles';
            $editBtnId = $_POST['editBtnId'];
            $result = $this->Model_perfiles->linea_actualizar($table, $editBtnId);
            foreach ($result as $value) {
                $output['nombre'] = $value->nombre;            
                $output['cargo'] = $value->cargo;
                $output['url_foto'] = $value->url_foto;
                $output['banner'] = $value->banner;
                $output['fecha_crea'] = $value->fecha_crea;
                $output['estado'] = $value->estado;
                $output['info'] = $value->info;
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
