<?php
$servername = "localhost";
$username = "root";
$password ="";
$db_name ="database1";
$conn = new mysqli($servername, $username, $password, $db_name,);
if($conn->connect_error){
    die("COnnection failed" .$conn->connect_error);
}
echo "";
?>