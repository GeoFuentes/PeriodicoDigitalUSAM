<?php

class Model_carrousel extends CI_Model{

    public $column = array(
        'idcarrousel',
        'titulo',
        'foto',        
        'url',        
        'estado'
    );

    public $order = array('idcarrousel' => 'desc');

    private function _get_carrousel($term = ''){
        $column = array(
            'idcarrousel',
            'titulo',
            'foto',        
            'url',        
            'estado'
        );
        $this->db->select('*');
        $this->db->from('carrousel');
        $this->db->group_start();
        $this->db->like('titulo', $term);
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

    public function lista_carrousel()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_carrousel($term);
        if ($_REQUEST['length'] != -1) {
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_carrousel($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {   
        $this->db->select('*');
        $this->db->from('carrousel');
        return $this->db->count_all_results();
    }

    public function crear_carrousel($table, $data) {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function linea_actualizar($table, $editBtnId) {
        $this->db->where('idcarrousel', $editBtnId);
        $result = $this->db->get($table);
        return $result->result();
    }

    public function actualizar_carrousel($table, $data, $updateId) {
        $this->db->where('idcarrousel', $updateId);
        $result = $this->db->update($table, $data);
        return $result;
    }

    public function eliminar_carrousel($table, $delteBtnId) {
        $this->db->where('idcarrousel', $delteBtnId);
        $result = $this->db->delete($table);
        return $result;
    }
}