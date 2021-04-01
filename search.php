<?php 
 include_once 'inc/header.php';
 
 require_once 'connection/db.php';
 ?>
<style type="text/css">
.jumbotron {
    max-height: 100vh;
    max-width: 900px;
    padding: 2rem 3rem;
    margin: 0 auto;
    margin-top: 25px;
    margin-bottom: 2rem;
    background-color: var(--bs-light);
    border-radius: .3rem;

}
#fm{
    background-color: white;
    padding: 5rem 0 0 0rem;
}
#fms{
    background-color: white;

}
</style>
<?php 
 $search = $_GET['search'];
?>
<div class="jumbotron my-5" id="fm">
    <h2>Search Result for <em>"<?php echo $search ?>"</em></h2>
</div>
<?php 
 $noResult = true;
$sql = "SELECT * FROM `thread` WHERE MATCH(thread_title, thread_desc) against('$search')";
$result = mysqli_query($conn, $sql);
$noResult = true;
while($row= mysqli_fetch_assoc($result)){
    $noResult = false;
    $id = $row['thread_id'];
    $title = $row['thread_title'];
   $desc = $row['thread_desc'];
   echo'<div class="jumbotron mt-3" id="fms">
       <h5 class="mt-0"><a class="text-dark " href="thread_list.php?threadid=' .$id. '">'.$title.'</a></h5>
           <p>'.$desc.'</p>
       </div>
   </div>
</div>';
}
if($noResult){
    echo '<div class="jumbotron">
    <p class="display-4">No Result Found</p>
    <p class="lead">
    <ul>
    <li>Make sure that all words are spelled correctly.</li>
 <li>Try more general keywords.</li>
 <li>Try fewer keywords.</li>
 <li>Try different keywords.</li>
 </ul>
        </p>
</div>';
}
   ?>