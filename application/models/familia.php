<?php

class Familia extends CI_Model{

    var $table = 'familia';

    function listar($cd=false){
        if($cd){
            $this->db->select('id_familia, cd_familia,nm_familia');
        }else{
            $this->db->select('id_familia,nm_familia');
        }
        $this->db->where('id_missao', $this->config->item('missao'));
        $this->db->order_by("id_familia", "asc");
        $query = $this->db->get($this->table);

        $familias = array();
        foreach ($query->result() as $row) {
            if($cd){
                $familias [$row->cd_familia] = $row->nm_familia;
            }else{
                $familias [$row->id_familia] = $row->nm_familia;
            }
        }

        return $familias;
    }

    function familia_menor(){
        // Procura uma família que ainda não tenha ninguém
        $query = $this->db->query('SELECT id_familia FROM familia
                                   WHERE id_missao = '.$this->config->item('missao').' AND id_familia NOT IN
                                       (SELECT pessoa.id_familia FROM pessoa WHERE id_familia IS NOT NULL)');
        $row = $query->result();
        if($row){ // Se houver uma família sem ninguém...
            return $row[0]->id_familia;
        }else{
            // Procura a família com menos pessoas
            $query = $this->db->query('SELECT id_familia, count(*) FROM pessoa
                                       WHERE id_missao = '.$this->config->item('missao').' AND id_familia is not null
                                       GROUP BY id_familia
                                       ORDER by count(*)');
            $row = $query->result();
            return $row[0]->id_familia;
        }
    }
}

?>
