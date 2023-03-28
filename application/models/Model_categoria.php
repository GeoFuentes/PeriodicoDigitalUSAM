<?php

class Model_categoria extends CI_Model {

    /******************************************************************************************/
    public function listar_menu() {
        $this->db->select('*');
        $this->db->from('cat_noticia');
        $query =  $this->db->get();
        return $query->result_array();
    }
    /******************************************************************************************/

    public function obtener_categorias() {
        $this->db->select('*');
        $this->db->from('cat_noticia');
        $query = $this->db->get();
        return $query->result_array();
    }

    public $column = array(
        'id_cat_noticia',
        'nc_noticia',
        'nc_icono',
        'nc_categoria',
    );

    public $order = array('id_cat_noticia' => 'desc');

    private function _get_categoria($term = '')
    {
        $column = array(
            'id_cat_noticia',
            'nc_noticia',
            'nc_icono',
            'nc_categoria',
        );

        $this->db->select('*');
        $this->db->from('cat_noticia');
        $this->db->group_start();
        $this->db->like('nc_noticia', $term);
        
        $this->db->group_end();
        if (isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    public function lista_categoria()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_categoria($term);
        if ($_REQUEST['length'] != -1) {
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_categoria($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {   
        $this->db->select('*');
        $this->db->from('cat_noticia');
        return $this->db->count_all_results();
    }

    public function crear_categoria($table, $data) {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function eliminar_categoria($table, $delteBtnId) {
        $this->db->where('id_cat_noticia', $delteBtnId);
        $result = $this->db->delete($table);
        return $result;
    }
    public function linea_actualizar($table, $editBtnId) {
        $this->db->where('id_cat_noticia', $editBtnId);
        $this->db->select('
                            id_cat_noticia,
                            nc_noticia,
                            nc_icono,
                            IFNULL(nc_categoria,"") as nc_categoria,
                            nc_url
        ');
        $result = $this->db->get($table);
        return $result->result();
    }

    public function actualizar_categoria($table, $data, $updateId) {
        $this->db->where('id_cat_noticia', $updateId);
        $result = $this->db->update($table, $data);
        return $result;
    }
}