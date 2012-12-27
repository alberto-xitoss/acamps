<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Financeiro extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('logado')){
			redirect('admin/login');
		}
		
		$this->template->set_template('admin_template');
		$this->template->set('title', "Sistema Acamp's");
	}
	
	public function auditar()
	{
		if ($this->input->post('verificar'))
		{
			$view_data['data_default'] = $this->input->post('data');
			
			$this->load->model('pessoa_model');
			$view_data['resultado'] = $this->pessoa_model->consultar_pagamento($view_data['data_default']);
		}
		else
		{
			$view_data['data_default'] = date('d/m/Y');
		}
		$this->template->add_css('jquery-ui.css');
		$this->template->add_js('jquery.min.js');
		$this->template->add_js('jquery-ui.min.js');
		$this->template->add_js('jquery.ui.datepicker-pt-BR.js');
		$this->template->load_view('admin/auditoria', $view_data);
	}
	
	public function concluir($id_pessoa)
	{
		$this->load->model('pessoa_model');
		if($this->pessoa_model->verificar_inscricao($id_pessoa)){
			echo 'Inscrição Concluída';
			return;
		}
		echo 'Algo deu errado';
	}
	
	public function reverter($id_pessoa)
	{
		$this->load->model('pessoa_model');
		if($this->pessoa_model->reverter_verificacao($id_pessoa)){
			echo 'Conclusão Revertida';
			return;
		}
		echo 'Algo deu errado';
	}

}