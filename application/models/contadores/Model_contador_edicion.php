<?php

class Model_contador_edicion extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function set_cooki($data){
        $x = $this->db->insert('tbl_edi_count', $data);
        return $x;
    }

}