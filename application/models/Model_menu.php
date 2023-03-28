<?php 
/**
 * 
 */
class Model_menu extends CI_Model
{
	
	public function traer_menu(){
		$this->db->order_by("orden","asc");
		$result = $this->db->get('gu_menu');
		return $result->result();
	}

	public function save_orden_menu($array){
      $result = $this->db->update_batch("gu_menu",$array,"id_menu");
        return true;
    }

	public $column = array(
        'id_menu',
        'menu',
        'icono',
    );

    public $order = array('id_menu' => 'desc');

    private function _get_menu($term = '')
    {
        $column = array(
            'id_menu',
			'menu',
			'icono',
        );

        $this->db->select('*');
        $this->db->from('gu_menu');
        $this->db->group_start();
        $this->db->like('menu', $term);
        $this->db->group_end();
        if (isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    public function lista_menu()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_menu($term);
        if ($_REQUEST['length'] != -1) {
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_menu($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {   
        $this->db->select('*');
        $this->db->from('gu_menu');
        return $this->db->count_all_results();
    }
}

