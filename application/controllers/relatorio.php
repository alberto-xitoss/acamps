<?php

/*
 * Description of Relatorio
 *
 */
class Relatorio extends CI_Controller {
	
	/*
	 * Construtor
	*/
	function __construct() {
		parent::__construct();
		
		if(!$this->session->userdata('logado')){ // se NÃO está logado
			redirect('admin/login');
		}
		
		$this->template->set_template('admin_template');
		$this->template->set('title', "Sistema Acamp's");
	}
	
	/*
	 * function sintetico
	 */
	function sintetico()
	{
		$this->load->model('relatorio_model');
		$tabelas = $this->relatorio_model->sintetico();
		
		$this->template->set_template('default');
		$this->template->add_css('relatorio.css');
		$this->template->set('title', "Sistema Acamp's - Relatório Sintético");
		$this->template->load_view('relatorio/sintetico', $tabelas);
	}
	
	/*
	 * function pagamento
	 */
	function pagamento()
	{
		if($this->input->post('gerar_relatorio'))
		{
			$dt_inicio = $this->input->post('dt_inicio');
			if(empty($dt_inicio)){ $dt_inicio = date('d/m/Y'); }
			
			$dt_fim = $this->input->post('dt_fim');
			if(empty($dt_fim)){ $dt_fim = date('d/m/Y'); }
			
			if($dt_inicio != $dt_fim)
			{
				$viewdata['dt_inicio'] = $dt_inicio;
				$viewdata['dt_fim'] = $dt_fim;
			}
			else
			{
				$viewdata['dt_pgto'] = $dt_inicio;
			}
			
			$this->load->model('relatorio_model');
			$viewdata['tabela'] = $this->relatorio_model->pagamento($dt_inicio, $dt_fim);
			
			$this->template->set_template('default');
			$this->template->add_css('relatorio.css');
			$this->template->set('title', "Sistema Acamp's - Relatório de Pagamento");
			$this->template->load_view('relatorio/pagamento', $viewdata);
		}
		else
		{
			$this->template->add_css('jquery-ui.css');
			$this->template->add_js('jquery.min.js');
			$this->template->add_js('jquery-ui.min.js');
			$this->template->add_js('jquery.ui.datepicker-pt-BR.js');
			$this->template->load_view('admin/relatorio_view', array('tipo'=>'pagamento'));
		}
	}
	
	/*
	 * function servico
	 */
	function servico()
	{
		if($this->input->post('gerar_relatorio'))
		{
			
			$this->load->model('relatorio_model');
			
			$tabela = $this->relatorio_model->servico($this->input->post('id_servico'));
			
			foreach($tabela as $linha)
			{
				$viewdata['tabela'][ $linha['nm_servico'] ][ $linha['id_status'] ] []= $linha;
			}
			
			$this->load->model('servico_model');
			$viewdata['servico'] = $this->servico->buscar($this->input->post('id_servico'));
			
			$this->template->set_template('default');
			$this->template->add_css('relatorio.css');
			$this->template->set('title', "Sistema Acamp's - Relatório de Serviço");
			$this->template->load_view('relatorio/servico', $viewdata);
		}
		else
		{
			$this->load->model('servico_model');
			$this->template->load_view('admin/relatorio_view', array('tipo'=>'servico'));
		}
	}
	
	/*
	 * function cv
	 */
	
	function cv()
	{
		if($this->input->post('gerar_relatorio'))
		{
			$this->load->model('relatorio_model');
			$tabela = $this->relatorio_model->cv($this->input->post('id_setor'));
			
			foreach($tabela as $linha)
			{
				$viewdata['tabela'][$linha['nm_setor']] []= $linha;
			}
			
			$this->load->model('setor_model');
			$viewdata['setor'] = $this->setor->buscar($this->input->post('id_setor'));
			
			$this->template->set_template('default');
			$this->template->add_css('relatorio.css');
			$this->template->set('title', "Sistema Acamp's - Relatório da Comunidade de Vida");
			$this->template->load_view('relatorio/cv', $viewdata);
		}
		else
		{
			$this->load->model('setor_model');
			$this->template->load_view('admin/relatorio_view', array('tipo'=>'cv'));
		}
	}
	
	function familia()
	{
		if($this->input->post('gerar_relatorio'))
		{
			$this->load->model('relatorio_model');
			$tabela = $this->relatorio_model->familia($this->input->post('id_familia'));
			
			foreach($tabela as $linha)
			{
				$viewdata['tabela'][$linha['nm_familia']] []= $linha;
			}
			
			$this->template->set_template('default');
			$this->template->add_css('relatorio.css');
			$this->template->add_js('jquery.min.js');
			$this->template->set('title', "Sistema Acamp's - Relatório de Famílias");
			$this->template->load_view('relatorio/familia', $viewdata);
		}
		else
		{
			$this->load->model('familia_model');
			$this->template->load_view('admin/relatorio_view', array('tipo'=>'familia'));
		}
	}
	
	function pastoreio()
	{
		$this->load->model('relatorio_model');
		$tabela = $this->relatorio_model->pastoreio();
		
		$this->template->set_template('default');
		$this->template->add_css('relatorio.css');
		$this->template->set('title', "Sistema Acamp's - Relatório de Participantes do Seminário por Idade");
		$this->template->load_view('relatorio/pastoreio', array('tabela'=>$tabela));
	}
	
	function divulgacao()
	{
		$this->load->model('relatorio_model');
		$tabela = $this->relatorio_model->divulgacao();
		
		$this->template->set_template('default');
		$this->template->add_css('relatorio.css');
		$this->template->set('title', "Sistema Acamp's - Pesquisa sobre Meios de Divulgação");
		$this->template->load_view('relatorio/divulgacao', array('tabela'=>$tabela));
	}
}

?>