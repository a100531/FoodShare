<?php
// uses the username from the posts to add a report to the database in the user's record
include('functions.php');
  if (!isset ($_GET["user"])){
      header("Location:posts.php");
  }
  $user = $_GET["user"];
  report($user);
  header("Location:posts.php");
?>
