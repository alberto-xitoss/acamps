<?php

/*
 * Description of Dev
 *
 */
class Dev extends CI_Controller {
	
	public $template = 'admin_template';
	public $title = "Sistema Acamp's";
	public $css = array('bootstrap', 'admin');
	public $js = array();
	
	/*
	 * Construtor Dev
	*/
	function __construct() {
		parent::__construct();
		// Autenticação
		if(!$this->session->userdata('logado')){ // se NÃO está logado
			redirect('admin/login');
			return;
		}
	}
	
	/*
	 * function log
	 */
	
	function log()
	{   
		$this->load->helper('file');
		$data['log'] = read_file($this->config->item('log_path').'log-'.date('Y-m-d').'.php');
		$this->load->view('admin/log', $data);
	}
	
	/**
	 * função limpar
	 * Muito cuidado com essa função. Zera a tabela de pessoas e as relacionadas.
	*/
	function limpar($secao = '')
	{
		if($secao == 'secretaria')
		{
			// Zera marcadores de crachá da tabela pessoa
			$this->load->model('pessoa_model');
			$this->pessoa_model->zerar_etiquetas();
			
			// Deleta todos os PDF de etiquetas e fotos e o XML do histórico
			$files = scandir($this->config->item('cache_path').'secretaria/');
			foreach($files as $file)
			{
				if(preg_match('/.*pdf|.*xml/',$file))
				{
					unlink($this->config->item('cache_path').'secretaria/'.$file);
				}
			}
			
			// Cria novo histórico XML
			$log = simplexml_load_string('<?xml version="1.0" encoding="utf-8"?><log></log>');
			$log->asXML($this->config->item('cache_path').'secretaria/log.xml');
			
			redirect('admin/secretaria/historico');
		}
		//$this->load->model('pessoa_model');
		//$this->pessoa_model->esvaziar();
		
		redirect('admin/buscar');
	}
}

?>