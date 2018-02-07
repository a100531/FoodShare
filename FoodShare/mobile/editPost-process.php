<?php
      // this is the process to edit the information of an already create post
      //$_ERRORS = array();

      //$_FORM = array();
      // sanitizes the information from the form
      //if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      //  foreach ($_POST as $key => $value) {
      //    $_FORM[$key] = htmlspecialchars($value);
      //  }
        $postid = $_POST['postid'];
        $product = $_POST['product'];
        //$location = $_POST['location'];
        //$phone = $_POST['phone'];
        $notes = $_POST['postNotes'];
        //$expiry = $_POST['expiry'];



        // if there are no errors send the information through the edit_post function
        //if(empty($_ERRORS)){
          $id = edit_post($postid,$product);

          //if($id !== TRUE){
          //  echo $id;
          //  die;
          //}
          // the if statement check if the file is set
          //if (isset($_FILES['postImages'])) {
          //    // unlinks the old file
          //    $file = "productImages/{$postid}.*";
          //    array_map("unlink", glob($file));

          //    # fix the folder's permissions to allow upload
          //    // uploads the new file
          //    chmod('productImages', 0777);
          //    $ext = pathinfo($_FILES['postImages']['name'], PATHINFO_EXTENSION);
          //    $filename = "productImages/{$postid}.{$ext}";

          //    if (!move_uploaded_file($_FILES['postImages']['tmp_name'], $filename)) {
          //        header('Location:posts.php');
          //    }
      //  }
      //}
      // the text file is overwritten on the previously existing one
      if (isset($notes)) {
        $myfile = fopen("postNotes/$postid.txt", "w") or die("Unable to create desciption");
        $txt = $notes;
        fwrite($myfile,$txt);
        fclose($myfile);
      }
      //header('Location:posts.php');



 ?>
