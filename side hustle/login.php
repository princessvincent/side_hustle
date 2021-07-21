<?php
session_start();
include_once "connection.php";
include_once "header.php";

if(isset($_POST["sub"])){
    if(isset($_POST["email"])&& isset($_POST["pass"])){
        $email = htmlentities($_POST["email"]);
        $pass = md5(htmlentities($_POST["pass"]));

        $sql = "SELECT * FROM register WHERE email = '$email' and password = '$pass'";

        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res)>0){

            $_SESSION["logged_user"] = mysqli_fetch_assoc($res);
            header("location: dashboard.php");
        }else{
            echo "Incorrect Password or Email address! <a href='login.php'>try again</a>";
        }

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
    font-size: 20px;
    font-family: 'Courier New', Courier, monospace;
    text-align: center;
}
.font{
    color: brown;
}
.head{
    background-color: burlywood;
}#form{
    background-color: gainsboro;
    height: 350px;
}
#subm{
    color: red;
    background-color: purple;
    width: 80px;
    height: 30px;
}

    </style>
</head>
<body>
    
 <div id="form">
 <h1 class="head">Login and have an Amazing experience</h1>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
 Email:<input type="email" name="email" placeholder="Email address" required><br><br>
 Password : <input type="password" name="pass" placeholder="password" required><br><br>
 <span class="font"><i>Forgotten password   <a href="forgotten_password.php">click here</a></i></span><br><br>
 <span class="font"><i>Dont have an account   <a href="register.php">Click here to register</a></i></span><br><br>
 <button type="submit" name="sub" id="subm">Submit</button>
 </form>
 
 </div>   
</body>
</html>