<?php

/* Secretaria
 *
 * Contém as funções usadas apenas pela secretaria.
*/

class Secretaria extends CI_Controller {

	/* 
	 * Secretaria - construtor
	*/
	function __construct() {
		parent::__construct();

		// Autenticação
		if(!$this->session->userdata('logado')){
			redirect('admin/login');
		}
		
		$this->template->set_template('admin_template');
		$this->template->set('title', "Sistema Acamp's - Secretaria");
	}

	function historico() {
		
		if(!file_exists($this->config->item('cache_path').'secretaria/log.xml'))
		{
			$log = simplexml_load_string('<?xml version="1.0" encoding="utf-8"?><log></log>');
		}
		else
		{
			$log = simplexml_load_file($this->config->item('cache_path').'secretaria/log.xml');
		}

		$view['log'] = array();
		
		foreach($log->children() as $registro)
		{
			if($registro->tipo == 'p')
			{
				$registro->tipo = 'Participante';
			}
			elseif($registro->tipo == 's')
			{
				$registro->tipo = 'Serviço';
			}
			elseif($registro->tipo == 'cv')
			{
				$registro->tipo = 'Comunidade de Vida';
			}
			elseif($registro->tipo == 'amigos')
			{
				$registro->tipo = "Amigos do Acamp's";
			}
			$view['log'] []= $registro;
		}

		$this->template->load_view('/secretaria/historico', $view);

	}

