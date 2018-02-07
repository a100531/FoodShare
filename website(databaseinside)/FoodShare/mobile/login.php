<?php
  header('Access-Control-Allow-Origin: *');

  include '../adminController/functions.php';

  // this file handles the login for the mobile application
  // which finally encodes the information to be use with json
  $email      = $_POST['email'];
  $password   = $_POST['password'];

  // 2. check if the user exists
  // if so, retrieve the database password
  $check = get_password($email);

  // 3. if the user doesn't exist, present an error
  // == checks if the variable is the same
  // === checks that a variable is IDENTICAL
  if ($check === FALSE) {
      echo "This user doesn't exist.";
      //header('Location:../index.php');
      //die;
  }

  // 4. check that the password matches
  if (!password_verify($password, $check)){
      echo "wrong password";
      //header('Location:../index.php');
      //die;
  }


  // 5. the user has managed to log in
  // retrieve their data
  $details = get_user_from_email($email);

  // 6. stop the code if the data doesn't exist
  if ($details === FALSE) {
     echo "Something went wrong.";
      //die;
  }

  // the information is encoded for json
  echo json_encode($details);

?>
