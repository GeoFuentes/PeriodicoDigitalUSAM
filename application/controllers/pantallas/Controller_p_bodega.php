<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Controller_p_bodega extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_p_bodega');
    }


    public function get_grafico_general()
    {
        $result = $this->Model_p_bodega->get_grafico_general();
        echo json_encode($result);
    }

    public function get_grafico_linea(){
        $data = array(
            "entrada" => $this->Model_p_bodega->get_grafico_linea(1),
            "salida" => $this->Model_p_bodega->get_grafico_linea(2),
            "liquidacion" => $this->Model_p_bodega->get_grafico_linea(3),
            "devolucion" => $this->Model_p_bodega->get_grafico_linea(4),
        );
        echo json_encode($data);
    }
}
