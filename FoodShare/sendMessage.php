<?php

$email = $_POST['email'];
$message =$_POST['message'];

$myfile = fopen("adminController/contactMessages/$email.txt", "w") or die("Unable to open file!");
$txt = $email;
fwrite($myfile, $txt);
$txt = "\r\n";
fwrite($myfile, $txt);
$txt = $message;
fwrite($myfile, $txt);
fclose($myfile);
header('Location:index.php');
?>
