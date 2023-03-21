<?php
    // Required Variables to be assigned in controller
    // IGNORE "Undefined variable" errors
    $plans;

?>

<!doctype html>
<html lang="en">
<head>
    <?php require "includes/head-includes.php"?>

    <title>Admin Table</title>
</head>

<body class="">
    <!--NAVBAR-->
    <?php include "includes/admin-navbar.php"; ?>

    <div class="container mt-2 grfont">
        <div class="row justify-content-center">
            <div class="col text-center">
                <h1 class="pt-5">Academic Schedules</h1>
                <hr class="shadow-sm">
            </div>
        </div>
        <!-- Admin Table -->
        <section class="ml-5 mr-5 p-5">
            <table class="table table-responsive table-bordered table-hover text-center shadow-sm">
                <thead class="bg-grcgreen">
                    <tr>
                        <th scope="col">Token</th>
                        <th scope="col">URL</th>
                        <th scope="col">Advisor</th>
                        <th scope="col">Last Saved</th>
                    </tr>
                </thead>
                <tbody>
                    <!--Repeating section to show all data in table from database-->
                    <?php
                        foreach ($plans as $plan) {
                            $url = $GLOBALS['PROJECT_DIR'].'/plan/'.$plan['token'];
                            echo
                            '<tr>
                                <td>'.$plan['token'].'</td>
                                <td>
                                    <a href="'.$url.'" target="_blank">
                                        https://adviseit.greenriverdev.com'.$url.'
                                    </a>
                                </td>
                                <td>'.$plan['advisor'].'</td>
                                <td>'. Formatter::formatTime($plan['lastUpdated']) .'</td>
                            </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
    <!-- Footer -->
    <?php include('includes/footer.php'); ?>

    <!-- Bootstrap JS -->
    <?php require "includes/bootstrap-js.html"?>
</body>
</html>