<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Description of pessoa
 *
 */
class Pessoa extends MY_Controller {
	
	/*
	 * Construtor Pessoa
	*/
	function __construct() {
		parent::__construct();
		
		if(!$this->session->userdata('logado')){
			redirect('admin/login');
		}
		
		$this->template->set_template('admin_template');
		$this->template->set('title', "Sistema Acamp's");
	}
	
	/* função detalhes
	 *
	 * Página com os detalhes de um inscrito.
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
			
			$this->template->add_js ('jquery.min.js');
			$this->template->add_js ('bootstrap-modal.js');
			$this->template->load_view('admin/detalhes', array('pessoa'=>$pessoa));
		}else{
			redirect('admin/buscar');
		}
	}
	
	/*
	 * function corrigir
	 * @param $id_pessoa
	 */
	
	function corrigir($id_pessoa)
	{
		
		// Se não for passado um número de inscrição
		if(empty($id_pessoa))
		{
			redirect('admin/buscar');
			return;
		}
		
		//----------------------------------------------------------------------
		
		// Reenviando Foto
		if($this->input->post('adicionar_foto'))
		{
			$this->load->model('pessoa_model');
			
			if($this->pessoa_model->existe($id_pessoa))
			{
				// Salvando Imagem
				$this->load->library('inscricoes');
				$caminho_foto = $this->inscricoes->preparar_imagem($id_pessoa);
				if($caminho_foto)
				{
					$this->pessoa_model->atualizar($id_pessoa, array('ds_foto'=>$caminho_foto));
				}
				
				redirect('admin/pessoa/'.$id_pessoa);
				return;
			}
			else
			{
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
	 * Este é chamado por AJAX.
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
			if($this->config->item('pagamento_simples'))
			{
				$dados['cd_tipo_pgto'] = $this->input->post('cd_tipo_pgto');
				$dados['nr_a_pagar'] = $this->input->post('nr_a_pagar');
				
				if( !( $dados['nr_desconto'] = $this->input->post('nr_desconto') ) )
				{
					$dados['nr_desconto'] = 0;
				}
				
				$dados['nr_pago'] = floatval($dados['nr_a_pagar']) - floatval($dados['nr_desconto']);
				
				$this->pessoa_model->efetuar_pagamento($pessoa->id_pessoa, $dados, $this->session->userdata('id_usuario'));
				
				if($pessoa->cd_tipo == 'p')
				{
					if(empty($pessoa->id_familia))
					{
						$this->load->model('familia');
						$familia = $this->familia->familia_menor();
						$this->pessoa_model->atualizar($pessoa->id_pessoa, array('id_familia'=>$familia));
					}
					
					/*if($pessoa->bl_transporte)
					{
						// Resevando uma vaga no ônibus
						$nr_onibus = $this->pessoa_model->proximo_onibus();
						$this->pessoa_model->escolher_onibus($pessoa->id_pessoa, $nr_onibus);
					}*/
				}
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
			$this->pessoa_model->remover_onibus($id_pessoa);
			
		}elseif($pessoa->cd_tipo == 's' && $pessoa->id_status == '3'){ // Revertendo pagamento de serviço
			
			$this->pessoa_model->estornar_pagamento($id_pessoa);
			$this->pessoa_model->remover_onibus($id_pessoa);
			
		}elseif($pessoa->cd_tipo == 's' && $pessoa->id_status == '1'){ // Revertendo liberação de serviço
			
			$this->pessoa_model->atualizar($id_pessoa, array('id_status' => '2'));
			
		}elseif($pessoa->cd_tipo == 'v' && $pessoa->id_status == '3'){ // Revertendo liberação de CV
			
			$this->pessoa_model->atualizar($id_pessoa, array('id_status' => '2'));
			$this->pessoa_model->remover_onibus($id_pessoa);
			
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
				unset($_POST['confirmar']);
				$this->load->library('inscricoes', array('open'=>FALSE));
				$id_pessoa = $this->inscricoes->inscrever('p');

				//$this->session->set_flashdata('auto_pagar', true);
				redirect('admin/pessoa/'.$id_pessoa);
				return;
			}
			else
			{
				$form_data['erro'] = true;
			}
		}
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
		
		$this->load->model('onibus_local_model');
		$form_data['onibus_locais'] = $this->onibus_local_model->listar();
		$form_data['onibus_locais'] = array_reverse($form_data['onibus_locais'], true);
		$form_data['onibus_locais'][0] = 'Selecione...';
		$form_data['onibus_locais'] = array_reverse($form_data['onibus_locais'], true);
		
		$this->load->model('divulgacao');
		$form_data['divulgacao'] = $this->divulgacao->listar_meios();
		
		$this->template->set('title', "Sistema Acamp's - Incrição de Participante");
		$this->template->add_css('jquery-ui.css');
		$this->template->add_js('jquery.min.js');
		$this->template->add_js('jquery-ui.min.js');
		$this->template->add_js('jquery.ui.datepicker-pt-BR.js');
		$this->template->load_view('admin/inscricao_participante', $form_data);
	}

	function servico()
	{
		if($this->input->post('confirmar'))
		{
			$this->load->library('form_validation');
			
			if($this->form_validation->run())
			{
				unset($_POST['confirmar']);
				$this->load->library('inscricoes', array('open'=>FALSE));
				$id_pessoa = $this->inscricoes->inscrever('s');
				
				//$this->session->set_flashdata('auto_liberar', true);
				redirect('admin/pessoa/'.$id_pessoa);
				return;
			}
			else
			{
				$form_data['erro'] = true;
			}
		}
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
		
		$this->load->model('onibus_local_model');
		$form_data['onibus_locais'] = $this->onibus_local_model->listar();
		$form_data['onibus_locais'] = array_reverse($form_data['onibus_locais'], true);
		$form_data['onibus_locais'][0] = 'Selecione...';
		$form_data['onibus_locais'] = array_reverse($form_data['onibus_locais'], true);
		
		$this->template->set('title', "Sistema Acamp's - Incrição de Serviço");
		$this->template->add_css('jquery-ui.css');
		$this->template->add_js('jquery.min.js');
		$this->template->add_js('jquery-ui.min.js');
		$this->template->add_js('jquery.ui.datepicker-pt-BR.js');
		$this->template->load_view('admin/inscricao_servico', $form_data);
	}

	function cv()
	{
		if($this->input->post('confirmar'))
		{
			$this->load->library('form_validation');
			
			if($this->form_validation->run())
			{
				unset($_POST['confirmar']);
				$this->load->library('inscricoes', array('open'=>FALSE));
				$id_pessoa = $this->inscricoes->inscrever('v');
				
				//$this->session->set_flashdata('auto_liberar', true);
				redirect('admin/pessoa/'.$id_pessoa);
				return;
			}
			else
			{
				$form_data['erro'] = true;
			}
		}
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
		
		$this->load->model('onibus_local_model');
		$form_data['onibus_locais'] = $this->onibus_local_model->listar();
		$form_data['onibus_locais'] = array_reverse($form_data['onibus_locais'], true);
		$form_data['onibus_locais'][0] = 'Selecione...';
		$form_data['onibus_locais'] = array_reverse($form_data['onibus_locais'], true);
		
		$this->template->set('title', "Sistema Acamp's - Incrição de Comunidade de Vida");
		$this->template->add_css('jquery-ui.css');
		$this->template->add_js('jquery.min.js');
		$this->template->add_js('jquery-ui.min.js');
		$this->template->add_js('jquery.ui.datepicker-pt-BR.js');
		$this->template->load_view('admin/inscricao_cv', $form_data);
	}
	
	function especial()
	{
		if($this->input->post('confirmar'))
		{
			$this->load->library('form_validation');
			
			if($this->form_validation->run())
			{
				unset($_POST['confirmar']);
				$this->load->library('inscricoes', array('open'=>FALSE));
				$id_pessoa = $this->inscricoes->inscrever('e');
				
				//$this->session->set_flashdata('auto_liberar', true);
				redirect('admin/pessoa/'.$id_pessoa);
				return;
			}
			else
			{
				$form_data['erro'] = true;
			}
		}
		$this->load->model('servico');
		
		$form_data['servicos'] = $this->servico->listar();
		$form_data['servicos'] = array_reverse($form_data['servicos'], true);
		$form_data['servicos'][0] = 'Selecione...';
		$form_data['servicos'] = array_reverse($form_data['servicos'], true);
		
		$this->template->set('title', "Sistema Acamp's - Incrição de Comunidade de Vida");
		$this->template->load_view('admin/inscricao_especial', $form_data);
	}
}
?>