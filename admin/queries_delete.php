<?php
require_once "inc/inc.php";
require_once "inc/partials/_header.php";

if(!isLoggedIn())
  redirect('./login.php', false);

$user = user($conn, $_SESSION["id"]);
$query = viewQuery($conn, $_GET['id']);

if(empty($query))
  redirect(BASE_URL.'/queries.php', false);

if(deleteQuery($conn, $query['query_id']))
  redirect(BASE_URL.'/queries.php', false);

?>