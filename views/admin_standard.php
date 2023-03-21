<?php
    // Required variables to be declared in controller prior to loading page
    // Ignore "Undefined variable" error message
    $winterYear;
    $fallYear;
    $springYear;
    $lastUpdatedWinter;
    $lastUpdatedFall;
    $lastUpdatedSpring;
    $formSubmitted;
    $saveSuccess;
    $saveMessage;
    $loadWinter = false;
    $loadSpring = false;
    $loadFall = false;

    if (isset($_POST['token']) && $_POST['token'] == 'WINTER') {
        $loadWinter = true;
    }
    else if (isset($_POST['token']) && $_POST['token'] == 'SPRING') {
        $loadSpring = true;
    }
    else if (isset($_POST['token']) && $_POST['token'] == 'AUTUMN') {
        $loadFall = true;
    }

//function for all plans take in the year as the parameter
function adminPlan ($schoolYears){
    $calendarYear = 2023;
    foreach ($schoolYears as $schoolYear) {
        echo
            '<div id="'.$schoolYear['winter']['calendarYear'].'" class="container p-0">

                <!-- Year Separator -->
                <hr class="shadow-sm mt-0">
                
                <!-- Pass school year to POST -->
                <input
                    type="hidden"
                    value="'.$calendarYear.'"
                    name="schoolYears['.$calendarYear.'][schoolYear]"
                >

                <div class="row">
                    <!-- Fall Quarter -->
                    <div class="col-sm">
                        <div>
                            <h4 class="d-inline">Fall Quarter</h4>
                        </div>

                        <div class="input-group m-2">
                            <div class="input-group m-2 mb-0">
                                <!-- declaration for first field -->
                                <textarea
                                        class="form-control w-50 inputlg"
                                        rows="8"
                                        name="schoolYears['.$calendarYear.'][fall][notes]"
                                        placeholder="Enter classes"
                                >'.$schoolYear['fall']['notes'].'</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Winter Quarter -->
                    <div class="col-sm">
                        <div>
                            <h4 class="d-inline">Winter Quarter</h4>
                        </div>

                        <div class="input-group m-2">
                            <div class="input-group m-2 mb-0">
                                <!-- declaration for first field -->
                                <textarea
                                        class="form-control w-50 inputlg"
                                        rows="8"
                                        name="schoolYears['.$calendarYear.'][winter][notes]"
                                        placeholder="Enter classes"
                                >'.$schoolYear['winter']['notes'].'</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <!-- Spring Quarter -->
                    <div class="col-sm">
                        <div>
                            <h4 class="d-inline">Spring Quarter</h4>
                        </div>

                        <div class="input-group m-2">
                            <div class="input-group m-2 mb-0">
                                <!-- declaration for first field -->
                                <textarea
                                        class="form-control w-50 inputlg"
                                        rows="8"
                                        name="schoolYears['.$calendarYear.'][spring][notes]"
                                        placeholder="Enter classes"
                                >'.$schoolYear['spring']['notes'].'</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div>
                            <h4 class="d-inline">Summer Quarter</h4>
                        </div>

                        <div class="input-group m-2 mb-4">
                            <div class="input-group m-2 mb-0">
                                <!-- declaration for first field -->
                                <textarea class="form-control w-50 inputlg"
                                          rows="8"
                                          name="schoolYears['.$calendarYear.'][summer][notes]"
                                          placeholder="Enter classes"
                                >'.$schoolYear['summer']['notes'].'</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        $calendarYear++;
    };
}


    // =======================================================================================
?>


<!doctype html>
<html lang="en">
<head>
    <?php require "includes/head-includes.php"?>

    <title>Administration Standard View</title>
</head>
<body>
<!-- NAVBAR -->
<?php include "includes/admin-navbar.php"; ?>

<!-- Plan Selector -->
<nav aria-label="Plan selector" class="mt-2">
    <ul class="pagination pagination-lg justify-content-center">
        <li class="page-item<?php if ($loadWinter) echo " active" ?>" id="winterPlanBtn">
            <span class="page-link">Winter</span>
        </li>
        <li class="page-item<?php if ($loadSpring) echo " active" ?>" id="springPlanBtn">
            <span class="page-link">Spring</span>
        </li>
        <li class="page-item<?php if ($loadFall) echo " active" ?>" id="fallPlanBtn">
            <span class="page-link">Fall</span>
        </li>
    </ul>
</nav>

<!--Winter Plan-->
<div id="winter-plan" class="container mt-2 mb-5 pb-5 grfont<?php
    if (!isset($_POST['token']) || !$loadWinter) {
     echo " d-none";
    }
    ?>">
    <div class="row justify-content-center mb-5 pb-5">
        <div class="col text-center">
            <h1 class="pt-5">Winter Start</h1>

            <form class="col-lg-8 offset-lg-2" method="post">

                <!-- Token Input -->
                <input id="tokenInput" type="hidden" name="token" value="WINTER">
                <input type="hidden" name="advisor" value="">

                <div id="schoolYearsWinter">
                    <?php
                        adminPlan($winterYear);
                    ?>
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

<!--Spring Plan-->
<div id="spring-plan" class="container mt-2 mb-5 pb-5 grfont<?php
    if (!isset($_POST['token']) || !$loadSpring) {
        echo " d-none";
    }
?>">
    <div class="row justify-content-center mb-5 pb-5">
        <div class="col text-center">
            <h1 class="pt-5">Spring Start</h1>

            <form class="col-lg-8 offset-lg-2" method="post">

                <!-- Token Input -->
                <input id="tokenInput" type="hidden" name="token" value="SPRING">
                <input type="hidden" name="advisor" value="">

                <div id="schoolYearsSpring">
                    <?php
                        adminPlan($springYear);
                    ?>
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

<!--Fall Plan-->
<div id="fall-plan" class="container mt-2 mb-5 pb-5 grfont<?php
    if (!isset($_POST['token']) || !$loadFall) {
        echo " d-none";
    }
?>">
    <div class="row justify-content-center mb-5 pb-5">
        <div class="col text-center">
            <h1 class="pt-5">Fall Start</h1>

            <form class="col-lg-8 offset-lg-2" method="post">

                <!-- Token Input -->
                <input id="tokenInput" type="hidden" name="token" value="AUTUMN">
                <input type="hidden" name="advisor" value="">

                <div id="schoolYearsFall">
                    <?php
                        adminPlan($fallYear);
                    ?>
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
if (isset($formSubmitted) && $formSubmitted == true) {
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

<!-- Script to toggle the visible standardized plan -->
<script src="<?php echo $GLOBALS['PROJECT_DIR'] ?>/scripts/toggleStandardizedPlans.js"></script>

<?php // Save Notification controller
    if (isset($formSubmitted) && $formSubmitted == true) {
        echo '<script src="'.$GLOBALS['PROJECT_DIR'].'/scripts/saveNotification.js"></script>';
    }
?>

</body>
</html>
