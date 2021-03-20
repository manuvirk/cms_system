<?php include "include/db.php";?>
<?php include "include/header.php";?>
<?php session_start();?>
    <!-- Navigation -->
  
<?php include "include/navigation.php";?>
    <!-- Page Content -->
    
    <div class="container"  >

        <div class="row">
             
            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php
             $page_size = 2;
            if(isset($_GET['page'])){
                 $page = $_GET['page'];
             }else{
                 $page ="";
             }
            if($page == "" || $page == 1){
                $page_1 = 0;
            }else{
                $page_1 = ($page*$page_size) -$page_size;
            }

            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                $post_count_query = "SELECT * FROM posts ";
            }
            else{
                 $post_count_query = "SELECT * FROM posts WHERE  post_status = 'published' ";
            }
            
             //$post_count_query = "SELECT * FROM posts WHERE post_status='published'";
             $post_count = mysqli_query($connection, $post_count_query);
             $count = mysqli_num_rows($post_count);
             
            
             $page_number = ceil($count/$page_size);

             
             //echo $page_number;  
            
            
            ?>

            <?php
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                $query = "SELECT * FROM posts LIMIT $page_1, $page_size";
            }
            else{
                $query = "SELECT * FROM posts WHERE  post_status = 'published' LIMIT $page_1, $page_size";
            }
            

            //$query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $page_size";
            $select_all_post = mysqli_query($connection, $query);
           
           if (mysqli_num_rows($select_all_post) < 1){
                    echo "<h1 class='text-center'>No post available</h1>";;
                }
        
           else{
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
                   Post
                    
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

             <?php } }?>

            


               

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
        <ul class ="pager">
        <?php
        
           for($i=1; $i<=$page_number; $i++){
             if($i== $page){
                echo "<li><a class= 'active_link' href ='index.php?page={$i}'>{$i}</a></li>";
            }else{
            echo "<li><a href ='index.php?page={$i}'>{$i}</a></li>";
               }
        
           }
        
        
        ?>
         </ul>
        <!-- Footer -->
        <?php include "include/footer.php";?>
