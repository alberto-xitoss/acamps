<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setup_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function cria_tabelas($params)
	{
		
		if(!isset($params['missao']))
		{
			show_error('A missão não foi definida');
		}
		
		$script = file_get_contents(APPPATH.'models/acamps-tables-mysql.sql');
		$script = str_replace('{missao}', $params['missao'], $script);
		$script = str_replace('{valor_participante}', $params['valor_participante'], $script);
		$script = str_replace('{valor_servico}', $params['valor_servico'], $script);
		$script = str_replace('{edicao}', $params['edicao'], $script);
		$script = str_replace('{data_inicio}', $params['data_inicio'], $script);
		$script = str_replace('{data_fim}', $params['data_fim'], $script);
		$script = str_replace('{usuario}', $params['usuario'], $script);
		$script = str_replace('{senha}', $params['senha'], $script);
		$script = str_replace('{form_online}', $params['senha'], $script);
		$script = str_replace('{pagamento_simples}', $params['senha'], $script);
		//print_r($script);
		$queries = explode('--#',$script);
		//var_dump($queries);
		foreach($queries as $query)
		{
			$this->db->query($query);
		}
	}
}
