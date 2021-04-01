<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "idiscuss";

$conn = mysqli_connect($servername, $username, $password,$database);
if(!$conn){
  die("Not conneccted successfully");
}
else {
    // echo "connected successfull..";
}

?>