<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_categoria');
    }

   
    public function cargar_plantilla($vista, $data)
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_categoria()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $categoriass = $this->Model_categoria->obtener_categorias();
        $data['categorias'] = $categoriass;
        $vista = "periodico/View_categorias";
        $this->cargar_plantilla($vista,$data);
    }

    public function listar_categoria() {

        $list = $this->Model_categoria->lista_categoria();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $person->nc_noticia;
            $row[] = "<i  class='".$person->nc_icono."'></i>  ".$person->nc_icono.""; 
            $row[] = "<center>
            <b class='tool'>
              <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='editBtnId' data-editBtnId='" . $person->id_cat_noticia . "'>build</i></b></button>
              <span class='tooltip-css3'>EDITAR</span>
            </b>
            <b class='tool'>
              <button id='delteBtnId' class='btn bg-blue-grey waves-effect btn-xs' data-delteBtnId='" . $person->id_cat_noticia . "'><b><i class='material-icons'>delete_forever</i></b></button>
              <span class='tooltip-css3' >ELIMINAR</span>
            </b>
            </center>";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_categoria->count_all(),
            "recordsFiltered" => $this->Model_categoria->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function actualizar_crear_categoria() {
        
        if (isset($_POST['action'])) 
        {
            $nc_ct = null;
            if($_POST['cat_s'] != "NULL"){
                $nc_ct = $_POST['cat_s'];
            }

            if ($_POST['action'] == 'create') {

                date_default_timezone_set('America/El_Salvador');
                $fecha_hora = date("Y-m-d H:i:s");
                $id_u = $_SESSION['idusuario'];
                $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $acciones = array(
                    'fecha_hora' => $fecha_hora,
                    'ip' => $ip,
                    'accion' => "CREAR",
                    'tabla' => "CATEGORIA",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;

                $table = 'cat_noticia';
                
                $data = array(
                    'nc_noticia' => $_POST['categoria'],
                    'nc_icono' => $_POST['icono'],
                    'nc_categoria' => $nc_ct,
                    'nc_url' => $_POST['url'],
                );
                $result = $this->Model_categoria->crear_categoria($table, $data);
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
                    'tabla' => "CATEGORIA",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;

                $table = 'cat_noticia';
                $updateId = $_POST['updateId'];

                $data = array(
                    'nc_noticia' => $_POST['categoria'],
                    'nc_icono' => $_POST['icono'],
                    'nc_categoria' => $nc_ct,
                    'nc_url' => $_POST['url'],
                );
                $result = $this->Model_categoria->actualizar_categoria($table, $data, $updateId);
                if ($result) {
                    echo 'update';
                }
            }
        }
    }

    public function eliminar_categoria() {
        if ($_POST['action'] == 'delete') {

            date_default_timezone_set('America/El_Salvador');
            $fecha_hora = date("Y-m-d H:i:s");
            $id_u = $_SESSION['idusuario'];
            $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $acciones = array(
                'fecha_hora' => $fecha_hora,
                'ip' => $ip,
                'accion' => "ELIMINAR",
                'tabla' => "CATEGORIA",
                'nombre' => $_SESSION['nombre_completo'],
                'id_usuario' => $id_u,
            );
            $this->Model_bitacora->guardar_bitacora($acciones) == true;

            $table = "cat_noticia";
            $delteBtnId = $_POST['delteBtnId'];
            $result = $this->Model_categoria->eliminar_categoria($table, $delteBtnId);
            if ($result) {
                echo 'deleted';
            }
        }
    }

    public function linea_actualizar() {
        if ($_POST['action'] == 'fetchSingleRow') {
            $output[] = '';
            $table = 'cat_noticia';
            $editBtnId = $_POST['editBtnId'];
            $result = $this->Model_categoria->linea_actualizar($table, $editBtnId);
            foreach ($result as $value) {
                $output['nc_noticia'] = $value->nc_noticia;
                $output['nc_icono'] = $value->nc_icono;
                $output['nc_categoria'] = $value->nc_categoria;
                $output['nc_url'] = $value->nc_url;
            }
            echo json_encode($output);
        }
    }

}