<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Caminho para a pasta das imagens dos códigos de barras
|--------------------------------------------------------------------------
|
| 
|
*/

$config['barcode_path'] = str_replace('\\','/',FCPATH).'barcode/';
$config['cache_path'] = str_replace('\\','/',FCPATH).'cache/';

/*
|--------------------------------------------------------------------------
| Diretório que contém as fotos dos inscritos
|--------------------------------------------------------------------------
|
| 
|
*/

$config['fotos_dir'] = 'fotos/';

/*
|--------------------------------------------------------------------------
| Parâmetros para salvar fotos
|--------------------------------------------------------------------------
|
| 
|
*/

$config['upload'] = array(
    'upload_path'   => str_replace('\\','/',FCPATH).$config['fotos_dir'], // FCPATH é a pasta onde está o arquivo index.php
    'allowed_types' => 'bmp|gif|jpg|png',
    'max_size'      => '8192', // 8MiB
    'max_width'     => '4096',
    'max_height'    => '4096'
);

/*
|--------------------------------------------------------------------------
| Configuração do FPDF
|--------------------------------------------------------------------------
|
| 
|
*/

if(ENVIRONMENT == 'production'){
	define('FPDF_FONTPATH', $_SERVER['DOCUMENT_ROOT'].'/fpdf/font/');
}else{
	define('FPDF_FONTPATH', $_SERVER['DOCUMENT_ROOT'].'/acamps/assets/font/');
}
