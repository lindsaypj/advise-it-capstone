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
    <link href="styles/admin.css" rel="stylesheet">

    <title>Advise-IT Admin</title>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mt-3">Admin Panel</h1>
            </div>
            <div class="table-container mt-4">
                <table class="table">
                    <tr>
                        <th>Token</th>
                        <th>URL</th>
                        <th>Advisor</th>
                        <th>Last Updated</th>
                    </tr>
                    <repeat group="{{ @plans }}" value="{{ @plan }}">
                        <tr>
                            <td>{{ @plan.token }}</td>
                            <td>
                                <a href="//plindsay.greenriverdev.com/485/advise-it/view-plan/{{ @plan.token }}" target="_blank">
                                    plindsay.greenriverdev.com/485/advise-it/view-plan/{{ @plan.token }}
                                </a>
                            </td>
                            <td>{{ @plan.advisor }}</td>
                            <td>{{ Formatter::formatTime(@plan.lastUpdated) }}</td>
                        </tr>
                    </repeat>
                </table>
            </div>
        </div>
    </div>


</body>
</html>
