<?php
session_start();
if(!isset($_SESSION["logged_user"])){
    header("location:login.php");
}
$this_user = isset($_SESSION["logged_user"]) ?  ((object)$_SESSION["logged_user"]) : "";

include_once "connection.php";
include_once "header.php";
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            color: burlywood;
            background-size: cover;
            font-family: serif;
            text-align: center;
        }

        #tab {
            border-radius: 5px;
            background: cadetblue;
            color: burlywood;
            height: 250px;
            width: 700px;
            text-align: center;
            padding-top: 30px;
        }

        .table {
            text-align: center;
        }
    </style>
</head>

<body>

    <div id="tab">
        <table border="1" class="table">
            <h1>My Products</h1>
            <thead>
                <tr>
                <th>Phone number</th>
                <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Product Image</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqeal = "SELECT * FROM product WHERE user_phone = '$this_user->tel'";

                $res = mysqli_query($conn, $sqeal);

                while ($result = mysqli_fetch_assoc($res)) {
                    $p_id = $result["id"];

                    // var_dump($result);
                ?>

                    <tr>
                    <td> <?php echo $result["user_phone"] ?></td>
                        <td> <?php echo $result["product_name"] ?></td>
                        <td> <?php echo $result["product_amount"] ?></td>
                        <td> <?php echo $result["product_quantity"] ?></td>
                        <td> <?php echo $result["product_image"] ?></td>
                        <td> <a href="view.php?id=<?php echo $p_id?>">View</a></td>
                        <td> <a href="edit.php?id=<?php echo $p_id ?>">Edit</a></td>
                        <td> <a href="delete.php?id=<?php echo $p_id ?>">Delete</a></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>