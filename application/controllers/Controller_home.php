<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Controller_home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        @session_start();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
    }

    public function index()
    {
        if (isset($_SESSION['idusuario'])) {
            redirect('sistema', 'refresh');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function c_login()
    {
        if (isset($_SESSION['usuario'])) {
            redirect('Controller_home/View_login');
        }

        $data['titulo'] = "Inicio";
        $vista = 'admin/View_login';
        $this->cargar_plantilla_login($vista, $data);
    }

    public function cargar_plantilla_login($vista, $data)
    {
        $data['main_content'] = $vista;
        $this->load->view('template_web/login/View_template', $data);
    }
//Funcion de logueo
    public function login()
    {
        if ($this->input->post()) {
            date_default_timezone_set('America/El_Salvador');
            $hora_entrada = date("Y-m-d H:i:s");
            $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $hora_salida = "Sin Registrar";
            $estado = 0;

            $post = $this->input->post();
            $resp = $this->Usuarios->login($post);
            if($resp){
                if($resp['estado'] > 0){
                    echo $resp['estado'];
                    $user = $resp['nombre'];
                    $id_usuario = $resp['id_usuario'];
                    $esta = $this->uri->segment(3);
                    $estado = $resp['estado'];
                    $id_rol = $resp['id_rol'];
                    
    
                    $this->session->set_userdata('usuario', $user);
                    $this->session->set_userdata('estado', $estado);
                    $this->session->set_userdata($esta);
                    $this->session->set_userdata('idusuario', $id_usuario);
                    $this->session->set_userdata('idrol', $id_rol);
                    $this->session->set_userdata('nombre_completo', $resp['nombre_completo']);
                    $this->session->set_userdata('hora_entrada', $hora_entrada);
                    $actividad = array(
                        'ip' => $ip,
                        'id_usuario' => $_SESSION['idusuario'],
                        'nombre' => $_SESSION['nombre_completo'],
                        'fecha' => $hora_entrada,
                        'salida' => $hora_salida,
                        'estado' => $estado,
                    );
                    $this->Model_bitacora->guardar_actividad($actividad);
                    redirect('sistema');
                }else{
                    $this->session->set_userdata('estado_msg', '');
                    redirect('Controller_home/index');
                }
                
                
            } else {
                $this->session->set_userdata('mensaje_error', '');
                $this->session->set_userdata('correo', $_POST['username']);
                redirect('Controller_home/index');
            }
        } else {
            redirect('Controller_home/index');
        }
    }

    public function cerrar()
    {
        date_default_timezone_set('America/El_Salvador');
        $hora_salida = date("Y-m-d H:i:s");
        $estado = 1;
        $actividad = array(
            'id_usuario' => $_SESSION['idusuario'],
            'nombre' => $_SESSION['nombre_completo'],
            'fecha' => $_SESSION['hora_entrada'],
            'salida' => $hora_salida,
            'estado' => $estado,
        );
        $this->Model_bitacora->actualizar_actividad($actividad);
        $this->session->unset_userdata('regenerated');
        $this->session->unset_userdata('mensaje_error');
        $this->session->unset_userdata('usuario');
        $this->session->unset_userdata('id_usuario');
        $this->session->unset_userdata('idrol');
        $this->session->unset_userdata('hora_entrada');
        unset($_SESSION);
        $this->session->sess_destroy();
        redirect('login');
    }


    public function cargar_plantilla($idrol, $vista, $data = '')
    {
        $data['usuario'] = $this->session->userdata('usuario');
        $menu_rol = $this->Usuarios->menu_principal($idrol);
        $data['rol'] = $idrol;
        if ($menu_rol) {
            $data['menu_principal'] = $menu_rol;
        }
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function principal()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }

        $roles = $this->Usuarios->obtener_roles();
        $menuss = $this->Usuarios->listar_menu();
        $data['menus'] = $menuss;
        $data['roles'] = $roles;
        $idrol = $this->session->userdata('idrol');
        $data['idrol'] = $idrol;
        $x = $this->Usuarios->get_pantalla($idrol);
        foreach ($x as $key => $value) {
            $pantalla = $value->url_permiso;
        }
        $vista = "principales/$pantalla";

        $this->cargar_plantilla($idrol, $vista, $data);
    }


public function comprueba_sesion(){
    if (!isset($_SESSION['nombre_completo'])) {
        echo 'expiro';
    }else{

    }
}

public function cambio_cliente(){
    $this->session->set_userdata('empresa', $_POST['cliente']);
    $this->session->set_userdata('empresa_nombre', $_POST['nombre']);
}

}
