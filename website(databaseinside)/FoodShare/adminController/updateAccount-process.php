<?php
      // after sanitizing the inputs from the form it sends the information and updates the account information
      $_ERRORS = array();

      $_FORM = array();

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        foreach ($_POST as $key => $value) {
          $_FORM[$key] = htmlspecialchars($value);
        }
        $id = $_GET['id'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $location = $_POST['location'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        //$description = $_POST['message'];



        if(empty($_ERRORS)){
          $id = edit_account($id,$email,$username,$phone,$location,$name,$surname);

          if($id !== TRUE){
            echo $id;
            die;
          }

          //if (isset($_FILES['file'])) {

          //    $file = "uploaded_imgs/{$fishid}.*";
          //    array_map("unlink", glob($file));

          //    # fix the folder's permissions to allow upload
          //    chmod('uploaded_imgs', 0777);
          //    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
          //    $filename = "uploaded_imgs/{$id}.{$ext}";

          //    if (!move_uploaded_file($_FILES['file']['tmp_name'], $filename)) {
                 header('Location:accounts.php');
          //    }
      //  }
      }
      //$myfile = fopen("fish_descriptions/$id.txt", "w") or die("Unable to create desciption");
      //$txt = $description;
      //fwrite($myfile,$txt);
      //fclose($myfile);
      //header('Location:fish.php');

  }

 ?>
