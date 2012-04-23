<?php

class Missao_model extends CI_Model {
	
	var $tabela = 'missao';
	
	function __construct() {
		parent::__construct();
	}
	
	function id_missao()
	{
		
	}
	
	function nm_missao()
	{
		
	}
	
	function form_online()
	{
		
	}
	
	function pagamento_simples()
	{
		
	}
	
	function id_amigos()
	{
		
	}
	
	function onibus($id_pessoa = 0){
		if($id_pessoa){
			
			// Verificando qual ônibus tem vaga
			$query = $this->db->query("SELECT nr_onibus, count(*) as nr_pessoas FROM onibus GROUP BY nr_onibus");
			
			if($query->num_rows() == 0){
				
				$nr_onibus = 1; // Valor Default -- Começa a preencher o ônibus 1
				
			}else{
				
				foreach ($query->result() as $row){
					
					if($row->nr_pessoas < 3){ // Se ainda há vagas
						$nr_onibus = $row->nr_onibus;
						break;
					}
				}
				if(!isset($nr_onibus)){
					$nr_onibus = $query->num_rows() + 1;
				}
			}
			
			// Reservando uma vaga
			$query = $this->db->query("INSERT INTO onibus(id_pessoa, nr_onibus, id_missao)
			                  VALUES (". $id_pessoa .", ". $nr_onibus .", ". $this->config->item('missao') .")");
		}
	}
	
	function remover_onibus($id_pessoa = 0){
		if($id_pessoa){
			$this->db->query("DELETE FROM onibus WHERE id_pessoa = ". $id_pessoa);
		}
	}
}
