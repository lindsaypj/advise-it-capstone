<?php
class Backup {
    // FIELDS
    private $_dbh;

    function __construct($_dbh)
    {
        // Include configuration file and retrieve PDO object
        $this->_dbh = $_dbh;
    }

    function backUpPlans() {
        // Setting up, preparing, then executing sql statement
        $sql = "SELECT * FROM plans";
        $sql = $this->_dbh->prepare($sql);
        $sql->execute();

        // Fetching the plans
        $plans = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Setting the file name to include date/time (month-day-year_PST Time)
        date_default_timezone_set('America/Los_Angeles');
        $filename = 'export_' . date('m-d-Y_hia') . '.csv';

        // Send the appropriate headers to the browser so the file gets automatically downloaded by the user
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Open a PHP output stream and write the contents of the CSV file to it
        $output = fopen('php://output', 'w');
        foreach ($plans as $row) {
            fputcsv($output, $row);
        }

        // Close the output stream
        fclose($output);

        // Stop the script from executing any further
        exit;
    }
}




































