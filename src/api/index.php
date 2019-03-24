<?php

// Load application config
require 'config.php';
// Load CORS file
require 'cors.php';
// Load database query functions
require 'crud.php';

/**
 * Check for request
 */
if ($_GET) {
    if ($_GET['query'] == 'trips') {
        $db = openDatabaseConnection();
        trips($db);
    } else if ($_GET['query'] == 'totals') {
        $db = openDatabaseConnection();
        totals($db);
    } else if ($_GET['query'] == 'weekly' && isset($_GET['category'])) {
        $db = openDatabaseConnection();
        weekly($db, $_GET['category']);
    } else {
        echo "Invalid request.";
    }

} else {
    echo "NO REQUEST.";
}



//weekly($db);

// Weekly

?>