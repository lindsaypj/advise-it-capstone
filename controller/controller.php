<?php

/**
 * Controller handles the routing and form validation for all the
 * pages in the Advise-IT website
 * @author Patrick Lindsay
 * @version 2.0
 * @date 2/7/23
 */
class Controller
{
    // FIELDS //
    private $_f3;

    // CONSTRUCTOR //
    /**
     * Constructor for Adivse-IT controller object
     * @param $f3 object used for controlling Fat-Free framework
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }


    // PAGE RENDERING METHODS //

    /**
     * Displays the home page (default page)
     */
    function home()
    {
        $newToken = $GLOBALS['datalayer']->generateToken();
        $this->_f3->set('newToken', $newToken);

        // Open login form if redirected
        if (isset($_SESSION['displayLogin']) && $_SESSION['displayLogin'] === true) {
            $this->_f3->set('displayForm', true);
            // IMPORTANT! CLEAR VALUE
            $_SESSION['displayLogin'] = false;
        }

        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Processes the login attempt and directs the user to the correct page accordingly.
     * If Login is successful, directs admin to admin page
     * if unsuccessful, directs user back to home page with error message
     */
    function loginAttempt() {
        $this->_f3->set('validLogin', false);
        $this->_f3->set('cancelLink', "");
        $this->_f3->set('username', "");

        // If the form has been submitted
        if (!empty($_POST)) {

            //Get the form data
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (isset($username)) {
                $this->_f3->set('username', $username);
            }

            // Validate not empty
            if ($username === "" && $password === "") {
                $this->_f3->set('errorMessage', "Please enter username and Password");
            }

            // Require the credentials file, which defines a $Logins array
            require($_SERVER['DOCUMENT_ROOT'].'/../users.php');
            if (!isset($logins)) {
                $this->_f3->set('errorMessage', "Failed to connect to server");
            }
            // If the username is in the array and the passwords match
            else if (array_key_exists($username, $logins)) {
                if ($password == $logins[$username]) {
                    //Record the username in the session array
                    $_SESSION['logged-in'] = true;
                    $_SESSION['username'] = $username;

                    header('location: admin');
                }
                else {
                    // Invalid login (password) -- set flag variable
                    $this->_f3->set('errorMessage', "Invalid username or password");
                }
            }
            else {
                //Invalid login (username) -- set flag variable
                if ($username !== "") {
                    $this->_f3->set('errorMessage', "Invalid username or password");
                }
            }
            // Failed to log in (Render Home page)
            $this->_f3->set('displayForm', true);

            $view = new Template();
            echo $view->render('views/home.html');
        }
    }

    /**
     * Clears the session and logs out the user.
     */
    function logout() {
        session_destroy();
        header("Location: ./");
    }

    /**
     * Renders the admin page if the user is logged in
     * Redirects user to home if not logged in
     */
    function admin() {
        // Check that the user is logged in
        if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] != true || !isset($_SESSION['username'])) {
            // Failed to log in (Render Login on Home page)
            $_SESSION['displayLogin'] = true;
            header('location: ./');
        }

        // Generate New Token for "Education Plan" Link
        $newToken = $GLOBALS['datalayer']->generateToken();
        $this->_f3->set('newToken', $newToken);

        // Get plan data
        $plans = $GLOBALS['datalayer']->getPlans();
        $this->_f3->set('plans', $plans);

        $view = new Template();
        echo $view->render('views/admin.html');
    }

    /**
     * Loads a plan if the passed token is valid. Handles form validation,
     * and sends data to datalayer for storage if valid.
     */
    function viewPlan($token)
    {
        // If token is invalid, redirect to home
        if (!(Validator::validToken($token))) {
            header('location: ../');
        }

        // Generate New Token for "Education Plan" Link
        $newToken = $GLOBALS['datalayer']->generateToken();
        $this->_f3->set('newToken', $newToken);

        // Initialize Variables to determine rendering characteristics
        $lastUpdated = ""; // Variable to store most recent save time
        $formSubmitted = false; // Display submitted form data + confirmation
        $saveSuccess = false; // Determines state of confirmation message
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

        // Pass data through F3 to be rendered
        $this->_f3->set('token', $token);
        $this->_f3->set('lastUpdated', $lastUpdated);
        $this->_f3->set('formSubmitted', $formSubmitted);
        $this->_f3->set('saveSuccess', $saveSuccess);
        $this->_f3->set('advisor', $advisor);
        $this->_f3->set('schoolYears', $schoolYears);

        // Render page
        $view = new Template();
        echo $view->render('views/education_plan.html');
    }

    // Method to render the admin footer links page if user is logged in
    function adminFooterLinks() {
        // Check that the user is logged in
        if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] != true || !isset($_SESSION['username'])) {
            // Failed to log in (Render Login on Home page)
            $_SESSION['displayLogin'] = true;
            header('location: ./');
        }


        // Generate New Token for "Education Plan" Link
        $newToken = $GLOBALS['datalayer']->generateToken();

        // Render page
        include('views/admin_footer_links.php');
    }
}