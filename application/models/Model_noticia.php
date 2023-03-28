<?php

class Model_noticia extends CI_Model {

    public $column = array(
        'noti.id_noticia',
        'noti.Titular',
        'noti.Editor',
        'noti.Reportero',
        'cat.nc_noticia',
        'noti.Fecha',
        'edi.num_edicion',
    );

    public $order = array('noti.Fecha' => 'desc');

    private function _get_noticia($term = '') {
        $column = array(
            'noti.id_noticia',
            'noti.Titular',
            'noti.Editor',
            'noti.Reportero',
            'cat.nc_noticia',
            'noti.Fecha',
            'edi.num_edicion',
            'noti.url',
        );

        $this->db->select('*');
        $this->db->from('noticias noti');
        $this->db->join('cat_noticia cat','cat.id_cat_noticia = noti.id_cat_noticia');
        $this->db->join('edicion_noticia ed_not','ed_not.id_noticia = noti.id_noticia');
        $this->db->join('edicion edi','edi.id_edicion = ed_not.id_edicion');
        $this->db->group_start();
        $this->db->like('noti.Titular', $term);
        $this->db->or_like('noti.Editor', $term);
        $this->db->or_like('noti.Reportero', $term);
        $this->db->group_end();
        if (isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    public function lista_noticia()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_noticia($term);
        if ($_REQUEST['length'] != -1) {
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_noticia($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {   
        $this->db->select('*');
        $this->db->from('noticias');
        return $this->db->count_all_results();
    }

    public function crear_data($table, $data) {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    public function crear_id($table, $data) {
        $this->db->insert($table, $data);
        $result = $this->db->insert_id();
        return $result;
    }

    public function linea_actualizar($editBtnId) {
        $this->db->where('noti.id_noticia', $editBtnId);
        $this->db->select('
                            noti.id_noticia,
                            noti.id_cat_noticia,
                            noti.id_cat_nivel,
                            noti.Titular,
                            noti.Subtitulo,
                            noti.Nota,
                            noti.Fecha,
                            noti.Editor,
                            noti.Reportero,
                            edi.id_edicion,
                            noti.url as url_noti,
                            foto.id_foto,
                            foto.titulo_foto,
                            foto.url,
                            foto.Fotografo
                            ');
        $this->db->from('noticias noti');
        $this->db->join('cat_noticia cat','cat.id_cat_noticia = noti.id_cat_noticia');
        $this->db->join('edicion_noticia ed_not','ed_not.id_noticia = noti.id_noticia');
        $this->db->join('edicion edi','edi.id_edicion = ed_not.id_edicion');
        $this->db->join('noticia_foto noti_foto','noti_foto.id_noticia = noti.id_noticia');
        $this->db->join('fotografia foto','foto.id_foto = noti_foto.id_foto');
        $result = $this->db->get();
        return $result->result();
    }

    public function ultimo_registro(){
        $this->db->select('id_noticia');
        $this->db->from('noticias');
        $this->db->order_by('id_noticia', 'desc');
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->result();
    }

    public function actualizar_data($table, $data, $updateId) {
        $result = $this->db->update($table, $data, $updateId);
        return $result;
    }

    public function delete_noticias($idNoticia){
        $noticia_foto = $this->db->select('id_noticia')->from('noticia_foto')->where('id_noticia', $idNoticia)->get();
        $edicion_noticia = $this->db->select('id_noticia')->from('edicion_noticia')->where('id_noticia', $idNoticia)->get();

        if($noticia_foto->num_rows() > 0){
            $this->db->where('id_noticia', $idNoticia);
            $this->db->delete('noticia_foto');
        }

        if($edicion_noticia->num_rows() > 0){
            $this->db->where('id_noticia', $idNoticia);
            $this->db->delete('edicion_noticia');
        }

        $this->db->where('id_noticia', $idNoticia);
        $result = $this->db->delete('noticias');

        return $result;
    }

}