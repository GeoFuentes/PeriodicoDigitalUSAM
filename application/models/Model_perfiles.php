<?php

class Model_perfiles extends CI_Model
{

    public $column = array(
        'idperfiles',
        'nombre',
        'info',
        'url_foto',
        'cargo',
        'fecha_crea',
        'banner',
        'estado',
    );

    public $order = array('idperfiles' => 'desc');

    private function _get_perfiles($term = ''){
        $this->db->query("SET lc_time_names = 'es_ES'");
        $column = array(
            'id_edicion',
            'fecha_publicacion',
            'num_edicion',
            'estado',
        );

        $this->db->select('
                        idperfiles,
                        nombre,
                        info,
                        url_foto,
                        cargo,
                        DATE_FORMAT(fecha_crea, "%d / %M / %y") as fecha_crea,
                        banner,
                        estado
                        ');
        $this->db->from('perfiles');
        $this->db->group_start();
        $this->db->like('nombre', $term);
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

    public function lista_perfiles()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_perfiles($term);
        if ($_REQUEST['length'] != -1) {
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_perfiles($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('*');
        $this->db->from('perfiles');
        return $this->db->count_all_results();
    }

    public function crear_perfil($table, $data)
    {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function linea_actualizar($table, $editBtnId)
    {
        $this->db->where('idperfiles', $editBtnId);
        $this->db->select('
                        idperfiles,
                        nombre,
                        info,
                        url_foto,
                        cargo,
                        DATE(fecha_crea) as fecha_crea,
                        banner,
                        estado
                        ');
        $result = $this->db->get($table);
        return $result->result();
    }

    public function actualizar_perfil($table, $data, $updateId)
    {
        $this->db->where('idperfiles', $updateId);
        $result = $this->db->update($table, $data);
        return $result;
    }

    public function actualizar_data($table, $data, $updateId) {
        $result = $this->db->update($table, $data, $updateId);
        return $result;
    }
}
