<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Controller_tema extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_tema');
    }

    public function cargar_plantilla($vista, $data = '')
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_tema()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $roles = $this->Usuarios->obtener_roles();
        $data['roles'] = $roles;
        $vista = "menu/View_tema";
        $this->cargar_plantilla($vista, $data);
    }

    public function guardar_tema(){


        $banner = '';
        if ($_FILES['foto_banner']['name'] != '') {
            $banner = $this->upload_img($_FILES['foto_banner']);
            unlink('./assets/tema/'  . $_POST['foto_banner2']);
        } else {
            $banner = $_POST['foto_banner2'];
        }

        $usuario = '';
        if ($_FILES['foto_usuario']['name'] != '') {
            $usuario = $this->upload_img($_FILES['foto_usuario']);
            unlink('./assets/tema/'  . $_POST['foto_usuario2']);
        } else {
            $usuario = $_POST['foto_usuario2'];
        }


        $data = array(
            'barra_superior_1' => $this->input->post('barra_superior_1'),
            'barra_superior_2' => $this->input->post('barra_superior_2'),
            'texto_barra_superior' => $this->input->post('texto_barra_superior'),
            'barra_inferior_1' => $this->input->post('barra_inferior_1'),
            'barra_inferior_2' => $this->input->post('barra_inferior_2'),
            'texto_barra_inferior' => $this->input->post('texto_barra_inferior'),
            'foto_usuario' => $usuario,
            'foto_banner' => $banner,
            'encabezado_tabla' => $this->input->post('encabezado_tabla'),
            'texto_tabla' => $this->input->post('texto_tabla'),
            'encabezado_modal' => $this->input->post('encabezado_modal'),
            'texto_modal' => $this->input->post('texto_modal'),
            'tema' => $this->input->post('tema'),
        );

        $result = $this->Model_tema->guardar_tema($data);

        if ($result) {
            echo "exito";
        }

    }


    public function upload_img($file) {
        $extention = explode('.', $file['name']);
        $newName = rand() . '.' . $extention[1];
        $destination = './assets/tema/' . $newName;
        $CI = & get_instance();
        $CI->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file['tmp_name'];
        $config['width'] = 225;
        $config['height'] = 150;
        $config['new_image'] = $destination;
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = FALSE;
        

        $CI->image_lib->initialize($config);

        if (!$CI->image_lib->resize()) {
            echo $this->image_lib->display_errors('', '');
        }

        return $newName;
    }

    public function get_tema(){
        $data[] = '';
        $r = $this->Model_tema->get_tema();

        foreach ($r as $key => $value) {
            $data['barra_superior_1'] = $value->barra_superior_1;
            $data['barra_superior_2'] = $value->barra_superior_2;
            $data['texto_barra_superior'] = $value->texto_barra_superior;
            $data['barra_inferior_1'] = $value->barra_inferior_1;
            $data['barra_inferior_2'] = $value->barra_inferior_2;
            $data['texto_barra_inferior'] = $value->texto_barra_inferior;
            $data['foto_usuario'] = $value->foto_usuario;
            $data['foto_banner'] = $value->foto_banner;
            $data['encabezado_tabla'] = $value->encabezado_tabla;
            $data['texto_tabla'] = $value->texto_tabla;
            $data['encabezado_modal'] = $value->encabezado_modal;
            $data['texto_modal'] = $value->texto_modal;
            $data['tema'] = $value->tema;
        }

        echo json_encode($data);

    }
}
