<?php 
/*-------------------------------------------------------+
| Login PHP MYSQL
| https://github.com/elyonox/login-php-mysql
+--------------------------------------------------------+
| Author: Ionut Manole (Yonox)
| Email: yonutyonox@gmail.com
| Author URL: https://github.com/elyonox
+--------------------------------------------------------+*/

/** PHP Debug. Uncomment for development */
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();

require( 'config.php' );

/** Check Database connection. If conection failed redirect to install page */
global $database;
$dbconnection = $database->checkDBconnection();
if ( !$dbconnection )
{
	header( 'Location: install/install.php' );
	exit();
}

require( LPMPATH .'functions.php' );

load_lpmTemplate();
