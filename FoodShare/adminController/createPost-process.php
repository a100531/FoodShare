<?php
      include("functions.php");

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($_POST as $key => $value) {
          $_FORM[$key] = htmlspecialchars($value);

      }
      // NOTE: First, we check that the inputs are valid
      $product = $_POST['product'];
      $location = $_POST['location'];
      $phone = $_POST['phone'];
      $expiry = $_POST['expiry'];
      $notes = $_POST['postNotes'];

      $id = insert_post($product,$location,$phone,$expiry);

      if (isset($_FILES['postImages'])) {
        chmod('productImages', 0777);
        $ext = pathinfo($_FILES['postImages']['name'], PATHINFO_EXTENSION);
        $filename = "productImages/{$id}.{$ext}";

        if(!move_uploaded_file($_FILES['postImages']['tmp_name'], $filename)){
          die("Could not upload file");
        }
      }

      $myfile = fopen("postNotes/$id.txt", "w") or die("Unable to create post notes");
      $txt = $notes;
      fwrite($myfile,$txt);
      fclose($myfile);

      header('Location:posts.php');
    }

 ?>
