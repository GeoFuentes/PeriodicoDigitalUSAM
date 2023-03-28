<?php

class Model_redes extends CI_Model{

    public $column = array(
        'id_redes',
        'red_social',
        'url',        
        'icono',        
        'entidad',
        'estado'

    );

    public $order = array('id_redes' => 'desc');

    private function _get_redes($term = ''){
        $column = array(
            'id_redes',
            'red_social',
            'url',        
            'icono',        
            'entidad',
            'estado'
    
        );
        
        $this->db->select('*');
        $this->db->from('redes');
        $this->db->group_start();
        $this->db->like('red_social', $term);
        $this->db->group_end();

        if (isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

        
    }

    public function lista_redes()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_redes($term);
        if ($_REQUEST['length'] != -1) {
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_redes($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {   
        $this->db->select('*');
        $this->db->from('redes');
        return $this->db->count_all_results();
    }

    public function crear_redes($table, $data) {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function linea_actualizar($table, $editBtnId) {
        $this->db->where('id_redes', $editBtnId);
        $result = $this->db->get($table);
        return $result->result();
    }

    public function actualizar_redes($table, $data, $updateId) {
        $this->db->where('id_redes', $updateId);
        $result = $this->db->update($table, $data);
        return $result;
    }

    public function eliminar_redes($table, $delteBtnId) {
        $this->db->where('id_redes', $delteBtnId);
        $result = $this->db->delete($table);
        return $result;
    }
}