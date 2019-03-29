<?php
require_once "inc/inc.php";
require_once "inc/partials/_header.php";

if(!isLoggedIn())
  redirect('./login.php', false);

$user = user($conn, $_SESSION["id"]);
$query = viewQuery($conn, $_GET['id']);

if(empty($query))
  redirect(BASE_URL.'/queries.php', false);

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
              Queries View
            </h3>
          </div>
          

          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><?= $query['query'] ?></h4>

                    <hr />

                    <p class="card-content"><?= $query['query_ans'] ?></p>

                    <p class="mt-3">
                      <span>Created At: <span class="text-muted"><?= $query['created_at'] ?></span></span>
                      <br />
                      <span>Updated At: <span class="text-muted"><?= $query['updated_at'] ?></span></span>
                    </p>

                    <div class="clearfix">
                      <div class="float-right">
                        <a href="<?= BASE_URL.'/queries_update.php?id='.$query['query_id'] ?>"><i class="mdi mdi-pencil"></i> Update</a> &nbsp;
                        <a href="<?= BASE_URL.'/queries_delete.php?id='.$query['query_id'] ?>"><i class="mdi mdi-delete"></i> Delete</a>
                      </div>
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
