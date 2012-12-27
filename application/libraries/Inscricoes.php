<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inscricoes
{		
	// Instância do super controller
	var $CI;
	
	// Largura máxima das fotos
	var $max_size = 160;
	
	// Se a inscrição foi feita pela internet deve ser TRUE
	// Se foi pelo Sistema Admin deve ser FALSE
	var $open = TRUE;
	
	function __construct($params = array())
	{
		$this->CI =& get_instance(); 
		
		if(isset($params['open']))
		{
			if(is_bool($params['open']))
			{
				$this->open = $params['open'];
			}
		}
	}
	
	function inscrever($tipo = 'p')
	{
		$this->CI->load->model('pessoa_model');
		
		$dados = $_POST;
		$dados['cd_tipo'] = $tipo;
		
		// Pesquisa de divulgação
		if($tipo == 'p')
		{
			$pesquisa = array();
			if(isset($_POST['id_meio'])){
				$pesquisa['id_meio'] = $_POST['id_meio'];
				unset($dados['id_meio']);
				$this->CI->load->model('divulgacao');
				$this->CI->divulgacao->inserir($pesquisa);
			}
			
		}
		
		// Atribuindo status inicial
		if($tipo == 'p')
		{
			$dados['id_status'] = 1; // Status -> Pendente Pagamento
		}
		else
		{
			$dados['id_status'] = 2; // Status -> Pendente Liberação
		}
		
		// Família pode ser escolhida no form de participante do Sistema Admin
		if($tipo == 'p' && !$this->open)
		{
			if($dados['id_familia'] == 0)
			{
				$dados['id_familia'] = NULL;
			}
		}
		
		// Gravando registro e retornando o número de inscrição gerado
		$id = $this->CI->pessoa_model->inscrever($dados);
		
		// Salvando Imagem e atribuindo ônibus
		if($tipo != 'e')
		{
			$caminho_foto = $this->preparar_imagem($id);
			if($caminho_foto){
				$this->CI->pessoa_model->adicionar_foto($id, $caminho_foto);
			}
		}
		
		// Enviando Email
		if($this->open && ENVIRONMENT == 'production'){
			$this->enviar_email($id, $dados['nm_pessoa'], $dados['ds_email']);
		}
		
		if($this->open)
		{
			return array(
				'id_pessoa' => $id,
				'ds_foto' => $this->CI->config->item('base_url').$this->CI->config->item('fotos_dir').$caminho_foto
			);
		}
		else
		{
			return $id;
		}
	}
	
	function preparar_imagem($id)
	{
		//Obtendo as configura��es do arquivo 'config/acamps.php'
		$upload = $this->CI->config->item('upload');
		$upload['file_name'] = $id;
		
		$this->CI->load->library('upload', $upload);
		
		if($this->CI->upload->do_upload('ds_foto'))
		{
			$file = $this->CI->upload->data();
			
			if(strtolower($file['file_type']) == 'image/bmp')
			{
				$image = imagecreatefrombmp($file['full_path']);
				$output_path = $file['file_path'].$file['raw_name'].'.jpg';
				imagejpeg($image, $output_path);
				imagedestroy($image);
				unlink($file['full_path']);
				
				$file['file_name'] = $file['raw_name'].'.jpg';
				$file['file_type'] = 'image/jpeg';
				$file['full_path'] = $output_path;
			}
			
			// Processando Foto
			$img_config['image_library'] = 'gd2';
			$img_config['source_image'] = $file['full_path'];
			$img_config['maintain_ratio'] = TRUE;
			
			if($file['image_width'] > $this->max_size || empty($file['image_width']))
			{
				$img_config['width'] = $this->max_size;
			}
			if($file['image_height'] > $this->max_size || empty($file['image_height']))
			{
				$img_config['height'] = $this->max_size;
			}
			$img_config['quality'] = '100%';
			
			$this->CI->load->library('image_lib', $img_config);
			
			$this->CI->image_lib->resize();
			
			return $file['file_name'];
		}
		return false;
	}
	
	function enviar_email($id_pessoa, $nm_pessoa, $ds_email)
	{
		$this->CI->load->library('email');
		
		$this->CI->email->set_newline("\r\n");
		$this->CI->email->from('acamps@comshalom.org', "Acamp's - Acampamento de Jovens Shalom");
		$this->CI->email->to($ds_email);
		
		$this->CI->email->subject("Inscri��o Realizada");
		
		// TODO - Usar template para as mensagens, para que cada missão tenha sua própria mensagem
		$msg = "<html><body>".
		"<p>".$nm_pessoa."<br/>".
		"Número de Inscrição: <strong>".$id_pessoa."</strong></p>".
		"<br/>".
		"<p><strong>IMPORTANTE - Guarde o número de sua inscrição!</strong></p>".
		"<br/>".
		"<p>Pagar via Boleto no Shalom da Paz, Rua Maria Tomásia, n&deg; 72, Aldeota, Fortaleza:</p>".
		"<p><a href=\"http://projeto.comshalom.org/acamps/".$this->CI->config->item('missao_dir')."/inscricao/boleto/".md5($id_pessoa.$ds_email)."\">Imprimir Boleto</a></p>".
		"</html></body>";
		//***************************************************   
		
		$this->CI->email->message($msg);
		$this->CI->email->send();
	}
}