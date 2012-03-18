<?php

class Relatorio_model extends CI_Model{

    var $sintetico = 'relatorio_sintetico';
    var $pagamento_por_data = 'relatorio_pagamento';
    var $servico = 'relatorio_servico';
    var $cv = 'relatorio_cv';
    var $familia = 'relatorio_familia';
    var $aniversario = 'relatorio_aniversario';
    var $alimentacao = 'relatorio_alimentacao';
    var $portaria = 'relatorio_porta';
    var $custom = 'relatorio_custom';
    
    function sintetico(){
        $query = $this->db->query('SELECT cd_tipo, id_status, count(*) AS pessoas
                                  FROM pessoa
								  WHERE id_missao = '.$this->config->item('missao').
                                ' GROUP BY cd_tipo, id_status'
								  );
        $tabelas['numeros'] = array();
        foreach($query->result() as $linha){
            $tabelas['numeros'][$linha->cd_tipo][$linha->id_status] = $linha->pessoas;
        }
        //----------------------------------------------------------------------
		$query = $this->db->query('SELECT cd_tipo, ds_sexo, count(*) AS pessoas
									FROM pessoa
									WHERE id_status = 3 AND id_missao = '.$this->config->item('missao').
								  ' GROUP BY cd_tipo, ds_sexo');
        $tabelas['sexo'] = array();
        foreach($query->result() as $linha){
            $tabelas['sexo'][$linha->cd_tipo][$linha->ds_sexo] = $linha->pessoas;
        }
        //----------------------------------------------------------------------
        $query = $this->db->query('SELECT cd_tipo, bl_alimentacao, count(*) AS pessoas
                                  FROM pessoa
                                  WHERE pessoa.id_status = 3 AND id_missao = '.$this->config->item('missao').
                                ' GROUP BY cd_tipo,bl_alimentacao
                                  ORDER BY cd_tipo');
        $tabelas['alimentacao'] = array();
        foreach($query->result() as $linha){
            if($linha->bl_alimentacao){
                $tabelas['alimentacao'][$linha->cd_tipo]['s'] = $linha->pessoas;
            }else{
                $tabelas['alimentacao'][$linha->cd_tipo]['n'] = $linha->pessoas;
            }
        }
        //----------------------------------------------------------------------
        $query = $this->db->query('SELECT cd_tipo, bl_transporte, count(*) AS pessoas
                                    FROM pessoa
                                    WHERE pessoa.id_status = 3 AND id_missao = '.$this->config->item('missao').
                                  ' GROUP BY cd_tipo,bl_transporte
                                    ORDER BY cd_tipo');
        $tabelas['transporte'] = array();
        foreach($query->result() as $linha){
            if($linha->bl_transporte=='t'){
                $tabelas['transporte'][$linha->cd_tipo]['s'] = $linha->pessoas;
            }else{
                $tabelas['transporte'][$linha->cd_tipo]['n'] = $linha->pessoas;
            }
        }
        //----------------------------------------------------------------------
        $query = $this->db->query('SELECT cd_tipo, bl_barracao, count(*) AS pessoas
                                    FROM pessoa
                                    WHERE pessoa.id_status = 3 AND id_missao = '.$this->config->item('missao').
                                  ' GROUP BY cd_tipo,bl_barracao
                                    ORDER BY cd_tipo');
        $tabelas['barracao'] = array();
        foreach($query->result() as $linha){
            if($linha->bl_barracao){
                $tabelas['barracao'][$linha->cd_tipo]['s'] = $linha->pessoas;
            }else{
                $tabelas['barracao'][$linha->cd_tipo]['n'] = $linha->pessoas;
            }
        }
        //----------------------------------------------------------------------
        $query = $this->db->query("SELECT bl_seminario, count(*) AS pessoas
                                    FROM pessoa
                                    WHERE pessoa.id_status = 3 AND cd_tipo='p' AND id_missao = ".$this->config->item('missao').
                                   ' GROUP BY bl_seminario');
        $tabelas['seminario'] = array();
        foreach($query->result() as $linha){
            if($linha->bl_seminario){
                $tabelas['seminario']['s'] = $linha->pessoas;
            }else{
                $tabelas['seminario']['n'] = $linha->pessoas;
            }
        }
        //----------------------------------------------------------------------
        $query = $this->db->query("SELECT bl_fazer_comunhao, count(*) AS pessoas
                                    FROM pessoa
                                    WHERE pessoa.id_status = 3 AND cd_tipo='p' AND id_missao = ".$this->config->item('missao').
                                  " GROUP BY bl_fazer_comunhao");
        $tabelas['eucaristia'] = array();
        foreach($query->result() as $linha){
            if($linha->bl_fazer_comunhao){
                $tabelas['eucaristia']['s'] = $linha->pessoas;
            }else{
                $tabelas['eucaristia']['n'] = $linha->pessoas;
            }
        }
        
        return $tabelas;
    }
    
    /*
     * function pagamento
     * @param $dt_inicio
     * @param $dt_fim
     */
    
    function pagamento($dt_inicio, $dt_fim) {
        
        $this->db->select("pessoa.id_pessoa, pessoa.nm_pessoa, pagamento.nr_pago, pagamento.dt_pgto, usuario.nm_usuario,
                            (CASE WHEN pessoa.cd_tipo='p' THEN 'Participante'
                                WHEN pessoa.cd_tipo='s' THEN 'Serviço' 
                                WHEN pessoa.cd_tipo='v' THEN 'Comunidade de Vida'
                            END) AS nm_tipo,
                            (CASE WHEN pagamento.cd_tipo_pgto = 'd' THEN 'À vista'
                                WHEN pagamento.cd_tipo_pgto = 'c' THEN 'Cheque'
                                WHEN pagamento.cd_tipo_pgto = 'cp' THEN 'Cheque pré-datado'
                            END) AS nm_tipo_pgto")
                ->from('pagamento')
                ->join('pessoa', 'pagamento.id_pessoa = pessoa.id_pessoa', 'left')
                ->join('usuario', 'pagamento.id_usuario = usuario.id_usuario', 'left')
                
                ->where('pessoa.id_missao', $this->config->item('missao'));
        if($dt_inicio==$dt_fim){
            $this->db->where("date_trunc('day', pagamento.dt_pgto) = '".$dt_inicio."'");
        }else{
            $this->db->where("date_trunc('day', pagamento.dt_pgto) BETWEEN '".$dt_inicio."' AND '".$dt_fim."'");
        }
        
        
        $this->db->order_by('dt_pgto, nm_pessoa');
        $query = $this->db->get();
        
        $tabela = array();
        foreach($query->result_array() as $linha){
            $tabela []= $linha; //log_message('ERROR', print_r($linha,true)); // DEBUG
        }
        
        return $tabela;
    }
    
    function servico($id_servico = 0, $id_status = 0){
        $this->db->select("pessoa.id_pessoa, pessoa.nm_pessoa, status.id_status, servico.nm_servico, status.ds_status,
                          (CASE
                            WHEN pessoa.cd_tipo='s' THEN 'Serviço'
                            WHEN pessoa.cd_tipo='v' THEN 'Comunidade de Vida'
                          END)AS nm_tipo")
                ->from('pessoa')
                ->join('servico', 'pessoa.id_servico = servico.id_servico')
                ->join('status', 'pessoa.id_status = status.id_status', 'left')
                ->where('pessoa.id_missao', $this->config->item('missao'));
        if($id_servico){
            $this->db->where('pessoa.id_servico', $id_servico);
        }
        if($id_status){
            $this->db->where('pessoa.id_status', $id_status);
        }
        $this->db->order_by('nm_servico, nm_pessoa');
        
        $query = $this->db->get();
        
        foreach($query->result_array() as $linha){
            $tabela []= $linha; //log_message('ERROR', print_r($linha,true)); // DEBUG
        }
        
        return $tabela;
    }
    
    function cv($id_setor = 0){
        $this->db->select("pessoa.id_pessoa, pessoa.nm_pessoa, servico.nm_servico, setor.id_setor, setor.nm_setor, status.ds_status")
                ->from('pessoa')
                ->join('servico', 'pessoa.id_servico = servico.id_servico', 'left')
                ->join('setor', 'pessoa.id_setor = setor.id_setor')
                ->join('status', 'pessoa.id_status = status.id_status', 'left')
                ->where('pessoa.id_missao', $this->config->item('missao'));
        if($id_setor){
            $this->db->where('pessoa.id_setor', $id_setor);
        }
        $this->db->order_by('nm_setor, nm_pessoa');
        
        $query = $this->db->get();
        
        foreach($query->result_array() as $linha){
            $linha['nm_pessoa'] = ucwords(strtolower($linha['nm_pessoa']));
            $tabela []= $linha; //log_message('ERROR', print_r($linha,true)); // DEBUG
        }
        
        return $tabela;
    }
}