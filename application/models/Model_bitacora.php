<?php

class Model_bitacora extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function guardar_bitacora($acciones) {
        $this->db->insert('bitacora', $acciones);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function guardar_actividad($actividad) {
        $result = $this->db->insert('sesiones', $actividad);
        return $result;
    }

    public function guardar_bitacora_oferta($oferta){
        $result = $this->db->insert('bitacora_ofertas', $oferta);
        return $result;
    }

    public function actualizar_actividad($actividad) {
        $id1 = $_SESSION['idusuario'];
        $id2 = $_SESSION['nombre_completo'];
        $id3 = $_SESSION['hora_entrada'];
        $this->db->where('id_usuario', $id1);
        $this->db->where('nombre', $id2);
        $this->db->where('fecha', $id3);

        $result = $this->db->update('sesiones', $actividad);
        return $result;
    }
#Hola
    public function listar_actividad($buscar, $inicio = FALSE, $cantidadregistro = FALSE) {
        $this->db->query('SET lc_time_names = "es_ES"');
        $this->db->like("fecha", $buscar);
        $this->db->order_by('id_sesion', 'desc');
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $consulta = $this->db->get("sesiones");
        return $consulta->result();
    }

    public function listar_bt_oferta($buscar, $inicio = FALSE, $cantidadregistro = FALSE) {
        $this->db->query('SET lc_time_names = "es_ES"');
        $this->db->like("hora_fecha", $buscar);
        $this->db->or_like("oferta", $buscar);
        $this->db->or_like("usuario", $buscar);
        $this->db->or_like("accion", $buscar);
        $this->db->order_by('id_bitacora', 'desc');
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $consulta = $this->db->get("bitacora_ofertas");
        return $consulta->result();
    }

    public function listar_acciones($buscar, $inicio = FALSE, $cantidadregistro = FALSE) {
        $this->db->query('SET lc_time_names = "es_ES"');
        $this->db->like("fecha_hora", $buscar);
        $this->db->or_like("accion", $buscar);
        $this->db->order_by('id_bitacora', 'desc');
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $consulta = $this->db->get("bitacora");
        return $consulta->result();
    }





}