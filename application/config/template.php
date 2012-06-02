<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Configuração da biblioteca Template
|--------------------------------------------------------------------------
|
*/

$config['template_dir'] = 'templates/';
$config['default_template'] = "default";

/*
|--------------------------------------------------------------------------
| Configurando assets
|--------------------------------------------------------------------------
|
| 
|
*/

$config['assets_url'] = 'http://'.$_SERVER['SERVER_NAME'].'/acamps/assets/';
$config['js_url'] = $config['assets_url'].'js/';
$config['css_url'] = $config['assets_url'].'css/';
$config['img_url'] = $config['assets_url'].'image/';
