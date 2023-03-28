<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_roles extends CI_Model {

    public $column = array(
        'id_rol',
        'rol',
        'id_permiso',
    );

    public $order = array('id_rol' => 'desc');

    private function _get_rol($term = '')
    {
        $column = array(
            'id_rol',
            'rol',
            'id_permiso',
        );

        $this->db->select('*');
        $this->db->from('gu_rol');
        $this->db->group_start();
        $this->db->like('rol', $term);
        $this->db->group_end();
        if (isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    public function lista_rol()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_rol($term);
        if ($_REQUEST['length'] != -1) {
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_rol($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {   
        $this->db->select('*');
        $this->db->from('gu_rol');
        return $this->db->count_all_results();
    }



    public function list_menu() {
        $lista_menu = $this->db->get('gu_menu');
        return $lista_menu->result();
    }

    public function listar_opciones($id_menu) {
        $this->db->select('*');
        $this->db->from('gu_opcion');
        $this->db->where('id_menu', $id_menu);
        $query = $this->db->get();
        return $query->result();
    }

    public function comprobar_opcion($id_rol, $id_opcion) {
        $sql = "SELECT * FROM gu_rol_menu WHERE id_rol='" . $id_rol . "' AND id_opcion='" . $id_opcion . "'";

        $query = $this->db->query($sql);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    // public function listar_rol($buscar, $inicio = FALSE, $cantidadregistro = FALSE) {
    //     $this->db->like("rol", $buscar);
    //     $this->db->order_by('id_rol', 'desc');
    //     if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
    //         $this->db->limit($cantidadregistro, $inicio);
    //     }
    //     $consulta = $this->db->get("gu_rol");
    //     return $consulta->result();
    // }


    public function eliminar_rol($table, $delteBtnId) {
        $this->db->where('id_rol', $delteBtnId);
        $result = $this->db->delete($table);
        return $result;
    }

    public function crear_rol($table, $data) {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function linea_actualizar($table, $editBtnId) {
        $this->db->where('id_rol', $editBtnId);
        $result = $this->db->get($table);
        return $result->result();
    }

    public function actualizar_rol($table, $data, $updateId) {
        $this->db->where('id_rol', $updateId);
        $result = $this->db->update($table, $data);
        return $result;
    }

    public function cbox_pantalla(){
        return $this->db->get("permiso_url")->result();
    }
}
