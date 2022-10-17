<?php 
/*-------------------------------------------------------+
| Login PHP MYSQL
| https://github.com/elyonox/login-php-mysql
+--------------------------------------------------------+
| Author: Ionut Manole (Yonox)
| Email: yonutyonox@gmail.com
| Author URL: https://github.com/elyonox
+--------------------------------------------------------+*/

include( '../config.php' );

if ( isset($_POST['lpmaction']) && $_POST['lpmaction'] === 'lpmLogIn' )
{
	global $database;
	
	$action = $database->filter($_POST['lpmaction']);
	
	lpm_init_action( $action );
} else {
	exit();
}

/**
 * Users Login function.
 */
function lpmLogIn()
{	
	$respLogin = array('userLoggedIn' => false, 'userName' => false);
	
	if ( isset($_POST['lpmuser']) && !empty($_POST['lpmuser']) )
	{
		global $database;
		
		$sanitUser = $database->filter($_POST['lpmuser']);
		
		$userInfo = $database->lpm_user($sanitUser);
		
		if ( $userInfo && password_verify( $_POST['lpmpass'], $userInfo['password'] ) )
		{
			session_start();
			$_SESSION['lpmlogged'] = true;
			$_SESSION['id_session'] = uniqid();
			$_SESSION['username'] = $userInfo['user'];
			
			$respLogin = array( 'userLoggedIn' => true, 'userName' => $sanitUser );
		}
	}
	
	echo json_encode($respLogin);
	
	exit();
}

/**
 * Users Logout function.
 */
function lpmLogOut()
{
	session_start();
	$_SESSION  = array();
	session_destroy();
	
	header('location: ?page=home');
	exit();
}

/**
 * Init actions.
 */
function lpm_init_action( $action )
{
	if ( function_exists( $action ) )
	{
		$action();
	} else {
		exit();
	}
}

exit();
