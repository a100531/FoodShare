<?php

$email = $_POST['email'];
$message =$_POST['message'];
$time = time();
$myfile = fopen("adminController/contactMessages/$time.txt", "w") or die("Unable to open file!");
$txt = $email;
fwrite($myfile, $txt);
fwrite($myfile, PHP_EOL);
$txt = $message;
fwrite($myfile, $txt);
fclose($myfile);
header('Location:index.php');
?>
