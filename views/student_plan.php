<?php
// Required variables to be declared in controller prior to loading page
// Ignore "Undefined variable" error message
$schoolYears;
$advisor;

?>

<!doctype html>
<html lang="en">
<head>
    <?php require "includes/head-includes.php"?>

    <title>Student Plan</title>
</head>

<body>
<nav class="navbar navbar-expand-lg nav-grc sticky-top grfont shadow-sm">
    <div>
        <a class="text-dark d-block bg-grcgreen p-3" href="<?php echo $GLOBALS['PROJECT_DIR']; ?>">
            <img src="https://www.greenriver.edu/media/site-assets/img/logo.png"
                 class="gr-logo">
        </a>
    </div>
    <?php include "includes/print.php"; ?>
    <?php include "includes/last_updated.php"; ?>

</nav>
<!--Student Plan -->
<div class="container mt-2 mb-5 pb-5 grfont">
    <div class="row justify-content-center mb-5 pb-5">
        <div class="col text-center">
            <div class="col-lg-8 offset-lg-2">
                <h1 class="pt-5">Student Plan </h1>
                <h4>
                    Advisor: <?php echo $advisor; ?>
                </h4>
                <div id="schoolYears">
                    <?php
                    foreach ($schoolYears as $year=>$schoolYear) {
                        if (isset($schoolYear['render'])) {
                            echo
                                '<div id="'.$year.'" class="container p-0">
            
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
            </div>
        </div>
    </div>
</div>
    <!-- Bootstrap JS -->
    <?php require "includes/bootstrap-js.html"?>

    <!-- Script to handle Print button -->
    <script src="<?php echo $GLOBALS['PROJECT_DIR']; ?>/scripts/print.js"></script>
</body>
</html>