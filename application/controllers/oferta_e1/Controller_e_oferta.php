<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Controller_e_oferta extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('oferta_e1/Model_c_oferta');
        $this->load->model('oferta_e1/Model_e_oferta');
    }

    public function cargar_plantilla($vista, $data = '')
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_editar_oferta()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $supervisor         = $this->Model_c_oferta->obtener_supervisor();
        $data['supervisor'] = $supervisor;
        $roles              = $this->Usuarios->obtener_roles();
        $data['roles']      = $roles;
        $vista              = "oferta_e1/View_e_oferta";
        $this->cargar_plantilla($vista, $data);
    }

    public function get_oferta()
    {
        $id   = $_POST['oferta'];
        $data = array(
            'hea' => $this->Model_e_oferta->get_oferta($id),
            'bod' => $this->Model_e_oferta->get_items($id),
        );
        echo json_encode($data);
    }

    public function guardar_oferta()
    {
        $proyecto      = $this->input->post('proyecto');
        $ubicacion     = $this->input->post('ubicacion');
        $servicios     = $this->input->post('servicios');
        $fecha         = $this->input->post('fecha');
        $empresa       = $this->input->post('empresa');
        $id_supervisor = $this->input->post('id_supervisor');

        $id_oferta  = $this->input->post('oferta');
        $id_detalle = $this->input->post('id_detalle');
        $codigo      = $this->input->post('codigo');

        $servicio_ex      = $this->input->post('servicio_ex');
        $detalle_item      = $this->input->post('detalle_item');

        $formulario = array(
            'proyecto'      => $proyecto,
            'ubicacion'     => $ubicacion,
            'servicios'     => $servicios,
            'fecha'         => $fecha,
            'empresa'       => $empresa,
            'id_supervisor' => $id_supervisor,
            'codigo'        => $codigo,
            'servicio_ex'   => $servicio_ex,
        );

        $actualizar = array();
        $guardar    = array();

        if (isset($_POST['id_item'])) {
            $id_item  = $this->input->post('id_item');
            $cantidad = $this->input->post('cantidad');
            for ($i = 0; $i < count($id_item); $i++) {
                $actualizar[$i] = array(
                    'id_item'    => $id_item[$i],
                    'cantidad'   => $cantidad[$i],
                    'id_detalle' => $id_detalle[$i],
                    'detalle_item' => $detalle_item[$i],
                );
            }
            $this->Model_e_oferta->actualizar_datos($actualizar);
        }

        if (isset($_POST['id_item2'])) {
            $id_item2  = $this->input->post('id_item2');
            $cantidad2 = $this->input->post('cantidad2');
            $detalle_item2 = $this->input->post('detalle_item2');
            for ($i = 0; $i < count($id_item2); $i++) {
                $guardar[$i] = array(
                    'id_item'   => $id_item2[$i],
                    'cantidad'  => $cantidad2[$i],
                    'detalle_item' => $detalle_item2[$i],
                    'id_oferta' => $id_oferta,
                );
            }

            $this->Model_e_oferta->guardar_datos($guardar);
        }

        $x = $this->Model_e_oferta->actualizar_formulario($formulario, $id_oferta);
        if ($x) {
            echo "exito";
        }
        
    }

    public function eliminar_detalle()
    {
        $id = $this->input->post('delteBtnId');
        $x  = $this->Model_e_oferta->eliminar_detalle($id);

        if ($x) {
            echo 'deleted';
        }

    }
}
