<?php include 'functions.php';

$myjson = file_get_contents('login.json');
$data=json_decode($myjson, TRUE);



if(file_exists('login.json')){
    if(isset($_POST["submit"])){
        $data["name"] = $_POST['surname'];
        $data["firstname"] =$_POST['name'];
        $data["email"] = $_POST['email'];
        $data["tel"] = $_POST['tel'];
        $data["birth"] = $_POST['birth'];
        $data["picture"] = $_FILES["picture"]["name"];
        
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

<div class="row ">
    <div class="col-6 justify-content-center align-items-center">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

<input type="hidden" name="action" value="update">
<div class="form-group">
    <label for="exampleFormControlInput1">Sur Name :</label>
    <input type="text" name="surname" value="<?php echo $data["name"]; ?>" placeholder="Ex: Smith">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">First name :</label>
    <input type="text" name="name" value="<?php echo $data["firstname"]; ?>" placeholder="Ex: John">  
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Email :</label>
    <input type="email" name="email" value="<?php echo $data["email"]; ?>" placeholder="Ex: example@example.com">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Phone/Mobile :</label>
    <input type="tel" name="tel" value="<?php echo $data["tel"]; ?>" placeholder="Ex: +33xxxxxxx00">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">BirthDate :</label>
    <input type="date" name="birth" value="<?php echo $data["birth"]; ?>" placeholder="Ex: 30/01/1920">
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">Photo (png/jpeg/jpg/gif) :</label>
    <input type="file" name="picture" id="picture" accept="image/*">
</div>
<div class="form-group">
    <input type="submit" name="submit" value="envoyer">
</div>
</form>
</div>

<div class="col-6 justify-content-center align-items-center">

<div class="container">
    <div class="row">
        <div class="col-6">
            <img class="img-thumbnail" src="<?php echo "uploads/".$data["picture"] ; ?>" alt="">
        </div>
        <div class="col-6">
            <p>Surame : <?php echo $data["name"]; ?> </p>
            <p>Name : <?php echo $data["firstname"]; ?> </p>
            <p>email : <?php echo $data["email"]; ?> </p>
            <p>tel : <?php echo $data["tel"]; ?> </p>
            <p>Birthdate : <?php echo $data["birth"]; ?> </p>
            
        </div>
    </div>
</div>

</div>

</div>

<?php include 'footer.php'; ?>