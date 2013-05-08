<?php

class Familia_model extends CI_Model{

    var $table = 'familia';
	
	function buscar($id_familia) {
        $this->db->select('*');
        $this->db->where('id_familia', $id_familia);
        $query = $this->db->get($this->table);
        
        $familia = $query->row();
        
        if(empty($familia)){
            return false;
        }else{
            return $familia;
        }
    }
	
    function listar($cd=false){
        if($cd){
            $this->db->select('id_familia, cd_familia, nm_familia');
        }else{
            $this->db->select('id_familia,nm_familia');
        }
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
        $row = $this->db->query('SELECT id_familia FROM familia
								WHERE id_familia NOT IN (SELECT DISTINCT pessoa.id_familia FROM pessoa WHERE id_familia IS NOT NULL)
								LIMIT 1')->result();
        if($row){ // Se houver uma família sem ninguém...
            return $row[0]->id_familia;
        }else{
            // Procura a família com menos pessoas
            $row = $this->db->query('SELECT id_familia, count(*) FROM pessoa
                                       WHERE id_familia IS NOT NULL
                                       GROUP BY id_familia
                                       ORDER by count(*)
									   LIMIT 1')->result();
            return $row[0]->id_familia;
        }
    }
}

?>
