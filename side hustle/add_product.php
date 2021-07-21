<?php
session_start();

if(!isset($_SESSION["logged_user"])){
    header("location:login.php");

}
include_once "connection.php";
include_once "header.php";

if(isset($_POST["sub"])){
    $errors = [];

    if(isset($_POST["phone"])&& isset($_POST["p_name"])&& isset($_POST["p_amount"])&& isset($_POST["p_quantity"])){
        $phone = $_POST["phone"];
        $name = $_POST["p_name"];
        $amount = $_POST["p_amount"];
        $quantity= $_POST["p_quantity"];
        $image = $_FILES["image"]["name"];
        $tmp_image = $_FILES["image"]["tmp_name"];
        $tmp_size = $_FILES['image']['size'];
        // $tmp_type = $_FILES['image']['type'];
        $tmp_error = $_FILES['image']['error'];

        $allows_format = ['jpeg', 'png', 'jpg'];

        // get file extension
        $file_ext = strtolower(pathinfo(basename($image), PATHINFO_EXTENSION));

        // check if image is jpg, png, jpeg only
        if(!in_array($file_ext, $allows_format)){
            $errors['image'] = "only jpg, png, jpeg format allow";
        }elseif($tmp_size > 1000000){
        // check if image size is greater than 1MB = 1million
        $errors['image'] = "image should not be more than 1MB";
        }


        //check if image is uploaded successfully,
        if($tmp_error == UPLOAD_ERR_OK){
            //if this image is not original
            if(!getimagesize($tmp_image)){
                $errors['image'] = "file you uploaded is not an image";
            }
            elseif(!move_uploaded_file($tmp_image, "./images/$image")){
                //if image is not able to store inside images folder
                $errors['image'] = "unable to upload image";
            }         


        }

        $sql = "INSERT INTO product (user_phone,product_name,product_amount,product_quantity,product_image) VALUES ('$phone','$name','$amount','$quantity','$image')";

        //check if their is no error before creating new product
        if(empty($errors)){
            $result = mysqli_query($conn, $sql);
            echo "Product created successfully!";
        }

    }else{
        echo "Unable to create product!";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
body{
    color: purple;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
text-align: center;
}
#subm{
    background-color: red;
    border-radius: 5px;
    text-align: center;
}
.div{
    background-color: burlywood;
    width: 400px;
    height: 300px;
    margin: 10px;
    padding: 30px;
    text-align: center;
}

    </style>
</head>
<body>
 <div class="div">
     <h1>Add Products</h1>
     <h2>
        <?php echo (isset($errors) && isset($errors['image']) ) ? $errors['image'] : "" ?>
     </h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" enctype="multipart/form-data">
Product Name: <input type="text" name="p_name" placeholder="product name"><br><br>
Product Quantity: <input type="text" name="p_quantity" placeholder="qauntity"><br><br>
Product Price: <input type="text" name="p_amount" placeholder="1000"><br><br>
Phone: <input type="number" name="phone" placeholder="phone number"><br><br>
Product Image: <input type="file" name="image" placeholder="image"><br><br>
<button type="submit" name="sub" id="subm">Submit</button>
</form>
 </div>   
</body>
</html>