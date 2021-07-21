<?php
session_start();
include_once "connection.php";

 if(! isset($_SESSION["logged_user"])){
     header("location:login.php");
 }

$user =(object) $_SESSION["logged_user"]
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
body{
    background-color: brown;
    background-image: url("laptop.jpg");
    background-size: 2000px;
    background-repeat: no-repeat;
    font-family: 'Courier New', Courier, monospace;
    background-position: center;
}
#wel{
    color: burlywood;
}

.topnav {
  background-color: #333;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #04AA6D;
  color: white;
}


    </style>
</head>
<body>
<h1 id="wel"> Welcome to my page <?php echo "$user->username"?></h1> 

<div class="topnav">
<a href="my_product.php">My Products</a>
<a href="add_product.php">Add Products</a>
<a href="all_product.php">All Products</a>
<a href="change_password.php">Change Password</a>
<a href="logout.php">Logout</a>
</div>

</body>
</html>