<?php

class Config_model extends CI_Model
{
	
	var $table = 'configuracao';
	
	function __construct()
	{
		parent::__construct();
	}
	
	/*
	 * Retorna todas as variáveis de configuração salvas no banco de dados
	*/
	public function get_all()
	{
		$query = $this->db->get($this->table);
		
		$config = array();

		foreach ($query->result() as $row) {
			$config[$row->nm_config] = $row->nm_valor;
		}
		// Se $config estiver vazio?
		// Na verdade, se a tabela estiver vazia $config nem existirá, pq está dentro do foreach
		return $config;
	}
	
	/*
	 * Retorna uma das variáveis de configuração salvas no banco de dados
	*/
	public function get($nm_config)
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
}
