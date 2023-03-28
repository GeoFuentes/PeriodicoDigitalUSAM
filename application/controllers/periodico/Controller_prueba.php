<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_prueba extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_noticia');
        $this->load->model('Model_fotos');
    }

   
    public function cargar_plantilla($vista)
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template',$data);
    }

    public function vista_image()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $vista = "periodico/View_image";
        $this->cargar_plantilla($vista);
    }

    public function upload() {
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $targetPath = "./assets/upload/noticias/";
            $targetFile = $targetPath . $fileName ;
            move_uploaded_file($tempFile, $targetFile);
        }
    }

    public function delete(){
        if ($_POST['action'] == 'delete') {
            $targetPath = "./assets/upload/noticias/";
            $filename = $targetPath.$_POST['name'];  
            unlink($filename);

            date_default_timezone_set('America/El_Salvador');
            $fecha_hora = date("Y-m-d H:i:s");
            $id_u = $_SESSION['idusuario'];
            $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $acciones = array(
                'fecha_hora' => $fecha_hora,
                'ip' => $ip,
                'accion' => "ELIMINAR",
                'tabla' => "FOTOGRAFIA",
                'nombre' => $_SESSION['nombre_completo'],
                'id_usuario' => $id_u,
            );
            $this->Model_bitacora->guardar_bitacora($acciones) == true;

            $result = $this->Model_fotos->eliminar_foto($_POST['name']);
            if ($result) {
                echo 'deleted';
            }
        }
    }

    public function obtener_img(){
        if($_POST['action'] == 'get'){
            $notiId = $_POST['notiId'];
            $data = array(
                "imagen" => $this->Model_fotos->obtener_imagenes($notiId)
            );
            echo json_encode($data);
        }
    }

    // public function upload_img() {
    //     $extention = explode('.', $_FILES['file']['name']);
    //     $newName = rand() . '.' . $extention[1];
    //     $destination = './assets/upload/noticias/' . $newName;
    //     move_uploaded_file($_FILES['file']['name'], $destination);
    //     return $newName;
    // }

}