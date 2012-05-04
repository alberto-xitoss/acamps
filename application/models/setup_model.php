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
		
		$query = file_get_contents('acamps-tables-postgres.sql');
		$query = str_replace('{nm_missao}', $params['missao'], $query);
		$query = str_replace('{nr_a_pagar_participante}', $params['valor_part'], $query);
		$query = str_replace('{ne_a_pagar_servico}', $params['valor_serv'], $query);
		$query = str_replace('{id_pessoa_inicial}', $params['id_pessoa_inicial'], $query);
		$query = str_replace('{nm_usuario}', $params['usuario'], $query);
		$query = str_replace('{pw_usuario}', $params['senha'], $query);
		
		$this->db->query($query);
		
	}
	
}
