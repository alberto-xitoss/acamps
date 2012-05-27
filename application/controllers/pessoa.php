<?php

/*
 * Description of pessoa
 *
 */
class Pessoa extends CI_Controller {
    
    public $template = 'admin_template';
    public $title = "Sistema Acamp's";
    public $css = array('admin');
    public $js = array('jquery.min');
    
    /*
     * Construtor Pessoa
    */
    function __construct() {
        parent::__construct();
		
		if(!$this->session->userdata('logado')){
            redirect('admin/login');
        }
    }
    
    /* index
     *
     * Essa função nunca é chamada.
    */
    function index(){
        
    }
    
    /* função detalhes
     *
     * Página com os detalhes de um inscrito. Esta página contém um link para a
     * seção de pagamento desse inscrito e um botão para sua liberação.
     *
     * @param - id_pessoa
    */
	function detalhes($id_pessoa = null){

		// Se não for passado um número de inscrição
		if(empty($id_pessoa)){
			redirect('admin/buscar');
			return;
		}

		//----------------------------------------------------------------------

		$this->load->model('pessoa_model');
		$pessoa = $this->pessoa_model->buscar_por_id($id_pessoa, true);

		if($pessoa){
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
			
			$this->js []= 'bootstrap-modal';
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
    function pagar($id_pessoa = 0)
	{
        
        // Se não for passado um número de inscrição
        if(empty($id_pessoa))
		{
            redirect('admin/buscar');
            return;
        }
        
        //----------------------------------------------------------------------
		
        $this->load->model('pessoa_model');
		
        $pessoa = $this->pessoa_model->buscar_por_id($id_pessoa);
		
        if(($pessoa->cd_tipo != 'p' && $pessoa->cd_tipo != 's') || $pessoa->id_status == 3) // Se o pagamento já tiver sido registrado
		{
            redirect('admin/pessoa/'.$pessoa->id_pessoa);
            return;
        }
		
		if($this->input->post('pagar'))
		{
			
			//log_message('error', 'PAGAMENTO: '.$pessoa->id_pessoa.' - '.$pessoa->nm_pessoa);
			if($this->config->item('pagamento_simples')){
				//$dados = $_POST;
				//unset($dados['avista_pago']);
				//unset($dados['pagar']);
				
				$dados['cd_tipo_pgto'] = $this->input->post('cd_tipo_pgto');
				$dados['nr_a_pagar'] = $this->input->post('nr_a_pagar');
				if( !( $dados['nr_desconto'] = $this->input->post('nr_desconto') ) )
				{
					$dados['nr_desconto'] = 0;
				}
				$dados['nr_pago'] = floatval($dados['nr_a_pagar']) - floatval($dados['nr_desconto']);
				
				//$this->log->message('cd_tipo_pgto: '.$dados['cd_tipo_pgto']);
				//$this->log->message('nr_a_pagar: '.$dados['nr_a_pagar']);
				//$this->log->message('nr_desconto: '.$dados['nr_desconto']);
				//$this->log->message('nr_pago: '.$dados['nr_pago']);
				
				$this->pessoa_model->efetuar_pagamento($pessoa->id_pessoa, $dados, $this->session->userdata('id_usuario'));
				
				if($pessoa->cd_tipo == 'p')
				{
					// Escolhendo Família
					// ---------------------------------------------------
					$this->load->model('familia');
					$familia = $this->familia->familia_menor();
					$this->pessoa_model->atualizar($pessoa->id_pessoa, array('id_familia'=>$familia));
					// ---------------------------------------------------
				}
				
				/* if($pessoa->bl_transporte)
				{
					// Resevando uma vaga no ônibus
					$this->load->model('missao_model');
					$this->missao_model->onibus($pessoa->id_pessoa);
				} */
			}
			
			redirect('admin/pessoa/'.$id_pessoa);
		}
		else
		{
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
        
        // Se não for passado um número de inscrição
        if(empty($id_pessoa)){
            redirect('admin/buscar');
            return;
        }
        
        //----------------------------------------------------------------------
        
        $this->load->model('pessoa_model');
        $pessoa = $this->pessoa_model->buscar_por_id($id_pessoa);
        
        if($pessoa->cd_tipo == 'v' || $pessoa->cd_tipo == 'e'){ // Se é da CV, o status vai para 'Concluído'
            
            $this->pessoa_model->atualizar($id_pessoa, array('id_status' => '3'));
			
			/* if($pessoa->bl_transporte){
				// Resevando uma vaga no ônibus
				$this->load->model('missao_model');
				$this->missao_model->onibus($pessoa->id_pessoa);
			} */
            
        }else{ // Senão vai para 'Aguardando Pagamento'
            
            $this->pessoa_model->atualizar($id_pessoa, array('id_status' => '1'));
            
        }
        
		$this->session->set_flashdata('auto_pagar', true);
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
			//$this->missao_model->remover_onibus($id_pessoa);
            
        }elseif($pessoa->cd_tipo == 's' && $pessoa->id_status == '3'){ // Revertendo pagamento de serviço
            
            $this->pessoa_model->estornar_pagamento($id_pessoa);
			//$this->missao_model->remover_onibus($id_pessoa);
            
        }elseif($pessoa->cd_tipo == 's' && $pessoa->id_status == '1'){ // Revertendo liberação de serviço
            
            $this->pessoa_model->atualizar($id_pessoa, array('id_status' => '2'));
            
        }elseif($pessoa->cd_tipo == 'v' && $pessoa->id_status == '3'){ // Revertendo liberação de CV
            
            $this->pessoa_model->atualizar($id_pessoa, array('id_status' => '2'));
			//$this->missao_model->remover_onibus($id_pessoa);
            
        }
        
        redirect('admin/pessoa/'.$id_pessoa);
    }
    
    /*
     * function excluir
     * @param $id_pessoa
     */
    
    function excluir($id_pessoa) {
        
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
        }
        
        $this->pessoa_model->excluir($pessoa->id_pessoa);
        
        redirect('admin/buscar');
    }
	
	function participante()
	{
        if($this->input->post('confirmar'))
		{
			$this->load->library('form_validation');
			
			if($this->form_validation->run())
			{
				
				$this->load->model('pessoa_model');
				//$this->load->model('familia');

				$dados = $_POST;
				unset($dados['confirmar']);

				$dados['cd_tipo'] = 'p';

				// Status -> Pendente Pagamento
				$dados['id_status'] = 1;

				// Família foi escolhida?
				// ---------------------------------------------------
				if($dados['id_familia'] == 0)
				{
					$dados['id_familia'] = NULL;
				}

				// ---------------------------------------------------
				// Gravando registro de inscrição e retornando o número de inscrição gerado

				$id_pessoa = $this->pessoa_model->inscrever($dados);

				// TODO - Logar inscrição feita pelo Sistema Admin

				// Salvando Imagem
				// ---------------------------------------------------
				$caminho_foto = $this->_preparar_imagem($id_pessoa);
				if($caminho_foto)
				{
					$this->pessoa_model->adicionar_foto($id_pessoa, $caminho_foto);
				}

				// ---------------------------------------------------

				$this->session->set_flashdata('auto_pagar', true);
				redirect('admin/pessoa/'.$id_pessoa);
				return;
            }
			else
			{
                $form_data['erro'] = true;
            }
        }
        
        $this->title = "Sistema Acamp's > Formulário de Incrição";
        $this->css []= 'jquery-ui';
		$this->js  []= 'jquery-ui.min';
		$this->js  []= 'jquery.ui.datepicker-pt-BR';
        
		$this->load->model('cidade');
		$form_data['cidades'] = $this->cidade->listar();
		$form_data['cidades'] = array_reverse($form_data['cidades'], true);
		$form_data['cidades'][0] = 'Selecione...';
		$form_data['cidades'] = array_reverse($form_data['cidades'], true);
		
		$this->load->model('familia');
		$form_data['familias'] = $this->familia->listar();
		$form_data['familias'] = array_reverse($form_data['familias'], true);
		$form_data['familias'][0] = 'Sem família';
		$form_data['familias'] = array_reverse($form_data['familias'], true);
		
        $this->load->view('admin/inscricao_participante', $form_data);
    }

    function servico()
	{
		if($this->input->post('confirmar'))
		{
            $this->load->library('form_validation');
			
			if($this->form_validation->run())
			{
                
                $this->load->model('pessoa_model');
                
                $dados = $_POST;
                unset($dados['confirmar']);
                
				$dados['cd_tipo'] = 's';
                
				// Status -> Pendente Liberação
                $dados['id_status'] = 2;
				
                // ---------------------------------------------------
                // Gravando registro de inscrição e retornando o número de inscrição gerado
				
                $id_pessoa = $this->pessoa_model->inscrever($dados);
                
				// TODO - Logar inscrição feita pelo Sistema Admin
				
                // Salvando Imagem
                // ---------------------------------------------------
                $caminho_foto = $this->_preparar_imagem($id_pessoa);
                if($caminho_foto)
				{
                    $this->pessoa_model->adicionar_foto($id_pessoa, $caminho_foto);
                }
				
                // ---------------------------------------------------
				
                $this->session->set_flashdata('auto_liberar', true);
                redirect('admin/pessoa/'.$id_pessoa);
                return;
            }
			else
			{
                $form_data['erro'] = true;
            }
        }
        
        $this->title = "Sistema Acamp's > Formulário de Incrição";
        $this->css []= 'jquery-ui';
		$this->js  []= 'jquery-ui.min';
		$this->js  []= 'jquery.ui.datepicker-pt-BR';
        
		$this->load->model('cidade');
		$this->load->model('servico');
		
        $form_data['cidades'] = $this->cidade->listar();
		$form_data['cidades'] = array_reverse($form_data['cidades'], true);
		$form_data['cidades'][0] = 'Selecione...';
		$form_data['cidades'] = array_reverse($form_data['cidades'], true);
        
		$form_data['servicos'] = $this->servico->listar();
		$form_data['servicos'] = array_reverse($form_data['servicos'], true);
		$form_data['servicos'][0] = 'Selecione...';
		$form_data['servicos'] = array_reverse($form_data['servicos'], true);
		
        $this->load->view('admin/inscricao_servico', $form_data);
    }

    function cv()
	{
		if($this->input->post('confirmar'))
		{
            $this->load->library('form_validation');
			
			if($this->form_validation->run())
			{
                
                $this->load->model('pessoa_model');
                
                $dados = $_POST;
                unset($dados['confirmar']);
                
				$dados['cd_tipo'] = 'v';
                
				// Status -> Pendente Liberação
                $dados['id_status'] = 2;
				
                // ---------------------------------------------------
                // Gravando registro de inscrição e retornando o número de inscrição gerado
				
                $id_pessoa = $this->pessoa_model->inscrever($dados);
                
				// TODO - Logar inscrição feita pelo Sistema Admin
				
                // Salvando Imagem
                // ---------------------------------------------------
                $caminho_foto = $this->_preparar_imagem($id_pessoa);
                if($caminho_foto)
				{
                    $this->pessoa_model->adicionar_foto($id_pessoa, $caminho_foto);
                }
				
                // ---------------------------------------------------
				
                $this->session->set_flashdata('auto_liberar', true);
                redirect('admin/pessoa/'.$id_pessoa);
                return;
            }
			else
			{
                $form_data['erro'] = true;
            }
        }
        
        $this->title = "Sistema Acamp's > Formulário de Incrição";
        $this->css []= 'jquery-ui';
		$this->js  []= 'jquery-ui.min';
		$this->js  []= 'jquery.ui.datepicker-pt-BR';
        
		$this->load->model('setor');
		$this->load->model('servico');
		
        $form_data['servicos'] = $this->servico->listar();
		$form_data['servicos'] = array_reverse($form_data['servicos'], true);
		$form_data['servicos'][0] = 'Selecione...';
		$form_data['servicos'] = array_reverse($form_data['servicos'], true);
		
        $form_data['setores'] = $this->setor->listar();
		$form_data['setores'] = array_reverse($form_data['setores'], true);
		$form_data['setores'][0] = 'Selecione...';
		$form_data['setores'] = array_reverse($form_data['setores'], true);
		
        $this->load->view('admin/inscricao_cv', $form_data);
    }
	
	function especial()
	{
		if($this->input->post('confirmar'))
		{
			$this->load->library('form_validation');
			
			if($this->form_validation->run())
			{
				$this->load->model('pessoa_model');
				
				$dados = $_POST;
				unset($dados['confirmar']);
                
				$dados['cd_tipo'] = 'e';
                
				// Status -> Pendente Pagamento
                $dados['id_status'] = 2;
				
                // ---------------------------------------------------
                // Gravando registro de inscrição e retornando o número de inscrição gerado
				
                $id_pessoa = $this->pessoa_model->inscrever($dados);
                
				// TODO - Logar inscrição feita pelo Sistema Admin
				
                // ---------------------------------------------------
				
                $this->session->set_flashdata('auto_liberar', true);
                redirect('admin/pessoa/'.$id_pessoa);
                return;
            }
			else
			{
                $form_data['erro'] = true;
            }
        }
        
        $this->title = "Sistema Acamp's > Incrição > Especial";
		
		$this->load->model('servico');
		
        $form_data['servicos'] = $this->servico->listar();
		$form_data['servicos'] = array_reverse($form_data['servicos'], true);
		$form_data['servicos'][0] = 'Selecione...';
		$form_data['servicos'] = array_reverse($form_data['servicos'], true);
		
        $this->load->view('admin/inscricao_especial', $form_data);
    }
    
	function data($str){
        $data = preg_split('/^(0?[1-9]|[1-2][0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/((?:19|20)?\d{2})$/', $str, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
        if(count($data) == 3){
            if(checkdate($data[1], $data[0], $data[2])){
                return implode('/', $data);
            }
        }
        // ELSE
        $this->form_validation->set_message('data', 'A data deve estar no formato: 20/04/1989');
        return false;
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
            if($file['image_width']>160)
                $img_config['width']         = 160;
            if($file['image_height']>160)
                $img_config['height']        = 160;
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