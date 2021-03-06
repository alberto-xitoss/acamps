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
			//show_404('');
		}
		$this->template = 'default';
		$this->load->model('setup_model');
		
		try
		{	
			$params = array(
				'missao'			=> 'Fortaleza',
				'valor_participante'=> '200.00',
				'valor_servico'		=> '110.00',
				'edicao'			=> '40',
				'data_inicio'		=> '14/01/2013',
				'data_fim'			=> '19/01/2013',
				'usuario'			=> 'mauro',
				'senha'				=> 'gadelha',
				'form_online'		=> 'true',
				'pagamento_simples'	=> 'true'
			);
			
			$this->setup_model->cria_tabelas($params);
			
		}
		catch(Exception $ex)
		{
			show_error('<p><strong>Erro na criação do banco</strong></p><p>'.$ex->getMessage().'</p>');
		}
		echo '<p>Tabelas criadas com sucesso.</p>';
		// Para o futuro:
		//$this->setup->cria_tabela_pessoa_anterior();
		//$this->setup->cria_tabela_alimentacao();
		//$this->setup->cria_tabela_portaria();
		
	}
}
