<?php
session_start();
include_once "connection.php";
include_once "header.php";

if(isset($_POST["sub"])){
if(isset($_POST["full"])&& isset($_POST["username"])&& isset($_POST["phone"])&& isset($_POST["email"])&& isset($_POST["add"]) && isset($_POST["gender"])&& isset($_POST["pass"])){

    $full = ($_POST["full"]);
    $user = ($_POST["username"]);
    $phone = ($_POST["phone"]);
    $email = ($_POST["email"]);
    $add = ($_POST["add"]);
    $gen = ($_POST["gender"]);
    $pass = ($_POST["pass"]);

    if(filter_var("$email, FILTER_VALIDATE_EMAIL")){
        $email_err = "Invalid Email Address";
    }
    if(filter_var("$phone, FILTER_VALIDATE_INT")){
        $number_error = "Phone number must be an interger";
    }
    $sql = "SELECT * FROM register WHERE email='$email'";

    $sql1 = "SELECT * FROM register WHERE tel = '$phone'";

    $res1 = (mysqli_query($conn,$sql1));

    
    $res = (mysqli_query($conn,$sql));

    if((mysqli_num_rows($res) ==1)){
        $email_error = "Sorry ...... Email address already exist";
    }elseif(!mysqli_num_rows($res1) == 0){

        $number_error = "Sorry....... Number already Exist!";
    }
    else{
        $insert = "INSERT INTO register (fullname,username, tel,email,address,gender, password) VALUES('$full','$user','$phone','$email','$add','$gen',md5('$pass'))";

        $result = (mysqli_query($conn,$insert));
        echo "Registration successful !";
        header("location:login.php");
        exit();
    }
    {

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
    font-family: 'Courier New', Courier, monospace;
    color: olivedrab;
    font-size: 20px;
    text-align: center;
}
#divform{
    background-color: lightcyan;
    border: 10px solid wheat;
    border-radius: 100px;
    padding: 10px;
    width: 700px;
    height: 500px;
}
.subm{
color: red;
background-color: purple;
width: 70px;
height: 30px;
}
/* #head{
    background-color: purple;
    width: 450px;
    height: 50px;
    padding: 10px;
    margin: 10px;
    text-align: center;
} */

    </style>
</head>
<body>
    
 
 <div id="divform">
 <h1 >Register Here</h1>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
Fullname: <input type="text" name="full" placeholder="Fullname" required><br><br>
Username:<input type="text" name="username" placeholder="username" required><br><br>
Tel:<input type="number" name="phone" placeholder="number" required><br><br>
Email:<input type="email" name="email" placeholder="email address" required><br><br>
Address: <input type="text" name="add" placeholder="your address" required><br><br>
Gender: 
<select name="gender">
<option>Female</option>
<option>Male</option>
</select>
<br><br>
Password: <input type="password" name="pass" placeholder="password" required><br><br>
<button type="submit" name="sub" class="subm">Submit</button>
 </form>

 <span><a href="login.php">Login Here</a></span>
 </div>   
</body>
</html>