<?php
  include("header.php");
  include("navbar.php");

  if (!check_login()) {
       header('Location:../index.php');
    }
    $user = $_COOKIE;

?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Change-Password</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="text-center mt-4 mb-5">
        <h4>Forgot your password?</h4>
        <p>Enter your email address and we will send you instructions on how to reset your password.</p>
      </div>
      <form>
        <div class="form-group">
          <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email address">
        </div>
        <a class="btn btn-primary btn-block" href="login.php">Reset Password</a>
      </form>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<?php
  include("footer.php");
 ?>
