<?php include "include/db.php";?>
<?php include "include/header.php";?>
<?php include "admin/function.php";?>
<?php session_start();?>


    <!-- Navigation -->
  
<?php include "include/navigation.php";?>
    <!-- Page Content -->
    
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php
            if(isset($_GET['category'])){
             $category_id = $_GET['category'];
            }

            if(is_admin($_SESSION['username'])){
            $stmt1 = mysqli_prepare($connection,"SELECT post_id,post_title,post_author,post_date,post_image,post_content FROM posts WHERE post_cat_id = ? ");
        //     $query = "SELECT * FROM posts WHERE post_cat_id = $category_id";
            }

            else{
            $stmt2 = mysqli_prepare($connection, "SELECT post_id,post_title,post_author,post_date,post_image,post_content FROM posts WHERE post_cat_id =? AND post_status = ? ");
            // $query = "SELECT * FROM posts WHERE post_cat_id = $category_id AND post_status = 'published'";
            $published = 'published';
            }

            if(isset($stmt1)){
                mysqli_stmt_bind_param($stmt1,"i",$category_id);
                mysqli_stmt_execute($stmt1);
                mysqli_stmt_bind_result($stmt1,$post_id,$post_title,$post_author,$post_date,$post_image,$post_content);
                $stmt = $stmt1;
            }else{
                 mysqli_stmt_bind_param($stmt2,"is",$category_id, $published);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_bind_result($stmt2,$post_id,$post_title,$post_author,$post_date,$post_image,$post_content);
                $stmt = $stmt2;


            }
        //      if(mysqli_stmt_num_rows($stmt) == 0){
        //        echo"<h1 class ='text-center'> No categories are available</h1>";
              
        //    }
            //  $select_all_post = mysqli_query($connection, $query);
           
            while(mysqli_stmt_fetch($stmt));
                
            ?>


                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                   <?php echo"by";?> <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>




           <?php ?>




               

    
                
            <?php include "include/pager.php";?>

            <!-- Blog Sidebar Widgets Column -->
        <?php include "include/sidebar.php";?>

        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "include/footer.php";?>
