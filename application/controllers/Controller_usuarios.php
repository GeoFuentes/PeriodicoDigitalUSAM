<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
    }

    public function cargar_plantilla($vista, $data = '') {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_usuario() {
        if (!isset($_SESSION['usuario']))
            redirect('Controller_home/index');
        $roles = $this->Usuarios->obtener_roles();
        $data['roles'] = $roles;
        $vista = "menu/View_usuarios";
        $this->cargar_plantilla($vista, $data);
    }

    public function linea_actualizar() {
        if ($_POST['action'] == 'fetchSingleRow') {
            $output[] = '';
            $table = 'usuarios';
            $editBtnId = $_POST['editBtnId'];
            $result = $this->Usuarios->linea_actualizar_user($table, $editBtnId);
            foreach ($result as $value) {
                $output['nombre'] = $value->nombre;
                $output['clave'] = $value->clave;
                $output['id_rol'] = $value->id_rol;
                $output['nombre_completo'] = $value->nombre_completo;
                $output['estado'] = $value->estado;
            }
            echo json_encode($output);
        }
    }

    public function actualizar_crear_usuario() {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'create') {
                $table = 'usuarios';

                $pwd = strtoupper($_POST['clave']);

                $nu = count($this->db->get("usuarios")->result());
                $ne = 5;
                $id = $nu.$ne.$nu;

                $data = array(
                    'id_usuario' => $id,
                    'nombre' => $_POST['nombre'],
                    'clave' => md5($pwd),
                    'id_rol' => $_POST['id_rol'],
                    'nombre_completo' => $_POST['nombre_completo'],
                    'estado' => $_POST['estado'],
                );
                $result = $this->Usuarios->crear_user($table, $data);
                if ($result) {
                    echo 'created';
                    $string = "INSERT INTO tbl_tema(id_usuario)value($id)";
                    $this->db->query($string);
                }
            }

            if ($_POST['action'] == 'update') {
                $table = 'usuarios';
                $updateId = $_POST['updateId'];
                $pwd = strtoupper($_POST['clave']);

                if ($pwd == '') {
                    $data = array(
                        'nombre' => $_POST['nombre'],
                        'id_rol' => $_POST['id_rol'],
                        'nombre_completo' => $_POST['nombre_completo'],
                        'estado' => $_POST['estado'],
                    );
                } else {
                    $data = array(
                        'nombre' => $_POST['nombre'],
                        'clave' => md5($pwd),
                        'id_rol' => $_POST['id_rol'],
                        'nombre_completo' => $_POST['nombre_completo'],
                        'estado' => $_POST['estado'],
                    );
                }

                $result = $this->Usuarios->actualizar_user($table, $data, $updateId);
                if ($result) {
                    echo 'update';
                }
            }
        }
    }

    public function listar_usuario() {

        $list = $this->Usuarios->lista_usuario();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $person->nombre;
            $row[] = $person->nombre_completo;
            $row[] = "<center>
            <b class='tool'>
              <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='editBtnId' data-editBtnId='" . $person->id_usuario . "'>build</i></b></button>
              <span class='tooltip-css3'>EDITAR</span>
            </b>
            <b class='tool'>
              <button id='delteBtnId' class='btn bg-blue-grey waves-effect btn-xs' data-delteBtnId='" . $person->id_usuario . "'><b><i class='material-icons'>delete_forever</i></b></button>
              <span class='tooltip-css3' >ELIMINAR</span>
            </b>
            </center>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Usuarios->count_all(),
            "recordsFiltered" => $this->Usuarios->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function eliminar_usuario() {
        if ($_POST['action'] == 'delete') {
            $table = "usuarios";
            $delteBtnId = $_POST['delteBtnId'];
            $result = $this->Usuarios->eliminar_user($table, $delteBtnId);
            if ($result) {

                echo 'deleted';
            }
        }
    }

}
