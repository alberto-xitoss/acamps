<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Onibus extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('logado')){
			redirect('admin/login');
		}
		
		$this->template->set_template('admin_template');
	}
	
	function index()
	{
		
	}
	
	function locais()
	{
		$this->load->model('onibus_local_model');

		if($this->input->post('adicionar'))
		{
			$nm_local = $this->input->post('nm_local');
			if(!empty($nm_local))
			{
				$this->onibus_local_model->adicionar($nm_local);
			}
		}
		
		$locais = $this->onibus_local_model->listar();
		$this->template->set('title', "Acamp's - Locais de saída e chegada dos ônibus");
		$this->template->load_view('admin/onibus_locais', array('onibus_locais'=>$locais));
	}
	
	function listas()
	{
		$this->template->set('title', "Acamp's - Listas dos ônibus");
	}
	
	function saida()
	{
		$this->template->set_template('admin_template');
		$this->template->set('title', "Sistema Acamp's");
		$this->template->add_js('jquery.min.js');
		$this->template->add_js('bootstrap-dropdown.js');
		$this->template->add_js('bootstrap-button.js');
		$this->template->add_js('jquery.jqote2.min.js');
		$this->template->load_view('admin/onibus_saida');
	}
	
	function gerenciar()
	{
		$this->template->set_template('admin_template');
		$this->template->set('title', "Sistema Acamp's");
		$this->template->add_js('jquery.min.js');
		$this->template->add_js('bootstrap-dropdown.js');
		$this->template->add_js('bootstrap-button.js');
		$this->template->add_js('jquery.jqote2.min.js');
		$this->template->load_view('admin/ger_onibus');
	}
	
	function buscar_inscricao($nome, $cd_tipo, $id_status, $nao_tem_onibus)
	{
		$this->load->model('pessoa_model');
		$campos = array('id_pessoa',
						'nm_pessoa',
						'nr_rg',
						'id_status',
						'cd_tipo',
						'nr_onibus');
		$conds["nm_pessoa"] = $nome;
		if(!empty($id_status))
		{
			$conds["id_status"] = $id_status;
		}
		$conds['cd_tipo'] = $cd_tipo === '0' ? 'psve' : $cd_tipo;
		
		if($nao_tem_onibus === 'true')
		{
			$conds['nr_onibus IS NULL'] = '';
		}
		
		$result = $this->pessoa_model->buscar($campos, $conds, 20);
		
		header('Content-type: application/json');
		echo json_encode($result);
	}
	
	function listar_onibus(){
		$this->load->model('pessoa_model');
		header('Content-type: application/json');
		echo json_encode($this->pessoa_model->listar_onibus());
	}
}