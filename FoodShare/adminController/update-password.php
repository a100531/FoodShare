<?php
    // if the user is logged in send m to index
    // Check that the form was sent
        include("functions.php");
        $user = $_COOKIE;
        // 1. retrieve the form's information
        $email = $user['email'];
        $password  = $_POST['password'];

        update_password($email,$password);

        // 8. redirect the user to an index page
        header('Location:change-password.php');



?>
