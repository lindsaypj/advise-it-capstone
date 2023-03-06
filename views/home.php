<?php
    // Required variables to be declared in controller prior to loading page
    // Ignore "Undefined variable" error message
    $displayLoginForm;
    $username;
    $errorMessage;
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<!-- Styles -->
	<link
		rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
	  	integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
		crossorigin="anonymous"
	>
	<link rel="stylesheet" href="<?php echo $GLOBALS['PROJECT_DIR']; ?>/styles/styles.css">

	<title>Home</title>
</head>
<body class="grfont">
	<!--NAVBAR-->
	<?php include "includes/navbar.php"; ?>

	<div class="container mt-5">
		<div class="row">
			<div class="col text-center">
				<h1 class="pt-5 pb-3">Home Page</h1>
				<hr>
				<a
					href="plan"
					class="btn btn-lg m-3 mt-3 bg-grcgreen text-white"
				>New Education Plan</a>
			</div>
		</div>
	</div>

	<!-- LOGIN Modal -->
	<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="loginModalLabel">Admin Login</h5>
				</div>

				<form action="" method="post" class="m-0 px-3 text-shadow-none w-100">
					<div class="modal-body">

						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" >
						</div>
                        <!-- Error Message -->
                        <p class='text-danger'><?php echo $errorMessage; ?></p>
					</div>
					<div class="modal-footer">
						<a class="btn btn-secondary" href="">Cancel</a>
						<button type="submit" class="btn bg-grcgreen text-white">Login</button>
					</div>

				</form>
			</div>
		</div>
	</div>

	<!-- JavaScript -->
	<script
		src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
		integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
		crossorigin="anonymous"
	></script>
	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
		integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
		crossorigin="anonymous"
	></script>


	<?php // Open Login modal if attempt was made
    if (isset($displayLoginForm) && $displayLoginForm === true) {
        echo '<script src="'.$GLOBALS['PROJECT_DIR'].'/scripts/displayLogin.js"></script>';
    }
	?>
</body>
</html>