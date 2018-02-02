<?php
      // gives the application full permission to access this file
      header('Access-Control-Allow-Origin: *');
      include 'functions.php';
      // First, we check that the inputs are valid

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($_POST as $key => $value) {
          $_FORM[$key] = htmlspecialchars($value);
        }
      }

      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $phone = $_POST['phone'];
      $location = $_POST['location'];
      $name = $_POST['name'];
      $surname = $_POST['surname'];

      $id = insert_user($email, $password,$username,$phone,$location,$name,$surname);
      $user = get_user_from_email($email);

      echo json_encode($user);
      //header('Location:login.php');

 ?>