	function etiqueta($cd_tipo, $folha=false)
	{

		if($this->input->post('gerar'))
		{

			$this->load->model('pessoa_model');

			if($cd_tipo == 'p')
			{
				$ids = $this->input->post('imprimir');
				$pessoas = $this->pessoa_model->etiqueta_participante($ids);

			}
			elseif($cd_tipo == 's')
			{
				$ids = $this->input->post('imprimir');
				$pessoas = $this->pessoa_model->etiqueta_servico($ids);

			}
			elseif($cd_tipo == 'cv')
			{
				$ids = $this->input->post('imprimir');
				$pessoas = $this->pessoa_model->etiqueta_cv($ids);

			}
			elseif($cd_tipo == 'amigos')
			{
				$ids = $this->input->post('imprimir');
				$pessoas = $this->pessoa_model->etiqueta_servico($ids);

				foreach($pessoas as $i => $pessoa)
				{
					$pessoas[$i]['cd_familia'] = $this->input->post($pessoa['id_pessoa']);
					$pessoas[$i]['cd_tipo'] = 'amigos';
				}
			}
			elseif($cd_tipo == 'e')
			{
				$ids = $this->input->post('imprimir');
				$pessoas = $this->pessoa_model->etiqueta_especial($ids);

			}
			elseif($cd_tipo == 'visitante')
			{
				$nomes = $this->input->post('imprimir');
				
				$pessoas = array();
				foreach($nomes as $nome)
				{
					if(!empty($nome))
					{
						$pessoas []= array(
							'cd_tipo'=>'visitante',
							'nm_cracha'=>$nome,
							'nm_pessoa'=>'Visitante'
						);
					}
				}
			}
			
			// Testa se realmente há alguma etiqueta pra ser impressa
			if(count($pessoas) == 0)
			{
				redirect('admin/etiqueta/'.$cd_tipo);
			}

			$this->load->library('fpdf');
			
			$nome_pdf_etiquetas = $this->_pdf_etiquetas($pessoas);
			$nome_pdf_bordas = $this->_pdf_bordas($pessoas);

			$nome_pdf_fotos = "";
			if(ENVIRONMENT != 'acamps' && $cd_tipo != 'e' && $cd_tipo != 'visitante')
			{
				$nome_pdf_fotos = $this->_pdf_fotos($ids);
			}

			if(!file_exists($this->config->item('cache_path').'secretaria/log.xml'))
			{
				$log = simplexml_load_string('<?xml version="1.0" encoding="utf-8"?><log></log>');
			}
			else
			{
				$log = simplexml_load_file($this->config->item('cache_path').'secretaria/log.xml');
			}
			$registro = $log->addChild('registro');
			$registro->addChild('data', date('d/m/Y H:i'));
			$registro->addChild('tipo', $cd_tipo);
			$registro->addChild('fotos', $nome_pdf_fotos);
			$registro->addChild('etiquetas', $nome_pdf_etiquetas);
			$registro->addChild('bordas', $nome_pdf_bordas);
			$log->asXML($this->config->item('cache_path').'secretaria/log.xml');

			$this->template->load_view('secretaria/gerado',array(
				'nr_etiquetas' => count($pessoas),
				'cd_tipo' => $cd_tipo,
				'etiquetas' => $nome_pdf_etiquetas,
				'bordas' => $nome_pdf_bordas,
				'fotos' => $nome_pdf_fotos
			));

		}
		elseif($this->input->post('listar'))
		{

			$this->load->model('pessoa_model');
			if($cd_tipo == 'p')
			{

				$id_ini = $this->input->post('id_ini');
				if(!$id_ini) $id_ini = 0;
				$id_fim = $this->input->post('id_fim');
				if(!$id_fim) $id_fim = 9999;

				$viewdata['pessoas'] = $this->pessoa_model->verifica_etiqueta_participante($id_ini, $id_fim);
				if(count($viewdata['pessoas'])==0)
				{
					redirect('admin/etiqueta/p');
				}

				$viewdata['id_ini'] = $id_ini;
				$viewdata['id_fim'] = $id_fim;

			}
			elseif($cd_tipo == 's')
			{
				
				$id_servico = $this->input->post('id_servico');

				$viewdata['pessoas'] = $this->pessoa_model->verifica_etiqueta_servico($id_servico);
				if(count($viewdata['pessoas'])==0)
				{
					redirect('admin/etiqueta/s');
				}

				$viewdata['id_servico'] = $id_servico;

			}
			elseif($cd_tipo == 'cv')
			{

				$id_setor = $this->input->post('id_setor');

				$viewdata['pessoas'] = $this->pessoa_model->verifica_etiqueta_cv($id_setor);
				if(count($viewdata['pessoas'])==0)
				{
					redirect('admin/etiqueta/cv');
				}

				$viewdata['id_setor'] = $id_setor;

			}

			$viewdata['tipo'] = $cd_tipo;
			$viewdata['form'] = false;
			
			$this->template->add_js('jquery.min.js');
			$this->template->load_view('secretaria/etiquetas_view', $viewdata);

		}
		else
		{
			$viewdata['tipo'] = $cd_tipo;
			
			if($cd_tipo == 'amigos')
			{
				$this->load->model('pessoa_model');
				$viewdata['pessoas'] = $this->pessoa_model->verifica_etiqueta_amigos();

				$this->load->model('familia_model');
				
				$this->template->add_js('jquery.min.js');
				$this->template->load_view('secretaria/etiquetas_view', $viewdata);
				
				return;
			}
			elseif($cd_tipo == 'e')
			{
				$this->load->model('pessoa_model');
				$viewdata['pessoas'] = $this->pessoa_model->verifica_etiqueta_e();
				
				$this->template->add_js('jquery.min.js');
				$this->template->load_view('secretaria/etiquetas_view', $viewdata);
				
				return;
			}
			elseif($cd_tipo == 'visitante')
			{
				$this->template->load_view('secretaria/etiquetas_view', $viewdata);
				
				return;
			}

			$this->load->model('servico_model');
			$this->load->model('setor_model');
			
			$viewdata['form'] = true; // Mostrar o form de verificação das etiquetas
			$this->template->load_view('secretaria/etiquetas_view', $viewdata);
		}
	}

