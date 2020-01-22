
<?php include 'functions.php';
include 'header.php'; 
print_r ($_SESSION); 
?>


<div  class="row ">
    <div class="col-12 justify-content-center align-items-center">
<h1>HOME PAGE</h1>
<a href="clear_log.php">clear logs</a>
<?php 
    $myfile = fopen("first.txt", "a+") or die("Unable to open file!");

    while(!feof($myfile)) {
      echo fgets($myfile) . "<br>";
    }
    fclose($myfile);
    ?>
</form>
</div>
</div>

<?php include 'footer.php'; ?>




