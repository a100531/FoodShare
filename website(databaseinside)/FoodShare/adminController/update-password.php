<?php

        // updates the password for the user
        include("functions.php");
        $user = $_COOKIE;
        // 1. retrieve the form's information
        $email = $user['email'];
        $password  = $_POST['password'];

        update_password($email,$password);

        // 8. redirect the user to an index page
        header('Location:change-password.php');



?>
