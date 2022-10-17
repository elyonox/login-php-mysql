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

if ( !userLoggedIn() ) {
	header("Location: ?page=login");
	exit(); // Only logged in users
}
?>
<div class="container py-5 bg-light">
	<h1>Home Page</h1>
</div>