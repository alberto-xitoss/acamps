<?php

/* Admin
 *
 * Principal Controller do Sistema Acamp's.
*/

class Admin extends CI_Controller {

	/* Admin - construtor
	 *
	 * No contrutor carregamos apenas a biblioteca Session porque ela será
	 * usada em todo o Controller.
	*/
	function __construct()
	{
		parent::__construct();
		
		$this->template->set_template('admin_template');
		$this->template->set('title', "Sistema Acamp's");
	}
	
	/* index
	 *
	 * Método padrão do Controller Admin. Apenas testa a autenticação e leva
	 * para a tela de busca se o usuário estiver logado, caso contrário chama
	 * a tela de login.
   */
	function index() {
		// Autenticação
		if($this->session->userdata('logado')){
			redirect('admin/buscar');
			return;
		}else{
			$this->login();
		}
	}
	
	/* login
	 *
	 * Página com o formulário de login.
   */
	function login(){
		// Autenticação
		if($this->session->userdata('logado')){
			redirect('admin/buscar');
			return;
		}
		
		$view_data = array();
		
		if($this->input->post('login')){
			
			$this->load->model('usuario');
			$usuario = $this->usuario->autenticar($this->input->post('nm_usuario'), $this->input->post('pw_usuario'));
			if($usuario){
				
				$this->session->set_userdata(array(
					'logado'	=> true,
					'id_usuario'=> $usuario->id_usuario,
					'nm_usuario'=> $usuario->nm_usuario,
					'permissao' => $usuario->cd_permissao
				));
				
				redirect('admin/buscar');
				return;
				
			}else{
				$view_data['erro'] = true;
			}
		}
		
		$this->template->set_template('default');
		$this->template->add_css('admin.css');
		$this->template->load_view('admin/login', $view_data);
		
	}
	
	/* logout
	 *
	 * Método que encerra a sessão e salva a data e a hora de logout no
	 * registro do usuário.
   */
	function logout(){
		if($this->session->userdata('logado')){
			$this->load->model('usuario');
			// Salva data do último login
			if($this->db->platform() == 'postgre'){
				$this->usuario->atualizar($this->session->userdata('id_usuario'),array('dt_ultimo_login'=>date('d m Y H:i:s')));
			}elseif($this->db->platform() == 'mysql'){
				$this->usuario->atualizar($this->session->userdata('id_usuario'), array('dt_ultimo_login'=>date('Y-m-d H:i:s')));
			}
		
			$this->session->sess_destroy();
		}
		
		redirect('admin/login');
	}

	/* buscar
	 *
	 * Página principal do sistema, com o formulário de busca de inscritos.
	*/
	function buscar()
	{
		
		// Autenticação
		if(!$this->session->userdata('logado')) // se NÃO está logado
		{
			$this->login();
			return;
		}
		
		$viewdata['resultado'] = false;
		
		if($this->input->post('buscar'))
		{
			// Para escrever a string de consulta novamente no campo de busca, ao retornar a página de resultados
			$viewdata['consulta'] = $this->input->post('consulta');
			
			// Salva a última consulta numa variável de sessão
			if(empty($viewdata['consulta']))
			{
				$this->session->set_userdata('ultima_consulta', '*');
			}
			else
			{
				$this->session->set_userdata('ultima_consulta', $viewdata['consulta']);
			}
		}
		else if($this->session->userdata('ultima_consulta'))
		{
			// Recupera o valor da última consulta
			if($this->session->userdata('ultima_consulta') == '*')
			{
				$viewdata['consulta'] = '';
			}
			else
			{
				$viewdata['consulta'] = $this->session->userdata('ultima_consulta');
			}
		}
		
		if(isset($viewdata['consulta']))
		{
			$this->load->model('pessoa_model');
			
			$this->load->library('pagination');
			
			$config['base_url'] = $this->config->item('base_url') . 'admin/buscar';
			$config['total_rows'] = $this->pessoa_model->count($viewdata['consulta']);
			$config['per_page'] = 14;
			$config['num_links'] = 4;
			$config['first_link'] = 'Primeiros';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'Últimos';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['next_link'] = '&raquo;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&laquo;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			
			$this->pagination->initialize($config);
			
			// Se a string de consulta contém números, busca pela inscrição
			// Senão busca pelo nome
			if(strpbrk($viewdata['consulta'], '0123456789'))
			{
				$pessoa= $this->pessoa_model->buscar_por_id($viewdata['consulta']);
				if($pessoa)
				{
					$viewdata['resultado'] = array( $pessoa );
				}
			}
			else
			{
				$viewdata['resultado'] = $this->pessoa_model->buscar_por_nome($viewdata['consulta'], null, $config['per_page'], $this->uri->segment(3));
			}
		}
		$this->template->load_view('admin/buscar', $viewdata);
	}
}

?>
