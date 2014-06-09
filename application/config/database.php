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
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
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

$active_group = 'webdb';
$active_record = TRUE;

$db['webdb']['hostname'] = '10.11.12.3';
$db['webdb']['username'] = 'root';
$db['webdb']['password'] = '84@41%%wi96^4';
$db['webdb']['database'] = 'agent1_web_db';
$db['webdb']['dbdriver'] = 'mysql';
$db['webdb']['dbprefix'] = '';
$db['webdb']['pconnect'] = FALSE;
$db['webdb']['db_debug'] = TRUE;
$db['webdb']['cache_on'] = FALSE;
$db['webdb']['cachedir'] = '';
$db['webdb']['char_set'] = 'utf8';
$db['webdb']['dbcollat'] = 'utf8_general_ci';
$db['webdb']['swap_pre'] = '';
$db['webdb']['autoinit'] = TRUE;
$db['webdb']['stricton'] = FALSE;

$db['accountdb']['hostname'] = '10.11.12.3';
$db['accountdb']['username'] = 'root';
$db['accountdb']['password'] = '84@41%%wi96^4';
$db['accountdb']['database'] = 'agent1_account_db';
$db['accountdb']['dbdriver'] = 'mysql';
$db['accountdb']['dbprefix'] = '';
$db['accountdb']['pconnect'] = FALSE;
$db['accountdb']['db_debug'] = TRUE;
$db['accountdb']['cache_on'] = FALSE;
$db['accountdb']['cachedir'] = '';
$db['accountdb']['char_set'] = 'utf8';
$db['accountdb']['dbcollat'] = 'utf8_general_ci';
$db['accountdb']['swap_pre'] = '';
$db['accountdb']['autoinit'] = TRUE;
$db['accountdb']['stricton'] = FALSE;

$db['productdb']['hostname'] = '10.11.12.3';
$db['productdb']['username'] = 'root';
$db['productdb']['password'] = '84@41%%wi96^4';
$db['productdb']['database'] = 'agent1_product_db';
$db['productdb']['dbdriver'] = 'mysql';
$db['productdb']['dbprefix'] = '';
$db['productdb']['pconnect'] = FALSE;
$db['productdb']['db_debug'] = TRUE;
$db['productdb']['cache_on'] = FALSE;
$db['productdb']['cachedir'] = '';
$db['productdb']['char_set'] = 'utf8';
$db['productdb']['dbcollat'] = 'utf8_general_ci';
$db['productdb']['swap_pre'] = '';
$db['productdb']['autoinit'] = TRUE;
$db['productdb']['stricton'] = FALSE;

$db['fundsdb']['hostname'] = '10.11.12.3';
$db['fundsdb']['username'] = 'root';
$db['fundsdb']['password'] = '84@41%%wi96^4';
$db['fundsdb']['database'] = 'agent1_funds_flow_db';
$db['fundsdb']['dbdriver'] = 'mysql';
$db['fundsdb']['dbprefix'] = '';
$db['fundsdb']['pconnect'] = FALSE;
$db['fundsdb']['db_debug'] = TRUE;
$db['fundsdb']['cache_on'] = FALSE;
$db['fundsdb']['cachedir'] = '';
$db['fundsdb']['char_set'] = 'utf8';
$db['fundsdb']['dbcollat'] = 'utf8_general_ci';
$db['fundsdb']['swap_pre'] = '';
$db['fundsdb']['autoinit'] = TRUE;
$db['fundsdb']['stricton'] = FALSE;

$db['logdb']['hostname'] = '10.11.12.3';
$db['logdb']['username'] = 'root';
$db['logdb']['password'] = '84@41%%wi96^4';
$db['logdb']['database'] = 'agent1_log_db_201203';
$db['logdb']['dbdriver'] = 'mysql';
$db['logdb']['dbprefix'] = '';
$db['logdb']['pconnect'] = FALSE;
$db['logdb']['db_debug'] = FALSE;
$db['logdb']['cache_on'] = FALSE;
$db['logdb']['cachedir'] = '';
$db['logdb']['char_set'] = 'utf8';
$db['logdb']['dbcollat'] = 'utf8_general_ci';
$db['logdb']['swap_pre'] = '';
$db['logdb']['autoinit'] = TRUE;
$db['logdb']['stricton'] = FALSE;

$db['adminlog']['hostname'] = '10.11.12.3';
$db['adminlog']['username'] = 'root';
$db['adminlog']['password'] = '84@41%%wi96^4';
$db['adminlog']['database'] = 'agent1_adminlog_db';
$db['adminlog']['dbdriver'] = 'mysql';
$db['adminlog']['dbprefix'] = '';
$db['adminlog']['pconnect'] = FALSE;
$db['adminlog']['db_debug'] = TRUE;
$db['adminlog']['cache_on'] = FALSE;
$db['adminlog']['cachedir'] = '';
$db['adminlog']['char_set'] = 'utf8';
$db['adminlog']['dbcollat'] = 'utf8_general_ci';
$db['adminlog']['swap_pre'] = '';
$db['adminlog']['autoinit'] = TRUE;
$db['adminlog']['stricton'] = FALSE;

$db['admindb']['hostname'] = '10.11.12.3';
$db['admindb']['username'] = 'root';
$db['admindb']['password'] = '84@41%%wi96^4';
$db['admindb']['database'] = 'gm_system_db';
$db['admindb']['dbdriver'] = 'mysql';
$db['admindb']['dbprefix'] = '';
$db['admindb']['pconnect'] = FALSE;
$db['admindb']['db_debug'] = TRUE;
$db['admindb']['cache_on'] = FALSE;
$db['admindb']['cachedir'] = '';
$db['admindb']['char_set'] = 'utf8';
$db['admindb']['dbcollat'] = 'utf8_general_ci';
$db['admindb']['swap_pre'] = '';
$db['admindb']['autoinit'] = TRUE;
$db['admindb']['stricton'] = FALSE;

$db['logcachedb']['hostname'] = '10.11.12.3';
$db['logcachedb']['username'] = 'root';
$db['logcachedb']['password'] = '84@41%%wi96^4';
$db['logcachedb']['database'] = 'agent1_log_db';
$db['logcachedb']['dbdriver'] = 'mysql';
$db['logcachedb']['dbprefix'] = '';
$db['logcachedb']['pconnect'] = FALSE;
$db['logcachedb']['db_debug'] = TRUE;
$db['logcachedb']['cache_on'] = FALSE;
$db['logcachedb']['cachedir'] = '';
$db['logcachedb']['char_set'] = 'utf8';
$db['logcachedb']['dbcollat'] = 'utf8_general_ci';
$db['logcachedb']['swap_pre'] = '';
$db['logcachedb']['autoinit'] = TRUE;
$db['logcachedb']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */