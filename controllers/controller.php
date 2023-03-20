<?php

include '../classes/schedule.php';

class Controller {

    // ---------- Routing functions ----------
    function home() {
        $displayLoginForm = false;
        // Open login form if redirected
        if (isset($_SESSION['displayLogin']) && $_SESSION['displayLogin'] === true) {
            // IMPORTANT! CLEAR VALUE
            $_SESSION['displayLogin'] = false;
            $displayLoginForm = true;
        }

        // Generate token for new plan link/s
        $newToken = $GLOBALS['datalayer']->generateToken();
        $username = "";
        $errorMessage = "";

        // Render the view
        require 'views/home.php';
    }
    function studentPlan($token){
        //if token is not set or not a token or token is not a string
        if ((!(isset($token))) || !$token || gettype($token) !== "string"){
            http_response_code(404);
            require ("views/404.php");
            return; // Escape Controller
        }


        // If token is invalid, redirect to home
        if (!(Validator::validToken($token))) {
            http_response_code(404);
            require ($GLOBALS['PROJECT_DIR'] . "/views/404.php");
            return; // Escape Controller
        }

        // Initialize Variables to determine rendering characteristics
        $lastUpdated = ""; // Variable to store most recent save time
        $advisor = "";

        // Get token data from database
        $plan = $GLOBALS['datalayer']->getPlan($token);

        // Check if Token is stored in database
        if (empty($plan['token'])) {
            http_response_code(404);
            require ($GLOBALS['PROJECT_DIR'] . "/views/404.php");
            return; // Escape Controller
        }

        $token = $plan['token'];
        $lastUpdated = Formatter::formatTime($plan['lastUpdated']);
        $advisor = $plan['advisor'];
        $schoolYears = $plan['schoolYears'];

        //Render the page
        require 'views/student_plan.php';
    }
    function educationPlan($token) {
        // Generate Token if not passed
        if ((!(isset($token))) || !$token || gettype($token) !== "string") {
            $token = $GLOBALS['datalayer']->generateToken();
            // Add token to URL
            header('location: '.$GLOBALS['PROJECT_DIR'].'/plan/'.$token);
        }


        // If token is invalid, redirect to home
        if (!(Validator::validToken($token))) {
            header('location: '.$GLOBALS['PROJECT_DIR']);
            return; // Escape Controller
        }

        // Initialize Variables to determine rendering characteristics
        $lastUpdated = ""; // Variable to store most recent save time
        $formSubmitted = false; // Display submitted form data + confirmation
        $saveSuccess = false; // Determines state of confirmation message
        $saveMessage = "";
        $advisor = "";

        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $formSubmitted = true;

            // Store current token (if valid)
            if (Validator::validToken($_POST['token'])) {
                $token = $_POST['token'];
            }
            if (isset($_POST['advisor'])) {
                $advisor = $_POST['advisor'];
            }

            // Attempt to save data in POST to database
            if ($GLOBALS['datalayer']->planExists($token)) {
                // Plan is stored in database (UPDATE)
                $saveSuccess = $GLOBALS['datalayer']->updatePlan($token);
            }
            else {
                // Plan was not already in database (INSERT)
                $saveSuccess = $GLOBALS['datalayer']->saveNewPlan($token);
            }

            // Updated Notification message
            if ($saveSuccess) {
                $saveMessage = "Plan saved!";
            }
            else {
                $saveMessage = "An error occurred while saving plan";
            }
        }

        // Get token data from database
        $plan = $GLOBALS['datalayer']->getPlan($token);

        // Check if Token is stored in database (new plans are not in database)
        if (!empty($plan['token'])) {
            $token = $plan['token'];
            $lastUpdated = Formatter::formatTime($plan['lastUpdated']);
            $advisor = $plan['advisor'];
            $schoolYears = $plan['schoolYears'];
        }
        else { // No plan data (display current blank year)
            $schoolYears = DataLayer::createBlankPlan()['schoolYears'];
        }

