<?php 
/*-------------------------------------------------------+
| Login PHP MYSQL
| https://github.com/elyonox/login-php-mysql
+--------------------------------------------------------+
| Author: Ionut Manole (Yonox)
| Email: yonutyonox@gmail.com
| Author URL: https://github.com/elyonox
+--------------------------------------------------------+*/

if ( ! defined( 'LPMPATH' ) ) {
	exit(); // Exit if accessed directly.
} 

$_SESSION  = array();
session_destroy();

header('location: ?page=login');
exit();
