<?php
require_once "inc/inc.php";
require_once "inc/partials/_header.php";

if(!isLoggedIn())
  redirect('./login.php', false);

$user = user($conn, $_SESSION["id"]);


$error = '';

if(isset($_POST['submit']) && $_POST['submit'] == 1){
  $query_id = $_POST['query_id'];
  $query_q = $_POST['query'];
  $query_ans = $_POST['query_ans'];


  if(empty($query_q) || empty($query_ans))
    $error = "all fields are required";
  else{
    $result = updateQuery($conn, $query_id, $query_q, $query_ans);

    if($result){
      redirect(BASE_URL.'/queries_view.php?id='.$result, false);
    }

    $error = "some thing went wrong";
  }

  $query = viewQuery($conn, $query_id);

}else{
  $query = viewQuery($conn, $_GET['id']);
}

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
              Queries Update
            </h3>
          </div>
          

          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add query</h4>
                    <?php if(!empty($error)): ?>
                      <h6 class="card-description font-weight-light text-danger"><?= $error ?></h6>
                    <?php endif; ?>

                    <form method="post" action="<?= BASE_URL.'/queries_update.php?id='.$query['query_id'] ?>" class="pt-3">
                      <input type="hidden" name="query_id" value="<?= $query['query_id'] ?>">
                      <div class="form-group">
                        <label >Query</label>
                        <input type="text" class="form-control" name="query" placeholder="Enter Query" value="<?= $query['query'] ?>">
                      </div>
                      <div class="form-group">
                        <label>Answer</label>
                        <textarea class="form-control" name="query_ans" placeholder="Enter Query Answer" rows="8"><?= $query['query_ans'] ?></textarea>
                      </div>

                    

                      <button type="submit" class="btn btn-gradient-primary mr-2" name="submit" value="1">Submit</button>
                    </form>
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
