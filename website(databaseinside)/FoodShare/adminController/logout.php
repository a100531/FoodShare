<?php
  // to reset/clear a cookie
  // set it again which a date in the past
  foreach ($_COOKIE as $key => $value) {
    setcookie($key, NULL, time()-3600);
  }

  // redirect back to the login page
  header('Location:../index.php');
 ?>