	/*
	* function _pdf_etiquetas
	* 
	* TODO Refatorar para que o tamanho da folha seja dinâmico. Definir variáveis para
	* o tamanho das etiquetas, das margens, dos espaçamento, etc.
	*/
	function _pdf_etiquetas($pessoas) {

		$barcode_path = $this->config->item('barcode_path');

		//$pdf = new FPDF(array('orientation'=>'P', 'unit'=>'mm', 'size'=>'A4'));
		$pdf = new FPDF(array('orientation'=>'P', 'unit'=>'mm', 'size'=>'Letter'));

		//Papel A4 210 x 297
		//$pdf->SetMargins(5,6); // 4 no meio
		//$pdf->SetAutoPageBreak(true,8);
		
		//Papel Carta
		$this->fpdf->SetMargins(4,10); // 5 no meio
		//$this->fpdf->SetAutoPageBreak(true,13);

		$pdf->SetFont('Arial', '', 9);

		$d = 0;
		foreach($pessoas as $pessoa)
		{
			if($d%18 == 0)
			{
				$pdf->AddPage();
				//$x = $pdf->GetX()+102;
				//$y = $pdf->GetY()-25.5;
				$x = $pdf->GetX()-109;
				$y = $pdf->GetY() - 30;
			}
			if($d%2 == 0)
			{
				//$x -= 102;
				//$y += 25.5;
				$x -= 109;
				$y += 25.5;
			}
			else
			{
				//$x += 102;
				$x += 109;
			}
			$pdf->SetXY($x, $y);
			
			$pdf->SetXY($x+3, $y);
			$pdf->SetFont('', 'B', 13);
			// Nome escolhido para o crachá
			$pdf->Write(12.3,utf8_decode($pessoa['nm_cracha']));

			$pdf->SetXY($x+3, $y+7);
			$pdf->SetFont('', '', 9);
			// Nome completo
			$pdf->Write(8.6,utf8_decode($pessoa['nm_pessoa']));
			
			$pdf->SetXY($x+3, $y+10.9);
			$pdf->SetFont('', 'B', 10);
			// Seminário/Aprofundamento ou Nome do serviço
			if($pessoa['cd_tipo'] == 'amigos')
			{
				$pdf->Write(10.3, utf8_decode('Seminário'));
			}
			elseif($pessoa['cd_tipo'] == 'p')
			{
				$pdf->Write(10.3,utf8_decode($pessoa['ds_seminario']));
			}
			elseif($pessoa['cd_tipo'] != 'visitante')
			{
				$pdf->Write(10.3,utf8_decode($pessoa['nm_servico']));
			}
			
			$pdf->SetXY($x+3, $y+16.9);
			$pdf->SetFont('', '', 9);
			// Cidade ou Setor da CV
			if($pessoa['cd_tipo'] == 'v')
			{
				$pdf->Write(8.5, 'CV: '.utf8_decode($pessoa['nm_setor']));
			}
			elseif($pessoa['cd_tipo'] == 'p' || $pessoa['cd_tipo'] == 's')
			{
				$pdf->Write(8.5,utf8_decode($pessoa['nm_cidade']).' / '.$pessoa['cd_estado']);
			}
			
			$pdf->SetXY($x+69, $y); // Correção para etiqueta 2011.1
			if($pessoa['cd_tipo'] == 'p' || $pessoa['cd_tipo'] == 'amigos')
			{
				$pdf->Cell(11,19,$pessoa['id_pessoa'].' / '.$pessoa['cd_familia'],0,0,'C');
			}
			elseif($pessoa['cd_tipo'] != 'visitante')
			{
				$pdf->Cell(11,19,$pessoa['id_pessoa'],0,0,'C');
			}
			
			if($pessoa['cd_tipo'] != 'visitante')
			{
				// Gerando imagem do código de barras, se ela ainda não existir
				if(!file_exists($barcode_path.$pessoa['id_pessoa'].'.png'))
				{
					$this->_barcode($pessoa['id_pessoa']);
				}

				$pdf->SetXY($x+67, $y+11.6); // Correção para etiqueta 2011.1
				// Imprimindo código de barras no PDF
				$pdf->Image($barcode_path.$pessoa['id_pessoa'].'.png');
			}
			
			$d++;
		}
		
		$nome = 'etiquetas '.$pessoas[0]['cd_tipo'].' '.date('d-m H-i').'.pdf';
		
		// Salvando no servidor
		$pdf->Output($this->config->item('cache_path').'secretaria/'.$nome,'F');
		return $nome;
	}
	
