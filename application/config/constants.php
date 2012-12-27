<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 |-------------------------------------------------------------------
 | CONSTANTES DA APLICA��O ACAMP'S
 |-------------------------------------------------------------------
 |
 |               DEV.FIN.COR.LIB.SEC.DES.PAG | DEC | HEX
 | DESENVOLVEDOR  1   1   1   1   1   1   1  | 127 | 7F
 | FINANCEIRO     0   1   1   1   0   1   1  |  59 | 3B
 | COORDENADORES  0   0   1   1   1   1   1  |  31 | 0F
 | COORD. INSCR.  0   0   1   1   0   1   1  |  27 | 1B
 | CAIXAS         0   0   0   0   0   0   1  |   1 | 01
 | SECRETARIA     0   0   1   1   1   0   0  |  28 | 1C
 | 
 */

// Constantes de Permiss�o de Usu�rio
define('PAGAMENTO', 1);
define('DESCONTO', 2);
define('SECRETARIA', 4);
define('LIBERACAO', 8);
define('CORRECAO', 16);
define('FINANCEIRO', 32);
define('DESENVOLVEDOR', 64);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */