<?php

/*
 * Description of pessoa
 *
 */
class Pessoa extends CI_Controller {
    
    public $template = 'admin_template';
    public $title = "Sistema Acamp's";
    public $css = array('reset', 'admin');
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
    
    /* função detalhes
     *
     * Página com os detalhes de um inscrito. Esta página contém um link para a
     * seção de pagamento desse inscrito e um botão para sua liberação.
     *
     * @param - id_pessoa
    */
    function detalhes($id_pessoa = null){
        // Autenticação
        if(!$this->session->userdata('logado')){ // se NÃO está logado
            redirect('admin/login');
            return;
        }
        
        // Se não for passado um número de inscrição
        if(empty($id_pessoa)){
            redirect('admin/buscar');
            return;
        }
        
        //----------------------------------------------------------------------
        
        $this->load->model('pessoa_model');
        $pessoa = $this->pessoa_model->buscar_por_id($id_pessoa, true);
        
        if($pessoa){
            //$this->load->helper(array('form','url'));
            
            if($pessoa['cd_tipo'] == 'p'){
                $this->load->model('familia');
            }else{
                $this->load->model('servico');
            }
            if($pessoa['cd_tipo'] == 'v'){
                    $this->load->model('setor');
            }else{
                $this->load->model('cidade');
            }
			
            $this->load->view('admin/detalhes', array('pessoa'=>$pessoa));
        }else{
            redirect('admin/buscar');
        }
    }
    
    /*
     * function corrigir
     * @param $id_pessoa
     */
    
    function corrigir($id_pessoa) {
        // Autenticação
        if(!$this->session->userdata('logado')){ // se NÃO está logado
            redirect('admin/login');
            return;
        }
        
        // Se não for passado um número de inscrição
        if(empty($id_pessoa)){
            redirect('admin/buscar');
            return;
        }
        
        //----------------------------------------------------------------------
        
        // Reenviando Foto
        if($this->input->post('adicionar_foto')){
            
            $this->load->model('pessoa_model');
            
            if($this->pessoa_model->existe($id_pessoa)){
                // Salvando Imagem
                // ---------------------------------------------------
                $caminho_foto = $this->_preparar_imagem($id_pessoa);
                if($caminho_foto){
                    $this->pessoa_model->atualizar($id_pessoa, array('ds_foto'=>$caminho_foto));
                }
                // ---------------------------------------------------
                redirect('admin/pessoa/'.$id_pessoa);
                return;
            }else{
                redirect('admin/buscar');
                return;
            }
        }
        
        // Corrigindo dados
        if($this->input->post('corrigir')){
            
            $this->load->model('pessoa_model');
            $pessoa = $this->pessoa_model->buscar_por_id($id_pessoa, true);
            
            if(!$pessoa){
                redirect('admin/buscar');
                return;
            }
            
            $dados = $_POST;
            unset($dados['ativar_correcao']);
            unset($dados['corrigir']);
            //unset($dados['reset']);
            
            foreach($dados as $campo => $valor){
                if($pessoa[$campo] == $dados[$campo]){
                    unset($dados[$campo]);
                }
            }
            
            $this->pessoa_model->atualizar($id_pessoa, $dados);
            
            redirect('admin/pessoa/'.$pessoa['id_pessoa']);
        }
    }
    
    /*
     * função pagar
     *
     * Ainda não há validação da entrada.
     *
     * @param id_pessoa - número de inscrição
    */
    function pagar($id_pessoa = 0){
        // Autenticação
        if(!$this->session->userdata('logado')){ // se NÃO está logado
            redirect('admin/login');
            return;
        }
        
        // Se não for passado um número de inscrição
        if(empty($id_pessoa)){
            redirect('admin/buscar');
            return;
        }
        
        //----------------------------------------------------------------------
		
        $this->load->model('pessoa_model');
        $pessoa = $this->pessoa_model->buscar_por_id($id_pessoa);
        
        if($pessoa->cd_tipo == 'v'){ // Se for da CV, voltamos para a página de detalhes
            redirect('admin/pessoa'.$pessoa->id_pessoa);
            return;
        }
		
		if($this->input->post('pagar')){
			
			if($this->config->item('pagamento_simples')){
				//$dados = $_POST;
				//unset($dados['avista_pago']);
				//unset($dados['pagar']);
				
				$dados['cd_tipo_pgto'] = $this->input->post('cd_tipo_pgto');
				$dados['nr_a_pagar'] = $this->input->post('nr_a_pagar');
				$dados['nr_pago'] = $this->input->post('nr_pago');
				
				if( !( $dados['nr_desconto'] = $this->input->post('nr_desconto') ) ){
					$dados['nr_desconto'] = 0;
				}
			}
			
			$this->pessoa_model->efetuar_pagamento($pessoa->id_pessoa, $dados, $this->session->userdata('id_usuario'));
			redirect('admin/pessoa/'.$id_pessoa);
		}else{
			$this->load->view('admin/pagamento', array('pessoa'=>$pessoa));
		}
    }
    
