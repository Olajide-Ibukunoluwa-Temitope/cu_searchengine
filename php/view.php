<?php
ob_start();

set_time_limit(60);

const included = true;

require_once "inc/helpers.inc.php";
require_once "inc/setup_database.inc.php";
require_once "inc/search.inc.php";

$query = explode("_", $_GET['res']);
$query_id = $query[0];

//get from db
$result = view_result($conn, $query_id);

$title = $result[1];
$content = $result[2];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $title ?></title>

	<link rel="icon" href="../assets/images/favicon.ico">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.css">
    <!-- <link href="../assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="../assets/css/styles.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background-color: #e9ecef">
	<div class="row">
		<div class="col-sm-3">
			<div class="card" style="height: 350px; background-color: #dee2e6">
				<div class="card-body text-white">
					<a href="../homepage.php">
						<img src="../assets/images/cu_searchengine2.jpeg" style="width: 200px; height: 100px;">
					</a>
					<div class="font-weight-bold" style="font-size: 30px; font-family: Times New Roman, Times, serif">
						<span style="color: yellow;">COVENANT</span><br>
						<span style="color: orange;">UNIVERSITY</span><br>
						<span style="color: red;">SEARCH</span><br>
						<span style="color: maroon;">ENGINE</span>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-9">
			<div class="card bg-primary">
				<div class="card-body text-white" style="background-image: url(../assets/images/cu_aerial.jpg); background-position: center center; background-repeat: no-repeat; background-size: cover; height: 350px;">
				</div>
			</div>
		</div>
	</div>
	<br><br>

	<section>
		<div class="row">
			<div class="col-sm-3">
				<div class="card">
					<div class="card-body">
						<span>big space</span><br>
						<span>big space</span><br>
						<span>big space</span><br>
						<span>big space</span><br>
						<br><br><br><br><br><br>
					</div>
				</div>
			</div>

			<div class="col-sm-9 ">
				<div class="card">
					<div class="card-body">
						<div class="text-dark font-italic ">
							<h2 class="pb-2 border-bottom"><?php echo $title ?></h2>
						</div>
						<div class="font-weight-light">
							<?php echo $content; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>