<?php
require_once "inc/inc.php";
require_once "inc/partials/_header.php";

if(!isLoggedIn())
  redirect('./login.php', false);

$user = user($conn, $_SESSION["id"]);
$query = viewRequest($conn, $_GET['id']);

if(empty($query))
  redirect(BASE_URL.'/requests.php', false);

if(deleteRequest($conn, $query['id']))
  redirect(BASE_URL.'/requests.php', false);

?>