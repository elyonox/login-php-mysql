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

if ( isset($_POST['action']) && $_POST['action'] == 'createConfig' )
{
	function createConfig()
	{
		$configFile = file('../config.php');

		function replaceConfLine($configFile)
		{
			$configFile = str_replace('<?php','phprpl',$configFile);

			if ( strstr( $configFile, 'DB_HOST' ) ) {
				return "define( 'DB_HOST', '".trim($_POST['dbhostname'])."' );\n";
			}
			if ( strstr( $configFile, 'DB_USER' ) ) {
				return "define( 'DB_USER', '".trim($_POST['dbusername'])."' );\n";
			}
			if ( strstr( $configFile, 'DB_PASS' ) ) {
				return "define( 'DB_PASS', '".trim($_POST['dbpassword'])."' );\n";
			}
			if ( strstr( $configFile, 'DB_NAME' ) ) {
				return "define( 'DB_NAME', '".trim($_POST['dbname'])."' );\n";
			}
			return str_replace('phprpl','<?php',$configFile);
		}

		$configFile = array_map('replaceConfLine', $configFile);
		file_put_contents('../config.php', $configFile);
	}
	
	createConfig();
	exit();
}

if ( isset($_POST['action']) && $_POST['action'] == 'dbExampleInstall' )
{
	function insertToDB()
	{	
		global $database;
		
		if( !$database->table_exists( 'lpm_users' ) )
		{
			$database->createExampleTable();

			$userData = array(
				'ID'				=> '1',
				'user_login'		=> 'admin',
				'user_pass'			=> '$2y$10$uawwS6vJpcRbbgnI.M6ZzOvduXFyx4wfQR2sQdiwmFD8NNQpYQVIu',
				'user_email'		=> 'some_email@email.com',
				'user_registered'	=> '2022-10-14 23:07:41',
				'user_status'		=> '0',
			);

			$database->insert( 'lpm_users', $userData );
		}
	}
	
	insertToDB();
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Header metas -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Install Script - Login PHP MYSQL</title>
	<meta name="author" content="yonox">
	<meta name="description" content="Script to install Login PHP MYSQL">
	<meta name="keywords" content="install, login, php, mysql, html, website, yonox">
	
	<!-- Favicon icons -->
	<link href="<?php echo LPMASSETS .'img/favicon.png'; ?>" rel="icon">
	<link href="<?php echo LPMASSETS .'img/apple-touch-icon.png'; ?>" rel="apple-touch-icon">
	
	<!-- Load Styles CSS -->
	<link href="<?php echo LPMASSETS .'css/bootstrap.min.css'; ?>" rel="stylesheet">
</head>
<body>
	
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<h1 class="fs-4 card-title fw-bold mb-4">Install LPM Login</h1>
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
						<form method="POST" id="instLpmForm" class="needs-validation" novalidate="" autocomplete="off">
							<div class="mb-3">
								<label class="mb-2 text-muted" for="dbhostname">Database Hostname</label>
								<input id="dbhostname" type="text" class="form-control" name="dbhostname" value="localhost" required autofocus>
								<div class="invalid-feedback">
									Database Hostname is required
								</div>
							</div>

							<div class="mb-3">
								<label class="mb-2 text-muted" for="dbusername">Database Username</label>
								<input id="dbusername" type="text" class="form-control" name="dbusername" required>
								<div class="invalid-feedback">
									Database Username is required
								</div>
							</div>
							
							<div class="mb-3">
								<label class="mb-2 text-muted" for="dbpassword">Database Password</label>
								<input id="dbpassword" type="password" class="form-control" name="dbpassword" required>
								<div class="invalid-feedback">
									Database Password is required
								</div>
							</div>
							
							<div class="mb-3">
								<label class="mb-2 text-muted" for="dbname">Database Name</label>
								<input id="dbname" type="text" class="form-control" name="dbname" required>
								<div class="invalid-feedback">
									Database Name is required
								</div>
							</div>
							
							<?php
							$ajaxUri = $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST'].'/login-php-mysql/install/install.php';
							?>
							<input type="hidden" id="ajaxUri" value="<?php echo $ajaxUri; ?>">
							
							<div class="d-flex align-items-center">
								<button type="submit" class="btn btn-primary ms-auto">
									Install
								</button>
							</div>
						</form>
						<div id="instLpmSpinner" class="card-body d-none p-5">
							<div class="d-flex justify-content-center mt-3">
								<div class="spinner-border text-primary" style="width:3rem;height:3rem" role="status">
									<span class="visually-hidden">Loading...</span>
								</div>
							</div>
							<p id="msgInstLpm" class="mt-4 text-center">Installing LPM Login <br/>Please wait...</p>
						</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted pb-5">
						Copyright &copy; <?php echo date('Y'); ?> &mdash; Site Name 
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!-- Load Scripts -->
	<script src="<?php echo LPMASSETS .'js/jquery-3.6.1.min.js'; ?>"></script>
	<script src="<?php echo LPMASSETS .'js/bootstrap.bundle.min.js'; ?>"></script>
	<script src="<?php echo LPMASSETS .'js/main.js'; ?>"></script>
</body>
</html>