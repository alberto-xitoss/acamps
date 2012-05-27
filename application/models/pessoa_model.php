<?php

class Pessoa_model extends CI_Model
{
	var $table = 'pessoa';

	function __construct()
	{
		parent::__construct();
	}
	
	function inscrever($dados)
	{
		
		// Setando valores default para os campos booleanos
		
		if(!isset($dados['bl_alimentacao']))
		{
			$dados['bl_alimentacao'] = '1'; // TRUE
		}
		
		if($dados['cd_tipo']!='v' && !isset($dados['bl_barracao']))
		{
			$dados['bl_barracao'] = '1'; // TRUE
		}
		
		if($dados['cd_tipo']!='v' && !isset($dados['bl_transporte']))
		{
			$dados['bl_transporte'] = '1'; // TRUE
		}
		
		if($dados['cd_tipo']=='p' && !isset($dados['bl_fez_comunhao']))
		{
			$dados['bl_fez_comunhao'] = '1'; // TRUE
		}
		
		if($dados['cd_tipo']=='p' && !isset($dados['bl_fazer_comunhao']))
		{
			$dados['bl_fazer_comunhao'] = '0'; // FALSE
		}
		
		// Normalizando Nome
		if(isset($dados['nm_pessoa']))
		{
			$dados['nm_pessoa'] = normaliza_nome($dados['nm_pessoa']);
		}
		if(isset($dados['nm_cracha']))
		{
			$dados['nm_cracha'] = normaliza_nome($dados['nm_cracha']);
		}
		
		// Normalizando Data de Nascimento
		if(isset($dados['dt_nascimento']))
		{
			
			if($dados['dt_nascimento'] == '')
			{
				unset($dados['dt_nascimento']);
			}
			else
			{
				$dados['dt_nascimento'] = normaliza_data($dados['dt_nascimento']);
			}
		}
		
		$this->db->insert($this->table,$dados);

		// Retorna o número de inscrição gerado
		$retorno = $this->db->insert_id();
		
		return $retorno;
	}

	function adicionar_foto($id_pessoa, $caminho)
	{
		$this->db->where('id_pessoa', $id_pessoa);
		$foto['ds_foto'] = $caminho;
		$this->db->update($this->table, $foto);
	}

	function existe($id_pessoa)
	{
		$query = $this->db->get_where($this->table, array('id_pessoa' => $id_pessoa));
		if($query->row())
			return true;
		else
			return false;
	}

