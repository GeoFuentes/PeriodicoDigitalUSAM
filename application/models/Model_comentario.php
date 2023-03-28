<?php

class Model_comentario extends CI_Model {

    public function listar_comentarios($perfilId) {
        $this->db->where('idperfiles', $perfilId);
        $this->db->select('*');
        $this->db->from('comentario');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function obtener_perfiles()
    {
        $this->db->select('*');
        $this->db->from('comentario');
        $query =  $this->db->get();
        return $query->result_array();
    }

    public function crear_comentario($table, $data) {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function eliminar_comentario($table, $delteBtnId) {
        $this->db->where('idComentario', $delteBtnId);
        $result = $this->db->delete($table);
        return $result;
    }
    public function linea_actualizar($table, $editBtnId) {
        $this->db->where('idComentario', $editBtnId);
        $result = $this->db->get($table);
        return $result->result();
    }

    public function actualizar_comentario($table, $data, $updateId) {
        $this->db->where('idComentario', $updateId);
        $result = $this->db->update($table, $data);
        return $result;
    }

}
