<?php include "include/db.php";?>
<?php include "include/header.php";?>
<?php  include "admin/function.php"; ?>
    <!-- Navigation -->
  
<?php include "include/navigation.php";?>
    <!-- Page Content -->
    
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php 
                  // echo $_POST['search'];
                  if(isset($_POST['submit'])){
                      
                  
                    $search = $_POST['search'];

                  }

                  $result = query("SELECT * FROM posts where (post_author  LIKE '%$search%'or post_tags LIKE '%$search%' OR post_title LIKE '%$search%'  OR post_content LIKE '%$search%') ");
                  confirmQuery($result);

                //   $search_result = mysqli_query($connect, $query);
    //post_tags OR post_title OR OR post_content
    
                //   if(!$search_result){
                //       die("QUERY FAILED".mysqli_error($connect));
                //   }
                  $count = mysqli_num_rows($result);

                  if($count == 0){
                      echo"<h1> NO RESULT</h1>";
                  }
                  else{
                      
                   
                  while($row = mysqli_fetch_assoc($result)){
                      $post_title = $row['post_title'];
                      $post_author = $row['post_author'];
                      $post_date = $row['post_date'];
                      $post_image = $row['post_image'];
                      $post_content = $row['post_content'];
                
            ?>

                <h1 class="page-header">
                    Training Course
                    <small>Sustech Engineering</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            
            <?php  }

           }?>



                <!-- Second Blog Post -->
                

                <!-- Third Blog Post -->
            <!-- <?php include "include/second_thirdblog.php";?> -->

