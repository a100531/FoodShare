<?php

$email = $_POST['email'];
$message =$_POST['message'];
$time = time()+60*60*24*30;
$myfile = fopen("adminController/contactMessages/$email,$time.txt", "w") or die("Unable to open file!");
$txt = $email;
fwrite($myfile, $txt);
$txt = "\r\n";
fwrite($myfile, $txt);
$txt = $message;
fwrite($myfile, $txt);
fclose($myfile);
header('Location:index.php');
?>
