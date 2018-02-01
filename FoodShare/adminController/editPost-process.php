<?php
      $_ERRORS = array();

      $_FORM = array();

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        foreach ($_POST as $key => $value) {
          $_FORM[$key] = htmlspecialchars($value);
        }
        $postid = $_POST['postid'];
        $product = $_POST['product'];
        $location = $_POST['location'];
        $phone = $_POST['phone'];
        $notes = $_POST['postNotes'];
        $expiry = $_POST['expiry'];




        if(empty($_ERRORS)){
          $id = edit_post($postid,$product,$location,$phone,$expiry);

          if($id !== TRUE){
            echo $id;
            die;
          }

          if (isset($_FILES['postImages'])) {

              $file = "productImages/{$postid}.*";
              array_map("unlink", glob($file));

              # fix the folder's permissions to allow upload
              chmod('productImages', 0777);
              $ext = pathinfo($_FILES['postImages']['name'], PATHINFO_EXTENSION);
              $filename = "productImages/{$postid}.{$ext}";

              if (!move_uploaded_file($_FILES['postImages']['tmp_name'], $filename)) {
                  header('Location:posts.php');
              }
        }
      }
      $myfile = fopen("postNotes/$postid.txt", "w") or die("Unable to create desciption");
      $txt = $notes;
      fwrite($myfile,$txt);
      fclose($myfile);
      header('Location:posts.php');

  }

 ?>
