<?php
  include("header.php");
  include("functions.php");
  if (!check_login()) {
      header('Location:login.php');
  }
  include("editPost-process.php");


      if (!isset ($_GET["id"])){
          header("Location:posts.php");
      }

      $posts = show_posts($_GET['id']);
      $assoc = mysqli_fetch_assoc($posts);
      $notes = file_get_contents("postNotes/{$_GET['id']}.txt");
      //continue here
      if ($assoc == NULL) {
          die('This post does not exist!');
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
      <div class="card-header">Edit Post</div>
      <div class="card-body">
        <form action="editPost.php?id=<?=$_GET['id']?>" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Product</label>
            <input class="form-control" name="product" id="exampleInputEmail1" value="<?=$assoc["posts_product"]?>" type="text" aria-describedby="productHelp" placeholder="Product Category">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Location</label>
            <input class="form-control" name="location" id="exampleInputEmail1" value="<?=$assoc["posts_location"]?>" type="text" aria-describedby="locationHelp" placeholder="Product Location">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Phone Number</label>
                <input class="form-control" name="phone" id="exampleInputPassword1" value="<?=$assoc["posts_phone"]?>" type="text" placeholder="99999999">
              </div>
              <div class="col-md-6">
                <input type="radio" id="expiry12Hours" name="expiry" value="12"<?php if ($assoc['posts_expiry'] == 12) echo " checked"; ?>>
                <label for="expiry12Hours">12 Hours</label>
                <br>
                <input type="radio" id="expiry72Hours" name="expiry" value="72"<?php if ($assoc['posts_expiry'] == 72) echo " checked"; ?>>
                <label for="expiry72Hours">72 hours (3 Days)</label>
                <br>
                <input type="radio" id="expiry168Hours" name="expiry" value="168"<?php if ($assoc['posts_expiry'] == 168) echo " checked"; ?>>
                <label for="expiry168Hours">168 hours (7 Days)</label>
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Post Notes</label>
                <textarea class="form-control" id="notes" name="postNotes" placeholder="Please enter your message here..." rows="5"><?php echo $notes ?></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <label for="exampleConfirmPassword">Add Image</label>
              <input class="form-control" required  type="file" name="postImages" accept=".png, .gif, .jpg"/>
            </div>
          </div>
          </div>
          <input type="hidden" name="postid" value="<?=$assoc['posts_id']?>">
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
