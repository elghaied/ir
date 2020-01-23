addButton = document.querySelector('#add');
modifierButton = document.querySelector('#modifier');

addButton.addEventListener("click", function() {
    formcontainer = document.querySelector('#formcontainer');
    formcontainer.textContent = 'hello how are you doin today';
});



{/* <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

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

</div>
<div class="form-group">
    <input type="submit" name="submit" value="envoyer">
</div>
</form> */}