<?php
    // Advise-IT home page
    // Introduces the Advise-IT tool and contains paths to new plan and
    // admin pages.
    // Author: Patrick Lindsay
    // Date: 1/24/23
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Custom styles -->
    <link href="styles/login.css" rel="stylesheet">

    <title>Advise-IT</title>
</head>
<body>
    <!-- Login Button -->
    <button type="button" class="btn btn-primary float-end mt-4 me-5" data-bs-toggle="modal" data-bs-target="#loginModal">
        Admin
    </button>
    <!-- Header -->
    <div class="bg-light p-5">
        <h1 class="display-4">Welcome to Advise-it</h1>
        <p class="lead">This is a tool for the Advising Staff</p>
        <hr class="my-4">
        <p></p>
        <!-- Button already here just need to send it somewhere on click -->
        <p>
            <a class="btn btn-primary btn-lg" href="view-plan/{{ @newToken }}" role="button">Create New Plan</a>
        </p>
    </div>

    <!-- LOGIN Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Admin Login</h5>
                </div>

                <form action="" method="post" class="m-0 px-3 text-shadow-none w-100">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ @username }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" >
                        </div>
                        <check if="{{ @validLogin == false }}">
                            <p class='error'>{{ @errorMessage }}</p>
                        </check>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" href="{{ @cancelLink }}">Cancel</a>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Open Login modal if attempt was made -->
    <check if="{{ @displayForm }}">
        <script src="scripts/displayLogin.js"></script>
    </check>
</body>
</html>