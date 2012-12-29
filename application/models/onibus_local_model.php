<?php

class Onibus_local_model extends CI_Model
{	
	public function listar()
	{
		$query = $this->db->query("SELECT id_onibus_local, nm_local FROM onibus_local");
		
		$locais = array();
		foreach ($query->result() as $row) {
			$locais[$row->id_onibus_local] = $row->nm_local;
		}
		
		return $locais;
	}
	
	public function adicionar($nm_local)
	{
		if(is_string($nm_local))
		{
			//$query = $this->db->query("INSERT INTO onibus_local(nm_local) VALUES ($nm_local)");
			$this->db->insert('onibus_local', array('nm_local' => $nm_local));
			
			return $this->db->insert_id();
		}
		return false;
	}
	
	public function remover($id_onibus_local = false)
	{
		if($id_onibus_local)
		{
			$this->db->query("DELETE FROM onibus_local WHERE id_onibus_local = $id_onibus_local");
		}
	}
}