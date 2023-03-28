<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_menu_opciones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
    }

    public function cargar_plantilla($vista, $data) {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_menu_opciones() {
        if (!isset($_SESSION['usuario']))
            redirect('Controller_home/index');
        $menuss = $this->Usuarios->listar_menu();
        $data['menus'] = $menuss;
        $vista = "menu/View_menu_opciones";
        $this->cargar_plantilla($vista, $data);
    }

    public function eliminar_opcion() {
        if ($_POST['action'] == 'delete') {
            $table = "gu_opcion";
            $delteBtnId = $_POST['delteBtnId'];
            $result = $this->Usuarios->eliminar_opcio($table, $delteBtnId);
            if ($result) {

                echo 'deleted';
            }
        }
    }

    public function linea_actualizar() {
        if ($_POST['action'] == 'fetchSingleRow') {
            $output[] = '';
            $table = 'gu_opcion';
            $editBtnId = $_POST['editBtnId'];
            $result = $this->Usuarios->linea_actualizar_opcion($table, $editBtnId);
            foreach ($result as $value) {
                $output['opcion'] = $value->opcion;
                $output['url'] = $value->url;
                $output['id_menu'] = $value->id_menu;
            }
            echo json_encode($output);
        }
    }

    public function actualizar_crear_opcion() {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'create') {
                $table = 'gu_opcion';

                $data = array(
                    'opcion' => $_POST['opcion'],
                    'url' => $_POST['url'],
                    'id_menu' => $_POST['id_menu'],
                );
                $result = $this->Usuarios->crear_opcio($table, $data);
                if ($result) {
                    echo 'created';
                }
            }

            if ($_POST['action'] == 'update') {
                $table = 'gu_opcion';
                $updateId = $_POST['updateId'];

                $data = array(
                    'opcion' => $_POST['opcion'],
                    'url' => $_POST['url'],
                    'id_menu' => $_POST['id_menu'],
                );
                $result = $this->Usuarios->actualizar_opcio($table, $data, $updateId);
                if ($result) {
                    echo 'update';
                }
            }
        }
    }

    public function listar_menu_opcion() {
        $output[] = '';

        $menu = $this->Usuarios->listar_menu();


        foreach ($menu as $m) {
            $output['icono'] = $m['icono'];
            $output['menu'] = $m['menu'];

            $roles = $this->Usuarios->listar_opcion($m['id_menu']);

            foreach ($roles as $r) {
                $output['opcion'] = $r['opcion'];
                $output['id_opcion'] = $r['id_opcion'];
            }
            echo json_encode($output);
        }
    }

    public function listar_menu_acordion() {
        if (!isset($_SESSION['usuario']))
            redirect('proyecto');

        $menu = $this->Usuarios->listar_menu();
        $tab = "";
        $active = 0;
        foreach ($menu as $m) {
            $active = $active + 1;



            $tab .= '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel-heading" >
        <h4  class="panel-title" >
        <a style="font-size:15px!important;" id="t-' . $m['id_menu'] . '" data-toggle="collapse" data-parent="#accordion4" href="#ac4-' . $m['id_menu'] . '" 
        class="collapsed">
        <i  class="fa fa-angle-right"></i><i class="' . $m['icono'] . '"></i> ' . $m['menu'] . '
        </a>
        </h4>
        </div>
        <div id="ac4-' . $m['id_menu'] . '" class="panel-collapse collapse">
        <div  id="t' . $m['id_menu'] . '" >';
            $roles = $this->Usuarios->listar_opcion($m['id_menu']);
            $tab .= "
        <div class='flip-scroll'>
            <table  class='table table-bordered table-striped table-condensed flip-content'>
                <thead class='flip-content bordered-palegreen'>
                    <tr>
                        <th class='numeric'>CORRELATIVO</th>
                        <th class='numeric'>OPCIÓN</th>
                        <th class='numeric'>ACCIONES</th>
                    </tr>
                </thead>
            <tbody>";
            $correlativo = 0;
            foreach ($roles as $r) {
                $correlativo++;
                $tab .= "
                <tr class='even gradeC'>
                    <td> " . $correlativo . "</td>
                    <td> " . $r['opcion'] . "</td>
                        <td class='text-center'>
                            <button type='button' class='btn btn-xs' id='editBtnId' data-editBtnId=" . $r['id_opcion'] . ">
                                <i style='color:#3775A4;' class='fa fa-edit'></i>
                            </button>
                            <button type='button' class='btn btn-xs' id='delteBtnId' data-delteBtnId=" . $r['id_opcion'] . ">
                                <i style='color:#D91F1F;' class='fa fa-trash'></i>
                            </button>
                        </td>
                </tr>";
            }
            $tab .= "</tbody></table>";
            $tab .= '</div></div> 
        </div>
        </div>';
        }

        echo $tab;
    }

}
