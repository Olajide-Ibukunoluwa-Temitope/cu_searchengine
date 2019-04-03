<?php
require_once "inc/inc.php";
require_once "inc/partials/_header.php";

if(!isLoggedIn())
  redirect('./login.php', false);

$user = user($conn, $_SESSION["id"]);
$queries = queries($conn, 5);
$requests = requests($conn, 5);
$answered_count = getAnsweredQuestionCount($conn);

?>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php require_once "inc/partials/_navbar.php"; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php require_once "inc/partials/_sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>                 
              </span>
              Dashboard
            </h3>
          </div>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3">Answered Searches
                    <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?= $answered_count ?></h2>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
                  <h4 class="font-weight-normal mb-3">Logged Searches
                    <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?= empty($queries)? 0 : $queries['total_count'] ?></h2>
                  <!-- <h6 class="card-text">Decreased by 10%</h6> -->
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">Requested Queries
                    <i class="mdi mdi-diamond mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?= empty($requests)? 0 : $requests['total_count'] ?></h2>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Recent Searches</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            Query
                          </th>
                          <th>
                            Time/Date
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($queries)):
                        while ($row = $queries['data']->fetch_row()):
                          
                      ?>
                        <tr>
                          <td> <a href="<?= BASE_URL.'/queries_view.php?id='.$row[0] ?>"><?= $row[1] ?></a></td>
                          <td><?= date('M d, Y', strtotime($row[3])) ?></td>
                        </tr>
                      <?php
                        endwhile;
                      else:
                      ?>

                       <tr>
                          <td>
                            Nothing here
                          </td>
                        </tr>

                      <?php
                        endif;
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Logged Queries</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Query
                          </th>
                          <th>
                            Date
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($requests)):
                          $cnt = 1;
                          while ($row = $requests['data']->fetch_row()):
                          
                      ?>
                        <tr>
                          <td><?= $cnt ?></td>
                          <td> <a href="<?= BASE_URL.'/requests_view.php?id='.$row[0] ?>"><?= $row[1] ?></a> </td>
                          <td><?= date('M d, Y', strtotime($row[2])) ?></td>
                        </tr>
                      <?php
                        $cnt++;
                        endwhile;
                      else:
                      ?>

                       <tr>
                          <td>
                            Nothing here
                          </td>
                        </tr>

                      <?php
                        endif;
                      ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       <!--  <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2017 <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap Dash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer> -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

 
  <?php require_once "inc/partials/_footer.php"; ?>
</body>

</html>