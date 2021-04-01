<?php include_once 'inc/header.php'; ?>
<?php require_once 'connection/db.php';?>
<?php 
$id= $_GET['catid'];
$sql = "SELECT * FROM `categories` WHERE category_id=$id";
$result = mysqli_query($conn, $sql);
while($row= mysqli_fetch_assoc($result)){
   $catname = $row['category_name'];
   $catdesc = $row['category_description'];
}
?>

<?php  
 $showAlert = false;
$method = $_SERVER['REQUEST_METHOD'];
if($method=='POST'){
    $th_tittle =$_POST['title'];
    $th_tittle = str_replace("<", "&lt;", $th_tittle);
    $th_tittle = str_replace(">", "&gt;", $th_tittle);

    $th_desc = $_POST['desc'];
    $th_desc = str_replace("<", "&lt;", $th_desc);
    $th_desc = str_replace(">", "&gt;", $th_desc);
    $th_id = $_POST['sno'];

    $sql = "INSERT INTO `thread` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`)
     VALUES ( '$th_tittle', ' $th_desc', '$id', '$th_id', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $showAlert = true;
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong>  Your thread has been added! Please wait for community to respond.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}

?>

<style type="text/css">
.jumbotron {
    max-height: 100vh;
    max-width: 900px;
    padding: 3rem 2rem;
    margin: 0 auto;
    margin-top: 25px;
    margin-bottom: 2rem;
    background-color: var(--bs-light);
    border-radius: .3rem;
}
#fm{
    background-color: white;
}
.media {
    margin: 0 auto;
}
</style>
<!-- start of jumbotron -->
<div class="jumbotron">
    <h1 class="display-4">Welcome to <?php echo $catname;?> forums</h1>
    <p class="lead">
        <?php echo $catdesc;?></p>
    <hr class="my-4">
    <p>This is peer to peer forum for sharing knowledg to each other
        No Spam / Advertising / Self-promote in the forums. ...
        Do not post copyright-infringing material. ...
        Do not post “offensive” posts, links or images. ...
        Do not cross post questions. ...
        Do not PM users asking for help. ...
        Remain respectful of other members at all times.
    </p>
    <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
</div>
<!-- End of jumbotron -->
<?php  
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      echo '<div class="container jumbotron" id="fm">
      <h1>Start Discussion</h1>
      <form action= " '.$_SERVER['REQUEST_URI'].'"   method ="post" >
      <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Problem Title</label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlTextarea1">Elaborate Your Concern</label>
        <textarea  class="form-control" name="desc" id="desc"  rows="3"></textarea>
        </div>
        
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
      </div>';
  }else{
    echo '  <div class="container jumbotron" id="fm">
    <h1>Start Discussion</h1>
           <p> Login to Start Discussion</p>
  </div>';
  }
?>



<!-- start of Media object -->
<div class="container media">
   

    <?php 
$id= $_GET['catid'];
$sql = "SELECT * FROM `thread` WHERE thread_cat_id=$id";
$result = mysqli_query($conn, $sql);
$noResult = true;
while($row= mysqli_fetch_assoc($result)){
    $noResult = false;
    $id = $row['thread_id'];
    $title = $row['thread_title'];
   $desc = $row['thread_desc'];
   $timestamp = $row['timestamp'];
   $user_id = $row['thread_user_id'];
   $sql2 = "SELECT email FROM `signup` WHERE sno=$user_id";
   $result2 = mysqli_query($conn, $sql2);
   $row = mysqli_fetch_assoc($result2);

  echo'<div class="container mt-3">
        <div class="d-flex  p-3">
            <img src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="John Doe"
                class="flex-shrink-0 mr-3  rounded-circle" style="width:50px;height:50px;">
            <div>
            
                <h5 class="mt-0"><a class="text-dark " href="thread_list.php?threadid=' .$id. '">'.$title.'</a></h5>
                <p>'.$desc.'</p>
                <P class = "font-weight-bold my-0">Asked by: '.$row['email'].' At '.$timestamp.'</p>
            </div>
        </div>
    </div>';
}
?>

<?php 
// echo var_dump($getResult);
if($noResult){
    echo '<div class="jumbotron">
    <p class="display-4">No Threads Found</p>
    <p class="lead">
        Be the first person to ask question..</p>
</div>';
}
?>






