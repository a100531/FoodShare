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
  function insert_user($email, $password,$username,$phone,$location,$name,$surname) {

      // 1. connect to the database
      $conn = connect_to_db();

      // 2. protect the variables from SQL injection
      $email = mysqli_escape_string($conn, $email);

      // BLOWFISH encryption
      // http://www.splashdata.com/splashid/blowfish.htm
      $password = password_hash($password, CRYPT_BLOWFISH);
      $password = mysqli_escape_string($conn, $password);

      // 3. define a query
      $query = "
          INSERT INTO tbl_accounts
              (email, password, username ,phone, location, name, surname)
          VALUES
              ('{$email}', '{$password}', '{$username}', '{$phone}', '{$location}', '{$name}', '{$surname}')
      ";

      // 4. ask SQL to perform the query
      $result = mysqli_query($conn, $query);

      // 5. check that we've inserted one row
      if (mysqli_affected_rows($conn) != 1) {

          // unsuccessful: replace the result variable with an error
          $result = "The query was not successful: ";
          // .= concatenates a string with the current value
          $result .= mysqli_error($conn);

      } else {

          // if successful, we need the primary key ID
          $result = mysqli_insert_id($conn);
      }

      // 6. disconnect from the database
      disconnect_from_db($conn);

      // 7. give back whatever we've ended up with
      return $result;

  }
  function update_password($email, $password) {

      // 1. connect to the database
      $conn = connect_to_db();

      // 2. protect the variables from SQL injection

      // BLOWFISH encryption
      // http://www.splashdata.com/splashid/blowfish.htm
      $password = password_hash($password, CRYPT_BLOWFISH);
      $password = mysqli_escape_string($conn, $password);


      // 3. define a query
      $query ="
      UPDATE tbl_accounts
         SET
            password = '{$password}'
         ";

      // 4. ask SQL to perform the query
      $result = mysqli_query($conn, $query);


      // 5. check that we've inserted one row
      if (mysqli_affected_rows($conn) != 1) {

          // unsuccessful: replace the result variable with an error
          $result = "The query was not successful: ";
          // .= concatenates a string with the current value
          $result .= mysqli_error($conn);

      } else {

          // if successful, we need the primary key ID
          $result = mysqli_insert_id($conn);
      }

      // 6. disconnect from the database
      disconnect_from_db($conn);

      // 7. give back whatever we've ended up with
      return $result;

  }
  function show_accounts($id = NULL){
      // connect to the database;
      $conn = connect_to_db();

      // defining a query

      $query = "
        SELECT * FROM `tbl_accounts`
      ";

      if ($id != NULL) {
        $id = mysqli_escape_string($conn, $id);
        $query .= "AND ID = {$id}";
      }

      // asking SQL to perform the query
      $result = mysqli_query($conn,$query);

      //disconnect from the database
      disconnect_from_db($conn);

      // give back the end result
      return $result;
  }
  function delete_account($id){

        $conn = connect_to_db();

        //protect our variables
        $id = mysqli_escape_string($conn, $id);

        $query ="
            DELETE FROM tbl_accounts

            WHERE
                id = '{$id}'
            ";
        $result = mysqli_query($conn, $query);

        //check that the query worked
        if (mysqli_affected_rows($conn) !=1){
            //.combines ywo strings
            echo "the query is not successful:";
            echo mysqli_error($conn);
        }else{
            //this will change $result to TRUE
            $result = TRUE;

        }


        disconnect_from_db($conn);

        return $result;
    }
  function get_accounts($id = NULL){
    // connect to the database;
    $conn = connect_to_db();

    // defining a query

    $query = "
      SELECT * FROM `tbl_accounts`
      ";

    if ($id != NULL) {
        $id = mysqli_escape_string($conn, $id);
        $query .= "WHERE id={$id}";
    }

    // asking SQL to perform the query
    $result = mysqli_query($conn,$query);

    //disconnect from the database
    disconnect_from_db($conn);

    // give back the end result
    return $result;

  }
  function check_account($id,$email,$username,$phone,$location,$name,$surname){

    // connection to the database
    $conn = connect_to_db();

    $id = mysqli_escape_string($conn,$id);
    $username = mysqli_escape_string($conn,$username);
    $email = mysqli_escape_string($conn,$email);
    $phone = mysqli_escape_string($conn,$phone);
    $location = mysqli_escape_string($conn,$location);
    $name = mysqli_escape_string($conn,$name);
    $surname = mysqli_escape_string($conn,$surname);

    $query ="
        SELECT *
        FROM tbl_accounts
          WHERE
              email = '{$email}' AND
              username = '{$username}' AND
              phone = '{$phone}' AND
              location = '{$location}' AND
              name = '{$name}' AND
              surname = '{$surname}' AND
              id = '{$id}'
          ";

    // get the results to check that the query matches
      $result  = mysqli_query($conn,$query);

      // disconnect because the query is done
      disconnect_from_db($conn);

      // check the number of rows, and return TRUE or FALSE if the result is one.
      return mysqli_num_rows($result) == 1;
    }
  function edit_account($id,$email,$username,$phone,$location,$name,$surname){

   if (check_account($id,$email,$username,$phone,$location,$name,$surname)) {
       return TRUE;
   }

  // connection to the database
  $conn = connect_to_db();

  $id = mysqli_escape_string($conn,$id);
  $username = mysqli_escape_string($conn,$username);
  $email = mysqli_escape_string($conn,$email);
  $phone = mysqli_escape_string($conn,$phone);
  $location = mysqli_escape_string($conn,$location);
  $name = mysqli_escape_string($conn,$name);
  $surname = mysqli_escape_string($conn,$surname);

  $query ="
  UPDATE tbl_accounts
        SET
            email = '{$email}',
            username = '{$username}',
            phone = '{$phone}',
            location = '{$location}',
            name = '{$name}',
            surname = '{$surname}'
        WHERE
            id = '{$id}'
        ";
    $result  = mysqli_query($conn,$query);
    if (mysqli_affected_rows($conn) !=1){
        //.combines two strings
        echo "the query is not successful:";
        echo mysqli_error($conn);
    }else{
        //this will change $result to TRUE
        $result = TRUE;
    }
    disconnect_from_db($conn);

    return $result;
  }

 ?>
