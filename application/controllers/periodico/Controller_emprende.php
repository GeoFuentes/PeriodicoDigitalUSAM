<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_emprende extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        // $this->load->model('Model_perfiles');
    }

    public function cargar_plantilla($vista)
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_emprende()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $vista = "periodico/View_emprende";
        $this->cargar_plantilla($vista);
    }
}