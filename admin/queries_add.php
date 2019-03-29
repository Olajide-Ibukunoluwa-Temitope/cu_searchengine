<?php
require_once "inc/inc.php";
require_once "inc/partials/_header.php";

if(!isLoggedIn())
  redirect('./login.php', false);

$user = user($conn, $_SESSION["id"]);

$error = '';



if(isset($_POST['submit']) && $_POST['submit'] == 1){
  $query = $_POST['query'];
  $query_ans = $_POST['query_ans'];

  if(empty($query) || empty($query_ans))
    $error = "all fields are required";
  else{
    $result = addQuery($conn, $query, $query_ans);

    if(!empty($result)){
      redirect(BASE_URL.'/queries_view.php?id='.$result, false);

    }

    $error = "some thing went wrong";
  }
}

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
              Queries Add
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

                    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" class="pt-3">
                      <div class="form-group">
                        <label >Query</label>
                        <input type="text" class="form-control" name="query" placeholder="Enter Query">
                      </div>
                      <div class="form-group">
                        <label>Answer</label>
                        <textarea class="form-control" name="query_ans" placeholder="Enter Query Answer" rows="8"></textarea>
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
