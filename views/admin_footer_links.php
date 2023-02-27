<?php

// Link Data should be gotten from datalayer via controller

// Variables used to render data (initialized in controller)
$newToken; // Newly generated token for navbar education plan link
$links; // Array of footer links to be rendered {$link.name, $link.link}

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
    <link rel="stylesheet" href="styles/styles.css">

    <title>Edit Footer Links</title>
</head>
<body>
    <?php // Navbar ?>
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
                <check if="$_SESSION['loggedIn'] === true">
                    <li class="nav-item active">
                        <a class="nav-link text-dark" href="logout">
                            <h5 class="mb-0">Logout</h5>
                        </a>
                    </li>
                </check>
            </ul>
        </div>
    </nav>

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
                        echo '<tr>'.
                                '<td>'.$link['name'].'</td>'.
                                '<td><a href="'.$link['link'].'" target="blank">'.$link['link'].'</a></td>'.
                                '<td><button class="btn btn-secondary py-0" id="edit-'.$index.'">Edit</button></td>'.
                                '<td><button class="btn btn-secondary py-0" id="delete-'.$index.'">Delete</button></td>'.
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
                <form id="new-link-form">
                    <table class="table table-responsive">
                        <tbody class="border-0">
                            <tr class="border-0">
                                <td class="border-0 p-3 pe-0">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control">

                                </td>
                                <td class="border-0 p-3 pe-0">
                                    <label class="form-label">Link</label>
                                    <input type="text" class="form-control">

                                </td>
                                <td class="border-0 text-center align-bottom py-3">
                                    <button class="btn btn-secondary py-1">Add</button>
                                </td>
                            </tr>
                        </tbody>

                    </table>



                </form>
            </div>
        </div>


    </div>

    <!-- Save Notification -->
<!--    <div class="toast-container position-fixed bottom-0 end-0 p-3">-->
<!--        <div id="saveNotification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">-->
<!--            <div class="toast-header text-success">-->
<!--                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill me-2" viewBox="0 0 16 16">-->
<!--                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>-->
<!--                </svg>-->
<!--                <strong id="note-head" class="me-auto"></strong>-->
<!--                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>-->
<!--            </div>-->
<!--            <div id="note-body" class="toast-body"></div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <check if="{{ @formSubmitted }}">-->
<!--        <check if="{{ @saveSuccess }}">-->
<!--            <false>-->
<!--                <-- Error -->
<!--                <div class="toast-container position-fixed bottom-0 end-0 p-3">-->
<!--                    <div id="saveNotification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">-->
<!--                        <div class="toast-header text-danger">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">-->
<!--                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>-->
<!--                            </svg>-->
<!--                            <strong class="me-auto">Error!</strong>-->
<!--                            <small>{{ @lastUpdated }}</small>-->
<!--                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>-->
<!--                        </div>-->
<!--                        <div class="toast-body">-->
<!--                            There was an error saving plan data.-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </false>-->
<!--        </check>-->
<!--    </check>-->


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
    <!-- Save Notification controller -->
    <script src="../scripts/saveNotification.js"></script>
</body>
</html>
