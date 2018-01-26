<?php
include("functions.php");

  //check if we re editing a book
  if (!isset ($_GET["id"])){
      header("Location:accounts.php");
  }

  //try to delete the book
  $result = delete_account($_GET["id"]);

  if ($result != TRUE){
        echo $result;
    }else{
        header("Location:accounts.php");
    }
 ?>
