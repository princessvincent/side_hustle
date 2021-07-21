
<?php
// session_start();
include_once "connection.php";
include_once "header.php";

// $this_user = $_SESSION["logged_user"];

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            color: purple;
            font-family: 'Courier New', Courier, monospace;
            text-align: center;
        }

        #for {
            background-color: indigo;
            width: 600px;
            height: 300px;
            color: whitesmoke;
            font-size: 18px;
            float: center;
        }
        .fo{
            color: red;
            font-weight: 20px;
        }
        #reg{
            color: whitesmoke;
            background-color: blue;
            border: 4px solid white;
            float: left;
        }
        #log{
            color: whitesmoke;
            background-color: blue;
            border: 5px solid whitesmoke;
            float: right;
        }
    </style>
</head>
<!-- <h1>All product</h1> -->

<body>
<a href="register.php" id="reg">Register Here</a>                                  <a href="login.php" id="log">Login Here</a>
</body>

</html>
<?php
    $sql = "SELECT * FROM product";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $image = $row["product_image"];
        $name = $row["product_name"];
        $amount = $row["product_amount"];
        $quantity = $row["product_quantity"];
        $phone = $row["user_phone"];
        //  var_dump($image);
    ?>
        <div><img src='images/<?php echo $image ?>' width="500" height="400"></div>
        <span class="form"> <?php echo $name ?></span><br>
        <span class="fo"> <?php echo $amount ?></span><br>
        <span class="form"> <?php echo "Quantity left is ". $quantity ?></span><br>
        <a href="tel:$phone" id="for">Contact Seller</a>

    <?php } ?>