<?php
require_once "inc/inc.php";

session_destroy(); 

redirect('./login.php', false);

?>