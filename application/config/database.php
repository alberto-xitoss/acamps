<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/
if(ENVIRONMENT == 'development'){
    $active_group = "dev";
}elseif(ENVIRONMENT == 'acamps'){
    $active_group = "intranet";
}else{
    $active_group = "internet";
}

$active_record = TRUE;

$db['dev']['hostname'] = "localhost";
$db['dev']['username'] = "";
$db['dev']['password'] = "";
$db['dev']['database'] = "";
$db['dev']['dbdriver'] = "postgre";
$db['dev']['dbprefix'] = "";
$db['dev']['pconnect'] = TRUE;
$db['dev']['db_debug'] = TRUE;
$db['dev']['cache_on'] = TRUE;
$db['dev']['cachedir'] = "";
$db['dev']['char_set'] = "utf8";
$db['dev']['dbcollat'] = "utf8_general_ci";
$db['dev']['swap_pre'] = '';
$db['dev']['autoinit'] = TRUE;
$db['dev']['stricton'] = FALSE;

$db['intranet']['hostname'] = "localhost";
$db['intranet']['username'] = "";
$db['intranet']['password'] = "";
$db['intranet']['database'] = "";
$db['intranet']['dbdriver'] = "postgre";
$db['intranet']['dbprefix'] = "";
$db['intranet']['pconnect'] = TRUE;
$db['intranet']['db_debug'] = TRUE;
$db['intranet']['cache_on'] = TRUE;
$db['intranet']['cachedir'] = "";
$db['intranet']['char_set'] = "utf8";
$db['intranet']['dbcollat'] = "utf8_general_ci";
$db['intranet']['swap_pre'] = '';
$db['intranet']['autoinit'] = TRUE;
$db['intranet']['stricton'] = FALSE;

$db['internet']['hostname'] = "localhost";
$db['internet']['username'] = "";
$db['internet']['password'] = "";
$db['internet']['database'] = "";
$db['internet']['dbdriver'] = "postgre";
$db['internet']['dbprefix'] = "";
$db['internet']['pconnect'] = TRUE;
$db['internet']['db_debug'] = TRUE;
$db['internet']['cache_on'] = TRUE;
$db['internet']['cachedir'] = "";
$db['internet']['char_set'] = "utf8";
$db['internet']['dbcollat'] = "utf8_general_ci";
$db['internet']['swap_pre'] = '';
$db['internet']['autoinit'] = TRUE;
$db['internet']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */