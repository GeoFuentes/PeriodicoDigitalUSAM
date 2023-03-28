<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_edicion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_edicion');
    }
 
   
    public function cargar_plantilla($vista)
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_edicion()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $vista = "periodico/View_ediciones";
        $this->cargar_plantilla($vista);
    }

    public function listar_edicion() {

        $list = $this->Model_edicion->lista_edicion();
        $rol = $this->Usuarios->get_rolUser($_SESSION['idusuario']);
        $eliminar="";
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            if ($rol->id_rol == 1 || $rol->id_rol == 2) {
                $eliminar = "<b class='tool'>
                <button id='delteBtnId' class='btn bg-blue-grey waves-effect btn-xs' data-delteBtnId='" . $person->id_edicion . "'><b><i class='material-icons'>delete_forever</i></b></button>
                <span class='tooltip-css3' >ELIMINAR</span>
              </b>";
            } 
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = "Edicion N° - ".$person->num_edicion;
            $row[] = $person->fecha_publicacion;
            $row[] = $person->estado;
            $row[] = "<center>
            <b class='tool'>
              <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='editBtnId' data-editBtnId='" . $person->id_edicion . "'>build</i></b></button>
              <span class='tooltip-css3'>EDITAR</span>
            </b>".$eliminar."</center>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_edicion->count_all(),
            "recordsFiltered" => $this->Model_edicion->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function actualizar_crear_edicion() {
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


                $table = 'edicion';

                $data = array(
                    'fecha_publicacion' => $_POST['fecha'],
                    'num_edicion' => $_POST['edicion'],
                    'estado' => $_POST['estado'],
                );
                $result = $this->Model_edicion->crear_edicion($table, $data);
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

                $table = 'edicion';
                $updateId = $_POST['updateId'];

                $data = array(
                    'fecha_publicacion' => $_POST['fecha'],
                    'num_edicion' => $_POST['edicion'],
                    'estado' => $_POST['estado'],
                );
                $result = $this->Model_edicion->actualizar_edicion($table, $data, $updateId);
                if ($result) {
                    echo 'update';
                }
            }
        }
    }

    public function eliminar_edicion() {
        if ($_POST['action'] == 'delete') {

            date_default_timezone_set('America/El_Salvador');
            $fecha_hora = date("Y-m-d H:i:s");
            $id_u = $_SESSION['idusuario'];
            $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $acciones = array(
                'fecha_hora' => $fecha_hora,
                'ip' => $ip,
                'accion' => "ELIMINAR",
                'tabla' => "EDICION",
                'nombre' => $_SESSION['nombre_completo'],
                'id_usuario' => $id_u,
            );
            $this->Model_bitacora->guardar_bitacora($acciones) == true;

            $table = "edicion";
            $delteBtnId = $_POST['delteBtnId'];
            $result = $this->Model_edicion->eliminar_edicion($table, $delteBtnId);
            if ($result) {
                echo 'deleted';
            }
        }
    }

    public function linea_actualizar() {
        if ($_POST['action'] == 'fetchSingleRow') {
            $output[] = '';
            $table = 'edicion';
            $editBtnId = $_POST['editBtnId'];
            $result = $this->Model_edicion->linea_actualizar($table, $editBtnId);
            foreach ($result as $value) {
                $output['fecha_publicacion'] = $value->fecha_publicacion;
                $output['num_edicion'] = $value->num_edicion;
                $output['estado'] = $value->estado;
            }
            echo json_encode($output);
        }
    }
}