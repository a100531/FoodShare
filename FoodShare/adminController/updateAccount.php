<?php
  include("functions.php");
  include("updateAccount-process.php");


      if (!isset ($_GET["id"])){
          header("Location:accounts.php");
      }

      $accounts = get_accounts($_GET['id']);
      $assoc = mysqli_fetch_assoc($accounts);
      //$description = file_get_contents("fish_descriptions/{$_GET['id']}.txt");

      if ($assoc == NULL) {
          die('This  does not exist!');
      }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form action="updateAccount.php?id=<?=$_GET['id']?>" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" name="username" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" value="<?=$assoc["username"]?>">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" name="email" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" value="<?=$assoc["email"]?>">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group">
                <label for="exampleInputEmail1">Phone</label>
                <input class="form-control" name="phone" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" value="<?=$assoc["phone"]?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Location</label>
                <input class="form-control" name="location" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" value="<?=$assoc["location"]?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input class="form-control" name="name" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" value="<?=$assoc["name"]?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Surname</label>
                <input class="form-control" name="surname" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" value="<?=$assoc["surname"]?>">
              </div>
            </div>
          </div>
          <button class="btn btn-primary" type="submit" name="button">Register</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
