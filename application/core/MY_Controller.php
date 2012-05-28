<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}
	
	/*
	 * REGRAS DE VALIDAÇÃO
	 */
	function telefone($str){
		if(preg_match('/^(\(?\d{2}\)?\s?)?\d{4}-?\d{4}$/i' , $str)){
			return TRUE;
		}else{
			$this->form_validation->set_message('telefone', 'O campo "%s" deve conter um número válido.');
			return FALSE;
		}
	}

	function cep($str){
		if(preg_match('/^\d{5}-?\d{3}$/' , $str)){
			return true;
		}else{
			$this->form_validation->set_message('cep', 'O campo "%s" deve conter um número válido.');
			return false;
		}
	}

	function data($str){
		$data = preg_split('/^(0?[1-9]|[1-2][0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/((?:19|20)?\d{2})$/', $str, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
		if(count($data) == 3){
			if(checkdate($data[1], $data[0], $data[2])){
				return implode('/', $data);
			}
		}
		// ELSE
		$this->form_validation->set_message('data', 'A data deve estar no formato: 20/04/1989');
		return false;
	}
}