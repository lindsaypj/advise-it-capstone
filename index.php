<?php
// Include dependencies (ORDER IS REQUIRED)
require_once('./model/Formatter.php');
require_once('./model/Validator.php');
require_once('./model/DataLayer.php');
require_once('./model/Backup.php');
require_once('./controllers/controller.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../config.php'); // Variable $dbh (PDO) is defined within


// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Initialize globals

$controller = new Controller();
$datalayer = new DataLayer($dbh);
$GLOBALS['backup'] = new Backup($dbh);

// Get project file path relative to root (e.g. "/485/advise-it-capstone")
$PROJECT_DIR = dirname($_SERVER['PHP_SELF']);
if ($PROJECT_DIR === "/") {
    $PROJECT_DIR = "";
}

// Subtract project directory path from request to get relative request path
$request = substr($_SERVER['REQUEST_URI'], strlen($PROJECT_DIR));


// Parse token if passed in URL
if (substr($request, 0, 5) === "/plan") {
    // Check for query params (for loading standard plan)
    $queryIndex = strpos($request, "?");
    if ($queryIndex !== false) {
        // Save query params in session for access when loading plan page
        // Session storage is required to retain data in the event that educationPlan()
        // generates a new token and redirects to back to the plan
        $_SESSION['query'] = $_GET;
        $request = substr($request, 0, $queryIndex);
        header('location: '.$GLOBALS['PROJECT_DIR'].$request);
        // Prevent script from reaching controller
        exit; // This is needed to prevent educationPlan() from consuming Query data
    }

    // Extract token from "/plan/123ABC"
    $token = substr($request, 6);

    // Remove token for switch -> "/plan"
    $request = substr($request, 0, 5);
}
else if(substr($request, 0, 13) === "/student-plan"){
    //Extract the token from "/student-plan/123ABC"
    $token = substr($request, 14);
    //Remove token for switch -> "/student-plan"
    $request = substr($request, 0, 13);
}

switch ($request) {
    case '/':
    case '':
        // Handle post (login)
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $controller->login();
        }
        else {
            $controller->home();
        }
        break;
    case '/plan':
        $controller->educationPlan($token);
        break;
    case '/admin':
        $controller->admin();
        break;
    case '/admin-footer-links':
        $controller->adminFooterLinks();
        break;
    case '/standardized-plans':
        $controller->adminStandard();
        break;
    case '/student-plan':
        $controller->studentPlan($token);
        break;
    case '/logout':
        $controller->logout();
        break;
    default:
        http_response_code(404);
        require __DIR__ . ("/views/404.php");
        break;
}
