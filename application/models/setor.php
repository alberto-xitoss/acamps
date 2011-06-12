<?php

class Setor extends CI_Model{

    var $table = 'setor';

    /*
     * function buscar
     * @param $id_setor
     */
    function buscar($id_setor) {
        $this->db->select('id_setor,nm_setor');
        //$this->db->where('id_missao', $this->config->item('id_missao'));
        $this->db->where('id_setor', $id_setor);
        $query = $this->db->get($this->table);
        
        $setor = $query->row();
        
        if(empty($setor)){
            return false;
        }else{
            return $setor;
        }
    }

    function listar(){
        $this->db->select('id_setor,nm_setor');
        //$this->db->where('id_missao', $this->config->item('id_missao'));
        $this->db->order_by("id_setor", "asc");
        $query = $this->db->get($this->table);

        $setores = array();
        foreach ($query->result() as $row) {
            $setores [$row->id_setor] = $row->nm_setor;
        }
        
        return $setores;
    }
    
}

?>
