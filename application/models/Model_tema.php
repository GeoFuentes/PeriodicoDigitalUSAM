<?php
/**
 *
 */
class Model_tema extends CI_Model
{
	public function guardar_tema($data){
		$this->db->where("id_usuario",$_SESSION['idusuario']);
		$result = $this->db->update("tbl_tema",$data);
		return $result;
	}

	public function get_tema(){
		$this->db->where("id_usuario",$_SESSION['idusuario']);
		$result = $this->db->get("tbl_tema");
		return $result->result();
	}
}
