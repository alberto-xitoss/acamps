<?php

class Servico extends CI_Model{

    var $table = 'servico';
	
    /*
     * function buscar
     * @param $id_servico
     */
    function buscar($id_servico = 0) {
		if($id_servico == 0)
			return false;
		
        $this->db->select('id_servico,nm_servico,nm_coordenador,nr_pessoas,nr_limite_pessoas');
        //$this->db->where('id_missao', $this->config->item('missao'));
        $this->db->where('id_servico', $id_servico);
        $query = $this->db->get($this->table);
        
        $servico = $query->row();
        
        if(empty($servico)){
            return false;
        }else{
            return $servico;
        }
    }

    function listar(){
        $this->db->select('id_servico,nm_servico,nm_coordenador,nr_pessoas,nr_limite_pessoas');
        //$this->db->where('id_missao', $this->config->item('missao'));
        $this->db->order_by("nm_servico", "asc");
        $query = $this->db->get($this->table);

        $servicos = array();
        foreach ($query->result() as $row) {
            $servicos [$row->id_servico] = $row->nm_servico;
        }
        
        return $servicos;
    } 
    
    /* function incrementar($id_servico){
        // Incrementa o contador de pessoas na equipe de serviço
        $query = $this->db->query('UPDATE servico SET nr_pessoas = nr_pessoas+1 WHERE id_servico = '.$id_servico.' AND id_missao = '.$this->config->item('missao'));
    }
    
    function decrementar($id_servico){
        // Decrementa o contador de pessoas na equipe de serviço
        $query = $this->db->query('UPDATE servico SET nr_pessoas = nr_pessoas-1 WHERE id_servico = '.$id_servico.' AND id_missao = '.$this->config->item('missao'));
    } */
    
}

?>
