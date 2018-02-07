<?php
// uses the username from the posts to add a report to the database in the user's record
  header('Access-Control-Allow-Origin: *');
  include('functions.php');
  $id = $_GET["id"];
  $rows = report($id);

  if ($rows > 0) {
    echo json_encode(array('id' => 1));
  } else {
    echo json_encode(array('id' => 0));
  }

?>
