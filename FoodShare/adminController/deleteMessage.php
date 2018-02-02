<?php
  // uses the id of the filename which was sent by the previous page to find
  // the mesage with the id and deletes it
  $filename = $_GET['id'];

  if (file_exists("contactMessages/{$filename}")) {
    unlink("contactMessages/{$filename}");
  }

  header('Location:messages.php');

?>
