<?php 
session_start();
include_once "connection.php";
include_once "header.php";
$this_user = isset($_SESSION["logged_user"]) ?  ((object)$_SESSION["logged_user"]) : "";
$p_id = isset($_GET['id']) ? $_GET['id'] : '';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// var_dump($this_user);

$sql = "SELECT * FROM product WHERE id = '$p_id'";

$res = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($res)){
?>
<div>
    <p><?php echo $row["product_name"]?> &nbsp; <b>Posted On:</b><span><?php echo $row["created_at"]?></span></p>
    <img height="300" width="500" src="./images/<?php echo $row["product_image"]?>">
</div>
<?php }?>  
</body>
</html>