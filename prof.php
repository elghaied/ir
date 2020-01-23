<?php include 'functions.php';

$myjson = file_get_contents('login.json');
$data=json_decode($myjson, TRUE);



if(file_exists('login.json')){

    if(isset($_POST["submit"]) && isset($_POST["modify"])){
        $data['prof'][$_POST['myselection']]["name"] = $_POST['surname'];
        $data['prof'][$_POST['myselection']]["firstname"] =$_POST['name'];
        $data['prof'][$_POST['myselection']]["email"] = $_POST['email'];
        $data['prof'][$_POST['myselection']]["tel"] = $_POST['tel'];
        $data['prof'][$_POST['myselection']]["birth"] = $_POST['birth'];
        $data['prof'][$_POST['myselection']]["picture"] = $_FILES["picture"]["name"];
        
        // START PHOTO

        // Check if image file is a actual image or fake image
        $target_dir =   "uploads/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["picture"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        } 
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        } 
        

        if(isset($_FILES["picture"])){
            move_uploaded_file($_FILES["picture"]["tmp_name"], 'uploads/'.$_FILES["picture"]["name"]);
        }
       
    

        // END PHOTO
        $datacoded = json_encode($data,true);

        $jsonfile = fopen("login.json", "w") or die("Unable to open file!");
        fwrite($jsonfile, $datacoded);
        fclose($jsonfile);
        //LOG for modification
        $myfile = fopen("first.txt", "a+") or die("Unable to open file!");
        $time = date("l jS \of F Y h:i:s A");
        $ip = $_SERVER['REMOTE_ADDR'];
        $txt = '<p class="text-primary">'. $_SESSION['id'] . ' has modified his profile at '. $time. ' Client IP :' . $ip . '</p>';
        fwrite($myfile, $txt);
        fclose($myfile);
        
    
    }
    
}




//HEADER
include 'header.php'; 
print_r ($_SESSION);




echo '<pre class="p-3 mb-2 bg-light text-dark">';
print_r ($data);
echo '</pre>';

?>

<!-- add button  -->
<div class="row justify-content-around p-4">
<form action="<?php echo $_SERVER['PHP_SELF'].'?add=1'; ?>" method="post" enctype="multipart/form-data">

<input type="submit" name="add" class="btn btn-primary" value="add">

</form>
 <!-- modify button  -->
<form action="<?php echo $_SERVER['PHP_SELF']. '?modifier=1'; ?>" method="post" enctype="multipart/form-data">

<input type="submit" name="modifier" class="btn btn-warning" value="modifier">

</form>


<div class="row ">
    <div id="formcontainer" class="col-6 justify-content-center align-items-center">
<!--==========================
    ========ADD PROF FORM=====
    ========================== -->
<?php
if(isset($_POST['add'])){
    if($_GET['add']=='1'){ ?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

<input type="hidden" name="add" value="update">
<div class="form-group">
    <label for="exampleFormControlInput1">Sur Name :</label>
    <input type="text" name="surname" value="" placeholder="Ex: Smith">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">First name :</label>
    <input type="text" name="name" value="" placeholder="Ex: John">  
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Email :</label>
    <input type="email" name="email" value="" placeholder="Ex: example@example.com">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Phone/Mobile :</label>
    <input type="tel" name="tel" value="" placeholder="Ex: +33xxxxxxx00">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">BirthDate :</label>
    <input type="date" name="birth" value="" placeholder="Ex: 30/01/1920">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Photo (png/jpeg/jpg/gif) :</label>
    <input type="file" name="picture" id="picture" accept="image/*">
</div>
<div class="form-group">
    <input type="submit" name="submit" value="envoyer">
</div>
</form>

    <?php } 
} ?>
            <!-- 
            ===================================
            ======= SELECTE PROF ==============
            =================================== -->

