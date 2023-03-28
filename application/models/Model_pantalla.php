<?php

class Model_pantalla extends CI_Model
{
    public $column = array(
        'id_permiso',
        'url_permiso',
        'nombre_permiso',
    );

    public $order = array('id_permiso' => 'desc');

    private function _get_pantalla($term = '')
    {
        $column = array(
            'id_permiso',
            'url_permiso',
            'nombre_permiso',
        );

        $this->db->select('*');
        $this->db->from('permiso_url');
        $this->db->group_start();
        $this->db->like('url_permiso', $term);
        $this->db->or_like('nombre_permiso', $term);
        $this->db->group_end();
        if (isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    public function lista_pantalla()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_pantalla($term);
        if ($_REQUEST['length'] != -1) {
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_pantalla($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {   
        $this->db->select('*');
        $this->db->from('permiso_url');
        return $this->db->count_all_results();
    }

    public function linea_pantalla($id){
        $this->db->where('id_permiso', $id);
        $x = $this->db->get('permiso_url');
        return $x->result();
    }    

    public function insert_pantalla($data)
    {
        $result = $this->db->insert('permiso_url', $data);
        return $result;
    }

    public function update_pantalla($data, $updateId)
    {
        $this->db->where('id_permiso', $updateId);
        $result = $this->db->update('permiso_url', $data);
        return $result;
    }

    public function eliminar_pantalla($delteBtnId)
    {
        $this->db->where('id_permiso', $delteBtnId);
        $result = $this->db->delete('permiso_url');
        return $result;
    }
}
