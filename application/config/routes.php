<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

if(ENVIRONMENT == 'production')
{
	$route['default_controller'] = "inscricao";
}
else
{
	$route['default_controller'] = "admin";
}
$route['404_override'] = '';

/*
| -------------------------------------------------------------------------
| CUSTOM ROUTES
| -------------------------------------------------------------------------
*/

$route['^admin/pessoa/(\d+)$'] = "pessoa/detalhes/$1";

$route['^admin/(liberar.*|pagar.*|reverter.*|excluir.*|corrigir.*)$'] = "pessoa/$1";
$route['^admin/inscrever/(.*)$'] = "pessoa/$1";

$route['^admin/(relatorio.*)$'] = '$1';
$route['^admin/(dev.*)$'] = '$1';
$route['^admin/(etiqueta/.*)$'] = 'secretaria/$1';
$route['^admin/(secretaria.*)$'] = '$1';
$route['^admin/(onibus.*)$'] = '$1';

$route['^admin/(auditar)'] = "financeiro/$1";
$route['^admin/(financeiro.*)'] = "$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */