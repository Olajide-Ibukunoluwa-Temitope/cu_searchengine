<?php
ob_start();
session_start();

set_time_limit(60);

const included = true;
const BASE_URL = 'http://localhost:8080/cu_searchengine/admin'; //change for server

require_once "../php/inc/helpers.inc.php";
require_once "../php/inc/setup_database.inc.php";
require_once "functions.php";


?>