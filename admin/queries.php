<?php
require_once "inc/inc.php";
require_once "inc/partials/_header.php";

if(!isLoggedIn())
  redirect('./login.php', false);

$user = user($conn, $_SESSION["id"]);
$queries = queries($conn);

//var_dump($queries); exit;

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
              Queries
            </h3>
          </div>
          

          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-9 col-md-9">
                      <h4 class="card-title text-left mt-1">Queries</h4>
                    </div>
                    
                    <div class="col-sm-3 col-md-3 text-right">
                      <input type="search" name="admin_search" class="form-control" placeholder="Search">
                    </div>
                  </div>
                  
                  <!-- <div class="text-right">
                    xxx
                     <input type="search" name="admin_search" class="form-control" style="width: 150px;">
                  </div> -->
                 
                  <p class="card-description">
                  </p>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th colspan="2">Query and answer</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $cnt = 1;
                        while ($row = $queries['data']->fetch_row()):
                          
                      ?>
                        <tr>
                          <td><?= $cnt ?></td>
                          <td colspan="2">
                            <?= $row[1] ?>
                            <p><?= substr($row[2], 0, 50) ?>...</p>
                          </td>
                          <td style="width: 150px">
                            <a href="<?= BASE_URL.'/queries_view.php?id='.$row[0] ?>"><i class="mdi mdi-eye"></i> View</a>
                            <a href="<?= BASE_URL.'/queries_update.php?id='.$row[0] ?>"><i class="mdi mdi-pencil"></i> Update</a>
                          </td>
                        </tr>
                      <?php
                        $cnt++;
                        endwhile;
                      ?>
                    </tbody>
                  </table>
                  
                </div>
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Logged Queries</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <!-- <th>
                            Assignee
                          </th> -->
                          <th>
                            Query
                          </th>
                          <!-- <th>
                            Status
                          </th> -->
                          <th>
                            Time/Date
                          </th>
                          <!-- <th>
                            Tracking ID
                          </th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <!-- <td>
                            <img src="images/faces/face1.jpg" class="mr-2" alt="image">
                            David Grey
                          </td> -->
                          <td>
                            How much is food in cafe
                          </td>
                         <!--  <td>
                            <label class="badge badge-gradient-success">DONE</label>
                          </td> -->
                          <td>
                            March 18, 2019
                          </td>
                         <!--  <td>
                            WD-12345
                          </td> -->
                        </tr>
                        <tr>
                         <!--  <td>
                            <img src="images/faces/face2.jpg" class="mr-2" alt="image">
                            Stella Johnson
                          </td> -->
                          <td>
                            Who is the current vice chancellor
                          </td>
                          <!-- <td>
                            <label class="badge badge-gradient-warning">PROGRESS</label>
                          </td> -->
                          <td>
                            March 21, 2019
                          </td>
                          <!-- <td>
                            WD-12346
                          </td> -->
                        </tr>
                        <tr>
                          <!-- <td>
                            <img src="images/faces/face3.jpg" class="mr-2" alt="image">
                            Marina Michel
                          </td> -->
                          <td>
                            When is convocation
                          </td>
                          <!-- <td>
                            <label class="badge badge-gradient-info">ON HOLD</label>
                          </td> -->
                          <td>
                            March 25, 2019
                          </td>
                          <!-- <td>
                            WD-12347
                          </td> -->
                        </tr>
                        <tr>
                          <!-- <td>
                            <img src="images/faces/face4.jpg" class="mr-2" alt="image">
                            John Doe
                          </td> -->
                          <td>
                            Who is the dean of engineering
                          </td>
                          <!-- <td>
                            <label class="badge badge-gradient-danger">REJECTED</label>
                          </td> -->
                          <td>
                            March 28, 2019
                          </td>
                          <!-- <td>
                            WD-12348
                          </td> -->
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Requested Queries</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <!-- <th>
                            Assignee
                          </th> -->
                          <th>
                            Query
                          </th>
                          <!-- <th>
                            Status
                          </th> -->
                          <th>
                            Time/Date
                          </th>
                          <!-- <th>
                            Tracking ID
                          </th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <!-- <td>
                            <img src="images/faces/face1.jpg" class="mr-2" alt="image">
                            David Grey
                          </td> -->
                          <td>
                            How much is food in cafe
                          </td>
                         <!--  <td>
                            <label class="badge badge-gradient-success">DONE</label>
                          </td> -->
                          <td>
                            March 18, 2019
                          </td>
                         <!--  <td>
                            WD-12345
                          </td> -->
                        </tr>
                        <tr>
                         <!--  <td>
                            <img src="images/faces/face2.jpg" class="mr-2" alt="image">
                            Stella Johnson
                          </td> -->
                          <td>
                            Who is the current vice chancellor
                          </td>
                          <!-- <td>
                            <label class="badge badge-gradient-warning">PROGRESS</label>
                          </td> -->
                          <td>
                            March 21, 2019
                          </td>
                          <!-- <td>
                            WD-12346
                          </td> -->
                        </tr>
                        <tr>
                          <!-- <td>
                            <img src="images/faces/face3.jpg" class="mr-2" alt="image">
                            Marina Michel
                          </td> -->
                          <td>
                            When is convocation
                          </td>
                          <!-- <td>
                            <label class="badge badge-gradient-info">ON HOLD</label>
                          </td> -->
                          <td>
                            March 25, 2019
                          </td>
                          <!-- <td>
                            WD-12347
                          </td> -->
                        </tr>
                        <tr>
                          <!-- <td>
                            <img src="images/faces/face4.jpg" class="mr-2" alt="image">
                            John Doe
                          </td> -->
                          <td>
                            Who is the dean of engineering
                          </td>
                          <!-- <td>
                            <label class="badge badge-gradient-danger">REJECTED</label>
                          </td> -->
                          <td>
                            March 28, 2019
                          </td>
                          <!-- <td>
                            WD-12348
                          </td> -->
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

 
  <?php require_once "inc/partials/_footer.php"; ?>
</body>

</html>
