<?php

class Divulgacao extends CI_Model {
	
	var $tabela = array(
		'meios' => 'meio_divulgacao',
		'pesquisa' => 'pesquisa_divulgacao'
	);
	
	function listar_meios(){
		$this->db->select('id_meio, nm_meio');
		$this->db->order_by('id_meio', 'asc');
        $query = $this->db->get($this->tabela['meios']);

        $meios = array();
        foreach ($query->result_array() as $row) {
            $meios[] = $row;
        }
        
        return $meios;
	}
	
	function inserir($dados) {
		//if(isset($dados['id_meio']) || isset($dados['nm_obs'])){
			$this->db->insert($this->tabela['pesquisa'], $dados);
			return true;
		//}
		//return false;
	}
}
