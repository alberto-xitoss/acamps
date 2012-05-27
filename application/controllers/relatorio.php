<?php

/*
 * Description of Relatorio
 *
 */
class Relatorio extends CI_Controller {
	
	public $template = 'admin_template';
	public $title = "Sistema Acamp's";
	public $css = array('admin');
	public $js = array();
	
	/*
	 * Construtor Pessoa
	*/
	function __construct() {
		parent::__construct();
		// Autenticação
		if(!$this->session->userdata('logado')){ // se NÃO está logado
			redirect('admin/login');
			return;
		}
		$this->load->library('session');
	}
	
	/*
	 * function log
	 */
	function sintetico()
	{
		$this->load->model('relatorio_model');
		$tabelas = $this->relatorio_model->sintetico();
		
		$this->template = 'relatorio_template';
		$this->css[0] = 'relatorio';
		$this->title .= ' - Relatório Sintético';
		$this->load->view('relatorio/sintetico', $tabelas);
	}
	
	/*
	 * function pagamento
	 */
	function pagamento()
	{
		if($this->input->post('gerar_relatorio')){
			
			$dt_inicio = $this->input->post('dt_inicio');
			if(empty($dt_inicio)){ $dt_inicio = date('d/m/Y'); }
			$dt_fim = $this->input->post('dt_fim');
			if(empty($dt_fim)){ $dt_fim = date('d/m/Y'); }
			
			if($dt_inicio != $dt_fim){
				$viewdata['dt_inicio'] = $dt_inicio;
				$viewdata['dt_fim'] = $dt_fim;
			}else{
				$viewdata['dt_pgto'] = $dt_inicio;
			}
			
			$this->load->model('relatorio_model');
			$viewdata['tabela'] = $this->relatorio_model->pagamento($dt_inicio, $dt_fim);
			
			$this->template = 'relatorio_template';
			$this->title .= ' - Relatório de Pagamento';
			$this->css[0] = 'relatorio';
			$this->load->view('relatorio/pagamento', $viewdata);
		}else{
			$this->js  []= 'jquery.min';
			$this->js  []= 'jquery-ui.min';
			$this->js  []= 'jquery.ui.datepicker-pt-BR';
			$this->css []= 'jquery-ui';
			$this->load->view('admin/relatorio_view', array('tipo'=>'pagamento'));
		}
	}
	
	/*
	 * function servico
	 */
	function servico() {
		// Autenticação
		if(!$this->session->userdata('logado')){ // se NÃO está logado
			redirect('admin/login');
			return;
		}
		
		//----------------------------------------------------------------------
		
		if($this->input->post('gerar_relatorio')){
			
			$this->load->model('relatorio_model');
			
			$tabela = $this->relatorio_model->servico($this->input->post('id_servico'));
			
			foreach($tabela as $linha){
				$viewdata['tabela'][ $linha['nm_servico'] ][ $linha['id_status'] ] []= $linha;
			}
			
			$this->load->model('servico');
			$viewdata['servico'] = $this->servico->buscar($this->input->post('id_servico'));
			
			$this->template = 'relatorio_template';
			$this->title .= ' - Relatório de Serviço';
			$this->css[0] = 'relatorio';
			$this->load->view('relatorio/servico', $viewdata);
		}else{
			$this->load->model('servico');
			$this->load->view('admin/relatorio_view', array('tipo'=>'servico'));
		}
	}
	
	/*
	 * function cv
	 */
	
	function cv() {
		// Autenticação
		if(!$this->session->userdata('logado')){ // se NÃO está logado
			redirect('admin/login');
			return;
		}
		
		//----------------------------------------------------------------------
		
		if($this->input->post('gerar_relatorio')){
			
			$this->load->model('relatorio_model');
			$tabela = $this->relatorio_model->cv($this->input->post('id_setor'));
			
			foreach($tabela as $linha){
				$viewdata['tabela'][$linha['nm_setor']] []= $linha;
			}
			
			$this->load->model('setor');
			$viewdata['setor'] = $this->setor->buscar($this->input->post('id_setor'));
			
			$this->template = 'relatorio_template';
			$this->title .= ' - Relatório da Comunidade de Vida';
			$this->css[0] = 'relatorio';
			$this->load->view('relatorio/cv', $viewdata);
		}else{
			$this->load->model('setor');
			$this->load->view('admin/relatorio_view', array('tipo'=>'cv'));
		}
	}
}

?>