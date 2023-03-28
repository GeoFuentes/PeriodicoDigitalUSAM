<?php

class Model_edicion extends CI_Model {

    public function obtener_ediciones() {
        $this->db->order_by("fecha_publicacion desc");
        $this->db->select('*');
        $this->db->from('edicion');
        $query = $this->db->get();
        return $query->result_array();
    }

    public $column = array(
        'id_edicion',
        'fecha_publicacion',
        'num_edicion',
        'estado',
    );

    public $order = array('id_edicion' => 'desc');

    private function _get_edicion($term = '')
    {
        $column = array(
            'id_edicion',
            'fecha_publicacion',
            'num_edicion',
            'estado',
        );

        $this->db->select('*');
        $this->db->from('edicion');
        $this->db->group_start();
        $this->db->like('num_edicion', $term);
        $this->db->or_like('estado', $term);
        $this->db->group_end();
        if (isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    public function lista_edicion()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_edicion($term);
        if ($_REQUEST['length'] != -1) {
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_edicion($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {   
        $this->db->select('*');
        $this->db->from('edicion');
        return $this->db->count_all_results();
    }

     public function crear_edicion($table, $data) {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function eliminar_edicion($table, $delteBtnId) {
        $this->db->where('id_edicion', $delteBtnId);
        $result = $this->db->delete($table);
        return $result;
    }

    public function linea_actualizar($table, $editBtnId) {
        $this->db->where('id_edicion', $editBtnId);
        $this->db->select('
                            id_edicion,
                            DATE(fecha_publicacion) as fecha_publicacion,
                            num_edicion,
                            estado
                            ');
        $result = $this->db->get($table);
        return $result->result();
    }

    public function actualizar_edicion($table, $data, $updateId) {
        $this->db->where('id_edicion', $updateId);
        $result = $this->db->update($table, $data);
        return $result;
    }
}