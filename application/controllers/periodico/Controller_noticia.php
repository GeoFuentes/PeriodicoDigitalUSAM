<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Controller_noticia extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('Model_categoria');
        $this->load->model('Model_edicion');
        $this->load->model('Model_noticia');
        $this->load->model('Model_fotos');
    }

   
    public function cargar_plantilla($vista,$data)
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_noticia()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $categoriass = $this->Model_categoria->obtener_categorias();
        $data['categorias'] = $categoriass;
        $edicioness = $this->Model_edicion->obtener_ediciones();
        $data['ediciones'] = $edicioness;
        $vista = "periodico/View_noticias";
        $this->cargar_plantilla($vista,$data);
    }


    public function listar_noticia() {

        $list = $this->Model_noticia->lista_noticia();
        $rol = $this->Usuarios->get_rolUser($_SESSION['idusuario']);
        $data = array();
        $no = $_POST['start'];
        $eliminar="";
        foreach ($list as $person) {
            if ($rol->id_rol == 1 || $rol->id_rol == 2) {
                $eliminar = "<b class='tool'>
                <button id='delteBtnId' class='btn bg-blue-grey waves-effect btn-xs' data-delteBtnId='" . $person->id_noticia . "'><b><i class='material-icons'>delete_forever</i></b></button>
                <span class='tooltip-css3' >ELIMINAR</span>
              </b>";
            }     
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $person->Titular;
            $row[] = $person->Editor;
            $row[] = $person->Reportero;
            $row[] = "<i  class='".$person->nc_icono."'></i>  ".$person->nc_noticia."";
            $row[] = "<center>
                <b class='tool'>
                <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='urlBnt' data-urlBtnId='" . $person->id_noticia . "'>link</i></b> </button>
                <span class='tooltip-css3'>Ver Link</span></center>
                ";
            $row[] = "N° - ".$person->num_edicion;
            $row[] = "<center>
            <b class='tool'>
            <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='notaBtnId' data-notaBtnId='" . $person->id_noticia . "'>description</i></b></button>
            <span class='tooltip-css3'>NOTA</span>
            </b>
            <b class='tool'>
            <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='fotoBtnId' data-fotoBtnId='" . $person->id_noticia . "'>add_to_photos</i></b></button>
            <span class='tooltip-css3'>GALERIA</span>
            </b>
            <b class='tool'>
            <button class='btn bg-teal waves-effect btn-xs'><b><i class='material-icons' id='editBtnId' data-editBtnId='" . $person->id_noticia . "'>build</i></b></button>
            <span class='tooltip-css3'>EDITAR</span>
            </b>".$eliminar."</center>";
            $data[] = $row;
        }
        
        
        

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Model_noticia->count_all(),
            "recordsFiltered" => $this->Model_noticia->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function actualizar_crear_noticia() {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'create') {

                date_default_timezone_set('America/El_Salvador');
                $fecha_hora = date("Y-m-d H:i:s");
                $id_u = $_SESSION['idusuario'];
                $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $acciones = array(
                    'fecha_hora' => $fecha_hora,
                    'ip' => $ip,
                    'accion' => "CREAR",
                    'tabla' => "NOTICIA",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;

                $img = '';
                if ($_FILES['url_foto']['name'] != '') {
                    $img = $this->upload_img($_FILES['url_foto']);
                } else {
                    $img = '';
                }
                $ultimo_id = $this->Model_noticia->ultimo_registro();
                $id = $ultimo_id[0]->id_noticia+1;
                $data_noti = array(
                    'id_cat_noticia' => $_POST['categoria'],
                    'id_cat_nivel' => $_POST['nivel'],
                    'Titular' => $_POST['titulo'],
                    'Subtitulo' => $_POST['subtitulo'],
                    'Nota' => "",
                    'Fecha' => $_POST['fecha'],
                    'Editor' => $_POST['editor'],
                    'Reportero' => $_POST['reportero'],
                    'Visita' => 0,
                    'url' => base_url()."noticia/".$id,
                );

                $noti_id = $this->Model_noticia->crear_id('noticias', $data_noti);
               
                
                $data_edicion = array(
                    'id_noticia' => $noti_id,
                    'id_edicion' => $_POST['edicion'],
                );

                $result_edi = $this->Model_noticia->crear_data('edicion_noticia', $data_edicion);

                $data_foto = array(
                    'titulo_foto' => $_FILES['url_foto']['name'],
                    'url' => $img,
                    'Fotografo' => $_POST['fotografo'],
                    'Fecha' => $fecha_hora,
                );

                $foto_id = $this->Model_noticia->crear_id('fotografia', $data_foto);

                $data_foto_noti = array(
                    'id_noticia' => $noti_id,
                    'id_foto' => $foto_id,
                    'principal' => 1,
                );

                $result_foto = $this->Model_noticia->crear_data('noticia_foto', $data_foto_noti);

                if ($result_edi && $result_foto) {
                    $request = array(
                        'id_noti' => $noti_id,
                        'message' => 'created'
                    );
                    echo json_encode($request);
                }
            }

            if ($_POST['action'] == 'update') {

                date_default_timezone_set('America/El_Salvador');
                $fecha_hora = date("Y-m-d H:i:s");
                $id_u = $_SESSION['idusuario'];
                $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $acciones = array(
                    'fecha_hora' => $fecha_hora,
                    'ip' => $ip,
                    'accion' => "ACTUALIZAR",
                    'tabla' => "NOTICIA",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;

                $img = '';
                if ($_FILES['url_foto']['name'] != '') {
                    $img = $this->upload_img($_FILES['url_foto']);
                } else {
                    $img = $_POST['url'];
                }

                $data_noti = array(
                    'id_cat_noticia' => $_POST['categoria'],
                    'id_cat_nivel' => $_POST['nivel'],
                    'Titular' => $_POST['titulo'],
                    'Subtitulo' => $_POST['subtitulo'],
                    'Fecha' => $_POST['fecha'],
                    'Editor' => $_POST['editor'],
                    'Reportero' => $_POST['reportero'],
                );

                $notiId = 'id_noticia ='.$_POST['updateId'];
                $data_edicion = array(
                    'id_edicion' =>  $_POST['edicion']
                );

                $resultNoti = $this->Model_noticia->actualizar_data('noticias', $data_noti, $notiId);
                $resultEdi = $this->Model_noticia->actualizar_data('edicion_noticia', $data_edicion, $notiId);

                $fotoId = 'id_foto ='.$_POST['fotoId'];

                $data_foto = array(
                    'titulo_foto' => $_FILES['url_foto']['name'],
                    'url' => $img,
                    'Fotografo' => $_POST['fotografo'],
                    'Fecha' => $fecha_hora,
                );

                $resultFoto = $this->Model_noticia->actualizar_data('fotografia', $data_foto, $fotoId);
                
                if ($resultNoti && $resultFoto && $resultEdi) {
                    echo 'update';
                }
            }
        }
        if (isset($_POST['actionNota'])) {
            if($_POST['actionNota'] == 'nota'){
                date_default_timezone_set('America/El_Salvador');
                $fecha_hora = date("Y-m-d H:i:s");
                $id_u = $_SESSION['idusuario'];
                $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $acciones = array(
                    'fecha_hora' => $fecha_hora,
                    'ip' => $ip,
                    'accion' => "NOTA",
                    'tabla' => "NOTICIA",
                    'nombre' => $_SESSION['nombre_completo'],
                    'id_usuario' => $id_u,
                );
                $this->Model_bitacora->guardar_bitacora($acciones) == true;
    
                $updateId = 'id_noticia ='.$_POST['updateIdNota'];
    
                $data = array(
                    'Nota' => $_POST['nota'],
                );
    
                $result = $this->Model_noticia->actualizar_data('noticias', $data, $updateId);
    
                if ($result) {
                    echo 'nota';
                }
            }
        }
    }


    public function mostrar_url(){
        if ($_POST['action'] == 'fetchSingleRow') {
            $output[] = '';
            $urlBtnId = $_POST['urlBtnId'];
            $result = $this->Model_noticia->linea_actualizar($urlBtnId);
            foreach ($result as $value) {
                $output['id_noticia'] = $value->id_noticia;
                $output['Titular'] = $value->Titular;
                $output['url_noti'] = $value->url_noti;
            }
            echo json_encode($output);
        }
    }

    public function linea_actualizar() {
        if ($_POST['action'] == 'fetchSingleRow') {
            $output[] = '';
            $table = 'noticias';
            $editBtnId = $_POST['editBtnId'];
            $result = $this->Model_noticia->linea_actualizar($editBtnId);
            foreach ($result as $value) {
                $output['id_noticia'] = $value->id_noticia;
                $output['Titular'] = $value->Titular;
                $output['Subtitulo'] = $value->Subtitulo;
                $output['url'] = $value->url;
                $output['fotoId'] = $value->id_foto;
                $output['foto'] = $value->titulo_foto;
                $output['Fotografo'] = $value->Fotografo;
                $output['Fecha'] = $value->Fecha;
                $output['Editor'] = $value->Editor;
                $output['Reportero'] = $value->Reportero;
                $output['id_cat_noticia'] = $value->id_cat_noticia;
                $output['id_edicion'] = $value->id_edicion;
                $output['id_cat_nivel'] = $value->id_cat_nivel;
                $output['Nota'] = $value->Nota;
                $output['url_noti'] = $value->url_noti;
            }
            echo json_encode($output);
        }
    }

    public function eliminar_noticia(){
        if ($_POST['action'] == 'delete_noti') {
            date_default_timezone_set('America/El_Salvador');
            $fecha_hora = date("Y-m-d H:i:s");
            $id_u = $_SESSION['idusuario'];
            $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $acciones = array(
                'fecha_hora' => $fecha_hora,
                'ip' => $ip,
                'accion' => "ELIMINAR",
                'tabla' => "NOTICIAS",
                'nombre' => $_SESSION['nombre_completo'],
                'id_usuario' => $id_u,
            );
            $this->Model_bitacora->guardar_bitacora($acciones) == true;

            $idNoticia = $_POST['delteBtnId'];
            $result = $this->Model_noticia->delete_noticias($idNoticia);
            if ($result) {
                echo 'deleted_news';
            }
        }
    }

    /***************************************Imagen***************************************/

    public function obtener_img(){
        if($_POST['action'] == 'get'){
            $notiId = $_POST['notiId'];
            $data = array(
                "imagen" => $this->Model_fotos->obtener_imagenes($notiId)
            );
            echo json_encode($data);
        }
    }

    public function upload() {
        if (!empty($_FILES)) {
            $notiId = $_POST['notiId'];
            // $extention = explode('.', $_FILES['file']['name']);
            // $newName = rand() . '.' . $extention[1];
            $tempFile = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $targetPath = "./assets/upload/noticias/";
            $targetFile = $targetPath . $fileName ;
            move_uploaded_file($tempFile, $targetFile);

            date_default_timezone_set('America/El_Salvador');
            $fecha_hora = date("Y-m-d H:i:s");
            $id_u = $_SESSION['idusuario'];
            $ip = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $acciones = array(
                'fecha_hora' => $fecha_hora,
                'ip' => $ip,
                'accion' => "SUBIR",
                'tabla' => "FOTOGRAFIA",
                'nombre' => $_SESSION['nombre_completo'],
                'id_usuario' => $id_u,
            );
            $this->Model_bitacora->guardar_bitacora($acciones) == true;

            $data_foto = array(
                'titulo_foto' => $_FILES['file']['name'],
                'url' => $_FILES['file']['name'],
                'Fotografo' => 'Patria Masferreriana',
                'Fecha' => $fecha_hora,
            );

            $foto_id = $this->Model_noticia->crear_id('fotografia', $data_foto);

            $data_foto_noti = array(
                'id_noticia' => $notiId,
                'id_foto' => $foto_id,
                'principal' => 0,
            );

            $result = $this->Model_noticia->crear_data('noticia_foto', $data_foto_noti);

            if ($result) {
                echo 'created';
            }
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

            $result = $this->Model_fotos->eliminar_foto($_POST['fotoId']);
            if ($result) {
                echo 'deleted';
            }
        }
    }

    public function upload_img($file) {
        $extention = explode('.', $file['name']);
        $newName = rand() . '.' . $extention[1];
        $destination = './assets/upload/noticias/' . $newName;
        move_uploaded_file($file['tmp_name'], $destination);
        return $newName;
    }

}