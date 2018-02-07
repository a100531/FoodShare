<?php
  header('Access-Control-Allow-Origin: *');

  include '../adminController/functions.php';
  // this file handles the printing of the posts in the application

  $location = (isset($_GET['location'])) ? $_GET['location'] : NULL;
  $category = (isset($_GET['category'])) ? $_GET['category'] : NULL;

  $posts = show_mobPosts($category, $location);
  // for each image that exists for the posts the for loop encodes it
  foreach ($posts as &$post) {
        $image = glob("../adminController/productImages/{$post['posts_id']}.*");
        if (count($image) >0) {
            $image = str_replace('../', '', $image[0]);
        }else{
            $image = "mobile/img/noPhoto.png";
        }
        $post['postImg'] = "http://foodshare.dev/{$image}";

    }
    // a for loop is used to retrieve and print each text file related to the post
    foreach ($posts as &$post) {
        $textfile = "../adminController/postNotes/{$post['posts_id']}.txt";
        $post['postNote'] = file_exists($textfile) ? file_get_contents($textfile) : '';
    }

    // all the information is encoded to be able to use it with json
  echo json_encode($posts);

?>
