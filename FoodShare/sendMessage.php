<?php
// this file uses the information sent by the form to create the textfile to be saved
// as a contact message
$email = $_POST['email'];
$message =$_POST['message'];
$time = time();
$myfile = fopen("adminController/contactMessages/$time.txt", "w") or die("Unable to open file!");
$txt = $email;
fwrite($myfile, $txt);
// the script skips a line to enable the rest of the process to seperate the email of the sender from the text so they can be used separately later
fwrite($myfile, PHP_EOL);
$txt = $message;
fwrite($myfile, $txt);
fclose($myfile);
header('Location:index.php');
?>
