<?php
      include("functions.php");
      // NOTE: First, we check that the inputs are valid

      $email = $_POST['email'];

      $password = $_POST['password'];

      insert_user($email, $password);


      header('Location:login.php');

 ?>
