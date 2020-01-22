<?php
$myfile = fopen("first.txt", "w") or die("Unable to open file!");
$txt = "";
fwrite($myfile, $txt);
fclose($myfile);
//Redirection
header("Location: index.php");
?> 