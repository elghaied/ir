<?php 
session_start() ;
session_destroy() ;

session_start() ;
$_SESSION["name"] = "visitor";

// log file
$myfile = fopen("first.txt", "a+") or die("Unable to open file!");
$time = date("l jS \of F Y h:i:s A");
$ip = $_SERVER['REMOTE_ADDR'];
$txt = '<p class="text-danger">'. $_POST['login'] . ' has logged out at '. $time  . ' Client IP :' . $ip .'</p>' ;
fwrite($myfile, $txt);
fclose($myfile);

//Redirection
header("Location: login.php");
?>