<?php 
if(isset($_POST['modifier'])){
    if($_GET['modifier']=='1'){ ?>

<form action="<?php echo $_SERVER['PHP_SELF'].'?selected=1'; ?>" method="post" enctype="multipart/form-data">


<label for='prof[]'>select prof:</label><br>
<select multiple="multiple" name="myselection">
        <?php 
        for($y=0;$y<count($data['prof']);$y++){


            echo  '<option value="'.$data['prof'][$y]['id'].'">'.$data['prof'][$y]['name'] ." " . $data['prof'][$y]
            ['firstname'].'</option>';


        }
        ?>
   
</select>
<input type="submit" name="selectmodifier" class="btn btn-warning" value="select">


</form>



<?php } 
} ?>
<!-- ===================================
     =========THE MODIFICATION FORM=====
     =================================== -->
<?php 
if(isset($_POST['selectmodifier'])){
    if($_GET['selected']=='1'){ ?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

<input type="hidden" name="modify" value="update">
<div class="form-group">
    <label for="exampleFormControlInput1">Sur Name :</label>
    <input type="text" name="surname" value="<?php echo $data['prof'][$_POST['myselection']]["name"]; ?>" placeholder="Ex: Smith">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">First name :</label>
    <input type="text" name="name" value="<?php echo $data['prof'][$_POST['myselection']]["firstname"]; ?>" placeholder="Ex: John">  
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Email :</label>
    <input type="email" name="email" value="<?php echo $data['prof'][$_POST['myselection']]["email"]; ?>" placeholder="Ex: example@example.com">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Phone/Mobile :</label>
    <input type="tel" name="tel" value="<?php echo $data['prof'][$_POST['myselection']]["tel"]; ?>" placeholder="Ex: +33xxxxxxx00">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">BirthDate :</label>
    <input type="date" name="birth" value="<?php echo $data['prof'][$_POST['myselection']]["birth"]; ?>" placeholder="Ex: 30/01/1920">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Photo (png/jpeg/jpg/gif) :</label>
    <input type="file" name="picture" id="picture" accept="image/*">
</div>
<div class="form-group">
    <input type="submit" name="submit" value="envoyer">
</div>
</form>

<?php } 
} ?>


</div>

<div class="col-6 justify-content-center align-items-center">


<!-- SHOW THE VALUE OF MY MODIFICATIONS -->
<div class="container">
    <div class="row">
        <div class="col-6">
            <img class="img-thumbnail" src="<?php 
            if(isset($_POST['selectmodifier'])){
                if($_GET['selected']=='1'){
            echo "uploads/".$data['prof'][$_POST['myselection']]["picture"] ;
                } 
            } ?> 
            " alt="">
        </div>
        <div class="col-6">
            <p>Surame : <?php 
            if(isset($_POST['selectmodifier'])){
                if($_GET['selected']=='1'){
                echo $data['prof'][$_POST['myselection']]["name"]; 
                 } 
            } ?> </p>
            <p>Name : 
            <?php 
            if(isset($_POST['selectmodifier'])){
                if($_GET['selected']=='1'){
                echo $data['prof'][$_POST['myselection']]["firstname"]; 
                 } 
            } ?>  </p>
            <p>email : 
            <?php 
            if(isset($_POST['selectmodifier'])){
                if($_GET['selected']=='1'){
                echo $data['prof'][$_POST['myselection']]["email"]; 
                 } 
            } ?>  </p>
            <p>tel :
            <?php 
            if(isset($_POST['selectmodifier'])){
                if($_GET['selected']=='1'){
                echo $data['prof'][$_POST['myselection']]["tel"]; 
                 } 
            } ?>  </p>
            <p>Birthdate : 
            <?php 
            if(isset($_POST['selectmodifier'])){
                if($_GET['selected']=='1'){
                echo $data['prof'][$_POST['myselection']]["birth"]; 
                 } 
            } ?>  </p>
            
        </div>
    </div>
</div>

</div>

</div>

<?php include 'footer.php'; ?>