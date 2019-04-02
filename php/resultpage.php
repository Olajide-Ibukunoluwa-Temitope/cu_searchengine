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

// index to start at (pagination)
$startAt = isset($get['start']) ? $get['start'] : 1;
$startAt = ($startAt - 1) * 10;

// search db
$results = search($conn, "$query", $startAt); // returns [result, query time, totalRows] or null

if (is_array($results)) {
    $searchResult = $results[0];
    $queryTime = $results[1];
    $totalRows = $results[2];
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $query." - " ?> cu_searchengine search</title>

    <link rel="icon" href="../assets/images/favicon.ico">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/styles.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container ml-0 pl-0">

      <div class="row">
        <div class="col-md-10" style="margin-right: 80%;">
          <div class="navbar-header">
            <a class="navbar-brand mt-4" href="../../homepage.php">
              <img width="110" height="27" src='../assets/images/cu_searchengine2.jpeg'/>
            </a>
          </div>

          <div id="navbar" class="collapse navbar-collapse">
            <form action="./resultpage.php" class="form-inline">
              <div class="form-group">
                <input value="<?php echo $query; ?>" name="q" type="search" style="width: 400px;" class="form-control box input-lg mr-2" id="search_box">
                <!-- <button type="submit" class="btn btn-primary btn-lg" style="padding-top: 8px; padding-bottom: 8px;">search</button> -->
                <button type="submit" class="btn btn-primary btn-lg" style="padding-right: 20px; padding-left: 20px; padding-top: 10px; padding-bottom: 5px;"><h4>search</h4></button>
              </div>
            </form>
          </div><!--/.nav-collapse -->
        </div>

      </div>

    </div>
  </nav>


    <div class="container" style="width: 631px; margin-left: 17.3%;">
      
        <?php
        if (!$results) {
            noResult();
        } // no result

        else {
            displayResults($searchResult);
        }
        ?>

        <?php
        function displayResults($data)
        {
            global
             $queryTime,
             $query,
             $totalRows,
             $startAt;
          
            if ($startAt === 0) {
                echo "<span class='results-count'> $totalRows Result(s)  (".round($queryTime, 2)." seconds) </span> <br><br>";
            } else {
                echo "<span> $totalRows Result(s)  (".round($queryTime, 2)." seconds) </span> <br> 
                <span class='results-count'> Page ".(($startAt/10) + 1)." </span> <br><br>";
            } 

            while ($row = $data->fetch_row()) {
                $query_id = $row[0];
                $query = $row[1];
                $query_ans = $row[2];
                $title = $query;
                $content = $query_ans;
                $url = "./view.php?res=".$query_id."_".urlencode($title);

                $displayContent = getDisplayContent($content, $query); // filter content to get parts with our query
        ?>
            </b></b></b>
            <a class='result-link' href='<?php echo $url ?>'> <span style="font-size: 18px;"> <?php echo $title ?> </span> </a>
            <div>
              <span class='result-content' style="font-size: 13px;"> <?php echo substr($displayContent, 0, 250) ?> ...</span>
            </div>
            <br>
        <?php

            }

            // display pagination
            displayPaging($totalRows);
        }

       
        function noResult()
        {
            ?>

        <!-- no result -->
        <h3> Your search - <b> <?php echo htmlentities($GLOBALS['query']); ?> </b> - did not match any document </b> </h3>
        <br>
        <p> None of the indexed pages contains your search query. </p>
        <a href="./addresult.php?q=<?php echo ($GLOBALS['query']); ?>">
          <button type="button" class="btn btn-outline-success">+ Add query</button>
        </a>

        <?php

        }

        ?>

      <br>
    </div>
