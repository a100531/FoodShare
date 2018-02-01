<?php
  header('Access-Control-Allow-Origin: *');

  include '../adminController/functions.php';

  $posts = show_mobPosts();

  foreach ($posts as &$post) {
        $image = glob("../adminController/productImages/{$post['posts_id']}.*");
        if (count($image) >0) {
            $image = $image[0];
        } //else {
            //$image = "uploaded_imgs\defaultpic.jpg" ;

        //}
        $post['postImg'] = encode_image($image);

    }

    foreach ($posts as &$post) {
        $textfile = "../adminController/postNotes/{$post['posts_id']}.txt";
        $post['postNote'] = file_exists($textfile) ? file_get_contents($textfile) : '';
    }


  echo json_encode($posts);

?>
