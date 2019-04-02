<?php
ob_start();

set_time_limit(60);

const included = true;

require_once "inc/helpers.inc.php";
require_once "inc/setup_database.inc.php";
require_once "inc/search.inc.php";

$get = $_GET; // shorthand access
if (!isset($get['q']) || $get['q'] === "") {
    header("Location: ../homepage.php");
}

// search query
$query = $conn->escape_string($get['q']);

// search db
$results = add_request($conn, $query); // returns [result, query time, totalRows] or null

?>