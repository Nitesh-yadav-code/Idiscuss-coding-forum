<?php 
 include_once 'inc/header.php';
 
 require_once 'connection/db.php';
 ?>
<!-- Crousel start -->
<style type="text/css">
.carousel-item {
  height: 640px;
}

.carousel-item img {
    position: absolute;
    top: 0;
    left: 0;
    min-height: 640px;
}
}
</style>
<div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img\img22.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button> -->
  <!-- <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
    <span  aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button> -->
</div>
<!-- Crousel End -->


<!-- category container start -->
<div class="container my-4">
    <h2 class="text-center my-4">iDiscuss-Browse Category</h2>
    <div class="row my-4">
    <?php 
     $sql = "SELECT * FROM `categories`";
     $result = mysqli_query($conn, $sql);
     while($row= mysqli_fetch_assoc($result)){
        $catid = $row['category_id'];
        $cat = $row['category_name'];
        $desc = $row['category_description'];
        echo '<div class="col-md-3 text-center my-3">
        <div class="card" style="width: 18rem;">
            <img src="https://source.unsplash.com/500x400/?'.$cat.',coding..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><a href="threads.php?catid='.$catid.'">'.$cat.'</a></h5>
                <p class="card-text">'.substr($desc, 0, 90).'
                    ....</p>
                <a href="threads.php?catid='.$catid.'" class="btn btn-primary">View Threads</a>
            </div>
        </div>
    </div>';
     }
    
    ?>
        
    </div>
</div>
<!-- category container end -->




