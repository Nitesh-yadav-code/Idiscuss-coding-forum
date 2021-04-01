<?php require_once '../connection/db.php';?>
<?php 
$method = $_SERVER['REQUEST_METHOD'];
if($method=='POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `signup` WHERE `email`='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        
       $row = mysqli_fetch_assoc($result);
       if(password_verify($password, $row['password'])){
         
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['sno'] = $row['sno'];
        $_SESSION['username'] = $email;
        header("Location: /forum/index.php?loginSuccess=true");
       
       }else{
        header("Location: /forum/index.php?loginfail=true");
           
       }
    
        
    }
    else{
        echo "error------------->";
        echo $method;
    }
}
?>

