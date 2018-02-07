<?php
header('Access-Control-Allow-Origin: *');
include("functions.php");

  //check if we are deleting a post
  //if (!isset ($_GET["id"])){
  //    header("Location:posts.php");
  //}

  //try to delete the post
  $result = delete_post($_GET["id"]);
  if ($result > 0) {
    echo json_encode(array('id' => 1));
  } else {
    echo json_encode(array('id' => 0));
  }

  // set the file name to be able to delete the notes and image too
  $filename = $_GET['id'];
  //echo $filename; die;
  // if the file exists delete the textfile
  if (file_exists("postNotes/{$filename}.txt")) {
    unlink("postNotes/{$filename}.txt");
  }
  // if the file exists delete the image
  if (file_exists("productImages/{$filename}.*")) {
    unlink("productImages/{$filename}.*");
  }

  // if the result is false echo it for troubleshooting

 ?>