        // Render the view
        require 'views/education_plan.php';
    }


    function login() {
        // Ensure form has been submitted
        if (empty($_POST)) {
            // Load home page (without login form)
            header("location: ".$GLOBALS['PROJECT_DIR']);
        }

        // Get the login form data (if present)
        $username = $_POST['username'] ?? "";
        $password = $_POST['password'] ?? "";

        // Validate not empty
        if ($username === "" || $password === "") {
            // Reload login form
            $this->failedLogin("Please enter username and Password", $username);
            return; // Escape controller
        }

        // Require the credentials file, which defines a $Logins array
        require($_SERVER['DOCUMENT_ROOT'].'/../users.php');
        if (!isset($logins)) {
            $this->failedLogin("Failed to connect to server", $username);
            return; // Escape controller
        }

        // Validate username (if credentials loaded)
        if (!array_key_exists($username, $logins)) {
            //Invalid login (username) -- set flag variable
            $this->failedLogin("Invalid username or password", $username);
            return; // Escape controller
        }
        
        // Validate Password
        if ($password !== $logins[$username]) {
            // Invalid login (password) -- set flag variable
            $this->failedLogin("Invalid username or password", $username);
            return; // Escape controller
        }
        
        // ==== LOGGED IN ==== //

        //Record the username in the session array
        $_SESSION['logged-in'] = true;
        $_SESSION['username'] = $username;

        // Load admin page!
        header('location: admin');
    }


    function admin() {
        // Check that the user is logged in
        $this->checkLoggedIn();

        // Generate New Token for "Education Plan" Link
        $newToken = $GLOBALS['datalayer']->generateToken();

        // Get plan data
        $plans = $GLOBALS['datalayer']->getPlans();

        // Render the view
        require 'views/admin.php';
    }

    function adminStandard() {
        // Check that the user is logged in
        $this->checkLoggedIn();

        //get plan data
        $winterPlan = $GLOBALS['datalayer']->getPlan('winter');
        $fallPlan = $GLOBALS['datalayer']->getPlan('autumn');
        $springPlan = $GLOBALS['datalayer']->getPlan('spring');

        //parse the data how to load on page
        $lastUpdatedWinter = Formatter::formatTime($winterPlan['lastUpdated']);
        $lastUpdatedFall = Formatter::formatTime($fallPlan['lastUpdated']);
        $lastUpdatedSpring = Formatter::formatTime($springPlan['lastUpdated']);

        //school year data
        $winterYear = $winterPlan['schoolYears'];
        $fallYear = $fallPlan['schoolYears'];
        $springYear = $springPlan['schoolYears'];

        //Initialize variable
        $formSubmitted = false;//set to false
        $saveSuccess = false; // Determines state of confirmation message

        //Check if current plan is submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
            $formSubmitted = true;

            // Validate token
            if(!Validator::validToken($_POST['token'])){
                header('location: logout');
            }
            if($_POST['token'] !== "winter" && $_POST['token'] !== "spring" && $_POST['token'] !== "autumn"){
                header('location: logout');
            }

            // Attempt to update standardized plan
            $saveSuccess = $GLOBALS['datalayer']->updatePlan($_POST['token']);
            if($saveSuccess) {
                // Get token data from database
                $updatedPlan = $GLOBALS['datalayer']->getPlan($_POST['token']);

                // Update Render data
                switch($_POST['token']) {
                    case "winter":
                        // Check if Token is stored in database (new plans are not in database)
                        if (!empty($updatedPlan['token'])) {
                            $lastUpdatedWinter = Formatter::formatTime($updatedPlan['lastUpdated']);
                            $winterYear = $updatedPlan['schoolYears'];
                        }
                        else { // No plan data (display current blank year)
                            $winterYear = DataLayer::createBlankPlan()['schoolYears'];
                        }
                        $saveMessage = "Winter Plan Updated";
                        break;
                    case "spring":
                        // Check if Token is stored in database (new plans are not in database)
                        if (!empty($updatedPlan['token'])) {
                            $lastUpdatedSpring = Formatter::formatTime($updatedPlan['lastUpdated']);
                            $springYear = $updatedPlan['schoolYears'];
                        }
                        else { // No plan data (display current blank year)
                            $springYear = DataLayer::createBlankPlan()['schoolYears'];
                        }
                        $saveMessage = "Spring Plan Updated";
                        break;
                    case "autumn":
                        // Check if Token is stored in database (new plans are not in database)
                        if (!empty($updatedPlan['token'])) {
                            $lastUpdatedFall = Formatter::formatTime($updatedPlan['lastUpdated']);
                            $fallYear = $updatedPlan['schoolYears'];
                        }
                        else { // No plan data (display current blank year)
                            $fallYear = DataLayer::createBlankPlan()['schoolYears'];
                        }
                        $saveMessage = "Fall Plan Updated";
                        break;
                }
            }
            else {
                $saveMessage = "An error occurred while updating plan";
            }
        }
        require("views/admin_standard.php");
    }

    // Method to render the admin footer links page if user is logged in
    function adminFooterLinks() {
        // Ensure that the user is logged in
        $this->checkLoggedIn();

        // Get links to render on the page
        $links = $GLOBALS['datalayer']->getLinks();
        // Generate New Token for "Education Plan" Link
        $newToken = $GLOBALS['datalayer']->generateToken();

        $saveSuccess = null;
        $saveMessage = "";

        // Check for Form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

            ///  Handle CREATE Footer Link  ///
            if (isset($_POST['add-link']) && isset($_POST['add-name'])) {
                // Validate then add link
                // Returns error message if error occurred, otherwise ""
                $saveMessage = $this->validateAndAddLink();
                $saveSuccess = $saveMessage === "";

                if ($saveSuccess) {
                    // ===== SAVED NEW LINK ===== //
                    $saveMessage = $_POST['add-name'] . " Link Created!";

                    // Add new link to links list to be rendered
                    $links = Formatter::addToSortedLinks($links, $_POST['add-name'], $_POST['add-link']);

                    // Clear post data to prevent add form re-population
                    $_POST = array();
                }
            }

            ///  Handle UPDATE Footer Link  ///
            else if (isset($_POST['edit-link']) && isset($_POST['new-name']) && isset($_POST['new-link'])) {
                // Validate changed values
                if (!Validator::validLink($_POST['new-name'], $_POST['new-link'])) {
                    $saveSuccess = false;
                    $saveMessage = "Invalid Link";
                }
                // NAME CHANGED (Create new link & remove old)
                else if ($_POST['edit-link'] !== $_POST['new-name']) {
                    // Validate then add link with new name
                    // Returns error message if error occurred, otherwise ""
                    $saveMessage = $this->validateLinkNameChange();
                    $saveSuccess = $saveMessage === "";

                    if ($saveSuccess) {
                        // ===== LINK UPDATED ===== //
                        $saveMessage = $_POST['new-name']." link updated!";

                        // Remove link with old name (prevent duplicates)
                        $GLOBALS['datalayer']->deleteFooterLink($_POST['edit-link']);

                        // Reformat Links for render
                        $links = Formatter::removeLink($links, $_POST['edit-link']);
                        $links = Formatter::addToSortedLinks($links, $_POST['new-name'], $_POST['new-link']);
                    }
                }
                // Update link (name did not change)
                else {
                    // Validate then add link with new name
                    // Returns error message if error occurred, otherwise ""
                    $saveMessage = $this->validateAndUpdateLink();
                    $saveSuccess = $saveMessage === "";

                    if ($saveSuccess) {
                        // ===== LINK UPDATED ===== //
                        $saveMessage = $_POST['new-name']." link updated!";

                        $links = Formatter::removeLink($links, $_POST['edit-link']);
                        $links = Formatter::addToSortedLinks($links, $_POST['new-name'], $_POST['new-link']);
                    }
                }
            }
            ///  Handle DELETE Footer Link  ///
            else if (isset($_POST['delete-link'])) {
                // Check that link exists
                if (!$GLOBALS['datalayer']->footerLinkExists($_POST['delete-link'])) {
                    // Link does not exist
                    $saveSuccess = false;
                    $saveMessage = "Link does not exist";
                }

                // Attempt to delete
                if (!$GLOBALS['datalayer']->deleteFooterLink($_POST['delete-link'])) {
                    $saveSuccess = false;
                    $saveMessage = "An error occurred while deleting";
                }
                else {
                    // ===== LINK DELETED ===== //
                    // Create notification message
                    $saveMessage = "Link deleted";
                    // Remove link from display links
                    $links = Formatter::removeLink($links, $_POST['delete-link']);
                }
            }
        }
        // Render page
        include('views/admin_footer_links.php');
    }

    // ---------- Helper functions ----------

    // Helper method to reload login form on a failed login attempt
    private function failedLogin($errorMessage, $username) {
        // Error message and username are loaded on page
        // Open login form on load
        $displayLoginForm = true;

        // Load home page
        $newToken = $GLOBALS['datalayer']->generateToken();
        require 'views/home.php';
    }

    // Function to check if the user is logged in
    private function checkLoggedIn() {
        if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] != true || !isset($_SESSION['username'])) {
            // Failed to log in (Render Login on Home page)
            $_SESSION['displayLogin'] = true;
            header('location: '.$GLOBALS['PROJECT_DIR']);
        }
    }

    function logout() {
        session_destroy();
        // Redirect to home page
        header("Location: ".$GLOBALS['PROJECT_DIR']);
    }

    private function validateAndAddLink() {
        // Validate
        if (!Validator::validLink($_POST['add-name'], $_POST['add-link'])) {
            // Validation Failed
            return "Invalid Link";
        }

        // Check if link name already exists (Prevent duplicate)
        if ($GLOBALS['datalayer']->footerLinkExists($_POST['add-name'])) {
            return "Link name already in use";
        }

        // Add to database
        if (!$GLOBALS['datalayer']->addFooterLink($_POST['add-name'], $_POST['add-link'])) {
            // Error saving to database
            return "An error occurred while saving";
        }
        return "";
    }

    private function validateLinkNameChange() {
        // Check if link name already exists
        if ($GLOBALS['datalayer']->footerLinkExists($_POST['new-name'])) {
            return "Link name already in use";
        }
        // Create new link and remove old (name changed)
        // Add link with new name to database
        if (!$GLOBALS['datalayer']->addFooterLink($_POST['new-name'], $_POST['new-link'])) {
            // Error saving updated link to database
            return "An error occurred while saving";
        }
        return "";
    }

    private function validateAndUpdateLink() {
        // Check that link actually exists
        if (!$GLOBALS['datalayer']->footerLinkExists($_POST['new-name'])) {
            // Link doesn't exist
            return "Link doesn't exist...";
        }
        // Attempt to update link
        if (!$GLOBALS['datalayer']->updateFooterLink($_POST['new-name'], $_POST['new-link'])) {
            // Update Failed
            return "An error occurred while updating";
        }
        return "";
    }
}

