<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
class Missao_config
{
	
	public function load()
	{
		$CI =& get_instance();
		
		$CI->load->model('config_model');
		$missao_config = $CI->config_model->get_all();
		
		//------------------------
		// Configurações da missão
		//------------------------
		
		$CI->config->set_item('missao_nome', $missao_config['missao']);
		$CI->config->set_item('missao_dir', basename(FCPATH));
		
		$CI->config->set_item('valor_participante', $missao_config['valor_participante']);
		$CI->config->set_item('valor_servico', $missao_config['valor_servico']);
		
		$CI->config->set_item('acamps_edicao', $missao_config['edicao']);
		
		$inicio = DateTime::createFromFormat('j/m/Y', $missao_config['data_inicio']);
		$fim = DateTime::createFromFormat('j/m/Y', $missao_config['data_fim']);
		$CI->config->set_item('acamps_inicio', $inicio);
		$CI->config->set_item('acamps_fim', $fim);
		
		$periodo = $inicio->format('j').' a '.$fim->format('j').' de '.traduz_mes($fim->format('F')).' de '.$fim->format('Y');
		
		$CI->config->set_item('acamps_periodo', $periodo);
		
		//---------------------
		// Opções da aplicação
		//---------------------
		
		// Se haverá um form para os participantes se inscrevem, ou só o form interno, dentro do Sistema Admin.
		$CI->config->set_item('form_online', $missao_config['form_online']);
		// Pagamento simplificado - o form só tem a opção do tipo, o valor e o campo de desconto.
		$CI->config->set_item('pagamento_simples', $missao_config['pagamento_simples']);
	}

}