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

if ( userLoggedIn() ) {
	header("Location: ?page=home");
	exit(); // Redirect logged in users
}
?>
<section class="h-100">
	<div class="container pb-5 h-100">
		<div class="row justify-content-sm-center h-100">
			<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
				<div class="text-center my-5">
					<img src="<?php echo LPMASSETS .'img/logo.webp'; ?>" alt="logo" width="190" class="img-fluid">
				</div>
				<div class="card shadow-lg">
					<div class="card-body p-5" id="lpmCardLoginBody">
						<h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
						<form method="POST" id="lpmLoginForm" novalidate="" autocomplete="off">
							<div class="mb-3">
								<label class="mb-2 text-muted" for="lpmuser">User</label>
								<input id="lpmuser" type="text" class="form-control" name="lpmuser" required autofocus>
								<div class="invalid-feedback">
									User is invalid
								</div>
							</div>

							<div class="mb-3">
								<div class="mb-2 w-100">
									<label class="text-muted" for="lpmpassword">Password</label>
								</div>
								<input id="lpmpassword" type="password" class="form-control" name="lpmpassword" required>
								<div class="invalid-feedback">
									Password is required
								</div>
							</div>

							<div class="d-grid col-8 mt-4 mx-auto">
								<button type="submit" class="btn btn-primary rounded-pill py-2">
									Login
								</button>
							</div>
						</form>
						<div id="alertLoginStatus" class="alert alert-danger d-none mt-3 mb-0">Incorrect user or password!</div>
					</div>
					<div id="lpmLoginSpinner" class="card-body p-5 my-5 d-none">
						<div class="d-flex justify-content-center mt-3">
							<div class="spinner-border text-primary" style="width:3rem;height:3rem" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</div>
						<p id="textLoginStatus" class="mt-4 text-center">Login in progress. Please wait...</p>
					</div>
				</div>
				<div class="text-center mt-5 text-muted">
					Copyright &copy; <?php echo date('Y'); ?> &mdash; Site Name <?php echo lpmConfig('version'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
