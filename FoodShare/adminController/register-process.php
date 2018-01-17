<?php
      include("functions.php");
      // NOTE: First, we check that the inputs are valid
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $phone = $_POST['phone'];
      $location = $_POST['location'];
      $name = $_POST['name'];
      $surname = $_POST['surname'];

      insert_user($email, $password,$username,$phone,$location,$name,$surname);


      header('Location:login.php');

 ?>
