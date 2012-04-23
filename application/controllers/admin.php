<?php
/* Admin
 *
 * Principal Controller do Sistema Acamp's.
 *
 * Atributos:
 *   template
 *   title
 *   css
 *   js
 * 
 * Métodos:
 *   index
 *   login
 *   buscar
*/
class Admin extends MY_Controller {

    public $template = 'admin_template';
    public $title = "Sistema Acamp's";
    public $css = array('bootstrap', 'admin');
    public $js =  array('jquery.min');

    /* Admin - construtor
     *
     * No contrutor carregamos apenas a biblioteca Session porque ela será
     * usada em todo o Controller.
    */
    function __construct() {
        parent::__construct();
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
            //log_message('error', print_r($usuario,true));
            if($usuario){
                
                $this->session->set_userdata(array(
                    'logado'    => true,
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
        
        $this->template = 'default';
        $this->load->helper('form');
        $this->load->view('admin/login', $view_data);
        
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
    function buscar(){
        
        // Autenticação
        if(!$this->session->userdata('logado')){ // se NÃO está logado
            $this->login();
            return;
        }
		
        $var['resultado'] = false;
        if($this->input->post('buscar')){
			
			// Para escrever a string de consulta novamente no campo de busca, ao retornar a página de resultados
			$var['consulta'] = $this->input->post('consulta');
			
			// Salva a última consulta numa variável de sessão
			$this->session->set_userdata('ultima_consulta', $var['consulta']);
			
		}else if($this->session->userdata('ultima_consulta')){
			
			// Recupera o valor da última consulta
			$var['consulta'] = $this->session->userdata('ultima_consulta');
		}
		
		if(isset($var['consulta'])){
			
			if($var['consulta'] == '*'){
				$consulta = '';
			}else{
				$consulta = $var['consulta'];
			}
			
			$this->load->model('pessoa_model');
			
			// Se a string de consulta contém números, busca pela inscrição
			// Senão busca pelo nome
			if(strpbrk($consulta, '0123456789')){
				$pessoa= $this->pessoa_model->buscar_por_id($consulta);
				if($pessoa){
					$var['resultado'] = array( $pessoa );
				}
			}else{
				$var['resultado'] = $this->pessoa_model->buscar_por_nome($consulta);
			}
        }
		
		$this->load->view('admin/buscar', $var);
		
    }
    
}

?>
