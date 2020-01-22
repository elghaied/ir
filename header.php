



<!-- // Redirection -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css.map">

    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css.map">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css.map">

    <link rel="stylesheet" type="text/css" href="style.css">


    <title>form login</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">CEFIM</a>

  <ul class="navbar-nav ">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
     
      <li class="nav-item">
          <?php 
          if($_SESSION["name"] == 'loggedin'){
            echo '<a class="nav-link" href="profile.php">⚙️ Settings</a>';
          }
          ?>
      </li>
      <li class="nav-item">
          <?php 
          if($_SESSION["name"]!='loggedin'){
        echo '<a class="nav-link" href="login.php">login</a>';
          }
          else{
              echo '<a class="nav-link" href="logout.php">Logout</a>';
          }
          ?>
      </li>
</ul>
</nav>

<div class="container bg-dark text-white">