	function _pdf_bordas($pessoas) {

		$barcode_path = $this->config->item('barcode_path');

		//$pdf = new FPDF(array('orientation'=>'P', 'unit'=>'mm', 'size'=>'A4'));
		$pdf = new FPDF(array('orientation'=>'P', 'unit'=>'mm', 'size'=>'Letter'));

		//Papel A4 210 x 297
		//$pdf->SetMargins(5,6); // 4 no meio
		//$pdf->SetAutoPageBreak(true,8);
		
		//Papel Carta
		$this->fpdf->SetMargins(4,10); // 5 no meio
		//$this->fpdf->SetAutoPageBreak(true,13);

		$pdf->SetFont('Arial', '', 9);

		$d = 0;
		foreach($pessoas as $pessoa)
		{
			if($d%18 == 0)
			{
				$pdf->AddPage();
				//$x = $pdf->GetX()+102;
				//$y = $pdf->GetY()-25.5;
				$x = $pdf->GetX()-113;
				$y = $pdf->GetY() - 30;
			}
			if($d%2 == 0)
			{
				//$x -= 102;
				//$y += 25.5;
				$x -= 102;
				$y += 25.5;
			}
			else
			{
				//$x += 102;
				$x += 102;
			}
			$pdf->SetXY($x, $y);
			
			$pdf->Rect($x+210, $y, 102, 25.5);
			
			$pdf->SetXY($x, $y);
			
			$pdf->SetXY($x+3, $y);
			$pdf->SetFont('', 'B', 13);
			// Nome escolhido para o crachá
			$pdf->Write(12.3,utf8_decode($pessoa['nm_cracha']));

			$pdf->SetXY($x+3, $y+7);
			$pdf->SetFont('', '', 9);
			// Nome completo
			$pdf->Write(8.6,utf8_decode($pessoa['nm_pessoa']));
			
			$pdf->SetXY($x+3, $y+10.9);
			$pdf->SetFont('', 'B', 10);
			// Seminário/Aprofundamento ou Nome do serviço
			if($pessoa['cd_tipo'] == 'amigos')
			{
				$pdf->Write(10.3, utf8_decode('Seminário'));
			}
			elseif($pessoa['cd_tipo'] == 'p')
			{
				$pdf->Write(10.3,utf8_decode($pessoa['ds_seminario']));
			}
			elseif($pessoa['cd_tipo'] != 'visitante')
			{
				$pdf->Write(10.3,utf8_decode($pessoa['nm_servico']));
			}
			
			$pdf->SetXY($x+3, $y+16.9);
			$pdf->SetFont('', '', 9);
			// Cidade ou Setor da CV
			if($pessoa['cd_tipo'] == 'v')
			{
				$pdf->Write(8.5, 'CV: '.utf8_decode($pessoa['nm_setor']));
			}
			elseif($pessoa['cd_tipo'] == 'p' || $pessoa['cd_tipo'] == 's')
			{
				$pdf->Write(8.5,utf8_decode($pessoa['nm_cidade']).' / '.$pessoa['cd_estado']);
			}
			
			$pdf->SetXY($x+69, $y); // Correção para etiqueta 2011.1
			if($pessoa['cd_tipo'] == 'p' || $pessoa['cd_tipo'] == 'amigos')
			{
				$pdf->Cell(11,19,$pessoa['id_pessoa'].' / '.$pessoa['cd_familia'],0,0,'C');
			}
			elseif($pessoa['cd_tipo'] != 'visitante')
			{
				$pdf->Cell(11,19,$pessoa['id_pessoa'],0,0,'C');
			}
			
			if($pessoa['cd_tipo'] != 'visitante')
			{
				// Gerando imagem do código de barras, se ela ainda não existir
				if(!file_exists($barcode_path.$pessoa['id_pessoa'].'.png'))
				{
					$this->_barcode($pessoa['id_pessoa']);
				}

				$pdf->SetXY($x+67, $y+11.6); // Correção para etiqueta 2011.1
				// Imprimindo código de barras no PDF
				$pdf->Image($barcode_path.$pessoa['id_pessoa'].'.png');
			}
			
			$d++;
		}
		
		$nome = 'bordas '.$pessoas[0]['cd_tipo'].' '.date('d-m H-i').'.pdf';
		
		// Salvando no servidor
		$pdf->Output($this->config->item('cache_path').'secretaria/'.$nome,'F');
		return $nome;
	}

