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
                    <h5 class="mb-0">Blank Plan</h5>
                </a>
            </li>
            <?php ////   Standard Plan Selection (only show on plan page)   ////
            if ($GLOBALS['request'] === "/plan") {
                echo '<li class="nav-item active">
                        <button
                            class="nav-link text-dark border-0 bg-transparent fs-5"
                            data-bs-toggle="modal"
                            data-bs-target="#standardPlanModal"
                        >Use Standard Plan</button>
                    </li>';
            }

            // Admin Login/Link button
            echo '<li class="nav-item active">
                    <a class="nav-link text-dark" href="'.$GLOBALS['PROJECT_DIR'].'/admin">
                        <h5 class="mb-0">Admin</h5>
                    </a>
                </li>';

            // Print Button
            if($GLOBALS['request'] === "/plan"){
                echo
                    '<button id="printBtn" class="nav-item active float-right ">
                        <img src="'.$GLOBALS['PROJECT_DIR'].'/images/printer.png" width="100px" height="90px">
                    </button>';
            }
            ?>
        </ul>
    </div>
    <?php
        if (isset($lastUpdated) && !empty($lastUpdated)) {
            echo
            '<div class="float-centered text-center mt-2 saved">
                <span class="d-block text-dark">
                    <h5>Last Saved: '.$lastUpdated.'</h5>
                </span>
            </div>';
        }
        else if (isset($lastUpdatedWinter) && !empty($lastUpdatedWinter)) {
            echo '<div class="float-centered text-center mt-2 saved d-none">
                    <span class="d-block text-dark">
                            <h5>Last Saved: '.$lastUpdatedWinter.'</h5>
                    </span>
                </div>';
        }
        else if (isset($lastUpdatedSpring) && !empty($lastUpdatedSpring)) {
            echo '<div class="float-centered text-center mt-2 saved d-none">
                    <span class="d-block text-dark">
                            <h5>Last Saved: '.$lastUpdatedSpring.'</h5>
                    </span>
                </div>';
        }
        else if (isset($lastUpdatedFall) && !empty($lastUpdatedFall)) {
            echo '<div class="float-centered text-center mt-2 saved d-none">
                    <span class="d-block text-dark">
                            <h5>Last Saved: '.$lastUpdatedFall.'</h5>
                    </span>
                </div>';
        }
    ?>

</nav>