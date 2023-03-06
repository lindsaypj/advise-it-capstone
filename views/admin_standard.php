<?php

//TODO:  Goal of this page similar to education creating and editing the plan. Start with the controller for the routing.

//1). 3 Separate plan winter start, fall start, spring start.

//2). switch view for each quarter plan.

//3). tokens will be the same and education plan and not list the token or advisor just the last updated add year function.

//4). this would be just to edit


$winterYear;
$fallYear;
$springYear;
$lastUpdatedWinter;
$lastUpdatedFall;
$lastUpdatedSpring;
$newToken;

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
    <link rel="stylesheet" href="./styles/styles.css">

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Administration Standard View</title>
</head>
<body>
<nav class="navbar navbar-expand-lg nav-grc sticky-top grfont shadow-sm">
    <div>
        <a class="text-dark d-block bg-grcgreen p-3" href="./">
            <img src="https://www.greenriver.edu/media/site-assets/img/logo.png"
                 class="gr-logo">
        </a>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav align-items-center">
            <li class="nav-item active">
                <a class="nav-link text-dark" href="./view-plan/<?php echo $newToken ?>">
                    <h5 class="mb-0">Education Plan</h5>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-dark" href="admin">
                    <h5 class="mb-0">Admin</h5>
                </a>
            </li>
            <?php if($_SESSION['logged-in'] === true) {
                echo '<li class="nav-item active" >
                        <a class="nav-link text-dark" href = "logout" >
                            <h5 class="mb-0" > Logout</h5 >
                        </a >
                    </li >';
            }
            ?>
        </ul>
    </div>
    <div class="float-centered text-center mt-2 saved d-none">
			<span class="d-block text-dark">
				<?php if(!empty($lastUpdatedWinter)){
                    echo '<h5>Last Saved: '.$lastUpdatedWinter.'</h5>';
                }
				?>
			</span>
    </div>
    <div class="float-centered text-center mt-2 saved d-none">
			<span class="d-block text-dark">
				<?php if(!empty($lastUpdatedSpring)){
                    echo '<h5>Last Saved: '.$lastUpdatedSpring.'</h5>';
                }
                ?>
			</span>
    </div>
    <div class="float-centered text-center mt-2 saved d-none">
			<span class="d-block text-dark">
				<?php if(!empty($lastUpdatedFall)){
                    echo '<h5>Last Saved: '.$lastUpdatedFall.'</h5>';
                }
                ?>
			</span>
    </div>
</nav>
<!--Winter Plan-->
<div class="container mt-2 mb-5 pb-5 grfont">
    <div class="row justify-content-center mb-5 pb-5">
        <div class="col text-center">
            <h1 class="pt-5">Winter Start</h1>

            <form class="col-lg-8 offset-lg-2" method="post">

                <!-- Token Input -->
                <input id="tokenInput" type="hidden" name="token" value="winter">


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
<div class="container mt-2 mb-5 pb-5 grfont">
    <div class="row justify-content-center mb-5 pb-5">
        <div class="col text-center">
            <h1 class="pt-5">Spring Start</h1>

            <form class="col-lg-8 offset-lg-2" method="post">

                <!-- Token Input -->
                <input id="tokenInput" type="hidden" name="token" value="winter">


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
<div class="container mt-2 mb-5 pb-5 grfont">
    <div class="row justify-content-center mb-5 pb-5">
        <div class="col text-center">
            <h1 class="pt-5">Fall Start</h1>

            <form class="col-lg-8 offset-lg-2" method="post">

                <!-- Token Input -->
                <input id="tokenInput" type="hidden" name="token" value="winter">


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
<!--Including the JS for the file-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>
<!-- Script to add years to form -->
<script src="./scripts/addYearsToForm.js"></script>
<script src="./scripts/admin.js"></script>

</body>
</html>

