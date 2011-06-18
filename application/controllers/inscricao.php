<?php

class Inscricao extends CI_Controller{

    public $template = 'inscricao_template';
    public $title = 'Acampamento de Jovens Shalom';
    public $css = array('reset', 'inscricao');
    public $js = array();

	function __construct() {
		parent::__construct();
		$this->load->model('cidade');
        $this->load->model('servico');
        $this->load->model('setor');
		$this->load->library('firephp');
	}

    function index(){
        // Como a página inicial tem muitas diferenças das páginas de formulário,
        // usamos o template padrão e fazemos a página separadamente
        $this->template = 'default';
        $this->load->view('inscricao/home');
    }
	
	function v80(){
		$this->load->view('inscricao/home', array('velho'=>true));
	}

    function info($tipo){
        $this->title = "Acamp's > Regras de Participação";
        //$this->load->model('missao');
        //$valor = $this->missao->valor($tipo);
        $this->load->view('inscricao/normas', array('tipo'=>$tipo)/*, array('valor'=>$valor)*/);
    }

    function adote(){
        $this->title = "Acamp's > Adote um Jovem";
        $this->load->view('inscricao/adote');
    }

    function buscarinscricao($tipo){
        $this->title = "Acamp's > Buscar inscrição de Acamp's passado";
        $this->load->view('inscricao/busca', array('tipo'=>$tipo));
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
				
                $view_data['id_pessoa'] = $this->pessoa_model->inscrever($dados);
                $view_data['nm_cracha'] = $dados['nm_cracha'];
                $view_data['cd_tipo']   = $dados['cd_tipo'];
                $view_data['ds_email']  = $dados['ds_email'];
                
				//log_message('ERROR', 'INSCRIÇÃO PARTICIPANTE - '.$view_data['id_pessoa'].' '.$dados['nm_pessoa']);
				
                // Salvando Imagem
                // ---------------------------------------------------
                $caminho_foto = $this->_preparar_imagem($view_data['id_pessoa']);
                if($caminho_foto){
                    $this->pessoa_model->adicionar_foto($view_data['id_pessoa'], $caminho_foto);
                    $view_data['ds_foto'] = $this->config->item('fotos_url').$caminho_foto;
                }
                // ---------------------------------------------------
                
                // Enviando Email
                // ---------------------------------------------------
                if(ENVIRONMENT == 'production'){
					$this->_enviar_email($view_data['id_pessoa'], $dados['nm_pessoa'], $dados['ds_email']);
				}
                // ---------------------------------------------------
                
                // Página de retorno
                $this->title = "Acamp's > Incrição realizada com Sucesso!";
                $this->load->view('inscricao/sucesso',$view_data);
                return;
            }else{
                $form_data['erro'] = true;
            }
        }elseif($this->input->post('buscar_inscricao')){
            $this->load->model('pessoa_model');
            
        }
        
        $this->title = "Acamp's > Formulário de Incrição";
        $this->js  []= 'valida';
        $this->css []= 'jquery.ui.theme';
        $this->css []= 'jquery.ui.datepicker';
		$this->js  []= 'jquery.tiptip.min';
        $this->css []= 'tiptip';
        
        $form_data['cidades'] = $this->cidade->listar();
		$form_data['cidades'] = array_reverse($form_data['cidades'], true);
		$form_data['cidades'][0] = 'Selecione...';
		$form_data['cidades'] = array_reverse($form_data['cidades'], true);
		
        $this->load->view('inscricao/participante', $form_data);
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
                
                $dados['id_status'] = 2; // Status -> Pendente Liberação

                // Gravando registro de inscrição e retornando o número de inscrição gerado
                $view_data['id_pessoa'] = $this->pessoa_model->inscrever($dados);
                $view_data['nm_cracha'] = $dados['nm_cracha'];
				$view_data['cd_tipo']   = $dados['cd_tipo'];
                $view_data['ds_email']  = $dados['ds_email'];
                
				//log_message('ERROR', 'INSCRIÇÃO SERVIÇO - '.$view_data['id_pessoa'].' '.$dados['nm_pessoa']);
                
                // Salvando Imagem
                // ---------------------------------------------------
                $caminho_foto = $this->_preparar_imagem($view_data['id_pessoa']);
                if($caminho_foto){
                    $this->pessoa_model->adicionar_foto($view_data['id_pessoa'], $caminho_foto);
                    $view_data['ds_foto'] = $this->config->item('fotos_url').$caminho_foto;
                }
                // ---------------------------------------------------

                // Enviando Email
                // ---------------------------------------------------
                if(ENVIRONMENT == 'production'){
					$this->_enviar_email($view_data['id_pessoa'], $dados['nm_pessoa'], $dados['ds_email']);
				}
                // ---------------------------------------------------
                
                // Página de retorno
                $this->title = "Acamp's > Incrição realizada com Sucesso!";
                $this->load->view('inscricao/sucesso',$view_data);
                return;
            }else{
                $form_data['erro'] = true;
            }
        }

        $this->title = "Acamp's > Formulário de Incrição > Serviço";
        $this->js  []= 'valida';
        $this->css []= 'jquery.ui.theme';
        $this->css []= 'jquery.ui.datepicker';
		$this->js  []= 'jquery.tiptip.min';
        $this->css []= 'tiptip';
		
		$form_data['cidades'] = $this->cidade->listar();
		$form_data['cidades'] = array_reverse($form_data['cidades'], true);
		$form_data['cidades'][0] = 'Selecione...';
		$form_data['cidades'] = array_reverse($form_data['cidades'], true);
        
		$form_data['servicos'] = $this->servico->listar();
		$form_data['servicos'] = array_reverse($form_data['servicos'], true);
		$form_data['servicos'][0] = 'Selecione...';
		$form_data['servicos'] = array_reverse($form_data['servicos'], true);
		
        $this->load->view('inscricao/servico', $form_data);
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
                
                $dados['id_status'] = 2; // Status -> Pendente Liberação

                // Gravando registro de inscrição e retornando o número de inscrição gerado
                $view_data['id_pessoa'] = $this->pessoa_model->inscrever($dados);
                $view_data['nm_cracha'] = $dados['nm_cracha'];
                $view_data['cd_tipo']   = $dados['cd_tipo'];
                //$view_data['ds_email']  = $dados['ds_email'];
                
				//log_message('ERROR', 'INSCRIÇÃO CV - '.$view_data['id_pessoa'].' '.$dados['nm_pessoa']);
                
                // Salvando Imagem
                // ---------------------------------------------------
				$caminho_foto = $this->_preparar_imagem($view_data['id_pessoa']);
				if($caminho_foto){
					$this->pessoa_model->adicionar_foto($view_data['id_pessoa'], $caminho_foto);
					$view_data['ds_foto'] = $this->config->item('fotos_url').$caminho_foto;
				}
				
                // ---------------------------------------------------
                
                // Página de retorno
                $this->title = "Acamp's > Incrição realizada com Sucesso!";
                $this->load->view('inscricao/sucesso',$view_data);
                return;
            }else{
                $form_data['erro'] = true;
            }
        }

        $this->title = "Acamp's > Formulário de Incrição > Comunidade de Vida";
        $this->js  []= 'valida';
        $this->css []= 'jquery.ui.theme';
        $this->css []= 'jquery.ui.datepicker';
		$this->js  []= 'jquery.tiptip.min';
        $this->css []= 'tiptip';

		$form_data['servicos'] = $this->servico->listar();
		$form_data['servicos'] = array_reverse($form_data['servicos'], true);
		$form_data['servicos'][0] = 'Selecione...';
		$form_data['servicos'] = array_reverse($form_data['servicos'], true);
		
        $form_data['setores'] = $this->setor->listar();
		$form_data['setores'] = array_reverse($form_data['setores'], true);
		$form_data['setores'][0] = 'Selecione...';
		$form_data['setores'] = array_reverse($form_data['setores'], true);
        $this->load->view('inscricao/cv', $form_data);
    }
    
    function boleto($code){
		$this->load->model('pessoa_model');
        $dados = $this->pessoa_model->dados_boleto($code);
        if($dados){
            $this->template = '';
            $this->load->view('inscricao/boleto',$dados);
        }else{
            show_404('Boleto de Pagamento');
        }
    }
    
    function reenviarfoto(){
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            
        }
    }
    
    function _validar(){

        $this->load->library('form_validation');
        
        // Campos comuns a todos os tipos de inscrição
        $this->form_validation->set_rules('nm_pessoa', 'Nome', 'trim|required');
        $this->form_validation->set_rules('nm_cracha', 'Nome no crachá', 'trim|required');
        $this->form_validation->set_rules('dt_nascimento', 'Data de nascimento', 'required|callback_data');
        $this->form_validation->set_rules('ds_sexo', 'Sexo', 'required');
        $this->form_validation->set_rules('bl_alimentacao', 'Alimentação', 'required');
        $this->form_validation->set_rules('bl_alergia_alimento', 'Alergia a alimentos?', 'required');
        if($this->input->post('bl_alergia_alimento') == '1'){
            $this->form_validation->set_rules('nm_alergia_alimento', 'Alergia a quais alimentos?', 'trim|required');
        }
        
        $cd_tipo = $this->input->post('cd_tipo');
        
        // Campos apenas do formulário de participante
        if($cd_tipo == 'p'){
            $this->form_validation->set_rules('bl_seminario','Já fez seminário?', 'required');
            $this->form_validation->set_rules('bl_fez_comunhao','Já fez primeira eucaristia?', 'required');
            if($this->input->post('bl_fez_comunhao') == '0'){
                $this->form_validation->set_rules('bl_fazer_comunhao','Deseja fazer?', 'required');
            }
        }
        
        // Campos comuns aos formulários de participante e serviço
        if($cd_tipo == 'p' || $cd_tipo == 's'){
            $this->form_validation->set_rules('ds_foto', 'Foto', 'required');
            $this->form_validation->set_rules('nr_rg', 'RG', 'trim|required|numeric');
            $this->form_validation->set_rules('ds_endereco','Endereço', 'trim|required');
            $this->form_validation->set_rules('nr_cep','CEP', 'trim|required|callback_cep');
            $this->form_validation->set_rules('ds_bairro', 'Bairro', 'trim|required');
            $this->form_validation->set_rules('id_cidade','Cidade', 'required');
            $this->form_validation->set_rules('bl_barracao','Utilizará o barracão?', 'required');
            $this->form_validation->set_rules('bl_transporte','Precisará de transporte do acampamento?', 'required');
            $this->form_validation->set_rules('bl_alergia_remedio','Alergia a remédios?',  'required');
            if($this->input->post('bl_alergia_remedio') == '1'){
                $this->form_validation->set_rules('nm_alergia_remedio','Alergia a quais remédios?', 'trim|required');
            }
            $this->form_validation->set_rules('ds_email','E-mail', 'trim|required|valid_email');
            $this->form_validation->set_rules('nr_telefone','Telefone ', 'trim|required|telefone');
        }
        
        // Campos comuns aos formulários de serviço e CV
        if($cd_tipo == 's' || $cd_tipo == 'v'){
            $this->form_validation->set_rules('id_servico','Serviço', 'required');
        }
        
        // Campos apenas do formulário de CV
        if($cd_tipo == 'v'){
            $this->form_validation->set_rules('id_setor','Setor', 'required');
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
            if($file['image_width']>200)
                $img_config['width']         = 200;
            if($file['image_height']>200)
                $img_config['height']        = 200;
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
    
    function _enviar_email($id_pessoa, $nm_pessoa, $ds_email){
        $this->load->library('email');
        
        $this->email->set_newline("\r\n");
        $this->email->from('acamps@comshalom.org', "Acamp's - Acampamento de Jovens Shalom");
        $this->email->to($ds_email);
        
        $this->email->subject("Inscrição Realizada");
        
		// TODO - Usar template para as mensagens, para que cada missão tenha sua própria mensagem
        $msg = "<html><body>".
        "<p>".$nm_pessoa."<br/>".
        "Número de Inscrição: <strong>".$id_pessoa."</strong></p>".
        "<br/>".
        "<p><strong>IMPORTANTE - Guarde o número de sua inscrição!</strong></p>".
        "<br/>".
        "<p>Pagar via Boleto no Shalom da Paz, Rua Maria Tomásia, n&deg; 72, Aldeota, Fortaleza:</p>".
        "<p><a href=\"http://projeto.comshalom.org/acamps/fortaleza/inscricao/boleto/".md5($id_pessoa.$ds_email)."\">Imprimir Boleto</a></p>".
        "</html></body>";
        // FIXME - tornar dinâmico para as diferentes missões   ^
        //***************************************************   
        $this->email->message($msg);
        
        $this->email->send();
        //log_message('debug',$this->email->print_debugger());
    }

    /*
     * REGRAS DE VALIDAÇÃO
     */
    function telefone($str){
        if(preg_match('/^(\(?\d{2}\)?\s?)?\d{4}-?\d{4}$/i' , $str)){
            return TRUE;
        }else{
            $this->form_validation->set_message('telefone', 'O campo "%s" deve conter um número válido.');
            return FALSE;
        }
    }

    function cep($str){
        if(preg_match('/^\d{5}-?\d{3}$/' , $str)){
            return true;
        }else{
            $this->form_validation->set_message('cep', 'O campo "%s" deve conter um número válido.');
            return false;
        }
    }

    function data($str){
        $data = preg_split('/^(0?[1-9]|[1-2][0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/((?:19|20)?\d{2})$/', $str, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
        if(count($data) == 3){
            if(checkdate($data[1], $data[0], $data[2])){
                if($this->db->platform() == 'postgre'){
                    return $data[0].' '.$data[1].' '.$data[2];
                }elseif($this->db->platform() == 'mysql'){
                    return $data[2].'-'.$data[1].'-'.$data[0];
                }
                
                // FIXME - Quando há erro no form o campo de data é preenchido com este formato modificado, devemos retornar no formato dd/mm/aaaa
            }
        }
        // ELSE
        $this->form_validation->set_message('data', 'A data deve estar no formato: 20/04/1989');
        return false;
    }
}