    /*
     * função liberar
     *
     * Libera a inscrição para o serviço.
     *
     * @param id_pessoa - número de inscrição
    */
    function liberar($id_pessoa){
        // Autenticação
        if(!$this->session->userdata('logado')){ // se NÃO está logado
            $this->login();
            return;
        }
        
        // Se não for passado um número de inscrição
        if(empty($id_pessoa)){
            redirect('admin/buscar');
            return;
        }
        
        //----------------------------------------------------------------------
        
        $this->load->model('pessoa_model');
        $pessoa = $this->pessoa_model->buscar_por_id($id_pessoa);
        
        if($pessoa->cd_tipo == 'v'){ // Se é da CV, o status vai para 'Concluído'
            
            $this->pessoa_model->atualizar($id_pessoa, array('id_status' => '3'));
            
        }else{ // Senão vai para 'Aguardando Pagamento'
            
            $this->pessoa_model->atualizar($id_pessoa, array('id_status' => '1'));
            
        }
        
        $this->load->model('servico');
        //$this->servico->incrementar($pessoa->id_servico);
        
        redirect('admin/pessoa/'.$id_pessoa);
    }
    
    /*
     * função reverter
     *
     * Esta função reverte liberaçao de serviço ou estorna pagamento, dependendo
     * do status da inscrição e do seu tipo.
     *
     * @param id_pessoa - número de inscrição
    */
    function reverter($id_pessoa){
        // Autenticação
        if(!$this->session->userdata('logado')){ // se NÃO está logado
            redirect('admin/login');
            return;
        }
        
        // Se não for passado um número de inscrição
        if(empty($id_pessoa)){
            redirect('admin/buscar');
            return;
        }
        
        //----------------------------------------------------------------------
        
        $this->load->model('pessoa_model');
        $pessoa = $this->pessoa_model->buscar_por_id($id_pessoa);
        
        if($pessoa->cd_tipo == 'p' && $pessoa->id_status == '3'){ // Revertendo pagamento de participante
            
            $this->pessoa_model->estornar_pagamento($id_pessoa);
            
        }elseif($pessoa->cd_tipo == 's' && $pessoa->id_status == '3'){ // Revertendo pagamento de serviço
            
            $this->pessoa_model->estornar_pagamento($id_pessoa);
            
        }elseif($pessoa->cd_tipo == 's' && $pessoa->id_status == '1'){ // Revertendo liberação de serviço
            
            $this->pessoa_model->atualizar($id_pessoa, array('id_status' => '2'));
            
            $this->load->model('servico');
            //$this->servico->decrementar($pessoa->id_servico);
            
        }elseif($pessoa->cd_tipo == 'v' && $pessoa->id_status == '3'){ // Revertendo liberação de CV
            
            $this->pessoa_model->atualizar($id_pessoa, array('id_status' => '2'));
            
            $this->load->model('servico');
            //$this->servico->decrementar($pessoa->id_servico);
        }
        
        redirect('admin/pessoa/'.$id_pessoa);
    }
    
    /*
     * function excluir
     * @param $id_pessoa
     */
    
    function excluir($id_pessoa) {
        // Autenticação
        if(!$this->session->userdata('logado')){ // se NÃO está logado
            redirect('admin/login');
            return;
        }
        
        // Se não for passado um número de inscrição
        if(empty($id_pessoa)){
            redirect('admin/buscar');
            return;
        }
        
        //----------------------------------------------------------------------
        
        $this->load->model('pessoa_model');
        $pessoa = $this->pessoa_model->buscar_por_id($id_pessoa);
        
        if($pessoa->id_status == '3' && $pessoa->cd_tipo != 'v')
            $this->pessoa_model->estornar_pagamento($id_pessoa);
            
        if($pessoa->cd_tipo != 'p' && $pessoa->id_status != '2'){
            $this->load->model('servico');
            //$this->servico->decrementar($pessoa->id_servico);
        }
        
        $this->pessoa_model->excluir($pessoa->id_pessoa);
        
        redirect('admin/buscar');
    }
	