	function buscar_por_id($id_pessoa, $array = false)
	{
		
		$resultado = array();
		
		if(isset($id_pessoa))
		{
			
			$this->db->select("pessoa.*, tipo_inscricao.nm_tipo, status.ds_status, cidade.nm_cidade, familia.*, servico.*, setor.*,
								(CASE
									WHEN pessoa.cd_tipo = 'p' THEN ".$this->config->item('valor_participante')."
									WHEN pessoa.cd_tipo = 's' THEN ".$this->config->item('valor_servico')."
								END) as nr_a_pagar")
					 ->from($this->table)
					 ->join('status', 'pessoa.id_status = status.id_status', 'left')
					 ->join('cidade', 'pessoa.id_cidade = cidade.id_cidade', 'left')
					 ->join('familia', 'pessoa.id_familia = familia.id_familia', 'left')
					 ->join('servico', 'pessoa.id_servico = servico.id_servico', 'left')
					 ->join('setor', 'pessoa.id_setor = setor.id_setor', 'left')
					 ->join('pagamento', 'pessoa.id_pessoa = pagamento.id_pessoa', 'left')
					 ->join('tipo_inscricao', 'pessoa.cd_tipo = tipo_inscricao.cd_tipo')
					 ->where('pessoa.id_pessoa',$id_pessoa);
			$query = $this->db->get();
			
			if($array)
			{
				$resultado = $query->row_array();
			}
			else
			{
				$resultado = $query->row();
			}
		}
		
		if(empty($resultado))
		{
			return false;
		}
		else
		{
			if($this->db->platform() == 'postgre')
			{
				if($array)
				{
					foreach($resultado as $campo => $valor)
					{
						if(substr($campo,0,2)=='bl')
						{
							$resultado[$campo] = ($valor=='t'?true:false);
						}
					}
				}
				else
				{
					$vars = get_object_vars($resultado);
					foreach($vars as $campo => $valor)
					{
						if(substr($campo,0,2)=='bl')
						{
							$resultado->$campo = ($valor=='t'?true:false);
						}
					}
				}
			}
			
			if($array && !empty($resultado['ds_foto']))
			{
				$resultado['nm_foto'] = $resultado['ds_foto'];
				$resultado['ds_foto'] = $this->config->item('base_url').$this->config->item('fotos_dir').$resultado['ds_foto'];
			}
			elseif(!empty($resultado->ds_foto))
			{
				$resultado->nm_foto = $resultado->ds_foto;
				$resultado->ds_foto = $this->config->item('base_url').$this->config->item('fotos_dir').$resultado->ds_foto;
			}
			
			return $resultado;
		}
	}
	
	function buscar_por_nome($nm_pessoa, $limit=false, $offset=false)
	{
		if(isset($nm_pessoa))
		{
			$this->db->select("pessoa.*, tipo_inscricao.nm_tipo, status.ds_status, cidade.nm_cidade, familia.*, servico.*, setor.*,
								(CASE
									WHEN pessoa.cd_tipo = 'p' THEN ".$this->config->item('valor_participante')."
									WHEN pessoa.cd_tipo = 's' THEN ".$this->config->item('valor_servico')."
								END) as nr_a_pagar")
						->from($this->table)
						->join('status', 'pessoa.id_status = status.id_status', 'left')
						->join('tipo_inscricao', 'pessoa.cd_tipo = tipo_inscricao.cd_tipo')
						->join('cidade', 'pessoa.id_cidade = cidade.id_cidade', 'left')
						->join('familia', 'pessoa.id_familia = familia.id_familia', 'left')
						->join('servico', 'pessoa.id_servico = servico.id_servico', 'left')
						->join('setor', 'pessoa.id_setor = setor.id_setor', 'left')
						->like('pessoa.nm_pessoa',normaliza_nome($nm_pessoa))
						->order_by("nm_pessoa", "asc")
						->order_by("id_pessoa", "asc");
			
			if($limit && !$offset)
			{
				$this->db->limit($limit);
			}
			else if($limit && $offset)
			{
				$this->db->limit($limit, $offset);
			}
			
			$query = $this->db->get();
			
			return $query->result();
		}
		
		return array();
	}
	
	/*
	 * Função incompleta
	*/
	function buscar_dados($nome = "", $rg = ""){
		$resultado = array();
		
		if(!empty($rg)){
			$query = $this->db->get("pessoa_anterior");
			
			if($array){
				foreach($query->result_array() as $linha){
					$resultado []= $linha;
				}
			}else{
				foreach($query->result() as $linha){
					$resultado []= $linha;
				}
			}
		}
		
		if(!empty($nome)){
			
			return;
		}
		
		return $resultado;
	}
	
	/*
	 * function consultar_pagamento
	 * @param $id_pessoa
	 */
	function consultar_pagamento($id_pessoa)
	{
		
	}
	
	/*
	 * function efetuar_pagamento
	 *
	 * TODO Ainda não há tratamento de erros.
	 * TODO utilizar TRANSACTIONS, para que não seja criado um registro na
	 * tabela 'pagamento' caso ocorra erro na inserção de cheques.
	 * 
	 * @param $id_pessoa
	 * @param $dados
	 * @param $id_usuario
	 */
	function efetuar_pagamento($id_pessoa, $dados, $id_usuario)
	{
		$pgto = array(
			'id_pessoa' => $id_pessoa,
			'cd_tipo_pgto'=> $dados['cd_tipo_pgto'],
			'nr_a_pagar' => $dados['nr_a_pagar'],
			'nr_pago' => $dados['nr_pago'],
			'nr_desconto' => $dados['nr_desconto'],
			'id_usuario' => $id_usuario,
		);
		
		// Data do pagamento
		if($this->db->platform() == 'postgre')
		{
			$pgto['dt_pgto'] = date('d m Y H:i:s');
		}
		elseif($this->db->platform() == 'mysql')
		{
			$pgto['dt_pgto'] = date('Y-m-d H:i:s');
		}
		
		//log_message('ERROR', 'PGTO - '.print_r($pgto,true));
		$this->db->insert('pagamento', $pgto);
		$id_pgto = $this->db->insert_id();
		
		if(!$this->config->item('pagamento_simples'))
		{
			if($dados['cd_tipo_pgto'] == 'c')
			{
				
				$cheque = array(
					'id_pgto' => $id_pgto,
					'nr_parcela' => $dados['nr_parcela'],
					'nr_valor' => $dados['nr_valor'],
					'nr_cheque' => $dados['nr_cheque'],
					'nr_cheque_dgt' => $dados['nr_cheque_dgt'],
					'nr_comp' => $dados['nr_comp'],
					'nr_banco' => $dados['nr_banco'],
					'nr_agencia' => $dados['nr_agencia'],
					'nr_agencia_dgt' => $dados['nr_agencia_dgt'],
					'nr_conta' => $dados['nr_conta'],
					'nr_conta_dgt' => $dados['nr_conta_dgt'],
					'nm_emitente' => $dados['nm_emitente'],
					'ds_cidade' => $dados['ds_cidade'],
					'ds_estado' => $dados['ds_estado'],
					'nr_telefone' => $dados['nr_telefone'],
					'ds_obs' => $dados['ds_obs'],
					'dt_pgto' => $pgto['dt_pgto'],
					'dt_emissao' => $pgto['dt_pgto'],
					'dt_bompara' => $pgto['dt_pgto'],
					'id_missao' => $this->config->item('missao')
				);
				$this->inserir_cheque($cheque);
				
			}
			elseif($dados['cd_tipo_pgto'] == 'cp')
			{
				
				$cheque = array(
					'id_pgto' => $id_pgto,
					'nr_comp' => $dados['nr_comp'],
					'nr_banco' => $dados['nr_banco'],
					'nr_agencia' => $dados['nr_agencia'],
					'nr_agencia_dgt' => $dados['nr_agencia_dgt'],
					'nr_conta' => $dados['nr_conta'],
					'nr_conta_dgt' => $dados['nr_conta_dgt'],
					'nm_emitente' => $dados['nm_emitente'],
					'ds_cidade' => $dados['ds_cidade'],
					'ds_estado' => $dados['ds_estado'],
					'nr_telefone' => $dados['nr_telefone'],
					'ds_obs' => $dados['ds_obs'],
					'dt_pgto' => $pgto['dt_pgto'],
					'dt_emissao' => $pgto['dt_pgto'],
					'dt_bompara' => $pgto['dt_pgto'],
					'id_missao' => $this->config->item('missao')
				);
				for($i=1; $i<=$dados['qnt_cp']; $i++)
				{
					$cheque['nr_parcela'] = $i;
					$cheque['nr_valor'] = $dados['nr_valor'.$i];
					$cheque['nr_cheque'] = $dados['nr_cheque'.$i];
					$cheque['nr_cheque_dgt'] = $dados['nr_cheque_dgt'.$i];
					$this->inserir_cheque($cheque);
				}
			}
		}
		
		$this->db->set('id_status', '3');
		$this->db->where('id_pessoa',$id_pessoa);
		$this->db->update($this->table);
		
		//log_message('ERROR', 'Realizando Pagamento | Pessoa-> '.$id_pessoa.' | Pagamento -> '.$id_pgto);
	}
	
	/*
	 * function estornar_pagamento
	 * 
	 * @param $id_pessoa
	 */
	function estornar_pagamento($id_pessoa)
	{
		
		$this->db->select('id_pgto, cd_tipo_pgto')->where('id_pessoa', $id_pessoa);
		$query = $this->db->get('pagamento');
		
		$pgto = $query->row();
		if(!$pgto)
		{
			return;
		}
		
		// Apagando cheques
		if(!$this->config->item('pagamento_simples'))
		{
			if($pgto->cd_tipo_pgto != 'd')
			{
				$this->excluir_cheque($pgto->id_pgto);
			}
		}
		
		// Apagando registro de pagamento
		$this->db->where('id_pgto', $pgto->id_pgto);
		$this->db->delete('pagamento');
		
		$this->db->set('id_status', '1');
		$this->db->where('id_pessoa',$id_pessoa);
		$this->db->update($this->table);
		
		//log_message('ERROR', 'Estornando Pagamento | Pessoa -> '.$id_pessoa.' | Pagamento -> '.$pgto->id_pgto);
	}
	
	function inserir_cheque($dados)
	{
		$this->db->insert('cheque', $dados);
	}
	function excluir_cheque($id_pgto)
	{
		$this->db->where('id_pgto', $id_pgto)->where('id_missao', $this->config->item('missao'));
		$this->db->delete('cheque');
		
		//log_message('ERROR', 'Excluindo Cheque -> '.$id_pgto);
	}

	function dados_boleto($code)
	{
		$this->db->select("pessoa.*, tipo_inscricao.nm_tipo, cidade.nm_cidade, servico.*,
							(CASE
								WHEN pessoa.cd_tipo = 'p' THEN ".$this->config->item('valor_participante')."
								WHEN pessoa.cd_tipo = 's' THEN ".$this->config->item('valor_servico')."
							END) as nr_a_pagar")
							->from($this->table)
							->join('tipo_inscricao', 'pessoa.cd_tipo = tipo_inscricao.cd_tipo', 'left')
							->join('cidade', 'pessoa.id_cidade = cidade.id_cidade', 'left')
							->join('servico', 'pessoa.id_servico = servico.id_servico', 'left')
							->join('pagamento', 'pessoa.id_pessoa = pagamento.id_pessoa', 'left');
							
		if($this->db->platform() == 'postgre')
		{
			$this->db->where('md5(pessoa.id_pessoa||ds_email)', $code);
		}
		elseif($this->db->platform() == 'mysql')
		{
			$this->db->where('md5(concat(pessoa.id_pessoa,ds_email))', $code);
		}
		$query = $this->db->limit(1);
		$query = $this->db->get();
		
		if($query->num_rows() == 1)
		{
			$row = $query->row_array();
			
			$query_pgto = $this->db->get_where('pagamento', array('id_pessoa'=>$row['id_pessoa']));
			$pgto = $query_pgto->row_array();
			$row = array_merge($row, $pgto);
			
			$query_pgto = $this->db->get_where('cidade', array('id_cidade'=>$row['id_cidade']));
			$pgto = $query_pgto->row_array();
			$row = array_merge($row, $pgto);
			
			if($row['cd_tipo']=='s')
			{
				$this->db->select('nm_servico')->from('servico')->where('id_servico',$row['id_servico']);
				$query_serv = $this->db->get();
				$servico = $query_serv->row_array();
				$row['nm_servico'] = $servico['nm_servico'];
			}
			return $row;
		}
		else
		{
			return false;
		}
	}

	function atualizar($id_pessoa, $campos)
	{
		
		foreach($campos as $campo => $valor)
		{
			if($campo == 'nm_pessoa')
			{
				$valor = normaliza_nome($valor);
			}
			if($campo == 'nm_cracha')
			{
				$valor = normaliza_nome($valor);
			}
			if($campo == 'id_familia' && $valor == 0){
				$valor = NULL;
			}
			$this->db->set($campo, $valor);
		}
		$this->db->where('id_pessoa',$id_pessoa);
		$this->db->update($this->table);
		
		//log_message('ERROR', 'Pessoa Atualizada -> '.$id_pessoa);
	}

	function excluir($id_pessoa)
	{
		
		$pessoa = $this->buscar_por_id($id_pessoa);
		
		if(!empty($pessoa->nm_foto))
		{
			if(file_exists($this->config->item('upload_path', 'upload').$pessoa->nm_foto))
			{
				unlink($this->config->item('upload_path', 'upload').$pessoa->nm_foto);
			}
		}
		
		$this->db->where('id_pessoa', $id_pessoa);
		$this->db->delete($this->table);
		
		//log_message('ERROR', 'Excluindo Pessoa -> '.$id_pessoa);
		
	}
	
	function verifica_etiqueta_participante($id_ini=0, $id_fim=9999)
	{
		$this->db->select(" pessoa.id_pessoa,
							pessoa.nm_pessoa,
							pessoa.bl_cracha,
							familia.cd_familia,
							familia.nm_familia,
							(CASE
							WHEN pessoa.bl_seminario = TRUE THEN 'Seminário'
							WHEN pessoa.bl_seminario = FALSE THEN 'Aprofundamento'
							END) as ds_seminario")
							->from("pessoa")
							->join("familia", "pessoa.id_familia = familia.id_familia")
							->where("pessoa.id_status = 3")
							->where("pessoa.cd_tipo = 'p'")
							->where("pessoa.id_pessoa BETWEEN ".$id_ini." AND ".$id_fim)
							->order_by("pessoa.id_pessoa");
		$query = $this->db->get();
		
		$tabela = array();
		foreach($query->result_array() as $pessoa)
		{
			
			if($this->db->platform() == 'postgre')
			{
				foreach($pessoa as $campo => $valor)
				{
					if(substr($campo,0,2)=='bl')
					{
						$pessoa[$campo] = ($valor=='t'?true:false);
					}
				}
			}
			
			$tabela []= $pessoa;
		}
		
		return $tabela;
	}
	
	function verifica_etiqueta_servico($id_servico=0)
	{
		$this->load->model('servico');
		$id_amigos = $this->servico->id_amigos();
		
		$this->db->select(" pessoa.id_pessoa,
							pessoa.nm_pessoa,
							pessoa.bl_cracha,
							servico.nm_servico")
				->from("pessoa")
				->join("servico", "pessoa.id_servico = servico.id_servico")
				->where("pessoa.id_status = 3")
				->where("pessoa.id_servico <> ".$id_amigos)
				->where("pessoa.cd_tipo = 's'");
				
		if($id_servico)
		{
			$this->db->where('pessoa.id_servico', $id_servico);
		}
		
		$query = $this->db->get();
		
		$tabela = array();
		foreach($query->result_array() as $pessoa)
		{
			
			if($this->db->platform() == 'postgre')
			{
				foreach($pessoa as $campo => $valor)
				{
					if(substr($campo,0,2)=='bl')
					{
						$pessoa[$campo] = ($valor=='t'?true:false);
					}
				}
			}
			
			$tabela []= $pessoa;
		}
		
		return $tabela;
	}
	
	function verifica_etiqueta_cv($id_setor=0)
	{
		$this->load->model('servico');
		$id_amigos = $this->servico->id_amigos();
		
		$this->db->select(" pessoa.id_pessoa,
							pessoa.nm_pessoa,
							pessoa.bl_cracha,
							setor.nm_setor,
							servico.nm_servico")
				->from("pessoa")
				->join("setor", "pessoa.id_setor = setor.id_setor")
				->join("servico", "pessoa.id_servico = servico.id_servico")
				->where("pessoa.id_status = 3")
				->where("pessoa.id_servico <> ".$id_amigos)
				->where("pessoa.cd_tipo = 'v'");
		
		if($id_setor){
			$this->db->where('pessoa.id_setor', $id_setor);
		}
		
		$query = $this->db->get();
		
		$tabela = array();
		foreach($query->result_array() as $pessoa)
		{
			
			if($this->db->platform() == 'postgre')
			{
				foreach($pessoa as $campo => $valor)
				{
					if(substr($campo,0,2)=='bl')
					{
						$pessoa[$campo] = ($valor=='t'?true:false);
					}
				}
			}
			
			$tabela []= $pessoa;
		}
		
		return $tabela;
	}
	
	function verifica_etiqueta_e()
	{
		$this->load->model('servico');
		$id_amigos = $this->servico->id_amigos();
		
		$this->db->select(" pessoa.id_pessoa,
							pessoa.nm_pessoa,
							pessoa.bl_cracha,
							servico.nm_servico")
				->from("pessoa")
				->join("servico", "pessoa.id_servico = servico.id_servico")
				->where("pessoa.id_status = 3")
				->where("pessoa.id_servico <> ".$id_amigos)
				->where("pessoa.cd_tipo = 'e'");
		
		$query = $this->db->get();
		
		$tabela = array();
		foreach($query->result_array() as $pessoa)
		{
			
			if($this->db->platform() == 'postgre')
			{
				foreach($pessoa as $campo => $valor)
				{
					if(substr($campo,0,2)=='bl')
					{
						$pessoa[$campo] = ($valor=='t'?true:false);
					}
				}
			}
			
			$tabela []= $pessoa;
		}
		
		return $tabela;
	}
	
	function verifica_etiqueta_amigos()
	{
		$this->load->model('servico');
		$id_amigos = $this->servico->id_amigos();
		
		$this->db->select(" pessoa.id_pessoa,
							pessoa.nm_pessoa,
							pessoa.bl_cracha")
				->from("pessoa")
				->join("servico", "pessoa.id_servico = servico.id_servico")
				->where("pessoa.id_status = 3")
				->where("pessoa.cd_tipo = 's'")
				->where("pessoa.id_servico", $id_amigos)
				->order_by("pessoa.id_pessoa");
		$query = $this->db->get();
		
		$tabela = array();
		foreach($query->result_array() as $pessoa)
		{
			
			if($this->db->platform() == 'postgre')
			{
				foreach($pessoa as $campo => $valor)
				{
					if(substr($campo,0,2)=='bl')
					{
						$pessoa[$campo] = ($valor=='t'?true:false);
					}
				}
			}
			
			$tabela []= $pessoa;
		}
		
		return $tabela;
	}
	
	function etiqueta_participante($ids)
	{
		$this->db->select(" pessoa.id_pessoa,
							pessoa.nm_pessoa,
							pessoa.nm_cracha,
							pessoa.cd_tipo,
							pessoa.ds_foto,
							cidade.nm_cidade,
							cidade.cd_estado,
							familia.cd_familia,
							(CASE
							WHEN pessoa.bl_seminario = TRUE THEN 'Seminário'
							WHEN pessoa.bl_seminario = FALSE THEN 'Aprofundamento'
							END) as ds_seminario")
							->from("pessoa")
							->join("familia", "pessoa.id_familia = familia.id_familia")
							->join("cidade", "pessoa.id_cidade = cidade.id_cidade")
							->where("pessoa.id_status = 3")
							->where("pessoa.cd_tipo = 'p'")
							->where_in("pessoa.id_pessoa", $ids)
							->order_by("pessoa.id_pessoa");
		$query = $this->db->get();
		
		$tabela = $query->result_array();
		
		// Incrementando contador de crachás
		if($this->db->platform() == 'postgre')
		{
			$this->db->set('bl_cracha','TRUE');
		}
		elseif($this->db->platform() == 'mysql')
		{
			$this->db->set('bl_cracha',true);
		}
		
		$this->db->set('nr_cracha', 'nr_cracha + 1', FALSE)
		//$this->db->set('nr_cracha', 1)
				->where("pessoa.id_status = 3")
				->where("pessoa.cd_tipo = 'p'")
				->where_in("pessoa.id_pessoa", $ids);
		
		$this->db->update($this->table);
		
		return $tabela;
	}
	
	function etiqueta_servico($ids){
		$this->db->select(" pessoa.id_pessoa,
							pessoa.nm_pessoa,
							pessoa.nm_cracha,
				pessoa.cd_tipo,
				pessoa.ds_foto,
							cidade.nm_cidade,
							cidade.cd_estado,
							servico.nm_servico")
				->from("pessoa")
				->join("servico", "pessoa.id_servico = servico.id_servico")
				->join("cidade", "pessoa.id_cidade = cidade.id_cidade")
				->where("pessoa.id_status = 3")
				->where("pessoa.cd_tipo = 's'")
				->where_in("pessoa.id_pessoa", $ids)
				->order_by('pessoa.id_pessoa');
		$query = $this->db->get();
		
		$tabela = $query->result_array();
		
		// Incrementando contador de crachás
		if($this->db->platform() == 'postgre'){
			$this->db->set('bl_cracha','TRUE');
		}elseif($this->db->platform() == 'mysql'){
			$this->db->set('bl_cracha',true);
		}
		
		$this->db->set('nr_cracha', 'nr_cracha + 1', FALSE)
		//$this->db->set('nr_cracha', 1)
				->where("pessoa.id_status = 3")
				->where("pessoa.cd_tipo = 's'")
				->where_in("pessoa.id_pessoa", $ids);
		
		$this->db->update($this->table);
		
		return $tabela;
	}
	
	function etiqueta_cv($ids)
	{
		$this->db->select(" pessoa.id_pessoa,
							pessoa.nm_pessoa,
							pessoa.nm_cracha,
				pessoa.cd_tipo,
				pessoa.ds_foto,
							setor.nm_setor,
							servico.nm_servico")
				->from("pessoa")
				->join("servico", "pessoa.id_servico = servico.id_servico")
				->join("setor", "pessoa.id_setor = setor.id_setor")
				->where("pessoa.id_status = 3")
				->where("pessoa.cd_tipo = 'v'")
				->where_in("pessoa.id_pessoa", $ids)
				->order_by('pessoa.id_pessoa');
		$query = $this->db->get();
		
		$tabela = $query->result_array();
		
		// Incrementando contador de crachás
		if($this->db->platform() == 'postgre')
		{
			$this->db->set('bl_cracha','TRUE');
		}
		elseif($this->db->platform() == 'mysql')
		{
			$this->db->set('bl_cracha',true);
		}
		
		$this->db->set('nr_cracha', 'nr_cracha + 1', FALSE)
		//$this->db->set('nr_cracha', 1)
				->where("pessoa.id_status = 3")
				->where("pessoa.cd_tipo = 'v'")
				->where_in("pessoa.id_pessoa", $ids);
		
		$this->db->update($this->table);
		
		return $tabela;
	}
	
	function etiqueta_especial($ids)
	{
		$this->db->select(" pessoa.id_pessoa,
							pessoa.nm_pessoa,
							pessoa.nm_cracha,
							pessoa.cd_tipo,
							servico.nm_servico")
				->from("pessoa")
				->join("servico", "pessoa.id_servico = servico.id_servico")
				->where("pessoa.id_status = 3")
				->where("pessoa.cd_tipo = 'e'")
				->where_in("pessoa.id_pessoa", $ids)
				->order_by('pessoa.id_pessoa');
		$query = $this->db->get();
		
		$tabela = $query->result_array();
		
		// Incrementando contador de crachás
		if($this->db->platform() == 'postgre')
		{
			$this->db->set('bl_cracha','TRUE');
		}
		elseif($this->db->platform() == 'mysql')
		{
			$this->db->set('bl_cracha',true);
		}
		
		$this->db->set('nr_cracha', 'nr_cracha + 1', FALSE)
		//$this->db->set('nr_cracha', 1)
				->where("pessoa.id_status = 3")
				->where("pessoa.cd_tipo = 'e'")
				->where_in("pessoa.id_pessoa", $ids);
		
		$this->db->update($this->table);
		
		return $tabela;
	}
	
	function pegar_fotos($ids)
	{
		$this->db->select("id_pessoa, ds_foto")
				->from("pessoa")
				->where_in("id_pessoa", $ids)
				->order_by('id_pessoa');
		$query = $this->db->get();
		
		$fotos = array();
		foreach ($query->result_array() as $row)
		{
			if(!empty($row['ds_foto'])){ $fotos[$row['id_pessoa']] = $row['ds_foto']; }
		}
		
		return $fotos;
	}
	
	function zerar_etiquetas()
	{
		if($this->db->platform() == 'postgre')
		{
			$this->db->set('bl_cracha','FALSE');
		}
		elseif($this->db->platform() == 'mysql')
		{
			$this->db->set('bl_cracha', FALSE);
		}
		$this->db->set('nr_cracha', 0)->update('pessoa');
	}
	
	function esvaziar(){
		$query = $this->db->get('pessoa');
		
		foreach($query->result_array() as $linha){
			unset($linha['id_pessoa']);
			unset($linha['cd_tipo']);
			unset($linha['id_status']);
			unset($linha['id_familia']);
			unset($linha['bl_seminario']);
			unset($linha['bl_cracha']);
			unset($linha['nr_cracha']);
			unset($linha['dt_alteracao']);
			unset($linha['nr_boleto']);
			
			$this->db->insert('pessoa_anterior',$linha);
		}
		
		// Essa query apaga as tabelas "pessoa", "pagamento" e "cheques"
		$this->db->query('TRUNCATE pessoa CASCADE');
	}
}