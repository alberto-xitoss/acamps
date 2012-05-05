<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	function __construct()
	{
		
		parent::__construct();
		
		if(ENVIRONMENT == 'development')
		{
			//$this->load->helper('Firelogger');
			//flog("FireLogger Loaded!");
			//$this->output->enable_profiler(TRUE);
		}
		
	}
	
}