	function participante(){
        if($this->input->post('confirmar')){
            if($this->_validar()){
                
                $this->load->model('pessoa_model');
                $this->load->model('familia');
                
                $dados = $_POST;
                unset($dados['confirmar']);
                
				$dados['cd_tipo'] = 'p';
				$dados['id_missao'] = $this->config->item('missao');
				
                // Normalizando Nome
                $dados['nm_pessoa'] = ucwords(strtolower($dados['nm_pessoa']));
				$dados['nm_cracha'] = ucwords(strtolower($dados['nm_cracha']));
                
				// Status -> Pendente Pagamento
                $dados['id_status'] = 1;
				
                // Escolhendo Família
                // ---------------------------------------------------
                $dados['id_familia'] = $this->familia->familia_menor();
				
                // ---------------------------------------------------
                // Gravando registro de inscrição e retornando o número de inscrição gerado
				
                $id_pessoa = $this->pessoa_model->inscrever($dados);
                
				// TODO - Logar inscrição feita pelo Sistema Admin
				
                // Salvando Imagem
                // ---------------------------------------------------
                $caminho_foto = $this->_preparar_imagem($id_pessoa);
                if($caminho_foto){
                    $this->pessoa_model->adicionar_foto($id_pessoa, $caminho_foto);
                }
				
                // ---------------------------------------------------
                
                redirect('admin/pessoa/'.$id_pessoa);
                return;
            }else{
                $form_data['erro'] = true;
            }
        }
        
        $this->title = "Sistema Acamp's > Formulário de Incrição";
        $this->css []= 'jquery.ui.theme';
        $this->css []= 'jquery.ui.datepicker';
        
		$this->load->model('cidade');
        $form_data['cidades'] = $this->cidade->listar();
		
        $this->load->view('admin/inscricao_participante', $form_data);
    }

    function servico(){
		if($this->input->post('confirmar')){
            if($this->_validar()){
                
                $this->load->model('pessoa_model');
                
                $dados = $_POST;
                unset($dados['confirmar']);
                
				$dados['cd_tipo'] = 's';
				$dados['id_missao'] = $this->config->item('missao');
				
                // Normalizando Nome
                $dados['nm_pessoa'] = ucwords(strtolower($dados['nm_pessoa']));
				$dados['nm_cracha'] = ucwords(strtolower($dados['nm_cracha']));
                
				// Status -> Pendente Pagamento
                $dados['id_status'] = 2;
				
                // ---------------------------------------------------
                // Gravando registro de inscrição e retornando o número de inscrição gerado
				
                $id_pessoa = $this->pessoa_model->inscrever($dados);
                
				// TODO - Logar inscrição feita pelo Sistema Admin
				
                // Salvando Imagem
                // ---------------------------------------------------
                $caminho_foto = $this->_preparar_imagem($id_pessoa);
                if($caminho_foto){
                    $this->pessoa_model->adicionar_foto($id_pessoa, $caminho_foto);
                }
				
                // ---------------------------------------------------
                
                redirect('admin/pessoa/'.$id_pessoa);
                return;
            }else{
                $form_data['erro'] = true;
            }
        }
        
        $this->title = "Sistema Acamp's > Formulário de Incrição";
        $this->css []= 'jquery.ui.theme';
        $this->css []= 'jquery.ui.datepicker';
        
		$this->load->model('cidade');
		$this->load->model('servico');
        $form_data['cidades'] = $this->cidade->listar();
		$form_data['servicos'] = $this->servico->listar();
		
        $this->load->view('admin/inscricao_servico', $form_data);
    }

    function cv(){
		if($this->input->post('confirmar')){
            if($this->_validar()){
                
                $this->load->model('pessoa_model');
                
                $dados = $_POST;
                unset($dados['confirmar']);
                
				$dados['cd_tipo'] = 'v';
				$dados['id_missao'] = $this->config->item('missao');
				
                // Normalizando Nome
                $dados['nm_pessoa'] = ucwords(strtolower($dados['nm_pessoa']));
				$dados['nm_cracha'] = ucwords(strtolower($dados['nm_cracha']));
                
				// Status -> Pendente Pagamento
                $dados['id_status'] = 2;
				
                // ---------------------------------------------------
                // Gravando registro de inscrição e retornando o número de inscrição gerado
				
                $id_pessoa = $this->pessoa_model->inscrever($dados);
                
				// TODO - Logar inscrição feita pelo Sistema Admin
				
                // Salvando Imagem
                // ---------------------------------------------------
                $caminho_foto = $this->_preparar_imagem($id_pessoa);
                if($caminho_foto){
                    $this->pessoa_model->adicionar_foto($id_pessoa, $caminho_foto);
                }
				
                // ---------------------------------------------------
                
                redirect('admin/pessoa/'.$id_pessoa);
                return;
            }else{
                $form_data['erro'] = true;
            }
        }
        
        $this->title = "Sistema Acamp's > Formulário de Incrição";
        $this->css []= 'jquery.ui.theme';
        $this->css []= 'jquery.ui.datepicker';
        
		$this->load->model('setor');
		$this->load->model('servico');
        $form_data['setores'] = $this->setor->listar();
		$form_data['servicos'] = $this->servico->listar();
		
        $this->load->view('admin/inscricao_cv', $form_data);
    }
    
