<?php
  session_start();

  function connect_to_db() {

      // $conn only exists within this function
      $conn = mysqli_connect("localhost", "root", "", "foodshare")
          or die("Unable to connect.");

      // this will allow us to set a variable using this function
      return $conn;

  }
  function disconnect_from_db(&$conn) {

      // closes a connection
      mysqli_close($conn);

  }
  function check_login() {

      // 1. if the session contains no data
      // there's nothing else to do
      if (!array_key_exists('id', $_COOKIE)) {
          return FALSE;
      }

      // 2. put the user information in a variable
      $user = $_COOKIE;

      // 3. connect to the database
      $conn = connect_to_db();

      // 4. protect the variables
      $id = mysqli_escape_string($conn, $user['id']);
      $email = mysqli_escape_string($conn, $user['email']);

      // 5. define the query
      $query = "
          SELECT
              id
          FROM
              tbl_accounts
          WHERE
              id = '{$id}'
          AND
              email = '{$email}'
      ";

      // 6. ask SQL to try the query
      $result = mysqli_query($conn, $query);

      // 7. disconnect from the database
      disconnect_from_db($conn);

      // 8. return TRUE if we have one row
      // FALSE if the details didn't match (0 rows)
      return mysqli_num_rows($result) == 1;

  }
  function get_password($email) {

        // 1. connect to the database
        $conn = connect_to_db();

        // 2. protect the variables for the query
        $email = mysqli_escape_string($conn, $email);

        // 3. define the query
        $query = "
            SELECT password
            FROM tbl_accounts
            WHERE email='{$email}'
        ";

        // 4. ask SQL to try the query
        $result = mysqli_query($conn, $query);

        // 5. disconnect from the database
        disconnect_from_db($conn);

        // 6. tell PHP what happened
        if (mysqli_num_rows($result) != 1) {
            // if there is not one result, the email does not exist
            return FALSE;
        } else {
            // retrieve the first result as an array
            $result = mysqli_fetch_assoc($result);

            // return just the password
            return $result['password'];
        }

    }
  function get_user_from_email($email) {

        // 1. connect to the database
        $conn = connect_to_db();

        // 2. protect the variables
        $email = mysqli_escape_string($conn, $email);

        // 3. define the query
        $query = "
          SELECT
            *
          FROM
            tbl_accounts
          WHERE
            email = '{$email}'
        ";

        // 4. ask SQL to try the query
        $result = mysqli_query($conn, $query);

        // 5. disconnect from the database
        disconnect_from_db($conn);

        // 6. send back the data if there's any
        if (mysqli_num_rows($result) != 1) {
            // something went wrong, just send a false
            return FALSE;
        } else {
            // return the first result, it's the only one
            return mysqli_fetch_assoc($result);
        }

    }
 ?>
