<?php
    // if the user is logged in send m to index
    if (check_login()) {
      header('Location:posts.php');
    }
    // Check that the form was sent
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // 1. retrieve the form's information
        $email      = "admin";
        $password   = $_POST['password'];

        // 2. check if the user exists
        // if so, retrieve the database password
        $check = get_password($email);

        // 3. if the user doesn't exist, present an error
        // == checks if the variable is the same
        // === checks that a variable is IDENTICAL
        if ($check === FALSE) {
            echo "This user doesn't exist.";
            die;
        }

        // 4. check that the password matches
        if ($password != $check ){
            header('Location:../index.php');
            die;
        }

        // 5. the user has managed to log in
        // retrieve their data
        $details = get_user_from_email($email);

        // 6. stop the code if the data doesn't exist
        if ($details === FALSE) {
            echo "Something went wrong.";
            die;
        }
        /* your cookies will enable the use of a $_COOKIE
        three paramaters are needed as a minimum
        the first is the name of the cookies
        second one is the value and third is the expiry
        the expiry is set by multiplying second * minutes * hours * days * months * years
        */
        // 7. write the user data to a session
        foreach ($details as $key => $value) {
          setcookie($key, $value, time()+60*60*24*30*3);
        }

        // 8. redirect the user to an index page
        header('Location:posts.php');

    }

?>
