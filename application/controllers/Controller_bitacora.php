<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Controller_bitacora extends CI_Controller
{

    public function __construct()
    {
        date_default_timezone_set('America/El_Salvador');
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
    }

    public function cargar_plantilla($vista)
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function estado_actividad()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }

        $vista = "bitacoras/View_actividad";
        $this->cargar_plantilla($vista);
    }

    public function mostrar_bitacora()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }

        $vista = "bitacoras/View_acciones";
        $this->cargar_plantilla($vista);
    }

    public function vista_bitacora_ofertas()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }

        $vista = "bitacoras/View_bt_oferta";
        $this->cargar_plantilla($vista);
    }

    public function listar_actividad()
    {
        //valor a Buscar
        $buscar       = $this->input->post("buscar");
        $numeropagina = $this->input->post("nropagina");
        $cantidad     = $this->input->post("cantidad");

        $inicio = ($numeropagina - 1) * $cantidad;
        $data   = array(
            "actividad"      => $this->Model_bitacora->listar_actividad($buscar, $inicio, $cantidad),
            "totalregistros" => count($this->Model_bitacora->listar_actividad($buscar)),
            "cantidad"       => $cantidad,
        );
        echo json_encode($data);
    }

    public function listar_bt_oferta()
    {
        //valor a Buscar
        $buscar       = $this->input->post("buscar");
        $numeropagina = $this->input->post("nropagina");
        $cantidad     = $this->input->post("cantidad");

        $inicio = ($numeropagina - 1) * $cantidad;
        $data   = array(
            "bt_of"          => $this->Model_bitacora->listar_bt_oferta($buscar, $inicio, $cantidad),
            "totalregistros" => count($this->Model_bitacora->listar_bt_oferta($buscar)),
            "cantidad"       => $cantidad,
        );
        echo json_encode($data);
    }

    public function listar_acciones()
    {
        //valor a Buscar
        $buscar       = $this->input->post("buscar");
        $numeropagina = $this->input->post("nropagina");
        $cantidad     = $this->input->post("cantidad");

        $inicio = ($numeropagina - 1) * $cantidad;
        $data   = array(
            "acciones"       => $this->Model_bitacora->listar_acciones($buscar, $inicio, $cantidad),
            "totalregistros" => count($this->Model_bitacora->listar_acciones($buscar)),
            "cantidad"       => $cantidad,
        );
        echo json_encode($data);
    }

}
