<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_roles extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_roles');
        $this->load->model('Model_bitacora');
    }

    public function cargar_plantilla($vista,$data) {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_roles() {
        if (!isset($_SESSION['usuario']))
            redirect('Controller_home/index');
        $pantalla = $this->Model_roles->cbox_pantalla();
        $data["pantalla"] = $pantalla;
        $vista = "gestion_usuarios/roles";
        $this->cargar_plantilla($vista,$data);
    }

    public function linea_actualizar() {
        if ($_POST['action'] == 'fetchSingleRow') {
            $output[] = '';
            $table = 'gu_rol';
            $editBtnId = $_POST['editBtnId'];
            $result = $this->Model_roles->linea_actualizar($table, $editBtnId);
            foreach ($result as $value) {
                $output['rol'] = $value->rol;
                $output['id_permiso'] = $value->id_permiso;
            }
            echo json_encode($output);
        }
    }

    public function permisos() {
        if (!isset($_SESSION['usuario']))
            redirect('Controller_home/index');
        $output[] = '';
        $permisos = $_POST['permisos'];

        $head = $this->Usuarios->men($permisos);

        foreach ($head as $key => $value) {
            $output['xd2'] = $value->rol;
        }

        $id_rol = $this->input->post('permisos'); //capturamos el id del rol para despues comparar si este rol ya tiene asiganada alguna seleccion de menu    

        $menus = $this->Usuarios->list_menu();

        $table = "";

        $table .= "<table class='table table-hover'";
        foreach ($menus as $m) { //foreach principal para recorrer los menus
            $lista = $this->Usuarios->listar_opciones($m['id_menu']); //para devolver las opciones segun el id de menu

            $table .= "<tr><td colspan='3' style='color:green;font-weight:bold; !important'>MENU " . strtoupper($m['menu']) . "</td></tr>";

            foreach ($lista as $l) {//recorremos las opciones
                $d = rand(1, 1000);

                $id_opcion = $l['id_opcion'];

                $opcion = $this->Usuarios->comprobar_opcion($id_rol, $id_opcion); //comprobamos si ya la opcion la tiene asignada este menu

                if ($opcion) {
                    $table .= "<tr>
                        <td>" . $l['opcion'] . "</td>
                        <td>
                        <div class='switch'>
                                                <label>
                                                    <input type='checkbox' checked='checked' NAME='opt[]' value=" . $l['id_opcion'] . ">
                                                        <span class='lever switch-col-teal'>
                                                        </span>
                                                    </input>
                                                </label>
                                            </div>
                        </td>
                        </tr>";
                } else {
                    $table .= "<tr><td align='left'>" . $l['opcion'] . "
                                    </td>
                                    <td>

                                    <div class='switch'>
                                                <label>
                                                    <input  type='checkbox' NAME='opt[]' value=" . $l['id_opcion'] . ">
                                                        <span class='lever switch-col-pink'>
                                                        </span>
                                                    </input>
                                                </label>
                                            </div> 

                                    </td>
                        </tr>";
                }
            }
        }

        $output['xd'] = $table;

        echo json_encode($output);
    }

                                           

    public function actualizar_crear_rol() {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'create') {
                $table = 'gu_rol';

                $data = array(
                    'rol' => $_POST['rol'],
                    'id_permiso' => $_POST['id_permiso'],
                );
                $result = $this->Model_roles->crear_rol($table, $data);
                if ($result) {
                    echo 'created';
                }
            }

            if ($_POST['action'] == 'update') {
                $table = 'gu_rol';
                $updateId = $_POST['updateId'];

                $data = array(
                    'rol' => $_POST['rol'],
                    'id_permiso' => $_POST['id_permiso'],
                );
                $result = $this->Model_roles->actualizar_rol($table, $data, $updateId);
                if ($result) {
                    echo 'update';
                }
            }
        }
    }

    public function listar_rol() {
        $list = $this->Model_roles->lista_rol();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $person->rol;
            $row[] = "<td><button type='button' class='btn btn-xs btn-circle' id='permisos' data-permisos=" . $person->id_rol . "><i style='color:#73B5B6;' class='fa fa-plus-square'></i></button>";
            $row[] = "<center>
            <b class='tool'>
              <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='editBtnId' data-editBtnId='" . $person->id_rol . "'>build</i></b></button>
              <span class='tooltip-css3'>EDITAR</span>
            </b>
            <b class='tool'>
              <button id='delteBtnId' class='btn bg-blue-grey waves-effect btn-xs' data-delteBtnId='" . $person->id_rol . "'><b><i class='material-icons'>delete_forever</i></b></button>
              <span class='tooltip-css3' >ELIMINAR</span>
            </b>
            </center>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_roles->count_all(),
            "recordsFiltered" => $this->Model_roles->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);

    }

    public function eliminar_rol() {
        if ($_POST['action'] == 'delete') {
            $table = "gu_rol";
            $delteBtnId = $_POST['delteBtnId'];
            $result = $this->Model_roles->eliminar_rol($table, $delteBtnId);
            if ($result) {

                echo 'deleted';
            }
        }
    }

    public function guardar_asignacion_menu()
    {
        /* para validar si fue llamada ajax o no */
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $id_rol = $this->input->post('id_rol_asignar');
        $opciones_seleccionadas = $this->input->post('opt'); //recogemos las opciones que selecciono el administrador para dar los permisos
        //recorremos el array de los checbox seleccionados y convertimos a string separado por comas
        //en la consulta
        $opcion = "";
        for ($i = 0; $i < count($opciones_seleccionadas); $i++) {
            $opcion .= $opciones_seleccionadas[$i] . ",";
        }
        //quitamos la ultima coma del string
        $opciones = substr($opcion, 0, -1);
        $del_opciones_rol = $this->Usuarios->eliminar_opcion_xrol($id_rol); //eliminamos las opciones segun el rol para hacer de nuevo la asignacion de los permisos
        $asignar_menu = $this->Usuarios->asignar_menu($id_rol, $opciones);
    }

}
