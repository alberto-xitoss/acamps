<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	function __construct()
	{
		
		parent::__construct();
		
		if(ENVIRONMENT == 'development')
		{
			$this->load->helper('Firelogger');
			$this->output->enable_profiler(TRUE);
		}
		
		$this->load->model('missao_model');
		
		// Configurações da missão
		$this->config->set_item('missao_id', $this->missao_model->id_missao());
		$this->config->set_item('missao_nome', $this->missao_model->nm_missao());
		$this->config->set_item('missao_dir', basename(FCPATH));
		
		//---------------------
		// Opções da aplicação
		//---------------------
		// Se haverá um form para os participantes se inscrevem, ou só o form interno, dentro do Sistema Admin.
		//define('FORM_ONLINE', TRUE);
		$this->config->set_item('form_online', $this->missao_model->form_online());
		// Pagamento simplificado - o form só tem a opção do tipo, o valor e o campo de desconto.
		//define('PAGAMENTO_SIMPLES', TRUE);
		$this->config->set_item('pagamento_simples', $this->missao_model->pagamento_simples());
		
		// Isso não deveria estar aqui. Só há um lugar onde esse ID é necessário, então só lá o banco será acessado.
		//define('ID_AMIGOS', 9);
		//$this->config->set_item('id_amigos', $this->missao_model->id_amigos());
	}
	
}