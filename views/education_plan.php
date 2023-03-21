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
    <?php require "includes/head-includes.php"?>

	<title>Education Plan</title>
</head>

<body>
    <!--NAVBAR-->
    <?php include "includes/navbar.php"; ?>

    <!-- PLAN -->
	<div class="container mt-2 mb-5 pb-5 grfont">
		<div class="row justify-content-center mb-5 pb-5">
			<div class="col text-center">
				<h1 class="pt-5">Educational Planning Worksheet</h1>

				<form class="col-lg-8 offset-lg-2 col-xxl-10 offset-xxl-1" method="post">
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

					<div class="float-centered mt-5 mb-3">
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
                                 '<div id="'.($year).'" class="container p-0">

                                <!-- Year Separator -->
								<hr class="shadow-sm mt-0">
								
								<!-- Pass school year to POST -->
								<input
                                    type="hidden"
                                    value="'.($year).'"
                                    name="schoolYears['.($year).'][schoolYear]"
                                >
                                
								<div class="row">
									<!-- Fall Quarter -->
									<div class="col-12 col-sm-6 col-xxl-3 col-6-print">
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
									<div class="col-12 col-sm-6 col-xxl-3 col-6-print">
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

									<!-- Spring Quarter -->
									<div class="col-12 col-sm-6 col-xxl-3 col-6-print">
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
									<!-- Summer Quarter -->
									<div class="col-12 col-sm-6 col-xxl-3 col-6-print">
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

    <?php ////   STANDARD PLAN SELECTOR (Activated via button in nav)   ////
        include "includes/standard_plan_selection.php";
    ?>

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

    <!-- Bootstrap JS -->
    <?php require "includes/bootstrap-js.html"?>

	<!-- Script to add years to form -->
	<script src="../scripts/addYearsToForm.js"></script>
<!--    <script src="../scripts/printPlan.js"></script>-->

    <!-- Script to handle Standard Plan Selection -->
    <script src="<?php echo $GLOBALS['PROJECT_DIR']; ?>/scripts/standardPlanSelection.js"></script>

    <!-- Script to handle Print button -->
    <script src="<?php echo $GLOBALS['PROJECT_DIR']; ?>/scripts/print.js"></script>

    <?php // Save Notification controller
    if ($formSubmitted) {
        echo '<script src="'.$GLOBALS['PROJECT_DIR'].'/scripts/saveNotification.js"></script>';
    }
    ?>
</body>
</html>