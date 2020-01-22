

<?php
include 'functions.php';
include 'header.php'; ?>

<?php
   print_r ($_SESSION); 

    if(isset($_POST['login']) && isset($_POST['password'])) {
        if($_POST['login']=='sam' && $_POST['password']=='1234'){
            
            echo '<p class="alert alert-success">bien joue</p>';
            $_SESSION["name"] = "loggedin";
            $_SESSION["id"] = $_POST["login"];
            $myfile = fopen("first.txt", "a+") or die("Unable to open file!");
            $time = date("l jS \of F Y h:i:s A");
            $ip = $_SERVER['REMOTE_ADDR'];
            $txt = '<p class="text-success">'. $_POST['login'] . ' has logged in at '. $time. ' Client IP :' . $ip . '</p>';
            fwrite($myfile, $txt);
            fclose($myfile);
            header("Location: index.php");
        
        }
        elseif($_POST['login']!='sam' || $_POST['password']!='1234') {
            echo '<p class="alert alert-warning">The user name or the password is <strong>wrong</strong> ! </p>';
        }
    } 
    else {

        echo '<p class="alert alert-light">';
        echo 'Please write the login informations';
        echo '</p>';
        
    }

    ?>
<div class="row ">
    <div class="col-12 justify-content-center align-items-center">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="hidden" name="action" value="login">
<input type="text" name="login" value="">
<input type="password" name="password" value="">
<input type="submit" value="envoyer">
</form>
</div>
</div>

<?php include 'footer.php'; ?>