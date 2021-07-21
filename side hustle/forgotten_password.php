<?php
session_start();
include_once "connection.php";
include_once "header.php";
if(!isset($_SESSION["logged_user"])){
    header("location:login.php");
}

if(isset($_POST["sub"])){
    $email = $_POST["email"];
    $n_pass = $_POST["pass"];

    $sql = "UPDATE register SET password = md5('$n_pass') WHERE email = '$email'";

    $res = mysqli_query($conn, $sql);
    echo ($res)? "Password changed successfully!" : "unable to change password";
}else{
    echo "Invalid credencials";
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
#subm{
    color: red;
    border-radius: 1px;
}
body{
    color: purple;
    text-align: center;
    margin: 5px;
    padding: 20px;
    padding-top: 10px;
}
.form{
     background-color: skyblue;
     width: 400px;
     height: 200px;
     padding: 20px;
}

    </style>
</head>
<body>
 <div class="form">
     <h1>Reset your Password</h1>
     <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" action="POST">
     Email:<input type="email" name="email" placeholder="email address"><br><br>
     New Password: <input type="password" name="pass" placeholder="new password"><br><br>
     <button type="submit" name="sub" id="subm">Submit</button>
     </form>
 </div>   
</body>
</html>