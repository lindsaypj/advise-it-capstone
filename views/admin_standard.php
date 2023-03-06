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

    if (isset($_POST['token']) && $_POST['token'] == 'winter') {
        $loadWinter = true;
    }
    else if (isset($_POST['token']) && $_POST['token'] == 'spring') {
        $loadSpring = true;
    }
    else if (isset($_POST['token']) && $_POST['token'] == 'autumn') {
        $loadFall = true;
    }

//function for all plans take in the year as the parameter
function adminPlan ($schoolYears){
    foreach ($schoolYears as $schoolYear) {

        if($schoolYear['render']) {
            $calendarYear = $schoolYear['winter']['calendarYear'];
            echo
                '<div id="'.$schoolYear['winter']['calendarYear'].'" class="container p-0">

                    <!-- Year Separator -->
                    <div class="col-sm">
                        <h3 class="text-end text-secondary mb-0">'.$calendarYear.'</h3>
                        <input
                                type="hidden"
                                value="'.$calendarYear.'"
                                name="schoolYears['.$calendarYear.'][schoolYear]"
                        >
                    </div>
                    <hr class="shadow-sm mt-0">

                    <div class="row">
                        <!-- Fall Quarter -->
                        <div class="col-sm">
                            <div>
                                <h4 class="d-inline">Fall Quarter</h4>
                                <h5>'.($calendarYear -1).'</h5>
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
                                <h5>'.$calendarYear.'</h5>
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
                                <h5>'.$calendarYear.'</h5>
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
                                <h5>'.$calendarYear.'</h5>
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
        };
    };
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="<?php echo $GLOBALS['PROJECT_DIR'] ?>/styles/styles.css">

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Administration Standard View</title>
</head>
<body>
<!-- NAVBAR -->
<?php include "includes/navbar.php"; ?>

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
                <input id="tokenInput" type="hidden" name="token" value="winter">
                <input type="hidden" name="advisor" value="">

                <div class="float-centered mt-5">
                    <button
                            id="prevYearWinterBtn"
                            class="btn btn-lg bg-secondary text-white shadow-sm"
                            type="button"
                    >Add Year</button>
                </div>

                <div id="schoolYearsWinter">

                    <?php
                        adminPlan($winterYear);
                    ?>
                </div>

                <div class="float-centered mt-5">
                    <button
                            id="nextYearWinterBtn"
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
                <input id="tokenInput" type="hidden" name="token" value="spring">
                <input type="hidden" name="advisor" value="">

                <div class="float-centered mt-5">
                    <button
                            id="prevYearSpringBtn"
                            class="btn btn-lg bg-secondary text-white shadow-sm"
                            type="button"
                    >Add Year</button>
                </div>

                <div id="schoolYearsSpring">

                    <?php
                        adminPlan($springYear);
                    ?>
                </div>

                <div class="float-centered mt-5">
                    <button
                            id="nextYearSpringBtn"
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
                <input id="tokenInput" type="hidden" name="token" value="autumn">
                <input type="hidden" name="advisor" value="">

                <div class="float-centered mt-5">
                    <button
                            id="prevYearFallBtn"
                            class="btn btn-lg bg-secondary text-white shadow-sm"
                            type="button"
                    >Add Year</button>
                </div>

                <div id="schoolYearsFall">

                    <?php
                        adminPlan($fallYear);
                    ?>
                </div>

                <div class="float-centered mt-5">
                    <button
                            id="nextYearFallBtn"
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


<!--Including the JS for the file-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>

<!-- Scripts to add years to form -->
<script src="<?php echo $GLOBALS['PROJECT_DIR'] ?>/scripts/addYearsToForm.js"></script>
<script src="<?php echo $GLOBALS['PROJECT_DIR'] ?>/scripts/addStandardizedYears.js"></script>

<!-- Script to toggle the visible standardized plan -->
<script src="<?php echo $GLOBALS['PROJECT_DIR'] ?>/scripts/toggleStandardizedPlans.js"></script>

<?php // Save Notification controller
    if (isset($formSubmitted) && $formSubmitted == true) {
        echo '<script src="'.$GLOBALS['PROJECT_DIR'].'/scripts/saveNotification.js"></script>';
    }
?>

</body>
</html>
