<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$this->db->where("id_usuario",$_SESSION['idusuario']);
$result = $this->db->get("tbl_tema")->result();

foreach ($result as $key => $value) {
	$data['barra_superior_1'] = $value->barra_superior_1;
	$data['barra_superior_2'] = $value->barra_superior_2;
	$data['foto_banner'] = $value->foto_banner;
	$data['foto_usuario'] = $value->foto_usuario;
	$data['barra_inferior_1'] = $value->barra_inferior_1;
	$data['barra_inferior_2'] = $value->barra_inferior_2;
	$data['encabezado_tabla'] = $value->encabezado_tabla;
	$data['encabezado_modal'] = $value->encabezado_modal;
	$data['tema'] = $value->tema;
	$data['id_usuario'] = $value->id_usuario;
	$data['texto_barra_superior'] = $value->texto_barra_superior;
	$data['texto_barra_inferior'] = $value->texto_barra_inferior;
	$data['texto_modal'] = $value->texto_modal;
	$data['texto_tabla'] = $value->texto_tabla;
}


$this->load->view('template/header',$data);
$this->load->view('template/content');
$this->load->view('template/footer');
