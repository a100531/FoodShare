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
        <h4>Reset Password?</h4>
      </div>
      <form action="update-password.php" method="post">
        <div class="form-group">
          <input class="form-control" id="exampleInputEmail1" type="password" name="password" aria-describedby="emailHelp" placeholder="Enter your password">
        </div>
        <button class="btn btn-primary" type="submit" name="button">Reset Password</button>
      </form>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<?php
  include("footer.php");
 ?>
