<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends CI_Model {

    public function get_pantalla($id){
        $this->db->select("permiso_url.url_permiso");
        $this->db->from("gu_rol");
        $this->db->join("permiso_url","permiso_url.id_permiso = gu_rol.id_permiso");
        $this->db->where("id_rol",$id);
        $this->db->limit(1);
        $x = $this->db->get();
        return $x->result();
    }

    public function get_rolUser($user){
        $rol = $this->db->select('id_rol')->from('usuarios')->where('id_usuario', $user)->get();
        return $rol->row();
    }


#---------------------------------------------------------
    public function listar_menum($buscar, $inicio = FALSE, $cantidadregistro = FALSE) {
        $this->db->like("menu", $buscar);
        $this->db->order_by('id_menu', 'desc');
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $consulta = $this->db->get("gu_menu");
        return $consulta->result();
    }

    public function eliminar_menum($table, $delteBtnId) {
        $this->db->where('id_menu', $delteBtnId);
        $result = $this->db->delete($table);
        return $result;
    }

    public function crear_menum($table, $data) {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function linea_actualizar($table, $editBtnId) {
        $this->db->where('id_menu', $editBtnId);
        $result = $this->db->get($table);
        return $result->result();
    }

    public function actualizar_menum($table, $data, $updateId) {
        $this->db->where('id_menu', $updateId);
        $result = $this->db->update($table, $data);
        return $result;
    }

    public function men($id) {
        $this->db->where('id_rol', $id);
        $this->db->limit(1);
        $result = $this->db->get('gu_rol');
        return $result->result();
    }

#---------------------------------------------------------

    public function eliminar_opcio($table, $delteBtnId) {
        $this->db->where('id_opcion', $delteBtnId);
        $result = $this->db->delete($table);
        return $result;
    }

    public function crear_opcio($table, $data) {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function linea_actualizar_opcion($table, $editBtnId) {
        $this->db->where('id_opcion', $editBtnId);
        $result = $this->db->get($table);
        return $result->result();
    }

    public function actualizar_opcio($table, $data, $updateId) {
        $this->db->where('id_opcion', $updateId);
        $result = $this->db->update($table, $data);
        return $result;
    }

#------------------------------------------------------------

    public $column = array(
        'id_usuario',
        'nombre',
        'nombre_completo',
    );

    public $order = array('id_usuario' => 'desc');

    private function _get_usuario($term = '')
    {
        $column = array(
            'id_usuario',
            'nombre',
            'nombre_completo',
        );

        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->group_start();
        $this->db->like('nombre', $term);
        $this->db->or_like('nombre_completo', $term);
        $this->db->group_end();
        if (isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    public function lista_usuario()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_usuario($term);
        if ($_REQUEST['length'] != -1) {
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_usuario($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {   
        $this->db->select('*');
        $this->db->from('usuarios');
        return $this->db->count_all_results();
    }

    public function eliminar_user($table, $delteBtnId) {
        $this->db->where('id_usuario', $delteBtnId);
        $result = $this->db->delete($table);
        return $result;
    }

    public function crear_user($table, $data) {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function linea_actualizar_user($table, $editBtnId) {
        $this->db->where('id_usuario', $editBtnId);
        $result = $this->db->get($table);
        return $result->result();
    }

    public function actualizar_user($table, $data, $updateId) {
        $this->db->where('id_usuario', $updateId);
        $result = $this->db->update($table, $data);
        return $result;
    }

#----------------------------------------------------------------

    public function login($post) {
        $pasword = '';
        $pwd = strtoupper($post['password']);

        $password = md5($pwd);

        $sql = "SELECT 
                u.id_usuario,
                u.nombre,
                u.clave,
                r.id_rol,
                u.nombre_completo,
                u.estado
                FROM usuarios AS u 
                INNER JOIN gu_rol AS r 
                ON u.id_rol=r.id_rol
                WHERE u.nombre='" . strtoupper($post['username']) . "'  AND u.clave='" . $password . "' ";


        $query = $this->db->query($sql);

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }


    public function nombre_rol($idrol) {
        $this->db->select('rol');
        $this->db->from('gu_rol');
        $this->db->where('id_rol', $idrol);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function menu_principal($id_rol) {
        $sql = "SELECT DISTINCT m.id_menu,m.menu,m.icono FROM gu_rol_menu AS grm INNER JOIN gu_opcion AS go ON grm.id_opcion=go.id_opcion
INNER JOIN gu_menu AS m ON go.id_menu=m.id_menu WHERE grm.id_rol=" . $id_rol . " order by orden asc";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function submenu($id_menu, $id_rol) {
        $sql = "SELECT DISTINCT go.url,go.opcion,go.id_opcion FROM gu_rol_menu AS grm INNER JOIN gu_opcion AS go ON grm.id_opcion=go.id_opcion
INNER JOIN gu_menu AS m ON go.id_menu=m.id_menu
WHERE m.id_menu=" . $id_menu . " and grm.id_rol=" . $id_rol . "";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function listar() {
        $sql = "select u.id_localidad,id_rol,id_usuario,nombre,clave,rol,nombre_area,nombre_completo,l.localidad from usuarios as u inner join gu_rol using(id_rol)
inner join localidad as l on u.id_localidad=l.idlocalidad
order by id_usuario desc";
        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function listar_roles() {
        $this->db->select('*');
        $this->db->from('gu_rol');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listar_menu() {
        $this->db->select('*');
        $this->db->from('gu_menu');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listar_opcion($id_menu) {
        $this->db->select('*');
        $this->db->from('gu_opcion');
        $this->db->where('id_menu', $id_menu);
        $query = $this->db->get();
        return $query->result_array();
    }

    #--------------------------------------------------------

    public function obtener_roles() {
        $this->db->select('*');
        $this->db->from('gu_rol');
        $query = $this->db->get();
        return $query->result();
    }

    public function preguntar_rol($id_rol) {
        $this->db->select('*');
        $this->db->from('gu_rol_menu');
        $this->db->where('id_rol', $id_rol);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function list_menu() {
        $this->db->select('*');
        $this->db->from('gu_menu');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function listar_opciones($id_menu) {
        $this->db->select('*');
        $this->db->from('gu_opcion');
        $this->db->where('id_menu', $id_menu);
        $query = $this->db->get();
        return $query->result_array();
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

    public function eliminar_opcion_xrol($id_rol) {
        $this->db->where('id_rol', $id_rol);
        $query = $this->db->delete('gu_rol_menu');

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function asignar_menu($id_rol, $opciones) {
        $sql = "INSERT INTO gu_rol_menu(id_rol,id_opcion)
(SELECT '" . $id_rol . "',id_opcion FROM gu_opcion WHERE id_opcion IN(" . $opciones . "))";

        $query = $this->db->query($sql);

        if (count($query) == 1) {
            return true;
        } else {
            return false;
        }
    }

}
