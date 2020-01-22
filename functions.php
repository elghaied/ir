
<?php 
session_start();
// session_destroy();

// show dump of server

/*echo '<pre>';
 var_dump($_SERVER);
 echo '</pre>';
*/

if(!isset($_SESSION["name"])){
//   if ($_SESSION["name"] != "loggedin"){
      $_SESSION["name"] = "visitor";
  }


  
?>


<?php 

date_default_timezone_set('Europe/Paris');

// if($_SESSION["name"] == "visitor"){
  
//   header("Location: login.php");
// } elseif ($_SESSION["name"] == "loggedin"){
//   header("Location: index.php");
// }
// ?>