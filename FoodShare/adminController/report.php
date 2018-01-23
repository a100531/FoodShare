<?php
include('functions.php');
  if (!isset ($_GET["user"])){
      header("Location:posts.php");
  }
  $user = $_GET["user"];
  report($user);
  header("Location:posts.php");
?>
