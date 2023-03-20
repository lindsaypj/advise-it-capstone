<?php
    // Required Variables
    $token;
    $advisor;
    $schoolYears;
    $formSubmitted;
    $saveSuccess;
    $saveMessage;
?>

<!doctype html>
<html lang="en">
<head>
<!--	Works-->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Styles -->
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous"
    >
    <link rel="stylesheet" href="<?php echo $GLOBALS['PROJECT_DIR'] ?>/styles/styles.css">

	<!-- Jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

	<title>Education Plan</title>
</head>

<body>
<nav class="navbar navbar-expand-lg nav-grc sticky-top grfont shadow-sm">
    <div>
        <a class="text-dark d-block bg-grcgreen p-3" href="<?php echo $GLOBALS['PROJECT_DIR']; ?>">
            <img src="https://www.greenriver.edu/media/site-assets/img/logo.png"
                 class="gr-logo">
        </a>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav align-items-center w-100">
            <li class="nav-item active">
                <a class="nav-link text-dark" href="<?php echo $GLOBALS['PROJECT_DIR'] ?>/plan">
                    <h5 class="mb-0">Education Plan</h5>
                </a>
            </li>
            <?php
            if (isset($_SESSION['logged-in']) && $_SESSION['logged-in'] === true) {
                // All plans page
                echo '<li class="nav-item active">
                        <a class="nav-link text-dark" href="'.$GLOBALS['PROJECT_DIR'].'/admin">
                            <h5 class="mb-0">All Plans</h5>
                        </a>
                    </li>';
                // Edit footer links
                echo '<li class="nav-item active">
                        <a class="nav-link text-dark" href="'.$GLOBALS['PROJECT_DIR'].'/admin-footer-links">
                            <h5 class="mb-0">Footer Links</h5>
                        </a>
                    </li>';
                // Standardized Plans
                echo '<li class="nav-item active">
                        <a class="nav-link text-dark" href="'.$GLOBALS['PROJECT_DIR'].'/standardized-plans">
                            <h5 class="mb-0">Standardized Plans</h5>
                        </a>
                    </li>';
                // Logout link
                echo '<li class="nav-item active">
                        <a class="nav-link text-dark" href="'.$GLOBALS['PROJECT_DIR'].'/logout">
                            <h5 class="mb-0">Logout</h5>
                        </a>
                    </li>';
            }
            else {
                echo '<li class="nav-item active">
                        <a class="nav-link text-dark" href="'.$GLOBALS['PROJECT_DIR'].'/admin">
                            <h5 class="mb-0">Admin</h5>
                        </a>
                    </li>';


            }
            include "includes/print.php";
            ?>
        </ul>
    </div>
    <?php include "includes/last_updated.php"; ?>
