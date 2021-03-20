<?php include "include/db.php";?>
<?php include "include/header.php";?>
    <!-- Navigation -->
  
<?php include "include/navigation.php";?>
    <!-- Page Content -->
    
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php
            $query = "SELECT * FROM posts WHERE post_status = 'published'";
            $select_all_post = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_all_post)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_status = $row['post_status'];

                // if($post_status !== 'published'){
                //     echo"<h1 class= 'text-center'> No POST HERE SORRY </h1>";
                //    }else{
                   
            ?>

                <h1 class="page-header">
                    Training Course
                    <small>Sustech Engineering</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author;?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                 <a href="post.php?p_id=<?php echo $post_id ?>">
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt=""></a>
                <hr>
                <p><?php echo $post_content ?></p>
                

                <hr>




             <?php } ?>

            


               

                <!-- Second Blog Post -->
                
<!-- 
                Third Blog Post
            <?php include "include/second_thirdblog.php";?> -->

                <!-- Pager -->
                
            <?php include "include/pager.php";?>

            <!-- Blog Sidebar Widgets Column -->
        <?php include "include/sidebar.php";?>

        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "include/footer.php";?>
