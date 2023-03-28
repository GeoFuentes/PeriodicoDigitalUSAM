<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Controller_l_oferta extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('oferta_e1/Model_l_oferta');
    }

    public function cargar_plantilla($vista, $data = '')
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_oferta()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $roles             = $this->Usuarios->obtener_roles();
        $data['roles']     = $roles;
        $vista             = "oferta_e1/View_l_oferta";
        $this->cargar_plantilla($vista, $data);
    }

     public function get_oferta()
    {

        $list = $this->Model_l_oferta->get_oferta();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $_data) {
            $no++;
            $row = array();
            $row[] = "inte. ".$_data->correlativo;
            $row[] = $_data->fecha;
            $row[] = $_data->proyecto;
            $row[] = "
            <center>
            <b class='tool'>
                <button class='btn bg-blue-grey waves-effect btn-xs btn_add' data-action='editar'  id='detail-ofert' data-detail-ofert='" . $_data->id_oferta . "'><b><i class='material-icons'>build</i></b></button>
            <span class='tooltip-css3'>EDITAR</span>
            </b>
            <b class='tool'>
                <button class='btn bg-blue-grey waves-effect btn-xs btn_add' data-action='descargar'  id='detail-ofert' data-detail-ofert='" . $_data->id_oferta . "'><b><i class='material-icons'>archive</i></b></button>
                <span class='tooltip-css3'>DESCARGAR</span>
            </b>
            <b class='tool'>
                <button class='btn bg-blue-grey waves-effect btn-xs btn_add' data-action='ver'  id='detail-ofert' data-detail-ofert='" . $_data->id_oferta . "'><b><i class='material-icons'>open_in_new</i></b></button>
                <span class='tooltip-css3'>VISTA</span>
            </b>
             ";

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_l_oferta->count_all(),
            "recordsFiltered" => $this->Model_l_oferta->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}