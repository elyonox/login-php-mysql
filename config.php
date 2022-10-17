<?php 
/*-------------------------------------------------------+
| Login PHP MYSQL
| https://github.com/elyonox/login-php-mysql
+--------------------------------------------------------+
| Author: Ionut Manole (Yonox)
| Email: yonutyonox@gmail.com
| Author URL: https://github.com/elyonox
+--------------------------------------------------------+*/

// ** Database authentication settings - You can get this info from your web host ** //
/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database username */
define( 'DB_USER', 'dbuser' );

/** Database password */
define( 'DB_PASS', 'dbpassword' );

/** The name of the database */
define( 'DB_NAME', 'dbname' );


/** Absolute path to the site root directory. */
if ( ! defined( 'LPMPATH' ) ) {
	define( 'LPMPATH', __DIR__ . DIRECTORY_SEPARATOR );
}

/** Set the path of the template directory. */
if ( ! defined( 'LPMTMPL' ) ) {
	define ( 'LPMTMPL', LPMPATH .'template'. DIRECTORY_SEPARATOR );
}

/** Set the path of the include directory. */
if ( ! defined( 'LPMINC' ) ) {
	define ( 'LPMINC', LPMPATH .'includes'. DIRECTORY_SEPARATOR );
}


/** Load Database Class Library */
require( LPMINC .'lpmdb.class.php' );


/** Site Settings */
function lpmConfig( $opt = '' )
{	
	$ycpSettings = array(
		
		'site_uri'	=> $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST'].'/login-php-mysql',
		'version'	=> 'v1.0.0'
    );
    return isset($ycpSettings[$opt]) ? $ycpSettings[$opt] : null;
}


/** Set assets uri. */
if ( ! defined( 'LPMASSETS' ) ) {
	define ( 'LPMASSETS', lpmConfig('site_uri') .'/template/assets/' );
}
