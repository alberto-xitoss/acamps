<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inscricao extends MY_Controller{

	public $template = 'inscricao_template';
	public $title = 'Acampamento de Jovens Shalom';
	public $description = "O Acampamento de Jovens Shalom é um evento promovido pelo Projeto Juventude para Jesus da Comunidade Católica Shalom. A 39ª edição do Acamp's acontecerá dos dias 2 a 7 de Julho de 2012, na fazenda Guarany em Pacajus, a 50km de Fortaleza.";
	public $css = array('inscricao');

	function __construct()
	{
		parent::__construct();
		$this->load->model('cidade');
		$this->load->model('servico');
		$this->load->model('setor');
	}

	function index()
	{
		$this->load->view('inscricao/home');
	}

	function info($tipo)
	{
		$this->title = "Acamp's > Regras de Participação";
		
		$viewdata['tipo'] = $tipo;
		$viewdata['valor'] = ( $tipo=='participante' ? $this->config->item('valor_participante') : $this->config->item('valor_servico') );
		$viewdata['edicao'] = $this->config->item('acamps_edicao');
		$viewdata['periodo'] = $this->config->item('acamps_periodo');
		
		$inicio = DateTime::createFromFormat('j/n/Y', $this->config->item('acamps_inicio'));
		$fim = DateTime::createFromFormat('j/n/Y', $this->config->item('acamps_fim'));
		$prazo = clone $inicio;
		$prazo->sub(new DateInterval('P2D'));
		
		$viewdata['prazo_inscricao'] = $prazo->format('j/n/Y');
		$viewdata['inicio'] = $inicio->format('j/n/Y');
		$viewdata['fim'] = $fim->format('j/n/Y');
		
		$this->load->view('inscricao/normas', $viewdata);
	}

	function participante()
	{
		if($this->input->post('confirmar'))
		{
			$this->load->library('form_validation');
			
			if($this->form_validation->run())
			{
				unset($_POST['confirmar']);
				
				$this->load->library('inscricoes');
				$view_data = $this->inscricoes->inscrever('p');
				
				$view_data['nm_pessoa'] = $_POST['nm_pessoa'];
				$view_data['nm_cracha'] = $_POST['nm_cracha'];
				$view_data['cd_tipo']   = 'p';
				$view_data['ds_email']  = $_POST['ds_email'];
				
				// Página de retorno
				$this->title = "Acamp's > Incrição realizada com Sucesso!";
				$this->load->view('inscricao/sucesso',$view_data);
				return;
			}
			else
			{
				$form_data['erro'] = true;
			}
		}
		
		$this->title = "Acamp's > Formulário de Inscrição";
		//$this->js  []= 'jquery-ui.min';
		//$this->js  []= 'jquery.ui.datepicker-pt-BR';
		//$this->js  []= 'valida.min';
		$this->css []= 'jquery-ui';
		
		$form_data['cidades'] = $this->cidade->listar();
		$form_data['cidades'] = array_reverse($form_data['cidades'], true);
		$form_data['cidades'][0] = 'Selecione...';
		$form_data['cidades'] = array_reverse($form_data['cidades'], true);
		
		$this->load->model('divulgacao');
		$form_data['divulgacao'] = $this->divulgacao->listar_meios();
		$this->load->view('inscricao/participante', $form_data);
	}

	function servico()
	{
		if($this->input->post('confirmar'))
		{
			$this->load->library('form_validation');
			
			if($this->form_validation->run())
			{
				unset($_POST['confirmar']);
				
				$this->load->library('inscricoes');
				$view_data = $this->inscricoes->inscrever('s');
				
				$view_data['nm_pessoa'] = $_POST['nm_pessoa'];
				$view_data['nm_cracha'] = $_POST['nm_cracha'];
				$view_data['cd_tipo']   = 's';
				$view_data['ds_email']  = $_POST['ds_email'];
				
				// Página de retorno
				$this->title = "Acamp's > Incrição realizada com Sucesso!";
				$this->load->view('inscricao/sucesso',$view_data);
				return;
			}
			else
			{
				$form_data['erro'] = true;
			}
		}

		$this->title = "Acamp's > Formulário de Incrição > Serviço";
		//$this->js  []= 'jquery-ui.min';
		//$this->js  []= 'jquery.ui.datepicker-pt-BR';
		//$this->js  []= 'valida.min';
		$this->css []= 'jquery-ui';
		
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

	function cv()
	{
		if($this->input->post('confirmar'))
		{
			$this->load->library('form_validation');
			
			if($this->form_validation->run())
			{
				unset($_POST['confirmar']);
				
				$this->load->library('inscricoes');
				$view_data = $this->inscricoes->inscrever('v');
				
				$view_data['nm_pessoa'] = $_POST['nm_pessoa'];
				$view_data['nm_cracha'] = $_POST['nm_cracha'];
				$view_data['cd_tipo']   = 'v';
				
				// Página de retorno
				$this->title = "Acamp's > Incrição realizada com Sucesso!";
				$this->load->view('inscricao/sucesso',$view_data);
				return;
			}
			else
			{
				$form_data['erro'] = true;
			}
		}

		$this->title = "Acamp's > Formulário de Incrição > Comunidade de Vida";
		//$this->js  []= 'jquery-ui.min';
		//$this->js  []= 'jquery.ui.datepicker-pt-BR';
		//$this->js  []= 'valida.min';
		$this->css []= 'jquery-ui';

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
	
	function boleto($code)
	{
		
		$viewdata['periodo'] = $this->config->item('acamps_periodo');
		
		$inicio = DateTime::createFromFormat('j/n/Y', $this->config->item('acamps_inicio'));
		$fim = DateTime::createFromFormat('j/n/Y', $this->config->item('acamps_fim'));
		
		$viewdata['inicio'] = $inicio->format('j/n');
		$viewdata['fim'] = $fim->format('j/n');
		
		$this->load->model('pessoa_model');
		$dados = $this->pessoa_model->dados_boleto($code);
		
		if($dados)
		{
			$viewdata['dados'] = $dados;
			$viewdata['valor'] = ( $dados['cd_tipo']=='p' ? $this->config->item('valor_participante') : $this->config->item('valor_servico') );
			
			$this->title = "Acamp's - Boleto de Pagamento: ".$dados['id_pessoa'];
			$this->template = 'default';
			$this->css = array('boleto');
			//$this->js = array();
			
			$this->load->view('inscricao/boleto',$viewdata);
		}
		else
		{
			show_404('Boleto de Pagamento');
		}
	}
}