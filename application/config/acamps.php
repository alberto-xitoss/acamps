<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Configuração do Sistema Acamp's
 */

$config['missao'] = MISSAO_ID;
$config['missao_nome'] = MISSAO_NOME;
$config['missao_dir'] = MISSAO_DIR;

$config['id_amigos'] = ID_AMIGOS;

$config['modules_locations'] = array(
	APPPATH.'modules/' => '../modules/',
);

// Parâmetros para salvar fotos
$config['upload'] = array(
    'upload_path'   => str_replace('\\','/',FCPATH).'fotos/', // FCPATH é a pasta onde está o arquivo index.php
    'allowed_types' => 'bmp|gif|jpg|png',
    'max_size'      => '4096', // 4MiB
    'max_width'     => '4096',
    'max_height'    => '4096'
);

// Caminho para a pasta das imagens dos códigos de barras
$config['barcode_path'] = str_replace('\\','/',FCPATH).'barcode/';
define('CACHE_PATH', str_replace('\\','/',FCPATH).'cache/');

// Diretório que contém as fotos dos inscritos
$config['fotos_dir'] = 'fotos/';

// Caminhos e URL do sistema de template
$config['template_path'] = APPPATH.'templates/';
$config['js_url'] = ASSETS_URL.'js/';
$config['css_url'] = ASSETS_URL.'css/';
$config['img_url'] = ASSETS_URL.'image/';
