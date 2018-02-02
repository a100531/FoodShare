<?php
      header('Access-Control-Allow-Origin: *');
      include("functions.php");
      //the if statement sanitizes all the inputs from the form to make sure it doesn't have any unwanted commands in it
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($_POST as $key => $value) {
          $_FORM[$key] = htmlspecialchars($value);

      }
      // NOTE: First, we check that the inputs are valid
      $product = $_POST['product'];
      $location = $_POST['location'];
      $phone = $_POST['phone'];
      $userId = $_POST['user-id'];
      //to create an expiry date the expiry in hours is added to the current time
      $expiry = time() + $_POST['expiry'];
      $notes = $_POST['postNotes'];
      // the function insert post is called and the id is stored to be used to create the image and text file names
      $id = insert_post($product,$location,$phone,$expiry,$userId);
      // if the file is posted from the form
      // first the file permissions are set
      // then the file path is set
      // and finally the file is saved in the appropriate folder
      if (isset($_FILES['postImages'])) {
        chmod('productImages', 0777);
        $ext = pathinfo($_FILES['postImages']['name'], PATHINFO_EXTENSION);
        $filename = "productImages/{$id}.{$ext}";
      // if the file isn't uploaded successfully show error and stop the function
        if(!move_uploaded_file($_FILES['postImages']['tmp_name'], $filename)){
          die("Could not upload file");
        }
      }
      // creates a file with write priviliges
      $myfile = fopen("postNotes/$id.txt", "w") or die("Unable to create post notes");
      // takes the text from the textarea in the form
      $txt = $notes;
      // write the text in the file
      fwrite($myfile,$txt);
      // close the file and saves
      fclose($myfile);
      // redirects the userto the posts page
      //header('Location:posts.php');
      echo json_encode($id);
    }

 ?>
