<?php

  $filename = $_GET['id'];

  if (file_exists("contactMessages/{$filename}")) {
    unlink("contactMessages/{$filename}");
  }

  header('Location:messages.php');

?>
