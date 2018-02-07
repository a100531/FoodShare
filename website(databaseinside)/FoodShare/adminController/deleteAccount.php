<?php
include("functions.php");

  //check if we re editing an account
  if (!isset ($_GET["id"])){
      header("Location:accounts.php");
  }

  //try to delete the account
  $result = delete_account($_GET["id"]);
  //if the result is unsuccessfull echo the result
  if ($result != TRUE){
        echo $result;
    }else{
        // relocates the user to the accounts page
        header("Location:accounts.php");
    }
 ?>
