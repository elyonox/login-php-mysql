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

/**
 * Verify if user is logged in.
 */
function userLoggedIn()
{
	$lpmUserLoggedIn = false;
	
	if ( isset( $_SESSION['lpmlogged'] ) && $_SESSION['lpmlogged'] === true &&
		isset( $_SESSION['id_session'] ) && !empty( $_SESSION['id_session'] ) &&
		isset( $_SESSION['username'] ) && !empty( $_SESSION['username'] ) )
	{
		$lpmUserLoggedIn = true;
	}
	
	return $lpmUserLoggedIn;
}

/**
 * Load pages.
 */
function lpm_pages()
{
	$req_page = isset($_GET['page']) ? $_GET['page'] : 'home';
		
	$page_path = getcwd() . DIRECTORY_SEPARATOR .'pages'. DIRECTORY_SEPARATOR . rtrim($req_page,"/") .'.php';

    if ( ! file_exists( $page_path ) )
	{
        $page_path = getcwd() . DIRECTORY_SEPARATOR .'pages'. DIRECTORY_SEPARATOR .'404.php';
    }

    include $page_path;
}

/**
 * Load page header.
 */
function lpm_header()
{
	include( LPMTMPL .'header.php' );
}

/**
 * Load page footer.
 */
function lpm_footer()
{
	include( LPMTMPL .'footer.php' );
}

/**
 * Load site template.
 */
function load_lpmTemplate()
{
	require_once( LPMTMPL .'template.php' );
}
