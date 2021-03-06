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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

  <nav style="position: relative; margin-bottom: 10px;" class="navbar navbar-default navbar-fixed-top">
    <div style="padding-left: 0;" class="container">

      <div class="row">
        <div class="col-md-10">
          <div class="navbar-header">
            <a class="navbar-brand" href="./../index.php">
              <img width="110" height="27" src='../assets/images/cu_searchengine.png'/>
            </a>
          </div>

          <div id="navbar" class="collapse navbar-collapse">
            <form action="" class="form-inline">
              <div class="form-group">
                <input value="<?php echo $query; ?>" name="q" type="search" style="width: 400px;" class="form-control box input-lg" id="search_box">
              </div>
            </form>
          </div><!--/.nav-collapse -->
        </div>

        <!-- <div class="col-md-2">
          <a class="btn btn-default index-site-button" href="sites.php" role="button">
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
          Add Websites
          </a>
        </div> -->
      </div>

    </div>
  </nav>


    <div class="container" style="width: 621px; margin-left: 12.3%;">
      
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
                echo "<small class='results-count'> $totalRows Result(s)  (".round($queryTime, 2)." seconds) </small> <br><br>";
            } else {
                echo "<small class='results-count'> Page ".(($startAt/10) + 1)." of $totalRows Result(s)  (".round($queryTime, 2)." seconds) </small> <br><br>";
            }

            while ($row = $data->fetch_row()) {
                $url = $row[0];
                $title = !empty($row[1]) ? $row[1] : "$url";
                $content = $row[2];

                $displayContent = getDisplayContent($content, $query); // filter content to get parts with our query
        ?>
            </b></b></b>
            <a class='result-link' href='<?php echo $url ?>'> <span style="font-size: 18px;"> <?php echo $title ?> </span> </a>
            <small class='result-url'><?php echo $url ?></small>
            <span class='result-content'> <?php echo substr($displayContent, 0, 200) ?> ...</span>
            <br><br>
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

        <?php

        }

        ?>

      <br>
    </div>
