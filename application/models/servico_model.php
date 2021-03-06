<?php

class Servico_model extends CI_Model{

    var $table = 'servico';
	
    /*
     * function buscar
     * @param $id_servico
     */
    public function buscar($id_servico = 0) {
		if($id_servico == 0)
			return false;
		
        $this->db->select('id_servico,nm_servico,nm_coordenador,nr_limite_pessoas');
        $this->db->where('id_servico', $id_servico);
        $query = $this->db->get($this->table);
        
        $servico = $query->row();
        
        if(empty($servico)){
            return false;
        }else{
            return $servico;
        }
    }

    public function listar(){
        $this->db->select('id_servico, nm_servico');
        $this->db->order_by("nm_servico", "asc");
        $query = $this->db->get($this->table);

        $servicos = array();
        foreach ($query->result() as $row) {
            $servicos [$row->id_servico] = $row->nm_servico;
        }
        
        return $servicos;
    }
	
	public function id_amigos(){
		$this->db->select('id_servico');
        $this->db->where('nm_servico', "Amigos do Acamp's");
        $query = $this->db->get($this->table);
        
        if($query->num_rows() == 1){
            $row = $query->row();
			return $row->id_servico;
        }else{
            return false;
        }
	}
    
}

?>