	function _validar(){

        $this->load->library('form_validation');
        
        // Campos comuns a todos os tipos de inscrição
		/*** CAMPOS OBRIGATÓRIOS ***/
        $this->form_validation->set_rules('nm_pessoa', 'Nome', 'trim|required');
        $this->form_validation->set_rules('nm_cracha', 'Nome no crachá', 'trim|required');
        $this->form_validation->set_rules('ds_sexo', 'Sexo', 'required');
		/*** CAMPOS OBRIGATÓRIOS ***/
        if($this->input->post('bl_alergia_alimento') == '1'){
            $this->form_validation->set_rules('nm_alergia_alimento', 'Alergia a quais alimentos?', 'trim');
        }
        
        $cd_tipo = $this->input->post('cd_tipo');
        
        // Campos apenas do formulário de participante
        if($cd_tipo == 'p'){
			/*** CAMPOS OBRIGATÓRIOS ***/
			$this->form_validation->set_rules('dt_nascimento', 'Data de nascimento', 'required');
            $this->form_validation->set_rules('bl_seminario','Seminário', 'required');
			/*** CAMPOS OBRIGATÓRIOS ***/
        }
        
        // Campos comuns aos formulários de participante e serviço
        if($cd_tipo == 'p' || $cd_tipo == 's'){
			/*** CAMPOS OBRIGATÓRIOS ***/
			$this->form_validation->set_rules('id_cidade','Cidade', 'required');
			/*** CAMPOS OBRIGATÓRIOS ***/
            $this->form_validation->set_rules('nr_rg', 'RG', 'trim|required|numeric');
            $this->form_validation->set_rules('ds_endereco','Endereço', 'trim');
            $this->form_validation->set_rules('nr_cep','CEP', 'trim');
            $this->form_validation->set_rules('ds_bairro', 'Bairro', 'trim');
            if($this->input->post('bl_alergia_remedio') == '1'){
                $this->form_validation->set_rules('nm_alergia_remedio','Alergia a quais remédios?', 'trim');
            }
            $this->form_validation->set_rules('ds_email','E-mail', 'trim|valid_email');
            $this->form_validation->set_rules('nr_telefone','Telefone ', 'trim');
        }
        
        // Campos comuns aos formulários de serviço e CV
        if($cd_tipo == 's' || $cd_tipo == 'v'){
			/*** CAMPO OBRIGATÓRIO ***/
			$this->form_validation->set_rules('bl_alimentacao', 'Alimentação', 'required');
            $this->form_validation->set_rules('id_servico','Serviço', 'required');
			/*** CAMPOS OBRIGATÓRIOS ***/
        }
        
        // Campos apenas do formulário de CV
        if($cd_tipo == 'v'){
			/*** CAMPO OBRIGATÓRIO ***/
            $this->form_validation->set_rules('id_setor','Setor', 'required');
			/*** CAMPOS OBRIGATÓRIOS ***/
        }

        return $this->form_validation->run();
    }
	
    function _preparar_imagem($id_pessoa){
		//Obtendo as configurações do arquivo 'config/acamps.php'
        $upload = $this->config->item('upload');
        $upload['file_name'] = $id_pessoa;
        
        $this->load->library('upload', $upload);

        if($this->upload->do_upload('ds_foto')){
            $file = $this->upload->data();
            
            //log_message('error', '*FOTO*: '.print_r($file, TRUE));

            // Processando Foto
            $img_config['image_library']     = 'gd2';
            $img_config['source_image']      = $file['full_path'];
            $img_config['maintain_ratio']    = TRUE;
            if($file['image_width']>100)
                $img_config['width']         = 100;
            if($file['image_height']>100)
                $img_config['height']        = 100;
            $img_config['quality']           = '100%';
            
            $this->load->library('image_lib', $img_config);
            
            $this->image_lib->resize();
            // Processando Foto
            return $file['file_name'];
        }else{
            //log_message('error', '*FOTO-ERRO*: '.$this->upload->display_errors());
            return false;
        }
    }
}
?>