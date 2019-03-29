<?php

require_once "partials/_header.php";

if(isLoggedIn())
  redirect('./index.php', false);

$error = '';



if(isset($_POST['submit']) && $_POST['submit'] == 1){
  $email = $_POST['email'];
  $password = $_POST['password'];

  if(empty($email) || empty($password))
    $error = "all fields are required";
  else{
    $user = doLogin($conn, $email, $password);

    if(!empty($user)){
      $_SESSION["id"] = $user['id'];
      redirect('./index.php', false);

    }

    $error = "incorrect user name or password";
  }
}

?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <!-- <img src="./images/logo.svg"> -->
              </div>
              <h4>Admin Login</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" class="pt-3">
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
                </div>

              <?php if(!empty($error)): ?>
                <h6 class="font-weight-light text-danger"><?= $error ?></h6>
              <?php endif; ?>

                <div class="mt-3">
                  <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" name="submit" value="1" type="submit">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                 <!--  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div> -->
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <?php require_once "partials/_footer.php"; ?>
</body>

</html>