</nav>
    <!-- PLAN -->
	<div class="container mt-2 mb-5 pb-5 grfont">
		<div class="row justify-content-center mb-5 pb-5">
			<div class="col text-center">
				<h1 class="pt-5">Educational Planning Worksheet</h1>

				<form class="col-lg-8 offset-lg-2" method="post">
					<div class="form-group text-center mb-2">
						<h4>Student Token: <?php echo $token; ?></h4>
						<!-- Token Input -->
                        <input id="tokenInput" type="hidden" name="token"
                               value="<?php echo $token; ?>">
                    </div>

                    <!--If advisor is present, the value will be the advisor name, else empty String-->
					<label for="advisor">
						Advisor:
						<input
							id="advisor"
							type="text"
							class="form-control text-center m-2 mx-auto w-100 shadow-sm"
							name="advisor"
                            value="<?php echo $advisor; ?>"
							placeholder="Enter advisor"
						>
					</label>

					<div class="float-centered mt-5">
						<button
							id="prevYearBtn"
							class="btn btn-lg bg-secondary text-white shadow-sm"
							type="button"
						>Add Year</button>
					</div>

					<div id="schoolYears">
                        <?php
						 foreach ($schoolYears as $year=>$schoolYear) {
                             if (isset($schoolYear['render'])) {
                                 echo
                                 '<div id="'.$year.'" class="container p-0">

								<!-- Year Separator -->
								<div class="col-sm">
									<h3 class="text-end text-secondary mb-0">'.$year.'</h3>
									<input
										type="hidden"
										value="'.$year.'"
										name="schoolYears['.$year.'][schoolYear]"
									>
								</div>
								<hr class="shadow-sm mt-0">

								<div class="row">
									<!-- Fall Quarter -->
									<div class="col-sm">
										<div>
											<h4 class="d-inline">Fall Quarter</h4>
											<h5>'.($year -1).'</h5>
										</div>

										<div class="input-group m-2">
											<div class="input-group m-2 mb-0">
												<!-- declaration for first field -->
												<textarea
													class="form-control w-50 inputlg"
													rows="8"
													name="schoolYears['.$year.'][fall][notes]"
													placeholder="Enter classes"
												>'. $schoolYear['fall']['notes'] .'</textarea>
											</div>
										</div>
									</div>
									<!-- Winter Quarter -->
									<div class="col-sm">
										<div>
											<h4 class="d-inline">Winter Quarter</h4>
											<h5>'.$year.'</h5>
										</div>

										<div class="input-group m-2">
											<div class="input-group m-2 mb-0">
												<!-- declaration for first field -->
												<textarea
													class="form-control w-50 inputlg"
													rows="8"
													name="schoolYears['.$year.'][winter][notes]"
													placeholder="Enter classes"
												>'. $schoolYear['winter']['notes'] .'</textarea>
											</div>
										</div>
									</div>
								</div>

								<div class="row mt-5">
									<!-- Spring Quarter -->
									<div class="col-sm">
										<div>
											<h4 class="d-inline">Spring Quarter</h4>
											<h5>'.$year.'</h5>
										</div>

										<div class="input-group m-2">
											<div class="input-group m-2 mb-0">
												<!-- declaration for first field -->
												<textarea
													class="form-control w-50 inputlg"
													rows="8"
													name="schoolYears['.$year.'][spring][notes]"
													placeholder="Enter classes"
												>'. $schoolYear['spring']['notes'] .'</textarea>
											</div>
										</div>
									</div>
									<div class="col-sm">
										<div>
											<h4 class="d-inline">Summer Quarter</h4>
											<h5>'.$year.'</h5>
										</div>

										<div class="input-group m-2 mb-4">
											<div class="input-group m-2 mb-0">
												<!-- declaration for first field -->
												<textarea class="form-control w-50 inputlg"
													rows="8"
													name="schoolYears['.$year.'][summer][notes]"
													placeholder="Enter classes"
												>'. $schoolYear['summer']['notes'] .'</textarea>
											</div>
										</div>
									</div>
								</div>
							</div>';
                            }
						}
						?>
					</div>

					<div class="float-centered mt-5">
						<button
							id="nextYearBtn"
							class="btn btn-lg bg-secondary text-white shadow-sm"
							type="button"
						>Add Year</button>
					</div>

					<div class="float-centered mt-3">
						<button class="btn btn-lg bg-grcgreen text-white shadow-sm" type="submit">
							SAVE EDUCATION PLAN
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Save Notification -->
    <?php
    if (isset($formSubmitted)) {
        if ($saveSuccess === true) {
            $title = "Success!";
            $titleColor = "text-success";
        }
        else {
            $title = "Error!";
            $titleColor = "text-danger";
        }
        echo
        '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="saveNotification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header '.$titleColor.'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill me-2" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                    </svg>
                    <strong class="me-auto">'.$title.'</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    '.$saveMessage.'
                </div>
            </div>
        </div>';
    }
    ?>

	<!--Including the JS for the file-->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
			integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
			crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
			integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
			crossorigin="anonymous"></script>
	<!-- Script to add years to form -->
	<script src="../scripts/addYearsToForm.js"></script>
<!--    <script src="../scripts/printPlan.js"></script>-->

    <?php // Save Notification controller
    if ($formSubmitted) {
        echo '<script src="'.$GLOBALS['PROJECT_DIR'].'/scripts/saveNotification.js"></script>';
    }
    ?>
</body>
</html>