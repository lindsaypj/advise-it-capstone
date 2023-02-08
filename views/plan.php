<?php
// Requires the following variables be declared in F3
// @token: unique identifier for a student and their plan
// @lastUpdated: String representing the time the plan was last saved
// @formSubmitted: Boolean indicating whether the user submitted the form
// @saveSuccess: Boolean indicating whether the data was successfully stored in the database

// Display data (if found)
// @schoolYears, @advisor
?>

<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="/485/advise-it/styles/plan.css">
    <link rel="stylesheet" href="/485/advise-it/styles/print-plan.css">

    <title>Advise-IT {{ @token }} Plan</title>
</head>
<body>
    <div id="planPage" class="container bg-light">
        <!-- Header -->
        <div class="row pb-2">
            <div class="col">
                <!-- Homepage link -->
                <a class="position-absolute pt-3" href="/485/advise-it">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                    </svg>
                </a>

                <!-- Print button -->
                <button id="printBtn" class="btn text-primary p-1 pt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                    </svg>
                </button>

                <!-- Token -->
                <h1 class="text-center mt-3">Token: {{ @token }}</h1>

                <!-- Unique URL with token -->
                <div class="d-block align-middle text-center rounded token-url">
                    <div class="input-group mb-3 shadow-sm rounded">
                        <input
                            id="urlInput"
                            type="text"
                            class="form-control bg-white border-none"
                            aria-label="Current plan link"
                            aria-describedby="copy-url"
                            value="https://plindsay.greenriverdev.com/485/advise-it/view-plan/{{ @token }}"
                            disabled
                            aria-disabled="true"
                        >

                        <button class="btn btn-light border-none" type="button" id="copy-url">
                            <svg fill="#000000" height="16" width="16" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 viewBox="0 0 330 330" xml:space="preserve">
                                <g>
                                    <path d="M35,270h45v45c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15V75c0-8.284-6.716-15-15-15h-45V15
                                        c0-8.284-6.716-15-15-15H35c-8.284,0-15,6.716-15,15v240C20,263.284,26.716,270,35,270z M280,300H110V90h170V300z M50,30h170v30H95
                                        c-8.284,0-15,6.716-15,15v165H50V30z"/>
                                    <path d="M155,120c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15s-6.716-15-15-15H155z"/>
                                    <path d="M235,180h-80c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15S243.284,180,235,180z"/>
                                    <path d="M235,240h-80c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h80c8.284,0,15-6.716,15-15C250,246.716,243.284,240,235,240z
                                        "/>
                                </g>
                            </svg>
                        </button>
                    </div>
                </div> <!-- Token URL -->

            </div> <!-- Col -->
        </div> <!-- Row -->

        <form action="/485/advise-it/view-plan/{{ @token }}" method="post">

            <!-- Token Input -->
            <input id="tokenInput" type="hidden" name="token" value="{{ @token }}">

            <!-- Advisor -->
            <div class="row pb-4">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center mx-auto">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control border-none shadow-sm"
                            value="{{ @advisor }}"
                            name="advisor"
                            id="advisorInput"
                            placeholder="Advisor"
                        >
                        <label for="advisorInput">Advisor:</label>
                    </div>
                </div>
            </div>


            <!-- Add Previous school year -->
            <div class="row">
                <div class="col-12 text-center">
                    <button id="prevYearBtn" type="button" class="btn btn-primary">Add Previous School Year</button>
                </div>
            </div>
            <!-- Plan -->
            <div id="schoolYears">
            <repeat group="{{ @schoolYears }}" key="{{ @key }}" value="{{ @schoolYear }}">
                <?php // Only render if data is present ?>
                <check if="{{ @schoolYear['render'] }}">
                    <div id="{{ @key }}" class="row">
                        <div class="col-12 border-bottom mb-2 text-end">
                            <h3>{{ @schoolYear['winter']['calendarYear'] }}</h3>
                        </div>

                        <!-- FALL -->
                        <div class="col-md-6 col-12 pb-4">
                            <div class="form-floating">
                                <!-- Notes -->
                                <textarea
                                    class="form-control quarter-area shadow-sm border-none"
                                    placeholder="Leave a comment here"
                                    name="schoolYears[{{ @key }}][fall][notes]"
                                    id="fall{{ @schoolYear['fall']['calendarYear'] }}"
                                >{{ @schoolYear['fall']['notes'] }}</textarea>
                                <!-- Calendar Year -->
                                <input
                                    type="hidden"
                                    aria-hidden="true"
                                    name="schoolYears[{{ @key }}][fall][calendarYear]"
                                    value="{{ @schoolYear['fall']['calendarYear'] }}"
                                >
                                <label for="fall{{ @schoolYear['fall']['calendarYear'] }}">Fall {{ @schoolYear['fall']['calendarYear'] }}</label>
                            </div>
                        </div>

                        <!-- WINTER -->
                        <div class="col-md-6 col-12 pb-4">
                            <div class="form-floating">
                                <textarea
                                    class="form-control quarter-area shadow-sm border-none"
                                    placeholder="Leave a comment here"
                                    name="schoolYears[{{ @key }}][winter][notes]"
                                    id="winter{{ @schoolYear['winter']['calendarYear'] }}"
                                >{{ @schoolYear['winter']['notes'] }}</textarea>
                                <input
                                    type="hidden"
                                    aria-hidden="true"
                                    name="schoolYears[{{ @key }}][winter][calendarYear]"
                                    value="{{ @schoolYear['winter']['calendarYear'] }}"
                                >
                                <label for="winter{{ @schoolYear['winter']['calendarYear'] }}">Winter {{ @schoolYear['winter']['calendarYear'] }}</label>
                            </div>
                        </div>

                        <!-- SPRING -->
                        <div class="col-md-6 col-12 pb-4">
                            <div class="form-floating">
                                <textarea
                                    class="form-control quarter-area shadow-sm border-none"
                                    placeholder="Leave a comment here"
                                    name="schoolYears[{{ @key }}][spring][notes]"
                                    id="spring{{ @schoolYear['spring']['calendarYear'] }}"
                                >{{ @schoolYear['spring']['notes'] }}</textarea>
                                <input
                                    type="hidden"
                                    aria-hidden="true"
                                    name="schoolYears[{{ @key }}][spring][calendarYear]"
                                    value="{{ @schoolYear['spring']['calendarYear'] }}"
                                >
                                <label for="spring{{ @schoolYear['spring']['calendarYear'] }}">Spring {{ @schoolYear['spring']['calendarYear'] }}</label>
                            </div>
                        </div>

                        <!-- SUMMER -->
                        <div class="col-md-6 col-12 pb-4">
                            <div class="form-floating">
                                <textarea
                                    class="form-control quarter-area shadow-sm border-none"
                                    placeholder="Leave a comment here"
                                    name="schoolYears[{{ @key }}][summer][notes]"
                                    id="summer{{ @schoolYear['summer']['calendarYear'] }}"
                                >{{ @schoolYear['summer']['notes'] }}</textarea>
                                <input
                                    type="hidden"
                                    aria-hidden="true"
                                    name="schoolYears[{{ @key }}][summer][calendarYear]"
                                    value="{{ @schoolYear['summer']['calendarYear'] }}"
                                >
                                <label for="summer{{ @schoolYear['summer']['calendarYear'] }}">Summer {{ @schoolYear['summer']['calendarYear'] }}</label>
                            </div>
                        </div>
                    </div>
                </check>
            </repeat>
            </div>
            <!-- Add Next school year -->
            <div class="row mb-3">
                <div class="col-12 text-center">
                    <button id="nextYearBtn" type="button" class="btn btn-primary">Add Next School Year</button>
                </div>
            </div>

            <!-- Last Updated -->
            <div class="row">
                <div class="col-12">
                    <h4 class="text-center mb-3">
                        <check if="{{ @lastUpdated != null }}">
                            Last Updated: {{ @lastUpdated }}
                        </check>
                    </h4>
                </div>
            </div>


            <!-- Save Button -->
            <div class="row">
                <div class="col text-center">
                    <button class="btn btn-primary shadow-sm" type="submit" id="saveBtn">Save</button>
                </div>
            </div>

        </form>

        <!-- Save Notification -->
        <check if="{{ @formSubmitted }}">
        <check if="{{ @saveSuccess }}">
            <true>
                <!-- Success -->
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="saveNotification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill me-2" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                            </svg>
                            <strong class="me-auto">Success!</strong>
                            <small>{{ @lastUpdated }}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Plan successfully saved.
                        </div>
                    </div>
                </div>
            </true>
            <false>
                <!-- Error -->
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="saveNotification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                            </svg>
                            <strong class="me-auto">Error!</strong>
                            <small>{{ @lastUpdated }}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            There was an error saving plan data.
                        </div>
                    </div>
                </div>
            </false>
        </check>
        </check>

    </div> <!-- Container -->

    <!-- Print -->
    <div id="printPlan">
        <!-- Token -->
        <h1 class="text-center mt-3">Token: {{ @token }}</h1>

        <!-- Unique URL with token -->
        <div class="d-block align-middle text-center rounded token-url">
            <div class="mb-2 text-center">
                https://plindsay.greenriverdev.com/485/advise-it/view-plan/{{ @token }}
            </div>
        </div>

        <!-- Advisor -->
        <div class="row pb-2">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 text-center mx-auto">
                <div>
                    <span class="fw-bold">Advisor:</span> {{ @advisor }}
                </div>
            </div>
        </div>

        <!-- Plan -->
        <repeat group="{{ @schoolYears }}" key="{{ @key }}" value="{{ @schoolYear }}">
            <check if="{{ @schoolYear['render'] }}">
                <div class="row">
                    <!-- Year Header -->
                    <div class="col-12 border-bottom mb-2 text-end">
                        <h3>{{ @schoolYear['winter']['calendarYear'] }}</h3>
                    </div>

                    <!-- FALL -->
                    <div class="col-6 px-4 pb-3 quarter-area">
                        <p class="mb-0 fw-bold">Fall {{ @schoolYear['fall']['calendarYear'] }}</p>
                        <p class="plan-content">{{ @schoolYear['fall']['notes'] }}</p>
                    </div>

                    <!-- WINTER -->
                    <div class="col-6 px-4 pb-3 quarter-area">
                        <p class="mb-0 fw-bold">Winter {{ @schoolYear['winter']['calendarYear'] }}</p>
                        <p class="plan-content">{{ @schoolYear['winter']['notes'] }}</p>
                    </div>

                    <!-- SPRING -->
                    <div class="col-6 px-4 pb-2 quarter-area">
                        <p class="mb-0 fw-bold">Spring {{ @schoolYear['spring']['calendarYear'] }}</p>
                        <p class="plan-content">{{ @schoolYear['spring']['notes'] }}</p>
                    </div>

                    <!-- SUMMER -->
                    <div class="col-6 px-4 pb-2 quarter-area">
                        <p class="mb-0 fw-bold">Summer {{ @schoolYear['summer']['calendarYear'] }}</p>
                        <p class="plan-content">{{ @schoolYear['summer']['notes'] }}</p>
                    </div>
                </div>
            </check>
        </repeat>

        <!-- Last Updated -->
        <div class="col-12 mt-4">
            <h4 class="text-center mb-3">
                <check if="{{ @lastUpdated != null }}">
                    Last Updated: {{ @lastUpdated }}
                </check>
            </h4>
        </div>
    </div>

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Print script -->
    <script src="../scripts/printPlan.js"></script>
    <!-- Adding school Years -->
    <script src="../scripts/addYearsToForm.js"></script>
    <!-- Copy URL to clipboard script -->
    <script src="../scripts/copyToClipboard.js"></script>

    <check if="{{ @formSubmitted }}">
        <script src="../scripts/saveNotification.js"></script>
    </check>

</body>
</html>
