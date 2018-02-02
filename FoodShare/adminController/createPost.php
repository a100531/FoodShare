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
      <div class="card-header">Create Post</div>
      <div class="card-body">
        <!-- after filling the form the information is sent to the createPost-process-->
        <form action="createPost-process.php" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Product</label>
            <input class="form-control" name="product" id="exampleInputEmail1" type="text" aria-describedby="productHelp" placeholder="Product Category">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Location</label>
            <input class="form-control" name="location" id="exampleInputEmail1" type="text" aria-describedby="locationHelp" placeholder="Product Location">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Phone Number</label>
                <input class="form-control" name="phone" id="exampleInputPassword1" type="text" placeholder="99999999">
              </div>
              <div class="col-md-6">
                <input type="radio" id="expiry12Hours"
                 name="expiry" value="12">
                <label for="expiry12Hours">12 Hours</label>

                <input type="radio" id="expiry72Hours"
                 name="expiry" value="72">
                <label for="expiry72Hours">3 Days</label>

                <input type="radio" id="expiry168Hours"
                 name="expiry" value="168">
                <label for="expiry168Hours">7 Days</label>
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Post Notes</label>
                <textarea class="form-control" id="notes" name="postNotes" placeholder="Please enter your message here..." rows="5"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <label for="exampleConfirmPassword">Add Image</label>
              <input class="form-control"  type="file" name="postImages" accept=".png, .gif, .jpg"/>
            </div>
          </div>
          </div>
          <!--onPageInit(createPost)
          $$('#create-user-id').val(userData['id']);-->
          <input type="hidden" name="user-id" value="" id="create-user-id">
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
