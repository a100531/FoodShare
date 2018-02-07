<?php
      // after sanitizing the inputs from the form it sends the information and updates the account information
      header('Access-Control-Allow-Origin: *');

      include '../adminController/functions.php';

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $id = $_POST['id'];
        $phone = $_POST['phone'];
        $location = $_POST['location'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        //$description = $_POST['message'];


        edit_MobAccount($id,$phone,$location,$name,$surname);

        $details = get_user_from_id($id);
        echo json_encode($details);

      }

 ?>
