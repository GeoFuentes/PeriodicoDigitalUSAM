<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Controller_c_oferta extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios');
        $this->load->model('Model_bitacora');
        $this->load->model('oferta_e1/Model_c_oferta'); 
    }

    public function cargar_plantilla($vista, $data = '')
    {
        $data['main_content'] = $vista;
        $this->load->view('template/template', $data);
    }

    public function vista_crear_oferta()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('Controller_home/index');
        }
        $roles                    = $this->Usuarios->obtener_roles();
        $data['roles']            = $roles;
        $supervisor               = $this->Model_c_oferta->obtener_supervisor();
        $data['supervisor']       = $supervisor;
        $vista                    = "oferta_e1/View_c_oferta";
        $this->cargar_plantilla($vista, $data);
    }

    public function get_item()
    {
        $list = $this->Model_c_oferta->get_item();
        $data = array();
        $no   = $_POST['start'];
        $i    = 0;
        foreach ($list as $item) {
            $no++;
            $i++;
            $row   = array();
            $row[] = "
            <div>
                <input data-input='$item->id_item' class='with-gap checkbox-col-blue selec_key' id='$item->id_item' type='checkbox'/>
                <label for='$item->id_item'>
                $item->id_item
                </label>
            </div>";
            $row[]  = "<a href='javascript:void(0);' class='select_produ' data-pro='$item->item' data-input='$item->id_item'>$item->item</a>";
            $row[]  = $item->precio;
            $row[]  = $item->unidad_medida;
            $row[]  = $item->cobro;
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Model_c_oferta->count_all(),
            "recordsFiltered" => $this->Model_c_oferta->count_filtered(),
            "data"            => $data,
        );
        echo json_encode($output);
    }
    public function llaves($tam)
    {
        $str      = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $password = "";
        for ($i = 0; $i < $tam; $i++) {
            $password .= substr($str, rand(0, 62), 1);
        }
        return $password;
    }
    public function guardar_oferta()
    {
        $cuenta        = $this->Model_c_oferta->contador();
        $proyecto      = $this->input->post('proyecto');
        $ubicacion     = $this->input->post('ubicacion');
        $servicios = $this->input->post('servicios');
        $fecha         = $this->input->post('fecha');
        $empresa       = $this->input->post('empresa');
        $id_supervisor = $this->input->post('id_supervisor');
        $id_oferta     = $this->llaves(10);
        $correlativo   = $this->Model_c_oferta->contador() . '-' . date('Y');
        $id_item       = $this->input->post('id_item');
        $cantidad      = $this->input->post('cantidad');
        $codigo      = $this->input->post('codigo');
        $servicio_ex      = $this->input->post('servicio_ex');
        $detalle_item      = $this->input->post('detalle_item');

        $data = array(
            'proyecto'      => $proyecto,
            'ubicacion'     => $ubicacion,
            'servicios'     => $servicios,
            'fecha'         => $fecha,
            'empresa'       => $empresa,
            'id_supervisor' => $id_supervisor,
            'id_oferta'     => $id_oferta,
            'correlativo'   => $correlativo,
            'cuenta'        => $cuenta,
            'codigo'        => $codigo,
            'servicio_ex'   => $servicio_ex,
        );

        $x = array();

        for ($i = 0; $i < count($id_item); $i++) {
            $x[$i] = array(
                'id_item'   => $id_item[$i],
                'cantidad'  => $cantidad[$i],
                'id_oferta' => $id_oferta,
                'detalle_item' => $detalle_item[$i],
            );
        }

        $o = $this->Model_c_oferta->guardar_formulario($data);
        if ($o) {
            $c = $this->Model_c_oferta->guardar_datos($x);

            $string = "UPDATE tbl_contadores set contador = contador+1 where id_contador = 8";
            $this->db->query($string);
        }

        echo "exito";
    }

}
