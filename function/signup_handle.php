<?php require_once '../connection/db.php';?>
<?php 
$method = $_SERVER['REQUEST_METHOD'];
if($method=='POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    //check whether this email exist
    $existSql = "SELECT * FROM `signup` WHERE `email`='$email'";
    $result2 = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result2);
    if($numRows>0){
        header("Location: /forum/index.php?signupfail=true");
    }
    else{
        if($password== $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `signup` (`email`, `password`) VALUES ('$email', '$hash')";
            $result1 = mysqli_query($conn, $sql);

            if($result1){
                header("Location: /forum/index.php?signupSuccess=true");
                exit();
            }
        }
        else{
            header("Location: /forum/index.php?passwordMatching=false");
        }
    }
   
   





}

?>
