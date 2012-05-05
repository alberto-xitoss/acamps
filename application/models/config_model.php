<?php

class Config_model extends CI_Model
{
	
	var $table = 'configuracao';
	
	function __construct()
	{
		parent::__construct();
	}
	
	/*
	 * Recupera todas as variáveis de configuração salvas no banco de dados
	*/
	function get_all()
	{
		$query = $this->db->get($this->table);
		
		foreach ($query->result() as $row) {
			$config[$row->nm_config] = $row->nm_valor;
		}
		
		return $config;
	}
	
	/*
	 * Recupera uma das variáveis de configuração salvas no banco de dados
	*/
	function get($nm_config)
	{
		$query = $this->db->get_where($this->table, array('nm_config', $nm_config));
		
		if($queyr->num_rows() == 1)
		{
			return $query->result()->nm_valor;
		}
		else
		{
			return false;
		}
	}
	
	function onibus($id_pessoa = 0)
	{
		if($id_pessoa)
		{
			
			// Verificando qual ônibus tem vaga
			$query = $this->db->query("SELECT nr_onibus, count(*) as nr_pessoas FROM onibus GROUP BY nr_onibus");
			
			if($query->num_rows() == 0)
			{
				
				$nr_onibus = 1; // Valor Default -- Começa a preencher o ônibus 1
				
			}
			else
			{
				
				foreach ($query->result() as $row)
				{
					
					if($row->nr_pessoas < 48) // Se ainda há vagas
					{
						$nr_onibus = $row->nr_onibus;
						break;
					}
				}
				if(!isset($nr_onibus))
				{
					$nr_onibus = $query->num_rows() + 1;
				}
			}
			
			// Reservando uma vaga
			$query = $this->db->query("INSERT INTO onibus(id_pessoa, nr_onibus, id_missao)
			                  VALUES (". $id_pessoa .", ". $nr_onibus .", ". $this->config->item('missao') .")");
		}
	}
	
	function remover_onibus($id_pessoa = 0)
	{
		if($id_pessoa)
		{
			$this->db->query("DELETE FROM onibus WHERE id_pessoa = ". $id_pessoa);
		}
	}
}
