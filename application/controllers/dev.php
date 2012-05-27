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
        $this->load->library('session');
    }
    
    /*
     * function log
     */
    
    function log() {
        // Autenticação
        if(!$this->session->userdata('logado')){ // se NÃO está logado
            redirect('admin/login');
            return;
        }
        
        //----------------------------------------------------------------------
        
        $this->load->helper('file');
        
        if($_SERVER['SERVER_NAME'] == 'localhost'){
            $data['log'] = read_file('E:/www/codeigniter/ci 1.7.2/logs/log-'.date('Y-m-d').'.php');
        }else{
            $data['log'] = read_file('/home/projeto/ci 1.7.2/logs/log-'.date('Y-m-d').'.php');
        }
        $this->load->view('admin/log', $data);
    }
    
    function consertar_fotos(){
        $this->load->model('pessoa_model');
		$this->pessoa_model->consertar_fotos();
		
		redirect('admin');
    }
    
    /**
     * função limpar
     * Muito cuidado com essa função. Zera a tabela de pessoas e as relacionadas.
    */
    function limpar(){
        //$this->load->model('pessoa_model');
        //$this->pessoa_model->esvaziar();
        
        redirect('admin/buscar');
    }
}

?>