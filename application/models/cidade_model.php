<?php

class Cidade_model extends CI_Model{

    var $table = 'cidade';

    function listar(){
        $this->db->select('id_cidade,nm_cidade,cd_estado');
        //$this->db->where('id_missao', $this->config->item('id_missao'));
        $this->db->order_by("nm_cidade", "asc");
        $query = $this->db->get($this->table);

        $cidades = array();
        foreach ($query->result() as $row) {
            $cidades [(string)$row->id_cidade] = $row->nm_cidade.($row->cd_estado?', '.$row->cd_estado:'');
        }
        
        return $cidades;
    }
    
}

?>