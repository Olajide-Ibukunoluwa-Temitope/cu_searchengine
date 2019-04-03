<?php
require_once "inc/inc.php";
require_once "inc/partials/_header.php";

if(!isLoggedIn())
  redirect('./login.php', false);

$user = user($conn, $_SESSION["id"]);
$queries = requests($conn);

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
              Requested Queries
            </h3>
          </div>
          

          
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Requested Queries</h4>
                  <div class="table-responsive">
                    <table class="table datatable">
                      <thead>
                        <tr>
                          <th>#</th>
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
                        $cnt = 1;
                        while ($row = $queries['data']->fetch_row()):
                            
                        ?>
                          <tr>
                            <td><?= $cnt ?></td>
                            <td>
                              <?= substr($row[1], 0, 50) ?>
                            </td>
                            <td style="width: 150px">
                              <a href="<?= BASE_URL.'/requests_view.php?id='.$row[0] ?>"><i class="mdi mdi-eye"></i> View</a>
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
