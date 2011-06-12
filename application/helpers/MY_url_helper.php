<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function assets_url($subfolder = '')
{
	$CI =& get_instance();
	return preg_replace('/'.MISSAO_DIR.'.*/', 'assets/',$CI->config->slash_item('base_url')).$subfolder.'/';
}

/* End of file MY_url_helper.php */