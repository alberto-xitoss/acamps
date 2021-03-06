<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
class Missao_config
{
	
	public function load()
	{
		$CI =& get_instance();
		
		if($CI->db->table_exists('configuracao'))
		{
			$CI->load->model('config_model');
			
			$missao_config = $CI->config_model->get_all();

			// FIXME
			if(empty($missao_config)){
				return;
			}
			
			//------------------------
			// Configurações da missão
			//------------------------
			
			$CI->config->set_item('missao_nome', $missao_config['missao']);
			$CI->config->set_item('missao_dir', basename(FCPATH));
			
			$CI->config->set_item('valor_participante', $missao_config['valor_participante']);
			$CI->config->set_item('valor_servico', $missao_config['valor_servico']);
			
			$CI->config->set_item('acamps_edicao', $missao_config['edicao']);
			
			$inicio = DateTime::createFromFormat('j/n/Y', $missao_config['data_inicio']);
			$fim = DateTime::createFromFormat('j/n/Y', $missao_config['data_fim']);
			
			$CI->config->set_item('acamps_inicio', $inicio->format('j/n/Y'));
			$CI->config->set_item('acamps_fim', $fim->format('j/n/Y'));
			
			$periodo = $inicio->format('j').' a '.$fim->format('j').' de '.traduz_mes($fim->format('F')).' de '.$fim->format('Y');
			
			$CI->config->set_item('acamps_periodo', $periodo);
			
			//---------------------
			// Opções da aplicação
			//---------------------
			
			// Se haver� um form para os participantes se inscrevem, ou s� o form interno, dentro do Sistema Admin.
			$CI->config->set_item('form_online', $missao_config['form_online']);
			// Pagamento simplificado: o form s� tem a op��o do tipo de pagamento, o valor e o campo de desconto.
			$CI->config->set_item('pagamento_simples', $missao_config['pagamento_simples']);
		} else {
			//---------------------
			// O que fazer?
			//---------------------
		}
	}

}