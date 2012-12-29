<?php

class Onibus_saida_model extends CI_Model
{	
	public function proximo_onibus()
	{
		// Verificando qual ônibus tem vaga
		$query = $this->db->query("SELECT nr_onibus, count(*) as nr_pessoas
									FROM onibus
									WHERE nr_onibus < 100
									GROUP BY nr_onibus
									ORDER BY nr_onibus ASC");
		
		if($query->num_rows() == 0) // Se nenhum �nibus come�ou a ser preeenchido
		{
			$nr_onibus = 1; // Seleciona o �nibus 1
		}
		else
		{
			foreach ($query->result() as $row)
			{
				if($row->nr_pessoas < 44) // Total de vagas � 46 -- 2 vagas s�o reservadas para o coordenador e seu assistente
				{
					$nr_onibus = $row->nr_onibus;
					break;
				}
			}
			if(!isset($nr_onibus))
			{
				$nr_onibus = $query->num_rows() + 1;
			}
		}
		return $nr_onibus;
	}
	
	public function listar_onibus()
	{
		return $this->db->query("SELECT nr_onibus, count(*) as nr_pessoas FROM onibus GROUP BY nr_onibus")->result();
	}
	
	public function escolher_onibus($id_pessoa = false, $nr_onibus = false)
	{
		if($id_pessoa && $nr_onibus)
		{
			$query = $this->db->query("INSERT INTO onibus(id_pessoa, nr_onibus) VALUES ($id_pessoa, $nr_onibus)");
		}
	}
	
	public function remover_onibus($id_pessoa = false)
	{
		if($id_pessoa)
		{
			$this->db->query("DELETE FROM onibus WHERE id_pessoa = $id_pessoa");
		}
	}
}