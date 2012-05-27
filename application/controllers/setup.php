<?php

class Setup extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		
		// Por enquanto só é disponível para desenvolvimento
		if(ENVIRONMENT != 'development')
		{
			show_404('');
		}
		$this->template = 'default';
		$this->load->model('setup_model');
		
		try{
			
			$params = array(
				'missao'			=> 'Fortaleza',
				'valor_part'		=> 190.00,
				'valor_serv'		=> 110.00,
				'id_pessoa_inicial' => 1100,
				'usuario'			=> 'mauro',
				'senha'				=> 'gadelha'
			);
			
			$this->setup_model->cria_tabelas($params);
			
		}catch(Exception $ex){
			show_error('<p><strong>Erro na criação do banco</strong></p><p>'.$ex->getMessage().'</p>');
		}
		
		// Para o futuro:
		//$this->setup->cria_tabela_pessoa_anterior();
		//$this->setup->cria_tabela_alimentacao();
		//$this->setup->cria_tabela_portaria();
		
	}
}
