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
    <?php require "includes/head-includes.php"?>

	<title>Home</title>
</head>
<body class="grfont">
	<!--NAVBAR-->
	<?php include "includes/navbar.php"; ?>

	<div class="container mt-5">
		<div class="row">
			<div class="col text-center">
				<h1 class="pt-5 pb-3">New Education Plan</h1>
				<hr>
                <!-- Standard Plan Selector -->
                <button
                        type="button"
                        class="btn btn-lg m-3 mt-3 bg-grcgreen text-white"
                        data-bs-toggle="modal"
                        data-bs-target="#standardPlanModal"
                >Use Standard Plan</button>
                <?php include "includes/standard_plan_selection.php"; ?>
				<a
					href="plan"
					class="btn btn-lg m-3 mt-3 bg-grcgreen text-white"
				>Blank Plan</a>
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

    <!-- Bootstrap JS -->
    <?php require "includes/bootstrap-js.html"?>

    <!-- Script to handle Standard Plan Selection -->
    <script src="<?php echo $GLOBALS['PROJECT_DIR']; ?>/scripts/standardPlanSelection.js"></script>

	<?php // Open Login modal if attempt was made
    if (isset($displayLoginForm) && $displayLoginForm === true) {
        echo '<script src="'.$GLOBALS['PROJECT_DIR'].'/scripts/displayLogin.js"></script>';
    }
	?>
</body>
</html>