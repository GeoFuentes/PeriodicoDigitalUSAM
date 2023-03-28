<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_menu');
    }

   
    public function cargar_plantilla($vista, $data = '')
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_menu()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $roles = $this->Usuarios->obtener_roles();
        $data['roles'] = $roles;
        $vista = "menu/View_menu";
        $this->cargar_plantilla($vista, $data);
    }

    public function vista_orden()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $a = $this->Model_menu->traer_menu();
        $roles = $this->Usuarios->obtener_roles();
        $data['roles'] = $roles;
        $data['a'] = $a;
        $vista = "menu/View_orden";
        $this->cargar_plantilla($vista, $data);
    }



    public function linea_actualizar() {
        if ($_POST['action'] == 'fetchSingleRow') {
            $output[] = '';
            $table = 'gu_menu';
            $editBtnId = $_POST['editBtnId'];
            $result = $this->Usuarios->linea_actualizar($table, $editBtnId);
            foreach ($result as $value) {
                $output['menu'] = $value->menu;
                $output['icono'] = $value->icono;
            }
            echo json_encode($output);
        }
    }

    public function actualizar_crear_menu() {
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
                    'tabla' => "MENU",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;


                $table = 'gu_menu';

                $data = array(
                    'menu' => $_POST['menu'],
                    'icono' => $_POST['icono'],
                );
                $result = $this->Usuarios->crear_menum($table, $data);
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
                    'tabla' => "MENU",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;
                $table = 'gu_menu';
                $updateId = $_POST['updateId'];

                $data = array(
                    'menu' => $_POST['menu'],
                    'icono' => $_POST['icono'],
                );
                $result = $this->Usuarios->actualizar_menum($table, $data, $updateId);
                if ($result) {
                    echo 'update';
                }
            }
        }
    }

    public function lista_menu()
    {
        $list = $this->Model_menu->lista_menu();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $person->menu;
            $row[] = $person->icono;
            $row[] = "<center>
            <b class='tool'>
              <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='editBtnId' data-editBtnId='" . $person->id_menu . "'>build</i></b></button>
              <span class='tooltip-css3'>EDITAR</span>
            </b>
            <b class='tool'>
              <button id='delteBtnId' class='btn bg-blue-grey waves-effect btn-xs' data-delteBtnId='" . $person->id_menu . "'><b><i class='material-icons'>delete_forever</i></b></button>
              <span class='tooltip-css3' >ELIMINAR</span>
            </b>
            </center>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_menu->count_all(),
            "recordsFiltered" => $this->Model_menu->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function eliminar_menu() {
        if ($_POST['action'] == 'delete') {
            date_default_timezone_set('America/El_Salvador');
            $fecha_hora = date("Y-m-d H:i:s");
            $id_u = $_SESSION['idusuario'];
            $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $acciones = array(
                'fecha_hora' => $fecha_hora,
                'ip' => $ip,
                'accion' => "ELIMINAR",
                'tabla' => "MENU",
                'nombre' => $_SESSION['nombre_completo'],
                'id_usuario' => $id_u,
            );
            $this->Model_bitacora->guardar_bitacora($acciones) == true;
            $table = "gu_menu";
            $delteBtnId = $_POST['delteBtnId'];
            $result = $this->Usuarios->eliminar_menum($table, $delteBtnId);
            if ($result) {

                echo 'deleted';
            }
        }
    }



    public function save_orden_menu() {
        $list = $_POST['list'];
        $c = count($list);
        $s = "";
        $k = 0;
        $o = array();
        for ($i=0; $i < $c; $i++) { 
            $k++;
            $o[$i] = array(
                'orden' => $k,
                'id_menu' =>$list[$i]['item']
            );
        }
        $d = $this->Model_menu->save_orden_menu($o);
        if ($d) {
            echo "exito";
        }
    }
    
}

