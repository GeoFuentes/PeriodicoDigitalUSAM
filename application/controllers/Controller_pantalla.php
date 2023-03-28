<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Controller_pantalla extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_pantalla');
    }

    public function cargar_plantilla($vista, $data = '')
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_pantalla()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $roles = $this->Usuarios->obtener_roles();
        $data['roles'] = $roles;
        $vista = "menu/View_pantalla";
        $this->cargar_plantilla($vista, $data);
    }

    public function lista_pantalla()
    {
        $list = $this->Model_pantalla->lista_pantalla();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $person->url_permiso;
            $row[] = $person->nombre_permiso;
            $row[] = "<center>
            <b class='tool'>
              <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='editar' data-permiso='" . $person->id_permiso . "'>build</i></b></button>
              <span class='tooltip-css3'>EDITAR</span>
            </b>
            <b class='tool'>
              <button id='eliminar' class='btn bg-blue-grey waves-effect btn-xs' data-permiso='" . $person->id_permiso . "'><b><i class='material-icons'>delete_forever</i></b></button>
              <span class='tooltip-css3' >ELIMINAR</span>
            </b>
            </center>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_pantalla->count_all(),
            "recordsFiltered" => $this->Model_pantalla->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function linea_pantalla(){
        $id = $_POST['id_pantalla'];
        $data[] = "";
        $e = $this->Model_pantalla->linea_pantalla($id);

        foreach ($e as $key => $value) {
            $data['id_permiso'] = $value->id_permiso;
            $data['url_permiso'] = $value->url_permiso;
            $data['nombre_permiso'] = $value->nombre_permiso;
        }

        echo json_encode($data);
    }


   public function insert_update_pantalla()
    {
        $action = $this->input->post("action");
        $id_pantalla = $this->input->post("updateId");

        if ($action == 'crear') {
            $data = array(
                'url_permiso' => $_POST['url_permiso'],
                'nombre_permiso' => $_POST['nombre_permiso'],
            );

            $x = $this->Model_pantalla->insert_pantalla($data);

            if ($x) {
                echo "insert";
            }

        } else if ($action == 'actualizar') {
            $data = array(
                'url_permiso' => $_POST['url_permiso'],
                'nombre_permiso' => $_POST['nombre_permiso'],
            );
            $x = $this->Model_pantalla->update_pantalla($data, $id_pantalla);

            if ($x) {
                echo "update";
            }
        }
    }

    public function eliminar_pantalla()
    {
        $id = $this->input->post("id");
        $x = $this->Model_pantalla->eliminar_pantalla($id);
        if ($x) {
                echo "deleted";
            }
    }
}
