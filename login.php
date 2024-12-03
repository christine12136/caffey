<?php
include("connection.php");
if(isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "select *from login where username = '$username' and password = '$password'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count==1){
        header("Location: index.html");
    }
    else{
        echo '<sript>
            window.location.href = "login.php";
            alert("Login failed. Invalid usernamer or password!!!")
        </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="php.css">
</head>
<body>
    <div id="form">
        <h1>Login Form</h1>
        <form name="form" action="login.php" onsubmit="return isvalid()" method="POST">
            <label>Username: </label>
            <input type="text" id="user" name="user"></br></br>
            <label>Password</label>
            <input type="password" id="pass" name="pass"></br></br>
            <input type="submit" id="btn" value="Login" name="submit"/>
        </form>
    </div>
    <script>
        function isvalid(){
            var user = document.form.user.value;
            var pass = document.form.pass.value;
            if(user.length==""&& pass.length==""){
                alert("Username and password field is empty!!!");
                return false    
            }
            else{
                if(user.length==""){
                alert("Username is empty!!!");
                return false   
                } 
                if(user.length==""){
                alert("Password is empty!!!");
                return false   
                } 
            }
        }
    </script>    
</body>
</html>


