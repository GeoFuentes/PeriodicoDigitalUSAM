<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Controller_p_oferta extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_p_oferta');
    }

    public function get_oferta_ing(){
        
        $result = $this->Model_p_oferta->get_oferta_ing();
        $data = array();
        foreach ($result as $key => $value) {
            $data[] = array(
              'label'  => $value->fecha,
              'value'  => $value->cuenta
             );
        }
        echo json_encode($data);
    }

    public function get_oferta_mtto(){
        
        $result = $this->Model_p_oferta->get_oferta_mtto();
        $data = array();
        foreach ($result as $key => $value) {
            $data[] = array(
              'label'  => $value->fecha,
              'value'  => $value->cuenta
             );
        }
        echo json_encode($data);
    }

    public function get_cotizacion(){
        
        $result = $this->Model_p_oferta->get_cotizacion();
        $data = array();
        foreach ($result as $key => $value) {
            $data[] = array(
              'label'  => $value->nombre_cliente,
              'value'  => $value->cuenta
             );
        }
        echo json_encode($data);
    }
}
