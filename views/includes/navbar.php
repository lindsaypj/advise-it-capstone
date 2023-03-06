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