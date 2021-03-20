<?php include "include/db.php";?>
<?php include "include/header.php";?>
<?php include "admin/function.php";?>
<?php session_start();?>
    <!-- Navigation -->
  
<?php include "include/navigation.php";?>
    <!-- Page Content -->
    <?php
     if(isset($_POST['liked'])){
         $post_id = $_POST['post_id'];
          $user_id = $_POST['user_id'];
         mysqli_query($connection,"UPDATE posts SET likes = likes +1 WHERE post_id = $post_id ");

         mysqli_query($connection,"INSERT INTO likes(user_id, post_id) VALUES ($user_id, $post_id)");
     }
    
     if(isset($_POST['unliked'])){
         $post_id = $_POST['post_id'];
          $user_id = $_POST['user_id'];
         

         mysqli_query($connection,"DELETE FROM likes WHERE user_id=$user_id AND post_id= $post_id");

         mysqli_query($connection,"UPDATE posts SET likes = likes -1 WHERE post_id = $post_id ");
     }
    
    
    ?>
    
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php
            if (isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];
    
                    $update_viewcount = " UPDATE posts SET post_views = post_views + 1 WHERE post_id = $the_post_id ";
                    $update_view_query = mysqli_query($connection, $update_viewcount);
                    if(!$update_view_query){
                    die('QUERY FAILED'. mysqli_error($connection));
                }

                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                }
                else{
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published'";
                }
                
            // $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                $select_all_post = mysqli_query($connection, $query);
                if (mysqli_num_rows($select_all_post) < 1){
                    echo "<h1 class='text-center'>No post available</h1>";;
                }
                else{
                        while($row = mysqli_fetch_assoc($select_all_post)){
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];
                            
                        } 
                        
                        ?>

                        <h1 class="page-header">
                            Post     
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                        <hr>
                        <p><?php echo $post_content ?></p>
                    
                        <hr>
                    <div class="row">
                    <p class="pull-right"><a class ="<?php echo userLikedthisPost($the_post_id) ? 'unlike':'like' ?>" href=""><span class="glyphicon glyphicon-thumbs-up"></span><?php echo userLikedthisPost($the_post_id) ? '  unlike ':'  like' ?></a></p></div>
                    <div class="row">
                    <p class="pull-right">Like:<?php getPostlikes($the_post_id) ?></p></div>
                    
                    <div class="clearfix"></div>


                <?php 
                
                ?>
                
                    <!-- Comments Form -->
                        <div class="well">
                            <h4>Leave a Comment:</h4>
                            <form role="form" method="post" action = "">
                                <div class="form-group">
                                <label for="author_name">Author</label>
                                <input type="text"  class="form-control" name="author_name" id="">
                                    
                                </div>
                                <div class="form-group">
                                <label for="author_email">email</label>
                                <input type="text"  class="form-control" name="author_email" id="">
                                    
                                </div>
                                
                                <div class="form-group">
                                <label for="author_comment">Leave your comment</label>
                                    <textarea class="form-control" rows="3" name="author_comment"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name = "create_comment">Submit</button>
                            </form>
                        </div>

                        <hr>


        <?php 
                
                if (isset($_POST['create_comment'])){
                        $comment_author = $_POST['author_name'];
                        $the_post_id = $_GET['p_id'];
                        $comment_email = $_POST['author_email'];
                        $comment_content = $_POST['author_comment'];
                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) ){

                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_date, comment_email, comment_content, comment_status)" ;

                    $query .= " VALUES ($the_post_id,'{$comment_author}',now(), '{$comment_email}', '{$comment_content}', 'Unapproved')" ;
        
                    $create_comment_query = mysqli_query($connection, $query);

                    if(!$create_comment_query){
                        die('QUERY FAILED'. mysqli_error($connection));
                    }

                    //  $query = "UPDATE posts set post_coment_count = post_coment_count + 1 WHERE post_id = $the_post_id";
                    //  $comment_count_set = mysqli_query($connection, $query);
                    }
                    
                    else{
                        echo "<script>alert('Fields cannot be empty')</script>";
                    }
                
                }
                
                
                ?>





                    <?php 
                    
                        $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id ";
                        $query .= "AND comment_status = 'Approved'";
                        $query .= "ORDER BY comment_id DESC";
                        
                        $select_view_comment = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($select_view_comment)){
                            $comment_content = $row['comment_content'];
                            $comment_author = $row['comment_author'];
                            $comment_date = $row['comment_date'];
                        ?>
                        <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>  
                            <div class="media-body">
                                    <h4 class="media-heading"><?php echo $comment_author?>
                                        <small><?php echo $comment_date?></small>
                                    </h4>
                                    <?php echo $comment_content?>
                                    <!-- Nested Comment -->
                                
                                    <!-- End Nested Comment -->
                                </div>
                        </div>
                        <?php }}} 
                ?>
          
                <!-- Comment -->
                 <div class="media">
                        <a class="pull-left" href="#">
                            <!-- <img class="media-object" src="http://placehold.it/64x64" alt=""> -->
                        </a>
                       
                   </div>
                
                 
             

                    

               

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

        <script>
        $(document).ready(function(){
            let post_id = <?php echo $the_post_id; ?>
            
            $('.like').click(function(){
               $.ajax({
                   url:"/cms/post.php?p_id = <?php echo $the_post_id; ?>",
                   type: 'post',
                   data:{
                       'liked':1,
                       'post_id':post_id,
                       'user_id':<?php echo LoggedInUserId(); ?>
                   }
               })
            });



             $('.unlike').click(function(){
               $.ajax({
                   url:"/cms/post.php?p_id = <?php echo $the_post_id; ?>",
                   type: 'post',
                   data:{
                       'unliked':1,
                       'post_id':post_id,
                       'user_id':<?php echo LoggedInUserId(); ?>
                   }
               })
            });
        });
        
        
        
        </script>
