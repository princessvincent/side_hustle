<?php
include_once "connection.php";

include_once "header.php";
if(isset($_GET['id'])){
    $ID = $_GET['id'];

    $sql = "DELETE FROM product WHERE id = $ID ";
    $res = mysqli_query($conn,$sql);
    $_SESSION["message"] = "Product Deleted!";

    //  header("location: my_product.php");
}

?>
