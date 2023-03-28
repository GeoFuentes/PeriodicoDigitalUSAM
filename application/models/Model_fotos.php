<?php

class Model_fotos extends CI_Model{

    public function obtener_imagenes($notiId) {
        $this->db->where('principal', '0');
        $this->db->where('id_noticia', $notiId);
        $this->db->select('*');
        $this->db->from('fotografia foto');
        $this->db->join('noticia_foto noto_f','noto_f.id_foto = foto.id_foto');
        // $this->db->limit(10);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    
    public function eliminar_foto($foto) {
        $this->db->where('id_foto', $foto);
        $result = $this->db->delete("noticia_foto");

        $this->db->where('id_foto', $foto);
        $this->db->delete("fotografia");

        return $result;
    }

}