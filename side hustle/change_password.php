<?php
session_start();
include_once "header.php";
if(!isset($_SESSION["logged_user"])){
  header("location:login.php");
}
include_once "connection.php";

$old_password = $_SESSION["logged_user"]["password"];
$user_id  = $_SESSION["logged_user"]["id"];

if(isset($_POST["sub"])){
$i_new_pass = $_POST["new_pass"];
$o_old_pass = $_POST["old_pass"];

if($i_new_pass == $o_old_pass){
    $update = "UPDATE register SET password = md5('$i_new_pass') WHERE id = '$user_id'";

    $res = mysqli_query($conn,$update);
echo($res)? 'New password Updated': 'Unable to update password!';
}else{
echo "Incorrect Password supplied!";
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
  font-family: 'Times New Roman', Times, serif;
  font-weight: 4px;
  color: purple;
  text-align: center;
  /* background-color: skyblue; */
  padding: 40px;
  margin: 20px;
}
.form{
  color: purple;
  border-radius: 18px;
  width: 150px;
  height: 30px;
}
#divform{
  color: purple;
  border: 10px;
}
#for{
  border-radius: 7px;
  color: red;
  background-color: purple;
  border: 5px solid white;
}
#fo{
  border: 20px solid;
  width:500px;
  height: 350px;
  background-color: wheat;
}


    </style>
</head>
<body>
  <div id="fo">
    <h1>Change Password</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" >
Old Password: <input type="password" name="new_pass" placeholder="new password" class="form"><br><br>
New Password: <input type="password" name="old_pass" placeholder="new password" class="form"><br><br>
<a href="login">Login here</a><br><br>
<button type="submit" name="sub" id="for">Update</button>
</div>
</form> 
</body>
</html>