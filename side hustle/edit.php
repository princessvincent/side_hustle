<?php
session_start();
if(!isset($_SESSION["logged_user"])){
    header("location:login.php");
}
include_once "connection.php";
include_once "header.php";
$ID = '';
//if id is inside url
if ((isset($_GET["id"]) && $_GET['id'])) {
    $ID = $_GET['id'];
    //store id inside session incase of next time
    $_SESSION['id'] = $ID;
} elseif (isset($_SESSION['id'])) {
    //if id is inside session
    $ID =  $_SESSION['id'];
}



//update product record
if (isset($_POST["update"])) {
    if (isset($_POST["p_name"]) && isset($_POST["p_amount"]) && isset($_POST["p_quantity"]) && isset($_POST["phone"]) && isset($_POST["id"])) {
        $name = trim($_POST["p_name"]);
        $amount = trim($_POST["p_amount"]);
        $quantity = trim($_POST["p_quantity"]);
        $phone = trim($_POST["phone"]);
        $image_file = trim($_FILES["image"]["name"]);
        $image_tmp = trim($_FILES["image"]["tmp_name"]);
        $image_size = trim($_FILES["image"]["size"]);
        $image_type = trim($_FILES["image"]["type"]);
        $image_error = trim($_FILES["image"]["error"]);

        $filext = explode('.', $image_file);
        $actualfileext = strtolower(end($filext));

        $allowed_format = ['jpg','jpeg', 'png','pdf'];

        if(!in_array($actualfileext,$allowed_format)){
            $error['message']="only jpg,jpeg,png,pdf file is allowed";

        }elseif($image_size < 2000000){
$errors['image'] = "Image should not be more than 2MB";
        }
        // var_dump($image_file);
        }
        if($image_error == 0){

if(!getimagesize($image_tmp)){

    $error["image"] = "The file you uploaded is not an image";

}elseif(!move_uploaded_file($image_tmp,"./images/$image_file" )){
    $error["image"] = "Unable to upload image!";
}elseif(move_uploaded_file($image_tmp, "./images/$image_file")){
    $sql = "DELETE FROM product where id= '$ID' ";

    $rest = mysqli_query($conn,$sql);
}

        }else{
            echo "There was an error uploading your file";
        }
        
        $ID = $_POST["id"];

        $sql = "UPDATE product SET product_name =' $name', product_amount =  '$amount',product_quantity = '$quantity',user_phone = '$phone', product_image = '$image_file' WHERE id = '$ID' ";

        $res = mysqli_query($conn, $sql);
        if ($res) {
            echo   "Updated";
        } else {
            echo "Unable to update";
        }
    } else {
        echo "error";
    }

//end update product record


// get product record
$record = mysqli_query($conn, "SELECT * FROM product WHERE id = $ID");

if ($record->num_rows > 0) {
    $n = mysqli_fetch_array($record);
    $o_phone = $n["user_phone"];
    $o_name = $n["product_name"];
    $o_quantity = $n["product_quantity"];
    $o_amount = $n["product_amount"];
    $o_image = $n["product_image"];
    $o_ID = $n["id"];
}
//end get product record



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
    text-align: center;
    font-family: 'Times New Roman', Times, serif;
}
#for{
    background-color: whitesmoke;
    border: 8px solid plum;
    width: 1500px;
}
#up{
    color: whitesmoke;
    background-color: plum;
    width: 70px;
    height: 40px;
}

    </style>
</head>

<body>
    <h1>Edit Your Product</h1>
    <div id="for">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $o_ID; ?>"><br><br>
            Product Name: <input type="text" name="p_name" placeholder="product name" value="<?php echo ($o_name) ? $o_name : "" ?>"><br><br>
            Product Quantity: <input type="text" name="p_quantity" placeholder="qauntity" value="<?php echo ($o_quantity) ? $o_quantity : "" ?>"><br><br>
            Product Price: <input type="text" name="p_amount" placeholder="1000" value="<?php echo ($o_amount) ? $o_amount : "" ?>"><br><br>
            Phone: <input type="number" name="phone" placeholder="phone number" value="<?php echo ($o_phone) ? $o_phone : "" ?>"><br><br>
             Product Image: <input type="file" name="image" placeholder="image" value="<?php echo ($o_image)? $o_image : "" ?>"><br><br>  
            <button type="submit" name="update" id="up">Update</button>
        </form>
    </div>
</body>

</html>