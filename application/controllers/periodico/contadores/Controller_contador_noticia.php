<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Controller_contador_noticia extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('contadores/Model_contador_noticia');
        $this->load->helper('cookie');
    }

    public function set_cooki()
    {

        date_default_timezone_set('America/El_Salvador');

        $host        = gethostname();
        $direccionip = $_SERVER['REMOTE_ADDR'];
        $CatId         = $this->input->post("CatId");
        $NotiId         = $this->input->post("NotiId");

        $cookie = $host.'|'.$CatId.'|'.$NotiId;

        if (isset($_COOKIE[$cookie])) {
            echo "ya existe | ".$cookie;;
        } else {
            $this->input->set_cookie($cookie, 'cookie de contador individual', 900);
            

            $data = array(
                'host_name' => $direccionip, 
                'cooki' => $cookie,
                'date_in' => date("Y-m-d"),
                'time_in' => date("H:i:s"),
                'id_noticia' => $NotiId,
            );

            $this->Model_contador_noticia->set_cooki($data);

            echo "no existe | ".$cookie;
        }

    }
}
