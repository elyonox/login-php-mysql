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
	exit; // Exit if accessed directly.
}

/** Set Site Url */
$siteUri = lpmConfig('site_uri');

/** Set Ajax Url */
$ajaxUri = lpmConfig('site_uri') .'/includes/ajax.functions.php';
?>
	<input type="hidden" id="lpmsiteUri" value="<?php echo $siteUri; ?>">
	<input type="hidden" id="lpmAjaxUri" value="<?php echo $ajaxUri; ?>">
	
	<!-- Load Scripts -->
	<script src="<?php echo LPMASSETS .'js/jquery-3.6.1.min.js'; ?>"></script>
	<script src="<?php echo LPMASSETS .'js/bootstrap.bundle.min.js'; ?>"></script>
	<script src="<?php echo LPMASSETS .'js/main.js'; ?>"></script>
</body>
</html>