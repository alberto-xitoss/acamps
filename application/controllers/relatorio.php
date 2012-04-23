<?php

/*
 * Description of Relatorio
 *
 */
class Relatorio extends MY_Controller {
    
    public $template = 'admin_template';
    public $title = "Sistema Acamp's";
    public $css = array('bootstrap', 'admin');
    public $js = array();
    
    /*
     * Construtor Pessoa
    */
    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }
    
    /* index
     *
     * Essa função nunca é chamada.
    */
    function index(){
        // Autenticação
        if(!$this->session->userdata('logado')){ // se NÃO está logado
            redirect('admin/login');
        }else{
            redirect('admin/buscar');
            
        }
    }
    
    /*
     * function log
     */
    function sintetico() {
        // Autenticação
        if(!$this->session->userdata('logado')){ // se NÃO está logado
            redirect('admin/login');
            return;
        }
        
        //----------------------------------------------------------------------
        $this->load->model('relatorio_model');
        $tabelas = $this->relatorio_model->sintetico();
        
        $this->template = 'relatorio_template';
        $this->title .= ' - Relatório de Pagamento';
        $this->css[1] = 'relatorio';
        $this->load->view('relatorio/sintetico', $tabelas);
    }
    
    /*
     * function pagamento
     */
    function pagamento() {
        // Autenticação
        if(!$this->session->userdata('logado')){ // se NÃO está logado
            redirect('admin/login');
            return;
        }
        
        //----------------------------------------------------------------------
        
        if($this->input->post('gerar_relatorio')){
            
            $dt_inicio = $this->input->post('dt_inicio');
            $dt_fim = $this->input->post('dt_fim');
            
            if($dt_inicio&&$dt_fim){
                if($dt_inicio != $dt_fim){
                    $var['dt_inicio'] = $dt_inicio;
                    $var['dt_fim'] = $dt_fim;
                }else{
                    $var['dt_pgto'] = $dt_inicio;
                }
                
                $this->load->model('relatorio_model');
                $var['tabela'] = $this->relatorio_model->pagamento($dt_inicio, $dt_fim);
            }else{
                $var['dt_pgto'] = 0;
                $var['tabela'] = array();
            }
            
            $this->template = 'relatorio_template';
            $this->title .= ' - Relatório de Pagamento';
            $this->css[1] = 'relatorio';
            $this->load->view('relatorio/pagamento', $var);
        }else{
            $this->js   []= 'jquery.datepick.min';
            $this->js   []= 'jquery.datepick-pt-BR';
            $this->css  []= 'jquery.datepick';
            $this->load->helper(array('form','url'));
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
                $var['tabela'][$linha['nm_servico']][$linha['id_status']] []= $linha;
            }
            
            $this->load->model('servico');
            $var['servico'] = $this->servico->buscar($this->input->post('id_servico'));
            
            $this->template = 'relatorio_template';
            $this->title .= ' - Relatório de Serviço';
            $this->css[1] = 'relatorio';
            $this->load->view('relatorio/servico', $var);
        }else{
            $this->load->helper(array('form','url'));
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
                $var['tabela'][$linha['nm_setor']] []= $linha;
            }
            
            $this->load->model('setor');
            $var['setor'] = $this->setor->buscar($this->input->post('id_setor'));
            
            $this->template = 'relatorio_template';
            $this->title .= ' - Relatório de Comunidade de Vida';
            $this->css[1] = 'relatorio';
            $this->load->view('relatorio/cv', $var);
        }else{
            $this->load->helper(array('form','url'));
            $this->load->model('setor');
            $this->load->view('admin/relatorio_view', array('tipo'=>'cv'));
        }
    }
}

?>