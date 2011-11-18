<?php
	
	/*
	 * Coloca as primeiras letras do nome em maiúsculo e o restante em minúsculo
	 * independente de como elas estiverem
	*/
	function normaliza_nome($nome){
		return mb_convert_case($nome, MB_CASE_TITLE, 'UTF-8');
	}
	
	/*
	 * Coloca a data no formato adequado para cada banco de dados
	*/
	function normaliza_data($data){
		$CI =& get_instance();
		if($CI->db->platform() == 'postgre'){
			return implode( ' ', explode('/', $data) );
		}elseif($CI->db->platform() == 'mysql'){
			$dt_array = explode( '/',$data );
			return $dt_array[2].'-'.$dt_array[1].'-'.$dt_array[0];
		}else{
			$data;
		}
	}