	function _pdf_fotos($ids){

		// Coletando os caminhos das fotos
		$path = $this->config->item('upload_path', 'upload');

		$this->load->model('pessoa_model');
		$fotos = $this->pessoa_model->pegar_fotos($ids);

		$pdf = new FPDF(array('orientation'=>'P', 'unit'=>'mm', 'size'=>'A4'));

		//Papel A4 210 x 297 - Margens: 14mm
		$pdf->SetMargins(10,10);
		$pdf->SetFont('Arial', '', 9);

		$i = 0;
		$lin = 6;
		$col = 4;
		$w = (210-20)/$col;
		$h = (297-20)/$lin;
		foreach ($fotos as $id => $foto)
		{
			if($i%($lin*$col) == 0)
			{
				$pdf->AddPage();
				$x = $pdf->GetX() + ($col-1)*$w; // Para compensar o decremento feito abaixo
				$y = $pdf->GetY() - $h; // Para compensar o decremento feito abaixo
			}
			
			if($i%$col == 0){
				$x-=($col-1)*$w;
				$y+=$h;
			}
			else
			{
				$x+=$w;
			}
			
			$i++;

			$pdf->Image($path.$foto, $x, $y, -102, -102);
			$pdf->Text($x, $y+$h-1, strval($id));
		}

		// Salvando no servidor
		$nome = 'fotos '.date('d-m H-i').'.pdf';
		$pdf->Output($this->config->item('cache_path').'secretaria/'.$nome,'F');

		return $nome;
	}

	function _carta($pessoas) {
		
		$this->load->library('fpdf',array('orientation'=>'P', 'unit'=>'mm', 'format'=>'Letter'));

		//Papel Carta 216 x 279
		$this->fpdf->SetMargins(4,13); // 5 no meio
		$this->fpdf->SetAutoPageBreak(true,13);

		$this->fpdf->SetFont('Arial', '', 9);

		$d = 0;
		foreach($pessoas as $pessoa)
		{
			if($d%20 == 0)
			{
				$this->fpdf->AddPage();
				$x = $this->fpdf->GetX()+106.5;
				$y = $this->fpdf->GetY()-25.5;
			}
			if($d%2 == 0)
			{
				$y += 25.5;
				$x -= 106.5;
			}
			else
			{
				$x += 106.5;
			}
			$this->fpdf->SetXY($x, $y);

			$this->fpdf->SetXY($x+3, $y);
			$this->fpdf->SetFont('', 'B', 13);
			$this->fpdf->Write(12.3,utf8_decode($pessoa['nm_cracha']));

			$this->fpdf->SetXY($x+3, $y+7);
			$this->fpdf->SetFont('', '', 9);
			$this->fpdf->Write(8.6,utf8_decode($pessoa['nm_pessoa']));

			$this->fpdf->SetXY($x+3, $y+10.9);
			$this->fpdf->SetFont('', 'B', 10);
			if($pessoa['cd_tipo'] == 'p')
			{
				$this->fpdf->Write(10.3,utf8_decode($pessoa['ds_seminario']));
			}
			else
			{
				$this->fpdf->Write(10.3,utf8_decode($pessoa['nm_servico']));
			}

			$this->fpdf->SetXY($x+3, $y+16.9);
			$this->fpdf->SetFont('', '', 9);
			if($pessoa['cd_tipo'] == 'v')
			{
				$this->fpdf->Write(8.5, 'CV: '.utf8_decode($pessoa['nm_missao']));
			}
			else
			{
				$this->fpdf->Write(8.5,utf8_decode($pessoa['nm_cidade']).' / '.$pessoa['cd_estado']);
			}
			$this->fpdf->SetXY($x+70, $y);
			if($pessoa['cd_tipo'] == 'p')
			{
				$this->fpdf->Cell(11,19,$pessoa['id_pessoa'].' / '.$pessoa['cd_familia'],0,0,'C');
			}
			else
			{
				$this->fpdf->Cell(11,19,$pessoa['id_pessoa'],0,0,'C');
			}
			//Código de Barras
			if(!file_exists($this->config->item('barcode_path').$pessoa['id_pessoa'].'.png'))
			{
				$this->_barcode($pessoa['id_pessoa']);
			}
			$this->fpdf->SetXY($x+66, $y+11.6);
			$this->fpdf->Image($this->config->item('barcode_path').$pessoa['id_pessoa'].'.png');

			$d++;
		}
		
		$this->fpdf->Output('teste.pdf','I');
	}

	/*
	* function barcode
	* @param $id_pessoa
	*/

	function _barcode($id_pessoa=0) {
		$this->load->helper('barcode');
		$bar = encode_128C($id_pessoa);
		barcode_image($this->config->item('barcode_path').$id_pessoa.'.png', $bar,1,30);
	}

}
