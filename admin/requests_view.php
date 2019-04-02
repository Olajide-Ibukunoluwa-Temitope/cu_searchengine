<?php
require_once "inc/inc.php";
require_once "inc/partials/_header.php";

if(!isLoggedIn())
  redirect('./login.php', false);

$user = user($conn, $_SESSION["id"]);
$error = '';

if(isset($_POST['submit']) && $_POST['submit'] == 1){
  $query_id = $_POST['id'];
  $query_q = $_POST['query'];
  $query_ans = $_POST['query_ans'];


  if(empty($query_q) || empty($query_ans))
    $error = "all fields are required";
  else{
    $result = answerRequest($conn, $query_id, $query_q, $query_ans);

    if($result){
      redirect(BASE_URL.'/queries_view.php?id='.$result, false);
    }

    $error = "some thing went wrong";
  }

  $query = viewRequest($conn, $query_id);

}else{
  $query = viewRequest($conn, $_GET['id']);
}

if(empty($query))
  redirect(BASE_URL.'/requests.php', false);

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
                    <form method="post" action="<?= BASE_URL.'/requests_view.php?id='.$query['id'] ?>" class="pt-3">
                      <input type="hidden" name="id" value="<?= $query['id'] ?>">
                      <div class="form-group">
                        <label >Query</label>
                        <input type="text" class="form-control" name="query" placeholder="Enter Query" value="<?= $query['query'] ?>">
                      </div>
                      <?php if($query['is_answered'] == 0): ?>
                      <div class="form-group">
                        <label>Answer</label>
                        <textarea class="form-control" name="query_ans" placeholder="Enter Query Answer" rows="8"></textarea>
                      </div>
                       <?php endif; ?>
                      
                      
                      <?php if($query['is_answered'] == 0): ?>
                        <button type="submit" class="btn btn-gradient-primary mr-2 float-right" name="submit" value="1">Submit</button>
                      <?php endif; ?>
                      <a href="<?= BASE_URL.'/requests_delete.php?id='.$query['id'] ?>" class="btn btn-gradient-danger mr-2 float-right" name="submit" value="1">Delete</a>
                    </form>

                    <p class="mt-3">
                      <span>Created At: <span class="text-muted"><?= $query['created_at'] ?></span></span>
                      <br />
                      <span>Updated At: <span class="text-muted"><?= $query['updated_at'] ?></span></span>
                    </p>
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
