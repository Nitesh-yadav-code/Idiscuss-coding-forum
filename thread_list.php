<?php include_once 'inc/header.php'; ?>
<?php require_once 'connection/db.php';?>
<?php 
$id= $_GET['threadid'];
$sql = "SELECT * FROM `thread` WHERE thread_id=$id";
$result = mysqli_query($conn, $sql);
while($row= mysqli_fetch_assoc($result)){
   $title = $row['thread_title'];
   $desc = $row['thread_desc'];
   $thread_user_id = $row['thread_user_id'];
   $sql2 = "SELECT email FROM `signup` WHERE sno=$thread_user_id";
    $result2 = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_assoc($result2);
    $post_by = $row['email'];

}
?>

<!-- for submit comment through from -->
<?php  
 $showAlert = false;
$method = $_SERVER['REQUEST_METHOD'];
if($method=='POST'){
    $comment =$_POST['comment'];
    $comment = str_replace("<", "&lt;", $comment);
    $comment = str_replace(">", "&gt;", $comment);
    $comment_by =$_POST['sno'];
    
    $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) 
    VALUES ('$comment', '$id', '$comment_by', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $showAlert = true;
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong>  Your Comment has been added!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}

?>
<!-- for submit comment through from -->

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

.media {
    margin: 0 auto;
}
#fm{
    background-color: white;
}
</style>
<!-- start of jumbotron -->
<div class="jumbotron">
    <h1 class="display-4"> <?php echo $title;?></h1>
    <p class="lead">
        <?php echo $desc;?></p>
    <hr class="my-4">
    <p>This is peer to peer forum for sharing knowledg to each other
        No Spam / Advertising / Self-promote in the forums. ...
        Do not post copyright-infringing material. ...
        Do not post “offensive” posts, links or images. ...
        Do not cross post questions. ...
        Do not PM users asking for help. ...
        Remain respectful of other members at all times.
    </p>
    <p><b>Posted by:<em><?php echo $post_by;  ?></em></p>
</div>
<!-- End of jumbotron -->
<?php 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<div class="container jumbotron" id="fm">
    <h1>Post your Comment</h1>
    <form action= "'. $_SERVER['REQUEST_URI'].'"  method ="post" >
    <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
      <div class="mb-3">
        <label for="exampleFormControlTextarea1">Type your Comment</label>
      <textarea  class="form-control" name="comment" id="comment"  rows="3"></textarea>
      </div>
      
      <button type="submit" class="btn btn-success">Post Comment</button>
    </form>
    </div>';
}else{
  echo '  <div class="container jumbotron" id="fm">
  <h1>Post your Comment</h1>
         <p> Login to post comment</p>
</div>';
}

?>


<!-- start of Media object -->
<div class="container media">
   

    <?php 
    // session_start();
$id= $_GET['threadid'];
$sql = "SELECT * FROM `comments` WHERE thread_id=$id";
$result = mysqli_query($conn, $sql);
$noResult = true;
while($row= mysqli_fetch_assoc($result)){
    $noResult = false;
    $id = $row['comment_id'];
    $content = $row['comment_content'];
    $comment_time = $row['comment_time'];
    $user_id = $row['comment_by'];
    $sql2 = "SELECT email FROM `signup` WHERE sno=$user_id";
    $result2 = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_assoc($result2);

    echo'<div class="container mt-3">
    <div class="d-flex  p-3">
        <img src="https://cdn.pixabay.com/photo/2016/11/18/23/38/child-1837375_960_720.png" alt="Nitesh yadav"
            class="flex-shrink-0 mr-3  rounded-circle" style="width:50px;height:50px;">
        <div>
           <P class = "font-weight-bold my-0"> '.$row['email'].' At '.$comment_time.'</p>
            <p>'.$content.'</p>
        </div>
    </div>
</div>';

}
?>

<?php 
// echo var_dump($getResult);
if($noResult){
    echo '<div class="jumbotron">
    <p class="display-4">No Comments Found</p>
    <p class="lead">
        Be the first person to post answer..</p>
</div>';
}
?>







