<?php
ob_start();
session_start();

set_time_limit(60);

const included = true;

require_once "../php/inc/helpers.inc.php";
require_once "../php/inc/setup_database.inc.php";

session_destroy(); 

redirect('./login.php', false);

?>