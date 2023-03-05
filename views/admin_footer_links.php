<?php

// Link Data should be gotten from datalayer via controller

// Variables used to render data (initialized in controller)
$links; // Array of footer links to be rendered {$link.name, $link.link}
$saveSuccess; // Indicates the state of the notification
$saveMessage; // Stores the error/success message

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Styles -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="<?php echo $GLOBALS['PROJECT_DIR'] ?>/styles/styles.css">

    <title>Edit Footer Links</title>
</head>
<body>
    <?php // Navbar
        include "includes/navbar.php";
    ?>

    <div class="container mt-2 pb-4 grfont">
        <?php // Header ?>
        <div class="row justify-content-center">
            <div class="col text-center">
                <h1 class="pt-5">Edit Footer Links</h1>
                <hr class="shadow-sm">
            </div>
        </div>

        <?php // List of current links ?>
        <div class="row">
            <div class="col-12">
                <table id="links" class="table table-responsive table-bordered text-center shadow-sm">
                    <thead class="bg-grcgreen">
                        <tr>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php // Display links
                    foreach ($links as $index=>$link) {
                        echo '<tr id="row-'.$index.'">'.
                                '<td>'.$link['name'].'</td>'.
                                '<td>
                                    <a href="'.$link['link'].'" target="blank">'.$link['link'].'</a>
                                </td>'.
                                '<td>
                                    <button
                                        type="button"
                                        class="btn btn-secondary py-0 edit-btn"
                                        id="edit-'.$index.'"
                                    >Edit</button>
                                </td>'.
                                '<td>
                                    <button
                                        type="button"
                                        class="btn btn-secondary py-0 delete-btn"
                                        id="delete-'.$index.'"
                                    >Delete</button>
                                </td>'.
                            '</tr>';
                    }
                    ?>
                    </tbody>

                </table>
            </div>
        </div>

        <?php // Footer link creation form  ?>
        <div class="row mt-4">
            <div class="col-12">
                <h3>Add New Link</h3>
                <form id="new-link-form" method="post">
                    <table class="table">
                        <tbody class="border-0">
                            <tr class="border-0">
                                <td class="border-0 p-3 pe-0">
                                    <label for="add-name" class="form-label">Name</label>
                                    <input
                                        id="add-name"
                                        type="text"
                                        name="add-name"
                                        class="form-control"
                                        <?php if (isset($_POST['add-name'])) echo 'value="'.$_POST['add-name'].'"' ?>
                                    >
                                </td>
                                <td class="border-0 p-3 pe-0">
                                    <label for="add-link" class="form-label">Link</label>
                                    <input
                                        id="add-link"
                                        type="text"
                                        name="add-link"
                                        class="form-control"
                                        <?php if (isset($_POST['add-link'])) echo 'value="'.$_POST['add-link'].'"' ?>
                                    >
                                </td>
                                <td class="border-0 text-center align-bottom py-3">
                                    <button type="submit" class="btn btn-secondary">Add</button>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </form>
            </div>
        </div>
    </div>

    <!-- Save Notification -->
    <?php
    if (isset($saveSuccess)) {
        if ($saveSuccess === true) {
            // Success
            echo
            '<div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="saveNotification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill me-2" viewBox="0 0 16 16">
                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                        </svg>
                        <strong class="me-auto">Success!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        '.$saveMessage.'
                    </div>
                </div>
            </div>';
        }
        else if ($saveSuccess === false) {
            // Error
            echo
            '<div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="saveNotification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg>
                            <strong class="me-auto">Error!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            '.$saveMessage.'
                        </div>
                    </div>
                </div>';
        }
    }
    ?>

    <!-- JavaScript -->
    <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous">
    </script>
    <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
            crossorigin="anonymous">
    </script>
    <!-- Front-End Validation -->
    <script src="<?php echo $GLOBALS['PROJECT_DIR'] ?>/scripts/footerLinkValidation.js"></script>
    <!-- Delete Confirmation Form -->
    <script src="<?php echo $GLOBALS['PROJECT_DIR'] ?>/scripts/footerLinkDeleteForm.js"></script>
    <!-- Edit Form -->
    <script src="<?php echo $GLOBALS['PROJECT_DIR'] ?>/scripts/footerLinkEditForm.js"></script>

    <?php // Save Notification controller
        if (isset($saveSuccess)) {
            echo '<script src="'.$GLOBALS['PROJECT_DIR'].'/scripts/saveNotification.js"></script>';
        }
    ?>
</body>
</html>
