<?php
include("functions.php");

  //check if we re editing a book
  if (!isset ($_GET["id"])){
      header("Location:posts.php");
  }

  //try to delete the book
  $result = delete_post($_GET["id"]);


  $filename = $_GET['id'];
  //echo $filename; die;

  if (file_exists("postNotes/{$filename}.txt")) {
    unlink("postNotes/{$filename}.txt");
  }
  if (file_exists("productImages/{$filename}.*")) {
    unlink("productImages/{$filename}.*");
  }


  if ($result != TRUE){
        echo $result;
    }else{
        header("Location:posts.php");
    }
 ?>
