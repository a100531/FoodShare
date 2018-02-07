<?php
// this file controls all the functions involved for the application and the website backend
  session_start();
  // encodes the images when being sent to the app
  function encode_image($image) {
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $data = file_get_contents($image);
    $base64 = 'data:image/' . $ext . ';base64,' . base64_encode($data);

    return $base64;
  }
  //creates a connection to the database
  function connect_to_db() {

      // $conn only exists within this function
      $conn = mysqli_connect("localhost", "icafesti_fdshr", '^~Gxk.awfH1k', "icafesti_foodshare")
          or die("Unable to connect.");

      // this will allow us to set a variable using this function
      return $conn;

  }
  //function connect_to_db() {

      // $conn only exists within this function
  //    $conn = mysqli_connect("localhost", "root", "", "foodshare")
  //        or die("Unable to connect.");

  //    // this will allow us to set a variable using this function
  //    return $conn;

  //}
  // disconnects the user from the database
  function disconnect_from_db(&$conn) {

      // closes a connection
      mysqli_close($conn);

  }
  // checks if the user is logged in
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
  // retrieves the password from the database
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
  // retrieves the information of the user
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
  // inserts the user in the databse after the information is sanitized
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
  // inserts the post in the databse
  function insert_post($product,$location,$phone,$expiry,$userId) {

      // 1. connect to the database
      $conn = connect_to_db();

      // 2. protect the variables from SQL injection
      $product = mysqli_escape_string($conn, $product);
      $location = mysqli_escape_string($conn, $location);
      $phone = mysqli_escape_string($conn, $phone);
      $expiry = mysqli_escape_string($conn, $expiry);
      $userId = mysqli_escape_string($conn, $userId);



      // 3. define a query
      $query = "
          INSERT INTO tbl_posts
              (posts_product, posts_location, posts_phone ,posts_expiry,posts_user)
          VALUES
              ('{$product}', '{$location}', '{$phone}', '{$expiry}','{$userId}')
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
  // the user is reported and the value is incremeneted everytime the button is pressed using SQL
  function report($user) {

      // 1. connect to the database
      $conn = connect_to_db();

      // 2. protect the variables from SQL injection
      $user = mysqli_escape_string($conn, $user);



      // 3. define a query
      $query = "
      UPDATE tbl_accounts
            SET
                reports = reports + 1
            WHERE
                username = '{$user}'

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
  // gives the user the ability to change their password used for the admin
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
  // displays all the account on the website
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
  // displays all the posts if they are not expired
  function show_posts($id = NULL){
      // connect to the database;
      $conn = connect_to_db();

      // defining a query
      // ask red as the expiry filter seems to glitch !!!!!!!!!!!!!!
      //$now = time();
      //WHERE posts_expiry > $now
      $query = "
        SELECT * FROM `tbl_posts`
      ";

      if ($id != NULL) {
        $id = mysqli_escape_string($conn, $id);
        $query .= "WHERE posts_id = {$id}";
      }

      //echo $query; die;

      // asking SQL to perform the query
      $result = mysqli_query($conn,$query);

      //disconnect from the database
      disconnect_from_db($conn);

      // give back the end result
      return $result;
  }
  // displays the posts on the application
  function show_mobPosts($id = NULL){
      // connect to the database;
      $conn = connect_to_db();

      // defining a query
      // ask red as the expiry filter seems to glitch !!!!!!!!!!!!!!
      //$now = time();
      //WHERE posts_expiry > $now
      $query = "
        SELECT * FROM `tbl_posts`
      ";

      //echo $query; die;

      // asking SQL to perform the query
      $result = mysqli_query($conn,$query);

      //disconnect from the database
      disconnect_from_db($conn);

      // give back the end result
      return mysqli_fetch_all($result, MYSQLI_ASSOC);
  }
  // checks if the post exists
  function check_post($id,$product,$location,$phone,$expiry){

    // connection to the database
    $conn = connect_to_db();

    $id = mysqli_escape_string($conn,$id);
    $product = mysqli_escape_string($conn,$product);
    $location = mysqli_escape_string($conn,$location);
    $phone = mysqli_escape_string($conn,$phone);
    $expiry = mysqli_escape_string($conn,$expiry);


    $query ="
        SELECT *
        FROM tbl_posts
          WHERE
              posts_product = '{$product}' AND
              posts_location = '{$location}' AND
              posts_phone = '{$phone}' AND
              posts_expiry = '{$expiry}' AND
              posts_id = '{$id}'
          ";

    // get the results to check that the query matches
      $result  = mysqli_query($conn,$query);

      // disconnect because the query is done
      disconnect_from_db($conn);

      // check the number of rows, and return TRUE or FALSE if the result is one.
      return mysqli_num_rows($result) == 1;
    }
  // updates the information of a post
  function edit_post($id,$product,$location,$phone,$expiry){

     if (check_post($id,$product,$location,$phone,$expiry)) {
         return TRUE;
     }

    // connection to the database
    $conn = connect_to_db();


        $id = mysqli_escape_string($conn,$id);
        $product = mysqli_escape_string($conn,$product);
        $location = mysqli_escape_string($conn,$location);
        $phone = mysqli_escape_string($conn,$phone);
        $expiry = mysqli_escape_string($conn,$expiry);

    $query ="
    UPDATE tbl_posts
          SET
              posts_product = '{$product}',
              posts_location = '{$location}',
              posts_phone = '{$phone}',
              posts_expiry = '{$expiry}'
          WHERE
              posts_id = '{$id}'
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
  // delete the account from the database
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
  // deletes the post from the databse
  function delete_post($id){

        $conn = connect_to_db();

        //protect our variables
        $id = mysqli_escape_string($conn, $id);

        $query ="
            DELETE FROM tbl_posts

            WHERE
                posts_id = '{$id}'
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
  // retrieves all the accountsi n the database
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
  // checks and makes sure that the account still exists
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
  // enalbles the user to edit their account and also allows the admin to do so
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
