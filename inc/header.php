<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">
    <title>Coding Forum</title>
</head>

<body>
<?php require_once 'connection/db.php';?>
    <?php 
 session_start();
echo '<nav class="navbar navbar-expand-lg fixed-top  navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         Top Category
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql = "SELECT * FROM `categories`";
         $result = mysqli_query($conn, $sql);
        while($row= mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catid = $row['category_id'];

         echo '<li><a class="dropdown-item" href="threads.php?catid='. $catid .'">'.$catname.'</a></li>';
        }
        echo '</ul>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="contact.php">Contact</a>
    </li>
    </ul>';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      echo '<form class="d-flex" action="search.php"  methode="GET">
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success " type="submit">Search</button>
     <p class ="text-light my-0 mx-2 text-center"> welcome '.$_SESSION['username'].'</p>
     <a class="btn btn-outline-success mx-3"   href="function\logout.php" role="button">Logout</a>
      </form>';
    }
    else{
       echo '<a class="btn btn-outline-success mx-3" data-bs-toggle="modal" data-bs-target="#login"  href="#" role="button">Login</a>
       <a class="btn btn-outline-success"  data-bs-toggle="modal" data-bs-target="#signup" href="#" role="button">signup</a>';
    }
      
   echo ' </div>
   </div>
   </nav>
   '; 
 

?>

</body>
<script src="bootstrap\js\bootstrap.bundle.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->

</html>

<?php include_once 'function/login.php';?>
<?php include_once 'function/signup.php';?>
<?php 
if(isset($_GET['signupSuccess']) && $_GET['signupSuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success! </strong> You are successfully sign in ..
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if(isset($_GET['signupfail']) && $_GET['signupfail']=="true"){
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Sorry! </strong> Your email already in use..
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if(isset($_GET['loginfail']) && $_GET['loginfail']=="true"){
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Sorry! </strong> Password do no match..
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}


// if(isset($_GET['loginSuccess']) && $_GET['loginSuccess']=="true"){
//   echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
//   <strong>Success! </strong> successfully loged in..
//   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
// </div>';
// }
?>