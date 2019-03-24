<?php

/**
 * Open the database connection with the credentials from config.php
 */
function openDatabaseConnection()
{
    // generate a database connection, using the PDO connector
    // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
    $db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS);
    return $db;
}

/**
 * Get the full list of all trips.
 */
function trips($db)
{
    
    $sql = "SELECT * FROM spending ORDER BY date";
    $query = $db->prepare($sql);
    $query->execute();

    $trips = $query->fetchAll(PDO::FETCH_ASSOC);

    echo JSON_ENCODE($trips);
    
}

/**
 * Get the total trips and total spent for each place.
 */
function totals($db) 
{
    $sql = "SELECT COUNT(amount) as count, SUM(amount) as total, place FROM spending GROUP BY place ORDER BY total DESC";
    $query = $db->prepare($sql);
    $query->execute();

    $totals = $query->fetchAll(PDO::FETCH_ASSOC);

    echo JSON_ENCODE($totals);
}

/**
 * Get the totals spent each week.
 */
function weekly($db, $category) 
{
    $sql = "SELECT SUM(amount) as total, YEARWEEK(date, 1) as yearweek FROM spending WHERE category = '$category' GROUP BY yearweek ORDER BY yearweek DESC";
    $query = $db->prepare($sql);
    $query->execute();

    $weeks = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($weeks as $key => $week) {
        $week['yearweek'] = substr_replace($week['yearweek'], "W", 4, 0);
        $weeks[$key]['yearweek'] = date('Y-m-d', strtotime($week['yearweek']));
    };

    echo JSON_ENCODE($weeks);
}

?>